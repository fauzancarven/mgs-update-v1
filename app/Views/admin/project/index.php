<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>
 

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?>
<div class="px-2">
<div class="d-flex align-items-center mb-4 "> 
    <div class="p-1 flex-fill" > 
        <h4 class="mb-0">LIST PROJECT</h4>  
    </div>     
    <div class="justify-content-end d-flex gap-1"> 
        <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-block ps-2">Tambah Project<span></button>
    </div>
</div>

<!-- BAGIAN FILTER -->
<div class="d-flex align-items-center justify-content-end mb-2 g-2 row search-data">  
    <div class="input-group d-sm-flex d-none">  
        <input class="form-control form-control-sm input-form" id="searchdatafilter" placeholder="Pilih Filter" value="" type="text" readonly style="background: white;">
        <i class="fa-solid fa-filter"></i>
        <i class="fa-solid fa-caret-down"></i>
        <div class="filter-data" for="searchdatafilter">
            <ul class="list-group">
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center utama">
                    <span class="ms-2 me-auto">Toko</span> 
                    <span class="badge text-bg-primary rounded-pill" id="badge-store"></span>
                    <i class="fa-solid fa-angle-right"></i>
                </li>
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center utama">
                    <span class="ms-2 me-auto">Kategori</span>
                    <span class="badge text-bg-primary rounded-pill"  id="badge-kategori"></span>
                    <i class="fa-solid fa-angle-right"></i>
                </li> 
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center utama">
                    <span class="ms-2 me-auto">Admin</span>
                    <span class="badge text-bg-primary rounded-pill"  id="badge-user"></span>
                    <i class="fa-solid fa-angle-right"></i>
                </li> 
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center utama">
                    <span class="ms-2 me-auto">Status Progress</span>
                    <span class="badge text-bg-primary rounded-pill"  id="badge-status"></span>
                    <i class="fa-solid fa-angle-right"></i>
                </li> 
            </ul>
        </div>
        <div class="filter-list" data-value="Toko">
            <ul class="list-group">
                <?php
                    foreach($store as $rows){
                        echo ' 
                        <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start " for="'.$rows->StoreCode.'">
                            <div class="form-check w-100">
                                <input class="form-check-input filter-array" type="checkbox" data-group="store" data-value="'.$rows->StoreId.'" value="'.$rows->StoreId.'" id="'.$rows->StoreCode.'">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="'.$rows->StoreCode.'">
                                    '.$rows->StoreCode.' 
                                </label>
                            </div> 
                        </li>';
                    }
                ?> 
            </ul>
        </div>
        <div class="filter-list" data-value="Kategori"> 
            <ul class="list-group">
                <?php
                    foreach($kategori as $rows){
                        echo ' 
                        <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start " for="'.$rows->id.$rows->name.'">
                            <div class="form-check w-100">
                                <input class="form-check-input filter-array" type="checkbox" data-group="kategori" data-value="'.$rows->name.'" id="cat-'.$rows->id.$rows->name.'">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="cat-'.$rows->id.$rows->name.'">
                                    '.$rows->name.' 
                                </label>
                            </div> 
                        </li>';
                    }
                ?>   
            </ul>
        </div>
        <div class="filter-list" data-value="Admin">
            <ul class="list-group">
            <?php
                    foreach($admin as $rows){
                        echo ' 
                        <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start " for="'.$rows->username.'">
                            <div class="form-check w-100">
                                <input class="form-check-input filter-array" type="checkbox" data-group="user" data-value="'.$rows->id.'" id="user-'.$rows->username.'">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="user-'.$rows->username.'">
                                    '.$rows->username.' 
                                </label>
                            </div> 
                        </li>';
                    }
                ?>  
            </ul>
        </div>
        <div class="filter-list" data-value="Status Progress">
            <ul class="list-group">
                <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="form-check w-100">
                        <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="survey" value="survey" id="statussurvey">
                        <label class="form-check-label ps-0 ms-0 stretched-link" for="statussurvey">
                            Survey
                        <i class="input-helper"></i></label>
                    </div> 
                </li> 
                <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="form-check w-100">
                        <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="sample" value="sample" id="statussample">
                        <label class="form-check-label ps-0 ms-0 stretched-link" for="statussample">
                            Sample Barang
                        <i class="input-helper"></i></label>
                    </div> 
                </li> 
                <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="form-check w-100">
                        <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="penawaran" value="penawaran" id="statuspenawaran">
                        <label class="form-check-label ps-0 ms-0 stretched-link" for="statuspenawaran">
                            Penawaran
                        <i class="input-helper"></i></label>
                    </div> 
                </li> 
                <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="form-check w-100">
                        <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="invoice" value="invoice" id="statusinvoice">
                        <label class="form-check-label ps-0 ms-0 stretched-link" for="statusinvoice">
                            Invoice
                        <i class="input-helper"></i></label>
                    </div> 
                </li> 
                <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="form-check w-100">
                        <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="pengiriman" value="pengiriman" id="statuspengiriman">
                        <label class="form-check-label ps-0 ms-0 stretched-link" for="statuspengiriman">
                            Pengiriman
                        <i class="input-helper"></i></label>
                    </div> 
                </li> 
                <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="form-check w-100">
                        <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="pembelian" value="pembelian" id="statuspembelian">
                        <label class="form-check-label ps-0 ms-0 stretched-link" for="statuspembelian">
                            Pembelian
                        <i class="input-helper"></i></label>
                    </div> 
                </li> 
            </ul>
        </div>
    </div>
    <div class="input-group d-sm-flex d-none">  
        <input class="form-control form-control-sm input-form" id="searchdatadate" placeholder="Tanggal" value="" type="text" data-start="" data-end="" readonly style="background: white;">
        <i class="fa-solid fa-calendar-days"></i> 
    </div> 
    <div class="input-group flex-fill">  
        <input class="form-control form-control-sm input-form" id="searchdataproject" placeholder="Cari nama project, catatan, item barang ataupun nomer dokumen" value="" type="text">
        <i class="fa-solid fa-magnifying-glass"></i>   
        <div class="d-sm-none d-block ps-2">
            <button class="btn btn-sm btn-secondary rounded"  data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><i class="fa-solid fa-filter"></i></button>
        </div> 
        <div class="d-sm-none d-block ps-1">
            <button class="btn btn-sm btn-secondary rounded"  data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop-date" aria-controls="staticBackdrop"><i class="fa-solid fa-calendar-days"></i></button>
        </div>
    </div>   
</div>
<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop-date" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel"><i class="fa-solid fa-calendar-days"></i> Pilih Tanggal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between">
                <label class="form-check-label stretched-link" for="radioNoLabel1">Semua Tanggal</label> 
                <div>
                    <input class="form-check-input filter-array" type="radio" name="radioNoLabel" id="radioNoLabel1" value="0" aria-label="..." checked>
                </div> 
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <label class="form-check-label stretched-link" for="radioNoLabel2">30 Hari Terkahir</label> 
                <div>
                    <input class="form-check-input filter-array" type="radio" name="radioNoLabel" id="radioNoLabel2" value="1" aria-label="...">
                </div> 
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <label class="form-check-label stretched-link" for="radioNoLabel3">90 Hari Terakhir</label>
                <div>
                    <input class="form-check-input filter-array" type="radio" name="radioNoLabel" id="radioNoLabel3" value="2" aria-label="...">
                </div> 
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <label class="form-check-label stretched-link" for="radioNoLabel4">Pilih Tanggal Sendiri</label>
                <div>
                    <input class="form-check-input filter-array" type="radio" name="radioNoLabel" id="radioNoLabel4" value="3" aria-label="...">
                </div>  
            </li>  
            <div class="row g-2 p-2 date-select" style="display: none;">
                <div class="col-6">
                    <div class="form-floating">
                        <input type="date" class="form-control bg-white" id="floatingInputGrid" placeholder="3 Maret 2019" value="2025-03-03">
                        <label for="floatingInputGrid">Mulai Dari</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <input type="date" class="form-control bg-white" id="floatingInputGrid" placeholder="3 Maret 2019" value="2025-03-03">
                        <label for="floatingInputGrid">Sampai</label>
                    </div>
                </div>
            </div>
            <script>
                $('input[type=radio][name=radioNoLabel]').on('change', function() {
                    switch ($(this).val()) {
                        case '0':
                            $(".date-select").hide(); 
                            break;
                        case '1':
                            $(".date-select").hide(); 
                            break;
                        case '2':
                            $(".date-select").hide(); 
                            break;
                        case '3':
                            $(".date-select").show(); 
                            break;
                        default:
                            $(".date-select").hide(); 
                    }
                }); 
            </script>
        </ul>
        
        <button class="btn btn-sm btn-primary w-100 mt-2  rounded" ><i class="fa-solid fa-checked pe-2"></i>Terapkan</button>
    </div>
</div>
<div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel"><i class="fa-solid fa-filter"></i> Filter Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion accordion-flush pb-2" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button p-2 mx-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-Toko" aria-expanded="false" aria-controls="flush-collapseOne">
                        Toko
                    </button> 
                </h2>
                <div id="flush-Toko" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <ul class="list-group list-group-flush"> 
                            <?php
                                foreach($store as $rows){
                                    echo ' 
                                    <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start" for="'.$rows->StoreCode.'">
                                        <div class="form-check w-100">
                                            <input class="form-check-input filter-array" type="checkbox" data-group="store" data-value="'.$rows->StoreId.'" value="'.$rows->StoreId.'" id="check-'.$rows->StoreCode.'">
                                            <label class="form-check-label ps-0 ms-0 stretched-link" for="check-'.$rows->StoreCode.'">
                                                '.$rows->StoreCode.' 
                                            </label>
                                        </div> 
                                    </li>';
                                }
                            ?>  
                        </ul>
                    </div>
                </div>
            </div> 
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button p-2 mx-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-Kategori" aria-expanded="false" aria-controls="flush-collapseOne">
                        Kategori
                    </button> 
                </h2>
                <div id="flush-Kategori" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <ul class="list-group list-group-flush"> 
                            <?php
                                foreach($kategori as $rows){
                                    echo ' 
                                    <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start " for="'.$rows->id.$rows->name.'">
                                        <div class="form-check w-100">
                                            <input class="form-check-input filter-array" type="checkbox" data-group="kategori" data-value="'.$rows->name.'" id="check-cat-'.$rows->id.$rows->name.'">
                                            <label class="form-check-label ps-0 ms-0 stretched-link" for="check-cat-'.$rows->id.$rows->name.'">
                                                '.$rows->name.' 
                                            </label>
                                        </div> 
                                    </li>';
                                }
                            ?>  
                        </ul>
                    </div>
                </div>
            </div> 
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button p-2 mx-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-Admin" aria-expanded="false" aria-controls="flush-collapseOne">
                        Admin
                    </button> 
                </h2>
                <div id="flush-Admin" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <ul class="list-group list-group-flush">   
                            <?php
                                foreach($admin as $rows){
                                    echo ' 
                                    <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start " for="'.$rows->username.'">
                                        <div class="form-check w-100">
                                            <input class="form-check-input filter-array" type="checkbox" data-group="user" data-value="'.$rows->id.'" id="check-'.$rows->username.'">
                                            <label class="form-check-label ps-0 ms-0 stretched-link" for="check-'.$rows->username.'">
                                                '.$rows->username.' 
                                            </label>
                                        </div> 
                                    </li>';
                                }
                            ?>  
                          
                        </ul>
                    </div>
                </div>
            </div> 
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button p-2 mx-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-Status" aria-expanded="false" aria-controls="flush-collapseOne">
                        Status Progress
                    </button> 
                </h2>
                <div id="flush-Status" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <ul class="list-group list-group-flush"> 
                            <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="form-check w-100">
                                    <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="sample" value="sample" id="check-statussample">
                                    <label class="form-check-label ps-0 ms-0 stretched-link" for="check-statussample">
                                        Sample Barang
                                    </label>
                                </div> 
                            </li> 
                            <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="form-check w-100">
                                    <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="penawaran" value="penawaran" id="check-statuspenawaran">
                                    <label class="form-check-label ps-0 ms-0 stretched-link" for="check-statuspenawaran">
                                        Penawaran
                                    </label>
                                </div> 
                            </li> 
                            <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="form-check w-100">
                                    <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="invoice" value="invoice" id="check-statusinvoice">
                                    <label class="form-check-label ps-0 ms-0 stretched-link" for="check-statusinvoice">
                                        Invoice
                                    </label>
                                </div> 
                            </li> 
                            <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="form-check w-100">
                                    <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="pengiriman" value="pengiriman" id="check-statuspengiriman">
                                    <label class="form-check-label ps-0 ms-0 stretched-link" for="check-statuspengiriman">
                                        Pengiriman
                                    </label>
                                </div> 
                            </li> 
                            <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="form-check w-100">
                                    <input class="form-check-input filter-array" type="checkbox" data-group="status" data-value="pembelian" value="pembelian" id="check-statuspembelian">
                                    <label class="form-check-label ps-0 ms-0 stretched-link" for="check-statuspembelian">
                                        Pembelian
                                    </label>
                                </div> 
                            </li>  
                        </ul>
                    </div>
                </div>
            </div> 
        </div>  
    </div>
</div>
<div id="data-project"> 
</div>

<div class="row justify-content-between">
    <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto">
        <div class="dt-info pt-1" aria-live="polite" id="table-toko_info" role="status">Showing 1 to 10 of 10 entries</div>
    </div>
    <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ml-auto">
        <div class="dt-paging pt-1">
            <nav aria-label="pagination">
                <ul class="pagination" id="paging-data">
                    <li class="dt-paging-button page-item disabled"><a class="page-link first" aria-controls="table-toko" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a></li>
                    <li class="dt-paging-button page-item disabled"><a class="page-link previous" aria-controls="table-toko" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a></li>
                    <li class="dt-paging-button page-item active"><a href="#" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">1</a></li>
                    <li class="dt-paging-button page-item disabled"><a class="page-link next" aria-controls="table-toko" aria-disabled="true" aria-label="Next" data-dt-idx="next" tabindex="-1">›</a></li>
                    <li class="dt-paging-button page-item disabled"><a class="page-link last" aria-controls="table-toko" aria-disabled="true" aria-label="Last" data-dt-idx="last" tabindex="-1">»</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
</div>   
<div style="margin-bottom: 100px;"></div>  
<!-- Modal PRINT -->
<div class="modal fade" id="modal-print-penawaran" tabindex="-1" data-id="0" aria-labelledby="modal-print-penawaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-print-penawaranLabel">Print Penawaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row mb-1 align-items-center mt-2">
                    <label for="SphPrintFormat" class="col-sm-4 col-form-label">Ukuran Kertas</label>
                    <div class="col-sm-8">
                        <select class="form-select form-select-sm" id="SphPrintFormat" name="SphPrintFormat" placeholder="Pilih Admin" style="width:100%">
                            <option id="1" selected>A4</option>
                        </select>  
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="SphPrintImage" class="col-sm-4 col-form-label">gunakan gambar item</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SphPrintImage" id="SphPrintImage1" value="0">
                            <label class="text-detail" for="SphPrintImage1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SphPrintImage" id="SphPrintImage2" value="1" checked>
                            <label class="text-detail" for="SphPrintImage2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="SphPrintTotal" class="col-sm-4 col-form-label">gunakan grand total</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SphPrintTotal" id="SphPrintTotal1" value="0">
                            <label class="text-detail" for="SphPrintTotal1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SphPrintTotal" id="SphPrintTotal2" value="1" checked>
                            <label class="text-detail" for="SphPrintTotal2">Ya</label>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-print-sph">Print</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-print-invoice" tabindex="-1" data-id="0" aria-labelledby="modal-print-invoiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-print-invoiceLabel">Print Invoice</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row mb-1 align-items-center mt-2">
                    <label for="InvPrintFormat" class="col-sm-4 col-form-label">Ukuran Kertas</label>
                    <div class="col-sm-8">
                        <select class="form-select form-select-sm" id="InvPrintFormat" name="InvPrintFormat" placeholder="Pilih Admin" style="width:100%">
                            <option id="A4" selected>A4</option>
                            <option id="A5" >A5</option>
                        </select>  
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="InvPrintImage" class="col-sm-4 col-form-label">gunakan gambar item</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="InvPrintImage" id="InvPrintImage1" value="0">
                            <label class="text-detail" for="InvPrintImage1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="InvPrintImage" id="InvPrintImage2" value="1" checked>
                            <label class="text-detail" for="InvPrintImage2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2 d-none">
                    <label for="InvPrintTotal" class="col-sm-4 col-form-label">gunakan grand total</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="InvPrintTotal" id="InvPrintTotal1" value="0">
                            <label class="text-detail" for="InvPrintTotal1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="InvPrintTotal" id="InvPrintTotal2" value="1" checked>
                            <label class="text-detail" for="InvPrintTotal2">Ya</label>
                        </div>
                    </div>
                </div>
                <script> 
                   $('#InvPrintFormat').change(function() {
                        if($(this).val() == "A5"){
                            $('input[name="InvPrintImage"]').prop("disabled",true)
                            $('input[name="InvPrintTotal"]').prop("disabled",true)
                        }else{

                            $('input[name="InvPrintImage"]').prop("disabled",false)
                            $('input[name="InvPrintTotal"]').prop("disabled",false)
                        }
                    });
                </script>   
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-print-invoice">Print</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-print-po" tabindex="-1" data-id="0" aria-labelledby="modal-print-invoiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-print-poLabel">Print Pembelian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row mb-1 align-items-center mt-2">
                    <label for="POPrintFormat" class="col-sm-4 col-form-label">Ukuran Kertas</label>
                    <div class="col-sm-8">
                        <select class="form-select form-select-sm" id="POPrintFormat" name="POPrintFormat" placeholder="Pilih Admin" style="width:100%">
                            <option id="1" selected>A4</option>
                            <option id="2">A5</option>
                        </select>  
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="POPrintImage" class="col-sm-4 col-form-label">gunakan gambar item</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="POPrintImage" id="POPrintImage1" value="0">
                            <label class="text-detail" for="POPrintImage1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="POPrintImage" id="POPrintImage2" value="1" checked>
                            <label class="text-detail" for="POPrintImage2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="POPrintPrice" class="col-sm-4 col-form-label">gunakan harga</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="POPrintPrice" id="POPrintPrice1" value="0">
                            <label class="text-detail" for="POPrintPrice1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="POPrintPrice" id="POPrintPrice2" value="1" checked>
                            <label class="text-detail" for="POPrintPrice2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="POPrintTotal" class="col-sm-4 col-form-label">gunakan grand total</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="POPrintTotal" id="POPrintTotal1" value="0">
                            <label class="text-detail" for="POPrintTotal1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="POPrintTotal" id="POPrintTotal2" value="1" checked>
                            <label class="text-detail" for="POPrintTotal2">Ya</label>
                        </div>
                    </div>
                </div>   
                <script>
                   $('input[name="POPrintPrice"]').change(function() {
                        if($(this).val() == 0){
                            $('input[name="POPrintTotal"]').prop("disabled",true)
                        }else{

                            $('input[name="POPrintTotal"]').prop("disabled",false)
                        }
                    });
                    // $("#POPrintFormat").change(function(){
                    //     if($(this).val() == "A5"){
                    //         $('input[name="POPrintTotal"]').prop("disabled",true)
                    //         $('input[name="POPrintPrice"]').prop("disabled",true)
                    //         $('input[name="POPrintImage"]').prop("disabled",true)
                    //     } else{ 
                    //         $('input[name="POPrintTotal"]').prop("disabled",false)
                    //         $('input[name="POPrintPrice"]').prop("disabled",false)
                    //         $('input[name="POPrintImage"]').prop("disabled",false)
                    //     }
                    // })
                </script>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-print-po">Print</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-print-payment" tabindex="-1" data-id="0" aria-labelledby="modal-print-invoiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-print-poLabel">Print Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row mb-1 align-items-center mt-2">
                    <label for="PaymentPrintFormat" class="col-sm-4 col-form-label">Ukuran Kertas</label>
                    <div class="col-sm-8">
                        <select class="form-select form-select-sm" id="PaymentPrintFormat" name="PaymentPrintFormat" placeholder="Pilih Admin" style="width:100%">
                            <option id="1" selected>A4</option>
                            <option id="2">A5</option>
                        </select>  
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="PaymentPrintImage" class="col-sm-4 col-form-label">gunakan gambar item</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintImage" id="PaymentPrintImage1" value="0">
                            <label class="text-detail" for="PaymentPrintImage1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintImage" id="PaymentPrintImage2" value="1" checked>
                            <label class="text-detail" for="PaymentPrintImage2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2 d-none">
                    <label for="PaymentPrintPrice" class="col-sm-4 col-form-label">gunakan harga</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintPrice" id="PaymentPrintPrice1" value="0">
                            <label class="text-detail" for="PaymentPrintPrice1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintPrice" id="PaymentPrintPrice2" value="1" checked>
                            <label class="text-detail" for="PaymentPrintPrice2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2 d-none">
                    <label for="PaymentPrintTotal" class="col-sm-4 col-form-label">gunakan grand total</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintTotal" id="PaymentPrintTotal1" value="0">
                            <label class="text-detail" for="PaymentPrintTotal1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintTotal" id="PaymentPrintTotal2" value="1" checked>
                            <label class="text-detail" for="PaymentPrintTotal2">Ya</label>
                        </div>
                    </div>
                </div>   
                <script>
                   $('input[name="PaymentPrintPrice"]').change(function() {
                        if($(this).val() == 0){
                            $('input[name="PaymentPrintTotal"]').prop("disabled",true)
                        }else{

                            $('input[name="PaymentPrintTotal"]').prop("disabled",false)
                        }
                    });
                    // $("#POPrintFormat").change(function(){
                    //     if($(this).val() == "A5"){
                    //         $('input[name="POPrintTotal"]').prop("disabled",true)
                    //         $('input[name="POPrintPrice"]').prop("disabled",true)
                    //         $('input[name="POPrintImage"]').prop("disabled",true)
                    //     } else{ 
                    //         $('input[name="POPrintTotal"]').prop("disabled",false)
                    //         $('input[name="POPrintPrice"]').prop("disabled",false)
                    //         $('input[name="POPrintImage"]').prop("disabled",false)
                    //     }
                    // })
                </script>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-print-payment">Print</button>
            </div>
        </div>
    </div>
</div>
 
<script>
    togglecustom = function(cls,el){
        if($("." + cls).hasClass("show")){
            $("." + cls).removeClass("show")
            $("." + cls).slideUp()
            $(el).find("i").addClass("fa-rotate-180")
            $(el).find("span").html("Tampilkan")
        }else{
            $("." + cls).addClass("show")
            $("." + cls).slideDown()
            $(el).find("i").removeClass("fa-rotate-180")
            $(el).find("span").html("Sembunyikan")
        }
    }

    socket.on('load-project', function(data) { 
        if(data["menu"] == "project"){
            loader_datatable();
        }
    });

    var paging = 1;
    var table;  
    var filter_arr = {
        "store":[],
        "kategori":[],
        "user":[],
        "status":[],
    };
    $("#btn-search-data").click(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    function load_paging(i){
        paging = i;
        loader_datatable();
    }
    var xhr_load_project;
    function loader_datatable(){
        if (xhr_load_project) {
            xhr_load_project.abort();
        }

        xhr_load_project = $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url()?>datatables/get-data-project", 
            data:{  
                "search" : $("#searchdataproject").val(),
                "filter" : filter_arr,
                "datestart" : $("#searchdatadate").data("start"),
                "dateend" : $("#searchdatadate").data("end"),
                "paging" : paging
            },
            success: function(data) {       
                if(data["status"]===true){ 
                    $("#data-project").html(data["html"])   
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data, 
                        confirmButtonColor: "#3085d6", 
                    });
                } 
                // $(".menu-item").click(function(){
                //     $(this).data("id"); 
                //     $(this).parent().find(".selected").removeClass("selected")
                //     $(this).addClass("selected") 

                //     loader_data_project($(this).data("id"),$(this).data("menu")) 
                // }); 
                 
                $(".icon-project").click(function(){  
                    $(this).siblings(".selected").removeClass("selected");
                    if($(this).hasClass("selected")){   
                        $(this).removeClass("selected");
                        $(".content-data[data-id='" + $(this).data("id") + "']").css("min-height","0");  
                        $(".content-data[data-id='" + $(this).data("id") + "']").slideUp("slow"); 
                        $(this).parents('.project').css("border-color","#e3e3e3");
                        $("html, body").css("overflow","auto");
                        $(".close-project[data-id='" + $(this).data("id") + "']").hide();
                    }else{ 
                        $(this).addClass("selected");
                        if ($(window).width() > 400) {
                            $(".content-data[data-id='" + $(this).data("id") + "']").css("max-height","calc(100vh - 15rem)"); 
                            $(".content-data[data-id='" + $(this).data("id") + "']").css("min-height","calc(100vh - 15rem)");  
                            $(".tab-content[data-id='" + $(this).data("id") + "']").css("height","calc(100vh - 15rem)"); 
                            $("html, body").css("overflow","hidden");
                            $(".content-data[data-id='" + $(this).data("id") + "']").on("mousewheel", function(e) {
                                e.stopPropagation();
                            });
                            $(".close-project[data-id='" + $(this).data("id") + "']").show();
                        }
                        $(".content-data[data-id='" + $(this).data("id") + "']").slideDown("slow");  
                        $(this).parents('.project').css("border-color","#9f9f9f");
                        $("html, body").animate({ scrollTop: $(this).parents('.project').offset().top - 70 }, 300); 

                        loader_data_project($(this).data("id"),$(this).data("menu")) 
                        
                    }
                    $(this).parents('.project').scrollTop(0); 
                })
               
                $(".close-project").click(function(){  
                    var header = $(this).parents('.project'); 
                    $(header).find(".icon-project.selected").trigger("click"); 
                });
                // $(".header").click(function(e){

                //     var target = $(e.target);   
                //     if (  target.closest('button').length  ) return;

                //     if($(this).parent().parent().hasClass("show")){ 
                //         $(this).parent().parent().removeClass("show");

                //     }else{
                //         $(this).parent().parent().addClass("show");

                //     }

                // }); 


                // paging data
                if(data["total"] == 0){
                    $("#table-toko_info").html("Tidak ada data yang ditampilkan")
                }else{
                    $("#table-toko_info").html("Tampilkan " + (data["paging"] + 1) +" sampai " + (data["paging"] + data["totalresult"]) +" dari " + data["total"] + " data") ;
                }
                var page = Math.ceil(data["total"] / 10);
                if(page == 0){ 
                    paging = 1; 
                }else{
                    if(paging > page) load_paging(page)   
                }
                
                
                var page_html = `    
                    <li class="dt-paging-button page-item"><a onclick="load_paging(${1})" class="page-link first" aria-controls="table-toko" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a></li>
                    <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == 1 ? paging : paging - 1)})" class="page-link previous" aria-controls="table-toko" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a></li>
                `;  

                if(page > 5){
                    if(paging < 3){
                        page_html += '<li class="dt-paging-button page-item ' + (paging == 1 ? "active" : "") + '"><a onclick="load_paging(1)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">1</a></li>';
                        page_html += '<li class="dt-paging-button page-item ' + (paging == 2 ? "active" : "") + '"><a onclick="load_paging(2)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">2</a></li>';
                        page_html += '<li class="dt-paging-button page-item ' + (paging == 3 ? "active" : "") + '"><a onclick="load_paging(3)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">3</a></li>';
                    }else if((paging + 2 ) > page){
                        page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
                        page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 2) ? "active" : "") + '"><a onclick="load_paging('+ (page - 2) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (page - 2) +'</a></li>';
                        page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 1) ? "active" : "") + '"><a onclick="load_paging('+ (page - 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (page - 1) +'</a></li>';
                        page_html += '<li class="dt-paging-button page-item ' + (paging == page ? "active" : "") + '"><a onclick="load_paging('+ page +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ page +'</a></li>';
                    }else{
                        page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
                        page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+ (paging - 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (paging - 1) +'</a></li>';
                        page_html += '<li class="dt-paging-button page-item active"><a onclick="load_paging('+ paging +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ paging +'</a></li>';
                        if(paging !== page)  page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+ (paging + 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (paging + 1) +'</a></li>';
                    } 
                    if((paging + 1 ) < page) page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
                    
                }else{ 
                    for(let i = 1; page + 1 > i;i++){
                        if(paging == i){ 
                            page_html += '<li class="dt-paging-button page-item active"><a onclick="load_paging('+i+')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ i +'</a></li>';
                        }else{ 
                            page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+i+')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ i +'</a></li>';
                        }
                    }
                }

                page_html += `    
                    <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == page ? paging : paging + 1)})" class="page-link next" aria-controls="table-toko" aria-disabled="true" aria-label="Next" data-dt-idx="next" tabindex="-1">›</a></li>
                    <li class="dt-paging-button page-item"><a onclick="load_paging(${page})" class="page-link last" aria-controls="table-toko" aria-disabled="true" aria-label="Last" data-dt-idx="last" tabindex="-1">»</a></li>
                `;
                $("#paging-data").html(page_html);
            },
            error : function(xhr, textStatus, errorThrown){   
                if (textStatus === 'abort') {
                    // request AJAX dibatalkan, tidak perlu menampilkan error
                    return;
                }
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    loader_datatable();
    loader_data_project = function(ProjectId,type){ 
         
        $(".tab-content[data-id='"+ ProjectId+"']").hide() 
        $(".loading-content[data-id='"+ ProjectId+"']").show()
        $(".loading-content[data-id='"+ ProjectId+"']").parent().removeClass("d-none");
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/get-data-project-tab", 
            data:{
                "type":type,
                "ProjectId":ProjectId, 
            },
            success: function(data) {       
                if(data["status"]===true){ 
                    $(".tab-content[data-id='"+ ProjectId+"']").html(data["html"])  
                    $("#tab-content-project-" + ProjectId).html(data["html"])  
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data, 
                        confirmButtonColor: "#3085d6", 
                    });
                }
                $(".tab-content[data-id='"+ ProjectId+"']").show() 
                $(".loading-content[data-id='"+ ProjectId+"']").hide() 
                $(".loading-content[data-id='"+ ProjectId+"']").parent().addClass("d-none"); 

                $(".status-header[data-id='"+ ProjectId+"']").html(data["project"]["status"]) 
                //update status  

                //update notif survey
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='survey']").removeClass("active")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='survey']").removeClass("notif")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='survey']").addClass(data["project"]["survey"])

                //update notif sample
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='sample']").removeClass("active")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='sample']").removeClass("notif")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='sample']").addClass(data["project"]["sample"])
                //update notif penawaran
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='penawaran']").removeClass("active")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='penawaran']").removeClass("notif")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='penawaran']").addClass(data["project"]["penawaran"])
                //update notif invoice
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='invoice']").removeClass("active")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='invoice']").removeClass("notif")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='invoice']").addClass(data["project"]["invoice"])
                //update notif delivery
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='pengiriman']").removeClass("active")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='pengiriman']").removeClass("notif")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='pengiriman']").addClass(data["project"]["pengiriman"]) 
                //update notif pembelian
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='pembelian']").removeClass("active")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='pembelian']").removeClass("notif")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='pembelian']").addClass(data["project"]["pembelian"]);
                //update notif pembelian
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='keuangan']").removeClass("active")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='keuangan']").removeClass("notif")
                $(".icon-project[data-id='"+ ProjectId+"'][data-menu='keuangan']").addClass(data["project"]["keuangan"]);

                // Hapus tooltip sebelumnya
                var tooltipTriggerListOld = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerListOld.map(function (tooltipTriggerEl) {
                    var tooltip = bootstrap.Tooltip.getInstance(tooltipTriggerEl);
                    if (tooltip) {
                        tooltip.dispose();
                    }
                });
                $(".tooltip").remove(); 
                // Buat tooltip baru
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    var tooltip = new bootstrap.Tooltip(tooltipTriggerEl);
                    if (tooltipTriggerEl.innerText?.includes('top')) {
                        tooltip.enable();
                    }
                    return tooltip;
                });

            },
            error : function(xhr, textStatus, errorThrown){   
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }   
    download_file = function(el){
        var file = $(el).data('file'); 
        window.open('<?= base_url("project/surveyfinish?file=") ?>' + file, '_blank');
    }

    // ***************** PROJECT *****************  
    add_click = function(){ 
        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/add-project", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-project").modal("show"); 

                
                $(".tooltip").remove(); 
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
        });
    }; 
    edit_click = function(id,el){ 
        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/edit-project/" +id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-project").modal("show"); 

                
                $(".tooltip").remove(); 
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
        });
    }; 
    var IsUpdateStatus = [];
    update_status = function(status,id,el){ 
        if (IsUpdateStatus[id]) {
            console.log("project survey cancel load");
            return;
        }  

        IsUpdateStatus[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>action/update-project/" + id +  "/" + status, 
            success: function(data) {     
                IsUpdateStatus[id] = false;
                $(el).html(old_text); 

                loader_datatable();  
            },
            error: function(xhr, textStatus, errorThrown){ 
                IsUpdateStatus[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };  
    var isProcessingDelete;
    delete_click = function(id,el){
        // INSERT LOADER BUTTON
        if (isProcessingDelete) {
            return;
        }  
        isProcessingDelete = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus project ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-project/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        
                        loader_datatable(); 
                    }, 
                });
            }
            isProcessingDelete = false;
            $(el).html(old_text);
        });
    }  
    var no_notif = 0;
    produk_click = function(){ 
        
        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/add-item-select", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#add-item-select").modal("show");  
                $(".tooltip").remove(); 
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
        });
    }

    // ***************** SURVEY PROJECT ***************** 
    var isProcessingSurvey = [];
    add_project_survey = function(id,el){
        if (isProcessingSurvey[id]) {
            console.log("project survey cancel load");
            return;
        }  

        isProcessingSurvey[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-survey/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-survey").modal("show"); 

                $(".tooltip").remove(); 
                isProcessingSurvey[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSurvey[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    var isProcessingSurveyEdit = [];
    edit_project_Survey = function(ref,id,el){ 
          // INSERT LOADER BUTTON
        if (isProcessingSampleEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSurveyEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-survey/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-survey").modal("show"); 

                $(".tooltip").remove(); 
                isProcessingSurveyEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSurveyEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 
    var isProcessingSurveyPrint = []; 
    print_project_Survey = function(ref,id,el){ 
        window.open('<?= base_url("print/project/survey/") ?>' + id, '_blank');
    };
    
    var isProcessingSurveyDelete = [];
    delete_project_Survey = function(ref,id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingSurveyDelete[id]) {
            return;
        }  
        isProcessingSurveyDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus survey ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-survey/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"survey"); 
                    }, 
                });
            }
            isProcessingSurveyDelete[id] = false;
            $(el).html(old_text); 
        });
    };
    var isProcessingSurveyFinish = [];
    add_project_survey_finish = function(ref,id,el){
        if (isProcessingSurveyFinish[id]) {
            console.log("project survey cancel load");
            return;
        }  

        isProcessingSurveyFinish[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-survey-finish/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-finish-survey").modal("show"); 

                $(".tooltip").remove(); 
                isProcessingSurveyFinish[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSurveyFinish[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    } 
    var isProcessingSurveyFinishEdit = [];
    edit_project_Survey_finish = function(ref,id,el){
        if (isProcessingSurveyFinishEdit[id]) {
            console.log("project survey cancel load");
            return;
        }  
        isProcessingSurveyFinishEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-survey-finish/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-finish-survey").modal("show"); 

                $(".tooltip").remove(); 
                isProcessingSurveyFinishEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSurveyFinishEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }


    // ***************** SAMPLE PROJECT *****************
    var isProcessingSample = [];
    add_project_sample =  function(id,el,ref = 0,type = "Sample"){ 
         // INSERT LOADER BUTTON
        if (isProcessingSample[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSample[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-sample/" + id, 
            data: {
                "RefId" : ref,
                "Type" : type
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-sample").modal("show"); 
                $(".tooltip").remove(); 
 
                isProcessingSample[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSample[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };

    var isProcessingSampleEdit = [];
    edit_project_sample  = function(ref,id,el){ 
        // INSERT LOADER BUTTON
        if (isProcessingSampleEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSampleEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-sample/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-sample").modal("show"); 

                $(".tooltip").remove(); 
                isProcessingSampleEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSampleEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 

    var isProcessingSampleDelete = []; 
    delete_project_sample = function(ref,id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingSampleDelete[id]) {
            return;
        }  
        isProcessingSampleDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus sample ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-sample/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"sample"); 
                    }, 
                });
            }
            isProcessingSampleDelete[id] = false;
            $(el).html(old_text); 
        });
    };

    var isProcessingSampleUpdate = [];
    sample_project_update_delivery =function(ref,id,el,status){
         // INSERT LOADER BUTTON
         if (isProcessingSampleUpdate[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSampleUpdate[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            data:{
                status : status,
            },
            url: "<?= base_url() ?>action/update-data-sample-delivery/" + id, 
            success: function(data) {  
                if(status == 1){ 
                    Swal.fire({
                        title: "Active!",
                        text: "Mode pengiriman berhasil diaktifkan",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                    });  
                }else{
                    Swal.fire({
                        title: "Deactive!",
                        text: "Mode pengiriman berhasil dinonaktifkan",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                    });  
                }
                loader_data_project(ref,"sample"); 
                isProcessingSampleUpdate[id] = false;
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSampleUpdate[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    // ***************** SPH / PENAWARAN PROJECT ***************** 
    var isProcessingSph = [];
    add_project_sph = function(id,el,ref = 0,type = "Sample"){ 
         // INSERT LOADER BUTTON
        if (isProcessingSph[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSph[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-sph/" + id, 
            data: {
                "RefId" : ref,
                "Type" : type
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-sph").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingSph[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSph[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };

    var isProcessingSphPrint = [];
    print_project_sph = function(ref,id,el,type = 1){  
        $("#modal-print-penawaran").modal("show");
        $("#modal-print-penawaran").data("id",id)
       // window.open('<?= base_url("print/project/sph/") ?>' + id + "/" + type, '_blank');
    };

    var isProcessingSphEdit = [];
    edit_project_sph = function(ref,id,el){ 
          // INSERT LOADER BUTTON
        if (isProcessingSphEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSphEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-sph/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-sph").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingSphEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSphEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 
    
    var isProcessingSphDelete = [];
    delete_project_sph = function(ref,id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingSphDelete[id]) {
            return;
        }  
        isProcessingSphDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus penawaran ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-penawaran/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"penawaran"); 
                    }, 
                });
            }
            isProcessingSphDelete[id] = false;
            $(el).html(old_text); 
        });
    };

    $("#btn-print-sph").click(function(i){ 
        $.redirect('<?= base_url("print/project/sph/") ?>' +  $("#modal-print-penawaran").data("id"),  {
            kertas: $("#SphPrintFormat").val(),
            image: $('input[name="SphPrintImage"]:checked').val(),
            total: $('input[name="SphPrintTotal"]:checked').val(),
        },
        "GET",'_blank');
        $("#modal-print-penawaran").modal("hide");
        
    })
     
   
    // ***************** PEMBELIAN PROJECT *****************
    var  isProcessingPo = [];
    add_project_po = function(id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingPo[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPo[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-po/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-po").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingPo[id] = false;
                $(el).html(old_text);
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPo[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };

    var isProcessingPOEdit = [];
    edit_project_po = function(ref,id,el){ 
          // INSERT LOADER BUTTON
          if (isProcessingPOEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPOEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-po/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-po").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingPOEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPOEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 
    delete_project_po = function(ref,id,el){
        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus Pembelian ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-po/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"pembelian"); 
                    }, 
                });
            } 
        });
    }
 
    print_project_po_a4 = function(ref,id,el){  
        $("#modal-print-po").modal("show");
        $("#modal-print-po").data("id",id) 
    };
    
    $("#btn-print-po").click(function(i){ 
        $.redirect('<?= base_url("print/project/po/") ?>' +  $("#modal-print-po").data("id"),  {
            kertas: $("#POPrintFormat").val(),
            image: $('input[name="POPrintImage"]:checked').val(),
            total: $('input[name="POPrintTotal"]:checked').val(),
            price: $('input[name="POPrintPrice"]:checked').val(),
        },
        "GET",'_blank');
        $("#modal-print-po").modal("hide");
        
    })
    print_project_po_a5 = function(ref,id,el){ 
        window.open('<?= base_url("print/project/poA5/") ?>' + id, '_blank');
    };
 
    // ***************** INVOICE PROJECT *****************
    var isProcessingInvoice= [];
    add_project_invoice = function(id,el,refid = 0,type = "penawaran"){
        // INSERT LOADER BUTTON
        if (isProcessingPo[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPo[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-invoice/" + id, 
            data: {
                "RefId" : refid,
                "Type" : type
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-invoice").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingPo[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPo[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
 
    var isProcessingInvoiceEdit = [];
    edit_project_invoice = function(ref,id,el){ 
          // INSERT LOADER BUTTON
          if (isProcessingInvoiceEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoiceEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-invoice/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-invoice").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingInvoiceEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoiceEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 


    var isProcessingInvoiceDelete = [];
    delete_project_invoice = function(ref,id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingInvoiceDelete[id]) {
            return;
        }  
        isProcessingInvoiceDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus Invoice ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-invoice/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"invoice"); 
                    }, 
                });
            }
            isProcessingInvoiceDelete[id] = false;
            $(el).html(old_text); 
        });
    }; 
    print_project_invoice = function(ref,id,el){  
        $("#modal-print-invoice").modal("show");
        $("#modal-print-invoice").data("id",id) 
    };  

    $("#btn-print-invoice").click(function(i){ 
        $.redirect('<?= base_url("print/project/invoice/") ?>' +  $("#modal-print-invoice").data("id"),  {
            kertas: $("#InvPrintFormat").val(),
            image: $('input[name="InvPrintImage"]:checked').val(),
            total: $('input[name="InvPrintTotal"]:checked').val(),
        },
        "GET",'_blank');
        $("#modal-print-invoice").modal("hide");
        
    })
 
    var isProcessingInvoiceUpdate = [];
    invoice_project_update_delivery =function(ref,id,el,status){
         // INSERT LOADER BUTTON
         if (isProcessingInvoiceUpdate[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoiceUpdate[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            data:{
                status : status,
            },
            url: "<?= base_url() ?>action/update-data-invoice-delivery/" + id, 
            success: function(data) {  
                if(status == 1){ 
                    Swal.fire({
                        title: "Active!",
                        text: "Mode pengiriman berhasil diaktifkan",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                    });  
                }else{
                    Swal.fire({
                        title: "Deactive!",
                        text: "Mode pengiriman berhasil dinonaktifkan",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                    });  
                }
                loader_data_project(ref,"invoice"); 
                isProcessingInvoiceUpdate[id] = false;
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoiceUpdate[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    var isProcessingInvoicePayment = [];
    add_project_payment = function(ref,id,el,type){
        // INSERT LOADER BUTTON
        if (isProcessingInvoicePayment[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoicePayment[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-payment/" + id, 
            data:{
                type:type
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-payment").modal("show");  
                $(".tooltip").remove(); 

                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    
    var isProcessingPaymentEdit = [];
    edit_project_payment  = function(ref,id,el,type){ 
         // INSERT LOADER BUTTON
         if (isProcessingPaymentEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPaymentEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-payment/" + id,  
            data:{
                type:type
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-payment").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingPaymentEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPaymentEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };
     
    var isProcessingPaymentDelete = [];
    delete_project_payment  = function(ref,id,el,type){ 
         // INSERT LOADER BUTTON
        if (isProcessingInvoiceDelete[id]) {
            return;
        }  
        isProcessingInvoiceDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus Payment ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-project-payment/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });    
                        loader_data_project(ref,type)  
                    }, 
                });
            }
            isProcessingInvoiceDelete[id] = false;
            $(el).html(old_text); 
        });
    };

    print_project_payment = function(ref,id,el){ 
        //window.open('<?= base_url("print/project/paymentA5/") ?>' + id, '_blank');
        $("#modal-print-payment").modal("show");
        $("#modal-print-payment").data("id",id) 
    }

    var isProcessingPaymentRequest = [];
    request_project_payment = function(ref,id,el,menu){
        // INSERT LOADER BUTTON
        if (isProcessingPaymentRequest[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPaymentRequest[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/request-project-payment/" + id,  
            data:{
                type:menu
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-request-payment").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingPaymentRequest[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPaymentRequest[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    var isProcessingPaymentRequestEdit = [];
    request_project_payment_edit = function(ref,id,el,menu){
        // INSERT LOADER BUTTON
        if (isProcessingPaymentRequestEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPaymentRequestEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/request-project-payment-edit/" + id,  
            data:{
                type:menu
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-request-payment-edit").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingPaymentRequestEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPaymentRequestEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    var isProcessingPaymentRequestDelete = [];
    request_project_payment_delete = function(ref,id,el,type){ 
         // INSERT LOADER BUTTON
        if (isProcessingPaymentRequestDelete[id]) {
            return;
        }  
        isProcessingPaymentRequestDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus permohonan ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-project-request-payment/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });    
                        if(type == "delivery") { 
                            loader_data_project(ref,"pengiriman")  
                        }else{

                            loader_data_project(ref,type)  
                        }
                    }, 
                });
            }
            isProcessingPaymentRequestDelete[id] = false;
            $(el).html(old_text); 
        });
    };
     
    $("#btn-print-payment").click(function(i){ 
        $.redirect('<?= base_url("print/project/payment/") ?>' +  $("#modal-print-payment").data("id"),  {
            kertas: $("#PaymentPrintFormat").val(),
            image: $('input[name="PaymentPrintImage"]:checked').val(),
            total: $('input[name="PaymentPrintTotal"]:checked').val(),
        },
        "GET",'_blank');
        $("#modal-print-payment").modal("hide");
        
    })
    var isProcessingInvoiceProforma = [];
    proforma_project_invoice  = function(ref,id,el){
        // INSERT LOADER BUTTON
        if (isProcessingInvoiceProforma[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoiceProforma[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-proforma/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-proforma").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingInvoiceProforma[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoiceProforma[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    } 

    var isProcessingProformaEdit = [];
    edit_project_proforma  = function(ref,id,el){ 
         // INSERT LOADER BUTTON
         if (isProcessingProformaEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingProformaEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-proforma/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-proforma").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingProformaEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingProformaEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };
    print_project_proforma = function(ref,id,el){ 
        window.open('<?= base_url("print/project/proformaA5/") ?>' + id, '_blank');
    }
    
    send_project_payment  = function(ref,id,el){
        // INSERT LOADER BUTTON
        if (isProcessingInvoicePayment[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoicePayment[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-payment/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-payment").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    show_project_payment = function(ref,id,pay_id,el,type){ 
        if(type == "sample"){
            var urlpayment = ref + "/sample/";
        }
        if(type == "invoice"){
            var urlpayment = ref + "/invoice/";
        }
        if(type == "delivery"){
            var urlpayment = ref + "/delivery/";
        }
        if(type == "pembelian"){
            var urlpayment = ref + "/pembelian/";
        }
        $.ajax({
            type: "GET",
            url: "<?= base_url("assets/images/payment/") ?>" + urlpayment + "/" + pay_id + ".png",
            success: function() {
                Swal.fire({ 
                    html: "<img src='<?= base_url("assets/images/payment/") ?>" + urlpayment + "/" + pay_id + ".png' style='width:500px;'>", 
                    confirmButtonColor: "#3085d6", 
                }); 
                return;
            },
            error: function() { 
                $.ajax({
                    type: "GET",
                    url: "<?= base_url("assets/images/payment/") ?>" + urlpayment + "/" + pay_id + ".jpg",
                    success: function() {
                        Swal.fire({ 
                            html: "<img src='<?= base_url("assets/images/payment/") ?>" + urlpayment + "/" + pay_id + ".jpg' style='width:500px;'>", 
                            confirmButtonColor: "#3085d6", 
                        }); 
                    },
                    error: function() { 

                    }
                });
            }
        }); 
    }

    print_project_delivery  = function(ref,id,el){ 
        window.open('<?= base_url("print/project/deliveryA5/") ?>' + id, '_blank');
    }

    var isProcessingDelivery = [];
    add_project_delivery  = function(ref,id,el,type){ 
         // INSERT LOADER BUTTON
        if (isProcessingDelivery[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDelivery[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-delivery/" + id, 
            data:{
                type:type
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-delivery").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingDelivery[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDelivery[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    var isProcessingDeliveryEdit = [];
    edit_project_delivery = function(ref,id,el){
        // INSERT LOADER BUTTON
        if (isProcessingDeliveryEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDeliveryEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-delivery/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-delivery").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    delete_project_delivery = function(ref,id,el){  
        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus pengiriman ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-delivery/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"invoice"); 
                    }, 
                });
            }
            isProcessingInvoiceDelete[id] = false;
            $(el).html(old_text); 
        });
    };

    var isProcessingDeliveryProses = [];
    delivery_project_proses = function(ref,id,el){ 
          // INSERT LOADER BUTTON
        if (isProcessingDeliveryProses[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDeliveryProses[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-proses-delivery/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-proses-delivery").modal("show"); 

                
                $(".tooltip").remove(); 

                isProcessingDeliveryProses[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryProses[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 
    delivery_proses_show = function(id,el){ 
        $.ajax({
            type: "GET",
            url: "<?= base_url("assets/images/delivery/") ?>" + id + "/proses.png",
            success: function() {
                Swal.fire({ 
                    html: "<img src='<?= base_url("assets/images/delivery/") ?>" + id + "/proses.png' style='width:500px;'>", 
                    confirmButtonColor: "#3085d6", 
                }); 
                return;
            },
            error: function() { 
                $.ajax({
                    type: "GET",
                    url: "<?= base_url("assets/images/delivery/") ?>" + id + "/proses.jpg",
                    success: function() {
                        Swal.fire({ 
                            html: "<img src='<?= base_url("assets/images/delivery/") ?>" + id + "/proses.jpg' style='width:500px;'>", 
                            confirmButtonColor: "#3085d6", 
                        }); 
                    },
                    error: function() { 

                    }
                });
            }
        }); 
    }
    delivery_proses_edit = function(id,el){
        if (isProcessingDeliveryProses[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDeliveryProses[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-proses-delivery/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-proses-delivery").modal("show"); 

                
                $(".tooltip").remove(); 

                isProcessingDeliveryProses[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryProses[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    } 
    var isProcessingDeliveryEdit = [];
    delivery_project_finish =  function(ref,id,el){  
         // INSERT LOADER BUTTON
        if (isProcessingDeliveryEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDeliveryEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-finish-delivery/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-finish-delivery").modal("show"); 

                
                $(".tooltip").remove(); 

                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };

    delivery_finish_show = function(id,el){ 
        $.ajax({
            type: "GET",
            url: "<?= base_url("assets/images/delivery/") ?>" + id + "/finish.png",
            success: function() {
                Swal.fire({ 
                    html: "<img src='<?= base_url("assets/images/delivery/") ?>" + id + "/finish.png' style='width:500px;'>", 
                    confirmButtonColor: "#3085d6", 
                }); 
                return;
            },
            error: function() { 
                $.ajax({
                    type: "GET",
                    url: "<?= base_url("assets/images/delivery/") ?>" + id + "/finish.jpg",
                    success: function() {
                        Swal.fire({ 
                            html: "<img src='<?= base_url("assets/images/delivery/") ?>" + id + "/finish.jpg' style='width:500px;'>", 
                            confirmButtonColor: "#3085d6", 
                        }); 
                    },
                    error: function() { 

                    }
                });
            }
        }); 
    }

    delivery_finish_edit = function(id,el){
        if (isProcessingDeliveryProses[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDeliveryProses[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-finish-delivery/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-finish-delivery").modal("show"); 
                
                $(".tooltip").remove(); 

                isProcessingDeliveryProses[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryProses[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    
    var isProcessingAccounting = [];
    add_project_accounting  = function(id,el,group){ 
         // INSERT LOADER BUTTON
        if (isProcessingDelivery[id]) {
            console.log("project sph cancel load");
            return;
        }  

        isProcessingDelivery[id] = true;
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({
            method: "POST",
            url: "<?= base_url() ?>message/add-project-accounting/" + id + "/" + group,  
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-accounting").modal("show"); 

                
                $(".tooltip").remove(); 

                isProcessingDelivery[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDelivery[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    } 

    var isProcessingAccountingEdit = [];
    edit_project_accounting  = function(ref,id,el,group){ 
         // INSERT LOADER BUTTON
        if (isProcessingAccountingEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  

        isProcessingAccountingEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-accounting/" + id + "/" + group,  
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-accounting").modal("show"); 

                
                $(".tooltip").remove(); 

                isProcessingAccountingEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingAccountingEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
 
    var isProcessingAccountingDelete = [];
    delete_project_accounting  = function(ref,id,el,group){ 
         // INSERT LOADER BUTTON
        if (isProcessingAccountingDelete[id]) {
            return;
        }  
        isProcessingAccountingDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus data ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-project-accounting/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });   
                        
                        loader_data_project(ref,'keuangan')  
                    }, 
                });
            }
            isProcessingAccountingDelete[id] = false;
            $(el).html(old_text); 
        });
    }
</script>

<script>
    // FILTER GROUP
    $("#searchdatafilter").click(function(){
        if($(this).parent().hasClass("active")){
            $(this).parent().removeClass("active");
        }else{ 
            $(this).parent().addClass("active"); 
            var ele = $(this);
            $(document).on('click', function(event) { 
                if (!$(event.target).closest(ele).length  && !$(event.target).closest(".filter-data").length  && !$(event.target).closest(".filter-list").length) {
                    $(ele).parent().removeClass('active');
                }
            });
        }
    })
    $(".filter-data .list-group-item").hover(function(){ 
        $(".filter-list[data-value='" +  $(this).find("span").html() + "'").show();
        $(".filter-list[data-value='" +  $(this).find("span").html() + "'").css("top",$(this).position()["top"] + 30)  
    }, function () {  
        if (!$(".filter-list[data-value='" +  $(this).find("span").html() + "'").is(':hover')) { 
            
            $(".filter-list[data-value='" +  $(this).find("span").html() + "'").hide();
        }else{
            var ele = $(this);
            $(".filter-list[data-value='" +  $(this).find("span").html() + "'").hover(function() { 
                $(this).show();
            }, function() { 
                if (!$(ele).is(':hover') && !$(this).is(':hover')) {
                    $(this).hide();
                }
            }); 
        }
    }); 
    function tambahArray(filter_arr, namaGrup, nilai) {
        if (!filter_arr[namaGrup]) {
            filter_arr[namaGrup] = [];
        }
        filter_arr[namaGrup].push(nilai);  
    } 
    function hapusArray(filter_arr, namaGrup, nilai) {
        if (filter_arr[namaGrup]) {
            var index = filter_arr[namaGrup].indexOf(nilai);
            if (index !== -1) {
            filter_arr[namaGrup].splice(index, 1);
            }
        } 
    } 
    function load_badge(){
        (filter_arr["store"].length === 0 ?  $("#badge-store").html("") : $("#badge-store").html(filter_arr["store"].length));
        (filter_arr["kategori"].length === 0 ?  $("#badge-kategori").html("") : $("#badge-kategori").html(filter_arr["kategori"].length));
        (filter_arr["user"].length === 0 ? $("#badge-user").html("") : $("#badge-user").html(filter_arr["user"].length));
        (filter_arr["status"].length === 0 ? $("#badge-status").html("") : $("#badge-status").html(filter_arr["status"].length));

        //var total = parseInt(filter_arr["store"].length) + parseInt(filter_arr["kategori"].length) + parseInt(filter_arr["user"].length) + parseInt(filter_arr["status"].length)
        let total = parseInt(filter_arr["store"].length) + parseInt(filter_arr["kategori"].length) + parseInt(filter_arr["user"].length) + parseInt(filter_arr["status"].length);
        (total === 0 ?  $("#searchdatafilter").val("") : $("#searchdatafilter").val(String(total) + " dipilih"));
        loader_datatable();
    }

    $('.form-check-input.filter-array').on('change', function() {
        if ($(this).is(':checked')) {
            tambahArray(filter_arr,$(this).data("group"), $(this).data("value"));  
        } else {
            hapusArray(filter_arr,$(this).data("group"), $(this).data("value")); 
        } 
        load_badge();
    });

    // FILTER TANGGAL
    $('#searchdatadate').daterangepicker({  
        autoUpdateInput: false,
        locale: {
            format: 'DD MMMM YYYY',
            cancelLabel: 'Reset'
        }
    });
    $('#searchdatadate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format('DD MMM YYYY'));
        $(this).data("start",picker.startDate.format('YYYY/MM/DD'))
        $(this).data("end",picker.endDate.format('YYYY/MM/DD'))
        loader_datatable();
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).data("start","")
        $(this).data("end","")
        loader_datatable();
    });

     // FILTER SEARCH
    $("#searchdataproject").keyup(function(){
        loader_datatable();
    })
</script>


<?php $this->endSection(); ?>