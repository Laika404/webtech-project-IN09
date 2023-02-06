<?php 
require 'connect.php';
session_start();
// If variable has not been given, there exists a backup value
if (array_key_exists('search', $_GET)) {
    $search_string = htmlspecialchars($_GET['search']);
} else {
    header("Location: error-page.php");
    exit();
}
if (array_key_exists('order-type', $_GET)) {
    $order_on = htmlspecialchars($_GET['order-type']);
} else {
    $order_on = 'unix';
}
if (array_key_exists('descending', $_GET)) {
    $descending = htmlspecialchars($_GET['descending']);
} else {
    $descending = 'DESC';
}
if (array_key_exists('amount', $_GET)) {
    $amount = htmlspecialchars($_GET['amount']);
} else {
    $amount = 5;
}
if (array_key_exists('page', $_GET)) {
    $page = htmlspecialchars($_GET['page']);
} else {
    $page = 0;
}
if (array_key_exists('subject-tag', $_GET)) {
    $subject_tag = htmlspecialchars($_GET['subject-tag']);
} else {
    $subject_tag = 'none';
}
if (array_key_exists('land-tag', $_GET)) {
    $country_tag = htmlspecialchars($_GET['land-tag']);
} else {
    $country_tag = 'none';
}
if (array_key_exists('author-name', $_GET)) {
    $author_name = htmlspecialchars($_GET['author-name']);
} else {
    $author_name = 'none';
}
if (array_key_exists('screened-tag', $_GET)) {
    $screened = htmlspecialchars($_GET['screened-tag']);
} else {
    $screened = 1;
}
?>


<!DOCTYPE html>
<head>
        <title>Zoek: <?php echo $search_string; ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="basic.css">
        <link rel="stylesheet" href="basic-search-style.css">
        <link rel="stylesheet" href="article-thumbnail-style.css">
        <?php require "nav-bar-head.php" ?>
        <link rel="stylesheet" href="footer-style.css">
</head>
    <body>
    <!-- nav bar is explicitly shown because of hidden form items-->
    <nav>
            <!-- Hidden drop down menu-->
            <div class="drop-down-content" id="left-drop">
                <div class="drop-but" id="drop-but-1"><a href="wereldkaart.php">Wereldkaart</a></div>
                <div class="drop-but" id="drop-but-2"><a href="search-page.php?search=">Artikelen</a></div>
                <div class="drop-but" id="drop-but-3"><a href="about-us.html">Over ons</a></div>
                <div class="drop-but" id="drop-but-4" onclick="changeNightMode()">Dag-modus</div>
                <?php
                      if (isset($_SESSION["authenticated"])) { ?>
                        <div class="drop-but" id="drop-but-5"><a href="logout.php">Uitloggen</a></div>
                      <?php } else { ?>
                        <div class="drop-but" id="drop-but-5"><a href="login.php">Inloggen</a></div>
                      <?php }
                ?>
                <div class="drop-but" id="drop-but-6"><a href=
                <?php 
                if (isset($_SESSION["authenticated"])) {
                    echo '"profile.php"';
                } else {
                    echo '"login.php"';
                }?>>Profiel</a></div>
                                <?php
                      if (isset($_SESSION["authenticated"])) { ?>
                        <div class="drop-but" id="drop-but-5"><a href="logout.php">Uitloggen</a></div>
                      <?php } else { ?>
                        <div class="drop-but" id="drop-but-5"><a href="login.php">Inloggen</a></div>
                      <?php }
                ?>
            </div>
            <!-- Hidden user drop down menu-->
            <div class="drop-down-content" id="user-drop"><div><a href=
            <?php 
                if (isset($_SESSION["authenticated"])) {
                    echo '"profile.php"';
                } else {
                    echo '"login.php"';
                }?>
            >Profiel</a></div><?php if (isset($_SESSION["authenticated"]) && (($_SESSION['user-inf']['type'] == 'author') || ($_SESSION['user-inf']['type'] == 'admin'))) {
                echo '<div><a href="article-maker.php">Maak artikel</a></div>';}
            ?>
            </div>
            <!-- Navigation bar-->
            <div id="nav-main-bar">
                <!-- Left side of logo.-->
                <div id="left-nav"><div class="flex-container-nav">
                    <div class="nav-button" id="drop-down" onclick="clickDropButton()"><i class="fa fa-bars"></i></div>
                    <div class="nav-button" id="nav-search" width="10%" onclick="clickSearchButton()"><ion-icon name="search"></ion-icon></div>
                    <div id="search-bar"><form action="search-page.php" method="get">
                        <input type="text" id="search-input" name="search">
                        <!-- hidden parameters that coincide with the current search page parameters -->
                        <input type="hidden" name="order-type" value='<?php echo $order_on ?>'>
                        <input type="hidden" name="descending" value='<?php echo $descending ?>'>
                        <input type="hidden" name="amount" value=<?php echo $amount ?>>
                        <input type="hidden" name="page" value=<?php echo $page ?>>
                        <input type="hidden" name="subject-tag" value='<?php echo $subject_tag ?>'>
                        <input type="hidden" name="land-tag" value='<?php echo $country_tag ?>'>
                        <input type="hidden" name="author-name" value='<?php echo $author_name ?>'>
                        <input type="hidden" name="screened-tag" value=<?php echo $screened ?>>
                    </form></div>
                    <div class="nav-button" id="nav-but-1"><a href="wereldkaart.php">Wereldkaart</a></div>
                    <div class="nav-button" id="nav-but-2"><a href="search-page.php?search=">Artikelen</a></div>
                </div></div>
                <!-- Logo and text.-->
                <div class="logo-text" style="padding-left:25px;"><b>Gea</b></div>
                <div id="middle-nav"><a href="index.php"><img  id="home-button" src="gea-website.png" alt="Geademos Home"></a></div>
                <div class="logo-text"><b>Demos</b></div>
                <!-- Right side of logo -->
                <div id="right-nav"><div class="flex-container-nav" style="flex-direction:row-reverse">
                    <div class="nav-button" id="user-button" onclick="clickUserButton()"><i class="fa-solid fa-user"></i> <i class="fa-solid fa-caret-down"></i></div>
                    <?php
                      if (isset($_SESSION["authenticated"])) { ?>
                        <div class="nav-button"><a href="logout.php">Uitloggen</a></div>
                      <?php } else { ?>
                        <div class="nav-button"><a href="login.php">Inloggen</a></div>
                      <?php }
                    ?>
                    <div class="nav-button" id="night-mode-but" onmouseenter="buttonDark()" onmouseleave="buttonLight()" onclick="changeNightMode()"><ion-icon name="sunny"></ion-icon></div>
                    <div class="nav-button" id="nav-but-3"><a href="about-us.php">Over ons</a></div>
                </div></div>
                <!-- Logo appears on the right when resizing to mobile size-->
                <div id="hidden-middle-nav"><a href="index.php"><img  id="home-button" src="gea-website.png" alt="Geademos Home"></a></div>
            </div>
            <!--Invisible div behind the nav bar, so text won't show up behind the nav bar-->
            <div id="nav-filler"></div>
            <script src="nav-bar-script.js"></script>
            <script src="dark-mode.js"></script>
            <script src="light-mode.js"></script>
        </nav>

    <div id="content-body">
        <div class="lower-border-div small-height"> 
            <h1 style="padding-left:2%; display:inline-block">
            <!-- span used by java-script -->
            <span id="article-count"></span>  <span id="search-page-zoek">Zoekresultaten</span> voor: <?php echo $search_string; ?></h1>
            <!-- container showing all buttons-->
            <div id="inline-button-container">
            <div class="label-tag">order-tag:</div>
            <select id="order-options" name="order-tag" onchange="">
                <option value="unix">Datum</option>
                <option value="likes">Likes</option>
                <option value="views">Views</option>
            </select>
            <div class="label-tag">richting-tag:</div>
            <select id="by-options" name="by-tag" onchange="">
                <option value="ASC">Oplopend</option>
                <option value="DESC">Aflopend</option>
            </select>
            
            <div class="label-tag">land-tag:</div>
            <select id="land-tag-options" name="aland-tag" onchange="">
                <?php 
                $stmt = $pdo->prepare('SELECT name FROM lands');
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                }
                ?>
                <option value="none">Kies</option>
            </select>  
        <div class="label-tag">onderwerp-tag:</div>
            <select id="subject-tag-options" name="asubject-tag" onchange="">
                <option value="Economie">Economie</option>
                <option value="Politiek">Politiek</option>
                <option value="Wetenschap">Wetenschap</option>
                <option value="none">Kies</option>
        </select>
        <!-- page control system -->
        <button id="page-back" onclick="clickPageButton(-1)"><</button> 
        <div class="label-tag" id="page-label">Pagina: <?php echo $page ?></div>
        <button id="page-further" onclick="clickPageButton(+1)">></button>   
            </div>
        </div>
        <!-- div in which the article thumbnail will be shown -->
        <div class= "article-thumbnails-container", id="alotof-thumbnails">   
        </div>
        </div>
    <?php require "footer-body.php"?>
    <script src="search-page-script.js"></script>
    <script src="get-articles-script.js"></script>
    <script>
    // used for the page buttons
    var amount = <?php echo $amount ?>;
    var page = <?php echo $page ?>;
    var articleCount = 0;
    // Runs to get the article count and after that it runs the callBackScript
    getArticles("article-count", {
    searchString: '<?php echo $search_string; ?>',
    orderType:'<?php echo $order_on; ?>',
    descending:'<?php echo $descending; ?>',
    subjectTag:'<?php echo $subject_tag; ?>',
    countryTag:'<?php echo $country_tag; ?>',
    authorName:'<?php echo $author_name; ?>',
    screenedTag:<?php echo $screened; ?>,
    useFunction: 1,
    getArticleCount: 1
    }, false, callbackScript);

    // needs to run when getArticles is loaded
    function callbackScript(articleCount) {
        amount = <?php echo $amount ?>;
        page = <?php echo $page ?>;
        articleCount = articleCount;

        // Determines of page number is out of bounds
        while (page*amount > articleCount) {
            page--;
            $("#page-label").html("Pagina: " + page)
        }
        
        // Determines if page buttons should be shown
        if (page == 0) {
            $("#page-back").css("display", "none");
        }
        if (((page+1)*amount) > articleCount) {
            $("#page-further").css("display", "none");
        }

        // Gets the thumbnails of the search results
        getArticles("alotof-thumbnails", {
            searchString: '<?php echo $search_string; ?>',
            orderType:'<?php echo $order_on; ?>',
            descending:'<?php echo $descending; ?>',
            amount:<?php echo $amount;?>,
            startPoint:<?php echo $amount*$page; ?>,
            subjectTag:'<?php echo $subject_tag; ?>',
            countryTag:'<?php echo $country_tag; ?>',
            authorName:'<?php echo $author_name; ?>',
            screenedTag:<?php echo $screened; ?>,
            thumbnailsDIVID: "give-articles-1"
        });
        // changes buttons when initializing the page
        changeButtons('<?php echo $descending; ?>', '<?php echo $order_on; ?>','<?php echo $country_tag; ?>', '<?php echo $subject_tag; ?>');
        }
        // gets the string with get parameters for the new search request
        function redirectSearch() {
            return getArticles("nothing", {
            searchString: '<?php echo $search_string; ?>',
            orderType:$("#order-options").val(),
            descending:$("#by-options").val(),
            amount:<?php echo $amount;?>,
            startPoint:amount*page,
            subjectTag:$("#subject-tag-options").val(),
            countryTag:$("#land-tag-options").val(),
            authorName:'<?php echo $author_name; ?>',
            screenedTag:<?php echo $screened; ?>,
        }, true);
        }
        
        // funtion that happens when you click on the page buttons
        function clickPageButton(pageAmount) {
            page += pageAmount;
            window.location.href = "search-page.php?" + redirectSearch() +"&page=" + page;
        }
        // If any other button is changed, the user will be redirected to the new search page
        $("select").change(function(){
            window.location.href = "search-page.php?" + redirectSearch();
        });
    </script>

</body>
