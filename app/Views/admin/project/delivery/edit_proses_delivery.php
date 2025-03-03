<div class="modal fade" id="modal-edit-proses-delivery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Data Konfirmasi dan upload foto pengemasan</h2>
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
                <div class="mb-1">
                    <input class="form-control form-control-sm input-form d-none" type="file" accept="image/*" style="width:100%" id="bukti-payment">   
                    <div class="text-center" id="dropzone">
                        <div class="dz-message">Tarik dan lepas file gambar di sini atau klik untuk memilih</div>
                        <img id="preview" src="<?= $image ?>" style="
    object-fit: scale-down;
    width: 100%;
    height: 100%;
"  />
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
    $('#dropzone').on('dragover', function(e) {
    e.preventDefault();
    $(this).addClass('dragover');
    });

    $('#dropzone').on('dragleave', function(e) {
    $(this).removeClass('dragover');
    });

    $('#dropzone').on('drop', function(e) {
    e.preventDefault();
    $(this).removeClass('dragover');
    file = e.originalEvent.dataTransfer.files[0];
    if (file.type.match('image.*')) {
        tampilkanPreview(file);
    } else {
        alert('Hanya file gambar yang diperbolehkan!');
    }
    });

    $('#dropzone').on('click', function() {
    $('#bukti-payment').trigger('click');
    });

    $('#bukti-payment').on('change', function() {
    file = this.files[0];
    if (file.type.match('image.*')) {
        tampilkanPreview(file);
    } else {
        alert('Hanya file gambar yang diperbolehkan!');
    }
    });

    $('#preview').hide();
    function tampilkanPreview(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#dropzone .dz-message").hide();
            $('#preview').attr('src', e.target.result);
            $('#preview').show();
        };
        reader.readAsDataURL(file);
    }
    $("#remove-image").click(function(){
        $('#preview').attr('src',"");
        $('#preview').hide();
        $("#dropzone .dz-message").show();
    });

    $("#dropzone .dz-message").hide();
    $('#preview').show();

    $("#btn-proses-delivery").click(function(){
       if($("#preview").attr('src') == "" ||$("#preview").attr('src') == undefined ){
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
            url: "<?= base_url() ?>action/edit-proses-delivery/<?= $delivery->DeliveryId ?>", 
            data:{ 
                "DeliveryDateProses":  $("#DeliveryDateProses").data('daterangepicker').startDate.format("YYYY-MM-DD"),   
                "image": $("#preview").attr('src'), 
            },   
            success: function(data) {   
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-edit-proses-delivery").modal("hide");  
                        $("idata-menu='pengiriman'][data-id='<?= $delivery->ProjectId ?>']").trigger("click");  
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