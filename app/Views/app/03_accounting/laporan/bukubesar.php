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
                              <div class="col-md-3">
                                        <label class="form-label">Akun</label>
                                        <select name="kode" id="kodeAkun" class="form-select form-select-sm" style="width:100%">
                                                  <?php if (!empty($kode)): ?>
                                                            <option value="<?= esc($kode) ?>" selected><?= esc($akunTerpilih ?? $kode) ?></option>
                                                  <?php endif; ?>
                                        </select>
                              </div>
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

<div class="card">
          <div class="card-body">
                    <?php if (empty($kode)): ?>
                              <div class="text-center text-secondary-light py-5">Pilih akun terlebih dahulu</div>
                    <?php elseif (empty($laporan)): ?>
                              <div class="alert alert-warning mb-0">Akun tidak ditemukan</div>
                    <?php else: ?>
                              <div class="mb-3">
                                        <h6 class="fw-semibold mb-1"><?= esc($laporan['akun']['kode_akun'] . ' - ' . $laporan['akun']['nama_akun']) ?></h6>
                                        <div class="text-secondary-light">
                                                  Saldo normal: <?= esc($laporan['akun']['saldo_normal']) ?>
                                                  &middot; Periode: <?= esc(acc_date_id($from)) ?> s.d. <?= esc(acc_date_id($to)) ?>
                                        </div>
                              </div>
                              <div class="table-responsive">
                                        <table class="table table-sm table-bordered align-middle mb-0">
                                                  <thead class="bg-body-tertiary">
                                                            <tr>
                                                                      <th>Tanggal</th>
                                                                      <th>No Jurnal</th>
                                                                      <th>Keterangan</th>
                                                                      <th class="text-end">Debit</th>
                                                                      <th class="text-end">Kredit</th>
                                                                      <th class="text-end">Saldo</th>
                                                            </tr>
                                                  </thead>
                                                  <tbody style="font-variant-numeric: tabular-nums">
                                                            <tr class="bg-body-tertiary fw-semibold">
                                                                      <td colspan="5">Saldo Awal</td>
                                                                      <td class="text-end"><?= esc(acc_fmt((int) $laporan['open'])) ?></td>
                                                            </tr>
                                                            <?php if (empty($laporan['rows'])): ?>
                                                                      <tr>
                                                                                <td colspan="6" class="text-center text-secondary-light">Tidak ada transaksi pada periode ini</td>
                                                                      </tr>
                                                            <?php else: ?>
                                                                      <?php foreach ($laporan['rows'] as $r): ?>
                                                                                <tr>
                                                                                          <td class="text-nowrap"><?= esc(acc_date_id($r['tanggal'])) ?></td>
                                                                                          <td class="text-nowrap">
                                                                                                    <a href="<?= base_url('admin/accounting/jurnal/edit/' . $r['jurnal_id']) ?>"><?= esc($r['no']) ?></a>
                                                                                          </td>
                                                                                          <td><?= esc($r['ket']) ?></td>
                                                                                          <td class="text-end"><?= (int) $r['d'] !== 0 ? esc(acc_fmt((int) $r['d'])) : '' ?></td>
                                                                                          <td class="text-end"><?= (int) $r['k'] !== 0 ? esc(acc_fmt((int) $r['k'])) : '' ?></td>
                                                                                          <td class="text-end"><?= esc(acc_fmt((int) $r['saldo'])) ?></td>
                                                                                </tr>
                                                                      <?php endforeach; ?>
                                                            <?php endif; ?>
                                                            <tr class="bg-body-tertiary fw-semibold">
                                                                      <td colspan="3">Total Mutasi</td>
                                                                      <td class="text-end"><?= esc(acc_fmt((int) $laporan['totD'])) ?></td>
                                                                      <td class="text-end"><?= esc(acc_fmt((int) $laporan['totK'])) ?></td>
                                                                      <td></td>
                                                            </tr>
                                                            <tr class="bg-body-tertiary fw-bold">
                                                                      <td colspan="5">Saldo Akhir</td>
                                                                      <td class="text-end"><?= esc(acc_fmt((int) $laporan['end'])) ?></td>
                                                            </tr>
                                                  </tbody>
                                        </table>
                              </div>
                    <?php endif; ?>
          </div>
</div>

<script>
          $(function () {
                    $('#kodeAkun').select2({
                              placeholder: 'Pilih akun',
                              allowClear: true,
                              ajax: {
                                        url: "<?= base_url() ?>select2/get-data-acc-coa",
                                        dataType: 'json',
                                        type: 'POST',
                                        delay: 250,
                                        data: function (params) {
                                                  return { searchTerm: params.term };
                                        },
                                        processResults: function (response) {
                                                  return { results: response.data };
                                        },
                                        cache: true
                              }
                    });
          });
</script>

<?php $this->endSection(); ?>
