<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class ManufactureController extends Controller
{
    public function index(){
        $this->adminauthcheck();
        return view('admin.addmanufacture');
    }
    public function allmanufacture(){
        $this->adminauthcheck();
        $allmanufactureinfos=DB::table('manufacture')->get();
        $manage_manufacture=view ('admin.allmanufacture')->with('allmanufactureinfos',$allmanufactureinfos);
        return view('adminlayout')->with('admin.allmanufacture',$manage_manufacture);
    }
    public function savemanufacture(Request $request){
        $data=array();
        $data['manufacture_id']=$request->manufacture_id;
        $data['manufacture_name']=$request->manufacture_name;
        // $data['manufacture_description']=$request->manufacture_description;
        $data['publication_status']=$request->publication_status;
        
        DB::table('manufacture')->insert($data);
        Session::put('message','New category inserted');
        return Redirect::to('/addmanufacture');
    }
    public function inactive($manufacture_id){
        DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->update(['publication_status'=>0]);
        Session::put('message','Manufacture status inactive now');
        return Redirect::to('/allmanufacture');
    }
    public function active($manufacture_id){
        DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->update(['publication_status'=>1]);
        Session::put('message','Manufacture status active now');
        return Redirect::to('/allmanufacture');
    }
    public function edit($manufacture_id){
        $this->adminauthcheck();
        $allmanufactureeditinfos=DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->first();
        $manage_manufacture_edit=view ('admin.editmanufacture')->with('allmanufactureeditinfos',$allmanufactureeditinfos);
        return view('adminlayout')->with('admin.editmanufacture',$manage_manufacture_edit);
    }
    public function update(Request $request,$manufacture_id){
        $data=array();
        $data['manufacture_name']=$request->manufacture_name;
        // $data['manufacture_description']=$request->manufacture_description;

        DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->update($data);
        Session::put('message','Manufacture Updated');
        return Redirect::to('/allmanufacture');
    }
    public function delete($manufacture_id){
        $allmanufactureeditinfos=DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->delete();
        Session::put('message','Manufacture Deleted');
        return Redirect::to('/allmanufacture');
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
