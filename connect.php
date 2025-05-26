<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    // Connect to the database
$conn = new mysqli('localhost', 'guqctdi_wad', 'asdfghjkl123456789', 'guqctdi_wad');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if (!$conn) {
    die("Something went wrong. Database is not connected;");
}


