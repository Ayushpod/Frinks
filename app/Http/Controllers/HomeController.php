<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use Mail;
use App\Mail\MailNotify;

class HomeController extends Controller
{
		protected $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
		$this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
		$params['city'] = $request->get('city');
		$params['query'] = $request->get('query');
		
		$users = $this->userRepository->search($params);
		
        return view('home', compact(['users']));
		
    }
	
	public function detail($id)
	{
		$user = $this->userRepository->getUserInfoById($id);
		// dd($user);
		return view('profile.detail', compact('user'));
	}
	
	public function about()
	{
		return view('about');
	}
	
	public function sendEmail(Request $request)
    {
      $user = $this->userRepository->getUserInfoById($request->get('id'));
      Mail::to($user)->send(new MailNotify($request->get('email'), $request->get('message')));
 
      if (Mail::failures()) {
           return ;
      }else{
           return redirect(route('user.detail', ['id' => $user->id]));
         }
		
    }
}
