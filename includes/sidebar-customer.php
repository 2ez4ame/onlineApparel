<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>3D T-Shirt Editor</title>
<style>
    /* Existing Styles */
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

    .sidebar a:hover {
        border-left: 1px solid black;
        border-top: 1px solid black;
        border-right: 1px solid black;
        border-bottom: 9px solid black;
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
        display: block;
    }

    .text-options, .background-options {
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

    #saveButton {
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

    <!-- Garment Color Section -->
    <a href="#home" id="garmentColorToggle">Garment Color <span><i class='bx bxs-chevron-down'></i></span></a>
    <div id="colorPicker" class="color-picker-aircle"></div>
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

    <!-- Background Section -->
    <a href="#about" id="backgroundToggle">Background <span><i class='bx bxs-chevron-down'></i></span></a>
    <div class="background-options" id="backgroundOptions">
        <input type="color" id="backgroundColor" class="text-input" value="#ffffff">
    </div>

    <!-- Save Section -->
    <button id="saveButton">Save Design</button>
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

// Toggle background color picker
document.getElementById("backgroundToggle").addEventListener("click", () => {
  const backgroundOptions = document.getElementById("backgroundOptions");
  backgroundOptions.style.display = backgroundOptions.style.display === "none" ? "block" : "none";
});

// Update background color
document.getElementById("backgroundColor").addEventListener("input", (e) => {
  const color = e.target.value;
  document.body.style.backgroundColor = color;
});

document.getElementById('saveButton').addEventListener('click', function() {
    const garmentColor = document.getElementById('garmentColorPicker').value;
    const textInput = document.getElementById('textInput').value;
    const fontSelect = document.getElementById('fontSelect').value;
    const textSize = document.getElementById('textSize').value;
    const textColor = document.getElementById('textColorPicker').value;

    // Ensure the fields are populated
    if (!garmentColor || !textInput || !fontSelect || !textSize || !textColor) {
        alert('Please fill out all customization options before saving.');
        return; // Prevent form submission if any field is missing
    }

    // Store the selected data in localStorage or sessionStorage
    localStorage.setItem('garmentColor', garmentColor);
    localStorage.setItem('textInput', textInput);
    localStorage.setItem('fontSelect', fontSelect);
    localStorage.setItem('textSize', textSize);
    localStorage.setItem('textColor', textColor);

    // Send the data to the backend
    let formData = new FormData();
    formData.append('garmentColor', garmentColor);
    formData.append('textInput', textInput);
    formData.append('fontSelect', fontSelect);
    formData.append('textSize', textSize);
    formData.append('textColor', textColor);

    // Use fetch to submit the form data to save-projects.php
    fetch('save-projects.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message); // Success message
        } else {
            alert(data.error); // Error message from server
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Function to convert 3D model to GLB
function convertModelToGLB(model) {
  // Your code to convert Three.js model object to GLB format, e.g., using GLTFExporter
  const exporter = new THREE.GLTFExporter();
  exporter.parse(model, function(result) {
      const blob = new Blob([result], { type: 'application/octet-stream' });
      const reader = new FileReader();
      reader.onload = function(event) {
          return event.target.result;  // This will give the base64 string of the GLB file
      };
      reader.readAsDataURL(blob);  // Convert to base64 (or return as binary for sending to server)
  });
}
<?php if (isset($design)): ?>
    document.getElementById('garmentColorPicker').value = "<?php echo $design['garmentColor']; ?>";
    document.getElementById('textInput').value = "<?php echo $design['textInput']; ?>";
    document.getElementById('fontSelect').value = "<?php echo $design['fontSelect']; ?>";
    document.getElementById('textSize').value = "<?php echo $design['textSize']; ?>";
    document.getEl
</script>
