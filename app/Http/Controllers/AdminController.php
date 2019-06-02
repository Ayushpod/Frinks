<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;

class AdminController extends Controller
{
	protected $userRepository;
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
		$this->userRepository = $userRepository;
    }
	
	public function index()
	{
		return view('admin.index');
	}
	
	public function user(Request $request)
	{
		$search = $request->get('search');
		$users = $this->userRepository->getAllUsers($search);
		return view('admin.user',compact(['users', 'search']));
	}
	
	public function userDetail($id)
	{
		$user = $this->userRepository->getUserInfoById($id);
		return view('admin.user_detail', compact(['user']));
	}	
	public function approve($id)
	{
		$this->userRepository->approve($id);
		return redirect(route('admin.users'));
	}

}
