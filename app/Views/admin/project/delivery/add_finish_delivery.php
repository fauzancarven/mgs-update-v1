 
<div class="modal fade" id="modal-add-finish-delivery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-edit-delivery-label" style="overflow-y:auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-delivery-label">Terima pengiriman dan upload bukti penerimaan barang</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2"> 
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Document</span> 
                    </div>
                </div>     
                <div class="row mx-2"> 
                    <div class="col-6">
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="DeliveryDateFinish" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input id="DeliveryDateFinish" name="DeliveryDateFinish" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div>   
                    </div>   
                    <div class="col-6">  
                        <div class="row mb-1 align-items-center mt-2 px-2">
                            <label for="DeliveryReceiveName" class="col-sm-2 col-form-label">Penerima</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm input-form" id="DeliveryReceiveName" value="<?= $delivery->DeliveryToName?>">
                            </div>
                        </div> 
                    </div>   
                </div>     
                <div class="row mx-2 my-3 align-items-center">
                    <div id="table-list"></div>  
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
                <button type="button" class="btn btn-primary" id="btn-finish-delivery">Simpan</button>
            </div>
        </div>
    </div>
</div>  
<script>

    var table_delivery_item = new tableItemDelivery("table-list",{
        dataitem : JSON.parse('<?= JSON_ENCODE($detail,true) ?>'.replace(/\n/g, '\\n')),
        dropdownParent: $('#modal-add-finish-delievery .modal-content'),
        baseUrl : "<?= base_url() ?>",
        modal : $('#modal-add-finish-delievery')
    }); 
 
    if (table_delivery_item && typeof table_delivery_item.on === 'function') { 
        table_delivery_item.on("subtotal",function(data){  
        });
        table_delivery_item.getSubTotal()
    } else {
        console.error("table_delivery_item tidak terdefinisi atau method on() tidak ada");
    }

    $('#DeliveryDateFinish').daterangepicker({
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
 

    $("#btn-finish-delivery").click(function(){ 
        var data_detail_item = table_delivery_item.getDataRow(); 
        if(data_detail_item.map((obj) => obj.qty).reduce((a, b) => a + b, 0) == 0){
            Swal.fire({
                icon: 'error',
                text: 'Qty pengiriman tidak boleh qty 0 ...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
            }) ;
            return; 
        }

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

        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){  
            if(data_detail_item[i]["type"] == "product"){ 
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"],  
                    DeliveryDetailVarian: data_detail_item[i]["varian"], 
                    DeliveryDetailQtyReceive: data_detail_item[i]["qty"], 
                    DeliveryDetailQtyReceiveWaste: data_detail_item[i]["qty_waste"],  
                    DeliveryDetailQtyReceiveSpare: data_detail_item[i]["qty_spare"],  
                }); 
            }
        }
        var header = {  
            DeliveryDateFinish: $("#DeliveryDateFinish").data('daterangepicker').startDate.format("YYYY-MM-DD"),   
            DeliveryReceiveName: $("#DeliveryReceiveName").val(),  
            DeliveryImageListFinish: srcList, 
        }
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-finish-delivery/<?= $delivery->DeliveryId?>", 
            data:{
                "header":header,
                "detail":detail, 
            },
            success: function(data) {    
                //console.log(data); 
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