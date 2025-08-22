<?php
session_start();
include('includes/dbConnection.php');
include('includes/header.html');
include('includes/navigation.html');
include('scripts/getInventory.php');

if (!isset($_SESSION['employee_id'])) {
    header("Location: index.php");
    exit();
}
?>

<main class="dashboard-container">
    <h2>Inventory</h2>
    <a href="create_product.php">➕ Insert Product</a><br><br>

    <table class="inventory-table">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Price($USD)</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <form method="POST" action="scripts/updateProduct.php">
                <tr>
                    <td><?= htmlspecialchars($row['product_id']) ?><input type="hidden" name="product_id" value="<?=$row['product_id'] ?>"></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><input type="number" name="price" placeholder= "E.g. 100.50" value="<?= htmlspecialchars($row['price']) ?>" required></td>
                    <td><input type="number" name="quantity" value="<?= htmlspecialchars($row['quantity']) ?>" required></td>
                    <td>
                        <?php if ($row['image']): ?>
                            <img src="<?= htmlspecialchars($row['image']) ?>" class="product-thumb">
                        <?php else: ?>
                            <span>No image</span>
                        <?php endif; ?>
                    </td>
                    <td><button type="submit">Save</button></td>
                </tr>
            </form>
        <?php endwhile; ?>
    </table>
</main>

<?php include('footer.html'); ?>
