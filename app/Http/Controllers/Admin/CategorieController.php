<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q=$request->input('q');
        if($q){
            $categories=Categorie::where('title', 'like', '%' . $q . '%')->paginate(10);
            $categories->appends(['q'=>$q]);
        }else{
            $categories=Categorie::paginate(10);
        }
        return view('admin.categorie.index')->with('categories',$categories);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view('admin.categorie.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
        ]);
        $inputs=$request->all();
        if(Categorie::where('title',$inputs['title'])->first()){
            return redirect(route('admin.categorie.create'))->with('error','categorie already exist');
            
        }else{
            $categorie=new categorie();
            $categorie->title=$inputs['title'];
            $categorie->slug=\Illuminate\Support\Str::of($categorie->title)->slug('-'); 
            $categorie->save(); 
            return redirect(route('admin.categorie.index'))->with('success','categorie created');      
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat=Categorie::find($id);
        return view('admin.categorie.edit')->with('categorie',$cat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
        ]);
        $inputs=$request->all();
        $cat=Categorie::where('title',$inputs['title'])->first();
        if($cat && $cat->id!=$id){
            return redirect(route('admin.categorie.edit',['categorie'=>$id]))->with('error','categorie already exist');
            
        }else{
            $categorie=categorie::find($id);
            $categorie->title=$inputs['title'];
            $categorie->slug=\Illuminate\Support\Str::of($categorie->title)->slug('-'); 
            $categorie->save(); 
            return redirect(route('admin.categorie.index'))->with('success','categorie updated');      
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat=Categorie::find($id);
        foreach($cat->products as $product){
            $product->images()->delete();
            $product->unit()->delete();
        }
        $cat->products()->delete();
        $cat->delete();
        return redirect(route('admin.categorie.index'))->with('success','categorie removed');  
    }
}
