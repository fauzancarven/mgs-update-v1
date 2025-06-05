<?php

namespace App\Models; 

use CodeIgniter\Model;  
use CodeIgniter\Database\RawSql;

class ProjectinvoiceModel extends Model
{  
    protected $DBGroup = 'default';
    protected $table = 'invoice';

    function load_datatable_project_invoice($filter = null){
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();
        
        $builder = $this->db->table("invoice");
        $builder->join("project","project.ProjectId = invoice.ProjectId ","left");  
        $builder->join("users","users.id = invoice.InvAdmin ","left"); 
        $builder->join("store","store.StoreId = project.StoreId","left");  
        if($filter["datestart"]){
            $builder->where("InvDate >=",$filter["datestart"]);
            $builder->where("InvDate <=",$filter["dateend"]); 
        }

        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();
        if(isset($filter["filter"])){ 
            $builder->whereIn("InvStatus",$filter["filter"]); 
            $filterdata = 1;
        } 
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("ProjectName",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("InvAddress",$filter["search"]);
            $builder->orLike("InvCode",$filter["search"]);
            $builder->groupEnd();  
            $filterdata = 1;
        }

        // Order TAble
        $columns = array(
            0 => null, // kolom action tidak dapat diurutkan
            1 => null, // kolom action tidak dapat diurutkan
            2 => "InvCode", // kolom name
            3 => "InvDate", // kolom action tidak dapat diurutkan
            4 => "InvStatus", // kolom image tidak dapat diurutkan
            5 => "InvAdmin", // kolom action tidak dapat diurutkan
            6 => "InvCustName", // kolom action tidak dapat diurutkan
            7 => null, // kolom action tidak dapat diurutkan
            8 => null, // kolom action tidak dapat diurutkan
            9 => "InvGrandTotal", // kolom action tidak dapat diurutkan 
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
            // Mengambil detail item
            $detail = array();
            $models = new ProjectModel();
            $modelsproduk = new ProdukModel();
            $arr_detail = $models->get_data_invoice_detail($row->InvId);
            foreach($arr_detail as $row_data){
                $detail[] = array(
                            "id" => $row_data->ProdukId,  
                            "produkid" => $row_data->ProdukId, 
                            "satuan_id"=> ($row_data->InvDetailSatuanId == 0 ? "" : $row_data->InvDetailSatuanId),
                            "satuan_text"=>$row_data->InvDetailSatuanText,  
                            "price"=>$row_data->InvDetailPrice,
                            "varian"=> JSON_DECODE($row_data->InvDetailVarian,true),
                            "total"=> $row_data->InvDetailTotal,
                            "disc"=> $row_data->InvDetailDisc,
                            "qty"=> $row_data->InvDetailQty,
                            "text"=> $row_data->InvDetailText,
                            "group"=> $row_data->InvDetailGroup,
                            "type"=> $row_data->InvDetailType,
                            "image_url"=> $modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->InvDetailVarian,true)
                        );
            };

            $payment = '';
            $payment_detail = "";
            if($row->InvGrandTotal == 0){
                $payment = ' 
                        <span class="text-head-3 pointer payment">
                            <span class="badge text-bg-success me-1">Tidak ada</span>
                        </span> ';
                $payment_detail = '<div class="text-head-3 p-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran yang harus diselesaikan untuk transaksi ini 
                </div>';
            }
            $delivery = '';
            $delivery_detail = "";
            if($row->InvDelivery == 0){
                $delivery = ' 
                        <span class="text-head-3 pointer delivery">
                            <span class="badge text-bg-success me-1">Tidak ada</span>
                        </span>';
                $delivery_detail = '<div class="text-head-3 p-2">
                        <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                        Mode pengriman tidak diaktifkan untuk transaksi ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="sample_project_update_delivery(21,1,this,1)">aktifkan mode Pengiriman</a>
                    </div>';
            }
            
            $status = "";
            if($row->InvStatus==0){
                $status .= ' 
                        <span class="text-head-3">
                            <span class="badge text-bg-primary me-1">New</span> 
                        </span>  ';
            }
            if($row->InvStatus==1){
                $status .= ' 
                        <span class="text-head-3">
                            <span class="badge text-bg-info me-1">Proses</span> 
                        </span>  ';
            }
            if($row->InvStatus==2){
                $status .= '  
                        <span class="text-head-3">
                            <span class="badge text-bg-success me-1">Completed</span>
                            <span class="text-primary pointer d-none" onclick="update_status_survey(1,'.$row->InvId.')"><i class="fa-solid fa-pen-to-square"></i></span>
                        </span> ';
            }
            if($row->InvStatus==3){
                $status .= '   <span class="badge text-bg-danger me-1">Cancel</span>  '; 
            } 

            $data_row = array( 
                "invoice" => $row,
                "code" => $row->InvCode,
                "date" => date_format(date_create($row->InvDate),"d M Y"), 
                "status" => $status,
                "admin" => ucwords($row->username), 
                "total" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->InvGrandTotal,0)."</span></div>", 
                "delivery" => $delivery,
                "deliverydetail" => $delivery_detail,
                "payment" => $payment,
                "paymentdetail" => $payment_detail,
                "customer" => $row->InvCustName,
                "customer" => $row->InvCustName,
                "customertelp" => ($row->InvCustTelp ? $row->InvCustTelp : ""),
                "customeraddress" => $row->InvAddress,
                "detail" => $detail,
                // "detail" => '  <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1"><div class="col bg-light ms-4 me-2 py-2">'.$html_items.'</div></div>',
                "action" =>'  
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="print_project_Survey('.$row->ProjectId.','.$row->InvId.',this)"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="edit_project_Survey('.$row->ProjectId.','.$row->InvId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Penawaran" onclick="delete_project_Survey('.$row->ProjectId.','.$row->InvId.',this)"><i class="fa-solid fa-circle-xmark"></i></span>
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