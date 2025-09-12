<?php
// setup_database.php
$host = 'localhost';
$user = 'root';
$pass = 'Dicy';

// Create connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS database";
if ($conn->query($sql)) {
    echo "Database created successfully<br>";
} 
else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select database
$conn->select_db('database');

// Create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "Table 'users' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

echo "Database setup complete!";
?>