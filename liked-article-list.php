<?php 
// A page where you can see which articles you have liked
require 'connect.php';
session_start();

if (!(array_key_exists('user-inf', $_SESSION))) {
    header("Location: not-exist.php");
    exit();
}

// Get all articles this user has liked
$query_string = "SELECT `article-ID` FROM `liked-articles` WHERE `user-ID` = :userid";
$stmt = $pdo->prepare($query_string);
$stmt->execute(array(":userid" => $_SESSION["user-inf"]["ID"]));

$all_liked_id = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

?>


<!DOCTYPE html>
<head>
        <title>Geademos - Screening</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="basic.css">
        <link rel="stylesheet" href="basic-search-style.css">
        <link rel="stylesheet" href="article-thumbnail-style.css">
        <?php require "nav-bar-head.php" ?>
        <link rel="stylesheet" href="footer-style.css">
</head>
    <body>
    <?php require "nav-bar-body.php" ?>
    <div id="content-body">
        <div class="lower-border-div small-height"> 
            <h1 style="padding-left:2%;">  Jouw gelikete artikelen</h1>
        </div>
        <script src="get-article-thumbnail.js"></script>
        <div class= "article-thumbnails-container", id="screening-thumbnails">
        <?php 
        // Goes through all liked articles
            foreach($all_liked_id as $article_id) {
                echo "<script>getArticleThumbnail(" . $article_id . ",'screening-thumbnails')</script>";
            }
        ?>

        </div>
        </div>
    <?php require "footer-body.php"?>
</body>