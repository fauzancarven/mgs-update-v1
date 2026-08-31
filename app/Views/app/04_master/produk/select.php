<div class="modal fade" id="modal-select-item" data-type="sell" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-select-item-label">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-select-item-label">Select Item</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">  
                <div class="mb-1">
                    <label for="item-name" class="col-form-label">Item Produk:</label>  
                    <div class="input-group input-group-sm">  
                        <select class="form-control form-control-sm input-form" id="select-produk" name="select-produk"  style="width:100%"></select> 
                    </div> 
                </div>
                <div class="mb-1 d-flex flex-wrap gap-4" id="select-varian"> 
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="item-vol" class="col-form-label">Jumlah:</label>
                            <input class="form-control form-control-sm input-form input-vol" style="width:100%" id="select-qty" value="1.00" disabled>
                        </div>
                        <div class="col-6">
                            <label for="item-satuan" class="col-form-label">Satuan:</label>
                            <select class="form-select form-select-sm" style="width:100%" id="select-satuan" disabled></select>
                        </div>
                    </div> 
                </div> 
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="select-harga" class="col-form-label">Harga:</label>
                            <input class="form-control form-control-sm input-form input-price" style="width:100%" id="select-harga" data-price="0" value="0" disabled>
                        </div>
                        <div class="col-6">
                            <label for="select-disc" class="col-form-label">Disc:</label>
                            <input class="form-control form-control-sm input-form input-price" style="width:100%" id="select-disc" data-disc="0" value="0" disabled>
                        </div>
                    </div> 
                </div>  
                <div class="mb-1">
                    <label for="select-total" class="col-form-label">Total:</label>
                    <input class="form-control form-control-sm input-form input-price" style="width:100%" id="select-total" value="0" disabled>
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-item">Simpan</button>
            </div>
        </div>
    </div>
</div>  

<script> 
    // 'ProdukDetailId' =>  $result->ProdukDetailId,
    // 'ProdukDetailBerat' => $result->ProdukDetailBerat,
    // 'ProdukDetailSatuanId' => $result->ProdukDetailSatuanId,
    // 'ProdukDetailSatuanText' => $result->ProdukSatuanCode,
    // 'ProdukDetailPcsM2' => $result->ProdukDetailPcsM2,
    // 'ProdukDetailHargaBeli' => $result->ProdukDetailHargaBeli,
    // 'ProdukDetailHargaJual' => $result->ProdukDetailHargaJual,
    // 'ProdukDetailVarian' =>  json_decode($result->ProdukDetailVarian),
    // 'ProdukDetailRef' =>  json_decode($result->ProdukDetailVarian),
    // var ProdukMaster = { 
    //     "id": "0",
    //     "produkid": "0",
    //     "berat": "0",
    //     "satuan_id": "0",
    //     "satuantext": "",
    //     "pcsM2": "", 
    //     "varian": [],
    //     "text" : "",
    //     "group" : "", 
    //     "total": 0,
    //     "disc": 0,
    //     "qty": 0,
    //     "price": 0,
    // }

    var selectharga = new Cleave('#select-harga', {
        numeral: true,
        delimeter: ",",
        numeralDecimalScale:0,
        numeralThousandGroupStyle:"thousand"
    });
    var selectdisc = new Cleave('#select-disc', {
        numeral: true,
        delimeter: ",",
        numeralDecimalScale:0,
        numeralThousandGroupStyle:"thousand"
    });
    var selecttotal = new Cleave('#select-total', {
        numeral: true,
        delimeter: ",",
        numeralDecimalScale:0,
        numeralThousandGroupStyle:"thousand"
    }); 
    var selectqty = new Cleave('#select-qty', {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:3,
            numeralThousandGroupStyle:"thousand"
    });
   
    var data_select_varian = [];
    var data_select_produk = [];
    $("#select-produk").select2({
        tags: true, 
        dropdownParent: $('#modal-select-item .modal-content'), 
        placeholder: "Pilih Produk",
        ajax: {
            url: "<?= base_url()?>select2/get-data-item",
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
        createTag: function(params) {
            return {
                id: params.term,
                text: params.term,
                html: params.term,
                newTag: true // menandai tag baru
            };
        },
        createTagText: function(params) {
            return "Tambah '" + params.term + "'";
        }, 
        templateResult: function(params) {
            if (params.newTag) {
                return "Tambah '" + params.text + "'";
            }
            if (params.loading) return params.text; 
            return params.html;
            //return params.text;
        },
        templateSelection: function(params) {
            return params.text;
        }, 
        escapeMarkup: function(m) { return m; }
    }).on("select2:select", function(e) { 
        var data = e.params.data; 
        data_select_varian = []
        if(!data["vendor"]){
            $("#select-varian").html(""); 
        }else{
            
            var vendor = JSON.parse(data["vendor"]);
            var html = `<div class="d-flex flex-column"> 
                            <label for="item-name" class="col-form-label">Vendor:</label>   
                            <div class="btn-group" role="group"> `;
            data_select_varian.push({
                "varian" : "vendor",
                "value" : (vendor[0]["text"].split(" - "))[0]
            });
            for(var i = 0; vendor.length > i;i++){
                html += `<input type="radio" class="btn-check" name="varian-vendor" id="btn-vendor-${vendor[i]["id"]}" autocomplete="off" ${ i == 0 ? "checked" : ""} value="${(vendor[i]["text"].split(" - "))[0]}">
                <label class="btn btn-outline-primary p-1 px-2" for="btn-vendor-${vendor[i]["id"]}">${(vendor[i]["text"].split(" - "))[0]}</label>`; 
            } 
            html += `</div></div>`; 

            var varian = JSON.parse(data["varian"]); //[{"varian":"Ukuran","value":[{"id":"4","text":"12 x 12 x 0.5 cm"},{"id":"4","text":"13 x 13 x 0.5 cm"}]}]
            for(var i = 0; varian.length > i;i++){
                html += `<div class="d-flex flex-column"> 
                            <label for="item-name" class="col-form-label">${varian[i]["varian"]}:</label>   
                            <div class="btn-group" role="group"> `;
                for(var j = 0; varian[i]["value"].length > j;j++){
                    html += `<input type="radio" class="btn-check" name="varian-${varian[i]["varian"]}" id="btn-${varian[i]["varian"]}-${varian[i]["value"][j]["id"]}" autocomplete="off" ${ j == 0 ? "checked" : ""} value="${varian[i]["value"][j]["text"]}">
                            <label class="btn btn-outline-primary p-1 px-2" for="btn-${varian[i]["varian"]}-${varian[i]["value"][j]["id"]}">${varian[i]["value"][j]["text"]}</label>`; 
                }  
                data_select_varian.push({
                    "varian" : varian[i]["varian"],
                    "value" : varian[i]["value"][0]["text"] 
                });
                html += `</div></div>`; 
            } 
            $("#select-varian").html(html); 

            for (var i = 0; i < data_select_varian.length; i++) {  
            let varian = data_select_varian[i].varian;
            let value = data_select_varian[i].value; 
            $('input[name="varian-' + varian + '"]').on('change', function() {
                if (this.checked) {    
                    var value = $(this).val();
                    data_select_varian.forEach(function(item) {
                        if (item.varian === varian) {
                            item.value = value;
                        }
                    });
                    get_detail_varian();
                }
            }); 
            }  
        }

        get_detail_varian(); 
    }).on("select2:tagging", function(e) {
        get_detail_varian(); 
    }); 

    async function get_detail_varian(){  
        if(data_select_varian.length > 0){ 
            await $.ajax({
                dataType: "json",
                method: "POST",
                url: "<?= base_url("action/get-data-item-unit/") ?>" + $("#select-produk").val(),
                data: {
                    "varian": data_select_varian
                }, 
                success: function(data) { 
                    console.log(data);  
                    $("#modal-select-item").data("type") == "buy" ?  selectharga.setRawValue(data["data"]["ProdukDetailHargaBeli"]) :  selectharga.setRawValue(data["data"]["ProdukDetailHargaJual"]);

                    data_select_produk = {
                        "id": data["data"]["ProdukDetailId"],
                        "produkid": data["data"]["ProdukDetailRef"],
                        "varian": data_select_varian,
                        "text" :  $("#select-produk").select2("data")[0]["text"],
                        "group" :  $("#select-produk").select2("data")[0]["category"], 
                        "berat": data["data"]["ProdukDetailBerat"],
                        "satuan_id": data["data"]["ProdukDetailSatuanId"],
                        "satuan_text": data["data"]["ProdukDetailSatuanText"],
                        "pcsM2": data["data"]["ProdukDetailPcsM2"],  
                        "price": selectharga.getRawValue(),
                        "disc": selectdisc.getRawValue(),
                        "qty":  selectqty.getRawValue(),
                        "total": selecttotal.getRawValue(),
                    }  

                    $("#select-harga").prop("disabled",false); 
                    $("#select-satuan").prop("disabled",false); 
                    $("#select-qty").prop("disabled",false); 
                    $("#select-disc").prop("disabled",false); 
                    $('#select-satuan').append(new Option(data["data"]["ProdukDetailSatuanText"] , data["data"]["ProdukDetailSatuanId"], true, true)).trigger('change');   
                }
            });
        }else{  
            data_select_produk = {
                "id": 0,
                "produkid": 0,
                "varian": data_select_varian,
                "text" : $("#select-produk").select2("data")[0]["text"],
                "group" : "", 
                "berat": 0,
                "satuan_id": 0,
                "satuan_text": "",
                "pcsM2": "",  
                "price": selectharga.getRawValue(),
                "disc": selectdisc.getRawValue(),
                "qty":  selectqty.getRawValue(),
                "total": selecttotal.getRawValue(),
            }  
            $("#select-harga").prop("disabled",false); 
            $("#select-qty").prop("disabled",false); 
            $("#select-satuan").prop("disabled",false); 
            $("#select-disc").prop("disabled",false); 
        } 

        function total_harga(){
            var total = (selectharga.getRawValue() - selectdisc.getRawValue() ) * selectqty.getRawValue();
            data_select_produk["total"] = total;
            selecttotal.setRawValue(total);
        }
        $("#select-qty").on("keyup",function(){ 
            data_select_produk["qty"] = selectqty.getRawValue();
            total_harga();
        });  
        $("#select-disc").on("keyup",function(){  
            var nilaiSaatIni = parseInt(selectdisc.getRawValue());
            var maksvalue = parseInt(selectharga.getRawValue());
            if (nilaiSaatIni > maksvalue) {
                console.log("data melebihi")
                selectdisc.setRawValue(maksvalue);
            } 
            data_select_produk["disc"] = selectdisc.getRawValue();
            total_harga();
        }); 
        $("#select-harga").on("keyup",function(){ 
            data_select_produk["price"] = selectharga.getRawValue();
            total_harga();
        }); 
        total_harga();
    }   
    $("#select-satuan").select2({
        dropdownParent: $('#modal-select-item .modal-content'), 
        placeholder: "Pilih Satuan",
        ajax: {
            url: "<?= base_url()?>select2/get-data-produk-satuan",
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
        language: {
            noResults: function () {
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"select_satuan_add()\">Tambah <b>" + $("#select-satuan").data('select2').dropdown.$search[0].value + "</b></button>");
            }
        },
        formatResult: select2OptionFormat,
        formatSelection: select2OptionFormat,
        escapeMarkup: function(m) { return m; }
    }).on("select2:select", function(e) {
        var data = e.params.data;  
        data_select_produk["satuan_id"] = data.id
        data_select_produk["satuan_text"]= data.text
    });
 
    select_satuan_add = function(){
        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url("action/add-data-item-unit") ?>",
            data: {
                "name": $("#select-satuan").data('select2').dropdown.$search[0].value 
            }, 
            success: function(data) { 
                var newOption = new Option($("#select-satuan").data('select2').dropdown.$search[0].value , data["data"]["id"], true, true);
                $('#select-satuan').append(newOption).trigger('change'); 
                $('#select-satuan').select2("close");
            }
        });
    }
    //

</script>