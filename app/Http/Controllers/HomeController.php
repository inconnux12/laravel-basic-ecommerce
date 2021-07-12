<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products=Product::pagination(10);
        return view('user.home')->with('products',$products);
    }  
}
