 
<div class="modal fade" id="modal-add-penawaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-add-penawaran-label" style="overflow-y:auto;" data-menu="project">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-penawaran-label">Tambah Penawaran</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="row">  
                    <div class="col-lg-6 col-12 my-1 mb-2 ">
                        <div class="row mx-2 align-items-center mb-3 mb-md-1">
                            <div class="label-border-right">
                                <span class="label-dialog">Customer</span>
                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" type="button"             style="position:absolute;top: -11px;right: 10px;font-size: 0.6rem;" onclick="togglecustom('customer-display',this)">
                                    <span>Sembunyikan</span>
                                    <i class="fa-solid fa-angle-up"></i> 
                                </button> 
                            </div>
                        </div> 
                        <div class="customer-display card bg-light show mt-4 m-1 p-2">  
                            <div class="row mb-1 align-items-center">
                                <label for="CustomerId" class="col-sm-3 col-form-label">Customer</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" style="width:100%" id="CustomerId"></select>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphAddress" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="SphCustName" type="text" value="" disabled/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphAddress" class="col-sm-3 col-form-label">Telp Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="SphCustTelp"  type="text" value="" disabled/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphAddress" class="col-sm-3 col-form-label">Alamat Project</label>
                                <div class="col-sm-9">
                                    <textarea  class="form-control form-control-sm input-form" id="SphAddress"  disabled></textarea>
                                </div>
                            </div> 
                        </div>  
                    </div>  
                    <div class="col-lg-6 col-12 my-1 mb-3 mb-md-1">   
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Document</span>
                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" type="button" style="position:absolute;top: -11px;right: 10px;font-size: 0.6rem;" onclick="togglecustom('document-display',this)">
                                    <span>Sembunyikan</span>
                                    <i class="fa-solid fa-angle-up"></i> 
                                </button> 
                            </div>
                        </div>  
                        <div class="document-display card bg-light show mt-4 m-1 p-2"> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                                <div class="col-sm-10">
                                    <input id="SphCode" name="SphCode" type="text" class="form-control form-control-sm input-form" value="(auto)" disabled>
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="ProjectId" class="col-sm-2 col-form-label">Project</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" style="width:100%" id="ProjectId"></select>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="StoreId" class="col-sm-2 col-form-label">Toko</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" style="width:100%" id="StoreId"></select>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphRef" class="col-sm-2 col-form-label">Ref</label>
                                <div class="col-sm-10"> 
                                    <select class="form-select form-select-sm" id="SphRef" name="SphRef"  style="width:100%" >
                                        <option value="0" selected data-type="-">No Data Selected</option>
                                    </select>  
                                </div> 
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="SphDate" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input id="SphDate" name="SphDate" type="text" class="form-control form-control-sm input-form" value="">
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="SphAdmin" class="col-sm-2 col-form-label">Admin</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="SphAdmin" name="SphAdmin" placeholder="Pilih Admin" style="width:100%"></select>  
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="SphDelivery" class="col-sm-2 col-form-label">Pengiriman</label>
                                <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="SphDelivery" id="SphDelivery1" value="0">
                                    <label class="text-detail" for="SphDelivery1">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="SphDelivery" id="SphDelivery2" value="1" checked>
                                    <label class="text-detail" for="SphDelivery2">Ya</label>
                                </div>
                                </div>
                            </div>  
                        </div>   
                    </div>   
                </div>
                  

                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Detail Produk</span> 
                    </div>
                </div>     
                <div id="table-list"> 
                </div>  

                <div class="row">  
                    <div class="col-12 col-md-8 px-1 order-2 order-md-1">   
                        <div class="row mx-2 my-3 align-items-center">
                            <div class="label-border-right position-relative" >
                                <span class="label-dialog">Term and Condition </span> 
                            </div>
                        </div>   
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
                                <span class="label-head-dialog">Disc Item Total</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled id="SphDiscItemTotal" value="0">
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
                        <div class="row align-items-center py-1">
                            <div class="col-4">
                                <span class="label-head-dialog">Pengiriman</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="SphDeliveryTotal" value="0">
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
                <button type="button" class="btn btn-primary" id="btn-add-penawaran">Simpan</button>
            </div>
        </div>
    </div>
</div>  

<div id="modal-optional"></div>
<script>     
    togglecustom = function(cls,el){
        if($("." + cls).hasClass("show")){
            $("." + cls).removeClass("show")
            $("." + cls).slideUp()
            $(el).find("i").addClass("fa-rotate-180")
            $(el).find("span").html("Tampilkan")
        }else{
            $("." + cls).addClass("show")
            $("." + cls).slideDown()
            $(el).find("i").removeClass("fa-rotate-180")
            $(el).find("span").html("Sembunyikan")
        }
    }
    $('#SphDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment(),
        "endDate":  moment(),
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    
    $('input[name="SphDelivery"]').change(function() {
        if($(this).val() == 0){
            $('#SphDeliveryTotal').prop("disabled",true)
            $('#SphDeliveryTotal').val("0")
        }else{

            $('#SphDeliveryTotal').prop("disabled",false)
        }
    });
    $("#SphRef").select2({
        dropdownParent: $('#modal-add-penawaran .modal-content'),
        placeholder: "Pilih dokument referensi",
        ajax: {
            url: "<?= base_url()?>select2/get-data-ref-sph",
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
            $(data.element).attr('data-type', data.type);
            if ($(data.html).length === 0) {
                return data.text;
            }
            return data['text'];
        }
    }); 

    $("#CustomerId").select2({
        dropdownParent: $('#modal-add-penawaran .modal-content'),
        placeholder: "Pilih Pelanggan",
        ajax: {
            url: "<?= base_url()?>select2/get-data-customer",
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
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"customer_add()\">Tambah Customer Baru</button>");
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
        if(data.id !== 0){   
            $('#SphCustName').val(data.customername);
            $('#SphCustTelp').val(data.customertelp);
            $('#SphAddress').val(data.customeraddress); 
            $("#SphCustName").attr("disabled",false);
            $("#SphCustTelp").attr("disabled",false);
            $("#SphAddress").attr("disabled",false);
        }else{
            $("#SphCustName").attr("disabled",true);
            $("#SphCustTelp").attr("disabled",true);
            $("#SphAddress").attr("disabled",true);

        }
    });

    $("#ProjectId").select2({
        dropdownParent: $('#modal-add-penawaran .modal-content'),
        placeholder: "Pilih Project",
        ajax: {
            url: "<?= base_url()?>select2/get-data-project",
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
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"customer_add()\">Tambah Customer Baru</button>");
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
        if(data.id == 0){ 
            $("#StoreId").attr("disabled",false);  
            $("#CustomerId").attr("disabled",false);
        } else{
            $("#StoreId").attr("disabled",true);
            $("#CustomerId").attr("disabled",true);
            $('#StoreId').append(new Option(data.store , data.storeid, true, true)).trigger('change');   
            $('#CustomerId').append(new Option(data.customer , data.customerid, true, true)).trigger('change');
            $('#SphCustName').val(data.customername);
            $('#SphCustTelp').val(data.customertelp);
            $('#SphAddress').val(data.customeraddress);

        }
    }); 
    $('#ProjectId').append(new Option("Tidak ada yang dipilih" , 0, true, true)).trigger('change');   

    $("#StoreId").select2({
        dropdownParent: $('#modal-add-penawaran .modal-content'),
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
        dropdownParent: $('#modal-add-penawaran .modal-content'),
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
      
 
     
    var table_sph_item = new tableItem("table-list",{
        dataitem : [],
        dropdownParent: $('#modal-add-penawaran .modal-content'),
        baseUrl : "<?= base_url() ?>",
        modal : $('#modal-add-penawaran')
    }); 

    if (table_sph_item && typeof table_sph_item.on === 'function') { 
        table_sph_item.on("subtotal",function(data){ 
            var grandtotal =  data.totalitem - data.totaldiscitem - $("#SphDiscTotal").val().replace(/[^0-9-]/g, '') + parseInt($("#SphDeliveryTotal").val().replace(/[^0-9-]/g, ''));  
            $("#SphSubTotal").val(data.totalitem.toLocaleString('en-US')) 
            $("#SphDiscItemTotal").val(data.totaldiscitem.toLocaleString('en-US')) 
            $("#SphGrandTotal").val(grandtotal.toLocaleString('en-US')) 
        });
        table_sph_item.getSubTotal()
    } else {
        console.error("table_sph_item tidak terdefinisi atau method on() tidak ada");
    }

    var sph_sub_total = new Cleave(`#SphSubTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_disc_item_total = new Cleave(`#SphDiscItemTotal`, {
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
    var sph_delivery = new Cleave(`#SphDeliveryTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    });

    $("#SphDiscTotal").on("keyup",function(){ 
        grand_total_harga();
        if(parseInt($("#SphGrandTotal").val().replace(/[^0-9-]/g, '')) < 0){
            $("#SphDiscTotal").val(0)
            grand_total_harga();
        }
    });
    
    $("#SphDeliveryTotal").on("keyup",function(){ 
        grand_total_harga(); 
    });
    
 

    var quill = [];  
    $(".template-footer").each(function(index, el){
        var message = $(el).find("[name='EditFooterMessage']")[0];
        var type = "penawaran"; 
        quill[type] = new Quill(message,  {
            debug: 'false',
            modules: {
                toolbar: [['bold', 'italic', 'underline', 'strike'],[{ 'list': 'ordered'}]],
            },  
            theme: "bubble"//'snow'
        }); 
        quill[type].enable(false);
        quill[type].root.style.background = '#F7F7F7'; // warna disable 
        const btnsaveas = $(el).find("a[value='simpanAs']")[0];
        const btnsave = $(el).find("a[value='simpan']")[0];
        const btnedit = $(el).find("a[value='edit']")[0];
        const selectoption = $(el).find("select")[0];

        $(btnsave).hide();
        $(btnsaveas).hide();
        $(btnedit).hide();
 
        $(selectoption).select2({
            dropdownParent: $('#modal-add-penawaran .modal-content'),
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
            $("#modal-add-penawaran").modal("hide"); 
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
                $("#modal-add-penawaran").modal("show");
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
    var isProcessingCustomerAdd 
    function customer_add(){
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

                $("#modal-add-customer").on("hidden.bs.modal",function(){ 
                    $("#modal-add-penawaran").modal("show");  
                })    
                isProcessingCustomerAdd = false;    
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingCustomerAdd = false; 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    $("#btn-add-penawaran").click(function(){ 
        var data_detail_item = table_sph_item.getDataRow(); 
        if($("#CustomerId").val() == nul)l{
            Swal.fire({
                icon: 'error',
                text: 'Pelanggan harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() =>  $("#CustomerId").select2("open"), 300);  
            });
            return  false;
        }  
        if($("#StoreId").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Toko harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() =>  $("#StoreId").select2("open"), 300);  
            });
            return  false;
        } 
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
            SphDate: $("#SphDate").data('daterangepicker').startDate.format("YYYY-MM-DD"),   
            ProjectId: $("#ProjectId").val(), 
            CustomerId: $("#CustomerId").val(), 
            StoreId: $("#StoreId").val(), 
            SphRef: $("#SphRef").val(), 
            SphRefType: $('#SphRef option:selected').data('type'), 
            SphAdmin: $("#SphAdmin").val(), 
            SphCustName: $("#SphCustName").val(), 
            SphCustTelp: $("#SphCustTelp").val(),   
            SphAddress: $("#SphAddress").val(),  
            SphDelivery:  $('input[name="SphDelivery"]:checked').val(),  
            TemplateId: $($(".template-footer").find("select")[0]).val(), 
            SphSubTotal: $("#SphSubTotal").val().replace(/[^0-9]/g, ''), 
            SphDiscItemTotal: $("#SphDiscItemTotal").val().replace(/[^0-9]/g, ''),
            SphDeliveryTotal: $("#SphDeliveryTotal").val().replace(/[^0-9]/g, ''),  
            SphDiscTotal: $("#SphDiscTotal").val().replace(/[^0-9]/g, ''), 
            SphGrandTotal: $("#SphGrandTotal").val().replace(/[^0-9]/g, '')
        }
        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){  
            if(data_detail_item[i]["type"] == "product"){ 
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"], 
                    SphDetailText: data_detail_item[i]["text"],
                    SphDetailType: data_detail_item[i]["type"], 
                    SphDetailSatuanId: data_detail_item[i]["satuan_id"], 
                    SphDetailSatuanText: data_detail_item[i]["satuan_text"],
                    SphDetailQty: data_detail_item[i]["qty"], 
                    SphDetailPrice: data_detail_item[i]["price"], 
                    SphDetailDisc: data_detail_item[i]["disc"], 
                    SphDetailTotal: data_detail_item[i]["total"], 
                    SphDetailGroup: data_detail_item[i]["group"], 
                    SphDetailVarian: data_detail_item[i]["varian"], 
                });
            }else{
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
                    SphDetailVarian: [], 
                });
            }
        }
 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-data-penawaran", 
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
                        $("#modal-add-penawaran").modal("hide");      
                        if($("#modal-add-penawaran").data("menu") =="Penawaran"){
                            table.ajax.reload(null, false); 
                        }else{ 
                            //loader_data_project("projectId","penawaran");  
                        }  
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