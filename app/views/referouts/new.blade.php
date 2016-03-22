@extends('templates.master')


@section('js_header')

<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/datepicker/datepicker3.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/dist/css/select2.css')}}">


@stop

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="name-header">
                ข้อมูลส่งต่อ
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
<!--             <div class="panel-heading">
                Basic Tabs
            </div> -->
            <div class="panel-body">
                <form action="" method="POST" class="form-horizontal">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <fieldset>

                              <!-- Form Name -->
                              <legend>Data Forwarding</legend>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-xs-1 control-label" for="textinput">Date</label>
                                <div class="col-xs-2">
                                  <input type="text" name="refer_date"
                                   class="form-control datepicker"
                                   placeholder="dd-mm-yyyy"
                                   value="{{\Carbon\Carbon::createFromFormat('Y-m-d',$refer->refer_date)->format('d-m-Y')}}">
                                </div>

                                <label class="col-xs-1 control-label" for="textinput">Time</label>
                                <div class="col-xs-1">
                                  <input type="text" name="refer_time" class="form-control"
                                  value="{{$refer->refer_time}}">
                                </div>

                                <label class="col-xs-2 control-label" for="textinput">Refering Form</label>
                                <div class="col-xs-5">

                                    <select name="refer_hospcode" class="form-control select2">
                                        @foreach($hospcode as $h)
                                        <option value="{{$h->hospcode}}">{{$h->hospcode}} : {{$h->name}}</option>
                                        @endforeach

                                    </select>

                                </div>



                              </div>
                              <div class="form-group">
                                <label class="col-xs-1 control-label" for="textinput"></label>
                                <div class="col-xs-2">
                                    
                                    <label class="control-label"><input type="radio" name="risk" id="inlineCheckbox1" value="option1"> Trauma
                                    </label>

                                    <label class="control-label"><input type="radio" name="risk" id="inlineCheckbox2" value="option1"> Non-Trauma  </label>                           
                                </div>
                                  
                              </div>

                              <!-- Text input-->
                              <legend>Patient information</legend>

                              <div class="form-group">
                                <label class="col-xs-1 control-label" for="textinput">HN</label>

                                <div class="col-xs-4">
                                <select name="icd10" id="select2_patient" class="form-control"><option value="" selected="selected"></option>
                                        </select>

                                </div>
                              </div>
                              <hr/>

                              <div class="form-group">
                                <label class="col-xs-1 control-label" for="textinput">PREFIX</label>
                                <div class="col-xs-2">
                                  <select id="pname" name="pname" class="form-control">
                                    @foreach($pnames as $pname)
                                    <option value="{{$pname->provis_code}}"
                                    @if($pname->provis_code==$patient->pname){{'selected'}}@endif>{{$pname->name}}</option>
                                    @endforeach
                                  </select>
                                </div>

                                <label class="col-xs-1 control-label" for="textinput">FIRSTNAME</label>
                                <div class="col-xs-2">
                                  <input type="text" id="fname" name="fname" class="form-control"
                                  {{$patient->fname}}>
                                </div>

                                <label class="col-xs-1 control-label" for="textinput">LASTNAME</label>
                                <div class="col-xs-2">
                                  <input type="text" id="lname" name="lname" class="form-control"
                                  value="{{$patient->lname}}">
                                </div>

                                <label class="col-xs-1 control-label" for="textinput">BIRTH</label>
                                <div class="col-xs-2">
                                  <input type="text" id="birthdate" name="birthdate" class="form-control datepicker"
                                  value="{{$patient->birthdate}}">
                                </div>

                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-xs-1 control-label" for="textinput">ICD10</label>
                                <div class="col-xs-5">
                                
                                    <select name="icd10[]" id="select2_diag" class="form-control" multiple="" >

                                    </select>
                     
                                </div>

                                <label class="col-xs-1 control-label" for="textinput">Diagnosis Text.</label>
                                <div class="col-xs-5">
                                  <input type="text" placeholder="Diag Text" class="form-control">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-xs-1 control-label" for="textinput">Cause</label>
                                <div class="col-xs-5">
                                  <input type="text" placeholder="Post Code" class="form-control">
                                </div>
                              </div>



                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-xs-1 control-label" for="textinput">Doctor</label>
                                <div class="col-xs-5">
                                  <input type="text" placeholder="Country" class="form-control">
                                </div>

                                <label class="col-xs-1 control-label" for="textinput">Adm Ward</label>
                                <div class="col-xs-2">
                                  <input type="text" placeholder="Country" class="form-control">
                                </div>
                              </div>


                            </fieldset>
                        </div>
                    </div>
                </div>  
                <hr/>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs">
                            <li class="hidden"><a href="#Fastrac" data-toggle="tab">Fastrac MI/Stroke</a>
                            <li class="active"><a href="#patient_info" data-toggle="tab">Patient Information</a>
                            </li>
                            <li><a href="#home" data-toggle="tab">Admission Symptoms</a>
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab">The treatment received</a>
                            </li>
                            <li class=""><a href="#messages" data-toggle="tab">Treatment / symptoms Forward</a>
                            </li>
                            <li class=""><a href="#settings" data-toggle="tab">CONSULT</a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane fade hidden" id="Fastrac">
                                <h4></h4>
                                <div class="form-horizontal">
                                    <fieldset>
                                        <div class="form-group">
                                            <label>&nbsp&nbsp&nbsp LR G</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>P</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>A</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>I</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>GA</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>WK</label>

                                            <label>&nbsp&nbsp&nbsp I</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>D</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>Eff</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>%</label>
                                            <label>&nbsp&nbsp&nbsp Station</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>MR/MI</label>

                                            <label>&nbsp&nbsp&nbsp FHS</label>
                                                <input type="text" class="text-center" style="width:50px">
                                            <label>ครั้ง</label>
                                        </div> 

                                        <div class="form-group">
                                            <label>&nbsp&nbsp&nbsp V/S admission BP</label>
                                                <input type="text" class="text-center" style="width:50px">/<input type="text" class="text-center" style="width:50px">
                                            <label>mmHg</label>
                                            <label>P</label>
                                                <input type="text" class="text-center" style="width:80px">
                                            <label>RR</label>
                                                <input type="text" class="text-center" style="width:80px">
                                            <label>T</label>
                                                <input type="text" class="text-center" style="width:80px">
                                            <label>spo2</label>
                                                <input type="text" class="text-center" style="width:80px">
                                            <label>GCS E</label>
                                                <input type="text" class="text-center" style="width:80px">
                                            <label>V</label>
                                                <input type="text" class="text-center" style="width:80px">
                                            <label>M</label>
                                                <input type="text" class="text-center" style="width:80px">
                                        </div> 
                                    </fieldset>
                                </div>
                            </div>

                            <div class="tab-pane fade active in" id="home">
                                <h4></h4>
                                <div class="form-horizontal">
                                    <fieldset>
                                        <textarea class="form-control" rows="5"></textarea>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile">
                                <h4></h4>
                                <div class="table-responsive">
                                    <textarea class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="messages">
                                <h4></h4>
                                <div class="table-responsive">
                                    <textarea class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings">
                                <h4></h4>
                                <div class="table-responsive">
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp V/S ก่อนออกมา BP</label>
                                                <input type="text" class="text-center" style="width:50px">/<input type="text" class="text-center" style="width:50px">
                                        <label>mmHg</label>
                                        <label>P</label>
                                            <input type="text" class="text-center" style="width:80px">
                                        <label>RR</label>
                                            <input type="text" class="text-center" style="width:80px">
                                        <label>T</label>
                                            <input type="text" class="text-center" style="width:80px">
                                        <label>spo2</label>
                                            <input type="text" class="text-center" style="width:80px">
                                        <label>GCS E</label>
                                            <input type="text" class="text-center" style="width:80px">
                                        <label>V</label>
                                            <input type="text" class="text-center" style="width:80px">
                                        <label>M</label>
                                            <input type="text" class="text-center" style="width:80px">
                                    </div> 
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp แพทย์รับCONSULT ชื่อ</label>
                                                <input type="text" class="text-center" style="width:300px">
                                        <label></label>
                                        <label>&nbsp&nbsp&nbsp จนท. นำส่ง</label>
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> พขร
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> RN
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> EMT
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> AID
                                    </div> 
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp เอกสารผู้ป่วยที่จำเป็น</label>  
                                    </div>
                                    <div class="form-group">
                                            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> ใบRefer
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> X-ray                                
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> CT
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> EKG
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> LAB
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> สิทธิบัตร 
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> ใบRequest 
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> อื่นๆ 
                                    </div>
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp ปัญหาที่พบในขณะส่งต่อ</label>  
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5"></textarea> 
                                    </div>
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp ผู้ประสาน</label>
                                                <input type="text" class="text-center" style="width:300px">
                                        <label></label>
                                        <label>
                                        (
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> แพทย์
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> พยาบาล  
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> EMT 
                                        )
                                        </label>

                                        <label>&nbsp&nbsp&nbsp ผู้ประสาน</label>
                                                <input type="text" class="text-center" style="width:300px">
                                        <label></label>
                                        <label>
                                        (
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> แพทย์
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> พยาบาล  
                                            <input type="radio" name="refer" id="inlineCheckbox1" value="option1"> EMT
                                        )
                                        </label>

                                    </div> 
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary">{{trans('form.submit')}}</button>
                            </div>

                        </div>
                    </div>
                </div>
                
                
                </form>
            </div>
        </div>

        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection


@section('js_footer')

<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.th.js')}}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker-thai.js')}}"></script>
<script src="{{asset('assets/plugins/select2/dist/js/select2.js')}}"></script>

<script type="text/javascript">
    $(function(){
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "dd-mm-yyyy",
            forceParse: false
        }).on("changeDate", function(e){
            //validator.element($(this));
        });

        $(".select2").select2();


        function formatRepo (repo) {
              if (repo.loading) return repo.text;
              var img = (repo.sex==1?"default-user-icon-profile.png":"default-user-icon-profile-woman.png");


              var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'><img src='" + '{{asset("assets/img")}}' +'/'+ (repo.image==undefined?img:repo.image) + "' /></div>" +
                "<div class='select2-result-repository__meta'>" +
                  "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

              if (repo.address) {
                markup += "<div class='select2-result-repository__description hide'>" + repo.address + "</div>";
              }

              markup += "<div class='select2-result-repository__statistics'>" +
                "<div class='select2-result-repository__forks'>HN " + repo.hn + "</div>" +
                "<div class='select2-result-repository__stargazers'>CID " + repo.cid + "</div>" +

              "</div>" +
              "</div></div>";

              return markup;
            }

        function formatRepoDiag (repo) {
              if (repo.loading) return repo.text;
              var img = "default-user-icon-profile.png";


              var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'><b>"+repo.id+"</b></div>" +

                "<div class='select2-result-repository__meta'>" +
                  "<div class='select2-result-repository__title'>" + repo.name + "</div>";

              markup += "<div class='select2-result-repository__forks '>" + (repo.tname==null?"":repo.tname) + "</div>";


              markup += "</div></div>";

              return markup;
            }

        function formatRepoHospcode (repo) {
              if (repo.loading) return repo.text;
              var img = "default-user-icon-profile.png";


              var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'><b>"+repo.id+"</b></div>" +

                "<div class='select2-result-repository__meta'>" +
                  "<div class='select2-result-repository__title'>" + repo.id + "</div>";

              markup += "<div class='select2-result-repository__forks '>" + (repo.id==null?"":repo.id) + "</div>";


              markup += "</div></div>";

              return markup;
            }

        function formatRepoSelection (repo) {
          return repo.id || repo.text;
        }

        function formatRepoSelectionDiag (repo) {
          return repo.id;// == ""?"":(repo.id + " : " + repo.name);
        }

        function formatRepoSelectionHospcode (repo) {
          return repo.id;// == ""?"":(repo.id + " : " + repo.name);
        }


        $("#select2_patient").select2({
            placeholder: "{{trans('form.new_patient')}}",
            allowClear: true,
            ajax: {
                url: "{{url('search/patient')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, params) {
                  params.page = params.page || 1;

                  return {
                    results: data.items,
                    pagination: {
                      more: (params.page * 30) < data.total_count
                    }
                  };
                },
                cache: true
              },
              escapeMarkup: function (markup) { return markup; },
              minimumInputLength: 1,
              templateResult: formatRepo,
              templateSelection: formatRepoSelection
        }).on("change", function (e) { 
            $.get("{{url('search/patient-detail')}}"+"/"+e.target.value, function( data ) {
                $("#fname").val(data.fname);
                $("#lname").val(data.lname);
                if(data.birthdate!="")
                {
                    var bd = data.birthdate.split("-");
                    $("#birthdate").val(bd[2]+"-"+bd[1]+"-"+bd[0]);
                }

                $("#pname").val(data.pname);
            });
        });


        $("#select2_refer_hospcode").select2({
            placeholder: "{{trans('form.new_patient')}}",
            allowClear: true,
            ajax: {
                url: "{{url('search/hospcode')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, params) {
                  params.page = params.page || 1;

                  return {
                    results: data.items,
                    pagination: {
                      more: (params.page * 30) < data.total_count
                    }
                  };
                },
                cache: true
              },
              escapeMarkup: function (markup) { return markup; },
              minimumInputLength: 1,
              templateResult: formatRepoHospcode,
              templateSelection: formatRepoSelectionHospcode
        });

        $("#select2_diag").select2({

            placeholder: "{{trans('form.search_diag')}}",
            maximumSelectionLength: 5,
            allowClear: true,
            ajax: {
                url: "{{url('search/diag')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, params) {
                  // parse the results into the format expected by Select2
                  // since we are using custom formatting functions we do not need to
                  // alter the remote JSON data, except to indicate that infinite
                  // scrolling can be used
                  params.page = params.page || 1;

                  return {
                    results: data.items,
                    pagination: {
                      more: (params.page * 30) < data.total_count
                    }
                  };
                },
                cache: true
              },
              escapeMarkup: function (markup) { return markup; },
              minimumInputLength: 1,
              templateResult: formatRepoDiag,
              templateSelection: formatRepoSelectionDiag 
        });

    });

</script>

@endsection