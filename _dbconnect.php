<?php
session_start();
$servername = "localhost";
$username = "root";  // Default username for XAMPP
$password = "";      // Default password for XAMPP
$dbname = "users1";   // Ensure this is the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  // Output the error message if connection fails
}
?>
