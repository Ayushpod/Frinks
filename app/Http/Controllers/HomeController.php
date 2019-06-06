<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;

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
}
