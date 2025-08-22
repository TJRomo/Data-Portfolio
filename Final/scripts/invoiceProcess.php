<?php
session_start();
include("../includes/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $total = $_POST['total'];
    $invoice_date = $_POST['invoice_date'];
    $status = $_POST['status'];
    $products_json = $_POST['products_json'];

    $products = json_decode($products_json, true);
    $stmt = $conn->prepare("INSERT INTO invoice (customer_id, total, invoice_date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("idss", $customer_id, $total, $invoice_date, $status);

    if ($stmt->execute()) {
        $invoice_id = $stmt->insert_id;

        foreach ($products as $item) {
            $product_id = (int)$item['product_id'];
            $quantity = (int)$item['quantity'];
            $price = (float)$item['product_price'];

            $insertItem = $conn->prepare("INSERT INTO invoice_item (invoice_id, product_id, quantity, product_price) VALUES (?, ?, ?, ?)");
            $insertItem->bind_param("iiid", $invoice_id, $product_id, $quantity, $price);
            $insertItem->execute();

            $updateStock = $conn->prepare("UPDATE product SET quantity = quantity - ? WHERE product_id = ?");
            $updateStock->bind_param("ii", $quantity, $product_id);
            $updateStock->execute();
        }
        header("Location: ../invoice_manager.php");
        exit();
    }
}
?>
