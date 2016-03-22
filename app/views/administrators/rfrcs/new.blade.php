@extends('templates.master')


@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                <i class="fa fa-user-plus"></i> Create New Refer Cause
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               Create New Refer Cause
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="POST" class="form-horizontal">
                        	<fieldset>
 
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">CODE</label>
                                <div class="col-sm-6">
                                  <input type="text" name="rfrcs" class="form-control"
                                  value="{{$rfrcs->rfrcs}}"

                                  @if($rfrcs->rfrcs!="")
                                  {{' readonly '}}
                                  @endif>
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Name</label>
                                <div class="col-sm-6">
                                  <input type="text" name="name"  class="form-control"
                                  value="{{$rfrcs->name}}">
                                </div>
                              </div>



                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                  <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                              </div>


                            </fieldset>
                            <input type="hidden" name="code" value="{{$rfrcs->rfrcs}}">
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