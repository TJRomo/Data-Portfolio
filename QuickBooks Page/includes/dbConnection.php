<?php
$host = "localhost";
$user = "root"; 
$pass = "root";
$db = "industrial_invoice_sys";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
