<!-- config.php -->

<?php
// Database connection settings
$servername = "localhost"; // Change this to your database server
$username = "root";        // Change this to your MySQL username
$password = "";            // Change this to your MySQL password
$dbname = "attendance_system"; // The name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
