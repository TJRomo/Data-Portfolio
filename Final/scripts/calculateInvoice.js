let products = [];
const tableBody = document.querySelector("#invoice-items tbody");
const totalDisplay = document.getElementById("total");
const totalInput = document.getElementById("totalInput");
const hiddenProductsField = document.getElementById("products_json");

function validateInvoiceForm() {
    if (products.length === 0) {
        alert("Please add at least one product to the invoice.");
        return false;
    }
    return true;
}

function addProduct() {
    const select = document.getElementById("product_id");
    const quantityInput = document.getElementById("quantity");
    const productId = select.value;
    const quantity = parseInt(quantityInput.value);
    const option = select.options[select.selectedIndex];
    const productName = option.dataset.name;
    const productPrice = parseFloat(option.dataset.price);
    let stock = parseInt(option.dataset.stock);

    if (quantity <= 0 || quantity > stock) {
        alert("Please select a quantity in stock.");
        return;
    }

    const subtotal = (productPrice * quantity).toFixed(2);
    products.push({ product_id: productId, name: productName, quantity, product_price: productPrice });

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>${productName}</td>
        <td>${quantity}</td>
        <td>$${productPrice.toFixed(2)}</td>
        <td>$${subtotal}</td>
        <td><button type="button" onclick="removeProduct('${productId}', this)">Remove</button></td>
    `;
    tableBody.appendChild(row);

    stock -= quantity;
    option.dataset.stock = stock;
    option.textContent = `${productName} ($${productPrice.toFixed(2)} - ${stock} in stock)`;

    updateTotal();
}

function removeProduct(id, button) {
    const removedProduct = products.find(p => p.product_id === id);
    products = products.filter(p => p.product_id !== id);
    button.closest("tr").remove();
    const select = document.getElementById("product_id");
    const option = Array.from(select.options).find(opt => opt.value === id);

    if (option && removedProduct) {
        let currentStock = parseInt(option.dataset.stock);
        const newStock = currentStock + removedProduct.quantity;

        option.dataset.stock = newStock;
        option.disabled = false;
        option.textContent = `${removedProduct.name} ($${removedProduct.product_price.toFixed(2)} - ${newStock} in stock)`;
    }

    updateTotal();
}

function updateTotal() {
    let total = 0;
    products.forEach(p => {total += p.quantity * p.product_price;});
    totalDisplay.textContent = total.toFixed(2);
    totalInput.value = total.toFixed(2);
    hiddenProductsField.value = JSON.stringify(products);
}