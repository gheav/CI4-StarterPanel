<?php

namespace App\Controllers\Developers;

use App\Controllers\BaseController;

class MenuManagement extends BaseController
{
	public function index()
	{
		$data = array_merge($this->data, [
			'title'         => 'Menu Management'
		]);
		return view('developers/menuManagement', $data);
	}
}
