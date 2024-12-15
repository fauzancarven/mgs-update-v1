<?php

namespace App\Controllers; 
use App\Models\CustomerModel;
use App\Models\CustomercategoryModel;
use App\Models\ProvinceModel;
use App\Models\StoreModel;
use App\Models\ProjectcategoryModel;
use App\Models\ProdukunitModel;
use App\Models\ProdukcategoryModel;
use App\Models\ProdukvarianModel;
use App\Models\ProdukvarianvalueModel;
use App\Models\ProduksatuanModel;
use App\Models\VendorcategoryModel;
use App\Models\VendorModel;

use Config\Services; 

class SelectController extends BaseController
{  
    public function __construct()
    { 
        $this->helpers = ['form', 'url'];  
    }
    
    public function customer()
    {   
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array();
       
      
            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new CustomerModel();
                $customerList = $models->select("*")
                    ->orderBy('name')
                    ->findAll(5);
            }else{
                $searchTerm = $postData['searchTerm'];
    
                // Fetch record
                $models = new CustomerModel();
                $customerList = $models->select("*")
                    ->like('name',$searchTerm)
                    ->orderBy('name')
                    ->findAll(5);
            } 
      
            $data = array(); 
            foreach($customerList as $customer){
                $customername = $customer['code'] . " - " . ($customer['company']== "" ? $customer['name'] : $customer['name'] . ' (' . $customer['company'] . ')');
                $customertelp = (($customer['telp2'] == "" || $customer['telp2'] == "-") ? $customer['telp1'] : $customer['telp1'] . " / " . $customer['telp2']);
                $htmlItem = '
                               <div class="d-flex flex-column" >
                                  <span style="font-size:0.75rem" class="fw-bold">' . $customername . '</span>
                                  <span style="font-size:0.6rem">' . $customertelp . '</span>
                                  <span style="font-size:0.6rem">' .  $customer['address'] . '</span>
                                  <span style="font-size:0.6rem">Note : ' .  $customer['comment'] . '</span>
                               </div>';
                $data[] = array(
                    "id" => $customer['id'],
                    "text" => $customer['code'] . " - " . $customer['name'],
                    "html" => $htmlItem, 
                );
            }
      
            $response['data'] = $data;
      
            return $this->response->setJSON($response);
        }
        
    } 

    public function customer_category()
    {   
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new CustomercategoryModel();
                $customerList = $models->select('id,name')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new CustomercategoryModel();
                $customerList = $models->select('id,name')
                    ->like('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $customer){
                $data[] = array(
                    "id" => $customer['id'],
                    "text" => $customer['name'],
                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response);
        }
        
    } 

    public function store()
    {   
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new StoreModel();
                $customerList = $models->select('*')
                    ->orderBy('StoreId')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new StoreModel();
                $customerList = $models->select('*')
                    ->like('StoreCode',$searchTerm)
                    ->orderBy('StoreId')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['StoreId'],
                    "text" => $row['StoreCode']. " - " . $row['StoreName'],
                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response);
        }
        
    } 
    public function project_category()
    {   
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new ProjectcategoryModel();
                $customerList = $models->select('*')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new ProjectcategoryModel();
                $customerList = $models->select('*')
                    ->like('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['name'],
                    "text" => $row['name'],
                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response);
        }
        
    } 
    public function city()
    {
        $request = Services::request();
        $postData = $request->getPost(); 
        $type = $postData['type']; 
        $select = isset($postData['select']) ? $postData['select'] : '';
        $province = new ProvinceModel();
        if($type == "prov"){
            $query = $province->get_province(); 
            echo json_encode($query);
            exit;
        }
        if($type == "kota"){
            $query = $province->get_city($select["prov"]["id"]); 
            echo json_encode($query);
            exit;
        }
        if($type == "kec"){
            $query = $province->get_district($select["prov"]["id"],$select["kota"]["id"]); 
            echo json_encode($query);
            exit;
        }
        if($type == "poscode"){
            $query = $province->get_village($select["prov"]["id"],$select["kota"]["id"],$select["kec"]["id"]); 
            echo json_encode($query);
            exit;
        }
       
        
    }
    public function city_search(){
        $request = Services::request();
        $postData = $request->getPost(); 
        $province = new ProvinceModel();
        $search =  $postData['search']; 

        $query = $province->get_search($search); 
        echo json_encode($query);  
    } 

    public function item_unit(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new ProdukunitModel();
                $customerList = $models->select('*')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new ProdukunitModel();
                $customerList = $models->select('*')
                    ->like('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['name'], 

                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }
    public function item(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new ProdukunitModel();
                $customerList = $models->select('*')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new ProdukunitModel();
                $customerList = $models->select('*')
                    ->like('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['name'], 

                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }

    public function vendor_category(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new VendorcategoryModel();
                $customerList = $models->select('*')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new VendorcategoryModel();
                $customerList = $models->select('*')
                    ->like('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['name'], 

                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }

    public function produk_category(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new ProdukcategoryModel();
                $customerList = $models->select('*')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new ProdukcategoryModel();
                $customerList = $models->select('*')
                    ->like('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['name'], 

                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }
    public function produk_vendor(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new VendorModel();
                $customerList = $models->select('*')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new VendorModel();
                $customerList = $models->select('*')
                    ->like('code',$searchTerm)
                    ->orLike('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "code" => $row['code'], 
                    "name" => $row['name'], 
                    "text" =>  $row['code']." - ".$row['name'],  
                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }
    public function produk_varian(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new ProdukvarianModel();
                $customerList = $models->select('*')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new ProdukvarianModel();
                $customerList = $models->select('*')
                    ->like('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['name'], 

                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }
    public function produk_varian_value(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new ProdukvarianvalueModel();
                $customerList = $models->select('*')
                    ->where('varian',$postData['type'])
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new ProdukvarianvalueModel();
                $customerList = $models->select('*')
                    ->where('varian',$postData['type'])
                    ->like('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['name'], 

                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    } 
    public function produk_satuan(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new ProduksatuanModel();
                $customerList = $models->select('*')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new ProduksatuanModel();
                $customerList = $models->select('*')
                    ->like('name',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['name'], 

                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }


}