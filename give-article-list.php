<?php
require 'connect.php';
$search_string = htmlspecialchars($_GET['search']);
$order_on = htmlspecialchars($_GET['order-type']);
$descending = htmlspecialchars($_GET['descending']);
$amount = htmlspecialchars($_GET['amount']);
// Index where this file begins returning article thumbnails
$start_point = htmlspecialchars($_GET['start-point']);
$subject_tag = htmlspecialchars($_GET['subject-tag']);
$country_tag = htmlspecialchars($_GET['land-tag']);
$author_name = htmlspecialchars($_GET['author-name']);
$screened = htmlspecialchars($_GET['screened-tag']);
$get_count = htmlspecialchars($_GET['get-count']);
$query_array = array();

/* search term, if get_count == 1, it means the number of the amount of search 
results needs to be returned instead of the thumbnails themselves*/
if ($get_count == 1) {
    $query_string = "SELECT COUNT(`ID`) FROM `articles` where (`title` 
    LIKE :searchstring OR `summary` 
    LIKE :searchstring OR `content` LIKE :searchstring 
    OR `author-name` LIKE :searchstring) AND `screened-tag` = :screened ";
} else {
    $query_string = "SELECT `ID` FROM `articles` where (`title` 
    LIKE :searchstring OR `summary` 
    LIKE :searchstring OR `content` LIKE :searchstring 
    OR `author-name` LIKE :searchstring) AND `screened-tag` = :screened ";
}
$order_on_possible = array('unix', 'likes', 'views');
$descending_possible = array('ASC', 'DESC');

$query_array += array(':searchstring' => '%' . $search_string . '%', ':screened' => $screened);

if ($country_tag != "none") {
    $query_string .= "AND `land-tag` = :landtag ";
    $query_array += array(':landtag' => $country_tag);
}
if ($subject_tag != "none") {
    $query_string .= "AND `subject-tag` = :subjecttag ";
    $query_array += array(':subjecttag' => $subject_tag);
}

if ($author_name != "none") {
    $query_string .= "AND `author-name` = :authorname ";
    $query_array += array(':authorname' => $author_name);
}
// checking for sql injections on key and specified columns
if (!(in_array($order_on, $order_on_possible) && in_array($descending, $descending_possible))) {
    header("Location: error-page.php");
    exit();
}
if ($order_on == 'unix') {
    $order_on = "`unix-date`";
} else if ($order_on == 'likes'){
    $order_on = "`likes`";
} else if ($order_on == 'views'){
    $order_on = "`views`";
}
// The order in which the articles are given.
$order_string = "ORDER BY " . $order_on . " " .  $descending;
$query_string .= $order_string;

$stmt = $pdo->prepare($query_string);
$stmt->execute($query_array);

// gives the count of articles and exits the file
if ($get_count == 1) {
    echo $stmt->fetch()[0];;
    exit();
}

?>
<!-- Script with AJAX function which returns the article thumbnails-->
<script src="get-article-thumbnail.js"></script>

<?php 
// Articles before the starting point
for($i=0; $i < $start_point; $i++) {
    $stmt->fetch();
}
//making a div for the thumbnails
$div_id = htmlspecialchars($_GET["div-id"]);
echo "<section id=" . $div_id . "></section>";


// Using AJAX get the right amount of thumbnails by echoing script
for ($i=0; $i < $amount; $i++) {
    $article_id_fetch = $stmt->fetch();
    if ($article_id_fetch) {
        echo "<script>getArticleThumbnail(" . $article_id_fetch["ID"] . ", '" . $div_id ."')</script>";
    }
}
?>