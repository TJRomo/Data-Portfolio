<?php
session_start();
include("includes/dbConnection.php");
include("includes/header.html");
include("includes/navigation.html");
include("scripts/getCustomer.php");

if (!isset($_SESSION['employee_id'])) {
    header("Location: index.php");
    exit();
}
?>

<main class="dashboard-container">
    <h2>Customer Management</h2>
    <a href="create_customer.php">➕ Add New Customer</a><br><br>
    <table class='customer-table'>
        <tr>
            <th>Customer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['customer_id']) ?></td>
                <td><?= htmlspecialchars($row['first_name']) ?></td>
                <td><?= htmlspecialchars($row['last_name']) ?></td>
                <td><?= htmlspecialchars($row['company_name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</main>

<?php include("includes/footer.html"); ?>

