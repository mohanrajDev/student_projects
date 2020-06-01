<?php 

define('DS', DIRECTORY_SEPARATOR);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($className) {

    $className = explode('\\', $className);
    $className = end($className);

    if (file_exists('framework/' . $className . '.php')) { 
        require_once 'framework/' . $className . '.php'; 
    }
    else if (file_exists('Controllers/' . $className . '.php')) { 
        require_once 'Controllers/' . $className . '.php'; 
    }
    else if (file_exists('Models/' . $className . '.php')) { 
        require_once 'Models/' . $className . '.php'; 
    }
    else if (file_exists($className . '.php')) { 
        require_once $className . '.php'; 
    }
});

use App\StudentCourse;

try {
   $app = new StudentCourse();
   $app->run();
} catch(Exception $e) {
    echo $e->getMessage();
}
?>