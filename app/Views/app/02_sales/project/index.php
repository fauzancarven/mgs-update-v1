<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          <h6 class="fw-semibold mb-0">List Project</h6>
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
                    <li class="fw-medium"> <a href="<?= base_url() ?>admin/sales/project"
                                        class="d-flex align-items-center gap-1 hover-text-primary">
                                        <iconify-icon icon="cuida:subtask-outline" class="icon text-lg">
                                        </iconify-icon>
                                        List Project
                              </a>
                    </li>
          </ul>
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
                                                                                          id="status-0" checked>
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
                                                                                          id="status-1" checked>
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
                                                  placeholder="Search" id="searchdatainvoice">
                                        <span class="icon">
                                                  <iconify-icon icon="ion:search-outline"></iconify-icon>
                                        </span>
                              </div>
                              <a onclick="add_click(this)" class="btn btn-sm btn-primary-600"><i
                                                  class="ri-add-line"></i>
                                        <span class="d-none d-sm-inline-block">Buat Project</span></a>

                    </div>
          </div>

          <div class="card-body py-0 py-4 pb-4" id="table">
                    <table id="data-table-invoice" class="table bordered-table " style="width:97%">
                              <thead>
                                        <tr>
                                                  <th scope="col"></th>
                                                  <th scope="col"></th>
                                                  <th scope="col">Store</th>
                                                  <th scope="col">Nama Project</th>
                                                  <th scope="col">Tanggal</th> 
                                                  <th scope="col">Status</th> 
                                                  <th scope="col">Catatan</th> 
                                        </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><span class="text-head-3 d-flex gap-0 align-items-center"><img src="data:image/png;base64,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" alt="Gambar" class="logo">SENTRA</span></td>
                                    <td><div class="text-head-3" style="line-height:1">Project UI Depok</div></td>
                                    <td><div class="text-head-3" style="line-height:1">24 Agustus 2026 -> 15 September 2026</div></td> 
                                    <td>
                                                <button class="bg-lilac-100 text-lilac-600 px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="me-1 " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">Proses</span>
                                                </button>   
                                        <ul class="dropdown-menu shadow drop-status ">
                                            <li>
                                                <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(0,264,this)">
                                                    New
                                                </a>
                                            </li> 
                                            <li>
                                                <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(1,264,this)">
                                                    Proses
                                                </a>
                                            </li> 
                                            <li>
                                                <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(2,264,this)">
                                                    Completed
                                                </a>
                                            </li> 
                                            <li>
                                                <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(3,264,this)">
                                                    Cancel
                                                </a>
                                            </li>  
                                        </ul></td>
                                    <td class="action-td"><span>jadwal pengiriman estimasi rabu 03 sept 2026</span>
                                    <a onclick="comment(264,'jadwal pengiriman estimasi rabu 03 sept 2026')" class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-title="Ubah Catatan">
                                        <iconify-icon icon="lucide:edit"><template shadowrootmode="open"><style data-style="data-style">:host{display:inline-block;vertical-align:0}span,svg{display:block}</style><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path></g></svg></template></iconify-icon>
                                    </a></td>
                                </tr>
                              </tbody>
                    </table>
          </div>
</div>


<div style="margin-bottom: 100px;"></div>


<?php $this->endSection(); ?>