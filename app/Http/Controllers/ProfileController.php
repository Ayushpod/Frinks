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
use Validator;
use Image;
use Illuminate\Support\Facades\Log;

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

		return view('profile.index', compact(['user']));
	}
	
	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'resume' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect(route('user.profile'))
                        ->withErrors($validator)
                        ->withInput();
        }
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

		$folder = 'resume/';  
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
	
	public function saveProfilePic(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			]);

			if ($validator->fails()) {
				return redirect(route('user.profile'))
							->withErrors($validator)
							->withInput();
			}

			$folder = 'profile/';  
			if($request->has('profile_pic')) {
				// $path = $request->file('avatar')->storeAs('avatars', $request->user()->id);
				//Upload original size image
				$profilePic = $request->file('profile_pic');
				$image = $profilePic;
				$profilePicName = $request->user()->id .'_'.$profilePic->getClientOriginalName();

				$path = $this->upload($profilePic, $folder, 'public', $profilePicName);
				//Resize Image to 100 by 100
				$destinationPath = storage_path('/app/public/profile/thumbnail');
				if (!file_exists($destinationPath)) {
					mkdir($destinationPath, 666, true);
				}
				$img = Image::make($image->getRealPath());

				$img->resize(100, 100, function ($constraint) {

					$constraint->aspectRatio();

				})->save($destinationPath.'/'.$profilePicName);

				//Save to database
				$user = Auth::user();
				$user->profile_pic = $path;
				$user->profile_pic_tumbnail = $destinationPath;
				$user->save();

				// $imageName = $resume->storeAs('public/resume/', $request->user()->id .'_'.$resume->getClientOriginalName());
			}
			return redirect(route('user.profile'));
		} catch (Exception $e) {
			Log::error('Something went wrong' . $e->getMessage(), ['id' => $request->user()->id]);
		}
	}
	
	
 
}
