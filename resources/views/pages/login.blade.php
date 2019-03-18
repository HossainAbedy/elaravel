@extends('layoutcart')
@section('cartcontent')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="{{url('/customer_login')}}" method="post">
                            {{csrf_field()}}
                        <input type="email" placeholder="Email Address" name="customer_email" requierd="" />
                        <input type="password" placeholder="Password" name="customer_password" requierd="" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="{{url('/customer_registration')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group{{ $errors->has('customer_name') ? ' has-error' : '' }}">
                                   {{-- <label for="customer_name" class="col-md-4 control-label">Customer Name</label>  --}}
                              
                                  <input type="text" placeholder="Custoemer Name" name="customer_name" requierd=""/>
                                     @if ($errors->has('customer_name'))
                                         <span class="help-block">
                                         <strong>{{ $errors->first('customer_name') }}</strong>
                                        </span>
                                     @endif
                              
                         </div><br>
                         <div class="form-group{{ $errors->has('customer_email') ? ' has-error' : '' }}">
                                     {{-- <label for="customer_email" class="col-md-4 control-label">Customer Email</label>  --}}
                             
                                    <input type="email" placeholder="Email Address" name="customer_email" requierd=""/>
                                 @if ($errors->has('customer_email'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('customer_email') }}</strong>
                                       </span>
                                  @endif
                              
                          </div><br>
                        <div class="form-group{{ $errors->has('customer_password') ? ' has-error' : '' }}">
                                    {{-- <label for="customer_password" class="col-md-4 control-label">Password</label>  --}}
                            
                                <input type="password" placeholder="Password" name="customer_password" requierd=""/>
                            @if ($errors->has('customer_password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('customer_password') }}</strong>
                                    </span>
                            @endif
                        
                       </div><br>
                       <div class="form-group{{ $errors->has('customer_number') ? ' has-error' : '' }}">
                                   {{-- <label for="customer_number" class="col-md-4 control-label">Customer Number</label>  --}}
                            
                                <input type="text" placeholder="Phone Number" name="customer_number" requierd=""/>
                                @if ($errors->has('customer_number'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('customer_number') }}</strong>
                                     </span>
                                @endif
                           
                       </div><br>
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection   