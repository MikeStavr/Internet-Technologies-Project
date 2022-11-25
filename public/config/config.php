<?php


$server = 'localhost';
$username = 'root';
$password = '';

$link = mysqli_connect($server, $username, $password, "restaurant");

if ($link === false) {
    die("Could not connect to database." . mysqli_connect_error());
}



require_once "setup.php";
?>