<?php
namespace App;

use Exception;

/***
 * Base Controller
 * Loading view
 */

class Controller {
    public function view($viewName, $data = [])
    {
        if (file_exists('Views/' . $viewName . '.php')) { 
            require_once 'Views/' . $viewName . '.php'; 
        } else {
            throw new Exception("$viewName -> Not found");
        }
    }
}