<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Image;
use App\Models\Product;
use App\Models\unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
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
    public function index(Request $request,$by=null,$di=null)
    {
        if($request->ajax()){
            $c=$request->json('categorie')??'all';
            $q=($request->json('q'))?$request->json('q'):'';
            $by=$request->json('name')??'products.id';
            $old[$by]=$request->json('old')??'DESC';
            $order=true;
        }else{
            $q=($request->input('q'))?$request->input('q'):'';
            $c=$request->input('categorie')??'all';
            $by=$by??'products.id';
            $old[$by]=$di??'DESC';
            $order=false;
        }
        $categories=Categorie::all();
        $cat=($c!=='all')?(Categorie::where('slug',$c)->first()):'';
        $products=($c!=='all')?(DB::table('products')->where('products.categorie_id',$cat->id)):(DB::table('products'));
        $products=$products->where('products.name', 'like', '%' . $q . '%')
            ->leftJoin('units','products.id','=','units.product_id')
            ->leftJoin('categories','products.categorie_id','=','categories.id')
            ->select('products.*','units.stock','units.status','categories.title','categories.slug AS categorie_slug')
            ->orderBy($by,$old[$by])
            ->paginate(10);
        $products->appends(['q'=>$q,'categorie'=>$c]);
        $old[$by]=($old[$by]=='DESC')?'ASC':'DESC';
        return view('admin.product.index')->with('products',$products)->with('categories',$categories)->with('old',$old);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $cat=Categorie::all();
        return view('admin.product.create')->with('categories',$cat);
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
            'name'=>'required',
            'desc'=>'required',
            'price'=>'required',
            'stock'=>'required',
            'image'=>'required',
            'image.*'=>'image|mimes:png,jpg'
        ]);
        $inputs=$request->all();
       
        $product=new Product();
        $unit=new unit();
        
        $product->name=$inputs['name'];
        $product->categorie_id=$inputs['categorie'];
        $product->slug=\Illuminate\Support\Str::of($product->name)->slug('-'); //Str::slug()
        $product->desc=$inputs['desc'];
        $product->price=$inputs['price'];
        $product->save(); 
        if ($images = $request->file('image')) {
            foreach($images as $image){
                $img=new Image();  
                $destinationPath = 'image/';
                $profileImage = date('YmdHis').'_'.uniqid() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $img->name = "$profileImage";
                $img->product_id=$product->id;
               $img->save();
            }
            
        }
        
        $unit->stock=$inputs['stock'];
        $unit->product_id=$product->id;
        $unit->save();
        return redirect(route('admin.product.index'))->with('success','product created'); 
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        return view('admin.product.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $cat=Categorie::all();
        return view('admin.product.edit')->with('product',$product)->with('categories',$cat);
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
            'name'=>'required',
            'desc'=>'required',
            'price'=>'required',
            'stock'=>'required',
            'image.*'=>'image|mimes:png,jpg'
        ]);
        $inputs=$request->all();
       
        $product=Product::find($id);
        $unit=unit::where('product_id',$id)->first();
        
        $product->name=$inputs['name'];
        $product->categorie_id=$inputs['categorie'];
        $product->slug=\Illuminate\Support\Str::of($product->name)->slug('-'); 
        $product->desc=$inputs['desc'];
        $product->price=$inputs['price'];
        $product->save(); 
        if ($images = $request->file('image')) {
            Image::where('product_id',$id)->delete();  
            foreach($images as $image){
                $img=new Image();
                $destinationPath = 'image/';
                $profileImage = date('YmdHis').'_'.uniqid() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $img->name = "$profileImage";
                $img->product_id=$product->id;
                $img->save();
            }
        }
        
        $unit->stock=$inputs['stock'];
        $unit->product_id=$product->id;
        $unit->save();
        return redirect(route('admin.product.index'))->with('success','product updated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->images()->delete();
        $product->unit()->delete();
        $product->delete();
        return redirect(route('admin.product.index'))->with('success','product removed');  
    }
    public function fillup(Request $request,$id)
    {
        $product=Product::find($id);
        $product->unit->stock+=$request->input('stock');
        $product->unit->status='full';
        $product->unit->save();
        return redirect(route('admin.product.index'))->with('success','prduct fill up');
    }

}
