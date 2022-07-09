<?php
$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $value) {
  if (!$value) {
    http_response_code(400);
    echo json_encode((object)[
      "message" => "Erro ao curtir a postagem"
    ]);
    exit();
  }
}

$userId = $data['userId'];
$postId = $data['postId'];
$token = $_SERVER['HTTP_AUTHORIZATION'];

if (isset($token)) {
  try {
    $query = "INSERT INTO `LIKES` (`USER_ID`, `POST_ID`) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId, $postId]);

    http_response_code(200);
    echo json_encode((object)[
      "message" => "Postagem curtida com sucesso"
    ]);
  } catch (PDOException $e) {
    http_response_code(500);
    echo json_encode((object)[
      "message" => "Erro ao curtir a postagem"
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
