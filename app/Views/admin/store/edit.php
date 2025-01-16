<style>
    .ql-editor p,.ql-editor span,.ql-editor li{
       font-size: 0.7rem !important ;
    }
</style>
<div class="modal fade" id="modal-edit-store" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-edit-store-label" aria-hidden="true" style="overflow-y:auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-store-label">Edit Toko</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="row"> 
                    <div class="col-12 col-md-4 text-center clearfix"> 
                        <div class="small-box justify-content-center">
                            <label class="cabinet p-auto">
                                <input type="file" class="form-control item-img file d-none" id="editMsEmpImageFile" name="editMsEmpImageFile" accept="image/*" >
                                <figure>
                                    <img src="<?= $store->StoreLogo ?>" class="image-upload m-auto" id="EditStoreLogo" name="EditStoreLogo" style="width:200px;height:200px;"/>
                                    <figcaption class="text-center"> <i class="ti-camera"></i>&nbsp; Change</figcaption>
                                </figure>
                            </label>
                        </div>
                    </div>   
                    <div class="col-12 col-md-8 "> 
                        <input id="EditStoreId" name="EditStoreId" type="text" class="form-control form-control-sm d-none" value="" require> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="EditStoreCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="EditStoreCode" name="EditStoreCode" type="text" class="form-control form-control-sm" value="<?= $store->StoreCode ?>" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="EditStoreName" class="col-sm-2 col-form-label">Nama<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="EditStoreName" name="EditStoreName" type="text" class="form-control form-control-sm" value="<?= $store->StoreName ?>" require>
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center">
                            <label for="EditStoreAddress" class="col-sm-2 col-form-label">Address<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="EditStoreAddress" name="EditStoreAddress" type="text" class="form-control form-control-sm" value="<?= $store->StoreAddress ?>" require>
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center">
                            <label for="EditStoreEmail" class="col-sm-2 col-form-label">Email<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="EditStoreEmail" name="EditStoreEmail" type="text" class="form-control form-control-sm" value="<?= $store->StoreEmail ?>" require>
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center">
                            <label for="EditStoreTelp1" class="col-sm-2 col-form-label">Telp 1<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="EditStoreTelp1" name="EditStoreTelp1" type="text" class="form-control form-control-sm" value="<?= $store->StoreTelp1 ?>" require>
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center">
                            <label for="EditStoreTelp2" class="col-sm-2 col-form-label">Telp 2</label>
                            <div class="col-sm-10">
                                <input id="EditStoreTelp2" name="EditStoreTelp2" type="text" class="form-control form-control-sm" value="<?= $store->StoreTelp2 ?>" require>
                            </div>
                        </div>  
                    </div>   
                    <div class="col-12"> 
                        <div class="row mx-1 my-3 mt-4 align-items-center">
                            <div class="label-border-right position-relative" >
                                <span class="label-dialog">Term and Condition</span> 
                            </div>
                        </div>   
                        <div class="row mb-1 align-items-center">
                            <div class="col-sm-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="p-1 px-2 nav-link active" id="pembelian-tab" data-bs-toggle="tab" data-bs-target="#pembelian-tab-pane" type="button" role="tab" aria-controls="pembelian-tab-pane" aria-selected="true">Pembelian</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="p-1 px-2  nav-link" id="penawaran-tab" data-bs-toggle="tab" data-bs-target="#penawaran-tab-pane" type="button" role="tab" aria-controls="penawaran-tab-pane" aria-selected="false">Penawaran</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="p-1 px-2  nav-link" id="invoice-tab" data-bs-toggle="tab" data-bs-target="#invoice-tab-pane" type="button" role="tab" aria-controls="invoice-tab-pane" aria-selected="false">Invoice</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="p-1 px-2  nav-link" id="proforma-tab" data-bs-toggle="tab" data-bs-target="#proforma-tab-pane" type="button" role="tab" aria-controls="proforma-tab-pane" aria-selected="false">Proforma</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="p-1 px-2  nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment-tab-pane" type="button" role="tab" aria-controls="payment-tab-pane" aria-selected="false">Payment</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="p-1 px-2  nav-link" id="pengiriman-tab" data-bs-toggle="tab" data-bs-target="#pengiriman-tab-pane" type="button" role="tab" aria-controls="pengiriman-tab-pane" aria-selected="false">Pengiriman</button>
                                    </li>
                                </ul>
                                <div class="tab-content bg-light bg-white p-2" id="myTabContent">
                                    <div class="tab-pane fade show active" id="pembelian-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                        <div class="card template-footer" style="min-height:50px;" data-type="pembelian"> 
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
                                    <div class="tab-pane fade" id="penawaran-tab-pane" role="tabpanel" aria-labelledby="Penawaran-tab" tabindex="0"> 
                                        <div class="card template-footer" style="min-height:50px;" data-type="penawaran"> 
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
                                    <div class="tab-pane fade" id="invoice-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0"> 
                                        <div class="card template-footer" style="min-height:50px;" data-type="invoice"> 
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
                                    <div class="tab-pane fade" id="proforma-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0"> 
                                        <div class="card template-footer" style="min-height:50px;"  data-type="proforma"> 
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
                                    <div class="tab-pane fade" id="payment-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0"> 
                                        <div class="card template-footer" style="min-height:50px;" data-type="payment"> 
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
                                    <div class="tab-pane fade" id="pengiriman-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0"> 
                                        <div class="card template-footer" style="min-height:50px;" data-type="pengiriman"> 
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
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary m-1" id="btn-edit-store">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editcropImagePop" tabindex="-1" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div id="Editupload-demo" class="center-block m-auto"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default float-start" data-bs-dismiss="modal">Close</button>
                <button type="button" id="editcropImageBtn" class="btn btn-primary float-end">Crop</button>
            </div>
        </div>
    </div>
</div>
<script>   
    var quill = []; 
    $(".template-footer").each(function(index, el){
        var message = $(el).find("[name='EditFooterMessage']")[0];
        var type = $(el).data("type"); 
        quill[type] = new Quill(message,  {
            debug: 'false',
            modules: {
                toolbar: [['bold', 'italic', 'underline', 'strike'],[{ 'list': 'ordered'}]],
            },  
            theme: "bubble"//'snow'
        }); 
        quill[type].enable(false);
        quill[type].root.style.background = '#F7F7F7'; // warna disable 
        const btnsave = $(el).find("a[value='simpanAs']")[0];
        const btnsaveas = $(el).find("a[value='simpan']")[0];
        const btnedit = $(el).find("a[value='edit']")[0];
        const selectoption = $(el).find("select")[0];

        $(btnsave).hide();
        $(btnsaveas).hide();
        $(btnedit).hide();
 
        $(selectoption).select2({
            dropdownParent: $('#modal-edit-store .modal-content'),
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

        
        $(btnsave).click(function(){ 
            if($(selectoption).select2("data")[0]["id"] == $(selectoption).select2("data")[0]["text"]){
                $.ajax({ 
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/add-data-template-footer", 
                    data:{
                        "name":$(selectoption).select2("data")[0]["text"] ,
                        "detail": quill[type].getSemanticHTML(), 
                        "delta": quill[type].getContents(), 
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
                        "name": $("#SphFormatFooter").select2("data")[0]["text"] ,
                        "detail": quill[type].getSemanticHTML(), 
                        "delta": quill[type].getContents(), 
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
        })
        $(btnedit).click(function(){

            $(btnsave).show();
            $(btnsaveas).show();
            $(btnedit).hide();

            quill[type].enable(true);
            quill[type].root.style.background = '#FFFFFF'; // warna enable

        }) 
    });
    
    var $edituploadCrop,
    EdittempFilename,
    EditrawImg,
    EditimageId;  
    function readFileEdit(input) {
        console.log("read input edit");
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) { 
                $("#editcropImagePop").modal("show");
                EditrawImg = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
        else {
            swal.fire("Sorry - you\'re browser doesn\'t support the FileReader API");
        }
    }  
    //vipcoecRAuMBEpD3xrErm79s
    $edituploadCrop = $("#Editupload-demo").croppie({
        viewport: {
            width: 150,
            height: 150,
            type: "circle"
        },
        boundary: {
            width: 300,
            height: 300
        },
        enforceBoundary: false,
        enableExif: true,
        background: true, 
        transparent: true 
    });
    $("#editcropImagePop").on("shown.bs.modal", function(){
        // alert("Shown pop");
        $edituploadCrop.croppie("bind", {
            url: EditrawImg
        }).then(function(){
            console.log("jQuery bind complete");
        });
    }); 
    $("#editMsEmpImageFile").on("change", function () {
        EditimageId = $(this).data("id"); 
        EdittempFilename = $(this).val();
        $("#EditcancelCropBtn").data("id", EditimageId); 
        readFileEdit(this); 
    });
    $("#editcropImageBtn").on("click", function (ev) {
        $edituploadCrop.croppie("result", {
            circle: false, 
            type: "base64",
            format: "png",
            size: {width: 150, height: 150},
            background: '#ffffff'
        }).then(async function (resp) {
            $("#EditStoreLogo").attr("src", resp);
            $("#editcropImagePop").modal("hide");

            //function remove background
            const response = await fetch('https://api.remove.bg/v1.0/removebg', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Api-Key': 'vipcoecRAuMBEpD3xrErm79s'
                },
                body: JSON.stringify({
                    'image_file_b64': resp
                })
            });
            if (response.ok) {
                const blob = await response.blob();
                const reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onload = () => {
                    const base64 = reader.result; 
                    $("#EditStoreLogo").attr("src", base64); 
                }; 
            } else {
                throw new Error(`${response.status}: ${response.statusText}`);
            }

        });
    });
    // End upload preview image

    $("#btn-edit-store").click(function(){
        if($("#EditStoreCode").val() == ""){ 
            Swal.fire({
                icon: 'error',
                text: 'Kode harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#EditStoreCode").focus(), 300); 
            }) ;
            return;
        }
        if($("#EditStoreName").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Nama harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#EditStoreName").focus(), 300); 
            });
            return;
        }
         
        $(".template-footer").each(function(index, el){
            const selectoption = $(el).find("select")[0];
            var type = $(el).data("type"); 

            if($(selectoption).select2("data").length == 0){
                Swal.fire({
                    icon: 'error',
                    text: 'template harus diisi...!!!', 
                    confirmButtonColor: "#3085d6", 
                }).then(function(){ 
                    swal.close();
                    setTimeout(function(){
                        $("#" + type +"-tab").trigger("click");
                        $(selectoption).select2("open");
                    }, 300);
                }); 
                return;
            } 
        }); 
        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-store/" +  $("#EditStoreId").val(),
            data: { 
                "StoreCode": $("#EditStoreCode").val(), 
                "StoreName": $("#EditStoreName").val(), 
                "StoreLogo": $("#EditStoreLogo").attr("src"), 
                "StoreAddress": $("#EditStoreAddress").val(), 
                "StoreEmail": $("#EditStoreEmail").val(), 
                "StoreTelp1": $("#EditStoreTelp1").val(), 
                "StoreTelp2": $("#EditStoreTelp2").val(), 
                "TemplatePembelian": $($(".template-footer[data-type='pembelian']").find("select")[0]).select2("data")[0]["id"], 
                "TemplatePenawaran": $($(".template-footer[data-type='penawaran']").find("select")[0]).select2("data")[0]["id"], 
                "TemplateInvoice": $($(".template-footer[data-type='invoice']").find("select")[0]).select2("data")[0]["id"], 
                "TemplateProforma": $($(".template-footer[data-type='proforma']").find("select")[0]).select2("data")[0]["id"], 
                "TemplatePayment": $($(".template-footer[data-type='payment']").find("select")[0]).select2("data")[0]["id"], 
                "TemplatePengiriman": $($(".template-footer[data-type='pengiriman']").find("select")[0]).select2("data")[0]["id"], 
            }, 
            success: function(data) {
                console.log(data);
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Edit toko berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {
                        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
                        $("#modal-edit-store").modal("hide");
                    });
                  
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data["err"], 
                    });
                }
                
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
        });
    })
</script>
