<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Origin, Authorization");

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
    case str_contains($request, '/api/post'):
      require __DIR__ . '/src/controllers/PostController/getPost.php';
      break;
    case str_contains($request, '/api/location'):
      require __DIR__ . '/src/controllers/PostController/getLocation.php';
      break;
    case str_contains($request, '/api/photos'):
      require __DIR__ . '/src/controllers/PostController/getPhotos.php';
      break;
    case str_contains($request, '/api/comments'):
      require __DIR__ . '/src/controllers/CommentController/getComments.php';
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
    case str_contains($request, '/api/post'):
      require __DIR__ . '/src/controllers/PostController/createPost.php';
      break;
    case str_contains($request, '/api/update/post'):
      require __DIR__ . '/src/controllers/PostController/updatePost.php';
      break;
    case '/api/comments':
      require __DIR__ . '/src/controllers/CommentController/createComment.php';
      break;
    case '/api/like':
      require __DIR__ . '/src/controllers/PostController/createLike.php';
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
    case str_contains($request, '/api/post'):
      require __DIR__ . '/src/controllers/PostController/deletePost.php';
      break;
    case str_contains($request, '/api/comments'):
      require __DIR__ . '/src/controllers/CommentController/deleteComment.php';
      break;
    case '/api/like':
      require __DIR__ . '/src/controllers/PostController/deleteLike.php';
      break;
    default:
      http_response_code(404);
      echo "Route not found";
      break;
  }
} else {
  http_response_code(405);
  echo "Method Not Allowed";
}
