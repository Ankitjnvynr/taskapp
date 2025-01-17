<?php
$servername = "sql107.ezyro.com";
$username = "ezyro_33857799";
$password ="Ankit@";
$db = "ezyro_33857799_mytask";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>