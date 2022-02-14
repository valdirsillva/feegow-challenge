<?php 



namespace App\Provider;

use App\DotEnv\Env;

class ApiProvider extends Env
{   
    public function __construct() 
    {        
        parent::__construct();
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