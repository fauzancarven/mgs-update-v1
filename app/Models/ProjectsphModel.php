<?php

namespace App\Models; 

use CodeIgniter\Model;  
use CodeIgniter\Database\RawSql;
use App\Models\ProjectModel; 
use App\Models\ProdukModel; 

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
        $builder->join("store","store.StoreId = project.StoreId","left");  
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
            2 => "SphCode", // kolom name
            3 => "SphDate", // kolom action tidak dapat diurutkan
            4 => "SphStatus", // kolom image tidak dapat diurutkan
            5 => "SphAdmin", // kolom action tidak dapat diurutkan
            6 => "SphCustName", // kolom action tidak dapat diurutkan
            7 => "SphGrandTotal", // kolom action tidak dapat diurutkan
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
            $arr_detail = $models->get_data_sph_detail($row->SphId);
            foreach($arr_detail as $row_data){
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
            };
            

            // MENGAMBIL DATA REFERENSI
            $SphRef = '<div class="text-detail-3  pt-2" data-bs-toggle="tooltip" data-bs-title="Referensi dari penawaran"><i class="fa-solid fa-flag pe-1"></i> - </div>';
            if($row->SphRefType == "Survey"){
                $builder = $this->db->table("survey");
                $builder->where('SurveyId',$row->SphRef); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    $SphRef = ' 
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
            if($row->SphRefType == "Sample"){
                $builder = $this->db->table("sample");
                $builder->where('SampleId',$row->SphRef); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    $SphRef = ' 
                    <script>
                        function sample_ref_click_'.$queryref->ProjectId.'_'.$queryref->SampleId.'(){
                            $(".icon-project[data-menu=\'penawaran\'][data-id=\''.$queryref->ProjectId.'\']").trigger("click");
                            setTimeout(function() {
                                var targetElement = $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SampleId.'\']");
                                var contentData = $(".content-data[data-id=\''.$queryref->ProjectId.'\']");
                                if (targetElement.length > 0 && contentData.length > 0) {
                                    var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                    contentData.scrollTop(targetOffset);
                                }
                               
                                $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SampleId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SampleId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SampleId.'\'").removeClass("show"); 
                                    }, 2000); // delay 1 detik
                                })
    
                            }, 500); // delay 1 detik
                        }
                    </script> 
                    <div class="text-detail-3  pt-2" data-bs-toggle="tooltip" data-bs-title="Referensi dari penawaran">
                        <i class="fa-solid fa-flag pe-1"></i>
                        <span class="text-detail-3" onclick="sample_ref_click_'.$queryref->ProjectId.'_'.$queryref->SampleId.'()">'.$queryref->SampleCode.'</span>
                    </div>'; 
                }
            }

            // Mengambil data diteruskan
            $builder = $this->db->table("invoice");
            $builder->select('*');
            $builder->where('InvRef',$row->SphId); 
            $builder->where('InvRefType',"Penawaran");  
            $builder->where('InvStatus <',2);  
            $builder->orderby('InvId', 'DESC'); 
            $queryref = $builder->get()->getRow();   
            if($queryref){
                $sphforward = ' 
                    <script>
                        function penawaran_return_click_'.$queryref->ProjectId.'_'.$queryref->InvId.'(){
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
                    <div class="text-detail-3  pt-1" data-bs-toggle="tooltip" data-bs-title="Diterukan ke Sampel">
                    <i class="fa-solid fa-share-from-square pe-1"></i>
                    <span class="text-detail-3 pointer" onclick="sample_ref_click_'.$queryref->ProjectId.'_'.$queryref->InvId.'()">'.$queryref->InvCode.'</span>
                </div>';  
            }else{
                    // Mengambil data diteruskan
                $builder = $this->db->table("sample");
                $builder->select('*');
                $builder->where('SampleRef',$row->SphId); 
                $builder->where('SampleRefType',"Penawaran");  
                $builder->where('SampleStatus <',2);  
                $builder->orderby('SampleId', 'DESC'); 
                $queryref = $builder->get()->getRow();   
                if($queryref){
                    $sphforward = ' 
                        <script>
                            function penawaran_return_click_'.$queryref->ProjectId.'_'.$queryref->SampleId.'(){
                                $(".icon-project[data-menu=\'sample\'][data-id=\''.$queryref->ProjectId.'\'").trigger("click");
                                setTimeout(function() {
                                    var targetElement = $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SampleId.'\']");
                                    var contentData = $(".content-data[data-id=\''.$queryref->ProjectId.'\']");
                                    if (targetElement.length > 0 && contentData.length > 0) {
                                        var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                        contentData.scrollTop(targetOffset);
                                    }
                                    
                                    $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SampleId.'\'").addClass("show");
                                    $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SampleId.'\'").hover(function() {
                                        setTimeout(function() {
                                                $(".list-project[data-project=\''.$queryref->ProjectId.'\'][data-id=\''.$queryref->SampleId.'\'").removeClass("show"); 
                                        }, 2000); // delay 1 detik
                                    })

                                }, 1000); // delay 1 detik
                            }
                        </script>
                        
                        <div class="text-detail-3  pt-1" data-bs-toggle="tooltip" data-bs-title="Diterukan ke Sampel">
                            <i class="fa-solid fa-share-from-square pe-1"></i>
                            <span class="text-detail-3 pointer" onclick="sample_ref_click_'.$queryref->ProjectId.'_'.$queryref->SampleId.'()">'.$queryref->SampleCode.'</span>
                        </div>'; 
                }else{
                    $sphforward = '
                    <div class="text-detail-3 pt-1">
                        <i class="fa-regular fa-share-from-square pe-1"></i>
                        <a class="text-detail-2" onclick="add_project_invoice('.$row->ProjectId.',this,'.$row->SphId.',\'penawaran\')">Invoice</a>
                    </div>'; 
                }
            
            }

            $status = "";
            if($row->SphStatus==0){
                $status .= ' 
                        <span class="text-head-3">
                            <span class="badge text-bg-primary me-1">New</span> 
                        </span>  ';
            }
            if($row->SphStatus==1){
                $status .= '  
                        <span class="text-head-3">
                            <span class="badge text-bg-success me-1">Completed</span>
                            <span class="text-primary pointer d-none" onclick="update_status_survey(1,'.$row->SphId.')"><i class="fa-solid fa-pen-to-square"></i></span>
                        </span> ';
            }
            if($row->SphStatus==2){
                $status .= '   <span class="badge text-bg-danger me-1">Cancel</span>  '; 
            } 
            
            $data_row = array( 
                "penawaran" => $row,
                "code" => $row->SphCode.$SphRef.$sphforward, 
                "date" => date_format(date_create($row->SphDate),"d M Y"),
                "status" => $status,
                "admin" => ucwords($row->username),
                "total" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->SphGrandTotal,0)."</span></div>",
                "customer" => ucwords($row->SphCustName),
                "customertelp" => ($row->SphCustTelp ? $row->SphCustTelp : ""), 
                "customeraddress" => $row->SphAddress, 
                
                "detail" => $detail,
                // "detail" => '  <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1"><div class="col bg-light ms-4 me-2 py-2">'.$html_items.'</div></div>',
                "action" =>'  
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="print_project_Survey('.$row->ProjectId.','.$row->SphId.',this)"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="edit_project_Survey('.$row->ProjectId.','.$row->SphId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Penawaran" onclick="delete_project_Survey('.$row->ProjectId.','.$row->SphId.',this)"><i class="fa-solid fa-circle-xmark"></i></span>
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
}