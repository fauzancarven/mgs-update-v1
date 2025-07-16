<?php

namespace App\Models; 

use CodeIgniter\Model; 
use CodeIgniter\Database\RawSql;
use App\Models\NotificationModel; 
use App\Models\ActivityModel;

class PembelianModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'payment';
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
        if(isset($filter["store"])){ 
            $builder->whereIn("pembelian.StoreId",$filter["store"]); 
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

        $builder->limit($length,$start); 
        $query = $builder->get();  
        foreach($query->getResult() as $row){
           
  
            // MENGAMBIL DATA STATUS
            $status = "";
            if($row->POStatus==0){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-primary text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >New</span>
                    </span> ';
            }
            if($row->POStatus==1){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-info text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Proses</span>
                    </span> '; 
            }
            if($row->POStatus==2){ 
                $status .= '
                    <span class=" pointertext-head-3 badge text-bg-success text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Completed</span>
                    </span> ';  
            }
            if($row->POStatus==3){ 
                $status .=  '
                    <span class="pointer text-head-3 badge text-bg-danger text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Cancel</span>
                    </span> ';  
            }
            $status .= '  
            <ul class="dropdown-menu shadow drop-status ">
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(0,'.$row->POId.',this)">
                        New
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(1,'.$row->POId.',this)">
                        </i>Proses
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(2,'.$row->POId.',this)">
                        Completed
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(3,'.$row->POId.',this)">
                        Cancel
                    </a>
                </li>  
            </ul>';
                
             
            
            // MENGAMBIL DATA Pembayaran  
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
                    '.$this->get_data_detail_pembelian($row).'
                </div>
                <div class="list-detail pb-3">
                    <div class="text-head-2 py-1"> 
                        <span class="fa-stack small">
                            <i class="fa-regular fa-circle fa-stack-2x"></i>
                            <i class="fa-solid fa-money-bill fa-stack-1x fa-inverse"></i> 
                        </span>
                        <span>Pembayaran</span> 
                    </div> 
                    '.$this->get_data_payment_pembelian($row).'
                </div> 
                <div class="list-detail pb-3">
                    <div class="text-head-2 py-1">
                        <span class="fa-stack small">
                            <i class="fa-regular fa-circle fa-stack-2x"></i>
                            <i class="fa-solid fa-truck fa-stack-1x fa-inverse"></i> 
                        </span>
                        <span>Pengiriman</span> 
                    </div> 
                    '.$this->get_data_delivery_pembelian($row).'
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
                "pembelian" => $row, 
                "code" => $row->POCode,
                "date" =>date_format(date_create($row->PODate),"d M Y"),
                "status" => $status,
                "store" => $store,
                "admin" => ucwords($row->username), 
                "vendor" => ($row->VendorId == 0 ? $row->NameVendor : $row->VendorName) ,
                "biaya" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->POGrandTotal,0)."</span></div>", 
                "customer" => $row->POCustName,
                "customertelp" => ($row->POCustTelp ? $row->POCustTelp : ""),
                "customeraddress" => $row->POAddress,
                "detail" =>$htmldetail,
                "payment" => $this->get_data_payment_pembelian($row,true), 
                "delivery" => $this->get_data_delivery_pembelian($row,true), 
                "PaymentTotal" => 0,
                "action" =>'  
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Form PO" onclick="print_pembelian('.$row->POId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data PO" onclick="edit_pembelian('.$row->POId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data PO" onclick="delete_pembelian('.$row->POId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-circle-xmark"></i></span>
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


    function get_data_detail_pembelian($row){
        $modelsproduk = new ProdukModel();
        $detail = array(); 
        $detailhtml = ' <table class="table detail-item m-0 vw-100">
                            <thead>
                                <tr>
                                    <th class="detail text-center" style="width:50px">Gambar</th>
                                    <th class="detail">Nama</th>
                                    <th class="detail">Qty</th>
                                    <th class="detail">Harga</th> 
                                    <th class="detail">Total</th>
                                </tr>
                            </thead>
                            <tbody>';
        $arr_detail = $this->get_data_pembelian_detail($row->POId);
        foreach($arr_detail as $row_data){
            $arr_varian = json_decode($row_data->PODetailVarian);
            $arr_badge = "";
            $arr_no = 0;
            foreach($arr_varian as $varian){
                $arr_badge .= '<span class="badge badge-sm badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
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

            $detailhtml .= ' <tr>
                    <td class="detail">
                        <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->PODetailVarian,true).'" alt="Gambar" class="image-produk">
                    </td>
                    <td class="detail">
                        <span class="text-head-3">'.$row_data->PODetailText.'</span><br>
                        <span class="text-detail-2 text-truncate">'.$row_data->PODetailGroup.'</span> 
                        <div class="d-flex gap-1 flex-wrap">'.$arr_badge.'</div>
                    </td>
                    <td class="detail">'.number_format($row_data->PODetailQty, 2, ',', '.').' '.$row_data->PODetailSatuanText.'</td>
                    <td class="detail">Rp. '.number_format($row_data->PODetailPrice, 0, ',', '.').'</td> 
                    <td class="detail">Rp. '.number_format($row_data->PODetailTotal, 0, ',', '.').'</td>
                </tr> ';
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
 
    function get_data_delivery_pembelian($row,$header = false){
        $delivery = "";
        $delivery_detail = ""; 
        $modelsproduk = new ProdukModel();
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
            <span class="text-head-3 delivery">
                <span class="badge text-bg-warning me-1">Belum ada</span>
            </span>';
            $delivery_detail = '<div class="text-head-3 p-2">
            <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
            pengriman belum dibuat untuk transaksi ini, 
            <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_pembelian_delivery('.$row->POId.',this)">Buat Pengiriman</a> atau 
            <a class="text-head-3 text-primary" style="cursor:pointer" onclick="update_pembelian_delivery('.$row->POId.',this,0)">nonaktifkan mode Pengiriman</a>
        </div>';
        }else{ 
            $delivery = ' 
            <span class="text-head-3 delivery">
                <span class="badge text-bg-success me-1">Selesai</span>
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
    function get_data_payment_pembelian($row,$header = false, $total = false){ 
        $html_payment = ""; 
        $html_payment_detail = "";
        $payment_total = 0;
        if($row->POGrandTotal == 0){
            
            $html_payment = ' 
                    <span class="text-head-3 payment">
                        <span class="badge text-bg-success me-1">Tidak ada</span>
                    </span>';
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
            $builder->where('PaymentRef',$row->POId); 
            $builder->where('PaymentRefType',"Pembelian");
            $builder->orderby('PaymentDoc', '1'); 
            $builder->orderby('PaymentId', 'ASC'); 
            $payment = $builder->get()->getResult();  
            $payment_total = 0;
            $performa_total = 0; 
            foreach($payment as $row_payment){  
                if($row_payment->PaymentStatus == "0"){ 
                    $action = '
                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah data pembayaran" onclick="request_payment_edit('.$row_payment->PaymentId.',this,\'Pembelian\')"><i class="fa-solid fa-pen-to-square"></i></span>
                    <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan data pembayaran" onclick="request_payment_delete('.$row_payment->PaymentId.',this,\'Pembelian\')"><i class="fa-solid fa-circle-xmark"></i></span>';
                    $transfer_from = '<td class="detail">-</td>';
                    $status =  '<span class="badge text-bg-info me-1 pointer" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Approval">Request by '.ucwords($row_payment->username).'</span>'; 
                    $bukti = '';
                }else{ 
                    $bukti = '';
                    $action = '
                    <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak data pembayaran" onclick="print_payment('.$row_payment->PaymentId.',this,\'Pembelian\')"><i class="fa-solid fa-print"></i></span>';
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
                $html_payment_detail .= '
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
                
                $html_payment = ' 
                <span class="text-head-3 payment">
                    <span class="badge text-bg-warning me-1">Belum ada</span>
                </span>';
                $html_payment_detail .= ' <div class="alert alert-warning p-2 m-1" role="alert">
                    <span class="text-head-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                        Belum ada pembayaran yang dibuat dari dokumen ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->POId.',this,\'Pembelian\')">Ajukan pembayaran</a> 
                    </span>
                </div> '; 
            }else if($payment_total < $row->POGrandTotal){  
                
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
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="request_payment('.$row->POId.',this,\'Pembelian\')">Ajukan pembayaran</a> 
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
        if($total){
            return $payment_total;
        }else{
            if($header){
                return $html_payment;
            }else{
                return $html_payment_detail; 
            }
        }
    }




    
    function get_data_pembelian_detail($id){
        $builder = $this->db->table("pembelian_detail");
        $builder->where('PODetailRef',$id); 
        return $builder->get()->getResult();  
    } 

}