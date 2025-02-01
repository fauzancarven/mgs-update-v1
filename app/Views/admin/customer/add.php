<!-- CUSTOMER -->
<div class="modal fade" id="modal-add-customer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-customer-label">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-customer-label">Tambah Customer</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="row">
                    <div class="col-lg-12 col-12 my-1 d-none"> 
                        <div class="row mb-1 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Pelanggan</span>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-12 my-1">
                        <div class="row mb-1 align-items-center mt-0 mt-md-2 ">
                            <label for="MsCustomerCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="MsCustomerCode" name="MsCustomerCode" type="text" class="form-control form-control-sm input-form" value="(auto)" disabled>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="MsCustomerCategory" class="col-sm-2 col-form-label">Kategori<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" id="MsCustomerCategory" name="MsCustomerCategory" placeholder="Pilih Kategori" style="width:100%"></select>  
                            </div>
                        </div>
                        <div class="row mb-1 align-items-center">
                            <label for="MsCustomerCompany" class="col-sm-2 col-form-label">Perusahaan</label>
                            <div class="col-sm-10">
                                <input id="MsCustomerCompany" name="MsCustomerCompany" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div>
                        <div class="row mb-1 align-items-center">
                            <label for="MsCustomerName" class="col-sm-2 col-form-label">Nama<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="MsCustomerName" name="MsCustomerName" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div>
                        <div class="row mb-1 align-items-center">
                            <label for="MsCustomerRemarks" class="col-sm-2 col-form-label">Catatan</label>
                            <div class="col-sm-10">
                                <input id="MsCustomerRemarks" name="MsCustomerRemarks" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-12 my-1">
                        
                        <div class="row mb-1 align-items-center mt-0 mt-md-2">
                            <label for="MsCustomerTelp1" class="col-sm-2 col-form-label">Telp.</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input id="MsCustomerTelp1" name="MsCustomerTelp1" type="text" class="form-control form-control-sm input-form input-phone" value="">
                                <span class="fw-bold px-2">/</span>
                                <input id="MsCustomerTelp2" name="MsCustomerTelp2" type="text" class="form-control form-control-sm input-form input-phone" value="">
                            </div> 
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="MsCustomerEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input id="MsCustomerEmail" name="MsCustomerEmail" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div>
                        <div class="row mb-1 align-items-center">
                            <label for="MsCustomerInstagram" class="col-sm-2 col-form-label">Instagram</label>
                            <div class="col-sm-10">
                                <input id="MsCustomerInstagram" name="MsCustomerInstagram" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div>
                        <div class="row mb-1 align-items-center">
                            <label for="MsCustomerCity" class="col-sm-2 col-form-label">Kota & Kec.</label>
                            <div class="col-sm-10 position-relative">
                                <input id="MsCustomerCity" name="MsCustomerCity" type="text" class="form-control form-control-sm input-form" value="" placeholder="Provinsi, Kota, Kecamatan, Kodepos" autocomplete="new-password">
                            </div> 
                        </div> 
                        <div class="row mb-1 align-items-center"> 
                            <div class="col-sm-10 offset-sm-2 position-relative">
                                <div class="custom-search" style="display:none;"> 
                                    <div class="search-group" style="display:block">
                                        <ul class="nav nav-tabs" id="tab-city" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="prov-tab" data-bs-toggle="tab" data-type="prov" data-bs-target="#prov-tab-pane" type="button" role="tab" aria-controls="prov-tab-pane" aria-selected="true">PROV.</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="kota-tab" data-bs-toggle="tab"  data-type="kota" data-bs-target="#kota-tab-pane" type="button" role="tab" aria-controls="kota-tab-pane" aria-selected="false" disabled>KOTA</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="kec-tab" data-bs-toggle="tab" data-type="kec"  data-bs-target="#kec-tab-pane" type="button" role="tab" aria-controls="kec-tab-pane" aria-selected="false" disabled>KEC.</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="poscode-tab" data-bs-toggle="tab"  data-type="poscode" data-bs-target="#poscode-tab-pane" type="button" role="tab" aria-controls="poscode-tab-pane" aria-selected="false" disabled>KODEPOS</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content p-0" id="nav-tabContent" style="max-height: 15rem;overflow-y:auto;">
                                            <div class="tab-pane fade show active list-group m-0" id="tab-pane" role="tabpanel" aria-labelledby="tab-pane" tabindex="0">  
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="search-text" style="display:none">
                                        <div class="tab-content p-0" style="max-height: 15rem;overflow-y:auto;">
                                            <div class="tab-pane fade show active list-group " id="list-search" role="tabpanel" aria-labelledby="tab-pane" tabindex="0">  
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="row mb-1 align-items-center">
                            <label for="MsCustomerAddress" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea id="MsCustomerAddress" name="MsCustomerAddress" type="text" class="form-control form-control-sm input-form" value="" placeholder="Nama jalan, gedung, no. rumah" ></textarea>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-customer">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".input-phone").toArray().forEach(function(el){
        new Cleave(el,{
            phone: true,
            phoneRegionCode: 'id'
        });
    })

    $("#MsCustomerCategory").select2({
        placeholder: "Pilih kategori", 
        dropdownAutoWidth: true,
        container: $('#modal-add-customer'),
        dropdownParent: $('#modal-add-customer .modal-content'),
        ajax: {
            url: "<?= base_url()?>select2/get-data-customer-category",
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
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"customer_category_add()\">Tambah <b>" + $("#MsCustomerCategory").data('select2').dropdown.$search[0].value + "</b></button>");
            }
        }
    });
    customer_category_add = function(){ 
        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url("action/add-data-customer-category") ?>",
            data: {
                "CustomerCategoryName": $("#MsCustomerCategory").data('select2').dropdown.$search[0].value 
            }, 
            success: function(data) { 
                var newOption = new Option($("#MsCustomerCategory").data('select2').dropdown.$search[0].value , data["data"]["id"], true, true);
                $('#MsCustomerCategory').append(newOption).trigger('change'); 
                $('#MsCustomerCategory').select2("close");

            }
        });
    }  
    $(document).on("select2:opening", (e) => {
        $('.modal-body').css('overflow', 'visible');
    });
    $(document).on("select2:open", (e) => {
        $('.modal-body').css('overflow', 'auto');
    });
    
    // SELECT CUSTOM VILLAGE
    var timeoutopenvillage;
    var opencustomsearchvillage = false;
    var typenavvillage = "prov";
    var selectcity = {prov : {}, kota : {},kec : {},poscode :{}};

    $("#MsCustomerCity").focus(function() { 
        $("#MsCustomerCity").val("");
        load_custom_search($("#tab-city").find(".active").data("type"));
        opencustomsearchvillage = true;
        closeSelectVillage(0);
    })
    .focusout(function(){
        opencustomsearchvillage = false;
        closeSelectVillage(500);  

        if( selectcity["prov"]["value"] !== undefined) $("#MsCustomerCity").val(selectcity["prov"]["value"] );
        if( selectcity["kota"]["value"] !== undefined) $("#MsCustomerCity").val(selectcity["prov"]["value"] + ", " + selectcity["kota"]["value"]  );
        if( selectcity["kec"]["value"] !== undefined) $("#MsCustomerCity").val(selectcity["prov"]["value"] + ", " + selectcity["kota"]["value"]   + ", " + selectcity["kec"]["value"]);
        if(selectcity["poscode"]["value"] !== undefined) $("#MsCustomerCity").val(selectcity["prov"]["value"] + ", " + selectcity["kota"]["value"] + ", " + selectcity["kec"]["value"]+ ", " + selectcity["poscode"]["value"]+ ", " + selectcity["poscode"]["kode"]);  
    }); 
    closeSelectVillage = function(delay){ 
        clearTimeout(timeoutopenvillage);
        timeoutopenvillage = setTimeout( function() 
        {
            if(!opencustomsearchvillage){ 
                $(".custom-search").hide();  
            }else{  
                $(".custom-search").show();
            }
        }, delay);
    } 
    $(".custom-search").hover(
        function() { 
            opencustomsearchvillage = true;
            closeSelectVillage(0); 
        }, function() {
            if(!$("#MsCustomerCity").is(":focus")){  
                opencustomsearchvillage = false; 
                closeSelectVillage(500);
            }
        }
    );  
    $('.nav-tabs button').on('shown.bs.tab', function (e) {  
        $("#MsCustomerCity").focus();
        var current_tab = e.target;
        var previous_tab = e.relatedTarget;  
        load_custom_search($(current_tab).data("type"));
    }); 
    load_custom_search = function(type){
        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url("select2/get-data-city") ?>",
            data: {
                "type": type,
                "select": selectcity,
            }, 
            success: function(data) {
                $("#tab-pane").html("");
                for(var i = 0;i < data.length;i++){  
                var status = ""; 
                if(type == "prov"){  
                    if(selectcity["prov"]["id"] == data[i]["id"]) status = "active";
                }
                if(type == "kota"){   
                    if(selectcity["kota"]["id"] == data[i]["id"])  status = "active";
                }
                if(type == "kec"){   
                    if(selectcity["kec"]["id"] == data[i]["id"])  status = "active";
                }
                if(type == "poscode"){   
                    if(selectcity["poscode"]["id"] == data[i]["id"])  status = "active";
                } 
                
                $("#tab-pane").append(`<a onclick="custom_click('${type}',this)" class="list-group-item list-group-item-action ${status}" data-id="${data[i]["id"]}" data-value="${data[i]["value"]}"  data-kode="${data[i]["kode"]}">${data[i]["text"]}</a>`)
                }
            }
        });
    };
    custom_click = function(type,el){
        $("#MsCustomerCity").val("");
        if(type == "prov"){  
            selectcity["prov"] = $(el).data();
            selectcity["kota"] = {};
            selectcity["kec"] = {};
            selectcity["poscode"] = {};
            $("#kota-tab").prop("disabled",false);
            $("#kec-tab").prop("disabled",true);
            $("#poscode-tab").prop("disabled",true);
            $("#kota-tab").trigger("click");

            $("#MsCustomerCity").attr("placeholder", selectcity["prov"]["value"]); 
            typenavvillage = "kota";
        }
        if(type == "kota"){  
            selectcity["kota"] = $(el).data();
            selectcity["kec"] = {};
            selectcity["poscode"] = {};
            $("#kec-tab").prop("disabled",false);
            $("#poscode-tab").prop("disabled",true);
            $("#kec-tab").trigger("click");

            $("#MsCustomerCity").attr("placeholder", selectcity["prov"]["value"] + ", " + selectcity["kota"]["value"]);
            typenavvillage = "kec";
        }
        if(type == "kec"){  
            selectcity["kec"] = $(el).data(); 
            selectcity["poscode"] = {};
            $("#poscode-tab").prop("disabled",false);
            $("#poscode-tab").trigger("click");

            $("#MsCustomerCity").attr("placeholder", selectcity["prov"]["value"] + ", " + selectcity["kota"]["value"] + ", " + selectcity["kec"]["value"]);
            typenavvillage = "poscode";
        } 
        if(type == "poscode"){   
            selectcity["poscode"] =$(el).data();   
            $("#MsCustomerCity").attr("placeholder", selectcity["prov"]["value"] + ", " + selectcity["kota"]["value"] + ", " + selectcity["kec"]["value"] + ", " + selectcity["poscode"]["value"]+ ", " + selectcity["poscode"]["kode"]);
            $("#MsCustomerCity").val(selectcity["prov"]["value"] + ", " + selectcity["kota"]["value"] + ", " + selectcity["kec"]["value"] + ", " + selectcity["poscode"]["value"]+ ", " + selectcity["poscode"]["kode"]);  
            
            opencustomsearchvillage = false;
            closeSelectVillage(0); 
        } 
    };  
    var datatable_search = []; 
    $("#MsCustomerCity").keyup(function(){ 
        if($("#MsCustomerCity").val().length > 0){
            $(".search-text").show();
            $(".search-group").hide();
            $.ajax({
                dataType: "json",
                method: "POST",
                url: "<?= base_url()?>select2/get-data-city-search",
                data: {
                    "search": $("#MsCustomerCity").val(), 
                }, 
                success: function(data) {
                    datatable_search = data;
                    $("#list-search").html("");
                    for(var i = 0;i < data.length;i++){    
                        $("#list-search").append(`<a onclick="search_click(${i})" class="list-group-item list-group-item-action" >${data[i]["text"]}</a>`)
                    }
                }
            });
        }else{ 
            $(".search-text").hide();
            $(".search-group").show(); 
        }
    });
    search_click = function(index){ 
        selectcity["prov"]["id"] = datatable_search[index]["prov"]["id"];
        selectcity["prov"]["value"] = datatable_search[index]["prov"]["value"];
        selectcity["kota"]["id"] = datatable_search[index]["kota"]["id"];
        selectcity["kota"]["value"] = datatable_search[index]["kota"]["value"];
        selectcity["kec"]["id"] = datatable_search[index]["kec"]["id"];
        selectcity["kec"]["value"] = datatable_search[index]["kec"]["value"];
        selectcity["poscode"]["id"] = datatable_search[index]["poscode"]["id"];
        selectcity["poscode"]["value"] = datatable_search[index]["poscode"]["value"];
        selectcity["poscode"]["kode"] = datatable_search[index]["poscode"]["kode"];


        $("#MsCustomerCity").attr("placeholder", selectcity["prov"]["value"] + ", " + selectcity["kota"]["value"] + ", " + selectcity["kec"]["value"] + ", " + selectcity["poscode"]["value"]+ ", " + selectcity["poscode"]["kode"]);
        $("#MsCustomerCity").val(selectcity["prov"]["value"] + ", " + selectcity["kota"]["value"] + ", " + selectcity["kec"]["value"] + ", " + selectcity["poscode"]["value"]+ ", " + selectcity["poscode"]["kode"]);
    }
    // END CUSTOM VILLAGE

    $("#btn-add-customer").click(function(e){ 
         
        if($("#MsCustomerCategory").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Kategori harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() =>  $("#MsCustomerCategory").select2("open"), 300);  
            });
            return  false;
        }
        if($("#MsCustomerName").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Nama harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#MsCustomerName").focus(), 300); 
            });
            return  false;
        }
        if($("#MsCustomerTelp1").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Telp harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#MsCustomerTelp1").focus(), 300);
            });
            return  false;
        }
        if(selectcity["poscode"]["id"] == undefined){
            Swal.fire({
                icon: 'error',
                text: 'Kota harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#MsCustomerCity").focus(), 300); 
            });
            return  false;
        }
        if($("#MsCustomerAddress").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Alamat harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#MsCustomerAddress").focus(), 300);  
            });
            return  false;
        }

        // INSERT LOADER BUTTON
        if (isProcessingSave) {
            return;
        }  
        isProcessingSave = true; 
        let old_text = $(this).html();
        $(this).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>'); 
        
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-data-customer", 
            data:{
                "code":$("#MsCustomerCode").val(),
                "category":$("#MsCustomerCategory").val(),
                "company":$("#MsCustomerCompany").val(),
                "name":$("#MsCustomerName").val(),
                "comment":$("#MsCustomerRemarks").val(),
                "telp1":$("#MsCustomerTelp1").val().replace(/ /g,""),
                "telp2":$("#MsCustomerTelp2").val().replace(/ /g,""),
                "email":$("#MsCustomerEmail").val(),
                "instagram":$("#MsCustomerInstagram").val(),
                "village":selectcity["poscode"]["id"],
                "address":$("#MsCustomerAddress").val(),
            },
            success: function(data) {    
                isProcessingSave = false;
                $(this).html(old_text);
                
                console.log(data); 
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-add-customer").modal("hide");
                        // var newOption = new Option(data["data"]["code"] + " - " + data["data"]["name"], data["data"]["id"], true, true);
                        // $('#customer-project').append(newOption).trigger('change'); 
                        // $('#customer-project').select2("close");
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
                isProcessingSave = false;
                $(this).html(old_text);
                
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    });
</script>