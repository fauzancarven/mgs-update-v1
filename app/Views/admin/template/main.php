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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">  
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/select2.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/daterangepicker.css"> 
    
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/croppie.css">  
    <link href="<?= base_url("assets/fontawesome.6.7.1/css/fontawesome.css") ?>" rel="stylesheet" type="text/css"> 
    <link href="<?= base_url("assets/fontawesome.6.7.1/css/solid.css") ?>" rel="stylesheet" type="text/css"> 
    <!-- End plugin css for this page -->
    <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/logo.png" />


</head>
<!-- sidebar-icon-only hide this-->


<style>
    /*  */

    .btn-group-sm .btn-fab {
        position: fixed !important;
        right: 20px;

    }

    .btn-group .btn-fab {
        position: fixed !important;
        right: 20px;
        z-index: 9999999999;
    }

    #main {
        bottom: 20px;
        z-index: 9999999999;
    }



    #leads {
        bottom: 70px;
        z-index: 9999999999;
    }

    #group {
        bottom: 120px;
        z-index: 9999999999;
    }

    #adduser {
        bottom: 170px;
        z-index: 9999999999;
    }

    .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    --bs-gutter-x: 0;
    }
    a.icon-rotate-90 {
        transform: rotate(90deg);
    }

    /*  */

    .hidden {
        display: none;
    }

    .nav-item.active svg path,
    .nav-item.active .nav-link svg path,
    .nav-item:hover svg path,
    .nav-link:hover svg path {
        stroke: #ffffff;
        /* Warna putih */
    }
    .sidebar .nav:not(.sub-menu) > .nav-item:hover > .nav-link, .sidebar .nav:not(.sub-menu) > .nav-item:hover[aria-expanded="true"] {
        background: #002247c4;
        color: #fff;
    }
    /* .content-wrapper {
        background: #f6f6f9; 
    } */
    
    @media (max-width: 767px) {
        .content-wrapper {
            padding: 0.5rem;
        } 
    }

    .input-form{
        min-height: calc(1.5em + .5rem + calc(var(--bs-border-width)* 2));
        height:   1.575rem;
    }
    .input-form:focus{
        border: solid #00b0ff 1px;
        outline: 0;
        box-shadow: 0 0 0 0.1rem rgb(3 169 244 / 13%);
    }
    
    .input-form::placeholder{
        color: #d7d9db;
        opacity: 1; /* Firefox */
    } 
    .input-form::-ms-input-placeholder { /* Edge 12 -18 */
        color: #d7d9db;
    }
    .select2-container--default .select2-selection--single{
        padding: 0;
    }
    
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #6C9BCF;
        color: white;
    }
    .btn-primary{
        background-color: #4292eb;
        border-color: #709ac9;
    }
    .btn-primary:hover{
        background-color: #6C9BCF;
        border-color: #709ac9;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n) {
        background: #4292eb;
    } 
    .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n+1) {
        background: #4292eb;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n+2) {
        background: #4292eb;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n+3) {
        background: #4292eb;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n+4) {
        background: #4292eb;
    } 
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        line-height: 1.5;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: solid #8ca8d17a 1px;
        outline: 0;
        box-shadow: 0 0 0 0.1rem rgb(3 169 244 / 13%);
    }

    .border-header{
        border: 1px solid #d7d7d7;
        height: 20px;
        width: 1px;
    }
    div.dt-processing>div:last-child{
        display:none;
    }
    .image-default-obi,.image-default-obi.border{ 
        transition: all 0.3s ease-in-out;
        border: 2px dashed #dedede;
        width: 7.5rem;
        height: 7.5rem;
        border-radius: 0.5rem;
        margin: 0.25rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .image-default-obi span {
        font-size: 0.75rem;
        color: gray;
    }
    .image-default-obi i {
        font-size: 2rem;
        color: gray;
    }
    .image-default-obi:hover,.image-default-obi.border:hover  {
        border-color: #7bc8ff;
        color: #7bc8ff;
        cursor: pointer;
    }
    .image-default-obi:hover i ,.image-default-obi:hover span{ 
        color: #7bc8ff; 
    }
    .image-default-obi img {
        width: 7rem;
        height: 7rem;
        object-fit: cover;
    }
    .image-default-obi:hover img {
        filter: blur(1px);
    }
    .image-default-obi .action {
        position: absolute;
        bottom: 0;
        right: 0;
        display: none;
    }
    .image-default-obi:hover .action {
        display: block;
    }
    .image-default-obi .action .btn i {
        font-size: 1rem;
    }

    @media (max-width: 400px) {
        .modal .modal-dialog .modal-content .modal-footer { 
            flex-direction: row;
        } 
    } 
    .btn i{
        font-size:0.75rem;
    }
    .modal-footer{
        flex-wrap: wrap;
        flex-direction: row !important;
        column-gap: 8px;
    } 
    .modal{ 
        font-size: 0.75rem;
        color: #7d7d7d;
    } 

    .modal .modal-dialog .modal-content .modal-footer > :not(:last-child) {
        margin-right: 0;
        margin-bottom: 0.25rem;
    } 

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #6C9BCF;
        color: white;
    }
    .select2-container--default .select2-results__option--selected {
        background-color: #ddd;
    }
    .list-group-item.active {
        z-index: 2;
        color: white;
        background-color:   #002247;
        border-color: #002247;
    }
    
    .label-border-right {
        text-align: left;
        width: 100%;
        border-bottom: 1px solid #dee2e6;
        line-height: 0.1em; 
    }
    .label-border-right .label-dialog {
        background: #fff;
        padding: 0 10px;
        color: #002247;
        font-size: 0.75rem;
        font-weight: bold;
    }
    span.label-dialog {
        background: #002247;
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 0.25rem;
    } 
    .nav-item.sub {

    }
    .sidebar .nav.sub-menu {
        background: #f5faff;
    } 
    .sidebar .nav.sub-menu .nav-item .nav-link {
        color: #4d4d4d; 
    }

    
    .sidebar .nav.sub-menu .nav-item::before {
        content: '';
        width: 0;
        height: 0;
        position: absolute;
        margin-top: 0;
        border-radius: 0%; 
    }

    .sidebar .nav.sub-menu {
        margin-bottom: 0;
        margin-top: 0;
        list-style: none;
        padding: 0.25rem 0 0 0; 
        padding-bottom: 12px;
    }
    
    .sidebar .nav.sub-menu .nav-item {
        border-radius:8px;
    }
   
    .sidebar .nav.sub-menu .nav-item:hover {
        background: #002247c4;
        color: #fff; 
    } 
    .sidebar  .hover-open .nav.sub-menu .nav-item {
        border-radius:0;
    }
    .sidebar  .hover-open .nav.sub-menu .nav-item {
        border-radius:0;
    }
    /* .sidebar .nav.sub-menu .nav-item .nav-link:hover {
        color: #0d6efd !important;
    }
    .sidebar .nav.sub-menu .nav-item .nav-link:hover i{
        color: #0d6efd  !important;
    }  */
    /* .sidebar .nav.sub-menu .nav-item:hover > .nav-link i,
    .sidebar .nav.sub-menu .nav-item:hover > .nav-link .menu-title,
    .sidebar .nav.sub-menu .nav-item:hover > .nav-link .menu-arrow { 
        color: #0d6efd  !important;
    } */
    .sidebar .nav:not(.sub-menu) > .nav-item > .nav-link[aria-expanded="true"] { 
        background: #305176;
    }
    .sidebar .nav.sub-menu .nav-item {
        margin: 0.25rem;
    }
    .sidebar-icon-only .sidebar .nav.sub-menu {
        padding: 0rem;
    } 
    .sidebar-icon-only .sidebar .nav .nav-item.hover-open .nav-link .menu-title {
        background: #002247;
    } 
    .sidebar-icon-only .sidebar .nav.sub-menu .nav-item span {
        color: #4d4d4d;
        background: #f5faff !important;
        width: auto;
        box-shadow: none;
    }
    .sidebar-icon-only .sidebar .nav.sub-menu .nav-item i {
        width: 0 !important;
        display: none;
    }
    .sidebar-icon-only .sidebar .nav.sub-menu .nav-item span {
        border-radius: 0;
        left: 0px !important;
        box-shadow: none !important;
        background:none !important
    } 
    .sidebar-icon-only .sidebar .nav.sub-menu .nav-item .nav-link{
        border-radius:none;
        height: 2rem;  
    } 
    .navbar-toggler:focus{
        box-shadow:none;
    }
    /* .sidebar-icon-only .sidebar .nav.sub-menu .nav-link:hover{  
        background:red !important
    } */
    .card{
        border:none;
    }
    .sidebar .nav .nav-item .nav-link i.fa-solid {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        margin-left: auto;
        margin-right: 0; 
    }
    .sidebar .nav .nav-item .nav-link i.fa-solid:before { 
        display: block;
        font-size: 0.687rem;
        line-height: 10px;
        -webkit-transition: all 0.2s ease-in;
    }
    .sidebar .nav .nav-item .nav-link[aria-expanded="true"] i.fa-solid:before {
        -moz-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    
    .sidebar-icon-only .sidebar .nav .nav-item .nav-link i.fa-solid:before { 
        display: none; 
    }
     
    .btn-action.btn-primary{ 
        background: #f5f6f7;
        border: none;
        color: black;
        padding: 0 1rem;
        border-radius: 1rem !important; 
    }
    .btn-action.btn-primary i{  
        color: #1574db;
    }
    
    .btn-action.btn-primary:hover{ 
        background: #e6e8f1;
        color: black;
    } 
    
    .btn-action.btn-danger{ 
        background: #f5f6f7;
        border: none;
        color: black;
        padding: 0 1rem;
        border-radius: 1rem !important; 
    }
    .btn-action.btn-danger i{  
        color: red;
    }
    
    .btn-action.btn-danger:hover{ 
        background: #e6e8f1;
        color: black;
    } 

    
    .btn-action.btn-warning{ 
        background: #f5f6f7;
        border: none;
        color: black;
        padding: 0 1rem;
        border-radius: 1rem !important; 
    }
    .btn-action.btn-warning i{  
        color: orange;
    }
    
    .btn-action.btn-warning:hover{ 
        background: #e6e8f1;
        color: black;
    } 

    .modal-backdrop{
        --bs-backdrop-opacity: 0.25;
    }
    .modal-content {
        border: none;
        box-shadow: 0 0 24px 2px #a1a1a1;
    }

    table.dataTable.table.table-hover>tbody>tr:hover>* {
        box-shadow: inset 0 0 0 9999px rgb(80 158 255 / 8%);
    }
    .dropdown-item i{
        color: #1574db; 
    }
    .dropdown-item i.fa-pencil{
        color: #1574db; 
    }
    .dropdown-item i.fa-key{
        color: orange; 
    }
    .dropdown-item i.fa-trash{
        color: red; 
    }
    .dropdown-item i.fa-close{
        color: red; 
    }

    .simple-pagination ul {
        margin: 0 0 20px;
        padding: 0;
        list-style: none;
        text-align: left;
    }

    .simple-pagination li {
        display: inline-block;
        margin-right: 5px;

    }

    .simple-pagination li a,
    .simple-pagination li span {
        color: #666;
        padding: 8px 12px;
        text-decoration: none;
        background-color: #FFF;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    .simple-pagination .current {
        color: #0B1460;
        background-color: #fff;
        border: 1px;
        border-style: solid;
    }

    .simple-pagination .prev.current,
    .simple-pagination .next.current {
        background: #fff;
    }

    .swiper-wrapper {
        position: relative;
        width: 100%;
        /* height: 63px !important; */
        height: 45px !important;
    }
    .image-upload{
        border: 1px solid grey;
        width:200px;
        height:200px;
        border-radius:50%;
    }

    .pagination .page-item.active .page-link {
        color: white;
        background: #305176;
        border: 1px solid #0022476b;
    }
    .dt-info , .dt-paging{
        padding-top:2rem;
    }
    td {
        padding: 1rem 0.5rem !important;
        border-bottom: 1px solid #cbcbcb !important;
    }

    .form-control:focus{
        border: solid #8ca8d17a 1px !important;
        outline: 0  !important;
        box-shadow: 0 0 0 0.1rem rgb(3 169 244 / 13%)  !important;
    } 

    .swal2-styled.swal2-confirm{
        background-color: #4292eb;
        border-color: #709ac9;
    }

    #list-produk .image-default-obi:first-child .badge{
        display: block;
        position: absolute;
        left: -7px;
        top: -7px;
    }

    #list-produk .image-default-obi:not(:first-child) .badge{
        display: none;
    }
    .image-default-obi.dragover {
      border-color: #007bff;
      background-color: #e7f0ff;
      transform: scale(1.1);
      box-shadow: 10px 10px 20px rgba(0, 123, 255, 0.3);
    }
    span.label-head-dialog {
        font-size: 0.75rem;
        font-weight: bold;
        color: #17293f;
    }
    .font-std{
        font-size: 0.7rem !important;
    }
    .detail{  
        opacity: 1; 
    } 
    .detail.hide{  
        display: none;
        opacity: 0;
        transition: opacity .3s ease,  display .3s ease allow-discrete; /* <-- check this line */
    }   
    .fa-solid{
        transition: transform 0.5s ease 0s;
    } 
</style>


<div class="d-lg-none w-100 " style="
   
    height: 15rem;
    position: absolute;
    left: 0;
    top: 0;
    border-radius: 0px 0px 30px 30px; 
">


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



<body class="<?= $session->sidebar === "false" ? "sidebar-icon-only" : ""; ?>"> <!-- class="sidebar-icon-only" -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    

    <!-- plugins:js -->
    <script src="<?= base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url(); ?>assets/vendors/chart.js/Chart.min.js"></script>   
    <script src="<?= base_url(); ?>assets/js/datatables.min.js"></script>  
    <script src="<?= base_url(); ?>assets/js/sweetalert2.min.js"></script> 

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
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
                    <li class="nav-item <?= ($title === 'Project' ? "active" : "") ?>">
                        <a class="nav-link" href="<?= base_url(); ?>admin/project">
                            <i class="ti-blackboard menu-icon"></i>
                            <span class="menu-title">Project</span>
                        </a> 
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






</body>

</html>