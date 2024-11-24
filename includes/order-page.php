<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customization</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
 

    .order-container {
        display: flex;
        background-color: #ffffff;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        padding: 20px;
        width: 1300px;
        height: 600px;
        margin-right: 50px; 
        position: relative;
    }

    .form-section {
        flex: 1;
        margin-right: 20px;
    }

    .size-chart-section {
        flex: 1.5;
        border-left: 1px solid #ddd;
        padding-left: 20px;
    }

    h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .form-group label {
        font-size: 14px;
        color: #666;
        margin-bottom: 4px;
    }

    .form-group input,
    .form-group select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .quantity-input {
        display: flex;
        align-items: center;
    }

    .quantity-input input {
        width: 60px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 8px;
        margin: 0 5px;
    }

    .quantity-input button {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        margin: 0 5px;
    }

    .quantity-input button:hover {
        background-color: #45a049;
    }

    .size-inputs {
        display: flex;
        gap: 10px;
    }

    .size-inputs input {
        flex: 1;
    }

    .place-order-btn {
        display:flex;
        flex-direction: column;
        padding: 12px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
    }

    .place-order-btn:hover {
        background-color: #45a049;
    }

    .size-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .size-table th,
    .size-table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: center;
        font-size: 14px;
    }

    .size-table th {
        background-color: #f5f5f5;
        font-weight: bold;
    }

    .payment-method {
        display: none;
    }

    .payment-method-header {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .payment-method-header label {
        font-size: 16px;
        color: #333;
        margin-right: 10px;
    }

    .payment-arrow {
        font-size: 16px;
        cursor: pointer;
        margin-left: 5px;
    }

    .modal-background {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-container {
        background-color: #fff;
        border-radius: 8px;
        width: 350px;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .modal-header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .payment-option {
        display: flex;
        align-items: center;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
    }

    .payment-option input {
        margin-right: 10px;
    }

    .confirm-btn {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }

    .confirm-btn:hover {
        background-color: #45a049;
    }

    .payment-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        border-top: 1px solid #ddd;
        font-size: 16px;
        cursor: pointer;
    }
    .payment-option label{
        margin-right: 260px;
        margin-top: 7px;
    }
    .payment-option i {
       
        flex-direction: column;
        font-size: 20px;
        color: #555;
        margin-right: 10px;
    }

    .dropdown-content {
        display: none;
        flex-direction: column;
        margin-top: 10px;
    }

    .dropdown-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-top: 1px solid #ddd;
        cursor: pointer;
    }

    .dropdown-item:hover {
        background-color: #f5f5f5;
    }

    .checkmark {
        display: none;
        color: green;
        font-weight: bold;
    }

    .confirm-btn {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }

    .confirm-btn:hover {
        background-color: #45a049;
    }

    .checkmark-circle {
        display: none;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        border: 2px solid green;
        border-radius: 50%;
        margin-left: 10px;
    }

    .checkmark-circle::after {
        content: '✔';
        font-size: 14px;
        color: green;
    }

    .order-close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }
    
    .order-toggle-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .payment-form {
        display: none;
    }

    #paypal-link{
        text-decoration: none;
    }
    
  </style>
  <script src="https://www.paypal.com/sdk/js?client-id=AU5THB8u5xqTfY6An508wUQgMHD_3iX4Ggpc86E21lAYcRlU_7fA83cmpnpUVQnzwnMZZPxOUeEQqwCL&currency=PHP"></script>
</head>
<body>
        <button class="order-toggle-btn" onclick="toggleOrderContainer()">Close</button>
        <div class="order-container">
            <button class="order-close-btn" onclick="closeOrderContainer()">&times;</button>
            <div class="form-section">
                <h2>Order</h2>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <div class="quantity-input">
                    <button type="button" onclick="decrementQuantity()">-</button>
                    <input type="number" id="quantity" value="1" min="1">
                    <button type="button" onclick="incrementQuantity()">+</button>
                </div>
            </div>

            <div class="form-group">
                <label>Size</label>
                <div class="size-inputs">
                    <input type="text" placeholder="Bust">
                    <input type="text" placeholder="Waist">
                    <input type="text" placeholder="Shoulder">
                </div>
            </div>

            <div class="form-group">
                <label for="fabric">Fabric</label>
                <select id="fabric">
                    <option value="cotton">Cotton</option>
                    <option value="polyester">Polyester</option>
                    <option value="linen">Linen</option>
                </select>
            </div>

            <div class="form-group">
                <label for="total">Total</label>
                <input type="text" id="total" placeholder="Total amount" readonly>
            </div>
            <button class="place-order-btn" onclick="openPaymentModal()">Select Payment Method</button>
            <button class="place-order-btn">Place Order</button>
        </div>
        <div class="payment-method-modal">
            
        </div>
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

    <div class="modal-background" id="paymentModal">
        <div class="modal-container">
            <button class="close-btn" onclick="closePaymentModal()">&times;</button>
            <div class="modal-header">Select Payment Method</div>
            <div class="payment-option">
                <input type="radio" id="paypal" name="payment" value="paypal">
                <label for="paypal">PayPal</label>
            </div>
            <div id="paypal-button-container" style="display:none;"></div>
        </div>
    </div>


        <script>
    // Increment the quantity
    function incrementQuantity() {
        var quantityInput = document.getElementById("quantity");
        quantityInput.value = parseInt(quantityInput.value) + 1;
    }

    // Decrement the quantity
    function decrementQuantity() {
        var quantityInput = document.getElementById("quantity");
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    }

    // Close the order container
    function closeOrderContainer() {
        const orderContainer = document.querySelector('.order-container');
        orderContainer.style.display = 'none';
    }

    // Toggle the order container visibility
    function toggleOrderContainer() {
        const orderContainer = document.querySelector('.order-container');
        const toggleButton = document.querySelector('.order-toggle-btn');
        if (orderContainer.style.display === 'none' || orderContainer.style.display === '') {
            orderContainer.style.display = 'flex'; // Show the container
            toggleButton.textContent = 'Close'; // Change the button text to 'Close'
        } else {
            orderContainer.style.display = 'none'; // Hide the container
            toggleButton.textContent = 'Open'; // Change the button text to 'Open'
        }
    }

    // Open the payment modal
    function openPaymentModal() {
        const paymentModal = document.getElementById('paymentModal');
        paymentModal.style.display = 'flex';
    }

    // Close the payment modal
    function closePaymentModal() {
        const paymentModal = document.getElementById('paymentModal');
        paymentModal.style.display = 'none';
    }

    // Show the PayPal button when PayPal is selected
    document.getElementById('paypal').addEventListener('change', function() {
        const paypalButtonContainer = document.getElementById('paypal-button-container');
        if (this.checked) {
            paypalButtonContainer.style.display = 'block';
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: 100.00 // Placeholder amount, adjust based on your calculation
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Transaction completed by ' + details.payer.name.given_name);
                    });
                }
            }).render('#paypal-button-container') ;
        } else {
            paypalButtonContainer.style.display = 'none';
        }
    });
</script>

  
</body>
</html>