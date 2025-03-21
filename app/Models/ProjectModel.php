<?php

namespace App\Models; 

use CodeIgniter\Model; 
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;
use CodeIgniter\Database\RawSql;

class ProjectModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'project';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['ProjectName','CustomerId','ProjectDate','StoreId','ProjectCategory','ProjectComment','UserId','ProjectAdmin','ProjectStatus'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

 
    /**
     * FUNCTION UNTUK DATATABLE
     */ 
    public function blog_json($search){
        $db  = \Config\Database::connect();

        $dt = new Datatables(new Codeigniter4Adapter);

        $builder = $this->db->table($this->table);
        $builder->join("customer","customer.CustomerId = project.CustomerId ","left");
        $builder->join("store","store.StoreId = project.StoreId","left");
        
        $builder->select('ProjectId,ProjectDate,store.StoreId,ProjectAdmin,UserId,project.CustomerId,ProjectCategory,ProjectComment,ProjectStatus,StoreLogo,StoreCode,StoreName,CustomerName,CustomerCompany,CustomerAddress');
        $query = $builder->getCompiledSelect();

        $dt->query($query); 

        $dt->add('date_time', function($data){
            
            $date = date_create($data["ProjectDate"]);
            return '<div class="d-flex flex-column gap-1 align-items-center">
                        <span class="text-head-2">'.date_format($date,"d M Y").'</span>
                        <span class="text-detail-2 text-truncate">'.date_format($date,"H:i:s").'</span> 
                    </div>';
        }); 
        $dt->add('status', function($data){
            return '<span class="badge badge-0 badge-rounded">'.$data["ProjectStatus"].'</span>';
        }); 
        $dt->add('comment', function($data){
            return '<span class="badge badge-0 badge-rounded">'.$data["ProjectComment"].'</span>';
        }); 
        $dt->add('store', function($data){
            $category = "";
            foreach (explode("|",$data["ProjectCategory"]) as $index=>$x) {
                $category .= '<span class="badge badge-'.fmod($index, 5).'">'.$x.'</span>';
            }  
            return '<div class="d-flex align-items-center" style="width:10rem">
                    <div class="flex-shrink-0 ">
                        <img src="'.$data["StoreLogo"].'" alt="Gambar" class="image-logo-project">
                    </div>
                    <div class="flex-grow-1 ms-1 ">
                        <div class="d-flex flex-column gap-1">
                            <span class="text-head-2">'.$data["StoreCode"].'</span>
                            <span class="text-detail-2 text-truncate"> 
                                <div class="d-flex flex-wrap gap-1">
                                '.$category.'
                                </div>
                            </span> 
                        </div>
                    </div>
                </div>';
        }); 
        $dt->add('customer', function($data){
            return '
                <div class="d-flex flex-column gap-1" style="width:15rem">
                    <span class="text-head-2">'.$data["CustomerName"].'</span>
                    <span class="text-detail-2 text-truncate">'.$data["CustomerAddress"].'</span> 
                </div>';
        });
        
        $dt->add('action', function($data){
        	return '
                <div class="d-md-flex d-none"> 
                    <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click('.$data["ProjectId"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                    <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click('.$data["ProjectId"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</button> 
                </div>
                <div class="d-md-none d-flex btn-action"> 
                    <div class="dropdown">
                        <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-more-alt icon-rotate-45"></i>
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$data["ProjectId"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                            <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$data["ProjectId"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                        </ul>
                    </div>
                </div> 
                ';
        });  
        $dt->add('head_mobile', function($data){
            $category = "";
            foreach (explode("|",$data["ProjectCategory"]) as $index=>$x) {
                $category .= '<span class="badge badge-'.fmod($index, 5).'">'.$x.'</span>';
            }  
            $date = date_create($data["ProjectDate"]);
      
            $html = '
                <div class="card shadow-sm my-2 mobile p-0">
                    <div class="card-body p-2">
                        <div class="d-flex align-items-center w-100" style="width:10rem">
                            <div class="flex-shrink-0 ">
                                <img src="'.$data["StoreLogo"].'" alt="Gambar" class="image-logo-project">
                            </div>
                            <div class="flex-grow-1 ms-1 "> 
                                <span class="text-detail-3">'.$data["StoreCode"].'</span>  
                                <div class="divider d-inline-block"></div>
                                <span class="text-detail-3">'.date_format(date_create($data["ProjectDate"]),"d M Y").'</span>
                                <div class="divider d-inline-block d-none"></div>
                                <div class="text-success d-none">
                                    <i class="fa-solid fa-circle" style="font-size:0.5rem"></i>
                                    <span class="text-detail-3 ">New</span>
                                </div>
                                <div class="divider d-inline-block"></div>
                                <span class="text-detail-3">'.$data["ProjectAdmin"].'</span>   
                            </div>
                            <div class="ms-auto"> 
                                <div class="dropdown">
                                    <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti-more-alt icon-rotate-45"></i>
                                    </a>
                                    <ul class="dropdown-menu shadow">
                                        <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$data["ProjectId"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$data["ProjectId"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-100 gap-1 py-1">'.$category.'</div>
                        <div class="text-head-2 py-1">'.$data["CustomerName"].($data["CustomerCompany"] == "" ? : " (".$data["CustomerCompany"].")").'</div> 
                    </div>
                    <div class="card-footer p-0 bg-white">
                        <div class="d-flex project-menu mobile justify-content-around">
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="survey">
                                <i class="fa-solid fa-list-check position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Survey</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="rab">
                                <i class="fa-solid fa-list position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">RAB</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="penawaran">
                                <i class="fa-solid fa-hand-holding-droplet position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Penawaran</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="pembelian">
                                <i class="fa-solid fa-cart-shopping position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Pembelian</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="invoice">
                                <i class="fa-solid fa-money-bill position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Invoice</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="documentasi">
                                <i class="fa-solid fa-folder-open position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Dokumentasi</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="diskusi">
                                <i class="fa-regular fa-comments position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Diskusi</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center flex-column align-items-center" style="display:none">
                            <div class="tab-content mobile  w-100" data-id="'.$data["ProjectId"].'" style="display:none">
                                <div class="d-flex justify-content-center flex-column align-items-center">
                                    <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                                    <span>Belum ada data yang dibuat</span>
                                    <button class="btn btn-sm btn-primary px-3 rounded mt-4" onclick="add_penawaran_click('.$data["ProjectId"].',this)"><i class="fa-solid fa-plus pe-2"></i>Buat Penawaran</button>
                                </div> 
                            </div>
                            <div class="loading text-center loading-content p-4" data-id="'.$data["ProjectId"].'"  style="display:none">
                                <div class="loading-spinner"></div>
                                <div class="d-flex justify-content-center flex-column align-items-center">
                                    <span>Sedang memuat data</span> 
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                ';
            return $html;
        });
        $dt->add('html', function($data){ 
        	return '  
            <div class="project-detail">
                <div class="d-flex">
                    <div class="side-menu" data-id="'.$data["ProjectId"].'">
                        <div class="d-flex flex-column project-menu">
                            <div class="menu-item selected" data-id="'.$data["ProjectId"].'" data-menu="survey">
                                <i class="fa-solid fa-list-check position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Survey</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="rab">
                                <i class="fa-solid fa-list position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">RAB</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="penawaran">
                                <i class="fa-solid fa-hand-holding-droplet position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Penawaran</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="pembelian">
                                <i class="fa-solid fa-cart-shopping position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Pembelian</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="penerimaan">
                                <i class="fa-solid fa-cart-shopping position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Penerimaan</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="invoice">
                                <i class="fa-solid fa-money-bill position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Invoice</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="pengiriman">
                                <i class="fa-solid fa-truck position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Pengiriman</span>
                            </div> 
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="documentasi">
                                <i class="fa-solid fa-dollar position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Keuangan</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="documentasi">
                                <i class="fa-solid fa-folder-open position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Dokumentasi</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["ProjectId"].'" data-menu="diskusi">
                                <i class="fa-regular fa-comments position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Diskusi</span>
                            </div>
                        </div>
                        <button class="btn-side-menu" data-id="'.$data["ProjectId"].'"><i class="fa-solid fa-angle-left"></i></button>
                    </div>
                    <div class="flex-fill border-left">
                        <div class="tab-content" data-id="'.$data["ProjectId"].'" style="display:none">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                                <span>Belum ada data yang dibuat</span>
                                <button class="btn btn-sm btn-primary px-3 rounded mt-4" onclick="add_penawaran_click('.$data["ProjectId"].',this)"><i class="fa-solid fa-plus pe-2"></i>Buat Penawaran</button>
                            </div> 
                        </div>
                        <div class="d-flex justify-content-center flex-column align-items-center" style="display:none">
                            <div class="loading text-center loading-content pt-4 mt-4" data-id="'.$data["ProjectId"].'">
                                <div class="loading-spinner"></div>
                                <div class="d-flex justify-content-center flex-column align-items-center">
                                    <span>Sedang memuat data</span> 
                                </div>
                            </div> 
                        </div>
                         
                    </div>
                </div>
            </div>';
        }); 

        return $dt->generate();
    }

    public function load_table_project($filter = null){
        $builder = $this->db->table($this->table);
        $builder->join("customer","customer.CustomerId = project.CustomerId ","left");
        $builder->join("store","store.StoreId = project.StoreId","left"); 
        
        if($filter["datestart"] !== "") $builder->where("ProjectDate >=",$filter["datestart"]);
        if($filter["dateend"] !== "") $builder->where("ProjectDate <=",$filter["dateend"]);

        if(isset($filter["filter"]["store"])){
            $builder->whereIn("project.StoreId",$filter["filter"]["store"]);
        } 
        if(isset($filter["filter"]["kategori"])){
            foreach($filter["filter"]["kategori"] as $row){
                $builder->orLike("ProjectCategory",'%'.$row.'%');
            } 
        }   
        if(isset($filter["filter"]["user"])){
            $builder->groupStart(); 
            foreach($filter["filter"]["user"] as $row){
                $builder->orLike("UserId",$row);
            } 
            $builder->groupEnd(); 
        }
        $builder->groupStart(); 
        if(isset($filter["search"])){
            $builder->like("ProjectAdmin",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("ProjectName",$filter["search"]);
            $builder->orLike("ProjectCategory",$filter["search"]);
        }

        $builder->groupEnd(); 
        $builder->where("ProjectStatus !=",2);
        $builder->orderby('ProjectDate', 'DESC'); 

        $perPage = 10;
        $page = $filter["paging"]; // atau dapatkan dari parameter GET 
        $offset = ($page - 1) * $perPage; 
        $builder->limit($perPage, $offset);

        $query = $builder->get();  
        $count = $query->getNumRows();
        $html = "";
        foreach($query->getResult() as $row){  
            $category = "";
            foreach (explode("|",$row->ProjectCategory) as $index=>$x) {
                $category .= '<span class="badge badge-'.fmod($index, 5).' me-1">'.$x.'</span>';
            }  
            $date = date_create($row->ProjectDate);
            if($row->ProjectDateEnd == null){ 
                $dateEnd = "-";
            }else{
                $dateEnd = date_create($row->ProjectDateEnd);
                $dateEnd = date_format($dateEnd,"d M Y").', '.date_format($dateEnd,"H:i:s");
            }

            //ALERT SAMPLE  
            $alertsample = $this->data_project_sample_notif($row->ProjectId);
            $emessage = "<b>Sample Barang</b><br>";
            $alertsamplemessage = "";
            $no = 1;
            foreach($alertsample as $row_sample){
                $emessage .= "<i class='fa-solid fa-circle fs-8'></i> ".$row_sample["message"]."<br>";
                $no++;
            } 
            $alertsamplemessage = 'data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="'.$emessage.'"';

            //ALERT PENAWRAN
            $alertpenawaran = $this->data_project_sph_notif($row->ProjectId);
            $emessage = "<b>Penawaran</b><br>";
            $alertpenawaranmessage = "";
            $no = 1;
            foreach($alertpenawaran as $row_sample){
                $emessage .= "<i class='fa-solid fa-circle fs-8'></i> ".$row_sample["message"]."<br>";
                $no++;
            } 
            $alertpenawaranmessage = 'data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="'.$emessage.'"';


            //ALERT INVOICE
            $alertinvoice = $this->data_project_invoice_notif($row->ProjectId);
            $emessage = "<b>invoice</b><br>";
            $alertinvoicemessage = "";
            $no = 1;
            foreach($alertinvoice as $row_sample){
                $emessage .= "<i class='fa-solid fa-circle fs-8'></i> ".$row_sample["message"]."<br>";
                $no++;
            } 
            $alertinvoicemessage = 'data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="'.$emessage.'"';
            
            //ALERT DELIVERY
            $alertdelivery = $this->data_project_delivery_notif($row->ProjectId);
            $emessage = "<b>Pengiriman</b><br>";
            $alertdeliverymessage = "";
            $no = 1;
            foreach($alertdelivery as $row_sample){
                $emessage .= "<i class='fa-solid fa-circle fs-8'></i> ".$row_sample["message"]."<br>";
                $no++;
            } 
            $alertdeliverymessage = 'data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="'.$emessage.'"';


            $html .= '<div class="card project" data-id="'.$row->ProjectId.'"> 
                <div class="card-body p-1"> 
                    <div class="row header p-1 align-items-sm-end align-items-start">
                        <div class="col-md-3 col-10 order-0 project-store d-flex-column mb-md-0 mb-2"> 
                            <div class="d-flex align-items-start ">
                                <div class="flex-shrink-0 ">
                                    <img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">
                                </div>
                                <div class="flex-grow-1 ms-1">
                                    <div class="d-flex flex-column">
                                        <span class="text-head-2">'.$row->StoreCode.' - '.$row->StoreName.'</span>
                                        <span class="text-detail-2 text-truncate overflow-x-auto">'.$category.'</span>
                                        <div><i class="fa-regular fa-user pe-2"></i><span class="text-detail-2 text-truncate overflow-x-auto">'.$row->ProjectAdmin.'</span></div>  
                                        <div class="text-detail-2 text-truncate overflow-x-auto"><i class="fa-solid fa-address-card pe-2"></i><span class="text-detail-2">'.$row->CustomerName.' '.$row->CustomerCompany.'</span></div>  
                                  </div>   
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-2 col-6 border-sm-top-1 order-2 order-sm-1">
                            <div class="d-flex flex-column">
                                <span class="text-head-2">'.$row->ProjectName.'</span>
                                <span class="text-detail-2 text-truncate overflow-x-auto">Catatan : '.$row->ProjectComment.'</span> 
                            </div> 
                        </div>  
                        <div class="col-md-2 col-6 border-sm-top-1 order-3 order-sm-2">
                            <div class="d-flex flex-column">
                                <span class="text-detail-2"><i class="fa-regular fa-calendar-check pe-2"></i>'.date_format($date,"d M Y").', '.date_format($date,"H:i:s").'</span>  
                                <span class="text-detail-2"><i class="fa-regular fa-calendar-xmark pe-2"></i>'.$dateEnd.'</span>  
                            </div> 
                        </div>   
                        <div class="col-md-4 col-12 border-sm-top-1 order-4 order-sm-3" data-id="'.$row->ProjectId.'">
                            <span class="text-head-3" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-title="click icon dibawah ini untuk melihat detail project">DETAIL PROJECT : </span> 
                            <div class="d-flex icon-data p-2 text-head-1 gap-1 overflow-x-auto custom-overflow">
                                <i data-id="'.$row->ProjectId.'" data-menu="sample" class="fa-solid fa-truck-ramp-box position-relative header notif '.(count($alertsample) > 0 ? "active" : "").'" '.$alertsamplemessage.'>
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <i data-id="'.$row->ProjectId.'" data-menu="penawaran" class="fa-solid fa-hand-holding-droplet position-relative header notif '.(count($alertpenawaran) > 0 ? "active" : "").'" '.$alertpenawaranmessage.'>
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <i data-id="'.$row->ProjectId.'" data-menu="invoice" class="fa-solid fa-money-bill position-relative header notif '.(count($alertinvoice) > 0 ? "active" : "").'" '.$alertinvoicemessage.'>
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <i data-id="'.$row->ProjectId.'" data-menu="pengiriman" class="fa-solid fa-truck position-relative header notif '.(count($alertdelivery) > 0 ? "active" : "").'" '.$alertdeliverymessage.'>
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <i data-id="'.$row->ProjectId.'" data-menu="pembelian" class="fa-solid fa-cart-shopping position-relative header notif">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <div class="vr" style="padding: 0.05rem;"></div>
                                <i data-id="'.$row->ProjectId.'" data-menu="keuangan" class="fa-solid fa-dollar position-relative header notif">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <div class="vr" style="padding: 0.05rem;"></div> 
                                <i data-id="'.$row->ProjectId.'" data-menu="survey" class="fa-solid fa-list-check position-relative header notif">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <i data-id="'.$row->ProjectId.'" data-menu="rab" class="fa-solid fa-list position-relative header notif">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <div class="vr" style="padding: 0.05rem;"></div>
                                <i data-id="'.$row->ProjectId.'" data-menu="documentasi" class="fa-solid fa-folder-open position-relative header notif">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <i data-id="'.$row->ProjectId.'" data-menu="diskusi" class="fa-solid fa-comments position-relative header notif">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle icon-notif"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                            </div> 
                        </div> 
                        <div class="col-md-1 col-2 order-1 order-sm-4 align-self-start">  
                            
                            <div class="dropdown text-end">
                                <a class="text-head-2 text-decoration-none close-project" type="button" data-id="'.$row->ProjectId.'" style="display:none"><i class="pe-1 fa-solid fa-close text-head-2" style="color:#305176"></i>Close</a>
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45 text-primary"></i>
                                </a>
                                <ul class="dropdown-menu shadow">
                                    <li><a class="dropdown-item m-0 px-2 " onclick="edit_click('.$row->ProjectId.',this)"><i class="fa-solid fa-pencil pe-2 text-warning"></i>Edit</a></li>
                                    <li><a class="dropdown-item m-0 px-2 " onclick="delete_click('.$row->ProjectId.',this)"><i class="fa-solid fa-close pe-2 text-danger"></i>Delete</a></li> 
                                </ul>
                            </div> 
                        </div>  
                    </div>   
                    <div class="content-data overflow-y-auto" data-id="'.$row->ProjectId.'" style="display: none;">
                        <div class="tab-content" data-id="'.$row->ProjectId.'"></div>
                        <div class="d-flex justify-content-center flex-column align-items-center d-none" style="display:none;background:#F5F7FF;height:100%">
                            <div class="loading text-center loading-content pt-4 mt-4" data-id="'.$row->ProjectId.'" style="display: none;">
                                <div class="loading-spinner"></div>
                                <div class="d-flex justify-content-center flex-column align-items-center">
                                    <span>Sedang memuat data</span> 
                                </div>
                            </div> 
                        </div>  
                    </div> 
                </div>
            </div>';
        }

        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Tidak ada data yang ditemukan</span> 
                </div> 
            ';
        }
        $html .= '
        <script>
            var tooltipTriggerList = document.querySelectorAll(\'[data-bs-toggle="tooltip"]\')
            var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
 
        </script>
        ';


        $builder = $this->db->table($this->table);
        $builder->join("customer","customer.CustomerId = project.CustomerId ","left");
        $builder->join("store","store.StoreId = project.StoreId","left"); 
        
        if($filter["datestart"] !== "") $builder->where("ProjectDate >=",$filter["datestart"]);
        if($filter["dateend"] !== "") $builder->where("ProjectDate <=",$filter["dateend"]);

        if(isset($filter["filter"]["store"])){
            $builder->whereIn("project.StoreId",$filter["filter"]["store"]);
        } 
        if(isset($filter["filter"]["kategori"])){
            foreach($filter["filter"]["kategori"] as $row){
                $builder->orLike("ProjectCategory",'%'.$row.'%');
            } 
        }   
        if(isset($filter["filter"]["user"])){
            $builder->groupStart(); 
            foreach($filter["filter"]["user"] as $row){
                $builder->orLike("UserId",$row);
            } 
            $builder->groupEnd(); 
        }
        $builder->groupStart(); 
        if(isset($filter["search"])){
            $builder->like("ProjectAdmin",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("ProjectName",$filter["search"]);
            $builder->orLike("ProjectCategory",$filter["search"]);
        } 
        $builder->groupEnd(); 

        $countTotal = $builder->get()->getNumRows();
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html,
                "total"=>$countTotal,
                "totalresult"=>$count,
                "paging"=>$offset, 
            )
        );


    }

    public function load_data_project($id){
        $builder = $this->db->table($this->table); 
        $builder->join('customer', 'customer.id = customerid', 'left'); 
        $builder->join('store', 'store.StoreId = project.storeid', 'left'); 
        $builder->where("project.id",$id);
        return $builder->get()->getRow();
    }

    public function load_data_project_tab($data){
        switch ($data["type"]) {
            case "sample":
                return $this->data_project_sample($data["ProjectId"]);
                break; 
            case "penawaran":
                return $this->data_project_sph($data["ProjectId"]);
                break;  
            case "invoice":
                return $this->data_project_invoice($data["ProjectId"]);
                break; 

            case "pengiriman":
                return $this->data_project_delivery($data["ProjectId"]);
                break; 

            case "pembelian":
                return $this->data_project_po($data["ProjectId"]);
                break; 
                
            case "penerimaan":
                return $this->data_project_po($data["ProjectId"]);
                break; 

            case "survey":
                return $this->data_project_survey($data["ProjectId"]);
                break; 

            case "rab":
                return $this->data_project_rab($data["ProjectId"]);
                break; 



            case "documentasi":
                return $this->data_project_documentasi($data["ProjectId"]);
                break; 

            case "diskusi":
                return $this->data_project_diskusi($data["ProjectId"]);
                break; 
                ; 

            case "keuangan":
                return $this->data_project_keuangan($data["ProjectId"]);
                break;
            default: 
                $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="https://localhost/mahiera/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                <span>Belum ada data yang dibuat</span>
               
            </div> 
            ';
            return json_encode(
                array(
                    "status"=>true,
                    "html"=>$html
                )
            );
        } 
      
    }

    public function insert_data_template_footer($data){  

        $builder = $this->db->table("template_footer");
        $builder->insert(array(
            "TemplateFooterName"=> $data["TemplateFooterName"],
            "TemplateFooterDetail"=> $data["TemplateFooterDetail"],
            "TemplateFooterDelta"=> JSON_ENCODE($data["TemplateFooterDelta"]), 
            "TemplateFooterCategory"=> $data["TemplateFooterCategory"],
        ));  

         // GET ID PRODUK 
        $builder = $this->db->table("template_footer");
        $builder->select('*'); 
        $builder->orderby('TemplateFooterId', 'DESC');
        $builder->limit(1);
        return $builder->get()->getRow();
    }
    public function update_data_template_footer($data,$id){   
        $builder = $this->db->table("template_footer");
        $builder->set('TemplateFooterName', $data["TemplateFooterName"]);
        $builder->set('TemplateFooterDetail', $data["TemplateFooterDetail"]); 
        $builder->set('TemplateFooterCategory', $data["TemplateFooterCategory"]); 
        $builder->set('TemplateFooterDelta', JSON_ENCODE($data["TemplateFooterDelta"]));
        $builder->where('TemplateFooterId', $id); 
        $builder->update(); 
    }
    public function get_data_template_footer($id){
        $builder = $this->db->table("template_footer");
        $builder->where('TemplateFooterId',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    }
 
    /**
     * FUNCTION UNTUK MENU PROJECT
     */ 

   
    private function data_project_sample($project_id){
        $html = ""; 
        $builder = $this->db->table("sample");
        $builder->select('*');
        $builder->where('ProjectId',$project_id);
        $builder->where('SampleStatus !=',2);
        $builder->orderby('SampleId', 'DESC'); 
        $query = $builder->get()->getResult();  

        foreach($query as $row){ 
            $builder = $this->db->table("sample_detail");
            $builder->select('*'); 
            $builder->where('SampleDetailRef',$row->SampleId);
            $builder->orderby('SampleDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A";

            $builder = $this->db->table("penawaran");
            $builder->select('*');
            $builder->where('SampleId',$row->SampleId); 
            $builder->orderby('SphId', 'DESC'); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                $alert = ' 
                    <script>
                        function sample_return_click_'.$project_id.'_'.$queryref->SphId.'(){
                            $("i[data-menu=\'penawaran\'][data-id=\''.$project_id.'\'").trigger("click");
                            setTimeout(function() {
                                $("html, body").scrollTop($(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").offset().top - 200); 
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").removeClass("show"); 
                                    }, 1000); // delay 1 detik
                                })

                            }, 1000); // delay 1 detik
                        }
                    </script>
                    <div class="alert alert-success p-2 m-1" role="alert"> 
                    <span class="text-head-2">
                        <i class="fa-solid fa-check text-success pe-0 me-2 text-success" style="font-size:0.75rem"></i>
                        Sample berhasil diteruskan ke penawaran, dengan No. Penawaran :  <a class="text-head-2" style="cursor:pointer" onclick="sample_return_click_'.$project_id.'_'.$queryref->SphId.'()">'.$queryref->SphCode.'</a>  
                    </span> 
                </div>';
            }else{
                $builder = $this->db->table("invoice");
                $builder->select('*');
                $builder->where('SampleId',$row->SampleId); 
                $builder->orderby('InvId', 'DESC'); 
                $queryref = $builder->get()->getRow();   
                if($queryref){
                    $alert = ' 
                    <script>
                        function sample_return_click_'.$project_id.'_'.$queryref->InvId.'(){
                            $("i[data-menu=\'invoice\'][data-id=\''.$project_id.'\'").trigger("click");
                            setTimeout(function() {
                                $("html, body").scrollTop($(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").offset().top - 200); 
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").removeClass("show"); 
                                    }, 1000); // delay 1 detik
                                })

                            }, 1000); // delay 1 detik
                        }
                    </script>
                    <div class="alert alert-success p-2 m-1" role="alert"> 
                    <span class="text-head-2">
                        <i class="fa-solid fa-check text-success pe-0 me-2 text-success" style="font-size:0.75rem"></i>
                        Sample berhasil diteruskan ke invoice, dengan No. Invoice :  <a class="text-head-2" style="cursor:pointer" onclick="sample_return_click_'.$project_id.'_'.$queryref->InvId.'()">'.$queryref->InvCode.'</a>  
                    </span> 
                </div>';
                }else{
                    $alert = '<div class="alert alert-primary p-2 m-1" role="alert"> 
                        <span class="text-head-2">
                            <i class="fa-solid fa-reply me-2 fa-rotate-180" style="font-size:0.75rem"></i>
                            Teruskan sample ini ke 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_sph('.$project_id.',this,'.$row->SampleId.')">penawaran</a> 
                            atau langsung ke pembuatan 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_invoice('.$project_id.',this,'.$row->SampleId.',\'sample\')">invoice</a>
                        </span> 
                    </div>'; 
                }
            }

            foreach($items as $item){

                $folder = 'assets/images/produk/'.$item->ProdukId."/";
                $default = 'assets/images/produk/default.png';
    
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);  
                } 
                $files = array_diff(scandir($folder), array('.', '..')); 
                $gambar = null;
    
                foreach ($files as $file) {
                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        $gambar = $folder . $file;
                        break;
                    }
                }  

                $arr_varian = json_decode($item->SampleDetailVarian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }

                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-4 my-1 varian">   
                        <div class="d-flex gap-2"> 
                            ' . ($item->SampleDetailType == "product" ? ($gambar ? "<img src='".base_url().$gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url().$default."' alt='Gambar Default'>") : "").'  
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase"  '.($item->SampleDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SampleDetailText.'</span>
                                <span class="text-detail-2 text-truncate"  '.($item->SampleDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SampleDetailGroup.'</span> 
                                <div class="d-flex flex-wrap gap-1">
                                    '.$arr_badge.'
                                </div>
                            </div> 
                        </div>
                    </div>';
                if($item->SampleDetailType == "product"){
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail">
                                        <div class="row"> 
                                            <div class="col-6 col-md-2">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->SampleDetailQty, 2, ',', '.').' '.$item->SampleDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Harga satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SampleDetailPrice, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Disc satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SampleDetailDisc, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Total:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SampleDetailTotal, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                        </div>   
                                    </div> 
                                </div>';
                    $no++;
                }else{
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail"></div></div>';
                    $huruf++;
                    $no = 1;
                }
                     
                
            }


            $html_payment = "";
            $payment_total = 0;
            if($row->SampleGrandTotal == 0){
                $html_payment = '<div class="alert alert-success p-2 m-1" role="alert"> 
                <span class="text-head-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran yang harus diselesaikan untuk transaksi ini 
                </span> 
                </div>';
            }else{
                $builder = $this->db->table("payment");
                $builder->select('*'); 
                $builder->where('SampleId',$row->SampleId);
                $builder->orderby('PaymentId', 'ASC'); 
                $payment = $builder->get()->getResult(); 
                $html_payment = "";
                $payment_total = 0;
                $performa_total = 0; 
                foreach($payment as $row_payment){ 
                    if($row_payment->PaymentDoc == "1"){
                        $payment_total += $row_payment->PaymentTotal;
                    }else{
                        $performa_total += $row_payment->PaymentTotal;
                    } 
                    if($row_payment->PaymentStatus == "0"){
                        $status = '<span class="text-head-3 text-warning">
                        <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                            <i class="fa-solid fa-certificate fa-stack-2x"></i> 
                            <i class="fa-solid fa-exclamation fa-stack-1x fa-inverse"></i>
                        </span>Pending</span>';
                        $status = '<span class="text-head-3 text-warning">Pending</span>';
                    }else{
                        $status = ' <span class="text-head-3 text-success">
                        <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                            <i class="fa-solid fa-certificate fa-stack-2x"></i>
                            <i class="fa-solid fa-check text-success fa-stack-1x fa-inverse"></i>
                        </span>Verified</span>';
                        $status = '<span class="text-head-3 text-success">Terverifikasi</span>';
                    }
                    $html_payment .= '<div class="mb-1 p-1">  
                                    <div class="row mx-2"> 
                                        <div class="col-12 col-md-1 order-2 order-sm-1 p-0"> 
                                            <div class="d-flex flex-row flex-md-column justify-content-between"> 
                                                <span class="text-detail-2"><i class="fa-solid fa-check text-success pe-1"></i>Status</span>
                                                '.$status.'
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-1 order-3 order-sm-2 p-0"> 
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                                                <span class="text-head-3">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</span>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-1 order-4 order-sm-3 p-0"> 
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-layer-group pe-1"></i>Type</span>
                                                <span class="text-head-3">'.$row_payment->PaymentType.'</span>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-1 order-5 order-sm-4 p-0">
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-credit-card pe-1"></i>Method</span>
                                                <span class="text-head-3">'.$row_payment->PaymentMethod.'</span>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-2 order-6 order-sm-5 p-0">
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-wallet pe-1"></i>Total</span>
                                                <span class="text-head-3">Rp. '.number_format($row_payment->PaymentTotal).'</span>
                                            </div>   
                                        </div>
                                        <div class="col-12 col-md-6 text-end order-1 order-sm-5 p-0"> 
                                            
                                            <div class="d-none d-md-inline-block"> 
                                                <button class="btn btn-sm btn-primary btn-action rounded border '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->SampleId.','.$row_payment->PaymentId.',this,\'sample\')">
                                                    <i class="fa-solid fa-eye mx-1"></i><span>Lihat Bukti</span>
                                                </button>
                                                <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')">
                                                    <i class="fa-solid fa-print mx-1"></i><span>Cetak</span>
                                                </button>
                                                <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')">
                                                    <i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
                                                </button>
                                                <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_payment('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')">
                                                    <i class="fa-solid fa-close mx-1"></i><span>Hapus</span>
                                                </button> 
                                            </div>
                                            <div class="d-flex  d-md-none justify-content-between"> 
                                                <span class="text-head-2 pt-auto"><i class="fa-solid fa-money-check-dollar pe-2"></i>'.($row_payment->PaymentDoc == "1" ? "Payment" : "Proforma" ).'</span>
                                                <div class="dropdown">
                                                    <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti-more-alt icon-rotate-45"></i>
                                                    </a>
                                                    <ul class="dropdown-menu shadow">
                                                        <li><a class="dropdown-item m-0 px-2 '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->SampleId.','.$row_payment->PaymentId.',this,\'sample\')"><i class="fa-solid fa-eye pe-2"></i>Lihat Bukti</a></li>
                                                        <li><a class="dropdown-item m-0 px-2" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')"><i class="fa-solid fa-dollar pe-2"></i>Cetak</a></li>  
                                                        <li><a class="dropdown-item m-0 px-2" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                                        <li><a class="dropdown-item m-0 px-2" onclick="delete_project_payment('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                } 
                if($html_payment == ""){
                    $html_payment = '<div class="alert alert-warning p-2 m-1" role="alert"> 
                            <span class="text-head-2">
                                <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                                Belum ada data pembayaran yang dibuat, Silahkan tambahkan data  
                                <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$project_id.','.$row->SampleId.',this,\'sample\')">Pembayaran</a>
                            </span> 
                        </div>';
                }elseif($payment_total < $row->SampleGrandTotal){
                    $html_payment .= '
                    <div class="alert alert-warning p-2 m-1" role="alert"> 
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Masih ada sisa pembayaran yang belum diselesaikan, Silahkan buat data  
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$project_id.','.$row->SampleId.',this,\'sample\')">Pembayaran</a>
                        </span> 
                    </div>';
                }
            }

            $html_delivery = "";
            $builder = $this->db->table("delivery");
            $builder->select('*');   
            $builder->where("SampleId",$row->SampleId);
            $builder->orderby('DeliveryId', 'ASC'); 
            $delivery = $builder->countAllResults();
            if($delivery == 0){
                $html_delivery = ' 
                    <div class="alert alert-warning p-2 m-1" role="alert">
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Belum ada data pengiriman yang dibuat dari dokumen ini, 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_delivery('.$project_id.','.$row->SampleId.',this,\'sample\')">Buat Data Pengiriman</a> 
                        </span>
                    </div>';
            }else{
                $html_delivery = ' 
                <div class="alert alert-success p-2 m-1" role="alert">
                    <span class="text-head-2">
                        <i class="fa-solid fa-check text-success me-2" style="font-size:0.75rem"></i>
                        ada '.$delivery .' data pengiriman yang dibuat dari Sample ini, 
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick=\'$("i[data-menu=\"pengiriman\"][data-id=\"'.$project_id.'\"]").trigger("click")\'>Lihat Selengkapnya</a> atau
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_delivery('.$project_id.','.$row->SampleId.',this,\'sample\')">Tambah Data Pengiriman</a> 
                    </span>
                </div>';
            }
            

            $html .= '
            <div class="list-project mb-4 p-2">
                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">
                    <div class="col-12 col-sm-3 col-xl-2 order-1 order-sm-0">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Penawaran</span>
                            <span class="text-head-3">'.$row->SampleCode.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-2 col-xl-2 order-2 order-sm-1"> 
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                            <span class="text-head-3">'.date_format(date_create($row->SampleDate),"d M Y").'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-xl-4 order-3 order-sm-2 pb-2">
                        <div class="d-flex flex-column justify-content-between">
                            <span class="text-detail-2 pb-1 pb-md-0"><i class="fa-solid fa-location-dot pe-1"></i> Alamat</span>
                            <span class="text-head-3 text-wrap">'.$row->SampleAddress.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-7 col-xl-4 order-0 order-sm-3">
                        <div class="float-end d-md-flex d-none gap-1"> 
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_sample('.$project_id.','.$row->SampleId.',this)">
                                <i class="fa-solid fa-print mx-1"></i><span >Cetak</span>
                            </button> 
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_sample('.$project_id.','.$row->SampleId.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Ubah</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_sample('.$project_id.','.$row->SampleId.',this)">
                                <i class="fa-solid fa-close mx-1"></i><span >Hapus</span>
                            </button> 
                        </div> 
                        <div class="d-md-none d-flex btn-action justify-content-between"> 
                            <div class="text-head-1">Sample Barang</div>
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow"> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_sample('.$project_id.','.$row->SampleId.',this)"><i class="fa-solid fa-print pe-2"></i>Cetak</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_sample('.$project_id.','.$row->SampleId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_sample('.$project_id.','.$row->SampleId.',this)"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div> 
                </div> 
                <div class="border-top pt-2 mb-2 gap-2 align-items-center pt-2 justify-content-between">  
                     '.$alert.' 
                </div>
                <div class="detail-item p-2 border-top">
                    '.$html_items.' 
                </div>
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center flex-wrap">   
                    <span class="text-detail-2">Sub Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleSubTotal, 0, ',', '.').'</span>  
                    <div class="vr"></div>
                    <span class="text-detail-2">Disc Item:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleDiscItemTotal, 0, ',', '.').'</span>   
                    <div class="vr"></div>
                    <span class="text-detail-2">Disc Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleDiscTotal, 0, ',', '.').'</span>   
                    <div class="vr"></div>
                    <span class="text-detail-2">Grand Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleGrandTotal, 0, ',', '.').'</span> 
                </div>
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center pt-2 justify-content-between">  
                    <span class="text-head-2"><i class="fa-solid fa-money-bill pe-2"></i>Rincian Pembayaran</span> 
                </div>
                '.$html_payment.' 
                <div class="d-flex border-top mt-2 pt-2 m-1 gap-2 align-items-center pt-2 justify-content-between">  
                    <span class="text-head-2"><i class="fa-solid fa-truck pe-2"></i>Rincian Pengiriman</span> 
                </div>
                '.$html_delivery.'  
            </div> 
            ';
        }

        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Belum ada data yang dibuat</span> 
                </div> 
            ';
        }
        $html .= '   <div class="d-flex justify-content-center flex-column align-items-center">
                        <button class="btn btn-sm btn-primary px-3 m-2" onclick="add_project_sample(\''.$project_id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data sample barang</button>
                    </div>';

        return json_encode(
            array(
                "status"=>true,
                "html"=>$html 
            )
        );
    }
    private function data_project_sample_notif($project_id){
        $alert = array();

        $builder = $this->db->table("sample");
        $builder->select('*');
        $builder->where('ProjectId',$project_id);
        $builder->where('SampleStatus !=',2);
        $builder->orderby('SampleId', 'DESC'); 
        $query = $builder->get()->getResult();  
        foreach($query as $row){ 
            if($row->SampleGrandTotal > 0){
                $builder = $this->db->table("payment");
                $builder->select('sum(PaymentTotal) as total');  
                $builder->where('PaymentDoc',"1");
                $builder->where('SampleId',$row->SampleId);
                $builder->orderby('PaymentId', 'ASC'); 
                $payment = $builder->get()->getRow()->total; 
                if($payment < $row->SampleGrandTotal){
                    $alert[] = array(
                        "type"=>"Payment",
                        "message"=>"pembayaran ". $row->SampleCode ." belum dibuat"
                    );
                } 
            }
            $builder = $this->db->table("delivery");
            $builder->select('*');   
            $builder->where("SampleId",$row->SampleId);
            $builder->orderby('DeliveryId', 'ASC'); 
            $delivery = $builder->countAllResults();
            if($delivery == 0){
                $alert[] = array(
                    "type"=>"Pengiriman",
                    "message"=>"Pengiriman ".$row->SampleCode." belum dibuat"
                );
            }else{
                $builder = $this->db->table("delivery");
                $builder->select('*');   
                $builder->where("SampleId",$row->SampleId);
                $builder->where("DeliveryStatus <",2);
                $builder->orderby('DeliveryId', 'ASC'); 
                $delivery = $builder->countAllResults();
                if($delivery == 0){
                    $alert[] = array(
                        "type"=>"Delivery",
                        "message"=>"Pengiriman ".$row->SampleCode." belum diselesaikan"
                    );
                }
            }
        }
        return $alert;
    }
    private function data_project_sph($projectId){
        $html = ""; 
        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->where('ProjectId',$projectId);
        $builder->where('SphStatus !=',2);
        $builder->orderby('SphId', 'DESC'); 
        $query = $builder->get()->getResult();  

        foreach($query as $row){

            $builder = $this->db->table("penawaran_detail");
            $builder->select('*'); 
            $builder->where('SphDetailRef',$row->SphId);
            $builder->orderby('SphDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A";

            $builder = $this->db->table("invoice");
            $builder->select('*');
            $builder->where('SphId',$row->SphId); 
            $builder->orderby('InvId', 'DESC'); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                $alert = ' 
                    <script>
                        function penawaran_return_click_'.$projectId.'_'.$queryref->InvId.'(){
                            $("i[data-menu=\'invoice\'][data-id=\''.$projectId.'\'").trigger("click");
                            setTimeout(function() {
                                $("html, body").scrollTop($(".list-project[data-project=\''.$projectId.'\'][data-id=\''.$queryref->InvId.'\'").offset().top - 200); 
                                $(".list-project[data-project=\''.$projectId.'\'][data-id=\''.$queryref->InvId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$projectId.'\'][data-id=\''.$queryref->InvId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$projectId.'\'][data-id=\''.$queryref->InvId.'\'").removeClass("show"); 
                                    }, 1000); // delay 1 detik
                                })

                            }, 1000); // delay 1 detik
                        }
                    </script>
                    <div class="alert alert-success p-2 m-1" role="alert">
                        <span class="text-head-2"><i class="fa-solid fa-check text-success me-2 text-success"></i>Penawaran berhasil diteruskan, dengan No. Invoice :  <a class="text-head-2" style="cursor:pointer" onclick="penawaran_return_click_'.$projectId.'_'.$queryref->InvId.'()">'.$queryref->InvCode.'</a></span>
                    </div>';
            }else{
                $alert = '<div class="alert alert-primary p-2 m-1" role="alert">
                        <a class="text-head-2" style="cursor:pointer" onclick="add_project_invoice(\''.$projectId.'\',this,\''.$row->SphId.'\')"><i class="fa-solid fa-reply pe-1 ps-1 me-2 fa-rotate-180"></i>teruskan penawaran ini ke Invoice</a>
                    </div>';
            }
            foreach($items as $item){

                $folder = 'assets/images/produk/'.$item->ProdukId."/";
                $default = 'assets/images/produk/default.png';
    
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);  
                } 
                $files = array_diff(scandir($folder), array('.', '..')); 
                $gambar = null;
    
                foreach ($files as $file) {
                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        $gambar = $folder . $file;
                        break;
                    }
                }  

                $arr_varian = json_decode($item->SphDetailVarian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }

                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-4 my-1 varian">   
                        <div class="d-flex gap-2 align-items-center"> 
                            ' . ($item->SphDetailType == "product" ? ($gambar ? "<img src='".base_url().$gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url().$default."' alt='Gambar Default'>") : "").'  
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase"  '.($item->SphDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SphDetailText.'</span>
                                '.($item->SphDetailGroup == "" ? "" : '<span class="text-detail-2 text-truncate"  '.($item->SphDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SphDetailGroup.'</span>').'
                                '.($arr_badge == "" ? "" : '<div class="d-flex flex-wrap gap-1"> '.$arr_badge.'</div>').' 
                            </div> 
                        </div>
                    </div>';
                if($item->SphDetailType == "product"){
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail">
                                        <div class="row"> 
                                            <div class="col-6 col-md-2">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->SphDetailQty, 2, ',', '.').' '.$item->SphDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Harga Satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SphDetailPrice, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Disc Satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SphDetailDisc, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Total:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SphDetailTotal, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                        </div>   
                                    </div> 
                                </div>';
                    $no++;
                }else{
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail"></div></div>';
                    $huruf++;
                    $no = 1;
                }
                     
                
            }
            $html .= '
            <div class="list-project mb-4 p-2" data-id="'.$row->SphId.'" data-project="'.$projectId.'">
                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3">
                    <div class="col-12 col-sm-3 col-xl-2 order-1 order-sm-0">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Penawaran</span>
                            <span class="text-head-3">'.$row->SphCode.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-2 col-xl-2 order-2 order-sm-1"> 
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                            <span class="text-head-3">'.date_format(date_create($row->SphDate),"d M Y").'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-xl-4 order-3 order-sm-2 pb-2">
                        <div class="d-flex flex-column justify-content-between">
                            <span class="text-detail-2 pb-2 pb-md-0"><i class="fa-solid fa-location-dot pe-1"></i> Alamat</span>
                            <span class="text-head-3 text-wrap">'.$row->SphAddress.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-7 col-xl-4 order-0 order-sm-3">
                        <div class="float-end d-md-flex d-none gap-1">  
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_sph('.$projectId.','.$row->SphId.',this)">
                                <i class="fa-solid fa-print mx-1"></i><span >Cetak</span>
                            </button> 
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_sph('.$projectId.','.$row->SphId.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Ubah</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_sph('.$projectId.','.$row->SphId.',this)">
                                <i class="fa-solid fa-close mx-1"></i><span >Hapus</span>
                            </button> 
                        </div> 
                        <div class="d-md-none d-flex btn-action justify-content-between"> 
                            <div class="text-head-2">PENAWARAN (SPH)</div>
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow">
                                    <li><a class="dropdown-item m-0 px-2 d-none" onclick="po_project_sph('.$projectId.','.$row->SphId.',this)"><i class="fa-solid fa-cart-shopping pe-2"></i>Teruskan Vendor</a></li>
                                    <li><a class="dropdown-item m-0 px-2 d-none" onclick="invoice_project_sph('.$projectId.','.$row->SphId.',this)"><i class="fa-solid fa-money-bill pe-2"></i>Teruskan Invoice</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_sph('.$projectId.','.$row->SphId.',this)"><i class="fa-solid fa-print pe-2"></i>Cetak</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_sph('.$projectId.','.$row->SphId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_sph('.$projectId.','.$row->SphId.',this)"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div> 
                </div> 
                <div class="detail-item p-2 border-top">
                    '.$html_items.' 
                </div>
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center flex-wrap"> 
                    <span class="text-detail-2">Sub Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SphSubTotal, 0, ',', '.').'</span>  
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Disc Item:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SphDiscItemTotal, 0, ',', '.').'</span>   
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Disc Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SphDiscTotal, 0, ',', '.').'</span>   
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Grand Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SphGrandTotal, 0, ',', '.').'</span> 
                </div>
                <div class="border-top p-2">
                  '.$alert.'
                </div>
            </div> 
        ';
        }

        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Belum ada data yang dibuat</span> 
                </div> 
            ';
        }
        $html .= '   <div class="d-flex justify-content-center flex-column align-items-center">
                        <button class="btn btn-sm btn-primary px-3 m-2" onclick="add_project_sph(\''.$projectId.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data penawaran</button>
                    </div>';

        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        );
    }
    private function data_project_sph_notif($projectId){
        $alert = array();

        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->where('ProjectId',$projectId);
        $builder->where('SphStatus !=',2);
        $builder->orderby('SphId', 'DESC'); 
        $query = $builder->get()->getResult();  
        foreach($query as $row){
            if($row->SphStatus == 0){
                $alert[] = array(
                    "type"=>"return",
                    "message"=>"penawaran ".$row->SphCode." belum diselesaikan"
                );
            }
        }
        return $alert;
    }
    private function data_project_invoice($projectId){
        $html = ''; 

        $builder = $this->db->table("invoice");
        $builder->select('*');
        $builder->where('ProjectId',$projectId);
        $builder->where('InvStatus !=',3);
        $builder->orderby('InvId', 'DESC'); 
        $query = $builder->get()->getResult();  
        foreach($query as $row){

            $builder = $this->db->table("invoice_detail");
            $builder->select('*'); 
            $builder->where('InvDetailRef',$row->InvId);
            $builder->orderby('InvDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items_invoice = "";
            $no = 1;
            $huruf  = "A";
            foreach($items as $item){
                $folder = 'assets/images/produk/'.$item->ProdukId."/";
                $default = 'assets/images/produk/default.png';
    
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);  
                } 
                $files = array_diff(scandir($folder), array('.', '..')); 
                $gambar = null;
    
                foreach ($files as $file) {
                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        $gambar = $folder . $file;
                        break;
                    }
                }  

                $arr_varian = json_decode($item->InvDetailVarian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }

                $html_items_invoice .= '
                <div class="row">
                    <div class="col-12 col-md-4 my-1 varian">   
                        <div class="d-flex gap-2">
                            ' . ($item->InvDetailType == "product" ? ($gambar ? "<img src='".base_url().$gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url().$default."' alt='Gambar Default' >") : "").'  
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase"  '.($item->InvDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->InvDetailText.'</span>
                                <span class="text-detail-2 text-truncate"  '.($item->InvDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->InvDetailGroup.'</span> 
                                <div class="d-flex flex-wrap gap-1">
                                    '.$arr_badge.'
                                </div>
                            </div> 
                        </div>
                    </div>';
                if($item->InvDetailType == "product"){
                    $html_items_invoice .= '<div class="col-12 col-md-8 my-1 detail">
                                        <div class="row"> 
                                            <div class="col-6 col-md-2">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->InvDetailQty, 2, ',', '.').' '.$item->InvDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Harga Satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->InvDetailPrice, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Disc Satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->InvDetailDisc, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Total:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->InvDetailTotal, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                        </div>   
                                    </div> 
                                </div>';
                    $no++;
                }else{
                    $html_items_invoice .= '<div class="col-12 col-md-8 my-1 detail"></div></div>';
                    $huruf++;
                    $no = 1;
                }
                     
                
            }


            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->where('InvId',$row->InvId);
            $builder->where('PaymentStatus <',2);
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult(); 
            $html_payment = "";
            $payment_total = 0;
            $performa_total = 0;
            foreach($payment as $row_payment){ 
                if($row_payment->PaymentDoc == "1"){
                    $payment_total += $row_payment->PaymentTotal;
                }else{
                    $performa_total += $row_payment->PaymentTotal;
                } 
                if($row_payment->PaymentStatus == "0"){
                    $status = '<span class="text-head-3 text-warning">
                    <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                        <i class="fa-solid fa-certificate fa-stack-2x"></i> 
                        <i class="fa-solid fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>Pending</span>';
                    $status = '<span class="text-head-3 text-warning">Pending</span>';
                }else{
                    $status = ' <span class="text-head-3 text-success">
                    <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                        <i class="fa-solid fa-certificate fa-stack-2x"></i>
                        <i class="fa-solid fa-check text-success fa-stack-1x fa-inverse"></i>
                    </span>Verified</span>';
                    $status = '<span class="text-head-3 text-success">Terverifikasi</span>';
                }
                $html_payment .= '<div class="mb-1 p-1">  
                                 <div class="row mx-2"> 
                                    <div class="col-12 col-md-1 order-2 order-sm-1 p-0"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-check text-success pe-1"></i>Status</span>
                                            '.$status.'
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-3 order-sm-2 p-0"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                                            <span class="text-head-3">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-4 order-sm-3 p-0"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2"><i class="fa-solid fa-layer-group pe-1"></i>Type</span>
                                            <span class="text-head-3">'.$row_payment->PaymentType.'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-5 order-sm-4 p-0">
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2"><i class="fa-solid fa-credit-card pe-1"></i>Method</span>
                                            <span class="text-head-3">'.$row_payment->PaymentMethod.'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-2 order-6 order-sm-5 p-0">
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2"><i class="fa-solid fa-wallet pe-1"></i>Total</span>
                                            <span class="text-head-3">Rp. '.number_format($row_payment->PaymentTotal).'</span>
                                        </div>   
                                    </div>
                                    <div class="col-12 col-md-6 text-end order-1 order-sm-5 p-0"> 
                                        <div class="d-none d-md-inline-block"> 
                                            <button class="btn btn-sm btn-primary btn-action rounded border '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$projectId.','.$row_payment->InvId.','.$row_payment->PaymentId.',this,\'invoice\')">
                                                <i class="fa-solid fa-eye mx-1"></i><span>Lihat Bukti</span>
                                            </button>
                                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$projectId.','.$row_payment->PaymentId.',this,\'invoice\')">
                                                <i class="fa-solid fa-print mx-1"></i><span>Print</span>
                                            </button>
                                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$projectId.','.$row_payment->PaymentId.',this,\'invoice\')">
                                                <i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_payment('.$projectId.','.$row_payment->PaymentId.',this,\'invoice\')">
                                                <i class="fa-solid fa-close mx-1"></i><span>Hapus</span>
                                            </button> 
                                        </div>
                                        <div class="d-flex d-md-none justify-content-between">
                                            <span class="text-head-2 pt-auto"><i class="fa-solid fa-money-check-dollar pe-2"></i>'.($row_payment->PaymentDoc == "1" ? "Payment" : "Proforma" ).'</span>
                                            <div class="dropdown">
                                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti-more-alt icon-rotate-45"></i>
                                                </a>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item m-0 px-2" onclick="proforma_project_invoice('.$projectId.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-dollar pe-2"></i>Proforma</a></li>
                                                    <li><a class="dropdown-item m-0 px-2" onclick="add_project_payment('.$projectId.','.$row_payment->PaymentId.',this,\'invoice\')"><i class="fa-solid fa-dollar pe-2"></i>Payment</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_invoice_a4('.$projectId.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-print pe-2"></i>Print A4</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_invoice_a5('.$projectId.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-print pe-2"></i>Print A5</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_invoice('.$projectId.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_invoice('.$projectId.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
            } 
            if($html_payment == ""){
                $html_payment = '<div class="alert alert-warning p-2 m-1" role="alert"> 
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Belum ada data pembayaran yang dibuat, Silahkan tambahkan data 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="proforma_project_invoice('.$projectId.','.$row->InvId.',this)">Proforma</a> atau 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$projectId.','.$row->InvId.',this,\'invoice\')">Pembayaran</a>
                        </span> 
                    </div>';
            }elseif($payment_total < $row->InvGrandTotal){
                $html_payment .= '
                <div class="alert alert-warning p-2 m-1" role="alert"> 
                    <span class="text-head-2">
                        <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                        Masih ada sisa pembayaran yang belum diselesaikan, Silahkan buat data  
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$projectId.','.$row->InvId.',this,\'invoice\')">Pembayaran</a>
                    </span> 
                </div>';
            }


            $builder = $this->db->table("delivery");
            $builder->select('*');   
            $builder->where("InvId",$row->InvId);
            $builder->where("ProjectId",$projectId);
            $builder->orderby('DeliveryId', 'ASC'); 
            $delivery = $builder->countAllResults();
            if($delivery == 0){
                $alert = ' 
                    <div class="alert alert-warning p-2 m-1" role="alert">
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Belum ada data pengiriman yang dibuat dari invoice ini, 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_delivery('.$projectId.','.$row->InvId.',this,\'invoice\')">Buat Data Pengiriman</a> 
                        </span>
                    </div>';
            }else{
                $alert = ' 
                <div class="alert alert-success p-2 m-1" role="alert">
                    <span class="text-head-2">
                        <i class="fa-solid fa-check text-success me-2" style="font-size:0.75rem"></i>
                        ada '.$delivery .' data pengiriman yang dibuat dari invoice ini, 
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick=\'$("i[data-menu=\"pengiriman\"][data-id=\"'.$projectId.'\"]").trigger("click")\'>Lihat Selengkapnya</a> atau
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_delivery('.$projectId.','.$row->InvId.',this,\'invoice\')">Tambah Data Pengiriman</a> 
                    </span>
                </div>';
            }
            

            $html .= '
            <div class="list-project mb-4 p-2" data-id="'.$row->InvId.'" data-project="'.$projectId.'">
                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3">
                    <div class="col-12 col-sm-3 col-xl-2 order-1 order-sm-0">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Invoice</span>
                            <span class="text-head-3">'.$row->InvCode.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-2 col-xl-2 order-2 order-sm-1"> 
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                            <span class="text-head-3">'.date_format(date_create($row->InvDate),"d M Y").'</span>
                        </div>  
                    </div> 
                    <div class="col-12 col-xl-4 order-3 order-sm-2 pb-2">
                        <div class="d-flex flex-column justify-content-between">
                            <span class="text-detail-2 pb-2 pb-md-0"><i class="fa-solid fa-location-dot pe-1"></i> Alamat</span>
                            <span class="text-head-3 text-wrap">'.$row->InvAddress.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-7 col-xl-4 order-0 order-sm-3">
                        <div class="float-end d-md-flex d-none gap-1">  
                            <div class="dropdown">
                                <a class="btn btn-sm btn-primary btn-action rounded border dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-print mx-1"></i><span >Cetak</span>
                                </a> 
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" onclick="print_project_invoice_a4('.$projectId.','.$row->InvId.',this)">Print A4</a></li>
                                    <li><a class="dropdown-item" onclick="print_project_invoice_a5('.$projectId.','.$row->InvId.',this)">Print A5</a></li> 
                                </ul>
                            </div>
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_invoice('.$projectId.','.$row->InvId.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Edit</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_invoice('.$projectId.','.$row->InvId.',this)">
                                <i class="fa-solid fa-close mx-1"></i><span >Hapus</span>
                            </button> 
                        </div> 
                        <div class="d-md-none d-flex btn-action justify-content-between"> 
                            <div class="text-head-2">INVOICE (SALES ORDER)</div>
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow"> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_invoice_a4('.$projectId.','.$row->InvId.',this)"><i class="fa-solid fa-print pe-2"></i>Cetak A4</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_invoice_a5('.$projectId.','.$row->InvId.',this)"><i class="fa-solid fa-print pe-2"></i>Cetak A5</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_invoice('.$projectId.','.$row->InvId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_invoice('.$projectId.','.$row->InvId.',this)"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div> 
                </div> 
                <div class="detail-item mt-2 p-2 border-top">
                    '.$html_items_invoice.' 
                </div>
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center flex-wrap"> 
                    <span class="text-detail-2">Sub Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->InvSubTotal, 0, ',', '.').'</span> 
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Disc Item:</span>
                    <span class="text-head-2">Rp. '.number_format($row->InvDiscItemTotal, 0, ',', '.').'</span>
                    <div class="divider-horizontal"></div> 
                    <span class="text-detail-2">Disc Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->InvDiscTotal, 0, ',', '.').'</span> 
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Grand Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->InvGrandTotal, 0, ',', '.').'</span> 
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Pembayaran:</span>
                    <span class="text-head-2">Rp. '.number_format($payment_total, 0, ',', '.').'</span> 
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Sisa:</span>
                    <span class="text-head-2">Rp. '.number_format($row->InvGrandTotal - $payment_total, 0, ',', '.').'</span> 
                </div>
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center pt-4 justify-content-between">  
                    <span class="text-head-2"><i class="fa-solid fa-money-bill pe-2"></i>Rincian Pembayaran</span>
                    <div class="action">
                        <a class="btn btn-sm btn-primary btn-action rounded" onclick="proforma_project_invoice('.$projectId.','.$row->InvId.',this)"><i class="fa-solid fa-circle-plus pe-2"></i>Buat Data Proforma</a> 
                        <a class="btn btn-sm btn-primary btn-action rounded" onclick="add_project_payment('.$projectId.','.$row->InvId.',this,\'invoice\')"><i class="fa-solid fa-circle-plus pe-2"></i>Buat Data Payment</a>
                    </div>
                </div>
                '.$html_payment.' 
                <div class="d-flex border-top mt-2 m-1 pt-2 gap-2 align-items-center justify-content-between">  
                    <span class="text-head-2"><i class="fa-solid fa-truck pe-2"></i>Rincian Pengiriman</span> 
                </div>
                <div class="border-top pt-2">
                   '.  $alert .'
                </div> 
            </div> 
            '; 
        }
        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Belum ada data yang dibuat</span> 
                </div> 
            ';
        }
        $html .= '   <div class="d-flex justify-content-center flex-column align-items-center">
                        <button class="btn btn-sm btn-primary px-3 m-2" onclick="add_project_invoice(\''.$projectId.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data Invoice</button>
                    </div>';
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        );
    }
    private function data_project_invoice_notif($projectId){
        $alert = array();

        $builder = $this->db->table("invoice");
        $builder->select('*');
        $builder->where('ProjectId',$projectId);
        $builder->where('InvStatus !=',3);
        $builder->orderby('InvId', 'DESC'); 
        $query = $builder->get()->getResult();  
        foreach($query as $row){
            if($row->InvGrandTotal > 0){
                $builder = $this->db->table("payment");
                $builder->select('sum(PaymentTotal) as total');  
                $builder->where('PaymentDoc',"1");
                $builder->where('InvId',$row->InvId);
                $builder->orderby('PaymentId', 'ASC'); 
                $payment = $builder->get()->getRow()->total; 
                if($payment < $row->InvGrandTotal){
                    $alert[] = array(
                        "type"=>"Payment",
                        "message"=>"pembayaran ". $row->InvCode ." belum dibuat"
                    );
                } 
            }

            // $builder = $this->db->table("delivery");
            // $builder->select('*');   
            // $builder->where("InvId",$row->InvId);
            // $builder->orderby('DeliveryId', 'ASC'); 
            // $delivery = $builder->countAllResults();
            // if($delivery == 0){
            //     $alert[] = array(
            //         "type"=>"Pengiriman",
            //         "message"=>"pengiriman ".$row->InvCode." belum dibuat"
            //     );
            // }else{
            //     $builder = $this->db->table("delivery");
            //     $builder->select('*');   
            //     $builder->where("InvId",$row->InvId);
            //     $builder->where("DeliveryStatus <",2);
            //     $builder->orderby('DeliveryId', 'ASC'); 
            //     $delivery = $builder->countAllResults();
            //     if($delivery == 0){
            //         $alert[] = array(
            //             "type"=>"Delivery",
            //             "message"=>"pengiriman ".$row->InvCode." belum diselesaikan"
            //         );
            //     }
            // }
        }
        return $alert;
    }
    private function data_project_delivery($projectId){ 
        $builder = $this->db->table("delivery");
        $builder->select('*');   
        $builder->where("ProjectId",$projectId);
        $builder->orderby('DeliveryId', 'ASC'); 
        $delivery = $builder->get()->getResult(); 
        $html_collapse = array();
        $html_delivery = "";
        $htmlgroup = "";
        $delivery_ritase = 0;
        foreach($delivery as $row_delivery){ 
            $delivery_ritase++;
            $builder = $this->db->table("delivery_detail");
            $builder->select('*'); 
            $builder->where('DeliveryDetailRef',$row_delivery->DeliveryId);
            $builder->orderby('DeliveryDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A";
            foreach($items as $item){
                $folder = 'assets/images/produk/'.$item->ProdukId."/";
                $default = 'assets/images/produk/default.png';
    
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);  
                } 
                $files = array_diff(scandir($folder), array('.', '..')); 
                $gambar = null;
    
                foreach ($files as $file) {
                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        $gambar = $folder . $file;
                        break;
                    }
                }  

                $arr_varian = json_decode($item->DeliveryDetailVarian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }

                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-5 my-1 varian">   
                        <div class="d-flex gap-2">
                            ' . ($item->DeliveryDetailType == "product" ? ($gambar ? "<img src='".base_url().$gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url().$default."' alt='Gambar Default' >") : "").'  
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase"  '.($item->DeliveryDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->DeliveryDetailText.'</span>
                                <span class="text-detail-2 text-truncate"  '.($item->DeliveryDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->DeliveryDetailGroup.'</span> 
                                <div class="d-flex flex-wrap gap-1">
                                    '.$arr_badge.'
                                </div>
                            </div> 
                        </div>
                    </div>'; 
                $html_items .= '<div class="col-12 col-md-7 my-1 detail">
                                    <div class="row"> 
                                        <div class="col-6 col-md-3">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Dikirim:</span>
                                                <span class="text-head-2">'.number_format($item->DeliveryDetailQty, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                            </div>
                                        </div>  
                                        <div class="col-6 col-md-2">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Spare:</span>
                                                <span class="text-head-2">'.number_format($item->DeliveryDetailQtySpare, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                            </div>
                                        </div>  
                                        <div class="col-4 col-md-3 px-1 border-left">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Diterima:</span>
                                                <span class="text-head-2">'.number_format($item->DeliveryDetailQtyReceive, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                            </div>
                                        </div>  
                                        <div class="col-4 col-md-2 px-1">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Spare:</span>
                                                <span class="text-head-2">'.number_format($item->DeliveryDetailQtyReceiveSpare, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                            </div>
                                        </div>  
                                        <div class="col-4 col-md-2 px-1">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Rusak:</span>
                                                <span class="text-head-2">'.number_format($item->DeliveryDetailQtyReceiveWaste, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                            </div>
                                        </div>  
                                    </div>   
                                </div> 
                            </div>';
                $no++; 
                    
                
            } 
            if($row_delivery->DeliveryStatus == 0){
                $alert = ' 
                    <div class="alert alert-warning p-2 m-1" role="alert">
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Belum ada proses pengiriman, 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="delivery_project_proses('.$projectId.','.$row_delivery->DeliveryId.',this)">Konfirmasi proses pengemasan dan upload bukti foto pengemasan</a> 
                        </span>
                    </div>';
            }elseif($row_delivery->DeliveryStatus == 1){
                $alert = ' 
                <div class="d-flex gap-2 align-items-center p-2"> 
                    <span class="text-head-1"> <i class="fa-solid fa-plane-departure pe-1"></i></span> 
                    <div class="p-1">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                            <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDateProses),"d M Y").'</span>
                        </div> 
                    </div>
                    <div class="p-1">
                        <span class="text-head-3 d-flex flex-column">
                            Barang sudah dikemas/packing dan sedang dalam perjalan ke tujuan,
                            <div class="d-flex gap-2">
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_proses_show('.$row_delivery->DeliveryId.',this)">Lihat Bukti</a>
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_proses_edit('.$row_delivery->DeliveryId.',this)">Ubah Data</a>
                            </div>
                        </span>
                    </div>
                </div>
            
                <div class="alert alert-warning p-2 m-1" role="alert">
                    <span class="text-head-2">
                        <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                        Belum ada proses penerimaan barang, 
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="delivery_project_finish('.$projectId.','.$row_delivery->DeliveryId.',this)">Konfirmasi pengiriman barang dan upload bukti foto penerimaan barang</a> 
                    </span>
                </div>';
            }elseif($row_delivery->DeliveryStatus == 2){
                $alert = ' 
                <div class="d-flex gap-2 align-items-center p-2"> 
                    <span class="text-head-1"> <i class="fa-solid fa-plane-departure pe-1"></i></span> 
                    <div class="p-1">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                            <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDateProses),"d M Y").'</span>
                        </div> 
                    </div>
                    <div class="p-1">
                        <span class="text-head-3 d-flex flex-column">
                            Barang sudah dikemas/packing dan sedang dalam perjalan ke tujuan, 
                            <div class="d-flex gap-2">
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_proses_show('.$row_delivery->DeliveryId.',this)">Lihat Bukti</a> 
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_proses_edit('.$row_delivery->DeliveryId.',this)">Ubah Data</a>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="d-flex gap-2 align-items-center p-2"> 
                    <span class="text-head-1"> <i class="fa-solid fa-plane-arrival pe-1"></i></span> 
                    <div class="p-1">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span> 
                            <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDateFinish),"d M Y").'</span> 
                        </div> 
                    </div>
                    <div class="p-1">
                        <span class="text-head-3 d-flex flex-column">
                            <span>Barang sudah sampai di tujuan dengan penerima <b>'.$row_delivery->DeliveryReceiveName.'</b></span> 
                            <div class="d-flex gap-2">
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_finish_show('.$row_delivery->DeliveryId.',this)">Lihat Bukti</a>
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_finish_edit('.$row_delivery->DeliveryId.',this)">Ubah Data</a>
                            </div> 
                        </span>
                    </div>
                </div>';
            }

            $html_payment = "";
            $payment_total = 0;
            if($row_delivery->DeliveryTotal == 0){
                $html_payment = '<div class="alert alert-success p-2 m-1" role="alert"> 
                <span class="text-head-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran yang harus diselesaikan untuk transaksi ini 
                </span> 
                </div>';
            }else{
                $builder = $this->db->table("payment");
                $builder->select('*'); 
                $builder->where('DeliveryId',$row_delivery->DeliveryId);
                $builder->orderby('PaymentId', 'ASC'); 
                $payment = $builder->get()->getResult(); 
                $html_payment = "";
                $payment_total = 0; 
                foreach($payment as $row_payment){ 
                    if($row_payment->PaymentDoc == "1"){
                        $payment_total += $row_payment->PaymentTotal; 
                    } 
                    if($row_payment->PaymentStatus == "0"){
                        $status = '<span class="text-head-3 text-warning">
                        <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                            <i class="fa-solid fa-certificate fa-stack-2x"></i> 
                            <i class="fa-solid fa-exclamation fa-stack-1x fa-inverse"></i>
                        </span>Pending</span>';
                        $status = '<span class="text-head-3 text-warning">Pending</span>';
                    }else{
                        $status = ' <span class="text-head-3 text-success">
                        <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                            <i class="fa-solid fa-certificate fa-stack-2x"></i>
                            <i class="fa-solid fa-check text-success fa-stack-1x fa-inverse"></i>
                        </span>Verified</span>';
                        $status = '<span class="text-head-3 text-success">Terverifikasi</span>';
                    }
                    $html_payment .= '<div class="mb-1 p-1">  
                                    <div class="row mx-2"> 
                                        <div class="col-12 col-md-1 order-2 order-sm-1 p-0"> 
                                            <div class="d-flex flex-row flex-md-column justify-content-between"> 
                                                <span class="text-detail-2"><i class="fa-solid fa-check text-success pe-1"></i>Status</span>
                                                '.$status.'
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-1 order-3 order-sm-2 p-0"> 
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                                                <span class="text-head-3">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</span>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-1 order-4 order-sm-3 p-0"> 
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-layer-group pe-1"></i>Type</span>
                                                <span class="text-head-3">'.$row_payment->PaymentType.'</span>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-1 order-5 order-sm-4 p-0">
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-credit-card pe-1"></i>Method</span>
                                                <span class="text-head-3">'.$row_payment->PaymentMethod.'</span>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-2 order-6 order-sm-5 p-0">
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-wallet pe-1"></i>Total</span>
                                                <span class="text-head-3">Rp. '.number_format($row_payment->PaymentTotal).'</span>
                                            </div>   
                                        </div>
                                        <div class="col-12 col-md-6 text-end order-1 order-sm-5 p-0"> 
                                            
                                            <div class="d-none d-md-inline-block"> 
                                                <button class="btn btn-sm btn-primary btn-action rounded border '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$projectId.','.$row_payment->DeliveryId.','.$row_payment->PaymentId.',this,\'delivery\')">
                                                    <i class="fa-solid fa-eye mx-1"></i><span>Lihat Bukti</span>
                                                </button>
                                                <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$projectId.','.$row_payment->PaymentId.',this,\'delivery\')">
                                                    <i class="fa-solid fa-print mx-1"></i><span>Cetak</span>
                                                </button>
                                                <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$projectId.','.$row_payment->PaymentId.',this,\'delivery\')">
                                                    <i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
                                                </button>
                                                <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_payment('.$projectId.','.$row_payment->PaymentId.',this,\'delivery\')">
                                                    <i class="fa-solid fa-close mx-1"></i><span>Hapus</span>
                                                </button> 
                                            </div>
                                            <div class="d-flex  d-md-none justify-content-between"> 
                                                <span class="text-head-2 pt-auto"><i class="fa-solid fa-money-check-dollar pe-2"></i>'.($row_payment->PaymentDoc == "1" ? "Payment" : "Proforma" ).'</span>
                                                <div class="dropdown">
                                                    <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti-more-alt icon-rotate-45"></i>
                                                    </a>
                                                    <ul class="dropdown-menu shadow">
                                                        <li><a class="dropdown-item m-0 px-2 '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$projectId.','.$row_payment->DeliveryId.','.$row_payment->PaymentId.',this,\'delivery\')"><i class="fa-solid fa-eye pe-2"></i>Lihat Bukti</a></li>
                                                        <li><a class="dropdown-item m-0 px-2" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$projectId.','.$row_payment->PaymentId.',this,\'delivery\')"><i class="fa-solid fa-dollar pe-2"></i>Cetak</a></li>  
                                                        <li><a class="dropdown-item m-0 px-2" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$projectId.','.$row_payment->PaymentId.',this,\'delivery\')"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                                        <li><a class="dropdown-item m-0 px-2" onclick="delete_project_payment('.$projectId.','.$row_payment->PaymentId.',this,\'delivery\')"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                } 
                if($html_payment == ""){
                    $html_payment = '<div class="alert alert-warning p-2 m-1" role="alert"> 
                            <span class="text-head-2">
                                <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                                Belum ada data pembayaran yang dibuat, Silahkan tambahkan data  
                                <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$projectId.','.$row_delivery->DeliveryId.',this,\'delivery\')">Pembayaran</a>
                            </span> 
                        </div>';
                }elseif($payment_total < $row_delivery->DeliveryTotal){
                    $html_payment .= '
                    <div class="alert alert-warning p-2 m-1" role="alert"> 
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Masih ada sisa pembayaran yang belum diselesaikan, Silahkan buat data  
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$projectId.','.$row_delivery->DeliveryId.',this,\'delivery\')">Pembayaran</a>
                        </span> 
                    </div>';
                }
            }


            $html_delivery .= '  
                        <div class="list-project mb-4 p-2 project-hide">  
                            <div class="header row gx-0 gy-0 gx-md-4 gy-md-2 ps-3" >  
                                <div class="col-12 col-sm-2 col-xl-2">
                                    <div class="d-flex flex-row flex-md-column justify-content-between">
                                        <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Pengiriman</span>
                                        <span class="text-head-3">'.$row_delivery->DeliveryCode.'</span>
                                    </div>  
                                </div>
                                <div class="col-12 col-sm-2 col-xl-2"> 
                                    <div class="d-flex flex-row flex-md-column justify-content-between">
                                        <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                                        <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDate),"d M Y").'</span>
                                    </div>  
                                </div> 
                                <div class="col-12 col-sm-2 col-xl-2">
                                    <div class="d-flex flex-row flex-md-column justify-content-between">
                                        <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Referensi</span>
                                        <span class="text-head-3">-</span>
                                    </div>  
                                </div>
                                <div class="col-12 col-sm-2 col-xl-2">
                                    <div class="d-flex flex-row flex-md-column justify-content-between">
                                        <span class="text-detail-2"><i class="fa-solid fa-money-bill pe-1"></i>Biaya Pengiriman</span>
                                        <span class="text-head-3">Rp. '.number_format($row_delivery->DeliveryTotal,0, ',', '.').'</span>
                                    </div>  
                                </div>
                                <div class="col-3 col-md-4 text-end"> 
                                    <div class="d-none d-md-inline-block">  
                                        <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_delivery('.$projectId.','.$row_delivery->DeliveryId.',this)">
                                            <i class="fa-solid fa-print mx-1"></i><span >Cetak</span>
                                        </button>
                                        <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_delivery('.$projectId.','.$row_delivery->DeliveryId.',this)">
                                            <i class="fa-solid fa-pencil mx-1"></i><span >Ubah</span>
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_delivery('.$projectId.','.$row_delivery->DeliveryId.',this)">
                                            <i class="fa-solid fa-close mx-1"></i><span >Hapus</span>
                                        </button> 
                                    </div>
                                    <div class="d-inline-block d-md-none">
                                        <div class="dropdown">
                                            <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti-more-alt icon-rotate-45"></i>
                                            </a>
                                            <ul class="dropdown-menu shadow">  
                                                <li><a class="dropdown-item m-0 px-2" onclick="print_project_delivery('.$projectId.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-print pe-2"></i>Cetak</a></li> 
                                                <li><a class="dropdown-item m-0 px-2" onclick="edit_project_delivery('.$projectId.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li> 
                                                <li><a class="dropdown-item m-0 px-2" onclick="delete_project_delivery('.$projectId.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="d-flex border-top mt-2 p-2 gap-4 align-items-center">   
                                <div class="d-flex flex-row flex-md-column align-self-start">
                                    <span class="text-detail-2"><i class="fa-solid fa-flag pe-1"></i>Ritase</span>
                                    <h4>'.$row_delivery->DeliveryRitase.'</h4>
                                </div>   
                                <div class="d-flex flex-row flex-md-column align-self-start">
                                    <span class="text-detail-2"><i class="fa-solid fa-truck pe-1"></i>Armada</span>
                                    <span class="text-head-3">'.$row_delivery->DeliveryArmada.'</span>
                                </div>   
                                <div class="d-flex flex-row flex-md-column align-self-start">
                                    <span class="text-detail-2"><i class="fa-solid fa-plane-departure pe-1"></i></i>Dari</span>
                                    <span class="text-head-2">'.$row_delivery->DeliveryFromName.'</span>
                                    <span class="text-head-3">'.$row_delivery->DeliveryFromTelp.'</span>
                                    <span class="text-detail-2">'.$row_delivery->DeliveryFromAddress.'</span>
                                </div>    
                                <div class="d-flex text-primary align-items-center">
                                    <i class="fa-solid fa-truck pe-1"></i>
                                    <div class="line-dot"></div>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                                <div class="d-flex flex-row flex-md-column align-self-start">
                                    <span class="text-detail-2"><i class="fa-solid fa-plane-arrival pe-1"></i>Tujuan</span>
                                    <span class="text-head-2">'.$row_delivery->DeliveryToName.'</span>
                                    <span class="text-head-3">'.$row_delivery->DeliveryToTelp.'</span>
                                    <span class="text-detail-2">'.$row_delivery->DeliveryToAddress.'</span>
                                </div>   
                            </div>
                            <div class="detail-project " style="display: none !important">
                                
                                <div class="detail-item mt-1 p-2 border-top">
                                    '.$html_items.' 
                                </div> 
                                <div class="d-flex border-top mt-2 m-1 pt-2 gap-2 align-items-center justify-content-between">  
                                    <span class="text-head-2"><i class="fa-solid fa-money-bill pe-2"></i>Rincian Pembayaran</span> 
                                </div> 
                                <div class="detail-item mt-1 p-2 border-top">
                                    '.$html_payment.' 
                                </div> 
                                <div class="d-flex border-top mt-2 m-1 pt-2 gap-2 align-items-center justify-content-between">  
                                    <span class="text-head-2"><i class="fa-solid fa-truck pe-2"></i>Rincian Pengiriman</span> 
                                </div> 
                                <div class="border-top pt-2">
                                '.  $alert .'
                                </div> 
                            </div> 
                            <div class="d-flex justify-content-center p-2" > 
                                <a class="text-head-2" style="cursor-pointer" onclick="hide_project(this)">Lihat Selengkapnya<i class="fa-solid fa-chevron-down ps-2"></i></a> 
                            </div>
                        </div> 
                        ';
            if($row_delivery->SampleId > 0){
                $html_collapse[$row_delivery->SampleId]["html"] = (isset($html_collapse[$row_delivery->SampleId]["html"]) ? $html_collapse[$row_delivery->SampleId]["html"]: "") . $html_delivery;
                $html_collapse[$row_delivery->SampleId]["code"] = ($this->getdataSample($row_delivery->SampleId))->SampleCode;
                $html_collapse[$row_delivery->SampleId]["type"] = "SAMPLE";
                if(!isset($html_collapse[$row_delivery->SampleId]["count"])){
                    $html_collapse[$row_delivery->SampleId]["count"] = 0;
                };
                $html_collapse[$row_delivery->SampleId]["count"]++;
                $html_delivery = "";
            } 
            if($row_delivery->InvId > 0){
                $html_collapse[$row_delivery->InvId]["html"] =(isset($html_collapse[$row_delivery->InvId]["html"]) ? $html_collapse[$row_delivery->InvId]["html"]: "")  . $html_delivery; 
                $html_collapse[$row_delivery->InvId]["code"] = ($this->getdataInvoice($row_delivery->InvId))->InvCode;
                $html_collapse[$row_delivery->InvId]["type"] = "INVOICE"; 
                if(!isset($html_collapse[$row_delivery->InvId]["count"])){
                    $html_collapse[$row_delivery->InvId]["count"] = 0;
                };
                $html_collapse[$row_delivery->InvId]["count"]++;
                $html_delivery = "";
            }  
            if($row_delivery->POId > 0){
                $html_collapse[$row_delivery->POId]["html"] = (isset($html_collapse[$row_delivery->POId]["html"]) ? $html_collapse[$row_delivery->POId]["html"]: "")  . $html_delivery; 
                $html_collapse[$row_delivery->POId]["code"] = ($this->getdataPO($row_delivery->POId))->POCode;
                $html_collapse[$row_delivery->POId]["type"] = "PO"; 
                if(!isset($html_collapse[$row_delivery->POId]["count"])){
                    $html_collapse[$row_delivery->POId]["count"] = 0;
                };
                $html_collapse[$row_delivery->POId]["count"]++;
                $html_delivery = "";
            }  
        }

        if($html_collapse == []){ 
            $html_delivery = ' 
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Belum ada pengiriman yang dibuat</span> 
                </div> 
            ';
        }
        foreach($html_collapse as $row){
            $html_delivery .= '
                <div class="group-header d-flex justify-content-between mb-2 p-2 border-bottom project-hide" style="cursor:pointer" data-code="'.$row["code"].'" onclick="hide_list(\''.$row["code"].'\')">
                    <span class="text-head-2 ">'.$row["type"].' ('.$row["code"].')</span>
                    <div>
                        <span class="text-head-3">Total '.$row["count"].'</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
                <div class="group-list" data-code="'.$row["code"].'" style="display: none !important">'.$row["html"]."</div>"; 
        }
        $html_delivery = ' 
            <script>
                function hide_list(project){
                    if( $(".group-header[data-code=\'" + project + "\'").hasClass("project-hide")){
                        $(".group-header[data-code=\'" + project + "\'").removeClass("project-hide");
                        $(".group-list[data-code=\'" + project + "\'").slideDown( "slow" );
                    }else{
                        $(".group-header[data-code=\'" + project + "\'").addClass("project-hide");
                        $(".group-list[data-code=\'" + project + "\'").addClass("hide");
                        $(".group-list[data-code=\'" + project + "\'").slideUp("slow",function(){
                            $(this).attr("style", "display: none !important");
                        });
                    }
                }
                    
                function hide_project(ele){
                    var el = $(ele).parent().parent();
                    if( $(el).hasClass("project-hide")){
                        $(el).removeClass("project-hide")
                        $(el).find(".detail-project").slideDown( "slow" );
                        $(ele).html(\'Sembunykan Detail<i class="fa-solid fa-chevron-up ps-2"></i>\');
                    }else{
                        $(el).addClass("project-hide") 
                        $(el).find(".detail-project").slideUp("slow",function(){
                            $(this).attr("style", "display: none !important");
                        });
                        $(ele).html(\'Lihat Selengkapnya<i class="fa-solid fa-chevron-down ps-2"></i>\');
                    } 
                        
                }
            </script>
            <div class="d-flex justify-content-center flex-column align-items-center">
                <span class="text-detail-2">Pengiriman dibuat berdasarkan data invoice, sample ataupun pembelian.</span><span class="text-detail-2"> masuk ke menu invoice,sample ataupun pembelian dan klik tambah pengiriman dari list tersebut</span> 
            </div>
            <div class="group-delivery">
            '. $html_delivery.'
            </div>';


         

        return json_encode(
            array(
                "status"=>true,
                "html"=>$html_delivery
            )
        );
    } 
    private function data_project_delivery_notif($projectId){ 
        $alert = array();
        $builder = $this->db->table("delivery");
        $builder->select('*');   
        $builder->where("ProjectId",$projectId);
        $builder->orderby('DeliveryId', 'ASC'); 
        $query = $builder->get()->getResult(); 
        foreach($query as $row){
            if($row->DeliveryStatus == 0){
                $alert[] = array(
                    "type"=>"Persiapan",
                    "message"=>"pengriman ". $row->DeliveryCode ." belum diproses"
                );
            }else if($row->DeliveryStatus == 1){
                $alert[] = array(
                    "type"=>"diterima",
                    "message"=>"pengriman ". $row->DeliveryCode ." belum sampai/diterima"
                );
            }
        }

        return $alert;
    }
    private function data_project_po($id){
        $html = "";

        $builder = $this->db->table("pembelian");
        $builder->select('*,pembelian.VendorName VendorName'); 
        $builder->join("vendor",'pembelian.VendorId=vendor.VendorId',"left"); 
        $builder->join("invoice",'invoice.InvId=pembelian.InvId',"left"); 
        $builder->join("penawaran",'penawaran.SphId=pembelian.SphId',"left"); 
        $builder->where('pembelian.ProjectId',$id);
        $builder->orderby('POId', 'DESC'); 
        $query = $builder->get()->getResult();  

       
        foreach($query as $row){
            

            $builder = $this->db->table("pembelian_detail");
            $builder->select('*'); 
            $builder->where('PODetailRef',$row->POId);
            $builder->orderby('PODetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1; 
            foreach($items as $item){
                $folder = 'assets/images/produk/'.$item->ProdukId."/";
                $default = 'assets/images/produk/default.png';
    
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);  
                } 
                $files = array_diff(scandir($folder), array('.', '..')); 
                $gambar = null;
    
                foreach ($files as $file) {
                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        $gambar = $folder . $file;
                        break;
                    }
                }  

                $arr_varian = json_decode($item->PODetailVarian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }

                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-6 my-1 varian">   
                        <div class="d-flex gap-2">
                            ' . ($gambar ? "<img src='".base_url().$gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url().$default."' alt='Gambar Default' >").'  
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase">'.$item->PODetailText.'</span>
                                <span class="text-detail-2 text-truncate">'.$item->PODetailGroup.'</span> 
                                <div class="d-flex flex-wrap gap-1">
                                    '.$arr_badge.'
                                </div>
                            </div> 
                        </div>
                    </div>'; 
                $html_items .= '<div class="col-12 col-md-6 my-1 detail">
                                    <div class="row"> 
                                        <div class="col-6 col-md-3 px-1">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Qty:</span>
                                                <span class="text-head-2">'.number_format($item->PODetailQty, 2, ',', '.').' '.$item->PODetailSatuanText.'</span>
                                            </div>
                                        </div>  
                                        <div class="col-6 col-md-4 px-1">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Harga:</span>
                                                <span class="text-head-2">Rp. '.number_format($item->PODetailPrice, 0, ',', '.').'</span>
                                            </div>
                                        </div>  
                                        <div class="col-12 col-md-4 px-1">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Total:</span>
                                                <span class="text-head-2">Rp. '.number_format($item->PODetailTotal, 0, ',', '.').'</span>
                                            </div>
                                        </div> 
                                    </div>   
                                </div> 
                            </div>';
                $no++;  
            } 

            // $builder = $this->db->table("pembelian");
            // $builder->select('*'); 
            // $builder->join("vendor",'pembelian.VendorId=vendor.VendorId',"left"); 
            // $builder->where('ProjectId',$id);
            // $builder->orderby('POId', 'DESC'); 
            // $query = $builder->get()->getResult();  

            $html_grpo = "";
            if($html_grpo == ""){
                $html_grpo = '
                    <div class="alert alert-warning p-2 m-1" role="alert"> 
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Belum ada data penerimaan barang yang dibuat, silahkan tambahkan data 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="terima_project_po('.$id.','.$row->POId.',this)">Penerimaan barang</a>  
                        </span> 
                    </div>';
            }else{
                $html_grpo .= '
                <div class="alert alert-warning p-2 m-1" role="alert"> 
                    <span class="text-head-2">
                        <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                        Masih ada sisa pembayaran yang belum diselesaikan, silahkan buat data  
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="terima_project_po('.$id.','.$row->POId.',this)">Penerimaan barang</a>
                    </span> 
                </div>';
            }


            $html_payment = "";
            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->where('POId',$row->POId);
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult(); 
            $html_payment = "";
            $payment_total = 0; 
            foreach($payment as $row_payment){ 
                if($row_payment->PaymentDoc == "1"){
                    $payment_total += $row_payment->PaymentTotal;
                }else{
                    $performa_total += $row_payment->PaymentTotal;
                } 
                if($row_payment->PaymentStatus == "0"){
                    $status = '<span class="text-head-3 text-warning">
                    <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                        <i class="fa-solid fa-certificate fa-stack-2x"></i> 
                        <i class="fa-solid fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>Pending</span>';
                    $status = '<span class="text-head-3 text-warning">Pending</span>';
                }else{
                    $status = ' <span class="text-head-3 text-success">
                    <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                        <i class="fa-solid fa-certificate fa-stack-2x"></i>
                        <i class="fa-solid fa-check text-success fa-stack-1x fa-inverse"></i>
                    </span>Verified</span>';
                    $status = '<span class="text-head-3 text-success">Terverifikasi</span>';
                }
                $html_payment .= '<div class="mb-1 p-1">  
                                <div class="row mx-2"> 
                                    <div class="col-12 col-md-1 order-2 order-sm-1 p-0"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-check text-success pe-1"></i>Status</span>
                                            '.$status.'
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-3 order-sm-2 p-0"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                                            <span class="text-head-3">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-4 order-sm-3 p-0"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2"><i class="fa-solid fa-layer-group pe-1"></i>Type</span>
                                            <span class="text-head-3">'.$row_payment->PaymentType.'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-5 order-sm-4 p-0">
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2"><i class="fa-solid fa-credit-card pe-1"></i>Method</span>
                                            <span class="text-head-3">'.$row_payment->PaymentMethod.'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-2 order-6 order-sm-5 p-0">
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2"><i class="fa-solid fa-wallet pe-1"></i>Total</span>
                                            <span class="text-head-3">Rp. '.number_format($row_payment->PaymentTotal).'</span>
                                        </div>   
                                    </div>
                                    <div class="col-12 col-md-6 text-end order-1 order-sm-5 p-0"> 
                                        
                                        <div class="d-none d-md-inline-block"> 
                                            <button class="btn btn-sm btn-primary btn-action rounded border '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$id.','.$row_payment->POId.','.$row_payment->PaymentId.',this,\'pembelian\')">
                                                <i class="fa-solid fa-eye mx-1"></i><span>Lihat Bukti</span>
                                            </button>
                                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$id.','.$row_payment->PaymentId.',this,\'pembelian\')">
                                                <i class="fa-solid fa-print mx-1"></i><span>Cetak</span>
                                            </button>
                                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$id.','.$row_payment->PaymentId.',this,\'pembelian\')">
                                                <i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_payment('.$id.','.$row_payment->PaymentId.',this,\'pembelian\')">
                                                <i class="fa-solid fa-close mx-1"></i><span>Hapus</span>
                                            </button> 
                                        </div>
                                        <div class="d-flex  d-md-none justify-content-between"> 
                                            <span class="text-head-2 pt-auto"><i class="fa-solid fa-money-check-dollar pe-2"></i>'.($row_payment->PaymentDoc == "1" ? "Payment" : "Proforma" ).'</span>
                                            <div class="dropdown">
                                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti-more-alt icon-rotate-45"></i>
                                                </a>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item m-0 px-2 '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$id.','.$row_payment->InvId.','.$row_payment->SampleId.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-eye pe-2"></i>Lihat Bukti</a></li>
                                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$id.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-dollar pe-2"></i>Cetak</a></li>  
                                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$id.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_payment('.$id.','.$row_payment->PaymentId.',this,\'sample\')"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
            } 
            if($html_payment == ""){
                $html_payment = '<div class="alert alert-warning p-2 m-1" role="alert"> 
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Belum ada data pembayaran yang dibuat, Silahkan tambahkan data  
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$id.','.$row->POId.',this,\'po\')">Pembayaran</a>
                        </span> 
                    </div>';
            }elseif($payment_total < $row->POGrandTotal){
                $html_payment .= '
                <div class="alert alert-warning p-2 m-1" role="alert"> 
                    <span class="text-head-2">
                        <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                        Masih ada sisa pembayaran yang belum diselesaikan, Silahkan buat data  
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$id.','.$row->POId.',this,\'po\')">Pembayaran</a>
                    </span> 
                </div>';
            } 
 
            if($row->InvId == 0 && $row->SphId ==0){
                $reference = "-";
            }else if($row->InvId == 0){
                $reference = $row->SphCode ;
            }else{
                $reference = $row->InvCode;
            }
            $html .= '
            <div class="list-project mb-4 p-2">
                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3">  
                    <div class="col-12 col-sm-3 col-xl-2 order-1 order-sm-0">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Pembelian</span>
                            <span class="text-head-3">'.$row->POCode.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-2 col-xl-2 order-2 order-sm-1"> 
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                            <span class="text-head-3">'.date_format(date_create($row->PODate),"d M Y").'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-2 col-xl-2 order-3 order-sm-2"> 
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Referensi</span>
                            <span class="text-head-3">'.($reference) .'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-2 col-xl-2 order-4 order-sm-3"> 
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2"><i class="fa-solid fa-address-card pe-1"></i>Vendor</span>
                            <span class="text-head-3 text-wrap">'.$row->VendorName.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-7 col-xl-4 order-0 order-sm-4">
                        <div class="float-end d-md-flex d-none gap-1">  
                            <div class="dropdown">
                                <a class="btn btn-sm btn-primary btn-action rounded border dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-print mx-1"></i><span >Cetak</span>
                                </a> 
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" onclick="print_project_po_a4('.$id.','.$row->POId.',this)">Print A4</a></li>
                                    <li><a class="dropdown-item" onclick="print_project_po_a5('.$id.','.$row->POId.',this)">Print A5</a></li> 
                                </ul>
                            </div>
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_po('.$id.','.$row->POId.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Edit</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_po('.$id.','.$row->POId.',this)">
                                <i class="fa-solid fa-close mx-1"></i><span >Delete</span>
                            </button> 
                        </div> 
                        <div class="d-md-none d-flex btn-action justify-content-between"> 
                            <div>PENAWARAN (SPH)</div>
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow"> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_po_a4('.$id.','.$row->POId.',this)"><i class="fa-solid fa-print pe-2"></i>Print A4</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_po_a5('.$id.','.$row->POId.',this)"><i class="fa-solid fa-print pe-2"></i>Print A5</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_po('.$id.','.$row->POId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_po('.$id.','.$row->POId.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div> 
                </div> 
                <div class="detail-item mt-2 p-2 border-top">
                    '.$html_items.' 
                </div>
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center"> 
                    <span class="text-detail-2">Sub Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->POSubTotal, 0, ',', '.').'</span> 
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Disc Item:</span>
                    <span class="text-head-2">Rp. '.number_format($row->PODiscTotal, 0, ',', '.').'</span>
                    <div class="divider-horizontal"></div> 
                    <span class="text-detail-2">Disc Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->POPPNTotal, 0, ',', '.').'</span> 
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Grand Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->POGrandTotal, 0, ',', '.').'</span>  
                </div> 
                <div class="d-flex border-top mt-2 m-1 pt-2 gap-2 align-items-center justify-content-between">  
                    <span class="text-head-2"><i class="fa-solid fa-money-bill pe-2"></i>Pembayaran</span> 
                </div>  
                '.  $html_payment .'
                <div class="d-flex border-top mt-2 m-1 pt-2 gap-2 align-items-center justify-content-between">  
                    <span class="text-head-2"><i class="fa-solid fa-cart-flatbed pe-2"></i>Penerimaan Barang</span> 
                </div>  
                '.  $html_grpo .'
            </div> 
        ';
        }

        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span>Belum ada data yang dibuat</span> 
                </div> 
            ';
        }
        $html .= '   <div class="d-flex justify-content-center flex-column align-items-center">
                        <button class="btn btn-sm btn-primary px-3 m-2" onclick="add_project_po(\''.$id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data pembelian</button>
                    </div>';

        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        ); 
    } 
    private function data_project_survey($id){
        $html = '
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                <span>Belum ada data yang dibuat</span>
                <button class="btn btn-sm btn-primary px-3 mt-4" onclick="add_project_survey(\''.$id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data survey</button>
            </div> 
        ';
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        );
    }
    private function data_project_rab($id){
        $html = '
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                <span>Belum ada data yang dibuat</span>
                <button class="btn btn-sm btn-primary px-3 mt-4" onclick="add_project_rab(\''.$id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data RAB</button>
            </div> 
        ';
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        );
    }
    private function data_project_documentasi($id){
        $html = '
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                <span>Belum ada data yang diupload</span> 
                <div class="text-center mt-4">
                    <button class="btn btn-sm btn-primary px-3" onclick="add_project_invoice(\''.$id.'\',this)"><i class="fa-solid fa-upload pe-2"></i>Upload Doument</button>  
                </div> 
            </div> 
        '; 
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        );
    }
    private function data_project_diskusi($id){
        $html = '
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                <span>Belum ada percakapan yang dibuat</span>
                <button class="btn btn-sm btn-primary px-3 mt-4" onclick="add_project_diskusi(\''.$id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>mulai percakapan</button>
            </div> 
        ';
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        );
    }
    private function data_project_keuangan($id){
        $html = '
        <div class="p-2">
        <div class="d-flex justify-content-between">
            <h6 class="text-head-1 pb-2">DATA KEUANGAN PROJECT</h6>
            
        </div>
        <div class="bg-white">
            <div class="d-flex border-bottom p-2"> 
                <span class="text-head-2 fw-bold flex-fill">Deskripsi</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Debit (+)</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Credit (-)</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Real Payment</span>
            </div> ';


        //INVOICE
        $builder = $this->db->table("invoice");
        $builder->select('*');
        $builder->where('ProjectId',$id);
        $builder->where('InvStatus !=',3);
        $builder->orderby('InvId', 'DESC'); 
        $query = $builder->get()->getResult();  
        
        $totalinvoice = 0;
        $realpayinvoice = 0;
        $listinvoice = "";
        foreach($query as $row){

            $htmlpayment = "";
            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->where('InvId',$row->InvId);
            $builder->where('PaymentDoc',1);
            $builder->where('PaymentStatus <',2);
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult(); 

            $iconexpand = '<i class="fa-solid fa-minus"></i>';
            foreach($payment as $row_payment){  
                $iconexpand = '<i class="fa-solid fa-chevron-down"></i>';
                $realpayinvoice += $row_payment->PaymentTotal; 
                $htmlpayment .= '  
                <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                    <span class="text-detail-3 fw-bold flex-fill">Pembayaran dari No. Dokumen '.$row_payment->PaymentCode .' Tgl. '.date_format(date_create($row_payment->PaymentDate) ,"d M Y").'</span>
                    <span class="text-detail-3 fw-bold" style="width:10rem;">-</span>
                    <span class="text-detail-3 fw-bold" style="width:10rem;">-</span>
                    <span class="text-detail-3 fw-bold" style="width:10rem;">(+) Rp. '.number_format($row_payment->PaymentTotal,0).' </span>
                </div>';
            }

            $totalinvoice += $row->InvGrandTotal; 
            $listinvoice .= ' 
                <div class="d-flex p-2 align-items-center list-group-item list-group-item-action" data-bs-toggle="collapse" data-bs-target="#invoice-'.$row->InvId.'" aria-expanded="false">
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;">'.$iconexpand.'</span>
                    <span class="text-detail-3 fw-bold flex-fill">Invoice dari No. Dokumen '.$row->InvCode.' tgl. '. date_format(date_create($row->InvDate) ,"d M Y").'</span>
                    <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">Rp. '.number_format($row->InvGrandTotal,0).'</span>
                    <span class="text-detail-3 fw-bold" style="width:10rem;">-</span>
                    <span class="text-detail-3 fw-bold" style="width:10rem;">-</span>
                </div>
                <div class="list-group list-group-flush collapse show" id="invoice-'.$row->InvId.'">
                    '.$htmlpayment.'
                </div>';
        }
        if($listinvoice == ""){
            $listinvoice = '<div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                <span class="text-detail-3 fw-bold flex-fill">Tidak ada data invoice yang dibuat</span>
            </div>';
        }
        $html .= '
        <div class="list-group list-group-flush" data-bs-toggle="collapse" data-bs-target="#invoice-'.$id.'" aria-expanded="false">
            <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-head-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-chevron-down"></i></span>
                <span class="text-head-3 fw-bold flex-fill">Penjualan</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($totalinvoice,0).'</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">-</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">(+) Rp. '.number_format($realpayinvoice,0).'</span>
            </div> 
        </div> 
        <div class="list-group list-group-flush collapse show" id="invoice-'.$id.'"> '.$listinvoice.'</div>';


        //PEMBELIAN
        $builder = $this->db->table("pembelian");
        $builder->where('ProjectId',$id);
        $builder->orderby('POId', 'DESC'); 
        $query = $builder->get()->getResult();   
        $totalpo = 0;
        $realpaypo = 0;
        $pembelian = "";
        foreach($query as $row){
            $htmlpayment = "";
            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->where('POId',$row->POId);
            $builder->where('PaymentDoc',1);
            $builder->where('PaymentStatus <',2);
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult(); 

            $iconexpand = '<i class="fa-solid fa-minus"></i>';
            foreach($payment as $row_payment){  
                $iconexpand = '<i class="fa-solid fa-chevron-down"></i>';
                $realpaypo += $row_payment->PaymentTotal; 
                $htmlpayment .= '  
                <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                    <span class="text-detail-3 fw-bold flex-fill">Pembayaran dari No. Dokumen '.$row_payment->PaymentCode .' Tgl. '.date_format(date_create($row_payment->PaymentDate) ,"d M Y").'</span>
                    <span class="text-detail-3 fw-bold" style="width:10rem;">-</span>
                    <span class="text-detail-3 fw-bold" style="width:10rem;">-</span>
                    <span class="text-detail-3 fw-bold" style="width:10rem;">(-) Rp. '.number_format($row_payment->PaymentTotal,0).'</span>
                </div>';
            }

            $totalpo += $row->POGrandTotal; 
            $pembelian .= ' 
                <div class="d-flex p-2 align-items-center list-group-item list-group-item-action" data-bs-toggle="collapse" data-bs-target="#po-'.$row->POId.'" aria-expanded="false">
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;">'.$iconexpand.'</span>
                    <span class="text-detail-3 fw-bold flex-fill">PO dari No. Dokumen '.$row->POCode.' tgl. '. date_format(date_create($row->PODate) ,"d M Y").'</span>
                    <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">-</span>
                    <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">Rp. '.number_format($row->POGrandTotal,0).'</span>
                    <span class="text-detail-3 fw-bold ps-2 " style="width:10rem;">-</span>
                </div>
                <div class="list-group list-group-flush collapse show" id="po-'.$row->POId.'">
                    '.$htmlpayment.'
                </div>';
        }
        if($pembelian == ""){
            $pembelian = '<div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                <span class="text-detail-3 fw-bold flex-fill">Tidak ada data pembelian yang dibuat</span>
            </div>';
        }
        $html .= '
        <div class="list-group list-group-flush" data-bs-toggle="collapse" data-bs-target="#po-'.$id.'" aria-expanded="false">
            <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-head-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-chevron-down"></i></span>
                <span class="text-head-3 fw-bold flex-fill">Pembelian</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">-</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($totalpo,0).'</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">(-) Rp. '.number_format($realpaypo,0).'</span>
            </div> 
        </div> 
        <div class="list-group list-group-flush collapse show" id="po-'.$id.'"> '.$pembelian.'</div>';


        //Pengiriman
        $builder = $this->db->table("delivery");
        $builder->where('ProjectId',$id);
        $builder->orderby('DeliveryId', 'DESC'); 
        $query = $builder->get()->getResult();   
        $totalpengiriman = 0;
        $realpaypengiriman = 0;
        $delivery = "";
        foreach($query as $row){
            $htmlpayment = "";
            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->where('DeliveryId',$row->DeliveryId);
            $builder->where('PaymentDoc',1);
            $builder->where('PaymentStatus <',2);
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult(); 

            $iconexpand = '<i class="fa-solid fa-minus"></i>';
            foreach($payment as $row_payment){  
                $iconexpand = '<i class="fa-solid fa-chevron-down"></i>';
                $realpaypengiriman += $row_payment->PaymentTotal; 
                $htmlpayment .= '  
                <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                    <span class="text-detail-3 fw-bold flex-fill">Pembayaran dari No. Dokumen '.$row_payment->PaymentCode .' Tgl. '.date_format(date_create($row_payment->PaymentDate) ,"d M Y").'</span>
                    <span class="text-detail-3 fw-bold ps-3" style="width:10rem;">-</span>
                    <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">-</span>
                    <span class="text-detail-3 fw-bold ps-3" style="width:10rem;">(-) Rp. '.number_format($row_payment->PaymentTotal,0).'</span>
                </div>';
            }

            $totalpengiriman += $row->DeliveryTotal; 
            $delivery .= ' 
                <div class="d-flex p-2 align-items-center list-group-item list-group-item-action" data-bs-toggle="collapse" data-bs-target="#delivery-'.$row->DeliveryId.'" aria-expanded="false">
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                    <span class="text-detail-3 fw-bold pe-1" style="width:1rem;">'.$iconexpand.'</span>
                    <span class="text-detail-3 fw-bold flex-fill">Pengiriman dari No. Dokumen '.$row->DeliveryCode.' tgl. '. date_format(date_create($row->DeliveryDate) ,"d M Y").'</span>
                    <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">-</span>
                    <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">Rp. '.number_format($row->DeliveryTotal,0).'</span>
                    <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">-</span>
                </div>
                <div class="list-group list-group-flush collapse show" id="delivery-'.$row->DeliveryId.'">
                    '.$htmlpayment.'
                </div>';
        }
        if($delivery == ""){
            $delivery = '<div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                <span class="text-detail-3 fw-bold flex-fill">Tidak ada data pengiriman yang dibuat</span>
            </div>';
        }
        $html .= '
        <div class="list-group list-group-flush" data-bs-toggle="collapse" data-bs-target="#delivery-'.$id.'" aria-expanded="false">
            <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-head-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-chevron-down"></i></span>
                <span class="text-head-3 fw-bold flex-fill">Pengiriman</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">-</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($totalpengiriman,0).'</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">(-) Rp. '.number_format($realpaypengiriman,0).'</span>
            </div> 
        </div> 
        <div class="list-group list-group-flush collapse show" id="delivery-'.$id.'"> '.$delivery.'</div>';

        // $subtotal_debt = $totalinvoice;
        // $subtotal_crd = $totalpengiriman + $totalpo;
        // $subtotal_real = $realpayinvoice - $realpaypo - $realpaypengiriman;
        // $html .= '
        // <div class="d-flex border-top p-2 bg-light"> 
        //     <span class="text-head-2 fw-bold flex-fill">Sub Total (PENJUALAN - PEMBELIAN - PENGIRIMAN)</span>
        //     <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($subtotal_debt,0).'</span>
        //     <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($subtotal_crd,0).'</span>
        //     <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($subtotal_real,0).'</span>
        // </div> 
        // <div class="d-flex border-bottom p-2 bg-light"> 
        //     <span class="text-head-2 fw-bold flex-fill">Grand Total (PENJUALAN - PEMBELIAN - PENGIRIMAN)</span>
        //     <span class="text-head-2 fw-bold text-center" style="width:20rem;">Rp. '.number_format($subtotal_debt - $subtotal_crd,0).'</span> 
        //     <span class="text-head-2 fw-bold" style="width:10rem;">-</span>
        // </div> ';

        //MODAL  
        $listmodal = "";
        $totalmodal_debt = 0;
        $totalmodal_crt = 0;
        $realpaymodal = 0;
        $builder = $this->db->table("project_accounting");
        $builder->where('ProjectId',$id);
        $builder->where('AccGroup',1);
        $builder->orderby('AccId', 'ASC'); 
        $query = $builder->get()->getResult();
        foreach($query as $row){
            $listmodal .= ' 
            <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                <span class="text-detail-3 fw-bold flex-fill">'.$row->AccName.' Tgl. '. date_format(date_create($row->AccDate) ,"d M Y").' 
                    <a class="btn btn-sm btn-primary p-1 me-1" style="font-size: 0.65rem; padding: 0.25rem 0.5rem !important; line-height: 1; border-radius: 0.3rem;" onclick="edit_project_accounting('.$id.','.$row->AccId.',this,\'1\')">Edit</a>
                    <a class="btn btn-sm btn-danger p-1 me-1" style="font-size: 0.65rem; padding: 0.25rem 0.5rem !important; line-height: 1; border-radius: 0.3rem;" onclick="delete_project_accounting('.$id.','.$row->AccId.',this,\'1\')">Delete</a> 
                </span>
                <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">'.($row->AccType==1 ? ('Rp. '.number_format($row->AccTotal,0)) : "-").'</span>
                <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">'.($row->AccType==2 ? ('Rp. '.number_format($row->AccTotal,0)) : "-").'</span>
                <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">'.($row->AccType==2 ? ('(-) Rp. '.number_format($row->AccTotal,0)) : ('(+) Rp. '.number_format($row->AccTotal,0))).'</span>
            </div> ';
            if($row->AccType==1){ 
                $totalmodal_debt += $row->AccTotal;
                $realpaymodal +=  $row->AccTotal;
            }else{ 
                $totalmodal_crt += $row->AccTotal;
                $realpaymodal -=  $row->AccTotal;
            }  
        }
        if($listmodal == ""){
            $listmodal = '<div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                <span class="text-detail-3 fw-bold flex-fill">Tidak ada data modal yang dibuat</span>
            </div>';
        }
        $html .= ' 
        <div class="list-group list-group-flush" data-bs-toggle="collapse" data-bs-target="#modal-'.$id.'" aria-expanded="false">
            <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-head-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-chevron-down"></i></span>
                <span class="text-head-3 fw-bold flex-fill">Modal <a class="btn btn-sm btn-primary p-1 m-1" style="font-size: 0.65rem; padding: 0.25rem 0.5rem !important; line-height: 1; border-radius: 0.3rem;" onclick="add_project_accounting('.$id.',this,\'1\')">Tambah Data</a></span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($totalmodal_debt,0).'</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($totalmodal_crt,0).'</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">(+) Rp. '.number_format($realpaymodal,0).'</span> 
            </div> 
        </div>
        <div class="list-group list-group-flush collapse show" id="modal-'.$id.'"> '.$listmodal.'</div>
         ';

        //LAIN-LAIN  
        $listdll = "";
        $totaldll_debt = 0;
        $totaldll_crt = 0;
        $realpaydll = 0;
        $builder = $this->db->table("project_accounting");
        $builder->where('ProjectId',$id);
        $builder->where('AccGroup',2);
        $builder->orderby('AccId', 'ASC'); 
        $query = $builder->get()->getResult();    
        foreach($query as $row){
            $listdll .= ' 
            <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                <span class="text-detail-3 fw-bold flex-fill">'.$row->AccName.' Tgl. '. date_format(date_create($row->AccDate) ,"d M Y").' 
                    <a class="btn btn-sm btn-primary p-1 me-1" style="font-size: 0.65rem; padding: 0.25rem 0.5rem !important; line-height: 1; border-radius: 0.3rem;" onclick="edit_project_accounting('.$id.','.$row->AccId.',this,\'2\')">Edit</a>
                    <a class="btn btn-sm btn-danger p-1 me-1" style="font-size: 0.65rem; padding: 0.25rem 0.5rem !important; line-height: 1; border-radius: 0.3rem;" onclick="delete_project_accounting('.$id.','.$row->AccId.',this,\'2\')">Delete</a> 
                </span>
                <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">'.($row->AccType==1 ? ('Rp. '.number_format($row->AccTotal,0)) : "-").'</span>
                <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">'.($row->AccType==2 ? ('Rp. '.number_format($row->AccTotal,0)) : "-").'</span>
                <span class="text-detail-3 fw-bold ps-2" style="width:10rem;">'.($row->AccType==2 ? ('(-) Rp. '.number_format($row->AccTotal,0)) : ('(+) Rp. '.number_format($row->AccTotal,0))).'</span>
            </div>';
            if($row->AccType==1){ 
                $totaldll_debt += $row->AccTotal;
                $realpaydll +=  $row->AccTotal;
            }else{ 
                $totaldll_crt += $row->AccTotal;
                $realpaydll -=  $row->AccTotal;
            }  
        }
        if($listdll == ""){
            $listdll = '<div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"></span>
                <span class="text-detail-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-minus"></i></span>
                <span class="text-detail-3 fw-bold flex-fill">Tidak ada data lain lain yang dibuat</span>
            </div>';
        }
        $html .= ' 
        <div class="list-group list-group-flush" data-bs-toggle="collapse" data-bs-target="#dll-'.$id.'" aria-expanded="false">
            <div class="d-flex p-2 align-items-center list-group-item list-group-item-action">
                <span class="text-head-3 fw-bold pe-1" style="width:1rem;"><i class="fa-solid fa-chevron-down"></i></span>
                <span class="text-head-3 fw-bold flex-fill">Biaya Lain-Lain <a class="btn btn-sm btn-primary p-1 m-1" style="font-size: 0.65rem; padding: 0.25rem 0.5rem !important; line-height: 1; border-radius: 0.3rem;" onclick="add_project_accounting('.$id.',this,\'2\')">Tambah Data</a></span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($totaldll_debt,0).'</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($totaldll_crt,0).'</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">(+) Rp. '.number_format($realpaydll,0).'</span> 
            </div> 
        </div> 
        <div class="list-group list-group-flush collapse show" id="dll-'.$id.'"> '.$listdll.'</div>';

 

        $grandtotal_debt = $totalinvoice + $totalmodal_debt + $totaldll_debt;
        $grandtotal_crd = $totalpengiriman + $totalpo + $totalmodal_crt + $totaldll_crt;
        $grandtotal_real = $realpayinvoice - $realpaypo - $realpaypengiriman + $realpaymodal + $realpaydll;
        $html .= ' 
            <div class="d-flex border-top p-2 bg-light border-primary-subtle"> 
                <span class="text-head-2 fw-bold flex-fill">Sub Total</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($grandtotal_debt,0).'</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($grandtotal_crd,0).'</span>
                <span class="text-head-2 fw-bold" style="width:10rem;">Rp. '.number_format($grandtotal_real,0).'</span>
            </div> 
            <div class="d-flex border-top p-2 bg-light border-primary-subtle"> 
                <span class="text-head-2 fw-bold flex-fill">Grand Total</span>
                <span class="text-head-2 fw-bold" style="width:20rem;">Rp. '.number_format($grandtotal_debt - $grandtotal_crd,0).'</span> 
                <span class="text-head-2 fw-bold" style="width:10rem;">-</span>
            </div> 
        </div> 
        <script>   
            $(".list-group a").on("click", function(event) { 
                console.log("a click");
                event.preventDefault();
                event.stopPropagation(); 
            });
        </script>
        ';
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        );
    }
 
    /**
     * FUNCTION UNTUK Function
     */ 
    private function simpan_gambar_base64($base64, $lokasi,$nama) {
        $parts = explode(',', $base64);
        $header = $parts[0];
        $extension = '';
        
        switch ($header) {
            case 'data:image/jpeg;base64':
                $extension = '.jpg';
                break;
            case 'data:image/png;base64':
                $extension = '.png';
                break;
            case 'data:image/gif;base64':
                $extension = '.gif';
                break;
            case 'data:image/bmp;base64':
                $extension = '.bmp';
                break;
            default:
                return 'Jenis file tidak didukung';
        }
        
        $nama_file = $nama . $extension;
        $biner = base64_decode($parts[1]);
        file_put_contents($lokasi ."/". $nama_file, $biner); 
        return $lokasi ."/". $nama_file;
    }
    private function get_next_code_sample($date){
        //sample SPH/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("sample");  
        $builder->select("ifnull(max(SUBSTRING(SampleCode,5,3)),0) + 1 as nextcode");
        $builder->where("month(SampleDate2)",$arr_date[1]);
        $builder->where("year(SampleDate2)",$arr_date[0]);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "SPL/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "SPL/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "SPL/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "SPL/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    }
    private function get_next_code_penawaran($date){
        //sample SPH/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("penawaran");  
        $builder->select("ifnull(max(SUBSTRING(SphCode,5,3)),0) + 1 as nextcode"); 
        $builder->where("month(SphDate2)",$arr_date[1]);
        $builder->where("year(SphDate2)",$arr_date[0]);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "SPH/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "SPH/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "SPH/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "SPH/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    }
    private function get_next_code_invoice($date){
        //sample INV/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("invoice");  
        $builder->select("ifnull(max(SUBSTRING(InvCode,5,3)),0) + 1 as nextcode"); 
        $builder->where("month(InvDate2)",$arr_date[1]);
        $builder->where("year(InvDate2)",$arr_date[0]);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "INV/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "INV/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "INV/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "INV/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    }
    private function get_next_code_payment($date){
        //sample INV/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("payment");  
        $builder->select("ifnull(max(SUBSTRING(PaymentCode,5,3)),0) + 1 as nextcode"); 
        $builder->where("month(PaymentDate2)",$arr_date[1]);
        $builder->where("year(PaymentDate2)",$arr_date[0]);
        $builder->where("PaymentDoc",1);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "PAY/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "PAY/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "PAY/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "PAY/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    }
    private function get_next_code_proforma($date){
        //sample INV/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("payment");  
        $builder->select("ifnull(max(SUBSTRING(PaymentCode,5,3)),0) + 1 as nextcode");
        $builder->where("month(PaymentDate2)",$arr_date[1]);
        $builder->where("year(PaymentDate2)",$arr_date[0]); 
        $builder->where("PaymentDoc",2);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "PRO/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "PRO/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "PRO/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "PRO/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    }
    private function get_next_code_delivery($date){
        //sample SPH/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("delivery");  
        $builder->select("ifnull(max(SUBSTRING(DeliveryCode,5,3)),0) + 1 as nextcode"); 
        $builder->where("month(DeliveryDate2)",$arr_date[1]);
        $builder->where("year(DeliveryDate2)",$arr_date[0]); 
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "DEL/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "DEL/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "DEL/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "DEL/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    } 
    private function get_next_code_pembelian($date){
        //sample SPH/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("pembelian");  
        $builder->select("ifnull(max(SUBSTRING(POCode,4,3)),0) + 1 as nextcode"); 
        $builder->where("month(PODate2)",$arr_date[1]);
        $builder->where("year(PODate2)",$arr_date[0]); 
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)){
            case 1:
                $nextid = "PO/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "PO/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "PO/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "PO/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    } 

    public function getSelectRefVendor($refid,$search = null){
        $builder = $this->db->query('SELECT * FROM 
        (SELECT SphId refid, SphCode as code,ProjectId ref,SphDate date, CustomerId custid, "SPH" AS type FROM penawaran UNION SELECT InvId refid,InvCode,ProjectId ref,InvDate date,CustomerId, "INV" FROM invoice) AS ref_join
        LEFT JOIN customer ON CustomerId = ref_join.custid
        WHERE ref_join.ref = '.$refid.'
        ORDER BY ref_join.date asc');
        return $builder->getResultArray();  
    }

    public function getSelectRefInvoice($refid,$search = null){
        $builder = $this->db->query('SELECT *  FROM penawaran left join customer ON customer.CustomerId = penawaran.CustomerId
        WHERE SphRef = '.$refid.'  ORDER BY SphDate asc');
        return $builder->getResultArray();  
    }

    /**
     * FUNCTION UNTUK Project
     */ 
    public function insert_data_project($data){
        $builder = $this->db->table($this->table); 
        $builder->insert(array(
            "CustomerId"=>$data["CustomerId"],
            "ProjectDate"=>$data["ProjectDate"],
            "StoreId"=>$data["StoreId"],
            "ProjectCategory"=>$data["ProjectCategory"],
            "ProjectComment"=>$data["ProjectComment"],
            "ProjectName"=>$data["ProjectName"],
            "UserId"=>$data["UserId"],
            "ProjectAdmin"=>$data["ProjectAdmin"], 
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
        )); 
        
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->orderby('ProjectId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        echo json_encode(array("status"=>true,"data"=>$query)); 
    }
    public function update_data_project($data,$id){
        $builder = $this->db->table($this->table);   
        $builder->set('CustomerId', $data["CustomerId"]); 
        $builder->set('ProjectDate', $data["ProjectDate"]);  
        $builder->set('StoreId', $data["StoreId"]); 
        $builder->set('ProjectCategory', $data["ProjectCategory"]); 
        $builder->set('ProjectComment', $data["ProjectComment"]); 
        $builder->set('UserId', $data["UserId"]); 
        $builder->set('ProjectAdmin', $data["ProjectAdmin"]);  
        $builder->set('ProjectName', $data["ProjectName"]); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('ProjectId', $id); 
        $builder->update();    
        echo json_encode(array("status"=>true)); 
    }
    public function delete_data_project($id){
        $builder = $this->db->table($this->table);
        $builder->set('ProjectStatus',2); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('ProjectId',$id);
        $builder->update();  

        return JSON_ENCODE(array("status"=>true));
    } 
    public function insert_data_project_category($data){
        $builder = $this->db->table("project_category"); 
        $builder->insert(array(
            "name"=>$data["name"], 
        )); 
        
        $builder = $this->db->table("project_category");
        $builder->select('*');
        $builder->orderby('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        echo json_encode(array("status"=>true,"data"=>$query)); 
    }

    /**
     * FUNCTION UNTUK Sample
     */ 

    public function insert_data_sample($data){ 
        $header = $data["header"]; 

        $builder = $this->db->table("sample");
        $builder->insert(array(
            "SampleCode"=>$this->get_next_code_sample($header["SampleDate"]),
            "SampleDate"=>$header["SampleDate"],
            "SampleDate2"=>$header["SampleDate"],  
            "ProjectId"=>$header["SampleRef"],
            "SampleAdmin"=>$header["SampleAdmin"],
            "CustomerId"=>$header["CustomerId"],
            "SampleAddress"=>$header["SampleAddress"],
            "TemplateId"=>$header["TemplateId"],
            "SampleSubTotal"=>$header["SampleSubTotal"],
            "SampleDiscItemTotal"=>$header["SampleDiscItemTotal"],
            "SampleDiscTotal"=>$header["SampleDiscTotal"],
            "SampleGrandTotal"=>$header["SampleGrandTotal"],
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("sample");
        $builder->select('*');
        $builder->orderby('SampleId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SampleDetailRef"] = $query->SampleId;
            $row["SampleDetailVarian"] = (isset($row["SampleDetailVarian"]) ? json_encode($row["SampleDetailVarian"]) : "[]");  
            $builder = $this->db->table("sample_detail");
            $builder->insert($row); 
        }

    }
    public function update_data_sample($data,$id){ 
        $header = $data["header"]; 

        $builder = $this->db->table("sample"); 
        $builder->set('SampleDate', $header["SampleDate"]);   
        $builder->set('SampleAdmin', $header["SampleAdmin"]);  
        $builder->set('SampleAddress', $header["SampleAddress"]); 
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('SampleSubTotal', $header["SampleSubTotal"]); 
        $builder->set('SampleDiscItemTotal', $header["SampleDiscItemTotal"]); 
        $builder->set('SampleDiscTotal', $header["SampleDiscTotal"]); 
        $builder->set('SampleGrandTotal', $header["SampleGrandTotal"]);  
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $id); 
        $builder->update(); 

        $builder = $this->db->table("sample_detail");
        $builder->where('SampleDetailRef',$id);
        $builder->delete(); 
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SampleDetailRef"] = $id;
            $row["SampleDetailVarian"] = (isset($row["SampleDetailVarian"]) ? json_encode($row["SampleDetailVarian"]) : "[]");  
            $builder = $this->db->table("sample_detail");
            $builder->insert($row); 
        } 

    } 
    public function delete_data_sample($id){   
        $builder = $this->db->table("sample"); 
        $builder->set('SampleStatus', 2);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $id); 
        $builder->update();   

        return JSON_ENCODE(array("status"=>true));
    } 
    public function getdataSample($id){
        $builder = $this->db->table("sample"); 
        $builder->join("customer","sample.CustomerId = customer.CustomerId","left");
        $builder->join("project","project.ProjectId = sample.ProjectId","left");
        $builder->join("template_footer","TemplateId = template_footer.TemplateFooterId","left");
        $builder->where('SampleId',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    }
    public function getdataDetailSample($id){
        $builder = $this->db->table("sample_detail");
        $builder->where('SampleDetailRef',$id); 
        return $builder->get()->getResult();  
    }

    /**
     * FUNCTION UNTUK SPH / PENAWARAN
     */ 

    public function insert_data_penawaran($data){ 
        $header = $data["header"]; 

        $builder = $this->db->table("penawaran");
        $builder->insert(array(
            "SphCode"=>$this->get_next_code_penawaran($header["SphDate"]),
            "SphDate"=>$header["SphDate"],
            "SphDate2"=>$header["SphDate"],  
            "ProjectId"=>$header["ProjectId"],
            "SampleId"=>$header["SampleId"],
            "SphAdmin"=>$header["SphAdmin"],
            "CustomerId"=>$header["CustomerId"],
            "SphAddress"=>$header["SphAddress"],
            "TemplateId"=>$header["TemplateId"],
            "SphSubTotal"=>$header["SphSubTotal"],
            "SphDiscItemTotal"=>$header["SphDiscItemTotal"],
            "SphDiscTotal"=>$header["SphDiscTotal"],
            "SphGrandTotal"=>$header["SphGrandTotal"],
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->orderby('SphId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SphDetailRef"] = $query->SphId;
            $row["SphDetailVarian"] = (isset($row["SphDetailVarian"]) ? json_encode($row["SphDetailVarian"]) : "[]");  
            $builder = $this->db->table("penawaran_detail");
            $builder->insert($row); 
        }

        //update status sample
        $builder = $this->db->table("sample"); 
        $builder->set('SampleStatus', 1); 
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $header["SampleId"]); 
        $builder->update(); 

    }
    public function update_data_penawaran($data,$id){ 
        $header = $data["header"]; 

        $builder = $this->db->table("penawaran"); 
        $builder->set('SphDate', $header["SphDate"]);   
        $builder->set('SphAdmin', $header["SphAdmin"]);  
        $builder->set('SphAddress', $header["SphAddress"]); 
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('SphSubTotal', $header["SphSubTotal"]); 
        $builder->set('SphDiscItemTotal', $header["SphDiscItemTotal"]); 
        $builder->set('SphDiscTotal', $header["SphDiscTotal"]); 
        $builder->set('SphGrandTotal', $header["SphGrandTotal"]);  
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SphId', $id); 
        $builder->update(); 

        $builder = $this->db->table("penawaran_detail");
        $builder->where('SphDetailRef',$id);
        $builder->delete(); 
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SphDetailRef"] = $id;
            $row["SphDetailVarian"] = (isset($row["SphDetailVarian"]) ? json_encode($row["SphDetailVarian"]) : "[]");  
            $builder = $this->db->table("penawaran_detail");
            $builder->insert($row); 
        } 
    }
    public function delete_data_penawaran($id){
        $builder = $this->db->table("penawaran");
        $builder->set('SphStatus', 2); 
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));
        $builder->where('SphId',$id);  
        $builder->update();  

        return JSON_ENCODE(array("status"=>true));
    }  
    public function getdataSPH($id){  
        $builder = $this->db->table("penawaran");  
        $builder->join("customer","penawaran.CustomerId = customer.CustomerId","left");
        $builder->join("project","project.ProjectId = penawaran.ProjectId","left"); 
        $builder->join("template_footer","penawaran.TemplateId = template_footer.TemplateFooterId","left");
        $builder->where('penawaran.SphId',$id); 
        $builder->limit(1);
        return $builder->get()->getRow();   
    }
    public function getdataDetailSPH($id){
        $builder = $this->db->table("penawaran_detail");
        $builder->where('SphDetailRef',$id); 
        return $builder->get()->getResult();  
    }

    /**
     * FUNCTION UNTUK INVOICE / FAKTUR
     */ 
 
    public function insert_data_invoice($data){ 
        $header = $data["header"]; 

        $builder = $this->db->table("invoice");
        $builder->insert(array(
            "InvCode"=>$this->get_next_code_invoice($header["InvDate"]),
            "InvDate"=>$header["InvDate"], 
            "InvDate2"=>$header["InvDate"],  
            "ProjectId"=>$header["ProjectId"],
            "SampleId"=>$header["SampleId"],
            "SphId"=>$header["SphId"],
            "InvAdmin"=>$header["InvAdmin"],
            "CustomerId"=>$header["CustomerId"],
            "InvAddress"=>$header["InvAddress"],
            "TemplateId"=>$header["TemplateId"],
            "InvSubTotal"=>$header["InvSubTotal"],
            "InvDiscItemTotal"=>$header["InvDiscItemTotal"],
            "InvDiscTotal"=>$header["InvDiscTotal"], 
            "InvImageList"=> (isset($header["InvImageList"]) ? json_encode($header["InvImageList"]) : "[]"),
            "InvKtp"=>$header["InvKtp"], 
            "InvNpwp"=>$header["InvNpwp"],  
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("invoice");
        $builder->select('*');
        $builder->orderby('InvId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["InvDetailRef"] = $query->InvId;
            $row["InvDetailVarian"] = (isset($row["InvDetailVarian"]) ? json_encode($row["InvDetailVarian"]) : "[]");  
            $builder = $this->db->table("invoice_detail");
            $builder->insert($row); 
        }

        
        //update status sample
        $builder = $this->db->table("sample"); 
        $builder->set('SampleStatus', 1); 
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $header["SampleId"]); 
        $builder->update(); 

        //update status penawaran
        $builder = $this->db->table("penawaran"); 
        $builder->set('SphStatus', 1); 
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SphId', $header["SphId"]); 
        $builder->update(); 

    } 
    public function update_data_invoice($data,$id){ 
        $header = $data["header"]; 

        $builder = $this->db->table("invoice"); 
        $builder->set('InvDate', $header["InvDate"]);   
        $builder->set('InvAdmin', $header["InvAdmin"]); 
        $builder->set('InvAddress', $header["InvAddress"]); 
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('InvSubTotal', $header["InvSubTotal"]); 
        $builder->set('InvDiscItemTotal', $header["InvDiscItemTotal"]); 
        $builder->set('InvDiscTotal', $header["InvDiscTotal"]); 
        $builder->set('InvGrandTotal', $header["InvGrandTotal"]);  
        $builder->set('InvNpwp', $header["InvNpwp"]);  
        $builder->set('InvKtp', $header["InvKtp"]);  
        $builder->set('InvImageList', (isset($header["InvImageList"]) ? json_encode($header["InvImageList"]) : "[]"));
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('InvId', $id); 
        $builder->update(); 

        $builder = $this->db->table("invoice_detail");
        $builder->where('InvDetailRef',$id);
        $builder->delete(); 

        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["InvDetailRef"] = $id;
            $row["InvDetailVarian"] = (isset($row["InvDetailVarian"]) ? json_encode($row["InvDetailVarian"]) : "[]");  
            $builder = $this->db->table("invoice_detail");
            $builder->insert($row); 
        } 
    }
    public function delete_data_invoice($id){
        $builder = $this->db->table("invoice");
        $builder->set('InvStatus','3'); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('InvId',$id);
        $builder->update();  

        return JSON_ENCODE(array("status"=>true));
    }
    public function getdataInvoice($id){
        $builder = $this->db->table("invoice");
        $builder->select("*,InvNpwp NpwpId,b.Name NpwpName,b.Image NpwpImage, InvKtp KtpId,a.Name KtpName,a.Image KtpImage");
        $builder->join("customer","invoice.CustomerId = customer.CustomerId","left");
        $builder->join("users","id = InvAdmin","left");
        $builder->join("project","project.ProjectId = invoice.ProjectId","left");
        $builder->join("template_footer","TemplateId = template_footer.TemplateFooterId","left");
        $builder->join("lampiran a","a.Id = invoice.InvKtp","left");
        $builder->join("lampiran b","b.Id = invoice.InvNpwp","left");
        $builder->where('InvId',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    }
    public function getdataDetailInvoice($id){
        $builder = $this->db->table("invoice_detail");
        $builder->where('InvDetailRef',$id); 
        return $builder->get()->getResult();  
    }
 
    /**
     * FUNCTION UNTUK PAYMENT
     */ 

     
    public function insert_data_payment($data){
        $builder = $this->db->table("payment");
        $builder->insert(array( 
            "PaymentCode"=>$this->get_next_code_payment($data["PaymentDate"]),
            "InvId"=>$data["InvId"],
            "SampleId"=>$data["SampleId"],
            "POId"=>$data["POId"],
            "DeliveryId"=>$data["DeliveryId"],
            "ProjectId"=>$data["ProjectId"],
            "PaymentDate"=>$data["PaymentDate"],
            "PaymentDate2"=>$data["PaymentDate"],
            "PaymentType"=>$data["PaymentType"],
            "PaymentMethod"=>$data["PaymentMethod"],
            "PaymentTotal"=>$data["PaymentTotal"],
            "PaymentNote"=>$data["PaymentNote"], 
            "PaymentDoc"=>1,  
            "TemplateId"=>$data["TemplateId"],  
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("payment");
        $builder->select('*');
        $builder->orderby('PaymentId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  

        //Buat folder utama
        $folder_utama = 'assets/images/payment'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 

        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$data["ProjectId"])) {
            mkdir($folder_utama."/".$data["ProjectId"], 0777, true);  
        }

        if($data["SampleId"] !== ""){
            if (!file_exists($folder_utama."/".$data["ProjectId"]."/sample")) {
                mkdir($folder_utama."/".$data["ProjectId"]."/sample", 0777, true);  
            }
            $folder_utama = $folder_utama."/".$data["ProjectId"]."/sample"; 
        }
        if($data["InvId"] !== ""){
            if (!file_exists($folder_utama."/".$data["ProjectId"]."/invoice")) {
                mkdir($folder_utama."/".$data["ProjectId"]."/invoice", 0777, true);  
            }
            $folder_utama = $folder_utama."/".$data["ProjectId"]."/invoice"; 
        }
        if($data["DeliveryId"] !== ""){
            if (!file_exists($folder_utama."/".$data["ProjectId"]."/delivery")) {
                mkdir($folder_utama."/".$data["ProjectId"]."/delivery", 0777, true);  
            }
            $folder_utama = $folder_utama."/".$data["ProjectId"]."/delivery"; 
        }
        if($data["POId"] !== ""){
            if (!file_exists($folder_utama."/".$data["ProjectId"]."/pembelian")) {
                mkdir($folder_utama."/".$data["ProjectId"]."/pembelian", 0777, true);  
            }
            $folder_utama = $folder_utama."/".$data["ProjectId"]."/pembelian"; 
        }

        if (isset($data['image'])) {  
            $data_image = $this->simpan_gambar_base64($data['image'], $folder_utama, $query->PaymentId);  
        }

    }
    public function update_data_payment($data,$id){
        $builder = $this->db->table("payment"); 
        $builder->set('PaymentDate', $data["PaymentDate"]);
        $builder->set('PaymentType', $data["PaymentType"]); 
        $builder->set('PaymentMethod', $data["PaymentMethod"]); 
        $builder->set('PaymentTotal', $data["PaymentTotal"]); 
        $builder->set('PaymentNote', $data["PaymentNote"]);    
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));   
        $builder->where('PaymentId', $id); 
        $builder->update(); 
 

        //Buat folder utama
        $folder_utama = 'assets/images/payment'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 

        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$data["ProjectId"])) {
            mkdir($folder_utama."/".$data["ProjectId"], 0777, true);  
        }
        if($data["SampleId"] = ""){
            if (!file_exists($folder_utama."/".$data["ProjectId"]."/invoice")) {
                mkdir($folder_utama."/".$data["ProjectId"]."/invoice", 0777, true);  
            }
            $folder_utama = $folder_utama."/".$data["ProjectId"]."/invoice"; 
        }else{
            if (!file_exists($folder_utama."/".$data["ProjectId"]."/sample")) {
                mkdir($folder_utama."/".$data["ProjectId"]."/sample", 0777, true);  
            }
            $folder_utama = $folder_utama."/".$data["ProjectId"]."/sample"; 
        }
            //Remove image yang lama
        $filename = $folder_utama."/".$id.'.*';
        $files = glob($filename); 
        foreach ($files as $file) {
            unlink($file);
        }
        if (isset($data['image'])) {  
            $data_image = $this->simpan_gambar_base64($data['image'], $folder_utama, $id);  
        } 

    }
    public function delete_data_payment($id){
        $builder = $this->db->table("payment");
        $builder->where('PaymentId',$id);
        $builder->delete();   
        return JSON_ENCODE(array("status"=>true));
    }
    public function getdataPaymentByInvoice($id){
        $builder = $this->db->table("payment"); 
        $builder->where('InvId',$id); 
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getResult();  
    }
    public function getdataPaymentBySample($id){
        $builder = $this->db->table("payment"); 
        $builder->where('SampleId',$id); 
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getResult();  
    }
    public function getdataPaymentByPO($id){
        $builder = $this->db->table("payment"); 
        $builder->where('POId',$id); 
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getResult();  
    }
    public function getdataPaymentByDelivery($id){
        $builder = $this->db->table("payment"); 
        $builder->where('DeliveryId',$id); 
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getResult();  
    }
    public function getdataPayment($id){
        $builder = $this->db->table("payment"); 
        $builder->where('PaymentId',$id); 
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getRow();  
    }
    public function getdataImagePayment($projectid,$invid,$sampleid,$id){

        // Cek apakah file gambar ada 
        if($invid > 0) { 
            $path_gambar = 'assets/images/payment/'.$projectid.'/invoice/'.$id.'.*'; 
        }
        if($sampleid > 0) { 
            $path_gambar = 'assets/images/payment/'.$projectid.'/sample/'.$id.'.*'; 
        }
        $files = glob($path_gambar);
        foreach ($files as $file) {
            if (!file_exists($file)) {
                return "";
            }
    
            // Ambil jenis file gambar
            $jenis_gambar = mime_content_type($file);
    
            // Baca file gambar
            $gambar = file_get_contents($file);
    
            // Ubah gambar ke base64
            $base64 = base64_encode($gambar);
    
            // Tambahkan header jenis file gambar
            $base64 = "data:$jenis_gambar;base64,$base64";
    
            return $base64;
        }
       
    }

     
    /**
     * FUNCTION UNTUK PROFORMA
     */ 

    public function insert_data_proforma($data){
        $builder = $this->db->table("payment");
        $builder->insert(array(
            "PaymentCode"=>$this->get_next_code_proforma($data["PaymentDate"]),
            "InvId"=>$data["InvId"],
            "PaymentDate"=>$data["PaymentDate"],
            "PaymentDate2"=>$data["PaymentDate"],
            "PaymentType"=>$data["PaymentType"],
            "PaymentMethod"=>$data["PaymentMethod"],
            "PaymentTotal"=>$data["PaymentTotal"],
            "PaymentNote"=>$data["PaymentNote"], 
            "PaymentDoc"=>2,  
            "TemplateId"=>$data["TemplateId"],  
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("payment");
        $builder->select('*');
        $builder->orderby('PaymentId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();    
    }
    public function update_data_proforma($data,$id){
        $builder = $this->db->table("payment"); 
        $builder->set('PaymentDate', $data["PaymentDate"]);
        $builder->set('PaymentType', $data["PaymentType"]); 
        $builder->set('PaymentMethod', $data["PaymentMethod"]); 
        $builder->set('PaymentTotal', $data["PaymentTotal"]); 
        $builder->set('PaymentNote', $data["PaymentNote"]);    
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));   
        $builder->where('PaymentId', $id); 
        $builder->update();   
    }
    public function getdataProformaByRef($id){
        $builder = $this->db->table("payment"); 
        $builder->where('InvId',$id); 
        $builder->where('PaymentDoc',2); 
        return $builder->get()->getResult();  
    }
    public function getdataProforma($id){
        $builder = $this->db->table("payment"); 
        $builder->where('PaymentId',$id); 
        $builder->where('PaymentDoc',2); 
        return $builder->get()->getRow();  
    }
    
    /**
     * FUNCTION UNTUK DELIVERY
     */ 
    public function insert_data_delivery($data){ 
        $header = $data["header"]; 

        $builder = $this->db->table("delivery");
        $builder->insert(array(
            "DeliveryCode"=>$this->get_next_code_delivery($header["DeliveryDate"]),
            "DeliveryDate"=>$header["DeliveryDate"], 
            "DeliveryDate2"=>$header["DeliveryDate"],  
            "InvId"=>$header["InvId"], 
            "SampleId"=>$header["SampleId"], 
            "ProjectId"=>$header["ProjectId"], 
            "DeliveryAdmin"=>$header["DeliveryAdmin"],
            "DeliveryArmada"=>$header["DeliveryArmada"],
            "DeliveryRitase"=>$header["DeliveryRitase"],
            "DeliveryTotal"=>$header["DeliveryTotal"],
            "DeliveryToName"=>$header["DeliveryToName"],
            "DeliveryToTelp"=>$header["DeliveryToTelp"],
            "DeliveryToAddress"=>$header["DeliveryToAddress"],
            "DeliveryFromName"=>$header["DeliveryFromName"],
            "DeliveryFromTelp"=>$header["DeliveryFromTelp"],
            "DeliveryFromAddress"=>$header["DeliveryFromAddress"],
            "TemplateId"=>$header["TemplateId"],
            "DeliveryStatus"=>0,
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("delivery");
        $builder->select('*');
        $builder->orderby('DeliveryId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["DeliveryDetailRef"] = $query->DeliveryId;
            $row["DeliveryDetailVarian"] = (isset($row["DeliveryDetailVarian"]) ? json_encode($row["DeliveryDetailVarian"]) : "[]");  
            $builder = $this->db->table("delivery_detail");
            $builder->insert($row); 
        }

    } 
    public function update_data_delivery($data,$id){ 
        $header = $data["header"]; 

        $builder = $this->db->table("delivery"); 
        $builder->set('DeliveryDate', $header["DeliveryDate"]);  
        $builder->set('DeliveryAdmin', $header["DeliveryAdmin"]);
        $builder->set('DeliveryArmada', $header["DeliveryArmada"]);  
        $builder->set('DeliveryRitase', $header["DeliveryRitase"]);  
        $builder->set('DeliveryTotal', $header["DeliveryTotal"]);   
        $builder->set('DeliveryToName', $header["DeliveryToName"]); 
        $builder->set('DeliveryToTelp', $header["DeliveryToTelp"]); 
        $builder->set('DeliveryToAddress', $header["DeliveryToAddress"]); 
        $builder->set('DeliveryFromName', $header["DeliveryFromName"]); 
        $builder->set('DeliveryFromTelp', $header["DeliveryFromTelp"]); 
        $builder->set('DeliveryFromAddress', $header["DeliveryFromAddress"]); 
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));   
        $builder->where('DeliveryId', $id); 
        $builder->update(); 

        $builder = $this->db->table("delivery_detail");
        $builder->where('DeliveryDetailRef',$id);
        $builder->delete(); 

        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["DeliveryDetailRef"] = $id;
            $row["DeliveryDetailVarian"] = (isset($row["DeliveryDetailVarian"]) ? json_encode($row["DeliveryDetailVarian"]) : "[]");  
            $builder = $this->db->table("delivery_detail");
            $builder->insert($row); 
        } 
    }
    public function delete_data_delivery($id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryStatus',3); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  
 

        return JSON_ENCODE(array("status"=>true));
    }
    public function proses_data_delivery($data,$id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryDateProses', $data["DeliveryDateProses"]); 
        $builder->set('DeliveryStatus', 1); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  

        $folder_utama = 'assets/images/delivery'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)){
            mkdir($folder_utama."/".$id, 0777, true);  
        }
        $files = glob($folder_utama."/".$id. '/proses.*');
        foreach ($files as $file) {
            unlink($file);
        } 
        if (isset($data['image'])) {  
            $data_image = $this->simpan_gambar_base64($data['image'], $folder_utama."/".$id, "proses");  
        }
        return JSON_ENCODE(array("status"=>true));
    }
    public function edit_proses_data_delivery($data,$id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryDateProses', $data["DeliveryDateProses"]);  
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  

        $folder_utama = 'assets/images/delivery'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)){
            mkdir($folder_utama."/".$id, 0777, true);  
        }
        $files = glob($folder_utama."/".$id. '/proses.*');
        foreach ($files as $file) {
            unlink($file);
        } 
        if (isset($data['image'])) {  
            $data_image = $this->simpan_gambar_base64($data['image'], $folder_utama."/".$id, "proses");  
        }
        return JSON_ENCODE(array("status"=>true));
    }
    public function finish_data_delivery($data,$id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryDateFinish', $data["header"]["DeliveryDateFinish"]); 
        $builder->set('DeliveryReceiveName', $data["header"]["DeliveryReceiveName"]); 
        $builder->set('DeliveryStatus', 2); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  

        $folder_utama = 'assets/images/delivery'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)){
            mkdir($folder_utama."/".$id, 0777, true);  
        }
        $files = glob($folder_utama."/".$id. '/finish.*');
        foreach ($files as $file) {
            unlink($file);
        } 
        if (isset($data["header"]['Image'])) {
            $data_image = $this->simpan_gambar_base64($data["header"]['Image'], $folder_utama."/".$id, "finish");  
        } 
        foreach($data["detail"] as $row){  
            $varian = (isset($row["DeliveryDetailVarian"]) ? json_encode($row["DeliveryDetailVarian"]) : "[]");  
            $builder = $this->db->table("delivery_detail"); 
            $builder->set('DeliveryDetailQtyReceive', $row["DeliveryDetailQtyReceive"]); 
            $builder->set('DeliveryDetailQtyReceiveSpare', $row["DeliveryDetailQtyReceiveWaste"]); 
            $builder->set('DeliveryDetailQtyReceiveWaste', $row["DeliveryDetailQtyReceiveWaste"]); 
            $builder->where('ProdukId',$row["ProdukId"]);
            $builder->where('DeliveryDetailVarian',$varian);
            $builder->where('DeliveryDetailRef',$id);
            $builder->update();  
        } 

        return JSON_ENCODE(array("status"=>true));
    }
    public function finish_data_delivery_edit($data,$id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryDateFinish', $data["header"]["DeliveryDateFinish"]); 
        $builder->set('DeliveryReceiveName', $data["header"]["DeliveryReceiveName"]);  
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  

        $folder_utama = 'assets/images/delivery'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)){
            mkdir($folder_utama."/".$id, 0777, true);  
        }
        $files = glob($folder_utama."/".$id. '/finish.*');
        foreach ($files as $file) {
            unlink($file);
        } 
        if (isset($data["header"]['Image'])) {
            $data_image = $this->simpan_gambar_base64($data["header"]['Image'], $folder_utama."/".$id, "finish");  
        } 
        foreach($data["detail"] as $row){  
            $varian = (isset($row["DeliveryDetailVarian"]) ? json_encode($row["DeliveryDetailVarian"]) : "[]");  
            $builder = $this->db->table("delivery_detail"); 
            $builder->set('DeliveryDetailQtyReceive', $row["DeliveryDetailQtyReceive"]); 
            $builder->set('DeliveryDetailQtyReceiveSpare', $row["DeliveryDetailQtyReceiveWaste"]); 
            $builder->set('DeliveryDetailQtyReceiveWaste', $row["DeliveryDetailQtyReceiveWaste"]); 
            $builder->where('ProdukId',$row["ProdukId"]);
            $builder->where('DeliveryDetailVarian',$varian);
            $builder->where('DeliveryDetailRef',$id);
            $builder->update();  
        } 

        return JSON_ENCODE(array("status"=>true));
    }

    public function getdataDelivery($id){
        $builder = $this->db->table("delivery"); 
        $builder->select("*,delivery.ProjectId,delivery.InvId,delivery.SampleId,delivery.POId,delivery.TemplateId"); 
        $builder->join('invoice',"invoice.InvId=delivery.InvId","left"); 
        $builder->join('sample',"sample.SampleId=delivery.SampleId","left");  
        $builder->join('pembelian',"pembelian.POId=delivery.POId","left");   
        $builder->join('project',"project.ProjectId=delivery.ProjectId","left");   
        $builder->join('customer',"project.CustomerId=customer.CustomerId","left");   
        $builder->join('store',"store.StoreId=project.StoreId","left"); 
        $builder->join("template_footer","delivery.TemplateId = template_footer.TemplateFooterId","left");
        $builder->where('delivery.DeliveryId',$id);  
        return $builder->get()->getRow();  
    }
    public function getdataDetailDelivery($id){
        $builder = $this->db->table("delivery_detail"); 
        $builder->where('DeliveryDetailRef',$id);  
        return $builder->get()->getResult();  
    }
    public function getdataInvoiceByDelivery($ref,$produkid,$varian,$text){
        $arr_detail_invoice = $this->getdataDetailInvoice($ref);
        foreach($arr_detail_invoice as $row){
            if($row->ProdukId == $produkid && $row->InvDetailVarian == $varian && $row->InvDetailText == $text){
                return $row->InvDetailQty;
            } 
        }
        return 0;
    }
    public function getQtyDeliveryByRef($ref,$produkid,$varian,$text){
        $builder = $this->db->table("delivery_detail"); 
        $builder->join("delivery","DeliveryId = DeliveryDetailRef","left");
        $builder->where('InvId',$ref);  
        $arr_detail_delivery = $builder->get()->getResult(); 

        $qtysum = 0;
        foreach($arr_detail_delivery as $row){
            if($row->ProdukId == $produkid && $row->DeliveryDetailVarian == $varian && $row->DeliveryDetailText == $text){ 
                $qtysum += $row->DeliveryDetailQty;  
            } 
        }
        return $qtysum;
    }

    public function getQtyDeliveryBySample($ref,$produkid,$varian,$text){
        $builder = $this->db->table("delivery_detail"); 
        $builder->join("delivery","DeliveryId = DeliveryDetailRef","left");
        $builder->where('SampleId',$ref);  
        $arr_detail_delivery = $builder->get()->getResult(); 

        $qtysum = 0;
        foreach($arr_detail_delivery as $row){
            if($row->ProdukId == $produkid && $row->DeliveryDetailVarian == $varian && $row->DeliveryDetailText == $text){ 
                $qtysum += $row->DeliveryDetailQty;  
            } 
        }
        return $qtysum;
    }
    public function getdataDetailDeliveryByInvoice($ref,$produkid,$varian,$text){
        $arr_detail_invoice = $this->getdataDetailDelivery($ref);
        $qtysum = 0;
        foreach($arr_detail_invoice as $row){
            if($row->ProdukId == $produkid && $row->InvDetailVarian == $varian && $row->InvDetailText == $text){
                $builder = $this->db->table("delivery_detail"); 
                $builder->join("delivery","DeliveryId = DeliveryDetailRef","left");
                $builder->where('DeliveryDetailRef',$ref);  
                $builder->where('ProdukId',$produkid); 
                $builder->where('DeliveryDetailVarian',$varian,true);
                $builder->where('DeliveryDetailText',$text);
                $result_all = $builder->get()->getResult();  
                foreach($result_all as $rows){
                    $qtysum += $rows->DeliveryDetailQty;
                }
                 
            } 
        }
        return $qtysum;
    }

    /**
     * FUNCTION UNTUK PEMBELIAN
     */ 
    public function insert_data_pembelian($data){ 
        $header = $data["header"]; 

        $builder = $this->db->table("pembelian");
        $builder->insert(array(
            "POCode"=>$this->get_next_code_pembelian($header["PODate"]),
            "PODate"=>$header["PODate"],  
            "PODate2"=>$header["PODate"],  
            "ProjectId"=>$header["ProjectId"],
            "SphId"=>$header["SphId"],
            "InvId"=>$header["InvId"], 
            "POAdmin"=>$header["POAdmin"], 
            "VendorId"=>$header["VendorId"], 
            "VendorName"=>$header["VendorName"], 
            "TemplateId"=>$header["TemplateId"],
            "CustomerId"=>$header["CustomerId"],
            "POSubTotal"=>$header["POSubTotal"],
            "POPPNTotal"=>$header["POPPNTotal"],
            "PODiscTotal"=>$header["PODiscTotal"],
            "POGrandTotal"=>$header["POGrandTotal"],
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("pembelian");
        $builder->select('*');
        $builder->orderby('POId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["PODetailRef"] = $query->POId;
            $row["PODetailVarian"] = (isset($row["PODetailVarian"]) ? json_encode($row["PODetailVarian"]) : "[]");  
            $builder = $this->db->table("pembelian_detail");
            $builder->insert($row); 
        }

    } 
    public function update_data_pembelian($data,$id){ 
        $header = $data["header"];  
        $builder = $this->db->table("pembelian"); 
        $builder->set('PODate', $header["PODate"]);    
        $builder->set('VendorId', $header["VendorId"]);  
        $builder->set('VendorName', $header["VendorName"]);  
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('POSubTotal', $header["POSubTotal"]); 
        $builder->set('POPPNTotal', $header["POPPNTotal"]); 
        $builder->set('PODiscTotal', $header["PODiscTotal"]); 
        $builder->set('POGrandTotal', $header["POGrandTotal"]);   
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));   
        $builder->where('POId', $id); 
        $builder->update(); 

        $builder = $this->db->table("pembelian_detail");
        $builder->where('PODetailRef',$id);
        $builder->delete(); 

       // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["PODetailRef"] = $id;
            $row["PODetailVarian"] = (isset($row["PODetailVarian"]) ? json_encode($row["PODetailVarian"]) : "[]");  
            $builder = $this->db->table("pembelian_detail");
            $builder->insert($row); 
        }
    }
    public function delete_data_pembelian($id){
        $builder = $this->db->table("pembelian");
        $builder->where('POId',$id);
        $builder->delete(); 

       
        $builder = $this->db->table("pembelian_detail");
        $builder->where('PODetailRef',$id);
        $builder->delete(); 

        return JSON_ENCODE(array("status"=>true));
    }
    public function getdataPO($id){
        $builder = $this->db->table("pembelian"); 
        $builder->select("*,pembelian.VendorName VendorName,pembelian.ProjectId ProjectId"); 
        $builder->join("vendor","vendor.VendorId = pembelian.VendorId","left");
        $builder->join("invoice",'invoice.InvId=pembelian.InvId',"left"); 
        $builder->join("penawaran",'penawaran.SphId=pembelian.SphId',"left"); 
        $builder->join("template_footer","pembelian.TemplateId = template_footer.TemplateFooterId","left");
        $builder->join("customer","customer.CustomerId = pembelian.CustomerId","left");
        $builder->join("project",'project.ProjectId=pembelian.ProjectId',"left"); 
        $builder->where('POId',$id);  
        return $builder->get()->getRow();  
    }
    public function getdataDetailPO($id){
        $builder = $this->db->table("pembelian_detail"); 
        $builder->where('PODetailRef',$id);  
        return $builder->get()->getResult();  
    }


    public function insert_data_accounting($data){
        $builder = $this->db->table("project_accounting");
        $builder->insert(array(  
            "AccName"=>$data["AccName"],
            "AccDate"=>$data["AccDate"],
            "AccType"=>$data["AccType"],
            "AccTotal"=>$data["AccTotal"],
            "AccComment"=>$data["AccComment"], 
            "ProjectId"=>$data["ProjectId"], 
            "AccGroup"=>$data["AccGroup"],
        ));

        $builder = $this->db->table("project_accounting");
        $builder->select('*');
        $builder->orderby('AccId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();    
    }
    public function update_data_accounting($id,$data){
        $builder = $this->db->table("project_accounting"); 
        $builder->set('AccName', $data["AccName"]);    
        $builder->set('AccDate', $data["AccDate"]);  
        $builder->set('AccType', $data["AccType"]);  
        $builder->set('AccTotal', $data["AccTotal"]); 
        $builder->set('AccComment', $data["AccComment"]); 
        $builder->set('ProjectId', $data["ProjectId"]); 
        $builder->set('AccGroup', $data["AccGroup"]);   
        $builder->where('AccId', $id); 
        $builder->update();  
    }

    public function delete_data_accounting($id){
        $builder = $this->db->table("project_accounting");
        $builder->where('AccId',$id);
        $builder->delete(); 
  

        return JSON_ENCODE(array("status"=>true));
    }

    public function getdataAccounting($id){
        $builder = $this->db->table("project_accounting");
        $builder->select('*');
        $builder->where('AccId',$id); 
        $builder->limit(1);
        $query = $builder->get()->getRow();   
        return $query;
    }
}