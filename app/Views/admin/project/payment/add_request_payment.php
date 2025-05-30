<div class="modal fade" id="modal-request-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true" data-menu="project">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Request Pembayaran <?= $refType ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="mb-1">
                    <label for="date-payment" class="col-form-label">Bank:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="bank-payment" value="" placeholder="Masukan nama Bank (contoh: BCA,BNI)">
                </div>  
                <div class="mb-1">
                    <label for="date-payment" class="col-form-label">No. Rekening:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="rek-payment" value=""  placeholder="Masukan Nomer Rekening (contoh: 781234567)">
                </div>  
                <div class="mb-1">
                    <label for="date-payment" class="col-form-label">Nama Rekening:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="name-payment" value=""  placeholder="Masukan Nama Rekening (contoh: Mahiera Global Solution)">
                </div>  
                <div class="mb-1">
                    <label for="sisa-payment" class="col-form-label">Pembayaran:</label>
                    <div class="input-group"> 
                        <span class="input-group-text font-std">Rp.</span>
                        <input type="text"class="form-control form-control-sm  input-form d-inline-block number-price" id="total-payment" value="<?= $total ?>" disabled>
                    </div>   
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-request-payment">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script> 
    $(".number-price").each(function(){
        new Cleave(this, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
        }); 
    }); 
    $("#btn-request-payment").click(function(){
      
        if($("#bank-payment").val() == 0){
            Swal.fire({
                icon: 'error',
                text: 'Nama bank harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#bank-payment").focus(), 300); 
            }) ;
            return; 
        }    
        if($("#rek-payment").val() == 0){
            Swal.fire({
                icon: 'error',
                text: 'rekening bank harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#rek-payment").focus(), 300); 
            }) ;
            return; 
        }    
        if($("#name-payment").val() == 0){
            Swal.fire({
                icon: 'error',
                text: 'nama rekening harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#name-payment").focus(), 300); 
            }) ;
            return; 
        }    

        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/request-data-payment", 
            data:{ 
                "PaymentRequestRef": '<?= $ref ?>', 
                "PaymentRequestRefType": '<?= $refType ?>',  
                "ProjectId": '<?= $project ?>', 
                "PaymentRequestBank": $("#bank-payment").val(), 
                "PaymentRequestRek": $("#rek-payment").val(), 
                "PaymentRequestName":$("#name-payment").val(), 
                "PaymentRequestTotal": $("#total-payment").val().replace(/[^0-9]/g, ''),  
                "PaymentRequestStatus":0, 
            },
            success: function(data) {   
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-request-payment").modal("hide"); 
                        if('<?= strtolower($refType) ?>' == "delivery"){
                            loader_data_project('<?= $project ?>','pengiriman')  
                        } else{ 
                            loader_data_project('<?= $project ?>','<?= strtolower($refType) ?>')  
                        }
                         
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