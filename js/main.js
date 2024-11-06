// Import the THREE.js library
import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";
import { OrbitControls } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";

const scene = new THREE.Scene();
let objToRender = 'tshirt';
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const headerHeight = 70;
camera.position.z = 50;
camera.position.y = 0;

const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setClearColor(0x000000, 0); // Set background color to transparent
const container = document.getElementById("container3D");
if (container) {
  container.appendChild(renderer.domElement);
  renderer.setSize(container.clientWidth, container.clientHeight);
  console.log("Renderer appended to container");
} else {
  console.error("Container element not found");
}

let mouseX = window.innerWidth / 2;
let mouseY = window.innerHeight / 2;
let object;
const loader = new GLTFLoader();

// Function to set the size of the T-shirt model
function setSize(object, size) {
  object.scale.set(size, size, size);
}

// Load the model and set its size
loader.load(
  `models/${objToRender}/scene.gltf`,
  function (gltf) {
    console.log("Model loaded:", gltf);
    object = gltf.scene;
    object.position.set(0, -5, 0);
    setSize(object, 1.0);

    object.traverse((node) => {
      if (node.isMesh) {
        node.material = new THREE.MeshStandardMaterial({
          color: "#ffffff",
          side: THREE.DoubleSide
        });
        if (node.name.includes("Shoulder")) {
          node.scale.x = 1;
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

// Initialize OrbitControls
const controls = new OrbitControls(camera, renderer.domElement);
controls.enablePan = false; // Disable panning
controls.minPolarAngle = Math.PI / 2; // Lock vertical rotation at the horizontal level
controls.maxPolarAngle = Math.PI / 2; // Lock vertical rotation at the horizontal level

// Function to create and position text sprite
function createTextSprite(text, font, size, color) {
  const canvas = document.createElement('canvas');
  const context = canvas.getContext('2d');
  context.font = `${size}px ${font}`;
  context.fillStyle = color;
  context.fillText(text, 0, size);

  const texture = new THREE.CanvasTexture(canvas);
  const material = new THREE.SpriteMaterial({ map: texture });
  textSprite = new THREE.Sprite(material);
  textSprite.scale.set(canvas.width / 10, canvas.height / 10, 1);

  textSprite.position.set(0, 0, 5); // Position it outside the model initially
  textSprite.userData.draggable = true;

  object.add(textSprite);
  addDragControls(textSprite);
}

// Function to update the text sprite's properties
function updateTextSprite(text, font, size, color) {
  if (textSprite) {
    object.remove(textSprite);
  }
  createTextSprite(text, font, size, color);
}

// Adding event listener for dragging text sprite
function addDragControls(sprite) {
  sprite.on('mousedown', function (event) {
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
        const newPosition = intersect.point;
        sprite.position.copy(newPosition);
      }
    };

    const onMouseUp = () => {
      controls.enabled = true;
      window.removeEventListener('mousemove', onMouseMove);
      window.removeEventListener('mouseup', onMouseUp);
    };

    window.addEventListener('mousemove', onMouseMove);
    window.addEventListener('mouseup', onMouseUp);
  });
}

// Function to handle view switching
function switchView(view) {
  if (view === 'front') {
    camera.position.set(0, 0, 50); // Set camera position for front view
  } else if (view === 'back') {
    camera.position.set(0, 0, -50); // Set camera position for back view
  }
}

// Function to handle saving the 3D model
function saveModel() {
  alert("3D model saved with your chosen design!");
  // Implement save functionality here
}

// Add event listeners for view buttons
const frontViewButton = document.getElementById("frontViewButton");
if (frontViewButton) {
  frontViewButton.addEventListener("click", () => switchView('front'));
}

const backViewButton = document.getElementById("backViewButton");
if (backViewButton) {
  backViewButton.addEventListener("click", () => switchView('back'));
}

const saveButton = document.getElementById("saveButton");
if (saveButton) {
  saveButton.addEventListener("click", saveModel);
}

function animate() {
  requestAnimationFrame(animate);
  renderer.render(scene, camera);
  console.log("Rendering scene");
}

window.addEventListener("resize", function () {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(container.clientWidth, container.clientHeight);
});

animate();

// Garment color update
document.getElementById("garmentColorPicker").addEventListener("input", (e) => {
  const color = e.target.value;
  document.getElementById("colorPickerCircle").style.backgroundColor = color;

  // Update color in Three.js model
  if (typeof object !== "undefined" && object) {
    object.traverse((node) => {
      if (node.isMesh && node.material) {
        node.material.color.set(color);
      }
    });
  }
});
