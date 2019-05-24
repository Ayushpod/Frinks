<?php
namespace App\Repositories;

use App\User;
class UserRepository implements UserRepositoryInterface
{
	public function getAllUsers($q)
	{
		$q  = trim($q);
		$user = User::when($q != null || $q != '' , function($query) use ($q){
                return $query->where('name','like', '%'. $q .'%');
            })->sortable()->paginate(2);
		
		$user->appends(['search' => $q]);
		return $user;
	}
}