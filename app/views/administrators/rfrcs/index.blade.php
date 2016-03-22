@extends('templates.master')


@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                <i class="fa fa-user"></i> Refer Cause Manage
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <div class="panel-title pull-left">Refer Cause Manage</div>
               <a href="{{url('administrator/rfrcs/new')}}" class="btn btn-success pull-right">Create New Refer Cause</a>
               <div class="clearfix"></div>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-12">
                      <table id="datatable" class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Code</th>
                            <th>Name</th>

                            <th width="100">edit</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($rfrcs as $r)
                          <tr>
                            <td>{{$r->rfrcs}}</td>
                            <td>{{$r->name}}</td>
                            <td><a href="{{url('administrator/rfrcs/new/'.Crypt::encrypt($r->rfrcs))}}"
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