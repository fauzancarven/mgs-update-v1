<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRM ADSITE.ID</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>document/app_image/logo/logo-adsite-2.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-3">
                    <div class="card col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo text-center">
                                <img src="<?= base_url() ?>document/image/lock.gif" style="width: 70px;" class="mb-3">
                            </div>
                            <h4 class="text-center"><?= lang('Auth.resetYourPassword') ?></h4>
                            <p class="font-weight-light lh-base text-center"><?= lang('Auth.enterCodeEmailPassword') ?></p>


                            <?= view('Myth\Auth\Views\_message_block') ?>
                            <form action="<?= url_to('reset-password') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label for="token"><?= lang('Auth.token') ?></label>
                                    <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.token') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email"><?= lang('Auth.email') ?></label>
                                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.email') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password"><?= lang('Auth.newPassword') ?></label>
                                    <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password">
                                    <div class="invalid-feedback">
                                        <?= session('errors.password') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>
                                    <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm">
                                    <div class="invalid-feedback">
                                        <?= session('errors.pass_confirm') ?>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.resetPassword') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url(); ?>assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url(); ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url(); ?>assets/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url(); ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>assets/js/template.js"></script>
    <script src="<?= base_url(); ?>assets/js/settings.js"></script>
    <script src="<?= base_url(); ?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url(); ?>assets/js/dashboard.js"></script>
    <script src="<?= base_url(); ?>assets/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>