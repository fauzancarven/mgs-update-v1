<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\master\UserModel;
use App\Models\ProjectModel;
use App\Models\master\StoreModel;
use App\Models\DeliveryModel;
use App\Models\ProjectcategoryModel;
use App\Models\master\ProdukModel;
use App\Models\master\produk\ProdukvarianModel;
use App\Models\master\produk\ProdukvarianvalueModel;
use App\Models\master\VendorModel; 
use App\Models\master\produk\ProdukcategoryModel;
use App\Models\SphModel;
use App\Models\InvoiceModel; 
use App\Models\PembelianModel; 


use \App\Models\AuthgroupModel;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User; 

use Config\Services; 

use App\Libraries\Nextcloud;
class AiagentController extends BaseController
{

    public function __construct()
    {
        $this->model = new UserModel(); 
        helper(['form', 'url', 'akuntansi']);
        $this->authgroup = new AuthgroupModel();
        $this->session = \Config\Services::session();
        $this->config = config('Auth');
        $this->auth   = service('authentication');
    }

    public function ask()
    { 
        $client = \Config\Services::curlrequest();
        
        // Pertanyaan dari user (misal dari form input)
        $userPrompt = "Bagaimana cara mengisi form data karyawan jika dia adalah pekerja lepas?";

        // Payload untuk Ollama
        $payload = [
            'model'  => 'llama3.2:3b', // Pastikan model ini sudah di-pull di Ollama
            'prompt' => $userPrompt,
            'stream' => false // Set false agar langsung menerima jawaban penuh, bukan per kata
        ];

        try {
            $response = $client->post('http://localhost:11434/api/generate', [
                'json' => $payload,
                'timeout' => 60 // Beri waktu toleransi jika model loading
            ]);

            $result = json_decode($response->getBody());
            
            // Output dari AI
            echo $result->response;

        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}