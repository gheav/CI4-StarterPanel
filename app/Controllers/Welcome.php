<?php

namespace App\Controllers;

//use App\Models\MasterModel;

class Welcome extends BaseController
{
	public function __construct()
	{
		//$this->commonModel  = new CommonModel();
	}

	public function index()
	{
		if (session()->get('isLoggedIn') == TRUE) {
			return redirect()->to(base_url('home'));
		}
		if (!$this->validate(['inputEmail'  => 'required'])) {
			return view('common/login');
		} else {
			$userID 		 	= htmlspecialchars($this->request->getVar('inputEmail', FILTER_SANITIZE_STRING));
			$inputPassword 		= htmlspecialchars($this->request->getVar('inputPassword', FILTER_SANITIZE_STRING));
			$user 				= true;
			$userID				= 'test@mail.io';
			$password			= '$2y$10$fko6ETEpYmcpFTSFPIGzl.7Q34OUvkunAHG0uMORhdkOsVPmX/oDm'; //123456
			if ($user) {
				$verify = password_verify($inputPassword, $password);
				if ($verify) {
					session()->set([
						'userID'		=> $userID,
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
