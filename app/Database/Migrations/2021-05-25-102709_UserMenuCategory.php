<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMenuCategory extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'menu_category'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			]

		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('user_menu_category');
	}

	public function down()
	{
		$this->forge->dropTable('user_menu_category');
	}
}
