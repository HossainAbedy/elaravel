<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Cart;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class CartController extends Controller
{
   
    public function addtocart(Request $request){
        $qty=$request->qty;
        $product_id=$request->product_id;
        $product_info=DB::table('products')
        ->where('product_id',$product_id)->first();
        
        $data['qty']=$qty;
        $data['id']=$product_info->product_id;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_price;
        $data['options']['image']=$product_info->product_image;
        Cart::add($data);
        return Redirect::to('/showcart');
    }
    
    public function showcart(){
        $all_published_category=DB::table('category')
        ->where('publication_status',1)
        ->get();

        $manage_published_category=view ('pages.add_to_cart')->with('all_published_category',$all_published_category);
        return view('layout')->with('pages.add_to_cart',$manage_published_category);
    }

    public function deletecart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/showcart');
    }

    public function updatecart(Request $request){
        $qty=$request->qty;
        $rowId=$request->rowId;
        Cart::update($rowId,$qty);
        return Redirect::to('/showcart');
    }
}
