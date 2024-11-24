<style>

.order-container {
    display: flex;
    background-color: grey;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    padding: 20px;
    max-width: 1400px; /* Maximum width for larger screens */
    height: 600px;
    width: 2200px;
    margin-top: 200px;
    margin-left: 400px;
    position: relative;
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
        display: flex;
        gap: 10px;
        border-radius: 10px;
        width: 150px;
        height: 40px;
        text-align: center; /* Center horizontally */
    padding: 10px; /* Adjust for vertical spacing if needed */
    font-size: 14px; /* Optional: Adjust font size */
    box-sizing: border-box; /* Ensure padding doesn't overflow */
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
    .size-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 40px;
        margin-left: 50px;
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

    .modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1000; /* Ensures it appears above other content */
    left: 0;
    top: 0;
    width: 100%; /* Full screen width for centering */
    height: 100%; /* Full screen height */
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: blue;
    padding: 30px;
    border-radius: 8px;
    text-align: center;
   
    max-width: 40%; /* Ensure it doesn't exceed screen size */
    height: 400px; /* Match the height of .order-container */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds shadow for depth */
}

.close-btn {
    float: right;
    font-size: 24px;
    cursor: pointer;
    color: white;
}

.payment-btn {
    display: block;
    margin: 15px auto;
    padding: 15px 20px;
    width: 80%;
    font-size: 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.payment-btn:hover {
    background-color: #0000FF;
}
</style>