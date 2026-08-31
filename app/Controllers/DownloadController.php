<?php

namespace App\Controllers;  

class DownloadController extends BaseController
{   
    function survey_finish(){
        if (isset($_GET['file'])) {
            $filename = $_GET['file'];
        
            if (file_exists(urldecode($filename))) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filename));
        
                readfile(urldecode($filename));
                exit;
            } else {
                echo "File tidak ditemukan!";
            }
        }
    }
}