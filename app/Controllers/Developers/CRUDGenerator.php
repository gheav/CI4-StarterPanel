<?php

namespace App\Controllers\Developers;

use App\Controllers\BaseController;
use App\Models\DeveloperModel;

class CRUDGenerator extends BaseController
{
	function __construct()
	{
		$this->developerModel  	= new DeveloperModel();
	}
	public function index()
	{
		$table 	=  $this->request->getGet('table');
		if ($table) {
			if ($this->db->tableExists($table)) {
				$data = array_merge($this->data, [
					'title'     => 'CRUD Generator',
					'Tables'	=> $this->developerModel->getTableDatabase(),
					'Fields'	=> $this->db->getFieldData($table),
					'tableName'	=> $table,
					'menu'		=> $this->request->getGet('menu'),
					'create' 	=> $this->request->getGet('create'),
					'read' 		=> $this->request->getGet('read'),
					'update' 	=> $this->request->getGet('update'),
					'delete' 	=> $this->request->getGet('delete'),
					'file' 		=> $this->request->getGet('file'),
				]);
				return view('developers/crudGenerator', $data);
			} else {
				session()->setFlashdata('notif_error', '<b>Table Not Exist!</b> ');
				return redirect()->to(base_url('crudGenerator'));
			}
		} else {
			$data = array_merge($this->data, [
				'title'     => 'CRUD Generator',
				'Tables'	=> $this->developerModel->getTableDatabase(),
				'Columns'	=> [],
				'tableName'	=> $table,
				'menu'		=> $this->request->getGet('menu'),
				'create' 	=> $this->request->getGet('create'),
				'read' 		=> $this->request->getGet('read'),
				'update' 	=> $this->request->getGet('update'),
				'delete' 	=> $this->request->getGet('delete'),
				'file' 		=> $this->request->getGet('file'),
			]);
			return view('developers/crudGenerator', $data);
		}
	}
}
