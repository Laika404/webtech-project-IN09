<?php session_start(); ?>

<!DOCTYPE html>
<head>
        <title>Geademos - Cookie</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="basic.css">
        <link rel="stylesheet" href="basic-page-style.css">
        <?php require "nav-bar-head.php" ?>
        <link rel="stylesheet" href="footer-style.css">
        <link rel="icon" href="gea-icon.png" sizes="64x64">
        <link rel="stylesheet" href="nav-bar-style.css">
        <!--Icon libraries -->
        <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
        <script src="https://kit.fontawesome.com/f0df45953b.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
  <?php require "nav-bar-body.php" ?>
  <div id="content-body">
    <div class="lower-border-div small-height">
      <h1> Cookies</h1>
    </div>
    <br>
    Geademos maakt gebruik van cookies. Door gebruik te maken van onze website ga
    je akkoord met het plaatsen van (niet-essentiële) cookies. Je kunt cookies uitschakelen
    in je browser, mocht je geen gebruik willen maken van onderstaande diensten.
    Wij houden deze pagina actueel door nieuwe cookies toe te voegen wanneer ze op de
    website verschijnen.
    Wij gebruiken de volgende cookies:
    <br><br>
    <h3>Geanonimiseerde analytische cookies</h3> worden gebruikt om bij te houden wanneer je
    een artikel bekijkt op onze website. Deze cookie is niet terug te leiden tot uw
    individu en wordt alleen gebruikt voor analytische doeleinden.
    <br><br>
    <h3>Persistent cookies</h3> worden gebruikt om bij te houden of je night-mode hebt ingeschakeld
    op de website. Deze cookies vervallen na 30 dagen en worden alleen gebruikt om uw ervaring te
    personaliseren.
    <br><br>


    Voor meer informatie over cookies, zie
    <a href="https://autoriteitpersoonsgegevens.nl/nl/onderwerpen/internet-telefoon-tv-en-post/cookies?qa=cookies">
      Cookies
    </a>
    van de Autoriteit Persoonsgegevens (AP).
  </div>
  <?php require "footer-body.php"?>
</body>