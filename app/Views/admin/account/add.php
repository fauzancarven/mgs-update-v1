<div class="modal fade" id="modal-add-account" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-account-label" aria-hidden="true" style="overflow-y:auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-account-label">Tambah Account</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3" style="font-size:12px">  
                <div class="row"> 
                    <div class="col-md-4 text-center clearfix"> 
                        <div class="small-box justify-content-center">
                            <label class="cabinet p-auto">
                                <input type="file" class="form-control item-img file d-none" id="MsEmpImageFile" name="MsEmpImageFile" accept="image/*" >
                                <figure>
                                    <img src="<?= $_image?>"  class="image-upload m-auto" id="AccountImage" name="AccountImage" style="width:200px;height:200px;"/>
                                    <figcaption class="text-center"> <i class="ti-camera"></i>&nbsp; Change</figcaption>
                                </figure>
                            </label>
                        </div>
                    </div>   
                    <div class="col-md-8">
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="AccountCode" class="col-sm-3 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="AccountCode" name="AccountCode" type="text" class="form-control form-control-sm input-form" value="(auto)" disabled>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="AccountName" class="col-sm-3 col-form-label">Nama<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="AccountName" name="AccountName" type="text" class="form-control form-control-sm input-form" value="" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="AccountEmail" class="col-sm-3 col-form-label">Email<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="AccountEmail" name="AccountEmail" type="text" class="form-control form-control-sm input-form" value="" require>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="AccountLevel" class="col-sm-3 col-form-label">Level<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <select name="AccountLevel" id="AccountLevel" class="form-select form-select-sm" style="width:100%">
                                    <option value="0" selected>Administrator</option>
                                    <option value="1">Staff</option>
                                </select> 
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="AccountPassword" class="col-sm-3 col-form-label">Password<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <div class="input-group"> 
                                    <input class="form-control form-control-sm input-form" id="AccountPassword" name="AccountPassword" placeholder="Password" value="" type="password">
                                    <span class="input-group-text"> 
                                        <i class="ti-eye" id="togglePassword" style="cursor: pointer"></i>
                                    </span>
                                </div> 
                            </div>
                        </div> 
                        
                        <div class="row mb-1 align-items-center">
                            <label for="AccountRePassword" class="col-sm-3 col-form-label">Re-Password<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <div class="input-group"> 
                                    <input class="form-control form-control-sm input-form" id="AccountRePassword" name="AccountRePassword" placeholder="Password" value="" type="password">
                                    <span class="input-group-text"> 
                                        <i class="ti-eye" id="toggleRePassword" style="cursor: pointer"></i>
                                    </span>
                                </div> 
                            </div>
                        </div> 
                        <div class="row mx-1 my-3 mt-4 align-items-center">
                            <div class="label-border-right position-relative" >
                                <span class="label-dialog">Personal Info</span> 
                            </div>
                        </div>   
                        <div class="row mb-1 align-items-center mt-0 mt-md-2">
                            <label for="AccountBirthPlace" class="col-sm-3 col-form-label">Tempat, Tgl Lahir.</label>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <input id="AccountBirthPlace" name="AccountBirthPlace" type="text" class="form-control form-control-sm input-form input-phone" value="" placeholder="Jakarta">
                                <span class="fw-bold px-2">,</span>
                                <input id="AccountBirthDate" name="AccountBirthDate" type="text" class="form-control form-control-sm input-form input-phone" value="" placeholder="20/10/10">
                            </div> 
                        </div>  
                        <div class="row mb-1 align-items-center mt-0 mt-md-2">
                            <label for="AccountTelp1" class="col-sm-3 col-form-label">Telp.</label>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <input id="AccountTelp1" name="AccountTelp1" type="text" class="form-control form-control-sm input-form input-phone" value="">
                                <span class="fw-bold px-2">/</span>
                                <input id="AccountTelp2" name="AccountTelp2" type="text" class="form-control form-control-sm input-form input-phone" value="">
                            </div> 
                        </div>  
                        <div class="row mb-1 align-items-center">
                            <label for="AccountAddress" class="col-sm-3 col-form-label">Alamat<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <textarea id="AccountAddress" name="AccountAddress" type="text" class="form-control form-control-sm input-form"></textarea>
                            </div>
                        </div>   
                    </div>   
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary m-1" id="btn-add-Account">Simpan</button>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div id="upload-demo" class="center-block m-auto"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default float-start" data-bs-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary float-end">Crop</button>
            </div>
        </div>
    </div>
</div>
 
<script>
    $('#AccountBirthDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment(),
        "endDate":  moment(), 
        dropdownParent: $('#modal-add-account .modal-content'), 
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    $("#AccountLevel").select2({
        dropdownParent: $('#modal-add-account .modal-content'),
        placeholder: "Pilih Level", 
    });

    $("#togglePassword").click(function(){
        const type = $("#AccountPassword").attr("type") === "password" ? "text" : "password";
        $("#AccountPassword").attr("type", type);                             
    }); 
    $("#toggleRePassword").click(function(){
        const type = $("#AccountRePassword").attr("type") === "password" ? "text" : "password";
        $("#AccountRePassword").attr("type", type);                             
    }); 

    //upload image
    function toDataURL(src, callback, outputFormat) {
        var img = new Image();
        img.crossOrigin = 'Anonymous';
        img.onload = function() {
            var canvas = document.createElement('CANVAS');
            var ctx = canvas.getContext('2d');
            var dataURL;
            canvas.height = this.naturalHeight;
            canvas.width = this.naturalWidth;
            ctx.drawImage(this, 0, 0);
            dataURL = canvas.toDataURL(outputFormat);
            callback(dataURL);
        };
        img.src = src;
        if (img.complete || img.complete === undefined) {
            img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
            img.src = src;
        }
    } 
    var $uploadCrop,
    tempFilename,
    rawImg,
    imageId;  
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".upload-demo").addClass("ready");
                $("#cropImagePop").modal("show");
                rawImg = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
        else {
            swal.fire("Sorry - you\'re browser doesn\'t support the FileReader API");
        }
    } 
    $uploadCrop = $("#upload-demo").croppie({
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
    $("#cropImagePop").on("shown.bs.modal", function(){
        // alert("Shown pop");
        $uploadCrop.croppie("bind", {
            url: rawImg
        }).then(function(){
            console.log("jQuery bind complete");
        });
    }); 
    $("#MsEmpImageFile").on("change", function () {
        imageId = $(this).data("id"); 
        tempFilename = $(this).val();
        $("#cancelCropBtn").data("id", imageId); 
        readFile(this); 
    });
    $("#cropImageBtn").on("click", function (ev) {
        $uploadCrop.croppie("result", {
            circle: false, 
            type: "base64",
            format: "png",
            size: {width: 150, height: 150}
        }).then(function (resp) {
            $("#AccountImage").attr("src", resp);
            $("#cropImagePop").modal("hide");
        });
    });
    // End upload preview image
    $("#btn-add-Account").click(function(){
       
        // END LOADER BUTTON
        if($("#AccountName").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Nama harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#AccountName").focus(), 300); 
            }) ;
            return;
        }
        if($("#AccountEmail").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Email harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#AccountEmail").focus(), 300); 
            }) ;
            return;
        }
        if($("#AccountPassword").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Password harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#AccountPassword").focus(), 300); 
            }) ;
            return;
        }
        if($("#AccountPassword").val().length < 8){
            Swal.fire({
                icon: 'error',
                text: 'Password harus 8 karakter...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#AccountPassword").focus(), 300); 
            }) ;
            return;
        }
         
        if($("#AccountPassword").val() !== $("#AccountRePassword").val()){
            Swal.fire({
                icon: 'error',
                text: 'Password Tidak Cocok...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#AccountRePassword").focus(), 300); 
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
            url: "<?= base_url() ?>action/add-data-account", 
            data:{
                "username":$("#AccountName").val(),
                "email":$("#AccountEmail").val(),
                "code":$("#AccountCode").val(),
                "password":$("#AccountPassword").val(),
                "image":$("#AccountImage").attr("src"),
                "level":$("#AccountLevel").val(),
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
                        $("#modal-add-account").modal("hide");
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