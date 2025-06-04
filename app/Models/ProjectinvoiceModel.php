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
            1 => "InvCode", // kolom name
            2 => "InvDate", // kolom action tidak dapat diurutkan
            3 => "InvStatus", // kolom image tidak dapat diurutkan
            4 => "InvAdmin", // kolom action tidak dapat diurutkan
            5 => "InvCustName", // kolom action tidak dapat diurutkan
            6 => null, // kolom action tidak dapat diurutkan
            7 => null, // kolom action tidak dapat diurutkan 
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
            $builder = $this->db->table("invoice_detail");
            $builder->select('*'); 
            $builder->where('InvDetailRef',$row->InvId); 
            $builder->orderby('InvDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A";
            $produkjasa = 0;
            foreach($items as $item){ 
                $arr_varian = json_decode($item->InvDetailVarian);
                $arr_badge = "";
                $arr_no = 0; 
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>'; 
                    $arr_no++;
                }
                $models = new ProdukModel();
                $gambar = $models->getproductimagedatavarian($item->ProdukId,$item->InvDetailVarian,true) ;

                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-4 my-1 varian">   
                        <div class="d-flex gap-2 align-items-center"> 
                            ' . ($item->InvDetailType == "product" ? ($gambar ? "<img src='".$gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url("assets/images/produk/default.png").'?date='.date("Y-m-dH:i:s")."' alt='Gambar Default' >") : "").'  
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase"  '.($item->InvDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->InvDetailText.'</span>
                                <span class="text-detail-2 text-truncate"  '.($item->InvDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->InvDetailGroup.'</span> 
                                <div class="d-flex flex-wrap gap-1">
                                    '.$arr_badge.'
                                </div>
                            </div> 
                        </div>
                    </div>';

                    
                if($item->InvDetailType == "product"){
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail">
                                        <div class="row"> 
                                            <div class="col-6 col-md-2">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->InvDetailQty, 2, ',', '.').' '.$item->InvDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Harga Satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->InvDetailPrice, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Disc Satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->InvDetailDisc, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Total:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->InvDetailTotal, 0, ',', '.').'</span>
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
                if($item->ProdukId > 0) $produkjasa = 1;
                
            }
            
            $status = "";
            if($row->InvStatus==0){
                $status .= ' 
                        <span class="text-head-3">
                            <span class="badge text-bg-primary me-1">Baru</span> 
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
                            <span class="badge text-bg-success me-1">Selesai</span>
                            <span class="text-primary pointer d-none" onclick="update_status_survey(1,'.$row->InvId.')"><i class="fa-solid fa-pen-to-square"></i></span>
                        </span> ';
            }
            if($row->InvStatus==3){
                $status .= '   <span class="badge text-bg-danger me-1">Batal</span>  '; 
            } 

            $data_row = array( 
                "code" => $row->InvCode,
                "date" => $row->InvDate,
                "status" => $status,
                "admin" => $row->username, 
                "total" => number_format($row->InvGrandTotal,0),
                "customer" => $row->InvCustName,
                "detail" => '  <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1"><div class="col bg-light ms-4 me-2 py-2">'.$html_items.'</div></div>',
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