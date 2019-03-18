@extends('layoutcart')
@section('cartcontent')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->


			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one ">
                                <form action="{{URL::to('/saveshippingdetails')}}" method="post"> 
                                    {{csrf_field()}}
									{{-- <input type="text" placeholder="Company Name"> --}}
									<input type="text" placeholder="Email*" name="shipping_email"><br>
									{{-- <input type="text" placeholder="Title"> --}}
									<input type="text" placeholder="First Name *" name="shipping_fname"><br>
									{{-- <input type="text" placeholder="Middle Name"> --}}
									<input type="text" placeholder="Last Name *" name="shipping_lname"><br>
									<input type="text" placeholder="Address *" name="shipping_adress"><br>
                                    {{-- <input type="text" placeholder="Address 2"> --}}
                                    <input type="text" placeholder="Mobile Number" name="shipping_number"><br>
                                    <input type="text" placeholder="City" name="shipping_city"><br>
                                    <input type="submit" class="btn btn-warning" value="Done">
								</form>
							</div>
                        </div>
                    </div>
                </div>   
			 </div>
		</div>
	</section> <!--/#cart_items-->

@endsection   