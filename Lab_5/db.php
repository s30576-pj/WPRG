<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "mojaBaza";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}
?>
