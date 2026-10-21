<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0"><?= esc($title ?? 'Jurnal Umum') ?></h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= base_url() ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols-light:dashboard-outline-rounded" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= base_url('admin/accounting/jurnal') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:book-outline" class="icon text-lg"></iconify-icon>
                Jurnal Umum
            </a>
        </li>
    </ul>
</div>

<div class="card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <input type="text" id="jr-search" class="form-control form-control-sm" style="width:220px" placeholder="Cari no / keterangan jurnal" autocomplete="off">
            <div class="input-group input-group-sm" style="width:260px">
                <input type="text" id="jr-daterange" class="form-control" placeholder="Semua tanggal" autocomplete="off" readonly>
                <button type="button" class="btn btn-outline-secondary" id="jr-date-clear" title="Hapus filter tanggal">&times;</button>
            </div>
            <select id="jr-store" class="form-select form-select-sm" style="width:200px">
                <option value="">Semua Toko</option>
                <?php foreach (($store ?? []) as $s): ?>
                    <option value="<?= esc($s->StoreId) ?>"><?= esc($s->StoreCode) ?> - <?= esc($s->StoreName) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <a href="<?= base_url('admin/accounting/jurnal/add') ?>" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
            <iconify-icon icon="material-symbols:add" class="icon text-lg"></iconify-icon>
            Tambah Jurnal
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover w-100" id="tbl-jurnal">
            <thead>
                <tr>
                    <th>No Jurnal</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Toko</th>
                    <th class="text-end">Total</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
    var jrDateStart = moment().startOf('month');
    var jrDateEnd = moment();
    var jrUseDate = true;
    var jrTable;
    var jrTimer;

    function jurnal_delete(id, no) {
        Swal.fire({
            title: 'Hapus jurnal?',
            text: 'Jurnal ' + no + ' akan dihapus.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (!result.isConfirmed) return;
            $.ajax({
                url: "<?= base_url('action/acc-jurnal-delete/') ?>" + id,
                type: 'POST',
                dataType: 'json'
            }).done(function(res) {
                if (res && res.status) {
                    Swal.fire({ icon: 'success', title: 'Berhasil', text: res.message || 'Jurnal dihapus', timer: 1500, showConfirmButton: false });
                    jrTable.ajax.reload(null, false);
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: (res && res.message) || 'Gagal menghapus jurnal' });
                }
            }).fail(function() {
                Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan jaringan' });
            });
        });
    }

    $(document).ready(function() {
        $('#jr-daterange').daterangepicker({
            startDate: jrDateStart,
            endDate: jrDateEnd,
            autoUpdateInput: false,
            locale: { format: 'DD/MM/YYYY', applyLabel: 'Terapkan', cancelLabel: 'Batal' }
        }, function(start, end) {
            jrDateStart = start;
            jrDateEnd = end;
            jrUseDate = true;
            setDateText();
            jrTable.ajax.reload();
        });

        function setDateText() {
            $('#jr-daterange').val(jrUseDate ? jrDateStart.format('DD/MM/YYYY') + ' - ' + jrDateEnd.format('DD/MM/YYYY') : '');
        }
        setDateText();

        $('#jr-date-clear').on('click', function() {
            jrUseDate = false;
            setDateText();
            jrTable.ajax.reload();
        });

        var emptyHtml = '<div class="text-center py-4"><img src="<?= base_url('assets/images/empty.png') ?>" style="max-width:160px" alt="Kosong"><div class="text-muted mt-2">Belum ada data jurnal</div></div>';

        jrTable = $('#tbl-jurnal').DataTable({
            searching: false,
            lengthChange: false,
            ordering: false,
            processing: true,
            serverSide: true,
            paging: true,
            pageLength: 25,
            language: { emptyTable: emptyHtml, zeroRecords: emptyHtml },
            ajax: {
                url: "<?= base_url('datatables/get-datatable-acc-jurnal') ?>",
                type: 'POST',
                data: function(d) {
                    d.search = $('#jr-search').val();
                    d.datestart = jrUseDate ? jrDateStart.format('YYYY-MM-DD') : '';
                    d.dateend = jrUseDate ? jrDateEnd.format('YYYY-MM-DD') : '';
                    d.store = $('#jr-store').val();
                }
            },
            columns: [
                { data: 'JurnalNo' },
                { data: 'JurnalDate' },
                { data: 'JurnalDesc' },
                { data: 'Store' },
                { data: 'Total', className: 'text-end' },
                { data: 'action', className: 'text-center' }
            ],
            drawCallback: function() {
                document.querySelectorAll('#tbl-jurnal [data-bs-toggle="tooltip"]').forEach(function(el) {
                    new bootstrap.Tooltip(el);
                });
            }
        });

        $('#tbl-jurnal tbody').on('click', '.btn-detail-jurnal', function(e) {
            e.preventDefault();
            var tr = $(this).closest('tr');
            var row = jrTable.row(tr);
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(row.data().detail).show();
                tr.addClass('shown');
            }
        });

        $('#jr-search').on('input', function() {
            clearTimeout(jrTimer);
            jrTimer = setTimeout(function() { jrTable.ajax.reload(); }, 400);
        });
        $('#jr-store').on('change', function() { jrTable.ajax.reload(); });
    });
</script>

<?php $this->endSection(); ?>
