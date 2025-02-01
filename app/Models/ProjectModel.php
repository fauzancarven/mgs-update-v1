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
    public function blog_json($search)
    {
        $db  = \Config\Database::connect();

        $dt = new Datatables(new Codeigniter4Adapter);

        $builder = $this->db->table($this->table);
        $builder->join("customer","customer.CustomerId = project.CustomerId ");
        $builder->join("store","store.StoreId = project.StoreId");
        
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
                return $this->data_project_survey($data["ProjectId"]);
                break; 

            case "rab":
                return $this->data_project_rab($data["ProjectId"]);
                break; 

            case "penawaran":
                return $this->data_project_sph($data["ProjectId"]);
                break; 

            case "pembelian":
                return $this->data_project_po($data["ProjectId"]);
                break; 

            case "invoice":
                return $this->data_project_invoice($data["ProjectId"]);
                break; 

            case "documentasi":
                return $this->data_project_documentasi($data["ProjectId"]);
                break; 

            case "diskusi":
                return $this->data_project_diskusi($data["ProjectId"]);
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
        $builder->where('SphRef',$id);
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
            foreach($items as $item){

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
                        <div class="d-flex ">
                            <span class="no-urut text-head-3"  '.($item->SphDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.($item->SphDetailType == "product" ? $no : $huruf).'.</span> 
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase"  '.($item->SphDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SphDetailText.'</span>
                                <span class="text-detail-2 text-truncate"  '.($item->SphDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SphDetailGroup.'</span> 
                                <div class="d-flex flex-wrap gap-1">
                                    '.$arr_badge.'
                                </div>
                            </div> 
                        </div>
                    </div>';
                if($item->SphDetailType == "product"){
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail">
                                        <div class="row"> 
                                            <div class="offset-2 offset-md-0 col-5 col-md-2 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->SphDetailQty, 2, ',', '.').' '.$item->SphDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-5 col-md-3 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Harga:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SphDetailPrice, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="offset-2 offset-md-0 col-5 col-md-3 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Disc:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SphDetailDisc, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-5 col-md-3 px-1">   
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
            <div class="list-project mb-4 p-2">
                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ">
                    <div class="col-12 col-sm-3 col-xl-2 order-1 order-sm-0">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">No. Penawaran :</span>
                            <span class="text-head-3">'.$row->SphCode.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-2 col-xl-2 order-2 order-sm-1"> 
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Tanggal:</span>
                            <span class="text-head-3">'.date_format(date_create($row->SphDate),"d M Y").'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-7 col-xl-8 order-0 order-sm-2">
                        <div class="float-end d-md-flex d-none gap-1">
                            <button class="btn btn-sm btn-primary btn-action rounded border d-none" onclick="po_project_sph('.$row->SphRef.','.$row->SphId.',this)">
                                <i class="fa-solid fa-share-from-square mx-1"></i></i><span >Buat PO</span>
                            </button> 
                            <button class="btn btn-sm btn-primary btn-action rounded border d-none" onclick="invoice_project_sph('.$row->SphRef.','.$row->SphId.',this)">
                                <i class="fa-solid fa-share-from-square mx-1"></i><span >Buat Invoice</span>
                            </button> 
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_sph('.$row->SphRef.','.$row->SphId.',this)">
                                <i class="fa-solid fa-print mx-1"></i><span >Print</span>
                            </button> 
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_sph('.$row->SphRef.','.$row->SphId.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Edit</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_sph('.$row->SphRef.','.$row->SphId.',this)">
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
                                    <li><a class="dropdown-item m-0 px-2 d-none" onclick="po_project_sph('.$row->SphRef.','.$row->SphId.',this)"><i class="fa-solid fa-cart-shopping pe-2"></i>Teruskan Vendor</a></li>
                                    <li><a class="dropdown-item m-0 px-2 d-none" onclick="invoice_project_sph('.$row->SphRef.','.$row->SphId.',this)"><i class="fa-solid fa-money-bill pe-2"></i>Teruskan Invoice</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_sph('.$row->SphRef.','.$row->SphId.',this)"><i class="fa-solid fa-print pe-2"></i>Print</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_sph('.$row->SphRef.','.$row->SphId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_sph('.$row->SphRef.','.$row->SphId.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-3">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Sub Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->SphSubTotal, 0, ',', '.').'</span>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-4">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Disc Item:</span>
                            <span class="text-head-3">Rp. '.number_format($row->SphDiscItemTotal, 0, ',', '.').'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-5">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Disc Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->SphDiscTotal, 0, ',', '.').'</span>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-6">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Grand Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->SphGrandTotal, 0, ',', '.').'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-xl-4 order-7  pb-2">
                        <div class="d-flex flex-column justify-content-between">
                            <span class="text-detail-2 pb-2 pb-md-0">Alamat:</span>
                            <span class="text-head-3 text-wrap">'.$row->SphAddress.'</span>
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
        $html = "";

        $builder = $this->db->table("pembelian");
        $builder->select('*'); 
        $builder->where('ref',$id);
        $builder->orderby('id', 'DESC'); 
        $query = $builder->get()->getResult();  

       
        foreach($query as $row){

            $builder = $this->db->table("pembelian_detail");
            $builder->select('*'); 
            $builder->where('ref',$row->id);
            $builder->orderby('id', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1; 
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
                            <span class="no-urut text-head-3">'.$no.'</span> 
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase">'.$item->text.'</span>
                                <span class="text-detail-2 text-truncate">'.$item->group.'</span> 
                                <div class="d-flex flex-wrap gap-1">
                                    '.$arr_badge.'
                                </div>
                            </div> 
                        </div>
                    </div>'; 
                $html_items .= '<div class="col-12 col-md-8 my-1 detail">
                                    <div class="row"> 
                                        <div class="col-6 col-md-3 px-1">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Qty:</span>
                                                <span class="text-head-2">'.number_format($item->qty, 2, ',', '.').' '.$item->satuantext.'</span>
                                            </div>
                                        </div>  
                                        <div class="col-6 col-md-4 px-1">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Harga:</span>
                                                <span class="text-head-2">Rp. '.number_format($item->harga, 0, ',', '.').'</span>
                                            </div>
                                        </div>  
                                        <div class="col-12 col-md-4 px-1">   
                                            <div class="d-flex flex-column">
                                                <span class="text-detail-2">Total:</span>
                                                <span class="text-head-2">Rp. '.number_format($item->total, 0, ',', '.').'</span>
                                            </div>
                                        </div> 
                                    </div>   
                                </div> 
                            </div>';
                $no++;  
            }

            $builder = $this->db->table("vendor");
            $builder->select('*'); 
            $builder->where('id',$row->vendor); 
            $vendor = $builder->get()->getRow();

            $html .= '
            <div class="list-project mb-4 p-2">
                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ">
                    <div class="col-12 col-sm-3 col-xl-2 order-1 order-sm-0">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">No. Pembelian :</span>
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
                        <div class="float-end d-md-flex d-none gap-1"> 
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="grpo_project_po('.$row->ref.','.$row->id.',this)">
                                <i class="fa-solid fa-share mx-1"></i><span >Buat GRPO</span>
                            </button> 
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="delivery_project_po('.$row->ref.','.$row->id.',this)">
                                <i class="fa-solid fa-truck mx-1"></i><span >Surat Jalan</span>
                            </button> 
                            <div class="dropdown">
                                <a class="btn btn-sm btn-primary btn-action rounded border dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-print mx-1"></i><span >Print</span>
                                </a> 
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" onclick="print_project_po_a4('.$row->ref.','.$row->id.',this)">Print A4</a></li>
                                    <li><a class="dropdown-item" onclick="print_project_po_a5('.$row->ref.','.$row->id.',this)">Print A5</a></li> 
                                </ul>
                            </div>
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_po('.$row->ref.','.$row->id.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Edit</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_po('.$row->ref.','.$row->id.',this)">
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
                                    <li><a class="dropdown-item m-0 px-2" onclick="grpo_project_po('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-cart-shopping pe-2"></i>Teruskan GRPO</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delivery_project_po('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-cart-shopping pe-2"></i>Surat Jalan</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_po_a4('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-print pe-2"></i>Print A4</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_po_a5('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-print pe-2"></i>Print A5</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_po('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_po('.$row->ref.','.$row->id.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
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
                    <div class="col-12 col-md-3 col-xl-2 order-5">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Disc Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->disctotal, 0, ',', '.').'</span>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-4">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">PPH Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->pphtotal, 0, ',', '.').'</span>
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
                            <span class="text-detail-2 pb-2 pb-md-0">Vendor:</span>
                            <span class="text-head-3 text-wrap">'.$vendor->code.' - '.$vendor->name.'</span>
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
                        <button class="btn btn-sm btn-primary px-3 mt-4" onclick="add_project_po(\''.$id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data pembelian</button>
                    </div>';

        return json_encode(
            array(
                "status"=>true,
                "html"=>$html
            )
        ); 
    }
    private function data_project_invoice($id){
        $html = ''; 

        $builder = $this->db->table("invoice");
        $builder->select('*');
        $builder->where('InvRef',$id);
        $builder->orderby('InvId', 'DESC'); 
        $query = $builder->get()->getResult();  
        foreach($query as $row){

            $builder = $this->db->table("invoice_detail");
            $builder->select('*'); 
            $builder->where('InvDetailRef',$row->InvId);
            $builder->orderby('InvDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A";
            foreach($items as $item){

                $arr_varian = json_decode($item->InvDetailVarian);
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
                            <span class="no-urut text-head-3"  '.($item->InvDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.($item->InvDetailType == "product" ? $no : $huruf).'.</span> 
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
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail">
                                        <div class="row"> 
                                            <div class="offset-2 offset-md-0 col-5 col-md-2 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->InvDetailQty, 2, ',', '.').' '.$item->InvDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-5 col-md-3 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Harga:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->InvDetailPrice, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="offset-2 offset-md-0 col-5 col-md-3 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Disc:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->InvDetailDisc, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-5 col-md-3 px-1">   
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
                            <span class="text-detail-2">No. Invoice :</span>
                            <span class="text-head-3">'.$row->InvCode.'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-2 col-xl-2 order-2 order-sm-1"> 
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Tanggal:</span>
                            <span class="text-head-3">'.date_format(date_create($row->InvDate),"d M Y").'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-7 col-xl-8 order-0 order-sm-2">
                        <div class="float-end d-md-flex d-none gap-1"> 
                            <div class="dropdown">
                                <a class="btn btn-sm btn-primary btn-action rounded border dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-share pe-2"></i><span>Next Prosess</span>
                                </a> 
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" onclick="proforma_project_invoice('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-dollar-sign pe-2"></i>Proforma</a></li>
                                    <li><a class="dropdown-item" onclick="payment_project_invoice('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-dollar-sign pe-2"></i>Payment</a></li> 
                                    <li><hr class="dropdown-divider"></li> 
                                    <li><a class="dropdown-item" onclick="delivery_project_invoice('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-truck pe-2"></i>Pengiriman</a></li> 
                                </ul>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-sm btn-primary btn-action rounded border dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-print mx-1"></i><span >Print</span>
                                </a> 
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" onclick="print_project_invoice_a4('.$row->InvRef.','.$row->InvId.',this)">Print A4</a></li>
                                    <li><a class="dropdown-item" onclick="print_project_invoice_a5('.$row->InvRef.','.$row->InvId.',this)">Print A5</a></li> 
                                </ul>
                            </div>
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_invoice('.$row->InvRef.','.$row->InvId.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Edit</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_invoice('.$row->InvRef.','.$row->InvId.',this)">
                                <i class="fa-solid fa-close mx-1"></i><span >Delete</span>
                            </button> 
                        </div> 
                        <div class="d-md-none d-flex btn-action justify-content-between"> 
                            <div>INVOICE (SALES ORDER)</div>
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow">
                                    <li><a class="dropdown-item m-0 px-2" onclick="proforma_project_invoice('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-share pe-2"></i>Proforma</a></li>
                                    <li><a class="dropdown-item m-0 px-2" onclick="payment_project_invoice('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-share pe-2"></i>Payment</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delivery_project_invoice('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-truck pe-2"></i>Surat Jalan</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_invoice_a4('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-print pe-2"></i>Print A4</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_invoice_a5('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-print pe-2"></i>Print A5</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_invoice('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_invoice('.$row->InvRef.','.$row->InvId.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-3">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Sub Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->InvSubTotal, 0, ',', '.').'</span>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-4">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Disc Item:</span>
                            <span class="text-head-3">Rp. '.number_format($row->InvDiscItemTotal, 0, ',', '.').'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-5">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Disc Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->InvDiscTotal, 0, ',', '.').'</span>
                        </div> 
                    </div>
                    <div class="col-12 col-md-3 col-xl-2 order-6">
                        <div class="d-flex flex-row flex-md-column justify-content-between">
                            <span class="text-detail-2">Grand Total:</span>
                            <span class="text-head-3">Rp. '.number_format($row->InvGrandTotal, 0, ',', '.').'</span>
                        </div>  
                    </div>
                    <div class="col-12 col-xl-4 order-7  pb-2">
                        <div class="d-flex flex-column justify-content-between">
                            <span class="text-detail-2 pb-2 pb-md-0">Alamat:</span>
                            <span class="text-head-3 text-wrap">'.$row->InvAddress.'</span>
                        </div>  
                    </div>
                </div> 
                <div class="detail-item mt-2 p-2 border-top">
                    '.$html_items.' 
                </div>
            </div> 
            ';

            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->where('PaymentRef',$row->InvId);
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult(); 

            foreach($payment as $row_payment){
               
                if($row_payment->PaymentStatus == "0"){
                    $status = '<span class="text-head-3 text-warning">
                    <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                        <i class="fa-solid fa-certificate fa-stack-2x"></i> 
                        <i class="fa-solid fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>Pending</span>';
                }else{
                    $status = ' <span class="text-head-3 text-success">
                    <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                        <i class="fa-solid fa-certificate fa-stack-2x"></i>
                        <i class="fa-solid fa-check fa-stack-1x fa-inverse"></i>
                    </span>Verified</span>';
                }
                $html .= '  <div class="list-payment mb-4 p-2">
                                <div class="line-1"></div>
                                <div class="line-o"></div>
                                <div class="row">
                                    <div class="col-9 col-md-1 align-items-center order-0">  
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-head-1 pt-auto">'.($row_payment->PaymentDoc == "1" ? "PAYMENT" : "PROFORMA" ).'</span>
                                        </div>   
                                    </div>
                                    <div class="col-12 col-md-1 order-2 order-sm-1"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Status:</span>'.$status.'
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-3 order-sm-2"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Tanggal:</span>
                                            <span class="text-head-3">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-4 order-sm-3"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Type:</span>
                                            <span class="text-head-3">'.$row_payment->PaymentType.'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-5 order-sm-4">
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Method:</span>
                                            <span class="text-head-3">'.$row_payment->PaymentMethod.'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-6 order-sm-5">
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Total:</span>
                                            <span class="text-head-3">Rp. '.number_format($row_payment->PaymentTotal).'</span>
                                        </div>   
                                    </div>
                                    <div class="col-3 col-md-6 text-end order-1 order-sm-5"> 
                                        <div class="d-none d-md-inline-block"> 
                                            <button class="btn btn-sm btn-primary btn-action rounded border '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$row_payment->PaymentRef.','.$row_payment->PaymentId.',this)">
                                                <i class="fa-solid fa-eye mx-1"></i><span >Show</span>
                                            </button>
                                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$row->InvRef.','.$row_payment->PaymentId.',this)">
                                                <i class="fa-solid fa-print mx-1"></i><span >Print</span>
                                            </button>
                                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$row->InvRef.','.$row_payment->PaymentId.',this)">
                                                <i class="fa-solid fa-pencil mx-1"></i><span >Edit</span>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_payment('.$row->InvRef.','.$row_payment->PaymentId.',this)">
                                                <i class="fa-solid fa-close mx-1"></i><span >Delete</span>
                                            </button> 
                                        </div>
                                        <div class="d-inline-block d-md-none">
                                            <div class="dropdown">
                                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti-more-alt icon-rotate-45"></i>
                                                </a>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item m-0 px-2" onclick="proforma_project_invoice('.$row->InvRef.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-dollar pe-2"></i>Proforma</a></li>
                                                    <li><a class="dropdown-item m-0 px-2" onclick="payment_project_invoice('.$row->InvRef.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-dollar pe-2"></i>Payment</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_invoice_a4('.$row->InvRef.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-print pe-2"></i>Print A4</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_invoice_a5('.$row->InvRef.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-print pe-2"></i>Print A5</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_invoice('.$row->InvRef.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_invoice('.$row->InvRef.','.$row_payment->PaymentId.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
            }


            $builder = $this->db->table("delivery");
            $builder->select('*'); 
            $builder->where('DeliveryRef',$row->InvId);
            $builder->orderby('DeliveryId', 'ASC'); 
            $delivery = $builder->get()->getResult(); 
            foreach($delivery as $row_delivery){ 
                $builder = $this->db->table("delivery_detail");
                $builder->select('*'); 
                $builder->where('DeliveryDetailRef',$row_delivery->DeliveryId);
                $builder->orderby('DeliveryDetailId', 'ASC'); 
                $items = $builder->get()->getResult(); 
                $html_items = "";
                $no = 1;
                $huruf  = "A";
                foreach($items as $item){

                    $arr_varian = json_decode($item->DeliveryDetailVarian);
                    $arr_badge = "";
                    $arr_no = 0;
                    foreach($arr_varian as $varian){
                        $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                        $arr_no++;
                    }

                    $html_items .= '
                    <div class="row">
                        <div class="col-12 col-md-8 my-1 varian">   
                            <div class="d-flex ">
                                <span class="no-urut text-head-3"  '.($item->DeliveryDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.($item->DeliveryDetailType == "product" ? $no : $huruf).'.</span> 
                                <div class="d-flex flex-column text-start">
                                    <span class="text-head-3 text-uppercase"  '.($item->DeliveryDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->DeliveryDetailText.'</span>
                                    <span class="text-detail-2 text-truncate"  '.($item->DeliveryDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->DeliveryDetailGroup.'</span> 
                                    <div class="d-flex flex-wrap gap-1">
                                        '.$arr_badge.'
                                    </div>
                                </div> 
                            </div>
                        </div>'; 
                    $html_items .= '<div class="col-12 col-md-4 my-1 detail">
                                        <div class="row"> 
                                            <div class="offset-2 offset-md-0 col-5 col-md-6 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->DeliveryDetailQty, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-5 col-md-6 px-1">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Spare:</span>
                                                    <span class="text-head-2">'.number_format($item->DeliveryDetailQty, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                        </div>   
                                    </div> 
                                </div>';
                    $no++; 
                        
                    
                }
                if($row_delivery->DeliveryStatus == "0"){
                    $status = '<span class="text-head-3 text-primary">
                    <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                        <i class="fa-solid fa-certificate fa-stack-2x"></i> 
                        <i class="fa-solid fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>New</span>';
                }else{
                    $status = ' <span class="text-head-3 text-success">
                    <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                        <i class="fa-solid fa-certificate fa-stack-2x"></i>
                        <i class="fa-solid fa-check fa-stack-1x fa-inverse"></i>
                    </span>Verified</span>';
                }
                $html .= '  <div class="list-delivery mb-4 p-2">
                                <div class="line-1"></div>
                                <div class="line-o"></div>
                                <div class="row">
                                    <div class="col-9 col-md-1 align-items-center order-0">  
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-head-1 pt-auto">DELIVERY</span>
                                        </div>   
                                    </div>
                                    <div class="col-12 col-md-1 order-2 order-sm-1"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Status:</span>'.$status.'
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-3 order-sm-2"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Tanggal:</span>
                                            <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDate),"d M Y").'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-4 order-sm-3"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Ritase:</span>'.$row_delivery->DeliveryRitase.'
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-5 order-sm-4"> 
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Armada:</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryArmada.'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-6 order-sm-5">
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Pengirim:</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryFromName.'</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryFromTelp.'</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryFromAddress.'</span>
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md-1 order-7 order-sm-5">
                                        <div class="d-flex flex-row flex-md-column justify-content-between">
                                            <span class="text-detail-2">Penerima:</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryToName.'</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryToTelp.'</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryToAddress.'</span>
                                        </div>   
                                    </div>
                                    <div class="col-3 col-md-5 text-end order-1 order-sm-5"> 
                                        <div class="d-none d-md-inline-block">  
                                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_delivery('.$row->InvRef.','.$row_delivery->DeliveryId.',this)">
                                                <i class="fa-solid fa-print mx-1"></i><span >Print</span>
                                            </button>
                                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_delivery('.$row->InvRef.','.$row_delivery->DeliveryId.',this)">
                                                <i class="fa-solid fa-pencil mx-1"></i><span >Edit</span>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_delivery('.$row->InvRef.','.$row_delivery->DeliveryId.',this)">
                                                <i class="fa-solid fa-close mx-1"></i><span >Delete</span>
                                            </button> 
                                        </div>
                                        <div class="d-inline-block d-md-none">
                                            <div class="dropdown">
                                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti-more-alt icon-rotate-45"></i>
                                                </a>
                                                <ul class="dropdown-menu shadow">  
                                                    <li><a class="dropdown-item m-0 px-2" onclick="print_project_delivery('.$row->InvRef.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-print pe-2"></i>Print</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_delivery('.$row->InvRef.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li> 
                                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_delivery('.$row->InvRef.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="detail-item mt-2 p-2 border-top">
                                    '.$html_items.' 
                                </div>
                            </div>
                            ';
            }
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
    private function get_next_code_penawaran($date){
        //sample SPH/001/01/2024
        $builder = $this->db->table("penawaran");  
        $builder->select("ifnull(max(SUBSTRING(SphCode,5,3)),0) + 1 as nextcode");
        $builder->where("SphDate2",$date);
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
    private function get_next_code_invoice($date){
        //sample INV/001/01/2024
        $builder = $this->db->table("invoice");  
        $builder->select("ifnull(max(SUBSTRING(InvCode,5,3)),0) + 1 as nextcode");
        $builder->where("InvDate2",$date);
        $arr_date = explode("-", $date);
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
        $builder = $this->db->table("payment");  
        $builder->select("ifnull(max(SUBSTRING(PaymentCode,5,3)),0) + 1 as nextcode");
        $builder->where("PaymentDate2",$date);
        $builder->where("PaymentDoc",1);
        $arr_date = explode("-", $date);
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
        $builder = $this->db->table("payment");  
        $builder->select("ifnull(max(SUBSTRING(PaymentCode,5,3)),0) + 1 as nextcode");
        $builder->where("PaymentDate2",$date);
        $builder->where("PaymentDoc",2);
        $arr_date = explode("-", $date);
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
        $builder = $this->db->table("delivery");  
        $builder->select("ifnull(max(SUBSTRING(DeliveryCode,5,3)),0) + 1 as nextcode");
        $builder->where("DeliveryDate2",$date);
        $arr_date = explode("-", $date);
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
        $builder = $this->db->table("pembelian");  
        $builder->select("ifnull(max(SUBSTRING(code,4,3)),0) + 1 as nextcode");
        $builder->where("date_create",$date);
        $arr_date = explode("-", $date);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
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
        (SELECT SphId refid, SphCode as code,SphRef ref,SphDate date, CustomerId custid, "SPH" AS type FROM penawaran UNION SELECT InvId refid,InvCode,InvRef ref,InvDate date,CustomerId, "INV" FROM invoice) AS ref_join
        LEFT JOIN customer ON CustomerId = ref_join.custid
        WHERE ref_join.ref = '.$refid.'
        ORDER BY ref_join.date asc');
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
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('ProjectId', $id); 
        $builder->update();   

        echo json_encode(array("status"=>true)); 
    }
    public function delete_data_project($id){
        $builder = $this->db->table($this->table);
        $builder->where('ProjectId',$id);
        $builder->delete();  

        return JSON_ENCODE(array("status"=>true));
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
            "SphRef"=>$header["SphRef"],
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
        $builder->where('SphId',$id);
        $builder->delete(); 

       
        $builder = $this->db->table("penawaran_detail");
        $builder->where('SphDetailRef',$id);
        $builder->delete(); 

        return JSON_ENCODE(array("status"=>true));
    } 
    public function getdataSPH($id){
        $builder = $this->db->table("penawaran"); 
        $builder->join("customer","penawaran.CustomerId = customer.CustomerId");
        $builder->join("project","ProjectId = SphRef");
        $builder->join("template_footer","TemplateId = template_footer.TemplateFooterId");
        $builder->where('SphId',$id);
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
            "InvRef"=>$header["InvRef"],
            "InvRef1"=>$header["InvRef1"],
            "InvAdmin"=>$header["InvAdmin"],
            "CustomerId"=>$header["CustomerId"],
            "InvAddress"=>$header["InvAddress"],
            "TemplateId"=>$header["TemplateId"],
            "InvSubTotal"=>$header["InvSubTotal"],
            "InvDiscItemTotal"=>$header["InvDiscItemTotal"],
            "InvDiscTotal"=>$header["InvDiscTotal"],
            "InvGrandTotal"=>$header["InvGrandTotal"],
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
        $builder->where('id',$id);
        $builder->delete(); 

       
        $builder = $this->db->table("invoice_detail");
        $builder->where('ref',$id);
        $builder->delete(); 

        return JSON_ENCODE(array("status"=>true));
    }
    public function getdataInvoice($id){
        $builder = $this->db->table("invoice");
        $builder->select("*");
        $builder->join("customer","invoice.CustomerId = customer.CustomerId");
        $builder->join("project","ProjectId = InvRef");
        $builder->join("template_footer","TemplateId = template_footer.TemplateFooterId");
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
            "PaymentRef"=>$data["PaymentRef"],
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
        if (!file_exists($folder_utama."/".$data["PaymentRef"])) {
            mkdir($folder_utama."/".$data["PaymentRef"], 0777, true);  
        }

        if (isset($data['image'])) {  
            $data_image = $this->simpan_gambar_base64($data['image'], $folder_utama."/".$data["PaymentRef"], $query->PaymentId);  
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
        if (!file_exists($folder_utama."/".$data["PaymentRef"])) {
            mkdir($folder_utama."/".$data["PaymentRef"], 0777, true);  
        }

        //Remove image yang lama
        $filename = $folder_utama."/".$data["PaymentRef"].'/'.$id.'.*';
        $files = glob($filename); 
        foreach ($files as $file) {
            unlink($file);
        }

        if (isset($data['image'])) {  
            $data_image = $this->simpan_gambar_base64($data['image'], $folder_utama."/".$data["PaymentRef"], $id);  
        }

    }
    public function delete_data_payment($id){
        $builder = $this->db->table("payment");
        $builder->where('PaymentId',$id);
        $builder->delete();   
        return JSON_ENCODE(array("status"=>true));
    }
    public function getdataPaymentByRef($id){
        $builder = $this->db->table("payment"); 
        $builder->where('PaymentRef',$id); 
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getResult();  
    }
    public function getdataPayment($id){
        $builder = $this->db->table("payment"); 
        $builder->where('PaymentId',$id); 
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getRow();  
    }
    public function getdataImagePayment($ref,$id){
        // Cek apakah file gambar ada
        $path_gambar = 'assets/images/payment/'.$ref.'/'.$id.'.*'; 

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
            "PaymentRef"=>$data["PaymentRef"],
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
        $builder->where('PaymentRef',$id); 
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
            "DeliveryRef"=>$header["DeliveryRef"], 
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
        $builder->set('date', $header["date"]);  
        $builder->set('admin', $header["admin"]);  
        $builder->set('address', $header["address"]); 
        $builder->set('templateid', $header["templateid"]); 
        $builder->set('armada', $header["armada"]); 
        $builder->set('telpreceive', $header["telpreceive"]); 
        $builder->set('namereceive', $header["namereceive"]); 
        $builder->set('deliverytotal', $header["deliverytotal"]);  
        $builder->set('ritase', $header["ritase"]);  
        $builder->where('id', $id); 
        $builder->update(); 

        $builder = $this->db->table("delivery_detail");
        $builder->where('ref',$id);
        $builder->delete(); 

        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["ref"] = $id;
            $row["varian"] = (isset($row["varian"]) ? json_encode($row["varian"]) : "[]");  
            $builder = $this->db->table("delivery_detail");
            $builder->insert($row); 
        } 
    }
    public function delete_data_delivery($id){
        $builder = $this->db->table("delivery");
        $builder->where('id',$id);
        $builder->delete(); 

       
        $builder = $this->db->table("delivery_detail");
        $builder->where('ref',$id);
        $builder->delete(); 

        return JSON_ENCODE(array("status"=>true));
    }
    public function getdataDelivery($id){
        $builder = $this->db->table("delivery"); 
        $builder->join("template_footer","TemplateId = template_footer.TemplateFooterId");
        $builder->where('DeliveryId',$id);  
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
            if($row->produkid == $produkid && $row->varian == $varian && $row->text == $text){
                return $row->qty;
            } 
        }
        return 0;
    }
    public function getdataDetailDeliveryByInvoice($ref,$produkid,$varian,$text){
        $arr_detail_invoice = $this->getdataDetailInvoice($ref);
        $qtysum = 0;
        foreach($arr_detail_invoice as $row){
            if($row->ProdukId == $produkid && $row->InvDetailVarian == $varian && $row->InvDetailText == $text){
                $builder = $this->db->table("delivery_detail"); 
                $builder->join("delivery","DeliveryId = DeliveryDetailRef");
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
            "code"=>$this->get_next_code_pembelian($header["date_create"]),
            "date"=>$header["date"],
            "date_create"=>$header["date_create"],
            "time_create"=>$header["time_create"],
            "storeid"=>$header["storeid"],
            "ref"=>$header["ref"],
            "ref1"=> json_encode($header["ref1"]),
            "admin"=>$header["admin"],
            "customerid"=>$header["customerid"], 
            "vendor"=>$header["vendor"], 
            "templateid"=>$header["templateid"],
            "subtotal"=>$header["subtotal"],
            "pphtotal"=>$header["pphtotal"],
            "disctotal"=>$header["disctotal"],
            "grandtotal"=>$header["grandtotal"],
        ));

        $builder = $this->db->table("pembelian");
        $builder->select('*');
        $builder->orderby('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["ref"] = $query->id;
            $row["varian"] = (isset($row["varian"]) ? json_encode($row["varian"]) : "[]");  
            $builder = $this->db->table("pembelian_detail");
            $builder->insert($row); 
        }

    } 
    public function update_data_pembelian($data,$id){ 
        $header = $data["header"];  
        $builder = $this->db->table("pembelian"); 
        $builder->set('date', $header["date"]);   
        $builder->set('templateid', $header["templateid"]); 
        $builder->set('subtotal', $header["subtotal"]); 
        $builder->set('pphtotal', $header["pphtotal"]); 
        $builder->set('disctotal', $header["disctotal"]); 
        $builder->set('grandtotal', $header["grandtotal"]);   
        $builder->where('id', $id); 
        $builder->update(); 

        $builder = $this->db->table("pembelian_detail");
        $builder->where('ref',$id);
        $builder->delete(); 

       // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["ref"] = $id;
            $row["varian"] = (isset($row["varian"]) ? json_encode($row["varian"]) : "[]");  
            $builder = $this->db->table("pembelian_detail");
            $builder->insert($row); 
        }
    }
    public function delete_data_pembelian($id){
        $builder = $this->db->table("pembelian");
        $builder->where('id',$id);
        $builder->delete(); 

       
        $builder = $this->db->table("pembelian_detail");
        $builder->where('ref',$id);
        $builder->delete(); 

        return JSON_ENCODE(array("status"=>true));
    }
    public function getdataPO($id){
        $builder = $this->db->table("pembelian"); 
        $builder->select("*");
        $builder->join("customer","customerid = customer.id");
        $builder->join("vendor","vendor = vendor.id");
        $builder->join("template_footer","templateid = template_footer.id");
        $builder->where('pembelian.id',$id);  
        return $builder->get()->getRow();  
    }
    public function getdataDetailPO($id){
        $builder = $this->db->table("pembelian_detail"); 
        $builder->where('ref',$id);  
        return $builder->get()->getResult();  
    }
    
}