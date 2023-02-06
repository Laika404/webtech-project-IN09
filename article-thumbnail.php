<?php
session_start();
// connect to database and get the requested data.
require 'connect.php';
$article_id = htmlspecialchars($_GET["a-id"]);
$stmt = $pdo->prepare('SELECT * FROM `articles` WHERE `ID` = :article_id');
$stmt->execute(array(':article_id' => $article_id));
$article_data = $stmt->fetch();

// All the specific information for an article thumbnail
$image_url= $article_data['picture'];
$article_url='article.php?a-id=' . $article_id;
$article_title = $article_data['title'];
$article_brief= $article_data['summary'];
$article_tags = array($article_data['land-tag'], $article_data['subject-tag']);

// Screened articles can not be seen by not admins.
if ($article_data['screened-tag'] == 0) {
    if (!(array_key_exists('user-inf', $_SESSION) && (($_SESSION['user-inf']['type'] == 'admin') || ($_SESSION['user-inf']['ID'] == $article_data['author-ID'])))) {
        $image_url= "";
        $article_title= "restricted";
        $article_brief= "";   
        $article_tags = array();
    }
}
?>

<!-- An article thumbnail template -->
<a class="article-thumbnail" title="<?php echo $article_title ?>" href="<?php echo $article_url ?>"> 
    <div class='article-message'> 
    <img class= 'article-thumbnail-image' src='<?php echo $image_url?>' onerror = "this.src = 'flowerfield.jpg'";>
        <h1><?php echo $article_title ?></h1>
        <p><?php echo $article_brief ?></p>
    </div>
    <!-- All tags of this article -->
    <div class='article-tags-container'>
        <?php foreach ($article_tags as $single_tag) {
            echo '<div class="article-tag">';
            echo $single_tag;
            echo '</div>';
        }
        ?>
    </div>
</a>
