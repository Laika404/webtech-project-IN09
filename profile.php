<?php
session_start();
if (!(isset($_SESSION["authenticated"]))) {
  header("Location: not-exist.php");
  exit();
}

require 'connect.php';

$total_views = $follow_number = $total_likes = 0;
$name_authors = $name_articles = [];

$userID = $_SESSION["user-inf"]["ID"];

// request the type of user from a certain ID
$stmt = $pdo->prepare("SELECT `type` FROM users WHERE ID=?");
$stmt->execute([$userID]);
$usertype = $stmt->fetch()[0];

// request how many followers an author has
$stmt = $pdo->prepare("SELECT COUNT(*) FROM `followed-authors` WHERE `author-ID` = ?");
$stmt->execute([$userID]);
$follow_number = $stmt->fetch()[0];

// request the total amount of views on all articles an author wrote
$stmt = $pdo->prepare("SELECT COALESCE(SUM(views), 0) FROM `articles` WHERE `author-ID` = ?");
$stmt->execute([$userID]);
$total_views = $stmt->fetch()[0];

// request the total amount of likes no all articles an author wrote
$stmt = $pdo->prepare("SELECT COALESCE(SUM(likes), 0) FROM `articles` WHERE `author-ID` = ?");
$stmt->execute([$userID]);
$total_likes = $stmt->fetch()[0];

// functions to request the names of the followed authors
$stmt = $pdo->prepare("SELECT `author-ID` FROM `followed-authors` WHERE `user-ID` = ?");
$stmt->execute([$userID]);
$follow_authors = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// set a variable amount of placeholders for the pdo prepare query
$in = "";
for ($i=0; $i < count($follow_authors); $i++) {
  if ($i > 0) {
    $in .= ',';
  }
  $in .= '?';
}

// request all the names of the authors a user follows
if (count($follow_authors) > 0) {
  $stmt = $pdo->prepare("SELECT username FROM users WHERE `ID` IN ($in)");
  $stmt->execute($follow_authors);
  $name_authors = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}

// // functions to request article title of the liked articles
$stmt = $pdo->prepare("SELECT `article-ID` FROM `liked-articles` WHERE `user-ID` = ?");
$stmt->execute([$userID]);
$liked_articles = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// set a variable amount of placeholders for the pdo prepare query
$in = "";
for ($i=0; $i < count($liked_articles); $i++) {
  if ($i > 0) {
    $in .= ',';
  }
  $in .= '?';
}

// request all the titles of the articles a user liked
if (count($liked_articles) > 0) {
  $stmt = $pdo->prepare("SELECT title FROM articles WHERE `ID` IN ($in)");
  $stmt->execute($liked_articles);
  $name_articles = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if(isset($_POST['reader-btn']) && $usertype === "author") {
    $stmt= $pdo->prepare("UPDATE users SET `type`=? WHERE id=?");
    $stmt->execute(["user", $userID]);
  }
  elseif (isset($_POST['author-btn']) && $usertype === "user") {
    $stmt= $pdo->prepare("UPDATE users SET `type`=? WHERE id=?");
    $stmt->execute(["author", $userID]);
  }
  $stmt = $pdo->prepare("SELECT `type` FROM users WHERE ID=?");
  $stmt->execute([$userID]);
  $usertype = $stmt->fetch()[0];
}

function translate($data) {
  if ($data === "author") {
    echo "auteur";
  }
  elseif ($data === "user") {
    echo "lezer";
  }
  elseif ($data === "admin") {
    echo "admin";
  }
}
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Geademos - home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="basic.css">
        <link rel="stylesheet" href="basic-page-style.css">
        <?php require "nav-bar-head.php" ?>
        <link rel="stylesheet" href="footer-style.css">
        <link rel="stylesheet" href="profile-style.css">
        <!-- function not in use, but is usefull for future -->
        <script>
          function show(shown, hidden) {
            document.getElementById(shown).style.display='block';
            document.getElementById(hidden).style.display='none';
            return false;
          }
        </script>
    </head>
    <body>
        <?php require 'nav-bar-body.php' ?>
        <div id="content-body">

          <div id="page1">
            <!-- container showing profile picture and username -->
            <div id="top-container">
              <img src="https://static.vecteezy.com/system/resources/thumbnails/005/544/718/small/profile-icon-design-free-vector.jpg" alt="stock-profile-pic">
              <h1> <?php echo $_SESSION["user-inf"]["username"]; ?></h1>
            </div>
            <div id="main-flex-container-profile">
              <!-- container showing stats about the profile -->
            <div id="content-profile">
              <h2>Mail: <?php echo $_SESSION["user-inf"]["mail"]; ?></h2>
              <h2>Gebruiker: <?php translate($usertype);?></h2>
              <h2>Aantal followers: <?php echo $follow_number; ?></h2>
              <h2>Totaal views: <?php echo $total_views; ?></h2>
              <h2>Totaal likes: <?php echo $total_likes; ?></h2>
            </div>
            <!-- container showing buttons for action an more stat pages of the user -->
            <div id="buttons-profile">
            <?php
            if ($_SESSION["user-inf"]["type"] == "user") {
              echo "<h2><a href='change-user.php'>Word auteur</a></h2>";
            } if ($_SESSION["user-inf"]["type"] == "admin") {
              echo "<h2><a href='screening-page.php'>Screen artikels</a></h2>";
            } if (!($_SESSION["user-inf"]["type"] == "user")) {
              echo "<h2><a href='article-list-user.php?u-name=" . $_SESSION["user-inf"]["username"]. "'>Jouw artikels</a></h2>";
            }

            if (!($_SESSION["user-inf"]["type"] == "user")) {
              echo "<h2><a href='article-maker.php'>Maak artikel</a></h2>";
            }

            ?>

            <h2><a href="liked-article-list.php">zie gelikete artikels</a></h2>
            <h2><a href="follow-list.php">zie gevolgde auteurs</a></h2>
            </div>
          </div>
        </div>
        </div>
        <?php include 'footer-body.php' ?>
    </body>
</html>