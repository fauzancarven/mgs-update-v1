<?php

namespace App\Controllers;

use App\Models\SphModel;

use Config\Services; 

class DataController extends BaseController
{  
    public function get_data_sph($id){   
        $request = Services::request();
        $models = new SphModel(); 
        if ($request->getMethod(true) === 'POST') {    

            $header = $models->get_data_sph($id);
            $detail = $models->get_data_sph_detail($id);
            return $this->response->setJSON(array(
                "header" => $header,
                "detail" => $detail
            ));  
        }
        
    }  
}