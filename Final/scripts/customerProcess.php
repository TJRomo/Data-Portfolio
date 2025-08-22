<?php
session_start();
include("../includes/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = trim($_POST['first_name']);
    $last = trim($_POST['last_name']);
    $company = trim($_POST['company_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $stmt = $conn->prepare("INSERT INTO customer (first_name, last_name, email, phone, company_name) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first, $last, $email, $phone, $company);
    $stmt->execute();

    header("Location: ../create_customer.php");
    exit();
}
?>
