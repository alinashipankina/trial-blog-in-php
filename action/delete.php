<?php
$user = checkUser($pdo);

$id = $_GET['id'] ?? null;
if (!$id) {
    redirect('/blog/?act=articles');
}

$article = getUserArticle($pdo, $id, $user);

@unlink($_SERVER['DOCUMENT_ROOT'] . "/blog/images/" . $article['img']);

if ($user['isAdmin']) {
    $stmt = $pdo->prepare("DELETE FROM article WHERE id = ?");
    $stmt->execute([$id]);
    redirect('/blog/?act=adminArticles');
} else {
    $stmt = $pdo->prepare("DELETE FROM article WHERE id = ? AND userId = ?");
    $stmt->execute([$id, $user['id']]);
    redirect('/blog/?act=articles');
}
