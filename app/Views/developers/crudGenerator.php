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
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold">Menu</label>
                        <select class="form-select" name="menu" required>
                            <option value="">-- Select Menu --</option>
                            <?php foreach ($Tables as $tables) : ?>
                                <option value="<?= $tables; ?>" <?= ($menu == $tables) ? 'selected' : ''; ?>><?= $tables; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold">Table</label>
                        <select class="form-select" name="table" required>
                            <option value="">-- Select Table --</option>
                            <?php foreach ($Tables as $tables) : ?>
                                <option value="<?= $tables; ?>" <?= ($tableName == $tables) ? 'selected' : ''; ?>><?= $tables; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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
                <?php
                $functionName   = str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $tableName))));
                $modelName      = str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $menu))));
                $title          = ucwords(strtolower(str_replace('_', ' ', $menu)));

                ?>

                <?php if ($file == 'controller') : ?>
                    <h5 class="fw-bold"> Constructor</h5>
                    <hr>
                    <pre>
                <code class="text-primary">
    function __construct()
    {
        $this-&gt;<?= $modelName ?>Model = new <?= $modelName ?>();
    }
                </code>
                </pre>
                    <hr>
                    <?php if ($read) : ?>
                        <h5 class="fw-bold"> Read</h5>
                        <hr>
                        <pre>
                <code class="text-primary">
    public function index()
    {
        $data = array_merge($this->data, [
            'title'     =&gt; <?= $title; ?>,
            '<?= $functionName; ?>'    =&gt; $this-&gt;<?= $modelName; ?>Model->get<?= $functionName; ?>()
        ]);
        return view('<?= $menu; ?>', $data);
    }
                </code>
                </pre>
                        <hr>
                    <?php endif; ?>
                    <?php if ($create) : ?>
                        <h5 class="fw-bold"> Insert</h5>
                        <hr>
                        <pre>
                <code class="text-primary">
    public function create<?= $functionName; ?>()
    {
        $create<?= $functionName; ?> = $this-&gt;<?= $modelName; ?>Model-&gt;create<?= $functionName; ?>($this->request->getPost(null, FILTER_SANITIZE_STRING));
        if ($create<?= $functionName; ?>) {
            session()-&gt;setFlashdata('notif_success', '&lt;b&gt;Successfully added new <?= ucwords(strtolower(str_replace('_', ' ', $tableName))); ?>&lt;/b&gt;');
            return redirect()-&gt;to(base_url('<?= $menu; ?>'));
        } else {
            session()-&gt;setFlashdata('notif_error', '&lt;b&gt;Failed to add new <?= ucwords(strtolower(str_replace('_', ' ', $tableName))); ?>&lt;/b&gt;');
            return redirect()-&gt;to(base_url('<?= $menu; ?>'));
        }
    }
                    </code>
                </pre>
                        <hr>
                    <?php endif; ?>
                    <?php if ($update) : ?>
                        <h5 class="fw-bold"> Update</h5>
                        <hr>
                        <pre>
                <code class="text-primary">
        public function update<?= $functionName; ?>()
        {
            $update<?= $functionName; ?> = $this-&gt;<?= $modelName; ?>Model-&gt;update<?= $functionName; ?>($this-&gt;request-&gt;getPost(null, FILTER_SANITIZE_STRING));
            if ($update<?= $functionName; ?>) {
                session()-&gt;setFlashdata('notif_success', '&lt;b&gt;Successfully update <?= ucwords(strtolower(str_replace('_', ' ', $tableName))); ?>&lt;/b&gt;');
                return redirect()-&gt;to(base_url('<?= $menu; ?>'));
            } else {
                session()-&gt;setFlashdata('notif_error', '&lt;b&gt;Failed to update <?= ucwords(strtolower(str_replace('_', ' ', $tableName))); ?>&lt;/b&gt;');
                return redirect()-&gt;to(base_url('<?= $menu; ?>'));
            }
        }
                </code>
                </pre>
                        <hr>
                    <?php endif; ?>
                    <?php if ($delete) : ?>
                        <h5 class="fw-bold"> Delete</h5>
                        <hr>
                        <pre>
                <code class="text-primary">

        public function delete<?= $functionName ?>($<?= $functionName ?>ID)
        {
            if (!$<?= $functionName ?>ID) {
                return redirect()-&gt;to(base_url('<?= $menu; ?>'));
            }
            $delete<?= $functionName ?> = $this-&gt;<?= $modelName; ?>Model-&gt;delete<?= $functionName ?>($<?= $functionName ?>ID);
            if ($delete<?= $functionName ?>) {
                session()-&gt;setFlashdata('notif_success', '&lt;b&gt;Successfully delete <?= ucwords(strtolower(str_replace('_', ' ', $tableName))); ?>&lt;/b&gt;');
                return redirect()-&gt;to(base_url('<?= $menu; ?>'));
            } else {
                session()-&gt;setFlashdata('notif_error', '&lt;b&gt;Failed to delete <?= ucwords(strtolower(str_replace('_', ' ', $tableName))); ?>&lt;/b&gt;');
                return redirect()-&gt;to(base_url('<?= $menu; ?>'));
            }
        }
                    </code>
                </pre>
                    <?php endif; ?>

                <?php elseif ($file == 'model') : ?>
                    <?php if ($read) : ?>
                        <h5 class="fw-bold"> Read</h5>
                        <hr>
                        <pre>
                <code class="text-primary">
    public function get<?= $functionName ?>($<?= $functionName ?>ID = false)
    {
        if ($<?= $functionName ?>ID) {
            return $this-&gt;db-&gt;table('<?= $tableName; ?>')
            -&gt;where(['<?= $tableName; ?>.id' =&gt; $<?= $functionName ?>ID])
            -&gt;get()-&gt;getRowArray();
        } else {
            return $this-&gt;db-&gt;table('<?= $tableName; ?>')
            -&gt;get()-&gt;getResultArray();
        }
    }
                </code>
                </pre>
                        <hr>
                    <?php endif; ?>
                    <?php if ($create) : ?>
                        <h5 class="fw-bold"> Insert</h5>
                        <hr>
                        <pre>
                <code class="text-primary">
    public function create<?= $functionName ?>($data<?= $functionName ?>)
    {
        return $this-&gt;db-&gt;table('<?= $tableName ?>')-&gt;insert([<?php foreach ($Fields as $field) : if (!$field->primary_key == 1) : ?><br>          '<?= $field->name; ?>'     	=&gt; $data<?= $functionName ?>['input<?= str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $field->name)))); ?>'],<?php endif;
                                                                                                                                                                                                                                                                                                                    endforeach; ?> 
        ]);
    }
                    </code>
                </pre>
                        <hr>
                    <?php endif; ?>
                    <?php if ($update) : ?>
                        <h5 class="fw-bold"> Update</h5>
                        <hr>
                        <pre>
                <code class="text-primary">
    public function update<?= $functionName ?>($data<?= $functionName ?>)
    {
        return $this-&gt;db-&gt;table('<?= $tableName ?>')-&gt;update([<?php foreach ($Fields as $field) : if (!$field->primary_key == 1) : ?><br>          '<?= $field->name; ?>'     	=&gt; $data<?= $functionName ?>['input<?= str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $field->name)))); ?>'],<?php endif;
                                                                                                                                                                                                                                                                                                                    endforeach; ?> 
            ], ['id' => $data<?= $functionName ?>['input<?= $functionName ?>ID']]);
    }
                </code>
                </pre>
                        <hr>
                    <?php endif; ?>
                    <?php if ($delete) : ?>
                        <h5 class="fw-bold"> Delete</h5>
                        <hr>

                        <pre>
                <code class="text-primary">

    public function delete<?= $functionName ?>($<?= $functionName ?>ID)
	{
		return $this->db->table('<?= $tableName ?>')->delete(['id' => $<?= $functionName ?>ID]);
	}

                </code>
                </pre>
                    <?php endif; ?>
                <?php elseif ($file == 'view') : ?>
                    <h5 class="fw-bold"> Form</h5>
                    <hr>
                    <pre>
                        <code class="text-primary">
    &lt;form action=&quot;&lt;?= base_url('create<?= $functionName; ?>'); ?&gt;&quot; method=&quot;post&quot;&gt;
        <?php foreach ($Fields as $field) : ?>&lt;div class=&quot;form-group&quot;&gt;
            &lt;label for=&quot;input<?= str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $field->name)))); ?>&quot;&gt;<?= ucwords(strtolower(str_replace('_', ' ',  $field->name))); ?>&lt;/label&gt;
            &lt;input type=&quot;text&quot; class=&quot;form-control&quot; name=&quot;input<?= str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $field->name)))); ?>&quot; id=&quot;input<?= str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $field->name)))); ?>&quot; required&gt;
        &lt;/div&gt; <?php endforeach; ?> 
        &lt;div class=&quot;d-grid gap-2 mt-3&quot;&gt;
                        &lt;button class=&quot;btn btn-primary&quot; type=&quot;submit&quot;&gt;Save Data&lt;/button&gt;
                    &lt;/div&gt;
    &lt;/form&gt;
                        </code>
                    </pre>
                    <h5 class="fw-bold"> List</h5>
                    <hr>
                    <pre>
                        <code class="text-primary">
    &lt;table class=&quot;table&quot;&gt;
        &lt;thead&gt; <br><?php foreach ($Fields as $field) : ?>           &lt;th&gt;<?= ucwords(strtolower(str_replace('_', ' ',  $field->name))); ?>&lt;/th&gt; <br><?php endforeach; ?>         &lt;/thead&gt;
        &lt;tbody&gt;
        &lt;?php foreach($<?= $functionName; ?> as $<?= strtolower($functionName); ?> ): ?&gt;   
            &lt;tr&gt; <?php foreach ($Fields as $field) : ?> <br>                &lt;td&gt;&lt;?= $<?= strtolower($functionName); ?>['<?= $field->name; ?>'] ?&gt; &lt;/td&gt; <?php endforeach; ?> 
            &lt;/tr&gt;
        &lt;?php endforeach; ?&gt;
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