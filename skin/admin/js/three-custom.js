import * as THREE from 'three';

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);

const initAnimation = (selector, path) => {
    const container = document.getElementById(selector);

    // Create a scene
    const scene = new THREE.Scene();

    // Create a camera
    const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.z = 5;

    // Create a renderer
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(container.clientWidth, container.clientHeight);
    container.appendChild(renderer.domElement);

    // Load the GLTF model
    const loader = new THREE.GLTFLoader();
    loader.load(path, function(gltf) {
        const model = gltf.scene;
        scene.add(model);

        // Animate the model (if needed)
        function animate() {
            requestAnimationFrame(animate);
            // Add animation logic here
            renderer.render(scene, camera);
        }
        animate();
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const newWidth = container.clientWidth;
        const newHeight = container.clientHeight;

        camera.aspect = newWidth / newHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(newWidth, newHeight);
    });
}

