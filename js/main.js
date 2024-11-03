// Import the THREE.js library
import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";
import { OrbitControls } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";

const scene = new THREE.Scene();
let objToRender = 'tshirt'; // Ensure this is defined before use
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const headerHeight = 70; // Height of the fixed header
camera.position.z = 50; // Adjust camera position to make the model smaller and centered
camera.position.y = 0; // Center the camera vertically

const renderer = new THREE.WebGLRenderer({ alpha: true });
const container = document.getElementById("container3D");
if (container) {
  container.appendChild(renderer.domElement);
  renderer.setSize(container.clientWidth, container.clientHeight); // Adjust renderer size to fit the container
} else {
  console.error("Container element not found");
}

let mouseX = window.innerWidth / 2;
let mouseY = window.innerHeight / 2;
let object;
let controls;
const loader = new GLTFLoader();

// Function to set the size of the T-shirt model
function setSize(object, size) {
  object.scale.set(size, size, size);
}

// Load the model and set its size
loader.load(
  `models/${objToRender}/scene.gltf`,
  function (gltf) {
    object = gltf.scene;
    object.position.set(0, -5, 0); // Adjust position to center the model and avoid overlapping with the header
    
    // Set initial size for the T-shirt model
    const initialSize = 1.0; // Adjust this value to make the model larger
    setSize(object, initialSize);
    
    // Set initial color for the T-shirt material
    object.traverse((node) => {
      if (node.isMesh) {
        node.material = new THREE.MeshStandardMaterial({
          color: "#ffffff", // Set initial color
          side: THREE.DoubleSide // Render both sides
        });
        
        // Adjust shoulder size to be equal
        if (node.name.includes("Shoulder")) {
          node.scale.x = 1; // Ensure equal scaling on x-axis
        }
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

let chestImage, backImage;

document.getElementById("chestImageUpload").addEventListener("change", (e) => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (event) {
      const texture = new THREE.TextureLoader().load(event.target.result);
      texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
      texture.repeat.set(1, 1);

      if (chestImage) {
        chestImage.material.map = texture;
        chestImage.material.needsUpdate = true;
      } else {
        chestImage = new THREE.Mesh(
          new THREE.PlaneGeometry(10, 10), // Adjusted size to fit within square lines
          new THREE.MeshBasicMaterial({ map: texture, transparent: true })
        );
        chestImage.position.set(0, 0, 0.1); // Adjust position as needed
        object.add(chestImage);
      }
    };
    reader.readAsDataURL(file);
  }
});

document.getElementById("backImageUpload").addEventListener("change", (e) => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (event) {
      const texture = new THREE.TextureLoader().load(event.target.result);
      texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
      texture.repeat.set(1, 1);

      if (backImage) {
        backImage.material.map = texture;
        backImage.material.needsUpdate = true;
      } else {
        backImage = new THREE.Mesh(
          new THREE.PlaneGeometry(10, 10), // Adjusted size to fit within square lines
          new THREE.MeshBasicMaterial({ map: texture, transparent: true })
        );
        backImage.position.set(0, 0, -0.1); // Adjust position as needed
        object.add(backImage);
      }
    };
    reader.readAsDataURL(file);
  }
});

let selectedTextMesh = null;

// Function to make text mesh editable
function makeTextMeshEditable(mesh) {
  selectedTextMesh = mesh;
  const text = prompt("Edit text:", mesh.geometry.parameters.text);
  if (text !== null) {
    const font = document.getElementById("fontSelect").value;
    const size = parseFloat(document.getElementById("textSize").value);
    updateTextMesh(text, font, size);
  }
}

// Event listener for making text mesh editable
document.addEventListener("dblclick", function (event) {
  if (selectedTextMesh) {
    makeTextMeshEditable(selectedTextMesh);
  }
});

let textSprite;

// Function to create text sprite
function createTextSprite(text, font, size, color) {
  const canvas = document.createElement('canvas');
  const context = canvas.getContext('2d');
  context.font = `${size}px ${font}`;
  context.fillStyle = color;
  context.fillText(text, 0, size);

  const texture = new THREE.CanvasTexture(canvas);
  const material = new THREE.SpriteMaterial({ map: texture });
  textSprite = new THREE.Sprite(material);
  textSprite.scale.set(canvas.width / 10, canvas.height / 10, 1); // Adjust scale as needed

  // Allow user to position the text on the 3D model
  textSprite.position.set(0, 0, 0.2); // Initial position
  textSprite.userData.draggable = true; // Mark as draggable

  object.add(textSprite);

  // Add drag functionality
  textSprite.on('mousedown', function (event) {
    controls.enabled = false; // Disable orbit controls while dragging
    const onMouseMove = (event) => {
      const mouse = new THREE.Vector2();
      mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
      mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

      const raycaster = new THREE.Raycaster();
      raycaster.setFromCamera(mouse, camera);
      const intersects = raycaster.intersectObject(object, true);

      if (intersects.length > 0) {
        const intersect = intersects[0];
        textSprite.position.copy(intersect.point);
      }
    };

    const onMouseUp = () => {
      controls.enabled = true; // Re-enable orbit controls
      window.removeEventListener('mousemove', onMouseMove);
      window.removeEventListener('mouseup', onMouseUp);
    };

    window.addEventListener('mousemove', onMouseMove);
    window.addEventListener('mouseup', onMouseUp);
  });
}

// Function to update text sprite
function updateTextSprite(text, font, size, color) {
  if (textSprite) {
    object.remove(textSprite);
  }
  createTextSprite(text, font, size, color);
}

// Event listener for adding text
document.getElementById("addTextButton").addEventListener("click", function () {
  const text = document.getElementById("textInput").value;
  const font = document.getElementById("fontSelect").value;
  const size = parseFloat(document.getElementById("textSize").value);
  const color = document.getElementById("textColorPicker").value;
  createTextSprite(text, font, size, color);
});

document.getElementById("textInput").addEventListener("input", function () {
  const text = this.value;
  const font = document.getElementById("fontSelect").value;
  const size = parseFloat(document.getElementById("textSize").value);
  const color = document.getElementById("textColorPicker").value;
  updateTextSprite(text, font, size, color);
});

document.getElementById("fontSelect").addEventListener("change", function () {
  const text = document.getElementById("textInput").value;
  const font = this.value;
  const size = parseFloat(document.getElementById("textSize").value);
  const color = document.getElementById("textColorPicker").value;
  updateTextSprite(text, font, size, color);
});

document.getElementById("textSize").addEventListener("input", function () {
  const text = document.getElementById("textInput").value;
  const font = document.getElementById("fontSelect").value;
  const size = parseFloat(this.value);
  const color = document.getElementById("textColorPicker").value;
  updateTextSprite(text, font, size, color);
});

function animate() {
  requestAnimationFrame(animate);

  if (object) {
    // Remove rotation, bobbing, and tilting
  }
  renderer.render(scene, camera);
}

window.addEventListener("resize", function () {
  camera.aspect = container.clientWidth / container.clientHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(container.clientWidth, container.clientHeight); // Adjust renderer size to fit the container
});

document.onmousemove = (e) => {
  mouseX = e.clientX;
  mouseY = e.clientY;
};

// Add color picker functionality
document.getElementById("garmentColorPicker").addEventListener("input", (e) => {
  const color = e.target.value;

  // Apply color to the T-shirt model material
  if (object) {
    object.traverse((node) => {
      if (node.isMesh && node.material) {
        node.material.color.set(color);
      }
    });
  }
});

animate();