<?php


class ImmigrationController extends BaseController
{
	public function getIndex()
    {
    	return View::make('immigration.index');
    }

    public function getNew()
    {
    	return View::make('immigration.new');
    }

}
