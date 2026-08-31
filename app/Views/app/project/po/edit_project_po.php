 
<div class="modal fade" id="modal-edit-po" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-edit-po-label" style="overflow-y:auto;" data-menu="project">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-edit-po-label">Edit PO Vendor</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-lg-6 col-12 my-1 mb-2">
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
                                <label for="POAddress" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="POCustName" type="text" value="<?= $project->POCustName?>"/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="POAddress" class="col-sm-3 col-form-label">Telp Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="POCustTelp"  type="text" value="<?= $project->POCustTelp ?>"/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="POAddress" class="col-sm-3 col-form-label">Alamat Project</label>
                                <div class="col-sm-9">
                                    <textarea  class="form-control form-control-sm input-form" id="POAddress"><?= $project->POAddress ?></textarea>
                                </div>
                            </div>  
                        </div>  
                    </div>  
                    
                    <div class="col-lg-6 col-12 my-1 mb-2">    
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
                                <label for="POCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                                <div class="col-sm-10">
                                    <input id="POCode" name="POCode" type="text" class="form-control form-control-sm input-form" value="<?= $project->POCode ?>" disabled>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="PORef" class="col-sm-2 col-form-label">Referensi</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="PORef" name="PORef" placeholder="Pilih Referensi" style="width:100%">
                                        <option value="0" selected>-</option>
                                    </select>  
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="PODate" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input id="PODate" name="PODate" type="text" class="form-control form-control-sm input-form" value="">
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="POAdmin" class="col-sm-2 col-form-label">Admin</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="POAdmin" name="POAdmin" placeholder="Pilih Admin" style="width:100%"></select>  
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="POVendor" class="col-sm-2 col-form-label">Vendor</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-sm">  
                                        <select class="form-select form-select-sm" id="POVendor" name="POVendor" placeholder="Pilih Vendor" style="width:90%"></select>  
                                        <button class="btn btn-primary btn-sm" type="button" style="width:10%" onclick="vendor_add()" disabled> 
                                            <i class="ti-plus"></i> 
                                        </button>
                                    </div>
                                </div>
                            </div>  
                        </div>   
                    </div>    
                </div>  
                <div class="row mx-2 my-3 align-items-center head-ref mt-3" style="display:none">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Detail dari referensi</span>  
                        <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" id="action-ref-show" type="button" style="position:absolute;top: -11px;right: -5px;font-size: 0.6rem;display:none;">
                            <i class="fas fa-eye"></i>
                            <span class="fw-bold">
                                &nbsp;show
                            </span>
                        </button> 
                        <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" id="action-ref-hide" type="button" style="position:absolute;top: -11px;right: -5px;font-size: 0.6rem">
                            <i class="fas fa-eye"></i>
                            <span class="fw-bold">
                                &nbsp;Hide
                            </span>
                        </button> 
                    </div>
                </div>  
               
                <div class="card detail-ref head-ref" style="min-height:50px;display:none">
                    <div class="card-body p-2 bg-light">    
                        <div class="row align-items-center d-none d-md-flex px-3">
                            <div class="col-12 col-md-6 my-1">    
                                <div class="row">  
                                    <div class="col-12"> 
                                        <span class="label-head-dialog">Deskripsi</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 my-1 ">
                                <div class="row">  
                                    <div class="col-12">
                                        <div class="row"> 
                                            <div class="col-3">
                                                <span class="label-head-dialog">Qty</span> 
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Harga</span>  
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Disc</span>  
                                            </div>
                                            <div class="col-3">
                                                <span class="label-head-dialog">Total</span>  
                                            </div>
                                        </div> 
                                    </div>  
                                </div>
                            </div> 
                        </div> 
                        <div id="tb_varian_ref" class="text-center"> 
                        </div>  
                    </div>
                </div> 
                <script>
                    $("#action-ref-show").click(function(){
                        $(".detail-ref").slideDown("slow");
                        $("#action-ref-show").hide();
                        $("#action-ref-hide").show();
                    })
                    $("#action-ref-hide").click(function(){
                        $(".detail-ref").slideUp();
                        $("#action-ref-hide").hide();
                        $("#action-ref-show").show();
                    })
                </script>
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Detail Produk</span> 
                    </div>
                </div>     
                <div class="card " style="min-height:50px;">
                    <div class="card-body p-0 bg-light" > 
                        <div class="row align-items-center d-none d-md-flex px-3">
                            <div class="col-12 col-md-6 my-1">    
                                <div class="row">  
                                    <div class="col-12"> 
                                        <span class="label-head-dialog">Deskripsi</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 my-1">
                                <div class="row">  
                                    <div class="col-4"> 
                                        <span class="label-head-dialog">Qty | Satuan</span>   
                                    </div> 
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="label-head-dialog">Harga</span>   
                                            </div>  
                                            <div class="col-6"> 
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
                                <div class="dropdown text-end"> 
                                    <button class="btn btn-sm btn-primary my-2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-plus pe-2"></i>Tambah Produk</button>  
                                    <ul class="dropdown-menu shadow">
                                        <li><a class="dropdown-item m-0 px-2 " id="btn-add-product-manual"><i class="fa-solid fa-plus pe-2 text-primary"></i>Manual Produk</a></li> 
                                        <li><a class="dropdown-item m-0 px-2 " id="btn-add-product"><i class="fa-solid fa-magnifying-glass pe-2 text-primary"></i>Cari Produk</a></li> 
                                    </ul>
                                </div> 
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
                    </div>  
                    <div class="col-12 col-md-4 px-3 order-1 order-md-2"> 
                        <div class="row align-items-center py-1 mt-3">
                            <div class="col-4">
                                <span class="label-head-dialog">Sub Total</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled value="0" id="POSubTotal">
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="PODiscTotal" value="0">
                                </div>     
                            </div>
                        </div> 
                        <div class="row align-items-center py-1 d-none">
                            <div class="col-4">
                                <span class="label-head-dialog">PPN</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="POPPHTotal" value="0">
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
                                    <input type="text"class="form-control form-control-sm  input-form hargajual" disabled value="0" id="POGrandTotal" >
                                </div>     
                            </div>
                        </div> 
                    </div>  
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-edit-po">Simpan</button>
            </div>
        </div>
    </div>
</div>  

<div id="modal-optional"></div>
<script>    
    $('#PODate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment('<?= $project->PODate ?>'),
        "endDate":  moment('<?= $project->PODate ?>'), 
        dropdownParent: $('#modal-edit-po .modal-content'), 
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    $("#PORef").select2({
        dropdownParent: $('#modal-edit-po .modal-content'),
        placeholder: "Pilih Toko",
        ajax: {
            url: "<?= base_url()?>select2/get-data-ref-vendor/<?= $project->POId?>",
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
            if ($(data.html).length === 0) {
                return data.text;
            }
            return data['text'];
        }
    }); 
    function template_select_vendor(data){  
        data_vendor = [];
        for(var i = 0;data.length > i;i++){
            data_vendor.push({
                "id" : data[i].VendorId,
                "text" : data[i].VendorCode + " - " + data[i].VendorName,
                "html" : data[i].VendorCode + " - " + data[i].VendorName,
                "code" : data[i].VendorCode,
                "name" : data[i].VendorName,  
            }) 
        }
        $("#POVendor").select2({
            dropdownParent: $('#modal-edit-po .modal-content'),
            placeholder: "Pilih Toko",
            data: data_vendor,
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
                if ($(data.html).length === 0) {
                    return data.text;
                }
                return data['text'];
            }   
        });
    }
    $("#PORef").on("select2:select", function(e) {  
        var data = e.params.data;     
        $('#POVendor').select2('destroy');
        $('#POVendor').empty();    
        template_select_vendor(data.vendor); 
        data_detail_item = [];
        (data.detail_item.length > 0 ? $("#btn-add-product").hide() :   $("#btn-add-product").show());
        for(var i = 0;data.detail_item.length >i;i++){
            if(data.detail_item[i].type == "product"){
                data_detail_item.push({
                    "varian" : data.detail_item[i].varian,
                    "produkid" : data.detail_item[i].produkid,
                    "text" : data.detail_item[i].text,
                    "satuan_id" : data.detail_item[i].satuan_id,
                    "satuan_text" : data.detail_item[i].satuan_text, 
                    "qty" : data.detail_item[i].qty,  
                    "group" : data.detail_item[i].group, 
                    "harga" : data.detail_item[i].harga, 
                    "total" : data.detail_item[i].total,
                }) 
            }
        } 
        load_produk();
    }) 
    template_select_vendor({"VendorId": "<?=$project->VendorId?>","VendorName" : "<?=$project->VendorName?>"});  

    $('#PORef').append(new Option("<?= $project->PORefCode ?>" , "<?= $project->PORef ?>", true, true)).trigger('change');   


    $('#PORef').attr("disabled",true);

    $("#POStore").select2({
        dropdownParent: $('#modal-edit-po .modal-content'),
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

    $("#POAdmin").select2({
        dropdownParent: $('#modal-edit-po .modal-content'),
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
    $('#POAdmin').append(new Option("<?=$user->code. " - " . $user->username ?>" , "<?=$user->id?>", true, true)).trigger('change');   
    $('#POAdmin').attr("disabled",true);

    $('#POVendor').append(new Option("<?=$project->VendorName?>" , "0", true, true)).trigger('change');  
    $('#POVendor').attr("disabled",true);

    var data_detail_item =  JSON.parse('<?= JSON_ENCODE($detail,true) ?>'); 
    
    var isProcessingSphAddCategory = false;
    add_detail_category = function(el){
        data_detail_item.push({
            type: "category",
            text: "Kategori",
            qty: 0,
            price: 0,
            disc: 0,
            total: 0, 
            varian: [], 
        });
        load_produk();
        // if (isProcessingSphAddCategory) {
        //     console.log("project sph cancel load");
        //     return;
        // }  
        // isProcessingSphAddCategory = true; 
        // let old_text = $(el).html();
        // $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        // $("#modal-add-sph").modal("hide"); 
        // Swal.fire({
        //     title: 'Tambah Kategori',
        //     input: 'text',
        //     buttonsStyling: false,
        //     showCancelButton: true,
        //     showCancelButton: true,
        //     customClass: {
        //         confirmButton: 'btn btn-primary mx-1',
        //         cancelButton: 'btn btn-secondary mx-1',
        //         loader: 'custom-loader',
        //         input: 'form-control form-control-sm w-auto input-form', // Tambahkan kelas pada input
        //     },
        //     backdrop: true,
        //     confirmButtonText: "Simpan",
        //     loaderHtml: '<div class="spinner-border text-primary"></div>',
        //     preConfirm: async (name) => {
        //         try {  
        //             data_detail_item.push({
        //                 type: "category",
        //                 text: name,
        //                 qty: 0,
        //                 price: 0,
        //                 disc: 0,
        //                 total: 0, 
        //                 varian: [], 
        //             });
        //             load_produk();
        //         } catch (error) {
        //             Swal.showValidationMessage(`Request failed: ${error["responseJSON"]['message']}`);
        //         }
        //     },
        //     allowOutsideClick: () => !Swal.isLoading()
        // }).then((result) => {  
        //     isProcessingSphAddCategory = false;
        //     $(el).html(old_text); 
        //     $("#modal-add-sph").modal("show");
        // }); 
    }
 
    $('#modal-select-item').on('hidden.bs.modal', function () {
        if (document.activeElement) {
            document.activeElement.blur();
        }
    });
    var isProcessingPOAddproduk = false;

    $("#btn-add-product").click(function(){
        if (isProcessingPOAddproduk) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPOAddproduk = true; 
        let old_text = $("#btn-add-product").html();
        $("#btn-add-product").html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/select-produk", 
            success: function(data) {  
                isProcessingPOAddproduk = false; 
                $("#btn-add-product").html(old_text);
                
                $("#modal-optional").html(data);
                
                $("#modal-edit-po").modal("hide");  
                $("#modal-select-item").modal("show"); 

                $("#modal-select-item").data("type","buy"); 
                $("#select-" + $("#POVendor").select2("data")[0]["code"]).attr("checked",true).trigger("change");
                $('#modal-select-item').on('hidden.bs.modal', function () {
                    if (document.activeElement) {
                        document.activeElement.blur();
                    }
                    $("#modal-edit-po").modal("show");  
                    
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
                isProcessingPOAddproduk = false;
                $("#btn-add-product").html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    });
    $("#btn-add-product-manual").click(function(){
        data_detail_item.push({
            "id": 0,
            "produkid": 0,
            "varian": [],
            "text" : "produk",
            "group" : "", 
            "berat": 0,
            "satuan_id": 0,
            "satuan_text": "",
            "pcsM2": "",  
            "price":0,
            "disc": 0,
            "qty":  1,
            "total": 0,
            "type" :"product"
        });
        load_produk();
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
        console.log(data);
        data_detail_item.push(data)
        load_produk();

        $('#modal-select-item').modal("hide");   
    }

    
    edit_varian_click = function(index){ 
        if(data_detail_item[index]["id"] == 0 || data_detail_item[index]["type"] == "category"){ 
            $("#text-custom-" + index).show();
            $("#span-custom-" + index).hide();
            $(".btn-action.detail[data-id='"+ index +"'][data-type='edit']").hide();
            $(".btn-action.detail[data-id='"+ index +"'][data-type='save']").show(); 
        }
        $("#text-custom-" + index).on('input', function() {  
            $(this).height('auto');
            $(this).height(this.scrollHeight);
        }).on('focusout', function() {  
            save_varian_click(index)
        }); 
    }
    save_varian_click = function(index){  
        var data_value = $("#text-custom-" + index).val();
        $("#span-custom-" + index).html(data_value.replaceAll(/\n/g, '<br>'));
        $("#text-custom-" + index).hide();
        $("#span-custom-" + index).show();
        $(".btn-action.detail[data-id='"+ index +"'][data-type='edit']").show();
        $(".btn-action.detail[data-id='"+ index +"'][data-type='save']").hide();
 
        data_detail_item[index]["text"] = $("#text-custom-" + index).val();
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
        var total = data_detail_item.reduce((acc, current) => acc + current.total * current.qty, 0);
        var discitem = data_detail_item.reduce((acc, current) => acc + current.disc * current.qty , 0);
        var grandtotal =  total - discitem - $("#PODiscTotal").val().replace(/[^0-9-]/g, ''); 

        $("#POSubTotal").val(total.toLocaleString('en-US')) 
        $("#PODiscItemTotal").val(discitem.toLocaleString('en-US')) 
        $("#POGrandTotal").val(grandtotal.toLocaleString('en-US')) 
    }
    load_produk_ref = function(data_detail){
        var html = '';
        if(data_detail.length == 0){
            html += `<div class="d-flex justify-content-center flex-column align-items-center"> 
                        <img src="<?= base_url()?>assets/images/empty.png" alt="" style="width:150px;height:150px;">
                        <span class="text-head-1">Item belum ditambahkan</span>
                    </div>`;  
        }
        let last_group_abjad = 65;
        let last_group_no = 1;
        for(var i = 0; data_detail.length > i;i++){  
            var varian = ""; 
            varian = `  <span class="text-detail-2 text-truncate">${data_detail[i]["group"]}</span> 
                        <div class="d-flex gap-1">`;
            var return_item = false;
            for(var j = 0; data_detail[i]["varian"].length > j;j++){

                varian += `<span class="badge badge-${j % 5}">${data_detail[i]["varian"][j]["varian"] + ": " + data_detail[i]["varian"][j]["value"]}</span>`; 
                // if( data_detail[i]["varian"][j]["value"] == $("#POVendor").select2("data")[0].code){
                //     return_item = true;
                // } 
            } 
            // if(!return_item){
            //     data_detail[i]["visible"] = false;
            // }else{
            //     data_detail[i]["visible"] = true;
            // }
            

            varian +=  '</div>'; 

            html += `   <div class="row align-items-center ${i > 0 ? "border-top mt-1 pt-1" : ""} mx-1">
                            <div class="col-12 col-md-6 my-1 varian px-0">   
                                <div class="d-flex">
                                    <span class="no-urut text-head-3">${last_group_no}.</span> 
                                    <div class="d-flex flex-column text-start flex-fill">
                                        <span class="text-head-3">${data_detail[i]["text"]}</span>
                                        ${varian} 
                                    </div>  
                                    <div class="btn-group d-inline-block d-md-none float-end" role="group">  
                                        ${data_detail[i]["id"] == "0" ? `<button class="btn btn-sm btn-warning btn-action p-2 py-1 rounded" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>` : ""}
                                        <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 my-1 detail">
                                <div class="row px-2">  
                                    <div class="col-12 col-md-12 px-1">   
                                        <div class="row">  
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty/Satuan</span> 
                                                <span class="font-std px-1">${data_detail[i]["qty"]} ${data_detail[i]["satuan_text"]}</span>   
                                            </div>   
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Harga</span>  
                                                <span class="font-std px-1">${rupiah(data_detail[i]["price"])}</span>   
                                            </div> 
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Disc</span>  
                                                <span class="font-std px-1">${rupiah(data_detail[i]["disc"])}</span>   
                                            </div> 
                                            <div class="col-6 col-md-3 px-1 ">  
                                                <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Total</span>  
                                                <span class="font-std px-1">${rupiah(data_detail[i]["total"])}</span>   
                                            </div> 
                                        </div>   
                                    </div>   
                                </div>    
                            </div>    
                        </div> `;

            
            last_group_no++;  
        }
        
        $("#tb_varian_ref").html(html); 
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
            var data_value = data_detail_item[i]["text"];
            if(data_detail_item[i]["type"] == "category"){ 
                html += `
                    <div class="row align-items-center mx-0 hr p-2">
                        <div class="col-12 col-md-6 px-0">      
                            <div class="d-flex">   
                                <span class="no-urut text-head-3 order-md-2 order-1 p-2">${String.fromCharCode(last_group_abjad)}. </span>  
                                <div class="d-flex flex-column text-start flex-fill order-md-3 order-2 justify-content-center">
                                    <span class="text-head-3" onclick="edit_varian_click(${i})" id="span-custom-${i}" data-id="${i}">${data_value.replaceAll(/\n/g, '<br>')}</span>
                                    <textarea class="custom-input" id="text-custom-${i}" data-id="${i}" style="display:none" rows="1">${data_detail_item[i]["text"]}</textarea> 
                                </div>  
                                <div class="px-0 order-md-1 order-3"> 
                                    <div class="btn-group d-inline-block" role="group"> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button> 
                                        <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                        <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button> 
                                        <button class="btn btn-sm btn-warning btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="edit" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-success btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="save" onclick="save_varian_click(${i})" style="display:none"><i class="fa-solid fa-check"></i></button>
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
                html += `   <div class="row align-items-center mx-0 hr p-2">
                                <div class="col-12 col-md-6 my-1 varian px-0">   
                                    <div class="d-flex">
                                        <div class="px-0 order-md-1 order-4"> 
                                            <div class="btn-group d-inline-block" role="group"> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="down_varian_click(${i})"><i class="fa-solid fa-arrow-down"></i></button> 
                                                <button class="btn btn-sm btn-primary btn-action p-2 py-1 rounded" onclick="up_varian_click(${i})"><i class="fa-solid fa-arrow-up"></i></button>  
                                                <button class="btn btn-sm btn-danger btn-action p-2 py-1 rounded" onclick="delete_varian_click(${i})"><i class="fa-solid fa-close"></i></button>
                                                <button class="btn btn-sm btn-warning btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="edit" onclick="edit_varian_click(${i})"><i class="fa-solid fa-pencil"></i></button>
                                                <button class="btn btn-sm btn-success btn-action detail p-2 py-1 rounded" data-id="${i}" data-type="save" onclick="save_varian_click(${i})" style="display:none"><i class="fa-solid fa-check"></i></button>
                                            </div>
                                        </div> 
                                        <span class="no-urut text-head-3 order-md-2 order-1 p-2">${last_group_no}. </span> 
                                        <div class="d-flex pe-2 order-md-3 order-2 ${data_detail_item[i]["id"] == "0" ? "d-none" : ""}">
                                            <img src="${data_detail_item[i]["image_url"]}" alt="Gambar" class="image-produk-doc"> 
                                        </div> 
                                        <div class="d-flex flex-column text-start flex-fill order-md-4 order-3 justify-content-center">
                                            <span class="text-head-3 span-custom-input" onclick="edit_varian_click(${i})" id="span-custom-${i}" data-id="${i}">${data_value.replaceAll(/\n/g, '<br>')}</span>
                                            <textarea class="custom-input" id="text-custom-${i}" data-id="${i}" style="display:none" rows="1">${data_detail_item[i]["text"]}</textarea>
                                            ${varian} 
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 my-1 detail">
                                    <div class="row px-2">  
                                        <div class="col-12 col-md-4 px-1 ">  
                                            <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Qty/Satuan</span>
                                            <div class="input-group"> 
                                                <input type="text" class="form-control form-control-sm input-form berat" id="input-qty-${i}" data-id="${i}">
                                                <select class="form-select form-select-sm select-satuan" id="select-satuan-${i}" data-id="${i}" placeholder="Pilih" ${data_detail_item[i]["id"] != "-" ? "" : ""}></select>
                                            </div>  
                                        </div>  
                                        <div class="col-12 col-md-8">  
                                            <div class="row">  
                                                <div class="col-12 col-md-6 px-1">  
                                                    <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2 pt-2 float-start">Harga</span>
                                                    <div class="input-group"> 
                                                        <span class="input-group-text font-std px-1">Rp.</span> 
                                                        <input type="text"class="form-control form-control-sm  input-form d-inline-block" id="input-harga-${i}" data-id="${i}" ${data_detail_item[i]["id"] != "0" ? "" : ""}>
                                                    </div>    
                                                </div>  
                                                <div class="col-12 col-md-6 px-1">  
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
        var inputdeskripsi = [];
        var inputqty = [];
        var inputharga = [];
        var inputdisc = [];
        var inputtotal = [];
        for(var i = 0; data_detail_item.length > i;i++){
            if(data_detail_item[i]["type"] == "product"){

                function total_harga(id){
                    var total =  inputharga[id].getRawValue()  * inputqty[id].getRawValue();
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
                    dropdownParent: $('#modal-edit-po .modal-content'), 
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
                // inputdisc[i] = new Cleave(`#input-disc-${i}`, {
                //     numeral: true,
                //     delimeter: ",",
                //     numeralDecimalScale:0,
                //     numeralThousandGroupStyle:"thousand"
                // }); 
                // inputdisc[i].setRawValue(data_detail_item[i]["disc"]);
                // $(`#input-disc-${i}`).on("keyup",function(){ 
                //     var nilaiSaatIni = parseInt(inputdisc[$(this).data("id")].getRawValue());
                //     var maksvalue = parseInt(inputharga[$(this).data("id")].getRawValue());
                //     if (nilaiSaatIni > maksvalue) { 
                //         inputdisc[$(this).data("id")].setRawValue(maksvalue);
                //     } 
                //     data_detail_item[$(this).data("id")]["disc"] = inputdisc[$(this).data("id")].getRawValue(); 

                //     if($(`#input-disc-${i}`).val() == "") $(`#input-disc-${i}`).val(0) 
                //     total_harga($(this).data("id")); 
                // });  

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

    var data_detail_ref = JSON.parse('<?= JSON_ENCODE($detailref,true) ?>'); 
    if(data_detail_ref.length > 0){
        load_produk_ref(data_detail_ref);
        $(".head-ref").show();
    }
    var sph_sub_total = new Cleave(`#POSubTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_disc_item_total = new Cleave(`#POPPHTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_disc_total = new Cleave(`#PODiscTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var sph_grand_total = new Cleave(`#POGrandTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    $("#POPPHTotal").on("keyup",function(){ 
        grand_total_harga();
        if(parseInt($("#POGrandTotal").val().replace(/[^0-9-]/g, '')) < 0){
            $("#POPPHTotal").val(0)
            grand_total_harga();
        }
    }); 
    $("#PODiscTotal").on("keyup",function(){ 
        grand_total_harga();
        if(parseInt($("#POGrandTotal").val().replace(/[^0-9-]/g, '')) < 0){
            $("#PODiscTotal").val(0)
            grand_total_harga();
        }
    });  
    grand_total_harga = function(){
        var total = data_detail_item.reduce((acc, current) => { 
            return acc + current.price * current.qty; 
        },0); 
        var grandtotal =  total - $("#PODiscTotal").val().replace(/[^0-9-]/g, ''); 

        $("#POSubTotal").val(total.toLocaleString('en-US'))  
        $("#POGrandTotal").val(grandtotal.toLocaleString('en-US')) 
    }
    grand_total_harga();


    var quill = [];  
    $(".template-footer").each(function(index, el){
        var message = $(el).find("[name='EditFooterMessage']")[0];
        var type = "pembelian"; 
        quill[type] = new Quill(message,  {
            debug: 'false',
            modules: {
                toolbar: [['bold', 'italic', 'underline', 'strike'],[{ 'list': 'ordered'}]],
            },  
            theme: "bubble"//'snow'
        }); 
        quill[type].enable(false);
        quill[type].root.style.background = '#F7F7F7'; // warna disable  
        quill[type].setContents(JSON.parse(<?= JSON_ENCODE($project->TemplateFooterDelta)?>));  

        const btnsaveas = $(el).find("a[value='simpanAs']")[0];
        const btnsave = $(el).find("a[value='simpan']")[0];
        const btnedit = $(el).find("a[value='edit']")[0];
        const selectoption = $(el).find("select")[0];

        $(btnsave).hide();
        $(btnsaveas).hide();
        $(btnedit).hide();
 
        $(selectoption).select2({
            dropdownParent: $('#modal-edit-po .modal-content'),
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
        $(selectoption).append(new Option("<?=$project->TemplateFooterName ?>" , "<?=$project->TemplateFooterId?>", true, true)).trigger('change'); 
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
            $("#modal-edit-po").modal("hide"); 
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
                $("#modal-edit-po").modal("show");
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

    $("#btn-edit-po").click(function(){
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
        
        if($("#POVendor").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Vendor harus diinput...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close(); 
                setTimeout(function(){  
                    // $("#POVendor").select2("open")
                } , 500); 
            }) ;
            return; 
        }
        if(data_detail_item.length == 0){
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
        if(data_detail_item.some((item) => item.satuan_id === "0") == true){
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
            PODate: $("#PODate").data('daterangepicker').startDate.format("YYYY-MM-DD"),    
            VendorId: ($("#POVendor").select2("data")[0]["text"] == $("#POVendor").select2("data")[0]["id"] ? 0 : $("#POVendor").val()), 
            VendorName: $("#POVendor").select2("data")[0]["text"], 
            POAdmin: $("#POAdmin").val(),  
            TemplateId: $($(".template-footer").find("select")[0]).val(), 
            POSubTotal: $("#POSubTotal").val().replace(/[^0-9]/g, ''), 
            POPPNTotal: $("#POPPHTotal").val().replace(/[^0-9]/g, ''), 
            PODiscTotal: $("#PODiscTotal").val().replace(/[^0-9]/g, ''), 
            POGrandTotal: $("#POGrandTotal").val().replace(/[^0-9]/g, '')
        }
        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){   
            detail.push({
                ProdukId: data_detail_item[i]["produkid"], 
                PODetailText: data_detail_item[i]["text"],
                PODetailSatuanId: data_detail_item[i]["satuan_id"], 
                PODetailSatuanText: data_detail_item[i]["satuan_text"],
                PODetailQty: data_detail_item[i]["qty"], 
                PODetailPrice: data_detail_item[i]["price"],  
                PODetailTotal: data_detail_item[i]["total"], 
                PODetailGroup: data_detail_item[i]["group"], 
                PODetailVarian: data_detail_item[i]["varian"], 
                PODetailType: data_detail_item[i]["type"], 
            }); 
        }
 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/edit-data-po/<?=$project->POId?>", 
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
                        $("#modal-edit-po").modal("hide");    
                        if($("#modal-edit-po").data("menu") =="pembelian"){
                            loader_datatable(); 
                        }else{ 
                            loader_data_project(<?= $project->ProjectId ?>,"pembelian");  
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