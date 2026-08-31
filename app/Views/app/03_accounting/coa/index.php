<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          <h6 class="fw-semibold mb-0">List Chart of Account (COA)</h6>
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
                    <li class="fw-medium"> <a href="<?= base_url() ?>admin/accounting/coa"
                                        class="d-flex align-items-center gap-1 hover-text-primary">
                                        <iconify-icon icon="cuida:hashtag-outline" class="icon text-lg">
                                        </iconify-icon>
                                        List Chart of Account (COA)
                              </a>
                    </li>
          </ul>
</div>


<div class="card">
          <div class="card-header  d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex align-items-center justify-content-end mb-2 gap-2 search-data">
                              <div class="icon-field">
                                        <input type="text" name="#0" class="form-control form-control-sm w-auto"
                                                  placeholder="Search" id="searchdatainvoice">
                                        <span class="icon">
                                                  <iconify-icon icon="ion:search-outline"></iconify-icon>
                                        </span>
                              </div>

                    </div>
                    <a onclick="add_click(this)" class="btn btn-sm btn-primary-600"><i class="ri-add-line"></i>
                              <span class="d-none d-sm-inline-block">Buat Account</span></a>
          </div>
          <div class="card-body py-0 py-4 pb-4" id="table">
                    <table id="data-table-invoice" class="table bordered-table " style="width:97%">
                              <thead>
                                        <tr>
                                                  <th scope="col">Kode</th>
                                                  <th scope="col">Nama</th>
                                                  <th scope="col">Kategori</th>
                                                  <th scope="col">Tipe Akun</th>
                                                  <th scope="col">Deskripsi</th>
                                                  <th scope="col"></th>
                                        </tr>
                              </thead>
                              <tbody>
                              </tbody>
                    </table>
          </div>
</div>


<div id='view-container'></div>
<div id="modal-message"></div>

<script src="https://unpkg.com/@panzoom/panzoom@4.6.0/dist/panzoom.min.js"></script>
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
          //     url: "<?= base_url()?>datatables/get-data-project/invoice", 
          //     data:{  
          //         "search" : $("#searchdatainvoice").val(), 
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
          //                 confirmButtonColor: "#3085d6", 
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
          //             confirmButtonColor: "#3085d6", 
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

var paging = 1;
var table;

// FILTER SEARCH
$("#searchdatainvoice").keyup(function() {
          //loader_datatable(); 
          table.ajax.reload(null, false);
})
// function load_paging(i){
//     paging = i;
//     //loader_datatable(); 
//     table.ajax.reload(null, false);
// }

//loader_datatable();
table = $('#data-table-invoice').DataTable({
          "searching": false,
          "lengthChange": false,
          "paging": false,
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
                    "url": "<?= base_url()?>datatables/get-datatable-acc-coa",
                    "type": "POST",
                    "data": function(data) {
                              data["search"] = $("#searchdatainvoice").val();
                    }
          },
          "initComplete": function(settings, json) {
                    $("#data-table-invoice").wrap(
                              "<div style='overflow:auto; width:100%;position:relative; height:60vh'></div>"
                    );
                    $('[data-bs-toggle="tooltip"]').tooltip();
          },

          "columns": [{
                              data: "kode_akun",
                              width: "100px",
                    },
                    {
                              data: "nama_akun",
                              width: "100px",
                    }, {
                              data: "kategori",
                              width: "100px",
                    }, {
                              data: "saldo_normal",
                              width: "100px",
                    },
                    {
                              data: "keterangan",
                              width: "150px",
                    }, {
                              data: "action",
                              orderable: false,
                              className: "action-td",
                              width: "60px"
                    },
          ],
          "footerCallback": function(row, data, start, end, display) {
                    // Tambahkan CSS styling untuk membuat footer tetap terlihat
                    $(row).css({
                              "position": "sticky",
                              "bottom": "0",
                              "background-color": "#fff"
                    });
          }
});

table.on('draw.dt', function() {
          var info = table.page.info();
          if (info.page + 1 > info.pages && info.pages > 0) {
                    table.page('last').draw('page');
          }

          $('[data-bs-toggle="tooltip"]').tooltip();
});
table.on('click', '.btn-detail-item', function() {
          console.log("klik detail");
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
          }
          $('[data-bs-toggle="tooltip"]').tooltip();
});

function format(data) {
          return data.detail;
}

cb(start, end);
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
$("#btn-comment-sph").click(function(i) {
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
</script>


<div style="margin-bottom: 100px;"></div>


<?php $this->endSection(); ?>