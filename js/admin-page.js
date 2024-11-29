function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('expanded');
  }
  function loadContent(url) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('content').innerHTML = xhr.responseText;
        reinitializeScripts();
      }
    };
    xhr.send();
  }

  function reinitializeScripts() {
    const scripts = document.getElementById('content').getElementsByTagName('script');
    for (let i = 0; i < scripts.length; i++) {
      const script = document.createElement('script');
      script.text = scripts[i].innerText;
      document.body.appendChild(script).parentNode.removeChild(script);
    }
  }

  function toggleDropdown(event) {
    event.stopPropagation(); // Prevent the click from propagating to the window click event
    const dropdownContent = event.target.closest('.dropdown').querySelector('.dropdown-content');
    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
  }

  // Close the dropdown if clicked outside
  window.onclick = function(event) {
    if (!event.target.matches('.dropdown-button') && !event.target.closest('.dropdown')) {
      const dropdowns = document.getElementsByClassName('dropdown-content');
      for (let i = 0; i < dropdowns.length; i++) {
        const openDropdown = dropdowns[i];
        if (openDropdown.style.display === 'block') {
          openDropdown.style.display = 'none';
        }
      }
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.dropdown-button').forEach(button => {
      button.addEventListener('click', toggleDropdown);
    });
  });

  function toggleHistory() {
    const historyItems = document.querySelectorAll('.history-box .history-item');
    const button = document.querySelector('.showHistory span');
    const isHidden = button.textContent === 'Show all history';

    historyItems.forEach((item, index) => {
      if (index !== 0) {
        item.classList.toggle('hidden', !isHidden);
      }
    });

    button.textContent = isHidden ? 'Hide history' : 'Show all history';
  }

  // Ensure only the first history item is visible on page load
  function initializeHistory() {
    const historyItems = document.querySelectorAll('.history-box .history-item');
    const button = document.querySelector('.showHistory span');

    historyItems.forEach((item, index) => {
      if (index !== 0) {
        item.classList.add('hidden');
      }
    });

    button.textContent = 'Show all history';
  }

  // Reinitialize the DOMContentLoaded event listener
  document.addEventListener('DOMContentLoaded', () => {
    if (typeof initializeHistory === 'function') {
      initializeHistory();
    }
    document.querySelectorAll('.dropdown-button').forEach(button => {
      button.addEventListener('click', toggleDropdown);
    });
  });

  
  function toggleDropdown() {
  const dropdownContent = document.getElementById('dropdownContent');
  if (dropdownContent.style.display === 'block') {
      dropdownContent.style.display = 'none';
  } else {
      dropdownContent.style.display = 'block';
  }
}
  document.getElementById('new-orders').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent the default link action
    document.getElementById('pending-orders').style.display = 'none';
    document.getElementById('completed-orders').style.display = 'none';
    document.getElementById('total-orders').style.display = 'none';
    document.querySelector('.large-box-container').style.display = 'none';

    // Show the "New Orders" section
    document.getElementById('new-orders').style.display = 'block';

    // Use AJAX to load the admin-accepting.php content into the container
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'admin-accepting.php', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById('admin-accepting-container').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  });

  document.getElementById('pending-orders').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent the default link action
    const adminAcceptingContainer = document.getElementById('admin-accepting-container');
    const pendingOrders = document.getElementById('pending-orders');

    if (adminAcceptingContainer.style.display === 'block') {
      adminAcceptingContainer.style.display = 'none';
      pendingOrders.style.display = 'block';
    } else {
      document.getElementById('new-orders').style.display   = 'none';
      document.getElementById('completed-orders').style.display = 'none';
      document.getElementById('total-orders').style.display = 'none';
      document.querySelector('.large-box-container').style.display = 'none';

      // Show the "Pending Orders" section
      pendingOrders.style.display = 'block';

      // Use AJAX to load the admin-updating.php content into the container
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'admin-updating.php', true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          adminAcceptingContainer.innerHTML = xhr.responseText;
          adminAcceptingContainer.style.display = 'block';
        }
      };
      xhr.send();
    }
  });

  function logout() {
    // Add PHP code to destroy session and redirect
    window.location.href = "login2.php";
  }

  // Optional: Close dropdown if clicked outside
  window.onclick = function(event) {
    if (!event.target.matches('#firstName')) {
      const dropdown = document.getElementById("dropdown");
      if (dropdown && dropdown.style.display === "block") {
        dropdown.style.display = "none";
      }
    }
  }
  function logout() {
    // Show the confirmation modal
    document.getElementById('logoutModal').style.display = 'block';
  }

  function confirmLogout() {
    // Proceed with the logout by redirecting to logout.php
    window.location.href = "logout.php";
  }

  function closeModal() {
    // Hide the confirmation modal if "No" is clicked
    document.getElementById('logoutModal').style.display = 'none';
  }
  function displayOrderDetails(element) {
      const orderId = element.getAttribute('data-order-id');
      const orderProduct = element.getAttribute('data-product');
      const orderQuantity = element.getAttribute('data-quantity');
      const orderBust = element.getAttribute('data-bust');
      const orderWaist = element.getAttribute('data-waist');
      const orderShoulder = element.getAttribute('data-shoulder');
      const orderDeliveryStatus = element.getAttribute('data-delivery-status');

      // Debug values
      console.log({ orderId, orderProduct, orderQuantity, orderBust, orderWaist, orderShoulder, orderDeliveryStatus });

      // Update the order-info section
      document.getElementById('orderId').innerText = orderId;
      document.getElementById('orderProduct').innerText = orderProduct;
      document.getElementById('orderQuantity').innerText = orderQuantity;
      document.getElementById('orderBust').innerText = orderBust;
      document.getElementById('orderWaist').innerText = orderWaist;
      document.getElementById('orderShoulder').innerText = orderShoulder;
      document.getElementById('orderDeliveryStatus').innerText = orderDeliveryStatus;
  }

  function updateOrderStatus(action, order) {
    var xhrUpdate = new XMLHttpRequest();
    var status = action === 'accept' ? 'Completed' : 'Declined'; // Set status based on action

    xhrUpdate.open('GET', 'update_order_status.php?id=' + order.id + '&status=' + status, true);

    xhrUpdate.onload = function() {
      if (xhrUpdate.status === 200) {
        alert('Order ' + status + ' successfully!');
        if (status === 'Completed') {
          addToConfirmedOrders(order); // Ensure order data is passed correctly
        }
      } else {
        alert('Error: ' + xhrUpdate.responseText);
      }
    };

    xhrUpdate.send();
  }

  function addToConfirmedOrders(order) {
    // Get the confirmed orders table
    var table = document.querySelector('.confirmed-orders tbody');
    
    // Create a new row with the confirmed order details
    var row = document.createElement('tr');
    row.innerHTML = `
      <td>${order.id}</td>
      <td>${order.product}</td>
      <td>${order.quantity}</td>
      <td>${order.bust}</td>
      <td>${order.waist}</td>
      <td>${order.shoulder}</td>
    `;
    
    // Append the new row to the table
    table.appendChild(row);
  }
  document.addEventListener('DOMContentLoaded', function() {
  const dropdownItems = document.querySelectorAll('.dropdown-item');
  const orderStatusSpan = document.getElementById('orderStatus');

  dropdownItems.forEach(item => {
    item.addEventListener('click', function(event) {
      event.preventDefault();
      const selectedStatus = this.textContent;
      orderStatusSpan.textContent = selectedStatus;
      // Optionally, you can add an AJAX call here to update the status in the database
    });
  });
});



function displayOrderDetails(orderId) {
console.log("Clicked order ID:", orderId);  // Check if this logs when a row is clicked
const orderItem = document.querySelector(`.order-item[data-order-id='${orderId}']`);
if (orderItem) {
  const orderProduct = orderItem.querySelector('.product').innerText;
  const orderQuantity = orderItem.querySelector('.quantity').innerText;
  const orderBust = orderItem.querySelector('.bust').innerText;
  const orderWaist = orderItem.querySelector('.waist').innerText;
  const orderShoulder = orderItem.querySelector('.shoulder').innerText;
  const orderStatus = orderItem.querySelector('.delivery_status').innerText;
  
  document.getElementById('orderId').innerText = orderId;
  document.getElementById('orderProduct').innerText = orderProduct;
  document.getElementById('orderQuantity').innerText = orderQuantity;
  document.getElementById('orderBust').innerText = orderBust;
  document.getElementById('orderWaist').innerText = orderWaist;
  document.getElementById('orderShoulder').innerText = orderShoulder;
  document.getElementById('orderStatus').innerText = orderStatus;
}
}
document.addEventListener('DOMContentLoaded', function() {
  const dropdownItems = document.querySelectorAll('.dropdown-item');
  const orderDeliveryStatusSpan = document.getElementById('orderDeliveryStatus');

  dropdownItems.forEach(item => {
      item.addEventListener('click', function(event) {
          event.preventDefault();
          const selectedStatus = this.textContent;
          orderDeliveryStatusSpan.textContent = selectedStatus;
      });
  });
});

function submitOrderStatus() {
  const orderId = document.getElementById('orderId').innerText;
  const orderDeliveryStatus = document.getElementById('orderDeliveryStatus').innerText;

  if (orderId && orderDeliveryStatus) {
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `update_order_status.php?id=${orderId}&delivery_status=${encodeURIComponent(orderDeliveryStatus)}`, true);

      xhr.onload = function() {
          if (xhr.status === 200) {
              console.log(xhr.responseText); // Debug server response
              try {
                  const response = JSON.parse(xhr.responseText);
                  if (response.success) {
                      showAlertModal('Order status updated successfully!');
                      updateConfirmedOrdersTable(response.order);
                      // Update the delivery status in the DOM
                      document.querySelector(`.order-item[data-order-id='${orderId}']`).setAttribute('data-delivery-status', orderDeliveryStatus);
                      document.querySelector(`.confirmed-order-item[data-order-id='${orderId}'] .delivery-status`).innerText = orderDeliveryStatus;
                  } else {
                      showAlertModal('Failed to update order status: ' + response.error);
                  }
              } catch (e) {
                  console.error('Error parsing JSON response:', e);
                  showAlertModal('Status Updated Successfully');
              }
          } else {
              showAlertModal('Failed to update order status. Please try again.');
          }
      };

      xhr.onerror = function() {
          showAlertModal('Network error. Please check your connection.');
      };

      xhr.send();
  } else {
      showAlertModal('Order ID or delivery status is missing.');
  }
}
function showAlertModal(message) {
  document.getElementById('alertModalBody').innerText = message;
  const alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
  alertModal.show();
}
function updateConfirmedOrdersTable(order) {
  // Check if the order already exists in the confirmed orders table
  let existingRow = document.querySelector(`.confirmed-order-item[data-order-id='${order.id}']`);
  
  if (existingRow) {
      // Update the existing row
      existingRow.querySelector('.delivery-status').innerText = order.delivery_status;
  } else {
      // Add a new row to the confirmed orders table
      const table = document.querySelector('.confirmed-orders tbody');
      const row = document.createElement('tr');
      row.classList.add('confirmed-order-item');
      row.setAttribute('data-order-id', order.id);
      row.setAttribute('data-product', order.product);
      row.setAttribute('data-quantity', order.quantity);
      row.setAttribute('data-bust', order.bust);
      row.setAttribute('data-waist', order.waist);
      row.setAttribute('data-shoulder', order.shoulder);
      row.setAttribute('data-delivery-status', order.delivery_status);
      row.innerHTML = `
          <td>${order.id}</td>
          <td>${order.product}</td>
          <td>${order.bust}</td>
          <td>${order.waist}</td>
          <td>${order.shoulder}</td>
          <td>${order.quantity}</td>
          <td class="delivery-status">${order.delivery_status}</td>
      `;
      table.appendChild(row);

      // Add click event listener to the new row
      row.addEventListener('click', function() {
          displayOrderDetails(row);
      });
  }

  // Remove the order from the pending list
  const pendingRow = document.querySelector(`.order-item[data-order-id='${order.id}']`);
  if (pendingRow) {
      pendingRow.remove();
  }
}
document.querySelectorAll('.confirmed-order-item').forEach(row => {
  row.addEventListener('click', function() {
      displayOrderDetails(row);
  });
});