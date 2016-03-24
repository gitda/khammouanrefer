<?php

use Carbon\Carbon;

class ReferinController extends BaseController
{


	public function getIndex()
	{

		$referlist = Refer::where('refer_hospcode','=',Sentry::getUser()->hospcode)
                    ->orderBy(DB::raw('is_read=0'),'desc')
                    ->orderBy('refer_date','desc')
                    ->orderBy('refer_time','desc')
                    ->get();


		return View::make('referins.index')
					->with(compact('referlist'));
	}

	public function gerView($_uuid)
	{
		$uuid = Crypt::decrypt($_uuid);
        $refer = Refer::find($uuid);
		$refer->is_read = 1;
        $refer->save();
	}


}