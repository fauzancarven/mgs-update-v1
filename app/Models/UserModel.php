<?php

namespace App\Models;

use CodeIgniter\Model; 
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;
use CodeIgniter\Files\File;
use CodeIgniter\Database\RawSql;
use Myth\Auth\Password;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password', 'image',"level"];
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
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry, That email has already been taken. Please choose another.'
        ]
    ]; 
    protected $skipValidation = true;
    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) {
            return $data;
        } 
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    } 
    public function compressImageToBase64($source, $quality) {
        $info = getimagesize($source);
        $mime = $info['mime'];
    
        // Start output buffering
        ob_start();
    
        if ($mime == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, null, $quality); // Output ke buffer
        } elseif ($mime == 'image/png') {
            $image = imagecreatefrompng($source);
            imagepng($image, null, round($quality / 10)); // Output ke buffer
        } elseif ($mime == 'image/gif') {
            $image = imagecreatefromgif($source);
            imagegif($image); // Output ke buffer
        }
    
        // Ambil data dari buffer dan bersihkan buffer
        $compressedImageData = ob_get_clean();
    
        // Hapus resource gambar dari memori
        imagedestroy($image);
    
        // Encode data ke base64
        $base64 = 'data:' . $mime . ';base64,' . base64_encode($compressedImageData);
    
        return $base64;
    }
    

    /**
     * FUNCTION UNTUK DATATABLE
     */ 
    public function blog_json()
    {
        

		$db  = \Config\Database::connect();

        $dt = new Datatables(new Codeigniter4Adapter);

        $builder = $this->db->table($this->table);

        $builder->select('id,code,username,email,level as idlevel, IF(level = 0, "Administrator", "Staff") as level,created_at');
        $query = $builder->getCompiledSelect();

        $dt->query($query);

        $dt->add('image', function($data){ 
            $path = 'assets/images/profile/user/'.$data["code"].'.png';
            if (file_exists($path)) {    
                return  '<div><img src="'.base_url().  $path ."?timestamp=".date("YmdHis").'"  class="image-upload m-auto" style="width:50px;height:50px;"/></div>' ;
            } else {
                $path = 'assets/images/profile/default.png';   
                return  '<div><img src="'.base_url().  $path ."?timestamp=".date("YmdHis").'"  class="image-upload m-auto" style="width:50px;height:50px;"/></div>' ;
            } 
        }); 
        $dt->add('action', function($data){
        	return ' 
                <div class="d-md-flex d-none"> 
                    <button class="btn btn-sm btn-action btn-primary rounded m-1" onclick="edit_click('.$data["id"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</button>
                    <button class="btn btn-sm btn-action btn-warning rounded m-1" onclick="reset_click('.$data["id"].',this)"><i class="fa-solid fa-key  pe-2"></i>Reset Password</button>
                    <button class="btn btn-sm btn-action btn-danger rounded m-1" onclick="delete_click('.$data["id"].',this)"><i class="fa-solid fa-close  pe-2"></i>Delete</button> 
                </div>
                <div class="d-md-none d-flex btn-action"> 
                    <div class="dropdown">
                        <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-more-alt icon-rotate-45"></i>
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item m-0 px-2" onclick="edit_click('.$data["id"].',this)"><i class="fa-solid fa-pencil pe-2"></i>Edit</a></li>
                            <li><a class="dropdown-item m-0 px-2" onclick="reset_click('.$data["id"].',this)"><i class="fa-solid fa-key pe-2"></i>Reset Password</a></li>
                            <li><a class="dropdown-item m-0 px-2" onclick="delete_click('.$data["id"].',this)"><i class="fa-solid fa-close pe-2"></i>Delete</a></li> 
                        </ul>
                    </div> 
                </div> ';
        }); 
        return $dt->generate();
    }




    private function get_next_code(): string{
        $builder = $this->db->table($this->table);  
        $builder->select("max(SUBSTRING(CODE,3)) + 1 as nextcode"); 
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "ID0000" . $data->nextcode;
                return $nextid; 
            case 2:
                $nextid = "ID000" . $data->nextcode;
                return $nextid; 
            case 3:
                $nextid = "ID00" . $data->nextcode;
                return $nextid; 
            case 4:
                $nextid = "ID0" . $data->nextcode;
                return $nextid;
            case 5:
                $nextid = "ID" . $data->nextcode;
                return $nextid; 
            default:
                $nextid = "ID00000";
                return $nextid; 
        } 
    }

    public function add_account($data){   
        $nextid = $this->get_next_code(); 
        $datas =  $data['image']; 
        $image_array_1 = explode(";", $datas);
        $image_array_2 = explode(",", $image_array_1[1]); 
        $datas = base64_decode($image_array_2[1]);   
        file_put_contents('assets/images/profile/user/'.$nextid.'.png', $datas); 
        $data = [ 
            'code'              => $nextid,
            'email'             => $data['email'],
            'username'          => $data['username'],  
            'password_hash'     => Password::hash($data['password']),  
            'level'             => $data['level'], 
            'active'            => 1, 
            'created_at'       => new RawSql('CURRENT_TIMESTAMP()'),
            'updated_at'       => new RawSql('CURRENT_TIMESTAMP()'),
        ]; 
        
        $builder = $this->db->table($this->table); 
        $data_result = $builder->insert($data);   
        echo JSON_ENCODE(array("status"=>true,"result"=>$data_result));
    } 
    public function reset_password_account($data){ 
        $builder = $this->db->table($this->table);  
        $builder->set('password_hash', Password::hash($data['password'])); 
        $builder->where('id', $data['id']);
        $builder->update();
        echo JSON_ENCODE(array("status"=>true,"data"=>$data));
    } 
    public function edit_account($data,$id){ 
        $path = 'assets/images/profile/user/'.$data["code"].'.png';
        if (file_exists($path)) {   
            unlink($path); 
        }
        $datas =  $data['image']; 
        $image_array_1 = explode(";", $datas);
        $image_array_2 = explode(",", $image_array_1[1]); 
        $datas = base64_decode($image_array_2[1]);   
        file_put_contents('assets/images/profile/user/'.$data["code"].'.png', $datas);  

        $builder = $this->db->table($this->table); 
        $builder->set('email', $data["email"]);
        $builder->set('username', $data['username']); 
        $changepassword = false;
        if($data['password'] != ""){
            $builder->set('password_hash', Password::hash($data['password'])); 
            $changepassword = true;
        }
        $builder->set('level', $data['level']); 
        $builder->set('updated_at', new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('id', $id);
        $builder->update();

        
        echo JSON_ENCODE(array("status"=>true,"data"=>$data,"id"=>$id));
    }
}