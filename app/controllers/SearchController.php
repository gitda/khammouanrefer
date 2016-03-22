<?php


class SearchController extends BaseController
{
	public function getPatient()
    {
    	$search = Input::get('q');

    	$items = Patient::where(DB::raw('concat(fname," ",lname)'),'like','%'.$search.'%')
    			->orWhere('cid','like','%'.$search.'%')
    			->orWhere('hn','like','%'.$search.'%')
				->select('id','sex','hn','cid',DB::raw('concat(fname," ",lname) as full_name'),'addrpart as address','patient_image as image')->take(10)->get();


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

    public function getPatientDetail($id)
    {
    	$patient = Patient::find($id);
    	return $patient;
    }
}
