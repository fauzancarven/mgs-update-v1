<div class="modal fade" id="modal-edit-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Edit Payment</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3"> 
                <div class="mb-1">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="grandtotal-payment" class="col-form-label">Total Invoice:</label>
                            <div class="input-group"> 
                                <span class="input-group-text font-std">Rp.</span>
                                <input type="text"class="form-control form-control-sm  input-form d-inline-block number-price" id="grandtotal-payment" value="<?= $project->grandtotal ?>" disabled>
                            </div> 
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="sisa-payment" class="col-form-label">Sisa Pembayaran:</label>
                            <div class="input-group"> 
                                <span class="input-group-text font-std">Rp.</span>
                                <input type="text"class="form-control form-control-sm  input-form d-inline-block number-price" id="sisa-payment" value="<?= $project->grandtotal - (array_sum(array_column($payments, 'total'))) + $payment->total ?>" disabled>
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
                                <input type="text"class="form-control form-control-sm  input-form d-inline-block number-price" id="total-payment" value="<?= $payment->total ?>">
                            </div>  
                        </div>
                    </div>  
                </div> 
                <div class="mb-1">
                    <label for="comment-payment" class="col-form-label">Catatan:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="comment-payment" value="<?= $payment->note ?>">
                </div>
                <div class="mb-1">
                    <label for="bukti-project" class="col-form-label">Upload Bukti:</label><button id="remove-image" class="btn btn-sm btn-danger btn-action m-1" onclick=""><i class="fa-solid fa-close pe-2"></i>Delete</button>
                    <input class="form-control form-control-sm input-form d-none" type="file" accept="image/*" style="width:100%" id="bukti-payment">   
                    <div class="text-center" id="dropzone">
                        <div class="dz-message">Tarik dan lepas file gambar di sini atau klik untuk memilih</div>
                        <img id="preview" width="200" height="200" />
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
        "startDate": moment("<?= $payment->date ?>"),
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
        dropdownParent: $('#modal-edit-payment .modal-content'),
        tags:true,
    });
    $("#type-payment").val("<?= $payment->type ?>").trigger("change");
    $("#method-payment").select2({
        dropdownParent: $('#modal-edit-payment .modal-content'),
    });  
    $("#method-payment").val("<?= $payment->method ?>").trigger("change");

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

    var image_payment =  "<?= $image ?>";
    if(image_payment != ""){
        $("#dropzone .dz-message").hide();
        $('#preview').attr('src', image_payment);
        $('#preview').show();
    } else{
        
        $("#dropzone .dz-message").show();
        $('#preview').hide();
    }
     
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

    $("#btn-add-payment").click(function(){
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
            url: "<?= base_url() ?>action/edit-data-payment/<?= $payment->id?>", 
            data:{ 
                "ref": <?= $project->id ?>, 
                "date": $("#date-payment").data('daterangepicker').startDate.format("YYYY-MM-DD"), 
                "datecreate": moment().format("YYYY-MM-DD HH:m:s"), 
                "type": $("#type-payment").val(), 
                "method":$("#method-payment").val(), 
                "total": $("#total-payment").val().replace(/[^0-9]/g, ''), 
                "note":$("#comment-payment").val(), 
                "image": $("#preview").attr('src'), 
            },
            success: function(data) {   
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-edit-payment").modal("hide");  
                        loader_data_project(<?= $project->id ?>,"invoice") 
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