<?php
$pdo = new PDO('mysql:host=localhost;dbname=autosurf;charset=utf8', 'root', '');

$points = $pdo->query("SELECT points FROM users where id = 1");
$points = $points->fetch();

echo json_encode([
    "points" => $points["points"],
]);
?>