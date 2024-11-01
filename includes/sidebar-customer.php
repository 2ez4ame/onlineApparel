<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Example</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      background-color: #D9D9D9;
    }

    .sidebar {
      width: 250px;
      height: 700px; /* Full height */
      margin-top: 90px; /* Adjust top margin to account for header height */
      background-color: #ffff;
      color: black;
      display: flex;
      flex-direction: column;
      padding: 20px;
      position: fixed; /* Fixed position */
      top: 0;
      left: 0;
      border-radius: 0 10px 10px 0; /* Rounded corners */
    }

    .sidebar a {
      color: black;
      text-decoration: none;
      padding: 15px 0;
      display: flex;
      align-items: center;
      justify-content: space-between; /* Space between text and icon */
      margin-top: 10px;
    }

    .sidebar a:hover {
      background-color: #697565;
      color: white;
      transition: -1s;
    }

    .sidebar button {
      background-color: #697565;
      color: white;
      border: none;
      padding: 15px 7px;
      display: flex;
      align-items: center;
      justify-content: space-between; 
      margin-top: 10px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }

    .sidebar button:hover {
      background-color: #CBD2A4;
      color: white;
      transition: 1s;
    }

    .content {
      margin-left: 250px; /* Adjust content margin to account for sidebar width */
      flex-grow: 1;
      padding: 20px;
    }

    .sidebar i {
      margin-left: 10px; /* Add space between text and icon */
    }
  </style>
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="sidebar">
    <button  href="#">Upload your design<span><i class='bx bx-arrow-from-bottom' style="font-size:30px;"></i></span></button>
    <button href="#">Export<span><i class='bx bx-exit' style="font-size:30px;" ></i></span></button>
    <a href="#home">Garment Color <span><i class='bx bxs-chevron-down'></i></span></a>
    <a href="#services">Text <span><i class='bx bxs-chevron-down'></i></span></a>
    <a href="#clients">Image <span><i class='bx bxs-chevron-down'></i></span></a>
    <a href="#contact">Background <span><i class='bx bxs-chevron-down'></i></span></a>
</div>
  <div class="content">
    <!-- Main content goes here -->
  </div>
</body>

</html>