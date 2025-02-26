<?php

namespace App\Controllers;

use App\Models\StoreModel;
use App\Models\UserModel;
use App\Models\CustomerModel;
use App\Models\ProvinceModel;
use App\Models\VendorModel;
use App\Models\ProdukModel;
use App\Models\ProjectModel;
use Myth\Auth\Entities\User; 

use Config\Services; 
class MessageController extends BaseController
{
    public function index(): string
    { 
    }
    public function store_add()
    { 
        return $this->response->setBody(view('admin/store/add.php')); 
    }
    public function store_edit($id)
    { 
        $models = new StoreModel();
        $data["store"] = $models->getWhere(['StoreId' => $id])->getRow();
        return $this->response->setBody(view('admin/store/edit.php',$data)); 
    }
    public function account_add()
    {  
        $models = new UserModel();
        $source = "assets/images/profile/default.png";
        $quality = 75;
        $base64 = $models->compressImageToBase64($source, $quality); 

        $data["_image"] = $base64;
        return $this->response->setBody(view('admin/account/add.php',$data)); 
    }
    public function account_edit($id)
    { 
        $models = new UserModel();
        $account = $models->getWhere(['id' => $id], 1)->getRow(); 
        
        $source = "assets/images/profile/user/".$account->code.".png";
        $quality = 75;
        $base64 = $models->compressImageToBase64($source, $quality);  
        $data["_image"] = $base64; 
        $data["_account"] = $account; 
        return $this->response->setBody(view('admin/account/edit.php',$data)); 
    }
    public function account_reset($id)
    { 
        $models = new UserModel();
        $account = $models->getWhere(['id' => $id], 1)->getRow();  
        $data["_account"] = $account; 
        return $this->response->setBody(view('admin/account/reset.php',$data)); 
    }
 
    public function customer_add()
    {   
        return $this->response->setBody(view('admin/customer/add.php')); 
    }
    public function customer_edit($id)
    {   
        $models = new CustomerModel();
        $account = $models
        ->select("*")
        ->join("customercategory","customercategory.CustomerCategoryId=customer.CustomerCategoryId")
        ->getWhere(['CustomerId' => $id], 1)->getRow();  
        
        $models = new ProvinceModel();  
        $village = $models->get_village_by_id($account->CustomerVillageId);  
        $data["_customer"] = $account; 
        $data["_province"] = $village;  

        return $this->response->setBody(view('admin/customer/edit.php',$data)); 
    } 
    public function produk_add()
    {   
        return $this->response->setBody(view('admin/produk/add.php')); 
    }
    public function produk_edit($id)
    {   
        $models = new ProdukModel();  
        $data["_produk"] = $models 
            ->join("produk_category","produk_category.ProdukCategoryId = produk.ProdukCategoryId")
            ->getWhere(['ProdukId' => $id], 1)->getRow(); 
        $data["_produkdetail"] = $models->getproductdetail($data["_produk"]->ProdukId); 
        $data["_produkimage"] = $models->getproductimageAll($data["_produk"]->ProdukId); 

        return $this->response->setBody(view('admin/produk/edit.php',$data)); 
    }
    public function produk_select()
    {   
        return $this->response->setBody(view('admin/produk/select.php')); 
    }


    public function vendor_add()
    {   
        return $this->response->setBody(view('admin/vendor/add.php')); 
    }
    public function vendor_edit($id)
    { 
        $models = new VendorModel(); 
        $data["_vendor"] = $models->getWhere(['VendorId' => $id], 1)->getRow();     
        return $this->response->setBody(view('admin/vendor/edit.php',$data)); 
    }


    
    public function project_add()
    {    
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/add_project.php',$data)); 
    }
    public function project_edit($id)
    {    
        $models = new ProjectModel();
        $models->join("customer","customer.CustomerId=project.CustomerId");
        $models->join("users","users.id=project.UserId");
        $models->join("store","store.StoreId=project.StoreId");
        $data["project"] = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        return $this->response->setBody(view('admin/project/edit_project.php',$data)); 
    }

    public function project_sample_add($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $project = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $data["customer"] =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->StoreId], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/sample/add_project_sample.php',$data)); 
    }
    public function project_sample_edit($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $project = $models->getdataSample($id); 
        $arr_detail = $models->getdataDetailSample($id);
        $detail = array();
        foreach($arr_detail as $row){
            $detail[] = array(
                        "id" => $row->ProdukId, 
                        "produkid" => $row->ProdukId, 
                        "satuan_id"=> ($row->SampleDetailSatuanId == 0 ? "" : $row->SampleDetailSatuanId),
                        "satuan_text"=>$row->SampleDetailSatuanText,  
                        "price"=>$row->SampleDetailPrice,
                        "varian"=> JSON_DECODE($row->SampleDetailVarian,true),
                        "total"=> $row->SampleDetailTotal,
                        "disc"=> $row->SampleDetailDisc,
                        "qty"=> $row->SampleDetailQty,
                        "text"=> $row->SampleDetailText,
                        "group"=> $row->SampleDetailGroup,
                        "type"=> $row->SampleDetailType
                    );
        };
        $data["project"] = $project; 
        $data["detail"] =  $detail;
        $data["template"] =$models->get_data_template_footer($project->TemplateId); 
        $data["customer"] =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow(); 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/sample/edit_project_sample.php',$data)); 
    }

    public function project_sph_add($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        $request = Services::request();
        $postData = $request->getPost(); 

        if(!isset($postData['SampleId']) ){
            $data["ref_header"] = null;
            $data["ref_detail"] = []; 
        }else{
            if($postData['SampleId'] == 0) {  
                $data["ref_header"] = null;
                $data["ref_detail"] = []; 
            }else{
                $data["ref_header"] = $models->getdataSample($postData['SampleId']); 
                $arr_detail = $models->getdataDetailSample($postData['SampleId']);
                $detail = array();
                foreach($arr_detail as $row){
                    $detail[] = array(
                                "id" => $row->ProdukId, 
                                "produkid" => $row->ProdukId, 
                                "satuan_id"=> ($row->SampleDetailSatuanId == 0 ? "" : $row->SampleDetailSatuanId),
                                "satuan_text"=>$row->SampleDetailSatuanText,  
                                "price"=>$row->SampleDetailPrice,
                                "varian"=> JSON_DECODE($row->SampleDetailVarian,true),
                                "total"=> $row->SampleDetailTotal,
                                "disc"=> $row->SampleDetailDisc,
                                "qty"=> $row->SampleDetailQty,
                                "text"=> $row->SampleDetailText,
                                "group"=> $row->SampleDetailGroup,
                                "type"=> $row->SampleDetailType
                            );
                };
                $data["ref_detail"] = $detail;
            }
        }
        $project = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $data["customer"] =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->StoreId], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/sph/add_project_sph.php',$data)); 
    }
    public function project_sph_edit($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $project = $models->getdataSPH($id); 
        $arr_detail = $models->getdataDetailSPH($id);
        $detail = array();
        foreach($arr_detail as $row){
            $detail[] = array(
                        "id" => $row->ProdukId, 
                        "produkid" => $row->ProdukId, 
                        "satuan_id"=> ($row->SphDetailSatuanId == 0 ? "" : $row->SphDetailSatuanId),
                        "satuan_text"=>$row->SphDetailSatuanText,  
                        "price"=>$row->SphDetailPrice,
                        "varian"=> JSON_DECODE($row->SphDetailVarian,true),
                        "total"=> $row->SphDetailTotal,
                        "disc"=> $row->SphDetailDisc,
                        "qty"=> $row->SphDetailQty,
                        "text"=> $row->SphDetailText,
                        "group"=> $row->SphDetailGroup,
                        "type"=> $row->SphDetailType
                    );
        };
        $data["project"] = $project; 
        $data["detail"] =  $detail;
        $data["sample"] = $models->getdataSample($project->SampleId); 
        $data["customer"] =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow(); 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/sph/edit_project_sph.php',$data)); 
    }
    
    public function project_po_add($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        $modelsvendor = new VendorModel();

        $project = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $data["customer"] =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->StoreId], 1)->getRow();
        $data["vendor"] = $modelsvendor->get()->getResult();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/po/add_project_po.php',$data)); 
    }
    public function project_po_edit($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        $modelsvendor = new VendorModel();

        $project = $models->getdataPO($id); 
        $arr_detail = $models->getdataDetailSPH($id);
        $detail = array();
        $ref = JSON_DECODE($project->PORef2,true);
        if($ref["type"] == "SPH"){
            $reference = $ref["code"];
        }else{
            $reference = "";
        }
        foreach($arr_detail as $row){
            $detail[] = array(
                        "id" => $row->ProdukId, 
                        "produkid" => $row->ProdukId, 
                        "satuan_id"=> ($row->PODetailSatuanId == 0 ? "" : $row->PODetailSatuanId),
                        "satuan_text"=>$row->PODetailSatuanText,  
                        "varian"=> JSON_DECODE($row->PODetailVarian,true),
                        "group"=> $row->PODetailGroup,
                        "text"=> $row->PODetailText,
                        "harga"=>$row->PODetailPrice,
                        "total"=> $row->PODetailTotal, 
                        "ref"=> $row->PODetailQty, 
                        "qty"=> $row->PODetailQty
                    );
        }; 
        $data["project"] = $project; 
        $data["detail"] =  $detail;
        $data["reference"] =  $reference;
        $data["customer"] =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["template"] =$models->get_data_template_footer($project->TemplateId);  
        $data["vendor"] = $modelsvendor->get()->getResult();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/po/edit_project_po',$data)); 
    }

    public function project_invoice_add($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel(); 
        $request = Services::request();
        $postData = $request->getPost(); 
        if(!isset($postData['id']) ){
             $data["ref_header"] = array(
                "code"=> "",
                "id"=> "",
                "SphId"=> "",
                "SampleId"=> "",
            );
            $data["ref_detail"] = []; 
            $data["ref_type"] = null;
        }else{
            if($postData['id'] == 0) {  
                $data["ref_header"] = array(
                    "code"=> "",
                    "id"=> "",
                    "SphId"=> "",
                    "SampleId"=> "",
                );
                $data["ref_detail"] = []; 
                $data["ref_type"] = null;
            }else{
                if($postData['type'] == "penawaran") {  
                    $datasample = $models->getdataSPH($postData['id']); 
                    $data["ref_header"] = array(
                        "code"=> $datasample->SphCode,
                        "id"=> $datasample->SphId,
                        "SphId"=> $datasample->SphId,
                        "SampleId"=> "",
                    );
                    $arr_detail = $models->getdataDetailSPH($postData['id']);
                    $detail = array();
                    foreach($arr_detail as $row){
                        $detail[] = array(
                                    "id" => $row->ProdukId, 
                                    "produkid" => $row->ProdukId, 
                                    "satuan_id"=> ($row->SphDetailSatuanId == 0 ? "" : $row->SphDetailSatuanId),
                                    "satuan_text"=>$row->SphDetailSatuanText,  
                                    "price"=>$row->SphDetailPrice,
                                    "varian"=> JSON_DECODE($row->SphDetailVarian,true),
                                    "total"=> $row->SphDetailTotal,
                                    "disc"=> $row->SphDetailDisc,
                                    "qty"=> $row->SphDetailQty,
                                    "text"=> $row->SphDetailText,
                                    "group"=> $row->SphDetailGroup,
                                    "type"=> $row->SphDetailType
                                );
                    };
                    $data["ref_detail"] = $detail;
                    $data["ref_type"] = "penawaran";
                }else{  
                    $datasample = $models->getdataSample($postData['id']); 
                    $data["ref_header"] = array(
                        "code"=> $datasample->SampleCode,
                        "id"=> $datasample->SampleId,
                        "SphId"=> "",
                        "SampleId"=> $datasample->SampleId,
                    );
                    $arr_detail = $models->getdataDetailSample($postData['id']);
                    $detail = array();
                    foreach($arr_detail as $row){
                        $detail[] = array(
                                    "id" => $row->ProdukId, 
                                    "produkid" => $row->ProdukId, 
                                    "satuan_id"=> ($row->SampleDetailSatuanId == 0 ? "" : $row->SampleDetailSatuanId),
                                    "satuan_text"=>$row->SampleDetailSatuanText,  
                                    "price"=>$row->SampleDetailPrice,
                                    "varian"=> JSON_DECODE($row->SampleDetailVarian,true),
                                    "total"=> $row->SampleDetailTotal,
                                    "disc"=> $row->SampleDetailDisc,
                                    "qty"=> $row->SampleDetailQty,
                                    "text"=> $row->SampleDetailText,
                                    "group"=> $row->SampleDetailGroup,
                                    "type"=> $row->SampleDetailType
                                );
                    };
                    $data["ref_detail"] = $detail;
                    $data["ref_type"] = "sample";
                }
            }
        }
        $project = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $data["customer"] =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->StoreId], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/invoice/add_project_invoice.php',$data)); 

    }
    public function project_invoice_edit($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $project = $models->getdataInvoice($id); 
        $arr_detail = $models->getdataDetailInvoice($id);
        $detail = array();
        foreach($arr_detail as $row){
            $detail[] = array(
                        "id" => $row->ProdukId, 
                        "produkid" => $row->ProdukId, 
                        "satuan_id"=> ($row->InvDetailSatuanId == 0 ? "" : $row->InvDetailSatuanId),
                        "satuan_text"=>$row->InvDetailSatuanText,  
                        "price"=>$row->InvDetailPrice,
                        "varian"=> JSON_DECODE($row->InvDetailVarian,true),
                        "total"=> $row->InvDetailTotal,
                        "disc"=> $row->InvDetailDisc,
                        "qty"=> $row->InvDetailQty,
                        "text"=> $row->InvDetailText,
                        "group"=> $row->InvDetailGroup,
                        "type"=> $row->InvDetailType
                    );
        };
        $data["project"] = $project; 
        if($project->SampleId > 0){
            $sample = $models->getdataSample($project->SampleId); 
            $data["ref"] = $sample->SampleCode;
        }else if($project->SphId > 0){ 
            $sph = $models->getdataSPH($project->SphId); 
            $data["ref"] = $sph->SphCode; 
        }else{ 
            $data["ref"] = "-"; 
        }
        $data["detail"] =  $detail;
        $data["template"] = $models->get_data_template_footer($project->TemplateId); 
        $data["customer"] =$modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->StoreId], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/invoice/edit_project_invoice.php',$data)); 
    }
    public function project_payment_add($id)
    {      
        $models = new ProjectModel();  

        $request = Services::request();
        $postData = $request->getPost(); 
        if($postData['type'] == "sample"){
            $datasample = $models->getdataSample($id); 
            $project = array(
                "ProjectId"=>$datasample->ProjectId,
                "SampleId"=>$datasample->SampleId,
                "InvId"=>"",
                "GrandTotal"=>$datasample->SampleGrandTotal,
                "menu"=>"sample",
            );
            $data["payment"] = $models->getdataPaymentBySample($id);  
        }
        if($postData['type'] == "invoice"){
            $datainvoice = $models->getdataInvoice($id); 
            $project = array(
                "ProjectId"=>$datainvoice->ProjectId,
                "SampleId"=>"",
                "InvId"=>$datainvoice->InvId,
                "GrandTotal"=>$datainvoice->InvGrandTotal,
                "menu"=>"invoice",
            );
            $data["payment"] = $models->getdataPaymentByInvoice($id);  
        }
         
        $data["project"] = $project; 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/payment/add_payment.php',$data)); 
    }
    public function project_payment_edit($id)
    {     
        $models = new ProjectModel();      
        $data["payment"] = $models->getdataPayment($id);  
        if($data['payment']->SampleId > 0){
            $datasample = $models->getdataSample($data['payment']->SampleId); 
            $project = array(
                "ProjectId"=>$datasample->ProjectId,
                "SampleId"=>$datasample->SampleId,
                "InvId"=>"",
                "GrandTotal"=>$datasample->SampleGrandTotal,
                "menu"=>"sample",
            );
            $data["payments"] = $models->getdataPaymentBySample($data['payment']->SampleId);  
        }
        if($data['payment']->InvId > 0){
            $datainvoice = $models->getdataInvoice($data['payment']->InvId); 
            $project = array(
                "ProjectId"=>$datainvoice->ProjectId,
                "SampleId"=>"",
                "InvId"=>$datainvoice->InvId,
                "GrandTotal"=>$datainvoice->InvGrandTotal,
                "menu"=>"invoice",
            );
            $data["payments"] = $models->getdataPaymentByInvoice($data['payment']->InvId);  
        } 
        
        $data["project"] = $project; 
        $data["template"] = $models->get_data_template_footer($data["payment"]->TemplateId); 
        $data["image"] = $models->getdataImagePayment($data["payment"]->ProjectId,$data["payment"]->InvId,$data["payment"]->SampleId,$id);    
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/payment/edit_payment.php',$data)); 
    }
    public function project_proforma_add($id)
    {     
        $models = new ProjectModel();  
        $project = $models->getdataInvoice($id);  
        $data["project"] = $project; 
        $data["payment"] = $models->getdataProformaByRef($id);  
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/invoice/add_project_proforma.php',$data)); 
    }
    public function project_proforma_edit($id)
    {     
        $models = new ProjectModel();      
        $data["payment"] = $models->getdataProforma($id);  
        $data["template"] = $models->get_data_template_footer($data["payment"]->TemplateId); 
        $data["project"] = $models->getdataInvoice($data["payment"]->InvId);      
        $data["payments"] = $models->getdataProformaByRef($data["payment"]->InvId);   
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/invoice/edit_project_proforma.php',$data)); 
    }
    public function project_delivery_add($id)
    {      
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        
        $request = Services::request();
        $postData = $request->getPost(); 
        $detail = array();
        if($postData['type'] == "sample"){ 
            $datasample = $models->getdataSample($id);  
            $project = array(
                "code"=>$datasample->SampleCode,
                "project_id"=>$datasample->ProjectId,
                "SampleId"=>$datasample->SampleId, 
                "InvId"=>"", 
                "menu"=>"sample",
                "CustomerName"=>$datasample->CustomerName,
                "CustomerTelp"=>$datasample->CustomerTelp1,
                "CustomerAddress"=>$datasample->CustomerAddress,
                "StoreId"=>$datasample->StoreId
            );
            $arr_detail = $models->getdataDetailSample($id);
            foreach($arr_detail as $row){
                $detail[] = array( 
                            "id" => $row->ProdukId, 
                            "produkid" => $row->ProdukId, 
                            "satuan_id"=> ($row->SampleDetailSatuanId == 0 ? "" : $row->SampleDetailSatuanId),
                            "satuan_text"=>$row->SampleDetailSatuanText,  
                            "price"=>$row->SampleDetailPrice,
                            "varian"=> JSON_DECODE($row->SampleDetailVarian,true),
                            "total"=> $row->SampleDetailTotal,
                            "disc"=> $row->SampleDetailDisc,
                            "qty_ref"=> $row->SampleDetailQty,
                            "qty_success"=>$models->getQtyDeliveryBySample($id,$row->ProdukId,$row->SampleDetailVarian,$row->SampleDetailText), 
                            "qty"=> $row->SampleDetailQty - $models->getQtyDeliveryBySample($id,$row->ProdukId,$row->SampleDetailVarian,$row->SampleDetailText),
                            "qty_spare"=> 0,
                            "text"=> $row->SampleDetailText,
                            "group"=> $row->SampleDetailGroup,
                            "type"=> $row->SampleDetailType 
                        );
            };
        }else{
            $datainvoice = $models->getdataInvoice($id);  
            $project = array(
                "code"=>$datainvoice->InvCode,
                "project_id"=>$datainvoice->ProjectId,
                "SampleId"=>"",
                "InvId"=>$datainvoice->InvId, 
                "menu"=>"invoice",
                "CustomerName"=>$datainvoice->CustomerName,
                "CustomerTelp"=>$datainvoice->CustomerTelp1,
                "CustomerAddress"=>$datainvoice->CustomerAddress,
                "StoreId"=>$datainvoice->StoreId
            );
            $arr_detail = $models->getdataDetailInvoice($id);
            foreach($arr_detail as $row){
                $detail[] = array( 
                            "id" => $row->ProdukId, 
                            "produkid" => $row->ProdukId, 
                            "satuan_id"=> ($row->InvDetailSatuanId == 0 ? "" : $row->InvDetailSatuanId),
                            "satuan_text"=>$row->InvDetailSatuanText,  
                            "price"=>$row->InvDetailPrice,
                            "varian"=> JSON_DECODE($row->InvDetailVarian,true),
                            "total"=> $row->InvDetailTotal,
                            "disc"=> $row->InvDetailDisc,
                            "qty_ref"=> $row->InvDetailQty,
                            "qty_success"=>$models->getQtyDeliveryByRef($id,$row->ProdukId,$row->InvDetailVarian,$row->InvDetailText), 
                            "qty"=> $row->InvDetailQty - $models->getQtyDeliveryByRef($id,$row->ProdukId,$row->InvDetailVarian,$row->InvDetailText),
                            "qty_spare"=> 0,
                            "text"=> $row->InvDetailText,
                            "group"=> $row->InvDetailGroup,
                            "type"=> $row->InvDetailType 
                        );
            };

           
        }  
       
        $data["project"] = $project; 
        $data["detail"] =  $detail; 
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project["StoreId"]], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/delivery/add_project_delivery',$data)); 
    } 
    public function project_delivery_edit($id)
    {      
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $delivery = $models->getdataDelivery($id); 
        $arr_detail = $models->getdataDetailDelivery($id); 
         

        $detail = array();
        foreach($arr_detail as $row){
            if($delivery->InvId > 0){ 
                $qty_ref = $models->getdataInvoiceByDelivery($delivery->InvId,$row->ProdukId,$row->DeliveryDetailVarian,$row->DeliveryDetailText);
                $qty_success = $models->getQtyDeliveryByRef($delivery->InvId,$row->ProdukId,$row->DeliveryDetailVarian,$row->DeliveryDetailText) - $row->DeliveryDetailQty;
            }else if($delivery->POId > 0){
                $qty_ref = 0;
                $qty_success = 0;
            }else if($delivery->SampleId > 0){
                $qty_ref = 0;
                $qty_success = 0;
            }else{
                $qty_ref = 0;
                $qty_success = 0;
    
            }
            $detail[] = array( 
                "id" => $row->ProdukId, 
                "produkid" => $row->ProdukId, 
                "satuan_id"=> ($row->DeliveryDetailSatuanId == 0 ? "" : $row->DeliveryDetailSatuanId),
                "satuan_text"=>$row->DeliveryDetailSatuanText,   
                "varian"=> JSON_DECODE($row->DeliveryDetailVarian,true), 
                "qty"=> $row->DeliveryDetailQty,
                "qty_spare"=> $row->DeliveryDetailQtySpare,
                "qty_ref"=> $qty_ref,
                "qty_success"=> $qty_success,
                "text"=> $row->DeliveryDetailText,
                "group"=> $row->DeliveryDetailGroup,
                "type"=> $row->DeliveryDetailType 
            );
        };

        $data["delivery"] = $delivery; 
        $data["detail"] =  $detail; 
        $data["template"] =$models->get_data_template_footer($delivery->TemplateId);   
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/delivery/edit_project_delivery',$data)); 
    }
    public function project_delivery_proses($id)
    {       
        $models = new ProjectModel();
        $data["delivery"] = $models->getdataDelivery($id); 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/delivery/add_proses_delivery',$data)); 
    } 
    public function project_delivery_proses_edit($id) {  
        $models = new ProjectModel();
        $data["delivery"] = $models->getdataDelivery($id); 
        $data["user"] = User(); //mengambil session dari mythauth
 
        $folder_utama = 'assets/images/delivery';  
        $files = glob($folder_utama."/".$id. '/proses.*');
        foreach ($files as $file) { 
            $imgData = base64_encode(file_get_contents($file));  
            $data["image"]  = 'data:'.mime_content_type($file).';base64,'.$imgData; 
        }  
        return $this->response->setBody(view('admin/project/delivery/edit_proses_delivery',$data)); 
    } 
    public function project_delivery_finish($id)
    {       
        $models = new ProjectModel();
        $data["delivery"] = $models->getdataDelivery($id); 
        $data["user"] = User(); //mengambil session dari mythauth 

        $arr_detail = $models->getdataDetailDelivery($id);
        foreach($arr_detail as $row){
            $detail[] = array( 
                "id" => $row->ProdukId, 
                "produkid" => $row->ProdukId, 
                "satuan_id"=> ($row->DeliveryDetailSatuanId == 0 ? "" : $row->DeliveryDetailSatuanId),
                "satuan_text"=>$row->DeliveryDetailSatuanText,   
                "varian"=> JSON_DECODE($row->DeliveryDetailVarian,true), 
                "qty"=> $row->DeliveryDetailQty,
                "qty_spare"=> $row->DeliveryDetailQtySpare, 
                "qty_waste"=> 0, 
                "text"=> $row->DeliveryDetailText,
                "group"=> $row->DeliveryDetailGroup,
                "type"=> $row->DeliveryDetailType 
            );
        }; 
        $data["detail"] =  $detail; 
        return $this->response->setBody(view('admin/project/delivery/add_finish_delivery',$data)); 
    }
    public function project_delivery_finish_edit($id)
    {       
        $models = new ProjectModel();
        $data["delivery"] = $models->getdataDelivery($id); 
        $data["user"] = User(); //mengambil session dari mythauth 

        $arr_detail = $models->getdataDetailDelivery($id);
        foreach($arr_detail as $row){
            $detail[] = array( 
                "id" => $row->ProdukId, 
                "produkid" => $row->ProdukId, 
                "satuan_id"=> ($row->DeliveryDetailSatuanId == 0 ? "" : $row->DeliveryDetailSatuanId),
                "satuan_text"=>$row->DeliveryDetailSatuanText,   
                "varian"=> JSON_DECODE($row->DeliveryDetailVarian,true), 
                "qty"=> $row->DeliveryDetailQtyReceive,
                "qty_spare"=> $row->DeliveryDetailQtyReceiveSpare, 
                "qty_waste"=>  $row->DeliveryDetailQtyReceiveWaste, 
                "text"=> $row->DeliveryDetailText,
                "group"=> $row->DeliveryDetailGroup,
                "type"=> $row->DeliveryDetailType 
            );
        }; 
        $folder_utama = 'assets/images/delivery';  
        $files = glob($folder_utama."/".$id. '/finish.*'); 
        foreach ($files as $file) {   
            if (!file_exists($file)) {
                return false;
            }  
            $jenis_gambar = mime_content_type($file); 
            $gambar = file_get_contents($file); 
            $base64 = base64_encode($gambar); 
            $data["image"]  = "data:$jenis_gambar;base64,$base64"; 
        }  
        $data["detail"] =  $detail; 
        return $this->response->setBody(view('admin/project/delivery/edit_finish_delivery',$data)); 
    }
}
