<?php
$user = checkUser($pdo);

$id = $_GET['id'] ?? null;
if (!$id) {
    redirect('/blog/?act=articles');
}

if (count($_POST)) {
    $sql = '';
    if ($_FILES['file']['size']) {
        $filename = upload($user['id']);
        $sql = "img = '" . $filename . "', ";
        $article = getUserArticle($pdo, $id, $user);
        @unlink($_SERVER['DOCUMENT_ROOT'] . "/blog/images/" . $article['img']);
    }
    $title = strip_tags($_POST['title'] ?? null);
    $content = strip_tags($_POST['content'] ?? null);
    if ($user['isAdmin']) {
        $stmt = $pdo->prepare("UPDATE article SET " . $sql . "title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
        redirect('/blog/?act=adminArticles');
    } else {
        $stmt = $pdo->prepare("UPDATE article SET " . $sql . "title = ?, content = ? WHERE id = ? AND userId = ?");
        $stmt->execute([$title, $content, $id, $user['id']]);
        redirect('/blog/?act=articles');
    }
}

if ($user['isAdmin']) {
    $stmt = $pdo->prepare("SELECT * FROM article WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
} else {
    $article = getUserArticle($pdo, $id, $user['id']);
}

$article = $stmt->fetch();
if (!$article) {
    redirect('/blog/?act=articles');
}


require_once './templates/edit.php';
