<?php

namespace App\Controllers; 
use App\Models\CustomerModel;
use App\Models\CustomercategoryModel;
use App\Models\ProvinceModel;
use App\Models\StoreModel;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Models\ProjectcategoryModel;
use App\Models\ProdukModel;
use App\Models\ProdukcategoryModel;
use App\Models\ProdukvarianModel;
use App\Models\ProdukvarianvalueModel;
use App\Models\ProduksatuanModel;
use App\Models\VendorcategoryModel;
use App\Models\VendorModel;
use App\Models\TemplatefooterModel;

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
                    ->orderBy('code',"DESC")
                    ->findAll();
            }else{
                $searchTerm = $postData['searchTerm'];
    
                // Fetch record
                $models = new CustomerModel();
                $customerList = $models->select("*")
                    ->like('name',$searchTerm)
                    ->orderBy('code',"DESC")
                    ->findAll();
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
    public function users()
    {   
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new UserModel();
                $customerList = $models->select('*')
                    ->orderBy('id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new UserModel();
                $customerList = $models->select('*')
                    ->like('username',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['code']. " - " . $row['username'],
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
            $models = new ProdukModel();
            if(!isset($postData['searchTerm'])){
                 // Fetch record
                
                $customerList = $models->select('*,produk.id,produk.name,produk_category.id cat_id,produk_category.name cat_name,produk_category.code cat_code,vendor,varian')
                    ->join("produk_category","produk_category.id = produk.category") 
                    ->orderBy('produk.id')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record 
                $customerList = $models->select('*,produk.id,produk.name,produk_category.id cat_id,produk_category.name cat_name,produk_category.code cat_code,vendor,varian')
                    ->join("produk_category","produk_category.id = produk.category")
                    ->like('produk.name',$searchTerm)
                    ->orderBy('produk.id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['name'], 
                    "category" => $row['cat_code']." - ".$row['cat_name'],  
                    "vendor" => $row['vendor'], 
                    "varian" => $row['varian'], 
                    "html" => $models->getHtml($row)  
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
                    ->like('code',$searchTerm)
                    ->orderBy('id')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['id'],
                    "text" => $row['code'], 

                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }
    public function template_footer($type){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 


            $models = new TemplatefooterModel();
            $models->select('*');  
            if(isset($postData['searchTerm'])) $models->like('TemplateFooterName',$postData['searchTerm']);  
            $models->like('TemplateFooterCategory',$type);
            $models->orderBy('TemplateFooterId');
            $customerList = $models->find(); 
            $data = array();

            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['TemplateFooterId'],
                    "text" => $row['TemplateFooterName'], 
                    "detail" => $row['TemplateFooterDetail'], 
                    "delta" => $row['TemplateFooterDelta'],  
                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }

    public function ref_project_vendor($id){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            $modelsvendor = new VendorModel();
            $modelsitem = new ProdukModel();
            if(!isset($postData['searchTerm'])){
                 // Fetch record
                $models = new ProjectModel();
                $Project = $models->getSelectRefVendor($id);
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new ProjectModel();
                $Project = $models->getSelectRefVendor($id,$searchTerm);
            }  
            $data = array();
            $data[] = array(
                "id" => 0,
                "text" => "-", 
                "html" => '<span style="font-size:0.75rem" class="fw-bold">Tidak ada yang dipilih</span>', 
                "vendor" => $modelsvendor->get()->getResult(),   
                "detail_item" => [],      
                "type" => "",  
            );
            foreach($Project as $row){
                $customername = $row['code'] . " - " . ($row['company']== "" ? $row['name'] : $row['name'] . ' (' . $row['company'] . ')');
                $customertelp = (($row['telp2'] == "" || $row['telp2'] == "-") ? $row['telp1'] : $row['telp1'] . " / " . $row['telp2']);
                $htmlItem = '
                               <div class="d-flex flex-column" >
                                  <span style="font-size:0.75rem" class="fw-bold">' . $row['type'] . ' - ' . $row['coderef'] . '</span>
                                  <span style="font-size:0.6rem">' . $customername . '</span>
                                  <span style="font-size:0.6rem">' . $customertelp . '</span>
                                  <span style="font-size:0.6rem">' .  $row['address'] . '</span> 
                               </div>';
                $detail_item =  ($row['type'] == "INV" ? $models->getdataDetailInvoice($row['refid']) : $models->getdataDetailSPH($row['refid'])); 
                $vendor_array = array();
                $detail = array();
                foreach($detail_item as $row_item){ 
                    $varian = json_decode($row_item->varian, true); 
                    if (!empty($varian)) {
                        foreach ($varian as $v) { 
                            if ($v['varian'] == 'vendor'){
                                $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("code",$v['value'])->get()->getRow()));
                                if ( !in_array($data_arr, $vendor_array)) {
                                    $vendor_array[] = $data_arr;
                                }
                            }
                        }
                    }
                    
                    $data_total = $modelsitem->getDetailProduk(JSON_DECODE($row_item->varian,true),$row_item->produkid); 
                    if($data_total){ 
                        $harga = $data_total["hargabeli"];
                    }else{
                        $harga = 0;
                    }
                    $detail[] = array(
                        "produkid" => $row_item->produkid, 
                        "satuan_id"=> ($row_item->satuan_id == 0 ? "" : $row_item->satuan_id),
                        "satuantext"=>$row_item->satuantext, 
                        "varian"=> JSON_DECODE($row_item->varian,true), 
                        "text"=> $row_item->text,
                        "group"=> $row_item->group,
                        "type"=> $row_item->type,
                        "ref"=>  $row_item->qty,
                        "qty"=>  $row_item->qty,
                        "harga"=>  $harga,
                        "total"=>  $row_item->qty * $harga,
                    );
                } 
                $data[] = array(
                    "id" => $row['refid'],
                    "text" => $row['coderef'], 
                    "html" => $htmlItem,    
                    "type" => $row['type'],    
                    "vendor" => $vendor_array,   
                    "detail_item" => $detail,   
                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }

}