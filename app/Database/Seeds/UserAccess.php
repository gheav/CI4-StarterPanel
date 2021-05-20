<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserAccess extends Seeder
{
	public function run()
	{
		$data = [
			[
				'role_id'    	=>  0,
				'menu_id'    	=>  1
			],
			[
				'role_id'    	=>  0,
				'menu_id'    	=>  2
			]
		];
		$this->db->table('user_access')->insertBatch($data);
	}
}
