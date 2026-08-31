<?php

namespace App\Models; 

use CodeIgniter\Model; 
class TemplatefooterModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'template_footer';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name'];

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

    /********************************************** */
    /** FUNCTION UNTUK MENU PROJECT TEMPLATE FOOTER */  
    /********************************************** */
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
    
}