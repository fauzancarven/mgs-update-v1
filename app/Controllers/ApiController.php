<?php

namespace App\Controllers;

use App\Models\ProdukModel;

use Config\Services; 

class ApiController extends BaseController
{  
    public function get_produk(){   
        $request = Services::request();
        $models = new ProdukModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            
            return $this->response->setJSON($models->get_produk($postData,false));  
        }
        
    }  
}