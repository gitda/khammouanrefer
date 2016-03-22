<?php

namespace Administrators;

use View;

class AdministratorController extends \BaseController
{
	public function index()
    {
    	return View::make('administrators.index');
    }

    public function getNew()
    {
    	return View::make('administrators.user.new');
    }

}
