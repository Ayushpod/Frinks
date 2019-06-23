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
use Mail;
use App\Mail\MailNotify;

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
		$postData = $request->all();
		$validator = Validator::make($request->all(), [
            'resume' => 'mimes:pdf|max:2048',
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
		// $latlon = $this->getLatLonByAddress($add);


		$folder = 'resume/';  
		if($request->has('resume')) {
			// $path = $request->file('avatar')->storeAs('avatars', $request->user()->id);
			$resume = $request->file('resume');
			$resumeName = $request->user()->id .'_'.$resume->getClientOriginalName();
			$path = $this->upload($resume, $folder, 'public', $resumeName);
			
        	// $imageName = $resume->storeAs('public/resume/', $request->user()->id .'_'.$resume->getClientOriginalName());
			$postData['resume'] = $resumeName;
		}

        // $request()->image->move(public_path('images'), $imageName);
		$user = Auth::user();
		$user->name = $postData['name'];
		$user->email = $postData['email'];
		$user->address_1 = $postData['address_1'];
		$user->address_2 = $postData['address_2'];
		$user->zip_code = $postData['zip_code'];
		$user->city = $postData['city'];
		$user->country = $postData['country'];
		$user->skills = $postData['skills'];
		$user->job_looking_for = $postData['job_looking_for'];
		if (!empty($postData['resume'])) {			
			$user->resume = $postData['resume'];
		}
		// $user->latitude = $latlon[0]->lat;
		// $user->longitude = $latlon[0]->lon;
		$user->save();
		return redirect(route('user.profile'));
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

			$folder = 'profile';  
			if($request->has('profile_pic')) {
				// $path = $request->file('avatar')->storeAs('avatars', $request->user()->id);
				//Upload original size image
				$profilePic = $request->file('profile_pic');
				$image = $profilePic;
				$profilePicName = $request->user()->id .'_'.$profilePic->getClientOriginalName();

				$path = $this->upload($profilePic, $folder, 'public', $profilePicName);
				//Resize Image to 100 by 100
				$destinationPath = storage_path('app/public/profile/thumbnail');
				if (!file_exists($destinationPath)) {
					mkdir($destinationPath, 666, true);
				}
				$img = Image::make($image->getRealPath());

				$img->resize(100, 100, function ($constraint) {

					$constraint->aspectRatio();

				})->save($destinationPath.'/'.$profilePicName);

				//Save to database
				$user = Auth::user();
				if (!empty($profilePicName)){
					$user->profile_picture = $profilePicName;
					$user->profile_pic_thumbnail = $profilePicName;
				}
				$user->save();

				// $imageName = $resume->storeAs('public/resume/', $request->user()->id .'_'.$resume->getClientOriginalName());
			}
			return redirect(route('user.profile'));
		} catch (Exception $e) {
			Log::error('Something went wrong' . $e->getMessage(), ['id' => $request->user()->id]);
		}
	}
	
 
}
