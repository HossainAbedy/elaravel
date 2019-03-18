<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Cart;
use Session;
use Illuminate\Support\Facades\Redirect;
use VerifyUser;
use Mail;
use App\User;
use Illuminate\Support\Facades\Validator;



session_start();
class CheckoutController extends Controller
{
   public function loginuser(){
    return view('pages.login');
   }
   public function customer_login(Request $request){
       $customer_email=$request->customer_email;
       $customer_password=md5($request->customer_password);
       $result=DB::table('customer')
       ->where('customer_email', $customer_email)
       ->where('customer_password', $customer_password)
       ->first();
       if($result){
        Session::put('customer_id',$result->customer_id);
         return Redirect::to('/checkout');   
       }
       else{
        return Redirect::to('/loginuser');     
       }
   }

   public function customer_logout(){
    Session::flush();   
    return Redirect::to('/');     
    } 

   public function customer_registration(Request $request){
          $this->validate($request,[
          'customer_name'=>'required|string|max:20|unique:customer',
          'customer_email'=>'required|string|email|max:255|unique:customer',
          'customer_password'=>'required|string|min:6',
          'customer_number' =>'required|string',
          ]);                        
          $data=array();
          $data['customer_name']=$request->customer_name;
          $data['customer_email']=$request->customer_email;
          $data['customer_password']=md5($request->customer_password);
          $data['customer_number']=$request->customer_number;
          $customer=DB::table('customer')
          ->insertGetId($data);
          Session::put('customer_id',$request->customer_id);
          Session::put('customer_name',$request->customer_name);
          return Redirect::to('/checkout');
          }

                  //     protected function validator(array $data)
                  //     {
                  //      return Validator::make($data, [
                  //      'customer_name' => ['required', 'string', 'max:255'],
                  //      'customer_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                  //      'customer_password' => ['required', 'string', 'min:8'],
                  //      'customer_number' => ['required', 'string', 'max:255'],
                  //       ]);
                  //      }
                  //      protected function create(array $data){
                  //              $user=User::create([
                  //              'customer_name' => $data['customer_name'],
                  //              'customer_email' => $data['customer_email'],
                  //              'customer_password' => bcrypt($data['customer_password']),
                  //              'customer_number' => $data['customer_number'],
                  //       ]);
                  //              $verifyUser = VerifyUser::create([
                  //              'customer_id' => $user->customer_id,
                  //              'token' => sha1(time())
                  //       ]);
    
                  //   \Mail::to($user->email)->send(new VerifyMail($user));
                  //   return $user;
    
                  // }

                  // public function verifyUser($token){
                  //         $verifyUser = VerifyUser::where('token', $token)->first();
                  //             if(isset($verifyUser) ){
                  //                      $user = $verifyUser->user;
                  //             if(!$user->verified) {
                  //                      $verifyUser->user->verified = 1;
                  //                      $verifyUser->user->save();
                  //                      $status = "Your e-mail is verified. You can now login.";
                  //                      } else {
                  //                      $status = "Your e-mail is already verified. You can now login.";
                  //                      }
                  //                      } else {
                  //                        return redirect('/loginuser')->with('warning', "Sorry your email cannot be identified.");
                  //                      }
                  //                        return redirect('/checkout')->with('status', $status);
                  // }





























   public function checkout(){
    // $all_published_category=DB::table('category')
    // ->where('publication_status',1)
    // ->get();

    // $manage_published_category=view ('pages.checkout')->with('all_published_category',$all_published_category);
    // return view('layoutcart')->with('pages.checkout',$manage_published_category);
    return view ('pages.checkout');
   } 
   
   public function saveshippingdetails(Request $request){
    $data=array();
    $data['shipping_email']=$request->shipping_email;
    $data['shipping_fname']=$request->shipping_fname;
    $data['shipping_lname']=$request->shipping_lname;
    $data['shipping_adress']=$request->shipping_adress;
    $data['shipping_number']=$request->shipping_number;
    $data['shipping_city']=$request->shipping_city;

    $shipping_id=DB::table('shipping')
    ->insertGetId($data);
    Session::put('shipping_id',$shipping_id);
    return Redirect::to('/payment');
   }
   public function payment(){
    return view('pages.payment');
   }
   public function orderplace(Request $request){
    $payment_method=$request->payment_method;
    // $shipping_id=Session::get('shipping_id');
    // $customer_id=Session::get('customer_id');
    
    $pdata=array();
    $pdata['payment_method']=$payment_method;
    $pdata['payment_status']="pending";
    $payment_id=DB::table('payment')
    ->insertGetID($pdata);
    
    $odata=array();
    $odata['customer_id']=Session::get('customer_id');
    $odata['shipping_id']=Session::get('shipping_id');
    $odata['payment_id']=$payment_id;
    $odata['order_total']=Cart::total();
    $odata['order_status']="pending";
    $order_id=DB::table('order')
    ->insertGetID($odata);

    $contents=Cart::content();
    $oddata=array();
    
    foreach($contents as $content){
    $oddata['order_id']=$order_id;
    $oddata['product_id']=$content->id;
    $oddata['product_name']=$content->name;
    $oddata['product_price']=$content->price;
    $oddata['product_sales_quantity']=$content->qty;
    DB::table('order_details')
    ->insert($oddata);
    }
  
    if($payment_method=='handcash'){
        Cart::destroy();
        return view('pages.handcash');
    }else if($payment_method=='card'){
        
        sslapi();
    }else if($payment_method=='bkash'){
        return view('pages.bkash');
    }else{
         echo "Not selected";
    }
  }

   public function manageorder(){
    $this->adminauthcheck();
    $allorderinfos=DB::table('order')
    ->join('customer','order.customer_id','=','customer.customer_id')
    ->select('order.*','customer.customer_name')
    ->get();
    // echo "<pre>";
    // print_r($allproductsinfos);
    // echo "</pre>";
    // exit();
    $manage_order=view ('admin.manageorder')->with('allorderinfos',$allorderinfos);
    return view('adminlayout')->with('admin.manageorder',$manage_order);
   }
 


   public function vieworder(){
     return view('admin.vieworder');
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
