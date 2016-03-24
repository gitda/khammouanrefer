<?php

use Carbon\Carbon;

class ReferoutController extends BaseController
{
	public function getIndex()
    {
        $referlist = Refer::where('refer_from_hospcode','=',Sentry::getUser()->hospcode)
                    ->orderBy(DB::raw('is_read=0'),'desc')
                    ->orderBy('refer_date','desc')
                    ->orderBy('refer_time','desc')
                    ->get();


    	return View::make('referouts.index')
                    ->with(compact('referlist'));
    }

    public function getNew()
    {
        $user_hcode = Sentry::getUser()->hospcode;

        $hcode = $user_hcode;

        $refer_form  = $hcode.":".Hospcode::where('hospcode','=',$hcode)->first()->name;

        $hospcode = Hospcode::where('hospcode','<>',$hcode)->get();
    	$rfrcs = ReferCause::all();
    	$patient = new Patient();
    	$refer = new Refer();
    	$pnames = Pname::all();
        $address = new PatientAddress;
        $nationality = Nationality::all();
        $religion = Religion::all();
        $marrystatus = MarryStatus::all();
        $bloodgpr = BloodGroup::all();
        $occupation = Occupation::all();
        $document = DB::table('refer_document_require')->get();
        $intendant = DB::table('refer_intendant')->get();
        $contact_position = DB::table('contact_position')->get();

        $doctor = Doctor::hospcode($hcode)->active()->get();
        $ward = Ward::hospcode($hcode)->active()->get();

    	$refer->refer_date = Date('Y-m-d');
    	$refer->refer_time = Date('H:i');


    	return View::make('referouts.new')
    			->with(
            compact('address',
                    'bloodgpr',
                    'contact_position',
                    'doctor',
                    'document',
                    'hcode',
                    'hospcode',
                    'intendant',
                    'marrystatus',
                    'nationality',
                    'occupation',
                    'patient',
                    'pnames',
                    'refer',
                    'refer_form',
                    'religion',
                    'rfrcs',
                    'ward'
            ));
    }

    public function postNew()
    {
        $uuid = "";

        $input = Input::all();
        $patient = $this->CreateOrUpdatePatient($input);
        

        $refer = Refer::firstOrNew(['refer_uuid'=>$uuid]);

        $refer->refer_date = Carbon::createFromFormat("d-m-Y",$input['refer_date'])
                            ->format('Y-m-d');
        $refer->refer_time = $input['refer_time'].":00";

        $refer->refer_from_hospcode = $input['refer_from_hcode'];
        $refer->refer_hospcode = $input['refer_hospcode'];
        $refer->hn = $input['hn'];
        $refer->patient_id = $patient->id;

        $refer->pname = Pname::find($input['pname'])->name;
        $refer->fname = Input::get('fname');
        $refer->lname = Input::get('lname');
        $refer->age = 0;//calculate from pateint birthdate Input::get('lname');
        $refer->diag_text = Input::get('diag_text');
        $refer->oprt_text = Input::get('oprt_text');
        $refer->trauma = Input::get('trauma');
        $refer->rfrcs = Input::get('rfrcs');
        $refer->doctor_id = Input::get('doctor');
        $refer->admit_ward = Input::get('ward');
        $refer->admit_cc_text = Input::get('admit_cc_text');
        $refer->treat_current_text = Input::get('treat_current_text');
        $refer->treat_past_text = Input::get('treat_past_text');

        $refer->bps = Input::get('bps');
        $refer->bpd = Input::get('bpd');
        $refer->p = Input::get('p');
        $refer->rr = Input::get('rr');
        $refer->t = Input::get('t');
        $refer->spo2 = Input::get('spo2');
        $refer->gcse = Input::get('gcse');
        $refer->v = Input::get('v');
        $refer->m = Input::get('m');
        $refer->doctor_consult = Input::get('doctor_consult');
        $refer->refer_intendant = Input::get('refer_intendant');
        $refer->refer_problem = Input::get('refer_problem');
        $refer->contact_1 = Input::get('contact_1');
        $refer->contact_2 = Input::get('contact_2');
        $refer->contact_position_1 = Input::get('contact_position_1');
        $refer->contact_position_2 = Input::get('contact_position_2');
        $refer->save();


        if(Input::has('icd10')){
            $this->updateDiag($refer->refer_uuid, Input::get('icd10'));
        }
        if(Input::has('icd9')){
            $this->updateOprt($refer->refer_uuid, Input::get('icd9')); 
        }
        
    	return Redirect::to('referout');
    }


    public function getEdit($uuid)
    {
        $uuid = Crypt::decrypt($uuid);
        $refer = Refer::find($uuid);


        $user_hcode = Sentry::getUser()->hospcode;

        $hcode = $user_hcode;

        $refer_form  = $hcode.":".Hospcode::where('hospcode','=',$hcode)->first()->name;

        $hospcode = Hospcode::where('hospcode','<>',$hcode)->get();
        $rfrcs = ReferCause::all();
        $patient = Patient::find($refer->patient_id);
        
        $pnames = Pname::all();
        $address = PatientAddress::find($refer->patient_id);
        $nationality = Nationality::all();
        $religion = Religion::all();
        $marrystatus = MarryStatus::all();
        $bloodgpr = BloodGroup::all();
        $occupation = Occupation::all();
        $document = DB::table('refer_document_require')->get();
        $intendant = DB::table('refer_intendant')->get();
        $contact_position = DB::table('contact_position')->get();

        $doctor = Doctor::hospcode($hcode)->active()->get();
        $ward = Ward::hospcode($hcode)->active()->get();

        $refer->refer_date = Date('Y-m-d');
        $refer->refer_time = Date('H:i');

        return View::make('referouts.new')
                ->with(
            compact('address',
                    'bloodgpr',
                    'contact_position',
                    'doctor',
                    'document',
                    'hcode',
                    'hospcode',
                    'intendant',
                    'marrystatus',
                    'nationality',
                    'occupation',
                    'patient',
                    'pnames',
                    'refer',
                    'refer_form',
                    'religion',
                    'rfrcs',
                    'ward'
            ));
    }
    private function updateDiag($uuid,$icd10)
    {
        ReferDiag::destroy($uuid);

        foreach ($icd10 as $key => $val) {
            $rd = new ReferDiag;
            $rd->refer_uuid = $uuid;
            $rd->icd10      = $val;
            $rd->diagtype   = $key;
            $rd->save();
        }
    }
    private function updateOprt($uuid,$icd9)
    {
        ReferOprt::destroy($uuid);

        foreach ($icd9 as $key => $val) {
            $rd = new ReferOprt;
            $rd->refer_uuid = $uuid;
            $rd->icd9cm     = $val;
            $rd->save();
        }
    }

    private function CreateOrUpdatePatient($input)
    {
        $patient = new Patient;
        if($input['patient_id']!="")
        {
            $patient = Patient::find($input['patient_id']);
        }

        $patient->hospcode = Sentry::getUser()->hospcode;
        $patient->sex = Input::get('sex');
        $patient->pname = null;

        $patient->bloodgrp = $input['bloodgrp'];

        $patient->pname = null;
        if(Input::has('pname'))
        {
            $patient->pname = Pname::find($input['pname'])->name;
        }
        
        $patient->fname = $input['fname'];
        $patient->lname = $input['lname'];

        try {
        $patient->birthdate = Carbon::createFromFormat("d-m-Y",$input['birthdate'])
                            ->format('Y-m-d');
        } catch(InvalidArgumentException $x) {
            $patient->birthdate = null;
        }

        $patient->marrystatus = $input['marrystatus'];
        $patient->citizenship = $input['nationality'];
        $patient->religion    = $input['religion'];
        $patient->occupation  = $input['occupation'];
        $patient->drugallergy = null;//$input['drugallergy'];
        $patient->addrpart = null;//$input['drugallergy'];
        $patient->moo = null;
        $patient->road = null;
        $patient->soi = null;
        $patient->chwpart = null;  ///แยก
        $patient->amppart = null;  ///แยก
        $patient->tmbpart = null;  ///แยก
        $patient->tel = $input['tel'];  ///แยก
        $patient->father_name = null;
        $patient->patient_image = null;
        $patient->mother_name = null;
        $patient->save();

        $address = PatientAddress::firstOrNew(['patient_id'=>$patient->id]);

        $address->chwpart_text = $input['chwpart_text'];
        $address->amppart_text = $input['amppart_text'];
        $address->tmbpart_text = $input['tmbpart_text'];
        $address->save();


        $hn = PatientHn::firstOrNew(['hospcode'=>Sentry::getUser()->hospcode,
                                    'patient_id'=>$patient->id]);
        $hn->hn = $input['hn'];
        $hn->save();

        return $patient;
    }

}
