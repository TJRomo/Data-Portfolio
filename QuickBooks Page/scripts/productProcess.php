<?php
session_start();
include("../includes/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $imagePath = '';

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = "../product_images/";
        $publicPath = "product_images/";

        $imageName = basename($_FILES["image"]["name"]);
        $targetFile = $uploadDir . $imageName;
        $relativePath = $publicPath . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $relativePath;
        }
    }

    $query = 
    "
        INSERT INTO product (name, price, quantity, image) 
        VALUES (?, ?, ?, ?)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdis", $name, $price, $quantity, $imagePath);
    $stmt->execute();

    header("Location: ../create_product.php");
    exit();
}
