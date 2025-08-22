
<?php
session_start();
include("../includes/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);

    $query = 
    "
        SELECT * 
        FROM employee
        WHERE email = ? 
        OR phone = ?
    ";
    $check = $conn->prepare($query);
    $check->bind_param("ss", $email, $phone);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['register_error'] = "Email or phone already registered.";
        header("Location: ../register.php");
        exit();
    }

    $insertquery = 
    "
        INSERT INTO employee (first_name, last_name, email, phone, password) 
        VALUES (?, ?, ?, ?, ?)
    ";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare($insertquery);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    } 
}
?>
