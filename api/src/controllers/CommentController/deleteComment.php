<?php
$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $value) {
  if (!$value) {
    http_response_code(400);
    echo json_encode((object)[
      "message" => "Erro ao excluir comentário"
    ]);
    exit();
  }
}

$userId = $data['userId'];
$commentId = $data['commentId'];
$token = $_SERVER['HTTP_AUTHORIZATION'];

if (isset($token)) {
  try {
    $query = "SELECT `COMT_ID`, `USER_ID` FROM `COMMENTS` WHERE `COMT_ID` = ? AND `USER_ID` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$commentId, $userId]);
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
      "message" => "Erro excluir comentário"
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
  $query = "DELETE FROM COMMENTS WHERE `COMT_ID` = ? AND `USER_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$commentId, $userId]);

  http_response_code(200);
  echo json_encode((object)[
    "message" => "Comentário excluido com sucesso"
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao excluir comentário"
  ]);
  exit();
}
