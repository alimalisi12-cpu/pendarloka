<?php
// views/partials/universal_animation_engine.php
// Pendar Loka Universal Animation & Transition Engine
// Menghubungkan seluruh 5 Tab Konfigurasi Animasi dari Dashboard Admin ke SEMUA template undangan

if (!defined('UNIVERSAL_ANIMATION_ENGINE_DEFINED')) {
    define('UNIVERSAL_ANIMATION_ENGINE_DEFINED', true);
}

$animConfig = $animConfig ?? [];
if (empty($animConfig) && isset($event['animation_config_json'])) {
    $animConfig = json_decode($event['animation_config_json'] ?? '[]', true) ?: [];
}

$animEntranceText = $animEntranceText ?? ($animConfig['entrance_text'] ?? 'slide_up');
$animEntrancePhoto = $animEntrancePhoto ?? ($animConfig['entrance_photo'] ?? 'zoom_in');
$animLoopDecor = $animLoopDecor ?? ($animConfig['loop_decor'] ?? 'floating');
$animPageTransition = $animPageTransition ?? ($animConfig['page_transition'] ?? 'slide');
$animSmoothScroll = isset($animSmoothScroll) ? $animSmoothScroll : !empty($animConfig['smooth_scroll']);
$animHoverEffect = isset($animHoverEffect) ? $animHoverEffect : !empty($animConfig['hover_effect']);
$animRevealOnScroll = isset($animRevealOnScroll) ? $animRevealOnScroll : !empty($animConfig['reveal_on_scroll']);

$textClass = $textClass ?? match($animEntranceText) {
    'fade_in' => 'anim-fade-in',
    'slide_up' => 'anim-slide-up',
    'slide_down' => 'anim-slide-down',
    'slide_left' => 'anim-slide-left',
    'slide_right' => 'anim-slide-right',
    'zoom_in' => 'anim-zoom-in',
    'bounce_in' => 'anim-bounce-in',
    'flip_in' => 'anim-flip-in',
    'roll_in' => 'anim-roll-in',
    'typewriter' => 'anim-typewriter',
    default => 'anim-slide-up'
};

$photoClass = $photoClass ?? match($animEntrancePhoto) {
    'fade_in' => 'anim-fade-in',
    'slide_up' => 'anim-slide-up',
    'slide_down' => 'anim-slide-down',
    'slide_left' => 'anim-slide-left',
    'slide_right' => 'anim-slide-right',
    'zoom_in' => 'anim-zoom-in',
    'bounce_in' => 'anim-bounce-in',
    'flip_in' => 'anim-flip-in',
    'roll_in' => 'anim-roll-in',
    default => 'anim-zoom-in'
};

$loopDecorClass = $loopDecorClass ?? match($animLoopDecor) {
    'floating' => 'decor-floating',
    'pulse' => 'decor-pulse',
    'wiggle' => 'decor-wiggle',
    'glow' => 'decor-glow',
    'parallax' => 'decor-parallax',
    default => ''
};
?>

<!-- =========================================================================
     PENDAR LOKA UNIVERSAL ANIMATION ENGINE (CSS STYLES)
     ========================================================================= -->
<style id="universal-animation-engine-css">
/* -------------------------------------------------------------
   TAB 5: EFEK INTERAKTIF - SMOOTH SCROLL
------------------------------------------------------------- */
<?php if ($animSmoothScroll): ?>
html {
    scroll-behavior: smooth !important;
}
<?php endif; ?>

/* -------------------------------------------------------------
   TAB 5: EFEK INTERAKTIF - HOVER & TOUCH ELEVATE
------------------------------------------------------------- */
<?php if ($animHoverEffect): ?>
.btn-open-invitation:hover, .cover-btn-buka:hover, .btn-luxury-gold:hover, .btn-luxury-outline:hover,
.btn-gold:hover, .btn-botanical:hover, .btn-theme:hover, .acara-card:hover, .luxury-card:hover,
.dock-item:hover, .smart-dock-item:hover, .card-template:hover, .gift-card:hover {
    transform: translateY(-4px) scale(1.02) !important;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.28) !important;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
}
<?php endif; ?>

/* -------------------------------------------------------------
   TAB 5: EFEK INTERAKTIF - REVEAL ON SCROLL
------------------------------------------------------------- */
<?php if ($animRevealOnScroll): ?>
.reveal-element:not(.is-revealed) {
    opacity: 0 !important;
    animation: none !important;
    transition: opacity 0.5s ease;
}
.reveal-element.is-revealed {
    opacity: 1 !important;
}
<?php else: ?>
.reveal-element {
    opacity: 1 !important;
}
<?php endif; ?>

/* -------------------------------------------------------------
   TAB 3: ANIMASI LATAR & LOOPING
------------------------------------------------------------- */
@keyframes animFloating {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
}
.decor-floating,
<?php if ($animLoopDecor === 'floating'): ?>
.flower-decor, .decor-leaf, .ornament, .luxury-ornament, .floating-icon, [class*="decor-flower"], .ornament-leaf,
<?php endif; ?>
.anim-floating-target {
    animation: animFloating 3.5s ease-in-out infinite !important;
}

@keyframes animPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.07); }
}
.decor-pulse,
<?php if ($animLoopDecor === 'pulse'): ?>
.btn-open-invitation, .cover-btn-buka, .btn-luxury-gold, #btnOpenInvitation, .btn-gold,
<?php endif; ?>
.anim-pulse-target {
    animation: animPulse 2s ease-in-out infinite !important;
}

@keyframes animWiggle {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-4deg); }
    75% { transform: rotate(4deg); }
}
.decor-wiggle,
<?php if ($animLoopDecor === 'wiggle'): ?>
.flower-decor, .decor-leaf, .ornament, .luxury-ornament, .floating-icon, [class*="decor-flower"],
<?php endif; ?>
.anim-wiggle-target {
    animation: animWiggle 2.5s ease-in-out infinite !important;
}

@keyframes animGlow {
    0%, 100% { filter: drop-shadow(0 0 5px rgba(212, 175, 55, 0.45)); }
    50% { filter: drop-shadow(0 0 20px rgba(212, 175, 55, 0.95)); }
}
.decor-glow,
<?php if ($animLoopDecor === 'glow'): ?>
.btn-open-invitation, .cover-btn-buka, .btn-luxury-gold, .luxury-card, .acara-card,
<?php endif; ?>
.anim-glow-target {
    animation: animGlow 2.5s ease-in-out infinite !important;
}

.decor-parallax {
    background-attachment: fixed !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-size: cover !important;
}

/* -------------------------------------------------------------
   TAB 2: ANIMASI MASUK (ENTRANCE)
------------------------------------------------------------- */
@keyframes animFadeIn { 
    from { opacity: 0; } 
    to { opacity: 1; } 
}
.anim-fade-in { 
    animation: animFadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important; 
}

@keyframes animSlideUp { 
    from { opacity: 0; transform: translateY(40px); } 
    to { opacity: 1; transform: translateY(0); } 
}
.anim-slide-up { 
    animation: animSlideUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important; 
}

@keyframes animSlideDown { 
    from { opacity: 0; transform: translateY(-40px); } 
    to { opacity: 1; transform: translateY(0); } 
}
.anim-slide-down { 
    animation: animSlideDown 1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important; 
}

@keyframes animSlideLeft { 
    from { opacity: 0; transform: translateX(40px); } 
    to { opacity: 1; transform: translateX(0); } 
}
.anim-slide-left { 
    animation: animSlideLeft 1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important; 
}

@keyframes animSlideRight { 
    from { opacity: 0; transform: translateX(-40px); } 
    to { opacity: 1; transform: translateX(0); } 
}
.anim-slide-right { 
    animation: animSlideRight 1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important; 
}

@keyframes animZoomIn { 
    from { opacity: 0; transform: scale(0.65); } 
    to { opacity: 1; transform: scale(1); } 
}
.anim-zoom-in { 
    animation: animZoomIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important; 
}

@keyframes animBounceIn {
    0% { opacity: 0; transform: scale(0.3); }
    50% { opacity: 1; transform: scale(1.08); }
    70% { transform: scale(0.92); }
    100% { opacity: 1; transform: scale(1); }
}
.anim-bounce-in { 
    animation: animBounceIn 1.1s cubic-bezier(0.215, 0.61, 0.355, 1) forwards !important; 
}

@keyframes animFlipIn {
    from { opacity: 0; transform: perspective(400px) rotateY(90deg); }
    to { opacity: 1; transform: perspective(400px) rotateY(0deg); }
}
.anim-flip-in { 
    animation: animFlipIn 1.1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important; 
}

@keyframes animRollIn {
    from { opacity: 0; transform: translateX(-100%) rotate(-120deg); }
    to { opacity: 1; transform: translateX(0) rotate(0deg); }
}
.anim-roll-in { 
    animation: animRollIn 1.1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important; 
}

/* -------------------------------------------------------------
   TAB 4: TRANSISI COVER SCREEN (BUKA UNDANGAN)
------------------------------------------------------------- */
#coverScreen, #luxuryCoverModal, .cover-transition-screen {
    transform-style: preserve-3d !important;
    transition: all 1s cubic-bezier(0.77, 0, 0.175, 1) !important;
}

/* 1. Transisi: Slide */
#coverScreen.trans-slide.opened,
#luxuryCoverModal.trans-slide.opened,
.cover-transition-screen.trans-slide.opened {
    transform: translateY(-100%) !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* 2. Transisi: Book Flip (3D) */
#coverScreen.trans-book_flip,
#luxuryCoverModal.trans-book_flip,
.cover-transition-screen.trans-book_flip {
    transform-origin: left center !important;
    perspective: 1600px !important;
}
#coverScreen.trans-book_flip.opened,
#luxuryCoverModal.trans-book_flip.opened,
.cover-transition-screen.trans-book_flip.opened {
    transform: rotateY(-110deg) scale(0.9) !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* 3. Transisi: Cross Dissolve / Fade */
#coverScreen.trans-cross_dissolve.opened,
#luxuryCoverModal.trans-cross_dissolve.opened,
.cover-transition-screen.trans-cross_dissolve.opened {
    opacity: 0 !important;
    transform: scale(1.08) !important;
    pointer-events: none !important;
}

/* 4. Transisi: Zoom */
#coverScreen.trans-zoom.opened,
#luxuryCoverModal.trans-zoom.opened,
.cover-transition-screen.trans-zoom.opened {
    transform: scale(2.8) !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* 5. Transisi: Push */
#coverScreen.trans-push.opened,
#luxuryCoverModal.trans-push.opened,
.cover-transition-screen.trans-push.opened {
    transform: translateY(-100%) !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

#coverScreen.trans-wipe,
#luxuryCoverModal.trans-wipe,
.cover-transition-screen.trans-wipe {
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
    transition: clip-path 1.1s cubic-bezier(0.77, 0, 0.175, 1), opacity 0.9s ease !important;
}
#coverScreen.trans-wipe.opened,
#luxuryCoverModal.trans-wipe.opened,
.cover-transition-screen.trans-wipe.opened {
    clip-path: polygon(0 0, 100% 0, 100% 0, 0 0) !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* 7. Transisi: Glitch */
#coverScreen.trans-glitch.opened,
#luxuryCoverModal.trans-glitch.opened,
.cover-transition-screen.trans-glitch.opened {
    filter: invert(0.8) hue-rotate(180deg) blur(3px) !important;
    transform: skewX(25deg) scale(0.9) !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

</style>

<!-- =========================================================================
     PENDAR LOKA UNIVERSAL ANIMATION ENGINE (JAVASCRIPT)
     ========================================================================= -->
<script id="universal-animation-engine-js">
document.addEventListener('DOMContentLoaded', function() {
    const textAnimClass = '<?= $textClass ?>';
    const photoAnimClass = '<?= $photoClass ?>';
    const isRevealEnabled = <?= $animRevealOnScroll ? 'true' : 'false' ?>;

    // Helper: Reveal elements currently in viewport
    function revealElementsInViewport() {
        document.querySelectorAll('.reveal-element').forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                const anim = el.getAttribute('data-anim') || textAnimClass;
                el.classList.add(anim);
                el.classList.add('is-revealed');
                el.style.opacity = '1';
            }
        });
    }

    // 1. Reveal on Scroll (Tab 5)
    if (isRevealEnabled) {
        if ('IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const anim = el.getAttribute('data-anim') || textAnimClass;
                        el.classList.add(anim);
                        el.classList.add('is-revealed');
                        el.style.opacity = '1';
                        revealObserver.unobserve(el);
                    }
                });
            }, { threshold: 0.12 });

            document.querySelectorAll('.reveal-element').forEach(el => {
                revealObserver.observe(el);
            });
        } else {
            revealElementsInViewport();
        }
    } else {
        document.querySelectorAll('.reveal-element').forEach(el => {
            el.classList.add('is-revealed');
            el.style.opacity = '1';
        });
    }

    // 2. Typewriter Effect (Tab 2: typewriter)
    <?php if ($animEntranceText === 'typewriter'): ?>
    function runTypewriter() {
        const typeTargets = document.querySelectorAll('.typewriter-target, .the-wedding-names, .cover-mempelai, h1.heading-font, h1.font-script');
        typeTargets.forEach(el => {
            if (el.dataset.typewriterDone) return;
            el.dataset.typewriterDone = '1';
            const fullText = el.innerText.trim();
            el.innerText = '';
            el.style.opacity = '1';
            let charIdx = 0;
            function stepType() {
                if (charIdx < fullText.length) {
                    el.innerText += fullText.charAt(charIdx);
                    charIdx++;
                    setTimeout(stepType, 35);
                }
            }
            setTimeout(stepType, 300);
        });
    }
    runTypewriter();
    <?php endif; ?>

    // 3. Particle Effect Engine (Tab 3: particle)
    <?php if ($animLoopDecor === 'particle'): ?>
    if (!document.getElementById('universalParticleCanvas') && document.body) {
        const pCanvas = document.createElement('canvas');
        pCanvas.id = 'universalParticleCanvas';
        pCanvas.style.cssText = 'position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; pointer-events: none; z-index: 99;';
        document.body.appendChild(pCanvas);

        const ctx = pCanvas.getContext('2d');
        function resizePCanvas() {
            pCanvas.width = window.innerWidth;
            pCanvas.height = window.innerHeight;
        }
        resizePCanvas();
        window.addEventListener('resize', resizePCanvas);

        const particles = [];
        for (let i = 0; i < 35; i++) {
            particles.push({
                x: Math.random() * window.innerWidth,
                y: Math.random() * window.innerHeight,
                size: Math.random() * 4 + 2,
                speedY: Math.random() * 1.4 + 0.6,
                speedX: (Math.random() - 0.5) * 1.2,
                opacity: Math.random() * 0.7 + 0.3,
                color: 'rgba(212, 175, 55, ' + (Math.random() * 0.6 + 0.25) + ')'
            });
        }

        function renderParticles() {
            ctx.clearRect(0, 0, pCanvas.width, pCanvas.height);
            particles.forEach(p => {
                p.y += p.speedY;
                p.x += p.speedX;
                if (p.y > pCanvas.height) { 
                    p.y = -10; 
                    p.x = Math.random() * pCanvas.width; 
                }
                if (p.x > pCanvas.width) p.x = 0;
                if (p.x < 0) p.x = pCanvas.width;

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fillStyle = p.color;
                ctx.fill();
            });
            requestAnimationFrame(renderParticles);
        }
        renderParticles();
    }
    <?php endif; ?>

    // 4. Pastikan Cover Screen memiliki class transisi yang sesuai
    const covers = document.querySelectorAll('#coverScreen, #luxuryCoverModal, .cover-transition-screen');
    covers.forEach(cover => {
        if (!cover.classList.contains('trans-<?= $animPageTransition ?>')) {
            cover.classList.add('trans-<?= $animPageTransition ?>');
        }
    });

    // 5. Universal Handler Buka Undangan
    function triggerOpenCover(cover) {
        if (!cover || cover.classList.contains('opened')) return;
        cover.classList.add('opened');
        
        // Trigger reveal viewport elements immediately upon opening cover
        setTimeout(() => {
            revealElementsInViewport();
            <?php if ($animEntranceText === 'typewriter'): ?>
            runTypewriter();
            <?php endif; ?>
        }, 150);

        setTimeout(() => {
            cover.style.display = 'none';
        }, 1100);
    }

    document.querySelectorAll('.btn-open-invitation, .cover-btn-buka, [onclick*="openInvitation"], [onclick*="openLuxuryInvitation"], [onclick*="unlockInvitation"]').forEach(btn => {
        btn.addEventListener('click', function() {
            const cover = document.getElementById('luxuryCoverModal') || document.getElementById('coverScreen') || document.querySelector('.cover-transition-screen');
            triggerOpenCover(cover);
        });
    });

    // 6. Support auto-open jika ada parameter ?show_gift=1
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('show_gift') === '1' || window.location.hash === '#gift-modal' || window.location.hash === '#show_gift') {
        const cover = document.getElementById('luxuryCoverModal') || document.getElementById('coverScreen') || document.querySelector('.cover-transition-screen');
        if (cover) {
            triggerOpenCover(cover);
        }
    }
});
</script>