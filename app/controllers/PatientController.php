<?php


class PatientController extends BaseController
{
	public function getIndex()
    {
    	return View::make('patients.index');
    }

}
