@extends('templates.master')


@section('js_header')

<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/datepicker/datepicker3.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/dist/css/select2.css')}}">


@stop

@section('content')


     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-10">
        <div class="panel panel-primary">
            <div class="panel-heading">
                ข้อมูลส่งต่อ
            </div>
            <div class="panel-body">
                <form action="" method="POST" class="form-horizontal">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <fieldset>



                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-xs-1 control-label">Date</label>
                                <div class="col-xs-2">
                                  <input type="text" name="refer_date"
                                   class="form-control datepicker"
                                   placeholder="dd-mm-yyyy"
                                   value="{{\Carbon\Carbon::createFromFormat('Y-m-d',$refer->refer_date)->format('d-m-Y')}}">
                                </div>

                                <label class="col-xs-1 control-label">Time</label>
                                <div class="col-xs-1">
                                  <input type="text" name="refer_time" class="form-control"
                                  value="{{$refer->refer_time}}">
                                </div>

                                <label class="col-xs-2 control-label">Referral Form</label>
                                <div class="col-xs-5">

                                    <p class="form-control-static">
                                        {{$refer_form}}
                                        <input type="hidden" name="refer_from_hcode" value="{{$hcode}}"></input>
                                    </p>

                                </div>

                              </div>
                              <div class="form-group">
                                <label class="col-xs-offset-5 col-xs-2 control-label">Referral To</label>
                                <div class="col-xs-5">

                                    <select name="refer_hospcode" class="form-control select2">
                                        @foreach($hospcode as $h)
                                        <option value="{{$h->hospcode}}">{{$h->hospcode}} : {{$h->name}}</option>
                                        @endforeach

                                    </select>

                                </div>

                              </div>
                              

                              <!-- Text input-->
                                <hr/>

                              <div class="form-group">
                                <label class="col-xs-1 control-label">Search</label>

                                <div class="col-xs-4">
                                <select name="patient_id" id="select2_patient" class="form-control"><option value="" selected="selected"></option></select>
                                </div>
                                <label class="col-xs-1 control-label">SEX</label>
                                <label class="radio-inline">
                                  <input type="radio" id="sex_m" name="sex" value="1"
                                  @if($patient->sex==1) {{"checked"}} @endif> ชาย
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" id="sex_w" name="sex" value="2"
                                  @if($patient->sex==2) {{"checked"}} @endif> หญิง
                                </label>
                              </div>
                              

                              <div class="form-group">
                                <label class="col-xs-1 control-label">PREFIX</label>
                                <div class="col-xs-2">
                                  <select id="pname" name="pname" class="form-control">
                                    @foreach($pnames as $pname)
                                    <option value="{{$pname->provis_code}}"
                                    @if($pname->provis_code==$patient->pname){{'selected'}}@endif>{{$pname->name}}</option>
                                    @endforeach
                                  </select>
                                </div>

                                <label class="col-xs-1 control-label">F.NAME</label>
                                <div class="col-xs-3">
                                  <input type="text" id="fname" name="fname" class="form-control"
                                  value="{{$patient->fname}}">
                                </div>

                                <label class="col-xs-1 control-label">L.NAME</label>
                                <div class="col-xs-3">
                                  <input type="text" id="lname" name="lname" class="form-control"
                                  value="{{$patient->lname}}">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-1 control-label">HN</label>
                                    <div class="col-xs-2">
                                      <input type="text" id="hn" name="hn" class="form-control"
                                      value="{{$patient->hn}}">
                                    </div>
                                  <label class="col-xs-1 control-label">BIRTH</label>
                                    <div class="col-xs-2">
                                      <input type="text" id="birthdate" name="birthdate" class="form-control datepicker"
                                      value="{{$patient->birthdate}}">
                                    </div>
                              </div>

                              <hr/>
                              <!-- Text input-->
                            <div class="row">
                                    
                                <div class="col-xs-6">
                                    <div class="form-group">

                                    <label class="col-xs-2 control-label">ICD10</label>
                                    <div class="col-xs-10">
                                    <select name="icd10[]" id="select2_diag" class="form-control" multiple="" ></select>
                                    </div>

                                    </div>
                                    <div class="form-group">

                                    <label class="col-xs-2 control-label">Diagnosis Text.</label>
                                    <div class="col-xs-10">
                                    <textarea name="diag_text" class="form-control" rows="3">{{$refer->diag_text}}</textarea>
                                    </div>

                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">

                                    <label class="col-xs-2 control-label">ICD9</label>
                                    <div class="col-xs-10">
                                    <select name="icd9[]" id="select2_op" class="form-control select2" multiple="" ></select>
                                    </div>

                                    </div>
                                    <div class="form-group">

                                    <label class="col-xs-2 control-label">Operation</label>
                                    <div class="col-xs-10">
                                    <textarea name="oprt_text" class="form-control" rows="3">{{$refer->oprt_text}}</textarea>
                                    </div>

                                    </div>
                                </div>

                            </div>
                            <hr/>
                              <div class="form-group">
                                <label class="col-xs-1 control-label"></label>
                                <div class="col-xs-11">
                                    
                                    <label class="control-label"><input type="radio" name="trauma"  value="1"
                                    @if($refer->trauma==1) {{"checked"}} @endif> Trauma
                                    </label>

                                    <label class="control-label"><input type="radio" name="trauma" 
                                    value="0"
                                    @if($refer->trauma==0) {{"checked"}} @endif> Non-Trauma  </label>                           
                                </div>
                                  
                              </div>

                              <div class="form-group">
                                <label class="col-xs-1 control-label">Cause</label>
                                <div class="col-xs-5">
                                  <select name="rfrcs" class="form-control select2">
                                    <option value="">--</option>
                                    @foreach($rfrcs as $r)

                                    <option value="{{$r->rfrcs}}"
                                    @if($r->rfrcs==$refer->rfrcs) {{'selected'}} @endif>{{$r->name}}</option>
                                    @endforeach

                                    </select>
                                </div>
                              </div>



                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-xs-1 control-label">Doctor</label>
                                <div class="col-xs-5">
                                  <select name="doctor" class="form-control select2">
                                    <option value="">--</option>
                                    @foreach($doctor as $d)

                                    <option value="{{$d->code}}"
                                    @if($d->code==$refer->doctor_id) {{'selected'}} @endif>{{$d->name}}</option>
                                    @endforeach

                                    </select>
                                </div>

                                <label class="col-xs-2 control-label">Adm Ward</label>
                                <div class="col-xs-2">
                                  <select name="ward" class="form-control select2">
                                    <option value="">--</option>
                                    @foreach($ward as $w)

                                    <option value="{{$w->ward}}"
                                    @if($w->ward==$refer->admit_ward) {{'selected'}} @endif>{{$w->name}}</option>
                                    @endforeach

                                  </select>
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

                            <div class="tab-pane fade active in" id="patient_info">
                                <div class="row">
                                    <div class="col-xs-12">
                                    <h4></h4>
<form class="form-horizontal">
    <div class="form-group">
    <label class="col-sm-2 control-label">หมู่เลือด</label>
    <div class="col-sm-2">
      <select id="bloodgrp" name="bloodgrp" class="form-control select2">
        <option value="">--</option>
        @foreach($bloodgpr as $b)

        <option value="{{$b->name}}"
        @if($b->name==$patient->bloodgrp) {{'selected'}} @endif >{{$b->name}}</option>
        @endforeach

        </select>
    </div>
  </div>
  <hr/>
  <div class="form-group">
    <label class="col-sm-2 control-label">บ้าน</label>
    <div class="col-sm-4">
      <input type="text" id="tmbpart_text" name="tmbpart_text" value="{{$address->tmbpart_text}}" class="form-control" >
    </div>

    <label class="col-sm-1 control-label">เมือง</label>
    <div class="col-sm-2">
      <input type="text" id="amppart_text" name="amppart_text" value="{{$address->amppart_text}}" class="form-control" >
    </div>

    <label class="col-sm-1 control-label">แขวง</label>
    <div class="col-sm-2">
      <input type="text" id="chwpart_text" name="chwpart_text" value="{{$address->chwpart_text}}" class="form-control" >
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">เบอรโทร</label>
    <div class="col-sm-4">
      <input type="text" id="tel" name="tel" value="{{$patient->tel}}" class="form-control" >
    </div>
    <label class="col-sm-1 control-label">สัญชาติ</label>
    <div class="col-sm-2">
        <select id="nationality" name="nationality" class="form-control select2">
        <option value="">--</option>
        @foreach($nationality as $n)

        <option value="{{$n->nationality}}"
        @if($n->nationality==$patient->citizenship) {{'selected'}} @endif>{{$n->name}}</option>
        @endforeach

        </select>
    </div>
    <label class="col-sm-1 control-label">ศาสนา</label>
    <div class="col-sm-2">
      <select id="religion" name="religion" class="form-control select2">
        <option value="">--</option>
        @foreach($religion as $r)

        <option value="{{$r->religion}}"
        @if($r->religion==$patient->religion) {{'selected'}} @endif>{{$r->name}}</option>
        @endforeach

        </select>
    </div>

  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">สถานะภาพ</label>
    <div class="col-sm-2">
     <select id="marrystatus" name="marrystatus" class="form-control select2">
        <option value="">--</option>
        @foreach($marrystatus as $r)

        <option value="{{$r->marrystatus_id}}"
        @if($r->marrystatus_id==$patient->marrystatus) {{'selected'}} @endif>{{$r->marrystatus_name}}</option>
        @endforeach

        </select>
    </div>
    <label class="col-sm-1 control-label">อาชีพ</label>
    <div class="col-sm-2">
     <select id="occupation" name="occupation" class="form-control select2">
        <option value="">--</option>
        @foreach($occupation as $o)

        <option value="{{$o->occupation}}"
        @if($o->occupation==$patient->occupation) {{'selected'}} @endif>{{$o->name}}</option>
        @endforeach

        </select>
    </div>


  </div>

</form>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane" id="home">
                                <h4></h4>
                                <div class="form-horizontal">
                                    <fieldset>
                                        <textarea name="admit_cc_text" class="form-control" rows="5">{{$refer->admit_cc_text}}</textarea>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile">
                                <h4></h4>
                                <div class="table-responsive">
                                    <textarea class="form-control" name="treat_current_text" rows="5">{{$refer->treat_current_text}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="messages">
                                <h4></h4>
                                <div class="table-responsive">
                                    <textarea class="form-control" name="treat_past_text" rows="5">{{$refer->treat_past_text}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings">
                                <h4></h4>
                                <div class="table-responsive">
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp V/S ก่อนออกมา BP</label>
                                                <input type="text" class="text-center" 
                                                style="width:50px"
                                                name="bps" 
                                                value="{{$refer->bps}}">/<input type="text" class="text-center" style="width:50px"
                                                name="bpd" 
                                                value="{{$refer->bpd}}">
                                        <label>mmHg</label>
                                        <label>P</label>
                                            <input type="text" class="text-center" style="width:80px"
                                            name="p" 
                                            value="{{$refer->p}}">
                                        <label>RR</label>
                                            <input type="text" class="text-center" style="width:80px"
                                            name="rr" 
                                            value="{{$refer->rr}}">
                                        <label>T</label>
                                            <input type="text" class="text-center" style="width:80px"
                                            name="t" 
                                            value="{{$refer->t}}">
                                        <label>spo2</label>
                                            <input type="text" class="text-center" style="width:80px"
                                            name="spo2" 
                                            value="{{$refer->spo2}}">
                                        <label>GCS E</label>
                                            <input type="text" class="text-center" style="width:80px"
                                            name="gcse" 
                                            value="{{$refer->gcse}}">
                                        <label>V</label>
                                            <input type="text" class="text-center" style="width:80px"
                                            name="v" 
                                            value="{{$refer->v}}">
                                        <label>M</label>
                                            <input type="text" class="text-center" style="width:80px"
                                            name="m" 
                                            value="{{$refer->m}}">
                                    </div> 
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp แพทย์รับCONSULT ชื่อ</label>
                                                <input type="text" class="text-center" style="width:300px"
                                                name="doctor_consult" 
                                                value="{{$refer->doctor_consult}}">
                                        <label></label>
                                        <label>&nbsp&nbsp&nbsp จนท. นำส่ง</label>

                                            @foreach($intendant as $ri)
                                            <label><input type="radio" name="refer_intendant" value="{{$ri->refer_intendant_id}}"> {{$ri->refer_intendant_name}} </label>&nbsp;&nbsp;&nbsp;
                                            @endforeach
                                    </div> 
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp เอกสารผู้ป่วยที่จำเป็น</label>  
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            @foreach($document as $d)
                                            <label><input type="radio" name="refer_document_require" value="{{$d->refer_document_require_id}}"> {{$d->refer_document_require_name}} </label>&nbsp;&nbsp;&nbsp;
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp ปัญหาที่พบในขณะส่งต่อ</label>  
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="refer_problem" rows="5">{{$refer->refer_problem}}</textarea> 
                                    </div>
                                    <div class="form-group">
                                        <label>&nbsp&nbsp&nbsp ผู้ประสาน</label>
                                        <input type="text" style="width:300px" name="contact_1" value="{{$refer->contact_1}}">
                                        <label></label>
                                       
                                        (
                                            @foreach($contact_position as $cp)
                                            <label><input type="radio" name="contact_position_1" value="{{$cp->contact_position_id}}"
                                            @if($cp->contact_position_id==$refer->contact_position_1) {{'checked'}} @endif> {{$cp->contact_position_name}}</label>
                                            @endforeach
                                        )
                              

                                        <label>&nbsp&nbsp&nbsp ผู้ประสาน</label>
                                                <input type="text" style="width:300px" name="contact_2" value="{{$refer->contact_2}}">
                                        <label></label>
                                        (
                                            @foreach($contact_position as $cp)
                                            <label><input type="radio" name="contact_position_2" value="{{$cp->contact_position_id}}" @if($cp->contact_position_id==$refer->contact_position_1) {{'checked'}} @endif> {{$cp->contact_position_name}}</label>
                                            @endforeach
                                        )

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
                "<div class='select2-result-repository__forks'>HN " + (repo.hn||repo.patient_hn||'-') + "</div>" +
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

        function formatRepoOp (repo) {
              if (repo.loading) return repo.text;
              var img = "default-user-icon-profile.png";


              var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'><b>"+repo.id+"</b></div>" +

                "<div class='select2-result-repository__meta'>" +
                  "<div class='select2-result-repository__title'>" + repo.name + "</div>";


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
          return (repo.id != "" ? (repo.id + " : "+ repo.full_name):"") || repo.text;
        }

        function formatRepoSelectionDiag (repo) {
          return repo.id;// == ""?"":(repo.id + " : " + repo.name);
        }

        function formatRepoSelectionOp (repo) {
          return repo.id;
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
                $("#fname").val(data.patient.fname);
                $("#lname").val(data.patient.lname);
                if(data.patient.birthdate!="")
                {
                    var bd = data.patient.birthdate.split("-");
                    $("#birthdate").val(bd[2]+"-"+bd[1]+"-"+bd[0]);
                }

                $("#pname").val(data.patient.pname);
                $("#hn").val(data.patient.hn);

                $("#sex_m").prop("checked", false);
                $("#sex_w").prop("checked", false);

                if(data.patient.sex==1)
                {
                    $("#sex_m").prop("checked", true);
                }
                if(data.patient.sex==2)
                {
                    $("#sex_w").prop("checked", true);
                }

                console.log(data.patient.sex)

                $("#tel").val(data.patient.tel);
                $("#nationality").val(data.patient.citizenship).change();
                $("#religion").val(data.patient.religion).change();  
                $("#marrystatus").val(data.patient.marrystatus).change(); 
                $("#occupation").val(data.patient.occupation).change(); 
                 

                $("#bloodgrp").val(data.patient.bloodgrp).change();

                $("#tmbpart_text").val(data.address.tmbpart_text);
                $("#amppart_text").val(data.address.amppart_text);
                $("#chwpart_text").val(data.address.chwpart_text);
                
                
                


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

        $("#select2_op").select2({

            placeholder: "{{trans('form.search_diag')}}",
            maximumSelectionLength: 5,
            allowClear: true,
            ajax: {
                url: "{{url('search/icd9')}}",
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
              templateResult: formatRepoOp,
              templateSelection: formatRepoSelectionOp 
        });

    });

</script>

@endsection