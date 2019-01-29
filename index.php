<?php 
/*
  project: Simple Rest API with PHP
  author: NottDev
  created at: 29/01/19
*/

header('Access-Control-Allow-Origin: http://localhost:8888');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, UPDATE, PUT');
// header('Access-Control-Allow-Max-Age: 5000');

//get http request method
$httpMethod = $_SERVER['REQUEST_METHOD'];

//get Content-Type from http request header
$contentType = $_SERVER["CONTENT_TYPE"];

//set dynamic response Content-Type
$responseContentType = explode(";" , $contentType)[0];

//import SimpleRest Class
require('SimpleRest.php');
$rest = new SimpleRest($responseContentType);

sleep(10);

//Set default http status code = 200
$httpStatusCode = 200; 

//get response
$body['Content-Type'] = $contentType;

//Check http Method
switch ($httpMethod) {
  case 'GET':
    $body['data'] = $_GET;
    break;

  case 'POST':
    
    //Content-Type is form-data or x-www-form-urlencoded
    if( ( strpos($contentType,"multipart/form-data") !== false) || (strpos($contentType,"application/x-www-form-urlencoded" ) !== false )) {
      $input = $_POST;
    } else {
      $inputJSON = file_get_contents('php://input');
      $input = json_decode($inputJSON , true); //convert JSON to array or StdClass Object
    }
    $body['data'] = $input;
    
  break;

  case 'DELETE':
    //TO DO ..
    break;

    case 'PUT':
    //TO DO ..
    break;

  default:
    # code...
    break;
}

//Response data
$rest->setHttpStatus($httpStatusCode);
echo $rest->response($body['data']);

exit();