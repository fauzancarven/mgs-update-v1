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
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
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
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-info me-1 pointer" onclick="update_status_survey(1,'.$row->SurveyId.')">PROGRESS</span></span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-regular fa-share-from-square pe-1"></i>Diteruskan</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><a class="text-detail-2" onclick="forward_survey_penawaran('.$row->SurveyId.')">Penawaran</a> | </span>
                        <span class="text-head-3"><a class="text-detail-2" onclick="forward_survey_sample('.$row->SurveyId.')">Sample</a> | </span>
                        <span class="text-head-3"><a class="text-detail-2" onclick="forward_survey_invoice('.$row->SurveyId.')">Invoice</a></span>
                    </div>
                </div>  ';
            }
            if($row->SurveyStatus==2){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-success me-1 pointer" onclick="update_status_survey(2,'.$row->SurveyId.')">FINISH</span></span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-regular fa-share-from-square pe-1"></i>Diteruskan</span>
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
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3"><span class="badge text-bg-danger me-1 pointer" onclick="update_status_survey(3,'.$row->SurveyId.')">CANCEL</span></span>
                    </div>
                </div> '; 
            }

            $html .= '
            <div class="card project mb-4 p-2">
                <div class="row">
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
                                <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Survey</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SurveyCode.'</span>
                            </div>
                        </div> 
                        '.$status.'
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.date_format(date_create($row->SurveyDate),"d M Y").'</span>
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
                                <span class="text-detail-2"><i class="fa-solid fa-users pe-1"></i>Staff</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$staffname .'</span>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-dollar-sign pe-1"></i>Biaya Operasional</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">Rp. '.number_format($row->SurveyTotal,0) .'</span>
                            </div>
                        </div>  
                    </div>
                    <div class="col-12  col-md-5 order-2 order-sm-1"> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-user pe-1"></i>PIC Lapangan</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SurveyCustName.'</span>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-phone pe-1"></i>No. Hp</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SurveyCustTelp.'</span>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-location-dot pe-1"></i>Lokasi</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SurveyAddress.'</span>
                            </div>
                        </div>  
                    </div> 
                    <div class="col-12  col-md-3 order-0 order-sm-2">
                        <div class="float-end d-md-flex d-none gap-1">  
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)">
                                <i class="fa-solid fa-print mx-1"></i><span>Cetak</span>
                            </button>
                            <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)">
                                <i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)">
                                <i class="fa-solid fa-close mx-1"></i><span>Hapus</span>
                            </button> 
                        </div> 
                        <div class="d-md-none d-flex btn-action justify-content-between"> 
                            <div class="text-head-1">Survey</div>
                            <div class="dropdown">
                                <a class="icon-rotate-90" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-more-alt icon-rotate-45"></i>
                                </a>
                                <ul class="dropdown-menu shadow"> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="edit_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)"><i class="fa-solid fa-pencil pe-2"></i>Ubah</a></li> 
                                    <li><a class="dropdown-item m-0 px-2" onclick="delete_project_Survey('.$row->ProjectId.','.$row->SurveyId.',this)"><i class="fa-solid fa-close pe-2"></i>Hapus</a></li> 
                                </ul>
                            </div>
                        </div> 
                    </div> 
                </div> 
                <div class="d-flex border-top pt-2 m-1 gap-2 align-items-center pt-2 justify-content-between">   
                    <span class="text-head-2"><i class="fa-solid fa-file-signature pe-2"></i>Hasil Survey</span>
                    '. ($row_finish ? 
                    '<button class="btn btn-sm btn-primary rounded border" onclick="edit_project_Survey_finish('.$row->ProjectId.','.$row_finish->SurveyFinishId.',this)"><i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
                    </button>' : "").'
                </div>
                '.$html_Survey.'  
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
}