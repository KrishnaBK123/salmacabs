<?php
$servername = "localhost:3307";
$username = "root";
$password = ""; // Replace with your actual MySQL root password
$database = "slamacab";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
?>