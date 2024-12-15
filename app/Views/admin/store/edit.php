
<div class="modal fade" id="modal-edit-store" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-edit-store-label" aria-hidden="true" style="overflow-y:auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-store-label">Edit Toko</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="row"> 
                    <div class="col-12 "> 
                        <input id="EditStoreId" name="EditStoreId" type="text" class="form-control form-control-sm d-none" value="" require> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="EditStoreCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="EditStoreCode" name="EditStoreCode" type="text" class="form-control form-control-sm" value="" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="EditStoreName" class="col-sm-2 col-form-label">Nama<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="EditStoreName" name="EditStoreName" type="text" class="form-control form-control-sm" value="" require>
                            </div>
                        </div> 
                    </div>   
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary m-1" id="btn-edit-store">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script> 
    $("#btn-edit-store").click(function(){
        if($("#EditStoreCode").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Kode harus diisi...!!!', 
            }) ;
            return;
        }
        if($("#EditStoreName").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Nama harus diisi...!!!', 
            }) ;
            return;
        }

        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-store/" +  $("#EditStoreId").val(),
            data: { 
                "StoreCode": $("#EditStoreCode").val(), 
                "StoreName": $("#EditStoreName").val(), 
            }, 
            success: function(data) {
                console.log(data);
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Edit toko berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {
                        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
                        $("#modal-edit-store").modal("hide");
                    });
                  
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data["err"], 
                    });
                }
                
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
        });
    })
</script>
