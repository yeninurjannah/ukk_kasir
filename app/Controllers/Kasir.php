<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kasir extends BaseController
{
    public function index()
    {
        $data = [
            'akses' => session()->get('level')
        ];
        return view('Kasir/halaman-kasir', $data);
    }
}
