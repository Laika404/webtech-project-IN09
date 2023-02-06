<nav>
            <!-- Hidden drop down menu-->
            <div class="drop-down-content" id="left-drop">
                <div class="drop-but" id="drop-but-1"><a href="wereldkaart.php">Wereldkaart</a></div>
                <div class="drop-but" id="drop-but-2"><a href="search-page.php?search=">Artikelen</a></div>
                <div class="drop-but" id="drop-but-3"><a href="about-us.php">Over ons</a></div>
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
                if (isset($_SESSION["authenticated"]) && $_SESSION["user-inf"]["type"] == "admin") {
                    echo '<div class="drop-but" id="drop-but-6"><a href="screening-page.php">Screen artikelen</a></div>';
                }
                if (isset($_SESSION["authenticated"]) && !($_SESSION["user-inf"]["type"] == "user")) {
                    echo '<div class="drop-but" id="drop-but-6"><a href="article-maker.php">Maak artikel</a></div>';
                }
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
            ?>                            <?php 
            if (isset($_SESSION["authenticated"]) && $_SESSION["user-inf"]["type"] == "admin") {
                echo '<div><a href="screening-page.php">Screen artikelen</a></div>';
            } ?>
            </div>
            <!-- Navigation bar-->
            <div id="nav-main-bar">
                <!-- Left side of logo.-->
                <div id="left-nav"><div class="flex-container-nav">
                    <div class="nav-button" id="drop-down" onclick="clickDropButton()"><i class="fa fa-bars"></i></div>
                    <div class="nav-button" id="nav-search" width="10%" onclick="clickSearchButton()"><ion-icon name="search"></ion-icon></div>
                    <div id="search-bar"><form action="search-page.php" method="get">
                        <input type="text" id="search-input" name="search">
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
            <script src="dark-mode.js"></script>
            <script src="light-mode.js"></script>
            <script src="nav-bar-script.js"></script>
        </nav>
