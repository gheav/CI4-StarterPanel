<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-3"><strong><?= $title; ?></strong> Menu </h1>
<div class="row">
    <div class="col-12 col-lg-4 col-xxl-4 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Database Table</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('crudGenerator'); ?> " method="get">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>-- Select Table --</option>
                        <?php foreach ($Tables as $table) : ?>
                            <option value="1"><?= $table; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <hr>
                    <div class="form-group">
                        <label for="" class="fw-bold">Generate Function</label>
                        <div class="input-group mt-2 ">
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">Create</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                <label class="form-check-label" for="inlineCheckbox2">Read</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                <label class="form-check-label" for="inlineCheckbox3">Update</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                <label class="form-check-label" for="inlineCheckbox3">Delete</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary" type="button">Generate Code</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8 col-xxl-8 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="align-middle" data-feather="code"></i> Source Code </h5>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h3 class="fw-bold">Controller</h3>

                    </div>
                    <div class="col-sm-4 ">
                        <h3 class="fw-bold">Model</h3>

                    </div>
                    <div class="col-sm-4 ">
                        <h3 class="fw-bold">View</h3>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 border">
                        <h5 class="fw-bold"> Read</h5>
                        <br>
                        <h5 class="fw-bold"> Insert</h5>
                        <br>
                        <h5 class="fw-bold"> Update</h5>
                        <br>
                        <h5 class="fw-bold"> Delete</h5>

                    </div>
                    <div class="col-sm-4 border">
                        <h5 class="fw-bold"> Read</h5>
                        <br>
                        <h5 class="fw-bold"> Insert</h5>
                        <br>
                        <h5 class="fw-bold"> Update</h5>
                        <br>
                        <h5 class="fw-bold"> Delete</h5>

                    </div>
                    <div class="col-sm-4 border">
                        <h5 class="fw-bold"> Read</h5>
                        <br>
                        <h5 class="fw-bold"> Insert</h5>
                        <br>
                        <h5 class="fw-bold"> Update</h5>
                        <br>
                        <h5 class="fw-bold"> Delete</h5>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>