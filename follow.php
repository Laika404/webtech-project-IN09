<?php
// This file describes a follow request
require "connect.php";
session_start();
$user_id = $_POST["user-id"];
$author_name = $_POST["author-name"];

$stmt = $pdo->prepare('SELECT `ID` FROM `users` WHERE `username` = :authorname');
$stmt->execute(array(':authorname' => $author_name));
$author_id = $stmt->fetch()['ID'];

// if follow = 1, it means that a follow needs to be added to the database otherwise deleted.
$follow = $_POST["follow"];

// prevents people from using a script to insert random follows
if (!(array_key_exists('user-inf', $_SESSION) && ($_SESSION['user-inf']['ID'] == $user_id))) {
    exit();
}

if ($follow == 1) {
    $stmt = $pdo->prepare('INSERT INTO `followed-authors` (`user-ID`, `author-ID`) VALUES (:userid, :authorid)');
    $stmt->execute(array(":userid" => $user_id, ":authorid" => $author_id));

} else {
    $stmt = $pdo->prepare('DELETE FROM `followed-authors` WHERE `user-ID` = :userid AND `author-ID` = :authorid');
    $stmt->execute(array(":userid" => $user_id, ":authorid" => $author_id));
}

$stmt = $pdo->prepare('SELECT COUNT(*) FROM `followed-authors` WHERE `author-ID` = :authorid');
$stmt->execute(array(':authorid' => $author_id));
$follow_number = $stmt->fetch()[0];

echo $follow_number;

?>