 
<div class="modal fade" id="modal-add-sph" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-add-sph-label" style="overflow-y:auto;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-sph-label">Edit Penawaran</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-lg-6 col-12 my-1">
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Customer</span>
                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" id="add-varian" type="button" style="position:absolute;top: -11px;right: -5px;font-size: 0.6rem;">
                                    <i class="fas fa-pencil"></i>
                                    <span class="fw-bold">
                                        &nbsp;Edit
                                    </span>
                                </button> 
                            </div>
                        </div> 
                        <div class="row align-items-center mt-2">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <label class="col-sm-10 fw-bold"><?= $customer->code ?> - <?= $customer->name ?> <?= $customer->company == "" ? "" : " ( " . $customer->company . " ) "; ?></label> 
                        </div> 
                        <div class="row align-items-center">
                            <label class="col-sm-2 col-form-label">Telp</label>
                            <label class="col-sm-10 fw-bold"><?= $customer->telp1 ?> / <?= $customer->telp2 == "" ? "" : $customer->telp2 ?></label> 
                        </div> 
                        <div class="row align-items-center">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <label class="col-sm-10 fw-bold"><?= $customer->email ?></label> 
                        </div>  
                        <div class="row align-items-center">
                            <label class="col-sm-2 col-form-label">Instagram</label>
                            <label class="col-sm-10 fw-bold"><?= $customer->instagram ?></label> 
                        </div>  
                        <div class="row align-items-center">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <label class="col-sm-10 fw-bold"><?= $customer->address ?></label> 
                        </div> 
                    </div>  
                    <div class="col-lg-6 col-12 my-1">   
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Document</span>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                            <div class="col-sm-10">
                                <input id="SphCode" name="SphCode" type="text" class="form-control form-control-sm input-form" value="<?= $project->code ?>" disabled>
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphDate" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input id="SphDate" name="SphDate" type="text" class="form-control form-control-sm input-form" value="">
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphStore" class="col-sm-2 col-form-label">Toko</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" id="SphStore" name="SphStore" placeholder="Pilih Toko" style="width:100%"></select>  
                            </div>
                        </div>  
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphAdmin" class="col-sm-2 col-form-label">Admin</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" id="SphAdmin" name="SphAdmin" placeholder="Pilih Admin" style="width:100%"></select>  
                            </div>
                        </div> 
                        <div class="row mb-1 align-items-center mt-2">
                            <label for="SphAddress" class="col-sm-2 col-form-label">Alamat Project</label>
                            <div class="col-sm-10">
                                <textarea  class="form-control form-control-sm input-form" id="SphAddress"><?= $project->address ?></textarea>
                            </div>
                        </div> 
                    </div>   
                </div>
                  

                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Item Detail</span> 
                    </div>
                </div>     
                <div class="card " style="min-height:50px;">
                    <div class="card-body p-2 bg-light"> 
                        <div class="row align-items-center  d-none d-md-flex px-3">
                            <div class="col-12 col-md-4 my-1">    
                                <div class="row">  
                                    <div class="col-12"> 
                                        <span class="label-head-dialog">Deskripsi</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 my-1">
                                <div class="row"> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog"><i class="ti-settings"></i></span>   
                                    </div> 
                                    <div class="col-2"> 
                                        <span class="label-head-dialog">Qty | Satuan</span>   
                                    </div> 
                                    <div class="col-8">  
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
                        <div id="tb_varian" class="text-center">
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
                            <div class="d-flex px-3 mt-4 gap-1">
                                <button class="btn btn-sm btn-primary my-2" id="btn-add-product"><i class="fa-solid fa-plus pe-2"></i>Tambah Item</button>
                                <button class="btn btn-sm btn-primary my-2" onclick="add_detail_category(this)"><i class="fa-solid fa-plus pe-2"></i>Tambah Kategori</button> 
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
                        <div class="card " style="min-height:50px;">
                            <div class="card-body mx-2 p-2 bg-light">
                                <div class="row mb-1 align-items-center mt-2">
                                    <label for="SphAdmin" class="col-sm-2 col-form-label">Template</label>
                                    <div class="col-sm-5">
                                        <select class="form-select form-select-sm" id="SphFormatFooter" name="SphFormatFooter" placeholder="Pilih Format" style="width:100%"></select>  
                                    </div>
                                    <div class="col-5">
                                        <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpan" aria-label="name: simpan" id="savequillas"><i class="fa-solid fa-save pe-2"></i>Save As</a>
                                        <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="simpan" aria-label="name: simpan" id="savequill"><i class="fa-solid fa-save pe-2"></i>Save</a>
                                        <a type="button" class="btn btn-sm btn-primary rounded text-white" aria-pressed="false" value="edit" aria-label="name: edit" id="editquill"><i class="fa-solid fa-pencil pe-2"></i>Edit</a>
                                    </div>
                                </div>    
                                <div class="row mb-1 align-items-center mt-2">
                                    <label for="message" class="col-sm-2 col-form-label">Term Of Condition</label>
                                    <div class="col-sm-10">
                                        <div id="toolbar" role="toolbar" class="position-relative">
                                            <span class="ql-formats">
                                                <button type="button" class="ql-bold" aria-pressed="false" aria-label="bold"><i class="fa-solid fa-bold"></i></button>
                                                <button type="button" class="ql-italic" aria-pressed="false" aria-label="italic"><i class="fa-solid fa-italic"></i></button>
                                                <button type="button" class="ql-underline" aria-pressed="false" aria-label="underline"><i class="fa-solid fa-underline"></i></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button type="button" class="ql-list" aria-pressed="false" value="ordered" aria-label="list: ordered"><i class="fa-solid fa-list-ol"></i></button>
                                                <button type="button" class="ql-list" aria-pressed="false" value="bullet" aria-label="list: bullet"><i class="fa-solid fa-list-ul"></i></button>
                                            </span>
                                           
                                        </div>  
                                        <div id="message" class="border"></div> 
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled value="0" id="SphSubTotal">
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled id="SphDiscItemTotal" value="0">
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="SphDiscTotal" value="0">
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
                                    <input type="text"class="form-control form-control-sm  input-form hargajual" disabled value="0" id="SphGrandTotal" >
                                </div>     
                            </div>
                        </div> 
                    </div>  
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-edit-penawaran">Simpan</button>
            </div>
        </div>
    </div>
</div>  

<div id="modal-optional"></div>
<script>    

    $('#SphDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment('<?= $project->date ?>'),
        "endDate":  moment('<?= $project->date ?>'),
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    
    $("#SphStore").select2({
        dropdownParent: $('#modal-add-sph .modal-content'),
        placeholder: "Pilih Toko",
        ajax: {
            url: "<?= base_url()?>select2/get-data-store",
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
    $('#SphStore').append(new Option("<?=$store->StoreCode. " - " . $store->StoreName ?>" , "<?=$store->StoreId?>", true, true)).trigger('change');  

    $("#SphAdmin").select2({
        dropdownParent: $('#modal-add-sph .modal-content'),
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
    $('#SphAdmin').append(new Option("<?=$user->code. " - " . $user->username ?>" , "<?=$user->id?>", true, true)).trigger('change');   
        
    var data_detail_item = JSON.parse('<?= JSON_ENCODE($detail,true) ?>');   
    
    var isProcessingSphAddCategory = false;
    add_detail_category = function(el){
        if (isProcessingSphAddCategory) {
            //console.log("project sph cancel load");
            return;
        }  
        isProcessingSphAddCategory = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $("#modal-add-sph").modal("hide"); 
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
                        hargajual: 0,
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
            isProcessingSphAddCategory = false;
            $(el).html(old_text); 
            $("#modal-add-sph").modal("show");
        }); 
    }
 
    $('#modal-select-item').on('hidden.bs.modal', function () {
        if (document.activeElement) {
            document.activeElement.blur();
        }
    });
    var isProcessingSphAddproduk = false;

    $("#btn-add-product").click(function(){
        if (isProcessingSphAddproduk) {
            //console.log("project sph cancel load");
            return;
        }  
        isProcessingSphAddproduk = true; 
        let old_text = $("#btn-add-product").html();
        $("#btn-add-product").html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/select-produk", 
            success: function(data) {  
                isProcessingSphAddproduk = false; 
                $("#btn-add-product").html(old_text);
                
                $("#modal-optional").html(data);
                
                $("#modal-add-sph").modal("hide");  

                $("#modal-select-item").modal("show"); 


                $('#modal-select-item').on('hidden.bs.modal', function () {
                    if (document.activeElement) {
                        document.activeElement.blur();
                    }
                    $("#modal-add-sph").modal("show");  
                    
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
                isProcessingSphAddproduk = false;
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
            if(JSON.stringify(arr1) === JSON.stringify(arr2) && data_detail_item[i]["id"] === data.id ){
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
            $("#modal-add-sph").modal("hide");
            $("#modal-add-sph").blur();
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
                $("#modal-add-sph").modal("show");
            });  
        }else{
            $("#modal-add-sph").modal("hide");
            $("#modal-add-sph").blur();
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
                        load_produk();
                    } catch (error) {
                        Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {   
                $("#modal-add-sph").modal("show");
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
        var total = data_detail_item.reduce((acc, current) => acc + current.hargajual * current.qty, 0);
        var discitem = data_detail_item.reduce((acc, current) => acc + current.disc * current.qty , 0);
        var grandtotal =  total - discitem - $("#SphDiscTotal").val().replace(/[^0-9-]/g, ''); 

        $("#SphSubTotal").val(total.toLocaleString('en-US')) 
        $("#SphDiscItemTotal").val(discitem.toLocaleString('en-US')) 
        $("#SphGrandTotal").val(grandtotal.toLocaleString('en-US')) 
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
                        <div class="col-8 d-md-block d-none">   
                            <div class="row align-items-center">
                                <div class="col-2 px-1"> 
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
                                <div class="col-12 col-md-4 my-1 varian px-0">   
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
                                <div class="col-12 col-md-8 my-1 detail">
                                    <div class="row px-2"> 
                                        <div class="col-2 px-1 d-none d-md-block ">  
                                            <div class="btn-group float-end d-inline-block" role="group">  
                                                ${data_detail_item[i]["id"] == "0" ? `<button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>` : ""}
                                                <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                            </div>
                                        </div>  
                                        <div class="col-12 col-md-2 px-1 ">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty/Satuan</span>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control form-control-sm input-form berat" id="input-qty-${i}" data-id="${i}">
                                                <select class="form-select form-select-sm select-satuan" id="select-satuan-${i}" data-id="${i}" placeholder="Pilih" ${data_detail_item[i]["id"] != "-" ? "disabled" : ""}></select>
                                            </div>  
                                        </div>  
                                        <div class="col-12 col-md-8">  
                                            <div class="row">  
                                                <div class="col-6 col-md-4 px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Harga</span>
                                                    <div class="input-group"> 
                                                        <span class="input-group-text font-std px-1">Rp.</span> 
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block" id="input-harga-${i}" data-id="${i}" ${data_detail_item[i]["id"] != "0" ? "disabled" : ""}>
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
                        numeralDecimalScale:2,
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
                    dropdownParent: $('#modal-add-sph .modal-content'), 
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
                    data_detail_item[$(this).data("id")]["satuantext"]= data.text
                });
                if(data_detail_item[i]["satuan_id"] > 0) $(`#select-satuan-${i}`).append(new Option(data_detail_item[i]["satuantext"] , data_detail_item[i]["satuan_id"], true, true)).trigger('change');  
                if(data_detail_item[i]["id"] === "0")  $(`#select-satuan-${i}`).prop("disabled",false)
                //event harga
                inputharga[i] = new Cleave(`#input-harga-${i}`, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale:0,
                    numeralThousandGroupStyle:"thousand"
                }); 
                inputharga[i].setRawValue(data_detail_item[i]["hargajual"]);
                $(`#input-harga-${i}`).on("keyup",function(){ 
                    data_detail_item[$(this).data("id")]["hargajual"] = inputharga[$(this).data("id")].getRawValue();
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

    var sph_sub_total = new Cleave(`#SphSubTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_disc_item_total = new Cleave(`#SphDiscItemTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_disc_total = new Cleave(`#SphDiscTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_grand_total = new Cleave(`#SphGrandTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    $("#SphDiscTotal").on("keyup",function(){ 
        grand_total_harga();
        if(parseInt($("#SphGrandTotal").val().replace(/[^0-9-]/g, '')) < 0){
            $("#SphDiscTotal").val(0)
            grand_total_harga();
        }
    });
 


    var quill = new Quill('#message',  {
        debug: 'false',
        modules: {
            toolbar: '#toolbar',
        }, 
        theme: "bubble"//'snow'
    }); 
    quill.enable(false);
    quill.root.style.background = '#F7F7F7'; // warna disable
    quill.setContents(JSON.parse(<?= JSON_ENCODE($template->delta)?>));  

    $("#savequill").hide();
    $("#savequillas").hide();
    $("#savequill").click(function(){ 
        if($("#SphFormatFooter").select2("data")[0]["id"] == $("#SphFormatFooter").select2("data")[0]["text"]){
            $.ajax({ 
                dataType: "json",
                method: "POST",
                url: "<?= base_url() ?>action/add-data-template-footer", 
                data:{
                    "name":$("#SphFormatFooter").select2("data")[0]["text"] ,
                    "detail": quill.getSemanticHTML(), 
                    "delta": quill.getContents(), 
                },
                success: function(data) {    
                    //console.log(data); 
                    if(data["status"]===true){     
                        $("#savequill").hide();
                        $("#savequillas").hide();
                        $("#editquill").show();
                        quill.enable(false);
                        quill.root.style.background = '#F7F7F7'; // warna disable    
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
                url: "<?= base_url() ?>action/edit-data-template-footer/" + $("#SphFormatFooter").select2("data")[0]["id"] , 
                data:{
                    "name": $("#SphFormatFooter").select2("data")[0]["text"] ,
                    "detail": quill.getSemanticHTML(), 
                    "delta": quill.getContents(), 
                },
                success: function(data) {    
                    //console.log(data); 
                    if(data["status"]===true){     
                        $("#savequill").hide();
                        $("#savequillas").hide();
                        $("#editquill").show();
                        quill.enable(false);
                        quill.root.style.background = '#F7F7F7'; // warna disable    
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
    $("#savequillas").click(function(){  
        $("#modal-add-sph").modal("hide"); 
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
                            "name": name ,
                            "detail": quill.getSemanticHTML(), 
                            "delta": quill.getContents(), 
                        },
                        success: function(data) {    
                            //console.log(data); 
                            if(data["status"]===true){    
                                $('#SphFormatFooter').append(new Option(data["data"]["name"] ,data["data"]["id"], true, true)).trigger('change');
                                $("#savequill").hide();
                                $("#savequillas").hide();
                                $("#editquill").show();
                                quill.enable(false);
                                quill.root.style.background = '#F7F7F7'; // warna disable    
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
            $("#savequill").hide();
            $("#savequillas").hide();
            $("#editquill").show();
            quill.enable(false);
            quill.root.style.background = '#F7F7F7'; // warna disable
            $("#modal-add-sph").modal("show");
        }); 
    })
    $("#editquill").click(function(){

        $("#editquill").hide();
        $("#savequill").show();
        $("#savequillas").show();
        quill.enable(true);
        quill.root.style.background = '#FFFFFF'; // warna enable

    }) 
    $("#SphFormatFooter").select2({
        dropdownParent: $('#modal-add-sph .modal-content'),
        placeholder: "Pilih Template",
        tags:true,
        ajax: {
            url: "<?= base_url()?>select2/get-data-template-footer",
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
            //console.log('Tag baru ditambahkan:', e.params.data.text);
            quill.setContents(); 
            $("#savequill").show();
            $("#savequillas").hide();
            $("#editquill").hide();
            quill.enable(true);
            quill.root.style.background = '#FFFFFF'; // warna enable
        } else {
            //console.log('select baru ditambahkan:', e.params.data.text); 
            quill.setContents(JSON.parse(data.delta));  
            
            $("#savequill").hide();
            $("#savequillas").hide();
            $("#editquill").show();
        }
    }).on("change", function(e) {   
        //console.log("change");
    });

    $('#SphFormatFooter').append(new Option("<?=$template->name ?>" , "<?=$template->id?>", true, true)).trigger('change'); 
    $("#editquill").show();

    $("#btn-edit-penawaran").click(function(){
        if($("#SphFormatFooter").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Template harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() => $("#SphFormatFooter").select2("open"), 300); 
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
            date: $("#SphDate").data('daterangepicker').startDate.format("YYYY-MM-DD"), 
            date_create: moment().format("YYYY-MM-DD"), 
            time_create: moment().format("HH:m:s"), 
            storeid: $("#SphStore").val(), 
            ref: <?= $project->id ?>, 
            admin: $("#SphAdmin").val(), 
            customerid: <?=$customer->id?>, 
            address: $("#SphAddress").val(), 
            templateid: $("#SphFormatFooter").val(), 
            subtotal: $("#SphSubTotal").val().replace(/[^0-9]/g, ''), 
            discitemtotal: $("#SphDiscItemTotal").val().replace(/[^0-9]/g, ''), 
            disctotal: $("#SphDiscTotal").val().replace(/[^0-9]/g, ''), 
            grandtotal: $("#SphGrandTotal").val().replace(/[^0-9]/g, '')
        }
        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){  
            if(data_detail_item[i]["type"] == "product"){ 
                detail.push({
                    produkid: data_detail_item[i]["id"], 
                    text: data_detail_item[i]["text"],
                    type: data_detail_item[i]["type"], 
                    satuan_id: data_detail_item[i]["satuan_id"], 
                    satuantext: data_detail_item[i]["satuantext"],
                    qty: data_detail_item[i]["qty"], 
                    harga: data_detail_item[i]["hargajual"], 
                    disc: data_detail_item[i]["disc"], 
                    total: data_detail_item[i]["total"], 
                    group: data_detail_item[i]["group"], 
                    varian: data_detail_item[i]["varian"], 
                });
            }else{
                detail.push({
                    produkid: data_detail_item[i]["id"], 
                    text: data_detail_item[i]["text"],
                    type: data_detail_item[i]["type"], 
                    satuan_id: "", 
                    satuantext: "", 
                    qty: 0,
                    harga: 0, 
                    disc: 0, 
                    total: 0, 
                    group: "", 
                    varian: [], 
                });
            }
        }
 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-penawaran/<?= $project->id ?>", 
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
                        $("#modal-add-sph").modal("hide");  
                        loader_data_project(<?= $project->ref ?>,"penawaran") 
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