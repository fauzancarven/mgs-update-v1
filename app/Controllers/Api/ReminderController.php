<?php

namespace App\Controllers\Api;

use App\Models\ReminderModel;
use CodeIgniter\RESTful\ResourceController;

class ReminderController extends ResourceController
{
    protected $format = 'json';

    // 1. GET: http://172.20.0
    // Digunakan oleh n8n Cron Job untuk mengecek reminder yang harus dikirim sekarang
    public function index()
    {
        $model = new ReminderModel();
        
        // 🌟 TAMBAHKAN BARIS INI agar PHP menggunakan waktu WIB yang sama dengan database Anda
        date_default_timezone_set('Asia/Jakarta');
        
        $now = date('Y-m-d H:i:s');
        
        $reminders = $model->where('status', 'pending')
                            ->where('reminder_time <=', $now)
                            ->findAll();

        return $this->respond([
            'status' => 200,
            'data'   => $reminders
        ], 200);
    }

    // 2. POST: http://172.20.0
    // Digunakan oleh Custom Tool AI Agent n8n untuk menyimpan jadwal baru
   public function create()
{
    $model = new ReminderModel();
    $json = $this->request->getJSON(true);

    if (empty($json)) {
        $json = [
            'chatId'        => $this->request->getPost('chatId'),
            'sessionId'     => $this->request->getPost('sessionId'), // 🌟 Ambil Session dari n8n
            'message'       => $this->request->getPost('message'),
            'reminder_time' => $this->request->getPost('reminder_time'),
        ];
    }

    $dataInsert = [
        'chat_id'       => $json['chatId'],
        'session_id'    => $json['sessionId'] ?? 'default', // 🌟 Simpan ke kolom database (jika kosong set 'default')
        'message'       => $json['message'],
        'reminder_time' => $json['reminder_time'],
        'status'        => 'pending'
    ];

    if ($model->insert($dataInsert)) {
        return $this->respondCreated(['status' => 201, 'message' => 'Sukses disimpan!']);
    }
    return $this->fail('Gagal menyimpan.', 500);
}

    // 3. PUT/PATCH: http://172.20.0/{id}
    // Opsi tambahan jika n8n ingin mengubah status menjadi 'sent' setelah sukses kirim WA
    public function update($id = null)
    {
        $model = new ReminderModel();
        $json  = $this->request->getJSON(true);
        
        $status = $json['status'] ?? 'sent';

        if ($model->update($id, ['status' => $status])) {
            return $this->respond([
                'status'  => 200,
                'message' => 'Status reminder berhasil diperbarui menjadi ' . $status
            ], 200);
        }

        return $this->fail('Gagal memperbarui status.', 500);
    }
}
