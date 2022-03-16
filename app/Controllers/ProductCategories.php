<?php
		namespace App\Controllers;
		use App\Controllers\BaseController;
		class ProductCategories extends BaseController
		{
			public function index()
			{
				$data = array_merge($this->data, [
					'title'         => 'productCategories'
				]);
				return view('productcategories', $data);
			}
		}
		