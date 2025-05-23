 
<div class="modal fade" id="modal-add-invoice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1"  aria-labelledby="modal-add-invoice-label" style="overflow-y:auto;"  data-menu="project">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-invoice-label">Buat Invoice</h2>
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
                                <label for="InvAddress" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="InvCustName" type="text" value="<?= $customer["CustomerName"]?>"/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="InvAddress" class="col-sm-3 col-form-label">Telp Customer</label>
                                <div class="col-sm-9">
                                    <input  class="form-control form-control-sm input-form" id="InvCustTelp"  type="text" value="<?= $customer["CustomerTelp"] ?>"/>
                                </div>
                            </div> 
                            <div class="row mb-1 align-items-center">
                                <label for="InvAddress" class="col-sm-3 col-form-label">Alamat Project</label>
                                <div class="col-sm-9">
                                    <textarea  class="form-control form-control-sm input-form" id="InvAddress"><?= $customer["CustomerAddress"] ?></textarea>
                                </div>
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-lg-6 col-12 my-1 mb-3 mb-md-1">   
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
                                <label for="InvCode" class="col-sm-2 col-form-label">Kode<sup class="error">&nbsp;*</sup></label>
                                <div class="col-sm-10">
                                    <input id="InvCode" name="InvCode" type="text" class="form-control form-control-sm input-form" value="(auto)" disabled>
                                </div>
                            </div>   
                            <div class="row mb-1 align-items-center">
                                <label for="InvRef" class="col-sm-2 col-form-label">Ref</label>
                                <div class="col-sm-10"> 
                                    <select class="form-select form-select-sm" id="InvRef" name="InvRef"  style="width:100%" >
                                        <option value="0" selected data-type="-">No Data Selected</option>
                                    </select>  
                                </div> 
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="InvDate" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input id="InvDate" name="InvDate" type="text" class="form-control form-control-sm input-form" value="">
                                </div>
                            </div>  
                            <div class="row mb-1 align-items-center">
                                <label for="InvAdmin" class="col-sm-2 col-form-label">Admin</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="InvAdmin" name="InvAdmin" placeholder="Pilih Admin" style="width:100%"></select>  
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled value="0" id="InvSubTotal">
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" disabled id="InvDiscItemTotal" value="0">
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
                                    <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" id="InvDiscTotal" value="0">
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
                                    <input type="text"class="form-control form-control-sm  input-form hargajual" disabled value="0" id="InvGrandTotal" >
                                </div>     
                            </div>
                        </div> 
                    </div>  
                </div>  
                
                <div class="row mx-2 my-3 align-items-center">
                    <div class="label-border-right position-relative" >
                        <span class="label-dialog">Lampiran Gambar</span> 
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
                 
                <div class="row p-2"> 
                    <div class="col-12 col-md-6 px-1 order-2 order-md-1">   
                        <div class="row mx-2 my-3 align-items-center">
                            <div class="label-border-right position-relative" >
                                <span class="label-dialog">Lampiran KTP</span> 
                            </div>
                        </div>   
                        <div class="card">
                            <input type="file" class="d-none" accept="image/*" id="upload-ktp"> 
                            <div class="card-body mx-2 p-2 bg-light">
                                <div class="d-flex mb-1 align-items-center mt-2"> 
                                    <div class="flex-fill pe-2">
                                        <select class="form-select form-select-sm" name="select-ktp" id="select-ktp" placeholder="Pilih KTP" style="width:100%"></select>  
                                    </div>  
                                    <a type="button" class="btn btn-sm btn-primary rounded text-white" id="btn-ktp" aria-pressed="false" value="edit" aria-label="name: edit"><i class="fa-solid fa-upload pe-2"></i>Upload</a> 
                                </div>    
                                <div class="row mb-1 align-items-center mt-2"> 
                                    <div class="col-12"> 
                                        <div id="preview-ktp" class="border p-md-4 p-2 text-center" style="min-height:50px;"></div> 
                                    </div>
                                </div>    
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-12 col-md-6 px-1 order-2 order-md-1">   
                        <div class="row mx-2 my-3 align-items-center">
                            <div class="label-border-right position-relative" >
                                <span class="label-dialog">Lampiran NPWP</span> 
                            </div>
                        </div>   
                        <div class="card" >
                        
                            <input type="file" class="d-none" accept="image/*" id="upload-npwp"> 
                            <div class="card-body mx-2 p-2 bg-light">
                                <div class="d-flex mb-1 align-items-center mt-2"> 
                                    <div class="flex-fill pe-2">
                                        <select class="form-select form-select-sm" name="select-npwp" id="select-npwp" placeholder="Pilih NPWP" style="width:100%"></select>  
                                    </div>  
                                    
                                    <a type="button" class="btn btn-sm btn-primary rounded text-white" id="btn-npwp" aria-pressed="false" value="edit" aria-label="name: edit"><i class="fa-solid fa-upload pe-2"></i>Upload</a> 
                                </div>    
                                <div class="row mb-1 align-items-center mt-2" > 
                                    <div class="col-12"> 
                                        <div id="preview-npwp" class="border p-md-4 p-2  text-center" style="min-height:50px;"></div> 
                                    </div>
                                </div>    
                            </div>  
                        </div>  
                    </div>  
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-invoice">Simpan</button>
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
</div><div class="modal fade " id="modal-edit-ktp"  data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">  
        <div class="modal-content" name="form-action">
            <div class="modal-header">
                <h6 class="modal-title"><i class="fas fa-crop-alt"></i> &nbsp;Upload Gambar KTP</h5>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row mb-1 align-items-center mt-2 p-2">
                    <label for="ktp-rename" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input id="ktp-rename" name="ktp-rename" type="text" class="form-control form-control-sm input-form" value="">
                    </div>
                </div>  
                <div id="crop-image-ktp" style="height:300px;"></div> 
                <div class="action" style="position: absolute; bottom: 15px; margin-left: 50%; transform: translateX(-50%); background: #d1d1d1; padding: 0.5rem; border-radius: 0.5rem;  z-index: 2;">
                    <a class="p-2" onclick="rotate_image_npwp(90)"><i class="fas fa-undo-alt"></i></a>
                    <a class="p-2" onclick="rotate_image_npwp(-90)"><i class="fas fa-redo-alt"></i></a>
                    <a class="p-2" onclick="flip_image_npwp(2)"><i class="fas fa-exchange-alt"></i></a>
                    <a class="p-2" onclick="flip_image_npwp(4)"><i class="fas fa-exchange-alt fa-rotate-90"></i></a>
                </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submit-crop-ktp" >Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="modal-edit-npwp"  data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">  
        <div class="modal-content" name="form-action">
            <div class="modal-header">
                <h6 class="modal-title"><i class="fas fa-crop-alt"></i> &nbsp;Upload Gambar NPWP</h5>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row mb-1 align-items-center mt-2 p-2">
                    <label for="npwp-rename" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input id="npwp-rename" name="npwp-rename" type="text" class="form-control form-control-sm input-form" value="">
                    </div>
                </div>  
                <div id="crop-image-npwp" style="height:300px;"></div> 
                <div class="action" style="position: absolute; bottom: 15px; margin-left: 50%; transform: translateX(-50%); background: #d1d1d1; padding: 0.5rem; border-radius: 0.5rem;  z-index: 2;">
                    <a class="p-2" onclick="rotate_image_npwp(90)"><i class="fas fa-undo-alt"></i></a>
                    <a class="p-2" onclick="rotate_image_npwp(-90)"><i class="fas fa-redo-alt"></i></a>
                    <a class="p-2" onclick="flip_image_npwp(2)"><i class="fas fa-exchange-alt"></i></a>
                    <a class="p-2" onclick="flip_image_npwp(4)"><i class="fas fa-exchange-alt fa-rotate-90"></i></a>
                </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submit-crop-npwp" >Simpan</button>
            </div>
        </div>
    </div>
</div>
<div id="modal-optional"></div>
<script>    

    $('#InvDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": moment(),
        "endDate":  moment(),
        locale: {
            format: 'DD MMMM YYYY'
        }
    });
    
    $("#InvRef").select2({
        dropdownParent: $('#modal-add-invoice .modal-content'),
        placeholder: "Pilih Referensi dokumen",
        ajax: {
            url: "<?= base_url()?>select2/get-data-ref-invoice/<?= $project->ProjectId?>",
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
    var header_ref = '<?= is_null($ref_header) ? false : true ?>'; 
    if(header_ref){ 
        var option = new Option(
            '<?= is_null($ref_header) ? "" : $ref_header["code"] ?>', 
            '<?= is_null($ref_header) ? "" : $ref_header["id"] ?>', 
            false, 
            true
        );
        $(option).attr('data-type', '<?= is_null($ref_header) ? "" : $ref_header["type"] ?>'); 
        $('#InvRef').append(option).trigger('change.select2');
        $('#InvRef').attr("disabled",true);
    }

    $("#InvAdmin").select2({
        dropdownParent: $('#modal-add-invoice .modal-content'),
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
    $('#InvAdmin').append(new Option("<?=$user->code. " - " . $user->username ?>" , "<?=$user->id?>", true, true)).trigger('change');   
      
     
    var detail_item_ref = '<?= json_encode($ref_detail) ?>';  
    var data_detail_item = JSON.parse(detail_item_ref);

    var isProcessingInvAddCategory = false;
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
    }
 
    $('#modal-select-item').on('hidden.bs.modal', function () {
        if (document.activeElement) {
            document.activeElement.blur();
        }
    });
    var isProcessingInvAddproduk = false;

    $("#btn-add-product").click(function(){
        if (isProcessingInvAddproduk) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvAddproduk = true; 
        let old_text = $("#btn-add-product").html();
        $("#btn-add-product").html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/select-produk", 
            success: function(data) {  
                isProcessingInvAddproduk = false; 
                $("#btn-add-product").html(old_text);
                
                $("#modal-optional").html(data);
                
                $("#modal-add-invoice").modal("hide");  

                $("#modal-select-item").modal("show"); 


                $('#modal-select-item').on('hidden.bs.modal', function () {
                    if (document.activeElement) {
                        document.activeElement.blur();
                    }
                    $("#modal-add-invoice").modal("show");  
                    
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
                isProcessingInvAddproduk = false;
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
        var grandtotal =  total - discitem - $("#InvDiscTotal").val().replace(/[^0-9-]/g, ''); 

        $("#InvSubTotal").val(total.toLocaleString('en-US')) 
        $("#InvDiscItemTotal").val(discitem.toLocaleString('en-US')) 
        $("#InvGrandTotal").val(grandtotal.toLocaleString('en-US')) 
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
                    dropdownParent: $('#modal-add-invoice .modal-content'), 
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

    var inv_sub_total = new Cleave(`#InvSubTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var inv_disc_item_total = new Cleave(`#InvDiscItemTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var inv_disc_total = new Cleave(`#InvDiscTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    var inv_grand_total = new Cleave(`#InvGrandTotal`, {
            numeral: true,
            delimeter: ",",
            numeralDecimalScale:0,
            numeralThousandGroupStyle:"thousand"
    }); 
    $("#InvDiscTotal").on("keyup",function(){ 
        grand_total_harga();
        if(parseInt($("#InvGrandTotal").val().replace(/[^0-9-]/g, '')) < 0){
            $("#InvDiscTotal").val(0)
            grand_total_harga();
        }
    });
    
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
                                 
                        </div>`);
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

    var quill = [];  
    $(".template-footer").each(function(index, el){
        var message = $(el).find("[name='EditFooterMessage']")[0];
        var type = "invoice"; 
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
            dropdownParent: $('#modal-add-invoice .modal-content'),
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
            $("#modal-add-invoice").modal("hide"); 
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
                $("#modal-add-invoice").modal("show");
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


    $("#select-npwp").select2({
        dropdownParent: $('#modal-add-invoice .modal-content'),
        placeholder: "Tidak ada yang dipilih", 
        ajax: {
            url: "<?= base_url()?>select2/get-data-npwp",
            dataType: 'json',
            type: "POST",
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
        if(data.image == ""){
            $("#preview-npwp").html("")
        }  else{
            var html = "<img src='" + data.image  +"' >"
            $("#preview-npwp").html(html)
        } 
    }); 
    $("#btn-npwp").on('click',function(){
        $("#upload-npwp").trigger("click");
    })    
    var $uploadCropNpwp = $('#crop-image-npwp').croppie({
        viewport: {
            width: 250,
            height: 150,
        },
        showZoomer: false,
        enforceBoundary: false,
        enableExif: true,
        enableOrientation: true
    });
    $("#upload-npwp").on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() { 
                var flip = 0; 
                $('#npwp-rename').val("");
                $('#modal-edit-npwp').modal('show');
                $('#modal-edit-npwp').on('shown.bs.modal', function(){ 
                    $uploadCropNpwp.croppie('bind', {
                        url: reader.result
                    }).then(function(){
                         
                    });
                });
                rotate_image_npwp = function(val){
                    $uploadCropNpwp.croppie('rotate',parseInt(val));
                }
                flip_image_npwp = function(val){
                    flip = flip == 0 ? val : 0;
                    $uploadCropNpwp.croppie('bind', { 
                        url: $(el).parent().parent().find('img').attr('src'),
                        orientation: flip
                    });
                } 
                $('#submit-crop-npwp').unbind().click(function (ev) {
                    if( $('#npwp-rename').val() == "" ) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Nama harus diinput...!!!', 
                            confirmButtonColor: "#3085d6", 
                        }).then(function(){ 
                            swal.close();
                            setTimeout(() => $("#npwp-rename").focus(), 300); 
                            }) ;
                        return; 
                    };
                    $uploadCropNpwp.croppie('result', {
                        type: 'base64',
                        format: 'png',
                        size: {width: 250, height: 150}
                    }).then(function (resp) { 
                        $.ajax({ 
                            dataType: "json",
                            method: "POST",
                            url: "<?= base_url() ?>action/add-data-lampiran", 
                            data:{
                                "Name":  $('#npwp-rename').val() ,
                                "Image": resp,  
                                "Type": "NPWP",
                            },
                            success: function(data) {    
                                //console.log(data); 
                                if(data["status"]===true){      
                                    $("#preview-npwp").html(`<img src="${resp}">`) 
                                    $('#modal-edit-npwp').modal('hide'); 
                                    $('#select-npwp').append(new Option(data["data"]["Name"] , data["data"]["id"] , true, true)).trigger('change');   
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
                });
            }
        }
    }); 


    $("#select-ktp").select2({
        dropdownParent: $('#modal-add-invoice .modal-content'),
        placeholder: "Tidak ada yang dipilih", 
        ajax: {
            url: "<?= base_url()?>select2/get-data-ktp",
            dataType: 'json',
            type: "POST",
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
        if(data.image == ""){
            $("#preview-ktp").html("")
        }  else{
            var html = "<img src='" + data.image  +"'>"
            $("#preview-ktp").html(html)
        } 
    });
    $("#btn-ktp").on('click',function(){
        $("#upload-ktp").trigger("click");
    })
    var $uploadCropKtp = $('#crop-image-ktp').croppie({
        viewport: {
            width: 250,
            height: 150,
        },
        showZoomer: false,
        enforceBoundary: false,
        enableExif: true,
        enableOrientation: true
    });
    $("#upload-ktp").on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() { 
                var flip = 0; 
                $('#ktp-rename').val("");
                $('#modal-edit-ktp').modal('show');
                $('#modal-edit-ktp').on('shown.bs.modal', function(){ 
                    $uploadCropKtp.croppie('bind', {
                        url: reader.result
                    }).then(function(){
                         
                    });
                });
                rotate_image_npwp = function(val){
                    $uploadCropKtp.croppie('rotate',parseInt(val));
                }
                flip_image_npwp = function(val){
                    flip = flip == 0 ? val : 0;
                    $uploadCropKtp.croppie('bind', { 
                        url: $(el).parent().parent().find('img').attr('src'),
                        orientation: flip
                    });
                } 
                $('#submit-crop-ktp').unbind().click(function (ev) {
                    if( $('#ktp-rename').val() == "" ) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Nama harus diinput...!!!', 
                            confirmButtonColor: "#3085d6", 
                        }).then(function(){ 
                            swal.close();
                            setTimeout(() => $("#ktp-rename").focus(), 300); 
                            }) ;
                        return; 
                    };
                    $uploadCropKtp.croppie('result', {
                        type: 'base64',
                        format: 'png',
                        size: {width: 250, height: 150}
                    }).then(function (resp) { 
                        $.ajax({ 
                            dataType: "json",
                            method: "POST",
                            url: "<?= base_url() ?>action/add-data-lampiran", 
                            data:{
                                "Name":  $('#ktp-rename').val() ,
                                "Image": resp,  
                                "Type": "KTP",
                            },
                            success: function(data) {    
                                //console.log(data); 
                                if(data["status"]===true){      
                                    $("#preview-ktp").html(`<img src="${resp}">`) 
                                    $('#modal-edit-ktp').modal('hide'); 
                                    $('#select-ktp').append(new Option(data["data"]["Name"] , data["data"]["id"] , true, true)).trigger('change');   
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
                });
            }
        }
    }); 

    $("#btn-add-invoice").click(function(){
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
            InvDate: $("#InvDate").data('daterangepicker').startDate.format("YYYY-MM-DD"),  
            ProjectId: <?= $project->ProjectId ?>, 
            InvRef: $("#InvRef").val(), 
            InvRefType: $('#InvRef option:selected').data('type'), 
            InvAdmin: $("#InvAdmin").val(),  
            InvCustName: $("#InvCustName").val(),
            InvCustTelp: $("#InvCustTelp").val(),
            InvAddress: $("#InvAddress").val(), 
            TemplateId: $($(".template-footer").find("select")[0]).val(), 
            InvSubTotal: $("#InvSubTotal").val().replace(/[^0-9]/g, ''), 
            InvDiscItemTotal: $("#InvDiscItemTotal").val().replace(/[^0-9]/g, ''), 
            InvDiscTotal: $("#InvDiscTotal").val().replace(/[^0-9]/g, ''), 
            InvGrandTotal: $("#InvGrandTotal").val().replace(/[^0-9]/g, ''), 
            InvImageList: $("#list-produk img").map(function(){ return $(this).attr("src")}).get(),    
            InvKtp: $("#select-ktp").val(), 
            InvNpwp: $("#select-npwp").val(), 
        }
        var detail = [];
        for(var i = 0;data_detail_item.length > i;i++){  
            if(data_detail_item[i]["type"] == "product"){ 
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"], 
                    InvDetailText: data_detail_item[i]["text"],
                    InvDetailType: data_detail_item[i]["type"], 
                    InvDetailSatuanId: data_detail_item[i]["satuan_id"], 
                    InvDetailSatuanText: data_detail_item[i]["satuan_text"],
                    InvDetailQty: data_detail_item[i]["qty"], 
                    InvDetailPrice: data_detail_item[i]["price"], 
                    InvDetailDisc: data_detail_item[i]["disc"], 
                    InvDetailTotal: data_detail_item[i]["total"], 
                    InvDetailGroup: data_detail_item[i]["group"], 
                    InvDetailVarian: data_detail_item[i]["varian"], 
                });
            }else{
                detail.push({
                    ProdukId: data_detail_item[i]["produkid"], 
                    InvDetailText: data_detail_item[i]["text"],
                    InvDetailType: data_detail_item[i]["type"], 
                    InvDetailSatuanId: "", 
                    InvDetailSatuanText: "", 
                    InvDetailQty: 0,
                    InvDetailPrice: 0, 
                    InvDetailDisc: 0, 
                    InvDetailTotal: 0, 
                    InvDetailGroup: "", 
                    InvDetailVarian: [], 
                });
            }
        }
 
        $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/add-data-invoice", 
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
                        $("#modal-add-invoice").modal("hide");  
                        if($("#modal-add-invoice").data("menu") =="invoice"){
                            loader_datatable(); 
                        }else{ 
                            loader_data_project(<?= $project->ProjectId ?>,"invoice");  
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