<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          <h6 class="fw-semibold mb-0">List Transaksi</h6>
          <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                              <a href="<?= base_url() ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                                        <iconify-icon icon="material-symbols-light:dashboard-outline-rounded"
                                                  class="icon text-lg">
                                        </iconify-icon>
                                        Dashboard
                              </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium"> <a href="<?= base_url() ?>admin/accounting/transaction"
                                        class="d-flex align-items-center gap-1 hover-text-primary">
                                        <iconify-icon icon="cuida:swap-horizontal-arrows-outline" class="icon text-lg">
                                        </iconify-icon>
                                        List Transaksi
                              </a>
                    </li>
          </ul>
</div>


<div class="card">
          <div class="card-header  d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <!-- BAGIAN FILTER -->
                    <div class="d-none d-sm-flex align-items-center justify-content-end mb-2 gap-2 search-data">
                              <div class="input-group">
                                        <input class="form-control form-control-sm input-form combo"
                                                  id="storedatafilter" placeholder="Pilih Toko" value="" type="text"
                                                  readonly>
                                        <iconify-icon icon="material-symbols-light:storefront-outline"
                                                  class="icon text-lg">
                                        </iconify-icon>
                                        <div class="filter-data left" for="storedatafilter">
                                                  <ul class="list-group">
                                                            <?php
                                                        foreach($store as $row){
                                                            echo '
                                                            <li
                                                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                                                        <div
                                                                                class="form-check style-check d-flex align-items-center">
                                                                                <input class="form-check-input select store"
                                                                                            type="checkbox"
                                                                                            data-group="store"
                                                                                            data-value="'.$row->StoreId.'" value="'.$row->StoreId.'"
                                                                                            id="store-'.$row->StoreId.'">
                                                                                <label class="form-check-label stretched-link"
                                                                                            for="store-'.$row->StoreId.'">
                                                                                            '.$row->StoreCode.'
                                                                                </label>
                                                                        </div>
                                                            </li> ';
                                                        }
                                                        ?>

                                                  </ul>
                                        </div>
                              </div>
                              <div class="input-group d-sm-flex d-none">
                                        <input class="form-control form-control-sm input-form" id="searchdatadate"
                                                  placeholder="Tanggal" value="" type="text" data-start="" data-end=""
                                                  readonly>
                                        <iconify-icon icon="mdi:clipboard-text-date-outline" class="icon text-lg">
                                        </iconify-icon>
                              </div>
                              <div class="input-group">
                                        <input class="form-control form-control-sm input-form combo"
                                                  id="searchdatafilter" placeholder="Status" value="" type="text"
                                                  readonly>

                                        <iconify-icon icon="mdi:timer" class="icon text-lg">
                                        </iconify-icon>
                                        <div class="filter-data left" for="searchdatafilter">
                                                  <ul class="list-group radius-8">
                                                            <li
                                                                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                                                      <div
                                                                                class="form-check style-check d-flex align-items-center">
                                                                                <input class="form-check-input select category"
                                                                                          type="checkbox"
                                                                                          data-group="category"
                                                                                          data-value="0" value="New"
                                                                                          id="status-0">
                                                                                <label class="form-check-label stretched-link"
                                                                                          for="status-0">
                                                                                          New
                                                                                </label>
                                                                      </div>
                                                            </li>
                                                            <li
                                                                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">

                                                                      <div
                                                                                class="form-check style-check d-flex align-items-center">
                                                                                <input class="form-check-input select category"
                                                                                          type="checkbox"
                                                                                          data-group="category"
                                                                                          data-value="1" value="Proses"
                                                                                          id="status-1">
                                                                                <label class="form-check-label stretched-link"
                                                                                          for="status-1">
                                                                                          Proses
                                                                                </label>
                                                                      </div>
                                                            </li>
                                                            <li
                                                                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                                                      <div
                                                                                class="form-check style-check d-flex align-items-center">
                                                                                <input class="form-check-input select category"
                                                                                          type="checkbox"
                                                                                          data-group="category"
                                                                                          data-value="2"
                                                                                          value="Completed"
                                                                                          id="status-2">
                                                                                <label class="form-check-label stretched-link"
                                                                                          for="status-2">
                                                                                          Completed
                                                                                </label>
                                                                      </div>
                                                            </li>
                                                            <li
                                                                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-6 bg-base text-secondary-light border border-bottom-0">
                                                                      <div
                                                                                class="form-check style-check d-flex align-items-center">
                                                                                <input class="form-check-input select category"
                                                                                          type="checkbox"
                                                                                          data-group="category"
                                                                                          data-value="3" value="Cancel"
                                                                                          id="status-3">
                                                                                <label class="form-check-label stretched-link"
                                                                                          for="status-3">
                                                                                          Cancel
                                                                                </label>
                                                                      </div>
                                                            </li>
                                                  </ul>
                                        </div>
                              </div> 
                    </div>
                    <div class="d-flex align-items-center justify-content-end mb-2 gap-2 search-data">
                              <div class="icon-field">
                                        <input type="text" name="#0" class="form-control form-control-sm w-auto"
                                                  placeholder="Search" id="searchdatainvoice">
                                        <span class="icon">
                                                  <iconify-icon icon="ion:search-outline"></iconify-icon>
                                        </span>
                              </div>
                              <a onclick="add_click(this)" class="btn btn-sm btn-primary-600"><i
                                                  class="ri-add-line"></i>
                                        <span class="d-none d-sm-inline-block">Buat Invoice</span></a>

                    </div>
          </div>

          <div class="card-body py-0 py-4 pb-4" id="table">
                    <table id="data-table-invoice" class="table bordered-table " style="width:97%">
                              <thead>
                                        <tr>
                                                  <th scope="col">Kategori</th>
                                                  <th scope="col">Tanggal</th>
                                                  <th scope="col">Keterangan</th>
                                                  <th scope="col">Total</th> 
                                                  <th scope="col"></th>
                                        </tr>
                              </thead>
                              <tbody>
                                </tbody>
                    </table>
          </div>
</div>
 


<div style="margin-bottom: 100px;"></div>

<script>
   table = $('#data-table-invoice').DataTable({
    "searching": false,
    "lengthChange": false,
    "paging": false,
    "language": {
        "emptyTable": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
        "zeroRecords": `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`,
        "loadingRecords": `<div class="loading-spinner"></div>`,
        "processing": `<div class="loading-spinner"></div>`,
    },
    "ordering": false,
    "processing": true,
    "serverSide": true, // Tetap aktif
    "ajax": {
        "url": "<?= base_url()?>datatables/get-datatable-payment-jurnal",
        "type": "POST",
        "data": function(data) {
            data["search"] = $("#searchdatainvoice").val();
        }
    },
    "initComplete": function(settings, json) {
        $("#data-table-invoice").wrap(
            "<div style='overflow:auto; width:100%;position:relative; height:60vh'></div>"
        );
        $('[data-bs-toggle="tooltip"]').tooltip();
    }, 
    "columns": [
        {
            data: "PaymentRefType",
            width: "100px",
            //visible: false // Sembunyikan kolom kategori utama agar rapi
        },
        {
            data: "PaymentDate",
            width: "100px",
        }, 
        {
            data: "InvCustName",
            width: "100px",
        }, 
        {
            data: "PaymentTotal",
            width: "100px",
            render: function(data, type, row) {
                // Opsional: Memastikan tampilan angka di kolom reguler rapi
                if (type === 'display') {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(data);
                }
                return data;
            }
        }, 
        { 
            data: "action",
            orderable: false,
            className: "action-td",
            width: "60px"
        },
    ], 
    rowGroup: {
        dataSrc: "PaymentRefType", // Ambil berdasarkan NAMA PROPERTI JSON, bukan indeks angka
        
        startRender: function (rows, group) {
            // Menghitung total nilai dari data JSON object langsung
            var totalHarga = rows
                .data()
                .pluck("PaymentTotal") // Ambil berdasarkan nama properti JSON
                .reduce(function (a, b) {
                    var numA = parseFloat(a) || 0;
                    var numB = parseFloat(b) || 0;
                    return numA + numB;
                }, 0);

            var formatRupiah = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(totalHarga);

            // Bersihkan nama grup dari spasi/karakter aneh untuk dijadikan class HTML
            var groupClass = group.replace(/[^a-z0-9]/gi, '-').toLowerCase();

            // Ubah colspan menjadi 4 (karena kolom total ada 5 dan 1 disembunyikan)
            return $('<tr/>')
                .addClass('group-start')
                .attr('data-group', groupClass)
                .append('<td colspan="4" style="cursor:pointer; background-color: #f8f9fa; font-weight:bold;">📁 ' + group + ' <span style="float:right; color:#0d6efd;">Total: ' + formatRupiah + '</span></td>');
        }
    },
    
    drawCallback: function (settings) {
        var api = this.api();
        var rows = api.rows({ page: 'current' }).nodes();

        // Berikan class spesifik pada tiap baris data reguler berdasarkan kategorinya
        api.rows({ page: 'current' }).data().each(function (rowData, i) {
            var groupClass = rowData.PaymentRefType.replace(/[^a-z0-9]/gi, '-').toLowerCase();
            $(rows).eq(i).addClass('group-item-' + groupClass);
        });
    },
    "footerCallback": function(row, data, start, end, display) {
        $(row).css({
            "position": "sticky",
            "bottom": "0",
            "background-color": "#fff"
        });
    }
});

// EVENT CLICK UNTUK BUKA TUTUP (COLLAPSE)
// Menggunakan delegasi dokumen agar event tidak hilang saat server-side reload data
$(document).off('click', '#data-table-invoice tbody tr.group-start').on('click', '#data-table-invoice tbody tr.group-start', function () {
    var groupClass = $(this).data('group');
    $('.group-item-' + groupClass).toggle();
});

</script>


<?php $this->endSection(); ?>