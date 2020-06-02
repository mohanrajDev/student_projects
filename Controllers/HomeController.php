<?php 

namespace App\Controller;

use App\Controller as BaseController;

class HomeController extends BaseController {

    /**
     * Home Page
     */
    public function index()
    {
        $this->view('home');
    }
}