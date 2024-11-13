<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>3D T-Shirt Editor</title>
  <style>


    .sidebar {
      width: 250px;
      height: 700px;
      margin-top: 90px;
      background-color: #f3f3f3;
      color: black;
      display: flex;
      flex-direction: column;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      border-radius: 0 10px 10px 0;
      z-index: 1000;
      border: 1px solid #ccc;
    
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
      font-size: 17px;
      font-weight: 500;
      border-radius: 10px;
      padding: 10px;
      
      
    }

    .sidebar a{
      
    }

    .sidebar a:hover{
      border-left: 1px solid black;
      border-top: 1px solid black;
      border-right: 1px solid black;
      border-bottom: 9px solid black;
    }
    .sidebar a:hover {
      background-color: #fff;
      
      
    }

    .sidebar button {
      background-color: #abf600;
      
      cursor: pointer;
      border-radius: 5px;
      padding: 10px;
      width: 100%;
      box-sizing: border-box;
      border-radius: 10px;
      color:black;
      font-weight:bold;
      
    }

    .sidebar button:hover {
      border-bottom: 9px solid black;
      transition: 0.2s;
    }

    .color-picker-circle {
      width: 25px;
      height: 25px;
      border-radius: 50px;
      background-color: #ffffff;
      display: none;
      cursor: pointer;
      margin-top: 20px;
      border: 1px solid #ccc;
    }

    .color-picker {
      display: block; /* Ensure the color picker is visible */
    }

    .text-options, .image-options, .background-options {
      display: none;
    }

    .text-options {
      display: flex;
      flex-direction: column;
      gap: 5px;
      margin-top: 10px;
    }

    .text-input {
      padding: 8px;
      font-size: 14px;
      height: 30px;
      width: 100%;
      margin-top:5px;
      border-radius:3px;
    }

    #saveButton{
      background-color: #abf600;
      color: black;
      font-weight: bold;
      border-radius: 5px;
      padding: 10px;
      width: 100%;
      box-sizing: border-box;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 20px;
      justify-content: center;
    }
  </style>
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

<div class="sidebar">
    <button href="#">Upload your design <span><i class='bx bx-chevron-up' style="font-size:30px;"></i></span></button>
    <button href="#">Export <span><i class='bx bx-chevron-right' style="font-size:30px;"></i></span></button>
    
    <!-- Add buttons for switching views and saving the model -->
   

    <!-- Garment Color Section -->
    <a href="#home" id="garmentColorToggle">Garment Color <span><i class='bx bxs-chevron-down'></i></span></a>
    <div id="colorPicker" class="color-picker-circle"></div>
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

    <!-- Background Section -->
    <a href="#contact" id="backgroundToggle">Background <span><i class='bx bxs-chevron-down'></i></span></a>
    <div class="background-options" id="backgroundOptions">
      <input type="color" id="backgroundColorPicker" class="text-input" value="#D9D9D9">
    </div>

    <div class="saveButton">
      
        <button id="saveButton">Save Design</button>
      
    </div>
</div>

<script>
  // Toggle garment color picker display
  document.getElementById("garmentColorToggle").addEventListener("click", () => {
    const colorPicker = document.getElementById("garmentColorPicker");
    colorPicker.style.display = colorPicker.style.display === "none" ? "block" : "none";
  });

  // Garment color update
  document.getElementById("garmentColorPicker").addEventListener("input", (e) => {
    const color = e.target.value;
    document.getElementById("colorPicker").style.backgroundColor = color;

    // Update color in Three.js model
    if (typeof object !== "undefined" && object) {
      object.traverse((node) => {
        if (node.isMesh && node.material) {
          node.material.color.set(color);
        }
      });
    }
  });

  // Text options display
  document.getElementById("textToggle").addEventListener("click", () => {
    const textOptions = document.getElementById("textOptions");
    textOptions.style.display = textOptions.style.display === "none" ? "block" : "none";
  });

  // Toggle image options
  document.getElementById("imageToggle").addEventListener("click", () => {
    const imageOptions = document.getElementById("imageOptions");
    imageOptions.style.display = imageOptions.style.display === "none" ? "block" : "none";
  });

  // Toggle background color picker
  document.getElementById("backgroundToggle").addEventListener("click", () => {
    const backgroundOptions = document.getElementById("backgroundOptions");
    backgroundOptions.style.display = backgroundOptions.style.display === "none" ? "block" : "none";
  });

  // Update background color
  document.getElementById("backgroundColorPicker").addEventListener("input", (e) => {
    const color = e.target.value;
    document.body.style.backgroundColor = color;
  });
</script>

