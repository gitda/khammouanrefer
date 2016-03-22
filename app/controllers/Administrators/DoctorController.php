<?php

namespace Administrators;

use View;
use Hospcode;
use Input;
use Doctor;
use Crypt;
use Redirect;

class DoctorController extends \BaseController
{
	public function getIndex()
    {
    	$doctor  = Doctor::leftJoin('hospcode','hospcode.hospcode','=','doctor.hospcode')
    				->select('doctor.*','hospcode.name as hospname')
    				->get();
    	return View::make('administrators.doctor.index')
    				->with(compact('doctor'));
    }

    public function getNew($code = null)
    {
    	$hospcode = Hospcode::all();
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
