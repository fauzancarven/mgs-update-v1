<div class="modal fade" id="modal-edit-proforma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true">
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
        dropdownParent: $('#modal-edit-proforma .modal-content'),
        tags:true,
    });
    $("#type-payment").val("<?= $payment->type ?>").trigger("change");
    $("#method-payment").select2({
        dropdownParent: $('#modal-edit-proforma .modal-content'),
    });  
    $("#method-payment").val("<?= $payment->method ?>").trigger("change");
 
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
            url: "<?= base_url() ?>action/edit-data-proforma/<?= $payment->id?>", 
            data:{ 
                "ref": <?= $project->id ?>, 
                "date": $("#date-payment").data('daterangepicker').startDate.format("YYYY-MM-DD"), 
                "datecreate": moment().format("YYYY-MM-DD HH:m:s"), 
                "type": $("#type-payment").val(), 
                "method":$("#method-payment").val(), 
                "total": $("#total-payment").val().replace(/[^0-9]/g, ''), 
                "note":$("#comment-payment").val(),  
            },
            success: function(data) {   
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-edit-proforma").modal("hide");  
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