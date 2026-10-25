<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?>

<style>
          @media print {
                    .no-print, .breadcrumb-bar { display: none !important; }
                    .card { border: 0 !important; box-shadow: none !important; }
          }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24 no-print breadcrumb-bar">
          <h6 class="fw-semibold mb-0"><?= esc($title) ?></h6>
          <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                              <a href="<?= base_url() ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                                        <iconify-icon icon="material-symbols-light:dashboard-outline-rounded" class="icon text-lg"></iconify-icon>
                                        Dashboard
                              </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium"><?= esc($title) ?></li>
          </ul>
</div>

<div class="card mb-24 no-print">
          <div class="card-body">
                    <form method="get" class="row g-3 align-items-end">
                    <div class="col-md-2">
                              <label class="form-label">Dari Tanggal</label>
                              <input type="date" name="from" class="form-control form-control-sm" value="<?= esc($from) ?>">
                    </div>
                    <div class="col-md-2">
                              <label class="form-label">Sampai Tanggal</label>
                              <input type="date" name="to" class="form-control form-control-sm" value="<?= esc($to) ?>">
                    </div>
                    <div class="col-md-3">
                              <label class="form-label">Toko</label>
                              <select name="store" class="form-select form-select-sm">
                                        <option value="">Semua Toko</option>
                                        <?php foreach ($store as $s): ?>
                                                  <option value="<?= esc($s->StoreId) ?>" <?= ((int) $storeId === (int) $s->StoreId) ? 'selected' : '' ?>>
                                                            <?= esc($s->StoreCode . ' - ' . $s->StoreName) ?>
                                                  </option>
                                        <?php endforeach; ?>
                              </select>
                    </div>
                    <div class="col-auto d-flex gap-2">
                              <button type="submit" class="btn btn-sm btn-primary-600">Tampilkan</button>
                              <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">Cetak</button>
                    </div>
                    </form>
          </div>
</div>

<?php
$grup = $laporan['grup'] ?? [];
$blok = function (string $nama) use ($grup) {
          $g = $grup[$nama] ?? ['akun' => [], 'total' => 0];
          ob_start(); ?>
          <tr class="bg-body-tertiary"><th colspan="2"><?= esc($nama) ?></th></tr>
          <?php if (empty($g['akun'])): ?>
                    <tr><td colspan="2" class="ps-4 text-secondary-light">Tidak ada transaksi</td></tr>
          <?php else: foreach ($g['akun'] as $a): ?>
                    <tr>
                              <td class="ps-4"><?= esc($a['kode'] . ' - ' . $a['nama']) ?></td>
                              <td class="text-end"><?= esc(acc_fmt((int) $a['amt'])) ?></td>
                    </tr>
          <?php endforeach; endif; ?>
          <tr class="fw-semibold">
                    <td>Total <?= esc($nama) ?></td>
                    <td class="text-end border-top"><?= esc(acc_fmt((int) $g['total'])) ?></td>
          </tr>
          <?php
          return ob_get_clean();
};
$sub = function (string $label, int $v, bool $warna = false): string {
          $cls = '';
          if ($warna) {
                    $cls = $v >= 0 ? 'text-success-main' : 'text-danger-main';
          }
          return '<tr class="bg-body-tertiary fw-bold"><td>' . esc($label) . '</td><td class="text-end ' . $cls . '">' . esc(acc_fmt($v)) . '</td></tr>';
};
?>

<div class="card">
          <div class="card-body">
                    <div class="text-center mb-3">
                              <h6 class="fw-semibold mb-1">Laporan Laba Rugi</h6>
                              <div class="text-secondary-light"><?= esc(acc_date_id($from)) ?> s.d. <?= esc(acc_date_id($to)) ?></div>
                    </div>
                    <?php if (!empty($laporan['unclassified'])): ?>
                              <div class="alert alert-warning">
                                        Akun berikut memiliki kategori yang tidak dikenal:
                                        <ul class="mb-0">
                                                  <?php foreach ($laporan['unclassified'] as $u): ?>
                                                            <li><?= esc($u) ?></li>
                                                  <?php endforeach; ?>
                                        </ul>
                              </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                              <table class="table table-sm align-middle mb-0" style="font-variant-numeric: tabular-nums">
                                        <tbody>
                                                  <?= $blok('Pendapatan') ?>
                                                  <?= $blok('Harga Pokok Penjualan') ?>
                                                  <?= $sub('Laba Kotor', (int) $laporan['labaKotor']) ?>
                                                  <?= $blok('Beban Operasional') ?>
                                                  <?= $sub('Laba Operasi', (int) $laporan['labaOperasi']) ?>
                                                  <?= $blok('Pendapatan Lain-lain') ?>
                                                  <?= $blok('Beban Lain-lain') ?>
                                                  <?= $sub('Laba (Rugi) Bersih', (int) $laporan['labaBersih'], true) ?>
                                        </tbody>
                              </table>
                    </div>
          </div>
</div>

<?php $this->endSection(); ?>
