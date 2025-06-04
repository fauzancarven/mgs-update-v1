<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MGSAPP - <?= $title ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css"> 
    <!-- endinject -->
    <!-- Plugin css for this page --> 

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/select.dataTables.min.css">  
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datatables.min.css">    
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/sweetalert2.min.css">  
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vertical-layout-light/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bootstrap-5.3.3/css/bootstrap.min.css">  
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/select2.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/daterangepicker.css"> 
    
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/croppie.css">  
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/quill.snow.css"> 
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/quill.bubble.css">  
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.2.2/quill.bubble.css" integrity="sha512-WQTpL51Eas4VrSAIGPsbEyoB5Uh8SL71rO35yGllJzaxuvP0LQB630JBYKI5dSxUdDLP4UYH0VXZ8ECiOPVqcA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.2.2/quill.snow.css" integrity="sha512-13R80ZrT2yyT/Fphe32GH8p3rn5Z6ZM4ComBrMSo2l4z4ZhoGXyMzKj306k54f6WUwzxmJ6zzT0/MngfkWmftw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/fontawesome.6.7.1/css/fontawesome.css") ?>" > 
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/fontawesome.6.7.1/css/solid.css") ?>" >  
    <!-- End plugin css for this page -->
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/logo.png" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" 
	  href="https://static.eu1.mindsphere.io/mdsp-css/v2.7.0/css/mdsp-css.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/custom-view.css">  
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/custom-datatable.css">  

</head>
<!-- sidebar-icon-only hide this-->

 
 



<body class="<?= $session->sidebar === "false" ? "sidebar-icon-only" : ""; ?>"> <!-- class="sidebar-icon-only" -->
 
    <div class="d-lg-none w-100 " style="height: 3rem; position: absolute;left: 0; top: 0; border-radius: 0px 0px 30px 30px;">
        <div class=" d-flex justify-content-between px-4 pt-3"> 
            <h4 class="text-primary pt-2"> <?= $title; ?></h4> 
            <div class="d-flex">
                <div class="dropdown dropdown-animated scale-left" class="d-flex">
                    <a href="javascript:void(0);" data-toggle="dropdown">
                        <svg width="24" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="  ml-2"> 
                            <path d="M8.62504 20.8265V21.7218C8.62504 22.0746 8.6994 22.4238 8.84389 22.7497C8.98837 23.0756 9.20014 23.3717 9.46711 23.6211C9.73408 23.8706 10.051 24.0684 10.3998 24.2034C10.7486 24.3384 11.1225 24.4079 11.5 24.4079C11.8776 24.4079 12.2514 24.3384 12.6003 24.2034C12.9491 24.0684 13.266 23.8706 13.533 23.6211C13.7999 23.3717 14.0117 23.0756 14.1562 22.7497C14.3007 22.4238 14.375 22.0746 14.375 21.7218V20.8265M17.25 13.6637C17.25 16.3497 19.1667 20.8265 19.1667 20.8265H3.83337C3.83337 20.8265 5.75004 17.2451 5.75004 13.6637C5.75004 10.7377 8.36821 8.29166 11.5 8.29166C14.6319 8.29166 17.25 10.7377 17.25 13.6637Z" stroke="#0B1460" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <?php if (!empty($notif)) : ?>
                                <ellipse cx="16.5" cy="7.00704" rx="7.5" ry="7.00704" fill="#E24848" />
                            <?php endif; ?>

                        </svg>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown overflow-auto py-3 border-0" style="border-radius: 20px; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;" aria-labelledby="notificationDropdown">
                        <p class="mb-3 pb-3 float-left dropdown-header text-primary medium border-bottom w-100" style="font-weight: 900;">Notifications</p>
    
                        <?php if (!empty($notif)) : ?>
                            <div class="preview-list overflow-auto" style="max-height: 200px; width:350px;">

                                <?php foreach ($notif as $ntf) : ?>

                                    <?php if (!in_groups('admin')) : ?>

                                        <form action="<?= base_url() ?>opened" method="post">
                                            <input type="hidden" name="id" value="<?= $ntf['id']; ?>">
                                            <input type="hidden" name="category" value="<?= $ntf['category']; ?>">
                                            <input type="hidden" name="status" value="Opened">

                                            <button class="dropdown-item preview-item d-flex align-items-center" type="submit">

                                                <?php if ($ntf['category'] == "New Lead") : ?>
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-success">
                                                            <i class="ti-user mx-0"></i>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="preview-item-content ">

                                                    <h6 class="preview-subject font-weight-normal my-1 text-primary"><?= $ntf['info']; ?> </h6>
                                                    <p class="font-weight-light small-text mb-0 text-muted">
                                                        <?= date('D M Y H:i:s', strtotime($ntf['created_at'])); ?>
                                                    </p>

                                                </div>
                                            </button>
                                        </form>

                                    <?php endif; ?>

                                    <?php if (in_groups('admin')) : ?>

                                        <div class="dropdown-item preview-item d-flex align-items-center">

                                            <?php if ($ntf['category'] == "New Lead") : ?>
                                                <div class="preview-thumbnail">
                                                    <div class="preview-icon bg-success">
                                                        <i class="ti-info-alt mx-0"></i>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="preview-item-content ">

                                                <h6 class="preview-subject font-weight-normal my-1 text-primary"><?= $ntf['info']; ?> </h6>
                                                <p class="font-weight-light small-text mb-0 text-muted">
                                                    <?= date('D M Y H:i:s', strtotime($ntf['created_at'])); ?>
                                                </p>

                                            </div>
                                        </div>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                            </div>
                        <?php else : ?>
                            <div class="preview-list overflow-auto d-flex justify-content-center align-items-center" style="height: 100px; width:350px;">
                                <span>No new data</span>
                            </div>
                        <?php endif; ?>
                        <div class="border-top d-flex justify-content-center align-items-center py-2 mt-3">
                            <a href="<?= base_url() ?>mark_opened" class="pt-3 text-primary text-decoration-none">Mark all as read</a>
                        </div>
                    </div>

                </div> 
                <!-- TOGGLE MOBILE --> 
                <div>
                    <a href="javascript:void(0);" data-toggle="dropdown"> <!-- data-toggle=" dropdown" -->
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-3"> 
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M28 8V10.6667H4V8H28ZM28 24H20V21.3333H28V24ZM12 17.3333H28V14.6667H12V17.3333Z" stroke-width="1" fill="#0B1460" /> 
                        </svg>
                    </a>

                    <div class="p-b-15 p-t-20 dropdown-menu pop-profile  ">
                        <a class="dropdown-item my-3" href="<?= base_url() ?>edit_user">
                            <i class="ti-settings text-primary"></i>
                            Account
                        </a>
                        <a class="dropdown-item my-3" href="#" data-toggle="modal" data-target="#logout">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>



                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- logout Modal-->
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
        <div class="modal-dialog " role="document">
            <div class="modal-content" style="border-radius : 20px;" style="border-radius : 20px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body text-center">Are you sure want to end this session ?</div>
                <div class="modal-footer ">
                    <div class="row d-flex col-12 px-0 py-2">
                        <div class="col-6">
                            <button class="btn btn-secondary w-100" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-6">
                            <a type="button" href="<?= base_url() ?>logout" class="btn btn-primary w-100"> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url(); ?>assets/vendors/chart.js/Chart.min.js"></script>   
    <script src="<?= base_url(); ?>assets/js/datatables.min.js"></script>  
    <script src="<?= base_url(); ?>assets/js/sweetalert2.min.js"></script> 

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    
    <script src="<?= base_url(); ?>assets/bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>assets/js/template.js"></script>
    <script src="<?= base_url(); ?>assets/js/settings.js"></script>
    <script src="<?= base_url(); ?>assets/js/todolist.js"></script>
    <script src="<?= base_url(); ?>assets/js/daterangepicker.js"></script>
    <script src="<?= base_url(); ?>assets/js/cleave.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cleave-phone.id.js"></script>
     
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url(); ?>assets/js/dashboard.js"></script>
    <script src="<?= base_url(); ?>assets/js/Chart.roundedBarCharts.js"></script>
    
    <script src="<?= base_url(); ?>assets/js/select2.min.js"></script> 
    <!-- End custom js for this page-->

    <script src="<?= base_url(); ?>assets/js/croppie.min.js">  </script> 
    <!-- <script src="https://cdn.jsdelivr.net/npm/highlight.js@11.6.0/dist/highlight.min.js"></script>  -->
    <!-- <script src=" https://cdnjs.cloudflare.com/ajax/libs/quill/1.2.2/quill.min.js"></script>  -->
    <script src="<?= base_url(); ?>assets/js/quill.js">  </script>  
    <!-- <script src="<?= base_url(); ?>assets/quill-image-resize-module-master/image-resize.min.js">  </script>   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> 


    <script src="<?= base_url(); ?>assets/js/jquery.redirect.js">  </script> 
    
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js" integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+" crossorigin="anonymous"></script> 
    <script>
        const socket = io("wss://socket.mahieraglobalsolution.com"); 
        socket.on('message', function(msg) { 
            tampilkanNotifikasi(msg);
        });  
        socket.on('load-project', function(msg) { 
            tampilkanNotifikasi(msg);
        });
        $('.toast').toast({
            delay: 5000,
            animation: true,
            autohide: true,
        });

        function tampilkanNotifikasi(pesan) { 
            const toast = $('<div class="toast m-1" role="alert" aria-live="assertive" aria-atomic="true"></div>');
            const toastHeader = $('<div class="toast-header">' + pesan["icon"] + '<strong class="me-auto">' + pesan["title"] + '</strong><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div>');
            const toastBody = $('<div class="toast-body"></div>');
            
            toastBody.text(pesan["message"]);
            
            toast.append(toastHeader);
            toast.append(toastBody); 
            $('#toast-container').append(toast);
            
            toast.toast({
                delay: 3000,
                animation: true,
                autohide: true,
            });
            
            toast.toast('show');
        }
    </script> 
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast-container"></div>
    <div class="container-scroller" style="background: #f5f7ff;">  
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-lg-flex d-none flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/logo/logo-blue.png" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/logo/logo.png" alt=" logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                
                <!-- <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul> -->
                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="icon-bell mx-0"></i>
                            <?php if (!empty($notif)) : ?>
                                <span class="count bg-danger"></span>
                            <?php endif; ?>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right  navbar-dropdown py-3 border-0" style="border-radius: 20px;" aria-labelledby="notificationDropdown">
                            <p class="mb-3 pb-3 float-left dropdown-header text-primary medium border-bottom w-100" style="font-weight: 900;">Notifications</p>

                            <?php if (!empty($notif)) : ?>
                                <div class="preview-list overflow-auto" style="max-height: 250px; width:350px;">

                                    <?php foreach ($notif as $ntf) : ?>

                                        <?php if (!in_groups('admin')) : ?>

                                            <form action="<?= base_url() ?>opened" method="post">
                                                <input type="hidden" name="id" value="<?= $ntf['id']; ?>">
                                                <input type="hidden" name="category" value="<?= $ntf['category']; ?>">
                                                <input type="hidden" name="status" value="Opened">

                                                <button class="dropdown-item preview-item d-flex align-items-center" type="submit">

                                                    <?php if ($ntf['category'] == "New Lead") : ?>
                                                        <div class="preview-thumbnail">
                                                            <div class="preview-icon bg-success">
                                                                <i class="ti-user mx-0"></i>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="preview-item-content ">

                                                        <h6 class="preview-subject font-weight-normal my-1 text-primary"><?= $ntf['info']; ?> </h6>
                                                        <p class="font-weight-light small-text mb-0 text-muted">
                                                            <?= date('D M Y H:i:s', strtotime($ntf['created_at'])); ?>
                                                        </p>

                                                    </div>
                                                </button>
                                            </form>

                                        <?php endif; ?>

                                        <?php if (in_groups('admin')) : ?>

                                            <div class="dropdown-item preview-item d-flex align-items-center">

                                                <?php if ($ntf['category'] == "New Lead") : ?>
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-success">
                                                            <i class="ti-info-alt mx-0"></i>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="preview-item-content ">

                                                    <h6 class="preview-subject font-weight-normal my-1 text-primary"><?= $ntf['info']; ?> </h6>
                                                    <p class="font-weight-light small-text mb-0 text-muted">
                                                        <?= date('D M Y H:i:s', strtotime($ntf['created_at'])); ?>
                                                    </p>

                                                </div>
                                            </div>

                                        <?php endif; ?>

                                    <?php endforeach; ?>

                                </div>
                            <?php else : ?>
                                <div class="preview-list overflow-auto d-flex justify-content-center align-items-center" style="height: 100px; width:350px;">
                                    <span>No new data</span>
                                </div>
                            <?php endif; ?>
                            <div class="border-top d-flex justify-content-center align-items-center py-2 mt-3">
                                <a href="<?= base_url() ?>mark_opened" class="pt-3 text-primary text-decoration-none">Mark all as read</a>
                            </div>

                        </div>

                    </li> 
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown"> 
                            <img src="<?= base_url(); ?>assets/images/profile/user/<?= user()->code; ?>.png" alt="profile" /> 
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="<?= base_url() ?>edit_user">
                                <i class="ti-settings text-primary"></i>
                                Account
                            </a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logout">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    <!-- <li class="nav-item nav-settings d-none d-lg-flex">
                        <a class="nav-link" href="#">
                            <i class="icon-ellipsis"></i>
                        </a>
                    </li> -->
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav> 
        <!-- SIDEBAR -->
        <div class="container-fluid page-body-wrapper">

            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                            
                    <li class="nav-item <?= ($title === 'Dashboard' ? "active" : "") ?>">
                        <a class="nav-link" href="<?= base_url(); ?>admin">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li> 
                     
                    <li class="nav-item <?= ($menu === 'Master' ? "active" : "") ?>">
                        <a class="nav-link menu-header" data-toggle="collapse" href="#ui-basic" aria-expanded="<?= ($menu === 'Master' ? "true" : "false") ?>">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Master Data</span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </a> 
                        <div class="collapse <?= ($menu === 'Master' ? "show" : "") ?>" id="ui-basic">
                            <ul class="nav flex-column sub-menu"> 
                                <li class="nav-item <?= ($title === 'Store' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/store">
                                        <i class="ti-home menu-icon"></i>
                                        <span class="menu-title">Store</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title === 'Account' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/account">
                                        <i class="ti-user menu-icon"></i>
                                        <span class="menu-title">Account</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title === 'Customer' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/customer">
                                        <i class="ti-id-badge menu-icon"></i>
                                        <span class="menu-title">Customer</span> 
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title === 'Vendor' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/vendor">
                                        <i class="ti-dropbox menu-icon"></i>
                                        <span class="menu-title">Vendor</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title === 'Produk' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/produk">
                                        <i class="ti-package menu-icon"></i>
                                        <span class="menu-title">Produk</span>
                                    </a>
                                </li> 
                            </ul>
                        </div> 
                    </li>  
                    <li class="nav-item <?= ($menu === 'Project' ? "active" : "") ?>">
                        <a class="nav-link menu-header" data-toggle="collapse" href="#ui-basic-1" aria-expanded="<?= ($menu === 'Project' ? "true" : "false") ?>">
                            <i class="ti-blackboard menu-icon"></i>
                            <span class="menu-title">Project</span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </a> 
                        <div class="collapse <?= ($menu === 'Project' ? "show" : "") ?>" id="ui-basic-1">
                            <ul class="nav flex-column sub-menu"> 
                                <li class="nav-item <?= ($title === 'List Project' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/project">
                                        <i class="ti-home menu-icon"></i>
                                        <span class="menu-title">List Project</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title === 'Survey' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/project/survey">
                                        <i class="ti-home menu-icon"></i>
                                        <span class="menu-title">Survey</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title === 'Sample' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/project/sample">
                                        <i class="ti-user menu-icon"></i>
                                        <span class="menu-title">Sample</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title === 'Penawaran' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/project/penawaran">
                                        <i class="ti-id-badge menu-icon"></i>
                                        <span class="menu-title">Penawaran</span> 
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title === 'Invoice' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/project/invoice">
                                        <i class="ti-package menu-icon"></i>
                                        <span class="menu-title">Invoice</span>
                                    </a>
                                </li> 
                                <li class="nav-item <?= ($title === 'Pembelian' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/project/pembelian">
                                        <i class="ti-dropbox menu-icon"></i>
                                        <span class="menu-title">Pembelian</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title === 'Pengiriman' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/project/pengiriman">
                                        <i class="ti-package menu-icon"></i>
                                        <span class="menu-title">Pengiriman</span>
                                    </a>
                                </li> 
                                <li class="nav-item <?= ($title === 'Spk' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/project/spk">
                                        <i class="ti-package menu-icon"></i>
                                        <span class="menu-title">Perintah Kerja (SPK)</span>
                                    </a>
                                </li> 
                            </ul>
                        </div> 
                    </li>  
                    <!-- <li class="nav-item <?= ($title === 'Project' ? "active" : "") ?>">
                        <a class="nav-link" href="<?= base_url(); ?>admin/project">
                            <i class="ti-blackboard menu-icon"></i>
                            <span class="menu-title">Project</span>
                        </a> 
                    </li>    -->
                    
                    <li class="nav-item <?= ($menu === 'Inventory' ? "active" : "") ?>">
                        <a class="nav-link menu-header" data-toggle="collapse" href="#ui-inventory" aria-expanded="<?= ($menu === 'Inventory' ? "true" : "false") ?>">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Inventory</span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </a> 
                        <div class="collapse <?= ($menu === 'Inventory' ? "show" : "") ?>" id="ui-inventory">
                            <ul class="nav flex-column sub-menu"> 
                                <li class="nav-item <?= ($title === 'Stock' ? "active" : "") ?>"> 
                                    <a class="nav-link" href="<?= base_url(); ?>admin/stock">
                                        <i class="ti-view-list-alt menu-icon"></i>
                                        <span class="menu-title">Stock Barang</span>
                                    </a>
                                </li> 
                            </ul>
                        </div> 
                    </li>  
                    <li class="nav-item <?= ($title === 'Accounting' ? "active" : "") ?>">
                        <a class="nav-link" href="<?= base_url(); ?>admin/accounting">
                            <i class="ti-money menu-icon"></i>
                            <span class="menu-title">Accounting</span>
                        </a> 
                    </li>   
                </ul>
            </nav>



            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <?= $this->renderSection('content'); ?>




                </div>


                <!-- <footer class="footer d-lg-block d-none">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright <a href="https://www.adsite.id/" target="_blank">©Adsite.id</a> </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">CRM APP <i class="ti-heart text-danger ml-1"></i></span>
                    </div>

                </footer> -->

            </div>

        </div> 
    </div>

    <script>
        function select2OptionFormat(option) {
            var originalOption = option.element;
            if ($(originalOption).data('html')) {
                return $(originalOption).data('html');
            }          
            return option.text;
        }
        $(".navbar-toggler").click(function(){ 
            $.ajax({ 
                method: "POST",
                url: "<?= base_url() ?>admin/sidebar", 
                data:{
                    "sidebar": ($('body').attr("class") == "sidebar-icon-only" ? true : false)
                },
                success: function(data) {   
                },
                fail: function(xhr, textStatus, errorThrown){ 
                }
            }); 
        });
        const rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }
    </script>





    <!-- NAVBAR MOBILE -->
    <div class=" bg-white fixed-bottom py-3 d-lg-none d-block shadow">
        <div class="container-fluid"> 
            <div class="row d-flex align-items-center  "> 
                <a href="<?= base_url("/admin") ?>" class="col d-flex justify-content-center  text-decoration-none p-1 active">
                    <span class="icon-holder text-center">
                        <i class="icon-grid menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Dashboard</span>
                    </span>
                </a>  
                <a href="javascript:void(0);" data-toggle="dropdown"  class="col d-flex justify-content-center  text-decoration-none p-1"> 
                    <span class="icon-holder text-center">
                        <i class="icon-layout menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Master</span>
                    </span>
                </a> 
                <!-- <a  class="col d-flex justify-content-center  text-decoration-none p-1 active dropdown-toggle" id="dropdownMenuSizeButton3" data-bs-toggle="dropdown" aria-haspopup="true">
                    <span class="icon-holder text-center">
                        <i class="icon-layout menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Master</span>
                    </span>
                </a>  -->
                <div class="dropdown-menu w-auto" aria-labelledby="dropdownMenuSizeButton3" data-popper-placement="bottom-start">
                    <!-- <h6 class="dropdown-header">Settings</h6> -->
                    <a class="dropdown-item" href="<?= base_url("/admin/store") ?>"><i class="ti-home pe-2"></i>Store</a>
                    <a class="dropdown-item" href="<?= base_url("/admin/account") ?>"><i class="ti-user pe-2"></i>Account</a>
                    <a class="dropdown-item" href="<?= base_url("/admin/customer") ?>"><i class="ti-id-badge pe-2"></i>Customer</a>
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" href="<?= base_url("/admin/vendor") ?>"><i class="ti-dropbox pe-2"></i>Vendor</a>
                    <a class="dropdown-item" href="<?= base_url("/admin/produk") ?>"><i class="ti-package pe-2"></i>Produk</a>
                </div>
  
                <!--                 
                <div class="dropdown">
                    <button class="btn btn-danger btn-sm dropdown-toggle show" type="button" id="dropdownMenuSizeButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" fdprocessedid="cgamd5g">
                    Dropdown
                    </button>
                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuSizeButton3" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 33px);">
                        <h6 class="dropdown-header">Settings</h6>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div> -->
                <!-- <a href="<?= base_url("/admin/store") ?>" class="col d-flex justify-content-center  text-decoration-none p-1">
                    <span class="icon-holder text-center">
                        <i class="ti-home menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Store</span>
                    </span>
                </a>
                <a href="<?= base_url("/admin/account") ?>" class="col d-flex justify-content-center  text-decoration-none p-1">
                    <span class="icon-holder text-center">
                        <i class="ti-user menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Account</span>
                    </span>
                </a>
                <a href="<?= base_url("/admin/customer") ?>" class="col d-flex justify-content-center  text-decoration-none p-1">
                    <span class="icon-holder text-center">
                        <i class="ti-id-badge menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Customer</span>
                    </span>
                </a>
                <a href="<?= base_url("/admin/vendor") ?>" class="col d-flex justify-content-center  text-decoration-none p-1">
                    <span class="icon-holder text-center">
                        <i class="ti-package menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Vendor</span>
                    </span>
                </a>
                <a href="<?= base_url("/admin/produk") ?>" class="col d-flex justify-content-center  text-decoration-none p-1">
                    <span class="icon-holder text-center">
                        <i class="ti-package menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Produk</span>
                    </span>
                </a> -->
                <a href="<?= base_url("/admin/project") ?>" class="col d-flex justify-content-center  text-decoration-none p-1">
                    <span class="icon-holder text-center">
                        <i class="ti-blackboard menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Project</span>
                    </span>
                </a>
                <a href="<?= base_url("/admin/accounting") ?>" class="col d-flex justify-content-center  text-decoration-none p-1">
                    <span class="icon-holder text-center">
                        <i class="ti-money menu-icon text-primary mb-1"></i><br>
                        <span class="text-dark" style="font-size: 7pt">Accounting</span>
                    </span>
                </a>

                <?php if (in_groups('admin')) : ?>
                    <div class="col d-flex justify-content-center p-0 text-decoration-none">
                        <button type="button" class="btn px-3 py-1 mx-3 " id="showButton" style="border-radius:15px; background: rgb(0,83,158); background: linear-gradient(0deg, rgba(0,83,158,1) 0%, rgba(32,30,92,1) 93%);">
                            <div id="addIcon" class="material-icons py-2 text-decoration-none" style="font-size: 20px; color:#fff;">+</div>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (in_groups('admin')) : ?>
                    <a href="<?= base_url("/users") ?>" class="col d-flex justify-content-center text-decoration-none">
                        <span class="icon-holder text-center">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.4583 10.625C15.0231 10.625 16.2916 11.8935 16.2916 13.4583V14.875H14.875M11.3333 7.7024C12.5553 7.38787 13.4583 6.27855 13.4583 4.95833C13.4583 3.63811 12.5553 2.52879 11.3333 2.21426M9.20831 4.95833C9.20831 6.52314 7.93979 7.79167 6.37498 7.79167C4.81017 7.79167 3.54165 6.52314 3.54165 4.95833C3.54165 3.39353 4.81017 2.125 6.37498 2.125C7.93979 2.125 9.20831 3.39353 9.20831 4.95833ZM3.54165 10.625H9.20831C10.7731 10.625 12.0416 11.8935 12.0416 13.4583V14.875H0.708313V13.4583C0.708313 11.8935 1.97684 10.625 3.54165 10.625Z" stroke="#0B1460" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" />
                            </svg><br>
                            <span class="text-dark" style="font-size: 7pt">Users</span>
                        </span><br>
                    </a>
                <?php endif; ?>

                <!-- <?php if (in_groups('admin')) : ?>
                    <a href="<?= base_url("pages") ?>" class="col d-flex justify-content-center text-decoration-none">
                        <span class="icon-holder text-center">
                            <i class="ti-id-badge menu-icon text-primary " style="font-size: large;"></i><br>
                            <span class="text-dark" style="font-size: 7pt">Undangan</span>
                        </span>
                    </a>
                <?php endif; ?> -->

                <!-- <?php if (in_groups('users')) : ?>
                    <a href="<?= base_url("edit_page/" . user()->id) ?>" class="col d-flex justify-content-center text-decoration-none">
                        <span class="icon-holder text-center">
                            <i class="ti-id-badge menu-icon text-primary " style="font-size: large;"></i><br>
                            <span class="text-dark" style="font-size: 7pt">Edit Undangan</span>
                        </span>
                    </a>
                <?php endif; ?>


                <?php if (in_groups('users')) : ?>

                    <a href="<?= base_url("edit_user") ?>" class="col d-flex justify-content-center text-decoration-none">
                        <span class="icon-holder text-center">
                            <i class="ti-user menu-icon text-primary mb-3"></i><br>
                            <span class="text-dark" style="font-size: 7pt">Account</span>
                        </span>
                    </a>

                <?php endif; ?> -->


            </div>

        </div>
    </div>


    <!-- Add Option --> 
    <div class="card add hidden w-100" style="position: fixed; bottom :0px; height: 40%; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
        <div class="card-header" style="background: none;">
            <div class="row d-flex align-items-center">
                <div class="col-6 ">
                    <h5 class="card-title my-3 ">Add Data</h5>
                </div>
                <div class="col-6">
                    <button id="closeButton" class="close mt-0">x</button> <!-- &times;-->
                </div>
            </div>
        </div>
        <div class="card-body">
            <a class="btn btn-primary w-100 mb-2" href="<?= base_url(); ?>add_user">Register New User</a>
        </div>
    </div>


    <!-- Limited Modal-->
    <div class="modal fade " id="limited" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content " style="border-radius : 20px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Info</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span >×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-1 text-danger"> Akun anda dibatasi. <br> Silahkan lanjutkan pembayaran untuk mulai menggunaakan aplikasi. </p>
                    <br>
                    <a href="<?= base_url(); ?>billing" class="btn btn-primary mb-3">Cek pembayaran</a>
                </div>

            </div>
        </div>
    </div>


    <!-- 
    <script>
        document.getElementById("showButton").addEventListener("click", function() {
            var card = document.querySelector(".card.add");
            card.classList.toggle("hidden");
        });

        document.getElementById("closeButton").addEventListener("click", function() {
            var card = document.querySelector(".card.add");
            card.classList.add("hidden");
        });
    </script> --> 
    <div id="modal-message"></div>
</body>

</html>