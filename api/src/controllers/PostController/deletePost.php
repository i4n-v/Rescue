<?php
$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $value) {
  if (!$value) {
    http_response_code(400);
    echo json_encode((object)[
      "message" => "Erro ao excluir postagem"
    ]);
    exit();
  }
}

$userId = $data['userId'];
$postId = $data['postId'];
$token = $_SERVER['HTTP_AUTHORIZATION'];

if (isset($token)) {
  try {
    $query = "SELECT `POST_ID`, `USER_ID` FROM `POSTS` WHERE `POST_ID` = ? AND `USER_ID` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$postId, $userId]);
    $post = $stmt->fetch();

    if (!$post) {
      http_response_code(400);
      echo json_encode((object)[
        "message" => "Acesso negado"
      ]);
      exit();
    }
  } catch (PDOException $e) {
    http_response_code(500);
    echo json_encode((object)[
      "message" => "Erro excluir postagem"
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
  $query = "DELETE FROM LOCATIONS WHERE `POST_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId]);

  $query = "DELETE FROM COMMENTS WHERE `POST_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId]);

  $query = "DELETE FROM LIKES WHERE `POST_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId]);

  $query = "SELECT `PHOT_PATH` FROM PHOTOS WHERE `POST_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId]);
  $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $query = "DELETE FROM PHOTOS WHERE `POST_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId]);

  foreach ($photos as $photo) {
    $directory = "src/images/posts/";
    unlink($directory . $photo["PHOT_PATH"]);
  }

  $query = "DELETE FROM POSTS WHERE `POST_ID` = ? AND `USER_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$userId, $postId]);

  http_response_code(200);
  echo json_encode((object)[
    "message" => "Postagem excluida com sucesso"
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao excluir Postagem"
  ]);
  exit();
}
