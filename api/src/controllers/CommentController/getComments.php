<?php
$postId = $_GET["postId"];
$page = intVal($_GET["page"] ?? 1);
$limit = intVal($_GET["limit"] ?? 5);

function paginator($array, $page, $limit)
{
  $result = [];
  $totalPage = ceil(count($array) / $limit);
  $count = $page * $limit - $limit;
  $delimiter = $count + $limit;

  if ($page <= $totalPage) {
    for ($i = $count; $i < $delimiter; $i++) {
      if ($array[$i] != null) {
        array_push($result, $array[$i]);
      }
      $count++;
    }
  }

  return (object)[
    "totalPage" => $totalPage,
    "pageActual" => $page,
    "result" => $result,
  ];
}

try {
  $query = "SELECT `COMT_ID`, `COMT_DESCRIPTION`, `USERS`.`USER_ID`, `USER_NAME` FROM `COMMENTS` INNER JOIN `USERS` ON `COMMENTS`.`USER_ID` = `USERS`.`USER_ID` WHERE `POST_ID` = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$postId]);
  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $paginatedComments = paginator($comments, $page, $limit);
  http_response_code(200);
  echo json_encode($paginatedComments);
  exit();
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao buscar comentários"
  ]);
  exit();
}
