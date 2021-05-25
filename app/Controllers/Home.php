<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public function index()
	{
		$data = array_merge($this->data, [
			'title'         => 'Dashboard Page'
		]);
		return view('common/home', $data);
	}
}
