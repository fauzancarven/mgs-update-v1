<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<!-- 
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?> -->

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          <h6 class="fw-semibold mb-0">List Customer</h6>
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
                    <li class="fw-medium"> <a href="<?= base_url() ?>admin/account"
                                        class="d-flex align-items-center gap-1 hover-text-primary">
                                        <iconify-icon icon="flowbite:users-group-outline" class="icon text-lg">
                                        </iconify-icon>
                                        Customer List
                              </a>
                    </li>
          </ul>
</div>
<div class="card radius-15 overflow-hidden mb-3 border-0 shadow-sm">
          <div class="card-header  d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                              <div class="icon-field">
                                        <select class="form-select form-select-sm w-auto" id="input-search-row">
                                                  <option value="10">Tampilkan 10 Baris</option>
                                                  <option value="25">Tampilkan 25 Baris</option>
                                                  <option value="50">Tampilkan 50 Baris</option>
                                        </select>
                                        <span class="icon">
                                                  <iconify-icon icon="material-symbols-light:lists"></iconify-icon>
                                        </span>
                              </div>
                              <div class="icon-field">
                                        <input type="text" name="#0" class="form-control form-control-sm w-auto"
                                                  placeholder="Search" id="input-search-data">
                                        <span class="icon">
                                                  <iconify-icon icon="ion:search-outline"></iconify-icon>
                                        </span>
                              </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                              <a onclick="add_click()" class="btn btn-sm btn-primary-600"><i class="ri-add-line"></i>
                                        Create Customer</a>
                    </div>
                    <!-- <div class="d-flex justify-content-between align-items-center">
                              <h5 class="card-title mb-0">List Store</h5>


                              <div class="justify-content-end d-flex col-lg-2 col-6 pb-lg-2 pb-4  order-lg-3">
                                        <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click()"><i
                                                            class="ti-plus pe-2"></i><span
                                                            class="d-none d-md-inline-block">Tambah
                                                            Store<span></button>
                              </div>

                    </div> -->
          </div>
          <div class="card-body py-4">
                    <table class="table bordered-table mb-0" id="table-customer" style="width:100%">
                              <thead>
                                        <tr class="py-2">
                                                  <th class="py-lg-4 py-3 px-lg-2 px-0">Kode</th>
                                                  <th data-priority="2" class="py-lg-4 px-lg-2  py-3 px-0">Nama</th>
                                                  <th class="py-lg-4 py-3 px-lg-2  px-0">Company</th>
                                                  <th class="py-lg-4 py-3 px-lg-2 px-0">Category</th>
                                                  <th class="py-lg-4 py-3 px-lg-2 ">Email</th>
                                                  <th data-priority="3" class="py-lg-4 px-lg-2 py-3">Telp</th>
                                                  <th class="py-lg-4 px-lg-2  py-3">Address</th>
                                                  <th data-priority="1" class=" py-lg-4 px-lg-2  py-3"><i
                                                                      class="ti-settings"></i>
                                                  </th>
                                        </tr>
                              </thead>
                              <tbody class="">
                              </tbody>
                    </table>
          </div>
</div>
<div style="margin-bottom: 100px;"></div>
<div id="modal-message"></div>


<script>
let isProcessingSave = false;
let isProcessingAdd = false;
let isProcessingEdit = false;
let isProcessingReset = false;
let isProcessingDelete = false;

var table = $('#table-customer').DataTable({
          "responsive": {
                    "details": {
                              "type": 'column'
                    }
          },
          "searching": false,
          "lengthChange": false,
          "pageLength": parseInt($("#input-search-row").val()),
          "language": {
                    "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                    "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                    "processing": '<div class="loading-spinner"></div>',
          },
          "processing": true,
          "serverSide": true,
          "ajax": {
                    "url": "<?= base_url()?>datatables/get-data-customer",
                    "type": "POST",
                    "data": function(data) {
                              data["search"]["value"] = $("#input-search-data").val()
                    }
          },
          "columns": [{
                              data: "CustomerCode"
                    },
                    {
                              data: "cust_name"
                    },
                    {
                              data: "CustomerCompany"
                    },
                    {
                              data: "kategori"
                    },
                    {
                              data: "CustomerEmail"
                    },
                    {
                              data: "CustomerTelp1"
                    },
                    {
                              data: "CustomerAddress"
                    },
                    {
                              data: "action",
                              orderable: false,
                              className: "action-td"
                    },
          ]
});
$("#input-search-row").change(function() {
          table.ajax.reload(null, false).responsive.recalc().columns.adjust();
})
$("#input-search-data").keyup(function() {
          table.ajax.reload(null, false).responsive.recalc().columns.adjust();
})
$("#btn-search-data").click(function() {
          table.ajax.reload(null, false).responsive.recalc().columns.adjust();
})

add_click = function(el) {
          // INSERT LOADER BUTTON
          if (isProcessingAdd) {
                    return;
          }
          isProcessingAdd = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>'
          );
          // END LOADER BUTTON

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/add-customer",
                    success: function(data) {

                              $("#modal-message").html(data);
                              $("#modal-add-customer").modal("show");

                              $("#modal-add-customer").on("hidden.bs.modal",
                                        function() {
                                                  table.ajax.reload(null,
                                                                      false
                                                            )
                                                            .responsive
                                                            .recalc()
                                                            .columns
                                                            .adjust();
                                        })
                              isProcessingAdd = false;
                              $(el).html(old_text);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingAdd = false;
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

edit_click = function(id, el) {
          if (isProcessingEdit) {
                    return;
          }
          isProcessingEdit = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>'
          );

          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/edit-customer/" + id,
                    success: function(data) {
                              isProcessingEdit = false;
                              $(el).html(old_text);
                              $("#modal-message").html(data);
                              $("#modal-edit-customer").modal("show");

                              $("#modal-edit-customer").on("hidden.bs.modal",
                                        function() {
                                                  table.ajax.reload(null,
                                                                      false
                                                            )
                                                            .responsive
                                                            .recalc()
                                                            .columns
                                                            .adjust();
                                        })
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              isProcessingEdit = false;
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

delete_click = function(id, el) {
          // INSERT LOADER BUTTON
          if (isProcessingDelete) {
                    return;
          }
          isProcessingDelete = true;
          let old_text = $(el).html();
          $(el).html(
                    '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>'
          );

          Swal.fire({
                    title: "Are you sure?",
                    text: "Anda yakin ingin menghapus customer ini...???",
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
                                        url: "<?= base_url() ?>action/delete-data-customer",
                                        data: {
                                                  "id": id,
                                        },
                                        success: function(data) {
                                                  Swal.fire({
                                                            title: "Deleted!",
                                                            text: "Your file has been deleted.",
                                                            icon: "success",
                                                            confirmButtonColor: "#3085d6",
                                                  });
                                                  table.ajax.reload(null,
                                                                      false
                                                            )
                                                            .responsive
                                                            .recalc()
                                                            .columns
                                                            .adjust();
                                        },
                              });
                    }
                    isProcessingDelete = false;
                    $(el).html(old_text);
          });
}
</script>

<?php $this->endSection(); ?>