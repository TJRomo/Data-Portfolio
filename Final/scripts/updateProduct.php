<?php
session_start();
include("../includes/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $query = 
    "
        UPDATE product 
        SET price = ?, quantity = ? 
        WHERE product_id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("dii", $price, $quantity, $product_id);

    if ($stmt->execute()) {
        $_SESSION['product_message'] = "Product #$product_id updated.";
    } else {
        $_SESSION['product_message'] = "Update failed.";
    }

    header("Location: ../inventory.php");
    exit();
}
?>