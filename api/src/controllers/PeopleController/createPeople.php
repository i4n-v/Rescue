<?php
$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $value) {
  if (!$value) {
    http_response_code(400);
    echo json_encode((object)[
      "message" => "Erro ao cadastrar usuário"
    ]);
    exit();
  }
}

$name = trim($data["name"]);
$email = trim($data['email']);
$cpf = trim($data['cpf']);
$password = sha1(trim($data['password']));
$confirmPassword = sha1(trim($data['confirmPassword']));

try {
  $query = "SELECT `USER_EMAIL` FROM `USERS` WHERE `USER_EMAIL` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$email]);
  $userEmail = $stmt->fetch(PDO::FETCH_ASSOC)['USER_EMAIL'];

  $query = "SELECT `PEOP_CPF` FROM `PEOPLE` WHERE `PEOP_CPF` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$cpf]);
  $peopleCPF = $stmt->fetch(PDO::FETCH_ASSOC)['PEOP_CPF'];
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao cadastrar usuário"
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
} else if (!!$peopleCPF && $peopleCPF == $cpf) {
  http_response_code(400);
  echo json_encode((object)[
    "message" => "CPF já cadastrado"
  ]);
  exit();
}

try {
  $query = "INSERT INTO `USERS` (`USER_NAME`, `USER_EMAIL`, `USER_PASSWORD`) VALUES (?, ?, ?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$name, $email, $password]);
  $userId = $pdo->lastInsertId();

  $query = "INSERT INTO `ADDRESS` (`USER_ID`) VALUES (?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$userId]);

  $query = "INSERT INTO `PEOPLE` (`PEOP_CPF`, `USER_ID`) VALUES (?, ?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$cpf, $userId]);

  http_response_code(200);
  echo json_encode((object)[
    "message" => "Usuário cadastrado com sucesso"
  ]);
  exit();
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao cadastrar usuário"
  ]);
  exit();
}
