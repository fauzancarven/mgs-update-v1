<?php

namespace App\Models; 

use CodeIgniter\Model; 
use App\Models\ProdukModel;
class DeliveryModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'activity';
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



    function get_data_delivery_detail($id){
        $builder = $this->db->table("delivery_detail");
        $builder->where('DeliveryDetailRef',$id); 
        return $builder->get()->getResult();  
    } 
    function get_data_detail_delivery($id){ 
        $modelsproduk = new ProdukModel();
        $detail = array(); 
        $detailhtml = ' <table class="table detail-item m-0">
                            <thead>
                                <tr>
                                    <th class="detail text-center" style="width:50px">Gambar</th>
                                    <th class="detail">Nama</th>
                                    <th class="detail">Qty</th>
                                    <th class="detail">Spare</th> 
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

            $detailhtml .= ' <tr>
                    <td class="detail">
                        <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->DeliveryDetailVarian,true).'" alt="Gambar" class="image-produk">
                    </td>
                    <td class="detail">
                        <span class="text-head-3">'.$row_data->DeliveryDetailText.'</span><br>
                        <span class="text-detail-2 text-truncate">'.$row_data->DeliveryDetailGroup.'</span> 
                        <div class="d-flex gap-1 flex-wrap">'.$arr_badge.'</div>
                    </td>
                    <td class="detail">'.number_format($row_data->DeliveryDetailQty, 2, ',', '.').' '.$row_data->DeliveryDetailSatuanText.'</td> 
                    <td class="detail">'.number_format($row_data->DeliveryDetailQtySpare, 2, ',', '.').$row_data->DeliveryDetailSatuanText.'</td>
                </tr> ';
        };
        $detailhtml .= '
        </tbody> 
        </table>';

        return $detailhtml; 
    } 
    function get_data_detail_delivery_receive($id){ 
        $modelsproduk = new ProdukModel();
        $detail = array(); 
        $detailhtml = ' <table class="table detail-item m-0 w-auto">
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
    
    function get_data_payment_delivery($row,$header = false){
        $html_payment = "";
        $html_payment_detail = "";
        if($row->DeliveryTotal == 0){
            $html_payment = ' 
                    <span class="text-head-3 payment">
                        <span class="badge text-bg-success me-1">Tidak ada</span>
                    </span>';
            $html_payment_detail = '<div class="text-head-3 p-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran untuk transaksi ini  
                </div>';
        }else{
            $html_payment_detail = ""; 
            $payment_total = 0; 
            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->join("users","users.id = payment.created_user ","left"); 
            $builder->join("method","MethodId = PaymentMethod ","left"); 
            $builder->where('PaymentRef',$row->DeliveryId); 
            $builder->where('PaymentRefType',"Delivery");
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
                        $filepath = $folder_utama.'/' . $file;
                        $filesize = filesize($folder_utama. '/' . $file); 
                        $filetype = mime_content_type($folder_utama. '/' . $file);
                        $bukti = '  
                                                <a onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'">
                                                    <i class="fa-solid fa-eye"></i> Lihat bukti
                                                </a>  ';
                    }
                }   
                if($row_payment->PaymentStatus == "0"){ 
                    $action = '
                    <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak data pembayaran" onclick="print_payment('.$row_payment->PaymentId.',this,\'Invoice\')"><i class="fa-solid fa-print"></i></span>
                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah data pembayaran" onclick="request_payment_edit('.$row_payment->PaymentId.',this,\'Invoice\')"><i class="fa-solid fa-pen-to-square"></i></span>
                    <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan data pembayaran" onclick="request_payment_delete('.$row_payment->PaymentId.',this,\'Invoice\')"><i class="fa-solid fa-circle-xmark"></i></span>';
                    $transfer_from = '<td class="detail">-</td>';
                    $status =  '<span class="badge text-bg-info me-1 pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Approval">Menunggu Approval</span>';  
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
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-building-columns" style="width:20px"></i>'.$row_payment->MethodRekBank.'</div>
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-credit-card" style="width:20px"></i>'.$row_payment->MethodRekNumber.'</div>
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row_payment->MethodRekName.'</div>
                    </td>';
                }

                $payment_total += $row_payment->PaymentTotal; 
                $html_payment_detail .= '
                    <tr>
                        <td class="action-td no-border">'.$action.'</td>
                        <td class="detail">'.$row_payment->PaymentCode.'</td>
                        <td class="detail">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</td>
                        <td class="detail">'.$status.'</td>  
                        <td class="detail">'.$row_payment->PaymentType.'</td>
                        '. $transfer_to.'
                        <td class="detail">Rp. '.number_format($row_payment->PaymentTotal,0, ',', '.').'</td>
                        <td class="detail">'.$bukti.'</td> 
                        <td class="detail">'.$buktiterima.'</td> 
                    </tr>';
                
            
            }  
            
            if($payment_total == 0){
                $html_payment = ' 
                        <span class="text-head-3 payment">
                            <span class="badge text-bg-warning me-1">Belum Ada</span>
                        </span>';
                $html_payment_detail .= ' <div class="d-inline-block alert alert-warning p-2 m-0" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Belum ada pembayaran yang dibuat dari dokumen ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="payment_request('.$row->DeliveryId.',this,\'Delivery\')">Ajukan Pembayaran</a> 
                    </span>
                </div> '; 
            }else if($payment_total < $row->DeliveryTotal){  
                
                $html_payment = ' 
                        <span class="text-head-3 payment">
                            <span class="badge text-bg-warning me-1">Belum Selesai</span>
                        </span>';
                $html_payment_detail = '
                <table class="table detail-payment">
                    <thead>
                        <tr>
                            <th class="detail" style="width:70px">Action</th>
                            <th class="detail">No. Pembayaran</th>
                            <th class="detail">Tanggal</th>
                            <th class="detail">Status</th> 
                            <th class="detail">Metode</th>
                            <th class="detail">Tujuan</th> 
                            <th class="detail">Total</th>
                            <th class="detail">Bukti Sumber</th>
                            <th class="detail">Bukti Masuk</th>
                        </tr>
                    </thead>
                    <tbody>'.$html_payment_detail.'
                    </tbody>
                </table> 
                <div class="alert alert-warning p-2 m-0" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Masih ada sisa pembayaran yang perlu dibuat dari dokumen ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->DeliveryId.',this,\'Survey\')">Ajukan pembayaran</a> 
                    </span>
                </div> ';
            } else{   
                
                $html_payment = ' 
                        <span class="text-head-3 payment">
                            <span class="badge text-bg-success me-1">Selesai</span>
                        </span>';
                $html_payment_detail = '
                    <table class="table detail-payment">
                        <thead>
                            <tr>
                                <th class="detail" style="width:70px">Action</th>
                                <th class="detail">No. Pembayaran</th>
                                <th class="detail">Tanggal</th>
                                <th class="detail">Status</th> 
                                <th class="detail">Metode</th>
                                <th class="detail">Tujuan</th> 
                                <th class="detail">Total</th>
                                <th class="detail">Bukti Sumber</th>
                                <th class="detail">Bukti Masuk</th>
                            </tr>
                        </thead>
                        <tbody>'.$html_payment_detail.'
                        </tbody>
                    </table>';
            } 
        }

        if($header){
            return  $html_payment;
        }else{
            return  $html_payment_detail;

        }
    }
 
    function get_data_status_delivery($row,$header = false){
        $html_status = "";
        $html_status_detail = "";
        if($row->DeliveryStatus == 0){
            $html_status = ' 
                    <span class="text-head-3 payment">
                        <span class="badge text-bg-success me-1">Tidak ada</span>
                    </span>';
            $html_status_detail = ' 
            <ul class="timeline">
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
                    $htmlimage .=  '<img onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'" class="rounded delivery-proses" src="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" />';
                }
            }
            $html_status = ' 
                    <span class="text-head-3 payment">
                        <span class="badge text-bg-success me-1">Tidak ada</span>
                    </span>';
            $html_status_detail = ' 
            <ul class="timeline">
                <li class="timeline-item">
                    <div class="timeline-date">'.date("l, j F Y", strtotime($row->DeliveryDate)).'</div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Create Document</span><br>
                        <span class="tex-detail-3">Dokument berhasil dibuat oleh '.$row->username.'</span> 
                    </div>
                </li> 
                <li class="timeline-item">
                    <div class="timeline-date">'.date("l, j F Y", strtotime($row->DeliveryDateProses)).'</div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Packing dan Kirim</span><br>
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
                    $htmlimage .=  '<img onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'" class="rounded delivery-proses" src="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" />';
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
                    $htmlimagefinish .=  '<img onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'" class="rounded delivery-proses" src="'.base_url() . $folder_utama."/".$row->DeliveryId. '/' . $file_name . '" />';
                }
            }
            $html_status = ' 
                    <span class="text-head-3 payment">
                        <span class="badge text-bg-success me-1">Tidak ada</span>
                    </span>';
            $html_status_detail = ' 
            <ul class="timeline">
                <li class="timeline-item">
                    <div class="timeline-date">'.date("l, j F Y", strtotime($row->DeliveryDate)).'</div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Create Document</span><br>
                        <span class="tex-detail-3">Dokument berhasil dibuat oleh '.$row->username.'</span> 
                    </div>
                </li> 
                <li class="timeline-item">
                    <div class="timeline-date">'.date("l, j F Y", strtotime($row->DeliveryDateProses)).'</div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Packing dan Kirim</span><br>
                        <div class="list-image d-flex gap-1 pt-2">
                        '.$htmlimage.' 
                        </div>
                    </div>
                </li> 
                <li class="timeline-item">
                    <div class="timeline-date">'.date("l, j F Y", strtotime($row->DeliveryDateFinish)).'</div>
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <span class="badge text-bg-success">Penerimaan Barang</span><br>
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


 
}