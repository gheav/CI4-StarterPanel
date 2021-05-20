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

	public function getAccessMenu($role)
	{
		return $this->db->table('user_menu')
			->join('user_access', 'user_menu.id = user_access.menu_id')
			->where(['user_access.role_id' => $role])
			->get()->getResultArray();
	}
}
