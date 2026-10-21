<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<div class="d-none d-md-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0  align-items-center gap-2">Penawaran</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= base_url() ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols-light:dashboard-outline-rounded"
                    class="icon text-lg">
                </iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium"> <a href="<?= base_url() ?>admin/sales/penawaran"
                class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="ic:outline-handshake" class="icon text-lg">
                </iconify-icon>
                List Penawaran
            </a>
        </li>
    </ul>
</div>

<div class="card radius-12 mb-24 d-none">
    <div class="card-body p-16">
        <div class="row gy-4">
            <div class="col-xxl-3 col-xl-4 col-sm-6">
                <div
                    class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-1 left-line line-bg-primary position-relative overflow-hidden">
                    <div
                        class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                        <div>
                            <span
                                class="mb-2 fw-medium text-secondary-light text-md">Penawaran
                                yang
                                dibuat</span>
                            <h6 class="fw-semibold mb-1">
                                1202
                            </h6>
                        </div>
                        <span
                            class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-primary-100 text-primary-600">
                            <i class="ri-shopping-cart-fill"></i>
                        </span>
                    </div>
                    <p class="text-sm mb-0">
                        <span
                            class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm"><i
                                class="ri-arrow-right-up-line"></i>
                            80%</span>
                        From last month 800 Doc
                    </p>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6">
                <div
                    class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-2 left-line line-bg-lilac position-relative overflow-hidden">
                    <div
                        class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                        <div>
                            <span
                                class="mb-2 fw-medium text-secondary-light text-md">Total
                                Purchase</span>
                            <h6 class="fw-semibold mb-1">
                                $35,000
                            </h6>
                        </div>
                        <span
                            class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-lilac-200 text-lilac-600">
                            <i class="ri-handbag-fill"></i>
                        </span>
                    </div>
                    <p class="text-sm mb-0">
                        <span
                            class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm"><i
                                class="ri-arrow-right-up-line"></i>
                            95%</span>
                        From last
                        month
                    </p>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6">
                <div
                    class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-3 left-line line-bg-success position-relative overflow-hidden">
                    <div
                        class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                        <div>
                            <span
                                class="mb-2 fw-medium text-secondary-light text-md">Total
                                Income</span>
                            <h6 class="fw-semibold mb-1">
                                $30,000
                            </h6>
                        </div>
                        <span
                            class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-success-200 text-success-600">
                            <i class="ri-shopping-cart-fill"></i>
                        </span>
                    </div>
                    <p class="text-sm mb-0">
                        <span
                            class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm"><i
                                class="ri-arrow-right-down-line"></i>
                            30%</span>
                        From last
                        month
                    </p>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6">
                <div
                    class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-4 left-line line-bg-warning position-relative overflow-hidden">
                    <div
                        class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                        <div>
                            <span
                                class="mb-2 fw-medium text-secondary-light text-md">Total
                                Expense</span>
                            <h6 class="fw-semibold mb-1">
                                $7,000
                            </h6>
                        </div>
                        <span
                            class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-warning-focus text-warning-600">
                            <i class="ri-shopping-cart-fill"></i>
                        </span>
                    </div>
                    <p class="text-sm mb-0">
                        <span
                            class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm"><i
                                class="ri-arrow-right-up-line"></i>
                            60%</span>
                        From last
                        month
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card" style="
    background: var(--bg-color);
    box-shadow: none;
">
    <div class="card-header">

        <!-- ========================================== -->
        <!-- 1. TAMPILAN DESKTOP (Asli & Tidak Berubah) -->
        <!-- ========================================== -->
        <div class="d-none d-sm-flex flex-wrap align-items-center justify-content-between gap-3">

            <!-- BAGIAN FILTER KIRI -->
            <div class="d-flex align-items-center justify-content-start mb-2 gap-2 search-data">

                <div class="input-group">
                    <input class="form-control form-control-sm input-form combo" id="storedatafilter" placeholder="Pilih Toko" value="" type="text" readonly>
                    <iconify-icon icon="material-symbols-light:storefront-outline" class="icon text-lg"></iconify-icon>
                    <div class="filter-data left" for="storedatafilter">
                        <ul class="list-group">
                            <?php
                            foreach (($store ?? []) as $row) {
                                echo '
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input select store" type="checkbox" data-group="store" data-value="' . $row->StoreId . '" value="' . $row->StoreId . '" id="store-' . $row->StoreId . '">
                                        <label class="form-check-label stretched-link" for="store-' . $row->StoreId . '">' . $row->StoreCode . '</label>
                                    </div>
                                </li> ';
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="input-group">
                    <input class="form-control form-control-sm input-form" id="searchdatadate" placeholder="Tanggal" value="" type="text" data-start="" data-end="" readonly>
                    <iconify-icon icon="mdi:clipboard-text-date-outline" class="icon text-lg"></iconify-icon>
                </div>

                <div class="input-group">
                    <input class="form-control form-control-sm input-form combo" id="searchdatafilter" placeholder="Status" value="" type="text" readonly>
                    <iconify-icon icon="mdi:timer" class="icon text-lg"></iconify-icon>
                    <div class="filter-data left" for="searchdatafilter">
                        <ul class="list-group radius-8">
                            <li
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                <div
                                    class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input select category"
                                        type="checkbox"
                                        data-group="category"
                                        data-value="0" value="New"
                                        id="status-0">
                                    <label class="form-check-label stretched-link"
                                        for="status-0">
                                        New
                                    </label>
                                </div>
                            </li>
                            <li
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">

                                <div
                                    class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input select category"
                                        type="checkbox"
                                        data-group="category"
                                        data-value="1" value="Proses"
                                        id="status-1">
                                    <label class="form-check-label stretched-link"
                                        for="status-1">
                                        Proses
                                    </label>
                                </div>
                            </li>
                            <li
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                <div
                                    class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input select category"
                                        type="checkbox"
                                        data-group="category"
                                        data-value="2"
                                        value="Completed"
                                        id="status-2">
                                    <label class="form-check-label stretched-link"
                                        for="status-2">
                                        Completed
                                    </label>
                                </div>
                            </li>
                            <li
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                <div
                                    class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input select category"
                                        type="checkbox"
                                        data-group="category"
                                        data-value="3" value="Cancel"
                                        id="status-3">
                                    <label class="form-check-label stretched-link"
                                        for="status-3">
                                        Cancel
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="resetfilter" class="d-flex align-items-center text-danger hover-text-primary cursor-pointer" onclick="resetFilters()"><iconify-icon icon="meteor-icons:xmark" class="text-xxl"></iconify-icon>reset filter</div>
            </div>

            <!-- BAGIAN SEARCH & TOMBOL KANAN -->
            <div class="d-flex align-items-center justify-content-end mb-2 gap-2 search-data">
                <div class="icon-field">
                    <input type="text" name="searchdatasph" class="form-control form-control-sm w-auto" placeholder="Search" id="searchdatasph">
                    <span class="icon">
                        <iconify-icon icon="ion:search-outline"></iconify-icon>
                    </span>
                    <span class="icon icon-end">
                        <iconify-icon icon="meteor-icons:xmark"></iconify-icon>
                    </span>
                </div>
                <a onclick="add_click(this)" class="btn btn-sm btn-primary-600">
                    <i class="ri-add-line"></i>
                    <span class="d-none d-sm-inline-block">Buat Penawaran</span>
                </a>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- 2. TAMPILAN MOBILE (Full Width & Stacked)  -->
        <!-- ========================================== -->
        <div class="d-flex d-sm-none flex-column gap-2 w-100">

            <!-- Baris 1: Search & Tombol Filter (Bersebelahan) -->
            <div class="d-flex gap-2 w-100">
                <div class="icon-field flex-grow-1">
                    <input type="text" name="searchdatasph_mobile" class="form-control form-control-sm w-100" placeholder="Search..." id="searchdatasph_mobile">
                    <span class="icon">
                        <iconify-icon icon="ion:search-outline"></iconify-icon>
                    </span>
                    <span class="icon icon-end">
                        <iconify-icon icon="meteor-icons:xmark"></iconify-icon>
                    </span>
                </div>
                <button class="btn btn-sm btn-secondary border px-8 d-flex align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterMobileSheet">
                    <iconify-icon icon="mdi:cog-outline" class="text-xl"></iconify-icon>
                </button>
            </div>

            <!-- Baris 2: Tombol Buat Penawaran (Lebar Penuh) -->
            <a onclick="add_click(this)" class="btn btn-sm btn-primary-600 w-100 d-flex justify-content-center align-items-center gap-1">
                <i class="ri-add-line"></i>
                <span>Buat Penawaran</span>
            </a>

        </div>

    </div>

    <!-- ========================================== -->
    <!-- COMPONENT: OFFCANVAS FILTER (UNTUK MOBILE) -->
    <!-- ========================================== -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="filterMobileSheet" style="height: auto; border-top-left-radius: 16px; border-top-right-radius: 16px; background-color: var(--white)">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold">Filter Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column gap-3 search-data">
            <!-- Input Toko Mobile -->
            <div class="input-group">
                <input class="form-control input-form combo" id="storedatafilter_mobile" placeholder="Pilih Toko" type="text" readonly>
                <iconify-icon icon="material-symbols-light:storefront-outline" class="icon text-lg"></iconify-icon>
                <div class="filter-data left" for="storedatafilter_mobile">
                    <ul class="list-group">
                        <?php
                        foreach (($store ?? []) as $row) {
                            echo '
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input select store" type="checkbox" data-group="store" data-value="' . $row->StoreId . '" value="' . $row->StoreId . '" id="store-' . $row->StoreId . '-mobile">
                                    <label class="form-check-label stretched-link" for="store-' . $row->StoreId . '-mobile">' . $row->StoreCode . '</label>
                                </div>
                            </li> ';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Input Tanggal Mobile -->
            <div class="input-group">
                <input class="form-control input-form" id="searchdatadate-mobile" placeholder="Tanggal" value="" type="text" data-start="" data-end="" readonly>
                <iconify-icon icon="mdi:clipboard-text-date-outline" class="icon text-lg"></iconify-icon>
            </div>

            <!-- Input Status Mobile -->
            <div class="input-group">
                <input class="form-control input-form combo" placeholder="Status" type="text" readonly>
                <iconify-icon icon="mdi:timer" class="icon text-lg"></iconify-icon>
                <!-- Dropdown Status Mobile -->
                <div class="filter-data left" for="searchdatafilter">
                    <ul class="list-group radius-8">
                        <li
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                            <div
                                class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input select category"
                                    type="checkbox"
                                    data-group="category"
                                    data-value="0" value="New"
                                    id="status-0-mobile">
                                <label class="form-check-label stretched-link"
                                    for="status-0-mobile">
                                    New
                                </label>
                            </div>
                        </li>
                        <li
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">

                            <div
                                class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input select category"
                                    type="checkbox"
                                    data-group="category"
                                    data-value="1" value="Proses"
                                    id="status-1-mobile">
                                <label class="form-check-label stretched-link"
                                    for="status-1-mobile">
                                    Proses
                                </label>
                            </div>
                        </li>
                        <li
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                            <div
                                class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input select category"
                                    type="checkbox"
                                    data-group="category"
                                    data-value="2"
                                    value="Completed"
                                    id="status-2-mobile">
                                <label class="form-check-label stretched-link"
                                    for="status-2-mobile">
                                    Completed
                                </label>
                            </div>
                        </li>
                        <li
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                            <div
                                class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input select category"
                                    type="checkbox"
                                    data-group="category"
                                    data-value="3" value="Cancel"
                                    id="status-3-mobile">
                                <label class="form-check-label stretched-link"
                                    for="status-3-mobile">
                                    Cancel
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body px-0 pt-1 pb-4 bg-none" id="table">
        <table id="data-table-sph" class="table bordered-table" style="width:100%">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Document</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Grand Total</th>
                    <th scope="col">Customer</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


    <!-- <div id="data-project"> 
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
    </div> -->
</div>

<!-- Modal PRINT -->
<div class="modal fade" id="modal-print-penawaran" tabindex="-1" data-id="0"
    aria-labelledby="modal-print-penawaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-print-penawaranLabel">Print Penawaran
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-4">Ukuran
                        Kertas</label>
                    <div class="col-sm-8">
                        <select class="form-select form-select-sm"
                            id="SphPrintFormat" name="SphPrintFormat"
                            placeholder="Pilih Admin" style="width:100%">
                            <option id="1" selected>A4</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-4">Tampilkan
                        gambar item</label>
                    <div class="col-sm-8">
                        <div class="d-flex align-items-center flex-wrap gap-28">
                            <div
                                class="form-check checked-danger d-flex align-items-center gap-2">
                                <input class="form-check-input"
                                    type="radio"
                                    name="SphPrintImage"
                                    id="SphPrintImage1" value="0"
                                    checked>
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="SphPrintImage1">Tidak</label>
                            </div>
                            <div
                                class="form-check checked-primary d-flex align-items-center gap-2">
                                <input class="form-check-input"
                                    type="radio"
                                    name="SphPrintImage"
                                    id="SphPrintImage2" value="1">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="SphPrintImage2">Ya</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-4">Tampilkan
                        grand total</label>
                    <div class="col-sm-8">
                        <div class="d-flex align-items-center flex-wrap gap-28">
                            <div
                                class="form-check checked-danger d-flex align-items-center gap-2">
                                <input class="form-check-input"
                                    type="radio"
                                    name="SphPrintTotal"
                                    id="SphPrintTotal1" value="0">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="SphPrintTotal1">Tidak</label>
                            </div>
                            <div
                                class="form-check checked-primary d-flex align-items-center gap-2">
                                <input class="form-check-input"
                                    type="radio"
                                    name="SphPrintTotal"
                                    id="SphPrintTotal2" value="1"
                                    checked>
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="SphPrintTotal2">Ya</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-4">Gabungkan
                        Disc Item dan Disc Global</label>
                    <div class="col-sm-8">
                        <div class="d-flex align-items-center flex-wrap gap-28">
                            <div
                                class="form-check checked-danger d-flex align-items-center gap-2">
                                <input class="form-check-input"
                                    type="radio"
                                    name="SphPrintDisc"
                                    id="SphPrintDisc1" value="0">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="SphPrintDisc1">Tidak</label>
                            </div>
                            <div
                                class="form-check checked-primary d-flex align-items-center gap-2">
                                <input class="form-check-input"
                                    type="radio"
                                    name="SphPrintDisc"
                                    id="SphPrintDisc2" value="1"
                                    checked>
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="SphPrintDisc2">Ya</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-print-sph">Print</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Comment -->
<div class="modal fade" id="modal-comment-penawaran" tabindex="-1" data-id="0"
    aria-labelledby="modal-comment-penawaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-comment-penawaranLabel">Comment Penawaran
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-3">Catatan</label>
                    <div class="col-sm-9">
                        <textarea id="SphNote" class="form-control" rows="4"
                            cols="50"
                            placeholder="Catatan Penawaran"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-sm btn-secondary"
                    data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm btn-primary-600"
                    id="btn-comment-sph">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div id="modal-message"></div>
<script>
    var active_filter = false;
    var xhr_load_project;
    var filter_status_select = []
    var filter_store_select = []
    $(document).ready(function() {

        setVisibleresetfilter = function(){ 
            if(active_filter){
                $("#resetfilter").removeClass("d-none");
                $("#resetfilter").addClass("d-flex");
            }else{ 
                $("#resetfilter").removeClass("d-flex");
                $("#resetfilter").addClass("d-none");
            }
        }
        resetFilters = function(){
            // 1. Reset Filter Status (Sistem & UI)
            filter_status_select = [];
            $("#searchdatafilter").val(""); // Kosongkan text input status
            $('.form-check-input.select.category').prop('checked', false); // Uncheck semua checkbox status

            // 2. Reset Filter Toko (Sistem & UI)
            filter_store_select = [];
            $("#storedatafilter").val(""); // Kosongkan text input toko desktop
            $("#storedatafilter_mobile").val(""); // Kosongkan text input toko mobile
            $('.form-check-input.select.store').prop('checked', false); // Uncheck semua checkbox toko

            // 3. Reset Filter Tanggal
            $("#searchdatadate").data("start", "")
            $("#searchdatadate").data("end", "")
            $("#searchdatadate_mobile").data("start", "")
            $("#searchdatadate_mobile").data("end", "") 
            $("#searchdatadate").val("");
            $("#searchdatadate-mobile").val("");
            // 4. Sinkronisasi dengan URL Hybrid & Reload DataTable

            active_filter = false;
            updateURLFilters(); 
            if (typeof table !== "undefined") {
                table.ajax.reload(null, false); // Memuat ulang data tabel setelah filter bersih
            }
        }
        // =========================================================================
        // PARSE FILTER DARI URL (SAAT HALAMAN PERTAMA KALI DI-LOAD)
        // =========================================================================
        var urlParams = new URLSearchParams(window.location.search);

        // Ambil nilai dari URL, jika kosong gunakan bawaan default/kosong
        var savedSearch = urlParams.get('search') || "";
        var savedStore = urlParams.get('store') ? urlParams.get('store').split(',') : [];
        var savedStatus = urlParams.get('status') ? urlParams.get('status').split(',') : [];
        var savedStart = urlParams.get('datestart') || "";
        var savedEnd = urlParams.get('dateend') || "";

        // =========================================================================
        // FUNGSI UNTUK MEMPERBARUI URL (DIPANGGIL TIAP FILTER BERUBAH)
        // =========================================================================
        function updateURLFilters() {
            active_filter = false;
            var params = new URLSearchParams();
            var searchVal = $("#searchdatasph").val();
            var startVal = $("#searchdatadate").data("start");
            var endVal = $("#searchdatadate").data("end");

            if (searchVal) params.set('search', searchVal);

            if (filter_store_select && filter_store_select.length > 0){
                params.set('store', filter_store_select.join(','));
                active_filter = true;
            }   
            if (filter_status_select && filter_status_select.length > 0){
                params.set('status', filter_status_select.join(','));
                active_filter = true;
            }
            // Simpan ke URL hanya jika datanya ada
            if (startVal){
                params.set('datestart', startVal);
                active_filter = true;table
            }
            if (endVal){ 
                params.set('dateend', endVal);
                active_filter = true;

            }

            var newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
            setVisibleresetfilter();
        }

        // FILTER TANGGAL
        $('#searchdatadate').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD MMMM YYYY',
                cancelLabel: 'Reset'
            }
        });
        // FILTER TANGGAL
        $('#searchdatadate-mobile').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD MMMM YYYY',
                cancelLabel: 'Reset'
            },
            "drops": "up"
        });
        $('#searchdatadate').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format(
                'DD MMM YYYY'));
            $(this).data("start", picker.startDate.format('YYYY/MM/DD'))
            $(this).data("end", picker.endDate.format('YYYY/MM/DD'))

            $("#searchdatadate-mobile").data("start", picker.startDate.format('YYYY/MM/DD'))
            $("#searchdatadate-mobile").data("end", picker.endDate.format('YYYY/MM/DD'))
            //loader_datatable(); 
            updateURLFilters();

            table.ajax.reload(null, false);
        }).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $(this).data("start", "")
            $(this).data("end", "")

            $("#searchdatadate-mobile").data("start", "")
            $("#searchdatadate-mobile").data("end", "")
            //loader_datatable(); 
            updateURLFilters();
            table.ajax.reload(null, false);
        });
        $('#searchdatadate-mobile').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format(
                'DD MMM YYYY'));
            $(this).data("start", picker.startDate.format('YYYY/MM/DD'))
            $(this).data("end", picker.endDate.format('YYYY/MM/DD'))


            $("#searchdatadate").data("start", picker.startDate.format('YYYY/MM/DD'))
            $("#searchdatadate").data("end", picker.endDate.format('YYYY/MM/DD'))
            //loader_datatable(); 
            updateURLFilters();
            table.ajax.reload(null, false);
        }).on('cancel.dateranactive_filtergepicker', function(ev, picker) {
            $(this).val('');
            $(this).data("start", "")
            $(this).data("end", "")
            $("#searchdatadate").data("start", "")
            $("#searchdatadate").data("end", "")
            //loader_datatable(); 
            updateURLFilters();
            table.ajax.reload(null, false);
        });

        // FILTER SEARCH
        $("#searchdatasph").keyup(function() {
            //loader_datatable(); 
            $("#searchdatasph_mobile").val($("#searchdatasph").val())
            updateURLFilters();
            table.ajax.reload(null, false);
        })
        $("#searchdatasph_mobile").keyup(function() {
            //loader_datatable(); 
            $("#searchdatasph").val($("#searchdatasph_mobile").val())
            updateURLFilters();
            table.ajax.reload(null, false);
        })

        $('#filterdatastatus').select2({
            multiple: true,
            templateSelection: function(selection) {
                var selected = $('#filterdatastatus').val().length;
                return selected + " item dipilih";
            }
        });
        $('#filterdatastatus').on('select2:select', function(e) {
            $('.select2-selection__choice').remove();
        });
        $(".input-group .combo").click(function() {
            if ($(this).parent().hasClass("active")) {
                $(this).parent().removeClass("active");
            } else {
                $(this).parent().addClass("active");
                var ele = $(this);
                $(document).on('click', function(event) {
                    if (!$(event.target).closest(ele).length && !$(
                            event.target).closest(
                            ".filter-data").length && !$(
                            event.target).closest(
                            ".filter-list").length) {
                        $(ele).parent().removeClass('active');
                    }
                });
            }
        })
        // Event listener untuk Filter Status
        $('.form-check-input.select.category').change(function() {
            if ($(this).is(':checked')) {
                filter_status_select.push($(this).data("value"));
            } else {
                var index = filter_status_select.indexOf($(this).data("value"));
                if (index !== -1) {
                    filter_status_select.splice(index, 1);
                }
            }
            (filter_status_select.length === 0 ? $("#searchdatafilter").val("") : $("#searchdatafilter").val(String(filter_status_select.length) + " status dipilih"));

            // PANDUAN HYBRID: Perbarui parameter URL sebelum reload data
            updateURLFilters();
            table.ajax.reload(null, false);
        });

        // Event listener untuk Filter Toko
        $('.form-check-input.select.store').change(function() {
            if ($(this).is(':checked')) {
                filter_store_select.push($(this).data("value"));
            } else {
                var index = filter_store_select.indexOf($(this).data("value"));
                if (index !== -1) {
                    filter_store_select.splice(index, 1);
                }
            }
            (filter_store_select.length === 0 ? $("#storedatafilter").val("") : $("#storedatafilter").val(String(filter_store_select.length) + " toko dipilih"));
            (filter_store_select.length === 0 ? $("#storedatafilter_mobile").val("") : $("#storedatafilter_mobile").val(String(filter_store_select.length) + " toko dipilih"));

            // PANDUAN HYBRID: Perbarui parameter URL sebelum reload data
            updateURLFilters();
            table.ajax.reload(null, false);
        });

        // Terapkan nilai dari URL ke elemen UI visual & Variabel Global Anda
        if (savedSearch) {
            $("#searchdatasph").val(savedSearch);
            $("#searchdatasph_mobile").val(savedSearch);
        }

        // Fungsi pembantu untuk mengecek kondisi input search
        function toggleClearIcon(searchInput) { 
         var clearIcon = searchInput.closest(".icon-field").find(".icon-end");


            if (searchInput.val().length > 0) {
                clearIcon.fadeIn(200); // Munculkan dengan efek transisi smooth
            } else {
                clearIcon.fadeOut(200); // Sembunyikan jika kosong
            }
        }
        // 1. Jalankan fungsi saat halaman pertama kali dibuka (mengatasi jika URL membawa data filter)
        toggleClearIcon($("#searchdatasph"));
        toggleClearIcon($("#searchdatasph_mobile"));
        // 2. Event Listener saat user mengetik atau menyalin teks di input pencarian
        $(".icon-field input").on("keyup input", function() {
                // $(this) merujuk pada elemen input yang sedang diketik oleh user
            toggleClearIcon($(this)); 
        });

        // 3. Event Listener saat ikon silang (X) diklik
        $(".icon-field .icon-end").on("click", function() {
            var searchInput = $(this).closest('.icon-field').find('input');

            // Kosongkan nilai input
            searchInput.val("").trigger("keyup");

            // Sembunyikan kembali ikon silang
            $(this).fadeOut(200);

            // Fokuskan kembali kursor ke kotak search
            searchInput.focus();

            // PANDUAN HYBRID: Perbarui URL dan muat ulang tabel setelah data direset
            if (typeof updateURLFilters === "function") {
                updateURLFilters();
            }

            if (typeof table !== "undefined") {
                table.ajax.reload(null, false); // Muat ulang DataTable secara asinkron
            }
        });


        // 2. Restore Filter Status (Checkbox)
        filter_status_select = [];
        if (savedStatus.length > 0) {
            $('.form-check-input.select.category').each(function() {
                var rawValue = $(this).data("value");
                var valString = rawValue.toString();

                // Cek apakah nilai dari HTML ini ada di dalam array URL
                if (savedStatus.includes(valString)) {
                    $(this).prop('checked', true);

                    // PENTING: Cek dulu agar tidak di-push dua kali (mencegah double data)
                    if (filter_status_select.indexOf(rawValue) === -1) {
                        filter_status_select.push(rawValue);
                    }
                }
            });

            // Set teks pembantu visual
            if (filter_status_select.length === 0) {
                $("#searchdatafilter").val("");
            } else {
                active_filter = true;
                $("#searchdatafilter").val(filter_status_select.length + " status dipilih");
            }
        }

        // 3. Restore Filter Toko (Checkbox)
        filter_store_select = [];
        if (savedStore.length > 0) {
            $('.form-check-input.select.store').each(function() {
                var rawValue = $(this).data("value");
                var valString = rawValue.toString();

                if (savedStore.includes(valString)) {
                    $(this).prop('checked', true);

                    // PENTING: Cek dulu agar tidak di-push dua kali (mencegah double data)
                    if (filter_store_select.indexOf(rawValue) === -1) {
                        filter_store_select.push(rawValue);
                    }
                }
            });

            // Set teks pembantu visual untuk toko
            if (filter_store_select.length === 0) {
                $("#storedatafilter").val("");
                $("#storedatafilter_mobile").val("");
            } else {
                active_filter = true;
                var txtToko = filter_store_select.length + " toko dipilih";
                $("#storedatafilter").val(txtToko);
                $("#storedatafilter_mobile").val(txtToko);
            }
        }

        if (savedStart && savedEnd) {
            // 1. Masukkan data koordinat ke jQuery data attribute sesuai format backend Anda
            $("#searchdatadate").data("start", savedStart);
            $("#searchdatadate").data("end", savedEnd);
            $("#searchdatadate-mobile").data("start", savedStart);
            $("#searchdatadate-mobile").data("end", savedEnd);

            // 2. Format teks untuk ditampilkan ke dalam kotak input (DD MMM YYYY)
            var displayStart = moment(savedStart, 'YYYY/MM/DD').format('DD MMM YYYY');
            var displayEnd = moment(savedEnd, 'YYYY/MM/DD').format('DD MMM YYYY');
            var textDisplay = displayStart + ' - ' + displayEnd;

            $("#searchdatadate").val(textDisplay);
            $("#searchdatadate-mobile").val(textDisplay);
                active_filter = true;
        }
        setVisibleresetfilter();
        var paging = 1;
        var table = $('#data-table-sph').DataTable({
            "searching": false,
            "lengthChange": false,
            "pageLength": parseInt(10),
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "language": {
                "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                "loadingRecords": `<div class="loading-spinner"></div>`,
                "processing": `<div class="loading-spinner"></div>`,
            },
            "ajax": {
                "url": "<?= base_url() ?>datatables/get-datatable-penawaran",
                "type": "POST",
                "data": function(data) {
                    data["search"] = $("#searchdatasph").val();
                    data["store"] = filter_store_select;
                    data["filter"] = filter_status_select;
                    data["datestart"] = $("#searchdatadate").data("start");
                    data["dateend"] = $("#searchdatadate").data("end");
                }
            },
            "initComplete": function(settings, json) {
                $("#data-table-sph").wrap(
                    "<div id='scroll-table' style='overflow:auto; position:relative;max-height:60vh'></div>"
                );
            },
            "drawCallback": function(settings) {
                var activeDetailId = sessionStorage.getItem('activeDetailId');
                var savedScrollTop = sessionStorage.getItem('savedScrollPosition');

                if (activeDetailId) {
                    var targetBtn = $(`.btn-detail-item[data-id="${activeDetailId}"]`);
                    if (targetBtn.length > 0) {
                        // 1. Picu klik buka secara instan tanpa animasi
                        targetBtn.trigger('click', [true]);

                        // 2. Kembalikan posisi scroll secara presisi ke kontainer tabel
                        if (savedScrollTop) {
                            setTimeout(function() {
                                $('#scroll-table').scrollTop(savedScrollTop);
                            }, 50); // Jeda minimal agar layouting HTML selesai
                        }
                    }
                }
            },
            "columns": [{
                    data: null,
                    orderable: false,
                    className: "p-0 ps-2 d-none d-md-table-cell", // Sembunyikan di HP
                    width: "20px",
                    render: function(data, type, row) {
                        return `<a class="cursor-pointer text-head-3 btn-detail-item" data-id="${row.SphId}"> <iconify-icon icon="material-symbols:arrow-right-rounded" class="icon text-xxl" style="transition: transform 0.3s ease-in-out"> </iconify-icon></a>`;
                    }
                },
                {
                    data: "action",
                    orderable: false,
                    className: "action-td d-none d-md-table-cell", // Sembunyikan di HP
                    width: "60px"
                },
                {
                    data: "doc",
                    width: "130px",
                    className: "mobile-card-container",
                    render: function(data, type, row) {
                        // Logika penentuan store 
                        var customerAddress = row.customeraddress ? row.customeraddress : '-';
                        var customerTelp = row.customertelp ? row.customertelp : '';

                        // 1. Ubah string row.doc menjadi objek jQuery (dibungkus div virtual)
                        let $docWrapper = $('<div>').html(row.doc);

                        // 2. Cari tombol di dalamnya (misal berdasarkan fungsi onclick atau class)
                        let $docButton = $docWrapper.find('button[onclick*="sph_return_add_click"]');

                        // 3. Simpan elemen HTML tombol tersebut ke dalam variabel baru
                        let extractedButton = '';
                        if ($docButton.length > 0) {
                            // Ambil string HTML-nya
                            extractedButton = $docButton.prop('outerHTML');
                            extractedButton = $(extractedButton).addClass("me-auto").prop('outerHTML'); // Tambahkan class me-auto  
                            // Hapus tombol dan parent div-nya dari docWrapper agar tidak meninggalkan ruang kosong
                            $docButton.closest('.text-detail-3').remove(); 
                        }

                        // 4. Ambil sisa HTML row.doc yang sudah bersih dari tombol
                        let cleanDocHtml = $docWrapper.html();
                        // Render data pembanding dinamis dari data objek Anda
                        var html = `
                        <!-- TAMPILAN MOBILE (KARTU LEBAR PENUH) -->
                        <div class="custom-mobile-card d-block d-md-none py-8" >
                            <div class="d-flex justify-content-between align-items-center" style="zoom: 1.2;">
                                <div> 
                                    <div class="font-semibold text-xs mt-1">${cleanDocHtml}</div>
                                </div>
                                <div>
                                   ${row.status} 
                                </div>
                            </div>
                            <div class="border-top my-8"></div> 
                            <div class="row mx-2 pt-8">
                                <div class="col-1 col-1 align-items-center justify-content-center d-flex">
                                    <iconify-icon icon="material-symbols:date-range" class="icon text-md text-neutral-400"></iconify-icon>
                                </div>
                                <div class="col ps-0">
                                    <div class="d-flex align-items-center justify-content-between"> 
                                            ${row.date}
                                    </div>
                                </div>
                            </div> 
                            <div class="row mx-2 pt-8">
                                <div class="col-1 col-1 align-items-center justify-content-center d-flex">
                                    <iconify-icon icon="material-symbols:person" class="icon text-md text-neutral-400"></iconify-icon>
                                </div>
                                <div class="col ps-0">
                                    <div class="d-flex align-items-center justify-content-between"> 
                                        <div class=" text-head-3 text-wrap-mobile" style="line-height: 1.2;">
                                        ${row.admin}
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-2 pt-8">
                                <div class="col-1 col-1 align-items-start justify-content-center d-flex">
                                    <iconify-icon icon="material-symbols:article-person" class="icon text-md text-neutral-400"></iconify-icon>
                                </div>
                                <div class="col ps-0">
                                    <div class=" text-head-3 text-wrap-mobile" style="line-height: 1.2;">
                                    ${row.customer}
                                    </div>
                                    
                                    ${(customerTelp !== "" ? `<div class="text-muted text-xs mt-0.5 text-wrap-mobile">${customerTelp}</div>` : "")}
                                    
                                    <!-- Tambahkan class text-wrap-mobile di bagian alamat juga -->
                                    <div class="text-neutral-400 text-xxs text-wrap-mobile">
                                         ${customerAddress}
                                    </div> 
                                </div>
                            </div>   
                            <div class="border-top my-8"></div>  
                            ${row.detailmobile} 
                            <div class="border-top my-8"></div>
                            <div class="row mx-2 pt-8">
                                <div class="col-5">
                                    Sub Total
                                </div>
                                <div class="col ps-0">
                                    <div class="d-flex align-items-center justify-content-between"> 
                                             <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.penawaran.SphSubTotal,2)}</span>
                                    </div>
                                </div>
                            </div> 
                            <div class="row mx-2 pt-8">
                                <div class="col-5">
                                    Disc Item
                                </div>
                                <div class="col ps-0">
                                    <div class="d-flex align-items-center justify-content-between"> 
                                             <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.penawaran.SphDiscItemTotal,2)}</span>
                                    </div>
                                </div>
                            </div> 
                            <div class="row mx-2 pt-8">
                                <div class="col-5">
                                    Disc Global
                                </div>
                                <div class="col ps-0">
                                    <div class="d-flex align-items-center justify-content-between"> 
                                            <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.penawaran.SphDiscTotal,2)}</span>
                                    </div>
                                </div>
                            </div> 
                            <div class="row mx-2 pt-8">
                                <div class="col-5">
                                    Pengiriman
                                </div>
                                <div class="col ps-0">
                                    <div class="d-flex align-items-center justify-content-between"> 
                                             <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.penawaran.SphDeliveryTotal,2)}</span>
                                    </div>
                                </div>
                            </div> 
                            <div class="row mx-2 pt-8">
                                <div class="col-5">
                                    Grand Total
                                </div>
                                <div class="col ps-0">
                                    <div class="d-flex align-items-center justify-content-between"> 
                                              <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.penawaran.SphGrandTotal,2)}</span>
                                    </div>
                                </div>
                            </div>  
                            <div class="border-top my-8"></div>
                            <div class="d-flex justify-content-end align-items-center" style="zoom: 1.3;">
                               ${extractedButton !== '' ? extractedButton : ''}
                               ${row.action}
                            </div>
 
                        </div>

                        <!-- TAMPILAN DESKTOP (TEXT TABEL STANDAR) -->
                        <span class="d-none d-md-block">${data}</span>
                    `;
                        return html;
                    }
                },
                {
                    data: "date",
                    width: "100px",
                    className: "d-none d-md-table-cell"
                },
                {
                    data: "status",
                    width: "100px",
                    className: "d-none d-md-table-cell"
                },
                {
                    data: "admin",
                    width: "150px",
                    className: "d-none d-md-table-cell"
                },
                {
                    data: "note",
                    width: "150px",
                    className: "action-td d-none d-md-table-cell",
                    render: function(data, type, row) {
                        return `<span>${data?.replaceAll('\\n', '<br>')}</span>
                            <a onclick="comment(${row.SphId},'${row.note}')"
                                class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-title="Ubah Catatan">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>`;
                    }
                },
                {
                    data: "total",
                    width: "150px",
                    className: "d-none d-md-table-cell"
                },
                {
                    data: "customer",
                    className: "align-top d-none d-md-table-cell",
                    render: function(data, type, row) {
                        return `<div style="max-width: 350px;">
                                <div class="text-head-3 pb-2 text-truncate" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip" data-bs-title="${row.customer}">${row.customer}</div>
                                ${(row.customertelp !== "" ? `<div class="text-detail-3 text-xs">${row.customertelp}</div>` : "")}
                                <div class="text-detail-3 text-neutral-400 text-truncate text-xxs" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip" data-bs-title="${row.customeraddress}">${row.customeraddress}</div>
                            </div>`;
                    }
                },
            ]
        });

        // Jalankan kembali fungsi bawaan Anda di bawahnya tanpa ada perubahan
        table.on('draw.dt', function() {
            var info = table.page.info();
            if (info.page + 1 > info.pages && info.pages > 0) {
                table.page('last').draw('page');
            }
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
        // A. Deteksi & Simpan posisi scroll setiap kali user mengesel tabel
        $(document).on('scroll', '#scroll-table', function() {
            var currentScroll = $(this).scrollTop();
            sessionStorage.setItem('savedScrollPosition', currentScroll);
        });

        // B. Event Listener Klik Tombol Detail Anda (Diperbarui)
        table.on('click', '.btn-detail-item', function(e, isAutomatic) {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var data = row.data();
            var currentId = $(this).data('id').toString();
            var duration = isAutomatic ? 0 : 500;

            tr.toggleClass('tr-child');

            if (row.child.isShown()) {
                // Proses Menutup Detail
                $(tr).next().find('.view-detail').slideUp(duration, function() {
                    row.child.hide();
                });
                $(this).find('iconify-icon').attr('rotate', "0deg");

                if (!isAutomatic) {
                    sessionStorage.removeItem('activeDetailId');
                    sessionStorage.removeItem('savedScrollPosition'); // Hapus posisi scroll jika ditutup
                }
            } else {
                // Proses Membuka Detail
                $(this).find('iconify-icon').attr('rotate', "90deg");

                var childRow = row.child(format(data)).show();
                $(tr).next().addClass('child-row');
                $(tr).next().find('td:not(.detail)').addClass('p-0 ps-2');
                $(tr).next().find('.view-detail').slideDown(duration);
                $(tr).next().find('td').addClass('no-border');

                // Simpan ID yang aktif
                sessionStorage.setItem('activeDetailId', currentId);

                // Simpan posisi scroll saat ini dari pembungkus tabel
                var currentScroll = $('#scroll-table').scrollTop();
                sessionStorage.setItem('savedScrollPosition', currentScroll);
            }
        });

        function format(data) {
            return data.detail;
        }

        tooltiprenew = function() {
            // Hapus tooltip sebelumnya
            var tooltipTriggerListOld = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerListOld.map(function(tooltipTriggerEl) {
                var tooltip = bootstrap.Tooltip.getInstance(tooltipTriggerEl);
                if (tooltip) {
                    tooltip.dispose();
                }
            });
            $(".tooltip").remove();
            // Buat tooltip baru
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                var tooltip = new bootstrap.Tooltip(tooltipTriggerEl);
                if (tooltipTriggerEl.innerText?.includes('top')) {
                    tooltip.enable();
                }
                return tooltip;
            });
        }

        var isProcessingSph;
        add_click = function(el) {

            var currentUrlWithFilters = window.location.href;
            sessionStorage.setItem('sph_last_url_search', currentUrlWithFilters);
            window.location = "<?= base_url() ?>admin/sales/penawaran/add";
            return;
            // if (isProcessingSph) {
            //     console.log("project Penawaran cancel load");
            //     return;
            // }
            // isProcessingSph = true;
            // let old_text = $(el).html();
            // $(el).html(
            //     '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>'
            // );

            // $.ajax({
            //     method: "POST",
            //     url: "<?= base_url() ?>message/add-penawaran",
            //     success: function(data) {
            //         $("#modal-message").html(data);
            //         $("#modal-add-penawaran").modal("show");
            //         $("#modal-add-penawaran").data("menu",
            //             "Penawaran");

            //         isProcessingSph = false;
            //         $(el).html(old_text);
            //         tooltiprenew();
            //     },
            //     error: function(xhr, textStatus, errorThrown) {
            //         isProcessingSph = false;
            //         $(el).html(old_text);

            //         Swal.fire({
            //             icon: 'error',
            //             text: xhr["responseJSON"]
            //                 [
            //                     'message'
            //                 ],
            //             confirmButtonColor: "var(--brand)",
            //         });
            //         tooltiprenew();
            //     }
            // });
        }
        print_sph = function(id, el, ref, type = 1) {
            $("#modal-print-penawaran").modal("show");
            $("#modal-print-penawaran").data("id", id)
            // window.open('<?= base_url("print/project/sph/") ?>' + id + "/" + type, '_blank'); 
        }
        $("#btn-print-sph").click(function(i) {
            $.redirect('<?= base_url("print/project/sph/") ?>' + $(
                    "#modal-print-penawaran").data(
                    "id"), {
                    kertas: $("#SphPrintFormat").val(),
                    image: $('input[name="SphPrintImage"]:checked')
                        .val(),
                    total: $('input[name="SphPrintTotal"]:checked')
                        .val(),
                    disc: $('input[name="SphPrintDisc"]:checked')
                        .val(),
                    date: moment().format('DDMMYYYYHHmmss'),
                },
                "GET", '_blank');
            $("#modal-print-penawaran").modal("hide");
        });

        comment = function(id, catatan) {
            $("#modal-comment-penawaran").modal("show");
            $("#modal-comment-penawaran").data("id", id);
            $("#SphNote").val(catatan);
        }

        $("#btn-comment-sph").click(function(i) {
            $.ajax({
                dataType: "json",
                method: "POST",
                url: "<?= base_url() ?>action/change-comment-penawaran/" +
                    $("#modal-comment-penawaran").data("id"),
                data: {
                    SphNote: $("#SphNote").val()
                },
                success: function(data) {
                    Swal.fire({
                        title: "Success!",
                        text: "Catatan Berhasil disimpan",
                        icon: "success",
                        confirmButtonColor: "var(--brand)",
                    });
                    table.ajax.reload(null, false);
                    $("#modal-comment-penawaran").modal(
                        "hide");
                },
            });
        });
        var isProcessingSphDelete = [];
        delete_sph = function(id, el, ref) {
            // INSERT LOADER BUTTON
            if (isProcessingSphDelete[id]) {
                return;
            }
            isProcessingSphDelete[id] = true;
            let old_text = $(el).html();
            $(el).html(
                '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
            );

            tooltiprenew();
            Swal.fire({
                title: "Are you sure?",
                text: "Anda yakin ingin membatalkan penawaran ini.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "var(--brand)",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        dataType: "json",
                        method: "POST",
                        url: "<?= base_url() ?>action/delete-data-penawaran/" +
                            id,
                        success: function(
                            data
                        ) {
                            Swal.fire({
                                title: "Success!",
                                text: "Data penawaran berhasil di batalkan.",
                                icon: "success",
                                confirmButtonColor: "var(--brand)",
                            });
                            table.ajax.reload(null,
                                false
                            );
                        },
                    });
                }
                isProcessingSphDelete[id] = false;
                $(el).html(old_text);
            });
        };

        var isProcessingSphEdit = [];

        edit_sph = function(id, el, ref) {

            var currentUrlWithFilters = window.location.href;
            sessionStorage.setItem('sph_last_url_search', currentUrlWithFilters);

            window.location = "<?= base_url() ?>admin/sales/penawaran/edit/" + id;
            return;
            // if (isProcessingSphEdit[id]) {
            //             console.log("project Penawaran cancel load");
            //             return;
            // }
            // isProcessingSphEdit[id] = true;
            // let old_text = $(el).html();
            // $(el).html(
            //             '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
            // );

            // $.ajax({
            //             method: "POST",
            //             url: "<?= base_url() ?>message/edit-penawaran/" +
            //                     id,
            //             success: function(data) {
            //                     $("#modal-message").html(
            //                                 data);
            //                     $("#modal-edit-penawaran")
            //                                 .modal("show");
            //                     $("#modal-edit-penawaran")
            //                                 .data("menu",
            //                                         "Penawaran"
            //                                 );

            //                     isProcessingSphEdit[id] =
            //                                 false;
            //                     $(el).html(old_text);
            //                     tooltiprenew();
            //             },
            //             error: function(xhr, textStatus, errorThrown) {
            //                     isProcessingSphEdit[id] =
            //                                 false;
            //                     $(el).html(old_text);

            //                     Swal.fire({
            //                                 icon: 'error',
            //                                 text: xhr["responseJSON"]
            //                                         [
            //                                                     'message'
            //                                         ],
            //                                 confirmButtonColor: "var(--brand)",
            //                     });
            //                     tooltiprenew();
            //             }
            // });
        }

        var IsUpdateStatus = [];
        update_status = function(status, id, el) {
            if (IsUpdateStatus[id]) {
                console.log("project penawaran cancel load");
                return;
            }

            IsUpdateStatus[id] = true;
            let old_text = $(el).html();
            $(el).html(
                '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
            );

            $.ajax({
                method: "POST",
                url: "<?= base_url() ?>action/update-penawaran/" +
                    id + "/" + status,
                success: function(data) {
                    IsUpdateStatus[id] = false;
                    $(el).html(old_text);
                    tooltiprenew();

                    table.ajax.reload(null,
                        false);
                },
                error: function(xhr, textStatus, errorThrown) {
                    IsUpdateStatus[id] = false;
                    $(el).html(old_text);
                    tooltiprenew();

                    Swal.fire({
                        icon: 'error',
                        text: xhr["responseJSON"]
                            [
                                'message'
                            ],
                        confirmButtonColor: "var(--brand)",
                    });
                }
            });
        };
        sph_return_add_click = function(ref, el, id, type) {
            if (type == "Invoice") {
                window.location = "<?= base_url() ?>admin/sales/invoice/add?sphid=" + id;
                return;
            }

        }
    });
</script>


<div style="margin-bottom: 100px;"></div>


<?php $this->endSection(); ?>