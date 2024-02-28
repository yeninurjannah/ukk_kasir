<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface; 

use App\Models\Muser;
use App\Models\Mkategori;
use App\Models\Msatuan;
use App\Models\Mproduk;
use App\Models\Mpenjualan;
use App\Models\MDetail;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $user;
    protected $kategori;
    protected $satuan;
    protected $produk;
    protected $penjualan;
    protected $detail;
   

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->user = New Muser;
        $this->kategori = New Mkategori;
        $this->satuan = New Msatuan;
        $this->produk = New Mproduk;
        $this->penjualan = New Mpenjualan;
        $this->detail = New Mdetail;

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}
