<?php 
require 'connect.php';
session_start();
// only accesible if author or admin
if (!(array_key_exists('user-inf', $_SESSION) && (($_SESSION['user-inf']['type'] == 'author') || ($_SESSION['user-inf']['type'] == 'admin')))) {
    header("Location: not-exist.php");
    exit();
}

$stmt = $pdo->prepare('SELECT name FROM lands');
$stmt->execute();
?>

<!DOCTYPE html>
<html lang='nl'>
<head>
        <title>Geademos - Artikel editor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="basic.css">
        <?php require "nav-bar-head.php" ?>
        <link rel="stylesheet" href="article-maker-style.css">
        <link rel="stylesheet" href="footer-style.css">
</head>
<body>
<?php require "nav-bar-body.php" ?>

<section>
<!-- text editor body -->
<div id="text-editor-container-outer">
<div id="text-editor-container-button">
<button onclick="addTextField()">+ tekstvak</button><button onclick="addSubTitle()">+ subtitelvak</button>
</div>
<div id="text-editor-container-inner">
<form action="article-made.php" method="post">
    <h1> Titel artikel: <span class="gray"> (Max 90 karakters)</span> </h1>
    <textarea class="article-text-field article-title-field" maxlength="90" name="atitle"></textarea>
    <h1> Samenvattende tekst: <span class="gray"> (Max 850 karakters)</span> </h1>
    <textarea class="article-text-field article-summary-field" maxlength="850" name="asummary"></textarea>
    <h1> URL - Plaatje <span class="gray"> (Max 300 karakters)</span> </h1>
    <textarea class="article-text-field article-url-field" maxlength="300" name="aimage"></textarea>
    <h1 id="character-count"> Content: <span class="gray"> (0/5000 karakters)</span> </h1>
    
    <div id=super-article-editor-content-container>
    <div class="article-editor-content-container">
        <div class= "article-content-title"><h2> Subtitel <h2></div>
        <textarea class="article-text-field article-subtitle-field"></textarea>
        <img class="delete-button" title="delete section">
    </div>
    <div class="article-editor-content-container">
    <div class= "article-content-title"><h2> Tekst <h2></div>
        <textarea class="article-text-field article-content-field"></textarea>
        <img class="delete-button" title="delete section">
    </div>
    </div>
</div>
<!-- tag buttons -->
<div id="tag-container">
<div class="label-tag">land-tag:</div>
    <select id="land-tag-options" name="aland-tag" onchange="canSubmit()">
        <?php 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
        ?>
        <option value="none" selected="selected">Kies</option>
  </select>  
  <div class="label-tag">onderwerp-tag:</div>
    <select id="subject-tag-options" name="asubject-tag" onchange="canSubmit()">
        <option value="none" selected="selected">Kies</option>
        <option value="Economie">Economie</option>
        <option value="Politiek">Politiek</option>
        <option value="Wetenschap">Wetenschap</option>
  </select></div>
  <div id="submit-button">
    <div id="make-button-wrong" onclick="showAlert()">Maak Artikel</div>
    <!-- make button while be displayed by javascript -->
    <input id ="make-button" style="display:hidden;" type="submit" value="Maak Artikel">
</div>
</form>
</div>

<?php require "footer-body.php"?>
<script src="article-maker-script.js"></script>
<!-- Elements here can be coppied and appended to "text-editor-content-container -->
<div id="hidden-text-elements-container" style="display: none;">
<div class="article-editor-content-container">
        <div class= "article-content-title"><h2> Subtitel <h2></div>
        <textarea class="article-text-field article-subtitle-field"></textarea>
        <img class="delete-button" title="delete section">
    </div>
    <div class="article-editor-content-container">
    <div class= "article-content-title"><h2> Tekst <h2></div>
        <textarea class="article-text-field article-content-field"></textarea>
        <img class="delete-button" title="delete section">
</div>
</div>
</body>
</html>