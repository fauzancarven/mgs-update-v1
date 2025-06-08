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

    public function load_datatable_project_sample($filter = null){ 
        $modelsproduk = new ProdukModel();
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();

        $builder = $this->db->table($this->table);
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
            $arr_detail = $this->get_data_sample_detail($row->SampleId);
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

    public function get_next_code_sample($date){
        //sample SPH/001/01/2024
        $arr_date = explode("-", $date);
        $builder = $this->db->table($table);  
        $builder->select("ifnull(max(SUBSTRING(SampleCode,5,3)),0) + 1 as nextcode");
        $builder->where("month(SampleDate2)",$arr_date[1]);
        $builder->where("year(SampleDate2)",$arr_date[0]);
        $data = $builder->get()->getRow(); 
        switch (strlen($data->nextcode)) {
            case 1:
                $nextid = "SPL/00" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 2:
                $nextid = "SPL/0" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid; 
            case 3:
                $nextid = "SPL/" . $data->nextcode."/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
            default:
                $nextid = "SPL/000/".$arr_date[1]."/".$arr_date[0];
                return $nextid;  
        } 
    } 
 
    public function insert_data_sample($data){ 
        $header = $data["header"]; 

        $builder = $this->db->table($table);
        $builder->insert(array(
            "SampleCode"=>$this->get_next_code_sample($header["SampleDate"]),
            "SampleDate"=>$header["SampleDate"],
            "SampleDate2"=>$header["SampleDate"],  
            "ProjectId"=>$header["ProjectId"],
            "SampleRef"=>$header["SampleRef"],
            "SampleRefType"=>$header["SampleRefType"],
            "SampleCustName"=>$header["SampleCustName"],
            "SampleCustTelp"=>$header["SampleCustTelp"],
            "SampleAddress"=>$header["SampleAddress"],
            "SampleDelivery"=>$header["SampleDelivery"],
            "SampleDeliveryTotal"=>$header["SampleDeliveryTotal"],
            "SampleAdmin"=>$header["SampleAdmin"], 
            "TemplateId"=>$header["TemplateId"],
            "SampleSubTotal"=>$header["SampleSubTotal"],
            "SampleDiscItemTotal"=>$header["SampleDiscItemTotal"],
            "SampleDiscTotal"=>$header["SampleDiscTotal"],
            "SampleGrandTotal"=>$header["SampleGrandTotal"],
            "SampleStatus"=>($header["SampleGrandTotal"] == "0" ? 1 : 0),
            "created_user"=>user()->id, 
            "created_at"=>new RawSql('CURRENT_TIMESTAMP()'), 
        ));

        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->orderby('SampleId', 'DESC');
        $builder->limit(1);
        $query = $builder->get()->getRow();  
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SampleDetailRef"] = $query->SampleId;
            $row["SampleDetailVarian"] = (isset($row["SampleDetailVarian"]) ? json_encode($row["SampleDetailVarian"]) : "[]");  
            $builder = $this->db->table("sample_detail");
            $builder->insert($row); 
        }

        
        //update status Penawaran
        if( $header["SampleRefType"] == "Penawaran"){ 
            $builder = $this->db->table("penawaran"); 
            $builder->set('SphStatus', 1); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SphId', $header["SampleRef"]); 
            $builder->update(); 
        }  

        //update status Survey
        if( $header["SampleRefType"] == "Survey") $this->update_data_survey_status($header["SampleRef"]);
        

        
        //update status Sample
        $this->update_data_sample_status($query->SampleId);

        //update status project
        $builder = $this->db->table("project"); 
        $builder->set('ProjectStatus', 2);  
        $builder->where('ProjectId', $header["ProjectId"]); 
        $builder->update();   
    }

    public function data_project_sample($project_id){ 
        $modelsproduk = new ProdukModel();
        $html = ""; 
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('users',"id=SampleAdmin","left"); 
        $builder->where('ProjectId',$project_id);
        $builder->where('SampleStatus !=',3);
        $builder->orderby('SampleStatus', 'ASC'); 
        $builder->orderby('SampleDate', 'ASC'); 
        $query = $builder->get()->getResult();  
        $data_count = 0; 
        foreach($query as $row){ 
            $data_count++;
 
            $builder = $this->db->table("sample_detail");
            $builder->select('*'); 
            $builder->where('SampleDetailRef',$row->SampleId);
            $builder->orderby('SampleDetailId', 'ASC'); 
            $items = $builder->get()->getResult(); 
            $html_items = "";
            $no = 1;
            $huruf  = "A"; 
            foreach($items as $item){ 
                $arr_varian = json_decode($item->SampleDetailVarian);
                $arr_badge = "";
                $arr_no = 0;
                foreach($arr_varian as $varian){
                    $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                    $arr_no++;
                }
                
                $gambar = $modelsproduk->getproductimagedatavarian($item->ProdukId,$item->SampleDetailVarian,true) ;
                $html_items .= '
                <div class="row">
                    <div class="col-12 col-md-4 my-1 varian">   
                        <div class="d-flex gap-2"> 
                            ' . ($item->SampleDetailType == "product" ? ($gambar ? "<img src='". $gambar ."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url("assets/images/produk/default.png").'?date='.date("Y-m-dH:i:s")."' alt='Gambar Default'>") : "").'  
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


            $SampleRef = '-';
            // MENGAMBIL DATA REFERENSI
            if($row->SampleRefType == "Survey"){
                $builder = $this->db->table("survey");
                $builder->where('SurveyId',$row->SampleRef); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    $SampleRef = ' 
                    <script>
                        function sample_ref_click_'.$project_id.'_'.$queryref->SurveyId.'(){
                            $(".icon-project[data-menu=\'survey\'][data-id=\''.$project_id.'\']").trigger("click");
                            setTimeout(function() {
                                var targetElement = $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SurveyId.'\']");
                                var contentData = $(".content-data[data-id=\''.$project_id.'\']");
                                if (targetElement.length > 0 && contentData.length > 0) {
                                    var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                    contentData.scrollTop(targetOffset);
                                }
                               
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SurveyId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SurveyId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SurveyId.'\'").removeClass("show"); 
                                    }, 2000); // delay 1 detik
                                })
    
                            }, 500); // delay 1 detik
                        }
                    </script> 
                    <span class="text-head-3">Survey </span><span class="text-head-3 pointer text-decoration-underline" onclick="sample_ref_click_'.$project_id.'_'.$queryref->SurveyId.'()">('.$queryref->SurveyCode.')
                    </span>  '; 
                }
            } 
            if($row->SampleRefType == "Penawaran"){
                $builder = $this->db->table("penawaran");
                $builder->where('SphId',$row->SampleRef); 
                $queryref = $builder->get()->getRow();  
                if($queryref){
                    $SampleRef = ' 
                    <script>
                        function sample_ref_click_'.$project_id.'_'.$queryref->SphId.'(){
                            $(".icon-project[data-menu=\'penawaran\'][data-id=\''.$project_id.'\']").trigger("click");
                            setTimeout(function() {
                                var targetElement = $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\']");
                                var contentData = $(".content-data[data-id=\''.$project_id.'\']");
                                if (targetElement.length > 0 && contentData.length > 0) {
                                    var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                    contentData.scrollTop(targetOffset);
                                }
                               
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").addClass("show");
                                $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").hover(function() {
                                    setTimeout(function() {
                                         $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").removeClass("show"); 
                                    }, 2000); // delay 1 detik
                                })
    
                            }, 500); // delay 1 detik
                        }
                    </script> 
                    <span class="text-head-3">Penawaran </span><span class="text-head-3 pointer text-decoration-underline" onclick="sample_ref_click_'.$project_id.'_'.$queryref->SphId.'()">('.$queryref->SphCode.')
                    </span>  '; 
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
                    function sample_return_click_'.$project_id.'_'.$queryref->SphId.'(){
                        $(".icon-project[data-menu=\'penawaran\'][data-id=\''.$project_id.'\']").trigger("click");
                        setTimeout(function() {
                            var targetElement = $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\']");
                            var contentData = $(".content-data[data-id=\''.$project_id.'\']");
                            if (targetElement.length > 0 && contentData.length > 0) {
                                var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                contentData.scrollTop(targetOffset);
                            }
                           
                            $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").addClass("show");
                            $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").hover(function() {
                                setTimeout(function() {
                                     $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->SphId.'\'").removeClass("show"); 
                                }, 2000); // delay 1 detik
                            })

                        }, 500); // delay 1 detik
                    }
                </script> 
                <span class="text-head-3">Penawaran </span><span class="text-head-3 pointer text-decoration-underline" onclick="sample_return_click_'.$project_id.'_'.$queryref->SphId.'()">('.$queryref->SphCode.')
                </span>  '; 
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
                                function survey_return_click_'.$project_id.'_'.$queryref->InvId.'(){
                                    $(".icon-project[data-menu=\'invoice\'][data-id=\''.$project_id.'\'").trigger("click");
                                    setTimeout(function() {
                                        var targetElement = $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\']");
                                        var contentData = $(".content-data[data-id=\''.$project_id.'\']");
                                        if (targetElement.length > 0 && contentData.length > 0) {
                                            var targetOffset = targetElement.offset().top - contentData.offset().top + contentData.scrollTop() - 200;
                                            contentData.scrollTop(targetOffset);
                                        }
                                       
                                        $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").addClass("show");
                                        $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").hover(function() {
                                            setTimeout(function() {
                                                 $(".list-project[data-project=\''.$project_id.'\'][data-id=\''.$queryref->InvId.'\'").removeClass("show"); 
                                            }, 2000); // delay 1 detik
                                        })

                                    }, 1000); // delay 1 detik
                                }
                            </script>
                            
                            <span class="text-head-3">Invoice </span><span class="text-head-3 pointer text-decoration-underline" onclick="survey_return_click_'.$project_id.'_'.$queryref->InvId.'()">('.$queryref->InvCode.')
                            </span> 
                        ';
                }else{
                    $SampleForward = ' <span class="text-head-3"><a class="text-detail-2" onclick="add_project_sph('.$project_id.',this,'.$row->SampleId.',\'Sample\')">Penawaran</a> | </span> 
                    <span class="text-head-3"><a class="text-detail-2" onclick="add_project_invoice('.$project_id.',this,'.$row->SampleId.',\'Sample\')">Invoice</a></span>'; 
                }
            }
            
            // MENGAMBIL DATA PEMBAYARAN
            $html_payment = "";
            $payment_total = 0;
            if($row->SampleGrandTotal == 0){
                $html_payment = ' 
                <span class="text-head-3 ps-4">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Tidak ada pembayaran yang harus diselesaikan untuk transaksi ini 
                </span> ';
            }else{
                $builder = $this->db->table("payment");
                $builder->select('*'); 
                $builder->where('PaymentRef',$row->SampleId);
                $builder->where('PaymentRefType',"Sample");
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
                        //$status = '<span class="text-head-3 text-warning">Pending</span>';
                    }else{
                        $status = ' <span class="text-head-3 text-success">
                        <span class="fa-stack" small style="vertical-align: top;font-size:0.4rem"> 
                            <i class="fa-solid fa-certificate fa-stack-2x"></i>
                            <i class="fa-solid fa-check fa-stack-1x fa-inverse"></i>
                        </span>Verified</span>';
                        //$status = '<span class="text-head-3 text-success">Terverifikasi</span>';
                    } 

                    $html_payment .= '
                    <div class="list-project mb-4 p-2 project-hide">  
                        <div class="header row gx-0 gy-0 gx-md-4 gy-md-2 ps-3" >
                            <div class="d-flex gap-4"> 
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Pembayaran</span>
                                    <span class="text-head-3">'.$row_payment->PaymentCode.'</span>
                                </div>    
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-calendar-days pe-1"></i>Tanggal</span>
                                    <span class="text-head-3">'.date_format(date_create($row_payment->PaymentDate),"d M Y").'</span>
                                </div>   
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                                    '.$status.'
                                </div>   
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-layer-group pe-1"></i>Type</span>
                                    <span class="text-head-3">'.$row_payment->PaymentType.'</span>
                                </div>   
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-credit-card pe-1"></i>Method</span>
                                    <span class="text-head-3">'.$row_payment->PaymentMethod.'</span>
                                </div>   
                                <div class="d-flex flex-row flex-md-column justify-content-between">
                                    <span class="text-detail-2"><i class="fa-solid fa-money-bill pe-1"></i>Total</span>
                                    <span class="text-head-3">Rp. '.number_format($row_payment->PaymentTotal,0, ',', '.').'</span>
                                </div>   
                                <div class="flex-fill text-end">  
                                    <button class="btn btn-sm btn-primary btn-action rounded border '.($row_payment->PaymentDoc == "1" ? "" : "d-none" ).'" onclick="show_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->SampleId.','.$row_payment->PaymentId.',this,\'sample\')">
                                        <i class="fa-solid fa-eye mx-1"></i><span>Lihat Bukti</span>
                                    </button>
                                    <button class="btn btn-sm btn-primary btn-action rounded border" onclick="print_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')">
                                        <i class="fa-solid fa-print mx-1"></i><span>Cetak</span>
                                    </button>
                                    <button class="btn btn-sm btn-primary btn-action rounded border" onclick="edit_project_'.($row_payment->PaymentDoc == "1" ? "payment" : "proforma" ).'('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')">
                                        <i class="fa-solid fa-pencil mx-1"></i><span>Ubah</span>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-action rounded border" onclick="delete_project_payment('.$project_id.','.$row_payment->PaymentId.',this,\'sample\')">
                                        <i class="fa-solid fa-close mx-1"></i><span>Hapus</span>
                                    </button> 
                                </div> 
                            </div>
                        </div>
                    </div>';
                
                } 
                if($html_payment == ""){
                    $html_payment = '<div class="alert alert-warning p-2 m-1" role="alert"> 
                            <span class="text-head-3">
                                <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                                Belum ada data pembayaran, silahkan tambahkan data  
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_project_payment('.$project_id.','.$row->SampleId.',this,\'sample\')">Pembayaran</a>
                            </span> 
                        </div>';
                }elseif($payment_total < $row->SampleGrandTotal){
                    $html_payment .= '
                    <div class="alert alert-warning p-2 m-1" role="alert"> 
                        <span class="text-head-3">
                            <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                            Masih ada sisa pembayaran yang belum diselesaikan, silahkan buat data  
                            <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_project_payment('.$project_id.','.$row->SampleId.',this,\'sample\')">Pembayaran</a>
                        </span> 
                    </div>';
                }
            }

            // MENGAMBIL DATA PENGIRIMAN
            $html_delivery = "";
            if($row->SampleDelivery == 0){
                $html_delivery = ' 
                <span class="text-head-3 ps-4">
                    <i class="fa-solid fa-check text-success me-2 text-success" style="font-size:0.75rem"></i>
                    Mode pengriman tidak diaktifkan untuk transaksi ini, 
                    <a class="text-head-3 text-primary" style="cursor:pointer" onclick="sample_project_update_delivery('.$project_id.','.$row->SampleId.',this,1)">aktifkan mode Pengiriman</a>
                </span> ';
            }else{
                $builder = $this->db->table("delivery");
                $builder->select('*');    
                $builder->where('DeliveryRef',$row->SampleId); 
                $builder->where('DeliveryRefType',"Sample");  
                $builder->where('DeliveryStatus <',"3"); 
                $builder->orderby('DeliveryId', 'ASC'); 
                $delivery = $builder->get()->getResult();
                
                foreach($delivery as $row_delivery){

                    $builder = $this->db->table("delivery_detail");
                    $builder->select('*'); 
                    $builder->where('DeliveryDetailRef',$row_delivery->DeliveryId);
                    $builder->orderby('DeliveryDetailId', 'ASC'); 
                    $items = $builder->get()->getResult(); 
                    $html_items_delivery = "";
                    $no = 1;
                    $huruf  = "A";
                    foreach($items as $item){  
                        $arr_varian = json_decode($item->DeliveryDetailVarian);
                        $arr_badge = "";
                        $arr_no = 0;
                        foreach($arr_varian as $varian){
                            $arr_badge .= '<span class="badge badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                            $arr_no++;
                        }

                        $gambar = $modelsproduk->getproductimagedatavarian($item->ProdukId,$item->DeliveryDetailVarian,true) ; 
                        $html_items_delivery .= '
                        <div class="row">
                            <div class="col-12 col-md-5 my-1 varian">   
                                <div class="d-flex gap-2">
                                ' . ($item->DeliveryDetailType == "product" ? ($gambar ? "<img src='". $gambar."' alt='Gambar' class='produk'>" : "<img class='produk' src='".base_url("assets/images/produk/default.png").'?date='.date("Y-m-dH:i:s")."' alt='Gambar Default' >") : "").'  
                                    <div class="d-flex flex-column text-start">
                                        <span class="text-head-3 text-uppercase"  '.($item->DeliveryDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->DeliveryDetailText.'</span>
                                        <span class="text-detail-2 text-truncate"  '.($item->DeliveryDetailType == "product" ? "" : "style=\"font-size: 0.75rem;\"").'>'.$item->DeliveryDetailGroup.'</span> 
                                        <div class="d-flex flex-wrap gap-1">
                                            '.$arr_badge.'
                                        </div>
                                    </div> 
                                </div>
                            </div>'; 
                        $html_items_delivery .= '<div class="col-12 col-md-7 my-1 detail">
                                            <div class="row"> 
                                                <div class="col-6 col-md-3">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Dikirim:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQty, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                                <div class="col-6 col-md-2">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Spare:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQtySpare, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                                <div class="col-4 col-md-3 px-1 border-left">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Diterima:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQtyReceive, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                                <div class="col-4 col-md-2 px-1">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Spare:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQtyReceiveSpare, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                                <div class="col-4 col-md-2 px-1">   
                                                    <div class="d-flex flex-column">
                                                        <span class="text-detail-2">Rusak:</span>
                                                        <span class="text-head-2">'.number_format($item->DeliveryDetailQtyReceiveWaste, 2, ',', '.').' '.$item->DeliveryDetailSatuanText.'</span>
                                                    </div>
                                                </div>  
                                            </div>   
                                        </div> 
                                    </div>';
                        $no++; 
                            
                        
                    } 
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
                                                <span class="text-head-3"><a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_project_proses('.$project_id.','.$row_delivery->DeliveryId.',this)">Proses Pengiriman</a></span>
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
                                    <span class="text-head-3"><a class="text-head-3 text-primary" style="cursor:pointer" onclick="delivery_project_finish('.$project_id.','.$row_delivery->DeliveryId.',this)">Terima Pengiriman</a></span>
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
                    $html_delivery .= '
                        <div class="list-project mb-4 p-2 project-hide">  
                            <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">
                                <div class="col-12  col-md-4 order-1 order-sm-0"> 
                                    <div class="row">
                                        <div class="col-4"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Pengiriman</span>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-head-3">'.$row_delivery->DeliveryCode.'</span>
                                            <span class="text-primary pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Pengiriman" onclick="print_project_delivery('.$project_id.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-print"></i></span>
                                            <span class="text-warning pointer text-head-3 '.($row_delivery->DeliveryStatus > 1 ? "d-none" : "").'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Pengiriman" onclick="edit_project_delivery('.$project_id.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                                            <span class="text-danger pointer text-head-3 '.($row_delivery->DeliveryStatus > 0 ? "d-none" : "").'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Pengiriman"  onclick="delete_project_delivery('.$project_id.','.$row_delivery->DeliveryId.',this)"><i class="fa-solid fa-circle-xmark"></i></span>
                                                
                                        </div>
                                    </div> 
                                    
                                    <div class="row">
                                        <div class="col-4"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-head-3">'.$delivery_status.'</span>
                                        </div>
                                    </div>     
                                    <div class="row">
                                        <div class="col-4"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-flag pe-1"></i>Ritase</span>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-head-3">'.$row_delivery->DeliveryRitase.' ('.$this->getTerbilang($row_delivery->DeliveryRitase).')</span>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-4"> 
                                            <span class="text-detail-2"><i class="fa-solid fa-truck pe-1"></i>Armada</span>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-head-3">'.$row_delivery->DeliveryArmada.'</span>
                                        </div>
                                    </div>    
                                    '.$delivery_date .'   
                                </div>   
                                <div class="col-12  col-md-8 order-1 order-sm-1">  
                                    <div class="d-flex mt-2 p-2 gap-4 align-items-center">   
                                        <div class="d-flex flex-row flex-md-column align-self-start">
                                            <span class="text-detail-2"><i class="fa-solid fa-plane-departure pe-1"></i></i>Dari</span>
                                            <span class="text-head-2">'.$row_delivery->DeliveryFromName.'</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryFromTelp.'</span>
                                            <span class="text-detail-2">'.$row_delivery->DeliveryFromAddress.'</span>
                                        </div>    
                                        <div class="d-flex text-primary align-items-center">
                                            <i class="fa-solid fa-truck pe-1"></i>
                                            <div class="line-dot"></div>
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                        <div class="d-flex flex-row flex-md-column align-self-start">
                                            <span class="text-detail-2"><i class="fa-solid fa-plane-arrival pe-1"></i>Tujuan</span>
                                            <span class="text-head-2">'.$row_delivery->DeliveryToName.'</span>
                                            <span class="text-head-3">'.$row_delivery->DeliveryToTelp.'</span>
                                            <span class="text-detail-2">'.$row_delivery->DeliveryToAddress.'</span>
                                        </div>   
                                    </div>   
                                </div>  
                            </div>   
                            <div class="detail-item mt-1 p-2 border-top">
                                '.$html_items_delivery.' 
                            </div>  
                        </div>';
                }
                if($html_delivery == ""){
                    $html_delivery = ' 
                        <div class="alert alert-warning p-2 m-1" role="alert">
                            <span class="text-head-3">
                                <i class="fa-solid fa-triangle-exclamation text-danger me-2" style="font-size:0.75rem"></i>
                                Belum ada data pengiriman, 
                                <a class="text-head-3 text-primary" style="cursor:pointer" onclick="add_project_delivery('.$project_id.','.$row->SampleId.',this,\'sample\')">Buat Data Pengiriman</a> atau <a class="text-head-3 text-primary" style="cursor:pointer" onclick="sample_project_update_delivery('.$project_id.','.$row->SampleId.',this,0)">nonaktifkan mode Pengiriman</a>
                            </span>
                        </div>';
                }
            } 

            $status = "";
            if($row->SampleStatus==0){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8"> 
                        <span class="text-head-3">
                            <span class="badge text-bg-primary me-1">Baru</span> 
                        </span>
                    </div>
                </div> ';
            }
            if($row->SampleStatus==1){
                $status .= ' 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3">
                            <span class="badge text-bg-info me-1">Proses</span>
                            <span class="text-primary pointer d-none" onclick="update_status_survey(1,'.$row->SampleId.')"><i class="fa-solid fa-pen-to-square"></i></span>
                        </span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-regular fa-share-from-square pe-1"></i>Teruskan</span>
                    </div>
                    <div class="col-8">
                        '.$SampleForward.'
                    </div>
                </div>  ';
            }
            if($row->SampleStatus==2){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3">
                            <span class="badge text-bg-success me-1">Selesai</span>
                        </span>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-regular fa-share-from-square pe-1"></i>Diteruskan</span>
                    </div>
                    <div class="col-8">
                        '.$SampleForward.'
                    </div>
                </div>  ';
            }
            if($row->SampleStatus==3){
                $status .= '
                <div class="row">
                    <div class="col-4"> 
                        <span class="text-detail-2"><i class="fa-solid fa-hourglass-start pe-1"></i>Status</span>
                    </div>
                    <div class="col-8">
                        <span class="text-head-3">
                            <span class="badge text-bg-danger me-1">Batal</span>
                        </span>
                    </div>
                </div> '; 
            }


            $html .= '
            <div class="list-project mb-4 p-2" data-id="'.$row->SampleId.'" data-project="'.$project_id.'">
                <div class="row gx-0 gy-0 gx-md-4 gy-md-2 ps-3 pe-1">
                    <div class="col-12  col-md-4 order-1 order-sm-0"> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-bookmark pe-1"></i>No. Sample</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$row->SampleCode.'</span>
                                <span class="text-primary pointer text-head-3 d-none" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Sample" onclick="print_project_Sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-print"></i></span>
                                <div class="d-inline '.($row->SampleStatus > 1 ? "d-none" : "").'">
                                    <span class="text-warning pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah Data Sample" onclick="edit_project_sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-pen-to-square"></i></span>
                                    <span class="text-danger pointer text-head-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Data Sample"  onclick="delete_project_sample('.$row->ProjectId.','.$row->SampleId.',this)"><i class="fa-solid fa-circle-xmark"></i></span>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-flag pe-1"></i>Referensi</span>
                            </div>
                            <div class="col-8">
                                <span class="text-head-3">'.$SampleRef .'</span>
                            </div>
                        </div>    
                        '.$status.'
                        
                    </div>  
                    <div class="col-12  col-md-3 order-1 order-sm-1"> 
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
                    </div>
                    <div class="col-12  col-md-5 order-2 order-sm-1"> 
                        <div class="row">
                            <div class="col-4"> 
                                <span class="text-detail-2"><i class="fa-solid fa-user pe-1"></i>Nama</span>
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
                </div>  
                <div class="detail-item p-2 m-1 border-top">
                    '.$html_items.' 
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
                    <span class="text-detail-2">pengiriman:</span>
                    <span class="text-head-2">Rp. '.number_format($row->SampleDeliveryTotal, 0, ',', '.').'</span>   
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

        if($html == ""){ 
            $html = '
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <img src="'.base_url().'assets/images/empty.png" alt="" style="width:150px;height:150px;">
                    <span class="text-head-2">Belum ada data yang dibuat</span> 
                </div> 
            ';
        }
        $html = '<div class="p-2 text-center"><h5 class="fw-bold" style="color: #032e7c !important; ">Sampel Barang</h5></div>'.$html;
        $html .= '   <div class="d-flex justify-content-center flex-column align-items-center">
                        <button class="btn btn-sm btn-primary px-3 m-2" onclick="add_project_sample(\''.$project_id.'\',this)"><i class="fa-solid fa-plus pe-2"></i>Buat data sample barang</button>
                    </div>';

        $modelproject = new ProjectModel();
        return json_encode(
            array(
                "status"=>true,
                "html"=>$html,
                "count"=>$data_count,
                "project"=>$modelproject->load_project_status($project_id)
            )
        );
    }

    public function data_project_sample_notif($project_id){
        $alert = array(); 
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('ProjectId',$project_id);
        $builder->where('SampleStatus <',3);
        $builder->orderby('SampleId', 'DESC'); 
        $query = $builder->get()->getResult();  
        foreach($query as $row){ 
            if($row->SampleGrandTotal > 0){
                $builder = $this->db->table("payment");
                $builder->select('sum(PaymentTotal) as total');  
                $builder->where('PaymentDoc',"1");
                $builder->where('PaymentRef',$row->SampleId);
                $builder->where('PaymentRefType',"Sample");
                $builder->orderby('PaymentId', 'ASC'); 
                $payment = $builder->get()->getRow()->total; 
                if($payment < $row->SampleGrandTotal){
                    $alert[] = array(
                        "type"=>"Payment",
                        "message"=>"pembayaran ". $row->SampleCode ." belum dibuat"
                    );
                } 
            }
            
            if($row->SampleDelivery > 0){
                $builder = $this->db->table("delivery");
                $builder->select('*');   
                $builder->where("DeliveryRef",$row->SampleId);
                $builder->where("DeliveryRefType","Sample");
                $builder->orderby('DeliveryId', 'ASC'); 
                $delivery = $builder->countAllResults();
                if($delivery == 0){
                    $alert[] = array(
                        "type"=>"Pengiriman",
                        "message"=>"Pengiriman ".$row->SampleCode." belum dibuat"
                    );
                }  
            }
            if($row->SampleStatus <2){ 
                $alert[] = array(
                    "type"=>"teruskan",
                    "message"=>"dokumen ". $row->SampleCode ." belum diteruskan"
                );
            }
        }
        return $alert;
    }

    public function data_project_sample_count($project_id){ 
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('ProjectId',$project_id); 
        $builder->where('SampleStatus <',3);
        $builder->orderby('SampleId', 'DESC'); 
        return  $builder->countAllResults();
    }

    public function get_data_sample($id){
        $builder = $this->db->table($this->table); 
        $builder->select("*, CASE 
        WHEN SampleRefType = '-' THEN 'No data Selected'
        WHEN SampleRefType = 'Survey' THEN (select SurveyCode from survey where SurveyId = SampleRef)
        WHEN SampleRefType = 'Penawaran' THEN (select SphCode from penawaran where SphId = SampleRef)
        END AS 'SampleRefCode'"); 
        $builder->join("project","project.ProjectId = sample.ProjectId","left");
        $builder->join("customer","project.CustomerId = customer.CustomerId","left");
        $builder->join("template_footer","TemplateId = template_footer.TemplateFooterId","left");
        $builder->where('SampleId',$id);
        $builder->limit(1);
        return $builder->get()->getRow();  
    }
    public function get_data_sample_ref($id){

    }

    public function get_data_sample_detail($id){
        $builder = $this->db->table("sample_detail");
        $builder->where('SampleDetailRef',$id); 
        return $builder->get()->getResult();  
    }  

    public function update_data_sample($data,$id){ 
        $header = $data["header"]; 

        $builder = $this->db->table($this->table); 
        $builder->set('SampleDate', $header["SampleDate"]);   
        $builder->set('SampleRef', $header["SampleRef"]);   
        $builder->set('SampleRefType', $header["SampleRefType"]);   
        $builder->set('SampleAdmin', $header["SampleAdmin"]);  
        $builder->set('SampleCustName', $header["SampleCustName"]);
        $builder->set('SampleCustTelp', $header["SampleCustTelp"]);
        $builder->set('SampleAddress', $header["SampleAddress"]); 
        $builder->set('SampleDeliveryTotal', $header["SampleDeliveryTotal"]); 
        $builder->set('SampleDelivery', $header["SampleDelivery"]);  
        $builder->set('TemplateId', $header["TemplateId"]); 
        $builder->set('SampleSubTotal', $header["SampleSubTotal"]); 
        $builder->set('SampleDiscItemTotal', $header["SampleDiscItemTotal"]); 
        $builder->set('SampleDiscTotal', $header["SampleDiscTotal"]); 
        $builder->set('SampleGrandTotal', $header["SampleGrandTotal"]);  
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $id); 
        $builder->update(); 

        $builder = $this->db->table("sample_detail");
        $builder->where('SampleDetailRef',$id);
        $builder->delete(); 

        //update status Survey
        if( $header["SampleRefType"] == "Survey") $this->update_data_survey_status($header["SampleRef"]); 

         //update status Penawaran
         if( $header["SampleRefType"] == "Penawaran"){ 
            $builder = $this->db->table("penawaran"); 
            $builder->set('SphStatus', 1); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SphId', $header["SampleRef"]); 
            $builder->update(); 
        }  
        
        //update status Sample
        $this->update_data_sample_status($id);
        // ADD DETAIL PRODUK 
        foreach($data["detail"] as $row){ 
            $row["SampleDetailRef"] = $id;
            $row["SampleDetailVarian"] = (isset($row["SampleDetailVarian"]) ? json_encode($row["SampleDetailVarian"]) : "[]");  
            $builder = $this->db->table("sample_detail");
            $builder->insert($row); 
        } 

    } 

    public function update_data_sample_delivery($data,$id){  
        $builder = $this->db->table($this->table);  
        $builder->set('SampleDelivery', $data["status"]);   
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $id); 
        $builder->update();   

        //update status Sample
        $this->update_data_sample_status($id); 
    } 

    public function update_data_sample_status($id){ 
        $builder = $this->db->table($this->table);  
        $builder->where('SampleId',$id);
        $result = $builder->get()->getRow(); 
 
        // MENGAMBIL DATA DITERUSKAN
        $sampledirect = 0;
        $builder = $this->db->table("penawaran");
        $builder->select('*');
        $builder->where('SphRef',$result->SampleId); 
        $builder->where('SphRefType',"Sample"); 
        $builder->where('SphStatus <',"2"); 
        $builder->orderby('SphId', 'DESC'); 
        $queryref = $builder->get()->getRow();  
        if($queryref){ 
            $sampledirect = 1;
        }else{
            $builder = $this->db->table("invoice");
            $builder->select('*');
            $builder->where('InvRef',$result->SampleId); 
            $builder->where('InvRefType',"Sample");  
            $builder->orderby('InvId', 'DESC'); 
            $queryref = $builder->get()->getRow();   
            if($queryref){ 
                $sampledirect = 1; 
            }
        }

        //status payment
        $paymentstatus = 1;
        if($result->SampleGrandTotal > 0){
            $builder = $this->db->table("payment");  
            $builder->where('PaymentRef',$id);
            $builder->where('PaymentRefType','Sample');
            $results = $builder->get()->getResult(); 
            $hasil = array_sum(array_column($results, 'PaymentTotal')); 
            if($result->SampleGrandTotal > $hasil ){
                $paymentstatus = 0;
            }
        } 

        //status delivery
        $deliverystatus = 1; 
        if($result->SampleDelivery > 0){
            $builder = $this->db->table("delivery"); 
            $builder->join('delivery_detail',"DeliveryDetailRef=DeliveryId","left"); 
            $builder->where('SampleId',$id); 
            $results = $builder->get()->getResult(); 
            $hasildelivery = array_sum(array_column($results, 'DeliveryDetailQty')); 
    
            $builder = $this->db->table("sample_detail");  
            $builder->join('sample',"SampleDetailRef=SampleId","left"); 
            $builder->where('SampleId',$id);
            $results = $builder->get()->getResult(); 
            $hasilsample = array_sum(array_column($results, 'SampleDetailQty')); 

            if($hasilsample < $hasildelivery ){
                $deliverystatus = 0;
            } 
        } 
        
        if(($paymentstatus == 1 && $deliverystatus == 1 && $sampledirect == 1 )){
            $builder = $this->db->table($this->table); 
            $builder->set('SampleStatus', 2); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SampleId', $id); 
            $builder->update();  
        } else if(($paymentstatus == 1 || $deliverystatus == 1 || $sampledirect == 1 )){
            $builder = $this->db->table($this->table); 
            $builder->set('SampleStatus', 1); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SampleId', $id); 
            $builder->update();   
        }else{
            $builder = $this->db->table($this->table); 
            $builder->set('SampleStatus', 0); 
            $builder->set('updated_user', user()->id); 
            $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
            $builder->where('SampleId', $id); 
            $builder->update();  
        }  

        return $paymentstatus. " | ".$deliverystatus. " | ".$sampledirect; 
    }

    public function delete_data_sample($id){   
        $builder = $this->db->table($this->table); 
        $builder->set('SampleStatus', 2);    
        $builder->set('updated_user', user()->id); 
        $builder->set('updated_at',new RawSql('CURRENT_TIMESTAMP()')); 
        $builder->where('SampleId', $id); 
        $builder->update();   

        return JSON_ENCODE(array("status"=>true));
    }  
    
    public function get_list_ref_sample($refid,$search = null){
        if($search){
            $querywhere  = "and (
                code like '%".$search."%' or 
                CustomerTelp like '%".$search."%' or 
                CustomerName like '%".$search."%' or 
                CustomerAddress like '%".$search."%' 
            ) ";
        }else{
            $querywhere = "";
        }
        $builder = $this->db->query('SELECT * FROM 
        (
            SELECT 
                SphId refid, 
                SphCode as code,
                ProjectId ref,
                SphDate date,
                "Penawaran" AS type,
                SphCustName as CustomerName,
                SphCustTelp as CustomerTelp,
                SphAddress as CustomerAddress
                FROM penawaran where SphStatus < 1 
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
                FROM survey where SurveyStatus < 2
        ) AS ref_join
        LEFT JOIN project ON project.ProjectId = ref_join.ref 
        WHERE ref_join.ref = '.$refid.' 
        '. $querywhere.'
        ORDER BY ref_join.date asc'); 
        return $builder->getResultArray();  
    } 


}