<?php
// All the specific information for an article thumbnail
$image_url= 'https://media.istockphoto.com/id/1334419989/photo/3d-red-question-mark.jpg?s=612x612&w=0&k=20&c=bpaGVuyt_ACui3xK8CvkeoVQC-jczxANZTMXGKAE11E=';
$article_url='index.php';
$article_title = 'Artikel titel';
$article_brief= 'Vleermuizen zijn wettelijk beschermd, maar verliezen massaal hun verblijfplaatsen en worden soms zelfs gedood als wij onze woningen isoleren. De Raad van State moet de toekomst van de vleermuizen én die van de verduurzaming bepalen. "De isolatiebranche heeft tien, vijftien jaar als cowboys tekeer kunnen gaan."'; // Max ... words.
$article_tags = array("economie", "Brazilië", "Weet ik het");
?>

<!-- An article thumbnail template -->
 <a class="article-thumbnail" title="<?php echo $article_title ?>" href="<?php echo $article_url ?>"> 
    <div class='article-message'> 
    <img class= 'article-thumbnail-image' src=<?php echo $image_url?>>
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
