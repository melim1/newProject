@php
  $photosArray = json_decode($immobilier->photos, true);
@endphp

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
    body { margin: 0; overflow: hidden; font-family: sans-serif; }
    #fullscreen3D {
      position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
      background: #111; display: flex; justify-content: center; align-items: center;
    }
    .btn-close, .btn-nav {
      position: absolute; padding: 10px; border: none; border-radius: 8px;
      color: white; background: rgba(0,0,0,0.6); cursor: pointer; z-index: 10;
    }
    .btn-close { top: 15px; right: 15px; font-size: 20px; }
    .btn-close:hover { background: #c00; }

    .btn-nav.prev { bottom: 20px; left: 20px; }
    .btn-nav.next { bottom: 20px; right: 20px; }

    #fullscreenBtn {
      top: 15px; left: 15px;
    }

    .image-name {
      position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);
      color: white; background: rgba(0,0,0,0.6); padding: 5px 15px; border-radius: 12px;
    }

    .progress-bar {
      position: absolute; bottom: 10px; left: 0;
      width: 100%; height: 5px; background: #444;
    }
    .progress-fill {
      height: 100%; background: limegreen; width: 0%;
    }
  </style>
</head>
<body>

<div id="fullscreen3D">
  <button class="btn-close" id="close3D">&times;</button>
  <button class="btn-nav prev" id="prevImage">&#8592; Précédent</button>
  <button class="btn-nav next" id="nextImage">Suivant &#8594;</button>
  <button class="btn-nav" id="fullscreenBtn" title="Plein écran">🖥️</button>
  <div class="image-name" id="imageName">Image</div>
  <div class="progress-bar"><div class="progress-fill" id="progressFill"></div></div>
</div>

<script>
  const photos = {!! json_encode($photosArray) !!};
  const imageName = document.getElementById('imageName');
  const progressFill = document.getElementById('progressFill');
  const fullscreenBtn = document.getElementById('fullscreenBtn');

  let scene, camera, renderer, controls, sphere;
  let currentIndex = 0;
  let rotationActive = true;
  let intervalId, progressInterval;
  let textureLoader = new THREE.TextureLoader();

  function init() {
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

    const light = new THREE.AmbientLight(0xffffff, 1);
    scene.add(light);

    loadImage(currentIndex);
    animate();

    window.addEventListener('resize', onResize);
    document.getElementById('close3D').addEventListener('click', () => window.history.back());
    document.getElementById('prevImage').addEventListener('click', () => changeImage(-1));
    document.getElementById('nextImage').addEventListener('click', () => changeImage(1));
    renderer.domElement.addEventListener('dblclick', () => {
      rotationActive = !rotationActive;
      if (!rotationActive) {
        clearInterval(intervalId);
        clearInterval(progressInterval);
      } else {
        startAutoRotation();
      }
    });

    fullscreenBtn.addEventListener('click', toggleFullscreen);
    document.addEventListener('fullscreenchange', updateFullscreenButton);

    startAutoRotation();
  }

  function loadImage(index) {
    if (sphere) {
      scene.remove(sphere);
      sphere.geometry.dispose();
      sphere.material.dispose();
    }

    textureLoader.load(photos[index], texture => {
      texture.wrapS = THREE.RepeatWrapping;
      texture.wrapT = THREE.RepeatWrapping;
      texture.repeat.set(-1, 1);

      sphere = new THREE.Mesh(
        new THREE.SphereGeometry(1000, 60, 40),
        new THREE.MeshBasicMaterial({ map: texture, side: THREE.BackSide })
      );
      scene.add(sphere);
      updateImageName();
    });
  }

  function updateImageName() {
    imageName.textContent = "Image " + (currentIndex + 1) + " / " + photos.length;
  }

  function changeImage(step = 1) {
    currentIndex = (currentIndex + step + photos.length) % photos.length;
    loadImage(currentIndex);
    resetAutoRotation();
  }

  function startAutoRotation() {
    let duration = 8000;
    let progress = 0;

    intervalId = setInterval(() => {
      changeImage(1);
    }, duration);

    progressInterval = setInterval(() => {
      progress += 100 / (duration / 100);
      if (progress >= 100) progress = 0;
      progressFill.style.width = progress + "%";
    }, 100);
  }

  function resetAutoRotation() {
    clearInterval(intervalId);
    clearInterval(progressInterval);
    progressFill.style.width = "0%";
    startAutoRotation();
  }

  function animate() {
    requestAnimationFrame(animate);
    if (rotationActive) controls.update();
    renderer.render(scene, camera);
  }

  function onResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
  }

  function toggleFullscreen() {
    const container = document.getElementById('fullscreen3D');
    if (!document.fullscreenElement) {
      container.requestFullscreen().catch(err => alert("Erreur plein écran : " + err.message));
    } else {
      document.exitFullscreen();
    }
  }

  function updateFullscreenButton() {
    if (document.fullscreenElement) {
      fullscreenBtn.textContent = '🧭 Quitter';
    } else {
      fullscreenBtn.textContent = '🖥️';
    }
  }

  document.addEventListener('DOMContentLoaded', init);
</script>

</body>
</html>
