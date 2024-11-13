<style>
    * {
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
}

.dashboard {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: 20px;
  width: 90%;
  max-width: 1200px;
}

/* Left Section (New Orders) */
.new-orders {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  margin-top: 200px;
  
}

.order-list .order {
  margin-top: 3px;
  font-weight: bold;
}

.order-item {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  
  margin-top: 5px;
}

/* Right Section (Order Details & Confirmed Orders) */
.order-details {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

.order-info-container {
  display: flex;
  flex-direction: row; /* Change to row for side-by-side layout */
  gap: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  align-items: flex-start;
  height:500px;
}

.order-info {
  padding: 5px;
  flex: 1;
  border: 1px solid #ddd;
  border-radius: 8px;
  width: 300px; /* Adjust width to fit content */
  margin: 5px;
  display: flex;
  flex-direction: column;
  gap: 10px; /* Space between each label and value */
  background-color: #eaeaea;

}

.order-info p {
  display: flex;
  justify-content: space-between; 
  padding: -10px;
  margin: 5px 20px 5px 20px;
  
}

.order-image {
  flex: 1;
  background-color: #eaeaea;
  height: 300px; /* Adjust height as needed */
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px;
  padding-bottom: 20px;
  height: 300px;
}

.order-image p {
  margin: 0;
  
}

/* Order actions buttons style */


.order-actions button {
  padding: 10px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: 300px;
  margin-left: 25px;
  margin-bottom:20px;
  
}

.accept {
  background-color: #6DA067; 
  color: black;
}

.accept:hover {
  background-color: #4CAF50;
  transition: 0.3s;
}

.decline {
  background-color: #6DA067;
  color: black;
  margin-bottom:5px;
}

.decline:hover {
  background-color: #4CAF50;
  transition: 0.3s;
}
.confirmed-orders {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  margin-top: 20px;
  width: 790px;
  margin-left: 420px;
}


.confirmed-orders table {
  width: 100%;
  border-collapse: collapse;
}

.confirmed-orders th, .confirmed-orders td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  text-align: left;
}

.confirmed-orders th {
  background-color: #f9f9f9;
}
</style>

<div class="container">
  <div class="dashboard">
    <div class="new-orders">
      <div class="order-list">
        <div class="order-item">
          <span class="order">Product</span>
          <span class="order">Quantity</span>
        </div>
        <div class="order-item">
          <span>T-Shirt</span>
          <span>153</span>
        </div>
        <div class="order-item">
          <span>Jersey</span>
          <span>507</span>
        </div>
        <div class="order-item">
          <span>Jacket</span>
          <span>200</span>
        </div>
      </div>
    </div>

    <!-- Order Details & Confirmed Orders Section -->
    <div class="order-details">
      <!-- Combined Order Info & Image Container -->
      <div class="order-info-container">
      
        <!-- Order Info on the Left -->
        <div class="order-info">
          <p><strong>Order ID:</strong><span>103546</span></p>
          <p><strong>Product:</strong><span>T-Shirt</span></p>
          <p><strong>Size:</strong><span>Small</span></p>
          <p><strong>Fabric:</strong><span>Cotton</span></p>
          <p><strong>Quantity:</strong><span>153</span></p>
          <p><strong>Date:</strong><span>09/13/2024</span></p>
          <p><strong>Payment:</strong><span>E-Wallet</span></p>
        <div class="order-actions">
        <button class="accept">Accept</button>
        <br>
        <button class="decline">Decline</button>
      </div>
        </div>
       
       
        <!-- Order Image on the Right -->
        <div class="order-image">
          <p>Image Placeholder</p>
        </div>
        
      </div>

      <!-- Order Actions (Buttons) under Order Info -->
     
    </div>
  </div>

  <!-- Confirmed Orders Section -->
  <div class="confirmed-orders">
    <h2>Confirmed Orders</h2>
    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Product</th>
          <th>Size</th>
          <th>Quantity</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>103546</td>
          <td>T-Shirt</td>
          <td>Small</td>
          <td>153</td>
        </tr>
        <tr>
          <td>203566</td>
          <td>Jacket</td>
          <td>Large</td>
          <td>203</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
