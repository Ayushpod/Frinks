<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
	const ADMIN_ROLE = 'admin';
	const EMPLOYER_ROLE = 'employer';
	const EMPLOYEE_ROLE = 'employee';
	public function users()
	{
	  return $this->belongsToMany(User::class);
	}
}
