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
$table_information_array = array(1, 2, 3, 4, 5, 6, 7);
// link to the search page for those articles.
$search_url = "search-page.php?fsearch=" . $country_name;

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
                <table>
                    <tr>
                        <th>Statistiek</th>
                        <th>Waarde</th>
                        <th>Statistiek</th>
                        <th>Waarde</th>
                    </tr>
                    <tr>
                        <td >Score</td>
                        <td><?php echo $table_information_array[0] ?></td>
                        <td>Politieke cultuur</td>
                        <td><?php echo $table_information_array[4] ?></td>
                    </tr>
                    <tr>
                        <td>Verkiezingen en pluralisme</td>
                        <td><?php echo $table_information_array[1] ?></td>
                        <td>Burgerlijke vrijheden</td>
                        <td><?php echo $table_information_array[5] ?></td>
                    </tr>
                    <tr>
                        <td>Functioneren regering</td>
                        <td><?php echo $table_information_array[2] ?></td>
                        <td>Categorie</td>
                        <td><?php echo $table_information_array[6] ?></td>
                    </tr>
                    <tr>
                        <td>Politieke deelname</td>
                        <td><?php echo $table_information_array[3] ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <br>
            <a id="article-button" href="<?php echo $search_url ?>">Zie alle artikelen: <?php echo $country_name ?></a>
            <!-- container that is used by css @media screen resizes -->
            <div id="extra-css-container">
            <!-- container that is used by javscript scrolling event etc.-->
            <div id="country-article-container">
            <?php for ($i=0;$i <= 1; $i++) {
                   include 'article-thumbnail.php';
                } ?>
            </div>
            </div>
</div>