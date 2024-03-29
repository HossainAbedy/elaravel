@extends('adminlayout')
@section('admincontent')
<ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i> 
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Edit Manufacturer</a>
        </li>
    </ul>
    
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Manufacturer</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <p class="alert-success">
              <?php
                $message=Session::get('message');
                if($message){
                echo $message;
                Session::put('message',null);
                }
              ?>
            </p>
            <div class="box-content">
            <form class="form-horizontal" action="{{url('/update',$allmanufactureeditinfos->manufacture_id)}}" method="post">
                    {{csrf_field()}}
                  <fieldset>
                    {{-- <div class="control-group">
                      <label class="control-label" for="typeahead">Auto complete </label>
                      <div class="controls">
                        <input type="text" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                        <p class="help-block">Start typing to activate auto complete!</p>
                      </div>
                    </div> --}}
                    <div class="control-group">
                      <label class="control-label" for="date01">Manufacture Name</label>
                      <div class="controls">
                      <input type="text" class="input-xlarge" name="manufacture_name" value="{{$allmanufactureeditinfos->manufacture_name}}">
                      </div>
                    </div>

                    {{-- <div class="control-group">
                      <label class="control-label" for="fileInput">File input</label>
                      <div class="controls">
                        <input class="input-file uniform_on" id="fileInput" type="file">
                      </div>
                    </div>           --}}
                    {{-- <div class="control-group hidden-phone">
                      <label class="control-label" for="textarea2">Manufacture Description</label>
                      <div class="controls">
                        <textarea class="cleditor" name="manufacture_description" rows="3" >{{$allmanufactureeditinfos->category_description}}</textarea>
                      </div>
                    </div> --}}
                    {{-- <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Publication Status</label>
                            <div class="controls">
                              <input type="checkbox" name="publication_status" value="1">
                            </div>
                          </div> --}}
                    <div class="form-actions">
                      <button type="submit" class="btn btn-primary">Update Manufacture</button>
                      <button type="reset" class="btn">Cancel</button>
                    </div>
                  </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div><!--/row-->
 
@endsection