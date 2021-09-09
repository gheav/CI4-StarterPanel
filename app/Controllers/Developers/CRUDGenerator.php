<?php

namespace App\Controllers\Developers;

use App\Controllers\BaseController;
use App\Models\Developers;

class CRUDGenerator extends BaseController
{
	function __construct()
	{
		$this->developerModel  	= new Developers();
	}
	public function index()
	{
		$data = array_merge($this->data, [
			'title'     => 'CRUD Generator',
			'Tables'	=> $this->developerModel->getTableDatabase()
		]);
		return view('developers/crudGenerator.php', $data);
	}
}
