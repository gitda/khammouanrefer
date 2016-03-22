<?php

namespace Administrators;

use View;
use Hospcode;
use Input;
use Ward;
use Crypt;
use Redirect;
use ReferCause;

class ReferCauseController extends \BaseController
{
    public function getIndex()
    {
        $rfrcs  = ReferCause::all();

        return View::make('administrators.rfrcs.index')
                    ->with(compact('rfrcs'));
    }

    public function getNew($code = null)
    {
        $rfrcs = new ReferCause;
        if($code!=null)
        {
            $rfrcs = ReferCause::find(Crypt::decrypt($code));
        }

        return View::make('administrators.rfrcs.new')
                ->with(compact('rfrcs'));
    }

    public function postNew()
    {
        $input = Input::all();
        $rfrcs  = new ReferCause;

        if($input['code']!="")
        {
            $rfrcs  = ReferCause::find($input['rfrcs']);
        }

        $rfrcs->name = Input::get('name');
        $rfrcs->rfrcs = Input::get('rfrcs');
        $rfrcs->save();
        
        return Redirect::to('administrator/rfrcs');
    }

}
