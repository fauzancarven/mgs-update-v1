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
                <h4 class="mb-0">LIST STORE</h4> 
            </div> 
            <div class="justify-content-end d-flex col-lg-2 col-6 pb-lg-2 pb-4  order-lg-3">
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click()"><i class="ti-plus pe-2"></i>Tambah <span class="d-none d-md-inline-block">Store<span></button>
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
            <thead>
                <tr class="">
                    <th data-priority="1" class="py-lg-4 py-3">Kode</th> 
                    <th data-priority="3" class="py-lg-4 py-3">Nama</th>  
                    <th data-priority="2" class="py-lg-4 py-3 text-end"><i class="ti-settings"></i></th>
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
            "url": "<?= base_url()?>datatables/get-data-store",
            "type": "POST", 
            "data": function(data){
                data["search"]["value"] = $("#input-search-data").val()
            }
        }, 
        "columns": [
            { data: "StoreCode"},
            { data: "StoreName" }, 
            { data: "action" ,orderable: false , className:"action-td"}, 
        ], 
    }); 
    $("#input-search-data").keyup(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    $("#btn-search-data").click(function(){
        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    })
    add_click = function(){ 
        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/add-store", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-store").modal("show"); 
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
        });
    } 
    edit_click = function(id){
        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/edit-store/"+ id, 
            success: function(html) {  
                $("#modal-message").html(html);

                var data = table.rows().data();
                var datas;
                data.each(function (value, index) { 
                    if(id==value["StoreId"]) datas= value
                });
                console.log(datas)
                $("#EditStoreCode").val(datas["StoreCode"]);
                $("#EditStoreName").val(datas["StoreName"]);
                $("#EditStoreId").val(datas["StoreId"]);

                $("#modal-edit-store").modal("show");  
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
        });
 
    }
    delete_click = function(id){
        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus toko ini...???",
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
                    url: "<?= base_url() ?>action/delete-data-store",
                    data: {
                        "StoreId": id,  
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
        });
    }


</script>
<?php $this->endSection(); ?>