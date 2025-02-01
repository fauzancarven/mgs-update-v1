
<div class="modal fade" id="modal-edit-account" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-edit-account-label" aria-hidden="true" style="overflow-y:auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-account-label">Edit Account</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3" style="font-size:12px">  
                <div class="row"> 
                    <div class="col-md-4 text-center clearfix"> 
                        <div class="small-box justify-content-center">
                            <label class="cabinet p-auto">
                                <input type="file" class="form-control item-img file d-none" id="editMsEmpImageFile" name="editMsEmpImageFile" accept="image/*" >
                                <figure>
                                    <img src="<?= $_image ?>" class="image-upload m-auto" id="EditAccountImage" name="EditAccountImage" style="width:200px;height:200px;"/>
                                    <figcaption class="text-center"> <i class="ti-camera"></i>&nbsp; Change</figcaption>
                                </figure>
                            </label>
                        </div>
                    </div>   
                    <div class="col-md-8"> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="EditAccountCode" class="col-sm-3 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="EditAccountCode" name="EditAccountCode" type="text" class="form-control form-control-sm input-form" value="<?= $_account->code ?>" disabled>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="EditAccountName" class="col-sm-3 col-form-label">Nama<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="EditAccountName" name="EditAccountName" type="text" class="form-control form-control-sm input-form" value="<?= $_account->username ?>" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="EditAccountEmail" class="col-sm-3 col-form-label">Email<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="EditAccountEmail" name="EditAccountEmail" type="text" class="form-control form-control-sm input-form" value="<?= $_account->email ?>" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="EditAccountLevel" class="col-sm-3 col-form-label">Level<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <select name="EditAccountLevel" id="EditAccountLevel" class="form-select form-select-sm" style="width:100%">
                                    <option value="0" <?= ($_account->level == 0 ? "selected" : "")?>>Administrator</option>
                                    <option value="1" <?= ($_account->level == 1 ? "selected" : "")?>>Staff</option>
                                </select> 
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="EditAccountPassword" class="col-sm-3 col-form-label">Password<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <div class="input-group"> 
                                    <input class="form-control form-control-sm input-form" id="EditAccountPassword" name="EditAccountPassword" placeholder="Password" value="" type="password">
                                    <span class="input-group-text"> 
                                        <i class="ti-eye" id="EdittogglePassword" style="cursor: pointer"></i>
                                    </span>
                                </div> 
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center">
                            <label for="EditAccountRePassword" class="col-sm-3 col-form-label">Re-Password<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <div class="input-group"> 
                                    <input class="form-control form-control-sm input-form" id="EditAccountRePassword" name="EditAccountRePassword" placeholder="Password" value="" type="password">
                                    <span class="input-group-text"> 
                                        <i class="ti-eye" id="EdittoggleRePassword" style="cursor: pointer"></i>
                                    </span>
                                </div> 
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center">
                            <span class="col-sm-9 offset-sm-3 fst-italic text-danger">Note : <br>Jika tidak ingin mengganti password maka kolom password dan re-password tidak perlu diisi</span>
                        </div>  
                        <div class="row mx-1 my-3 mt-4 align-items-center">
                            <div class="label-border-right position-relative" >
                                <span class="label-dialog">Personal Info</span> 
                            </div>
                        </div>   
                        <div class="row mb-1 align-items-center mt-0 mt-md-2">
                            <label for="EditAccountBirthPlace" class="col-sm-3 col-form-label">Tempat, Tgl Lahir.</label>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <input id="EditAccountBirthPlace" name="EditAccountBirthPlace" type="text" class="form-control form-control-sm input-form input-phone" value="<?= $_account->UserBirthPlace ?>" placeholder="jakarta">
                                <span class="fw-bold px-2">,</span>
                                <input id="EditAccountBirthDate" name="EditAccountBirthDate" type="text" class="form-control form-control-sm input-form input-phone" value="<?= $_account->UserBirthDate ?>" placeholder="20/10/10">
                            </div> 
                        </div>  
                        <div class="row mb-1 align-items-center mt-0 mt-md-2">
                            <label for="EditAccountTelp1" class="col-sm-3 col-form-label">Telp.</label>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <input id="EditAccountTelp1" name="EditAccountTelp1" type="text" class="form-control form-control-sm input-form input-phone" value="<?= $_account->UserTelp1 ?>">
                                <span class="fw-bold px-2">/</span>
                                <input id="EditAccountTelp2" name="EditAccountTelp2" type="text" class="form-control form-control-sm input-form input-phone" value="<?= $_account->UserTelp2 ?>">
                            </div> 
                        </div>  
                        <div class="row mb-1 align-items-center">
                            <label for="EditAccountAddress" class="col-sm-3 col-form-label">Alamat<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <textarea id="EditAccountAddress" name="EditAccountAddress" type="text" class="form-control form-control-sm input-form"> <?= $_account->UserAddress ?></textarea>
                            </div>
                        </div>  
                    </div>   
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary m-1" id="btn-edit-account">Simpan</button>
            </div> 
        </div>
    </div>
</div>
<div class="modal fade" id="editcropImagePop" tabindex="-1" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div id="Editupload-demo" class="center-block m-auto"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default float-start" data-bs-dismiss="modal">Close</button>
                <button type="button" id="editcropImageBtn" class="btn btn-primary float-end">Crop</button>
            </div>
        </div>
    </div>
</div> 
<script>
    $('#EditAccountBirthDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment('<?= $_account->UserBirthDate ?>'),
        "endDate":  moment('<?= $_account->UserBirthDate ?>'), 
        dropdownParent: $('#modal-edit-account .modal-content'), 
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    $("#EditAccountLevel").select2({
        dropdownParent: $('#modal-edit-account .modal-content'),
        placeholder: "Pilih Level", 
    });
    $("#EdittogglePassword").click(function(){
        const type = $("#EditAccountPassword").attr("type") === "password" ? "text" : "password";
        $("#EditAccountPassword").attr("type", type);                             
    }); 
    $("#EdittoggleRePassword").click(function(){
        const type = $("#EditAccountRePassword").attr("type") === "password" ? "text" : "password";
        $("#EditAccountRePassword").attr("type", type);                             
    }); 

    var $edituploadCrop,
    EdittempFilename,
    EditrawImg,
    EditimageId;  
    function readFileEdit(input) {
        console.log("read input edit");
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) { 
                $("#editcropImagePop").modal("show");
                EditrawImg = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
        else {
            swal.fire("Sorry - you\'re browser doesn\'t support the FileReader API");
        }
    } 
    $edituploadCrop = $("#Editupload-demo").croppie({
        viewport: {
            width: 150,
            height: 150,
            type: "circle"
        },
        boundary: {
            width: 300,
            height: 300
        },
        enforceBoundary: false,
        enableExif: true
    });
    $("#editcropImagePop").on("shown.bs.modal", function(){
        // alert("Shown pop");
        $edituploadCrop.croppie("bind", {
            url: EditrawImg
        }).then(function(){
            console.log("jQuery bind complete");
        });
    }); 
    $("#editMsEmpImageFile").on("change", function () {
        EditimageId = $(this).data("id"); 
        EdittempFilename = $(this).val();
        $("#EditcancelCropBtn").data("id", EditimageId); 
        readFileEdit(this); 
    });
    $("#editcropImageBtn").on("click", function (ev) {
        $edituploadCrop.croppie("result", {
            circle: false, 
            type: "base64",
            format: "png",
            size: {width: 150, height: 150}
        }).then(function (resp) {
            $("#EditAccountImage").attr("src", resp);
            $("#editcropImagePop").modal("hide");
        });
    });
    // End upload preview image

    
    $("#btn-edit-account").click(function(){ 
        // INSERT LOADER BUTTON
        if (isProcessingSave) {
            return;
        }  
        isProcessingSave = true; 
        let old_text = $(this).html();
        $(this).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        if($("#EditAccountName").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Nama harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#EditAccountName").focus(), 300); 
            }) ;
            return;
        }
        if($("#EditAccountEmail").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Email harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#EditAccountEmail").focus(), 300); 
            }) ;
            return;
        }
        if($("#EditAccountPassword").val() == "" && $("#EditAccountPassword").val().length > 0){
            Swal.fire({
                icon: 'error',
                text: 'Password harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#EditAccountPassword").focus(), 300); 
            }) ;
            return;
        }
        if($("#EditAccountPassword").val().length < 8 && $("#EditAccountPassword").val().length > 0){
            Swal.fire({
                icon: 'error',
                text: 'Password harus 8 karakter...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#EditAccountPassword").focus(), 300); 
            }) ;
            return;
        }
         
        if($("#EditAccountPassword").val() !== $("#EditAccountRePassword").val()){
            Swal.fire({
                icon: 'error',
                text: 'Password Tidak match...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#EditAccountRePassword").focus(), 300); 
            }) ;
            return;
        }
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-account/" + <?= $_account->id?>, 
            data:{
                "username":$("#EditAccountName").val(),
                "email":$("#EditAccountEmail").val(),
                "code":$("#EditAccountCode").val(),
                "password":$("#EditAccountPassword").val(),
                "image":$("#EditAccountImage").attr("src"),
                "level":$("#EditAccountLevel").val(),
                "UserBirthDate":$("#EditAccountBirthDate").data('daterangepicker').startDate.format("YYYY-MM-DD"),
                "UserBirthPlace":$("#EditAccountBirthPlace").val(),
                "UserTelp1":$("#EditAccountTelp1").val(),
                "UserTelp2":$("#EditAccountTelp2").val(),
                "UserAddress":$("#EditAccountAddress").val(),
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
                        $("#modal-edit-account").modal("hide");
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