<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
 
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
	
	public function login(Request $request)
	{
		$this->validator($request);

		$crendentials = [ 'email' => $request->email , 'password' => $request->password , 'verified' => 1, 'active' => 1];
		
	  	if(Auth::attempt($crendentials,$request->remember)) {	
			if($request->user()->hasRole(Role::ADMIN_ROLE)) {
            	return redirect(route('dashboard'));
			} else if ($request->user()->hasRole(Role::EMPLOYER_ROLE)) {
				return redirect('/home');
			} else if ($request->user()->hasRole(Role::EMPLOYEE_ROLE)) {
				return redirect('/profile');
			} else {
				return redirect('/');
			}
	  	}
	}
	
	private function validator(Request $request)
	{
		//validation rules.
		$rules = [
			'email'    => 'required|email|exists:users|min:5|max:191',
			'password' => 'required|string|min:4|max:255',
		];
		//custom validation error messages.
		$messages = [
			'email.exists' => 'These credentials do not match our records.',
		];
		//validate the request.
		$request->validate($rules,$messages);
	}

}
