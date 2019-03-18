@extends('adminlayout')
@section('admincontent')
<ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="/">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Orders</a></li>
    </ul>
    <p class="alert-success">
            <?php
              $message=Session::get('message');
              if($message){
              echo $message;
              Session::put('message',null);
              }
            ?>
          </p>
    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Current category list</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                  <thead>
                      <tr>
                          <th>Order Id</th>
                          <th>Customer Name</th>
                          <th>Order Total</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                @foreach($allorderinfos as $allorderinfo)       
                  <tbody>
                    <tr>
                        <td>{{$allorderinfo->order_id}}</td>
                        <td class="center">{{$allorderinfo->customer_name}}</td>
                        <td class="center">{{$allorderinfo->order_total}}</td>
                        <td class="center">{{$allorderinfo->order_status}}</td>                        
                        {{-- <td class="center">
                            @if($allorderinfo->publication_status==1)
                            <span class="label label-success">Active->{{$allorderinfo->publication_status}}</span>
                            @else
                            <span class="label label-danger">Inactive->{{$allorderinfo->publication_status}}</span>
                            @endif
                        </td> --}}
                        <td class="center">
                            {{-- @if($allorderinfo->order_status==1)
                               <a class="btn btn-danger" href="{{URL::to('/inactive-order/'.$allorderinfo->order_id)}}">
                                <i class="halflings-icon white thumbs-down"></i>  
                            </a>
                            @else
                            <a class="btn btn-success" href="{{URL::to('/active-order/'.$allorderinfo->order_id)}}">
                                    <i class="halflings-icon white thumbs-up"></i>  
                                </a>
                            @endif
                            <a class="btn btn-info" href="{{URL::to('/edit-order/'.$allorderinfo->order_id)}}">
                                <i class="halflings-icon white edit"></i>  
                            </a>
                            <a class="btn btn-danger" href="{{URL::to('/delete-order/'.$allorderinfo->order_id)}}" id="delete">
                                <i class="halflings-icon white trash"></i> 
                            </a> --}}
                            <a class="btn btn-info" href="{{URL::to('/view-order')}}">
                                <i class="halflings-icon white edit"></i>  
                            </a>
                        </td>
                    </tr>
                  </tbody>
                @endforeach  
              </table>            
            </div>
        </div><!--/span-->
    
    </div><!--/row-->
@endsection