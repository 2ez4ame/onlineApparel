<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>3D T-Shirt Editor</title>
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
      height: 700px;
      margin-top: 90px;
      background-color: #ffff;
      color: black;
      display: flex;
      flex-direction: column;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      border-radius: 0 10px 10px 0;
      z-index: 1000; /* Ensure sidebar is above other elements */
    }

    .sidebar a, .sidebar button {
      color: black;
      text-decoration: none;
      padding: 15px 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 10px;
      z-index: 1001; 
      
    }

    .sidebar a:hover, .sidebar button:hover {
      background-color: #697565;
      color: white;
      transition: 0.3s;
    }

    .sidebar button {
      background-color: #697565;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      text-align: center; /* Center text horizontally */
      display: flex; /* Use flexbox for centering */
      align-items: center; /* Center items vertically */
      justify-content: center; /* Center items horizontally */
      padding: 10px; /* Add padding for better spacing */
      width: 100%; /* Ensure the button takes the full width of its container */
      box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }

    .color-picker-circle {
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background-color: #ffffff;
      display: none;
      cursor: pointer;
      margin-top: 10px;
      border: 1px solid #ccc;
    }

    .color-picker, .text-options, .image-options {
      display: none;
    }

    .text-options {
      display: flex;
      flex-direction: column;
      gap: 5px;
      margin-top: 10px;
    }

    .text-input {
      padding: 5px;
      font-size: 14px;
    }
  </style>
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="sidebar">
    <button href="#">Upload your design <span><i class='bx bx-arrow-from-bottom' style="font-size:30px;"></i></span></button>
    <button href="#">Export <span><i class='bx bx-exit' style="font-size:30px;"></i></span></button>
    
    <!-- Garment Color Section -->
    <a href="#home" id="garmentColorToggle">Garment Color <span><i class='bx bxs-chevron-down'></i></span></a>
    <div id="colorPickerCircle" class="color-picker-circle"></div>
    <input type="color" id="garmentColorPicker" class="color-picker" value="#ffffff">
    
    <!-- Text Section -->
    <a href="#services" id="textToggle">Text <span><i class='bx bxs-chevron-down'></i></span></a>
    <div class="text-options" id="textOptions">
      <input type="text" id="textInput" class="text-input" placeholder="Enter text here">
      <select id="fontSelect" class="text-input">
        <option value="Arial">Arial</option>
        <option value="Times New Roman">Times New Roman</option>
        <option value="Courier New">Courier New</option>
        <option value="Verdana">Verdana</option>
      </select>
      <input type="number" id="textSize" class="text-input" placeholder="Font Size" min="8" max="72" value="16">
      <input type="color" id="textColorPicker" class="text-input" value="#000000">
      <button id="addTextButton">Add Text</button>
    </div>
    
    <!-- Image Section -->
    <a href="#clients" id="imageToggle">Image <span><i class='bx bxs-chevron-down'></i></span></a>
    <div class="image-options" id="imageOptions">
      <label for="chestImageUpload" class="text-input">Upload Chest Image</label>
      <input type="file" id="chestImageUpload" class="text-input" accept="image/*">
      <label for="backImageUpload" class="text-input">Upload Back Image</label>
      <input type="file" id="backImageUpload" class="text-input" accept="image/*">
    </div>

    <a href="#contact">Background <span><i class='bx bxs-chevron-down'></i></span></a>
</div>


<script>
  // Toggle color picker circle display
  document.getElementById("garmentColorToggle").addEventListener("click", () => {
    const colorCircle = document.getElementById("colorPickerCircle");
    colorCircle.style.display = colorCircle.style.display === "none" ? "block" : "none";
  });

  // Show color picker on color circle click
  document.getElementById("colorPickerCircle").addEventListener("click", () => {
    document.getElementById("garmentColorPicker").click();
  });

  // Update T-shirt model color on color change
  document.getElementById("garmentColorPicker").addEventListener("input", (e) => {
    const color = e.target.value;
    document.getElementById("colorPickerCircle").style.backgroundColor = color;
    
    // Update T-shirt model color in Three.js
    if (object) {
      object.traverse((node) => {
        if (node.isMesh && node.material) {
          node.material.color.set(color);
        }
      });
    }
  });

  // Toggle text options display
  document.getElementById("textToggle").addEventListener("click", () => {
    const textOptions = document.getElementById("textOptions");
    textOptions.style.display = textOptions.style.display === "none" ? "block" : "none";
  });

  // Add event listener for text input, font, size, and color
  document.getElementById("textInput").addEventListener("input", updateText);
  document.getElementById("fontSelect").addEventListener("change", updateText);
  document.getElementById("textSize").addEventListener("input", updateText);
  document.getElementById("textColorPicker").addEventListener("input", updateText);

  function updateText() {
    const text = document.getElementById("textInput").value;
    const font = document.getElementById("fontSelect").value;
    const size = document.getElementById("textSize").value;
    const color = document.getElementById("textColorPicker").value;

    // Assuming Three.js text mesh object exists (create or update it here)
    if (textMesh) {
      textMesh.text = text;
      textMesh.font = font;
      textMesh.fontSize = size;
      textMesh.color = color;
      textMesh.needsUpdate = true; // Mark for re-render
    }
  }

  // Toggle image options display
  document.getElementById("imageToggle").addEventListener("click", () => {
    const imageOptions = document.getElementById("imageOptions");
    imageOptions.style.display = imageOptions.style.display === "none" ? "block" : "none";
  });

  // Add text to 3D model on button click
  document.getElementById("addTextButton").addEventListener("click", () => {
    const text = document.getElementById("textInput").value;
    const font = document.getElementById("fontSelect").value;
    const size = parseFloat(document.getElementById("textSize").value);
    const color = document.getElementById("textColorPicker").value;
    createTextSprite(text, font, size, color);
  });
</script>
</body>
</html>
