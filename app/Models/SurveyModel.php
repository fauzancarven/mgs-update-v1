<?php

namespace App\Models; 

use CodeIgniter\Model;  
use CodeIgniter\Database\RawSql;
use App\Models\ActivityModel;
class SurveyModel extends Model
{  
    protected $DBGroup = 'default';
    protected $table = 'survey'; 

    function format_filesize($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } else {
            $bytes = $bytes . ' byte';
        }
    
        return $bytes;
    }
    function load_datatable_survey($filter = null){
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();
        
        $builder = $this->db->table("survey");
        $builder->join("project","project.ProjectId = survey.ProjectId ","left");  
        $builder->join("users","users.id = survey.SurveyAdmin ","left"); 
        $builder->join("store","store.StoreId = survey.StoreId","left");  
        if($filter["datestart"]){
            $builder->where("SurveyDate >=",$filter["datestart"]);
            $builder->where("SurveyDate <=",$filter["dateend"]); 
        } 
        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();


        if(isset($filter["filter"])){ 
            $builder->whereIn("SurveyStatus",$filter["filter"]); 
            $filterdata = 1;
        } 
        if(isset($filter["store"])){ 
            $builder->whereIn("survey.StoreId",$filter["store"]); 
            $filterdata = 1;
        } 
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("ProjectName",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("SurveyAddress",$filter["search"]);
            $builder->orLike("SurveyCode",$filter["search"]);
            $builder->orLike("username",$filter["search"]);
            $builder->orLike("SurveyCustName",$filter["search"]);
            $builder->groupEnd();  
            $filterdata = 1;
        }
        
        // Order TAble
        $columns = array(
            0 => null, // kolom action tidak dapat diurutkan
            1 => null, // kolom action tidak dapat diurutkan
            2 => "StoreCode", // kolom name
            3 => "SurveyCode", // kolom name
            4 => "SurveyDate", // kolom action tidak dapat diurutkan
            5 => "SurveyStatus", // kolom image tidak dapat diurutkan
            6 => "SurveyAdmin", // kolom action tidak dapat diurutkan
            7 => "SurveyCustName", // kolom action tidak dapat diurutkan
            8 => "SurveyStaff", // kolom action tidak dapat diurutkan
            9 => "SurveyTotal", // kolom action tidak dapat diurutkan
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
          
            // MENGAMBIL DATA STAFF
            $staffArray = explode('|', $row->SurveyStaff);
            $query =  $this->db->table('users');
            $query->whereIn('id', $staffArray);
            $result = $query->get()->getResult();
            $staffnames = array_column($result, 'username'); 
            $staffname = implode('', array_map(function($value, $key) {
                return "<span>".($key + 1) . '. ' . ucwords($value)."</span>";
            }, $staffnames, array_keys($staffnames))); 
  
            // MENGAMBIL DATA STATUS
            $status = "";
            if($row->SurveyStatus==0){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-primary text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >New</span>
                    </span> ';
            }
            if($row->SurveyStatus==1){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-info text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Proses</span>
                    </span> '; 
            }
            if($row->SurveyStatus==2){ 
                $status .= '
                    <span class=" pointertext-head-3 badge text-bg-success text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Completed</span>
                    </span> ';  
            }
            if($row->SurveyStatus==3){ 
                $status .=  '
                    <span class="pointer text-head-3 badge text-bg-danger text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Cancel</span>
                    </span> ';  
            }
            $status .= '  
            <ul class="dropdown-menu shadow drop-status ">
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(0,'.$row->SurveyId.',this)">
                        New
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(1,'.$row->SurveyId.',this)">
                        </i>Proses
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(2,'.$row->SurveyId.',this)">
                        Completed
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(3,'.$row->SurveyId.',this)">
                        Cancel
                    </a>
                </li>  
            </ul>';
                
            
            // MENGAMBIL DATA HASIL SURVEY
            $html_Survey = '
            <div class="view-detail" style="display:none">';
            //load data hasil survey
            $builders = $this->db->table("survey_finish");
            $builders->select('*');
            $builders->where('SurveyId',$row->SurveyId); 
            $row_finish = $builders->get()->getRow();   
            if($row_finish){ 
                $html_Survey .= ' 
                            <div class="list-detail">
                                <div class="text-head-2 py-2">
                                    <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Hasil Survey<span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Hasil Survey" onclick="edit_survey_finish('.$row_finish->SurveyFinishId.',this,'.$row->ProjectId.')"><i class="fa-solid fa-pen-to-square"></i></span>
                                </div> 
                                <div class="fw-normal pb-3">   
                                    <div class="col bg-light py-2" style="box-shadow:-1px 1px 4px 0 #334a9d52;">  
                                            '.$row_finish->SurveyFinishDetail.' 
                                        <div class="text-head-2 pb-2">A. File Pendukung</div>
                                        <div class="list-group"> ';
                                
                $htmlfile = "";
                $folder_utama = 'assets/images/survey'; 
                 //Buat folder berdasarkan id
                if (!file_exists($folder_utama."/".$row->SurveyId)) {
                    mkdir($folder_utama."/".$row->SurveyId, 0777, true);  
                } 
                $files = scandir($folder_utama."/".$row->SurveyId);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        $filepath = $folder_utama."/".$row->SurveyId . '/' . $file;
                        $filesize = filesize($folder_utama."/".$row->SurveyId . '/' . $file); 
                        $filetype = mime_content_type($folder_utama."/".$row->SurveyId . '/' . $file);
                        $htmlfile .= ' 
                                            <li class="list-group-item list-group-item-action align-items-center d-flex view-document file pb-2" > 
                                                <i class="fa-solid fa-file fa-2x me-2"></i>
                                                <div class="d-flex flex-column flex-fill ms-2">
                                                    <span class="fs-6">'.$file.'</span>
                                                    <span class="text-muted">'.$this->format_filesize($filesize).' | '.$filetype.'</span> 
                                                </div>  
                                                    
                                                <button class="btn btn-sm float-end" onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm float-end" onclick="download_file(this)" data-file="'.$filepath.'">
                                                    <i class="fa-solid fa-download"></i>
                                                </button>
                                                
                                            </li>';
                    }
                }  
                if($htmlfile == "") $htmlfile = ' <div class="text-head-3 ps-4" >Tidak ada data</div>';
                $html_Survey .= $htmlfile.'       </div>
                                    </div>
                                </div>
                            </div>';   
            }else{
                if($row->SurveyStatus<3){
                    $html_Survey .= '  
                    
                    <div class="list-detail">
                        <div class="text-head-2 py-2">
                            <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Hasil Survey
                        </div> 
                        <div class="alert alert-warning p-2 m-1" role="alert">
                            <span class="text-head-3">
                                <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                                Belum ada hasil survey yang dibuat dari dokumen ini, 
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_survey_finish('.$row->SurveyId.',this,'.$row->ProjectId.')">Buat hasil survey</a> 
                            </span>
                        </div>
                    </div>'; 
                }else{
                    $html_Survey .= '
                    <div class="list-detail">
                        <div class="text-head-2 py-2">
                            <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Hasil Survey
                        </div> 
                        <div class="fw-normal row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">  
                            <div class="col bg-light py-2">  
                                <i class="fa-solid fa-check text-success me-2" style="font-size:0.75rem"></i>
                                <span class="text-head-3">Tidak ada hasil survey yang dibuat</span>
                            </div>
                        </div>
                    </div>';
                }
            }
            
            // MENGAMBIL DATA Pembayaran  
            $html_Survey .= '      
                <div class="list-detail">
                    <div class="text-head-2 py-2">
                        <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Pembayaran</span>
                    </div> 
                    '.$this->get_data_payment_survey($row).'
                </div> 
            </div>';
 
            // MENGAMBIL DATA Toko 
            $store = '
                    <div class="d-flex align-items-center ">  
                        <div class="flex-grow-1 ms-1">
                            <div class="d-flex flex-column"> 
                                <span class="text-head-3 d-flex gap-0 align-items-center"><img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">'.$row->StoreCode.'</span>
                                <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1">'.$row->StoreName.'</span>  
                                <span class="text-detail-2 text-wrap overflow-none ps-1 text-default '.($row->ProjectId == 0 ? "d-none" : "").'"><i class="fa-solid fa-diagram-project pe-1 "></i>Document Project</span>  
                            </div>   
                        </div>
                    </div>';
            $data_row = array( 
                "survey" => $row, 
                "code" => $row->SurveyCode.$this->get_data_return_survey($row->SurveyId,$row->ProjectId,$row->SurveyStatus),
                "date" =>date_format(date_create($row->SurveyDate),"d M Y"),
                "status" => $status,
                "store" => $store,
                "admin" => ucwords($row->username),
                "staff" => "<div class='d-flex flex-column gap-1 text-head-3'>".$staffname."</div>",
                "biaya" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->SurveyTotal,0)."</span></div>", 
                "customer" => $row->SurveyCustName,
                "customertelp" => ($row->SurveyCustTelp ? $row->SurveyCustTelp : ""),
                "customeraddress" => $row->SurveyAddress,
                "detail" =>$html_Survey,
                "action" =>'  
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Form Survey" onclick="print_survey('.$row->SurveyId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Survey" onclick="edit_survey('.$row->SurveyId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Survey" onclick="delete_survey('.$row->SurveyId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-circle-xmark"></i></span>
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
    function get_data_return_survey($id,$project = 0,$status = 0){ 
        //check penawaran
        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->where('SphRef',$id); 
        $builder->where('SphRefType',"Survey");  
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
            $builder = $this->db->table("sample");
            $builder->select('*');
            $builder->where('SampleRef',$id); 
            $builder->where('SampleRefType',"Survey");  
            $builder->orderby('SampleId', 'DESC'); 
            $queryref = $builder->get()->getRow();   
            if($queryref){
                return '   
                    <div class="text-head-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data diteruskan ke sampel barang">
                        <i class="fa-solid fa-share-from-square text-success"></i>
                        <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="survey_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SampleId.'\',\'Sample\')">'.$queryref->SampleCode.'</a>
                    </div>  
                ';
            }else{ 
                
                // INVOICE
                $builder = $this->db->table("invoice");
                $builder->select('*');
                $builder->where('InvRef',$id); 
                $builder->where('InvRefType',"Survey");  
                $builder->orderby('InvId', 'DESC'); 
                $queryref = $builder->get()->getRow();   
                if($queryref){
                    return '   
                        <div class="text-head-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data diteruskan ke invoice">
                            <i class="fa-solid fa-share-from-square text-success"></i>
                            <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="survey_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->InvId.'\',\'Invoice\')">'.$queryref->invCode.'</a>
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
                        <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="teruskan data" >
                            <i class="fa-solid fa-share-from-square text-primary"></i> 
                            <a class="text-detail-3 pointer text-decoration-underline text-primary" data-bs-toggle="dropdown" aria-expanded="false">Teruskan data</a>
                            <ul class="dropdown-menu shadow drop-status ">
                                <li>
                                    <a class="text-detail-3 dropdown-item m-0 px-2" onclick="survey_return_add_click(\''.$project.'\',this,\''.$id.'\',\'Sample\')">Sample</a>
                                </li>  
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
    }

    function get_data_payment_survey($row){ 
        $html_payment = ""; 
        $payment_total = 0;
        if($row->SurveyTotal == 0){
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
            $builder->where('PaymentRef',$row->SurveyId); 
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
                    $bukti = '';
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

                if($row_payment->PaymentType == "Cash"){
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
                        <td class="detail">'.$row_payment->PaymentType.'</td>
                       '. $transfer_to.'
                       '. $transfer_from.' 
                        <td class="detail">'.$bukti.'</td> 
                        <td class="detail">Rp. '.number_format($row_payment->PaymentTotal,0, ',', '.').'</td>
                    </tr>';
                 
            
            }  
             
            if($payment_total == 0){
                $html_payment .= ' <div class="alert alert-warning p-2 m-1" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Belum ada pembayaran yang dibuat dari dokumen ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->SurveyId.',this,\'Survey\')">Ajukan pembayaran</a> 
                    </span>
                </div> '; 
            }else if($payment_total < $row->SurveyTotal){  
                $html_payment = '
                <table class="table detail-payment">
                    <thead>
                        <tr>
                            <th class="detail" style="width:70px">Action</th>
                            <th class="detail">No. Pembayaran</th>
                            <th class="detail">Tanggal</th>
                            <th class="detail">Status</th> 
                            <th class="detail">Tipe</th>
                            <th class="detail">Tujuan</th> 
                            <th class="detail">Sumber</th>
                            <th class="detail">Bukti Transaksi</th>
                            <th class="detail">Total</th>
                        </tr>
                    </thead>
                    <tbody>'.$html_payment.'
                    </tbody>
                </table> 
                <div class="alert alert-warning p-2 m-1" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Masih ada sisa pembayaran yang perlu dibuat dari dokumen ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->SurveyId.',this,\'Survey\')">Ajukan pembayaran</a> 
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
                                <th class="detail">Tipe</th>
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
        return $html_payment;
    }

    


    function insert_data_survey($data){  
        $getnextcode = $this->get_next_code_survey($data["SurveyDate"]);
        $builder = $this->db->table("survey");
        $builder->insert(array(
            "SurveyCode"=>$getnextcode,
            "SurveyDate"=>$data["SurveyDate"],
            "SurveyDate2"=>$data["SurveyDate"],  
            "ProjectId"=>$data["ProjectId"],
            "StoreId"=>$data["StoreId"],
            "CustomerId"=>$data["CustomerId"],
            "SurveyAdmin"=>$data["SurveyAdmin"], 
            "SurveyCustName"=>$data["SurveyCustName"], 
            "SurveyCustTelp"=>$data["SurveyCustTelp"], 
            "SurveyAddress"=>$data["SurveyAddress"], 
            "SurveyTotal"=>$data["SurveyTotal"], 
            "SurveyStaff"=>$data["SurveyStaff"],  
            "SurveyStatus"=>0,
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        )); 
        
        
        if($data["ProjectId"] > 0){ 
            $builder = $this->db->table("project"); 
            $builder->set('ProjectStatus', 1);  
            $builder->where('ProjectId', $data["ProjectId"]); 
            $builder->update();  
        } 

        //create Log action 
        $activityModel = new ActivityModel();
        $activityModel->insert(
            array( 
                "menu"=>"Survey",
                "type"=>"Add",
                "name"=>"Data survey baru ditambahkan dengan nomor ".$getnextcode,
                "desc"=> json_encode($data ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 

            )
        ); 
    } 
    function update_data_survey($id,$data){  
        $dataold = $builder = $this->getWhere(['SurveyId' => $id], 1)->getRow(); 
        $builder = $this->db->table("survey"); 
        $builder->set('SurveyDate', $data["SurveyDate"]);   
        $builder->set('ProjectId', $data["ProjectId"]);  
        $builder->set('CustomerId', $data["CustomerId"]);  
        $builder->set('StoreId', $data["StoreId"]);  
        $builder->set('SurveyAdmin', $data["SurveyAdmin"]);  
        $builder->set('SurveyCustName', $data["SurveyCustName"]);  
        $builder->set('SurveyCustTelp', $data["SurveyCustTelp"]);  
        $builder->set('SurveyAddress', $data["SurveyAddress"]);  
        $builder->set('SurveyTotal', $data["SurveyTotal"]);  
        $builder->set('SurveyStaff', $data["SurveyStaff"]);   
        $builder->set('updated_user', user()->id);  
        $builder->set('updated_at', new RawSql('CURRENT_TIMESTAMP()'));   
        $builder->where('SurveyId', $id); 
        $builder->update();  

        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Survey",
                "type"=>"Edit",
                "name"=>"Data survey diubah dengan nomor ".$data["SurveyCode"],
                "desc"=> json_encode(array("new"=>$data,"old" => $dataold) ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 

            )
        ); 
    } 
    function delete_data_survey($id){   
        $dataold = $builder = $this->getWhere(['SurveyId' => $id], 1)->getRow();  
        $builder = $this->db->table("survey"); 
        $builder->set('SurveyStatus', 3);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SurveyId', $id); 
        $builder->update();   

        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Survey",
                "type"=>"Status",
                "name"=>"Data survey dibatalkan dengan nomor ".$dataold->SurveyCode,
                "desc"=> json_encode([]),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

        return JSON_ENCODE(array("status"=>true));
    }  
    function update_status_survey($id,$status){   
        $dataold = $builder = $this->getWhere(['SurveyId' => $id], 1)->getRow();  

        $builder = $this->db->table("survey"); 
        $builder->set('SurveyStatus', $status);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SurveyId', $id); 
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
                "menu"=>"Survey",
                "type"=>"Status",
                "name"=> "Status Data survey diubah dari ".$statuslist[$dataold->SurveyStatus]." menjadi ".$statuslist[$status] . " dengan nomor ".$dataold->SurveyCode,
                "desc"=> json_encode([]),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

        return JSON_ENCODE(array("status"=>true));
    }  
    function insert_data_survey_finish($id,$data,$data1){   
        $dataold = $builder = $this->getWhere(['SurveyId' => $id], 1)->getRow();  
        $builder = $this->db->table("survey_finish");
        $builder->insert(array(
            "SurveyFinishDelta"=>$data1["delta"],
            "SurveyFinishDetail"=>$data1["html"],
            "SurveyId"=>$id,  
        )); 


        $builder = $this->db->table("survey");  
        $builder->where('SurveyId', $id); 
        $status = $builder->get()->getRow();
        if($status->SurveyStatus < 2){ 
            $builder = $this->db->table("survey");  
            $builder->set('SurveyStatus', 1); 
            $builder->where('SurveyId', $id); 
            $builder->update();  
        }
        
        $folder_utama = 'assets/images/survey'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        
        $folder_utama = 'assets/images/survey/'.$id; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 

        //hapus semua file di folder id tersebut
        if (is_dir($folder_utama)) {
            $files = scandir($folder_utama);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    unlink($folder_utama."/" . $file);
                }
            }  
        }
        if ($data) { 
            foreach ($data['files'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = time() . '_' . $file->getName();
                    $file->move($folder_utama, $newName); 
                } else { 

                }
            } 

        }
 
        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Survey Finish",
                "type"=>"Add",
                "name"=> "hasil Survey baru ditambahkan dan data Survey diubah statusnya menjadi proses" ,
                "desc"=> json_encode($data1 ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 
        
        $this->update_status_survey($id,1);
        return JSON_ENCODE(array("status"=>true)); 
    } 
    function update_data_survey_finish_file($id,$data,$data1){    
        $builder = $this->db->table("survey_finish");   
        $builder->where('SurveyId', $id);    
        $dataold = $builder->get()->getRow(); 
 
        $builder = $this->db->table("survey_finish");
        $builder->set('SurveyFinishDelta', $data1["delta"]);   
        $builder->set('SurveyFinishDetail', $data1["html"]);    
        $builder->where('SurveyId', $id);    
        $builder->update();   

        $folder_utama = 'assets/images/survey'; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        } 
        
        $folder_utama = 'assets/images/survey/'.$id; 
        if (!file_exists($folder_utama)) {
            mkdir($folder_utama, 0777, true);  
        }  ;
        //hapus file yang eksis
        $array = json_decode($data1["remove_file"], true);
        $datasdas = [];
        foreach ( $array  as $file) { 
            unlink($folder_utama.'/' .$file['name']);
        }
        if ($data) { 
            foreach ($data['files'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = time() . '_' . $file->getName();
                    $file->move($folder_utama, $newName); 
                }
            } 

        }
        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Survey Finish",
                "type"=>"Edit",
                "name"=> "hasil Survey diubah" ,
                "desc"=> json_encode(array("new"=>$data1,"old" => $dataold) ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 
         
        return JSON_ENCODE(array("status"=>true)); 
    }



    function get_next_code_survey($date){
        $arr_date = explode("-", $date);
        $builder = $this->db->table("survey");  
        $builder->select("ifnull(max(SUBSTRING(SurveyCode,5,3)),0) + 1 as nextcode");
        $builder->where("month(SurveyDate2)",$arr_date[1]);
        $builder->where("year(SurveyDate2)",$arr_date[0]);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "SVY/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "SVY/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "SVY/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "SVY/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    } 

    function get_data_survey($id){
        $builder = $this->db->table("survey"); 
        $builder->join("project","project.ProjectId = survey.ProjectId","left");
        $builder->join("customer","survey.CustomerId = customer.CustomerId","left"); 
        $builder->join("store","survey.StoreId = store.StoreId","left"); 
        $builder->join("users","users.id = survey.SurveyAdmin","left"); 
        $builder->where('SurveyId',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    } 
    function get_data_survey_staff($staff){ 
        $arrayData = explode("|", $staff);
        $builder = $this->db->table("users");  
        $builder->whereIn('id',$arrayData); 
        return $builder->get()->getResult();  
    } 
    function get_data_survey_finish($id){
        $builder = $this->db->table("survey_finish"); 
        $builder->join("survey","survey.SurveyId = survey_finish.SurveyId","left"); 
        $builder->where('SurveyFinishId',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    }
    function update_data_survey_status($id){ 
        $builder = $this->db->table("survey");  
        $builder->where('SurveyId',$id);
        $result = $builder->get()->getRow();  
        //status direct
  
        // Penawaran 
        $surveydirect = 0; 
        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->where('SphRef',$result->SurveyId); 
        $builder->where('SphRefType',"Survey"); 
        $builder->where('SphStatus <',"2"); 
        $builder->orderBy('SphStatus', 'ASC');
        $builder->orderBy('SphDate', 'ASC');
        $queryref = $builder->get()->getRow();  
        if($queryref){ 
            $surveydirect = 1;   
        }else{ 
            // SAMPLE
            $builder = $this->db->table("sample");
            $builder->select('*');
            $builder->where('SampleRef',$result->SurveyId); 
            $builder->where('SampleRefType',"Survey"); 
            $builder->orderby('SampleId', 'DESC'); 
            $queryref = $builder->get()->getRow();   
            if($queryref){ 
                $surveydirect = 1;   
            }else{  
                // INVOICE
                $builder = $this->db->table("invoice");
                $builder->select('*');
                $builder->where('InvRef',$result->SurveyId); 
                $builder->where('InvRefType',"Survey");  
                $builder->orderby('InvId', 'DESC'); 
                $queryref = $builder->get()->getRow();   
                if($queryref){
                    $surveydirect = 1;    
                }
            }
        }  

        //status Hasil
        $surveyfinish = 0; 
        $builder = $this->db->table("survey_finish");  
        $builder->where('SurveyId',$id); 
        $results = $builder->get()->getRow();  
        if($results) $surveyfinish = 1;  
         
        if(($surveydirect == 1 && $surveyfinish == 1 )){
            $builder = $this->db->table("survey"); 
            $builder->set('surveyStatus', 2); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SurveyId', $id); 
            $builder->update();  
        } else if(($surveydirect == 1 || $surveyfinish == 1 )){ 
            $builder = $this->db->table("survey"); 
            $builder->set('surveyStatus', 1); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SurveyId', $id); 
            $builder->update();   
        }else{
            $builder = $this->db->table("survey"); 
            $builder->set('surveyStatus', 0); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SurveyId', $id); 
            $builder->update();  
        }  

        return $surveydirect. " | ".$surveyfinish; 
    }

}