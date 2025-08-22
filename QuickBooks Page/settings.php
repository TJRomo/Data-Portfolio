<?php
session_start();
include('includes/dbConnection.php');
include('includes/header.html');
include('includes/navigation.html');

if (!isset($_SESSION['employee_id'])) {
    header("Location: index.php");
    exit();
}
?>

<main class='dashboard-container'>
    <p>Coming soon...<p>
</main>

<?php include('footer.html'); ?>