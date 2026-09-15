<?php
/*
Plugin Name: Falling Petals Effect
Plugin URI: https://pendar-loka.com/plugins/falling-petals
Description: Menambahkan efek animasi kelopak bunga sakura dan mawar berjatuhan yang lembut dan elegan pada undangan digital tamu.
Version: 1.1.0
Author: Pendar Loka Studio
Author URI: https://pendar-loka.com
Icon: bi-flower1
*/

// Hook into invitation footer to render the canvas animation
add_action('invitation_footer', function($event = null) {
    ?>
    <!-- Plugin: Falling Petals Effect -->
    <canvas id="fallingPetalsCanvas" style="position:fixed;top:0;left:0;width:100vw;height:100vh;pointer-events:none;z-index:9999;"></canvas>
    <script>
    (function() {
        const canvas = document.getElementById('fallingPetalsCanvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let width = canvas.width = window.innerWidth;
        let height = canvas.height = window.innerHeight;

        window.addEventListener('resize', function() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        });

        const petalCount = 22;
        const petals = [];
        const colors = [
            'rgba(255, 183, 197, 0.65)',
            'rgba(255, 192, 203, 0.7)',
            'rgba(255, 218, 224, 0.6)',
            'rgba(213, 168, 74, 0.45)' // sentuhan emas pendar
        ];

        for (let i = 0; i < petalCount; i++) {
            petals.push({
                x: Math.random() * width,
                y: Math.random() * height,
                r: Math.random() * 5 + 4,
                d: Math.random() * petalCount,
                color: colors[Math.floor(Math.random() * colors.length)],
                tilt: Math.floor(Math.random() * 10) - 10,
                tiltAngleIncremental: (Math.random() * 0.07) + 0.05,
                tiltAngle: 0
            });
        }

        function drawPetals() {
            ctx.clearRect(0, 0, width, height);
            for (let i = 0; i < petalCount; i++) {
                const p = petals[i];
                ctx.beginPath();
                ctx.lineWidth = p.r;
                ctx.strokeStyle = p.color;
                ctx.moveTo(p.x + p.tilt + p.r / 2, p.y);
                ctx.lineTo(p.x + p.tilt, p.y + p.tilt + p.r);
                ctx.stroke();
            }
            updatePetals();
            requestAnimationFrame(drawPetals);
        }

        function updatePetals() {
            for (let i = 0; i < petalCount; i++) {
                const p = petals[i];
                p.tiltAngle += p.tiltAngleIncremental;
                p.y += (Math.cos(p.d) + 1.2 + p.r / 3) * 0.5;
                p.x += Math.sin(p.d) * 0.5;
                p.tilt = Math.sin(p.tiltAngle - (i / 3)) * 12;

                if (p.y > height) {
                    petals[i] = {
                        x: Math.random() * width,
                        y: -15,
                        r: p.r,
                        d: p.d,
                        color: p.color,
                        tilt: Math.floor(Math.random() * 10) - 10,
                        tiltAngleIncremental: p.tiltAngleIncremental,
                        tiltAngle: p.tiltAngle
                    };
                }
            }
        }

        requestAnimationFrame(drawPetals);
    })();
    </script>
    <!-- End Plugin: Falling Petals Effect -->
    <?php
});
