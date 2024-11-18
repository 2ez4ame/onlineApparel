<?php
include 'databaseconnection.php';

// Check if the required POST variables are set
if (isset($_POST['garmentColor'], $_POST['textInput'], $_POST['fontSelect'], $_POST['textSize'], $_POST['textColor'])) {
    // Sanitize input data
    $garmentColor = htmlspecialchars($_POST['garmentColor']);
    $textInput = htmlspecialchars($_POST['textInput']);
    $fontSelect = htmlspecialchars($_POST['fontSelect']);
    $textSize = htmlspecialchars($_POST['textSize']);
    $textColor = htmlspecialchars($_POST['textColor']);

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO saved_design (garmentColor, textInput, fontSelect, textSize, textColor) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $garmentColor, $textInput, $fontSelect, $textSize, $textColor);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Design saved successfully!']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    // Debugging: Output the $_POST data and expected variables to identify what's missing
    echo json_encode([
        'error' => 'Missing required POST variables',
        'received' => $_POST,
        'expected' => ['garmentColor', 'textInput', 'fontSelect', 'textSize', 'textColor']
    ]);
}

// Initialize $projects as an empty array
$projects = [];

// Your existing code to fetch projects from the database
$result = $conn->query("SELECT * FROM saved_design");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
} else {
    echo json_encode(['error' => 'Error fetching projects: ' . $conn->error]);
}

// Ensure $projects is an array before using it in a foreach loop
if (is_array($projects)) {
    foreach ($projects as $project) {
        // Your code to process each project
    }
} else {
    echo json_encode(['error' => 'Projects data is not an array']);
}
?>

<link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
<title>Saved Projects</title>

<style>
.saved-projects-container {
    display: flex;
    justify-content: center;
    padding: 10px 0;
}

.saved-projects {
    display: flex;
    align-items: center;
    padding: 30px 15px;
    background-color: white;
    border-bottom: 1px solid #ddd;
    max-width: 1400px; /* Adjust this value as needed */
    width: 100%;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.saved-projects .title {
    font-size: 30px;
    font-weight: bold;
    margin-right: 10px; /* Adjusted margin */
}

.saved-projects  {
    font-size: 20px;
    color: #55;
    text-decoration: none;
    margin-left: 5px;
}

.add-new {
  text-decoration: none; 
}

.add {
  width: 100px;
  height: 40px;
  font-size: 15px;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  background-color: #abf600;
  cursor: pointer;
  color: black;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
}

.add i {
  margin-right: 5px; 
  text-decoration: none;
}

.add:hover {
  background-color: #9BCF53;
  cursor: pointer;
  transition: 0.2s;
}

.saved-projects .separator {
    width: 1px;
    height: 40px; /* Adjust height if necessary */
    background-color: #000; 
    margin-right: 10px; /* Adjusted margin */
    font-weight: bold;
}

.images {
  display: flex;
  justify-content: flex-start;
  margin-left: 50px;
  align-items: center;
  gap: 70px;
}

.images div {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 10px;
}
</style>

<div class="saved-projects-container">
    <div class="saved-projects">
        <span class="title">Saved Projects</span>
        <div class="separator"></div> <!-- Separator placed here -->
        <a href="customize.php" class="add-new">
            <button class="add">
                <i class='bx bx-plus' style="font-size:20px;"></i> Add new
            </button>
        </a>
    </div>
</div>

<div class="title-design">
    <br>
    <div class="images">
        <?php foreach ($projects as $project): ?>
            <div>
                <div class="tshirtTitle">
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <h5><?php echo htmlspecialchars($project['size']); ?></h5>
                </div>

                <!-- 3D Model Rendering -->
                <div class="tshirt-3d">
                    <div id="3d-model-<?php echo $project['id']; ?>" style="width: 300px; height: 300px;"></div>
                </div>

                <a href="customize.php?id=<?php echo $project['id']; ?>"> <!-- Pass project ID to customize.php -->
                    <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="tshirt">
                </a>
            </div>

            <script>
                // Initialize the 3D model for each saved project
                var scene = new THREE.Scene();
                var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
                var renderer = new THREE.WebGLRenderer();
                renderer.setSize(300, 300);
                document.getElementById('3d-model-<?php echo $project['id']; ?>').appendChild(renderer.domElement);

                var loader = new THREE.GLTFLoader();
                loader.load('<?php echo htmlspecialchars($project['3d_model_url']); ?>', function (gltf) {
                    scene.add(gltf.scene);
                    camera.position.z = 5;
                    
                    var animate = function () {
                        requestAnimationFrame(animate);
                        gltf.scene.rotation.x += 0.01;
                        gltf.scene.rotation.y += 0.01;
                        renderer.render(scene, camera);
                    };
                    animate();
                });
            </script>
        <?php endforeach; ?>
    </div>
</div>
<script>
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

<?php if (isset($design)): ?>
    document.getElementById('garmentColorPicker').value = "<?php echo $design['garmentColor']; ?>";
    document.getElementById('textInput').value = "<?php echo $design['textInput']; ?>";
    document.getElementById('fontSelect').value = "<?php echo $design['fontSelect']; ?>";
    document.getElementById('textSize').value = "<?php echo $design['textSize']; ?>";
    document.getElementById('textColorPicker').value = "<?php echo $design['textColor']; ?>";
<?php endif; ?>

</script>

<?php include('css/userhomestyle.php'); ?>
