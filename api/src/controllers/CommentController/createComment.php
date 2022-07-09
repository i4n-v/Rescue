<?php
$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $value) {
  if (!$value) {
    http_response_code(400);
    echo json_encode((object)[
      "message" => "Erro ao comentar na postagem"
    ]);
    exit();
  }
}

$userId = $data['userId'];
$postId = $data['postId'];
$description = trim($data["description"]);
$token = $_SERVER['HTTP_AUTHORIZATION'];

if (isset($token)) {
  try {
    $query = "INSERT INTO `COMMENTS` (`USER_ID`, `POST_ID`, `COMT_DESCRIPTION`) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId, $postId, $description]);

    http_response_code(200);
    echo json_encode((object)[
      "message" => "Comentário criado com sucesso"
    ]);
  } catch (PDOException $e) {
    http_response_code(500);
    echo json_encode((object)[
      "message" => "Erro ao comentar na postagem"
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
