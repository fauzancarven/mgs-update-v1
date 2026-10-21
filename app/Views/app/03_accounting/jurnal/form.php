<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>
<?php
$isEdit = !empty($jurnal) && !empty($jurnal['header']);
$hdr    = $isEdit ? $jurnal['header'] : [];
$lines  = $isEdit ? ($jurnal['lines'] ?? []) : [];
?>

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
        <li>-</li>
        <li class="fw-medium"><?= $isEdit ? 'Ubah' : 'Tambah' ?></li>
    </ul>
</div>

<form id="form-jurnal" autocomplete="off" onsubmit="return false;">
    <input type="hidden" id="JurnalId" value="<?= $isEdit ? (int) ($hdr['JurnalId'] ?? 0) : 0 ?>">

    <div class="card mb-3">
        <div class="card-header"><h6 class="mb-0">Informasi Jurnal</h6></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">No Jurnal</label>
                    <?php if ($isEdit): ?>
                        <input type="text" class="form-control" value="<?= esc($hdr['JurnalNo'] ?? '') ?>" readonly>
                    <?php else: ?>
                        <div class="form-control-plaintext text-muted">Dibuat otomatis</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="JurnalDate">Tanggal</label>
                    <input type="date" class="form-control" id="JurnalDate" value="<?= esc($isEdit ? substr((string) ($hdr['JurnalDate'] ?? ''), 0, 10) : date('Y-m-d')) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="StoreId">Toko</label>
                    <select class="form-select" id="StoreId">
                        <option value="">Tanpa toko</option>
                        <?php foreach (($store ?? []) as $s): ?>
                            <option value="<?= esc($s->StoreId) ?>" <?= ($isEdit && (string) ($hdr['StoreId'] ?? '') === (string) $s->StoreId) ? 'selected' : '' ?>>
                                <?= esc($s->StoreCode) ?> - <?= esc($s->StoreName) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label" for="JurnalDesc">Keterangan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="JurnalDesc" maxlength="255" value="<?= esc($hdr['JurnalDesc'] ?? '') ?>" placeholder="Keterangan jurnal">
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="mb-0">Baris Jurnal</h6>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-add-line">
                <iconify-icon icon="material-symbols:add" class="icon"></iconify-icon> Tambah Baris
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle" id="tbl-lines">
                    <thead>
                        <tr>
                            <th style="min-width:280px">Akun</th>
                            <th style="min-width:200px">Keterangan</th>
                            <th style="width:170px" class="text-end">Debit</th>
                            <th style="width:170px" class="text-end">Kredit</th>
                            <th style="width:50px"></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Total</th>
                            <th class="text-end" id="tot-debit">0</th>
                            <th class="text-end" id="tot-kredit">0</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-end">Selisih</th>
                            <th colspan="2" class="text-end" id="tot-selisih">0</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-end">Status</th>
                            <th colspan="2" class="text-end"><span id="bal-status" class="badge bg-danger">Tidak seimbang</span></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mb-4">
        <a href="<?= base_url('admin/accounting/jurnal') ?>" class="btn btn-outline-secondary">Batal</a>
        <button type="button" class="btn btn-primary" id="btn-save">Simpan</button>
    </div>
</form>

<script>
    var jurnalInitLines = <?= json_encode(array_map(function ($l) {
        return [
            'kode'  => (string) ($l['kode_akun'] ?? ''),
            'nama'  => (string) ($l['nama_akun'] ?? ''),
            'debit' => (string) ($l['Debit'] ?? ''),
            'kredit' => (string) ($l['Kredit'] ?? ''),
            'desc'  => (string) ($l['DetailDesc'] ?? ''),
        ];
    }, $lines), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    var jurnalSaving = false;

    // "1250000.50" -> 125000050 (integer sen); string kosong/invalid -> 0
    function toSen(s) {
        s = String(s || '').trim();
        if (!/^\d*(\.\d*)?$/.test(s) || s === '' || s === '.') return 0;
        var p = s.split('.');
        var whole = p[0] === '' ? '0' : p[0];
        var frac = ((p[1] || '') + '00').substring(0, 2);
        return parseInt(whole, 10) * 100 + parseInt(frac, 10);
    }

    function fmtSen(sen) {
        var neg = sen < 0;
        sen = Math.abs(sen);
        var whole = Math.floor(sen / 100);
        var cents = sen % 100;
        var str = String(whole).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        if (cents) str += ',' + (cents < 10 ? '0' : '') + cents;
        return (neg ? '-' : '') + str;
    }

    // tampilkan nominal tanpa nol di belakang; nol -> kosong
    function cleanAmount(v) {
        var s = String(v || '').trim();
        if (s === '' || toSen(s) === 0) return '';
        if (s.indexOf('.') >= 0) s = s.replace(/0+$/, '').replace(/\.$/, '');
        return s;
    }

    function sanitizeAmount(v) {
        v = String(v).replace(/[^0-9.]/g, '');
        var i = v.indexOf('.');
        if (i >= 0) {
            v = v.substring(0, i + 1) + v.substring(i + 1).replace(/\./g, '').substring(0, 2);
        }
        return v;
    }

    function initAccountSelect($sel) {
        $sel.select2({
            width: '100%',
            placeholder: 'Pilih akun',
            allowClear: true,
            ajax: {
                url: "<?= base_url('select2/get-data-acc-coa') ?>",
                dataType: 'json',
                type: 'POST',
                delay: 250,
                data: function(params) { return { searchTerm: params.term }; },
                processResults: function(response) { return { results: response.data }; },
                cache: true
            }
        });
    }

    function addLine(line) {
        line = line || {};
        var $tr = $(
            '<tr class="jl-row">' +
            '<td><select class="jl-akun form-select"></select></td>' +
            '<td><input type="text" class="form-control jl-desc" maxlength="255"></td>' +
            '<td><input type="text" inputmode="decimal" class="form-control text-end jl-debit" placeholder="0"></td>' +
            '<td><input type="text" inputmode="decimal" class="form-control text-end jl-kredit" placeholder="0"></td>' +
            '<td><button type="button" class="btn btn-sm btn-outline-danger jl-del" title="Hapus baris">&times;</button></td>' +
            '</tr>'
        );
        var $sel = $tr.find('.jl-akun');
        if (line.kode) {
            $sel.append(new Option(line.kode + ' - ' + (line.nama || ''), line.kode, true, true));
        }
        $tr.find('.jl-desc').val(line.desc || '');
        $tr.find('.jl-debit').val(cleanAmount(line.debit));
        $tr.find('.jl-kredit').val(cleanAmount(line.kredit));
        $('#tbl-lines tbody').append($tr);
        initAccountSelect($sel);
        return $tr;
    }

    function rowInfo($tr) {
        return {
            kode: $tr.find('.jl-akun').val() || '',
            desc: $.trim($tr.find('.jl-desc').val()),
            debit: $tr.find('.jl-debit').val(),
            kredit: $tr.find('.jl-kredit').val()
        };
    }

    function isEmptyRow(r) {
        return r.kode === '' && r.desc === '' && toSen(r.debit) === 0 && toSen(r.kredit) === 0;
    }

    // mengembalikan {balanced, count}
    function recalc() {
        var d = 0, k = 0, count = 0;
        $('#tbl-lines tbody tr').each(function() {
            var r = rowInfo($(this));
            d += toSen(r.debit);
            k += toSen(r.kredit);
            if (!isEmptyRow(r)) count++;
        });
        var diff = d - k;
        var balanced = (d === k && d > 0);
        $('#tot-debit').text(fmtSen(d));
        $('#tot-kredit').text(fmtSen(k));
        $('#tot-selisih').text(fmtSen(Math.abs(diff)));
        var $b = $('#bal-status');
        if (balanced) {
            $b.removeClass('bg-danger').addClass('bg-success').text('Seimbang');
        } else {
            $b.removeClass('bg-success').addClass('bg-danger').text('Tidak seimbang' + (diff !== 0 ? ' (selisih ' + fmtSen(Math.abs(diff)) + ')' : ''));
        }
        var ok = balanced && count >= 2 && !jurnalSaving;
        $('#btn-save').prop('disabled', !ok);
        return { balanced: balanced, count: count };
    }

    $(document).ready(function() {
        if (jurnalInitLines.length) {
            jurnalInitLines.forEach(function(l) { addLine(l); });
        } else {
            addLine();
            addLine();
        }
        recalc();

        $('#btn-add-line').on('click', function() { addLine(); recalc(); });

        $('#tbl-lines tbody').on('click', '.jl-del', function() {
            $(this).closest('tr').find('.jl-akun').select2('destroy');
            $(this).closest('tr').remove();
            recalc();
        });

        $('#tbl-lines tbody').on('input', '.jl-debit, .jl-kredit', function() {
            var $i = $(this);
            var v = sanitizeAmount($i.val());
            if ($i.val() !== v) $i.val(v);
            if (toSen(v) > 0) {
                var other = $i.hasClass('jl-debit') ? '.jl-kredit' : '.jl-debit';
                $i.closest('tr').find(other).val('');
            }
            recalc();
        });

        $('#tbl-lines tbody').on('change', '.jl-akun', recalc);
        $('#tbl-lines tbody').on('input', '.jl-desc', recalc);

        $('#btn-save').on('click', function() {
            if (jurnalSaving) return;
            var date = $('#JurnalDate').val();
            var desc = $.trim($('#JurnalDesc').val());
            if (!date) { Swal.fire({ icon: 'warning', title: 'Tanggal wajib diisi' }); return; }
            if (!desc) { Swal.fire({ icon: 'warning', title: 'Keterangan wajib diisi' }); return; }

            var rows = [], bad = false;
            $('#tbl-lines tbody tr').each(function() {
                var r = rowInfo($(this));
                if (isEmptyRow(r)) return;
                if (r.kode === '' || (toSen(r.debit) === 0 && toSen(r.kredit) === 0)) { bad = true; return; }
                rows.push(r);
            });
            if (bad) { Swal.fire({ icon: 'warning', title: 'Setiap baris harus memiliki akun dan nominal debit atau kredit' }); return; }
            var st = recalc();
            if (rows.length < 2) { Swal.fire({ icon: 'warning', title: 'Jurnal minimal terdiri dari 2 baris' }); return; }
            if (!st.balanced) { Swal.fire({ icon: 'warning', title: 'Total debit dan kredit harus seimbang' }); return; }

            var payload = {
                JurnalId: $('#JurnalId').val(),
                JurnalDate: date,
                JurnalDesc: desc,
                StoreId: $('#StoreId').val() || '',
                lines: rows.map(function(r) {
                    return {
                        kode_akun: r.kode,
                        debit: toSen(r.debit) > 0 ? r.debit : '0',
                        kredit: toSen(r.kredit) > 0 ? r.kredit : '0',
                        desc: r.desc
                    };
                })
            };

            jurnalSaving = true;
            $('#btn-save').prop('disabled', true);
            $.ajax({
                url: "<?= base_url('action/acc-jurnal-save') ?>",
                type: 'POST',
                dataType: 'json',
                data: payload
            }).done(function(res) {
                if (res && res.status) {
                    Swal.fire({ icon: 'success', title: 'Berhasil', text: res.message || 'Jurnal tersimpan', timer: 1500, showConfirmButton: false })
                        .then(function() { window.location.href = "<?= base_url('admin/accounting/jurnal') ?>"; });
                    setTimeout(function() { window.location.href = "<?= base_url('admin/accounting/jurnal') ?>"; }, 1800);
                } else {
                    jurnalSaving = false;
                    recalc();
                    Swal.fire({ icon: 'error', title: 'Gagal', text: (res && res.message) || 'Gagal menyimpan jurnal' });
                }
            }).fail(function() {
                jurnalSaving = false;
                recalc();
                Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan jaringan' });
            });
        });
    });
</script>

<?php $this->endSection(); ?>
