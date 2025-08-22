<?php
session_start();
include("includes/dbConnection.php");
include("includes/header.html");
include("includes/navigation.html");
include("scripts/getInvoices.php");

if (!isset($_SESSION['employee_id'])) {
    header("Location: index.php");
    exit();
}
?>

<main class="dashboard-container">
    <form method="GET" action="invoice_manager.php">
        <input type="text" name="search" placeholder="Search by name or company" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">Search</button>
    </form>

    <h2>Invoice List</h2>
    <a href="create_invoice.php">➕ Create New Invoice</a><br><br>

    <table class='invoice-table'>
        <tr>
            <th>Invoice ID</th>
            <th>Customer</th>
            <th>Company</th>
            <th>Total ($)</th>
            <th>Invoice Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <form method="POST" action="scripts/updateInvoice.php">
                <tr>
                    <td><?= htmlspecialchars($row['invoice_id']) ?><input type="hidden" name="invoice_id" value="<?= $row['invoice_id'] ?>"></td>
                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['company_name']) ?></td>
                    <td><?= htmlspecialchars(number_format($row['total'], 2)) ?></td>
                    <td><?= htmlspecialchars($row['invoice_date']) ?></td>
                    <td>
                        <select name="status" class="status-dropdown">
                            <option value="Unpaid" <?= $row['status'] === 'Unpaid' ? 'selected' : '' ?>>Unpaid</option>
                            <option value="Paid" <?= $row['status'] === 'Paid' ? 'selected' : '' ?>>Paid</option>
                            <option value="Overdue" <?= $row['status'] === 'Overdue' ? 'selected' : '' ?>>Overdue</option>
                        </select>
                    </td>
                    <td><button type="submit">Save</button></td>
                </tr>
            </form>
        <?php endwhile; ?>
    </table>
</main>

<?php include("includes/footer.html"); ?>
