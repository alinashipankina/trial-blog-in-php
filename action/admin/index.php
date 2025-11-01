<?php
$perPage = 5;
$stmt = $pdo->query("SELECT COUNT(*) FROM article");
$count = $stmt->fetchColumn();
$pages = ceil($count / $perPage);

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) {
    $currentPage = 1;
}

if ($currentPage > $pages) {
    $currentPage = $pages;
}

$offset = $perPage * ($currentPage - 1);


$stmt = $pdo->prepare("SELECT * FROM article ORDER BY id DESC LIMIT ?, ?");
$stmt->execute([$offset, $perPage]);

include_once $_SERVER['DOCUMENT_ROOT'] . '/blog/templates/admin/index.php';
