<?php



namespace App\DotEnv;

require_once "../vendor/autoload.php";

use Dotenv;

class Env 
{
    public function __construct() 
    {
        $path =   $_SERVER['DOCUMENT_ROOT'] .'/Feegow/feegow-challenge/';
        $dotenv = Dotenv\Dotenv::createImmutable($path);
        $dotenv->load();
    }
}