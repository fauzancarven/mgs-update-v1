<?php

namespace App\Models; 

use CodeIgniter\Model; 
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;
use CodeIgniter\Database\RawSql;

class CustomerModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true; 

    public function blog_json()
    {
		$db  = \Config\Database::connect();

        $dt = new Datatables(new Codeigniter4Adapter);

        $builder = $this->db->table($this->table); 
        $builder->join("customercategory","customercategory.CustomerCategoryId=customer.CustomerCategoryId");
        $builder->select('customercategory.CustomerCategoryName kategori,
        CustomerId cust_id,
        CustomerCode,
        customer.CustomerCategoryId,
        CustomerCompany,
        CustomerName cust_name,
        CustomerEmail,
        CustomerTelp1,
        CustomerTelp2,
        CustomerInstagram,
        CustomerVillageId,
        CustomerAddress');
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
        $builder->select("ifnull(max(SUBSTRING(CustomerCode,3)),0) + 1 as nextcode");
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
            "CustomerCode"=>$this->get_next_code(),
            "CustomerCategoryId"=>$data["category"],
            "CustomerCompany"=>$data["company"],
            "CustomerName"=>$data["name"],
            "CustomerComment"=>$data["comment"],
            "CustomerTelp1"=>$data["telp1"],
            "CustomerTelp2"=>$data["telp2"],
            "CustomerEmail"=>$data["email"],
            "CustomerInstagram"=>$data["instagram"],
            "CustomerVillageId"=>$data["village"],
            "CustomerAddress"=>$data["address"],
        )); 
        
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->orderby('CustomerId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        echo json_encode(array("status"=>true,"data"=>$query)); 
    } 

    public function edit_customer($data,$id){ 
        $builder = $this->db->table($this->table);
        $builder->set(array( 
            "CustomerCategoryId"=>$data["category"],
            "CustomerCompany"=>$data["company"],
            "CustomerName"=>$data["name"],
            "CustomerComment"=>$data["comment"],
            "CustomerTelp1"=>$data["telp1"],
            "CustomerTelp2"=>$data["telp2"],
            "CustomerEmail"=>$data["email"],
            "CustomerInstagram"=>$data["instagram"],
            "CustomerVillageId"=>$data["village"],
            "CustomerAddress"=>$data["address"], 
            "updated_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
            "updated_user"=>user()->id, 
        )); 
        $builder->where('CustomerId', $id);
        $builder->update();
         
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('CustomerId', $id);
        $builder->orderby('CustomerId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        echo json_encode(array("status"=>true,"data"=>$query)); 
    }  
    
    public function delete_customer($data){
        $builder = $this->db->table($this->table);  
        $builder->where('CustomerId', $data["id"]);
        $builder->delete(); 
        echo JSON_ENCODE(array("status"=>true));
    }
    
    public function get_customer_name($id){
        $builder = $this->db->table($this->table);  
        $builder->where("CustomerId",$id);
        $data = $builder->get()->getRow(); 
        if($data){ 
            if($data->CustomerCompany == "" || $data->CustomerCompany == "-"){ 
                return $data->CustomerCode. " - ".$data->CustomerName;
            }else{
                return $data->CustomerCode. " - ".$data->CustomerName. " (".$data->CustomerCompany. ")"; 
            }
        }else{
            return "CS0000 - null";
        }
    }   
}