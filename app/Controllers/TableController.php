<?php

namespace App\Controllers; 
use App\Models\UserModel;
use App\Models\StoreModel;
use App\Models\ProjectModel;
use App\Models\ProjectsurveyModel;
use App\Models\ProjectsampleModel;
use App\Models\ProjectsphModel;
use App\Models\ProjectinvoiceModel;
use App\Models\CustomerModel;
use App\Models\ProdukModel;
use App\Models\VendorModel;
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
        $datatable = new ProjectsurveyModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_table_project_survey($request->getPost());
        }    
        
    } 
    public function project_survey_datatable()
    {   
        $request = Services::request();
        $datatable = new ProjectsurveyModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_project_survey($request->getPost());
        }     
    } 
    public function project_sample()
    {   
        $request = Services::request();
        $datatable = new ProjectsampleModel(); 
        if ($request->getMethod(true) === 'POST') {   
            //echo $datatable->load_table_project_sample($request->getPost());
        }    
        
    } 
    public function project_sample_datatable()
    {   
        $request = Services::request();
        $datatable = new ProjectsampleModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_project_sample($request->getPost());
        }    
        
    } 
    public function project_penawaran()
    {   
        $request = Services::request();
        $datatable = new ProjectsphModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_table_project_penawaran($request->getPost());
        }    
        
    } 
    public function project_penawaran_datatable()
    {   
        $request = Services::request();
        $datatable = new ProjectsphModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_project_penawaran($request->getPost());
        }    
        
    } 
    public function project_invoice_datatable()
    {   
        $request = Services::request();
        $datatable = new ProjectinvoiceModel(); 
        if ($request->getMethod(true) === 'POST') {   
            echo $datatable->load_datatable_project_invoice($request->getPost());
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
    
}
