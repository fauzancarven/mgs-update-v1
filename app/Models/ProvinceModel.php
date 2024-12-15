<?php

namespace App\Models; 

use CodeIgniter\Model; 
class ProvinceModel extends Model
{ 
    public function all()
    {
        $builder = $this->db->table($this->table);
        $builder->join("users",$this->table.".author=users.id");
        $builder->orderBy($this->table.'.id DESC');
        $builder->select("*,".$this->table.".id");
        $result = $builder->get();
        return $result;
    }

    public function get_province()
    {
        $builder = $this->db->table("province"); 
        $result = $builder->get();  
        $list = array();
        $key = 0;
        foreach ($result->getResult() as $row) {
            $list[$key]['id'] = $row->id;
            $list[$key]['value'] = $row->name;
            $list[$key]['text'] = $row->name;
            $list[$key]['kode'] = "";
            $key++;
        }
        return $list; 
    }
    
    public function get_city($provinceid)
    {
        $builder = $this->db->table("regency"); 
        $builder->where("provinceid",$provinceid);
        $result = $builder->get();  
        $list = array();
        $key = 0;
        foreach ($result->getResult() as $row) {
            $list[$key]['id'] = $row->id;
            $list[$key]['value'] = $row->name;
            $list[$key]['text'] = $row->name;
            $list[$key]['kode'] = "";
            $key++;
        }
        return $list; 
    } 
    public function get_district($provinceid,$district)
    {
        $builder = $this->db->table("district"); 
        $builder->where("provinceid",$provinceid);
        $builder->where("regencyid",$district);
        $result = $builder->get();  
        $list = array();
        $key = 0;
        foreach ($result->getResult() as $row) {
            $list[$key]['id'] = $row->id;
            $list[$key]['value'] = $row->name;
            $list[$key]['text'] = $row->name;
            $list[$key]['kode'] = "";
            $key++;
        }
        return $list; 
    } 
    public function get_village($provinceid,$district,$village) 
    {
        $builder = $this->db->table("village"); 
        $builder->where("provinceid",$provinceid);
        $builder->where("regencyid",$district);
        $builder->where("districtid",$village);
        $result = $builder->get();  
        $list = array();
        $key = 0;
        foreach ($result->getResult() as $row) {
            $list[$key]['id'] = $row->id;
            $list[$key]['value'] = $row->name;
            $list[$key]['text'] = $row->name.", ".$row->kodepos;
            $list[$key]['kode'] = $row->kodepos;
            $key++;
        }
        return $list; 
    }  
    public function get_search($search){
        
        $builder = $this->db->table("village");  
        $builder->join('province', 'province.id = village.provinceid', 'left');
        $builder->join('regency', 'regency.id = village.regencyid', 'left');
        $builder->join('district', 'district.id = village.districtid', 'left');  
        $builder->select("province.id as province_id, province.name as province_name,regency.id as regency_id, regency.name as regency_name,district.id as district_id, district.name as district_name,village.id as village_id,village.kodepos as village_kodepos,village.name as village_name");
        $builder->like("province.name",$search);
        $builder->orLike("regency.name",$search);
        $builder->orLike("province.name",$search);
        $builder->orLike("district.name",$search);
        $builder->orLike("village.name",$search);
        $builder->orLike("kodepos",$search); 

        
        $result = $builder->get(100);  
        $list = array();
        $key = 0;
        foreach ($result->getResult('array') as $row) { 
            $list[$key]['prov']['id'] = $row["province_id"];
            $list[$key]['prov']['value'] = $row["province_name"];
            $list[$key]['kota']['id'] =$row["regency_id"];
            $list[$key]['kota']['value'] =$row["regency_name"];
            $list[$key]['kec']['id'] = $row["district_id"];
            $list[$key]['kec']['value'] = $row["district_name"];
            $list[$key]['poscode']['id'] =$row["village_id"];
            $list[$key]['poscode']['value'] = $row["village_name"];
            $list[$key]['poscode']['kode'] = $row["village_kodepos"]; 
            $list[$key]['text'] =  "<b>".$row["village_kodepos"] . "</b>, " .$row["village_name"]. ", " .$row["district_name"]. ", " .$row["regency_name"]. ", " .$row["province_name"];
            $key++;
        }
        echo json_encode($list);
        exit; 
    }
    public function get_village_by_id($id){
        
        $builder = $this->db->table("village");  
        $builder->join('province', 'province.id = village.provinceid', 'left');
        $builder->join('regency', 'regency.id = village.regencyid', 'left');
        $builder->join('district', 'district.id = village.districtid', 'left');  
        $builder->select("province.id as province_id, province.name as province_name,regency.id as regency_id, regency.name as regency_name,district.id as district_id, district.name as district_name,village.id as village_id,village.kodepos as village_kodepos,village.name as village_name");
        $builder->like("village.id",$id); 

        
        $result = $builder->get(1);  
        $list = array();
        $key = 0;
        foreach ($result->getResult('array') as $row) { 
            $list[$key]['prov']['id'] = $row["province_id"];
            $list[$key]['prov']['value'] = $row["province_name"];
            $list[$key]['kota']['id'] =$row["regency_id"];
            $list[$key]['kota']['value'] =$row["regency_name"];
            $list[$key]['kec']['id'] = $row["district_id"];
            $list[$key]['kec']['value'] = $row["district_name"];
            $list[$key]['poscode']['id'] =$row["village_id"];
            $list[$key]['poscode']['value'] = $row["village_name"];
            $list[$key]['poscode']['kode'] = $row["village_kodepos"]; 
            $list[$key]['text'] =  "<b>".$row["village_kodepos"] . "</b>, " .$row["village_name"]. ", " .$row["district_name"]. ", " .$row["regency_name"]. ", " .$row["province_name"];
            $key++;
        }
        return json_encode($list); 
    }
}