<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Users</strong> Menu </h1>
    <div class="row">
        <div class="col-12 col-lg-8 col-xxl-9 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Users List <button class="btn btn-primary float-end">Create New User</button></h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="d-none d-xl-table-cell">Username</th>
                            <th>Role</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Users as $users) : ?>
                            <tr>
                                <td><?= $users['fullname']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $users['username']; ?></td>
                                <td><span class="badge bg-success"><?= $users['role_name']; ?></span></td>
                                <td><?= $users['created_at']; ?></td>
                                <td>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-bs-fullname="<?= $users['fullname']; ?>" data-bs-username="<?= $users['username']; ?>" data-bs-role="<?= $users['role']; ?>">Update</button>
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure delete <?= $users['username']; ?> ?')">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">User Roles</h5>
                </div>
                <div class="card-body d-flex">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($UserRole as $userRole) : ?>
                                <tr>
                                    <td><?= $userRole['role_name']; ?></td>
                                    <td><a href="<?= base_url('users/userRoleAccess?role=' . $userRole['id']); ?>"> <span class="badge bg-primary">Access Menu</span></a></td>
                                    <td>
                                        <form action="<?= base_url('users/deleteRole/' . $userRole['id']); ?>" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">New message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="inputFullname" class="col-form-label">Full Name:</label>
                        <input type="text" class="form-control" id="inputFullname">
                    </div>
                    <div class="mb-3">
                        <label for="inputUsername" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="inputUsername">
                    </div>
                    <div class="mb-3">
                        <label for="inputRole" class="col-form-label">Role:</label>
                        <select name="inputRole" id="inputRole" class="form-control">
                            <option value="">-- Choose User Role --</option>
                            <option value="1">Role A</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
<script>
    let updateUserModal = document.getElementById('updateUserModal');
    updateUserModal.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget;
        let fullname = button.getAttribute('data-bs-fullname');
        let username = button.getAttribute('data-bs-username');
        let modalTitle = updateUserModal.querySelector('.modal-title');
        let inputFullname = updateUserModal.querySelector('#inputFullname');
        let inputUsername = updateUserModal.querySelector('#inputUsername');
        let inputRole = updateUserModal.querySelector('#inputRole');

        modalTitle.textContent = 'Update data  ' + fullname;
        inputFullname.value = fullname;
        inputUsername.value = username;
        inputRole.value = role;

    });
</script>
<?= $this->endSection(); ?>