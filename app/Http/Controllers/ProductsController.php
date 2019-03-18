<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class ProductsController extends Controller
{
    public function index(){
        $this->adminauthcheck();
        return view('admin.addproducts');
    }
    public function saveproducts(Request $request){
        $date=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['manufacture_id']=$request->manufacture_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['publication_status']=$request->publication_status;
        $image=$request->file('product_image');
        if($image){
            $image_name=str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success){
                $data['product_image']=$image_url;

                DB::table('products')->insert($data);
                Session::put('message','Product added successfully');
                return Redirect::to('/addproducts');
            } 
        } 
        $data['product_image']='';

                DB::table('products')->insert($data);
                Session::put('message','Product added successfully with no image');
                return Redirect::to('/addproducts');    
    }
    public function allproducts(){
        $this->adminauthcheck();
        $allproductsinfos=DB::table('products')
        ->join('category','products.category_id','=','category.category_id')
        ->join('manufacture','products.manufacture_id','=','manufacture.manufacture_id')
        ->select('products.*','category.category_name','manufacture.manufacture_name')
        ->get();
        // echo "<pre>";
        // print_r($allproductsinfos);
        // echo "</pre>";
        // exit();
        $manage_products=view ('admin.allproducts')->with('allproductsinfos',$allproductsinfos);
        return view('adminlayout')->with('admin.allproducts',$manage_products);
    }
    public function edit($product_id){
        $this->adminauthcheck();
        $allproducteditinfos=DB::table('products')
        ->where('product_id',$product_id)
        ->first();
        $manage_product_edit=view ('admin.editproducts')->with('allproducteditinfos',$allproducteditinfos);
        return view('adminlayout')->with('admin.editproducts',$manage_product_edit);
    }
    public function update(Request $request,$product_id){
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['manufacture_id']=$request->manufacture_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['publication_status']=$request->publication_status;
        DB::table('products')
        ->where('product_id',$product_id)
        ->update($data);
        Session::put('message','Product Updated');
        return Redirect::to('/allproducts');
    }
    public function inactive($product_id){
        DB::table('products')
        ->where('product_id',$product_id)
        ->update(['publication_status'=>0]);
        Session::put('message','Product status inactive now');
        return Redirect::to('/allproducts');
    }
    public function active($product_id){
        DB::table('products')
        ->where('product_id',$product_id)
        ->update(['publication_status'=>1]);
        Session::put('message','Product status active now');
        return Redirect::to('/allproducts');
    }
    public function delete($product_id){
        $allproducteditinfos=DB::table('products')
        ->where('product_id',$product_id)
        ->delete();
        Session::put('message','Product Deleted');
        return Redirect::to('/allproducts');
    }
    public function adminauthcheck(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return;
        }else{
            return Redirect::to('/admin')->send();
        }
    }
}
