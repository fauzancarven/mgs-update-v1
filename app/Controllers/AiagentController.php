<?php

namespace App\Controllers;

 
use App\Controllers\BaseController; 
use App\Models\master\UserModel; 

use \App\Models\AuthgroupModel; 
 
class AiagentController extends BaseController
{

    public function __construct()
    { 
        helper(['form', 'url', 'akuntansi']); 
    }

    public function ask()
    { 
        $request = \Config\Services::request();
        $jsonInfo = $request->getJSON();
        $userPrompt = $jsonInfo->prompt ?? '';

        $client = \Config\Services::curlrequest(); 

        // Payload untuk Ollama
        $payload = [
            'model'  => 'qwen2.5:3b', // Pastikan model ini sudah di-pull di Ollama
            'prompt' => $userPrompt,
            'stream' => false // Set false agar langsung menerima jawaban penuh, bukan per kata
        ];

        try {
            $response = $client->post('http://localhost:11434/api/generate', [
                'json' => $payload,
                'timeout' => 60 // Beri waktu toleransi jika model loading
            ]);

            $result = json_decode($response->getBody());
            
            return $this->response->setJSON([
                'status' => 'success',
                'response' => $result->response
            ]);

        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}