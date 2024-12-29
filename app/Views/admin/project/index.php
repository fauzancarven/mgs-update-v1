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
            <div class="mb-0 col-lg-2 col-6 pb-lg-2 pb-4 order-lg-1">
                <h4 class="mb-0">LIST PROJECT</h4> 
            </div> 
            <div class="justify-content-end d-flex col-lg-2 col-6 pb-lg-2 pb-4  order-lg-3">
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="ti-plus pe-2"></i>Tambah <span class="d-none d-md-inline-block">Project<span></button>
            </div>
            <div class="d-lg-flex search-bar col-lg-8 col-12 order-lg-2 pb-lg-2 pb-4">
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
    <div class="card-body py-4 " id="element-to-print"> 
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
            </thead > 
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
                "url": "<?= base_url()?>datatables/get-data-produk",
                "type": "POST", 
                "data": function(data){
                    data["search"]["value"] = $("#input-search-data").val()
                }
            }, 
            "columns": [
                { data: "produk_name",orderable: false,},  
                { data: "vendor_detail" ,orderable: false,visible: false, },  
                { data: "price_range" ,orderable: false , className:"text-center",visible: false,}, 
                { data: "action" ,orderable: false , className:"action-td"}, 
            ],
            "rowCallback": function(row, data) {
                $(row).attr('data-id', data.id);
            } 
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
    }

    $("#input-search-data").keyup(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    $("#btn-search-data").click(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })

      // Tampilkan detail ketika baris diklik
    $('#table-produk tbody button').on('click', function(event) {
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
            $( ".btn-side-menu[data-id='" + data.project_id+ "']" ).click(function(){; 
                var parent = $(this).parent().parent().find(".side-menu[data-id='" +$(this).data("id")+ "']");
                if($(parent).hasClass("hide")){
                    $(parent).removeClass("hide");
                    $(this).find("i").removeClass("fa-rotate-180");
                }else{ 
                    $(parent).addClass("hide");
                    $(this).find("i").addClass("fa-rotate-180");
                } 
            })
        }
        $(".menu-item").click(function(){
            $(this).parent().find(".selected").removeClass("selected")
            $(this).addClass("selected") 

            loader_data_project($(this).data("id"),$(this).data("menu"))
        });
      
         
    }); 

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

    isProcessingSph = [];
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

    isProcessingSphPrint = [];
    print_project_sph = function(ref,id,el){ 
        window.open('<?= base_url("print/project/sph/") ?>' + id, '_blank');
    };

    
    isProcessingSphEdit = [];
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
    
    isProcessingSphDelete = [];
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
                    url: "<?= base_url() ?>action/delete-data-project-sph/" + id, 
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
</script>


<?php $this->endSection(); ?>