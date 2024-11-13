<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">

<style>
  .order-container {
    width: 90%;
    max-width: 1000px;
    background-color: #fff;
    border-radius: 10px;
    padding: 30px;
    display: flex;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    justify-content: center;
    align-items: center;
  }

  .image-container {
    width: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-right: 30px;
  }

  .image-container img {
    width: 100%;
    max-width: 450px;
    border-radius: 8px;
    border: 1px solid black;
  }

  .separator {
    width: 2px;
    background-color: black;
    margin: 0 30px;
    margin-left: 10px;
  }

  .details-container {
    width: 50%;
    display: flex;
    flex-direction: column;
  }

  .details-container h2 {
    font-size: 2.0em;
    margin-bottom: 10px;
  }

  .details-container p {
    margin: 8px 0;
    color: #555;
    font-size: 1.1em;
  }

  .status-container {
    margin-top: 25px;
    padding-top: 15px;
  }

  .status-item {
    display: flex;
    align-items: center;
    margin: 12px 0;
    position: relative;
  }

  .status-dot {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background-color: #8bc34a; /* Green for completed */
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;
    font-weight: bold;
  }

  .status-item.inactive .status-dot {
    background-color: #ccc; /* Gray for inactive */
  }

  .status-item.current .status-dot::before {
    content: "✓"; /* Check mark for current status */
  }

  .status-item span {
    font-size: 1.1em;
    color: #555;
    margin-left: 20px;
  }

  .status-line {
    position: absolute;
    width: 3px;
    background-color: #ccc;
    top: 18px;
    bottom: -10px;
    left: 7px;
    z-index: 0;
  }

  .button-container {
    margin-top: 30px;
    display: flex;
    justify-content: flex-start;
  }

  .button-container button {
    background-color: #8bc34a;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 12px 25px;
    cursor: pointer;
    font-size: 1.1em;
  }

  .button-container button:hover {
    background-color: #7cb342;
  }
</style>

<div class="order-container">
  <div class="image-container">
    <img src="pimages/gray.jpg" alt="T-shirt">
  </div>

  <div class="separator"></div>

  <div class="details-container">
    <h2>T-Shirt</h2>
    <p>Size: Small 00 - 00 - 00</p>
    <p>Material: Cotton</p>
    <p>Quantity: 2 pcs</p>

    <div class="status-container">
      <div class="status-item">
        <div class="status-dot"></div>
        <span>08/12/2025 - Order Placed</span>
        <div class="status-line"></div>
      </div>
      <div class="status-item current">
        <div class="status-dot"></div>
        <span>10/12/2025 - Processing</span>
        <div class="status-line"></div>
      </div>
      <div class="status-item inactive">
        <div class="status-dot"></div>
        <span>12/12/2025 - Delivered</span>
      </div>
    </div>

    <div class="button-container">
      <button>Buy Again</button>
    </div>
  </div>
</div>
