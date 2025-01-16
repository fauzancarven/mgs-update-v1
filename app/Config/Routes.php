<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */  
$routes->get('/', 'AdminController::index', ['filter' => 'login']); 
$routes->get('/admin', 'AdminController::index', ['filter' => 'login']);
$routes->get('/admin/account', 'AdminController::account', ['filter' => 'login']);
$routes->get('/admin/project', 'AdminController::project', ['filter' => 'login']);
$routes->get('/admin/store', 'AdminController::store', ['filter' => 'login']);
$routes->get('/admin/customer', 'AdminController::customer', ['filter' => 'login']);
$routes->get('/admin/produk', 'AdminController::produk', ['filter' => 'login']);
$routes->get('/admin/vendor', 'AdminController::vendor', ['filter' => 'login']);
$routes->post('/admin/sidebar', 'AdminController::sidebar', ['filter' => 'login']);



/**
 * DATATABLE
 */
$routes->post('/datatables/get-data-account', 'TableController::account', ['filter' => 'login']);
$routes->post('/datatables/get-data-store', 'TableController::store', ['filter' => 'login']); 
$routes->post('/datatables/get-data-project', 'TableController::project', ['filter' => 'login']);
$routes->post('/datatables/get-data-customer', 'TableController::customer', ['filter' => 'login']);
$routes->post('/datatables/get-data-produk', 'TableController::produk', ['filter' => 'login']);
$routes->post('/datatables/get-data-vendor', 'TableController::vendor', ['filter' => 'login']);



/**
 * ACTION
 */

/** STORE ACTION */
$routes->post('/action/delete-data-store', 'ActionController::store_delete', ['filter' => 'login']);
$routes->post('/action/add-data-store', 'ActionController::store_add', ['filter' => 'login']);
$routes->post('/action/edit-data-store/(:any)', 'ActionController::store_edit/$1', ['filter' => 'login']);

/** ACCOUNT ACTION */ 
$routes->post('/action/add-data-account', 'ActionController::account_add', ['filter' => 'login']);
$routes->post('/action/edit-data-account/(:any)', 'ActionController::account_edit/$1', ['filter' => 'login']);
$routes->post('/action/delete-data-account', 'ActionController::account_delete', ['filter' => 'login']);
$routes->post('/action/reset-password-data-account', 'ActionController::account_reset_password', ['filter' => 'login']);

/** ACCOUNT CUSTOMER */ 
$routes->post('/action/add-data-customer-category', 'ActionController::customer_category_add', ['filter' => 'login']);
$routes->post('/action/add-data-customer', 'ActionController::customer_add', ['filter' => 'login']);
$routes->post('/action/edit-data-customer/(:num)', 'ActionController::customer_edit/$1', ['filter' => 'login']);
$routes->post('/action/delete-data-customer', 'ActionController::customer_delete', ['filter' => 'login']);
 
/** ACCOUNT PROJECT */
$routes->post('/action/get-data-project-tab', 'ActionController::project_tab', ['filter' => 'login']); 
$routes->post('/action/get-data-project/(:any)', 'ActionController::project/$1', ['filter' => 'login']); 
$routes->post('/action/add-data-project', 'ActionController::project_add', ['filter' => 'login']); 
$routes->post('/action/add-data-penawaran', 'ActionController::penawaran_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-penawaran/(:num)', 'ActionController::penawaran_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-penawaran/(:num)', 'ActionController::penawaran_delete/$1', ['filter' => 'login']); 
$routes->post('/action/add-data-invoice', 'ActionController::invoice_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-invoice/(:num)', 'ActionController::invoice_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-invoice/(:num)', 'ActionController::invoice_delete/$1', ['filter' => 'login']); 
$routes->post('/action/add-data-payment', 'ActionController::payment_add', ['filter' => 'login']);   
$routes->post('/action/edit-data-payment/(:num)', 'ActionController::payment_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-project-payment/(:num)', 'ActionController::payment_delete/$1', ['filter' => 'login']); 
$routes->post('/action/add-data-proforma', 'ActionController::proforma_add', ['filter' => 'login']);    
$routes->post('/action/edit-data-proforma/(:num)', 'ActionController::proforma_edit/$1', ['filter' => 'login']); 
$routes->post('/action/add-data-delivery', 'ActionController::delivery_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-delivery/(:num)', 'ActionController::delivery_edit/$1', ['filter' => 'login']);
$routes->post('/action/delete-data-delivery/(:num)', 'ActionController::delivery_delete/$1', ['filter' => 'login']);
$routes->post('/action/add-data-po', 'ActionController::pembelian_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-po/(:num)', 'ActionController::pembelian_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-po/(:num)', 'ActionController::pembelian_delete/$1', ['filter' => 'login']);

$routes->post('/action/add-data-template-footer', 'ActionController::template_footer_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-template-footer/(:num)', 'ActionController::template_footer_edit/$1', ['filter' => 'login']);   


/** ACCOUNT PRODUK */
$routes->post('/action/add-data-vendor', 'ActionController::vendor_add', ['filter' => 'login']);
$routes->post('/action/delete-data-vendor', 'ActionController::vendor_delete', ['filter' => 'login']);

$routes->post('/action/add-data-produk-varian', 'ActionController::produk_varian_add', ['filter' => 'login']); 
$routes->post('/action/add-data-produk-varian-value', 'ActionController::produk_varian_value_add', ['filter' => 'login']);

 
/** ACCOUNT PRODUK */
$routes->post('/action/add-data-produk-category', 'ActionController::produk_category_add', ['filter' => 'login']);
$routes->post('/action/add-data-item-unit', 'ActionController::item_unit_add', ['filter' => 'login']); 
$routes->post('/action/get-data-item-unit/(:num)', 'ActionController::item_unit_get/$1', ['filter' => 'login']); 
$routes->post('/action/add-data-produk', 'ActionController::produk_add', ['filter' => 'login']);   
$routes->post('/action/edit-data-produk/(:any)', 'ActionController::produk_edit/$1', ['filter' => 'login']);  


/**
 * SELECT2
 */  
$routes->post('/select2/get-data-customer', 'SelectController::customer', ['filter' => 'login']);
$routes->post('/select2/get-data-customer-category', 'SelectController::customer_category', ['filter' => 'login']);
$routes->post('/select2/get-data-store', 'SelectController::store', ['filter' => 'login']);
$routes->post('/select2/get-data-city', 'SelectController::city', ['filter' => 'login']);
$routes->post('/select2/get-data-city-search', 'SelectController::city_search', ['filter' => 'login']);  
$routes->post('/select2/get-data-category-project', 'SelectController::project_category', ['filter' => 'login']);  
$routes->post('/select2/get-data-item-unit', 'SelectController::item_unit', ['filter' => 'login']);    
$routes->post('/select2/get-data-item', 'SelectController::item', ['filter' => 'login']);    
$routes->post('/select2/get-data-produk-kategori', 'SelectController::produk_category', ['filter' => 'login']);   
$routes->post('/select2/get-data-produk-vendor', 'SelectController::produk_vendor', ['filter' => 'login']);
$routes->post('/select2/get-data-produk-varian', 'SelectController::produk_varian', ['filter' => 'login']); 
$routes->post('/select2/get-data-produk-varian-value', 'SelectController::produk_varian_value', ['filter' => 'login']); 
$routes->post('/select2/get-data-produk-satuan', 'SelectController::produk_satuan', ['filter' => 'login']); 
$routes->post('/select2/get-data-vendor-kategori', 'SelectController::vendor_category', ['filter' => 'login']); 
$routes->post('/select2/get-data-users', 'SelectController::users', ['filter' => 'login']);
$routes->post('/select2/get-data-template-footer/(:any)', 'SelectController::template_footer/$1', ['filter' => 'login']); 
$routes->post('/select2/get-data-ref-vendor/(:num)', 'SelectController::ref_project_vendor/$1', ['filter' => 'login']);

/**
 *  MODAL MESSAGE
 */ 
$routes->post('/message/add-store', 'MessageController::store_add', ['filter' => 'login']);  
$routes->post('/message/edit-store/(:num)', 'MessageController::store_edit/$1', ['filter' => 'login']);  

$routes->post('/message/add-account', 'MessageController::account_add', ['filter' => 'login']);  
$routes->post('/message/edit-account/(:num)', 'MessageController::account_edit/$1', ['filter' => 'login']);
$routes->post('/message/reset-account/(:num)', 'MessageController::account_reset/$1', ['filter' => 'login']); 
$routes->post('/message/delete-account/(:num)', 'MessageController::account_delete/$1', ['filter' => 'login']);

$routes->post('/message/add-customer', 'MessageController::customer_add', ['filter' => 'login']); 
$routes->post('/message/edit-customer/(:num)', 'MessageController::customer_edit/$1', ['filter' => 'login']);  

$routes->post('/message/add-vendor', 'MessageController::vendor_add', ['filter' => 'login']); 
$routes->post('/message/edit-vendor/(:num)', 'MessageController::vendor_edit/$1', ['filter' => 'login']);  

$routes->post('/message/add-produk', 'MessageController::produk_add', ['filter' => 'login']);  
$routes->post('/message/edit-produk/(:num)', 'MessageController::produk_edit/$1', ['filter' => 'login']);  
$routes->post('/message/select-produk', 'MessageController::produk_select', ['filter' => 'login']);  


$routes->post('/message/add-project', 'MessageController::project_add', ['filter' => 'login']);  
$routes->post('/message/add-project-sph/(:num)', 'MessageController::project_sph_add/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-sph/(:num)', 'MessageController::project_sph_edit/$1', ['filter' => 'login']);  
$routes->post('/message/add-project-invoice/(:num)', 'MessageController::project_invoice_add/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-invoice/(:num)', 'MessageController::project_invoice_edit/$1', ['filter' => 'login']);  
$routes->post('/message/add-project-po/(:num)', 'MessageController::project_po_add/$1', ['filter' => 'login']);   
$routes->post('/message/edit-project-po/(:num)', 'MessageController::project_po_edit/$1', ['filter' => 'login']);  
$routes->post('/message/add-project-payment/(:num)', 'MessageController::project_payment_add/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-payment/(:num)', 'MessageController::project_payment_edit/$1', ['filter' => 'login']);  
$routes->post('/message/add-project-proforma/(:num)', 'MessageController::project_proforma_add/$1', ['filter' => 'login']); 
$routes->post('/message/edit-project-proforma/(:num)', 'MessageController::project_proforma_edit/$1', ['filter' => 'login']);  

$routes->post('/message/delivery-project-invoice/(:num)', 'MessageController::project_delivery_add/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-delivery/(:num)', 'MessageController::project_delivery_edit/$1', ['filter' => 'login']);  


/**
 *  MODAL print
 */ 
$routes->get('/print/project/sph/(:num)', 'PrintController::project_sph/$1', ['filter' => 'login']);  
$routes->get('/print/project/invoiceA4/(:num)', 'PrintController::project_invoice_a4/$1', ['filter' => 'login']);  
$routes->get('/print/project/invoiceA5/(:num)', 'PrintController::project_invoice_a5/$1', ['filter' => 'login']);  
$routes->get('/print/project/deliveryA5/(:num)', 'PrintController::project_delivery_a5/$1', ['filter' => 'login']);  
$routes->get('/print/project/poA4/(:num)', 'PrintController::project_po_a4/$1', ['filter' => 'login']);   
$routes->get('/print/project/poA5/(:num)', 'PrintController::project_po_a5/$1', ['filter' => 'login']);  

$routes->get('/print/project/proformaA5/(:num)', 'PrintController::project_proforma_a5/$1', ['filter' => 'login']); 
$routes->get('/print/project/paymentA5/(:num)', 'PrintController::project_payment_a5/$1', ['filter' => 'login']); 


$routes->get('/printhtml/project/sph/(:num)', 'PrintController::project_sph_html/$1', ['filter' => 'login']); 