<?php

namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;

define("DOMPDF_ENABLE_REMOTE", false);
class PrintController extends BaseController
{
	public function project_sph($id)
	{
		// $mpdf = new \Mpdf\Mpdf([
        //     'allowRemote' => true, 
        //     'allowHTTPS' => true,
        //     'margin_left' => 5,
        //     'margin_right' => 5,
        //     'margin_top' => 5,
        //     'margin_bottom' => 5,
        //     'margin_header' => 2,
        //     'margin_footer' => 2
        // ]);  

        // $gambar = file_get_contents('assets/images/logo/logo-brj.png');
        // $data["image"] = "data:image/png;base64," . base64_encode($gambar);

		// $html = view('admin/project/print',$data);
        // // $mpdf->SetHTMLHeader('
        // // <div style="text-align: right; font-weight: bold;">
        // //     My document

        // // </div>');
		// $mpdf->WriteHTML($html);
		// $this->response->setHeader('Content-Type', 'application/pdf');
		// $mpdf->Output('print.pdf','I'); // opens in browser
		// //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name 



        $options = new Options(); 
        $options->set('isHtml5ParserEnabled', true);
        $options->set('enable_remote', true);
        $options->set('paper', 'A4');
        $options->set('orientation', 'potrait');

        $dompdf = new Dompdf($options);  
        $dompdf->getOptions()->setChroot('C:\\xampp8.2\\htdocs\\mahiera\\assets');  
        // $gambar = file_get_contents('assets/images/logo/brand/brj.png');
        // $data["image"] = "data:image/png;base64," . base64_encode($gambar);
        $html = view('admin/project/print'); 
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('resume.pdf', [ 'Attachment' => false ]);
	}
    public function project_sph_html($id)
	{
		 
        $gambar = file_get_contents('assets/images/logo/brand/brj.png');
        $data["image"] = "data:image/png;base64," . base64_encode($gambar);

        return view('admin/project/print',$data); 
	}
}