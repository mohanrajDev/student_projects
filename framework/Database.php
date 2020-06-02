<?php

namespace App;

use PDO;

/**
 * PDO Connection
 */
class Database {

    protected static $connection;

    public function __construct(){
    
    }

     /**
     * Creating Instance
     */
	public static function getConnection() {

		if(empty(self::$connection)) {

			$db_info = array(
				"db_host" => "localhost",
				"db_port" => "3306",
				"db_user" => "kaveri_groups",
				"db_pass" => "Q0ru2@123",
				"db_name" => "kaveri_api",
				"db_charset" => "UTF-8");

			try {
				self::$connection = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
				self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);  
				self::$connection->query('SET NAMES utf8');
				self::$connection->query('SET CHARACTER SET utf8');

			} catch(PDOException $error) {
				echo $error->getMessage();
			}

		}

		return self::$connection;
	}
    
}