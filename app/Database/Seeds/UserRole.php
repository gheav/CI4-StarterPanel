<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserRole extends Seeder
{
	public function run()
	{
		$data = [
			'id'    			=>  1,
			'role_name'    		=>  'Developer'
		];
		$this->db->table('user_role')->insert($data);
	}
}
