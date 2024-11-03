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
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
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
      margin: 0 15px; 
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
      align-items: center;
      gap: 10px; 
    }

    .arrow-left-right i {
      font-size: 24px;
      cursor: pointer;
      color: #333;
    }

    .arrow-left-right i:hover {
      color: gray;
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

    .play-arrow {
      display: flex;
      align-items: center; 
      justify-content: center; 
      width: 30px;
      font-size: 30px;
      cursor: pointer;
      color: #333;
      margin-left: 50px;
    }

    .shareBtn button {
      margin-left: 25px;
      margin-right: 20px;
      padding: 10px 20px;
      border: none;
      background-color: #697565;
      color: white;
      font-size: 16px;
      cursor:  pointer;
      border-radius: 7px;
    }
    .shareBtn button:hover {
      background-color: #CBD2A4;
      transition: 1s;
    }
    .design-name-input {
      font-size: 20px;
      color: #333;
      cursor: pointer;
      margin-left: 10px;
      border: 1px solid #ccc; 
      padding: 5px; 
      outline: none;
      background: none;
    }
    .place-order a{
        text-decoration: none;
        color:black;
        font-size:15px;
        cursor: pointer;
    }
    .place-order a:hover{
        color:green;
    }
    #modelContainer {
      width: calc(100% - 250px); /* Adjust width to account for sidebar */
      height: calc(100vh - 70px); /* Adjust height to account for header */
      margin: 70px 0 0 250px; /* Adjust margins to avoid overlapping with header and sidebar */
      border: 2px solid #ccc;
      border-radius: 10px;
      overflow: hidden;
      position: relative;
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
      <i class='bx bx-undo'></i>
      <i class='bx bx-redo'></i>
    </div>
    <div class="separator" style="margin-left: 40px;"></div> 
    <div class="place-order" style="font-size: 15px; text-decoration:none;"   >
      <a href="javascript:void(0);" onclick="loadOrderForm()">Place an order</a>
    </div>
    <input type="text" id="designName" class="design-name-input" placeholder="Untitled Design" style="margin-left: 800px; border: 1px solid #ccc; padding: 5px;">
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
  
  <div id="modelContainer">
    <div id="container3D" style="width: 100%; height: 100%;"></div> <!-- Adjust the container3D to fit within the modelContainer -->
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
        window.onload = function() {
        const savedDesignName = localStorage.getItem("designName") || "Untitled Design";
        document.getElementById("designName").value = savedDesignName;
        };

        
        document.getElementById("designName").addEventListener("input", function() {
        localStorage.setItem("designName", this.value);
        });

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

        function loadOrderForm() {
    
    let existingOrderForm = document.getElementById('order-form-container');
    
    if (existingOrderForm) {
        
        existingOrderForm.scrollIntoView(); 
        return;
    }

    const orderFormContainer = document.createElement('div'); 
    orderFormContainer.id = 'order-form-container'; 
    orderFormContainer.style.marginTop = '80px';
    orderFormContainer.style.padding = '20px'; 
    
    fetch('includes/order-page.php') // Use Fetch API to get the order form
        .then(response => response.text())
        .then(data => {
            orderFormContainer.innerHTML = data; 
            document.body.appendChild(orderFormContainer); 
            orderFormContainer.scrollIntoView(); 
        })
        .catch(error => console.error('Error loading order form:', error));
}
</script>
  </script>
</body>
</html>