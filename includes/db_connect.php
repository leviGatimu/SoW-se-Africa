<?php
$servername = "localhost";
$username = "root";       // Default XAMPP user
$password = "";           // Default XAMPP password is empty
$dbname = "sowise_db";    // Ensure this matches your phpMyAdmin DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Stop everything if DB fails, but don't show ugly errors to users
    die("Connection failed: " . $conn->connect_error);
}
?>