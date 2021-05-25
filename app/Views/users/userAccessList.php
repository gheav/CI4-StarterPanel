<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong><?= $role['role_name']; ?></strong> Access Menu </h1>
    <div class="row">
        <div class="col-12 col-sm-6 col- d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Role Access Menu List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Url</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($MenuCategories as $menuCategory) : ?>
                                    <tr>
                                        <td colspan="2" class="fw-bold"> <?= $menuCategory['menu_category']; ?></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input menu_category_permission" type="checkbox" <?= check_menuCategory_access($role['id'], $menuCategory['id']) ?> data-role="<?= $role['id'] ?>" data-menucategory="<?= $menuCategory['id'] ?>">
                                                <label class="form-check-label">
                                                    <?= (check_menuCategory_access($role['id'], $menuCategory['id']) == 'checked') ? 'Access Granted' : 'Access Not Granted' ?>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php foreach ($Menus as $menu) : if ($menu['menu_category'] == $menuCategory['id']) : ?>
                                            <tr>
                                                <td><?= $menu['title']; ?></td>
                                                <td class="d-none d-md-table-cell">/<?= $menu['url']; ?></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input menu_permission" type="checkbox" <?= check_menu_access($role['id'], $menu['id']) ?> data-role="<?= $role['id'] ?>" data-menu="<?= $menu['id'] ?>">
                                                        <label class="form-check-label">
                                                            <?= (check_menu_access($role['id'], $menu['id']) == 'checked') ? 'Access Granted' : 'Access Not Granted' ?>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php endif;
                                    endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6  d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Role Access Form</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Role</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Menu Category</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Menu</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mt-3">
                                <h5 class="fw-bold text-primary">Create New Role</h5>
                                <hr>
                                <form action="<?= base_url('users/createRole'); ?> " method="post">
                                    <div class="mb-3">
                                        <label for="inputRoleName" class="form-label">Add Role</label>
                                        <input type="text" class="form-control" id="inputRoleName" name="inputRoleName" placeholder="Role Name">
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-primary ">Save Role</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="mt-3">
                                <h5 class="fw-bold text-primary">Create New Menu Category</h5>
                                <hr>
                                <form action="<?= base_url('users/createMenuCategory'); ?> " method="post">
                                    <div class="mb-3">
                                        <label for="inputMenuCategory" class="form-label">Add Menu Category</label>
                                        <input type="text" class="form-control" id="inputMenuCategory" name="inputMenuCategory" placeholder="Menu Category Name">
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-primary ">Save Menu Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="mt-3">
                                <h5 class="fw-bold text-primary">Create New Menu</h5>
                                <hr>
                                <form action="<?= base_url('users/createMenu'); ?>" method="post">
                                    <div class="mb-3">
                                        <label for="inputMenuCategory" class="form-label">Menu Category</label>
                                        <select name="inputMenuCategory" id="inputMenuCategory" class="form-control">
                                            <option value=""> -- Choose Menu Category --</option>
                                            <?php foreach ($MenuCategories as $menuCategory) : ?>
                                                <option value="<?= $menuCategory['id']; ?>"><?= $menuCategory['menu_category']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputMenuTitle" class="form-label">Menu Title</label>
                                        <input type="text" class="form-control" id="inputMenuTitle" name="inputMenuTitle">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputMenuURL" class="form-label">Menu URL</label>
                                        <input type="text" class="form-control" id="inputMenuURL" name="inputMenuURL">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputMenuIcon" class="form-label">Menu Icon</label>
                                        <input type="text" class="form-control" id="inputMenuIcon" name="inputMenuIcon">
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-primary ">Save Menu</button>
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
<script>
    $('.menu_category_permission').on('click', function() {
        const menuCategoryId = $(this).data('menucategory');
        const roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('users/changeMenuCategoryPermission'); ?>",
            type: 'post',
            data: {
                menuCategoryID: menuCategoryId,
                roleID: roleId
            },
            success: function() {
                // alert('User Access has been changed !');
                location.reload();
            }
        });
    });
    $('.menu_permission').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('users/changeMenuPermission'); ?>",
            type: 'post',
            data: {
                menuID: menuId,
                roleID: roleId
            },
            success: function() {
                // alert('User Access has been changed !');
                location.reload();
            }
        });
    });
</script>
<?= $this->endSection(); ?>