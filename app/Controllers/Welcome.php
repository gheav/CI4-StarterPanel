<?php

namespace App\Controllers;

use App\Models\Users;

class Welcome extends BaseController
{
	protected $userModel;
	public function __construct()
	{
		$this->userModel  = new Users();
	}

	public function index()
	{
		if (session()->get('isLoggedIn') == TRUE) {
			return redirect()->to(base_url('home'));
		}
		if (!$this->validate(['inputEmail'  => 'required'])) {
			return view('common/login');
		} else {
			$inputEmail 		= htmlspecialchars($this->request->getVar('inputEmail', FILTER_SANITIZE_STRING));
			$inputPassword 		= htmlspecialchars($this->request->getVar('inputPassword', FILTER_SANITIZE_STRING));
			$user 				= $this->userModel->getUser($inputEmail);
			if ($user) {
				$password		= $user['password'];
				$verify = password_verify($inputPassword, $password);
				if ($verify) {
					$username			= $user['username'];
					session()->set([
						'username'		=> $username,
						'isLoggedIn' 	=> TRUE
					]);
					return redirect()->to(base_url('home'));
				} else {
					session()->setFlashdata('notif_error', '<b>Your ID or Password is Wrong !</b> ');
					return redirect()->to(base_url());
				}
			} else {
				session()->setFlashdata('notif_error', '<b>Your ID or Password is Wrong!</b> ');
				return redirect()->to(base_url());
			}
		}
	}
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to(base_url('/'));
	}
}
