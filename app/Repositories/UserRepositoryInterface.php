<?php
namespace App\Repositories;

interface UserRepositoryInterface
{
	
	public function getAllUsers($search);
	public function getUserInfoById($id);
	public function approve($id);
	public function search(array $params);
}