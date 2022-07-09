<?php
$userId = $_GET["userId"];
$filter = $_GET["filter"];
$region = $_GET["region"] ?? "%";
$title = $_GET["title"] ?? "";
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
  $postId = null;

  if ($filter == "all") {
    $query = "SELECT 
	  `POSTS`.`POST_ID`,
    `POST_TITLE`,
    `POST_DESCRIPTION`,
    CASE WHEN `POST_VERIFIED` > 0 THEN 'true' ELSE 'false' END AS `POST_VERIFIED`,
    `POST_CREATED_AT`,
	  (SELECT COUNT(`LIKES`.`POST_ID`) FROM LIKES WHERE `LIKES`.`POST_ID` = `POSTS`.`POST_ID`) AS `TOTAL_LIKES`,
    (SELECT COUNT(`COMMENTS`.`POST_ID`) FROM COMMENTS WHERE `COMMENTS`.`POST_ID` = `POSTS`.`POST_ID`) AS `TOTAL_COMMENTS`,
    (SELECT CASE WHEN COUNT(`LIKES`.`POST_ID`) > 0 THEN 'true' ELSE 'false' END 
    FROM LIKES WHERE `LIKES`.`USER_ID` = ? AND `LIKES`.`POST_ID` = `POSTS`.`POST_ID`) AS `LIKED`
    FROM `POSTS` WHERE (`POST_TITLE` LIKE ? OR `POST_TITLE` LIKE ?) AND (SELECT `LOC_REGION` FROM LOCATIONS WHERE `LOCATIONS`.`POST_ID` = `POSTS`.`POST_ID`) LIKE ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId, "%$title%", "%" . strtolower($title) . "%", $region]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $query = "SELECT 
	  `POSTS`.`POST_ID`,
    `POST_TITLE`,
    `POST_DESCRIPTION`,
    CASE WHEN `POST_VERIFIED` > 0 THEN 'true' ELSE 'false' END AS `POST_VERIFIED`,
    `POST_CREATED_AT`,
	  (SELECT COUNT(`LIKES`.`POST_ID`) FROM LIKES WHERE `LIKES`.`POST_ID` = `POSTS`.`POST_ID`) AS `TOTAL_LIKES`,
    (SELECT COUNT(`COMMENTS`.`POST_ID`) FROM COMMENTS WHERE `COMMENTS`.`POST_ID` = `POSTS`.`POST_ID`) AS `TOTAL_COMMENTS`,
    (SELECT CASE WHEN COUNT(`LIKES`.`POST_ID`) > 0 THEN 'true' ELSE 'false' END 
    FROM LIKES WHERE `LIKES`.`USER_ID` = `POSTS`.`USER_ID` AND `LIKES`.`POST_ID` = `POSTS`.`POST_ID`) AS `LIKED`
    FROM `POSTS` WHERE `POSTS`.`USER_ID` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  $paginatedPosts = paginator($posts, $page, $limit);
  http_response_code(200);
  echo json_encode($paginatedPosts);
  exit();
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode((object)[
    "message" => "Erro ao buscar postagens"
  ]);
  exit();
}
