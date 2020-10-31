<?php

namespace App\Controllers;

class Beranda extends BaseController {
    public function index()
    {
        echo view('header_v');
        echo view('beranda_v');
        echo view('footer_v');

        // return view('beranda_v');
    }
}