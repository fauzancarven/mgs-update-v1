<?php

namespace App\Models;

use CodeIgniter\Model; 
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;
use CodeIgniter\Database\RawSql;
use Myth\Auth\Entities\User; 

class StoreModel extends Model
{
    protected $table = 'store';
    protected $allowedFields = ['StoreCode', 'StoreName', 'StoreLogo', 'StoreAddress', 'StoreEmail', 'StoreTelp1', 'StoreTelp2', 'StoreTelp2', 'TemplatePembelian', 'TemplatePenawaran', 'TemplateInvoice', 'TemplateProforma', 'TemplatePayment', 'TemplatePengiriman','created_at','created_user','updated_at','updated_user'];
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
        $builder->select('StoreId,StoreCode,StoreName,StoreLogo');
        $query = $builder->getCompiledSelect(); 

        $dt->query($query);
        $dt->add('logo', function($data){
            return  '<div><img src="'.$data["StoreLogo"].'"  class="m-auto" style="width:50px;height:50px;"/></div>' ; 
        });
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
            "StoreLogo"=>$data["StoreLogo"],
            "StoreAddress"=>$data["StoreAddress"],
            "StoreEmail"=>$data["StoreEmail"],
            "StoreTelp1"=>$data["StoreTelp1"],
            "StoreTelp2"=>$data["StoreTelp2"],
            "TemplatePembelian"=>$data["TemplatePembelian"],
            "TemplatePenawaran"=>$data["TemplatePenawaran"],
            "TemplateInvoice"=>$data["TemplateInvoice"],
            "TemplateProforma"=>$data["TemplateProforma"],
            "TemplatePayment"=>$data["TemplatePayment"],
            "TemplatePengiriman"=>$data["TemplatePengiriman"], 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
            "created_user"=>user()->id, 
            "updated_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
            "updated_user"=>user()->id, 
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
        $builder->set('StoreLogo', $data["StoreLogo"]); 
        $builder->set('StoreAddress', $data["StoreAddress"]); 
        $builder->set('StoreEmail', $data["StoreEmail"]); 
        $builder->set('StoreTelp1', $data["StoreTelp1"]); 
        $builder->set('StoreTelp2', $data["StoreTelp2"]); 
        $builder->set('TemplatePembelian', $data["TemplatePembelian"]); 
        $builder->set('TemplatePenawaran', $data["TemplatePenawaran"]); 
        $builder->set('TemplateInvoice', $data["TemplateInvoice"]); 
        $builder->set('TemplateProforma', $data["TemplateProforma"]); 
        $builder->set('TemplatePayment', $data["TemplatePayment"]); 
        $builder->set('TemplatePengiriman', $data["TemplatePengiriman"]); 
        $builder->set('updated_at', new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->set('updated_user',user()->id); 
        $builder->where('StoreId', $id); 
        $builder->update();
        echo JSON_ENCODE(array("status"=>true,"data"=>$data,"id"=>$id));
    }
}