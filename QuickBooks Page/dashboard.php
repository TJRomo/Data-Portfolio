<?php
session_start();
include("includes/header.html");
include("includes/navigation.html");

if (!isset($_SESSION['employee_id'])) {
    header("Location: index.php");
    exit();
}
?>

<main class="dashboard-container">
	<h2>Welcome, <?= htmlspecialchars($_SESSION['employee_name']) ?></h2>
	<nav>
		<ul class="dash-links">
			<li><a href="invoice_manager.php">🧾 Invoice Manager</a></li>
			<li><a href="inventory.php">📦 Inventory</a></li>
			<li><a href="customers.php">👥 Customers</a></li>
			<li><a href="reports.php">📊 Reports</a></li>
			<li><a href="settings.php">⚙️ Settings</a></li>
			<li><a href="logout.php">🚪 Logout</a></li>
		</ul>
	</nav>
</main>

<?php include("includes/footer.html"); ?>
