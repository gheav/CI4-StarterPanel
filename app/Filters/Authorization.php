<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
<<<<<<< HEAD
use App\Models\Users;
=======
>>>>>>> master

class Authorization implements FilterInterface
{

	public function before(RequestInterface $request, $arguments = null)
	{
<<<<<<< HEAD
		$this->userModel  	= new Users();
		$segment 			= $request->uri->getSegment(1);

		if ($segment) :
			$menu 		= $this->userModel->getMenuByUrl($segment);
			if (!$menu) :
				//not found
				return redirect()->to(base_url('/'));
			else :
				$dataAccess = [
					'roleID' => session()->get('role'),
					'menuID' => $menu['id']
				];
				$userAccess = $this->userModel->checkUserAccess($dataAccess);
				if (!$userAccess) :
					// not granted
					return redirect()->to(base_url('blocked'));
				endif;
			endif;
=======
		if (session()->get('isLoggedIn') != TRUE) :
			return redirect()->to(base_url('/'));
>>>>>>> master
		endif;
	}
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
