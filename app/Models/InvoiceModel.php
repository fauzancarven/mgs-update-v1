<?php

namespace App\Models; 

use CodeIgniter\Model;  
use CodeIgniter\Database\RawSql;
use App\Models\master\ProdukModel; 
use App\Models\ActivityModel;
use App\Models\DeliveryModel; 

class InvoiceModel extends Model
{  
    protected $DBGroup = 'default';
    protected $table = 'invoice';
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        helper('tool');
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
            $builder->whereIn("InvStatus",$filter["filter"]); 
            $filterdata = 1;
        } 
        if(isset($filter["store"])){ 
            $builder->whereIn("invoice.StoreId",$filter["store"]); 
            $filterdata = 1;
        } 
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("InvCustName",$filter["search"]);
            $builder->orLike("InvCustTelp",$filter["search"]);
            $builder->orLike("InvAddress",$filter["search"]);
            $builder->orLike("InvNote",$filter["search"]);
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
        }else{
            $builder->orderby("InvDate",'desc');   
            $builder->orderby("InvCode",'desc');  

        }

        $datafilter = clone $builder;  
        $count = $datafilter->get()->getNumRows();

        $builder->limit($length,$start); 
        $query = $builder->get();  
        
        foreach($query->getResult() as $row){  
            $status = "";
            if($row->InvStatus==0){
                $status .= '
                    <button class="bg-info-focus text-primary-600  px-8 py-2 rounded-3 fw-bold text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <span class="me-1 "  data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status"  >New</span>
                    </button> '; 
            }
            if($row->InvStatus==1){
                $status .= '
                    <button class="bg-lilac-100 text-lilac-600 px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <span class="me-1 "  data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status" >Proses</span>
                    </button> '; 
            }
            if($row->InvStatus==2){
                $status .= '
                    <button class="bg-success-focus text-success-main px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <span class="me-1 " data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status"  >Completed</span>
                    </button> ';  
            }
            if($row->InvStatus==3){
                $status .=  '
                    <button class="bg-danger-focus text-danger-main px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"  >
                        <span class="me-1 " data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status"  >Cancel</span>
                    </button> ';  
            }
            $status .= '  
            <ul class="dropdown-menu shadow drop-status ">
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(0,'.$row->InvId.',this)">
                        New
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(1,'.$row->InvId.',this)">
                        </i>Proses
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(2,'.$row->InvId.',this)">
                        Completed
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(3,'.$row->InvId.',this)">
                        Cancel
                    </a>
                </li>  
            </ul>';

            // MENGAMBIL DATA Detail  
            $htmldetail = '      
            <div class="view-detail" style="display:none">
                <div class="list-detail pb-3">
                    <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                        <iconify-icon icon="ix:box-closed" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Detail Produk 
                    </div> 
                    '.$this->get_data_detail_invoice($row).'
                </div>
                <div class="list-detail pb-3">
                    <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                        <iconify-icon icon="hugeicons:payment-02" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Pembayaran 
                    </div> 
                    '.$this->get_data_payment_invoice($row).'
                </div> 
                <div class="list-detail pb-3">
                    <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                        <iconify-icon icon="hugeicons:delivery-truck-01" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Pengiriman 
                    </div> 
                    '.$this->get_data_delivery_invoice($row).'
                </div> 
                <div class="list-detail pb-3">
                    <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                        <iconify-icon icon="hugeicons:warehouse" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Pembelian 
                    </div> 
                    '.$this->get_data_pembelian_invoice($row).'
                </div> 
            </div>
            ';

            // MENGAMBIL DATA Toko 
            $store = '
                    <div class="d-flex align-items-center ">   
                        <span class="text-head-3 d-flex gap-0 align-items-center"><img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">'.$row->StoreCode.'</span> 
                        <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1 text-default '.($row->ProjectId == 0 ? "d-none" : "").'"><i class="fa-solid fa-diagram-project pe-1 "></i>Document Project</span>   
                    </div>';

            $data_row = array( 
                "InvId" => $row->InvId,
                "invoice" => $row,
                "doc" =>$store.'<div class="text-neutral-400 text-xxs" style="line-height:1">'.$row->InvCode.'</span>'.$this->get_data_forward_invoice($row->InvRefType,$row->InvRef),
                "code" => $row->InvCode.$this->get_data_forward_invoice($row->InvRefType,$row->InvRef),
                "date" =>  '<div class="text-head-3" style="line-height:1">'.date_format(date_create($row->InvDate),"d M Y").'</div>', 
                "status" => $status,
                "admin" => ucwords($row->username), 
                "note" => str_replace(array("\r\n", "\r", "\n"), '\n', $row->InvNote), 
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
                <div class="d-flex align-items-center gap-1 justify-content-center">
                <a onclick="print_invoice('.$row->InvId.',this,\''.$row->ProjectId.'\')"
                    class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Print Invoice">
                    <iconify-icon icon="lucide:printer"></iconify-icon>
                </a>
                <a onclick="edit_invoice('.$row->InvId.',this,\''.$row->ProjectId.'\')"
                    class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Ubah Invoice">
                    <iconify-icon icon="lucide:edit"></iconify-icon>
                </a>
                <a onclick="delete_invoice('.$row->InvId.',this,\''.$row->ProjectId.'\')"
                    class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Hapus Invoice">
                    <iconify-icon icon="lucide:trash-2">
                    </iconify-icon>
                </a>
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
        return '';
        return '<div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
            <a class="text-detail-3 pointer text-decoration-underline text-secondary">Tidak ada referensi</a>
        </div>'; 
    } 
    function get_data_detail_invoice($row){ 
        helper('tool_helper'); 

        $modelsproduk = new ProdukModel();
        $detail = array(); 
        $detailhtml = ' <table class="table detail-item m-0 shadow-7">
                            <thead>
                                <tr>
                                    <th class="detail" style="width: 35px;">#</th>
                                    <th class="detail" colspan="2">Deskripsi</th> 
                                    <th class="detail">Qty</th>
                                    <th class="detail">Harga</th>
                                    <th class="detail">Disc</th>
                                    <th class="detail">Total</th>
                                </tr>
                            </thead>
                            <tbody>';
        $arr_detail = $this->get_data_invoice_detail($row->InvId);

        $abjad = 'A';
        $number = '1'; 
        foreach($arr_detail as $row_data){
            $arr_varian = json_decode($row_data->InvDetailVarian);
            $arr_badge = "";
            $arr_no = 0;

            foreach($arr_varian as $varian){
                
                $color = customColor(fmod($arr_no,5));
                $arr_badge .= '<span class="'.$color.' radius-8 px-8 py-4 text-xxs fw-bold">'.$varian->varian.' : '.$varian->value.'</span>';
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
                    
            if($row_data->InvDetailType == "product"){ 
                $detailhtml .= ' <tr>
                <td  class="detail text-center">'.$number.'.</td>
                    <td class="detail" style="width:4rem">
                        <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->InvDetailVarian,true).'" alt="Gambar" class="image-produk w-50-px h-50-px rounded-3">
                    </td>
                    <td class="detail" style="min-width:350px">
                    <div class="d-flex flex-column text-start flex-fill order-md-4 order-3 justify-content-center">
                        <div class="fw-medium">'.$row_data->InvDetailText.'</div>
                        <div class="text-detail-2 text-truncate text-xxs text-neutral-400" style="line-height:1">'.$row_data->InvDetailGroup.'</div> 
                        <div class="d-flex gap-1 flex-wrap pt-4">'.$arr_badge.'</div></div>
                    </td>
                    <td class="detail">'.number_format($row_data->InvDetailQty, 2, ',', '.').' '.$row_data->InvDetailSatuanText.'</td>
                    <td class="detail">Rp. '.number_format($row_data->InvDetailPrice, 0, ',', '.').'</td>
                    <td class="detail">Rp. '.number_format($row_data->InvDetailDisc, 0, ',', '.').'</td>
                    <td class="detail">Rp. '.number_format($row_data->InvDetailTotal, 0, ',', '.').'</td>
                </tr> ';
                $number++;
            }else{
                $number = 1;
                $detailhtml .= ' <tr>
                    <td  class="detail text-center  fw-bold">'.$abjad.'.</td>
                    <td colspan="6" class="detail">
                        <div class="d-flex flex-column text-start flex-fill order-md-4 order-3 justify-content-center">
                            <span class="text-head-3">'.$row_data->InvDetailText.'</span>
                        </div>
                    </td>
                </tr> ';
                $abjad++;
            }
        };
        $detailhtml .= '
        </tbody>
        <tfoot>
            <tr>
                <th class="bg-light" colspan="7">
                    <div class="d-flex m-1 gap-2 align-items-center justify-content-end pe-4"> 
                        <span class="text-detail-2 text-xs">Sub Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->InvSubTotal,0,',','.').'</span>  
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2 text-xs">Disc Item:</span>
                        <span class="text-head-2">Rp. '.number_format($row->InvDiscItemTotal,0,',','.').'</span>   
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2 text-xs">Disc Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->InvDiscTotal,0,',','.').'</span>   
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2 text-xs">Pengiriman:</span>
                        <span class="text-head-2">Rp. '.number_format($row->InvDeliveryTotal,0,',','.').'</span> 
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2 text-xs">Grand Total:</span>
                        <span class="text-head-2">Rp.'.number_format($row->InvGrandTotal,0,',','.').'</span> 
                    </div>
                </th>
            </tr> 
        </tfoot>
        </table>';

        return $detailhtml; 
    } 
    function get_data_payment_invoice($row,$header = false,$total = false){
        $html_payment = "";
        $html_payment_detail = "";
        
        $payment_total = 0;
        $performa_total = 0; 
        if($row->InvGrandTotal == 0){
            
            $html_payment = ' 
            <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                <iconify-icon icon="hugeicons:payment-02" class="text-success-light text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Tidak Ada Pembayaran" ></iconify-icon> 
            </button>  ';
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
                                                <button class="radius-8 bg-primary-light text-primary-focus fw-bold text-xxs p-4 text-hover-primary-600" onclick="view_file(this)" data-file="'.base_url().$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'">
                                                <i class="ri-eye-line"></i> Lihat bukti
                                                </button>  '; 
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
                    <div class="d-flex align-items-center gap-1 justify-content-center">
                    <a onclick="print_payment('.$row_payment->PaymentId.',this,\''.$statusdoc .'\')"
                        class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Print Payment">
                        <iconify-icon icon="lucide:printer"></iconify-icon>
                    </a>
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
                    if($statusdoc == "Invoice"){

                        $status =  '<span class="bg-warning-focus text-warning-main px-8 py-2 radius-8 fw-medium text-xxs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Approval">Menunggu Approval</span>';  
                    }else{
                        
                        $status =  '<span class="bg-success-focus text-success-main px-8 py-2 radius-8 fw-medium text-xxs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Success">Success</span>';  
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
                    </td>';
                }

                if($row_payment->PaymentDoc == 1){ 
                    $html_payment_list .= '
                        <tr>
                            <td class="action-td no-border">'.$action.'</td>
                            <td class="detail"><span class="text-primary-600 fw-bold">'.$row_payment->PaymentCode.'</span></td>
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
                        <td class="detail"><span class="text-primary-600 fw-bold">'.$row_payment->PaymentCode.'</span></td>
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
            
            if($payment_total == 0 &&  $performa_total == 0){
            
                $html_payment = ' 
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:payment-02" class="text-primary-light text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Belum Ada Pembayaran" ></iconify-icon> 
                </button>  ';
                $html_payment_detail .= ' <div class="d-inline-block p-8 pe-16 bg-warning-50 radius-8 border-start-width-3-px border-warning-main border-top-0 border-end-0 border-bottom-0 shadow-7" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Belum ada pembayaran yang dibuat dari dokumen ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_payment('.$row->InvId.',this,\'Invoice\')">Buat Pembayaran</a> atau 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_payment('.$row->InvId.',this,\'Proforma\')">Buat Proforma</a> 
                    </span>
                </div> '; 
            }else if($payment_total < $row->InvGrandTotal || $performa_total < $row->InvGrandTotal){  
                
               
                $html_payment = ' 
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:payment-02" class="text-warning text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Masih ada sisa pembayaran" ></iconify-icon> 
                </button>  ';

                if($html_proforma_list !== ""){
                    $html_proforma_list = '<tr>
                        <td class="detail no-border text-xs fw-bold" colspan="9"><i class="ri-circle-fill circle-icon text-primary-600 w-auto pe-4"></i>List Proforma</td> 
                    </tr>'.$html_proforma_list;
                }
                if($html_payment_list !== ""){
                    $html_payment_list = '<tr>
                        <td class="detail no-border text-xs fw-bold" colspan="9"><i class="ri-circle-fill circle-icon text-primary-600 w-auto pe-4"></i>List Payment</td> 
                    </tr>'.$html_payment_list;
                }
                $html_payment_detail = '
                <table class="table detail-payment shadow-7">
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
                if($payment_total < $row->InvGrandTotal){
                    
                $html_payment_detail .= '
                <div class="p-8 bg-warning-50 radius-8 border-start-width-3-px border-warning-main border-top-0 border-end-0 border-bottom-0 shadow-7 d-inline" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Masih ada sisa pembayaran yang perlu dibuat dari dokumen ini,  
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_payment('.$row->InvId.',this,\'Invoice\')">Buat Pembayaran</a> atau 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_payment('.$row->InvId.',this,\'Proforma\')">Buat Proforma</a> 
                    </span>
                </div> ';
                }else{
                    
                $html_payment = ' 
                    <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                        <iconify-icon icon="hugeicons:payment-02" class="text-success text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Pembayaran Selesai" ></iconify-icon> 
                    </button>  ';
                }
            } else{   
                
                $html_payment = ' 
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:payment-02" class="text-success text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Pembayaran Selesai" ></iconify-icon> 
                </button>  ';


                        
                if($html_proforma_list !== ""){
                    $html_proforma_list = '<tr>
                        <td class="detail no-border text-xs fw-bold" colspan="9"><i class="ri-circle-fill circle-icon text-primary-600 w-auto pe-4"></i>List Proforma</td> 
                    </tr>'.$html_proforma_list;
                }
                if($html_payment_list !== ""){
                    $html_payment_list = '<tr>
                        <td class="detail no-border text-xs fw-bold" colspan="9"><i class="ri-circle-fill circle-icon text-primary-600 w-auto pe-4"></i>List Payment</td> 
                    </tr>'.$html_payment_list;
                }
                $html_payment_detail = '
                    <table class="table detail-payment shadow-7">
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
    function get_data_delivery_invoice($row,$header = false){
        $delivery = "";
        $delivery_detail = "";
        if($row->InvDelivery == 0){ 
            $delivery = '  
            <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
            <iconify-icon icon="hugeicons:delivery-truck-01" class="text-success text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Tidak ada pengiriman" ></iconify-icon> 
        </button>  ';
            $delivery_detail = '
            
            <div class="d-inline-block p-8 pe-16 bg-success-50 radius-8 border-start-width-3-px border-success-main border-top-0 border-end-0 border-bottom-0 shadow-7" role="alert">
                <div class="text-head-3 p-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Mode pengriman tidak diaktifkan untuk transaksi ini, 
                    <a class="text-head-3 text-primary" style="cursor:pointer" onclick="update_invoice_delivery('.$row->InvId.',this,1)">Aktifkan Mode Pengiriman</a>
                </div>
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
            $delivery_row = $builder->get()->getResult(); 
            foreach($delivery_row as $row_delivery){
                $statusdoc = "Invoice";
                $delivery_detail .= '<tr class="dt-hasChild">
                <td class="detail ">
                    <a class="cursor-pointer text-head-3 btn-detail-delivery" data-id="'.$row_delivery->DeliveryId.'"> <iconify-icon icon="material-symbols:arrow-right-rounded" class="icon text-xxl" rotate="0deg"> </iconify-icon></a> 
                </td> 
                <td class="detail action-td" style="width:70px">   
                    <div class="d-flex align-items-center gap-1 justify-content-center">
                        <a onclick="print_delivery('.$row_delivery->DeliveryId.',this,\''.$statusdoc .'\')""
                            class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Print Pengiriman">
                            <iconify-icon icon="lucide:printer"></iconify-icon>
                        </a>
                        <a onclick="edit_delivery('.$row_delivery->DeliveryId.',this,\''.$statusdoc .'\')"
                            class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Ubah Pengiriman">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a onclick="delete_delivery('.$row_delivery->DeliveryId.',this,\''.$statusdoc .'\')"
                            class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Hapus Pengiriman">
                            <iconify-icon icon="lucide:trash-2">
                            </iconify-icon>
                        </a> 
                    </div> 
                </td>  
                <td class="detail" style="width:120px"> 
                    <span class="text-primary-600 fw-bold">'.$row_delivery->DeliveryCode.'</span>
                    <div class="d-flex gap-1 pt-4">
                    '.$modelsDelivery->get_data_status_delivery($row_delivery,true).'
                    '.$modelsDelivery->get_data_payment_delivery($row_delivery,true).'</div>
                </td>
                <td class="detail" style="width:100px">'.date_format(date_create($row_delivery->DeliveryDate),"d M Y").'</td>  
                <td class="detail">'.$row_delivery->DeliveryRitase.' ('.getTerbilang($row_delivery->DeliveryRitase).')</td> 
                <td class="detail">'.$row_delivery->DeliveryArmada.'</td> 
                <td class="detail" style="width:200px">  
                    <div class="text-head-3 pb-2 text-truncate" style="max-width: 200px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="- '.$row_delivery->DeliveryFromName.'">'.$row_delivery->DeliveryFromName.'</div>
                    <div class="text-detail-3 text-xs">'.$row_delivery->DeliveryFromTelp.'</div>
                    <div class="text-detail-3 text-truncate text-xxs text-neutral-400" style="max-width: 200px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="- '.$row_delivery->DeliveryFromAddress.'">'.$row_delivery->DeliveryFromAddress.'</div> 
                </td>
                <td class="detail" style="min-width:200px">   
                    <div class="text-head-3 pb-2 text-truncate" style="max-width: 200px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="- '.$row_delivery->DeliveryToName.'">'.$row_delivery->DeliveryToName.'</div>
                    <div class="text-detail-3 text-xs">'.$row_delivery->DeliveryToTelp.'</div>
                    <div class="text-detail-3 text-truncate text-xxs text-neutral-400" style="max-width: 200px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="- '.$row_delivery->DeliveryToAddress.'">'.$row_delivery->DeliveryToAddress.'</div> 
                </td>
                <td class="detail" style="width:100px">Rp. '.number_format($row_delivery->DeliveryTotal,0).'</td>
                </tr> 
                <tr class="child-row delivery d-none" data-id="'.$row_delivery->DeliveryId.'">
                    <td class="detail" colspan="10">
                        <div class="view-detail-1" style="display:none">
                            <div class="list-detail-1 pb-3">
                                <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                                    <iconify-icon icon="ix:box-closed" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Detail Produk 
                                </div>
                                '.$modelsDelivery->get_data_detail_delivery($row_delivery->DeliveryId).'
                            </div>   
                            <div class="list-detail-1 pb-3">
                                <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                                    <iconify-icon icon="hugeicons:payment-02" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Pembayaran 
                                </div>
                                '.$modelsDelivery->get_data_payment_delivery($row_delivery).'
                            </div>
                            <div class="list-detail-1 pb-3"> 
                                <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                                    <iconify-icon icon="hugeicons:time-management" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Proses 
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
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                <iconify-icon icon="hugeicons:delivery-truck-01" class="text-primary-light text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Pengiriman belum lengkap" ></iconify-icon> 
            </button>  ';
                $delivery_detail = '
                <div class="d-inline-block p-8 pe-16 bg-warning-50 radius-8 border-start-width-3-px border-warning-main border-top-0 border-end-0 border-bottom-0 shadow-7" role="alert">
                <div class="text-head-3 p-2">
                <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                pengriman belum dibuat untuk transaksi ini, 
                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_invoice_delivery('.$row->InvId.',this)">Buat Pengiriman</a> atau 
                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="update_invoice_delivery('.$row->InvId.',this,0)">nonaktifkan mode Pengiriman</a>
            </div> </div>';
            }else{ 
                if($this->get_delivery_item_total($row->InvId)){
                    $delivery = '  
                    <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:delivery-truck-01" class="text-warning text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Pengiriman belum lengkap" ></iconify-icon> 
                </button>  ';
                }else{
                    $delivery = '  
                    <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:delivery-truck-01" class="text-success text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Pengiriman Selesai" ></iconify-icon> 
                </button>  '; 
                }
               
                $delivery_detail = '<table class="table detail-delivery shadow-7">
                    <thead>
                        <tr>
                            <th class="detail" style="width:30px">#</th>
                            <th class="detail" style="width:70px">Action</th> 
                            <th class="detail">No. Pengiriman</th>
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
                </table>
                
                <div class="d-inline-block p-8 pe-16 bg-info-50 radius-8 border-start-width-3-px border-info-main border-top-0 border-end-0 border-bottom-0 shadow-7" role="alert">
                    <div class="text-head-3 p-2"> 
                    
                '.($this->get_delivery_item_total($row->InvId) == true ? "Pengiriman masih belum lengkap" : "") .'
                    <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_invoice_delivery('.$row->InvId.',this)">Tambahkan Pengiriman</a> 
                </div> </div>';
            }
        }

        if($header){
            return  $delivery;
        }else{
            return  $delivery_detail;

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
            $vendor = '<div class="text-head-3 text-wrap pt-2">'.($row_po->VendorId == 0 ? $row_po->VendorName : $row_po->VendorName).'</div>';
            $statusdoc = "Invoice";
            $pembelian_detail .= '<tr class="dt-hasChild">
            <td class="detail ">
                <a class="cursor-pointer text-head-3 btn-detail-pembelian" data-id="'.$row_po->POId.'"> <iconify-icon icon="material-symbols:arrow-right-rounded" class="icon text-xxl" rotate="0deg"> </iconify-icon></a> 
            </td> 
            <td class="detail action-td" style="width:70px">   
                    <div class="d-flex align-items-center gap-1 justify-content-center">
                        <a onclick="print_po('.$row_po->POId.',this,\''.$statusdoc .'\')""
                            class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Print Pembelian">
                            <iconify-icon icon="lucide:printer"></iconify-icon>
                        </a>
                        <a onclick="edit_po('.$row_po->POId.',this,\''.$statusdoc .'\')"
                            class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Ubah Pembelian">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a onclick="delete_po('.$row_po->POId.',this,\''.$statusdoc .'\')"
                            class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Hapus Pembelian">
                            <iconify-icon icon="lucide:trash-2">
                            </iconify-icon>
                        </a> 
                    </div> 
            </td>    
            <td class="detail" style="width:120px"> 
                <span class="text-primary-600 fw-bold">'.$row_po->POCode.'</span>
                <div class="d-flex gap-1 pt-4"> 
                '.$modelspembelian->get_data_payment_pembelian($row_po,true).'</div> 
            </td>  
            <td class="detail">'.date_format(date_create($row_po->PODate),"d M Y").'</td>    
            <td class="detail">'.$vendor.'
            </td> <td class="detail action-td"><span>'.$row_po->PONote.'</span>
            <a onclick="comment_po('.$row_po->POId.',\''.str_replace(array("\r\n", "\r", "\n"), '\n', $row_po->PONote).'\')"
                class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip"  data-bs-title="Ubah Catatan">
                <iconify-icon icon="lucide:edit"></iconify-icon>
            </a> 
            </td>
            <td class="detail">Rp. '.number_format($row_po->POGrandTotal,0).'</td>
            </tr> 
            <tr class="child-row pembelian d-none" data-id="'.$row_po->POId.'">
                <td class="detail" colspan="10">
                    <div class="view-detail-1" style="display:none"> 
                        <div class="list-detail-1 pb-3">
                            <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                                <iconify-icon icon="ix:box-closed" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Detail Produk 
                            </div> 
                            '.$modelspembelian->get_data_detail_pembelian($row_po).'
                        </div>   
                        <div class="list-detail-1 pb-3">
                            <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                                <iconify-icon icon="hugeicons:payment-02" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Pembayaran 
                            </div> 
                            '.$modelspembelian->get_data_payment_pembelian($row_po).'
                        </div> 
                    </div>
                </td>
            </tr>';  
        } 
        
        if($pembelian_detail == ""){

            $pembelian = ' 
            <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                <iconify-icon icon="hugeicons:warehouse" class="text-primary-light text-xl"></iconify-icon> 
            </button>  '; 
            $pembelian_detail .= ' <div class="d-inline-block p-8 pe-16 bg-warning-50 radius-8 border-start-width-3-px border-warning-main border-top-0 border-end-0 border-bottom-0 shadow-7" role="alert">
                <span class="text-head-3">
                    <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                    Belum ada pembelian yang dibuat dari dokumen ini, <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_invoice_po('.$row->InvId.',this)">Tambahkan Pembelian</a> 
                </span>
            </div> ';  
        }else{ 
           
            $pembelian = ' 
            <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                <iconify-icon icon="hugeicons:warehouse" class="text-success text-xl"></iconify-icon> 
            </button>  '; 
            
            $pembelian_detail = '<table class="table detail-delivery shadow-7">
                <thead>
                    <tr>
                        <th class="detail" style="width:30px"></th>
                        <th class="detail" style="width:70px">Action</th> 
                        <th class="detail">Nomor</th>
                        <th class="detail">Tanggal</th>  
                        <th class="detail">Vendor</th> 
                        <th class="detail">Catatan</th> 
                        <th class="detail">Total</th>
                    </tr>
                </thead>
                <tbody>'.$pembelian_detail.'
                </tbody>
            </table>
            
            <div class="d-inline-block p-8 pe-16 bg-info-50 radius-8 border-start-width-3-px border-info-main border-top-0 border-end-0 border-bottom-0 shadow-7" role="alert">
            <div class="text-head-3 p-2"> 
            
        '.($this->get_pembelian_item_total($row->InvId) == true ? "Pembelian masih belum lengkap" : "") .'
            <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_invoice_po('.$row->InvId.',this)">Tambahkan Pembelian</a> 
        </div> </div>';
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
    
    function get_data_invoice_detail($id, $produk_id = null,$produk_varian = null){
        $builder = $this->db->table("invoice_detail");
        $builder->join('produk_detail','InvDetailVarian=ProdukDetailVarian and ProdukDetailRef = ProdukId','left'); 
        $builder->where('InvDetailRef',$id); 
        if($produk_id)  $builder->where('ProdukId',$produk_id);
        if($produk_varian)  $builder->where('InvDetailvarian',$produk_varian); 
        if($produk_id && $produk_varian){
            return $builder->get()->getRow();   
        }else{
            
        return $builder->get()->getResult();  
        }
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
            "InvProjectAddress"=>$header["InvProjectAddress"], 
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

        \App\Libraries\AccAutoJurnal::trySyncInvoice($query->InvId); // jurnal otomatis
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
        $builder->set('InvProjectAddress', $header["InvProjectAddress"]); 
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
         

        \App\Libraries\AccAutoJurnal::trySyncInvoice($id); // jurnal otomatis
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
        
        \App\Libraries\AccAutoJurnal::trySyncInvoice($id); // jurnal otomatis (invoice batal -> jurnal dihapus)
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

        \App\Libraries\AccAutoJurnal::trySyncInvoice($id); // jurnal otomatis (status Cancel <-> aktif)
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

    function update_comment($comment,$id){ 
        $dataold = $builder = $this->getWhere(['InvId' => $id], 1)->getRow();  
        
        $builder = $this->db->table("invoice"); 
        $builder->set('InvNote', $comment);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('InvId', $id); 
        $builder->update();   

         //create Log action 
         $activityModel = new ActivityModel(); 
         $activityModel->insert(
             array( 
                 "menu"=>"Invoice",
                 "type"=>"Comment",
                 "name"=> "Catatan Data invoice diubah dari ".$dataold->InvNote." menjadi ".$comment . " dengan nomor ".$dataold->InvCode,
                 "desc"=> json_encode([]),
                 "created_user"=>user()->id, 
                 "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
             )
         ); 
 
         return JSON_ENCODE(array("status"=>true));
    }

    function get_delivery_item_total($invoice_id){ 
        $arr_invoice_detail = $this->get_data_invoice_detail($invoice_id);
        $delivery_add = false;
        $item = ""; 
        foreach($arr_invoice_detail as $row){
            if($row->InvDetailType == "product" && $row->ProdukId !== "0"){

                $builder = $this->db->table("delivery_detail");
                $builder->select('sum(DeliveryDetailQty) as total'); 
                $builder->join('delivery','DeliveryId = DeliveryDetailRef','left'); 
                $builder->where('ProdukId',$row->ProdukId); 
                $builder->where('DeliveryDetailVarian',$row->InvDetailVarian); 
                $builder->where('DeliveryStatus <',3); 
                $data = $builder->get()->getRow();   
                if($row->InvDetailQty > $data->total) $delivery_add = true;
                
                $item .= $row->ProdukId. $row->InvDetailVarian. $row->InvDetailQty.' | '. $data->total.'<br>';
            }
        }

        
        return $delivery_add;
    }

    function get_data_delivery_detail_by_ref($invoice_id, $produk_id, $produk_varian, $delivery_id = null){   
       $qty_send = 0;
        $builder = $this->db->table("delivery_detail");
        $builder->select('sum(DeliveryDetailQty) as total'); 
        $builder->join('delivery','DeliveryId = DeliveryDetailRef','left'); 
        $builder->where('ProdukId',$produk_id); 
        $builder->where('DeliveryDetailVarian',$produk_varian);  
        $builder->where('DeliveryRef',$invoice_id);   
        $builder->where('DeliveryStatus <',3); 
        if($delivery_id) $builder->where('DeliveryId !=',$delivery_id);  
        $datainvoice = $builder->get()->getRow();    
        if($datainvoice->total) $qty_send = $datainvoice->total;
        return $qty_send;
    }
    
    function get_pembelian_item_total($invoice_id){ 
        $arr_invoice_detail = $this->get_data_invoice_detail($invoice_id);
        $PO_add = false;
        $item = ""; 
        foreach($arr_invoice_detail as $row){
            if($row->InvDetailType == "product" && $row->ProdukId !== "0"){

                $builder = $this->db->table("pembelian_detail");
                $builder->select('sum(PODetailQty) as total'); 
                $builder->join('pembelian','POId = PODetailRef','left'); 
                $builder->where('ProdukId',$row->ProdukId); 
                $builder->where('PODetailVarian',$row->InvDetailVarian); 
                $builder->where('POStatus <',3); 
                $data = $builder->get()->getRow();   
                if($row->InvDetailQty > $data->total) $PO_add = true;
                
                $item .= $row->ProdukId. $row->InvDetailVarian. $row->InvDetailQty.' | '. $data->total.'<br>';
            }
        }

        
        return $PO_add;
    }
}