<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Authorization implements FilterInterface
{

	public function before(RequestInterface $request, $arguments = null)
	{
		if (session()->get('isLoggedIn') != TRUE) :
			return redirect()->to(base_url('/'));
		endif;
	}
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
