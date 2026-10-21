<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          <h6 class="fw-semibold mb-0 d-flex align-items-center">
                    <a href="<?= base_url() ?>admin/sales/invoice" class=" pe-3 d-inline-block" id="btn-back-page">
                              <iconify-icon icon="iconoir:arrow-left" class="icon  ">
                              </iconify-icon>
                    </a>Tambah Invoice
          </h6>
          <ul class="d-flex align-items-center gap-2 flex-wrap">
                    <li class="fw-medium ">
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

<div class="row gy-4">
          <div class="col-md-6">
                    <div class="card">
                              <div class="card-header">
                                        <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                                                  <iconify-icon icon="mdi:file-document" class="menu-icon">
                                                  </iconify-icon>Dokumen
                                        </h6>
                              </div>
                              <div class="card-body">
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Project</label>
                                                  <div class="col-sm-10">
                                                            <select class="form-select form-select-sm"
                                                                      style="width:100%" id="ProjectId"></select>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Referensi</label>
                                                  <div class="col-sm-10">
                                                            <select class="form-select form-select-sm" id="InvRef"
                                                                      name="InvRef" style="width:100%">
                                                                      <option value="0" selected data-type="-">Tidak ada
                                                                                yang dipilih</option>
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Store</label>
                                                  <div class="col-sm-10">
                                                            <select class="form-select form-select-sm"
                                                                      style="width:100%" id="StoreId">
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Tanggal</label>
                                                  <div class="col-sm-10">
                                                            <input type="text" id="InvDate"
                                                                      class="form-control form-control-sm"
                                                                      placeholder="Enter First Name">
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Admin</label>
                                                  <div class="col-sm-10">
                                                            <select class="form-select form-select-sm"
                                                                      style="width:100%" id="InvAdmin">
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Alamat Project</label>
                                                  <div class="col-sm-10">
                                                            <textarea id="InvProjectAddress" class="form-control"
                                                                      rows="4" cols="50"
                                                                      placeholder="Masukan alamat project"></textarea>
                                                  </div>
                                        </div>
                              </div>
                    </div>
          </div>
          <div class="col-md-6">
                    <div class="card">
                              <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                                  <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                                                            <iconify-icon
                                                                      icon="material-symbols-light:article-person-outline"
                                                                      class="menu-icon"></iconify-icon>Pelanggan
                                                  </h6>
                                                  <button type="button" onclick="customer_add()"
                                                            class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                                                            <iconify-icon icon="ic:add" class="text-xl">
                                                            </iconify-icon>
                                                            Tambah
                                                  </button>
                                        </div>
                              </div>
                              <div class="card-body">
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Pelanggan</label>
                                                  <div class="col-sm-10">
                                                            <select class="form-select form-select-sm"
                                                                      style="width:100%" id="CustomerId">
                                                            </select>
                                                  </div>
                                        </div>

                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Nama</label>
                                                  <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-sm"
                                                                      id="InvCustName" readonly>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Telp</label>
                                                  <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-sm"
                                                                      id="InvCustTelp" readonly>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Alamat</label>
                                                  <div class="col-sm-10">
                                                            <textarea name="#0" class="form-control" rows="4" cols="50"
                                                                      id="InvAddress" readonly></textarea>
                                                  </div>
                                        </div>
                              </div>
                    </div>
          </div>
          <div class="col-lg-12">
                    <div class="card">
                              <div class="card-header">
                                        <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                                                  <iconify-icon icon="ix:box-closed" class="menu-icon">
                                                  </iconify-icon>Detail Produk
                                        </h6>
                              </div>
                              <div id="table-list"></div>
                    </div>
          </div>
          <div class="col-md-7">
                    <div class="card template-footer">
                              <div class="card-header">
                                        <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                                                  <iconify-icon icon="mdi:file-sign" class="menu-icon">
                                                  </iconify-icon>Term & Condition
                                        </h6>
                              </div>
                              <div class="card-body">
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <div class="col-7">
                                                            <select class="form-select form-select-sm"
                                                                      style="width:100%" id="InvTemplate">
                                                            </select>
                                                  </div>

                                                  <div class="col-5">
                                                            <a type="button"
                                                                      class="btn btn-sm btn-primary-600 radius-8 px-8 py-8  "
                                                                      aria-pressed="false" value="simpan"
                                                                      aria-label="name: simpan"><i
                                                                                class="ri-save-line pe-2"></i>Save</a>
                                                            <a type="button"
                                                                      class="btn btn-sm btn-primary-600 radius-8 px-8 py-8 "
                                                                      aria-pressed="false" value="simpanAs"
                                                                      aria-label="name: simpan As"><i
                                                                                class="ri-save-line pe-2"></i>Save
                                                                      AS
                                                            </a>
                                                            <a type="button"
                                                                      class="btn btn-sm btn-primary-600 radius-8 px-8 py-8  "
                                                                      aria-pressed="false" value="edit"
                                                                      aria-label="name: edit"><i
                                                                                class="ri-edit-line pe-2"></i>Edit</a>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <div class="col-12">
                                                            <div name="EditFooterMessage" class="border">
                                                            </div>
                                                  </div>
                                        </div>
                              </div>
                    </div>
          </div>
          <div class="col-md-5">
                    <div class="card">
                              <div class="card-body">
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-4">Sub Total
                                                  </label>
                                                  <div class="col-sm-8">
                                                            <div class="input-group">
                                                                      <span class="input-group-text bg-base">
                                                                                Rp.
                                                                      </span>
                                                                      <input type="text" class="form-control"
                                                                                id="InvSubTotal" value="0" readonly>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-4">Disc Item Total
                                                  </label>
                                                  <div class="col-sm-8">
                                                            <div class="input-group">
                                                                      <span class="input-group-text bg-base">
                                                                                Rp.
                                                                      </span>
                                                                      <input type="text" class="form-control"
                                                                                id="InvDiscItemTotal" value="0"
                                                                                readonly>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-4">Disc Total
                                                  </label>
                                                  <div class="col-sm-8">
                                                            <div class="input-group">
                                                                      <span class="input-group-text bg-base">
                                                                                Rp.
                                                                      </span>
                                                                      <input type="text" class="form-control"
                                                                                id="InvDiscTotal" value="0">
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <div
                                                            class="form-check style-check d-flex align-items-center col-sm-4">
                                                            <input class="form-check-input ms-10" type="checkbox"
                                                                      value="" id="InvDelivery">
                                                            <label class="form-check-label" for="InvDelivery">
                                                                      Pengiriman
                                                            </label>
                                                  </div>
                                                  <div class="col-sm-8">
                                                            <div class="input-group">
                                                                      <span class="input-group-text bg-base">
                                                                                Rp.
                                                                      </span>
                                                                      <input type="text" class="form-control"
                                                                                id="InvDeliveryTotal" value="0"
                                                                                readonly>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-4">Grand Total</label>
                                                  <div class="col-sm-8">
                                                            <div class="input-group">
                                                                      <span class="input-group-text bg-base">
                                                                                Rp.
                                                                      </span>
                                                                      <input type="text" class="form-control"
                                                                                id="InvGrandTotal" value="0" readonly>
                                                            </div>
                                                  </div>
                                        </div>
                              </div>
                    </div>
          </div>

          <!-- OPTIONAL -->
          <div class="col-lg-12">
                    <div class="card">
                              <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                                  <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                                                            <iconify-icon icon="mdi:attach-file" class="menu-icon">
                                                            </iconify-icon>Lampiran (optional)
                                                  </h6>
                                        </div>
                              </div>
                              <div class="card-body">
                                        <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
                                                  <div class="uploaded-imgs-container d-flex gap-3 flex-wrap"></div>

                                                  <label class="upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                                                            for="upload-file-multiple">
                                                            <iconify-icon icon="solar:camera-outline"
                                                                      class="text-xl text-secondary-light">
                                                            </iconify-icon>
                                                            <span class="fw-semibold text-secondary-light">Upload</span>
                                                            <input id="upload-file-multiple" type="file"
                                                                      accept="image/*" hidden="" multiple="">
                                                  </label>
                                        </div>
                              </div>
                    </div>
          </div>
          <div class="col-md-6">
                    <div class="card">
                              <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                                  <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                                                            <iconify-icon icon="mdi:card-account-details-outline"
                                                                      class="menu-icon">
                                                            </iconify-icon>KTP (optional)
                                                  </h6>
                                                  <a type="button"
                                                            class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1"
                                                            id="btn-ktp">
                                                            <iconify-icon icon="mdi:attach-file" class="text-xl">
                                                            </iconify-icon>
                                                            Upload
                                                  </a>
                                        </div>
                              </div>
                              <div class="card-body">
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <div class="col-12">
                                                            <select class="form-select form-select-sm"
                                                                      style="width:100%" id="select-ktp">
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <div class="col-12">
                                                            <div id="preview-ktp" class="border p-md-4 p-2  text-center"
                                                                      style="min-height:50px;">
                                                            </div>
                                                  </div>
                                        </div>
                              </div>
                    </div>
          </div>
          <div class="col-md-6">
                    <div class="card">
                              <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                                  <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                                                            <iconify-icon icon="mdi:card-account-details-outline"
                                                                      class="menu-icon">
                                                            </iconify-icon>NPWP (optional)
                                                  </h6>
                                                  <a type="button"
                                                            class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1"
                                                            id="btn-npwp">
                                                            <iconify-icon icon="mdi:attach-file" class="text-xl">
                                                            </iconify-icon>
                                                            Upload
                                                  </a>
                                        </div>
                              </div>
                              <div class="card-body">
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <div class="col-12">
                                                            <select class="form-select form-select-sm"
                                                                      style="width:100%" id="select-npwp">
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <div class="col-12">
                                                            <div id="preview-npwp"
                                                                      class="border p-md-4 p-2  text-center"
                                                                      style="min-height:50px;">
                                                            </div>
                                                  </div>
                                        </div>
                              </div>
                    </div>
          </div>


          <div class="col-lg-12">
                    <div id="action-button-doc">
                              <div class="card">
                                        <div class="card-body">
                                                  <div class="d-flex align-items-center justify-content-end gap-3">
                                                            <a href="<?= base_url()?>admin/sales/invoice"
                                                                      class="btn btn-sm border border-danger-600 bg-hover-danger-200 text-danger-600 radius-8 d-inline-flex align-items-center gap-1">
                                                                      <iconify-icon icon="simple-line-icons:close"
                                                                                class="text-xl">
                                                                      </iconify-icon>
                                                                      Batalkan
                                                            </a>
                                                            <button type="button" id="btn-add-invoice"
                                                                      class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                                                                      <iconify-icon icon="simple-line-icons:check"
                                                                                class="text-xl">
                                                                      </iconify-icon>
                                                                      Simpan
                                                            </button>
                                                  </div>
                                        </div>
                              </div>
                    </div>
          </div>
</div>

<script>
$(document).ready(function() {
          // =============================== Upload Single Image js start here ================================================
          const fileInput = document.getElementById("upload-file");
          const imagePreview = document.getElementById("uploaded-img__preview");
          const uploadedImgContainer = document.querySelector(".uploaded-img");
          const removeButton = document.querySelector(".uploaded-img__remove");

          $(fileInput).on("change", (e) => {
                    if (e.target.files.length) {
                              const src = URL.createObjectURL(e.target.files[
                                        0]);
                              imagePreview.src = src;
                              uploadedImgContainer.classList.remove('d-none');
                    }
          });
          $(removeButton).on("click", () => {
                    imagePreview.src = "";
                    uploadedImgContainer.classList.add('d-none');
                    fileInput.value = "";
          });
          // =============================== Upload Single Image js End here ================================================

          // ================================================ Upload Multiple image js Start here ================================================
          const fileInputMultiple = document.getElementById("upload-file-multiple");
          const uploadedImgsContainer = document.querySelector(".uploaded-imgs-container");

          fileInputMultiple.addEventListener("change", (e) => {
                    const files = e.target.files;

                    Array.from(files).forEach(file => {
                              const src = URL
                                        .createObjectURL(
                                                  file);

                              const imgContainer = document
                                        .createElement(
                                                  'div');
                              imgContainer.classList.add(
                                        'position-relative',
                                        'h-120-px',
                                        'w-120-px',
                                        'border',
                                        'input-form-light',
                                        'radius-8',
                                        'overflow-hidden',
                                        'border-dashed',
                                        'bg-neutral-50'
                              );

                              const removeButton = document
                                        .createElement(
                                                  'button');
                              removeButton.type = 'button';
                              removeButton.classList.add(
                                        'uploaded-img__remove',
                                        'position-absolute',
                                        'top-0',
                                        'end-0',
                                        'z-1',
                                        'text-2xxl',
                                        'line-height-1',
                                        'me-8',
                                        'mt-8',
                                        'd-flex');
                              removeButton.innerHTML =
                                        '<iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>';

                              const imagePreview = document
                                        .createElement(
                                                  'img');
                              imagePreview.classList.add(
                                        'w-100',
                                        'h-100',
                                        'object-fit-cover'
                              );
                              imagePreview.src = src;

                              imgContainer.appendChild(
                                        removeButton
                              );
                              imgContainer.appendChild(
                                        imagePreview
                              );
                              uploadedImgsContainer
                                        .appendChild(
                                                  imgContainer
                                        );

                              removeButton.addEventListener(
                                        'click',
                                        () => {
                                                  URL.revokeObjectURL(
                                                            src
                                                  );
                                                  imgContainer
                                                            .remove();
                                        });
                    });

                    // Clear the file input so the same file(s) can be uploaded again if needed
                    fileInputMultiple.value = '';
          });
          // ================================================ Upload Multiple image js End here  ================================================
          var $elemenBawah = $('#action-button-doc');
          var offsetTop = $('#action-button-doc').offset().top;
          if ($(window).height() < offsetTop) {
                    $elemenBawah.addClass('sticky');
          }
          $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() >=
                              offsetTop) {
                              $elemenBawah.removeClass('sticky');
                    } else {
                              $elemenBawah.addClass('sticky');
                    }
          });

});
// ================================================ Upload image & show it's name js end ================================================
</script>
<!-- 
<div class="modal fade" id="modal-add-invoice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"
          aria-labelledby="modal-add-invoice-label" style="overflow-y:auto;" data-menu="project">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h2 class="modal-title fs-5 fw-bold" id="modal-add-invoice-label">Buat
                                                  Invoice
                                        </h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                        <div class="row">
                                                  <div class="col-lg-6 col-12 my-1 mb-2 ">
                                                            <div class="row mx-2 align-items-center mb-3 mb-md-1">
                                                                      <div class="label-border-right">
                                                                                <span
                                                                                          class="label-dialog">Customer</span>
                                                                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill"
                                                                                          type="button"
                                                                                          style="position:absolute;top: -11px;right: 10px;font-size: 0.6rem;"
                                                                                          onclick="togglecustom('customer-display',this)">
                                                                                          <span>Sembunyikan</span>
                                                                                          <i
                                                                                                    class="fa-solid fa-angle-up"></i>
                                                                                </button>
                                                                      </div>
                                                            </div>
                                                            <div
                                                                      class="customer-display card bg-light show mt-4 m-1 p-2">

                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="CustomerId"
                                                                                          class="col-sm-3 col-form-label">Customer</label>
                                                                                <div class="col-sm-9">
                                                                                          <div
                                                                                                    class="input-group input-group-sm">
                                                                                                    <select class="form-control form-control-sm"
                                                                                                              id="CustomerId"
                                                                                                              name="CustomerId"
                                                                                                              style="width:90%"></select>
                                                                                                    <button class="btn btn-primary btn-sm"
                                                                                                              type="button"
                                                                                                              style="width:10%"
                                                                                                              onclick="customer_add()">
                                                                                                              <i
                                                                                                                        class="ti-plus"></i>
                                                                                                    </button>
                                                                                          </div>
                                                                                </div>
                                                                      </div>
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="InvAddress"
                                                                                          class="col-sm-3 col-form-label">Nama
                                                                                          Customer</label>
                                                                                <div class="col-sm-9">
                                                                                          <input class="form-control form-control-sm input-form"
                                                                                                    id="InvCustName"
                                                                                                    type="text"
                                                                                                    value="" />
                                                                                </div>
                                                                      </div>
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="InvAddress"
                                                                                          class="col-sm-3 col-form-label">Telp
                                                                                          Customer</label>
                                                                                <div class="col-sm-9">
                                                                                          <input class="form-control form-control-sm input-form"
                                                                                                    id="InvCustTelp"
                                                                                                    type="text"
                                                                                                    value="" />
                                                                                </div>
                                                                      </div>
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="InvAddress"
                                                                                          class="col-sm-3 col-form-label">Alamat
                                                                                          Project</label>
                                                                                <div class="col-sm-9">
                                                                                          <textarea class="form-control form-control-sm input-form"
                                                                                                    id="InvAddress"></textarea>
                                                                                </div>
                                                                      </div>
                                                            </div>
                                                  </div>
                                                  <div class="col-lg-6 col-12 my-1 mb-3 mb-md-1">
                                                            <div class="row mx-2 align-items-center">
                                                                      <div class="label-border-right">
                                                                                <span
                                                                                          class="label-dialog">Document</span>
                                                                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill"
                                                                                          type="button"
                                                                                          style="position:absolute;top: -11px;right: 10px;font-size: 0.6rem;"
                                                                                          onclick="togglecustom('document-display',this)">
                                                                                          <span>Sembunyikan</span>
                                                                                          <i
                                                                                                    class="fa-solid fa-angle-up"></i>
                                                                                </button>
                                                                      </div>
                                                            </div>
                                                            <div
                                                                      class="document-display card bg-light show mt-4 m-1 p-2">
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="InvCode"
                                                                                          class="col-sm-2 col-form-label">Kode<sup
                                                                                                    class="error">&nbsp;*</sup></label>
                                                                                <div class="col-sm-10">
                                                                                          <input id="InvCode"
                                                                                                    name="InvCode"
                                                                                                    type="text"
                                                                                                    class="form-control form-control-sm input-form"
                                                                                                    value="(auto)"
                                                                                                    disabled>
                                                                                </div>
                                                                      </div>
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="ProjectId"
                                                                                          class="col-sm-2 col-form-label">Project</label>
                                                                                <div class="col-sm-10">
                                                                                          <select class="form-select form-select-sm"
                                                                                                    style="width:100%"
                                                                                                    id="ProjectId"></select>
                                                                                </div>
                                                                      </div>
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="StoreId"
                                                                                          class="col-sm-2 col-form-label">Toko</label>
                                                                                <div class="col-sm-10">
                                                                                          <select class="form-select form-select-sm"
                                                                                                    style="width:100%"
                                                                                                    id="StoreId"></select>
                                                                                </div>
                                                                      </div>
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="InvRef"
                                                                                          class="col-sm-2 col-form-label">Ref</label>
                                                                                <div class="col-sm-10">
                                                                                          <select class="form-select form-select-sm"
                                                                                                    id="InvRef"
                                                                                                    name="InvRef"
                                                                                                    style="width:100%">
                                                                                                    <option value="0"
                                                                                                              selected
                                                                                                              data-type="-">
                                                                                                              No
                                                                                                              Data
                                                                                                              Selected
                                                                                                    </option>
                                                                                          </select>
                                                                                </div>
                                                                      </div>
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="InvDate"
                                                                                          class="col-sm-2 col-form-label">Tanggal</label>
                                                                                <div class="col-sm-10">
                                                                                          <input id="InvDate"
                                                                                                    name="InvDate"
                                                                                                    type="text"
                                                                                                    class="form-control form-control-sm input-form"
                                                                                                    value="">
                                                                                </div>
                                                                      </div>
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="InvAdmin"
                                                                                          class="col-sm-2 col-form-label">Admin</label>
                                                                                <div class="col-sm-10">
                                                                                          <select class="form-select form-select-sm"
                                                                                                    id="InvAdmin"
                                                                                                    name="InvAdmin"
                                                                                                    placeholder="Pilih Admin"
                                                                                                    style="width:100%"></select>
                                                                                </div>
                                                                      </div>
                                                                      <div class="row mb-1 align-items-center">
                                                                                <label for="InvDelivery"
                                                                                          class="col-sm-2 col-form-label">Pengiriman</label>
                                                                                <div class="col-sm-10">
                                                                                          <div
                                                                                                    class="form-check form-check-inline">
                                                                                                    <input class="form-check-input"
                                                                                                              type="radio"
                                                                                                              name="InvDelivery"
                                                                                                              id="InvDelivery1"
                                                                                                              value="0"
                                                                                                              checked>
                                                                                                    <label class="text-detail"
                                                                                                              for="InvDelivery1">Tidak</label>
                                                                                          </div>
                                                                                          <div
                                                                                                    class="form-check form-check-inline">
                                                                                                    <input class="form-check-input"
                                                                                                              type="radio"
                                                                                                              name="InvDelivery"
                                                                                                              id="InvDelivery2"
                                                                                                              value="1">
                                                                                                    <label class="text-detail"
                                                                                                              for="InvDelivery2">Ya</label>
                                                                                          </div>
                                                                                </div>
                                                                      </div>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mx-2 my-3 align-items-center">
                                                  <div class="label-border-right position-relative">
                                                            <span class="label-dialog">Detail Produk</span>
                                                  </div>
                                        </div>
                                        <div id="table-list">
                                        </div>
                                        <div class="row">
                                                  <div class="col-12 col-md-4 px-3 order-1 order-md-2">
                                                            <div class="row align-items-center py-1 mt-3">
                                                                      <div class="col-4">
                                                                                <span class="label-head-dialog">Sub
                                                                                          Total</span>
                                                                      </div>
                                                                      <div class="col-8">
                                                                                <div class="input-group">
                                                                                          <span
                                                                                                    class="input-group-text font-std">Rp.</span>
                                                                                          <input type="text"
                                                                                                    class="form-control form-control-sm  input-form d-inline-block hargajual"
                                                                                                    disabled value="0"
                                                                                                    id="InvSubTotal">
                                                                                </div>
                                                                      </div>
                                                            </div>
                                                            <div class="row align-items-center py-1">
                                                                      <div class="col-4">
                                                                                <span class="label-head-dialog">Disc
                                                                                          Item Total</span>
                                                                      </div>
                                                                      <div class="col-8">
                                                                                <div class="input-group">
                                                                                          <span
                                                                                                    class="input-group-text font-std">Rp.</span>
                                                                                          <input type="text"
                                                                                                    class="form-control form-control-sm  input-form d-inline-block hargajual"
                                                                                                    disabled
                                                                                                    id="InvDiscItemTotal"
                                                                                                    value="0">
                                                                                </div>
                                                                      </div>
                                                            </div>
                                                            <div class="row align-items-center py-1">
                                                                      <div class="col-4">
                                                                                <span class="label-head-dialog">Disc
                                                                                          Total</span>
                                                                      </div>
                                                                      <div class="col-8">
                                                                                <div class="input-group">
                                                                                          <span
                                                                                                    class="input-group-text font-std">Rp.</span>
                                                                                          <input type="text"
                                                                                                    class="form-control form-control-sm  input-form d-inline-block hargajual"
                                                                                                    id="InvDiscTotal"
                                                                                                    value="0">
                                                                                </div>
                                                                      </div>
                                                            </div>
                                                            <div class="row align-items-center py-1">
                                                                      <div class="col-4">
                                                                                <span
                                                                                          class="label-head-dialog">Pengiriman</span>
                                                                      </div>
                                                                      <div class="col-8">
                                                                                <div class="input-group">
                                                                                          <span
                                                                                                    class="input-group-text font-std">Rp.</span>
                                                                                          <input type="text"
                                                                                                    class="form-control form-control-sm  input-form d-inline-block hargajual"
                                                                                                    id="InvDeliveryTotal"
                                                                                                    value="0" disabled>
                                                                                </div>
                                                                      </div>
                                                            </div>
                                                            <div class="row align-items-center py-1">
                                                                      <div class="col-4">
                                                                                <span class="label-head-dialog">Grand
                                                                                          Total</span>
                                                                      </div>
                                                                      <div class="col-8">
                                                                                <div class="input-group">
                                                                                          <span
                                                                                                    class="input-group-text font-std">Rp.</span>
                                                                                          <input type="text"
                                                                                                    class="form-control form-control-sm  input-form hargajual"
                                                                                                    disabled value="0"
                                                                                                    id="InvGrandTotal">
                                                                                </div>
                                                                      </div>
                                                            </div>
                                                  </div>
                                        </div>

                                        <div class="row mx-2 my-3 align-items-center">
                                                  <div class="label-border-right position-relative">
                                                            <span class="label-dialog">Lampiran Gambar</span>
                                                  </div>
                                        </div>
                                        <div class="row p-2">
                                                  <input type="file" class="d-none" accept="image/*" id="upload-produk">
                                                  <div class="col-sm-12 d-flex flex-wrap">
                                                            <div class="d-flex flex-wrap">
                                                                      <div class="d-flex flex-wrap" id="list-produk">
                                                                      </div>
                                                                      <div class="image-default-obi" id="img-produk">
                                                                                <i class="ti-image"
                                                                                          style="font-size:1rem"></i>
                                                                                <span>Tambah Foto</span>
                                                                      </div>
                                                            </div>
                                                  </div>
                                        </div>

                                        <div class="row p-2">
                                                  <div class="col-12 col-md-6 px-1 order-2 order-md-1">
                                                            <div class="row mx-2 my-3 align-items-center">
                                                                      <div class="label-border-right position-relative">
                                                                                <span class="label-dialog">Lampiran
                                                                                          KTP</span>
                                                                      </div>
                                                            </div>
                                                            <div class="card">
                                                                      <input type="file" class="d-none" accept="image/*"
                                                                                id="upload-ktp">
                                                                      <div class="card-body mx-2 p-2 bg-light">
                                                                                <div
                                                                                          class="d-flex mb-1 align-items-center mt-2">
                                                                                          <div class="flex-fill pe-2">
                                                                                                    <select class="form-select form-select-sm"
                                                                                                              name="select-ktp"
                                                                                                              id="select-ktp"
                                                                                                              placeholder="Pilih KTP"
                                                                                                              style="width:100%"></select>
                                                                                          </div>
                                                                                          <a type="button"
                                                                                                    class="btn btn-sm btn-primary rounded text-white"
                                                                                                    id="btn-ktp"
                                                                                                    aria-pressed="false"
                                                                                                    value="edit"
                                                                                                    aria-label="name: edit"><i
                                                                                                              class="fa-solid fa-upload pe-2"></i>Upload</a>
                                                                                </div>
                                                                                <div
                                                                                          class="row mb-1 align-items-center mt-2">
                                                                                          <div class="col-12">
                                                                                                    <div id="preview-ktp"
                                                                                                              class="border p-md-4 p-2 text-center"
                                                                                                              style="min-height:50px;">
                                                                                                    </div>
                                                                                          </div>
                                                                                </div>
                                                                      </div>
                                                            </div>
                                                  </div>
                                                  <div class="col-12 col-md-6 px-1 order-2 order-md-1">
                                                            <div class="row mx-2 my-3 align-items-center">
                                                                      <div class="label-border-right position-relative">
                                                                                <span class="label-dialog">Lampiran
                                                                                          NPWP</span>
                                                                      </div>
                                                            </div>
                                                            <div class="card">

                                                                      <input type="file" class="d-none" accept="image/*"
                                                                                id="upload-npwp">
                                                                      <div class="card-body mx-2 p-2 bg-light">
                                                                                <div
                                                                                          class="d-flex mb-1 align-items-center mt-2">
                                                                                          <div class="flex-fill pe-2">
                                                                                                    <select class="form-select form-select-sm"
                                                                                                              name="select-npwp"
                                                                                                              id="select-npwp"
                                                                                                              placeholder="Pilih NPWP"
                                                                                                              style="width:100%"></select>
                                                                                          </div>

                                                                                          <a type="button"
                                                                                                    class="btn btn-sm btn-primary rounded text-white"
                                                                                                    id="btn-npwp"
                                                                                                    aria-pressed="false"
                                                                                                    value="edit"
                                                                                                    aria-label="name: edit"><i
                                                                                                              class="fa-solid fa-upload pe-2"></i>Upload</a>
                                                                                </div>
                                                                                <div
                                                                                          class="row mb-1 align-items-center mt-2">
                                                                                          <div class="col-12">
                                                                                                    <div id="preview-npwp"
                                                                                                              class="border p-md-4 p-2  text-center"
                                                                                                              style="min-height:50px;">
                                                                                                    </div>
                                                                                          </div>
                                                                                </div>
                                                                      </div>
                                                            </div>
                                                  </div>
                                        </div>
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary"
                                                  id="btn-add-invoice">Simpan</button>
                              </div>
                    </div>
          </div>
</div> -->

<div class="modal fade " id="modal-edit" data-bs-keyboard="false" data-bs-backdrop="static">
          <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" name="form-action">
                              <div class="modal-header">
                                        <h6 class="modal-title"><i class="fas fa-crop-alt"></i> &nbsp;Edit
                                                  Gambar</h5>
                                                  <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-0">
                                        <div id="crop-image" style="height:500px;"></div>
                                        <div class="action"
                                                  style="position: absolute; bottom: 15px; margin-left: 50%; transform: translateX(-50%); background: #d1d1d1; padding: 0.5rem; border-radius: 0.5rem;  z-index: 2;">
                                                  <a class="p-2" onclick="rotate_image(90)"><i
                                                                      class="fas fa-undo-alt"></i></a>
                                                  <a class="p-2" onclick="rotate_image(-90)"><i
                                                                      class="fas fa-redo-alt"></i></a>
                                                  <a class="p-2" onclick="flip_image(2)"><i
                                                                      class="fas fa-exchange-alt"></i></a>
                                                  <a class="p-2" onclick="flip_image(4)"><i
                                                                      class="fas fa-exchange-alt fa-rotate-90"></i></a>
                                        </div>
                              </div>
                              <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary" id="submit-crop">Simpan</button>
                              </div>
                    </div>
          </div>
</div>
<div class="modal fade " id="modal-edit-ktp" data-bs-keyboard="false" data-bs-backdrop="static">
          <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" name="form-action">
                              <div class="modal-header">
                                        <h6 class="modal-title"><i class="fas fa-crop-alt"></i> &nbsp;Upload
                                                  Gambar KTP
                                                  </h5>
                                                  <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-0">
                                        <div class="row mb-1 align-items-center mt-2 p-2">
                                                  <label for="ktp-rename" class="col-sm-2 col-form-label">Nama</label>
                                                  <div class="col-sm-10">
                                                            <input id="ktp-rename" name="ktp-rename" type="text"
                                                                      class="form-control form-control-sm input-form"
                                                                      value="">
                                                  </div>
                                        </div>
                                        <div id="crop-image-ktp" style="height:300px;"></div>
                                        <div class="action"
                                                  style="position: absolute; bottom: 15px; margin-left: 50%; transform: translateX(-50%); background: #d1d1d1; padding: 0.5rem; border-radius: 0.5rem;  z-index: 2;">
                                                  <a class="p-2" onclick="rotate_image_npwp(90)"><i
                                                                      class="fas fa-undo-alt"></i></a>
                                                  <a class="p-2" onclick="rotate_image_npwp(-90)"><i
                                                                      class="fas fa-redo-alt"></i></a>
                                                  <a class="p-2" onclick="flip_image_npwp(2)"><i
                                                                      class="fas fa-exchange-alt"></i></a>
                                                  <a class="p-2" onclick="flip_image_npwp(4)"><i
                                                                      class="fas fa-exchange-alt fa-rotate-90"></i></a>
                                        </div>
                              </div>
                              <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary"
                                                  id="submit-crop-ktp">Simpan</button>
                              </div>
                    </div>
          </div>
</div>
<div class="modal fade " id="modal-edit-npwp" data-bs-keyboard="false" data-bs-backdrop="static">
          <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" name="form-action">
                              <div class="modal-header">
                                        <h6 class="modal-title"><i class="fas fa-crop-alt"></i> &nbsp;Upload
                                                  Gambar NPWP
                                                  </h5>
                                                  <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-0">
                                        <div class="row mb-1 align-items-center p-16">
                                                  <label for="npwp-rename" class="col-sm-2 col-form-label">Nama</label>
                                                  <div class="col-sm-10">
                                                            <input id="npwp-rename" name="npwp-rename" type="text"
                                                                      class="form-control form-control-sm input-form"
                                                                      value="">
                                                  </div>
                                        </div>
                                        <div id="crop-image-npwp" style="height:300px;"></div>
                                        <div class="action"
                                                  style="position: absolute; bottom: 15px; margin-left: 50%; transform: translateX(-50%); background: #d1d1d1; padding: 0.5rem; border-radius: 0.5rem;  z-index: 2;">
                                                  <a class="p-2" onclick="rotate_image_npwp(90)"><i
                                                                      class="ri-arrow-go-back-line"></i></a>
                                                  <a class="p-2" onclick="rotate_image_npwp(-90)"><i
                                                                      class="ri-arrow-go-forward-line"></i></a>
                                                  <a class="p-2" onclick="flip_image_npwp(2)"><i
                                                                      class="fas fa-exchange-alt"></i></a>
                                                  <a class="p-2" onclick="flip_image_npwp(4)"><i
                                                                      class="fas fa-exchange-alt fa-rotate-90"></i></a>
                                        </div>
                              </div>
                              <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary"
                                                  id="submit-crop-npwp">Simpan</button>
                              </div>
                    </div>
          </div>
</div>
<div id="modal-optional"></div>
<script>
togglecustom = function(cls, el) {
          if ($("." + cls).hasClass("show")) {
                    $("." + cls).removeClass("show")
                    $("." + cls).slideUp()
                    $(el).find("i").addClass("fa-rotate-180")
                    $(el).find("span").html("Tampilkan")
          } else {
                    $("." + cls).addClass("show")
                    $("." + cls).slideDown()
                    $(el).find("i").removeClass("fa-rotate-180")
                    $(el).find("span").html("Sembunyikan")
          }
}

$('input[name="InvDelivery"]').change(function() {
          if ($(this).val() == 0) {
                    $('#InvDeliveryTotal').prop("disabled", true)
                    $('#InvDeliveryTotal').val("0")
          } else {

                    $('#InvDeliveryTotal').prop("disabled", false)
          }
});

$('#InvDate').daterangepicker({
          "singleDatePicker": true,
          "startDate": moment(),
          "endDate": moment(),
          locale: {
                    format: 'DD MMMM YYYY'
          }
});
get_ref_penawaran = function(id,isUrl = false){
        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>data/penawaran/" + id, 
            success: function(response) {
                console.log(response);
                $('#StoreId').append(new Option(response.header.StoreCode + " - " + response.header.StoreName, response.header.StoreId, true, true)).trigger('change');
                $('#InvProjectAddress').val(response.header.SphProjectAddress);
                $('#CustomerId').append(new Option(response.header.CustomerCode + " - " + response.header.CustomerName, response.header.CustomerId, true, true)).trigger('change');
                $("#InvCustName").val(response.header.SphCustName).prop("readonly",false);
                $("#InvCustTelp").val(response.header.SphCustTelp).prop("readonly",false);
                $("#InvAddress").val(response.header.SphAddress).prop("readonly",false);


                if(isUrl){// 1. Buat elemen option baru
                        var newOption = new Option(response.header.SphCode, response.header.SphId, true, true);

                        // 2. Tambahkan atribut data-type dengan nilai "Penawaran"
                        $(newOption).attr('data-type', 'Penawaran');

                        // 3. Masukkan ke select element dan trigger perubahan
                        $('#InvRef').append(newOption).trigger('change');

                }
                var responseDetail = response.detail;
                responseDetail.forEach(function(item) {
                        table_Inv_item.addDataRow({
                                    "id": item.ProdukId,
                                    "produkid": item.ProdukId,
                                    "varian": JSON.parse(item.SphDetailVarian),
                                    "text": item.SphDetailText,
                                    "group":  item.SphDetailGroup,
                                    "berat": "0",
                                    "satuan_id": item.SphDetailSatuanId,
                                    "satuan_text": item.SphDetailSatuanText,
                                    "pcsM2": item.SphDetailSatuanText,
                                    "price": item.SphDetailPrice,
                                    "disc":  item.SphDetailDisc,
                                    "qty": item.SphDetailQty,
                                    "total": item.SphDetailTotal,
                                    "image_url": item.imageurl,
                                    "type":item.SphDetailType,
                            }); 
                }); 
                table_Inv_item.render()

            },
            error: function(xhr, textStatus, errorThrown) {
                        Swal.fire({
                                icon: 'error',
                                text: xhr["responseJSON"]
                                            [
                                                    'message'
                                            ],
                                confirmButtonColor: "var(--brand)",
                        });
            }
        })
}
$("#InvRef").select2({
          placeholder: "Pilih Referensi dokumen",
          ajax: {
                    url: "<?= base_url()?>select2/get-data-ref-invoice",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function(params) {
                              // CSRF Hash
                              var csrfName = $('.txt_csrfname').attr(
                                        'name'); // CSRF Token name
                              var csrfHash = $('.txt_csrfname')
                                        .val(); // CSRF hash

                              return {
                                        searchTerm: params.term, // search term
                                        [csrfName]: csrfHash // CSRF Token
                              };
                    },
                    processResults: function(response) {

                              // Update CSRF Token
                              $('.txt_csrfname').val(response.token);

                              return {
                                        results: response.data
                              };
                    },
                    cache: true
          },
          escapeMarkup: function(m) {
                    return m;
          },
          templateResult: function template(data) {
                    if ($(data.html).length === 0) {
                              return data.text;
                    }
                    return $(data.html);
          },
          templateSelection: function templateSelect(data) {
                    $(data.element).attr('data-type', data.type);
                    console.log(data.type);
                    if ($(data.html).length === 0) {
                              return data.text;
                    }
                    return data['text'];
          }
}).on('select2:select', function(e) {
          var data = e.params.data;
          console.log(data);
        get_ref_penawaran(data.id); 
});
// Mengambil query string dari URL aktif
const urlParams = new URLSearchParams(window.location.search);
// Mengambil nilai berdasarkan nama parameter
const sphid = urlParams.get('sphid'); 
if(sphid !== null && sphid !== undefined && sphid !== "") {
        
        get_ref_penawaran(sphid,true);
        console.log(sphid);
} 


$("#InvAdmin").select2({
          placeholder: "Pilih Admin",
          ajax: {
                    url: "<?= base_url()?>select2/get-data-users",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function(params) {
                              // CSRF Hash
                              var csrfName = $('.txt_csrfname').attr(
                                        'name'); // CSRF Token name
                              var csrfHash = $('.txt_csrfname')
                                        .val(); // CSRF hash

                              return {
                                        searchTerm: params.term, // search term
                                        [csrfName]: csrfHash // CSRF Token
                              };
                    },
                    processResults: function(response) {

                              // Update CSRF Token
                              $('.txt_csrfname').val(response.token);

                              return {
                                        results: response.data
                              };
                    },
                    cache: true
          },
});

$("#CustomerId").select2({
          placeholder: "Pilih Pelanggan",
          ajax: {
                    url: "<?= base_url()?>select2/get-data-customer",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function(params) {
                              // CSRF Hash
                              var csrfName = $('.txt_csrfname').attr(
                                        'name'); // CSRF Token name
                              var csrfHash = $('.txt_csrfname')
                                        .val(); // CSRF hash

                              return {
                                        searchTerm: params.term, // search term
                                        [csrfName]: csrfHash // CSRF Token
                              };
                    },
                    processResults: function(response) {

                              // Update CSRF Token
                              $('.txt_csrfname').val(response.token);

                              return {
                                        results: response.data
                              };
                    },
                    cache: true
          },
          language: {
                    noResults: function() {
                              return $(
                                        "<button class=\"btn btn-sm btn-primary\" onclick=\"customer_add()\">Tambah Customer Baru</button>"
                              );
                    }
          },
          escapeMarkup: function(m) {
                    return m;
          },
          templateResult: function template(data) {
                    if ($(data.html).length === 0) {
                              return data.text;
                    }
                    return $(data.html);
          },
          templateSelection: function templateSelect(data) {
                    if ($(data.html).length === 0) {
                              return data.text;
                    }
                    return data['text'];
          }
}).on("select2:select", function(e) {
          var data = e.params.data;
          if (data.id !== 0) {
                    $('#InvCustName').val(data.customername);
                    $('#InvCustTelp').val(data.customertelp);
                    $('#InvAddress').val(data.customeraddress);
                    $("#InvCustName").attr("readonly", false);
                    $("#InvCustTelp").attr("readonly", false);
                    $("#InvAddress").attr("readonly", false);
          } else {
                    $("#InvCustName").attr("readonly", true);
                    $("#InvCustTelp").attr("readonly", true);
                    $("#InvAddress").attr("readonly", true);

          }
});

$("#ProjectId").select2({
          placeholder: "Pilih Project",
          ajax: {
                    url: "<?= base_url()?>select2/get-data-project",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function(params) {
                              // CSRF Hash
                              var csrfName = $('.txt_csrfname').attr(
                                        'name'); // CSRF Token name
                              var csrfHash = $('.txt_csrfname')
                                        .val(); // CSRF hash

                              return {
                                        searchTerm: params.term, // search term
                                        [csrfName]: csrfHash // CSRF Token
                              };
                    },
                    processResults: function(response) {

                              // Update CSRF Token
                              $('.txt_csrfname').val(response.token);

                              return {
                                        results: response.data
                              };
                    },
                    cache: true
          },
          language: {
                    noResults: function() {
                              return $(
                                        "<button class=\"btn btn-sm btn-primary\" onclick=\"customer_add()\">Tambah Customer Baru</button>"
                              );
                    }
          },
          escapeMarkup: function(m) {
                    return m;
          },
          templateResult: function template(data) {
                    if ($(data.html).length === 0) {
                              return data.text;
                    }
                    return $(data.html);
          },
          templateSelection: function templateSelect(data) {
                    if ($(data.html).length === 0) {
                              return data.text;
                    }
                    return data['text'];
          }

}).on("select2:select", function(e) {
          var data = e.params.data;
          if (data.id == 0) {
                    $("#StoreId").attr("disabled", false);
                    $("#CustomerId").attr("disabled", false);
          } else {
                    $("#StoreId").attr("disabled", true);
                    $("#CustomerId").attr("disabled", true);
                    $('#StoreId').append(new Option(data.store, data.storeid, true, true))
                              .trigger(
                                        'change');
                    $('#CustomerId').append(new Option(data.customer, data.customerid,
                                        true, true))
                              .trigger('change');
                    $('#InvCustName').val(data.customername);
                    $('#InvCustTelp').val(data.customertelp);
                    $('#InvAddress').val(data.customeraddress);

          }
});
$('#ProjectId').append(new Option("Tidak ada yang dipilih", 0, true, true)).trigger('change');

$("#StoreId").select2({
          placeholder: "Pilih Toko",
          ajax: {
                    url: "<?= base_url()?>select2/get-data-store",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function(params) {
                              // CSRF Hash
                              var csrfName = $('.txt_csrfname').attr(
                                        'name'); // CSRF Token name
                              var csrfHash = $('.txt_csrfname')
                                        .val(); // CSRF hash

                              return {
                                        searchTerm: params.term, // search term
                                        [csrfName]: csrfHash // CSRF Token
                              };
                    },
                    processResults: function(response) {

                              // Update CSRF Token
                              $('.txt_csrfname').val(response.token);

                              return {
                                        results: response.data
                              };
                    },
                    cache: true
          },
});

var isProcessingCustomerAdd

function customer_add() {
          if (isProcessingCustomerAdd) {
                    return;
          }
          isProcessingCustomerAdd = true;
          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/add-customer",
                    success: function(data) {
                              $("#modal-add-invoice").modal("hide");
                              $("#modal-optional").html(data);
                              $("#modal-add-customer").modal("show");

                              $("#modal-add-customer").on("hidden.bs.modal",
                                        function() {
                                                  $("#modal-add-invoice")
                                                            .modal(
                                                                      "show"
                                                            );
                                        })
                              isProcessingCustomerAdd = false;
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingCustomerAdd = false;

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
}



var inv_sub_total = new Cleave(`#InvSubTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var inv_disc_item_total = new Cleave(`#InvDiscItemTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var inv_disc_total = new Cleave(`#InvDiscTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var inv_grand_total = new Cleave(`#InvGrandTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var Sample_delivery = new Cleave(`#InvDeliveryTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var table_Inv_item = new tableItem("table-list", {
          dataitem: [],
          baseUrl: "<?= base_url() ?>",
          modal: $('#modal-add-invoice')
});

grand_total_harga = function(data) {
          var grandtotal = data.totalitem - data.totaldiscitem - $("#InvDiscTotal").val().replace(
                    /[^0-9-]/g,
                    '') + parseInt($("#InvDeliveryTotal").val().replace(/[^0-9-]/g, ''));
          $("#InvSubTotal").val(data.totalitem.toLocaleString('en-US'))
          $("#InvDiscItemTotal").val(data.totaldiscitem.toLocaleString('en-US'))
          $("#InvGrandTotal").val(grandtotal.toLocaleString('en-US'))
};

if (table_Inv_item && typeof table_Inv_item.on === 'function') {
          table_Inv_item.on("subtotal", function(data) {
                    grand_total_harga(data);
          });
          table_Inv_item.getSubTotal()
} else {
          console.error("table_Inv_item tidak terdefinisi atau method on() tidak ada");
}

$("#InvDiscTotal").on("keyup", function() {
          if ($("#InvDiscTotal").val() === "") $("#InvDiscTotal").val(0)
          grand_total_harga(table_Inv_item.getSubTotal())
          if (parseInt($("#InvGrandTotal").val().replace(/[^0-9-]/g, '')) < 0) {
                    $("#InvDiscTotal").val(0);
                    grand_total_harga(table_Inv_item.getSubTotal());
          }
});
$("#InvDeliveryTotal").on("keyup", function() {
          if ($("#InvDeliveryTotal").val() === "") $("#InvDeliveryTotal").val(0)
          grand_total_harga(table_Inv_item.getSubTotal());
});

$('#InvDelivery').change(function() {
          if ($("#InvDelivery").is(':checked') == 0) {
                    $('#InvDeliveryTotal').prop("readonly", true)
                    $('#InvDeliveryTotal').val("0")
                    $('#InvDeliveryTotal').trigger("keyup")
          } else {

                    $('#InvDeliveryTotal').prop("readonly", false)
          }
});
$("#img-produk").on('click', function() {
          $("#upload-produk").trigger("click");
})
$("#upload-produk").on('change', function() {
          const file = this.files[0];
          if (file) {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                              $("#list-produk").append(`<div class="image-default-obi border">
                                <img src="${reader.result}" draggable="true"> 
                                <div class="action">
                                    <a class="btn btn-sm btn-white p-1" onclick="crop_image(this)"><i class="fas fa-crop-alt"></i></a>
                                    <a class="btn btn-sm btn-white p-1" onclick="delete_image(this)"><i class="fas fa-trash"></i></a>
                                </div>
                                 
                        </div>`);
                              var draggedImage = null;

                              // Event dragstart untuk menangkap elemen gambar yang sedang di-drag
                              $('.image-default-obi.border img').on('dragstart',
                                        function(
                                                  event) {
                                                  draggedImage = $(
                                                            this
                                                  ); // Simpan elemen gambar sebagai referensi
                                        });

                              // Event dragover untuk mencegah default behavior
                              $('.image-default-obi.border').on('dragover',
                                        function(
                                                  event) {
                                                  event
                                                            .preventDefault(); // Harus ada untuk memungkinkan drop
                                                  $(this).addClass(
                                                            'dragover'
                                                  ); // Tambahkan efek visual
                                        });

                              // Event dragleave untuk menghapus efek visual ketika keluar dari dropzone
                              $('.image-default-obi.border').on('dragleave',
                                        function() {
                                                  $(this).removeClass(
                                                            'dragover'
                                                  );
                                        });

                              // Event drop untuk memindahkan gambar
                              $('.image-default-obi.border').on('drop',
                                        function(event) {
                                                  event
                                                            .preventDefault(); // Cegah perilaku default
                                                  $(this).removeClass(
                                                            'dragover'
                                                  ); // Hapus efek visual

                                                  // Ambil gambar yang sudah ada di dropzone target
                                                  const existingImage =
                                                            $(this)
                                                            .find(
                                                                      'img'
                                                            );

                                                  // Jika ada gambar yang sedang di-drag
                                                  if (draggedImage) {
                                                            // Pindahkan gambar yang sudah ada ke tempat asal gambar yang sedang di-drag
                                                            const sourceDropzone =
                                                                      draggedImage
                                                                      .closest(
                                                                                '.image-default-obi.border'
                                                                      );
                                                            sourceDropzone
                                                                      .prepend(
                                                                                existingImage
                                                                      );

                                                            // Pindahkan gambar yang di-drag ke dropzone target
                                                            $(this).prepend(
                                                                      draggedImage
                                                            );
                                                  }
                                        });
                    }
          }
});
var $uploadCrop, tempFilename, rawImg, imageId;
$uploadCrop = $('#crop-image').croppie({
          viewport: {
                    width: 400,
                    height: 400,
          },
          showZoomer: false,
          enforceBoundary: false,
          enableExif: true,
          enableOrientation: true
});
crop_image = function(el) {
          var image_crop = $(el).parent().parent().find('img');
          var flip = 0;
          $('#modal-edit').modal('show');

          $('#modal-edit').on('shown.bs.modal', function() {
                    $uploadCrop.croppie('bind', {
                              url: $(image_crop).attr('src')
                    }).then(function() {
                              console.log(
                                        'jQuery bind complete'
                              );
                    });
          });
          rotate_image = function(val) {
                    $uploadCrop.croppie('rotate', parseInt(val));
          }
          flip_image = function(val) {
                    flip = flip == 0 ? val : 0;
                    $uploadCrop.croppie('bind', {
                              url: $(el).parent().parent().find('img')
                                        .attr(
                                                  'src'),
                              orientation: flip
                    });
          }

          $('#submit-crop').unbind().click(function(ev) {
                    $uploadCrop.croppie('result', {
                              type: 'base64',
                              format: 'png',
                              size: {
                                        width: 400,
                                        height: 400
                              }
                    }).then(function(resp) {
                              $(image_crop).attr('src',
                                        resp)
                              $('#modal-edit').modal(
                                        'hide');
                    });
          });
}
delete_image = function(el) {
          $(el).parent().parent().remove();
}

var quill = [];
$(".template-footer").each(function(index, el) {
          var message = $(el).find("[name='EditFooterMessage']")[0];
          var type = "invoice";
          quill[type] = new Quill(message, {
                    debug: 'false',
                    modules: {
                              toolbar: [
                                        ['bold', 'italic',
                                                  'underline',
                                                  'strike'
                                        ],
                                        [{
                                                  'list': 'ordered'
                                        }]
                              ],
                    },
                    theme: "bubble" //'snow'
          });
          quill[type].enable(false);
          quill[type].root.style.background = 'var(--white)'; // warna disable 
          const btnsaveas = $(el).find("a[value='simpanAs']")[0];
          const btnsave = $(el).find("a[value='simpan']")[0];
          const btnedit = $(el).find("a[value='edit']")[0];
          const selectoption = $(el).find("select")[0];

          $(btnsave).hide();
          $(btnsaveas).hide();
          $(btnedit).hide();

          $(selectoption).select2({
                    placeholder: "Pilih Template",
                    tags: true,
                    ajax: {
                              url: "<?= base_url()?>select2/get-data-template-footer/" +
                                        type,
                              dataType: 'json',
                              type: "POST",
                              delay: 250,
                              data: function(params) {
                                        // CSRF Hash
                                        var csrfName = $(
                                                            '.txt_csrfname'
                                                  )
                                                  .attr(
                                                            'name'
                                                  ); // CSRF Token name
                                        var csrfHash = $(
                                                            '.txt_csrfname'
                                                  )
                                                  .val(); // CSRF hash 
                                        return {
                                                  searchTerm: params
                                                            .term, // search term
                                                  [
                                                            csrfName
                                                  ]: csrfHash // CSRF Token
                                        };
                              },
                              processResults: function(response) {

                                        // Update CSRF Token
                                        $('.txt_csrfname')
                                                  .val(
                                                            response
                                                            .token
                                                  );

                                        return {
                                                  results: response
                                                            .data
                                        };
                              },
                              cache: true
                    },
                    createTag: function(params) {
                              return {
                                        id: params.term,
                                        text: params.term,
                                        tags: true // menandai tag baru
                              };
                    },
                    createTagText: function(params) {
                              return "Tambah '" + params
                                        .term + "'";
                    },
                    templateResult: function(params) {
                              if (params.newTag) {
                                        return "Tambah '" +
                                                  params
                                                  .text +
                                                  "'";
                              }
                              if (params.loading) return params
                                        .text;
                              return params.text;
                              //return params.text;
                    },
                    templateSelection: function(params) {
                              return params.text;
                    },
                    //escapeMarkup: function(m) { return m; }
          }).on("select2:select", function(e) {
                    var data = e.params.data;
                    //console.log(data);
                    if (e.params.data.tags) {
                              quill[type].setContents();

                              $(btnsave).show();
                              $(btnsaveas).show();
                              $(btnedit).hide();

                              quill[type].enable(true);
                              quill[type].root.style.background =
                                        'var(--bg-color)'; // warna enable
                    } else {
                              quill[type].setContents(JSON.parse(data
                                        .delta));

                              $(btnsave).hide();
                              $(btnsaveas).hide();
                              $(btnedit).show();

                              quill[type].enable(false);
                              quill[type].root.style.background =
                                        'var(--white)'; // warna enable
                    }
          });

          $(btnsave).click(function() {
                    if ($(selectoption).select2("data")[0]["id"] == $(
                                        selectoption).select2("data")[
                                        0][
                                        "text"
                              ]) {
                              $.ajax({
                                        dataType: "json",
                                        method: "POST",
                                        url: "<?= base_url() ?>action/add-data-template-footer",
                                        data: {
                                                  "TemplateFooterName": $(
                                                                      selectoption
                                                            )
                                                            .select2(
                                                                      "data"
                                                            )[
                                                                      0
                                                            ]
                                                            [
                                                                      "text"
                                                            ],
                                                  "TemplateFooterDetail": quill[
                                                                      type
                                                            ]
                                                            .root
                                                            .innerHTML
                                                            .replace(/\s+/g,
                                                                      " "
                                                            ),
                                                  "TemplateFooterDelta": quill[
                                                                      type
                                                            ]
                                                            .getContents(),
                                                  "TemplateFooterCategory": type,
                                        },
                                        success: function(
                                                  data
                                        ) {
                                                  //console.log(data); 
                                                  if (data["status"] ===
                                                            true
                                                  ) {

                                                            $(btnsave)
                                                                      .hide();
                                                            $(btnsaveas)
                                                                      .hide();
                                                            $(btnedit)
                                                                      .show();

                                                            quill[type]
                                                                      .enable(
                                                                                false
                                                                      );
                                                            quill[type]
                                                                      .root
                                                                      .style
                                                                      .background =
                                                                      'var(--white)'; // warna disable    
                                                  }
                                        },
                                        error: function(xhr, textStatus,
                                                  errorThrown
                                        ) {
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
                    } else {
                              $.ajax({
                                        dataType: "json",
                                        method: "POST",
                                        url: "<?= base_url() ?>action/edit-data-template-footer/" +
                                                  $(
                                                            selectoption
                                                  )
                                                  .select2(
                                                            "data"
                                                  )[
                                                            0
                                                  ]
                                                  [
                                                            "id"
                                                  ],
                                        data: {
                                                  "TemplateFooterName": $(
                                                                      selectoption
                                                            )
                                                            .select2(
                                                                      "data"
                                                            )[
                                                                      0
                                                            ]
                                                            [
                                                                      "text"
                                                            ],
                                                  "TemplateFooterDetail": quill[
                                                                      type
                                                            ]
                                                            .root
                                                            .innerHTML
                                                            .replace(/\s+/g,
                                                                      " "
                                                            ),
                                                  "TemplateFooterDelta": quill[
                                                                      type
                                                            ]
                                                            .getContents(),
                                                  "TemplateFooterCategory": type,
                                        },
                                        success: function(
                                                  data
                                        ) {
                                                  //console.log(data); 
                                                  if (data["status"] ===
                                                            true
                                                  ) {

                                                            $(btnsave)
                                                                      .hide();
                                                            $(btnsaveas)
                                                                      .hide();
                                                            $(btnedit)
                                                                      .show();

                                                            quill[type]
                                                                      .enable(
                                                                                false
                                                                      );
                                                            quill[type]
                                                                      .root
                                                                      .style
                                                                      .background =
                                                                      'var(--white)'; // warna disable    
                                                  }
                                        },
                                        error: function(xhr, textStatus,
                                                  errorThrown
                                        ) {
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
                    }
          })
          $(btnsaveas).click(function() {
                    $("#modal-add-invoice").modal("hide");
                    Swal.fire({
                              title: 'Simpan Template',
                              input: 'text',
                              buttonsStyling: false,
                              showCancelButton: true,
                              showCancelButton: true,
                              customClass: {
                                        confirmButton: 'btn btn-primary mx-1',
                                        cancelButton: 'btn btn-secondary mx-1',
                                        loader: 'custom-loader',
                                        input: 'form-control form-control-sm w-auto input-form', // Tambahkan kelas pada input
                              },
                              backdrop: true,
                              confirmButtonText: "Simpan",
                              loaderHtml: '<div class="spinner-border text-primary"></div>',
                              preConfirm: async (
                                        name
                              ) => {
                                        try {
                                                  $.ajax({
                                                            dataType: "json",
                                                            method: "POST",
                                                            url: "<?= base_url() ?>action/add-data-template-footer",
                                                            data: {
                                                                      "TemplateFooterName": name,
                                                                      "TemplateFooterDetail": quill[
                                                                                          type
                                                                                ]
                                                                                .root
                                                                                .innerHTML
                                                                                .replace(/\s+/g,
                                                                                          " "
                                                                                ),
                                                                      "TemplateFooterDelta": quill[
                                                                                          type
                                                                                ]
                                                                                .getContents(),
                                                                      "TemplateFooterCategory": type,
                                                            },
                                                            success: function(
                                                                      data
                                                            ) {
                                                                      //console.log(data); 
                                                                      if (data["status"] ===
                                                                                true
                                                                      ) {
                                                                                $(selectoption)
                                                                                          .append(new Option(data[
                                                                                                              "data"
                                                                                                    ]
                                                                                                    [
                                                                                                              "TemplateFooterName"
                                                                                                    ],
                                                                                                    data[
                                                                                                              "data"
                                                                                                    ]
                                                                                                    [
                                                                                                              "TemplateFooterId"
                                                                                                    ],
                                                                                                    true,
                                                                                                    true
                                                                                          ))
                                                                                          .trigger(
                                                                                                    'change'
                                                                                          );

                                                                                $(btnsave)
                                                                                          .hide();
                                                                                $(btnsaveas)
                                                                                          .hide();
                                                                                $(btnedit)
                                                                                          .show();

                                                                                quill[type]
                                                                                          .enable(
                                                                                                    false
                                                                                          );
                                                                                quill[type]
                                                                                          .root
                                                                                          .style
                                                                                          .background =
                                                                                          'var(--white)'; // warna disable    
                                                                      }
                                                            },
                                                            error: function(xhr, textStatus,
                                                                      errorThrown
                                                            ) {
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
                                        } catch (
                                                  error
                                        ) {
                                                  Swal.showValidationMessage(
                                                            `Request failed: ${error["responseJSON"]['message']}`
                                                  );
                                        }
                              },
                              allowOutsideClick: () =>
                                        !Swal
                                        .isLoading()
                    }).then((result) => {
                              $(btnsave).hide();
                              $(btnsaveas).hide();
                              $(btnedit).show();

                              quill[type].enable(
                                        false
                              );
                              quill[type].root
                                        .style
                                        .background =
                                        'var(--white)'; // warna disable    
                              $("#modal-add-invoice")
                                        .modal(
                                                  "show"
                                        );
                    });
          })
          $(btnedit).click(function() {

                    $(btnsave).show();
                    $(btnsaveas).show();
                    $(btnedit).hide();

                    quill[type].enable(true);
                    quill[type].root.style.background =
                              'var(--bg-color)'; // warna enable

          })
});

$("#select-npwp").select2({
          placeholder: "Tidak ada yang dipilih",
          ajax: {
                    url: "<?= base_url()?>select2/get-data-npwp",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function(params) {
                              // CSRF Hash
                              var csrfName = $('.txt_csrfname').attr(
                                        'name'); // CSRF Token name
                              var csrfHash = $('.txt_csrfname')
                                        .val(); // CSRF hash 
                              return {
                                        searchTerm: params.term, // search term
                                        [csrfName]: csrfHash // CSRF Token
                              };
                    },
                    processResults: function(response) {

                              // Update CSRF Token
                              $('.txt_csrfname').val(response.token);

                              return {
                                        results: response.data
                              };
                    },
                    cache: true
          },
          templateResult: function(params) {
                    if (params.newTag) {
                              return "Tambah '" + params.text + "'";
                    }
                    if (params.loading) return params.text;
                    return params.text;
                    //return params.text;
          },
          templateSelection: function(params) {
                    return params.text;
          },
          //escapeMarkup: function(m) { return m; }
}).on("select2:select", function(e) {
          var data = e.params.data;
          if (data.image == "") {
                    $("#preview-npwp").html("")
          } else {
                    var html = "<img src='" + data.image + "' >"
                    $("#preview-npwp").html(html)
          }
});
$("#btn-npwp").on('click', function() {
          $("#upload-npwp").trigger("click");
})
var $uploadCropNpwp = $('#crop-image-npwp').croppie({
          viewport: {
                    width: 250,
                    height: 150,
          },
          showZoomer: false,
          enforceBoundary: false,
          enableExif: true,
          enableOrientation: true
});
$("#upload-npwp").on('change', function() {
          const file = this.files[0];
          if (file) {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                              var flip = 0;
                              $('#npwp-rename').val("");
                              $('#modal-edit-npwp').modal('show');
                              $('#modal-edit-npwp').on('shown.bs.modal',
                                        function() {
                                                  $uploadCropNpwp
                                                            .croppie(
                                                                      'bind', {
                                                                                url: reader
                                                                                          .result
                                                                      }
                                                            )
                                                            .then(
                                                                      function() {

                                                                      }
                                                            );
                                        });
                              rotate_image_npwp = function(val) {
                                        $uploadCropNpwp.croppie(
                                                  'rotate',
                                                  parseInt(
                                                            val
                                                  )
                                        );
                              }
                              flip_image_npwp = function(val) {
                                        flip = flip == 0 ? val : 0;
                                        $uploadCropNpwp.croppie(
                                                  'bind', {
                                                            url: $(el).parent()
                                                                      .parent()
                                                                      .find(
                                                                                'img'
                                                                      )
                                                                      .attr(
                                                                                'src'
                                                                      ),
                                                            orientation: flip
                                                  });
                              }
                              $('#submit-crop-npwp').unbind().click(function(
                                        ev) {
                                        if ($('#npwp-rename')
                                                  .val() ==
                                                  "") {
                                                  Swal.fire({
                                                                      icon: 'error',
                                                                      text: 'Nama harus diinput...!!!',
                                                                      confirmButtonColor: "var(--brand)",
                                                            })
                                                            .then(function() {
                                                                      swal
                                                                                .close();
                                                                      setTimeout(() => $("#npwp-rename")
                                                                                .focus(),
                                                                                300
                                                                      );
                                                            });
                                                  return;
                                        };
                                        $uploadCropNpwp
                                                  .croppie(
                                                            'result', {
                                                                      type: 'base64',
                                                                      format: 'png',
                                                                      size: {
                                                                                width: 250,
                                                                                height: 150
                                                                      }
                                                            }
                                                  )
                                                  .then(
                                                            function(
                                                                      resp
                                                            ) {
                                                                      $.ajax({
                                                                                dataType: "json",
                                                                                method: "POST",
                                                                                url: "<?= base_url() ?>action/add-data-lampiran",
                                                                                data: {
                                                                                          "Name": $('#npwp-rename')
                                                                                                    .val(),
                                                                                          "Image": resp,
                                                                                          "Type": "NPWP",
                                                                                },
                                                                                success: function(
                                                                                          data
                                                                                ) {
                                                                                          //console.log(data); 
                                                                                          if (data["status"] ===
                                                                                                    true
                                                                                          ) {
                                                                                                    $("#preview-npwp")
                                                                                                              .html(
                                                                                                                        `<img src="${resp}">`
                                                                                                              )
                                                                                                    $('#modal-edit-npwp')
                                                                                                              .modal(
                                                                                                                        'hide'
                                                                                                              );
                                                                                                    $('#select-npwp')
                                                                                                              .append(new Option(data[
                                                                                                                                  "data"
                                                                                                                        ]
                                                                                                                        [
                                                                                                                                  "Name"
                                                                                                                        ],
                                                                                                                        data[
                                                                                                                                  "data"
                                                                                                                        ]
                                                                                                                        [
                                                                                                                                  "id"
                                                                                                                        ],
                                                                                                                        true,
                                                                                                                        true
                                                                                                              ))
                                                                                                              .trigger(
                                                                                                                        'change'
                                                                                                              );
                                                                                          }
                                                                                },
                                                                                error: function(xhr, textStatus,
                                                                                          errorThrown
                                                                                ) {
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
                                                            }
                                                  );
                              });
                    }
          }
});


$("#select-ktp").select2({
          placeholder: "Tidak ada yang dipilih",
          ajax: {
                    url: "<?= base_url()?>select2/get-data-ktp",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function(params) {
                              // CSRF Hash
                              var csrfName = $('.txt_csrfname').attr(
                                        'name'); // CSRF Token name
                              var csrfHash = $('.txt_csrfname')
                                        .val(); // CSRF hash 
                              return {
                                        searchTerm: params.term, // search term
                                        [csrfName]: csrfHash // CSRF Token
                              };
                    },
                    processResults: function(response) {

                              // Update CSRF Token
                              $('.txt_csrfname').val(response.token);

                              return {
                                        results: response.data
                              };
                    },
                    cache: true
          },
          templateResult: function(params) {
                    if (params.newTag) {
                              return "Tambah '" + params.text + "'";
                    }
                    if (params.loading) return params.text;
                    return params.text;
                    //return params.text;
          },
          templateSelection: function(params) {
                    return params.text;
          },
          //escapeMarkup: function(m) { return m; }
}).on("select2:select", function(e) {
          var data = e.params.data;
          if (data.image == "") {
                    $("#preview-ktp").html("")
          } else {
                    var html = "<img src='" + data.image + "'>"
                    $("#preview-ktp").html(html)
          }
});
$("#btn-ktp").on('click', function() {
          $("#upload-ktp").trigger("click");
})
var $uploadCropKtp = $('#crop-image-ktp').croppie({
          viewport: {
                    width: 250,
                    height: 150,
          },
          showZoomer: false,
          enforceBoundary: false,
          enableExif: true,
          enableOrientation: true
});
$("#upload-ktp").on('change', function() {
          const file = this.files[0];
          if (file) {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                              var flip = 0;
                              $('#ktp-rename').val("");
                              $('#modal-edit-ktp').modal('show');
                              $('#modal-edit-ktp').on('shown.bs.modal',
                                        function() {
                                                  $uploadCropKtp
                                                            .croppie(
                                                                      'bind', {
                                                                                url: reader
                                                                                          .result
                                                                      }
                                                            )
                                                            .then(
                                                                      function() {

                                                                      }
                                                            );
                                        });
                              rotate_image_npwp = function(val) {
                                        $uploadCropKtp.croppie(
                                                  'rotate',
                                                  parseInt(
                                                            val
                                                  )
                                        );
                              }
                              flip_image_npwp = function(val) {
                                        flip = flip == 0 ? val : 0;
                                        $uploadCropKtp.croppie(
                                                  'bind', {
                                                            url: $(el).parent()
                                                                      .parent()
                                                                      .find(
                                                                                'img'
                                                                      )
                                                                      .attr(
                                                                                'src'
                                                                      ),
                                                            orientation: flip
                                                  });
                              }
                              $('#submit-crop-ktp').unbind().click(function(
                                        ev) {
                                        if ($('#ktp-rename')
                                                  .val() ==
                                                  "") {
                                                  Swal.fire({
                                                                      icon: 'error',
                                                                      text: 'Nama harus diinput...!!!',
                                                                      confirmButtonColor: "var(--brand)",
                                                            })
                                                            .then(function() {
                                                                      swal
                                                                                .close();
                                                                      setTimeout(() => $("#ktp-rename")
                                                                                .focus(),
                                                                                300
                                                                      );
                                                            });
                                                  return;
                                        };
                                        $uploadCropKtp
                                                  .croppie(
                                                            'result', {
                                                                      type: 'base64',
                                                                      format: 'png',
                                                                      size: {
                                                                                width: 250,
                                                                                height: 150
                                                                      }
                                                            }
                                                  )
                                                  .then(
                                                            function(
                                                                      resp
                                                            ) {
                                                                      $.ajax({
                                                                                dataType: "json",
                                                                                method: "POST",
                                                                                url: "<?= base_url() ?>action/add-data-lampiran",
                                                                                data: {
                                                                                          "Name": $('#ktp-rename')
                                                                                                    .val(),
                                                                                          "Image": resp,
                                                                                          "Type": "KTP",
                                                                                },
                                                                                success: function(
                                                                                          data
                                                                                ) {
                                                                                          //console.log(data); 
                                                                                          if (data["status"] ===
                                                                                                    true
                                                                                          ) {
                                                                                                    $("#preview-ktp")
                                                                                                              .html(
                                                                                                                        `<img src="${resp}">`
                                                                                                              )
                                                                                                    $('#modal-edit-ktp')
                                                                                                              .modal(
                                                                                                                        'hide'
                                                                                                              );
                                                                                                    $('#select-ktp')
                                                                                                              .append(new Option(data[
                                                                                                                                  "data"
                                                                                                                        ]
                                                                                                                        [
                                                                                                                                  "Name"
                                                                                                                        ],
                                                                                                                        data[
                                                                                                                                  "data"
                                                                                                                        ]
                                                                                                                        [
                                                                                                                                  "id"
                                                                                                                        ],
                                                                                                                        true,
                                                                                                                        true
                                                                                                              ))
                                                                                                              .trigger(
                                                                                                                        'change'
                                                                                                              );
                                                                                          }
                                                                                },
                                                                                error: function(xhr, textStatus,
                                                                                          errorThrown
                                                                                ) {
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
                                                            }
                                                  );
                              });
                    }
          }
});

$("#btn-add-invoice").click(function() {
          var data_detail_item = table_Inv_item.getDataRow();
          if ($("#CustomerId").val() == null) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Pelanggan harus dipilih...!!!',
                              confirmButtonColor: "var(--brand)",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#CustomerId")
                                        .select2("open"),
                                        300);
                    });
                    return false;
          }
          if ($("#StoreId").val() == null) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Toko harus dipilih...!!!',
                              confirmButtonColor: "var(--brand)",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#StoreId").select2(
                                                  "open"),
                                        300);
                    });
                    return false;
          }
          if ($("#InvAdmin").val() == null) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Admin harus dipilih...!!!',
                              confirmButtonColor: "var(--brand)",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#InvAdmin").select2("open"),
                                        300);
                    });
                    return false;
          }
          if ($($(".template-footer").find("select")[0]).val() == null) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Template harus dipilih...!!!',
                              confirmButtonColor: "var(--brand)",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $($(".template-footer")
                                                  .find(
                                                            "select"
                                                  )[
                                                            0
                                                  ]
                                        ).select2(
                                                  "open"),
                                        300);
                    });
                    return;
          }



          if (data_detail_item.some((item) => item.type === "product") == false) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Produk harus dimasukan...!!!',
                              confirmButtonColor: "var(--brand)",
                    }).then(function() {
                              swal.close();


                              setTimeout(() => $('html, body').scrollTop($(
                                                            '#table-list'
                                                  ).offset()
                                                  .top - 300),
                                        300);
                    });
                    return;
          }
          if (data_detail_item.some((item) => item.satuan_id === 0) == true) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Data produk ada yang belum lengkap ...!!!',
                              confirmButtonColor: "var(--brand)",
                    }).then(function() {
                              swal.close();
                              const index = data_detail_item.findIndex((item) =>
                                        item
                                        .satuan_id === 0);
                              setTimeout(() => $("#select-satuan-" + index)
                                        .select2("open"),
                                        300);

                    });
                    return;
          }
          var header = {
                    InvDate: $("#InvDate").data('daterangepicker').startDate
                              .format(
                                        "YYYY-MM-DD"),
                    ProjectId: $("#ProjectId").val(),
                    CustomerId: $("#CustomerId").val(),
                    StoreId: $("#StoreId").val(),
                    InvRef: $("#InvRef").val(),
                    InvRefType: $('#InvRef option:selected').data('type'),
                    InvAdmin: $("#InvAdmin").val(),
                    InvDelivery: $('#SphDelivery').is(':checked'),
                    InvDeliveryTotal: $("#InvDeliveryTotal").val().replace(
                              /[^0-9]/g, ''),
                    InvCustName: $("#InvCustName").val(),
                    InvCustTelp: $("#InvCustTelp").val(),
                    InvAddress: $("#InvAddress").val(),
                    InvProjectAddress: $("#InvProjectAddress").val(),
                    TemplateId: $($(".template-footer").find("select")[0])
                              .val(),
                    InvSubTotal: $("#InvSubTotal").val().replace(/[^0-9]/g, ''),
                    InvDiscItemTotal: $("#InvDiscItemTotal").val().replace(
                              /[^0-9]/g, ''),
                    InvDiscTotal: $("#InvDiscTotal").val().replace(/[^0-9]/g,
                              ''),
                    InvGrandTotal: $("#InvGrandTotal").val().replace(/[^0-9]/g,
                              ''),
                    InvImageList: $("#list-produk img").map(function() {
                              return $(this).attr("src")
                    }).get(),
                    InvKtp: $("#select-ktp").val(),
                    InvNpwp: $("#select-npwp").val(),
          }
          var detail = [];
          for (var i = 0; data_detail_item.length > i; i++) {
                    if (data_detail_item[i]["type"] == "product") {
                              detail.push({
                                        ProdukId: data_detail_item[i][
                                                  "produkid"
                                        ],
                                        InvDetailText: data_detail_item[
                                                  i][
                                                  "text"
                                        ],
                                        InvDetailType: data_detail_item[
                                                  i][
                                                  "type"
                                        ],
                                        InvDetailSatuanId: data_detail_item[
                                                  i][
                                                  "satuan_id"
                                        ],
                                        InvDetailSatuanText: data_detail_item[
                                                            i]
                                                  ["satuan_text"],
                                        InvDetailQty: data_detail_item[
                                                  i][
                                                  "qty"
                                        ],
                                        InvDetailPrice: data_detail_item[
                                                  i][
                                                  "price"
                                        ],
                                        InvDetailDisc: data_detail_item[
                                                  i][
                                                  "disc"
                                        ],
                                        InvDetailTotal: data_detail_item[
                                                  i][
                                                  "total"
                                        ],
                                        InvDetailGroup: data_detail_item[
                                                  i][
                                                  "group"
                                        ],
                                        InvDetailVarian: data_detail_item[
                                                  i][
                                                  "varian"
                                        ],
                              });
                    } else {
                              detail.push({
                                        ProdukId: data_detail_item[i][
                                                  "produkid"
                                        ],
                                        InvDetailText: data_detail_item[
                                                  i][
                                                  "text"
                                        ],
                                        InvDetailType: data_detail_item[
                                                  i][
                                                  "type"
                                        ],
                                        InvDetailSatuanId: "",
                                        InvDetailSatuanText: "",
                                        InvDetailQty: 0,
                                        InvDetailPrice: 0,
                                        InvDetailDisc: 0,
                                        InvDetailTotal: 0,
                                        InvDetailGroup: "",
                                        InvDetailVarian: [],
                              });
                    }
          }

          $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/add-data-invoice",
                    data: {
                              "header": header,
                              "detail": detail,
                    },
                    success: function(data) {
                              //console.log(data); 
                              if (data["status"] === true) {
                                        Swal.fire({
                                                  icon: 'success',
                                                  text: 'Simpan data berhasil...!!!',
                                                  confirmButtonColor: "var(--brand)",
                                        }).then((result) => {
                                                  window.location
                                                            .href =
                                                            "<?=base_url()?>admin/sales/invoice";
                                        });

                              } else {
                                        Swal.fire({
                                                  icon: 'error',
                                                  text: data,
                                                  confirmButtonColor: "var(--brand)",
                                        });
                              }
                    },
                    error: function(xhr, textStatus, errorThrown) {
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
});
</script>
<?php $this->endSection('content'); ?>