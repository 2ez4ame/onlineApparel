<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/header-customer.php';

// Check if a saved design ID is provided
if (isset($_GET['id'])) {
    $designId = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM saved_design WHERE id = ?");
    $stmt->bind_param("i", $designId);
    $stmt->execute();
    $result = $stmt->get_result();
    $design = $result->fetch_assoc();
    $stmt->close();
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css" />
<link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
<title>Customization</title>
<style>
#container3D {
    width: 100%;
    height: calc(100vh - 50px); 
}
</style>

<div id="header"><?php include 'includes/header-customer.php'; ?></div>
<div class="content">
    <?php include 'includes/sidebar-customer.php'; ?>
    <main>
        <div id="container3D"></div>
        <div class="controls">
            <!-- Add controls here if needed -->
            <div id="garmentColorToggle"></div>
            <input type="color" id="garmentColorPicker" style="display:none;">
            <div id="backgroundToggle"></div>
            <input type="color" id="backgroundColor" style="display:none;">
        </div>
    </main>
</div>

<script type="module" src="js/main.js"></script>

<script>
let scene, camera, renderer, object;

// Initialize 3D scene
function init() {
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.getElementById('container3D').appendChild(renderer.domElement);

    // Load 3D model (ensure your model path is correct)
    const loader = new THREE.GLTFLoader();
    loader.load('path/to/your-model.glb', function(gltf) {
        object = gltf.scene;
        scene.add(object);
        camera.position.z = 5;
        animate();
    });
}

// Animation loop
function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}

init();

// Apply saved design properties when page loads
window.onload = function() {
    const garmentColor = localStorage.getItem('garmentColor');
    const textInput = localStorage.getItem('textInput');
    const fontSelect = localStorage.getItem('fontSelect');
    const textSize = localStorage.getItem('textSize');
    const textColor = localStorage.getItem('textColor');

    // Load the saved 3D model
    const loader = new THREE.GLTFLoader();
    loader.load('<?php echo isset($design['model_file_path']) ? $design['model_file_path'] : ''; ?>', function(gltf) {
        object = gltf.scene;
        scene.add(object);
        camera.position.z = 5;
        animate();

        // Apply saved customization to 3D model (garment color)
        if (garmentColor && object) {
            object.traverse((node) => {
                if (node.isMesh && node.material) {
                    console.log("Node material before color change:", node.material); // Debugging statement
                    if (node.material.color) {
                        node.material.color.set(garmentColor);
                        node.material.needsUpdate = true; // Ensure the material is updated
                        console.log("Node material after color change:", node.material); // Debugging statement
                    } else {
                        console.warn("Node material does not have a color property:", node.material); // Debugging statement
                    }
                }
            });
        }

        // Apply saved text if available
        if (textInput && textSize && fontSelect && textColor) {
            addTextToModel(textInput, textSize, fontSelect, textColor);
        }
    });
};

// Function to add text to your model
function addTextToModel(textInput, textSize, fontSelect, textColor) {
    const loader = new THREE.FontLoader();
    loader.load('path/to/font.json', function(font) {
        const geometry = new THREE.TextGeometry(textInput, {
            font: font,
            size: parseInt(textSize),
            height: 5
        });
        const material = new THREE.MeshBasicMaterial({ color: textColor });
        const textMesh = new THREE.Mesh(geometry, material);
        scene.add(textMesh);
    });
}

document.getElementById("garmentColorToggle").addEventListener("click", () => {
  const colorPicker = document.getElementById("garmentColorPicker");
  colorPicker.style.display = colorPicker.style.display === "none" ? "block" : "none";
});

// Garment color update
document.getElementById("garmentColorPicker").addEventListener("input", (e) => {
    const color = e.target.value;

    if (object) {
        object.traverse((node) => {
            if (node.isMesh && node.material && node.material.color) {
                console.log("Applying color to node:", node.name); // Debugging
                node.material.color.set(color);
                node.material.needsUpdate = true; // Ensure the material updates
            }
        });
    } else {
        console.error("3D object is not loaded yet.");
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

// Save button click handler to save the design
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
        console.log('Design saved successfully:', data);
    })
    .catch(error => {
        console.error('Error saving design:', error);
    });
});
</script>
