<!DOCTYPE html>
<html lang="nl">

<head>
    <link href="style-wachtwoord-vergeten.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maak een nieuw wachtwoord voor GeaDemos</title>
    <link rel="icon" href="gea-icon.png" sizes="64x64">
</head>

<body>
    <main>
        <!-- Formatting the image and text outside of the rectangle. -->
        <h1>GeaDemos</h1>
        <div id="main-img-container">
            <img src="gea-website.png" alt="GeaDemos Logo">
        </div>
        <!-- Used to make the rectangle and text fields. -->
        <div id="rectangle-container">
            <div id="rectangle">
                <h2>Wachtwoord vergeten of veranderen</h2>
                <h3>Voer uw e-mailadres in om een nieuw wachtwoord aan te
                    vragen.</h3>
                <p>E-mail</p>
                <input type="text" placeholder="Voer hier uw e-mail in">
                <div id="knop-container">
                    <button id="a" type="button"> Nieuw wachtwoord aanmaken </button>
                </div>
                <!-- Used for shaping buttons-->
                <div id="knop-container-2">
                    <button id="b" type="button" onclick="location.href=
                        'login.php'">Terug naar Inloggen</button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>