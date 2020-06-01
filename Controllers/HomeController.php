<?php 

namespace App\Controller;

use App\Controller as BaseController;

class HomeController extends BaseController {

    public function index()
    {
        $this->view('home');
    }
}