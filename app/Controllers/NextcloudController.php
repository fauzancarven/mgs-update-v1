<?php

namespace App\Controllers;

use App\Libraries\Nextcloud;

class NextcloudController extends BaseController
{
    public function index()
    {
        $nextcloud = new Nextcloud();
        $files = $nextcloud->getFileList();
        return view('nextcloud/index', ['files' => $files]);
    }

    public function upload()
    {
        $nextcloud = new Nextcloud();
        $file = $this->request->getFile('file');
        $nextcloud->uploadFile($file);
        return redirect()->to('/nextcloud');
    }

    public function download($file)
    {
        $nextcloud = new Nextcloud();
        $content = $nextcloud->downloadFile($file);
        return $this->response->setBody($content)->setContentType('application/octet-stream');
    }

    public function delete($file)
    {
        $nextcloud = new Nextcloud();
        $nextcloud->deleteFile($file);
        return redirect()->to('/nextcloud');
    }
}