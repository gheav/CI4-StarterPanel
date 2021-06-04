<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Gheav">
    <meta name="keywords" content="Gheav, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <title>CodeIgniter 4 - Bootstrap 5 Admin Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="<?= base_url('assets/js/app.js') ?>"></script>

</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome to Admin CodeIgniter 4</h1>
                            <p class="lead">
                                Register New Account
                            </p>
                        </div>
                        <?= $this->include('common/alerts'); ?>
                        <div class="card">
                            <form action="<?= base_url('register'); ?>" method="POST">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <div class="text-center">
                                            <img src="<?= base_url('assets/img/avatars/avatar.jpg') ?>" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input class="form-control form-control-lg" type="text" name="inputFullname" placeholder="Enter your name" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="inputEmail" placeholder="Enter your email" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="inputPassword" placeholder="Enter your password" required />

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Repeat Password</label>
                                            <input class="form-control form-control-lg" type="password" name="inputPassword2" placeholder="Repeat your password" required />
                                            <small>
                                                <a href="<?= base_url() ?>">Have an account? Login</a>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="ms-4">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
                                            <span class="form-check-label">
                                                I Agree to the terms and conditions
                                            </span>
                                        </label>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
    </main>
</body>

</html>