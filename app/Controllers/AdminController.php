<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Models\StoreModel;
use App\Models\ProjectcategoryModel;
use App\Models\ProdukvarianModel;
use App\Models\ProdukvarianvalueModel;
use App\Models\VendorModel; 
use App\Models\ProdukcategoryModel;

use \App\Models\AuthgroupModel;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User; 

use Config\Services; 

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
        $this->session = service('session');
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
        return view('admin/dashboard/index', $data);
        
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
        return view('admin/account/index', $data); 
    }
    public function store()
    {   
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Store',
            'menu' => "Master"
        ]; 
        return view('admin/store/index', $data);
        
    }

    public function customer()
    {   
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Customer',
            'menu' => "Master"
        ]; 
        return view('admin/customer/index', $data);
        
    }
    public function vendor()
    {   
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Vendor',
            'menu' => "Master"
        ]; 
        return view('admin/vendor/index', $data);
        
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
        return view('admin/produk/index', $data);
        
    }
    public function project()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'List Project',
            'menu' => "Project",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('admin/project/index', $data); 
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
            'menu' => "Project",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('admin/project/survey/index', $data); 
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
            'menu' => "Project",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('admin/project/sample/index', $data); 
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
            'menu' => "Project",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('admin/project/sph/index', $data); 
    }
    public function invoice()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Invoice',
            'menu' => "Project",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('admin/project/invoice/index', $data); 
    }
    public function pembelian()
    {    
        $modelsstore = new StoreModel();
        $modelsuser = new UserModel();
        $project = new  ProjectcategoryModel();
        $data = [
            'notif' => [],
            'session' => $this->session,
            'title' => 'Pembelian',
            'menu' => "Project",
            'store' => $modelsstore->get()->getResult(),
            'kategori' => $project->get()->getResult(),
            'admin' => $modelsuser->get()->getResult()
        ]; 
        return view('admin/project/po/index', $data); 
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
        return view('admin/accounting/index', $data); 
    }
}
