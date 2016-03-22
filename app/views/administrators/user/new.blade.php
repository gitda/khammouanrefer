@extends('templates.master')


@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                <i class="fa fa-user-plus"></i> Create New User
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               Create New User
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="POST" class="form-horizontal">
                        	<fieldset>

                              <!-- Form Name -->
                              <legend>Personal Information</legend>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">First Name</label>
                                <div class="col-sm-6">
                                  <input type="text" name="first_name"  class="form-control"
                                  value="{{$user->first_name}}">
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Last Name</label>
                                <div class="col-sm-6">
                                  <input type="text" name="last_name" class="form-control"
                                  value="{{$user->last_name}}">
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Hospital</label>
                                <div class="col-sm-6">
                                  <select name="hospcode" class="form-control">
                                    <option value="">--</option>
                                    @foreach($hospcode as $h)
                                    <option value="{{$h->hospcode}}"
                                    @if($h->hospcode==$user->hospcode) {{'selected'}} @endif>{{$h->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Hospital</label>
                                <div class="col-sm-6">
                                  <select name="group" class="form-control">
                                    @foreach($group as $g)
                                    <option value="{{$g->id}}"
                                    @if($user_group==$g->id) {{'selected'}} @endif>{{$g->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>





                            </fieldset>

                            <fieldset>

                              <!-- Form Name -->
                              <legend>Account</legend>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">User Name</label>
                                <div class="col-sm-6">
                                  <input type="text" name="email"  class="form-control"
                                  value="{{$user->email}}">
                                </div>
                              </div>



                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Password</label>
                                <div class="col-sm-6">
                                  <input type="password" name="password" class="form-control">
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Confirm Password</label>
                                <div class="col-sm-6">
                                  <input type="password" name="password_confirmation" 
                                  class="form-control" value="">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                  <div class="checkbox">
                                    <label>
                                      <input name="activated" value="1" type="checkbox"
                                      @if($user->activated=="1") {{'checked'}} @endif> Activated
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

                            <input type="hidden" name="id" value="{{$user->id}}"></input>
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