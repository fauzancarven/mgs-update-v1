<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MGS APP - Login</title>
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/logo.png" />
  <!--   
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bootstrap-5.3.3/css/bootstrap.min.css">   -->

  <!-- remix icon font css  -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/remixicon.css">
  <!-- BootStrap css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/bootstrap.min.css">
  <!-- Apex Chart css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/apexcharts.css">
  <!-- Data Table css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/dataTables.min.css">
  <!-- Text Editor css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/editor-katex.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/editor.atom-one-dark.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/editor.quill.snow.css">
  <!-- Date picker css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/flatpickr.min.css">
  <!-- Calendar css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/full-calendar.css">
  <!-- Vector Map css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/jquery-jvectormap-2.0.5.css">
  <!-- Popup css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/magnific-popup.css">
  <!-- Slick Slider css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/slick.css">
  <!-- prism css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/prism.css">
  <!-- file upload css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/file-upload.css">

  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/lib/audioplayer.css">
  <!-- main css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/woowdash/assets/css/style.css">
</head>

<body>


  <section class="auth bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
      <div class="d-flex align-items-center flex-column h-100 justify-content-center background-auth">
        <img src="<?=base_url()?>assets/images/auth.png" class="light-logo"> 
        <img src="<?=base_url()?>assets/images/authdark.png" class="dark-logo">  
      </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
      <div class="max-w-464-px mx-auto w-100">
        <div class="d-flex justify-content-end">
        <button type="button" data-theme-toggle
                            class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                            id="togle-dark-mode"></button></div>
        <div>
          <a href="<?=base_url()?>" class="mb-40 max-w-290-px logo-auth"> 
                <img src="<?= base_url() ?>assets/woowdash/assets/images/w-logo.png"
                    alt="site logo" class="light-logo">
                <img src="<?= base_url() ?>assets/woowdash/assets/images/w-logo-light.png"
                    alt="site logo" class="dark-logo"> 
          </a>
          <h4 class="mb-12">Login Aplikasi</h4>
          <p class="mb-32 text-secondary-light text-lg">Selamat datang kembali! silahkan masukan email dan password anda</p>
        </div>
        <?= view('Myth\Auth\Views\_message_block') ?>
        <?= csrf_field() ?>

        <form action="<?= url_to('login') ?>" method="post">

          <div class="icon-field mb-16">
            <span class="icon top-50 translate-middle-y">
              <iconify-icon icon="mage:email"></iconify-icon>
            </span>
            <input type="text" name="login" class="form-control h-56-px bg-neutral-50 radius-12 <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>">
          </div>
          <div class="position-relative mb-20">
            <div class="icon-field">
              <span class="icon top-50 translate-middle-y">
                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
              </span>
              <input type="password" name="password" id="password" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Password">
            </div>
            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#password"></span>
          </div>
          <div class="">
            <div class="d-flex justify-content-between gap-2">

              <?php if ($config->allowRemembering) : ?> 
                <div class="form-switch switch-primary d-flex align-items-center gap-3">
                    <input class="form-check-input" type="checkbox" name="remember"  role="switch" id="switch11" <?php if (old('remember')) : ?> checked <?php endif ?>>
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch11"> <?= lang('Auth.rememberMe') ?></label>
                </div>  
              <?php endif; ?>
            </div>
          </div>

          <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign In</button>

          <!-- <div class="mt-32 center-border-horizontal text-center">
            <span class="bg-base z-1 px-4">Or sign in with</span>
          </div>
          <div class="mt-32 d-flex align-items-center gap-3">
            <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
              <iconify-icon icon="ic:baseline-facebook" class="text-primary-600 text-xl line-height-1"></iconify-icon>
              Google
            </button>
            <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
              <iconify-icon icon="logos:google-icon" class="text-primary-600 text-xl line-height-1"></iconify-icon>
              Google
            </button>
          </div>
          <div class="mt-32 text-center text-sm">
            <p class="mb-0">Don’t have an account? <a href="sign-up.html" class="text-primary-600 fw-semibold">Sign Up</a></p>
          </div> -->

        </form>
      </div>
    </div>
  </section>


  <!-- jQuery library js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/jquery-3.7.1.min.js"></script>
  <!-- Bootstrap js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/bootstrap.bundle.min.js"></script>
  <!-- Apex Chart js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/apexcharts.min.js"></script>
  <!-- Data Table js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/dataTables.min.js"></script>
  <!-- Iconify Font js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/iconify-icon.min.js"></script>
  <!-- jQuery UI js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/jquery-ui.min.js"></script>
  <!-- Vector Map js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
  <!-- Popup js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/magnifc-popup.min.js"></script>
  <!-- Slick Slider js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/slick.min.js"></script>
  <!-- prism js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/prism.js"></script>
  <!-- file upload js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/file-upload.js"></script>
  <!-- audioplayer -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/lib/audioplayer.js"></script>

  <!-- main js -->
  <script src="<?=base_url()?>assets/woowdash/assets/js/app.js"></script>

  <script>
    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
      $(toggleSelector).on('click', function() {
        $(this).toggleClass("ri-eye-off-line");
        var input = $($(this).attr("data-toggle"));
        if (input.attr("type") === "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
    // ========================= Password Show Hide Js End ===========================
  </script>
</body>

</html>