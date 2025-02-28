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
        <div class="d-flex align-items-center row">
            <div class="mb-0 col-lg-2 col-6 pb-lg-2 pb-4 order-lg-1">
                <h4 class="mb-0">LIST STORE</h4> 
            </div> 
            <div class="justify-content-end d-flex col-lg-2 col-6 pb-lg-2 pb-4  order-lg-3">
                <button class="btn btn-sm btn-primary px-3 rounded" onclick="add_click()"><i class="ti-plus pe-2"></i>Tambah <span class="d-none d-md-inline-block">Store<span></button>
            </div>
            <div class="d-lg-flex search-bar col-lg-8 col-12 order-lg-2 pb-lg-2 pb-4">
                <div class="form-inline  navbar-search w-100">
                    <div class="input-group input-group-sm w-100 ">
                        <input type="text" class="form-control rounded-left small bg-light " placeholder="Cari Data ..." aria-label="Search" aria-describedby="basic-addon2" name="search_user"  id="input-search-data">
                        <div class="input-group-append">
                            <button class="btn bg-light btn-light border-right border-top border-bottom rounded-right px-3" id="btn-search-data">
                                <i class="icon-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>     
<?php $this->endSection(); ?>