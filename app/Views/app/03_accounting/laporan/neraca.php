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
                                        <label class="form-label">Per Tanggal</label>
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
$akunRows = function (array $akun): string {
          if (empty($akun)) {
                    return '<tr><td colspan="2" class="ps-4 text-secondary-light">Tidak ada akun</td></tr>';
          }
          $h = '';
          foreach ($akun as $a) {
                    $h .= '<tr><td class="ps-4">' . esc($a['kode'] . ' - ' . $a['nama']) . '</td><td class="text-end">' . esc(acc_fmt((int) $a['amt'])) . '</td></tr>';
          }
          return $h;
};
$head = fn (string $t): string => '<tr class="bg-body-tertiary"><th colspan="2">' . esc($t) . '</th></tr>';
$tot = fn (string $l, int $v): string => '<tr class="fw-bold"><td>' . esc($l) . '</td><td class="text-end border-top">' . esc(acc_fmt($v)) . '</td></tr>';
$row = fn (string $l, int $v): string => '<tr><td class="ps-4">' . esc($l) . '</td><td class="text-end">' . esc(acc_fmt($v)) . '</td></tr>';
?>

<div class="card">
          <div class="card-body">
                    <div class="text-center mb-3">
                              <h6 class="fw-semibold mb-1">Neraca</h6>
                              <div class="text-secondary-light">Per Tanggal <?= esc(acc_date_id($to)) ?></div>
                              <?php if (!empty($laporan['seimbang'])): ?>
                                        <span class="badge text-bg-success mt-2">Seimbang</span>
                              <?php endif; ?>
                    </div>
                    <?php if (empty($laporan['seimbang'])): ?>
                              <div class="alert alert-danger">
                                        Neraca tidak seimbang, selisih <?= esc(acc_fmt((int) $laporan['selisih'])) ?>.
                                        Periksa jurnal yang belum seimbang atau akun tanpa kategori.
                              </div>
                    <?php endif; ?>
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
                    <div class="row g-4">
                              <div class="col-lg-6">
                                        <div class="table-responsive">
                                                  <table class="table table-sm align-middle mb-0" style="font-variant-numeric: tabular-nums">
                                                            <tbody>
                                                                      <?= $head('ASET') ?>
                                                                      <?= $akunRows($grup['Aset']['akun'] ?? []) ?>
                                                                      <?= $tot('Total Aset', (int) $laporan['totalAset']) ?>
                                                            </tbody>
                                                  </table>
                                        </div>
                              </div>
                              <div class="col-lg-6">
                                        <div class="table-responsive">
                                                  <table class="table table-sm align-middle mb-0" style="font-variant-numeric: tabular-nums">
                                                            <tbody>
                                                                      <?= $head('KEWAJIBAN') ?>
                                                                      <?= $akunRows($grup['Kewajiban']['akun'] ?? []) ?>
                                                                      <?= $tot('Total Kewajiban', (int) $laporan['totalKewajiban']) ?>
                                                                      <?= $head('EKUITAS') ?>
                                                                      <?= $akunRows($grup['Ekuitas']['akun'] ?? []) ?>
                                                                      <?= $row('Laba Ditahan (s.d. tahun lalu)', (int) $laporan['labaLalu']) ?>
                                                                      <?= $row('Laba Tahun Berjalan', (int) $laporan['labaIni']) ?>
                                                                      <?= $tot('Total Ekuitas', (int) $laporan['totalEkuitas']) ?>
                                                                      <tr class="bg-body-tertiary fw-bold">
                                                                                <td>Total Kewajiban + Ekuitas</td>
                                                                                <td class="text-end"><?= esc(acc_fmt((int) $laporan['totalPasiva'])) ?></td>
                                                                      </tr>
                                                            </tbody>
                                                  </table>
                                        </div>
                              </div>
                    </div>
          </div>
</div>

<?php $this->endSection(); ?>
