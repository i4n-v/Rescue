<?php
$id = $_GET["id"];
$token = $_SERVER["HTTP_AUTHORIZATION"];

if (!$token) {
  http_response_code(403);
  echo json_encode((object)[
    "message" => "Acesso negado pelo servidor"
  ]);
  exit();
} else {
  $token = trim(explode("Bearer", $token)[1]);
}

try {
  $query = "SELECT `USER_ID`, `USER_NAME`, `USER_EMAIL` FROM `USERS` WHERE `USER_TOKEN` = ? AND `USER_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$token, $id]);
  $userData = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!!$userData) {
    $query = "SELECT `INST_ID`, `INST_CNPJ`, `INST_DESCRIPTION` FROM `INSTITUTIONS` WHERE `USER_ID` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $institutionData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!!$institutionData) {
      http_response_code(200);
      echo json_encode((object)[
        "USER" => $userData,
        "INSTITUTION" => $institutionData
      ]);
      exit();
    }

    $query = "SELECT `PEOP_ID`, `PEOP_CPF` FROM `PEOPLE` WHERE `USER_ID` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $peopleData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!!$peopleData) {
      http_response_code(200);
      echo json_encode((object)[
        "USER" => $userData,
        "PEOPLE" => $peopleData
      ]);
      exit();
    }

    http_response_code(200);
    echo json_encode((object)[
      "USER" => $userData,
    ]);
    exit();
  } else {
    http_response_code(404);
    echo json_encode((object)[
      "message" => "Usuário não encontrado"
    ]);
    exit();
  }
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao buscar usuário"
  ]);
  exit();
}
