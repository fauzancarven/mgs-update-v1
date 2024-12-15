<?php

namespace App\Models; 

use CodeIgniter\Model; 
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;

class CustomerModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['code','category','company','name','comment','telp1', 'email','address','telp2','instagram','village'];

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

    public function blog_json()
    {
		$db  = \Config\Database::connect();

        $dt = new Datatables(new Codeigniter4Adapter);

        $builder = $this->db->table($this->table); 
        $builder->join("customercategory","customercategory.id=customer.category");
        $builder->select('customercategory.name kategori,customer.id cust_id,code,category,company,customer.name cust_name,email,Telp1,Telp2,instagram,village,address');
        $query = $builder->getCompiledSelect(); 

        $dt->query($query);

        $dt->add('action', function($data){
        	return '
                <div class="d-md-flex d-none"> 
                    <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click('.$data["cust_id"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                    <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click('.$data["cust_id"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</button> 
                </div>
                <div class="d-md-none d-flex btn-action"> 
                    <div class="dropdown">
                        <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-more-alt icon-rotate-45"></i>
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$data["cust_id"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                            <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$data["cust_id"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                        </ul>
                    </div>
                <div class="d-md-flex d-none"> 
                ';
        }); 
        return $dt->generate();
    }

    public function get_next_code(){
        $builder = $this->db->table($this->table);  
        $builder->select("ifnull(max(SUBSTRING(code,3)),0) + 1 as nextcode");
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "CS00000" . $data->nextcode;
                return $nextid; 
            case 2:
                $nextid = "CS0000" . $data->nextcode;
                return $nextid; 
            case 3:
                $nextid = "CS000" . $data->nextcode;
                return $nextid; 
            case 4:
                $nextid = "CS00" . $data->nextcode;
                return $nextid; 
            case 5:
                $nextid = "CS0" . $data->nextcode;
                return $nextid; 
            case 6:
                $nextid = "CS" . $data->nextcode;
                return $nextid; 
            default:
                $nextid = "CS000000";
                return $nextid; 
        } 
    }

    public function add_customer($data){ 
        $builder = $this->db->table($this->table);
        $builder->insert(array(
            "code"=>$this->get_next_code(),
            "category"=>$data["category"],
            "company"=>$data["company"],
            "name"=>$data["name"],
            "comment"=>$data["comment"],
            "telp1"=>$data["telp1"],
            "telp2"=>$data["telp2"],
            "email"=>$data["email"],
            "instagram"=>$data["instagram"],
            "village"=>$data["village"],
            "address"=>$data["address"],
        )); 
        
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->orderby('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        echo json_encode(array("status"=>true,"data"=>$query)); 
    } 

    public function edit_customer($data,$id){ 
        $builder = $this->db->table($this->table);
        $builder->set(array( 
            "category"=>$data["category"],
            "company"=>$data["company"],
            "name"=>$data["name"],
            "comment"=>$data["comment"],
            "telp1"=>$data["telp1"],
            "telp2"=>$data["telp2"],
            "email"=>$data["email"],
            "instagram"=>$data["instagram"],
            "village"=>$data["village"],
            "address"=>$data["address"],
        )); 
        $builder->where('id', $id);
        $builder->update();
         
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('id', $id);
        $builder->orderby('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        echo json_encode(array("status"=>true,"data"=>$query)); 
    }  
    
    public function delete_customer($data){
        $builder = $this->db->table($this->table);  
        $builder->where('id', $data["id"]);
        $builder->delete(); 
        echo JSON_ENCODE(array("status"=>true));
    }
    
}