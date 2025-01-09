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
        $data[] = "";
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
        ->select("*,customercategory.name catname,customer.name name,customer.id id")
        ->join("customercategory","customercategory.id=category")
        ->getWhere(['customer.id' => $id], 1)->getRow();  
        
        $models = new ProvinceModel();  
        $village = $models->get_village_by_id($account->village);  
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
            ->select("*,produk.id,produk.name,produk_category.id cat_id,produk_category.name cat_name,produk.code") 
            ->join("produk_category","produk_category.id = produk.category")
            ->getWhere(['produk.id' => $id], 1)->getRow(); 
        $data["_produkdetail"] = $models->getproductdetail($data["_produk"]->id); 
        $data["_produkimage"] = $models->getproductimage($data["_produk"]->id); 

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
        $account = $models->getWhere(['id' => $id], 1)->getRow(); 
        
        $data["_vendor"] = $account;    
        return $this->response->setBody(view('admin/vendor/edit.php',$data)); 
    }


    
    public function project_add()
    {   
        return $this->response->setBody(view('admin/project/add_project.php')); 
    }

    public function project_sph_add($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $project = $models->getWhere(['id' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $data["customer"] =  $modelscustomer->getWhere(['id' => $project->customerid], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->storeid], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/add_project_sph.php',$data)); 
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
                        "id" => $row->produkid, 
                        "satuan_id"=> ($row->satuan_id == 0 ? "" : $row->satuan_id),
                        "satuantext"=>$row->satuantext,  
                        "hargajual"=>$row->harga,
                        "varian"=> JSON_DECODE($row->varian,true),
                        "total"=> $row->total,
                        "disc"=> $row->disc,
                        "qty"=> $row->qty,
                        "text"=> $row->text,
                        "group"=> $row->group,
                        "type"=> $row->type
                    );
        };
        $data["project"] = $project; 
        $data["detail"] =  $detail;
        $data["template"] =$models->get_data_template_footer($project->templateid); 
        $data["customer"] =  $modelscustomer->getWhere(['id' => $project->customerid], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->storeid], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/edit_project_sph.php',$data)); 
    }
    
    public function project_po_add($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();
        $modelsvendor = new VendorModel();

        $project = $models->getWhere(['id' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $data["customer"] =  $modelscustomer->getWhere(['id' => $project->customerid], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->storeid], 1)->getRow();
        $data["vendor"] = $modelsvendor->get()->getResult();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/add_project_po.php',$data)); 
    }
    public function project_invoice_add($id)
    {     
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $project = $models->getWhere(['id' => $id], 1)->getRow(); 
        $data["project"] = $project;
        $data["customer"] =  $modelscustomer->getWhere(['id' => $project->customerid], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->storeid], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/add_project_invoice.php',$data)); 
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
                        "id" => $row->produkid, 
                        "satuan_id"=> ($row->satuan_id == 0 ? "" : $row->satuan_id),
                        "satuantext"=>$row->satuantext,  
                        "hargajual"=>$row->harga,
                        "varian"=> JSON_DECODE($row->varian,true),
                        "total"=> $row->total,
                        "disc"=> $row->disc,
                        "qty"=> $row->qty,
                        "text"=> $row->text,
                        "group"=> $row->group,
                        "type"=> $row->type
                    );
        };
        $data["project"] = $project; 
        $data["detail"] =  $detail;
        $data["template"] =$models->get_data_template_footer($project->templateid); 
        $data["customer"] =  $modelscustomer->getWhere(['id' => $project->customerid], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->storeid], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/edit_project_invoice.php',$data)); 
    }
    public function project_payment_add($id)
    {     
        $models = new ProjectModel();  
        $project = $models->getdataInvoice($id);  
        $data["project"] = $project; 
        $data["payment"] =$models->getdataPaymentByRef($project->id);  
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/add_project_payment.php',$data)); 
    }
    public function project_payment_edit($id)
    {     
        $models = new ProjectModel();      
        $data["payment"] = $models->getdataPayment($id);  
        $data["project"] = $models->getdataInvoice($data["payment"]->ref);  
        $data["image"] = $models->getdataImagePayment($data["payment"]->ref,$id);   
        $data["payments"] = $models->getdataPaymentByRef($data["payment"]->ref);   
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/edit_project_payment.php',$data)); 
    }
    public function project_proforma_add($id)
    {     
        $models = new ProjectModel();  
        $project = $models->getdataInvoice($id);  
        $data["project"] = $project; 
        $data["payment"] =$models->getdataPaymentByRef($project->id);  
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/add_project_proforma.php',$data)); 
    }
    public function project_proforma_edit($id)
    {     
        $models = new ProjectModel();      
        $data["payment"] = $models->getdataProforma($id);  
        $data["project"] = $models->getdataInvoice($data["payment"]->ref);      
        $data["payments"] = $models->getdataProformaByRef($data["payment"]->ref);   
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/edit_project_proforma.php',$data)); 
    }
    public function project_delivery_add($id)
    {      
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $project = $models->getdataInvoice($id); 
        $arr_detail = $models->getdataDetailInvoice($id);
        $detail = array();
        foreach($arr_detail as $row){
            $detail[] = array(
                        "id" => $row->produkid, 
                        "satuan_id"=> ($row->satuan_id == 0 ? "" : $row->satuan_id),
                        "satuantext"=>$row->satuantext,  
                        "hargajual"=>$row->harga,
                        "varian"=> JSON_DECODE($row->varian,true),
                        "total"=> $row->total,
                        "disc"=> $row->disc,
                        "qty"=> $row->qty,
                        "text"=> $row->text,
                        "group"=> $row->group,
                        "type"=> $row->type,
                        "invoice"=> $row->qty,
                        "dikirim"=> $models->getdataDetailDeliveryByInvoice($id,$row->produkid,$row->varian,$row->text),
                        "pengiriman"=> 0,
                        "spare"=> 0
                    );
        };
        $data["project"] = $project; 
        $data["detail"] =  $detail;
        $data["template"] =$models->get_data_template_footer($project->templateid); 
        $data["customer"] =  $modelscustomer->getWhere(['id' => $project->customerid], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $project->storeid], 1)->getRow();
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/add_project_delivery',$data)); 
    } 
    public function project_delivery_edit($id)
    {      
        $models = new ProjectModel();
        $modelscustomer = new CustomerModel();
        $modelsstore = new StoreModel();

        $delivery = $models->getdataDelivery($id); 
        $arr_detail = $models->getdataDetailDelivery($id);
        $arr_detail_invoice = $models->getdataDetailInvoice($delivery->ref);

        $invoice = $models->getdataInvoice($delivery->ref);
        $detail = array();
        foreach($arr_detail as $row){
            $detail[] = array(
                        "id" => $row->produkid, 
                        "satuan_id"=> ($row->satuan_id == 0 ? "" : $row->satuan_id),
                        "satuantext"=>$row->satuantext, 
                        "varian"=> JSON_DECODE($row->varian,true), 
                        "text"=> $row->text,
                        "group"=> $row->group,
                        "type"=> $row->type,
                        "invoice"=> $models->getdataInvoiceByDelivery($delivery->ref,$row->produkid,$row->varian,$row->text),
                        "dikirim"=> $models->getdataDetailDeliveryByInvoice($delivery->ref,$row->produkid,$row->varian,$row->text) - $row->pengiriman,
                        "pengiriman"=> $row->pengiriman,
                        "spare"=> $row->spare
                    );
        };
        $data["delivery"] = $delivery; 
        $data["detail"] =  $detail;
        $data["invoice"] =  $invoice;
        $data["template"] =$models->get_data_template_footer($delivery->templateid); 
        $data["customer"] =  $modelscustomer->getWhere(['id' => $delivery->customerid], 1)->getRow();
        $data["store"] = $modelsstore->getWhere(['StoreId' => $delivery->storeid], 1)->getRow(); 
        $data["user"] = User(); //mengambil session dari mythauth
        return $this->response->setBody(view('admin/project/edit_project_delivery',$data)); 
    }
}
