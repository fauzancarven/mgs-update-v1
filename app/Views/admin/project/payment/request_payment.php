<div class="modal fade" id="modal-request-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true" data-menu="project">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Request Pembayaran <?= $refType ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="mb-1">
                    <label for="date-payment" class="col-form-label">Bank:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="bank-payment" value="" placeholder="Masukan nama Bank (contoh: BCA,BNI)">
                </div>  
                <div class="mb-1">
                    <label for="date-payment" class="col-form-label">No. Rekening:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="rek-payment" value=""  placeholder="Masukan Nomer Rekening (contoh: 781234567)">
                </div>  
                <div class="mb-1">
                    <label for="date-payment" class="col-form-label">Nama Rekening:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="name-payment" value=""  placeholder="Masukan Nama Rekening (contoh: Mahiera Global Solution)">
                </div>  
                <div class="mb-1">
                    <label for="date-payment" class="col-form-label">Total:</label>
                    <input class="form-control form-control-sm input-form" style="width:100%" id="total-payment" value="<?= $total ?>" disabled>
                </div>  
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-add-payment">Simpan</button>
            </div>
        </div>
    </div>
</div>