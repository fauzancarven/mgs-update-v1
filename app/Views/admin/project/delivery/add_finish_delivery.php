 
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
   

                //input Pengiiman
                inputpengiriman[i] = new Cleave(`#input-pengiriman-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:3,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputpengiriman[i].setRawValue(data_detail_item[i]["qty"]);
                $(`#input-pengiriman-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["qty"] = inputpengiriman[$(this).data("id")].getRawValue();
                    if($(`#input-pengiriman-${i}`).val() == "") $(`#input-pengiriman-${i}`).val(0) 
                });   
 
                //input Rusak
                inputrusak[i] = new Cleave(`#input-rusak-${i}`, {
                        numeral: true,
                        delimeter: ",",
                        numeralDecimalScale:3,
                        numeralThousandGroupStyle:"thousand"
                }); 
                inputrusak[i].setRawValue(data_detail_item[i]["qty_waste"]);
                $(`#input-rusak-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["qty_waste"] = inputrusak[$(this).data("id")].getRawValue();
                    if($(`#input-rusak-${i}`).val() == "") $(`#input-rusak-${i}`).val(0) 
                });  

                //input Spare
                inputspare[i] = new Cleave(`#input-spare-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:3,
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
 

    $("#btn-finish-delivery").click(function(){
        if(data_detail_item.map((obj) => obj.qty).reduce((a, b) => a + b, 0) == 0){
            Swal.fire({
                icon: 'error',
                text: 'Qty pengiriman belum lengkap ...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
            }) ;
            return; 
        }
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
            Image: $("#preview").attr('src'), 
        }
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/finish-data-delivery/<?= $delivery->DeliveryId?>", 
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