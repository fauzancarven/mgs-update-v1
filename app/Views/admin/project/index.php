<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>

<style>
    .simple-pagination ul {
        margin: 0 0 20px;
        padding: 0;
        list-style: none;
        text-align: left;
    }

    .simple-pagination li {
        display: inline-block;
        margin-right: 5px;

    }

    .simple-pagination li a,
    .simple-pagination li span {
        color: #666;
        padding: 8px 12px;
        text-decoration: none;
        background-color: #FFF;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    .simple-pagination .current {
        color: #0B1460;
        background-color: #fff;
        border: 1px;
        border-style: solid;
    }

    .simple-pagination .prev.current,
    .simple-pagination .next.current {
        background: #fff;
    }

    .swiper-wrapper {
        position: relative;
        width: 100%;
        /* height: 63px !important; */
        height: 45px !important;
    }

    .card-project{ 
        border:1px solid #f3f3f3;
        border-left: 4px solid #3a95d0;
        border-radius: 5px;
        padding:1rem;
        color: gray;
        font-size:0.8rem;
        margin:0.5rem 0rem;
    }
    .card-project:hover{
        background: #eff6ff;  
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
    .header-project{
        font-weight:500;
        font-size:1rem;
        color:black;
    }
    .address-project{ 
        font-size:0.75rem;
    }
    .category-project{
        font-weight:bold;
        color:#0b6fdb;
    }
    .card-project > .tab-content{
        border:none;
        padding: 1rem 1rem;

    }
    .card-project > .nav-tabs .nav-link{
        background: #cbe4ff;
        border: 1px solid #fbfbfb;
        padding: 0.25rem 0.5rem;
        font-size: 0.65rem;
        font-weight: bold;
    }
    .card-project > .nav-tabs .nav-link.active{
        color: #ffffff;
        background-color: #002247;
        border: 1px solid #fbfbfb;
        
    }
    .text-header{
        display: inline-block;
        width:7rem;
    }
    .action .btn.btn-sm {
        margin: 0px;
        padding: 0rem 0.5rem;
        font-size: 0.65rem;
        background: #002247;
        color: white;
        vertical-align: middle;
        display: inline-flex;
        align-items: center;
        border-radius:0.35rem;
    }
    .action .btn.btn-sm:hover { 
        background: #01356f;
    }
    .action .action-icon {
        font-size: 0.75rem;
    }
    .action .action-text{
        padding:0.25rem;
        padding-left:0.5rem;
    }
    .card-project td,.card-project th {
        font-size:0.75rem !important;
        background: transparent;
    } 
    .modal-footer{
        flex-wrap: wrap;
        flex-direction: row !important;
        column-gap: 8px;
    } 
    .modal{ 
        font-size: 0.75rem;
        color: #7d7d7d;
    } 

    .modal .modal-dialog .modal-content .modal-footer > :not(:last-child) {
        margin-right: 0;
        margin-bottom: 0.25rem;
    } 
    
    .label-border-right {
        text-align: left;
        width: 96%;
        border-bottom: 1px solid #dee2e6;
        line-height: 0.1em;
        margin: 10px 10px 5px 15px;
    }
    .label-border-right .label-dialog {
        background: #fff;
        padding: 0 10px;
        color: #6c9bcf;
        font-size: 0.75rem;
        font-weight: bold;
    }
    span.label-dialog {
        background: #6c9bcf;
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 0.25rem;
    }
</style>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?>

<div class="card radius-15 overflow-hidden mb-3">
    <div class="card-header border-bottom-0 px-4 pt-4 bg-white mb-lg-0 mb-2">
        <div class="d-flex align-items-center row">
            <div class="mb-0 col-lg-2 col-6 pb-lg-2 pb-4 order-lg-1">
                <h6 class="mb-0">List Project</h6> 
            </div> 
            <div class="justify-content-end d-flex col-lg-2 col-6 pb-lg-2 pb-4  order-lg-3">
                <button class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#modal-add-project" >Add Project</button>
            </div>
            <div class="d-lg-flex search-bar col-lg-8 col-12 order-lg-2">
                <div class="form-inline  navbar-search w-100">
                    <div class="input-group w-100 ">
                        <input type="text" class="form-control rounded-left small bg-light " placeholder="Cari Project ..." aria-label="Search" aria-describedby="basic-addon2" name="search-project"  id="input-search-project">
                        <div class="input-group-append">
                            <button class="btn bg-light btn-light border-right border-top border-bottom rounded-right px-3" id="btn-search-project">
                                <i class="icon-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="d-flex flex-column p-4" id="element-to-print"> 
        <table class="mb-0" id="table-project">
            <thead class="d-none">
                <tr class="">
                    <th class="p-0 m-0">Element</th>  
                </tr>
            </thead> 
            <tbody class="">  
            </tbody>
        </table> 
        <div class="card card-project">
            <div class="row mb-4">
                <div class="col-6"> 
                    <div class="d-flex mb-2 align-items-center ">
                        <span class="category-project me-2">MGSME - CCTV</span>
                        <span class="mx-2">20 Oct 2024</span> 
                        <span class="ms-2">Last Activity : </span><span class="mx-2 badge bg-success text-white">Survey</span> 
                    </div>  
                    <span class="header-project">BPK. ANDRIAN</span>
                    <div class="address-project">Jl. Tlk. Peleng 116-114, RT.6/RW.8, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520</div>
                </div>
                <div class="col-6">

                </div>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Survey</button>
                </li>
                <li class="nav-item" role="presentation"> 
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Bill of Quantity (BQ)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Penawaran</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Pembelian</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" "data-bs-toggle="tab data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Invoice</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Dokumentasi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Diskusi</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <table class="table table-sm mb-0" id="table-users">
                        <thead>
                            <tr class="py-2">
                                <th data-priority="1" class="py-lg-2 py-3 px-0">Tgl. Survey</th> 
                                <th class=" py-lg-2 py-3">Petugas</th> 
                                <th class=" py-lg-2 py-3">Catatan</th> 
                                <th data-priority="2" class=" py-lg-2 py-3">Action</th>
                            </tr>
                        </thead> 
                        <tbody class="list-wrapper">
                            <tr>
                                <td>20 Oktober 2024</td>
                                <td>Fauzan, Roni, Hamzah</td>
                                <td>test</td> 
                                <td class="action">
                                    <button class="btn btn-sm"><i class="ti-eye action-icon"></i><span class="action-text">View</span></button>
                                    <button class="btn btn-sm"><i class="ti-pencil action-icon"></i><span class="action-text">Edit</span></button>
                                    <button class="btn btn-sm"><i class="ti-trash action-icon"></i><span class="action-text">Delete</span></button> 
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                    <div class="text-center mt-2">
                        <button class="btn btn-sm btn-primary px-3">Tambah Survey</button> 
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <table class="table table-sm mb-0" id="table-users">
                        <thead>
                            <tr class="py-2">
                                <th data-priority="1" class="py-lg-2 py-3 px-0">Tgl. Pembuatan</th> 
                                <th class=" py-lg-2 py-3">Petugas</th>  
                                <th class=" py-lg-2 py-3">Catatan</th> 
                                <th data-priority="2" class=" py-lg-2 py-3">Action</th>
                            </tr>
                        </thead> 
                        <tbody class="list-wrapper ">
                            <tr>
                                <td>20 Oktober 2024</td>
                                <td>Fauzan</td> 
                                <td>-</td> 
                                <td class="action">
                                    <button class="btn btn-sm"><i class="ti-eye action-icon"></i><span class="action-text">View</span></button>
                                    <button class="btn btn-sm"><i class="ti-pencil action-icon"></i><span class="action-text">Edit</span></button>
                                    <button class="btn btn-sm"><i class="ti-trash action-icon"></i><span class="action-text">Delete</span></button> 
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                    <div class="text-center mt-2">
                        <button class="btn btn-sm btn-primary px-3">Tambah BQ</button> 
                    </div>
                </div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0"> 
                    <table class="table table-sm mb-0" id="table-users">
                        <thead>
                            <tr class="py-2">
                                <th data-priority="1" class="py-lg-2 py-3 px-0">Tgl. Pembuatan</th> 
                                <th class=" py-lg-2 py-3">Admin</th>  
                                <th class=" py-lg-2 py-3">Total</th>  
                                <th class=" py-lg-2 py-3">Catatan</th> 
                                <th data-priority="2" class=" py-lg-2 py-3">Action</th>
                            </tr>
                        </thead> 
                        <tbody class="list-wrapper ">
                            <tr>
                                <td>20 Oktober 2024</td>
                                <td>Fauzan</td> 
                                <td>Rp. 10.000.000</td> 
                                <td>-</td> 
                                <td class="action">
                                    <button class="btn btn-sm"><i class="ti-eye action-icon"></i><span class="action-text">View</span></button>
                                    <button class="btn btn-sm"><i class="ti-pencil action-icon"></i><span class="action-text">Edit</span></button>
                                    <button class="btn btn-sm"><i class="ti-trash action-icon"></i><span class="action-text">Delete</span></button> 
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                    <div class="text-center mt-2">
                        <button class="btn btn-sm btn-primary px-3">Tambah Penawaran</button> 
                    </div>
                </div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
            </div>
        </div>   
    </div>  
</div>    
<div style="margin-bottom: 100px;"></div>   


<!-- PROJECT -->
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
                        <div class="col-4">
                            <label for="store-project" class="col-form-label">Toko:</label>
                            <select class="form-select form-select-sm" style="width:100%" id="store-project"></select> 
                        </div>
                        <div class="col-8">
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
<script>
    var table = $('#table-project').DataTable({
        "responsive": {
            "details": {
                "type": 'column'
            }
        },
        "searching": false,
        "lengthChange": false, 
        "pageLength": parseInt(10),
        "language": {
            "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`, 
            "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`, 
            "processing":  '<div class="loading-spinner"></div>',  
        },
        "processing": true,
        "serverSide": true, 
        "ajax": {
            "url": "<?= base_url()?>datatables/get-data-project",
            "type": "POST", 
            "data": function(data){
                data["search"]["value"] = $("#input-search-project").val()
            }
        },
        "columns": [ 
            { data: "html"}, 
        ]
    }); 
    table.on('draw', function () { 
        $('.nav-tabs[name^="nav-tab-project-table"]').each(function(){
            var project_id = $(this).data("id");
            load_tab_project($(this).find("button.nav-link.active").data("tab"),project_id)
            
            $(this).find("button.nav-link").click(function(e){ 
                load_tab_project($(this).data("tab"),project_id)
            }); 

             
        }); 
    }); 
    load_tab_project = function(type,project_id){ 
        $("#tab-content-project-" + project_id).html("")  
        $("#tab-content-project-spinner-" + project_id).show() 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/get-data-project-tab", 
            data:{
                "type":type,
                "project_id":project_id, 
            },
            success: function(data) {      
                $("#tab-content-project-spinner-" + project_id).hide() 
                if(data["status"]===true){ 
                    $("#tab-content-project-" + project_id).html(data["html"])  
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
    }

    $("#input-search-project").keyup(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    $("#btn-search-project").click(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    var modalsession;
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
        dropdownParent: $('#modal-add-project'),
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
    $("#category-project").select2({
        dropdownParent: $('#modal-add-project'),
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
        dropdownParent: $('#modal-add-project'),
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
                "date":$('#date-project').data('daterangepicker').startDate.format("YYYY-MM-DD"),
                "storeid":$("#store-project").val(),
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


</script>
 

<style>
    #table-sph-item th {
        vertical-align: middle;
        text-align: center;
        font-size: 0.75rem;
        font-weight: bold;
    }
    .action-table{
        max-width:0;
        width: fit-content !important;
        vertical-align: middle !important;
    }
    .action-table .btn.btn-sm {
        border-radius: 5px; 
        padding: 0 0.25rem;
    }
    .action-table .btn.btn-sm i { 
        font-size: 0.75rem;
    }
</style>

<div class="modal fade" id="modal-add-item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-item-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-item-label">Tambah Item</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3"> 
                
                <div class="mb-1">
                    <label for="item-name" class="col-form-label">Nama:</label> 
                    
                    <div class="input-group input-group-sm">  
                        <select class="form-control form-control-sm" id="item-name" name="item-name"  style="width:90%"></select> 
                        <button class="btn btn-primary btn-sm" type="button" style="width:10%" onclick="item_produk_add()"> 
                            <i class="ti-plus"></i> 
                        </button>
                    </div>  
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="item-vol" class="col-form-label">Jumlah:</label>
                            <input class="form-control form-control-sm input-form input-vol" style="width:100%" id="comment-vol" value="0.00">
                        </div>
                        <div class="col-6">
                            <label for="item-satuan" class="col-form-label">Satuan:</label>
                            <select class="form-select form-select-sm" style="width:100%" id="item-satuan"></select>
                        </div>
                    </div> 
                </div> 
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="item-harga" class="col-form-label">Harga:</label>
                            <input class="form-control form-control-sm input-form input-price" style="width:100%" id="item-harga" data-price="0" value="0">
                        </div>
                        <div class="col-6">
                            <label for="item-harga" class="col-form-label">Disc:</label>
                            <input class="form-control form-control-sm input-form input-price" style="width:100%" id="item-disc" data-disc="0" value="0">
                        </div>
                    </div> 
                </div>  
                <div class="mb-1">
                    <label for="item-total" class="col-form-label">Total:</label>
                    <input class="form-control form-control-sm input-form input-price" style="width:100%" id="item-total" value="0" disabled>
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-item">Simpan</button>
            </div>
        </div>
    </div>
</div>  

<div class="modal fade" id="modal-add-produk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-produk-label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-produk-label">Tambah Produk</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">  
                <div class="row mb-1 align-items-center">
                    <div class="label-border-right">
                        <span class="label-dialog">Gambar</span>
                    </div>
                </div> 
                <div class="row p-2"> 
                    <input type="file" class="d-none" accept="image/*" id="upload-produk"> 
                    <div class="col-sm-12 d-flex flex-wrap">
                        <div class="d-flex flex-wrap">
                            <div class="d-flex flex-wrap" id="list-produk"></div>
                            <div class="image-default-obi" id="img-produk">
                                <i class="ti-image" style="font-size:1rem"></i>
                                <span>Tambah Foto</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row mb-1 align-items-center">
                    <div class="label-border-right">
                        <span class="label-dialog">Deskripsi</span>
                    </div>
                </div> 
                <div class="row mb-1">
                    <div class="col-lg-6 col-11 my-1">
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="produk-kode" class="col-sm-3 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="produk-kode" name="produk-kode" type="text" class="form-control form-control-sm input-form" value="(auto)" disabled>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="produk-kategori" class="col-sm-3 col-form-label">Kategori<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" id="produk-kategori" name="produk-kategori" placeholder="Pilih Kategori" style="width:100%"></select>  
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="produk-name" class="col-sm-3 col-form-label">Nama<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="produk-name" name="produk-name" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div> 
                    </div> 
                    <div class="col-lg-6 col-11 my-1">
                        <div class="row mb-1 ">
                            <label for="produk-detail" class="col-sm-3 col-form-label">Detail Produk<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <textarea id="produk-detail" name="produk-detail" type="text" class="form-control form-control-sm input-form" rows="4" value="" placeholder="Sepatu Sneakers Pria Tokostore Kanvas Hitam Seri C28B

- Model simple
- Nyaman Digunakan
- Tersedia warna hitam
- Sole PVC (injection shoes) yang nyaman dan awet untuk digunakan sehari - hari

Bahan:
Upper: Semi Leather (kulit tidak pecah-pecah)
Sole: Premium Rubber Sole

Ukuran
39 : 25,5 cm
40 : 26 cm
41 : 26.5 cm
42 : 27 cm
43 : 27.5 - 28 cm

Edisi terbatas dari Tokostore dengan model baru dan trendy untukmu. Didesain untuk bisa dipakai dalam berbagai acara. Sangat nyaman saat dipakai sehingga dapat menunjang penampilan dan kepercayaan dirimu. Beli sekarang sebelum kehabisan!"></textarea>
                            </div>
                        </div> 
                    </div> 
                </div>  
                <div class="row mb-1 align-items-center">
                    <div class="label-border-right">
                        <span class="label-dialog">Harga Beli dan Jual</span>
                    </div>
                </div> 
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-produk">Simpan</button>
            </div>
        </div>
    </div>
</div> 
<!-- SCRIPT ITEM -->
<script>  
    var modalsessionitem = null;
    var modalsessionhistory = null; 
    var table_item = null; 
    $("#modal-add-item").on("hidden.bs.modal",function(){
        if(modalsessionitem) $(modalsessionitem).modal("show");
    })   
    $("#modal-add-produk").on("hidden.bs.modal",function(){
        $("#modal-add-item").modal("show");
        modalsessionitem = modalsessionhistory;
    })   
    $("#btn-add-item").click(function(){
        console.log(table_item.row().data())
    });
    function select2OptionFormat(option) {
    var originalOption = option.element;
        if ($(originalOption).data('html')) {
            return $(originalOption).data('html');
        }          
        return option.text;
    }
   
    $("#item-name").select2({
        dropdownParent: $('#modal-add-item'), 
        placeholder: "Pilih Nama Item",
        ajax: {
            url: "<?= base_url()?>select2/get-data-item",
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
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"item_produk_add()\">Tambah <b>" + $("#item-name").data('select2').dropdown.$search[0].value + "</b></button>");
            }
        },
        formatResult: select2OptionFormat,
        formatSelection: select2OptionFormat,
        escapeMarkup: function(m) { return m; }
    });
    $("#item-satuan").select2({
        dropdownParent: $('#modal-add-item'), 
        placeholder: "Pilih Satuan",
        ajax: {
            url: "<?= base_url()?>select2/get-data-item-unit",
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
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"item_satuan()\">Tambah <b>" + $("#item-satuan").data('select2').dropdown.$search[0].value + "</b></button>");
            }
        },
        formatResult: select2OptionFormat,
        formatSelection: select2OptionFormat,
        escapeMarkup: function(m) { return m; }
    });
    item_satuan = function(){
        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url("action/add-data-item-unit") ?>",
            data: {
                "name": $("#item-satuan").data('select2').dropdown.$search[0].value 
            }, 
            success: function(data) { 
                var newOption = new Option($("#item-satuan").data('select2').dropdown.$search[0].value , data["data"]["id"], true, true);
                $('#item-satuan').append(newOption).trigger('change'); 
                $('#item-satuan').select2("close");

            }
        });
    }
    $(".input-vol").toArray().forEach(function(el){
        new Cleave(el,{
            numeral: true,
            numeralDecimalScale: 2
        });
    })
    $(".input-price").toArray().forEach(function(el){
        new Cleave(el,{
            numeral: true,
            numeralThousandsGroupStyle: 'thousand' 
        });
    })
    
    item_produk_add = function(){ 
        modalsessionhistory = modalsessionitem;
        modalsessionitem = null;
        $("#modal-add-item").modal("hide");
        $("#modal-add-produk").modal("show");
        
    }
    $("#produk-kategori").select2({
        dropdownParent: $('#modal-add-produk'), 
        placeholder: "Pilih kategori produk",
        ajax: {
            url: "<?= base_url()?>select2/get-data-produk-kategori",
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
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"item_produk_category_add()\">Tambah <b>" + $("#produk-kategori").data('select2').dropdown.$search[0].value + "</b></button>");
            }
        },
        formatResult: select2OptionFormat,
        formatSelection: select2OptionFormat,
        escapeMarkup: function(m) { return m; }
    });
    item_produk_category_add = function(){
        var values = $("#produk-kategori").data('select2').dropdown.$search[0].value;
        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url("action/add-data-produk-category") ?>",
            data: {
                "name": values
            }, 
            success: function(data) {  
                $('#produk-kategori').append(new Option(values , data["data"]["id"], true, true)).trigger('change'); 
                $('#produk-kategori').select2("close"); 
            }
        });
    }
</script>


<!-- PENAWARAN -->
<div class="modal fade" id="modal-add-sph" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-sph-label" aria-hidden="true" style="overflow-y:auto;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-sph-label">Tambah Penawaran</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="row"> 
                    <div class="col-lg-6 col-11 my-1">
                        <div class="row mb-1 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Pelanggan</span>
                            </div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <label class="col-sm-10 fw-bold">CS000001 - Bpk Andrian (PT. APA AJA)</label> 
                        </div> 
                        <div class="row align-items-center">
                            <label class="col-sm-2 col-form-label">Telp</label>
                            <label class="col-sm-10 fw-bold">0813 1015 4883 / 0810 1234 5678</label> 
                        </div> 
                        <div class="row align-items-center">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <label class="col-sm-10 fw-bold">Andrian@gmail.com</label> 
                        </div>  
                        <div class="row align-items-center">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <label class="col-sm-10 fw-bold">Gg. H. Jaim RT 007/03 No. 43 Kel Sudimara Pinang Kec Pinang Kota Tangerang Banten 15145</label> 
                        </div> 
                    </div> 

                    <div class="col-lg-6 col-11 my-1">  
                        <div class="row mb-1 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Document</span>
                            </div>
                        </div>
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="SphCode" name="SphCode" type="text" class="form-control form-control-sm input-form" value="(auto)" disabled>
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
                                <select class="form-select form-select-sm" id="SphStore" name="SphStore" placeholder="Pilih Toko" style="width:100%"></select>  
                            </div>
                        </div>  
                    </div>  
                    <div class="col-lg-12 col-11 my-1">   
                        <div class="row mb-1 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Item Detail</span>
                            </div>
                        </div> 
                        <table class="table table-sm mb-0" id="table-sph-item">
                            <thead class="table-light">
                                <tr >
                                    <th rowspan="2" class="">Action</th>
                                    <th rowspan="2" class="">Deskripsi</th> 
                                    <th colspan="2" class="">Qty</th>  
                                    <th rowspan="2" class="">Harga</th> 
                                    <th rowspan="2" class="">Total</th>
                                </tr>
                                <tr class=""> 
                                    <th class="">Vol</th> 
                                    <th class="">Sat</th> 
                                </tr>
                            </thead> 
                            <tbody class="list-wrapper "> 
                                <tr>
                                    <td class="action-table"> 
                                        <button class="btn btn-sm btn-warning"><i class="ti-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="ti-trash"></i></button>
                                    </td>
                                    <td>Bongkar pasang pintu</td>
                                    <td>2</td>
                                    <td>Unit</td>
                                    <td>Rp. 200.000</td>
                                    <td>Rp. 400.000</td>
                                </tr>
                            </tbody>
                        </table>    
                        <div class="text-center mt-2"> 
                            <button class="btn btn-sm btn-primary px-3" id="table-sph-item-add">Tambah Item</button>  
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
    add_sph = function(id){
        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url("action/get-data-project/") ?>" + id ,
            success: function(data) { 
                $("#modal-add-sph").modal("show");
                var newOption = new Option(data["StoreCode"] + " - " + data["StoreName"], data["StoreId"], true, true);
                $('#SphStore').append(newOption).trigger('change'); 
                $('#SphStore').select2("close");
            }
        });
    }

    $('#SphDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment(),
        "endDate":  moment(),
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    
    $("#SphStore").select2({
        dropdownParent: $('#modal-add-sph'),
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

    var tableitem = $('#table-sph-item').DataTable({
        "paging":false, 
        "searching": false,
        "lengthChange": false, 
        "ordering": false, 
        "info":false,
        "language": {
            "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`, 
            "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`, 
            "processing":  '<div class="loading-spinner"></div>',  
        },
    });
    $('#table-sph-item-add').click(function(){
        modalsessionitem = $("#modal-add-sph");
        table_item = tableitem;
        $(modalsessionitem).modal("hide");
        $("#modal-add-item").modal("show");
    });

</script>
<?php $this->endSection(); ?>