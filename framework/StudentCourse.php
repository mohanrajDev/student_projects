<?php

namespace App;

use App\Controller;
use Exception;

class StudentCourse {

    public $url;
    public $controller = 'HomeController';
    public $action = 'index';
    public $params = [];

    public function __construct()
    {
        if (isset($_GET['path'])) {
            $url = $_GET['path'];
            $url = rtrim($_GET['path']);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->url = $url;
         }
    }

    public function run()
    {        
        $url =  $this->url;
        if (!empty($url)) {  
            $controllerName =  ucfirst($url[0]) . 'Controller'; 
            if (file_exists('Controllers/'.$controllerName.'.php')) {
               $this->controller = $controllerName;
               unset($url[0]);
            } else {
                throw new Exception("$controllerName -> controller not found");
            }
        }

        $controllerName = "\\App\\Controller\\$this->controller";
        $this->controller = new $controllerName();

        if(isset($url[1]) && !empty($url[1])) {
            if (method_exists ( $this->controller , $url[1])) {
                $this->action = $url[1];
                unset($url[1]);
            } else {
                throw new Exception("$url[1] -> action not found");
            }
        } 

        if(isset($url)) {
            $this->params = $url;
        } else {
            $this->params = [];
        }

        call_user_func_array([$this->controller, $this->action], $this->params);

    }
}