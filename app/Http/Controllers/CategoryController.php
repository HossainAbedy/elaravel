<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class CategoryController extends Controller
{
    public function index(){
        $this->adminauthcheck();
        return view('admin.addcategory');
    }
    public function allcategory(){
        $this->adminauthcheck();
        $allcategoryinfos=DB::table('category')->get();
        $manage_category=view ('admin.allcategory')->with('allcategoryinfos',$allcategoryinfos);
        return view('adminlayout')->with('admin.allcategory',$manage_category);
    }
    public function savecategory(Request $request){
        $data=array();
        $data['category_id']=$request->category_id;
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;
        $data['publication_status']=$request->publication_status;
        
        DB::table('category')->insert($data);
        Session::put('message','New category inserted');
        return Redirect::to('/addcategory');
    }
    public function inactive($category_id){
        DB::table('category')
        ->where('category_id',$category_id)
        ->update(['publication_status'=>0]);
        Session::put('message','Category status inactive now');
        return Redirect::to('/allcategory');
    }
    public function active($category_id){
        DB::table('category')
        ->where('category_id',$category_id)
        ->update(['publication_status'=>1]);
        Session::put('message','Category status active now');
        return Redirect::to('/allcategory');
    }
    public function edit($category_id){
        $this->adminauthcheck();
        $allcategoryeditinfos=DB::table('category')
        ->where('category_id',$category_id)
        ->first();
        $manage_category_edit=view ('admin.editcategory')->with('allcategoryeditinfos',$allcategoryeditinfos);
        return view('adminlayout')->with('admin.editcategory',$manage_category_edit);
    }
    public function update(Request $request,$category_id){
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;

        DB::table('category')
        ->where('category_id',$category_id)
        ->update($data);
        Session::put('message','Category Updated');
        return Redirect::to('/allcategory');
    }
    public function delete($category_id){
        $allcategoryeditinfos=DB::table('category')
        ->where('category_id',$category_id)
        ->delete();
        Session::put('message','Category Deleted');
        return Redirect::to('/allcategory');
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
