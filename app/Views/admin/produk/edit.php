
<div class="modal fade" id="modal-edit-produk" data-bs-focused="true" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modal-edit-produk-label"  >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-produk-label">Edit Produk</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">  
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right">
                        <span class="label-dialog">Gambar</span>
                    </div>
                </div> 
                <div class="row p-2"> 
                    <input type="file" class="d-none" accept="image/*" id="upload-produk"> 
                    <div class="col-sm-12 d-flex flex-wrap">
                        <div class="d-flex flex-wrap">
                            <div class="d-flex flex-wrap" id="list-produk"></div>
                            <div class="image-default-obi" id="img-produk">
                                <i class="ti-image" style="font-size:1rem"></i>
                                <span>Tambah Foto</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row mx-2  my-3 align-items-center">
                    <div class="label-border-right">
                        <span class="label-dialog">Deskripsi</span>
                    </div>
                </div> 
                <div class="row mb-1">
                    <div class="col-lg-6 col-12 my-1">
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="produk-kode" class="col-sm-3 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="produk-kode" name="produk-kode" type="text" class="form-control form-control-sm input-form" value="<?= $_produk->code ?>" disabled>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="produk-kategori" class="col-sm-3 col-form-label">Kategori<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" id="produk-kategori" name="produk-kategori" placeholder="Pilih Kategori" style="width:100%" disabled></select>  
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="produk-name" class="col-sm-3 col-form-label">Nama<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <input id="produk-name" name="produk-name" type="text" class="form-control form-control-sm input-form" value="<?= $_produk->name ?>">
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center">
                            <label for="produk-vendor" class="col-sm-3 col-form-label">Vendor<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" id="produk-vendor" name="produk-vendor" placeholder="Pilih Vendor" style="width:100%" multiple="multiple"></select>  
                            </div>
                        </div> 
                    </div> 
                    <div class="col-lg-6 col-12 my-1">
                        <div class="row mb-1 ">
                            <label for="produk-detail" class="col-sm-3 col-form-label">Detail Produk<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-9">
                                <textarea id="produk-detail" name="produk-detail" type="text" class="form-control form-control-sm input-form" rows="6" value="" placeholder="Roster dan Lubang Angin XYZ - Solusi Ventilasi Maksimal

- Meningkatkan kualitas udara dan pencahayaan
- Desain elegan dan minimalis
- Bahan berkualitas tinggi
- Mudah dipasang dan dirawat
- Menghemat energi dan biaya listrik

Roster dan lubang angin yang dirancang untuk meningkatkan ventilasi dan pencahayaan ruangan,Solusi ideal untuk mengatur suhu dan kelembaban udara di dalam ruangan,Meningkatkan kualitas udara dan kenyamanan hidup"><?= $_produk->detail ?></textarea>
                            </div>
                        </div> 
                    </div> 
                </div>  
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Varian</span>
                        <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" id="add-varian" type="button" style="position:absolute;top: -11px;right: -5px;font-size: 0.6rem;">
                            <i class="fas fa-plus"></i>
                            <span class="fw-bold">
                                &nbsp;Tambah Varian
                            </span>
                        </button> 
                    </div>
                </div>     
                <div class="card " style="min-height:50px;">
                    <div class="card-body p-2 bg-light">
                        <div id="tb_varian" class="text-center"></div> 
                    </div>
                </div>   
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">List Varian</span> 
                    </div>
                </div>   
                <div class="card " style="min-height:50px;">
                    <div class="card-body p-2 bg-light"> 
                        <div id="tb_list_varian" class="text-start text-md-center"></div>  
                    </div>
                </div>   
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-edit-produk">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="modal-edit"  data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">  
        <div class="modal-content" name="form-action">
            <div class="modal-header">
                <h6 class="modal-title"><i class="fas fa-crop-alt"></i> &nbsp;Edit Gambar</h5>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="crop-image" style="height:500px;"></div>
                <div class="action" style="position: absolute; bottom: 15px; margin-left: 50%; transform: translateX(-50%); background: #d1d1d1; padding: 0.5rem; border-radius: 0.5rem;  z-index: 2;">
                    <a class="p-2" onclick="rotate_image(90)"><i class="fas fa-undo-alt"></i></a>
                    <a class="p-2" onclick="rotate_image(-90)"><i class="fas fa-redo-alt"></i></a>
                    <a class="p-2" onclick="flip_image(2)"><i class="fas fa-exchange-alt"></i></a>
                    <a class="p-2" onclick="flip_image(4)"><i class="fas fa-exchange-alt fa-rotate-90"></i></a>
                </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submit-crop" >Simpan</button>
            </div>
        </div>
    </div>
</div>
<div id="message-vendor"></div>
<!-- SCRIPT ITEM -->
<script>  

    /** BAGIAN IMAGE UPLOAD */
    var image_list = JSON.parse(`<?= json_encode($_produkimage) ?>`);
    for(var i=0; image_list.length > i; i++){
        $("#list-produk").append(`<div class="image-default-obi border">
                <img src="${image_list[i]}" draggable="true"> 
                <div class="action">
                    <a class="btn btn-sm btn-white p-1" onclick="crop_image(this)"><i class="fas fa-crop-alt"></i></a>
                    <a class="btn btn-sm btn-white p-1" onclick="delete_image(this)"><i class="fas fa-trash"></i></a>
                </div>
                <span class="badge text-bg-primary">Utama</span>
        </div>`);
    }
    function render_image(){
        var draggedImage = null;

        // Event dragstart untuk menangkap elemen gambar yang sedang di-drag
        $('.image-default-obi.border img').on('dragstart', function (event) {
            draggedImage = $(this); // Simpan elemen gambar sebagai referensi
        });

        // Event dragover untuk mencegah default behavior
        $('.image-default-obi.border').on('dragover', function (event) {
            event.preventDefault(); // Harus ada untuk memungkinkan drop
            $(this).addClass('dragover'); // Tambahkan efek visual
        });

        // Event dragleave untuk menghapus efek visual ketika keluar dari dropzone
        $('.image-default-obi.border').on('dragleave', function () {
            $(this).removeClass('dragover');
        });

        // Event drop untuk memindahkan gambar
        $('.image-default-obi.border').on('drop', function (event) {
            event.preventDefault(); // Cegah perilaku default
            $(this).removeClass('dragover'); // Hapus efek visual

            // Ambil gambar yang sudah ada di dropzone target
            const existingImage = $(this).find('img');

            // Jika ada gambar yang sedang di-drag
            if (draggedImage) {
                // Pindahkan gambar yang sudah ada ke tempat asal gambar yang sedang di-drag
                const sourceDropzone = draggedImage.closest('.image-default-obi.border');
                sourceDropzone.prepend(existingImage);

                // Pindahkan gambar yang di-drag ke dropzone target
                $(this).prepend(draggedImage);
            }
        });
    }
    $("#img-produk").on('click',function(){
        $("#upload-produk").trigger("click");
    })  
    $("#upload-produk").on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                $("#list-produk").append(`<div class="image-default-obi border">
                                <img src="${reader.result}" draggable="true"> 
                                <div class="action">
                                    <a class="btn btn-sm btn-white p-1" onclick="crop_image(this)"><i class="fas fa-crop-alt"></i></a>
                                    <a class="btn btn-sm btn-white p-1" onclick="delete_image(this)"><i class="fas fa-trash"></i></a>
                                </div>
                                <span class="badge text-bg-primary">Utama</span>
                        </div>`);
                render_image()
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
    render_image();
   
    /** BAGIAN DESKRIPSI */
    $("#produk-kategori").select2({
        dropdownParent: $('#modal-edit-produk .modal-content'), 
        placeholder: "Pilih kategori produk",
        ajax: {
            url: "<?= base_url()?>select2/get-data-produk-kategori",
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
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"item_produk_category_add()\">Tambah <b>" + $("#produk-kategori").data('select2').dropdown.$search[0].value + "</b></button>");
            }
        },
        formatResult: select2OptionFormat,
        formatSelection: select2OptionFormat,
        escapeMarkup: function(m) { return m; }
    });
    item_produk_category_add = function(){
        var values = $("#produk-kategori").data('select2').dropdown.$search[0].value;
        $.ajax({
            dataType: "json",
            method: "POST",
            url: "<?= base_url("action/add-data-produk-category") ?>",
            data: {
                "name": values
            }, 
            success: function(data) {  
                $('#produk-kategori').append(new Option(values , data["data"]["id"], true, true)).trigger('change'); 
                $('#produk-kategori').select2("close"); 
            }
        });
    }
    $('#produk-kategori').append(new Option("<?=$_produk->cat_name?>" , "<?=$_produk->cat_id?>", true, true)).trigger('change');  

    var data_vendor = JSON.parse(`<?=$_produk->vendor?>`);
    var data_vendor_list = [];
    for (var i = 0; i < data_vendor.length; i++) {  

        var hasil = data_vendor[i].text.split("-", 2);  
        hasil = hasil.map((item) => item.trim());  

        var data = {
            "id" : data_vendor[i].id,
            "code" : hasil[0], 
            "name"  :  hasil[1], 
            "text" : data_vendor[i].text,  
            "selected" : true,  
        };
        data_vendor_list.push(data);
    } 
    $("#produk-vendor").select2({
        placeholder: "Pilih data vendor",
        dropdownParent: $("#modal-edit-produk .modal-content"),
        data: data_vendor_list,
        ajax: {
            url: "<?= site_url("select2/get-data-produk-vendor") ?>",  
            dataType: 'json',
            type:"POST",
            delay: 250, 
            data: function (params) {
                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash 
                return {
                    searchTerm: params.term, // search term
                    [csrfName]: csrfHash, // CSRF Token 
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
                //return "Tidak ada hasil.";
                return $("<button id='test-click' class=\"btn btn-sm btn-primary\" onclick=\"item_produk_vendor_add()\">Tambah Vendor</button>");
            }
        },
        formatResult: select2OptionFormat,
        formatSelection: select2OptionFormat,
        escapeMarkup: function(m) { return m; } 
    }).on("select2:select", function(e) { 
        load_data_list_varian();
    }).on("select2:unselect", function(e) { 
        load_data_list_varian();
    });
    item_produk_vendor_add = function(){
        $("#produk-vendor").select2("close")
        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/add-vendor", 
            success: function(data) {  
                $("#modal-edit-produk").modal("hide");
                $("#message-vendor").html(data);
                $("#modal-add-vendor").modal("show"); 

                $("#modal-add-vendor").on("hidden.bs.modal",function(){
                    $("#modal-edit-produk").modal("show");
                })    
            },
            error: function(xhr, textStatus, errorThrown){
                isProcessingAdd = false;
                $(el).html(old_text);
                
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    

   

    /* BAGIAN VARIAN */
    var activeSelect2Varian = null; 
    var activeSelect2VarianValue = null; 
    var data_varian = [];
    var data_varian_edit = JSON.parse(`<?=$_produk->varian?>`);
    for (var i = 0; i < data_varian_edit.length; i++) {  
        data_varian_edit[i]["html"] = `
                <div class="d-flex row row-table get-item my-2">
                    <div class="col-8 col-md-3 mb-2 order-0">
                        <select class="custom-select custom-select-sm form-select form-select-sm selectvarian" placeholder="pilih varian" style="width:100%" disabled>
                            <option selected>${data_varian_edit[i].varian}</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-7 text-start mb-2 order-lg-2 order-1">
                        <select class="custom-select custom-select-sm form-control form-control-sm selectvarianvalue" style="width:100%" multiple="multiple" required data-type="${data_varian_edit[i].varian}"></select>
                    </div>
                    <div class="col-4 col-md-2 px-0 align-self-start ms-auto action-table-single-optional mb-2 order-sm-last">
                        <button class="btn btn-sm btn-danger btn-action m-1" onclick="hapus_varian('${data_varian_edit[i].varian}',true)">
                            <i class="fa-solid fa-close pe-2"></i>Hapus
                        </button> 
                    </div>
                </div>`;
    }
    data_varian = data_varian_edit;
    $("#add-varian").click(function() {
        try{ 
            var htmlItem = `<div class="row row-table get-item">
                                <div class="col-8 col-lg-3" >
                                    <select class="custom-select custom-select-sm form-select form-select-sm selectvarian" placeholder="pilih varian"></select>
                                </div>
                                <div class="col-auto px-0 action-table-single-optional">
                                    <button class="btn btn-sm btn-danger btn-action m-1" onclick="hapus_varian('-',true)">
                                        <i class="fa-solid fa-close pe-2"></i>Hapus
                                    </button
                                </div>
                            </div>`;
            var arr = [];
            arr["html"] = htmlItem;
            arr["varian"] = "-";
            arr["value"] = []; 
            data_varian.push(arr);
            $("#add-varian").prop("disabled", true); 
            load_data_varian();
        }catch(err){
            console.log(err);
        }
    }); 
    hapus_varian = async function(varian, newitem) {
        var load_data = false;
        for (var i = 0; data_varian.length > i; i++) {
            if (data_varian[i]["varian"] == varian  ) {
                var index = i;
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary mx-1',
                        cancelButton: 'btn btn-secondary mx-1'
                    },
                    buttonsStyling: false
                });
                var data = await swalWithBootstrapButtons.fire({
                    title: "Hapus Varian!",
                    html: "apakah anda yakin ingin menghapus varian ini!",
                    icon: "warning",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showCancelButton: true,
                    confirmButtonText: "Lanjutkan",
                    cancelButtonText: "Tidak",
                    reverseButtons: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        data_varian.splice(index, 1);  
                        load_data_varian();
                        
                        load_data_list_varian();
                        if (newitem) {
                            $("#add-varian").prop("disabled", false);
                            return true;
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            return false;
                        }
                    }
                });
                return data;
            }
        }
        load_data_list_varian();
    }
    item_produk_varian_add = async function(){ 
        if (!activeSelect2Varian) return; 
        $("#modal-edit-produk").modal("hide");
        Swal.fire({
            title: 'Tambah Varian Baru',
            input: 'text',
            buttonsStyling: false,
            showCancelButton: true,
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary mx-1',
                cancelButton: 'btn btn-secondary mx-1',
                loader: 'custom-loader',
                input: 'form-control form-control-sm w-auto', // Tambahkan kelas pada input
            },
            backdrop: true,
            confirmButtonText: "Simpan",
            loaderHtml: '<div class="spinner-border text-primary"></div>',
            preConfirm: async (name) => {
                try { 
                    return $.ajax({
                        dataType: "json",
                        method: "POST",
                        url: "<?= base_url("action/add-data-produk-varian") ?>",
                        data: {
                            "name": name
                        }, 
                        success: function(data) {  
                            return data; // Data respons 
                        },
                        error: function(xhr, textStatus, errorThrown){ 
                            Swal.showValidationMessage(`Request failed: ${xhr["responseJSON"]['message']}`); 
                        }
                    });
                } catch (error) {
                    Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {  
                Swal.fire(
                    'Berhasil!',
                    'Simpan Data Berhasil!',
                    'success'
                );  
            }
            
            $("#modal-edit-produk").modal("show");
        }); 
    }
    item_produk_varian_value_add = async function(){
        if (!activeSelect2VarianValue) return;
        
        $("#modal-edit-produk").modal("hide");
        Swal.fire({
            title: 'Tambah Varian ' + $(activeSelect2VarianValue).data("type") + ' Baru',
            input: 'text',
            buttonsStyling: false,
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary mx-1',
                cancelButton: 'btn btn-secondary mx-1',
                loader: 'custom-loader',
                input: 'form-control form-control-sm w-auto', // Tambahkan kelas pada input
            },
            backdrop: true,
            confirmButtonText: "Simpan",
            loaderHtml: '<div class="spinner-border text-primary"></div>',
            preConfirm: async (name) => {
                try { 
                    return $.ajax({
                        dataType: "json",
                        method: "POST",
                        url: "<?= base_url("action/add-data-produk-varian-value") ?>",
                        data: {
                            "varian": $(activeSelect2VarianValue).data("type"),
                            "name": name
                        }, 
                        success: function(data) {  
                            return data; // Data respons 
                        },
                        error: function(xhr, textStatus, errorThrown){ 
                            Swal.showValidationMessage(`Request failed: ${xhr["responseJSON"]['message']}`); 
                        }
                    });
                } catch (error) {
                    Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {  
                Swal.fire(
                    'Berhasil!',
                    'Simpan Data Berhasil!',
                    'success'
                );  
            }
            
            $("#modal-edit-produk").modal("show");
        });
    }
    load_data_varian = function(){
        $("#tb_varian").html("");
        var select = [];
        var html = "";
        for(var i = 0 ; i < data_varian.length;i++){ 
            $("#tb_varian").append(data_varian[i]["html"]); 

            if(data_varian[i]["varian"]!="-") select.push(data_varian[i]["varian"]);
             
            var datavalue = data_varian[i]["value"]; 
            var dataindex = i;
            for(var j = 0; j < datavalue.length;j++){ 
                var option = new Option(datavalue[j]["text"],datavalue[j]["id"],true,true); 
                $('.selectvarianvalue[data-type="'+data_varian[dataindex]["varian"] +'"]').append(option).trigger('change');
            }  
            
        } 

        $(".selectvarian").select2({
            placeholder: "Pilih Varian",
            dropdownParent: $("#modal-edit-produk .modal-content"),
            ajax: {
                url: "<?= site_url("select2/get-data-produk-varian") ?>",  
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
                    //return "Tidak ada hasil.";
                    return $("<button id='test-click' class=\"btn btn-sm btn-primary\" onclick=\"item_produk_varian_add()\">Tambah Varian</button>");
                }
            },
            formatResult: select2OptionFormat,
            formatSelection: select2OptionFormat,
            escapeMarkup: function(m) { return m; }
        }).on("select2:selecting", function(e) {  
            var data = e.params.args.data;  
            for(var i = 0 ; i < data_varian.length;i++){ 
                if(data.text == data_varian[i]["varian"]) {
                    e.preventDefault(); 
                    break;
                }
            }

            if(data.id == 0) e.preventDefault(); 
        }).on("select2:select", function(e) {
            var data = e.params.data; 
            var htmlItem = `<div class="d-flex row row-table get-item my-2">
                    <div class="col-8 col-md-3 mb-2 order-0">
                        <select class="custom-select custom-select-sm form-select form-select-sm selectvarian" placeholder="pilih varian" style="width:100%" disabled>
                            <option value="${data.id}" select>${data.text}</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-7 text-start mb-2 order-lg-2 order-1">
                        <select class="custom-select custom-select-sm form-control form-control-sm selectvarianvalue" style="width:100%" multiple="multiple" required data-type="${data.text}"></select>
                    </div>
                    <div class="col-4 col-md-2 px-0 align-self-start ms-auto action-table-single-optional mb-2 order-sm-last">
                        <button class="btn btn-sm btn-danger btn-action m-1" onclick="hapus_varian('${data.text}',true)">
                            <i class="fa-solid fa-close pe-2"></i>Hapus
                        </button> 
                    </div>
                </div>`;
            var arr = [];
            arr["html"] = htmlItem;
            arr["varian"] = data.text;
            arr["value"] = [];
            data_varian[dataindex] = arr; 
            $("#add-varian").prop("disabled", false); 
            load_data_varian(); 
        }).on("select2:open",function(e){
            activeSelect2Varian = $(this);
        });

        

        if(data_varian.length == 0){
            $("#tb_varian").html('<div class="d-flex flex-column justify-content-center align-items-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:100px;height:100px;"><h6 class="text-secondary">Tidak ada data varian</span></h6>');
        }
        $(".selectvarianvalue").select2({
            placeholder: "Pilih data varian",
            dropdownParent: $("#modal-edit-produk .modal-content"),
            ajax: {
                url: "<?= site_url("select2/get-data-produk-varian-value") ?>",  
                dataType: 'json',
                type:"POST",
                delay: 250, 
                data: function (params) {
                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash 
                    return {
                        searchTerm: params.term, // search term
                        [csrfName]: csrfHash, // CSRF Token
                        type: $(this).data("type")
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
                    //return "Tidak ada hasil.";
                    return $("<button id='test-click' class=\"btn btn-sm btn-primary\" onclick=\"item_produk_varian_value_add()\">Tambah Varian</button>");
                }
            },
            formatResult: select2OptionFormat,
            formatSelection: select2OptionFormat,
            escapeMarkup: function(m) { return m; }
        }).on("select2:open",function(e){
            activeSelect2VarianValue = $(this);
        }).on("select2:selecting", function(e) {  
            var data = e.params.args.data; 
            if(data.id == 0) e.preventDefault(); 
        }).on("select2:select", function(e) {    
            var data = e.params.data;  
            for (var j = 0; data_varian.length > j; j++) {
                if (data_varian[j]["varian"] == $(this).data("type") ) {
                    data_varian[j]["value"].push(data);
                    break;
                }
            }  
            load_data_list_varian();
        }).on("select2:unselect", function(e) {   
            var data = e.params.data; 
            for (var j = 0; data_varian.length > j; j++) {
                if (data_varian[j]["varian"] == $(this).data("type") ) {
                    var datavalue = data_varian[j]["value"];
                    for (var k = 0; datavalue.length > k; k++) {
                        if (datavalue[k]["id"] == data.id ) {
                            data_varian[j]["value"].splice(k, 1);   
                        }
                    }  
                }
            }   
            load_data_list_varian();
        });
        load_data_list_varian();
    } 
 
    /* BAGIAN LIST VARIAN */ 
    var arr_varian = []; 
    var arr_varian_list = []; 
    var arr_varian_detail = JSON.parse(`<?= json_encode($_produkdetail,true)?>`);
    var arr_varian_detail_old = []; 
    load_data_list_varian = function(){
        arr_varian = [];
        let checkedData = true;
        
        function replaceOrInsertValue(kunci, nilai) {
            let index = arr_varian.findIndex(obj => obj.key === kunci);
            
            if (index !== -1) {
                let nilaiIndex = arr_varian[index].values.indexOf(nilai);
                
                if (nilaiIndex !== -1) {
                // Nilai sudah ada, ganti nilai
                arr_varian[index].values[nilaiIndex] = nilai;
                } else {
                // Nilai belum ada, tambahkan
                arr_varian[index].values.push(nilai);
                }
            } else {
                // Kunci belum ada, tambahkan
                arr_varian.push({ key: kunci, values: [nilai] });
            }
        } 
        function get_arr_val_old(varian_baru, value) { 
            const varian_lama = arr_varian_detail_old.find((item) =>
                Object.keys(varian_baru).every((k) => item.varian[k] === varian_baru[k])
            );

            if (!varian_lama) {
                // Cari varian lama dengan kunci yang ada di varian baru
                const varian_lama_filtered = arr_varian_detail_old.find((item) =>
                    Object.keys(varian_baru).filter((k) => item.varian[k] !== undefined).every((k) => item.varian[k] === varian_baru[k])
                );

                return varian_lama_filtered ? varian_lama_filtered[value] : "";
            }

            return varian_lama ? varian_lama[value] : "";
        } 

        //default add vendor
        if($("#produk-vendor").select2("data").length == 0) checkedData = false;
        for(var i = 0; i < $("#produk-vendor").select2("data").length;i++){    
            replaceOrInsertValue("vendor", $("#produk-vendor").select2("data")[i]["code"]); 
        }  
        for(var j = 0; j < data_varian.length;j++){  
            if(data_varian[j]["value"].length == 0) checkedData = false;
            for(var k = 0; k < data_varian[j]["value"].length;k++){
                replaceOrInsertValue(data_varian[j]["varian"], data_varian[j]["value"][k]["text"]); 
            }  
        }    

        arr_varian_list = []; 
        if(arr_varian.length == 0){
        } else if(arr_varian.length == 1){
            arr_varian_list = arr_varian[0].values.map(val => ({ [arr_varian[0].key]: val }));
        }else{
            arr_varian.reduce((acc, curr) => {
            if (acc.length === 0) {
                return curr.values.map(val => ({ [curr.key.toLowerCase()]: val }));
            }

            return acc.flatMap(obj =>
                curr.values.map(val => ({ ...obj, [curr.key.toLowerCase()]: val }))
            );
            }, []).forEach(obj => arr_varian_list.push(obj));
        }
        arr_varian_detail_old = arr_varian_detail; 
        arr_varian_detail = [];
        for(var i = 0; i < arr_varian_list.length;i++){    
            arr_varian_detail.push({ 
                "varian": arr_varian_list[i],
                "pcsM2":  (get_arr_val_old(arr_varian_list[i],"pcsM2") == "" ? "-" : get_arr_val_old(arr_varian_list[i],"pcsM2")),
                "berat": (get_arr_val_old(arr_varian_list[i],"berat") == "" ? "0" : get_arr_val_old(arr_varian_list[i],"berat")),
                "satuan_id": (get_arr_val_old(arr_varian_list[i],"satuan_id") == "" ? "1" : get_arr_val_old(arr_varian_list[i],"satuan_id")),
                "satuantext": (get_arr_val_old(arr_varian_list[i],"satuantext") == "" ? "Pcs" : get_arr_val_old(arr_varian_list[i],"satuantext")),
                "hargajual": (get_arr_val_old(arr_varian_list[i],"hargajual") == "" ? "0" : get_arr_val_old(arr_varian_list[i],"hargajual")),
                "hargabeli": (get_arr_val_old(arr_varian_list[i],"hargabeli") == "" ? "0" : get_arr_val_old(arr_varian_list[i],"hargabeli")),
            })
        }     


        var headerVarian = ``; 
        var detailhtml = ``;
        for(var i = 0; i < arr_varian_detail.length;i++){ 
            headerVarian ="";
            detailhtml += `<div class="row m-2 border-bottom varian-item" data-id="${i}">
                                <div class="col-10 col-md-4 my-2"> 
                                    <div class="row">`; 
            $.each(arr_varian_detail[i]["varian"], function(key, value) {   
                    headerVarian += `<div class="col"><span class="label-head-dialog text-capitalize">${key}</span></div>`;  
                    detailhtml +=  `<div class="col-12 col-md"> 
                                        <span class="label-head-dialog ">
                                            <span class="d-inline-block d-md-none text-capitalize" style="width:70px">${key}</span>
                                            <span class="d-inline-block d-md-none">:</span>
                                            ${value}
                                        </span>  
                                    </div>`; 
            });   
            detailhtml += `     </div> 
                            </div>
                            <div class="col-1 col-md-0 my-2 d-inline-block d-md-none"> 
                                <button class="btn btn-sm btn-primary btn-detail"><i class="fa-solid fa-chevron-up"></i></button>
                            </div>
                            <div class="col-12 col-md-8 my-2 detail">
                                <div class="row"> 
                                    <div class="col-6 col-md-2 px-1"> 
                                        <div class="mb-3">
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Berat</span>
                                            <div class="input-group mb-3"> 
                                                <input type="text" class="form-control form-control-sm input-form berat" value="${arr_varian_detail[i]["berat"]}" data-id="${i}">
                                                <span class="input-group-text font-std">(g)</span>
                                            </div> 
                                        </div>
                                    </div> 
                                    <div class="col-6 col-md-2 px-1">  
                                        <div class="mb-3">
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Satuan</span>
                                            <div class="input-group"> 
                                                <select class="form-select form-select-sm satuan_id" data-id="${i}" style="width:100%"></select>   
                                            </div>     
                                        </div>  
                                    </div> 
                                    <div class="col-12 col-md-2 px-1"> 
                                        <div class="mb-3">
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Isi M/<sup>2</sup></span>
                                            <div class="input-group"> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block pcsM2" data-id="${i}" value="${arr_varian_detail[i]["pcsM2"]}">
                                            </div>   
                                        </div>  
                                    </div> 
                                    <div class="col-6 col-md-3 px-1"> 
                                        <div class="mb-3">
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga Beli</span>
                                            <div class="input-group">  
                                                <span class="input-group-text font-std">Rp.</span> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" data-id="${i}" value="${arr_varian_detail[i]["hargabeli"]}">
                                            </div>   
                                        </div>  
                                    </div> 
                                    <div class="col-6 col-md-3 px-1"> 
                                        <div class="mb-3">
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga Jual</span>
                                            <div class="input-group"> 
                                                <span class="input-group-text font-std">Rp.</span>
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" data-id="${i}" value="${arr_varian_detail[i]["hargajual"]}">
                                            </div>   
                                        </div>      
                                    </div> 
                                </div>    
                            </div>  
                        </div>`;
        }   
        var headerhtml = ` 
                        <div class="form-inline p-2 w-100">
                            <div class="input-group input-group-sm w-100 ">
                                <input type="text" class="form-control rounded-left small bg-light " placeholder="Cari Data ..." aria-label="Search" aria-describedby="basic-addon2"   id="input-search-data-varian">
                                <div class="input-group-append">
                                    <button class="btn bg-light btn-light border-right border-top border-bottom rounded-right px-3" id="btn-search-data">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-2 border-bottom">
                            <div class="col-12 col-md-4 mb-2 d-none d-md-block"> 
                                <div class="row"> 
                                    ${headerVarian} 
                                </div>
                            </div>
                            <div class="col-12 col-md-8 mb-2 d-none d-md-block">
                                <div class="row"> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog">Berat</span>   
                                    </div> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog">Satuan</span>   
                                    </div> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog">Isi /M<sup>2</sup></span>   
                                    </div> 
                                    <div class="col-3"> 
                                        <span class="label-head-dialog">Harga Beli</span>   
                                    </div> 
                                    <div class="col-3"> 
                                        <span class="label-head-dialog">Harga Jual</span>   
                                    </div> 
                                </div>
                            </div> 
                        </div> `; 
        if(checkedData === false){ 
           $('#tb_list_varian').html(`<div class="d-flex flex-column justify-content-center align-items-center"><i class="fa-solid fa-ban fa-4x text-secondary py-2"></i><h6 class="text-secondary">Lengkapi data vendor dan varian terlebih dahulu</span></h6>`);
        }else{ 
            var htm_not_found = `<div class="d-flex flex-column justify-content-center align-items-center"><h6 class="text-secondary alert-not-found" style="display: none;">Data varian tidak ada yang cocok</span></h6>`;
            $('#tb_list_varian').html(`${headerhtml}${detailhtml}${htm_not_found}`); 

            $(".varian-item").each(function(index, element) { 
                // Harga Jual  
                var elHargajual = $(element).find(".hargajual");
                var clHargaJual = new Cleave($(elHargajual),{
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:0,
                    numeralThousandGroupStyle:"thousand"
                });
                $(elHargajual).change(function(){  
                    arr_varian_detail[$(elHargajual).data("id")]["hargajual"] = clHargaJual.getRawValue(); 
                }); 

                //  Harga Beli 
                var elHargabeli = $(element).find(".hargabeli");
                var clHargabeli = new Cleave($(elHargabeli),{
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:0,
                    numeralThousandGroupStyle:"thousand"
                });
                $(elHargabeli).change(function(){  
                    arr_varian_detail[$(elHargabeli).data("id")]["hargabeli"] = clHargabeli.getRawValue(); 
                });

                //  berat 
                var elBerat= $(element).find(".berat");
                var clBerat = new Cleave($(elBerat),{
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:0,
                    numeralThousandGroupStyle:"thousand"
                });
                $(elBerat).change(function(){  
                    arr_varian_detail[$(elBerat).data("id")]["berat"] = clBerat.getRawValue(); 
                });

                //  pcsM2 
                var elpcsM2= $(element).find(".pcsM2"); 
                $(elpcsM2).change(function(){  
                    arr_varian_detail[$(elpcsM2).data("id")]["pcsM2"] = $(this).val(); 
                });

                //  Satuan 
                var elsatuan = $(element).find(".satuan_id");  
                elsatuan.select2({
                    placeholder: "Pilih", 
                    dropdownParent: $("#modal-edit-produk .modal-content"),  
                    ajax: {
                        url: "<?= base_url("select2/get-data-produk-satuan") ?>",  
                        dataType: 'json',
                        type:"POST",
                        delay: 250, 
                        data: function (params) {
                            // CSRF Hash
                            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                            var csrfHash = $('.txt_csrfname').val(); // CSRF hash 
                            return {
                                searchTerm: params.term, // search term
                                [csrfName]: csrfHash, // CSRF Token 
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
                                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"item_produk_add()\">Tambah <b>" + $("#item-name").data('select2').dropdown.$search[0].value + "</b></button>");
                        }
                    },
                    formatResult: select2OptionFormat,
                    formatSelection: select2OptionFormat,
                    escapeMarkup: function(m) { return m; }
                })
                .on("select2:select", function(e) {    
                    var data = e.params.data;  
                    arr_varian_detail[$(elsatuan).data("id")]["satuan_id"] = data.id; 
                    arr_varian_detail[$(elsatuan).data("id")]["satuantext"] = data.text; 
                });   
                var newOption = new Option(arr_varian_detail[$(elsatuan).data("id")]["satuantext"],arr_varian_detail[$(elsatuan).data("id")]["satuan_id"], true, true);
                $(elsatuan).append(newOption).trigger('change'); 
                $(elsatuan).select2("close");
 
            });    

            $("#input-search-data-varian").keyup(function(){ 
                let not_found = 0;
                for(var i = 0; i < arr_varian_detail.length;i++){ 
                    let hide = true;
                    $.each(arr_varian_detail[i]["varian"], function(key, value) { 
                        if(value.toLowerCase().includes($("#input-search-data-varian").val().toLowerCase()) == true) hide = false; 
                    });   
                    if(hide == true){
                        $('.varian-item[data-id="'+ i + '"]').hide()
                    }else{
                        not_found++;
                        $('.varian-item[data-id="'+ i + '"]').show()
                    }
                }   
                if(not_found === 0){
                    $('.alert-not-found').show()
                }else{
                    $('.alert-not-found').hide()
                }
            });
            $(".btn-detail").click(function(){
                var detail = $(this).parent().parent().find(".detail");
                if($(detail).hasClass("hide")){
                    $(detail).removeClass("hide");
                    $(this).find("i").removeClass("fa-rotate-180");
                }else{ 
                    $(detail).addClass("hide");
                    $(this).find("i").addClass("fa-rotate-180");
                }
            });
        } 
    }

    load_data_varian();

    $("#btn-edit-produk").click(async function(){  
     
        if($("#produk-kategori").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'kategori harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#produk-kategori").select2("open"), 300); 
            }) ;
            return; 
        }
        if($("#produk-name").val()==""){
            Swal.fire({
                icon: 'error',
                text: 'Nama harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#produk-name").focus(), 300); 
            }) ;
            return; 
        } 
        if($("#produk-vendor").val() == 0){
            Swal.fire({
                icon: 'error',
                text: 'vendor harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#produk-vendor").select2("open"), 300); 
            }) ;
            return; 
        }

        var image_list = $("#list-produk img").map(function(){ return $(this).attr("src")}).get();
        if(image_list.length == 0){
            const result = await Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin tidak ingin memasukan gambar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Teruskan',
                cancelButtonText: 'Tidak',
            });
            if (!result.isConfirmed) {  
                return; 
            }
        }
        if(arr_varian_detail.length == 0){
            Swal.fire({
                icon: 'error',
                text: 'lengkapi list varian terlebih dahulu...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
            }) ;
            return; 
        } 
        
        var arr_var = [];
        for(var i = 0 ; i < data_varian.length;i++){    
            let arr = {"varian": data_varian[i]["varian"],"value":[]}; 
            for(var j = 0; j < data_varian[i]["value"].length;j++){ 
                let value = { 
                    "id" : data_varian[i]["value"][j]["id"],
                    "text" : data_varian[i]["value"][j]["text"],
                };
                arr["value"].push(value);
            }   
            arr_var.push(arr)
        }  

        var data_vendor = [];
        $.each( $("#produk-vendor").select2("data"), function(index, item) {
            data_vendor.push({
                id: item.id,
                text: item.text
            });
        });

        const hargaTerendah = arr_varian_detail.reduce((min, current) => Math.min(min, current.hargajual), Infinity);
        const hargaTertinggi = arr_varian_detail.reduce((max, current) => Math.max(max, current.hargajual), -Infinity);
        var data_produk = {
            "category" : $("#produk-kategori").val(),
            "name" : $("#produk-name").val(),
            "detail" : $("#produk-detail").val(),
            "vendor" : JSON.stringify(data_vendor), 
            "varian" : JSON.stringify(arr_var), 
            "price_range" : (hargaTerendah == hargaTertinggi ? hargaTerendah : hargaTerendah + " - " + hargaTertinggi),
        }
        var data_produk_detail = arr_varian_detail;
        var data_produk_image = image_list;
 
        
        // INSERT LOADER BUTTON
        if (isProcessingEdit) {
            return;
        }  

        isProcessingEdit = true; 
        let old_text = $(this).html();
        $(this).html('<span class="spinner-border spinner-border-sm pe-2"></span><span class="ps-2" role="status">Loading...</span>');
        
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-produk/" + <?= $_produk->id ?>, 
            data:{
                "data": data_produk,
                "detail": data_produk_detail,
                "image": data_produk_image, 
            },
            success: function(data) {    
                isProcessingEdit = false;
                $("#btn-edit-produk").html(old_text);
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {  
                       $("#modal-edit-produk").modal("hide");
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
                isProcessingEdit = false;
                $("#btn-edit-produk").html(old_text);  
                
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        }); 
    });
</script>