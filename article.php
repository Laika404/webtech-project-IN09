<?php 
require 'connect.php';
session_start();

$article_id = htmlspecialchars($_GET["a-id"]);
$stmt = $pdo->prepare('SELECT * FROM `articles` WHERE `ID` = :article_id');
$stmt->execute(array(':article_id' => $article_id));
$article_data = $stmt->fetch();

// Check if user already liked the page
if (array_key_exists('user-inf', $_SESSION)) {
    $stmt = $pdo->prepare('SELECT * FROM `liked-articles` WHERE `article-ID` = :articleid AND `user-ID` = :userid');
    $stmt->execute(array(':articleid' => $article_id, ':userid' =>$_SESSION["user-inf"]["ID"]));
    $liked_data = $stmt->fetch();
}

//Check if article id exists
if ($article_data) {
} else {
    header("Location: not-exist.php");
    exit();
}

// Check if user has the right to see the article
if ($article_data['screened-tag'] == 0) {
    if (!(array_key_exists('user-inf', $_SESSION) && (($_SESSION['user-inf']['ID'] == $article_data['author-ID']) || ($_SESSION['user-inf']['type'] == 'admin')))) {
        header("Location: not-exist.php");
        exit();
    }
}

// Updates the amount of views
if ($article_data['screened-tag'] != 0) {
    $views_new= $article_data['views'] + 1;
    $stmt = $pdo->prepare('UPDATE `articles` SET `views` = :viewsnew WHERE `ID` = :article_id');
    $stmt->execute(array(':viewsnew' => $views_new, ':article_id' => $article_id));
}

?>


<!DOCTYPE html>
<html lang='nl'>
<head>
        <title><?php echo $article_data["title"]?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="basic.css">
        <?php require "nav-bar-head.php" ?>
        <link rel="stylesheet" href="article-style.css">
        <link rel="stylesheet" href="footer-style.css">
</head>
<body>
<?php require "nav-bar-body.php" ?>
<div id="article-body">
    <!-- if the article is not yet screened -->
    <?php if ($article_data['screened-tag'] == 0) {
        echo '<div id="screening-container">Dit artikel is nog niet zichtbaar, het is nog in behandeling...</div>';}?>
    <div id="title-container">
        <img src= '<?php echo $article_data["picture"] ?>' onerror="this.src = 'flowerfield.jpg'">
            <h1><?php echo $article_data["title"]?></h1>
            <p><b><?php echo $article_data["summary"]?></b></p>
    </div>
    <div id="small-information-container"><div>Datum geschreven: <?php echo $article_data["date"]; ?></div><div>Naam auteur:<a id="user-link" href="article-list-user.php?u-name=<?php echo $article_data["author-name"];?>"><?php echo $article_data["author-name"]; ?></a></div><div>Weergaven:<?php echo $article_data['views'];?></div><div>Likes:<span id="like-value"><?php echo $article_data['likes'];?></span></div></div>
    <div id="article-content-container">
        <?php echo $article_data["content"]; ?>
    </div>
    <div id="buttons-container"><div id="article-tags-container"><div>Tags:</div><a href="search-page.php?search=&land-tag=<?php echo $article_data["land-tag"]; ?>"><?php echo $article_data["land-tag"]; ?></a><a href="search-page.php?search=&subject-tag=<?php echo $article_data["subject-tag"]; ?>"><?php echo $article_data["subject-tag"]; ?></a></div>
    <!-- script that tells when the like button while be displayed and it's onclick event -->
    <?php
    if (array_key_exists('user-inf', $_SESSION) && $article_data['screened-tag'] != 0) {
        echo '<div id="like-container"><button id="like-button" onclick="';
        echo "likeClick(" . $_SESSION["user-inf"]["ID"] . "," . $article_id . ");";
        echo '"><i class="fa-regular fa-thumbs-up"></i></button><div id="like-text">Like!</div></div>
        <script src="like-script.js"></script>';
        if ($liked_data) {
            echo '<script>likeClick(0,0, false);</script>';
        }
    } else if ($article_data['screened-tag'] != 0){
        echo '<div id="like-container"><button id="like-button" onclick="likeClickRedirect()"><i class="fa-regular fa-thumbs-up"></i></button><div id="like-text">Like!</div></div>';
        echo '<script src="like-script-not-user.js"></script>';
    }
    ?>
    <!-- script that tells wheter the delete and approve buttons should be displayed -->
    <?php
    if (array_key_exists('user-inf', $_SESSION) && (($_SESSION['user-inf']['type'] == 'admin') || ($_SESSION['user-inf']['ID'] == $article_data['author-ID']))) {
    echo '<script src="admin-buttons.js"></script>';
    echo '<div id ="special-buttons-container"><div>Delete:</div><img id="delete-button" onclick="deleteClick('. $article_id . ')" title="delete artikel - Weet je het zeker?">';
    if ($article_data['screened-tag'] == 0 && ($_SESSION['user-inf']['type'] == 'admin')) {
        echo '<div style="margin-left: 5px;"> Keur goed:</div><img id="approve-button" onclick="approveClick('. $article_id .')" title="Goedkeuren - Weet je het zeker?"></div>';
    }
    echo '</div>';
    }
    ?>
    </div>
</div>
<?php include "footer-body.php" ?>
</body>
</html>