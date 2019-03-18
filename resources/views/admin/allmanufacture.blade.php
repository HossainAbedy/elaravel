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
                <h2><i class="halflings-icon user"></i><span class="break"></span>Current manufacturer list</h2>
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
                          <th>Manufacturer ID</th>
                          <th>Manufacturer Name</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                @foreach($allmanufactureinfos as $allmanufactureinfo)       
                  <tbody>
                    <tr>
                        <td>{{$allmanufactureinfo->manufacture_id}}</td>
                        <td class="center">{{$allmanufactureinfo->manufacture_name}}</td>
                        {{-- <td class="center">{{$allmanufacturerinfo->manufacturer_description}}</td> --}}
                        <td class="center">
                            @if($allmanufactureinfo->publication_status==1)
                            <span class="label label-success">Active->{{$allmanufactureinfo->publication_status}}</span>
                            @else
                            <span class="label label-danger">Inactive->{{$allmanufactureinfo->publication_status}}</span>
                            @endif
                        </td>
                        <td class="center">
                            @if($allmanufactureinfo->publication_status==1)
                               <a class="btn btn-danger" href="{{URL::to('/inactivem/'.$allmanufactureinfo->manufacture_id)}}">
                                <i class="halflings-icon white thumbs-down"></i>  
                            </a>
                            @else
                            <a class="btn btn-success" href="{{URL::to('/activem/'.$allmanufactureinfo->manufacture_id)}}">
                                    <i class="halflings-icon white thumbs-up"></i>  
                                </a>
                            @endif
                            <a class="btn btn-info" href="{{URL::to('/editm/'.$allmanufactureinfo->manufacture_id)}}">
                                <i class="halflings-icon white edit"></i>  
                            </a>
                            <a class="btn btn-danger" href="{{URL::to('/deletem/'.$allmanufactureinfo->manufacture_id)}}" id="delete">
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