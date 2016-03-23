<?php

namespace Auth;

use View;
use Input;
use Sentry;
use Redirect;

class AuthController extends \BaseController
{
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
    }

    
    public function getIndex()
    {
        
    }

    public function getLogin()
    {
        // $credentials = [
        //     'email'    => 'test',
        //     'password' => 'test',
        // ];
        return View::make('auth.login');
    }
    public function postLogin()
    {
        try
        {
            // Login credentials
            $credentials = array(
                'email'    => Input::get('loginname'),
                'password' => Input::get('password'),
            );

            // Authenticate the user
            $user = Sentry::authenticate($credentials, false);

            return Redirect::to('home');
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $msg = 'Login field is required.';
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $msg = 'Password field is required.';
        }
        catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            $msg = 'Wrong password, try again.';
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $msg = 'User was not found.';
        }
        catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            $msg = 'User is not activated.';
        }

        // The following is only required if the throttling is enabled
        catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            $msg = 'User is suspended.';
        }
        catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            $msg = 'User is banned.';
        }

        return Redirect::to('auth/login')
                        ->withError($msg);
        
    }

    public function getLogout()
    {
        Sentry::logout();
        return Redirect::to('auth/login');
    }


}
