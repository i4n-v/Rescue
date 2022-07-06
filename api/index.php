<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once "./src/dataBase/conectDatabase.php";

$requestMethod = $_SERVER["REQUEST_METHOD"];
$request = $_SERVER['REQUEST_URI'];

if ($request == "/api") {
  echo "Hello World";
} else   if ($requestMethod == "OPTIONS") {
  http_response_code(200);
  echo "OK";
} else if ($requestMethod == "GET") {
  switch ($request) {
    case str_contains($request, '/api/user'):
      require __DIR__ . '/src/controllers/UserController/getUser.php';
      break;
    default:
      http_response_code(404);
      echo "Route not found";
      break;
  }
} else if ($requestMethod == "POST") {
  switch ($request) {
    case '/api/people':
      require __DIR__ . '/src/controllers/PeopleController/createPeople.php';
      break;
    case '/api/institution':
      require __DIR__ . '/src/controllers/InstitutionController/createInstitution.php';
      break;
    case '/api/login':
      require __DIR__ . '/src/controllers/UserController/login.php';
      break;
    default:
      http_response_code(404);
      echo "Route not found";
      break;
  }
} else if ($requestMethod == "PUT") {
  switch ($request) {
    default:
      http_response_code(404);
      echo "Route not found";
      break;
  }
} else if ($requestMethod == "DELETE") {
  switch ($request) {
    default:
      http_response_code(404);
      echo "Route not found";
      break;
  }
} else {
  http_response_code(405);
  echo "Method Not Allowed";
}
