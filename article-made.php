<?php
// When an article is made, run this file to insert it into the database 
require 'connect.php';
function redirect_error() {
    header('Location: error-page.php');
    exit();
}

session_start();

if (count($_POST) == 0) {
    redirect_error();
}

/* convert post variables to php variables */
$content = "";
foreach ($_POST as $key => $value) {
    if ($key == "atitle") {
        $title = htmlspecialchars($value);
    }
    elseif ($key == "asummary") {
        $summary = htmlspecialchars($value);
    }
    elseif ($key == "aimage") {
        $image = htmlspecialchars($value);
    }
    elseif (strpos($key, "asubtitle") !== false) {
        $content .= "<h2>" . htmlspecialchars($value) . "</h2>";
    }
    elseif (strpos($key, "atext") !== false) {
        $content .= "<p>" . htmlspecialchars($value) . "</p>";
    }
    elseif ($key == "aland-tag" && $value == 'none') {
        redirect_error();
    }
    elseif ($key == "asubject-tag" && $value == 'none') {
        redirect_error();
    }
    elseif ($key == "aland-tag") {
        $land_tag = htmlspecialchars($value);
    }
    elseif ($key == "asubject-tag") {
        $subject_tag = htmlspecialchars($value);
    }
    else {
        redirect_error();
    }
}
$article_date = date("Y-m-d");
$article_date_exact = time();
// insert article into database
$stmt = $pdo->prepare("INSERT INTO `articles` (`title`, `summary`, `content`, `author-ID`, `author-name`, `date`, `picture`, `land-tag`, `subject-tag`, `screened-tag`, `unix-date`, `views`, `likes`) 
VALUES (:atitle, :asummary, :acontent, :authorid, :authorname, :adate, :apicture, :alandtag, :asubjecttag, 0, :unixdate, 0, 0)");
$stmt->execute(array(':atitle' => $title, ':asummary' => $summary, ':acontent' => $content, 'authorid' =>$_SESSION['user-inf']['ID'], ':authorname' => $_SESSION['user-inf']['username'], ':adate' => $article_date, ':apicture' => $image, ':alandtag' => $land_tag, ':asubjecttag' => $subject_tag, ':unixdate' => $article_date_exact));

//Get the correct article back to load the article
$stmt = $pdo->prepare("SELECT ID FROM `articles` WHERE title = :atitle ORDER BY `unix-date` DESC");
$stmt->execute(array(':atitle' => $title));
$article_id = $stmt->fetch()[0];
header('Location: article.php?a-id=' . $article_id);
exit();
?>