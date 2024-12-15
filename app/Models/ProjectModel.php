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
            date,
            project.category project_category, 
            project.id project_id,
            StoreLogo,
            StoreCode,
            customer.id customer_id, 
            customer.name customer_name, 
            customer.code customer_code, 
            customer.address customer_address
        '); 
        $builder->like("project.category",$search);
        $builder->orLike("StoreCode",$search);
        $builder->orLike("customer.name",$search);
        $builder->orLike("customer.code",$search);
        $builder->orLike("customer.address",$search); 
        $query = $builder->getCompiledSelect();

        $dt->query($query);

        $dt->add('html', function($data){
            $date = date_create($data["date"]); 
            $category = "";
            foreach (explode("|",$data["project_category"]) as $x) {
                $category .= '<span class="badge bg-primary text-white me-1">'.$x.'</span>';
            }
        	return '  
            <div class="card card-project">
                <div class="row mb-4">
                    <div class="col-6"> 
                        <div class="d-flex mb-2 align-items-center ">
                            <img src="'.$data["StoreLogo"].'" height="25" class="pe-2"/>
                            <span class="category-project me-2">'.$data["StoreCode"].'</span> 
                            <span class="mx-2">'.date_format($date,"d M Y").'</span>  
                            <span class="mx-2">'. $category .'</span>  
                        </div>  
                        <span class="header-project">'.$data["customer_name"].'</span>
                        <div class="address-project">'.$data["customer_address"].'</div>
                    </div>
                    <div class="col-6">

                    </div>
                </div>  
                <ul class="nav nav-tabs" name="nav-tab-project-table" data-id="'.$data["project_id"].'" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-tab="survey" data-bs-toggle="tab" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Survey</button>
                    </li>
                    <li class="nav-item d-none" role="presentation"> 
                        <button class="nav-link" data-tab="bq" type="button" data-bs-toggle="tab" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Bill of Quantity (BQ)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-tab="po" type="button" data-bs-toggle="tab" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Pembelian</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-tab="sph" type="button" data-bs-toggle="tab" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Penawaran (SPH)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-tab="invoice" type="button" data-bs-toggle="tab" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Invoice</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-tab="file" type="button" data-bs-toggle="tab" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">File</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-tab="diskusi" type="button" data-bs-toggle="tab" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Diskusi</button>
                    </li>
                </ul>
                <div class="tab-content"> 
                    <div class="loading-spinner" id="tab-content-project-spinner-'.$data["project_id"].'"></div>
                    <div id="tab-content-project-'.$data["project_id"].'"></div>
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