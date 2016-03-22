<?php

namespace Administrators;
use View;
use User;
use Input;
use Sentry;
use Crypt;
use Redirect;
use Group;
use Hospcode;
use UserGroup;
use DB;

class UserController extends \BaseController
{

	public function getIndex()
    {
    	$user = DB::table('users')
    			->select('users.id','users.first_name','users.last_name','hospcode.hospcode','hospcode.name as hospname','groups.name as group_name','users.activated')
    			->leftJoin('hospcode','hospcode.hospcode','=','users.hospcode')
    			->leftJoin('users_groups','users_groups.user_id','=','users.id')
    			->leftJoin('groups','users_groups.group_id','=','groups.id')
    			->get();
    	

    	return View::make('administrators.user.index')
    				->with(compact('user'));
    }


    public function getNew($id = null)
    {
    	$group = Group::orderBy(DB::raw('name="User"'),"asc")->get();
    	$hospcode = Hospcode::all();
    	$user = new User();
    	$user_group = "";

    	if($id!=null)
    	{
    		//$user = User::find(Crypt::decrypt($id)); 
    		$user = Sentry::findUserByID(Crypt::decrypt($id));
    		$sentry_group = $user->getGroups();

    		if(count($sentry_group)>0)
    			$user_group = $sentry_group[0]->id;
    	}

    	return View::make('administrators.user.new')
    				->with(compact('user','group','hospcode','user_group'));
    }

    public function postNew()
    {
    	$input = Input::all();

    	$user = User::find($input['id']);
    	if($user==null)
    	{
    		$user = Sentry::createUser(array(
		        'email'     => $input['email'],
		        'password'  => $input['password']
		    ));
    	}

    	$user->hospcode = $input['hospcode'];
    	$user->first_name = $input['first_name'];
    	$user->last_name = $input['last_name'];
    	$user->activated = Input::has('activated');
    	
    	$user->save();

    	UserGroup::where('user_id',$user->id)->delete();

    	$user = Sentry::findUserById($user->id);
    	$group = Sentry::findGroupById($input['group']);
    	$user->addGroup($group);

    	$user->save();

    	return Redirect::to('administrator/user');
    }

}
