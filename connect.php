<?php
// Makes a connection to the server.
$servername = "localhost";
$username = "query-handler";
$database_name = "webtech-database";
$password = "oejZFuywBAtV7jfY";

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$database_name", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
