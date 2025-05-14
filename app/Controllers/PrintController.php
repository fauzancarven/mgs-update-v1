<?php

namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\ProjectModel;
use App\Models\ProdukModel;
use App\Models\HeaderModel;

use Config\Services; 
define("DOMPDF_ENABLE_REMOTE", false);
class PrintController extends BaseController
{
        public function project_survey($id){
                 
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                $options->set('paper', 'A4');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel();
                $modelheader = new HeaderModel();
                $data["survey"] = $models->getDataSurvey($id); 
                $data["staff"] = $models->getDataSurveyStaff($data["survey"]->SurveyStaff); 
                $data["header_footer"] = $modelheader->get_header_a4($data["survey"]->StoreId);  

                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   
                

                $html = view('admin/project/survey/printa4',$data);  
                //return $html;
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'SVY_'.$data["survey"]->SurveyCustName.'_'.$data["survey"]->SurveyDate.'.pdf', [ 'Attachment' => false ]);
        }
	public function project_sph($id)
	{
                $request = Services::request();
                $postData = $request->getGet();

                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                $options->set('paper', 'A4');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel();
                $produk = new ProdukModel();
                $modelheader = new HeaderModel(); 
                $data["sph"] = $models->getdataSPH($id); 
                $arr_detail = $models->getdataDetailSPH($id);
                $detail = array();
                foreach($arr_detail as $row){
                        $detail[] = array(
                                "image" => $produk->getproductimage($row->ProdukId), 
                                "produkid" => $row->ProdukId, 
                                "satuan_id"=> ($row->SphDetailSatuanId == 0 ? "" : $row->SphDetailSatuanId),
                                "satuan_text"=>$row->SphDetailSatuanText,  
                                "price"=>$row->SphDetailPrice,
                                "varian"=>  $row->SphDetailVarian,
                                "total"=> $row->SphDetailTotal,
                                "disc"=> $row->SphDetailDisc,
                                "qty"=> $row->SphDetailQty,
                                "text"=> $row->SphDetailText,
                                "group"=> $row->SphDetailGroup,
                                "type"=> $row->SphDetailType
                        );
                };
                $data["detail"] = $detail; 
                $data["postdata"] = $postData; 
                $data["header_footer"] = $modelheader->get_header_a4($data["sph"]->StoreId);  

                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/sph/print_sph_a4',$data);  
                //return $html;
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'SPH_'.$data["sph"]->CustomerName.'_'.$data["sph"]->SphDate.'.pdf', [ 'Attachment' => false ]);
	}
	public function project_invoice_a4($id)
	{
                $request = Services::request();
                $postData = $request->getGet();
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                $options->set('paper', 'A4');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel();
                $produk = new ProdukModel();
                $modelheader = new HeaderModel(); 
                $data["inv"] = $models->getdataInvoice($id); 
                $arr_detail = $models->getdataDetailInvoice($id);
                $detail = array();
                foreach($arr_detail as $row){
                        $detail[] = array(
                                "image" => $produk->getproductimage($row->ProdukId), 
                                "produkid" => $row->ProdukId, 
                                "satuan_id"=> ($row->InvDetailSatuanId == 0 ? "" : $row->InvDetailSatuanId),
                                "satuan_text"=>$row->InvDetailSatuanText,  
                                "price"=>$row->InvDetailPrice,
                                "varian"=>  $row->InvDetailVarian,
                                "total"=> $row->InvDetailTotal,
                                "disc"=> $row->InvDetailDisc,
                                "qty"=> $row->InvDetailQty,
                                "text"=> $row->InvDetailText,
                                "group"=> $row->InvDetailGroup,
                                "type"=> $row->InvDetailType
                        );
                };
                $data["detail"] = $detail; 
                $data["postdata"] = $postData; 
                $data["header_footer"] = $modelheader->get_header_a4($data["inv"]->StoreId);  
                if(isset($postData["custom"])){ 
                        $data["header_footer"]["detail"] = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0895-3529-92663<br>MAHIERA GLOBAL SOLUTION';
                }
                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/invoice/print_invoice_a4',$data); 
                //return $html;
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'INV_'.$data["inv"]->CustomerName.'_'.$data["inv"]->InvDate.'.pdf', [ 'Attachment' => false ]);
	}
	public function project_invoice_a5($id)
	{
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                
                $options->set('paper', 'a5');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel(); 
                $modelheader = new HeaderModel(); 
                $data["project"] = $models->getdataInvoice($id); 
                $data["detail"] = $models->getdataDetailInvoice($id); 
                $data["header_footer"] = $modelheader->get_header_a5($data["project"]->StoreId);  
                
                $dompdf = new Dompdf($options);  
                
                //$dompdf->set_paper(array(0,0,419.53, 595.28), 'landscape');
                $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/invoice/print_invoice_a5',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'INV_'.$data["project"]->CustomerName.'_'.$data["project"]->InvDate.'.pdf', [ 'Attachment' => false ]);
	}

        public function project_payment_a5($id)
	{
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                
                $options->set('paper', 'a5');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel();   
                $modelheader = new HeaderModel(); 
                $data["payment"] = $models->getdataPayment($id); 
                $data["payments"] = $models->getdataPaymentByInvoice($data["payment"]->InvId); 
                $data["project"] = $models->getdataInvoice($data["payment"]->InvId); 
                $data["detail"] = $models->getdataDetailInvoice($data["payment"]->InvId);  
                $data["header_footer"] = $modelheader->get_header_a5($data["project"]->StoreId);  
                
                $dompdf = new Dompdf($options);  
                
                //$dompdf->set_paper(array(0,0,419.53, 595.28), 'landscape');
                $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/payment/print_payment_a5',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'PAY_INV_'.$data["project"]->CustomerName.'_'.$data["payment"]->PaymentDate.'.pdf', [ 'Attachment' => false ]);

                
	}
	public function project_payment_a4($id)
	{
                $request = Services::request();
                $postData = $request->getGet();
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                $options->set('paper', 'A4');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel();
                $produk = new ProdukModel();
                $modelheader = new HeaderModel(); 
                $data["payment"] = $models->getdataPayment($id); 
                $data["payments"] = $models->getdataPaymentByInvoice($data["payment"]->InvId); 
                $data["inv"] = $models->getdataInvoice($data["payment"]->InvId); 
                $arr_detail = $models->getdataDetailInvoice($data["payment"]->InvId);
                $detail = array();
                foreach($arr_detail as $row){
                        $detail[] = array(
                                "image" => $produk->getproductimage($row->ProdukId), 
                                "produkid" => $row->ProdukId, 
                                "satuan_id"=> ($row->InvDetailSatuanId == 0 ? "" : $row->InvDetailSatuanId),
                                "satuan_text"=>$row->InvDetailSatuanText,  
                                "price"=>$row->InvDetailPrice,
                                "varian"=>  $row->InvDetailVarian,
                                "total"=> $row->InvDetailTotal,
                                "disc"=> $row->InvDetailDisc,
                                "qty"=> $row->InvDetailQty,
                                "text"=> $row->InvDetailText,
                                "group"=> $row->InvDetailGroup,
                                "type"=> $row->InvDetailType
                        );
                };
                $data["detail"] = $detail; 
                $data["postdata"] = $postData; 
                $data["header_footer"] = $modelheader->get_header_a4($data["inv"]->StoreId);  
                if(isset($postData["custom"])){ 
                        $data["header_footer"]["detail"] = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0895-3529-92663<br>MAHIERA GLOBAL SOLUTION';
                }
                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/payment/print_payment_a4',$data); 
                //return $html;
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'PAY_'.$data["inv"]->CustomerName.'_'.$data["inv"]->InvDate.'.pdf', [ 'Attachment' => false ]);
	}
        public function project_proforma_a5($id)
	{
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                
                $options->set('paper', 'a5');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel();   
                $modelheader = new HeaderModel();  
                $data["payment"] = $models->getdataProforma($id); 
                $data["payments"] = $models->getdataProformaByRef($data["payment"]->InvId); 
                $data["project"] = $models->getdataInvoice($data["payment"]->InvId); 
                $data["detail"] = $models->getdataDetailInvoice($data["payment"]->InvId);  
                $data["header_footer"] = $modelheader->get_header_a5($data["project"]->StoreId);  
                $dompdf = new Dompdf($options);  
                
                //$dompdf->set_paper(array(0,0,419.53, 595.28), 'landscape');
                $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/invoice/print_proforma_a5',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'PRO_INV_'.$data["project"]->CustomerName.'_'.$data["payment"]->PaymentDate.'.pdf', [ 'Attachment' => false ]);
	}
        public function project_delivery_a5($id)
	{
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                
                $options->set('paper', 'a5');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel();   
                $modelheader = new HeaderModel();  
                $data["delivery"] = $models->getdataDelivery($id);   
                $data["detail"] = $models->getdataDetailDelivery($id);  
                $data["header_footer"] = $modelheader->get_header_a5($data["delivery"]->StoreId);  
                
                $dompdf = new Dompdf($options);  
                
                //$dompdf->set_paper(array(0,0,419.53, 595.28), 'landscape');
                $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/delivery/print_delivery_a5',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'DEL_INV_'.$data["delivery"]->CustomerName.'_'.$data["delivery"]->DeliveryDate.'.pdf', [ 'Attachment' => false ]);
	}
 
	public function project_po_a5($id)
	{
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                
                $options->set('paper', 'a5');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel();  
                $data["po"] = $models->getdataPO($id);  
                $data["detail"] = $models->getdataDetailPO($id); 
                
                $dompdf = new Dompdf($options);  
                
                //$dompdf->set_paper(array(0,0,419.53, 595.28), 'landscape');
                $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/po/print_po_a5',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'PO_'.$data["po"]->CustomerName.'_'.$data["po"]->PODate.'.pdf', [ 'Attachment' => false ]);
	} 
        
	public function project_po($id)
	{
                $request = Services::request();
                $postData = $request->getGet();
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true); 
                 
                        $options->set('paper', "A4");  
                $options->set('orientation', 'potrait'); 
                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   

                $models = new ProjectModel();
                $produk = new ProdukModel();
                $modelheader = new HeaderModel(); 
                $data["po"] = $models->getdataPO($id); 
                $arr_detail = $models->getdataDetailPO($id);
                $detail = array();
                foreach($arr_detail as $row){
                        $detail[] = array(
                                "image" => $produk->getproductimage($row->ProdukId), 
                                "produkid" => $row->ProdukId, 
                                "satuan_id"=> ($row->PODetailSatuanId == 0 ? "" : $row->PODetailSatuanId),
                                "satuan_text"=>$row->PODetailSatuanText,  
                                "price"=>$row->PODetailPrice,
                                "varian"=>  $row->PODetailVarian,
                                "total"=> $row->PODetailTotal,
                                "disc"=>0,
                                "qty"=> $row->PODetailQty,
                                "text"=> $row->PODetailText,
                                "group"=> $row->PODetailGroup,
                                "type"=> "product"
                        );
                };
                $data["detail"] = $detail; 
                $data["postdata"] = $postData; 
                $data["header_footer"] = $modelheader->get_header_a4($data["po"]->StoreId);  
                if(isset($postData["custom"])){ 
                        $data["header_footer"]["detail"] = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0895-3529-92663<br>MAHIERA GLOBAL SOLUTION';
                }
                if($postData["kertas"] =="A4"){
                        $html = view('admin/project/po/print_po_a4',$data);  
                }else{ 
                        $dompdf->set_paper(array(0,0,420, 620),  'landscape');
                        $html = view('admin/project/po/print_po_a5',$data); 
                        
                }
                //return $html;
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'INV_'.$data["po"]->CustomerName.'_'.$data["po"]->PODate.'.pdf', [ 'Attachment' => false ]);
	}
}