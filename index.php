<?php session_start()?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Geademos - home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="basic.css">
        <?php require "nav-bar-head.php" ?>
        <link rel="stylesheet" href="home-body.css">
        <link rel="stylesheet" href="article-thumbnail-style.css">
        <link rel="stylesheet" href="country-information-side-style.css">
        <link rel="stylesheet" href="footer-style.css">
    </head>
    <body>
        <?php require 'nav-bar-home-body.php' ?>
        <!--first section below the navigation bar -->
        <section>
        <div id="home-info">
            <div class="home-information">
                <h1> Geademos </h1>
                <p> Wij, GeaDemos, hebben deze site gemaakt om de wereld een 
                    klein beetje democratischer te maken. We hopen dat door 
                    informatie beschikbaar te maken mensen een beter begrip 
                    kunnen krijgen met wat er aan de hand is in een land of 
                    op de wereld. Dit doen wij, als community, door artikelen 
                    te maken over dingen die relevant zijn totdat land.</p>
            </div>
            <div id="home-middle">
            </div>
            <div class="home-information">
                <h1>Nieuwste artikelen</h1>
                <div id="main-articles"></div>
            </div>
        </div>
        </section>
        <!-- country selector section -->
        <section>
        <div id="main-body">
        <div id="country-container">
            <h1>Noord en Centraal Amerika</h1>
            <!-- events for every .country-bar -->
            <?php $country_events = 'onclick="countryClick(this.id)" onmouseenter="countryEnter(this.id)" onmouseleave="countryLeave()"' ?>
            <!-- all country buttons -->
            <div class="country-bar" id="Canada" <?php echo $country_events ?> >Canada <span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span> </div>
            <div class="country-bar" id="Verenigde-staten" <?php echo $country_events ?>>Verenigde staten<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Cuba"  <?php echo $country_events ?>>Cuba<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Haïti"  <?php echo $country_events ?>>Haïti<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Dominicaanse-Republiek"  <?php echo $country_events ?>>Dominicaanse Republiek<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Mexico" <?php echo $country_events ?>>Mexico<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Guatemala"  <?php echo $country_events ?>>Guatemala<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Belize"  <?php echo $country_events ?>>Belize<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="El-Salvador"  <?php echo $country_events ?>>El Salvador<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Honduras"  <?php echo $country_events ?>>Honduras<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Nicaragua"  <?php echo $country_events ?>>Nicaragua<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Costa-Rica"  <?php echo $country_events ?>>Costa-Rica<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Panama"  <?php echo $country_events ?>>Panama<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <h1>Zuid-Amerika</h1>
            <div class="country-bar" id="Colombia"  <?php echo $country_events ?>>Colombia<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Venezuela"  <?php echo $country_events ?>>Venezuela<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Ecuador"  <?php echo $country_events ?>>Ecuador<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Guyana"  <?php echo $country_events ?>>Guyana<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Suriname"  <?php echo $country_events ?>>Suriname<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Peru"  <?php echo $country_events ?>>Peru<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Brazilië"  <?php echo $country_events ?>>Brazilië<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Bolivia"  <?php echo $country_events ?>>Bolivia<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Paraguay"  <?php echo $country_events ?>>Paraguay<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Uruguay"  <?php echo $country_events ?>>Uruguay<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Chili"  <?php echo $country_events ?>>Chili<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <div class="country-bar" id="Argentinië"  <?php echo $country_events ?>>Argentinië<span class="country-drop"> <i class="fa-solid fa-caret-down"></i></span></div>
            <!-- country information data is fetched by ajax and put into the country container -->
            <div id="ajax-country-container" style="position:relative; z-index:0;"></div>

        </div>
        </div>
        </section>
        <?php include 'footer-body.php' ?>
    <script src="get-articles-script.js"></script>
    <script src="home-body-script.js"></script>
    <!-- gets the thumbnails to show the most recent articles-->
    <script>getArticles("main-articles", {amount: 3, startPoint: 0});</script>
    </body>
</html>