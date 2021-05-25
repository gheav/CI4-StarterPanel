<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Session extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 128
			],
			'ip_address'       => [
				'type'       => 'VARCHAR',
				'constraint' => 45,
			],
			'timestamp' => [
				'type' => 'timestamp'
			],
			'data' => [
				'type' => 'blob'
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey('ip_address', true);
		$this->forge->createTable('sessions');
	}

	public function down()
	{
		$this->forge->dropTable('sessions');
	}
}
