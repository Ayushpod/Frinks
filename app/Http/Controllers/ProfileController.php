<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadFile;
use App\Traits\GeoLocation;
use App\Traits\Countries;
use App\User;
use App\Repositories\UserRepositoryInterface;

class ProfileController extends Controller
{
	use UploadFile, GeoLocation, Countries;
	
		protected $userRepository;
	
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
		$this->userRepository = $userRepository;
    }
	public function index()
	{
		$user = Auth::user();
		$user = $this->userRepository->search(5);
		dd($user);
		
		return view('profile.index', compact(['user']));
	}
	
	public function update(Request $request)
	{
		$street = $request->get('address_1');
		$zip_code = $request->get('zip_code');
		$city = $request->get('city');
		$country = $request->get('country');
		$add = $street . ','. $city .','. $country;
		$add = 'Almada Forum, 2810-354 Almada';
		dd($this->getLatLonByAddress($add));
		// $request()->validate([

		// 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

		// ]);

		$folder = 'public/resume/';  
		if($request->has('resume')) {
			// $path = $request->file('avatar')->storeAs('avatars', $request->user()->id);
			$resume = $request->file('resume');
			$resumeName = $request->user()->id .'_'.$resume->getClientOriginalName();
			$path = $this->upload($resume, $folder, 'public', $resumeName);
			
        	// $imageName = $resume->storeAs('public/resume/', $request->user()->id .'_'.$resume->getClientOriginalName());
		}
		
		if($request->has('resume')) {
			// $path = $request->file('avatar')->storeAs('avatars', $request->user()->id);
			$resume = $request->file('resume');
			$resumeName = $request->user()->id .'_'.$resume->getClientOriginalName();
			$path = $this->upload($resume, $folder, 'public', $resumeName);
			
        	// $imageName = $resume->storeAs('public/resume/', $request->user()->id .'_'.$resume->getClientOriginalName());
		}
		
		
		

  

        // $request()->image->move(public_path('images'), $imageName);
		dd($path);
		$user = Auth::user();
		
	}
	
	
 
}
