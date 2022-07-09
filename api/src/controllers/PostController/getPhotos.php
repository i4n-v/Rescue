<?php
$postId = $_GET["postId"];

try {
  $query = "SELECT `PHOT_ID`, `PHOT_PATH` FROM `PHOTOS` WHERE `POST_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId]);
  $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (count($photos) > 0) {
    $directory = "src/images/posts/";
    $images = [];

    foreach ($photos as $photo) {
      $url = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/" . $directory . $photo["PHOT_PATH"];
      array_push($images, (object)[
        "PHOT_ID" => $photo["PHOT_ID"],
        "PHOT_PATH" => $photo["PHOT_PATH"],
        "PHOT_URL" => $url,
      ]);
    }

    http_response_code(200);
    echo json_encode($images);
    exit();
  } else {
    http_response_code(404);
    echo json_encode((object)[
      "message" => "Nenhuma imagem encontrada"
    ]);
    exit();
  }
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao buscar imagens"
  ]);
  exit();
}
