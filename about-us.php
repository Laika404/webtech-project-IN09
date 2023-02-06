<?php session_start(); ?>

<!doctype html>
<html lang = "en">

<head>
  <link rel = "stylesheet" href = "basic.css">
  <link rel = "stylesheet" href ="article-style.css">
  <!-- Poging om ons logo erin te krijgen-->
  <link rel="icon" href="gea-icon.png" sizes="64x64">

  <!-- Schijnt te helpen met hoe de site eruit ziet als je het inlaat-->
  <meta name="viewport" content="width=device-width">

  <!-- Link naar css document-->
  <link rel="stylesheet" href="about-uscss.css">
  <title>Geademos - Over ons</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="gea-icon.png" sizes="64x64">
  <!--Icon libraries -->
  <?php require 'nav-bar-head.php'?>
  <link rel="stylesheet" href="nav-bar-style.css">
  <link rel="stylesheet" href= "footer-style.css">

	</style>
</head>

<body>
  <?php require 'nav-bar-body.php'?>
  <link rel="stylesheet" href="about-uscss.css">
  <article>
    <!-- Maakt titel tekst-->
    <h1 style="text-align: center; font-size:300%">About us</h1>

    <!-- Tekst-->
    <div id="big-image">
      <img class = "about-foto"id="team-foto" src="team.jpg" alt="Ons team">
    </div>
    <!-- Roept image op met class img2-->
    <div class="member-container">
    <img src= "foto-björn.jpg"
    alt="Plaatsvervanger" class="img2 about-foto" />
    <div class="member-container-text"><h1>Björn Smitt</h1><p>Hallo, Ik ben Björn Smitt en ik had de privilegé om de project leider te zijn tijdens dit project.
Ik was dus vooral bezig om de rest van het team aan het werk te houden.
Ook heb ik de deze About us pagina gemaakt en heb ik de webscraping gedaan.
Ik heb het erg naar mijn zin gehad dit project en hoop er nog meer te maken
in de toekomst.</p></div>
    </div>
    <div class="member-container">
    <img src= "foto-kevin.jpg"
    alt="Plaatsvervanger" class="img2 about-foto" />
    <div class="member-container-text"><h1>Kevin Jansen</h1><p>Ik ben eerstejaars informatica student aan de Universiteit van Amsterdam. Na een aantal jaren ronddolen in Leiden tussen de integralen ben ik hier beland. Bij GeaDemos voel ik me vrij om mijn ideeën tot werkelijkheid te brengen en samen een visie te creëren voor een nieuwe wereld.
Als ik niet achter de laptop zit ben ik te vinden in de keuken om te eten of eten te maken. Met Gordon Ramsey als mijn idool maak ik veel mensen in mijn huis blij.</p>
<br><p>PHP specialist met een passie voor queries.</p>
    </div>
    </div>
    <div class="member-container">
    <img src= "foto-sietse.jpg"
    alt="Plaatsvervanger" class="img2 about-foto" />
    <div class="member-container-text"><h1>Sietse van de Griend</h1><p>Hoi, ik ben Sietse, ik ben een eerste jaars student van informatica en hiervoor deed ik natuur en sterrenkunde. Ik ben tevens ook 1 van de teamleden van Geademos. Mijn rollen in dit project waren de github manager, de designer (home pagina, artikel en de basis pagina template design heb ik gemaakt). Daarnaast was ik ook de eindverantwoordelijke voor de samenhang code, maar dat werd uiteindelijk door iedereen gedaan. Tevens was mijn focus in dit project de artikelen. Ik heb namelijk volledig de artikel paginas, artikel thumbnails en de artikel maker gemaakt. Ik hoop dat jullie die uitchecken want die is echt cool (en veel werk). Daarnaast heb ik ook de home pagina gemaakt. </p>
  <br><p>Ik vond dit een erg leuk project en leuk team en hoop dat jullie de website ook gaaf vinden. (Test vooral de light / night mode knop).</p></div>
    </div>
    <div class="member-container">
    <img src= "foto-francesco.jpg"
    alt="Plaatsvervanger" class="img2 about-foto"/>
    <div class="member-container-text"><h1>Francesco Pavlović</h1><p>Francesco is een voormalige BSc Bestuurskunde student verandert in een BSc Informatica student.
Voor dit webtechwonder kreeg ik de verantwoordelijkheid om de login pagina te verzorgen en de meetings te faciliteren. Daarnaast kreeg ik de privilege om het trellobord te beheren.
Het was zeker een geweldige ervaring om het werk van mijn groep te kunnen faciliteren en zelf ook mooi werk te kunnen verrichten!</p></div>
    </div>
	</article>
  <?php require "footer-body.php" ?>
</body>

</html>
