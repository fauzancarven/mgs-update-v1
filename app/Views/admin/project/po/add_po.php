 
<div class="modal fade" id="modal-add-po" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-add-po-label" style="overflow-y:auto;" data-menu="project">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-po-label">Tambah PO Vendor</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-lg-6 col-12 my-1 mb-2">
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
                                    <div class="input-group input-group-sm">  
                                        <select class="form-control form-control-sm" id="CustomerId" name="CustomerId"  style="width:90%"></select> 
                                        <button class="btn btn-primary btn-sm" type="button" style="width:10%" onclick="customer_add()"> 
                                            <i class="ti-plus"></i> 
                                        </button>
                                    </div>  
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="POAddress" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="POCustName" type="text" value=""/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="POAddress" class="col-sm-3 col-form-label">Telp Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="POCustTelp"  type="text" value=""/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="POAddress" class="col-sm-3 col-form-label">Alamat Project</label>
                                <div class="col-sm-9">
                                    <textarea  class="form-control form-control-sm input-form" id="POAddress"></textarea>
                                </div>
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-lg-6 col-12 my-1 mb-2">    
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Document</span>
                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" type="button"             style="position:absolute;top: -11px;right: 10px;font-size: 0.6rem;" onclick="togglecustom('document-display',this)">
                                    <span>Sembunyikan</span>
                                    <i class="fa-solid fa-angle-up"></i> 
                                </button> 
                            </div>
                        </div>  
                        
                        <div class="document-display card bg-light show mt-4 m-1 p-2">
                            <div class="row mb-1 align-items-center">
                                <label for="POCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                                <div class="col-sm-10">
                                    <input id="POCode" name="POCode" type="text" class="form-control form-control-sm input-form" value="(auto)" disabled>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center d-none">
                                <label for="ProjectId" class="col-sm-2 col-form-label">Project</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" style="width:100%" id="ProjectId"></select>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="sphref" class="col-sm-2 col-form-label">Referensi</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="sphref" name="sphref" placeholder="Pilih Toko" style="width:100%"> 
                                    </select>  
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="StoreId" class="col-sm-2 col-form-label">Toko</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" style="width:100%" id="StoreId"></select>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="PODate" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input id="PODate" name="PODate" type="text" class="form-control form-control-sm input-form" value="">
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="POAdmin" class="col-sm-2 col-form-label">Admin</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="POAdmin" name="POAdmin" placeholder="Pilih Admin" style="width:100%"></select>  
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="POVendor" class="col-sm-2 col-form-label">Vendor</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-sm">  
                                        <select class="form-select form-select-sm" id="POVendor" name="POVendor" placeholder="Pilih Vendor" style="width:90%"></select>  
                                        <button class="btn btn-primary btn-sm" type="button" style="width:10%" onclick="vendor_add()"> 
                                            <i class="ti-plus"></i> 
                                        </button>
                                    </div>
                                </div>
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled value="0" id="POSubTotal">
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="PODiscTotal" value="0">
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="POPPHTotal" value="0">
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
                                    <input type="text"class="form-control form-control-sm  input-form hargajual" disabled value="0" id="POGrandTotal" >
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

    $('#PODate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment(),
        "endDate":  moment(), 
        dropdownParent: $('#modal-add-po .modal-content'), 
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    $("#sphref").select2({
        dropdownParent: $('#modal-add-po .modal-content'),
        placeholder: "Pilih Toko",
        ajax: {
            url: "<?= base_url()?>select2/get-data-ref-po",
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
    }).on("select2:select", function(e) {  
        var data = e.params.data;      
        data_detail_item = [];  
        console.log(data);
        $('#CustomerId').append(new Option(data.customer.CustomerSelect , data.customer.CustomerId, true, true)).trigger('change');  
        $('#POCustName').val(data.customer.CustomerName);
        $('#POCustTelp').val(data.customer.CustomerTelp);
        $('#POAddress').val(data.customer.CustomerAddress); 

        
        $('#StoreId').append(new Option(data.store.StoreCode + " - " +  data.store.StoreName, data.store.StoreId, true, true)).trigger('change');   

        load_produk_ref(data.detail_item)  
        table_po_item.setData(data["detail_item"]);

        if(data["id"] == 0) {
            $(".head-ref").hide();
        }else{ 
            $(".head-ref").show();
        }
    })
    $('#sphref').append(new Option("Tidak ada yang dipilih" , 0, true, true)).trigger('change');   
        
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
                if( data_detail[i]["varian"][j]["value"] == $("#POVendor").select2("data")[0].code){
                    return_item = true;
                } 
            } 
            if(!return_item){
                data_detail[i]["visible"] = false;
            }else{
                data_detail[i]["visible"] = true;
            }
            

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
                                                <span class="font-std px-1">${rupiah(data_detail[i]["priceref"])}</span>   
                                            </div> 
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Disc</span>  
                                                <span class="font-std px-1">${rupiah(data_detail[i]["discref"])}</span>   
                                            </div> 
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Total</span>  
                                                <span class="font-std px-1">${rupiah(data_detail[i]["totalref"])}</span>   
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
        $("#POVendor").select2({
            dropdownParent: $('#modal-add-po .modal-content'),
            placeholder: "Pilih Vendor",
            data: data_vendor,
            tags:true,
            escapeMarkup: function(m) {
                return m;
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
    template_select_vendor(<?= json_encode($vendor)?>);
    
  
    $("#CustomerId").select2({
        dropdownParent: $('#modal-add-po .modal-content'),
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
            $('#POCustName').val(data.customername);
            $('#POCustTelp').val(data.customertelp);
            $('#POAddress').val(data.customeraddress); 
            $("#POCustName").attr("disabled",false);
            $("#POCustTelp").attr("disabled",false);
            $("#POAddress").attr("disabled",false);
        }else{
            $("#POCustName").attr("disabled",true);
            $("#POCustTelp").attr("disabled",true);
            $("#POAddress").attr("disabled",true);

        }
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
                $("#modal-add-po").modal("hide"); 
                $("#modal-optional").html(data);
                $("#modal-add-customer").modal("show");  

                $("#modal-add-customer").on("hidden.bs.modal",function(){ 
                    $("#modal-add-po").modal("show");  
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

    $("#ProjectId").select2({
        dropdownParent: $('#modal-add-po .modal-content'),
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
            $('#InvCustName').val(data.customername);
            $('#InvCustTelp').val(data.customertelp);
            $('#InvAddress').val(data.customeraddress);

        }
    }); 
    $('#ProjectId').append(new Option("Tidak ada yang dipilih" , 0, true, true)).trigger('change');   

    $("#StoreId").select2({
        dropdownParent: $('#modal-add-po .modal-content'),
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

    $("#POAdmin").select2({
        dropdownParent: $('#modal-add-po .modal-content'),
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
    $('#POAdmin').append(new Option("<?=$user->code. " - " . $user->username ?>" , "<?=$user->id?>", true, true)).trigger('change');   
      

    var po_sub_total = new Cleave(`#POSubTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    });  
    var po_disc_total = new Cleave(`#PODiscTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var po_grand_total = new Cleave(`#POGrandTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    });  
    var table_po_item = new tableItemPo("table-list",{
        dataitem : [],
        dropdownParent: $('#modal-add-po .modal-content'),
        baseUrl : "<?= base_url() ?>",
        modal : $('#modal-add-po')
    }); 

    grand_total_harga = function(data){
        var grandtotal =  data.totalitem  - $("#PODiscTotal").val().replace(/[^0-9-]/g, '');  
        $("#POSubTotal").val(data.totalitem.toLocaleString('en-US'))  
        $("#POGrandTotal").val(grandtotal.toLocaleString('en-US')) 
    };
    
    if (table_po_item && typeof table_po_item.on === 'function') { 
        table_po_item.on("subtotal",function(data){ 
            grand_total_harga(data);
        });
        table_po_item.getSubTotal()
    } else {
        console.error("table_po_item tidak terdefinisi atau method on() tidak ada");
    }
    $("#PODiscTotal").on("keyup",function(){
            grand_total_harga(table_po_item.getSubTotal());
        if(parseInt($("#POGrandTotal").val().replace(/[^0-9-]/g, '')) < 0){
            $("#PODiscTotal").val(0)
            grand_total_harga(table_po_item.getSubTotal());
        }
    });
     

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
        const btnsaveas = $(el).find("a[value='simpanAs']")[0];
        const btnsave = $(el).find("a[value='simpan']")[0];
        const btnedit = $(el).find("a[value='edit']")[0];
        const selectoption = $(el).find("select")[0];

        $(btnsave).hide();
        $(btnsaveas).hide();
        $(btnedit).hide();
 
        $(selectoption).select2({
            dropdownParent: $('#modal-add-po .modal-content'),
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
            $("#modal-add-po").modal("hide"); 
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
                $("#modal-add-po").modal("show");
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

    $("#btn-add-penawaran").click(function(){
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
        if($("#POVendor").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Vendor harus diinput...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
                setTimeout(function(){  
                    // $("#POVendor").select2("open")
                } , 500); 
            }) ;
            return; 
        }
        if($("#StoreId").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Toko harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
                setTimeout(function(){  
                    $("#StoreId").select2("open")
                } , 500); 
            }) ;
            return; 
        }

        var data_detail_item = table_po_item.getDataRow(); 
        if(data_detail_item.some((item) => item.type === "product") == false){
            Swal.fire({
                icon: 'error',
                text: 'Produk harus dimasukan...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                // setTimeout(() => $("#btn-add-product").trigger("click"), 300); 
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
            PODate: $("#PODate").data('daterangepicker').startDate.format("YYYY-MM-DD"), 
            PORef: $('#sphref').val(),
            PORefType: $('#sphref option:selected').data('type'),
            VendorId: ($("#POVendor").select2("data")[0]["text"] == $("#POVendor").select2("data")[0]["id"] ? 0 : $("#POVendor").val()), 
            VendorName: $("#POVendor").select2("data")[0]["text"], 
            POCustName: $("#POCustName").val(),   
            POCustTelp: $("#POCustTelp").val(),  
            POAddress: $("#POAddress").val(),  
            ProjectId: $("#ProjectId").val(),   
            StoreId: $("#StoreId").val(), 
            POAdmin: $("#POAdmin").val(),  
            TemplateId: $($(".template-footer").find("select")[0]).val(), 
            POSubTotal: $("#POSubTotal").val().replace(/[^0-9]/g, ''), 
            POPPNTotal: $("#POPPHTotal").val().replace(/[^0-9]/g, ''), 
            PODiscTotal: $("#PODiscTotal").val().replace(/[^0-9]/g, ''), 
            POGrandTotal: $("#POGrandTotal").val().replace(/[^0-9]/g, '')
        }
        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){   
            detail.push({
                ProdukId: data_detail_item[i]["produkid"], 
                PODetailText: data_detail_item[i]["text"],
                PODetailSatuanId: data_detail_item[i]["satuan_id"], 
                PODetailSatuanText: data_detail_item[i]["satuan_text"],
                PODetailQty: data_detail_item[i]["qty"], 
                PODetailPrice: data_detail_item[i]["price"],  
                PODetailTotal: data_detail_item[i]["total"], 
                PODetailType: data_detail_item[i]["type"], 
                PODetailGroup: data_detail_item[i]["group"], 
                PODetailVarian: data_detail_item[i]["varian"], 
            }); 
        }
 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-data-po", 
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
                        $("#modal-add-po").modal("hide");    
                        if($("#modal-add-po").data("menu") =="Pembelian"){
                            table.ajax.reload(null, false); 
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
    var isProcessingVendorAdd;
    function vendor_add(){
        if (isProcessingVendorAdd) { 
            return;
        }  
        isProcessingVendorAdd = true;  
        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-vendor", 
            success: function(data) {  

                $("#modal-add-po").modal("hide"); 
                $("#modal-optional").html(data);
                $("#modal-add-vendor").modal("show");  

                $("#modal-add-vendor").on("hidden.bs.modal",function(){ 
                    $("#modal-add-po").modal("show");  

                    if(data_vendor){ 
                        $('#POVendor').append(new Option(data_vendor.VendorCode + " - " - data_vendor.VendorName, data_vendor.VendorId, true, true)).trigger('change');
                    } 

                })   
                isProcessingVendorAdd = false;   
 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingVendorAdd = false; 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
</script>