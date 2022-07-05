<?php
$host = 'localhost';
$db = 'RESCUE';
$user = 'root';
$pass = 'root';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8";

try {
  $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
  echo $e;
}
