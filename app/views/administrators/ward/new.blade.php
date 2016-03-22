@extends('templates.master')


@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                <i class="fa fa-user-plus"></i> Create New Ward
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               Create New Ward
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="POST" class="form-horizontal">
                        	<fieldset>
                              <!-- Form Name -->
                              <legend>Ward Information</legend>
                              @if($ward->ward!="")
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">CODE</label>
                                <div class="col-sm-6">
                                  <span class="text-danger">{{$ward->ward or ''}}</span>
                                </div>
                              </div>
                              @endif

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Name</label>
                                <div class="col-sm-6">
                                  <input type="text" name="name"  class="form-control"
                                  value="{{$ward->name}}">
                                </div>
                              </div>


                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Hospital</label>
                                <div class="col-sm-6">
                                  <select name="hospcode" class="form-control">
                                    <option value="">--</option>
                                    @foreach($hospcode as $h)
                                    <option value="{{$h->hospcode}}"
                                    @if($ward->hospcode==$h->hospcode) {{'selected'}} @endif>{{$h->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>


                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                  <div class="checkbox">
                                    <label>
                                      <input name="active" value="1" type="checkbox"
                                      @if($ward->active=="Y") {{'checked'}} @endif> Active
                                    </label>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                  <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                              </div>


                            </fieldset>

                            <input type="hidden" name="code" value="{{$ward->ward}}"></input>
                        </form>
                    </div>
                </div>  
                
            </div>
        </div>

        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection