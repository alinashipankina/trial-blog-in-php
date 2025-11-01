<?php
$user = checkUser($pdo);

$stmt = $pdo->prepare("SELECT * FROM article WHERE userId = ? ORDER BY id DESC");
$stmt->execute([$user['id']]);

require_once './templates/articles.php';
