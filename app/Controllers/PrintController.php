<?php

namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\ProjectModel;
use App\Models\HeaderModel;

define("DOMPDF_ENABLE_REMOTE", false);
class PrintController extends BaseController
{
	public function project_sph($id)
	{
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                $options->set('paper', 'A4');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel(); 
                $modelheader = new HeaderModel(); 
                $data["sph"] = $models->getdataSPH($id); 
                $data["detail"] = $models->getdataDetailSPH($id); 
                $data["header_footer"] = $modelheader->get_header_a4($data["sph"]->StoreId);  
                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/sph/print_sph_a4',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'SPH_'.$data["sph"]->CustomerName.'_'.$data["sph"]->SphDate.'.pdf', [ 'Attachment' => false ]);
	}
	public function project_invoice_a4($id)
	{
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                $options->set('paper', 'A4');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel(); 
                $modelheader = new HeaderModel(); 
                $data["project"] = $models->getdataInvoice($id); 
                $data["detail"] = $models->getdataDetailInvoice($id); 
                $data["header_footer"] = $modelheader->get_header_a4($data["project"]->StoreId);  
                
                $dompdf = new Dompdf($options);  
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/invoice/print_invoice_a4',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'INV_'.$data["project"]->CustomerName.'_'.$data["project"]->InvDate.'.pdf', [ 'Attachment' => false ]);
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
                $data["payments"] = $models->getdataPaymentByRef($data["payment"]->PaymentRef); 
                $data["project"] = $models->getdataInvoice($data["payment"]->PaymentRef); 
                $data["detail"] = $models->getdataDetailInvoice($data["payment"]->PaymentRef);  
                $data["header_footer"] = $modelheader->get_header_a5($data["project"]->StoreId);  
                
                $dompdf = new Dompdf($options);  
                
                //$dompdf->set_paper(array(0,0,419.53, 595.28), 'landscape');
                $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/invoice/print_payment_a5',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'PAY_INV_'.$data["project"]->CustomerName.'_'.$data["payment"]->PaymentDate.'.pdf', [ 'Attachment' => false ]);

                
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
                $data["payments"] = $models->getdataProformaByRef($data["payment"]->PaymentRef); 
                $data["project"] = $models->getdataInvoice($data["payment"]->PaymentRef); 
                $data["detail"] = $models->getdataDetailInvoice($data["payment"]->PaymentRef);  
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
                $data["delivery"] = $models->getdataDelivery($id);   
                $data["project"] = $models->getdataInvoice($data["delivery"]->ref); 
                $data["detail"] = $models->getdataDetailDelivery($data["delivery"]->id); 
                
                $dompdf = new Dompdf($options);  
                
                //$dompdf->set_paper(array(0,0,419.53, 595.28), 'landscape');
                $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/print_delivery_a5',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'DEL_INV_'.$data["project"]->name.'_'.$data["project"]->date.'.pdf', [ 'Attachment' => false ]);
	}


	public function project_po_a5($id)
	{
                $options = new Options(); 
                $options->set('isHtml5ParserEnabled', true);
                $options->set('enable_remote', true);
                
                $options->set('paper', 'a5');
                $options->set('orientation', 'potrait');

                $models = new ProjectModel();  
                $data["project"] = $models->getdataPO($id); 
                $data["detail"] = $models->getdataDetailPO($id); 
                
                $dompdf = new Dompdf($options);  
                
                //$dompdf->set_paper(array(0,0,419.53, 595.28), 'landscape');
                $dompdf->set_paper(array(0,0,420, 620), 'landscape');
                $dompdf->getOptions()->setChroot('assets');   

                $html = view('admin/project/print_po_a5',$data); 
                $dompdf->loadHtml($html);
                $dompdf->render();
                $dompdf->stream( 'PO_'.$data["project"]->name.'_'.$data["project"]->date.'.pdf', [ 'Attachment' => false ]);
	}
        public function project_sph_html($id)
        {
                        
                $gambar = file_get_contents('assets/images/logo/brand/brj.png');
                $data["image"] = "data:image/png;base64," . base64_encode($gambar);

                return view('admin/project/print',$data); 
        }
        
}