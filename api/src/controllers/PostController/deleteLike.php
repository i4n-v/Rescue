<?php
$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $value) {
  if (!$value) {
    http_response_code(400);
    echo json_encode((object)[
      "message" => "Erro ao discurtir postagem"
    ]);
    exit();
  }
}

$userId = $data['userId'];
$postId = $data['postId'];
$token = $_SERVER['HTTP_AUTHORIZATION'];

if (isset($token)) {
  try {
    $query = "SELECT `POST_ID`, `USER_ID` FROM `LIKES` WHERE `POST_ID` = ? AND `USER_ID` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$postId, $userId]);
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$comment) {
      http_response_code(400);
      echo json_encode((object)[
        "message" => "Acesso negado"
      ]);
      exit();
    }
  } catch (PDOException $e) {
    http_response_code(500);
    echo json_encode((object)[
      "message" => "Erro ao discurtir postagem"
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
  $query = "DELETE FROM LIKES WHERE `POST_ID` = ? AND `USER_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId, $userId]);

  http_response_code(200);
  echo json_encode((object)[
    "message" => "Postagem discurtida com sucesso"
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao discurtir postagem"
  ]);
  exit();
}
