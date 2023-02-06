<?php 
require 'connect.php';
session_start();
// Page where admins have an overview of all articles that need to be screened

if (!(array_key_exists('user-inf', $_SESSION) && ($_SESSION['user-inf']['type'] == 'admin'))) {
    header("Location: not-exist.php");
    exit();
}
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
            <h1 style="padding-left:2%;">  Artikelen in behandeling</h1>
        </div>
        <div class= "article-thumbnails-container", id="screening-thumbnails">   
        </div>
        </div>
    <?php require "footer-body.php"?>
    <script src="get-articles-script.js"></script>
    <script>getArticles("screening-thumbnails", {amount: 100, screenedTag: 0});</script>

</body>