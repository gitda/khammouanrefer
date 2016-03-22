@extends('templates.master')


@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                <i class="fa fa-user"></i> ward Manage
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <div class="panel-title pull-left">ward Manage</div>
               <a href="{{url('administrator/ward/new')}}" class="btn btn-success pull-right">Create New Ward</a>
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
                            <th width="100">Actived</th>
                            <th width="100">edit</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($ward as $d)
                          <tr>
                            <td>{{$d->name}}</td>
                            <td>{{$d->hospcode}} : {{$d->hospname}}</td>
                            <td>
                              @if($d->active=="Y")
                              <i class="fa fa-check"></i>
                              @else
                              <i class="fa fa-close"></i>
                              @endif
                            </td>
                            <td><a href="{{url('administrator/ward/new/'.Crypt::encrypt($d->ward))}}"
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