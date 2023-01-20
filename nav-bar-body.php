<nav>
            <!-- Hidden drop down menu-->
            <div class="drop-down-content" id="left-drop">
                <div class="drop-but" id="drop-but-1"><a href="index.html">Wereldkaart</a></div>
                <div class="drop-but" id="drop-but-2"><a href="index.html">Artikelen</a></div>
                <div class="drop-but" id="drop-but-3"><a href="index.html">Over ons</a></div>
                <div class="drop-but" id="drop-but-4" onclick="changeNightMode()">Dag-modus</div>
                <div class="drop-but" id="drop-but-5"><a href="index.html">Log in</a></div>
                <div class="drop-but" id="drop-but-6"><a href="index.html">Profiel</a></div>
            </div>
            <!-- Hidden user drop down menu-->
            <div class="drop-down-content" id="user-drop"><div>Log in</div><div>Profiel</div></div>
            <!-- Navigation bar-->
            <div id="nav-main-bar">
                <!-- Left side of logo.-->
                <div id="left-nav"><div class="flex-container-nav">
                    <div class="nav-button" id="drop-down" onclick="clickDropButton()"><i class="fa fa-bars"></i></div>
                    <div class="nav-button" id="nav-search" width="10%" onclick="clickSearchButton()"><ion-icon name="search"></ion-icon></div>
                    <div id="search-bar"><form action="" method="post">
                        <input type="text" id="search-input" name="fname">
                    </form></div>
                    <div class="nav-button" id="nav-but-1"><a href="index.html">Wereldkaart</a></div>
                    <div class="nav-button" id="nav-but-2"><a href="index.html">Artikelen</a></div>
                </div></div>
                <!-- Logo and text.-->
                <div class="logo-text" style="padding-left:25px;"><b>Gea</b></div>
                <div id="middle-nav"><a href="index.html"><img  id="home-button" src="gea-website.png" alt="Geademos Home"></a></div>
                <div class="logo-text"><b>Demos</b></div>
                <!-- Right side of logo -->
                <div id="right-nav"><div class="flex-container-nav" style="flex-direction:row-reverse">
                    <div class="nav-button" id="user-button" onclick="clickUserButton()"><i class="fa-solid fa-user"></i> <i class="fa-solid fa-caret-down"></i></div>
                    <div class="nav-button"><a href="log_in.html">Inloggen</a></div>
                    <div class="nav-button" id="night-mode-but" onmouseenter="buttonDark()" onmouseleave="buttonLight()" onclick="changeNightMode()"><ion-icon name="sunny"></ion-icon></div>
                    <div class="nav-button" id="nav-but-3"><a href="index.html">Over ons</a></div>
                </div></div>
                <!-- Logo appears on the right when resizing to mobile size-->
                <div id="hidden-middle-nav"><a href="index.html"><img  id="home-button" src="gea-website.png" alt="Geademos Home"></a></div>
            </div>
            <!--Invisible div behind the nav bar, so text won't show up behind the nav bar-->
            <div id="nav-filler"></div>
            <script src="nav-bar-script.js"></script>
        </nav>