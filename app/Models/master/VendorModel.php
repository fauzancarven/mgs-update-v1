<?php

namespace App\Models\master; 

use CodeIgniter\Model; 
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;
class VendorModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'vendor';
    protected $primaryKey = 'VendorId';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['VendorCode','VendorName','VendorTelp1','VendorTelp2','VendorAddress','VendorCategory'];

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
    public function blog_json()
    {
		$db  = \Config\Database::connect();

        $dt = new Datatables(new Codeigniter4Adapter);

        $builder = $this->db->table($this->table); 
        $builder->select('VendorId,VendorCode,VendorName,VendorTelp1,VendorTelp2,VendorAddress,VendorCategory');
        $query = $builder->getCompiledSelect(); 

        $dt->query($query);

        $dt->add('category', function($data){
          
            $category = "";
            foreach (explode("|",$data["VendorCategory"]) as $index=>$x) {
                $category .= '<span class="badge badge-'.fmod($index, 5).'">'.$x.'</span>';
            }  
            return $category;
        });
        $dt->add('action', function($data){
        	return ' 
                <a onclick="edit_click('.$data["VendorId"].')"
                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                    <iconify-icon icon="lucide:edit"></iconify-icon>
                </a>
                <a onclick="delete_click('.$data["VendorId"].')"
                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                    <iconify-icon icon="mingcute:delete-2-line">
                    </iconify-icon>
                </a>  
                ';
        });


        

        return $dt->generate();
    }
    public function delete_vendor($data){
        $builder = $this->db->table($this->table);  
        $builder->where('id', $data["id"]);
        $builder->delete(); 
        echo JSON_ENCODE(array("status"=>true));
    }
}