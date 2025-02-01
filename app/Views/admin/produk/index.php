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
                <h4 class="mb-0">LIST PRODUK</h4> 
            </div> 
            <div class="justify-content-end d-flex col-lg-2 col-6 pb-lg-2 pb-4  order-lg-3">
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="ti-plus pe-2"></i>Tambah <span class="d-none d-md-inline-block">Produk<span></button>
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
        <table class="table table-borderless table-hover mb-0" id="table-produk">
            <thead class=" ">
                <tr class="">
                    <th data-priority="1" class="py-lg-4 py-3 px-lg-2 px-0">Nama</th>  
                    <th class="py-lg-4 py-3 px-lg-2 px-0">Varian</th>   
                    <th class="py-lg-4 py-3 px-lg-2 px-0">Harga</th>  
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
    var table ="";
    if (window.innerWidth <= 400) {
        table = $('#table-produk').DataTable({
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
                { data: "ProdukPrice" ,orderable: false , className:"text-center",visible: false,}, 
                { data: "action" ,orderable: false , className:"action-td"}, 
            ],
            "rowCallback": function(row, data) {
                $(row).attr('data-id', data.id);
            } 
        }); 
    }else{
        table = $('#table-produk').DataTable({
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
                "url": "<?= base_url()?>datatables/get-data-produk",
                "type": "POST", 
                "data": function(data){
                    data["search"]["value"] = $("#input-search-data").val()
                }
            }, 
            "columns": [
                { data: "produk_name"},  
                { data: "vendor_detail" ,orderable: false },  
                { data: "ProdukPrice" ,orderable: false , className:"text-center"}, 
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
            target.parents().hasClass("varian-item-table") ||  
            target.parents().hasClass("varian")  ||  
            target.parent().hasClass("varian-item-table") ||  
            target.parent().hasClass("varian") ||  
            target.hasClass("varian") ||  
            target.hasClass("varian-item-table") ||  
            target.closest('th').length
        ) {
            return;
        }

        if (table.row(this).child.isShown()) { 
            $('div.varian-detail', table.row(this).child()).slideUp( function () {
                table.row(this).child.hide(); 
            } );
        } else {
            var data = table.row(this).data(); 
            var detailHtml = `  <div class="varian-detail">
                        <div class="row varian">
                            <div class="col-12 col-md-4 mb-md-0 mb-2 d-none d-md-block"> 
                                <div class="row"> 
                                    <span class="label-head-dialog">Varian</span>   
                                </div>
                            </div>
                            <div class="col-12 col-md-8 mb-md-0 mb-2  d-none d-md-block">
                                <div class="row"> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog">Berat</span>   
                                    </div> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog">Satuan</span>   
                                    </div> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog">Isi /M<sup>2</sup></span>   
                                    </div> 
                                    <div class="col-3"> 
                                        <span class="label-head-dialog">Harga Beli</span>   
                                    </div> 
                                    <div class="col-3"> 
                                        <span class="label-head-dialog">Harga Jual</span>   
                                    </div> 
                                </div>
                            </div> 
                        </div> `; 
            $.each(JSON.parse(data.produk_detail), function(index, value) { 
                const data = JSON.parse(value.ProdukDetailVarian) 
                let varian = "";
                var i = 0;
                Object.keys(data).forEach(function (key) {
                    varian += '<span class="badge badge-'+ i % 5 +'">' + key + ' : '+data[key]+'</span>'; 
                    i++; 
                });   
                detailHtml +=  `
                            <div class="row m-2 varian-item-table" data-id="${index}">
                                <div class="col-10 col-md-4 my-2"> 
                                    <div class="row">
                                        <div class="col-12 col-md"> 
                                            <div class="d-flex gap-1 flex-column flex-md-row">  
                                                ${varian}
                                            </div>  
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-1 col-md-0 my-2 d-inline-block d-md-none"> 
                                    <button class="btn btn-sm btn-primary btn-detail"><i class="fa-solid fa-chevron-up"></i></button>
                                </div>
                                <div class="col-12 col-md-8 my-2 detail">
                                    <div class="row"> 
                                        <div class="col-6 col-md-2 px-1"> 
                                            <div class="mb-3">
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Berat</span>
                                                <div class="input-group mb-3"> 
                                                    <input type="text" class="form-control form-control-sm input-form berat" value="${value["ProdukDetailBerat"]}" data-id="${index}" disabled>
                                                    <span class="input-group-text font-std">(g)</span>
                                                </div> 
                                            </div>
                                        </div> 
                                        <div class="col-6 col-md-2 px-1">  
                                            <div class="mb-3">
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Satuan</span>
                                                <div class="input-group"> 
                                                    <select class="form-select form-select-sm satuan_id" data-id="${index}" style="width:100%" disabled>
                                                        <option selected>${value["ProdukSatuanName"]}</option>
                                                    </select>   
                                                </div>     
                                            </div>  
                                        </div> 
                                        <div class="col-12 col-md-2 px-1"> 
                                            <div class="mb-3">
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Isi M/<sup>2</sup></span>
                                                <div class="input-group"> 
                                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block pcsM2" data-id="${index}" value="${value["ProdukDetailPcsM2"]}" disabled>
                                                </div>   
                                            </div>  
                                        </div> 
                                        <div class="col-6 col-md-3 px-1"> 
                                            <div class="mb-3">
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga Beli</span>
                                                <div class="input-group">  
                                                    <span class="input-group-text font-std">Rp.</span> 
                                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" data-id="${index}" value="${value["ProdukDetailHargaBeli"]}" disabled>
                                                </div>   
                                            </div>  
                                        </div> 
                                        <div class="col-6 col-md-3 px-1"> 
                                            <div class="mb-3">
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga Jual</span>
                                                <div class="input-group"> 
                                                    <span class="input-group-text font-std">Rp.</span>
                                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" data-id="${index}" value="${value["ProdukDetailHargaJual"]}" disabled>
                                                </div>   
                                            </div>      
                                        </div> 
                                    </div>    
                                </div>   
                            </div>  `;
            }); 
            
            detailHtml+= "</div>";
            table.row(this).child(detailHtml,'no-padding').show(); 
            $('div.varian-detail', table.row(this).child()).slideDown(); 

           
        }
        $(".btn-detail").click(function(){
            var detail = $(this).parent().parent().find(".detail");
            if($(detail).hasClass("hide")){
                $(detail).removeClass("hide");
                $(this).find("i").removeClass("fa-rotate-180");
            }else{ 
                $(detail).addClass("hide");
                $(this).find("i").addClass("fa-rotate-180");
            }
        });
        
    }); 

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
            url: "<?= base_url() ?>message/add-produk", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-produk").modal("show"); 

                $("#modal-add-produk").on("hidden.bs.modal",function(){
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
            url: "<?= base_url() ?>message/edit-produk/" + id, 
            success: function(data) {   
                isProcessingEdit = false;
                $(el).html(old_text);
                $("#modal-message").html(data);
                $("#modal-edit-produk").modal("show");  

                $("#modal-edit-produk").on("hidden.bs.modal",function(){
                    table.ajax.reload(null, false).responsive.recalc().columns.adjust();
                });   
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
            text: "Anda yakin ingin menghapus produk ini...???",
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
                    url: "<?= base_url() ?>action/delete-data-produk/" + id, 
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

</script>
<?php $this->endSection(); ?>