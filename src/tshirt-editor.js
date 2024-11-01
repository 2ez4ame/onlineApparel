import React from 'react';
import ReactDOM from 'react-dom/client';
import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

// Create a React component
const TShirtEditor = () => {
    React.useEffect(() => {
        // Initialize the scene, camera, and renderer
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);

        // Append the renderer to the canvas
        const canvas = document.getElementById('tshirtCanvas');
        if (canvas) {
            canvas.appendChild(renderer.domElement);
        } else {
            console.error('Canvas element not found!');
        }

        // Lighting
        const ambientLight = new THREE.AmbientLight(0xffffff, 1);
        scene.add(ambientLight);
        const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
        directionalLight.position.set(0, 1, 1).normalize();
        scene.add(directionalLight);
        const hemisphereLight = new THREE.HemisphereLight(0xffffff, 0x444444, 1);
        scene.add(hemisphereLight);

        // Controls
        const controls = new OrbitControls(camera, renderer.domElement);
        controls.enableZoom = true;
        controls.enablePan = false;

        // Position the camera
        camera.position.set(0, 1, 5);

        // Load the T-shirt model
        const loader = new GLTFLoader();
        const m_url = './models/tshirt_model.glb'; // Ensure this path is correct

        console.log('Loading model from:', m_url); // Debugging log

        loader.load(
            m_url,
            function (gltf) {
                console.log("Model loaded successfully");
                const model = gltf.scene;
                scene.add(model);
                model.position.set(0, 0, 0);
                // Optional: Set model scaling if needed
                // model.scale.set(1, 1, 1);
            },
            undefined,
            function (error) {
                console.error('An error occurred while loading the model:', error);
            }
        );

        // Handle window resizing
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        // Render loop
        function animate() {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        }
        animate();

        // Clean up on component unmount
        return () => {
            window.removeEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });
            renderer.dispose();
        };
    }, []);

    return <div id="tshirtCanvas" style={{ width: '100%', height: '100vh' }} />; // Return the canvas div
};

// Ensure the DOM is fully loaded before rendering
const rootElement = document.getElementById('root');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<TShirtEditor />);
} else {
    console.error('Root element not found!');
}