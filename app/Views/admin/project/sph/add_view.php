<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>

<script>
class tableItem {
          constructor(elementId, options = {}) {
                    this.elementId = elementId;
                    this.dataitem = options.dataitem || [];
                    this.baseUrl = options.baseUrl || "";
                    this.dropdownParent = options.dropdownParent || $(`#${this.elementId}`);
                    this.modalel = options.modal || $(`#${this.elementId}`);
                    this.eventHandlers = {};
                    this.getDataRow();
                    this.render();
          }
          on(eventName, callback) {
                    if (!this.eventHandlers[eventName]) {
                              this.eventHandlers[eventName] = [];
                    }
                    this.eventHandlers[eventName].push(callback);
          }
          trigger(eventName, data) {
                    if (this.eventHandlers[eventName]) {
                              this.eventHandlers[eventName].forEach(callback => {
                                        callback(data);
                              });
                    }
          }
          addDataRow(arr) {
                    this.dataitem.push(arr);
          }
          saveEditableInput(index) {
                    var data_value = $("#" + this.elementId + " .text-custom-input[data-id='" + index + "']")
                              .val();
                    $("#" + this.elementId + " .span-custom-input[data-id='" + index + "']").html(data_value
                              .replaceAll(/\n/g, '<br>'));
                    $("#" + this.elementId + " .text-custom-input[data-id='" + index + "']").hide();
                    $("#" + this.elementId + " .span-custom-input[data-id='" + index + "']").show();
                    $("#" + this.elementId + " .btn-action.detail[data-id='" + index + "'][data-type='edit']")
                              .show();
                    $("#" + this.elementId + " .btn-action.detail[data-id='" + index + "'][data-type='save']")
                              .hide();

                    this.dataitem[index]["text"] = data_value;
          }
          getDataRow() {
                    return this.dataitem;
          }
          getSubTotal() {
                    var totalitem = this.dataitem.reduce((acc, current) => acc + current.price * current.qty,
                              0);
                    var totaldiscitem = this.dataitem.reduce((acc, current) => acc + current.disc * current
                              .qty, 0);
                    var data = {
                              "totalitem": totalitem,
                              "totaldiscitem": totaldiscitem
                    }
                    this.trigger("subtotal", data);
                    return data;
          }
          customColor(number) {
                    switch (number) {
                              case 0:
                                        return 'bg-info-focus text-primary-600 border border-primary-600';
                                        break;
                              case 1:
                                        return 'bg-lilac-focus text-lilac-600 border border-lilac-600 ';
                                        break;
                              case 2:
                                        return 'bg-warning-focus text-warning-600  border border-warning-600 ';
                                        break;
                              case 3:
                                        return 'bg-danger-focus text-danger-600 border border-danger-600';
                                        break;
                              case 4:
                                        return 'bg-info-focus text-primary-600';
                                        break;

                              default:
                                        break;
                    }
          }
          loadDatahtml() {
                    try {
                              if (this.dataitem.length === 0) {
                                        return `<div class="d-flex justify-content-center flex-column align-items-center">
                <img src="${this.baseUrl}assets/images/empty.png" alt="" style="width:150px;height:150px;">
                <span class="text-head-1">Item belum ditambahkan</span>
                </div>`;
                              } else {
                                        var html = '';
                                        var last_group_abjad = 65;
                                        var last_group_no = 1;
                                        for (var i = 0; this.dataitem.length > i; i++) {
                                                  var data_value = this.dataitem[i]["text"];
                                                  if (this.dataitem[i]["type"] == "category") {
                                                            html += `
                            <div class="row align-items-center mx-0 hr p-8">
                                <div class="col-12 col-md-6 px-0">      
                                    <div class="d-flex">   
                                        <span class="no-urut text-head-3 order-md-2 order-1 p-8 ms-16 me-4">${String.fromCharCode(last_group_abjad)}. </span>  
                                        <div class="d-flex flex-column text-start flex-fill order-md-3 order-2 justify-content-center">
                                            <span class="text-head-3 fw-medium span-custom-input px-9"  data-id="${i}">${data_value.replaceAll(/\n/g, '<br>')}</span>
                                            <textarea class="text-custom-input px-8 py-0" data-id="${i}" style="display:none" rows="1">${this.dataitem[i]["text"].replace(/<br>/g, '\n')}</textarea> 
                                        </div>  
                                        <div class="px-0 order-md-1 order-3"> 
                                            <div class="d-flex">
                                                <i class="cursor-pointer ri-arrow-up-fill text-primary-600 btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="up"></i>
                                                <i class="cursor-pointer ri-arrow-down-fill text-primary-600  btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="down"></i>
                                                <i class="cursor-pointer ri-close-fill text-danger-500  btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="delete"></i>
                                                <i class="cursor-pointer ri-edit-fill text-warning-500 btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="edit"></i>
                                                <i class="cursor-pointer ri-save-fill text-success-500 btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="save" style="display: none;"></i>
                                            </div> 
                                        </div>   
                                    </div> 
                                </div> 
                            </div>`;
                                                            last_group_abjad++;
                                                            last_group_no = 1;
                                                  }
                                                  if (this.dataitem[i]["type"] == "product") {
                                                            var varian = "";
                                                            if (this.dataitem[i]["id"] != "0") {
                                                                      varian = `  <span class="text-detail-2 text-truncate text-primary-600 text-xs px-9">${this.dataitem[i]["group"]}</span> 
                                        <div class="d-flex gap-1 flex-wrap px-9">`;
                                                                      for (var j = 0; this.dataitem[i][
                                                                                          "varian"
                                                                                ].length > j; j++) {
                                                                                var custom = this.customColor(
                                                                                          j %
                                                                                          5);
                                                                                varian +=
                                                                                          `<span class="${custom} radius-4 px-8 py-4 text-xs line-height-1 badge-${j % 5}">${this.dataitem[i]["varian"][j]["varian"] + ": " + this.dataitem[i]["varian"][j]["value"]}</span>`;
                                                                      }
                                                                      varian += '</div>';
                                                            }
                                                            html += `   
                            <div class="row align-items-center mx-0 hr p-8">
                                        <div class="col-12 col-md-6 my-1 varian px-0">   
                                            <div class="d-flex">
                                                <div class="px-0 order-md-1 order-4"> 
                                                    <div class="d-flex">
                                                        <i class="cursor-pointer ri-arrow-up-fill text-primary-600 btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="up"></i>
                                                        <i class="cursor-pointer ri-arrow-down-fill text-primary-600  btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="down"></i>
                                                        <i class="cursor-pointer ri-close-fill text-danger-500  btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="delete"></i>
                                                        <i class="cursor-pointer ri-edit-fill text-warning-500 btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="edit"></i>
                                                        <i class="cursor-pointer ri-save-fill text-success-500 btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="save" style="display: none;"></i>
                                                    </div> 
                                                </div> 
                                                <span class="no-urut text-head-3 order-md-2 order-1 p-8  ms-24 me-2">${last_group_no}. </span> 
                                                <div class="d-flex pe-8 order-md-3 order-2 ${this.dataitem[i]["id"] == "0" ? "d-none" : ""}">
                                                    <img src="${this.dataitem[i]["image_url"]}" alt="Gambar" class="w-80-px h-80-px radius-8 object-fit-cover"> 
                                                </div> 
                                                <div class="d-flex flex-column text-start flex-fill order-md-4 order-3 justify-content-center">
                                                    <span class="text-md mb-0 fw-medium span-custom-input px-9"  data-id="${i}">${data_value.replaceAll(/\n/g, '<br>')}</span>
                                                    <textarea class="text-custom-input px-8 py-0" data-id="${i}" style="display:none" rows="1">${this.dataitem[i]["text"].replace(/<br>/g, '\n')}</textarea>
                                                    ${varian} 
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 my-1 detail">
                                            <div class="row px-2">  
                                                <div class="col-12 col-md-4 px-1 ">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty/Satuan</span>
                                                    <div class="input-group"> 
                                                        <input type="text" class="form-control form-control-sm input-form berat" id="input-qty-${i}" data-id="${i}">
                                                        <select class="form-select form-select-sm select-satuan" id="select-satuan-${i}" data-id="${i}" placeholder="Pilih" ${this.dataitem[i]["id"] != "-" ? "" : ""}></select>
                                                    </div>  
                                                </div>  
                                                <div class="col-12 col-md-8">  
                                                    <div class="row">  
                                                        <div class="col-6 col-md-4 px-1">  
                                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Harga</span>
                                                            <div class="input-group">
                                                                <span class="input-group-text bg-base p-1">
                                                                    Rp.
                                                                </span>
                                                                <input type="text" class="form-control form-control-sm  input-form d-inline-block text-start p-1"  id="input-harga-${i}" data-id="${i}" ${this.dataitem[i]["id"] != "0" ? "" : ""}>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4  px-1">  
                                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Diskon</span>
                                                            <div class="input-group">   
                                                                <span class="input-group-text bg-base p-1">
                                                                    Rp.
                                                                </span>
                                                                <input type="text" class="p-1 form-control form-control-sm  input-form d-inline-block hargabeli text-start" id="input-disc-${i}" data-id="${i}">
                                                            </div>   
                                                        </div> 
                                                        <div class="col-12 col-md-4  px-1">  
                                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start ">Total</span>
                                                            <div class="input-group"> 
                                                                <span class="input-group-text bg-base p-1">
                                                                    Rp.
                                                                </span>
                                                                <input type="text" class="p-1 form-control form-control-sm  input-form d-inline-block hargajual text-start" id="input-total-${i}" data-id="${i}" readonly>
                                                            </div>     
                                                        </div> 
                                                    </div>   
                                                </div>   
                                            </div>    
                                        </div>    
                                    </div> `;
                                                            last_group_no++;
                                                  }
                                        }
                                        return html;
                              }
                    } catch (error) {}
          }
          setupDatahtml() {
                    var self = this;
                    var inputqty = [];
                    var inputharga = [];
                    var inputtotal = [];
                    var inputdisc = [];

                    for (var i = 0; self.dataitem.length > i; i++) {
                              if (self.dataitem[i]["type"] == "product") {

                                        function total_harga(id) {
                                                  var total = (inputharga[id].getRawValue() - inputdisc[id]
                                                                      .getRawValue()) * inputqty[id]
                                                            .getRawValue();
                                                  self.dataitem[id]["total"] = total;
                                                  inputtotal[id].setRawValue(total);
                                                  self.getSubTotal();
                                        }

                                        //event qty
                                        inputqty[i] = new Cleave(`#input-qty-${i}`, {
                                                  numeral: true,
                                                  delimeter: ",",
                                                  numeralDecimalScale: 3,
                                                  numeralThousandGroupStyle: "thousand"
                                        });
                                        inputqty[i].setRawValue(self.dataitem[i]["qty"]);
                                        $(`#input-qty-${i}`).on("keyup", function() {
                                                  self.dataitem[$(this).data("id")][
                                                                      "qty"
                                                            ] = inputqty[$(this)
                                                                      .data("id")]
                                                            .getRawValue();
                                                  if ($(`#input-qty-${i}`).val() == "") $(
                                                                      `#input-qty-${i}`)
                                                            .val(0)
                                                  total_harga($(this).data("id"));
                                        });

                                        //event satuan
                                        $(`#select-satuan-${i}`).select2({
                                                  placeholder: "pilih",
                                                  width: 'auto',
                                                  adaptContainerWidth: true,
                                                  ajax: {
                                                            url: self.baseUrl +
                                                                      "select2/get-data-produk-satuan",
                                                            dataType: 'json',
                                                            type: "POST",
                                                            delay: 250,
                                                            data: function(params) {
                                                                      // CSRF Hash
                                                                      var csrfName =
                                                                                $(
                                                                                          '.txt_csrfname'
                                                                                )
                                                                                .attr(
                                                                                          'name'
                                                                                ); // CSRF Token name
                                                                      var csrfHash =
                                                                                $(
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
                                                            processResults: function(
                                                                      response
                                                            ) {

                                                                      // Update CSRF Token
                                                                      $('.txt_csrfname')
                                                                                .val(response
                                                                                          .token
                                                                                );

                                                                      return {
                                                                                results: response
                                                                                          .data
                                                                      };
                                                            },
                                                            cache: true
                                                  },
                                                  language: {
                                                            noResults: function() {
                                                                      return $("<button class=\"btn btn-sm btn-primary\" onclick=\"select_satuan_add()\">Tambah <b>" +
                                                                                $(
                                                                                          `#select-satuan-${i}`
                                                                                )
                                                                                .data(
                                                                                          'select2'
                                                                                )
                                                                                .dropdown
                                                                                .$search[
                                                                                          0
                                                                                ]
                                                                                .value +
                                                                                "</b></button>"
                                                                      );
                                                            }
                                                  },
                                                  formatResult: select2OptionFormat,
                                                  formatSelection: select2OptionFormat,
                                                  escapeMarkup: function(m) {
                                                            return m;
                                                  }
                                        }).on("select2:select", function(e) {
                                                  var data = e.params.data;
                                                  self.dataitem[$(this).data("id")][
                                                            "satuan_id"
                                                  ] = data.id
                                                  self.dataitem[$(this).data("id")][
                                                            "satuan_text"
                                                  ] = data.text
                                        });
                                        if (self.dataitem[i]["satuan_id"] > 0) $(`#select-satuan-${i}`)
                                                  .append(new Option(self.dataitem[i]["satuan_text"], self
                                                            .dataitem[i]["satuan_id"], true, true)).trigger(
                                                            'change');
                                        if (self.dataitem[i]["id"] === "0") $(`#select-satuan-${i}`).prop(
                                                  "disabled", false)
                                        //event harga
                                        inputharga[i] = new Cleave(`#input-harga-${i}`, {
                                                  numeral: true,
                                                  delimeter: ",",
                                                  numeralDecimalScale: 0,
                                                  numeralThousandGroupStyle: "thousand"
                                        });
                                        inputharga[i].setRawValue(self.dataitem[i]["price"]);
                                        $(`#input-harga-${i}`).on("keyup", function() {
                                                  self.dataitem[$(this).data("id")][
                                                            "price"
                                                  ] = inputharga[$(this).data(
                                                            "id")].getRawValue();
                                                  if ($(`#input-harga-${i}`).val() == "")
                                                            $(`#input-harga-${i}`).val(0)
                                                  total_harga($(this).data("id"));
                                        });
                                        //event disc
                                        inputdisc[i] = new Cleave(`#input-disc-${i}`, {
                                                  numeral: true,
                                                  delimeter: ",",
                                                  numeralDecimalScale: 0,
                                                  numeralThousandGroupStyle: "thousand"
                                        });
                                        inputdisc[i].setRawValue(self.dataitem[i]["disc"]);
                                        $(`#input-disc-${i}`).on("keyup", function() {
                                                  var nilaiSaatIni = parseInt(inputdisc[$(
                                                                                this
                                                                      )
                                                                      .data(
                                                                                "id"
                                                                      )
                                                            ]
                                                            .getRawValue());
                                                  var maksvalue = parseInt(inputharga[$(
                                                                                this
                                                                      )
                                                                      .data(
                                                                                "id"
                                                                      )
                                                            ]
                                                            .getRawValue());
                                                  if (nilaiSaatIni > maksvalue) {
                                                            inputdisc[$(this).data("id")]
                                                                      .setRawValue(
                                                                                maksvalue
                                                                      );
                                                  }
                                                  self.dataitem[$(this).data("id")][
                                                                      "disc"
                                                            ] = inputdisc[
                                                                      $(this).data("id")]
                                                            .getRawValue();

                                                  if ($(`#input-disc-${i}`).val() == "")
                                                            $(`#input-disc-${i}`).val(0)
                                                  total_harga($(this).data("id"));
                                        });

                                        //event total
                                        inputtotal[i] = new Cleave(`#input-total-${i}`, {
                                                  numeral: true,
                                                  delimeter: ",",
                                                  numeralDecimalScale: 0,
                                                  numeralThousandGroupStyle: "thousand"
                                        });
                                        inputtotal[i].setRawValue(self.dataitem[i]["total"]);

                                        total_harga(i);
                              }
                    }
          }
          render() {
                    var self = this;
                    var html = `
            <div class="card p-3" style="min-height:50px;">
            <div class="card-body p-0  ">
                <div class="row align-items-center d-none d-md-flex px-3">
                <div class="col-12 col-md-6 my-1">
                    <div class="row">
                    <div class="col-12">
                        <span class="label-head-dialog">Deskripsi</span>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 my-1">
                    <div class="row">
                    <div class="col-4">
                        <span class="label-head-dialog">Qty | Satuan</span>
                    </div>
                    <div class="col-8">
                        <div class="row">
                        <div class="col-4">
                            <span class="label-head-dialog">Harga</span>
                        </div>
                        <div class="col-4">
                            <span class="label-head-dialog">Diskon Item</span>
                        </div>
                        <div class="col-4">
                            <span class="label-head-dialog">Total</span>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div name="list-data" class="text-center" style="border-top: var(--bg-color) 2.5px solid; border-bottom: var(--bg-color) 2.5px solid;">
                    ${this.loadDatahtml()}
                </div>
                <div class="d-flex justify-content-center flex-column align-items-center">
                <div class="d-flex gap-2 mt-16">
                        <a type="button" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1" name="btn-add-category">
                                    <iconify-icon icon="ic:add" class="text-xl">
                                    </iconify-icon>
                                    Tambah Kategori
                        </a>
                        <a type="button" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1" name="btn-add-product-manual">
                                    <iconify-icon icon="ic:add" class="text-xl">
                                    </iconify-icon>
                                    Tambah Item
                        </a>
                        <a type="button" class="btn btn-sm btn-lilac-600 radius-8 d-inline-flex align-items-center gap-1" name="btn-add-product">
                                    <iconify-icon icon="lucide:search" class="text-xl">
                                    </iconify-icon>
                                    Cari Produk
                        </a>
                </div> 
                </div>
            </div>
            </div>
        `;
                    try {
                              $("#" + this.elementId).html(html);
                    } catch (error) {
                              console.log(error);
                    }
                    this.setupDatahtml()

                    //master add button
                    var isProcessingSphAddproduk = false;
                    $("#" + this.elementId + " a[name='btn-add-product']").click(function() {
                              var elem = $(this);
                              if (isProcessingSphAddproduk) {
                                        console.log("add-product cancel load");
                                        return;
                              }
                              isProcessingSphAddproduk = true;
                              var old_text = $(elem).html();
                              $(elem).html(
                                        '<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>'
                              );

                              $.ajax({
                                        method: "POST",
                                        url: self.baseUrl +
                                                  "message/select-produk",
                                        success: function(data) {
                                                  isProcessingSphAddproduk
                                                            =
                                                            false;
                                                  $(elem).html(
                                                            old_text
                                                  );
                                                  $("#modal-optional")
                                                            .html(
                                                                      data
                                                            );
                                                  self.modalel
                                                            .modal(
                                                                      "hide"
                                                            );
                                                  $("#modal-select-item")
                                                            .modal(
                                                                      "show"
                                                            );

                                                  // Membuat event emitter
                                                  $(document)
                                                            .on("select_produk",
                                                                      function(event,
                                                                                data
                                                                      ) {
                                                                                if (data.id ===
                                                                                          undefined
                                                                                )
                                                                                          return;

                                                                                for (var i =
                                                                                                    0; self
                                                                                          .dataitem
                                                                                          .length >
                                                                                          i; i++
                                                                                ) {
                                                                                          if (data.id ==
                                                                                                    0
                                                                                          )
                                                                                                    continue
                                                                                          if (self.dataitem[
                                                                                                              i
                                                                                                    ]
                                                                                                    [
                                                                                                              "type"
                                                                                                    ] ==
                                                                                                    "product"
                                                                                          ) {
                                                                                                    var arr1 = self
                                                                                                              .dataitem[
                                                                                                                        i
                                                                                                              ]
                                                                                                              [
                                                                                                                        "varian"
                                                                                                              ];
                                                                                                    var arr2 = data
                                                                                                              .varian;
                                                                                                    arr1.sort((a, b) => a
                                                                                                              .varian
                                                                                                              .localeCompare(
                                                                                                                        b
                                                                                                                        .varian
                                                                                                              )
                                                                                                    );
                                                                                                    arr2.sort((a, b) => a
                                                                                                              .varian
                                                                                                              .localeCompare(
                                                                                                                        b
                                                                                                                        .varian
                                                                                                              )
                                                                                                    );
                                                                                          }
                                                                                          if (JSON.stringify(
                                                                                                              arr1
                                                                                                    ) ===
                                                                                                    JSON
                                                                                                    .stringify(
                                                                                                              arr2
                                                                                                    ) &&
                                                                                                    self
                                                                                                    .dataitem[
                                                                                                              i
                                                                                                    ]
                                                                                                    [
                                                                                                              "produkid"
                                                                                                    ] ===
                                                                                                    data
                                                                                                    .produkid
                                                                                          ) {
                                                                                                    Swal.fire({
                                                                                                              icon: 'error',
                                                                                                              text: "Item sudah ada !!!",
                                                                                                              confirmButtonColor: "var(--brand)",
                                                                                                    });
                                                                                                    return;
                                                                                          }
                                                                                }

                                                                                data["type"] =
                                                                                          "product";
                                                                                self.addDataRow(
                                                                                          data
                                                                                )
                                                                                $("#modal-select-item")
                                                                                          .modal(
                                                                                                    "hide"
                                                                                          );
                                                                                self
                                                                                          .render();
                                                                      }
                                                            );

                                                  $('#modal-select-item')
                                                            .on('hidden.bs.modal',
                                                                      function() {
                                                                                if (document
                                                                                          .activeElement
                                                                                ) {
                                                                                          document.activeElement
                                                                                                    .blur();
                                                                                }
                                                                                self.modalel
                                                                                          .modal(
                                                                                                    "show"
                                                                                          );

                                                                                $(document)
                                                                                          .off(
                                                                                                    "select_produk"
                                                                                          );
                                                                      }
                                                            );

                                                  // //membuat event click dari modal sebelumnya
                                                  // $("#btn-add-item").click(function(event){
                                                  //     event.preventDefault(); 
                                                  //     if($("#select-produk").val() == null){
                                                  //         Swal.fire({
                                                  //             icon: 'error',
                                                  //             text: 'Item produk harus dipilih atau perlu diinput...!!!', 
                                                  //             confirmButtonColor: "var(--brand)", 
                                                  //         }).then(function(){ 
                                                  //             swal.close();
                                                  //             setTimeout(() => $("#select-produk").select2("open"), 300); 
                                                  //         }) ;
                                                  //         return; 
                                                  //     }    
                                                  //     select_produk(data_select_produk);
                                                  // });
                                        },
                                        error: function(xhr, textStatus,
                                                  errorThrown
                                        ) {
                                                  isProcessingSphAddproduk
                                                            =
                                                            false;
                                                  $(elem).html(
                                                            old_text
                                                  );

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
                    $("#" + this.elementId + " a[name='btn-add-product-manual']").click(function() {
                              self.addDataRow({
                                        "id": 0,
                                        "produkid": 0,
                                        "varian": [],
                                        "text": "produk",
                                        "group": "",
                                        "berat": 0,
                                        "satuan_id": 0,
                                        "satuan_text": "",
                                        "pcsM2": "",
                                        "price": 0,
                                        "disc": 0,
                                        "qty": 1,
                                        "total": 0,
                                        "type": "product",
                                        "image_url": "https://system.mahieraglobalsolution.com/assets/images/produk/default.png"
                              });
                              self.render();
                    });
                    $("#" + this.elementId + " a[name='btn-add-category']").click(function() {
                              self.addDataRow({
                                        type: "category",
                                        text: "Kategori",
                                        qty: 0,
                                        price: 0,
                                        disc: 0,
                                        total: 0,
                                        varian: [],
                              });
                              self.render();
                    });


                    //event Action Button rows and input editable label
                    $("#" + this.elementId + " .span-custom-input").click(function() {
                              var index = $(this).data("id");
                              if (self.dataitem[index]["id"] == 0 || self.dataitem[index][
                                                  "type"
                                        ] == "category") {
                                        $("#" + self.elementId +
                                                  " .text-custom-input[data-id='" +
                                                  index + "']").show();
                                        $(this).hide();
                                        $(".btn-action.detail[data-id='" + index +
                                                  "'][data-type='edit']").hide();
                                        $(".btn-action.detail[data-id='" + index +
                                                  "'][data-type='save']").show();
                              }
                              $("#" + self.elementId + " .text-custom-input[data-id='" +
                                        index + "']").on('input', function() {
                                        $(this).height('auto');
                                        $(this).height(this
                                                  .scrollHeight
                                        );
                              }).on('focusout', function() {
                                        self.saveEditableInput(index)
                              });
                    });
                    $("#" + this.elementId + " .btn-action.detail[data-type='edit']").click(function() {
                              $("#" + self.elementId + " .span-custom-input[data-id='" +
                                        $(this).data("id") + "']").trigger(
                                        "click");
                    })
                    $("#" + this.elementId + " .btn-action.detail[data-type='save']").click(function() {
                              self.saveEditableInput($(this).data("id"));
                    })
                    $("#" + this.elementId + " .btn-action.detail[data-type='delete']").click(function() {
                              self.dataitem.splice($(this).data("id"), 1);
                              self.render()
                    })
                    $("#" + this.elementId + " .btn-action.detail[data-type='up']").click(function() {
                              if ($(this).data("id") > 0) {
                                        var nilaiSementara = self.dataitem[$(this).data(
                                                  "id") - 1];
                                        self.dataitem.splice($(this).data("id") - 1, 1,
                                                  self.dataitem[$(this).data(
                                                            "id")]);
                                        self.dataitem.splice($(this).data("id"), 1,
                                                  nilaiSementara);
                              }
                              self.render()
                    })
                    $("#" + this.elementId + " .btn-action.detail[data-type='down']").click(function() {

                              if ($(this).data("id") < self.dataitem.length - 1) {
                                        var nilaiSementara = self.dataitem[$(this).data(
                                                  "id") + 1];
                                        self.dataitem.splice($(this).data("id") + 1, 1,
                                                  self.dataitem[$(this).data(
                                                            "id")]);
                                        self.dataitem.splice($(this).data("id"), 1,
                                                  nilaiSementara);
                              }
                              self.render()
                    })
          }
}
</script>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          <h6 class="fw-semibold mb-0 d-flex align-items-center">
                    <a href="<?= base_url() ?>admin/sales/penawaran" class=" pe-3 d-inline-block" id="btn-back-page">
                              <iconify-icon icon="iconoir:arrow-left" class="icon  ">
                              </iconify-icon>
                    </a>Tambah Penawaran
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
                    <li class="fw-medium"> <a href="<?= base_url() ?>admin/sales/penawaran"
                                        class="d-flex align-items-center gap-1 hover-text-primary">
                                        <iconify-icon icon="ic:outline-handshake" class="icon text-lg">
                                        </iconify-icon>
                                        List Penawaran
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
                                                            <select class="form-select form-select-sm" id="SphRef"
                                                                      name="SphRef" style="width:100%">
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
                                                            <input type="text" id="SphDate"
                                                                      class="form-control form-control-sm"
                                                                      placeholder="Enter First Name">
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Admin</label>
                                                  <div class="col-sm-10">
                                                            <select class="form-select form-select-sm"
                                                                      style="width:100%" id="SphAdmin">
                                                            </select>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Alamat Project</label>
                                                  <div class="col-sm-10">
                                                            <textarea id="SphProjectAddress" class="form-control"
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
                                                                      id="SphCustName" readonly>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Telp</label>
                                                  <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-sm"
                                                                      id="SphCustTelp" readonly>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <label class="form-label mb-0 col-sm-2">Alamat</label>
                                                  <div class="col-sm-10">
                                                            <textarea name="#0" class="form-control" rows="4" cols="50"
                                                                      id="SphAddress" readonly></textarea>
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
                              <div class="card-body">
                                        <div class="table-responsive scroll-sm d-none">
                                                  <table id="test-item" class="table bordered-table mb-0">
                                                            <thead>
                                                                      <tr>
                                                                                <th scope="col">
                                                                                          #
                                                                                </th>

                                                                                <th scope="col">
                                                                                          No.
                                                                                </th>
                                                                                <th scope="col">
                                                                                          Deskripsi
                                                                                </th>
                                                                                <th scope="col">
                                                                                          Qty | Satuan
                                                                                </th>
                                                                                <th scope="col">
                                                                                          Harga
                                                                                </th>
                                                                                <th scope="col">
                                                                                          Disc
                                                                                </th>
                                                                                <th scope="col">
                                                                                          Total
                                                                                </th>
                                                                      </tr>
                                                            </thead>
                                                            <tbody>
                                                                      <tr data-id="1">
                                                                                <td>
                                                                                          <iconify-icon
                                                                                                    icon="mdi:dots-grid"
                                                                                                    class="menu-icon text-xxl text-secondary-light button-drag">
                                                                                          </iconify-icon>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">1</span>
                                                                                </td>
                                                                                <td>
                                                                                          <div
                                                                                                    class="d-flex align-items-center">
                                                                                                    <img src="<?= base_url() ?>assets/images/produk/31/1.png?2025-11-2409:37:37"
                                                                                                              alt="Image"
                                                                                                              class="flex-shrink-0 me-12 w-80-px h-80-px radius-8 object-fit-cover">
                                                                                                    <div>
                                                                                                              <h6
                                                                                                                        class="text-md mb-0 fw-medium flex-grow-1">
                                                                                                                        Bata
                                                                                                                        Expose
                                                                                                                        Ubin
                                                                                                                        TL

                                                                                                              </h6>
                                                                                                              <span
                                                                                                                        class="text-primary-600 text-xs">
                                                                                                                        Bata
                                                                                                                        Tempel</span>
                                                                                                              <ul
                                                                                                                        class="d-flex flex-wrap align-items-center gap-2">
                                                                                                                        <li
                                                                                                                                  class="bg-info-focus text-primary-600 border border-primary-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Vendor
                                                                                                                                  :
                                                                                                                                  MGS
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-lilac-focus text-lilac-600 border border-lilac-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Ukuran
                                                                                                                                  :
                                                                                                                                  20x20x10cm
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-warning-focus text-warning-600  border border-warning-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Warna
                                                                                                                                  :
                                                                                                                                  Gray
                                                                                                                        </li>
                                                                                                              </ul>
                                                                                                    </div>
                                                                                          </div>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">17
                                                                                                    Pcs</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$0.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$150.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$150.00</span>
                                                                                </td>
                                                                      </tr>
                                                                      <tr data-id="4">
                                                                                <td>
                                                                                          <iconify-icon
                                                                                                    icon="mdi:dots-grid"
                                                                                                    class="menu-icon text-xxl text-secondary-light button-drag">
                                                                                          </iconify-icon>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light"><i
                                                                                                              class="ri-subtract-fill"
                                                                                                              style="transform: rotate(90deg);"></i>1</span>
                                                                                </td>
                                                                                <td>
                                                                                          <div
                                                                                                    class="d-flex align-items-center">
                                                                                                    <img src="<?= base_url() ?>assets/images/produk/31/1.png?2025-11-2409:37:37"
                                                                                                              alt="Image"
                                                                                                              class="flex-shrink-0 me-12 w-80-px h-80-px radius-8 object-fit-cover">
                                                                                                    <div>
                                                                                                              <h6
                                                                                                                        class="text-md mb-0 fw-medium flex-grow-1">
                                                                                                                        Bata
                                                                                                                        Expose
                                                                                                                        Ubin
                                                                                                                        TL

                                                                                                              </h6>
                                                                                                              <span
                                                                                                                        class="text-primary-600 text-xs">
                                                                                                                        Bata
                                                                                                                        Tempel</span>
                                                                                                              <ul
                                                                                                                        class="d-flex flex-wrap align-items-center gap-2">
                                                                                                                        <li
                                                                                                                                  class="bg-info-focus text-primary-600 border border-primary-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Vendor
                                                                                                                                  :
                                                                                                                                  MGS
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-lilac-focus text-lilac-600 border border-lilac-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Ukuran
                                                                                                                                  :
                                                                                                                                  20x20x10cm
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-warning-focus text-warning-600  border border-warning-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Warna
                                                                                                                                  :
                                                                                                                                  Gray
                                                                                                                        </li>
                                                                                                              </ul>
                                                                                                    </div>
                                                                                          </div>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">17
                                                                                                    Pcs</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$0.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$150.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$150.00</span>
                                                                                </td>
                                                                      </tr>
                                                                      <tr data-id="5">
                                                                                <td>
                                                                                          <iconify-icon
                                                                                                    icon="mdi:dots-grid"
                                                                                                    class="menu-icon text-xxl text-secondary-light button-drag">
                                                                                          </iconify-icon>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light"><i
                                                                                                              class="ri-corner-down-right-line"></i>2</span>
                                                                                </td>
                                                                                <td>
                                                                                          <div
                                                                                                    class="d-flex align-items-center">
                                                                                                    <img src="<?= base_url() ?>assets/images/produk/31/1.png?2025-11-2409:37:37"
                                                                                                              alt="Image"
                                                                                                              class="flex-shrink-0 me-12 w-80-px h-80-px radius-8 object-fit-cover">
                                                                                                    <div>
                                                                                                              <h6
                                                                                                                        class="text-md mb-0 fw-medium flex-grow-1">
                                                                                                                        Bata
                                                                                                                        Expose
                                                                                                                        Ubin
                                                                                                                        TL

                                                                                                              </h6>
                                                                                                              <span
                                                                                                                        class="text-primary-600 text-xs">
                                                                                                                        Bata
                                                                                                                        Tempel</span>
                                                                                                              <ul
                                                                                                                        class="d-flex flex-wrap align-items-center gap-2">
                                                                                                                        <li
                                                                                                                                  class="bg-info-focus text-primary-600 border border-primary-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Vendor
                                                                                                                                  :
                                                                                                                                  MGS
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-lilac-focus text-lilac-600 border border-lilac-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Ukuran
                                                                                                                                  :
                                                                                                                                  20x20x10cm
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-warning-focus text-warning-600  border border-warning-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Warna
                                                                                                                                  :
                                                                                                                                  Gray
                                                                                                                        </li>
                                                                                                              </ul>
                                                                                                    </div>
                                                                                          </div>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">17
                                                                                                    Pcs</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$0.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$150.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$150.00</span>
                                                                                </td>
                                                                      </tr>
                                                                      <tr data-id="2">
                                                                                <td>
                                                                                          <iconify-icon
                                                                                                    icon="mdi:dots-grid"
                                                                                                    class="menu-icon text-xxl text-secondary-light button-drag">
                                                                                          </iconify-icon>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">2</span>
                                                                                </td>
                                                                                <td>
                                                                                          <div
                                                                                                    class="d-flex align-items-center">
                                                                                                    <img src="<?= base_url() ?>assets/images/produk/31/1.png?2025-11-2409:37:37"
                                                                                                              alt="Image"
                                                                                                              class="flex-shrink-0 me-12 w-80-px h-80-px radius-8 object-fit-cover">
                                                                                                    <div>
                                                                                                              <h6
                                                                                                                        class="text-md mb-0 fw-medium flex-grow-1">
                                                                                                                        Bata
                                                                                                                        Expose
                                                                                                                        Ubin
                                                                                                                        TL

                                                                                                              </h6>
                                                                                                              <span
                                                                                                                        class="text-primary-600 text-xs">
                                                                                                                        Bata
                                                                                                                        Tempel</span>
                                                                                                              <ul
                                                                                                                        class="d-flex flex-wrap align-items-center gap-2">
                                                                                                                        <li
                                                                                                                                  class="bg-info-focus text-primary-600 border border-primary-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Vendor
                                                                                                                                  :
                                                                                                                                  MGS
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-lilac-focus text-lilac-600 border border-lilac-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Ukuran
                                                                                                                                  :
                                                                                                                                  20x20x10cm
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-warning-focus text-warning-600  border border-warning-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Warna
                                                                                                                                  :
                                                                                                                                  Gray
                                                                                                                        </li>
                                                                                                              </ul>
                                                                                                    </div>
                                                                                          </div>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">19
                                                                                                    Pcs</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$0.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$150.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$150.00</span>
                                                                                </td>
                                                                      </tr>
                                                                      <tr data-id="3">
                                                                                <td>
                                                                                          <iconify-icon
                                                                                                    icon="mdi:dots-grid"
                                                                                                    class="menu-icon text-xxl text-secondary-light button-drag">
                                                                                          </iconify-icon>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">3</span>
                                                                                </td>
                                                                                <td>
                                                                                          <div
                                                                                                    class="d-flex align-items-center">
                                                                                                    <img src="<?= base_url() ?>assets/images/produk/31/1.png?2025-11-2409:37:37"
                                                                                                              alt="Image"
                                                                                                              class="flex-shrink-0 me-12 w-80-px h-80-px radius-8 object-fit-cover">
                                                                                                    <div>
                                                                                                              <h6
                                                                                                                        class="text-md mb-0 fw-medium flex-grow-1">
                                                                                                                        Bata
                                                                                                                        Expose
                                                                                                                        Ubin
                                                                                                                        TL

                                                                                                              </h6>
                                                                                                              <span
                                                                                                                        class="text-primary-600 text-xs">
                                                                                                                        Bata
                                                                                                                        Tempel</span>
                                                                                                              <ul
                                                                                                                        class="d-flex flex-wrap align-items-center gap-2">
                                                                                                                        <li
                                                                                                                                  class="bg-info-focus text-primary-600 border border-primary-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Vendor
                                                                                                                                  :
                                                                                                                                  MGS
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-lilac-focus text-lilac-600 border border-lilac-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Ukuran
                                                                                                                                  :
                                                                                                                                  20x20x10cm
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                                  class="bg-warning-focus text-warning-600  border border-warning-600 radius-4 px-8 py-4 text-xs line-height-1  ">
                                                                                                                                  Warna
                                                                                                                                  :
                                                                                                                                  Gray
                                                                                                                        </li>
                                                                                                              </ul>
                                                                                                    </div>
                                                                                          </div>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">20
                                                                                                    Pcs</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$0.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$150.00</span>
                                                                                </td>
                                                                                <td>
                                                                                          <span
                                                                                                    class="text-secondary-light">$2000.00</span>
                                                                                </td>
                                                                      </tr>
                                                            </tbody>
                                                  </table>
                                        </div>
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
                                                                      style="width:100%" id="SphTemplate">
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
                                                                                id="SphSubTotal" value="0">
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
                                                                                id="SphDiscItemTotal" value="0">
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
                                                                                id="SphDiscTotal" value="0">
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="row mb-8 gy-2 align-items-center">
                                                  <div
                                                            class="form-check style-check d-flex align-items-center col-sm-4">
                                                            <input class="form-check-input ms-10" type="checkbox"
                                                                      value="" id="SphDelivery">
                                                            <label class="form-check-label" for="SphDelivery">
                                                                      Pengiriman
                                                            </label>
                                                  </div>
                                                  <div class="col-sm-8">
                                                            <div class="input-group">
                                                                      <span class="input-group-text bg-base">
                                                                                Rp.
                                                                      </span>
                                                                      <input type="text" class="form-control"
                                                                                id="SphDeliveryTotal" value="0"
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
                                                                                id="SphGrandTotal" value="0">
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
                                                            <button type="button"
                                                                      class="btn btn-sm border border-danger-600 bg-hover-danger-200 text-danger-600 radius-8 d-inline-flex align-items-center gap-1">
                                                                      <iconify-icon icon="simple-line-icons:close"
                                                                                class="text-xl">
                                                                      </iconify-icon>
                                                                      Batalkan
                                                            </button>
                                                            <button type="button" id="btn-add-penawaran"
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

$('#SphDate').daterangepicker({
          "singleDatePicker": true,
          "startDate": moment(),
          "endDate": moment(),
          locale: {
                    format: 'DD MMMM YYYY'
          }
});

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

$("#SphAdmin").select2({
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
                                        "<button class=\"btn btn-sm btn-primary-600 \" onclick=\"customer_add()\">Tambah Customer Baru</button>"
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
                    $('#SphCustName').val(data.customername);
                    $('#SphCustTelp').val(data.customertelp);
                    $('#SphAddress').val(data.customeraddress);
                    $("#SphCustName").attr("readonly", false);
                    $("#SphCustTelp").attr("readonly", false);
                    $("#SphAddress").attr("readonly", false);
          } else {
                    $("#SphCustName").attr("readonly", true);
                    $("#SphCustTelp").attr("readonly", true);
                    $("#SphAddress").attr("readonly", true);

          }
});

$('#SphDelivery').change(function() {
          if ($("#SphDelivery").is(':checked') == 0) {
                    $('#SphDeliveryTotal').prop("readonly", true)
                    $('#SphDeliveryTotal').val("0")
          } else {

                    $('#SphDeliveryTotal').prop("readonly", false)
          }
});
var isProcessingCustomerAdd;

function customer_add() {
          if (isProcessingCustomerAdd) {
                    return;
          }
          isProcessingCustomerAdd = true;
          $.ajax({
                    method: "POST",
                    url: "<?= base_url() ?>message/add-customer",
                    success: function(data) {
                              $("#modal-add-penawaran").modal("hide");
                              $("#modal-optional").html(data);
                              $("#modal-add-customer").modal("show");

                              $("#modal-add-customer").on("hidden.bs.modal",
                                        function() {
                                                  $("#modal-add-penawaran")
                                                            .modal(
                                                                      "show");
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
                              var csrfHash = $('.txt_csrfname').val(); // CSRF hash

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
                    $("#StoreId").attr("readonly", false);
                    $("#CustomerId").attr("readonly", false);
          } else {
                    $("#StoreId").attr("readonly", true);
                    $("#CustomerId").attr("readonly", true);
                    $('#StoreId').append(new Option(data.store, data.storeid, true, true)).trigger(
                              'change');
                    $('#CustomerId').append(new Option(data.customer, data.customerid, true, true))
                              .trigger('change');
                    $('#SphCustName').val(data.customername);
                    $('#SphCustTelp').val(data.customertelp);
                    $('#SphAddress').val(data.customeraddress);

          }
});
$('#ProjectId').append(new Option("Tidak ada yang dipilih", 0, true, true)).trigger('change');


var sph_sub_total = new Cleave(`#SphSubTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var sph_disc_item_total = new Cleave(`#SphDiscItemTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var sph_disc_total = new Cleave(`#SphDiscTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var sph_grand_total = new Cleave(`#SphGrandTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var sph_delivery = new Cleave(`#SphDeliveryTotal`, {
          numeral: true,
          delimeter: ",",
          numeralDecimalScale: 0,
          numeralThousandGroupStyle: "thousand"
});
var table_sph_item = new tableItem("table-list", {
          dataitem: [],
          dropdownParent: $('#modal-add-penawaran .modal-content'),
          baseUrl: "<?= base_url() ?>",
          modal: $('#modal-add-penawaran')
});

grand_total_harga = function(data) {
          var grandtotal = data.totalitem - data.totaldiscitem - $("#SphDiscTotal").val().replace(/[^0-9-]/g,
                    '') + parseInt($("#SphDeliveryTotal").val().replace(/[^0-9-]/g, ''));
          $("#SphSubTotal").val(data.totalitem.toLocaleString('en-US'))
          $("#SphDiscItemTotal").val(data.totaldiscitem.toLocaleString('en-US'))
          $("#SphGrandTotal").val(grandtotal.toLocaleString('en-US'))
};

if (table_sph_item && typeof table_sph_item.on === 'function') {
          table_sph_item.on("subtotal", function(data) {
                    grand_total_harga(data);
          });
          table_sph_item.getSubTotal()
} else {
          console.error("table_sph_item tidak terdefinisi atau method on() tidak ada");
}
$("#SphDiscTotal").on("keyup", function() {
          grand_total_harga(table_sph_item.getSubTotal());
          if (parseInt($("#SphGrandTotal").val().replace(/[^0-9-]/g, '')) < 0) {
                    $("#SphDiscTotal").val(0)
                    grand_total_harga(table_sph_item.getSubTotal());
          }
});

$("#SphDeliveryTotal").on("keyup", function() {
          grand_total_harga(table_sph_item.getSubTotal());
});

$("#SphRef").select2({
          placeholder: "Pilih dokument referensi",
          ajax: {
                    url: "<?= base_url()?>select2/get-data-ref-sph",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function(params) {
                              // CSRF Hash
                              var csrfName = $('.txt_csrfname').attr(
                                        'name'); // CSRF Token name
                              var csrfHash = $('.txt_csrfname').val(); // CSRF hash

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
                    if ($(data.html).length === 0) {
                              return data.text;
                    }
                    return data['text'];
          }
});


var quill = [];
$(".template-footer").each(function(index, el) {
          var message = $(el).find("[name='EditFooterMessage']")[0];
          var type = "penawaran";
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
                    $("#modal-add-penawaran").modal("hide");
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
                              $("#modal-add-penawaran")
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


$("#btn-add-penawaran").click(function() {
          var data_detail_item = table_sph_item.getDataRow();
          if ($("#CustomerId").val() == null) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Pelanggan harus dipilih...!!!',
                              confirmButtonColor: "var(--brand)",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#CustomerId").select2("open"),
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
                              setTimeout(() => $("#StoreId").select2("open"),
                                        300);
                    });
                    return false;
          }
          if ($("#SphAdmin").val() == null) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Admin harus dipilih...!!!',
                              confirmButtonColor: "var(--brand)",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#SphAdmin").select2("open"),
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
                    SphDate: $("#SphDate").data('daterangepicker').startDate.format(
                              "YYYY-MM-DD"),
                    ProjectId: $("#ProjectId").val(),
                    CustomerId: $("#CustomerId").val(),
                    StoreId: $("#StoreId").val(),
                    SphRef: $("#SphRef").val(),
                    SphRefType: $('#SphRef option:selected').data('type'),
                    SphAdmin: $("#SphAdmin").val(),
                    SphCustName: $("#SphCustName").val(),
                    SphCustTelp: $("#SphCustTelp").val(),
                    SphAddress: $("#SphAddress").val(),
                    SphProjectAddress: $("#SphProjectAddress").val(),
                    SphDelivery: $('#SphDelivery').is(':checked'),
                    TemplateId: $($(".template-footer").find("select")[0]).val(),
                    SphSubTotal: $("#SphSubTotal").val().replace(/[^0-9]/g, ''),
                    SphDiscItemTotal: $("#SphDiscItemTotal").val().replace(/[^0-9]/g, ''),
                    SphDeliveryTotal: $("#SphDeliveryTotal").val().replace(/[^0-9]/g, ''),
                    SphDiscTotal: $("#SphDiscTotal").val().replace(/[^0-9]/g, ''),
                    SphGrandTotal: $("#SphGrandTotal").val().replace(/[^0-9]/g, '')
          }
          var detail = [];
          for (var i = 0; data_detail_item.length > i; i++) {
                    if (data_detail_item[i]["type"] == "product") {
                              detail.push({
                                        ProdukId: data_detail_item[i][
                                                  "produkid"
                                        ],
                                        SphDetailText: data_detail_item[i][
                                                  "text"
                                        ],
                                        SphDetailType: data_detail_item[i][
                                                  "type"
                                        ],
                                        SphDetailSatuanId: data_detail_item[i][
                                                  "satuan_id"
                                        ],
                                        SphDetailSatuanText: data_detail_item[i]
                                                  ["satuan_text"],
                                        SphDetailQty: data_detail_item[i][
                                                  "qty"
                                        ],
                                        SphDetailPrice: data_detail_item[i][
                                                  "price"
                                        ],
                                        SphDetailDisc: data_detail_item[i][
                                                  "disc"
                                        ],
                                        SphDetailTotal: data_detail_item[i][
                                                  "total"
                                        ],
                                        SphDetailGroup: data_detail_item[i][
                                                  "group"
                                        ],
                                        SphDetailVarian: data_detail_item[i][
                                                  "varian"
                                        ],
                              });
                    } else {
                              detail.push({
                                        ProdukId: data_detail_item[i][
                                                  "produkid"
                                        ],
                                        SphDetailText: data_detail_item[i][
                                                  "text"
                                        ],
                                        SphDetailType: data_detail_item[i][
                                                  "type"
                                        ],
                                        SphDetailSatuanId: "",
                                        SphDetailSatuanText: "",
                                        SphDetailQty: 0,
                                        SphDetailPrice: 0,
                                        SphDetailDisc: 0,
                                        SphDetailTotal: 0,
                                        SphDetailGroup: "",
                                        SphDetailVarian: [],
                              });
                    }
          }
          $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/add-data-penawaran",
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
                                                            "<?=base_url()?>admin/sales/penawaran";
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


$('#test-item tbody').sortable({
          handle: '.button-drag',
          items: 'tr',
          cursor: 'move',
          opacity: 0.7,
          start: function(event, ui) {
                    ui.item.addClass('dragging');
          },
          stop: function(event, ui) {
                    ui.item.removeClass('dragging');
          }
});
</script>

<?php $this->endSection('content'); ?>