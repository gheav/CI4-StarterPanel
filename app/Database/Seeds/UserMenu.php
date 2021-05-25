<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserMenu extends Seeder
{
	public function run()
	{
		$data = [
			[
				'title' 		=> 'Dashboard',
				'url'    		=> 'home',
				'icon'    		=>  'sliders'
			],
			[
				'title' 		=> 'Users',
				'url'    		=> 'users',
				'icon'    		=>  'user'
			]
		];
		$this->db->table('user_menu')->insertBatch($data);
	}
}
