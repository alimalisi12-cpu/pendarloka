<?php
// views/templates/luxury_07.php
// Tema: Luxury 07 - Noir & Gold Elegance (Diadaptasi dari wedding.templateku.id/wdk/luxury-07)

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$loveStories = json_decode($event['love_story_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];
$customSchedules = json_decode($event['events_schedule_json'] ?? '[]', true) ?: [];

// Konfigurasi Efek Animasi & Transisi dari Admin
$animConfig = $animConfig ?? (json_decode($event['animation_config_json'] ?? '[]', true) ?: []);
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

// Cover Image fallback (persis referensi wedding.templateku.id/wdk/luxury-07)
$defaultCover = 'https://wedding.templateku.id/wp-content/uploads/2025/01/pexels-ba-tik-3754224.webp';
$coverImage = !empty($event['cover_photo']) ? media_url($event['cover_photo']) : (!empty($event['cover_image']) ? media_url($event['cover_image']) : (!empty($galleries[0]) ? media_url($galleries[0]) : (!empty($event['groom_photo']) ? media_url($event['groom_photo']) : $defaultCover)));
$heroImage = !empty($event['hero_photo']) ? media_url($event['hero_photo']) : $coverImage;
$bgImage = !empty($event['bg_photo']) ? media_url($event['bg_photo']) : $coverImage;
$groomInit = strtoupper(substr($event['groom_nickname'] ?: ($event['groom_name'] ?? 'Ryan'), 0, 1));
$brideInit = strtoupper(substr($event['bride_nickname'] ?: ($event['bride_name'] ?? 'Rani'), 0, 1));

// Music URL fallback
$rawMusic = $event['music_url'] ?? '';
$resolvedMusicUrl = (!empty($rawMusic) && (str_starts_with($rawMusic, 'http://') || str_starts_with($rawMusic, 'https://'))) ? $rawMusic : base_url($rawMusic ?: 'assets/audio/wedding_music.mp3');

// Google Calendar URL Generator
$calTitle = urlencode("Pernikahan " . ($event['groom_nickname'] ?: 'Groom') . " & " . ($event['bride_nickname'] ?: 'Bride'));
$calDate = date('Ymd', strtotime($event['event_date'] ?? 'now'));
$firstLoc = !empty($customSchedules[0]['place']) ? $customSchedules[0]['place'] : (!empty($event['akad_location']) ? $event['akad_location'] : 'Lokasi Acara');
$firstAddr = !empty($customSchedules[0]['address']) ? $customSchedules[0]['address'] : '';
$calDetails = urlencode("Pernikahan " . ($event['title'] ?? 'The Wedding') . "\nLokasi: " . $firstLoc . ($firstAddr ? " - " . $firstAddr : ""));
$calLocation = urlencode($firstLoc . ($firstAddr ? ", " . $firstAddr : ""));
$gcalUrl = "https://www.google.com/calendar/render?action=TEMPLATE&text={$calTitle}&dates={$calDate}T010000Z/{$calDate}T120000Z&details={$calDetails}&location={$calLocation}";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?= htmlspecialchars($event['title']) ?> | The Wedding</title>

    <!-- OpenGraph & Meta Preview -->
    <meta property="og:title" content="<?= htmlspecialchars($event['title']) ?>">
    <meta property="og:description" content="Undangan digital pernikahan untuk <?= htmlspecialchars($guestName) ?>.">
    <meta property="og:image" content="<?= htmlspecialchars($coverImage) ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800&family=Montserrat:wght@300;400;500;600;700&family=Pinyon+Script&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons & Animate.css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --luxury-bg: #0c0d0f;
            --luxury-surface: #14161a;
            --luxury-card-bg: rgba(22, 24, 29, 0.88);
            --luxury-card-border: rgba(212, 175, 55, 0.24);
            --luxury-gold: #D4AF37;
            --luxury-gold-light: #F4E8C1;
            --luxury-gold-dark: #AA8222;
            --luxury-gold-grad: linear-gradient(135deg, #F4E8C1 0%, #D4AF37 50%, #9B7825 100%);
            --luxury-text: #F7F5F0;
            --luxury-muted: #d1cdc7;
            --luxury-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--luxury-bg);
            color: var(--luxury-text);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* High-Contrast Readable Text for Dark Theme */
        .text-muted, .small.text-muted, small.text-muted, p.text-muted, span.text-muted, div.text-muted {
            color: #d1cdc7 !important;
        }
        .text-white-muted {
            color: #e5e2da !important;
        }

        /* Typography */
        .font-pinyon { font-family: 'Pinyon Script', cursive; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-cinzel { font-family: 'Cinzel', serif; letter-spacing: 2px; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }

        .text-gold {
            color: var(--luxury-gold) !important;
        }
        .text-gold-light {
            color: var(--luxury-gold-light) !important;
        }
        .text-gold-gradient {
            background: var(--luxury-gold-grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Dividers & Ornaments */
        .luxury-divider {
            width: 70px;
            height: 2px;
            background: var(--luxury-gold-grad);
            margin: 18px auto;
            border-radius: 2px;
        }

        .luxury-divider-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 20px auto;
        }
        .luxury-divider-icon::before,
        .luxury-divider-icon::after {
            content: '';
            height: 1px;
            width: 50px;
            background: var(--luxury-gold-grad);
        }

        /* Luxury Cards & Frames */
        .luxury-card {
            background-color: var(--luxury-card-bg);
            border: 1px solid var(--luxury-card-border);
            border-radius: 18px;
            box-shadow: var(--luxury-shadow);
            backdrop-filter: blur(14px);
            padding: 24px;
            transition: transform 0.3s ease, border-color 0.3s ease;
            color: #edeae3;
        }
        .luxury-card:hover {
            border-color: rgba(212, 175, 55, 0.45);
        }
        .luxury-card p {
            color: #edeae3;
        }

        /* Luxury Quote Card */
        .luxury-quote-box {
            background-color: var(--luxury-card-bg);
            border: 1px solid var(--luxury-card-border);
            border-radius: 18px;
            box-shadow: var(--luxury-shadow);
            backdrop-filter: blur(14px);
            padding: 28px 24px;
        }
        .luxury-quote-text {
            color: #edeae3 !important;
            font-size: 15px;
            line-height: 1.85;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }

        /* Buttons */
        .btn-luxury-gold {
            background: var(--luxury-gold-grad);
            color: #0c0d0f !important;
            font-weight: 600;
            border: none;
            padding: 10px 24px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.35);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-luxury-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.55);
            color: #000 !important;
        }

        .btn-luxury-outline {
            background: transparent;
            color: var(--luxury-gold-light) !important;
            border: 1px solid var(--luxury-gold);
            font-weight: 500;
            padding: 9px 22px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-luxury-outline:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--luxury-gold-light);
            color: #ffffff !important;
        }

        /* -------------------------------------------------------------
           DESKTOP SPLIT SCREEN & MOBILE LAYOUT ARCHITECTURE
        ------------------------------------------------------------- */
        .luxury-split-wrapper {
            display: flex;
            width: 100vw;
            min-height: 100vh;
        }

        /* Sticky Left Column (Desktop) */
        .luxury-desktop-sidebar {
            width: 48%;
            height: 100vh;
            position: sticky;
            top: 0;
            left: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: #000;
        }

        .luxury-sidebar-bg {
            position: absolute;
            inset: 0;
            background-image: url('<?= htmlspecialchars($bgImage ?: $coverImage) ?>');
            background-size: cover;
            background-position: center;
            filter: brightness(0.62) contrast(1.05);
            transform: scale(1.03);
            transition: transform 10s ease;
        }

        .luxury-sidebar-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(12,13,15,0.45) 0%, rgba(12,13,15,0.85) 100%);
            backdrop-filter: blur(2px);
        }

        .luxury-sidebar-content {
            position: relative;
            z-index: 2;
            padding: 40px;
            max-width: 540px;
        }

        /* Right Column (Scrollable Invitation Stream) */
        .luxury-content-column {
            width: 52%;
            background-color: var(--luxury-bg);
            min-height: 100vh;
            position: relative;
            padding: 0;
        }

        .luxury-section {
            padding: 65px 30px;
            text-align: center;
            position: relative;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Responsive Mobile Behavior */
        @media (max-width: 991.98px) {
            .luxury-split-wrapper {
                display: block;
            }
            .luxury-desktop-sidebar {
                display: none; /* Disembunyikan di mobile agar menjadi single-column seperti templateku luxury-07 */
            }
            .luxury-content-column {
                width: 100%;
            }
            .luxury-section {
                padding: 50px 20px;
            }
        }

        /* -------------------------------------------------------------
           COVER MODAL (FULLSCREEN POPUP) - PERSIS GAMBAR 2 & GAMBAR 3
        ------------------------------------------------------------- */
        #luxuryCoverModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #000;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            transform-style: preserve-3d;
            transition: all 1s cubic-bezier(0.77, 0, 0.175, 1);
        }

        .cover-bg-image {
            position: absolute;
            inset: 0;
            background-image: url('<?= htmlspecialchars($coverImage) ?>');
            background-size: cover;
            background-position: center;
            filter: brightness(0.7) contrast(1.05);
        }

        .cover-dark-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
        }

        .cover-content-clean {
            position: relative;
            z-index: 5;
            width: 100%;
            max-width: 650px;
            padding: 30px 20px;
            margin: auto;
            text-align: center;
        }

        .cover-txt-the-wedding {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: #ffffff;
            letter-spacing: 1px;
            margin-bottom: 8px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
        }

        .cover-mempelai {
            font-family: 'Pinyon Script', cursive;
            font-size: 68px;
            font-weight: 400;
            font-style: italic;
            color: #ffffff;
            line-height: 1.25;
            margin-bottom: 14px;
            text-shadow: 0 3px 15px rgba(0, 0, 0, 0.7);
        }

        @media (max-width: 767.98px) {
            .cover-mempelai {
                font-size: 50px;
            }
            .cover-txt-the-wedding {
                font-size: 15px;
            }
        }

        .cover-tgl {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 24px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
        }

        .cover-dear {
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 6px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
        }

        .cover-guest-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 16px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
        }

        .cover-btn-buka {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(120, 120, 120, 0.55);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.85);
            border-radius: 8px;
            color: #ffffff !important;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 500;
            padding: 10px 22px;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.35);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .cover-btn-buka:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
            color: #ffffff !important;
        }

        /* Mempelai Monogram */
        .monogram-big {
            font-size: 72px;
            font-weight: 700;
            color: var(--luxury-gold);
            line-height: 1;
            text-shadow: 0 0 25px rgba(212, 175, 55, 0.4);
            margin-bottom: 8px;
        }

        /* Countdown Box */
        .cd-box {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--luxury-border);
            border-radius: 14px;
            padding: 12px 14px;
            min-width: 68px;
            text-align: center;
        }
        .cd-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--luxury-gold-light);
            display: block;
            line-height: 1.1;
        }
        .cd-label {
            font-size: 11px;
            color: var(--luxury-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Acara Badges */
        .event-badge-vertical {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transform: rotate(180deg);
            font-family: 'Cinzel', serif;
            letter-spacing: 4px;
            color: var(--luxury-gold);
            font-size: 18px;
            text-transform: uppercase;
            font-weight: 600;
            padding: 10px 0;
            border-left: 2px solid var(--luxury-gold);
            display: inline-block;
        }

        /* Form Inputs & Comments */
        .form-control, .form-select {
            background-color: #16181f !important;
            border: 1px solid rgba(212, 175, 55, 0.35) !important;
            color: #ffffff !important;
            border-radius: 12px;
            padding: 11px 16px;
        }
        .form-control:focus, .form-select:focus {
            background-color: #1d2028 !important;
            border-color: var(--luxury-gold) !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25) !important;
        }
        .form-control::placeholder, textarea.form-control::placeholder {
            color: #b0ada6 !important;
        }
        .form-select option {
            background-color: #16181f;
            color: #f7f5f0;
            padding: 10px;
        }
        .form-select option:disabled {
            color: #8c8983;
        }

        .comment-card {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 12px;
            text-align: left;
            color: #edeae3;
        }
        .comment-card p {
            color: #edeae3 !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 7px;
        }
        ::-webkit-scrollbar-track {
            background: #0c0d0f;
        }
        ::-webkit-scrollbar-thumb {
            background: #2a2c33;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--luxury-gold);
        }
    </style>

    <?php do_action('invitation_head', $event); ?>
</head>
<body>

<!-- Audio Background -->
<audio id="bgSong" loop preload="auto">
    <source src="<?= htmlspecialchars($resolvedMusicUrl) ?>" type="audio/mpeg">
</audio>

<!-- ==============================================================
     1. COVER SCREEN MODAL FULLSCREEN (BUKA UNDANGAN)
============================================================== -->
<div id="luxuryCoverModal" class="trans-<?= $animPageTransition ?> cover-transition-screen">
    <div class="cover-bg-image"></div>
    <div class="cover-dark-overlay"></div>
    <div class="cover-content-clean animate__animated animate__fadeIn">
        <div class="cover-txt-the-wedding">The Wedding of</div>
        <div class="cover-mempelai"><?= htmlspecialchars($event['groom_nickname'] ?? 'Dilan') ?> &amp; <?= htmlspecialchars($event['bride_nickname'] ?? 'Milea') ?></div>
        <div class="cover-tgl"><?= date('l, j F Y', strtotime($event['event_date'] ?? 'now')) ?></div>

        <div class="cover-dear">Kpd Bpk/Ibu/Saudara/i</div>
        <?php if (!empty($guestName) && $guestName !== 'Tamu Undangan'): ?>
            <div class="cover-guest-name"><?= htmlspecialchars($guestName) ?></div>
        <?php endif; ?>

        <div>
            <button type="button" class="cover-btn-buka animate__animated animate__pulse animate__infinite" onclick="openLuxuryInvitation()">
                <i class="bi bi-envelope-open me-2"></i> Buka Undangan
            </button>
        </div>
    </div>
</div>


<!-- ==============================================================
     2. WRAPPER UTAMA: SPLIT SCREEN (DESKTOP) & STREAM (MOBILE)
============================================================== -->
<div class="luxury-split-wrapper">

    <!-- ==========================================================
         A. DESKTOP STICKY SIDEBAR (PANEL KIRI)
    ========================================================== -->
    <div class="luxury-desktop-sidebar">
        <div class="luxury-sidebar-bg"></div>
        <div class="luxury-sidebar-overlay"></div>
        <div class="luxury-sidebar-content">
            <div class="cover-monogram font-cinzel mb-3 <?= $loopDecorClass ?>">
                <?= $groomInit ?>&<?= $brideInit ?>
            </div>
            <p class="font-cinzel text-uppercase small text-gold tracking-widest mb-1">Our Wedding Invitation</p>
            <h1 class="font-playfair display-4 text-gold-light mb-2 reveal-element <?= $textClass ?>">
                <?= htmlspecialchars($event['groom_nickname'] ?? 'Dilan') ?> &amp; <?= htmlspecialchars($event['bride_nickname'] ?? 'Milea') ?>
            </h1>
            <p class="text-muted small mb-4 font-montserrat">
                <i class="bi bi-calendar3 me-1 text-gold"></i> <?= date('l, d F Y', strtotime($event['event_date'] ?? 'now')) ?>
            </p>

            <div class="luxury-divider"></div>

            <p class="small text-white-50 fst-italic lh-lg mb-4 typewriter-target" style="font-size: 13px;">
                <?= nl2br(htmlspecialchars($event['quote'] ?? '“A great marriage is not when the perfect couple comes together. It is when an imperfect couple learns to enjoy their differences.”')) ?>
            </p>

            <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.05); border: 1px solid var(--luxury-border);">
                <span class="small text-muted d-block mb-1" style="font-size: 11px;">Tamu Terhormat:</span>
                <h5 class="fw-bold text-white m-0 font-montserrat"><?= htmlspecialchars($guestName) ?></h5>
            </div>
        </div>
    </div>


    <!-- ==========================================================
         B. CONTENT COLUMN (PANEL KANAN / STREAM UTAMA)
    ========================================================== -->
    <div class="luxury-content-column" id="luxuryContentStream">

        <!-- 1. HERO SECTION -->
        <section class="luxury-section pt-5" id="sec-hero">
            <p class="font-cinzel text-uppercase small text-gold mb-1" style="letter-spacing: 3px;">The Wedding Of</p>
            <h1 class="font-playfair display-4 text-gold-light mb-2 reveal-element <?= $textClass ?>">
                <?= htmlspecialchars($event['groom_nickname'] ?? 'Dilan') ?> &amp; <?= htmlspecialchars($event['bride_nickname'] ?? 'Milea') ?>
            </h1>
            <p class="text-muted small font-montserrat">
                <?= date('l, d F Y', strtotime($event['event_date'] ?? 'now')) ?>
            </p>
            <div class="luxury-divider"></div>

            <?php if (!empty($heroImage)): ?>
                <div class="my-4 px-2">
                    <img src="<?= htmlspecialchars($heroImage) ?>" class="img-fluid rounded-4 shadow reveal-element <?= $photoClass ?>" style="max-height: 480px; width: 100%; object-fit: cover; border: 1px solid var(--luxury-border);" alt="Foto Utama Undangan">
                </div>
            <?php endif; ?>

            <p class="text-muted small mt-3 mx-auto px-2" style="max-width: 480px; font-size: 13px;">
                Tanpa mengurangi rasa hormat, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada hari bahagia pernikahan kami.
            </p>
        </section>


        <!-- 2. BRIDE & GROOM (PROFIL MEMPELAI) -->
        <section class="luxury-section" id="sec-couple">
            <span class="font-cinzel text-uppercase text-gold small tracking-wider d-block mb-1">Mempelai Bahagia</span>
            <h2 class="font-playfair display-5 text-gold-light mb-4 reveal-element <?= $textClass ?>">The Happy Couple</h2>

            <!-- Mempelai Pria -->
            <div class="luxury-card mb-4 text-center mx-auto" style="max-width: 480px;">
                <div class="monogram-big font-cinzel <?= $loopDecorClass ?>"><?= $groomInit ?></div>
                <?php if (!empty($event['groom_photo'])): ?>
                    <img src="<?= htmlspecialchars(media_url($event['groom_photo'])) ?>" class="rounded-circle mb-3 shadow reveal-element <?= $photoClass ?>" style="width: 140px; height: 140px; object-fit: cover; border: 2px solid var(--luxury-gold);" alt="<?= htmlspecialchars($event['groom_name'] ?? 'Mempelai Pria') ?>">
                <?php endif; ?>
                <h3 class="font-playfair text-gold-light fs-3 mb-1"><?= htmlspecialchars($event['groom_name'] ?: 'Mempelai Pria') ?></h3>
                
                <?php if (!empty($event['groom_parents'])): ?>
                    <p class="text-muted small mb-3">
                        <?= nl2br(htmlspecialchars($event['groom_parents'])) ?>
                    </p>
                <?php elseif (!empty($event['groom_father']) || !empty($event['groom_mother'])): ?>
                    <p class="text-muted small mb-3">
                        Putra tercinta dari:<br>
                        <b class="text-white"><?= htmlspecialchars($event['groom_father'] ?? '') ?></b> &amp; <b class="text-white"><?= htmlspecialchars($event['groom_mother'] ?? '') ?></b>
                    </p>
                <?php else: ?>
                    <p class="text-muted small mb-3">
                        Putra tercinta dari:<br>
                        <b class="text-white">Bpk. Bambang</b> &amp; <b class="text-white">Ibu Sri</b>
                    </p>
                <?php endif; ?>

                <?php if (!empty($event['groom_instagram'])): ?>
                    <a href="https://instagram.com/<?= ltrim($event['groom_instagram'], '@') ?>" target="_blank" class="btn-luxury-outline py-1 px-3 small" style="font-size: 12px;">
                        <i class="bi bi-instagram me-1"></i> @<?= htmlspecialchars(ltrim($event['groom_instagram'], '@')) ?>
                    </a>
                <?php endif; ?>
            </div>

            <div class="font-playfair fs-1 text-gold my-2">&amp;</div>

            <!-- Mempelai Wanita -->
            <div class="luxury-card mb-4 text-center mx-auto" style="max-width: 480px;">
                <div class="monogram-big font-cinzel <?= $loopDecorClass ?>"><?= $brideInit ?></div>
                <?php if (!empty($event['bride_photo'])): ?>
                    <img src="<?= htmlspecialchars(media_url($event['bride_photo'])) ?>" class="rounded-circle mb-3 shadow reveal-element <?= $photoClass ?>" style="width: 140px; height: 140px; object-fit: cover; border: 2px solid var(--luxury-gold);" alt="<?= htmlspecialchars($event['bride_name'] ?? 'Mempelai Wanita') ?>">
                <?php endif; ?>
                <h3 class="font-playfair text-gold-light fs-3 mb-1"><?= htmlspecialchars($event['bride_name'] ?: 'Mempelai Wanita') ?></h3>
                
                <?php if (!empty($event['bride_parents'])): ?>
                    <p class="text-muted small mb-3">
                        <?= nl2br(htmlspecialchars($event['bride_parents'])) ?>
                    </p>
                <?php elseif (!empty($event['bride_father']) || !empty($event['bride_mother'])): ?>
                    <p class="text-muted small mb-3">
                        Putri tercinta dari:<br>
                        <b class="text-white"><?= htmlspecialchars($event['bride_father'] ?? '') ?></b> &amp; <b class="text-white"><?= htmlspecialchars($event['bride_mother'] ?? '') ?></b>
                    </p>
                <?php else: ?>
                    <p class="text-muted small mb-3">
                        Putri tercinta dari:<br>
                        <b class="text-white">Bpk. H. Ahmad</b> &amp; <b class="text-white">Ibu Fatimah</b>
                    </p>
                <?php endif; ?>

                <?php if (!empty($event['bride_instagram'])): ?>
                    <a href="https://instagram.com/<?= ltrim($event['bride_instagram'], '@') ?>" target="_blank" class="btn-luxury-outline py-1 px-3 small" style="font-size: 12px;">
                        <i class="bi bi-instagram me-1"></i> @<?= htmlspecialchars(ltrim($event['bride_instagram'], '@')) ?>
                    </a>
                <?php endif; ?>
            </div>
        </section>


        <!-- 3. COUNT THE DATE (COUNTDOWN & AYAT) -->
        <section class="luxury-section" id="sec-countdown" style="background: radial-gradient(circle at center, rgba(20,22,27,0.7) 0%, rgba(12,13,15,1) 100%);">
            <span class="font-cinzel text-uppercase text-gold small tracking-widest d-block mb-1">Save The Date</span>
            <h2 class="font-playfair display-6 text-gold-light mb-4">Count The Date</h2>

            <!-- Countdown Timer -->
            <div class="d-flex justify-content-center gap-2 mb-4" id="countdownGrid">
                <div class="cd-box">
                    <span class="cd-number" id="cdDays">00</span>
                    <span class="cd-label">Hari</span>
                </div>
                <div class="cd-box">
                    <span class="cd-number" id="cdHours">00</span>
                    <span class="cd-label">Jam</span>
                </div>
                <div class="cd-box">
                    <span class="cd-number" id="cdMinutes">00</span>
                    <span class="cd-label">Menit</span>
                </div>
                <div class="cd-box">
                    <span class="cd-number" id="cdSeconds">00</span>
                    <span class="cd-label">Detik</span>
                </div>
            </div>

            <!-- Tombol Tambahkan ke Kalender Google -->
            <div class="mb-4">
                <a href="<?= $gcalUrl ?>" target="_blank" class="btn-luxury-outline">
                    <i class="bi bi-calendar-plus me-2 text-gold"></i> Simpan di Kalender Google
                </a>
            </div>

            <!-- Kutipan Ayat / Kata Mutiara -->
            <?php 
            $defaultQuote = 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.';
            $displayQuote = !empty($event['quote']) ? $event['quote'] : $defaultQuote;
            ?>
            <div class="luxury-quote-box mx-auto text-center" style="max-width: 500px;">
                <i class="bi bi-quote fs-1 text-gold d-block mb-2"></i>
                <p class="fst-italic lh-lg mb-2 luxury-quote-text typewriter-target">
                    "<?= nl2br(htmlspecialchars($displayQuote)) ?>"
                </p>
                <?php if (empty($event['quote']) || strpos($event['quote'], 'Ar-Rum') !== false): ?>
                    <span class="font-cinzel small text-gold fw-bold" style="font-size: 12px; letter-spacing: 1px;">(QS. AR-RUM: 21)</span>
                <?php endif; ?>
            </div>
        </section>


        <!-- 4. RANGKAIAN ACARA -->
        <section class="luxury-section" id="sec-events">
            <span class="font-cinzel text-uppercase text-gold small tracking-widest d-block mb-1">Wedding Schedule</span>
            <h2 class="font-playfair display-5 text-gold-light mb-4 reveal-element <?= $textClass ?>">Rangkaian Acara</h2>

            <?php if (!empty($customSchedules)): ?>
                <?php foreach ($customSchedules as $idx => $session): ?>
                    <div class="luxury-card mb-4 mx-auto text-start" style="max-width: 500px;">
                        <div class="d-flex align-items-center gap-3 mb-3 border-bottom pb-3" style="border-color: rgba(255,255,255,0.08) !important;">
                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 48px; height: 48px; background: rgba(212,175,55,0.12); border: 1px solid var(--luxury-gold);">
                                <i class="bi <?= $idx === 0 ? 'bi-heart-fill' : 'bi-stars' ?> text-gold fs-5"></i>
                            </div>
                            <div>
                                <span class="badge px-3 py-1 rounded-pill mb-1" style="background: rgba(212,175,55,0.2); color: var(--luxury-gold-light); font-size: 11px;"><?= htmlspecialchars($session['name'] ?? ('Sesi ' . ($idx + 1))) ?></span>
                                <h4 class="font-playfair text-gold-light m-0"><?= htmlspecialchars($session['name'] ?? 'Rangkaian Acara') ?></h4>
                            </div>
                        </div>

                        <div class="mb-3 small">
                            <?php if (!empty($session['date'])): ?>
                                <p class="mb-1 text-white"><i class="bi bi-calendar-event me-2 text-gold"></i> <?= date('l, d F Y', strtotime($session['date'])) ?></p>
                            <?php endif; ?>
                            <p class="mb-2 text-white"><i class="bi bi-clock me-2 text-gold"></i> <?= htmlspecialchars($session['time'] ?? '') ?></p>
                            <?php if (!empty($session['place'])): ?>
                                <p class="mb-1 text-gold-light fw-semibold"><i class="bi bi-geo-alt-fill me-2 text-gold"></i> <?= htmlspecialchars($session['place']) ?></p>
                            <?php endif; ?>
                            <p class="text-muted m-0 ps-4"><?= nl2br(htmlspecialchars($session['address'] ?? '')) ?></p>
                        </div>

                        <?php 
                        $sessMaps = !empty($session['maps_url']) ? $session['maps_url'] : ($event['maps_url'] ?? '');
                        if (!empty($sessMaps)): 
                        ?>
                            <a href="<?= htmlspecialchars($sessMaps) ?>" target="_blank" class="btn-luxury-gold w-100 py-2">
                                <i class="bi bi-map-fill me-2"></i> Lihat Peta Lokasi
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Card 1: Akad Nikah -->
                <div class="luxury-card mb-4 mx-auto text-start" style="max-width: 500px;">
                    <div class="d-flex align-items-center gap-3 mb-3 border-bottom pb-3" style="border-color: rgba(255,255,255,0.08) !important;">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 48px; height: 48px; background: rgba(212,175,55,0.12); border: 1px solid var(--luxury-gold);">
                            <i class="bi bi-heart-fill text-gold fs-5"></i>
                        </div>
                        <div>
                            <span class="badge px-3 py-1 rounded-pill mb-1" style="background: rgba(212,175,55,0.2); color: var(--luxury-gold-light); font-size: 11px;">Sacred Moment</span>
                            <h4 class="font-playfair text-gold-light m-0">Akad Nikah</h4>
                        </div>
                    </div>

                    <div class="mb-3 small">
                        <p class="mb-1 text-white"><i class="bi bi-calendar-event me-2 text-gold"></i> <?= date('l, d F Y', strtotime($event['akad_date'] ?? $event['event_date'] ?? 'now')) ?></p>
                        <p class="mb-2 text-white"><i class="bi bi-clock me-2 text-gold"></i> <?= htmlspecialchars($event['akad_time'] ?? '08:00 - 10:00 WIB') ?></p>
                        <p class="mb-1 text-gold-light fw-semibold"><i class="bi bi-geo-alt-fill me-2 text-gold"></i> <?= htmlspecialchars($event['location_name'] ?? 'Ballroom Utama') ?></p>
                        <p class="text-muted m-0 ps-4"><?= nl2br(htmlspecialchars($event['location_address'] ?? 'Jakarta')) ?></p>
                    </div>

                    <?php 
                    $mapsUrlAkad = !empty($event['maps_url']) ? $event['maps_url'] : ($event['gmaps_url'] ?? '');
                    if (!empty($mapsUrlAkad)): 
                    ?>
                        <a href="<?= htmlspecialchars($mapsUrlAkad) ?>" target="_blank" class="btn-luxury-gold w-100 py-2">
                            <i class="bi bi-map-fill me-2"></i> Lihat Peta Lokasi
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Card 2: Resepsi Pernikahan -->
                <div class="luxury-card mb-4 mx-auto text-start" style="max-width: 500px;">
                    <div class="d-flex align-items-center gap-3 mb-3 border-bottom pb-3" style="border-color: rgba(255,255,255,0.08) !important;">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 48px; height: 48px; background: rgba(212,175,55,0.12); border: 1px solid var(--luxury-gold);">
                            <i class="bi bi-stars text-gold fs-5"></i>
                        </div>
                        <div>
                            <span class="badge px-3 py-1 rounded-pill mb-1" style="background: rgba(212,175,55,0.2); color: var(--luxury-gold-light); font-size: 11px;">Celebration</span>
                            <h4 class="font-playfair text-gold-light m-0">Resepsi Pernikahan</h4>
                        </div>
                    </div>

                    <div class="mb-3 small">
                        <p class="mb-1 text-white"><i class="bi bi-calendar-event me-2 text-gold"></i> <?= date('l, d F Y', strtotime($event['resepsi_date'] ?? $event['event_date'] ?? 'now')) ?></p>
                        <p class="mb-2 text-white"><i class="bi bi-clock me-2 text-gold"></i> <?= htmlspecialchars($event['resepsi_time'] ?? '11:00 - Selesai') ?></p>
                        <p class="mb-1 text-gold-light fw-semibold"><i class="bi bi-geo-alt-fill me-2 text-gold"></i> <?= htmlspecialchars($event['location_name'] ?? 'Ballroom Utama') ?></p>
                        <p class="text-muted m-0 ps-4"><?= nl2br(htmlspecialchars($event['location_address'] ?? 'Jakarta')) ?></p>
                    </div>

                    <?php 
                    $mapsUrlResepsi = !empty($event['maps_url']) ? $event['maps_url'] : ($event['gmaps_url'] ?? '');
                    if (!empty($mapsUrlResepsi)): 
                    ?>
                        <a href="<?= htmlspecialchars($mapsUrlResepsi) ?>" target="_blank" class="btn-luxury-gold w-100 py-2">
                            <i class="bi bi-map-fill me-2"></i> Lihat Peta Lokasi
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($event['maps_embed'])): ?>
                <div class="luxury-card mb-4 mx-auto p-2" style="max-width: 500px; border-radius: 16px; overflow: hidden;">
                    <?= $event['maps_embed'] ?>
                </div>
            <?php endif; ?>
        </section>


        <!-- 5. LIVE STREAMING (JIKA ADA) -->
        <?php if (!empty($event['streaming_url']) || !empty($event['streaming_platform'])): ?>
            <section class="luxury-section" id="sec-streaming" style="background: rgba(255,255,255,0.015);">
                <div class="luxury-card mx-auto" style="max-width: 500px;">
                    <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle mb-3" style="background: rgba(212,175,55,0.1); border: 1px solid var(--luxury-gold);">
                        <i class="bi bi-broadcast fs-3 text-gold"></i>
                    </div>
                    <h3 class="font-playfair text-gold-light fs-4 mb-2">Live Streaming</h3>
                    <p class="text-muted small mb-3">
                        Kami mengajak Anda yang berhalangan hadir langsung untuk tetap dapat bergabung dan menyaksikan momen bahagia kami secara virtual.
                    </p>
                    <a href="<?= htmlspecialchars($event['streaming_url'] ?? '#') ?>" target="_blank" class="btn-luxury-gold">
                        <i class="bi bi-camera-video-fill me-2"></i> Saksikan Siaran Langsung
                    </a>
                </div>
            </section>
        <?php endif; ?>


        <!-- 6. LOVE STORY TIMELINE -->
        <?php if (!empty($loveStories)): ?>
            <section class="luxury-section" id="sec-story">
                <span class="font-cinzel text-uppercase text-gold small tracking-widest d-block mb-1">Our Journey</span>
                <h2 class="font-playfair display-5 text-gold-light mb-4 reveal-element <?= $textClass ?>">Love Story</h2>

                <div class="mx-auto" style="max-width: 500px;">
                    <?php foreach ($loveStories as $story): ?>
                        <div class="luxury-card mb-4 text-start">
                            <?php if (!empty($story['image'])): ?>
                                <img src="<?= htmlspecialchars(media_url($story['image'])) ?>" class="img-fluid rounded-3 mb-3 w-100 reveal-element <?= $photoClass ?>" style="max-height: 240px; object-fit: cover;" alt="<?= htmlspecialchars($story['title'] ?? 'Story') ?>">
                            <?php endif; ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="font-playfair text-gold-light m-0"><?= htmlspecialchars($story['title'] ?? 'Babak Kisah') ?></h5>
                                <?php if (!empty($story['date']) || !empty($story['year'])): ?>
                                    <span class="badge bg-dark border border-secondary text-gold small" style="font-size: 11px;"><?= htmlspecialchars($story['date'] ?? $story['year'] ?? '') ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="text-muted small m-0 lh-lg"><?= nl2br(htmlspecialchars($story['story'] ?? $story['desc'] ?? '')) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>


        <!-- 7. WEDDING GALLERY -->
        <?php if (!empty($galleries)): ?>
            <section class="luxury-section" id="sec-gallery">
                <span class="font-cinzel text-uppercase text-gold small tracking-widest d-block mb-1">Moments Captured</span>
                <h2 class="font-playfair display-5 text-gold-light mb-4 reveal-element <?= $textClass ?>">Wedding Gallery</h2>

                <div class="row g-3 mx-auto px-2" style="max-width: 520px;">
                    <?php foreach ($galleries as $idx => $img): 
                        $imgUrl = media_url($img);
                    ?>
                        <div class="col-6">
                            <div class="rounded-3 overflow-hidden shadow-sm position-relative" style="height: 180px; border: 1px solid var(--luxury-border); cursor: pointer;" onclick="viewGalleryModal('<?= htmlspecialchars($imgUrl) ?>')">
                                <img src="<?= htmlspecialchars($imgUrl) ?>" class="w-100 h-100 reveal-element <?= $photoClass ?>" style="object-fit: cover; transition: transform 0.4s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'" alt="Galeri <?= $idx + 1 ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>


        <!-- 8. WEDDING GIFT / AMPLOP DIGITAL -->
        <section class="luxury-section" id="section-gift">
            <span class="font-cinzel text-uppercase text-gold small tracking-widest d-block mb-1">Share Love</span>
            <h2 class="font-playfair display-5 text-gold-light mb-2 reveal-element <?= $textClass ?>">Wedding Gift</h2>
            <p class="text-muted small mx-auto mb-4" style="max-width: 460px; font-size: 13px;">
                Doa restu Anda merupakan karunia terindah bagi kami. Namun jika memberi adalah ungkapan tanda kasih Anda, Anda dapat mengirimkan hadiah secara digital di bawah ini:
            </p>

            <!-- Button Toggle Gift -->
            <button type="button" class="btn-luxury-gold px-4 py-2.5 mb-4" onclick="toggleGiftBox()">
                <i class="bi bi-gift-fill me-2"></i> <span id="giftToggleText">Kirim Gift &amp; Amplop Digital</span>
            </button>

            <!-- Box Daftar Rekening (Accordion Toggle) -->
            <div id="luxuryGiftBox" style="display: none;" class="animate__animated animate__fadeIn">
                <div class="mx-auto" style="max-width: 480px;">
                    <?php if (!empty($bankAccounts)): ?>
                        <?php foreach ($bankAccounts as $b): ?>
                            <div class="luxury-card mb-3 text-start">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="font-cinzel text-gold fw-bold"><i class="bi bi-credit-card-2-front-fill me-2"></i> <?= htmlspecialchars($b['bank']) ?></span>
                                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill py-0 px-2" style="font-size: 11px;" onclick="copyRekeningText('rek-num-<?= md5($b['number']) ?>')">
                                        <i class="bi bi-clipboard"></i> Salin
                                    </button>
                                </div>
                                <div class="font-monospace fs-5 fw-bold text-white mb-1" id="rek-num-<?= md5($b['number']) ?>"><?= htmlspecialchars($b['number'] ?? '') ?></div>
                                <div class="small text-muted">a.n <span class="text-white"><?= htmlspecialchars($b['owner'] ?? $b['holder'] ?? '') ?></span></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($event['gift_address'])): ?>
                        <div class="luxury-card mb-3 text-start">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-box2-heart-fill text-gold me-2 fs-5"></i>
                                <h6 class="fw-bold text-gold-light m-0 font-playfair">Kirim Kado Fisik</h6>
                            </div>
                            <p class="text-muted small m-0"><?= nl2br(htmlspecialchars($event['gift_address'])) ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Tombol Konfirmasi WA -->
                    <div class="mt-3">
                        <a href="https://api.whatsapp.com/send?phone=<?= preg_replace('/[^0-9]/', '', $event['user_phone'] ?? $event['groom_phone'] ?? '6281234567890') ?>&text=Halo%2C%20saya%20mau%20konfirmasi%20pengiriman%20tanda%20kasih%20undangan%20pernikahan..." target="_blank" class="btn-luxury-outline w-100 py-2" style="font-size: 13px;">
                            <i class="bi bi-whatsapp me-2 text-success"></i> Konfirmasi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <!-- 9. BUKU TAMU & RSVP REALTIME -->
        <section class="luxury-section" id="section-rsvp">
            <span class="font-cinzel text-uppercase text-gold small tracking-widest d-block mb-1">Guestbook</span>
            <h2 class="font-playfair display-5 text-gold-light mb-4">Doa &amp; Ucapan</h2>

            <!-- Form RSVP -->
            <div class="luxury-card mb-4 mx-auto text-start" style="max-width: 500px;">
                <form id="rsvpForm" onsubmit="handleLuxuryRsvp(event)">
                    <div class="mb-3">
                        <label class="form-label small text-gold fw-semibold">Nama Lengkap</label>
                        <input type="text" id="guestNameInput" name="guest_name" class="form-control" value="<?= htmlspecialchars($guestName !== 'Tamu Undangan' ? $guestName : '') ?>" placeholder="Nama Lengkap Anda" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-gold fw-semibold">Konfirmasi Kehadiran</label>
                        <select name="attendance" id="attendanceSelect" class="form-select" onchange="handleAttendanceChange(this.value)" required>
                            <option value="" selected disabled>Pilih Status Kehadiran...</option>
                            <option value="attending">Hadir</option>
                            <option value="not_attending">Berhalangan Hadir / Tidak Hadir</option>
                            <option value="uncertain">Ragu-ragu (Optional)</option>
                        </select>
                    </div>

                    <div class="mb-3" id="paxContainer" style="display: none;">
                        <label class="form-label small text-gold fw-semibold">Jumlah Tamu (Pax)</label>
                        <select name="pax" id="paxSelect" class="form-select">
                            <option value="1">1 Orang</option>
                            <option value="2">2 Orang</option>
                            <option value="3">3 Orang</option>
                            <option value="4">4 Orang+</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-gold fw-semibold">Pesan &amp; Doa Restu</label>
                        <textarea name="message" id="messageInput" class="form-control" rows="3" placeholder="Tuliskan ucapan selamat dan doa terbaik untuk kedua mempelai..."></textarea>
                    </div>

                    <button type="submit" id="btnRsvp" class="btn-luxury-gold w-100 py-2.5">
                        <i class="bi bi-send-fill me-2"></i> Kirim Ucapan
                    </button>

                    <!-- Tombol Hadir muncul HANYA jika opsi Hadir dipilih -->
                    <button type="button" id="btnConfirmHadir" onclick="confirmLuxuryHadirNow()" class="btn btn-success w-100 rounded-pill py-2 mt-2 shadow-sm" style="display: none; background-color: #198754; border-color: #198754; font-weight: 600;">
                        <i class="bi bi-check-circle-fill me-1"></i> Hadir
                    </button>
                </form>
            </div>

            <!-- List Doa Restu -->
            <div class="mx-auto text-start" style="max-width: 500px;" id="wishesContainer">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="font-playfair text-gold-light m-0"><i class="bi bi-chat-heart-fill text-gold me-2"></i> Doa Restu (<?= count($wishes) ?>)</h6>
                </div>
                <div id="wishesList">
                    <?php foreach ($wishes as $w): 
                        $wName = $w['guest_name'] ?? $w['name'] ?? 'Tamu Undangan';
                        $wAttendance = $w['attendance'] ?? 'attending';
                    ?>
                        <div class="comment-card">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-white small"><?= htmlspecialchars($wName) ?></span>
                                <?php if ($wAttendance === 'attending'): ?>
                                    <span class="badge bg-success-subtle text-success small" style="font-size: 10px;">Hadir</span>
                                <?php elseif ($wAttendance === 'not_attending'): ?>
                                    <span class="badge bg-danger-subtle text-danger small" style="font-size: 10px;">Tidak Hadir</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 10px;">Ragu-ragu</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-muted small m-0"><?= nl2br(htmlspecialchars($w['message'])) ?></p>
                            <?php if (!empty($w['reply'])): ?>
                                <div class="p-2 rounded-3 mt-2 small text-muted border-start border-3" style="background: rgba(255,255,255,0.04); border-color: var(--luxury-gold) !important;">
                                    <b class="text-gold-light d-block" style="font-size: 11px;">Mempelai:</b>
                                    <?= htmlspecialchars($w['reply']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>


        <!-- 10. PENUTUP & BARCODE UNIK CHECK-IN -->
        <section class="luxury-section pb-5" id="sec-closing">
            <h2 class="font-playfair display-5 text-gold-light mb-2">Thank You</h2>
            <div class="luxury-divider-icon">
                <i class="bi bi-heart-fill text-gold"></i>
            </div>
            <p class="text-muted small mx-auto mb-4" style="max-width: 440px; font-size: 13px;">
                Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu bagi lembaran baru hidup kami.
            </p>
            <p class="font-playfair fs-4 text-gold-light mb-4">
                <?= htmlspecialchars($event['groom_nickname'] ?? 'Dilan') ?> &amp; <?= htmlspecialchars($event['bride_nickname'] ?? 'Milea') ?>
            </p>

            <!-- CARD BARCODE DINAMIS -->
            <div id="bottomBarcodeCard" class="luxury-card mx-auto text-center p-4" style="max-width: 380px;">
                <!-- STATE A: Barcode Unik Check-In Kehadiran (Default & saat Hadir) -->
                <div id="qrCheckinState">
                    <div class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle mb-2" style="width: 44px; height: 44px; background: rgba(25,135,84,0.15); border: 1px solid #198754;">
                        <i class="bi bi-qr-code-scan fs-4 text-success"></i>
                    </div>
                    <h6 class="fw-bold text-white mb-1" id="barcodeTitle">Barcode Check-In Kehadiran</h6>
                    <div class="mb-2">
                        <span class="badge bg-success-subtle text-success small px-3 py-1 rounded-pill" id="barcodeBadgeStatus">Konfirmasi Kehadiran</span>
                    </div>

                    <div class="d-block text-center my-2">
                        <div class="p-2 bg-white rounded-3 d-inline-block shadow">
                            <img id="checkinQrImg" src="<?= 'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=' . urlencode(base_url('u/' . $event['slug'] . '?checkin=' . urlencode(!empty($currentGuest['qr_code']) ? $currentGuest['qr_code'] : $guestName))) ?>" style="width: 135px; height: 135px;" alt="Barcode Check-in">
                        </div>
                    </div>
                    <div class="small fw-semibold text-gold-light mb-1 font-monospace" id="checkinCodeText"><?= htmlspecialchars(!empty($currentGuest['qr_code']) ? $currentGuest['qr_code'] : 'CHECKIN-' . strtoupper(substr(md5($guestName), 0, 8))) ?></div>
                    <span class="small text-muted d-block" id="barcodeDesc" style="font-size: 11px;">
                        Tunjukkan barcode unik ini kepada penerima tamu saat tiba di lokasi acara.
                    </span>
                </div>

                <!-- STATE B: Akses Halaman Transfer / Rekening (Saat Berhalangan Hadir) -->
                <div id="qrTransferState" style="display: none;">
                    <div class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle mb-2" style="width: 44px; height: 44px; background: rgba(212,175,55,0.15); border: 1px solid var(--luxury-gold);">
                        <i class="bi bi-credit-card-2-front fs-4 text-gold"></i>
                    </div>
                    <h6 class="fw-bold text-white mb-1">Akses Rekening &amp; Transfer</h6>
                    <div class="mb-2">
                        <span class="badge bg-warning-subtle text-warning small px-3 py-1 rounded-pill">Titip Hadiah &amp; Doa Digital</span>
                    </div>

                    <div class="d-block text-center my-2">
                        <div class="p-2 bg-white rounded-3 d-inline-block shadow" style="cursor: pointer;" onclick="openGiftModal()" title="Klik untuk membuka pop up rekening">
                            <img id="transferQrImg" src="<?= 'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=' . urlencode(base_url('u/' . $event['slug'] . '?show_gift=1')) ?>" style="width: 135px; height: 135px;" alt="Barcode Transfer Digital">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-luxury-gold rounded-pill px-3 py-1.5 mt-1 mb-2 fw-semibold" onclick="openGiftModal()">
                            <i class="bi bi-wallet2 me-1"></i> Buka Rekening &amp; Amplop Digital
                        </button>
                    </div>
                    <span class="small text-muted d-block mb-3" style="font-size: 11px;">
                        Scan barcode di atas menggunakan kamera HP, atau klik barcode/tombol untuk membuka pop-up daftar rekening &amp; kado yang dapat disalin.
                    </span>
                </div>
            </div>

            <!-- Footer Credit -->
            <div class="mt-5 text-center small text-muted" style="font-size: 11px;">
                Created with <i class="bi bi-heart-fill text-danger mx-1"></i> by <?= site_name() ?>
            </div>
        </section>

    </div>
</div>


<!-- Lightbox Modal untuk Preview Galeri Foto -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0 text-center">
            <div class="modal-body p-0">
                <img id="galleryModalImg" src="" class="img-fluid rounded-4 shadow-lg" style="max-height: 85vh; border: 1px solid var(--luxury-border);" alt="Gallery Preview">
            </div>
        </div>
    </div>
</div>

<!-- Modal Pop-Up Wedding Gift & Amplop Digital (Muncul saat Barcode di-scan atau diklik) -->
<div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="giftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="background-color: #14161a; border: 1px solid var(--luxury-gold); border-radius: 20px; box-shadow: 0 15px 45px rgba(0,0,0,0.85); color: #f7f5f0;">
            <div class="modal-header border-0 pb-0 justify-content-center position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center pt-2 px-2">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2" style="width: 52px; height: 52px; background: rgba(212,175,55,0.15); border: 1px solid var(--luxury-gold);">
                        <i class="bi bi-gift-fill text-gold fs-4"></i>
                    </div>
                    <h5 class="modal-title font-playfair text-gold-light fw-bold" id="giftModalLabel">Kirim Hadiah &amp; Amplop Digital</h5>
                    <p class="small text-muted mb-0 px-2" style="font-size: 12px;">
                        Doa restu Anda merupakan karunia terindah bagi kami. Namun jika ingin mengirimkan tanda kasih secara digital, silakan salin nomor rekening resmi berikut:
                    </p>
                </div>
            </div>
            <div class="modal-body px-4 py-3">
                <?php if (!empty($bankAccounts)): ?>
                    <?php foreach ($bankAccounts as $idx => $b): ?>
                        <div class="p-3 mb-3 rounded-3 text-start" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="font-cinzel text-gold fw-bold"><i class="bi bi-credit-card-2-front-fill me-2"></i> <?= htmlspecialchars($b['bank']) ?></span>
                                <button type="button" class="btn btn-sm btn-outline-warning rounded-pill py-0 px-2.5" style="font-size: 11px;" onclick="copyRekeningText('modal-rek-num-<?= md5($b['number'] . $idx) ?>', this)">
                                    <i class="bi bi-clipboard me-1"></i> Salin No. Rekening
                                </button>
                            </div>
                            <div class="font-monospace fs-5 fw-bold text-white mb-1" id="modal-rek-num-<?= md5($b['number'] . $idx) ?>"><?= htmlspecialchars($b['number'] ?? '') ?></div>
                            <div class="small text-muted">Atas Nama: <span class="text-white fw-semibold"><?= htmlspecialchars($b['owner'] ?? $b['holder'] ?? '') ?></span></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-3 rounded-3 text-center text-muted small" style="background: rgba(255,255,255,0.04);">
                        Pemilik acara belum menambahkan informasi rekening bank.
                    </div>
                <?php endif; ?>

                <?php if (!empty($event['gift_address'])): ?>
                    <div class="p-3 mb-3 rounded-3 text-start" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="font-playfair text-gold-light fw-bold"><i class="bi bi-box2-heart-fill text-gold me-2"></i> Kirim Kado Fisik</span>
                            <button type="button" class="btn btn-sm btn-outline-warning rounded-pill py-0 px-2.5" style="font-size: 11px;" onclick="copyModalAddress('modal-gift-address', this)">
                                <i class="bi bi-clipboard me-1"></i> Salin Alamat
                            </button>
                        </div>
                        <p class="text-muted small m-0" id="modal-gift-address"><?= nl2br(htmlspecialchars($event['gift_address'])) ?></p>
                    </div>
                <?php endif; ?>

                <?php $waPhone = $event['user_phone'] ?? $event['groom_phone'] ?? ''; if (!empty($waPhone)): ?>
                    <div class="mt-3">
                        <a href="https://api.whatsapp.com/send?phone=<?= preg_replace('/[^0-9]/', '', $waPhone) ?>&text=Halo%2C%20saya%20mau%20konfirmasi%20pengiriman%20tanda%20kasih%20undangan%20pernikahan..." target="_blank" class="btn btn-success w-100 rounded-pill py-2 small" style="font-size: 13px;">
                            <i class="bi bi-whatsapp me-2"></i> Konfirmasi via WhatsApp
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-sm btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- ==============================================================
     JAVASCRIPT LOGIC & INTERAKSI
============================================================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// 1. Buka Undangan & Autoplay Musik
let isPlayingAudio = false;
const bgSong = document.getElementById('bgSong');

function openLuxuryInvitation() {
    const modal = document.getElementById('luxuryCoverModal');
    if (modal) {
        modal.classList.add('opened');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 1100);
    }

    // Play Audio via universal engine
    if (bgSong) {
        bgSong.play().then(() => {
            isPlayingAudio = true;
            if (typeof updateMusicUI === 'function') updateMusicUI(true);
        }).catch(() => {
            isPlayingAudio = false;
        });
    }

    // Tampilkan universal dock jika ada
    const smartDock = document.getElementById('smartDockContainer');
    if (smartDock) smartDock.classList.add('is-visible');
}

function toggleAudio() {
    if (typeof smartToggleMusic === 'function') {
        smartToggleMusic();
    } else if (bgSong) {
        if (isPlayingAudio) {
            bgSong.pause();
            isPlayingAudio = false;
        } else {
            bgSong.play();
            isPlayingAudio = true;
        }
    }
}

// 3. Countdown Timer Realtime
const eventDateStr = "<?= date('Y-m-d H:i:s', strtotime($event['event_date'])) ?>";
const targetDate = new Date(eventDateStr.replace(/-/g, "/")).getTime();

function updateCountdown() {
    const now = new Date().getTime();
    const distance = targetDate - now;

    if (distance < 0) {
        document.getElementById('cdDays').innerText = "00";
        document.getElementById('cdHours').innerText = "00";
        document.getElementById('cdMinutes').innerText = "00";
        document.getElementById('cdSeconds').innerText = "00";
        return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('cdDays').innerText = days < 10 ? '0' + days : days;
    document.getElementById('cdHours').innerText = hours < 10 ? '0' + hours : hours;
    document.getElementById('cdMinutes').innerText = minutes < 10 ? '0' + minutes : minutes;
    document.getElementById('cdSeconds').innerText = seconds < 10 ? '0' + seconds : seconds;
}
setInterval(updateCountdown, 1000);
updateCountdown();

// 4. Toggle Digital Gift / Amplop Box
function toggleGiftBox() {
    const box = document.getElementById('luxuryGiftBox');
    const txt = document.getElementById('giftToggleText');
    if (!box) return;
    if (box.style.display === 'none' || box.style.display === '') {
        box.style.display = 'block';
        if (txt) txt.innerText = 'Tutup Daftar Rekening';
    } else {
        box.style.display = 'none';
        if (txt) txt.innerText = 'Kirim Gift & Amplop Digital';
    }
}

// 5. Salin Nomor Rekening dengan Feedback Instan
function copyRekeningText(elementId, btn) {
    const el = document.getElementById(elementId);
    if (!el) return;
    const text = el.innerText.trim();
    navigator.clipboard.writeText(text).then(() => {
        if (btn) {
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-check2-circle me-1 text-success"></i> Tersalin!';
            setTimeout(() => { btn.innerHTML = orig; }, 2500);
        } else {
            alert("Nomor rekening " + text + " berhasil disalin ke clipboard!");
        }
    }).catch(() => {
        alert("Nomor rekening: " + text);
    });
}

function copyModalRekening(elementId, btn) {
    copyRekeningText(elementId, btn);
}

function copyModalAddress(elementId, btn) {
    const el = document.getElementById(elementId);
    if (!el) return;
    const text = el.innerText.trim();
    navigator.clipboard.writeText(text).then(() => {
        if (btn) {
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-check2-circle me-1 text-success"></i> Tersalin!';
            setTimeout(() => { btn.innerHTML = orig; }, 2500);
        } else {
            alert("Alamat kado fisik berhasil disalin!");
        }
    }).catch(() => {
        alert("Alamat: " + text);
    });
}

// 6. Buka Pop-Up Wedding Gift Modal
function openGiftModal() {
    const modalEl = document.getElementById('giftModal');
    if (modalEl) {
        const giftModal = bootstrap.Modal.getOrCreateInstance(modalEl);
        giftModal.show();
    }
}

// 7. Modal Preview Galeri
function viewGalleryModal(imgUrl) {
    const modalImg = document.getElementById('galleryModalImg');
    if (modalImg) modalImg.src = imgUrl;
    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    modal.show();
}

// 7. Handler Dinamis Pilihan Opsi Kehadiran (RSVP & Barcode Swap)
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
        if (btnHadir) btnHadir.style.display = 'none';
        if (paxContainer) paxContainer.style.display = 'none';
        if (qrCheckinState) qrCheckinState.style.display = 'block';
        if (qrTransferState) qrTransferState.style.display = 'none';
    }
}

// 8. Konfirmasi Kehadiran Instan (Tombol Hadir)
function confirmLuxuryHadirNow() {
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

    fetch('<?= base_url('invitation/rsvp/' . $event['slug']) ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        btnHadir.disabled = false;
        btnHadir.innerHTML = originalHtml;

        if (data.success) {
            btnHadir.className = 'btn btn-success w-100 rounded-pill py-2 mt-2 shadow-sm';
            btnHadir.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Terkonfirmasi Hadir (' + data.data.pax + ' Pax)';

            if (data.data.qr_url) {
                const qrImg = document.getElementById('checkinQrImg');
                if (qrImg) qrImg.src = data.data.qr_url;
            }
            if (data.data.qr_code) {
                const codeText = document.getElementById('checkinCodeText');
                if (codeText) codeText.innerText = data.data.qr_code;
            }

            // Tambahkan ucapan baru ke daftar doa restu
            insertNewWishCard(data.data);
            alert("Terima kasih, konfirmasi kehadiran Anda berhasil tercatat!");
        } else {
            alert("Gagal: " + data.message);
        }
    })
    .catch(() => {
        btnHadir.disabled = false;
        btnHadir.innerHTML = originalHtml;
        alert("Terjadi kesalahan koneksi. Silakan coba lagi.");
    });
}

// 9. Submit Form RSVP Biasa
function handleLuxuryRsvp(e) {
    e.preventDefault();
    const btn = document.getElementById('btnRsvp');
    const originalHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';

    const form = document.getElementById('rsvpForm');
    const formData = new FormData(form);

    fetch('<?= base_url('invitation/rsvp/' . $event['slug']) ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = originalHtml;

        if (data.success) {
            if (data.data.attendance === 'attending') {
                const btnHadir = document.getElementById('btnConfirmHadir');
                if (btnHadir) {
                    btnHadir.style.display = 'block';
                    btnHadir.className = 'btn btn-success w-100 rounded-pill py-2 mt-2 shadow-sm';
                    btnHadir.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Terkonfirmasi Hadir (' + data.data.pax + ' Pax)';
                }
                if (data.data.qr_url) {
                    const qrImg = document.getElementById('checkinQrImg');
                    if (qrImg) qrImg.src = data.data.qr_url;
                }
                if (data.data.qr_code) {
                    const codeText = document.getElementById('checkinCodeText');
                    if (codeText) codeText.innerText = data.data.qr_code;
                }
            }

            insertNewWishCard(data.data);
            const msgEl = document.getElementById('messageInput');
            if (msgEl) msgEl.value = '';
            alert("Terima kasih atas ucapan dan konfirmasi kehadiran Anda!");
        } else {
            alert("Gagal: " + data.message);
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerHTML = originalHtml;
        alert("Terjadi kesalahan koneksi. Silakan coba lagi.");
    });
}

function insertNewWishCard(item) {
    const list = document.getElementById('wishesList');
    if (!list) return;

    const newCard = document.createElement('div');
    newCard.className = 'comment-card animate__animated animate__fadeInUp';
    const badge = item.attendance === 'attending' 
        ? '<span class="badge bg-success-subtle text-success small" style="font-size: 10px;">Hadir (' + (item.pax || 1) + ' Pax)</span>'
        : (item.attendance === 'not_attending'
            ? '<span class="badge bg-danger-subtle text-danger small" style="font-size: 10px;">Tidak Hadir</span>'
            : '<span class="badge bg-secondary-subtle text-secondary small" style="font-size: 10px;">Ragu-ragu</span>');

    newCard.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-1">
            <span class="fw-bold text-white small">${item.guest_name}</span>
            ${badge}
        </div>
        <p class="text-muted small m-0">${(item.message || '').replace(/\n/g, '<br>')}</p>
    `;
    list.prepend(newCard);
}

// 10. Buka Pop-up Gift Secara Otomatis Jika Dibuka dari Hasil Scan Barcode Transfer (?show_gift=1)
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('show_gift') === '1' || window.location.hash === '#gift-modal' || window.location.hash === '#show_gift') {
        const coverModal = document.getElementById('luxuryCoverModal');
        if (coverModal) {
            coverModal.style.display = 'none';
        }
        setTimeout(() => {
            openGiftModal();
        }, 400);
    }
});
</script>

<?php do_action('invitation_footer', $event); ?>
</body>
</html>
