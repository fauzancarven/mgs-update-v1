<?php

namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\SurveyModel;
use App\Models\SphModel;
use App\Models\ProjectModel;
use App\Models\PaymentModel;
use App\Models\InvoiceModel;
use App\Models\PembelianModel;
use App\Models\ProdukModel;
use App\Models\HeaderModel;

use Config\Services; 
define("DOMPDF_ENABLE_REMOTE", false);
class PrintController extends BaseController
{
        public function survey($id){
                 
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                $options->set('paper', 'A4');
                $options->set('orientation', 'potrait');

                $modelsurvey = new SurveyModel();
                $modelheader = new HeaderModel();
                $data["survey"] = $modelsurvey->get_data_survey($id); 
                $data["staff"] = $modelsurvey->get_data_survey_staff($data["survey"]->SurveyStaff); 
                $data["header_footer"] = $modelheader->get_header_a4($data["survey"]->StoreId);  

                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   
                

                $html = view('admin/project/survey/printa4',$data);  
                //return $html;
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'SVY_'.$data["survey"]->SurveyCustName.'_'.$data["survey"]->SurveyDate.'.pdf', [ 'Attachment' => false ]);
        }
        
        public function project_survey($id){
                 
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                $options->set('paper', 'A4');
                $options->set('orientation', 'potrait');

                $modelsurvey = new SurveyModel();
                $modelheader = new HeaderModel();
                $data["survey"] = $modelsurvey->get_data_survey($id); 
                $data["staff"] = $modelsurvey->get_data_survey_staff($data["survey"]->SurveyStaff); 
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

                $models = new SphModel();
                $produk = new ProdukModel();
                $modelheader = new HeaderModel(); 
                $data["sph"] = $models->get_data_sph($id); 
                $arr_detail = $models->get_data_sph_detail($id);
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
	public function project_invoice($id)
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
                $data["inv"] = $models->get_data_invoice($id); 
                $arr_detail = $models->get_data_invoice_detail($id);
                $detail = array();
                foreach($arr_detail as $row){ 
                        
                        $detail[] = array(
                                "image" =>  $produk->getproductimagedatavarian($row->ProdukId,$row->InvDetailVarian,false) , 
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
              
                if(isset($postData["custom"])){ 
                        $data["header_footer"]["detail"] = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0895-3529-92663<br>MAHIERA GLOBAL SOLUTION';
                }
                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   
                if($data["postdata"]["kertas"] == "A5"){ 
                        $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                        $data["header_footer"] = $modelheader->get_header_a5($data["inv"]->StoreId);
                        $html = view('admin/project/invoice/print_invoice_a5',$data); 
                }else{ 
                        $data["header_footer"] = $modelheader->get_header_a4($data["inv"]->StoreId);  
                        $html = view('admin/project/invoice/print_invoice_a4',$data); 
                }
                //return $html;
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'INV_'.$data["inv"]->InvCustName.'_'.$data["inv"]->InvDate.'.pdf', [ 'Attachment' => false ]);
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
                $data["project"] = $models->get_data_invoice($id); 
                $data["detail"] = $models->get_data_invoice_detail($id); 
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

                $models = new PaymentModel();   
                $modelsinvoice = new InvoiceModel();   
                $modelheader = new HeaderModel(); 
                $data["payment"] = $models->get_data_payment($id); 
                if($data["payment"]->PaymentRefType=="Invoice"){ 
                        $data["payments"] = $models->get_data_payment_by_invoice($data["payment"]->PaymentRef); 
                        $data["project"] = $modelsinvoice->get_data_invoice($data["payment"]->PaymentRef); 
                        $data["detail"] = $modelsinvoice->get_data_invoice_detail($data["payment"]->PaymentRef); 
                        $data["customer"] = array(
                                "CustomerName" => $data["project"]->InvCustName,
                                "CustomerTelp" => $data["project"]->InvCustTelp,
                                "CustomerAddress" => $data["project"]->InvAddress,
                        ) ;
                }  
                
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
	public function project_payment($id)
	{
                $request = Services::request();
                $postData = $request->getGet();
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                $options->set('paper', 'A4');
                $options->set('orientation', 'potrait');

                $models = new PaymentModel();   
                $modelsinvoice = new InvoiceModel();  
                $produk = new ProdukModel();
                $modelheader = new HeaderModel(); 
                $data["payment"] = $models->get_data_payment($id); 
                if($data["payment"]->PaymentRefType == "Invoice"){
                        $data["payments"] = $models->get_data_payment_by_invoice($data["payment"]->PaymentRef); 

                        $data["inv"] = $modelsinvoice->get_data_invoice($data["payment"]->PaymentRef);
                        $dataref = "";
                        if($data["inv"]->InvImageList !== "[]"){
                                $dataref .= '<div class="page_break"></div><h2 class="text-center" style="margin-bottom:20px;">Lampiran</h2><div style="display:block;padding-top:30px;">';
                                $image = json_decode($data["inv"]->InvImageList);
                                foreach($image as $row){
                                        $dataref .=  "<img src='".$row."' width='130px' style='padding:5px'>";
                                } 
                                $dataref .=  '</div>';
                                // $dataref .=  '<table style="width: 100%;border-collapse: collapse;margin-bottom:10px">
                                //         <tbody>
                                //             <tr> 
                                //                 <td style="width:50%;text-align:center;vertical-align:top;"><img src="'.$data["inv"]->InvKtpImage.'" style="width:100%"></td>
                                //                 <td style="width:50%;text-align:center;vertical-align:top;"><img src="'.$data["inv"]->InvNpwpImage.'" style="width:100%"></td>
                                //             </tr> 
                                //         </tbody>
                                //     </table>'; 
                        }
                        $data["ref"] = array(
                                "SubTotal" =>  $data["inv"]->InvSubTotal,
                                "DiscItemTotal" =>  $data["inv"]->InvDiscItemTotal,
                                "DiscTotal" =>  $data["inv"]->InvDiscTotal,
                                "GrandTotal" =>  $data["inv"]->InvGrandTotal, 
                                "Date"=>  $data["inv"]->InvDate,
                                "CustomerName" => $data["inv"]->InvCustName,
                                "CustomerTelp" => $data["inv"]->InvCustTelp,
                                "CustomerAddress" => $data["inv"]->InvAddress,
                                "optional" => $dataref,
                        ); 
                        
                        $arr_detail = $modelsinvoice->get_data_invoice_detail($data["payment"]->PaymentRef);
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
                }
                
              
                
              
                $data["postdata"] = $postData; 
                if(isset($postData["custom"])){ 
                        $data["header_footer"]["detail"] = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0895-3529-92663<br>MAHIERA GLOBAL SOLUTION';
                }
                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   
 
                //return $html;
                if($data["postdata"]["kertas"] == "A5"){ 
                        $dompdf->set_paper(array(0,0,420, 620), 'landscape'); 
                        $data["header_footer"] = $modelheader->get_header_a5($data["inv"]->StoreId);  
                        $html = view('admin/project/payment/print_payment_a5',$data); 
                }else{ 
                        $data["header_footer"] = $modelheader->get_header_a4($data["inv"]->StoreId);     
                        $html = view('admin/project/payment/print_payment_a4',$data); 
                }
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'PAY_'.$data["ref"]["CustomerName"].'_'.$data["ref"]["Date"].'.pdf', [ 'Attachment' => false ]);
                
	}
        public function project_proforma_a5($id)
	{
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                
                $options->set('paper', 'a5');
                $options->set('orientation', 'potrait');

                $request = Services::request();
                $postData = $request->getGet();
                $data["postdata"] = $postData; 
                $models = new PaymentModel();   
                $modelsinvoice = new InvoiceModel();   
                $modelheader = new HeaderModel();  
                $data["payment"] = $models->get_data_proforma($id); 
                if($data["payment"]->PaymentRefType=="Invoice"){ 
                        $data["payments"] = $models->get_data_payment_by_invoice($data["payment"]->PaymentRef); 
                        $data["project"] = $modelsinvoice->get_data_invoice($data["payment"]->PaymentRef); 
                        $data["detail"] = $modelsinvoice->get_data_invoice_detail($data["payment"]->PaymentRef); 
                        $data["customer"] = array(
                                "CustomerName" => $data["project"]->InvCustName,
                                "CustomerTelp" => $data["project"]->InvCustTelp,
                                "CustomerAddress" => $data["project"]->InvAddress,
                        ) ;
                }  
                $data["payments"] = $models->get_data_proforma_by_ref($data["payment"]->PaymentRef); 
                $data["project"] = $modelsinvoice->get_data_invoice($data["payment"]->PaymentRef); 
                $data["detail"] = $modelsinvoice->get_data_invoice_detail($data["payment"]->PaymentRef);  
                $data["header_footer"] = $modelheader->get_header_a5($data["project"]->StoreId);  
                $dompdf = new Dompdf($options);  
                
                //$dompdf->set_paper(array(0,0,419.53, 595.28), 'landscape');
                $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/payment/print_proforma_a5',$data); 
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
                $data["delivery"] = $models->get_data_delivery($id);   
                $data["detail"] = $models->get_data_delivery_detail($id);  
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
                $data["po"] = $models->get_data_pembelian($id);  
                $data["detail"] = $models->get_data_pembelian_detail($id); 
                
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

                $models = new PembelianModel();
                $produk = new ProdukModel();
                $modelheader = new HeaderModel(); 
                $data["po"] = $models->get_data_pembelian($id); 
                $arr_detail = $models->get_data_pembelian_detail($id);
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
              
                if($postData["kertas"] =="A4"){
                        $data["header_footer"] = $modelheader->get_header_a4($data["po"]->StoreId);
                        if(isset($postData["custom"])){ 
                                $data["header_footer"]["detail"] = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0895-3529-92663<br>MAHIERA GLOBAL SOLUTION';
                        } 
                        $html = view('admin/project/po/print_po_a4',$data);  
                }else{ 
                        
                         $data["header_footer"] = $modelheader->get_header_a5($data["po"]->StoreId); 
                        $dompdf->set_paper(array(0,0,420, 620),  'landscape');
                        $html = view('admin/project/po/print_po_a5',$data); 
                        
                }
                //return $html;
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'INV_'.$data["po"]->POCustName.'_'.$data["po"]->PODate.'.pdf', [ 'Attachment' => false ]);
	}
}