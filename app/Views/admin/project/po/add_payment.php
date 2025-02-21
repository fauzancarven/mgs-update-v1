<div class="modal fade" id="modal-add-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Tambah Payment</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="mb-1">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="grandtotal-payment" class="col-form-label">Total Pembelian:</label>
                            <div class="input-group"> 
                                <span class="input-group-text font-std">Rp.</span>
                                <input type="text"class="form-control form-control-sm  input-form d-inline-block number-price" id="grandtotal-payment" value="<?= $project->GrandTotal ?>" disabled>
                            </div> 
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="sisa-payment" class="col-form-label">Sisa Pembayaran:</label>
                            <div class="input-group"> 
                                <span class="input-group-text font-std">Rp.</span>
                                <input type="text"class="form-control form-control-sm  input-form d-inline-block number-price" id="sisa-payment" value="<?= $project->GrandTotal - (array_sum(array_column($payment, 'PaymentTotal'))) ?>" disabled>
                            </div>  
                        </div>
                    </div>  
                </div> 
                <div class="mb-1">
                    <label for="date-payment" class="col-form-label">Tanggal:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="date-payment">
                </div> 
                <div class="mb-1"> 
                    <label for="category-project" class="col-form-label">Type:</label> 
                    <select class="form-select form-select-sm" style="width:100%" id="type-payment">
                        <option value="DP" selected>DP</option>
                        <option value="Pelunasan">Pelunasan</option>
                    </select>  
                </div> 
                <div class="mb-1"> 
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="method-payment" class="col-form-label">Method Payment:</label>
                            <select class="form-select form-select-sm" style="width:100%" id="method-payment">
                                <option value="TUNAI (CASH)" selected>TUNAI (CASH)</option>
                                <option value="BCA TF">BCA TF</option>
                            </select> 
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="total-payment" class="col-form-label">Total Payment:</label>
                            <div class="input-group"> 
                                <span class="input-group-text font-std">Rp.</span>
                                <input type="text"class="form-control form-control-sm  input-form d-inline-block number-price" id="total-payment" value="0">
                            </div>  
                        </div>
                    </div>  
                </div> 
                <div class="mb-1">
                    <label for="comment-payment" class="col-form-label">Catatan:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="comment-payment">
                </div>
                <div class="mb-1">
                    <label for="bukti-project" class="col-form-label">Upload Bukti:</label><button id="remove-image" class="btn btn-sm btn-danger btn-action m-1" onclick=""><i class="fa-solid fa-close pe-2"></i>Delete</button>
                    <input class="form-control form-control-sm input-form d-none" type="file" accept="image/*" style="width:100%" id="bukti-payment">   
                    <div class="text-center" id="dropzone">
                        <div class="dz-message">Tarik dan lepas file gambar di sini atau klik untuk memilih</div>
                        <img id="preview" width="200" height="200" />
                    </div>
                </div>
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Term and Condition </span> 
                    </div>
                </div>   
                <div class="card template-footer" style="min-height:50px;">
                    <div class="card-body mx-2 p-2 bg-light">
                        <div class="row mb-1 align-items-center mt-2"> 
                            <div class="col-7">
                                <select class="form-select form-select-sm" name="Select" placeholder="Pilih Format" style="width:100%"></select>  
                            </div>
                            <div class="col-5">
                                <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpanAs" aria-label="name: simpan As"><i class="fa-solid fa-save pe-2"></i>Save AS</a>
                                <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpan" aria-label="name: simpan"><i class="fa-solid fa-save pe-2"></i>Save</a>
                                <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="edit" aria-label="name: edit"><i class="fa-solid fa-pencil pe-2"></i>Edit</a>
                            </div>
                        </div>    
                        <div class="row mb-1 align-items-center mt-2"> 
                            <div class="col-12"> 
                                <div name="EditFooterMessage" class="border"></div> 
                            </div>
                        </div>    
                    </div>  
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-payment">Simpan</button>
            </div>
        </div>
    </div>
</div> 

<div id="modal-optional"></div>
<script>
     $('#date-payment').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment(),
        "endDate":  moment(),
        locale: {
            format: 'DD MMMM YYYY'
        }
    }, function(start, end, label) {
        // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
    $(".number-price").each(function(){
        new Cleave(this, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
        }); 
    }); 
     
    $("#type-payment").select2({
        dropdownParent: $('#modal-add-payment .modal-content'),
        tags:true,
    });
    $("#method-payment").select2({
        dropdownParent: $('#modal-add-payment .modal-content'),
    });  

    var file;

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


    
    var quill = [];  
    $(".template-footer").each(function(index, el){
        var message = $(el).find("[name='EditFooterMessage']")[0];
        var type = "payment"; 
        quill[type] = new Quill(message,  {
            debug: 'false',
            modules: {
                toolbar: [['bold', 'italic', 'underline', 'strike'],[{ 'list': 'ordered'}]],
            },  
            theme: "bubble"//'snow'
        }); 
        quill[type].enable(false);
        quill[type].root.style.background = '#F7F7F7'; // warna disable 
        const btnsaveas = $(el).find("a[value='simpanAs']")[0];
        const btnsave = $(el).find("a[value='simpan']")[0];
        const btnedit = $(el).find("a[value='edit']")[0];
        const selectoption = $(el).find("select")[0];

        $(btnsave).hide();
        $(btnsaveas).hide();
        $(btnedit).hide();
 
        $(selectoption).select2({
            dropdownParent: $('#modal-add-payment .modal-content'),
            placeholder: "Pilih Template",
            tags:true,
            ajax: {
                url: "<?= base_url()?>select2/get-data-template-footer/" + type,
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
                    tags: true // menandai tag baru
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
                return params.text;
                //return params.text;
            },
            templateSelection: function(params) {
                return params.text;
            }, 
            //escapeMarkup: function(m) { return m; }
        }).on("select2:select", function(e) {  
            var data = e.params.data;    
            //console.log(data);
            if (e.params.data.tags) { 
                quill[type].setContents(); 
                
                $(btnsave).show();
                $(btnsaveas).show();
                $(btnedit).hide();
 
                quill[type].enable(true);
                quill[type].root.style.background = '#FFFFFF'; // warna enable
            } else { 
                quill[type].setContents(JSON.parse(data.delta));  
                
                $(btnsave).hide();
                $(btnsaveas).hide();
                $(btnedit).show(); 

                quill[type].enable(false);
                quill[type].root.style.background = '#F7F7F7'; // warna enable
            } 
        });

        $(btnsave).click(function(){ 
            if($(selectoption).select2("data")[0]["id"] == $(selectoption).select2("data")[0]["text"]){
                $.ajax({ 
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/add-data-template-footer", 
                    data:{
                        "TemplateFooterName":$(selectoption).select2("data")[0]["text"] ,
                        "TemplateFooterDetail": quill[type].getSemanticHTML(), 
                        "TemplateFooterDelta": quill[type].getContents(), 
                        "TemplateFooterCategory": type, 
                    },
                    success: function(data) {    
                        //console.log(data); 
                        if(data["status"]===true){     
                          
                            $(btnsave).hide();
                            $(btnsaveas).hide();
                            $(btnedit).show(); 

                            quill[type].enable(false);
                            quill[type].root.style.background = '#F7F7F7'; // warna disable    
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
            }else{
                $.ajax({ 
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/edit-data-template-footer/" + $(selectoption).select2("data")[0]["id"] , 
                    data:{
                        "TemplateFooterName":$(selectoption).select2("data")[0]["text"] ,
                        "TemplateFooterDetail": quill[type].getSemanticHTML(), 
                        "TemplateFooterDelta": quill[type].getContents(), 
                        "TemplateFooterCategory": type, 
                    },
                    success: function(data) {    
                        //console.log(data); 
                        if(data["status"]===true){ 

                            $(btnsave).hide();
                            $(btnsaveas).hide();
                            $(btnedit).show(); 

                            quill[type].enable(false);
                            quill[type].root.style.background = '#F7F7F7'; // warna disable    
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
            }
        }) 
        $(btnsaveas).click(function(){
            $("#modal-add-payment").modal("hide"); 
            Swal.fire({
                title: 'Simpan Template',
                input: 'text',
                buttonsStyling: false,
                showCancelButton: true,
                showCancelButton: true,
                customClass: {
                    confirmButton: 'btn btn-primary mx-1',
                    cancelButton: 'btn btn-secondary mx-1',
                    loader: 'custom-loader',
                    input: 'form-control form-control-sm w-auto input-form', // Tambahkan kelas pada input
                },
                backdrop: true,
                confirmButtonText: "Simpan",
                loaderHtml: '<div class="spinner-border text-primary"></div>',
                preConfirm: async (name) => {
                    try {  
                        $.ajax({ 
                            dataType: "json",
                            method: "POST",
                            url: "<?= base_url() ?>action/add-data-template-footer", 
                            data:{ 
                                "TemplateFooterName": name ,
                                "TemplateFooterDetail": quill[type].getSemanticHTML(), 
                                "TemplateFooterDelta": quill[type].getContents(), 
                                "TemplateFooterCategory": type, 
                            },
                            success: function(data) {    
                                //console.log(data); 
                                if(data["status"]===true){    
                                    $(selectoption).append(new Option(data["data"]["TemplateFooterName"] ,data["data"]["TemplateFooterId"], true, true)).trigger('change'); 
                                    
                                    $(btnsave).hide();
                                    $(btnsaveas).hide();
                                    $(btnedit).show(); 

                                    quill[type].enable(false);
                                    quill[type].root.style.background = '#F7F7F7'; // warna disable    
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
                    } catch (error) {
                        Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {    
                $(btnsave).hide();
                $(btnsaveas).hide();
                $(btnedit).show(); 

                quill[type].enable(false);
                quill[type].root.style.background = '#F7F7F7'; // warna disable    
                $("#modal-add-payment").modal("show");
            }); 
        })
        $(btnedit).click(function(){

            $(btnsave).show();
            $(btnsaveas).show();
            $(btnedit).hide();

            quill[type].enable(true);
            quill[type].root.style.background = '#FFFFFF'; // warna enable

        }) 
    });

    $("#btn-add-payment").click(function(){
        if($($(".template-footer").find("select")[0]).val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Template harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $($(".template-footer").find("select")[0]).select2("open"), 300); 
            }) ;
            return; 
        }     
        if($("#total-payment").val() == 0){
            Swal.fire({
                icon: 'error',
                text: 'Total payment harus diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#total-payment").focus(), 300); 
            }) ;
            return; 
        }    

        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-data-payment", 
            data:{ 
                "InvId": <?= $project->InvId ?>, 
                "SampleId": <?= $project->SampleId ?>, 
                "PaymentDate": $("#date-payment").data('daterangepicker').startDate.format("YYYY-MM-DD"),  
                "PaymentType": $("#type-payment").val(), 
                "PaymentMethod":$("#method-payment").val(), 
                "PaymentTotal": $("#total-payment").val().replace(/[^0-9]/g, ''), 
                "PaymentNote":$("#comment-payment").val(), 
                "TemplateId": $($(".template-footer").find("select")[0]).val(), 
                "image": $("#preview").attr('src'), 
            },
            success: function(data) {   
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-add-payment").modal("hide");  
                        $(".menu-item[data-menu='<?= $project->menu ?>'][data-id='<?= $project->Project_id ?>']").trigger("click");  
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
    });
</script>