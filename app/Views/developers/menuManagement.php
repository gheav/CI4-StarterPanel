<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-3"><strong><?= $title; ?></strong> </h1>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h5 class="card-title mb-0">Create New Menu </h5>
		</div>
		<div class="card-body">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Menu Category</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu" type="button" role="tab" aria-controls="menu" aria-selected="false">Menu</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="submenu-tab" data-bs-toggle="tab" data-bs-target="#submenu" type="button" role="tab" aria-controls="submenu" aria-selected="false">Submenu</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="mt-3">
						<div class="row">
							<div class="col-6">
								<table class="table">
									<thead>
										<th>#</th>
										<th>Menu Categories</th>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($MenuCategories as $menuCategories) :
										?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $menuCategories['menu_category']; ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="col-6">
								<h5 class="fw-bold text-primary">Create New Menu Category</h5>
								<hr>
								<form action="<?= base_url('menuManagement/createMenuCategory'); ?> " method="post">
									<div class="mb-3">
										<label for="inputMenuCategory" class="form-label">Add Menu Category</label>
										<input type="text" class="form-control <?= ($validation->hasError('inputMenuCategory')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuCategory'); ?>" id=" inputMenuCategory" name="inputMenuCategory" placeholder="Menu Category Name">
										<div class="invalid-feedback">
											<?= $validation->getError('inputMenuCategory'); ?>
										</div>
									</div>
									<div class="text-end">
										<button class="btn btn-primary ">Save Menu Category</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
					<div class="mt-3">
						<div class="row">
							<div class="col-sm-6">
								<table class="table">
									<thead>
										<th>#</th>
										<th>Menu Category</th>
										<th>Menu Icon</th>
										<th>Menu Title</th>
										<th>Menu Url</th>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($Menus as $menu) :
										?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $menu['menu_category']; ?></td>
												<td> <i class="align-middle" data-feather="<?= $menu['icon']; ?>"></i> </td>
												<td><?= $menu['title']; ?></td>
												<td><?= $menu['url']; ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="col-sm-6">
								<h5 class="fw-bold text-primary">Create New Menu</h5>
								<hr>
								<form action="<?= base_url('menuManagement/createMenu'); ?>" method="post">
									<div class="mb-3">
										<label for="inputMenuCategory2" class="form-label">Menu Category</label>
										<select name="inputMenuCategory2" id="inputMenuCategory2" class="form-control <?= ($validation->hasError('inputMenuCategory2')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuCategory2	'); ?>">
											<option value=""> -- Choose Menu Category --</option>
											<?php foreach ($MenuCategories as $menuCategory) : ?>
												<option value="<?= $menuCategory['id']; ?>"><?= $menuCategory['menu_category']; ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?= $validation->getError('inputMenuCategory2'); ?>
										</div>
									</div>
									<div class="mb-3">
										<label for="inputMenuTitle" class="form-label">Menu Title</label>
										<input type="text" class="form-control <?= ($validation->hasError('inputMenuTitle')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuTitle'); ?>" id="inputMenuTitle" name="inputMenuTitle">
										<div class="invalid-feedback">
											<?= $validation->getError('inputMenuTitle'); ?>
										</div>
									</div>
									<div class="mb-3">
										<label for="inputMenuURL" class="form-label">Menu URL</label>
										<input type="text" class="form-control <?= ($validation->hasError('inputMenuURL')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuURL'); ?>" id="inputMenuURL" name="inputMenuURL">
										<div class="invalid-feedback">
											<?= $validation->getError('inputMenuURL'); ?>
										</div>
									</div>
									<div class="mb-3">
										<label for="inputMenuIcon" class="form-label">Menu Icon <a href="https://feathericons.com/" target="_blank" rel="noopener noreferrer">(Lookup References)</a> </label>
										<input type="text" class="form-control <?= ($validation->hasError('inputMenuIcon')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuIcon'); ?>" id="inputMenuIcon" name="inputMenuIcon">
										<div class="invalid-feedback">
											<?= $validation->getError('inputMenuIcon'); ?>
										</div>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="optionPage" id="optionPage1" value="0" required>
										<label class="form-check-label" for="optionPage1">Create Blank Page</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="optionPage" id="optionPage2" value="1" required>
										<label class="form-check-label" for="optionPage2">Create List and Form Pages</label>
									</div>
									<div class="text-end mt-3">
										<button class="btn btn-primary ">Save Menu</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="submenu" role="tabpanel" aria-labelledby="submenu-tab">
					<div class="mt-3">
						<div class="row">
							<div class="col-sm-6">
								<table class="table">
									<thead>
										<th>#</th>
										<th>Menu Category</th>
										<th>Menu </th>
										<th>Submenu Title</th>
										<th>Submenu Url</th>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($Submenus as $submenu) :
										?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $submenu['menu_category']; ?></td>
												<td><?= $submenu['menu_title']; ?> </td>
												<td><?= $submenu['title']; ?></td>
												<td><?= $submenu['url']; ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="col-sm-6">
								<h5 class="fw-bold text-primary">Create New Submenu</h5>
								<hr>
								<form action="<?= base_url('menuManagement/createSubMenu'); ?>" method="post">
									<div class="mb-3">
										<label for="inputMenu1" class="form-label">Menu Parent</label>
										<select name="inputMenu1" id="inputMenu1" class="form-control <?= ($validation->hasError('inputMenu1')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenu1'); ?>">
											<option value=""> -- Choose Menu Parent --</option>
											<?php foreach ($Menus as $menu) : ?>
												<option value="<?= $menu['id']; ?>"><?= $menu['title']; ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?= $validation->getError('inputMenu1'); ?>
										</div>
									</div>
									<div class="mb-3">
										<label for="inputSubmenuTitle" class="form-label">Submenu Title</label>
										<input type="text" class="form-control <?= ($validation->hasError('inputSubmenuTitle')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputSubmenuTitle'); ?>" id="inputSubmenuTitle" name="inputSubmenuTitle">
										<div class="invalid-feedback">
											<?= $validation->getError('inputSubmenuTitle'); ?>
										</div>
									</div>
									<div class="mb-3">
										<label for="inputSubmenuURL" class="form-label">Submenu URL</label>
										<input type="text" class="form-control <?= ($validation->hasError('inputSubmenuURL')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputSubmenuURL'); ?>"" id=" inputSubmenuURL" name="inputSubmenuURL">
										<div class="invalid-feedback">
											<?= $validation->getError('inputSubmenuURL'); ?>
										</div>
									</div>
									<div class="text-end">
										<button class="btn btn-primary">Save Submenu</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>