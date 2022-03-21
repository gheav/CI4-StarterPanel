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
			'validation'		=> $this->validation
		]);
		return view('developers/menuManagement', $data);
	}

	public function createMenuCategory()
	{
		if (!$this->validate([
			'inputMenuCategory' => [
				'rules'     => 'required|is_unique[user_menu_category.menu_category]',
				'errors'    => [
					'required'  => 'Menu Category must be required.',
					'is_unique' => 'Menu Category cannot be same.'
				]
			]
		])) {
			return redirect()->to('menuManagement')->withInput();
		}
		$createMenuCategory = $this->menuModel->createMenuCategory($this->request->getPost(null));
		if ($createMenuCategory) {
			session()->setFlashdata('notif_success', '<b>Successfully create menu category</b>');
			return redirect()->to(base_url('menuManagement'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to create menu category</b>');
			return redirect()->to(base_url('menuManagement'));
		}
	}
	public function updateMenuCategory()
	{
		if (!$this->validate([
			'inputMenuCategory' => [
				'rules'     => 'required|is_unique[user_menu_category.menu_category]',
				'errors'    => [
					'required'  => 'Menu Category must be required.',
					'is_unique' => 'Menu Category cannot be same'
				]
			]
		])) {
			return redirect()->to('menuManagement')->withInput();
		}
		$updateMenuCategory = $this->menuModel->updateMenuCategory($this->request->getPost(null));
		if ($updateMenuCategory) {
			session()->setFlashdata('notif_success', '<b>Successfully update Menu Category </b> ');
			return redirect()->to(base_url('menuManagement'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to update Menu Category </b> ');
			return redirect()->to(base_url('menuManagement'));
		}
	}

	public function createMenu()
	{
		if (!$this->validate([
			'inputMenuCategory2' => [
				'rules'     => 'required',
				'errors'    => [
					'required'  => 'Menu Category must be required.'
				]
			],
			'inputMenuTitle' => [
				'rules'     => 'required|is_unique[user_menu.title]',
				'errors'    => [
					'required'  => 'Menu Title must be required.',
					'is_unique' => 'Menu Title cannot be same'
				]
			],
			'inputMenuURL' => [
				'rules'     => 'required|is_unique[user_menu_category.url]',
				'errors'    => [
					'required'  => 'Menu Url must be required.',
					'is_unique' => 'Menu Url cannot be same'
				]
			],
			'inputMenuIcon' => [
				'rules'     => 'required',
				'errors'    => [
					'required'  => 'Menu Icon must be required.'
				]
			]
		])) {
			return redirect()->to('menuManagement')->withInput();
		}
		$optionPage = $this->request->getPost('optionPage');
		if ($optionPage == 1) {
			$createController 	= $this->_createListFormController();
			$createView			= $this->_createListPageView();
			$createView			= $this->_createFormPageView();
		} else {
			$createController 	= $this->_createBlankPageController();
			$createView			= $this->_createBlankPageView();
		}
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
		if (!$this->validate([
			'inputMenu1' => [
				'rules'     => 'required',
				'errors'    => [
					'required'  => 'Menu must be required.'
				]
			],
			'inputSubmenuTitle' => [
				'rules'     => 'required|is_unique[user_submenu.title]',
				'errors'    => [
					'required'  => 'Submenu Title must be required.',
					'is_unique' => 'Submenu Title cannot be same'
				]
			],
			'inputSubmenuURL' => [
				'rules'     => 'required|is_unique[user_submenu_category.url]',
				'errors'    => [
					'required'  => 'Submenu Url must be required.',
					'is_unique' => 'Submenu Url cannot be same'
				]
			],
		])) {
			return redirect()->to('menuManagement')->withInput();
		}
		$createSubMenu = $this->menuModel->createSubMenu($this->request->getPost(null));
		if ($createSubMenu) {
			session()->setFlashdata('notif_success', '<b>Successfully create submenu </b> ');
			return redirect()->to(base_url('menuManagement'));
		} else {
			session()->setFlashdata('notif_error', '<b>Failed to create submenu </b> ');
			return redirect()->to(base_url('menuManagement'));
		}
	}

	private function _createBlankPageController()
	{
		$menuTitle		= ucwords($this->request->getPost('inputMenuURL'));
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
	private function _createBlankPageView()
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
	private function _createListFormController()
	{
		$menuTitle		= ucwords($this->request->getPost('inputMenuTitle'));
		$controllerName = url_title(ucwords($this->request->getPost('inputMenuURL')), '', false);
		$listViewName 		= url_title($menuTitle, '', true) . 'List';
		$formViewName 		= url_title($menuTitle, '', true) . 'Form';
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
				return view('$listViewName', $|data);
			}
			public function form()
			{
				$|data = array_merge($|this->data, [
					'title'         => '$menuTitle'
				]);
				return view('$formViewName', $|data);
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
	private function _createListPageView()
	{
		$menuTitle		= ucwords($this->request->getPost('inputMenuTitle'));
		$viewName 		= url_title($this->request->getPost('inputMenuURL'), '', true);
		$controllerName = url_title(ucwords($this->request->getPost('inputMenuURL')), '', false);
		$viewPath		= APPPATH . 'Views/' . $viewName . "List.php";
		$viewContent 	= "<?= $|this->extend('layouts/main'); ?>
		<?= $|this->section('content'); ?>
		<h1 class=\"h3 mb-3\"><strong><?= $|title; ?></strong> List Menu </h1>
		<div class=\"card\">
            <div class=\"card-header\">
                <h5 class=\"card-title mb-0\">	$menuTitle List <a href=\"<?= base_url('$controllerName/form'); ?>\" class=\"btn btn-primary btn-sm float-end\" >Create New $menuTitle</a></h5>
            </div>
            <div class=\"card-body\">
                <div class=\"table-responsive\">
                    <table class=\"table table-hover my-0\">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>       
									  <button type=\"submit\" class=\"btn btn-outline-info btn-sm\">Update</button>
									  <button type=\"submit\" class=\"btn btn-outline-danger btn-sm\">Delete</button>
								</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
		<?= $|this->endSection(); ?>
		";
		$renderFile = str_replace("|", "", $viewContent);
		if (file_put_contents($viewPath, $renderFile) !== false) {
			return true;
		} else {
			return false;
		}
	}
	private function _createFormPageView()
	{
		$menuTitle		= ucwords($this->request->getPost('inputMenuTitle'));
		$viewName 		= url_title($this->request->getPost('inputMenuURL'), '', true);
		$viewPath		= APPPATH . 'Views/' . $viewName . "Form.php";
		$viewContent 	= "<?= $|this->extend('layouts/main'); ?>
		<?= $|this->section('content'); ?>
		<h1 class=\"h3 mb-3\"><strong><?= $|title; ?></strong> Form Menu </h1>
		<div class=\"card\">
            <div class=\"card-header\">
                <h5 class=\"card-title mb-0\">	$menuTitle Form </h5>
            </div>
            <div class=\"card-body\">

            </div>
        </div>
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
