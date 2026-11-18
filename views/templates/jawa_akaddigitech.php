<?php
// views/templates/jawa_akaddigitech.php & javanese_royal.php
// Inspired by https://inv.akaddigitech.id/adat-jawa/
// Luxurious Traditional Javanese Wedding Template with Dynamic Admin Asset Manager (Images, Animations, Music)

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];

// Fallback high-res prewedding gallery
if (empty($galleries)) {
    $galleries = [
        'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098066.webp',
        'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098064.webp',
        'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098059.webp',
        'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098067.webp',
        'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098061.webp',
        'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098068.webp'
    ];
}

$gNick = !empty($event['groom_nickname']) ? trim($event['groom_nickname']) : 'Krisna';
$bNick = !empty($event['bride_nickname']) ? trim($event['bride_nickname']) : 'Anisa';
$gName = !empty($event['groom_name']) ? trim($event['groom_name']) : 'Raden Mas Krisna Joyodiningrat, S.T.';
$bName = !empty($event['bride_name']) ? trim($event['bride_name']) : 'Raden Ajeng Anisa Sekar Arum, S.Sn.';

$gFather = !empty($event['groom_father']) ? $event['groom_father'] : 'Bpk. Soedarmono Joyodiningrat';
$gMother = !empty($event['groom_mother']) ? $event['groom_mother'] : 'Ibu Siti Rahayu Joyodiningrat';
$bFather = !empty($event['bride_father']) ? $event['bride_father'] : 'Bpk. Hendro Kusumo Wardhana';
$bMother = !empty($event['bride_mother']) ? $event['bride_mother'] : 'Ibu Sri Wahyuningsih';

$gInsta = !empty($event['groom_instagram']) ? trim($event['groom_instagram']) : 'krisna.joyo';
$bInsta = !empty($event['bride_instagram']) ? trim($event['bride_instagram']) : 'anisa.arum';

$guestDisplayName = !empty($guestName) ? $guestName : 'Bapak / Ibu / Saudara(i)';
$musicUrl = !empty($event['music_url']) ? media_url($event['music_url']) : 'https://inv.akaddigitech.id/wp-content/uploads/2025/09/Irenne-Ghea-Feat-Widhi-Arjuna-Sotya-Dangdut.mp3';

$eventDateTimestamp = strtotime($event['event_date'] ?? '+30 days');
$eventDateFormatted = date('d F Y', $eventDateTimestamp);
$eventIsoDate = date('Y-m-d\TH:i:s', $eventDateTimestamp);

$akadTime = !empty($event['akad_time']) ? $event['akad_time'] : '08:00 - 10:00 WIB';
$akadLocation = !empty($event['akad_location']) ? $event['akad_location'] : 'Pendhapa Ndalem Ngayogyakarta Hadiningrat';
$akadAddress = !empty($event['akad_address']) ? $event['akad_address'] : 'Jl. Alun-Alun Kidul No. 12, Panembahan, Kraton, Kota Yogyakarta';

$resepsiTime = !empty($event['resepsi_time']) ? $event['resepsi_time'] : '11:00 - 14:00 WIB';
$resepsiLocation = !empty($event['resepsi_location']) ? $event['resepsi_location'] : 'Sasana Hinggil Dwijoseputro, Alun-Alun Kidul';
$resepsiAddress = !empty($event['resepsi_address']) ? $event['resepsi_address'] : 'Kraton, Daerah Istimewa Yogyakarta';

$groomPhoto = !empty($event['groom_photo']) ? media_url($event['groom_photo']) : 'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098064.webp';
$bridePhoto = !empty($event['bride_photo']) ? media_url($event['bride_photo']) : 'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098059.webp';
$coverPhoto = !empty($event['cover_photo']) ? media_url($event['cover_photo']) : 'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098066.webp';

$quoteText = !empty($event['quote']) ? $event['quote'] : 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.';
$quoteSource = !empty($event['quote_source']) ? $event['quote_source'] : 'QS. Ar-Rum: 21';

$rsvpTargetUrl = base_url('u/' . ($event['slug'] ?? 'demo') . '/rsvp');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="pageTitle"><?= htmlspecialchars($event['title'] ?? ('Pawiwahan Ageng ' . $bNick . ' & ' . $gNick)) ?></title>

    <!-- Favicon -->
    <link rel="icon" href="https://inv.akaddigitech.id/wp-content/uploads/2025/09/JAWA-GUNUNGAN.png" type="image/png">

    <!-- Google Fonts: Pinyon Script, Cormorant Infant, Poppins, Cinzel, Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Cinzel:wght@400;600;700&family=Cormorant+Infant:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Pinyon+Script&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            /* Warna Otentik Adat Jawa Akad Digitech */
            --bg-dark: #120A05;
            --bg-deep: #1A0F08;
            --bg-card: #24160D;
            --bg-card-light: #2D1C12;
            --jawa-gold: #D4AF37;
            --jawa-gold-light: #F6E29F;
            --jawa-gold-deep: #9F7922;
            --jawa-gold-gradient: linear-gradient(135deg, #F6E29F 0%, #D4AF37 50%, #9F7922 100%);
            --jawa-terracotta: #A44A3F;
            --text-light: #FAF6EF;
            --text-muted: #B8A698;
            --border-gold: rgba(212, 175, 55, 0.35);
            --border-gold-glow: rgba(212, 175, 55, 0.7);
            --radius-box: 20px;
            --radius-pill: 999px;
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-light);
            line-height: 1.8;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .font-script { font-family: 'Pinyon Script', cursive; }
        .font-cormorant { font-family: 'Cormorant Infant', serif; }
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-serif { font-family: 'Playfair Display', serif; }

        /* Container Limit (Mobile-First Editorial) */
        .invitation-frame {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            background-color: var(--bg-deep);
            box-shadow: 0 0 60px rgba(0, 0, 0, 0.95), 0 0 25px rgba(212, 175, 55, 0.15);
            min-height: 100vh;
            border-left: 1px solid rgba(212, 175, 55, 0.2);
            border-right: 1px solid rgba(212, 175, 55, 0.2);
            overflow: hidden;
            z-index: 2;
        }

        /* Subtle Ambient Batik Texture */
        .invitation-frame::before {
            content: '';
            position: fixed;
            top: 0;
            bottom: 0;
            width: 500px;
            background-image: 
                radial-gradient(circle at 15% 15%, rgba(212, 175, 55, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(164, 74, 63, 0.04) 0%, transparent 40%);
            pointer-events: none;
            z-index: 0;
        }

        /* ==========================================================================
           1. PRELOADER SCREEN (Khas Akad Digitech)
           ========================================================================== */
        #preloader-akad {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100vh;
            z-index: 999999;
            background-color: #000000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out;
        }

        #preloader-akad.tutup-layar {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .preloader-slider-box {
            width: 180px;
            height: 180px;
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid var(--jawa-gold);
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.4);
            margin-bottom: 22px;
            position: relative;
        }

        .preloader-slider-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            animation: preloaderZoom 5s infinite alternate ease-in-out;
        }

        @keyframes preloaderZoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.12); }
        }

        .preloader-title {
            font-family: 'Pinyon Script', cursive;
            font-size: 32px;
            color: var(--jawa-gold-light);
            margin-bottom: 2px;
            text-shadow: 0 0 12px rgba(212, 175, 55, 0.5);
        }

        .preloader-names {
            font-family: 'Cinzel', serif;
            font-size: 19px;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 18px;
        }

        .preloader-percent-badge {
            font-family: 'Cinzel', serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--jawa-gold-light);
            background: rgba(212, 175, 55, 0.15);
            padding: 4px 18px;
            border-radius: var(--radius-pill);
            border: 1px solid var(--border-gold);
        }

        /* ==========================================================================
           2. COVER / OPENING MODAL (Tema Adat Jawa Akad Digitech)
           ========================================================================== */
        #coverOverlay {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: radial-gradient(circle at 50% 30%, #29170E 0%, #150A05 75%, #0A0402 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            overflow: hidden;
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1), opacity 1s ease;
        }

        #coverOverlay.unlocked {
            opacity: 0;
            transform: translateY(-100%);
            pointer-events: none;
        }

        .cover-content {
            position: relative;
            z-index: 5;
            text-align: center;
            width: 100%;
            max-width: 440px;
        }

        .cover-gunungan {
            width: 140px;
            max-width: 45vw;
            margin: 0 auto 16px;
            filter: drop-shadow(0 0 20px rgba(212, 175, 55, 0.5));
            animation: pulseGunungan 4s infinite alternate ease-in-out;
            cursor: pointer;
        }

        @keyframes pulseGunungan {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-8px) scale(1.04); }
        }

        .cover-kicker {
            font-family: 'Pinyon Script', cursive;
            font-size: 32px;
            color: var(--jawa-gold-light);
            margin-bottom: 4px;
            line-height: 1;
        }

        .cover-names {
            font-family: 'Cormorant Infant', serif;
            font-size: 38px;
            font-weight: 700;
            color: #FFFFFF;
            letter-spacing: 1px;
            line-height: 1.2;
            margin-bottom: 8px;
            text-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
        }

        .cover-date-text {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--jawa-gold);
            font-weight: 600;
            margin-bottom: 24px;
        }

        .cover-guest-card {
            background: rgba(36, 22, 13, 0.7);
            backdrop-filter: blur(8px);
            border: 1px solid var(--border-gold);
            border-radius: 18px;
            padding: 16px 20px;
            margin-bottom: 28px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }

        .cover-guest-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 4px;
            font-style: italic;
        }

        .cover-guest-name {
            font-size: 17px;
            font-weight: 600;
            color: #FFFFFF;
            letter-spacing: 0.5px;
        }

        .btn-buka-undangan {
            background: var(--jawa-gold-gradient);
            color: #120A05;
            font-family: 'Poppins', sans-serif;
            font-size: 14.5px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 14px 38px;
            border-radius: var(--radius-pill);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.45);
            transition: var(--transition-smooth);
        }

        .btn-buka-undangan:hover {
            transform: translateY(-3px) scale(1.04);
            box-shadow: 0 14px 35px rgba(212, 175, 55, 0.65);
            color: #120A05;
        }

        /* Dynamic Particle Canvas for Animation Assets */
        #dynamicParticleCanvas {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 2;
            width: 100%;
            height: 100%;
        }

        /* ==========================================================================
           3. MAIN SECTIONS
           ========================================================================== */
        .section-block {
            padding: 60px 24px;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .section-kicker-script {
            font-family: 'Pinyon Script', cursive;
            font-size: 34px;
            color: var(--jawa-gold-light);
            display: block;
            margin-bottom: 2px;
        }

        .section-title-cormorant {
            font-family: 'Cormorant Infant', serif;
            font-size: 32px;
            font-weight: 700;
            color: #FFFFFF;
            letter-spacing: 1px;
            margin-bottom: 14px;
        }

        .gold-divider-ornament {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 0 auto 30px;
            width: 140px;
        }

        .gold-divider-ornament::before, .gold-divider-ornament::after {
            content: '';
            height: 1.5px;
            flex: 1;
            background: linear-gradient(90deg, transparent, var(--jawa-gold), transparent);
        }

        .gold-divider-ornament span {
            color: var(--jawa-gold-light);
            font-size: 16px;
        }

        /* Hero Main Page Section */
        .hero-main {
            padding: 50px 24px;
            text-align: center;
            border-bottom: 1px solid var(--border-gold);
            background: linear-gradient(180deg, rgba(36, 22, 13, 0.8) 0%, rgba(18, 10, 5, 0.95) 100%);
        }

        .hero-gunungan-img {
            width: 110px;
            margin: 0 auto 16px;
            filter: drop-shadow(0 0 15px rgba(212, 175, 55, 0.4));
        }

        .hero-names-display {
            font-family: 'Cormorant Infant', serif;
            font-size: 44px;
            font-weight: 700;
            color: #FFFFFF;
            line-height: 1.15;
            margin-bottom: 6px;
        }

        .hero-date-badge {
            display: inline-block;
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid var(--border-gold);
            color: var(--jawa-gold-light);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1.5px;
            padding: 6px 22px;
            border-radius: var(--radius-pill);
            margin-top: 14px;
        }

        /* Mempelai Profile (Couple) */
        .couple-card-box {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-box);
            padding: 34px 22px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .wayang-silhouette-top {
            width: 100px;
            height: auto;
            margin: 0 auto 16px;
            filter: drop-shadow(0 0 12px rgba(212, 175, 55, 0.35));
        }

        .couple-portrait-wrapper {
            width: 150px;
            height: 150px;
            margin: 0 auto 18px;
            border-radius: 50%;
            padding: 5px;
            background: var(--jawa-gold-gradient);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.35);
        }

        .couple-portrait-wrapper img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--bg-deep);
        }

        .couple-full-name {
            font-family: 'Cormorant Infant', serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--jawa-gold-light);
            margin-bottom: 6px;
        }

        .couple-parents-desc {
            font-size: 13.5px;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 14px;
        }

        .couple-ig-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--jawa-gold);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-pill);
            padding: 5px 18px;
            font-size: 12.5px;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .couple-ig-btn:hover {
            background: var(--jawa-gold);
            color: var(--bg-dark);
        }

        /* Agenda Acara (Akad & Resepsi) */
        .event-schedule-card {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-box);
            padding: 30px 22px;
            margin-bottom: 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .event-schedule-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--jawa-gold-gradient);
        }

        .event-session-badge {
            background: rgba(212, 175, 55, 0.15);
            color: var(--jawa-gold-light);
            border: 1px solid var(--border-gold);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 20px;
            border-radius: var(--radius-pill);
            display: inline-block;
            margin-bottom: 16px;
        }

        .event-session-title {
            font-family: 'Cormorant Infant', serif;
            font-size: 24px;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 16px;
        }

        .event-info-detail {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .event-info-detail strong {
            color: var(--text-light);
            display: block;
            font-size: 15px;
            margin-bottom: 2px;
        }

        .btn-event-maps {
            background: transparent;
            border: 1px solid var(--jawa-gold);
            color: var(--jawa-gold-light);
            font-size: 13px;
            font-weight: 600;
            padding: 8px 24px;
            border-radius: var(--radius-pill);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            margin-top: 14px;
            transition: var(--transition-smooth);
        }

        .btn-event-maps:hover {
            background: var(--jawa-gold);
            color: var(--bg-dark);
        }

        /* Countdown Timer */
        .countdown-container {
            background: rgba(36, 22, 13, 0.6);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-box);
            padding: 28px 16px;
            margin: 24px 0 34px;
        }

        .countdown-grid-akad {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .countdown-digit-box {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: 14px;
            padding: 12px 6px;
        }

        .countdown-digit {
            font-family: 'Cormorant Infant', serif;
            font-size: 30px;
            font-weight: 700;
            color: var(--jawa-gold-light);
            line-height: 1;
        }

        .countdown-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-top: 4px;
            font-weight: 600;
        }

        /* Love Story Timeline */
        .story-item {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-box);
            padding: 24px 20px;
            margin-bottom: 18px;
            text-align: left;
        }

        .story-year-tag {
            font-family: 'Cinzel', serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--jawa-gold);
            letter-spacing: 1px;
            margin-bottom: 4px;
            display: block;
        }

        .story-item h5 {
            font-family: 'Cormorant Infant', serif;
            font-size: 20px;
            color: #FFFFFF;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .story-item p {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.65;
            margin: 0;
        }

        /* Prewedding Photo Gallery Grid */
        .gallery-grid-akad {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .gallery-card-item {
            border-radius: 14px;
            overflow: hidden;
            border: 2px solid var(--border-gold);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
            transition: var(--transition-smooth);
        }

        .gallery-card-item:hover {
            transform: scale(1.03);
            border-color: var(--jawa-gold);
        }

        .gallery-card-item img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            display: block;
        }

        /* Digital Gift (Amplop Digital) */
        .gift-box-akad {
            background: linear-gradient(135deg, #2A180F, #190E07);
            border: 1.5px solid var(--jawa-gold);
            border-radius: var(--radius-box);
            padding: 26px 20px;
            margin-bottom: 20px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
        }

        .gift-bank-logo {
            max-height: 38px;
            margin-bottom: 14px;
            filter: brightness(1.2);
        }

        .gift-account-number {
            font-family: 'Cinzel', serif;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #FFFFFF;
            margin-bottom: 4px;
        }

        .btn-salin-rekening {
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid var(--jawa-gold);
            color: var(--jawa-gold-light);
            font-size: 12.5px;
            font-weight: 600;
            padding: 8px 22px;
            border-radius: var(--radius-pill);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition-smooth);
            margin-top: 10px;
        }

        .btn-salin-rekening:hover {
            background: var(--jawa-gold);
            color: var(--bg-dark);
        }

        /* RSVP & Wishes Form */
        .rsvp-card-akad {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-box);
            padding: 30px 22px;
            margin-bottom: 30px;
            text-align: left;
        }

        .form-label-akad {
            font-size: 13px;
            font-weight: 600;
            color: var(--jawa-gold-light);
            margin-bottom: 6px;
            display: block;
        }

        .form-control-akad {
            background: rgba(18, 10, 5, 0.7);
            border: 1px solid var(--border-gold);
            color: #FFFFFF;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13.5px;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            margin-bottom: 16px;
            transition: var(--transition-smooth);
        }

        .form-control-akad:focus {
            outline: none;
            border-color: var(--jawa-gold);
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
            background: rgba(18, 10, 5, 0.9);
        }

        /* Sticker Picker like Akad Digitech */
        .sticker-selector-row {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 8px;
            margin-bottom: 16px;
        }

        .sticker-pick-btn {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            border: 2px solid transparent;
            cursor: pointer;
            padding: 4px;
            background: rgba(255, 255, 255, 0.05);
            transition: var(--transition-smooth);
            flex-shrink: 0;
        }

        .sticker-pick-btn.selected, .sticker-pick-btn:hover {
            border-color: var(--jawa-gold);
            background: rgba(212, 175, 55, 0.15);
        }

        .sticker-pick-btn img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .btn-kirim-doa {
            background: var(--jawa-gold-gradient);
            color: #120A05;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            width: 100%;
            padding: 14px;
            border-radius: var(--radius-pill);
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition-smooth);
        }

        .btn-kirim-doa:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(212, 175, 55, 0.6);
            color: #120A05;
        }

        /* Wishes List */
        .wishes-feed-list {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 4px;
            text-align: left;
        }

        .wishes-feed-list::-webkit-scrollbar {
            width: 4px;
        }
        .wishes-feed-list::-webkit-scrollbar-thumb {
            background: var(--jawa-gold);
            border-radius: 10px;
        }

        .wish-bubble-item {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 12px;
        }

        .wish-bubble-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .wish-bubble-author {
            font-weight: 700;
            color: var(--jawa-gold-light);
            font-size: 14px;
        }

        .wish-bubble-badge {
            font-size: 11px;
            padding: 3px 10px;
            border-radius: var(--radius-pill);
            background: rgba(40, 167, 69, 0.2);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .wish-bubble-message {
            font-size: 13px;
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .wish-bubble-sticker {
            width: 60px;
            height: 60px;
            object-fit: contain;
            display: block;
            margin-top: 6px;
        }

        .wish-bubble-time {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Floating Controls */
        .floating-action-bar {
            position: fixed;
            bottom: 24px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-floating-disc {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--bg-card);
            border: 1.5px solid var(--jawa-gold);
            color: var(--jawa-gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.7);
            transition: var(--transition-smooth);
        }

        .btn-floating-disc:hover {
            transform: scale(1.1);
            background: var(--jawa-gold);
            color: var(--bg-dark);
        }

        .btn-floating-disc.spinning {
            animation: spinDisc 5s linear infinite;
        }

        @keyframes spinDisc {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* ==========================================================================
           4. ADMINISTRATOR ASSET MANAGEMENT MODAL (IMAGE, ANIMASI & AUDIO)
           ========================================================================== */
        #adminAssetModal {
            position: fixed;
            inset: 0;
            z-index: 9999999;
            background: rgba(10, 5, 2, 0.95);
            backdrop-filter: blur(14px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        }

        #adminAssetModal.show {
            display: flex;
        }

        .admin-modal-card {
            width: 100%;
            max-width: 680px;
            background: #190F09;
            border: 2px solid var(--jawa-gold);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.95);
            color: var(--text-light);
            overflow: hidden;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .admin-modal-header {
            padding: 20px 24px;
            background: #25160E;
            border-bottom: 1px solid var(--border-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-modal-header h4 {
            font-family: 'Cinzel', serif;
            font-size: 18px;
            color: var(--jawa-gold-light);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }

        .admin-modal-body {
            padding: 24px;
            overflow-y: auto;
            text-align: left;
        }

        .admin-nav-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 22px;
            border-bottom: 1px solid var(--border-gold);
            padding-bottom: 12px;
        }

        .admin-tab-btn {
            background: transparent;
            border: 1px solid var(--border-gold);
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: var(--radius-pill);
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .admin-tab-btn.active, .admin-tab-btn:hover {
            background: var(--jawa-gold-gradient);
            color: #120A05;
            border-color: var(--jawa-gold);
        }

        .admin-tab-pane {
            display: none;
        }

        .admin-tab-pane.active {
            display: block;
        }

        .admin-field-group {
            margin-bottom: 16px;
        }

        .admin-field-label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--jawa-gold-light);
            display: block;
            margin-bottom: 5px;
        }

        .admin-field-input {
            width: 100%;
            background: #0E0704;
            border: 1px solid var(--border-gold);
            color: #FFFFFF;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            font-family: monospace;
            transition: var(--transition-smooth);
        }

        .admin-field-input:focus {
            border-color: var(--jawa-gold);
            outline: none;
            box-shadow: 0 0 12px rgba(212, 175, 55, 0.4);
        }

        .admin-modal-footer {
            padding: 16px 24px;
            background: #25160E;
            border-top: 1px solid var(--border-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Toast Popup */
        .toast-notif {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #25160E;
            border: 1.5px solid var(--jawa-gold);
            color: var(--jawa-gold-light);
            padding: 12px 26px;
            border-radius: var(--radius-pill);
            font-size: 13.5px;
            font-weight: 600;
            z-index: 99999999;
            opacity: 0;
            transition: all 0.4s ease;
            pointer-events: none;
        }

        .toast-notif.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    </style>
    <?php if (defined('BASE_PATH') && file_exists(BASE_PATH . '/views/partials/live_builder_bridge.php')) { require_once BASE_PATH . '/views/partials/live_builder_bridge.php'; } ?>
</head>
<body>

    <!-- ==========================================================================
       1. PRELOADER SCREEN (Khas Akad Digitech: Foto Kotak, Persen & Judul)
       ========================================================================== -->
    <div id="preloader-akad">
        <div class="preloader-slider-box">
            <img id="preloaderPhoto" src="https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098066.webp" alt="Preloader Photo">
        </div>
        <div class="preloader-title">The Wedding of</div>
        <div class="preloader-names" id="preloaderCoupleNames"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></div>
        <div class="preloader-percent-badge" id="preloaderPercent">0%</div>
    </div>

    <!-- ==========================================================================
       2. COVER / PRE-LOADER OVERLAY DENGAN GUNUNGAN JAWA
       ========================================================================== -->
    <div id="coverOverlay">
        <!-- Dynamic Particle Canvas for Animation Assets (Daun Emas / Bunga / Debu Emas) -->
        <canvas id="dynamicParticleCanvas"></canvas>

        <div class="cover-content">
            <img id="coverGununganImg" src="https://inv.akaddigitech.id/wp-content/uploads/2025/09/JAWA-GUNUNGAN.png" alt="Gunungan Jawa" class="cover-gunungan">
            <div class="cover-kicker">The Wedding of</div>
            <h1 class="cover-names" id="coverNamesText"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></h1>
            <div class="cover-date-text" id="coverDateText">Minggu, 31 Desember 2025</div>

            <div class="cover-guest-card">
                <div class="cover-guest-label">Kepada Yth. Bapak/Ibu/Saudara(i):</div>
                <div class="cover-guest-name" id="coverGuestName">Bapak / Ibu / Rekan Terhormat</div>
            </div>

            <button type="button" class="btn-buka-undangan btn-buka" id="btnBukaUndangan">
                <i class="bi bi-envelope-open-heart-fill"></i> Buka Undangan
            </button>
        </div>
    </div>

    <!-- ==========================================================================
       3. HALAMAN UTAMA UNDANGAN (MAIN CONTENT)
       ========================================================================== -->
    <main class="invitation-frame">

        <!-- Hero Section -->
        <section class="hero-main">
            <img id="heroGununganImg" src="https://inv.akaddigitech.id/wp-content/uploads/2025/09/JAWA-GUNUNGAN.png" alt="Gunungan Jawa" class="hero-gunungan-img">
            <div class="section-kicker-script">The Wedding of</div>
            <h2 class="hero-names-display" id="heroNamesDisplay"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></h2>
            <div class="gold-divider-ornament"><span>❖</span></div>
            <div class="hero-date-badge" id="heroDateBadge">Minggu, 31 Desember 2025</div>
        </section>

        <!-- Salam Pembuka & Ayat -->
        <section class="section-block" style="background: var(--bg-card);">
            <div class="section-kicker-script">Pawiwahan Ageng</div>
            <h3 class="section-title-cormorant">We are Getting Married!</h3>
            <div class="gold-divider-ornament"><span>❖</span></div>
            <p class="small text-muted mb-0" style="font-style: italic; line-height: 1.8;">
                "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang."<br>
                <strong style="color: var(--jawa-gold); font-family: 'Cinzel', serif;">(QS. Ar-Rum: 21)</strong>
            </p>
        </section>

        <!-- Profil Pasangan Mempelai (Couple) -->
        <section class="section-block">
            <div class="section-kicker-script">Sri Temanten</div>
            <h3 class="section-title-cormorant">Pasangan Mempelai</h3>
            <div class="gold-divider-ornament"><span>❖</span></div>

            <!-- Mempelai Wanita -->
            <div class="couple-card-box" data-aos="fade-up">
                <img id="wayangBrideImg" src="https://inv.akaddigitech.id/wp-content/uploads/2025/09/JAWA-COUPLE-2.png" alt="Wayang Putri" class="wayang-silhouette-top">
                <div class="couple-portrait-wrapper">
                    <img id="portraitBrideImg" src="https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098073.webp" alt="Foto Mempelai Wanita">
                </div>
                <h4 class="couple-full-name" id="brideFullName">Anisa Zahra Nur, S.Ked</h4>
                <p class="couple-parents-desc" id="brideParentsDesc">
                    Putri tercinta saking panjenenganipun:<br>
                    <strong>Bpk. Nasrudin Hatta</strong> &amp; <strong>Ibu Elma Muna</strong>
                </p>
                <a href="https://instagram.com" target="_blank" class="couple-ig-btn">
                    <i class="bi bi-instagram"></i> @anisazahra
                </a>
            </div>

            <!-- Mempelai Pria -->
            <div class="couple-card-box" data-aos="fade-up">
                <img id="wayangGroomImg" src="https://inv.akaddigitech.id/wp-content/uploads/2025/09/JAWA-COUPLE-4.png" alt="Wayang Kakung" class="wayang-silhouette-top">
                <div class="couple-portrait-wrapper">
                    <img id="portraitGroomImg" src="https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098066.webp" alt="Foto Mempelai Pria">
                </div>
                <h4 class="couple-full-name" id="groomFullName">Krisna Pratama, S.T</h4>
                <p class="couple-parents-desc" id="groomParentsDesc">
                    Putra pambayun saking panjenenganipun:<br>
                    <strong>Bpk. Sufian Jadin</strong> &amp; <strong>Ibu Elmira Ghendis</strong>
                </p>
                <a href="https://instagram.com" target="_blank" class="couple-ig-btn">
                    <i class="bi bi-instagram"></i> @krisnapratama
                </a>
            </div>
        </section>

        <!-- Hitung Mundur Acara (Countdown) -->
        <section class="section-block" style="background: var(--bg-card); padding-top: 40px; padding-bottom: 40px;">
            <div class="section-kicker-script">Save The Date</div>
            <h3 class="section-title-cormorant" style="font-size: 26px;">Hitung Mundur Acara</h3>
            
            <div class="countdown-container">
                <div class="countdown-grid-akad">
                    <div class="countdown-digit-box">
                        <div class="countdown-digit" id="cdDays">00</div>
                        <div class="countdown-label">Hari</div>
                    </div>
                    <div class="countdown-digit-box">
                        <div class="countdown-digit" id="cdHours">00</div>
                        <div class="countdown-label">Jam</div>
                    </div>
                    <div class="countdown-digit-box">
                        <div class="countdown-digit" id="cdMinutes">00</div>
                        <div class="countdown-label">Menit</div>
                    </div>
                    <div class="countdown-digit-box">
                        <div class="countdown-digit" id="cdSeconds">00</div>
                        <div class="countdown-label">Detik</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Rincian Acara (Akad & Resepsi) -->
        <section class="section-block">
            <div class="section-kicker-script">Waktu &amp; Lokasi</div>
            <h3 class="section-title-cormorant">Agenda Acara</h3>
            <div class="gold-divider-ornament"><span>❖</span></div>

            <!-- Akad Nikah -->
            <div class="event-schedule-card" data-aos="fade-up">
                <span class="event-session-badge">Akad Nikah</span>
                <h4 class="event-session-title">Ijab Qabul</h4>
                <div class="event-info-detail">
                    <strong>Hari, Tanggal</strong>
                    <span id="akadDateDisplay">Minggu, 31 Desember 2025</span>
                </div>
                <div class="event-info-detail">
                    <strong>Waktu Pelaksanaan</strong>
                    <span id="akadTimeDisplay">Pukul 08.00 - 10.00 WIB</span>
                </div>
                <div class="event-info-detail">
                    <strong>Tempat / Lokasi</strong>
                    <span id="akadLocationDisplay">Auditorium Masjid Agung Al-Azhar, Kebayoran Baru, Jakarta</span>
                </div>
                <a href="https://maps.google.com" id="akadMapsBtn" target="_blank" class="btn-event-maps">
                    <i class="bi bi-geo-alt-fill"></i> Petunjuk Lokasi Google Maps
                </a>
            </div>

            <!-- Resepsi Pernikahan -->
            <div class="event-schedule-card" data-aos="fade-up">
                <span class="event-session-badge" style="background: rgba(164, 74, 63, 0.25); border-color: var(--jawa-terracotta);">Resepsi / Panggih</span>
                <h4 class="event-session-title">Pahargyan Temanten</h4>
                <div class="event-info-detail">
                    <strong>Hari, Tanggal</strong>
                    <span id="resepsiDateDisplay">Minggu, 31 Desember 2025</span>
                </div>
                <div class="event-info-detail">
                    <strong>Waktu Pelaksanaan</strong>
                    <span id="resepsiTimeDisplay">Pukul 11.00 - 17.00 WIB</span>
                </div>
                <div class="event-info-detail">
                    <strong>Tempat / Lokasi</strong>
                    <span id="resepsiLocationDisplay">Ballroom Sasana Kriya, Taman Mini Indonesia Indah</span>
                </div>
                <a href="https://maps.google.com" id="resepsiMapsBtn" target="_blank" class="btn-event-maps">
                    <i class="bi bi-geo-alt-fill"></i> Petunjuk Lokasi Google Maps
                </a>
            </div>
        </section>

        <!-- Kisah Cinta (Our Love Story) -->
        <section class="section-block" style="background: var(--bg-card);">
            <div class="section-kicker-script">Perjalanan Cinta</div>
            <h3 class="section-title-cormorant">Our Love Story</h3>
            <div class="gold-divider-ornament"><span>❖</span></div>

            <div class="story-item" data-aos="fade-up">
                <span class="story-year-tag">TAHUN 2021</span>
                <h5>Pertama Berjumpa</h5>
                <p>Setelah lama tidak bertemu akhirnya kami bertemu kembali di sebuah acara seminar profesional. Kebetulan kami berada di bidang yang sama.</p>
            </div>

            <div class="story-item" data-aos="fade-up">
                <span class="story-year-tag">TAHUN 2023</span>
                <h5>Menjalin Komitmen &amp; Lamaran</h5>
                <p>Salah satu momen yang tidak disangka, Krisna melamar saya dengan langsung menyatakan niat baiknya kepada ayah saya. Kami pun bersiap dengan petualangan baru.</p>
            </div>

            <div class="story-item" data-aos="fade-up">
                <span class="story-year-tag">TAHUN 2025</span>
                <h5>Menuju Ikatan Suci</h5>
                <p>Momen spesial kami akan dimulai dari titik ini, membangun keluarga kecil kami yang sakinah. Semoga Allah SWT senantiasa memberikan keberkahan untuk pernikahan kami.</p>
            </div>
        </section>

        <!-- Galeri Prewedding Adat Jawa -->
        <section class="section-block">
            <div class="section-kicker-script">Dokumentasi</div>
            <h3 class="section-title-cormorant">Galeri Foto Prewedding</h3>
            <div class="gold-divider-ornament"><span>❖</span></div>

            <div class="gallery-grid-akad" id="galleryPhotosGrid">
                <!-- Diisi Dinamis oleh JavaScript -->
            </div>
        </section>

        <!-- Amplop Digital (Love Gift) -->
        <section class="section-block" style="background: var(--bg-card);">
            <div class="section-kicker-script">Tanda Kasih</div>
            <h3 class="section-title-cormorant">Love Gift / Amplop Digital</h3>
            <div class="gold-divider-ornament"><span>❖</span></div>
            <p class="small text-muted mb-4">Tanpa mengurangi rasa hormat, bagi Bapak/Ibu/Saudara/i yang ingin memberikan tanda kasih untuk kami, dapat melalui:</p>

            <div class="gift-box-akad" data-aos="zoom-in">
                <img id="bankLogoImg" src="https://inv.akaddigitech.id/wp-content/uploads/2025/09/iconmandiri.png" alt="Bank Mandiri" class="gift-bank-logo">
                <div class="gift-account-number" id="bankAccountNumberDisplay">123123123</div>
                <div class="small text-muted" id="bankAccountHolderDisplay">a.n Anisa Zahra Nur</div>
                <button type="button" class="btn-salin-rekening" onclick="copyRekening('123123123')">
                    <i class="bi bi-clipboard-check"></i> Salin Nomor Rekening
                </button>
            </div>

            <div class="gift-box-akad" data-aos="zoom-in" style="background: linear-gradient(135deg, #1C2E24, #122018); border-color: #4ade80;">
                <div class="fw-bold mb-2" style="font-family: 'Cinzel', serif; color: #4ade80; font-size: 18px;">Bank Central Asia (BCA)</div>
                <div class="gift-account-number" id="bankAccountNumberDisplay2">8210992341</div>
                <div class="small text-muted" id="bankAccountHolderDisplay2">a.n Krisna Pratama</div>
                <button type="button" class="btn-salin-rekening" onclick="copyRekening('8210992341')">
                    <i class="bi bi-clipboard-check"></i> Salin Nomor Rekening
                </button>
            </div>
        </section>

        <!-- RSVP & Buku Tamu (Ucapan Doa + Stiker) -->
        <section class="section-block">
            <div class="section-kicker-script">Konfirmasi &amp; Doa</div>
            <h3 class="section-title-cormorant">Buku Tamu &amp; Doa Restu</h3>
            <div class="gold-divider-ornament"><span>❖</span></div>

            <div class="rsvp-card-akad" data-aos="fade-up">
                <form id="rsvpFormAkad">
                    <label class="form-label-akad">Nama Anda / Keluarga</label>
                    <input type="text" id="guestNameInput" class="form-control-akad" placeholder="Masukkan nama lengkap Anda..." required>

                    <label class="form-label-akad">Konfirmasi Kehadiran</label>
                    <select id="attendanceSelect" class="form-control-akad">
                        <option value="Hadir">Insya Allah Hadir</option>
                        <option value="Ragu">Masih Diusahakan (Ragu)</option>
                        <option value="Berhalangan">Mohon Maaf, Berhalangan Hadir</option>
                    </select>

                    <label class="form-label-akad">Pilih Stiker Ekspresi (Khas Akad Digitech):</label>
                    <div class="sticker-selector-row" id="stickerSelectorRow">
                        <div class="sticker-pick-btn selected" onclick="pickSticker(this, 'https://media.tenor.com/-MlEF7aRcA0AAAAi/tkthao219-quby.gif')">
                            <img src="https://media.tenor.com/-MlEF7aRcA0AAAAi/tkthao219-quby.gif" alt="Sticker 1">
                        </div>
                        <div class="sticker-pick-btn" onclick="pickSticker(this, 'https://media.tenor.com/HFrX2Zk1RZUAAAAi/quby-girl.gif')">
                            <img src="https://media.tenor.com/HFrX2Zk1RZUAAAAi/quby-girl.gif" alt="Sticker 2">
                        </div>
                        <div class="sticker-pick-btn" onclick="pickSticker(this, 'https://media1.tenor.com/m/Dv46FpjCwAgAAAAC/quby-cute.gif')">
                            <img src="https://media1.tenor.com/m/Dv46FpjCwAgAAAAC/quby-cute.gif" alt="Sticker 3">
                        </div>
                    </div>
                    <input type="hidden" id="selectedStickerUrl" value="https://media.tenor.com/-MlEF7aRcA0AAAAi/tkthao219-quby.gif">

                    <label class="form-label-akad">Ucapan &amp; Doa Restu</label>
                    <textarea id="guestMessageInput" class="form-control-akad" rows="3" placeholder="Tuliskan ucapan selamat dan doa keberkahan..." required></textarea>

                    <button type="submit" class="btn-kirim-doa" id="btnSubmitDoa">
                        <i class="bi bi-send-fill"></i> Kirim Konfirmasi &amp; Doa Restu
                    </button>
                </form>
            </div>

            <!-- Feed Daftar Ucapan Tamu -->
            <div class="wishes-feed-list" id="wishesFeedContainer" data-aos="fade-up">
                <!-- Diisi Dinamis oleh JavaScript -->
            </div>
        </section>

        <!-- Footer -->
        <footer class="section-block" style="padding-top: 40px; padding-bottom: 50px; background: #0A0502; border-top: 1px solid var(--border-gold);">
            <div class="section-kicker-script" style="font-size: 28px;">Matur Nuwun</div>
            <h4 class="section-title-cormorant" style="font-size: 22px; margin-bottom: 6px;">Kami Yang Berbahagia</h4>
            <div class="fw-bold" style="color: var(--jawa-gold-light); font-size: 18px; font-family: 'Cinzel', serif;" id="footerNamesDisplay"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></div>
            <p class="small text-muted mt-2 mb-0">Beserta Keluarga Besar Kedua Mempelai</p>
            <p class="small text-muted mt-1 opacity-50">&copy; 2026 Pendar Loka Platform. All rights reserved.</p>
        </footer>
    </main>

    <!-- Floating Action Buttons: Musik Toggle & Auto-Scroll -->
    <div class="floating-action-bar">
        <!-- Tombol Admin Asset Manager -->
        <button type="button" class="btn-floating-disc" id="btnOpenAdminModal" title="Kelola Asset (Admin)">
            <i class="bi bi-sliders text-warning"></i>
        </button>
        <!-- Tombol Musik -->
        <button type="button" class="btn-floating-disc" id="btnAudioToggle" title="Musik Latar">
            <i class="bi bi-music-note-beamed" id="audioIcon"></i>
        </button>
    </div>

    <!-- Background Audio Element -->
    <audio id="bgSongAudio" loop preload="none">
        <source id="bgAudioSource" src="https://inv.akaddigitech.id/wp-content/uploads/2025/09/Irenne-Ghea-Feat-Widhi-Arjuna-Sotya-Dangdut.mp3" type="audio/mpeg">
    </audio>

    <!-- ==========================================================================
       4. ADMINISTRATOR ASSET MANAGEMENT MODAL (IMAGE, ANIMASI, MUSIK BACKGROUND)
       ========================================================================== -->
    <div id="adminAssetModal">
        <div class="admin-modal-card">
            <div class="admin-modal-header">
                <h4><i class="bi bi-palette2 text-warning"></i> Kelola Asset Undangan Adat Jawa</h4>
                <button type="button" class="btn-close btn-close-white" id="btnCloseAdminModal"></button>
            </div>

            <div class="admin-modal-body">
                <!-- Navigation Tabs: Image, Animasi, Audio -->
                <div class="admin-nav-tabs">
                    <button type="button" class="admin-tab-btn active" onclick="switchAdminTab('tab-image', this)">
                        <i class="bi bi-images me-1"></i> Asset Image
                    </button>
                    <button type="button" class="admin-tab-btn" onclick="switchAdminTab('tab-animasi', this)">
                        <i class="bi bi-magic me-1"></i> Asset Animasi
                    </button>
                    <button type="button" class="admin-tab-btn" onclick="switchAdminTab('tab-audio', this)">
                        <i class="bi bi-music-note-list me-1"></i> Asset Musik Background
                    </button>
                </div>

                <!-- TAB 1: ASSET IMAGE -->
                <div class="admin-tab-pane active" id="tab-image">
                    <div class="admin-field-group">
                        <label class="admin-field-label">1. Gambar Gunungan Jawa (Cover &amp; Hero)</label>
                        <input type="text" id="admGununganUrl" class="admin-field-input" placeholder="URL Gunungan .png">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">2. Ornamen Wayang Putri (Bride Silhouette)</label>
                        <input type="text" id="admWayangBrideUrl" class="admin-field-input" placeholder="URL Wayang Putri .png">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">3. Ornamen Wayang Kakung (Groom Silhouette)</label>
                        <input type="text" id="admWayangGroomUrl" class="admin-field-input" placeholder="URL Wayang Pria .png">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">4. Foto Preloader Kotak</label>
                        <input type="text" id="admPreloaderPhotoUrl" class="admin-field-input" placeholder="URL Foto Preloader">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">5. Foto Portrait Mempelai Wanita</label>
                        <input type="text" id="admBridePhotoUrl" class="admin-field-input" placeholder="URL Foto Mempelai Wanita">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">6. Foto Portrait Mempelai Pria</label>
                        <input type="text" id="admGroomPhotoUrl" class="admin-field-input" placeholder="URL Foto Mempelai Pria">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">7. Logo Bank (Amplop Digital)</label>
                        <input type="text" id="admBankLogoUrl" class="admin-field-input" placeholder="URL Logo Bank .png">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">8. Galeri Foto Prewedding (Pisahkan dengan koma)</label>
                        <textarea id="admGalleryPhotosUrl" class="admin-field-input" rows="3" placeholder="https://..., https://..."></textarea>
                    </div>
                </div>

                <!-- TAB 2: ASSET ANIMASI -->
                <div class="admin-tab-pane" id="tab-animasi">
                    <div class="admin-field-group">
                        <label class="admin-field-label">1. Efek Partikel Animasi Latar</label>
                        <select id="admAnimationEffect" class="admin-field-input" style="font-family: 'Poppins', sans-serif;">
                            <option value="leaves">🍂 Daun Emas / Autumn Berguguran (Khas Adat Jawa)</option>
                            <option value="petals">🌸 Kelopak Bunga Melayang (Romantic Petals)</option>
                            <option value="sparkles">✨ Debu / Partikel Emas Berpendar (Golden Sparkles)</option>
                            <option value="none">🚫 Nonaktifkan Animasi Partikel</option>
                        </select>
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">2. Kecepatan Animasi Partikel</label>
                        <select id="admAnimationSpeed" class="admin-field-input" style="font-family: 'Poppins', sans-serif;">
                            <option value="slow">Lambat &amp; Syahdu (Slow Motion)</option>
                            <option value="normal" selected>Normal / Sedang (Direkomendasikan)</option>
                            <option value="fast">Cepat &amp; Semarak (Dynamic)</option>
                        </select>
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">3. Jumlah Partikel di Layar</label>
                        <select id="admAnimationDensity" class="admin-field-input" style="font-family: 'Poppins', sans-serif;">
                            <option value="20">Ringan (20 partikel)</option>
                            <option value="40" selected>Sedang (40 partikel)</option>
                            <option value="70">Padat / Penuh (70 partikel)</option>
                        </select>
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">4. Animasi Gunungan Jawa</label>
                        <select id="admGununganAnim" class="admin-field-input" style="font-family: 'Poppins', sans-serif;">
                            <option value="pulse" selected>Berdenyut Halus (Soft Pulse)</option>
                            <option value="sway">Mengambang Perlahan (Floating Bob)</option>
                            <option value="static">Statis (Tanpa Gerakan)</option>
                        </select>
                    </div>
                </div>

                <!-- TAB 3: ASSET MUSIK BACKGROUND -->
                <div class="admin-tab-pane" id="tab-audio">
                    <div class="admin-field-group">
                        <label class="admin-field-label">1. Pilihan Preset Musik Bawaan</label>
                        <select id="admAudioPreset" class="admin-field-input" style="font-family: 'Poppins', sans-serif;" onchange="applyAudioPreset(this.value)">
                            <option value="custom">-- Gunakan URL Custom Di Bawah --</option>
                            <option value="https://inv.akaddigitech.id/wp-content/uploads/2025/09/Irenne-Ghea-Feat-Widhi-Arjuna-Sotya-Dangdut.mp3" selected>Sotya - Irenne Ghea ft. Widhi Arjuna (Lagu Asli Akad Digitech)</option>
                            <option value="https://cdn.freesound.org/previews/469/469009_9518146-lq.mp3">Gending Jawa Tradisional (Ladrang Wilujeng)</option>
                            <option value="https://assets.mixkit.co/music/preview/mixkit-romantic-wedding-6.mp3">Romantic Wedding Acoustic</option>
                        </select>
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">2. URL File Audio Kustom (.mp3)</label>
                        <input type="text" id="admAudioCustomUrl" class="admin-field-input" placeholder="https://domain.com/audio.mp3">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-field-label">3. Volume Bawaan Musik (0 - 100%)</label>
                        <input type="range" id="admAudioVolume" class="form-range" min="10" max="100" value="80">
                        <div class="small text-muted text-end" id="volumeValueLabel">80%</div>
                    </div>
                </div>
            </div>

            <div class="admin-modal-footer">
                <button type="button" class="btn btn-outline-danger rounded-pill px-3 py-1.5 small fw-semibold" id="btnResetToAkadDefaults">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Bawaan Akad Digitech
                </button>
                <button type="button" class="btn btn-warning rounded-pill px-4 py-2 fw-bold text-dark shadow-sm" id="btnSaveAdminAssets">
                    <i class="bi bi-check-circle-fill me-1"></i> Simpan &amp; Terapkan Asset
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-notif" id="toastNotif">✓ Rekening berhasil disalin!</div>

    <!-- Scripts: Bootstrap 5, AOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        /**
         * 1. DEFAULT ASSETS DARI AKAD DIGITECH (https://inv.akaddigitech.id/adat-jawa/)
         */
        const AKAD_DEFAULT_CONFIG = {
            // Assets Image
            gununganUrl: 'https://inv.akaddigitech.id/wp-content/uploads/2025/09/JAWA-GUNUNGAN.png',
            wayangBrideUrl: 'https://inv.akaddigitech.id/wp-content/uploads/2025/09/JAWA-COUPLE-2.png',
            wayangGroomUrl: 'https://inv.akaddigitech.id/wp-content/uploads/2025/09/JAWA-COUPLE-4.png',
            preloaderPhotoUrl: 'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098066.webp',
            bridePhotoUrl: 'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098073.webp',
            groomPhotoUrl: 'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098066.webp',
            bankLogoUrl: 'https://inv.akaddigitech.id/wp-content/uploads/2025/09/iconmandiri.png',
            galleryPhotos: [
                'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098066.webp',
                'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098073.webp',
                'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098067.webp',
                'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098074.webp',
                'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098071.webp',
                'https://inv.akaddigitech.id/wp-content/uploads/2024/09/pexels-oneprophoto-photo-cinema-467037481-16098077-scaled.webp'
            ],

            // Assets Animasi
            animationEffect: 'leaves', // 'leaves', 'petals', 'sparkles', 'none'
            animationSpeed: 'normal',   // 'slow', 'normal', 'fast'
            animationDensity: 40,
            gununganAnim: 'pulse',      // 'pulse', 'sway', 'static'

            // Assets Audio
            audioUrl: 'https://inv.akaddigitech.id/wp-content/uploads/2025/09/Irenne-Ghea-Feat-Widhi-Arjuna-Sotya-Dangdut.mp3',
            audioVolume: 80,

            // Event Details
            groomName: 'Krisna Pratama',
            brideName: 'Anisa Zahra',
            targetDate: '2026-12-31T08:00'
        };

        const STORAGE_KEY = 'pendar_jawa_akaddigitech_v1';

        function loadConfig() {
            try {
                const saved = localStorage.getItem(STORAGE_KEY);
                if (saved) return Object.assign({}, AKAD_DEFAULT_CONFIG, JSON.parse(saved));
            } catch (e) {}
            return AKAD_DEFAULT_CONFIG;
        }

        let activeConfig = loadConfig();

        /**
         * 2. PRELOADER ANIMATION SIMULATION (Persen 0% - 100%)
         */
        function startPreloader() {
            const preloader = document.getElementById('preloader-akad');
            const percentLabel = document.getElementById('preloaderPercent');
            let count = 0;
            const interval = setInterval(() => {
                count += Math.floor(Math.random() * 15) + 5;
                if (count >= 100) {
                    count = 100;
                    clearInterval(interval);
                    percentLabel.innerText = '100%';
                    setTimeout(() => {
                        preloader.classList.add('tutup-layar');
                    }, 400);
                } else {
                    percentLabel.innerText = count + '%';
                }
            }, 60);
        }

        /**
         * 3. APPLY ASSETS TO DOM
         */
        function applyAssetsToDOM() {
            // Images
            document.getElementById('coverGununganImg').src = activeConfig.gununganUrl;
            document.getElementById('heroGununganImg').src = activeConfig.gununganUrl;
            document.getElementById('preloaderPhoto').src = activeConfig.preloaderPhotoUrl;
            document.getElementById('wayangBrideImg').src = activeConfig.wayangBrideUrl;
            document.getElementById('wayangGroomImg').src = activeConfig.wayangGroomUrl;
            document.getElementById('portraitBrideImg').src = activeConfig.bridePhotoUrl;
            document.getElementById('portraitGroomImg').src = activeConfig.groomPhotoUrl;
            document.getElementById('bankLogoImg').src = activeConfig.bankLogoUrl;

            // Galeri Foto Prewedding
            const galleryGrid = document.getElementById('galleryPhotosGrid');
            if (galleryGrid && Array.isArray(activeConfig.galleryPhotos)) {
                galleryGrid.innerHTML = activeConfig.galleryPhotos.map(url => `
                    <div class="gallery-card-item">
                        <img src="${url}" alt="Prewedding Adat Jawa" loading="lazy">
                    </div>
                `).join('');
            }

            // Audio
            const audioSource = document.getElementById('bgAudioSource');
            const bgAudio = document.getElementById('bgSongAudio');
            if (audioSource) {
                audioSource.src = activeConfig.audioUrl;
                bgAudio.volume = (activeConfig.audioVolume || 80) / 100;
                bgAudio.load();
            }

            // Gunungan Animation Style
            const gununganElements = [document.getElementById('coverGununganImg'), document.getElementById('heroGununganImg')];
            gununganElements.forEach(el => {
                if (!el) return;
                if (activeConfig.gununganAnim === 'static') {
                    el.style.animation = 'none';
                } else if (activeConfig.gununganAnim === 'sway') {
                    el.style.animation = 'pulseGunungan 6s infinite alternate ease-in-out';
                } else {
                    el.style.animation = 'pulseGunungan 4s infinite alternate ease-in-out';
                }
            });

            // Start Particle Canvas
            initDynamicParticles();

            // Handle Guest Name query param (?to= / ?u=)
            const params = new URLSearchParams(window.location.search);
            const guest = params.get('to') || params.get('u') || params.get('kpd');
            if (guest) {
                document.getElementById('coverGuestName').innerText = guest;
                document.getElementById('guestNameInput').value = guest;
            }
        }

        /**
         * 4. DYNAMIC PARTICLE ANIMATION ENGINE (Daun Emas / Bunga / Debu Emas)
         */
        let animFrameId = null;
        function initDynamicParticles() {
            if (animFrameId) cancelAnimationFrame(animFrameId);
            const canvas = document.getElementById('dynamicParticleCanvas');
            if (!canvas) return;
            const effect = activeConfig.animationEffect || 'leaves';
            if (effect === 'none') {
                const ctx = canvas.getContext('2d');
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                return;
            }

            const ctx = canvas.getContext('2d');
            let width = canvas.width = window.innerWidth;
            let height = canvas.height = window.innerHeight;

            window.addEventListener('resize', () => {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            });

            const particles = [];
            const count = parseInt(activeConfig.animationDensity) || 40;
            const speedMultiplier = activeConfig.animationSpeed === 'slow' ? 0.6 : (activeConfig.animationSpeed === 'fast' ? 1.6 : 1.0);

            for (let i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height - height,
                    size: effect === 'sparkles' ? Math.random() * 4 + 1.5 : Math.random() * 12 + 6,
                    speedY: (Math.random() * 1.4 + 0.8) * speedMultiplier,
                    speedX: (Math.random() * 1.2 - 0.6) * speedMultiplier,
                    rotation: Math.random() * 360,
                    rotSpeed: (Math.random() * 2 - 1),
                    swing: Math.random() * 2 + 1,
                    swingSpeed: Math.random() * 0.02 + 0.01,
                    swingAngle: Math.random() * Math.PI * 2,
                    color: effect === 'petals' 
                        ? (Math.random() > 0.5 ? 'rgba(230, 80, 100, 0.75)' : 'rgba(255, 130, 150, 0.7)')
                        : (Math.random() > 0.4 ? 'rgba(212, 175, 55, 0.8)' : 'rgba(246, 226, 159, 0.75)')
                });
            }

            function drawParticle(p) {
                ctx.save();
                ctx.translate(p.x, p.y);
                ctx.rotate((p.rotation * Math.PI) / 180);
                ctx.fillStyle = p.color;

                if (effect === 'sparkles') {
                    ctx.beginPath();
                    ctx.arc(0, 0, p.size, 0, Math.PI * 2);
                    ctx.fill();
                } else if (effect === 'petals') {
                    ctx.beginPath();
                    ctx.moveTo(0, -p.size);
                    ctx.bezierCurveTo(p.size * 0.9, -p.size * 0.3, p.size * 0.9, p.size * 0.5, 0, p.size);
                    ctx.bezierCurveTo(-p.size * 0.9, p.size * 0.5, -p.size * 0.9, -p.size * 0.3, 0, -p.size);
                    ctx.fill();
                } else {
                    // Daun Emas Adat Jawa
                    ctx.beginPath();
                    ctx.moveTo(0, -p.size);
                    ctx.bezierCurveTo(p.size * 0.8, -p.size * 0.3, p.size * 0.7, p.size * 0.4, 0, p.size);
                    ctx.bezierCurveTo(-p.size * 0.7, p.size * 0.4, -p.size * 0.8, -p.size * 0.3, 0, -p.size);
                    ctx.fill();
                    ctx.strokeStyle = 'rgba(0, 0, 0, 0.2)';
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(0, -p.size * 0.8);
                    ctx.lineTo(0, p.size * 0.8);
                    ctx.stroke();
                }
                ctx.restore();
            }

            function loop() {
                ctx.clearRect(0, 0, width, height);
                particles.forEach(p => {
                    p.swingAngle += p.swingSpeed;
                    p.x += p.speedX + Math.sin(p.swingAngle) * p.swing;
                    p.y += p.speedY;
                    p.rotation += p.rotSpeed;

                    if (p.y > height + 20) {
                        p.y = -20;
                        p.x = Math.random() * width;
                    }
                    if (p.x > width + 20) p.x = -20;
                    if (p.x < -20) p.x = width + 20;

                    drawParticle(p);
                });
                animFrameId = requestAnimationFrame(loop);
            }
            loop();
        }

        /**
         * 5. COVER UNLOCK & AUDIO PLAYBACK
         */
        const coverOverlay = document.getElementById('coverOverlay');
        const btnBuka = document.getElementById('btnBukaUndangan');
        const bgAudio = document.getElementById('bgSongAudio');
        const btnAudioToggle = document.getElementById('btnAudioToggle');
        const audioIcon = document.getElementById('audioIcon');
        let isAudioPlaying = false;

        function playMusic() {
            if (bgAudio) {
                bgAudio.play().then(() => {
                    isAudioPlaying = true;
                    btnAudioToggle.classList.add('spinning');
                    audioIcon.className = 'bi bi-pause-fill';
                }).catch(() => {
                    isAudioPlaying = false;
                });
            }
        }

        if (btnBuka) {
            btnBuka.addEventListener('click', () => {
                coverOverlay.classList.add('unlocked');
                playMusic();
            });
        }

        if (btnAudioToggle) {
            btnAudioToggle.addEventListener('click', () => {
                if (isAudioPlaying) {
                    bgAudio.pause();
                    isAudioPlaying = false;
                    btnAudioToggle.classList.remove('spinning');
                    audioIcon.className = 'bi bi-play-fill';
                } else {
                    bgAudio.play();
                    isAudioPlaying = true;
                    btnAudioToggle.classList.add('spinning');
                    audioIcon.className = 'bi bi-pause-fill';
                }
            });
        }

        /**
         * 6. COUNTDOWN TIMER
         */
        function updateAkadCountdown() {
            const targetTime = new Date(activeConfig.targetDate || '2026-12-31T08:00').getTime();
            const now = new Date().getTime();
            const diff = targetTime - now;

            if (diff <= 0) {
                document.getElementById('cdDays').innerText = '00';
                document.getElementById('cdHours').innerText = '00';
                document.getElementById('cdMinutes').innerText = '00';
                document.getElementById('cdSeconds').innerText = '00';
                return;
            }

            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
            const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById('cdDays').innerText = String(d).padStart(2, '0');
            document.getElementById('cdHours').innerText = String(h).padStart(2, '0');
            document.getElementById('cdMinutes').innerText = String(m).padStart(2, '0');
            document.getElementById('cdSeconds').innerText = String(s).padStart(2, '0');
        }
        setInterval(updateAkadCountdown, 1000);
        updateAkadCountdown();

        /**
         * 7. STICKER SELECTOR & RSVP SUBMISSION
         */
        function pickSticker(btn, url) {
            document.querySelectorAll('.sticker-pick-btn').forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            document.getElementById('selectedStickerUrl').value = url;
        }

        const rsvpForm = document.getElementById('rsvpFormAkad');
        const wishesFeed = document.getElementById('wishesFeedContainer');

        // Initial Sample Wishes
        const initialWishes = [
            {
                name: 'Dimas & Arini',
                status: 'Hadir',
                msg: 'Barakallahu lakuma wa baraka alaika wa jamaa bainakuma fii khair. Selamat untuk Mas Krisna dan Mbak Anisa!',
                sticker: 'https://media.tenor.com/-MlEF7aRcA0AAAAi/tkthao219-quby.gif',
                time: '1 jam yang lalu'
            },
            {
                name: 'Keluarga Bpk. H. Sukamto',
                status: 'Hadir',
                msg: 'Mugi-mugi dados kaluwarga ingkang sakinah mawaddah warahmah, tansah pinaringan berkah lan wilujeng.',
                sticker: 'https://media.tenor.com/HFrX2Zk1RZUAAAAi/quby-girl.gif',
                time: '3 jam yang lalu'
            }
        ];

        function renderWishes(list) {
            wishesFeed.innerHTML = list.map(item => `
                <div class="wish-bubble-item" style="animation: fadeIn 0.5s ease;">
                    <div class="wish-bubble-header">
                        <span class="wish-bubble-author">${escapeHtml(item.name)}</span>
                        <span class="wish-bubble-badge">${escapeHtml(item.status)}</span>
                    </div>
                    <div class="wish-bubble-message">${escapeHtml(item.msg)}</div>
                    ${item.sticker ? `<img src="${item.sticker}" class="wish-bubble-sticker" alt="Sticker">` : ''}
                    <div class="wish-bubble-time mt-2">${item.time}</div>
                </div>
            `).join('');
        }
        renderWishes(initialWishes);

        if (rsvpForm) {
            rsvpForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const name = document.getElementById('guestNameInput').value.trim();
                const status = document.getElementById('attendanceSelect').value;
                const msg = document.getElementById('guestMessageInput').value.trim();
                const sticker = document.getElementById('selectedStickerUrl').value;

                if (!name || !msg) return;

                initialWishes.unshift({
                    name: name,
                    status: status,
                    msg: msg,
                    sticker: sticker,
                    time: 'Baru saja'
                });
                renderWishes(initialWishes);
                document.getElementById('guestMessageInput').value = '';
                showToast('✓ Doa dan konfirmasi kehadiran Anda berhasil dikirim!');
            });
        }

        function copyRekening(no) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(no).then(() => showToast('✓ Nomor rekening berhasil disalin!'));
            } else {
                const ta = document.createElement('textarea');
                ta.value = no;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                showToast('✓ Nomor rekening berhasil disalin!');
            }
        }

        function showToast(msg) {
            const toast = document.getElementById('toastNotif');
            if (!toast) return;
            toast.innerText = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2500);
        }

        function escapeHtml(str) {
            if (!str) return '';
            return String(str).replace(/[&<>"']/g, m => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m]));
        }

        /**
         * 8. ADMINISTRATOR ASSET MANAGEMENT PANEL CONTROLLER
         */
        const adminModal = document.getElementById('adminAssetModal');
        const btnOpenAdmin = document.getElementById('btnOpenAdminModal');
        const btnCloseAdmin = document.getElementById('btnCloseAdminModal');
        const btnSaveAssets = document.getElementById('btnSaveAdminAssets');
        const btnResetDefaults = document.getElementById('btnResetToAkadDefaults');

        function switchAdminTab(tabId, btn) {
            document.querySelectorAll('.admin-tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.admin-tab-pane').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }

        function populateAdminModal() {
            // Images
            document.getElementById('admGununganUrl').value = activeConfig.gununganUrl;
            document.getElementById('admWayangBrideUrl').value = activeConfig.wayangBrideUrl;
            document.getElementById('admWayangGroomUrl').value = activeConfig.wayangGroomUrl;
            document.getElementById('admPreloaderPhotoUrl').value = activeConfig.preloaderPhotoUrl;
            document.getElementById('admBridePhotoUrl').value = activeConfig.bridePhotoUrl;
            document.getElementById('admGroomPhotoUrl').value = activeConfig.groomPhotoUrl;
            document.getElementById('admBankLogoUrl').value = activeConfig.bankLogoUrl;
            document.getElementById('admGalleryPhotosUrl').value = (activeConfig.galleryPhotos || []).join(',\n');

            // Animasi
            document.getElementById('admAnimationEffect').value = activeConfig.animationEffect || 'leaves';
            document.getElementById('admAnimationSpeed').value = activeConfig.animationSpeed || 'normal';
            document.getElementById('admAnimationDensity').value = activeConfig.animationDensity || 40;
            document.getElementById('admGununganAnim').value = activeConfig.gununganAnim || 'pulse';

            // Audio
            document.getElementById('admAudioCustomUrl').value = activeConfig.audioUrl;
            document.getElementById('admAudioVolume').value = activeConfig.audioVolume || 80;
            document.getElementById('volumeValueLabel').innerText = (activeConfig.audioVolume || 80) + '%';
        }

        document.getElementById('admAudioVolume')?.addEventListener('input', function() {
            document.getElementById('volumeValueLabel').innerText = this.value + '%';
        });

        function applyAudioPreset(url) {
            if (url !== 'custom') {
                document.getElementById('admAudioCustomUrl').value = url;
            }
        }

        if (btnOpenAdmin) {
            btnOpenAdmin.addEventListener('click', () => {
                populateAdminModal();
                adminModal.classList.add('show');
            });
        }

        if (btnCloseAdmin) {
            btnCloseAdmin.addEventListener('click', () => {
                adminModal.classList.remove('show');
            });
        }

        // Auto open if ?admin=true is present
        if (new URLSearchParams(window.location.search).get('admin') === 'true') {
            setTimeout(() => {
                populateAdminModal();
                adminModal.classList.add('show');
            }, 600);
        }

        // Save & Apply
        if (btnSaveAssets) {
            btnSaveAssets.addEventListener('click', () => {
                const galleryRaw = document.getElementById('admGalleryPhotosUrl').value;
                const galleryArr = galleryRaw.split(',').map(s => s.trim()).filter(s => s.length > 5);

                const newCfg = {
                    gununganUrl: document.getElementById('admGununganUrl').value.trim() || AKAD_DEFAULT_CONFIG.gununganUrl,
                    wayangBrideUrl: document.getElementById('admWayangBrideUrl').value.trim() || AKAD_DEFAULT_CONFIG.wayangBrideUrl,
                    wayangGroomUrl: document.getElementById('admWayangGroomUrl').value.trim() || AKAD_DEFAULT_CONFIG.wayangGroomUrl,
                    preloaderPhotoUrl: document.getElementById('admPreloaderPhotoUrl').value.trim() || AKAD_DEFAULT_CONFIG.preloaderPhotoUrl,
                    bridePhotoUrl: document.getElementById('admBridePhotoUrl').value.trim() || AKAD_DEFAULT_CONFIG.bridePhotoUrl,
                    groomPhotoUrl: document.getElementById('admGroomPhotoUrl').value.trim() || AKAD_DEFAULT_CONFIG.groomPhotoUrl,
                    bankLogoUrl: document.getElementById('admBankLogoUrl').value.trim() || AKAD_DEFAULT_CONFIG.bankLogoUrl,
                    galleryPhotos: galleryArr.length ? galleryArr : AKAD_DEFAULT_CONFIG.galleryPhotos,

                    animationEffect: document.getElementById('admAnimationEffect').value,
                    animationSpeed: document.getElementById('admAnimationSpeed').value,
                    animationDensity: parseInt(document.getElementById('admAnimationDensity').value) || 40,
                    gununganAnim: document.getElementById('admGununganAnim').value,

                    audioUrl: document.getElementById('admAudioCustomUrl').value.trim() || AKAD_DEFAULT_CONFIG.audioUrl,
                    audioVolume: parseInt(document.getElementById('admAudioVolume').value) || 80,

                    groomName: activeConfig.groomName,
                    brideName: activeConfig.brideName,
                    targetDate: activeConfig.targetDate
                };

                localStorage.setItem(STORAGE_KEY, JSON.stringify(newCfg));
                alert('✓ Seluruh asset gambar, animasi, dan musik berhasil disimpan ke localStorage! Halaman akan disegarkan.');
                window.location.reload();
            });
        }

        // Reset to Defaults
        if (btnResetDefaults) {
            btnResetDefaults.addEventListener('click', () => {
                if (confirm('Pulihkan seluruh konfigurasi ke nilai bawaan tema Adat Jawa Akad Digitech?')) {
                    localStorage.removeItem(STORAGE_KEY);
                    window.location.reload();
                }
            });
        }

        // DOM Ready Init
        document.addEventListener('DOMContentLoaded', () => {
            applyAssetsToDOM();
            startPreloader();
        });
    </script>
</body>
</html>