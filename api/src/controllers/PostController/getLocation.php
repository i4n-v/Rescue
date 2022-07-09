<?php
$postId = $_GET["postId"];

try {
  $query = "SELECT `LOC_ID`, `LOC_LATITUDE`, `LOC_LONGITUDE`, `LOC_ZOOM`, `LOC_REGION` FROM `LOCATIONS` WHERE `POST_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId]);
  $location = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!!$location) {
    http_response_code(200);
    echo json_encode($location);
    exit();
  } else {
    http_response_code(404);
    echo json_encode((object)[
      "message" => "Localização não encontrada"
    ]);
    exit();
  }
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao buscar localização"
  ]);
  exit();
}
