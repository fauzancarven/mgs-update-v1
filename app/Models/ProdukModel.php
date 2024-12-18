<?php

namespace App\Models; 

use CodeIgniter\Model;  
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;
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
            $html = "Vendor";
            $split_data = explode("|", $data["vendor"]);
            foreach ($split_data as $value) {
                $builder = $this->db->table("vendor");  
                $builder->select('*'); 
                $builder->where("id",$value); 
                $builder->orderby('id', 'DESC');
                $builder->limit(1);
                $query = $builder->get()->getRow(); 
                $html .= '<span class="badge bg-success">'.$query->code.'<span class="d-none d-md-inline-block">&nbsp;-&nbsp;'.$query->name.'</span></span>'; 
            } 
            $html = '<div class="d-flex gap-1">'.$html.'</div>';
            $split_varian = json_decode($data["varian"], true); 
            $html_varian = "";
            for ($i = 0; $i < count($split_varian); $i++) { 
                foreach ($split_varian[$i] as $k => $v) {
                    if ($k == 'value') {
                        foreach ($v as $val) { 
                            $html_varian .= '<span class="badge bg-success">'.$val['text'].'</span>'; 
                        }
                    } else { 
                        $html_varian .= $v."</br>"; 
                    }
                } 
                $html_varian = '<div class="d-flex gap-1">'.$html_varian.'</div>';
            }  
            return '<div class="d-flex flex-column gap-1">'.$html.$html_varian.'</div>';
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
            $default = 'assets/images/produk/default.jpg';

            $files = scandir($folder);
            $gambar = null;

            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    $gambar = $folder . $file;
                    break;
                }
            }

            if ($gambar) {
                echo "<img src='$gambar' alt='Gambar'>";
            } else {
                echo "<img src='$default' alt='Gambar Default'>";
            }


           return '<div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img src="'.base_url("assets/images/produk/").'" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    This is some content from a media component. You can replace this with any content and adjust it as needed.
                </div>
                </div>';
            return json_encode($builder->get()->getResult()); 

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
        return $dt->generate();
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

       
       // ADD IMAGE PRODUK  
       
        //Buat folder utama
        $folder_utama = 'assets/images/produk'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 

        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$query->id)) {
            mkdir($folder_utama."/".$query->id, 0777, true);  
        }

        //hapus semua file di folder id tersebut
        if (is_dir($folder_utama."/".$query->id)) {
            $files = scandir($folder_utama."/".$query->id);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    unlink($folder_utama."/".$query->id . '/' . $file);
                }
            }  
        }
        if (isset($data['image'])) { 
            $no = 1;
            foreach($method["image"] as $row){ 
                $this->simpan_gambar_base64($row, $folder_utama."/".$query->id, $no);
                $no++;
            }
        }
       
 
        echo json_encode(array("status"=>true)); 
    }
}