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
			'MenuCategories'	=> $this->userModel->getMenuCategory(),
			'Menus'				=> $this->userModel->getMenu(),
			'Submenus'			=> $this->userModel->getSubmenu(),
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
	public function createMenuCategory()
	{
		$createMenuCategory = $this->userModel->createMenuCategory($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($createMenuCategory) {
			session()->setFlashdata('notif_success', '<b>Successfully create menu category</b>');
			return redirect()->to(base_url('users'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to create menu category</b>');
			return redirect()->to(base_url('users'));
		}
	}

	public function createMenu()
	{
		$createController 	= $this->_createController();
		$createView			= $this->_createView();
		if ($createController && $createView) {
			$createMenu = $this->userModel->createMenu($this->request->getPost(null, FILTER_SANITIZE_STRING));
			if ($createMenu) {
				session()->setFlashdata('notif_success', '<b>Successfully create menu </b> ');
				return redirect()->to(base_url('users'));
			} else {
				session()->setFlashdata('notif_error', '<b>Failed to create menu </b> ');
				return redirect()->to(base_url('users'));
			}
		} else {
			session()->setFlashdata('notif_error', "<b>Failed to create menu </b>Cannot create file ");
			return redirect()->to(base_url('users'));
		}
	}
	public function createSubMenu()
	{
		$createSubMenu = $this->userModel->createSubMenu($this->request->getPost(null, FILTER_SANITIZE_STRING));
		if ($createSubMenu) {
			session()->setFlashdata('notif_success', '<b>Successfully create submenu </b> ');
			return redirect()->to(base_url('users'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to create submenu </b> ');
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

	public function _createController()
	{
		$menuTitle		= $this->request->getPost('inputMenuTitle');
		$controllerName = url_title(ucwords($menuTitle), '', false);
		$viewName 		= url_title($menuTitle, '', true);
		$controllerPath	= APPPATH . 'Controllers/' . $controllerName . ".php";
		$controllerContent = "<?php
		namespace App\Controllers;
		use App\Controllers\BaseController;
		class $controllerName extends BaseController
		{
			public function index()
			{
				$|data = array_merge($|this->data, [
					'title'         => '$menuTitle'
				]);
				return view('$viewName', $|data);
			}
		}
		";
		$renderFile = str_replace("|", "", $controllerContent);
		if (file_put_contents($controllerPath, $renderFile) !== false) {
			return true;
		} else {
			return false;
		}
	}
	public function _createView()
	{
		$viewName 		= url_title($this->request->getPost('inputMenuTitle'), '', true);
		$viewPath		= APPPATH . 'Views/' . $viewName . ".php";
		$viewContent 	= "<?= $|this->extend('layouts/main'); ?>
		<?= $|this->section('content'); ?>
		<h1 class=\"h3 mb-3\"><strong><?= $|title; ?></strong> Menu </h1>
		<?= $|this->endSection(); ?>
		";
		$renderFile = str_replace("|", "", $viewContent);
		if (file_put_contents($viewPath, $renderFile) !== false) {
			return true;
		} else {
			return false;
		}
	}
}
