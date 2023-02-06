<?php
session_start();

// define variables and set to empty values
$passwErr = $usernErr = $userpassErr = "";
$passw = $usern = "";
$userinf = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // if the field is empty, give error msg, if not check the input

  if (empty($_POST["usern"])) {
    $usernErr = "*Vul een username in";
  } else {
    $usern = test_input($_POST["usern"]);
  }

  if (empty($_POST["passw"])) {
    $passwErr = "*Vul een wachtwoord in";
  } else {
    $passw = test_input($_POST["passw"]);
  }

  // only connect to database and check inputs if there are no errors and there
  // are inputs in both form fields
  if (empty($passwErr) && empty($usernErr) && !empty($passw) && !empty($usern)) {
    require 'connect.php';
    // select a particular user by username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$usern]);
    $userinf = $stmt->fetch();

    // check if user exists and password matches to input
    // if it's not correct but data was still fetched then it means
    // the password was incorrect
    if ($userinf && password_verify($passw, $userinf['password']))
    {
      $_SESSION["authenticated"] = 1;
      $_SESSION["user-inf"] = $userinf;
      $host = 'https://' . $_SERVER['HTTP_HOST'];
      $path = rtrim(dirname($_SERVER['PHP_SELF']), "/\\");
      header("Location: $host$path/index.php");
      exit();
    } else {
      $userpassErr = "Username en/of wachtwoord is incorrect";
    }
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
    <link href="./style-login.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login op GeaDemos</title>
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
                    <h2 id="login">Login</h2>
                    <p>Username</p>
                    <input type="text" name="usern" placeholder="Voer hier uw username in"
                    value="<?php if (isset($_POST['usern'])) print test_input($_POST['usern']); ?>">
                    <span class="error"> <?php echo $usernErr;?></span>
                    <p>Wachtwoord</p>
                    <input type="password" name="passw" placeholder="Voer hier uw wachtwoord in">
                    <span class="error"> <?php echo $passwErr;?></span>

                    <span class="error"> <?php echo $userpassErr;?></span>
                    <div id="knop-container">
                      <button type="submit">Inloggen</button>
                    </div>
                </form>
                <!-- Used for shaping the buttons. -->
                <div id="knoppen-container-2">
                        <button id="a" type="button" onclick="location.href='wachtwoord-vergeten.php'">Wachtwoord vergeten</button>
                        <button id="b" type="button" onclick="location.href='account-aanmaken.php'">Maak een account</button>
                </div>
            </div>
        </div>
    </main>

</body>


</html>