<?php

namespace App\Controllers\Developers;

use App\Controllers\BaseController;

class MenuManagement extends BaseController
{

	public function index()
	{
		$data = array_merge($this->data, [
			'title'         => 'Menu Management',
			'MenuCategories'	=> $this->menuModel->getMenuCategory(),
			'Menus'				=> $this->menuModel->getMenu(),
			'Submenus'			=> $this->menuModel->getSubmenu(),
		]);
		return view('developers/menuManagement', $data);
	}

	public function createMenuCategory()
	{
		$createMenuCategory = $this->menuModel->createMenuCategory($this->request->getPost(null));
		if ($createMenuCategory) {
			session()->setFlashdata('notif_success', '<b>Successfully create menu category</b>');
			return redirect()->to(base_url('menuManagement'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to create menu category</b>');
			return redirect()->to(base_url('menuManagement'));
		}
	}

	public function createMenu()
	{
		$createController 	= $this->_createController();
		$createView			= $this->_createView();
		if ($createController && $createView) {
			$createMenu = $this->menuModel->createMenu($this->request->getPost(null));
			if ($createMenu) {
				session()->setFlashdata('notif_success', '<b>Successfully create menu </b> ');
				return redirect()->to(base_url('menuManagement'));
			} else {
				session()->setFlashdata('notif_error', '<b>Failed to create menu </b> ');
				return redirect()->to(base_url('menuManagement'));
			}
		} else {
			session()->setFlashdata('notif_error', "<b>Failed to create menu </b>Cannot create file ");
			return redirect()->to(base_url('menuManagement'));
		}
	}
	public function createSubMenu()
	{
		$createSubMenu = $this->menuModel->createSubMenu($this->request->getPost(null));
		if ($createSubMenu) {
			session()->setFlashdata('notif_success', '<b>Successfully create submenu </b> ');
			return redirect()->to(base_url('menuManagement'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to create submenu </b> ');
			return redirect()->to(base_url('menuManagement'));
		}
	}

	public function _createController()
	{
		$menuTitle		= $this->request->getPost('inputMenuURL');
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
		$viewName 		= url_title($this->request->getPost('inputMenuURL'), '', true);
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
