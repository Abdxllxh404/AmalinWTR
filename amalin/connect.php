<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amalin_wtr";

$conn = new mysqli($servername, $username, $password) or die("Connection failed: " . $conn ->connect_error);
$conn->select_db($dbname) or die("Could not connect database" . $conn->connect_error);
mysqli_set_charset($conn, 'utf8');
?>



