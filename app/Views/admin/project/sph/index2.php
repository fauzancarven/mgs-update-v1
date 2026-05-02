<?php $this->extend('admin/template/main'); ?>

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
                                        <input type="text" name="#0" class="form-control form-control-sm w-auto"
                                                  placeholder="Search" id="searchdatasph">
                                        <span class="icon">
                                                  <iconify-icon icon="ion:search-outline"></iconify-icon>
                                        </span>
                              </div>
                              <a onclick="add_click(this)" class="btn btn-sm btn-primary-600"><i
                                                  class="ri-add-line"></i>
                                        <span class="d-none d-sm-inline-block">Buat Penawaran</span></a>

                    </div>
          </div>

          <div class="card-body py-0 py-4 pb-4">
                    <table class="table bordered-table mt-4">
                              <thead>
                                        <tr>
                                                  <th scope="col"></th>
                                                  <th scope="col">Document</th>
                                                  <th scope="col">Tanggal</th>
                                                  <th scope="col">Status</th>
                                                  <th scope="col">Admin</th>
                                                  <th scope="col">Customer</th>
                                                  <th scope="col">Grand Total</th>
                                                  <th scope="col"> </th>
                                        </tr>
                              </thead>
                              <tbody>
                                        <tr>
                                                  <td class="p-0 ps-2"><a
                                                                      class="cursor-pointer text-head-3 btn-detail-item">
                                                                      <iconify-icon
                                                                                icon="material-symbols:arrow-right-rounded"
                                                                                inline="" class="icon text-xxl"
                                                                                style="transition: transform 0.3s ease-in-out">
                                                                      </iconify-icon>
                                                            </a></td>
                                                  <td>
                                                            <div class="d-flex flex-column">
                                                                      <span
                                                                                class="text-head-3 d-flex gap-0 align-items-center"><img
                                                                                          src="data:image/png;base64,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"
                                                                                          alt="Gambar" class="logo">MGS
                                                                                ME</span>
                                                                      <span
                                                                                class="text-detail-3 text-wrap overflow-none pt-1 ps-1 text-default d-none">
                                                                                <iconify-icon
                                                                                          icon="cuida:subtask-outline"
                                                                                          class="menu-icon">
                                                                                </iconify-icon>
                                                                                Document Project
                                                                      </span>
                                                            </div>

                                                            <div class="text-neutral-400 text-head-3"
                                                                      style="line-height:1">SPH/001/03/2026</div>
                                                  </td>
                                                  <td>
                                                            <div class="text-head-3" style="line-height:1">24 Mar
                                                                      2026</div>
                                                            <div class="text-danger-600 text-xxs"><span class="me-1"><i
                                                                                          class="ri-calendar-schedule-fill me-1"></i>Exp
                                                                                : 11 hari lagi</span></div>
                                                  </td>
                                                  <td>
                                                            <span class="bg-info-focus text-info-main  px-16 py-2 rounded-pill fw-medium text-xs dropend dropdown-toggle"
                                                                      data-bs-toggle="dropdown" aria-expanded="false"
                                                                      data-bs-placement="top"
                                                                      data-bs-custom-class="custom-tooltip"
                                                                      data-bs-html="true" data-bs-title="Update Status">
                                                                      <span class="me-1 ">New</span>
                                                            </span>
                                                            <ul class="dropdown-menu shadow drop-status ">
                                                                      <li>
                                                                                <a class="dropdown-item m-0 px-2"
                                                                                          onclick="update_status(0,190,this)">
                                                                                          New
                                                                                </a>
                                                                      </li>
                                                                      <li>
                                                                                <a class="dropdown-item m-0 px-2"
                                                                                          onclick="update_status(1,190,this)">
                                                                                          Proses
                                                                                </a>
                                                                      </li>
                                                                      <li>
                                                                                <a class="dropdown-item m-0 px-2"
                                                                                          onclick="update_status(2,190,this)">
                                                                                          Completed
                                                                                </a>
                                                                      </li>
                                                                      <li>
                                                                                <a class="dropdown-item m-0 px-2"
                                                                                          onclick="update_status(3,190,this)">
                                                                                          Cancel
                                                                                </a>
                                                                      </li>
                                                            </ul>
                                                  </td>
                                                  <td>Erwin Brachmana</td>
                                                  <td class="align-top">
                                                            <div style="max-width: 350px;">
                                                                      <div class="text-head-3 pb-2 text-truncate"
                                                                                style="max-width: 250px;line-height: 1.2;"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-title="Test">Test
                                                                      </div>
                                                                      <div
                                                                                class="text-detail-3 text-neutral-400 text-xxs">
                                                                                081310154883</div>
                                                                      <div class="text-detail-3 text-neutral-400 text-truncate text-xxs"
                                                                                style=" line-height: 1.2;"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-title="Project KAB. Banyumas DESA KARANGCEGAK, Koramil Sumbang, Ganyongan, Sumbang Kec.Banyumas">
                                                                                Project KAB. Banyumas
                                                                                DESA KARANGCEGAK, Koramil Sumbang,
                                                                                Ganyongan,
                                                                                Sumbang Kec.Banyumas
                                                                      </div>
                                                            </div>
                                                  </td>
                                                  <td>
                                                            <div class="d-flex"><span>Rp.</span><span
                                                                                class="flex-fill text-end">10,000</span>
                                                            </div>
                                                  </td>

                                                  <td class="action-td">
                                                            <div
                                                                      class="d-flex align-items-center gap-1 justify-content-center">
                                                                      <a onclick="print_sph(190,this,'')"
                                                                                class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                                                <iconify-icon
                                                                                          icon="hugeicons:invoice-03">
                                                                                </iconify-icon>
                                                                      </a>
                                                                      <a onclick="print_sph(190,this,'')"
                                                                                class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                                                <iconify-icon icon="lucide:printer">
                                                                                </iconify-icon>
                                                                      </a>
                                                                      <a onclick="edit_sph(190,this,'')"
                                                                                class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                                                <iconify-icon icon="lucide:edit">
                                                                                </iconify-icon>
                                                                      </a>
                                                                      <a onclick="delete_sph(190,this,'')"
                                                                                class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                                                <iconify-icon icon="lucide:x">
                                                                                </iconify-icon>
                                                                      </a>
                                                            </div>
                                                  </td>
                                        </tr>
                              </tbody>
                    </table>
                    <!-- <div class="table-responsive scroll-sm"> -->
                    <table id="data-table-sph" class="table bordered-table d-none mb-16">
                              <thead>
                                        <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Action</th>
                                                  <th scope="col">Document</th>
                                                  <th scope="col">Tanggal</th>
                                                  <th scope="col">Status</th>
                                                  <th scope="col">Admin</th>
                                                  <th scope="col">Customer</th>
                                                  <th scope="col">Grand Total</th>
                                        </tr>
                              </thead>
                              <tbody>
                              </tbody>
                    </table>
                    <!-- </div> -->
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
                                                  <label class="form-label mb-0 col-sm-4">gunakan
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
                                                  <label class="form-label mb-0 col-sm-4">gunakan
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
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary" id="btn-print-sph">Print</button>
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
          scrollX: false,
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
                              "<div id='scroll-table' style='overflow:auto; width:100%;position:relative;max-height:60vh'></div>"
                    );
                    $('[data-bs-toggle="tooltip"]').tooltip();
                    console.log($("#scroll-table").width())
                    $("#scroll-table").on("scroll", function() {

                              const scrollX = $(this).scrollX;
                              const scrollY = $(this).scrollY;
                              console.log(
                                        $(this).width(),
                                        scrollX
                              );

                              if (scrollX >
                                        0 &&
                                        scrollY >
                                        0
                              ) {
                                        console.log(
                                                  'Scroll X dan Y aktif!'
                                        );
                              }
                    })

          },
          "columns": [{
                              data: null,
                              orderable: false,
                              className: "p-0 ps-2",
                              width: "20px",
                              render: function(data, type, row) {
                                        return '<a class="cursor-pointer text-head-3 btn-detail-item"> <iconify-icon icon="material-symbols:chevron-right-rounded" class="icon text-xxl"> </iconify-icon></a>';
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
                              className: "align-top",
                              width: "150px"
                    },
                    {
                              data: "date",
                              className: "align-top",
                              width: "130px"
                    },
                    {
                              data: "status",
                              className: "text-center",
                              width: "100px"
                    },
                    {
                              data: "admin",
                              className: "align-top",
                              width: "150px"
                    },
                    {
                              data: "customer",
                              className: "align-top",
                              //width: "350px",
                              render: function(data, type, row) {
                                        var html =
                                                  ` 
                        <div class="text-head-3 pb-2 text-truncate" style="max-width: 250px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="${row.customer}">${row.customer}</div>
                        ${(row.customertelp !== "" ? `<div class="text-detail-3 text-xs">${row.customertelp}</div>` : "")}
                        <div class="text-detail-3 text-truncate text-xs" style="max-width: 250px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="${row.customeraddress}">${row.customeraddress}</div>`;

                                        return html;
                              }
                    },
                    {
                              data: "total",
                              className: "align-top",
                              width: "150px"
                    },
          ]
});

table.on('draw.dt', function() {
          var info = table.page.info();
          if (info.page + 1 > info.pages && info.pages > 0) {
                    table.page('last').draw('page');
          }
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
                              date: moment().format('DDMMYYYYHHmmss'),
                    },
                    "GET", '_blank');
          $("#modal-print-penawaran").modal("hide");
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