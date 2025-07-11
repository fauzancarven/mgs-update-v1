<?php

namespace App\Models; 

use CodeIgniter\Model; 
use CodeIgniter\Database\RawSql;
use App\Models\NotificationModel; 
use App\Models\ActivityModel;

class PaymentModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'payment';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['PaymentCode',
        'PaymentRef',
        'PaymentRefType',
        'PaymentDate',
        'PaymentDate2',
        'PaymentType',
        'PaymentMethod',
        'PaymentTotal',
        'PaymentNote', 
        'PaymentFromBank',
        'PaymentFromRek',
        'PaymentFromName', 
        'PaymentToBank', 
        'PaymentToRek',
        'PaymentToName',
        'PaymentDoc',
        'PaymentStatus',
        'PaymentForward',
        'TemplateId', 
    ];  
    
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
    
    private function get_next_code_payment($date){
        //sample INV/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("payment");  
        $builder->select("ifnull(max(SUBSTRING(PaymentCode,5,3)),0) + 1 as nextcode"); 
        $builder->where("month(PaymentDate2)",$arr_date[1]);
        $builder->where("year(PaymentDate2)",$arr_date[0]);
        $builder->where("PaymentDoc",1);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "PAY/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "PAY/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "PAY/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "PAY/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    }
    private function get_next_code_proforma($date){
        //sample INV/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("payment");  
        $builder->select("ifnull(max(SUBSTRING(PaymentCode,5,3)),0) + 1 as nextcode");
        $builder->where("month(PaymentDate2)",$arr_date[1]);
        $builder->where("year(PaymentDate2)",$arr_date[0]); 
        $builder->where("PaymentDoc",2);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "PRO/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "PRO/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "PRO/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "PRO/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    } 
    
    public function get_data_request_payment($id){
        $builder = $this->db->table("payment"); 
        $builder->where('PaymentId',$id);  
        return $builder->get()->getRow();  
    }
    public function insert_data_payment($data){
        $nextcode = $this->get_next_code_payment($data["PaymentDate"]);
        $builder = $this->db->table("payment");
        $builder->insert(array( 
            "PaymentCode"=>$nextcode,
            "PaymentRef"=>$data["PaymentRef"],
            "PaymentRefType"=>$data["PaymentRefType"], 
            "ProjectId"=>$data["ProjectId"],
            "PaymentDate"=>$data["PaymentDate"],
            "PaymentDate2"=>$data["PaymentDate"],
            "PaymentType"=>$data["PaymentType"],
            "PaymentMethod"=>$data["PaymentMethod"],
            "PaymentTotal"=>$data["PaymentTotal"],
            "PaymentNote"=>$data["PaymentNote"], 
            "PaymentDoc"=>1,   
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("payment");
        $builder->select('*');
        $builder->orderby('PaymentId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  

        //Buat folder utama
        $folder_utama = 'assets/images/payment'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        }   
         //Buat folder utama
        $folder_utama .= '/'.$data["PaymentRefType"]; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 

        //Buat folder berdasarkan id
        $folder_utama .= '/'.$data["PaymentRef"]; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        //Buat folder berdasarkan id
        $folder_utama .= '/sumber'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 

        if (isset($data['image'])) {  
            $data_image = $this->simpan_gambar_base64($data['image'], $folder_utama, $query->PaymentId);  
        } 
 
        // $modelssample = new ProjectsampleModel;
        // if($data["PaymentRefType"] == "Sample") $modelssample->update_data_sample_status($data["PaymentRef"]);

        // if($data["PaymentRefType"] == "Invoice") $this->update_data_invoice_status($data["PaymentRef"]); 
    } 
    
    public function insert_data_proforma($data){
        $builder = $this->db->table("payment");
        $builder->insert(array(
            "PaymentCode"=>$this->get_next_code_proforma($data["PaymentDate"]), 
            "ProjectId"=>$data["ProjectId"],
            "PaymentRef"=>$data["PaymentRef"],
            "PaymentRefType"=>$data["PaymentRefType"],
            "PaymentDate"=>$data["PaymentDate"],
            "PaymentDate2"=>$data["PaymentDate"],
            "PaymentType"=>$data["PaymentType"], 
            "PaymentTotal"=>$data["PaymentTotal"],
            "PaymentNote"=>$data["PaymentNote"], 
            "PaymentDoc"=>2,  
            "TemplateId"=>$data["TemplateId"],  
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        // $builder = $this->db->table("payment");
        // $builder->select('*');
        // $builder->orderby('PaymentId', 'DESC');
        // $builder->limit(1);
        // $query = $builder->get()->getRow();   
        
        
        // $modelssample = new ProjectsampleModel;
        // if($data["PaymentRefType"] == "Sample"){
        //     $modelssample->update_data_sample_status($data["PaymentRef"]);
        // }

        // if($data["PaymentRefType"] == "Invoice"){ 
        //     $this->update_data_invoice_status($data["PaymentRef"]);
        // }
    }
    public function insert_data_payment_request($data){
        $nextcode = $this->get_next_code_payment(date("Y-m-d"));
        $builder = $this->db->table("payment");
        $builder->insert(array( 
            "PaymentCode"=>$nextcode,
            "PaymentRef"=>$data["PaymentRequestRef"],
            "PaymentRefType"=>$data["PaymentRequestRefType"], 
            "ProjectId"=>$data["ProjectId"],
            "PaymentDate"=>date("Y-m-d"),
            "PaymentDate2"=>date("Y-m-d"),
            "PaymentMethod"=>"0",
            "PaymentType"=>$data["PaymentRequestMethod"],
            "PaymentToBank"=>$data["PaymentRequestBank"], 
            "PaymentToName"=>$data["PaymentRequestName"], 
            "PaymentToRek"=>$data["PaymentRequestRek"], 
            "PaymentTotal"=>$data["PaymentRequestTotal"],  
            "PaymentDoc"=>1,   
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        )); 

        //create Log action 
        $activityModel = new ActivityModel();
        $activityModel->insert(
            array( 
                "menu"=>"Payment",
                "type"=>"Add",
                "name"=>"Request Payment dari ".$data["PaymentRequestRefType"]." baru ditambahkan dengan nomor ".$nextcode,
                "desc"=> json_encode($data ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

        // $builder = $this->db->table("payment_request");
        // $builder->insert(array(  
        //     "PaymentRequestMethod"=>$data["PaymentRequestMethod"], 
        //     "PaymentRequestRef"=>$data["PaymentRequestRef"],
        //     "PaymentRequestRefType"=>$data["PaymentRequestRefType"], 
        //     "ProjectId"=>$data["ProjectId"],
        //     "PaymentRequestBank"=>$data["PaymentRequestBank"],
        //     "PaymentRequestRek"=>$data["PaymentRequestRek"],
        //     "PaymentRequestName"=>$data["PaymentRequestName"],
        //     "PaymentRequestTotal"=>$data["PaymentRequestTotal"],
        //     "PaymentRequestStatus"=>$data["PaymentRequestStatus"], 
        //     "created_user"=>user()->id, 
        //     "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        // ));  

        if($data["PaymentRequestMethod"] == "Cash"){
            $message = sprintf(
                "*PENGAJUAN PEMBAYARAN*\n" .
                "ada request pembayaran dari dokumen %s yang dibuat oleh %s dengan permintaan cash atau tunai\n" . 
                "\tNama \t\t: %s\n" .
                "\tTotal \t\t: Rp. %s",
                $data["PaymentRequestRefType"],
                user()->username, 
                $data["PaymentRequestName"],
                number_format($data["PaymentRequestTotal"])
            ); 
        }else{
            $message = sprintf(
                "*PENGAJUAN PEMBAYARAN*\n" .
                "ada request pembayaran dari dokumen %s yang dibuat oleh %s ditransfer ke\n" .
                "\tBank \t\t: %s\n" .
                "\tNo. Rekening \t: %s\n" .
                "\tNama \t\t: %s\n" .
                "\tTotal \t\t: Rp. %s",
                $data["PaymentRequestRefType"],
                user()->username,
                $data["PaymentRequestBank"],
                $data["PaymentRequestRek"],
                $data["PaymentRequestName"],
                number_format($data["PaymentRequestTotal"])
            ); 
        } 

        $sender = new NotificationModel();
        $sender->send_wa($message);
    }
    public function delete_data_payment_request($id){  
        
        $dataold = $builder = $this->getWhere(['paymentId' => $id], 1)->getRow();  
        $builder = $this->db->table($this->table);
        $builder->where('paymentId',$id);
        $builder->delete();   
 
        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Payment",
                "type"=>"Delete",
                "name"=>"Data pembayaran dihapus dengan nomor ".$dataold->PaymentCode,
                "desc"=> json_encode( $dataold ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

        return JSON_ENCODE(array("status"=>true));
    }
    public function update_data_payment_request($data,$id){  
        $dataold = $builder = $this->getWhere(['paymentId' => $id], 1)->getRow();  

        $builder = $this->db->table("payment"); 
        $builder->set('PaymentMethod', $data["PaymentMethod"]);
        $builder->set('PaymentToBank', $data["PaymentToBank"]); 
        $builder->set('PaymentToName', $data["PaymentToName"]);  
        $builder->set('PaymentToRek', $data["PaymentToRek"]); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));   
        $builder->where('PaymentId', $id); 
        $builder->update();  

        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Payment",
                "type"=>"Edit",
                "name"=>"Data pembayaran diubah dengan nomor ".$dataold->PaymentCode,
                "desc"=> json_encode(array("new"=>$data,"old" => $dataold) ?? []), 
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

        return JSON_ENCODE(array("status"=>true));
    }

    public function getMethod(){
       return $this->db->table("method")->get()->getResult();  
    }
    public function get_data_payment_by_invoice($id){
        $builder = $this->db->table("payment");  
        $builder->where('PaymentRef',$id); 
        $builder->where('PaymentRefType',"Invoice"); 
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getResult();  
    }
    public function get_data_payment_by_sample($id){
        $builder = $this->db->table("payment"); 
        $builder->where('PaymentRef',$id); 
        $builder->where('PaymentRefType',"Sample"); 
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getResult();  
    }
    public function get_data_payment_by_pembelian($id){
        $builder = $this->db->table("payment"); 
        $builder->where('PaymentRef',$id); 
        $builder->where('PaymentRefType',"Pembelian");  
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getResult();  
    }
    public function get_data_payment_by_delivery($id){
        $builder = $this->db->table("payment"); 
        $builder->where('PaymentRef',$id); 
        $builder->where('PaymentRefType',"Pengiriman");  
        $builder->where('PaymentDoc',1); 
        return $builder->get()->getResult();  
    }
    
    public function get_data_proforma_by_ref($id){
        $builder = $this->db->table("payment"); 
        $builder->where('PaymentRef',$id); 
        $builder->where('PaymentRefType',"Invoice"); 
        $builder->where('PaymentDoc',2); 
        return $builder->get()->getResult();  
    }

    
}