<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserRole extends Seeder
{
	public function run()
	{
		$data = [
<<<<<<< HEAD
			'id'    			=>  1,
			'role_name'    		=>  'Developer'
=======
			'id'    		=>  0,
			'role_name'     =>  'Developer'
>>>>>>> master
		];
		$this->db->table('user_role')->insert($data);
	}
}
