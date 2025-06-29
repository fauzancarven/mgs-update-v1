<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>

<div class="card radius-15 overflow-hidden mb-3 border-0 shadow-sm">
    <div class="card-header border-bottom-0 px-4 pt-4 pb-0 bg-white mb-lg-0 mb-2">  
        <div class="d-flex align-items-center mb-4 "> 
            <div class="p-1 flex-fill" > 
                <h4 class="mb-0">LIST SURVEY</h4> 
            </div>    
            <div class="justify-content-end d-flex gap-1"> 
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-block ps-2">Tambah Survey<span></button>
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
                <input class="form-control form-control-sm input-form combo" id="statusdatafilter" placeholder="Status" value="" type="text" data-start="" data-end="" readonly style="background: white;">
                <i class="fa-solid fa-filter"></i>
                <i class="fa-solid fa-caret-down"></i>
                <div class="filter-data left" style="width: 18rem;" for="statusdatafilter">
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
                                <input class="form-check-input select category" type="checkbox" data-group="category" data-value="2" value="Finish" id="status-2">
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
                <input class="form-control form-control-sm input-form" id="searchdatasurvey" placeholder="Cari nama project, catatan, lokasi ataupun nomer dokumen" value="" type="text">
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
    <div class="card-body py-0 px-4 pb-4" > 
        <table id="data-table-survey" class="table table-hover table-nested">
            <thead>
                <tr> 
                    <th></th>
                    <th>Action</th>
                    <th>Toko</th>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Admin</th>
                    <th>Customer</th>
                    <th>Staff</th>
                    <th>Biaya</th>
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
    <div id='view-container'></div>
</div>   
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
        //     url: "<?= base_url()?>datatables/get-data-project/survey", 
        //     data:{  
        //         "search" : $("#searchdatasurvey").val(), 
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
        // // paging data
        // if(data["total"] == 0){
        //     $("#table-toko_info").html("Tidak ada data yang ditampilkan")
        // }else{
        //     $("#table-toko_info").html("Tampilkan " + (data["paging"] + 1) +" sampai " + (data["paging"] + data["totalresult"]) +" dari " + data["total"] + " data") ;
        // }
        // var page = Math.ceil(data["total"] / 10);
        // if(page == 0){ 
        //     paging = 1; 
        // }else{
        //     if(paging > page) load_paging(page)   
        // }
         
        // var page_html = `    
        //     <li class="dt-paging-button page-item"><a onclick="load_paging(${1})" class="page-link first" aria-controls="table-toko" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a></li>
        //     <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == 1 ? paging : paging - 1)})" class="page-link previous" aria-controls="table-toko" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a></li>
        // `;  

        // if(page > 5){
        //     if(paging < 3){
        //         page_html += '<li class="dt-paging-button page-item ' + (paging == 1 ? "active" : "") + '"><a onclick="load_paging(1)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">1</a></li>';
        //         page_html += '<li class="dt-paging-button page-item ' + (paging == 2 ? "active" : "") + '"><a onclick="load_paging(2)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">2</a></li>';
        //         page_html += '<li class="dt-paging-button page-item ' + (paging == 3 ? "active" : "") + '"><a onclick="load_paging(3)" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">3</a></li>';
        //     }else if((paging + 2 ) > page){
        //         page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
        //         page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 2) ? "active" : "") + '"><a onclick="load_paging('+ (page - 2) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (page - 2) +'</a></li>';
        //         page_html += '<li class="dt-paging-button page-item ' + (paging == (page - 1) ? "active" : "") + '"><a onclick="load_paging('+ (page - 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (page - 1) +'</a></li>';
        //         page_html += '<li class="dt-paging-button page-item ' + (paging == page ? "active" : "") + '"><a onclick="load_paging('+ page +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ page +'</a></li>';
        //     }else{
        //         page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
        //         page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+ (paging - 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (paging - 1) +'</a></li>';
        //         page_html += '<li class="dt-paging-button page-item active"><a onclick="load_paging('+ paging +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ paging +'</a></li>';
        //         if(paging !== page)  page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+ (paging + 1) +')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ (paging + 1) +'</a></li>';
        //     } 
        //     if((paging + 1 ) < page) page_html += '<li class="dt-paging-button page-item disabled"><a class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">...</a></li>';
            
        // }else{ 
        //     for(let i = 1; page + 1 > i;i++){
        //         if(paging == i){ 
        //             page_html += '<li class="dt-paging-button page-item active"><a onclick="load_paging('+i+')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ i +'</a></li>';
        //         }else{ 
        //             page_html += '<li class="dt-paging-button page-item"><a onclick="load_paging('+i+')" class="page-link" aria-controls="table-toko" aria-current="page" data-dt-idx="0">'+ i +'</a></li>';
        //         }
        //     }
        // }

        // page_html += `    
        //     <li class="dt-paging-button page-item"><a onclick="load_paging(${(paging == page ? paging : paging + 1)})" class="page-link next" aria-controls="table-toko" aria-disabled="true" aria-label="Next" data-dt-idx="next" tabindex="-1">›</a></li>
        //     <li class="dt-paging-button page-item"><a onclick="load_paging(${page})" class="page-link last" aria-controls="table-toko" aria-disabled="true" aria-label="Last" data-dt-idx="last" tabindex="-1">»</a></li>
        // `;
        // $("#paging-data").html(page_html);
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
    $("#searchdatasurvey").keyup(function(){
        table.ajax.reload(null, false);
        // loader_datatable();
    })
    
    // FILTER Status  
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
        (filter_status_select.length === 0 ?  $("#statusdatafilter").val("") : $("#statusdatafilter").val(String(filter_status_select.length) + " toko dipilih")); 
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
        (filter_store_select.length === 0 ?  $("#storedatafilter").val("") : $("#storedatafilter").val(String(filter_store_select.length) + " status dipilih")); 
        //loader_datatable(); 
        table.ajax.reload(null, false);
    }) 
    var paging = 1;
    var table; 
    
    function load_paging(i){
        paging = i;
        
        table.ajax.reload(null, false);
       // loader_datatable();
    }
    //loader_datatable();


    table = $('#data-table-survey').DataTable({ 
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
        "autoWidth": false, 
        "ajax": {
            "url": "<?= base_url()?>datatables/get-datatable-survey",
            "type": "POST", 
            "data": function(data){ 
                data["search"] =  $("#searchdatasurvey").val();
                data["filter"] = filter_status_select;
                data["store"] = filter_store_select;
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
            { data: "code", className:"align-top", width: "120px"}, 
            { data: "date", className:"align-top", width: "100px"}, 
            { data: "status" , className:"align-top", width: "100px"},  
            { data: "admin" , className:"align-top", width: "100px"},  
            { data: "customer", className:"align-top", width: "250px",
                render: function(data, type, row) { 
                    var html = ` 
                        <div class="text-head-3 pb-2">${row.customer}</div> 
                        ${(row.customertelp !== "" ? `<div class="text-detail-3 pb-1"><i class="fa-solid fa-phone pe-1"></i>${row.customertelp}</div>` : "")}
                        <div class="text-detail-3 text-truncate" style="width: 20rem;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="${row.customeraddress}"><i class="fa-solid fa-location-dot pe-1"></i>${row.customeraddress}</div>`;

                    return html;
                }
            }, 
            { data: "staff"  , width: "100px",orderable: false, className:"align-top"}, 
            { data: "biaya", width: "auto",className:"align-top"}, 
        ] 
    });  
    table.on('draw.dt', function() { 
        $('[data-bs-toggle="tooltip"]').tooltip();
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
        
        tooltiprenew();
    });

    function format(data) {  
        return data.detail; 
    }
    closeIframe = function(){
        document.querySelector('div[style*="position: fixed"]').remove();
        
        $("html, body").css("overflow","auto");
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
    download_file = function(el){
        var file = $(el).data('file'); 
        window.open('<?= base_url("project/surveyfinish?file=") ?>' + encodeURIComponent(file), '_blank');
    }
    
    var isProcessingSurvey;
    add_click = function(el){
        if (isProcessingSurvey) {
            console.log("project survey cancel load");
            return;
        }   
        isProcessingSurvey = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status">Loading...</span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-survey", 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-add-survey").modal("show"); 
                $("#modal-add-survey").data("menu","Survey");  

                isProcessingSurvey = false;
                $(el).html(old_text); 
                tooltiprenew();
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSurvey = false;
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

    var isProcessingSurveyEdit = [];
    edit_survey = function(id,el,ref){ 
          // INSERT LOADER BUTTON
        if (isProcessingSurveyEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingSurveyEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-survey/" + id, 
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-edit-survey").modal("show");  
                $("#modal-edit-survey").data("menu","Survey");   
                
                tooltiprenew();
                isProcessingSurveyEdit[id] = false;
                $(el).html(old_text); 
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSurveyEdit[id] = false;
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
 
    var isProcessingSurveyDelete = [];
    delete_survey = function(id,el,ref){ 
         // INSERT LOADER BUTTON
        if (isProcessingSurveyDelete[id]) {
            return;
        }  
        isProcessingSurveyDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        tooltiprenew();
        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin membatalkan survey ini.",
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
                    url: "<?= base_url() ?>action/delete-data-survey/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Success!",
                            text: "Data survey berhasil di cancel.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });  
                        table.ajax.reload(null, false);
                    }, 
                });
            }
            isProcessingSurveyDelete[id] = false;
            $(el).html(old_text); 
        });
    };
    
    print_survey = function(id,el,ref){  
        tooltiprenew();
        window.open('<?= base_url("print/survey/") ?>' + id, '_blank');
    };

    var isProcessingSurveyFinish = [];
    add_survey_finish = function(id,el,ref){
        if (isProcessingSurveyFinish[id]) {
            console.log("project survey cancel load");
            return;
        }  

        isProcessingSurveyFinish[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/add-project-survey-finish/" + id, 
            success: function(data) {  
                
                $("#modal-message").html(data);
                $("#modal-finish-survey").modal("show"); 
                $("#modal-finish-survey").data("menu","survey"); 

                isProcessingSurveyFinish[id] = false;
                $(el).html(old_text); 
                tooltiprenew();
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingSurveyFinish[id] = false;
                $(el).html(old_text); 
                tooltiprenew();

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }

    var isProcessingSurveyFinishEdit = [];
    edit_survey_finish = function(id,el,ref){
        if (isProcessingSurveyFinishEdit[id]) {
            console.log("project survey cancel load");
            return;
        }  
        isProcessingSurveyFinishEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/edit-project-survey-finish/" + id, 
            success: function(data) {  
                
                $("#modal-message").html(data);
                $("#modal-finish-survey").modal("show"); 
                $("#modal-finish-survey").data("menu","Survey"); 

                isProcessingSurveyFinishEdit[id] = false;
                $(el).html(old_text); 
                tooltiprenew();
            },
            error: function(xhr, textStatus, errorThrown){ 

                isProcessingSurveyFinishEdit[id] = false;
                $(el).html(old_text); 
                tooltiprenew();

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    
    var IsUpdateStatus = [];
    update_status = function(status,id,el){ 
        if (IsUpdateStatus[id]) {
            console.log("project survey cancel load");
            return;
        }  

        IsUpdateStatus[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>action/update-survey/" + id +  "/" + status, 
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

    var isProcessingPaymentRequest = [];
    request_payment = function(id,el,menu){
        // INSERT LOADER BUTTON
        if (isProcessingPaymentRequest[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPaymentRequest[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/request-payment/" + id,  
            data:{
                type:menu
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-request-payment").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingPaymentRequest[id] = false;
                $(el).html(old_text); 
                tooltiprenew();
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPaymentRequest[id] = false;
                $(el).html(old_text); 
                tooltiprenew();

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
 
    var isProcessingPaymentRequestEdit = [];
    request_payment_edit = function(id,el,menu){
        // INSERT LOADER BUTTON
        if (isProcessingPaymentRequestEdit[id]) {
            console.log("project sph cancel load");
            return;
        }  
        isProcessingPaymentRequestEdit[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        $.ajax({  
            method: "POST",
            url: "<?= base_url() ?>message/request-payment-edit/" + id,  
            data:{
                type:menu
            },
            success: function(data) {  
                $("#modal-message").html(data);
                $("#modal-request-payment-edit").modal("show"); 
                $(".tooltip").remove(); 

                isProcessingPaymentRequestEdit[id] = false;
                $(el).html(old_text); 
                tooltiprenew();
            },
            error: function(xhr, textStatus, errorThrown){ 
                isProcessingPaymentRequestEdit[id] = false;
                $(el).html(old_text); 
                tooltiprenew();

                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
    }
    
    var isProcessingPaymentRequestDelete = [];
    request_payment_delete  = function(id,el,menu){ 
         // INSERT LOADER BUTTON
        if (isProcessingPaymentRequestDelete[id]) {
            return;
        }  
        isProcessingPaymentRequestDelete[id] = true; 
        let old_text = $(el).html();
        $(el).html('<span class="spinner-border spinner-border-sm pe-2" aria-hidden="true"></span><span class="ps-2" role="status"></span>');

        Swal.fire({
            title: "Are you sure?",
            text: "Anda yakin ingin menghapus pembayaran ini.",
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
                    url: "<?= base_url() ?>action/request-data-payment-delete/" + id, 
                    success: function(data) { 
                        Swal.fire({
                            title: "Deleted!",
                            text: "Pembayaran berhasil dihapus.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        });    
                        table.ajax.reload(null, false);
                    }, 
                });
            }
            isProcessingPaymentRequestDelete[id] = false;
            $(el).html(old_text); 
            tooltiprenew();
        });
    };

</script>


<div style="margin-bottom: 100px;"></div>  


<?php $this->endSection(); ?>