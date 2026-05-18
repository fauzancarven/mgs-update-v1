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
    customColor($number) {
        switch ($number) {
            case 0:
                return 'bg-info-50 text-primary-600';
                break;
            case 1:
                return 'bg-warning-50 text-warning-600';
                break;
            case 2:
                return 'bg-success-50 text-success-600';
                break;
            case 3:
                return 'bg-danger-50 text-danger-600';
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
                                        <div class="d-flex align-items-center gap-1 justify-content-center">
                                            <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan keatas" data-id="${i}" data-type="up">
                                                <iconify-icon icon="lucide:chevron-up"></iconify-icon>
                                            </a>
                                            <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan kebawah" data-id="${i}" data-type="down">
                                                <iconify-icon icon="lucide:chevron-down"></iconify-icon>
                                            </a>
                                            <a class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="hapus item" data-id="${i}" data-type="delete">
                                                <iconify-icon icon="lucide:trash-2">
                                                </iconify-icon>
                                            </a> 
                                            <a class="w-24-px h-24-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="ubah" data-id="${i}" data-type="edit">
                                                <iconify-icon icon="lucide:edit">
                                                </iconify-icon>
                                            </a> 
                                            <a class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-none align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="simpan" data-id="${i}" data-type="save">
                                                <iconify-icon icon="lucide:save">
                                                </iconify-icon>
                                            </a> 
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
                                    `<span class="${custom} radius-8 px-8 py-4 text-xxs fw-bold">${this.dataitem[i]["varian"][j]["varian"] + ": " + this.dataitem[i]["varian"][j]["value"]}</span>`;
                            }
                            varian += '</div>';
                        }
                        html += `   
                            <div class="row align-items-center mx-0 hr p-8">
                                        <div class="col-12 col-md-6 my-1 varian px-0">   
                                            <div class="d-flex">
                                                <div class="px-0 order-md-1 order-4"> 
                                                <div class="d-flex align-items-center gap-1 justify-content-center">
                                                    <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan keatas" data-id="${i}" data-type="up">
                                                        <iconify-icon icon="lucide:chevron-up"></iconify-icon>
                                                    </a>
                                                    <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan kebawah" data-id="${i}" data-type="down">
                                                        <iconify-icon icon="lucide:chevron-down"></iconify-icon>
                                                    </a>
                                                    <a class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="hapus item" data-id="${i}" data-type="delete">
                                                        <iconify-icon icon="lucide:trash-2">
                                                        </iconify-icon>
                                                    </a> 
                                                    <a class="w-24-px h-24-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="ubah" data-id="${i}" data-type="edit">
                                                        <iconify-icon icon="lucide:edit">
                                                        </iconify-icon>
                                                    </a> 
                                                    <a class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-none align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="simpan" data-id="${i}" data-type="save">
                                                        <iconify-icon icon="lucide:save">
                                                        </iconify-icon>
                                                    </a> 
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
        } catch (error) { }
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
                $(`#input-qty-${i}`).on("keyup", function () {
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
                        data: function (params) {
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
                        processResults: function (
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
                        noResults: function () {
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
                    escapeMarkup: function (m) {
                        return m;
                    }
                }).on("select2:select", function (e) {
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
                $(`#input-harga-${i}`).on("keyup", function () {
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
                $(`#input-disc-${i}`).on("keyup", function () {
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
        $("#" + this.elementId + " a[name='btn-add-product']").click(function () {
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
                success: function (data) {
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
                            function (event,
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
                            function () {
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
                error: function (xhr, textStatus,
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
        $("#" + this.elementId + " a[name='btn-add-product-manual']").click(function () {
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
        $("#" + this.elementId + " a[name='btn-add-category']").click(function () {
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
        $("#" + this.elementId + " .span-custom-input").click(function () {
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
                index + "']").on('input', function () {
                    $(this).height('auto');
                    $(this).height(this
                        .scrollHeight
                    );
                }).on('focusout', function () {
                    self.saveEditableInput(index)
                });
        });
        $("#" + this.elementId + " .btn-action.detail[data-type='edit']").click(function () {
            $("#" + self.elementId + " .span-custom-input[data-id='" +
                $(this).data("id") + "']").trigger(
                    "click");
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='save']").click(function () {
            self.saveEditableInput($(this).data("id"));
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='delete']").click(function () {
            self.dataitem.splice($(this).data("id"), 1);
            self.render()
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='up']").click(function () {
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
        $("#" + this.elementId + " .btn-action.detail[data-type='down']").click(function () {

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

class tableItemDelivery {
    constructor(elementId, options = {}) {
        this.elementId = elementId;
        this.dataitem = options.dataitem || [];
        this.baseUrl = options.baseUrl || "";
        this.hideRef = options.hideRef || false;
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
            .removeClass("d-none").addClass("d-inline-flex");;
        $("#" + this.elementId + " .btn-action.detail[data-id='" + index + "'][data-type='save']")
            .removeClass("d-inline-flex").addClass("d-none");

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
    customColor($number) {
        switch ($number) {
            case 0:
                return 'bg-info-50 text-primary-600';
                break;
            case 1:
                return 'bg-warning-50 text-warning-600';
                break;
            case 2:
                return 'bg-success-50 text-success-600';
                break;
            case 3:
                return 'bg-danger-50 text-danger-600';
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
                                    <div class="d-flex align-items-center gap-1 justify-content-center">
                                        <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan keatas" data-id="${i}" data-type="up">
                                            <iconify-icon icon="lucide:chevron-up"></iconify-icon>
                                        </a>
                                        <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan kebawah" data-id="${i}" data-type="down">
                                            <iconify-icon icon="lucide:chevron-down"></iconify-icon>
                                        </a>
                                        <a class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="hapus item" data-id="${i}" data-type="delete">
                                            <iconify-icon icon="lucide:trash-2">
                                            </iconify-icon>
                                        </a> 
                                        <a class="w-24-px h-24-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="ubah" data-id="${i}" data-type="edit">
                                            <iconify-icon icon="lucide:edit">
                                            </iconify-icon>
                                        </a> 
                                        <a class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-none align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="simpan" data-id="${i}" data-type="save">
                                            <iconify-icon icon="lucide:save">
                                            </iconify-icon>
                                        </a> 
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
                                    `<span class="${custom} radius-8 px-8 py-4 text-xxs fw-bold">${this.dataitem[i]["varian"][j]["varian"] + ": " + this.dataitem[i]["varian"][j]["value"]}</span>`;
                            }
                            varian += '</div>';
                        }
                        var cssinput = "col-6 col-md-3 px-1";
                        if (this.hideRef == true) cssinput = "col-6 px-1";
                        html += `   
                      <div class="row align-items-center mx-0 hr p-8">
                                  <div class="col-12 col-md-7 my-1 varian px-0">   
                                      <div class="d-flex">
                                          <div class="px-0 order-md-1 order-4"> 
                                            <div class="d-flex align-items-center gap-1 justify-content-center">
                                                <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan keatas" data-id="${i}" data-type="up">
                                                    <iconify-icon icon="lucide:chevron-up"></iconify-icon>
                                                </a>
                                                <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan kebawah" data-id="${i}" data-type="down">
                                                    <iconify-icon icon="lucide:chevron-down"></iconify-icon>
                                                </a>
                                                <a class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="hapus item" data-id="${i}" data-type="delete">
                                                    <iconify-icon icon="lucide:trash-2">
                                                    </iconify-icon>
                                                </a> 
                                                <a class="w-24-px h-24-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="ubah" data-id="${i}" data-type="edit">
                                                    <iconify-icon icon="lucide:edit">
                                                    </iconify-icon>
                                                </a> 
                                                <a class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-none align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="simpan" data-id="${i}" data-type="save">
                                                    <iconify-icon icon="lucide:save">
                                                    </iconify-icon>
                                                </a> 
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
                                  <div class="col-12 col-md-5 my-1 detail">
                                      <div class="row px-2">  
                                        <div class="${cssinput} ${(this.hideRef ? "d-none" : "")} ">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Invoice</span>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control form-control-sm input-form berat text-start p-1" id="input-invoice-${i}" data-id="${i}" readonly>
                                                <span class="input-group-text bg-base p-1">${this.dataitem[i]["satuan_text"]}</span>
                                            </div>  
                                        </div>   
                                        <div class="${cssinput} ${(this.hideRef ? "d-none" : "")}">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Terkirim</span>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm  input-form d-inline-block text-start p-1" id="input-terkirim-${i}" data-id="${i}" readonly>
                                                <span class="input-group-text bg-base p-1">${this.dataitem[i]["satuan_text"]}</span>
                                            </div>
                                        </div>
                                        <div class="${cssinput}">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Diskon</span>
                                            <div class="input-group">    
                                                <input type="text" class="p-1 form-control form-control-sm  input-form d-inline-block hargabeli text-start" id="input-qty-${i}" data-id="${i}">
                                                <span class="input-group-text bg-base p-1">${this.dataitem[i]["satuan_text"]}</span>
                                            </div>   
                                        </div> 
                                        <div class="${cssinput}">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start ">Total</span>
                                            <div class="input-group">  
                                                <input type="text" class="p-1 form-control form-control-sm  input-form d-inline-block hargajual text-start" id="input-spare-${i}" data-id="${i}" >
                                                <span class="input-group-text bg-base p-1">${this.dataitem[i]["satuan_text"]}</span>
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
        } catch (error) { }
    }
    setupDatahtml() {
        var self = this;
        var inputqty = [];
        var inputqty_ref = [];
        var inputqty_success = [];
        var inputqty_spare = [];

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
                inputqty_ref[i] = new Cleave(`#input-invoice-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale: 3,
                    numeralThousandGroupStyle: "thousand"
                });
                inputqty_ref[i].setRawValue(self.dataitem[i]["qty_ref"]);
                $(`#input-invoice-${i}`).on("keyup", function () {
                    self.dataitem[$(this).data("id")][
                        "qty_ref"
                    ] = inputqty[$(this)
                        .data("id")]
                        .getRawValue();
                    if ($(`#input-invoice-${i}`).val() == "") $(
                        `#input-invoice-${i}`)
                        .val(0)
                    total_harga($(this).data("id"));
                });

                //event qty
                inputqty_success[i] = new Cleave(`#input-terkirim-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale: 3,
                    numeralThousandGroupStyle: "thousand"
                });
                inputqty_success[i].setRawValue(self.dataitem[i]["qty_success"]);
                $(`#input-terkirim-${i}`).on("keyup", function () {
                    self.dataitem[$(this).data("id")][
                        "qty_success"
                    ] = inputqty[$(this)
                        .data("id")]
                        .getRawValue();
                    if ($(`#input-terkirim-${i}`).val() == "") $(
                        `#input-terkirim-${i}`)
                        .val(0)
                    total_harga($(this).data("id"));
                });

                //event qty
                inputqty[i] = new Cleave(`#input-qty-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale: 3,
                    numeralThousandGroupStyle: "thousand"
                });
                inputqty[i].setRawValue(self.dataitem[i]["qty"]);
                $(`#input-qty-${i}`).on("keyup", function () {
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


                //event spare
                inputqty_spare[i] = new Cleave(`#input-spare-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale: 3,
                    numeralThousandGroupStyle: "thousand"
                });
                inputqty_spare[i].setRawValue(self.dataitem[i]["qty_spare"]);
                $(`#input-spare-${i}`).on("keyup", function () {
                    self.dataitem[$(this).data("id")][
                        "qty_spare"
                    ] = inputqty[$(this)
                        .data("id")]
                        .getRawValue();
                    if ($(`#input-spare-${i}`).val() == "") $(
                        `#input-spare-${i}`)
                        .val(0)
                    total_harga($(this).data("id"));
                });
            }
        }
    }
    render() {

        var cssinput = "col-6 col-md-3 px-1";
        if (this.hideRef == true) cssinput = "col-6 px-1";
        var self = this;
        var html = `
      <div class="card p-3" style="min-height:50px;">
      <div class="card-body p-0  ">
          <div class="row align-items-center d-none d-md-flex px-3">
          <div class="col-12 col-md-7 my-1">
              <div class="row">
              <div class="col-12">
                  <span class="label-head-dialog">Deskripsi</span>
              </div>
              </div>
          </div>
          <div class="col-12 col-md-5 my-1">
                <div class="row">
                    <div class="col ${(this.hideRef == true ? "d-none" : "")}">
                        <span class="label-head-dialog">Invoice</span>
                    </div>  
                    <div class="col ${(this.hideRef == true ? "d-none" : "")}">
                        <span class="label-head-dialog">Terkirim</span>
                    </div>
                    <div class="col">
                        <span class="label-head-dialog">Qty</span>
                    </div>
                    <div class="col">
                        <span class="label-head-dialog">Spare</span>
                    </div> 
                </div>
          </div>
          </div>
          <div name="list-data" class="text-center" style="border-top: var(--bg-color) 2.5px solid; border-bottom: var(--bg-color) 2.5px solid;">
              ${this.loadDatahtml()}
          </div>
          <div class="d-flex justify-content-center flex-column align-items-center d-none">
            <div class="d-flex gap-2 mt-16"> 
                    <a type="button" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1" name="btn-add-product-delivery">
                                <iconify-icon icon="ic:add" class="text-xl">
                                </iconify-icon>
                                Tambah Produk
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
        $("#" + this.elementId + " a[name='btn-add-product']").click(function () {
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
                success: function (data) {
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
                            function (event,
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
                            function () {
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
                error: function (xhr, textStatus,
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
        $("#" + this.elementId + " a[name='btn-add-product-manual']").click(function () {
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
        $("#" + this.elementId + " a[name='btn-add-category']").click(function () {
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
        $("#" + this.elementId + " .span-custom-input").click(function () {
            var index = $(this).data("id");
            if (self.dataitem[index]["id"] == 0 || self.dataitem[index][
                "type"
            ] == "category") {
                $("#" + self.elementId +
                    " .text-custom-input[data-id='" +
                    index + "']").show();
                $(this).hide();
                $(".btn-action.detail[data-id='" + index +
                    "'][data-type='edit']").removeClass("d-inline-flex").addClass("d-none");
                $(".btn-action.detail[data-id='" + index +
                    "'][data-type='save']").removeClass("d-none").addClass("d-inline-flex");
            }
            $("#" + self.elementId + " .text-custom-input[data-id='" +
                index + "']").on('input', function () {
                    $(this).height('auto');
                    $(this).height(this
                        .scrollHeight
                    );
                }).on('focusout', function () {
                    self.saveEditableInput(index)
                });
        });
        $("#" + this.elementId + " .btn-action.detail[data-type='edit']").click(function () {
            $("#" + self.elementId + " .span-custom-input[data-id='" +
                $(this).data("id") + "']").trigger(
                    "click");
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='save']").click(function () {
            self.saveEditableInput($(this).data("id"));
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='delete']").click(function () {
            self.dataitem.splice($(this).data("id"), 1);
            self.render()
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='up']").click(function () {
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
        $("#" + this.elementId + " .btn-action.detail[data-type='down']").click(function () {

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


class tableItemDeliveryReceive {
    constructor(elementId, options = {}) {
        this.elementId = elementId;
        this.dataitem = options.dataitem || [];
        this.baseUrl = options.baseUrl || "";
        this.hideRef = options.hideRef || false;
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
            .removeClass("d-none").addClass("d-inline-flex");;
        $("#" + this.elementId + " .btn-action.detail[data-id='" + index + "'][data-type='save']")
            .removeClass("d-inline-flex").addClass("d-none");

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
    customColor($number) {
        switch ($number) {
            case 0:
                return 'bg-info-50 text-primary-600';
                break;
            case 1:
                return 'bg-warning-50 text-warning-600';
                break;
            case 2:
                return 'bg-success-50 text-success-600';
                break;
            case 3:
                return 'bg-danger-50 text-danger-600';
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
                                    <div class="d-flex align-items-center gap-1 justify-content-center">
                                        <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan keatas" data-id="${i}" data-type="up">
                                            <iconify-icon icon="lucide:chevron-up"></iconify-icon>
                                        </a>
                                        <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan kebawah" data-id="${i}" data-type="down">
                                            <iconify-icon icon="lucide:chevron-down"></iconify-icon>
                                        </a>
                                        <a class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="hapus item" data-id="${i}" data-type="delete">
                                            <iconify-icon icon="lucide:trash-2">
                                            </iconify-icon>
                                        </a> 
                                        <a class="w-24-px h-24-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="ubah" data-id="${i}" data-type="edit">
                                            <iconify-icon icon="lucide:edit">
                                            </iconify-icon>
                                        </a> 
                                        <a class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-none align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="simpan" data-id="${i}" data-type="save">
                                            <iconify-icon icon="lucide:save">
                                            </iconify-icon>
                                        </a> 
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
                                    `<span class="${custom} radius-8 px-8 py-4 text-xxs fw-bold">${this.dataitem[i]["varian"][j]["varian"] + ": " + this.dataitem[i]["varian"][j]["value"]}</span>`;
                            }
                            varian += '</div>';
                        }
                        var cssinput = "col-6 col-md-3 px-1";
                        if (this.hideRef == true) cssinput = "col-6 px-1";
                        html += `   
                      <div class="row align-items-center mx-0 hr p-8">
                                  <div class="col-12 col-md-7 my-1 varian px-0">   
                                      <div class="d-flex">
                                          <div class="px-0 order-md-1 order-4"> 
                                            <div class="d-flex align-items-center gap-1 justify-content-center">
                                                <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan keatas" data-id="${i}" data-type="up">
                                                    <iconify-icon icon="lucide:chevron-up"></iconify-icon>
                                                </a>
                                                <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan kebawah" data-id="${i}" data-type="down">
                                                    <iconify-icon icon="lucide:chevron-down"></iconify-icon>
                                                </a>
                                                <a class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="hapus item" data-id="${i}" data-type="delete">
                                                    <iconify-icon icon="lucide:trash-2">
                                                    </iconify-icon>
                                                </a> 
                                                <a class="w-24-px h-24-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="ubah" data-id="${i}" data-type="edit">
                                                    <iconify-icon icon="lucide:edit">
                                                    </iconify-icon>
                                                </a> 
                                                <a class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-none align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="simpan" data-id="${i}" data-type="save">
                                                    <iconify-icon icon="lucide:save">
                                                    </iconify-icon>
                                                </a> 
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
                                  <div class="col-12 col-md-5 my-1 detail">
                                      <div class="row px-2">  
                                        <div class="${cssinput}">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty</span>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control form-control-sm input-form berat text-start p-1" id="input-qty-${i}" data-id="${i}">
                                                <span class="input-group-text bg-base p-1">${this.dataitem[i]["satuan_text"]}</span>
                                            </div>  
                                        </div>    
                                        <div class="${cssinput}">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Spare</span>
                                            <div class="input-group">    
                                                <input type="text" class="p-1 form-control form-control-sm  input-form d-inline-block hargabeli text-start" id="input-spare-${i}" data-id="${i}">
                                                <span class="input-group-text bg-base p-1">${this.dataitem[i]["satuan_text"]}</span>
                                            </div>   
                                        </div> 
                                        <div class="${cssinput}">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Rusak</span>
                                            <div class="input-group">  
                                                <input type="text" class="p-1 form-control form-control-sm  input-form d-inline-block hargajual text-start" id="input-rusak-${i}" data-id="${i}" >
                                                <span class="input-group-text bg-base p-1">${this.dataitem[i]["satuan_text"]}</span>
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
        } catch (error) { }
    }
    setupDatahtml() {
        var self = this;
        var inputqty = [];
        var inputqty_ref = [];
        var inputqty_success = [];
        var inputqty_spare = [];

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
                inputqty_ref[i] = new Cleave(`#input-qty-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale: 3,
                    numeralThousandGroupStyle: "thousand"
                });
                inputqty_ref[i].setRawValue(self.dataitem[i]["qty_ref"]);
                $(`#input-invoice-${i}`).on("keyup", function () {
                    self.dataitem[$(this).data("id")][
                        "qty_ref"
                    ] = inputqty[$(this)
                        .data("id")]
                        .getRawValue();
                    if ($(`#input-invoice-${i}`).val() == "") $(
                        `#input-invoice-${i}`)
                        .val(0)
                    total_harga($(this).data("id"));
                });

                //event qty
                inputqty_success[i] = new Cleave(`#input-rusak-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale: 3,
                    numeralThousandGroupStyle: "thousand"
                });
                inputqty_success[i].setRawValue(self.dataitem[i]["rusak"]);
                $(`#input-rusak-${i}`).on("keyup", function () {
                    self.dataitem[$(this).data("id")][
                        "rusak"
                    ] = inputqty[$(this)
                        .data("id")]
                        .getRawValue();
                    if ($(`#input-rusak-${i}`).val() == "") $(
                        `#input-rusak-${i}`)
                        .val(0)
                    total_harga($(this).data("id"));
                });

                //event qty
                inputqty[i] = new Cleave(`#input-spare-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale: 3,
                    numeralThousandGroupStyle: "thousand"
                });
                inputqty[i].setRawValue(self.dataitem[i]["spare"]);
                $(`#input-spare-${i}`).on("keyup", function () {
                    self.dataitem[$(this).data("id")][
                        "spare"
                    ] = inputqty[$(this)
                        .data("id")]
                        .getRawValue();
                    if ($(`#input-spare-${i}`).val() == "") $(
                        `#input-spare-${i}`)
                        .val(0)
                    total_harga($(this).data("id"));
                });

            }
        }
    }
    render() {

        var cssinput = "col-6 col-md-3 px-1";
        if (this.hideRef == true) cssinput = "col-6 px-1";
        var self = this;
        var html = `
      <div class="card p-3" style="min-height:50px;">
      <div class="card-body p-0  ">
          <div class="row align-items-center d-none d-md-flex px-3">
          <div class="col-12 col-md-7 my-1">
              <div class="row">
              <div class="col-12">
                  <span class="label-head-dialog">Deskripsi</span>
              </div>
              </div>
          </div>
          <div class="col-12 col-md-5 my-1">
                <div class="row">
                    <div class="col ${(this.hideRef == true ? "d-none" : "")}">
                        <span class="label-head-dialog">Invoice</span>
                    </div>  
                    <div class="col ${(this.hideRef == true ? "d-none" : "")}">
                        <span class="label-head-dialog">Terkirim</span>
                    </div>
                    <div class="col">
                        <span class="label-head-dialog">Qty</span>
                    </div>
                    <div class="col">
                        <span class="label-head-dialog">Spare</span>
                    </div> 
                </div>
          </div>
          </div>
          <div name="list-data" class="text-center" style="border-top: var(--bg-color) 2.5px solid; border-bottom: var(--bg-color) 2.5px solid;">
              ${this.loadDatahtml()}
          </div>
          <div class="d-flex justify-content-center flex-column align-items-center d-none">
            <div class="d-flex gap-2 mt-16"> 
                    <a type="button" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1" name="btn-add-product-delivery">
                                <iconify-icon icon="ic:add" class="text-xl">
                                </iconify-icon>
                                Tambah Produk
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
        $("#" + this.elementId + " a[name='btn-add-product']").click(function () {
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
                success: function (data) {
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
                            function (event,
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
                            function () {
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
                error: function (xhr, textStatus,
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
        $("#" + this.elementId + " a[name='btn-add-product-manual']").click(function () {
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
        $("#" + this.elementId + " a[name='btn-add-category']").click(function () {
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
        $("#" + this.elementId + " .span-custom-input").click(function () {
            var index = $(this).data("id");
            if (self.dataitem[index]["id"] == 0 || self.dataitem[index][
                "type"
            ] == "category") {
                $("#" + self.elementId +
                    " .text-custom-input[data-id='" +
                    index + "']").show();
                $(this).hide();
                $(".btn-action.detail[data-id='" + index +
                    "'][data-type='edit']").removeClass("d-inline-flex").addClass("d-none");
                $(".btn-action.detail[data-id='" + index +
                    "'][data-type='save']").removeClass("d-none").addClass("d-inline-flex");
            }
            $("#" + self.elementId + " .text-custom-input[data-id='" +
                index + "']").on('input', function () {
                    $(this).height('auto');
                    $(this).height(this
                        .scrollHeight
                    );
                }).on('focusout', function () {
                    self.saveEditableInput(index)
                });
        });
        $("#" + this.elementId + " .btn-action.detail[data-type='edit']").click(function () {
            $("#" + self.elementId + " .span-custom-input[data-id='" +
                $(this).data("id") + "']").trigger(
                    "click");
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='save']").click(function () {
            self.saveEditableInput($(this).data("id"));
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='delete']").click(function () {
            self.dataitem.splice($(this).data("id"), 1);
            self.render()
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='up']").click(function () {
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
        $("#" + this.elementId + " .btn-action.detail[data-type='down']").click(function () {

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


class tableItemPO {
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
    customColor($number) {
        switch ($number) {
            case 0:
                return 'bg-info-50 text-primary-600';
                break;
            case 1:
                return 'bg-warning-50 text-warning-600';
                break;
            case 2:
                return 'bg-success-50 text-success-600';
                break;
            case 3:
                return 'bg-danger-50 text-danger-600';
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
                                        <div class="d-flex align-items-center gap-1 justify-content-center">
                                            <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan keatas" data-id="${i}" data-type="up">
                                                <iconify-icon icon="lucide:chevron-up"></iconify-icon>
                                            </a>
                                            <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan kebawah" data-id="${i}" data-type="down">
                                                <iconify-icon icon="lucide:chevron-down"></iconify-icon>
                                            </a>
                                            <a class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="hapus item" data-id="${i}" data-type="delete">
                                                <iconify-icon icon="lucide:trash-2">
                                                </iconify-icon>
                                            </a> 
                                            <a class="w-24-px h-24-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="ubah" data-id="${i}" data-type="edit">
                                                <iconify-icon icon="lucide:edit">
                                                </iconify-icon>
                                            </a> 
                                            <a class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-none align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="simpan" data-id="${i}" data-type="save">
                                                <iconify-icon icon="lucide:save">
                                                </iconify-icon>
                                            </a> 
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
                                    `<span class="${custom} radius-8 px-8 py-4 text-xxs fw-bold">${this.dataitem[i]["varian"][j]["varian"] + ": " + this.dataitem[i]["varian"][j]["value"]}</span>`;
                            }
                            varian += '</div>';
                        }
                        html += `   
                            <div class="row align-items-center mx-0 hr p-8">
                                        <div class="col-12 col-md-6 my-1 varian px-0">   
                                            <div class="d-flex">
                                                <div class="px-0 order-md-1 order-4"> 
                                                <div class="d-flex align-items-center gap-1 justify-content-center">
                                                    <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan keatas" data-id="${i}" data-type="up">
                                                        <iconify-icon icon="lucide:chevron-up"></iconify-icon>
                                                    </a>
                                                    <a class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="Pindahkan kebawah" data-id="${i}" data-type="down">
                                                        <iconify-icon icon="lucide:chevron-down"></iconify-icon>
                                                    </a>
                                                    <a class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="hapus item" data-id="${i}" data-type="delete">
                                                        <iconify-icon icon="lucide:trash-2">
                                                        </iconify-icon>
                                                    </a> 
                                                    <a class="w-24-px h-24-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="ubah" data-id="${i}" data-type="edit">
                                                        <iconify-icon icon="lucide:edit">
                                                        </iconify-icon>
                                                    </a> 
                                                    <a class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-none align-items-center justify-content-center btn-action detail cursor-pointer"  data-bs-toggle="tooltip"  data-bs-title="simpan" data-id="${i}" data-type="save">
                                                        <iconify-icon icon="lucide:save">
                                                        </iconify-icon>
                                                    </a> 
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
        } catch (error) { }
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
                $(`#input-qty-${i}`).on("keyup", function () {
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
                        data: function (params) {
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
                        processResults: function (
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
                        noResults: function () {
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
                    escapeMarkup: function (m) {
                        return m;
                    }
                }).on("select2:select", function (e) {
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
                $(`#input-harga-${i}`).on("keyup", function () {
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
                $(`#input-disc-${i}`).on("keyup", function () {
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
        $("#" + this.elementId + " a[name='btn-add-product']").click(function () {
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
                success: function (data) {
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
                    $("#modal-select-item").data("type", "buy");
                    $("#modal-select-item")
                        .modal(
                            "show"
                        );

                    // Membuat event emitter
                    $(document)
                        .on("select_produk",
                            function (event,
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
                            function () {
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
                error: function (xhr, textStatus,
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
        $("#" + this.elementId + " a[name='btn-add-product-manual']").click(function () {
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
        $("#" + this.elementId + " a[name='btn-add-category']").click(function () {
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
        $("#" + this.elementId + " .span-custom-input").click(function () {
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
                index + "']").on('input', function () {
                    $(this).height('auto');
                    $(this).height(this
                        .scrollHeight
                    );
                }).on('focusout', function () {
                    self.saveEditableInput(index)
                });
        });
        $("#" + this.elementId + " .btn-action.detail[data-type='edit']").click(function () {
            $("#" + self.elementId + " .span-custom-input[data-id='" +
                $(this).data("id") + "']").trigger(
                    "click");
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='save']").click(function () {
            self.saveEditableInput($(this).data("id"));
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='delete']").click(function () {
            self.dataitem.splice($(this).data("id"), 1);
            self.render()
        })
        $("#" + this.elementId + " .btn-action.detail[data-type='up']").click(function () {
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
        $("#" + this.elementId + " .btn-action.detail[data-type='down']").click(function () {

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