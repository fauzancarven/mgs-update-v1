<?php

namespace App\Models; 

use CodeIgniter\Model;  
use CodeIgniter\Database\RawSql;
use App\Models\ProjectModel; 
use App\Models\ProdukModel; 

class ProjectsampleModel extends Model
{  
    protected $DBGroup = 'default';
    protected $table = 'sample'; 

    public function load_datatable_project_sample($filter = null){ 
        $modelsproduk = new ProdukModel();
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();

        $builder = $this->db->table($this->table);
        $builder->join("project","project.ProjectId = sample.ProjectId ","left");   
        $builder->join("store","store.StoreId = project.StoreId","left");  
        $builder->join("users","users.id = sample.SampleAdmin ","left");  

        if($filter["datestart"]){
            $builder->where("SampleDate >=",$filter["datestart"]);
            $builder->where("SampleDate <=",$filter["dateend"]); 
        }
         
        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();

        if(isset($filter["filter"])){ 
            $builder->whereIn("SampleStatus",$filter["filter"]); 
            $filterdata = 1;
        } 
        if(isset($filter["store"])){ 
            $builder->whereIn("sample.StoreId",$filter["store"]); 
            $filterdata = 1;
        } 
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("username",$filter["search"]); 
            $builder->orLike("SampleCustName",$filter["search"]);
            $builder->orLike("SampleCustTelp",$filter["search"]);
            $builder->orLike("SampleAddress",$filter["search"]);
            $builder->orLike("SampleCode",$filter["search"]);
            $builder->groupEnd();  
            $filterdata = 1;
        }

        // Order TAble
        $columns = array(
            0 => null, // kolom action tidak dapat diurutkan
            1 => null, // kolom action tidak dapat diurutkan
            2 => "StoreCode", // kolom name
            3 => "SampleCode", // kolom name
            4 => "SampleDate", // kolom action tidak dapat diurutkan
            5 => "SampleStatus", // kolom image tidak dapat diurutkan
            6 => "SampleAdmin", // kolom action tidak dapat diurutkan
            7 => "SampleCustName", // kolom action tidak dapat diurutkan
            8 => null, // kolom action tidak dapat diurutkan
            9 => null, // kolom action tidak dapat diurutkan
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

        
        $builder->limit($length,$start); 
        $query = $builder->get();  
        foreach($query->getResult() as $row){  
            $status = "";
            if($row->SampleStatus==0){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-primary text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >New</span>
                    </span> '; 
            }
            if($row->SampleStatus==1){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-info text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Proses</span>
                    </span> '; 
            }
            if($row->SampleStatus==2){
                $status .= '
                    <span class=" pointertext-head-3 badge text-bg-success text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Completed</span>
                    </span> ';  
            }
            if($row->SampleStatus==3){
                $status .=  '
                    <span class="pointer text-head-3 badge text-bg-danger text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Cancel</span>
                    </span> ';  
            }
            $status .= '  
            <ul class="dropdown-menu shadow drop-status ">
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(0,'.$row->SampleId.',this)">
                        New
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(1,'.$row->SampleId.',this)">
                        </i>Proses
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(2,'.$row->SampleId.',this)">
                        Completed
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(3,'.$row->SampleId.',this)">
                        Cancel
                    </a>
                </li>  
            </ul>';
                
            // MENGAMBIL DATA Detail  
            $htmldetail = '      
            <div class="view-detail" style="display:none">
                <div class="list-detail pb-3">
                    <div class="text-head-2 py-2">
                        <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Detail Produk</span>
                    </div> 
                    '.$this->get_data_detail_sample($row).'
                </div> 
                <div class="list-detail pb-3">
                    <div class="text-head-2 py-2">
                        <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Pembayaran</span>
                    </div> 
                    '.$this->get_data_payment_sample($row).'
                </div> 
                <div class="list-detail pb-3">
                    <div class="text-head-2 py-2">
                        <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Pengiriman</span>
                    </div> 
                    '.$this->get_data_delivery_sample($row).'
                </div> 
            </div>';
            // MENGAMBIL DATA Toko 
            $store = '
                    <div class="d-flex align-items-center ">  
                        <div class="flex-grow-1 ms-1">
                            <div class="d-flex flex-column"> 
                                <span class="text-head-3 d-flex gap-0 align-items-center"><img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">'.$row->StoreCode.'</span>
                                <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1">'.$row->StoreName.'</span>  
                                <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1 text-default '.($row->ProjectId == 0 ? "d-none" : "").'"><i class="fa-solid fa-diagram-project pe-1 "></i>Document Project</span>  
                            </div>   
                        </div>
                    </div>';

            $data_row = array( 
                "sample" => $row,
                "code" => $row->SampleCode.$this->get_data_forward_sample($row->SampleRefType,$row->SampleRef).$this->get_data_return_sample($row->SampleId,$row->ProjectId,$row->SampleStatus),
                "date" => date_format(date_create($row->SampleDate),"d M Y"),
                "status" => $status,
                "store" => $store,
                "admin" => ucwords($row->username), 
                "customer" => $row->SampleCustName, 
                "customertelp" => ($row->SampleCustTelp ? $row->SampleCustTelp : ""), 
                "customeraddress" => $row->SampleAddress, 
                "detail" => $htmldetail,
                "payment" => $this->get_data_payment_sample_status($row),
                "delivery" => $this->get_data_delivery_sample_status($row),
                "action" =>'  
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Data Sampel Barang" onclick="print_project_Sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Sampel Barang" onclick="edit_project_Sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Sampel Barang" onclick="delete_project_Sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-circle-xmark"></i></span>
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

    function get_data_forward_sample($type = 0,$ref = 0){ 
 
            if($type == "Survey"){
                $builder = $this->db->table("survey");
                $builder->where('SurveyId',$ref); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    return ' <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari survey">
                                <i class="fa-solid fa-street-view text-success"></i>
                                <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="sample_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SurveyId.'\',\'Penawaran\')">'.$queryref->SurveyCode.'</a>
                            </div>';  
                }
            } 
            if($type == "Penawaran"){
                $builder = $this->db->table("penawaran");
                $builder->where('SphId',$ref); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    return ' <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari penawaran">
                                <i class="fa-solid fa-hand-holding-droplet text-success"></i>
                                <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="sample_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SphId.'\',\'Penawaran\')">'.$queryref->SphCode.'</a>
                            </div>'; 
                }
            } 
            return '';
            
    }
    function get_data_return_sample($id,$project = 0,$status = 0){ 
        //check penawaran
        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->where('SphRef',$id); 
        $builder->where('SphRefType',"Sample");  
        $builder->orderBy('SphId', 'DESC'); 
        $queryref = $builder->get()->getRow();  
        if($queryref){
            return '  
                    <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data diteruskan ke penawaran">
                        <i class="fa-solid fa-share-from-square text-success"></i>
                        <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="survey_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SphId.'\',\'Penawaran\')">'.$queryref->SphCode.'</a>
                    </div> 
                '; 
        }else{   
            // INVOICE
            $builder = $this->db->table("invoice");
            $builder->select('*');
            $builder->where('InvRef',$id); 
            $builder->where('InvRefType',"Sample");  
            $builder->orderby('SurveyId', 'DESC'); 
            $queryref = $builder->get()->getRow();   
            if($queryref){
                return '   
                    <div class="text-head-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data diteruskan ke invoice">
                        <i class="fa-solid fa-share-from-square text-success"></i>
                        <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="survey_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->InvId.'\',\'Invoice\')">'.$queryref->InvCode.'</a>
                    </div> 
                ';
            }else{ 
                if($status == 3){
                    return ' 
                    <div class="text-detail-3 pt-2">
                        <i class="fa-solid fa-share-from-square"></i> 
                        <span class="text-detail-3 text-decoration-none">Data tidak diteruskan</span> 
                    </div>';  
                }else{ 
                    return ' 
                    <div class="text-detail-3 pt-2">
                        <i class="fa-solid fa-share-from-square text-primary"></i> 
                        <a class="text-detail-3 pointer text-decoration-underline text-primary" data-bs-toggle="dropdown" aria-expanded="false">Teruskan data</a>
                        <ul class="dropdown-menu shadow drop-status "  data-bs-toggle="tooltip" data-bs-title="teruskan data" > 
                            <li>
                                <a class="text-detail-3 dropdown-item m-0 px-2" onclick="survey_return_add_click(\''.$project.'\',this,\''.$id.'\',\'Penawaran\')">Penawaran</a>
                            </li> 
                            <li>
                                <a class="text-detail-3 dropdown-item m-0 px-2" onclick="survey_return_add_click(\''.$project.'\',this,\''.$id.'\',\'Invoice\')">Invoice</a>
                            </li>  
                        </ul> 
                    </div>';  
                }
            } 
        }  
    }
    function get_data_detail_sample($row){ 
        $modelsproduk = new ProdukModel();
        $detail = array(); 
        $detailhtml = ' <table class="table detail-item m-0">
                            <thead>
                                <tr>
                                    <th class="detail text-center" style="width:50px">Gambar</th>
                                    <th class="detail">Nama</th>
                                    <th class="detail">Qty</th>
                                    <th class="detail">Harga</th>
                                    <th class="detail">Disc</th>
                                    <th class="detail">Total</th>
                                </tr>
                            </thead>
                            <tbody>';
        $arr_detail = $this->get_data_sample_detail($row->SampleId);
        foreach($arr_detail as $row_data){
            $arr_varian = json_decode($row_data->SampleDetailVarian);
            $arr_badge = "";
            $arr_no = 0;
            foreach($arr_varian as $varian){
                $arr_badge .= '<span class="badge badge-sm badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                $arr_no++;
            }
            $detail[] = array(
                        "id" => $row_data->ProdukId,  
                        "produkid" => $row_data->ProdukId, 
                        "satuan_id"=> ($row_data->SampleDetailSatuanId == 0 ? "" : $row_data->SampleDetailSatuanId),
                        "satuan_text"=>$row_data->SampleDetailSatuanText,  
                        "price"=>$row_data->SampleDetailPrice,
                        "varian"=> JSON_DECODE($row_data->SampleDetailVarian,true),
                        "total"=> $row_data->SampleDetailTotal,
                        "disc"=> $row_data->SampleDetailDisc,
                        "qty"=> $row_data->SampleDetailQty,
                        "text"=> $row_data->SampleDetailText,
                        "group"=> $row_data->SampleDetailGroup,
                        "type"=> $row_data->SampleDetailType,
                        "image_url"=> $modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->SampleDetailVarian,true)
                    );

            $detailhtml .= ' <tr>
                    <td class="detail">
                        <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->SampleDetailVarian,true).'" alt="Gambar" class="image-produk">
                    </td>
                    <td class="detail">
                        <span class="text-head-3">'.$row_data->SampleDetailText.'</span><br>
                        <span class="text-detail-2 text-truncate">'.$row_data->SampleDetailGroup.'</span> 
                        <div class="d-flex gap-1 flex-wrap">'.$arr_badge.'</div>
                    </td>
                    <td class="detail">'.number_format($row_data->SampleDetailQty, 2, ',', '.').' '.$row_data->SampleDetailSatuanText.'</td>
                    <td class="detail">Rp. '.number_format($row_data->SampleDetailPrice, 0, ',', '.').'</td>
                    <td class="detail">Rp. '.number_format($row_data->SampleDetailDisc, 0, ',', '.').'</td>
                    <td class="detail">Rp. '.number_format($row_data->SampleDetailTotal, 0, ',', '.').'</td>
                </tr> ';
        };
        $detailhtml .= '
        </tbody>
        <tfoot>
            <tr>
                <th class="bg-light" colspan="6">
                    <div class="d-flex m-1 gap-2 align-items-center justify-content-end pe-4"> 
                        <span class="text-detail-2">Sub Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->SampleSubTotal,0,',','.').'</span>  
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Disc Item:</span>
                        <span class="text-head-2">Rp. '.number_format($row->SampleDiscItemTotal,0,',','.').'</span>   
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Disc Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->SampleDiscTotal,0,',','.').'</span>   
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Pengiriman:</span>
                        <span class="text-head-2">Rp. '.number_format($row->SampleDeliveryTotal,0,',','.').'</span> 
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Grand Total:</span>
                        <span class="text-head-2">Rp.'.number_format($row->SampleGrandTotal,0,',','.').'</span> 
                    </div>
                </th>
            </tr> 
        </tfoot>
        </table>';

        return $detailhtml;

    } 
    function get_data_payment_sample($row){ 
        $html_payment = ""; 
        $payment_total = 0;
        if($row->SampleGrandTotal == 0){
            $html_payment = ' 
            <div class="fw-normal row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">  
                <div class="col bg-light py-2">  
                    <div class="text-head-3">
                        <i class="fa-solid fa-check text-success me-2" style="font-size:0.75rem"></i>
                        Tidak ada pembayaran yang harus diselesaikan untuk transaksi ini 
                    </div>
                </div>
            </div>';
        }else{
            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->join("users","users.id = payment.created_user ","left"); 
            $builder->where('PaymentRef',$row->SampleId); 
            $builder->where('PaymentRefType',"Survey");
            $builder->orderby('PaymentDoc', '1'); 
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult();  
            $payment_total = 0;
            $performa_total = 0; 
            foreach($payment as $row_payment){  
                if($row_payment->PaymentStatus == "0"){ 
                    $action = '
                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah data pembayaran" onclick="request_payment_edit('.$row_payment->PaymentId.',this,\'Survey\')"><i class="fa-solid fa-pen-to-square"></i></span>
                    <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan data pembayaran" onclick="request_payment_delete('.$row_payment->PaymentId.',this,\'Survey\')"><i class="fa-solid fa-circle-xmark"></i></span>';
                    $transfer_from = '<td class="detail">-</td>';
                    $status =  '<span class="badge text-bg-info me-1 pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Approval">Request by '.ucwords($row_payment->username).'</span>'; 
                    $bukti = '';
                }else{ 
                    $action = '
                    <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak data pembayaran" onclick="print_payment('.$row_payment->PaymentId.',this,\'Survey\')"><i class="fa-solid fa-print"></i></span>';
                    $transfer_from = '<td class="detail">  
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-building-columns" style="width:20px"></i>'.$row_payment->PaymentFromBank.'</div>
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-credit-card" style="width:20px"></i>'.$row_payment->PaymentFromRek.'</div>
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row_payment->PaymentFromName.'</div>
                    </td> ';
                    $status = '<span class="badge text-bg-success me-1 pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Aproved">Aproved by '.$row_payment->PaymentApproved.'</span>'; 

                    $folder_utama = 'assets/images/payment'; 
                    //Buat folder berdasarkan id
                    if (!file_exists($folder_utama."/".$row_payment->PaymentId)) {
                        mkdir($folder_utama."/".$row_payment->PaymentId, 0777, true);  
                    } 
                    $files = scandir($folder_utama."/".$row_payment->PaymentId);
                    foreach ($files as $file) {
                        if ($file != '.' && $file != '..') {
                            $filepath = $folder_utama."/".$row_payment->PaymentId . '/' . $file;
                            $filesize = filesize($folder_utama."/".$row_payment->PaymentId . '/' . $file); 
                            $filetype = mime_content_type($folder_utama."/".$row_payment->PaymentId . '/' . $file);
                            $bukti = '  
                                                    <a onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'">
                                                        <i class="fa-solid fa-eye"></i> Lihat bukti
                                                    </a>  ';
                        }
                    }   
                }  

                if($row_payment->PaymentMethod == "Cash"){
                    $transfer_to = ' 
                    <td class="detail">  
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row_payment->PaymentToName.'</div>
                    </td>';
                }else{ 
                    $transfer_to = ' 
                    <td class="detail">  
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-building-columns" style="width:20px"></i>'.$row_payment->PaymentToBank.'</div>
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-credit-card" style="width:20px"></i>'.$row_payment->PaymentToRek.'</div>
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row_payment->PaymentToName.'</div>
                    </td>';
                }
                $payment_total += $row_payment->PaymentTotal; 
                $html_payment .= '
                    <tr>
                        <td class="action-td no-border">'.$action.'</td>
                        <td class="detail">'.$row_payment->PaymentCode.'</td>
                        <td class="detail">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</td>
                        <td class="detail">'.$status.'</td>  
                        <td class="detail">'.$row_payment->PaymentMethod.'</td>
                       '. $transfer_to.'
                       '. $transfer_from.' 
                        <td class="detail">'.$bukti.'</td> 
                        <td class="detail">Rp. '.number_format($row_payment->PaymentTotal,0, ',', '.').'</td>
                    </tr>';
                 
            
            }  
             
            if($payment_total == 0){
                $html_payment .= ' <div class="alert alert-warning p-2 m-0" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Belum ada pembayaran yang dibuat dari dokumen ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->SampleId.',this,\'Survey\')">Ajukan pembayaran</a> 
                    </span>
                </div> '; 
            }else if($payment_total < $row->SampleGrandTotal){  
                $html_payment = '
                <table class="table detail-payment">
                    <thead>
                        <tr>
                            <th class="detail" style="width:70px">Action</th>
                            <th class="detail">No. Pembayaran</th>
                            <th class="detail">Tanggal</th>
                            <th class="detail">Status</th> 
                            <th class="detail">Metode</th>
                            <th class="detail">Tujuan</th> 
                            <th class="detail">Sumber</th>
                            <th class="detail">Bukti Transaksi</th>
                            <th class="detail">Total</th>
                        </tr>
                    </thead>
                    <tbody>'.$html_payment.'
                    </tbody>
                </table> 
                <div class="alert alert-warning p-2 m-0" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Masih ada sisa pembayaran yang perlu dibuat dari dokumen ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->SampleId.',this,\'Survey\')">Ajukan pembayaran</a> 
                    </span>
                </div> ';
            } else{   
                $html_payment = '
                    <table class="table detail-payment">
                        <thead>
                            <tr>
                                <th class="detail" style="width:70px">Action</th>
                                <th class="detail">No. Pembayaran</th>
                                <th class="detail">Tanggal</th>
                                <th class="detail">Status</th> 
                                <th class="detail">Metode</th>
                                <th class="detail">Tujuan</th> 
                                <th class="detail">Sumber</th>
                                <th class="detail">Bukti Transaksi</th>
                                <th class="detail">Total</th>
                            </tr>
                        </thead>
                        <tbody>'.$html_payment.'
                        </tbody>
                    </table>';
            }
        } 
        $html_payment_sample = '<table class="table detail-payment">
                <thead>
                    <tr>
                        <th class="detail" style="width:70px">Action</th>
                        <th class="detail">No. Pembayaran</th>
                        <th class="detail">Tanggal</th>
                        <th class="detail">Status</th> 
                        <th class="detail">Metode</th>
                        <th class="detail">Tujuan</th> 
                        <th class="detail">Sumber</th>
                        <th class="detail">Bukti Transaksi</th>
                        <th class="detail">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="action-td no-border">  
                            <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="print_project_Survey(5,this,\'\')"><i class="fa-solid fa-print"></i></span>  
                            <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="edit_project_Survey(5,this,\'\')"><i class="fa-solid fa-pen-to-square"></i></span>
                            <div class="d-inline ">
                                <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Penawaran" onclick="delete_project_Survey(5,this,\'\')"><i class="fa-solid fa-circle-xmark"></i></span>
                            </div>
                        </td>
                        <td class="detail">PAY/016/05/2025</td>
                        <td class="detail">28 May 2025</td>
                        <td class="detail">Pelunasan</td>
                        <td class="detail"><span class="badge text-bg-success me-1 pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Update Status">Aproved by Syahrul Fauzan</span></td> 
                        <td class="detail"> 
                            <div class="text-head-3 pb-2">TRANSFER BCA</div>  
                            <div class="text-detail-3 pb-1"><i class="fa-solid fa-building-columns" style="width:20px"></i>BCA</div>
                            <div class="text-detail-3 pb-1"><i class="fa-solid fa-credit-card" style="width:20px"></i>123456789</div>
                            <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>Syahrul Fauzan</div>
                        </td> 
                        <td class="detail"> 
                            <div class="text-head-3 pb-2">BCA CV 1</div>   
                            <div class="text-detail-3 pb-1"><i class="fa-solid fa-building-columns" style="width:20px"></i>BCA</div>
                            <div class="text-detail-3 pb-1"><i class="fa-solid fa-credit-card" style="width:20px"></i>123456789</div>
                            <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>Mahiera Global Solution</div>
                        </td> 
                        <td class="detail">Lihat bukti</td> 
                        <td class="detail">Rp. 275.000</td>
                    </tr>
                    <tr>
                        <td class="action-td no-border">  
                            <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="print_project_Survey(5,this,\'\')"><i class="fa-solid fa-print"></i></span>  
                            <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="edit_project_Survey(5,this,\'\')"><i class="fa-solid fa-pen-to-square"></i></span>
                            <div class="d-inline ">
                                <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Penawaran" onclick="delete_project_Survey(5,this,\'\')"><i class="fa-solid fa-circle-xmark"></i></span>
                            </div>
                        </td>
                        <td class="detail">PAY/016/05/2025</td>
                        <td class="detail">28 May 2025</td>
                        <td class="detail">Pelunasan</td>
                        <td class="detail"><span class="badge text-bg-info me-1 pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Update Status">Request By Nesa Saputra</span></td> 
                        <td class="detail"> 
                            <div class="text-head-3 pb-2">TRANSFER BCA</div>  
                            <div class="text-detail-3 pb-1"><i class="fa-solid fa-building-columns" style="width:20px"></i>BCA</div>
                            <div class="text-detail-3 pb-1"><i class="fa-solid fa-credit-card" style="width:20px"></i>123456789</div>
                            <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>Syahrul Fauzan</div>
                        </td> 
                        <td class="detail">-</td>
                        <td class="detail">-</td> 
                        <td class="detail">Rp. 275.000
                        </td>
                    </tr>
                </tbody>
            </table>';
        return $html_payment;
    }
    function get_data_payment_sample_status($row){
        $payment = ''; 
        if($row->SampleGrandTotal == 0){
            $payment = ' 
                <span class="text-head-3 pointer payment">
                    <span class="badge text-bg-success me-1">Tidak ada</span>
                </span> '; 
        }else{
            $builder = $this->db->table("payment");
            $builder->selectSum('PaymentTotal'); 
            $builder->where('PaymentRef',$row->SampleId);
            $builder->where('PaymentRefType',"Survey");
            $builder->where('PaymentStatus <',2);
            $paymentTotal = $builder->get()->getRow()->PaymentTotal;
            if($paymentTotal > 0){ 
                $payment = ' 
                <span class="text-head-3 pointer payment">
                    <span class="badge text-bg-info me-1">Belum Lengkap</span>
                </span> '; 
            }else  if($paymentTotal >= $row->SampleGrandTotal){ 
                $payment = ' 
                <span class="text-head-3 pointer payment">
                    <span class="badge text-bg-success me-1">Completed</span>
                </span> '; 
            }else{
                $payment = ' 
                <span class="text-head-3 pointer payment">
                    <span class="badge text-bg-danger me-1">Belum ada</span>
                </span> '; 
            }

        }
        return $payment;
    }
    function get_data_delivery_sample($row){
        if($row->SampleDelivery == 0){ 
            return '
            <div class="fw-normal row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">  
                <div class="col bg-light py-2">  
                    <div class="text-head-3">
                        <i class="fa-solid fa-check text-success me-2" style="font-size:0.75rem"></i>
                        Mode pengriman tidak diaktifkan untuk transaksi ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="invoice_project_update_delivery('.$row->SampleId.',this,1,\''.$row->ProjectId.'\')">aktifkan mode pengiriman</a>
                    </div>
                </div>
            </div>';
        }else{
            $builder = $this->db->table("delivery");  
            $builder->where('DeliveryRef',$row->SampleId);
            $builder->where('DeliveryRefType',"Survey");
            $builder->where('DeliveryStatus <',2); 
            return ' <table class="table detail-payment">
            <thead>
                <tr>
                    <th class="detail" style="width:30px"></th>
                    <th class="detail" style="width:70px">Action</th>
                    <th class="detail">Toko</th>
                    <th class="detail">Nomor</th>
                    <th class="detail">Tanggal</th> 
                    <th class="detail">Ritase</th>
                    <th class="detail">Armada</th>
                    <th class="detail">Dari</th> 
                    <th class="detail">Tujuan</th> 
                    <th class="detail">Biaya</th>
                </tr>
            </thead>
            <tbody> 
                <tr class="dt-hasChild">
                    <td class="detail ">
                        <a class="pointer text-head-3 btn-detail-item"><i class="fa-solid fa-chevron-right fa-rotate-90"></i></a>
                    </td> 
                    <td class="detail action-td" style="width:70px"> 
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Data Sampel Barang" onclick="print_project_Sample(114,3,this)"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Sampel Barang" onclick="edit_project_Sample(114,3,this)"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Sampel Barang" onclick="delete_project_Sample(114,3,this)"><i class="fa-solid fa-circle-xmark"></i></span>
                        </div>
                    </td> 
                    <td class="detail" style="width:125px"> 
                        <div class="d-flex align-items-center ">  
                            <div class="flex-grow-1 ms-1">
                                <div class="d-flex flex-column"> 
                                    <span class="text-head-3 d-flex gap-0 align-items-center"><img src="data:image/png;base64,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" alt="Gambar" class="logo">MGS</span>
                                    <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1">Mahiera Global Solution</span>  
                                    <span class="pointer text-head-3 pt-1">
                                        <span class="me-1 badge text-bg-info text-head-3">Proses</span>
                                    </span>
                                </div>   
                            </div>
                        </div>
                    </td>
                    <td class="detail" style="width:125px"> 
                        SPL/001/02/2025 
                        <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari penawaran">
                            <i class="fa-solid fa-hand-holding-droplet text-success"></i>
                            <a class="text-detail-3 pointer text-decoration-underline text-success">SPH/001/02/2025</a>
                        </div>  
                    </td>
                    <td class="detail">21 Feb 2025</td>  
                    <td class="detail">1 (Satu)</td> 
                    <td class="detail">B 1605 SSS LALAMOVE</td> 
                    <td class="detail"> 
                        <div class="text-head-3 pb-2">Vendor BBG</div> 
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-phone pe-1"></i>1231456456</div>
                        <div class="text-detail-3 text-truncate" style="max-width: 10rem;line-height: 1.2;" data-bs-toggle="tooltip" data-bs-title="Cimone Mas Permai 1, Jl. Kalimantan No.40, Cimone Jaya, Kota Tangerang, Banten 15114"><i class="fa-solid fa-location-dot pe-1"></i>Citeko, Purwakarta</div>
                    </td>
                    <td class="detail"> 
                        <div class="text-head-3 pb-2">Bpk Hartanto</div> 
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-phone pe-1"></i>1231456456</div>
                        <div class="text-detail-3 text-truncate" style="max-width: 10rem;line-height: 1.2;" data-bs-toggle="tooltip" data-bs-title="Cimone Mas Permai 1, Jl. Kalimantan No.40, Cimone Jaya, Kota Tangerang, Banten 15114"><i class="fa-solid fa-location-dot pe-1"></i>Cimone Mas Permai 1, Jl. Kalimantan No.40, Cimone Jaya, Kota Tangerang, Banten 15114</div>
                    </td>
                    <td class="detail">Rp. 100.000</td>
                </tr>
                <tr class="child-row">
                    <td class="detail" colspan="10">
                        <div class="view-detail" style="">
                            <div class="list-detail pb-3">
                                <div class="text-head-2 py-2">
                                    <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Detail Produk
                                </div> 
                                <table class="table detail-payment m-0">
                                    <thead>
                                        <tr>
                                            <th class="detail text-center" style="width:50px">Gambar</th>
                                            <th class="detail">Nama</th>
                                            <th class="detail">Qty</th>
                                            <th class="detail">Harga</th>
                                            <th class="detail">Disc</th>
                                            <th class="detail">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr>
                                            <td class="detail no-border">
                                                <img src="https://192.168.100.52/mahiera/assets/images/produk/21/1.png?2025-06-0912:58:43" alt="Gambar" class="image-produk">
                                            </td>
                                            <td class="detail no-border">
                                                <span class="text-head-3">Bata Expose MRC Solid</span><br>
                                                <span class="text-detail-2 text-truncate">Bata Tempel dan Bata Expose</span> 
                                                <div class="d-flex gap-1 flex-wrap"><span class="badge badge-sm badge-0 rounded">vendor : MGS</span><span class="badge badge-sm badge-1 rounded">ukuran : 22 x 10 x 5 cm</span></div>
                                            </td>
                                            <td class="detail no-border">1,00 Pcs</td>
                                            <td class="detail no-border">Rp. 3.200</td>
                                            <td class="detail no-border">Rp. 3.200</td>
                                            <td class="detail no-border">Rp. 0</td>
                                        </tr> 
                                    </tbody> 
                                </table>
                            </div> 
                            <div class="list-detail pb-3">
                                <div class="text-head-2 py-2">
                                    <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Pembayaran
                                </div> 
                                <div class="alert alert-warning p-2 m-0" role="alert">
                                <span class="text-head-3">
                                    <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                                    Belum ada pembayaran yang dibuat dari dokumen ini, 
                                    <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment()">Ajukan pembayaran</a> 
                                </span>
                            </div> 
                            </div> 
                            <div class="list-detail">
                                <div class="text-head-2 py-2">
                                    <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Pengiriman
                                </div>  
                            </div> 
                        </div>
                    </td>
                </tr>
            </tbody>
        </table> ';
        } 
    }
    function get_data_delivery_sample_status($row){
        $delivery = ''; 
        if($row->SampleDelivery == 0){
            $delivery = ' 
                    <span class="text-head-3 pointer delivery">
                        <span class="badge text-bg-success me-1">Tidak ada</span>
                    </span>'; 
        }else{
            $builder = $this->db->table("delivery");
            $builder->selectSum('DeliveryDetailQty'); 
            $builder->join('delivery_detail',"DeliveryId=DeliveryDetailRef"); 
            $builder->where('DeliveryRef',$row->SampleId);
            $builder->where('DeliveryRefType',"Survey");
            $builder->where('DeliveryStatus <',2);
            $paymentTotal = $builder->get()->getRow()->DeliveryDetailQty;
            $delivery = ' 
                    <span class="text-head-3 pointer delivery">
                        <span class="badge text-bg-danger me-1">Belum Lengkap</span>
                    </span> '; 

        }
        return $delivery;
    }


    public function get_next_code_sample($date){
        //sample SPH/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table($table);  
        $builder->select("ifnull(max(SUBSTRING(SampleCode,5,3)),0) + 1 as nextcode");
        $builder->where("month(SampleDate2)",$arr_date[1]);
        $builder->where("year(SampleDate2)",$arr_date[0]);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "SPL/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "SPL/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "SPL/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "SPL/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    } 
 
    public function insert_data_sample($data){ 
        $header = $data["header"]; 

        $builder = $this->db->table($table);
        $builder->insert(array(
            "SampleCode"=>$this->get_next_code_sample($header["SampleDate"]),
            "SampleDate"=>$header["SampleDate"],
            "SampleDate2"=>$header["SampleDate"],  
            "ProjectId"=>$header["ProjectId"],
            "SampleRef"=>$header["SampleRef"],
            "SampleRefType"=>$header["SampleRefType"],
            "SampleCustName"=>$header["SampleCustName"],
            "SampleCustTelp"=>$header["SampleCustTelp"],
            "SampleAddress"=>$header["SampleAddress"],
            "SampleDelivery"=>$header["SampleDelivery"],
            "SampleDeliveryTotal"=>$header["SampleDeliveryTotal"],
            "SampleAdmin"=>$header["SampleAdmin"], 
            "TemplateId"=>$header["TemplateId"],
            "SampleSubTotal"=>$header["SampleSubTotal"],
            "SampleDiscItemTotal"=>$header["SampleDiscItemTotal"],
            "SampleDiscTotal"=>$header["SampleDiscTotal"],
            "SampleGrandTotal"=>$header["SampleGrandTotal"],
            "SampleStatus"=>($header["SampleGrandTotal"] == "0" ? 1 : 0),
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->orderby('SampleId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SampleDetailRef"] = $query->SampleId;
            $row["SampleDetailVarian"] = (isset($row["SampleDetailVarian"]) ? json_encode($row["SampleDetailVarian"]) : "[]");  
            $builder = $this->db->table("sample_detail");
            $builder->insert($row); 
        }

        
        //update status Penawaran
        if( $header["SampleRefType"] == "Penawaran"){ 
            $builder = $this->db->table("penawaran"); 
            $builder->set('SphStatus', 1); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SphId', $header["SampleRef"]); 
            $builder->update(); 
        }  

        //update status Survey
        if( $header["SampleRefType"] == "Survey") $this->update_data_survey_status($header["SampleRef"]);
        

        
        //update status Sample
        $this->update_data_sample_status($query->SampleId);

        //update status project
        $builder = $this->db->table("project"); 
        $builder->set('ProjectStatus', 2);  
        $builder->where('ProjectId', $header["ProjectId"]); 
        $builder->update();   
    }

    public function data_project_sample($project_id){ 
        $modelsproduk = new ProdukModel();
        $html = ""; 
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('users',"id=SampleAdmin","left"); 
        $builder->where('ProjectId',$project_id);
        $builder->where('SampleStatus !=',3);
        $builder->orderby('SampleStatus', 'ASC'); 
        $builder->orderby('SampleDate', 'ASC'); 
        $query = $builder->get()->getResult();  
        $data_count = 0; 
        foreach($query as $row){ 
            $data_count++;
 
            $builder = $this->db->table("sample_detail");
            $builder->select('*'); 
            $builder->where('SampleDetailRef',$row->SampleId);
            $builder->orderby('SampleDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A"; 
            foreach($items as $item){ 
                $arr_varian = json_decode($item->SampleDetailVarian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }
                
                $gambar = $modelsproduk->getproductimagedatavarian($item->ProdukId,$item->SampleDetailVarian,true) ;
                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-4 my-1 varian">   
                        <div class="d-flex gap-2"> 
                            ' . ($item->SampleDetailType == "product" ? ($gambar ? "<img src='". $gambar ."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url("assets/images/produk/default.png").'?date='.date("Y-m-dH:i:s")."' alt='Gambar Default'>") : "").'  
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase"  '.($item->SampleDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SampleDetailText.'</span>
                                <span class="text-detail-2 text-truncate"  '.($item->SampleDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SampleDetailGroup.'</span> 
                                <div class="d-flex flex-wrap gap-1">
                                    '.$arr_badge.'
                                </div>
                            </div> 
                        </div>
                    </div>';
                if($item->SampleDetailType == "product"){
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail">
                                        <div class="row"> 
                                            <div class="col-6 col-md-2">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->SampleDetailQty, 2, ',', '.').' '.$item->SampleDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Harga satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SampleDetailPrice, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Disc satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SampleDetailDisc, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Total:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SampleDetailTotal, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                        </div>   
                                    </div> 
                                </div>';
                    $no++;
                }else{
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail"></div></div>';
                    $huruf++;
                    $no = 1;
                }
                     
                
            }


            $SampleRef = '-';
            // MENGAMBIL DATA REFERENSI
            if($row->SampleRefType == "Survey"){
                $builder = $this->db->table("survey");
                $builder->where('SurveyId',$row->SampleRef); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    $SampleRef = ' 
                    <script>
                        function sample_ref_click_'.$project_id.'_'.$queryref->SurveyId.'(){
                            $(".icon-project[data-menu=\'survey\'][data-id=\''.$project_id.'\']").trigger("click");
                            setTimeout(function() {
                                var targetElement = $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SurveyId.'\']");
                                var contentData = $(".content-data[data-id=\''.$project_id.'\']");
                                if (targetElement.length > 0 && contentData.length > 0) {
                                    var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                    contentData.scrollTop(targetOffset);
                                }
                               
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SurveyId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SurveyId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SurveyId.'\'").removeClass("show"); 
                                    }, 2000); // delay 1 detik
                                })
    
                            }, 500); // delay 1 detik
                        }
                    </script> 
                    <span class="text-head-3">Survey </span><span class="text-head-3 pointer text-decoration-underline" onclick="sample_ref_click_'.$project_id.'_'.$queryref->SurveyId.'()">('.$queryref->SurveyCode.')
                    </span>  '; 
                }
            } 
            if($row->SampleRefType == "Penawaran"){
                $builder = $this->db->table("penawaran");
                $builder->where('SphId',$row->SampleRef); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    $SampleRef = ' 
                    <script>
                        function sample_ref_click_'.$project_id.'_'.$queryref->SphId.'(){
                            $(".icon-project[data-menu=\'penawaran\'][data-id=\''.$project_id.'\']").trigger("click");
                            setTimeout(function() {
                                var targetElement = $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\']");
                                var contentData = $(".content-data[data-id=\''.$project_id.'\']");
                                if (targetElement.length > 0 && contentData.length > 0) {
                                    var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                    contentData.scrollTop(targetOffset);
                                }
                               
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").removeClass("show"); 
                                    }, 2000); // delay 1 detik
                                })
    
                            }, 500); // delay 1 detik
                        }
                    </script> 
                    <span class="text-head-3">Penawaran </span><span class="text-head-3 pointer text-decoration-underline" onclick="sample_ref_click_'.$project_id.'_'.$queryref->SphId.'()">('.$queryref->SphCode.')
                    </span>  '; 
                }
            }

            // MENGAMBIL DATA DITERUSKAN
            $builder = $this->db->table("penawaran");
            $builder->select('*');
            $builder->where('SphRef',$row->SampleId); 
            $builder->where('SphRefType',"Sample"); 
            $builder->where('SphStatus <',"2"); 
            $builder->orderby('SphId', 'DESC'); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                $SampleForward = ' 
                <script>
                    function sample_return_click_'.$project_id.'_'.$queryref->SphId.'(){
                        $(".icon-project[data-menu=\'penawaran\'][data-id=\''.$project_id.'\']").trigger("click");
                        setTimeout(function() {
                            var targetElement = $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\']");
                            var contentData = $(".content-data[data-id=\''.$project_id.'\']");
                            if (targetElement.length > 0 && contentData.length > 0) {
                                var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                contentData.scrollTop(targetOffset);
                            }
                           
                            $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").addClass("show");
                            $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").hover(function() {
                                setTimeout(function() {
                                     $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").removeClass("show"); 
                                }, 2000); // delay 1 detik
                            })

                        }, 500); // delay 1 detik
                    }
                </script> 
                <span class="text-head-3">Penawaran </span><span class="text-head-3 pointer text-decoration-underline" onclick="sample_return_click_'.$project_id.'_'.$queryref->SphId.'()">('.$queryref->SphCode.')
                </span>  '; 
            }else{
                $builder = $this->db->table("invoice");
                $builder->select('*');
                $builder->where('InvRef',$row->SampleId); 
                $builder->where('InvRefType',"Sample");  
                $builder->orderby('InvId', 'DESC'); 
                $queryref = $builder->get()->getRow();   
                if($queryref){
                    $SampleForward = ' 
                            <script>
                                function survey_return_click_'.$project_id.'_'.$queryref->InvId.'(){
                                    $(".icon-project[data-menu=\'invoice\'][data-id=\''.$project_id.'\'").trigger("click");
                                    setTimeout(function() {
                                        var targetElement = $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\']");
                                        var contentData = $(".content-data[data-id=\''.$project_id.'\']");
                                        if (targetElement.length > 0 && contentData.length > 0) {
                                            var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                            contentData.scrollTop(targetOffset);
                                        }
                                       
                                        $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").addClass("show");
                                        $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").hover(function() {
                                            setTimeout(function() {
                                                 $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").removeClass("show"); 
                                            }, 2000); // delay 1 detik
                                        })

                                    }, 1000); // delay 1 detik
                                }
                            </script>
                            
                            <span class="text-head-3">Invoice </span><span class="text-head-3 pointer text-decoration-underline" onclick="survey_return_click_'.$project_id.'_'.$queryref->InvId.'()">('.$queryref->InvCode.')
                            </span> 
                        ';
                }else{
                    $SampleForward = ' <span class="text-head-3"><a class="text-detail-2" onclick="add_project_sph('.$project_id.',this,'.$row->SampleId.',\'Sample\')">Penawaran</a> | </span> 
                    <span class="text-head-3"><a class="text-detail-2" onclick="add_project_invoice('.$project_id.',this,'.$row->SampleId.',\'Sample\')">Invoice</a></span>'; 
                }
            }
            
            // MENGAMBIL DATA PEMBAYARAN
            $html_payment = "";
            $payment_total = 0;
            if($row->SampleGrandTotal == 0){
                $html_payment = ' 
                <span class="text-head-3 ps-4">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran yang harus diselesaikan untuk transaksi ini 
                </span> ';
            }else{
                $builder = $this->db->table("payment");
                $builder->select('*'); 
                $builder->where('PaymentRef',$row->SampleId);
                $builder->where('PaymentRefType',"Sample");
                $builder->orderby('PaymentId', 'ASC'); 
                $payment = $builder->get()->getResult(); 
                $html_payment = "";
                $payment_total = 0;
                $performa_total = 0; 
                foreach($payment as $row_payment){ 
                    if($row_payment->PaymentDoc == "1"){
                        $payment_total += $row_payment->PaymentTotal;
                    }else{
                        $performa_total += $row_payment->PaymentTotal;
                    } 
                    if($row_payment->PaymentStatus == "0"){
                        $status = '<span class="text-head-3 text-warning">
                        <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                            <i class="fa-solid fa-certificate fa-stack-2x"></i> 
                            <i class="fa-solid fa-exclamation fa-stack-1x fa-inverse"></i>
                        </span>Pending</span>';
                        //$status = '<span class="text-head-3 text-warning">Pending</span>';
                    }else{
                        $status = ' <span class="text-head-3 text-success">
                        <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                            <i class="fa-solid fa-certificate fa-stack-2x"></i>
                            <i class="fa-solid fa-check fa-stack-1x fa-inverse"></i>
                        </span>Verified</span>';
                        //$status = '<span class="text-head-3 text-success">Terverifikasi</span>';
                    } 

                    $html_payment .= '
                    <div class="list-project mb-4 p-2 project-hide">  
                        <div class="header row gx-0 gy-0 gx-md-4 gy-md-2 ps-3" >
                            <div class="d-flex gap-4"> 
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Pembayaran</span>
                                    <span class="text-head-3">'.$row_payment->PaymentCode.'</span>
                                </div>    
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                                    <span class="text-head-3">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</span>
                                </div>   
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                                    '.$status.'
                                </div>   
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-layer-group pe-1"></i>Type</span>
                                    <span class="text-head-3">'.$row_payment->PaymentType.'</span>
                                </div>   
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-credit-card pe-1"></i>Method</span>
                                    <span class="text-head-3">'.$row_payment->PaymentMethod.'</span>
                                </div>   
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-money-bill pe-1"></i>Total</span>
                                    <span class="text-head-3">Rp. '.number_format($row_payment->PaymentTotal,0, ',', '.').'</span>
                                </div>   
                                <div class="flex-fill text-end">  
                                    <button class="btn btn-sm btn-primary btn-action rounded border '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->SampleId.','.$row_payment->PaymentId.',this,\'sample\')">
                                        <i class="fa-solid fa-eye mx-1"></i><span>Lihat Bukti</span>
                                    </button>
                                    <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')">
                                        <i class="fa-solid fa-print mx-1"></i><span>Cetak</span>
                                    </button>
                                    <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')">
                                        <i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_payment('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')">
                                        <i class="fa-solid fa-close mx-1"></i><span>Hapus</span>
                                    </button> 
                                </div> 
                            </div>
                        </div>
                    </div>';
                
                } 
                if($html_payment == ""){
                    $html_payment = '<div class="alert alert-warning p-2 m-1" role="alert"> 
                            <span class="text-head-3">
                                <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                                Belum ada data pembayaran, silahkan tambahkan data  
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_project_payment('.$project_id.','.$row->SampleId.',this,\'sample\')">Pembayaran</a>
                            </span> 
                        </div>';
                }elseif($payment_total < $row->SampleGrandTotal){
                    $html_payment .= '
                    <div class="alert alert-warning p-2 m-1" role="alert"> 
                        <span class="text-head-3">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Masih ada sisa pembayaran yang belum diselesaikan, silahkan buat data  
                            <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_project_payment('.$project_id.','.$row->SampleId.',this,\'sample\')">Pembayaran</a>
                        </span> 
                    </div>';
                }
            }

            // MENGAMBIL DATA PENGIRIMAN
            $html_delivery = "";
            if($row->SampleDelivery == 0){
                $html_delivery = ' 
                <span class="text-head-3 ps-4">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Mode pengriman tidak diaktifkan untuk transaksi ini, 
                    <a class="text-head-3 text-primary" style="cursor:pointer" onclick="sample_project_update_delivery('.$project_id.','.$row->SampleId.',this,1)">aktifkan mode Pengiriman</a>
                </span> ';
            }else{
                $builder = $this->db->table("delivery");
                $builder->select('*');    
                $builder->where('DeliveryRef',$row->SampleId); 
                $builder->where('DeliveryRefType',"Sample");  
                $builder->where('DeliveryStatus <',"3"); 
                $builder->orderby('DeliveryId', 'ASC'); 
                $delivery = $builder->get()->getResult();
                
                foreach($delivery as $row_delivery){

                    $builder = $this->db->table("delivery_detail");
                    $builder->select('*'); 
                    $builder->where('DeliveryDetailRef',$row_delivery->DeliveryId);
                    $builder->orderby('DeliveryDetailId', 'ASC'); 
                    $items = $builder->get()->getResult(); 
                    $html_items_delivery = "";
                    $no = 1;
                    $huruf  = "A";
                    foreach($items as $item){  
                        $arr_varian = json_decode($item->DeliveryDetailVarian);
                        $arr_badge = "";
                        $arr_no = 0;
                        foreach($arr_varian as $varian){
                            $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                            $arr_no++;
                        }

                        $gambar = $modelsproduk->getproductimagedatavarian($item->ProdukId,$item->DeliveryDetailVarian,true) ; 
                        $html_items_delivery .= '
                        <div class="row">
                            <div class="col-12 col-md-5 my-1 varian">   
                                <div class="d-flex gap-2">
                                ' . ($item->DeliveryDetailType == "product" ? ($gambar ? "<img src='". $gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url("assets/images/produk/default.png").'?date='.date("Y-m-dH:i:s")."' alt='Gambar Default' >") : "").'  
                                    <div class="d-flex flex-column text-start">
                                        <span class="text-head-3 text-uppercase"  '.($item->DeliveryDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->DeliveryDetailText.'</span>
                                        <span class="text-detail-2 text-truncate"  '.($item->DeliveryDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->DeliveryDetailGroup.'</span> 
                                        <div class="d-flex flex-wrap gap-1">
                                            '.$arr_badge.'
                                        </div>
                                    </div> 
                                </div>
                            </div>'; 
                        $html_items_delivery .= '<div class="col-12 col-md-7 my-1 detail">
                                            <div class="row"> 
                                                <div class="col-6 col-md-3">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Dikirim:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQty, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                                <div class="col-6 col-md-2">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Spare:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQtySpare, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                                <div class="col-4 col-md-3 px-1 border-left">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Diterima:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQtyReceive, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                                <div class="col-4 col-md-2 px-1">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Spare:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQtyReceiveSpare, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                                <div class="col-4 col-md-2 px-1">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Rusak:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQtyReceiveWaste, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                            </div>   
                                        </div> 
                                    </div>';
                        $no++; 
                            
                        
                    } 
                    $delivery_status = "";
                    $delivery_date = "";
                    if($row_delivery->DeliveryStatus == 0){ 
                        $delivery_status = '<span class="text-head-3">
                            <span class="badge text-bg-primary me-1">Dijadwalkan</span> 
                        </span>';
                        $delivery_date = '
                                        <div class="row">
                                            <div class="col-4"> 
                                                <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Dijadwalkan</span>
                                            </div>
                                            <div class="col-8">
                                                <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDate),"d M Y").'</span>
                                            </div>
                                        </div>  <div class="row">
                                            <div class="col-4"> 
                                                <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Dikirim</span>
                                            </div>
                                            <div class="col-8">
                                                <span class="text-head-3"><a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_project_proses('.$project_id.','.$row_delivery->DeliveryId.',this)">Proses Pengiriman</a></span>
                                            </div>
                                        </div> ';
                    }elseif($row_delivery->DeliveryStatus == 1){
                        $delivery_status = '<span class="text-head-3">
                            <span class="badge text-bg-info me-1">Dikirim</span> 
                        </span>'; 
                        $delivery_date = '
                            <div class="row">
                                <div class="col-4"> 
                                    <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Dijadwalkan</span>
                                </div>
                                <div class="col-8">
                                    <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDate),"d M Y").'</span>
                                </div>
                            </div>  <div class="row">
                                <div class="col-4"> 
                                    <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Dikirim</span>
                                </div>
                                <div class="col-8">
                                    <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDateProses),"d M Y").' </span>
                                    <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat Proses Pengiriman" onclick="delivery_proses_show('.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-eye"></i></span>
                                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Proses Pengiriman" onclick="delivery_proses_edit('.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-4"> 
                                    <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Diterima</span>
                                </div>
                                <div class="col-8">
                                    <span class="text-head-3"><a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_project_finish('.$project_id.','.$row_delivery->DeliveryId.',this)">Terima Pengiriman</a></span>
                                </div>
                            </div> ';
                    }elseif($row_delivery->DeliveryStatus == 2){
                        $delivery_status = '<span class="text-head-3">
                            <span class="badge text-bg-success me-1">Selesai</span> 
                        </span>'; 
                        $delivery_date = '
                            <div class="row">
                                <div class="col-4"> 
                                    <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Dijadwalkan</span>
                                </div>
                                <div class="col-8">
                                    <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDate),"d M Y").'</span>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-4"> 
                                    <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Dikirim</span>
                                </div>
                                <div class="col-8">   
                                    <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDateProses),"d M Y").' </span>
                                    <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat Proses Pengiriman" onclick="delivery_proses_show('.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-eye"></i></span>
                                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Proses Pengiriman" onclick="delivery_proses_edit('.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-4"> 
                                    <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Diterima</span>
                                </div>
                                <div class="col-8">
                                    <span class="text-head-3">'.date_format(date_create($row_delivery->DeliveryDateFinish),"d M Y").'</span>
                                    <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat Terima Pengiriman" onclick="delivery_finish_show('.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-eye"></i></span>
                                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Terima Pengiriman" onclick="delivery_finish_edit('.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                                
                                </div>
                            </div>';
                    }
                    $html_delivery .= '
                        <div class="list-project mb-4 p-2 project-hide">  
                            <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">
                                <div class="col-12  col-md-4 order-1 order-sm-0"> 
                                    <div class="row">
                                        <div class="col-4"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Pengiriman</span>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-head-3">'.$row_delivery->DeliveryCode.'</span>
                                            <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Pengiriman" onclick="print_project_delivery('.$project_id.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-print"></i></span>
                                            <span class="text-warning pointer text-head-3 '.($row_delivery->DeliveryStatus > 1 ? "d-none" : "").'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Pengiriman" onclick="edit_project_delivery('.$project_id.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                                            <span class="text-danger pointer text-head-3 '.($row_delivery->DeliveryStatus > 0 ? "d-none" : "").'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Pengiriman"  onclick="delete_project_delivery('.$project_id.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-circle-xmark"></i></span>
                                                
                                        </div>
                                    </div> 
                                    
                                    <div class="row">
                                        <div class="col-4"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-head-3">'.$delivery_status.'</span>
                                        </div>
                                    </div>     
                                    <div class="row">
                                        <div class="col-4"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-flag pe-1"></i>Ritase</span>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-head-3">'.$row_delivery->DeliveryRitase.' ('.$this->getTerbilang($row_delivery->DeliveryRitase).')</span>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-4"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-truck pe-1"></i>Armada</span>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-head-3">'.$row_delivery->DeliveryArmada.'</span>
                                        </div>
                                    </div>    
                                    '.$delivery_date .'   
                                </div>   
                                <div class="col-12  col-md-8 order-1 order-sm-1">  
                                    <div class="d-flex mt-2 p-2 gap-4 align-items-center">   
                                        <div class="d-flex flex-row flex-md-column align-self-start">
                                            <span class="text-detail-2"><i class="fa-solid fa-plane-departure pe-1"></i></i>Dari</span>
                                            <span class="text-head-2">'.$row_delivery->DeliveryFromName.'</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryFromTelp.'</span>
                                            <span class="text-detail-2">'.$row_delivery->DeliveryFromAddress.'</span>
                                        </div>    
                                        <div class="d-flex text-primary align-items-center">
                                            <i class="fa-solid fa-truck pe-1"></i>
                                            <div class="line-dot"></div>
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                        <div class="d-flex flex-row flex-md-column align-self-start">
                                            <span class="text-detail-2"><i class="fa-solid fa-plane-arrival pe-1"></i>Tujuan</span>
                                            <span class="text-head-2">'.$row_delivery->DeliveryToName.'</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryToTelp.'</span>
                                            <span class="text-detail-2">'.$row_delivery->DeliveryToAddress.'</span>
                                        </div>   
                                    </div>   
                                </div>  
                            </div>   
                            <div class="detail-item mt-1 p-2 border-top">
                                '.$html_items_delivery.' 
                            </div>  
                        </div>';
                }
                if($html_delivery == ""){
                    $html_delivery = ' 
                        <div class="alert alert-warning p-2 m-1" role="alert">
                            <span class="text-head-3">
                                <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                                Belum ada data pengiriman, 
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_project_delivery('.$project_id.','.$row->SampleId.',this,\'sample\')">Buat Data Pengiriman</a> atau <a class="text-head-3 text-primary" style="cursor:pointer" onclick="sample_project_update_delivery('.$project_id.','.$row->SampleId.',this,0)">nonaktifkan mode Pengiriman</a>
                            </span>
                        </div>';
                }
            } 

            $status = "";
            if($row->SampleStatus==0){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8"> 
                        <span class="text-head-3">
                            <span class="badge text-bg-primary me-1">Baru</span> 
                        </span>
                    </div>
                </div> ';
            }
            if($row->SampleStatus==1){
                $status .= ' 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3">
                            <span class="badge text-bg-info me-1">Proses</span>
                            <span class="text-primary pointer d-none" onclick="update_status_survey(1,'.$row->SampleId.')"><i class="fa-solid fa-pen-to-square"></i></span>
                        </span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-regular fa-share-from-square pe-1"></i>Teruskan</span>
                    </div>
                    <div class="col-8">
                        '.$SampleForward.'
                    </div>
                </div>  ';
            }
            if($row->SampleStatus==2){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3">
                            <span class="badge text-bg-success me-1">Selesai</span>
                        </span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-regular fa-share-from-square pe-1"></i>Diteruskan</span>
                    </div>
                    <div class="col-8">
                        '.$SampleForward.'
                    </div>
                </div>  ';
            }
            if($row->SampleStatus==3){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3">
                            <span class="badge text-bg-danger me-1">Batal</span>
                        </span>
                    </div>
                </div> '; 
            }


            $html .= '
            <div class="list-project mb-4 p-2" data-id="'.$row->SampleId.'" data-project="'.$project_id.'">
                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">
                    <div class="col-12  col-md-4 order-1 order-sm-0"> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Sample</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SampleCode.'</span>
                                <span class="text-primary pointer text-head-3 d-none" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Sample" onclick="print_project_Sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-print"></i></span>
                                <div class="d-inline '.($row->SampleStatus > 1 ? "d-none" : "").'">
                                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Sample" onclick="edit_project_sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                                    <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Sample"  onclick="delete_project_sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-circle-xmark"></i></span>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-flag pe-1"></i>Referensi</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$SampleRef .'</span>
                            </div>
                        </div>    
                        '.$status.'
                        
                    </div>  
                    <div class="col-12  col-md-3 order-1 order-sm-1"> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.date_format(date_create($row->SampleDate),"d M Y").'</span>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-user pe-1"></i>Admin</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->username .'</span>
                            </div>
                        </div>    
                    </div>
                    <div class="col-12  col-md-5 order-2 order-sm-1"> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-user pe-1"></i>Nama</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SampleCustName.'</span>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-phone pe-1"></i>No. Hp</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SampleCustTelp.'</span>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-location-dot pe-1"></i>Lokasi</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SampleAddress.'</span>
                            </div>
                        </div>  
                    </div>  
                </div>  
                <div class="detail-item p-2 m-1 border-top">
                    '.$html_items.' 
                </div>
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center flex-wrap">   
                    <span class="text-detail-2">Sub Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleSubTotal, 0, ',', '.').'</span>  
                    <div class="vr"></div>
                    <span class="text-detail-2">Disc Item:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleDiscItemTotal, 0, ',', '.').'</span>   
                    <div class="vr"></div>
                    <span class="text-detail-2">Disc Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleDiscTotal, 0, ',', '.').'</span>   
                    <div class="vr"></div>
                    <span class="text-detail-2">pengiriman:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleDeliveryTotal, 0, ',', '.').'</span>   
                    <div class="vr"></div>
                    <span class="text-detail-2">Grand Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleGrandTotal, 0, ',', '.').'</span> 
                </div>
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center pt-2 justify-content-between">  
                    <span class="text-head-2"><i class="fa-solid fa-money-bill pe-2"></i>Rincian Pembayaran</span> 
                </div>
                '.$html_payment.' 
                <div class="d-flex border-top mt-2 pt-2 m-1 gap-2 align-items-center pt-2 justify-content-between">  
                    <span class="text-head-2"><i class="fa-solid fa-truck pe-2"></i>Rincian Pengiriman</span> 
                </div>
                '.$html_delivery.'  
            </div> 
            ';
        }

        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Belum ada data yang dibuat</span> 
                </div> 
            ';
        }
        $html = '<div class="p-2 text-center"><h5 class="fw-bold" style="color: #032e7c !important; ">Sampel Barang</h5></div>'.$html;
        $html .= '   <div class="d-flex justify-content-center flex-column align-items-center">
                        <button class="btn btn-sm btn-primary px-3 m-2" onclick="add_project_sample(\''.$project_id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data sample barang</button>
                    </div>';

        $modelproject = new ProjectModel();
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html,
                "count"=>$data_count,
                "project"=>$modelproject->load_project_status($project_id)
            )
        );
    }

    public function data_project_sample_notif($project_id){
        $alert = array(); 
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('ProjectId',$project_id);
        $builder->where('SampleStatus <',3);
        $builder->orderby('SampleId', 'DESC'); 
        $query = $builder->get()->getResult();  
        foreach($query as $row){ 
            if($row->SampleGrandTotal > 0){
                $builder = $this->db->table("payment");
                $builder->select('sum(PaymentTotal) as total');  
                $builder->where('PaymentDoc',"1");
                $builder->where('PaymentRef',$row->SampleId);
                $builder->where('PaymentRefType',"Sample");
                $builder->orderby('PaymentId', 'ASC'); 
                $payment = $builder->get()->getRow()->total; 
                if($payment < $row->SampleGrandTotal){
                    $alert[] = array(
                        "type"=>"Payment",
                        "message"=>"pembayaran ". $row->SampleCode ." belum dibuat"
                    );
                } 
            }
            
            if($row->SampleDelivery > 0){
                $builder = $this->db->table("delivery");
                $builder->select('*');   
                $builder->where("DeliveryRef",$row->SampleId);
                $builder->where("DeliveryRefType","Sample");
                $builder->orderby('DeliveryId', 'ASC'); 
                $delivery = $builder->countAllResults();
                if($delivery == 0){
                    $alert[] = array(
                        "type"=>"Pengiriman",
                        "message"=>"Pengiriman ".$row->SampleCode." belum dibuat"
                    );
                }  
            }
            if($row->SampleStatus <2){ 
                $alert[] = array(
                    "type"=>"teruskan",
                    "message"=>"dokumen ". $row->SampleCode ." belum diteruskan"
                );
            }
        }
        return $alert;
    }

    public function data_project_sample_count($project_id){ 
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('ProjectId',$project_id); 
        $builder->where('SampleStatus <',3);
        $builder->orderby('SampleId', 'DESC'); 
        return  $builder->countAllResults();
    }

    public function get_data_sample($id){
        $builder = $this->db->table($this->table); 
        $builder->select("*, CASE 
        WHEN SampleRefType = '-' THEN 'No data Selected'
        WHEN SampleRefType = 'Survey' THEN (select SurveyCode from survey where SurveyId = SampleRef)
        WHEN SampleRefType = 'Penawaran' THEN (select SphCode from penawaran where SphId = SampleRef)
        END AS 'SampleRefCode'"); 
        $builder->join("project","project.ProjectId = sample.ProjectId","left");
        $builder->join("customer","project.CustomerId = customer.CustomerId","left");
        $builder->join("template_footer","TemplateId = template_footer.TemplateFooterId","left");
        $builder->where('SampleId',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    }
    public function get_data_sample_ref($id){

    }

    public function get_data_sample_detail($id){
        $builder = $this->db->table("sample_detail");
        $builder->where('SampleDetailRef',$id); 
        return $builder->get()->getResult();  
    }  

    public function update_data_sample($data,$id){ 
        $header = $data["header"]; 

        $builder = $this->db->table($this->table); 
        $builder->set('SampleDate', $header["SampleDate"]);   
        $builder->set('SampleRef', $header["SampleRef"]);   
        $builder->set('SampleRefType', $header["SampleRefType"]);   
        $builder->set('SampleAdmin', $header["SampleAdmin"]);  
        $builder->set('SampleCustName', $header["SampleCustName"]);
        $builder->set('SampleCustTelp', $header["SampleCustTelp"]);
        $builder->set('SampleAddress', $header["SampleAddress"]); 
        $builder->set('SampleDeliveryTotal', $header["SampleDeliveryTotal"]); 
        $builder->set('SampleDelivery', $header["SampleDelivery"]);  
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('SampleSubTotal', $header["SampleSubTotal"]); 
        $builder->set('SampleDiscItemTotal', $header["SampleDiscItemTotal"]); 
        $builder->set('SampleDiscTotal', $header["SampleDiscTotal"]); 
        $builder->set('SampleGrandTotal', $header["SampleGrandTotal"]);  
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $id); 
        $builder->update(); 

        $builder = $this->db->table("sample_detail");
        $builder->where('SampleDetailRef',$id);
        $builder->delete(); 

        //update status Survey
        if( $header["SampleRefType"] == "Survey") $this->update_data_survey_status($header["SampleRef"]); 

         //update status Penawaran
         if( $header["SampleRefType"] == "Penawaran"){ 
            $builder = $this->db->table("penawaran"); 
            $builder->set('SphStatus', 1); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SphId', $header["SampleRef"]); 
            $builder->update(); 
        }  
        
        //update status Sample
        $this->update_data_sample_status($id);
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SampleDetailRef"] = $id;
            $row["SampleDetailVarian"] = (isset($row["SampleDetailVarian"]) ? json_encode($row["SampleDetailVarian"]) : "[]");  
            $builder = $this->db->table("sample_detail");
            $builder->insert($row); 
        } 

    } 

    public function update_data_sample_delivery($data,$id){  
        $builder = $this->db->table($this->table);  
        $builder->set('SampleDelivery', $data["status"]);   
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $id); 
        $builder->update();   

        //update status Sample
        $this->update_data_sample_status($id); 
    } 

    public function update_data_sample_status($id){ 
        $builder = $this->db->table($this->table);  
        $builder->where('SampleId',$id);
        $result = $builder->get()->getRow(); 
 
        // MENGAMBIL DATA DITERUSKAN
        $sampledirect = 0;
        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->where('SphRef',$result->SampleId); 
        $builder->where('SphRefType',"Sample"); 
        $builder->where('SphStatus <',"2"); 
        $builder->orderby('SphId', 'DESC'); 
        $queryref = $builder->get()->getRow();  
        if($queryref){ 
            $sampledirect = 1;
        }else{
            $builder = $this->db->table("invoice");
            $builder->select('*');
            $builder->where('InvRef',$result->SampleId); 
            $builder->where('InvRefType',"Sample");  
            $builder->orderby('InvId', 'DESC'); 
            $queryref = $builder->get()->getRow();   
            if($queryref){ 
                $sampledirect = 1; 
            }
        }

        //status payment
        $paymentstatus = 1;
        if($result->SampleGrandTotal > 0){
            $builder = $this->db->table("payment");  
            $builder->where('PaymentRef',$id);
            $builder->where('PaymentRefType','Sample');
            $results = $builder->get()->getResult(); 
            $hasil = array_sum(array_column($results, 'PaymentTotal')); 
            if($result->SampleGrandTotal > $hasil ){
                $paymentstatus = 0;
            }
        } 

        //status delivery
        $deliverystatus = 1; 
        if($result->SampleDelivery > 0){
            $builder = $this->db->table("delivery"); 
            $builder->join('delivery_detail',"DeliveryDetailRef=DeliveryId","left"); 
            $builder->where('SampleId',$id); 
            $results = $builder->get()->getResult(); 
            $hasildelivery = array_sum(array_column($results, 'DeliveryDetailQty')); 
    
            $builder = $this->db->table("sample_detail");  
            $builder->join('sample',"SampleDetailRef=SampleId","left"); 
            $builder->where('SampleId',$id);
            $results = $builder->get()->getResult(); 
            $hasilsample = array_sum(array_column($results, 'SampleDetailQty')); 

            if($hasilsample < $hasildelivery ){
                $deliverystatus = 0;
            } 
        } 
        
        if(($paymentstatus == 1 && $deliverystatus == 1 && $sampledirect == 1 )){
            $builder = $this->db->table($this->table); 
            $builder->set('SampleStatus', 2); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SampleId', $id); 
            $builder->update();  
        } else if(($paymentstatus == 1 || $deliverystatus == 1 || $sampledirect == 1 )){
            $builder = $this->db->table($this->table); 
            $builder->set('SampleStatus', 1); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SampleId', $id); 
            $builder->update();   
        }else{
            $builder = $this->db->table($this->table); 
            $builder->set('SampleStatus', 0); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SampleId', $id); 
            $builder->update();  
        }  

        return $paymentstatus. " | ".$deliverystatus. " | ".$sampledirect; 
    }

    public function delete_data_sample($id){   
        $builder = $this->db->table($this->table); 
        $builder->set('SampleStatus', 2);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $id); 
        $builder->update();   

        return JSON_ENCODE(array("status"=>true));
    }  
    
    public function get_list_ref_sample($refid,$search = null){
        if($search){
            $querywhere  = "and (
                code like '%".$search."%' or 
                CustomerTelp like '%".$search."%' or 
                CustomerName like '%".$search."%' or 
                CustomerAddress like '%".$search."%' 
            ) ";
        }else{
            $querywhere = "";
        }
        $builder = $this->db->query('SELECT * FROM 
        (
            SELECT 
                SphId refid, 
                SphCode as code,
                ProjectId ref,
                SphDate date,
                "Penawaran" AS type,
                SphCustName as CustomerName,
                SphCustTelp as CustomerTelp,
                SphAddress as CustomerAddress
                FROM penawaran where SphStatus < 1 
            UNION 
            SELECT 
                SurveyId refid,
                SurveyCode,
                ProjectId ref,
                SurveyDate date, 
                "Survey",
                SurveyCustName,
                SurveyCustTelp,
                SurveyAddress
                FROM survey where SurveyStatus < 2
        ) AS ref_join
        LEFT JOIN project ON project.ProjectId = ref_join.ref 
        WHERE ref_join.ref = '.$refid.' 
        '. $querywhere.'
        ORDER BY ref_join.date asc'); 
        return $builder->getResultArray();  
    } 


}