 
<div class="modal fade" id="modal-edit-po" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-edit-po-label" style="overflow-y:auto;">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-po-label">Edit PO Vendor</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-lg-6 col-12 my-1 mb-2">
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Customer</span>
                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" id="add-varian" type="button" style="position:absolute;top: -11px;right: -5px;font-size: 0.6rem;">
                                    <i class="fas fa-pencil"></i>
                                    <span class="fw-bold">
                                        &nbsp;Edit
                                    </span>
                                </button> 
                            </div>
                        </div> 
                        <div class="row align-items-center mt-2">
                            <label class="col-2 col-form-label">Nama</label>
                            <label class="col-10  text-end fw-bold"><?= $project->CustomerName ?> <?= $project->CustomerCompany == "" ? "" : " ( " . $project->CustomerCompany . " ) "; ?></label> 
                        </div> 
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Telp</label>
                            <label class="col-10 text-end fw-bold"><?= $project->CustomerTelp1 ?> / <?= $project->CustomerTelp2 == "" ? "" : $project->CustomerTelp2 ?></label> 
                        </div> 
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Email</label>
                            <label class="col-10 text-end fw-bold"><?= $project->CustomerEmail ?></label> 
                        </div>  
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Instagram</label>
                            <label class="col-10 text-end fw-bold"><?= $project->CustomerInstagram ?></label> 
                        </div>  
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Alamat</label>
                            <label class="col-10 text-end fw-bold"><?= $project->CustomerAddress ?></label> 
                        </div> 
                    </div>  
                    <div class="col-lg-6 col-12 my-1 mb-2">   
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Document</span>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="SphCode" name="SphCode" type="text" class="form-control form-control-sm input-form" value="<?= $project->POCode ?>" disabled>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="sphref" class="col-sm-2 col-form-label">ref</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" id="sphref" name="sphref" placeholder="Pilih Toko" style="width:100%">
                                    <option value="0" selected>-</option>
                                </select>  
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphDate" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input id="SphDate" name="SphDate" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphAdmin" class="col-sm-2 col-form-label">Admin</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" id="SphAdmin" name="SphAdmin" placeholder="Pilih Admin" style="width:100%"></select>  
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphVendor" class="col-sm-2 col-form-label">Vendor</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" id="SphVendor" name="SphVendor" placeholder="Pilih Vendor" style="width:100%"></select>  
                            </div>
                        </div>  
                    </div>   
                </div>
                <div class="row mx-2 my-3 align-items-center head-ref mt-3" style="display:none">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Detail dari referensi</span>  
                        <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" id="action-ref-show" type="button" style="position:absolute;top: -11px;right: -5px;font-size: 0.6rem;display:none;">
                            <i class="fas fa-eye"></i>
                            <span class="fw-bold">
                                &nbsp;show
                            </span>
                        </button> 
                        <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" id="action-ref-hide" type="button" style="position:absolute;top: -11px;right: -5px;font-size: 0.6rem">
                            <i class="fas fa-eye"></i>
                            <span class="fw-bold">
                                &nbsp;Hide
                            </span>
                        </button> 
                    </div>
                </div>   
                <div class="card detail-ref head-ref" style="min-height:50px;display:none">
                    <div class="card-body p-2 bg-light">    
                        <div class="row align-items-center d-none d-md-flex px-3">
                            <div class="col-12 col-md-6 my-1">    
                                <div class="row">  
                                    <div class="col-12"> 
                                        <span class="label-head-dialog">Deskripsi</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 my-1 ">
                                <div class="row">  
                                    <div class="col-12">
                                        <div class="row"> 
                                            <div class="col-3">
                                                <span class="label-head-dialog">Qty</span> 
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Harga</span>  
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Disc</span>  
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Total</span>  
                                            </div>
                                        </div> 
                                    </div>  
                                </div>
                            </div> 
                        </div> 
                        <div id="tb_varian_ref" class="text-center"> 
                        </div>  
                    </div>
                </div> 
                <script>
                    $("#action-ref-show").click(function(){
                        $(".detail-ref").slideDown("slow");
                        $("#action-ref-show").hide();
                        $("#action-ref-hide").show();
                    })
                    $("#action-ref-hide").click(function(){
                        $(".detail-ref").slideUp();
                        $("#action-ref-hide").hide();
                        $("#action-ref-show").show();
                    })
                </script>

                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Detail Pembelian</span> 
                    </div>
                </div>     
                <div class="card " style="min-height:50px;">
                    <div class="card-body p-2 bg-light"> 
                        <div class="row align-items-center d-none d-md-flex px-3">
                            <div class="col-12 col-md-4 my-1">    
                                <div class="row">  
                                    <div class="col-12"> 
                                        <span class="label-head-dialog">Deskripsi</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 my-1 ">
                                <div class="row"> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog"><i class="ti-settings"></i></span>   
                                    </div> 
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-3">
                                                <span class="label-head-dialog">Ref Qty</span> 
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Qty PO</span> 
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Harga</span>  
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Total</span>  
                                            </div>
                                        </div> 
                                    </div>  
                                </div>
                            </div> 
                        </div> 
                        <div id="tb_varian" class="text-center"> 
                        </div> 
                        <div class="d-flex justify-content-center flex-column align-items-center"> 
                            <div class="d-flex px-3 mt-4 gap-1">
                                <button class="btn btn-sm btn-primary my-2" id="btn-add-product"><i class="fa-solid fa-plus pe-2"></i>Tambah Item</button> 
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">  
                    <div class="col-12 col-md-8 px-1 order-2 order-md-1">   
                        <div class="row mx-2 my-3 align-items-center">
                            <div class="label-border-right position-relative" >
                                <span class="label-dialog">Term and Condition </span> 
                            </div>
                        </div>   
                        <div class="card " style="min-height:50px;"> 
                            <div class="card template-footer" style="min-height:50px;">
                                <div class="card-body mx-2 p-2 bg-light">
                                    <div class="row mb-1 align-items-center mt-2"> 
                                        <div class="col-7">
                                            <select class="form-select form-select-sm" name="Select" placeholder="Pilih Format" style="width:100%"></select>  
                                        </div>
                                        <div class="col-5">
                                            <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpanAs" aria-label="name: simpan As"><i class="fa-solid fa-save pe-2"></i>Save AS</a>
                                            <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpan" aria-label="name: simpan"><i class="fa-solid fa-save pe-2"></i>Save</a>
                                            <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="edit" aria-label="name: edit"><i class="fa-solid fa-pencil pe-2"></i>Edit</a>
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
                    </div>  
                    <div class="col-12 col-md-4 px-3 order-1 order-md-2"> 
                        <div class="row align-items-center py-1 mt-3">
                            <div class="col-4">
                                <span class="label-head-dialog">Sub Total</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled value="0" id="SphSubTotal">
                                </div>     
                            </div>
                        </div> 
                        <div class="row align-items-center py-1">
                            <div class="col-4">
                                <span class="label-head-dialog">Disc Total</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="SphDiscTotal" value="0">
                                </div>     
                            </div>
                        </div> 
                        <div class="row align-items-center py-1 d-none">
                            <div class="col-4">
                                <span class="label-head-dialog">PPN</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="SphPPHTotal" value="0">
                                </div>     
                            </div>
                        </div> 
                        <div class="row align-items-center py-1">
                            <div class="col-4">
                                <span class="label-head-dialog">Grand Total</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form hargajual" disabled value="0" id="SphGrandTotal" >
                                </div>     
                            </div>
                        </div> 
                    </div>  
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-edit-po">Simpan</button>
            </div>
        </div>
    </div>
</div>  

<div id="modal-optional"></div>
<script>    
    $('#SphDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment('<?= $project->PODate ?>'),
        "endDate":  moment('<?= $project->PODate ?>'), 
        dropdownParent: $('#modal-edit-po .modal-content'), 
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    $("#sphref").select2({
        dropdownParent: $('#modal-edit-po .modal-content'),
        placeholder: "Pilih Toko",
        ajax: {
            url: "<?= base_url()?>select2/get-data-ref-vendor/<?= $project->POId?>",
            dataType: 'json',
            type:"POST",
            delay: 250,
            data: function (params) {
                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                return {
                    searchTerm: params.term, // search term
                    [csrfName]: csrfHash // CSRF Token
                };
            },
            processResults: function (response) {
    
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
            if ($(data.html).length === 0) {
                return data.text;
            }
            return data['text'];
        }
    }); 
    function template_select_vendor(data){  
        data_vendor = [];
        for(var i = 0;data.length > i;i++){
            data_vendor.push({
                "id" : data[i].VendorId,
                "text" : data[i].VendorCode + " - " + data[i].VendorName,
                "html" : data[i].VendorCode + " - " + data[i].VendorName,
                "code" : data[i].VendorCode,
                "name" : data[i].VendorName,  
            }) 
        }
        $("#SphVendor").select2({
            dropdownParent: $('#modal-edit-po .modal-content'),
            placeholder: "Pilih Toko",
            data: data_vendor,
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
        });
    }
    $("#sphref").on("select2:select", function(e) {  
        var data = e.params.data;     
        $('#SphVendor').select2('destroy');
        $('#SphVendor').empty();    
        template_select_vendor(data.vendor); 
        data_detail_item = [];
        (data.detail_item.length > 0 ? $("#btn-add-product").hide() :   $("#btn-add-product").show());
        for(var i = 0;data.detail_item.length >i;i++){
            if(data.detail_item[i].type == "product"){
                data_detail_item.push({
                    "varian" : data.detail_item[i].varian,
                    "produkid" : data.detail_item[i].produkid,
                    "text" : data.detail_item[i].text,
                    "satuan_id" : data.detail_item[i].satuan_id,
                    "satuan_text" : data.detail_item[i].satuan_text, 
                    "qty" : data.detail_item[i].qty,  
                    "group" : data.detail_item[i].group, 
                    "harga" : data.detail_item[i].harga, 
                    "total" : data.detail_item[i].total,
                }) 
            }
        } 
        load_produk();
    }) 
    template_select_vendor({"VendorId": "<?=$project->VendorId?>","VendorName" : "<?=$project->VendorName?>"});  

    $('#sphref').append(new Option("<?= $project->InvId == 0 && $project->SphId == 0 ? "-" : ($project->InvId == 0 ? $project->SphCode : $project->InvCode) ?>" , "1", true, true)).trigger('change');   
    $('#sphref').attr("disabled",true);

    $("#SphStore").select2({
        dropdownParent: $('#modal-edit-po .modal-content'),
        placeholder: "Pilih Toko",
        ajax: {
            url: "<?= base_url()?>select2/get-data-store",
            dataType: 'json',
            type:"POST",
            delay: 250,
            data: function (params) {
                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                return {
                    searchTerm: params.term, // search term
                    [csrfName]: csrfHash // CSRF Token
                };
            },
            processResults: function (response) {
    
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
        dropdownParent: $('#modal-edit-po .modal-content'),
        placeholder: "Pilih Admin",
        ajax: {
            url: "<?= base_url()?>select2/get-data-users",
            dataType: 'json',
            type:"POST",
            delay: 250,
            data: function (params) {
                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                return {
                    searchTerm: params.term, // search term
                    [csrfName]: csrfHash // CSRF Token
                };
            },
            processResults: function (response) {
    
                // Update CSRF Token
                $('.txt_csrfname').val(response.token); 

                return {
                    results: response.data
                };
            },
            cache: true
        }, 
    });
    $('#SphAdmin').append(new Option("<?=$user->code. " - " . $user->username ?>" , "<?=$user->id?>", true, true)).trigger('change');   
    $('#SphAdmin').attr("disabled",true);

    $('#SphVendor').append(new Option("<?=$project->VendorName?>" , "0", true, true)).trigger('change');  
    $('#SphVendor').attr("disabled",true);

    var data_detail_item =  JSON.parse('<?= JSON_ENCODE($detail,true) ?>'); 
    
    var isProcessingSphAddCategory = false;
    add_detail_category = function(el){
        if (isProcessingSphAddCategory) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSphAddCategory = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $("#modal-edit-po").modal("hide"); 
        Swal.fire({
            title: 'Tambah Kategori',
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
                    data_detail_item.push({
                        type: "category",
                        text: name,
                        qty: 0,
                        hargajual: 0,
                        disc: 0,
                        total: 0, 
                        varian: [], 
                    });
                    load_produk();
                } catch (error) {
                    Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {  
            isProcessingSphAddCategory = false;
            $(el).html(old_text); 
            $("#modal-edit-po").modal("show");
        }); 
    }
 
    $('#modal-select-item').on('hidden.bs.modal', function () {
        if (document.activeElement) {
            document.activeElement.blur();
        }
    });
    var isProcessingSphAddproduk = false;

    $("#btn-add-product").click(function(){
        if (isProcessingSphAddproduk) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSphAddproduk = true; 
        let old_text = $("#btn-add-product").html();
        $("#btn-add-product").html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/select-produk", 
            success: function(data) {  
                isProcessingSphAddproduk = false; 
                $("#btn-add-product").html(old_text);
                
                $("#modal-optional").html(data);
                
                $("#modal-edit-po").modal("hide");  

                $("#modal-select-item").modal("show"); 

                $("#modal-select-item").data("type","buy"); 
                $('#modal-select-item').on('hidden.bs.modal', function () {
                    if (document.activeElement) {
                        document.activeElement.blur();
                    }
                    $("#modal-edit-po").modal("show");  
                    
                });

                //membuat event click dari modal sebelumnya
                $("#btn-add-item").click(function(event){
                    event.preventDefault();

                   
                    if($("#select-produk").val() == null){
                        Swal.fire({
                            icon: 'error',
                            text: 'Item produk harus dipilih atau perlu diinput...!!!', 
                            confirmButtonColor: "#3085d6", 
                        }).then(function(){ 
                            swal.close();
                            setTimeout(() => $("#select-produk").select2("open"), 300); 
                        }) ;
                        return; 
                    }    
                    select_produk(data_select_produk);
                });
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSphAddproduk = false;
                $("#btn-add-product").html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    });

    select_produk = function(data){
        if(data.id === undefined) return;
 
        for(var i = 0;data_detail_item.length > i;i++){  
            if(data.id == 0) continue
            if(data_detail_item[i]["type"] == "product"){ 
                var arr1 = data_detail_item[i]["varian"];
                var arr2 = data.varian;
                arr1.sort((a, b) => a.varian.localeCompare(b.varian));
                arr2.sort((a, b) => a.varian.localeCompare(b.varian));
            }
            if(JSON.stringify(arr1) === JSON.stringify(arr2) && data_detail_item[i]["id"] === data.id ){
                Swal.fire({
                    icon: 'error',
                    text: "Item sudah ada !!!", 
                    confirmButtonColor: "#3085d6", 
                });
                return;
            }
        }  

        data["type"] = "product"; 
        console.log(data);
        data_detail_item.push({
            "varian" : data.varian,
            "id" : data.id,
            "produkid" : data.produkid,
            "text" : data.text,
            "satuan_id" : data.satuan_id,
            "satuan_text" : data.satuan_text, 
            "qty" : data.qty,  
            "group" : data.group, 
            "harga" : data.price, 
            "total" : data.total,
        }) 
        load_produk();

        $('#modal-select-item').modal("hide");   
    }

    
    edit_varian_click = function(index){ 
        if(data_detail_item[index]["type"] == "category"){  
            $("#modal-edit-po").modal("hide");
            $("#modal-edit-po").blur();
            Swal.fire({
                title: 'Rename Kategori',
                input: 'text',
                inputValue: data_detail_item[index]["text"],
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
                        data_detail_item[index]["text"] = name 
                        load_produk();
                    } catch (error) {
                        Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {   
                $("#modal-edit-po").modal("show");
            });  
        }else{
            $("#modal-edit-po").modal("hide");
            $("#modal-edit-po").blur();
            Swal.fire({
                title: 'Rename Produk',
                input: 'text',
                inputValue: data_detail_item[index]["text"],
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
                        data_detail_item[index]["text"] = name 
                        load_produk();
                    } catch (error) {
                        Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {   
                $("#modal-edit-po").modal("show");
            });  
        }
    }
    delete_varian_click = function(index){ 
        data_detail_item.splice(index, 1);
        load_produk() 
    }
    up_varian_click = function(index){ 
        if (index > 0) { 
            var nilaiSementara = data_detail_item[index - 1];
            data_detail_item.splice(index - 1, 1, data_detail_item[index]);
            data_detail_item.splice(index, 1, nilaiSementara);
        }
        load_produk();
    }
    down_varian_click = function(index){  
        if (index < data_detail_item.length - 1) {
            var nilaiSementara = data_detail_item[index + 1];
            data_detail_item.splice(index + 1, 1, data_detail_item[index]);
            data_detail_item.splice(index, 1, nilaiSementara);
        }
        load_produk() 
    }
    function grand_total_harga(){
        var total = data_detail_item.reduce((acc, current) => acc + current.hargajual * current.qty, 0);
        var discitem = data_detail_item.reduce((acc, current) => acc + current.disc * current.qty , 0);
        var grandtotal =  total - discitem - $("#SphDiscTotal").val().replace(/[^0-9-]/g, ''); 

        $("#SphSubTotal").val(total.toLocaleString('en-US')) 
        $("#SphDiscItemTotal").val(discitem.toLocaleString('en-US')) 
        $("#SphGrandTotal").val(grandtotal.toLocaleString('en-US')) 
    }
    load_produk_ref = function(data_detail){
        var html = '';
        if(data_detail.length == 0){
            html += `<div class="d-flex justify-content-center flex-column align-items-center"> 
                        <img src="<?= base_url()?>assets/images/empty.png" alt="" style="width:150px;height:150px;">
                        <span class="text-head-1">Item belum ditambahkan</span>
                    </div>`;  
        }
        let last_group_abjad = 65;
        let last_group_no = 1;
        for(var i = 0; data_detail.length > i;i++){  
            var varian = ""; 
            varian = `  <span class="text-detail-2 text-truncate">${data_detail[i]["group"]}</span> 
                        <div class="d-flex gap-1">`;
            var return_item = false;
            for(var j = 0; data_detail[i]["varian"].length > j;j++){

                varian += `<span class="badge badge-${j % 5}">${data_detail[i]["varian"][j]["varian"] + ": " + data_detail[i]["varian"][j]["value"]}</span>`; 
                // if( data_detail[i]["varian"][j]["value"] == $("#SphVendor").select2("data")[0].code){
                //     return_item = true;
                // } 
            } 
            // if(!return_item){
            //     data_detail[i]["visible"] = false;
            // }else{
            //     data_detail[i]["visible"] = true;
            // }
            

            varian +=  '</div>'; 

            html += `   <div class="row align-items-center ${i > 0 ? "border-top mt-1 pt-1" : ""} mx-1">
                            <div class="col-12 col-md-6 my-1 varian px-0">   
                                <div class="d-flex">
                                    <span class="no-urut text-head-3">${last_group_no}.</span> 
                                    <div class="d-flex flex-column text-start flex-fill">
                                        <span class="text-head-3">${data_detail[i]["text"]}</span>
                                        ${varian} 
                                    </div>  
                                    <div class="btn-group d-inline-block d-md-none float-end" role="group">  
                                        ${data_detail[i]["id"] == "0" ? `<button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>` : ""}
                                        <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 my-1 detail">
                                <div class="row px-2">  
                                    <div class="col-12 col-md-12 px-1">   
                                        <div class="row">  
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty/Satuan</span> 
                                                <span class="font-std px-1">${data_detail[i]["qty"]} ${data_detail[i]["satuan_text"]}</span>   
                                            </div>   
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Harga</span>  
                                                <span class="font-std px-1">${rupiah(data_detail[i]["hargajual"])}</span>   
                                            </div> 
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Disc</span>  
                                                <span class="font-std px-1">${rupiah(data_detail[i]["disc"])}</span>   
                                            </div> 
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Total</span>  
                                                <span class="font-std px-1">${rupiah(data_detail[i]["hargajual"] * data_detail[i]["qty"])}</span>   
                                            </div> 
                                        </div>   
                                    </div>   
                                </div>    
                            </div>    
                        </div> `;

            
            last_group_no++;  
        }
        
        $("#tb_varian_ref").html(html); 
    }
    load_produk = function(){
        var html = '';
        if(data_detail_item.length == 0){
            html += `<div class="d-flex justify-content-center flex-column align-items-center"> 
                            <img src="<?= base_url()?>assets/images/empty.png" alt="" style="width:150px;height:150px;">
                            <span class="text-head-1">Item belum ditambahkan</span>
                        </div>`;  
        }
        let last_group_abjad = 65;
        let last_group_no = 1;
        for(var i = 0; data_detail_item.length > i;i++){  
            var varian = ""; 
            varian = `  <span class="text-detail-2 text-truncate">${data_detail_item[i]["group"]}</span> 
                        <div class="d-flex gap-1">`;
            var return_item = false;
            for(var j = 0; data_detail_item[i]["varian"].length > j;j++){

                varian += `<span class="badge badge-${j % 5}">${data_detail_item[i]["varian"][j]["varian"] + ": " + data_detail_item[i]["varian"][j]["value"]}</span>`; 
                // if( data_detail_item[i]["varian"][j]["value"] == $("#SphVendor").select2("data")[0].code){
                //     return_item = true;
                // } 
            } 
            if(!return_item){
                data_detail_item[i]["visible"] = false;
            }else{
                data_detail_item[i]["visible"] = true;
            }
            

            varian +=  '</div>'; 

            html += `   <div class="row align-items-center ${i > 0 ? "border-top mt-1 pt-1" : ""} mx-1">
                            <div class="col-12 col-md-4 my-1 varian px-0">   
                                <div class="d-flex">
                                    <span class="no-urut text-head-3">${last_group_no}.</span> 
                                    <div class="d-flex flex-column text-start flex-fill">
                                        <span class="text-head-3">${data_detail_item[i]["text"]}</span>
                                        ${varian} 
                                    </div>  
                                    <div class="btn-group d-inline-block d-md-none float-end" role="group">  
                                        ${data_detail_item[i]["id"] == "0" ? `<button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>` : ""}
                                        <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 my-1 detail">
                                <div class="row px-2"> 
                                    <div class="col-2 px-1 d-none d-md-block ">  
                                        <div class="btn-group float-end d-inline-block" role="group">  
                                            ${data_detail_item[i]["id"] == "0" ? `<button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>` : ""}
                                            <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                            <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                            <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                        </div>
                                    </div>  
                                    <div class="col-12 col-md-10 px-1">   
                                        <div class="row">   
                                            <div class="col-6 col-md-4 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty/Satuan</span>
                                                <div class="input-group"> 
                                                    <input type="text" class="form-control form-control-sm input-form berat" id="input-qty-${i}" data-id="${i}"> 
                                                    <select class="form-select form-select-sm select-satuan" id="select-satuan-${i}" data-id="${i}" placeholder="Pilih" ${data_detail_item[i]["id"] != "0" ? "disabled" : ""}><option value="${data_detail_item[i]["satuan_text"]}">${data_detail_item[i]["satuan_id"]}</option></select> 
                                                </div>  
                                            </div> 
                                            <div class="col-6 col-md-4 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty/Satuan</span>
                                                <div class="input-group"> 
                                                    <span class="input-group-text font-std px-1">Rp.</span>  
                                                    <input type="text" class="form-control form-control-sm input-form berat" id="input-harga-${i}" data-id="${i}"> 
                                                </div>  
                                            </div> 
                                            <div class="col-12 col-md-4 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty/Satuan</span>
                                                <div class="input-group"> 
                                                    <span class="input-group-text font-std px-1">Rp.</span>  
                                                    <input type="text" class="form-control form-control-sm input-form berat" id="input-total-${i}" data-id="${i}" disabled>  
                                                </div>  
                                            </div> 
                                        </div>   
                                    </div>   
                                </div>    
                            </div>    
                        </div> `;

            
            last_group_no++;  
        }
        $("#SphSubTotal").val(0);
        $("#SphPPHTotal").val(0);
        $("#SphDiscTotal").val(0);
        $("#SphGrandTotal").val(0);
        $("#tb_varian").html(html);  
        var inputqty = [];
        var inputharga = [];
        var inputtotal = [];
        for(var i = 0; data_detail_item.length > i;i++){  
 
            function total_harga(id){
                var total = inputharga[id].getRawValue()  * inputqty[id].getRawValue();
                data_detail_item[id]["total"] = total;
                inputtotal[id].setRawValue(total);
                grand_total_harga();
            }   

            //event satuan
            $(`#select-satuan-${i}`).select2({
                dropdownParent: $('#modal-edit-po .modal-content'), 
                placeholder: "pilih", 
                width: '5rem',
                adaptContainerWidth: true,
                ajax: {
                    url: "<?= base_url()?>select2/get-data-produk-satuan",
                    dataType: 'json',
                    type:"POST",
                    delay: 250,
                    data: function (params) {
                        // CSRF Hash
                        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                        var csrfHash = $('.txt_csrfname').val(); // CSRF hash 
                        return {
                            searchTerm: params.term, // search term
                            [csrfName]: csrfHash // CSRF Token
                        };
                    },
                    processResults: function (response) {
            
                        // Update CSRF Token
                        $('.txt_csrfname').val(response.token); 

                        return {
                            results: response.data
                        };
                    },
                    cache: true
                }, 
                language: {
                    noResults: function () {
                        return $("<button class=\"btn btn-sm btn-primary\" onclick=\"select_satuan_add()\">Tambah <b>" + $(`#select-satuan-${i}`).data('select2').dropdown.$search[0].value + "</b></button>");
                    }
                },
                formatResult: select2OptionFormat,
                formatSelection: select2OptionFormat,
                escapeMarkup: function(m) { return m; }
            }).on("select2:select", function(e) {
                var data = e.params.data;  
                data_detail_item[$(this).data("id")]["satuan_id"] = data.id
                data_detail_item[$(this).data("id")]["satuan_text"]= data.text
            });
            if(data_detail_item[i]["satuan_id"] > 0) $(`#select-satuan-${i}`).append(new Option(data_detail_item[i]["satuan_text"] , data_detail_item[i]["satuan_id"], true, true)).trigger('change');  
            if(data_detail_item[i]["id"] === "0")  $(`#select-satuan-${i}`).prop("disabled",false)
            
            //event qty
            inputqty[i] = new Cleave(`#input-qty-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:3,
                    numeralThousandGroupStyle:"thousand"
            }); 
            inputqty[i].setRawValue(data_detail_item[i]["qty"]);
            $(`#input-qty-${i}`).on("keyup",function(){ 
                data_detail_item[$(this).data("id")]["qty"] = inputqty[$(this).data("id")].getRawValue();
                if($(`#input-qty-${i}`).val() == "") $(`#input-qty-${i}`).val(0);
                total_harga($(this).data("id"));
            });   

            //event harga
            inputharga[i] = new Cleave(`#input-harga-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:3,
                    numeralThousandGroupStyle:"thousand"
            }); 
            inputharga[i].setRawValue(data_detail_item[i]["harga"]);
            $(`#input-harga-${i}`).on("keyup",function(){ 
                data_detail_item[$(this).data("id")]["harga"] = inputharga[$(this).data("id")].getRawValue();
                if($(`#input-harga-${i}`).val() == "") $(`#input-harga-${i}`).val(0);
                total_harga($(this).data("id"));
            });   

            //event total
            inputtotal[i] = new Cleave(`#input-total-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:3,
                    numeralThousandGroupStyle:"thousand"
            }); 
            inputtotal[i].setRawValue(data_detail_item[i]["total"]);
            $(`#input-total-${i}`).on("keyup",function(){ 
                data_detail_item[$(this).data("id")]["total"] = inputtotal[$(this).data("id")].getRawValue();
                if($(`#input-total-${i}`).val() == "") $(`#input-total-${i}`).val(0)  
            });   
            total_harga(i);
        }
    }
    load_produk();

    var data_detail_ref = JSON.parse('<?= JSON_ENCODE($detailref,true) ?>'); 
    if(data_detail_ref.length > 0){
        load_produk_ref(data_detail_ref);
        $(".head-ref").show();
    }
    var sph_sub_total = new Cleave(`#SphSubTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_disc_item_total = new Cleave(`#SphPPHTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_disc_total = new Cleave(`#SphDiscTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_grand_total = new Cleave(`#SphGrandTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    $("#SphPPHTotal").on("keyup",function(){ 
        grand_total_harga();
        if(parseInt($("#SphGrandTotal").val().replace(/[^0-9-]/g, '')) < 0){
            $("#SphPPHTotal").val(0)
            grand_total_harga();
        }
    }); 
    $("#SphDiscTotal").on("keyup",function(){ 
        grand_total_harga();
        if(parseInt($("#SphGrandTotal").val().replace(/[^0-9-]/g, '')) < 0){
            $("#SphDiscTotal").val(0)
            grand_total_harga();
        }
    });  
    grand_total_harga = function(){
        var total = data_detail_item.reduce((acc, current) => { 
            return acc + current.harga * current.qty; 
        },0); 
        var grandtotal =  total - $("#SphDiscTotal").val().replace(/[^0-9-]/g, ''); 

        $("#SphSubTotal").val(total.toLocaleString('en-US'))  
        $("#SphGrandTotal").val(grandtotal.toLocaleString('en-US')) 
    }
    grand_total_harga();


    var quill = [];  
    $(".template-footer").each(function(index, el){
        var message = $(el).find("[name='EditFooterMessage']")[0];
        var type = "pembelian"; 
        quill[type] = new Quill(message,  {
            debug: 'false',
            modules: {
                toolbar: [['bold', 'italic', 'underline', 'strike'],[{ 'list': 'ordered'}]],
            },  
            theme: "bubble"//'snow'
        }); 
        quill[type].enable(false);
        quill[type].root.style.background = '#F7F7F7'; // warna disable  
        quill[type].setContents(JSON.parse(<?= JSON_ENCODE($project->TemplateFooterDelta)?>));  

        const btnsaveas = $(el).find("a[value='simpanAs']")[0];
        const btnsave = $(el).find("a[value='simpan']")[0];
        const btnedit = $(el).find("a[value='edit']")[0];
        const selectoption = $(el).find("select")[0];

        $(btnsave).hide();
        $(btnsaveas).hide();
        $(btnedit).hide();
 
        $(selectoption).select2({
            dropdownParent: $('#modal-edit-po .modal-content'),
            placeholder: "Pilih Template",
            tags:true,
            ajax: {
                url: "<?= base_url()?>select2/get-data-template-footer/" + type,
                dataType: 'json',
                type:"POST",
                delay: 250,
                data: function (params) {
                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash 
                    return {
                        searchTerm: params.term, // search term
                        [csrfName]: csrfHash // CSRF Token
                    };
                },
                processResults: function (response) {
        
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
            //console.log(data);
            if (e.params.data.tags) { 
                quill[type].setContents(); 
                
                $(btnsave).show();
                $(btnsaveas).show();
                $(btnedit).hide();
 
                quill[type].enable(true);
                quill[type].root.style.background = '#FFFFFF'; // warna enable
            } else { 
                quill[type].setContents(JSON.parse(data.delta));  
                
                $(btnsave).hide();
                $(btnsaveas).hide();
                $(btnedit).show(); 

                quill[type].enable(false);
                quill[type].root.style.background = '#F7F7F7'; // warna enable
            } 
        });
        $(selectoption).append(new Option("<?=$project->TemplateFooterName ?>" , "<?=$project->TemplateFooterId?>", true, true)).trigger('change'); 
        $(btnsave).click(function(){ 
            if($(selectoption).select2("data")[0]["id"] == $(selectoption).select2("data")[0]["text"]){
                $.ajax({ 
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/add-data-template-footer", 
                    data:{
                        "TemplateFooterName":$(selectoption).select2("data")[0]["text"] ,
                        "TemplateFooterDetail": quill[type].root.innerHTML.replace(/\s+/g, " "), 
                        "TemplateFooterDelta": quill[type].getContents(), 
                        "TemplateFooterCategory": type, 
                    },
                    success: function(data) {    
                        //console.log(data); 
                        if(data["status"]===true){     
                          
                            $(btnsave).hide();
                            $(btnsaveas).hide();
                            $(btnedit).show(); 

                            quill[type].enable(false);
                            quill[type].root.style.background = '#F7F7F7'; // warna disable    
                        }
                    },
                    error : function(xhr, textStatus, errorThrown){   
                        Swal.fire({
                            icon: 'error',
                            text: xhr["responseJSON"]['message'], 
                            confirmButtonColor: "#3085d6", 
                        });
                    }
                }); 
            }else{
                $.ajax({ 
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/edit-data-template-footer/" + $(selectoption).select2("data")[0]["id"] , 
                    data:{
                        "TemplateFooterName":$(selectoption).select2("data")[0]["text"] ,
                        "TemplateFooterDetail": quill[type].root.innerHTML.replace(/\s+/g, " "), 
                        "TemplateFooterDelta": quill[type].getContents(), 
                        "TemplateFooterCategory": type, 
                    },
                    success: function(data) {    
                        //console.log(data); 
                        if(data["status"]===true){ 

                            $(btnsave).hide();
                            $(btnsaveas).hide();
                            $(btnedit).show(); 

                            quill[type].enable(false);
                            quill[type].root.style.background = '#F7F7F7'; // warna disable    
                        }
                    },
                    error : function(xhr, textStatus, errorThrown){   
                        Swal.fire({
                            icon: 'error',
                            text: xhr["responseJSON"]['message'], 
                            confirmButtonColor: "#3085d6", 
                        });
                    }
                }); 
            }
        }) 
        $(btnsaveas).click(function(){
            $("#modal-edit-po").modal("hide"); 
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
                preConfirm: async (name) => {
                    try {  
                        $.ajax({ 
                            dataType: "json",
                            method: "POST",
                            url: "<?= base_url() ?>action/add-data-template-footer", 
                            data:{ 
                                "TemplateFooterName": name ,
                                "TemplateFooterDetail": quill[type].root.innerHTML.replace(/\s+/g, " "), 
                                "TemplateFooterDelta": quill[type].getContents(), 
                                "TemplateFooterCategory": type, 
                            },
                            success: function(data) {    
                                //console.log(data); 
                                if(data["status"]===true){    
                                    $(selectoption).append(new Option(data["data"]["TemplateFooterName"] ,data["data"]["TemplateFooterId"], true, true)).trigger('change'); 
                                    
                                    $(btnsave).hide();
                                    $(btnsaveas).hide();
                                    $(btnedit).show(); 

                                    quill[type].enable(false);
                                    quill[type].root.style.background = '#F7F7F7'; // warna disable    
                                }
                            },
                            error : function(xhr, textStatus, errorThrown){   
                                Swal.fire({
                                    icon: 'error',
                                    text: xhr["responseJSON"]['message'], 
                                    confirmButtonColor: "#3085d6", 
                                });
                            }
                        }); 
                    } catch (error) {
                        Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {    
                $(btnsave).hide();
                $(btnsaveas).hide();
                $(btnedit).show(); 

                quill[type].enable(false);
                quill[type].root.style.background = '#F7F7F7'; // warna disable    
                $("#modal-edit-po").modal("show");
            }); 
        })
        $(btnedit).click(function(){

            $(btnsave).show();
            $(btnsaveas).show();
            $(btnedit).hide();

            quill[type].enable(true);
            quill[type].root.style.background = '#FFFFFF'; // warna enable

        }) 
    });

    $("#btn-edit-po").click(function(){
        if($($(".template-footer").find("select")[0]).val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Template harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $($(".template-footer").find("select")[0]).select2("open"), 300); 
            }) ;
            return; 
        }    
        
        if($("#SphVendor").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Vendor harus diinput...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
                setTimeout(function(){  
                    // $("#SphVendor").select2("open")
                } , 500); 
            }) ;
            return; 
        }
        if(data_detail_item.length == 0){
            Swal.fire({
                icon: 'error',
                text: 'Produk harus dimasukan...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#btn-add-product").trigger("click"), 300); 
            }) ;
            return; 
        }
        if(data_detail_item.some((item) => item.satuan_id === "0") == true){
            Swal.fire({
                icon: 'error',
                text: 'Data produk ada yang belum lengkap ...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
            }) ;
            return; 
        }

        var header = {   
            PODate: $("#SphDate").data('daterangepicker').startDate.format("YYYY-MM-DD"),    
            VendorId: ($("#SphVendor").select2("data")[0]["text"] == $("#SphVendor").select2("data")[0]["id"] ? 0 : $("#SphVendor").val()), 
            VendorName: $("#SphVendor").select2("data")[0]["text"], 
            POAdmin: $("#SphAdmin").val(),  
            TemplateId: $($(".template-footer").find("select")[0]).val(), 
            POSubTotal: $("#SphSubTotal").val().replace(/[^0-9]/g, ''), 
            POPPNTotal: $("#SphPPHTotal").val().replace(/[^0-9]/g, ''), 
            PODiscTotal: $("#SphDiscTotal").val().replace(/[^0-9]/g, ''), 
            POGrandTotal: $("#SphGrandTotal").val().replace(/[^0-9]/g, '')
        }
        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){   
            detail.push({
                ProdukId: data_detail_item[i]["produkid"], 
                PODetailText: data_detail_item[i]["text"],
                PODetailSatuanId: data_detail_item[i]["satuan_id"], 
                PODetailSatuanText: data_detail_item[i]["satuan_text"],
                PODetailQty: data_detail_item[i]["qty"], 
                PODetailPrice: data_detail_item[i]["harga"],  
                PODetailTotal: data_detail_item[i]["total"], 
                PODetailGroup: data_detail_item[i]["group"], 
                PODetailVarian: data_detail_item[i]["varian"], 
            }); 
        }
 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-po/<?=$project->POId?>", 
            data:{
                "header":header,
                "detail":detail, 
            },
            success: function(data) {    
                //console.log(data); 
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-edit-po").modal("hide");  
                        $("i[data-menu='pembelian'][data-id='<?= $project->ProjectId ?>']").trigger("click");  
                        
                        $("#modal-add-po").modal("hide");  
                        $("i[data-menu='pembelian'][data-id='<?= $project->ProjectId ?>']").trigger("click");     
                    });
                  
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data, 
                        confirmButtonColor: "#3085d6", 
                    });
                }
            },
            error : function(xhr, textStatus, errorThrown){   
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    });
</script>