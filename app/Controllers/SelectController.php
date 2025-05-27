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
use App\Models\LampiranModel;

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
                    ->orderBy('CustomerCode',"DESC")
                    ->findAll();
            }else{
                $searchTerm = $postData['searchTerm'];
    
                // Fetch record
                $models = new CustomerModel();
                $customerList = $models->select("*")
                    ->like('CustomerName',$searchTerm)
                    ->orderBy('CustomerCode',"DESC")
                    ->findAll();
            } 
      
            $data = array(); 
            foreach($customerList as $customer){
                $customername = $customer['CustomerCode'] . " - " . ($customer['CustomerCompany']== "" ? $customer['CustomerName'] : $customer['CustomerName'] . ' (' . $customer['CustomerCompany'] . ')');
                $customertelp = (($customer['CustomerTelp2'] == "" || $customer['CustomerTelp2'] == "-") ? $customer['CustomerTelp1'] : $customer['CustomerTelp1'] . " / " . $customer['CustomerTelp2']);
                $htmlItem = '
                               <div class="d-flex flex-column" >
                                  <span style="font-size:0.75rem" class="fw-bold">' . $customername . '</span>
                                  <span style="font-size:0.6rem">' . $customertelp . '</span>
                                  <span style="font-size:0.6rem">' .  $customer['CustomerAddress'] . '</span>
                                  <span style="font-size:0.6rem">Note : ' .  $customer['CustomerComment'] . '</span>
                               </div>';
                $data[] = array(
                    "id" => $customer['CustomerId'],
                    "text" => $customer['CustomerCode'] . " - " . $customer['CustomerName'],
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
            $models = new CustomercategoryModel();
            $models->select('*');
            if(isset($postData['searchTerm'])) $models->like('CustomerCategoryName',$postData['searchTerm']);
            $models->orderBy('CustomerCategoryId');
            $customerList = $models->find();
            $data = array();
            foreach($customerList as $customer){
                $data[] = array(
                    "id" => $customer['CustomerCategoryId'],
                    "text" => $customer['CustomerCategoryName'],
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
 
    public function vendor_category(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 


            $models = new VendorcategoryModel();
            $models->select('*');
            if(isset($postData['searchTerm'])) $models->like('VendorCategoryName',$postData['searchTerm']);
            $models->orderBy('VendorCategoryId');
            $customerList = $models->find();
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
                
                $customerList = $models->join("produk_category","produk_category.ProdukCategoryId = produk.ProdukCategoryId") 
                    ->orderBy('produk.ProdukId')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record 
                $customerList = $models->join("produk_category","produk_category.ProdukCategoryId = produk.ProdukCategoryId")
                    ->like('produk.ProdukName',$searchTerm)
                    ->orderBy('produk.ProdukId')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['ProdukId'],
                    "text" => $row['ProdukName'], 
                    "category" => $row['ProdukCategoryCode']." - ".$row['ProdukCategoryName'],  
                    "vendor" => $row['ProdukVendor'], 
                    "varian" => $row['ProdukVarian'], 
                    "html" => $models->getHtml($row)  
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

            // Fetch record
            $models = new ProdukcategoryModel();
            $customerList = $models->select('*');
            if(isset($postData['searchTerm'])) $models->like('ProdukCategoryName',$postData['searchTerm']);
            $models->orderBy('ProdukCategoryId');
            $customerList = $models->find(); 

            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['ProdukCategoryId'],
                    "text" => $row['ProdukCategoryName'], 

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
                    ->orderBy('VendorId')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new VendorModel();
                $customerList = $models->select('*')
                    ->like('VendorCode',$searchTerm)
                    ->orLike('VendorName',$searchTerm)
                    ->orderBy('VendorId')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['VendorId'],
                    "code" => $row['VendorCode'], 
                    "name" => $row['VendorName'], 
                    "text" =>  $row['VendorCode']." - ".$row['VendorName'],  
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
                    ->orderBy('ProdukSatuanId')
                    ->find();
            }else{
                $searchTerm = $postData['searchTerm']; 
                // Fetch record
                $models = new ProduksatuanModel();
                $customerList = $models->select('*')
                    ->like('ProdukSatuanCode',$searchTerm)
                    ->orderBy('ProdukSatuanId')
                    ->find();
            }  
            $data = array();
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['ProdukSatuanId'],
                    "text" => $row['ProdukSatuanCode'], 

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
    public function lampiran($type){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 


            $models = new LampiranModel();
            $models->select('*');  
            if(isset($postData['searchTerm'])) $models->like('Name',$postData['searchTerm']);  
            $models->like('Type',$type);
            $models->orderBy('Id');
            $customerList = $models->find(); 
            $data = array();

            $data[] = array(
                "id" => 0,
                "text" => "Tidak ada yang dipilih", 
                "image" => "",    
            );
            foreach($customerList as $row){
                $data[] = array(
                    "id" => $row['Id'],
                    "text" => $row['Name'], 
                    "image" => $row['Image'],    
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
                $customername = $row['CustomerCode'] . " - " . ($row['CustomerCompany']== "" ? $row['CustomerName'] : $row['CustomerName'] . ' (' . $row['CustomerCompany'] . ')');
                $customertelp = (($row['CustomerTelp2'] == "" || $row['CustomerTelp2'] == "-") ? $row['CustomerTelp1'] : $row['CustomerTelp1'] . " / " . $row['CustomerTelp2']);
                $htmlItem = '
                               <div class="d-flex flex-column" >
                                  <span style="font-size:0.75rem" class="fw-bold">' . $row['type'] . ' - ' . $row['code'] . '</span>
                                  <span style="font-size:0.6rem">' . $customername . '</span>
                                  <span style="font-size:0.6rem">' . $customertelp . '</span>
                                  <span style="font-size:0.6rem">' .  $row['CustomerAddress'] . '</span> 
                               </div>';
                if($row['type'] == "INV"){
                    $detail_item =   $models->getdataDetailInvoice($row['refid']); 
                    $vendor_array = array();
                    $detail = array();
                    foreach($detail_item as $row_item){ 
                        $varian =  json_decode($row_item->InvDetailVarian, true); 
                        if (!empty($varian)) {
                            foreach ($varian as $v) { 
                                if ($v['varian'] == 'vendor'){
                                    $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("VendorCode",$v['value'])->get()->getRow()));
                                    if ( !in_array($data_arr, $vendor_array)) {
                                        $vendor_array[] = $data_arr;
                                    }
                                }
                            }
                        }
                        
                        $data_total = $modelsitem->getDetailProduk(JSON_DECODE($row_item->InvDetailVarian,true),$row_item->ProdukId); 
                        if($data_total){ 
                            $harga = $data_total["ProdukDetailHargaBeli"];
                        }else{
                            $harga = 0;
                        }
                        $detail[] = array(
                            "id" => $row_item->ProdukId, 
                            "produkid" => $row_item->ProdukId, 
                            "satuan_id"=> ($row_item->InvDetailSatuanId == 0 ? "" : $row_item->InvDetailSatuanId),
                            "satuan_text"=>$row_item->InvDetailSatuanText, 
                            "varian"=> JSON_DECODE($row_item->InvDetailVarian,true), 
                            "text"=> $row_item->InvDetailText,
                            "group"=> $row_item->InvDetailGroup,
                            "type"=> $row_item->InvDetailType,
                            "ref"=>  $row_item->InvDetailQty,
                            "qty"=>  $row_item->InvDetailQty,
                            "hargajual"=>  $row_item->InvDetailPrice,
                            "disc"=>  $row_item->InvDetailDisc,
                            "harga"=>  $harga, 
                            "data"=>  $data_total, 
                            "total"=>  $row_item->InvDetailQty * $harga,
                        );
                    } 
                }else{      
                    $detail_item =  $models->get_data_sph_detail($row['refid']); 
                    $vendor_array = array();
                    $detail = array();
                    foreach($detail_item as $row_item){ 
                        $varian =  json_decode($row_item->SphDetailVarian, true); 
                        if (!empty($varian)) {
                            foreach ($varian as $v) { 
                                if ($v['varian'] == 'vendor'){
                                    $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("VendorCode",$v['value'])->get()->getRow()));
                                    if ( !in_array($data_arr, $vendor_array)) {
                                        $vendor_array[] = $data_arr;
                                    }
                                }
                            }
                        }
                        
                        $data_total = $modelsitem->getDetailProduk(JSON_DECODE($row_item->SphDetailVarian,true),$row_item->ProdukId); 
                        if($data_total){ 
                            $harga = $data_total["ProdukDetailHargaBeli"];
                        }else{
                            $harga = 0;
                        }
                        $detail[] = array(
                            "id" => $row_item->ProdukId, 
                            "produkid" => $row_item->ProdukId, 
                            "satuan_id"=> ($row_item->SphDetailSatuanId == 0 ? "" : $row_item->SphDetailSatuanId),
                            "satuan_text"=>$row_item->SphDetailSatuanText, 
                            "varian"=> JSON_DECODE($row_item->SphDetailVarian,true), 
                            "text"=> $row_item->SphDetailText,
                            "group"=> $row_item->SphDetailGroup,
                            "type"=> $row_item->SphDetailType,
                            "ref"=>  $row_item->SphDetailQty,
                            "qty"=>  $row_item->SphDetailQty,
                            "hargajual"=>  $row_item->SphDetailPrice,
                            "disc"=>  $row_item->SphDetailDisc,
                            "harga"=>  $harga,
                            "data"=>  $data_total, 
                            "total"=>  $row_item->SphDetailQty * $harga,
                        );
                    } 
                }
                $data[] = array(
                    "id" => $row['refid'],
                    "text" => $row['code'], 
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
    public function ref_project_invoice($id){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array();  

            $modelsitem = new ProdukModel(); 
            $modelsvendor = new VendorModel();
            if(!isset($postData['searchTerm'])){
                $models = new ProjectModel();
                $Project = $models->getSelectRefInvoice($id);

            }else{
                $searchTerm = $postData['searchTerm']; 
                $models = new ProjectModel();
                $Project = $models->getSelectRefInvoice($id,$searchTerm);
            } 
            $data = array();
            $data[] = array(
                "id" => 0,
                "text" => "-", 
                "html" => '<span style="font-size:0.75rem" class="fw-bold">Tidak ada yang dipilih</span>',  
                "detail_item" => [],      
                "penawaran" => [],  
            );
            foreach($Project as $row){
                $customername = $row['CustomerCode'] . " - " . ($row['CustomerCompany']== "" ? $row['CustomerName'] : $row['CustomerName'] . ' (' . $row['CustomerCompany'] . ')');
                $customertelp = (($row['CustomerTelp2'] == "" || $row['CustomerTelp2'] == "-") ? $row['CustomerTelp1'] : $row['CustomerTelp1'] . " / " . $row['CustomerTelp2']);
                $htmlItem = '
                <div class="d-flex flex-column" >
                   <span style="font-size:0.75rem" class="fw-bold">' . $row['SphCode'] . '</span>
                   <span style="font-size:0.6rem">' . $customername . '</span>
                   <span style="font-size:0.6rem">' . $customertelp . '</span>
                   <span style="font-size:0.6rem">' .  $row['CustomerAddress'] . '</span> 
                </div>';
                $detail_item =  $models->get_data_sph_detail($row['SphId']); 
                $vendor_array = array();
                $detail = array();
                foreach($detail_item as $row_item){ 
                    $varian =  json_decode($row_item->SphDetailVarian, true);  
                    foreach ($varian as $v) {  
                        $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("VendorCode",$v['value'])->get()->getRow()));
                        if ( !in_array($data_arr, $vendor_array)) {
                            $vendor_array[] = $data_arr;
                        } 
                    } 
                    
                    $data_total = $modelsitem->getDetailProduk(JSON_DECODE($row_item->SphDetailVarian,true),$row_item->ProdukId); 
                    if($data_total){ 
                        $harga = $data_total["ProdukDetailHargaBeli"];
                    }else{
                        $harga = 0;
                    }
                    $detail[] = array(
                        "produkid" => $row_item->ProdukId, 
                        "satuan_id"=> ($row_item->SphDetailSatuanId == 0 ? "" : $row_item->SphDetailSatuanId),
                        "satuan_text"=>$row_item->SphDetailSatuanText, 
                        "varian"=> JSON_DECODE($row_item->SphDetailVarian,true), 
                        "text"=> $row_item->SphDetailText,
                        "group"=> $row_item->SphDetailGroup,
                        "type"=> $row_item->SphDetailType,
                        "ref"=>  $row_item->SphDetailQty,
                        "qty"=>  $row_item->SphDetailQty,
                        "harga"=>  $harga,
                        "total"=>  $row_item->SphDetailQty * $harga,
                    );
                } 
                $data[] = array(
                    "id" => $row['SphId'],
                    "text" => $row['SphCode'], 
                    "html" => $htmlItem,         
                    "detail_item" => $detail,     
                    "penawaran" => $row,  
                );
            }
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }
    public function ref_project_sample($id){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array();  

            $modelsitem = new ProdukModel();  
            if(!isset($postData['searchTerm'])){
                $models = new ProjectModel();
                $Project = $models->get_data_ref_sample($id);

            }else{
                $searchTerm = $postData['searchTerm']; 
                $models = new ProjectModel();
                $Project = $models->get_data_ref_sample($id,$searchTerm);
            }  
            $data = array();
            $data[] = array(
                "id" => 0,
                "text" => "-", 
                "html" => '<span style="font-size:0.75rem" class="fw-bold">Tidak ada yang dipilih</span>',  
                "detail_item" => [],      
                "type" => "",  
            );

            foreach($Project as $row){
                $htmlItem = '
                            <div class="d-flex flex-column" >
                                <span style="font-size:0.75rem" class="fw-bold">' . $row['type'] . ' - ' . $row['code'] . '</span>
                                <span style="font-size:0.6rem">' . $row['CustomerName'] . '</span>
                                <span style="font-size:0.6rem">' . $row['CustomerTelp'] . '</span>
                                <span style="font-size:0.6rem">' .  $row['CustomerAddress'] . '</span> 
                            </div>';
                $detail = array();
                // if($row['type'] == "INV"){
                //     $detail_item =   $models->getdataDetailInvoice($row['refid']); 
                //     $vendor_array = array();
                //     $detail = array();
                //     foreach($detail_item as $row_item){ 
                //         $varian =  json_decode($row_item->InvDetailVarian, true); 
                //         if (!empty($varian)) {
                //             foreach ($varian as $v) { 
                //                 if ($v['varian'] == 'vendor'){
                //                     $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("VendorCode",$v['value'])->get()->getRow()));
                //                     if ( !in_array($data_arr, $vendor_array)) {
                //                         $vendor_array[] = $data_arr;
                //                     }
                //                 }
                //             }
                //         }
                        
                //         $data_total = $modelsitem->getDetailProduk(JSON_DECODE($row_item->InvDetailVarian,true),$row_item->ProdukId); 
                //         if($data_total){ 
                //             $harga = $data_total["ProdukDetailHargaBeli"];
                //         }else{
                //             $harga = 0;
                //         }
                //         $detail[] = array(
                //             "id" => $row_item->ProdukId, 
                //             "produkid" => $row_item->ProdukId, 
                //             "satuan_id"=> ($row_item->InvDetailSatuanId == 0 ? "" : $row_item->InvDetailSatuanId),
                //             "satuan_text"=>$row_item->InvDetailSatuanText, 
                //             "varian"=> JSON_DECODE($row_item->InvDetailVarian,true), 
                //             "text"=> $row_item->InvDetailText,
                //             "group"=> $row_item->InvDetailGroup,
                //             "type"=> $row_item->InvDetailType,
                //             "ref"=>  $row_item->InvDetailQty,
                //             "qty"=>  $row_item->InvDetailQty,
                //             "hargajual"=>  $row_item->InvDetailPrice,
                //             "disc"=>  $row_item->InvDetailDisc,
                //             "harga"=>  $harga, 
                //             "data"=>  $data_total, 
                //             "total"=>  $row_item->InvDetailQty * $harga,
                //         );
                //     } 
                // }else{      
                //     $detail_item =  $models->get_data_sph_detail($row['refid']); 
                //     $vendor_array = array();
                //     $detail = array();
                //     foreach($detail_item as $row_item){ 
                //         $varian =  json_decode($row_item->SphDetailVarian, true); 
                //         if (!empty($varian)) {
                //             foreach ($varian as $v) { 
                //                 if ($v['varian'] == 'vendor'){
                //                     $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("VendorCode",$v['value'])->get()->getRow()));
                //                     if ( !in_array($data_arr, $vendor_array)) {
                //                         $vendor_array[] = $data_arr;
                //                     }
                //                 }
                //             }
                //         }
                        
                //         $data_total = $modelsitem->getDetailProduk(JSON_DECODE($row_item->SphDetailVarian,true),$row_item->ProdukId); 
                //         if($data_total){ 
                //             $harga = $data_total["ProdukDetailHargaBeli"];
                //         }else{
                //             $harga = 0;
                //         }
                //         $detail[] = array(
                //             "id" => $row_item->ProdukId, 
                //             "produkid" => $row_item->ProdukId, 
                //             "satuan_id"=> ($row_item->SphDetailSatuanId == 0 ? "" : $row_item->SphDetailSatuanId),
                //             "satuan_text"=>$row_item->SphDetailSatuanText, 
                //             "varian"=> JSON_DECODE($row_item->SphDetailVarian,true), 
                //             "text"=> $row_item->SphDetailText,
                //             "group"=> $row_item->SphDetailGroup,
                //             "type"=> $row_item->SphDetailType,
                //             "ref"=>  $row_item->SphDetailQty,
                //             "qty"=>  $row_item->SphDetailQty,
                //             "hargajual"=>  $row_item->SphDetailPrice,
                //             "disc"=>  $row_item->SphDetailDisc,
                //             "harga"=>  $harga,
                //             "data"=>  $data_total, 
                //             "total"=>  $row_item->SphDetailQty * $harga,
                //         );
                //     } 
                // }
                $data[] = array(
                    "id" => $row['refid'],
                    "text" => $row['code'], 
                    "html" => $htmlItem,    
                    "type" => $row['type'],       
                    "detail_item" => $detail,   
                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }
}