<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customization</title>
    <style>
        .custom-header {
            display: flex;
            align-items: center;
            padding: 0 10px;
            width: 100%;
            height: 70px;
            background-color: #ffffff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); 
            position: relative;
        }

        .menu-icon {
            font-size: 30px;
            cursor: pointer;
            color: #333;
            margin-left: 6px;
        }

        .menu-icon:hover {
            color: gray;
        }

        .separator {
            height: 40px;
            width: 1px;
            background-color: #ccc;
            margin: 0 25px; 
        }

        .suggested-design {
            display: flex;
            align-items: center;
            font-size: 20px;
            color: #333;
            cursor: pointer;
            margin-left: 10px; 
        }

        .suggested-design:hover {
            color: gray;
        }

        .arrow-down {
            width: 30px;
            font-size: 30px;
            cursor: pointer;
            color: #333;
            margin-left: 10px;
        }

        .arrow-left-right {
            display: flex;
            flex-direction: row;
            width: 30px;
            font-size: 30px;
            cursor: pointer;
            color: #333;
            margin-left: 4px;
        }

        
        .modal-overlay {
            position: fixed; 
            top: 80px; 
            left: 15px; 
            display: none;
            z-index: 1000; 
        }

        .modal-content {
            background-color: #f9f9f9;
            padding: 30px 20px 20px; 
            border-radius: 8px;
            text-align: center;
            width: 280px; 
            position: relative; 
        }

        .close-icon {
            font-size: 24px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px; 
            color: #333;
        }

        
        button {
            width: 100%; 
            padding: 10px;
            margin: 5px 0; 
            border: none;
            border-radius: 5px;
            background-color: gray;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #CBD2A4; 
        }
        .place-order{
            display: flex;
            align-items: center;
            font-size: 20px;
            color: #333;
            cursor: pointer;
            margin-left: 10px;
        }
        .untitled-design{
            display: flex;
            align-items: center;
            font-size: 20px;
            color: #333;
            cursor: pointer;
            margin-left: 10px;
        }
        .notification-bell {
            display: flex;
            align-items: center; 
            justify-content: center; 
            width: 30px;
            font-size: 30px;
            cursor: pointer;
            color: #333;
            margin-left: -7px;
        }

        .user-arrow {
            display: flex;
            align-items: center; 
            justify-content: center; 
            width: 30px;
            font-size: 25px;
            cursor: pointer;
            color: #333;
            margin-left: 50px;
        }
        .play-arrow{
            display: flex;
            align-items: center; 
            justify-content: center; 
            width: 30px;
            font-size: 30px;
            cursor: pointer;
            color: #333;
            margin-left: 50px;
        }
        .shareBtn{
          margin-left:25px;
        }
    </style>
    
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <div class="custom-header">
        <span class="menu-icon" onclick="openModal()">☰</span>
        <div class="separator"></div>
        <div class="suggested-design">
            Suggested design 
        </div>
        <div class="arrow-down">
             <i class='bx bxs-chevron-down'></i>
        </div>
        <div class="separator"></div>
       <div class="arrow-left-right">
            <i class='bx bx-chevron-left'></i>
            <i class='bx bx-chevron-right'></i>
       </div>
       <div class="separator" style="margin-left: 40px;"></div> 
       <div class="place-order">
            Place Order
       </div>
       <div class="untitled-design" style="margin-left: 800px;">
        Untitled Design
       </div>
       <div class="separator" style="margin-left: 12px;"></div> 
       <div class="notification-bell">
        <i class='bx bxs-bell'></i>
       </div>
       <div class="user-arrow">
         <i class='bx bxs-user'></i><span><i class='bx bxs-chevron-down'></i></span>
       </div>
       <div class="play-arrow">
       <i class='bx bx-play'></i><span><i class='bx bxs-chevron-down'></i></span>
       </div>
       <div class="shareBtn">
        <button>Share</button>
       </div>
    </div>

    <div class="modal-overlay" id="menuModal">
        <div class="modal-content">
            <span class="close-icon" onclick="closeModal()">✖</span>
            <button onclick="handleMenuOption('newDesign')">New Design File</button>
            <button onclick="handleMenuOption('saveDesign')">Save as New Design</button>
            <button onclick="handleMenuOption('options')">Options</button>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("menuModal").style.display = "block"; 
        }

        function closeModal() {
            document.getElementById("menuModal").style.display = "none";
        }

        function handleMenuOption(option) {
            closeModal();
            alert("Selected option: " + option);
        }
    </script>
</body>
</html>
