<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>

<div class="card radius-15 overflow-hidden mb-3 border-0 shadow-sm">
    <div class="card-header border-bottom-0 px-4 pt-4 pb-0 bg-white mb-lg-0 mb-2">  
        <div class="d-flex align-items-center mb-4 "> 
            <div class="p-1 flex-fill" > 
                <h4 class="mb-0">LIST SAMPLE</h4> 
            </div>     
        </div>
        
        <!-- BAGIAN FILTER -->
        <div class="d-flex align-items-center justify-content-end mb-2 g-2 row search-data">   
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
                                <input class="form-check-input select category" type="checkbox" data-group="category" data-value="2" value="Finish" id="status-2">
                                <label class="form-check-label ps-0 ms-0 stretched-link" for="status-2">Finish</label>
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
                <input class="form-control form-control-sm input-form" id="searchdatasample" placeholder="Cari nama project, catatan, lokasi ataupun nomer dokumen" value="" type="text">
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
        <table id="data-table-sample" class="table table-hover table-nested">
            <thead>
                <tr> 
                    <th></th>
                    <th class="text-center">Kode</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Admin</th>
                    <th>Customer</th>
                    <th>Pembayaran</th>
                    <th>Pengiriman</th>
                    <th>Action</th>
                </tr>
            </thead> 
            <tbody> 
            </tbody>
        </table>
    </div> 
<!--     
    <div id="data-project"> 
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

<script>
    var xhr_load_project; 
    var filter_status_select = []
    function loader_datatable(){
        if (xhr_load_project) {
            xhr_load_project.abort();
        }

        xhr_load_project = $.ajax({ 
            dataType: "json",
            method: "POST",
            url: "<?= base_url()?>datatables/get-data-project/sample", 
            data:{  
                "search" : $("#searchdatasample").val(), 
                "datestart" : $("#searchdatadate").data("start"),
                "dateend" : $("#searchdatadate").data("end"),
                "paging" : paging
            },
            success: function(data) {       
                if(data["status"]===true){ 
                    $("#data-project").html(data["html"])   
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data, 
                        confirmButtonColor: "#3085d6", 
                    });
                }  
                load_paging_html(data);
            },
            error : function(xhr, textStatus, errorThrown){   
                if (textStatus === 'abort') {
                    // request AJAX dibatalkan, tidak perlu menampilkan error
                    return;
                }
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            }
        });
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
    $("#searchdatasample").keyup(function(){
        //loader_datatable(); 
        table.ajax.reload(null, false);
    })

    // FILTER Status
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

    var paging = 1;
    var table; 
    
    function load_paging(i){
        paging = i;
        loader_datatable();
    }
    loader_datatable();
    table = $('#data-table-sample').DataTable({ 
        "searching": false,
        "lengthChange": false, 
        "pageLength": parseInt(10),
        "language": {
            "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "loadingRecords":  `<div class="loading-spinner"></div>`,
            "processing":  `<div class="loading-spinner"></div>`,
        }, 
        "order": [[2, "desc"]],
        "processing": true,
        "serverSide": true, 
        "ajax": {
            "url": "<?= base_url()?>datatables/get-datatable-sample",
            "type": "POST", 
            "data": function(data){ 
                data["search"] =  $("#searchdatasample").val();
                data["filter"] = filter_status_select;
                data["datestart"] = $("#searchdatadate").data("start");
                data["dateend"] = $("#searchdatadate").data("end");
            }
        }, 
        "columns": [ 
            { data: null ,orderable: false,width: "20px",className:"p-0 ps-2",
                render: function(data, type, row) {
                    return '<a class="pointer text-head-3 btn-detail-item"><i class="fa-solid fa-chevron-right"></i></a>';
                }
            }, 
            { data: "code",orderable: false , className:"text-center", width: "150px"},
            { data: "date", className:"text-center"}, 
            { data: "status" , className:"text-center"}, 
            { data: "admin" , className:"text-center"}, 
            { data: "customer"}, 
            { data: "payment", orderable: false , className:"text-center",width: "150px"}, 
            { data: "delivery", orderable: false , className:"text-center",width: "150px"},   
            { data: "action" ,orderable: false , className:"action-td",width: "100px"}, 
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
            row.child.hide(); 
            $(this).find('i').removeClass('fa-rotate-270');  
        } else {  
            $(this).find('i').addClass('fa-rotate-270');  
            var childRow = row.child(format(data)).show(); 
            $(tr).next().addClass('child-row');
            $(tr).next().find('td:not(.detail)').addClass('p-0 ps-2'); 
            $(tr).find('td').addClass('no-border');
        } 
    });

    function format(data) {
        var detailitem = data.detail;
        
        // var tr = $(this).closest('tr');

        // var tablecustom = $("<table class='table'>");
        // var theadcustom = $("<thead>");
        // var tbodycustom = $("<tbody>");

        // // Buat header tabel
        // var headercustom = $("<tr>"); 
        // headercustom.append($("<th class='detail'>").text("Gambar"));
        // $.each(detailitem[0]["ProdukDetailVarian"], function(key, value) {   
        //     headercustom.append($("<th class='detail'>").text(key)); 
        // });    
        // headercustom.append($("<th class='detail'>").text("Berat"));
        // headercustom.append($("<th class='detail'>").text("Satuan"));
        // headercustom.append($("<th class='detail'>").text("isi /M2"));
        // headercustom.append($("<th class='detail'>").text("Harga Beli"));
        // headercustom.append($("<th class='detail'>").text("Harga Jual")); 
        // headercustom.append($("<th class='detail'>").text("Action").attr("width","100px")); 
        // theadcustom.append(headercustom);
        // // Buat baris tabel 
        // for(var i = 0; i < detailitem.length;i++){ 
        //     var trcustom = $("<tr>"); 
            
        //     trcustom.append($("<td class='detail'>").html("<img src='" + detailitem[i]["ProdukDetailImage"]  + "' alt='Gambar' class='image-produk'>"));
        //     $.each(detailitem[i]["ProdukDetailVarian"], function(key, value) {  
        //         trcustom.append($("<td class='detail'>").text(value));
        //     });     
        //     trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailBerat"]));
        //     trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailSatuanText"]));
        //     trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailPcsM2"]));
        //     trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailHargaBeli"]));
        //     trcustom.append($("<td class='detail'>").text(detailitem[i]["ProdukDetailHargaJual"]));
        //     trcustom.append($("<td class='detail'>").html(`
        //     <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="edit_click_detail(${detailitem[i]["ProdukDetailRef"]},${detailitem[i]["ProdukDetailId"]},this)"><i class="fa-solid fa-pen-to-square"></i></span>`));
        //     tbodycustom.append(trcustom);
        // }

        // // Gabungkan tabel
        // tablecustom.append(theadcustom);
        // tablecustom.append(tbodycustom);

        return detailitem; 
    }
 
</script>


<div style="margin-bottom: 100px;"></div>  


<?php $this->endSection(); ?>