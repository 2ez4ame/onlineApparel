// Import the THREE.js library
import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";
import { OrbitControls } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

let mouseX = window.innerWidth / 2;
let mouseY = window.innerHeight / 2;
let object;
let controls;
let objToRender = 'polo';
const loader = new GLTFLoader();

loader.load(
  `models/${objToRender}/scene.gltf`,
  function (gltf) {
    object = gltf.scene;
    object.position.set(0, -10, 0);
    object.scale.set(15, 15, 15); // Increase the scale to make the model larger
    
    // Set initial color for the T-shirt material
    object.traverse((node) => {
      if (node.isMesh) {
        node.material = new THREE.MeshStandardMaterial({
          color: "#ffffff", // Set initial color
          side: THREE.DoubleSide // Render both sides
        });
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
renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById("container3D").appendChild(renderer.domElement);
camera.position.z = objToRender === "polo" ? 50 : 500;

const topLight = new THREE.DirectionalLight(0xFFA07A, 1);
topLight.position.set(500, 500, 500);
topLight.castShadow = true;
scene.add(topLight);

const ambientLight = new THREE.AmbientLight(0x333333, objToRender === "polo" ? 5 : 1);
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
controls.enableDamping = true;
controls.dampingFactor = 0.25;
controls.enableZoom = true;

function animate() {
  requestAnimationFrame(animate);
  controls.update(); // Ensure the controls update the camera position
  renderer.render(scene, camera);
}

window.addEventListener("resize", function () {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
});

document.onmousemove = (e) => {
  mouseX = e.clientX;
  mouseY = e.clientY;
};

// Add color picker functionality
document.getElementById("colorPicker").addEventListener("input", (e) => {
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
