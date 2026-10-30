<?php

namespace App\Controllers;

use App\Libraries\RagService;
use Config\Services;

/**
 * POST /api/agentai/ask   body JSON: {"question": "...", "page": "/admin/sales/invoice"}
 * Respons: {"answer": "...", "answered": true, "sources": [{"title": "...", "heading": "..."}]}
 */
class AiagentController extends BaseController
{
    public function ask()
    {
        helper('auth');

        try {
            $json = $this->request->getJSON(true);
        } catch (\Throwable $e) {
            $json = null;
        }
        $json = is_array($json) ? $json : [];

        $question = trim((string) ($json['question'] ?? $this->request->getPost('question') ?? ''));
        $page     = substr(trim((string) ($json['page'] ?? $this->request->getPost('page') ?? '')), 0, 200);

        if ($question === '' || mb_strlen($question) > 500) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Pertanyaan wajib diisi (maksimal 500 karakter).',
            ]);
        }

        // GPU hanya satu: batasi 10 pertanyaan per menit per user agar tidak menumpuk.
        $throttler = Services::throttler();
        if ($throttler->check('ai_' . (user_id() ?? 0), 10, MINUTE) === false) {
            return $this->response->setStatusCode(429)->setJSON([
                'error' => 'Terlalu banyak pertanyaan. Coba lagi sebentar lagi.',
            ]);
        }

        try {
            $result = (new RagService())->answer($question, $page, user_id() ? (int) user_id() : null);

            return $this->response->setJSON($result);
        } catch (\Throwable $e) {
            log_message('error', 'AI Asisten: ' . $e->getMessage());

            return $this->response->setStatusCode(503)->setJSON([
                'error' => 'Asisten AI sedang tidak tersedia. Silakan coba lagi nanti.',
            ]);
        }
    }
}
