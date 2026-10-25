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
                              <div class="col-auto">
                                        <div class="form-check mb-1">
                                                  <input class="form-check-input" type="checkbox" name="all" value="1" id="chkAll" <?= !empty($semua) ? 'checked' : '' ?>>
                                                  <label class="form-check-label" for="chkAll">Tampilkan akun tanpa mutasi</label>
                                        </div>
                              </div>
                    <div class="col-auto d-flex gap-2">
                              <button type="submit" class="btn btn-sm btn-primary-600">Tampilkan</button>
                              <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">Cetak</button>
                    </div>
                    </form>
          </div>
</div>

<div class="card">
          <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                              <div class="text-secondary-light">Periode: <?= esc(acc_date_id($from)) ?> s.d. <?= esc(acc_date_id($to)) ?></div>
                              <?php if (!empty($laporan['seimbang'])): ?>
                                        <span class="badge text-bg-success">Seimbang</span>
                              <?php endif; ?>
                    </div>
                    <?php if (empty($laporan['seimbang'])): ?>
                              <div class="alert alert-danger">Neraca saldo TIDAK seimbang</div>
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
                    <div class="table-responsive">
                              <table class="table table-sm table-bordered align-middle mb-0">
                                        <thead class="bg-body-tertiary">
                                                  <tr>
                                                            <th rowspan="2" class="align-middle">Kode</th>
                                                            <th rowspan="2" class="align-middle">Nama Akun</th>
                                                            <th colspan="2" class="text-center">Saldo Awal</th>
                                                            <th colspan="2" class="text-center">Mutasi</th>
                                                            <th colspan="2" class="text-center">Saldo Akhir</th>
                                                  </tr>
                                                  <tr>
                                                            <th class="text-end">Debit</th><th class="text-end">Kredit</th>
                                                            <th class="text-end">Debit</th><th class="text-end">Kredit</th>
                                                            <th class="text-end">Debit</th><th class="text-end">Kredit</th>
                                                  </tr>
                                        </thead>
                                        <tbody style="font-variant-numeric: tabular-nums">
                                                  <?php
                                                  $cell = function (int $v): string {
                                                            return $v !== 0 ? esc(acc_fmt($v)) : '';
                                                  };
                                                  ?>
                                                  <?php if (empty($laporan['rows'])): ?>
                                                            <tr><td colspan="8" class="text-center text-secondary-light">Tidak ada data pada periode ini</td></tr>
                                                  <?php endif; ?>
                                                  <?php foreach ($laporan['rows'] as $r): ?>
                                                            <?php $o = (int) $r['open']; $e = (int) $r['end']; ?>
                                                            <tr>
                                                                      <td class="text-nowrap"><?= esc($r['kode']) ?></td>
                                                                      <td><?= esc($r['nama']) ?></td>
                                                                      <td class="text-end"><?= $cell(max($o, 0)) ?></td>
                                                                      <td class="text-end"><?= $cell(max(-$o, 0)) ?></td>
                                                                      <td class="text-end"><?= $cell((int) $r['td']) ?></td>
                                                                      <td class="text-end"><?= $cell((int) $r['tk']) ?></td>
                                                                      <td class="text-end"><?= $cell(max($e, 0)) ?></td>
                                                                      <td class="text-end"><?= $cell(max(-$e, 0)) ?></td>
                                                            </tr>
                                                  <?php endforeach; ?>
                                        </tbody>
                                        <tfoot class="bg-body-tertiary fw-bold">
                                                  <tr>
                                                            <td colspan="2">Total</td>
                                                            <td class="text-end"><?= esc(acc_fmt((int) $laporan['total']['openD'])) ?></td>
                                                            <td class="text-end"><?= esc(acc_fmt((int) $laporan['total']['openK'])) ?></td>
                                                            <td class="text-end"><?= esc(acc_fmt((int) $laporan['total']['td'])) ?></td>
                                                            <td class="text-end"><?= esc(acc_fmt((int) $laporan['total']['tk'])) ?></td>
                                                            <td class="text-end"><?= esc(acc_fmt((int) $laporan['total']['endD'])) ?></td>
                                                            <td class="text-end"><?= esc(acc_fmt((int) $laporan['total']['endK'])) ?></td>
                                                  </tr>
                                        </tfoot>
                              </table>
                    </div>
          </div>
</div>

<?php $this->endSection(); ?>
