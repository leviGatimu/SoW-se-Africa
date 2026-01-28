<?php
// Database Configuration
$host = "localhost";
$user = "root";       // Default XAMPP/WAMP username
$pass = "";           // Default XAMPP/WAMP password (leave empty)
$db_name = "sowise_db";

// Create Connection
$conn = new mysqli($host, $user, $pass, $db_name);

// Check Connection
if ($conn->connect_error) {
    // If it fails, stop everything and show the error
    die("❌ Connection failed: " . $conn->connect_error);
}

// Optional: Set charset to handle special characters correctly
$conn->set_charset("utf8mb4");
?>