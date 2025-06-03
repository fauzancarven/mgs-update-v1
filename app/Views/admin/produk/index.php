<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>
 

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?> 
<div class="card radius-15 overflow-hidden mb-3 border-0 shadow-sm">
    <div class="card-header border-bottom-0 px-4 pt-4 pb-0 bg-white mb-lg-0 mb-2"> 
        <div class="d-flex align-items-center mb-4"> 
            <div class="p-1 flex-fill" > 
                <h4 class="mb-0">LIST PRODUK</h4> 
            </div>   
            <div class="justify-content-end d-flex">
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-block ps-2">Tambah Produk<span></button>
            </div>
        </div> 
        <div class="offcanvas offcanvas-bottom" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="staticBackdropLabel"><i class="fa-solid fa-filter"></i> Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h6>Pilih Varian</h6>
                <div class="accordion accordion-flush pb-2" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button p-2 mx-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Vendor
                            </button> 
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush"> 
                                    <?php
                                        foreach($vendor as $row){
                                            echo '
                                            <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                                <div class="form-check w-100">
                                                    <input class="form-check-input varian" type="checkbox" data-group="Vendor" data-value="'.$row->VendorCode.'" value="'.$row->VendorCode.'" id="vendor'.$row->VendorCode.'">
                                                    <label class="form-check-label ps-0 ms-0 stretched-link" for="vendor'.$row->VendorCode.'">'.$row->VendorCode.'</label>
                                                </div> 
                                            </li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div> 
                    <?php 
                        foreach($varian as $row){ 
                            $varianli = '';
                            foreach($varian_detail as $rows){
                                if($rows->varian == $row->name){
                                    $varianli .='
                                    <li class="py-0 list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                        <div class="form-check w-100">
                                            <input class="form-check-input varian" type="checkbox" data-group="'.$row->name.'" data-value="'.$rows->name.'" value="'.$rows->name.'" id="varianvalue'.$rows->id.'">
                                            <label class="form-check-label ps-0 ms-0" for="varianvalue'.$rows->id.'">'.$rows->name.'</label>
                                        </div> 
                                    </li>';
                                }
                            }
                            echo '
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button p-2 mx-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-'.preg_replace("/\s+/", "", $row->name).'" aria-expanded="false" aria-controls="flush-'.preg_replace("/\s+/", "", $row->name).'">
                                        '.$row->name.'
                                    </button> 
                                </h2>     
                                <div id="flush-'.preg_replace("/\s+/", "", $row->name).'" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body filter-list" data-value="'.$row->name.'">
                                        <div class="search-filter p-2 bg-white">
                                            <div class="input-group flex-fill">  
                                                <input class="form-control form-control-sm input-form" name="filter-list" id="search'.$row->name.'" data-name="'.$row->name.'" placeholder="Cari '.$row->name.'" value="" type="text" style="padding-left: 2rem;border: 1px solid #c7c6c6 !important;">
                                                <i class="fa-solid fa-magnifying-glass" style="position: absolute;top: 50%;  transform: translate(50%, -50%);z-index: 10;"></i> 
                                            </div>
                                        </div>
                                        <ul class="list-group list-group-flush"> 
                                            '.$varianli.'
                                        </ul>
                                    </div>
                                </div>
                            </div> '; 
                        }
                    ?> 
                </div> 
                <h6>Pilih Kategori</h6>
                <ul class="list-group list-group-flush">
                    <?php
                        foreach($category as $row){ 
                            echo '
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-0 px-2">
                                <div class="form-check w-100">
                                    <input class="form-check-input category" type="checkbox" data-group="category" data-value="'.$row->ProdukCategoryCode.'" value="'.$row->ProdukCategoryCode.'" id="category'.$row->ProdukCategoryCode.'">
                                    <label class="form-check-label ps-0 ms-0 stretched-link" for="category'.$row->ProdukCategoryCode.'">'.$row->ProdukCategoryCode.' - '.$row->ProdukCategoryName.'</label>
                                </div> 
                            </li> ';
                        }
                    ?>
                    
                </ul>
            </div>
        </div>
        <!-- BAGIAN FILTER -->
        <div class="d-flex align-items-center justify-content-end mb-2 g-2 row search-data">  
            <div class="input-group d-sm-flex d-none">  
                <input class="form-control form-control-sm input-form combo" id="searchdatafilter" placeholder="Pilih Varian" value="" type="text" readonly style="background: white;">
                <i class="fa-solid fa-filter"></i>
                <i class="fa-solid fa-caret-down"></i>
                <div class="filter-data desktop" for="searchdatafilter">
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
                                                <input class="form-check-input varian" type="checkbox" data-group="'.$row->name.'" data-value="'.$rows->name.'" value="'.$rows->name.'" id="varianvalue-'.$rows->id.'">
                                                <label class="form-check-label ps-0 ms-0 stretched-link" for="varianvalue-'.$rows->id.'">'.$rows->name.'</label>
                                            </div> 
                                        </li>';
                                    }
                                }
                                $varianlist .= '
                                <div class="filter-list desktop" data-value="'.$row->name.'">
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
                <div class="filter-list desktop" data-value="Vendor">
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
                                        <input class="form-check-input varian" type="checkbox" data-group="Vendor" data-value="'.$row->VendorCode.'" value="'.$row->VendorCode.'" id="'.$row->VendorCode.'">
                                        <label class="form-check-label ps-0 ms-0 stretched-link" for="'.$row->VendorCode.'">'.$row->VendorCode.'</label>
                                    </div> 
                                </li>';
                            }
                        ?>
                    </ul>
                </div>  
                <?=  $varianlist ?>
            </div>
            <div class="input-group d-sm-flex d-none">  
                <input class="form-control form-control-sm input-form combo" id="searchdatacategory" placeholder="Pilih Kategori Produk" value="" type="text" data-start="" data-end="" readonly style="background: white;">
                <i class="fa-solid fa-filter"></i>
                <i class="fa-solid fa-caret-down"></i>
                <div class="filter-data " style="width: 18rem;" for="searchdatacategory">
                    <ul class="list-group">
                        <?php
                            foreach($category as $row){ 
                                echo '
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-0 px-2">
                                    <div class="form-check w-100">
                                        <input class="form-check-input category" type="checkbox" data-group="category" data-value="'.$row->ProdukCategoryCode.'" value="'.$row->ProdukCategoryCode.'" id="category-'.$row->ProdukCategoryCode.'">
                                        <label class="form-check-label ps-0 ms-0 stretched-link " for="category-'.$row->ProdukCategoryCode.'">'.$row->ProdukCategoryCode.' - '.$row->ProdukCategoryName.'</label>
                                    </div> 
                                </li> ';
                            }
                        ?>
                        
                    </ul>
                </div>
            </div> 
            <div class="input-group flex-fill">  
                <input class="form-control form-control-sm input-form" id="searchdataproduk" placeholder="Cari nama produk" value="" type="text">
                <i class="fa-solid fa-magnifying-glass"></i> 
                <div class="d-sm-none d-block ps-2">
                    <button class="btn btn-sm btn-secondary rounded"  data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><i class="fa-solid fa-filter"></i></button>
                </div>
            </div>  
        </div>
    </div> 
    <div class="card-body py-0 px-4" id="table" style="min-height:100vh;"> 
        <table id="data-table-item" class="display table table-hover">
            <thead>
                <tr> 
                    <th></th>
                    <th class="text-center">Gambar</th>
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead> 
            <tbody> 
            </tbody>
        </table>
    </div>
    <!-- <div class="card-body py-4" id="element-to-print" style="min-height:100vh;"> 
         
    </div>   -->
</div>    
<!-- <div class="row justify-content-between">
    <div class="d-md-flex justify-content-between justify-content-sm-center align-items-center dt-layout-start col-md-auto mr-auto">
        <div class="dt-info pt-1" aria-live="polite" id="table-toko_info" role="status">Showing 1 to 10 of 10 entries</div>
    </div>
    <div class="d-md-flex justify-content-between justify-content-sm-center align-items-center dt-layout-end col-md-auto ml-auto">
        <div class="dt-paging pt-1">
            <nav aria-label="pagination">
                <ul class="pagination" id="paging-data">
                    <li class="dt-paging-button page-item disabled"><a class="page-link first" aria-controls="table-toko" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a></li>
                    <li class="dt-paging-button page-item disabled"><a class="page-link previous" aria-controls="table-toko" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a></li>
                    <li class="dt-paging-button page-item active"><a href="#" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">1</a></li>
                    <li class="dt-paging-button page-item disabled"><a class="page-link next" aria-controls="table-toko" aria-disabled="true" aria-label="Next" data-dt-idx="next" tabindex="-1">›</a></li>
                    <li class="dt-paging-button page-item disabled"><a class="page-link last" aria-controls="table-toko" aria-disabled="true" aria-label="Last" data-dt-idx="last" tabindex="-1">»</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>   -->
<div style="margin-bottom: 100px;"></div> 
<script>
    	 
    var paging = 1;
    var filter_arr = {
        "Vendor":[], 
    };
    var filter_category = []
    var data_varian = JSON.parse('<?= json_encode(array_column($varian, 'name')) ?>');
    data_varian.forEach(function(value) {
        filter_arr[value] = [];
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
    $(".filter-data.desktop .list-group-item.utama").hover(function(){ 
        $(".filter-list.desktop[data-value='" +  $(this).find("span").html() + "'").show();
        $(".filter-list.desktop[data-value='" +  $(this).find("span").html() + "'").css("top",$(this).position()["top"] + 30)  
    }, function () {  
        if (!$(".filter-list.desktop[data-value='" +  $(this).find("span").html() + "'").is(':hover')) {  
            $(".filter-list.desktop[data-value='" +  $(this).find("span").html() + "'").hide();
        }else{
            var ele = $(this);
            $(".filter-list.desktop[data-value='" +  $(this).find("span").html() + "'").hover(function() { 
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
        for (var key in filter_arr) { 
            (filter_arr[key].length === 0 ?  $("#badge-" + key.replace(/\s+/g, '')).html("") : $("#badge-" + key.replace(/\s+/g, '')).html(filter_arr[key].length));  
            total += filter_arr[key].length;
        } 
        (total === 0 ?  $("#searchdatafilter").val("") : $("#searchdatafilter").val(String(total) + " varian dipilih"));
       // loader_datatable();
        
        table.ajax.reload(null, false);
    } 
    function tambahArrayVarian(namaGrup, nilai) {
        if (!filter_arr[namaGrup]) {
            filter_arr[namaGrup] = [];
        }
        filter_arr[namaGrup].push(nilai);  
    } 
    function hapusArrayVarian(namaGrup, nilai) {
        if (filter_arr[namaGrup]) {
            var index = filter_arr[namaGrup].indexOf(nilai);
            if (index !== -1) {
                filter_arr[namaGrup].splice(index, 1);
            }
        } 
    } 
    $('.form-check-input.varian').change(function() { 
        if ($(this).is(':checked')) {
            tambahArrayVarian($(this).data("group"), $(this).data("value"))
        }else{  
            hapusArrayVarian($(this).data("group"), $(this).data("value")) 
        } 
        load_badge_varian()
    })
    $('.form-check-input.category').change(function() { 
        if ($(this).is(':checked')) {
            filter_category.push($(this).data("value")) 
        }else{  
            var index = filter_category.indexOf($(this).data("value"));
            if (index !== -1) {
                filter_category.splice(index, 1);
            } 
        } 
        (filter_category.length === 0 ?  $("#searchdatacategory").val("") : $("#searchdatacategory").val(String(filter_category.length) + " kategori dipilih")); 
        //loader_datatable();
        
        table.ajax.reload(null, false);
    })

    // FILTER SEARCH
    $("#searchdataproduk").keyup(function(){
        table.ajax.reload(null, false);
        //loader_datatable();
    })
    function load_paging(i){
        paging = i;
        //loader_datatable();
        
        table.ajax.reload(null, false);
    }

    
    table = $('#data-table-item').DataTable({ 
        "searching": false,
        "lengthChange": false, 
        "pageLength": parseInt(10),
        "language": {
            "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "loadingRecords":  `<div class="loading-spinner"></div>`,
            "processing":  `<div class="loading-spinner"></div>`,
        }, 
        "order": [[1, "asc"]],
        "processing": true,
        "serverSide": true, 
        "ajax": {
            "url": "<?= base_url()?>datatables/get-datatable-produk",
            "type": "POST", 
            "data": function(data){ 
                data["search"]["value"] =  $("#searchdataproduk").val();
                data["filter"] = filter_arr;
                data["category"] = filter_category;
                data["paging"] = paging;
            }
        }, 
        "columns": [
            { data: null ,orderable: false,width: "20px",className:"p-0 ps-2",
                render: function(data, type, row) {
                    return '<a class="pointer text-head-3 btn-detail-item"><i class="fa-solid fa-chevron-right"></i></a>';
                }
            }, 
            { data: "image",orderable: false , className:"text-center", width: "50px"},  
            { data: "kategori"}, 
            { data: "name"  },  
            { data: "harga" , className:"text-center"}, 
            { data: "action" ,orderable: false , className:"action-td",width: "100px"}, 
        ] 
    }); 

    table.on('draw.dt', function() { 
        var info = table.page.info();
        if (info.page + 1 > info.pages) {
            table.page('last').draw('page');
        }
    });
    table.on('click', '.btn-detail-item', function() {
        var tr = $(this).closest('tr');
        tr.toggleClass('tr-child');
        var row = table.row(tr);
        var data = row.data();

        // Tampilkan data nested
        if (row.child.isShown()) {
            row.child.hide(); 
            $(this).find('i').removeClass('fa-rotate-270');  
        } else {  
            $(this).find('i').addClass('fa-rotate-270');  
            var childRow = row.child(format(data)).show(); 
            $(tr).next().addClass('child-row');
            $(tr).next().find('td:not(.detail)').addClass('p-0 ps-5'); 
            $(tr).find('td').addClass('no-border');
        } 
    });
    function format(data) {
        var detailitem = data.variandetail;
        
        var tr = $(this).closest('tr');

        var tablecustom = $("<table class='table'>");
        var theadcustom = $("<thead>");
        var tbodycustom = $("<tbody>");

        // Buat header tabel
        var headercustom = $("<tr>"); 
        headercustom.append($("<th class='detail'>").text("Gambar"));
        $.each(detailitem[0]["ProdukDetailVarian"], function(key, value) {   
            headercustom.append($("<th class='detail'>").text(key)); 
        });    
        headercustom.append($("<th class='detail'>").text("Berat"));
        headercustom.append($("<th class='detail'>").text("Satuan"));
        headercustom.append($("<th class='detail'>").text("isi /M2"));
        headercustom.append($("<th class='detail'>").text("Harga Beli"));
        headercustom.append($("<th class='detail'>").text("Harga Jual")); 
        headercustom.append($("<th class='detail'>").text("Action").attr("width","100px")); 
        theadcustom.append(headercustom);
        // Buat baris tabel 
        for(var i = 0; i < detailitem.length;i++){ 
            var trcustom = $("<tr>"); 
            
            trcustom.append($("<td class='detail'>").html("<img src='" + detailitem[i]["ProdukDetailImage"]  + "' alt='Gambar' class='image-produk'>"));
            $.each(detailitem[i]["ProdukDetailVarian"], function(key, value) {  
                trcustom.append($("<td class='detail'>").text(value));
            });     
            trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailBerat"]));
            trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailSatuanText"]));
            trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailPcsM2"]));
            trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailHargaBeli"]));
            trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailHargaJual"]));
            trcustom.append($("<td class='detail'>").html(`
            <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="edit_click_detail(${detailitem[i]["ProdukDetailRef"]},${detailitem[i]["ProdukDetailId"]},this)"><i class="fa-solid fa-pen-to-square"></i></span>`));
            tbodycustom.append(trcustom);
        }

        // Gabungkan tabel
        tablecustom.append(theadcustom);
        tablecustom.append(tbodycustom);

        return tablecustom; 
    }
    var xhr_load_produk;
    function loader_datatable(){
        // if (xhr_load_produk) {
        //     xhr_load_produk.abort();
        // }

        // xhr_load_produk = $.ajax({ 
        //     dataType: "json",
        //     method: "POST",
        //     url: "<?= base_url()?>datatables/get-data-produk", 
        //     data:{  
        //         "search" : $("#searchdataproduk").val(),
        //         "filter" : filter_arr, 
        //         "category" : filter_category,
        //         "paging" : paging
        //     },
        //     success: function(data) {       
        //         if(data["status"]===true){ 
        //             $("#element-to-print").html(data["html"])   


        //             // paging data
        //             if(data["total"] == 0){
        //                  $("#table-toko_info").html("Tidak ada data yang ditampilkan")
        //             }else{
        //                 $("#table-toko_info").html("Tampilkan " + (data["paging"] + 1) +" sampai " + (data["paging"] + data["totalresult"]) +" dari " + data["total"] + " data") ;
        //             }
        //             var page = Math.ceil(data["total"] / 10);
        //             if(page == 0){ 
        //                 paging = 1; 
        //             }else{
        //                 if(paging > page) load_paging(page)   
        //             }
                    
                    
        //             var page_html = `    
        //                 <li class="dt-paging-button page-item"><a onclick="load_paging(${1})" class="page-link first" aria-controls="table-toko" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a></li>
        //                 <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == 1 ? paging : paging - 1)})" class="page-link previous" aria-controls="table-toko" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a></li>
        //             `;  

        //             if(page > 5){
        //                 if(paging < 3){
        //                     page_html += '<li class="dt-paging-button page-item ' + (paging == 1 ? "active" : "") + '"><a onclick="load_paging(1)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">1</a></li>';
        //                     page_html += '<li class="dt-paging-button page-item ' + (paging == 2 ? "active" : "") + '"><a onclick="load_paging(2)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">2</a></li>';
        //                     page_html += '<li class="dt-paging-button page-item ' + (paging == 3 ? "active" : "") + '"><a onclick="load_paging(3)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">3</a></li>';
        //                 }else if((paging + 2 ) > page){
        //                     page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
        //                     page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 2) ? "active" : "") + '"><a onclick="load_paging('+ (page - 2) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (page - 2) +'</a></li>';
        //                     page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 1) ? "active" : "") + '"><a onclick="load_paging('+ (page - 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (page - 1) +'</a></li>';
        //                     page_html += '<li class="dt-paging-button page-item ' + (paging == page ? "active" : "") + '"><a onclick="load_paging('+ page +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ page +'</a></li>';
        //                 }else{
        //                     page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
        //                     page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+ (paging - 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (paging - 1) +'</a></li>';
        //                     page_html += '<li class="dt-paging-button page-item active"><a onclick="load_paging('+ paging +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ paging +'</a></li>';
        //                     if(paging !== page)  page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+ (paging + 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (paging + 1) +'</a></li>';
        //                 } 
        //                 if((paging + 1 ) < page) page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
                        
        //             }else{ 
        //                 for(let i = 1; page + 1 > i;i++){
        //                     if(paging == i){ 
        //                         page_html += '<li class="dt-paging-button page-item active"><a onclick="load_paging('+i+')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ i +'</a></li>';
        //                     }else{ 
        //                         page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+i+')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ i +'</a></li>';
        //                     }
        //                 }
        //             }

        //             page_html += `    
        //                 <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == page ? paging : paging + 1)})" class="page-link next" aria-controls="table-toko" aria-disabled="true" aria-label="Next" data-dt-idx="next" tabindex="-1">›</a></li>
        //                 <li class="dt-paging-button page-item"><a onclick="load_paging(${page})" class="page-link last" aria-controls="table-toko" aria-disabled="true" aria-label="Last" data-dt-idx="last" tabindex="-1">»</a></li>
        //             `;
        //             $("#paging-data").html(page_html);




        //         }else{
        //             Swal.fire({
        //                 icon: 'error',
        //                 text: data, 
        //                 confirmButtonColor: "#3085d6", 
        //             });
        //         }   
        //     },
        //     error : function(xhr, textStatus, errorThrown){   
        //         if (textStatus === 'abort') {
        //             // request AJAX dibatalkan, tidak perlu menampilkan error
        //             return;
        //         }
        //         Swal.fire({
        //             icon: 'error',
        //             text: xhr["responseJSON"]['message'], 
        //             confirmButtonColor: "#3085d6", 
        //         });
        //     }
        // });
    }
    //loader_datatable();

    let isProcessingSave = false;
    let isProcessingAdd = false; 
    let isProcessingEdit = false; 
    let isProcessingReset = false;
    let isProcessingDelete = false;  

    // var table ="";
    // if (window.innerWidth <= 400) {
    //     table = $('#table-produk').DataTable({
    //         "responsive": false,
    //         "searching": false,
    //         "lengthChange": false, 
    //         "pageLength": parseInt(10),
    //         "language": {
    //             "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
    //             "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
    //             "loadingRecords":  `<div class="loading-spinner"></div>`,
    //             "processing":  `<div class="loading-spinner"></div>`,
    //         },
    //         "processing": true,
    //         "serverSide": true, 
    //         "ajax": {
    //             "url": "<?= base_url()?>datatables/get-data-produk",
    //             "type": "POST", 
    //             "data": function(data){
    //                 data["search"]["value"] = $("#input-search-data").val()
    //             }
    //         }, 
    //         "columns": [
    //             { data: "produk_name",orderable: false,},  
    //             { data: "vendor_detail" ,orderable: false,visible: false, },  
    //             { data: "ProdukPrice" ,orderable: false , className:"text-center",visible: false,}, 
    //             { data: "action" ,orderable: false , className:"action-td"}, 
    //         ],
    //         "rowCallback": function(row, data) {
    //             $(row).attr('data-id', data.id);
    //         } 
    //     }); 
    // }else{
    //     table = $('#table-produk').DataTable({
    //         "responsive": {
    //             "details": {
    //                 "type": 'column'
    //             }
    //         },
    //         "searching": false,
    //         "lengthChange": false, 
    //         "pageLength": parseInt(10),
    //         "language": {
    //             "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
    //             "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
    //             "loadingRecords":  `<div class="loading-spinner"></div>`,
    //             "processing":  `<div class="loading-spinner"></div>`,
    //         },
    //         "processing": true,
    //         "serverSide": true, 
    //         "ajax": {
    //             "url": "<?= base_url()?>datatables/get-data-produk",
    //             "type": "POST", 
    //             "data": function(data){
    //                 data["search"]["value"] = $("#input-search-data").val()
    //             }
    //         }, 
    //         "columns": [
    //             { data: "produk_name"},  
    //             { data: "vendor_detail" ,orderable: false },  
    //             { data: "ProdukPrice" ,orderable: false , className:"text-center"}, 
    //             { data: "action" ,orderable: false , className:"action-td"}, 
    //         ],
    //         "rowCallback": function(row, data) {
    //             $(row).attr('data-id', data.id);
    //         } 
    //     }); 
    // }
    // $("#input-search-data").keyup(function(){
    //     table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    // })
    // $("#btn-search-data").click(function(){
    //     table.ajax.reload(null, false).responsive.recalc().columns.adjust();
    // })

    // // Tampilkan detail ketika baris diklik
    // $('#table-produk tbody button').on('click', function(event) {
    //     event.stopPropagation();
    // }); 
    // table.on('click', 'tr', function(event) {
    //     var target = $(event.target);  
    //     if (
    //         target.closest('button').length ||  
    //         target.parents().hasClass("varian-item-table") ||  
    //         target.parents().hasClass("varian")  ||  
    //         target.parent().hasClass("varian-item-table") ||  
    //         target.parent().hasClass("varian") ||  
    //         target.hasClass("varian") ||  
    //         target.hasClass("varian-item-table") ||  
    //         target.closest('th').length
    //     ) {
    //         return;
    //     }

    //     if (table.row(this).child.isShown()) { 
    //         $('div.varian-detail', table.row(this).child()).slideUp( function () {
    //             table.row(this).child.hide(); 
    //         } );
    //     } else {
    //         var data = table.row(this).data(); 
    //         var detailHtml = `  <div class="varian-detail">
    //                     <div class="row varian">
    //                         <div class="col-12 col-md-4 mb-md-0 mb-2 d-none d-md-block"> 
    //                             <div class="row"> 
    //                                 <span class="label-head-dialog">Varian</span>   
    //                             </div>
    //                         </div>
    //                         <div class="col-12 col-md-8 mb-md-0 mb-2  d-none d-md-block">
    //                             <div class="row"> 
    //                                 <div class="col-2"> 
    //                                     <span class="label-head-dialog">Berat</span>   
    //                                 </div> 
    //                                 <div class="col-2"> 
    //                                     <span class="label-head-dialog">Satuan</span>   
    //                                 </div> 
    //                                 <div class="col-2"> 
    //                                     <span class="label-head-dialog">Isi /M<sup>2</sup></span>   
    //                                 </div> 
    //                                 <div class="col-3"> 
    //                                     <span class="label-head-dialog">Harga Beli</span>   
    //                                 </div> 
    //                                 <div class="col-3"> 
    //                                     <span class="label-head-dialog">Harga Jual</span>   
    //                                 </div> 
    //                             </div>
    //                         </div> 
    //                     </div> `; 
    //         $.each(JSON.parse(data.produk_detail), function(index, value) { 
    //             const data = JSON.parse(value.ProdukDetailVarian) 
    //             let varian = "";
    //             var i = 0;
    //             Object.keys(data).forEach(function (key) {
    //                 varian += '<span class="badge badge-'+ i % 5 +'">' + key + ' : '+data[key]+'</span>'; 
    //                 i++; 
    //             });   
    //             detailHtml +=  `
    //                         <div class="row m-2 varian-item-table" data-id="${index}">
    //                             <div class="col-10 col-md-4 my-2"> 
    //                                 <div class="row">
    //                                     <div class="col-12 col-md"> 
    //                                         <div class="d-flex gap-1 flex-column flex-md-row">  
    //                                             ${varian}
    //                                         </div>  
    //                                     </div>
    //                                 </div>
    //                             </div> 
    //                             <div class="col-1 col-md-0 my-2 d-inline-block d-md-none"> 
    //                                 <button class="btn btn-sm btn-primary btn-detail"><i class="fa-solid fa-chevron-up"></i></button>
    //                             </div>
    //                             <div class="col-12 col-md-8 my-2 detail">
    //                                 <div class="row"> 
    //                                     <div class="col-6 col-md-2 px-1"> 
    //                                         <div class="mb-3">
    //                                             <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Berat</span>
    //                                             <div class="input-group mb-3"> 
    //                                                 <input type="text" class="form-control form-control-sm input-form berat" value="${value["ProdukDetailBerat"]}" data-id="${index}" disabled>
    //                                                 <span class="input-group-text font-std">(g)</span>
    //                                             </div> 
    //                                         </div>
    //                                     </div> 
    //                                     <div class="col-6 col-md-2 px-1">  
    //                                         <div class="mb-3">
    //                                             <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Satuan</span>
    //                                             <div class="input-group"> 
    //                                                 <select class="form-select form-select-sm satuan_id" data-id="${index}" style="width:100%" disabled>
    //                                                     <option selected>${value["ProdukSatuanName"]}</option>
    //                                                 </select>   
    //                                             </div>     
    //                                         </div>  
    //                                     </div> 
    //                                     <div class="col-12 col-md-2 px-1"> 
    //                                         <div class="mb-3">
    //                                             <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Isi M/<sup>2</sup></span>
    //                                             <div class="input-group"> 
    //                                                 <input type="text"class="form-control form-control-sm  input-form d-inline-block pcsM2" data-id="${index}" value="${value["ProdukDetailPcsM2"]}" disabled>
    //                                             </div>   
    //                                         </div>  
    //                                     </div> 
    //                                     <div class="col-6 col-md-3 px-1"> 
    //                                         <div class="mb-3">
    //                                             <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga Beli</span>
    //                                             <div class="input-group">  
    //                                                 <span class="input-group-text font-std">Rp.</span> 
    //                                                 <input type="text"class="form-control form-control-sm  input-form d-inline-block hargabeli" data-id="${index}" value="${value["ProdukDetailHargaBeli"]}" disabled>
    //                                             </div>   
    //                                         </div>  
    //                                     </div> 
    //                                     <div class="col-6 col-md-3 px-1"> 
    //                                         <div class="mb-3">
    //                                             <span class="label-head-dialog"><span class="d-inline-block d-md-none pe-2">Harga Jual</span>
    //                                             <div class="input-group"> 
    //                                                 <span class="input-group-text font-std">Rp.</span>
    //                                                 <input type="text"class="form-control form-control-sm  input-form d-inline-block hargajual" data-id="${index}" value="${value["ProdukDetailHargaJual"]}" disabled>
    //                                             </div>   
    //                                         </div>      
    //                                     </div> 
    //                                 </div>    
    //                             </div>   
    //                         </div>  `;
    //         }); 
            
    //         detailHtml+= "</div>";
    //         table.row(this).child(detailHtml,'no-padding').show(); 
    //         $('div.varian-detail', table.row(this).child()).slideDown(); 

           
    //     }
    //     $(".btn-detail").click(function(){
    //         var detail = $(this).parent().parent().find(".detail");
    //         if($(detail).hasClass("hide")){
    //             $(detail).removeClass("hide");
    //             $(this).find("i").removeClass("fa-rotate-180");
    //         }else{ 
    //             $(detail).addClass("hide");
    //             $(this).find("i").addClass("fa-rotate-180");
    //         }
    //     });
        
    // }); 

    add_click = function(el){ 
         // INSERT LOADER BUTTON
         if (isProcessingAdd) {
            return;
        }  
        isProcessingAdd = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');
        // END LOADER BUTTON

        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/add-produk", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-produk").modal("show"); 

                $("#modal-add-produk").on("hidden.bs.modal",function(){
                    loader_datatable();
                })   
                isProcessingAdd = false;
                $(el).html(old_text);
            },
            error: function(xhr, textStatus, errorThrown){
                isProcessingAdd = false;
                $(el).html(old_text);
                
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    } 
    edit_click = function(id,el){
        if (isProcessingEdit) {
            return;
        }  
        isProcessingEdit = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');
       
        $.ajax({ 
            method: "POST",
            url: "<?= base_url() ?>message/edit-produk/" + id, 
            success: function(data) {   
                isProcessingEdit = false;
                $(el).html(old_text);
                $("#modal-message").html(data);
                $("#modal-edit-produk").modal("show");  

                $("#modal-edit-produk").on("hidden.bs.modal",function(){
                    loader_datatable();
                });   
            },
            error: function(xhr, textStatus, errorThrown){
                isProcessingEdit = false;
                $(el).html(old_text);  
                
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
 
            }
        });  
    } 
  
    delete_click = function(id,el){
        // INSERT LOADER BUTTON
        if (isProcessingDelete) {
            return;
        }  
        isProcessingDelete = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus produk ini...???",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Yakin Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/delete-data-produk/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        loader_datatable();
                    }, 
                });
            }
            isProcessingDelete = false;
            $(el).html(old_text); 
        });
    }

</script>
<?php $this->endSection(); ?>