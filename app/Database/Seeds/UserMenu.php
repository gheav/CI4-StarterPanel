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
				'icon'    		=> 'home'
			],
			[
				'menu_category' => 2,
				'title' 		=> 'Users',
				'url'    		=> 'users',
				'icon'    		=> 'user'
			]
		];
		$this->db->table('user_menu')->insertBatch($data);
	}
}
