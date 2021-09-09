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
		$table 	=  $this->request->getGet('table');

		$data = array_merge($this->data, [
			'title'     => 'CRUD Generator',
			'Tables'	=> $this->developerModel->getTableDatabase(),
			'Columns'	=> $this->developerModel->getTableDatabase(),
			'tableName'	=> $table,
			'create' 	=> $this->request->getGet('create'),
			'read' 		=> $this->request->getGet('read'),
			'update' 	=> $this->request->getGet('update'),
			'delete' 	=> $this->request->getGet('delete'),
			'file' 		=> $this->request->getGet('file'),
		]);
		return view('developers/crudGenerator', $data);
	}
}
