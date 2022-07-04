<?php
$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $value) {
  if (!$value) {
    http_response_code(400);
    echo json_encode((object)[
      "message" => "Erro ao cadastrar instituição"
    ]);
    exit();
  }
}

$name = trim($data["name"]);
$email = trim($data['email']);
$cnpj = trim($data['cnpj']);
$password = sha1(trim($data['password']));
$confirmPassword = sha1(trim($data['confirmPassword']));

try {
  $query = "SELECT `USER_EMAIL` FROM `USERS` WHERE `USER_EMAIL` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$email]);
  $userEmail = $stmt->fetch(PDO::FETCH_ASSOC)['USER_EMAIL'];

  $query = "SELECT `INST_CNPJ` FROM `INSTITUTIONS` WHERE `INST_CNPJ` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$cnpj]);
  $institutionCnpj = $stmt->fetch(PDO::FETCH_ASSOC)['INST_CNPJ'];
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao cadastrar instituição"
  ]);
  exit();
}

if ($password != $confirmPassword) {
  http_response_code(400);
  echo json_encode((object)[
    "message" => "As senhas não coincidem"
  ]);
  exit();
} else if (!!$userEmail && $userEmail == $email) {
  http_response_code(400);
  echo json_encode((object)[
    "message" => "E-mail já cadastrado"
  ]);
  exit();
} else if (!!$institutionCnpj && $institutionCnpj == $cnpj) {
  http_response_code(400);
  echo json_encode((object)[
    "message" => "CNPJ já cadastrado"
  ]);
  exit();
}

try {
  $query = "INSERT INTO `USERS` (`USER_NAME`, `USER_EMAIL`, `USER_PASSWORD`) VALUES (?, ?, ?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$name, $email, $password]);
  $userId = $pdo->lastInsertId();

  $query = "INSERT INTO `INSTITUTIONS` (`INST_CNPJ`, `USER_ID`) VALUES (?, ?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$cnpj, $userId]);

  http_response_code(200);
  echo json_encode((object)[
    "message" => "Instituição cadastrada com sucesso"
  ]);
  exit();
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao cadastrar instituição"
  ]);
  exit();
}
