<?php


class ReferoutController extends BaseController
{
	public function getIndex()
    {
    	

    	return View::make('referouts.index');

    }

    public function getNew()
    {
        $hospcode = Hospcode::all();
    	
    	$patient = new Patient();
    	$refer = new Refer();
    	$pnames = Pname::all();

    	$refer->refer_date = Date('Y-m-d');
    	$refer->refer_time = Date('H:i:s');



    	return View::make('referouts.new')
    			->with(compact('pnames','refer','patient','hospcode'));
    }

    public function postNew()
    {
    	return Input::all();
    }

}
