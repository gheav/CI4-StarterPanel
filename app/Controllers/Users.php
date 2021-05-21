<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
	public function __construct()
	{
	}
	public function index()
	{
		$data = array_merge($this->data, [
			'title' 	=> 'Users Page',
			'Users'		=> $this->userModel->getUser(),
			'UserRole'	=> $this->userModel->getUserRole()
		]);
		return view('users/userList', $data);
	}
	public function userRoleAccess()
	{
		$role 		= $this->request->getGet('role');
		$userRole 	= $this->userModel->getUserRole($role);
		if (!$userRole) {
			return redirect()->to(base_url('users'));
		}
		$data = array_merge($this->data, [
			'title' 		=> 'Users Page',
			'UserAccess'	=> $this->userModel->getMenu($role)
		]);
		return view('users/userAccessList', $data);
	}
	public function createRole()
	{
		$createRole = $this->userModel->createRole($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($createRole) {
			session()->setFlashdata('notif_success', '<b>Successfully added role data</b> ');
			return redirect()->to(base_url('users'));
		}
	}
}
