<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserMenu extends Seeder
{
	public function run()
	{
		$data = [
			[
				'menu_category' => 1,
				'title' 		=> 'Dashboard',
				'url'    		=> 'home',
				'icon'    		=> 'home',
				'parent'   		=> 0
			],
			[
				'menu_category' => 2,
				'title' 		=> 'Users',
				'url'    		=> 'users',
				'icon'    		=> 'user',
				'parent'   		=> 0
			]
		];
		$this->db->table('user_menu')->insertBatch($data);
	}
}
