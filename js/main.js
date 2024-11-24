// Import the THREE.js library
import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";
import { OrbitControls } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";


const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

let mouseX = window.innerWidth / 2;
let mouseY = window.innerHeight / 2;
let object; // Ensure object is accessible globally
let controls;
let objToRender = 'tshirt';
const loader = new GLTFLoader();

loader.load(
  `models/${objToRender}/scene.gltf`,
  function (gltf) {
    console.log('Model loaded:', gltf);
    object = gltf.scene;
    object.position.set(0, -5, 0); // Adjust the position to be smaller and fit under the header
    object.scale.set(0.5, 0.5, 0.5); // Scale down the model
  
    // Set initial color for the T-shirt material
    object.traverse((node) => {
      if (node.isMesh) {
        node.material = new THREE.MeshStandardMaterial({
          color: "#ffffff", // Set initial color
          side: THREE.DoubleSide // Render both sides
        });
        node.castShadow = true; // Ensure the object casts shadows
        node.receiveShadow = true; // Ensure the object receives shadows
      }
    });

    scene.add(object);
    console.log(`${objToRender} model loaded successfully`);
  },
  function (xhr) {
    console.log((xhr.loaded / xhr.total * 100) + '% loaded');
  },
  function (error) {
    console.error(`Error loading ${objToRender} model:`, error);
  }
);

const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight - 70); // Adjust renderer size to fit under the header
document.getElementById("container3D").appendChild(renderer.domElement);
document.getElementById("container3D").style.position = "absolute";
document.getElementById("container3D").style.top = "70px"; // Position under the header
document.getElementById("container3D").style.left = "0px"; // Position to the left
camera.position.z = objToRender === "tshirt" ? 50 : 500;

const topLight = new THREE.DirectionalLight(0xFFA07A, 1);
topLight.position.set(500, 500, 500);
topLight.castShadow = true;
scene.add(topLight);

const ambientLight = new THREE.AmbientLight(0x333333, objToRender === "tshirt" ? 5 : 1);
scene.add(ambientLight);

const planeGeometry = new THREE.PlaneGeometry(500, 500);
const planeMaterial = new THREE.ShadowMaterial({ opacity: 0.5 });
const plane = new THREE.Mesh(planeGeometry, planeMaterial);
plane.rotation.x = -Math.PI / 2;
plane.position.y = -10.5;
plane.receiveShadow = true;
scene.add(plane);

renderer.shadowMap.enabled = true;
renderer.shadowMap.type = THREE.PCFSoftShadowMap;
topLight.castShadow = true;
topLight.shadow.mapSize.width = 1024;
topLight.shadow.mapSize.height = 1024;
topLight.shadow.camera.near = 0.5;
topLight.shadow.camera.far = 500;

controls = new OrbitControls(camera, renderer.domElement);

function animate() {
  requestAnimationFrame(animate);

  if (object) {
    console.log('Rendering object:', object);
    if (objToRender === "eye") {
      object.rotation.y += 0.01;
      const bobbingSpeed = 0.02;
      const bobbingAmplitude = 0.1;
      object.position.y = -10 + Math.sin(Date.now() * bobbingSpeed) * bobbingAmplitude;
      
      const tiltSpeed = 0.01;
      object.rotation.x += Math.sin(Date.now() * tiltSpeed) * 0.005;
      const mouseTiltFactor = 0.01;
      object.rotation.y += (mouseX / window.innerWidth - 0.5) * mouseTiltFactor;
      object.rotation.x += (mouseY / window.innerHeight - 0.5) * mouseTiltFactor;
    }
  }
  renderer.render(scene, camera);
}

window.addEventListener("resize", function () {
  camera.aspect = window.innerWidth / (window.innerHeight - 70);
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight - 70);
});

document.onmousemove = (e) => {
  mouseX = e.clientX;
  mouseY = e.clientY;
};

// Add color picker functionality
document.getElementById("garmentColorToggle").addEventListener("click", () => {
  const colorPicker = document.getElementById("garmentColorPicker");
  colorPicker.style.display = colorPicker.style.display === "none" ? "block" : "none";
});

// Garment color update
document.getElementById("garmentColorPicker").addEventListener("input", (e) => {
  const color = e.target.value;
  document.getElementById("colorPicker").style.backgroundColor = color;

  console.log("Selected color:", color); // Debugging statement

  // Apply color to the T-shirt model material
  if (object) {
    object.traverse((node) => {
      if (node.isMesh && node.material) {
        console.log("Node material before color change:", node.material); // Debugging statement
        if (node.material.color) {
          node.material.color.set(color);
          node.material.needsUpdate = true; // Ensure the material is updated
          console.log("Node material after color change:", node.material); // Debugging statement
        } else {
          console.warn("Node material does not have a color property:", node.material); // Debugging statement
        }
      }
    });
  } else {
    console.warn("Object is not defined"); // Debugging statement
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

    // Convert the 3D model to GLB format
    const exporter = new THREE.GLTFExporter();
    exporter.parse(object, function(result) {
        const blob = new Blob([result], { type: 'application/octet-stream' });
        const reader = new FileReader();
        reader.onload = function(event) {
            const modelData = event.target.result.split(',')[1]; // Get base64 string

            // Send the data to the backend
            let formData = new FormData();
            formData.append('garmentColor', garmentColor);
            formData.append('textInput', textInput);
            formData.append('fontSelect', fontSelect);
            formData.append('textSize', textSize);
            formData.append('textColor', textColor);
            formData.append('modelData', modelData);

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
        };
        reader.readAsDataURL(blob); // Convert to base64
    });
});

animate();