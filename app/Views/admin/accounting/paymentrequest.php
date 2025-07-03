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
        <div class="d-flex align-items-center mb-4 "> 
            <div class="p-1 flex-fill" > 
                <h4 class="mb-0">PAYMENT REQUEST DAN APPROVAL</h4> 
            </div>     
            <div class="justify-content-end d-flex gap-1 d-none"> 
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click(this)"><i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-block ps-2">Tambah Sample<span></button>
            </div> 
        </div>
        
        <!-- BAGIAN FILTER -->
        <div class="d-flex align-items-center justify-content-end mb-2 g-2 row search-data">    
            <div class="input-group flex-fill">  
                <input class="form-control form-control-sm input-form" id="searchdatapaymentrequest" placeholder="Cari nama project, catatan, lokasi ataupun nomer dokumen" value="" type="text">
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
        <table id="data-table-payment-request" class="table table-hover table-nested">
            <thead>
                <tr>  
                    <th>Type</th>
                    <th>Toko</th>
                    <th>Referensi</th>
                    <th>Document</th> 
                    <th>Status</th>
                    <th>Admin</th>
                    <th>Keterangan</th>
                    <th>Total Payment</th>
                    <th>Action</th> 
                </tr>
            </thead>  
        </table>
    </div>  
</div>     

<div id='view-container'></div> 
<script src="https://unpkg.com/@panzoom/panzoom@4.6.0/dist/panzoom.min.js"></script>
<script> 
    table = $('#data-table-payment-request').DataTable({ 
        "searching": false,
        "lengthChange": false, 
        "pageLength": parseInt(10),
        "language": {
            "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
            "loadingRecords":  `<div class="loading-spinner"></div>`,
            "processing":  `<div class="loading-spinner"></div>`,
        },  
        scrollX: true,
        "processing": true,
        "serverSide": true, 
        "ajax": {
            "url": "<?= base_url()?>datatables/get-datatable-payment-request",
            "type": "POST", 
            "data": function(data){ 
                data["search"] =  $("#searchdatapaymentrequest").val();  
            }
        }, 
        // "initComplete": function(settings, json) {
        //     $('[data-bs-toggle="tooltip"]').tooltip();
        // },
        "columns": [  
            { data: "tipe" ,orderable: false , className:"action-td",width: "60px"}, 
            { data: "store", className:"align-top" , width: "150px"}, 
            { data: "referensi",orderable: false , className:"align-top", width: "120px"},
            { data: "document",width: "100px", className:"align-top"}, 
            { data: "status" ,width: "100px", className:"align-top"}, 
            { data: "admin" ,width: "100px", className:"align-top"},  
            { data: "desc",width: "250px",  className:"align-top"}, 
            { data: "total" ,orderable: false , width: "90px",className:"align-top"}, 
            { data: "action" ,orderable: false ,width: "90px", className:"align-top"},   
        ] 
    }); 

    
    
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
</script>

<?php $this->endSection(); ?>