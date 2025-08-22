<?php
session_start();
include("../includes/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = 
    "
        SELECT * 
        FROM employee 
        WHERE email = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['employee_id'] = $row['employee_id'];
            $_SESSION['employee_name'] = $row['first_name'] . ' ' . $row['last_name'];
            header("Location: ../dashboard.php");
            exit();
        }
    }
    $_SESSION['login_error'] = "Invalid email or password.";
    header("Location: ../index.php");
    exit();
}
?>
