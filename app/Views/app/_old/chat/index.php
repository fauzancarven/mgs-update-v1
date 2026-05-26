<?php $this->extend('app/template/main'); ?>

<?php $this->section('content'); ?> 
<style> 
    .chat-all-list { 
        height : calc(100vh - 300px);
        overflow-y: auto;
        margin-top:0.5rem;
    }
    .chat-sidebar-single {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        padding: 0.6875rem .5rem;
        cursor: pointer;
    }
    .chat-sidebar-single .img {
        position: relative;
    }
    .chat-sidebar-single .img img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        -o-object-fit: cover;
        border-radius:100%;
    }
    .chat-sidebar-single .info {
        flex-grow: 1;
        padding: 0 0.75rem;
    }
    .chat-sidebar-single .action {
        margin-inline-start: auto;
    }
    .chat-sidebar-single:hover {
        background: #0000000d;
        border-radius: 0.5rem;
    }
    .chat-all-list::-webkit-scrollbar {
        width: 10px;
        background-color: white;
    }
    .chat-all-list::-webkit-scrollbar-thumb {
        background-color: #e9e9e9;
        border: 3px solid #ffffff;
    }
</style>
<!-- 
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?> -->

<div class="card radius-15 overflow-hidden mb-3 border-0 shadow-sm">
    <div class="card-header border-bottom-0 px-4 pt-4 bg-white mb-lg-0 mb-2">
        <div class="d-flex align-items-center row">
            <div class="mb-0 col-lg-2 col-6 pb-lg-2 pb-4 order-lg-1">
                <h4 class="mb-0">Message</h4> 
            </div>  
        </div>
    </div> 
    <div class="card-body p-0" id="element-to-print"> 
        <div class="d-flex chat-view">
            <div class="w-25 h-100 p-2">
                <div class="chat-sidebar-search search-data d-flex">   
                    <div class="input-group flex-fill w-100">  
                        <input class="form-control form-control-sm input-form" id="searchdatasurvey" placeholder="Cari atau mulai chat baru" value="" type="text">
                        <i class="fa-solid fa-magnifying-glass"></i>    
                    </div> 
                </div>  
                <div class="chat-all-list">
                    <div class="chat-sidebar-single active">
                        <div class="img">
                            <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                            <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                            <span class="mb-0 text-xs text-truncate">Update project paving @habib taufik kantor @Fauzan Caren</span>
                        </div>
                        <div class="action text-end">
                            <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                            <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">Kathryn Murphy</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end -->
                    <div class="chat-sidebar-single active">
                        <div class="img">
                        <img src="<?= base_url() ?>/assets/images/profile/user/MGS00004.png" alt="image">
                        </div>
                        <div class="info">
                        <h6 class="text-sm mb-1">James Michael</h6>
                        <p class="mb-0 text-xs">hey! there i'm...</p>
                        </div>
                        <div class="action text-end">
                        <p class="mb-0 text-neutral-400 text-xs lh-1">12:30 PM</p>
                        <span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">8</span>
                        </div>
                    </div><!-- chat-sidebar-single end --> 
                </div>
            </div>
            <div class="flex-grow-1 border  p-2"> </div>
        </div>
    </div>   
</div>    
<div style="margin-bottom: 100px;"></div> 
<div id="modal-message"></div> 
<?php $this->endSection(); ?>

<script>
    
</script>