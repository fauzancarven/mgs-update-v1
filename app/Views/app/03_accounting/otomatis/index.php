<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<?php
$labels     = $labels ?? [];
$pengaturan = $pengaturan ?? [];
$metode     = $metode ?? [];
$akunList   = $akunList ?? [];
$ringkas    = $ringkas ?? null;
$error      = $error ?? null;
$mulai      = $mulai ?? null;

/** <option> akun, dikelompokkan per kategori, dengan $pilih terpilih. */
$optAkun = static function (array $akunList, string $pilih): string {
    $out = '';
    $grup = '';
    foreach ($akunList as $a) {
        if ($a['kategori'] !== $grup) {
            if ($grup !== '') {
                $out .= '</optgroup>';
            }
            $grup = $a['kategori'];
            $out .= '<optgroup label="' . esc($grup, 'attr') . '">';
        }
        $out .= '<option value="' . esc($a['kode_akun'], 'attr') . '"' . ((string) $a['kode_akun'] === $pilih ? ' selected' : '') . '>'
            . esc($a['kode_akun'] . ' - ' . $a['nama_akun']) . '</option>';
    }
    return $out . ($grup !== '' ? '</optgroup>' : '');
};
?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0"><?= esc($title ?? 'Jurnal Otomatis') ?></h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= base_url() ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols-light:dashboard-outline-rounded" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Jurnal Otomatis</li>
    </ul>
</div>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= esc($error) ?></div>
<?php else: ?>

<div class="alert alert-info">
    <div class="fw-semibold mb-1">Cara kerja</div>
    <ul class="mb-0 ps-3">
        <li><b>Invoice</b> disimpan atau diubah: <b>Debit</b> Piutang Usaha sebesar Grand Total dan Potongan Penjualan (diskon item + diskon invoice); <b>Kredit</b> Pendapatan Penjualan (subtotal) dan Ongkos Kirim.</li>
        <li><b>Pembayaran</b> invoice dicatat: <b>Debit</b> Kas atau Bank sesuai metode bayar, <b>Kredit</b> Piutang Usaha. Proforma tidak dijurnal karena belum ada uang masuk.</li>
        <li><b>Pembelian vendor</b> (PO) disimpan: <b>Debit</b> HPP (barang dibeli per pesanan, tanpa stok), <b>Kredit</b> Utang Usaha sebesar Grand Total PO.</li>
        <li><b>Pembayaran ke vendor</b>: <b>Debit</b> Utang Usaha, <b>Kredit</b> Kas atau Bank. Dijurnal saat uang benar-benar keluar (dicatat dengan metode bayar atau berstatus Approved); permintaan bayar yang masih &quot;Menunggu Pembayaran&quot; belum dijurnal. Bayar bertahap (50% lalu pelunasan) otomatis mengurangi sisa utang.</li>
        <li>Invoice atau PO yang dibatalkan, dan pembayaran yang dihapus: jurnalnya ikut dihapus.</li>
        <li>Dokumen bertanggal sebelum <b>Tanggal Mulai Pembukuan</b> tidak dijurnal. Datanya tetap ada, tidak dihapus.</li>
        <li>Jurnal otomatis ditandai kunci di Jurnal Umum dan tidak bisa diubah manual. Ubah dokumen sumbernya.</li>
        <li>Aplikasi belum mencatat PPN, jadi tidak ada baris pajak. Persediaan (barang stok) belum dijurnal; HPP hanya dari pembelian vendor.</li>
    </ul>
</div>

<form id="form-otomatis" autocomplete="off">
    <div class="card mb-3">
        <div class="card-header"><h6 class="mb-0 fw-semibold">Tanggal Mulai Pembukuan</h6></div>
        <div class="card-body">
            <div class="row g-3 align-items-start">
                <div class="col-md-4">
                    <label class="form-label fw-medium" for="tgl-mulai">Mulai dijurnal sejak</label>
                    <input type="date" class="form-control" id="tgl-mulai" name="tgl_mulai"
                           value="<?= esc((string) $mulai, 'attr') ?>" data-awal="<?= esc((string) $mulai, 'attr') ?>">
                    <div class="form-text">Kosongkan bila semua tanggal ingin dijurnal.</div>
                </div>
                <div class="col-md-8">
                    <p class="mb-2">
                        Invoice dan pembayaran bertanggal <b>sebelum</b> tanggal ini <b>tetap ada</b> di aplikasi
                        (daftar penjualan, cetak, status), tetapi <b>tidak dijurnal</b>.
                        Jurnal otomatis yang sudah telanjur dibuat sebelum tanggal ini akan dihapus saat disimpan;
                        jurnal manual tidak disentuh.
                    </p>
                    <div class="alert alert-warning mb-0">
                        <div class="fw-semibold mb-1">Isi saldo awal lewat Jurnal Umum</div>
                        Buat satu jurnal manual bertanggal <b>sehari sebelum</b> tanggal mulai
                        (contoh: mulai 1 Nov, saldo awal bertanggal 31 Okt). Isi akun yang punya saldo:
                        Kas, Bank, <b>Piutang Usaha</b> (tagihan yang belum lunas pada tanggal itu), Persediaan, Utang,
                        Uang Muka Pelanggan, dan selisihnya ke Modal / Laba Ditahan. Debit dan Kredit harus seimbang.
                        Tanpa saldo awal, pembayaran atas invoice lama membuat Piutang negatif dan Neraca tidak mencerminkan kondisi sebenarnya.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header"><h6 class="mb-0 fw-semibold">Akun untuk Jurnal Penjualan</h6></div>
                <div class="card-body">
                    <?php foreach ($labels as $kunci => $def): ?>
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="akun-<?= esc($kunci, 'attr') ?>"><?= esc($def[1]) ?></label>
                            <select class="form-select" id="akun-<?= esc($kunci, 'attr') ?>" name="akun[<?= esc($kunci, 'attr') ?>]" required>
                                <?= $optAkun($akunList, (string) ($pengaturan[$kunci] ?? $def[0])) ?>
                            </select>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header"><h6 class="mb-0 fw-semibold">Akun Kas/Bank per Metode Pembayaran</h6></div>
                <div class="card-body">
                    <p class="text-secondary-light small">
                        Pilih rekening tiap metode bayar supaya saldo Bank tercatat di akun yang benar.
                        Bila dikosongkan: <b>Tunai/Cash</b> masuk ke Kas, metode lain ke Bank bawaan.
                    </p>
                    <?php if (!$metode): ?>
                        <div class="text-secondary-light">Belum ada pembayaran invoice, jadi belum ada metode yang bisa dipetakan.</div>
                    <?php endif; ?>
                    <?php foreach ($metode as $m): ?>
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                <?= esc($m['metode']) ?>
                                <span class="badge text-bg-secondary ms-1"><?= (int) $m['jumlah'] ?> pembayaran</span>
                            </label>
                            <input type="hidden" name="metode[]" value="<?= esc($m['metode'], 'attr') ?>">
                            <select class="form-select" name="metode_akun[]">
                                <option value="">Ikuti aturan bawaan</option>
                                <?= $optAkun($akunList, (string) $m['akun']) ?>
                            </select>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-24 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan Pengaturan</button>
    </div>
</form>

<div class="card">
    <div class="card-header"><h6 class="mb-0 fw-semibold">Buat Jurnal untuk Data Penjualan yang Sudah Ada</h6></div>
    <div class="card-body">
        <?php if ($ringkas): ?>
            <div class="mb-3" id="ringkas">
                Saat ini <b id="r-inv"><?= (int) $ringkas['invoice_belum'] ?></b> invoice dan
                <b id="r-pay"><?= (int) $ringkas['pembayaran_belum'] ?></b> pembayaran,
                <b id="r-po"><?= (int) ($ringkas['pembelian_belum'] ?? 0) ?></b> pembelian vendor, dan
                <b id="r-bv"><?= (int) ($ringkas['bayar_vendor_belum'] ?? 0) ?></b> pembayaran vendor belum punya jurnal.
                Sudah ada <b id="r-ada"><?= (int) $ringkas['jurnal_otomatis'] ?></b> jurnal otomatis.
                <?php if ($mulai): ?>
                    <span class="text-secondary-light">(Hanya dokumen sejak <?= esc(acc_date_id($mulai)) ?>.)</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="alert alert-warning">
            Invoice dan pembayaran baru otomatis dijurnal. Tombol di bawah untuk data <b>lama</b> yang dibuat sebelum fitur ini.
            Data pada periode yang sudah dilaporkan akan ikut mengubah Neraca, Laba Rugi, dan Buku Besar periode itu.
            Aman dijalankan berulang: jurnal yang sudah sesuai tidak diubah.
        </div>
        <div class="d-flex flex-wrap align-items-end gap-2">
            <div>
                <label class="form-label mb-1" for="sync-from">Dari tanggal</label>
                <input type="date" class="form-control" id="sync-from" value="<?= esc($mulai ?: date('Y-01-01'), 'attr') ?>">
            </div>
            <div>
                <label class="form-label mb-1" for="sync-to">Sampai tanggal</label>
                <input type="date" class="form-control" id="sync-to" value="<?= esc(date('Y-m-d'), 'attr') ?>">
            </div>
            <button type="button" class="btn btn-success" id="btn-sync">Buat / Perbarui Jurnal</button>
        </div>
        <div id="sync-hasil" class="mt-3 d-none"></div>
    </div>
</div>

<script>
$(function () {
    var url = {
        save: "<?= base_url('action/acc-otomatis-save') ?>",
        sync: "<?= base_url('action/acc-otomatis-sync') ?>"
    };

    function simpan($form) {
        var $b = $('#btn-simpan').prop('disabled', true);
        $.ajax({ url: url.save, type: 'POST', data: $form.serialize(), dataType: 'json' })
            .done(function (r) {
                if (r.status) { $('#tgl-mulai').attr('data-awal', $('#tgl-mulai').val()); }
                Swal.fire({ icon: r.status ? 'success' : 'error', title: r.status ? 'Tersimpan' : 'Gagal', text: r.message });
            })
            .fail(function () {
                Swal.fire({ icon: 'error', title: 'Gagal', text: 'Tidak dapat menghubungi server.' });
            })
            .always(function () { $b.prop('disabled', false); });
    }

    $('#form-otomatis').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        var baru = $('#tgl-mulai').val(), awal = $('#tgl-mulai').attr('data-awal') || '';
        if (baru !== '' && baru !== awal) {
            // Mengubah/menetapkan tanggal mulai menghapus jurnal otomatis sebelum tanggal itu: minta konfirmasi.
            Swal.fire({
                icon: 'warning', title: 'Mulai pembukuan ' + baru + '?',
                html: 'Jurnal <b>otomatis</b> bertanggal sebelum ' + baru + ' akan dihapus dari pembukuan.<br>' +
                      'Data invoice dan pembayaran <b>tidak</b> dihapus, dan jurnal manual tidak disentuh.',
                showCancelButton: true, confirmButtonText: 'Ya, simpan', cancelButtonText: 'Batal'
            }).then(function (c) { if (c.isConfirmed) { simpan($form); } });
            return;
        }
        simpan($form);
    });

    function baris(grup, h) {
        return '<tr><td>' + grup + '</td><td class="text-end">' + h.dibuat + '</td><td class="text-end">' + h.diperbarui +
            '</td><td class="text-end">' + h.tetap + '</td><td class="text-end">' + h.dihapus +
            '</td><td class="text-end">' + h.tak_perlu + '</td><td class="text-end">' + h.dilewati + '</td></tr>';
    }

    $('#btn-sync').on('click', function () {
        var from = $('#sync-from').val(), to = $('#sync-to').val();
        if (!from || !to) {
            Swal.fire({ icon: 'warning', title: 'Tanggal belum lengkap', text: 'Isi tanggal awal dan akhir.' });
            return;
        }
        Swal.fire({
            icon: 'question', title: 'Buat jurnal?',
            text: 'Jurnal untuk invoice, pembayaran, pembelian vendor dan pembayaran vendor tanggal ' + from + ' s.d. ' + to + ' akan dibuat atau diperbarui.',
            showCancelButton: true, confirmButtonText: 'Ya, jalankan', cancelButtonText: 'Batal'
        }).then(function (c) {
            if (!c.isConfirmed) { return; }
            var $b = $('#btn-sync').prop('disabled', true).text('Memproses...');
            $.ajax({ url: url.sync, type: 'POST', data: { from: from, to: to }, dataType: 'json' })
                .done(function (r) {
                    if (!r.status) {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: r.message });
                        return;
                    }
                    var h = r.hasil;
                    var $box = $('#sync-hasil').removeClass('d-none').empty();
                    $box.append(
                        '<table class="table table-sm w-auto"><thead><tr><th></th><th class="text-end">Dibuat</th><th class="text-end">Diperbarui</th>' +
                        '<th class="text-end">Sudah sesuai</th><th class="text-end">Dihapus</th><th class="text-end" title="Invoice batal, proforma, atau nominal nol">Tidak perlu jurnal</th>' +
                        '<th class="text-end" title="Data bermasalah, lihat daftar di bawah">Dilewati</th></tr></thead><tbody>' +
                        baris('Invoice', h.invoice) + baris('Pembayaran', h.pembayaran) + baris('Pembelian vendor', h.pembelian) + baris('Bayar vendor', h.bayar_vendor) + '</tbody></table>'
                    );
                    if (h.mulai) {
                        $box.append($('<div class="alert alert-info"></div>').text(
                            'Pembukuan dimulai ' + h.mulai + '. Dokumen sebelum tanggal itu tidak dijurnal' +
                            (h.dibersihkan > 0 ? ' (' + h.dibersihkan + ' jurnal otomatis lama dihapus).' : '.')
                        ));
                    }
                    if (h.catatan && h.catatan.length) {
                        var $w = $('<div class="alert alert-warning mb-0"><div class="fw-semibold mb-1">Dilewati karena data bermasalah:</div></div>');
                        var $ul = $('<ul class="mb-0 ps-3"></ul>');
                        $.each(h.catatan, function (i, t) { $ul.append($('<li></li>').text(t)); });
                        $box.append($w.append($ul));
                    }
                    if (r.ringkas) {
                        $('#r-inv').text(r.ringkas.invoice_belum);
                        $('#r-pay').text(r.ringkas.pembayaran_belum);
                        $('#r-po').text(r.ringkas.pembelian_belum);
                        $('#r-bv').text(r.ringkas.bayar_vendor_belum);
                        $('#r-ada').text(r.ringkas.jurnal_otomatis);
                    }
                })
                .fail(function () {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Tidak dapat menghubungi server atau proses terlalu lama.' });
                })
                .always(function () { $b.prop('disabled', false).text('Buat / Perbarui Jurnal'); });
        });
    });
});
</script>

<?php endif; ?>

<?php $this->endSection(); ?>
