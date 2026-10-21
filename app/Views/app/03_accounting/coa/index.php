<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<?php
$kategoriList = function_exists('acc_kategori') ? acc_kategori() : [];
$kelasLegend = [
    '1' => 'Aset',
    '2' => 'Kewajiban',
    '3' => 'Ekuitas',
    '4' => 'Pendapatan',
    '5' => 'HPP',
    '6' => 'Beban Operasional',
    '7' => 'Pendapatan Lain-lain',
    '8' => 'Beban Lain-lain',
];
?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Chart of Account</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= base_url() ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols-light:dashboard-outline-rounded" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= base_url() ?>admin/accounting/coa" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mdi:file-tree-outline" class="icon text-lg"></iconify-icon>
                Chart of Account
            </a>
        </li>
    </ul>
</div>

<div class="card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-2">
            <div class="input-group" style="min-width:260px;">
                <input type="text" class="form-control form-control-sm" id="coa-search"
                    placeholder="Cari kode / nama akun" autocomplete="off">
                <span class="input-group-text">
                    <iconify-icon icon="material-symbols-light:search" class="icon text-lg"></iconify-icon>
                </span>
            </div>
        </div>
        <button type="button" class="btn btn-primary-600 btn-sm d-flex align-items-center gap-1" id="coa-btn-add">
            <iconify-icon icon="material-symbols-light:add" class="icon text-lg"></iconify-icon>
            Tambah Akun
        </button>
    </div>
    <div class="card-body">
        <div class="alert alert-info py-8 px-12 mb-16" role="alert">
            <div class="fw-semibold mb-4">Kelas akun (digit pertama kode akun)</div>
            <div class="d-flex flex-wrap gap-3 text-sm">
                <?php foreach ($kelasLegend as $k => $v): ?>
                    <span><strong><?= esc($k) ?></strong> <?= esc($v) ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <table class="table table-hover w-100" id="data-table-coa">
            <thead>
                <tr>
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th>Kategori</th>
                    <th>Saldo Normal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal tambah / ubah akun -->
<div class="modal fade" id="modal-coa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="form-coa" autocomplete="off">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-coa-title">Tambah Akun</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="coa-mode" value="add">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" for="coa-kode">Kode Akun</label>
                            <input type="text" class="form-control" id="coa-kode" maxlength="10"
                                inputmode="numeric" pattern="[0-9]{3,10}" placeholder="3-10 digit angka">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label" for="coa-nama">Nama Akun</label>
                            <input type="text" class="form-control" id="coa-nama" maxlength="150"
                                placeholder="Nama akun">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="coa-kategori">Kategori</label>
                            <select class="form-select" id="coa-kategori">
                                <option value="">Pilih kategori</option>
                                <?php foreach ($kategoriList as $nama => $info): ?>
                                    <option value="<?= esc($nama) ?>"
                                        data-normal="<?= esc($info['normal'] ?? '') ?>">
                                        <?= esc($nama) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="coa-saldo">Saldo Normal</label>
                            <select class="form-select" id="coa-saldo">
                                <option value="Debit">Debit</option>
                                <option value="Kredit">Kredit</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="coa-parent">Akun Induk</label>
                            <select class="form-select" id="coa-parent" style="width:100%;"></select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="coa-header">
                                <label class="form-check-label" for="coa-header">Akun Header (tidak bisa dipakai di jurnal)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="coa-aktif" checked>
                                <label class="form-check-label" for="coa-aktif">Aktif</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="coa-keterangan">Keterangan</label>
                            <textarea class="form-control" id="coa-keterangan" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-600 btn-sm" id="coa-btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var coaTable;
    var coaModalEl = document.getElementById('modal-coa');

    function coaModal() {
        return bootstrap.Modal.getOrCreateInstance(coaModalEl);
    }

    function coaResetForm() {
        $('#coa-mode').val('add');
        $('#coa-kode').val('').prop('readonly', false);
        $('#coa-nama').val('');
        $('#coa-kategori').val('');
        $('#coa-saldo').val('Debit');
        $('#coa-parent').val(null).empty().trigger('change');
        $('#coa-header').prop('checked', false);
        $('#coa-aktif').prop('checked', true);
        $('#coa-keterangan').val('');
    }

    function coaMsg(res, fallback) {
        return (res && res.message) ? res.message : fallback;
    }

    function coa_edit(el) {
        var kode = $(el).data('kode');
        $.ajax({
            url: "<?= base_url() ?>action/acc-coa-get",
            type: "POST",
            dataType: "json",
            data: { kode_akun: kode },
            success: function(res) {
                if (!res || !res.status) {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: coaMsg(res, 'Data akun tidak ditemukan.') });
                    return;
                }
                var d = res.data || {};
                coaResetForm();
                $('#coa-mode').val('edit');
                $('#modal-coa-title').text('Ubah Akun');
                $('#coa-kode').val(d.kode_akun).prop('readonly', true);
                $('#coa-nama').val(d.nama_akun);
                $('#coa-kategori').val(d.kategori);
                $('#coa-saldo').val(d.saldo_normal);
                $('#coa-header').prop('checked', String(d.is_header) === '1');
                $('#coa-aktif').prop('checked', String(d.aktif) === '1');
                $('#coa-keterangan').val(d.keterangan || '');
                if (res.parent && res.parent.id) {
                    var opt = new Option(res.parent.text, res.parent.id, true, true);
                    $('#coa-parent').append(opt).trigger('change');
                }
                coaModal().show();
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan saat mengambil data akun.' });
            }
        });
    }

    function coa_delete(el) {
        var kode = $(el).data('kode');
        var nama = $(el).data('nama');
        Swal.fire({
            icon: 'warning',
            title: 'Hapus akun?',
            text: 'Akun ' + kode + ' - ' + nama + ' akan dihapus.',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (!result.isConfirmed) return;
            $.ajax({
                url: "<?= base_url() ?>action/acc-coa-delete",
                type: "POST",
                dataType: "json",
                data: { kode_akun: kode },
                success: function(res) {
                    if (res && res.status) {
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: coaMsg(res, 'Akun dihapus.'), timer: 1500, showConfirmButton: false });
                        coaTable.ajax.reload(null, false);
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: coaMsg(res, 'Akun gagal dihapus.') });
                    }
                },
                error: function() {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan saat menghapus akun.' });
                }
            });
        });
    }

    $(function() {
        var emptyHtml = `<div class="d-flex justify-content-center"><img src="<?= base_url() ?>assets/images/empty.png" alt="" style="width:250px;height:250px;"></div>`;

        coaTable = $('#data-table-coa').DataTable({
            searching: false,
            lengthChange: false,
            paging: false,
            ordering: false,
            processing: true,
            serverSide: true,
            language: {
                emptyTable: emptyHtml,
                zeroRecords: emptyHtml,
                loadingRecords: `<div class="loading-spinner"></div>`,
                processing: `<div class="loading-spinner"></div>`
            },
            ajax: {
                url: "<?= base_url() ?>datatables/get-datatable-acc-coa",
                type: "POST",
                data: function(data) {
                    data["search"] = $("#coa-search").val();
                }
            },
            initComplete: function() {
                $("#data-table-coa").wrap("<div style='overflow:auto; width:100%; position:relative; height:60vh'></div>");
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
            columns: [
                { data: "kode_akun", width: "100px" },
                { data: "nama_akun", width: "200px" },
                { data: "kategori", width: "150px" },
                { data: "saldo_normal", width: "100px" },
                { data: "keterangan", width: "200px" },
                { data: "action", orderable: false, className: "action-td", width: "80px" }
            ]
        });

        // Pencarian dengan debounce
        var coaTimer = null;
        $('#coa-search').on('input', function() {
            clearTimeout(coaTimer);
            coaTimer = setTimeout(function() {
                coaTable.ajax.reload();
            }, 400);
        });

        // Select2 akun induk (hanya akun Header)
        $('#coa-parent').select2({
            dropdownParent: $('#modal-coa .modal-content'),
            placeholder: 'Pilih akun induk (opsional)',
            allowClear: true,
            width: '100%',
            ajax: {
                url: "<?= base_url() ?>select2/get-data-acc-coa",
                dataType: 'json',
                type: "POST",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                        header: '1'
                    };
                },
                processResults: function(response) {
                    return { results: response.data };
                },
                cache: true
            }
        });

        // Kategori -> saldo normal otomatis
        $('#coa-kategori').on('change', function() {
            var normal = $(this).find('option:selected').data('normal');
            if (normal === 'Debit' || normal === 'Kredit') {
                $('#coa-saldo').val(normal);
            }
        });

        // Tombol tambah
        $('#coa-btn-add').on('click', function() {
            coaResetForm();
            $('#modal-coa-title').text('Tambah Akun');
            coaModal().show();
        });

        // Simpan
        $('#form-coa').on('submit', function(e) {
            e.preventDefault();
            var kode = $.trim($('#coa-kode').val());
            var nama = $.trim($('#coa-nama').val());
            if (!/^[0-9]{3,10}$/.test(kode)) {
                Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Kode akun harus berupa angka 3-10 digit.' });
                return;
            }
            if (nama === '') {
                Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Nama akun wajib diisi.' });
                return;
            }
            if ($('#coa-kategori').val() === '') {
                Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Kategori wajib dipilih.' });
                return;
            }
            var $btn = $('#coa-btn-save').prop('disabled', true);
            $.ajax({
                url: "<?= base_url() ?>action/acc-coa-save",
                type: "POST",
                dataType: "json",
                data: {
                    mode: $('#coa-mode').val(),
                    kode_akun: kode,
                    nama_akun: nama,
                    kategori: $('#coa-kategori').val(),
                    saldo_normal: $('#coa-saldo').val(),
                    keterangan: $('#coa-keterangan').val(),
                    parent_kode: $('#coa-parent').val() || '',
                    is_header: $('#coa-header').is(':checked') ? '1' : '0',
                    aktif: $('#coa-aktif').is(':checked') ? '1' : '0'
                },
                success: function(res) {
                    if (res && res.status) {
                        coaModal().hide();
                        coaTable.ajax.reload(null, false);
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: coaMsg(res, 'Akun tersimpan.'), timer: 1500, showConfirmButton: false });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: coaMsg(res, 'Akun gagal disimpan.') });
                    }
                },
                error: function() {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan saat menyimpan akun.' });
                },
                complete: function() {
                    $btn.prop('disabled', false);
                }
            });
        });
    });
</script>

<?php $this->endSection(); ?>
