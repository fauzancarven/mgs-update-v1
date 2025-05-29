 
<div class="modal fade" id="modal-edit-sample" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-edit-sample-label" style="overflow-y:auto;" data-menu="project">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-sample-label">Ubah Sample Barang</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-lg-6 col-12 my-1 mb-2 ">
                        <div class="row mx-2 align-items-center mb-3 mb-md-1">
                            <div class="label-border-right">
                                <span class="label-dialog">Customer</span>
                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" type="button"             style="position:absolute;top: -11px;right: 10px;font-size: 0.6rem;" onclick="togglecustom('customer-display',this)">
                                    <span>Sembunyikan</span>
                                    <i class="fa-solid fa-angle-up"></i> 
                                </button> 
                            </div>
                        </div> 
                        <div class="customer-display card bg-light show mt-4 m-1 p-2">
                        <div class="row mb-1 align-items-center">
                                <label for="SphAddress" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm input-form" id="SampleCustName" value="<?= $project->SampleCustName ?>" />
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphAddress" class="col-sm-3 col-form-label">Telp Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm input-form" id="SampleCustTelp" value="<?= $project->SampleCustTelp ?>" />
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphAddress" class="col-sm-3 col-form-label">Alamat Project</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm input-form" id="SampleAddress" value="<?= $project->SampleAddress ?>"/>
                                </div>
                            </div> 
                        </div>  
                    </div>  
                    <div class="col-lg-6 col-12 my-1 mb-2 mb-3 mb-md-1">   
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Document</span>
                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" type="button"             style="position:absolute;top: -11px;right: 10px;font-size: 0.6rem;" onclick="togglecustom('document-display',this)">
                                    <span>Sembunyikan</span>
                                    <i class="fa-solid fa-angle-up"></i> 
                                </button> 
                            </div>
                        </div>  
                        <div class="document-display card bg-light show mt-4 m-1 p-2">
                            <div class="row mb-1 align-items-center">
                                <label for="SampleCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                                <div class="col-sm-10">
                                    <input id="SampleCode" name="SampleCode" type="text" class="form-control form-control-sm input-form" value="<?= $project->SampleCode ?>" disabled>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SampleRef" class="col-sm-2 col-form-label">Ref</label>
                                <div class="col-sm-10"> 
                                    <select class="form-select form-select-sm" id="SampleRef" name="SampleRef"  style="width:100%" >
                                        <option value="0" selected data-type="-">No Data Selected</option>
                                    </select>  
                                </div> 
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="SampleDate" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input id="SampleDate" name="SampleDate" type="text" class="form-control form-control-sm input-form" value="">
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="SampleAdmin" class="col-sm-2 col-form-label">Admin</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="SampleAdmin" name="SampleAdmin" placeholder="Pilih Admin" style="width:100%"></select>  
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="SampleDelivery" class="col-sm-2 col-form-label">Pengiriman</label>
                                <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="SampleDelivery" id="SampleDelivery1" value="0" <?= $project->SampleDelivery == 0 ? "checked" : "" ?>>
                                    <label class="text-detail" for="SampleDelivery1">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="SampleDelivery" id="SampleDelivery2" value="1" <?= $project->SampleDelivery == 1 ? "checked" : "" ?>>
                                    <label class="text-detail" for="SampleDelivery2">Ya</label>
                                </div>
                                </div>
                            </div>  
                        </div> 
                    </div>   
                </div>
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Detail Produk</span> 
                    </div>
                </div>    
                <div class="card " style="min-height:50px;">
                    <div class="card-body p-0 bg-light" > 
                        <div class="row align-items-center d-none d-md-flex px-3">
                            <div class="col-12 col-md-4 my-1">    
                                <div class="row">  
                                    <div class="col-12"> 
                                        <span class="label-head-dialog">Deskripsi</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 my-1 ">
                                <div class="row"> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog"><i class="ti-settings"></i></span>   
                                    </div> 
                                    <div class="col-3"> 
                                        <span class="label-head-dialog">Qty | Satuan</span>   
                                    </div> 
                                    <div class="col-7">  
                                        <div class="row"> 
                                            <div class="col-4"> 
                                                <span class="label-head-dialog">Harga</span>   
                                            </div> 
                                            <div class="col-4"> 
                                                <span class="label-head-dialog">Diskon Item</span>   
                                            </div> 
                                            <div class="col-4"> 
                                                <span class="label-head-dialog">Total</span>   
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        <div id="tb_varian" class="text-center" style="border-top: white 2.5px solid; border-bottom: white 2.5px solid;">
                            <div class="d-flex justify-content-center flex-column align-items-center d-none"> 
                                <img src="https://localhost/mahiera/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                                <span class="text-head-1">Item belum ditambahkan</span>
                            </div> 
                            <div class="row align-items-center">
                                <div class="col-12 col-md-12 my-1 group text-start"> 
                                    <span class="text-head-3">A. Barang</span>
                                </div>   
                                <div class="col-12 col-md-4 my-1 varian">   
                                    <div class="d-flex">
                                        <span class="no-urut text-head-3">1.</span> 
                                        <div class="d-flex flex-column text-start">
                                            <span class="text-head-3">Bata Expose MRC KD</span>
                                            <span class="text-detail-2 text-truncate">RST00001 - Roster</span> 
                                            <div class="d-flex gap-1">
                                                <span class="badge badge-0 rounded">vendor : MGS</span>
                                                <span class="badge badge-1 rounded">ukuran : 12 x 12 x 0.5 cm</span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 my-1 detail">
                                    <div class="row"> 
                                        <div class="col-6 col-md-2 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Unit</span>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control form-control-sm input-form berat" value="" data-id="">
                                                <span class="input-group-text font-std">Pcs</span>
                                            </div>  
                                        </div>  
                                        <div class="col-12 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga</span>
                                            <div class="input-group"> 
                                                <span class="input-group-text font-std">Rp.</span> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block pcsM2" data-id="" value="">
                                            </div>    
                                        </div> 
                                        <div class="col-6 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Diskon</span>
                                            <div class="input-group">  
                                                <span class="input-group-text font-std">Rp.</span> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" data-id="" value="">
                                            </div>   
                                        </div> 
                                        <div class="col-6 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Total</span>
                                            <div class="input-group"> 
                                                <span class="input-group-text font-std">Rp.</span>
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" data-id="" value="">
                                            </div>     
                                        </div> 
                                    </div>    
                                </div> 
                                <div class="col-12 col-md-4 my-1 varian">   
                                    <div class="d-flex"> 
                                        <span class="no-urut text-head-3">2.</span> 
                                        <div class="d-flex flex-column text-start">
                                            <span class="text-head-3">Bata Expose MRC KD</span>
                                            <span class="text-detail-2 text-truncate">RST00001 - Roster</span> 
                                            <div class="d-flex gap-1">
                                                <span class="badge badge-1 rounded">vendor : MGS</span>
                                                <span class="badge badge-2 rounded">ukuran : 12 x 12 x 0.5 cm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 my-1 detail">
                                    <div class="row"> 
                                        <div class="col-6 col-md-2 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Unit</span>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control form-control-sm input-form berat" value="" data-id="">
                                                <span class="input-group-text font-std">Pcs</span>
                                            </div>  
                                        </div>  
                                        <div class="col-12 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga</span>
                                            <div class="input-group"> 
                                                <span class="input-group-text font-std">Rp.</span> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block pcsM2" data-id="" value="">
                                            </div>    
                                        </div> 
                                        <div class="col-6 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Diskon</span>
                                            <div class="input-group">  
                                                <span class="input-group-text font-std">Rp.</span> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" data-id="" value="">
                                            </div>   
                                        </div> 
                                        <div class="col-6 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Total</span>
                                            <div class="input-group"> 
                                                <span class="input-group-text font-std">Rp.</span>
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" data-id="" value="">
                                            </div>     
                                        </div> 
                                    </div>    
                                </div> 
                                <div class="col-12 col-md-12 my-1 group text-start"> 
                                    <span class="text-head-3">B. Jasa</span>
                                </div>  
                                <div class="col-12 col-md-4 my-1 varian">    
                                    <div class="d-flex "> 
                                        <span class="no-urut text-head-3">1.</span>
                                        <div class="flex-grow-1 text-start">
                                            <span class="text-head-3">Instalasi Kabel CCTV Kabel RG 59 Belden (Coax+Power) incl. Conduit dan connector BNC</span> 
                                        </div>  
                                    </div> 
                                </div>
                                <div class="col-12 col-md-8 my-1 detail">
                                    <div class="row"> 
                                        <div class="col-6 col-md-2 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Unit</span>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control form-control-sm input-form berat" value="" data-id="">
                                                <span class="input-group-text font-std">Pcs</span>
                                            </div>  
                                        </div>  
                                        <div class="col-12 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga</span>
                                            <div class="input-group"> 
                                                <span class="input-group-text font-std">Rp.</span> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block pcsM2" data-id="" value="">
                                            </div>    
                                        </div> 
                                        <div class="col-6 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Diskon</span>
                                            <div class="input-group">  
                                                <span class="input-group-text font-std">Rp.</span> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" data-id="" value="">
                                            </div>   
                                        </div> 
                                        <div class="col-6 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Total</span>
                                            <div class="input-group"> 
                                                <span class="input-group-text font-std">Rp.</span>
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" data-id="" value="">
                                            </div>     
                                        </div> 
                                    </div>    
                                </div> 
                                <div class="col-12 col-md-12 my-1 group text-start"> 
                                    <span class="text-head-3">C. Lain - Lain</span>
                                </div>  
                                <div class="col-12 col-md-4 my-1 varian">    
                                    <div class="d-flex "> 
                                        <span class="no-urut text-head-3">1.</span>
                                        <div class="flex-grow-1 text-start">
                                            <span class="text-head-3">Perapihan Bekas Jalur Pipa</span> 
                                        </div>  
                                    </div> 
                                </div>
                                <div class="col-12 col-md-8 my-1 detail">
                                    <div class="row"> 
                                        <div class="col-6 col-md-2 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Unit</span>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control form-control-sm input-form berat" value="" data-id="">
                                                <span class="input-group-text font-std">Pcs</span>
                                            </div>  
                                        </div>  
                                        <div class="col-12 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga</span>
                                            <div class="input-group"> 
                                                <span class="input-group-text font-std">Rp.</span> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block pcsM2" data-id="" value="">
                                            </div>    
                                        </div> 
                                        <div class="col-6 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Diskon</span>
                                            <div class="input-group">  
                                                <span class="input-group-text font-std">Rp.</span> 
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" data-id="" value="">
                                            </div>   
                                        </div> 
                                        <div class="col-6 col-md-3 px-1">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Total</span>
                                            <div class="input-group"> 
                                                <span class="input-group-text font-std">Rp.</span>
                                                <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" data-id="" value="">
                                            </div>     
                                        </div> 
                                    </div>    
                                </div> 
                            </div> 
                        </div> 
                        <div class="d-flex justify-content-center flex-column align-items-center"> 
                            <div class="d-flex px-3 gap-1">
                                <button class="btn btn-sm btn-primary my-2" id="btn-add-product"><i class="fa-solid fa-plus pe-2"></i>Tambah Produk</button> 
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">  
                    <div class="col-12 col-md-8 px-1 order-2 order-md-1">   
                        <div class="row mx-2 my-3 align-items-center">
                            <div class="label-border-right position-relative" >
                                <span class="label-dialog">Term and Condition </span> 
                            </div>
                        </div>   
                        <div class="card template-footer" style="min-height:50px;">
                            <div class="card-body mx-2 p-2 bg-light">
                                <div class="row mb-1 align-items-center"> 
                                    <div class="col-7">
                                        <select class="form-select form-select-sm" name="Select" placeholder="Pilih Format" style="width:100%"></select>  
                                    </div>
                                    <div class="col-5">
                                        <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpanAs" aria-label="name: simpan As"><i class="fa-solid fa-save pe-2"></i>Save AS</a>
                                        <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpan" aria-label="name: simpan"><i class="fa-solid fa-save pe-2"></i>Save</a>
                                        <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="edit" aria-label="name: edit"><i class="fa-solid fa-pencil pe-2"></i>Edit</a>
                                    </div>
                                </div>    
                                <div class="row mb-1 align-items-center"> 
                                    <div class="col-12"> 
                                        <div name="EditFooterMessage" class="border"></div> 
                                    </div>
                                </div>    
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-12 col-md-4 px-3 order-1 order-md-2"> 
                        <div class="row align-items-center py-1 mt-3">
                            <div class="col-4">
                                <span class="label-head-dialog">Sub Total</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled value="0" id="SampleSubTotal">
                                </div>     
                            </div>
                        </div> 
                        <div class="row align-items-center py-1">
                            <div class="col-4">
                                <span class="label-head-dialog">Disc Item Total</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled id="SampleDiscItemTotal" value="0">
                                </div>     
                            </div>
                        </div> 
                        <div class="row align-items-center py-1">
                            <div class="col-4">
                                <span class="label-head-dialog">Disc Total</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="SampleDiscTotal" value="0">
                                </div>     
                            </div>
                        </div> 
                        <div class="row align-items-center py-1">
                            <div class="col-4">
                                <span class="label-head-dialog">Pengiriman</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="SampleDeliveryTotal" value="0" <?= ($project->SampleDelivery == 0 ? "disabled" : "" )?>>
                                </div>     
                            </div>
                        </div> 
                        <div class="row align-items-center py-1">
                            <div class="col-4">
                                <span class="label-head-dialog">Grand Total</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form hargajual" disabled value="0" id="SampleGrandTotal" >
                                </div>     
                            </div>
                        </div> 
                    </div>  
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-edit-sample">Simpan</button>
            </div>
        </div>
    </div>
</div>  

<div id="modal-optional"></div>
<script>    
    $('input[name="SampleDelivery"]').change(function() {
        if($(this).val() == 0){
            $('#SampleDeliveryTotal').prop("disabled",true)
            $('#SampleDeliveryTotal').val("0")
        }else{

            $('#SampleDeliveryTotal').prop("disabled",false)
        }
    }); 
    $('#SampleDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment('<?= $project->SampleDate ?>'),
        "endDate":  moment('<?= $project->SampleDate ?>'),
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    
    $("#SampleRef").select2({
        dropdownParent: $('#modal-edit-sample .modal-content'),
        placeholder: "Pilih referensi",
        ajax: {
            url: "<?= base_url()?>select2/get-data-ref-sample/<?= $project->ProjectId?>",
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
        escapeMarkup: function(m) {
            return m;
        },
        templateResult: function template(data) {
            if ($(data.html).length === 0) {
                return data.text;
            }
            return $(data.html);
        },
        templateSelection: function templateSelect(data) {
            $(data.element).attr('data-type', data.type);
            if ($(data.html).length === 0) {
                return data.text;
            }
            return data['text'];
        }
    });
    var option = new Option(
        '<?=  $project->SampleRefCode ?>', 
        '<?= $project->SampleRef ?>', 
        false, 
        true
    );
    $(option).attr('data-type', '<?= $project->SampleRefType ?>'); 
    $('#SampleRef').append(option).trigger('change.select2'); 

    $("#SampleAdmin").select2({
        dropdownParent: $('#modal-edit-sample .modal-content'),
        placeholder: "Pilih Admin",
        ajax: {
            url: "<?= base_url()?>select2/get-data-users",
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
    });
    $('#SampleAdmin').append(new Option("<?=$user->code. " - " . $user->username ?>" , "<?=$user->id?>", true, true)).trigger('change');   
        
    var data_detail_item = JSON.parse('<?= JSON_ENCODE($detail,true) ?>');   
    
    var isProcessingSampleAddCategory = false;
    add_detail_category = function(el){
        if (isProcessingSampleAddCategory) {
            //console.log("project Sample cancel load");
            return;
        }  
        isProcessingSampleAddCategory = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $("#modal-edit-sample").modal("hide"); 
        Swal.fire({
            title: 'Tambah Kategori',
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
                    data_detail_item.push({
                        type: "category",
                        text: name,
                        qty: 0,
                        price: 0,
                        disc: 0,
                        total: 0, 
                        varian: [], 
                    });
                    load_produk();
                } catch (error) {
                    Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {  
            isProcessingSampleAddCategory = false;
            $(el).html(old_text); 
            $("#modal-edit-sample").modal("show");
        }); 
    }
 
    $('#modal-select-item').on('hidden.bs.modal', function () {
        if (document.activeElement) {
            document.activeElement.blur();
        }
    });
    var isProcessingSampleAddproduk = false;

    $("#btn-add-product").click(function(){
        if (isProcessingSampleAddproduk) {
            //console.log("project Sample cancel load");
            return;
        }  
        isProcessingSampleAddproduk = true; 
        let old_text = $("#btn-add-product").html();
        $("#btn-add-product").html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/select-produk", 
            success: function(data) {  
                isProcessingSampleAddproduk = false; 
                $("#btn-add-product").html(old_text);
                
                $("#modal-optional").html(data);
                
                $("#modal-edit-sample").modal("hide");  

                $("#modal-select-item").modal("show"); 


                $('#modal-select-item').on('hidden.bs.modal', function () {
                    if (document.activeElement) {
                        document.activeElement.blur();
                    }
                    $("#modal-edit-sample").modal("show");  
                    
                });

                //membuat event click dari modal sebelumnya
                $("#btn-add-item").click(function(event){
                    event.preventDefault();

                   
                    if($("#select-produk").val() == null){
                        Swal.fire({
                            icon: 'error',
                            text: 'Item produk harus dipilih atau perlu diinput...!!!', 
                            confirmButtonColor: "#3085d6", 
                        }).then(function(){ 
                            swal.close();
                            setTimeout(() => $("#select-produk").select2("open"), 300); 
                        }) ;
                        return; 
                    }    
                    select_produk(data_select_produk);
                });
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSampleAddproduk = false;
                $("#btn-add-product").html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    });

    select_produk = function(data){
        if(data.id === undefined) return;
 
        for(var i = 0;data_detail_item.length > i;i++){  
            if(data.id == 0) continue
            if(data_detail_item[i]["type"] == "product"){ 
                var arr1 = data_detail_item[i]["varian"];
                var arr2 = data.varian;
                arr1.sort((a, b) => a.varian.localeCompare(b.varian));
                arr2.sort((a, b) => a.varian.localeCompare(b.varian));
            }
            if(JSON.stringify(arr1) === JSON.stringify(arr2) && data_detail_item[i]["produkid"] === data.produkid ){
                Swal.fire({
                    icon: 'error',
                    text: "Item sudah ada !!!", 
                    confirmButtonColor: "#3085d6", 
                });
                return;
            }
        }  

        data["type"] = "product";
        data_detail_item.push(data)

        load_produk();

        $('#modal-select-item').modal("hide");   
    }

    
    edit_varian_click = function(index){ 
        if(data_detail_item[index]["type"] == "category"){  
            $("#modal-edit-sample").modal("hide");
            $("#modal-edit-sample").blur();
            Swal.fire({
                title: 'Rename Kategori',
                input: 'text',
                inputValue: data_detail_item[index]["text"],
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
                        data_detail_item[index]["text"] = name 
                        load_produk();
                    } catch (error) {
                        Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {   
                $("#modal-edit-sample").modal("show");
            });  
        }else{
            $("#modal-edit-sample").modal("hide");
            $("#modal-edit-sample").blur();
            Swal.fire({
                title: 'Rename Produk',
                input: 'text',
                inputValue: data_detail_item[index]["text"],
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
                        data_detail_item[index]["text"] = name 
                        $.ajax({ 
                            dataType: "json",
                            method: "POST",
                            url: "<?= base_url() ?>action/rename-data-produk/" + data_detail_item[index]["id"], 
                            data:{
                                "ProdukName":name, 
                            }, 
                        });
                        load_produk();
                    } catch (error) {
                        Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {   
                $("#modal-edit-sample").modal("show");
            });  
        }
    }
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

     
    function grand_total_harga(){
        var total = data_detail_item.reduce((acc, current) => acc + current.price * current.qty, 0);
        var discitem = data_detail_item.reduce((acc, current) => acc + current.disc * current.qty , 0);
        //var grandtotal =  total - discitem - $("#SampleDiscTotal").val().replace(/[^0-9-]/g, ''); 
        var grandtotal =  total - discitem - $("#SampleDiscTotal").val().replace(/[^0-9-]/g, '') + parseInt($("#SampleDeliveryTotal").val().replace(/[^0-9-]/g, '')); 
        console.log(grandtotal)
        $("#SampleSubTotal").val(total.toLocaleString('en-US')) 
        $("#SampleDiscItemTotal").val(discitem.toLocaleString('en-US'))  
        $("#SampleGrandTotal").val(grandtotal.toLocaleString('en-US')) 
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
                                <div class="d-flex gap-1 flex-wrap">`;
                    for(var j = 0; data_detail_item[i]["varian"].length > j;j++){
                        varian += `<span class="badge badge-${j % 5}">${data_detail_item[i]["varian"][j]["varian"] + ": " + data_detail_item[i]["varian"][j]["value"]}</span>`; 
                    }
                    varian +=  '</div>';
                }
                html += `    
                            <div class="row align-items-center mx-0 hr p-2">
                                <div class="col-12 col-md-4 my-1 varian px-0">   
                                    <div class="d-flex">
                                        <span class="no-urut text-head-3 d-none">${last_group_no}.</span> 
                                        <div class="d-flex pe-2">
                                            <img src="${data_detail_item[i]["image_url"]}" alt="Gambar" class="image-produk-doc"> 
                                        </div> 
                                        <div class="d-flex flex-column text-start flex-fill">
                                            <span class="text-head-3">${data_detail_item[i]["text"]}</span>
                                            ${varian} 
                                        </div>  
                                        <div class="btn-group d-inline-block d-sm-none float-end" role="group">  
                                            <button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                            <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                            <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 my-1 detail">
                                    <div class="row px-2"> 
                                        <div class="col-2 px-0 d-none d-sm-block ">  
                                            <div class="btn-group float-end d-inline-block" role="group">  
                                                <button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                            </div>
                                        </div>  
                                        <div class="col-12 col-md-3 px-1 ">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty/Satuan</span>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control form-control-sm input-form berat" id="input-qty-${i}" data-id="${i}">
                                                <select class="form-select form-select-sm select-satuan" id="select-satuan-${i}" data-id="${i}" placeholder="Pilih" ${data_detail_item[i]["id"] != "-" ? "" : ""}></select>
                                            </div>  
                                        </div>  
                                        <div class="col-12 col-md-7">  
                                            <div class="row">  
                                                <div class="col-6 col-md-4 px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Harga</span>
                                                    <div class="input-group"> 
                                                        <span class="input-group-text font-std px-1">Rp.</span> 
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block" id="input-harga-${i}" data-id="${i}" ${data_detail_item[i]["id"] != "0" ? "" : ""}>
                                                    </div>    
                                                </div> 
                                                <div class="col-6 col-md-4  px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Diskon</span>
                                                    <div class="input-group">  
                                                        <span class="input-group-text font-std px-1">Rp.</span> 
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" id="input-disc-${i}" data-id="${i}">
                                                    </div>   
                                                </div> 
                                                <div class="col-12 col-md-4  px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Total</span>
                                                    <div class="input-group"> 
                                                        <span class="input-group-text font-std px-1">Rp.</span>
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="input-total-${i}" data-id="${i}" disabled>
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
        var inputqty = [];
        var inputharga = [];
        var inputdisc = [];
        var inputtotal = [];
        for(var i = 0; data_detail_item.length > i;i++){
            if(data_detail_item[i]["type"] == "product"){

                function total_harga(id){
                    var total = (inputharga[id].getRawValue() - inputdisc[id].getRawValue() ) * inputqty[id].getRawValue();
                    data_detail_item[id]["total"] = total;
                    inputtotal[id].setRawValue(total);
                    grand_total_harga();
                } 

                //event qty
                inputqty[i] = new Cleave(`#input-qty-${i}`, {
                        numeral: true,
                        delimeter: ",",
                        numeralDecimalScale:3,
                        numeralThousandGroupStyle:"thousand"
                }); 
                inputqty[i].setRawValue(data_detail_item[i]["qty"]);
                $(`#input-qty-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["qty"] = inputqty[$(this).data("id")].getRawValue();
                    if($(`#input-qty-${i}`).val() == "") $(`#input-qty-${i}`).val(0) 
                    total_harga($(this).data("id"));
                });  
 
                //event satuan
                $(`#select-satuan-${i}`).select2({
                    dropdownParent: $('#modal-edit-sample .modal-content'), 
                    placeholder: "pilih",
                    width: 'auto',
                    adaptContainerWidth: true,
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
                            return $("<button class=\"btn btn-sm btn-primary\" onclick=\"select_satuan_add()\">Tambah <b>" + $(`#select-satuan-${i}`).data('select2').dropdown.$search[0].value + "</b></button>");
                        }
                    },
                    formatResult: select2OptionFormat,
                    formatSelection: select2OptionFormat,
                    escapeMarkup: function(m) { return m; }
                }).on("select2:select", function(e) {
                    var data = e.params.data;  
                    data_detail_item[$(this).data("id")]["satuan_id"] = data.id
                    data_detail_item[$(this).data("id")]["satuan_text"]= data.text
                });
                if(data_detail_item[i]["satuan_id"] > 0) $(`#select-satuan-${i}`).append(new Option(data_detail_item[i]["satuan_text"] , data_detail_item[i]["satuan_id"], true, true)).trigger('change');  
                if(data_detail_item[i]["id"] === "0")  $(`#select-satuan-${i}`).prop("disabled",false)
                //event harga
                inputharga[i] = new Cleave(`#input-harga-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:0,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputharga[i].setRawValue(data_detail_item[i]["price"]);
                $(`#input-harga-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["price"] = inputharga[$(this).data("id")].getRawValue();
                    if($(`#input-harga-${i}`).val() == "") $(`#input-harga-${i}`).val(0) 
                    total_harga($(this).data("id"));
                });   
                //event disc
                inputdisc[i] = new Cleave(`#input-disc-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:0,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputdisc[i].setRawValue(data_detail_item[i]["disc"]);
                $(`#input-disc-${i}`).on("keyup",function(){ 
                    var nilaiSaatIni = parseInt(inputdisc[$(this).data("id")].getRawValue());
                    var maksvalue = parseInt(inputharga[$(this).data("id")].getRawValue());
                    if (nilaiSaatIni > maksvalue) { 
                        inputdisc[$(this).data("id")].setRawValue(maksvalue);
                    } 
                    data_detail_item[$(this).data("id")]["disc"] = inputdisc[$(this).data("id")].getRawValue(); 

                    if($(`#input-disc-${i}`).val() == "") $(`#input-disc-${i}`).val(0) 
                    total_harga($(this).data("id")); 
                });  

                //event total
                inputtotal[i] = new Cleave(`#input-total-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:0,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputtotal[i].setRawValue(data_detail_item[i]["total"]); 
                
                total_harga(i);
            }
        }
    }
    load_produk();

    var Sample_sub_total = new Cleave(`#SampleSubTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var Sample_disc_item_total = new Cleave(`#SampleDiscItemTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var Sample_disc_total = new Cleave(`#SampleDiscTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var Sample_grand_total = new Cleave(`#SampleGrandTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var Sample_delivery = new Cleave(`#SampleDeliveryTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    $("#SampleDiscTotal").on("keyup",function(){ 
        grand_total_harga();
        if(parseInt($("#SampleGrandTotal").val().replace(/[^0-9-]/g, '')) < 0){
            $("#SampleDiscTotal").val(0)
            grand_total_harga();
        }
    });
 
    $("#SampleDeliveryTotal").on("keyup",function(){ 
        grand_total_harga(); 
    });
    var mode_edit = false;
    var quill = [];  
    $(".template-footer").each(function(index, el){
        var message = $(el).find("[name='EditFooterMessage']")[0];
        var type = "sample"; 
        quill[type] = new Quill(message,  {
            debug: 'false',
            modules: {
                toolbar: [['bold', 'italic', 'underline', 'strike'],[{ 'list': 'ordered'}]],
            },  
            theme: "bubble"//'snow'
        }); 
        quill[type].enable(false);
        quill[type].root.style.background = '#F7F7F7'; // warna disable 
        quill[type].setContents(JSON.parse(<?= JSON_ENCODE($template->TemplateFooterDelta)?>));  
        const btnsaveas = $(el).find("a[value='simpanAs']")[0];
        const btnsave = $(el).find("a[value='simpan']")[0];
        const btnedit = $(el).find("a[value='edit']")[0];
        const selectoption = $(el).find("select")[0];

        $(btnsave).hide();
        $(btnsaveas).hide();
        $(btnedit).show();
 
        $(selectoption).select2({
            dropdownParent: $('#modal-edit-sample .modal-content'),
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
        $(selectoption).append(new Option("<?=$template->TemplateFooterName ?>" , "<?=$template->TemplateFooterId?>", true, true)).trigger('change'); 
          
        $(btnsave).click(function(){ 
            if($(selectoption).select2("data")[0]["id"] == $(selectoption).select2("data")[0]["text"]){
                $.ajax({ 
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/add-data-template-footer", 
                    data:{
                        "TemplateFooterName":$(selectoption).select2("data")[0]["text"] ,
                        "TemplateFooterDetail": quill[type].root.innerHTML.replace(/\s+/g, " "), 
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
                            
                            mode_edit = false
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
                        "TemplateFooterDetail": quill[type].root.innerHTML.replace(/\s+/g, " "), 
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
                            
                            mode_edit = false   
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
            $("#modal-edit-sample").modal("hide"); 
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
                                "TemplateFooterDetail": quill[type].root.innerHTML.replace(/\s+/g, " "), 
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
                                    mode_edit = false
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
                $("#modal-edit-sample").modal("show");
                mode_edit = false;
            }); 
        })
        $(btnedit).click(function(){

            $(btnsave).show();
            $(btnsaveas).show();
            $(btnedit).hide();

            quill[type].enable(true);
            quill[type].root.style.background = '#FFFFFF'; // warna enable
            mode_edit = true;
        }) 
    });

    $("#btn-edit-sample").click(function(){
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
        if(data_detail_item.some((item) => item.type === "product") == false){
            Swal.fire({
                icon: 'error',
                text: 'Produk harus dimasukan...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#btn-add-product").trigger("click"), 300); 
            }) ;
            return; 
        }
        if(data_detail_item.some((item) => item.satuan_id === "0" ) == true){
            Swal.fire({
                icon: 'error',
                text: 'Data produk ada yang belum lengkap ...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
            }) ;
            return; 
        } 
        var header = {  
            SampleDate: $("#SampleDate").data('daterangepicker').startDate.format("YYYY-MM-DD"),  
            SampleAdmin: $("#SampleAdmin").val(),  
            SampleRef: $("#SampleRef").val(), 
            SampleRefType: $('#SampleRef option:selected').data('type'),
            SampleAddress: $("#SampleAddress").val(), 
            SampleCustName: $("#SampleCustName").val(), 
            SampleCustTelp: $("#SampleCustTelp").val(), 
            SampleDelivery:  $('input[name="SampleDelivery"]:checked').val(),  
            SampleDeliveryTotal: $("#SampleDeliveryTotal").val().replace(/[^0-9]/g, ''), 
            TemplateId: $($(".template-footer").find("select")[0]).val(), 
            SampleSubTotal: $("#SampleSubTotal").val().replace(/[^0-9]/g, ''), 
            SampleDiscItemTotal: $("#SampleDiscItemTotal").val().replace(/[^0-9]/g, ''), 
            SampleDiscTotal: $("#SampleDiscTotal").val().replace(/[^0-9]/g, ''), 
            SampleGrandTotal: $("#SampleGrandTotal").val().replace(/[^0-9]/g, '')
        }
        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){  
            if(data_detail_item[i]["type"] == "product"){ 
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"], 
                    SampleDetailText: data_detail_item[i]["text"],
                    SampleDetailType: data_detail_item[i]["type"], 
                    SampleDetailSatuanId: data_detail_item[i]["satuan_id"], 
                    SampleDetailSatuanText: data_detail_item[i]["satuan_text"],
                    SampleDetailQty: data_detail_item[i]["qty"], 
                    SampleDetailPrice: data_detail_item[i]["price"], 
                    SampleDetailDisc: data_detail_item[i]["disc"], 
                    SampleDetailTotal: data_detail_item[i]["total"], 
                    SampleDetailGroup: data_detail_item[i]["group"], 
                    SampleDetailVarian: data_detail_item[i]["varian"],  
                });
            }else{
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"], 
                    SampleDetailText: data_detail_item[i]["text"],
                    SampleDetailType: data_detail_item[i]["type"], 
                    SampleDetailSatuanId: "", 
                    SampleDetailSatuanText: "", 
                    SampleDetailQty: 0,
                    SampleDetailPrice: 0, 
                    SampleDetailDisc: 0, 
                    SampleDetailTotal: 0, 
                    SampleDetailGroup: "", 
                    SampleDetailVarian: [], 
                });
            }
        }
 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-sample/<?= $project->SampleId ?>", 
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
                        $("#modal-edit-sample").modal("hide");    
                        if($("#modal-add-sample").data("menu") =="sample"){
                            loader_datatable(); 
                        }else{
                            
                            loader_data_project(<?= $project->ProjectId ?>,"sample"); 
                            // $(".icon-project[data-menu='survey'][data-id='<?= $project->ProjectId ?>']").trigger("click"); 
                        }  
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