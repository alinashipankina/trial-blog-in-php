<?php

$id = $_GET['id'] ?? null;
if (!$id) {
    redirect('/blog/admin/');
}

$article = getUserArticle($pdo, $id, $user);

@unlink($_SERVER['DOCUMENT_ROOT'] . "/blog/images/" . $article['img']);

$stmt = $pdo->prepare("DELETE FROM article WHERE id = ?");
$stmt->execute([$id]);
redirect('/blog/admin');
