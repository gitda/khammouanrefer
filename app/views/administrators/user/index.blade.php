@extends('templates.master')


@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                <i class="fa fa-user"></i> User Manage
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <div class="panel-title pull-left">User Manage</div>
               <a href="{{url('administrator/user/new')}}" class="btn btn-success pull-right">Create New User</a>
               <div class="clearfix"></div>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-12">
                      <table id="datatable" class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Hospital</th>
                            
                            <th>Group</th>
                            <th width="100">Actived</th>
                            <th width="100">edit</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($user as $u)
                          <tr>
                            <td>{{$u->first_name." ".$u->last_name}}</td>
                            <td>{{$u->hospcode}} : {{$u->hospname}}</td>
                            <td>{{$u->group_name}}</td>
                            <td>
                            @if($u->activated==1)
                            <i class="fa fa-check"></i>
                            @else
                            <i class="fa fa-close"></i>
                            @endif
                            </td>
                            <td><a href="{{url('administrator/user/new/'.Crypt::encrypt($u->id))}}"
                            class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a></td>
                          </tr>

                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>  
                
            </div>
        </div>

        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@stop


@section('js_footer')

<script type="text/javascript">

  $(function() {

      $('#datatable').DataTable();

  } );

</script>
@stop