 
<div class="modal fade" id="modal-edit-vendor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-edit-vendor-label" aria-hidden="true" style="overflow-y:auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-vendor-label">Edit Vendor</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="row"> 
                    <div class="col-12 ">
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="vendorcode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="vendorcode" name="vendorcode" type="text" class="form-control form-control-sm" value="<?= $_vendor->VendorCode?>" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="vendorname" class="col-sm-2 col-form-label">Nama<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="vendorname" name="vendorname" type="text" class="form-control form-control-sm" value="<?= $_vendor->VendorName?>" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="vendortelp1" class="col-sm-2 col-form-label">Telp 1<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="vendortelp1" name="vendortelp1" type="text" class="form-control form-control-sm input-phone" value="<?= $_vendor->VendorTelp1?>" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="vendortelp2" class="col-sm-2 col-form-label">Telp 2</label>
                            <div class="col-sm-10">
                                <input id="vendortelp2" name="vendortelp2" type="text" class="form-control form-control-sm input-phone" value="<?= $_vendor->VendorTelp2?>" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="vendoraddress" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea id="vendoraddress" name="vendoraddress" type="text" class="form-control form-control-sm" require><?= $_vendor->VendorAddress?></textarea>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="vendorcategory" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" style="width:100%" id="vendorcategory" multiple="multiple">
                                <?php
                                $arr = explode('|', $_vendor->VendorCategory);
                                foreach($arr as $row){
                                    echo "<option selected>".$row."</option>";
                                }
                                 
                                ?>
                                </select>
                            </div>
                        </div>  
                            
                    </div>   
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary m-1" id="btn-edit-vendor">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".input-phone").toArray().forEach(function(el){
        new Cleave(el,{
            phone: true,
            phoneRegionCode: 'id'
        });
    })
    $("#vendorcategory").select2({
        dropdownParent: $('#modal-edit-vendor .modal-content'),
        tags: true,
        tokenSeparators: [','],
        placeholder: "Pilih Kategori",
        ajax: {
            url: "<?= base_url()?>select2/get-data-vendor-kategori",
            dataType: 'json',
            type:"POST",
            delay: 250,
            data: function (params) {
                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                return {
                    searchTerm: params.term, // search term
                    [csrfName]: csrfHash // CSRF Token
                };
            },
            processResults: function (response) {
    
                // Update CSRF Token
                $('.txt_csrfname').val(response.token); 

                return {
                    results: response.data
                };
            },
            cache: true
        }, 
    });
    $("#btn-edit-vendor").click(function(){ 
        if($("#vendorcode").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'code harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#vendorcode").focus(), 300); 
            }) ;
            return;
        }
         if($("#vendorname").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Nama harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#vendorname").focus(), 300); 
            }) ;
            return;
        }
        if($("#vendortelp1").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Nomor Telepon harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#vendortelp1").focus(), 300); 
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
            url: "<?= base_url() ?>action/edit-data-vendor/<?= $_vendor->VendorId?>" , 
            data:{
                "VendorCode":$("#vendorcode").val(),
                "VendorName":$("#vendorname").val(),
                "VendorTelp1":$("#vendortelp1").val().replace(/ /g,""),
                "VendorTelp2":$("#vendortelp2").val().replace(/ /g,""),
                "VendorAddress":$("#vendoraddress").val(),
                "VendorCategory":$("#vendorcategory").val().join("|"),
            },
            success: function(data) {   
                isProcessingSave = false;
                $(this).html(old_text); 

                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {
                        table.ajax.reload(null, false).responsive.recalc().columns.adjust();
                        $("#modal-edit-vendor").modal("hide");
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
    })
</script>