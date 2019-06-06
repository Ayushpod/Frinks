<?php
namespace App\Repositories;

use App\User;
use Auth;
use DB;
class UserRepository implements UserRepositoryInterface
{
	public function getAllUsers($q)
	{
		$q  = trim($q);
		$user = User::when($q != null || $q != '' , function($query) use ($q){
                return $query->where('name','like', '%'. $q .'%');
            })
			->whereHas('roles', function($q){
				$q->where('name', '<>','admin');
		})->orderBy('name', 'desc')
			->sortable()->paginate(2);
		
		$user->appends(['search' => $q]);
		return $user;
	}
	
	public function getUserInfoById($id)
	{
		return User::find($id);
	}
	
	public function approve($id)
	{
		$user = User::find($id);
		$user->verified = 1;
		$user->active = 1;
		$user->save();
		return $user;
		
	}
	
	public function search(array $params)
	{
		
		$distance = $params['distance']??null;
		$sortBy = $params['sortby']??null;
		
		$userNearestList = User::when($distance != null || $distance != '', function($query, $distance, $longitude = null, $latitude = null) {
			$user = Auth::user();
			$latitude     = $user->latitude;
			$longitude    = $user->longitude;
			 $query->where([
                         ['latitude',  '!=', $latitude],
                         ['longitude', '!=', $longitude]
                     ])->whereRaw( DB::raw( "(3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) )  * 
                          cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin( 
                          radians( latitude ) ) ) ) < $distance ")
                     );
		})->when(count($params) > 0, function($q) use($params) {
			if (!empty($params['query'])) {
				$q->where('skills' , 'like', '%'. $params['query'] .'%');
			}
			if (!empty($params['city'])) {
				$q->where('city' , '=', $params['city']);
			}
		})
		->whereHas('roles', function($q){
			$q->where('name', '=','employee');
		})->when($sortBy, function ($query, $sortBy) {
                    return $query->orderBy($sortBy);
                }, function ($query) {
                    return $query->orderBy('created_at', 'desc');
        		}
		)
		->paginate(10);
		/*
		$query = User::query();
		$id = null;
		$query->where(function($q) use($id) {
			if($id)
				$q->where('id', '>', 1);
		});
		$query->whereHas('roles', function($q){
			$q->where('name', '<>','admin');
		});
		
		$userNearestList = $query->paginate(10);
		*/
		return $userNearestList;
	}
}