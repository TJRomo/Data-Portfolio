<?php
session_start();
include("includes/dbConnection.php");
include("includes/header.html");
include("includes/navigation.html");
?>

<main class="register-container">
    <h2>Add New Product</h2>

    <form method="POST" action="scripts/productProcess.php" enctype="multipart/form-data">
        <label for="name">Product Name:</label><br>
        <input type="text" name="name" required><br><br>
        <label for="price">Price:</label><br>
        <input type="number" name="price" placeholder="E.g. 100.05" required><br><br>
        <label for="quantity">Quantity:</label><br>
        <input type="number" name="quantity" required><br><br>
        <label for="image">Upload Product Image (optional):</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <button type="submit">Add Product</button>
    </form>
    <br>
    <a href="inventory.php">Back to inventory</a>
</main>

<?php include("includes/footer.html"); ?>
