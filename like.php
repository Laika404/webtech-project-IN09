<?php
require "connect.php";
session_start();
$user_id = $_POST["user-id"];
$article_id = $_POST["article-id"];
// if like = 1, it means that a like needs to be added to the database otherwise deleted.
$like = $_POST["like"];

// prevents people from using a script to insert random likes
if (!(array_key_exists('user-inf', $_SESSION) && ($_SESSION['user-inf']['ID'] == $user_id))) {
    exit();
}

// used for changing the like value
$stmt = $pdo->prepare('SELECT `likes` FROM `articles` WHERE `ID` = :article_id');
$stmt->execute(array(':article_id' => $article_id));
$like_value = $stmt->fetch()["likes"];

// inserts or deletes a like
if ($like == 1) {
    $stmt = $pdo->prepare('INSERT INTO `liked-articles` (`user-ID`, `article-ID`) VALUES (:userid, :articleid)');
    $stmt->execute(array(":userid" => $user_id, ":articleid" => $article_id));

    $like_value += 1;
} else {
    $stmt = $pdo->prepare('DELETE FROM `liked-articles` WHERE `user-ID` = :userid AND `article-ID` = :articleid');
    $stmt->execute(array(":userid" => $user_id, ":articleid" => $article_id));
    $like_value -= 1;
}

// change the like 
$stmt = $pdo->prepare('UPDATE `articles` SET `likes` = :likesnew WHERE `ID` = :article_id');
$stmt->execute(array(':likesnew' => $like_value, ':article_id' => $article_id));

// used for displaying the new like value
echo $like_value;
?>