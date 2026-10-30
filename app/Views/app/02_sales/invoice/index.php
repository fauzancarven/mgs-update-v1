<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<div class="d-none d-md-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          <h6 class="fw-semibold mb-0">List Invoice</h6>
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
                    <li class="fw-medium"> <a href="<?= base_url() ?>admin/sales/invoice"
                                        class="d-flex align-items-center gap-1 hover-text-primary">
                                        <iconify-icon icon="hugeicons:invoice-03" class="icon text-lg">
                                        </iconify-icon>
                                        List Invoice
                              </a>
                    </li>
          </ul>
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
                    <input type="text" name="searchdata" class="form-control form-control-sm w-auto" placeholder="Search" id="searchdata">
                    <span class="icon">
                        <iconify-icon icon="ion:search-outline"></iconify-icon>
                    </span>
                    <span class="icon icon-end">
                        <iconify-icon icon="meteor-icons:xmark"></iconify-icon>
                    </span>
                </div>
                <a onclick="add_click(this)" class="btn btn-sm btn-primary-600">
                    <i class="ri-add-line"></i>
                    <span class="d-none d-sm-inline-block">Buat Invoice</span>
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
                    <input type="text" name="searchdata_mobile" class="form-control form-control-sm w-100" placeholder="Search..." id="searchdata_mobile">
                    <span class="icon">
                        <iconify-icon icon="ion:search-outline"></iconify-icon>
                    </span>
                    <span class="icon icon-end"> 
                        <iconify-icon icon="meteor-icons:xmark"></iconify-icon>
                    </span> 
                </div>
                <button class="btn btn-sm btn-secondary border px-8 d-flex align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterMobileSheet">
                    <iconify-icon icon="mdi:cog-outline" class="text-xl"></iconify-icon><span class="icon icon-end" style="display: inline-block;">
                       
                </button>
            </div>

            <!-- Baris 2: Tombol Buat Penawaran (Lebar Penuh) -->
            <a onclick="add_click(this)" class="btn btn-sm btn-primary-600 w-100 d-flex justify-content-center align-items-center gap-1">
                <i class="ri-add-line"></i>
                <span>Buat Invoice</span>
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
                    <table id="data-table-invoice" class="table bordered-table " style="width:100%">
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
                                                  <th scope="col">Sisa Payment</th>
                                                  <th scope="col">Customer</th>
                                        </tr>
                              </thead>
                              <tbody>
                              </tbody>
                    </table>
          </div>
</div>


<div class="modal fade" id="modal-print-invoice" tabindex="-1" data-id="0" aria-labelledby="modal-print-invoiceLabel"
          aria-hidden="true">
          <div class="modal-dialog">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modal-print-invoiceLabel">Print Invoice</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-3">
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="InvPrintFormat" class="col-sm-4 col-form-label">Ukuran
                                                            Kertas</label>
                                                  <div class="col-sm-8">
                                                            <select class="form-select form-select-sm"
                                                                      id="InvPrintFormat" name="InvPrintFormat"
                                                                      placeholder="Pilih Admin" style="width:100%">
                                                                      <option id="A4" selected>A4</option>
                                                                      <option id="A5">A5</option>
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="InvPrintImage" class="col-sm-4 col-form-label">Tampilkan
                                                            gambar item</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="InvPrintImage" id="InvPrintImage1"
                                                                                value="0">
                                                                      <label class="text-detail"
                                                                                for="InvPrintImage1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="InvPrintImage" id="InvPrintImage2"
                                                                                value="1" checked>
                                                                      <label class="text-detail"
                                                                                for="InvPrintImage2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="InvPrintImage" class="col-sm-4 col-form-label">Gabungkan
                                                            Disc item dan DIsc Global</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="InvDisc" id="InvDisc1" value="0">
                                                                      <label class="text-detail"
                                                                                for="InvDisc1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="InvDisc" id="InvDisc2" value="1"
                                                                                checked>
                                                                      <label class="text-detail"
                                                                                for="InvDisc2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <script>
                                        $('#InvPrintFormat').change(function() {
                                                  console.log($(this).val())
                                                  if ($(this).val() == "A5") {
                                                            $('input[name="InvPrintImage"]').prop(
                                                                      "disabled", true)
                                                            $('input[name="InvPrintTotal"]').prop(
                                                                      "disabled", true)
                                                  } else {

                                                            $('input[name="InvPrintImage"]').prop(
                                                                      "disabled", false)
                                                            $('input[name="InvPrintTotal"]').prop(
                                                                      "disabled", false)
                                                  }
                                        });
                                        </script>
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary"
                                                  id="btn-print-invoice">Print</button>
                              </div>
                    </div>
          </div>
</div>

<div class="modal fade" id="modal-print-payment" tabindex="-1" data-id="0" aria-labelledby="modal-print-invoiceLabel"
          aria-hidden="true">
          <div class="modal-dialog">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modal-print-poLabel">Print Payment</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-3">
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="PaymentPrintFormat" class="col-sm-4 col-form-label">Ukuran
                                                            Kertas</label>
                                                  <div class="col-sm-8">
                                                            <select class="form-select form-select-sm"
                                                                      id="PaymentPrintFormat" name="PaymentPrintFormat"
                                                                      placeholder="Pilih Admin" style="width:100%">
                                                                      <option id="A4">A4</option>
                                                                      <option id="A5" selected>A5</option>
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="PaymentPrintImage" class="col-sm-4 col-form-label">gunakan
                                                            gambar item</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintImage"
                                                                                id="PaymentPrintImage1" value="0"
                                                                                checked disabled>
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintImage1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintImage"
                                                                                id="PaymentPrintImage2" value="1"
                                                                                disabled>
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintImage2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>

                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="PaymentPrintPriceOld"
                                                            class="col-sm-4 col-form-label">Hilangkan Pembayaran
                                                            Sebelumnya</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintPriceOld"
                                                                                id="PaymentPrintPriceOld2" value="0"
                                                                                checked>
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintPriceOld1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintPriceOld"
                                                                                id="PaymentPrintPriceOld2" value="1">
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintPriceOld2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="PaymentPrintPriceSisa"
                                                            class="col-sm-4 col-form-label">Hilangkan Sisa
                                                            Pembayaran</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintPriceSisa"
                                                                                id="PaymentPrintPriceSisa1" value="0"
                                                                                checked>
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintPriceSisa1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintPriceSisa"
                                                                                id="PaymentPrintPriceSisa2" value="1">
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintPriceSisa2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2 d-none">
                                                  <label for="PaymentPrintPrice" class="col-sm-4 col-form-label">gunakan
                                                            harga</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintPrice"
                                                                                id="PaymentPrintPrice1" value="0"
                                                                                checked>
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintPrice1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintPrice"
                                                                                id="PaymentPrintPrice2" value="1">
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintPrice2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2 d-none">
                                                  <label for="PaymentPrintTotal" class="col-sm-4 col-form-label">gunakan
                                                            grand total</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintTotal"
                                                                                id="PaymentPrintTotal1" value="0"
                                                                                checked>
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintTotal1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="PaymentPrintTotal"
                                                                                id="PaymentPrintTotal2" value="1">
                                                                      <label class="text-detail"
                                                                                for="PaymentPrintTotal2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <script>
                                        $('input[name="PaymentPrintPrice"]').change(function() {
                                                  if ($(this).val() == 0) {
                                                            $('input[name="PaymentPrintTotal"]')
                                                                      .prop("disabled", true)
                                                  } else {

                                                            $('input[name="PaymentPrintTotal"]')
                                                                      .prop("disabled", false)
                                                  }
                                        });
                                        $("#PaymentPrintFormat").change(function() {
                                                  if ($(this).val() == "A5") {
                                                            $('input[name="PaymentPrintImage"]')
                                                                      .prop("disabled", true)
                                                            $('#PaymentPrintImage1').prop("checked",
                                                                      true)
                                                            $('input[name="PaymentPrintPrice"]')
                                                                      .prop("disabled", true)
                                                            $('#PaymentPrintPrice1').prop("checked",
                                                                      true)
                                                            $('input[name="PaymentPrintTotal"]')
                                                                      .prop("disabled", true)
                                                            $('#PaymentPrintTotal1').prop("checked",
                                                                      true)
                                                  } else {
                                                            $('input[name="PaymentPrintImage"]')
                                                                      .prop("disabled", false)
                                                            $('input[name="PaymentPrintPrice"]')
                                                                      .prop("disabled", false)
                                                            $('input[name="PaymentPrintTotal"]')
                                                                      .prop("disabled", false)
                                                  }
                                        })
                                        </script>
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary"
                                                  id="btn-print-payment">Print</button>
                              </div>
                    </div>
          </div>
</div>


<div class="modal fade" id="modal-print-proforma" tabindex="-1" data-id="0" aria-labelledby="modal-print-proformaLabel"
          aria-hidden="true">
          <div class="modal-dialog">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modal-print-poLabel">Print Proforma</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-3">
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="ProformaPrintFormat"
                                                            class="col-sm-4 col-form-label">Ukuran Kertas</label>
                                                  <div class="col-sm-8">
                                                            <select class="form-select form-select-sm"
                                                                      id="ProformaPrintFormat"
                                                                      name="ProformaPrintFormat"
                                                                      placeholder="Pilih Admin" style="width:100%">
                                                                      <option id="A5" selected>A5</option>
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="ProformaPrintPriceOld"
                                                            class="col-sm-4 col-form-label">Hilangkan Pembayaran
                                                            Sebelumnya</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="ProformaPrintPriceOld"
                                                                                id="ProformaPrintPriceOld2" value="0"
                                                                                checked>
                                                                      <label class="text-detail"
                                                                                for="ProformaPrintPriceOld1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="ProformaPrintPriceOld"
                                                                                id="ProformaPrintPriceOld2" value="1">
                                                                      <label class="text-detail"
                                                                                for="ProformaPrintPriceOld2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="ProformaPrintPriceSisa"
                                                            class="col-sm-4 col-form-label">Hilangkan Sisa
                                                            Pembayaran</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="ProformaPrintPriceSisa"
                                                                                id="ProformaPrintPriceSisa1" value="0"
                                                                                checked>
                                                                      <label class="text-detail"
                                                                                for="ProformaPrintPriceSisa1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="ProformaPrintPriceSisa"
                                                                                id="ProformaPrintPriceSisa2" value="1">
                                                                      <label class="text-detail"
                                                                                for="ProformaPrintPriceSisa2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <script>
                                        $('input[name="ProformaPrintPrice"]').change(function() {
                                                  if ($(this).val() == 0) {
                                                            $('input[name="ProformaPrintTotal"]')
                                                                      .prop("disabled", true)
                                                  } else {

                                                            $('input[name="ProformaPrintTotal"]')
                                                                      .prop("disabled", false)
                                                  }
                                        });
                                        $("#ProformaPrintFormat").change(function() {
                                                  if ($(this).val() == "A5") {
                                                            $('input[name="ProformaPrintImage"]')
                                                                      .prop("disabled", true)
                                                            $('#ProformaPrintImage1').prop(
                                                                      "checked", true)
                                                            $('input[name="ProformaPrintPrice"]')
                                                                      .prop("disabled", true)
                                                            $('#ProformaPrintPrice1').prop(
                                                                      "checked", true)
                                                            $('input[name="ProformaPrintTotal"]')
                                                                      .prop("disabled", true)
                                                            $('#ProformaPrintTotal1').prop(
                                                                      "checked", true)
                                                  } else {
                                                            $('input[name="ProformaPrintImage"]')
                                                                      .prop("disabled", false)
                                                            $('input[name="ProformaPrintPrice"]')
                                                                      .prop("disabled", false)
                                                            $('input[name="ProformaPrintTotal"]')
                                                                      .prop("disabled", false)
                                                  }
                                        })
                                        </script>
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary"
                                                  id="btn-print-proforma">Print</button>
                              </div>
                    </div>
          </div>
</div>

<!-- Modal Comment -->
<div class="modal fade" id="modal-comment-invoice" tabindex="-1" data-id="0"
          aria-labelledby="modal-comment-invoiceLabel" aria-hidden="true">
          <div class="modal-dialog">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modal-comment-invoiceLabel">Comment invoice
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-3">
                                        <div class="row mb-24 gy-3 align-items-center">
                                                  <label class="form-label mb-0 col-sm-3">Catatan</label>
                                                  <div class="col-sm-9">
                                                            <textarea id="InvNote" class="form-control" rows="4"
                                                                      cols="50"
                                                                      placeholder="Catatan invoice"></textarea>
                                                  </div>
                                        </div>
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-sm btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-sm btn-primary-600"
                                                  id="btn-comment-inv">Simpan</button>
                              </div>
                    </div>
          </div>
</div>
<div class="modal fade" id="modal-comment-po" tabindex="-1" data-id="0" aria-labelledby="modal-comment-poLabel"
          aria-hidden="true">
          <div class="modal-dialog">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modal-comment-poLabel">Comment Pembelian
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-3">
                                        <div class="row mb-24 gy-3 align-items-center">
                                                  <label class="form-label mb-0 col-sm-3">Catatan</label>
                                                  <div class="col-sm-9">
                                                            <textarea id="PONote" class="form-control" rows="4"
                                                                      cols="50"
                                                                      placeholder="Catatan Pembelian"></textarea>
                                                  </div>
                                        </div>
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-sm btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-sm btn-primary-600"
                                                  id="btn-comment-po">Simpan</button>
                              </div>
                    </div>
          </div>
</div>


<div class="modal fade" id="modal-print-po" tabindex="-1" data-id="0" aria-labelledby="modal-print-invoiceLabel"
          aria-hidden="true">
          <div class="modal-dialog">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modal-print-poLabel">Print Pembelian</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-3">
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="POPrintFormat" class="col-sm-4 col-form-label">Ukuran
                                                            Kertas</label>
                                                  <div class="col-sm-8">
                                                            <select class="form-select form-select-sm"
                                                                      id="POPrintFormat" name="POPrintFormat"
                                                                      placeholder="Pilih Admin" style="width:100%">
                                                                      <option id="1" selected>A4</option>
                                                                      <option id="2">A5</option>
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="POPrintImage" class="col-sm-4 col-form-label">gunakan
                                                            gambar item</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="POPrintImage" id="POPrintImage1"
                                                                                value="0">
                                                                      <label class="text-detail"
                                                                                for="POPrintImage1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="POPrintImage" id="POPrintImage2"
                                                                                value="1" checked>
                                                                      <label class="text-detail"
                                                                                for="POPrintImage2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="POPrintPrice" class="col-sm-4 col-form-label">gunakan
                                                            harga</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="POPrintPrice" id="POPrintPrice1"
                                                                                value="0">
                                                                      <label class="text-detail"
                                                                                for="POPrintPrice1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="POPrintPrice" id="POPrintPrice2"
                                                                                value="1" checked>
                                                                      <label class="text-detail"
                                                                                for="POPrintPrice2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="POPrintTotal" class="col-sm-4 col-form-label">gunakan
                                                            grand total</label>
                                                  <div class="col-sm-8">
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="POPrintTotal" id="POPrintTotal1"
                                                                                value="0">
                                                                      <label class="text-detail"
                                                                                for="POPrintTotal1">Tidak</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio"
                                                                                name="POPrintTotal" id="POPrintTotal2"
                                                                                value="1" checked>
                                                                      <label class="text-detail"
                                                                                for="POPrintTotal2">Ya</label>
                                                            </div>
                                                  </div>
                                        </div>
                                        <script>
                                        $('input[name="POPrintPrice"]').change(function() {
                                                  if ($(this).val() == 0) {
                                                            $('input[name="POPrintTotal"]').prop(
                                                                      "disabled", true)
                                                  } else {

                                                            $('input[name="POPrintTotal"]').prop(
                                                                      "disabled", false)
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
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary" id="btn-print-po">Print</button>
                              </div>
                    </div>
          </div>
</div>
<div class="modal fade" id="modal-detail-invoice" tabindex="-1" data-id="0" aria-labelledby="modal-detail-invoiceLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modal-detail-invoiceLabel">Print Pembelian</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-3" id="modal-body-detail-invoice">
                                       
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button> 
                              </div>
                    </div>
          </div>
</div>

<div id='view-container'></div>
<div id="modal-message"></div>

<script src="https://unpkg.com/@panzoom/panzoom@4.6.0/dist/panzoom.min.js"></script>
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
            var searchVal = $("#searchdata").val();
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
        $("#searchdata").keyup(function() {
            //loader_datatable(); 
            $("#searchdata_mobile").val($("#searchdata").val())
            updateURLFilters();
            table.ajax.reload(null, false);
        })
        $("#searchdata_mobile").keyup(function() {
            //loader_datatable(); 
            $("#searchdata").val($("#searchdata_mobile").val())
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
            $("#searchdata").val(savedSearch);
            $("#searchdata_mobile").val(savedSearch);
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
        toggleClearIcon($("#searchdata"));
        toggleClearIcon($("#searchdata_mobile"));
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
        var table = $('#data-table-invoice').DataTable({
          "searching": false,
          "lengthChange": false,
          "pageLength": parseInt(10),
          "language": {
                    "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                    "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                    "loadingRecords": `<div class="loading-spinner"></div>`,
                    "processing": `<div class="loading-spinner"></div>`,
          },
          "ordering": false,
          "processing": true,
          "serverSide": true,
          "ajax": {
                    "url": "<?= base_url()?>datatables/get-datatable-invoice",
                    "type": "POST",
                    "data": function(data) {
                              data["search"] = $("#searchdata").val();
                              data["store"] = filter_store_select;
                              data["filter"] = filter_status_select;
                              data["datestart"] = $("#searchdatadate").data("start");
                              data["dateend"] = $("#searchdatadate").data("end");
                    }
          },
          "initComplete": function(settings, json) {
                    $("#data-table-invoice").wrap(
                              //   "<div style='overflow:auto; width:100%;position:relative; height:60vh'></div>"
                              "<div style='overflow:auto; width:100%;position:relative;max-height:60vh'></div>"
                    );
                    $('[data-bs-toggle="tooltip"]').tooltip();
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
                        return `<a class="cursor-pointer text-head-3 btn-detail-item" data-id="${row.InvId}"> <iconify-icon icon="material-symbols:arrow-right-rounded" class="icon text-xxl" style="transition: transform 0.3s ease-in-out"> </iconify-icon></a>`;
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
                            let $docButton = $docWrapper.find('button[onclick*="Inv_return_add_click"]');

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
                                        <div class="d-flex justify-content-end gap-1 py-4">
                                            ${row.payment}
                                            ${row.delivery}
                                            ${row.pembelian}
                                        </div>
                                        <div class="d-flex justify-content-end gap-1 py-4">
                                       ${row.status}
                                        </div>
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
                                                <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.invoice.InvSubTotal,2)}</span>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row mx-2 pt-8">
                                    <div class="col-5">
                                        Disc Item
                                    </div>
                                    <div class="col ps-0">
                                        <div class="d-flex align-items-center justify-content-between"> 
                                                <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.invoice.InvDiscItemTotal,2)}</span>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row mx-2 pt-8">
                                    <div class="col-5">
                                        Disc Global
                                    </div>
                                    <div class="col ps-0">
                                        <div class="d-flex align-items-center justify-content-between"> 
                                                <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.invoice.InvDiscTotal,2)}</span>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row mx-2 pt-8">
                                    <div class="col-5">
                                        Pengiriman
                                    </div>
                                    <div class="col ps-0">
                                        <div class="d-flex align-items-center justify-content-between"> 
                                                <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.invoice.InvDeliveryTotal,2)}</span>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row mx-2 pt-8">
                                    <div class="col-5">
                                        Grand Total
                                    </div>
                                    <div class="col ps-0">
                                        <div class="d-flex align-items-center justify-content-between"> 
                                                <span class="fw-bold text-neutral-600 text-xs px-9">${rupiah(row.invoice.InvGrandTotal,2)}</span>
                                        </div>
                                    </div>
                                </div>  
                                <div class="border-top my-8"></div>
                                <div class="d-flex justify-content-end align-items-center " style="zoom: 1.3;"> 
                                    <div class="position-absolute me-auto" style="left: 1rem;"> 
                                        <button class="radius-8 bg-primary-light text-secondary-light text-xxs line-height-1 text-hover-primary-600 p-6  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="me-1">Lihat Detail</span>
                                        </button> 
                                        <ul class="dropdown-menu p-2 py-8 shadow-sm border-slate-100" style="min-width: 180px; position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 34px, 0px);" data-popper-placement="bottom-end">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2 text-info-main hover:bg-info-focus cursor-pointer btn-action detail" data-id="${row.InvId}" data-type="payment">
                                                    <iconify-icon icon="hugeicons:payment-02" class="fs-6"></iconify-icon>
                                                    <span class="text-xs">Pembayaran</span>
                                                </a>
                                            </li> 
                                            <li><hr class="dropdown-divider my-1 text-slate-100"></li> 
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2 text-warning-main hover:bg-warning-focus cursor-pointer btn-action detail" data-id="${row.InvId}" data-type="pengiriman">
                                                    <iconify-icon icon="hugeicons:delivery-truck-01" class="fs-6"></iconify-icon>
                                                    <span class="text-xs">Pengiriman</span>
                                                </a>
                                            </li>   
                                            <li><hr class="dropdown-divider my-1 text-slate-100"></li> 
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2 text-danger-main hover:bg-danger-focus cursor-pointer btn-action detail" data-id="${row.InvId}" data-type="pembelian">
                                                    <iconify-icon icon="hugeicons:warehouse" class="fs-6"></iconify-icon>
                                                    <span class="text-xs">Pembelian</span>
                                                </a>
                                            </li>
                                        </ul> 
                                    </div>
                                    ${row.action}
                                </div>
    
                            </div>

                            <!-- TAMPILAN DESKTOP (TEXT TABEL STANDAR) -->
                            <div class="d-none d-md-block">
                                ${data}
                                <div class="d-flex gap-1 pt-4">
                                    ${row.payment}
                                    ${row.delivery}
                                    ${row.pembelian}
                                </div>
                            </div> 
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
                              width: "120px",
                    className: "d-none d-md-table-cell"
                    },
                    {
                              data: "note",
                              width: "150px",
                    className: "action-td d-none d-md-table-cell",
                              render: function(data, type, row) {
                                        var html = `<span>${data.replaceAll('\\n', '<br>')}</span>
                                    <a onclick="comment(${row.InvId},'${row.note}')"
                                        class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip"  data-bs-title="Ubah Catatan">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>`;
                                        return html;
                              }
                    },
                    {
                              data: "total", 
                              width: "120px",
                    className: "d-none d-md-table-cell"
                    },
                    {
                              data: "paymenttotal",
                              orderable: false,
                              width: "120px", 
                    className: "d-none d-md-table-cell"
                    },
                    {
                              data: "customer",
                              //   width: "350px",
                    className: "align-top d-none d-md-table-cell",
                              render: function(data, type, row) {
                                        var html =
                                                  ` 
                        <div class="text-head-3 pb-2 text-truncate" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="${row.customer}">${row.customer}</div>
                        ${(row.customertelp !== "" ? `<div class="text-detail-3 text-xs">${row.customertelp}</div>` : "")}
                        <div class="text-detail-3 text-truncate text-xxs" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="${row.customeraddress}">${row.customeraddress}</div>`;

                                        return html;
                              }
                    },
          ], 
});

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
                    $(".btn-detail-delivery").unbind().click(function() {

                              tooltiprenew()
                              var trdelivery = $(".child-row.delivery[data-id='" +
                                        $(
                                                  this).data("id") +
                                        "'");
                              if ($(trdelivery).hasClass("open")) {
                                        $(trdelivery).find('.view-detail-1')
                                                  .slideUp(
                                                            500,
                                                            function() {
                                                                      $(trdelivery)
                                                                                .addClass(
                                                                                          "d-none"
                                                                                );
                                                            });
                                        $(trdelivery).removeClass("open");
                                        $(this).find('iconify-icon').attr(
                                                  'rotate', "0deg");
                              } else {

                                        $(this).find('iconify-icon').attr(
                                                  'rotate', "90deg");
                                        $(trdelivery).removeClass("d-none");
                                        $(trdelivery).find('.view-detail-1')
                                                  .slideDown(
                                                            500);
                                        $(trdelivery).addClass("open");
                              }
                    });


                    $(".btn-detail-pembelian").unbind().click(function() {

                              tooltiprenew()
                              var trdelivery = $(".child-row.pembelian[data-id='" +
                                        $(
                                                  this).data("id") +
                                        "'");
                              if ($(trdelivery).hasClass("open")) {
                                        $(trdelivery).find('.view-detail-1')
                                                  .slideUp(
                                                            500,
                                                            function() {
                                                                      $(trdelivery)
                                                                                .addClass(
                                                                                          "d-none"
                                                                                );
                                                            });
                                        $(trdelivery).removeClass("open");
                                        $(this).find('iconify-icon').attr(
                                                  'rotate', "0deg");
                              } else {

                                        $(this).find('iconify-icon').attr(
                                                  'rotate', "90deg");
                                        $(trdelivery).removeClass("d-none");
                                        $(trdelivery).find('.view-detail-1')
                                                  .slideDown(
                                                            500);
                                        $(trdelivery).addClass("open");
                              }
                    });
          }
          $('[data-bs-toggle="tooltip"]').tooltip();
});
table.on('click', '.btn-action.detail', function(e, isAutomatic) {  
    var tr = $(this).closest('tr');
    var row = table.row(tr);
    var data = row.data();
    if($(this).data("type") == "payment"){ 
        $("#modal-detail-invoiceLabel").html(`<div class="d-flex align-items-center gap-2"><iconify-icon icon="hugeicons:payment-02"></iconify-icon><span class="text-sm">Pembayaran</span></div>`);
        $("#modal-body-detail-invoice").html(data.payment_detail);
    }
    if($(this).data("type") == "pembelian"){ 
        $("#modal-detail-invoiceLabel").html(`<div class="d-flex align-items-center gap-2"><iconify-icon icon="hugeicons:warehouse"></iconify-icon> <span class="text-sm">Pembelian</span></div>`);
        $("#modal-body-detail-invoice").html(data.pembelian_detail);
    }
    if($(this).data("type") == "pengiriman"){ 
        $("#modal-detail-invoiceLabel").html(`<div class="d-flex align-items-center gap-2"><iconify-icon icon="hugeicons:delivery-truck-01"></iconify-icon> <span class="text-sm">Pengiriman</span></div>`);
        $("#modal-body-detail-invoice").html(data.delivery_detail);
    } 
    $("#modal-detail-invoice").modal("show")
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
var isProcessingInvoice;
add_click = function(el) {
          window.location = "<?= base_url() ?>admin/sales/invoice/add";
          return;
          if (isProcessingInvoice) {
                    console.log("add Invoice cancel load");
                    return;
          }
          isProcessingInvoice = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>'
          );
          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/add-invoice",
                    success: function(data) {
                              $("#modal-message").html(data);
                              $("#modal-add-invoice").modal("show");
                              $("#modal-add-invoice").data("menu", "Invoice");

                              isProcessingInvoice = false;
                              $(el).html(old_text);
                              tooltiprenew();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingInvoice = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                              tooltiprenew();
                    }
          });
}

print_invoice = function(id, el, ref) {
          $("#modal-print-invoice").modal("show");
          $("#modal-print-invoice").data("id", id)
};
$("#btn-print-invoice").click(function(i) {
          $.redirect('<?= base_url("print/project/invoice/") ?>' + $("#modal-print-invoice").data(
                              "id"), {
                              kertas: $("#InvPrintFormat").val(),
                              image: $('input[name="InvPrintImage"]:checked').val(),
                              total: $('input[name="InvPrintTotal"]:checked').val(),
                              disc: $('input[name="InvDisc"]:checked').val(),
                              date: moment().format('DDMMYYYYHHmmss'),
                    },
                    "GET", '_blank');
          $("#modal-print-invoice").modal("hide");

})

comment = function(id, catatan) {
          $("#modal-comment-invoice").modal("show");
          $("#modal-comment-invoice").data("id", id);
          $("#InvNote").val(catatan);
}
$("#btn-comment-inv").click(function(i) {
          $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/change-comment-invoice/" +
                              $("#modal-comment-invoice").data("id"),
                    data: {
                              InvNote: $("#InvNote").val()
                    },
                    success: function(data) {
                              Swal.fire({
                                        title: "Success!",
                                        text: "Catatan Berhasil disimpan",
                                        icon: "success",
                                        confirmButtonColor: "var(--brand)",
                              });
                              table.ajax.reload(null, false);
                              $("#modal-comment-invoice").modal(
                                        "hide");
                    },
          });
});
var isProcessingInvoiceEdit;
edit_invoice = function(id, el, ref) {

          window.location = "<?= base_url() ?>admin/sales/invoice/edit/" + id;
          return;
          if (isProcessingInvoiceEdit) {
                    console.log("edit Invoice cancel load");
                    return;
          }
          isProcessingInvoiceEdit = true;
          let old_text = $(el).html();
          $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span>');

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/edit-invoice/" + id,
                    success: function(data) {
                              $("#modal-message").html(data);
                              $("#modal-edit-invoice").modal("show");
                              $("#modal-edit-invoice").data("menu", "Invoice");

                              isProcessingInvoiceEdit = false;
                              $(el).html(old_text);
                              tooltiprenew();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingInvoiceEdit = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                              tooltiprenew();
                    }
          });
}

var isProcessingInvDelete = [];
delete_invoice = function(id, el, ref) {
          // INSERT LOADER BUTTON
          if (isProcessingInvDelete[id]) {
                    return;
          }
          isProcessingInvDelete[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          tooltiprenew();
          Swal.fire({
                    title: "Are you sure?",
                    text: "Anda yakin ingin membatalkan invoice ini.",
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
                                        url: "<?= base_url() ?>action/delete-data-invoice/" +
                                                  id,
                                        success: function(data) {
                                                  Swal.fire({
                                                            title: "Success!",
                                                            text: "Data invoice berhasil di batalkan.",
                                                            icon: "success",
                                                            confirmButtonColor: "#3085d6",
                                                  });
                                                  table.ajax.reload(null,
                                                            false
                                                  );
                                        },
                              });
                    }
                    isProcessingInvDelete[id] = false;
                    $(el).html(old_text);
          });
};

var IsUpdateStatus = [];
update_status = function(status, id, el) {
          if (IsUpdateStatus[id]) {
                    console.log("project invoice cancel load");
                    return;
          }

          IsUpdateStatus[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>action/update-invoice/" + id + "/" + status,
                    success: function(data) {
                              IsUpdateStatus[id] = false;
                              $(el).html(old_text);
                              tooltiprenew();

                              table.ajax.reload(null, false);
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
                                        confirmButtonColor: "#3085d6",
                              });
                    }
          });
};



var isProcessingInvoicePayment = [];
add_payment = function(id, el, type) {
          // INSERT LOADER BUTTON
          if (isProcessingInvoicePayment[id]) {
                    console.log("project invoice cancel load");
                    return;
          }
          isProcessingInvoicePayment[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/add-payment/" + id,
                    data: {
                              type: type
                    },
                    success: function(data) {
                              $("#modal-message").html(data);
                              if (type == "Invoice") {
                                        $("#modal-add-payment").modal("show");
                                        $("#modal-add-payment").data("menu",
                                                  "Invoice");
                              } else {

                                        $("#modal-add-proforma").modal("show");
                                        $("#modal-add-proforma").data("menu",
                                                  "Invoice");
                              }
                              $(".tooltip").remove();

                              isProcessingInvoicePayment[id] = false;
                              $(el).html(old_text);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingInvoicePayment[id] = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                    }
          });
}

var isProcessingInvoicePaymentEdit = [];
edit_payment = function(id, el, type) {
          // INSERT LOADER BUTTON
          if (isProcessingInvoicePaymentEdit[id]) {
                    console.log("project invoice cancel load");
                    return;
          }
          isProcessingInvoicePaymentEdit[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/edit-payment/" + id,
                    data: {
                              type: type
                    },
                    success: function(data) {
                              $("#modal-message").html(data);
                              if (type == "Invoice") {
                                        $("#modal-edit-payment").modal("show");
                                        $("#modal-edit-payment").data("menu",
                                                  "Invoice");
                              } else if (type == "Delivery") {
                                        $("#modal-edit-payment-delivery").modal(
                                                  "show");
                                        $("#modal-edit-payment-delivery").data(
                                                  "menu",
                                                  "Invoice");
                              } else if (type == "Pembelian") {
                                        $("#modal-edit-payment-pembelian")
                                                  .modal(
                                                            "show");
                                        $("#modal-edit-payment-pembelian").data(
                                                  "menu",
                                                  "Invoice");

                              } else {

                                        $("#modal-edit-proforma").modal("show");
                                        $("#modal-edit-proforma").data("menu",
                                                  "Invoice");
                              }
                              $(".tooltip").remove();

                              isProcessingInvoicePaymentEdit[id] = false;
                              $(el).html(old_text);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingInvoicePaymentEdit[id] = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                    }
          });
}

var isProcessingInvoicePaymentDelete = [];
delete_payment = function(id, el, type) {
          // INSERT LOADER BUTTON
          if (isProcessingInvoicePaymentDelete[id]) {
                    return;
          }
          isProcessingInvoicePaymentDelete[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

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
                                        url: "<?= base_url() ?>action/delete-data-payment/" +
                                                  id,
                                        success: function(data) {
                                                  Swal.fire({
                                                            title: "Deleted!",
                                                            text: "Pembayaran berhasil dihapus",
                                                            icon: "success",
                                                            confirmButtonColor: "#3085d6",
                                                  });
                                                  table.ajax.reload(null,
                                                            false
                                                  );
                                        },
                              });
                    }
                    isProcessingInvoicePaymentDelete[id] = false;
                    $(el).html(old_text);
          });
};

view_file = function(el) {
          filetype = $(el).data("type");
          switch (filetype) {
                    case 'text/plain':
                    case 'application/pdf':
                    case 'application/msword':
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                              var viewerUrl = 'https://docs.google.com/viewer?url=' + encodeURIComponent(
                                        '<?=base_url()?>' + $(el).data("file")) + '&embedded=true';
                              $('#view-container').html(`<div style="position: fixed;padding: 0;margin: 0;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.5);display: flex;justify-content: center;align-items: end;z-index: 2000;">
                    <iframe src="${viewerUrl}" frameborder="0" style="width: 100vw;height: calc(100vh - 50px);"></iframe>
                    <div class="bar-action">
                        <span class="flex-fill">${$(el).data("name")}</span> 
                        <iconify-icon icon="material-symbols:close-rounded" class="menu-icon" onclick="closeIframe()">
                                                  </iconify-icon>  
                    </div>
                    
                </div> `);
                              break;
                    case 'image/jpeg':
                    case 'image/png':
                              var viewerUrl = $(el).data("file");
                              $('#view-container').html(`<div style="position: fixed;padding: 0;margin: 0;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.5);display: flex;justify-content: center;align-items: end;z-index: 2000;">
                    <div id="panzoom-container" style="width: 100vw;height: 100vh">
                        <img id="gambar" src="${viewerUrl}"> 
                    </div>
                    <div class="bar-action">
                        <span class="flex-fill">${$(el).data("name")}</span>  
                        <iconify-icon icon="material-symbols:close-rounded" class="menu-icon" onclick="closeIframe()">
                                                  </iconify-icon>  
                    </div> 
                    
                </div> `);
                              //scrool('gambar'); 
                              $("html, body").css("overflow", "hidden");
                              var elem = document.getElementById('panzoom-container');
                              var panzoom = Panzoom(elem, {
                                        maxScale: 5,
                                        cursor: 'grab',
                                        wheel: true,
                                        zoomSpeed: 0.1,
                                        startScale: 0.5
                              });

                              var parent = elem.parentElement


                              // Panning and pinch zooming are bound automatically (unless disablePan is true).
                              // There are several available methods for zooming
                              // that can be bound on button clicks or mousewheel.
                              parent.addEventListener('wheel', panzoom.zoomWithWheel)

                              // This demo binds to shift + wheel
                              parent.addEventListener('wheel', function(event) {
                                        if (!event.shiftKey) return
                                        panzoom.zoomWithWheel(event)
                              })
                              panzoom.reset();
                              break;

                    default:
                              // Tampilkan view untuk tipe file lain 
                              break;
          }
}

closeIframe = function() {
          document.querySelector('div[style*="position: fixed"]').remove();

          $("html, body").css("overflow", "auto");
}

print_payment = function(id, el, type) {
          if (type == "Invoice") {
                    //window.open('<?= base_url("print/project/paymentA5/") ?>' + id, '_blank');
                    $("#modal-print-payment").modal("show");
                    $("#modal-print-payment").data("id", id)
          } else {
                    // window.open('<?= base_url("print/project/proformaA5/") ?>' + id, '_blank');
                    $("#modal-print-proforma").modal("show");
                    $("#modal-print-proforma").data("id", id)
          }
}

$("#btn-print-payment").click(function(i) {
          $.redirect('<?= base_url("print/project/payment/") ?>' + $("#modal-print-payment").data(
                              "id"), {
                              kertas: $("#PaymentPrintFormat").val(),
                              image: $('input[name="PaymentPrintImage"]:checked').val(),
                              sisa: $('input[name="PaymentPrintPriceSisa"]:checked')
                                        .val(),
                              old: $('input[name="PaymentPrintPriceOld"]:checked').val(),
                              date: moment().format('DDMMYYYYHHmmss'),
                    },
                    "GET", '_blank');
          $("#modal-print-payment").modal("hide");
})

$("#btn-print-proforma").click(function(i) {
          $.redirect('<?= base_url("print/project/proformaA5/") ?>' + $("#modal-print-proforma")
                    .data("id"), {
                              kertas: $("#ProformaPrintFormat").val(),
                              image: $('input[name="ProformaPrintImage"]:checked').val(),
                              sisa: $('input[name="ProformaPrintPriceSisa"]:checked')
                                        .val(),
                              old: $('input[name="ProformaPrintPriceOld"]:checked').val(),
                              date: moment().format('DDMMYYYYHHmmss'),
                    },
                    "GET", '_blank');
          $("#modal-print-proforma").modal("hide");
})

var isProcessingInvoiceUpdate = [];
update_invoice_delivery = function(id, el, status) {
          // INSERT LOADER BUTTON
          if (isProcessingInvoiceUpdate[id]) {
                    console.log("project invoice cancel load");
                    return;
          }
          isProcessingInvoiceUpdate[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          $.ajax({
                    method: "POST",
                    data: {
                              status: status,
                    },
                    url: "<?= base_url() ?>action/update-data-invoice-delivery/" + id,
                    success: function(data) {
                              if (status == 1) {
                                        Swal.fire({
                                                  title: "Active!",
                                                  text: "Mode pengiriman berhasil diaktifkan",
                                                  icon: "success",
                                                  confirmButtonColor: "#3085d6",
                                        });
                              } else {
                                        Swal.fire({
                                                  title: "Deactive!",
                                                  text: "Mode pengiriman berhasil dinonaktifkan",
                                                  icon: "success",
                                                  confirmButtonColor: "#3085d6",
                                        });
                              }
                              table.ajax.reload(null, false);
                              isProcessingInvoiceUpdate[id] = false;
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingInvoiceUpdate[id] = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                    }
          });
}

var isProcessingDeliveryAdd = [];
add_invoice_delivery = function(id, el) {

          window.location = "<?= base_url() ?>admin/sales/invoice/delivery_add/" + id;
          return;
          //   // INSERT LOADER BUTTON
          //   if (isProcessingDeliveryAdd[id]) {
          //             console.log("project invoice cancel load");
          //             return;
          //   }
          //   isProcessingDeliveryAdd[id] = true;
          //   let old_text = $(el).html();
          //   $(el).html(
          //             '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          //   );

          //   $.ajax({
          //             method: "POST",
          //             url: "<?= base_url() ?>message/add-delivery-invoice/" + id,
          //             success: function(data) {
          //                       $("#modal-message").html(data);
          //                       $("#modal-add-delivery").modal("show");
          //                       $("#modal-add-delivery").data("menu", "Invoice");
          //                       $(".tooltip").remove();

          //                       isProcessingDeliveryAdd[id] = false;
          //                       $(el).html(old_text);
          //             },
          //             error: function(xhr, textStatus, errorThrown) {
          //                       isProcessingDeliveryAdd[id] = false;
          //                       $(el).html(old_text);

          //                       Swal.fire({
          //                                 icon: 'error',
          //                                 text: xhr["responseJSON"]
          //                                           [
          //                                                     'message'
          //                                           ],
          //                                 confirmButtonColor: "#3085d6",
          //                       });
          //             }
          //   });
}

var isProcessingDeliveryEdit = [];
edit_delivery = function(id, el) {
          window.location = "<?= base_url() ?>admin/sales/invoice/delivery_edit/" + id;
          return;
          //   // INSERT LOADER BUTTON
          //   if (isProcessingDeliveryEdit[id]) {
          //             console.log("project invoice cancel load");
          //             return;
          //   }
          //   isProcessingDeliveryEdit[id] = true;
          //   let old_text = $(el).html();
          //   $(el).html(
          //             '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          //   );

          //   $.ajax({
          //             method: "POST",
          //             url: "<?= base_url() ?>message/edit-delivery-invoice/" + id,
          //             success: function(data) {
          //                       $("#modal-message").html(data);
          //                       $("#modal-edit-delivery").modal("show");
          //                       $("#modal-edit-delivery").data("menu", "Invoice");
          //                       $(".tooltip").remove();

          //                       isProcessingDeliveryEdit[id] = false;
          //                       $(el).html(old_text);
          //             },
          //             error: function(xhr, textStatus, errorThrown) {
          //                       isProcessingDeliveryEdit[id] = false;
          //                       $(el).html(old_text);

          //                       Swal.fire({
          //                                 icon: 'error',
          //                                 text: xhr["responseJSON"]
          //                                           [
          //                                                     'message'
          //                                           ],
          //                                 confirmButtonColor: "#3085d6",
          //                       });
          //             }
          //   });
}

var isProcessingInvoiceDelete = [];
delete_delivery = function(id, el) {
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
                                        url: "<?= base_url() ?>action/delete-data-delivery/" +
                                                  id,
                                        success: function(data) {
                                                  Swal.fire({
                                                            title: "Deleted!",
                                                            text: "Your file has been deleted.",
                                                            icon: "success",
                                                            confirmButtonColor: "#3085d6",
                                                  });
                                                  table.ajax.reload(null,
                                                            false
                                                  );
                                        },
                              });
                    }
                    isProcessingInvoiceDelete[id] = false;
          });
};

print_delivery = function(id) {
          window.open('<?= base_url("print/project/deliveryA5/") ?>' + id, '_blank');
}



var isProcessingDeliveryProses = [];
delivery_proses = function(id, el) {
          // INSERT LOADER BUTTON
          if (isProcessingDeliveryProses[id]) {
                    console.log("project invoice cancel load");
                    return;
          }
          isProcessingDeliveryProses[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/proses-delivery-invoice/" + id,
                    success: function(data) {
                              $("#modal-message").html(data);
                              $("#modal-add-proses-delivery").modal("show");
                              $("#modal-add-proses-delivery").data("menu",
                                        "Invoice");
                              $(".tooltip").remove();

                              isProcessingDeliveryProses[id] = false;
                              $(el).html(old_text);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingDeliveryProses[id] = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                    }
          });
}
var isProcessingDeliveryProsesEdit = [];
delivery_proses_edit = function(id, el) {
          // INSERT LOADER BUTTON
          if (isProcessingDeliveryProsesEdit[id]) {
                    console.log("project invoice cancel load");
                    return;
          }
          isProcessingDeliveryProsesEdit[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/proses-delivery-invoice-edit/" + id,
                    success: function(data) {
                              $("#modal-message").html(data);
                              $("#modal-edit-proses-delivery").modal("show");
                              $("#modal-edit-proses-delivery").data("menu",
                                        "Invoice");
                              $(".tooltip").remove();

                              isProcessingDeliveryProses[id] = false;
                              $(el).html(old_text);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingDeliveryProses[id] = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                    }
          });
}
delivery_proses_edit_date = function(id, el) {
          Swal.fire({
                    title: 'Ubah Tanggal Packing dan Kirim',
                    // 1. Inject a custom HTML input
                    html: '<input id="range-picker" class="swal2-input">',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Simpan",
                    // 2. Initialize the picker when the modal opens
                    didOpen: () => {
                              $('#range-picker').daterangepicker({
                                        "singleDatePicker": true,
                                        "startDate": moment($(
                                                            el
                                                  )
                                                  .data(
                                                            "date"
                                                  )
                                        ),
                                        autoUpdateInput: true,
                                        locale: {
                                                  format: 'DD MMM YYYY'
                                        }
                              });
                    },
                    // 3. Capture the selected value on confirm
                    preConfirm: () => {
                              $(el).data("date", $('#range-picker').data(
                                                  'daterangepicker')
                                        .startDate
                                        .format("YYYY-MM-DD"));
                              return $('#range-picker').data('daterangepicker')
                                        .startDate
                                        .format("dddd, D MMMM Y");
                    }
          }).then((result) => {
                    if (result.isConfirmed) {
                              $.ajax({
                                        dataType: "json",
                                        method: "POST",
                                        url: "<?= base_url() ?>action/change-date-delivery-proses/" +
                                                  id,
                                        data: {
                                                  "DeliveryDateProses": $(
                                                                      '#range-picker'
                                                            )
                                                            .data(
                                                                      'daterangepicker'
                                                            )
                                                            .startDate
                                                            .format(
                                                                      "YYYY-MM-DD"
                                                            )
                                        },
                                        success: function(data) {

                                                  $("#delivery-proses-date-" +
                                                                      id
                                                            )
                                                            .html(result
                                                                      .value
                                                            )
                                                  console.log("Selected Range: " +
                                                            result
                                                            .value
                                                  );
                                                  Swal.fire({
                                                            icon: 'success',
                                                            text: "Data berhasil disimpan...!",
                                                            confirmButtonColor: "#3085d6",
                                                  });
                                        },
                              });
                    }
          });
}
delivery_proses_edit_file = function(id, el) {
          // INSERT LOADER BUTTON
          if (isProcessingDeliveryProsesEdit[id]) {
                    console.log("project invoice cancel load");
                    return;
          }
          isProcessingDeliveryProsesEdit[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/edit-proses-delivery-invoice/" + id,
                    success: function(data) {
                              $("#modal-message").html(data);
                              $("#modal-edit-proses-delivery").modal("show");
                              $("#modal-edit-proses-delivery").data("menu",
                                        "Invoice");
                              $(".tooltip").remove();

                              isProcessingDeliveryProsesEdit[id] = false;
                              $(el).html(old_text);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingDeliveryProsesEdit[id] = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                    }
          });
}
var isProcessingDeliveryFinish = [];
delivery_finish = function(id, el) {
          // INSERT LOADER BUTTON
          if (isProcessingDeliveryFinish[id]) {
                    console.log("project invoice cancel load");
                    return;
          }
          isProcessingDeliveryFinish[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/finish-delivery-invoice/" + id,
                    success: function(data) {
                              $("#modal-message").html(data);

                              $("#modal-add-finish-delivery").modal("show");
                              $("#modal-add-finish-delivery").data("menu",
                                        "Invoice");
                              $(".tooltip").remove();

                              isProcessingDeliveryFinish[id] = false;
                              $(el).html(old_text);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingDeliveryFinish[id] = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                    }
          });
}


request_payment = function(id, el, menu) {
          if (menu == "Delivery") {
                    $.ajax({
                              method: "POST",
                              url: "<?= base_url() ?>message/add-payment-delivery/" +
                                        id,
                              success: function(data) {
                                        $("#modal-message").html(data);

                                        $("#modal-add-payment-delivery").modal(
                                                  "show");
                                        $("#modal-add-payment-delivery").data(
                                                  "menu",
                                                  "Invoice");
                                        $(".tooltip").remove();

                              },
                              error: function(xhr, textStatus, errorThrown) {

                                        Swal.fire({
                                                  icon: 'error',
                                                  text: xhr["responseJSON"]
                                                            [
                                                                      'message'
                                                            ],
                                                  confirmButtonColor: "#3085d6",
                                        });
                              }
                    });
          }

          if (menu == "Pembelian") {
                    $.ajax({
                              method: "POST",
                              url: "<?= base_url() ?>message/add-payment-pembelian/" +
                                        id,
                              success: function(data) {
                                        $("#modal-message").html(data);

                                        $("#modal-add-payment-pembelian").modal(
                                                  "show");
                                        $("#modal-add-payment-pembelian").data(
                                                  "menu",
                                                  "Invoice");
                                        $(".tooltip").remove();

                              },
                              error: function(xhr, textStatus, errorThrown) {

                                        Swal.fire({
                                                  icon: 'error',
                                                  text: xhr["responseJSON"]
                                                            [
                                                                      'message'
                                                            ],
                                                  confirmButtonColor: "#3085d6",
                                        });
                              }
                    });
          }
}


add_invoice_po = function(id, el) {

          window.location = "<?= base_url() ?>admin/sales/invoice/po_add/" + id;
          return;
}

comment_po = function(id, catatan) {
          $("#modal-comment-po").modal("show");
          $("#modal-comment-po").data("id", id);
          $("#PONote").val(catatan);
}

$("#btn-comment-po").click(function(i) {
          $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/change-comment-po/" +
                              $("#modal-comment-po").data("id"),
                    data: {
                              PONote: $("#PONote").val()
                    },
                    success: function(data) {
                              Swal.fire({
                                        title: "Success!",
                                        text: "Catatan Berhasil disimpan",
                                        icon: "success",
                                        confirmButtonColor: "var(--brand)",
                              });
                              table.ajax.reload(null, false);
                              $("#modal-comment-po").modal(
                                        "hide");
                    },
          });
});



var isProcessingInvoicePODelete = [];
delete_po = function(id, el, type) {
          // INSERT LOADER BUTTON
          if (isProcessingInvoicePODelete[id]) {
                    return;
          }
          isProcessingInvoicePODelete[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

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
                                        url: "<?= base_url() ?>action/delete-data-po/" +
                                                  id,
                                        success: function(data) {
                                                  Swal.fire({
                                                            title: "Deleted!",
                                                            text: "Pembelian berhasil dihapus",
                                                            icon: "success",
                                                            confirmButtonColor: "#3085d6",
                                                  });
                                                  table.ajax.reload(null,
                                                            false
                                                  );
                                        },
                              });
                    }
                    isProcessingInvoicePODelete[id] = false;
                    $(el).html(old_text);
          });
};

print_po = function(id, el, type) {
          $("#modal-print-po").modal("show");
          $("#modal-print-po").data("id", id)
};

$("#btn-print-po").click(function(i) {
          $.redirect('<?= base_url("print/project/po/") ?>' + $("#modal-print-po").data("id"), {
                              kertas: $("#POPrintFormat").val(),
                              image: $('input[name="POPrintImage"]:checked').val(),
                              total: $('input[name="POPrintTotal"]:checked').val(),
                              price: $('input[name="POPrintPrice"]:checked').val(),
                    },
                    "GET", '_blank');
          $("#modal-print-po").modal("hide");

})

edit_po = function(id, el) {
          window.location = "<?= base_url() ?>admin/sales/invoice/po_edit/" + id;
          return;
}
                    });
</script>


<div style="margin-bottom: 100px;"></div>


<?php $this->endSection(); ?>