<?php

namespace App\Controllers;  
use App\Models\StoreModel;
use App\Models\UserModel;
use App\Models\CustomerModel;
use App\Models\CustomercategoryModel;
use App\Models\ProjectModel;
use App\Models\ProdukunitModel;
use App\Models\ProdukcategoryModel;
use App\Models\ProdukvarianModel;
use App\Models\ProdukvarianvalueModel;
use App\Models\ProdukModel;
use App\Models\VendorModel;
use Config\Services; 

class ActionController extends BaseController
{  
   
    public function __construct()
    { 
        $this->helpers = ['form', 'url'];  
    }

    public function store_add(){   
        $request = Services::request();
        $models = new StoreModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->add_store($postData);
        }
        
    }  
    public function store_edit($id){   
        $request = Services::request();
        $models = new StoreModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->edit_store($postData,$id);
        }
        
    }  
    public function store_delete(){   
        $request = Services::request();
        $models = new StoreModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->delete_store($postData);
        }
        
    }  
 
    public function account_add(){
        $request = Services::request();
        $models = new UserModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->add_account($postData);
        }
    } 
    public function account_edit($id){
        $request = Services::request();
        $models = new UserModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->edit_account($postData,$id);
        }
    } 
    public function account_reset_password(){
        $request = Services::request();
        $models = new UserModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->reset_password_account($postData);
        }
    }

    public function customer_code(){
        $request = Services::request();
        $models = new CustomerModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->get_next_code($postData);
        }
    }
    public function customer_category_add(){
        $request = Services::request();
        $models = new CustomercategoryModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert($postData); 

            $models->selectMax('CustomerCategoryId');
            $query = $models->get()->getRow();
            echo json_encode(array("status"=>true,"data"=>$query));
        }
    }
    public function customer_add(){
        $request = Services::request();
        $models = new CustomerModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->add_customer($postData); 
        } 
    }
    public function customer_edit($id){
        $request = Services::request();
        $models = new CustomerModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->edit_customer($postData,$id); 
        }  
    } 
    public function customer_delete(){   
        $request = Services::request();
        $models = new CustomerModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->delete_customer($postData);
        }
        
    }  

    public function vendor_add(){
        $request = Services::request();
        $models = new VendorModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert($postData); 

            $models->selectMax('VendorId');
            $query = $models->get()->getRow();
            echo json_encode(array("status"=>true,"data"=>$query));
        }
    }
    public function vendor_edit($id){
        $request = Services::request();
        $models = new VendorModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->update($id, $postData); 

            $models->where('VendorId',$id);
            $query = $models->get()->getRow();
            echo json_encode(array("status"=>true,"data"=>$query));
        }
    }
    public function vendor_delete(){   
        $request = Services::request();
        $models = new VendorModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->delete_vendor($postData);
        } 
    }  
    

    public function project_tab(){ 
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->load_data_project_tab($postData);  
        } 
    }
    
    public function project($id){ 
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {    
            echo json_encode($models->load_data_project($id));  
        } 
    }
    
    public function project_add(){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->insert_data_project($postData); 
        }
    }
    
    public function project_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->update_data_project($postData,$id); 
        }
    }
    public function project_delete($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->delete_data_project($id);  
        }
    }

    public function sample_add(){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert_data_sample($postData); 
            echo json_encode(array("status"=>true));
        }
    }
    public function sample_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->update_data_sample($postData,$id); 
            echo json_encode(array("status"=>true));
        }
    }

    public function penawaran_add(){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert_data_penawaran($postData); 
            echo json_encode(array("status"=>true));
        }
    }
    public function penawaran_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->update_data_penawaran($postData,$id); 
            echo json_encode(array("status"=>true));
        }
    }
    public function penawaran_delete($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->delete_data_penawaran($id);  
        }
    }
    public function invoice_add(){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert_data_invoice($postData); 
            echo json_encode(array("status"=>true));
        }
    }
    public function invoice_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->update_data_invoice($postData,$id); 
            echo json_encode(array("status"=>true));
        }
    }
    public function invoice_delete($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->delete_data_invoice($id);  
        }
    }
    public function payment_delete($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->delete_data_payment($id);  
        }
    }
    public function payment_add(){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert_data_payment($postData); 
            echo json_encode(array("status"=>true));
        }
    }
    public function payment_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->update_data_payment($postData,$id); 
            echo json_encode(array("status"=>true));
        }
    }
    public function proforma_add(){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert_data_proforma($postData); 
            echo json_encode(array("status"=>true));
        }
    }
    public function proforma_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->update_data_proforma($postData,$id); 
            echo json_encode(array("status"=>true));
        }
    }

    public function delivery_add(){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert_data_delivery($postData); 
            echo json_encode(array("status"=>true));
        }
    }
    public function delivery_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->update_data_delivery($postData,$id); 
            echo json_encode(array("status"=>true));
        }
    }
    public function delivery_delete($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->delete_data_delivery($id);  
        }
    }
    public function delivery_proses($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->proses_data_delivery($postData,$id);  
        }
    }
    public function delivery_proses_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->edit_proses_data_delivery($postData,$id);  
        }
    }
    public function delivery_finish($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->finish_data_delivery($postData,$id);  
        }
    }
    public function delivery_finish_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->finish_data_delivery_edit($postData,$id);  
        }
    }
    public function pembelian_add(){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert_data_pembelian($postData); 
            echo json_encode(array("status"=>true));
        }
    }
    public function pembelian_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->update_data_pembelian($postData,$id); 
            echo json_encode(array("status"=>true));
        }
    }
    public function pembelian_delete($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            echo $models->delete_data_pembelian($id);  
        }
    }
    
    public function template_footer_add(){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $data = $models->insert_data_template_footer($postData); 
            echo json_encode(array("status"=>true,"data"=>$data));
        }
    }
    public function template_footer_edit($id){
        $request = Services::request();
        $models = new ProjectModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $data =  $models->update_data_template_footer($postData,$id); 
            echo json_encode(array("status"=>true,"data"=>$data));
        }
    }
    
    public function produk_category_add(){
        $request = Services::request();
        $models = new ProdukcategoryModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert($postData); 

            $models->selectMax('id');
            $query = $models->get()->getRow();
            echo json_encode(array("status"=>true,"data"=>$query));
        }
    }
    public function produk_varian_add(){
        $request = Services::request();
        $models = new ProdukvarianModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert($postData); 

            $models->select('*');
            $models->orderBy('id', 'DESC'); 
            $models->limit(1);
            $query = $models->get()->getRow();
            echo json_encode(array("status"=>true,"data"=>$query));
        }
    }
    public function produk_varian_value_add(){
        $request = Services::request();
        $models = new ProdukvarianvalueModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert($postData); 

            $models->select('*');
            $models->orderBy('id', 'DESC'); 
            $models->limit(1);
            $query = $models->get()->getRow();
            echo json_encode(array("status"=>true,"data"=>$query));
        }
    }
    public function produk_add(){
        $request = Services::request();
        $models = new ProdukModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->add_produk($postData); 
        }
    }
    public function produk_delete($id){
        $request = Services::request();
        $models = new ProdukModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $models->delete_produk($id); 
            echo json_encode(array("status"=>true));
        }
    }


    public function item_unit_add(){ 
        $request = Services::request();
        $models = new ProdukunitModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost(); 
            $models->insert($postData); 

            $models->selectMax('id');
            $query = $models->get()->getRow();
            echo json_encode(array("status"=>true,"data"=>$query));
        }
    }
    public function item_unit_get($id){ 
        $request = Services::request();
        $models = new ProdukModel(); 
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost("varian"); 
 
            $data = $models->getDetailProduk($postData,$id);  
            echo json_encode(array("status"=>true,"data"=>$data));
        }
    }
    public function produk_edit($id){
        $request = Services::request();
        $models = new ProdukModel(); 
        if ($request->getMethod(true) === 'POST') {  
            $postData = $request->getPost(); 
            echo $models->edit_produk($postData,$id); 
        }
    }
    
}
