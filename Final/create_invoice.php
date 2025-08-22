<?php
session_start();
include("includes/dbConnection.php");
include("includes/header.html");
include("includes/navigation.html");
?>

<main class="register-container">
    <h2>Create New Invoice</h2>

    <form method="POST" action="scripts/invoiceProcess.php" onsubmit="return validateInvoiceForm();">
        <label for="customer_id">Customer:</label><br>
        <select name="customer_id" id="customer_id" required>
            <option value="">Select Customer</option>
            <?php
                $query = "SELECT customer_id, first_name, last_name, company_name FROM customer";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    $name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name'] . ', ' . $row['company_name']);
                    echo "<option value=\"{$row['customer_id']}\">{$name}</option>";
                }
            ?>

        </select><br>

        <h3>Add Products</h3>

        <label for="product_id">Product:</label><br>
        <select id="product_id">
            <option value="">Select Product</option>
            <?php
            $productQuery = "SELECT * FROM product ORDER BY name";
            $products = $conn->query($productQuery);
            while ($product = $products->fetch_assoc()) {
                $name = htmlspecialchars($product['name']);
                $price = number_format($product['price'], 2);
                $quantity = $product['quantity'];
                echo "<option value=\"{$product['product_id']}\" 
                            data-name=\"{$name}\"
                            data-price=\"{$product['price']}\"
                            data-stock=\"{$quantity}\">
                        {$name} (\${$price} - {$quantity} in stock)
                    </option>";
            }
            ?>
        </select><br><br>
        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" min="1"><br><br>
        <button type="button" onclick="addProduct()">➕ Add Product</button><br><br>

        <h3>Invoice Items</h4>
        
        <table id="invoice-items">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <br>
        <label>Total: $<span id="total">0.00</span></label>
        <input type="hidden" name="total" id="totalInput"><br><br>
        <label for="invoice_date">Invoice Date:</label><br>
        <input type="date" name="invoice_date" id="invoice_date" required><br><br>
        <label for="status">Status:</label><br>
        <select name="status" id="status" required>
            <option value="Unpaid">Unpaid</option>
            <option value="Paid">Paid</option>
            <option value="Overdue">Overdue</option>
        </select><br><br>
        <input type="hidden" name="products_json" id="products_json">
        <button type="submit">Create Invoice</button>
    </form>
</main>

<script src="scripts/calculateInvoice.js"></script>

<?php include("includes/footer.html"); ?>
