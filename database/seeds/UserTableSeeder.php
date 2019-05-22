<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
		$role_admin  = Role::where('name', 'admin')->first();
		$admin = new User();
		$admin->name = 'Admin Name';
		$admin->email = 'admin@example.com';
		$admin->password = bcrypt('secret');
		$admin->verified = 1;
		$admin->active = 1;
		$admin->save();		
		$admin->roles()->attach($role_admin);
		
		$role_employer = Role::where('name', 'employer')->first();
		$employer = new User();
		$employer->name = 'Employer Name';
		$employer->email = 'empoyer@example.com';
		$employer->password = bcrypt('secret');
		$employer->verified = 1;
		$employer->active = 1;
		$employer->save();
		$employer->roles()->attach($role_employer);
		
		
		$role_employee = Role::where('name', 'employee')->first();		
		$employee = new User();
		$employee->name = 'Employee Name';
		$employee->email = 'employee@example.com';
		$employee->password = bcrypt('secret');
		$employee->verified = 1;
		$employee->active = 1;
		$employee->save();
		$employee->roles()->attach($role_employee);

    }
}
