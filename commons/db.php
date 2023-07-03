<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "social_medyas";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>