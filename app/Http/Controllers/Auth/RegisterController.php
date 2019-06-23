<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Role;
use App\Traits\GeoLocation;
use App\Traits\Countries;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, GeoLocation, Countries;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	public function showRegistrationForm()
	{
		$countries = $this->getAllCountries();
    	return view('auth.register', compact(['countries']));
	}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address_1' => ['required'],
            'zip_code' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'contact_number' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
		try {
			$address = $data['address_1'] . ',' . $data['zip_code']. ',' . $data['city'] .',' .$data['country'];
			// $coordinates = $this->getLatLonByAddress($address);
			$user = User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'address_1' => $data['address_1'],
				'address_2' => isset($data['address_2'])??null,
				'city' => $data['city'],
				'zip_code' => $data['zip_code'],
				'country' => $data['country'],
				'contact_number' => $data['contact_number'],
				'longitude' => 0,//$coordinates ? $coordinates[0]->lon : 0,
				'latitude' => 0,//$coordinates ? $coordinates[0]->lat : 0,
				'password' => Hash::make($data['password']),
				'verified' => 0,
				'active' => 0,
			]);
		
		$user->roles()->attach(Role::where('name', 'employee')->first());
		return $user;
		} catch (Exception $e) {
			dd($e->getMessages());
		}
    }
}
