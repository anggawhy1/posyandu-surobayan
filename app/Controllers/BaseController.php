<?php

// BaseController.php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;  // Deklarasikan properti request
    protected $session;  // Deklarasikan properti session

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Jangan ubah baris ini
        parent::initController($request, $response, $logger);

        // Menginisialisasi session dan request service
        $this->session = service('session');
        $this->request = \Config\Services::request();  // Menginisialisasi request service
    }
}
