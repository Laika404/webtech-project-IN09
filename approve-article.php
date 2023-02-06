<?php 
require 'connect.php';
session_start();

// Not accesible if not an admin, otherwise security risk
if (!(array_key_exists('user-inf', $_SESSION) && ($_SESSION['user-inf']['type'] == 'admin'))) {
    header("Location: not-exist.php");
    exit();
}

$article_id = $_POST["article-id"];
// set screened-tag to 1
$stmt = $pdo->prepare('UPDATE `articles` SET `screened-tag` = 1 WHERE `ID` = :article_id');
$stmt->execute(array(':article_id' => $article_id));



?>