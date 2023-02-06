<?php 
require "connect.php";
session_start();
// Used by a button in profile.php changes the type of user to author

$stmt = $pdo->prepare('UPDATE `users` SET `type` = "author" WHERE `ID` = :userid');
$stmt->execute(array(':userid' => $_SESSION["user-inf"]["ID"]));

$_SESSION["user-inf"]["type"] = "author";

// redirect back to the profile
header("Location: profile.php");
exit();

?>