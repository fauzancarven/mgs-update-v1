<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */  

$routes->post('/api/get_produk', 'ApiController::get_produk');

$routes->get('/', 'AdminController::index', ['filter' => 'login']); 
$routes->get('/admin', 'AdminController::index', ['filter' => 'login']);
$routes->get('/admin/account', 'AdminController::account', ['filter' => 'login']);
$routes->get('/admin/project', 'AdminController::project', ['filter' => 'login']);
$routes->get('/admin/store', 'AdminController::store', ['filter' => 'login']);
$routes->get('/admin/customer', 'AdminController::customer', ['filter' => 'login']);
$routes->get('/admin/produk', 'AdminController::produk', ['filter' => 'login']);
$routes->get('/admin/vendor', 'AdminController::vendor', ['filter' => 'login']);
$routes->get('/admin/accounting', 'AdminController::accounting', ['filter' => 'login']);
$routes->get('/admin/pettycash', 'AdminController::pettycash', ['filter' => 'login']);
$routes->get('/admin/paymentrequest', 'AdminController::paymentrequest', ['filter' => 'login']);
$routes->get('/admin/bukubesar', 'AdminController::bukubesar', ['filter' => 'login']);

$routes->get('/admin/sales/survey', 'AdminController::survey', ['filter' => 'login']);
$routes->get('/admin/sales/sample', 'AdminController::sample', ['filter' => 'login']);
$routes->get('/admin/sales/penawaran', 'AdminController::penawaran', ['filter' => 'login']);
$routes->get('/admin/sales/invoice', 'AdminController::invoice', ['filter' => 'login']);
$routes->get('/admin/inventory/pembelian', 'AdminController::pembelian', ['filter' => 'login']);

$routes->post('/admin/sidebar', 'AdminController::sidebar', ['filter' => 'login']);


/**
 * DATATABLE
 */
$routes->post('/datatables/get-data-account', 'TableController::account', ['filter' => 'login']);
$routes->post('/datatables/get-data-store', 'TableController::store', ['filter' => 'login']); 
$routes->post('/datatables/get-data-project', 'TableController::project', ['filter' => 'login']);
$routes->post('/datatables/get-data-project/survey', 'TableController::project_survey', ['filter' => 'login']);
$routes->post('/datatables/get-data-project/sample', 'TableController::project_sample', ['filter' => 'login']);
$routes->post('/datatables/get-data-project/sph', 'TableController::project_penawaran', ['filter' => 'login']);
$routes->post('/datatables/get-data-customer', 'TableController::customer', ['filter' => 'login']);
$routes->post('/datatables/get-data-produk', 'TableController::produk', ['filter' => 'login']);
$routes->post('/datatables/get-datatable-produk', 'TableController::produk_datatable', ['filter' => 'login']);
$routes->post('/datatables/get-datatable-survey', 'TableController::project_survey_datatable', ['filter' => 'login']);
$routes->post('/datatables/get-datatable-sample', 'TableController::project_sample_datatable', ['filter' => 'login']);
$routes->post('/datatables/get-datatable-penawaran', 'TableController::project_penawaran_datatable', ['filter' => 'login']);
$routes->post('/datatables/get-datatable-invoice', 'TableController::project_invoice_datatable', ['filter' => 'login']);
$routes->post('/datatables/get-datatable-pembelian', 'TableController::pembelian_datatable', ['filter' => 'login']);
$routes->post('/datatables/get-data-vendor', 'TableController::vendor', ['filter' => 'login']);

$routes->post('/datatables/get-datatable-payment-request', 'TableController::payment_request_datatable', ['filter' => 'login']);


/**
 * ACTION
 */

/** STORE ACTION */
$routes->post('action/update-project/(:any)/(:any)', 'ActionController::update_status_project/$1/$2)', ['filter' => 'login']);
$routes->get('/action/test', 'ActionController::test', ['filter' => 'login']);
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
$routes->post('/action/edit-data-project/(:any)', 'ActionController::project_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-project/(:num)', 'ActionController::project_delete/$1', ['filter' => 'login']);
$routes->post('/action/add-data-project-category', 'ActionController::project_add_category', ['filter' => 'login']); 

$routes->post('/action/add-data-survey', 'ActionController::survey_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-survey/(:num)', 'ActionController::survey_edit/$1', ['filter' => 'login']); 
$routes->post('/action/update-survey/(:num)/(:num)', 'ActionController::survey_status/$1/$2', ['filter' => 'login']); 
$routes->post('/action/delete-data-survey/(:num)', 'ActionController::survey_delete/$1', ['filter' => 'login']); 
$routes->post('/action/add-data-survey-finish/(:num)', 'ActionController::survey_finish/$1', ['filter' => 'login']); 
$routes->post('/action/edit-data-survey-finish/(:num)', 'ActionController::survey_finish_edit/$1', ['filter' => 'login']); 

$routes->post('/action/add-data-sample', 'ActionController::sample_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-sample/(:num)', 'ActionController::sample_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-sample/(:num)', 'ActionController::sample_delete/$1', ['filter' => 'login']);
$routes->post('/action/update-data-sample-delivery/(:num)', 'ActionController::sample_update_delivery/$1', ['filter' => 'login']); 
$routes->post('/action/update-data-invoice-delivery/(:num)', 'ActionController::invoice_update_delivery/$1', ['filter' => 'login']); 

$routes->post('/action/add-data-penawaran', 'ActionController::penawaran_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-penawaran/(:num)', 'ActionController::penawaran_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-penawaran/(:num)', 'ActionController::penawaran_delete/$1', ['filter' => 'login']);
$routes->post('/action/update-penawaran/(:num)/(:num)', 'ActionController::penawaran_status/$1/$2', ['filter' => 'login']); 

$routes->post('/action/add-data-invoice', 'ActionController::invoice_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-invoice/(:num)', 'ActionController::invoice_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-invoice/(:num)', 'ActionController::invoice_delete/$1', ['filter' => 'login']); 
$routes->post('/action/update-invoice/(:num)/(:num)', 'ActionController::invoice_status/$1/$2', ['filter' => 'login']); 

$routes->post('/action/add-data-payment', 'ActionController::payment_add', ['filter' => 'login']);   
$routes->post('/action/edit-data-payment/(:num)', 'ActionController::payment_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-payment/(:num)', 'ActionController::payment_delete/$1', ['filter' => 'login']); 

$routes->post('/action/delete-data-project-payment/(:num)', 'ActionController::payment_delete/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-project-request-payment/(:num)', 'ActionController::payment_request_delete/$1', ['filter' => 'login']); 


$routes->post('/action/request-data-payment-delete/(:num)', 'ActionController::payment_request_delete/$1', ['filter' => 'login']); 
$routes->post('/action/request-data-payment-edit/(:num)', 'ActionController::payment_request_edit/$1', ['filter' => 'login']); 
$routes->post('/action/request-data-payment', 'ActionController::payment_request', ['filter' => 'login']); 

$routes->post('/action/add-data-proforma', 'ActionController::proforma_add', ['filter' => 'login']);    
$routes->post('/action/edit-data-proforma/(:num)', 'ActionController::proforma_edit/$1', ['filter' => 'login']);

$routes->post('/action/add-data-delivery', 'ActionController::delivery_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-delivery/(:num)', 'ActionController::delivery_edit/$1', ['filter' => 'login']);
$routes->post('/action/delete-data-delivery/(:num)', 'ActionController::delivery_delete/$1', ['filter' => 'login']);
$routes->post('/action/add-proses-delivery/(:num)', 'ActionController::delivery_proses/$1', ['filter' => 'login']);
$routes->post('/action/edit-proses-delivery/(:num)', 'ActionController::delivery_proses_edit/$1', ['filter' => 'login']);
$routes->post('/action/add-finish-delivery/(:num)', 'ActionController::delivery_finish/$1', ['filter' => 'login']);
$routes->post('/action/finish-data-delivery/(:num)', 'ActionController::delivery_finish/$1', ['filter' => 'login']);
$routes->post('/action/edit-finish-delivery/(:num)', 'ActionController::delivery_finish_edit/$1', ['filter' => 'login']);

$routes->post('/action/add-data-po', 'ActionController::pembelian_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-po/(:num)', 'ActionController::pembelian_edit/$1', ['filter' => 'login']); 
$routes->post('/action/delete-data-po/(:num)', 'ActionController::pembelian_delete/$1', ['filter' => 'login']);

$routes->post('/action/add-data-project-accounting/(:num)', 'ActionController::project_accounting_add/$1', ['filter' => 'login']);  
$routes->post('/action/edit-data-project-accounting/(:num)', 'ActionController::project_accounting_edit/$1', ['filter' => 'login']);  
$routes->post('/action/delete-project-accounting/(:num)', 'ActionController::project_accounting_delete/$1', ['filter' => 'login']);  

$routes->post('/action/add-data-template-footer', 'ActionController::template_footer_add', ['filter' => 'login']); 
$routes->post('/action/edit-data-template-footer/(:num)', 'ActionController::template_footer_edit/$1', ['filter' => 'login']);  

$routes->post('/action/add-data-lampiran', 'ActionController::lampiran_add', ['filter' => 'login']);  



/** ACCOUNT VENDOR */
$routes->post('/action/add-data-vendor', 'ActionController::vendor_add', ['filter' => 'login']);
$routes->post('/action/edit-data-vendor/(:num)', 'ActionController::vendor_edit/$1', ['filter' => 'login']);
$routes->post('/action/delete-data-vendor', 'ActionController::vendor_delete', ['filter' => 'login']);

/** ACCOUNT PRODUK VARIAN */
$routes->post('/action/add-data-produk-varian', 'ActionController::produk_varian_add', ['filter' => 'login']); 
$routes->post('/action/add-data-produk-varian-value', 'ActionController::produk_varian_value_add', ['filter' => 'login']);

 
/** ACCOUNT PRODUK */
$routes->post('/action/add-data-produk-category', 'ActionController::produk_category_add', ['filter' => 'login']);
$routes->post('/action/add-data-item-unit', 'ActionController::item_unit_add', ['filter' => 'login']); 
$routes->post('/action/get-data-item-unit/(:num)', 'ActionController::item_unit_get/$1', ['filter' => 'login']); 
$routes->post('/action/add-data-produk', 'ActionController::produk_add', ['filter' => 'login']);   
$routes->post('/action/edit-data-produk/(:any)', 'ActionController::produk_edit/$1', ['filter' => 'login']);  
$routes->post('/action/delete-data-produk/(:num)', 'ActionController::produk_delete/$1', ['filter' => 'login']); 
$routes->post('/action/get-data-produk-new', 'ActionController::produk_get', ['filter' => 'login']);   
$routes->post('/action/rename-data-produk/(:num)', 'ActionController::produk_rename/$1', ['filter' => 'login']);   



/**
 * SELECT2
 */  
$routes->post('/select2/get-data-project', 'SelectController::project', ['filter' => 'login']);
$routes->post('/select2/get-data-customer', 'SelectController::customer', ['filter' => 'login']);
$routes->post('/select2/get-data-npwp', 'SelectController::lampiran/npwp', ['filter' => 'login']);
$routes->post('/select2/get-data-ktp', 'SelectController::lampiran/ktp', ['filter' => 'login']);
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
$routes->post('/select2/get-data-ref-sph', 'SelectController::ref_sph', ['filter' => 'login']);
$routes->post('/select2/get-data-ref-invoice', 'SelectController::ref_invoice', ['filter' => 'login']);
$routes->post('/select2/get-data-ref-po', 'SelectController::ref_po', ['filter' => 'login']);
$routes->post('/select2/get-data-ref-vendor/(:num)', 'SelectController::ref_project_vendor/$1', ['filter' => 'login']);
$routes->post('/select2/get-data-ref-sph/(:num)', 'SelectController::ref_project_sph/$1', ['filter' => 'login']);
$routes->post('/select2/get-data-ref-invoice/(:num)', 'SelectController::ref_project_invoice/$1', ['filter' => 'login']);
$routes->post('/select2/get-data-ref-sample/(:num)', 'SelectController::ref_project_sample/$1', ['filter' => 'login']);

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
$routes->post('/message/edit-project/(:num)', 'MessageController::project_edit/$1', ['filter' => 'login']);  
$routes->post('/message/add-item-select', 'MessageController::produk_select_new', ['filter' => 'login']);  


$routes->post('/message/add-survey', 'MessageController::survey_add', ['filter' => 'login']);  
$routes->post('/message/edit-survey/(:num)', 'MessageController::survey_edit/$1', ['filter' => 'login']); 

$routes->post('/message/add-project-survey/(:num)', 'MessageController::project_survey_add/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-survey/(:num)', 'MessageController::project_survey_edit/$1', ['filter' => 'login']);  
$routes->post('/message/add-project-survey-finish/(:num)', 'MessageController::project_survey_finish/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-survey-finish/(:num)', 'MessageController::project_survey_finish_edit/$1', ['filter' => 'login']);  

$routes->post('/message/add-sample', 'MessageController::sample_add/$1', ['filter' => 'login']);  
$routes->post('/message/add-project-sample/(:num)', 'MessageController::project_sample_add/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-sample/(:num)', 'MessageController::project_sample_edit/$1', ['filter' => 'login']); 

$routes->post('/message/add-project-sph/(:num)', 'MessageController::project_sph_add/$1', ['filter' => 'login']);  
$routes->post('/message/add-penawaran', 'MessageController::penawaran_add', ['filter' => 'login']);  
$routes->post('/message/edit-project-sph/(:num)', 'MessageController::project_sph_edit/$1', ['filter' => 'login']);
$routes->post('/message/edit-penawaran/(:num)', 'MessageController::penawaran_edit/$1', ['filter' => 'login']);   

$routes->post('/message/add-invoice', 'MessageController::invoice_add', ['filter' => 'login']); 
$routes->post('/message/edit-invoice/(:num)', 'MessageController::invoice_edit/$1', ['filter' => 'login']);   
$routes->post('/message/add-project-invoice/(:num)', 'MessageController::project_invoice_add/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-invoice/(:num)', 'MessageController::project_invoice_edit/$1', ['filter' => 'login']);

$routes->post('/message/add-project-po/(:num)', 'MessageController::project_po_add/$1', ['filter' => 'login']);   
$routes->post('/message/edit-project-po/(:num)', 'MessageController::project_po_edit/$1', ['filter' => 'login']);  
$routes->post('/message/add-pembelian', 'MessageController::po_add/$1', ['filter' => 'login']);   

$routes->post('/message/add-project-payment/(:num)', 'MessageController::project_payment_add/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-payment/(:num)', 'MessageController::project_payment_edit/$1', ['filter' => 'login']);  
$routes->post('/message/request-project-payment/(:num)', 'MessageController::project_payment_request/$1', ['filter' => 'login']);  
$routes->post('/message/request-project-payment-edit/(:num)', 'MessageController::project_payment_request_edit/$1', ['filter' => 'login']);  

$routes->post('/message/add-payment/(:num)', 'MessageController::payment_add/$1', ['filter' => 'login']); 
$routes->post('/message/edit-payment/(:num)', 'MessageController::payment_edit/$1', ['filter' => 'login']); 

$routes->post('/message/request-payment/(:num)', 'MessageController::payment_request/$1', ['filter' => 'login']); 
$routes->post('/message/request-payment-edit/(:num)', 'MessageController::payment_request_edit/$1', ['filter' => 'login']);  

$routes->post('/message/add-project-proforma/(:num)', 'MessageController::project_proforma_add/$1', ['filter' => 'login']); 
$routes->post('/message/edit-project-proforma/(:num)', 'MessageController::project_proforma_edit/$1', ['filter' => 'login']);  

$routes->post('/message/add-project-delivery/(:num)', 'MessageController::project_delivery_add/$1', ['filter' => 'login']);  
$routes->post('/message/edit-project-delivery/(:num)', 'MessageController::project_delivery_edit/$1', ['filter' => 'login']);   

$routes->post('/message/add-proses-delivery/(:num)', 'MessageController::project_delivery_proses/$1', ['filter' => 'login']);  
$routes->post('/message/add-finish-delivery/(:num)', 'MessageController::project_delivery_finish/$1', ['filter' => 'login']);  

$routes->post('/message/edit-proses-delivery/(:num)', 'MessageController::project_delivery_proses_edit/$1', ['filter' => 'login']);  
$routes->post('/message/edit-finish-delivery/(:num)', 'MessageController::project_delivery_finish_edit/$1', ['filter' => 'login']);  

$routes->post('/message/add-project-accounting/(:num)/(:num)', 'MessageController::project_accounting_add/$1/$2', ['filter' => 'login']);   
$routes->post('/message/edit-project-accounting/(:num)/(:num)', 'MessageController::project_accounting_edit/$1/$2', ['filter' => 'login']);   

$routes->post('/message/add-delivery-invoice/(:num)', 'MessageController::delivery_add/$1/invoice', ['filter' => 'login']);  
$routes->post('/message/edit-delivery-invoice/(:num)', 'MessageController::delivery_edit/$1/invoice', ['filter' => 'login']);  
$routes->post('/message/proses-delivery-invoice/(:num)', 'MessageController::delivery_proses/$1/invoice', ['filter' => 'login']);  
$routes->post('/message/finish-delivery-invoice/(:num)', 'MessageController::delivery_finish/$1/invoice', ['filter' => 'login']);  


/**
 *  MODAL print
 */ 
$routes->get('/print/survey/(:num)', 'PrintController::survey/$1');  
$routes->get('/print/project/survey/(:num)', 'PrintController::project_survey/$1');  
$routes->get('/print/project/sph/(:num)', 'PrintController::project_sph/$1');   
$routes->get('/print/project/invoice/(:num)', 'PrintController::project_invoice/$1');  
$routes->get('/print/project/invoiceA5/(:num)', 'PrintController::project_invoice_a5/$1');  
$routes->get('/print/project/deliveryA5/(:num)', 'PrintController::project_delivery_a5/$1');  
$routes->get('/print/project/po/(:num)', 'PrintController::project_po/$1');   
$routes->get('/print/project/poA5/(:num)', 'PrintController::project_po_a5/$1');  

$routes->get('/print/project/proformaA5/(:num)', 'PrintController::project_proforma_a5/$1'); 
$routes->get('/print/project/payment/(:num)', 'PrintController::project_payment/$1'); 
$routes->get('/print/project/paymentA5/(:num)', 'PrintController::project_payment_a5/$1'); 
$routes->get('/print/project/paymentA4/(:num)', 'PrintController::project_payment_a4/$1'); 


$routes->get('/printhtml/project/sph/(:num)', 'PrintController::project_sph_html/$1'); 
$routes->get('/project/surveyfinish', 'DownloadController::survey_finish'); 
