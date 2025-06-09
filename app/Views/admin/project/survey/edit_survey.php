<div class="modal fade" id="modal-edit-survey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true"  data-menu="project">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Ubah Data Survey</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="mb-1">
                    <label for="SurveyCode" class="col-form-label">Kode</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="SurveyCode" disabled value="<?= $project->SurveyCode ?>">
                </div>
                <div class="mb-1">
                    <label for="SurveyDate" class="col-form-label">Tanggal</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="SurveyDate">
                </div>
                <div class="mb-1">
                    <label for="SurveyAdmin" class="col-form-label">Admin</label>
                    <select class="form-select form-select-sm" style="width:100%" id="SurveyAdmin"></select>
                </div>  
                
                <div class="mb-1">
                    <label for="ProjectId" class="col-form-label">Project</label>
                    <select class="form-select form-select-sm" style="width:100%" id="ProjectId"></select>
                </div> 
                <div class="mb-1">
                    <label for="StoreId" class="col-form-label">Toko</label>
                    <select class="form-select form-select-sm" style="width:100%" id="StoreId"></select>
                </div> 
                <div class="mb-1">
                    <label for="CustomerId" class="col-form-label">Customer</label>
                    <select class="form-select form-select-sm" style="width:100%" id="CustomerId"></select>
                </div> 
                <div class="mb-1">Nama
                    <label for="SurveyCustName" class="col-form-label">nama PIC</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="SurveyCustName" value="<?= $project->SurveyCustName?>"> 
                </div> 
                <div class="mb-1">
                    <label for="SurveyCustTelp" class="col-form-label">Telp PIC</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="SurveyCustTelp" value="<?= $project->SurveyCustTelp?>"> 
                </div> 
                <div class="mb-1">
                    <label for="SurveyAddress" class="col-form-label">Alamat Proyek</label>
                    <textarea class="form-control form-control-sm input-form" style="width:100%" id="SurveyAddress"><?= $project->SurveyAddress?></textarea> 
                </div>  
                <div class="mb-1">
                    <label for="SurveyStaff" class="col-form-label">Staff yang Bertugas</label>
                    <select class="form-select form-select-sm" style="width:100%" id="SurveyStaff" multiple="multiple"></select>
                </div> 
                <div class="mb-1">
                    <label for="SurveyAddress" class="col-form-label">Biaya Survey</label> 
                    <div class="input-group"> 
                        <span class="input-group-text font-std">Rp.</span>
                        <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="SurveyTotal" value="<?= $project->SurveyTotal?>">
                    </div>        
                </div>   
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-edit-project">Simpan</button>
            </div>
        </div>
    </div>
</div> 

<div id="modal-optional"></div>
<script>
    function escapeNewline(str) {
        return str.replace(/\n/g, '\\n');
    }
    var SurveyTotal = new Cleave(`#SurveyTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    });  
   
    $('#SurveyDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment("<?=  $project->SurveyDate ?>"),
        "endDate":  moment("<?=  $project->SurveyDate ?>"),
        locale: {
            format: 'DD MMMM YYYY'
        }
    }); 
    $("#SurveyAdmin").select2({
        dropdownParent: $('#modal-edit-project .modal-content'),
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
    
    $("#SurveyStaff").select2({
        dropdownParent: $('#modal-edit-survey .modal-content'),
        placeholder: "Pilih staff", 
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
    
    $("#ProjectId").select2({
        dropdownParent: $('#modal-edit-survey .modal-content'),
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
            $('#SurveyCustName').val(data.customername);
            $('#SurveyCustTelp').val(data.customertelp);
            $('#SurveyAddress').val(data.customeraddress);

        }
    }); 

    $("#StoreId").select2({
        dropdownParent: $('#modal-edit-survey .modal-content'),
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

    $("#CustomerId").select2({
        dropdownParent: $('#modal-edit-survey .modal-content'),
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
            $('#SurveyCustName').val(data.customername);
            $('#SurveyCustTelp').val(data.customertelp);
            $('#SurveyAddress').val(data.customeraddress); 
        }
    });

    //LOAD EDIT DATA
    var data_survey_old = JSON.parse(escapeNewline(`<?= JSON_ENCODE($project)?>`));
    if(data_survey_old["ProjectId"] > 0){  
        $('#ProjectId').append(new Option(data_survey_old["StoreCode"] + " | " + data_survey_old["ProjectName"] + " | " + data_survey_old["CustomerCode"] + " - " + data_survey_old["CustomerName"], data_survey_old["ProjectId"], true, true)).trigger('change');  
        $("#StoreId").attr("disabled",true);
        $("#CustomerId").attr("disabled",true); 
    }else{  
        $('#ProjectId').append(new Option("Tidak ada yang dipilih" , 0, true, true)).trigger('change');  
    }
    
    $('#StoreId').append(new Option(data_survey_old["StoreCode"] + " - " + data_survey_old["StoreName"], data_survey_old["StoreId"], true, true)).trigger('change');   
    $('#CustomerId').append(new Option(data_survey_old["CustomerCode"] + " - " + data_survey_old["CustomerName"], data_survey_old["CustomerId"], true, true)).trigger('change'); 
    $('#SurveyAdmin').append(new Option(data_survey_old["code"] + " - " + data_survey_old["username"]
  , data_survey_old["SurveyAdmin"], true, true)).trigger('change');    
    var staffArray = JSON.parse('<?=JSON_ENCODE($staff)?>');
    staffArray.forEach(element => {
        $('#SurveyStaff').append(new Option(element["code"] + " - " + element["username"] , element["id"], true, true)).trigger('change');
    }); 





    $("#btn-edit-project").click(function(){ 
        if($("#CustomerId").val() == null){
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
        if($("#SurveyStaff").val().length == 0){
            Swal.fire({
                icon: 'error',
                text: 'Staff harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() =>  $("#SurveyStaff").select2("open"), 300);  
            });
            return  false;
        } 

        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-survey/<?= $project->SurveyId ?>",  
            data:{ 
                "ProjectId": $("#ProjectId").val(), 
                "CustomerId": $("#CustomerId").val(), 
                "StoreId": $("#StoreId").val(), 
                "SurveyCode": $("#SurveyCode").val(), 
                "SurveyDate":$('#SurveyDate').data('daterangepicker').startDate.format("YYYY-MM-DD") + " " + moment().format("HH:m:s"),
                "SurveyAdmin": $("#SurveyAdmin").val(),   
                "SurveyStaff":$("#SurveyStaff").val().join("|"), 
                "SurveyCustTelp":$("#SurveyCustTelp").val() ,
                "SurveyCustName":$("#SurveyCustName").val() ,
                "SurveyAddress":$("#SurveyAddress").val(),
                "SurveyTotal": $("#SurveyTotal").val().replace(/[^0-9]/g, ''),  
            },
            success: function(data) {    
                //console.log(data); 
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {    
                        $("#modal-edit-survey").modal("hide");   
                         
                        if($("#modal-edit-survey").data("menu") =="Survey"){ 
                            table.ajax.reload(null, false);; 
                        }else{ 
                            loader_data_project($("#ProjectId").val(),'survey'); 
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