<div class="modal fade" id="modal-add-project" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Tambah Project</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="mb-1">
                    <label for="date-project" class="col-form-label">Tanggal:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="date-project">
                </div>
                <div class="mb-1">
                    <label for="customer-project" class="col-form-label">Pelanggan:</label>
                    <div class="input-group input-group-sm">  
                        <select class="form-control form-control-sm" id="customer-project" name="customer-project"  style="width:90%"></select> 
                        <button class="btn btn-primary btn-sm" type="button" style="width:10%" onclick="customer_add()"> 
                            <i class="ti-plus"></i> 
                        </button>
                    </div> 
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="store-project" class="col-form-label">Toko:</label>
                            <select class="form-select form-select-sm" style="width:100%" id="store-project"></select> 
                        </div>
                        <div class="col-6">
                            <label for="category-project" class="col-form-label">admin:</label>
                            <select class="form-select form-select-sm" style="width:100%" id="admin-project"></select>
                        </div>
                    </div> 
                </div> 
                <div class="mb-1">
                    <div class="row">
                        <div class="col-12">
                            <label for="category-project" class="col-form-label">Kategori:</label>
                            <select class="form-select form-select-sm" style="width:100%" id="category-project" multiple="multiple"></select>
                        </div> 
                    </div> 
                </div>
                <div class="mb-1">
                    <label for="comment-project" class="col-form-label">Catatan:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="comment-project">
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-project">Simpan</button>
            </div>
        </div>
    </div>
</div> 

<div id="modal-optional"></div>
<script>
     $('#date-project').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment(),
        "endDate":  moment(),
        locale: {
            format: 'DD MMMM YYYY'
        }
    }, function(start, end, label) {
        // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
    $("#btn-project-add").click(function(){ 
    });
    $("#customer-project").select2({
        dropdownParent: $('#modal-add-project .modal-content'),
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
    });
    $("#admin-project").select2({
        dropdownParent: $('#modal-add-project .modal-content'),
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
    $("#category-project").select2({
        dropdownParent: $('#modal-add-project .modal-content'),
        tags: true,
        tokenSeparators: [',', ' '],
        placeholder: "Pilih Kategori",
        ajax: {
            url: "<?= base_url()?>select2/get-data-category-project",
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
    $("#store-project").select2({
        dropdownParent: $('#modal-add-project .modal-content'),
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
        // language: {
        //     noResults: function () {
        //         return $("<button class=\"btn btn-sm btn-primary\" onclick=\"customer_add()\">Tambah Customer Baru</button>");
        //     }
        // },
        // escapeMarkup: function(m) {
        //     return m;
        // },
        // templateResult: function template(data) {
        //     if ($(data.html).length === 0) {
        //         return data.text;
        //     }
        //     return $(data.html);
        // },
        // templateSelection: function templateSelect(data) {
        //     if ($(data.html).length === 0) {
        //         return data.text;
        //     }
        //     return data['text'];
        // }
    });
    $("#btn-add-project").click(function(){ 
        if($("#customer-project").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Pelanggan harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() =>  $("#customer-project").select2("open"), 300);  
            });
            return  false;
        }
        if($("#store-project").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Toko harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() =>  $("#store-project").select2("open"), 300);  
            });
            return  false;
        }
        if($("#category-project").val().length == 0){
            Swal.fire({
                icon: 'error',
                text: 'Kategori harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() =>  $("#category-project").select2("open"), 300);  
            });
            return  false;
        }

        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-data-project", 
            data:{
                "customerid":$("#customer-project").val(),
                "date_time":$('#date-project').data('daterangepicker').startDate.format("YYYY-MM-DD") + " " + moment().format("HH:m:s"),
                "storeid":$("#store-project").val(),
                "userid":$("#admin-project").val(),
                "admin":$("#admin-project").select2("data")[0]["text"],
                "category":$("#category-project").val().join("|"),
                "comment":$("#comment-project").val() 
            },
            success: function(data) {    
                console.log(data); 
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-add-project").modal("hide");  
                        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
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
    var isProcessingCustomerAdd;
    var isProcessingSave;
    function customer_add(){
        if (isProcessingCustomerAdd) { 
            return;
        }  
        isProcessingCustomerAdd = true;  
        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-customer", 
            success: function(data) {  

                $("#modal-add-project").modal("hide"); 
                $("#modal-optional").html(data);
                $("#modal-add-customer").modal("show");  

                $("#modal-add-customer").on("hidden.bs.modal",function(){ 
                    $("#modal-add-project").modal("show");  
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
</script>