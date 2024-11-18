<?php
include 'includes/header-customer.php';
include 'includes/sidebar-customer.php'; // Add this line to include the sidebar

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
    <main>
        <div id="container3D"></div>
        <div class="controls">
            <!-- Add controls here if needed -->
        </div>
    </main>
</div>
<script type="module" src="js/main.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AU5THB8u5xqTfY6An508wUQgMHD_3iX4Ggpc86E21lAYcRlU_7fA83cmpnpUVQnzwnMZZPxOUeEQqwCL&currency=PHP"></script>
<script>
// Your existing 3D rendering logic here...
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

    // Apply saved customization to 3D model (garment color)
    if (garmentColor && object) {
        object.traverse((node) => {
            if (node.isMesh && node.material) {
                node.material.color.set(garmentColor);
            }
        });
    }

    // Apply saved text if available
    if (textInput && textSize && fontSelect && textColor) {
        addTextToModel(textInput, textSize, fontSelect, textColor);
    }
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

// Load saved design if available from database
<?php if (isset($design)): ?>
    document.getElementById('garmentColorPicker').value = "<?php echo $design['garmentColor']; ?>";
    document.getElementById('textInput').value = "<?php echo $design['textInput']; ?>";
    document.getElementById('fontSelect').value = "<?php echo $design['fontSelect']; ?>";
    document.getElementById('textSize').value = "<?php echo $design['textSize']; ?>";
    document.getElementById('textColorPicker').value = "<?php echo $design['textColor']; ?>";
<?php endif; ?>
</script>
