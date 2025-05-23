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
                <h4 class="mb-0">LIST VENDOR</h4> 
            </div> 
            <div class="justify-content-end d-flex col-lg-2 col-6 pb-lg-2 pb-4  order-lg-3">
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="ti-plus pe-2"></i>Tambah <span class="d-none d-md-inline-block">Vendor<span></button>
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
        <table class="table table-borderless table-hover mb-0" id="table-toko">
            <thead class=" ">
                <tr class="">
                    <th data-priority="1" class="py-lg-4 py-3 px-lg-2 px-0">Kode</th> 
                    <th data-priority="3" class="py-lg-4 py-3 px-lg-2 px-0">Nama</th>  
                    <th class="py-lg-4 py-3 px-lg-2 px-0">Telp 1</th>  
                    <th class="py-lg-4 py-3 px-lg-2 px-0">Telp 2</th>  
                    <th class="py-lg-4 py-3 px-lg-2 px-0">Alamat</th>  
                    <th class="py-lg-4 py-3 px-lg-2 px-0">Category</th>  
                    <th data-priority="2" class="py-lg-4 py-3 px-lg-2 px-0 text-end"><i class="ti-settings"></i></th>
                </tr>
            </thead > 
            <tbody class="">  
            </tbody>
        </table> 
    </div>  
</div>    
<div style="margin-bottom: 100px;"></div> 
<div id="modal-message"></div>
<script>
    
    let isProcessingSave = false;
    let isProcessingAdd = false; 
    let isProcessingEdit = false; 
    let isProcessingReset = false;
    let isProcessingDelete = false; 
    var table = $('#table-toko').DataTable({
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
            "url": "<?= base_url()?>datatables/get-data-vendor",
            "type": "POST", 
            "data": function(data){
                data["search"]["value"] = $("#input-search-data").val()
            }
        }, 
        "columns": [ 
            { data: "VendorCode"},
            { data: "VendorName" }, 
            { data: "VendorTelp1" }, 
            { data: "VendorTelp2" }, 
            { data: "VendorAddress" },
            { data: "category" }, 
            { data: "action" ,orderable: false , className:"action-td"}, 
        ], 
    }); 
    $("#input-search-data").keyup(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    $("#btn-search-data").click(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    add_click = function(el){ 
         // INSERT LOADER BUTTON
         if (isProcessingAdd) {
            return;
        }  
        isProcessingAdd = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');
        // END LOADER BUTTON

        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/add-vendor", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-vendor").modal("show"); 

                $("#modal-add-vendor").on("hidden.bs.modal",function(){
                    table.ajax.reload(null, false).responsive.recalc().columns.adjust();
                })   
                isProcessingAdd = false;
                $(el).html(old_text);
            },
            error: function(xhr, textStatus, errorThrown){
                isProcessingAdd = false;
                $(el).html(old_text);
                
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    } 
    edit_click = function(id,el){
        if (isProcessingEdit) {
            return;
        }  
        isProcessingEdit = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/edit-vendor/" + id, 
            success: function(data) {   
                isProcessingEdit = false;
                $(el).html(old_text);
                $("#modal-message").html(data);
                $("#modal-edit-vendor").modal("show");  

                $("#modal-edit-vendor").on("hidden.bs.modal",function(){
                    table.ajax.reload(null, false).responsive.recalc().columns.adjust();
                })   
            },
            error: function(xhr, textStatus, errorThrown){
                isProcessingEdit = false;
                $(el).html(old_text);  
                
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
 
            }
        });  
    } 
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
            text: "Anda yakin ingin menghapus vendor ini...???",
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
                    url: "<?= base_url() ?>action/delete-data-vendor",
                    data: {
                        "id": id,  
                    }, 
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

            Swal.fire({
                icon: 'error',
                text: xhr["responseJSON"]['message'], 
                confirmButtonColor: "#3085d6", 
            });
        });
    }


</script>
<?php $this->endSection(); ?>