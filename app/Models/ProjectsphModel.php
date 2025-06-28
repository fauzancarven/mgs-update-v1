<?php

namespace App\Models; 

use CodeIgniter\Model;  
use CodeIgniter\Database\RawSql;
use App\Models\ProjectModel; 
use App\Models\ProdukModel; 
use App\Models\ActivityModel;

class ProjectsphModel extends Model
{  
    protected $DBGroup = 'default';
    protected $table = 'penawaran';
    function load_datatable_project_penawaran($filter = null){
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();

        $builder = $this->db->table("penawaran");
        $builder->join("project","project.ProjectId = penawaran.ProjectId ","left");  
        $builder->join("users","users.id = penawaran.SphAdmin ","left"); 
        $builder->join("store","store.StoreId = penawaran.StoreId","left");  
        if($filter["datestart"]){
            $builder->where("SphDate >=",$filter["datestart"]);
            $builder->where("SphDate <=",$filter["dateend"]); 
        }
        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();

        if(isset($filter["filter"])){ 
            $builder->whereIn("SphStatus",$filter["filter"]); 
            $filterdata = 1;
        } 
        if(isset($filter["store"])){ 
            $builder->whereIn("penawaran.StoreId",$filter["store"]); 
            $filterdata = 1;
        } 
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("username",$filter["search"]); 
            $builder->orLike("SphAddress",$filter["search"]);
            $builder->orLike("SphCustName",$filter["search"]);
            $builder->orLike("SphCustTelp",$filter["search"]);
            $builder->orLike("SphCode",$filter["search"]);
            $builder->groupEnd();  
            $filterdata = 1;
        }

        // Order TAble
        $columns = array(
            0 => null, // kolom action tidak dapat diurutkan
            1 => null, // kolom action tidak dapat diurutkan 
            2 => "StoreCode", // kolom name
            3 => "SphCode", // kolom name
            4 => "SphDate", // kolom action tidak dapat diurutkan
            5 => "SphStatus", // kolom image tidak dapat diurutkan
            6 => "SphAdmin", // kolom action tidak dapat diurutkan
            7 => "SphCustName", // kolom action tidak dapat diurutkan
            8 => "SphGrandTotal", // kolom action tidak dapat diurutkan
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
            if($row->SphStatus==0){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-primary text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >New</span>
                    </span> '; 
            }
            if($row->SphStatus==1){
                $status .= '
                    <span class="pointer text-head-3 badge text-bg-info text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Proses</span>
                    </span> '; 
            }
            if($row->SphStatus==2){
                $status .= '
                    <span class=" pointertext-head-3 badge text-bg-success text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Completed</span>
                    </span> ';  
            }
            if($row->SphStatus==3){
                $status .=  '
                    <span class="pointer text-head-3 badge text-bg-danger text-head-3 dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="Update Status">
                        <span class="me-1 " >Cancel</span>
                    </span> ';  
            }
            $status .= '  
            <ul class="dropdown-menu shadow drop-status ">
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(0,'.$row->SphId.',this)">
                        New
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(1,'.$row->SphId.',this)">
                        </i>Proses
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(2,'.$row->SphId.',this)">
                        Completed
                    </a>
                </li> 
                <li>
                    <a class="dropdown-item m-0 px-2" onclick="update_status(3,'.$row->SphId.',this)">
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
                    '.$this->get_data_detail_penawaran($row).'
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
                "penawaran" => $row,
                "code" => $row->SphCode.$this->get_data_forward_penawaran($row->SphRefType,$row->SphRef).$this->get_data_return_penawaran($row->SphId,$row->ProjectId,$row->SphStatus),
                "date" => date_format(date_create($row->SphDate),"d M Y"),
                "status" => $status,
                "admin" => ucwords($row->username),
                "total" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->SphGrandTotal,0)."</span></div>",
                "customer" => ucwords($row->SphCustName),
                "customertelp" => ($row->SphCustTelp ? $row->SphCustTelp : ""), 
                "customeraddress" => $row->SphAddress, 
                "store"=>$store,
                "detail" => $htmldetail, 
                "action" =>'  
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Data Penawaran" onclick="print_sph('.$row->SphId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="edit_sph('.$row->SphId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Penawaran" onclick="delete_sph('.$row->SphId.',this,\''.$row->ProjectId.'\')"><i class="fa-solid fa-circle-xmark"></i></span>
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
    function load_table_project_penawaran($filter = null){
        $builder = $this->db->table("penawaran");
        $builder->join("project","project.ProjectId = penawaran.ProjectId ","left");  
        $builder->join("users","users.id = penawaran.SphAdmin ","left"); 
        $builder->join("store","store.StoreId = project.StoreId","left");  
        if($filter["datestart"]){
            $builder->where("SphDate >=",$filter["datestart"]);
            $builder->where("SphDate <=",$filter["dateend"]); 
        }
        
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("ProjectName",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("SphAddress",$filter["search"]);
            $builder->orLike("SphCode",$filter["search"]);
            $builder->groupEnd();  
        }
        
        if(isset($filter["status"])){ 
            $builder->whereIn("SphStatus",$filter["status"]); 
        }
        $builder->orderby('penawaran.SphId', 'DESC'); 
        $perPage = 10;
        $page = $filter["paging"]; // atau dapatkan dari parameter GET 
        $offset = ($page - 1) * $perPage; 
        $builder->limit($perPage, $offset);
        $query = $builder->get();  
        $count = $query->getNumRows();


        $html = "";
        foreach($query->getResult() as $row){   
            $builder = $this->db->table("penawaran_detail");
            $builder->select('*'); 
            $builder->where('SphDetailRef',$row->SphId);
            $builder->orderby('SphDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A";

            $builder = $this->db->table("invoice");
            $builder->select('*');
            $builder->where('SphId',$row->SphId); 
            $builder->orderby('InvId', 'DESC'); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                $alert = ' 
                    <script>
                        function penawaran_return_click_'.$row->ProjectId.'_'.$queryref->InvId.'(){
                            $(".icon-project[data-menu=\'invoice\'][data-id=\''.$row->ProjectId.'\'").trigger("click");
                            setTimeout(function() {
                                $("html, body").scrollTop($(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").offset().top - 200); 
                                $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").removeClass("show"); 
                                    }, 1000); // delay 1 detik
                                })

                            }, 1000); // delay 1 detik
                        }
                    </script>  
                    <div class="alert alert-success p-2 m-1" role="alert">
                        <span class="text-head-2"><i class="fa-solid fa-check text-success me-2 text-success"></i>Penawaran berhasil diteruskan, dengan No. Invoice :  <a class="text-head-2" style="cursor:pointer" onclick="penawaran_return_click_'.$row->ProjectId.'_'.$queryref->InvId.'()">'.$queryref->InvCode.'</a></span>
                    </div>';
            }else{
                
                $alert = '<div class="alert alert-primary p-2 m-1" role="alert"> 
                    <span class="text-head-2">
                        <i class="fa-solid fa-reply me-2 fa-rotate-180" style="font-size:0.75rem"></i>
                        Teruskan penawran ini ke 
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_invoice('.$row->ProjectId.',this,'.$row->SphId.',\'penawaran\')">Invoice</a> 
                        atau pembuatan 
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_spk('.$row->ProjectId.',this,'.$row->SphId.',\'penawaran\')">Perintah Kerja (SPK)</a>
                    </span> 
                </div>';  
            }
            foreach($items as $item){

                $folder = 'assets/images/produk/'.$item->ProdukId."/";
                $default = 'assets/images/produk/default.png';
    
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);  
                } 
                $files = array_diff(scandir($folder), array('.', '..')); 
                $gambar = null;
    
                foreach ($files as $file) {
                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        $gambar = $folder . $file;
                        break;
                    }
                }  

                $arr_varian = json_decode($item->SphDetailVarian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }

                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-4 my-1 varian">   
                        <div class="d-flex gap-2 align-items-center"> 
                            ' . ($item->SphDetailType == "product" ? ($gambar ? "<img src='".base_url().$gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url().$default."' alt='Gambar Default'>") : "").'  
                            <div class="d-flex flex-column text-start">
                                <span class="text-head-3 text-uppercase"  '.($item->SphDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SphDetailText.'</span>
                                '.($item->SphDetailGroup == "" ? "" : '<span class="text-detail-2 text-truncate"  '.($item->SphDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->SphDetailGroup.'</span>').'
                                '.($arr_badge == "" ? "" : '<div class="d-flex flex-wrap gap-1"> '.$arr_badge.'</div>').' 
                            </div> 
                        </div>
                    </div>';
                if($item->SphDetailType == "product"){
                    $html_items .= '<div class="col-12 col-md-8 my-1 detail">
                                        <div class="row"> 
                                            <div class="col-6 col-md-2">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Qty:</span>
                                                    <span class="text-head-2">'.number_format($item->SphDetailQty, 2, ',', '.').' '.$item->SphDetailSatuanText.'</span>
                                                </div>
                                            </div>  
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Harga Satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SphDetailPrice, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Disc Satuan:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SphDetailDisc, 0, ',', '.').'</span>
                                                </div>
                                            </div> 
                                            <div class="col-6 col-md-3">   
                                                <div class="d-flex flex-column">
                                                    <span class="text-detail-2">Total:</span>
                                                    <span class="text-head-2">Rp. '.number_format($item->SphDetailTotal, 0, ',', '.').'</span>
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

            $status = "";
            if($row->SphStatus==0){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-primary me-1 pointer" onclick="update_status_survey(0,'.$row->SurveyId.')">Baru</span></span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-regular fa-share-from-square pe-1"></i>Diteruskan</span>
                    </div>
                    <div class="col-8"> 
                        <span class="text-head-3"><a class="text-detail-2" onclick="forward_survey_invoice('.$row->SurveyId.')">Buat Invoice</a></span>
                    </div>
                </div> ';
            }
            if($row->SphStatus==1){
                $status .= ' 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-success me-1 pointer" onclick="update_status_survey(1,'.$row->SurveyId.')">Selesai</span></span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-regular fa-share-from-square pe-1"></i>Diteruskan</span>
                    </div>
                    <div class="col-8">
                        <a class="text-head-3" style="cursor:pointer" onclick="penawaran_return_click_'.$row->ProjectId.'_'.$queryref->InvId.'()">'.$queryref->InvCode.'</a>
                    </div>
                </div>  ';
            } 
            if($row->SphStatus==2){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-danger me-1 pointer" onclick="update_status_survey(3,'.$row->SurveyId.')">Batal</span></span>
                    </div>
                </div> '; 
            }
            $html .= '
            <div class="card project mb-4 p-2" data-id="'.$row->SphId.'" data-project="'.$row->ProjectId.'">
                <div class="row pb-2">
                    <div class="col-md-3 col-10 order-0 project-store d-flex-column mb-md-0 mb-2"> 
                        <div class="d-flex align-items-center ">
                            <div class="flex-shrink-0 ">
                                <img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">
                            </div>
                            <div class="flex-grow-1 ms-1">
                                <div class="d-flex flex-column"> 
                                    <span class="text-head-2 d-flex gap-1 align-items-center"><div>'.$row->StoreCode.' - '.$row->StoreName.'</div></span> 
                                </div>   
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-12 order-2 order-sm-1">
                        <div class="d-flex flex-column">
                            <span class="text-head-2">'.$row->ProjectName.'</span>
                            <span class="text-detail-2 text-truncate overflow-x-auto">Catatan : '.$row->ProjectComment.'</span>  
                        </div> 
                    </div>   
                </div>


                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">
                    <div class="col-12  col-md-4 order-1 order-sm-0">
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Penawaran</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SphCode.'</span>
                            </div>
                        </div>  
                        '.$status.'
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.date_format(date_create($row->SphDate),"d M Y").'</span>
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
                                <span class="text-detail-2"><i class="fa-solid fa-user pe-1"></i>PIC Lapangan</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SphCustName.'</span>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-phone pe-1"></i>No. Hp</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SphCustTelp.'</span>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-location-dot pe-1"></i>Lokasi</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SphAddress.'</span>
                            </div>
                        </div>  
                    </div> 
                    <div class="col-12  col-md-3 order-0 order-sm-2">
                        <div class="float-end d-md-flex d-none gap-1">  
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_sph('.$row->ProjectId.','.$row->SphId.',this)">
                                <i class="fa-solid fa-print mx-1"></i><span >Print</span>
                            </button>
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_sph('.$row->ProjectId.','.$row->SphId.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Ubah</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_sph('.$row->ProjectId.','.$row->SphId.',this)">
                                <i class="fa-solid fa-close mx-1"></i><span >Hapus</span>
                            </button> 
                        </div> 
                        <div class="d-md-none d-flex btn-action justify-content-between"> 
                            <div class="text-head-1">Survey</div>
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow"> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_sph('.$row->ProjectId.','.$row->SphId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_sph('.$row->ProjectId.','.$row->SphId.',this)"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div>  
                </div> 
                <div class="detail-item p-2 border-top">
                    '.$html_items.' 
                </div>
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center flex-wrap"> 
                    <span class="text-detail-2">Sub Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SphSubTotal, 0, ',', '.').'</span>  
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Disc Item:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SphDiscItemTotal, 0, ',', '.').'</span>   
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Disc Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SphDiscTotal, 0, ',', '.').'</span>   
                    <div class="divider-horizontal"></div>
                    <span class="text-detail-2">Grand Total:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SphGrandTotal, 0, ',', '.').'</span> 
                </div> 
            </div> 
            ';
        }
        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Tidak ada data yang ditemukan</span> 
                </div> 
            ';
        }

        //get data total
        $builder = $this->db->table("penawaran");
        $builder->join("project","project.ProjectId = penawaran.ProjectId ","left"); 
        $builder->join("users","users.id = penawaran.SphAdmin ","left"); 
         
        if($filter["datestart"]){
            $builder->where("SphDate >=",$filter["datestart"]);
            $builder->where("SphDate <=",$filter["dateend"]); 
        }
        
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("ProjectName",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("SphAddress",$filter["search"]);
            $builder->orLike("SphCode",$filter["search"]);
            $builder->groupEnd();  
        }
        
        if(isset($filter["status"])){ 
            $builder->whereIn("SphStatus",$filter["status"]); 
        }
        $countTotal = $builder->get()->getNumRows();
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html,
                "total"=>$countTotal,
                "totalresult"=>$count,
                "paging"=>$offset, 
            )
        ); 
    }

    
    function get_data_detail_penawaran($row){ 
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
        $arr_detail = $this->get_data_sph_detail($row->SphId);
        foreach($arr_detail as $row_data){
            $arr_varian = json_decode($row_data->SphDetailVarian);
            $arr_badge = "";
            $arr_no = 0;
            foreach($arr_varian as $varian){
                $arr_badge .= '<span class="badge badge-sm badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                $arr_no++;
            }
            $detail[] = array(
                        "id" => $row_data->ProdukId,  
                        "produkid" => $row_data->ProdukId, 
                        "satuan_id"=> ($row_data->SphDetailSatuanId == 0 ? "" : $row_data->SphDetailSatuanId),
                        "satuan_text"=>$row_data->SphDetailSatuanText,  
                        "price"=>$row_data->SphDetailPrice,
                        "varian"=> JSON_DECODE($row_data->SphDetailVarian,true),
                        "total"=> $row_data->SphDetailTotal,
                        "disc"=> $row_data->SphDetailDisc,
                        "qty"=> $row_data->SphDetailQty,
                        "text"=> $row_data->SphDetailText,
                        "group"=> $row_data->SphDetailGroup,
                        "type"=> $row_data->SphDetailType,
                        "image_url"=> $modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->SphDetailVarian,true)
                    );

            $detailhtml .= ' <tr>
                    <td class="detail">
                        <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->SphDetailVarian,true).'" alt="Gambar" class="image-produk">
                    </td>
                    <td class="detail">
                        <span class="text-head-3">'.$row_data->SphDetailText.'</span><br>
                        <span class="text-detail-2 text-truncate">'.$row_data->SphDetailGroup.'</span> 
                        <div class="d-flex gap-1 flex-wrap">'.$arr_badge.'</div>
                    </td>
                    <td class="detail">'.number_format($row_data->SphDetailQty, 2, ',', '.').' '.$row_data->SphDetailSatuanText.'</td>
                    <td class="detail">Rp. '.number_format($row_data->SphDetailPrice, 0, ',', '.').'</td>
                    <td class="detail">Rp. '.number_format($row_data->SphDetailDisc, 0, ',', '.').'</td>
                    <td class="detail">Rp. '.number_format($row_data->SphDetailTotal, 0, ',', '.').'</td>
                </tr> ';
        };
        $detailhtml .= '
        </tbody>
        <tfoot>
            <tr>
                <th class="bg-light" colspan="6">
                    <div class="d-flex m-1 gap-2 align-items-center justify-content-end pe-4"> 
                        <span class="text-detail-2">Sub Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->SphSubTotal,0,',','.').'</span>  
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Disc Item:</span>
                        <span class="text-head-2">Rp. '.number_format($row->SphDiscItemTotal,0,',','.').'</span>   
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Disc Total:</span>
                        <span class="text-head-2">Rp. '.number_format($row->SphDiscTotal,0,',','.').'</span>   
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Pengiriman:</span>
                        <span class="text-head-2">Rp. '.number_format($row->SphDeliveryTotal,0,',','.').'</span> 
                        <div class="divider-horizontal"></div>
                        <span class="text-detail-2">Grand Total:</span>
                        <span class="text-head-2">Rp.'.number_format($row->SphGrandTotal,0,',','.').'</span> 
                    </div>
                </th>
            </tr> 
        </tfoot>
        </table>';

        return $detailhtml;

    } 
    function get_data_forward_penawaran($type = 0,$ref = 0){ 
 
        if($type == "Survey"){
            $builder = $this->db->table("survey");
            $builder->where('SurveyId',$ref); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                return ' <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data referensi dari survey">
                            <i class="fa-solid fa-street-view text-success"></i>
                            <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="penawaran_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SurveyId.'\',\'Penawaran\')">'.$queryref->SurveyCode.'</a>
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
                            <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="penawaran_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SampleId.'\',\'Penawaran\')">'.$queryref->SampleCode.'</a>
                        </div>'; 
            }
        } 
        return '<div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
            <a class="text-detail-3 pointer text-decoration-underline text-secondary">Tidak ada referensi</a>
        </div>'; 
    }
    function get_data_return_penawaran($id,$project = 0,$status = 0){ 
        //check Sample
        $builder = $this->db->table("sample");
        $builder->select('*');
        $builder->where('SampleRef',$id); 
        $builder->where('SampleRefType',"Penawaran");  
        $builder->orderBy('SampleId', 'DESC'); 
        $queryref = $builder->get()->getRow();  
        if($queryref){
            return '  
                    <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data diteruskan ke sample barang">
                        <i class="fa-solid fa-share-from-square text-success"></i>
                        <a class="text-detail-3 pointer text-decoration-underline text-success" onclick="survey_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SampleId.'\',\'Penawaran\')">'.$queryref->SampleCode.'</a>
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
                                <a class="text-detail-3 dropdown-item m-0 px-2" onclick="survey_return_add_click(\''.$project.'\',this,\''.$id.'\',\'Sample\')">Sample</a>
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
    
    function get_data_sph($id){  
        $builder = $this->db->table("penawaran");  
        $builder->select("*, CASE 
        WHEN SphRefType = '-' THEN 'No data Selected'
        WHEN SphRefType = 'Survey' THEN (select SurveyCode from survey where SurveyId = SphRef)
        WHEN SphRefType = 'Sample' THEN (select SampleCode from sample where SampleId = SphRef)
        END AS 'SphRefCode'"); 
        $builder->join("project","project.ProjectId = penawaran.ProjectId","left"); 
        $builder->join("store","store.StoreId = penawaran.StoreId","left"); 
        $builder->join("customer","penawaran.CustomerId = customer.CustomerId","left");
        $builder->join("template_footer","penawaran.TemplateId = template_footer.TemplateFooterId","left");
        $builder->where('penawaran.SphId',$id); 
        $builder->limit(1);
        return $builder->get()->getRow();   
    }  
    function get_data_sph_detail($id){
        $builder = $this->db->table("penawaran_detail");
        $builder->where('SphDetailRef',$id); 
        return $builder->get()->getResult();  
    }
    function get_data_sph_ref($refid = null,$data = null){ 
        if(isset($data["searchTerm"])){
            $querywhere  = " WHERE (
                code like '%".$data["searchTerm"]."%' or 
                CustomerTelp like '%".$data["searchTerm"]."%' or 
                CustomerName like '%".$data["searchTerm"]."%' or 
                CustomerAddress like '%".$data["searchTerm"]."%' 
            ) ";
        }else{
            $querywhere = "";
        }  
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
        ) AS ref_join
        LEFT JOIN project ON project.ProjectId = ref_join.ref  
        '. $querywhere ); 
        return $builder->getResultArray();  
    } 
    function get_next_code_sph($date){
        //sample SPH/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table("penawaran");  
        $builder->select("ifnull(max(SUBSTRING(SphCode,5,3)),0) + 1 as nextcode"); 
        $builder->where("month(SphDate2)",$arr_date[1]);
        $builder->where("year(SphDate2)",$arr_date[0]);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "SPH/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "SPH/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "SPH/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "SPH/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    } 
    function insert_data_sph($data){ 
        $header = $data["header"]; 
        $getnextcode = $this->get_next_code_sph($header["SphDate"]);
        $builder = $this->db->table("penawaran");
        $builder->insert(array(
            "SphCode"=>$getnextcode,
            "SphDate"=>$header["SphDate"],
            "SphDate2"=>$header["SphDate"],  
            "ProjectId"=>$header["ProjectId"], 
            "CustomerId"=>$header["CustomerId"], 
            "StoreId"=>$header["StoreId"], 
            "SphRef"=>$header["SphRef"],
            "SphRefType"=>$header["SphRefType"],
            "SphAdmin"=>$header["SphAdmin"],
            "SphCustName"=>$header["SphCustName"],
            "SphCustTelp"=>$header["SphCustTelp"], 
            "SphAddress"=>$header["SphAddress"],
            "TemplateId"=>$header["TemplateId"],
            "SphDelivery"=>$header["SphDelivery"],
            "SphSubTotal"=>$header["SphSubTotal"],
            "SphDiscItemTotal"=>$header["SphDiscItemTotal"],
            "SphDiscTotal"=>$header["SphDiscTotal"],
            "SphDeliveryTotal"=>$header["SphDeliveryTotal"],
            "SphGrandTotal"=>$header["SphGrandTotal"],
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->orderby('SphId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SphDetailRef"] = $query->SphId;
            $row["SphDetailVarian"] = (isset($row["SphDetailVarian"]) ? json_encode($row["SphDetailVarian"]) : "[]");  
            $builder = $this->db->table("penawaran_detail");
            $builder->insert($row); 
        } 
 
        //update status sample
        
        $modelssample = new ProjectsampleModel;
        if( $header["SphRefType"] == "Sample") $modelssample->update_data_sample_status($header["SphRef"]);  
        //update status Survey
        
        $modelssurvey = new ProjectsurveyModel;
        if( $header["SphRefType"] == "Survey") $modelssurvey->update_data_survey_status($header["SphRef"]);  
 
        //update status project
        $builder = $this->db->table("project"); 
        $builder->set('ProjectStatus', 3);  
        $builder->where('ProjectId', $header["ProjectId"]); 
        $builder->update();  

        //create Log action 
        $activityModel = new ActivityModel();
        $activityModel->insert(
            array( 
                "menu"=>"Penawaran",
                "type"=>"Add",
                "name"=>"Data penawaran baru ditambahkan dengan nomor ".$getnextcode,
                "desc"=> json_encode($data ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

    } 
    function update_data_sph($data,$id){ 
        
        $dataold = $builder = $this->getWhere(['SphId' => $id], 1)->getRow(); 


        $header = $data["header"];  
        $builder = $this->db->table("penawaran"); 
        $builder->set('SphDate', $header["SphDate"]);   
        $builder->set('SphAdmin', $header["SphAdmin"]);  
        $builder->set('SphRef', $header["SphRef"]);  
        $builder->set('SphRefType', $header["SphRefType"]);   
        $builder->set('ProjectId', $header["ProjectId"]); 
        $builder->set('StoreId', $header["StoreId"]);
        $builder->set('CustomerId', $header["CustomerId"]); 
        $builder->set('SphCustName', $header["SphCustName"]); 
        $builder->set('SphCustTelp', $header["SphCustTelp"]); 
        $builder->set('SphAddress', $header["SphAddress"]); 
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('SphSubTotal', $header["SphSubTotal"]); 
        $builder->set('SphDiscItemTotal', $header["SphDiscItemTotal"]); 
        $builder->set('SphDiscTotal', $header["SphDiscTotal"]); 
        $builder->set('SphDeliveryTotal', $header["SphDeliveryTotal"]);  
        $builder->set('SphGrandTotal', $header["SphGrandTotal"]);  
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SphId', $id); 
        $builder->update(); 

        $builder = $this->db->table("penawaran_detail");
        $builder->where('SphDetailRef',$id);
        $builder->delete(); 
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SphDetailRef"] = $id;
            $row["SphDetailVarian"] = (isset($row["SphDetailVarian"]) ? json_encode($row["SphDetailVarian"]) : "[]");  
            $builder = $this->db->table("penawaran_detail");
            $builder->insert($row); 
        }   
        //update status sample 
        $modelssample = new ProjectsampleModel;
        if( $header["SphRefType"] == "Sample") $modelssample->update_data_sample_status($header["SphRef"]);  
        //update status Survey
        if( $header["SphRefType"] == "Survey") $this->update_data_survey_status($header["SphRef"]);   

        
        //create Log action 
        $activityModel = new ActivityModel(); 
        $activityModel->insert(
            array( 
                "menu"=>"Penawaran",
                "type"=>"Edit",
                "name"=>"Data Penawaran diubah dengan nomor ".$header["SphCode"],
                "desc"=> json_encode(array("new"=>$data,"old" => $dataold) ?? []),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 

            )
        ); 
    }
    function delete_data_sph($id){
        $builder = $this->db->table("penawaran");
        $builder->set('SphStatus', 3); 
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()'));
        $builder->where('SphId',$id);  
        $builder->update();  

        return JSON_ENCODE(array("status"=>true));
    }  
    function update_status_sph($id,$status){   
        $dataold = $builder = $this->getWhere(['SphId' => $id], 1)->getRow();  

        $builder = $this->db->table("penawaran"); 
        $builder->set('SphStatus', $status);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SphId', $id); 
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
                "menu"=>"penawaran",
                "type"=>"Status",
                "name"=> "Status Data Penawaran diubah dari ".$statuslist[$dataold->SphStatus]." menjadi ".$statuslist[$status] . " dengan nomor ".$dataold->SphCode,
                "desc"=> json_encode([]),
                "created_user"=>user()->id, 
                "created_at"=>new RawSql('CURRENT_TIMESTAMP()'),  
            )
        ); 

        return JSON_ENCODE(array("status"=>true));
    }  
}