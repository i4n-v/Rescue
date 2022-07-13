<?php
$userId = $_GET['userId'];
$postId = $_GET['postId'];
$title = trim($_POST["title"]);
$description = trim($_POST['description']);
$latitude = $_POST['latitude'] == "null" ? null : $_POST['latitude'];
$longitude = $_POST['longitude'] == "null" ? null : $_POST['longitude'];
$zoom = $_POST['zoom'] == "null" ? null : $_POST['zoom'];
$region = trim($_POST['region']);
$photos = $_FILES['photos'];
$photosId = $_POST['photosId'];
$photosPreviousPath = $_POST['photosPreviousPath'];

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
  $token = explode(" ", $_SERVER['HTTP_AUTHORIZATION'])[1];

  try {
    $query = "SELECT `USER_ID`, `USER_TOKEN` FROM `USERS` WHERE `USER_ID` = ? AND `USER_TOKEN` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId, $token]);
    $users = $stmt->rowCount();

    $query = "SELECT `USER_ID`, `POST_ID` FROM `POSTS` WHERE `USER_ID` = ? AND `POST_ID` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId, $postId]);
    $posts = $stmt->rowCount();

    if ($users === 0 && $posts === 0) {
      http_response_code(400);
      echo json_encode((object)[
        "message" => "Acesso negado"
      ]);
      exit();
    }
  } catch (PDOException $e) {
    http_response_code(500);
    echo json_encode((object)[
      "message" => "Erro ao atualizar postagem"
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
  $query = "UPDATE `POSTS` SET `POST_TITLE` = ?, `POST_DESCRIPTION` = ? WHERE `POST_ID` = ? AND `USER_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$title, $description, $postId, $userId]);

  $query = "UPDATE `LOCATIONS` SET `LOC_LATITUDE` = ?, `LOC_LONGITUDE` = ?, `LOC_ZOOM` = ?, `LOC_REGION` = ? WHERE `POST_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$latitude, $longitude, $zoom, $region, $postId]);

  if (isset($photos)) {
    $countfiles = count($photos['name']);

    for ($i = 0; $i < $countfiles; $i++) {
      $check = getimagesize($photos["tmp_name"][$i]);
      if ($check !== false) {
        $filename = date("Y-m-d-H:i:s") . "-" . $photos['name'][$i];
        move_uploaded_file($photos['tmp_name'][$i], 'src/images/posts/' . $filename);

        if (!!$photosId[$i]) {
          unlink('src/images/posts/' . $photosPreviousPath[$i]);
          $query = "UPDATE `PHOTOS` SET `PHOT_PATH` =  ? WHERE `PHOT_ID` = ? AND `POST_ID` = ?";
          $stmt = $pdo->prepare($query);
          $stmt->execute([$filename, $photosId[$i], $postId]);
        } else {
          $query = "INSERT INTO `PHOTOS` (`POST_ID`, `PHOT_PATH`) VALUES (?, ?)";
          $stmt = $pdo->prepare($query);
          $stmt->execute([$postId, $filename]);
        }
      }
    }
  }

  http_response_code(200);
  echo json_encode((object)[
    "message" => "Postagem atualizada com sucesso"
  ]);
  exit();
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao atualizar postagem"
  ]);
  exit();
}
