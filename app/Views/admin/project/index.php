<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>
 

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

<div class="d-flex align-items-center mb-4"> 
    <div class="p-1 flex-fill" > 
        <h4 class="mb-0">LIST PROJECT</h4> 
    </div>   
    <div class="justify-content-end d-flex col-lg-2 col-4 pb-lg-2 pb-4  order-lg-3">
        <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-block ps-2">Tambah Project<span></button>
    </div>
</div>

<!-- BAGIAN FILTER -->
<div class="d-flex align-items-center justify-content-end mb-2 g-2 row search-data"> 
    <div class="input-group flex-fill">  
        <input class="form-control form-control-sm input-form" id="searchdataproject" placeholder="Search" value="" type="text">
        <i class="fa-solid fa-magnifying-glass"></i> 
    </div>  
    <div class="input-group ">  
        <input class="form-control form-control-sm input-form" id="searchdatafilter" placeholder="Filter Category" value="" type="text">
        <i class="fa-solid fa-filter"></i>
    </div>
    <div class="input-group ">  
        <input class="form-control form-control-sm input-form" id="searchdatadate" placeholder="Tanggal" value="" type="text">
        <i class="fa-solid fa-calendar-days"></i> 
    </div>
</div>

<div id="data-project">
    <!-- <div class="card project"> 
        <div class="card-body p-0"> 
            <div class="d-flex header p-2 gap-1 justify-content-end">
                <div class="project-store">  
                    <img class="logo" src="data:image/png;base64,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" alt="Gambar" class="image-logo-project">
                    <span class="text-head-2">MGS ME</span>
                </div>
                <div class="divider-horizontals"></div>
                <div class="d-block">
                    <span class="badge badge-0">CCTV</span>
                    <span class="badge badge-1">JASA PASANG</span>
                </div>
                <div class="divider-horizontals"></div>
                <div class="project-name">  
                    <span class="text-head-2">PROJECT ACS BALI</span>
                </div>
                <div class="divider-horizontals"></div> 
                <div class="project-customer">  
                    <i class="fa-solid fa-users-rectangle"></i>
                    <span class="text-head-3">Mahesa</span>  
                </div>
                <div class="divider-horizontals"></div> 
                <div class="project-date">  
                    <i class="fa-regular fa-calendar"></i>
                    <span class="text-detail-2">04 Jan 2025, 18:05:39</span>  
                </div>
                <div class="divider-horizontals"></div> 
                <div class="project-admin flex-fill">  
                    <i class="fa-regular fa-user"></i>
                    <span class="text-detail-2">MGS00004 - syahrul fauzan</span>  
                </div>
                <div class="project-action action-td">  
                    <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click(11,this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</button>
                    <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click(11,this)"><i class="fa-solid fa-close pe-2"></i>Delete</button>
                </div>
            </div>  
            <div class="d-flex border-top">
                <div class="side-menu" data-id="11">
                    <div class="d-flex flex-column project-menu">
                        <div class="menu-item selected" data-id="11" data-menu="survey">
                            <i class="fa-solid fa-list-check position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">Survey</span>
                        </div>
                        <div class="menu-item" data-id="11" data-menu="rab">
                            <i class="fa-solid fa-list position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">RAB</span>
                        </div>
                        <div class="divider-vertical m-1"></div>
                        <div class="menu-item" data-id="11" data-menu="penawaran">
                            <i class="fa-solid fa-hand-holding-droplet position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">Penawaran</span>
                        </div>
                        <div class="divider-vertical m-1"></div>
                        <div class="menu-item" data-id="11" data-menu="pembelian">
                            <i class="fa-solid fa-cart-shopping position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">Pembelian</span>
                        </div>
                        <div class="menu-item" data-id="11" data-menu="penerimaan">
                            <i class="fa-solid fa-cart-shopping position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">Penerimaan</span>
                        </div>
                        <div class="divider-vertical m-1"></div>
                        <div class="menu-item" data-id="11" data-menu="invoice">
                            <i class="fa-solid fa-money-bill position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">Invoice</span>
                        </div>
                        <div class="divider-vertical m-1"></div>
                        <div class="menu-item" data-id="11" data-menu="pengiriman">
                            <i class="fa-solid fa-truck position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">Pengiriman</span>
                        </div>  
                        <div class="divider-vertical m-1"></div>
                        <div class="menu-item" data-id="11" data-menu="keuangan">
                            <i class="fa-solid fa-dollar position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">Keuangan</span>
                        </div>
                        <div class="divider-vertical m-1"></div>
                        <div class="menu-item" data-id="11" data-menu="documentasi">
                            <i class="fa-solid fa-folder-open position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">File Manager</span>
                        </div>
                        <div class="menu-item" data-id="11" data-menu="diskusi">
                            <i class="fa-regular fa-comments position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i>
                            <span class="menu-text">Diskusi</span>
                        </div>
                    </div> 
                    <button class="btn-side-menu" data-id="11"><i class="fa-solid fa-angle-left" style="padding: 0;margin: 0;position: absolute;top: 7px;left: 10px;"></i></button>
                </div>
                <div class="flex-fill">
                    <div class="tab-content" data-id="11" style="display:none">
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                            <span>Belum ada data yang dibuat</span>
                            <button class="btn btn-sm btn-primary px-3 rounded mt-4" onclick="add_penawaran_click(11,this)"><i class="fa-solid fa-plus pe-2"></i>Buat Penawaran</button>
                        </div> 
                    </div>
                    <div class="d-flex justify-content-center flex-column align-items-center" style="display:none;background:#F5F7FF;height:100%">
                        <div class="loading text-center loading-content pt-4 mt-4" data-id="11">
                            <div class="loading-spinner"></div>
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <span>Sedang memuat data</span> 
                            </div>
                        </div> 
                    </div>
                        
                </div>
            </div> 
        </div>
    </div>  -->
</div>
<div class="row justify-content-between d-none">
    <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto">
        <div class="dt-info pt-1" aria-live="polite" id="table-toko_info" role="status">Showing 1 to 10 of 10 entries</div>
    </div>
    <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ml-auto">
        <div class="dt-paging pt-1">
            <nav aria-label="pagination">
                <ul class="pagination">
                    <li class="dt-paging-button page-item disabled">
                        <a class="page-link first" aria-controls="table-toko" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a></li>
                        <li class="dt-paging-button page-item disabled"><a class="page-link previous" aria-controls="table-toko" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a></li>
                        <li class="dt-paging-button page-item active"><a href="#" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">1</a></li>
                        <li class="dt-paging-button page-item disabled"><a class="page-link next" aria-controls="table-toko" aria-disabled="true" aria-label="Next" data-dt-idx="next" tabindex="-1">›</a></li>
                        <li class="dt-paging-button page-item disabled"><a class="page-link last" aria-controls="table-toko" aria-disabled="true" aria-label="Last" data-dt-idx="last" tabindex="-1">»</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> 
</div>    
<div style="margin-bottom: 100px;"></div> 
<div id="modal-message"></div>
<script>
    var table; 
  
    $("#input-search-data").keyup(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    $("#btn-search-data").click(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })

    loader_datatable = function(){
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url()?>datatables/get-data-project", 
            data:{  
            },
            success: function(data) {       
                if(data["status"]===true){ 
                    $("#data-project").html(data["html"])   
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data, 
                        confirmButtonColor: "#3085d6", 
                    });
                } 
                $(".menu-item").click(function(){
                    $(this).data("id"); 
                    $(this).parent().find(".selected").removeClass("selected")
                    $(this).addClass("selected") 

                    loader_data_project($(this).data("id"),$(this).data("menu")) 
                }); 
                $(".btn-side-menu").click(function(){
                    var parent = $(this).parent().parent().find(".side-menu[data-id='" +$(this).data("id")+ "']");
                    if($(parent).hasClass("hide")){
                        $(parent).removeClass("hide");
                        $(this).find("i").removeClass("fa-rotate-180");
                    }else{ 
                        $(parent).addClass("hide");
                        $(this).find("i").addClass("fa-rotate-180");
                    } 
                }); 
               
                $(".header").click(function(e){

                    var target = $(e.target);   
                    if (  target.closest('button').length  ) return;

                    if($(this).parent().parent().hasClass("show")){ 
                        $(this).parent().parent().removeClass("show");

                    }else{
                        $(this).parent().parent().addClass("show");

                    }

                }); 

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
    loader_datatable();
    loader_data_project = function(ProjectId,type){  
        $(".tab-content[data-id='"+ ProjectId+"']").hide() 
        $(".loading-content[data-id='"+ ProjectId+"']").show()
        $(".loading-content[data-id='"+ ProjectId+"']").parent().removeClass("d-none");
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/get-data-project-tab", 
            data:{
                "type":type,
                "ProjectId":ProjectId, 
            },
            success: function(data) {       
                if(data["status"]===true){ 
                    $(".tab-content[data-id='"+ ProjectId+"']").html(data["html"])  
                    $("#tab-content-project-" + ProjectId).html(data["html"])  
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data, 
                        confirmButtonColor: "#3085d6", 
                    });
                }
                $(".tab-content[data-id='"+ ProjectId+"']").show() 
                $(".loading-content[data-id='"+ ProjectId+"']").hide() 
                $(".loading-content[data-id='"+ ProjectId+"']").parent().addClass("d-none");
               
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

    loader_data_project(11,'survey');
    add_click = function(){ 
        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/add-project", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-project").modal("show"); 
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
        });
    }; 
    edit_click = function(id,el){ 
        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/edit-project/" +id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-project").modal("show"); 
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
        });
    }; 
    var isProcessingDelete;
    delete_click = function(id,el){
        // INSERT LOADER BUTTON
        if (isProcessingDelete) {
            return;
        }  
        isProcessingDelete = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus project ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-project/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
                    }, 
                });
            }
            isProcessingDelete = false;
            $(el).html(old_text);
        });
    }  
    /* 
        PROJECT SPH / PENAWARAN
    */
    var isProcessingSph = [];
    add_project_sph = function(id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingSph[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSph[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-sph/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-sph").modal("show"); 

                isProcessingSph[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSph[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };

    var isProcessingSphPrint = [];
    print_project_sph = function(ref,id,el){ 
        window.open('<?= base_url("print/project/sph/") ?>' + id, '_blank');
    };

    var isProcessingSphEdit = [];
    edit_project_sph = function(ref,id,el){ 
          // INSERT LOADER BUTTON
          if (isProcessingSphEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSphEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-sph/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-sph").modal("show"); 

                isProcessingSphEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSphEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 
    
    var isProcessingSphDelete = [];
    delete_project_sph = function(ref,id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingSphDelete[id]) {
            return;
        }  
        isProcessingSphDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus penawaran ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-penawaran/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"penawaran"); 
                    }, 
                });
            }
            isProcessingSphDelete[id] = false;
            $(el).html(old_text); 
        });
    };

    
    /* 
        PROJECT PEMBELIAN
    */
    var  isProcessingPo = [];
    add_project_po = function(id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingPo[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPo[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-po/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-po").modal("show"); 

                isProcessingPo[id] = false;
                $(el).html(old_text);
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPo[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };

    var isProcessingPOEdit = [];
    edit_project_po = function(ref,id,el){ 
          // INSERT LOADER BUTTON
          if (isProcessingPOEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPOEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-po/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-po").modal("show"); 

                isProcessingPOEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPOEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 
    delete_project_po = function(ref,id,el){
        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus Pembelian ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-po/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"pembelian"); 
                    }, 
                });
            } 
        });
    }

    print_project_po_a4 = function(ref,id,el){ 
        window.open('<?= base_url("print/project/poA4/") ?>' + id, '_blank');
    };
    print_project_po_a5 = function(ref,id,el){ 
        window.open('<?= base_url("print/project/poA5/") ?>' + id, '_blank');
    };
    /* 
        PROJECT INVOICE
    */
    var isProcessingInvoice= [];
    add_project_invoice = function(id,el,sphid = 0){
        // INSERT LOADER BUTTON
        if (isProcessingPo[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPo[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-invoice/" + id, 
            data: {
                "SphId" : sphid
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-invoice").modal("show"); 

                isProcessingPo[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPo[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    var isProcessingDelivery = [];
    delivery_project_invoice  = function(ref,id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingDelivery[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDelivery[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/delivery-project-invoice/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-delivery").modal("show"); 

                isProcessingDelivery[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDelivery[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    var isProcessingInvoiceEdit = [];
    edit_project_invoice = function(ref,id,el){ 
          // INSERT LOADER BUTTON
          if (isProcessingInvoiceEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoiceEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-invoice/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-invoice").modal("show"); 

                isProcessingInvoiceEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoiceEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 

    var isProcessingDeliveryProses = [];
    delivery_project_proses = function(ref,id,el){ 
          // INSERT LOADER BUTTON
        if (isProcessingDeliveryProses[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDeliveryProses[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-proses-delivery/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-proses-delivery").modal("show"); 

                isProcessingDeliveryProses[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryProses[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }; 

    var isProcessingInvoiceDelete = [];
    delete_project_invoice = function(ref,id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingInvoiceDelete[id]) {
            return;
        }  
        isProcessingInvoiceDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus Invoice ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-invoice/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"invoice"); 
                    }, 
                });
            }
            isProcessingInvoiceDelete[id] = false;
            $(el).html(old_text); 
        });
    }; 
    print_project_invoice_a4 = function(ref,id,el){ 
        window.open('<?= base_url("print/project/invoiceA4/") ?>' + id, '_blank');
    }; 
    print_project_invoice_a5 = function(ref,id,el){ 
        window.open('<?= base_url("print/project/invoiceA5/") ?>' + id, '_blank');
    };
 
    var isProcessingInvoicePayment = [];
    payment_project_invoice = function(ref,id,el){
        // INSERT LOADER BUTTON
        if (isProcessingInvoicePayment[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoicePayment[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-payment/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-payment").modal("show"); 

                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    
    var isProcessingPaymentEdit = [];
    edit_project_payment  = function(ref,id,el){ 
         // INSERT LOADER BUTTON
         if (isProcessingPaymentEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPaymentEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-payment/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-payment").modal("show"); 

                isProcessingPaymentEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPaymentEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };
    

    var isProcessingPaymentDelete = [];
    delete_project_payment  = function(ref,id,el){ 
         // INSERT LOADER BUTTON
        if (isProcessingInvoiceDelete[id]) {
            return;
        }  
        isProcessingInvoiceDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus Payment ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-project-payment/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"invoice"); 
                    }, 
                });
            }
            isProcessingInvoiceDelete[id] = false;
            $(el).html(old_text); 
        });
    };

    print_project_payment = function(ref,id,el){ 
        window.open('<?= base_url("print/project/paymentA5/") ?>' + id, '_blank');
    }
    
    var isProcessingInvoiceProforma = [];
    proforma_project_invoice  = function(ref,id,el){
        // INSERT LOADER BUTTON
        if (isProcessingInvoiceProforma[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoiceProforma[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-proforma/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-proforma").modal("show"); 

                isProcessingInvoiceProforma[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoiceProforma[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    } 

    var isProcessingProformaEdit = [];
    edit_project_proforma  = function(ref,id,el){ 
         // INSERT LOADER BUTTON
         if (isProcessingProformaEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingProformaEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-proforma/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-proforma").modal("show"); 

                isProcessingProformaEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingProformaEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };
    print_project_proforma = function(ref,id,el){ 
        window.open('<?= base_url("print/project/proformaA5/") ?>' + id, '_blank');
    }
    
    send_project_payment  = function(ref,id,el){
        // INSERT LOADER BUTTON
        if (isProcessingInvoicePayment[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoicePayment[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-payment/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-payment").modal("show"); 

                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    show_project_payment = function(ref,id,el){ 
        $.ajax({
            type: "GET",
            url: "<?= base_url("assets/images/payment/") ?>" + ref + "/" + id + ".png",
            success: function() {
                Swal.fire({ 
                    html: "<img src='<?= base_url("assets/images/payment/") ?>" + ref + "/" + id + ".png' style='width:500px;'>", 
                    confirmButtonColor: "#3085d6", 
                }); 
                return;
            },
            error: function() { 
                $.ajax({
                    type: "GET",
                    url: "<?= base_url("assets/images/payment/") ?>" + ref + "/" + id + ".jpg",
                    success: function() {
                        Swal.fire({ 
                            html: "<img src='<?= base_url("assets/images/payment/") ?>" + ref + "/" + id + ".jpg' style='width:500px;'>", 
                            confirmButtonColor: "#3085d6", 
                        }); 
                    },
                    error: function() { 

                    }
                });
            }
        }); 
    }

    print_project_delivery  = function(ref,id,el){ 
        window.open('<?= base_url("print/project/deliveryA5/") ?>' + id, '_blank');
    }
    var isProcessingDeliveryEdit = [];
    edit_project_delivery = function(ref,id,el){
        // INSERT LOADER BUTTON
        if (isProcessingDeliveryEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDeliveryEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-delivery/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-delivery").modal("show"); 

                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    delete_project_delivery = function(ref,id,el){  
        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus pengiriman ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-delivery/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_data_project(ref,"invoice"); 
                    }, 
                });
            }
            isProcessingInvoiceDelete[id] = false;
            $(el).html(old_text); 
        });
    };

    delivery_proses_show = function(id,el){ 
        $.ajax({
            type: "GET",
            url: "<?= base_url("assets/images/delivery/") ?>" + id + "/proses.png",
            success: function() {
                Swal.fire({ 
                    html: "<img src='<?= base_url("assets/images/delivery/") ?>" + id + "/proses.png' style='width:500px;'>", 
                    confirmButtonColor: "#3085d6", 
                }); 
                return;
            },
            error: function() { 
                $.ajax({
                    type: "GET",
                    url: "<?= base_url("assets/images/delivery/") ?>" + id + "/proses.jpg",
                    success: function() {
                        Swal.fire({ 
                            html: "<img src='<?= base_url("assets/images/delivery/") ?>" + id + "/proses.jpg style='width:500px;'>", 
                            confirmButtonColor: "#3085d6", 
                        }); 
                    },
                    error: function() { 

                    }
                });
            }
        }); 
    }

    var isProcessingDeliveryEdit = [];
    delivery_project_finish =  function(ref,id,el){  
         // INSERT LOADER BUTTON
        if (isProcessingDeliveryEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingDeliveryEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/finish-project-delivery/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-finish-delivery").modal("show"); 

                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };
</script>


<?php $this->endSection(); ?>