<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	protected function authenticated($request, $user)
    {
        if($request->user()->hasRole(Role::ADMIN_ROLE)){
            return redirect(route('dashboard'));
        } else if ($request->user()->hasRole(Role::EMPLOYER_ROLE)){
            return redirect('/home');
        } else if ($request->user()->hasRole(Role::EMPLOYEE_ROLE)){
            return redirect('/home');
        } else {
			return redirect('/');
		}
    }

}
