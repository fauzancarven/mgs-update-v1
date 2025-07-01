<?php

namespace App\Models; 

use CodeIgniter\Model; 
use CodeIgniter\Database\RawSql; 
use App\Models\ActivityModel;

class AccountingModel extends Model
{  
    function get_data_request_payment($filter = null){
        $modelsproduk = new ProdukModel();
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();

        $subquery = "(SELECT 
        a.*,
        CASE 
            WHEN PaymentRefType = '-' THEN '0' 
            WHEN PaymentRefType = 'Survey' THEN (select StoreId from survey where SurveyId = PaymentRef) 
            WHEN PaymentRefType = 'Sample' THEN (select StoreId from sample where SampleId = PaymentRef) 
            WHEN PaymentRefType = 'Pembelian' THEN (select StoreId from pembelian where POId = PaymentRef) 
            WHEN PaymentRefType = 'Pengiriman' THEN (select StoreId from delivery where DeliveryId = PaymentRef) 
            WHEN PaymentRefType = 'Invoice' THEN (select StoreId from invoice where InvId = PaymentRef) 
        END AS StoreIdCalc,
        CASE 
            WHEN PaymentRefType = '-' THEN 'No data Selected' 
            WHEN PaymentRefType = 'Survey' THEN (select SurveyCode from survey where SurveyId = PaymentRef) 
            WHEN PaymentRefType = 'Sample' THEN (select SampleCode from sample where SampleId = PaymentRef) 
            WHEN PaymentRefType = 'Pembelian' THEN (select POCode from pembelian where POId = PaymentRef) 
            WHEN PaymentRefType = 'Pengiriman' THEN (select DeliveryCode from delivery where DeliveryId = PaymentRef) 
            WHEN PaymentRefType = 'Invoice' THEN (select InvCode from invoice where InvId = PaymentRef) 
        END AS PaymentRefCode,
        CASE 
            WHEN PaymentRefType = '-' THEN 'No data Selected' 
            WHEN PaymentRefType = 'Survey' THEN (select SurveyDate from survey where SurveyId = PaymentRef) 
            WHEN PaymentRefType = 'Sample' THEN (select SampleDate from sample where SampleId = PaymentRef) 
            WHEN PaymentRefType = 'Pembelian' THEN (select PODate from pembelian where POId = PaymentRef) 
            WHEN PaymentRefType = 'Pengiriman' THEN (select DeliveryDate from delivery where DeliveryId = PaymentRef) 
            WHEN PaymentRefType = 'Invoice' THEN (select InvDate from invoice where InvId = PaymentRef) 
        END AS PaymentRefDate
        FROM payment a) AS subquery";

        $builder = $this->db->table($subquery);
        $builder->select("*, PaymentRefCode, PaymentRefDate");
        $builder->join("users","users.id = subquery.created_user ","left");
        $builder->join("store","store.StoreId = subquery.StoreIdCalc","left"); 
        $builder->where("PaymentStatus",0); 
        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();
        
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("username",$filter["search"]); 
            $builder->orLike("PaymentDate",$filter["search"]);
            $builder->orLike("StoreCode",$filter["search"]); 
            $builder->groupEnd();  
            $filterdata = 1;
        }
        $datafilter = clone $builder;  
        $count = $datafilter->get()->getNumRows();

        $builder->limit($length,$start); 
        $query = $builder->get();  
        foreach($query->getResult() as $row){
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
            if($row->PaymentRefType=="Invoice"){
                $tipe = '<i class="fa-solid fa-right-to-bracket text-success fa-2x"></i>';
                $status = '<span class="badge text-bg-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Approval">Menunggu Approval</span>';

                $desc = "-";
                $folder_utama = 'assets/images/payment/'.$row->PaymentRefType.'/'.$row->PaymentRef.'/sumber'; 
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
                        $desc = '  
                                                <a onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'">
                                                    <i class="fa-solid fa-eye"></i> Lihat bukti
                                                </a>  ';
                    }
                }   
            }else{
                $tipe = '<i class="fa-solid fa-right-from-bracket text-danger fa-2x"></i>';
                $status = '<span class="badge text-bg-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Pembayaran">Menunggu Pembayaran</span>';
                
                $desc = "-";
                if($row->PaymentMethod == "Cash"){
                    $desc = ' 
                    <td class="detail">  
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row->PaymentToName.'</div>
                    </td>';
                }else{ 
                    $desc = ' 
                    <td class="detail">  
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-building-columns" style="width:20px"></i>'.$row->PaymentToBank.'</div>
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-credit-card" style="width:20px"></i>'.$row->PaymentToRek.'</div>
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row->PaymentToName.'</div>
                    </td>';
                }

            }
            $data_row = array( 
                "tipe" => $tipe,
                "store" => $store,
                "referensi" => $row->PaymentRefType.'<div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
                    <a class="text-detail-3 pointer text-decoration-underline text-secondary">'.$row->PaymentRefCode.'</a>
                </div>
                <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
                    <a class="text-detail-3 text-decoration-none text-secondary">'.$row->PaymentRefDate.'</a>
                </div>',  
                "document" => $row->PaymentCode.'
                <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
                    <a class="text-detail-3 text-decoration-none text-secondary">'.$row->PaymentType.'</a>
                </div>
                <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
                    <a class="text-detail-3 text-decoration-none text-secondary">'.$row->PaymentDate.'</a>
                </div>',
                "status" =>$status, 
                "admin" => ucwords($row->username),  
                "desc" => $desc,
                "total" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->PaymentTotal,0)."</span></div>",
                "action" =>'  
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Form Survey" onclick="print_survey('.$row->PaymentId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Survey" onclick="edit_survey('.$row->PaymentId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Survey" onclick="delete_survey('.$row->PaymentId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-circle-xmark"></i></span>
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
}