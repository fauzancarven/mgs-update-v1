<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          <h6 class="fw-semibold mb-0">List Penawaran</h6>
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
<div class="card">
          <div class="card-header  d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <!-- BAGIAN FILTER -->
                    <div class="d-none d-sm-flex align-items-center justify-content-end mb-2 gap-2 search-data">
                              <div class="input-group">
                                        <input class="form-control form-control-sm input-form combo"
                                                  id="storedatafilter" placeholder="Pilih Toko" value="" type="text"
                                                  readonly>
                                        <iconify-icon icon="material-symbols-light:storefront-outline"
                                                  class="icon text-lg">
                                        </iconify-icon>
                                        <div class="filter-data left" for="storedatafilter">
                                                  <ul class="list-group">
                                                            <?php
                                                        foreach($store as $row){
                                                            echo '
                                                            <li
                                                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                                                        <div
                                                                                class="form-check style-check d-flex align-items-center">
                                                                                <input class="form-check-input select store"
                                                                                            type="checkbox"
                                                                                            data-group="store"
                                                                                            data-value="'.$row->StoreId.'" value="'.$row->StoreId.'"
                                                                                            id="store-'.$row->StoreId.'">
                                                                                <label class="form-check-label stretched-link"
                                                                                            for="store-'.$row->StoreId.'">
                                                                                            '.$row->StoreCode.'
                                                                                </label>
                                                                        </div>
                                                            </li> ';
                                                        }
                                                        ?>

                                                  </ul>
                                        </div>
                              </div>
                              <div class="input-group d-sm-flex d-none">
                                        <input class="form-control form-control-sm input-form" id="searchdatadate"
                                                  placeholder="Tanggal" value="" type="text" data-start="" data-end=""
                                                  readonly>
                                        <iconify-icon icon="mdi:clipboard-text-date-outline" class="icon text-lg">
                                        </iconify-icon>
                              </div>
                              <div class="input-group">
                                        <input class="form-control form-control-sm input-form combo"
                                                  id="searchdatafilter" placeholder="Status" value="" type="text"
                                                  readonly>

                                        <iconify-icon icon="mdi:timer" class="icon text-lg">
                                        </iconify-icon>
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


                    </div>
                    <div class="d-flex align-items-center justify-content-end mb-2 gap-2 search-data">
                              <div class="icon-field">
                                        <input type="text" name="searchdatasph"
                                                  class="form-control form-control-sm w-auto" placeholder="Search"
                                                  id="searchdatasph">
                                        <span class="icon">
                                                  <iconify-icon icon="ion:search-outline"></iconify-icon>
                                        </span>
                              </div>
                              <a onclick="add_click(this)" class="btn btn-sm btn-primary-600"><i
                                                  class="ri-add-line"></i>
                                        <span class="d-none d-sm-inline-block">Buat Penawaran</span></a>

                    </div>
          </div>

          <div class="card-body py-0 py-4 pb-4" id="table">
                    <table id="data-table-sph" class="table bordered-table">
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
var xhr_load_project;
var filter_status_select = []
var filter_store_select = []

function loader_datatable() {
          // if (xhr_load_project) {
          //     xhr_load_project.abort();
          // }

          // xhr_load_project = $.ajax({ 
          //     dataType: "json",
          //     method: "POST",
          //     url: "<?= base_url()?>datatables/get-data-project/sph", 
          //     data:{  
          //         "search" : $("#searchdatasph").val(), 
          //         "status" : filter_status_select, 
          //         "datestart" : $("#searchdatadate").data("start"),
          //         "dateend" : $("#searchdatadate").data("end"),
          //         "paging" : paging
          //     },
          //     success: function(data) {       
          //         if(data["status"]===true){ 
          //             $("#data-project").html(data["html"])   
          //         }else{
          //             Swal.fire({
          //                 icon: 'error',
          //                 text: data, 
          //                 confirmButtonColor: "var(--brand)", 
          //             });
          //         }  
          //         load_paging_html(data);
          //     },
          //     error : function(xhr, textStatus, errorThrown){   
          //         if (textStatus === 'abort') {
          //             // request AJAX dibatalkan, tidak perlu menampilkan error
          //             return;
          //         }
          //         Swal.fire({
          //             icon: 'error',
          //             text: xhr["responseJSON"]['message'], 
          //             confirmButtonColor: "var(--brand)", 
          //         });
          //     }
          // });
}
load_paging_html = function(data) {
          // paging data
          if (data["total"] == 0) {
                    $("#table-toko_info").html("Tidak ada data yang ditampilkan")
          } else {
                    $("#table-toko_info").html("Tampilkan " + (data["paging"] + 1) + " sampai " + (data[
                              "paging"] + data["totalresult"]) + " dari " + data[
                              "total"] + " data");
          }
          var page = Math.ceil(data["total"] / 10);
          if (page == 0) {
                    paging = 1;
          } else {
                    if (paging > page) load_paging(page)
          }

          var page_html = `    
            <li class="dt-paging-button page-item"><a onclick="load_paging(${1})" class="page-link first" aria-controls="table-toko" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a></li>
            <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == 1 ? paging : paging - 1)})" class="page-link previous" aria-controls="table-toko" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a></li>
        `;

          if (page > 5) {
                    if (paging < 3) {
                              page_html += '<li class="dt-paging-button page-item ' + (paging == 1 ?
                                                  "active" : "") +
                                        '"><a onclick="load_paging(1)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">1</a></li>';
                              page_html += '<li class="dt-paging-button page-item ' + (paging == 2 ?
                                                  "active" : "") +
                                        '"><a onclick="load_paging(2)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">2</a></li>';
                              page_html += '<li class="dt-paging-button page-item ' + (paging == 3 ?
                                                  "active" : "") +
                                        '"><a onclick="load_paging(3)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">3</a></li>';
                    } else if ((paging + 2) > page) {
                              page_html +=
                                        '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
                              page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 2) ?
                                                  "active" : "") + '"><a onclick="load_paging(' + (page - 2) +
                                        ')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">' +
                                        (page - 2) + '</a></li>';
                              page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 1) ?
                                                  "active" : "") + '"><a onclick="load_paging(' + (page - 1) +
                                        ')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">' +
                                        (page - 1) + '</a></li>';
                              page_html += '<li class="dt-paging-button page-item ' + (paging == page ?
                                                  "active" : "") + '"><a onclick="load_paging(' + page +
                                        ')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">' +
                                        page + '</a></li>';
                    } else {
                              page_html +=
                                        '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
                              page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging(' +
                                        (paging - 1) +
                                        ')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">' +
                                        (paging - 1) + '</a></li>';
                              page_html +=
                                        '<li class="dt-paging-button page-item active"><a onclick="load_paging(' +
                                        paging +
                                        ')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">' +
                                        paging + '</a></li>';
                              if (paging !== page) page_html +=
                                        '<li class="dt-paging-button page-item"><a onclick="load_paging(' + (
                                                  paging + 1) +
                                        ')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">' +
                                        (paging + 1) + '</a></li>';
                    }
                    if ((paging + 1) < page) page_html +=
                              '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';

          } else {
                    for (let i = 1; page + 1 > i; i++) {
                              if (paging == i) {
                                        page_html +=
                                                  '<li class="dt-paging-button page-item active"><a onclick="load_paging(' +
                                                  i +
                                                  ')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">' +
                                                  i + '</a></li>';
                              } else {
                                        page_html +=
                                                  '<li class="dt-paging-button page-item"><a onclick="load_paging(' +
                                                  i +
                                                  ')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">' +
                                                  i + '</a></li>';
                              }
                    }
          }

          page_html += `    
            <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == page ? paging : paging + 1)})" class="page-link next" aria-controls="table-toko" aria-disabled="true" aria-label="Next" data-dt-idx="next" tabindex="-1">›</a></li>
            <li class="dt-paging-button page-item"><a onclick="load_paging(${page})" class="page-link last" aria-controls="table-toko" aria-disabled="true" aria-label="Last" data-dt-idx="last" tabindex="-1">»</a></li>
        `;
          $("#paging-data").html(page_html);
}
// FILTER TANGGAL
$('#searchdatadate').daterangepicker({
          autoUpdateInput: false,
          locale: {
                    format: 'DD MMMM YYYY',
                    cancelLabel: 'Reset'
          }
});
$('#searchdatadate').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format(
                    'DD MMM YYYY'));
          $(this).data("start", picker.startDate.format('YYYY/MM/DD'))
          $(this).data("end", picker.endDate.format('YYYY/MM/DD'))
          //loader_datatable(); 
          table.ajax.reload(null, false);
}).on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
          $(this).data("start", "")
          $(this).data("end", "")
          //loader_datatable(); 
          table.ajax.reload(null, false);
});

// FILTER SEARCH
$("#searchdatasph").keyup(function() {
          //loader_datatable(); 
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
$('.form-check-input.select.category').change(function() {
          if ($(this).is(':checked')) {
                    filter_status_select.push($(this).data("value"))
          } else {
                    var index = filter_status_select.indexOf($(this).data("value"));
                    if (index !== -1) {
                              filter_status_select.splice(index, 1);
                    }
          }
          (filter_status_select.length === 0 ? $("#searchdatafilter").val("") : $(
                    "#searchdatafilter").val(String(filter_status_select.length) +
                    " status dipilih"));
          //loader_datatable(); 
          table.ajax.reload(null, false);
})
$('.form-check-input.select.store').change(function() {
          if ($(this).is(':checked')) {
                    filter_store_select.push($(this).data("value"))
          } else {
                    var index = filter_store_select.indexOf($(this).data("value"));
                    if (index !== -1) {
                              filter_store_select.splice(index, 1);
                    }
          }
          (filter_store_select.length === 0 ? $("#storedatafilter").val("") : $("#storedatafilter")
                    .val(String(filter_store_select.length) + " toko dipilih"));
          //loader_datatable(); 
          table.ajax.reload(null, false);
})
var paging = 1;
var table;

// function load_paging(i){
//     paging = i;
//     //loader_datatable(); 
//     table.ajax.reload(null, false);
// }

//loader_datatable();
table = $('#data-table-sph').DataTable({
          "searching": false,
          "lengthChange": false,
          "pageLength": parseInt(10),
          //   responsive: true,
          //   scrollX: false,
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
                    "url": "<?= base_url()?>datatables/get-datatable-penawaran",
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
                              "<div id='scroll-table' style='overflow:auto;  position:relative;max-height:60vh'></div>"
                    );
                    // $('[data-bs-toggle="tooltip"]').tooltip();
                    // console.log($("#scroll-table").width())
                    // $("#scroll-table").on("scroll", function() {

                    //           const scrollX = $(this).scrollX;
                    //           const scrollY = $(this).scrollY;
                    //           console.log(
                    //                     $(this).width(),
                    //                     scrollX
                    //           );

                    //           if (scrollX >
                    //                     0 &&
                    //                     scrollY >
                    //                     0
                    //           ) {
                    //                     console.log(
                    //                               'Scroll X dan Y aktif!'
                    //                     );
                    //           }
                    // })

          },
          "columns": [{
                              data: null,
                              orderable: false,
                              className: "p-0 ps-2",
                              width: "20px",
                              render: function(data, type, row) {
                                        return '<a class="cursor-pointer text-head-3 btn-detail-item"> <iconify-icon icon="material-symbols:arrow-right-rounded" class="icon text-xxl" style="transition: transform 0.3s ease-in-out"> </iconify-icon></a>';
                              }
                    },
                    {
                              data: "action",
                              orderable: false,
                              className: "action-td",
                              width: "60px"
                    },
                    {
                              data: "doc",
                              width: "130px"
                    },
                    {
                              data: "date",
                              width: "100px"
                    },
                    {
                              data: "status",
                              width: "100px"
                    },
                    {
                              data: "admin",
                              width: "150px"
                    },
                    {
                              data: "note",
                              width: "150px",
                              className: "action-td",
                              render: function(data, type, row) {
                                        var html = `<span>${data}</span>
                                    <a onclick="comment(${row.SphId},'${row.note}')"
                                        class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip"  data-bs-title="Ubah Catatan">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>`;
                                        return html;
                              }
                    },
                    {
                              data: "total",
                              width: "150px"
                    },
                    {
                              data: "customer",
                              className: "align-top",
                              //width: "350px",
                              render: function(data, type, row) {
                                        var html =
                                                  ` 
                                                            <div style="max-width: 350px;">
                        <div class="text-head-3 pb-2   text-truncate" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="${row.customer}">${row.customer}</div>
                        ${(row.customertelp !== "" ? `<div class="text-detail-3 text-xs">${row.customertelp}</div>` : "")}
                        <div class="text-detail-3 text-neutral-400 text-truncate text-xxs" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="${row.customeraddress}">${row.customeraddress}</div>
                                                            </div>`;

                                        return html;
                              }
                    },
          ]
});

table.on('draw.dt', function() {
          var info = table.page.info();
          if (info.page + 1 > info.pages && info.pages > 0) {
                    table.page('last').draw('page');
          }
          $('[data-bs-toggle="tooltip"]').tooltip();
});
table.on('click', '.btn-detail-item', function() {
          console.log("btn detail click")
          var tr = $(this).closest('tr');
          tr.toggleClass('tr-child');
          var row = table.row(tr);
          var data = row.data();

          // Tampilkan data nested
          if (row.child.isShown()) {
                    $(tr).next().find('.view-detail').slideUp(500, function() {
                              row.child.hide();
                    });
                    $(this).find('iconify-icon').attr('rotate', "0deg");
          } else {
                    $(this).find('iconify-icon').attr('rotate', "90deg");
                    var childRow = row.child(format(data)).show();
                    $(tr).next().addClass('child-row');
                    $(tr).next().find('td:not(.detail)').addClass('p-0 ps-2');
                    $(tr).next().find('.view-detail').slideDown(500);
                    $(tr).next().find('td').addClass('no-border');

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
          window.location = "<?= base_url() ?>admin/sales/penawaran/add";
          return;
          if (isProcessingSph) {
                    console.log("project Penawaran cancel load");
                    return;
          }
          isProcessingSph = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/add-penawaran",
                    success: function(data) {
                              $("#modal-message").html(data);
                              $("#modal-add-penawaran").modal("show");
                              $("#modal-add-penawaran").data("menu",
                                        "Penawaran");

                              isProcessingSph = false;
                              $(el).html(old_text);
                              tooltiprenew();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingSph = false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "var(--brand)",
                              });
                              tooltiprenew();
                    }
          });
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

          window.location = "<?= base_url() ?>admin/sales/penawaran/edit/" + id;
          return;
          if (isProcessingSphEdit[id]) {
                    console.log("project Penawaran cancel load");
                    return;
          }
          isProcessingSphEdit[id] = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/edit-penawaran/" +
                              id,
                    success: function(data) {
                              $("#modal-message").html(
                                        data);
                              $("#modal-edit-penawaran")
                                        .modal("show");
                              $("#modal-edit-penawaran")
                                        .data("menu",
                                                  "Penawaran"
                                        );

                              isProcessingSphEdit[id] =
                                        false;
                              $(el).html(old_text);
                              tooltiprenew();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingSphEdit[id] =
                                        false;
                              $(el).html(old_text);

                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "var(--brand)",
                              });
                              tooltiprenew();
                    }
          });
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
</script>


<div style="margin-bottom: 100px;"></div>


<?php $this->endSection(); ?>