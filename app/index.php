<?php 


require_once "../vendor/autoload.php";
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

use App\Provider\ApiProvider;

$api = new ApiProvider;

if (isset($_GET['id'])) {

   $profissionalId = $_GET['id'] ?? '';
   $endpoint = $_GET['specialties'] ?? '';

   $endpoint = "https://api.feegow.com/v1/api/professional/list";
   
   $data = $api->get($endpoint);

   echo $data;

   die;

  
}
// $endpoint = "https://api.feegow.com/v1/api/professional/list";

$endpoint = "https://api.feegow.com/v1/api/specialties/list";
$data = $api->get($endpoint);

echo $data;



