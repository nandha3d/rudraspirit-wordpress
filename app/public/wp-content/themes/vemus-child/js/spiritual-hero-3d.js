/**
 * Interactive 3D Spiritual Hero Section (ThreeJS)
 * Rudra Spirit - Sacred Geometry & Divine Energy Universe
 */
(function($) {
    "use strict";

    var threeRequested = false;

    // Only pull the Three.js library when a 3D slide actually exists on the page.
    // Pages without one (home, shop, cart, checkout...) must not pay for the CDN request.
    function ensureThreeJsAndInit() {
        if (!document.querySelector('.spiritual-threejs-hero-canvas')) return;

        if (typeof THREE !== 'undefined') {
            initAllSpiritualHeroes();
            return;
        }

        if (threeRequested) return;
        threeRequested = true;

        var script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js';
        script.onload = function() {
            initAllSpiritualHeroes();
        };
        script.onerror = function() {
            // Library unreachable: leave the slide on its normal banner image.
            threeRequested = false;
        };
        document.head.appendChild(script);
    }

    function initAllSpiritualHeroes() {
        if (typeof THREE === 'undefined') return;

        $('.spiritual-threejs-hero-canvas').each(function() {
            var container = this;
            if (container.dataset.threeInitialized === 'true') return;
            container.dataset.threeInitialized = 'true';
            try {
                initSpiritualScene(container);
                // Flags the CSS that the canvas really rendered, so the slide
                // switches from the flat banner image to the 3D presentation.
                container.dataset.threeRendered = 'true';
            } catch (e) {
                // WebGL unavailable or context creation failed: fall back to the banner image.
                container.dataset.threeInitialized = 'false';
                $(container).empty();
            }
        });
    }

    // The container is hidden by CSS until it holds a canvas, so it measures 0x0
    // on first run. Fall back to the slide image wrapper, which is the box the
    // canvas has to fill.
    function measure(container) {
        var box = container.parentElement || container;
        return {
            width: container.clientWidth || box.clientWidth || window.innerWidth,
            height: container.clientHeight || box.clientHeight || window.innerHeight
        };
    }

    function initSpiritualScene(container) {
        var size = measure(container);
        var width = size.width;
        var height = size.height;

        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera(55, width / height, 0.1, 1000);
        camera.position.z = 11;

        var renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(width, height);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        container.appendChild(renderer.domElement);

        // --- SACRED GEOMETRY ASSEMBLY ---
        var masterGroup = new THREE.Group();
        scene.add(masterGroup);

        // 1. Inner Core Sacred Orb (Rudraksha Core Sphere)
        var coreGeo = new THREE.SphereGeometry(2.3, 32, 32);
        var coreMat = new THREE.MeshStandardMaterial({
            color: 0x8B4513,
            roughness: 0.35,
            metalness: 0.75,
            emissive: 0xA0522D,
            emissiveIntensity: 0.4
        });
        var coreSphere = new THREE.Mesh(coreGeo, coreMat);
        masterGroup.add(coreSphere);

        // 2. Glowing Inner Golden Wireframe (Sacred Grid)
        var gridGeo = new THREE.IcosahedronGeometry(2.45, 2);
        var gridMat = new THREE.MeshBasicMaterial({
            color: 0xFFD700,
            wireframe: true,
            transparent: true,
            opacity: 0.35
        });
        var gridSphere = new THREE.Mesh(gridGeo, gridMat);
        masterGroup.add(gridSphere);

        // 3. Middle Sacred Dodecahedron (Yantra Outer Shield)
        var dodecaGeo = new THREE.DodecahedronGeometry(3.1, 0);
        var dodecaMat = new THREE.MeshBasicMaterial({
            color: 0xF5D061,
            wireframe: true,
            transparent: true,
            opacity: 0.25
        });
        var dodecaMesh = new THREE.Mesh(dodecaGeo, dodecaMat);
        masterGroup.add(dodecaMesh);

        // 4. Orbit Ring 1 (Gold Ring Geometry)
        var ringGeo1 = new THREE.TorusGeometry(4.0, 0.04, 16, 100);
        var ringMat1 = new THREE.MeshStandardMaterial({
            color: 0xD4AF37,
            roughness: 0.2,
            metalness: 0.9,
            emissive: 0xD4AF37,
            emissiveIntensity: 0.25
        });
        var ringMesh1 = new THREE.Mesh(ringGeo1, ringMat1);
        ringMesh1.rotation.x = Math.PI / 4;
        masterGroup.add(ringMesh1);

        // 5. Orbit Ring 2 (Outer Counter-Rotating Golden Ring)
        var ringGeo2 = new THREE.TorusGeometry(4.8, 0.03, 16, 100);
        var ringMat2 = new THREE.MeshStandardMaterial({
            color: 0xFFD700,
            roughness: 0.2,
            metalness: 0.9,
            transparent: true,
            opacity: 0.8
        });
        var ringMesh2 = new THREE.Mesh(ringGeo2, ringMat2);
        ringMesh2.rotation.y = Math.PI / 3;
        masterGroup.add(ringMesh2);

        // 6. Floating Cosmic Spiritual Dust / Aura Particles
        var particleCount = 450;
        var particlePositions = new Float32Array(particleCount * 3);
        for (var i = 0; i < particleCount * 3; i += 3) {
            particlePositions[i] = (Math.random() - 0.5) * 18;
            particlePositions[i + 1] = (Math.random() - 0.5) * 18;
            particlePositions[i + 2] = (Math.random() - 0.5) * 14;
        }
        var particleGeo = new THREE.BufferGeometry();
        particleGeo.setAttribute('position', new THREE.BufferAttribute(particlePositions, 3));
        var particleMat = new THREE.PointsMaterial({
            color: 0xFFFAF0,
            size: 0.08,
            transparent: true,
            opacity: 0.75,
            blending: THREE.AdditiveBlending
        });
        var particleSystem = new THREE.Points(particleGeo, particleMat);
        scene.add(particleSystem);

        // --- LIGHTING ---
        var ambientLight = new THREE.AmbientLight(0xFFF8DC, 0.65);
        scene.add(ambientLight);

        var pointLight1 = new THREE.PointLight(0xFF8C00, 2.5, 50);
        pointLight1.position.set(6, 6, 8);
        scene.add(pointLight1);

        var pointLight2 = new THREE.PointLight(0xFFD700, 2.0, 50);
        pointLight2.position.set(-6, -6, -6);
        scene.add(pointLight2);

        var dirLight = new THREE.DirectionalLight(0xFFFFFF, 1.2);
        dirLight.position.set(0, 10, 10);
        scene.add(dirLight);

        // --- INTERACTIVE MOUSE & TOUCH TRACKING ---
        var targetRotationX = 0;
        var targetRotationY = 0;
        var mouseX = 0;
        var mouseY = 0;
        var windowHalfX = window.innerWidth / 2;
        var windowHalfY = window.innerHeight / 2;

        function onPointerMove(event) {
            var clientX = event.clientX || (event.touches && event.touches[0] ? event.touches[0].clientX : 0);
            var clientY = event.clientY || (event.touches && event.touches[0] ? event.touches[0].clientY : 0);
            mouseX = (clientX - windowHalfX) * 0.0018;
            mouseY = (clientY - windowHalfY) * 0.0018;
        }

        window.addEventListener('mousemove', onPointerMove, false);
        window.addEventListener('touchmove', onPointerMove, { passive: true });

        // --- RESIZE HANDLING ---
        function onWindowResize() {
            var next = measure(container);
            width = next.width;
            height = next.height;
            windowHalfX = window.innerWidth / 2;
            windowHalfY = window.innerHeight / 2;
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
            renderer.setSize(width, height);
        }
        window.addEventListener('resize', onWindowResize, false);

        // --- ANIMATION & LERP LOOP ---
        var clock = new THREE.Clock();
        function animate() {
            requestAnimationFrame(animate);

            var delta = clock.getDelta();
            var elapsedTime = clock.getElapsedTime();

            // Smooth lerp rotation towards mouse / touch position
            targetRotationY += (mouseX - targetRotationY) * 0.05;
            targetRotationX += (mouseY - targetRotationX) * 0.05;

            masterGroup.rotation.y = targetRotationY + elapsedTime * 0.18;
            masterGroup.rotation.x = targetRotationX + Math.sin(elapsedTime * 0.4) * 0.15;

            // Individual component rotations for dynamic sacred depth
            gridSphere.rotation.y = -elapsedTime * 0.25;
            dodecaMesh.rotation.x = elapsedTime * 0.15;
            dodecaMesh.rotation.z = elapsedTime * 0.1;

            ringMesh1.rotation.z = elapsedTime * 0.35;
            ringMesh2.rotation.x = -elapsedTime * 0.3;
            ringMesh2.rotation.y = elapsedTime * 0.2;

            // Gentle breathing / pulsing scale effect on the core
            var pulse = 1 + Math.sin(elapsedTime * 2.2) * 0.035;
            coreSphere.scale.set(pulse, pulse, pulse);

            // Swirling particle motion
            particleSystem.rotation.y = elapsedTime * 0.06;
            particleSystem.rotation.x = targetRotationX * 0.5;

            renderer.render(scene, camera);
        }
        animate();
    }

    // Initialize on DOM ready & Elementor initialization
    $(document).ready(function() {
        ensureThreeJsAndInit();
    });

    $(window).on('elementor/frontend/init', function() {
        if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
            elementorFrontend.hooks.addAction('frontend/element_ready/vemus_slider_content.default', function() {
                setTimeout(ensureThreeJsAndInit, 100);
            });
            elementorFrontend.hooks.addAction('frontend/element_ready/vemus_slider.default', function() {
                setTimeout(ensureThreeJsAndInit, 100);
            });
        }
    });

    // Observe swiper slide transitions to refresh 3D sizing when slide 3 becomes active
    $(document).on('click', '.swiper-button, .tf-sw-pagination span', function() {
        setTimeout(initAllSpiritualHeroes, 200);
    });

})(jQuery);
