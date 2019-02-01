<?php

$pdo = new PDO('mysql:host=localhost;dbname=autosurf;charset=utf8', 'root', '');



$url = $pdo->query("SELECT * FROM sites where points >0 ORDER BY rand() limit 1 ");

$url = $url->fetch();

$doge = $pdo->query("SELECT doge FROM sites where id='{$url["id"]}'");
$doge = $doge->fetch();

$reward = round($doge["doge"]*0.001,5);

if ($reward > 0) {
	$pdo->query("update sites set doge = doge - '{$reward}' where id = '{$url["id"]}'");
	$pdo->query("update users set doge = doge + '{$reward}' where id = 1");
}


$pdo->query("update sites set points = points - 1 where id = '{$url["id"]}'");
$pdo->query("update sites set visites = visites + 1 where id = '{$url["id"]}'");
$pdo->query("update users set points = points + 1 where id = 1");

echo json_encode([
    "url" => $url["url"],
    "reward" => $reward,
]);
?>
