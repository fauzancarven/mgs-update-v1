<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>

<style>
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
</style>
 

<div class="">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome <?= user()->username?></h3>
                    <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
                </div>
                <div class="col-12 col-xl-4">
                    <!-- <div class="justify-content-end d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                <a class="dropdown-item" href="#">January - March</a>
                                <a class="dropdown-item" href="#">March - June</a>
                                <a class="dropdown-item" href="#">June - August</a>
                                <a class="dropdown-item" href="#">August - November</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div> 
    <h5 class="font-weight-normal mb-0 p-2 fw-bold">Master Data</h5>
    <div class="d-flex g-2 flex-md-row flex-column">
        <a class="card card-tale m-2" style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/store") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="fa-solid fa-store fa-4x"></i> 
                <p class="pt-4 fw-bold">STORE</p> 
            </div>
        </a>
        <a class="card card-dark-blue m-2"  style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/account") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="fa-solid fa-user fa-4x"></i>
                <span class="pt-4 fw-bold">ACCOUNT</span> 
            </div>
        </a>
        <a class="card tale-bg m-2"  style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/customer") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="fa-solid fa-users fa-4x"></i>
                <p class="pt-4 fw-bold">CUSTOMER</p> 
            </div>
        </a>
        <a class="card card-light-blue m-2"  style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/vendor") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="fa-solid fa-cart-flatbed-suitcase fa-4x"></i>
                <p class="pt-4 fw-bold">VENDOR</p> 
            </div>
        </a>
        <a class="card card-light-danger m-2"  style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/produk") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="fa-solid fa-basket-shopping fa-4x"></i>
                <p class="pt-4 fw-bold">PRODUK</p> 
            </div>
        </a>
    </div> 
    <h5 class="font-weight-normal mb-0 p-2 fw-bold">Sales</h5> 
    <div class="d-flex g-2 flex-md-row flex-column">
        <a class="card card-dark-blue m-2"  style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/project") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="ti-blackboard menu-icon fa-4x"></i>
                <p class="pt-4 fw-bold">PROJECT</p> 
            </div>
        </a> 
        <a class="card card-dark-blue m-2"  style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/sales/survey") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="fa-solid fa-street-view fa-4x"></i>
                <p class="pt-4 fw-bold">Survey</p> 
            </div>
        </a> 
        <a class="card card-dark-blue m-2"  style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/sales/sample") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="fa-solid fa-truck-ramp-box fa-4x"></i>
                <p class="pt-4 fw-bold">Sample</p> 
            </div>
        </a> 
        <a class="card card-dark-blue m-2"  style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/sales/penawaran") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="fa-solid fa-hand-holding-droplet fa-4x"></i>
                <p class="pt-4 fw-bold">Penawaran</p> 
            </div>
        </a> 
        <a class="card card-dark-blue m-2"  style="cursor:pointer;text-decoration:none" href="<?= base_url("/admin/sales/invoice") ?>">
            <div class="card-body d-flex flex-column text-center">
                <i class="fa-solid fa-money-bill fa-4x"></i>
                <p class="pt-4 fw-bold">Invoice</p> 
            </div>
        </a>
    </div> 
   
    <div style="margin-bottom: 100px;"></div> 


    <!-- <div class="row">

        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Notifications</p>
                    <ul class="icon-data-list">
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face1.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Isabella Becker</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>9:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face2.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Adam Warren</p>
                                    <p class="mb-0">You have done a great job #TW111</p>
                                    <small>10:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face3.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Leonard Thornton</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>11:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face4.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">George Morrison</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>8:50 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face5.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Ryan Cortez</p>
                                    <p class="mb-0">Herbs are fun and easy to grow.</p>
                                    <small>9:00 am</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Notifications</p>
                    <ul class="icon-data-list">
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face1.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Isabella Becker</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>9:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face2.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Adam Warren</p>
                                    <p class="mb-0">You have done a great job #TW111</p>
                                    <small>10:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face3.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Leonard Thornton</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>11:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face4.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">George Morrison</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>8:50 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face5.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Ryan Cortez</p>
                                    <p class="mb-0">Herbs are fun and easy to grow.</p>
                                    <small>9:00 am</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Top Products</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Search Engine Marketing</td>
                                    <td class="font-weight-bold">$362</td>
                                    <td>21 Sep 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Search Engine Optimization</td>
                                    <td class="font-weight-bold">$116</td>
                                    <td>13 Jun 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Display Advertising</td>
                                    <td class="font-weight-bold">$551</td>
                                    <td>28 Sep 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pay Per Click Advertising</td>
                                    <td class="font-weight-bold">$523</td>
                                    <td>30 Jun 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Mail Marketing</td>
                                    <td class="font-weight-bold">$781</td>
                                    <td>01 Nov 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-danger">Cancelled</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Referral Marketing</td>
                                    <td class="font-weight-bold">$283</td>
                                    <td>20 Mar 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Social media marketing</td>
                                    <td class="font-weight-bold">$897</td>
                                    <td>26 Oct 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</div> -->

</div>


<!-- delete Group-->
<div class="modal fade" id="delete-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content" style="border-radius : 20px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">Are you sure want to delete this Group? <br> <span class="text-danger">asdasd</span></div>
            <div class="modal-footer ">
                <div class="row d-flex col-12 px-0 py-2">
                    <div class="col-6">
                        <button class="btn btn-secondary w-100" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-6">
                        <form action="<?= base_url(); ?>delete_group" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">

                            <button type="submit" class="btn btn-primary w-100"> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





























<?php $this->endSection(); ?>