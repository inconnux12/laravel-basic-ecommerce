<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Image;
use App\Models\Product;
use App\Models\unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories=Categorie::all();
        $images=Image::all();
        $q=$request->input('q');
        $c=$request->input('categorie');
        if($q){
            if($c=='all'){
                $products=DB::table('products')
                ->where('units.status','full')
                ->where('products.name', 'like', '%' . $q . '%')
                ->leftJoin('units','products.id','=','units.product_id')
                ->leftJoin('images','products.id','=','images.product_id')
                ->leftJoin('categories','products.categorie_id','=','categories.id')
                ->select('products.*','units.stock','categories.title','images.name AS image_name','categories.slug AS categorie_slug')
                ->groupBy('products.id')
                ->orderBy('products.created_at','DESC')
                ->paginate(10);
                $products->appends(['q'=>$q]);
            }else{
                $cat=Categorie::where('slug',$c)->first();
                $products=DB::table('products')
                ->where('units.status','full')
                ->where('products.categorie_id',$cat->id)
                ->where('products.name', 'like', '%' . $q . '%')
                ->leftJoin('images','products.id','=','images.product_id')
                ->leftJoin('units','products.id','=','units.product_id')
                ->leftJoin('categories','products.categorie_id','=','categories.id')
                ->select('products.*','units.stock','categories.title','images.name AS image_name','categories.slug AS categorie_slug')
                ->groupBy('products.id')
                ->orderBy('products.created_at','DESC')
                ->paginate(3);
                $products->appends(['categorie'=>$c,'q'=>$q]);
            }
            
        }else{
            $products=DB::table('products')

                ->join('categories','products.categorie_id','=','categories.id')
                ->leftJoin('units','products.id','=','units.product_id')
                ->leftJoin('images','products.id','=','images.product_id')
                ->where('units.status','full')
                ->select('products.*','units.stock','categories.title','images.name AS image_name','categories.slug AS categorie_slug')
                ->groupBy('products.id')
                ->orderBy('products.created_at','DESC')
                ->paginate(3);         
        }
        $array=[];
        if(isset(auth()->user()->id)){
            $user=User::find(auth()->user()->id);
            $card=$user->card;
        }else{
            $card="";
        }
        return view('user.product.index')->with('card',$card)
        ->with('products',$products)->with('categories',$categories)->with('images',$images)->with('array',$array);
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::where('slug',$id)->first();
        $categories=Categorie::all();
        return view('user.product.show')->with('product',$product)->with('categories',$categories);
    }

}
