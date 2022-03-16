<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <h1 class="h3 mb-3"><strong><?= $role['role_name']; ?></strong> Access Menu </h1>
    <div class="card">
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
                            <?php foreach ($Menus as $menu) : if ($menu['menu_category_id'] == $menuCategory['id']) : ?>
                                    <tr>
                                        <td><?= $menu['title']; ?></td>
                                        <td class="d-none d-md-table-cell">/<?= $menu['url']; ?></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input menu_permission" type="checkbox" <?= check_menu_access($role['id'], $menu['menu_id']) ?> data-role="<?= $role['id'] ?>" data-menu="<?= $menu['menu_id'] ?>">
                                                <label class="form-check-label">
                                                    <?= (check_menu_access($role['id'], $menu['id']) == 'checked') ? 'Access Granted' : 'Access Not Granted' ?>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php foreach ($Submenus as $subMenu) :  if ($menu['id'] == $subMenu['menu_id']) : ?>
                                            <tr>
                                                <td>
                                                    <p class="ms-4"> <?= $subMenu['submenu_title']; ?></p>
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <p class="ms-4">/<?= $subMenu['submenu_url']; ?></p>
                                                </td>
                                                <td>
                                                    <div class="form-check ms-4">
                                                        <input class="form-check-input submenu_permission" type="checkbox" <?= check_submenu_access($role['id'], $subMenu['submenu_id']) ?> data-role="<?= $role['id'] ?>" data-submenu="<?= $subMenu['submenu_id'] ?>">
                                                        <label class="form-check-label">
                                                            <?= (check_submenu_access($role['id'], $subMenu['submenu_id']) == 'checked') ? 'Access Granted' : 'Access Not Granted' ?>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php endif;
                                    endforeach; ?>
                            <?php endif;
                            endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
    $('.submenu_permission').on('click', function() {
        const submenuID = $(this).data('submenu');
        const roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('users/changeSubMenuPermission'); ?>",
            type: 'post',
            data: {
                submenuID: submenuID,
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