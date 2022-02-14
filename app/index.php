<?php 


require_once "../vendor/autoload.php";
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

use App\Provider\ApiProvider;
use App\Controller\ControllerShendule;



$api = new ApiProvider;

$content = file_get_contents('php://input');
$decoded = json_decode($content, true);

$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';


if ($method === 'POST' AND $decoded['action'] === 'ADD') {
    
    ControllerShendule::add($decoded);
}

if (isset($_GET['id'])) {

   $endpoint = $_GET['specialties'] ?? '';
   $endpoint = "https://api.feegow.com/v1/api/professional/list";
   $data = $api->get($endpoint);
   echo $data;

   die;
}

if (isset($_GET['getlist'])) {
    
   $endpoint = "https://api.feegow.com/v1/api/patient/list-sources";
   $data = $api->get($endpoint);
   echo $data;

   die;

}

$endpoint = "https://api.feegow.com/v1/api/specialties/list";
$data = $api->get($endpoint);

echo $data;



