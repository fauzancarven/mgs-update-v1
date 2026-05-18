<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          <h6 class="fw-semibold mb-0 d-flex align-items-center">
                    <a href="<?= base_url() ?>admin/sales/invoice" class=" pe-3 d-inline-block" id="btn-back-page">
                              <iconify-icon icon="iconoir:arrow-left" class="icon  ">
                              </iconify-icon>
                    </a>Ubah Pengiriman
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
                                                            <input type="text" id="DeliveryDate"
                                                                      class="form-control form-control-sm"
                                                                      placeholder="Enter First Name">
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Admin</label>
                                                  <div class="col-sm-10">
                                                            <select class="form-select form-select-sm"
                                                                      style="width:100%" id="DeliveryAdmin">
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Armada</label>
                                                  <div class="col-sm-10">
                                                            <input type="text" id="armada"
                                                                      class="form-control form-control-sm"
                                                                      placeholder="Masukan Armada / No Kendaraan">
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Ritase</label>
                                                  <div class="col-sm-10">
                                                            <div class="input-group">
                                                                      <span
                                                                                class="input-group-text font-std bg-base">RIT</span>
                                                                      <input type="text"
                                                                                class="form-control form-control-sm  input-form d-inline-block"
                                                                                id="ritase" value="1">
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Biaya</label>
                                                  <div class="col-sm-10">
                                                            <div class="input-group">
                                                                      <span
                                                                                class="input-group-text font-std bg-base">Rp.</span>
                                                                      <input type="text"
                                                                                class="form-control form-control-sm  input-form d-inline-block hargajual"
                                                                                id="biayapengiriman" value="0">
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
                                                            <iconify-icon icon="lucide:plane-takeoff" class="menu-icon">
                                                            </iconify-icon>Pengirim
                                                  </h6>
                                        </div>
                              </div>
                              <div class="card-body">
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Nama</label>
                                                  <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-sm"
                                                                      id="FromName"
                                                                      value="<?= $delivery->DeliveryFromName?>">
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Telp</label>
                                                  <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-sm"
                                                                      id="FromTelp"
                                                                      value="<?= $delivery->DeliveryFromTelp ?>">
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Alamat</label>
                                                  <div class="col-sm-10">
                                                            <textarea name="#0" class="form-control" rows="2" cols="50"
                                                                      id="FromAddress"><?= $delivery->DeliveryFromAddress ?></textarea>
                                                  </div>
                                        </div>
                              </div>
                    </div>
                    <div class="card mt-8">
                              <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                                  <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                                                            <iconify-icon icon="lucide:plane-landing" class="menu-icon">
                                                            </iconify-icon>Penerima
                                                  </h6>
                                        </div>
                              </div>
                              <div class="card-body">
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Nama</label>
                                                  <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-sm"
                                                                      id="ToName"
                                                                      value="<?= $delivery->DeliveryToName ?>">
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Telp</label>
                                                  <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-sm"
                                                                      id="ToTelp"
                                                                      value="<?= $delivery->DeliveryToTelp ?>">
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Alamat</label>
                                                  <div class="col-sm-10">
                                                            <textarea name="#0" class="form-control" rows="2" cols="50"
                                                                      id="ToAddress"><?= $delivery->DeliveryToAddress ?></textarea>
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
          <div class="col-lg-12">
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
                                                                      style="width:100%" id="DeliveryTemplate">
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
                                                            <button type="button" id="btn-add-delivery"
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


<div id="modal-optional"></div>
<script>
$(document).ready(function() {
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
</script>
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

$('#DeliveryDate').daterangepicker({
          "singleDatePicker": true,
          "startDate": moment('<?= $delivery->DeliveryDate ?>'),
          "endDate": moment('<?= $delivery->DeliveryDate ?>'),
          locale: {
                    format: 'DD MMMM YYYY'
          }
});

$("#StoreId").select2({
          placeholder: "Pilih Toko",
          ajax: {
                    url: "<?= base_url()?>select2 / get - data - store ",
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
$('#StoreId').append(new Option("<?=$delivery->StoreCode. " - " . $delivery->StoreName ?>",
          "<?=$delivery->StoreId?>", true, true)).trigger('change');

$("#DeliveryAdmin").select2({
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
$('#DeliveryAdmin').append(new Option("<?=$delivery->code. " - " . $delivery->username ?>",
          "<?=$delivery->DeliveryAdmin?>", true, true)).trigger('change');
$('#armada').val("<?=$delivery->DeliveryArmada ?>");
$('#ritase').val("<?=$delivery->DeliveryRitase ?>");
$('#biayapengiriman').val("<?=$delivery->DeliveryTotal ?>");

var inputbiayapengiriman = new Cleave(`#biayapengiriman`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var inputritase = new Cleave(`#ritase`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});

var data_detail_item = JSON.parse('<?= JSON_ENCODE($detail,true) ?>');
var table_Inv_item = new tableItemDelivery("table-list", {
          dataitem: data_detail_item,
          baseUrl: "<?= base_url() ?>",
          modal: $('#modal-add-invoice')
});
var quill = [];
$(".template-footer").each(function(index, el) {
          var message = $(el).find("[name='EditFooterMessage']")[0];
          var type = "pengiriman";
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
          quill[type].setContents(JSON.parse(
                    <?= JSON_ENCODE($delivery->TemplateFooterDelta)?>
          ));
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
                                        'var(--white)'; // warna enable
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
          $(selectoption).append(new Option(
                    "<?=$delivery->TemplateFooterName ?>",
                    "<?=$delivery->TemplateFooterId?>",
                    true, true)).trigger('change');

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
                                                                      '#F7F7F7'; // warna disable    
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
                                                                      'var(--bg-white)'; // warna enable
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
                    $("#modal-add-delivery").modal("hide");
                    Swal.fire({
                              title: 'Simpan Template',
                              input: 'text',
                              buttonsStyling: false,
                              showCancelButton: true,
                              showCancelButton: true,
                              customClass: {
                                        confirmButton: 'btn btn-primary-600mx-1',
                                        cancelButton: 'btn btn-secondary mx-1',
                                        loader: 'custom-loader',
                                        input: 'form-control form-control-sm w-auto input-form', // Tambahkan kelas pada input
                              },
                              backdrop: true,
                              confirmButtonText: "Simpan",
                              loaderHtml: '<div class="spinner-border text-primary"></div>',
                              preConfirm: async (
                                        name) => {
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
                                                                                          '#F7F7F7'; // warna disable    
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
                                        false);
                              quill[type].root
                                        .style
                                        .background =
                                        '#F7F7F7'; // warna disable    
                              $("#modal-add-delivery")
                                        .modal(
                                                  "show");
                    });
          })
          $(btnedit).click(function() {

                    $(btnsave).show();
                    $(btnsaveas).show();
                    $(btnedit).hide();

                    quill[type].enable(true);
                    quill[type].root.style.background =
                              "var(--bg-color)"; // warna enable

          })
});


$("#btn-add-delivery").click(function() {
          if ($($(".template-footer").find("select")[0]).val() == null) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Template harus dipilih...!!!',
                              confirmButtonColor: "#3085d6",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $($(".template-footer").find(
                                                  "select")[
                                                  0]).select2("open"),
                                        300);
                    });
                    return;
          }
          if (data_detail_item.some((item) => item.type === "product") == false) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Produk harus dimasukan...!!!',
                              confirmButtonColor: "#3085d6",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#btn-add-product").trigger(
                                        "click"), 300);
                    });
                    return;
          }
          if (data_detail_item.some((item) => item.satuan_id === "0") == true) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Data produk ada yang belum lengkap ...!!!',
                              confirmButtonColor: "#3085d6",
                    }).then(function() {
                              swal.close();
                    });
                    return;
          }
          if (data_detail_item.map((obj) => obj.pengiriman).reduce((a, b) => a + b, 0) == 0) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Qty pengiriman belum lengkap ...!!!',
                              confirmButtonColor: "#3085d6",
                    }).then(function() {
                              swal.close();
                    });
                    return;
          }
          if ($("#DeliveryAdmin").val() == null) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Admin belum dipilih...!!!',
                              confirmButtonColor: "#3085d6",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#DeliveryAdmin").select2(
                                                  "open"),
                                        300);
                    });
                    return;
          }
          if ($("#armada").val() == "") {
                    Swal.fire({
                              icon: 'error',
                              text: 'Armada belum dimasukan...!!!',
                              confirmButtonColor: "#3085d6",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#armada").focus(), 300);
                    });
                    return;
          }
          if ($("#ritase").val() == "") {
                    Swal.fire({
                              icon: 'error',
                              text: 'Ritasi belum diisi...!!!',
                              confirmButtonColor: "#3085d6",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#ritase").focus(), 300);
                    });
                    return;
          }


          var header = {
                    DeliveryDate: $("#DeliveryDate").data('daterangepicker').startDate
                              .format("YYYY-MM-DD"),
                    StoreId: $("#StoreId").val(),
                    DeliveryAdmin: $("#DeliveryAdmin").val(),
                    DeliveryArmada: $("#armada").val(),
                    DeliveryRitase: $("#ritase").val(),
                    DeliveryTotal: $("#biayapengiriman").val().replace(/[^0-9]/g, ''),
                    DeliveryFromName: $("#FromName").val(),
                    DeliveryFromTelp: $("#FromTelp").val(),
                    DeliveryFromAddress: $("#FromAddress").val(),
                    DeliveryToName: $("#ToName").val(),
                    DeliveryToTelp: $("#ToTelp").val(),
                    DeliveryToAddress: $("#ToAddress").val(),
                    TemplateId: $($(".template-footer").find("select")[0]).val(),
          }
          var detail = [];
          for (var i = 0; data_detail_item.length > i; i++) {
                    if (data_detail_item[i]["type"] == "product") {
                              detail.push({
                                        ProdukId: data_detail_item[i][
                                                  "produkid"
                                        ],
                                        DeliveryDetailText: data_detail_item[i][
                                                  "text"
                                        ],
                                        DeliveryDetailType: data_detail_item[i][
                                                  "type"
                                        ],
                                        DeliveryDetailSatuanId: data_detail_item[
                                                  i]["satuan_id"],
                                        DeliveryDetailSatuanText: data_detail_item[
                                                  i]["satuan_text"],
                                        DeliveryDetailGroup: data_detail_item[i]
                                                  ["group"],
                                        DeliveryDetailVarian: data_detail_item[
                                                  i]["varian"],
                                        DeliveryDetailQty: data_detail_item[i][
                                                  "qty"
                                        ],
                                        DeliveryDetailQtySpare: data_detail_item[
                                                  i]["qty_spare"],
                              });
                    }
          }

          $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/edit-data-delivery/<?=$delivery->DeliveryId?>",
                    data: {
                              "header": header,
                              "detail": detail,
                    },
                    success: function(data) {
                              //console.log(data); 
                              if (data["status"] === true) {
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