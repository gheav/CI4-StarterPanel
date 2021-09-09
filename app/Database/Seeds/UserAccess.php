<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserAccess extends Seeder
{
	public function run()
	{
		$data = [
			[
				'role_id'    		=>  1,
				'menu_category_id'  =>  1,
				'menu_id'    		=>  0,
				'submenu_id'		=> 	0
			],
			[
				'role_id'    		=>  1,
				'menu_category_id'  =>  0,
				'menu_id'    		=>  1,
				'submenu_id'		=> 	0
			],
			[
				'role_id'    		=>  1,
				'menu_category_id'  =>  2,
				'menu_id'    		=>  0,
				'submenu_id'		=> 	0
			],
			[
				'role_id'    		=>  1,
				'menu_category_id'  =>  0,
				'menu_id'    		=>  2,
				'submenu_id'		=> 	0
			],
			[
				'role_id'    		=>  1,
				'menu_category_id'  =>  3,
				'menu_id'    		=>  0,
				'submenu_id'		=> 	0
			],
			[
				'role_id'    		=>  1,
				'menu_category_id'  =>  0,
				'menu_id'    		=>  3,
				'submenu_id'		=> 	0
			],
			[
				'role_id'    		=>  1,
				'menu_category_id'  =>  0,
				'menu_id'    		=>  4,
				'submenu_id'		=> 	0
			],
		];
		$this->db->table('user_access')->insertBatch($data);
	}
}
