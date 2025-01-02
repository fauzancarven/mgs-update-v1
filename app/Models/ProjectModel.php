<?php

namespace App\Models; 

use CodeIgniter\Model; 
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;

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
    protected $allowedFields = ['customerid','date_time','storeid','category','comment','userid','admin','status'];

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
    public function blog_json($search)
    {
		$db  = \Config\Database::connect();

        $dt = new Datatables(new Codeigniter4Adapter);
        $querysql = 'Select date_time,
        project.category project_category, 
        project.id project_id,
        StoreLogo,
        StoreCode, 
        customer.id customer_id, 
        customer.name customer_name, 
        customer.code customer_code, 
        customer.company customer_company, 
        customer.address customer_address, 
        status, 
        admin,
        project.comment comment from project 
        left join customer on customer.id = customerid 
        left join store on store.StoreId = project.storeid
        where project.category like "%'.$search.'%" or
        StoreCode like "%'.$search.'%" or
        customer.name like "%'.$search.'%" or
        customer.code like "%'.$search.'%" or
        customer.address like "%'.$search.'%"
        order by project.id desc
        ';
        // $builder = $this->db->table($this->table); 
        // $builder->join('customer', 'customer.id = customerid', 'left'); 
        // $builder->join('store', 'store.StoreId = project.storeid', 'left'); 
        // $builder->select('
        //     date_time,
        //     project.category project_category, 
        //     project.id project_id,
        //     StoreLogo,
        //     StoreCode, 
        //     customer.id customer_id, 
        //     customer.name customer_name, 
        //     customer.code customer_code, 
        //     customer.company customer_company, 
        //     customer.address customer_address, 
        //     status, 
        //     admin,
        //     project.comment comment, 
        // '); 
        // $builder->like("project.category",$search);
        // $builder->orLike("StoreCode",$search);
        // $builder->orLike("customer.name",$search);
        // $builder->orLike("customer.code",$search);
        // $builder->orLike("customer.address",$search); 
        // $builder->orderBy("project.id","DESC"); 
        // $query = $builder->getCompiledSelect();

        $dt->query($querysql); 

        $dt->edit('date_time', function($data){
            $date = date_create($data["date_time"]);
            return '<div class="d-flex flex-column gap-1 align-items-center">
                        <span class="text-head-2">'.date_format($date,"d M Y").'</span>
                        <span class="text-detail-2 text-truncate">'.date_format($date,"H:i:s").'</span> 
                    </div>';
        }); 
        $dt->edit('status', function($data){
            return '<span class="badge badge-0 badge-rounded">'.$data["status"].'</span>';
        }); 
        $dt->edit('comment', function($data){
            return '<span class="badge badge-0 badge-rounded">'.$data["status"].'</span>';
        }); 
        $dt->add('store', function($data){
            $category = "";
            foreach (explode("|",$data["project_category"]) as $index=>$x) {
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
                    <span class="text-head-2">'.$data["customer_name"].'</span>
                    <span class="text-detail-2 text-truncate">'.$data["customer_address"].'</span> 
                </div>';
        });
        
        $dt->add('action', function($data){
        	return '
                <div class="d-md-flex d-none"> 
                    <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click('.$data["project_id"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                    <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click('.$data["project_id"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</button> 
                </div>
                <div class="d-md-none d-flex btn-action"> 
                    <div class="dropdown">
                        <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-more-alt icon-rotate-45"></i>
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$data["project_id"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                            <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$data["project_id"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                        </ul>
                    </div>
                </div> 
                ';
        });  
        $dt->add('head_mobile', function($data){
            $category = "";
            foreach (explode("|",$data["project_category"]) as $index=>$x) {
                $category .= '<span class="badge badge-'.fmod($index, 5).'">'.$x.'</span>';
            }  
            $date = date_create($data["date_time"]);
      
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
                                <span class="text-detail-3">'.date_format(date_create($data["date_time"]),"d M Y").'</span>
                                <div class="divider d-inline-block d-none"></div>
                                <div class="text-success d-none">
                                    <i class="fa-solid fa-circle" style="font-size:0.5rem"></i>
                                    <span class="text-detail-3 ">New</span>
                                </div>
                                <div class="divider d-inline-block"></div>
                                <span class="text-detail-3">'.$data["admin"].'</span>   
                            </div>
                            <div class="ms-auto"> 
                                <div class="dropdown">
                                    <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti-more-alt icon-rotate-45"></i>
                                    </a>
                                    <ul class="dropdown-menu shadow">
                                        <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$data["project_id"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$data["project_id"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-100 gap-1 py-1">'.$category.'</div>
                        <div class="text-head-2 py-1">'.$data["customer_name"].($data["customer_company"] == "" ? : " (".$data["customer_company"].")").'</div> 
                    </div>
                    <div class="card-footer p-0 bg-white">
                        <div class="d-flex project-menu mobile justify-content-around">
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="survey">
                                <i class="fa-solid fa-list-check position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Survey</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="rab">
                                <i class="fa-solid fa-list position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">RAB</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="penawaran">
                                <i class="fa-solid fa-hand-holding-droplet position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Penawaran</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="pembelian">
                                <i class="fa-solid fa-cart-shopping position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Pembelian</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="invoice">
                                <i class="fa-solid fa-money-bill position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Invoice</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="documentasi">
                                <i class="fa-solid fa-folder-open position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Dokumentasi</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="diskusi">
                                <i class="fa-regular fa-comments position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Diskusi</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center flex-column align-items-center" style="display:none">
                            <div class="tab-content mobile  w-100" data-id="'.$data["project_id"].'" style="display:none">
                                <div class="d-flex justify-content-center flex-column align-items-center">
                                    <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                                    <span>Belum ada data yang dibuat</span>
                                    <button class="btn btn-sm btn-primary px-3 rounded mt-4" onclick="add_penawaran_click('.$data["project_id"].',this)"><i class="fa-solid fa-plus pe-2"></i>Buat Penawaran</button>
                                </div> 
                            </div>
                            <div class="loading text-center loading-content p-4" data-id="'.$data["project_id"].'"  style="display:none">
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
                    <div class="side-menu" data-id="'.$data["project_id"].'">
                        <div class="d-flex flex-column project-menu">
                            <div class="menu-item selected" data-id="'.$data["project_id"].'" data-menu="survey">
                                <i class="fa-solid fa-list-check position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Survey</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="rab">
                                <i class="fa-solid fa-list position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">RAB</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="penawaran">
                                <i class="fa-solid fa-hand-holding-droplet position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Penawaran</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="pembelian">
                                <i class="fa-solid fa-cart-shopping position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Pembelian</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="invoice">
                                <i class="fa-solid fa-money-bill position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Invoice</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="documentasi">
                                <i class="fa-solid fa-folder-open position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Dokumentasi</span>
                            </div>
                            <div class="menu-item" data-id="'.$data["project_id"].'" data-menu="diskusi">
                                <i class="fa-regular fa-comments position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle d-none"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                <span class="menu-text">Diskusi</span>
                            </div>
                        </div>
                        <button class="btn-side-menu" data-id="'.$data["project_id"].'"><i class="fa-solid fa-angle-left"></i></button>
                    </div>
                    <div class="flex-fill border-left">
                        <div class="tab-content" data-id="'.$data["project_id"].'" style="display:none">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                                <span>Belum ada data yang dibuat</span>
                                <button class="btn btn-sm btn-primary px-3 rounded mt-4" onclick="add_penawaran_click('.$data["project_id"].',this)"><i class="fa-solid fa-plus pe-2"></i>Buat Penawaran</button>
                            </div> 
                        </div>
                        <div class="d-flex justify-content-center flex-column align-items-center" style="display:none">
                            <div class="loading text-center loading-content pt-4 mt-4" data-id="'.$data["project_id"].'">
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

    public function load_data_project($id){
        $builder = $this->db->table($this->table); 
        $builder->join('customer', 'customer.id = customerid', 'left'); 
        $builder->join('store', 'store.StoreId = project.storeid', 'left'); 
        $builder->where("project.id",$id);
        return $builder->get()->getRow();
    }

    public function load_data_project_tab($data){
        switch ($data["type"]) {
            case "survey":
                return $this->data_project_survey($data["project_id"]);
                break; 

            case "rab":
                return $this->data_project_rab($data["project_id"]);
                break; 

            case "penawaran":
                return $this->data_project_sph($data["project_id"]);
                break; 

            case "pembelian":
                return $this->data_project_po($data["project_id"]);
                break; 

            case "invoice":
                return $this->data_project_invoice($data["project_id"]);
                break; 

            case "documentasi":
                return $this->data_project_documentasi($data["project_id"]);
                break; 

            case "diskusi":
                return $this->data_project_diskusi($data["project_id"]);
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

 
    /**
     * FUNCTION UNTUK MENU PROJECT
     */ 

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
    private function data_project_sph($id){
        $html = "";

        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->where('ref',$id);
        $builder->orderby('id', 'DESC'); 
        $query = $builder->get()->getResult();  

       
        foreach($query as $row){

            $builder = $this->db->table("penawaran_detail");
            $builder->select('*'); 
            $builder->where('ref',$row->id);
            $builder->orderby('id', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A";
            foreach($items as $item){

                $arr_varian = json_decode($item->varian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }

                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-4 my-1 varian">   
                        <div class="d-flex ">
                            <span class="no-urut text-head-3"  '.($item->type == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.($item->type == "product" ? $no : $huruf).'.</span> 
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase"  '.($item->type == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->text.'</span>
                                <span class="text-detail-2 text-truncate"  '.($item->type == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->group.'</span> 
                                <div class="d-flex flex-wrap gap-1">
                                    '.$arr_badge.'
                                </div>
                            </div> 
                        </div>
                    </div>';
                if($item->type == "product"){
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail">
                                        <div class="row"> 
                                            <div class="offset-2 offset-md-0 col-5 col-md-2 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->qty, 2, ',', '.').' '.$item->satuantext.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-5 col-md-3 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Harga:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->harga, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="offset-2 offset-md-0 col-5 col-md-3 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Disc:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->disc, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-5 col-md-3 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Total:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->total, 0, ',', '.').'</span>
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
            <div class="list-project mb-4 p-2">
                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ">
                    <div class="col-12 col-sm-3 col-xl-2 order-1 order-sm-0">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">No. Penawaran :</span>
                            <span class="text-head-3">'.$row->code.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-2 col-xl-2 order-2 order-sm-1"> 
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Tanggal:</span>
                            <span class="text-head-3">'.date_format(date_create($row->date),"d M Y").'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-7 col-xl-8 order-0 order-sm-2">
                        <div class="float-end d-md-flex d-none">
                            <button class="btn btn-sm btn-primary btn-action m-1 rounded border" onclick="po_project_sph('.$row->ref.','.$row->id.',this)">
                                <i class="fa-solid fa-cart-shopping mx-1"></i><span >Pembelian</span>
                            </button> 
                            <button class="btn btn-sm btn-primary btn-action m-1 rounded border" onclick="invoice_project_sph('.$row->ref.','.$row->id.',this)">
                                <i class="fa-solid fa-money-bill mx-1"></i><span >Invoice</span>
                            </button> 
                            <button class="btn btn-sm btn-primary btn-action m-1 rounded border" onclick="print_project_sph('.$row->ref.','.$row->id.',this)">
                                <i class="fa-solid fa-print mx-1"></i><span >Print</span>
                            </button> 
                            <button class="btn btn-sm btn-primary btn-action m-1 rounded border" onclick="edit_project_sph('.$row->ref.','.$row->id.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Edit</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action m-1 rounded border" onclick="delete_project_sph('.$row->ref.','.$row->id.',this)">
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
                                    <li><a class="dropdown-item m-0 px-2" onclick="po_project_sph('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-cart-shopping pe-2"></i>Teruskan Vendor</a></li>
                                    <li><a class="dropdown-item m-0 px-2" onclick="invoice_project_sph('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-money-bill pe-2"></i>Teruskan Invoice</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_sph('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-print pe-2"></i>Print</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_sph('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_sph('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-3">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Sub Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->subtotal, 0, ',', '.').'</span>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-4">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Disc Item:</span>
                            <span class="text-head-3">Rp. '.number_format($row->discitemtotal, 0, ',', '.').'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-5">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Disc Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->disctotal, 0, ',', '.').'</span>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-6">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Grand Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->grandtotal, 0, ',', '.').'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-xl-4 order-7  pb-2">
                        <div class="d-flex flex-column justify-content-between">
                            <span class="text-detail-2 pb-2 pb-md-0">Alamat:</span>
                            <span class="text-head-3 text-wrap">'.$row->address.'</span>
                        </div>  
                    </div>
                </div> 
                <div class="detail-item mt-2 p-2 border-top">
                    '.$html_items.' 
                </div>
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
                        <button class="btn btn-sm btn-primary px-3 m-2" onclick="add_project_sph(\''.$id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data penawaran</button>
                    </div>';

        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        );
    }
    private function data_project_po($id){
        $html = '
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="'.base_url().'/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                <span>Belum ada data yang dibuat</span>
                <button class="btn btn-sm btn-primary px-3 mt-4" onclick="add_project_po(\''.$id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data pembelian</button>
            </div> 
        ';
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        );
    }
    private function data_project_invoice($id){
        $html = ''; 

        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span>Belum ada data yang dibuat</span> 
                </div> 
            ';
        }
        $html .= '   <div class="d-flex justify-content-center flex-column align-items-center">
                        <button class="btn btn-sm btn-primary px-3 m-2" onclick="add_project_invoice(\''.$id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data Invoice</button>
                    </div>';
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
 
    /**
     * FUNCTION UNTUK AUTOCODE
     */ 

    private function get_next_code_penawaran($date){
        //sample SPH/001/01/2024
        $builder = $this->db->table("penawaran");  
        $builder->select("ifnull(max(SUBSTRING(code,5,3)),0) + 1 as nextcode");
        $builder->where("date_create",$date);
        $arr_date = explode("-", $date);
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
     
    /**
     * FUNCTION UNTUK SPH / PENAWARAN
     */ 

    public function insert_data_penawaran($data){ 
        $header = $data["header"]; 

        $builder = $this->db->table("penawaran");
        $builder->insert(array(
            "code"=>$this->get_next_code_penawaran($header["date_create"]),
            "date"=>$header["date"],
            "date_create"=>$header["date_create"],
            "time_create"=>$header["time_create"],
            "storeid"=>$header["storeid"],
            "ref"=>$header["ref"],
            "admin"=>$header["admin"],
            "customerid"=>$header["customerid"],
            "address"=>$header["Address"],
            "templateid"=>$header["templateid"],
            "subtotal"=>$header["subtotal"],
            "discitemtotal"=>$header["discitemtotal"],
            "disctotal"=>$header["disctotal"],
            "grandtotal"=>$header["grandtotal"],
        ));

        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->orderby('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["ref"] = $query->id;
            $row["varian"] = (isset($row["varian"]) ? json_encode($row["varian"]) : "[]");  
            $builder = $this->db->table("penawaran_detail");
            $builder->insert($row); 
        }

    }
    public function update_data_penawaran($data,$id){ 
        $header = $data["header"]; 

        $builder = $this->db->table("penawaran"); 
        $builder->set('date', $header["date"]); 
        $builder->set('storeid', $header["storeid"]);  
        $builder->set('admin', $header["admin"]); 
        $builder->set('customerid', $header["customerid"]); 
        $builder->set('address', $header["address"]); 
        $builder->set('templateid', $header["templateid"]); 
        $builder->set('subtotal', $header["subtotal"]); 
        $builder->set('discitemtotal', $header["discitemtotal"]); 
        $builder->set('disctotal', $header["disctotal"]); 
        $builder->set('grandtotal', $header["grandtotal"]);  
        $builder->where('id', $id); 
        $builder->update(); 

        $builder = $this->db->table("penawaran_detail");
        $builder->where('ref',$id);
        $builder->delete(); 
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["ref"] = $id;
            $row["varian"] = (isset($row["varian"]) ? json_encode($row["varian"]) : "[]");  
            $builder = $this->db->table("penawaran_detail");
            $builder->insert($row); 
        } 
    }
    public function delete_data_penawaran($id){
        $builder = $this->db->table("penawaran");
        $builder->where('id',$id);
        $builder->delete(); 

       
        $builder = $this->db->table("penawaran_detail");
        $builder->where('ref',$id);
        $builder->delete(); 

        return JSON_ENCODE(array("status"=>true));
    }

    public function getdataSPH($id){
        $builder = $this->db->table("penawaran");
        $builder->select("*,penawaran.address,penawaran.code,penawaran.id,customer.name");
        $builder->join("customer","customerid = customer.id");
        $builder->join("template_footer","templateid = template_footer.id");
        $builder->where('penawaran.id',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    }
    public function getdataDetailSPH($id){
        $builder = $this->db->table("penawaran_detail");
        $builder->where('ref',$id); 
        return $builder->get()->getResult();  
    }

    public function insert_data_template_footer($data){  

        $builder = $this->db->table("template_footer");
        $builder->insert(array(
            "name"=> $data["name"],
            "detail"=> $data["detail"],
            "delta"=> JSON_ENCODE($data["delta"]), 
        ));  

         // GET ID PRODUK 
        $builder = $this->db->table("template_footer");
        $builder->select('*'); 
        $builder->orderby('id', 'DESC');
        $builder->limit(1);
        return $builder->get()->getRow();
    }
    public function update_data_template_footer($data,$id){   
        $builder = $this->db->table("template_footer");
        $builder->set('name', $data["name"]);
        $builder->set('detail', $data["detail"]); 
        $builder->set('delta', JSON_ENCODE($data["delta"]));
        $builder->where('id', $id); 
        $builder->update(); 
    }
    public function get_data_template_footer($id){
        $builder = $this->db->table("template_footer");
        $builder->where('id',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    }
}