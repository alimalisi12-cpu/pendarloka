<?php
// views/templates/nature_classic.php
// Replika & Peningkatan Tema 79 IndoInvite (Elegan Nature & Classic)
// Mendukung kustomisasi warna, font, dan partikel efek oleh Admin!

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$loveStories = json_decode($event['love_story_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];
$customSchedules = json_decode($event['events_schedule_json'] ?? '[]', true) ?: [];

// Konfigurasi Kustomisasi Tema oleh Admin
$primaryColor = $themeConfig['primary_color'] ?? '#928573';
$secondaryColor = $themeConfig['secondary_color'] ?? '#E1D6C7';
$fontHeading = $themeConfig['font_heading'] ?? 'Great Vibes';
$fontBody = $themeConfig['font_body'] ?? 'Playfair Display';
$particleEffect = $themeConfig['effect_particle'] ?? 'petals';
$showNavDock = !empty($themeConfig['show_nav_dock']);
$bgPattern = $themeConfig['bg_pattern'] ?? 'floral';

// Konfigurasi Animasi, Efek, dan Transisi Universal (Template Engine)
$animConfig = $animConfig ?? (json_decode($event['animation_config_json'] ?? '[]', true) ?: []);
$animEntranceText = $animEntranceText ?? ($animConfig['entrance_text'] ?? 'slide_up');
$animEntrancePhoto = $animEntrancePhoto ?? ($animConfig['entrance_photo'] ?? 'zoom_in');
$animLoopDecor = $animLoopDecor ?? ($animConfig['loop_decor'] ?? 'floating');
$animPageTransition = $animPageTransition ?? ($animConfig['page_transition'] ?? 'slide');
$animSmoothScroll = isset($animSmoothScroll) ? $animSmoothScroll : !empty($animConfig['smooth_scroll']);
$animHoverEffect = isset($animHoverEffect) ? $animHoverEffect : !empty($animConfig['hover_effect']);
$animRevealOnScroll = isset($animRevealOnScroll) ? $animRevealOnScroll : !empty($animConfig['reveal_on_scroll']);

$textClass = match($animEntranceText) {
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

$photoClass = match($animEntrancePhoto) {
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

$loopDecorClass = match($animLoopDecor) {
    'floating' => 'decor-floating',
    'pulse' => 'decor-pulse',
    'wiggle' => 'decor-wiggle',
    'glow' => 'decor-glow',
    'parallax' => 'decor-parallax',
    default => ''
};

// Konfigurasi Foto Kustom & Fallback
$defaultNatureCover = "https://media.indoinvite.com/2db3bf1e16cd47a08843bb881e39cce7:indoinvite-staging/indoinvite-staging/indoinvite-staging/nikah/upload/sampul_19521762398202.jpeg";
$coverImage = !empty($event['cover_photo']) ? media_url($event['cover_photo']) : (!empty($event['cover_image']) ? media_url($event['cover_image']) : (!empty($galleries[0]) ? media_url($galleries[0]) : $defaultNatureCover));
$heroPhoto = !empty($event['hero_photo']) ? media_url($event['hero_photo']) : (!empty($galleries[0]) ? media_url($galleries[0]) : '');
$bgPhoto = !empty($event['bg_photo']) ? media_url($event['bg_photo']) : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['title']) ?></title>

    <!-- Dynamic Favicon -->
    <?php $favUrl = site_favicon_url(); ?>
    <?php if (!empty($favUrl)): ?>
        <link rel="icon" href="<?= htmlspecialchars($favUrl) ?>">
        <link rel="apple-touch-icon" href="<?= htmlspecialchars($favUrl) ?>">
    <?php else: ?>
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/833/833472.png" type="image/png">
    <?php endif; ?>

    <!-- OpenGraph Metadata -->
    <meta property="og:title" content="<?= htmlspecialchars($event['title']) ?>">
    <meta property="og:description" content="Kami mengundang Anda untuk menghadiri acara kami: <?= htmlspecialchars($guestName) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($coverImage) ?>">

    <!-- Google Fonts Dinamis -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Alex+Brush&family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Averia+Serif+Libre:wght@400;700&family=Sacramento&family=Marcellus&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Custom Style Berdasarkan Pengaturan Admin -->
    <style>
        :root {
            --theme-primary: <?= $primaryColor ?>;
            --theme-secondary: <?= $secondaryColor ?>;
            --theme-dark: #2B2927;
            --theme-bg: #FCFBF7;
            --font-heading: '<?= $fontHeading ?>', cursive, serif;
            --font-body: '<?= $fontBody ?>', serif, sans-serif;
        }

        body {
            font-family: var(--font-body);
            background-color: #262626;
            color: #333333;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .heading-font {
            font-family: var(--font-heading) !important;
        }

        /* Container Pembatas Layar (Mobile Frame) */
        .invitation-container {
            max-width: 480px;
            margin: 0 auto;
            background-color: var(--theme-bg);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 60px rgba(0,0,0,0.5);
            padding-bottom: 90px;
        }

        /* Motif Background */
        <?php if (!empty($bgPhoto)): ?>
        .invitation-container {
            background-image: linear-gradient(rgba(252, 251, 247, 0.92), rgba(252, 251, 247, 0.92)), url('<?= htmlspecialchars($bgPhoto) ?>') !important;
            background-size: cover !important;
            background-attachment: fixed !important;
            background-position: center !important;
        }
        body {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?= htmlspecialchars($bgPhoto) ?>') center/cover fixed !important;
        }
        <?php elseif ($bgPattern === 'floral'): ?>
        .invitation-container {
            background-image: radial-gradient(#e7ded3 1px, transparent 1px), radial-gradient(#e7ded3 1px, var(--theme-bg) 1px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
        }
        <?php endif; ?>

        /* -----------------------------------------------------------------
           SISTEM EFEK & TRANSISI UNIVERSAL (PENDAR LOKA ANIMATION ENGINE)
        ----------------------------------------------------------------- */
        <?php if ($animSmoothScroll): ?>
        html { scroll-behavior: smooth !important; }
        <?php endif; ?>

        <?php if ($animHoverEffect): ?>
        .btn-open-invitation:hover, .btn-theme:hover, .acara-card:hover, .dock-item:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        <?php endif; ?>

        /* 1. Animasi Looping / Latar & Dekorasi */
        @keyframes animFloating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .decor-floating { animation: animFloating 3.5s ease-in-out infinite; }

        @keyframes animPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.07); }
        }
        .decor-pulse { animation: animPulse 2s ease-in-out infinite; }

        @keyframes animWiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-3deg); }
            75% { transform: rotate(3deg); }
        }
        .decor-wiggle { animation: animWiggle 2.5s ease-in-out infinite; }

        @keyframes animGlow {
            0%, 100% { filter: drop-shadow(0 0 5px rgba(212, 175, 55, 0.4)); }
            50% { filter: drop-shadow(0 0 16px rgba(212, 175, 55, 0.85)); }
        }
        .decor-glow { animation: animGlow 2.5s ease-in-out infinite; }

        .decor-parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* 2. Animasi Masuk (Entrance) */
        @keyframes animFadeIn { from { opacity: 0; } to { opacity: 1; } }
        .anim-fade-in { animation: animFadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        @keyframes animSlideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        .anim-slide-up { animation: animSlideUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        @keyframes animSlideDown { from { opacity: 0; transform: translateY(-40px); } to { opacity: 1; transform: translateY(0); } }
        .anim-slide-down { animation: animSlideDown 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        @keyframes animSlideLeft { from { opacity: 0; transform: translateX(40px); } to { opacity: 1; transform: translateX(0); } }
        .anim-slide-left { animation: animSlideLeft 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        @keyframes animSlideRight { from { opacity: 0; transform: translateX(-40px); } to { opacity: 1; transform: translateX(0); } }
        .anim-slide-right { animation: animSlideRight 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        @keyframes animZoomIn { from { opacity: 0; transform: scale(0.65); } to { opacity: 1; transform: scale(1); } }
        .anim-zoom-in { animation: animZoomIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        @keyframes animBounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.08); }
            70% { transform: scale(0.92); }
            100% { opacity: 1; transform: scale(1); }
        }
        .anim-bounce-in { animation: animBounceIn 1.1s cubic-bezier(0.215, 0.61, 0.355, 1) forwards; }

        @keyframes animFlipIn {
            from { opacity: 0; transform: perspective(400px) rotateY(90deg); }
            to { opacity: 1; transform: perspective(400px) rotateY(0deg); }
        }
        .anim-flip-in { animation: animFlipIn 1.1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        @keyframes animRollIn {
            from { opacity: 0; transform: translateX(-100%) rotate(-120deg); }
            to { opacity: 1; transform: translateX(0) rotate(0deg); }
        }
        .anim-roll-in { animation: animRollIn 1.1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        /* Reveal on scroll base state */
        <?php if ($animRevealOnScroll): ?>
        .reveal-element {
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        <?php endif; ?>

        /* 3. COVER SCREEN & TRANSISI ANTAR-HALAMAN */
        #coverScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            max-width: 100%;
            height: 100vh;
            z-index: 99999;
            background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.75)), 
                        url('<?= htmlspecialchars($coverImage) ?>') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 50px 24px;
            color: #ffffff;
            text-align: center;
            transform-style: preserve-3d;
            transition: all 1s cubic-bezier(0.77, 0, 0.175, 1);
        }

        /* Transisi: Slide */
        #coverScreen.trans-slide.opened {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        /* Transisi: Book Flip (3D) */
        #coverScreen.trans-book_flip {
            transform-origin: left center;
            perspective: 1600px;
        }
        #coverScreen.trans-book_flip.opened {
            transform: rotateY(-110deg) scale(0.9);
            opacity: 0;
            pointer-events: none;
        }

        /* Transisi: Cross Dissolve / Fade */
        #coverScreen.trans-cross_dissolve.opened {
            opacity: 0;
            transform: scale(1.08);
            pointer-events: none;
        }

        /* Transisi: Zoom */
        #coverScreen.trans-zoom.opened {
            transform: scale(2.8);
            opacity: 0;
            pointer-events: none;
        }

        /* Transisi: Push */
        #coverScreen.trans-push.opened {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        /* Transisi: Wipe */
        #coverScreen.trans-wipe.opened {
            clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
            opacity: 0;
            pointer-events: none;
        }

        /* Transisi: Glitch */
        #coverScreen.trans-glitch.opened {
            filter: invert(0.8) hue-rotate(180deg) blur(3px);
            transform: skewX(25deg) scale(0.9);
            opacity: 0;
            pointer-events: none;
        }

        .cover-box {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 24px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        /* Tombol Buka Undangan */
        .btn-open-invitation {
            background-color: var(--theme-primary);
            color: #ffffff;
            border: 2px solid rgba(255,255,255,0.4);
            font-weight: 600;
            padding: 10px 32px;
            border-radius: 50px;
            transition: all 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .btn-open-invitation:hover {
            transform: scale(1.05);
            background-color: #ffffff;
            color: var(--theme-primary);
        }

        /* 2. STATIS FLOATING FOOTER DOCK (PERSIS SEPERTI GAMBAR USER) */
        .static-footer-dock {
            position: fixed;
            bottom: 16px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 30px);
            max-width: 420px;
            height: 52px;
            background: linear-gradient(135deg, #e67e22, #d35400);
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(211, 84, 0, 0.4), 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1040;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            padding: 0 6px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .static-dock-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            color: #ffffff;
            text-decoration: none;
            background: transparent;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275), background-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .static-dock-btn:hover {
            color: #ffffff;
            transform: translateY(-3px) scale(1.1);
        }

        .static-dock-btn:active {
            transform: scale(0.95);
        }

        /* Tombol Kotak Biru (Tombol ke-6 Auto Scroll & ke-7 Musik Player sesuai gambar) */
        .static-dock-btn-blue {
            background-color: #2563eb !important;
            border-radius: 8px !important;
            width: 36px;
            height: 36px;
            box-shadow: 0 3px 8px rgba(37, 99, 235, 0.35);
        }

        .static-dock-btn-blue:hover {
            background-color: #1d4ed8 !important;
            box-shadow: 0 5px 14px rgba(37, 99, 235, 0.5);
            color: #ffffff;
        }

        .static-dock-btn-blue.playing,
        .static-dock-btn-blue.scrolling-active {
            background-color: #1d4ed8 !important;
            animation: musicBtnPulse 1.8s infinite;
        }

        @keyframes musicBtnPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.6); }
            50% { box-shadow: 0 0 0 8px rgba(37, 99, 235, 0); }
        }

        /* 3. FLOATING MUSIC TOGGLE */
        .music-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1001;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--theme-primary);
            color: #ffffff;
            border: 2px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            transition: transform 0.3s;
        }

        .music-btn.spinning {
            animation: spinMusic 4s linear infinite;
        }

        @keyframes spinMusic {
            100% { transform: rotate(360deg); }
        }

        /* 4. CANVAS PARTIKEL EFEK (Kelopak Bunga / Sparkles) */
        #particleCanvas {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            height: 100%;
            pointer-events: none;
            z-index: 999;
        }

        /* Section Universal */
        .section-box {
            padding: 60px 24px;
            text-align: center;
            position: relative;
        }

        .theme-divider {
            width: 70px;
            height: 3px;
            background-color: var(--theme-primary);
            margin: 15px auto 25px auto;
            border-radius: 10px;
        }

        /* Countdown Card */
        .countdown-segment {
            background-color: #ffffff;
            border: 2px solid var(--theme-primary);
            border-radius: 12px;
            padding: 10px;
            min-width: 68px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.04);
        }

        /* Mempelai Circle Avatar */
        .avatar-frame {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px double var(--theme-primary);
            padding: 4px;
            margin: 0 auto 16px auto;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .avatar-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Event Card */
        .acara-card {
            background-color: #ffffff;
            border: 1px solid var(--theme-secondary);
            border-radius: 20px;
            padding: 30px 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            position: relative;
        }

        .btn-theme {
            background-color: var(--theme-primary);
            color: #ffffff;
            border: none;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-theme:hover {
            background-color: #333333;
            color: #ffffff;
        }

        /* Wishes Bubble */
        .comment-card {
            background-color: #ffffff;
            border-left: 4px solid var(--theme-primary);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            text-align: left;
        }
    </style>
    <?php do_action('invitation_head', $event); ?>
</head>
<body>

<?php
$rawMusic = $event['music_url'] ?? '';
if (!empty($rawMusic)) {
    if (!str_starts_with($rawMusic, 'http://') && !str_starts_with($rawMusic, 'https://')) {
        $musicUrl = base_url($rawMusic);
    } else {
        $musicUrl = $rawMusic;
    }
} else {
    $musicUrl = base_url('assets/audio/wedding_music.mp3');
}
?>
<!-- Audio Player -->
<audio id="invitationAudio" loop preload="auto">
    <source src="<?= htmlspecialchars($musicUrl) ?>" type="audio/mpeg">
</audio>

<!-- Floating Audio Control -->
<div class="music-btn" id="audioToggle" onclick="toggleAudio()" style="display: none;" title="Musik Latar">
    <i class="bi bi-disc-fill fs-5" id="audioIcon"></i>
</div>

<!-- Canvas Partikel (Efek Guguran Kelopak Bunga / Partikel) -->
<canvas id="particleCanvas"></canvas>

<!-- Container Layar Mobile -->
<div class="invitation-container" id="invitationContent">

    <!-- 1. COVER SCREEN (PERSIS TEMA 79) -->
    <div id="coverScreen" class="trans-<?= $animPageTransition ?> cover-transition-screen">
        <div class="animate__animated animate__fadeInDown">
            <span class="badge bg-white bg-opacity-25 px-3 py-1 rounded-pill small text-uppercase tracking-wider mb-2">The Wedding Of</span>
            <h1 class="heading-font display-2 m-0 text-white"><?= htmlspecialchars($event['groom_nickname'] ?: 'Justin') ?> & <?= htmlspecialchars($event['bride_nickname'] ?: 'Sisca') ?></h1>
        </div>

        <div class="cover-box animate__animated animate__zoomIn">
            <p class="small text-white-50 mb-1">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            <h4 class="fw-bold text-white mb-2"><?= htmlspecialchars($guestName) ?></h4>
            <p class="text-white-50 small mb-4" style="font-size: 11px;">Kami mengundang Anda untuk hadir dalam momen bahagia kami.</p>

            <button class="btn-open-invitation <?= $animLoopDecor === 'pulse' ? 'decor-pulse' : '' ?> d-inline-flex align-items-center animate__animated animate__pulse animate__infinite" onclick="unlockInvitation()">
                <i class="bi bi-envelope-open-fill me-2"></i> Buka Undangan
            </button>
        </div>

        <div class="small text-white-50">
            <i class="bi bi-calendar-heart me-1"></i> <?= date('d F Y', strtotime($event['event_date'])) ?>
        </div>
    </div>

    <!-- 2. BERANDA SECTION -->
    <section class="section-box pt-5" id="section-home">
        <span class="text-muted small text-uppercase tracking-widest d-block">Walimatul 'Ursy</span>
        <h1 class="heading-font display-3 my-2" style="color: var(--theme-primary);">
            <?= htmlspecialchars($event['groom_nickname'] ?: 'Justin') ?> & <?= htmlspecialchars($event['bride_nickname'] ?: 'Sisca') ?>
        </h1>
        <p class="text-muted small"><?= date('l, d F Y', strtotime($event['event_date'])) ?></p>
        
        <div class="theme-divider"></div>

        <!-- Countdown Timer -->
        <div class="d-flex justify-content-center gap-2 mt-4">
            <div class="countdown-segment text-center">
                <span class="fs-4 fw-bold d-block text-dark" id="cdDays">00</span>
                <span class="text-muted small" style="font-size: 10px;">Hari</span>
            </div>
            <div class="countdown-segment text-center">
                <span class="fs-4 fw-bold d-block text-dark" id="cdHours">00</span>
                <span class="text-muted small" style="font-size: 10px;">Jam</span>
            </div>
            <div class="countdown-segment text-center">
                <span class="fs-4 fw-bold d-block text-dark" id="cdMinutes">00</span>
                <span class="text-muted small" style="font-size: 10px;">Menit</span>
            </div>
            <div class="countdown-segment text-center">
                <span class="fs-4 fw-bold d-block text-dark" id="cdSeconds">00</span>
                <span class="text-muted small" style="font-size: 10px;">Detik</span>
            </div>
        </div>

        <?php if (!empty($heroPhoto)): ?>
            <div class="my-4 px-3">
                <img src="<?= htmlspecialchars($heroPhoto) ?>" class="img-fluid rounded-4 shadow reveal-element <?= $photoClass ?>" style="max-height: 420px; width: 100%; object-fit: cover; border: 2px solid var(--theme-secondary);" alt="Foto Utama Undangan">
            </div>
        <?php endif; ?>
    </section>

    <!-- 3. KATA MUTIARA / AYAT -->
    <section class="section-box py-3">
        <div class="p-4 rounded-4 bg-white border shadow-sm reveal-element" data-anim="<?= $textClass ?>" style="border-color: var(--theme-secondary) !important;">
            <i class="bi bi-quote fs-1 <?= $loopDecorClass ?>" style="color: var(--theme-primary);"></i>
            <p class="fst-italic text-muted small lh-lg m-0 typewriter-target">
                <?= nl2br(htmlspecialchars($event['quote'] ?: 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya.')) ?>
            </p>
        </div>
    </section>

    <!-- 4. KEDUA MEMPELAI -->
    <section class="section-box" id="section-couple">
        <h3 class="heading-font display-5 mb-1 reveal-element" data-anim="<?= $textClass ?>" style="color: var(--theme-primary);">Kedua Mempelai</h3>
        <p class="text-muted small mb-4 reveal-element" data-anim="<?= $textClass ?>">Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud mengikat janji suci:</p>

        <!-- Pria -->
        <div class="mb-4 reveal-element" data-anim="<?= $textClass ?>">
            <div class="avatar-frame <?= $loopDecorClass ?>" data-anim="<?= $photoClass ?>">
                <img src="<?= htmlspecialchars(!empty($event['groom_photo']) ? media_url($event['groom_photo']) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400') ?>" alt="<?= htmlspecialchars($event['groom_name'] ?: 'Groom') ?>">
            </div>
            <h4 class="fw-bold text-dark m-0"><?= htmlspecialchars($event['groom_name'] ?: 'Justins Pratama, S.Kom') ?></h4>
            <p class="text-muted small mt-1 mb-2"><?= htmlspecialchars($event['groom_parents'] ?: 'Putra tercinta Bpk. Bambang & Ibu Sri') ?></p>
            <?php if (!empty($event['groom_instagram'])): ?>
                <a href="https://instagram.com/<?= ltrim($event['groom_instagram'], '@') ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1" style="font-size: 11px;">
                    <i class="bi bi-instagram text-danger me-1"></i> <?= htmlspecialchars($event['groom_instagram']) ?>
                </a>
            <?php endif; ?>
        </div>

        <div class="display-6 heading-font my-2 <?= $loopDecorClass ?>" style="color: var(--theme-primary);">&</div>

        <!-- Wanita -->
        <div class="mt-4 reveal-element" data-anim="<?= $textClass ?>">
            <div class="avatar-frame <?= $loopDecorClass ?>" data-anim="<?= $photoClass ?>">
                <img src="<?= htmlspecialchars(!empty($event['bride_photo']) ? media_url($event['bride_photo']) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400') ?>" alt="<?= htmlspecialchars($event['bride_name'] ?: 'Bride') ?>">
            </div>
            <h4 class="fw-bold text-dark m-0"><?= htmlspecialchars($event['bride_name'] ?: 'Sisca Priscillia, S.Pd') ?></h4>
            <p class="text-muted small mt-1 mb-2"><?= htmlspecialchars($event['bride_parents'] ?: 'Putri tercinta Bpk. H. Ahmad & Ibu Fatimah') ?></p>
            <?php if (!empty($event['bride_instagram'])): ?>
                <a href="https://instagram.com/<?= ltrim($event['bride_instagram'], '@') ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1" style="font-size: 11px;">
                    <i class="bi bi-instagram text-danger me-1"></i> <?= htmlspecialchars($event['bride_instagram']) ?>
                </a>
            <?php endif; ?>
        </div>
    </section>

    <!-- 5. WAKTU & TEMPAT ACARA -->
    <section class="section-box bg-white" id="section-event">
        <h3 class="heading-font display-5 mb-1" style="color: var(--theme-primary);">Waktu & Lokasi</h3>
        <div class="theme-divider"></div>

        <?php if (!empty($customSchedules)): ?>
            <?php foreach ($customSchedules as $session): ?>
                <div class="acara-card">
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small mb-2 text-uppercase"><?= htmlspecialchars($session['name'] ?? 'Acara') ?></span>
                    <h4 class="fw-bold text-dark mb-2"><?= htmlspecialchars($session['name'] ?? 'Acara') ?></h4>
                    <?php if (!empty($session['date'])): ?>
                        <p class="fw-bold text-dark small mb-1"><i class="bi bi-calendar3 me-1 text-primary"></i> <?= date('l, d F Y', strtotime($session['date'])) ?></p>
                    <?php endif; ?>
                    <p class="fw-bold text-muted small mb-2"><i class="bi bi-clock me-1 text-primary"></i> <?= htmlspecialchars($session['time'] ?? '') ?></p>
                    <?php if (!empty($session['place'])): ?>
                        <p class="fw-bold text-secondary small mb-1"><i class="bi bi-building me-1"></i> <?= htmlspecialchars($session['place']) ?></p>
                    <?php endif; ?>
                    <p class="text-muted small mb-0"><i class="bi bi-geo-alt me-1 text-danger"></i> <?= nl2br(htmlspecialchars($session['address'] ?? '')) ?></p>
                    <?php if (!empty($session['maps_url'])): ?>
                        <div class="mt-3">
                            <a href="<?= htmlspecialchars($session['maps_url']) ?>" target="_blank" class="btn btn-theme btn-sm rounded-pill px-4 py-2">
                                <i class="bi bi-pin-map-fill me-1"></i> Buka Google Maps
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?php if (!empty($event['maps_url']) && empty($session['maps_url'])): ?>
                <div class="text-center my-3">
                    <a href="<?= htmlspecialchars($event['maps_url']) ?>" target="_blank" class="btn btn-theme btn-sm rounded-pill px-4 py-2">
                        <i class="bi bi-pin-map-fill me-1"></i> Buka Google Maps Lokasi
                    </a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <!-- Akad -->
            <div class="acara-card">
                <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small mb-2">AKAD NIKAH</span>
                <h4 class="fw-bold text-dark mb-3">Akad Nikah</h4>
                <p class="fw-bold text-muted small"><i class="bi bi-clock me-1 text-primary"></i> <?= htmlspecialchars($event['akad_time'] ?: '08.00 - 10.00 WIB') ?></p>
                <p class="text-muted small mb-0"><i class="bi bi-geo-alt me-1 text-danger"></i> <?= nl2br(htmlspecialchars($event['akad_location'] ?? '')) ?></p>
            </div>

            <!-- Resepsi -->
            <div class="acara-card">
                <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small mb-2">RESEPSI</span>
                <h4 class="fw-bold text-dark mb-3">Resepsi Pernikahan</h4>
                <p class="fw-bold text-muted small"><i class="bi bi-clock me-1 text-primary"></i> <?= htmlspecialchars($event['resepsi_time'] ?: '11.00 - 14.00 WIB') ?></p>
                <p class="text-muted small mb-3"><i class="bi bi-geo-alt me-1 text-danger"></i> <?= nl2br(htmlspecialchars($event['resepsi_location'] ?? '')) ?></p>

                <?php if (!empty($event['maps_url'])): ?>
                    <a href="<?= $event['maps_url'] ?>" target="_blank" class="btn btn-theme btn-sm rounded-pill px-4 py-2 mt-2">
                        <i class="bi bi-pin-map-fill me-1"></i> Buka Google Maps
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($event['maps_embed'])): ?>
            <div class="rounded-4 overflow-hidden border shadow-sm mt-3">
                <?= $event['maps_embed'] ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- 6. LOVE STORY TIMELINE -->
    <?php if (!empty($loveStories)): ?>
        <section class="section-box" id="section-story">
            <h3 class="heading-font display-5 mb-1" style="color: var(--theme-primary);">Kisah Cinta</h3>
            <div class="theme-divider"></div>
            <div class="text-start">
                <?php foreach ($loveStories as $story): ?>
                    <div class="p-3 bg-white rounded-4 border shadow-sm mb-3">
                        <?php if (!empty($story['image'])): ?>
                            <img src="<?= htmlspecialchars(media_url($story['image'])) ?>" class="img-fluid rounded-3 mb-2 w-100" style="max-height: 220px; object-fit: cover;" alt="<?= htmlspecialchars($story['title'] ?? 'Kisah Cinta') ?>">
                        <?php endif; ?>
                        <?php if (!empty($story['year']) || !empty($story['date'])): ?>
                            <span class="badge bg-secondary-subtle text-secondary rounded-pill mb-1"><?= htmlspecialchars($story['year'] ?? $story['date'] ?? '') ?></span>
                        <?php endif; ?>
                        <h6 class="fw-bold text-dark m-0"><?= htmlspecialchars($story['title'] ?? '') ?></h6>
                        <p class="text-muted small m-0 mt-1"><?= nl2br(htmlspecialchars($story['desc'] ?? $story['story'] ?? '')) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 7. GALERI FOTO -->
    <?php if (!empty($galleries)): ?>
        <section class="section-box bg-white" id="section-gallery">
            <h3 class="heading-font display-5 mb-1" style="color: var(--theme-primary);">Galeri Bahagia</h3>
            <div class="theme-divider"></div>
            <div class="row g-2">
                <?php foreach ($galleries as $gImg): 
                    $gImgUrl = media_url($gImg);
                ?>
                    <div class="col-6">
                        <div class="rounded-3 overflow-hidden shadow-sm position-relative" style="height: 170px; cursor: pointer;" onclick="openNatureGalleryModal('<?= htmlspecialchars($gImgUrl) ?>')">
                            <img src="<?= htmlspecialchars($gImgUrl) ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 8. AMPLOP DIGITAL / TITIP HADIAH -->
    <?php if (!empty($bankAccounts) || !empty($event['gift_address'])): ?>
        <section class="section-box" id="section-gift">
            <h3 class="heading-font display-5 mb-1" style="color: var(--theme-primary);">Tanda Kasih</h3>
            <div class="theme-divider"></div>
            <p class="text-muted small mb-4">Doa restu Anda adalah karunia terindah. Namun jika ingin memberikan tanda kasih secara digital, Anda dapat melalui:</p>

            <?php foreach ($bankAccounts as $acc): ?>
                <div class="card p-3 rounded-4 border-0 shadow-sm bg-white mb-3 text-start">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold text-dark"><i class="bi bi-bank me-2 text-primary"></i> <?= htmlspecialchars($acc['bank']) ?></span>
                        <span class="badge bg-light text-muted border small">Transfer</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div>
                            <span class="fs-5 fw-bold text-dark d-block" id="rekening-<?= md5($acc['number']) ?>"><?= htmlspecialchars($acc['number']) ?></span>
                            <span class="text-muted small">a.n <?= htmlspecialchars($acc['owner'] ?? $acc['holder'] ?? '') ?></span>
                        </div>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="copyRekening('rekening-<?= md5($acc['number']) ?>')">
                            <i class="bi bi-clipboard me-1"></i> Salin
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (!empty($event['gift_address'])): ?>
                <div class="card p-3 rounded-4 border-0 shadow-sm bg-white text-start mt-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-gift-fill text-danger me-2 fs-5"></i>
                        <h6 class="fw-bold text-dark m-0">Kirim Kado Fisik</h6>
                    </div>
                    <p class="text-muted small m-0"><?= nl2br(htmlspecialchars($event['gift_address'])) ?></p>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <!-- 9. BUKU TAMU & RSVP REALTIME -->
    <section class="section-box bg-white" id="section-rsvp">
        <h3 class="heading-font display-5 mb-1" style="color: var(--theme-primary);">Buku Tamu & RSVP</h3>
        <div class="theme-divider"></div>

        <!-- Form RSVP -->
        <div class="card p-4 rounded-4 border shadow-sm text-start mb-4">
            <form id="rsvpForm" onsubmit="handleRsvp(event)">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nama Lengkap</label>
                    <input type="text" id="guestNameInput" name="guest_name" class="form-control rounded-3" value="<?= htmlspecialchars($guestName !== 'Tamu Undangan' ? $guestName : '') ?>" placeholder="Nama Anda" required>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <label class="form-label small fw-bold">Kehadiran</label>
                        <select name="attendance" id="attendanceSelect" class="form-select rounded-3" onchange="handleAttendanceChange(this.value)" required>
                            <option value="" selected disabled>Status</option>
                            <option value="attending">Hadir</option>
                            <option value="not_attending">Berhalangan Hadir / Tidak Hadir</option>
                            <option value="uncertain">Ragu-ragu (Optional)</option>
                        </select>
                    </div>
                    <div class="col-12 mt-2" id="paxContainer" style="display: none;">
                        <label class="form-label small fw-bold">Jumlah Tamu (Pax)</label>
                        <select name="pax" id="paxSelect" class="form-select rounded-3">
                            <option value="1">1 Orang</option>
                            <option value="2">2 Orang</option>
                            <option value="3">3 Orang</option>
                            <option value="4">4 Orang+</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Pesan / Doa Restu</label>
                    <textarea name="message" id="messageInput" class="form-control rounded-3" rows="3" placeholder="Tuliskan ucapan selamat dan doa untuk mempelai..."></textarea>
                </div>
                <button type="submit" id="btnRsvp" class="btn btn-theme w-100 rounded-pill py-2">
                    <i class="bi bi-send-fill me-1"></i> Kirim Ucapan
                </button>
                <!-- Tombol Hadir muncul HANYA jika opsi Hadir dipilih -->
                <button type="button" id="btnConfirmHadir" onclick="confirmHadirNow()" class="btn btn-success w-100 rounded-pill py-2 mt-2 shadow-sm" style="display: none; background-color: #198754; border-color: #198754; font-weight: 600;">
                    <i class="bi bi-check-circle-fill me-1"></i> Hadir
                </button>
            </form>
        </div>

        <!-- List Wishes -->
        <div class="text-start" id="wishesContainer">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-chat-dots-fill text-primary me-2"></i> Doa Restu (<?= count($wishes) ?>)</h6>
            <div id="wishesList">
                <?php foreach ($wishes as $w): 
                    $wName = $w['guest_name'] ?? $w['name'] ?? 'Tamu Undangan';
                    $wAttendance = $w['attendance'] ?? 'attending';
                ?>
                    <div class="comment-card">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark small"><?= htmlspecialchars($wName) ?></span>
                            <?php if ($wAttendance === 'attending'): ?>
                                <span class="badge bg-success-subtle text-success small" style="font-size: 10px;">Hadir</span>
                            <?php else: ?>
                                <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 10px;">Tidak Hadir</span>
                            <?php endif; ?>
                        </div>
                        <p class="text-muted small m-0"><?= nl2br(htmlspecialchars($w['message'])) ?></p>
                        <?php if (!empty($w['reply'])): ?>
                            <div class="p-2 bg-light rounded-3 mt-2 small text-muted border-start border-3" style="border-color: var(--theme-primary) !important;">
                                <b class="text-dark d-block" style="font-size: 11px;">Mempelai:</b>
                                <?= htmlspecialchars($w['reply']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 10. PENUTUP & QR CODE DINAMIS -->
    <section class="section-box pb-5" id="section-qrcode">
        <h3 class="heading-font display-4" style="color: var(--theme-primary);">Terima Kasih</h3>
        <p class="text-muted small mt-2 mb-4">Atas doa dan kehadiran Anda, kami sekeluarga mengucapkan banyak terima kasih.</p>
        
        <p class="fw-bold text-dark"><?= htmlspecialchars($event['groom_nickname'] ?: 'Justin') ?> & <?= htmlspecialchars($event['bride_nickname'] ?: 'Sisca') ?></p>

        <!-- CARD BARCODE DINAMIS -->
        <div id="bottomBarcodeCard" class="card p-4 rounded-4 border bg-white shadow-sm mt-3 text-center mx-auto" style="max-width: 360px; transition: all 0.3s ease;">
            <!-- STATE A: Barcode Unik Check-In Kehadiran (Default & saat Hadir) -->
            <div id="qrCheckinState">
                <div class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-success-subtle text-success mb-2" style="width: 44px; height: 44px;">
                    <i class="bi bi-qr-code-scan fs-4"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1" id="barcodeTitle">Barcode Check-In Kehadiran</h6>
                <div class="mb-2">
                    <span class="badge bg-success-subtle text-success small px-3 py-1 rounded-pill" id="barcodeBadgeStatus">Konfirmasi Kehadiran</span>
                </div>
                
                <div class="d-block text-center my-2">
                    <div class="p-2 bg-light rounded-3 border d-inline-block shadow-sm">
                        <img id="checkinQrImg" src="<?= 'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=' . urlencode(base_url('u/' . $event['slug'] . '?checkin=' . urlencode(!empty($currentGuest['qr_code']) ? $currentGuest['qr_code'] : $guestName))) ?>" class="rounded-2" style="width: 135px; height: 135px;" alt="Barcode Check-in">
                    </div>
                </div>
                <div class="small fw-semibold text-muted mb-1 font-monospace" id="checkinCodeText"><?= htmlspecialchars(!empty($currentGuest['qr_code']) ? $currentGuest['qr_code'] : 'CHECKIN-' . strtoupper(substr(md5($guestName), 0, 8))) ?></div>
                <span class="small text-muted d-block" id="barcodeDesc" style="font-size: 11px;">
                    Scan / tunjukkan barcode unik ini saat tiba di acara sebagai konfirmasi kehadiran Anda.
                </span>
            </div>

            <!-- STATE B: Akses Halaman Transfer / Rekening Pemilik Acara (Saat Berhalangan Hadir) -->
            <div id="qrTransferState" style="display: none;">
                <div class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-primary-subtle text-primary mb-2" style="width: 44px; height: 44px;">
                    <i class="bi bi-credit-card-2-front fs-4"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Akses Rekening & Transfer</h6>
                <div class="mb-2">
                    <span class="badge bg-primary-subtle text-primary small px-3 py-1 rounded-pill">Titip Hadiah & Doa Digital</span>
                </div>
                
                <div class="d-block text-center my-2">
                    <div class="p-2 bg-light rounded-3 border d-inline-block shadow-sm" style="cursor: pointer;" onclick="openGiftModal()" title="Klik untuk membuka pop up rekening">
                        <img id="transferQrImg" src="<?= 'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=' . urlencode(base_url('u/' . $event['slug'] . '?show_gift=1')) ?>" class="rounded-2" style="width: 135px; height: 135px;" alt="Barcode Transfer Digital">
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1.5 mt-1 mb-2 fw-semibold" onclick="openGiftModal()">
                        <i class="bi bi-wallet2 me-1"></i> Buka Rekening &amp; Kado Digital
                    </button>
                </div>
                
                <span class="small text-muted d-block mb-3" style="font-size: 11px;">
                    Scan barcode di atas menggunakan kamera HP, atau klik barcode/tombol untuk membuka pop-up daftar rekening &amp; kado yang dapat disalin:
                </span>

                <div class="text-start">
                    <?php if (!empty($bankAccounts)): ?>
                        <?php foreach ($bankAccounts as $acc): ?>
                            <div class="p-2.5 rounded-3 bg-light border mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold text-dark small"><i class="bi bi-bank me-1 text-primary"></i> <?= htmlspecialchars($acc['bank']) ?></span>
                                    <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2 rounded-pill" style="font-size: 11px;" onclick="copyRekening('transfer-rekening-bottom-<?= md5($acc['number']) ?>')">
                                        <i class="bi bi-clipboard"></i> Salin
                                    </button>
                                </div>
                                <div class="fw-bold text-dark font-monospace" id="transfer-rekening-bottom-<?= md5($acc['number']) ?>"><?= htmlspecialchars($acc['number']) ?></div>
                                <div class="text-muted" style="font-size: 11px;">a.n <?= htmlspecialchars($acc['owner'] ?? $acc['holder'] ?? '') ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="p-2 bg-light rounded-3 text-muted small text-center">
                            Pemilik acara belum mencantumkan rekening bank.
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($event['gift_address'])): ?>
                        <div class="p-2 bg-light rounded-3 border mt-2">
                            <span class="d-block fw-bold text-dark small"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Alamat Pengiriman Kado:</span>
                            <span class="text-muted small" style="font-size: 11px;"><?= nl2br(htmlspecialchars($event['gift_address'])) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="mt-5 pt-3 border-top text-muted" style="font-size: 11px;">
            Powered by <b><?= APP_NAME ?></b>
        </div>
    </section>

    <!-- FLOATING BOTTOM DOCK STATIS (PERSIS SESUAI GAMBAR USER) -->
    <nav class="static-footer-dock" id="staticFooterDock">
        <a href="#section-home" class="static-dock-btn" title="Beranda">
            <i class="bi bi-house-door-fill"></i>
        </a>
        <a href="#section-couple" class="static-dock-btn" title="Mempelai">
            <i class="bi bi-people-fill"></i>
        </a>
        <a href="#section-gallery" class="static-dock-btn" title="Galeri Foto">
            <i class="bi bi-images"></i>
        </a>
        <a href="#section-event" class="static-dock-btn" title="Waktu & Lokasi Acara">
            <i class="bi bi-geo-alt-fill"></i>
        </a>
        <button type="button" class="static-dock-btn" onclick="openQrModal()" title="QR Code Check-in Tamu">
            <i class="bi bi-qr-code-scan"></i>
        </button>
        <button type="button" class="static-dock-btn static-dock-btn-blue" id="btnAutoScroll" onclick="toggleAutoScroll()" title="Auto Scroll (Gulir Otomatis)">
            <i class="bi bi-arrow-down-square-fill" id="iconAutoScroll"></i>
        </button>
        <button type="button" class="static-dock-btn static-dock-btn-blue" id="footerAudioBtn" onclick="toggleAudio()" title="Putar/Jeda Musik">
            <i class="bi bi-music-note-beamed" id="footerAudioIcon"></i>
        </button>
    </nav>

</div>

<!-- MODAL POPUP QR CODE TAMU -->
<div class="modal fade" id="modalQrTamu" tabindex="-1" aria-labelledby="modalQrTamuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered px-3" style="max-width: 380px; margin: 0 auto;">
        <div class="modal-content border-0 rounded-4 shadow-lg text-center p-3" style="background: #ffffff;">
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-warning-subtle text-warning mb-2" style="width: 50px; height: 50px;">
                    <i class="bi bi-qr-code-scan fs-3"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1">QR Code Tamu Undangan</h5>
                <p class="text-muted small mb-3">Tunjukkan QR code ini ke petugas resepsi saat tiba di lokasi acara.</p>
                
                <div class="p-3 bg-light rounded-4 border d-inline-block shadow-sm mb-3">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=<?= urlencode(base_url('u/' . $event['slug'] . '?checkin=' . urlencode($guestName))) ?>" alt="QR Code Tamu" class="img-fluid rounded-3" style="width: 175px; height: 175px;">
                </div>
                
                <div class="p-2.5 rounded-3 bg-light border text-start mb-3" style="font-size: 12px;">
                    <div class="text-muted">Nama Tamu:</div>
                    <div class="fw-bold text-dark fs-6"><?= htmlspecialchars($guestName) ?></div>
                    <div class="text-muted mt-1">Acara:</div>
                    <div class="fw-semibold text-secondary"><?= htmlspecialchars($event['title']) ?></div>
                </div>

                <button type="button" class="btn btn-secondary w-100 rounded-pill py-2 small fw-semibold" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SIMPAN KE KALENDER -->
<div class="modal fade" id="modalCalendar" tabindex="-1" aria-labelledby="modalCalendarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered px-3" style="max-width: 380px; margin: 0 auto;">
        <div class="modal-content border-0 rounded-4 shadow-lg text-center p-3" style="background: #ffffff;">
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-primary-subtle text-primary mb-2" style="width: 50px; height: 50px;">
                    <i class="bi bi-calendar-event-fill fs-3"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1">Simpan Jadwal Acara</h5>
                <p class="text-muted small mb-3">Tambahkan jadwal pernikahan ini ke kalender agar Anda mendapat pengingat tepat waktu.</p>
                
                <div class="d-grid gap-2 mb-3">
                    <button type="button" class="btn btn-primary rounded-pill py-2.5 fw-semibold d-flex align-items-center justify-content-center shadow-sm" onclick="downloadIcsFile()">
                        <i class="bi bi-file-earmark-arrow-down-fill me-2 fs-5"></i> Unduh File Kalender (.ICS)
                    </button>
                    <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=<?= urlencode('The Wedding of ' . ($event['groom_nickname'] ?: 'Budi') . ' & ' . ($event['bride_nickname'] ?: 'Siti')) ?>&dates=<?= date('Ymd\THis', strtotime($event['event_date'] . ' 08:00:00')) ?>/<?= date('Ymd\THis', strtotime($event['event_date'] . ' 14:00:00')) ?>&details=<?= urlencode('Undangan Pernikahan ' . $event['title'] . ' | Info: ' . base_url('u/' . $event['slug'])) ?>&location=<?= urlencode($event['akad_location'] ?: 'Lokasi Acara') ?>" target="_blank" class="btn btn-outline-primary rounded-pill py-2.5 fw-semibold d-flex align-items-center justify-content-center">
                        <i class="bi bi-google me-2 fs-5"></i> Buka Google Calendar
                    </a>
                </div>
                <div class="text-muted small" style="font-size: 11px;">
                    <i class="bi bi-info-circle me-1"></i> File .ICS otomatis dapat dibuka di iPhone/Apple Calendar, Android, Google Calendar, dan Outlook.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL POPUP WEDDING GIFT TRANSFER & KADO DIGITAL -->
<div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="giftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered px-3" style="max-width: 420px; margin: 0 auto;">
        <div class="modal-content border-0 rounded-4 shadow-lg text-center p-3" style="background: #ffffff;">
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-primary-subtle text-primary mb-2" style="width: 50px; height: 50px;">
                    <i class="bi bi-gift-fill fs-3"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1" id="giftModalLabel">Kirim Hadiah &amp; Amplop Digital</h5>
                <p class="text-muted small mb-3">Doa restu Anda merupakan karunia terindah bagi kami. Namun jika Anda ingin mengirimkan tanda kasih secara digital, silakan gunakan rekening berikut:</p>
                
                <div class="text-start">
                    <?php if (!empty($bankAccounts)): ?>
                        <?php foreach ($bankAccounts as $idx => $acc): ?>
                            <div class="p-2.5 rounded-3 bg-light border mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold text-dark small"><i class="bi bi-bank me-1 text-primary"></i> <?= htmlspecialchars($acc['bank']) ?></span>
                                    <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2 rounded-pill" style="font-size: 11px;" onclick="copyRekening('modal-rek-<?= md5($acc['number'] . $idx) ?>')">
                                        <i class="bi bi-clipboard"></i> Salin
                                    </button>
                                </div>
                                <div class="fw-bold text-dark font-monospace" id="modal-rek-<?= md5($acc['number'] . $idx) ?>"><?= htmlspecialchars($acc['number']) ?></div>
                                <div class="text-muted" style="font-size: 11px;">a.n <?= htmlspecialchars($acc['owner'] ?? $acc['holder'] ?? '') ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="p-2 bg-light rounded-3 text-muted small text-center">
                            Pemilik acara belum mencantumkan rekening bank.
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($event['gift_address'])): ?>
                        <div class="p-2 bg-light rounded-3 border mt-2">
                            <span class="d-block fw-bold text-dark small"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Alamat Pengiriman Kado:</span>
                            <span class="text-muted small" style="font-size: 11px;" id="modal-gift-addr"><?= nl2br(htmlspecialchars($event['gift_address'])) ?></span>
                            <button type="button" class="btn btn-sm btn-outline-secondary w-100 mt-2 py-1 rounded-pill" style="font-size: 11px;" onclick="copyRekening('modal-gift-addr')">
                                <i class="bi bi-clipboard me-1"></i> Salin Alamat Kado
                            </button>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="button" class="btn btn-secondary w-100 rounded-pill py-2 mt-3 small fw-semibold" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Interactive Particle, Calendar, Modal & Audio Scripts -->
<script>
// 1. Particle Canvas Engine (Falling Petals / Sakura / Leaves / Sparkles)
const particleType = '<?= $particleEffect ?>';
if (particleType !== 'none') {
    const canvas = document.getElementById('particleCanvas');
    const ctx = canvas.getContext('2d');
    let width = canvas.width = window.innerWidth > 480 ? 480 : window.innerWidth;
    let height = canvas.height = window.innerHeight;

    window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth > 480 ? 480 : window.innerWidth;
        height = canvas.height = window.innerHeight;
    });

    const particles = [];
    const count = particleType === 'sparkles' ? 45 : 25;

    for (let i = 0; i < count; i++) {
        particles.push({
            x: Math.random() * width,
            y: Math.random() * height,
            size: Math.random() * 8 + 6,
            speedY: Math.random() * 1.5 + 0.8,
            speedX: Math.random() * 1 - 0.5,
            angle: Math.random() * 360,
            spin: Math.random() * 2 - 1,
            color: particleType === 'petals' ? 'rgba(235, 175, 185, 0.65)' : 
                   particleType === 'leaves' ? 'rgba(146, 175, 140, 0.65)' : 
                   particleType === 'sparkles' ? 'rgba(212, 175, 55, 0.75)' : 'rgba(255, 255, 255, 0.8)'
        });
    }

    function drawParticle(p) {
        ctx.save();
        ctx.translate(p.x, p.y);
        ctx.rotate((p.angle * Math.PI) / 180);
        ctx.fillStyle = p.color;

        if (particleType === 'petals' || particleType === 'leaves') {
            ctx.beginPath();
            ctx.ellipse(0, 0, p.size, p.size / 2, 0, 0, 2 * Math.PI);
            ctx.fill();
        } else if (particleType === 'sparkles') {
            ctx.beginPath();
            ctx.arc(0, 0, p.size / 3, 0, 2 * Math.PI);
            ctx.fill();
        } else { // snow
            ctx.beginPath();
            ctx.arc(0, 0, p.size / 2.5, 0, 2 * Math.PI);
            ctx.fill();
        }
        ctx.restore();
    }

    function animateParticles() {
        ctx.clearRect(0, 0, width, height);
        particles.forEach(p => {
            p.y += p.speedY;
            p.x += p.speedX;
            p.angle += p.spin;

            if (p.y > height) {
                p.y = -10;
                p.x = Math.random() * width;
            }
            if (p.x > width) p.x = 0;
            if (p.x < 0) p.x = width;

            drawParticle(p);
        });
        requestAnimationFrame(animateParticles);
    }
    animateParticles();
}

// 2. Audio State Management & Controller
function updateAudioButtonState(isPlaying) {
    const footerBtn = document.getElementById('footerAudioBtn');
    const footerIcon = document.getElementById('footerAudioIcon');
    const floatingBtn = document.getElementById('audioToggle');
    const floatingIcon = document.getElementById('audioIcon');

    if (isPlaying) {
        if (footerBtn) footerBtn.classList.add('playing');
        if (footerIcon) footerIcon.className = 'bi bi-music-note-beamed';
        if (floatingBtn) {
            floatingBtn.style.display = 'flex';
            floatingBtn.classList.add('spinning');
        }
        if (floatingIcon) floatingIcon.className = 'bi bi-disc-fill fs-5';
    } else {
        if (footerBtn) footerBtn.classList.remove('playing');
        if (footerIcon) footerIcon.className = 'bi bi-volume-mute-fill';
        if (floatingBtn) {
            floatingBtn.style.display = 'flex';
            floatingBtn.classList.remove('spinning');
        }
        if (floatingIcon) floatingIcon.className = 'bi bi-pause-circle-fill fs-5';
    }
}

function unlockInvitation() {
    const cover = document.getElementById('coverScreen');
    if (cover) {
        cover.classList.add('opened');
        setTimeout(() => {
            cover.style.display = 'none';
        }, 1100);
    }

    const audio = document.getElementById('invitationAudio');
    if (audio) {
        audio.play().then(() => {
            updateAudioButtonState(true);
        }).catch(err => {
            console.warn("Autoplay was blocked by browser:", err);
            updateAudioButtonState(false);
        });
    }
}

function toggleAudio() {
    const audio = document.getElementById('invitationAudio');
    if (!audio) return;

    if (audio.paused) {
        audio.play().then(() => {
            updateAudioButtonState(true);
        }).catch(err => {
            console.warn("Audio play prevented:", err);
        });
    } else {
        audio.pause();
        updateAudioButtonState(false);
    }
}

// 3. Modal Controllers
function openQrModal() {
    const modalEl = document.getElementById('modalQrTamu');
    if (modalEl) {
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }
}

function openCalendarModal() {
    const modalEl = document.getElementById('modalCalendar');
    if (modalEl) {
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }
}

// 4. Auto Scroll Controller (Fungsi Tombol Panah Bawah di Footer Dock)
let isAutoScrolling = false;
let autoScrollRafId = null;
const autoScrollSpeed = 1.3; // Kecepatan scroll yang nyaman dan halus

function toggleAutoScroll() {
    if (isAutoScrolling) {
        stopAutoScroll();
    } else {
        startAutoScroll();
    }
}

function startAutoScroll() {
    isAutoScrolling = true;
    const btn = document.getElementById('btnAutoScroll');
    const icon = document.getElementById('iconAutoScroll');
    if (btn) {
        btn.classList.add('scrolling-active');
        btn.title = 'Jeda Auto Scroll (Sedang Berjalan)';
    }
    if (icon) {
        icon.className = 'bi bi-pause-fill';
    }

    function autoScrollStep() {
        if (!isAutoScrolling) return;

        const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
        if (window.scrollY >= maxScroll - 3) {
            stopAutoScroll();
            return;
        }

        window.scrollBy(0, autoScrollSpeed);
        autoScrollRafId = requestAnimationFrame(autoScrollStep);
    }

    autoScrollRafId = requestAnimationFrame(autoScrollStep);
}

function stopAutoScroll() {
    isAutoScrolling = false;
    if (autoScrollRafId) {
        cancelAnimationFrame(autoScrollRafId);
        autoScrollRafId = null;
    }
    const btn = document.getElementById('btnAutoScroll');
    const icon = document.getElementById('iconAutoScroll');
    if (btn) {
        btn.classList.remove('scrolling-active');
        btn.title = 'Auto Scroll (Gulir Otomatis)';
    }
    if (icon) {
        icon.className = 'bi bi-arrow-down-square-fill';
    }
}

// Hentikan auto scroll jika user melakukan scroll manual (mouse wheel atau touch)
window.addEventListener('wheel', () => { if (isAutoScrolling) stopAutoScroll(); }, { passive: true });
window.addEventListener('touchmove', () => { if (isAutoScrolling) stopAutoScroll(); }, { passive: true });

// 5. Calendar .ICS File Generator
function downloadIcsFile() {
    const title = "<?= addslashes('The Wedding of ' . ($event['groom_nickname'] ?: 'Budi') . ' & ' . ($event['bride_nickname'] ?: 'Siti')) ?>";
    const location = "<?= addslashes($event['akad_location'] ?: 'Lokasi Acara') ?>";
    const description = "<?= addslashes('Undangan Pernikahan ' . $event['title'] . ' | Info selengkapnya: ' . base_url('u/' . $event['slug'])) ?>";
    const dateStr = "<?= date('Ymd', strtotime($event['event_date'])) ?>";
    const startIso = dateStr + "T080000";
    const endIso = dateStr + "T140000";

    const icsContent = [
        "BEGIN:VCALENDAR",
        "VERSION:2.0",
        "PRODID:-//Pendar Loka//Wedding Invitation//ID",
        "CALSCALE:GREGORIAN",
        "METHOD:PUBLISH",
        "BEGIN:VEVENT",
        "UID:pendarloka-" + Date.now() + "@pendarloka.com",
        "DTSTAMP:" + new Date().toISOString().replace(/[-:]/g, "").split(".")[0] + "Z",
        "DTSTART:" + startIso,
        "DTEND:" + endIso,
        "SUMMARY:" + title,
        "DESCRIPTION:" + description,
        "LOCATION:" + location,
        "STATUS:CONFIRMED",
        "END:VEVENT",
        "END:VCALENDAR"
    ].join("\r\n");

    const blob = new Blob([icsContent], { type: "text/calendar;charset=utf-8" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "jadwal-pernikahan-<?= $event['slug'] ?>.ics";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

// 5. Countdown Timer
const targetDate = new Date("<?= date('Y-m-d H:i:s', strtotime($event['event_date'] . ' 08:00:00')) ?>").getTime();
setInterval(() => {
    const now = new Date().getTime();
    const distance = targetDate - now;

    if (distance > 0) {
        const dEl = document.getElementById('cdDays');
        const hEl = document.getElementById('cdHours');
        const mEl = document.getElementById('cdMinutes');
        const sEl = document.getElementById('cdSeconds');
        if (dEl) dEl.innerText = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
        if (hEl) hEl.innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
        if (mEl) mEl.innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
        if (sEl) sEl.innerText = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
    }
}, 1000);

// 6. Salin Nomor Rekening dengan Fallback
function copyRekening(elId) {
    const el = document.getElementById(elId);
    if (!el) return;
    const num = el.innerText.trim();
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(num).then(() => {
            alert("Nomor rekening berhasil disalin: " + num);
        }).catch(() => fallbackCopy(num));
    } else {
        fallbackCopy(num);
    }
}
function fallbackCopy(text) {
    const temp = document.createElement('input');
    temp.value = text;
    document.body.appendChild(temp);
    temp.select();
    try {
        document.execCommand('copy');
        alert("Nomor rekening berhasil disalin: " + text);
    } catch(e) {
        prompt("Salin nomor rekening manual:", text);
    }
    document.body.removeChild(temp);
}

// 7. Handler Dinamis Pilihan Opsi Kehadiran
function handleAttendanceChange(status) {
    const btnHadir = document.getElementById('btnConfirmHadir');
    const paxContainer = document.getElementById('paxContainer');
    const qrCheckinState = document.getElementById('qrCheckinState');
    const qrTransferState = document.getElementById('qrTransferState');

    if (status === 'attending') {
        if (btnHadir) btnHadir.style.display = 'block';
        if (paxContainer) paxContainer.style.display = 'block';
        if (qrCheckinState) qrCheckinState.style.display = 'block';
        if (qrTransferState) qrTransferState.style.display = 'none';
    } else if (status === 'not_attending') {
        if (btnHadir) btnHadir.style.display = 'none';
        if (paxContainer) paxContainer.style.display = 'none';
        if (qrCheckinState) qrCheckinState.style.display = 'none';
        if (qrTransferState) qrTransferState.style.display = 'block';
    } else {
        // uncertain or placeholder
        if (btnHadir) btnHadir.style.display = 'none';
        if (paxContainer) paxContainer.style.display = 'none';
        if (qrCheckinState) qrCheckinState.style.display = 'block';
        if (qrTransferState) qrTransferState.style.display = 'none';
    }
}

// 8. Konfirmasi Kehadiran Instan (Tombol Hadir)
function confirmHadirNow() {
    const form = document.getElementById('rsvpForm');
    const nameInput = document.getElementById('guestNameInput');
    const guestName = nameInput ? nameInput.value.trim() : '';

    if (!guestName) {
        alert('Silakan masukkan Nama Lengkap Anda terlebih dahulu!');
        if (nameInput) nameInput.focus();
        return;
    }

    const paxSelect = document.getElementById('paxSelect');
    const pax = paxSelect ? paxSelect.value : 1;
    const msgInput = document.getElementById('messageInput');
    const message = msgInput ? msgInput.value.trim() : '';

    const btnHadir = document.getElementById('btnConfirmHadir');
    const originalHtml = btnHadir.innerHTML;
    btnHadir.disabled = true;
    btnHadir.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Mengonfirmasi...';

    const formData = new FormData();
    formData.append('guest_name', guestName);
    formData.append('attendance', 'attending');
    formData.append('pax', pax);
    formData.append('message', message);
    formData.append('is_direct_hadir', '1');

    fetch('<?= base_url('u/' . $event['slug'] . '/rsvp') ?>', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            btnHadir.disabled = true;
            btnHadir.className = 'btn btn-success w-100 rounded-pill py-2 mt-2 shadow-sm';
            btnHadir.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Terkonfirmasi Hadir (' + pax + ' Pax)';

            // Update gambar & kode barcode unik
            if (res.data && res.data.qr_url) {
                const qrImg = document.getElementById('checkinQrImg');
                if (qrImg) qrImg.src = res.data.qr_url;
                const codeText = document.getElementById('checkinCodeText');
                if (codeText && res.data.qr_code) codeText.innerText = res.data.qr_code;

                // Update juga modal dock QR jika ada
                const modalQrImg = document.querySelector('#modalQrTamu img');
                if (modalQrImg) modalQrImg.src = res.data.qr_url;
            }

            // Tambahkan ucapan ke list
            const list = document.getElementById('wishesList');
            if (list && res.data) {
                const div = document.createElement('div');
                div.className = 'comment-card animate__animated animate__fadeInUp';
                div.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold text-dark small">${res.data.guest_name}</span>
                        <span class="badge bg-success-subtle text-success small" style="font-size: 10px;">Hadir (${pax} Pax)</span>
                    </div>
                    <p class="text-muted small m-0">${res.data.message.replace(/\n/g, '<br>')}</p>
                `;
                list.prepend(div);
            }

            alert(res.message);

            // Scroll ke barcode unik check-in
            const qrCard = document.getElementById('bottomBarcodeCard');
            if (qrCard) {
                qrCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                qrCard.style.boxShadow = '0 0 0 3px rgba(25, 135, 84, 0.5)';
                setTimeout(() => qrCard.style.boxShadow = '', 3000);
            }
        } else {
            btnHadir.disabled = false;
            btnHadir.innerHTML = originalHtml;
            alert(res.message || 'Gagal mengonfirmasi kehadiran.');
        }
    })
    .catch(() => {
        btnHadir.disabled = false;
        btnHadir.innerHTML = originalHtml;
        alert('Terjadi kesalahan koneksi saat mengonfirmasi kehadiran.');
    });
}

// 9. AJAX Kirim Ucapan & RSVP
function handleRsvp(e) {
    e.preventDefault();
    const form = document.getElementById('rsvpForm');
    const select = document.getElementById('attendanceSelect');
    if (!select || !select.value) {
        alert('Silakan pilih status kehadiran (Hadir / Berhalangan Hadir / Ragu-ragu) terlebih dahulu!');
        if (select) select.focus();
        return;
    }

    const formData = new FormData(form);
    const btn = document.getElementById('btnRsvp');
    const originalHtml = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';

    fetch('<?= base_url('u/' . $event['slug'] . '/rsvp') ?>', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(res => {
        btn.disabled = false;
        btn.innerHTML = originalHtml;
        if (res.success) {
            alert(res.message);

            // Jika statusnya Hadir, update barcode unik dan status tombol Hadir
            if (res.data.attendance === 'attending' && res.data.qr_url) {
                const qrImg = document.getElementById('checkinQrImg');
                if (qrImg) qrImg.src = res.data.qr_url;
                const codeText = document.getElementById('checkinCodeText');
                if (codeText && res.data.qr_code) codeText.innerText = res.data.qr_code;

                const btnHadir = document.getElementById('btnConfirmHadir');
                if (btnHadir) {
                    btnHadir.disabled = true;
                    btnHadir.className = 'btn btn-success w-100 rounded-pill py-2 mt-2 shadow-sm';
                    btnHadir.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Terkonfirmasi Hadir (' + res.data.pax + ' Pax)';
                }
            }

            const list = document.getElementById('wishesList');
            if (list && res.data) {
                const div = document.createElement('div');
                div.className = 'comment-card animate__animated animate__fadeInUp';
                const badgeHtml = res.data.attendance === 'attending'
                    ? `<span class="badge bg-success-subtle text-success small" style="font-size: 10px;">Hadir (${res.data.pax} Pax)</span>`
                    : (res.data.attendance === 'not_attending'
                        ? '<span class="badge bg-danger-subtle text-danger small" style="font-size: 10px;">Tidak Hadir</span>'
                        : '<span class="badge bg-secondary-subtle text-secondary small" style="font-size: 10px;">Ragu-ragu</span>');
                div.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold text-dark small">${res.data.guest_name}</span>
                        ${badgeHtml}
                    </div>
                    <p class="text-muted small m-0">${res.data.message.replace(/\n/g, '<br>')}</p>
                `;
                list.prepend(div);
            }
            const msgEl = document.getElementById('messageInput');
            if (msgEl) msgEl.value = '';
        } else {
            alert(res.message);
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerHTML = originalHtml;
        alert("Terjadi kesalahan sistem saat mengirim ucapan.");
    });
}

// 8. Scroll Reveal & Typewriter Animation Engine
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($animRevealOnScroll): ?>
    // IntersectionObserver for Reveal on Scroll
    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const animClass = el.getAttribute('data-anim') || '<?= $textClass ?>';
                    el.classList.add(animClass);
                    el.style.opacity = '1';
                    revealObserver.unobserve(el);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal-element').forEach(el => {
            revealObserver.observe(el);
        });
    } else {
        document.querySelectorAll('.reveal-element').forEach(el => {
            el.style.opacity = '1';
        });
    }
    <?php endif; ?>

    // Typewriter effect handler if enabled
    <?php if ($animEntranceText === 'typewriter'): ?>
    const typeEls = document.querySelectorAll('.typewriter-target');
    typeEls.forEach(el => {
        const text = el.innerText.trim();
        el.innerText = '';
        el.style.opacity = '1';
        let idx = 0;
        function typeChar() {
            if (idx < text.length) {
                el.innerText += text.charAt(idx);
                idx++;
                setTimeout(typeChar, 35);
            }
        }
        setTimeout(typeChar, 400);
    });
    <?php endif; ?>

    // Auto-open Gift Modal jika di-scan dari barcode transfer (?show_gift=1)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('show_gift') === '1' || window.location.hash === '#gift-modal' || window.location.hash === '#show_gift') {
        const coverEl = document.getElementById('coverScreen');
        if (coverEl) coverEl.classList.add('opened');
        setTimeout(() => {
            openGiftModal();
        }, 400);
    }
});

// Buka Pop-up Modal Hadiah & Rekening
function openGiftModal() {
    const modalEl = document.getElementById('giftModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }
}
</script>

<?php do_action('invitation_footer', $event); ?>
</body>
</html>
