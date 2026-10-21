<?php

namespace App\Models; 

use CodeIgniter\Model; 
use CodeIgniter\Database\RawSql;
use App\Models\master\ProdukModel;
helper('file_helper');
class DeliveryModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'delivery';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['menu','type','name','desc','created_at','created_user'];

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

    private function get_next_code_delivery($date){
        //sample SPH/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("delivery");  
        $builder->select("ifnull(max(SUBSTRING(DeliveryCode,5,3)),0) + 1 as nextcode"); 
        $builder->where("month(DeliveryDate2)",$arr_date[1]);
        $builder->where("year(DeliveryDate2)",$arr_date[0]); 
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "DEL/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "DEL/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "DEL/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "DEL/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    } 
  
    function customColor($number) {
        switch ($number) {
                  case 0:
                            return 'bg-info-50 text-primary-600';
                            break;
                  case 1:
                            return 'bg-warning-50 text-warning-600';
                            break;
                  case 2:
                            return 'bg-success-50 text-success-600';
                            break;
                  case 3:
                            return 'bg-danger-50 text-danger-600';
                            break;
                  case 4:
                            return 'bg-info-focus text-primary-600';
                            break;

                  default:
                            break;
        }
    }

    function load_datatable_delivery($filter = null){
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();
        
        $builder = $this->db->table("delivery");  
        $builder->join("users","users.id = delivery.DeliveryAdmin ","left");  
        $builder->join("store","store.StoreId = delivery.StoreId","left");    
        if($filter["datestart"]){
            $builder->where("DeliveryDate >=",$filter["datestart"]);
            $builder->where("DeliveryDate <=",$filter["dateend"]); 
        } 
        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();


        if(isset($filter["filter"])){ 
            $builder->whereIn("DeliveryStatus",$filter["filter"]); 
            $filterdata = 1;
        } 
        if(isset($filter["store"])){ 
            $builder->whereIn("pembelian.StoreId",$filter["store"]); 
            $filterdata = 1;
        } 
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("ProjectName",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("DeliveryAddress",$filter["search"]);
            $builder->orLike("DeliveryCode",$filter["search"]);
            $builder->orLike("username",$filter["search"]);
            $builder->orLike("DeliveryCustName",$filter["search"]);
            $builder->groupEnd();  
            $filterdata = 1;
        }
        
        // Order TAble
        $columns = array(
            0 => null, // kolom action tidak dapat diurutkan
            1 => null, // kolom action tidak dapat diurutkan
            2 => "StoreCode", // kolom name
            3 => "DeliveryCode", // kolom name
            4 => "DeliveryDate", // kolom action tidak dapat diurutkan
            5 => "DeliveryStatus", // kolom image tidak dapat diurutkan
            6 => "DeliveryAdmin", // kolom action tidak dapat diurutkan
            7 => "DeliveryCustName", // kolom action tidak dapat diurutkan
            8 => "DeliveryStaff", // kolom action tidak dapat diurutkan
            9 => "DeliveryTotal", // kolom action tidak dapat diurutkan
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

        $builder->orderby("DeliveryDate","desc");   
        $builder->limit($length,$start); 
        $query = $builder->get();  
        foreach($query->getResult() as $row){
           
  
            // MENGAMBIL DATA STATUS
          $status = "";
            if($row->DeliveryStatus==0){
                $status .= '
                    <button class="bg-info-focus text-primary-600  px-8 py-2 rounded-3 fw-bold text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <span class="me-1 "  data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status"  >New</span>
                    </button> '; 
            }
            if($row->DeliveryStatus==1){
                $status .= '
                    <button class="bg-lilac-100 text-lilac-600 px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <span class="me-1 "  data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status" >Proses</span>
                    </button> '; 
            }
            if($row->DeliveryStatus==2){
                $status .= '
                    <button class="bg-success-focus text-success-main px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <span class="me-1 " data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status"  >Completed</span>
                    </button> ';  
            }
            if($row->DeliveryStatus==3){
                $status .=  '
                    <button class="bg-danger-focus text-danger-main px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"  >
                        <span class="me-1 " data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status"  >Cancel</span>
                    </button> ';  
            }
            $status .= '  
            <ul class="dropdown-menu shadow drop-status ">
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(0,'.$row->DeliveryId.',this)">
                        New
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(1,'.$row->DeliveryId.',this)">
                        </i>Proses
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(2,'.$row->DeliveryId.',this)">
                        Completed
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(3,'.$row->DeliveryId.',this)">
                        Cancel
                    </a>
                </li>  
            </ul>';
                
             
            
            // MENGAMBIL DATA Pembayaran  
            $htmldetail = '      
            <div class="view-detail" style="display:none">
                <div class="list-detail pb-3">
                    <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                        <iconify-icon icon="ix:box-closed" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Detail Produk 
                    </div>  
                    '.$this->get_data_detail_delivery($row->DeliveryId).'
                </div>
                <div class="list-detail pb-3">
                    <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                        <iconify-icon icon="hugeicons:payment-02" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Pembayaran 
                    </div> 
                    '.$this->get_data_payment_delivery($row).'
                </div> 
                <div class="list-detail pb-3">
                    <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                        <iconify-icon icon="hugeicons:progress" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Progress
                    </div>
                    '.$this->get_data_status_delivery($row).'
                    </div>  
                </div>  
            </div>'; 
            // MENGAMBIL DATA Toko 
            $store = '
                    <div class="d-flex align-items-center ">   
                        <span class="text-head-3 d-flex gap-0 align-items-center"><img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">'.$row->StoreCode.'</span> 
                        <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1 text-default '.($row->ProjectId == 0 ? "d-none" : "").'"><i class="fa-solid fa-diagram-project pe-1 "></i>Document Project</span>   
                    </div>';
            $statusdoc = $row->DeliveryStatus == 'pending' ? 'Pending' : ($row->DeliveryStatus == 'approved' ? 'Approved' : 'Rejected');
            $data_row = array( 
                "delivery" => $row, 
                "doc" =>$store.'<div class="text-neutral-400 text-xxs" style="line-height:1">'.$row->DeliveryCode.'</span>',
                "code" => $row->DeliveryCode,
                "date" =>  '<div class="text-head-3" style="line-height:1">'.date_format(date_create($row->DeliveryDate),"d M Y").'</div>', 
                "status" => $status,
                "store" => $store,
                "armada" => $row->DeliveryArmada,
                "ritase" => $row->DeliveryRitase,
                "admin" => ucwords($row->username),  
                "biaya" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->DeliveryTotal,0)."</span></div>", 
                "from" => $row->DeliveryFromName,
                "fromtelp" => ($row->DeliveryFromTelp ? $row->DeliveryFromTelp : ""),
                "fromaddress" => $row->DeliveryFromAddress,
                "customer" => $row->DeliveryToName,
                "customertelp" => ($row->DeliveryToTelp ? $row->DeliveryToTelp : ""),
                "customeraddress" => $row->DeliveryToAddress,
                "note" => $row->DeliveryNote,
                "detail" =>$htmldetail,
                "payment" => $this->get_data_payment_delivery($row,true),  
                "PaymentTotal" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->DeliveryTotal - $this->get_data_payment_delivery($row,true,true),0)."</span></div>", 
                 "action" =>'  
                    <div class="d-flex align-items-center gap-1 justify-content-center">
                        <a onclick="print_delivery('.$row->DeliveryId.',this,\''.$statusdoc .'\')""
                            class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Print Pembelian">
                            <iconify-icon icon="lucide:printer"></iconify-icon>
                        </a>
                        <a onclick="edit_delivery('.$row->DeliveryId.',this,\''.$statusdoc .'\')"
                            class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Ubah Pembelian">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a onclick="delete_delivery('.$row->DeliveryId.',this,\''.$statusdoc .'\')"
                            class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Hapus Pembelian">
                            <iconify-icon icon="lucide:trash-2">
                            </iconify-icon>
                        </a> 
                    </div>  ',
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


    function get_data_delivery($id){
        $builder = $this->db->table("delivery");
        $builder->join('store',"store.StoreId=delivery.StoreId","left"); 
        $builder->join('users',"users.id=delivery.DeliveryAdmin","left");
        $builder->join("template_footer","TemplateId = template_footer.TemplateFooterId","left"); 
        $builder->where('DeliveryId',$id); 
        return $builder->get()->getRow();  
    } 
    function get_data_delivery_detail($id){
        $builder = $this->db->table("delivery_detail");
        $builder->where('DeliveryDetailRef',$id); 
        return $builder->get()->getResult();  
    } 
    function get_data_detail_delivery($id){ 
        $modelsproduk = new ProdukModel();
        $detail = array(); 
        $detailhtml = ' <table class="table detail-item m-0 shadow-7">
                            <thead>
                                <tr>
                                    <th class="detail" style="width: 35px;">#</th>
                                    <th class="detail" colspan="2">Deskripsi</th> 
                                    <th class="detail">Qty</th>
                                    <th class="detail">Spare</th> 
                                </tr>
                            </thead>
                            <tbody>';
        $arr_detail = $this->get_data_delivery_detail($id);
 
        $abjad = 'A';
        $number = '1'; 
        foreach($arr_detail as $row_data){
            $arr_varian = json_decode($row_data->DeliveryDetailVarian);
            $arr_badge = "";
            $arr_no = 0;
            foreach($arr_varian as $varian){
                
                $color = $this->customColor(fmod($arr_no,5));
                $arr_badge .= '<span class="'.$color.' radius-8 px-8 py-4 text-xxs fw-bold">'.$varian->varian.' : '.$varian->value.'</span>';
                $arr_no++; 
            }
            $detail[] = array(
                        "id" => $row_data->ProdukId,  
                        "produkid" => $row_data->ProdukId, 
                        "satuan_id"=> ($row_data->DeliveryDetailSatuanId == 0 ? "" : $row_data->DeliveryDetailSatuanId),
                        "satuan_text"=>$row_data->DeliveryDetailSatuanText,   
                        "varian"=> JSON_DECODE($row_data->DeliveryDetailVarian,true), 
                        "qty"=> $row_data->DeliveryDetailQty,
                        "qty"=> $row_data->DeliveryDetailQtySpare,
                        "text"=> $row_data->DeliveryDetailText,
                        "group"=> $row_data->DeliveryDetailGroup,
                        "type"=> $row_data->DeliveryDetailType,
                        "image_url"=> $modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->DeliveryDetailVarian,true)
                    );
            if($row_data->DeliveryDetailType == "product"){ 
                $detailhtml .= ' <tr>
                <td  class="detail text-center">'.$number.'.</td>
                    <td class="detail" style="width:4rem">
                        <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->DeliveryDetailVarian,true).'" alt="Gambar" class="image-produk w-50-px h-50-px rounded-3">
                    </td>
                    <td class="detail" style="min-width:350px">
                    <div class="d-flex flex-column text-start flex-fill order-md-4 order-3 justify-content-center">
                        <div class="fw-medium">'.$row_data->DeliveryDetailText.'</div>
                        <div class="text-detail-2 text-truncate text-xxs text-neutral-400" style="line-height:1">'.$row_data->DeliveryDetailGroup.'</div> 
                        <div class="d-flex gap-1 flex-wrap pt-4">'.$arr_badge.'</div></div>
                    </td>
                    <td class="detail">'.number_format($row_data->DeliveryDetailQty, 2, ',', '.').' '.$row_data->DeliveryDetailSatuanText.'</td>
                    <td class="detail">'.number_format($row_data->DeliveryDetailQtySpare, 2, ',', '.').' '.$row_data->DeliveryDetailSatuanText.'</td>
                    
                </tr> ';
                $number++;
            }else{
                $number = 1;
                $detailhtml .= ' <tr>
                    <td  class="detail text-center  fw-bold">'.$abjad.'.</td>
                    <td colspan="6" class="detail">
                        <div class="d-flex flex-column text-start flex-fill order-md-4 order-3 justify-content-center">
                            <span class="text-head-3">'.$row_data->DeliveryDetailText.'</span>
                        </div>
                    </td>
                </tr> ';
                $abjad++;
            } 
        };
        $detailhtml .= '
        </tbody> 
        </table>';

        return $detailhtml; 
    } 
    function get_data_detail_delivery_receive($id){ 
        $modelsproduk = new ProdukModel();
        $detail = array(); 
        $detailhtml = ' <table class="table detail-item m-0 w-auto shadow-7">
                            <thead>
                                <tr>
                                    <th class="detail text-center" style="width:50px">Gambar</th>
                                    <th class="detail">Nama</th>
                                    <th class="detail">Qty</th>
                                    <th class="detail">Spare</th> 
                                    <th class="detail">Rusak</th> 
                                </tr>
                            </thead>
                            <tbody>';
        $arr_detail = $this->get_data_delivery_detail($id);
        foreach($arr_detail as $row_data){
            $arr_varian = json_decode($row_data->DeliveryDetailVarian);
            $arr_badge = "";
            $arr_no = 0;
            foreach($arr_varian as $varian){
                $arr_badge .= '<span class="badge badge-sm badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                $arr_no++;
            } 

            $detailhtml .= ' <tr>
                    <td class="detail">
                        <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->DeliveryDetailVarian,true).'" alt="Gambar" class="image-produk">
                    </td>
                    <td class="detail">
                        <span class="text-head-3">'.$row_data->DeliveryDetailText.'</span><br>
                        <span class="text-detail-2 text-truncate">'.$row_data->DeliveryDetailGroup.'</span> 
                        <div class="d-flex gap-1 flex-wrap">'.$arr_badge.'</div>
                    </td>
                    <td class="detail">'.number_format($row_data->DeliveryDetailQtyReceive, 2, ',', '.').' '.$row_data->DeliveryDetailSatuanText.'</td> 
                    <td class="detail">'.number_format($row_data->DeliveryDetailQtyReceiveSpare, 2, ',', '.').$row_data->DeliveryDetailSatuanText.'</td>
                    <td class="detail">'.number_format($row_data->DeliveryDetailQtyReceiveWaste, 2, ',', '.').$row_data->DeliveryDetailSatuanText.'</td>
                </tr> ';
        };
        $detailhtml .= '
        </tbody> 
        </table>';

        return $detailhtml; 
    } 
    
    function get_data_payment_delivery($row,$header = false,$total = false){
        $html_payment = "";
        $html_payment_detail = "";
        $payment_total = 0; 
        if($row->DeliveryTotal == 0){
            $html_payment = '  
            <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                <iconify-icon icon="hugeicons:payment-02" class="text-success text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Tidak ada pembayaran" ></iconify-icon> 
            </button>   
             ';
            $html_payment_detail = '<div class="text-head-3 p-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran untuk transaksi ini  
                </div>';
        }else{
            $html_payment_detail = "";  
            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->join("users","users.id = payment.created_user ","left"); 
            $builder->join("method","MethodId = PaymentMethod ","left"); 
            $builder->where('PaymentRef',$row->DeliveryId); 
            $builder->where('PaymentRefType',"Pengiriman");
            $builder->orderby('PaymentDoc', '1'); 
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult();  
            $payment_total = 0;
            $performa_total = 0; 
            foreach($payment as $row_payment){  
                $bukti = "-";
                $folder_utama = 'assets/images/payment/'.$row_payment->PaymentRefType.'/'.$row_payment->PaymentRef.'/sumber'; 
                //Buat folder berdasarkan id
                if (!file_exists($folder_utama)) {
                    mkdir($folder_utama, 0777, true);  
                }  
                $files = scandir($folder_utama);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        if (strpos($file, $row_payment->PaymentId) === 0) {
                            $filepath = $folder_utama.'/' . $file;
                            $filesize = filesize($folder_utama. '/' . $file); 
                            $filetype = mime_content_type($folder_utama. '/' . $file);
                            $bukti = '  
                                                <button class="radius-8 bg-primary-light text-primary-focus fw-bold text-xxs p-4 text-hover-primary-600" onclick="view_file(this)" data-file="'.base_url().$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'">
                                                <i class="ri-eye-line"></i> Lihat bukti
                                                </button>  '; 
                        }
                    }
                }   
                if($row_payment->PaymentStatus == "0"){ 
                    $statusdoc = 'Delivery';
                    $action = '
                    <div class="d-flex align-items-center gap-1 justify-content-center"> 
                    <a onclick="edit_payment('.$row_payment->PaymentId.',this,\''.$statusdoc .'\')"
                        class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Ubah Payment">
                        <iconify-icon icon="lucide:edit"></iconify-icon>
                    </a>
                    <a onclick="delete_payment('.$row_payment->PaymentId.',this,\''.$statusdoc .'\')"
                        class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Hapus Payment">
                        <iconify-icon icon="lucide:trash-2">
                        </iconify-icon>
                    </a> 
                    </div>
                    ';


                    $transfer_from = '<td class="detail">-</td>'; 
                    $status =  '<span class="bg-warning-focus text-warning-main px-8 py-2 radius-8 fw-medium text-xxs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Approval">Menunggu Approval</span>';   
                    $buktiterima = "-";
                }else{ 
                    $action = '
                    <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak data pembayaran" onclick="print_payment('.$row_payment->PaymentId.',this,\'Survey\')"><i class="fa-solid fa-print"></i></span>';
                    $transfer_from = '<td class="detail">  
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-building-columns" style="width:20px"></i>'.$row_payment->PaymentFromBank.'</div>
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-credit-card" style="width:20px"></i>'.$row_payment->PaymentFromRek.'</div>
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row_payment->PaymentFromName.'</div>
                    </td> ';
                    $status = '<span class="badge text-bg-success me-1 pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Aproved">Aproved by '.$row_payment->PaymentApproved.'</span>';  
                    
                    $buktiterima = "-";
                }  

                if($row_payment->PaymentMethod == "0"){
                    $transfer_to = ' 
                    <td class="detail">  
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row_payment->MethodName.'</div>
                    </td>';
                }else{ 
                    $transfer_to = ' 
                    <td class="detail">  
                        <div class="text-detail-3 pb-1">'.$row_payment->MethodName.'</div> 
                    </td>';
                }

                $payment_total += $row_payment->PaymentTotal; 
                $html_payment_detail .= '
                    <tr>
                        <td class="action-td no-border">'.$action.'</td>
                        <td class="detail"><span class="text-primary-600 fw-bold">'.$row_payment->PaymentCode.'</span></td>
                        <td class="detail">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</td>
                        <td class="detail">'.$status.'</td>  
                        <td class="detail">'.$row_payment->PaymentType.'</td>
                        '. $transfer_to.'
                        <td class="detail">Rp. '.number_format($row_payment->PaymentTotal,0, ',', '.').'</td>
                        <td class="detail">'.$bukti.'</td>  
                    </tr>';
                
            
            }  
            
            if($payment_total == 0){
                $html_payment = '  
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:payment-02" class="text-primary-light text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Belum ada pembayaran" ></iconify-icon> 
                </button>   
                 ';
                $html_payment_detail .= ' 
                <div class="d-inline-block p-8 pe-16 bg-warning-50 radius-8 border-start-width-3-px border-warning-main border-top-0 border-end-0 border-bottom-0 shadow-7" role="alert">
                <span class="text-head-3">
                    <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                    Belum ada pembayaran yang dibuat dari dokumen ini,<a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->DeliveryId.',this,\'Delivery\')">Buat Pembayaran</a> 
                </span>
            </div> '; 
            }else if($payment_total < $row->DeliveryTotal){  
                
                $html_payment = '
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:payment-02" class="text-warning text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Belum Selesai" ></iconify-icon> 
                </button>   ';
                $html_payment_detail = '
                <table class="table detail-payment shadow-7">
                    <thead>
                        <tr>
                            <th class="detail" style="width:70px">Action</th>
                            <th class="detail">No. Pembayaran</th>
                            <th class="detail">Tanggal</th>
                            <th class="detail">Status</th> 
                            <th class="detail">Metode</th>
                            <th class="detail">Sumber</th> 
                            <th class="detail">Total</th>
                            <th class="detail">Bukti</th> 
                        </tr>
                    </thead>
                    <tbody>'.$html_payment_detail.'
                    </tbody>
                </table> 
                <div class="p-8 bg-warning-50 radius-8 border-start-width-3-px border-warning-main border-top-0 border-end-0 border-bottom-0 shadow-7 d-inline" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Masih ada sisa pembayaran yang perlu dibuat dari dokumen ini,  
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->DeliveryId.',this,\'Delivery\')">Buat Pembayaran</a> 
                    </span>
                </div> ';
                
            } else{   
                
                $html_payment = ' 
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:payment-02" class="text-success text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Selesai" ></iconify-icon> 
                </button>   ';
                $html_payment_detail = '
                    <table class="table detail-payment shadow-7">
                        <thead>
                            <tr>
                                <th class="detail" style="width:70px">Action</th>
                                <th class="detail">No. Pembayaran</th>
                                <th class="detail">Tanggal</th>
                                <th class="detail">Status</th> 
                                <th class="detail">Metode</th>
                                <th class="detail">Sumber</th> 
                                <th class="detail">Total</th>
                                <th class="detail">Bukti</th> 
                            </tr>
                        </thead>
                        <tbody>'.$html_payment_detail.'
                        </tbody>
                    </table>';
            } 
        }

        if($total){ 
            return  $payment_total;
        }else{ 
            if($header){
                return  $html_payment;
            }else{
                return  $html_payment_detail;

            }
        } 
    }
 
    function get_data_status_delivery($row,$header = false){
        $html_status = "";
        $html_status_detail = "";
        if($row->DeliveryStatus == 0){
            $html_status = ' 
                     
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                <iconify-icon icon="hugeicons:delivery-truck-01" class="text-primary-light text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Pengiriman dibuat" ></iconify-icon> 
            </button>  ';
            $html_status_detail = ' 
            <ul class="timeline" id="delivery-proses-'.$row->DeliveryId.'">
                <li class="timeline-item">
                    <div class="timeline-date">'.date("l, j F Y", strtotime($row->DeliveryDate)).'</div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Create Document</span><br>
                        <span class="tex-detail-3">Dokument berhasil dibuat oleh '.$row->username.'</span> 
                    </div>
                </li> 
                <li class="timeline-item"> 
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel"> 
                        <span class="badge text-bg-primary">Packing dan Kirim</span><br>
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_proses(\''.$row->DeliveryId.'\',this)">Tambahkan proses packing dan kirim</a>  
                    </div>
                </li> 
            </ul> ';
            
        }else if($row->DeliveryStatus == 1){
            $htmlimage = "";
            $folder_utama = 'assets/images/delivery';  
            $files = glob($folder_utama."/".$row->DeliveryId. '/proses_*');
            foreach ($files as $file) {
              
                if (is_file($file)) {
                    $filepath = $file; 
                    $filetype = mime_content_type($file); 
                    $file_name = basename($file);
                    if (strpos($filetype, 'image/') === 0) {
                        $htmlimage .= '<img onclick="view_file(this)" data-file="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" data-type="'.$filetype.'" data-name="'.$file.'" class="rounded delivery-proses" src="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" />';
                      } elseif (strpos($filetype, 'video/') === 0) {
                        $htmlimage .= '<video onclick="view_file(this)" data-file="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" data-type="'.$filetype.'" data-name="'.$file.'" class="rounded delivery-proses" controls>
                          <source src="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" type="'.$filetype.'">
                          Your browser does not support the video tag.
                        </video>';
                      } 
                }
            }
            $html_status = ' 
            <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
            <iconify-icon icon="hugeicons:delivery-truck-01" class="text-warning text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Packing dan kirim" ></iconify-icon> 
        </button> ';
            $html_status_detail = ' 
            <ul class="timeline" id="delivery-proses-'.$row->DeliveryId.'">
                <li class="timeline-item">
                    <div class="timeline-date">'.date("l, j F Y", strtotime($row->DeliveryDate)).'</div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Create Document</span><br>
                        <span class="tex-detail-3">Dokument berhasil dibuat oleh '.$row->username.'</span> 
                    </div>
                </li> 
                <li class="timeline-item">
                    <div class="timeline-date"><span id="delivery-proses-date-'.$row->DeliveryId.'">'.date("l, j F Y", strtotime($row->DeliveryDateProses)).' </span><a onclick="delivery_proses_edit_date('.$row->DeliveryId.',this)" class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Ubah tanggal packing dan pengiriman" data-date="'.date("Y-m-d", strtotime($row->DeliveryDateProses)).'">
                    <iconify-icon icon="lucide:edit"></iconify-icon>
                </a></div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Packing dan Kirim</span><a onclick="delivery_proses_edit_file('.$row->DeliveryId.',this)" class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Ubah Lampiran packing dan pengiriman">
                        <iconify-icon icon="lucide:edit"></iconify-icon></a>
                        <div class="list-image d-flex gap-1 pt-2">
                        '.$htmlimage.' 
                        </div>
                    </div>
                </li> 
                <li class="timeline-item"> 
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel"> 
                        <span class="badge text-bg-primary">Penerimaan Barang</span><br>
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_finish(\''.$row->DeliveryId.'\',this)">Tambahkan penerimaan barang</a>  
                    </div>
                </li> 
            </ul> ';
        }else{

            $htmlimage = "";
            $folder_utama = 'assets/images/delivery';  
            $files = glob($folder_utama."/".$row->DeliveryId. '/proses_*');
            foreach ($files as $file) {
              
                if (is_file($file)) {
                    $filepath = $file; 
                    $filetype = mime_content_type($file); 
                    $file_name = basename($file);
                    if (strpos($filetype, 'image/') === 0) {
                        $htmlimage .= '<img onclick="view_file(this)" data-file="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" data-type="'.$filetype.'" data-name="'.$file.'" class="rounded delivery-proses" src="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" />';
                      } elseif (strpos($filetype, 'video/') === 0) {
                        $htmlimage .= '<video onclick="view_file(this)" data-file="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" data-type="'.$filetype.'" data-name="'.$file.'" class="rounded delivery-proses" controls>
                          <source src="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" type="'.$filetype.'">
                          Your browser does not support the video tag.
                        </video>';
                      } 
                }
            }
            
            $htmlimagefinish = "";
            $folder_utama = 'assets/images/delivery';  
            $files = glob($folder_utama."/".$row->DeliveryId. '/finish_*');
            foreach ($files as $file) {
              
                if (is_file($file)) {
                    $filepath = $file; 
                    $filetype = mime_content_type($file); 
                    $file_name = basename($file);
                    if (strpos($filetype, 'image/') === 0) {
                        $htmlimagefinish .= '<img onclick="view_file(this)" data-file="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" data-type="'.$filetype.'" data-name="'.$file.'" class="rounded delivery-proses" src="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" />';
                      } elseif (strpos($filetype, 'video/') === 0) {
                        $htmlimagefinish .= '<video onclick="view_file(this)" data-file="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" data-type="'.$filetype.'" data-name="'.$file.'" class="rounded delivery-proses" controls>
                          <source src="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" type="'.$filetype.'">
                          Your browser does not support the video tag.
                        </video>';
                      } 
                }
            }
            $html_status = ' 
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:delivery-truck-01" class="text-success text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Terima Barang" ></iconify-icon> 
                </button>';
            $html_status_detail = ' 
            <ul class="timeline" id="delivery-proses-'.$row->DeliveryId.'">
                <li class="timeline-item">
                    <div class="timeline-date">'.date("l, j F Y", strtotime($row->DeliveryDate)).'</div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Create Document</span><br>
                        <span class="tex-detail-3">Dokument berhasil dibuat oleh '.$row->username.'</span> 
                    </div>
                </li> 
                <li class="timeline-item">
                    <div class="timeline-date"><span id="delivery-proses-date-'.$row->DeliveryId.'">'.date("l, j F Y", strtotime($row->DeliveryDateProses)).' </span><a onclick="delivery_proses_edit_date('.$row->DeliveryId.',this)" class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Ubah tanggal packing dan pengiriman" data-date="'.date("Y-m-d", strtotime($row->DeliveryDateProses)).'">
                    <iconify-icon icon="lucide:edit"></iconify-icon>
                </a></div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Packing dan Kirim</span><a onclick="delivery_proses_edit_file('.$row->DeliveryId.',this)" class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Ubah Lampiran packing dan pengiriman">
                        <iconify-icon icon="lucide:edit"></iconify-icon></a>
                        <div class="list-image d-flex gap-1 pt-2">
                        '.$htmlimage.' 
                        </div>
                    </div>
                </li> 
                <li class="timeline-item">
                
                    <div class="timeline-date"><span id="delivery-finish-date-'.$row->DeliveryId.'">'.date("l, j F Y", strtotime($row->DeliveryDateFinish)).' </span><a onclick="delivery_finish_edit_date('.$row->DeliveryId.',this)" class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Ubah tanggal penerima barang" data-date="'.date("Y-m-d", strtotime($row->DeliveryDateFinish)).'">
                    <iconify-icon icon="lucide:edit"></iconify-icon>
                    </a></div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Penerimaan Barang</span><a onclick="delivery_finish_edit_file('.$row->DeliveryId.',this)" class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Ubah penerimaan barang">
                        <iconify-icon icon="lucide:edit"></iconify-icon></a><br>
                        <span class="tex-detail-3">Dokument diterima oleh '.$row->DeliveryReceiveName.'</span> 
                        <div class="list-image d-flex gap-1 pt-2">
                        '.$htmlimagefinish.' 
                        </div>
                        '.$this->get_data_detail_delivery_receive($row->DeliveryId).'
                    </div>
                </li>  
            </ul> ';
           
        }

        if($header){
            return  $html_status;
        }else{
            return  $html_status_detail;

        }
    }

    function get_data_sum_delivery_item(){
        $builder = $this->db->table("delivery_detail");
    }

    
    function insert_data_delivery($data){ 
        $header = $data["header"]; 
        $next_code = $this->get_next_code_delivery($header["DeliveryDate"]);
        $builder = $this->db->table("delivery");
        $builder->insert(array(
            "DeliveryCode"=>$next_code,
            "DeliveryDate"=>$header["DeliveryDate"], 
            "DeliveryDate2"=>$header["DeliveryDate"],  
            "DeliveryRef"=>$header["DeliveryRef"], 
            "DeliveryRefType"=>$header["DeliveryRefType"], 
            "ProjectId"=>$header["ProjectId"], 
            "StoreId"=>$header["StoreId"], 
            "DeliveryAdmin"=>$header["DeliveryAdmin"],
            "DeliveryArmada"=>$header["DeliveryArmada"],
            "DeliveryRitase"=>$header["DeliveryRitase"],
            "DeliveryTotal"=>$header["DeliveryTotal"],
            "DeliveryToName"=>$header["DeliveryToName"],
            "DeliveryToTelp"=>$header["DeliveryToTelp"],
            "DeliveryToAddress"=>$header["DeliveryToAddress"],
            "DeliveryFromName"=>$header["DeliveryFromName"],
            "DeliveryFromTelp"=>$header["DeliveryFromTelp"],
            "DeliveryFromAddress"=>$header["DeliveryFromAddress"],
            "TemplateId"=>$header["TemplateId"],
            "DeliveryStatus"=>0,
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("delivery");
        $builder->select('*');
        $builder->orderby('DeliveryId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["DeliveryDetailRef"] = $query->DeliveryId;
            $row["DeliveryDetailVarian"] = (isset($row["DeliveryDetailVarian"]) ? json_encode($row["DeliveryDetailVarian"]) : "[]");  
            $builder = $this->db->table("delivery_detail");
            $builder->insert($row); 
        }

        

        // if($header["DeliveryRefType"] == "Sample"){
            
        //     $modelssample = new SampleModel;
        //     $modelssample->update_data_sample_status($header["DeliveryRef"]);
        // }
        // if($header["DeliveryRefType"] == "Invoice"){
        //     $this->update_data_invoice_status($header["DeliveryRef"]);
        // }


        // //update status project
        // $builder = $this->db->table("project"); 
        // $builder->set('ProjectStatus', 7);  
        // $builder->where('ProjectId', $header["ProjectId"]); 
        // $builder->update();  
        
        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Delivery",
                "type"=>"Add",
                "name"=>"Data Delievry ditambahkan dengan nomor ".$next_code,
                "desc"=> json_encode($data ?? []), 
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
            )
        ); 
    } 

    function update_data_delivery($data,$id){ 
        $header = $data["header"]; 

        $builder = $this->db->table("delivery"); 
        $builder->set('DeliveryDate', $header["DeliveryDate"]);  
        $builder->set('DeliveryAdmin', $header["DeliveryAdmin"]);
        $builder->set('DeliveryArmada', $header["DeliveryArmada"]);  
        $builder->set('DeliveryRitase', $header["DeliveryRitase"]);  
        $builder->set('DeliveryTotal', $header["DeliveryTotal"]);   
        $builder->set('DeliveryToName', $header["DeliveryToName"]); 
        $builder->set('DeliveryToTelp', $header["DeliveryToTelp"]); 
        $builder->set('DeliveryToAddress', $header["DeliveryToAddress"]); 
        $builder->set('DeliveryFromName', $header["DeliveryFromName"]); 
        $builder->set('DeliveryFromTelp', $header["DeliveryFromTelp"]); 
        $builder->set('DeliveryFromAddress', $header["DeliveryFromAddress"]); 
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));   
        $builder->where('DeliveryId', $id); 
        $builder->update(); 

        $builder = $this->db->table("delivery_detail");
        $builder->where('DeliveryDetailRef',$id);
        $builder->delete(); 

        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["DeliveryDetailRef"] = $id;
            $row["DeliveryDetailVarian"] = (isset($row["DeliveryDetailVarian"]) ? json_encode($row["DeliveryDetailVarian"]) : "[]");  
            $builder = $this->db->table("delivery_detail");
            $builder->insert($row); 
        } 
    }
    
    function proses_data_delivery($data,$id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryDateProses', $data["DeliveryDateProses"]); 
        $builder->set('DeliveryStatus', 1); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  

        $folder_utama = 'assets/images/delivery'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)){
            mkdir($folder_utama."/".$id, 0777, true);  
        }
        $files = glob($folder_utama."/".$id. '/proses_*');
        foreach ($files as $file) {
            unlink($file);
        } 
        if (isset($data['DeliveryImageList'])) {  
            $no = 0;
            foreach ($data['DeliveryImageList'] as $image) {
                $data_image = simpan_file_base64($image, $folder_utama."/".$id, "proses_".$no); 
                $no++;
            } 
        }
        return JSON_ENCODE(array("status"=>true));
    }
    
    function edit_proses_date_delivery($data,$id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryDateProses', $data["DeliveryDateProses"]);  
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  
 
    }
    
    function edit_proses_data_delivery($data,$id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryDateProses', $data["DeliveryDateProses"]);  
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  

        $folder_utama = 'assets/images/delivery'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)){
            mkdir($folder_utama."/".$id, 0777, true);  
        }
        $files = glob($folder_utama."/".$id. '/proses_*');
        foreach ($files as $file) {
            unlink($file);
        } 
        if (isset($data['DeliveryImageList'])) {   
            $no = 0;
            foreach ($data['DeliveryImageList'] as $image) {
                $data_image = simpan_file_base64($image, $folder_utama."/".$id, "proses_".$no); 
                $no++;
            } 
        }
        return JSON_ENCODE(array("status"=>true));
    }

    function finish_data_delivery($data,$id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryDateFinish', $data["header"]["DeliveryDateFinish"]); 
        $builder->set('DeliveryReceiveName', $data["header"]["DeliveryReceiveName"]); 
        $builder->set('DeliveryStatus', 2); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  

        $folder_utama = 'assets/images/delivery'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)){
            mkdir($folder_utama."/".$id, 0777, true);  
        }
        $files = glob($folder_utama."/".$id. '/finish_*');
        foreach ($files as $file) {
            unlink($file);
        } 
        if (isset($data["header"]['DeliveryImageListFinish'])) {  
            $no = 0;
            foreach ($data["header"]['DeliveryImageListFinish'] as $image) {
                simpan_file_base64($image, $folder_utama."/".$id, "finish_".$no); 
                $no++;
            } 
        } 

        foreach($data["detail"] as $row){  
            $varian = (isset($row["DeliveryDetailVarian"]) ? json_encode($row["DeliveryDetailVarian"]) : "[]");  
            $builder = $this->db->table("delivery_detail"); 
            $builder->set('DeliveryDetailQtyReceive', $row["DeliveryDetailQtyReceive"]); 
            $builder->set('DeliveryDetailQtyReceiveSpare', $row["DeliveryDetailQtyReceiveSpare"]); 
            $builder->set('DeliveryDetailQtyReceiveWaste', $row["DeliveryDetailQtyReceiveWaste"]); 
            $builder->where('ProdukId',$row["ProdukId"]);
            $builder->where('DeliveryDetailVarian',$varian);
            $builder->where('DeliveryDetailRef',$id);
            $builder->update();  
        } 

        return JSON_ENCODE(array("status"=>true));
    }
    function finish_data_delivery_edit($data,$id){
        $builder = $this->db->table("delivery");
        $builder->set('DeliveryDateFinish', $data["header"]["DeliveryDateFinish"]); 
        $builder->set('DeliveryReceiveName', $data["header"]["DeliveryReceiveName"]);  
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));  
        $builder->where('DeliveryId',$id);
        $builder->update();  

        $folder_utama = 'assets/images/delivery'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        //Buat folder berdasarkan id
        if (!file_exists($folder_utama."/".$id)){
            mkdir($folder_utama."/".$id, 0777, true);  
        }
        $files = glob($folder_utama."/".$id. '/finish.*');
        foreach ($files as $file) {
            unlink($file);
        } 
        if (isset($data["header"]['Image'])) {
            $data_image = $this->simpan_gambar_base64($data["header"]['Image'], $folder_utama."/".$id, "finish");  
        } 
        foreach($data["detail"] as $row){  
            $varian = (isset($row["DeliveryDetailVarian"]) ? json_encode($row["DeliveryDetailVarian"]) : "[]");  
            $builder = $this->db->table("delivery_detail"); 
            $builder->set('DeliveryDetailQtyReceive', $row["DeliveryDetailQtyReceive"]); 
            $builder->set('DeliveryDetailQtyReceiveSpare', $row["DeliveryDetailQtyReceiveSpare"]); 
            $builder->set('DeliveryDetailQtyReceiveWaste', $row["DeliveryDetailQtyReceiveWaste"]); 
            $builder->where('ProdukId',$row["ProdukId"]);
            $builder->where('DeliveryDetailVarian',$varian);
            $builder->where('DeliveryDetailRef',$id);
            $builder->update();  
        } 

        return JSON_ENCODE(array("status"=>true));
    } 

    function update_status_delivery($id,$status){
        $dataold = $builder = $this->getWhere(['DeliveryId' => $id], 1)->getRow();

        $builder = $this->db->table("delivery");
        $builder->set('DeliveryStatus', $status);
        $builder->set('updated_user', user()->id);
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));
        $builder->where('DeliveryId', $id);
        $builder->update();

        $statuslist = array(
        0 => "New", // kolom action tidak dapat diurutkan
        1 => "Proses", // kolom action tidak dapat diurutkan
        2 => "Finish", // kolom name
        3 => "Cancel", // kolom name
        );

        //create Log action
        $activityModel = new ActivityModel();
        $activityModel->insert(
        array(
        "menu"=>"Delivery",
        "type"=>"Status",
        "name"=> "Status Data Delivery diubah dari ".$statuslist[$dataold->DeliveryStatus]." menjadi ".$statuslist[$status]
        . " dengan nomor ".$dataold->DeliveryCode,
        "desc"=> json_encode([]),
        "created_user"=>user()->id,
        "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),
        )
        );

        return JSON_ENCODE(array("status"=>true));
    }
}