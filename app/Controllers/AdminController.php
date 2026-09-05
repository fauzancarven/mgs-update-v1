<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\master\UserModel;
use App\Models\ProjectModel;
use App\Models\master\StoreModel;
use App\Models\DeliveryModel;
use App\Models\ProjectcategoryModel;
use App\Models\master\ProdukModel;
use App\Models\master\produk\ProdukvarianModel;
use App\Models\master\produk\ProdukvarianvalueModel;
use App\Models\master\VendorModel; 
use App\Models\master\produk\ProdukcategoryModel;
use App\Models\SphModel;
use App\Models\InvoiceModel; 
use App\Models\PembelianModel; 


use \App\Models\AuthgroupModel;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User; 

use Config\Services; 

use App\Libraries\Nextcloud;


class AdminController extends BaseController
{
    protected $model; 

    protected $auth;
    protected $authgroup;

    /**
     * @var AuthConfig
     */
    protected $config;

    /**
     * @var Session
     */
    protected $session;


    public function __construct()
    {
        $this->model = new UserModel();
        $this->helpers = ['form', 'url']; 
         //
        $this->authgroup = new AuthgroupModel();
        $this->session = \Config\Services::session();
        $this->config = config('Auth');
        $this->auth   = service('authentication');
    }
    public function index()
    {   
      
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Dashboard',
            'menu' => "", 
        ];  
        return view('app/01_dashboard/index', $data);
        
    }

    public function profile($id = null)
    {     
        $this->session->set('nama_pengguna', 'John Doe');
        $modelsuser = new UserModel();
        if($id){
            $users = $modelsuser->getWhere(["id"=>$id])->getRow();
        }else{
            $users =  $modelsuser->getWhere(["id"=>user()->id])->getRow();
        }
        $data = [
            'notif' => [],
            'session' => $this->session->get(),
            'title' => 'Dashboard',
            'menu' => "", 
            'users' =>  $users,
        ]; 
        return view('app/04_master/account/view', $data);
        
    }

    public function sidebar(){
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {   
            $postData = $request->getPost();  
            $this->session->set($postData);
            return json_encode($postData); 
        } 
    }
    public function account()
    {   
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Account',
            'menu' => "Master"
        ]; 
        return view('app/04_master/account/index', $data); 
    }
    public function store()
    {   
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Store',
            'menu' => "Master"
        ]; 
        return view('app/04_master/store/index', $data);
        
    }

    public function customer()
    {   
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Customer',
            'menu' => "Master"
        ]; 
        return view('app/04_master/customer/index', $data);
        
    }
    public function vendor()
    {   
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Vendor',
            'menu' => "Master"
        ]; 
        return view('app/04_master/vendor/index', $data);
        
    }
    public function produk()
    {   
        $varian = new ProdukvarianModel();
        $category = new ProdukcategoryModel();
        $variandetail = new ProdukvarianvalueModel();
        $vendor = new VendorModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Produk',
            'menu' => "Master",
            'category' => $category->get()->getResult(),
            'vendor' => $vendor->get()->getResult(),
            'varian' => $varian->get()->getResult(),
            'varian_detail' => $variandetail->get()->getResult(),
            'varianlist' => ''
        ]; 
        return view('app/04_master/produk/index', $data);
        
    }
    public function project()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Project',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/project/index', $data); 
    }
    
    public function survey()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Survey',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/project/survey/index', $data); 
    }
    public function sample()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Sample',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/project/sample/index', $data); 
    }
    public function penawaran()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Penawaran',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/02_sales/penawaran/index', $data); 
    }
    public function penawaran_new()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Penawaran',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/02_sales/penawaran/index2', $data); 
    }
    public function penawaran_add()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Penawaran',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/02_sales/penawaran/add_view', $data); 
    }
    public function penawaran_edit($id)
    {    
        $models = new SphModel();
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $modelsproduk = new ProdukModel();
         
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
                        $modelsproduk->getproductimagedatavarian($row->ProdukId,$row->SphDetailVarian,true)
                    );
        };
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Penawaran',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'project' => $models->get_data_sph($id),
            'detail' => $detail, 

        ];  
        return view('app/02_sales/penawaran/edit_view', $data); 
    }

    
    public function invoice()
    {    
        $models = new SphModel();
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Invoice',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/02_sales/invoice/index', $data); 
    } 
    public function invoice_add()
    {   
        $models = new SphModel();
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Invoice',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/02_sales/invoice/add_view', $data);  
    }
    
    public function invoice_edit($id)
    {    
        $models = new InvoiceModel();
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $modelsproduk = new ProdukModel();
         
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
                        $modelsproduk->getproductimagedatavarian($row->ProdukId,$row->InvDetailVarian,true)
                    );
        };
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Invoice',
            'menu' => "Sales",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'project' =>  $models->get_data_invoice($id),
            'detail' => $detail, 

        ];   
        return view('app/02_sales/invoice/edit_view', $data); 
    }
    
    public function invoice_delivery_add($id)
    {     
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $modelinvoice = new InvoiceModel(); 
        $modelsproduk = new ProdukModel();
        $datainvoice = $modelinvoice->get_data_invoice($id);  
        $project = array(
            "code"=>$datainvoice->InvCode,
            "StoreId"=>$datainvoice->StoreId,
            "StoreCode"=>$datainvoice->StoreCode,
            "StoreName"=>$datainvoice->StoreName,
            "project_id"=>$datainvoice->ProjectId, 
            "DeliveryRef"=>$datainvoice->InvId, 
            "DeliveryRefType"=>"Invoice",
            "CustomerName"=>$datainvoice->InvCustName,
            "CustomerTelp"=>$datainvoice->InvCustTelp,
            "CustomerAddress"=>$datainvoice->InvProjectAddress, 
        );
        
        $arr_detail = $modelinvoice->get_data_invoice_detail($id);  
        $detail = array();  
        foreach($arr_detail as $row){
            if($row->InvDetailType == "product"  ){
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
                        "qty_success"=>$modelinvoice->get_data_delivery_detail_by_ref($id,$row->ProdukId,$row->InvDetailVarian), 
                        "qty"=> $row->InvDetailQty - $modelinvoice->get_data_delivery_detail_by_ref($id,$row->ProdukId,$row->InvDetailVarian),
                        "qty_spare"=> 0,
                        "text"=> $row->InvDetailText,
                        "group"=> $row->InvDetailGroup,
                        "type"=> $row->InvDetailType,
                        "image_url"=>  
                        $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->InvDetailVarian,true)
                    );
                }
        }; 
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Tambah Pengiriman',
            'menu' => "Sales",
            'delivery' => $project,
            'store' => $modelsstore->get()->getResult(), 
            'admin' => $modelsuser->get()->getResult(),
            'detail' => $detail, 
        ]; 
        return view('app/02_sales/delivery/add_view', $data);  
    }

    public function invoice_delivery_edit($id)
    {     
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $modelinvoice = new InvoiceModel(); 
        $modeldelivery = new DeliveryModel(); 
        $modelsproduk = new ProdukModel();
        $datadelivery = $modeldelivery->get_data_delivery($id);  
        $datainvoice = $modelinvoice->get_data_invoice($datadelivery->DeliveryRef);  
        $project = array(
            "code"=>$datainvoice->InvCode,
            "StoreId"=>$datainvoice->StoreId,
            "StoreCode"=>$datainvoice->StoreCode,
            "StoreName"=>$datainvoice->StoreName,
            "project_id"=>$datainvoice->ProjectId, 
            "DeliveryRef"=>$datainvoice->InvId, 
            "DeliveryRefType"=>"Invoice",
            "CustomerName"=>$datainvoice->InvCustName,
            "CustomerTelp"=>$datainvoice->InvCustTelp,
            "CustomerAddress"=>$datainvoice->InvProjectAddress, 
        );
        
        $arr_detail = $modeldelivery->get_data_delivery_detail($id);  
        $detail = array();  
        foreach($arr_detail as $row){
            if($row->DeliveryDetailType == "product" ){
            $detail[] = array( 
                        "id" => $row->ProdukId, 
                        "produkid" => $row->ProdukId, 
                        "satuan_id"=> ($row->DeliveryDetailSatuanId == 0 ? "" : $row->DeliveryDetailSatuanId),
                        "satuan_text"=>$row->DeliveryDetailSatuanText, 
                        "price"=>0,
                        "varian"=> JSON_DECODE($row->DeliveryDetailVarian,true),
                        "total"=>0,
                        "disc"=> 0,
                        "qty_ref"=> ($modelinvoice->get_data_invoice_detail($datainvoice->InvId,$row->ProdukId,$row->DeliveryDetailVarian)->InvDetailQty ?? 0),
                        "qty_success"=>$modelinvoice->get_data_delivery_detail_by_ref($datainvoice->InvId,$row->ProdukId,$row->DeliveryDetailVarian,$id), 
                        "qty"=> $row->DeliveryDetailQty,
                        "qty_spare"=> 0,
                        "text"=> $row->DeliveryDetailText,
                        "group"=> $row->DeliveryDetailGroup,
                        "type"=> $row->DeliveryDetailType,
                        "image_url"=>  
                        $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->DeliveryDetailVarian,true)
                    );
                }
        }; 
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Ubah Pengiriman',
            'menu' => "Sales",
            'delivery' => $datadelivery,
            'store' => $modelsstore->get()->getResult(), 
            'admin' => $modelsuser->get()->getResult(),
            'detail' => $detail, 
        ]; 
        return view('app/02_sales/delivery/edit_view', $data);  
    }

    public function invoice_pembelian_add($id)
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $modelinvoice = new InvoiceModel(); 
        $modelsproduk = new ProdukModel();
        $modelsVendor = new VendorModel();
        $datainvoice = $modelinvoice->get_data_invoice($id);  
        $project = array(
            "code"=>$datainvoice->InvCode,
            "StoreId"=>$datainvoice->StoreId,
            "StoreCode"=>$datainvoice->StoreCode,
            "StoreName"=>$datainvoice->StoreName,
            "project_id"=>$datainvoice->ProjectId, 
            "PORef"=>$datainvoice->InvId, 
            "PORefType"=>"Invoice",
            "CustomerId"=>$datainvoice->CustomerId,
            "CustomerName"=>$datainvoice->InvCustName,
            "CustomerTelp"=>$datainvoice->InvCustTelp,
            "CustomerAddress"=>$datainvoice->InvProjectAddress, 
        );
        
        $arr_detail = $modelinvoice->get_data_invoice_detail($id);  
        $detail = array();  
        foreach($arr_detail as $row){
            if($row->InvDetailType == "product"){
            $detail[] = array( 
                        "id" => $row->InvDetailId, 
                        "produkid" => $row->ProdukId, 
                        "satuan_id"=> ($row->InvDetailSatuanId == 0 ? "" : $row->InvDetailSatuanId),
                        "satuan_text"=>$row->InvDetailSatuanText, 
                        "price"=> ($modelsproduk->getDetailProduk(JSON_DECODE($row->InvDetailVarian,true),$row->ProdukId))["ProdukDetailHargaBeli"] ?? "",
                        "varian"=> JSON_DECODE($row->InvDetailVarian,true),
                        "total"=> $row->ProdukDetailHargaBeli * $row->InvDetailQty,
                        "disc"=> 0, 
                        "qty_ref"=> $row->InvDetailQty, 
                        "qty"=> $row->InvDetailQty,
                        "text"=> $row->InvDetailText,
                        "group"=> $row->InvDetailGroup,
                        "type"=> $row->InvDetailType,
                        "image_url"=>  
                        $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->InvDetailVarian,true)
                    );
                }
        }; 
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Tambah Pembelian',
            'menu' => "Sales",
            'po' => $project,
            'store' => $modelsstore->get()->getResult(), 
            'admin' => $modelsuser->get()->getResult(),
            'vendor' => $modelsVendor->get()->getResult(),
            'detail' => $detail, 
        ]; 
        return view('app/02_sales/pembelian/add_view', $data); 
    }


    public function invoice_pembelian_edit($id)
    {     
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $modelinvoice = new InvoiceModel(); 
        $modelpembelian = new PembelianModel(); 
        $modelsproduk = new ProdukModel();
        $modelsVendor = new VendorModel();
        $datapo = $modelpembelian->get_data_pembelian($id);  
        $datainvoice = $modelinvoice->get_data_invoice($datapo->PORef);   
        
        $arr_detail = $modelpembelian->get_data_pembelian_detail($id);  
        $detail = array();  
        foreach($arr_detail as $row){
            if($row->PODetailType == "product" ){
            $detail[] = array(  
                "id" => $row->PODetailId, 
                "produkid" => $row->ProdukId, 
                "satuan_id"=> ($row->PODetailSatuanId == 0 ? "" : $row->PODetailSatuanId),
                "satuan_text"=>$row->PODetailSatuanText, 
                "price"=> $row->PODetailPrice,
                "varian"=> JSON_DECODE($row->PODetailVarian,true),
                "total"=> $row->PODetailTotal ,
                "disc"=> $row->PODetailDisc ,
                "qty_ref"=> $row->PODetailQty, 
                "qty"=> $row->PODetailQty,
                "text"=> $row->PODetailText,
                "group"=> $row->PODetailGroup,
                "type"=> $row->PODetailType,
                "image_url"=>  
                $modelsproduk->getproductimagedatavarian(  $row->ProdukId,$row->PODetailVarian,true)
                    );
                }
        }; 
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Ubah Pembelian',
            'menu' => "Sales",
            'po' => $datapo,
            'store' => $modelsstore->get()->getResult(), 
            'admin' => $modelsuser->get()->getResult(),
            'vendor' => $modelsVendor->get()->getResult(),
            'detail' => $detail, 
        ]; 
        return view('app/02_sales/pembelian/edit_view', $data);  
    }

    
    public function pembelian()
    {    
        $modelsstore = new StoreModel();
        $modelsVendor = new VendorModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Pembelian',
            'menu' => "Inventory",
            'store' => $modelsstore->get()->getResult(),
            'vendor' => $modelsVendor->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/02_sales/pembelian/index', $data); 
    }
    public function accounting(){    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Accounting',
            'menu' => "", 
        ]; 
        return view('app/03_accounting/index', $data); 
    }

    public function paymentrequest(){    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Payment Request',
            'menu' => "Accounting", 
        ]; 
        return view('app/03_accounting/paymentrequest', $data); 
    }

    public function pengiriman()
    {    
        $modelsstore = new StoreModel();
        $modelsVendor = new VendorModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Pengiriman',
            'menu' => "Inventory",
            'store' => $modelsstore->get()->getResult(),
            'vendor' => $modelsVendor->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/02_sales/delivery/index', $data); 
    }

    public function delivery(){    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Delivery',
            'menu' => "Delivery", 
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/delivery/index', $data); 
    }

    
    public function coa(){    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Accounting',
            'menu' => "", 
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/03_accounting/coa/index', $data); 
    }
    public function transaction(){    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Accounting',
            'menu' => "", 
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('app/03_accounting/transaction/index', $data); 
    }

    
    public function produk_add()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Produk add',
            'menu' => "Produk", 
        ]; 
        return view('app/04_master/produk/add_view', $data); 
    }
    // public function chat(){    
    //     $modelsstore = new StoreModel();
    //     $modelsuser = new UserModel();
    //     $project = new  ProjectcategoryModel();
    //     $data = [
    //         'notif' => [],
    //         'session' => $this->session,
    //         'title' => 'Chat',
    //         'menu' => "Chat", 
    //         'store' => $modelsstore->get()->getResult(),
    //         'kategori' => $project->get()->getResult(),
    //         'admin' => $modelsuser->get()->getResult()
    //     ]; 
    //     return view('app/chat/index', $data); 
    // }
    
    
    public function chat(){   
        $nextcloud = new Nextcloud(); 
        $data = [
        'notif' => [],
        'session' => $this->session,
        'title' => 'Delivery',
        'menu' => "Delivery", 
        'files' => $nextcloud->getFileList('/')
        ];

        return view('nextcloud/index', $data);
    }
    
}