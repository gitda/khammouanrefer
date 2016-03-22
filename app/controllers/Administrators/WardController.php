<?php

namespace Administrators;

use View;
use Hospcode;
use Input;
use Ward;
use Crypt;
use Redirect;

class WardController extends \BaseController
{
	public function getIndex()
    {
    	$ward  = Ward::leftJoin('hospcode','hospcode.hospcode','=','ward.hospcode')
    				->select('ward.*','hospcode.name as hospname')
    				->get();
    	return View::make('administrators.ward.index')
    				->with(compact('ward'));
    }

    public function getNew($code = null)
    {
    	$hospcode = Hospcode::all();
    	$ward = new Ward;
    	if($code!=null)
    	{
    		$ward = Ward::find(Crypt::decrypt($code));
    	}

    	return View::make('administrators.ward.new')
    			->with(compact('hospcode','ward'));
    }

    public function postNew()
    {
    	$input = Input::all();
    	$ward  = new Ward;

    	if($input['code']!="")
    	{
    		$ward  = Ward::find($input['code']);
    	}

    	$ward->name = Input::get('name');
    	$ward->hospcode = Input::get('hospcode');
    	$ward->active = (Input::get('active')=="1"?"Y":"N");
    	$ward->save();
        
    	return Redirect::to('administrator/ward');
    }

}
