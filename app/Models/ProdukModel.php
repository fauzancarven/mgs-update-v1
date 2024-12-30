<?php

namespace App\Models; 

use CodeIgniter\Model;  
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;
use app\helper\rupiah;
class ProdukModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['category','code','name','detail','price_range','vendor','varian'];

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
        $builder->join("produk_category","produk_category.id=produk.category");
        // $builder->select('customercategory.name kategori,customer.id cust_id,code,category,company,customer.name cust_name,email,Telp1,Telp2,instagram,village,address');
        $builder->select('produk.id,produk_category.name as category_name,produk.code,produk.name,detail,price_range,vendor,varian');
        $query = $builder->getCompiledSelect(); 

        $dt->query($query); 

        $dt->add('vendor_detail', function($data){
            $html = ""; 
            $datas = json_decode($data["vendor"]); 
            foreach ($datas as $varian) {  
                $html .= '<span class="badge badge-3">'.$varian->text.'</span>';  
            }
 
            $html = '<span class="fw-bold font-std">Vendor</span><div class="d-flex gap-1">'.$html.'</div>';
            $split_varian = json_decode($data["varian"]); 
            $html_varian = "";
            $data = $split_varian;
            $i = 0;
            foreach ($data as $varian) { 
                $html_varian = "";
                foreach ($varian->value as $value) {
                    $html_varian .= '<span class="badge badge-'.fmod($i, 5).'">'.$value->text.'</span>';  
                }
                $i++;
                $html .= '<span class="fw-bold font-std mt-2">'.$varian->varian.'</span><div class="d-flex gap-1">'.$html_varian.'</div>';
            } 
            return '<div class="d-flex flex-column gap-1">'.$html.'</div>';
        });

        $dt->add('produk_detail', function($data){
            $builder = $this->db->table("produk_detail");  
            $builder->join("produk_satuan","produk_satuan.id =  produk_detail.satuan_id"); 
            $builder->select('produk_detail.id,berat,name,pcsm2,hargabeli,hargajual,varian'); 
            $builder->where("ref",$data["id"]); 
            $builder->orderby('produk_detail.id', 'asc'); 
            return json_encode($builder->get()->getResult()); 

        });
        
        $dt->add('produk_name', function($data){
            $folder = 'assets/images/produk/'.$data["id"]."/";
            $default = 'assets/images/produk/default.png';

            $files = scandir($folder);
            $gambar = null;

            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    $gambar = $folder . $file;
                    break;
                }
            } 
            return '<div class="d-flex align-items-center">
                    <div class="flex-shrink-0 ">
                        ' . ($gambar ? "<img src='".base_url().$gambar."' alt='Gambar' class='image-produk'>" : "<img class='image-produk' src='".base_url().$default."' alt='Gambar Default' style='scale: 0.7'>").' 
                    </div>
                    <div class="flex-grow-1 ms-3 ">
                        <div class="d-flex flex-column gap-1">
                            <span class="text-head-1">'.$data["name"].'</span>
                            <span class="text-detail-1 text-truncate">'.$data["code"].' - '.$data["category_name"].'</span> 
                        </div>
                    </div>
                </div>'; 

        });
        $dt->add('action', function($data){
        	return '
                <div class="d-md-flex d-none"> 
                    <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click('.$data["id"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                    <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click('.$data["id"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</button> 
                </div>
                <div class="d-md-none d-flex btn-action"> 
                    <div class="dropdown">
                        <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-more-alt icon-rotate-45"></i>
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$data["id"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                            <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$data["id"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                        </ul>
                    </div>
                <div class="d-md-flex d-none"> 
                ';
        }); 
        $dt->edit('price_range', function ($data) { 

            if (strpos($data["price_range"], '-') !== false) {
                list($min, $max) = explode(' - ', $data["price_range"]);
                return "Rp. " . number_format($min, 0, ',', '.') . " - Rp. " . number_format($max, 0, ',', '.');
            } else {
                return "Rp. " . number_format($data["price_range"], 0, ',', '.');
            } 
        });
        return $dt->generate();
    }
    public function getHtml($data) {
        $folder = 'assets/images/produk/'.$data["id"]."/";
        $default = 'assets/images/produk/default.png';

        $files = scandir($folder);
        $gambar = null;

        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                $gambar = $folder . $file;
                break;
            }
        }  
        return '<div class="d-flex align-items-center">
                    <div class="flex-shrink-0 ">
                        ' . ($gambar ? "<img src='".base_url().$gambar."' alt='Gambar' class='image-produk'>" : "<img class='image-produk' src='".base_url().$default."' alt='Gambar Default' style='scale: 0.7'>").' 
                    </div>
                    <div class="flex-grow-1 ms-3 ">
                        <div class="d-flex flex-column">
                            <span class="text-head-1">'.$data["name"].'</span>
                            <span class="text-detail-1 text-truncate">'.$data["code"].' - '.$data["cat_name"].'</span> 
                        </div>
                    </div>
                </div>'; 
    }
    private function get_next_code($category_id): string{

        //mengambil code kategory
        $builder = $this->db->table("produk_category");
        $builder->select('*');
        $builder->where('id', $category_id);
        $builder->orderby('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        $category_code = $query->code;


        $builder = $this->db->table($this->table);  
        $builder->select("ifnull(max(SUBSTRING(CODE,4)),0) + 1 as nextcode"); 
        $builder->where('category',$category_id);
        $data = $builder->get()->getRow(); 

        
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = $category_code . "0000" . $data->nextcode;
                return $nextid; 
            case 2:
                $nextid = $category_code . "000" . $data->nextcode;
                return $nextid; 
            case 3:
                $nextid = $category_code . "00" . $data->nextcode;
                return $nextid; 
            case 4:
                $nextid = $category_code . "0" . $data->nextcode;
                return $nextid;
            case 5:
                $nextid = $category_code . $data->nextcode;
                return $nextid; 
            default:
                $nextid =  $category_code . "00000";
                return $nextid; 
        } 
    }

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
    private function ambil_gambar_base64($path_gambar) {
       // Cek apakah file gambar ada
        if (!file_exists($path_gambar)) {
            return false;
        }

        // Ambil jenis file gambar
        $jenis_gambar = mime_content_type($path_gambar);

        // Baca file gambar
        $gambar = file_get_contents($path_gambar);

        // Ubah gambar ke base64
        $base64 = base64_encode($gambar);

        // Tambahkan header jenis file gambar
        $base64 = "data:$jenis_gambar;base64,$base64";

        return $base64;
    }
    public function add_produk($method){
        $code =  $this->get_next_code($method["data"]["category"]); 
        $method["data"]["code"] =  $code;

        // ADD Header PRODUK 
        $builder = $this->db->table($this->table);
        $builder->insert($method["data"]); 

        // GET ID PRODUK 
        $builder = $this->db->table($this->table);
        $builder->select('*'); 
        $builder->orderby('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        
       // ADD DETAIL PRODUK 
        foreach($method["detail"] as $row){ 
            $row["ref"] = $query->id;
            $row["varian"] = json_encode($row["varian"]); 
            unset($row["satuantext"]);    
            $builder = $this->db->table("produk_detail");
            $builder->insert($row); 
        }
        $id = $query->id;
        //$id = "20";
       // ADD IMAGE PRODUK  
       
        //Buat folder utama
        $folder_utama = 'assets/images/produk'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 

        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)) {
            mkdir($folder_utama."/".$id, 0777, true);  
        }

        //hapus semua file di folder id tersebut
        if (is_dir($folder_utama."/".$id)) {
            $files = scandir($folder_utama."/".$id);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    unlink($folder_utama."/".$id . '/' . $file);
                }
            }  
        }
        
        
        if (isset($method['image'])) { 
            $no = 1;
           
            foreach($method["image"] as $row){ 
                $data_image = $this->simpan_gambar_base64($row, $folder_utama."/".$id, $no); 
                $no++;
            }
        }
       
 
        echo json_encode(array("status"=>true)); 
    }

    public function edit_produk($method,$id){ 

        // EDIT Header PRODUK  
        $builder = $this->db->table($this->table); 
        $builder->set('name', $method["data"]["name"]);
        $builder->set('detail', $method["data"]["detail"]); 
        $builder->set('vendor', $method["data"]["vendor"]); 
        $builder->set('price_range', $method["data"]["price_range"]); 
        $builder->set('varian', $method["data"]["varian"]); 
        $builder->where('id', $id);
        $builder->update(); 
 
       // EDIT DETAIL PRODUK 

        //delete data lama
        $builder = $this->db->table("produk_detail");  
        $builder->where('ref', $id);
        $builder->delete(); 

        //insert data baru
        foreach($method["detail"] as $row){ 
            $row["ref"] = $id;
            $row["varian"] = json_encode($row["varian"]); 
            unset($row["satuantext"]);    
            $builder = $this->db->table("produk_detail");
            $builder->insert($row); 
        }

       
       // ADD IMAGE PRODUK  
       
        //Buat folder utama
        $folder_utama = 'assets/images/produk'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 

        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)) {
            mkdir($folder_utama."/".$id, 0777, true);  
        }

        //hapus semua file di folder id tersebut
        if (is_dir($folder_utama."/".$id)) {
            $files = scandir($folder_utama."/".$id);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    unlink($folder_utama."/".$id . '/' . $file);
                }
            }  
        }
        if (isset($method['image'])) { 
            $no = 1;
            foreach($method["image"] as $row){ 
                $this->simpan_gambar_base64($row, $folder_utama."/".$id, $no);
                $no++;
            }
        }
       
 
        echo json_encode(array("status"=>true)); 
    }
    public function getproductdetail($id){
        $builder = $this->db->table("produk_detail");
        $builder->join("produk_satuan","produk_satuan.id =  produk_detail.satuan_id");
        $builder->select('produk_detail.id,berat,satuan_id,name satuantext,pcsm2,hargabeli,hargajual,varian'); 
        $builder->where('produk_detail.ref', $id);  
        $result =  $builder->get()->getResult();
        $array_php = array();
        foreach($result as $row){ 
            $array_php[] = array(
                'id' =>  $row->id,
                'berat' => $row->berat,
                'satuan_id' => $row->satuan_id,
                'satuantext' => $row->satuantext,
                'pcsM2' => $row->pcsm2,
                'hargabeli' => $row->hargabeli,
                'hargajual' => $row->hargajual,
                'varian' =>  json_decode($row->varian),
            );
        } 
        return $array_php;
    }
    public function getproductimage($id){
        $folder = 'assets/images/produk/'.$id."/";  
        $files = scandir($folder);
        $gambar = array(); 
        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                $gambar[] = $this->ambil_gambar_base64($folder . $file); 
            }
        } 
        return $gambar;
    }
    public function getDetailProduk($data,$id){
        $query = "select produk_detail.id,berat,satuan_id,name satuantext,pcsm2,hargabeli,hargajual,varian from produk_detail left join produk_satuan on produk_satuan.id =  produk_detail.satuan_id where produk_detail.ref = 1";
        $builder = $this->db->table("produk_detail");
        $builder->select('produk_detail.id,berat,satuan_id,name satuantext,pcsm2,hargabeli,hargajual,varian'); 
        $builder->join("produk_satuan","produk_satuan.id =  produk_detail.satuan_id");
        $builder->where('produk_detail.ref', $id);  
        foreach ($data as $item) { 
            $whereClause = "JSON_EXTRACT(varian, '$.".strtolower($item["varian"])."') = '".$item["value"]."'"; 
            $query .= " And ". $whereClause;
            $builder->where($whereClause);    
        } 
        $result = $builder->get()->getRow();   
        return array(
            'id' =>  $result->id,
            'berat' => $result->berat,
            'satuan_id' => $result->satuan_id,
            'satuantext' => $result->satuantext,
            'pcsM2' => $result->pcsm2,
            'hargabeli' => $result->hargabeli,
            'hargajual' => $result->hargajual,
            'varian' =>  json_decode($result->varian),
        ); ;
    }
}