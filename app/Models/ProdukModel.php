<?php

namespace App\Models; 

use CodeIgniter\Model;  
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;
use app\helper\rupiah;
use CodeIgniter\Database\RawSql; 

class ProdukModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'produk'; 
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true; 

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
        $builder->join("produk_category","produk_category.ProdukCategoryId=produk.ProdukCategoryId");
        // $builder->select('customercategory.name kategori,customer.id cust_id,code,category,company,customer.name cust_name,email,Telp1,Telp2,instagram,village,address');
        $builder->select('ProdukId,ProdukCategoryName as category_name,ProdukCode,ProdukName,ProdukDetail,ProdukPrice,ProdukVendor,ProdukVarian');
        $query = $builder->getCompiledSelect(); 

        $dt->query($query); 

        $dt->add('vendor_detail', function($data){
            $html = ""; 
            $datas = json_decode($data["ProdukVendor"]); 
            foreach ($datas as $varian) {  
                $html .= '<span class="badge badge-3">'.$varian->text.'</span>';  
            }
 
            $html = '<span class="fw-bold font-std">Vendor</span><div class="d-flex gap-1">'.$html.'</div>';
            $split_varian = json_decode($data["ProdukVarian"]); 
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
            $builder->join("produk_satuan","produk_satuan.ProdukSatuanId =  produk_detail.ProdukDetailSatuanId"); 
            $builder->select('*'); 
            $builder->where("ProdukDetailRef",$data["ProdukId"]); 
            $builder->orderby('produk_detail.ProdukDetailId', 'asc'); 
            return json_encode($builder->get()->getResult()); 

        });
        
        $dt->add('produk_name', function($data){
            $folder = 'assets/images/produk/'.$data["ProdukId"]."/";
            $default = 'assets/images/produk/default.png';
            
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);  
            } 
            $files = array_diff(scandir($folder) , array('.', '..'));  
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
                            <span class="text-head-1">'.$data["ProdukName"].'</span>
                            <span class="text-detail-1 text-truncate">'.$data["ProdukCode"].' - '.$data["category_name"].'</span> 
                        </div>
                    </div>
                </div>'; 

        });
        $dt->add('action', function($data){
        	return '
                <div class="d-md-flex d-none"> 
                    <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click('.$data["ProdukId"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                    <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click('.$data["ProdukId"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</button> 
                </div>
                <div class="d-md-none d-flex btn-action"> 
                    <div class="dropdown">
                        <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-more-alt icon-rotate-45"></i>
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$data["ProdukId"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                            <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$data["ProdukId"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                        </ul>
                    </div>
                <div class="d-md-flex d-none"> 
                ';
        }); 
        $dt->edit('ProdukPrice', function ($data) {  
            if (strpos($data["ProdukPrice"], '-') !== false) {
                list($min, $max) = explode(' - ', $data["ProdukPrice"]);
                return "Rp. " . number_format($min, 0, ',', '.') . " - Rp. " . number_format($max, 0, ',', '.');
            } else {
                return "Rp. " . number_format($data["ProdukPrice"], 0, ',', '.');
            } 
        });
        return $dt->generate();
    }
    public function load_datatable_produk($filter = null){
        $querytext = "";
        $builder = $this->db->table($this->table);
        $builder->join("produk_category","produk_category.ProdukCategoryId=produk.ProdukCategoryId","left");   

        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();


        $filterdata = 0;
        if(isset($filter["filter"])){ 
            $builder->groupStart(); 
            foreach($filter["filter"] as $key => $value){
                if($key == "Vendor"){ 
                    foreach($filter["filter"]["Vendor"] as $row){
                        $builder->orLike("ProdukVendor",$row);  
                    }
                } else{
                    foreach($filter["filter"][$key] as $row){
                        $builder->orLike("ProdukVarian",$row);  
                    } 
                }
            }  
            $builder->groupEnd(); 
            $filterdata = 1;
        } 
        if(isset($filter["search"]["value"])){
            $builder->groupStart(); 
            $builder->like("ProdukCode",$filter["search"]["value"]);
            $builder->orLike("ProdukName",$filter["search"]["value"]);  
            $builder->groupEnd(); 
            $filterdata = 1;
        }
        if(isset($filter["category"])){  
            $builder->whereIn("ProdukCategoryCode",$filter["category"]);
            $filterdata = 1;
        } 
 
        // $builder->groupEnd();  
        $columns = array(
            0 => null, // kolom action tidak dapat diurutkan
            1 => null, // kolom name
            2 => "ProdukCategoryName", // kolom action tidak dapat diurutkan
            3 => "ProdukName", // kolom image tidak dapat diurutkan
            4 => "ProdukPrice", // kolom action tidak dapat diurutkan
            5 => null, // kolom action tidak dapat diurutkan
        );
        if (isset($filter['order'][0]['column']) && $columns[$filter['order'][0]['column']] !== null) { 
            $orderColumn = $columns[$filter['order'][0]['column']];
            $orderDir = $filter['order'][0]['dir'];
        
            if ($orderDir != 'asc' && $orderDir != 'desc') {
                $orderDir = 'asc';
            }
         
            $builder->orderby($orderColumn,$orderDir);   
        }
        $datafilter = clone $builder;  
        $count = $datafilter->get()->getNumRows();
        
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $builder->limit($length,$start); 
        $query = $builder->get(); 
        $datatable = array(); 
        foreach($query->getResult() as $row){    

            // VENDOR AND VARIAN PRODUK
            $vendorhtml="";
            $datavendor = json_decode($row->ProdukVendor); 
            foreach ($datavendor as $varian) {  
                $vendorhtml .= '<span class="badge badge-3">'.$varian->text.'</span>';  
            } 
            $vendorhtml = '<div><span class="fw-bold font-std">Vendor</span><div class="d-flex gap-1 pb-2 flex-wrap overflow-x-auto">'.$vendorhtml.'</div></div>';
            $split_varian = json_decode($row->ProdukVarian); 
            $html_varian = "";
            $data = $split_varian;
            $i = 0;
            foreach ($data as $varian) { 
                $html_varian = "";
                foreach ($varian->value as $value) {
                    $html_varian .= '<span class="badge badge-'.fmod($i, 5).'">'.$value->text.'</span>';  
                }
                $i++;
                $vendorhtml .= '<div><span class="fw-bold font-std">'.$varian->varian.'</span><div class="d-flex gap-1 pb-2 flex-wrap overflow-x-auto">'.$html_varian.'</div></div>';
            }  

            // PRICE PRODUK 
            if (strpos($row->ProdukPrice, '-') !== false) {
                list($min, $max) = explode(' - ', $row->ProdukPrice); 
                $price = "<span class='text-head-2'>Rp. " . number_format($min, 0, ',', '.') . " - Rp. " . number_format($max, 0, ',', '.')."</span>";
            } else { 
                $price =  "<span class='text-head-2'>Rp. " . number_format($row->ProdukPrice, 0, ',', '.')."</span>";
            }   

 


            $builder = $this->db->table("produk_detail");  
            $builder->join("produk_satuan","produk_satuan.ProdukSatuanId =  produk_detail.ProdukDetailSatuanId"); 
            $builder->select('*'); 
            $builder->where("ProdukDetailRef",$row->ProdukId); 
            $builder->orderby('produk_detail.ProdukDetailId', 'asc'); 
            $variandetail = $builder->get()->getResult(); 
            
            $data_row = array(
                "image" => "<img src='".$this->getproductimageUrl($row->ProdukId)."?".date("Y-m-dH:i:s")."' alt='Gambar' class='image-produk'>",
                "code" => $row->ProdukCode,
                "name" => $row->ProdukName,
                "kategori" => $row->ProdukCategoryName,
                "harga" => $price,
                "varian" => '<a class="pointer text-decoration-underline text-head-3 btn-detail">Lihat Detail</a>',
                "variandetail" => $this->getproductdetail($row->ProdukId),
                "action" =>'  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="edit_click('.$row->ProdukId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Penawaran" onclick="delete_click('.$row->ProdukId.',this)"><i class="fa-solid fa-circle-xmark"></i></span>
                        </div>',
            );
            array_push($datatable, $data_row);
        }






        return json_encode(
            array(
                "draw"=>$draw,
                "recordsTotal"=>$countTotal,
                "recordsFiltered"=>($filterdata == 0 ? $countTotal : $count ),
                "data"=>$datatable, 
            )
        );

    }

    public function load_table_produk($filter = null){
        $querytext = "";
        $builder = $this->db->table($this->table);
        $builder->join("produk_category","produk_category.ProdukCategoryId=produk.ProdukCategoryId","left");   
        if(isset($filter["filter"])){ 
            $builder->groupStart(); 
            foreach($filter["filter"] as $key => $value){
                if($key == "Vendor"){ 
                    foreach($filter["filter"]["Vendor"] as $row){
                        $builder->orLike("ProdukVendor",$row);  
                    }
                } else{
                    foreach($filter["filter"][$key] as $row){
                        $builder->orLike("ProdukVarian",$row);  
                    } 
                }
            }  
            $builder->groupEnd(); 
        } 
        if(isset($filter["search"])){
            $builder->groupStart(); 
            $builder->like("ProdukCode",$filter["search"]);
            $builder->orLike("ProdukName",$filter["search"]);  
            $builder->groupEnd(); 
        }
        if(isset($filter["category"])){  
            $builder->whereIn("ProdukCategoryCode",$filter["category"]);
        } 
 
        // $builder->groupEnd();   
        $perPage = 10;
        $page = $filter["paging"]; // atau dapatkan dari parameter GET 
        $offset = ($page - 1) * $perPage; 
        $builder->limit($perPage, $offset);
        $query = $builder->get();     
        $count = $query->getNumRows();
        $html = "";

        foreach($query->getResult() as $row){  
            $html .= '<div class="row align-items-start justify-content-between py-2 my-2 border-bottom">';
            // IMAGE AND NAME PRODUK
            $folder = 'assets/images/produk/'.$row->ProdukId."/";
            $default = 'assets/images/produk/default.png';
            
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);  
            } 
            $files = array_diff(scandir($folder), array('.', '..'));  
            $gambar = null;

            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    $gambar = $folder . $file;
                    break;
                }
            } 
            $html .=   ' 
            <div class="col-md-4 col-10 order-0 d-flex align-items-center">
                    <div class="flex-shrink-0 ">
                        ' . ($gambar ? "<img src='".base_url().$gambar."?".date("Y-m-dH:i:s")."' alt='Gambar' class='image-produk'>" : "<img class='image-produk' src='".base_url().$default."' alt='Gambar Default' style='scale: 0.7'>").' 
                    </div>
                    <div class="flex-grow-1 ms-3 ">
                        <div class="d-flex flex-column">
                            <span class="text-head-1">'.$row->ProdukName.'</span>
                            <span class="text-detail-1 text-truncate">'.$row->ProdukCode.' - '.$row->ProdukCategoryName.'</span> 
                        </div>
                    </div>
            </div>'; 
 
            
            // VENDOR AND VARIAN PRODUK
            $vendorhtml="";
            $datavendor = json_decode($row->ProdukVendor); 
            foreach ($datavendor as $varian) {  
                $vendorhtml .= '<span class="badge badge-3">'.$varian->text.'</span>';  
            } 
            $vendorhtml = '<div><span class="fw-bold font-std">Vendor</span><div class="d-flex gap-1 pb-2 flex-wrap overflow-x-auto">'.$vendorhtml.'</div></div>';

            $split_varian = json_decode($row->ProdukVarian); 
            $html_varian = "";
            $data = $split_varian;
            $i = 0;
            foreach ($data as $varian) { 
                $html_varian = "";
                foreach ($varian->value as $value) {
                    $html_varian .= '<span class="badge badge-'.fmod($i, 5).'">'.$value->text.'</span>';  
                }
                $i++;
                $vendorhtml .= '<div><span class="fw-bold font-std">'.$varian->varian.'</span><div class="d-flex gap-1 pb-2 flex-wrap overflow-x-auto">'.$html_varian.'</div></div>';
            } 

            $html .= '<div class="col-md-4 order-2 order-sm-1 d-flex flex-sm-row flex-md-column gap-1">'.$vendorhtml.'</div>';


            // PRICE PRODUK
            $html .= '<div class="col-md-2 order-3">';
            if (strpos($row->ProdukPrice, '-') !== false) {
                list($min, $max) = explode(' - ', $row->ProdukPrice);
                $html .= "<span class='text-head-2'>Rp. " . number_format($min, 0, ',', '.') . " - Rp. " . number_format($max, 0, ',', '.')."</span>";
            } else {
                $html .=  "<span class='text-head-2'>Rp. " . number_format($row->ProdukPrice, 0, ',', '.')."</span>";
            }  
            $html .= '</div>';


            //ACTION 
            
            $html .= '
            <div class="col-md-2 col-2 order-1 order-sm-3">
                <div class="d-md-flex d-none"> 
                    <button class="btn btn-sm btn-primary btn-action m-1" onclick="edit_click('.$row->ProdukId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                    <button class="btn btn-sm btn-danger btn-action m-1" onclick="delete_click('.$row->ProdukId.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</button> 
                </div>
                <div class="d-md-none d-flex btn-action float-end"> 
                    <div class="dropdown">
                        <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-more-alt icon-rotate-45"></i>
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$row->ProdukId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                            <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$row->ProdukId.',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                        </ul>
                    </div>
                </div>
            </div>';

            $html .=  '</div>';
        }

        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Tidak ada data yang ditemukan</span> 
                </div> 
            ';
        }
        $html = '
            <div class="row pb-4 d-sm-flex d-none">
                <div class="col-md-4 col-10 order-0"><span class="text-head-1">Nama</span></div>
                <div class="col-md-4 order-2 order-sm-1"><span class="text-head-1">Varian</span></div>
                <div class="col-md-2 order-3 order-sm-2"><span class="text-head-1">Harga</span></div>
                <div class="col-md-2 col-2 order-1 order-sm-3"><span class="text-head-1">Action</span></div>
            </div>
        '.$html;
 
        $builder = $this->db->table($this->table);
        $builder->join("produk_category","produk_category.ProdukCategoryId=produk.ProdukCategoryId","left");  
        if(isset($filter["filter"])){ 
            $builder->groupStart(); 
            foreach($filter["filter"] as $key => $value){
                if($key == "Vendor"){ 
                    foreach($filter["filter"]["Vendor"] as $row){
                        $builder->orLike("ProdukVendor",$row);  
                    }
                } else{
                    foreach($filter["filter"][$key] as $row){
                        $builder->orLike("ProdukVarian",$row);  
                    } 
                }
            }  
            $builder->groupEnd(); 
        } 
        if(isset($filter["search"])){
            $builder->groupStart(); 
            $builder->like("ProdukCode",$filter["search"]);
            $builder->orLike("ProdukName",$filter["search"]); 
            $builder->groupEnd(); 
        }  
        if(isset($filter["category"])){  
            $builder->whereIn("ProdukCategoryCode",$filter["category"]);
        } 
        $countTotal = $builder->get()->getNumRows();
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html,
                "total"=>$countTotal,
                "totalresult"=>$count,
                "paging"=>$offset, 
            )
        );


    }

    public function getHtml($data) {
        $folder = 'assets/images/produk/'.$data["ProdukId"]."/";
        $default = 'assets/images/produk/default.png';

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);  
        } 
        $files = array_diff(scandir($folder), array('.', '..')); 
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
                            <span class="text-head-1">'.$data["ProdukName"].'</span>
                            <span class="text-detail-1 text-truncate">'.$data["ProdukCode"].' - '.$data["ProdukCategoryName"].'</span> 
                        </div>
                    </div>
                </div>'; 
    }
    private function get_next_code($category_id): string{

        //mengambil code kategory
        $builder = $this->db->table("produk_category");
        $builder->select('*');
        $builder->where('ProdukCategoryId', $category_id);
        $builder->orderby('ProdukCategoryId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        $category_code = $query->ProdukCategoryCode;


        $builder = $this->db->table($this->table);  
        $builder->select("ifnull(max(SUBSTRING(ProdukCode,4)),0) + 1 as nextcode"); 
        $builder->where('ProdukCategoryId',$category_id);
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
        $code =  $this->get_next_code($method["data"]["ProdukCategoryId"]); 
        $method["data"]["ProdukCode"] =  $code;
        $method["data"]["created_at"] =  new RawSql('CURRENT_TIMESTAMP()');
        $method["data"]["created_user"] =  user()->id; 
        // ADD Header PRODUK 
        $builder = $this->db->table($this->table);
        $builder->insert($method["data"]); 

        // GET ID PRODUK 
        $builder = $this->db->table($this->table);
        $builder->select('*'); 
        $builder->orderby('ProdukId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();
        
       // ADD DETAIL PRODUK 
        foreach($method["detail"] as $row){ 
            $row["ProdukDetailRef"] = $query->ProdukId;
            $row["ProdukDetailVarian"] = json_encode($row["ProdukDetailVarian"]); 
            unset($row["ProdukDetailSatuanText"]);    
            $builder = $this->db->table("produk_detail");
            $builder->insert($row); 
        }
        $id = $query->ProdukId;
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
            $files = scandir($folder_utama."/".$id)?: [];
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
        $builder->set('ProdukName', $method["data"]["ProdukName"]);
        $builder->set('ProdukDetail', $method["data"]["ProdukDetail"]); 
        $builder->set('ProdukVendor', $method["data"]["ProdukVendor"]); 
        $builder->set('ProdukPrice', $method["data"]["ProdukPrice"]); 
        $builder->set('ProdukVarian', $method["data"]["ProdukVarian"]); 
        $builder->where('ProdukId', $id);
        $builder->update(); 
 
       // EDIT DETAIL PRODUK 

        //delete data lama
        $builder = $this->db->table("produk_detail");  
        $builder->where('ProdukDetailRef', $id);
        $builder->delete(); 

        //insert data baru
        foreach($method["detail"] as $row){ 
            $row["ProdukDetailRef"] = $id;
            $row["ProdukDetailVarian"] = json_encode($row["ProdukDetailVarian"]); 
            unset($row["ProdukDetailSatuanText"]);    
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
            $files = scandir($folder_utama."/".$id)?: [];;
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
    public function rename_produk($id,$data){
        
        $builder = $this->db->table($this->table); 
        $builder->set('ProdukName', $data["ProdukName"]);
        $builder->where('ProdukId', $id);
        $builder->update(); 
    }
    public function delete_produk($id){
        //delete data lama
        $builder = $this->db->table("produk");  
        $builder->where('ProdukId', $id);
        $builder->delete(); 

        $builder = $this->db->table("produk_detail");  
        $builder->where('ProdukDetailRef', $id);
        $builder->delete(); 

        //hapus semua file di folder id tersebut
        $folder_utama = 'assets/images/produk'; 
        if (is_dir($folder_utama."/".$id)) {
            $files = scandir($folder_utama."/".$id) ?: [];
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    unlink($folder_utama."/".$id . '/' . $file);
                }
            }  
        }
    }
    public function get_produk($post){ 
        $builder = $this->db->table("produk");   
        $builder->join("produk_category","produk_category.ProdukCategoryId=produk.ProdukCategoryId","left");   
        $builder->join("produk_detail","produk.ProdukId= produk_detail.ProdukDetailRef","left");  
        $builder->join("produk_satuan","produk_satuan.ProdukSatuanId= produk_detail.ProdukDetailSatuanId","left");   
        $builder->like('ProdukName', $post["search"]);  
        if(isset($post["category"])){  
            $builder->whereIn("ProdukCategoryCode",$post["category"]);
        }  
        if(isset($post["filter"])){  
            $builder->groupStart(); 
            foreach($post["filter"] as $key => $value){
                if($key == "Vendor"){ 
                    foreach($post["filter"]["Vendor"] as $row){
                        $builder->orLike("ProdukDetailVarian",$row);  
                    }
                } else{
                    foreach($post["filter"][$key] as $row){
                        $builder->orLike("ProdukDetailVarian",$row);  
                    } 
                }
            }  
            $builder->groupEnd(); 

        } 
        $result =  $builder->get()->getResult();  
        $array_php = array();
        foreach($result as $row){ 
            $array_php[] = array(
                'image' => ($row->ProdukDetailImage == "" ? $this->getproductimageUrl($row->ProdukId): $row->ProdukDetailImage),
                'name' => $row->ProdukName,
                'kode' => $row->ProdukCode,
                'kategori' => $row->ProdukCategoryName,
                'varian' => json_decode($row->ProdukDetailVarian),
                'price_buy' => $row->ProdukDetailHargaBeli,
                'price_sell' => $row->ProdukDetailHargaJual,
                'id' => $row->ProdukId,
                'produkid' => $row->ProdukId, 
                'text' => $row->ProdukName,
                'group' => $row->ProdukCategoryName,
                'berat' => $row->ProdukDetailBerat,
                'satuan_id' => $row->ProdukSatuanId,
                'satuan_text' => $row->ProdukSatuanName,
                'pcsM2' => $row->ProdukDetailPcsM2,
                'disc' => "0",
                'qty' => "1",
                'total' => $row->ProdukDetailHargaJual,
            ); 
        }
        return json_encode(
            $array_php
        );
    }


    public function getproductdetail($id,$url = true){
        $builder = $this->db->table("produk_detail");
        $builder->join("produk_satuan","produk_satuan.ProdukSatuanId =  produk_detail.ProdukDetailSatuanId"); 
        $builder->where('ProdukDetailRef', $id);  
        $result =  $builder->get()->getResult();
        $array_php = array();
        foreach($result as $row){ 
            $array_php[] = array(
                'ProdukDetailId' =>  $row->ProdukDetailId,
                'ProdukDetailBerat' => $row->ProdukDetailBerat,
                'ProdukDetailSatuanId' => $row->ProdukDetailSatuanId,
                'ProdukDetailSatuanText' => $row->ProdukSatuanCode,
                'ProdukDetailPcsM2' => $row->ProdukDetailPcsM2,
                'ProdukDetailHargaBeli' => $row->ProdukDetailHargaBeli,
                'ProdukDetailHargaJual' => $row->ProdukDetailHargaJual,
                'ProdukDetailImage' => ($row->ProdukDetailImage == "" ? ($url == true ? $this->getproductimageUrl($id) : $this->getproductimage($id)): $row->ProdukDetailImage),
                'ProdukDetailVarian' =>  json_decode($row->ProdukDetailVarian),
            );
        } 
        return $array_php;
    }
    public function getproductimageAll($id){
        $folder = 'assets/images/produk/'.$id."/";  

        if (is_dir($folder)) { 
            $files = scandir($folder);
            $gambar = array(); 
            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    $gambar[] = $this->ambil_gambar_base64($folder . $file); 
                }
            } 
        }
        return $gambar;
    }
    public function getproductimage($id){
        $folder = 'assets/images/produk/'.$id."/";  
        if (is_dir($folder)) { 
            $files = scandir($folder);
            $gambar = array(); 
            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    return $this->ambil_gambar_base64($folder . $file); 
                }
            } 
        } 
        return "";
        //return $this->ambil_gambar_base64('assets/images/produk/default.png'); 
    }
    public function getproductimageUrl($id){
        $folder = 'assets/images/produk/'.$id."/";  
        if (is_dir($folder)) { 
            $files = scandir($folder) ?: [];
            $gambar = array(); 
            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    return  base_url().$folder . $file."?".date("Y-m-dH:i:s"); 
                }
            } 
        } 
        return base_url()."assets/images/produk/default.png";
        //return $this->ambil_gambar_base64('assets/images/produk/default.png'); 
    }
    public function getDetailProduk($data,$id,$url = true){ 
        $query = "select * from produk_detail left join produk_satuan on produk_satuan.ProdukSatuanId =  produk_detail.ProdukDetailSatuanId where ProdukDetailRef = ".$id;
        $builder = $this->db->table("produk_detail");
        $builder->join("produk_satuan","produk_satuan.ProdukSatuanId =  produk_detail.ProdukDetailSatuanId"); 
        $builder->where('ProdukDetailRef', $id);  
        foreach ($data as $item) { 
            $whereClause = "JSON_EXTRACT(ProdukDetailVarian, '$.".strtolower($item["varian"])."') = '".$item["value"]."'"; 
            $builder->where($whereClause);    
            $query .= ' and '.$whereClause;
        }  
        $result = $builder->get()->getRow();  
        if($result){ 
            return array(
                'ProdukDetailId' =>  $result->ProdukDetailId,
                'ProdukDetailRef' =>  $result->ProdukDetailRef,
                'ProdukDetailBerat' => $result->ProdukDetailBerat,
                'ProdukDetailSatuanId' => $result->ProdukDetailSatuanId,
                'ProdukDetailSatuanText' => $result->ProdukSatuanCode,
                'ProdukDetailPcsM2' => $result->ProdukDetailPcsM2,
                'ProdukDetailHargaBeli' => $result->ProdukDetailHargaBeli,
                'ProdukDetailHargaJual' => $result->ProdukDetailHargaJual,
                'ProdukDetailVarian' =>  json_decode($result->ProdukDetailVarian), 
                'ProdukDetailImage' => ($result->ProdukDetailImage == "" ? ($url == true ? $this->getproductimageUrl($id) : $this->getproductimage($id)): $result->ProdukDetailImage),
            ); 
        }else{
            return null;
        }
    }
    public function getproductimagedatavarian($id,$data,$url = true){
        $arr_varian = json_decode($data); 
        $data_varian = array();
        foreach($arr_varian as $varian){ 
            $data_varian[] = array("varian"=>$varian->varian,  "value"=> $varian->value); 
        }
        $data_image = $this->getDetailProduk($data_varian,$id,$url) ; 

        if($data_image){
            return $data_image["ProdukDetailImage"];
        }else{
            $folder = 'assets/images/produk/'.$id."/";  
            if (is_dir($folder)) { 
                $files = scandir($folder);
                $gambar = array(); 
                foreach ($files as $file) {
                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        return ($url == true ? base_url($folder . $file) : $this->ambil_gambar_base64($folder . $file)); 
                    }
                } 
            }
        }
        return ($url == true ? base_url('assets/images/produk/default.png') : $this->ambil_gambar_base64('assets/images/produk/default.png'));  
    }

}