<?php 



namespace App\Provider;

use Dotenv;

class ApiProvider 
{   
    public function __construct() 
    {        
        $path =   $_SERVER['DOCUMENT_ROOT'] .'/Feegow/feegow-challenge/';
        $dotenv = Dotenv\Dotenv::createImmutable($path);
        $dotenv->load();

    }

    public function get(string $endPoint) 
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $endPoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            "x-access-token: {$_ENV['TOKEN_ACCESS']}",
            "Content-Type: application/json",
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response; 
    }
}