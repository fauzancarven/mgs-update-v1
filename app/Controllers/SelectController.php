<?php

namespace App\Controllers; 
use App\Models\CustomerModel;
use App\Models\CustomercategoryModel;
use App\Models\ProvinceModel;
use App\Models\StoreModel;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Models\SampleModel;
use App\Models\ProjectcategoryModel;
use App\Models\SphModel;
use App\Models\InvoiceModel;
use App\Models\PembelianModel;
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
    
    public function project()
    {   
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array();
       
      
            if(!isset($postData['searchTerm'])){
                 // Fetch record 
                $models = new ProjectModel();
                $projectlist = $models->select("*")
                    ->join("customer","customer.CustomerId = project.CustomerId ","left")
                    ->join("store","store.StoreId = project.StoreId","left")
                    ->orderBy('ProjectDate',"DESC")
                    ->findAll();
            }else{
                $searchTerm = $postData['searchTerm'];
    
                // Fetch record
                $models = new ProjectModel();
                $projectlist = $models->select("*")
                    ->join("customer","customer.CustomerId = project.CustomerId ","left")
                    ->join("store","store.StoreId = project.StoreId","left")
                    ->like('ProjectName',$searchTerm)
                    ->orLike('ProjectCategory',$searchTerm)
                    ->orLike('ProjectComment',$searchTerm)
                    ->orLike('CustomerCode',$searchTerm)
                    ->orLike('CustomerName',$searchTerm)
                    ->orLike('CustomerCompany',$searchTerm)
                    ->orLike('CustomerTelp1',$searchTerm)
                    ->orLike('CustomerTelp2',$searchTerm)
                    ->orLike('CustomerAddress',$searchTerm)
                    ->orderBy('ProjectDate',"DESC")
                    ->findAll();
            } 
      
            $data = array(); 
            $data[] = array(
                "id" => 0,
                "text" => "Tidak ada yang dipilih",
                "html" => "Tidak ada yang dipilih",  
            );

            foreach($projectlist as $project){
                $customername = $project['CustomerCode'] . " - " . ($project['CustomerCompany']== "" ? $project['CustomerName'] : $project['CustomerName'] . ' (' . $project['CustomerCompany'] . ')');
                $customertelp = (($project['CustomerTelp2'] == "" || $project['CustomerTelp2'] == "-") ? $project['CustomerTelp1'] : $project['CustomerTelp1'] . " / " . $project['CustomerTelp2']);

                $category = "";
                foreach (explode("|",$project['ProjectCategory']) as $index=>$x) {
                    $category .= '<span class="badge badge-'.fmod($index, 5).' me-1">'.$x.'</span>';
                }  

                $htmlItem = '  <div class="d-flex flex-column" >
                                    <div class="d-flex align-items-center gap-1" style="font-size:0.75rem">  
                                        <img src="'.$project['StoreLogo'].'" alt="Gambar" class="logo" width="18" height="18"> 
                                        <span class="fw-bold align-items-center">'.$project['StoreCode'].' - '.$project['StoreName'].'</span>
                                        <span class="text-wrap overflow-x-auto">'.$category.'</span>     
                                    </div> 
                                    <span style="font-size:0.75rem" class="fw-bold">' . $project['ProjectName'] . '</span>
                                    <span style="font-size:0.6rem">Catatan : ' . $project['ProjectComment'] . '</span>
                                    <span style="font-size:0.6rem" class="fw-bold">' . $customername . '</span>
                                    <span style="font-size:0.6rem">' . $customertelp . '</span>
                                    <span style="font-size:0.6rem">' .  $project['CustomerAddress'] . '</span>
                                    <span style="font-size:0.6rem">Note : ' .  $project['CustomerComment'] . '</span>
                                </div>';
                $data[] = array(
                    "id" => $project['ProjectId'],
                    "text" => $project['StoreCode'] . " | " . $project['ProjectName'] ." | " . $customername,
                    "html" => $htmlItem,  
                    "storeid" => $project['StoreId'],
                    "store" => $project['StoreCode'] .  " - " . $project['StoreName'],
                    "customerid" => $project['CustomerId'],
                    "customer" => $customername,
                    "customername" => $project['ProjectCustName'],
                    "customertelp" => $project['ProjectCustTelp'],
                    "customeraddress" => $project['ProjectCustAddress'],
                );
            }
      
            $response['data'] = $data;
      
            return $this->response->setJSON($response);
        }
        
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
                    ->orLike('CustomerCode',$searchTerm)
                    ->orLike('CustomerName',$searchTerm)
                    ->orLike('CustomerCompany',$searchTerm)
                    ->orLike('CustomerTelp1',$searchTerm)
                    ->orLike('CustomerTelp2',$searchTerm)
                    ->orLike('CustomerAddress',$searchTerm)
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
                    "text" => $customername,
                    "html" => $htmlItem,  
                    "customername" =>($customer['CustomerCompany']== "" ? $customer['CustomerName'] : $customer['CustomerName'] . ' (' . $customer['CustomerCompany'] . ')'),
                    "customertelp" => $customertelp,
                    "customeraddress" => $customer['CustomerAddress'],
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
            $models = new ProjectModel();
            $Project = $models->get_data_ref_invoice($id,$postData);
 
            $data = array();
            $data[] = array(
                "id" => 0,
                "text" => "-", 
                "html" => '<span style="font-size:0.75rem" class="fw-bold">Tidak ada yang dipilih</span>', 
                "vendor" => $modelsvendor->get()->getResult(),   
                "detail_item" => [],      
                "type" => "-",  
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
                if($row['type'] == "Penawaran"){
                    $detail_item =  $models->get_data_sph_detail($row['refid']); 
                    $vendor_array = array(); 
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
                            "id" => $row_item->ProdukId,  
                            "produkid" => $row_item->ProdukId, 
                            "satuan_id"=> ($row_item->SphDetailSatuanId == 0 ? "" : $row_item->SphDetailSatuanId),
                            "satuan_text"=>$row_item->SphDetailSatuanText,  
                            "varian"=> JSON_DECODE($row_item->SphDetailVarian,true),
                            "text"=> $row_item->SphDetailText,
                            "group"=> $row_item->SphDetailGroup,
                            "type"=> $row_item->SphDetailType,
                            "image_url"=> $modelsitem->getproductimagedatavarian(  $row_item->ProdukId,$row_item->SphDetailVarian,true),
                            "priceref"=>$row_item->SphDetailPrice,  
                            "totalref"=> $row_item->SphDetailTotal,
                            "discref"=> $row_item->SphDetailDisc,
                            "price"=> $harga, 
                            "total"=>  $harga * $row_item->SphDetailQty,
                            "disc"=> 0,
                            "qty"=> $row_item->SphDetailQty
                        );
                        
                    } 
                }
                if($row['type'] == "Invoice"){
                    $detail_item =  $models->get_data_invoice_detail($row['refid']); 
                    $vendor_array = array(); 
                    foreach($detail_item as $row_item){ 
                        $varian =  json_decode($row_item->InvDetailVarian, true);  
                        foreach ($varian as $v) {  
                            $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("VendorCode",$v['value'])->get()->getRow()));
                            if ( !in_array($data_arr, $vendor_array)) {
                                $vendor_array[] = $data_arr;
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
                            "text"=> $row_item->InvDetailText,
                            "group"=> $row_item->InvDetailGroup,
                            "type"=> $row_item->InvDetailType,
                            "image_url"=> $modelsitem->getproductimagedatavarian(  $row_item->ProdukId,$row_item->InvDetailVarian,true),  
                            "varian"=> JSON_DECODE($row_item->InvDetailVarian,true),
                            "priceref"=> $row_item->InvDetailPrice, 
                            "totalref"=> $row_item->InvDetailQtyTotal,
                            "discref"=> $row_item->InvDetailDisc, 
                            "price"=> $harga, 
                            "disc"=> 0,
                            "total"=>$harga * $row_item->InvDetailQty,
                            "qty"=> $row_item->InvDetailQty
                        );
                        
                    } 
                }

                // if($row['type'] == "INV"){
                //     $detail_item =   $models->get_data_invoice_detail($row['refid']); 
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
                //             "price"=> $InvDetailPrice, 
                //             "buy"=> $harga, 
                //             "varian"=> JSON_DECODE($row_item->InvDetailVarian,true),
                //             "total"=> $row_item->InvDetailQtyTotal,
                //             "disc"=> $row_item->InvDetailDisc,
                //             "qty"=> $row_item->InvDetailQty,
                //             "text"=> $row_item->InvDetailText,
                //             "group"=> $row_item->InvDetailGroup,
                //             "type"=> $row_item->InvDetailType,
                //             "image_url"=> $modelsitem->getproductimagedatavarian(  $row_item->ProdukId,$row_item->InvDetailVarian,true)
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
                //             "price"=>$row_item->SphDetailPrice,
                //             "buy"=>$harga,
                //             "varian"=> JSON_DECODE($row_item->SphDetailVarian,true),
                //             "total"=> $row_item->SphDetailTotal,
                //             "disc"=> $row_item->SphDetailDisc,
                //             "qty"=> $row_item->SphDetailQty,
                //             "text"=> $row_item->SphDetailText,
                //             "group"=> $row_item->SphDetailGroup,
                //             "type"=> $row_item->SphDetailType,
                //             "image_url"=> $modelsitem->getproductimagedatavarian(  $row_item->ProdukId,$row_item->SphDetailVarian,true) 
                //         );
                //     } 
                // }
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
            $models = new ProjectModel();
            $Project = $models->get_data_ref_invoice($id,$postData);
             
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
                if($row['type'] == "Penawaran"){
                    $detail_item =  $models->get_data_sph_detail($row['refid']); 
                    $vendor_array = array(); 
                    foreach($detail_item as $row_item){ 
                        $varian =  json_decode($row_item->SphDetailVarian, true);  
                        foreach ($varian as $v) {  
                            $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("VendorCode",$v['value'])->get()->getRow()));
                            if ( !in_array($data_arr, $vendor_array)) {
                                $vendor_array[] = $data_arr;
                            } 
                        }   
                        $detail[] = array(  
                            "id" => $row_item->ProdukId,  
                            "produkid" => $row_item->ProdukId, 
                            "satuan_id"=> ($row_item->SphDetailSatuanId == 0 ? "" : $row_item->SphDetailSatuanId),
                            "satuan_text"=>$row_item->SphDetailSatuanText,  
                            "price"=>$row_item->SphDetailPrice,
                            "varian"=> JSON_DECODE($row_item->SphDetailVarian,true),
                            "total"=> $row_item->SphDetailTotal,
                            "disc"=> $row_item->SphDetailDisc,
                            "qty"=> $row_item->SphDetailQty,
                            "text"=> $row_item->SphDetailText,
                            "group"=> $row_item->SphDetailGroup,
                            "type"=> $row_item->SphDetailType,
                            "image_url"=> $modelsitem->getproductimagedatavarian(  $row_item->ProdukId,$row_item->SphDetailVarian,true)
                        );
                        
                    } 
                }
                $data[] = array(
                    "id" => $row['refid'],
                    "text" => $row['code'], 
                    "html" => $htmlItem,         
                    "detail_item" => $detail,     
                    "type" => $row['type'],   
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
            $models = new ProjectModel();
            $modelssample = new SampleModel();
            $Project = $modelssample->get_list_ref_sample($id,$postData);
            
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
                //     $detail_item =   $models->get_data_invoice_detail($row['refid']); 
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
    public function ref_project_sph($id){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array();  

            $modelsitem = new ProdukModel();   
            $models = new ProjectModel();
            $Project = $models->get_data_ref_sph($id,$postData); 

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
                //     $detail_item =   $models->get_data_invoice_detail($row['refid']); 
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
    public function ref_sph(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array();  

            $modelsitem = new ProdukModel();   
            $models = new SphModel();
            $Project = $models->get_data_sph_ref(null,$postData); 

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
    public function ref_invoice(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array();  

            $modelsitem = new ProdukModel(); 
            $modelsvendor = new VendorModel();
            $models = new InvoiceModel();
            $Project = $models->get_data_ref_invoice(null,$postData);
             
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
                // if($row['type'] == "Penawaran"){
                //     $detail_item =  $models->get_data_sph_detail($row['refid']); 
                //     $vendor_array = array(); 
                //     foreach($detail_item as $row_item){ 
                //         $varian =  json_decode($row_item->SphDetailVarian, true);  
                //         foreach ($varian as $v) {  
                //             $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("VendorCode",$v['value'])->get()->getRow()));
                //             if ( !in_array($data_arr, $vendor_array)) {
                //                 $vendor_array[] = $data_arr;
                //             } 
                //         }   
                //         $detail[] = array(  
                //             "id" => $row_item->ProdukId,  
                //             "produkid" => $row_item->ProdukId, 
                //             "satuan_id"=> ($row_item->SphDetailSatuanId == 0 ? "" : $row_item->SphDetailSatuanId),
                //             "satuan_text"=>$row_item->SphDetailSatuanText,  
                //             "price"=>$row_item->SphDetailPrice,
                //             "varian"=> JSON_DECODE($row_item->SphDetailVarian,true),
                //             "total"=> $row_item->SphDetailTotal,
                //             "disc"=> $row_item->SphDetailDisc,
                //             "qty"=> $row_item->SphDetailQty,
                //             "text"=> $row_item->SphDetailText,
                //             "group"=> $row_item->SphDetailGroup,
                //             "type"=> $row_item->SphDetailType,
                //             "image_url"=> $modelsitem->getproductimagedatavarian(  $row_item->ProdukId,$row_item->SphDetailVarian,true)
                //         );
                        
                //     } 
                // }
                $data[] = array(
                    "id" => $row['refid'],
                    "text" => $row['code'], 
                    "html" => $htmlItem,         
                    "detail_item" => $detail,     
                    "type" => $row['type'],   
                );
            }
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }
    public function ref_po(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $response = array(); 

            $modelscustomer = new CustomerModel();
            $modelsvendor = new VendorModel();
            $modelsitem = new ProdukModel(); 
            $models = new PembelianModel();
            $Project = $models->get_data_ref_pembelian(null,$postData);
 
            $data = array();
            $data[] = array(
                "id" => 0,
                "text" => "-", 
                "html" => '<span style="font-size:0.75rem" class="fw-bold">Tidak ada yang dipilih</span>', 
                "vendor" => $modelsvendor->get()->getResult(),   
                "detail_item" => [],    
                "customer" => array(
                    "CustomerId" => "",
                    "CustomerSelect" => "",
                    "CustomerName" => "",
                    "CustomerTelp" => "", 
                    "CustomerAddress" => "",
                ),     
                "store" => array( 
                    "StoreId"=> "",
                    "StoreName"=> "",
                    "StoreCode"=> "",
                ),
                "type" => "-",  
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
                if($row['type'] == "Invoice"){
                    
                    $modelsinvoice = new InvoiceModel();
                    $detail_item =  $modelsinvoice->get_data_invoice_detail($row['refid']); 
                    $vendor_array = array(); 
                    foreach($detail_item as $row_item){ 
                        $varian =  json_decode($row_item->InvDetailVarian, true);  
                        foreach ($varian as $v) {  
                            $data_arr =  ($v['value'] == "" ? []: ($modelsvendor->where("VendorCode",$v['value'])->get()->getRow()));
                            if ( !in_array($data_arr, $vendor_array)) {
                                $vendor_array[] = $data_arr;
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
                            "text"=> $row_item->InvDetailText,
                            "group"=> $row_item->InvDetailGroup,
                            "type"=> $row_item->InvDetailType,
                            "image_url"=> $modelsitem->getproductimagedatavarian(  $row_item->ProdukId,$row_item->InvDetailVarian,true),  
                            "varian"=> JSON_DECODE($row_item->InvDetailVarian,true),
                            "priceref"=> $row_item->InvDetailPrice, 
                            "totalref"=> $row_item->InvDetailTotal,
                            "discref"=> $row_item->InvDetailDisc, 
                            "price"=> $harga, 
                            "disc"=> 0,
                            "total"=>$harga * $row_item->InvDetailQty,
                            "qty"=> $row_item->InvDetailQty
                        );
                        
                    } 
                }
 
                $data[] = array(
                    "id" => $row['refid'],
                    "text" => $row['code'], 
                    "html" => $htmlItem,     
                    "type" => $row['type'],   
                    "customer" => array( 
                        "CustomerSelect" => $modelscustomer->get_customer_name($row['CustomerId']),
                        "CustomerId" => $row['CustomerId'],
                        "CustomerName" => $row['CustomerName'],
                        "CustomerTelp" => $row['CustomerTelp'], 
                        "CustomerAddress" => $row['CustomerAddress'],    
                    ),   
                    "store" => array( 
                        "StoreId"=> $row['StoreId'],
                        "StoreName"=> $row['StoreName'],
                        "StoreCode"=>$row['StoreCode'],
                    ),
                    "vendor" => $vendor_array,   
                    "detail_item" => $detail,   
                );
            } 
            $response['data'] = $data; 
            return $this->response->setJSON($response); 
        }
    }
}