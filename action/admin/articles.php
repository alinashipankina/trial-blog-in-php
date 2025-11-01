<?php
$user = checkUser($pdo);

$stmt = $pdo->query("SELECT * FROM article ORDER BY id DESC");

require_once './templates/articles.php';
