<div class="modal fade" id="modal-add-accounting" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-accounting-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-accounting-label">Tambah Biaya Lain-Lain</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">  
                <div class="mb-1">
                    <label for="desc-accounting" class="col-form-label">Deskripsi:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="desc-accounting">
                </div> 
                <div class="mb-1">
                    <label for="date-accounting" class="col-form-label">Tanggal:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="date-accounting">
                </div> 
                <div class="mb-1"> 
                    <div class="row">
                        <div class="col-6">
                            <label for="category-project" class="col-form-label">Type:</label> 
                            <select class="form-select form-select-sm" style="width:100%" id="type-accounting" disabled>
                                <option value="1">Dana Masuk</option>
                                <option value="2" selected >Dana Keluar</option>
                            </select>    
                        </div>  
                        <div class="col-6"> 
                            <label for="total-accounting" class="col-form-label">Total:</label>
                            <div class="input-group"> 
                                <span class="input-group-text font-std">Rp. </span>
                                <input type="text" class="form-control form-control-sm input-form number-price" value="" id="total-accounting"> 
                            </div>   
                        </div>  
                    </div>  
                </div>  
                <div class="mb-1">
                    <label for="comment-accounting" class="col-form-label">Catatan:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="comment-accounting">
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-accounting">Simpan</button>
            </div>
        </div>
    </div>
</div> 
<script>
    $('#date-accounting').daterangepicker({
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

    $("#btn-add-accounting").click(function(){
        if($("#desc-accounting").val() == ""){
            Swal.fire({
                icon: 'error',
                text: 'Deskripsi perlu diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
                setTimeout(() => $("#desc-accounting").focus(), 300); 
            }) ;
            return; 
        } 
        if($("#total-accounting").val() == "" || $("#total-accounting").val() <= 0 ){
            Swal.fire({
                icon: 'error',
                text: 'Total perlu diisi...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
                setTimeout(() => $("#total-accounting").focus(), 300); 
            }) ;
            return; 
        }

        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-data-project-accounting/<?= $project->ProjectId?>", 
            data:{
                "AccName":$("#desc-accounting").val(),
                "AccDate":$("#date-accounting").data('daterangepicker').startDate.format("YYYY-MM-DD"),
                "AccType":$("#type-accounting").val(),
                "AccTotal":$("#total-accounting").val().replace(/[^0-9]/g, ''),  
                "AccComment":$("#comment-accounting").val(),
                "ProjectId": "<?= $project->ProjectId?>",
                "AccGroup": "2",
            },
            success: function(data) {    
                //console.log(data); 
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {   
                        $("#modal-add-accounting").modal("hide");   
                        loader_data_project(<?= $project->ProjectId ?>,'keuangan')
                        // $("i[data-menu='keuangan'][data-id='<?= $project->ProjectId ?>']").trigger("click");   
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