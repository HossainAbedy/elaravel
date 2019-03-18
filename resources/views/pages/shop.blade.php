@extends('layoutcart')
@section('cartcontent')
<h2 class="title text-center">Features Items</h2>
<?php foreach($allproductsinfos as $allproductinfo){?>
<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to($allproductinfo->product_image)}}" style="height:300px" alt="" />
                    <h2>{{$allproductinfo->product_price}}</h2>
                    <p>{{$allproductinfo->product_name}}</p>
                    <a href="{{URL::to('/view_product/'.$allproductinfo->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{$allproductinfo->product_price}}</h2>
                    <a href="{{URL::to('/view_product/'.$allproductinfo->product_id)}}"><p>{{$allproductinfo->product_name}}</p>
                        <a href="{{URL::to('/view_product/'.$allproductinfo->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
        </div>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li><a href="#"><i class="fa fa-plus-square"></i>{{$allproductinfo->manufacture_name}}</a></li>
                <li><a href="{{URL::to('/view_product/'.$allproductinfo->product_id)}}"><i class="fa fa-plus-square"></i>View Product</a></li>
            </ul>
        </div>
    </div>
</div>
<?php }?>
{{$allproductsinfos->links()}}
@endsection  