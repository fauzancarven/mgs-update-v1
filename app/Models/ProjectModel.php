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
    protected $allowedFields = ['customerid','date','storeid','category','comment'];

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

        $builder = $this->db->table($this->table); 
        $builder->join('customer', 'customer.id = customerid', 'left'); 
        $builder->join('store', 'store.StoreId = project.storeid', 'left'); 
        $builder->select('
            date_time,
            project.category project_category, 
            project.id project_id,
            StoreLogo,
            StoreCode,
            customer.id customer_id, 
            customer.name customer_name, 
            customer.code customer_code, 
            customer.address customer_address, 
            status, 
            admin,
            project.comment comment
        '); 
        $builder->like("project.category",$search);
        $builder->orLike("StoreCode",$search);
        $builder->orLike("customer.name",$search);
        $builder->orLike("customer.code",$search);
        $builder->orLike("customer.address",$search); 
        $query = $builder->getCompiledSelect();

        $dt->query($query); 
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
            return '<div class="d-flex align-items-center">
                    <div class="flex-shrink-0 ">
                        <img src="'.$data["StoreLogo"].'" alt="Gambar" class="image-logo-project">
                    </div>
                    <div class="flex-grow-1 ms-1 ">
                        <div class="d-flex flex-column gap-1">
                            <span class="text-head-2">'.$data["StoreCode"].'</span>
                            <span class="text-detail-2 text-truncate"> 
                                <div class="d-flex gap-1">
                                '.$category.'
                                </div>
                            </span> 
                        </div>
                    </div>
                </div>';
        }); 
        $dt->add('customer', function($data){
            return '
                <div class="d-flex flex-column gap-1 ">
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
                <div class="d-md-flex d-none"> 
                ';
        });  
        $dt->add('html', function($data){ 
        	return '  
            <div class="project-detail">
                <div class="row">
                    <div class="col-3">
                        <div class="d-flex flex-column project-menu">
                            <div class="menu-item selected"><i class="fa-solid fa-list-check"></i>Survey</div>
                            <div class="menu-item"><i class="fa-solid fa-list"></i>RAB</div>
                            <div class="menu-item"><i class="fa-solid fa-hand-holding-droplet"></i>Penawaran</div>
                            <div class="menu-item"><i class="fa-solid fa-cart-shopping"></i>Pembelian</div>
                            <div class="menu-item"><i class="fa-solid fa-money-bill"></i>Invoice</div>
                            <div class="menu-item"><i class="fa-solid fa-folder-open"></i>Dokumentasi</div>
                            <div class="menu-item">
                                <i class="fa-regular fa-comments position-relative">
                                    <span class="position-absolute top-0 start-0 translate-middle p-1 bg-danger border border-light rounded-circle"> 
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </i>
                                Diskusi
                            </div>
                        </div>
                    </div>
                    <div class="col-9 border-left">
                        <div class="tab-content d-none" id="loader-content">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <img src="https://localhost/mahiera/assets/images/empty.png" alt="" style="width:150px;height:150px;">
                                <span>Belum ada data yang dibuat</span>
                            </div> 
                        </div>
                        <div class="h-100 d-flex justify-content-center flex-column align-items-center" id="loader-content">
                            <div class="loading text-center">
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

            case "invoice":
                return $this->data_project_invoice($data["project_id"]);
                break; 

            case "sph":
                return $this->data_project_sph($data["project_id"]);
                break; 

            default: 
                $html = '
                <div class="text-center mt-2">
                    <span>No Data</span>
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
    private function data_project_survey($id){
        $html = '
            <div class="text-center mt-2">
                <button class="btn btn-sm btn-primary px-3" onclick="add_survey(\''.$id.'\')">Tambah data</button> 
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
        $html = '
            <div class="text-center mt-2">
                <button class="btn btn-sm btn-primary px-3" onclick="add_sph(\''.$id.'\')">Tambah Penawaran</button>  
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
        $html = '
            <div class="text-center mt-2">
                <button class="btn btn-sm btn-primary px-3" onclick="add_invoice(\''.$id.'\')">Tambah Invoice</button> 
                <button class="btn btn-sm btn-primary px-3" onclick="add_proforma(\''.$id.'\')">Tambah Proforma</button> 
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