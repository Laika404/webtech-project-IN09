<!-- Specific information -->
<?php 
$country_name = htmlspecialchars($_GET["c_name"]);
// Retrieving data from database.
require 'connect.php';
$stmt = $pdo->prepare("SELECT * FROM lands where name = :country_name");
$stmt->execute( array(':country_name' => $country_name));
$country_data = $stmt->fetch();


$country_information = $country_data['content'];
// You can choose between forest, jungle, mountain, sea, desert
$country_biome = $country_data['biome'];
// See actual table to see what each array entry means
$table_information_array = array($country_data["score"], 
$country_data["elections"],
$country_data["functionality"], 
$country_data["participation"], 
$country_data["culture"], 
$country_data["freedom"], 
$country_data["category"]);
// link to the search page for those articles.
$search_url = "search-page.php?search=&land-tag=" . $country_name;

?>

<!-- Template -->
<div class="country-information sided" id="<?php echo $country_name ?>">
            <div id=nav-filler>Je hebt me gevonden!!</div>
            <div id="country-above-image-container" class=<?php echo $country_biome ?>></div>
            <div id="country-text-container">
                <h1><?php echo $country_name ?></h1>
                <br><br>
                <h3>Algemene informatie</h3>
                <br>
                <p><?php echo $country_information ?></p>
                <br>
                <h3>Democratische statistieken</h3>
                <br>
                <!-- Democratic table data -->
                <table>
                    <tr>
                        <th>Statistiek</th>
                        <th>Waarde</th>
                        <th>Statistiek</th>
                        <th>Waarde</th>
                    </tr>
                    <tr>
                        <td title = 
"De gemiddelde punten aan de hand van alle andere parameters">Score</td>

                        <td><?php echo $table_information_array[0] ?></td>
                        <td title=
"Hier wordt gemeten hoe gescheiden religie en
andere mogelijke bestuursvormen 
zijn van de regering">Politieke cultuur</td>
                        <td><?php echo $table_information_array[4] ?></td>
                    </tr>
                    <tr>
                        <td title = 
"Hier wordt gekeken naar elementen, 
zoals veiligheid van de kiezers tijdens verkiezingen 
en het lopen van het rechtsprocess zonder 
dat een van de deelnemers een voordeel heeft.
                        ">Verkiezingen en pluralisme</td>
                        <td><?php echo $table_information_array[1] ?></td>
                        <td title = 
"Hier wordt gekeken naar elementen, zoals 
vrijheid van meningsuiting, internettoegang, scheiding der 
machten, openbare veiligheid en gelijkheid 
voor de wet.">Burgerlijke vrijheden</td>
                        <td><?php echo $table_information_array[5] ?></td>
                    </tr>
                    <tr>
                        <td title = 
"Hier wordt gekeken of enig element buiten 
de gekozen burgerregering invloed heeft, zoals het leger, 
buitenlandse mogendheden en religieuze groeperingen. 
Daarnaast wordt gekeken dingen zoals vertrouwen in de 
overheid, transparantie van het mandaat en 
invloed op het grondgebied.">Functioneren regering</td>
                        <td><?php echo $table_information_array[2] ?></td>
                        <td title = "De categorie van bestuursvorm">Categorie</td>
                        <td><?php echo $table_information_array[6] ?></td>
                    </tr>
                    <tr>
                        <td title = 
"De participatie van stemgerechtige bevolking 
met in het bijzonder vrouwen en minderheidsgroepen. 
Hierbij wordt ook gekeken naar de pogingen van de 
regering om de participatie van deze groepen 
te bevorderen">Politieke deelname</td>
                        <td><?php echo $table_information_array[3] ?></td>
                        <td></td>
                        <td></td>
                        <!-- Bron: https://www.definebusinessterms.com/nl/democratie-index/ -->

                    </tr>
                </table>
            </div>
            <br>
            <a id="article-button" href="<?php echo $search_url ?>">Zie alle artikelen: <?php echo $country_name ?></a>
            <!-- container that is used by css @media screen resizes -->
            <div id="extra-css-container">
            <!-- container that is used by javscript scrolling event etc.-->
            <div id="country-article-container">
            </div>
            </div>
</div>