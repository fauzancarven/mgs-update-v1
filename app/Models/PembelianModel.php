<?php

namespace App\Models; 

use CodeIgniter\Model; 
use CodeIgniter\Database\RawSql;
use App\Models\NotificationModel; 
use App\Models\ActivityModel;
use App\Models\master;

class PembelianModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'pembelian';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0; 
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['POCode',
        'ProjectId',
        'StoreId',
        'PORefType',
        'PORef',
        'PODate',
        'PODate2',
        'POAdmin',
        'POCustName', 
        'POCustTelp',
        'POAddress',
        'VendorId', 
        'VendorName', 
        'POStatus',
        'CustomerId',
        'PaymentDoc',
        'PaymentStatus',
        'PaymentForward',
        'TemplateId', 
        'POSubTotal', 
        'POPPNTotal', 
        'PODiscTotal', 
        'POGrandTotal', 
        'PONote', 
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
    function load_datatable_pembelian($filter = null){
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();
        
        $builder = $this->db->table("pembelian");
        $builder->select("*, pembelian.VendorName as NameVendor");
        $builder->join("project","project.ProjectId = pembelian.ProjectId ","left");  
        $builder->join("users","users.id = pembelian.POAdmin ","left"); 
        $builder->join("vendor","vendor.VendorId = pembelian.VendorId ","left"); 
        $builder->join("store","store.StoreId = pembelian.StoreId","left");     
        $builder->where("POStatus <"," 3"); 
        if($filter["datestart"]){
            $builder->where("PODate >=",$filter["datestart"]);
            $builder->where("PODate <=",$filter["dateend"]); 
        } 
        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();

        if(isset($filter["filter"])){ 
            $builder->whereIn("POStatus",$filter["filter"]); 
            $filterdata = 1;
        } 
        if(isset($filter["vendor"])){ 
            $builder->whereIn("pembelian.VendorId",$filter["vendor"]); 
            $filterdata = 1;
        } 
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("ProjectName",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("POAddress",$filter["search"]);
            $builder->orLike("POCode",$filter["search"]);
            $builder->orLike("username",$filter["search"]);
            $builder->orLike("POCustName",$filter["search"]);
            $builder->groupEnd();  
            $filterdata = 1;
        }
        
        // Order TAble
        $columns = array(
            0 => null, // kolom action tidak dapat diurutkan
            1 => null, // kolom action tidak dapat diurutkan
            2 => "StoreCode", // kolom name
            3 => "POCode", // kolom name
            4 => "PODate", // kolom action tidak dapat diurutkan
            5 => "POStatus", // kolom image tidak dapat diurutkan
            6 => "POAdmin", // kolom action tidak dapat diurutkan
            7 => "POCustName", // kolom action tidak dapat diurutkan
            8 => "POStaff", // kolom action tidak dapat diurutkan
            9 => "POGrandTotal", // kolom action tidak dapat diurutkan
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

        $builder->orderby("PODate","desc");   
        $builder->limit($length,$start); 
        $query = $builder->get();  
        foreach($query->getResult() as $row){
           $status = "";
            if($row->POStatus==0){
                $status .= '
                    <button class="bg-info-focus text-primary-600  px-8 py-2 rounded-3 fw-bold text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <span class="me-1 "  data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status"  >New</span>
                    </button> '; 
            }
            if($row->POStatus==1){
                $status .= '
                    <button class="bg-lilac-100 text-lilac-600 px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <span class="me-1 "  data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status" >Proses</span>
                    </button> '; 
            }
            if($row->POStatus==2){
                $status .= '
                    <button class="bg-success-focus text-success-main px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <span class="me-1 " data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status"  >Completed</span>
                    </button> ';  
            }
            if($row->POStatus==3){
                $status .=  '
                    <button class="bg-danger-focus text-danger-main px-8 py-2 rounded-3 fw-medium text-xxs dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"  >
                        <span class="me-1 " data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status"  >Cancel</span>
                    </button> ';  
            }
            $status .= '  
            <ul class="dropdown-menu shadow drop-status ">
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(0,'.$row->POId.',this)">
                        New
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(1,'.$row->POId.',this)">
                        </i>Proses
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(2,'.$row->POId.',this)">
                        Completed
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2 text-xs" onclick="update_status(3,'.$row->POId.',this)">
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
                    '.$this->get_data_detail_pembelian($row).'
                </div>
                <div class="list-detail pb-3">
                    <div class="text-primary-600 py-2 fw-bold text-sm d-flex align-items-center text-lg">
                        <iconify-icon icon="hugeicons:payment-02" class="text-xl menu-icon d-inline me-4"> </iconify-icon>Pembayaran 
                    </div> 
                    '.$this->get_data_payment_pembelian($row).'
                </div>  
            </div>';
            $vendor = '<div class="text-head-3 text-wrap pt-2">'.($row->VendorId == 0 ? $row->VendorName : $row->VendorName).'</div>';
            // MENGAMBIL DATA Toko 
            $statusdoc = "Invoice";
            // MENGAMBIL DATA Toko 
            $store = '
                    <div class="d-flex align-items-center ">   
                        <span class="text-head-3 d-flex gap-0 align-items-center"><img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">'.$row->StoreCode.'</span> 
                        <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1 text-default '.($row->ProjectId == 0 ? "d-none" : "").'"><i class="fa-solid fa-diagram-project pe-1 "></i>Document Project</span>   
                    </div>';
            $data_row = array( 
                "POId" => $row->POId,
                "doc" =>$store.'<div class="text-neutral-400 text-xxs" style="line-height:1">'.$row->POCode.'</span>',
                "pembelian" => $row, 
                "code" => '<span class="text-primary-600 fw-bold">'.$row->POCode.'</span>
                <div class="d-flex gap-1 pt-4"> 
                '.$this->get_data_payment_pembelian($row,true).'</div>', 
                "date" =>  '<div class="text-head-3" style="line-height:1">'.date_format(date_create($row->PODate),"d M Y").'</div>', 
                "date2" =>  '<div class="text-head-3" style="line-height:1">'.date_format(date_create($row->PODate2),"d M Y").'</div>', 
                "status" => $status,
                "vendor" => $vendor,
                "store" => $store, 
                "note" => str_replace(array("\r\n", "\r", "\n"), '\n', $row->PONote), 
                "admin" => ucwords($row->username),  
                "biaya" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->POGrandTotal,0)."</span></div>", 
                "customer" => $row->POCustName,
                "customertelp" => ($row->POCustTelp ? $row->POCustTelp : ""),
                "customeraddress" => $row->POAddress,
                "detail" =>$htmldetail,
                "payment" => $this->get_data_payment_pembelian($row,true), 
                "delivery" => $this->get_data_delivery_pembelian($row,true), 
                "PaymentTotal" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->POGrandTotal - $this->get_data_payment_pembelian($row,true,true),0)."</span></div>", 
                "action" =>'  
                    <div class="d-flex align-items-center gap-1 justify-content-center">
                        <a onclick="print_po('.$row->POId.',this,\''.$statusdoc .'\')""
                            class="w-24-px h-24-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Print Pembelian">
                            <iconify-icon icon="lucide:printer"></iconify-icon>
                        </a>
                        <a onclick="edit_po('.$row->POId.',this,\''.$statusdoc .'\')"
                            class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Ubah Pembelian">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a onclick="delete_po('.$row->POId.',this,\''.$statusdoc .'\')"
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
    function get_data_forward_pembelian($type = 0,$ref = 0){ 
 
        if($type == "Penawaran"){
            $builder = $this->db->table("penawaran");
            $builder->where('SphId',$ref); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                return ' <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari survey">
                            <i class="fa-solid fa-street-view text-success"></i>
                            <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="pembelian_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SphId.'\',\'Penawaran\')">'.$queryref->SphCode.'</a>
                        </div>';  
            }
        } 
        if($type == "Invoice"){
            $builder = $this->db->table("invoice");
            $builder->where('InvId',$ref); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                return ' <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari Survey">
                            <i class="fa-solid fa-money-bill text-success"></i>
                            <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="pembelian_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->InvId.'\',\'Penawaran\')">'.$queryref->InvCode.'</a>
                        </div>'; 
            }
        } 
        return '<div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
            <a class="text-detail-3 pointer text-decoration-underline text-secondary">Tidak ada referensi</a>
        </div>'; 
    }

    function get_data_detail_pembelian($row){
        $modelsproduk = new master\ProdukModel();
        $detail = array(); 
        $detailhtml = ' <table class="table detail-item m-0 shadow-7">
                            <thead>
                                <tr>
                                    <th class="detail" style="width: 35px;">#</th>
                                    <th class="detail" colspan="2">Deskripsi</th> 
                                    <th class="detail">Qty</th>
                                    <th class="detail">Harga</th> 
                                    <th class="detail">Total</th>
                                </tr>
                            </thead>
                            <tbody>';
        $arr_detail = $this->get_data_pembelian_detail($row->POId);
        
        $abjad = 'A';
        $number = '1'; 
        foreach($arr_detail as $row_data){
            $arr_varian = json_decode($row_data->PODetailVarian);
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
                        "satuan_id"=> ($row_data->PODetailSatuanId == 0 ? "" : $row_data->PODetailSatuanId),
                        "satuan_text"=>$row_data->PODetailSatuanText,  
                        "price"=>$row_data->PODetailPrice,
                        "varian"=> JSON_DECODE($row_data->PODetailVarian,true),
                        "total"=> $row_data->PODetailTotal, 
                        "qty"=> $row_data->PODetailQty,
                        "text"=> $row_data->PODetailText,
                        "group"=> $row_data->PODetailGroup,
                        "type"=> $row_data->PODetailType,
                        "image_url"=> $modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->PODetailVarian,true)
                    );
                if($row_data->PODetailType == "product"){ 
                        $detailhtml .= ' <tr>
                        <td  class="detail text-center">'.$number.'.</td>
                            <td class="detail" style="width:4rem">
                                <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->PODetailVarian,true).'" alt="Gambar" class="image-produk w-50-px h-50-px rounded-3">
                            </td>
                            <td class="detail" style="min-width:350px">
                            <div class="d-flex flex-column text-start flex-fill order-md-4 order-3 justify-content-center">
                                <div class="fw-medium">'.$row_data->PODetailText.'</div>
                                <div class="text-detail-2 text-truncate text-xxs text-neutral-400" style="line-height:1">'.$row_data->PODetailGroup.'</div> 
                                <div class="d-flex gap-1 flex-wrap pt-4">'.$arr_badge.'</div></div>
                            </td>
                            <td class="detail">'.number_format($row_data->PODetailQty, 2, ',', '.').' '.$row_data->PODetailSatuanText.'</td>
                            <td class="detail">Rp. '.number_format($row_data->PODetailPrice, 0, ',', '.').'</td> 
                            <td class="detail">Rp. '.number_format($row_data->PODetailTotal, 0, ',', '.').'</td>
                            
                        </tr> ';
                        $number++;
                    }else{
                        $number = 1;
                        $detailhtml .= ' <tr>
                            <td  class="detail text-center  fw-bold">'.$abjad.'.</td>
                            <td colspan="6" class="detail">
                                <div class="d-flex flex-column text-start flex-fill order-md-4 order-3 justify-content-center">
                                    <span class="text-head-3">'.$row_data->PODetailText.'</span>
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
                <th class="bg-light" colspan="6">
                    <div class="d-flex m-1 gap-2 align-items-center justify-content-end pe-4"> 
                        <span class="text-detail-2">Sub Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->POSubTotal,0,',','.').'</span>  
                        <div class="divider-horizontal"></div> 
                        <span class="text-detail-2">Disc Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->PODiscTotal,0,',','.').'</span>   
                        <div class="divider-horizontal"></div> 
                        <span class="text-detail-2">Grand Total:</span>
                        <span class="text-head-2">Rp.'.number_format($row->POGrandTotal,0,',','.').'</span> 
                    </div>
                </th>
            </tr> 
        </tfoot>
        </table>';

        return $detailhtml; 
    }
    function get_data_payment_pembelian($row,$header = false, $total = false){ 
        $html_payment = ""; 
        $html_payment_detail = "";
        $payment_total = 0;
        if($row->POGrandTotal == 0){
            $html_payment = ' 
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:payment-02" class="text-success text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Tidak ada pembayaran" ></iconify-icon> 
                </button>   ';
            $html_payment_detail = ' 
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
            $builder->join("method","MethodId = PaymentMethod ","left"); 
            $builder->where('PaymentRef',$row->POId); 
            $builder->where('PaymentRefType',"Pembelian");
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
                    $statusdoc = 'Pembelian';
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
                    Belum ada pembayaran yang dibuat dari dokumen ini,<a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->POId.',this,\'Pembelian\')">Buat Pembayaran</a> 
                </span>
            </div> '; 
            }else if($payment_total < $row->POGrandTotal){  
                
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
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->POId.',this,\'Pembelian\')">Buat Pembayaran</a> 
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

    
    function get_data_delivery_pembelian($row,$header = false){
        $delivery = "";
        $delivery_detail = ""; 
        $modelsproduk = new master\ProdukModel();
        $modelsDelivery = new DeliveryModel();
        $builder = $this->db->table("delivery");
        $builder->select('*');    
        $builder->join("users","users.id = delivery.created_user ","left"); 
        $builder->where('DeliveryRef',$row->POId); 
        $builder->where('DeliveryRefType',"Pembelian");  
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
                <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Sampel Barang" onclick="edit_pembelian_delivery('.$row_delivery->DeliveryId.',this,'.$row_delivery->ProjectId.')"><i class="fa-solid fa-pen-to-square"></i></span>
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
                    <a class="text-detail-3 pointer text-decoration-underline text-success">'.$row->POCode.'</a>
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
            <tr class="child-row pembelian d-none" data-id="'.$row_delivery->DeliveryId.'">
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
            <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_pembelian_delivery('.$row->POId.',this)">Buat Pengiriman</a> atau 
            <a class="text-head-3 text-primary" style="cursor:pointer" onclick="update_pembelian_delivery('.$row->POId.',this,0)">nonaktifkan mode Pengiriman</a>
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

        if($header){
            return  $delivery;
        }else{
            return  $delivery_detail;

        }
    }

    function get_next_code_pembelian($date){
        //sample SPH/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("pembelian");  
        $builder->select("ifnull(max(SUBSTRING(POCode,4,3)),0) + 1 as nextcode"); 
        $builder->where("month(PODate2)",$arr_date[1]);
        $builder->where("year(PODate2)",$arr_date[0]); 
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)){
            case 1:
                $nextid = "PO/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "PO/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "PO/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "PO/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    } 

    function get_data_ref_pembelian($refid,$search = null){
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
                InvId refid, 
                InvCode as code,
                ProjectId ref,
                InvDate date,
                "Invoice" AS type,
                CustomerId as CustomerId,
                InvCustName as CustomerName,
                InvCustTelp as CustomerTelp,
                InvAddress as CustomerAddress,
                invoice.StoreId as StoreId,
                StoreCode as StoreCode,
                StoreName as StoreName
                FROM invoice left join store on invoice.StoreId=store.StoreId
                where InvStatusPO < 2 '.$querywhere.' 
        ) AS ref_join 
        ORDER BY ref_join.date asc'); 
        return $builder->getResultArray();  
    }
    function get_data_payment_po($row,$header = false,$total = false){
        $html_status = "";
        $html_status_detail = "";
        if($row->POGrandTotal == 0){
            $html_status = '  
            <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                <iconify-icon icon="hugeicons:payment-02" class="text-success text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Tidak ada pembayaran" ></iconify-icon> 
            </button>   
             ';
            $html_status_detail = '<div class="text-head-3 p-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran untuk transaksi ini  
                </div>';
        }else{ 
            $html_payment_detail = "";  
            $builder = $this->db->table("payment");
            $builder->select('*'); 
            $builder->join("users","users.id = payment.created_user ","left"); 
            $builder->join("method","MethodId = PaymentMethod ","left"); 
            $builder->where('PaymentRef',$row->POId); 
            $builder->where('PaymentRefType',"Pembelian");
            $builder->orderby('PaymentDoc', '1'); 
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult();  
            $payment_total = 0; 


            
            if($payment_total == 0){
                $html_status = '  
                <button class="position-relative rounded-circle d-flex justify-content-center align-items-center" type="button">
                    <iconify-icon icon="hugeicons:payment-02" class="text-primary-light text-xl" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Belum ada pembayaran" ></iconify-icon> 
                </button>   
                 ';
                $html_status_detail .= '  
                <div class="p-8 bg-warning-50 radius-8 border-start-width-3-px border-warning-main border-top-0 border-end-0 border-bottom-0 shadow-7 d-inline" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Belum ada pembayaran yang dibuat dari dokumen ini,  
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->POId.',this,\'Pembelian\')">Buat Pembayaran</a> 
                    </span>
                </div> 
                 '; 
            }
        }
        

        if($header){
            return  $html_status;
        }else{
            return  $html_status_detail;
        }
    }
    
    function get_data_pembelian($id){
        $builder = $this->db->table("pembelian");   
        $builder->select("*,  CASE 
        WHEN PORefType = '-' THEN 'No data Selected' 
        WHEN PORefType = 'Invoice' THEN (select InvCode from invoice where InvId = PORef) 
        WHEN PORefType = 'Penawaran' THEN (select SphCode from penawaran where SphId = PORef)
        END AS 'PORefCode',pembelian.VendorName VendorName,pembelian.ProjectId ProjectId,pembelian.CustomerId CustomerId");  
        $builder->join("invoice",'invoice.InvId=pembelian.PORef',"left");  
        $builder->join("template_footer","pembelian.TemplateId = template_footer.TemplateFooterId","left");
        $builder->join("project",'project.ProjectId=pembelian.ProjectId',"left"); 
        $builder->join("store","pembelian.StoreId = store.StoreId","left"); 
        $builder->join("users","id = POAdmin","left");
        $builder->join("customer","invoice.CustomerId = customer.CustomerId","left");
        $builder->where('POId',$id);  
        return $builder->get()->getRow();  
    } 

    function get_data_pembelian_detail($id){
        $builder = $this->db->table("pembelian_detail");
        $builder->where('PODetailRef',$id); 
        return $builder->get()->getResult();  
    } 


    function insert_data_pembelian($data){ 
        $header = $data["header"]; 

        $builder = $this->db->table("pembelian");
        $builder->insert(array(
            "POCode"=>$this->get_next_code_pembelian($header["PODate"]),
            "PODate"=>$header["PODate"],  
            "PODate2"=>$header["PODate2"],  
            "ProjectId"=>$header["ProjectId"],
            "PORef"=>$header["PORef"],
            "PORefType"=>$header["PORefType"], 
            "POAdmin"=>$header["POAdmin"], 
            "VendorId"=>$header["VendorId"], 
            "CustomerId"=>$header["CustomerId"], 
            "StoreId"=>$header["StoreId"], 
            "VendorName"=>$header["VendorName"], 
            "TemplateId"=>$header["TemplateId"],
            "POCustName"=>$header["POCustName"],
            "POCustTelp"=>$header["POCustTelp"],
            "POAddress"=>$header["POAddress"],
            "PONote"=>$header["PONote"],
            "POSubTotal"=>$header["POSubTotal"], 
            "PODiscTotal"=>$header["PODiscTotal"],
            "POGrandTotal"=>$header["POGrandTotal"],
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("pembelian");
        $builder->select('*');
        $builder->orderby('POId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["PODetailRef"] = $query->POId;
            $row["PODetailVarian"] = (isset($row["PODetailVarian"]) ? json_encode($row["PODetailVarian"]) : "[]");  
            $builder = $this->db->table("pembelian_detail");
            $builder->insert($row); 
        }  

        \App\Libraries\AccAutoJurnal::trySyncPembelian($query->POId); // jurnal otomatis

        //update status
        if($header["PORefType"] == "Invoice"){
            $builder = $this->db->table('invoice_detail id');
            $builder->select('id.ProdukId, id.InvDetailVarian, id.InvDetailQty, COALESCE(SUM(pd.PODetailQty), 0) AS PODetailQty');
            $builder->join('pembelian_detail pd', 'id.ProdukId = pd.ProdukId AND id.InvDetailVarian = pd.PODetailVarian', 'left');
            $builder->join('pembelian p', 'pd.PODetailRef = p.POId AND p.PORef = '.$header["PORef"].'', 'left');
            $builder->where('id.InvDetailRef', $header["PORef"]);
            $builder->groupBy('id.ProdukId, id.InvDetailVarian, id.InvDetailQty');
            $datadiff = $builder->get()->getResult();
            $some = true;
            foreach($datadiff as $row){
                if($row->PODetailQty < $row->InvDetailQty)$some = false;
            } 

            $invoiceModel = new InvoiceModel();  
            if($some){ 
                $invoiceModel->update_status_invoice_po($header["PORef"],2);
            }else{
                $invoiceModel->update_status_invoice_po($header["PORef"],1); 
            } 
        }

    } 
    function update_data_pembelian($data,$id){
        $header = $data["header"];
        $builder = $this->db->table("pembelian");
        $builder->set('PODate', $header["PODate"]);
        $builder->set('PODate2', $header["PODate2"]);
        $builder->set('VendorId', $header["VendorId"]);
        $builder->set('VendorName', $header["VendorName"]);
        $builder->set('PONote', $header["PONote"]);
        $builder->set('POCustName', $header["POCustName"]);
        $builder->set('POCustTelp', $header["POCustTelp"]);
        $builder->set('POAddress', $header["POAddress"]);
        $builder->set('TemplateId', $header["TemplateId"]);
        $builder->set('POSubTotal', $header["POSubTotal"]);
        $builder->set('PODiscTotal', $header["PODiscTotal"]);
        $builder->set('POGrandTotal', $header["POGrandTotal"]);
        $builder->set('updated_user',user()->id);
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));
        $builder->where('POId', $id);
        $builder->update();

        $builder = $this->db->table("pembelian_detail");
        $builder->where('PODetailRef',$id);
        $builder->delete();

        // ADD DETAIL PRODUK
        foreach($data["detail"] as $row){
        $row["PODetailRef"] = $id;
        $row["PODetailVarian"] = (isset($row["PODetailVarian"]) ? json_encode($row["PODetailVarian"]) : "[]");
        $builder = $this->db->table("pembelian_detail");
        $builder->insert($row);
        }

        \App\Libraries\AccAutoJurnal::trySyncPembelian($id); // jurnal otomatis

        //update status
        if($header["PORefType"] == "Invoice"){
        $builder = $this->db->table('invoice_detail id');
        $builder->select('id.ProdukId, id.InvDetailVarian, id.InvDetailQty, COALESCE(SUM(pd.PODetailQty), 0) AS PODetailQty');
        $builder->join('pembelian_detail pd', 'id.ProdukId = pd.ProdukId AND id.InvDetailVarian = pd.PODetailVarian', 'left');
        $builder->join('pembelian p', 'pd.PODetailRef = p.POId AND p.PORef = '.$header["PORef"].'', 'left');
        $builder->where('id.InvDetailRef', $header["PORef"]);
        $builder->groupBy('id.ProdukId, id.InvDetailVarian, id.InvDetailQty');
        $datadiff = $builder->get()->getResult();
        $some = true;
        foreach($datadiff as $row){
        if($row->PODetailQty < $row->InvDetailQty)$some = false;
        }

        $invoiceModel = new InvoiceModel();
        if($some){
        $invoiceModel->update_status_invoice_po($header["PORef"],2);
        }else{
        $invoiceModel->update_status_invoice_po($header["PORef"],1);
        }
        }
    }
    function delete_data_pembelian($id){
        $dataold = $builder = $this->getWhere(['POId' => $id], 1)->getRow();

        $builder = $this->db->table("pembelian");
        $builder->set('POStatus', 3);
        $builder->set('updated_user', user()->id);
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));
        $builder->where('POId', $id);
        $builder->update();

        \App\Libraries\AccAutoJurnal::trySyncPembelian($id); // jurnal otomatis (PO batal -> jurnal dihapus)

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
        "menu"=>"Pembelian",
        "type"=>"Status",
        "name"=> "Status Data Pembelian diubah dari ".$statuslist[$dataold->POStatus]." menjadi Cancel dengan nomor
        ".$dataold->POCode,
        "desc"=> json_encode([]),
        "created_user"=>user()->id,
        "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),
        )
        );

        return JSON_ENCODE(array("status"=>true));
        }
        function update_status_pembelian($id,$status){
            $dataold = $builder = $this->getWhere(['POId' => $id], 1)->getRow();

            $builder = $this->db->table("pembelian");
            $builder->set('POStatus', $status);
            $builder->set('updated_user', user()->id);
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));
            $builder->where('POId', $id);
            $builder->update();

            \App\Libraries\AccAutoJurnal::trySyncPembelian($id); // jurnal otomatis (status Cancel <-> aktif)

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
            "menu"=>"Pembelian",
            "type"=>"Status",
            "name"=> "Status Data Pembelian diubah dari ".$statuslist[$dataold->POStatus]." menjadi ".$statuslist[$status]
            . " dengan nomor ".$dataold->POCode,
            "desc"=> json_encode([]),
            "created_user"=>user()->id,
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),
            )
            );

            return JSON_ENCODE(array("status"=>true));
        }

        function update_comment($comment,$id){
        $dataold = $builder = $this->getWhere(['POId' => $id], 1)->getRow();

        $builder = $this->db->table("pembelian");
        $builder->set('PONote', $comment);
        $builder->set('updated_user', user()->id);
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));
        $builder->where('POId', $id);
        $builder->update();

        //create Log action
        $activityModel = new ActivityModel();
        $activityModel->insert(
        array(
        "menu"=>"Pembelian",
        "type"=>"Comment",
        "name"=> "Catatan Data pembelian diubah dari ".$dataold->PONote." menjadi ".$comment . " dengan nomor
        ".$dataold->POCode,
        "desc"=> json_encode([]),
        "created_user"=>user()->id,
        "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),
        )
        );

        return JSON_ENCODE(array("status"=>true));
    }
}