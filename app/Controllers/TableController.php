<?php

namespace App\Controllers; 
use App\Models\UserModel;
use App\Models\StoreModel;
use App\Models\ProjectModel;
use App\Models\SurveyModel;
use App\Models\SampleModel;
use App\Models\SphModel;
use App\Models\InvoiceModel;
use App\Models\CustomerModel;
use App\Models\DeliveryModel;
use App\Models\ProdukModel;
use App\Models\PembelianModel;
use App\Models\VendorModel;
use App\Models\AccountingModel;
use Config\Services; 

class TableController extends BaseController
{  
    public function __construct()
    { 
        $this->helpers = ['form', 'url'];  
    }
    public function account()
    {   
        $request = Services::request();
        $datatable = new UserModel(); 
        if ($request->getMethod(true) === 'POST') { 
            echo $datatable->blog_json();
       }
        
    } 
    public function store()
    {   
        $request = Services::request();
        $datatable = new StoreModel(); 
        if ($request->getMethod(true) === 'POST') { 
            echo $datatable->blog_json();
        }
        
    } 
    public function project()
    {   
        $request = Services::request();
        $datatable = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_table_project($request->getPost());
        }    
        
    } 
    public function project_survey()
    {   
        $request = Services::request();
        $datatable = new SurveyModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_table_project_survey($request->getPost());
        }    
        
    } 
    public function project_survey_datatable()
    {   
        $request = Services::request();
        $datatable = new SurveyModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_survey($request->getPost());
        }     
    } 
    public function project_sample()
    {   
        $request = Services::request();
        $datatable = new SampleModel(); 
        if ($request->getMethod(true) === 'POST') {   
            //echo $datatable->load_table_project_sample($request->getPost());
        }    
        
    } 
    public function project_sample_datatable()
    {   
        $request = Services::request();
        $datatable = new SampleModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_sample($request->getPost());
        }    
        
    } 
    public function project_penawaran()
    {   
        $request = Services::request();
        $datatable = new SphModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_table_project_penawaran($request->getPost());
        }    
        
    } 
    public function project_penawaran_datatable()
    {   
        $request = Services::request();
        $datatable = new SphModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_penawaran($request->getPost());
        }    
        
    } 
    public function project_invoice()
    {   
        $request = Services::request();
        $datatable = new SphModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_table_project_invoice($request->getPost());
        }    
        
    } 
    public function project_invoice_datatable()
    {   
        $request = Services::request();
        $datatable = new InvoiceModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_invoice($request->getPost());
        }    
        
    } 
    public function pembelian_datatable()
    {   
        $request = Services::request();
        $datatable = new PembelianModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_pembelian($request->getPost());
        }    
        
    } 
    public function pengiriman_datatable()
    {   
        $request = Services::request();
        $datatable = new DeliveryModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_delivery($request->getPost());
        }    
        
    } 
 
    public function customer()
    {   
        $request = Services::request();
        $datatable = new CustomerModel(); 
        if ($request->getMethod(true) === 'POST') {  
            echo $datatable->blog_json($request->getPost()["search"]["value"]); 
        }    
        
    } 
    public function produk()
    {   
        $request = Services::request();
        $datatable = new ProdukModel(); 
        if ($request->getMethod(true) === 'POST') {  
            echo $datatable->load_table_produk($request->getPost()); 
        }    
        
    } 
    
    public function produk_datatable()
    {   
        $request = Services::request();
        $datatable = new ProdukModel(); 
        if ($request->getMethod(true) === 'POST') {  
            echo $datatable->load_datatable_produk($request->getPost()); 
        }    
        
    } 

    public function vendor()
    {   
        $request = Services::request();
        $datatable = new VendorModel(); 
        if ($request->getMethod(true) === 'POST') {  
            echo $datatable->blog_json($request->getPost()["search"]["value"]); 
        }    
        
    } 


    
    public function payment_request_datatable()
    {   
        $request = Services::request();
        $datatable = new AccountingModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->get_data_request_payment($request->getPost());
        }    
        
    } 
    

    
}
