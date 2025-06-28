<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>

<div class="card radius-15 overflow-hidden mb-3 border-0 shadow-sm">
    <div class="card-header border-bottom-0 px-4 pt-4 pb-0 bg-white mb-lg-0 mb-2">  
        <div class="d-flex align-items-center mb-4 "> 
            <div class="p-1 flex-fill" > 
                <h4 class="mb-0">LIST PENAWARAN</h4> 
            </div>     
            <div class="justify-content-end d-flex gap-1"> 
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-block ps-2">Tambah Penawaran<span></button>
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
                                <input class="form-check-input select category" type="checkbox" data-group="category" data-value="2" value="Completed" id="status-2">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="status-2">Completed</label>
                            </div> 
                        </li>    
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-0 px-2">
                            <div class="form-check w-100">
                                <input class="form-check-input select category" type="checkbox" data-group="category" data-value="3" value="Cancel" id="status-3">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="status-3">Cancel</label>
                            </div> 
                        </li>   
                    </ul>
                </div>
            </div>  
            <div class="input-group flex-fill">  
                <input class="form-control form-control-sm input-form" id="searchdatasph" placeholder="Cari nama project, catatan, lokasi ataupun nomer dokumen" value="" type="text">
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
        <table id="data-table-sph" class="table table-hover table-nested">
            <thead>
                <tr> 
                    <th></th>
                    <th>Action</th>
                    <th>Store</th>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Admin</th>
                    <th>Customer</th>
                    <th>Grand Total</th> 
                </tr>
            </thead> 
            <tbody> 
            </tbody>
        </table>
    </div> 
    <!-- <div id="data-project"> 
    </div>

    <div class="row justify-content-between">
        <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto">
            <div class="dt-info pt-1" aria-live="polite" id="table-toko_info" role="status">Showing 1 to 10 of 10 entries</div>
        </div>
        <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ml-auto">
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
    </div> -->
</div>   
 
<!-- Modal PRINT -->
<div class="modal fade" id="modal-print-penawaran" tabindex="-1" data-id="0" aria-labelledby="modal-print-penawaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-print-penawaranLabel">Print Penawaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row mb-1 align-items-center mt-2">
                    <label for="SphPrintFormat" class="col-sm-4 col-form-label">Ukuran Kertas</label>
                    <div class="col-sm-8">
                        <select class="form-select form-select-sm" id="SphPrintFormat" name="SphPrintFormat" placeholder="Pilih Admin" style="width:100%">
                            <option id="1" selected>A4</option>
                        </select>  
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="SphPrintImage" class="col-sm-4 col-form-label">gunakan gambar item</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SphPrintImage" id="SphPrintImage1" value="0">
                            <label class="text-detail" for="SphPrintImage1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SphPrintImage" id="SphPrintImage2" value="1" checked>
                            <label class="text-detail" for="SphPrintImage2">Ya</label>
                        </div>
                    </div>
                </div>   
                <div class="row mb-1 align-items-center mt-2">
                    <label for="SphPrintTotal" class="col-sm-4 col-form-label">gunakan grand total</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SphPrintTotal" id="SphPrintTotal1" value="0">
                            <label class="text-detail" for="SphPrintTotal1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SphPrintTotal" id="SphPrintTotal2" value="1" checked>
                            <label class="text-detail" for="SphPrintTotal2">Ya</label>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-print-sph">Print</button>
            </div>
        </div>
    </div>
</div>
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
        //     url: "<?= base_url()?>datatables/get-data-project/sph", 
        //     data:{  
        //         "search" : $("#searchdatasph").val(), 
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
    $('#searchdatadate').daterangepicker({  
        autoUpdateInput: false,
        locale: {
            format: 'DD MMMM YYYY',
            cancelLabel: 'Reset'
        }
    });
    $('#searchdatadate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format('DD MMM YYYY'));
        $(this).data("start",picker.startDate.format('YYYY/MM/DD'))
        $(this).data("end",picker.endDate.format('YYYY/MM/DD'))
        //loader_datatable(); 
        table.ajax.reload(null, false);
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).data("start","")
        $(this).data("end","")
        //loader_datatable(); 
        table.ajax.reload(null, false);
    });
    
    // FILTER SEARCH
    $("#searchdatasph").keyup(function(){
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
    table = $('#data-table-sph').DataTable({ 
        "searching": false,
        "lengthChange": false, 
        "pageLength": parseInt(10),
        scrollX: true,
        "language": {
            "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "loadingRecords":  `<div class="loading-spinner"></div>`,
            "processing":  `<div class="loading-spinner"></div>`,
        }, 
        "order": [[4, "desc"]],
        "processing": true,
        "serverSide": true, 
        "ajax": {
            "url": "<?= base_url()?>datatables/get-datatable-penawaran",
            "type": "POST", 
            "data": function(data){ 
                data["search"] =  $("#searchdatasph").val();
                data["store"] = filter_store_select;
                data["filter"] = filter_status_select;
                data["datestart"] = $("#searchdatadate").data("start");
                data["dateend"] = $("#searchdatadate").data("end");
            }
        }, 
        "initComplete": function(settings, json) {
            tooltiprenew();
        },
        "columns": [ 
            { data: null ,orderable: false,width: "20px",className:"p-0 ps-2",
                render: function(data, type, row) {
                    return '<a class="pointer text-head-3 btn-detail-item"><i class="fa-solid fa-chevron-right"></i></a>';
                }
            },  
            { data: "action" ,orderable: false , className:"action-td",width: "30px"}, 
            { data: "store", className:"align-top" , width: "150px"}, 
            { data: "code", className:"align-top", width: "100px"}, 
            { data: "date", className:"align-top"}, 
            { data: "status" , className:"align-top"}, 
            { data: "admin" , className:"align-top"}, 
            { data: "customer",  className:"align-top",
                render: function(data, type, row) { 
                    var html = ` 
                        <div class="text-head-3 pb-2">${row.customer}</div>
                        ${(row.customertelp !== "" ? `<div class="text-detail-3 pb-1"><i class="fa-solid fa-phone pe-1"></i>${row.customertelp}</div>` : "")}
                        <div class="text-detail-3 text-truncate" style="max-width: 15rem;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="${row.customeraddress}"><i class="fa-solid fa-location-dot pe-1"></i>${row.customeraddress}</div>`;

                    return html;
                }
            }, 
            { data: "total", className:"align-top",width: "150px"},    
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

    var isProcessingSph;
    add_click = function(el){
        if (isProcessingSph) {
            console.log("project Penawaran cancel load");
            return;
        }   
        isProcessingSph = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-penawaran", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-penawaran").modal("show"); 
                $("#modal-add-penawaran").data("menu","Penawaran");  

                isProcessingSph = false;
                $(el).html(old_text); 
                tooltiprenew();
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSph = false;
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
    print_sph = function(id,el,ref,type = 1){  
        $("#modal-print-penawaran").modal("show");
        $("#modal-print-penawaran").data("id",id)
       // window.open('<?= base_url("print/project/sph/") ?>' + id + "/" + type, '_blank'); 
    }
    $("#btn-print-sph").click(function(i){ 
        $.redirect('<?= base_url("print/project/sph/") ?>' +  $("#modal-print-penawaran").data("id"),  {
            kertas: $("#SphPrintFormat").val(),
            image: $('input[name="SphPrintImage"]:checked').val(),
            total: $('input[name="SphPrintTotal"]:checked').val(),
        },
        "GET",'_blank');
        $("#modal-print-penawaran").modal("hide"); 
    }); 

    var isProcessingSphDelete = [];
    delete_sph = function(id,el,ref){ 
         // INSERT LOADER BUTTON
        if (isProcessingSphDelete[id]) {
            return;
        }  
        isProcessingSphDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        tooltiprenew();
        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin membatalkan penawaran ini.",
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
                    url: "<?= base_url() ?>action/delete-data-penawaran/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Success!",
                            text: "Data penawaran berhasil di batalkan.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        table.ajax.reload(null, false);
                    }, 
                });
            }
            isProcessingSphDelete[id] = false;
            $(el).html(old_text); 
        });
    };

    var isProcessingSphEdit = [];
    edit_sph = function(id,el,ref){
        if (isProcessingSphEdit[id]) {
            console.log("project Penawaran cancel load");
            return;
        }   
        isProcessingSphEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-penawaran/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-penawaran").modal("show"); 
                $("#modal-edit-penawaran").data("menu","Penawaran");  

                isProcessingSphEdit[id] = false;
                $(el).html(old_text); 
                tooltiprenew();
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSphEdit[id] = false;
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
    
    var IsUpdateStatus = [];
    update_status = function(status,id,el){ 
        if (IsUpdateStatus[id]) {
            console.log("project penawaran cancel load");
            return;
        }  

        IsUpdateStatus[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>action/update-penawaran/" + id +  "/" + status, 
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
</script>


<div style="margin-bottom: 100px;"></div>  


<?php $this->endSection(); ?>