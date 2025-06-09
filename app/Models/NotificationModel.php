<?php

namespace App\Models; 

use CodeIgniter\Model; 
class NotificationModel extends Model{
    protected $sender = "089676143063"; 

    function send_wa($message){
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://wa.mahieraglobalsolution.com/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'sender='.$this->sender.'&number=0895352992663&message='.urlencode($message),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        )); 
        $response = curl_exec($curl); 
        curl_close($curl); 
    }
}