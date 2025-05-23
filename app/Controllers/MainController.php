<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Bata Reguler Jakarta - Home'
        ];
 
        return view('website/home', $data);
    }
}
