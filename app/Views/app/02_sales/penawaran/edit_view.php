<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<div
    class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0 d-flex align-items-center">
        <a
            href="<?= base_url() ?>admin/sales/penawaran"
            class=" pe-3 d-inline-block"
            id="btn-back-page">
            <iconify-icon icon="iconoir:arrow-left" class="icon  "></iconify-icon>
        </a>Ubah Penawaran
    </h6>

    <ul class="d-flex align-items-center gap-2 flex-wrap">
        <li class="fw-medium ">
            <a
                href="<?= base_url() ?>"
                class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon
                    icon="material-symbols-light:dashboard-outline-rounded"
                    class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>/</li>
        <li class="fw-medium">
            <a
                id="breadcumb-cancel-edit"
                href="<?= base_url() ?>admin/sales/penawaran"
                class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="ic:outline-handshake" class="icon text-lg"></iconify-icon>
                List Penawaran
            </a>
        </li>/</li>
        <li class="fw-medium">
            <a class="d-flex align-items-center gap-1">
                <iconify-icon icon="ic:baseline-edit" class="icon text-lg"></iconify-icon>
                Ubah Penawaran
            </a>
        </li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="mdi:file-document" class="menu-icon"></iconify-icon>Dokumen
                </h6>
            </div>
            <div class="card-body">
                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Project</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm" style="width:100%" id="ProjectId"></select>
                    </div>
                </div>
                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Referensi</label>
                    <div class="col-sm-10">
                        <select
                            class="form-select form-select-sm"
                            id="SphRef"
                            name="SphRef"
                            style="width:100%">
                            <option value="0" selected="selected" data-type="-">Tidak ada yang dipilih</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Store</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm" style="width:100%" id="StoreId"></select>
                    </div>
                </div>
                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Tanggal</label>
                    <div class="col-sm-10">
                        <input
                            type="text"
                            id="SphDate"
                            class="form-control form-control-sm"
                            placeholder="Enter First Name">
                    </div>
                </div>
                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Admin</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm" style="width:100%" id="SphAdmin"></select>
                    </div>
                </div>
                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Alamat Project</label>
                    <div class="col-sm-10">
                        <textarea
                            id="SphProjectAddress"
                            class="form-control"
                            rows="4"
                            cols="50"
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
                    <button
                        type="button"
                        onclick="customer_add()"
                        class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                        <iconify-icon icon="ic:add" class="text-xl"></iconify-icon>
                        Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Pelanggan</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm" style="width:100%" id="CustomerId"></select>
                    </div>
                </div>

                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="SphCustName">
                    </div>
                </div>
                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Telp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="SphCustTelp">
                    </div>
                </div>
                <div class="row mb-8 gy-2 align-items-center">
                    <label class="form-label mb-0 col-sm-2">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="#0" class="form-control" rows="4" cols="50" id="SphAddress"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="ix:box-closed" class="menu-icon"></iconify-icon>Detail Produk
                </h6>
            </div>
            <div id="table-list"></div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card template-footer">
            <div class="card-header">
                <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="mdi:file-sign" class="menu-icon"></iconify-icon>Term & Condition
                </h6>
            </div>
            <div class="card-body">
                <div class="row mb-8 gy-2 align-items-center">
                    <div class="col-7">
                        <select class="form-select form-select-sm" style="width:100%" id="SphTemplate"></select>
                    </div>

                    <div class="col-5">
                        <a
                            type="button"
                            class="btn btn-sm btn-primary-600 radius-8 px-8 py-8  "
                            aria-pressed="false"
                            value="simpan"
                            aria-label="name: simpan">
                            <i class="ri-save-line pe-2"></i>Save</a>
                        <a
                            type="button"
                            class="btn btn-sm btn-primary-600 radius-8 px-8 py-8 "
                            aria-pressed="false"
                            value="simpanAs"
                            aria-label="name: simpan As">
                            <i class="ri-save-line pe-2"></i>Save AS
                        </a>
                        <a
                            type="button"
                            class="btn btn-sm btn-primary-600 radius-8 px-8 py-8  "
                            aria-pressed="false"
                            value="edit"
                            aria-label="name: edit">
                            <i class="ri-edit-line pe-2"></i>Edit</a>
                    </div>
                </div>
                <div class="row mb-1 align-items-center mt-2">
                    <div class="col-12">
                        <div name="EditFooterMessage" class="border"></div>
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
                            <input
                                type="text"
                                class="form-control"
                                id="SphSubTotal"
                                value="0"
                                readonly="readonly">
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
                            <input
                                type="text"
                                class="form-control"
                                id="SphDiscItemTotal"
                                value="0"
                                readonly="readonly">
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
                            <input type="text" class="form-control" id="SphDiscTotal" value="0">
                        </div>
                    </div>
                </div>
                <div class="row mb-8 gy-2 align-items-center">
                    <div class="form-check style-check d-flex align-items-center col-sm-4">
                        <input class="form-check-input ms-10" type="checkbox" value="" id="SphDelivery">
                        <label class="form-check-label" for="SphDelivery">
                            Pengiriman
                        </label>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-text bg-base">
                                Rp.
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="SphDeliveryTotal"
                                value="0"
                                readonly="readonly">
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
                            <input
                                type="text"
                                class="form-control"
                                id="SphGrandTotal"
                                value="0"
                                readonly="readonly">
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
                        <a
                            id="btn-cancel-edit"
                            href="<?= base_url() ?>admin/sales/penawaran"
                            class="btn btn-sm border border-danger-600 bg-hover-danger-200 text-danger-600 radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="simple-line-icons:close" class="text-xl"></iconify-icon>
                            Batalkan
                        </a>
                        <button
                            type="button"
                            id="btn-edit-penawaran"
                            class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="simple-line-icons:check" class="text-xl"></iconify-icon>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-optional"></div>
<?php
if (!isset($project)) {
    $project = (object) [
        'SphDate' => '',
        'SphCode' => '',
        'SphCustName' => '',
        'SphCustTelp' => '',
        'SphAddress' => '',
        'SphProjectAddress' => '',
        'CustomerCode' => '',
        'CustomerName' => '',
        'CustomerCompany' => '',
        'CustomerId' => 0,
        'ProjectId' => 0,
        'StoreCode' => '',
        'ProjectName' => '',
        'SphRef' => 0,
        'SphRefCode' => '',
        'SphRefType' => '-',
        'StoreName' => '',
        'StoreId' => 0,
        'code' => '',
        'username' => '',
        'id' => 0,
        'SphDelivery' => false,
        'SphDeliveryTotal' => 0,
        'SphSubTotal' => 0,
        'SphDiscItemTotal' => 0,
        'SphDiscTotal' => 0,
        'SphGrandTotal' => 0,
        'TemplateFooterDelta' => '[]',
        'TemplateFooterName' => '',
        'TemplateFooterId' => 0,
        'SphId' => 0,
        'StoreCode' => '',
    ];
}

if (!isset($detail) || !is_array($detail)) {
    $detail = [];
}
?>
<script>
    var lastUrlSearch = sessionStorage.getItem('sph_last_url_search');
    // Jika data URL asalnya ada di memori, timpa link tombol Back / Cancel /
    // Breadcrumb
    if (lastUrlSearch) {
        // 1. Terapkan ke tombol Cancel
        $('#btn-back-page').attr('href', lastUrlSearch);
        $('#btn-cancel-edit').attr('href', lastUrlSearch);
        $('#breadcumb-cancel-edit').attr('href', lastUrlSearch);
    }

    $('#SphDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment('<?= $project->SphDate ?>'),
        "endDate": moment('<?= $project->SphDate ?>'),
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    $("#SphRef").select2({
        placeholder: "Pilih dokument referensi",
        ajax: {
            url: "<?= base_url() ?>select2/get-data-ref-sph",
            dataType: 'json',
            type: "POST",
            delay: 250,
            data: function(params) {
                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
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

    $("#CustomerId")
        .select2({
            placeholder: "Pilih Pelanggan",
            ajax: {
                url: "<?= base_url() ?>select2/get-data-customer",
                dataType: 'json',
                type: "POST",
                delay: 250,
                data: function(params) {
                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
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
                        "<button class=\"btn btn-sm btn-primary\" onclick=\"customer_add()\">Tambah Cus" +
                        "tomer Baru</button>"
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
        })
        .on("select2:select", function(e) {
            var data = e.params.data;
            if (data.id !== 0) {
                $('#SphCustName').val(`${data.customername}`);
                $('#SphCustTelp').val(`${data.customertelp}`);
                $('#SphAddress').val(`${data.customeraddress}`);
                $("#SphCustName").attr("readonly", false);
                $("#SphCustTelp").attr("readonly", false);
                $("#SphAddress").attr("readonly", false);
            } else {
                $("#SphCustName").attr("readonly", true);
                $("#SphCustTelp").attr("readonly", true);
                $("#SphAddress").attr("readonly", true);

            }
        });

    $("#ProjectId")
        .select2({
            placeholder: "Pilih Project",
            ajax: {
                url: "<?= base_url() ?>select2/get-data-project",
                dataType: 'json',
                type: "POST",
                delay: 250,
                data: function(params) {
                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
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
                        "<button class=\"btn btn-sm btn-primary\" onclick=\"customer_add()\">Tambah Cus" +
                        "tomer Baru</button>"
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

        })
        .on("select2:select", function(e) {
            var data = e.params.data;
            if (data.id == 0) {
                $("#StoreId").attr("disabled", false);
                $("#CustomerId").attr("disabled", false);
            } else {
                $("#StoreId").attr("disabled", true);
                $("#CustomerId").attr("disabled", true);
                $('#StoreId')
                    .append(new Option(data.store, data.storeid, true, true))
                    .trigger('change');
                $('#CustomerId')
                    .append(new Option(data.customer, data.customerid, true, true))
                    .trigger('change');

                $('#SphCustName').val(`${data.customername}`);
                $('#SphCustTelp').val(`${data.customertelp}`);
                $('#SphAddress').val(`${data.customeraddress}`);

            }
        });
    // $('#ProjectId').append(new Option("Tidak ada yang dipilih" , 0, true,
    // true)).trigger('change');

    $("#StoreId").select2({
        placeholder: "Pilih Toko",
        ajax: {
            url: "<?= base_url() ?>select2/get-data-store",
            dataType: 'json',
            type: "POST",
            delay: 250,
            data: function(params) {
                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
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
        }
    });

    $("#SphAdmin").select2({
        placeholder: "Pilih Admin",
        ajax: {
            url: "<?= base_url() ?>select2/get-data-users",
            dataType: 'json',
            type: "POST",
            delay: 250,
            data: function(params) {
                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
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
        }
    });

    /* EDIT MODE
     */
    $("#SphCode").val('<?= $project->SphCode ?>');

    // CUSTOMER
    $("#SphCustName").val(`<?= $project->SphCustName ?>`);
    $("#SphCustTelp").val(`<?= $project->SphCustTelp ?>`);
    $("#SphAddress").val(`<?= $project->SphAddress ?>`);
    $("#SphProjectAddress").val(`<?= $project->SphProjectAddress ?>`);
    $('#CustomerId')
        .append(new Option(
            "<?= $project->CustomerCode . " - " . $project->CustomerName . ($project->CustomerCompany == " " ? " " : " (" . $project->CustomerName . ")") ?>",
            "<?= $project->CustomerId ?>",
            true,
            true
        ))
        .trigger('change');

    // Project
    <?php
    if ($project->ProjectId == 0) {
        echo "$('#ProjectId').append(new Option('Tidak ada yang dipilih' , 0, true, true)).trigger('change');";
        echo '$("#StoreId").attr("disabled",false);';
        echo '$("#CustomerId").attr("disabled",false);';
    } else {
        echo "$('#ProjectId').append(new Option('" . $project->StoreCode . " | " . $project->ProjectName . " | " . $project->CustomerCode . " - " . $project->CustomerName . ($project->CustomerCompany == '' ? '' : " (" . $project->CustomerName . ")") . "' , " . $project->ProjectId . ", true, true)).trigger('change');";
        echo '$("#StoreId").attr("disabled",true);';
        echo '$("#CustomerId").attr("disabled",true); ';
    }
    ?>
    // ref
    <?php
    if ($project->SphRef == 0) {
        echo "var optionref = new Option('Tidak ada yang dipilih' , 0, true, true);";
        echo '$(optionref).data("type","-");';
        echo "$('#SphRef').append(optionref).trigger('change');";
    } else {
        echo "var optionref = new Option('" . $project->SphRefCode . "' , " . $project->SphRef . ", true, true);";
        echo '$(optionref).data("type","' . $project->SphRefType . '");';
        echo "$('#SphRef').append(optionref).trigger('change');";
    }
    ?>

    // StoreId
    $('#StoreId')
        .append(new Option(
            "<?= $project->StoreCode . " - " . $project->StoreName ?>",
            "<?= $project->StoreId ?>",
            true,
            true
        ))
        .trigger('change');

    // Admin
    $('#SphAdmin')
        .append(new Option(
            "<?= $project->code . " - " . $project->username ?>",
            "<?= $project->id ?>",
            true,
            true
        ))
        .trigger('change');

    // Delivery
    $("#SphDelivery").prop("checked", <?= $project->SphDelivery ?>).trigger('change');
    $("#SphDeliveryTotal").val("<?= $project->SphDeliveryTotal ?>");
    $("#SphSubTotal").val("<?= $project->SphSubTotal ?>");
    $("#SphDiscItemTotal").val("<?= $project->SphDiscItemTotal ?>");
    $("#SphDiscTotal").val("<?= $project->SphDiscTotal ?>");
    $("#SphGrandTotal").val("<?= $project->SphGrandTotal ?>");
    $("#SphDeliveryTotal").val("<?= $project->SphDeliveryTotal ?>");
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
    grand_total_harga = function(data) {
        var grandtotal = data.totalitem - data.totaldiscitem - $("#SphDiscTotal")
            .val()
            .replace(/[^0-9-]/g, '') + parseInt(
                $("#SphDeliveryTotal").val().replace(/[^0-9-]/g, '')
            );
        $("#SphSubTotal").val(data.totalitem.toLocaleString('en-US'))
        $("#SphDiscItemTotal").val(data.totaldiscitem.toLocaleString('en-US'))
        $("#SphGrandTotal").val(grandtotal.toLocaleString('en-US'))
    };
    var table_sph_item = new tableItem("table-list", {
        dataitem: JSON.parse('<?= JSON_ENCODE($detail, true) ?>'.replace(/\n/g, '\\n')),
        baseUrl: "<?= base_url() ?>",
        modal: $('#modal-edit-penawaran')
    });
    if (table_sph_item && typeof table_sph_item.on === 'function') {
        table_sph_item.on("subtotal", function(data) {
            grand_total_harga(data);
        });
        table_sph_item.getSubTotal()
    } else {
        console.error("table_sph_item tidak terdefinisi atau method on() tidak ada");
    }

    $("#SphDiscTotal").on("keyup", function() {
        if ($("#SphDeliveryTotal").val() === "")
            $("#SphDeliveryTotal").val(0)

        grand_total_harga(table_sph_item.getSubTotal());
        if (parseInt($("#SphGrandTotal").val().replace(/[^0-9-]/g, '')) < 0) {
            $("#SphDiscTotal").val(0)
            grand_total_harga(table_sph_item.getSubTotal());
        }
    });
    $("#SphDeliveryTotal").on("keyup", function() {
        if ($("#SphDeliveryTotal").val() == "") {
            $("#SphDeliveryTotal").val(0)

        }
        grand_total_harga(table_sph_item.getSubTotal());

    });
    $('#SphDelivery').change(function() {
        if ($("#SphDelivery").is(':checked') == 0) {
            $('#SphDeliveryTotal').prop("readonly", true)
            $('#SphDeliveryTotal').val("0")
            $('#SphDeliveryTotal').trigger("keyup")
        } else {

            $('#SphDeliveryTotal').prop("readonly", false)
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
                    [
                        'bold', 'italic', 'underline', 'strike'
                    ],
                    [{
                        'list': 'ordered'
                    }]
                ]
            },
            theme: "bubble" //'snow'
        });
        quill[type].enable(false);
        quill[type].root.style.background = 'var(--bg-color)'; // warna disable
        quill[type].setContents(JSON.parse(<?= JSON_ENCODE($project->TemplateFooterDelta) ?>));
        const btnsaveas = $(el).find("a[value='simpanAs']")[0];
        const btnsave =
            $(el).find("a[value='simpan']")[0];
        const btnedit =
            $(el).find("a[value='edit']")[0];
        const selectoption = $(el).find("select")[0];
        $(btnsave).hide();
        $(btnsaveas).hide();
        $(btnedit).hide();
        $(selectoption).select2({
            placeholder: "Pilih Template",
            tags: true,
            ajax: {
                url: "<?= base_url() ?>select2/get-data-template-footer/" + type,
                dataType: 'json',
                type: "POST",
                delay: 250,
                data: function(params) {
                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
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
            createTag: function(params) {
                return {
                    id: params.term,
                    text: params.term,
                    tags: true // menandai tag baru
                };
            },
            createTagText: function(params) {
                return "Tambah '" + params.term + "'";
            },
            templateResult: function(params) {
                if (params.newTag) {
                    return "Tambah '" + params.text + "'";
                }
                if (params.loading)
                    return params.text;
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
                quill[type].root.style.background = 'var(--bg-color)'; // warna enable
            } else {
                quill[type].setContents(JSON.parse(data.delta));

                $(btnsave).hide();
                $(btnsaveas).hide();
                $(btnedit).show();

                quill[type].enable(false);
                quill[type].root.style.background = 'var(--bg-color)'; // warna enable
            }
        });
        $(selectoption).append(new Option("<?= $project->TemplateFooterName ?>", "<?= $project->TemplateFooterId ?>", true, true)).trigger('change');
        $(btnedit).show();
        $(btnsave).click(function() {
            if ($(selectoption).select2("data")[0]["id"] == $(selectoption).select2("data")[0]["text"]) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/add-data-template-footer",
                    data: {
                        "TemplateFooterName": $(selectoption).select2("data")[0]["text"],
                        "TemplateFooterDetail": quill[type]
                            .root
                            .innerHTML
                            .replace(/\s+/g, " "),
                        "TemplateFooterDelta": quill[type].getContents(),
                        "TemplateFooterCategory": type
                    },
                    success: function(data) {
                        //console.log(data);
                        if (data["status"] === true) {

                            $(btnsave).hide();
                            $(btnsaveas).hide();
                            $(btnedit).show();

                            quill[type].enable(false);
                            quill[type].root.style.background = 'var(--white)'; // warna disable
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            text: xhr["responseJSON"]['message'],
                            confirmButtonColor: "var(--brand)"
                        });
                    }
                });
            } else {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/edit-data-template-footer/" + $(selectoption).select2(
                        "data"
                    )[0]["id"],
                    data: {
                        "TemplateFooterName": $(selectoption).select2("data")[0]["text"],
                        "TemplateFooterDetail": quill[type]
                            .root
                            .innerHTML
                            .replace(/\s+/g, " "),
                        "TemplateFooterDelta": quill[type].getContents(),
                        "TemplateFooterCategory": type
                    },
                    success: function(data) {
                        //console.log(data);
                        if (data["status"] === true) {

                            $(btnsave).hide();
                            $(btnsaveas).hide();
                            $(btnedit).show();

                            quill[type].enable(false);
                        }
                        quill[type].root.style.background = 'var(--bg-color)'; // warna disable
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            text: xhr["responseJSON"]['message'],
                            confirmButtonColor: "var(--brand)"
                        });
                    }
                });
            }
        });
        $(btnsaveas).click(function() {
            $("#modal-edit-penawaran").modal("hide");
            Swal
                .fire({
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
                    preConfirm: async (name) => {
                        try {
                            $.ajax({
                                dataType: "json",
                                method: "POST",
                                url: "<?= base_url() ?>action/add-data-template-footer",
                                data: {
                                    "TemplateFooterName": name,
                                    "TemplateFooterDetail": quill[type]
                                        .root
                                        .innerHTML
                                        .replace(/\s+/g, " "),
                                    "TemplateFooterDelta": quill[type].getContents(),
                                    "TemplateFooterCategory": type
                                },
                                success: function(data) {
                                    //console.log(data);
                                    if (data["status"] === true) {
                                        $(selectoption)
                                            .append(new Option(
                                                data["data"]["TemplateFooterName"],
                                                data["data"]["TemplateFooterId"],
                                                true,
                                                true
                                            ))
                                            .trigger('change');

                                        $(btnsave).hide();
                                        $(btnsaveas).hide();
                                        $(btnedit).show();

                                        quill[type].enable(false);
                                        quill[type].root.style.background = 'var(--bg-color)'; // warna disable
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]['message'],
                                        confirmButtonColor: "var(--brand)"
                                    });
                                }
                            });
                        } catch (error) {
                            Swal.showValidationMessage(
                                `Request failed: ${error["responseJSON"]['message']}`
                            );
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                .then((result) => {
                    $(btnsave).hide();
                    $(btnsaveas).hide();
                    $(btnedit).show();

                    quill[type].enable(false);
                    quill[type].root.style.background = 'var(--bg-color)'; // warna disable
                    $("#modal-edit-penawaran").modal("show");
                });
        });
        $(btnedit).click(function() {

            $(btnsave).show();
            $(btnsaveas).show();
            $(btnedit).hide();

            quill[type].enable(true);
            quill[type].root.style.background = 'var(--white)'; // warna enable

        })
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
                $("#modal-edit-penawaran").modal("hide");
                $("#modal-optional").html(data);
                $("#modal-add-customer").modal("show");

                $("#modal-add-customer").on("hidden.bs.modal", function() {
                    $("#modal-edit-penawaran").modal("show");
                })
                isProcessingCustomerAdd = false;
            },
            error: function(xhr, textStatus, errorThrown) {
                isProcessingCustomerAdd = false;

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'],
                    confirmButtonColor: "var(--brand)"
                });
            }
        });
    }

    $("#btn-edit-penawaran").click(function() {
        var data_detail_item = table_sph_item.getDataRow();
        if ($("#CustomerId").val() == null) {
            Swal
                .fire({
                    icon: 'error',
                    text: 'Pelanggan harus dipilih...!!!',
                    confirmButtonColor: "var(--brand)"
                })
                .then(function() {
                    swal.close();
                    setTimeout(() => $("#CustomerId").select2("open"), 300);
                });
            return false;
        }
        if ($("#StoreId").val() == null) {
            Swal
                .fire({
                    icon: 'error',
                    text: 'Toko harus dipilih...!!!',
                    confirmButtonColor: "var(--brand)"
                })
                .then(function() {
                    swal.close();
                    setTimeout(() => $("#StoreId").select2("open"), 300);
                });
            return false;
        }
        if ($($(".template-footer").find("select")[0]).val() == null) {
            Swal
                .fire({
                    icon: 'error',
                    text: 'Template harus dipilih...!!!',
                    confirmButtonColor: "var(--brand)"
                })
                .then(function() {
                    swal.close();
                    setTimeout(
                        () => $($(".template-footer").find("select")[0]).select2("open"),
                        300
                    );
                });
            return;
        }
        if (data_detail_item.some((item) => item.type === "product") == false) {
            Swal
                .fire({
                    icon: 'error',
                    text: 'Produk harus dimasukan...!!!',
                    confirmButtonColor: "var(--brand)"
                })
                .then(function() {
                    swal.close();
                    setTimeout(() => $("#btn-add-product").trigger("click"), 300);
                });
            return;
        }
        if (data_detail_item.some((item) => item.satuan_id === "0") == true) {
            Swal
                .fire({
                    icon: 'error',
                    text: 'Data produk ada yang belum lengkap ...!!!',
                    confirmButtonColor: "var(--brand)"
                })
                .then(function() {
                    swal.close();
                });
            return;
        }

        var header = {
            SphCode: '<?= $project->SphCode ?>',
            SphDate: $("#SphDate")
                .data('daterangepicker')
                .startDate
                .format("YYYY-MM-DD"),
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
            SphSubTotal: $("#SphSubTotal")
                .val()
                .replace(/[^0-9]/g, ''),
            SphDiscItemTotal: $("#SphDiscItemTotal")
                .val()
                .replace(/[^0-9]/g, ''),
            SphDeliveryTotal: $("#SphDeliveryTotal")
                .val()
                .replace(/[^0-9]/g, ''),
            SphDiscTotal: $("#SphDiscTotal")
                .val()
                .replace(/[^0-9]/g, ''),
            SphGrandTotal: $("#SphGrandTotal")
                .val()
                .replace(/[^0-9]/g, '')
        }
        var detail = [];
        for (var i = 0; data_detail_item.length > i; i++) {
            if (data_detail_item[i]["type"] == "product") {
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"],
                    SphDetailText: data_detail_item[i]["text"].replace(
                        /\n/g,
                        '<br>'
                    ),
                    SphDetailType: data_detail_item[i]["type"],
                    SphDetailSatuanId: data_detail_item[i]["satuan_id"],
                    SphDetailSatuanText: data_detail_item[i]["satuan_text"],
                    SphDetailQty: data_detail_item[i]["qty"],
                    SphDetailPrice: data_detail_item[i]["price"],
                    SphDetailDisc: data_detail_item[i]["disc"],
                    SphDetailTotal: data_detail_item[i]["total"],
                    SphDetailGroup: data_detail_item[i]["group"],
                    SphDetailVarian: data_detail_item[i]["varian"]
                });
            } else {
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"],
                    SphDetailText: data_detail_item[i]["text"],
                    SphDetailType: data_detail_item[i]["type"],
                    SphDetailSatuanId: "",
                    SphDetailSatuanText: "",
                    SphDetailQty: 0,
                    SphDetailPrice: 0,
                    SphDetailDisc: 0,
                    SphDetailTotal: 0,
                    SphDetailGroup: "",
                    SphDetailVarian: []
                });
            }
        }

        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-penawaran/<?= $project->SphId ?>",
            data: {
                "header": header,
                "detail": detail
            },
            success: function(data) {
                //console.log(data);
                if (data["status"] === true) {
                    Swal
                        .fire({
                            icon: 'success',
                            text: 'Simpan data berhasil...!!!',
                            confirmButtonColor: "var(--brand)"
                        })
                        .then((result) => {
                            if (lastUrlSearch) {
                                window.location.href = lastUrlSearch;
                            } else {
                                window.location.href = "<?= base_url() ?>admin/sales/penawaran";
                            }

                        });

                } else {
                    Swal.fire({
                        icon: 'error',
                        text: data,
                        confirmButtonColor: "var(--brand)"
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'],
                    confirmButtonColor: "var(--brand)"
                });
            }
        });
    });

</script>
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

<?php $this->endSection('content'); ?>