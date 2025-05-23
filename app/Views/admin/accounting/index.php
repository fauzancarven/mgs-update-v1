<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>
 

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?>

<div class="card radius-15 overflow-hidden mb-3 border-0 shadow-sm">
    <div class="card-header border-bottom-0 px-4 pt-4 bg-white mb-lg-0 mb-2">
        <div class="row">
            <div class="mb-0 col-6 pb-4 order-lg-1">
                <h4 class="mb-0">Accounting Test</h4> 
            </div> 
            <div class="justify-content-end col-6 pb-4 order-lg-3">
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click()"><i class="ti-plus pe-2"></i>Tambah <span class="d-none d-md-inline-block">Store<span></button>
            </div>
        </div>
    </div>  
</div>     

<?php $this->endSection(); ?>