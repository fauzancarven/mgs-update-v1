<div class="modal fade" id="modal-add-proses-delivery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Konfirmasi dan upload foto pengemasan</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">  
                <div class="row mb-1 align-items-center mt-2">
                    <label for="DeliveryDateProses" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input id="DeliveryDateProses" name="DeliveryDateProses" type="text" class="form-control form-control-sm input-form" value="">
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="DeliveryDateProses" class="col-sm-2 col-form-label pe-0">Upload Bukti</label>
                    <div class="col-sm-10">
                         <button id="remove-image" class="btn btn-sm btn-danger btn-action m-1" onclick=""><i class="fa-solid fa-close pe-2"></i>Hapus</button>
                    </div>
                </div>   
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Lampiran Gambar</span> 
                    </div>
                </div>  
                <div class="row p-2"> 
                    <input type="file" class="d-none" accept="image/*" id="upload-produk" multiple> 
                    <div class="col-sm-12 d-flex flex-wrap"> 
                        <div class="d-flex flex-wrap">
                            <div class="d-flex flex-wrap" id="list-produk">
                                <div class="image-default-obi" id="img-produk">
                                    <i class="ti-image" style="font-size:1rem"></i>
                                    <span>Tambah Foto</span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>    
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-proses-delivery">Simpan</button>
            </div>
        </div>
    </div>
</div> 
<div id="modal-optional"></div>
<script>     
    $('#DeliveryDateProses').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment(),
        "endDate":  moment(),
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    
    $("#img-produk").on('click',function(){
        $("#upload-produk").trigger("click");
    })  
    $("#upload-produk").on('change', function() { 
        const files = this.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file) {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    
                    $("#img-produk").remove()
                    $("#list-produk").append(`<div class="image-default-obi border">
                    <img src="${reader.result}" draggable="true">
                    <div class="action">
                        <a class="btn btn-sm btn-white p-1" onclick="crop_image(this)"><i class="fas fa-crop-alt"></i></a>
                        <a class="btn btn-sm btn-white p-1" onclick="delete_image(this)"><i class="fas fa-trash"></i></a>
                    </div>
                    </div>`);
                    // Tambahkan event dragstart, dragover, dragleave, dan drop untuk setiap gambar
                    var draggedImage = null;
                    $('.image-default-obi.border img').on('dragstart', function(event) {
                        draggedImage = $(this);
                    });
                    $('.image-default-obi.border').on('dragover', function(event) {
                        event.preventDefault();
                        $(this).addClass('dragover');
                        });
                        $('.image-default-obi.border').on('dragleave', function() {
                        $(this).removeClass('dragover');
                        });
                        $('.image-default-obi.border').on('drop', function(event) {
                        event.preventDefault();
                        $(this).removeClass('dragover');
                        const existingImage = $(this).find('img');
                        if (draggedImage) {
                            const sourceDropzone = draggedImage.closest('.image-default-obi.border');
                            sourceDropzone.prepend(existingImage);
                            $(this).prepend(draggedImage);
                        }
                    });
                    
                    $("#list-produk").append(`<div class="image-default-obi" id="img-produk">
                        <i class="ti-image" style="font-size:1rem"></i>
                        <span>Tambah Foto</span>
                    </div>`);
                    
                    $("#img-produk").on('click',function(){
                        $("#upload-produk").trigger("click");
                    })  
                }
            }
        }
    });
    var $uploadCrop, tempFilename, rawImg, imageId; 
    $uploadCrop = $('#crop-image').croppie({
        viewport: {
            width: 400,
            height: 400,
        },
        showZoomer: false,
        enforceBoundary: false,
        enableExif: true,
        enableOrientation: true
    });
    crop_image = function(el){ 
        var image_crop = $(el).parent().parent().find('img');
        var flip = 0;
        $('#modal-edit').modal('show');
        
        $('#modal-edit').on('shown.bs.modal', function(){ 
            $uploadCrop.croppie('bind', {
                url: $(image_crop).attr('src')
            }).then(function(){
                console.log('jQuery bind complete');
            });
        });
        rotate_image = function(val){
            $uploadCrop.croppie('rotate',parseInt(val));
        }
        flip_image = function(val){
            flip = flip == 0 ? val : 0;
            $uploadCrop.croppie('bind', { 
                url: $(el).parent().parent().find('img').attr('src'),
                orientation: flip
            });
        } 

        $('#submit-crop').unbind().click(function (ev) {
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'png',
                size: {width: 400, height: 400}
            }).then(function (resp) { 
                $(image_crop).attr('src',resp) 
                $('#modal-edit').modal('hide');
            });
        });
    }
    delete_image = function(el){
        $(el).parent().parent().remove();
    }   

    $("#btn-proses-delivery").click(function(){
        var srcList = $("#list-produk img").not("#img-produk img").map(function(){ return $(this).attr("src")}).get();
        if(srcList.length === 0 ){
            Swal.fire({
                icon: 'error',
                text: 'Bukti pengemasan harus di upload...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
            }) ;
            return; 
        }

       $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-proses-delivery/<?= $delivery->DeliveryId ?>", 
            data:{ 
                "DeliveryDateProses":  $("#DeliveryDateProses").data('daterangepicker').startDate.format("YYYY-MM-DD"),   
                "DeliveryImageList": srcList,    
            },   
            success: function(data) {   
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        if($("#modal-add-proses-delivery").data("menu") =="Invoice"){
                            table.ajax.reload(); 
                        }else{ 
                            loader_data_project(<?= $delivery->ProjectId ?>,"pengiriman");   
                        }   
                        $("#modal-add-proses-delivery").modal("hide");   
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
    })
</script>