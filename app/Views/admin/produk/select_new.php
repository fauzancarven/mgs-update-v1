<div class="modal fade" id="add-item-select" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-select-item-label">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-select-item-label">Pilih item</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2"> 
                <div class="d-flex align-items-center mb-2 g-2 row search-data">  
                    <div class="input-group ">  
                        <input class="form-control form-control-sm input-form combo" id="searchdatafilterselect" placeholder="Pilih Varian" value="" type="text" readonly style="background: white;">
                        <i class="fa-solid fa-filter"></i>
                        <i class="fa-solid fa-caret-down"></i>
                        <div class="filter-data" for="searchdatafilterselect">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center utama">
                                    <span class="ms-2 me-auto">Vendor</span> 
                                    <span class="badge text-bg-primary rounded-pill" id="badge-Vendor"></span>
                                    <i class="fa-solid fa-angle-right"></i>
                                </li>
                                <?php 
                                    foreach($varian as $row){
                                        echo '
                                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center utama">
                                            <span class="ms-2 me-auto">'.$row->name.'</span>
                                            <span class="badge text-bg-primary rounded-pill" id="badge-'.preg_replace("/\s+/", "", $row->name).'"></span>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </li>';
                                        $varianli = '';
                                        foreach($varian_detail as $rows){
                                            if($rows->varian == $row->name){
                                                $varianli .='
                                                <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                                    <div class="form-check w-100">
                                                        <input class="form-check-input select varian" type="checkbox" data-group="'.$row->name.'" data-value="'.$rows->name.'" value="'.$rows->name.'" id="varianvalue'.$rows->id.'">
                                                        <label class="form-check-label ps-0 ms-0" for="varianvalue'.$rows->id.'">'.$rows->name.'</label>
                                                    </div> 
                                                </li>';
                                            }
                                        }
                                        $varianlist .= '
                                        <div class="filter-list" data-value="'.$row->name.'">
                                            <div class="search-filter p-2 bg-white">
                                                <div class="input-group flex-fill">  
                                                    <input class="form-control form-control-sm input-form" name="filter-list" id="search'.$row->name.'" data-name="'.$row->name.'" placeholder="Cari '.$row->name.'" value="" type="text" style="padding-left: 2rem;border: 1px solid #c7c6c6 !important;">
                                                    <i class="fa-solid fa-magnifying-glass" style="position: absolute;top: 50%;  transform: translate(50%, -50%);z-index: 10;"></i> 
                                                </div>
                                            </div>
                                            <ul class="list-group"> 
                                                '.$varianli.'
                                            </ul>
                                        </div>';
                                    }
                                ?> 
                            </ul>
                        </div>
                        <div class="filter-list" data-value="Vendor">
                            <div class="search-filter p-2 bg-white">
                                <div class="input-group flex-fill">  
                                    <input class="form-control form-control-sm input-form" name="filter-list" id="searchvendor" data-name="Vendor" placeholder="Cari Vendor" value="" type="text" style="padding-left: 2rem;border: 1px solid #c7c6c6 !important;">
                                    <i class="fa-solid fa-magnifying-glass" style="position: absolute;top: 50%;  transform: translate(50%, -50%);z-index: 10;"></i> 
                                </div>
                            </div>
                            <ul class="list-group"> 
                                <?php
                                    foreach($vendor as $row){
                                        echo '
                                        <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                            <div class="form-check w-100">
                                                <input class="form-check-input select varian" type="checkbox" data-group="Vendor" data-value="'.$row->VendorCode.'" value="'.$row->VendorCode.'" id="'.$row->VendorCode.'">
                                                <label class="form-check-label ps-0 ms-0" for="'.$row->VendorCode.'">'.$row->VendorCode.'</label>
                                            </div> 
                                        </li>';
                                    }
                                ?>
                            </ul>
                        </div>  
                        <?=  $varianlist ?>
                    </div>
                    <div class="input-group">  
                        <input class="form-control form-control-sm input-form combo" id="searchdatacategoryselect" placeholder="Pilih Kategori Produk" value="" type="text" data-start="" data-end="" readonly style="background: white;">
                        <i class="fa-solid fa-filter"></i>
                        <i class="fa-solid fa-caret-down"></i>
                        <div class="filter-data " style="width: 18rem;" for="searchdatacategoryselect">
                            <ul class="list-group">
                                <?php
                                    foreach($category as $row){ 
                                        echo '
                                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-0 px-2">
                                            <div class="form-check w-100">
                                                <input class="form-check-input select category" type="checkbox" data-group="category" data-value="'.$row->ProdukCategoryCode.'" value="'.$row->ProdukCategoryCode.'" id="category'.$row->ProdukCategoryCode.'">
                                                <label class="form-check-label ps-0 ms-0" for="category'.$row->ProdukCategoryCode.'">'.$row->ProdukCategoryCode.' - '.$row->ProdukCategoryName.'</label>
                                            </div> 
                                        </li> ';
                                    }
                                ?>
                                
                            </ul>
                        </div>
                    </div>  
                    <div class="input-group flex-fill">  
                        <input class="form-control form-control-sm input-form" id="searchdataprodukselect" placeholder="Cari nama produk" value="" type="text">
                        <i class="fa-solid fa-magnifying-glass"></i> 
                    </div>  
                </div>  
                <div class="list-data-produk" style="min-height:350px;max-height:350px;overflow-y:auto;">
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                    <div class="d-flex align-items-center justify-content-between gap-3 my-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 ">
                                <img src="https://192.168.100.47/mahiera/assets/images/produk/61/1.png" alt="Gambar" class="image-produk"> 
                            </div>
                            <div class="flex-grow-1 ms-3 ">
                                <div class="d-flex flex-column">
                                    <span class="text-head-1">Roster  single ring</span>
                                    <span class="text-detail-1 text-truncate">RST00015 - Roster</span> 
                                </div>
                            </div>
                        </div> 
                        <div class="varian d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Vendor</span>
                                <span class="text-head-2 text-truncate">MGS</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Warna</span>
                                <span class="text-head-2 text-truncate">Red</span> 
                            </div>  
                            <div class="vr m-2"> </div>  
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Ukuran</span>
                                <span class="text-head-2 text-truncate">20 x 20 x 5cm</span> 
                            </div>  
                        </div> 
                        <div class="stock d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Stok Barang Ready</span>
                                <span class="text-head-2 text-truncate">150 M<sup>2</sup></span> 
                            </div>  
                        </div>  
                        <div class="price d-flex">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2">Harga</span>
                                <span class="text-head-2 text-truncate">RP. 12.000,-</span> 
                            </div>  
                        </div>  
                        <button type="button" class="btn btn-sm btn-primary px-3 m-2">Pilih Produk</button>
                    </div> 
                </div>
                
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-item">Pilih</button>
            </div>
        </div>
    </div>
</div>  

<script> 

    var filter_arr_select = {
        "Vendor":[], 
    };
    var filter_category_select = []
    var data_varian = JSON.parse('<?= json_encode(array_column($varian, 'name')) ?>');
    data_varian.forEach(function(value) {
        filter_arr_select[value] = [];
    });

    $(".input-group .combo").click(function(){
        if($(this).parent().hasClass("active")){
            $(this).parent().removeClass("active");
        }else{ 
            $(this).parent().addClass("active"); 
            var ele = $(this);
            $(document).on('click', function(event) { 
                if (!$(event.target).closest(ele).length  && !$(event.target).closest(".filter-data").length  && !$(event.target).closest(".filter-list").length) {
                    $(ele).parent().removeClass('active');
                }
            });
        }
    })
    $(".filter-data .list-group-item.utama").hover(function(){ 
        $(".filter-list[data-value='" +  $(this).find("span").html() + "'").show();
        $(".filter-list[data-value='" +  $(this).find("span").html() + "'").css("top",$(this).position()["top"] + 30)  
    }, function () {  
        if (!$(".filter-list[data-value='" +  $(this).find("span").html() + "'").is(':hover')) { 
            
            $(".filter-list[data-value='" +  $(this).find("span").html() + "'").hide();
        }else{
            var ele = $(this);
            $(".filter-list[data-value='" +  $(this).find("span").html() + "'").hover(function() { 
                $(this).show();
            }, function() { 
                if (!$(ele).is(':hover') && !$(this).is(':hover')) {
                    $(this).hide();
                }
            }); 
        }
    });  
    $("input[name='filter-list']").keyup(function(){
        var filter = $(this).val().toLowerCase();
        $(".filter-list[data-value='" + $(this).data("name") + "'] li").each(function(el) {
            console.log($(this));
            var text = $(this).find("input").val().toLowerCase(); 
            if (text.indexOf(filter) !== -1) {
                $(this).removeClass("d-none");
            } else {
                $(this).addClass("d-none"); 
            } 
        }); 
    })
    function load_badge_varian(){
        var total = 0;
        for (var key in filter_arr_select) { 
            (filter_arr_select[key].length === 0 ?  $("#badge-" + key.replace(/\s+/g, '')).html("") : $("#badge-" + key.replace(/\s+/g, '')).html(filter_arr_select[key].length));  
            total += filter_arr_select[key].length;
        } 
        (total === 0 ?  $("#searchdatafilterselect").val("") : $("#searchdatafilterselect").val(String(total) + " varian dipilih"));
        load_data_produk();
    } 
    function tambahArrayVarian(namaGrup, nilai) {
        if (!filter_arr_select[namaGrup]) {
            filter_arr_select[namaGrup] = [];
        }
        filter_arr_select[namaGrup].push(nilai);  
    } 
    function hapusArrayVarian(namaGrup, nilai) {
        if (filter_arr_select[namaGrup]) {
            var index = filter_arr_select[namaGrup].indexOf(nilai);
            if (index !== -1) {
                filter_arr_select[namaGrup].splice(index, 1);
            }
        } 
    } 
    $('.form-check-input.select.varian').change(function() { 
        if ($(this).is(':checked')) {
            tambahArrayVarian($(this).data("group"), $(this).data("value"))
        }else{  
            hapusArrayVarian($(this).data("group"), $(this).data("value")) 
        } 
        load_badge_varian()
    })
    $('.form-check-input.select.category').change(function() { 
        if ($(this).is(':checked')) {
            filter_category_select.push($(this).data("value")) 
        }else{  
            var index = filter_category_select.indexOf($(this).data("value"));
            if (index !== -1) {
                filter_category_select.splice(index, 1);
            } 
        } 
        (filter_category_select.length === 0 ?  $("#searchdatacategoryselect").val("") : $("#searchdatacategoryselect").val(String(filter_category_select.length) + " kategori dipilih")); 
        load_data_produk();
    })

    $("#searchdataprodukselect").keyup(function(){
        load_data_produk();
    })
    var xhr_load_produk_select;
    function load_data_produk(){
        var html = `<div class="d-flex justify-content-center flex-column align-items-center">
                <div class="loading text-center loading-content pt-4 mt-4">
                    <div class="loading-spinner"></div>
                    <div class="d-flex justify-content-center flex-column align-items-center">
                        <span>Sedang memuat data</span> 
                    </div>
                </div> 
            </div>`;
        $(".list-data-produk").html(html);
        if (xhr_load_produk_select) {
            xhr_load_produk_select.abort();
        }

        xhr_load_produk_select = $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url() ?>action/get-data-project-tab", 
            data:{
                "type":type,
                "ProjectId":ProjectId, 
            },
            success: function(data) {  
                
            }  
        });

    }
</script>