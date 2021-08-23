<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
	public function run()
	{
		$data = [
<<<<<<< HEAD
			'fullname' 		=> 'Developer Tester',
=======
			'fullname' 		=> 'Tester',
>>>>>>> master
			'username'    	=> 'tester@mail.io',
			'password'    	=>  password_hash('123456', PASSWORD_DEFAULT),
			'role'    		=>  1,
			'created_at'    =>  date('Y-m-d h:i:s')
		];
		$this->db->table('users')->insert($data);
		$this->call('UserAccess');
		$this->call('UserMenu');
<<<<<<< HEAD
		$this->call('UserMenuCategory');
=======
>>>>>>> master
		$this->call('UserRole');
	}
}
