<?php 


namespace App\Models;


use PDO;


abstract class Connection 
{
    private $pdo = null;

    public function getConn() 
    {
        return $this->connection();
    }

    public function attemp() 
    {
        try {
            $this->connection();

        } catch(Exception $error) {
          throw new Exception($error->getMessage());
        }
    }

    private function connection() 
    {
        $options = array(
    	    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        );
        
        if ($this->pdo === null) {
            $this->pdo = new PDO("{$_ENV['DRIVER']}:host={$_ENV['HOST']};dbname={$_ENV['DATABASE']}", 
            $_ENV['USER'], $_ENV['PASS'], $options);
        }

        return $this->pdo; 
    } 
}