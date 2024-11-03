<?php
  include 'includes/header-order.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    /* Main layout styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #e5e5e5;
      display: flex;
      justify-content: center;
    }
    table {
      width: 90%;
      margin: 20px auto;
      background-color: #fff;
      border-collapse: collapse;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      vertical-align: middle; /* Aligns content in the middle */
    }
    th {
      background-color: #f9f9f9;
      font-weight: bold;
      text-align: center;
    }
    td {
      text-align: center;
    }
    .product-info {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      padding-left: 15px; 
      margin-left: 15px;
    }
    .product-info input[type="checkbox"] {
      margin-right: 12px;
    }
    .product-info img {
      width: 60px;
      height: 60px;
      border-radius: 8px;
      margin-right: 12px;
      object-fit: cover;
    }
    .product-info span {
      margin-left: 10px; /* Adjust this value to align the text with the header */
    }
    .footer-row td {
      font-weight: bold;
    }
    .align-left {
      text-align: left; /* Applies left alignment */
    }
  </style>
</head>
<body>

  <!-- Order Table -->
  <table>
    <!-- Table Header -->
    <thead>
      <tr>
        <th>Product</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Actions</th>
      </tr>
    </thead>

    <!-- Table Body -->
    <tbody>
      <tr>
        <td class="product-info">
          <input type="checkbox">
          <img src="pimages/gray.jpg" alt="T-shirt Small">
          <span>T-shirt Small</span>
        </td>
        <td>P 100</td>
        <td>2</td>
        <td>200</td>
        <td>
          <span>Cancel</span>
          <span>▼</span>
        </td>
      </tr>
    </tbody>

    <!-- Table Footer -->
    <tfoot>
      <tr class="footer-row">
        <td colspan="2" class="align-left"><input type="checkbox"> Select all</td>
        <td>Cancel</td>
        <td>Total (1 Item): 200</td>
        <td>Total Quantity: 2</td>
      </tr>
    </tfoot>
  </table>

</body>
</html>