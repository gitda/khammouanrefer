<?php


class SearchController extends BaseController
{
	public function getPatient()
    {
        $hospcode = Sentry::getUser()->hospcode;
    	$search = Input::get('q');

    	$items = Patient::leftJoin('patient_hn', function($join) use ($hospcode)
                {
                    $join->on('patient_hn.patient_id', '=', 'patient.id')
                    ->where('patient_hn.hospcode', '=', $hospcode);
                })
                ->where(DB::raw('concat(patient.fname," ",patient.lname)'),'like','%'.$search.'%')
    			->orWhere('patient.cid','like','%'.$search.'%')
    			->orWhere('patient.hn','like','%'.$search.'%')
                ->orWhere('patient_hn.hn','like','%'.$search.'%')
				->select('patient.id','patient.sex','patient.hn','patient_hn.hn as patient_hn','patient.cid',DB::raw('concat(patient.fname," ",patient.lname) as full_name'),'patient.addrpart as address','patient.patient_image as image')->take(10)->get();


    	$result = array('total_count'=>0,'items'=>$items);
    	return json_encode($result);
    }

    public function getHospcode()
    {
        $search = Input::get('q');

        $items = Hospcode::where('hospcode','like','%'.$search.'%')
                ->orWhere('name','like','%'.$search.'%')
                ->select('hospcode as id','name')->take(10)->get();


        $result = array('total_count'=>0,'items'=>$items);
        return json_encode($result);
    }

    public function getDiag()
    {
    	$search = Input::get('q');

    	$sql = "select code,name,tname from icd101 order by name limit 1";

    	if(strlen($search) == 2)
    	{
    		$pattern = "/^[a-zA-Z][0-9]{1}$/";
    		preg_match($pattern, $search, $matches, PREG_OFFSET_CAPTURE);

    		if($matches)
    		{
    			$items = Icd101::where('code','like', $search.'%')
    								->select('code as id','name','tname')
    								->orderBy('name','asc')
    								->take(50)->get();
    		}else{
    			$items = Icd101::where('name','like', '%'.$search.'%')
    								->orWhere('tname','like', '%'.$search.'%')
    								->orWhere('code','like', '%'.$search.'%')
    								->select('code as id','name','tname')
    								->orderBy('name','asc')
    								->take(50)->get();
    		}

    	}else{
    			$items = Icd101::where('name','like', '%'.$search.'%')
    								->orWhere('tname','like', '%'.$search.'%')
    								->orWhere('code','like', '%'.$search.'%')
    								->select('code as id','name','tname')
    								->orderBy('name','asc')
    								->take(10)->get();
    	}


    	$result = array('total_count'=>0,'items'=>$items);
    	return json_encode($result);
    }

    public function getIcd9()
    {
        $search = Input::get('q');
        $items = Icd9cm1::where('code','like', $search.'%')
                        ->orWhere('name','like', '%'.$search.'%')
                        ->select('code as id','name')
                        ->orderBy('name','asc')
                        ->take(50)->get();


        $result = array('total_count'=>0,'items'=>$items);
        return json_encode($result);
    }

    public function getPatientDetail($id)
    {
        $hospcode = Sentry::getUser()->hospcode;

    	$patient = Patient::find($id);

        $provis_code = Pname::where('name','=',$patient->pname)->first()->provis_code;

        $patient->pname = $provis_code;
        $patient->hn    = PatientHn::firstOrNew(['hospcode'=>$hospcode,
                                    'patient_id'=>$patient->id])->hn;

        $address = PatientAddress::find($patient->id);

    	return compact('patient','address');
    }
}
