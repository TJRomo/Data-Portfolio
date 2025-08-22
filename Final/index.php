<?php
session_start();
include("includes/header.html");
?>

<main class="login-container">
    <div class="logo">
        <img src="images/company_logo.png" alt="Company Logo">
    </div>

    <h2>Employee Login</h2>

    <form method="post" action="scripts/indexLoginProcess.php">
        <label>Company Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
    <br>
    <a href="register.php">Register</a>
</main>
