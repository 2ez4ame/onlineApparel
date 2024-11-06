<?php
include 'includes/header-customer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" />
  <title>Customization</title>
  <style>
    .content {
      margin-left: 250px;
      margin-top: 70px;
      padding: 20px;
    }
    #container3D {
      width: 100%;
      height: calc(100vh - 70px); /* Adjust height to account for header */
      background-color: transparent; /* Remove background color */
    }
  </style>
</head>
<body>
  <?php include 'includes/sidebar-customer.php'; ?>
  
  <main>
    <div id="container3D"></div>
    <div class="controls">
      
    </div>
  </main>
  
  <script type="module" src="js/main.js"></script>
</body>
</html>
