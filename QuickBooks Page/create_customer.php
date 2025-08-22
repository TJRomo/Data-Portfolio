<?php
session_start();
include("includes/header.html");
include("includes/navigation.html");
?>
<main class="register-container">
    <h2>Register Customer</h2>

    <form method="post" action="scripts/customerProcess.php">
        <input type="text" name="first_name" placeholder="First Name" required><br><br>
        <input type="text" name="last_name" placeholder="Last Name" required><br><br>
        <input type="text" name="company_name" placeholder="Company" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="text" name="phone" placeholder="Phone" required><br><br>
        <button type="submit">Add Customer</button>
    </form>
    <br>
    <a href="customers.php">Back to customers</a>
</main>
