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

<div class="card radius-15 overflow-hidden mb-3 border-0 shadow-sm">
    <div class="card-header border-bottom-0 px-4 pt-4 bg-white mb-lg-0 mb-2">
        <div class="d-flex align-items-center row">
            <div class="mb-0 col-lg-2 col-8 pb-lg-2 pb-4 order-lg-1">
                <h4 class="mb-0">LIST PROJECT</h4> 
            </div> 
            <div class="justify-content-end d-flex col-lg-2 col-4 pb-lg-2 pb-4  order-lg-3">
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-block ps-2">Tambah Project<span></button>
            </div>
            <div class="d-lg-flex search-bar col-lg-8 col-12 order-lg-2 pb-lg-2 pb-0">
                <div class="form-inline  navbar-search w-100">
                    <div class="input-group input-group-sm w-100 ">
                        <input type="text" class="form-control rounded-left small bg-light " placeholder="Cari Data ..." aria-label="Search" aria-describedby="basic-addon2" name="search_user"  id="input-search-data">
                        <div class="input-group-append">
                            <button class="btn bg-light btn-light border-right border-top border-bottom rounded-right px-3" id="btn-search-data">
                                <i class="icon-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="card-body py-2 py-md-4" id="element-to-print"> 
        <table class="table table-borderless mb-0 table-hover-custom" id="table-project">
            <thead class=" ">
                <tr class="">
                    <th data-priority="1" class="py-lg-4 py-3 px-lg-2 px-0">Store</th>
                    <th class="py-lg-4 py-3 px-lg-2 px-0 text-center">Create Date</th>  
                    <th class="py-lg-4 py-3 px-lg-2 px-0">Customer</th>     
                    <th class="py-lg-4 py-3 px-lg-2 px-0">Admin</th>  
                    <th class="py-lg-4 py-3 px-lg-2 px-0">Last Activity</th>   
                    <th data-priority="2" class="py-lg-4 py-3 px-lg-2 px-0 text-end"><i class="ti-settings"></i></th>
                </tr>
            </thead> 
            <tbody class="">
                <!-- <tr class="dt-hasChild">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src='<?= base_url("assets/images/logo/logo.png") ?>' alt='Gambar' class='image-logo-project'>
                            </div>
                            <div class="flex-grow-1 ms-1 ">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-head-2">Mahiera Global Solution</span>
                                    <span class="text-detail-2 text-truncate"> 
                                        <div class="d-flex gap-1">
                                            <span class="badge badge-0">ELEKTRIKAL</span>
                                            <span class="badge badge-1">JASA PASANG</span>
                                            <span class="badge badge-2">SIPIL</span> 
                                        </div>
                                    </span> 
                                </div>
                            </div>
                        </div> 
                    </td> 
                    <td>
                        <div class="d-flex flex-column gap-1 align-items-center">
                            <span class="text-head-2">28 Nov 2024</span>
                            <span class="text-detail-2 text-truncate">20:08:10</span> 
                        </div> 
                    </td>
                    <td> 
                        <div class="d-flex flex-column gap-1 ">
                            <span class="text-head-2">BPK. ANDRIAN</span>
                            <span class="text-detail-2 text-truncate">Jl. Tlk. Peleng 116-114, RT.6/RW.8, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520</span> 
                        </div> 
                    </td> 
                    <td>Syahrul Fauzan</td>
                    <td>
                        <span class="badge badge-0 badge-rounded">NEW</span>
                    </td> 
                    <td>-</td>
                    <td class="action-td"> 
                        <div class="d-md-inline-block d-none"> 
                            <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click(1)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                            <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click(1)"><i class="fa-solid fa-close  pe-2"></i>Delete</button> 
                        </div>
                        <div class="d-md-none d-flex btn-action"> 
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow">
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_click(1)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_click(1)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                </ul>
                            </div> 
                        </div> 
                    </td>
                </tr>
                <tr class="child p-0">
                    <td colspan="7" class="child p-0">
                        <div class="project-detail d-block w-100">
                             
                        </div>  
                    </td>  
                </tr>
                <tr class="">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src='<?= base_url("assets/images/logo/logo.png") ?>' alt='Gambar' class='image-logo-project'>
                            </div>
                            <div class="flex-grow-1 ms-1 ">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-head-2">Mahiera Global Solution</span>
                                    <span class="text-detail-2 text-truncate"> 
                                        <div class="d-flex gap-1">
                                            <span class="badge badge-0">BATA</span>
                                            <span class="badge badge-1">ROSTER</span>
                                        </div>
                                    </span> 
                                </div>
                            </div>
                        </div> 
                    </td> 
                    <td>
                        <div class="d-flex flex-column gap-1 align-items-center">
                            <span class="text-head-2">28 Nov 2024</span>
                            <span class="text-detail-2 text-truncate">20:08:10</span> 
                        </div> 
                    </td>
                    <td> 
                        <div class="d-flex flex-column gap-1 ">
                            <span class="text-head-2">BPK. ANDRIAN</span>
                            <span class="text-detail-2 text-truncate">Jl. Tlk. Peleng 116-114, RT.6/RW.8, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520</span> 
                        </div> 
                    </td> 
                    <td>Syahrul Fauzan</td>
                    <td>
                        <span class="badge badge-0 badge-rounded">NEW</span>
                    </td> 
                    <td>-</td>
                    <td class="action-td"> 
                        <div class="d-md-inline-block d-none"> 
                            <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click(1)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                            <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click(1)"><i class="fa-solid fa-close  pe-2"></i>Delete</button> 
                        </div>
                        <div class="d-md-none d-flex btn-action"> 
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow">
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_click(1)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_click(1)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                </ul>
                            </div> 
                        </div> 
                    </td>
                </tr>
                <tr class="">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src='<?= base_url("assets/images/logo/logo.png") ?>' alt='Gambar' class='image-logo-project'>
                            </div>
                            <div class="flex-grow-1 ms-1 ">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-head-2">Mahiera Global Solution</span>
                                    <span class="text-detail-2 text-truncate"> 
                                        <div class="d-flex gap-1">
                                            <span class="badge badge-0">BATA</span>
                                            <span class="badge badge-1">ROSTER</span>
                                            <span class="badge badge-2">ELEKTRIKAL</span>
                                            <span class="badge badge-3">JASA PASANG</span>
                                            <span class="badge badge-4">SIPIL</span>
                                        </div>
                                    </span> 
                                </div>
                            </div>
                        </div> 
                    </td> 
                    <td>
                        <div class="d-flex flex-column gap-1 align-items-center">
                            <span class="text-head-2">28 Nov 2024</span>
                            <span class="text-detail-2 text-truncate">20:08:10</span> 
                        </div> 
                    </td>
                    <td> 
                        <div class="d-flex flex-column gap-1 ">
                            <span class="text-head-2">BPK. ANDRIAN</span>
                            <span class="text-detail-2 text-truncate">Jl. Tlk. Peleng 116-114, RT.6/RW.8, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520</span> 
                        </div> 
                    </td> 
                    <td>Syahrul Fauzan</td>
                    <td>
                        <span class="badge badge-0 badge-rounded">NEW</span>
                    </td> 
                    <td>-</td>
                    <td class="action-td"> 
                        <div class="d-md-inline-block d-none"> 
                            <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click(1)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                            <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click(1)"><i class="fa-solid fa-close  pe-2"></i>Delete</button> 
                        </div>
                        <div class="d-md-none d-flex btn-action"> 
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow">
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_click(1)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_click(1)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                </ul>
                            </div> 
                        </div> 
                    </td>
                </tr> -->
            </tbody>
        </table> 
    </div>  
</div>    
<div style="margin-bottom: 100px;"></div> 
<div id="modal-message"></div>
<script>
    var table;
    if (window.innerWidth <= 400) {
        table = $('#table-project').DataTable({
            "responsive": false,
            "searching": false,
            "lengthChange": false, 
            "pageLength": parseInt(10),
            "language": {
                "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                "loadingRecords":  `<div class="loading-spinner"></div>`,
                "processing":  `<div class="loading-spinner"></div>`,
            },
            "processing": true,
            "serverSide": true, 
            "ajax": {
                "url": "<?= base_url()?>datatables/get-data-project",
                "type": "POST", 
                "data": function(data){
                    data["search"]["value"] = $("#input-search-data").val()
                }
            }, 
            "columns": [
                { data: "head_mobile",orderable: false ,  "title": ""},  
                { data: "date_time",orderable: false  , className:"text-center",'visible' : false }, 
                { data: "customer" ,orderable: false,'visible' : false  },  
                { data: "admin" ,orderable: false ,'visible' : false }, 
                { data: "status" ,orderable: false,'visible' : false },  
                { data: "action" ,orderable: false , className:"action-td",'visible' : false }, 
            ],
            "rowCallback": function(row, data) {
                $(row).attr('data-id', data.id);
            } 
        }); 

        $('#table-project').find("thead").hide();
        $('#table-project').on( 'draw.dt', function (e) { 
            $(".project-menu").each(function(idx){  
                var id = $("#table-project").DataTable().data()[idx]["project_id"];
                $(".menu-item[data-id='" + id +"']").click(function(){
                    if($(this).hasClass("selected")){
                        $(this).removeClass("selected");
                        $(".tab-content[data-id='"+ id+"']").hide() 
                    }else{ 
                        $(this).parent().find(".selected").removeClass("selected")
                        $(this).addClass("selected") 

                        loader_data_project(id,$(this).data("menu"))
                    }
                }); 
            }); 
        });

        


    }else{
        table = $('#table-project').DataTable({
            "responsive": {
                "details": {
                    "type": 'column'
                }
            },
            "searching": false,
            "lengthChange": false, 
            "pageLength": parseInt(10),
            "language": {
                "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
                "loadingRecords":  `<div class="loading-spinner"></div>`,
                "processing":  `<div class="loading-spinner"></div>`,
            },
            "processing": true,
            "serverSide": true, 
            "ajax": {
                "url": "<?= base_url()?>datatables/get-data-project",
                "type": "POST", 
                "data": function(data){
                    data["search"]["value"] = $("#input-search-data").val()
                }
            }, 
            "columns": [
                { data: "store",orderable: false },  
                { data: "date_time",orderable: false  , className:"text-center"}, 
                { data: "customer" ,orderable: false },  
                { data: "admin" ,orderable: false}, 
                { data: "status" ,orderable: false},  
                { data: "action" ,orderable: false , className:"action-td"}, 
            ],
            "rowCallback": function(row, data) {
                $(row).attr('data-id', data.id);
            } 
        }); 

        
        // Tampilkan detail ketika baris diklik
        $('#table-project tbody button').on('click', function(event) {
            event.stopPropagation();
        }); 
        table.on('click', 'tr', function(event) {
            var target = $(event.target);   
            if (
                target.closest('button').length ||  
                target.parents().hasClass("project-detail") ||  
                target.parent().hasClass("project-detail") ||  
                target.hasClass("project-detail") ||    
                target.closest('th').length
            ) {
                return;
            }

            if (table.row(this).child.isShown()) { 
                $('div.project-detail', table.row(this).child()).slideUp( function () {
                    table.row(this).child.hide(); 
                } );
            } else {
                var data = table.row(this).data(); 
             
                table.row(this).child(data.html,'child p-0').show(); 
                $('div.project-detail', table.row(this).child()).slideDown();  

                loader_data_project(data.project_id,'survey');

                $( ".btn-side-menu[data-id='" + data.project_id+ "']" ).click(function(){
                    var parent = $(this).parent().parent().find(".side-menu[data-id='" +$(this).data("id")+ "']");
                    if($(parent).hasClass("hide")){
                        $(parent).removeClass("hide");
                        $(this).find("i").removeClass("fa-rotate-180");
                    }else{ 
                        $(parent).addClass("hide");
                        $(this).find("i").addClass("fa-rotate-180");
                    } 
                }); 
                $( ".menu-item[data-id='" + data.project_id+ "']" ).click(function(){
                    $(this).parent().find(".selected").removeClass("selected")
                    $(this).addClass("selected") 

                    loader_data_project(data.project_id,$(this).data("menu")) 
                });   
                
            } 
        }); 
    }

    $("#input-search-data").keyup(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    $("#btn-search-data").click(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })


    loader_data_project = function(project_id,type){ 
        
        $(".tab-content[data-id='"+ project_id+"']").hide() 
        $(".loading-content[data-id='"+ project_id+"']").show() 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/get-data-project-tab", 
            data:{
                "type":type,
                "project_id":project_id, 
            },
            success: function(data) {       
                if(data["status"]===true){ 
                    $(".tab-content[data-id='"+ project_id+"']").html(data["html"])  
                    $("#tab-content-project-" + project_id).html(data["html"])  
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data, 
                        confirmButtonColor: "#3085d6", 
                    });
                }
                $(".tab-content[data-id='"+ project_id+"']").show() 
                $(".loading-content[data-id='"+ project_id+"']").hide()
               
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
    add_project_invoice = function(id,el){
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
                    url: "<?= base_url() ?>action/delete-data-project-invoice/" + id, 
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


</script>


<?php $this->endSection(); ?>