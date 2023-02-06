<?php 
require 'connect.php';
session_start();

// Not accesible if not an admin, otherwise security risk
if (!array_key_exists('user-inf', $_SESSION) && (($_SESSION['user-inf']['type'] == 'admin') || ($_SESSION['user-inf']['ID'] == $article_data['author-ID']))) {
    header("Location: not-exist.php");
    exit();
}

$article_id = $_POST["article-id"];

$stmt = $pdo->prepare('DELETE FROM `articles` WHERE `ID` = :article_id');
$stmt->execute(array(':article_id' => $article_id));

?>