<?php

namespace Administrators;

use View;
use Hospcode;
use Input;
use Doctor;
use Crypt;
use Redirect;
use Sentry;

class DoctorController extends \BaseController
{
	public function getIndex()
    {
        $user = Sentry::getUser();

    	$doctor  = Doctor::leftJoin('hospcode','hospcode.hospcode','=','doctor.hospcode')
    				->select('doctor.*','hospcode.name as hospname');

        if (!$user->hasAccess("admin"))
        {
            $doctor->where('doctor.hospcode','=',$user->hospcode);
        }

    	$doctor = $doctor->get();
    	return View::make('administrators.doctor.index')
    				->with(compact('doctor'));
    }

    public function getNew($code = null)
    {
        $user = Sentry::getUser();

    	$hospcode = Hospcode::all();
        if (!$user->hasAccess("admin"))
        {
            $hospcode = Hospcode::where('hospcode','=',$user->hospcode)->get();
        }

    	$doctor = new Doctor;
    	if($code!=null)
    	{
    		$doctor = Doctor::find(Crypt::decrypt($code));
    	}

    	return View::make('administrators.doctor.new')
    			->with(compact('hospcode','doctor'));
    }

    public function postNew()
    {
    	$input = Input::all();
    	$doctor  = new Doctor;

    	if($input['code']!="")
    	{
    		$doctor  = Doctor::find($input['code']);
    	}
    	$doctor->name = Input::get('name');
    	$doctor->licenseno = Input::get('licenseno');
    	$doctor->hospcode = Input::get('hospcode');
    	$doctor->active = (Input::get('active')=="1"?"Y":"N");
    	$doctor->cid = Input::get('cid');

    	$doctor->save();


    	return Redirect::to('administrator/doctor');
    }

}
