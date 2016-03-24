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
                          <tr class="bg-info">
                            <th width="140" class="text-center">Date</th>
                            <th width="100" class="text-center">Time</th>
                            
                            <th width="220">Name</th>
                            <th>From</th>
                            <th width="100">Gate1</th>
                            <th width="100">Gate2</th>
                            <th width="100">Hospital</th>
                            <th width="100">Status</th>
                            <th width="50">edit</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($referlist as $refer)
                        <tr
                        @if($refer->is_read==0){{'class="bg-danger"'}}@endif
                        >
                          <td class="text-center">{{$refer->refer_date}}</td>
                          <td class="text-center">{{$refer->refer_time}}</td>
                          <td>{{$refer->pname.$refer->fname." ".$refer->lname}}</td>
                          <td>{{$refer->refer_hospcode}}</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><a href="{{url('referout/edit/'.Crypt::encrypt($refer->refer_uuid))}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a></td>
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