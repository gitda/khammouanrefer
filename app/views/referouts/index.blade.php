@extends('templates.master')


@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                <i class="fa fa-ambulance"></i> {{trans('nav.menu_referout')}}
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <div class="panel-title pull-left">{{trans('nav.menu_referout')}}</div>
               <a href="{{url('referout/new')}}" class="btn btn-success pull-right">New Refer</a>
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