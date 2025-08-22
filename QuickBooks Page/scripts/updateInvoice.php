<?php
session_start();
include("../includes/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $invoice_id = $_POST['invoice_id'];
    $status = $_POST['status'];

    $query = 
    "
        UPDATE invoice 
        SET status = ? 
        WHERE invoice_id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $invoice_id);

    if ($stmt->execute()) {
        $_SESSION['status_message'] = "Invoice #$invoice_id status updated.";
    } else {
        $_SESSION['status_message'] = "Update failed.";
    }

    header("Location: ../invoice_manager.php");
    exit();
}
?>
