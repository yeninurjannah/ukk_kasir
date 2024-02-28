<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{

    
    public function dataLaporan()
    
    {
        $data = [
            'listLaporan' =>$this->produk->getStok()

        ];
        return view('laporan/data-laporan', $data);
        //
    }
}
