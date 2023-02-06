<?php 
require 'connect.php';
session_start();

//name of the owner of the page
$user_inf = htmlspecialchars($_GET['u-name']);

$sensitive_visible = 0;
if ((array_key_exists('user-inf', $_SESSION)) && (($_SESSION['user-inf']['username'] == $user_inf) || ($_SESSION['user-inf']['type'] == 'admin'))) {
    $sensitive_visible = 1;
}

// Check if user exists
$stmt = $pdo->prepare("SELECT * FROM users where username = :uname");
$stmt->execute( array(':uname' => $user_inf));
if ($stmt->fetch()) {// if something is fetched it means the user exists.
} else {
    header("Location: not-exist.php");
    exit();
}

// Get author id.
$stmt = $pdo->prepare('SELECT `ID` FROM `users` WHERE `username` = :authorname');
$stmt->execute(array(':authorname' => $user_inf));
$author_id = $stmt->fetch()['ID'];

if (array_key_exists('user-inf', $_SESSION)) {
    // check if current user already follows author
    $stmt = $pdo->prepare('SELECT * FROM `followed-authors` WHERE `user-ID` = :userid AND `author-ID` = :authorid');
    $stmt->execute(array(':authorid' => $author_id, ':userid' =>$_SESSION["user-inf"]["ID"]));
    $follow_data = $stmt->fetch();
}




// Check aantal followers
$stmt = $pdo->prepare('SELECT COUNT(*) FROM `followed-authors` WHERE `author-ID` = :authorid');
$stmt->execute(array(':authorid' => $author_id));
$follow_number = $stmt->fetch()[0];



?>


<!DOCTYPE html>
<head>
        <title>Geademos - Artikelen van <?php echo $user_inf ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="basic.css">
        <link rel="stylesheet" href="basic-search-style.css">
        <link rel="stylesheet" href="article-thumbnail-style.css">
        <?php require "nav-bar-head.php" ?>
        <link rel="stylesheet" href="footer-style.css">
</head>
    <body>
    <?php require "nav-bar-body.php" ?>
    <div id="content-body">
        <?php 
        if ($sensitive_visible == 1) {
        echo '
        <div class="lower-border-div small-height"> 
            <h1 style="padding-left:2%;">' . $user_inf .  ': Artikelen in behandeling</h1>';
        
            if ((array_key_exists('user-inf', $_SESSION)) && ($_SESSION["user-inf"]["username"] != $user_inf)) {
                echo '<button id="follow-button" onclick="followUser('. $_SESSION['user-inf']['ID']. ',`' . $user_inf . '`)"><span id="follow-text">Volg</span> '.$user_inf.'!</button>';
                echo '<script src="follow-user.js"></script>';
                // initializes the follow button without making a request.
                if ($follow_data) {
                    echo '<script>followUser(0, 0, false);</script>';
                }
            }

        echo '
        </div>
        <div class= "article-thumbnails-container", id="screening-thumbnails">   
        </div>';
        }
        echo'   <div class="lower-border-div small-height"> 
            <h1 style="padding-left:2%;">'. $user_inf;
        
        if ($sensitive_visible == 1) {
            echo ': Artikelen zichtbaar </h1></div>';
        } else {
            echo ': Artikelen (Volgers: <span id="follow-number">'. $follow_number .'</span>)</h1>';
            if ((array_key_exists('user-inf', $_SESSION))) {
                echo '<button id="follow-button" onclick="followUser('. $_SESSION['user-inf']['ID']. ',`' . $user_inf . '`)"><span id="follow-text">Volg</span> '.$user_inf.'!</button>';
                echo '<script src="follow-user.js"></script>';
                // initializes the follow button without making a request.
                if ($follow_data) {
                    echo '<script>followUser(0, 0, false);</script>';
                }
            }
            echo '</div>';
        }
        ?>
        <div class= "article-thumbnails-container", id="normal-thumbnails">   
        </div>
    </div>
    <?php require "footer-body.php"?>
    <script src="get-articles-script.js"></script>
    <?php if ($sensitive_visible == 1) {
        echo '<script>getArticles("screening-thumbnails", {amount: 1000, screenedTag: 0, authorName:"'
        .$user_inf.'"});</script>';
    } ?>
    <script>getArticles("normal-thumbnails", {amount: 1000, authorName: '<?php echo $user_inf?>', thumbnailsDIVID: "extra-articles"});</script>

</body>