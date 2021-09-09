<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<style>
    code {
        background-color: #F5F7FB;

        border-radius: 0.3rem;
        padding: 4px 5px 5px;
        white-space: nowrap;
    }

    pre code {
        white-space: inherit;
    }

    pre {
        background-color: #F5F7FB;
        padding: 5px;
        border-radius: 0.3em;
    }
</style>
<h1 class="h3 mb-3"><strong><?= $title; ?></strong> Menu </h1>
<div class="row">
    <div class="col-12 col-lg-4 col-xxl-4 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Database Table</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('crudGenerator'); ?> " method="get">
                    <select class="form-select" name="table" required>
                        <option value="">-- Select Table --</option>
                        <?php foreach ($Tables as $table) : ?>
                            <option value="<?= $table; ?>" <?= ($tableName == $table) ? 'selected' : ''; ?>><?= $table; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <hr>
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold">Generate Function</label>
                        <div class="input-group mt-2 ">
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="create" value="1" <?= ($create == 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="inlineCheckbox1">Create</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="read" value="1" <?= ($read == 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="inlineCheckbox2">Read</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="update" value="1" <?= ($update == 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="inlineCheckbox3">Update</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="delete" value="1" <?= ($delete == 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="inlineCheckbox3">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold">File</label>
                        <div class="input-group mt-2 ">
                            <select class="form-select" name="file" required>
                                <option value="">-- Select File --</option>
                                <option value="controller" <?= ($file == 'controller') ? 'selected' : ''; ?>>Controller</option>
                                <option value="model" <?= ($file == 'model') ? 'selected' : ''; ?>>Model</option>
                                <option value="view" <?= ($file == 'view') ? 'selected' : ''; ?>>View</option>
                            </select>
                        </div>
                    </div>
                    <hr>

                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary" type="submit">Generate Code</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8 col-xxl-8 d-flex">
        <div class="card border flex-fill">
            <div class="card-header mb-0">
                <h5 class="card-title "> Source Code </h5>
            </div>
            <div class="card-body">
                <?php if ($file == 'controller') : ?>
                    <h5 class="fw-bold"> Read</h5>
                    <hr>
                    <pre>
                <code class="text-primary">
        public function index()
        {
            $this->Model->getData();
        }
                </code>
                </pre>
                    <hr>
                    <h5 class="fw-bold"> Insert</h5>
                    <hr>
                    <pre>
                <code class="text-primary">
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
                    </code>
                </pre>
                    <hr>
                    <h5 class="fw-bold"> Update</h5>
                    <hr>
                    <pre>
                <code class="text-primary">
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
                </code>
                </pre>
                    <h5 class="fw-bold"> Delete</h5>
                    <hr>
                    <pre>
                <code class="text-primary">

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
                </code>
                </pre>
                <?php elseif ($file == 'model') : ?>
                    <h5 class="fw-bold"> Read</h5>
                    <hr>
                    <pre>
                <code class="text-primary">
    public function getUser($username = false, $userID = false)
	{
		if ($username) {
			return $this->db->table('users')
				->select('*,users.id AS userID,user_role.id AS role_id')
				->join('user_role', 'users.role = user_role.id')
				->where(['username' => $username])
				->get()->getRowArray();
		} elseif ($userID) {
			return $this->db->table('users')
				->select('*,users.id AS userID,user_role.id AS role_id')
				->join('user_role', 'users.role = user_role.id')
				->where(['users.id' => $userID])
				->get()->getRowArray();
		} else {
			return $this->db->table('users')
				->select('*,users.id AS userID,user_role.id AS role_id')
				->join('user_role', 'users.role = user_role.id')
				->get()->getResultArray();
		}
	}
                </code>
                </pre>
                    <hr>
                    <h5 class="fw-bold"> Insert</h5>
                    <hr>
                    <pre>
                <code class="text-primary">
    public function createMenu($dataMenu)
	{
		return $this->db->table('user_menu')->insert([
			'menu_category'	=> $dataMenu['inputMenuCategory'],
			'title'			=> $dataMenu['inputMenuTitle'],
			'url' 			=> $dataMenu['inputMenuURL'],
			'icon' 			=> $dataMenu['inputMenuIcon'],
			'parent' 		=> 0
		]);
	}
                    </code>
                </pre>
                    <hr>
                    <h5 class="fw-bold"> Update</h5>
                    <hr>
                    <pre>
                <code class="text-primary">
    return $this->db->table('users')->update([
			'fullname'		=> $dataUser['inputFullname'],
			'username' 		=> $dataUser['inputUsername'],
			'password' 		=> $password,
			'role' 			=> $dataUser['inputRole'],
		], ['id' => $dataUser['userID']]);
                </code>
                </pre>
                    <h5 class="fw-bold"> Delete</h5>
                    <hr>
                    <pre>
                <code class="text-primary">

    public function deleteUser($userID)
	{
		return $this->db->table('users')->delete(['id' => $userID]);
	}

                </code>
                </pre>
                <?php elseif ($file == 'view') : ?>
                    <pre>
                        <code class="text-primary">
    &lt;table class=&quot;table&quot;&gt;
        &lt;thead&gt;
            &lt;th&gt;&lt;/th&gt;
        &lt;/thead&gt;
        &lt;tbody&gt;
            &lt;tr&gt;
              &lt;td&gt;&lt;/td&gt;
            &lt;/tr&gt;
        &lt;/tbody&gt;
    &lt;/table&gt;
                        </code>
                    </pre>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>