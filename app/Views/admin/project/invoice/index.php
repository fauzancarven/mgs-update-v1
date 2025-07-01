<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>

<div class="card radius-15 overflow-hidden mb-3 border-0 shadow-sm">
    <div class="card-header border-bottom-0 px-4 pt-4 pb-0 bg-white mb-lg-0 mb-2">  
        <div class="d-flex align-items-center mb-4 "> 
            <div class="p-1 flex-fill" > 
                <h4 class="mb-0">LIST INVOICE</h4> 
            </div>     
            <div class="justify-content-end d-flex gap-1"> 
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-block ps-2">Tambah Invoice<span></button>
            </div>  
        </div>
        <!-- BAGIAN FILTER -->
        <div class="d-flex align-items-center justify-content-end mb-2 g-2 row search-data">   
            
            <div class="input-group">  
                <input class="form-control form-control-sm input-form combo" id="storedatafilter" placeholder="Toko" value="" type="text" data-start="" data-end="" readonly style="background: white;">
                <i class="fa-solid fa-store"></i> 
                <i class="fa-solid fa-caret-down"></i>
                <div class="filter-data left" style="width: 18rem;" for="storedatafilter">
                    <ul class="list-group w-75" > 
                        <?php
                        foreach($store as $row){
                            echo '
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-0 px-2">
                                <div class="form-check w-100">
                                    <input class="form-check-input select store" type="checkbox" data-group="store" data-value="'.$row->StoreId.'" value="'.$row->StoreId.'" id="store-'.$row->StoreId.'">
                                    <label class="form-check-label ps-0 ms-0 stretched-link" for="store-'.$row->StoreId.'">'.$row->StoreCode.'</label>
                                </div> 
                            </li>';
                        }
                        ?> 
                       
                    </ul>
                </div>
            </div>   
            <div class="input-group d-sm-flex d-none">  
                <input class="form-control form-control-sm input-form" id="searchdatadate" placeholder="Tanggal" value="" type="text" data-start="" data-end="" readonly style="background: white;">
                <i class="fa-solid fa-calendar-days"></i> 
            </div>  
            <div class="input-group">  
                <input class="form-control form-control-sm input-form combo" id="searchdatafilter" placeholder="Status" value="" type="text" data-start="" data-end="" readonly style="background: white;">
                <i class="fa-solid fa-filter"></i>
                <i class="fa-solid fa-caret-down"></i>
                <div class="filter-data left" style="width: 18rem;" for="searchdatafilter">
                    <ul class="list-group w-75" > 
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-0 px-2">
                            <div class="form-check w-100">
                                <input class="form-check-input select category" type="checkbox" data-group="category" data-value="0" value="New" id="status-0">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="status-0">New</label>
                            </div> 
                        </li>   
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-0 px-2">
                            <div class="form-check w-100">
                                <input class="form-check-input select category" type="checkbox" data-group="category" data-value="1" value="Proses" id="status-1">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="status-1">Proses</label>
                            </div> 
                        </li>   
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-0 px-2">
                            <div class="form-check w-100">
                                <input class="form-check-input select category" type="checkbox" data-group="category" data-value="2" value="Proses" id="status-2">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="status-2">Completed</label>
                            </div> 
                        </li>   
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-0 px-2">
                            <div class="form-check w-100">
                                <input class="form-check-input select category" type="checkbox" data-group="category" data-value="3" value="Finish" id="status-3">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="status-3">Cancel</label>
                            </div> 
                        </li>   
                    </ul>
                </div>
            </div>  
            <div class="input-group flex-fill">  
                <input class="form-control form-control-sm input-form" id="searchdatainvoice" placeholder="Cari nama project, catatan, lokasi ataupun nomer dokumen" value="" type="text">
                <i class="fa-solid fa-magnifying-glass"></i>   
                <div class="d-sm-none d-block ps-2">
                    <button class="btn btn-sm btn-secondary rounded"  data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><i class="fa-solid fa-filter"></i></button>
                </div> 
                <div class="d-sm-none d-block ps-1">
                    <button class="btn btn-sm btn-secondary rounded"  data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop-date" aria-controls="staticBackdrop"><i class="fa-solid fa-calendar-days"></i></button>
                </div>
            </div>  
        </div> 
    </div>
    <div class="card-body py-0 px-4 pb-4" id="table"> 
        <table id="data-table-invoice" class="table table-hover table-nested">
            <thead>
                <tr> 
                    <th></th>
                    <th>Action</th>
                    <th>Store</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Admin</th>
                    <th>Customer</th>
                    <th>Pembayaran</th> 
                    <th>Pengiriman</th> 
                    <th>Grand Total</th> 
                </tr>
            </thead> 
            <tbody> 
            </tbody>
        </table>
    </div>  
</div>   

<div class="modal fade" id="modal-print-invoice" tabindex="-1" data-id="0" aria-labelledby="modal-print-invoiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-print-invoiceLabel">Print Invoice</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row mb-1 align-items-center mt-2">
                    <label for="InvPrintFormat" class="col-sm-4 col-form-label">Ukuran Kertas</label>
                    <div class="col-sm-8">
                        <select class="form-select form-select-sm" id="InvPrintFormat" name="InvPrintFormat" placeholder="Pilih Admin" style="width:100%">
                            <option id="A4" selected>A4</option>
                            <option id="A5" >A5</option>
                        </select>  
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="InvPrintImage" class="col-sm-4 col-form-label">gunakan gambar item</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="InvPrintImage" id="InvPrintImage1" value="0">
                            <label class="text-detail" for="InvPrintImage1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="InvPrintImage" id="InvPrintImage2" value="1" checked>
                            <label class="text-detail" for="InvPrintImage2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2 d-none">
                    <label for="InvPrintTotal" class="col-sm-4 col-form-label">gunakan grand total</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="InvPrintTotal" id="InvPrintTotal1" value="0">
                            <label class="text-detail" for="InvPrintTotal1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="InvPrintTotal" id="InvPrintTotal2" value="1" checked>
                            <label class="text-detail" for="InvPrintTotal2">Ya</label>
                        </div>
                    </div>
                </div>
                <script> 
                   $('#InvPrintFormat').change(function() {
                        if($(this).val() == "A5"){
                            $('input[name="InvPrintImage"]').prop("disabled",true)
                            $('input[name="InvPrintTotal"]').prop("disabled",true)
                        }else{

                            $('input[name="InvPrintImage"]').prop("disabled",false)
                            $('input[name="InvPrintTotal"]').prop("disabled",false)
                        }
                    });
                </script>   
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-print-invoice">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-print-payment" tabindex="-1" data-id="0" aria-labelledby="modal-print-invoiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-print-poLabel">Print Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row mb-1 align-items-center mt-2">
                    <label for="PaymentPrintFormat" class="col-sm-4 col-form-label">Ukuran Kertas</label>
                    <div class="col-sm-8">
                        <select class="form-select form-select-sm" id="PaymentPrintFormat" name="PaymentPrintFormat" placeholder="Pilih Admin" style="width:100%">
                            <option id="1" selected>A4</option>
                            <option id="2">A5</option>
                        </select>  
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="PaymentPrintImage" class="col-sm-4 col-form-label">gunakan gambar item</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintImage" id="PaymentPrintImage1" value="0">
                            <label class="text-detail" for="PaymentPrintImage1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintImage" id="PaymentPrintImage2" value="1" checked>
                            <label class="text-detail" for="PaymentPrintImage2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2 d-none">
                    <label for="PaymentPrintPrice" class="col-sm-4 col-form-label">gunakan harga</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintPrice" id="PaymentPrintPrice1" value="0">
                            <label class="text-detail" for="PaymentPrintPrice1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintPrice" id="PaymentPrintPrice2" value="1" checked>
                            <label class="text-detail" for="PaymentPrintPrice2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2 d-none">
                    <label for="PaymentPrintTotal" class="col-sm-4 col-form-label">gunakan grand total</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintTotal" id="PaymentPrintTotal1" value="0">
                            <label class="text-detail" for="PaymentPrintTotal1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PaymentPrintTotal" id="PaymentPrintTotal2" value="1" checked>
                            <label class="text-detail" for="PaymentPrintTotal2">Ya</label>
                        </div>
                    </div>
                </div>   
                <script>
                   $('input[name="PaymentPrintPrice"]').change(function() {
                        if($(this).val() == 0){
                            $('input[name="PaymentPrintTotal"]').prop("disabled",true)
                        }else{

                            $('input[name="PaymentPrintTotal"]').prop("disabled",false)
                        }
                    });
                    // $("#POPrintFormat").change(function(){
                    //     if($(this).val() == "A5"){
                    //         $('input[name="POPrintTotal"]').prop("disabled",true)
                    //         $('input[name="POPrintPrice"]').prop("disabled",true)
                    //         $('input[name="POPrintImage"]').prop("disabled",true)
                    //     } else{ 
                    //         $('input[name="POPrintTotal"]').prop("disabled",false)
                    //         $('input[name="POPrintPrice"]').prop("disabled",false)
                    //         $('input[name="POPrintImage"]').prop("disabled",false)
                    //     }
                    // })
                </script>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-print-payment">Print</button>
            </div>
        </div>
    </div>
</div>
<div id='view-container'></div> 
<script src="https://unpkg.com/@panzoom/panzoom@4.6.0/dist/panzoom.min.js"></script>
<script>
    var xhr_load_project; 
    var filter_status_select = []
    var filter_store_select = []
    function loader_datatable(){
        // if (xhr_load_project) {
        //     xhr_load_project.abort();
        // }

        // xhr_load_project = $.ajax({ 
        //     dataType: "json",
        //     method: "POST",
        //     url: "<?= base_url()?>datatables/get-data-project/invoice", 
        //     data:{  
        //         "search" : $("#searchdatainvoice").val(), 
        //         "status" : filter_status_select, 
        //         "datestart" : $("#searchdatadate").data("start"),
        //         "dateend" : $("#searchdatadate").data("end"),
        //         "paging" : paging
        //     },
        //     success: function(data) {       
        //         if(data["status"]===true){ 
        //             $("#data-project").html(data["html"])   
        //         }else{
        //             Swal.fire({
        //                 icon: 'error',
        //                 text: data, 
        //                 confirmButtonColor: "#3085d6", 
        //             });
        //         }  
        //         load_paging_html(data);
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
    load_paging_html = function(data){ 
        // paging data
        if(data["total"] == 0){
            $("#table-toko_info").html("Tidak ada data yang ditampilkan")
        }else{
            $("#table-toko_info").html("Tampilkan " + (data["paging"] + 1) +" sampai " + (data["paging"] + data["totalresult"]) +" dari " + data["total"] + " data") ;
        }
        var page = Math.ceil(data["total"] / 10);
        if(page == 0){ 
            paging = 1; 
        }else{
            if(paging > page) load_paging(page)   
        }
         
        var page_html = `    
            <li class="dt-paging-button page-item"><a onclick="load_paging(${1})" class="page-link first" aria-controls="table-toko" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a></li>
            <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == 1 ? paging : paging - 1)})" class="page-link previous" aria-controls="table-toko" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a></li>
        `;  

        if(page > 5){
            if(paging < 3){
                page_html += '<li class="dt-paging-button page-item ' + (paging == 1 ? "active" : "") + '"><a onclick="load_paging(1)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">1</a></li>';
                page_html += '<li class="dt-paging-button page-item ' + (paging == 2 ? "active" : "") + '"><a onclick="load_paging(2)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">2</a></li>';
                page_html += '<li class="dt-paging-button page-item ' + (paging == 3 ? "active" : "") + '"><a onclick="load_paging(3)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">3</a></li>';
            }else if((paging + 2 ) > page){
                page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
                page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 2) ? "active" : "") + '"><a onclick="load_paging('+ (page - 2) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (page - 2) +'</a></li>';
                page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 1) ? "active" : "") + '"><a onclick="load_paging('+ (page - 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (page - 1) +'</a></li>';
                page_html += '<li class="dt-paging-button page-item ' + (paging == page ? "active" : "") + '"><a onclick="load_paging('+ page +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ page +'</a></li>';
            }else{
                page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
                page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+ (paging - 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (paging - 1) +'</a></li>';
                page_html += '<li class="dt-paging-button page-item active"><a onclick="load_paging('+ paging +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ paging +'</a></li>';
                if(paging !== page)  page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+ (paging + 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (paging + 1) +'</a></li>';
            } 
            if((paging + 1 ) < page) page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
            
        }else{ 
            for(let i = 1; page + 1 > i;i++){
                if(paging == i){ 
                    page_html += '<li class="dt-paging-button page-item active"><a onclick="load_paging('+i+')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ i +'</a></li>';
                }else{ 
                    page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+i+')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ i +'</a></li>';
                }
            }
        }

        page_html += `    
            <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == page ? paging : paging + 1)})" class="page-link next" aria-controls="table-toko" aria-disabled="true" aria-label="Next" data-dt-idx="next" tabindex="-1">›</a></li>
            <li class="dt-paging-button page-item"><a onclick="load_paging(${page})" class="page-link last" aria-controls="table-toko" aria-disabled="true" aria-label="Last" data-dt-idx="last" tabindex="-1">»</a></li>
        `;
        $("#paging-data").html(page_html);
    }
     // FILTER TANGGAL
    var start = moment().startOf('month');
    var end = moment().endOf('month');
    function cb(start, end) { 
        $("#searchdatadate").val(start.format('DD MMM YYYY') + ' - ' + end.format('DD MMM YYYY')); 
        $("#searchdatadate").data("start",start.format('YYYY/MM/DD'))
        $("#searchdatadate").data("end",end.format('YYYY/MM/DD'))
        table.ajax.reload(null, false);
    }
    $('#searchdatadate').daterangepicker({  
        autoUpdateInput: false,
        startDate: start,
        endDate: end,
        locale: {
            format: 'DD MMMM YYYY',
            cancelLabel: 'Reset'
        }
    },cb); 
    $('#searchdatadate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format('DD MMM YYYY'));
        $(this).data("start",picker.startDate.format('YYYY/MM/DD'))
        $(this).data("end",picker.endDate.format('YYYY/MM/DD'))
        //loader_datatable(); 
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).data("start","")
        $(this).data("end","")
        //loader_datatable(); 
        table.ajax.reload(null, false);
    });
    
    // FILTER SEARCH
    $("#searchdatainvoice").keyup(function(){
        //loader_datatable(); 
        table.ajax.reload(null, false);
    })
    $('#filterdatastatus').select2({
        multiple: true,
        templateSelection: function(selection) {
            var selected = $('#filterdatastatus').val().length;
            return selected + " item dipilih";
        }
    });
    $('#filterdatastatus').on('select2:select', function(e) {
        $('.select2-selection__choice').remove();
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
    $('.form-check-input.select.category').change(function() { 
        if ($(this).is(':checked')) {
            filter_status_select.push($(this).data("value")) 
        }else{  
            var index = filter_status_select.indexOf($(this).data("value"));
            if (index !== -1) {
                filter_status_select.splice(index, 1);
            } 
        } 
        (filter_status_select.length === 0 ?  $("#searchdatafilter").val("") : $("#searchdatafilter").val(String(filter_status_select.length) + " status dipilih"));
        //loader_datatable(); 
        table.ajax.reload(null, false); 
    }) 
    $('.form-check-input.select.store').change(function() { 
        if ($(this).is(':checked')) {
            filter_store_select.push($(this).data("value")) 
        }else{  
            var index = filter_store_select.indexOf($(this).data("value"));
            if (index !== -1) {
                filter_store_select.splice(index, 1);
            } 
        } 
        (filter_store_select.length === 0 ?  $("#storedatafilter").val("") : $("#storedatafilter").val(String(filter_store_select.length) + " toko dipilih")); 
        //loader_datatable(); 
        table.ajax.reload(null, false);
    }) 
    var paging = 1;
    var table; 
    
    // function load_paging(i){
    //     paging = i;
    //     //loader_datatable(); 
    //     table.ajax.reload(null, false);
    // }
    
    //loader_datatable();
    table = $('#data-table-invoice').DataTable({ 
        "searching": false,
        "lengthChange": false, 
        "pageLength": parseInt(10),
        "language": {
            "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "loadingRecords":  `<div class="loading-spinner"></div>`,
            "processing":  `<div class="loading-spinner"></div>`,
        }, 
        "autoWidth": false,
        "order": [[4, "desc"]],
        scrollX: true,
        "processing": true,
        "serverSide": true, 
        "ajax": {
            "url": "<?= base_url()?>datatables/get-datatable-invoice",
            "type": "POST", 
            "data": function(data){ 
                data["search"] =  $("#searchdatainvoice").val();
                data["store"] = filter_store_select;
                data["filter"] = filter_status_select;
                data["datestart"] = $("#searchdatadate").data("start");
                data["dateend"] = $("#searchdatadate").data("end");
            }
        }, 
        "initComplete": function(settings, json) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
        "columns": [ 
            { data: null ,orderable: false,width: "20px",className:"p-0 ps-2",
                render: function(data, type, row) {
                    return '<a class="pointer text-head-3 btn-detail-item"><i class="fa-solid fa-chevron-right"></i></a>';
                }
            }, 
            { data: "action" ,orderable: false , className:"action-td",width: "60px"}, 
            { data: "store", className:"align-top" , width: "150px"}, 
            { data: "code",orderable: false , className:"align-top", width: "120px"},
            { data: "date",width: "100px", className:"align-top"}, 
            { data: "status" ,width: "100px", className:"align-top"}, 
            { data: "admin" ,width: "100px", className:"align-top"},  
            { data: "customer",width: "250px",  className:"align-top",
                render: function(data, type, row) { 
                    var html = ` 
                        <div class="text-head-2 pb-2 text-truncate" style="width: 15rem;" data-bs-toggle="tooltip"  data-bs-title="${row.customer}">${row.customer}</div>
                        ${(row.customertelp !== "" ? `<div class="text-detail-3 pb-2"><i class="fa-solid fa-phone pe-1"></i>${row.customertelp}</div>` : "")}
                        <div class="text-detail-3 text-truncate" style="width: 15rem;" data-bs-toggle="tooltip"  data-bs-title="${row.customeraddress}"><i class="fa-solid fa-location-dot pe-1"></i>${row.customeraddress}</div>`;

                    return html;
                }
            }, 
            { data: "payment" ,orderable: false , width: "90px",className:"align-top"}, 
            { data: "delivery" ,orderable: false ,width: "90px", className:"align-top"},  
            { data: "total", className:"align-top",width: "auto"},  
        ] 
    }); 

    table.on('draw.dt', function() { 
        var info = table.page.info(); 
        if (info.page + 1 > info.pages && info.pages > 0) {
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
            $(tr).next().find('.view-detail').slideUp(500, function() {
                row.child.hide();
            });  
            $(this).find('i').removeClass('fa-rotate-90');  
        } else {  
            $(this).find('i').addClass('fa-rotate-90');  
            var childRow = row.child(format(data)).show();  
            $(tr).next().addClass('child-row');
            $(tr).next().find('td:not(.detail)').addClass('p-0 ps-2'); 
            $(tr).next().find('.view-detail').slideDown(500);
            $(tr).next().find('td').addClass('no-border');
            
        } 
    });
    function format(data) {
        return data.detail;  
    }   
    
    cb(start, end);
    tooltiprenew = function(){
         // Hapus tooltip sebelumnya
        var tooltipTriggerListOld = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerListOld.map(function (tooltipTriggerEl) {
            var tooltip = bootstrap.Tooltip.getInstance(tooltipTriggerEl);
            if (tooltip) {
                tooltip.dispose();
            }
        });
        $(".tooltip").remove(); 
        // Buat tooltip baru
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            var tooltip = new bootstrap.Tooltip(tooltipTriggerEl);
            if (tooltipTriggerEl.innerText?.includes('top')) {
                tooltip.enable();
            }
            return tooltip;
        });
    }
    var isProcessingInvoice;
    add_click = function(el){
        if (isProcessingInvoice) {
            console.log("add Invoice cancel load");
            return;
        }   
        isProcessingInvoice = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-invoice", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-invoice").modal("show"); 
                $("#modal-add-invoice").data("menu","Invoice");  

                isProcessingInvoice = false;
                $(el).html(old_text); 
                tooltiprenew();
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoice = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                }); 
                tooltiprenew();
            }
        });
    }

    print_invoice = function(id,el,ref){  
        $("#modal-print-invoice").modal("show");
        $("#modal-print-invoice").data("id",id) 
    };   
    $("#btn-print-invoice").click(function(i){ 
        $.redirect('<?= base_url("print/project/invoice/") ?>' +  $("#modal-print-invoice").data("id"),  {
            kertas: $("#InvPrintFormat").val(),
            image: $('input[name="InvPrintImage"]:checked').val(),
            total: $('input[name="InvPrintTotal"]:checked').val(),
        },
        "GET",'_blank');
        $("#modal-print-invoice").modal("hide");
        
    })

    var isProcessingInvoiceEdit;
    edit_invoice = function(id,el,ref){
        if (isProcessingInvoiceEdit) {
            console.log("edit Invoice cancel load");
            return;
        }   
        isProcessingInvoiceEdit = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-invoice/"+id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-invoice").modal("show"); 
                $("#modal-edit-invoice").data("menu","Invoice");  

                isProcessingInvoiceEdit = false;
                $(el).html(old_text); 
                tooltiprenew();
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoiceEdit = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                }); 
                tooltiprenew();
            }
        });
    }

    var isProcessingInvDelete = [];
    delete_invoice = function(id,el,ref){ 
         // INSERT LOADER BUTTON
        if (isProcessingInvDelete[id]) {
            return;
        }  
        isProcessingInvDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        tooltiprenew();
        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin membatalkan invoice ini.",
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
                    url: "<?= base_url() ?>action/delete-data-invoice/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Success!",
                            text: "Data invoice berhasil di batalkan.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        table.ajax.reload(null, false);
                    }, 
                });
            }
            isProcessingInvDelete[id] = false;
            $(el).html(old_text); 
        });
    };

    var IsUpdateStatus = [];
    update_status = function(status,id,el){ 
        if (IsUpdateStatus[id]) {
            console.log("project invoice cancel load");
            return;
        }  

        IsUpdateStatus[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>action/update-invoice/" + id +  "/" + status, 
            success: function(data) {     
                IsUpdateStatus[id] = false;
                $(el).html(old_text); 
                tooltiprenew();

                table.ajax.reload(null, false);
            },
            error: function(xhr, textStatus, errorThrown){ 
                IsUpdateStatus[id] = false;
                $(el).html(old_text); 
                tooltiprenew();

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    };  



    var isProcessingInvoicePayment = [];
    add_payment = function(id,el,type){
        // INSERT LOADER BUTTON
        if (isProcessingInvoicePayment[id]) {
            console.log("project invoice cancel load");
            return;
        }  
        isProcessingInvoicePayment[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-payment/" + id, 
            data:{
                type:type
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-payment").modal("show");  
                $("#modal-add-payment").data("menu","Invoice");  
                $(".tooltip").remove(); 

                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoicePayment[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    
    view_file = function(el){ 
        filetype = $(el).data("type");
        switch (filetype) { 
            case 'text/plain':
            case 'application/pdf':
            case 'application/msword':
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': 
                var viewerUrl = 'https://docs.google.com/viewer?url=' + encodeURIComponent('<?=base_url()?>'+$(el).data("file")) + '&embedded=true'; 
                $('#view-container').html(`<div style="position: fixed;padding: 0;margin: 0;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.5);display: flex;justify-content: center;align-items: end;z-index: 2000;">
                    <iframe src="${viewerUrl}" frameborder="0" style="width: 100vw;height: calc(100vh - 50px);"></iframe>
                    <div class="bar-action">
                        <span class="flex-fill">${$(el).data("name")}</span>  
                        <i class="fa-solid fa-xmark" onclick="closeIframe()"></i>
                    </div>
                    
                </div> `);
                break;    
            case 'image/jpeg':
            case 'image/png': 
                var viewerUrl = $(el).data("file"); 
                $('#view-container').html(`<div style="position: fixed;padding: 0;margin: 0;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.5);display: flex;justify-content: center;align-items: end;z-index: 2000;">
                    <div id="panzoom-container" style="width: 100vw;height: 100vh">
                        <img id="gambar" src="<?=base_url()?>${viewerUrl}"> 
                    </div>
                    <div class="bar-action">
                        <span class="flex-fill">${$(el).data("name")}</span>  
                        <i class="fa-solid fa-xmark" onclick="closeIframe()"></i>
                    </div> 
                    
                </div> `);
                //scrool('gambar'); 
                $("html, body").css("overflow","hidden");
                var elem = document.getElementById('panzoom-container');
                var panzoom = Panzoom(elem, {
                    maxScale: 5,
                    cursor: 'grab',
                    wheel: true, 
                    zoomSpeed: 0.1,
                    startScale: 0.5
                }); 
                
                var parent = elem.parentElement
                 

                // Panning and pinch zooming are bound automatically (unless disablePan is true).
                // There are several available methods for zooming
                // that can be bound on button clicks or mousewheel.
                parent.addEventListener('wheel', panzoom.zoomWithWheel)

                // This demo binds to shift + wheel
                parent.addEventListener('wheel', function(event) {
                    if (!event.shiftKey) return
                    panzoom.zoomWithWheel(event)
                })
                panzoom.reset();
                break;    
                 
            default: 
                // Tampilkan view untuk tipe file lain 
                break;
        }
    }

    closeIframe = function(){
        document.querySelector('div[style*="position: fixed"]').remove();
        
        $("html, body").css("overflow","auto");
    }


    print_payment = function(id,el,ref){ 
        //window.open('<?= base_url("print/project/paymentA5/") ?>' + id, '_blank');
        $("#modal-print-payment").modal("show");
        $("#modal-print-payment").data("id",id) 
    }
    
    $("#btn-print-payment").click(function(i){ 
        $.redirect('<?= base_url("print/project/payment/") ?>' +  $("#modal-print-payment").data("id"),  {
            kertas: $("#PaymentPrintFormat").val(),
            image: $('input[name="PaymentPrintImage"]:checked').val(),
            total: $('input[name="PaymentPrintTotal"]:checked').val(),
        },
        "GET",'_blank');
        $("#modal-print-payment").modal("hide"); 
    })
 
    var isProcessingInvoiceUpdate = [];
    update_invoice_delivery =function(id,el,status){
         // INSERT LOADER BUTTON
         if (isProcessingInvoiceUpdate[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingInvoiceUpdate[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            data:{
                status : status,
            },
            url: "<?= base_url() ?>action/update-data-invoice-delivery/" + id, 
            success: function(data) {  
                if(status == 1){ 
                    Swal.fire({
                        title: "Active!",
                        text: "Mode pengiriman berhasil diaktifkan",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                    });  
                }else{
                    Swal.fire({
                        title: "Deactive!",
                        text: "Mode pengiriman berhasil dinonaktifkan",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                    });  
                }
                table.ajax.reload(null, false);
                isProcessingInvoiceUpdate[id] = false;
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingInvoiceUpdate[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    var isProcessingDeliveryAdd = [];
    add_invoice_delivery = function(id,el){
         // INSERT LOADER BUTTON
         if (isProcessingDeliveryAdd[id]) {
            console.log("project invoice cancel load");
            return;
        }  
        isProcessingDeliveryAdd[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-delivery-invoice/" + id,  
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-delivery").modal("show");  
                $("#modal-add-delivery").data("menu","Invoice");  
                $(".tooltip").remove(); 

                isProcessingDeliveryAdd[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryAdd[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    
    var isProcessingDeliveryEdit = [];
    edit_invoice_delivery = function(id,el){
         // INSERT LOADER BUTTON
         if (isProcessingDeliveryEdit[id]) {
            console.log("project invoice cancel load");
            return;
        }  
        isProcessingDeliveryEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-delivery-invoice/" + id,  
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-delivery").modal("show");  
                $("#modal-edit-delivery").data("menu","Invoice");  
                $(".tooltip").remove(); 

                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingDeliveryEdit[id] = false;
                $(el).html(old_text); 

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    print_delivery = function(id){
        window.open('<?= base_url("print/project/deliveryA5/") ?>' + id, '_blank');
    }   
</script>


<div style="margin-bottom: 100px;"></div>  


<?php $this->endSection(); ?>