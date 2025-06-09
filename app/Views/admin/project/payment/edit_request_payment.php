<div class="modal fade" id="modal-request-payment-edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true" data-menu="project">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Request Pembayaran <?= $payment->PaymentRefType ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                
                <div class="mb-1">
                    <label for="method-payment" class="col-form-label">Metode Pembayaran:</label>
                    <select class="form-select form-select-sm" style="width:100%" id="method-payment">
                        <option value="Transfer" selected>Transfer</option> 
                        <option value="Cash">Cash</option>
                    </select>   
                </div>   
                <div class="mb-1 bank-transfer">
                    <label for="bank-payment" class="col-form-label">Bank:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="bank-payment" value="<?= $payment->PaymentToBank?>" placeholder="Masukan nama Bank (contoh: BCA,BNI)">
                </div>  
                <div class="mb-1 bank-transfer">
                    <label for="rek-payment" class="col-form-label">No. Rekening:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="rek-payment" value="<?= $payment->PaymentToRek?>"  placeholder="Masukan Nomer Rekening (contoh: 781234567)">
                </div>  
                <div class="mb-1">
                    <label for="name-payment" class="col-form-label" id="name-payment-text">Nama Rekening:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="name-payment" value="<?= $payment->PaymentToName?>"  placeholder="Masukan Nama Rekening (contoh: Mahiera Global Solution)">
                </div>  
                <div class="mb-1">
                    <label for="total-payment" class="col-form-label">Pembayaran:</label>
                    <div class="input-group"> 
                        <span class="input-group-text font-std">Rp.</span>
                        <input type="text"class="form-control form-control-sm  input-form d-inline-block number-price" id="total-payment" value="<?= $payment->PaymentTotal ?>" disabled>
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

    $("#method-payment").select2({
        dropdownParent: $('#modal-request-payment-edit'),
        placeholder: "Pilih Methode", 
    }).on("select2:select", function(e) {
        var data = e.params.data;    
        if(data.id == "Cash"){
            $("#bank-payment").val("");
            $("#rek-payment").val("");
            $(".bank-transfer").addClass("d-none");
            $("#name-payment-text").text("Nama Penerima:");
            $("#name-payment").attr("placeholder","Masukan Nama Penerima (contoh: Fauzan Caren)") ;
        }else{
            $(".bank-transfer").removeClass("d-none"); 
            $("#name-payment-text").text("Nama Rekening:");
            $("#name-payment").attr("placeholder","Masukan Nama Rekening (contoh: Mahiera Global Solution)") ;
        }
    });
    
    //$('#method-payment').append(new Option('<?= $payment->PaymentMethod ?>' , '<?= $payment->PaymentMethod ?>', true, true)).trigger('change');   
    $('#method-payment').val('<?= $payment->PaymentMethod ?>').trigger('change');
    $('#method-payment').trigger({
        type: 'select2:select',
        params: {
            data: {
                id: '<?= $payment->PaymentMethod ?>',
                text: $('#method-payment').find('option[value="<?= $payment->PaymentMethod ?>"]').text()
            }
        }
    });

    $("#btn-request-payment").click(function(){
        if($("#method-payment").val() == "Transfer"){ 
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
                    text: 'Rekening bank harus diisi...!!!', 
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
                    text: 'Nama rekening harus diisi...!!!', 
                    confirmButtonColor: "#3085d6", 
                }).then(function(){ 
                    swal.close();
                    setTimeout(() => $("#name-payment").focus(), 300); 
                }) ;
                return; 
            }    
        }else{
            if($("#name-payment").val() == 0){
                Swal.fire({
                    icon: 'error',
                    text: 'Nama penerima harus diisi...!!!', 
                    confirmButtonColor: "#3085d6", 
                }).then(function(){ 
                    swal.close();
                    setTimeout(() => $("#name-payment").focus(), 300); 
                }) ;
                return; 
            }    

        }
        

        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/request-data-payment-edit/<?= $payment->PaymentId ?>",  
            data:{  
                "PaymentMethod": $("#method-payment").val(), 
                "PaymentToBank": $("#bank-payment").val(), 
                "PaymentToRek": $("#rek-payment").val(), 
                "PaymentToName":$("#name-payment").val(),   
            },
            success: function(data) {   
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-request-payment-edit").modal("hide");  
                        if('<?= strtolower($payment->PaymentRefType) ?>' == "survey"){  
                            table.ajax.reload(null, false);
                        } else if('<?= strtolower($payment->PaymentRefType) ?>' == "delivery"){
                            loader_data_project('<?= $payment->ProjectId ?>','pengiriman')  
                        }else{ 
                            loader_data_project('<?= $payment->ProjectId ?>','<?= strtolower($payment->PaymentRefType) ?>')  
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