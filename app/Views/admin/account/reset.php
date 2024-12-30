
<div class="modal fade" id="modal-reset-account" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-reset-account-label" aria-hidden="true" style="overflow-y:auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-reset-account-label">Reset Password<span style="font-size:0.75rem">(<?= $_account->code." - ".$_account->username?>)</span></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3" style="font-size:12px">   
                <input class="form-control form-control-sm d-none" id="resetAccountId" name="resetAccountId"   value="<?= $_account->id ?>" type="text">
                <div class="row mb-1 align-items-center">
                    <label for="resetAccountPassword" class="col-sm-3 col-form-label">Password<sup class="error">&nbsp;*</sup></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input class="form-control form-control-sm" id="resetAccountPassword" name="resetAccountPassword" placeholder="Password" value="" type="password">
                            <span class="input-group-text"> 
                                <i class="ti-eye" id="resettogglePassword" style="cursor: pointer"></i>
                            </span>
                        </div> 
                    </div>
                </div> 
                <script>
                </script>
                
                <div class="row mb-1 align-items-center">
                    <label for="resetAccountRePassword" class="col-sm-3 col-form-label">Re-Password<sup class="error">&nbsp;*</sup></label>
                    <div class="col-sm-9">
                        <div class="input-group"> 
                            <input class="form-control form-control-sm" id="resetAccountRePassword" name="resetAccountRePassword" placeholder="Password" value="" type="password">
                            <span class="input-group-text"> 
                                <i class="ti-eye" id="resettoggleRePassword" style="cursor: pointer"></i>
                            </span>
                        </div> 
                    </div>
                </div> 
                <script>
                </script>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary m-1" id="btn-reset-account">Simpan</button>
            </div>  
        </div>
    </div>
</div>
<script>  
    $("#resettogglePassword").click(function(){
        const type = $("#resetAccountPassword").attr("type") === "password" ? "text" : "password";
        $("#resetAccountPassword").attr("type", type);                             
    }); 
    $("#resettoggleRePassword").click(function(){
        const type = $("#resetAccountRePassword").attr("type") === "password" ? "text" : "password";
        $("#resetAccountRePassword").attr("type", type);                             
    });  
    $("#btn-reset-account").click(function(){

        if($("#resetAccountPassword").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Password harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }) ;
            return;
        }
        if($("#resetAccountPassword").val().length < 8){
            Swal.fire({
                icon: 'error',
                text: 'Password harus 8 karakter...!!!', 
                confirmButtonColor: "#3085d6", 
            }) ;
            return;
        } 
        if($("#resetAccountPassword").val() !== $("#resetAccountRePassword").val()){
            Swal.fire({
                icon: 'error',
                text: 'Password Tidak match...!!!', 
                confirmButtonColor: "#3085d6", 
            }) ;
            return;
        } 

        // INSERT LOADER BUTTON
        if (isProcessingSave) {
            return;
        }  
        isProcessingSave = true; 
        let old_text = $(this).html();
        $(this).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>'); 
        
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/reset-password-data-account", 
            data:{
                "id":$("#resetAccountId").val(), 
                "password":$("#resetAccountPassword").val(), 
            },
            success: function(data) { 
                isProcessingSave = false;
                $(this).html(old_text);
                   
                console.log(data); 
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {
                        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
                        $("#modal-reset-account").modal("hide");
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
                isProcessingSave = false;
                $(this).html(old_text);

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }); 
</script>