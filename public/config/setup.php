<?php

require("config.php");

function consoleLog($msg)
{
    echo "<script> console.log($msg) </script>";
}

$sql = "CREATE DATABASE IF NOT EXISTS restaurant";
if (mysqli_query($link, $sql)) {
    consoleLog("Created database 'restaurant'.");
} else {
    consoleLog("Error! Error occurred while attempting to use database restaurant! " . mysqli_error($link));
}


$sql = "USE restaurant";
if (mysqli_query($link, $sql)) {
    echo consoleLog("Using database \"restaurant\" successfully!");
} else {
    consoleLog("Error! Error occurred while attempting to use database restaurant! " . mysqli_error($link));
}

$sql = "CREATE TABLE IF NOT EXISTS users(
    userID INT(10) AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    telephone VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    key(userID)
);";

if (mysqli_query($link, $sql)) {
    echo consoleLog("Created \"users\" successfully!");
} else {
    echo consoleLog("Error! Error occurred while creating users! " . mysqli_error($link));
}


$sql = "CREATE TABLE IF NOT EXISTS reservations(
    reservationID INT(10) AUTO_INCREMENT,
    userID INT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    telephone VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    date VARCHAR(255) NOT NULL,
    time VARCHAR(255) NOT NULL,
    people INT,
    comments VARCHAR(255),
    key(reservationID)
);";

if (mysqli_query($link, $sql)) {
    echo consoleLog("Created \"reservations\" successfully!");
} else {
    echo consoleLog("Error! Error occurred while creating users! " . mysqli_error($link));
}

$sql = "CREATE TABLE IF NOT EXISTS orders(
    orderID INT AUTO_INCREMENT,
    reservationFullName VARCHAR(255),
    orderList VARCHAR(255) NOT NULL,
    key(orderID)
);";

if (mysqli_query($link, $sql)) {
    echo consoleLog("Created \"orders\" successfully!");
} else {
    echo consoleLog("Error! Error occurred while creating users! " . mysqli_error($link));
}