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
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            echo 'Password field is required.';
        }
        catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            echo 'Wrong password, try again.';
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            echo 'User was not found.';
        }
        catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            echo 'User is not activated.';
        }

        // The following is only required if the throttling is enabled
        catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            echo 'User is suspended.';
        }
        catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            echo 'User is banned.';
        }

        return Redirect::to('home');
    }

    public function getLogout()
    {
        return Redirect::to('auth/login');
    }


}
