<?php

namespace App\Controllers;

use App\Models\StoreModel;
use App\Models\UserModel;
use App\Models\CustomerModel;
use App\Models\ProvinceModel;
use App\Models\VendorModel;
use App\Models\ProdukModel;
use App\Models\ProdukcategoryModel;
use App\Models\ProdukvarianvalueModel;
use App\Models\ProdukvarianModel;
use App\Models\ProjectModel;
use App\Models\PaymentModel;
use App\Models\ProjectsurveyModel;
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
        $varian = new ProdukvarianModel();
        $category = new ProdukcategoryModel();
        $variandetail = new ProdukvarianvalueModel();
        $vendor = new VendorModel();
        $data = [ 
            'category' => $category->get()->getResult(),
            'vendor' => $vendor->get()->getResult(),
            'varian' => $varian->get()->getResult(),
            'varian_detail' => $variandetail->get()->getResult(),
            'varianlist' => ''
        ]; 
        return $this->response->setBody(view('admin/produk/select_new.php',$data)); 
        //return $this->response->setBody(view('admin/produk/select.php')); 
    }
    public function produk_select_new()
    {   
        $varian = new ProdukvarianModel();
        $category = new ProdukcategoryModel();
        $variandetail = new ProdukvarianvalueModel();
        $vendor = new VendorModel();
        $data = [ 
            'category' => $category->get()->getResult(),
            'vendor' => $vendor->get()->getResult(),
            'varian' => $varian->get()->getResult(),
            'varian_detail' => $variandetail->get()->getResult(),
            'varianlist' => ''
        ]; 
        return $this->response->setBody(view('admin/produk/select_new', $data)); 
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
        $models->join("customer","customer.CustomerId=project.CustomerId","left");
        $models->join("users","users.id=project.UserId","left");
        $models->join("store","store.StoreId=project.StoreId","left");
        $data["project"] = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        $data["user"] = User(); //mengambil session dari mythauth 
        return $this->response->setBody(view('admin/project/edit_project.php',$data)); 
    }

    public function survey_add()
    {      
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel(); 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/survey/add_survey.php',$data)); 
    }
    public function survey_edit($id)
    {     
        $models = new ProjectsurveyModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
 
        $data["project"] = $models->get_data_survey($id);
        $data["staff"] = $models->get_data_survey_staff($data["project"]->SurveyStaff); 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/survey/edit_survey.php',$data)); 
    }
    public function project_survey_add($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $project = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $data["customer"] =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->StoreId], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/survey/add_project_survey.php',$data)); 
    }
    public function project_survey_edit($id)
    {     
        $models = new ProjectsurveyModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
 
        $data["project"] = $models->get_data_survey($id);
        $data["staff"] = $models->get_data_survey_staff($data["project"]->SurveyStaff);
        $data["customer"] =  $modelscustomer->getWhere(['CustomerId' => $data["project"]->CustomerId], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $data["project"]->StoreId], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/survey/edit_project_survey.php',$data)); 
    }
    public function project_survey_finish($id)
    {     
        $models = new ProjectsurveyModel();  
        $data["project"] = $models->get_data_survey($id);
        return $this->response->setBody(view('admin/project/survey/add_project_survey_finish.php',$data)); 
    }
    public function project_survey_finish_edit($id)
    {     
        $models = new ProjectsurveyModel();  
        $data["project"] = $models->get_data_survey_finish($id);
        return $this->response->setBody(view('admin/project/survey/edit_project_survey_finish.php',$data)); 
    }


    
    public function sample_add($id)
    {     

        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/sample/add_sample.php',$data)); 
    }
    public function project_sample_add($id)
    {     
        $models = new ProjectModel();
        $modelsurvey = new ProjectsurveyModel();
        $modelscustomer = new CustomerModel(); 
        $request = Services::request();
        $postData = $request->getPost(); 

        $project = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 

        $data["project"] = $project;
        $customer =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["customer"] = array(
            "CustomerName"=> $customer->CustomerName.($customer->CustomerCompany == "" ? "" : " ( " . $customer->CustomerCompany . " )"),
            "CustomerTelp"=> $customer->CustomerTelp1.($customer->CustomerTelp2 == "" ? "" : " / ".$customer->CustomerTelp2),
            "CustomerAddress"=>$customer->CustomerAddress,
        ); 
        
        $data["ref_header"] = null;
        $data["ref_detail"] = []; 
        $data["ref_type"] = ""; 
        
        if(isset($postData['RefId']) && $postData['RefId'] > 0 ){   
            $data["ref_type"] = $postData['Type'];
            if($postData['Type'] == "Survey") {  
                $ref = $modelsurvey->get_data_survey($postData['RefId']); 
                $data["ref_header"] = array("code"=>$ref->SurveyCode,"id"=>$ref->SurveyId,"type"=>"Survey");
                $data["ref_detail"] = [];  
                $data["customer"] = array(
                    "CustomerName"=> $ref->SurveyCustName,
                    "CustomerTelp"=> $ref->SurveyCustTelp,
                    "CustomerAddress"=>$ref->SurveyAddress,
                ) ;
            } 
        }

        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/sample/add_project_sample.php',$data)); 
    }

    public function project_sample_edit($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        $modelsproduk = new ProdukModel();

        $project = $models->get_data_sample($id); 
        $arr_detail = $models->get_data_sample_detail($id);
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
                        "type"=> $row->SampleDetailType,
                        "image_url"=> $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->SampleDetailVarian,true)
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
        $modelsurvey = new ProjectsurveyModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        $modelsproduk = new ProdukModel();
        $request = Services::request();
        $postData = $request->getPost(); 

        $project = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $customer =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["customer"] = array(
            "CustomerName"=> $customer->CustomerName.($customer->CustomerCompany == "" ? "" : " ( " . $customer->CustomerCompany . " )"),
            "CustomerTelp"=> $customer->CustomerTelp1.($customer->CustomerTelp2 == "" ? "" : " / ".$customer->CustomerTelp2),
            "CustomerAddress"=>$customer->CustomerAddress,
        ) ;
        $data["ref_header"] = null;
        $data["ref_detail"] = []; 
        $data["ref_type"] = ""; 
        if(isset($postData['RefId']) && $postData['RefId'] > 0 ){   
            $data["ref_type"] = $postData['Type']; 
            if($postData['Type'] == "Sample") {  
                $ref = $models->get_data_sample($postData['RefId']); 
                $data["ref_header"] = array("code"=>$ref->SampleCode,"id"=>$ref->SampleId,"type"=>"Sample");
                $arr_detail = $models->get_data_sample_detail($postData['RefId']);
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
                                "disc"=> 0,
                                "qty"=> $row->SampleDetailQty,
                                "text"=> $row->SampleDetailText,
                                "group"=> $row->SampleDetailGroup,
                                "type"=> $row->SampleDetailType,
                                "image_url"=> $modelsproduk->getproductimageUrl(  $row->ProdukId)
                            );
                };
                $data["ref_detail"] = $detail;
                $data["customer"] = array(
                    "CustomerName"=> $ref->SampleCustName,
                    "CustomerTelp"=> $ref->SampleCustTelp,
                    "CustomerAddress"=>$ref->SampleAddress,
                ) ;
            }
            
            if($postData['Type'] == "Survey") {  
                $ref = $modelsurvey->get_data_survey($postData['RefId']); 
                $data["ref_header"] = array("code"=>$ref->SurveyCode,"id"=>$ref->SurveyId,"type"=>"Survey");
                $data["ref_detail"] = array(array(
                    "id" => 0, 
                    "produkid" => 0, 
                    "satuan_id"=> "28",
                    "satuan_text"=> "Visit",  
                    "price"=> $ref->SurveyTotal,
                    "varian"=> [],
                    "total"=> $ref->SurveyTotal,
                    "disc"=> 0,
                    "qty"=> 1,
                    "text"=> "Jasa Survey Proyek",
                    "group"=> "",
                    "type"=> "product",
                    "image_url"=> base_url("assets/images/produk/default.png")
                )); 
                $data["customer"] = array(
                    "CustomerName"=> $ref->SurveyCustName,
                    "CustomerTelp"=> $ref->SurveyCustTelp,
                    "CustomerAddress"=>$ref->SurveyAddress,
                ) ;
            } 
        }
 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/sph/add_project_sph.php',$data)); 
    }
    public function project_sph_edit($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        $modelsproduk = new ProdukModel();

        $project = $models->get_data_sph($id); 
        $arr_detail = $models->get_data_sph_detail($id);  
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
                        "type"=> $row->SphDetailType,
                        "image_url"=>  
                        $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->SphDetailVarian,true)
                    );
        };
        $data["project"] = $project; 
        $data["detail"] =  $detail;
        $data["sample"] = $models->get_data_sample($project->SampleId); 
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
        $customer =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["customer"] = array(
            "CustomerName"=> $customer->CustomerName.($customer->CustomerCompany == "" ? "" : " ( " . $customer->CustomerCompany . " )"),
            "CustomerTelp"=> $customer->CustomerTelp1.($customer->CustomerTelp2 == "" ? "" : " / ".$customer->CustomerTelp2),
            "CustomerAddress"=>$customer->CustomerAddress,
        ); 
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
        $modelsproduk = new ProdukModel();

        $project = $models->get_data_pembelian($id); 
        $arr_detail = $models->get_data_pembelian_detail($id);
        $detail = array();
        $detailref = array(); 
        if($project->PORefType == "Penawaran"){  
            $arr_detail_ref = $models->get_data_sph_detail($project->PORef);
            foreach($arr_detail_ref as $row){
                $detailref[] = array(
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
                    "type"=> $row->SphDetailType,
                    "image_url"=>  
                    $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->SphDetailVarian,true)
                );
            };
        }
        if($project->PORefType == "Invoice"){  
            $arr_detail_ref = $models->get_data_invoice_detail($project->PORef);
            foreach($arr_detail_ref as $row){
                $detailref[] = array(
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
                    "type"=> $row->InvDetailType,
                    "image_url"=>  
                    $modelsproduk->getproductimagedatavarian($row->ProdukId,$row->InvDetailVarian,true)
                );
            };
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
                        "price"=>$row->PODetailPrice,
                        "total"=> $row->PODetailTotal,  
                        "qty"=> $row->PODetailQty,
                        "type"=> $row->PODetailType,
                        "image_url"=>  
                        $modelsproduk->getproductimagedatavarian($row->ProdukId,$row->PODetailVarian,true)
                    );
        }; 
        $data["project"] = $project; 
        $data["detail"] =  $detail;
        $data["detailref"] =  $detailref; 
        $data["vendor"] = $modelsvendor->get()->getResult();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/po/edit_project_po',$data)); 
    }

    public function project_invoice_add($id)
    {     
        $models = new ProjectModel();
        $modelsurvey = new ProjectsurveyModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel(); 
        $modelsproduk = new ProdukModel();
        $request = Services::request(); 
        $postData = $request->getPost(); 

        
        $project = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $customer =  $modelscustomer->getWhere(['CustomerId' => $project->CustomerId], 1)->getRow();
        $data["customer"] = array(
            "CustomerName"=> $customer->CustomerName.($customer->CustomerCompany == "" ? "" : " ( " . $customer->CustomerCompany . " )"),
            "CustomerTelp"=> $customer->CustomerTelp1.($customer->CustomerTelp2 == "" ? "" : " / ".$customer->CustomerTelp2),
            "CustomerAddress"=>$customer->CustomerAddress,
        );
        $data["ref_header"] = null;
        $data["ref_detail"] = []; 
        $data["ref_type"] = ""; 
        if(isset($postData['RefId']) && $postData['RefId'] > 0 ){  
            $data["ref_type"] = $postData['Type']; 
            if($postData['Type'] == "penawaran") {   
                $ref = $models->get_data_sph($postData['RefId']); 
                $data["ref_header"] = array("code"=>$ref->SphCode,"id"=>$ref->SphId,"type"=>"Penawaran");  
                $arr_detail = $models->get_data_sph_detail($postData['RefId']);
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
                                "type"=> $row->SphDetailType,
                                "image_url"=>  
                                $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->SphDetailVarian,true)
                            );
                };
                $data["ref_detail"] = $detail;
                $data["customer"] = array(
                    "CustomerName"=> $ref->SphCustName,
                    "CustomerTelp"=> $ref->SphCustTelp,
                    "CustomerAddress"=>$ref->SphAddress,
                ) ;
            } 
            if($postData['Type'] == "Sample") {  
                $ref = $models->get_data_sample($postData['RefId']); 
                $data["ref_header"] = array("code"=>$ref->SampleCode,"id"=>$ref->SampleId,"type"=>"Sample");
                $arr_detail = $models->get_data_sample_detail($postData['RefId']);
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
                                "disc"=> 0,
                                "qty"=> $row->SampleDetailQty,
                                "text"=> $row->SampleDetailText,
                                "group"=> $row->SampleDetailGroup,
                                "type"=> $row->SampleDetailType,
                                "image_url"=>  
                                $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->SampleDetailVarian,true)
                            );
                };
                $data["ref_detail"] = $detail;
                $data["customer"] = array(
                    "CustomerName"=> $ref->SampleCustName,
                    "CustomerTelp"=> $ref->SampleCustTelp,
                    "CustomerAddress"=>$ref->SampleAddress,
                ) ;
            }  
            if($postData['Type'] == "Survey") {  
                $ref = $modelsurvey->get_data_survey($postData['RefId']); 
                $data["ref_header"] = array("code"=>$ref->SurveyCode,"id"=>$ref->SurveyId,"type"=>"Survey");
                $data["ref_detail"] = array(array(
                    "id" => 0, 
                    "produkid" => 0, 
                    "satuan_id"=> "28",
                    "satuan_text"=> "Visit",  
                    "price"=> $ref->SurveyTotal,
                    "varian"=> [],
                    "total"=> $ref->SurveyTotal,
                    "disc"=> 0,
                    "qty"=> 1,
                    "text"=> "Jasa Survey Proyek",
                    "group"=> "",
                    "type"=> "product",
                    "image_url"=> base_url("assets/images/produk/default.png")
                )); 
                $data["customer"] = array(
                    "CustomerName"=> $ref->SurveyCustName,
                    "CustomerTelp"=> $ref->SurveyCustTelp,
                    "CustomerAddress"=>$ref->SurveyAddress,
                ) ;
            } 
        }
 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/invoice/add_project_invoice.php',$data)); 

    }
    public function project_invoice_edit($id)
    {     
        $models = new ProjectModel();
        $modelsurvey = new ProjectsurveyModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        $modelsproduk = new ProdukModel();

        $project = $models->get_data_invoice($id); 
        $arr_detail = $models->get_data_invoice_detail($id);
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
                        "type"=> $row->InvDetailType,
                        "image_url"=>  
                        $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->InvDetailVarian,true)
                    );
        };


        $data["project"] = $project; 
        if($project->InvRefType  == "Sample"){
            $sample = $models->get_data_sample($project->InvRef); 
            $data["ref"] = $sample->SampleCode;
        }else if($project->InvRefType ==  "Penawaran"){
            $sph = $models->get_data_sph($project->InvRef); 
            $data["ref"] = $sph->SphCode; 
        }else if($project->InvRefType ==  "Survey"){
            $sph = $modelsurvey->get_data_survey($project->InvRef); 
            $data["ref"] = $sph->SurveyCode; 
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
            $datasample = $models->get_data_sample($id); 
            $project = array(
                "ProjectId"=>$datasample->ProjectId,
                "PaymentRef"=>$datasample->SampleId, 
                "PaymentRefType"=>"Sample",
                "GrandTotal"=>$datasample->SampleGrandTotal,
            );
            $data["payment"] = $models->get_data_payment_by_sample($id);  
        }
        if($postData['type'] == "invoice"){
            $datainvoice = $models->get_data_invoice($id); 
            $project = array(
                "ProjectId"=>$datainvoice->ProjectId, 
                "PaymentRef"=>$datainvoice->InvId, 
                "PaymentRefType"=>"Invoice",
                "GrandTotal"=>$datainvoice->InvGrandTotal,
            );
            $data["payment"] = $models->get_data_payment_by_invoice($id);  
        }
        if($postData['type'] == "pembelian"){
            $datapo = $models->get_data_pembelian($id); 
            $project = array(
                "ProjectId"=>$datapo->ProjectId, 
                "PaymentRef"=>$datapo->POId,
                "PaymentRefType"=>"Pembelian",
                "GrandTotal"=>$datapo->POGrandTotal,
            );
            $data["payment"] = $models->get_data_payment_by_pembelian($id);  
        }
        if($postData['type'] == "delivery"){
            $datadelivery = $models->getDataDelivery($id); 
            $project = array(
                "ProjectId"=>$datadelivery->ProjectId, 
                "PaymentRef"=>$datadelivery->DeliveryId, 
                "PaymentRefType"=>"Pengiriman",
                "GrandTotal"=>$datadelivery->DeliveryTotal,
            );
            $data["payment"] = $models->get_data_payment_by_delivery($id);  
        }
        $data["project"] = $project; 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/payment/add_payment.php',$data)); 
    }
    public function project_payment_edit($id)
    {     
        $models = new ProjectModel();      
        $request = Services::request();
        $postData = $request->getPost(); 
        $data["payment"] = $models->get_data_payment($id);   
        if($postData['type'] == "sample"){
            $datasample = $models->get_data_sample($data["payment"]->PaymentRef); 
            $project = array(
                "ProjectId"=>$datasample->ProjectId,
                "PaymentRef"=>$datasample->SampleId, 
                "PaymentRefType"=>"Sample",
                "GrandTotal"=>$datasample->SampleGrandTotal,
            );
            $data["payments"] = $models->get_data_payment_by_sample($data["payment"]->PaymentRef);  
        }
        if($postData['type'] == "invoice"){
            $datainvoice = $models->get_data_invoice($id); 
            $project = array(
                "ProjectId"=>$datainvoice->ProjectId, 
                "PaymentRef"=>$datainvoice->InvId, 
                "PaymentRefType"=>"Invoice",
                "GrandTotal"=>$datainvoice->InvGrandTotal,
            );
            $data["payments"] = $models->get_data_payment_by_invoice($data["payment"]->PaymentRef);  
        }
        if($postData['type'] == "pembelian"){
            $datapo = $models->getDataPO($id); 
            $project = array(
                "ProjectId"=>$datapo->ProjectId, 
                "PaymentRef"=>$datapo->POId,
                "PaymentRefType"=>"Pembelian",
                "GrandTotal"=>$datapo->POGrandTotal,
            );
            $data["payments"] = $models->get_data_payment_by_pembelian($data["payment"]->PaymentRef);  
        }
        if($postData['type'] == "delivery"){
            $datadelivery = $models->getDataDelivery($id); 
            $project = array(
                "ProjectId"=>$datadelivery->ProjectId, 
                "PaymentRef"=>$datadelivery->DeliveryId, 
                "PaymentRefType"=>"Pengiriman",
                "GrandTotal"=>$datadelivery->DeliveryTotal,
            );
            $data["payments"] = $models->get_data_payment_by_delivery($data["payment"]->PaymentRef);  
        }

        $data["project"] = $project; 
        $data["template"] = $models->get_data_template_footer($data["payment"]->TemplateId); 
        $data["image"] = $models->get_data_payment_image($data["payment"]->ProjectId,$data["payment"]->PaymentRef,$data["payment"]->PaymentRefType,$id);    
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/payment/edit_payment.php',$data)); 
    }

    public function payment_request($id){    
        $request = Services::request();
        $postData = $request->getPost();  
        $models = new ProjectModel();  

        if($postData['type'] == "Survey"){
            $models = new ProjectsurveyModel();  
            $req = $models->get_data_survey($id); 
            $data["total"] = $req->SurveyTotal;
            $data["ref"] = $req->SurveyId;
            $data["refType"] = "Survey";
            $data["project"] = $req->ProjectId;
            return $this->response->setBody(view('admin/project/payment/add_request_payment.php',$data));  
        }
        if($postData['type'] == "delivery"){
            $req = $models->get_data_delivery($id);
            $data["total"] = $req->DeliveryTotal;
            $data["ref"] = $req->DeliveryId;
            $data["refType"] = "Delivery";
            $data["project"] = $req->ProjectId;
            return $this->response->setBody(view('admin/project/payment/add_request_payment.php',$data));  
        }   
        if($postData['type'] == "pembelian"){
            $req = $models->get_data_pembelian($id);
            $data["total"] = $req->POGrandTotal;
            $data["ref"] = $req->POId;
            $data["refType"] = "Pembelian";
            $data["project"] = $req->ProjectId;
            return $this->response->setBody(view('admin/project/payment/add_request_payment.php',$data)); 
            
        }
    }
    public function payment_request_edit($id){  
        $request = Services::request();
        $postData = $request->getPost();  
        $models = new PaymentModel();   
        $data["payment"] = $models->get_data_request_payment($id);  
        return $this->response->setBody(view('admin/project/payment/edit_request_payment.php',$data));  
     
    }
    public function project_payment_request($id){
        $models = new ProjectModel();      
        $request = Services::request();
        $postData = $request->getPost();  
        if($postData['type'] == "delivery"){
            $req = $models->get_data_delivery($id);
            $data["payment"] = $req;
            $data["total"] = $req->DeliveryTotal;
            $data["ref"] = $req->DeliveryId;
            $data["refType"] = "Delivery";
            $data["project"] = $req->ProjectId;
            return $this->response->setBody(view('admin/project/payment/add_request_payment.php',$data));  
        }   
        if($postData['type'] == "pembelian"){
            $req = $models->get_data_pembelian($id);
            $data["total"] = $req->POGrandTotal;
            $data["ref"] = $req->POId;
            $data["refType"] = "Pembelian";
            $data["project"] = $req->ProjectId;
            return $this->response->setBody(view('admin/project/payment/add_request_payment.php',$data)); 
            
        }
    }
    public function project_payment_request_edit($id){
        $models = new ProjectModel();       
        $data["request"] = $models->get_data_request_payment($id); 
        return $this->response->setBody(view('admin/project/payment/edit_request_payment.php',$data));  
     
    }
    public function project_proforma_add($id)
    {     
        $models = new ProjectModel();  
        $project = $models->get_data_invoice($id);  
        $data["project"] = $project; 
        $data["payment"] = $models->get_data_proforma_by_ref($id);  
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/payment/add_proforma.php',$data)); 
    }
    public function project_proforma_edit($id)
    {     
        $models = new ProjectModel();      
        $data["payment"] = $models->get_data_proforma($id);  
        $data["template"] = $models->get_data_template_footer($data["payment"]->TemplateId); 
        $data["project"] = $models->get_data_invoice($data["payment"]->PaymentRef);      
        $data["payments"] = $models->get_data_proforma_by_ref($data["payment"]->PaymentRef);   
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/payment/edit_proforma.php',$data)); 
    }
    public function project_delivery_add($id)
    {      
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel(); 
        $modelsproduk = new ProdukModel();
        
        $request = Services::request();
        $postData = $request->getPost(); 
        $detail = array();
        if($postData['type'] == "sample"){ 
            $datasample = $models->get_data_sample($id);  
            $project = array(
                "code"=>$datasample->SampleCode,
                "project_id"=>$datasample->ProjectId,
                "DeliveryRef"=>$datasample->SampleId,  
                "DeliveryRefType"=>"Sample",
                "CustomerName"=>$datasample->SampleCustName,
                "CustomerTelp"=>$datasample->SampleCustTelp,
                "CustomerAddress"=>$datasample->SampleAddress
            );
            $arr_detail = $models->get_data_sample_detail($id);
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
                            "qty_success"=>$models->get_data_delivery_detail_by_sample($id,$row->ProdukId,$row->SampleDetailVarian,$row->SampleDetailText), 
                            "qty"=> $row->SampleDetailQty - $models->get_data_delivery_detail_by_sample($id,$row->ProdukId,$row->SampleDetailVarian,$row->SampleDetailText),
                            "qty_spare"=> 0,
                            "text"=> $row->SampleDetailText,
                            "group"=> $row->SampleDetailGroup,
                            "type"=> $row->SampleDetailType ,
                            "image_url"=>  
                            $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->SampleDetailVarian,true)
                        );
            };
        }else{
            $datainvoice = $models->get_data_invoice($id);  
            $project = array(
                "code"=>$datainvoice->InvCode,
                "project_id"=>$datainvoice->ProjectId, 
                "DeliveryRef"=>$datainvoice->InvId, 
                "DeliveryRefType"=>"Invoice",
                "CustomerName"=>$datainvoice->InvCustName,
                "CustomerTelp"=>$datainvoice->InvCustTelp,
                "CustomerAddress"=>$datainvoice->InvAddress, 
            );
            $arr_detail = $models->get_data_invoice_detail($id);
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
                            "qty_success"=>$models->get_data_delivery_detail_by_ref($id,$row->ProdukId,$row->InvDetailVarian,$row->InvDetailText), 
                            "qty"=> $row->InvDetailQty - $models->get_data_delivery_detail_by_ref($id,$row->ProdukId,$row->InvDetailVarian,$row->InvDetailText),
                            "qty_spare"=> 0,
                            "text"=> $row->InvDetailText,
                            "group"=> $row->InvDetailGroup,
                            "type"=> $row->InvDetailType,
                            "image_url"=>  
                            $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->InvDetailVarian,true)
                        );
            };

           
        }  
       
        $data["project"] = $project; 
        $data["detail"] =  $detail;  
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/delivery/add_project_delivery',$data)); 
    } 
    public function project_delivery_edit($id)
    {      
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        $modelsproduk = new ProdukModel();

        $delivery = $models->get_data_delivery($id); 
        $arr_detail = $models->get_data_delivery_detail($id); 
         

        $detail = array();
        foreach($arr_detail as $row){
            if($delivery->InvId > 0){ 
                $qty_ref = $models->get_data_invoice_by_delivery($delivery->InvId,$row->ProdukId,$row->DeliveryDetailVarian,$row->DeliveryDetailText);
                $qty_success = $models->get_data_delivery_detail_by_ref($delivery->InvId,$row->ProdukId,$row->DeliveryDetailVarian,$row->DeliveryDetailText) - $row->DeliveryDetailQty;
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
                "type"=> $row->DeliveryDetailType ,
                "image_url"=> 
                $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->DeliveryDetailVarian,true)
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
        $data["delivery"] = $models->get_data_delivery($id); 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/delivery/add_proses_delivery',$data)); 
    } 
    public function project_delivery_proses_edit($id) {  
        $models = new ProjectModel();
        $data["delivery"] = $models->get_data_delivery($id); 
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
        $data["delivery"] = $models->get_data_delivery($id); 
        $data["user"] = User(); //mengambil session dari mythauth 

        $arr_detail = $models->get_data_delivery_detail($id);
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
        $data["delivery"] = $models->get_data_delivery($id); 
        $data["user"] = User(); //mengambil session dari mythauth 

        $arr_detail = $models->get_data_delivery_detail($id);
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


    public function project_accounting_add($id,$group)
    {       
        $models = new ProjectModel();
        $models->join("customer","customer.CustomerId=project.CustomerId");
        $models->join("users","users.id=project.UserId");
        $models->join("store","store.StoreId=project.StoreId");
        $data["project"] = $models->getWhere(['ProjectId' => $id], 1)->getRow(); 
        $data["user"] = User(); //mengambil session dari mythauth
        if($group==2){ 
            return $this->response->setBody(view('admin/project/accounting/add_lain_lain.php',$data)); 
        }else{ 
            return $this->response->setBody(view('admin/project/accounting/add_modal.php',$data)); 
        }
    }

    public function project_accounting_edit($id,$group)
    {       
        $models = new ProjectModel(); 
        $data["project"] = $models->getdataAccounting($id); 
        $data["user"] = User();
        if($group==2){ 
            return $this->response->setBody(view('admin/project/accounting/edit_lain_lain.php',$data)); 
        }else{ 
            return $this->response->setBody(view('admin/project/accounting/edit_modal.php',$data)); 
        }
    }
}

