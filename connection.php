<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$database = new mysqli("localhost", "root", "", "mydb");

// Check connection
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}
?>
