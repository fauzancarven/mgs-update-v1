<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data["view"] = $this->response->setBody(view('website/home.php'));
        return view('website/home',$data);
    }
}
