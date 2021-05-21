<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
	public function getUser($username = false)
	{
		if ($username) {
			return $this->db->table('users')
				->join('user_role', 'users.role = user_role.id')
				->where(['username' => $username])
				->get()->getRowArray();
		}

		return $this->db->table('users')
			->join('user_role', 'users.role = user_role.id')
			->get()->getResultArray();
	}

	public function getAccessMenu($role)
	{
		return $this->db->table('user_menu')
			->join('user_access', 'user_menu.id = user_access.menu_id')
			->where(['user_access.role_id' => $role])
			->get()->getResultArray();
	}
	public function getMenu()
	{
		return $this->db->table('user_menu')
			->get()->getResultArray();
	}
	public function getUserRole($role = false)
	{
		if ($role) {
			return $this->db->table('user_role')
				->where(['id' => $role])
				->get()->getRowArray();
		}

		return $this->db->table('user_role')
			->get()->getResultArray();
	}

	public function createRole($dataRole)
	{
		return $this->db->table('user_role')->insert(['role_name' => $dataRole['inputRoleName']]);
	}
	public function deleteRole($role)
	{
		return $this->db->table('user_role')->delete(['id' => $role]);
	}
	public function createMenu($dataMenu)
	{
		return $this->db->table('user_menu')->insert([
			'title'		=> $dataMenu['inputMenuTitle'],
			'url' 		=> $dataMenu['inputMenuURL'],
			'icon' 		=> $dataMenu['inputMenuIcon'],
		]);
	}
}
