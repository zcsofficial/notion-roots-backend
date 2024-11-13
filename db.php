<?php
// Database connection details
$host = "localhost"; // Change if needed
$dbname = "notion_roots"; // Database name
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
