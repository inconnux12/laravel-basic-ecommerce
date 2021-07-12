<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\buy;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BuyController extends Controller
{

    public function index()
    {
        $buys=DB::table("buys")
        ->where('buys.status','wait')
        ->leftJoin("users","buys.user_id","=","users.id")
        ->leftJoin("products","buys.product_id","=","products.id")
        ->select('buys.*','users.name AS user_name' , 'products.name AS product_name')
        ->orderBy("buys.id","DESC") 
        ->paginate(10);
        $categories=Categorie::all();
        return view('admin.buy.index')->with('buys',$buys)->with('categories',$categories); 
    }

    public function buy($id)
    {
        $product=Product::where('slug',$id)->first();
        $categories=Categorie::all();
        return view('user.buy')->with('product',$product)->with('categories',$categories);
    }
    public function approve($id)
    {
        $buy=buy::find($id);
        $buy->status='approve';
        $buy->save();
        return redirect(route('admin.buy.index'))->with('success','buy approved');
        
    }
}
