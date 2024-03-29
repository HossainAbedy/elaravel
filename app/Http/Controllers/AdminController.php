<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class AdminController extends Controller
{
    public function index(){
        return view('admin.adminlogin');
    }
    // public function dashboard(){
    //     return view('admin.dashboard');
    // }
    public function view_dashboard(Request $request){
        $admin_email=$request->admin_email;
        $admin_password=md5($request->admin_password);
        $result=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->where('admin_password',$admin_password)
        ->first();
       if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
       }else{
            Session::put('message','Email or password invalid');
            return Redirect::to('/admin');
       }
    }
}
