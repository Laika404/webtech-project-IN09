<?php
session_start();

$name = $succes = $pass = $passrep = $mail = "";
$nameErr = $passErr = $passrepErr = $mailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "*Vul een username in";
  }
  else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z]+$/",$name)) {
      $nameErr = "*Alleen (hoofd)letters en geen whitespaces toegestaan";
    }
  }

  if (empty($_POST["mail"])) {
    $mailErr = "*Vul een email in";
  }
  else {
    $mail = test_input($_POST["mail"]);
    if (!preg_match("/^([\w\-\.]+\@([\w\-]+\.)+[\w\-]+)$/", $mail)) {
      $mailErr = "*Vul een geldig emailadres in";
    }
  }

  if (empty($_POST["pass"])) {
    $passErr = "*Vul een wachtwoord in";
  }
  else {
    $pass = test_input($_POST["pass"]);
  }

  if (empty($_POST["pass-repeat"])) {
    $passrepErr = "*Vul het wachtwoord nogmaals in";
  }
  else {
    $passrep = test_input($_POST["pass-repeat"]);
  }

  if (empty($nameErr) && empty($passErr) && empty($passrepErr) && empty($mailErr) &&
      $pass === $passrep) {
    require 'connect.php';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$name]);
    $userinfo = $stmt->fetch();
    if ($userinfo) {
      $nameErr = "*Username bestaat al";
    }
    $stmt = $pdo->prepare("SELECT * FROM users WHERE mail=?");
    $stmt->execute([$mail]);
    $userinfo = $stmt->fetch();
    if ($userinfo) {
      $mailErr = "*Email bestaat al";
    }
    if (empty($nameErr) && empty($mailErr)) {
      $stmt = $pdo->prepare("INSERT INTO users (username, mail, password, type) VALUES (?,?,?,?)");
      $stmt->execute([$name, $mail, password_hash($pass, PASSWORD_DEFAULT), "user"]);
      $succes = "*Je account is met succes aangemaakt!*";
    }
  }
  else if ($pass != $passrep) {
    $passrepErr = "*Er ging iets mis bij de wachtwoorden invullen";
  }
}

// test input function that removes unnecesarry/malicious characters
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <link href="style-account-aanmaken.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maak een account voor GeaDemos</title>
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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <h2>Account aanmaken</h2>
                    <p>Gebruikersnaam</p>
                    <input type="text" name="name" placeholder="Voer hier uw gebruikersnaam in"
                    value="<?php echo $name ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <p>E-mail</p>
                    <input type="text" name="mail" placeholder="Voer hier uw e-mail in"
                    value="<?php echo $mail ?>">
                    <span class="error"> <?php echo $mailErr; ?></span>
                    <p>Wachtwoord</p>
                    <input type="password" name="pass" id="pass" onkeyup="check();"
                    placeholder="Voer hier uw wachtwoord in">
                    <span class="error"> <?php echo $passErr; ?></span>
                    <p>Herhaal wachtwoord</p>
                    <input type="password" name="pass-repeat" id="pass-repeat"
                    onkeyup="check();" placeholder="Herhaal uw wachtwoord hier">
                    <span class="error"> <?php echo $passrepErr; ?></span>
                    <span class="error"> <?php echo $succes; ?></span>
                    <!-- Error message for password equality -->
                    <span id="message"></span>
                    <div id="knop-container">
                      <button type="submit" id="MeA-knop">Maak een account</button>
                    </div>
                </form>
                <!-- Used for shaping the buttons. -->
                <div id="knop-container-2">
                    <button type="button" onclick="location.href='login.php'">Terug naar Inloggen</button>
                </div>
            </div>
        </div>
    </main>
    <script src="password-check.js"></script>
</body>

</html>