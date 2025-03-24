<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Visite Virtuelle - Immobilier</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

  <style>
    body { margin: 0; overflow: hidden; }
    #fullscreen3D {
      position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
      background: #111; display: flex; justify-content: center; align-items: center;
    }
    .btn-close {
      position: absolute; top: 15px; right: 15px;
      padding: 10px; background: #ff4d4d; color: white;
      border: none; border-radius: 50%; cursor: pointer;
      font-size: 20px; z-index: 10000;
    }
    .btn-close:hover { background: #cc0000; }
  </style>
</head>
<body>

  <div id="fullscreen3D">
    <button class="btn-close" id="close3D">&times;</button>
  </div>

  <script>
document.addEventListener('DOMContentLoaded', () => {
    let scene, camera, renderer, controls, sphere;
    let isZoomed = false;
    let rotationActive = true;
    let previousCameraPosition = new THREE.Vector3(); // Sauvegarde la position avant zoom

    function initThreeJS() {
        scene = new THREE.Scene();

        renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('fullscreen3D').appendChild(renderer.domElement);

        camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 2000);
        camera.position.set(0, 0, 1);

        controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.autoRotate = true;
        controls.autoRotateSpeed = 0.5;
        controls.enableZoom = false;

        const ambientLight = new THREE.AmbientLight(0xffffff, 1);
        scene.add(ambientLight);

        const textureLoader = new THREE.TextureLoader();
        textureLoader.load(
            "{{ $immobilier->user_image }}", // Image fournie par Laravel
            function (texture) {
                texture.wrapS = THREE.RepeatWrapping;
                texture.wrapT = THREE.RepeatWrapping;
                texture.repeat.set(-1, 1);

                sphere = new THREE.Mesh(
                    new THREE.SphereGeometry(1000, 60, 40),
                    new THREE.MeshBasicMaterial({ map: texture, side: THREE.BackSide })
                );
                scene.add(sphere);
                animate();
            },
            undefined,
            function (error) { console.error("Erreur de chargement de l'image", error); }
        );

        window.addEventListener('resize', onWindowResize);
        renderer.domElement.addEventListener('dblclick', onDoubleClick);
        renderer.domElement.addEventListener('click', toggleRotation);
    }

    function animate() {
        requestAnimationFrame(animate);
        if (rotationActive) controls.update(); // Mise à jour seulement si rotation active
        renderer.render(scene, camera);
    }

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }

    function onDoubleClick(event) {
        const mouse = new THREE.Vector2(
            (event.clientX / window.innerWidth) * 2 - 1,
            -(event.clientY / window.innerHeight) * 2 + 1
        );

        const raycaster = new THREE.Raycaster();
        raycaster.setFromCamera(mouse, camera);
        const intersects = raycaster.intersectObject(sphere);

        if (intersects.length > 0) {
            if (!isZoomed) {
                // Sauvegarde la position avant le zoom
                previousCameraPosition.copy(camera.position);

                // Zoom sur l'endroit cliqué
                gsap.to(camera.position, {
                    x: intersects[0].point.x,
                    y: intersects[0].point.y,
                    z: intersects[0].point.z,
                    duration: 1.5,
                    onComplete: () => isZoomed = true
                });
            } else {
                // Retour à la position enregistrée avant le zoom
                gsap.to(camera.position, {
                    x: previousCameraPosition.x,
                    y: previousCameraPosition.y,
                    z: previousCameraPosition.z,
                    duration: 1.5,
                    onComplete: () => isZoomed = false
                });
            }
        }
    }

    function toggleRotation() {
        rotationActive = !rotationActive;
    }

    document.getElementById('close3D').addEventListener('click', () => {
        window.history.back();
    });

    document.addEventListener('keyup', (e) => {
        if (e.key === 'Escape') {
            window.history.back();
        }
    });

    // 🟢 Lancer directement la visite virtuelle au chargement de la page
    initThreeJS();
});

  </script>

</body>
</html>
