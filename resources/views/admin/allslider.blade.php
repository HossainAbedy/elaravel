@extends('adminlayout')
@section('admincontent')
    <ul class="breadcrumb"> 
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Tables</a></li>
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
                <h2><i class="halflings-icon user"></i><span class="break"></span>Current slider list</h2>
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
                          <th>Slider ID</th>
                          <th>Slider Image</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                @foreach($allsliderinfos as $allsliderinfo)       
                  <tbody>
                    <tr>
                        <td>{{$allsliderinfo->slider_id}}</td>
                        <td class="center"><img src="{{URL::to($allsliderinfo->slider_image)}}" style="height:80px;width:80px;"></td>
                        <td>
                            @if($allsliderinfo->publication_status==1)
                            <span class="label label-success">Active->{{$allsliderinfo->publication_status}}</span>
                            @else
                            <span class="label label-danger">Inactive->{{$allsliderinfo->publication_status}}</span>
                            @endif
                        </td>
                        <td class="center">
                            @if($allsliderinfo->publication_status==1)
                               <a class="btn btn-danger" href="{{URL::to('/inactives/'.$allsliderinfo->slider_id)}}">
                                <i class="halflings-icon white thumbs-down"></i>  
                            </a>
                            @else
                            <a class="btn btn-success" href="{{URL::to('/actives/'.$allsliderinfo->slider_id)}}">
                                    <i class="halflings-icon white thumbs-up"></i>  
                                </a>
                            @endif
                            <a class="btn btn-danger" href="{{URL::to('/deletes/'.$allsliderinfo->slider_id)}}" id="delete">
                                <i class="halflings-icon white trash"></i> 
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