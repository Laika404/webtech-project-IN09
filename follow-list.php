<?php 
// Shows a list of which author the current user is following
require 'connect.php';
session_start();

if (!(array_key_exists('user-inf', $_SESSION))) {
    header("Location: not-exist.php");
    exit();
}

$query_string = "SELECT `author-ID` FROM `followed-authors` WHERE `user-ID` = :userid";

$stmt = $pdo->prepare($query_string);
$stmt->execute(array(":userid" => $_SESSION["user-inf"]["ID"]));

$all_followed_id = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

?>


<!DOCTYPE html>
<html lang='nl'>
<head>
        <title>Geademos - Wereldkaart</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="basic.css">
        <?php require "nav-bar-head.php" ?>
        <link rel="stylesheet" href="basic-page-style.css">
        <link rel="stylesheet" href="follow-list-style.css">
        <link rel="stylesheet" href="footer-style.css">
</head>
<body>
<?php require "nav-bar-body.php" ?>
<div id="content-body">
    <div class="lower-border-div small-height"> <h1>Jouw gevolgde auteurs</h1></div>
    <div id="followed-list-container">
        <!-- The list of followed authors -->
        <?php 
        foreach($all_followed_id as $author_id) {
            $stmt = $pdo->prepare("SELECT `username` FROM `users` WHERE `ID` = :authorid");
            $stmt->execute(array(":authorid" => $author_id));
            $author_name = $stmt->fetch()[0];
            echo "<h1><a href='article-list-user.php?u-name=" . $author_name ." '>  -  ". $author_name ."</a></h1>";
        }
        
        ?>

    </div>
</div>
<?php include "footer-body.php" ?>
</body>
</html>