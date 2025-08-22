<?php
session_start();
include("includes/header.html");
?>

<main class="register-container">
    <div class="logo">
        <img src="images/company_logo.png" alt="Company Logo">
    </div>

    <h2>Register New Employee</h2>

    <?php if (isset($_SESSION['register_error'])): ?>
        <p style="color: red;"><?= $_SESSION['register_error']; unset($_SESSION['register_error']); ?></p>
    <?php endif; ?>

    <form method="post" action="scripts/registerProcess.php" id="registerForm">
        <label>First Name:</label><br>
        <input type="text" name="first_name" required><br><br>
        <label>Last Name:</label><br>
        <input type="text" name="last_name" required><br><br>
        <label>Company Email:</label><br>
        <input type="email" name="email" id="email" required><br><br>
        <label>Phone:</label><br>
        <input type="text" name="phone" id="phone" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
    <br>
    <a href="index.php">Back to login</a>
</main>

<script src="scripts/emailValidation.js"></script>

