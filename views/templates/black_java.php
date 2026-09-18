<?php
// views/templates/black_java.php
// Tema: Black Java Luxury (Theme 82 IndoInvite Replica & Upgrade)
// Estetika: Jawa Klasik Hitam & Emas (Black & Royal Amber Luxury)

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$loveStories = json_decode($event['love_story_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];
$customSchedules = json_decode($event['events_schedule_json'] ?? '[]', true) ?: [];

// Konfigurasi Kustomisasi Tema oleh Admin
$themeConfig = json_decode($event['theme_config_json'] ?? '[]', true) ?: [];
$primaryColor = $themeConfig['primary_color'] ?? '#ff9c1f';
$secondaryColor = $themeConfig['secondary_color'] ?? '#1a1a1a';
$fontHeading = $themeConfig['font_heading'] ?? 'Cinzel';
$fontBody = $themeConfig['font_body'] ?? 'Poppins';

// Konfigurasi Efek Animasi & Transisi dari Admin
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

// Fallback Gambar & Aset IndoInvite Theme 82
$defaultCover = 'https://media.indoinvite.com/2db3bf1e16cd47a08843bb881e39cce7:indoinvite-staging/indoinvite-staging/indoinvite-staging/nikah/upload/sampul_19521762398202.jpeg';
$defaultHero = 'https://media.indoinvite.com/2db3bf1e16cd47a08843bb881e39cce7:indoinvite-staging/indoinvite-staging/indoinvite-staging/nikah/upload/galery/1679297398.jpeg';
$defaultGroom = 'https://media.indoinvite.com/2db3bf1e16cd47a08843bb881e39cce7:indoinvite-staging/indoinvite-staging/indoinvite-staging/nikah/upload/1952/1679297306foto_pria.jpeg';
$defaultBride = 'https://media.indoinvite.com/2db3bf1e16cd47a08843bb881e39cce7:indoinvite-staging/indoinvite-staging/indoinvite-staging/nikah/upload/1952/1679297306foto_wanita.jpeg';

$coverImage = !empty($event['cover_photo']) ? media_url($event['cover_photo']) : (!empty($event['cover_image']) ? media_url($event['cover_image']) : (!empty($galleries[0]) ? media_url($galleries[0]) : $defaultCover));
$heroImage = !empty($event['hero_photo']) ? media_url($event['hero_photo']) : (!empty($galleries[1]) ? media_url($galleries[1]) : $coverImage);
$bgImage = !empty($event['bg_photo']) ? media_url($event['bg_photo']) : $coverImage;
$groomPhoto = !empty($event['groom_photo']) ? media_url($event['groom_photo']) : $defaultGroom;
$bridePhoto = !empty($event['bride_photo']) ? media_url($event['bride_photo']) : $defaultBride;

// Ornamen Khas Jawa & Wayang
$wayangOrnament = 'https://indoinvite.com/nikah/template/bee-classic/wayang.png';
$curvedDivider = 'https://indoinvite.com/nikah/template/honey-bali/btn_ornamen.png';
$bottomDivider = 'https://indoinvite.com/nikah/template/bee-classic/divid.webp';
$patternBatu = 'https://indoinvite.com/nikah/template/honey-bali/bg-batu.jpg';

// Music URL fallback
$rawMusic = $event['music_url'] ?? '';
$resolvedMusicUrl = (!empty($rawMusic) && (str_starts_with($rawMusic, 'http://') || str_starts_with($rawMusic, 'https://'))) ? $rawMusic : base_url($rawMusic ?: 'assets/audio/wedding_music.mp3');

// Tanggal Acara
$eventTimestamp = strtotime($event['event_date'] ?? 'now');
$eventDateIso = date('Y-m-d\TH:i:s', $eventTimestamp);
$eventDayNum = date('d', $eventTimestamp);
$eventYear = date('Y', $eventTimestamp);
$indonesianMonths = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$indonesianDays = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
$eventMonth = $indonesianMonths[(int)date('n', $eventTimestamp) - 1];
$eventDayName = $indonesianDays[(int)date('w', $eventTimestamp)];

// Format Nama Pengantin
$groomNickname = $event['groom_nickname'] ?: ($event['groom_name'] ? explode(' ', trim($event['groom_name']))[0] : 'Justin');
$brideNickname = $event['bride_nickname'] ?: ($event['bride_name'] ? explode(' ', trim($event['bride_name']))[0] : 'Sisca');
$coupleTitle = $groomNickname . ' & ' . $brideNickname;

// Kutipan / Doa (Dinamis dari preset tradisi/agama atau default Ar-Rum 21)
$quoteText = $event['quote'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title><?= htmlspecialchars($event['title'] ?: "The Wedding of {$coupleTitle}") ?></title>

    <!-- Dynamic Favicon -->
    <?php $favUrl = site_favicon_url(); ?>
    <?php if (!empty($favUrl)): ?>
        <link rel="icon" href="<?= htmlspecialchars($favUrl) ?>">
        <link rel="apple-touch-icon" href="<?= htmlspecialchars($favUrl) ?>">
    <?php else: ?>
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/833/833472.png" type="image/png">
    <?php endif; ?>

    <!-- OpenGraph Metadata -->
    <meta property="og:title" content="<?= htmlspecialchars($event['title'] ?: "The Wedding of {$coupleTitle}") ?>">
    <meta property="og:description" content="Undangan digital pernikahan untuk <?= htmlspecialchars($guestName) ?>.">
    <meta property="og:image" content="<?= htmlspecialchars($coverImage) ?>">
    <meta property="og:type" content="article">

    <!-- Google Fonts: Jawa Klasik & Modern Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:ital,wght@0,400;0,700;1,400&family=Berkshire+Swash&family=Cinzel:wght@500;700;900&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Waterfall&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --bj-primary: #ff9c1f;
            --bj-primary-hover: #e0830f;
            --bj-primary-glow: rgba(255, 156, 31, 0.4);
            --bj-dark: #121212;
            --bj-dark-surface: #1e1e1e;
            --bj-dark-card: #252528;
            --bj-card-stone: #292929;
            --bj-gold: #ff9c1f;
            --bj-gold-light: #ffc477;
            --bj-text: #ffffff;
            --bj-text-muted: #d5d5d5;
            --bj-border-radius: 12px;
            --bj-arch-radius: 110px 110px 0 0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0b0c0e;
            color: var(--bj-text);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Mobile Container App Layout */
        .bj-wrapper {
            max-width: 500px;
            margin: 0 auto;
            background-color: #121212;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.9);
            overflow: hidden;
        }

        /* Typography */
        h1, h2, .font-heading {
            font-family: 'Cinzel', 'Averia Serif Libre', serif;
            font-weight: 700;
        }

        h3, .font-subheading {
            font-family: 'Averia Serif Libre', cursive;
        }

        .font-script {
            font-family: 'Waterfall', 'Berkshire Swash', cursive;
        }

        .text-gold {
            color: var(--bj-primary) !important;
        }

        .bg-gold {
            background-color: var(--bj-primary) !important;
            color: #000000 !important;
        }

        .btn-gold {
            background-color: var(--bj-primary);
            color: #111111;
            font-family: 'Averia Serif Libre', cursive;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 15px var(--bj-primary-glow);
        }

        .btn-gold:hover, .btn-gold:focus {
            background-color: var(--bj-primary-hover);
            color: #000000;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 156, 31, 0.6);
        }

        /* 1. Cover Pembuka (Awal) */
        .bj-cover-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            z-index: 99999;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.75) 70%, #000000 100%),
                        url('<?= htmlspecialchars($coverImage) ?>') center center / cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: transform 0.8s cubic-bezier(0.77, 0, 0.175, 1), opacity 0.8s ease;
        }

        .bj-cover-overlay.opened {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        .bj-cover-content {
            max-width: 440px;
            padding: 30px 24px;
            margin: 0 auto;
            position: relative;
        }

        .bj-wayang-icon {
            width: 85px;
            filter: drop-shadow(0 4px 10px rgba(255, 156, 31, 0.5));
            margin-bottom: 20px;
        }

        .bj-cover-title {
            font-size: 22px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #ffffff;
            margin-bottom: 8px;
        }

        .bj-cover-names {
            font-size: 46px;
            color: var(--bj-primary);
            line-height: 1.15;
            margin: 15px 0 25px 0;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.8);
        }

        .bj-guest-badge {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 156, 31, 0.35);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 30px;
        }

        /* 2. Hero Section */
        .bj-hero {
            position: relative;
            background: linear-gradient(180deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.85) 80%, #121212 100%),
                        url('<?= htmlspecialchars($heroImage) ?>') center top / cover no-repeat;
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            text-align: center;
            padding: 80px 20px 40px 20px;
        }

        .bj-ornament-divider {
            width: 100%;
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: -1px;
        }

        /* 3. Section Styling */
        .bj-section {
            padding: 60px 24px;
            position: relative;
            text-align: center;
        }

        .bj-section-stone {
            background: url('<?= htmlspecialchars($patternBatu) ?>') repeat center center;
            background-size: 350px;
            background-color: #242426;
        }

        .bj-section-dark {
            background-color: #121212;
        }

        .bj-section-title {
            font-size: 36px;
            color: var(--bj-primary);
            margin-bottom: 8px;
        }

        .bj-section-subtitle {
            font-size: 18px;
            color: #ffffff;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* 4. Pengantin / Couple Profile */
        .bj-couple-card {
            margin-bottom: 40px;
        }

        .bj-arch-frame {
            width: 220px;
            height: 290px;
            margin: 0 auto 20px auto;
            border-radius: var(--bj-arch-radius);
            border: 8px solid var(--bj-primary);
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.7);
            position: relative;
            background-color: #222;
        }

        .bj-arch-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .bj-arch-frame:hover img {
            transform: scale(1.06);
        }

        .bj-couple-name {
            font-size: 30px;
            color: var(--bj-primary);
            margin-bottom: 6px;
        }

        .bj-couple-parents {
            font-size: 13px;
            color: var(--bj-text-muted);
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .bj-ampersand {
            font-family: 'Averia Serif Libre', serif;
            font-size: 65px;
            color: var(--bj-primary);
            margin: 10px 0;
            line-height: 1;
            text-shadow: 0 0 15px var(--bj-primary-glow);
        }

        .bj-ig-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: var(--bj-primary);
            color: #000000;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .bj-ig-btn:hover {
            background-color: #ffffff;
            color: #000000;
        }

        /* 5. Countdown Section */
        .bj-countdown-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 30px 0;
        }

        .bj-count-box {
            background: var(--bj-primary);
            color: #000000;
            border-radius: 12px;
            width: 72px;
            height: 76px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 15px rgba(255, 156, 31, 0.35);
        }

        .bj-count-num {
            font-size: 24px;
            font-weight: 800;
            line-height: 1;
        }

        .bj-count-label {
            font-size: 10px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-top: 4px;
        }

        .bj-holy-card {
            background: rgba(0, 0, 0, 0.45);
            border: 1px solid rgba(255, 156, 31, 0.3);
            border-radius: 14px;
            padding: 24px 20px;
            margin-top: 20px;
        }

        /* 6. Acara & Schedule Cards */
        .bj-event-card {
            background-color: #ffffff;
            color: #1a1a1a;
            border-radius: 24px;
            padding: 40px 20px 30px 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            position: relative;
        }

        .bj-event-card.arch-top {
            border-radius: 100px 100px 16px 16px;
        }

        .bj-event-card.arch-bottom {
            border-radius: 16px 16px 100px 100px;
        }

        .bj-event-title {
            font-size: 26px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .bj-calendar-split {
            display: flex;
            align-items: center;
            justify-content: center;
            border-top: 1px solid #e5e5e5;
            border-bottom: 1px solid #e5e5e5;
            padding: 12px 0;
            margin: 15px 0 20px 0;
        }

        .bj-cal-left, .bj-cal-right {
            flex: 1;
            font-size: 15px;
            font-weight: 600;
            color: #333333;
        }

        .bj-cal-left {
            text-align: right;
            padding-right: 15px;
        }

        .bj-cal-right {
            text-align: left;
            padding-left: 15px;
        }

        .bj-cal-center {
            font-size: 40px;
            font-weight: 900;
            color: var(--bj-primary);
            line-height: 1;
            padding: 0 15px;
            border-left: 2px solid #ddd;
            border-right: 2px solid #ddd;
        }

        .bj-maps-box {
            border-radius: 12px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        /* 7. Story & Timeline */
        .bj-story-card {
            background-color: var(--bj-primary);
            color: #111111;
            border-radius: 14px;
            padding: 24px 18px;
            margin-bottom: 24px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }

        .bj-story-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .bj-story-card h4 {
            font-size: 18px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 8px;
        }

        .bj-story-card p {
            font-size: 13px;
            color: #1f1f1f;
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* 8. Galeri */
        .bj-gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 20px;
        }

        .bj-gallery-item {
            aspect-ratio: 1;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }

        .bj-gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .bj-gallery-item:hover img {
            transform: scale(1.08);
        }

        /* 9. Titip Hadiah / Bank Accounts */
        .bj-bank-card {
            background: #ffffff;
            color: #1a1a1a;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 18px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }

        .bj-bank-logo {
            height: 35px;
            max-width: 120px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .bj-account-number {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #111111;
            margin-bottom: 4px;
        }

        .bj-account-owner {
            font-size: 13px;
            color: #666666;
            margin-bottom: 14px;
        }

        /* 10. RSVP & Buku Tamu */
        .bj-form-control {
            background-color: #f8f9fa;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 14px;
            color: #1a1a1a;
            font-size: 14px;
            width: 100%;
            margin-bottom: 14px;
        }

        .bj-form-control:focus {
            background-color: #ffffff;
            border-color: var(--bj-primary);
            outline: none;
            box-shadow: 0 0 0 3px var(--bj-primary-glow);
        }

        .bj-wish-item {
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid var(--bj-primary);
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 14px;
            text-align: left;
        }

        .bj-wish-name {
            font-weight: 700;
            color: var(--bj-primary);
            font-size: 14px;
            margin-bottom: 2px;
        }

        .bj-wish-badge {
            display: inline-block;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 10px;
            margin-bottom: 6px;
        }

        .bj-wish-text {
            font-size: 13px;
            color: #e2e8f0;
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* 11. Bottom Smart Dock */
        .bj-smart-dock {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            max-width: 440px;
            width: calc(100% - 32px);
            background: rgba(18, 18, 18, 0.88);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 156, 31, 0.35);
            border-radius: 30px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            z-index: 9999;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .bj-smart-dock.is-visible {
            transform: translateX(-50%) translateY(0);
        }

        .bj-dock-btn {
            background: transparent;
            border: none;
            color: #aaaaaa;
            font-size: 18px;
            padding: 8px 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .bj-dock-btn span {
            font-size: 9px;
            font-weight: 500;
        }

        .bj-dock-btn:hover, .bj-dock-btn.active {
            color: var(--bj-primary);
        }

        .bj-disc-spin {
            animation: discSpin 4s linear infinite;
        }

        @keyframes discSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Toast Alert */
        .bj-toast {
            position: fixed;
            top: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(-100px);
            background: #ffffff;
            color: #111111;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
            border-left: 4px solid var(--bj-primary);
            z-index: 100000;
            transition: transform 0.3s ease;
            pointer-events: none;
        }

        .bj-toast.show {
            transform: translateX(-50%) translateY(0);
        }
    </style>
</head>
<body>

<!-- Toast Notification -->
<div id="bjToast" class="bj-toast">
    <i class="bi bi-check-circle-fill text-success me-1"></i> <span id="bjToastText">Nomor rekening berhasil disalin!</span>
</div>

<!-- Modal Galeri Lightbox -->
<div class="modal fade" id="bjGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0 text-center">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <img id="bjGalleryModalImg" src="" class="img-fluid rounded-4 shadow-lg" style="max-height: 85vh; border: 2px solid var(--bj-primary);" alt="Preview">
            </div>
        </div>
    </div>
</div>

<!-- Audio Player -->
<audio id="bjAudio" loop preload="auto">
    <source src="<?= htmlspecialchars($resolvedMusicUrl) ?>" type="audio/mpeg">
</audio>

<!-- 1. FULLSCREEN COVER SCREEN (AWAL) -->
<div id="bjCoverOverlay" class="bj-cover-overlay">
    <div class="bj-cover-content">
        <img src="<?= htmlspecialchars($wayangOrnament) ?>" class="bj-wayang-icon anim-fade-in" alt="Wayang Gunungan">
        
        <h4 class="bj-cover-title font-heading anim-slide-up">Wedding Invitation</h4>
        <div class="bj-cover-names font-heading anim-zoom-in"><?= htmlspecialchars($coupleTitle) ?></div>

        <div class="bj-guest-badge anim-slide-up">
            <div style="font-size: 12px; color: var(--bj-primary); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 4px;">Kepada Yth. Bapak/Ibu/Saudara/i:</div>
            <h3 style="font-size: 20px; font-weight: 700; color: #ffffff; margin-bottom: 0;"><?= htmlspecialchars($guestName) ?></h3>
        </div>

        <button id="bjBtnOpen" class="btn-gold px-4 py-2 anim-bounce-in" onclick="bjOpenInvitation()">
            <i class="bi bi-envelope-open-heart-fill fs-5"></i> Buka Undangan
        </button>
    </div>
</div>

<!-- MAIN CONTENT WRAPPER (MOBILE APP CONTAINER) -->
<div class="bj-wrapper">

    <!-- 2. HERO SECTION -->
    <section id="home" class="bj-hero">
        <img src="<?= htmlspecialchars($wayangOrnament) ?>" class="bj-wayang-icon mb-2" alt="Gunungan">
        <p class="text-uppercase tracking-widest text-gold mb-1" style="font-size: 12px; letter-spacing: 2px;">We Invited You To</p>
        <h2 class="text-uppercase mb-2" style="font-size: 18px; letter-spacing: 3px;">The Wedding Of</h2>
        <h1 class="font-heading text-gold display-4 mb-3" style="font-weight: 800; line-height: 1.1;"><?= htmlspecialchars($coupleTitle) ?></h1>
        <p class="text-white-muted mb-4" style="font-size: 14px;">
            <i class="bi bi-calendar-check-fill text-gold me-1"></i> <?= htmlspecialchars($eventDayName) ?>, <?= htmlspecialchars($eventDayNum) ?> <?= htmlspecialchars($eventMonth) ?> <?= htmlspecialchars($eventYear) ?>
        </p>
        <img src="<?= htmlspecialchars($curvedDivider) ?>" class="bj-ornament-divider" alt="Divider">
    </section>

    <!-- 3. PASANGAN MEMPELAI -->
    <section id="couple" class="bj-section bj-section-dark">
        <img src="<?= htmlspecialchars($wayangOrnament) ?>" style="width: 55px; opacity: 0.8;" class="mb-3" alt="Wayang">
        <h2 class="bj-section-title">Pasangan Pengantin</h2>
        <p class="text-white-muted mb-5" style="font-size: 13px; max-width: 90%; margin: 0 auto;">
            Atas Rahmat Tuhan Yang Maha Esa, kami bermaksud mengundang Anda dalam momen sakral nan bahagia pernikahan kami:
        </p>

        <!-- Groom Profile -->
        <div class="bj-couple-card anim-slide-up">
            <div class="bj-arch-frame">
                <img src="<?= htmlspecialchars($groomPhoto) ?>" alt="<?= htmlspecialchars($event['groom_name'] ?: 'Groom') ?>">
            </div>
            <h3 class="bj-couple-name"><?= htmlspecialchars($event['groom_name'] ?: 'Tobias Justin') ?></h3>
            <div class="bj-couple-parents">
                <?php if (!empty($event['groom_father']) || !empty($event['groom_mother'])): ?>
                    Putra tercinta dari: <br>
                    <strong><?= htmlspecialchars($event['groom_father'] ?: 'Bpk. Ayah') ?></strong> &amp; <strong><?= htmlspecialchars($event['groom_mother'] ?: 'Ibu Ibu') ?></strong>
                <?php else: ?>
                    <?= nl2br(htmlspecialchars($event['groom_parents'] ?: "Putra dari Pasangan\nBpk. Ayah Justin & Ibu Ibu Justin")) ?>
                <?php endif; ?>
            </div>
            <?php if (!empty($event['groom_instagram'])): ?>
                <a href="https://instagram.com/<?= htmlspecialchars(ltrim($event['groom_instagram'], '@')) ?>" target="_blank" class="bj-ig-btn">
                    <i class="bi bi-instagram"></i> @<?= htmlspecialchars(ltrim($event['groom_instagram'], '@')) ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Ampersand -->
        <div class="bj-ampersand">&amp;</div>

        <!-- Bride Profile -->
        <div class="bj-couple-card anim-slide-up">
            <div class="bj-arch-frame">
                <img src="<?= htmlspecialchars($bridePhoto) ?>" alt="<?= htmlspecialchars($event['bride_name'] ?: 'Bride') ?>">
            </div>
            <h3 class="bj-couple-name"><?= htmlspecialchars($event['bride_name'] ?: 'Sisca Kohl') ?></h3>
            <div class="bj-couple-parents">
                <?php if (!empty($event['bride_father']) || !empty($event['bride_mother'])): ?>
                    Putri tercinta dari: <br>
                    <strong><?= htmlspecialchars($event['bride_father'] ?: 'Bpk. Ayah') ?></strong> &amp; <strong><?= htmlspecialchars($event['bride_mother'] ?: 'Ibu Ibu') ?></strong>
                <?php else: ?>
                    <?= nl2br(htmlspecialchars($event['bride_parents'] ?: "Putri dari Pasangan\nBpk. Ayah Sisca & Ibu Ibu Sisca")) ?>
                <?php endif; ?>
            </div>
            <?php if (!empty($event['bride_instagram'])): ?>
                <a href="https://instagram.com/<?= htmlspecialchars(ltrim($event['bride_instagram'], '@')) ?>" target="_blank" class="bj-ig-btn">
                    <i class="bi bi-instagram"></i> @<?= htmlspecialchars(ltrim($event['bride_instagram'], '@')) ?>
                </a>
            <?php endif; ?>
        </div>
    </section>

    <!-- 4. COUNTDOWN & AYAT SUCI -->
    <section class="bj-section bj-section-stone">
        <h3 class="font-subheading text-white mb-1" style="font-size: 20px;">Hitung Mundur</h3>
        <h2 class="bj-section-title mb-3">Menuju Acara</h2>

        <!-- Boxes -->
        <div class="bj-countdown-container">
            <div class="bj-count-box">
                <span id="bjDays" class="bj-count-num">00</span>
                <span class="bj-count-label">Hari</span>
            </div>
            <div class="bj-count-box">
                <span id="bjHours" class="bj-count-num">00</span>
                <span class="bj-count-label">Jam</span>
            </div>
            <div class="bj-count-box">
                <span id="bjMinutes" class="bj-count-num">00</span>
                <span class="bj-count-label">Menit</span>
            </div>
            <div class="bj-count-box">
                <span id="bjSeconds" class="bj-count-num">00</span>
                <span class="bj-count-label">Detik</span>
            </div>
        </div>

        <!-- Holy Verse / Quote -->
        <div class="bj-holy-card">
            <?php if (!empty($quoteText)): ?>
                <p class="fst-italic text-white-muted mb-0" style="font-size: 13px; line-height: 1.7;">
                    <?= nl2br(htmlspecialchars($quoteText)) ?>
                </p>
            <?php else: ?>
                <p style="font-size: 15px; color: var(--bj-primary); margin-bottom: 8px;" dir="rtl">
                    وَمِنْ اٰيٰتِهٖٓ اَنْ خَلَقَ لَكُمْ مِّنْ اَنْفُسِكُمْ اَزْوَاجًا لِّتَسْكُنُوْٓا اِلَيْهَا وَجَعَلَ بَيْنَكُمْ مَّوَدَّةً وَّرَحْمَةًۗ اِنَّ فِيْ ذٰلِكَ لَاٰيٰتٍ لِّقَوْمٍ يَّتَفَكَّرُوْنَ
                </p>
                <p class="text-white-muted mb-2" style="font-size: 12px; line-height: 1.6;">
                    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa cinta dan kasih sayang."
                </p>
                <strong class="text-gold" style="font-size: 12px;">- QS. Ar-Rum · Ayat 21 -</strong>
            <?php endif; ?>
        </div>
    </section>

    <!-- 5. WAKTU & TEMPAT ACARA -->
    <section id="event" class="bj-section bj-section-dark">
        <img src="<?= htmlspecialchars($wayangOrnament) ?>" style="width: 60px;" class="mb-2" alt="Gunungan">
        <h3 class="text-white font-subheading" style="font-size: 20px;">Waktu &amp; Tempat</h3>
        <h2 class="bj-section-title mb-4">Rangkaian Acara</h2>

        <?php if (!empty($customSchedules)): ?>
            <!-- Rangkaian Acara Dinamis dari Preset / Form Input User -->
            <?php foreach ($customSchedules as $idx => $sch): ?>
                <?php
                    $schTitle = $sch['title'] ?? ($idx === 0 ? 'Akad Nikah' : 'Resepsi Pernikahan');
                    $schDateRaw = !empty($sch['date']) ? $sch['date'] : ($event['event_date'] ?? 'now');
                    $schTime = $sch['time'] ?? '08:00 WIB - Selesai';
                    $schPlace = $sch['place'] ?? 'Lokasi Acara';
                    $schAddress = $sch['address'] ?? '';
                    $schMaps = $sch['maps_url'] ?? ($event['maps_url'] ?? '');
                    
                    $schTs = strtotime($schDateRaw);
                    $schDayNum = date('d', $schTs);
                    $schYear = date('Y', $schTs);
                    $schMonth = $indonesianMonths[(int)date('n', $schTs) - 1];
                    $schDayName = $indonesianDays[(int)date('w', $schTs)];
                    $isFirst = ($idx === 0);
                    $isLast = ($idx === count($customSchedules) - 1);
                ?>
                <div class="bj-event-card <?= $isFirst ? 'arch-top' : ($isLast ? 'arch-bottom' : '') ?> anim-slide-up">
                    <h3 class="bj-event-title"><?= htmlspecialchars($schTitle) ?></h3>
                    <div style="font-size: 15px; font-weight: 700; color: var(--bj-primary);"><?= htmlspecialchars($schMonth) ?></div>

                    <div class="bj-calendar-split">
                        <div class="bj-cal-left"><?= htmlspecialchars($schDayName) ?></div>
                        <div class="bj-cal-center"><?= htmlspecialchars($schDayNum) ?></div>
                        <div class="bj-cal-right"><?= htmlspecialchars($schYear) ?></div>
                    </div>

                    <div style="font-size: 15px; font-weight: 600; color: #111; margin-bottom: 6px;">
                        <i class="bi bi-clock-fill text-gold me-1"></i> <?= htmlspecialchars($schTime) ?>
                    </div>
                    <div style="font-size: 14px; font-weight: 700; color: #222; margin-bottom: 4px;">
                        <?= htmlspecialchars($schPlace) ?>
                    </div>
                    <?php if (!empty($schAddress)): ?>
                        <div style="font-size: 12px; color: #555; margin-bottom: 15px;">
                            <?= nl2br(htmlspecialchars($schAddress)) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($schMaps)): ?>
                        <a href="<?= htmlspecialchars($schMaps) ?>" target="_blank" class="btn btn-dark btn-sm rounded-pill px-3 py-1 mt-2">
                            <i class="bi bi-geo-alt-fill text-gold"></i> Buka Google Maps
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Fallback Default: Akad & Resepsi -->
            <div class="bj-event-card arch-top anim-slide-up">
                <h3 class="bj-event-title">Akad Nikah</h3>
                <div style="font-size: 15px; font-weight: 700; color: var(--bj-primary);"><?= htmlspecialchars($eventMonth) ?></div>

                <div class="bj-calendar-split">
                    <div class="bj-cal-left"><?= htmlspecialchars($eventDayName) ?></div>
                    <div class="bj-cal-center"><?= htmlspecialchars($eventDayNum) ?></div>
                    <div class="bj-cal-right"><?= htmlspecialchars($eventYear) ?></div>
                </div>

                <div style="font-size: 15px; font-weight: 600; color: #111; margin-bottom: 6px;">
                    <i class="bi bi-clock-fill text-gold me-1"></i> <?= htmlspecialchars($event['akad_time'] ?: '08:00 - 10:00 WIB') ?>
                </div>
                <div style="font-size: 13px; color: #555; margin-bottom: 15px;">
                    <?= nl2br(htmlspecialchars($event['akad_location'] ?: 'Lokasi Acara Akad')) ?>
                </div>

                <?php if (!empty($event['maps_url'])): ?>
                    <a href="<?= htmlspecialchars($event['maps_url']) ?>" target="_blank" class="btn btn-dark btn-sm rounded-pill px-3 py-1">
                        <i class="bi bi-geo-alt-fill text-gold"></i> Google Maps Lokasi
                    </a>
                <?php endif; ?>
            </div>

            <div class="bj-event-card arch-bottom anim-slide-up">
                <h3 class="bj-event-title">Resepsi Pernikahan</h3>
                <div style="font-size: 15px; font-weight: 700; color: var(--bj-primary);"><?= htmlspecialchars($eventMonth) ?></div>

                <div class="bj-calendar-split">
                    <div class="bj-cal-left"><?= htmlspecialchars($eventDayName) ?></div>
                    <div class="bj-cal-center"><?= htmlspecialchars($eventDayNum) ?></div>
                    <div class="bj-cal-right"><?= htmlspecialchars($eventYear) ?></div>
                </div>

                <div style="font-size: 15px; font-weight: 600; color: #111; margin-bottom: 6px;">
                    <i class="bi bi-clock-fill text-gold me-1"></i> <?= htmlspecialchars($event['resepsi_time'] ?: '11:00 - 14:00 WIB') ?>
                </div>
                <div style="font-size: 13px; color: #555; margin-bottom: 15px;">
                    <?= nl2br(htmlspecialchars($event['resepsi_location'] ?: 'Lokasi Acara Resepsi')) ?>
                </div>

                <?php if (!empty($event['maps_url'])): ?>
                    <a href="<?= htmlspecialchars($event['maps_url']) ?>" target="_blank" class="btn btn-dark btn-sm rounded-pill px-3 py-1">
                        <i class="bi bi-geo-alt-fill text-gold"></i> Google Maps Lokasi
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Embed Google Maps -->
        <?php if (!empty($event['maps_embed'])): ?>
            <div class="bj-maps-box anim-fade-in mt-4">
                <?= $event['maps_embed'] ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- 6. KISAH CINTA (OUR STORY) -->
    <?php if (!empty($loveStories)): ?>
        <section id="story" class="bj-section bj-section-stone">
            <h3 class="text-white font-subheading" style="font-size: 20px;">Sebuah Kisah</h3>
            <h2 class="bj-section-title mb-4">Our Love Story</h2>

            <?php foreach ($loveStories as $story): ?>
                <div class="bj-story-card anim-slide-up">
                    <?php if (!empty($story['image'])): ?>
                        <img src="<?= htmlspecialchars(media_url($story['image'])) ?>" alt="<?= htmlspecialchars($story['title'] ?? 'Story') ?>" loading="lazy">
                    <?php endif; ?>
                    <?php if (!empty($story['year'])): ?>
                        <span class="badge bg-dark text-gold mb-2 px-3 py-1" style="font-size: 11px;"><?= htmlspecialchars($story['year']) ?></span>
                    <?php endif; ?>
                    <h4><?= htmlspecialchars($story['title'] ?? 'Kisah Cinta') ?></h4>
                    <p><?= nl2br(htmlspecialchars($story['desc'] ?? ($story['story'] ?? ''))) ?></p>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <!-- 7. GALERI FOTO & VIDEO -->
    <?php if (!empty($galleries)): ?>
        <section id="gallery" class="bj-section bj-section-dark">
            <h2 class="bj-section-title mb-1">Our Gallery</h2>
            <p class="text-white-muted mb-4" style="font-size: 13px;">Momen Bahagia &amp; Kenangan Manis Kami</p>

            <div class="bj-gallery-grid">
                <?php foreach ($galleries as $gIdx => $gItem): ?>
                    <div class="bj-gallery-item anim-zoom-in" onclick="bjOpenGalleryModal('<?= htmlspecialchars(media_url($gItem)) ?>')">
                        <img src="<?= htmlspecialchars(media_url($gItem)) ?>" alt="Galeri <?= $gIdx + 1 ?>" loading="lazy">
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 8. TITIP HADIAH / AMPLOP DIGITAL -->
    <section id="gift" class="bj-section bj-section-stone">
        <h2 class="bj-section-title mb-2">Titip Hadiah</h2>
        <p class="text-white-muted mb-4" style="font-size: 13px; max-width: 90%; margin: 0 auto;">
            Doa restu Bapak/Ibu sekalian merupakan karunia yang sangat berarti bagi kami. Dan jika memberi merupakan ungkapan tanda kasih, Anda dapat menyalurkannya secara cashless melalui rekening di bawah ini:
        </p>

        <?php if (!empty($bankAccounts)): ?>
            <?php foreach ($bankAccounts as $bank): ?>
                <?php
                    $bankName = strtoupper($bank['bank'] ?? 'BANK');
                    $accNum = $bank['number'] ?? ($bank['no_rek'] ?? '');
                    $accHolder = $bank['owner'] ?? ($bank['holder'] ?? ($bank['atas_nama'] ?? $coupleTitle));
                ?>
                <div class="bj-bank-card anim-slide-up">
                    <div class="text-gold fw-bold mb-1" style="font-size: 16px; letter-spacing: 1px;">
                        <i class="bi bi-credit-card-2-front-fill me-1"></i> <?= htmlspecialchars($bankName) ?>
                    </div>
                    <div class="bj-account-number" id="acc_<?= htmlspecialchars($accNum) ?>"><?= htmlspecialchars($accNum) ?></div>
                    <div class="bj-account-owner">a.n. <?= htmlspecialchars($accHolder) ?></div>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-4" onclick="bjCopyText('<?= htmlspecialchars($accNum) ?>')">
                        <i class="bi bi-clipboard-check"></i> Salin Rekening
                    </button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Fallback Sample Bank Card -->
            <div class="bj-bank-card anim-slide-up">
                <div class="text-gold fw-bold mb-1" style="font-size: 16px;"><i class="bi bi-credit-card-2-front-fill me-1"></i> BANK BCA</div>
                <div class="bj-account-number">1234 5678 90</div>
                <div class="bj-account-owner">a.n. <?= htmlspecialchars($coupleTitle) ?></div>
                <button class="btn btn-outline-dark btn-sm rounded-pill px-4" onclick="bjCopyText('1234567890')">
                    <i class="bi bi-clipboard-check"></i> Salin Rekening
                </button>
            </div>
        <?php endif; ?>

        <!-- Alamat Kirim Kado Fisik jika ada -->
        <?php if (!empty($event['gift_address'])): ?>
            <div class="bj-bank-card anim-slide-up mt-3">
                <div class="text-gold fw-bold mb-1" style="font-size: 16px;"><i class="bi bi-gift-fill me-1"></i> Kirim Kado Fisik</div>
                <div style="font-size: 13px; color: #444; line-height: 1.5;" class="mb-3">
                    <?= nl2br(htmlspecialchars($event['gift_address'])) ?>
                </div>
                <button class="btn btn-outline-dark btn-sm rounded-pill px-4" onclick="bjCopyText('<?= htmlspecialchars(str_replace(["\r", "\n"], ' ', $event['gift_address'])) ?>')">
                    <i class="bi bi-clipboard-check"></i> Salin Alamat
                </button>
            </div>
        <?php endif; ?>
    </section>

    <!-- 9. KONFIRMASI KEHADIRAN & UCAPAN (RSVP & WISHES) -->
    <section id="rsvp" class="bj-section bj-section-dark">
        <h2 class="bj-section-title mb-1">Buku Tamu &amp; Doa</h2>
        <p class="text-white-muted mb-4" style="font-size: 13px;">Kirimkan konfirmasi kehadiran &amp; doa restu Anda</p>

        <!-- Form RSVP -->
        <div class="card bg-dark border-secondary p-4 mb-4 text-start shadow-sm" style="border-radius: 16px;">
            <form action="<?= base_url('wishes/store') ?>" method="POST">
                <input type="hidden" name="event_id" value="<?= htmlspecialchars($event['id'] ?? 0) ?>">
                
                <div class="mb-3">
                    <label class="form-label text-gold small fw-bold">Nama Lengkap</label>
                    <input type="text" name="name" class="bj-form-control" value="<?= htmlspecialchars($guestName !== 'Tamu Undangan' ? $guestName : '') ?>" placeholder="Masukkan nama Anda..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small fw-bold">Konfirmasi Kehadiran</label>
                    <select name="attendance" class="bj-form-control" required>
                        <option value="attending">Hadir</option>
                        <option value="not_attending">Tidak Dapat Hadir</option>
                        <option value="uncertain">Masih Ragu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small fw-bold">Ucapan &amp; Doa Restu</label>
                    <textarea name="message" class="bj-form-control" rows="3" placeholder="Tuliskan ucapan dan doa terbaik Anda untuk kedua mempelai..." required></textarea>
                </div>

                <button type="submit" class="btn-gold w-100 py-2">
                    <i class="bi bi-send-fill"></i> Kirim Ucapan
                </button>
            </form>
        </div>

        <!-- Daftar Ucapan Tamu -->
        <?php if (!empty($wishes)): ?>
            <div class="mt-4 text-start" style="max-height: 380px; overflow-y: auto; padding-right: 4px;">
                <?php foreach ($wishes as $wish): ?>
                    <div class="bj-wish-item">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="bj-wish-name"><?= htmlspecialchars($wish['name'] ?? ($wish['guest_name'] ?? 'Tamu')) ?></span>
                            <?php 
                                $att = $wish['attendance'] ?? 'attending';
                                $badgeClass = ($att === 'attending') ? 'bg-success text-white' : (($att === 'not_attending') ? 'bg-danger text-white' : 'bg-warning text-dark');
                                $badgeText = ($att === 'attending') ? 'Hadir' : (($att === 'not_attending') ? 'Tidak Hadir' : 'Ragu-ragu');
                            ?>
                            <span class="bj-wish-badge <?= $badgeClass ?>"><?= $badgeText ?></span>
                        </div>
                        <p class="bj-wish-text"><?= nl2br(htmlspecialchars($wish['message'] ?? '')) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- 10. PENUTUP & FOOTER -->
    <footer class="bj-section bj-section-stone text-center pb-5">
        <img src="<?= htmlspecialchars($wayangOrnament) ?>" style="width: 70px;" class="mb-3" alt="Wayang">
        <h2 class="bj-section-title mb-2"><?= htmlspecialchars($coupleTitle) ?></h2>
        <p class="text-white-muted mb-4" style="font-size: 13px; max-width: 85%; margin: 0 auto;">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.
        </p>
        <div style="font-size: 11px; color: #888888;">
            &copy; <?= date('Y') ?> <?= htmlspecialchars(site_name()) ?>. All Rights Reserved.
        </div>
        <div style="height: 60px;"></div>
    </footer>

</div>

<!-- 11. FLOATING SMART DOCK -->
<nav id="bjSmartDock" class="bj-smart-dock">
    <a href="#home" class="bj-dock-btn" onclick="bjSmoothScroll('home', event)">
        <i class="bi bi-house-door-fill"></i>
        <span>Home</span>
    </a>
    <a href="#couple" class="bj-dock-btn" onclick="bjSmoothScroll('couple', event)">
        <i class="bi bi-heart-fill"></i>
        <span>Couple</span>
    </a>
    <a href="#event" class="bj-dock-btn" onclick="bjSmoothScroll('event', event)">
        <i class="bi bi-calendar-event-fill"></i>
        <span>Acara</span>
    </a>
    <?php if (!empty($loveStories)): ?>
    <a href="#story" class="bj-dock-btn" onclick="bjSmoothScroll('story', event)">
        <i class="bi bi-journal-richtext"></i>
        <span>Kisah</span>
    </a>
    <?php endif; ?>
    <?php if (!empty($galleries)): ?>
    <a href="#gallery" class="bj-dock-btn" onclick="bjSmoothScroll('gallery', event)">
        <i class="bi bi-images"></i>
        <span>Galeri</span>
    </a>
    <?php endif; ?>
    <a href="#rsvp" class="bj-dock-btn" onclick="bjSmoothScroll('rsvp', event)">
        <i class="bi bi-chat-heart-fill"></i>
        <span>RSVP</span>
    </a>
    <button type="button" class="bj-dock-btn" id="bjAudioBtn" onclick="bjToggleAudio()">
        <i class="bi bi-disc-fill text-gold fs-5 bj-disc-spin" id="bjAudioIcon"></i>
        <span>Musik</span>
    </button>
    <button type="button" class="bj-dock-btn" id="bjAutoScrollBtn" onclick="bjToggleAutoScroll()">
        <i class="bi bi-chevron-double-down text-gold fs-5" id="bjScrollIcon"></i>
        <span id="bjScrollText">Scroll</span>
    </button>
</nav>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // State
    let bjAudioPlaying = false;
    let bjIsAutoScrolling = false;
    let bjScrollRaf = null;

    // 1. Buka Undangan
    function bjOpenInvitation() {
        const cover = document.getElementById('bjCoverOverlay');
        const dock = document.getElementById('bjSmartDock');
        if (cover) cover.classList.add('opened');
        if (dock) dock.classList.add('is-visible');

        // Play Music
        bjPlayAudio();

        // Smooth Scroll to Top of page
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // 2. Audio Control
    function bjPlayAudio() {
        const audio = document.getElementById('bjAudio');
        const icon = document.getElementById('bjAudioIcon');
        if (!audio) return;

        audio.play().then(() => {
            bjAudioPlaying = true;
            if (icon) {
                icon.className = 'bi bi-disc-fill text-gold fs-5 bj-disc-spin';
            }
        }).catch(() => {
            bjAudioPlaying = false;
            if (icon) {
                icon.className = 'bi bi-pause-circle-fill text-muted fs-5';
            }
        });
    }

    function bjToggleAudio() {
        const audio = document.getElementById('bjAudio');
        const icon = document.getElementById('bjAudioIcon');
        if (!audio) return;

        if (audio.paused) {
            audio.play().then(() => {
                bjAudioPlaying = true;
                if (icon) icon.className = 'bi bi-disc-fill text-gold fs-5 bj-disc-spin';
            });
        } else {
            audio.pause();
            bjAudioPlaying = false;
            if (icon) icon.className = 'bi bi-pause-circle-fill text-muted fs-5';
        }
    }

    // 3. Smooth Scroll Dock
    function bjSmoothScroll(targetId, event) {
        if (event) event.preventDefault();
        const target = document.getElementById(targetId);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // 4. Auto-Scroll Engine (60fps requestAnimationFrame)
    function bjToggleAutoScroll() {
        const icon = document.getElementById('bjScrollIcon');
        const text = document.getElementById('bjScrollText');

        if (bjIsAutoScrolling) {
            bjStopAutoScroll();
            bjShowToast("Auto Scroll Dijeda");
        } else {
            bjIsAutoScrolling = true;
            if (icon) icon.className = 'bi bi-pause-circle-fill text-gold fs-5';
            if (text) text.innerText = 'Jeda';
            bjShowToast("Auto Scroll Berjalan");
            bjRunAutoScroll();
        }
    }

    function bjRunAutoScroll() {
        if (!bjIsAutoScrolling) return;
        const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
        if (window.scrollY >= maxScroll - 4) {
            bjStopAutoScroll();
            bjShowToast("Sampai di akhir undangan");
            return;
        }
        window.scrollBy(0, 1.2);
        bjScrollRaf = requestAnimationFrame(bjRunAutoScroll);
    }

    function bjStopAutoScroll() {
        bjIsAutoScrolling = false;
        if (bjScrollRaf) cancelAnimationFrame(bjScrollRaf);
        const icon = document.getElementById('bjScrollIcon');
        const text = document.getElementById('bjScrollText');
        if (icon) icon.className = 'bi bi-chevron-double-down text-gold fs-5';
        if (text) text.innerText = 'Scroll';
    }

    // Pause Auto-Scroll on manual touch
    window.addEventListener('touchstart', () => {
        if (bjIsAutoScrolling) bjStopAutoScroll();
    }, { passive: true });
    window.addEventListener('wheel', () => {
        if (bjIsAutoScrolling) bjStopAutoScroll();
    }, { passive: true });

    // 5. Toast Notification
    let bjToastTimer = null;
    function bjShowToast(msg) {
        const toast = document.getElementById('bjToast');
        const toastText = document.getElementById('bjToastText');
        if (!toast || !toastText) return;

        toastText.innerText = msg;
        toast.classList.add('show');
        if (bjToastTimer) clearTimeout(bjToastTimer);
        bjToastTimer = setTimeout(() => {
            toast.classList.remove('show');
        }, 2200);
    }

    // 6. Copy Rekening / Text
    function bjCopyText(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                bjShowToast("Nomor rekening berhasil disalin!");
            }).catch(() => {
                bjFallbackCopy(text);
            });
        } else {
            bjFallbackCopy(text);
        }
    }

    function bjFallbackCopy(text) {
        const temp = document.createElement('textarea');
        temp.value = text;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand('copy');
        document.body.removeChild(temp);
        bjShowToast("Berhasil disalin!");
    }

    // 7. Lightbox Preview Modal
    function bjOpenGalleryModal(src) {
        const modalImg = document.getElementById('bjGalleryModalImg');
        if (modalImg) modalImg.src = src;
        const modalEl = document.getElementById('bjGalleryModal');
        if (modalEl) {
            const bsModal = new bootstrap.Modal(modalEl);
            bsModal.show();
        }
    }

    // 8. Countdown Timer
    (function initCountdown() {
        const targetDate = new Date("<?= $eventDateIso ?>").getTime();
        const daysEl = document.getElementById('bjDays');
        const hoursEl = document.getElementById('bjHours');
        const minsEl = document.getElementById('bjMinutes');
        const secsEl = document.getElementById('bjSeconds');

        function update() {
            const now = new Date().getTime();
            const diff = targetDate - now;

            if (diff <= 0) {
                if (daysEl) daysEl.innerText = "00";
                if (hoursEl) hoursEl.innerText = "00";
                if (minsEl) minsEl.innerText = "00";
                if (secsEl) secsEl.innerText = "00";
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const secs = Math.floor((diff % (1000 * 60)) / 1000);

            if (daysEl) daysEl.innerText = String(days).padStart(2, '0');
            if (hoursEl) hoursEl.innerText = String(hours).padStart(2, '0');
            if (minsEl) minsEl.innerText = String(mins).padStart(2, '0');
            if (secsEl) secsEl.innerText = String(secs).padStart(2, '0');
        }

        update();
        setInterval(update, 1000);
    })();
</script>
</body>
</html>
