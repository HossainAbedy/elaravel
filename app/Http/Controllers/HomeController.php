<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $allproductsinfos=DB::table('products')
        ->join('category','products.category_id','=','category.category_id')
        ->join('manufacture','products.manufacture_id','=','manufacture.manufacture_id')
        ->select('products.*','category.category_name','manufacture.manufacture_name')
        ->where('products.publication_status',1)
        ->limit(9)
        ->get();
        // echo "<pre>";
        // print_r($allproductsinfos);
        // echo "</pre>";
        // exit();
        $manage_products=view ('pages.homecontent')->with('allproductsinfos',$allproductsinfos);
        return view('layout')->with('pages.homecontent',$manage_products);
    }

    public function product_by_category($category_id){
      
        $products_by_category=DB::table('products')
        ->join('category','products.category_id','=','category.category_id')
        ->join('manufacture','products.manufacture_id','=','manufacture.manufacture_id')
        ->select('products.*','category.category_name','manufacture.manufacture_name')
        ->where('category.category_id',$category_id)
        ->where('products.publication_status',1)
        ->limit(9)
        ->get();
        // echo "<pre>";
        // print_r($allproductsinfos);
        // echo "</pre>";
        // exit();
        $manage_products_by_category=view ('pages.category_by_product')->with('products_by_category',$products_by_category);
        return view('layout')->with('pages.category_by_product',$manage_products_by_category);
    }

    public function product_by_manufacture($manufacture_id){
  
        $products_by_manufacture=DB::table('products')
        ->join('category','products.category_id','=','category.category_id')
        ->join('manufacture','products.manufacture_id','=','manufacture.manufacture_id')
        ->select('products.*','category.category_name','manufacture.manufacture_name')
        ->where('manufacture.manufacture_id',$manufacture_id)
        ->where('products.publication_status',1)
        ->limit(9)
        ->get();
        // echo "<pre>";
        // print_r($allproductsinfos);
        // echo "</pre>";
        // exit();
        $manage_products_by_manufacture=view ('pages.manufacture_by_product')->with('products_by_manufacture',$products_by_manufacture);
        return view('layout')->with('pages.manufacture_by_product',$manage_products_by_manufacture);
    }
    public function product_detail($product_id){
        $product_by_detail=DB::table('products')
        ->join('category','products.category_id','=','category.category_id')
        ->join('manufacture','products.manufacture_id','=','manufacture.manufacture_id')
        ->select('products.*','category.category_name','manufacture.manufacture_name')
        ->where('products.product_id',$product_id)
        ->where('products.publication_status',1)
        ->first();
        // echo "<pre>";
        // print_r($allproductsinfos);
        // echo "</pre>";
        // exit();
        $manage_product_by_detail=view ('pages.product_by_detail')->with('product_by_detail',$product_by_detail);
        return view('layout')->with('pages.product_by_detail',$manage_product_by_detail);
    }
}
