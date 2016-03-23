<?php


class ReferoutController extends BaseController
{
	public function getIndex()
    {
    	

    	return View::make('referouts.index');

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
        $address = new PatientAddress();
        $nationality = Nationality::all();
        $religion = Religion::all();
        $marrystatus = MarryStatus::all();
        $bloodgpr = BloodGroup::all();
        $occupation = Occupation::all();



        $doctor = Doctor::hospcode($hcode)->active()->get();
        $ward = Ward::hospcode($hcode)->active()->get();

    	$refer->refer_date = Date('Y-m-d');
    	$refer->refer_time = Date('H:i');



    	return View::make('referouts.new')
    			->with(compact('refer_form',
                    'hcode',
                    'pnames',
                    'refer',
                    'patient',
                    'hospcode',
                    'rfrcs',
                    'doctor',
                    'ward',
                    'address',
                    'nationality',
                    'religion',
                    'marrystatus',
                    'bloodgpr',
                    'occupation'
                    ));
    }

    public function postNew()
    {
    	return Input::all();
    }

}
