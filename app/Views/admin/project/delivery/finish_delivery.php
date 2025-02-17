 
<div class="modal fade" id="modal-finish-delivery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-edit-delivery-label" style="overflow-y:auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-delivery-label">Terima pengiriman dan upload bukti penerimaan barang</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2"> 
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Item Detail</span> 
                    </div>
                </div>     
                <div class="card " style="min-height:50px;">
                    <div class="card-body p-2 bg-light"> 
                        <div class="row align-items-center  d-none d-md-flex px-3">
                            <div class="col-12 col-md-5 my-1">    
                                <div class="row">  
                                    <div class="col-12"> 
                                        <span class="label-head-dialog">Deskripsi</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-7 my-1">
                                <div class="row"> 
                                    <div class="col-3"> 
                                        <span class="label-head-dialog"><i class="ti-settings"></i></span>   
                                    </div> 
                                    <div class="col-9">
                                        <div class="row"> 
                                            <div class="col-4">
                                                <span class="label-head-dialog">Diterima</span>  
                                            </div>
                                            <div class="col-4">
                                                <span class="label-head-dialog">Rusak</span>  
                                            </div>
                                            <div class="col-4">
                                                <span class="label-head-dialog">Spare</span>  
                                            </div>
                                        </div> 
                                    </div>  
                                </div>
                            </div> 
                        </div> 
                        <div id="tb_varian" class="text-center"> 
                        </div>  
                    </div>
                </div> 
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Document</span> 
                    </div>
                </div>      
                <div class="row mb-1 align-items-center mt-2 px-2">
                    <label for="armada" class="col-sm-2 col-form-label">Penerima</label>
                    <div class="col-sm-10">
                        <input class="form-control form-control-sm input-form" id="armada" value="<?= $delivery->DeliveryToName?>">
                    </div>
                </div> 
                <div class="row mb-1 align-items-center mt-2 px-2">
                    <label for="DeliveryDateProses" class="col-sm-2 col-form-label pe-0">Upload Bukti</label>
                    <div class="col-sm-10">
                         <button id="remove-image" class="btn btn-sm btn-danger btn-action m-1" onclick=""><i class="fa-solid fa-close pe-2"></i>Hapus</button>
                    </div>
                </div>   
                <div class="mb-1 mx-2">
                    <input class="form-control form-control-sm input-form d-none" type="file" accept="image/*" style="width:100%" id="bukti-payment">   
                    <div class="text-center" id="dropzone">
                        <div class="dz-message">Tarik dan lepas file gambar di sini atau klik untuk memilih</div>
                        <img id="preview"  style="
    object-fit: scale-down;
    width: 50%;
    height: 100%;
"  />
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
    var data_detail_item = JSON.parse('<?= JSON_ENCODE($detail,true) ?>');   
     
    delete_varian_click = function(index){ 
        data_detail_item.splice(index, 1);
        load_produk() 
    }
    up_varian_click = function(index){ 
        if (index > 0) { 
            var nilaiSementara = data_detail_item[index - 1];
            data_detail_item.splice(index - 1, 1, data_detail_item[index]);
            data_detail_item.splice(index, 1, nilaiSementara);
        }
        load_produk();
    }
    down_varian_click = function(index){  
        if (index < data_detail_item.length - 1) {
            var nilaiSementara = data_detail_item[index + 1];
            data_detail_item.splice(index + 1, 1, data_detail_item[index]);
            data_detail_item.splice(index, 1, nilaiSementara);
        }
        load_produk() 
    }
    load_produk = function(){
        var html = '';
        if(data_detail_item.length == 0){
            html += `<div class="d-flex justify-content-center flex-column align-items-center"> 
                            <img src="<?= base_url()?>assets/images/empty.png" alt="" style="width:150px;height:150px;">
                            <span class="text-head-1">Item belum ditambahkan</span>
                        </div>`;  
        }
        let last_group_abjad = 65;
        let last_group_no = 1;
        for(var i = 0; data_detail_item.length > i;i++){
            if(data_detail_item[i]["type"] == "category"){ 
                html += `
                    <div class="row align-items-center ${i > 0 ? "border-top mt-1 pt-1" : ""} mx-1">
                        <div class="col-12 col-md-4"> 
                            <div class="row align-items-center"> 
                                <div class="col-7 col-md-12 my-1 group text-start"> 
                                    <span class="text-head-3">${String.fromCharCode(last_group_abjad)}. ${data_detail_item[i]["text"]}</span>  
                                </div>   
                                <div class="col-5 d-md-none d-block col-0 px-0"> 
                                    <div class="btn-group d-inline-block float-end" role="group"> 
                                        <button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="col-8 my-1 d-md-block d-none">   
                            <div class="row px-2 align-items-center">
                                <div class="col-2 px-0"> 
                                    <div class="btn-group d-inline-block float-end" role="group"> 
                                        <button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    </div>`;
                last_group_abjad++;
                last_group_no = 1;
            }  
            if(data_detail_item[i]["type"] == "product"){ 
                var varian = "";
                if(data_detail_item[i]["id"] != "0"){
                    varian = `  <span class="text-detail-2 text-truncate">${data_detail_item[i]["group"]}</span> 
                                <div class="d-flex gap-1">`;
                    for(var j = 0; data_detail_item[i]["varian"].length > j;j++){
                        varian += `<span class="badge badge-${j % 5}">${data_detail_item[i]["varian"][j]["varian"] + ": " + data_detail_item[i]["varian"][j]["value"]}</span>`; 
                    }
                    varian +=  '</div>';
                }
                html += `   <div class="row align-items-center  ${i > 0 ? "border-top mt-1 pt-1" : ""} mx-1">
                                <div class="col-12 col-md-5 my-1 varian px-0">   
                                    <div class="d-flex">
                                        <span class="no-urut text-head-3">${last_group_no}.</span> 
                                        <div class="d-flex flex-column text-start flex-fill">
                                            <span class="text-head-3">${data_detail_item[i]["text"]}</span>
                                            ${varian} 
                                        </div>  
                                        <div class="btn-group d-inline-block d-md-none float-end" role="group">  
                                            ${data_detail_item[i]["id"] == "0" ? `<button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>` : ""}
                                            <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                            <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                            <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 my-1 detail">
                                    <div class="row px-2"> 
                                        <div class="col-3 px-0 d-none d-md-block ">  
                                            <div class="btn-group float-end d-inline-block" role="group">  
                                                ${data_detail_item[i]["id"] == "0" ? `<button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>` : ""}
                                                <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                            </div>
                                        </div>  
                                        <div class="col-12 col-md-9 px-1">   
                                            <div class="row">   
                                                <div class="col-4  px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Diterima</span>
                                                    <div class="input-group">  
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" id="input-pengiriman-${i}" data-id="${i}">
                                                        <span class="input-group-text font-std px-1">${data_detail_item[i]["satuan_text"]}</span> 
                                                    </div>   
                                                </div> 
                                                <div class="col-4 px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Rusak</span>
                                                    <div class="input-group"> 
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block" id="input-rusak-${i}" data-id="${i}">
                                                        <span class="input-group-text font-std px-1">${data_detail_item[i]["satuan_text"]}</span> 
                                                    </div>    
                                                </div> 
                                                <div class="col-4  px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Spare</span>
                                                    <div class="input-group"> 
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="input-spare-${i}" data-id="${i}">
                                                        <span class="input-group-text font-std px-1">${data_detail_item[i]["satuan_text"]}</span>
                                                    </div>     
                                                </div> 
                                            </div>   
                                        </div>   
                                    </div>    
                                </div>     
                            </div> `;

                
                last_group_no++; 
            }
        }
        $("#tb_varian").html(html); 
        var inputrusak = []; 
        var inputpengiriman = []; 
        var inputspare = [];
        for(var i = 0; data_detail_item.length > i;i++){
            if(data_detail_item[i]["type"] == "product"){
   

                //event harga
                inputpengiriman[i] = new Cleave(`#input-pengiriman-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:2,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputpengiriman[i].setRawValue(data_detail_item[i]["qty"]);
                $(`#input-pengiriman-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["qty"] = inputpengiriman[$(this).data("id")].getRawValue();
                    if($(`#input-pengiriman-${i}`).val() == "") $(`#input-pengiriman-${i}`).val(0) 
                });   
 
                //event qty
                inputrusak[i] = new Cleave(`#input-rusak-${i}`, {
                        numeral: true,
                        delimeter: ",",
                        numeralDecimalScale:2,
                        numeralThousandGroupStyle:"thousand"
                }); 
                inputrusak[i].setRawValue(data_detail_item[i]["qty_waste"]);
                $(`#input-rusak-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["qty_ref"] = inputrusak[$(this).data("id")].getRawValue();
                    if($(`#input-rusak-${i}`).val() == "") $(`#input-rusak-${i}`).val(0) 
                });  

                //event harga
                inputspare[i] = new Cleave(`#input-spare-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:2,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputspare[i].setRawValue(data_detail_item[i]["qty_spare"]);
                $(`#input-spare-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["qty_spare"] = inputspare[$(this).data("id")].getRawValue();
                    if($(`#input-spare-${i}`).val() == "") $(`#input-spare-${i}`).val(0) 
                });   
            }
        }
    }
    load_produk();

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

    $("#btn-finish-delivery"){
        if(data_detail_item.map((obj) => obj.pengiriman).reduce((a, b) => a + b, 0) == 0){
            Swal.fire({
                icon: 'error',
                text: 'Qty pengiriman belum lengkap ...!!!', 
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
                    DeliveryDetailText: data_detail_item[i]["text"],
                    DeliveryDetailType: data_detail_item[i]["type"], 
                    DeliveryDetailSatuanId: data_detail_item[i]["satuan_id"], 
                    DeliveryDetailSatuanText: data_detail_item[i]["satuan_text"],
                    DeliveryDetailGroup: data_detail_item[i]["group"], 
                    DeliveryDetailVarian: data_detail_item[i]["varian"], 
                    DeliveryDetailQty: data_detail_item[i]["qty"], 
                    DeliveryDetailQtySpare: data_detail_item[i]["qty_spare"],  
                }); 
            }
        }
 
    }

</script>