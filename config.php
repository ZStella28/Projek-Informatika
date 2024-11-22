<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL kamu
$password = ""; // Ganti dengan password MySQL kamu
$dbname = "contact_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>