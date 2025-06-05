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
     
    function load_datatable_project_sample($filter = null){
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();

        $builder = $this->db->table("sample");
        $builder->join("project","project.ProjectId = sample.ProjectId ","left");   
        $builder->join("store","store.StoreId = project.StoreId","left");  
        $builder->join("users","users.id = sample.SampleAdmin ","left"); 
        $builder->where('SampleStatus <',2);

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
            2 => "SampleCode", // kolom name
            3 => "SampleDate", // kolom action tidak dapat diurutkan
            4 => "SampleStatus", // kolom image tidak dapat diurutkan
            5 => "SampleAdmin", // kolom action tidak dapat diurutkan
            6 => "SampleCustName", // kolom action tidak dapat diurutkan
            7 => null, // kolom action tidak dapat diurutkan
            8 => null, // kolom action tidak dapat diurutkan
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
            $arr_detail = $models->get_data_sample_detail($row->SampleId);
            foreach($arr_detail as $row_data){
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
            };
 
            // MENGAMBIL DATA REFERENSI
            $SampleRef = '-';
            if($row->SampleRefType == "Survey"){
                $builder = $this->db->table("survey");
                $builder->where('SurveyId',$row->SampleRef); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    $SampleRef = ' 
                    <script>
                        function sample_ref_click_'.$queryref->ProjectId.'_'.$queryref->SurveyId.'(){
                            $(".icon-project[data-menu=\'survey\'][data-id=\''.$queryref->ProjectId.'\']").trigger("click");
                            setTimeout(function() {
                                var targetElement = $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SurveyId.'\']");
                                var contentData = $(".content-data[data-id=\''.$queryref->ProjectId.'\']");
                                if (targetElement.length > 0 && contentData.length > 0) {
                                    var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                    contentData.scrollTop(targetOffset);
                                }
                               
                                $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SurveyId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SurveyId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SurveyId.'\'").removeClass("show"); 
                                    }, 2000); // delay 1 detik
                                })
    
                            }, 500); // delay 1 detik
                        }
                    </script> 
                    <div class="text-detail-3 pt-2"  data-bs-toggle="tooltip" data-bs-title="Referensi dari penawaran"><span class="text-detail-3 text-decoration-underline" onclick="sample_ref_click_'.$queryref->ProjectId.'_'.$queryref->SurveyId.'()">'.$queryref->SurveyCode.'</span></div>  '; 
                }
            } 
            if($row->SampleRefType == "Penawaran"){
                $builder = $this->db->table("penawaran");
                $builder->where('SphId',$row->SampleRef); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    $SampleRef = ' 
                    <script>
                        function sample_ref_click_'.$queryref->ProjectId.'_'.$queryref->SphId.'(){
                            $(".icon-project[data-menu=\'penawaran\'][data-id=\''.$queryref->ProjectId.'\']").trigger("click");
                            setTimeout(function() {
                                var targetElement = $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SphId.'\']");
                                var contentData = $(".content-data[data-id=\''.$queryref->ProjectId.'\']");
                                if (targetElement.length > 0 && contentData.length > 0) {
                                    var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                    contentData.scrollTop(targetOffset);
                                }
                               
                                $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").removeClass("show"); 
                                    }, 2000); // delay 1 detik
                                })
    
                            }, 500); // delay 1 detik
                        }
                    </script> 
                    <div class="text-detail-3  pt-2" data-bs-toggle="tooltip" data-bs-title="Referensi dari penawaran"><i class="fa-solid fa-flag pe-1"></i><span class="text-detail-3" onclick="sample_ref_click_'.$queryref->ProjectId.'_'.$queryref->SphId.'()">'.$queryref->SphCode.'</span></div>'; 
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
                    function sample_return_click_'.$queryref->ProjectId.'_'.$queryref->SphId.'(){
                        $(".icon-project[data-menu=\'penawaran\'][data-id=\''.$queryref->ProjectId.'\']").trigger("click");
                        setTimeout(function() {
                            var targetElement = $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SphId.'\']");
                            var contentData = $(".content-data[data-id=\''.$queryref->ProjectId.'\']");
                            if (targetElement.length > 0 && contentData.length > 0) {
                                var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                contentData.scrollTop(targetOffset);
                            }
                            
                            $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").addClass("show");
                            $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").hover(function() {
                                setTimeout(function() {
                                    $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").removeClass("show"); 
                                }, 2000); // delay 1 detik
                            })

                        }, 500); // delay 1 detik
                    }
                </script> 
                <div class="text-detail-3  pt-1" data-bs-toggle="tooltip" data-bs-title="Diterukan ke penawaran"><i class="fa-solid fa-flag pe-1"></i><span class="text-detail-3 pointer" onclick="sample_ref_click_'.$queryref->ProjectId.'_'.$queryref->SphId.'()">'.$queryref->SphCode.'</span></div>'; 
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
                                function survey_return_click_'.$queryref->ProjectId.'_'.$queryref->InvId.'(){
                                    $(".icon-project[data-menu=\'invoice\'][data-id=\''.$queryref->ProjectId.'\'").trigger("click");
                                    setTimeout(function() {
                                        var targetElement = $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->InvId.'\']");
                                        var contentData = $(".content-data[data-id=\''.$queryref->ProjectId.'\']");
                                        if (targetElement.length > 0 && contentData.length > 0) {
                                            var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                            contentData.scrollTop(targetOffset);
                                        }
                                        
                                        $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").addClass("show");
                                        $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").hover(function() {
                                            setTimeout(function() {
                                                $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").removeClass("show"); 
                                            }, 2000); // delay 1 detik
                                        })

                                    }, 1000); // delay 1 detik
                                }
                            </script>
                            
                            <div class="text-head-3 pt-1">Invoice </span><span class="text-head-3 pointer text-decoration-underline" onclick="survey_return_click_'.$queryref->ProjectId.'_'.$queryref->InvId.'()">('.$queryref->InvCode.')
                            </div> 
                        ';
                }else{
                    $SampleForward = ' 
                    <div class="text-detail-3 pt-1">
                        <i class="fa-regular fa-share-from-square pe-1"></i>
                        <a class="text-detail-2" data-bs-toggle="tooltip" data-bs-title="teruskan ke penawaran" onclick="add_project_sph('.$row->ProjectId.',this,'.$row->SampleId.',\'Sample\')">Penawaran</a> |  
                        <a class="text-detail-2" data-bs-toggle="tooltip" data-bs-title="teruskan ke invoice"  onclick="add_project_invoice('.$row->ProjectId.',this,'.$row->SampleId.',\'Sample\')">Invoice</a>
                    </div>'; 
                }
            }
            
            $payment = '';
            $payment_detail = "";
            if($row->SampleGrandTotal == 0){
                $payment = ' 
                        <span class="text-head-3 pointer payment">
                            <span class="badge text-bg-success me-1">Tidak ada</span>
                        </span> ';
                $payment_detail = '<div class="text-head-3 p-2">
                    <i class="fa-solid fa-check text-success me-2" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran yang harus diselesaikan untuk transaksi ini 
                </div>';
            }else{
                $payment = ' 
                        <span class="text-head-3 pointer payment">
                            <span class="badge text-bg-danger me-1">Belum Lengkap</span>
                        </span> ';
                $payment_detail = '<div class="text-head-3 p-2">
                    <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                    Belum ada data pembayaran
                </div>';

            }
            $delivery = '';
            $delivery_detail = "";
            if($row->SampleDelivery == 0){
                $delivery = ' 
                        <span class="text-head-3 pointer delivery">
                            <span class="badge text-bg-success me-1">Tidak ada</span>
                        </span>';
                $delivery_detail = '<div class="text-head-3 p-2">
                        <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                        Mode pengriman tidak diaktifkan untuk transaksi ini, 
                        <a class="text-head-3 text-primary" style="cursor:pointer" onclick="sample_project_update_delivery(21,1,this,1)">aktifkan mode Pengiriman</a>
                    </div>';
            }else{
                $delivery = ' 
                        <span class="text-head-3 pointer delivery">
                            <span class="badge text-bg-danger me-1">Belum Lengkap</span>
                        </span> ';
                $delivery_detail = '<div class="text-head-3 p-2">
                    <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                    Belum ada data pengiriman
                </div>';

            }


            $status = "";
            if($row->SampleStatus==0){
                $status .= ' 
                        <span class="text-head-3">
                            <span class="badge text-bg-primary me-1">New</span> 
                        </span>  ';
            }
            if($row->SampleStatus==1){
                $status .= '  
                        <span class="text-head-3">
                            <span class="badge text-bg-info me-1">Proses</span>
                            <span class="text-primary pointer d-none" onclick="update_status_survey(1,'.$row->SampleId.')"><i class="fa-solid fa-pen-to-square"></i></span>
                        </span> ';
            }
            if($row->SampleStatus==2){
                $status .= ' 
                        <span class="text-head-3">
                            <span class="badge text-bg-success me-1">Completed</span>
                        </span>  ';
            }
            if($row->SampleStatus==3){
                $status .= '   <span class="badge text-bg-danger me-1">Cancel</span>  '; 
            }

            $data_row = array( 
                "sample" => $row,
                "code" => $row->SampleCode.$SampleRef.$SampleForward ,
                "date" => date_format(date_create($row->SampleDate),"d M Y"),
                "status" => $status,
                "admin" => ucwords($row->username),
                "delivery" => $delivery,
                "deliverydetail" => $delivery_detail,
                "payment" => $payment,
                "paymentdetail" => $payment_detail,
                "customer" => $row->SampleCustName, 
                "customertelp" => ($row->SampleCustTelp ? $row->SampleCustTelp : ""), 
                "customeraddress" => $row->SampleAddress, 
                "detail" => $detail,
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
    function load_table_project_sample($filter = null){
        $builder = $this->db->table("sample");
        $builder->join("project","project.ProjectId = sample.ProjectId ","left");   
        $builder->join("store","store.StoreId = project.StoreId","left");  
        $builder->join("users","users.id = sample.SampleAdmin ","left"); 
        $builder->where('SampleStatus !=',2);
        if($filter["datestart"]){
            $builder->where("SampleDate >=",$filter["datestart"]);
            $builder->where("SampleDate <=",$filter["dateend"]); 
        }
        if(isset($filter["filter"])){ 
            $builder->whereIn("SampleStatus",$filter["filter"]); 
        } 

        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("ProjectName",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("SampleAddress",$filter["search"]);
            $builder->orLike("SampleCode",$filter["search"]);
            $builder->orLike("username",$filter["search"]);
            $builder->groupEnd();  
        }
        $builder->orderby('SampleId', 'DESC'); 
        $perPage = 10;
        $page = $filter["paging"]; // atau dapatkan dari parameter GET 
        $offset = ($page - 1) * $perPage; 
        $builder->limit($perPage, $offset);
        $query = $builder->get();  
        $count = $query->getNumRows();


        $html = "";
        foreach($query->getResult() as $row){   
            $builder = $this->db->table("sample_detail");
            $builder->select('*'); 
            $builder->where('SampleDetailRef',$row->SampleId);
            $builder->orderby('SampleDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A";

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

                $arr_varian = json_decode($item->SampleDetailVarian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }

                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-4 my-1 varian">   
                        <div class="d-flex gap-2"> 
                            ' . ($item->SampleDetailType == "product" ? ($gambar ? "<img src='".base_url().$gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url().$default."' alt='Gambar Default'>") : "").'  
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


            $builder = $this->db->table("penawaran");
            $builder->select('*');
            $builder->where('SampleId',$row->SampleId); 
            $builder->orderby('SphId', 'DESC'); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                $alert = ' 
                    <script>
                        function sample_return_click_'.$row->ProjectId.'_'.$queryref->SphId.'(){
                            $(".icon-project[data-menu=\'penawaran\'][data-id=\''.$row->ProjectId.'\'").trigger("click");
                            setTimeout(function() {
                                $("html, body").scrollTop($(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").offset().top - 200); 
                                $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").removeClass("show"); 
                                    }, 1000); // delay 1 detik
                                })

                            }, 1000); // delay 1 detik
                        }
                    </script>
                    <div class="alert alert-success p-2 m-1" role="alert"> 
                    <span class="text-head-2">
                        <i class="fa-solid fa-check text-success pe-0 me-2 text-success" style="font-size:0.75rem"></i>
                        Sample berhasil diteruskan ke penawaran, dengan No. Penawaran :  <a class="text-head-2" style="cursor:pointer" onclick="sample_return_click_'.$row->ProjectId.'_'.$queryref->SphId.'()">'.$queryref->SphCode.'</a>  
                    </span> 
                </div>';
            }else{
                $builder = $this->db->table("invoice");
                $builder->select('*');
                $builder->where('SampleId',$row->SampleId); 
                $builder->orderby('InvId', 'DESC'); 
                $queryref = $builder->get()->getRow();   
                if($queryref){
                    $alert = ' 
                    <script>
                        function sample_return_click_'.$row->ProjectId.'_'.$queryref->InvId.'(){
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
                    <span class="text-head-2">
                        <i class="fa-solid fa-check text-success pe-0 me-2 text-success" style="font-size:0.75rem"></i>
                        Sample berhasil diteruskan ke invoice, dengan No. Invoice :  <a class="text-head-2" style="cursor:pointer" onclick="sample_return_click_'.$row->ProjectId.'_'.$queryref->InvId.'()">'.$queryref->InvCode.'</a>  
                    </span> 
                </div>';
                }else{
                    $alert = '<div class="alert alert-primary p-2 m-1" role="alert"> 
                        <span class="text-head-2">
                            <i class="fa-solid fa-reply me-2 fa-rotate-180" style="font-size:0.75rem"></i>
                            Teruskan sample ini ke 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_sph('.$row->ProjectId.',this,'.$row->SampleId.')">penawaran</a> 
                            atau langsung ke pembuatan 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_invoice('.$row->ProjectId.',this,'.$row->SampleId.',\'sample\')">invoice</a>
                        </span> 
                    </div>'; 
                }
            }


            $html_payment = "";
            $payment_total = 0;
            if($row->SampleGrandTotal == 0){
                $html_payment = '<div class="alert alert-success p-2 m-1" role="alert"> 
                <span class="text-head-2">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran yang harus diselesaikan untuk transaksi ini 
                </span> 
                </div>';
            }else{
                $builder = $this->db->table("payment");
                $builder->select('*'); 
                $builder->where('SampleId',$row->SampleId);
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
                        $status = '<span class="text-head-3 text-warning">Pending</span>';
                    }else{
                        $status = ' <span class="text-head-3 text-success">
                        <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                            <i class="fa-solid fa-certificate fa-stack-2x"></i>
                            <i class="fa-solid fa-check text-success fa-stack-1x fa-inverse"></i>
                        </span>Verified</span>';
                        $status = '<span class="text-head-3 text-success">Terverifikasi</span>';
                    }
                    $html_payment .= '<div class="mb-1 p-1">  
                                    <div class="row mx-2"> 
                                        <div class="col-12 col-md-1 order-2 order-sm-1 p-0"> 
                                            <div class="d-flex flex-row flex-md-column justify-content-between"> 
                                                <span class="text-detail-2"><i class="fa-solid fa-check text-success pe-1"></i>Status</span>
                                                '.$status.'
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-1 order-3 order-sm-2 p-0"> 
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                                                <span class="text-head-3">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</span>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-1 order-4 order-sm-3 p-0"> 
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-layer-group pe-1"></i>Type</span>
                                                <span class="text-head-3">'.$row_payment->PaymentType.'</span>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-1 order-5 order-sm-4 p-0">
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-credit-card pe-1"></i>Method</span>
                                                <span class="text-head-3">'.$row_payment->PaymentMethod.'</span>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-md-2 order-6 order-sm-5 p-0">
                                            <div class="d-flex flex-row flex-md-column justify-content-between">
                                                <span class="text-detail-2"><i class="fa-solid fa-wallet pe-1"></i>Total</span>
                                                <span class="text-head-3">Rp. '.number_format($row_payment->PaymentTotal).'</span>
                                            </div>   
                                        </div>
                                        <div class="col-12 col-md-6 text-end order-1 order-sm-5 p-0"> 
                                            
                                            <div class="d-none d-md-inline-block"> 
                                                <button class="btn btn-sm btn-primary btn-action rounded border '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$row->ProjectId.','.$row_payment->SampleId.','.$row_payment->PaymentId.',this,\'sample\')">
                                                    <i class="fa-solid fa-eye mx-1"></i><span>Lihat Bukti</span>
                                                </button>
                                                <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$row->ProjectId.','.$row_payment->PaymentId.',this,\'sample\')">
                                                    <i class="fa-solid fa-print mx-1"></i><span>Cetak</span>
                                                </button>
                                                <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$row->ProjectId.','.$row_payment->PaymentId.',this,\'sample\')">
                                                    <i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
                                                </button>
                                                <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_payment('.$row->ProjectId.','.$row_payment->PaymentId.',this,\'sample\')">
                                                    <i class="fa-solid fa-close mx-1"></i><span>Hapus</span>
                                                </button> 
                                            </div>
                                            <div class="d-flex  d-md-none justify-content-between"> 
                                                <span class="text-head-2 pt-auto"><i class="fa-solid fa-money-check-dollar pe-2"></i>'.($row_payment->PaymentDoc == "1" ? "Payment" : "Proforma" ).'</span>
                                                <div class="dropdown">
                                                    <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti-more-alt icon-rotate-45"></i>
                                                    </a>
                                                    <ul class="dropdown-menu shadow">
                                                        <li><a class="dropdown-item m-0 px-2 '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$row->ProjectId.','.$row_payment->SampleId.','.$row_payment->PaymentId.',this,\'sample\')"><i class="fa-solid fa-eye pe-2"></i>Lihat Bukti</a></li>
                                                        <li><a class="dropdown-item m-0 px-2" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$row->ProjectId.','.$row_payment->PaymentId.',this,\'sample\')"><i class="fa-solid fa-dollar pe-2"></i>Cetak</a></li>  
                                                        <li><a class="dropdown-item m-0 px-2" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$row->ProjectId.','.$row_payment->PaymentId.',this,\'sample\')"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                                        <li><a class="dropdown-item m-0 px-2" onclick="delete_project_payment('.$row->ProjectId.','.$row_payment->PaymentId.',this,\'sample\')"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                } 
                if($html_payment == ""){
                    $html_payment = '<div class="alert alert-warning p-2 m-1" role="alert"> 
                            <span class="text-head-2">
                                <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                                Belum ada data pembayaran yang dibuat, Silahkan tambahkan data  
                                <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$row->ProjectId.','.$row->SampleId.',this,\'sample\')">Pembayaran</a>
                            </span> 
                        </div>';
                }elseif($payment_total < $row->SampleGrandTotal){
                    $html_payment .= '
                    <div class="alert alert-warning p-2 m-1" role="alert"> 
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Masih ada sisa pembayaran yang belum diselesaikan, Silahkan buat data  
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_payment('.$row->ProjectId.','.$row->SampleId.',this,\'sample\')">Pembayaran</a>
                        </span> 
                    </div>';
                }
            }

            $html_delivery = "";
            $builder = $this->db->table("delivery");
            $builder->select('*');   
            $builder->where("SampleId",$row->SampleId);
            $builder->orderby('DeliveryId', 'ASC'); 
            $delivery = $builder->countAllResults();
            if($delivery == 0){
                $html_delivery = ' 
                    <div class="alert alert-warning p-2 m-1" role="alert">
                        <span class="text-head-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Belum ada data pengiriman yang dibuat dari dokumen ini, 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_delivery('.$row->ProjectId.','.$row->SampleId.',this,\'sample\')">Buat Data Pengiriman</a> 
                        </span>
                    </div>';
            }else{
                $html_delivery = ' 
                <div class="alert alert-success p-2 m-1" role="alert">
                    <span class="text-head-2">
                        <i class="fa-solid fa-check text-success me-2" style="font-size:0.75rem"></i>
                        ada '.$delivery .' data pengiriman yang dibuat dari Sample ini, 
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick=\'$(".icon-project[data-menu=\"pengiriman\"][data-id=\"'.$row->ProjectId.'\"]").trigger("click")\'>Lihat Selengkapnya</a> atau
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_delivery('.$row->ProjectId.','.$row->SampleId.',this,\'sample\')">Tambah Data Pengiriman</a> 
                    </span>
                </div>';
            }
            

            $category = "";
            foreach (explode("|",$row->ProjectCategory) as $index=>$x) {
                $category .= '<span class="badge badge-'.fmod($index, 5).' me-1">'.$x.'</span>';
            }  
            $html .= '
            <div class="card project mb-4 p-2">
                <div class="row pb-2">
                    <div class="col-md-3 col-10 order-0 project-store d-flex-column mb-md-0 mb-2"> 
                        <div class="d-flex align-items-center ">
                            <div class="flex-shrink-0 ">
                                <img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">
                            </div>
                            <div class="flex-grow-1 ms-1">
                                <div class="d-flex flex-column"> 
                                    <span class="text-head-2 d-flex gap-1 align-items-center"><div>'.$row->StoreCode.' - '.$row->StoreName.'</div></span>
                                    <span class="text-detail-2 text-wrap overflow-x-auto">'.$category.'</span>  
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
                                <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Sample</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SampleCode.'</span>
                            </div>
                        </div> 
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
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-flag pe-1"></i>Diteruskan</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">-</span>
                            </div>
                        </div>  
                    </div> 
                    
                    <div class="col-12  col-md-5 order-2 order-sm-1"> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-user pe-1"></i>PIC Lapangan</span>
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
                    <div class="col-12  col-md-3 order-0 order-sm-2">
                        <div class="float-end d-md-flex d-none gap-1">  
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_sample('.$row->ProjectId.','.$row->SampleId.',this)">
                                <i class="fa-solid fa-print mx-1"></i><span >Print</span>
                            </button>
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_sample('.$row->ProjectId.','.$row->SampleId.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span >Ubah</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_sample('.$row->ProjectId.','.$row->SampleId.',this)">
                                <i class="fa-solid fa-close mx-1"></i><span >Hapus</span>
                            </button> 
                        </div> 
                        <div class="d-md-none d-flex btn-action justify-content-between"> 
                            <div class="text-head-1">Sample</div>
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow"> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div> 
                </div>  
                <div class="detail-item p-2 border-top">
                    '.$html_items.' 
                </div>
                <div class="border-top pt-2 mb-2 gap-2 align-items-center pt-2 justify-content-between">  
                     '.$alert.' 
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

        //     $staffArray = explode('|', $row->SampleStaff);
        //     $query =  $this->db->table('users');
        //     $query->whereIn('id', $staffArray);
        //     $result = $query->get()->getResult();
        //     $staffname = implode(', ', array_column($result, 'username'));

        //     $alert = "";
        //     $builder = $this->db->table("penawaran");
        //     $builder->select('*');
        //     $builder->where('SampleId',$row->SampleId); 
        //     $builder->orderby('SphId', 'DESC'); 
        //     $queryref = $builder->get()->getRow();  
        //     if($queryref){
        //         $alert = ' 
        //             <script>
        //                 function Sample_return_click_'.$row->ProjectId.'_'.$queryref->SphId.'(){
        //                     $(".icon-project[data-menu=\'penawaran\'][data-id=\''.$row->ProjectId.'\'").trigger("click");
        //                     setTimeout(function() {
        //                         $("html, body").scrollTop($(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").offset().top - 200); 
        //                         $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").addClass("show");
        //                         $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").hover(function() {
        //                             setTimeout(function() {
        //                                  $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->SphId.'\'").removeClass("show"); 
        //                             }, 1000); // delay 1 detik
        //                         })

        //                     }, 1000); // delay 1 detik
        //                 }
        //             </script>
        //             <div class="alert alert-success p-2 m-1" role="alert"> 
        //             <span class="text-head-2">
        //                 <i class="fa-solid fa-check text-success pe-0 me-2 text-success" style="font-size:0.75rem"></i>
        //                 Sample berhasil diteruskan ke penawaran, dengan No. Penawaran :  <a class="text-head-2" style="cursor:pointer" onclick="Sample_return_click_'.$row->ProjectId.'_'.$queryref->SphId.'()">'.$queryref->SphCode.'</a>  
        //             </span> 
        //         </div>';
        //     }else{
        //         $builder = $this->db->table("invoice");
        //         $builder->select('*');
        //         $builder->where('SampleId',$row->SampleId); 
        //         $builder->orderby('InvId', 'DESC'); 
        //         $queryref = $builder->get()->getRow();   
        //         if($queryref){
        //             $alert = ' 
        //             <script>
        //                 function Sample_return_click_'.$row->ProjectId.'_'.$queryref->InvId.'(){
        //                     $(".icon-project[data-menu=\'invoice\'][data-id=\''.$row->ProjectId.'\'").trigger("click");
        //                     setTimeout(function() {
        //                         $("html, body").scrollTop($(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").offset().top - 200); 
        //                         $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").addClass("show");
        //                         $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").hover(function() {
        //                             setTimeout(function() {
        //                                  $(".list-project[data-project=\''.$row->ProjectId.'\'][data-id=\''.$queryref->InvId.'\'").removeClass("show"); 
        //                             }, 1000); // delay 1 detik
        //                         })

        //                     }, 1000); // delay 1 detik
        //                 }
        //             </script>
        //             <div class="alert alert-success p-2 m-1" role="alert"> 
        //             <span class="text-head-2">
        //                 <i class="fa-solid fa-check text-success pe-0 me-2 text-success" style="font-size:0.75rem"></i>
        //                 Sample berhasil diteruskan ke invoice, dengan No. Invoice :  <a class="text-head-2" style="cursor:pointer" onclick="Sample_return_click_'.$row->ProjectId.'_'.$queryref->InvId.'()">'.$queryref->InvCode.'</a>  
        //             </span> 
        //         </div>';
        //         }else{
        //             $alert = '<div class="alert alert-primary p-2 m-1" role="alert"> 
        //                 <span class="text-head-2">
        //                     <i class="fa-solid fa-reply me-2 fa-rotate-180" style="font-size:0.75rem"></i>
        //                     Teruskan Sample ini ke 
        //                     <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_sph('.$row->ProjectId.',this,'.$row->SampleId.')">penawaran</a> 
        //                     atau langsung ke pembuatan 
        //                     <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_invoice('.$row->ProjectId.',this,'.$row->SampleId.',\'Sample\')">invoice</a>
        //                 </span> 
        //             </div>'; 
        //         }
        //     }  


        //     //load data hasil survey
        //     $builders = $this->db->table("survey_finish");
        //     $builders->select('*');
        //     $builders->where('SampleId',$row->SampleId); 
        //     $row_finish = $builders->get()->getRow();   
        //     $html_sample = "";
        //     if($row_finish){ 
        //         $html_sample .= '<div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">  
        //                             <div class="col bg-light mx-4 py-2"> 
        //                                 '.$row_finish->SampleFinishDetail.' 
        //                             <div class="list-group  "> ';
                                
        //         $folder_utama = 'assets/images/project'; 
        //         $files = scandir($folder_utama."/".$row->SampleId);
        //         foreach ($files as $file) {
        //             if ($file != '.' && $file != '..') {

        //                 $filesize = filesize($folder_utama."/".$row->SampleId . '/' . $file);
        //                 // $html_sample .= $folder_utama."/".$row->SampleId . '/' . $file;
        //                 $html_sample .= ' <li class="list-group-item list-group-item-action align-items-center d-flex view-document file pb-2" > 
        //                                     <i class="fa-solid fa-file fa-2x me-2"></i>
        //                                     <div class="d-flex flex-column flex-fill ms-2">
        //                                         <span class="fs-6">'.$file.'</span>
        //                                         <span class="text-muted">'.$this->format_filesize($filesize).'</span>
        //                                     </div>  
                                                
        //                                     <button class="btn btn-sm float-end" onclick="download_file(this)" data-file="'.$folder_utama."/".$row->SampleId . '/' . $file.'">
        //                                         <i class="fa-solid fa-download"></i>
        //                                     </button>
                                            
        //                                 </li>';
        //             }
        //         }  
        //         $html_sample .= ' </div></div></div> ';   
        //     }
        //     if($html_sample == ""){
        //         $html_sample = '  
        //         <div class="alert alert-warning p-2 m-1" role="alert">
        //             <span class="text-head-2">
        //                 <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
        //                 Belum ada hasil survey yang dibuat dari dokumen ini, 
        //                 <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_sample_finish('.$row->ProjectId.','.$row->SampleId.',this)">Buat hasil survey</a> 
        //             </span>
        //         </div>'; 
        //     }
           

        //     $category = "";
        //     foreach (explode("|",$row->ProjectCategory) as $index=>$x) {
        //         $category .= '<span class="badge badge-'.fmod($index, 5).' me-1">'.$x.'</span>';
        //     }  
        //     $html .= '
        //     <div class="card project mb-4 p-2">
        //         <div class="row">
        //             <div class="col-md-3 col-10 order-0 project-store d-flex-column mb-md-0 mb-2"> 
        //                 <div class="d-flex align-items-center ">
        //                     <div class="flex-shrink-0 ">
        //                         <img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">
        //                     </div>
        //                     <div class="flex-grow-1 ms-1">
        //                         <div class="d-flex flex-column"> 
        //                             <span class="text-head-2 d-flex gap-1 align-items-center"><div>'.$row->StoreCode.' - '.$row->StoreName.'</div></span>
        //                             <span class="text-detail-2 text-wrap overflow-x-auto">'.$category.'</span>  
        //                         </div>   
        //                     </div>
        //                 </div>
        //             </div>
                    
        //             <div class="col-md-3 col-12 order-2 order-sm-1">
        //             <div class="d-flex flex-column">
        //                 <span class="text-head-2">'.$row->ProjectName.'</span>
        //                 <span class="text-detail-2 text-truncate overflow-x-auto">Catatan : '.$row->ProjectComment.'</span>  
        //             </div> 
        //         </div>   
        //         </div>
        //         <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">
        //             <div class="col-12  col-md-4 order-1 order-sm-0">
        //                 <div class="row">
        //                     <div class="col-4"> 
        //                         <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Sample</span>
        //                     </div>
        //                     <div class="col-8">
        //                         <span class="text-head-3">'.$row->SampleCode.'</span>
        //                     </div>
        //                 </div> 
        //                 <div class="row">
        //                     <div class="col-4"> 
        //                         <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
        //                     </div>
        //                     <div class="col-8">
        //                         <span class="text-head-3">'.date_format(date_create($row->SampleDate),"d M Y").'</span>
        //                     </div>
        //                 </div> 
        //                 <div class="row">
        //                     <div class="col-4"> 
        //                         <span class="text-detail-2"><i class="fa-solid fa-user pe-1"></i>Admin</span>
        //                     </div>
        //                     <div class="col-8">
        //                         <span class="text-head-3">'.$row->username .'</span>
        //                     </div>
        //                 </div> 
        //                 <div class="row">
        //                     <div class="col-4"> 
        //                         <span class="text-detail-2"><i class="fa-solid fa-users pe-1"></i>Staff</span>
        //                     </div>
        //                     <div class="col-8">
        //                         <span class="text-head-3">'.$staffname .'</span>
        //                     </div>
        //                 </div>  
        //                 <div class="row">
        //                     <div class="col-4"> 
        //                         <span class="text-detail-2"><i class="fa-solid fa-dollar-sign pe-1"></i>Biaya Operasional</span>
        //                     </div>
        //                     <div class="col-8">
        //                         <span class="text-head-3">Rp. '.number_format($row->SampleTotal,0) .'</span>
        //                     </div>
        //                 </div>  
        //             </div>
        //             <div class="col-12  col-md-5 order-2 order-sm-1"> 
        //                 <div class="row">
        //                     <div class="col-4"> 
        //                         <span class="text-detail-2"><i class="fa-solid fa-user pe-1"></i>PIC Lapangan</span>
        //                     </div>
        //                     <div class="col-8">
        //                         <span class="text-head-3">'.$row->SampleCustName.'</span>
        //                     </div>
        //                 </div> 
        //                 <div class="row">
        //                     <div class="col-4"> 
        //                         <span class="text-detail-2"><i class="fa-solid fa-phone pe-1"></i>No. Hp</span>
        //                     </div>
        //                     <div class="col-8">
        //                         <span class="text-head-3">'.$row->SampleCustTelp.'</span>
        //                     </div>
        //                 </div> 
        //                 <div class="row">
        //                     <div class="col-4"> 
        //                         <span class="text-detail-2"><i class="fa-solid fa-location-dot pe-1"></i>Lokasi</span>
        //                     </div>
        //                     <div class="col-8">
        //                         <span class="text-head-3">'.$row->SampleAddress.'</span>
        //                     </div>
        //                 </div>  
        //             </div> 
        //             <div class="col-12  col-md-3 order-0 order-sm-2">
        //                 <div class="float-end d-md-flex d-none gap-1">  
        //                     <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_sample('.$row->ProjectId.','.$row->SampleId.',this)">
        //                         <i class="fa-solid fa-print mx-1"></i><span >Print</span>
        //                     </button>
        //                     <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_sample('.$row->ProjectId.','.$row->SampleId.',this)">
        //                         <i class="fa-solid fa-pencil mx-1"></i><span >Ubah</span>
        //                     </button>
        //                     <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_sample('.$row->ProjectId.','.$row->SampleId.',this)">
        //                         <i class="fa-solid fa-close mx-1"></i><span >Hapus</span>
        //                     </button> 
        //                 </div> 
        //                 <div class="d-md-none d-flex btn-action justify-content-between"> 
        //                     <div class="text-head-1">Sample</div>
        //                     <div class="dropdown">
        //                         <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        //                             <i class="ti-more-alt icon-rotate-45"></i>
        //                         </a>
        //                         <ul class="dropdown-menu shadow"> 
        //                             <li><a class="dropdown-item m-0 px-2" onclick="edit_project_sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
        //                             <li><a class="dropdown-item m-0 px-2" onclick="delete_project_sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
        //                         </ul>
        //                     </div>
        //                 </div> 
        //             </div> 
        //         </div> 
        //         <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center pt-2 justify-content-between">   
        //             <span class="text-head-2"><i class="fa-solid fa-file-signature pe-2"></i>Hasil Sample</span>
        //             '. ($row_finish ? 
        //             '<button class="btn btn-sm btn-primary rounded border" onclick="edit_project_sample_finish('.$row->ProjectId.','.$row_finish->SampleFinishId.',this)"><i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
        //             </button>' : "").'
        //         </div>
        //         '.$html_sample.'  
        //     </div> 
        //     ';
        // }
        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Tidak ada data yang ditemukan</span> 
                </div> 
            ';
        }

        //get data total
        $builder = $this->db->table("sample");
        $builder->join("project","project.ProjectId = sample.ProjectId ","left");   
        $builder->join("store","store.StoreId = project.StoreId","left");  
        $builder->where('SampleStatus !=',2);
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
}