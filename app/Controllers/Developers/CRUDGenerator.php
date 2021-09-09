<?php

namespace App\Controllers\Developers;

use App\Controllers\BaseController;

class CRUDGenerator extends BaseController
{
	public function index()
	{
		$data = array_merge($this->data, [
			'title'         => 'CRUD Generator'
		]);
		return view('developers/crudGenerator.php', $data);
	}
}
