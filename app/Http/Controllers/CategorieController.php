<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CategorieController extends Controller
{
  
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $q=$request->input('q');
        $prefix=explode('/',Route::current()->uri)[0];
        $cat=Categorie::where('slug',$id)->first();
        $categories=Categorie::all();
        if($q){
            $products=$cat->products()->where('name', 'like', '%' . $request->input('q') . '%');
            $products=$products->paginate(10);
            $products->appends(['q'=>$q]);
        }else{
            $products=$cat->products()->paginate(10);   
        }
    
        return view('user.categorie.show')->with('products',$products)
                ->with('categories',$categories)
                ->with('current_prefix',$prefix)
                ->with('current_cat',$id);
    }
  
}
