<?php include('includes/orderstyle.php'); ?>
<?php include('includes/header.php'); ?>

<div class="order-container">
    <form action="orderbackend.php" method="POST">
        <div class="form-section">
            <h2>Order</h2>
            <label class="form-label-price">Price: 200</label>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <div class="quantity-input">
                    <button type="button" onclick="decrementQuantity()">-</button>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" oninput="updateTotal()">
                    <button type="button" onclick="incrementQuantity()">+</button>
                </div>
            </div>
            <div class="form-group">
                <label>Size</label>
                <div class="size-inputs">
                    <input type="text" name="bust" placeholder="Bust">
                    <input type="text" name="waist" placeholder="Waist">
                    <input type="text" name="shoulder" placeholder="Shoulder">
                </div>
            </div>
            <div class="form-group">
                <label for="fabric">Fabric</label>
                <select id="fabric" name="fabric">
                    <option value="Cotton">Cotton</option>
                    <option value="Polyester">Polyester</option>
                    <option value="Linen">Linen</option>
                </select>
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="text" id="total" name="totalAmount" placeholder="Total amount" readonly>       
            </div>
            <button class="place-order-btn" type="submit" name="order">Place Order</button>
        </div>
    </form>
    <div class="size-chart-section">
            <h2>Size Chart</h2>
            <table class="size-table">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Bust(in)</th>
                        <th>Waist(in)</th>
                        <th>Shoulder(in)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>XS</td>
                        <td>30-32"</td>
                        <td>23-25"</td>
                        <td>14-15"</td>
                    </tr>
                    <tr>
                        <td>S</td>
                        <td>32-34"</td>
                        <td>25-27"</td>
                        <td>15-16"</td>
                    </tr>
                    <tr>
                        <td>M</td>
                        <td>36-38"</td>
                        <td>29-31"</td>
                        <td>16-17"</td>
                    </tr>
                    <tr>
                        <td>L</td>
                        <td>36-38"</td>
                        <td>29-31"</td>
                        <td>17-18"</td>
                    </tr>
                    <tr>
                        <td>XL</td>
                        <td>38-40"</td>
                        <td>31-33"</td>
                        <td>18-19"</td>
                    </tr>
                    <tr>
                        <td>XXL</td>
                        <td>40-42"</td>
                        <td>33-35"</td>
                        <td>19-20"</td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>

<script>
    const price = 200; // Fixed price

    document.addEventListener("DOMContentLoaded", () => {
        updateTotal();  // Initialize the total when the page loads
    });

    function updateTotal() {
        const quantity = parseInt(document.getElementById("quantity").value) || 0;
        const total = quantity * price;  // Calculate total using fixed price
        document.getElementById("total").value = total.toFixed(2);  // Update total in the input field
    }

    function incrementQuantity() {
        const quantityInput = document.getElementById("quantity");
        quantityInput.value = parseInt(quantityInput.value, 10) + 1;
        updateTotal();  // Ensure total is updated after increment
    }

    function decrementQuantity() {
        const quantityInput = document.getElementById("quantity");
        const currentQuantity = parseInt(quantityInput.value, 10);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            updateTotal();  // Ensure total is updated after decrement
        }
    }
</script>
