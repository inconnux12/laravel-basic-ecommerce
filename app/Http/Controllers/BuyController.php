<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Stripe\Stripe as StripeStripe;
use Stripe\StripeClient;
use Session;
use App\Cities;
use App\Models\Card;

class BuyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profile()
    {    
        $id=auth()->user()->id;
        $user=User::find($id);
        $buys=DB::table("buys")
        ->where("buys.user_id",$id)
        ->join("users","buys.user_id","=",'users.id')
        ->leftJoin("products","buys.product_id","=","products.id")
        ->select('buys.*', 'products.name','products.slug')
        ->orderBy("buys.id","DESC") 
        ->paginate(10);
        $categories=Categorie::all();
        return view('user.profile')->with('user',$user)->with('buys',$buys)->with('categories',$categories)->with('willayas',Cities::willayas());
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'address'=>'required',
            'willaya'=>'required',
            'ville'=>'required',
            'zip_code'=>'required|digits:5',
            'card_name'=>'required',
            'card_number'=>'required|digits:16',
            'card_cvc'=>'required|digits:3',
            'card_exp_mm'=>'required|digits:2',
            'card_exp_yy'=>'required|digits:4',
        ]);

        $inputs=$request->all(['address','willaya','ville','zip_code','card_name','card_number','card_cvc','card_exp_mm','card_exp_yy']);
        $inputs['willaya_code']=$inputs['willaya'];
        $inputs['willaya']=Cities::search_willayas($inputs['willaya']);
        $card=Card::create($inputs);
        $user=User::find(auth()->user()->id);
        $user->card_id=$card->id;
        $card->save();
        $user->save();
        return redirect(route('profile'))->with('success','your card was added successfuly');
    }

    
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'address'=>'required',
            'willaya'=>'required',
            'ville'=>'required',
            'zip_code'=>'required|digits:5',
            'card_name'=>'required',
            'card_number'=>'required|digits:16',
            'card_cvc'=>'required|digits:3',
            'card_exp_mm'=>'required|digits:2',
            'card_exp_yy'=>'required|digits:4',
        ]);

        $inputs=$request->all(['address','willaya','ville','zip_code','card_name','card_number','card_cvc','card_exp_mm','card_exp_yy']);
        $inputs['willaya_code']=$inputs['willaya'];
        $inputs['willaya']=Cities::search_willayas($inputs['willaya']);
        $card=Card::find($id);
        $card->update($inputs);
        $card->save();
        return redirect(route('profile'))->with('success','your card was updated successfuly');
    }
    public function buy($id)
    {
        $product=Product::where('slug',$id)->first();
        $categories=Categorie::all();
        $user=User::find(auth()->user()->id);
        return view('user.buy')->with('card',$user->card)->with('product',$product)->with('categories',$categories);
    }

    public function makePayment(Request $request,$id)
    {
        $user=User::find(auth()->user()->id);
        $product=Product::where('slug',$id)->first();
        $stock=(int)$request->input('stock');
        $total=intval($stock*$product->price);
        
        $stripe=new StripeClient(env('STRIPE_SECRET'));
        $info=$stripe->charges->create([
                "amount" => $total*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "payment" 
        ]);
        $user->product()->attach($product->id,['nbr_purchases'=>$stock,'total'=>$total,'charge_id'=>$info->id]);
        $product->unit->stock-=$stock;
        $product->unit->status=($product->unit->stock==0)?'out':'full';
        $product->unit->save();

        return redirect(route('profile'))->with('success','product buyed'); 
    }
    public function destroy($id)
    {
        $buy=buy::find($id);
        $unit=unit::where('product_id',$buy->product_id)->first();
        $unit->stock+=$buy->nbr_purchases;
        $unit->save();
        $stripe=new StripeClient(env('STRIPE_SECRET'));
        $stripe->refunds->create(['charge'=>$buy->charge_id,['reason'=>'requested_by_customer']]);
        $buy->delete();
        return redirect(route('profile'))->with('success','product canceld'); 
    }

   
}
