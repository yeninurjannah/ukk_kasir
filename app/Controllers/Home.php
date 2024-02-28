<?php

namespace App\Controllers;

class Home extends BaseController
{
    // public function index(): string
    // {
    //     return view('layout/tamplate');
    // }

    public function index()
    {
        $data = [
            'akses' => session()->get('level')
        ];
        return view('layout/tamplate', $data);
    }

    public function halamanlogin()
    {
        return view('layout/login');
    }
}
