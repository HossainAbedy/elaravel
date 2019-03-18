<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class SliderController extends Controller
{
    public function index(){
        $this->adminauthcheck();
        return view('admin.addslider');
    }
    public function allslider(){
        $this->adminauthcheck();
        $allsliderinfos=DB::table('slider')->get();
        $manage_slider=view ('admin.allslider')->with('allsliderinfos',$allsliderinfos);
        return view('adminlayout')->with('admin.allslider',$manage_slider);
    }
    public function saveslider(Request $request){
        $date=array();
        $data['publication_status']=$request->publication_status;
        $image=$request->file('slider_image');
        if($image){
            $image_name=str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='slider/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success){
                $data['slider_image']=$image_url;

                DB::table('slider')->insert($data);
                Session::put('message','Slider added successfully');
                return Redirect::to('/addslider');
            } 
        } 
        $data['slider_image']='';

                DB::table('slider')->insert($data);
                Session::put('message','Slider added successfully with no image');
                return Redirect::to('/addslider');   
    } 
    

    public function inactive($slider_id){
        DB::table('slider')
        ->where('slider_id',$slider_id)
        ->update(['publication_status'=>0]);
        Session::put('message','Slider status inactive now');
        return Redirect::to('/allslider');
    }
    public function active($slider_id){
        DB::table('slider')
        ->where('slider_id',$slider_id)
        ->update(['publication_status'=>1]);
        Session::put('message','Slider status active now');
        return Redirect::to('/allslider');
    }
    public function delete($slider_id){
        $allslidereditinfos=DB::table('slider')
        ->where('slider_id',$slider_id)
        ->delete();
        Session::put('message','Slider Deleted');
        return Redirect::to('/allslider');
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
