<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserRole extends Seeder
{
	public function run()
	{
		$data = [
			'id'    		=>  0,
			'role'    		=>  'Developer'
		];
		$this->db->table('user_role')->insert($data);
	}
}
