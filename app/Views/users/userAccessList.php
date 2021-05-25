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
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Url</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menu as $menu) : ?>
                            <tr>
                                <td><?= $menu['title']; ?></td>
                                <td class="d-none d-md-table-cell">/<?= $menu['url']; ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input menu_permission" type="checkbox" id="flexCheckDefault" <?= check_menu_access($role['id'], $menu['id']) ?> data-role="<?= $role['id'] ?>" data-menu="<?= $menu['id'] ?>">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?= (check_menu_access($role['id'], $menu['id']) == 'checked') ? 'Access Granted' : 'Access Not Granted' ?>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-sm-6  d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Role Access Form</h5>
                </div>
                <div class="card-body">
                    <hr>
                    <h5 class="fw-bold text-primary">Create New Role</h5>
                    <form action="<?= base_url('users/createRole'); ?> " method="post">
                        <div class="mb-3">
                            <label for="inputRoleName" class="form-label">Add Role</label>
                            <input type="text" class="form-control" id="inputRoleName" name="inputRoleName" placeholder="Role Name">
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary ">Save Role</button>
                        </div>
                    </form>
                    <hr>
                    <h5 class="fw-bold text-primary">Create New Menu</h5>
                    <form action="<?= base_url('users/createMenu'); ?>" method="post">
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
<script>
    $('.menu_permission').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('users/changeAccessPermission'); ?>",
            type: 'post',
            data: {
                menuID: menuId,
                roleID: roleId
            },
            success: function() {
                alert('User Access has been changed !');
            }
        });
    });
</script>
<?= $this->endSection(); ?>