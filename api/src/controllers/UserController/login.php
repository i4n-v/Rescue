<?php
$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $value) {
  if (!$value) {
    http_response_code(400);
    echo json_encode((object)[
      "message" => "Email ou senha incorretos"
    ]);
    exit();
  }
}

$email = trim($data['email']);
$password = sha1(trim($data['password']));

try {
  $query = "SELECT * FROM `USERS` WHERE `USER_EMAIL` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$email]);
  $userData = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao tentar fazer login"
  ]);
  exit();
}

if ($password != $userData["USER_PASSWORD"]) {
  http_response_code(400);
  echo json_encode((object)[
    "message" => "E-mail ou senha incorretos"
  ]);
  exit();
} else if ($email != $userData["USER_EMAIL"]) {
  http_response_code(400);
  echo json_encode((object)[
    "message" => "E-mail ou senha incorretos"
  ]);
  exit();
}

try {
  $token = sha1(rand(1, 10000));

  $query = "UPDATE `USERS` SET `USER_TOKEN` = ? WHERE `USER_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$token, $userData["USER_ID"]]);

  http_response_code(200);
  echo json_encode((object)[
    "USER_TOKEN" => $token,
    "USER_ID" => $userData["USER_ID"]
  ]);
  exit();
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao tentar fazer login"
  ]);
  exit();
}
