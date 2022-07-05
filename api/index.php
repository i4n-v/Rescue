<?php
require_once "./src/dataBase/conectDatabase.php";

$requestMethod = $_SERVER["REQUEST_METHOD"];
$request = $_SERVER['REQUEST_URI'];

if ($request == "/") {
  echo "Hello World";
} else if ($requestMethod == "GET") {
  switch ($request) {
    case str_contains($request, '/user'):
      require __DIR__ . '/src/controllers/UserController/getUser.php';
      break;
    default:
      http_response_code(404);
      echo "Route not found";
      break;
  }
} else if ($requestMethod == "POST") {
  switch ($request) {
    case '/people':
      require __DIR__ . '/src/controllers/PeopleController/createPeople.php';
      break;
    case '/institution':
      require __DIR__ . '/src/controllers/InstitutionController/createInstitution.php';
      break;
    case '/login':
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
