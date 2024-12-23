<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'databaseconnection.php'; // Ensure this file contains the database connection

// Retrieve POST data
$title = isset($_POST['title']) ? $_POST['title'] : null;
$size = isset($_POST['size']) ? $_POST['size'] : null;
$imageUrl = isset($_POST['imageUrl']) ? $_POST['imageUrl'] : null;
$garmentColor = isset($_POST['garmentColor']) ? $_POST['garmentColor'] : null;
$textInput = isset($_POST['textInput']) ? $_POST['textInput'] : null;
$fontSelect = isset($_POST['fontSelect']) ? $_POST['fontSelect'] : null;
$textSize = isset($_POST['textSize']) ? $_POST['textSize'] : null;
$textColor = isset($_POST['textColor']) ? $_POST['textColor'] : null;
$modelData = isset($_POST['modelData']) ? $_POST['modelData'] : null;

// Check if all required data is present
if ($title && $size && $imageUrl && $garmentColor && $textInput && $fontSelect && $textSize && $textColor && $modelData) {
    // Decode the base64 data and save the GLB file
    $modelFilePath = 'models/' . uniqid() . '.glb';
    file_put_contents($modelFilePath, base64_decode($modelData));

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO saved_design (title, size, image_url, garmentColor, textInput, fontSelect, textSize, textColor, model_file_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiss", $title, $size, $imageUrl, $garmentColor, $textInput, $fontSelect, $textSize, $textColor, $modelFilePath);

    if ($stmt->execute()) {
        $lastInsertId = $stmt->insert_id;
        echo json_encode(['message' => 'Design saved successfully', 'id' => $lastInsertId]);
    } else {
        echo json_encode(['error' => 'Failed to save design']);
    }

    // Close the statement but not the connection yet
    $stmt->close();
} else {
    echo json_encode(['error' => 'Missing required data']);
    exit;
}

// Fetch the last inserted design from the database
$result = $conn->query("SELECT * FROM saved_design WHERE id = $lastInsertId");
$project = $result->fetch_assoc();
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
            // Initialize the 3D model for the saved project
            var scene = new THREE.Scene();
            var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            var renderer = new THREE.WebGLRenderer();
            renderer.setSize(300, 300);
            document.getElementById('3d-model-<?php echo $project['id']; ?>').appendChild(renderer.domElement);

            var loader = new THREE.GLTFLoader();
            loader.load('<?php echo htmlspecialchars($project['model_file_path']); ?>', function (gltf) {
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

    fetch('save_design.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
      .then(data => alert(data.message || 'Design saved successfully'))
      .catch(error => console.error('Error:', error));
});
</script>

<?php
// Close the connection after fetching the design
$conn->close();
?>
