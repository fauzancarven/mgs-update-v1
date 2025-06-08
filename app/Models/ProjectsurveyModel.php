<?php

namespace App\Models; 

use CodeIgniter\Model;  
use CodeIgniter\Database\RawSql;

class ProjectsurveyModel extends Model
{  
    protected $DBGroup = 'default';
    protected $table = 'survey';
    
    function format_filesize($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } else {
            $bytes = $bytes . ' byte';
        }
    
        return $bytes;
    }
    function load_datatable_project_survey($filter = null){
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();
        
        $builder = $this->db->table("survey");
        $builder->join("project","project.ProjectId = survey.ProjectId ","left");  
        $builder->join("users","users.id = survey.SurveyAdmin ","left"); 
        $builder->join("store","store.StoreId = project.StoreId","left");  
        if($filter["datestart"]){
            $builder->where("SurveyDate >=",$filter["datestart"]);
            $builder->where("SurveyDate <=",$filter["dateend"]); 
        } 
        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();


        if(isset($filter["filter"])){ 
            $builder->whereIn("SurveyStatus",$filter["filter"]); 
        } 
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("ProjectName",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("SurveyAddress",$filter["search"]);
            $builder->orLike("SurveyCode",$filter["search"]);
            $builder->orLike("username",$filter["search"]);
            $builder->orLike("SurveyCustName",$filter["search"]);
            $builder->groupEnd();  
        }
        
        // Order TAble
        $columns = array(
            0 => null, // kolom action tidak dapat diurutkan
            2 => "SurveyCode", // kolom name
            3 => "SurveyDate", // kolom action tidak dapat diurutkan
            4 => "SurveyStatus", // kolom image tidak dapat diurutkan
            5 => "SurveyAdmin", // kolom action tidak dapat diurutkan
            6 => "SurveyCustName", // kolom action tidak dapat diurutkan
            7 => "SurveyStaff", // kolom action tidak dapat diurutkan
            8 => "SurveyTotal", // kolom action tidak dapat diurutkan
            1 => null, // kolom action tidak dapat diurutkan
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
          
            // MENGAMBIL DATA STAFF
            $staffArray = explode('|', $row->SurveyStaff);
            $query =  $this->db->table('users');
            $query->whereIn('id', $staffArray);
            $result = $query->get()->getResult();
            $staffnames = array_column($result, 'username'); 
            $staffname = implode('', array_map(function($value, $key) {
                return "<span>".($key + 1) . '. ' . ucwords($value)."</span>";
            }, $staffnames, array_keys($staffnames))); 
  
            // MENGAMBIL DATA STATUS
            $status = "";
            if($row->SurveyStatus==0){
                $status .= '<span class="text-head-3"><span class="badge text-bg-primary me-1 pointer" onclick="update_status_survey(0,'.$row->SurveyId.')">New</span></span> ';
            }
            if($row->SurveyStatus==1){
                $status .= '<span class="text-head-3"><span class="badge text-bg-info me-1 pointer" onclick="update_status_survey(1,'.$row->SurveyId.')">Proses</span></span>';
            }
            if($row->SurveyStatus==2){
                $status .= '  <span class="text-head-3"><span class="badge text-bg-success me-1 pointer" onclick="update_status_survey(2,'.$row->SurveyId.')">Completed</span></span> ';
            }
            if($row->SurveyStatus==3){
                $status .= '<span class="text-head-3"><span class="badge text-bg-danger me-1 pointer" onclick="update_status_survey(3,'.$row->SurveyId.')">Cancel</span></span>  '; 
            }


            // MENGAMBIL DATA HASIL SURVEY
            $html_Survey = '
            <div class="view-detail">';
            //load data hasil survey
            $builders = $this->db->table("survey_finish");
            $builders->select('*');
            $builders->where('SurveyId',$row->SurveyId); 
            $row_finish = $builders->get()->getRow();   
            $html_Survey = "";
            if($row_finish){ 
                $html_Survey .= ' 
                            <div class="list-detail">
                                <div class="text-head-2 py-2">
                                    <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Hasil Survey<span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Hasil Survey" onclick="edit_project_Survey_finish('.$row->ProjectId.','.$row_finish->SurveyFinishId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                                </div> 
                                <div class="fw-normal row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">   
                                    <div class="col bg-light py-2">  
                                            '.$row_finish->SurveyFinishDetail.' 
                                        <div class="text-head-2 pb-2">A. File Pendukung</div>
                                        <div class="list-group"> ';
                                
                $htmlfile = "";
                $folder_utama = 'assets/images/project'; 
                 //Buat folder berdasarkan id
                if (!file_exists($folder_utama."/".$row->SurveyId)) {
                    mkdir($folder_utama."/".$row->SurveyId, 0777, true);  
                } 
                $files = scandir($folder_utama."/".$row->SurveyId);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        $filepath = base_url().$folder_utama."/".$row->SurveyId . '/' . $file;
                        $filesize = filesize($folder_utama."/".$row->SurveyId . '/' . $file); 
                        $filetype = mime_content_type($folder_utama."/".$row->SurveyId . '/' . $file);
                        $htmlfile .= ' 
                                            <li class="list-group-item list-group-item-action align-items-center d-flex view-document file pb-2" > 
                                                <i class="fa-solid fa-file fa-2x me-2"></i>
                                                <div class="d-flex flex-column flex-fill ms-2">
                                                    <span class="fs-6">'.$file.'</span>
                                                    <span class="text-muted">'.$this->format_filesize($filesize).' | '.$filetype.'</span>
                                                    <span class="text-muted">'.$filepath.'</span>
                                                </div>  
                                                    
                                                <button class="btn btn-sm float-end" onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm float-end" onclick="download_file(this)" data-file="'.$filepath.'">
                                                    <i class="fa-solid fa-download"></i>
                                                </button>
                                                
                                            </li>';
                    }
                }  
                if($htmlfile == "") $htmlfile = ' <div class="text-head-3 ps-4" >Tidak ada data</div>';
                $html_Survey .= $htmlfile.'       </div>
                                    </div>
                                </div>
                            </div>';   
            }else{
                if($row->SurveyStatus<3){
                    $html_Survey = '  
                    
                    <div class="list-detail">
                        <div class="text-head-2 py-2">
                            <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Hasil Survey
                        </div> 
                        <div class="alert alert-warning p-2 m-1" role="alert">
                            <span class="text-head-3">
                                <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                                Belum ada hasil survey yang dibuat dari dokumen ini, 
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_project_survey_finish('.$row->ProjectId.','.$row->SurveyId.',this)">Buat hasil survey</a> 
                            </span>
                        </div>
                    </div>'; 
                }else{
                    $html_Survey = '
                    <div class="list-detail">
                        <div class="text-head-2 py-2">
                            <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Hasil Survey
                        </div> 
                        <div class="fw-normal row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">  
                            <div class="col bg-light py-2">  
                                <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                                <span class="text-head-3">Tidak Ada hasil survey yang dibuat</span>
                            </div>
                        </div>
                    </div>';
                }
            }

            
            $payment = '';
            $payment_detail = "";
            if($row->SurveyTotal == 0){
                $payment = ' 
                        <span class="text-head-3 pointer payment">
                            <span class="badge text-bg-success me-1">Tidak ada</span>
                        </span> ';
                $payment_detail = '
                
                <div class="fw-normal row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">  
                    <div class="col bg-light py-2">  
                        <div class="text-head-3">
                            <i class="fa-solid fa-check text-success me-2" style="font-size:0.75rem"></i>
                            Tidak ada pembayaran yang harus diselesaikan untuk transaksi ini 
                        </div>
                    </div>
                </div>';
            }else{
                $payment = ' 
                        <span class="text-head-3 pointer payment">
                            <span class="badge text-bg-danger me-1">Belum Lengkap</span>
                        </span> ';
                $payment_detail = '
                
                <div class="fw-normal row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">  
                    <div class="col bg-light py-2">  
                        <div class="text-head-3">
                            <i class="fa-solid fa-triangle-exclamation text-warning me-2" style="font-size:0.75rem"></i>
                            Belum ada data pembayaran
                        </div>
                    </div>
                </div>'; 
            }
            $html_Survey .= '      
                <div class="list-detail">
                    <div class="text-head-2 py-2">
                        <i class="fa-regular fa-circle pe-2" style="color:#cccccc"></i>Pembayaran</span>
                    </div> 
                    '.$payment_detail.'
                </div> 
            </div>';


            $data_row = array( 
                "survey" => $row, 
                "code" => $row->SurveyCode.($row->SurveyStatus == 3 ? '<div class="text-detail-3 pt-2"><i class="fa-solid fa-share-from-square"></i> Tidak diteruskan</div>' : $this->get_data_return_survey($row->SurveyId,$row->ProjectId)),
                "date" =>date_format(date_create($row->SurveyDate),"d M Y"),
                "status" => $status,
                "admin" => ucwords($row->username),
                "staff" => "<div class='d-flex flex-column gap-1 text-head-3'>".$staffname."</div>",
                "biaya" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->SurveyTotal,0)."</span></div>", 
                "customer" => $row->SurveyCustName,
                "customertelp" => ($row->SurveyCustTelp ? $row->SurveyCustTelp : ""),
                "customeraddress" => $row->SurveyAddress,
                "detail" =>$html_Survey,
                "action" =>'  
                        <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="print_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)"><i class="fa-solid fa-print"></i></span>  
                        <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Penawaran" onclick="edit_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                        <div class="d-inline ">
                            <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Penawaran" onclick="delete_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)"><i class="fa-solid fa-circle-xmark"></i></span>
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
    function load_table_project_survey($filter = null){
        $builder = $this->db->table("survey");
        $builder->join("project","project.ProjectId = survey.ProjectId ","left");  
        $builder->join("users","users.id = survey.SurveyAdmin ","left"); 
        $builder->join("store","store.StoreId = project.StoreId","left");  
        if($filter["datestart"]){
            $builder->where("SurveyDate >=",$filter["datestart"]);
            $builder->where("SurveyDate <=",$filter["dateend"]); 
        }
        
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("ProjectName",$filter["search"]);
            $builder->orLike("ProjectComment",$filter["search"]);
            $builder->orLike("SurveyAddress",$filter["search"]);
            $builder->orLike("SurveyCode",$filter["search"]);
            $builder->groupEnd();  
        }
        
        if(isset($filter["status"])){ 
            $builder->whereIn("SurveyStatus",$filter["status"]); 
        }
        $builder->orderby('survey.SurveyId', 'DESC'); 
        $perPage = 10;
        $page = $filter["paging"]; // atau dapatkan dari parameter GET 
        $offset = ($page - 1) * $perPage; 
        $builder->limit($perPage, $offset);
        $query = $builder->get();  
        $count = $query->getNumRows();


        $html = "";
        foreach($query->getResult() as $row){   

            $staffArray = explode('|', $row->SurveyStaff);
            $query =  $this->db->table('users');
            $query->whereIn('id', $staffArray);
            $result = $query->get()->getResult();
            $staffname = implode(', ', array_column($result, 'username'));

            $alert = "";
            $builder = $this->db->table("penawaran");
            $builder->select('*');
            $builder->where('SurveyId',$row->SurveyId); 
            $builder->orderby('SphId', 'DESC'); 
            $queryref = $builder->get()->getRow();  
            if($queryref){
                $alert = ' 
                    <script>
                        function Survey_return_click_'.$row->ProjectId.'_'.$queryref->SphId.'(){
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
                        Survey berhasil diteruskan ke penawaran, dengan No. Penawaran :  <a class="text-head-2" style="cursor:pointer" onclick="Survey_return_click_'.$row->ProjectId.'_'.$queryref->SphId.'()">'.$queryref->SphCode.'</a>  
                    </span> 
                </div>';
            }else{
                $builder = $this->db->table("invoice");
                $builder->select('*');
                $builder->where('SurveyId',$row->SurveyId); 
                $builder->orderby('InvId', 'DESC'); 
                $queryref = $builder->get()->getRow();   
                if($queryref){
                    $alert = ' 
                    <script>
                        function Survey_return_click_'.$row->ProjectId.'_'.$queryref->InvId.'(){
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
                        Survey berhasil diteruskan ke invoice, dengan No. Invoice :  <a class="text-head-2" style="cursor:pointer" onclick="Survey_return_click_'.$row->ProjectId.'_'.$queryref->InvId.'()">'.$queryref->InvCode.'</a>  
                    </span> 
                </div>';
                }else{
                    $alert = '<div class="alert alert-primary p-2 m-1" role="alert"> 
                        <span class="text-head-2">
                            <i class="fa-solid fa-reply me-2 fa-rotate-180" style="font-size:0.75rem"></i>
                            Teruskan Survey ini ke 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_sph('.$row->ProjectId.',this,'.$row->SurveyId.')">penawaran</a> 
                            atau langsung ke pembuatan 
                            <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_invoice('.$row->ProjectId.',this,'.$row->SurveyId.',\'Survey\')">invoice</a>
                        </span> 
                    </div>'; 
                }
            }  


            //load data hasil survey
            $builders = $this->db->table("survey_finish");
            $builders->select('*');
            $builders->where('SurveyId',$row->SurveyId); 
            $row_finish = $builders->get()->getRow();   
            $html_Survey = "";
            if($row_finish){ 
                $html_Survey .= '<div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">  
                                    <div class="col bg-light ms-4 me-2 py-2"> 
                                        '.$row_finish->SurveyFinishDetail.' 
                                    <div class="list-group  "> ';
                                
                $folder_utama = 'assets/images/project'; 
                $files = scandir($folder_utama."/".$row->SurveyId);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {

                        $filesize = filesize($folder_utama."/".$row->SurveyId . '/' . $file); 
                        $html_Survey .= ' <li class="list-group-item list-group-item-action align-items-center d-flex view-document file pb-2" > 
                                            <i class="fa-solid fa-file fa-2x me-2"></i>
                                            <div class="d-flex flex-column flex-fill ms-2">
                                                <span class="fs-6">'.$file.'</span>
                                                <span class="text-muted">'.$this->format_filesize($filesize).'</span>
                                            </div>  
                                                
                                            <button class="btn btn-sm float-end" onclick="download_file(this)" data-file="'.$folder_utama."/".$row->SurveyId . '/' . $file.'">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                            
                                        </li>';
                    }
                }  
                $html_Survey .= ' </div></div></div> ';   
            }
            if($html_Survey == ""){
                $html_Survey = '  
                <div class="alert alert-warning p-2 m-1" role="alert">
                    <span class="text-head-2">
                        <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                        Belum ada hasil survey yang dibuat dari dokumen ini, 
                        <a class="text-head-2 text-primary" style="cursor:pointer" onclick="add_project_survey_finish('.$row->ProjectId.','.$row->SurveyId.',this)">Buat hasil survey</a> 
                    </span>
                </div>'; 
            }
           

            $category = "";
            foreach (explode("|",$row->ProjectCategory) as $index=>$x) {
                $category .= '<span class="badge badge-'.fmod($index, 5).' me-1">'.$x.'</span>';
            }  
            $status = "";
            if($row->SurveyStatus==0){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-3"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-primary me-1 pointer" onclick="update_status_survey(0,'.$row->SurveyId.')">NEW</span></span>
                    </div>
                </div> ';
            }
            if($row->SurveyStatus==1){
                $status .= ' 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-3"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-info me-1 pointer" onclick="update_status_survey(1,'.$row->SurveyId.')">PROGRESS</span></span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-3"><i class="fa-regular fa-share-from-square pe-1"></i>Diteruskan</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><a class="text-detail-3" onclick="forward_survey_penawaran('.$row->SurveyId.')">Penawaran</a> | </span>
                        <span class="text-head-3"><a class="text-detail-3" onclick="forward_survey_sample('.$row->SurveyId.')">Sample</a> | </span>
                        <span class="text-head-3"><a class="text-detail-3" onclick="forward_survey_invoice('.$row->SurveyId.')">Invoice</a></span>
                    </div>
                </div>  ';
            }
            if($row->SurveyStatus==2){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-3"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-success me-1 pointer" onclick="update_status_survey(2,'.$row->SurveyId.')">FINISH</span></span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-3"><i class="fa-regular fa-share-from-square pe-1"></i>Diteruskan</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><a class="text-head-3 cursor">INV/006/05/2025</a></span> 
                    </div>
                </div>  ';
            }
            if($row->SurveyStatus==3){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-3"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-danger me-1 pointer" onclick="update_status_survey(3,'.$row->SurveyId.')">CANCEL</span></span>
                    </div>
                </div> '; 
            }

            $html .= '
                        <div class="d-flex">
                            '.$row->SurveyCode.'
                            '.date_format(date_create($row->SurveyDate),"d M Y").'
                            '.$row->username .'
                            '.$staffname .'
                        </div>';
            // $html .= '
            // <div class="card project mb-4 p-2">
            //     <div class="row">
            //         <div class="col-md-3 col-10 order-0 project-store d-flex-column mb-md-0 mb-2"> 
            //             <div class="d-flex align-items-center ">
            //                 <div class="flex-shrink-0 ">
            //                     <img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">
            //                 </div>
            //                 <div class="flex-grow-1 ms-1">
            //                     <div class="d-flex flex-column"> 
            //                         <span class="text-head-2 d-flex gap-1 align-items-center"><div>'.$row->StoreCode.' - '.$row->StoreName.'</div></span>
            //                         <span class="text-detail-3 text-wrap overflow-x-auto">'.$category.'</span>  
            //                     </div>   
            //                 </div>
            //             </div>
            //         </div>
                    
            //         <div class="col-md-3 col-12 order-2 order-sm-1">
            //             <div class="d-flex flex-column">
            //                 <span class="text-head-2">'.$row->ProjectName.'</span>
            //                 <span class="text-detail-3 text-truncate overflow-x-auto">Catatan : '.$row->ProjectComment.'</span>  
            //             </div> 
            //         </div>   
            //     </div>
            //     <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">
            //         <div class="col-12  col-md-4 order-1 order-sm-0">
                   
            //             <div class="row">
            //                 <div class="col-4"> 
            //                     <span class="text-detail-3"><i class="fa-solid fa-bookmark pe-1"></i>No. Survey</span>
            //                 </div>
            //                 <div class="col-8">
            //                     <span class="text-head-3">'.$row->SurveyCode.'</span>
            //                 </div>
            //             </div> 
            //             '.$status.'
            //             <div class="row">
            //                 <div class="col-4"> 
            //                     <span class="text-detail-3"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
            //                 </div>
            //                 <div class="col-8">
            //                     <span class="text-head-3">'.date_format(date_create($row->SurveyDate),"d M Y").'</span>
            //                 </div>
            //             </div> 
            //             <div class="row">
            //                 <div class="col-4"> 
            //                     <span class="text-detail-3"><i class="fa-solid fa-user pe-1"></i>Admin</span>
            //                 </div>
            //                 <div class="col-8">
            //                     <span class="text-head-3">'.$row->username .'</span>
            //                 </div>
            //             </div> 
            //             <div class="row">
            //                 <div class="col-4"> 
            //                     <span class="text-detail-3"><i class="fa-solid fa-users pe-1"></i>Staff</span>
            //                 </div>
            //                 <div class="col-8">
            //                     <span class="text-head-3">'.$staffname .'</span>
            //                 </div>
            //             </div>  
            //             <div class="row">
            //                 <div class="col-4"> 
            //                     <span class="text-detail-3"><i class="fa-solid fa-dollar-sign pe-1"></i>Biaya Operasional</span>
            //                 </div>
            //                 <div class="col-8">
            //                     <span class="text-head-3">Rp. '.number_format($row->SurveyTotal,0) .'</span>
            //                 </div>
            //             </div>  
            //         </div>
            //         <div class="col-12  col-md-5 order-2 order-sm-1"> 
            //             <div class="row">
            //                 <div class="col-4"> 
            //                     <span class="text-detail-3"><i class="fa-solid fa-user pe-1"></i>PIC Lapangan</span>
            //                 </div>
            //                 <div class="col-8">
            //                     <span class="text-head-3">'.$row->SurveyCustName.'</span>
            //                 </div>
            //             </div> 
            //             <div class="row">
            //                 <div class="col-4"> 
            //                     <span class="text-detail-3"><i class="fa-solid fa-phone pe-1"></i>No. Hp</span>
            //                 </div>
            //                 <div class="col-8">
            //                     <span class="text-head-3">'.$row->SurveyCustTelp.'</span>
            //                 </div>
            //             </div> 
            //             <div class="row">
            //                 <div class="col-4"> 
            //                     <span class="text-detail-3"><i class="fa-solid fa-location-dot pe-1"></i>Lokasi</span>
            //                 </div>
            //                 <div class="col-8">
            //                     <span class="text-head-3">'.$row->SurveyAddress.'</span>
            //                 </div>
            //             </div>  
            //         </div> 
            //         <div class="col-12  col-md-3 order-0 order-sm-2">
            //             <div class="float-end d-md-flex d-none gap-1">  
            //                 <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)">
            //                     <i class="fa-solid fa-print mx-1"></i><span>Cetak</span>
            //                 </button>
            //                 <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)">
            //                     <i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
            //                 </button>
            //                 <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)">
            //                     <i class="fa-solid fa-close mx-1"></i><span>Hapus</span>
            //                 </button> 
            //             </div> 
            //             <div class="d-md-none d-flex btn-action justify-content-between"> 
            //                 <div class="text-head-1">Survey</div>
            //                 <div class="dropdown">
            //                     <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            //                         <i class="ti-more-alt icon-rotate-45"></i>
            //                     </a>
            //                     <ul class="dropdown-menu shadow"> 
            //                         <li><a class="dropdown-item m-0 px-2" onclick="edit_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
            //                         <li><a class="dropdown-item m-0 px-2" onclick="delete_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
            //                     </ul>
            //                 </div>
            //             </div> 
            //         </div> 
            //     </div> 
            //     <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center pt-2 justify-content-between">   
            //         <span class="text-head-2"><i class="fa-solid fa-file-signature pe-2"></i>Hasil Survey</span>
            //         '. ($row_finish ? 
            //         '<button class="btn btn-sm btn-primary rounded border" onclick="edit_project_Survey_finish('.$row->ProjectId.','.$row_finish->SurveyFinishId.',this)"><i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
            //         </button>' : "").'
            //     </div>
            //     '.$html_Survey.'  
            // </div> 
            // ';
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
        $builder = $this->db->table("survey");
        $builder->join("project","project.ProjectId = survey.ProjectId ","left"); 
        $builder->join("users","users.id = survey.SurveyAdmin ","left"); 
        $builder->where("SurveyStatus <",2);
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

    function get_data_return_survey($id,$project = 0){ 
        //check penawaran
        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->where('SphRef',$id); 
        $builder->where('SphRefType',"Survey");  
        $builder->orderBy('SphId', 'DESC'); 
        $queryref = $builder->get()->getRow();  
        if($queryref){
            return '  
                    <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data diteruskan ke penawaran">
                        <i class="fa-solid fa-share-from-square"></i>
                        <a class="text-detail-3 pointer text-decoration-underline" onclick="survey_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SphId.'\',\'Penawaran\')">'.$queryref->SphCode.'</a>
                    </div> 
                '; 
        }else{ 
            $builder = $this->db->table("sample");
            $builder->select('*');
            $builder->where('SampleRef',$id); 
            $builder->where('SampleRefType',"Survey");  
            $builder->orderby('SampleId', 'DESC'); 
            $queryref = $builder->get()->getRow();   
            if($queryref){
                return '   
                    <div class="text-head-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data diteruskan ke sampel barang">
                        <i class="fa-solid fa-share-from-square"></i>
                        <a class="text-detail-3 pointer text-decoration-underline" onclick="survey_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->SampleId.'\',\'Sample\')">'.$queryref->SampleCode.'</a>
                    </div>  
                ';
            }else{ 
                
                // INVOICE
                $builder = $this->db->table("invoice");
                $builder->select('*');
                $builder->where('InvRef',$id); 
                $builder->where('InvRefType',"Survey");  
                $builder->orderby('InvId', 'DESC'); 
                $queryref = $builder->get()->getRow();   
                if($queryref){
                    return '   
                        <div class="text-head-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Data diteruskan ke invoice">
                            <i class="fa-solid fa-share-from-square"></i>
                            <a class="text-detail-3 pointer text-decoration-underline" onclick="survey_return_view_click(\''.$queryref->ProjectId.'\',\''.$queryref->InvId.'\',\'Invoice\')">('.$queryref->InvCode.')</a>
                        </div> 
                    ';
                }else{ 
                    return ' 
                    <div class="text-detail-3 pt-2">
                        <i class="fa-solid fa-share-from-square"></i>
                        <a class="text-detail-3" data-bs-toggle="tooltip" data-bs-title="teruskan ke Sample" onclick="survey_return_add_click(\''.$project.'\',this,\''.$id.'\',\'Sample\')">Sample</a> | 
                        <a class="text-detail-3" data-bs-toggle="tooltip" data-bs-title="teruskan ke penawaran" onclick="survey_return_add_click(\''.$project.'\',this,\''.$id.'\',\'Penawaran\')">Penawaran</a> |  
                        <a class="text-detail-3" data-bs-toggle="tooltip" data-bs-title="teruskan ke invoice"  onclick="survey_return_add_click(\''.$project.'\',this,\''.$id.'\',\'Invoice\')">Invoice</a>
                    </div>';  
                }
            }
        }  
    }
}