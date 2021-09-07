<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;

class Authorization implements FilterInterface
{

	public function before(RequestInterface $request, $arguments = null)
	{
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
		endif;
	}
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
