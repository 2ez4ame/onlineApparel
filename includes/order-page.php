<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #D9D9D9;
            margin: 0;
        }

        .order-container {
            display: flex;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
            width: 1300px;
            height: 600px;
            margin-right: 50px; 
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
            -moz-appearance: textfield; /* Remove spinner controls in Firefox */
        }

        .quantity-input input::-webkit-outer-spin-button,
        .quantity-input input::-webkit-inner-spin-button {
            -webkit-appearance: none; /* Remove spinner controls in Chrome, Safari, Edge, and Opera */
            margin: 0;
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
            padding: 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
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
    </style>
</head>
<body>
    <div class="order-container">
        <!-- Form Section on the Left -->
        <div class="form-section">
            <h2>Order</h2>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <div class="quantity-input">
                    <button type="button" onclick="decrementQuantity()">-</button>
                    <input type="number" id="quantity" value="1" min="1"> <!-- Input for quantity -->
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

            <button class="place-order-btn">Place Order</button>
        </div>

        <!-- Size Chart Section on the Right -->
        <div class="size-chart-section">
            <h2>Sizes</h2>
            <table class="size-table">
                <tr>
                    <th>Size</th>
                    <th>Bust (in)</th>
                    <th>Waist (in)</th>
                    <th>Shoulder (in)</th>
                </tr>
                <tr>
                    <td>XS</td>
                    <td>30-32</td>
                    <td>23-25</td>
                    <td>14-15</td>
                </tr>
                <tr>
                    <td>S</td>
                    <td>32-34</td>
                    <td>25-27</td>
                    <td>15-16</td>
                </tr>
                <tr>
                    <td>M</td>
                    <td>34-36</td>
                    <td>27-29</td>
                    <td>16-17</td>
                </tr>
                <tr>
                    <td>L</td>
                    <td>36-38</td>
                    <td>29-31</td>
                    <td>17-18</td>
                </tr>
                <tr>
                    <td>XL</td>
                    <td>38-40</td>
                    <td>31-33</td>
                    <td>18-19</td>
                </tr>
                <tr>
                    <td>XXL</td>
                    <td>40-42</td>
                    <td>33-35</td>
                    <td>19-20</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>