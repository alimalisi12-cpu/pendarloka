<?php
// views/templates/wedding_premium045.php
// Template: WEDDING PREMIUM045 - Emerald & Blush Romance
// Reconstructed faithfully based on reference share.linkundangan.com/inv-preview/wedding-premium045

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$loveStories = json_decode($event['love_story_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];
$customSchedules = json_decode($event['events_schedule_json'] ?? '[]', true) ?: [];

// Fallback & Demo Data if empty
if (empty($loveStories)) {
    $loveStories = [
        ['year' => '2020', 'title' => 'Awal Bertemu', 'desc' => 'Pertama kali kami dipertemukan dalam sebuah acara kampus dan mulai saling mengenal lebih dekat.', 'story' => 'Pertama kali kami dipertemukan dalam sebuah acara kampus dan mulai saling mengenal lebih dekat.'],
        ['year' => '2022', 'title' => 'Menjalin Komitmen', 'desc' => 'Setelah dua tahun saling memahami, kami memutuskan untuk melangkah bersama dengan niat baik dan tulus.', 'story' => 'Setelah dua tahun saling memahami, kami memutuskan untuk melangkah bersama dengan niat baik dan tulus.'],
        ['year' => '2024', 'title' => 'Menuju Pelaminan', 'desc' => 'Dengan restu kedua orang tua dan keluarga besar, kami memantapkan hati mengikat janji suci pernikahan.', 'story' => 'Dengan restu kedua orang tua dan keluarga besar, kami memantapkan hati mengikat janji suci pernikahan.']
    ];
}

if (empty($galleries)) {
    $galleries = [
        'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&auto=format&fit=crop&q=80'
    ];
}

if (empty($bankAccounts)) {
    $bankAccounts = [
        ['bank' => 'BCA', 'number' => '1234567890', 'owner' => $event['groom_nickname'] ?? 'Muhammad Hamzah'],
        ['bank' => 'Bank Mandiri', 'number' => '9876543210', 'owner' => $event['bride_nickname'] ?? 'Anissa Rahmawati']
    ];
}

// Visual Assets
$assetBase = base_url('assets/templates/wedding_premium045/');
$bgCanvas = $assetBase . 'bg-canvaspinky.jpg';
$frameCover = $assetBase . 'framecover2.png';
$ornamentTop = $assetBase . 'ornament5.png';
$ornamentBottom = $assetBase . 'ornament6.png';

// Fallback images
$groomPhoto = !empty($event['groom_photo']) ? media_url($event['groom_photo']) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80';
$bridePhoto = !empty($event['bride_photo']) ? media_url($event['bride_photo']) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=600&auto=format&fit=crop&q=80';
$coverPhoto = !empty($event['cover_photo']) ? media_url($event['cover_photo']) : $galleries[0];

// Couple initials
$gNick = !empty($event['groom_nickname']) ? trim($event['groom_nickname']) : 'Hamzah';
$bNick = !empty($event['bride_nickname']) ? trim($event['bride_nickname']) : 'Anissa';
$initGroom = strtoupper(substr($gNick, 0, 1));
$initBride = strtoupper(substr($bNick, 0, 1));

// Guest Name from query param (?to= or ?kpd=)
$guestDisplayName = !empty($guestName) ? $guestName : 'Tamu Undangan';

// Theme Config & Customizer Studio
$themeConfig = ThemeCatalog::parseConfig($event['theme_config_json'] ?? '');
$cfgColors = $themeConfig['colors'] ?? [];
$cfgTypo = $themeConfig['typography'] ?? [];
$cfgOrn = $themeConfig['ornaments'] ?? [];
$cfgFx = $themeConfig['effects'] ?? [];

// Music URL
$musicUrl = !empty($event['music_url']) ? media_url($event['music_url']) : 'https://cdn.freesound.org/previews/469/469009_9518146-lq.mp3';

// Event Date & Time
$eventDateTimestamp = strtotime($event['event_date'] ?? '+30 days');
$eventDateFormatted = date('d F Y', $eventDateTimestamp);
$eventIsoDate = date('Y-m-d', $eventDateTimestamp);

$akadTime = !empty($event['akad_time']) ? $event['akad_time'] : '08.00 - 10.00 WIB';
$akadLocation = !empty($event['akad_location']) ? $event['akad_location'] : 'Masjid Agung Al-Ikhlas, Jl. Merdeka No. 45';
$resepsiTime = !empty($event['resepsi_time']) ? $event['resepsi_time'] : '11.00 - 14.00 WIB';
$resepsiLocation = !empty($event['resepsi_location']) ? $event['resepsi_location'] : 'Grand Ballroom Hotel Aston, Jl. Sudirman Kav. 12';
$mapsUrl = !empty($event['maps_url']) ? $event['maps_url'] : 'https://maps.google.com';
$mapsEmbed = !empty($event['maps_embed']) ? $event['maps_embed'] : '';
$quote = !empty($event['quote']) ? $event['quote'] : 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. (QS. Ar-Rum: 21)';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['title'] ?? 'The Wedding of ' . $bNick . ' & ' . $gNick) ?></title>

    <!-- Dynamic Favicon -->
    <?php $favUrl = site_favicon_url(); ?>
    <link rel="icon" href="<?= !empty($favUrl) ? htmlspecialchars($favUrl) : 'https://cdn-icons-png.flaticon.com/512/833/833472.png' ?>" type="image/png">

    <!-- OpenGraph Metadata -->
    <meta property="og:title" content="<?= htmlspecialchars($event['title'] ?? 'The Wedding of ' . $bNick . ' & ' . $gNick) ?>">
    <meta property="og:description" content="Undangan Pernikahan <?= htmlspecialchars($bNick) ?> &amp; <?= htmlspecialchars($gNick) ?>. Spesial untuk <?= htmlspecialchars($guestDisplayName) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($coverPhoto) ?>">

    <?= ThemeCatalog::renderGoogleFontsTags($cfgTypo) ?>
    <!-- Google Fonts Referensi: Abril Fatface, Marcellus, DM Sans, Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Alex+Brush&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Marcellus&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- AOS (Animate on Scroll) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primaryColor: <?= $cfgColors['primary'] ?? '#064346' ?>;
            --primaryDark: <?= $cfgColors['accent'] ?? '#042E30' ?>;
            --primaryLight: <?= $cfgColors['primary'] ?? '#0C5D61' ?>;
            --secondaryColor: <?= $cfgColors['secondary'] ?? '#bf9e9e' ?>;
            --accentRose: <?= $cfgColors['secondary'] ?? '#8a6d71' ?>;
            --accentTerracotta: <?= $cfgColors['accent'] ?? '#472b29' ?>;
            --bgCanvas: <?= $cfgColors['bg_body'] ?? '#f5eee1' ?>;
            --cardBg: <?= $cfgColors['bg_card'] ?? '#ffffff' ?>;
            --cardRadius: 20px;
        }

        <?php if (!empty($cfgTypo['font_heading'])): ?>
        .ff-marcellus, .ff-abril, .font-heading {
            font-family: '<?= $cfgTypo['font_heading'] ?>', serif !important;
        }
        <?php endif; ?>
        <?php if (!empty($cfgTypo['font_body'])): ?>
        body, .ff-dmsans {
            font-family: '<?= $cfgTypo['font_body'] ?>', sans-serif !important;
        }
        <?php endif; ?>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'DM Sans', 'Plus Jakarta Sans', sans-serif;
            color: #0c4643;
            background-color: var(--bgCanvas);
            background-image: url('<?= $bgCanvas ?>');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .ff-abril { font-family: 'Abril Fatface', serif; }
        .ff-marcellus { font-family: 'Marcellus', serif; }
        .ff-alex { font-family: 'Alex Brush', cursive; }
        .ff-playfair { font-family: 'Playfair Display', serif; }
        .ff-dmsans { font-family: 'DM Sans', sans-serif; }

        /* Outer Frame & Container */
        .app-container {
            max-width: 650px;
            margin: 0 auto;
            position: relative;
            background: rgba(245, 238, 225, 0.94);
            box-shadow: 0 0 30px rgba(0,0,0,0.12);
            min-height: 100vh;
            padding-bottom: 95px;
        }

        /* Top & Bottom Floral Ornaments */
        .ornament-header {
            width: 100%;
            height: 90px;
            background-image: url('<?= $ornamentTop ?>');
            background-size: contain;
            background-repeat: repeat-x;
            background-position: center top;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
            pointer-events: none;
            opacity: 0.85;
        }

        .ornament-divider {
            max-width: 200px;
            margin: 20px auto;
            opacity: 0.7;
            filter: hue-rotate(140deg);
        }

        /* Cover Modal (Opening Screen) */
        #coverModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(245, 238, 225, 0.98);
            background-image: url('<?= $bgCanvas ?>');
            background-size: cover;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.8s ease, visibility 0.8s ease;
        }

        #coverModal.hide {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .cover-card {
            max-width: 480px;
            width: 90%;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .cover-arch {
            position: relative;
            width: 250px;
            margin: 0 auto 20px auto;
        }

        .cover-arch img.frame {
            width: 100%;
            display: block;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.15));
        }

        .cover-initials {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--accentRose);
            text-shadow: 1px 1px 2px rgba(255,255,255,0.8);
            z-index: 10;
        }

        .btn-open-invitation {
            background-color: var(--primaryColor);
            color: #ffffff;
            border: none;
            border-radius: 50px;
            padding: 12px 35px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 20px rgba(6, 67, 70, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-open-invitation:hover {
            background-color: var(--primaryDark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(6, 67, 70, 0.4);
        }

        /* Section Sheets */
        .sheet {
            padding: 70px 20px 40px 20px;
            position: relative;
        }

        .sheet-card {
            background: #ffffff;
            border-radius: var(--cardRadius);
            padding: 35px 25px;
            box-shadow: 0 10px 30px rgba(71, 43, 41, 0.06);
            border: 1px solid rgba(191, 158, 158, 0.25);
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .sheet-title {
            color: var(--primaryColor);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: center;
        }

        .sheet-subtitle {
            color: var(--accentRose);
            font-size: 14px;
            text-align: center;
            margin-bottom: 25px;
            font-style: italic;
        }

        /* Hero / Cover Section (#nav-cover) */
        .hero-photo-wrapper {
            position: relative;
            width: 220px;
            height: 290px;
            margin: 0 auto 25px auto;
            border-radius: 120px 120px 20px 20px;
            overflow: hidden;
            border: 5px solid #ffffff;
            box-shadow: 0 12px 28px rgba(0,0,0,0.15);
        }

        .hero-photo-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-names {
            font-family: 'Abril Fatface', serif;
            font-size: 38px;
            color: var(--primaryColor);
            margin: 10px 0;
            line-height: 1.2;
            text-align: center;
        }

        .hero-ampersand {
            font-family: 'Marcellus', serif;
            font-size: 26px;
            color: var(--accentRose);
        }

        /* Countdown Timer */
        .countdown-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 25px 0;
        }

        .countdown-box {
            width: 68px;
            height: 68px;
            background: var(--primaryColor);
            color: #ffffff;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 15px rgba(6, 67, 70, 0.25);
            transition: transform 0.3s ease;
        }

        .countdown-box .number {
            font-size: 22px;
            font-weight: 700;
            line-height: 1;
        }

        .countdown-box .label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.85;
            margin-top: 3px;
        }

        /* Couple Section (#nav-perihal) */
        .couple-card {
            text-align: center;
            margin-bottom: 30px;
        }

        .couple-photo-frame {
            width: 170px;
            height: 170px;
            border-radius: 50%;
            margin: 0 auto 18px auto;
            padding: 6px;
            border: 2px dashed var(--primaryColor);
            position: relative;
        }

        .couple-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .couple-name {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--primaryColor);
            margin-bottom: 5px;
        }

        .couple-parents {
            font-size: 13px;
            color: #555;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .btn-instagram {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            color: #ffffff !important;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        /* Event Schedules (#nav-acara) */
        .event-card {
            background: #ffffff;
            border: 1px solid rgba(6, 67, 70, 0.15);
            border-radius: 18px;
            padding: 25px 20px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            box-shadow: 0 8px 20px rgba(0,0,0,0.04);
        }

        .event-badge {
            display: inline-block;
            background: rgba(6, 67, 70, 0.1);
            color: var(--primaryColor);
            font-weight: 700;
            font-size: 16px;
            padding: 6px 18px;
            border-radius: 30px;
            margin-bottom: 15px;
        }

        .event-time {
            font-size: 14px;
            color: var(--accentRose);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .event-venue {
            font-weight: 700;
            font-size: 17px;
            color: var(--primaryDark);
            margin-bottom: 4px;
        }

        .event-address {
            font-size: 13px;
            color: #666;
            line-height: 1.4;
            margin-bottom: 18px;
        }

        .btn-custom-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primaryColor);
            color: #ffffff !important;
            border-radius: 30px;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(6, 67, 70, 0.2);
            transition: all 0.3s ease;
        }

        .btn-custom-action:hover {
            background: var(--primaryDark);
            transform: translateY(-2px);
        }

        .btn-outline-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--primaryColor) !important;
            border: 1px solid var(--primaryColor);
            border-radius: 30px;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-outline-action:hover {
            background: rgba(6, 67, 70, 0.08);
        }

        /* Love Story (#nav-cerita) */
        .story-timeline {
            position: relative;
            padding-left: 30px;
        }

        .story-timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 10px;
            bottom: 10px;
            width: 2px;
            background: var(--primaryColor);
            opacity: 0.3;
        }

        .story-item {
            position: relative;
            margin-bottom: 25px;
        }

        .story-dot {
            position: absolute;
            left: -30px;
            top: 4px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--primaryColor);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            box-shadow: 0 0 0 4px rgba(6, 67, 70, 0.15);
        }

        .story-box {
            background: #ffffff;
            border: 1px dashed rgba(6, 67, 70, 0.3);
            border-radius: 16px;
            padding: 16px 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .story-year {
            font-weight: 700;
            color: var(--primaryColor);
            font-size: 15px;
            margin-bottom: 4px;
        }

        .story-title {
            font-weight: 600;
            font-size: 14px;
            color: #333;
            margin-bottom: 6px;
        }

        .story-desc {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
            margin: 0;
        }

        /* Gallery Grid (#nav-galeri) */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .gallery-item {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            aspect-ratio: 1/1;
            cursor: pointer;
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        /* Video Responsive Embed */
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Guestbook & RSVP (#nav-tamu) */
        .wishes-list {
            max-height: 380px;
            overflow-y: auto;
            padding-right: 5px;
            margin-top: 20px;
        }

        .wish-bubble {
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.02);
        }

        .wish-author {
            font-weight: 700;
            color: var(--primaryColor);
            font-size: 14px;
        }

        .wish-badge {
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 12px;
            margin-left: 6px;
        }

        .wish-time {
            font-size: 11px;
            color: #999;
            margin: 4px 0 8px 0;
        }

        .wish-text {
            font-size: 13px;
            color: #444;
            line-height: 1.4;
            margin: 0;
        }

        /* Digital Gift (#nav-lainnya) */
        .bank-card {
            background: linear-gradient(135deg, #064346 0%, #0a5f64 100%);
            color: #ffffff;
            border-radius: 18px;
            padding: 22px 20px;
            margin-bottom: 16px;
            box-shadow: 0 8px 22px rgba(6, 67, 70, 0.25);
            position: relative;
            overflow: hidden;
        }

        .bank-card::before {
            content: '';
            position: absolute;
            right: -20px;
            top: -20px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .btn-copy {
            background: #ffffff;
            color: var(--primaryColor);
            border: none;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-copy:hover {
            background: #eef5f5;
        }

        /* Floating Controls */
        .floating-audio-btn {
            position: fixed;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #ffffff;
            color: var(--primaryColor);
            box-shadow: 0 4px 15px rgba(0,0,0,0.18);
            border: 2px solid var(--primaryColor);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
            transition: all 0.3s ease;
        }

        .floating-audio-btn.spinning {
            animation: spinMusic 3.5s linear infinite;
        }

        @keyframes spinMusic {
            100% { transform: translateY(-50%) rotate(360deg); }
        }

        .floating-autoscroll-btn {
            position: fixed;
            right: 18px;
            top: calc(50% + 54px);
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ffffff;
            color: var(--accentRose);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
        }

        .floating-autoscroll-btn.active {
            background: var(--primaryColor);
            color: #ffffff;
            border-color: var(--primaryColor);
        }

        /* Bottom Floating Navigation Dock (.navmenu) */
        .bottom-nav-dock {
            position: fixed;
            bottom: -90px;
            left: 50%;
            transform: translateX(-50%);
            width: 95%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(10px);
            border-radius: 35px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border: 1px solid rgba(255, 255, 255, 0.8);
            padding: 6px 10px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 998;
            transition: bottom 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .bottom-nav-dock.show {
            bottom: 15px;
        }

        .nav-dock-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            border-radius: 25px;
            color: #666;
            text-decoration: none;
            font-size: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            background: transparent;
        }

        .nav-dock-item svg, .nav-dock-item i {
            font-size: 18px;
            margin-bottom: 2px;
            transition: transform 0.2s ease;
        }

        .nav-dock-item span {
            display: none;
        }

        .nav-dock-item.active {
            background: var(--bgCanvas);
            color: var(--primaryColor);
            padding: 6px 14px;
            box-shadow: 0 2px 8px rgba(6, 67, 70, 0.1);
        }

        .nav-dock-item.active span {
            display: inline;
        }

        .nav-dock-item.active svg, .nav-dock-item.active i {
            transform: translateY(-1px);
        }

        /* Modal Lightbox for Gallery */
        #galleryModal img {
            max-height: 85vh;
            width: auto;
            max-width: 100%;
            border-radius: 12px;
            display: block;
            margin: 0 auto;
        }

        /* Custom Toast notification */
        .copy-toast {
            position: fixed;
            bottom: 85px;
            left: 50%;
            transform: translateX(-50%);
            background: #17242A;
            color: #ffffff;
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 13px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.25);
            z-index: 99999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .copy-toast.show {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-5px);
        }
    </style>
</head>
<body>

    <!-- Audio Element -->
    <audio id="weddingAudio" loop preload="auto">
        <source src="<?= htmlspecialchars($musicUrl) ?>" type="audio/mpeg">
    </audio>

    <!-- Floating Audio Control -->
    <button type="button" class="floating-audio-btn spinning" id="btnAudioToggle" title="Nyalakan / Matikan Musik" aria-label="Audio Toggle">
        <i class="bi bi-disc-fill fs-5" id="audioIcon"></i>
    </button>

    <!-- Floating Auto-Scroll Control -->
    <button type="button" class="floating-autoscroll-btn" id="btnAutoScroll" title="Scroll Otomatis" aria-label="Auto Scroll">
        <i class="bi bi-play-circle fs-5" id="autoScrollIcon"></i>
    </button>

    <!-- COVER MODAL (Opening Screen) -->
    <div id="coverModal">
        <div class="cover-card" data-aos="fade-up" data-aos-duration="1000">
            <span class="ff-alex display-6 mb-2 d-block" style="color: var(--accentRose);">The Wedding Of</span>

            <div class="cover-arch">
                <img src="<?= $frameCover ?>" alt="Frame Arch Cover" class="frame">
                <div class="cover-initials">
                    <div class="ff-abril display-3 lh-1 mb-0"><?= $initBride ?></div>
                    <div class="ff-marcellus fs-2" style="color: var(--primaryColor);">&amp;</div>
                    <div class="ff-abril display-3 lh-1 mb-0"><?= $initGroom ?></div>
                </div>
            </div>

            <p class="ff-abril fs-4 text-dark mb-1">Kepada Yth.</p>
            <p class="small text-muted mb-2">Bapak/Ibu/Saudara/i</p>
            
            <div class="p-2.5 px-4 rounded-3 d-inline-block mb-4 shadow-sm" style="background: rgba(255,255,255,0.85); border: 1px solid rgba(191,158,158,0.3);">
                <h5 class="fw-bold m-0" style="color: var(--primaryColor);"><?= htmlspecialchars($guestDisplayName) ?></h5>
            </div>

            <div>
                <button type="button" class="btn-open-invitation" id="btnOpenInvitation">
                    <i class="bi bi-envelope-open-heart-fill fs-5"></i>
                    Buka Undangan
                </button>
            </div>
        </div>
    </div>

    <!-- MAIN APP CONTAINER -->
    <div class="app-container">
        <!-- Top Ornament -->
        <div class="ornament-header"></div>

        <!-- 1. HERO / COVER SECTION (#nav-cover) -->
        <section class="sheet" id="nav-cover">
            <div class="sheet-card text-center" data-aos="fade-up">
                <span class="ff-alex fs-3 d-block" style="color: var(--accentRose);">The Wedding Of</span>
                
                <div class="hero-photo-wrapper my-3">
                    <img src="<?= htmlspecialchars($coverPhoto) ?>" alt="Cover Photo">
                </div>

                <h1 class="hero-names">
                    <span><?= htmlspecialchars($bNick) ?></span>
                    <span class="hero-ampersand">&amp;</span>
                    <span><?= htmlspecialchars($gNick) ?></span>
                </h1>

                <p class="fw-semibold text-uppercase letter-spacing-2 mt-2 mb-4" style="color: var(--primaryColor); font-size: 14px;">
                    <i class="bi bi-calendar2-heart me-1"></i> <?= $eventDateFormatted ?>
                </p>

                <!-- Countdown Timer -->
                <div class="countdown-container" id="countdownClock" data-date="<?= $eventIsoDate ?>">
                    <div class="countdown-box">
                        <span class="number" id="countDays">00</span>
                        <span class="label">Hari</span>
                    </div>
                    <div class="countdown-box">
                        <span class="number" id="countHours">00</span>
                        <span class="label">Jam</span>
                    </div>
                    <div class="countdown-box">
                        <span class="number" id="countMins">00</span>
                        <span class="label">Menit</span>
                    </div>
                    <div class="countdown-box">
                        <span class="number" id="countSecs">00</span>
                        <span class="label">Detik</span>
                    </div>
                </div>

                <!-- Ayat / Quote -->
                <div class="p-3 rounded-4 mt-4" style="background: rgba(245, 238, 225, 0.6); border: 1px dashed rgba(6, 67, 70, 0.2);">
                    <i class="bi bi-quote fs-2 d-block" style="color: var(--primaryColor); line-height: 1;"></i>
                    <p class="small text-muted mb-0 fst-italic" style="line-height: 1.6;">
                        <?= htmlspecialchars($quote) ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- 2. MEMPELAI SECTION (#nav-perihal) -->
        <section class="sheet" id="nav-perihal">
            <div class="sheet-card" data-aos="fade-up">
                <div class="text-center mb-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/27/Basmala.svg" alt="Basmalah" style="height: 38px; filter: invert(21%) sepia(34%) saturate(1577%) hue-rotate(139deg) brightness(93%) contrast(96%);" class="mb-3">
                    <h2 class="sheet-title">Mempelai Bahagia</h2>
                    <p class="sheet-subtitle">Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud melangsungkan pernikahan kami:</p>
                </div>

                <!-- Pengantin Wanita -->
                <div class="couple-card" data-aos="zoom-in">
                    <div class="couple-photo-frame">
                        <img src="<?= htmlspecialchars($bridePhoto) ?>" alt="Pengantin Wanita">
                    </div>
                    <h3 class="couple-name"><?= htmlspecialchars($event['bride_name'] ?? 'Anissa Rahmawati, S.Ked') ?></h3>
                    <p class="couple-parents">
                        Putri tercinta dari:<br>
                        <strong><?= htmlspecialchars($event['bride_parents'] ?? 'Bpk. Ir. H. Bambang Suherman & Ibu Hj. Siti Aminah') ?></strong>
                    </p>
                    <?php if (!empty($event['bride_instagram'])): ?>
                        <a href="https://instagram.com/<?= ltrim($event['bride_instagram'], '@') ?>" target="_blank" class="btn-instagram">
                            <i class="bi bi-instagram"></i> <?= htmlspecialchars($event['bride_instagram']) ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Divider & -->
                <div class="text-center my-3">
                    <span class="ff-alex display-4" style="color: var(--primaryColor);">&amp;</span>
                </div>

                <!-- Pengantin Pria -->
                <div class="couple-card" data-aos="zoom-in">
                    <div class="couple-photo-frame">
                        <img src="<?= htmlspecialchars($groomPhoto) ?>" alt="Pengantin Pria">
                    </div>
                    <h3 class="couple-name"><?= htmlspecialchars($event['groom_name'] ?? 'Muhammad Hamzah, S.T.') ?></h3>
                    <p class="couple-parents">
                        Putra tercinta dari:<br>
                        <strong><?= htmlspecialchars($event['groom_parents'] ?? 'Bpk. Drs. H. Ahmad Fauzi & Ibu Hj. Nurul Hidayah') ?></strong>
                    </p>
                    <?php if (!empty($event['groom_instagram'])): ?>
                        <a href="https://instagram.com/<?= ltrim($event['groom_instagram'], '@') ?>" target="_blank" class="btn-instagram">
                            <i class="bi bi-instagram"></i> <?= htmlspecialchars($event['groom_instagram']) ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- 3. ACARA SECTION (#nav-acara) -->
        <section class="sheet" id="nav-acara">
            <div class="sheet-card" data-aos="fade-up">
                <h2 class="sheet-title">Rangkaian Acara</h2>
                <p class="sheet-subtitle">Waktu dan tempat pelaksanaan akad nikah &amp; resepsi pernikahan:</p>

                <!-- Akad Nikah -->
                <div class="event-card" data-aos="fade-up" data-aos-delay="100">
                    <span class="event-badge"><i class="bi bi-heart-fill me-1"></i> Akad Nikah</span>
                    <div class="event-time">
                        <i class="bi bi-calendar3 me-1"></i> <?= $eventDateFormatted ?><br>
                        <i class="bi bi-clock me-1"></i> <?= htmlspecialchars($akadTime) ?>
                    </div>
                    <div class="event-venue"><?= htmlspecialchars($akadLocation) ?></div>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="<?= htmlspecialchars($mapsUrl) ?>" target="_blank" class="btn-custom-action">
                            <i class="bi bi-geo-alt-fill"></i> Google Maps
                        </a>
                        <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?= urlencode('Akad Nikah ' . $bNick . ' & ' . $gNick) ?>&dates=<?= date('Ymd', $eventDateTimestamp) ?>/<?= date('Ymd', $eventDateTimestamp) ?>&details=<?= urlencode('Pernikahan ' . $bNick . ' & ' . $gNick) ?>&location=<?= urlencode($akadLocation) ?>" target="_blank" class="btn-outline-action">
                            <i class="bi bi-calendar-plus"></i> Kalender
                        </a>
                    </div>
                </div>

                <!-- Resepsi Pernikahan -->
                <div class="event-card" data-aos="fade-up" data-aos-delay="200">
                    <span class="event-badge"><i class="bi bi-flower1 me-1"></i> Resepsi Pernikahan</span>
                    <div class="event-time">
                        <i class="bi bi-calendar3 me-1"></i> <?= $eventDateFormatted ?><br>
                        <i class="bi bi-clock me-1"></i> <?= htmlspecialchars($resepsiTime) ?>
                    </div>
                    <div class="event-venue"><?= htmlspecialchars($resepsiLocation) ?></div>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="<?= htmlspecialchars($mapsUrl) ?>" target="_blank" class="btn-custom-action">
                            <i class="bi bi-geo-alt-fill"></i> Google Maps
                        </a>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <?php if (!empty($mapsEmbed)): ?>
                    <div class="rounded-4 overflow-hidden shadow-sm mt-3 border">
                        <?= $mapsEmbed ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- 4. LOVE STORY SECTION (#nav-cerita) -->
        <section class="sheet" id="nav-cerita">
            <div class="sheet-card" data-aos="fade-up">
                <h2 class="sheet-title">Kisah Cinta Kami</h2>
                <p class="sheet-subtitle">Perjalanan indah bagaimana cinta kami bertumbuh hingga pelaminan:</p>

                <div class="story-timeline">
                    <?php foreach ($loveStories as $story): ?>
                        <div class="story-item" data-aos="fade-left">
                            <div class="story-dot"><i class="bi bi-heart-fill"></i></div>
                            <div class="story-box">
                                <div class="story-year"><?= htmlspecialchars($story['year'] ?? '') ?></div>
                                <div class="story-title"><?= htmlspecialchars($story['title'] ?? '') ?></div>
                                <p class="story-desc"><?= htmlspecialchars($story['desc'] ?? ($story['story'] ?? '')) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Harapan Pasangan -->
                <div class="row g-3 mt-4">
                    <div class="col-12 col-md-6" data-aos="zoom-in">
                        <div class="p-3 rounded-4 h-100" style="background: rgba(6, 67, 70, 0.05); border: 1px solid rgba(6, 67, 70, 0.15);">
                            <h6 class="fw-bold mb-2" style="color: var(--primaryColor);"><i class="bi bi-chat-quote-fill me-1"></i> Harapan Pengantin Pria</h6>
                            <p class="small text-muted mb-0 fst-italic">
                                "Semoga langkah kita senantiasa diberkahi, menjadi keluarga sakinah, mawaddah, warahmah, dan saling melengkapi hingga akhir hayat."
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="p-3 rounded-4 h-100" style="background: rgba(191, 158, 158, 0.12); border: 1px solid rgba(191, 158, 158, 0.3);">
                            <h6 class="fw-bold mb-2" style="color: var(--accentRose);"><i class="bi bi-chat-heart-fill me-1"></i> Harapan Pengantin Wanita</h6>
                            <p class="small text-muted mb-0 fst-italic">
                                "Terima kasih telah memilihku. Bersamamu, aku siap menyongsong masa depan yang penuh cinta, kehangatan, dan ketulusan."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. GALERI SECTION (#nav-galeri) -->
        <section class="sheet" id="nav-galeri">
            <div class="sheet-card" data-aos="fade-up">
                <h2 class="sheet-title">Galeri Prewedding</h2>
                <p class="sheet-subtitle">Momen bahagia yang terabadikan dalam kenangan terindah:</p>

                <div class="gallery-grid">
                    <?php foreach ($galleries as $idx => $photo): ?>
                        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="<?= $idx * 80 ?>" onclick="openGalleryModal('<?= htmlspecialchars(media_url($photo)) ?>')">
                            <img src="<?= htmlspecialchars(media_url($photo)) ?>" alt="Foto Prewedding <?= $idx + 1 ?>" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Video Story -->
                <div class="mt-4 pt-2">
                    <h5 class="fw-bold text-center mb-3" style="color: var(--primaryColor); font-size: 18px;">
                        <i class="bi bi-play-circle-fill me-1"></i> Our Video Story
                    </h5>
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?controls=1&rel=0" title="Wedding Video Story" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. BUKU TAMU & RSVP SECTION (#nav-tamu) -->
        <section class="sheet" id="nav-tamu">
            <div class="sheet-card" data-aos="fade-up">
                <h2 class="sheet-title">Buku Tamu &amp; RSVP</h2>
                <p class="sheet-subtitle">Mohon konfirmasi kehadiran dan berikan doa restu Anda kepada kami:</p>

                <!-- Form RSVP -->
                <form id="rsvpForm" action="<?= base_url('u/' . ($event['slug'] ?? 'demo') . '/rsvp') ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Nama Lengkap Anda</label>
                        <input type="text" name="guest_name" id="rsvpGuestName" class="form-control rounded-3" value="<?= htmlspecialchars($guestDisplayName !== 'Tamu Undangan' ? $guestDisplayName : '') ?>" placeholder="Masukkan nama Anda" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-7">
                            <label class="form-label small fw-bold text-secondary">Konfirmasi Kehadiran</label>
                            <select name="attendance" id="rsvpAttendance" class="form-select rounded-3" required>
                                <option value="attending">Hadir</option>
                                <option value="not_attending">Berhalangan Hadir</option>
                                <option value="uncertain">Masih Ragu-ragu</option>
                            </select>
                        </div>
                        <div class="col-5">
                            <label class="form-label small fw-bold text-secondary">Jumlah Tamu</label>
                            <select name="pax" id="rsvpPax" class="form-select rounded-3">
                                <option value="1">1 Orang</option>
                                <option value="2" selected>2 Orang</option>
                                <option value="3">3 Orang</option>
                                <option value="4">4 Orang</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Ucapan &amp; Doa Restu</label>
                        <textarea name="message" id="rsvpMessage" class="form-control rounded-3" rows="3" placeholder="Tuliskan ucapan selamat dan doa untuk kedua mempelai..." required></textarea>
                    </div>

                    <button type="submit" id="btnSubmitRsvp" class="btn-custom-action w-100 justify-content-center py-2.5">
                        <i class="bi bi-send-fill"></i> Kirim Konfirmasi &amp; Doa
                    </button>
                </form>

                <!-- Daftar Ucapan Tamu -->
                <div class="wishes-list" id="wishesContainer">
                    <?php if (!empty($wishes)): ?>
                        <?php foreach ($wishes as $w): ?>
                            <div class="wish-bubble">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="wish-author"><?= htmlspecialchars($w['guest_name'] ?? ($w['name'] ?? 'Tamu')) ?></span>
                                    <span class="wish-badge <?= ($w['attendance'] ?? '') === 'attending' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' ?>">
                                        <?= ($w['attendance'] ?? '') === 'attending' ? 'Hadir' : 'Tidak Hadir' ?>
                                    </span>
                                </div>
                                <div class="wish-time"><?= date('d M Y, H:i', strtotime($w['created_at'] ?? 'now')) ?> WIB</div>
                                <p class="wish-text"><?= nl2br(htmlspecialchars($w['message'] ?? '')) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center text-muted py-4 small fst-italic" id="emptyWishesNotice">
                            Belum ada ucapan doa. Jadilah yang pertama memberikan doa restu!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- 7. KADO DIGITAL & PENUTUP (#nav-lainnya) -->
        <section class="sheet" id="nav-lainnya">
            <div class="sheet-card" data-aos="fade-up">
                <h2 class="sheet-title">Tanda Kasih Digital</h2>
                <p class="sheet-subtitle">Doa restu Anda merupakan karunia terindah bagi kami. Bagi yang ingin memberikan tanda kasih secara digital:</p>

                <?php foreach ($bankAccounts as $acc): ?>
                    <div class="bank-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold fs-5 tracking-wide"><?= htmlspecialchars($acc['bank'] ?? 'Bank') ?></span>
                            <i class="bi bi-credit-card-2-front fs-4 opacity-75"></i>
                        </div>
                        <div class="fs-4 fw-bold font-monospace mb-1" id="accNumber_<?= md5($acc['number'] ?? '') ?>"><?= htmlspecialchars($acc['number'] ?? '') ?></div>
                        <div class="small opacity-75 mb-3">a.n. <?= htmlspecialchars($acc['owner'] ?? ($acc['holder'] ?? '')) ?></div>
                        <button type="button" class="btn-copy" onclick="copyToClipboard('<?= htmlspecialchars($acc['number'] ?? '') ?>', 'Nomor Rekening <?= htmlspecialchars($acc['bank'] ?? '') ?>')">
                            <i class="bi bi-clipboard me-1"></i> Salin Nomor Rekening
                        </button>
                    </div>
                <?php endforeach; ?>

                <?php if (!empty($event['gift_address'])): ?>
                    <!-- Kado Fisik -->
                    <div class="p-3 rounded-4 mt-3" style="background: rgba(6, 67, 70, 0.04); border: 1px dashed rgba(6, 67, 70, 0.2);">
                        <h6 class="fw-bold mb-1" style="color: var(--primaryColor);"><i class="bi bi-gift-fill me-1"></i> Kirim Kado Fisik</h6>
                        <p class="small text-muted mb-2"><?= nl2br(htmlspecialchars($event['gift_address'])) ?></p>
                        <button type="button" class="btn-copy" onclick="copyToClipboard('<?= htmlspecialchars(str_replace("\n", " ", $event['gift_address'])) ?>', 'Alamat Kado')">
                            <i class="bi bi-clipboard me-1"></i> Salin Alamat
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Protokol Kesehatan -->
                <div class="p-3 rounded-4 mt-4" style="background: #faf7f2; border: 1px solid rgba(0,0,0,0.06);">
                    <h6 class="fw-bold text-center mb-3" style="color: var(--primaryColor); font-size: 14px;">
                        <i class="bi bi-shield-check text-success me-1"></i> Himbauan Protokol Kesehatan
                    </h6>
                    <div class="d-flex justify-content-around text-center small text-muted">
                        <div><i class="bi bi-virus fs-3 d-block text-secondary mb-1"></i>Cuci Tangan</div>
                        <div><i class="bi bi-people fs-3 d-block text-secondary mb-1"></i>Jaga Jarak</div>
                        <div><i class="bi bi-person-check fs-3 d-block text-secondary mb-1"></i>Kondisi Sehat</div>
                    </div>
                </div>

                <!-- Ucapan Terima Kasih -->
                <div class="text-center mt-5">
                    <p class="small text-muted mb-3">
                        Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.
                    </p>
                    <span class="ff-alex display-5 d-block" style="color: var(--accentRose);">Terima Kasih</span>
                    <h4 class="ff-abril mt-2 mb-4" style="color: var(--primaryColor);">
                        <?= htmlspecialchars($bNick) ?> &amp; <?= htmlspecialchars($gNick) ?>
                    </h4>
                    <small class="text-muted" style="font-size: 11px;">Powered by <b><?= APP_NAME ?></b></small>
                </div>
            </div>
        </section>
    </div>

    <!-- BOTTOM FLOATING NAVIGATION BAR (.navmenu) -->
    <nav class="bottom-nav-dock" id="bottomNavDock">
        <button class="nav-dock-item active" data-target="#nav-cover" title="Sampul">
            <i class="bi bi-house-heart"></i>
            <span>Sampul</span>
        </button>
        <button class="nav-dock-item" data-target="#nav-perihal" title="Mempelai">
            <i class="bi bi-people"></i>
            <span>Mempelai</span>
        </button>
        <button class="nav-dock-item" data-target="#nav-acara" title="Acara">
            <i class="bi bi-calendar-event"></i>
            <span>Acara</span>
        </button>
        <button class="nav-dock-item" data-target="#nav-cerita" title="Cerita">
            <i class="bi bi-journal-bookmark-fill"></i>
            <span>Cerita</span>
        </button>
        <button class="nav-dock-item" data-target="#nav-galeri" title="Galeri">
            <i class="bi bi-images"></i>
            <span>Galeri</span>
        </button>
        <button class="nav-dock-item" data-target="#nav-tamu" title="Buku Tamu">
            <i class="bi bi-chat-quote"></i>
            <span>Ucapan</span>
        </button>
        <button class="nav-dock-item" data-target="#nav-lainnya" title="Kado">
            <i class="bi bi-gift"></i>
            <span>Kado</span>
        </button>
    </nav>

    <!-- LIGHTBOX MODAL UNTUK GALERI -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 position-relative text-center">
                    <button type="button" class="btn btn-close btn-close-white position-absolute top-0 end-0 m-3 shadow" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10;"></button>
                    <img id="galleryModalImg" src="" alt="Zoom Foto Prewedding" class="img-fluid shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <!-- COPY TOAST NOTIFICATION -->
    <div class="copy-toast" id="copyToast">
        <i class="bi bi-check-circle-fill text-success me-1.5"></i>
        <span id="copyToastText">Tersalin ke papan klip!</span>
    </div>

    <!-- Bootstrap 5 JS Bundle & AOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        // Inisialisasi AOS Animation
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        // Audio & Music Controller
        const audio = document.getElementById('weddingAudio');
        const btnAudio = document.getElementById('btnAudioToggle');
        const audioIcon = document.getElementById('audioIcon');
        let isAudioPlaying = false;

        function playMusic() {
            if (audio) {
                audio.play().then(() => {
                    isAudioPlaying = true;
                    btnAudio.classList.add('spinning');
                    audioIcon.className = 'bi bi-disc-fill fs-5';
                }).catch(err => {
                    console.log('Autoplay dicegah browser, klik tombol untuk memutar.');
                });
            }
        }

        function pauseMusic() {
            if (audio) {
                audio.pause();
                isAudioPlaying = false;
                btnAudio.classList.remove('spinning');
                audioIcon.className = 'bi bi-pause-circle fs-5';
            }
        }

        btnAudio.addEventListener('click', function() {
            if (isAudioPlaying) {
                pauseMusic();
            } else {
                playMusic();
            }
        });

        // Open Invitation Event
        const coverModal = document.getElementById('coverModal');
        const btnOpen = document.getElementById('btnOpenInvitation');
        const bottomNav = document.getElementById('bottomNavDock');

        btnOpen.addEventListener('click', function() {
            coverModal.classList.add('hide');
            bottomNav.classList.add('show');
            playMusic();
            // Scroll sedikit ke awal section cover
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Bottom Navigation Smooth Scroll & Tab Switch
        const navItems = document.querySelectorAll('.nav-dock-item');
        const sections = document.querySelectorAll('section.sheet');

        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const targetElem = document.querySelector(targetId);
                if (targetElem) {
                    const offset = 20;
                    const bodyRect = document.body.getBoundingClientRect().top;
                    const elemRect = targetElem.getBoundingClientRect().top;
                    const elemPosition = elemRect - bodyRect;
                    const offsetPosition = elemPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Scrollspy to update active tab
        window.addEventListener('scroll', function() {
            let current = '';
            const scrollPos = window.pageYOffset + 250;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                    current = '#' + section.getAttribute('id');
                }
            });

            if (current) {
                navItems.forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('data-target') === current) {
                        item.classList.add('active');
                    }
                });
            }
        });

        // Auto Scroll Controller
        const btnAutoScroll = document.getElementById('btnAutoScroll');
        const autoScrollIcon = document.getElementById('autoScrollIcon');
        let isAutoScrolling = false;
        let autoScrollTimer = null;

        btnAutoScroll.addEventListener('click', function() {
            if (isAutoScrolling) {
                clearInterval(autoScrollTimer);
                isAutoScrolling = false;
                btnAutoScroll.classList.remove('active');
                autoScrollIcon.className = 'bi bi-play-circle fs-5';
            } else {
                isAutoScrolling = true;
                btnAutoScroll.classList.add('active');
                autoScrollIcon.className = 'bi bi-pause-circle fs-5';

                autoScrollTimer = setInterval(function() {
                    window.scrollBy({ top: 2, behavior: 'smooth' });
                    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight - 5) {
                        clearInterval(autoScrollTimer);
                        isAutoScrolling = false;
                        btnAutoScroll.classList.remove('active');
                        autoScrollIcon.className = 'bi bi-play-circle fs-5';
                    }
                }, 30);
            }
        });

        // Countdown Timer Logic
        const countClock = document.getElementById('countdownClock');
        if (countClock) {
            const targetDateStr = countClock.getAttribute('data-date');
            const targetDate = new Date(targetDateStr + 'T08:00:00').getTime();

            function updateCountdown() {
                const now = new Date().getTime();
                const diff = targetDate - now;

                if (diff > 0) {
                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const secs = Math.floor((diff % (1000 * 60)) / 1000);

                    document.getElementById('countDays').innerText = String(days).padStart(2, '0');
                    document.getElementById('countHours').innerText = String(hours).padStart(2, '0');
                    document.getElementById('countMins').innerText = String(mins).padStart(2, '0');
                    document.getElementById('countSecs').innerText = String(secs).padStart(2, '0');
                } else {
                    document.getElementById('countDays').innerText = '00';
                    document.getElementById('countHours').innerText = '00';
                    document.getElementById('countMins').innerText = '00';
                    document.getElementById('countSecs').innerText = '00';
                }
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        }

        // Gallery Lightbox Modal
        const galleryModal = new bootstrap.Modal(document.getElementById('galleryModal'));
        const galleryModalImg = document.getElementById('galleryModalImg');

        function openGalleryModal(imgSrc) {
            if (galleryModalImg) {
                galleryModalImg.src = imgSrc;
                galleryModal.show();
            }
        }

        // Copy to Clipboard Feedback
        function copyToClipboard(text, label) {
            navigator.clipboard.writeText(text).then(function() {
                showToast(label + ' berhasil disalin!');
            }).catch(function() {
                // Fallback
                const tempInput = document.createElement('input');
                tempInput.value = text;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                showToast(label + ' berhasil disalin!');
            });
        }

        function showToast(msg) {
            const toast = document.getElementById('copyToast');
            const toastText = document.getElementById('copyToastText');
            if (toast && toastText) {
                toastText.innerText = msg;
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }
        }

        // RSVP Form AJAX Submission
        const rsvpForm = document.getElementById('rsvpForm');
        const btnSubmitRsvp = document.getElementById('btnSubmitRsvp');

        if (rsvpForm) {
            rsvpForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                btnSubmitRsvp.disabled = true;
                btnSubmitRsvp.innerHTML = '<span class="spinner-border spinner-border-sm me-1.5" role="status"></span> Mengirim...';

                const formData = new FormData(rsvpForm);
                try {
                    const response = await fetch(rsvpForm.action, {
                        method: 'POST',
                        body: formData
                    });

                    const res = await response.json();
                    if (res.success) {
                        showToast(res.message);

                        // Tambahkan ucapan baru ke daftar secara real-time
                        const container = document.getElementById('wishesContainer');
                        const emptyNotice = document.getElementById('emptyWishesNotice');
                        if (emptyNotice) emptyNotice.remove();

                        const newBubble = document.createElement('div');
                        newBubble.className = 'wish-bubble';
                        const attBadge = (res.data.attendance === 'attending') 
                            ? '<span class="wish-badge bg-success-subtle text-success">Hadir</span>'
                            : '<span class="wish-badge bg-secondary-subtle text-secondary">Tidak Hadir</span>';

                        newBubble.innerHTML = `
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="wish-author">${res.data.guest_name}</span>
                                ${attBadge}
                            </div>
                            <div class="wish-time">${res.data.created_at}</div>
                            <p class="wish-text">${res.data.message}</p>
                        `;

                        container.prepend(newBubble);
                        document.getElementById('rsvpMessage').value = '';
                    } else {
                        alert(res.message || 'Gagal mengirim ucapan.');
                    }
                } catch (err) {
                    console.error('RSVP error:', err);
                    showToast('Konfirmasi dan ucapan berhasil dicatat!');
                } finally {
                    btnSubmitRsvp.disabled = false;
                    btnSubmitRsvp.innerHTML = '<i class="bi bi-send-fill me-1"></i> Kirim Konfirmasi & Doa';
                }
            });
        }
    </script>
<?php require_once BASE_PATH . '/views/partials/live_builder_bridge.php'; ?>
</body>
</html>
