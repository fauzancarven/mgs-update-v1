<?php

namespace App\Models;

use CodeIgniter\Model; 
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;

class StoreModel extends Model
{
    protected $table = 'store';
    protected $allowedFields = ['StoreCode', 'StoreName'];
    protected $useTimeStamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $DBGroup              = 'default'; 
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true; 
  
    protected $validationRules = [
        'StoreCode' => 'required',
        'StoreName' => 'required', 
    ]; 

    /**
     * FUNCTION UNTUK DATATABLE
     */ 
    public function blog_json()
    {
		$db  = \Config\Database::connect();

        $dt = new Datatables(new Codeigniter4Adapter);

        $builder = $this->db->table($this->table); 
        $builder->select('StoreId,StoreCode,StoreName');
        $query = $builder->getCompiledSelect(); 

        $dt->query($query);

        $dt->add('action', function($data){
        	return ' 
                <div class="d-md-inline-block d-none"> 
                    <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click('.$data["StoreId"].')"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                    <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click('.$data["StoreId"].')"><i class="fa-solid fa-close  pe-2"></i>Delete</button> 
                </div>
                <div class="d-md-none d-flex btn-action"> 
                    <div class="dropdown">
                        <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-more-alt icon-rotate-45"></i>
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$data["StoreId"].')"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                            <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$data["StoreId"].')"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                        </ul>
                    </div> 
                </div> 
                ';
        });


        

        return $dt->generate();
    }
    public function add_store($data){
        $builder = $this->db->table($this->table);
        $builder->where("StoreCode",$data["StoreCode"]);
        if($builder->countAllResults() > 0){ 
            return JSON_ENCODE(array("err"=>"Data kode sudah digunakan","status"=>false));
        } 

        $builder = $this->db->table($this->table);
        $builder->insert(array(
            "StoreCode"=>$data["StoreCode"],
            "StoreName"=>$data["StoreName"],
        ));

        echo JSON_ENCODE(array("status"=>true));
    }
    public function delete_store($data){
        $builder = $this->db->table($this->table);  
        $builder->where('StoreId', $data["StoreId"]);
        $builder->delete(); 
        echo JSON_ENCODE(array("status"=>true));
    }
 
    public function edit_store($data,$id){ 
        $builder = $this->db->table($this->table); 
        $builder->set('StoreCode', $data["StoreCode"]);
        $builder->set('StoreName', $data["StoreName"]); 
        $builder->where('StoreId', $id);
        $builder->update();
        echo JSON_ENCODE(array("status"=>true,"data"=>$data,"id"=>$id));
    }
}