<?php

namespace App\Models; 

use CodeIgniter\Model;  
use CodeIgniter\Database\RawSql;
use App\Models\ProdukModel; 
use App\Models\ActivityModel;
use App\Models\DeliveryModel; 

class InvoiceModel extends Model
{  
    protected $DBGroup = 'default';
    protected $table = 'invoice';
    function getTerbilang($number) {
        $terbilang = array(
            1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima',
            6 => 'Enam', 7 => 'Tujuh', 8 => 'Delapan', 9 => 'Sembilan', 10 => 'Sepuluh',
            11 => 'Sebelas', 12 => 'Dua Belas', 13 => 'Tiga Belas', 14 => 'Empat Belas', 15 => 'Lima Belas',
            16 => 'Enam Belas', 17 => 'Tujuh Belas', 18 => 'Delapan Belas', 19 => 'Sembilan Belas', 20 => 'Dua Puluh',
            30 => 'Tiga Puluh', 40 => 'Empat Puluh', 50 => 'Lima Puluh', 60 => 'Enam Puluh',
            70 => 'Tujuh Puluh', 80 => 'Delapan Puluh', 90 => 'Sembilan Puluh', 100 => 'Seratus'
        );

        if ($number < 20 || $number == 100) {
            return $terbilang[$number];
        } elseif ($number < 100) {
            $puluh = floor($number / 10) * 10;
            $sisa = $number % 10;
            if ($sisa > 0) {
                return $terbilang[$puluh] . ' ' . $terbilang[$sisa];
            } else {
                return $terbilang[$puluh];
            }
        } elseif ($number < 1000) {
            $ratus = floor($number / 100);
            $sisa = $number % 100;
            if ($sisa > 0) {
                if ($ratus == 1) {
                    return 'Seratus ' . getTerbilang($sisa);
                } else {
                    return $terbilang[$ratus] . ' Ratus ' . getTerbilang($sisa);
                }
            } else {
                if ($ratus == 1) {
                    return 'Seratus';
                } else {
                    return $terbilang[$ratus] . ' Ratus';
                }
            }
        } elseif ($number < 1000000) {
            $ribu = floor($number / 1000);
            $sisa = $number % 1000;
            if ($sisa > 0) {
                if ($ribu == 1) {
                    return 'Seribu ' . getTerbilang($sisa);
                } else {
                    return getTerbilang($ribu) . ' Ribu ' . getTerbilang($sisa);
                }
            } else {
                if ($ribu == 1) {
                    return 'Seribu';
                } else {
                    return getTerbilang($ribu) . ' Ribu';
                }
            }
        } elseif ($number < 1000000000) {
            $juta = floor($number / 1000000);
            $sisa = $number % 1000000;
            if ($sisa > 0) {
                if ($juta == 1) {
                    return 'Satu Juta ' . getTerbilang($sisa);
                } else {
                    return getTerbilang($juta) . ' Juta ' . getTerbilang($sisa);
                }
            } else {
                if ($juta == 1) {
                    return 'Satu Juta';
                } else {
                    return getTerbilang($juta) . ' Juta';
                }
            }
        }
    }
    function load_datatable_invoice($filter = null){
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
        $builder->join("store","store.StoreId = invoice.StoreId","left");  
        if($filter["datestart"]){
            $builder->where("InvDate >=",$filter["datestart"]);
            $builder->where("InvDate <=",$filter["dateend"]); 
        }

        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows(); 

        if(isset($filter["filter"])){ 
            $builder->whereIn("SphStatus",$filter["filter"]); 
            $filterdata = 1;
        } 
        if(isset($filter["store"])){ 
            $builder->whereIn("invoice.StoreId",$filter["store"]); 
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
            2 => "StoreCode", // kolom name
            3 => "InvCode", // kolom name
            4 => "InvDate", // kolom action tidak dapat diurutkan
            5 => "InvStatus", // kolom image tidak dapat diurutkan
            6 => "InvAdmin", // kolom action tidak dapat diurutkan
            7 => "InvCustName", // kolom action tidak dapat diurutkan
            8 => null, // kolom action tidak dapat diurutkan
            9 => null, // kolom action tidak dapat diurutkan
            10 => "InvGrandTotal", // kolom action tidak dapat diurutkan 
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
            if($row->InvStatus==0){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-primary text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >New</span>
                    </span> '; 
            }
            if($row->InvStatus==1){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-info text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Proses</span>
                    </span> '; 
            }
            if($row->InvStatus==2){
                $status .= '
                    <span class=" pointertext-head-3 badge text-bg-success text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Completed</span>
                    </span> ';  
            }
            if($row->InvStatus==3){
                $status .=  '
                    <span class="pointer text-head-3 badge text-bg-danger text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Cancel</span>
                    </span> ';  
            }
            $status .= '  
            <ul class="dropdown-menu shadow drop-status ">
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(0,'.$row->InvId.',this)">
                        New
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(1,'.$row->InvId.',this)">
                        </i>Proses
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(2,'.$row->InvId.',this)">
                        Completed
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(3,'.$row->InvId.',this)">
                        Cancel
                    </a>
                </li>  
            </ul>';

            // MENGAMBIL DATA Detail  
            $htmldetail = '      
            <div class="view-detail" style="display:none">
                <div class="list-detail pb-3">
                    <div class="text-head-2 py-1">  
                        <span class="fa-stack small">
                            <i class="fa-regular fa-circle fa-stack-2x"></i>
                            <i class="fa-solid fa-table-list fa-stack-1x fa-inverse"></i> 
                        </span>
                        <span>Produk</span>
                    </div> 
                    '.$this->get_data_detail_invoice($row).'
                </div>
                <div class="list-detail pb-3">
                    <div class="text-head-2 py-1"> 
                        <span class="fa-stack small">
                            <i class="fa-regular fa-circle fa-stack-2x"></i>
                            <i class="fa-solid fa-money-bill fa-stack-1x fa-inverse"></i> 
                        </span>
                        <span>Pembayaran</span> 
                    </div> 
                    '.$this->get_data_payment_invoice($row).'
                </div> 
                <div class="list-detail pb-3">
                    <div class="text-head-2 py-1">
                        <span class="fa-stack small">
                            <i class="fa-regular fa-circle fa-stack-2x"></i>
                            <i class="fa-solid fa-truck fa-stack-1x fa-inverse"></i> 
                        </span>
                        <span>Pengiriman</span> 
                    </div> 
                    '.$this->get_data_delivery_invoice($row).'
                </div> 
                <div class="list-detail pb-3">
                    <div class="text-head-2 py-1">
                        <span class="fa-stack small">
                            <i class="fa-regular fa-circle fa-stack-2x"></i>
                            <i class="fa-solid fa-cart-shopping fa-stack-1x fa-inverse"></i> 
                        </span>
                        <span>Pembelian</span> 
                    </div>  
                    
                    '.$this->get_data_pembelian_invoice($row).'
                </div> 
            </div>
            ';

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
                "invoice" => $row,
                "code" => $row->InvCode.$this->get_data_forward_invoice($row->InvRefType,$row->InvRef),
                "date" => date_format(date_create($row->InvDate),"d M Y"), 
                "status" => $status,
                "admin" => ucwords($row->username), 
                "total" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->InvGrandTotal,0)."</span></div>", 
                "delivery" => $this->get_data_delivery_invoice($row,true), 
                "payment" => $this->get_data_payment_invoice($row,true), 
                "pembelian" => $this->get_data_pembelian_invoice($row,true), 
                "paymenttotal" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->InvGrandTotal - $this->get_data_payment_invoice($row,true,true),0)."</span></div>", 
                "customer" => $row->InvCustName, 
                "customertelp" => ($row->InvCustTelp ? $row->InvCustTelp : ""),
                "customeraddress" => $row->InvAddress, 
                "store"=>$store,
                "detail" => $htmldetail,
                // "detail" => '  <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1"><div class="col bg-light ms-4 me-2 py-2">'.$html_items.'</div></div>',
                "action" =>'  
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Data Invoice" onclick="print_invoice('.$row->InvId.',this,'.$row->ProjectId.')"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Invoice" onclick="edit_invoice('.$row->InvId.',this,'.$row->ProjectId.')"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Invoice" onclick="delete_invoice('.$row->InvId.',this,'.$row->ProjectId.')"><i class="fa-solid fa-circle-xmark"></i></span>
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

    
    function get_data_forward_invoice($type = 0,$ref = 0){  
        if($type == "Survey"){
            $builder = $this->db->table("survey");
            $builder->where('SurveyId',$ref); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                return ' <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari survey">
                            <i class="fa-solid fa-street-view text-success"></i>
                            <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="invoice_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SurveyId.'\',\'Penawaran\')">'.$queryref->SurveyCode.'</a>
                        </div>';  
            }
        }  
        if($type == "Penawaran"){
            $builder = $this->db->table("penawaran");
            $builder->where('SphId',$ref); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                return ' <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari Survey">
                            <i class="fa-solid fa-hand-holding-droplet text-success"></i>
                            <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="invoice_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SphId.'\',\'Penawaran\')">'.$queryref->SphCode.'</a>
                        </div>'; 
            }
        } 
        if($type == "Sample"){
            $builder = $this->db->table("sample");
            $builder->where('SampleId',$ref); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                return ' <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari Survey">
                            <i class="fa-solid fa-hand-holding-droplet text-success"></i>
                            <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="invoice_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SampleId.'\',\'Penawaran\')">'.$queryref->SampleCode.'</a>
                        </div>'; 
            }
        } 
        return '<div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
            <a class="text-detail-3 pointer text-decoration-underline text-secondary">Tidak ada referensi</a>
        </div>'; 
    }
    function get_data_detail_invoice($row){ 
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
        $arr_detail = $this->get_data_invoice_detail($row->InvId);
        foreach($arr_detail as $row_data){
            $arr_varian = json_decode($row_data->InvDetailVarian);
            $arr_badge = "";
            $arr_no = 0;
            foreach($arr_varian as $varian){
                $arr_badge .= '<span class="badge badge-sm badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                $arr_no++;
            }
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

            $detailhtml .= ' <tr>
                    <td class="detail">
                        <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->InvDetailVarian,true).'" alt="Gambar" class="image-produk">
                    </td>
                    <td class="detail">
                        <span class="text-head-3">'.$row_data->InvDetailText.'</span><br>
                        <span class="text-detail-2 text-truncate">'.$row_data->InvDetailGroup.'</span> 
                        <div class="d-flex gap-1 flex-wrap">'.$arr_badge.'</div>
                    </td>
                    <td class="detail">'.number_format($row_data->InvDetailQty, 2, ',', '.').' '.$row_data->InvDetailSatuanText.'</td>
                    <td class="detail">Rp. '.number_format($row_data->InvDetailPrice, 0, ',', '.').'</td>
                    <td class="detail">Rp. '.number_format($row_data->InvDetailDisc, 0, ',', '.').'</td>
                    <td class="detail">Rp. '.number_format($row_data->InvDetailTotal, 0, ',', '.').'</td>
                </tr> ';
        };
        $detailhtml .= '
        </tbody>
        <tfoot>
            <tr>
                <th class="bg-light" colspan="6">
                    <div class="d-flex m-1 gap-2 align-items-center justify-content-end pe-4"> 
                        <span class="text-detail-2">Sub Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->InvSubTotal,0,',','.').'</span>  
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Disc Item:</span>
                        <span class="text-head-2">Rp. '.number_format($row->InvDiscItemTotal,0,',','.').'</span>   
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Disc Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->InvDiscTotal,0,',','.').'</span>   
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Pengiriman:</span>
                        <span class="text-head-2">Rp. '.number_format($row->InvDeliveryTotal,0,',','.').'</span> 
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Grand Total:</span>
                        <span class="text-head-2">Rp.'.number_format($row->InvGrandTotal,0,',','.').'</span> 
                    </div>
                </th>
            </tr> 
        </tfoot>
        </table>';

        return $detailhtml; 
    } 
    function get_data_delivery_invoice($row,$header = false){
        $delivery = "";
        $delivery_detail = "";
        if($row->InvDelivery == 0){
            $delivery = ' 
            <span class="fa-stack small">
                <i class="fa-regular fa-circle fa-stack-2x text-success"></i>
                <i class="fa-solid fa-truck fa-stack-1x fa-inverse"></i> 
            </span>';
            $delivery_detail = '<div class="text-head-3 p-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Mode pengriman tidak diaktifkan untuk transaksi ini, 
                    <a class="text-head-3 text-primary" style="cursor:pointer" onclick="update_invoice_delivery('.$row->InvId.',this,1)">aktifkan mode Pengiriman</a>
                </div>';
        }else{
            $modelsproduk = new ProdukModel();
            $modelsDelivery = new DeliveryModel();
            $builder = $this->db->table("delivery");
            $builder->select('*');    
            $builder->join("users","users.id = delivery.created_user ","left"); 
            $builder->where('DeliveryRef',$row->InvId); 
            $builder->where('DeliveryRefType',"Invoice");  
            $builder->where('DeliveryStatus <',"3"); 
           
            $builder->orderby('DeliveryId', 'ASC'); 
            $delivery = $builder->get()->getResult(); 
            foreach($delivery as $row_delivery){
                
                $delivery_detail .= '<tr class="dt-hasChild">
                <td class="detail ">
                    <a class="pointer text-head-3 btn-detail-delivery" data-id="'.$row_delivery->DeliveryId.'"><i class="fa-solid fa-chevron-right"></i></a>
                </td> 
                <td class="detail action-td" style="width:70px"> 
                    <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Data pengiriman" onclick="print_delivery('.$row_delivery->DeliveryId.',this,'.$row_delivery->ProjectId.')"><i class="fa-solid fa-print"></i></span>  
                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Sampel Barang" onclick="edit_invoice_delivery('.$row_delivery->DeliveryId.',this,'.$row_delivery->ProjectId.')"><i class="fa-solid fa-pen-to-square"></i></span>
                    <div class="d-inline ">
                        <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Sampel Barang" onclick="delete_project_Sample(114,3,this)"><i class="fa-solid fa-circle-xmark"></i></span>
                    </div>
                </td> 
                <td class="detail" style="width:125px"> 
                    <div class="d-flex align-items-center ">  
                        <div class="flex-grow-1 ms-1">
                            <div class="d-flex flex-column"> 
                                <span class="text-head-3 d-flex gap-0 align-items-center"><img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">'.$row->StoreCode.'</span>
                                <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1">'.$row->StoreName.'</span>  
                                <span class="pointer text-head-3 pt-1 d-none">
                                    <span class="me-1 badge text-bg-info text-head-3">Proses</span>
                                </span>
                            </div>   
                        </div>
                    </div>
                </td>
                <td class="detail" style="width:125px"> 
                    '.$row_delivery->DeliveryCode.' 
                    <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari Invoice">
                        <i class="fa-solid fa-money-bill text-success"></i>
                        <a class="text-detail-3 pointer text-decoration-underline text-success">'.$row->InvCode.'</a>
                    </div>  
                </td>
                <td class="detail">'.date_format(date_create($row_delivery->DeliveryDate),"d M Y").'</td>  
                <td class="detail">'.$row_delivery->DeliveryRitase.' ('.$this->getTerbilang($row_delivery->DeliveryRitase).')</td> 
                <td class="detail">'.$row_delivery->DeliveryArmada.'</td> 
                <td class="detail"> 
                    <div class="text-head-3 pb-2">'.$row_delivery->DeliveryFromName.'</div> 
                    <div class="text-detail-3 pb-1"><i class="fa-solid fa-phone pe-1"></i>'.$row_delivery->DeliveryFromTelp.'</div>
                    <div class="text-detail-3 text-truncate" style="max-width: 10rem;line-height: 1.2;" data-bs-toggle="tooltip" data-bs-title="'.$row_delivery->DeliveryFromAddress.'"><i class="fa-solid fa-location-dot pe-1"></i>'.$row_delivery->DeliveryFromAddress.'</div>
                </td>
                <td class="detail">  
                    <div class="text-head-3 pb-2">'.$row_delivery->DeliveryToName.'</div> 
                    <div class="text-detail-3 pb-1"><i class="fa-solid fa-phone pe-1"></i>'.$row_delivery->DeliveryToTelp.'</div>
                    <div class="text-detail-3 text-truncate" style="max-width: 10rem;line-height: 1.2;" data-bs-toggle="tooltip" data-bs-title="'.$row_delivery->DeliveryToAddress.'"><i class="fa-solid fa-location-dot pe-1"></i>'.$row_delivery->DeliveryToAddress.'</div>
                </td>
                <td class="detail">Rp. '.number_format($row_delivery->DeliveryTotal,0).'</td>
                </tr> 
                <tr class="child-row delivery d-none" data-id="'.$row_delivery->DeliveryId.'">
                    <td class="detail" colspan="10">
                        <div class="view-detail-1" style="display:none">
                            <div class="list-detail-1 pb-3">
                                <div class="text-head-2 py-1"> 
                                    <span class="fa-stack small">
                                        <i class="fa-regular fa-circle fa-stack-2x"></i>
                                        <i class="fa-solid fa-table-list fa-stack-1x fa-inverse"></i> 
                                    </span>
                                    <span>Produk</span> 
                                </div>  
                                '.$modelsDelivery->get_data_detail_delivery($row_delivery->DeliveryId).'
                            </div>   
                            <div class="list-detail-1 pb-3">
                                <div class="text-head-2 py-1"> 
                                    <span class="fa-stack small">
                                        <i class="fa-regular fa-circle fa-stack-2x"></i>
                                        <i class="fa-solid fa-money-bill fa-stack-1x fa-inverse"></i> 
                                    </span>
                                    <span>Pembayaran</span> 
                                </div>  
                                '.$modelsDelivery->get_data_payment_delivery($row_delivery).'
                            </div>
                            <div class="list-detail-1 pb-3">
                                <div class="text-head-2 py-1"> 
                                    <span class="fa-stack small">
                                        <i class="fa-regular fa-circle fa-stack-2x"></i>
                                        <i class="fa-solid fa-timeline fa-stack-1x fa-inverse"></i> 
                                    </span>
                                    <span>Progess</span> 
                                </div>  
                                '.$modelsDelivery->get_data_status_delivery($row_delivery).'
                            </div>
                        </div>
                    </td>
                </tr>'; 
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
                                            <span class="text-head-3"><a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_project_proses('.$row_delivery->DeliveryId.',this,\''.$row->ProjectId.'\')">Proses Pengiriman</a></span>
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
                                <span class="text-head-3"><a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_project_finish('.$row_delivery->DeliveryId.',this,\''.$row->ProjectId.'\')">Terima Pengiriman</a></span>
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
            } 
            if($delivery_detail == ""){

                $delivery = ' 
                <span class="fa-stack small">
                    <i class="fa-regular fa-circle fa-stack-2x text-secondary"></i>
                    <i class="fa-solid fa-truck fa-stack-1x fa-inverse"></i> 
                </span>';
                $delivery_detail = '<div class="text-head-3 p-2">
                <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                pengriman belum dibuat untuk transaksi ini, 
                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_invoice_delivery('.$row->InvId.',this)">Buat Pengiriman</a> atau 
                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="update_invoice_delivery('.$row->InvId.',this,0)">nonaktifkan mode Pengiriman</a>
            </div>';
            }else{ 
                $delivery = ' 
                <span class="fa-stack small">
                    <i class="fa-regular fa-circle fa-stack-2x text-success"></i>
                    <i class="fa-solid fa-truck fa-stack-1x fa-inverse"></i> 
                </span>';
                $delivery_detail = '<table class="table detail-delivery">
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
                    <tbody>'.$delivery_detail.'
                    </tbody>
                </table>';
            }
        }

        if($header){
            return  $delivery;
        }else{
            return  $delivery_detail;

        }
    }
    function get_data_payment_invoice($row,$header = false,$total = false){
        $html_payment = "";
        $html_payment_detail = "";
        
        $payment_total = 0;
        $performa_total = 0; 
        if($row->InvGrandTotal == 0){
            $html_payment = ' 
                    <span class="fa-stack small">
                        <i class="fa-regular fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-money-bill fa-stack-1x fa-inverse"></i> 
                    </span> ';
            $html_payment_detail = '<div class="text-head-3 p-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran untuk transaksi ini  
                </div>';
        }else{
            $html_payment_list = ""; 
            $html_proforma_list = ""; 
            $payment_total = 0; 
            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->join("users","users.id = payment.created_user ","left"); 
            $builder->join("method","MethodId = PaymentMethod ","left"); 
            $builder->where('PaymentRef',$row->InvId); 
            $builder->where('PaymentRefType',"Invoice");
            $builder->orderby('PaymentDoc', 'ASC'); 
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult();  

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
                                                <a onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'">
                                                    <i class="fa-solid fa-eye"></i> Lihat bukti
                                                </a>  '; 
                        }
                    }
                }   
                if($row_payment->PaymentDoc == 1){
                    $statusdoc = "Invoice";
                    
                    $payment_total += $row_payment->PaymentTotal; 
                } else{
                    
                    $performa_total += $row_payment->PaymentTotal; 
                    $statusdoc = "Proforma";
                }

                if($row_payment->PaymentStatus == "0"){ 
                    $action = '
                    <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak data pembayaran" onclick="print_payment('.$row_payment->PaymentId.',this,\''.$statusdoc .'\')"><i class="fa-solid fa-print"></i></span>
                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah data pembayaran" onclick="edit_payment('.$row_payment->PaymentId.',this,\''.$statusdoc .'\')"><i class="fa-solid fa-pen-to-square"></i></span>
                    <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan data pembayaran" onclick="delete_payment('.$row_payment->PaymentId.',this,\''.$statusdoc .'\')"><i class="fa-solid fa-circle-xmark"></i></span>';
                    $transfer_from = '<td class="detail">-</td>';
                    if($statusdoc == "Invoice"){

                        $status =  '<span class="badge text-bg-info me-1 pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Approval">Menunggu Approval</span>';  
                    }else{
                        
                        $status =  '<span class="badge text-bg-success me-1 pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Success">Success</span>';  
                    }
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

                if($row_payment->PaymentDoc == 1){ 
                    $html_payment_list .= '
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
                }else{
                    $html_proforma_list .= '
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
                
            
            }  
            
            if($payment_total == 0 && $performa_total == 0){
                $html_payment = ' 
                    <span class="fa-stack small">
                        <i class="fa-regular fa-circle fa-stack-2x text-secondary"></i>
                        <i class="fa-solid fa-money-bill fa-stack-1x fa-inverse"></i> 
                    </span> ';
                $html_payment_detail .= ' <div class="d-inline-block alert alert-warning p-2 m-0" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Belum ada pembayaran yang dibuat dari dokumen ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_payment('.$row->InvId.',this,\'Invoice\')">Buat Pembayaran</a> atau 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_payment('.$row->InvId.',this,\'Proforma\')">Buat Proforma</a> 
                    </span>
                </div> '; 
            }else if($payment_total < $row->InvGrandTotal){  
                
                $html_payment = ' 
                <span class="fa-stack small">
                    <i class="fa-regular fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa-solid fa-money-bill fa-stack-1x fa-inverse"></i> 
                </span> ';

                if($html_proforma_list !== ""){
                    $html_proforma_list = '<tr>
                        <td class="detail no-border" colspan="9">List Proforma</td> 
                    </tr>'.$html_proforma_list;
                }
                if($html_payment_list !== ""){
                    $html_payment_list = '<tr>
                        <td class="detail no-border" colspan="9">List Payment</td> 
                    </tr>'.$html_payment_list;
                }
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
                    <tbody>'.$html_proforma_list.''.$html_payment_list.'
                    </tbody>
                </table> 
                <div class="alert alert-warning p-2 m-0" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Masih ada sisa pembayaran yang perlu dibuat dari dokumen ini,  
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_payment('.$row->InvId.',this,\'Invoice\')">Buat Pembayaran</a> atau 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_payment('.$row->InvId.',this,\'Proforma\')">Buat Proforma</a> 
                    </span>
                </div> ';
            } else{   
                
                $html_payment = ' 
                <span class="fa-stack small">
                    <i class="fa-regular fa-circle fa-stack-2x text-success"></i>
                    <i class="fa-solid fa-money-bill fa-stack-1x fa-inverse"></i> 
                </span> ';


                        
                if($html_proforma_list !== ""){
                    $html_proforma_list = '<tr>
                        <td class="detail no-border" colspan="9">Proforma</td> 
                    </tr>'.$html_proforma_list;
                }
                if($html_payment_list !== ""){
                    $html_payment_list = '<tr>
                        <td class="detail no-border" colspan="9">Payment</td> 
                    </tr>'.$html_payment_list;
                }
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
                        <tbody>'.$html_proforma_list.''.$html_payment_list.'
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
    function get_data_pembelian_invoice($row,$header = false){ 
        $pembelian = '';
        $pembelian_detail = '';


        $modelsproduk = new ProdukModel();
        $modelspembelian = new PembelianModel();
        $builder = $this->db->table("pembelian"); 
        $builder->join("vendor","vendor.VendorId = pembelian.VendorId ","left"); 
        $builder->join("store","store.StoreId = pembelian.StoreId","left");   
        $builder->where('PORef',$row->InvId); 
        $builder->where('PORefType',"Invoice");  
        $builder->where('POStatus <',"3"); 
        $builder->orderby('POId', 'ASC'); 
        $datapo = $builder->get()->getResult(); 
        foreach($datapo as $row_po){ 
            $status = "";
            if($row_po->POStatus==0){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-primary text-head-3">
                        <span class="me-1 " >New</span>
                    </span> ';
            }
            if($row_po->POStatus==1){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-info text-head-3">
                        <span class="me-1 " >Proses</span>
                    </span> '; 
            }
            if($row_po->POStatus==2){ 
                $status .= '
                    <span class=" pointertext-head-3 badge text-bg-success text-head-3">
                        <span class="me-1 " >Completed</span>
                    </span> ';  
            }
            if($row_po->POStatus==3){ 
                $status .=  '
                    <span class="pointer text-head-3 badge text-bg-danger text-head-3">
                        <span class="me-1 " >Cancel</span>
                    </span> ';  
            }
            $vendor = '<div class="text-head-3 text-wrap pt-2">'.($row_po->VendorId == 0 ? $row_po->NameVendor : $row_po->VendorName).'</div>';

            $pembelian_detail .= '<tr class="dt-hasChild">
            <td class="detail ">
                <a class="pointer text-head-3 btn-detail-delivery" data-id="'.$row_po->POId.'"><i class="fa-solid fa-chevron-right"></i></a>
            </td> 
            <td class="detail action-td" style="width:70px"> 
                <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Data Pemeblian" onclick="print_po('.$row_po->POId.',this,'.$row_po->ProjectId.')"><i class="fa-solid fa-print"></i></span>   
            </td> 
            <td class="detail" style="width:125px"> 
                <div class="d-flex align-items-center ">  
                    <div class="flex-grow-1 ms-1">
                        <div class="d-flex flex-column"> 
                            <span class="text-head-3 d-flex gap-0 align-items-center"><img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">'.$row->StoreCode.'</span>
                            <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1">'.$row->StoreName.'</span>  
                            <span class="pointer text-head-3 pt-1 d-none">
                                <span class="me-1 badge text-bg-info text-head-3">Proses</span>
                            </span>
                        </div>   
                    </div>
                </div>
            </td>
            <td class="detail" style="width:125px"> 
                '.$row_po->POCode.' 
                <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari Invoice">
                    <i class="fa-solid fa-money-bill text-success"></i>
                    <a class="text-detail-3 pointer text-decoration-underline text-success">'.$row->InvCode.'</a>
                </div>  
            </td>
            <td class="detail">'.date_format(date_create($row_po->PODate),"d M Y").'</td>   
            <td class="detail">'.$status.'
            </td> 
            <td class="detail">'.$vendor.'
            </td>
            <td class="detail">Rp. '.number_format($row_po->POGrandTotal,0).'</td>
            </tr> 
            <tr class="child-row delivery d-none" data-id="'.$row_po->POId.'">
                <td class="detail" colspan="10">
                    <div class="view-detail-1" style="display:none">
                        <div class="list-detail-1 pb-3">
                            <div class="text-head-2 py-1"> 
                                <span class="fa-stack small">
                                    <i class="fa-regular fa-circle fa-stack-2x"></i>
                                    <i class="fa-solid fa-table-list fa-stack-1x fa-inverse"></i> 
                                </span>
                                <span>Produk</span> 
                            </div>  
                            '.$modelspembelian->get_data_detail_pembelian($row_po).'
                        </div>   
                        <div class="list-detail-1 pb-3">
                            <div class="text-head-2 py-1"> 
                                <span class="fa-stack small">
                                    <i class="fa-regular fa-circle fa-stack-2x"></i>
                                    <i class="fa-solid fa-money-bill fa-stack-1x fa-inverse"></i> 
                                </span>
                                <span>Pembayaran</span> 
                            </div>  
                            '.$modelspembelian->get_data_payment_pembelian($row_po).'
                        </div>
                        <div class="list-detail-1 pb-3">
                            <div class="text-head-2 py-1"> 
                                <span class="fa-stack small">
                                    <i class="fa-regular fa-circle fa-stack-2x"></i>
                                    <i class="fa-solid fa-truck fa-stack-1x fa-inverse"></i> 
                                </span>
                                <span>Pengiriman</span> 
                            </div>  
                            '.$modelspembelian->get_data_delivery_pembelian($row_po).'
                        </div>
                    </div>
                </td>
            </tr>';  
        } 
        if($pembelian_detail == ""){

            $pembelian = ' 
            <span class="fa-stack small">
                <i class="fa-regular fa-circle fa-stack-2x text-secondary"></i>
                <i class="fa-solid fa-cart-shopping fa-stack-1x fa-inverse"></i> 
            </span>';
            $pembelian_detail .= ' <div class="d-inline-block alert alert-warning p-2 m-0" role="alert">
                <span class="text-head-3">
                    <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                    Belum ada pembelian yang dibuat dari dokumen ini
                </span>
            </div> ';  
        }else{ 
            $pembelian = ' 
            <span class="fa-stack small">
                <i class="fa-regular fa-circle fa-stack-2x text-success"></i>
                <i class="fa-solid fa-cart-shopping fa-stack-1x fa-inverse"></i> 
            </span>';
            $pembelian_detail = '<table class="table detail-delivery">
                <thead>
                    <tr>
                        <th class="detail" style="width:30px"></th>
                        <th class="detail" style="width:70px">Action</th>
                        <th class="detail">Toko</th>
                        <th class="detail">Nomor</th>
                        <th class="detail">Tanggal</th> 
                        <th class="detail">Status</th>
                        <th class="detail">Vendor</th> 
                        <th class="detail">Total</th>
                    </tr>
                </thead>
                <tbody>'.$pembelian_detail.'
                </tbody>
            </table>';
        }
        if($header){
            return  $pembelian;
        }else{
            return  $pembelian_detail;

        }
    }

    function get_data_ref_invoice($refid,$search = null){
        if($refid){
            $querywhere = "ref_join.refid = ".$refid;
        }else{ 
            $querywhere = "";
        } 
        if(isset($data["searchTerm"])){
            $querywhere  .= " and (
                code like '%".$data["searchTerm"]."%' or 
                CustomerTelp like '%".$data["searchTerm"]."%' or 
                CustomerName like '%".$data["searchTerm"]."%' or 
                CustomerAddress like '%".$data["searchTerm"]."%' 
            ) ";
        }else{
            $querywhere .= "";
        }  

        if($querywhere != "") $querywhere = "where ". $querywhere ;
        $querysample = "";
        $querysurvey = "";
        if(isset($data["ref"])){
            if($data["type"]=="Sample"){
                $querysample  = "or SampleId = ".$data["ref"];
            } 
            if($data["type"]=="Survey"){
                $querysurvey  = "or SurveyId = ".$data["ref"];
            }  
        }
        $builder = $this->db->query('SELECT * FROM 
        (
            SELECT 
                SampleId refid, 
                SampleCode as code,
                ProjectId ref,
                SampleDate date,
                "Sample" AS type,
                SampleCustName as CustomerName,
                SampleCustTelp as CustomerTelp,
                SampleAddress as CustomerAddress
                FROM sample where SampleStatus < 2 '.$querysample.'
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
                FROM survey where SurveyStatus < 2 '.$querysurvey.'
            UNION 
            SELECT 
                SphId refid,
                SphCode,
                ProjectId ref,
                SphDate date, 
                "Penawaran",
                SphCustName,
                SphCustTelp,
                SphAddress
                FROM penawaran where SphStatus < 1 '.$querysurvey.'
        ) AS ref_join
        LEFT JOIN project ON project.ProjectId = ref_join.ref 
         
        '. $querywhere.'
        ORDER BY ref_join.date asc'); 
        return $builder->getResultArray();  
    }
    
    function get_data_invoice($id){
        $builder = $this->db->table("invoice");
        $builder->select("*,  CASE 
        WHEN InvRefType = '-' THEN 'No data Selected'
        WHEN InvRefType = 'Survey' THEN (select SurveyCode from survey where SurveyId = InvRef)
        WHEN InvRefType = 'Sample' THEN (select SampleCode from sample where SampleId = InvRef)
        WHEN InvRefType = 'Penawaran' THEN (select SphCode from penawaran where SphId = InvRef)
        END AS 'InvRefCode',InvNpwp NpwpId,b.Name NpwpName,b.Image NpwpImage, InvKtp KtpId,a.Name KtpName,a.Image KtpImage"); 
        $builder->join("users","id = InvAdmin","left");
        $builder->join("project","project.ProjectId = invoice.ProjectId","left");
        $builder->join("store","store.StoreId = invoice.StoreId","left"); 
        $builder->join("customer","invoice.CustomerId = customer.CustomerId","left");
        $builder->join("template_footer","TemplateId = template_footer.TemplateFooterId","left");
        $builder->join("lampiran a","a.Id = invoice.InvKtp","left");
        $builder->join("lampiran b","b.Id = invoice.InvNpwp","left");
        $builder->where('InvId',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    }
    
    function get_data_invoice_detail($id){
        $builder = $this->db->table("invoice_detail");
        $builder->where('InvDetailRef',$id); 
        return $builder->get()->getResult();  
    } 

    function get_next_code_invoice($date){ 
        $arr_date = explode("-", $date);
        $builder = $this->db->table("invoice");  
        $builder->select("ifnull(max(SUBSTRING(InvCode,5,3)),0) + 1 as nextcode"); 
        $builder->where("month(InvDate2)",$arr_date[1]);
        $builder->where("year(InvDate2)",$arr_date[0]);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "INV/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "INV/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "INV/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "INV/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    }
    
    function insert_data_invoice($data){ 
        $header = $data["header"]; 
        $getnextcode = $this->get_next_code_invoice($header["InvDate"]);
        $builder = $this->db->table("invoice");
        $builder->insert(array(
            "InvCode"=>$getnextcode,
            "InvDate"=>$header["InvDate"], 
            "InvDate2"=>$header["InvDate"],  
            "ProjectId"=>$header["ProjectId"],
            "CustomerId"=>$header["CustomerId"],
            "StoreId"=>$header["StoreId"],
            "InvRef"=>$header["InvRef"],
            "InvRefType"=>$header["InvRefType"],
            "InvAdmin"=>$header["InvAdmin"], 
            "InvDelivery"=>$header["InvDelivery"], 
            "InvDeliveryTotal"=>$header["InvDeliveryTotal"], 
            "InvCustName"=>$header["InvCustName"],
            "InvCustTelp"=>$header["InvCustTelp"],
            "InvAddress"=>$header["InvAddress"], 
            "TemplateId"=>$header["TemplateId"],
            "InvSubTotal"=>$header["InvSubTotal"],
            "InvDiscItemTotal"=>$header["InvDiscItemTotal"],
            "InvDiscTotal"=>$header["InvDiscTotal"], 
            "InvGrandTotal"=>$header["InvGrandTotal"], 
            "InvImageList"=> (isset($header["InvImageList"]) ? json_encode($header["InvImageList"]) : "[]"),
            "InvKtp"=>$header["InvKtp"], 
            "InvNpwp"=>$header["InvNpwp"],  
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("invoice");
        $builder->select('*');
        $builder->orderby('InvId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["InvDetailRef"] = $query->InvId;
            $row["InvDetailVarian"] = (isset($row["InvDetailVarian"]) ? json_encode($row["InvDetailVarian"]) : "[]");  
            $builder = $this->db->table("invoice_detail");
            $builder->insert($row); 
        }  

        //create Log action 
        $activityModel = new ActivityModel();
        $activityModel->insert(
            array( 
                "menu"=>"Invoice",
                "type"=>"Add",
                "name"=>"Data invoice baru ditambahkan dengan nomor ".$getnextcode,
                "desc"=> json_encode($data ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        );    
    } 
    
    function update_data_invoice($data,$id){ 
        $dataold = $builder = $this->getWhere(['InvId' => $id], 1)->getRow(); 
 
        $header = $data["header"];  
        $builder = $this->db->table("invoice");  
        $builder->set('ProjectId', $header["ProjectId"]);
        $builder->set('CustomerId', $header["CustomerId"]);
        $builder->set('StoreId', $header["StoreId"]);   
        $builder->set('InvDate', $header["InvDate"]);   
        $builder->set('InvAdmin', $header["InvAdmin"]); 
        $builder->set('InvRef', $header["InvRef"]); 
        $builder->set('InvRefType', $header["InvRefType"]); 
        $builder->set('InvCustName', $header["InvCustName"]);
        $builder->set('InvCustTelp', $header["InvCustTelp"]);
        $builder->set('InvAddress', $header["InvAddress"]); 
        $builder->set('InvDelivery', $header["InvDelivery"]); 
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('InvSubTotal', $header["InvSubTotal"]); 
        $builder->set('InvDiscItemTotal', $header["InvDiscItemTotal"]); 
        $builder->set('InvDeliveryTotal', $header["InvDeliveryTotal"]); 
        $builder->set('InvDiscTotal', $header["InvDiscTotal"]); 
        $builder->set('InvGrandTotal', $header["InvGrandTotal"]);  
        $builder->set('InvNpwp', $header["InvNpwp"]);  
        $builder->set('InvKtp', $header["InvKtp"]);  
        $builder->set('InvImageList', (isset($header["InvImageList"]) ? json_encode($header["InvImageList"]) : "[]"));
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('InvId', $id); 
        $builder->update(); 

        $builder = $this->db->table("invoice_detail");
        $builder->where('InvDetailRef',$id);
        $builder->delete(); 

        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["InvDetailRef"] = $id;
            $row["InvDetailVarian"] = (isset($row["InvDetailVarian"]) ? json_encode($row["InvDetailVarian"]) : "[]");  
            $builder = $this->db->table("invoice_detail");
            $builder->insert($row); 
        } 
         

        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Invoice",
                "type"=>"Edit",
                "name"=>"Data Invoice diubah dengan nomor ".$header["InvCode"],
                "desc"=> json_encode(array("new"=>$data,"old" => $dataold) ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
            )
        ); 
        // //update status Penawaran 
        // if( $header["InvRefType"] == "Penawaran") $this->update_data_sph_status($header["InvRef"]);
        // //update status Survey
        // if( $header["InvRefType"] == "Survey") $this->update_data_survey_status($header["InvRef"]);
        // //update status Sample
        
        // $modelssample = new SampleModel;
        // if( $header["InvRefType"] == "Sample") $modelssample->update_data_sample_status($header["InvRef"]); 

 
        // //update status Penawaran
        // if( $data_old->InvRefType == "Penawaran") $this->update_data_sph_status($data_old->InvRef);
        // //update status Survey
        // if( $data_old->InvRefType == "Survey") $this->update_data_survey_status($data_old->InvRef);
        // //update status Sample
        // if( $data_old->InvRefType== "Sample") $modelssample->update_data_sample_status($data_old->InvRef); 


        //$this->update_data_invoice_status($id);
    }

    
    function delete_data_invoice($id){ 
        $builder = $this->db->table("invoice");
        $builder->set('InvStatus','3'); 
        $builder->set('updated_user',user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('InvId',$id);
        $builder->update();  

        $builder = $this->db->table("invoice");  
        $builder->where('InvId',$id);
        $result = $builder->get()->getRow(); 
        
        // //update status Penawaran
        // if( $result->InvRefType == "Penawaran") $this->update_data_sph_status($result->InvRef);
        // //update status Survey
        // if( $result->InvRefType == "Survey") $this->update_data_survey_status($result->InvRef);
        // //update status Sample
        // $modelssample = new SampleModel;
        // if( $result->InvRefType == "Sample") $modelssample->update_data_sample_status($result->InvRef);
        
        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Invoice",
                "type"=>"Delete",
                "name"=>"Data Invoice dibatalkan dengan nomor ".$result->InvCode,
                "desc"=> json_encode([]),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 

            )
        ); 
        return JSON_ENCODE(array("status"=>true));
    }

    function update_status_invoice($id,$status){   
        $dataold = $builder = $this->getWhere(['InvId' => $id], 1)->getRow();  

        $builder = $this->db->table("invoice"); 
        $builder->set('InvStatus', $status);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('InvId', $id); 
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
                "menu"=>"Invoice",
                "type"=>"Status",
                "name"=> "Status Data Invoice diubah dari ".$statuslist[$dataold->InvStatus]." menjadi ".$statuslist[$status] . " dengan nomor ".$dataold->InvCode,
                "desc"=> json_encode([]),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

        return JSON_ENCODE(array("status"=>true));
    }  

    function update_status_invoice_po($id,$status){   
        $dataold = $builder = $this->getWhere(['InvId' => $id], 1)->getRow();  

        $builder = $this->db->table("invoice"); 
        $builder->set('InvStatusPO', $status);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('InvId', $id); 
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
                "menu"=>"Invoice",
                "type"=>"Status PO",
                "name"=> "Status PO Data Invoice diubah dari ".$statuslist[$dataold->InvStatus]." menjadi ".$statuslist[$status] . " dengan nomor ".$dataold->InvCode,
                "desc"=> json_encode([]),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

        return JSON_ENCODE(array("status"=>true));
    }  

    function update_status_invoice_payment($id,$status){   
        $dataold = $builder = $this->getWhere(['InvId' => $id], 1)->getRow();  

        $builder = $this->db->table("invoice"); 
        $builder->set('InvStatusPayment', $status);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('InvId', $id); 
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
                "menu"=>"Invoice",
                "type"=>"Status Payment",
                "name"=> "Status Payment Data Invoice diubah dari ".$statuslist[$dataold->InvStatus]." menjadi ".$statuslist[$status] . " dengan nomor ".$dataold->InvCode,
                "desc"=> json_encode([]),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

        return JSON_ENCODE(array("status"=>true));
    }  

}
