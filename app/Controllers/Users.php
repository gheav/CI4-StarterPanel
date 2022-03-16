<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
	public function __construct()
	{
	}
	public function index()
	{
		$data = array_merge($this->data, [
			'title' 	=> 'Users Page',
			'Users'		=> $this->userModel->getUser(),
			'UserRole'	=> $this->userModel->getUserRole()
		]);
		return view('users/userList', $data);
	}
	public function userRoleAccess()
	{
		$role 		= $this->request->getGet('role');
		$userRole 	= $this->userModel->getUserRole($role);
		if (!$userRole) {
			return redirect()->to(base_url('users'));
		}
		$data = array_merge($this->data, [
			'title' 			=> 'Users Page',
			'MenuCategories'	=> $this->menuModel->getMenuCategory(),
			'Menus'				=> $this->menuModel->getMenu(),
			'Submenus'			=> $this->menuModel->getSubmenu(),
			'UserAccess'		=> $this->userModel->getAccessMenu($role),
			'role'				=> $this->userModel->getUserRole($role)
		]);
		return view('users/userAccessList', $data);
	}
	public function createRole()
	{
		$createRole = $this->userModel->createRole($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($createRole) {
			session()->setFlashdata('notif_success', '<b>Successfully added role data</b> ');
			return redirect()->to(base_url('users'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to add role data</b> ');
			return redirect()->to(base_url('users'));
		}
	}
	public function updateRole()
	{
		$updateRole = $this->userModel->updateRole($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($updateRole) {
			session()->setFlashdata('notif_success', '<b>Successfully update user data</b> ');
			return redirect()->to(base_url('users'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to update user data</b> ');
			return redirect()->to(base_url('users'));
		}
	}
	public function deleteRole($role)
	{
		if (!$role) {
			return redirect()->to(base_url('users'));
		}
		$deleteRole = $this->userModel->deleteRole($role);
		if ($deleteRole) {
			session()->setFlashdata('notif_success', '<b>Successfully added menu data</b> ');
			return redirect()->to(base_url('users'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to add menu data</b> ');
			return redirect()->to(base_url('users'));
		}
	}
	public function createUser()
	{
		if (!$this->validate(['inputUsername' => ['rules' => 'is_unique[users.username]']])) {
			session()->setFlashdata('notif_error', '<b>Failed to add new user</b> The user already exists! ');
			return redirect()->to(base_url('users'));
		}
		$createUser = $this->userModel->createUser($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($createUser) {
			session()->setFlashdata('notif_success', '<b>Successfully added new user</b> ');
			return redirect()->to(base_url('users'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to add new user</b> ');
			return redirect()->to(base_url('users'));
		}
	}
	public function updateUser()
	{
		$updateUser = $this->userModel->updateUser($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($updateUser) {
			session()->setFlashdata('notif_success', '<b>Successfully update user data</b> ');
			return redirect()->to(base_url('users'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to update user data</b> ');
			return redirect()->to(base_url('users'));
		}
	}
	public function deleteUser($userID)
	{
		if (!$userID) {
			return redirect()->to(base_url('users'));
		}
		$deleteUser = $this->userModel->deleteUser($userID);
		if ($deleteUser) {
			session()->setFlashdata('notif_success', '<b>Successfully delete user</b> ');
			return redirect()->to(base_url('users'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to delete user</b> ');
			return redirect()->to(base_url('users'));
		}
	}

	public function changeMenuCategoryPermission()
	{
		$userAccess = $this->userModel->checkUserMenuCategoryAccess($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($userAccess > 0) {
			$this->userModel->deleteMenuCategoryPermission($this->request->getPost(null, FILTER_SANITIZE_STRING));
		} else {
			$this->userModel->insertMenuCategoryPermission($this->request->getPost(null, FILTER_SANITIZE_STRING));
		}
	}

	public function changeMenuPermission()
	{
		$userAccess = $this->userModel->checkUserAccess($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($userAccess > 0) {
			$this->userModel->deleteMenuPermission($this->request->getPost(null, FILTER_SANITIZE_STRING));
		} else {
			$this->userModel->insertMenuPermission($this->request->getPost(null, FILTER_SANITIZE_STRING));
		}
	}

	public function changeSubMenuPermission()
	{
		$userAccess = $this->userModel->checkUserSubmenuAccess($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($userAccess > 0) {
			$this->userModel->deleteSubmenuPermission($this->request->getPost(null, FILTER_SANITIZE_STRING));
		} else {
			$this->userModel->insertSubmenuPermission($this->request->getPost(null, FILTER_SANITIZE_STRING));
		}
	}
}
