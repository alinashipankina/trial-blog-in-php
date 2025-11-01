<?php

function redirect(string $uri)
{
    header('Location: ' . $uri);
    die();
}

function checkUser($pdo)
{
    if (empty($_SESSION['userId'])) {
        redirect('/blog/?act=login');
        die();
    }

    $userId = intval($_SESSION['userId'] ?? null);
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if (!$user) {
        redirect('/blog/?act=login');
        die();
    }

    return $user;
}

function checkAdminUser($pdo)
{
    $user = checkUser($pdo);
    if ($user['isAdmin'] != 1) {
        redirect('/blog/?act=login');
    }

    return $user;
}

function getUser($pdo)
{
    $userId = intval($_SESSION['userId'] ?? null);
    if (!$userId) {
        return [];
    }

    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if (!$user) {
        return [];
    }

    return $user;
}

function getUserArticle($pdo, int $id, array $user)
{
    if ($user['isAdmin'] == 1) {
        $stmt = $pdo->prepare("SELECT * FROM article WHERE id = ?");
        $stmt->execute([$id]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM article WHERE id = ? AND userId = ?");
        $stmt->execute([$id, $user['id']]);
    }

    $article = $stmt->fetch();
    if (!$article) {
        redirect('/blog/?act=articles');
        die();
    }

    return $article;
}


function upload(int $userId)
{
    $img = $_FILES['file']['tmp_name'];
    $size_img = getimagesize($img);
    $width = $size_img[0];
    $height = $size_img[1];
    $mime = $size_img['mime'];

    switch ($size_img['mime']) {
        case 'image/jpeg':
            $src = imagecreatefromjpeg($img);
            $ext = "jpg";
            break;
        case 'image/gif':
            $src = imagecreatefromgif($img);
            $ext = "gif";
            break;
        case 'image/png':
            $src = imagecreatefrompng($img);
            $ext = "png";
            break;
    }

    $wNew = 348;
    $hNew = floor($height / ($width / $wNew));
    $dest = imagecreatetruecolor($wNew, $hNew);

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $wNew, $hNew, $width, $height);

    $filename = "photo-" . $userId . "-" . time() . '.' . $ext;
    $fullFilename = $_SERVER['DOCUMENT_ROOT'] . "/blog/images/" . $filename;

    switch ($mime) {
        case 'image/jpeg':
            imagejpeg($dest, $fullFilename, 100);
            break;
        case 'image/gif':
            imagegif($dest, $fullFilename);
            break;
        case 'image/png':
            imagepng($dest, $fullFilename);
            break;
    }

    return $filename;
}
