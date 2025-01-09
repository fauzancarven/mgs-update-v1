 
<div class="modal fade" id="modal-edit-delivery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-edit-delivery-label" style="overflow-y:auto;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-delivery-label">Edit Delivery</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-lg-6 col-12 my-1">
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Document</span> 
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="SphCode" name="SphCode" type="text" class="form-control form-control-sm input-form" value="<?= $delivery->code ?>" disabled>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphCode" class="col-sm-2 col-form-label">Ref<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="Sphref" name="Sphref" type="text" class="form-control form-control-sm input-form" value="<?= $delivery->ref ?>" disabled>
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphDate" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input id="SphDate" name="SphDate" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphStore" class="col-sm-2 col-form-label">Toko</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" id="SphStore" name="SphStore" placeholder="Pilih Toko" style="width:100%" disabled></select>  
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphAdmin" class="col-sm-2 col-form-label">Admin</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" id="SphAdmin" name="SphAdmin" placeholder="Pilih Admin" style="width:100%"></select>  
                            </div>
                        </div> 
                    </div>  
                    <div class="col-lg-6 col-12 my-1">   
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Pengiriman</span>
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="armada" class="col-sm-2 col-form-label">Armada</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm input-form" id="armada" value="<?= $delivery->armada ?>">
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="ritase" class="col-sm-2 col-form-label">Ritase</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm input-form" id="ritase" value="<?= $delivery->ritase ?>">
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="biayapengiriman" class="col-sm-2 col-form-label">Biaya Pengiriman</label>
                            <div class="col-sm-10"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="biayapengiriman" value="<?= $delivery->deliverytotal ?>">
                                </div>      
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="namereceive" class="col-sm-2 col-form-label">Penerima</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm input-form" id="namereceive" value="<?= $delivery->namereceive ?>">
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="telpreceive" class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm input-form" id="telpreceive" value="<?= $delivery->telpreceive ?>">
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphAddress" class="col-sm-2 col-form-label">Alamat Project</label>
                            <div class="col-sm-10">
                                <textarea  class="form-control form-control-sm input-form" id="SphAddress"><?= $delivery->address ?></textarea>
                            </div>
                        </div> 
                    </div>   
                </div>
                  

                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Item Detail</span> 
                    </div>
                </div>     
                <div class="card " style="min-height:50px;">
                    <div class="card-body p-2 bg-light"> 
                        <div class="row align-items-center  d-none d-md-flex px-3">
                            <div class="col-12 col-md-4 my-1">    
                                <div class="row">  
                                    <div class="col-12"> 
                                        <span class="label-head-dialog">Deskripsi</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 my-1">
                                <div class="row"> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog"><i class="ti-settings"></i></span>   
                                    </div> 
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-3">
                                                <span class="label-head-dialog">Invoice</span> 
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Sudah Dikirim</span> 
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Pengiriman</span>  
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Spare</span>  
                                            </div>
                                        </div> 
                                    </div>  
                                </div>
                            </div> 
                        </div> 
                        <div id="tb_varian" class="text-center"> 
                        </div> 
                        <div class="d-flex justify-content-center flex-column align-items-center d-none"> 
                            <div class="d-flex px-3 mt-4 gap-1">
                                <button class="btn btn-sm btn-primary my-2" id="btn-add-product"><i class="fa-solid fa-plus pe-2"></i>Tambah Item</button>
                                <button class="btn btn-sm btn-primary my-2" onclick="add_detail_category(this)"><i class="fa-solid fa-plus pe-2"></i>Tambah Kategori</button> 
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">  
                    <div class="col-12">   
                        <div class="row mx-2 my-3 align-items-center">
                            <div class="label-border-right position-relative" >
                                <span class="label-dialog">Term and Condition </span> 
                            </div>
                        </div>   
                        <div class="card " style="min-height:50px;">
                            <div class="card-body mx-2 p-2 bg-light">
                                <div class="row mb-1 align-items-center mt-2">
                                    <label for="SphAdmin" class="col-sm-2 col-form-label">Template</label>
                                    <div class="col-sm-5">
                                        <select class="form-select form-select-sm" id="SphFormatFooter" name="SphFormatFooter" placeholder="Pilih Format" style="width:100%"></select>  
                                    </div>
                                    <div class="col-5">
                                        <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpan" aria-label="name: simpan" id="savequillas"><i class="fa-solid fa-save pe-2"></i>Save As</a>
                                        <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpan" aria-label="name: simpan" id="savequill"><i class="fa-solid fa-save pe-2"></i>Save</a>
                                        <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="edit" aria-label="name: edit" id="editquill"><i class="fa-solid fa-pencil pe-2"></i>Edit</a>
                                    </div>
                                </div>    
                                <div class="row mb-1 align-items-center mt-2">
                                    <label for="message" class="col-sm-2 col-form-label">Term Of Condition</label>
                                    <div class="col-sm-10">
                                        <div id="toolbar" role="toolbar" class="position-relative">
                                            <span class="ql-formats">
                                                <button type="button" class="ql-bold" aria-pressed="false" aria-label="bold"><i class="fa-solid fa-bold"></i></button>
                                                <button type="button" class="ql-italic" aria-pressed="false" aria-label="italic"><i class="fa-solid fa-italic"></i></button>
                                                <button type="button" class="ql-underline" aria-pressed="false" aria-label="underline"><i class="fa-solid fa-underline"></i></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button type="button" class="ql-list" aria-pressed="false" value="ordered" aria-label="list: ordered"><i class="fa-solid fa-list-ol"></i></button>
                                                <button type="button" class="ql-list" aria-pressed="false" value="bullet" aria-label="list: bullet"><i class="fa-solid fa-list-ul"></i></button>
                                            </span>
                                           
                                        </div>  
                                        <div id="message" class="border"></div> 
                                    </div>
                                </div>  
                            </div>  
                        </div>  
                    </div>   
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-delivery">Simpan</button>
            </div>
        </div>
    </div>
</div>  

<div id="modal-optional"></div>
<script>    

    $('#SphDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment('<?= $delivery->date ?>'),
        "endDate":  moment('<?= $delivery->date ?>'),
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    
    $("#SphStore").select2({
        dropdownParent: $('#modal-edit-delivery .modal-content'),
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
    $('#SphStore').append(new Option("<?=$store->StoreCode. " - " . $store->StoreName ?>" , "<?=$store->StoreId?>", true, true)).trigger('change');  

    $("#SphAdmin").select2({
        dropdownParent: $('#modal-edit-delivery .modal-content'),
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
        
    var data_detail_item = JSON.parse('<?= JSON_ENCODE($detail,true) ?>');   
    
    var isProcessingSphAddCategory = false;
    add_detail_category = function(el){
        if (isProcessingSphAddCategory) {
            //console.log("project sph cancel load");
            return;
        }  
        isProcessingSphAddCategory = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $("#modal-edit-delivery").modal("hide"); 
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
            $("#modal-edit-delivery").modal("show");
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
            //console.log("project sph cancel load");
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
                
                $("#modal-edit-delivery").modal("hide");  

                $("#modal-select-item").modal("show"); 


                $('#modal-select-item').on('hidden.bs.modal', function () {
                    if (document.activeElement) {
                        document.activeElement.blur();
                    }
                    $("#modal-edit-delivery").modal("show");  
                    
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
            if(JSON.stringify(arr1) === JSON.stringify(arr2) && data_detail_item[i]["produkid"] === data.produkid ){
                Swal.fire({
                    icon: 'error',
                    text: "Item sudah ada !!!", 
                    confirmButtonColor: "#3085d6", 
                });
                return;
            }
        }  

        data["type"] = "product";
        data_detail_item.push(data)

        load_produk();

        $('#modal-select-item').modal("hide");   
    }

    
    edit_varian_click = function(index){ 
        if(data_detail_item[index]["type"] == "category"){  
            $("#modal-edit-delivery").modal("hide");
            $("#modal-edit-delivery").blur();
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
                $("#modal-edit-delivery").modal("show");
            });  
        }else{
            $("#modal-edit-delivery").modal("hide");
            $("#modal-edit-delivery").blur();
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
                $("#modal-edit-delivery").modal("show");
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
            if(data_detail_item[i]["type"] == "category"){ 
                html += `
                    <div class="row align-items-center ${i > 0 ? "border-top mt-1 pt-1" : ""} mx-1">
                        <div class="col-12 col-md-4"> 
                            <div class="row align-items-center"> 
                                <div class="col-7 col-md-12 my-1 group text-start"> 
                                    <span class="text-head-3">${String.fromCharCode(last_group_abjad)}. ${data_detail_item[i]["text"]}</span>  
                                </div>   
                                <div class="col-5 d-md-none d-block col-0 px-0"> 
                                    <div class="btn-group d-inline-block float-end" role="group"> 
                                        <button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="col-8 my-1 d-md-block d-none">   
                            <div class="row px-2 align-items-center">
                                <div class="col-2 px-0"> 
                                    <div class="btn-group d-inline-block float-end" role="group"> 
                                        <button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    </div>`;
                last_group_abjad++;
                last_group_no = 1;
            }  
            if(data_detail_item[i]["type"] == "product"){ 
                var varian = "";
                if(data_detail_item[i]["id"] != "0"){
                    varian = `  <span class="text-detail-2 text-truncate">${data_detail_item[i]["group"]}</span> 
                                <div class="d-flex gap-1">`;
                    for(var j = 0; data_detail_item[i]["varian"].length > j;j++){
                        varian += `<span class="badge badge-${j % 5}">${data_detail_item[i]["varian"][j]["varian"] + ": " + data_detail_item[i]["varian"][j]["value"]}</span>`; 
                    }
                    varian +=  '</div>';
                }
                html += `   <div class="row align-items-center  ${i > 0 ? "border-top mt-1 pt-1" : ""} mx-1">
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
                                        <div class="col-2 px-0 d-none d-md-block ">  
                                            <div class="btn-group float-end d-inline-block" role="group">  
                                                ${data_detail_item[i]["id"] == "0" ? `<button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>` : ""}
                                                <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                            </div>
                                        </div>  
                                        <div class="col-12 col-md-10 px-1">   
                                            <div class="row">  
                                                <div class="col-6 col-md-3 px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Invoice</span>
                                                    <div class="input-group"> 
                                                        <input type="text" class="form-control form-control-sm input-form berat" id="input-invoice-${i}" data-id="${i}" disabled>
                                                        <span class="input-group-text font-std px-1">${data_detail_item[i]["satuantext"]}</span>  
                                                    </div>  
                                                </div> 
                                                <div class="col-6 col-md-3 px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Sudah Dikirim</span>
                                                    <div class="input-group"> 
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block" id="input-dikirim-${i}" data-id="${i}" disabled>
                                                        <span class="input-group-text font-std px-1">${data_detail_item[i]["satuantext"]}</span> 
                                                    </div>    
                                                </div> 
                                                <div class="col-6 col-md-3  px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Pengiriman</span>
                                                    <div class="input-group">  
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" id="input-pengiriman-${i}" data-id="${i}">
                                                        <span class="input-group-text font-std px-1">${data_detail_item[i]["satuantext"]}</span> 
                                                    </div>   
                                                </div> 
                                                <div class="col-6 col-md-3  px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Spare</span>
                                                    <div class="input-group"> 
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="input-spare-${i}" data-id="${i}">
                                                        <span class="input-group-text font-std px-1">${data_detail_item[i]["satuantext"]}</span>
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
        $("#tb_varian").html(html); 
        var inputinvoice = [];
        var inputdikirim = [];
        var inputpengiriman = [];
        var inputspare = [];
        for(var i = 0; data_detail_item.length > i;i++){
            if(data_detail_item[i]["type"] == "product"){
                //event qty
                inputinvoice[i] = new Cleave(`#input-invoice-${i}`, {
                        numeral: true,
                        delimeter: ",",
                        numeralDecimalScale:2,
                        numeralThousandGroupStyle:"thousand"
                }); 
                inputinvoice[i].setRawValue(data_detail_item[i]["invoice"]);
                $(`#input-invoice-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["invoice"] = inputinvoice[$(this).data("id")].getRawValue();
                    if($(`#input-invoice-${i}`).val() == "") $(`#input-invoice-${i}`).val(0) 
                });  
  
                //event harga
                inputdikirim[i] = new Cleave(`#input-dikirim-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:2,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputdikirim[i].setRawValue(data_detail_item[i]["dikirim"]);
                $(`#input-dikirim-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["dikirim"] = inputdikirim[$(this).data("id")].getRawValue();
                    if($(`#input-dikirim-${i}`).val() == "") $(`#input-dikirim-${i}`).val(0) 
                });   

                //event harga
                inputpengiriman[i] = new Cleave(`#input-pengiriman-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:2,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputpengiriman[i].setRawValue(data_detail_item[i]["pengiriman"]);
                $(`#input-pengiriman-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["pengiriman"] = inputpengiriman[$(this).data("id")].getRawValue();
                    if($(`#input-pengiriman-${i}`).val() == "") $(`#input-pengiriman-${i}`).val(0) 
                });   
 
                //event harga
                inputspare[i] = new Cleave(`#input-spare-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:2,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputspare[i].setRawValue(data_detail_item[i]["spare"]);
                $(`#input-spare-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["spare"] = inputspare[$(this).data("id")].getRawValue();
                    if($(`#input-spare-${i}`).val() == "") $(`#input-spare-${i}`).val(0) 
                });   
            }
        }
    }
    load_produk();

    var inputbiayapengiriman = new Cleave(`#biayapengiriman`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    });  
  
    var quill = new Quill('#message',  {
        debug: 'false',
        modules: {
            toolbar: '#toolbar',
        }, 
        theme: "bubble"//'snow'
    }); 
    quill.enable(false);
    quill.root.style.background = '#F7F7F7'; // warna disable
    quill.setContents(JSON.parse(<?= JSON_ENCODE($template->delta)?>));  

    $("#savequill").hide();
    $("#savequillas").hide();
    $("#savequill").click(function(){ 
        if($("#SphFormatFooter").select2("data")[0]["id"] == $("#SphFormatFooter").select2("data")[0]["text"]){
            $.ajax({ 
                dataType: "json",
                method: "POST",
                url: "<?= base_url() ?>action/add-data-template-footer", 
                data:{
                    "name":$("#SphFormatFooter").select2("data")[0]["text"] ,
                    "detail": quill.getSemanticHTML(), 
                    "delta": quill.getContents(), 
                },
                success: function(data) {    
                    //console.log(data); 
                    if(data["status"]===true){     
                        $("#savequill").hide();
                        $("#savequillas").hide();
                        $("#editquill").show();
                        quill.enable(false);
                        quill.root.style.background = '#F7F7F7'; // warna disable    
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
                url: "<?= base_url() ?>action/edit-data-template-footer/" + $("#SphFormatFooter").select2("data")[0]["id"] , 
                data:{
                    "name": $("#SphFormatFooter").select2("data")[0]["text"] ,
                    "detail": quill.getSemanticHTML(), 
                    "delta": quill.getContents(), 
                },
                success: function(data) {    
                    //console.log(data); 
                    if(data["status"]===true){     
                        $("#savequill").hide();
                        $("#savequillas").hide();
                        $("#editquill").show();
                        quill.enable(false);
                        quill.root.style.background = '#F7F7F7'; // warna disable    
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
    $("#savequillas").click(function(){  
        $("#modal-edit-delivery").modal("hide"); 
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
                            "name": name ,
                            "detail": quill.getSemanticHTML(), 
                            "delta": quill.getContents(), 
                        },
                        success: function(data) {    
                            //console.log(data); 
                            if(data["status"]===true){    
                                $('#SphFormatFooter').append(new Option(data["data"]["name"] ,data["data"]["id"], true, true)).trigger('change');
                                $("#savequill").hide();
                                $("#savequillas").hide();
                                $("#editquill").show();
                                quill.enable(false);
                                quill.root.style.background = '#F7F7F7'; // warna disable    
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
            $("#savequill").hide();
            $("#savequillas").hide();
            $("#editquill").show();
            quill.enable(false);
            quill.root.style.background = '#F7F7F7'; // warna disable
            $("#modal-edit-delivery").modal("show");
        }); 
    })
    $("#editquill").click(function(){

        $("#editquill").hide();
        $("#savequill").show();
        $("#savequillas").show();
        quill.enable(true);
        quill.root.style.background = '#FFFFFF'; // warna enable

    }) 
    $("#SphFormatFooter").select2({
        dropdownParent: $('#modal-edit-delivery .modal-content'),
        placeholder: "Pilih Template",
        tags:true,
        ajax: {
            url: "<?= base_url()?>select2/get-data-template-footer",
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
            //console.log('Tag baru ditambahkan:', e.params.data.text);
            quill.setContents(); 
            $("#savequill").show();
            $("#savequillas").hide();
            $("#editquill").hide();
            quill.enable(true);
            quill.root.style.background = '#FFFFFF'; // warna enable
        } else {
            //console.log('select baru ditambahkan:', e.params.data.text); 
            quill.setContents(JSON.parse(data.delta));  
            
            $("#savequill").hide();
            $("#savequillas").hide();
            $("#editquill").show();
        }
    }).on("change", function(e) {   
        //console.log("change");
    });

    $('#SphFormatFooter').append(new Option("<?=$template->name ?>" , "<?=$template->id?>", true, true)).trigger('change'); 
    $("#editquill").show();

    $("#btn-add-delivery").click(function(){
        if($("#SphFormatFooter").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Template harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#SphFormatFooter").select2("open"), 300); 
            }) ;
            return; 
        }    
        if(data_detail_item.some((item) => item.type === "product") == false){
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
        if(data_detail_item.some((item) => item.satuan_id === "0" ) == true){
            Swal.fire({
                icon: 'error',
                text: 'Data produk ada yang belum lengkap ...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
            }) ;
            return; 
        }

        if(data_detail_item.map((obj) => obj.pengiriman).reduce((a, b) => a + b, 0) == 0){
            Swal.fire({
                icon: 'error',
                text: 'Qty pengiriman belum lengkap ...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
            }) ;
            return; 
        }

        if($("#armada").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Armada belum dimasukan...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#armada").focus(), 300); 
            }) ;
            return; 
        }    
        var header = {  
            date: $("#SphDate").data('daterangepicker').startDate.format("YYYY-MM-DD"),  
            admin: $("#SphAdmin").val(),  
            address: $("#SphAddress").val(), 
            armada: $("#armada").val(), 
            telpreceive: $("#telpreceive").val(), 
            namereceive: $("#namereceive").val(), 
            ritase: $("#ritase").val(), 
            templateid: $("#SphFormatFooter").val(), 
            deliverytotal: $("#biayapengiriman").val().replace(/[^0-9]/g, ''),  
        }
        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){  
            if(data_detail_item[i]["type"] == "product"){ 
                detail.push({
                    produkid: data_detail_item[i]["produkid"], 
                    text: data_detail_item[i]["text"],
                    type: data_detail_item[i]["type"], 
                    satuan_id: data_detail_item[i]["satuan_id"], 
                    satuantext: data_detail_item[i]["satuantext"],
                    group: data_detail_item[i]["group"], 
                    varian: data_detail_item[i]["varian"], 
                    pengiriman: data_detail_item[i]["pengiriman"], 
                    spare: data_detail_item[i]["spare"],  
                }); 
            }
        }
 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-delivery/<?= $delivery->id?>", 
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
                        $("#modal-edit-delivery").modal("hide");  
                        loader_data_project(<?= $invoice->ref ?>,"invoice") 
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