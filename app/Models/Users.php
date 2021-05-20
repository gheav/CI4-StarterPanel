<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
	public function getUser($username = false)
	{
		if ($username) {
			return $this->db->table('users')->where(['username' => $username])->get()->getRowArray();
		}

		return $this->db->table('users')->get()->getResultArray();
	}
}
