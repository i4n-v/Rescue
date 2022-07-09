<?php
$userId = $_POST['userId'];
$title = trim($_POST["title"]);
$description = trim($_POST['description']);
$latitude = trim($_POST['latitude']);
$longitude = trim($_POST['longitude']);
$zoom = trim($_POST['zoom']);
$region = trim($_POST['region']);
$photos = $_FILES['photos'];
$createdAt = date('Y-m-d');

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
  $token = explode(" ", $_SERVER['HTTP_AUTHORIZATION'])[1];

  try {
    $query = "SELECT `USER_ID`, `USER_TOKEN` FROM `USERS` WHERE `USER_ID` = ? AND `USER_TOKEN` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId, $token]);
    $users = $stmt->rowCount();

    if ($users === 0) {
      http_response_code(400);
      echo json_encode((object)[
        "message" => "Acesso negado"
      ]);
      exit();
    }
  } catch (PDOException $e) {
    http_response_code(500);
    echo json_encode((object)[
      "message" => "Erro ao criar postagem"
    ]);
    exit();
  }
} else {
  http_response_code(400);
  echo json_encode((object)[
    "message" => "Acesso negado"
  ]);
  exit();
}

try {
  $query = "INSERT INTO `POSTS` (`USER_ID`, `POST_TITLE`, `POST_DESCRIPTION`, `POST_CREATED_AT`, `POST_VERIFIED`) VALUES (?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$userId, $title, $description, $createdAt, 0]);
  $postId = $pdo->lastInsertId();

  $query = "INSERT INTO `LOCATIONS` (`POST_ID`, `LOC_LATITUDE`, `LOC_LONGITUDE`, `LOC_ZOOM`, `LOC_REGION`) VALUES (?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId, $latitude, $longitude, $zoom, $region]);

  if (isset($photos)) {
    $countfiles = count($photos['name']);

    for ($i = 0; $i < $countfiles; $i++) {
      $check = getimagesize($photos["tmp_name"][$i]);
      if ($check !== false) {
        $filename = date("Y-m-d") . "-" . $photos['name'][$i];
        move_uploaded_file($photos['tmp_name'][$i], 'src/images/posts/' . $filename);

        $query = "INSERT INTO `PHOTOS` (`POST_ID`, `PHOT_PATH`) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$postId, $filename]);
      }
    }
  }

  http_response_code(200);
  echo json_encode((object)[
    "message" => "Postagem criada com sucesso"
  ]);
  exit();
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao criar postagem"
  ]);
  exit();
}
