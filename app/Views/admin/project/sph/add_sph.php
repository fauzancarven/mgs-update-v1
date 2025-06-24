 
<div class="modal fade" id="modal-add-penawaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-add-penawaran-label" style="overflow-y:auto;" data-menu="project">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-penawaran-label">Tambah Penawaran</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3"> 
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
                                <label for="CustomerId" class="col-sm-3 col-form-label">Customer</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" style="width:100%" id="CustomerId"></select>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphAddress" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="SphCustName" type="text" value="" disabled/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphAddress" class="col-sm-3 col-form-label">Telp Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="SphCustTelp"  type="text" value="" disabled/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphAddress" class="col-sm-3 col-form-label">Alamat Project</label>
                                <div class="col-sm-9">
                                    <textarea  class="form-control form-control-sm input-form" id="SphAddress"  disabled></textarea>
                                </div>
                            </div> 
                        </div>  
                    </div>  
                    <div class="col-lg-6 col-12 my-1 mb-3 mb-md-1">   
                        <div class="row mx-2 align-items-center">
                            <div class="label-border-right">
                                <span class="label-dialog">Document</span>
                                <button class="btn btn-primary btn-sm py-1 me-1 rounded-pill" type="button" style="position:absolute;top: -11px;right: 10px;font-size: 0.6rem;" onclick="togglecustom('document-display',this)">
                                    <span>Sembunyikan</span>
                                    <i class="fa-solid fa-angle-up"></i> 
                                </button> 
                            </div>
                        </div>  
                        <div class="document-display card bg-light show mt-4 m-1 p-2"> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                                <div class="col-sm-10">
                                    <input id="SphCode" name="SphCode" type="text" class="form-control form-control-sm input-form" value="(auto)" disabled>
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="ProjectId" class="col-sm-2 col-form-label">Project</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" style="width:100%" id="ProjectId"></select>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="StoreId" class="col-sm-2 col-form-label">Toko</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" style="width:100%" id="StoreId"></select>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="SphRef" class="col-sm-2 col-form-label">Ref</label>
                                <div class="col-sm-10"> 
                                    <select class="form-select form-select-sm" id="SphRef" name="SphRef"  style="width:100%" >
                                        <option value="0" selected data-type="-">No Data Selected</option>
                                    </select>  
                                </div> 
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="SphDate" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input id="SphDate" name="SphDate" type="text" class="form-control form-control-sm input-form" value="">
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="SphAdmin" class="col-sm-2 col-form-label">Admin</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="SphAdmin" name="SphAdmin" placeholder="Pilih Admin" style="width:100%"></select>  
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="SphDelivery" class="col-sm-2 col-form-label">Pengiriman</label>
                                <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="SphDelivery" id="SphDelivery1" value="0">
                                    <label class="text-detail" for="SphDelivery1">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="SphDelivery" id="SphDelivery2" value="1" checked>
                                    <label class="text-detail" for="SphDelivery2">Ya</label>
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
                                <span class="label-head-dialog">Pengiriman</span>   
                            </div>
                            <div class="col-8"> 
                                <div class="input-group"> 
                                    <span class="input-group-text font-std">Rp.</span>
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="SphDeliveryTotal" value="0">
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
                <button type="button" class="btn btn-primary" id="btn-add-penawaran">Simpan</button>
            </div>
        </div>
    </div>
</div>  

<div id="modal-optional"></div>
<script>    
    togglecustom = function(cls,el){
        if($("." + cls).hasClass("show")){
            $("." + cls).removeClass("show")
            $("." + cls).slideUp()
            $(el).find("i").addClass("fa-rotate-180")
            $(el).find("span").html("Tampilkan")
        }else{
            $("." + cls).addClass("show")
            $("." + cls).slideDown()
            $(el).find("i").removeClass("fa-rotate-180")
            $(el).find("span").html("Sembunyikan")
        }
    }
    $('#SphDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment(),
        "endDate":  moment(),
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    
    $('input[name="SphDelivery"]').change(function() {
        if($(this).val() == 0){
            $('#SphDeliveryTotal').prop("disabled",true)
            $('#SphDeliveryTotal').val("0")
        }else{

            $('#SphDeliveryTotal').prop("disabled",false)
        }
    });
    $("#SphRef").select2({
        dropdownParent: $('#modal-add-penawaran .modal-content'),
        placeholder: "Pilih dokument referensi",
        ajax: {
            url: "<?= base_url()?>select2/get-data-ref-sph",
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

    $("#CustomerId").select2({
        dropdownParent: $('#modal-add-penawaran .modal-content'),
        placeholder: "Pilih Pelanggan",
        ajax: {
            url: "<?= base_url()?>select2/get-data-customer",
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
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"customer_add()\">Tambah Customer Baru</button>");
            }
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
    }).on("select2:select", function(e) {
        var data = e.params.data;  
        if(data.id !== 0){   
            $('#SphCustName').val(data.customername);
            $('#SphCustTelp').val(data.customertelp);
            $('#SphAddress').val(data.customeraddress); 
            $("#SphCustName").attr("disabled",false);
            $("#SphCustTelp").attr("disabled",false);
            $("#SphAddress").attr("disabled",false);
        }else{
            $("#SphCustName").attr("disabled",true);
            $("#SphCustTelp").attr("disabled",true);
            $("#SphAddress").attr("disabled",true);

        }
    });

    $("#ProjectId").select2({
        dropdownParent: $('#modal-add-penawaran .modal-content'),
        placeholder: "Pilih Project",
        ajax: {
            url: "<?= base_url()?>select2/get-data-project",
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
                return $("<button class=\"btn btn-sm btn-primary\" onclick=\"customer_add()\">Tambah Customer Baru</button>");
            }
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
        
    }).on("select2:select", function(e) {
        var data = e.params.data;  
        if(data.id == 0){ 
            $("#StoreId").attr("disabled",false);  
            $("#CustomerId").attr("disabled",false);
        } else{
            $("#StoreId").attr("disabled",true);
            $("#CustomerId").attr("disabled",true);
            $('#StoreId').append(new Option(data.store , data.storeid, true, true)).trigger('change');   
            $('#CustomerId').append(new Option(data.customer , data.customerid, true, true)).trigger('change');
            $('#SphCustName').val(data.customername);
            $('#SphCustTelp').val(data.customertelp);
            $('#SphAddress').val(data.customeraddress);

        }
    }); 
    $('#ProjectId').append(new Option("Tidak ada yang dipilih" , 0, true, true)).trigger('change');   

    $("#StoreId").select2({
        dropdownParent: $('#modal-add-penawaran .modal-content'),
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

    $("#SphAdmin").select2({
        dropdownParent: $('#modal-add-penawaran .modal-content'),
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
      
 
    var data_detail_item = [];
    
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

        // $("#modal-add-penawaran").modal("hide"); 
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
        //     $("#modal-add-penawaran").modal("show");
        // }); 
    }
 
    $('#modal-select-item').on('hidden.bs.modal', function () {
        if (document.activeElement) {
            document.activeElement.blur();
        }
    });
    var isProcessingSphAddproduk = false;

    $("#btn-add-product").click(function(){
        if (isProcessingSphAddproduk) {
            console.log("project sph cancel load");
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
                
                $("#modal-add-penawaran").modal("hide");  

                $("#modal-select-item").modal("show"); 


                $('#modal-select-item').on('hidden.bs.modal', function () {
                    if (document.activeElement) {
                        document.activeElement.blur();
                    }
                    $("#modal-add-penawaran").modal("show");  
                    
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
        var total = data_detail_item.reduce((acc, current) => acc + current.price * current.qty, 0);
        var discitem = data_detail_item.reduce((acc, current) => acc + current.disc * current.qty , 0);
        var grandtotal =  total - discitem - $("#SphDiscTotal").val().replace(/[^0-9-]/g, '') + parseInt($("#SphDeliveryTotal").val().replace(/[^0-9-]/g, ''));  

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
        var inputdeskripsi = [];
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
                    dropdownParent: $('#modal-add-penawaran .modal-content'), 
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
    var sph_delivery = new Cleave(`#SphDeliveryTotal`, {
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
    
    $("#SphDeliveryTotal").on("keyup",function(){ 
        grand_total_harga(); 
    });
    
 

    var quill = [];  
    $(".template-footer").each(function(index, el){
        var message = $(el).find("[name='EditFooterMessage']")[0];
        var type = "penawaran"; 
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
            dropdownParent: $('#modal-add-penawaran .modal-content'),
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
            $("#modal-add-penawaran").modal("hide"); 
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
                $("#modal-add-penawaran").modal("show");
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
    var isProcessingCustomerAdd 
    function customer_add(){
        if (isProcessingCustomerAdd) { 
            return;
        }  
        isProcessingCustomerAdd = true;  
        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-customer", 
            success: function(data) {   
                $("#modal-add-penawaran").modal("hide"); 
                $("#modal-optional").html(data);
                $("#modal-add-customer").modal("show");  

                $("#modal-add-customer").on("hidden.bs.modal",function(){ 
                    $("#modal-add-penawaran").modal("show");  
                })    
                isProcessingCustomerAdd = false;    
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingCustomerAdd = false; 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    $("#btn-add-penawaran").click(function(){
        if($("#CustomerId").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Pelanggan harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() =>  $("#CustomerId").select2("open"), 300);  
            });
            return  false;
        }  
        if($("#StoreId").val() == null){
            Swal.fire({
                icon: 'error',
                text: 'Toko harus dipilih...!!!', 
                confirmButtonColor: "#3085d6", 
            }).then(function(){ 
                swal.close();
                setTimeout(() =>  $("#StoreId").select2("open"), 300);  
            });
            return  false;
        } 
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
            SphDate: $("#SphDate").data('daterangepicker').startDate.format("YYYY-MM-DD"),   
            ProjectId: $("#ProjectId").val(), 
            CustomerId: $("#CustomerId").val(), 
            StoreId: $("#StoreId").val(), 
            SphRef: $("#SphRef").val(), 
            SphRefType: $('#SphRef option:selected').data('type'), 
            SphAdmin: $("#SphAdmin").val(), 
            SphCustName: $("#SphCustName").val(), 
            SphCustTelp: $("#SphCustTelp").val(),   
            SphAddress: $("#SphAddress").val(),  
            SphDelivery:  $('input[name="SphDelivery"]:checked').val(),  
            TemplateId: $($(".template-footer").find("select")[0]).val(), 
            SphSubTotal: $("#SphSubTotal").val().replace(/[^0-9]/g, ''), 
            SphDiscItemTotal: $("#SphDiscItemTotal").val().replace(/[^0-9]/g, ''),
            SphDeliveryTotal: $("#SphDeliveryTotal").val().replace(/[^0-9]/g, ''),  
            SphDiscTotal: $("#SphDiscTotal").val().replace(/[^0-9]/g, ''), 
            SphGrandTotal: $("#SphGrandTotal").val().replace(/[^0-9]/g, '')
        }
        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){  
            if(data_detail_item[i]["type"] == "product"){ 
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"], 
                    SphDetailText: data_detail_item[i]["text"],
                    SphDetailType: data_detail_item[i]["type"], 
                    SphDetailSatuanId: data_detail_item[i]["satuan_id"], 
                    SphDetailSatuanText: data_detail_item[i]["satuan_text"],
                    SphDetailQty: data_detail_item[i]["qty"], 
                    SphDetailPrice: data_detail_item[i]["price"], 
                    SphDetailDisc: data_detail_item[i]["disc"], 
                    SphDetailTotal: data_detail_item[i]["total"], 
                    SphDetailGroup: data_detail_item[i]["group"], 
                    SphDetailVarian: data_detail_item[i]["varian"], 
                });
            }else{
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"], 
                    SphDetailText: data_detail_item[i]["text"],
                    SphDetailType: data_detail_item[i]["type"], 
                    SphDetailSatuanId: "", 
                    SphDetailSatuanText: "", 
                    SphDetailQty: 0,
                    SphDetailPrice: 0, 
                    SphDetailDisc: 0, 
                    SphDetailTotal: 0, 
                    SphDetailGroup: "", 
                    SphDetailVarian: [], 
                });
            }
        }
 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-data-penawaran", 
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
                        $("#modal-add-penawaran").modal("hide");      
                        if($("#modal-add-penawaran").data("menu") =="Penawaran"){
                            table.ajax.reload(null, false); 
                        }else{ 
                            //loader_data_project("projectId","penawaran");  
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