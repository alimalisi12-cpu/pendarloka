<?php
// views/templates/romano_luxury.php
// Inspired by Tibra Digital - Romano Theme (Roman Classical Luxury Architecture)
// Deep Rich Burgundy/Maroon, Classical Pillars, Golden Accents, Dynamic Asset Manager

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];

if (empty($galleries)) {
    $galleries = [
        'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-1.jpg',
        'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-6.jpg',
        'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-7.jpg',
        'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-8.jpg',
        'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-11.jpg',
        'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-12.jpg'
    ];
}

$gNick = !empty($event['groom_nickname']) ? trim($event['groom_nickname']) : 'Stevan';
$bNick = !empty($event['bride_nickname']) ? trim($event['bride_nickname']) : 'Sophia';
$gName = !empty($event['groom_name']) ? trim($event['groom_name']) : 'Stevan Ritoni, S.T.';
$bName = !empty($event['bride_name']) ? trim($event['bride_name']) : 'Sophia Anjelita, S.Ked';

$gFather = !empty($event['groom_father']) ? $event['groom_father'] : 'Bpk. Robertus Ritoni';
$gMother = !empty($event['groom_mother']) ? $event['groom_mother'] : 'Ibu Maria Ritoni';
$bFather = !empty($event['bride_father']) ? $event['bride_father'] : 'Bpk. Hendrawan Anjelita';
$bMother = !empty($event['bride_mother']) ? $event['bride_mother'] : 'Ibu Veronika Anjelita';

$gInsta = !empty($event['groom_instagram']) ? trim($event['groom_instagram']) : 'stevan';
$bInsta = !empty($event['bride_instagram']) ? trim($event['bride_instagram']) : 'sophia';

$guestDisplayName = !empty($guestName) ? $guestName : 'Bapak / Ibu / Saudara(i)';
$musicUrl = !empty($event['music_url']) ? media_url($event['music_url']) : 'https://tibrainvitation.id/wp-content/uploads/2026/11/ASSET-ROME-SONG.mp3';

$eventDateTimestamp = strtotime($event['event_date'] ?? '+30 days');
$eventDateFormatted = date('d F Y', $eventDateTimestamp);
$eventIsoDate = date('Y-m-d\TH:i:s', $eventDateTimestamp);

$akadTime = !empty($event['akad_time']) ? $event['akad_time'] : '09.00 - 11.00 WIB';
$akadLocation = !empty($event['akad_location']) ? $event['akad_location'] : 'Katedral Santo Petrus';
$akadAddress = !empty($event['akad_address']) ? $event['akad_address'] : 'Jl. Merdeka No. 14, Kota Bandung, Jawa Barat';

$resepsiTime = !empty($event['resepsi_time']) ? $event['resepsi_time'] : '18.30 - 21.00 WIB';
$resepsiLocation = !empty($event['resepsi_location']) ? $event['resepsi_location'] : 'The Grand Ballroom Hotel Savoy Homann';
$resepsiAddress = !empty($event['resepsi_address']) ? $event['resepsi_address'] : 'Jl. Asia Afrika No. 112, Kota Bandung, Jawa Barat';

$groomPhoto = !empty($event['groom_photo']) ? media_url($event['groom_photo']) : 'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-14.jpg';
$bridePhoto = !empty($event['bride_photo']) ? media_url($event['bride_photo']) : 'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-17.jpg';
$heroPhoto = !empty($event['hero_photo']) ? media_url($event['hero_photo']) : (!empty($event['cover_photo']) ? media_url($event['cover_photo']) : 'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-16.jpg');

$rsvpTargetUrl = base_url('u/' . ($event['slug'] ?? 'demo') . '/rsvp');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="pageTitle"><?= htmlspecialchars($event['title'] ?? ('The Wedding of ' . $gNick . ' & ' . $bNick)) ?></title>

    <!-- Favicon -->
    <link rel="icon" href="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-1.png" type="image/png">

    <!-- Google Fonts: Newsreader, Lora, Luxurious Script, Alike, Poppins, Cormorant Garamond -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alike&family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Lora:ital,wght@0,400;0,500;0,600;1,400&family=Luxurious+Script&family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,600;0,6..72,700;1,6..72,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            /* Palette: Roman Grandeur - Rich Burgundy/Maroon, Classical Sandstone & Imperial Gold */
            --bg-body: #0E0708;
            --bg-maroon-dark: #18090B;
            --bg-maroon-deep: #250B0F;
            --bg-maroon-rich: #420D15;
            --bg-card: rgba(37, 11, 15, 0.85);
            --bg-card-border: rgba(212, 175, 55, 0.35);

            --roman-gold: #D4AF37;
            --roman-gold-light: #F7E7B4;
            --roman-gold-deep: #9F7922;
            --gold-gradient: linear-gradient(135deg, #F7E7B4 0%, #D4AF37 50%, #9F7922 100%);
            
            --maroon-accent: #871424;
            --maroon-glow: rgba(135, 20, 36, 0.6);
            --text-cream: #FAF4EB;
            --text-muted: #C7B5A7;
            
            --radius-pillar: 16px;
            --radius-arch: 140px 140px 16px 16px;
            --transition-smooth: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
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
            background-color: var(--bg-body);
            color: var(--text-cream);
            line-height: 1.8;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Typography */
        .font-newsreader { font-family: 'Newsreader', serif; }
        .font-lora { font-family: 'Lora', serif; }
        .font-script { font-family: 'Luxurious Script', cursive; }
        .font-alike { font-family: 'Alike', serif; }
        .font-cormorant { font-family: 'Cormorant Garamond', serif; }

        /* Container Limit (Mobile-First Luxury Architecture) */
        .invitation-frame {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            background-color: var(--bg-maroon-deep);
            background-image: 
                radial-gradient(circle at 50% 0%, rgba(135, 20, 36, 0.45) 0%, transparent 70%),
                radial-gradient(circle at 50% 100%, rgba(212, 175, 55, 0.2) 0%, transparent 60%);
            box-shadow: 0 0 60px rgba(0, 0, 0, 0.95), 0 0 30px rgba(212, 175, 55, 0.15);
            min-height: 100vh;
            border-left: 1px solid rgba(212, 175, 55, 0.25);
            border-right: 1px solid rgba(212, 175, 55, 0.25);
            overflow: hidden;
            z-index: 2;
        }

        /* Classical Roman Background Overlay */
        .roman-bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: url('https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-10.jpg') center center / cover no-repeat;
            opacity: 0.15;
            pointer-events: none;
            z-index: 1;
        }

        /* Canvas Particle */
        #particleCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 3;
        }

        /* PRELOADER WITH PERCENTAGE (0% -> 100%) */
        #preloaderRomano {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #140507;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.8s ease, visibility 0.8s ease;
        }

        #preloaderRomano.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .preloader-emblem {
            width: 110px;
            height: auto;
            margin-bottom: 25px;
            animation: pulseGlow 2.5s ease-in-out infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { transform: scale(1); filter: drop-shadow(0 0 10px rgba(212, 175, 55, 0.4)); }
            50% { transform: scale(1.06); filter: drop-shadow(0 0 25px rgba(212, 175, 55, 0.8)); }
        }

        .preloader-tagline {
            font-family: 'Newsreader', serif;
            letter-spacing: 5px;
            font-size: 0.85rem;
            text-transform: uppercase;
            color: var(--roman-gold);
            margin-bottom: 8px;
        }

        .preloader-couple {
            font-family: 'Luxurious Script', cursive;
            font-size: 3.2rem;
            color: #FAF4EB;
            line-height: 1.1;
            margin-bottom: 20px;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.8);
        }

        .preloader-bar-wrap {
            width: 180px;
            height: 3px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 12px;
            position: relative;
        }

        .preloader-bar-fill {
            width: 0%;
            height: 100%;
            background: var(--gold-gradient);
            transition: width 0.1s linear;
        }

        .preloader-count {
            font-family: 'Alike', serif;
            font-size: 1.1rem;
            color: var(--roman-gold-light);
            letter-spacing: 2px;
        }

        /* COVER SCREEN (IMPERIAL ROMAN ARCH GATE) */
        #coverOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(180deg, rgba(20, 5, 7, 0.85) 0%, rgba(40, 10, 15, 0.94) 50%, rgba(20, 5, 7, 0.98) 100%),
                        url('https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-15.jpg') center center / cover no-repeat;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 1.1s cubic-bezier(0.77, 0, 0.175, 1), opacity 0.9s ease;
        }

        #coverOverlay.unlocked {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        .cover-card {
            width: 88%;
            max-width: 420px;
            background: rgba(30, 9, 13, 0.82);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(212, 175, 55, 0.4);
            border-radius: 28px;
            padding: 45px 24px;
            text-align: center;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.9), 0 0 35px rgba(212, 175, 55, 0.25);
            position: relative;
            overflow: hidden;
        }

        .cover-arch-ornament {
            width: 130px;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 12px rgba(212, 175, 55, 0.4));
        }

        .cover-pretitle {
            font-family: 'Newsreader', serif;
            font-size: 0.85rem;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: var(--roman-gold);
            margin-bottom: 8px;
        }

        .cover-couple-name {
            font-family: 'Luxurious Script', cursive;
            font-size: 3.5rem;
            color: #FAF4EB;
            line-height: 1.15;
            margin-bottom: 12px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.9);
        }

        .cover-date-pill {
            display: inline-block;
            font-family: 'Alike', serif;
            font-size: 0.95rem;
            letter-spacing: 3px;
            color: var(--roman-gold-light);
            border-top: 1px solid rgba(212, 175, 55, 0.3);
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
            padding: 4px 18px;
            margin-bottom: 25px;
        }

        .guest-box {
            background: rgba(14, 7, 8, 0.65);
            border: 1px solid rgba(212, 175, 55, 0.25);
            border-radius: 14px;
            padding: 12px 18px;
            margin-bottom: 28px;
        }

        .guest-box-lbl {
            font-size: 0.78rem;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .guest-box-name {
            font-family: 'Newsreader', serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: #FAF4EB;
        }

        .btn-open-romano {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--gold-gradient);
            color: #1A080A;
            border: none;
            padding: 14px 36px;
            font-family: 'Newsreader', serif;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            border-radius: 999px;
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .btn-open-romano:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 14px 35px rgba(212, 175, 55, 0.7);
            color: #000;
        }

        /* SECTION STYLING */
        .section-block {
            padding: 65px 22px;
            position: relative;
        }

        .roman-pillar-border {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 28px;
            background: url('https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-16-265x1024.png') repeat-y center / contain;
            opacity: 0.35;
            pointer-events: none;
            z-index: 1;
        }
        .pillar-left { left: 4px; }
        .pillar-right { right: 4px; transform: scaleX(-1); }

        .sec-header {
            text-align: center;
            margin-bottom: 35px;
            position: relative;
        }

        .sec-sub {
            font-family: 'Newsreader', serif;
            font-size: 0.85rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--roman-gold);
            margin-bottom: 6px;
            display: block;
        }

        .sec-title {
            font-family: 'Newsreader', serif;
            font-size: 2.3rem;
            font-weight: 600;
            color: var(--text-cream);
            line-height: 1.2;
        }

        .roman-divider {
            width: 140px;
            height: auto;
            margin: 14px auto 0;
            display: block;
            filter: drop-shadow(0 2px 6px rgba(212, 175, 55, 0.4));
        }

        /* HERO MAIN SECTION */
        .hero-main {
            text-align: center;
            padding: 70px 20px 45px;
            position: relative;
        }

        .hero-arch-header {
            width: 160px;
            height: auto;
            margin-bottom: 18px;
        }

        .hero-title {
            font-family: 'Newsreader', serif;
            font-size: 1rem;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: var(--roman-gold);
            margin-bottom: 8px;
        }

        .hero-couple {
            font-family: 'Luxurious Script', cursive;
            font-size: 3.6rem;
            color: #FAF4EB;
            line-height: 1.1;
            margin-bottom: 10px;
        }

        .hero-date-text {
            font-family: 'Alike', serif;
            font-size: 1.15rem;
            letter-spacing: 4px;
            color: var(--roman-gold-light);
            margin-bottom: 30px;
        }

        .hero-photo-pillar-wrap {
            position: relative;
            width: 84%;
            max-width: 330px;
            margin: 0 auto;
            border-radius: 170px 170px 20px 20px;
            overflow: hidden;
            border: 3px solid rgba(212, 175, 55, 0.45);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8), 0 0 35px rgba(212, 175, 55, 0.3);
        }

        .hero-photo-pillar-wrap img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }

        .hero-photo-pillar-wrap:hover img {
            transform: scale(1.05);
        }

        /* QUOTE SECTION (ENDLESS LOVE) */
        .quote-box {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            border: 1px solid var(--bg-card-border);
            border-radius: 20px;
            padding: 35px 24px;
            text-align: center;
            position: relative;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
        }

        .quote-lead {
            font-family: 'Luxurious Script', cursive;
            font-size: 2.8rem;
            color: var(--roman-gold);
            line-height: 1;
            margin-bottom: 14px;
        }

        .quote-body {
            font-family: 'Lora', serif;
            font-style: italic;
            font-size: 0.92rem;
            color: var(--text-muted);
            line-height: 1.9;
            margin-bottom: 16px;
        }

        .quote-author {
            font-family: 'Newsreader', serif;
            font-size: 0.85rem;
            letter-spacing: 2px;
            color: var(--roman-gold-light);
            text-transform: uppercase;
        }

        /* GROOM & BRIDE PROFILES */
        .couple-profile-card {
            text-align: center;
            margin-bottom: 45px;
            position: relative;
        }

        .couple-pillar-frame {
            width: 220px;
            height: 300px;
            margin: 0 auto 20px;
            border-radius: var(--radius-arch);
            overflow: hidden;
            border: 2px solid rgba(212, 175, 55, 0.5);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.8), 0 0 25px rgba(212, 175, 55, 0.25);
            position: relative;
        }

        .couple-pillar-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .couple-name {
            font-family: 'Newsreader', serif;
            font-size: 2.1rem;
            font-weight: 600;
            color: #FAF4EB;
            margin-bottom: 6px;
        }

        .couple-parents-desc {
            font-size: 0.88rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 14px;
        }

        .btn-insta-roman {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 20px;
            background: rgba(30, 9, 13, 0.7);
            border: 1px solid rgba(212, 175, 55, 0.4);
            color: var(--roman-gold-light);
            font-size: 0.82rem;
            border-radius: 999px;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .btn-insta-roman:hover {
            background: var(--gold-gradient);
            color: #1A080A;
            transform: translateY(-2px);
        }

        .ampersand-roman {
            font-family: 'Luxurious Script', cursive;
            font-size: 4.5rem;
            color: var(--roman-gold);
            text-align: center;
            line-height: 1;
            margin: 10px 0 35px;
            text-shadow: 0 0 25px rgba(212, 175, 55, 0.5);
        }

        /* COUNTDOWN & EVENT SCHEDULE */
        .countdown-grid {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 25px 0 35px;
        }

        .countdown-item {
            background: rgba(24, 7, 10, 0.8);
            border: 1px solid rgba(212, 175, 55, 0.35);
            border-radius: 14px;
            padding: 14px 10px;
            min-width: 70px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
        }

        .cd-number {
            font-family: 'Alike', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--roman-gold-light);
            line-height: 1;
            margin-bottom: 4px;
        }

        .cd-label {
            font-size: 0.7rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .event-card-roman {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            border: 1px solid var(--bg-card-border);
            border-radius: 22px;
            padding: 34px 22px;
            text-align: center;
            margin-bottom: 26px;
            position: relative;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.7);
        }

        .event-card-title {
            font-family: 'Newsreader', serif;
            font-size: 2rem;
            font-weight: 600;
            color: var(--roman-gold);
            margin-bottom: 12px;
        }

        .event-card-date {
            font-family: 'Alike', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #FAF4EB;
            margin-bottom: 4px;
        }

        .event-card-time {
            font-size: 0.88rem;
            color: var(--roman-gold-light);
            margin-bottom: 16px;
        }

        .event-venue-name {
            font-family: 'Newsreader', serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: #FAF4EB;
            margin-bottom: 4px;
        }

        .event-venue-addr {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 22px;
            line-height: 1.6;
        }

        .btn-roman-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: var(--gold-gradient);
            color: #1A080A;
            border-radius: 999px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 4px;
            transition: var(--transition-smooth);
            box-shadow: 0 6px 18px rgba(212, 175, 55, 0.4);
        }

        .btn-roman-action:hover {
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.7);
        }

        /* GALLERY & VIDEO */
        .gallery-roman-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 30px;
        }

        .gallery-roman-cell {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            aspect-ratio: 1;
            border: 1px solid rgba(212, 175, 55, 0.35);
            cursor: pointer;
        }

        .gallery-roman-cell.span-2 {
            grid-column: span 2;
            aspect-ratio: 16 / 9;
        }

        .gallery-roman-cell img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }

        .gallery-roman-cell:hover img {
            transform: scale(1.08);
        }

        /* WEDDING GIFT / CASHLESS */
        .gift-card-royal {
            background: linear-gradient(135deg, #2E0B12 0%, #4A101C 50%, #1A0508 100%);
            border: 1px solid rgba(212, 175, 55, 0.5);
            border-radius: 20px;
            padding: 26px 22px;
            margin-bottom: 22px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.8), 0 0 25px rgba(212, 175, 55, 0.2);
            position: relative;
            overflow: hidden;
        }

        .gift-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .bank-badge {
            font-family: 'Alike', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #FAF4EB;
            letter-spacing: 2px;
        }

        .acc-number-text {
            font-family: 'Courier New', Courier, monospace;
            font-size: 1.45rem;
            font-weight: 700;
            letter-spacing: 3px;
            color: var(--roman-gold-light);
            margin-bottom: 6px;
        }

        .acc-holder-text {
            font-size: 0.85rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .btn-copy-gold {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 20px;
            background: rgba(212, 175, 55, 0.2);
            border: 1px solid var(--roman-gold);
            color: var(--roman-gold-light);
            font-size: 0.82rem;
            border-radius: 999px;
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .btn-copy-gold:hover {
            background: var(--roman-gold);
            color: #1A080A;
            transform: scale(1.04);
        }

        /* RSVP & WISHES */
        .rsvp-roman-card {
            background: var(--bg-card);
            border: 1px solid var(--bg-card-border);
            border-radius: 22px;
            padding: 30px 22px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
            margin-bottom: 30px;
        }

        .form-roman-label {
            font-size: 0.82rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--roman-gold-light);
            margin-bottom: 6px;
            display: block;
        }

        .form-roman-control {
            width: 100%;
            background: rgba(14, 5, 7, 0.75);
            border: 1px solid rgba(212, 175, 55, 0.35);
            border-radius: 12px;
            padding: 12px 14px;
            color: #FAF4EB;
            font-family: inherit;
            font-size: 0.9rem;
            margin-bottom: 16px;
            outline: none;
            transition: var(--transition-smooth);
        }

        .form-roman-control:focus {
            border-color: var(--roman-gold);
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
            background: rgba(24, 7, 10, 0.85);
        }

        .btn-submit-roman {
            width: 100%;
            padding: 13px;
            background: var(--gold-gradient);
            color: #1A080A;
            border: none;
            border-radius: 999px;
            font-family: 'Newsreader', serif;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
            transition: var(--transition-smooth);
        }

        .btn-submit-roman:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.7);
        }

        .wishes-stream-roman {
            max-height: 380px;
            overflow-y: auto;
            padding-right: 6px;
        }

        .wishes-stream-roman::-webkit-scrollbar {
            width: 4px;
        }
        .wishes-stream-roman::-webkit-scrollbar-thumb {
            background: var(--roman-gold);
            border-radius: 10px;
        }

        .wish-roman-bubble {
            background: rgba(28, 8, 12, 0.75);
            border: 1px solid rgba(212, 175, 55, 0.25);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 14px;
        }

        .wish-roman-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .wish-roman-name {
            font-family: 'Newsreader', serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--roman-gold-light);
        }

        .wish-roman-badge {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 999px;
            text-transform: uppercase;
        }
        .badge-hadir { background: rgba(40, 167, 69, 0.2); color: #4ade80; border: 1px solid rgba(40, 167, 69, 0.4); }
        .badge-tidak { background: rgba(220, 53, 69, 0.2); color: #f87171; border: 1px solid rgba(220, 53, 69, 0.4); }
        .badge-ragu { background: rgba(255, 193, 7, 0.2); color: #facc15; border: 1px solid rgba(255, 193, 7, 0.4); }

        .wish-roman-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* CLOSING FOOTER */
        .footer-roman {
            text-align: center;
            padding: 60px 22px 95px;
            position: relative;
        }

        .footer-emblem {
            width: 80px;
            margin-bottom: 18px;
        }

        .footer-sig-couple {
            font-family: 'Luxurious Script', cursive;
            font-size: 3.4rem;
            color: var(--roman-gold);
            line-height: 1.1;
            margin: 12px 0 6px;
        }

        /* FLOATING MUSIC BUTTON */
        .music-float-btn {
            position: fixed;
            bottom: 85px;
            right: 20px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--gold-gradient);
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1A080A;
            font-size: 1.25rem;
            cursor: pointer;
            z-index: 998;
            transition: var(--transition-smooth);
        }

        .music-float-btn.playing {
            animation: spinVinyl 6s linear infinite;
        }

        @keyframes spinVinyl {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* FLOATING NAVIGATION DOCK */
        .nav-dock-roman {
            position: fixed;
            bottom: 18px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 420px;
            background: rgba(20, 6, 9, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(212, 175, 55, 0.4);
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 10px 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.9), 0 0 15px rgba(212, 175, 55, 0.2);
            z-index: 997;
        }

        .nav-dock-item {
            color: var(--text-muted);
            font-size: 1.15rem;
            text-decoration: none;
            transition: var(--transition-smooth);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .nav-dock-label {
            font-size: 0.65rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .nav-dock-item:hover, .nav-dock-item.active {
            color: var(--roman-gold);
            transform: translateY(-2px);
        }

        /* ADMIN ASSET MANAGER MODAL */
        #adminAssetModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            z-index: 10000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        #adminAssetModal.show {
            display: flex;
        }

        .admin-modal-card {
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            background: #18080B;
            border: 1px solid var(--roman-gold);
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.95), 0 0 35px rgba(212, 175, 55, 0.4);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .admin-modal-header {
            padding: 18px 24px;
            background: #280D12;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-modal-title {
            font-family: 'Newsreader', serif;
            font-size: 1.4rem;
            color: var(--roman-gold);
            font-weight: 600;
        }

        .admin-modal-body {
            padding: 20px 24px;
            overflow-y: auto;
            flex: 1;
        }

        .admin-tabs {
            display: flex;
            gap: 8px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.25);
            margin-bottom: 20px;
        }

        .admin-tab-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            padding: 8px 16px;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: var(--transition-smooth);
        }

        .admin-tab-btn.active {
            color: var(--roman-gold);
            border-bottom-color: var(--roman-gold);
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

        .admin-label {
            display: block;
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--roman-gold-light);
            margin-bottom: 6px;
        }

        .admin-input {
            width: 100%;
            padding: 10px 14px;
            background: #0D0406;
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 10px;
            color: #fff;
            font-size: 0.85rem;
        }

        .admin-modal-footer {
            padding: 16px 24px;
            background: #240B10;
            border-top: 1px solid rgba(212, 175, 55, 0.3);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .floating-admin-trigger {
            position: fixed;
            bottom: 145px;
            right: 20px;
            width: 44px;
            height: 44px;
            background: rgba(24, 7, 10, 0.85);
            border: 1px solid var(--roman-gold);
            border-radius: 50%;
            color: var(--roman-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.7);
            z-index: 998;
            transition: var(--transition-smooth);
        }

        .floating-admin-trigger:hover {
            transform: rotate(45deg) scale(1.1);
            background: var(--roman-gold);
            color: #1A080A;
        }
    </style>
    <?php if (defined('BASE_PATH') && file_exists(BASE_PATH . '/views/partials/live_builder_bridge.php')) { require_once BASE_PATH . '/views/partials/live_builder_bridge.php'; } ?>
</head>
<body>

    <!-- Ambient Texture & Particle Canvas -->
    <div class="roman-bg-overlay"></div>
    <canvas id="particleCanvas"></canvas>

    <!-- Background Music Audio -->
    <audio id="bgMusic" loop preload="auto"></audio>

    <!-- PRELOADER WITH PERCENTAGE (0% -> 100%) -->
    <div id="preloaderRomano">
        <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-1.png" alt="Emblem" class="preloader-emblem">
        <span class="preloader-tagline">Wedding Invitation</span>
        <div class="preloader-couple"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></div>
        <div class="preloader-bar-wrap">
            <div class="preloader-bar-fill" id="preloaderBar"></div>
        </div>
        <div class="preloader-count" id="preloaderCount">0%</div>
    </div>

    <!-- COVER / SPLASH SCREEN (ROMAN ARCH GATE) -->
    <div id="coverOverlay">
        <div class="cover-card">
            <img id="coverArchImg" src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-45.png" alt="Roman Arch" class="cover-arch-ornament">
            <span class="cover-pretitle">The Wedding of</span>
            <h1 class="cover-couple-name" id="coverCoupleNames"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></h1>
            <div class="cover-date-pill" id="coverDateText">14 . 02 . 2027</div>

            <div class="guest-box">
                <div class="guest-box-lbl">Dear, Special Guest:</div>
                <div class="guest-box-name" id="coverGuestName"><?= htmlspecialchars($guestDisplayName) ?></div>
            </div>

            <button type="button" class="btn-open-romano" id="btnOpenRomano">
                <i class="bi bi-envelope-open-heart"></i>
                <span>Open Invitation</span>
            </button>
        </div>
    </div>

    <!-- INVITATION WRAPPER -->
    <div class="invitation-frame">

        <!-- Roman Pillars on Left and Right borders -->
        <div class="roman-pillar-border pillar-left"></div>
        <div class="roman-pillar-border pillar-right"></div>

        <!-- HERO MAIN SECTION -->
        <section class="hero-main" id="secHero">
            <div data-aos="fade-down" data-aos-duration="1000">
                <img id="heroArchHeader" src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-44.png" alt="Pillar Capital" class="hero-arch-header">
                <span class="hero-title">The Wedding of</span>
                <h2 class="hero-couple" id="heroCoupleNames"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></h2>
                <div class="hero-date-text" id="heroDateText">14 . 02 . 2027</div>
            </div>

            <div class="hero-photo-pillar-wrap" data-aos="zoom-in" data-aos-duration="1200">
                <img id="heroPhotoImg" src="https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-16.jpg" alt="Couple Hero">
            </div>
        </section>

        <!-- QUOTE (ENDLESS LOVE) -->
        <section class="section-block" id="secQuote">
            <div class="quote-box" data-aos="fade-up" data-aos-duration="1000">
                <div class="quote-lead">Endless Love</div>
                <p class="quote-body">
                    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. Sungguh, pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berpikir."
                </p>
                <div class="quote-author">— Surat Ar-Rum: 21 —</div>
                <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-55.png" alt="Divider" class="roman-divider">
            </div>
        </section>

        <!-- THE COUPLE (GROOM & BRIDE) -->
        <section class="section-block" id="secCouple">
            <div class="sec-header" data-aos="fade-up">
                <span class="sec-sub">The Beloved Couple</span>
                <h2 class="sec-title">Groom &amp; Bride</h2>
                <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-55.png" alt="Divider" class="roman-divider">
            </div>

            <!-- Groom -->
            <div class="couple-profile-card" data-aos="fade-up" data-aos-duration="1000">
                <div class="couple-pillar-frame">
                    <img id="groomPhotoImg" src="https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-14.jpg" alt="Stevan">
                </div>
                <h3 class="couple-name" id="groomFullName"><?= htmlspecialchars($gName) ?></h3>
                <p class="couple-parents-desc" id="groomParentsText">
                    Putra tercinta dari<br>
                    <strong><?= htmlspecialchars($gFather) ?> &amp; <?= htmlspecialchars($gMother) ?></strong>
                </p>
                <a href="https://instagram.com/<?= htmlspecialchars($gInsta) ?>" target="_blank" class="btn-insta-roman" id="groomInstaLink">
                    <i class="bi bi-instagram"></i>
                    <span id="groomInstaText">@<?= htmlspecialchars($gInsta) ?></span>
                </a>
            </div>

            <div class="ampersand-roman" data-aos="zoom-in">&amp;</div>

            <!-- Bride -->
            <div class="couple-profile-card" data-aos="fade-up" data-aos-duration="1000">
                <div class="couple-pillar-frame">
                    <img id="bridePhotoImg" src="https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-17.jpg" alt="Sophia">
                </div>
                <h3 class="couple-name" id="brideFullName"><?= htmlspecialchars($bName) ?></h3>
                <p class="couple-parents-desc" id="brideParentsText">
                    Putri tercinta dari<br>
                    <strong><?= htmlspecialchars($bFather) ?> &amp; <?= htmlspecialchars($bMother) ?></strong>
                </p>
                <a href="https://instagram.com/<?= htmlspecialchars($bInsta) ?>" target="_blank" class="btn-insta-roman" id="brideInstaLink">
                    <i class="bi bi-instagram"></i>
                    <span id="brideInstaText">@<?= htmlspecialchars($bInsta) ?></span>
                </a>
            </div>
        </section>

        <!-- COUNT THE DATE & EVENTS -->
        <section class="section-block" id="secEvent">
            <div class="sec-header" data-aos="fade-up">
                <span class="sec-sub">Save The Date</span>
                <h2 class="sec-title">Count the Date</h2>
                <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-55.png" alt="Divider" class="roman-divider">
            </div>

            <!-- Countdown Timer -->
            <div class="countdown-grid" data-aos="zoom-in">
                <div class="countdown-item">
                    <div class="cd-number" id="cdDays">00</div>
                    <div class="cd-label">Hari</div>
                </div>
                <div class="countdown-item">
                    <div class="cd-number" id="cdHours">00</div>
                    <div class="cd-label">Jam</div>
                </div>
                <div class="countdown-item">
                    <div class="cd-number" id="cdMinutes">00</div>
                    <div class="cd-label">Menit</div>
                </div>
                <div class="countdown-item">
                    <div class="cd-number" id="cdSeconds">00</div>
                    <div class="cd-label">Detik</div>
                </div>
            </div>

            <!-- Pemberkatan / Akad Nikah -->
            <div class="event-card-roman" data-aos="fade-up">
                <h3 class="event-card-title">Holy Matrimony</h3>
                <div class="event-card-date" id="akadDateText"><?= htmlspecialchars($eventDateFormatted) ?></div>
                <div class="event-card-time" id="akadTimeText"><i class="bi bi-clock me-1"></i> <?= htmlspecialchars($akadTime) ?></div>
                <div class="event-venue-name" id="akadVenueText"><?= htmlspecialchars($akadLocation) ?></div>
                <div class="event-venue-addr" id="akadAddrText"><?= htmlspecialchars($akadAddress) ?></div>

                <div>
                    <a href="https://maps.google.com" target="_blank" class="btn-roman-action" id="akadMapsBtn">
                        <i class="bi bi-geo-alt-fill"></i> Google Maps
                    </a>
                    <a href="#" class="btn-roman-action" id="btnCalAkad">
                        <i class="bi bi-calendar2-heart"></i> Add to Calendar
                    </a>
                </div>
            </div>

            <!-- Resepsi Pernikahan -->
            <div class="event-card-roman" data-aos="fade-up" data-aos-delay="150">
                <h3 class="event-card-title">Grand Reception</h3>
                <div class="event-card-date" id="resepsiDateText"><?= htmlspecialchars($eventDateFormatted) ?></div>
                <div class="event-card-time" id="resepsiTimeText"><i class="bi bi-clock me-1"></i> <?= htmlspecialchars($resepsiTime) ?></div>
                <div class="event-venue-name" id="resepsiVenueText"><?= htmlspecialchars($resepsiLocation) ?></div>
                <div class="event-venue-addr" id="resepsiAddrText"><?= htmlspecialchars($resepsiAddress) ?></div>

                <div>
                    <a href="https://maps.google.com" target="_blank" class="btn-roman-action" id="resepsiMapsBtn">
                        <i class="bi bi-geo-alt-fill"></i> Google Maps
                    </a>
                    <a href="#" class="btn-roman-action" id="btnCalResepsi">
                        <i class="bi bi-calendar2-heart"></i> Add to Calendar
                    </a>
                </div>
            </div>
        </section>

        <!-- OUR GALLERY -->
        <section class="section-block" id="secGallery">
            <div class="sec-header" data-aos="fade-up">
                <span class="sec-sub">Visual Romance</span>
                <h2 class="sec-title">Our Moments</h2>
                <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-55.png" alt="Divider" class="roman-divider">
            </div>

            <div class="gallery-roman-grid" id="galleryContainer" data-aos="fade-up">
                <div class="gallery-roman-cell span-2">
                    <img src="https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-1.jpg" alt="Moment 1">
                </div>
                <div class="gallery-roman-cell">
                    <img src="https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-6.jpg" alt="Moment 2">
                </div>
                <div class="gallery-roman-cell">
                    <img src="https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-7.jpg" alt="Moment 3">
                </div>
                <div class="gallery-roman-cell">
                    <img src="https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-8.jpg" alt="Moment 4">
                </div>
                <div class="gallery-roman-cell">
                    <img src="https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-11.jpg" alt="Moment 5">
                </div>
                <div class="gallery-roman-cell span-2">
                    <img src="https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-12.jpg" alt="Moment 6">
                </div>
            </div>
        </section>

        <!-- WEDDING WISH & RSVP -->
        <section class="section-block" id="secRsvp">
            <div class="sec-header" data-aos="fade-up">
                <span class="sec-sub">Blessings &amp; Prayers</span>
                <h2 class="sec-title">Wishes &amp; RSVP</h2>
                <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-55.png" alt="Divider" class="roman-divider">
            </div>

            <!-- RSVP Form -->
            <div class="rsvp-roman-card" data-aos="fade-up">
                <form id="rsvpForm">
                    <label class="form-roman-label">Nama Lengkap *</label>
                    <input type="text" id="rsvpName" name="name" class="form-roman-control" placeholder="Contoh: Alexander Agung" required>

                    <label class="form-roman-label">Nomor WhatsApp / Telepon</label>
                    <input type="tel" id="rsvpPhone" name="phone" class="form-roman-control" placeholder="08xxxxxxxxxx">

                    <label class="form-roman-label">Konfirmasi Kehadiran *</label>
                    <select id="rsvpAttendance" name="attendance" class="form-roman-control" required>
                        <option value="attending">Ya, Saya Akan Hadir</option>
                        <option value="not_attending">Maaf, Berhalangan Hadir</option>
                        <option value="maybe">Masih Ragu</option>
                    </select>

                    <label class="form-roman-label">Jumlah Tamu (Pax)</label>
                    <select id="rsvpPax" name="pax" class="form-roman-control">
                        <option value="1">1 Orang</option>
                        <option value="2" selected>2 Orang</option>
                        <option value="3">3 Orang</option>
                        <option value="4">4 Orang</option>
                    </select>

                    <label class="form-roman-label">Ucapan &amp; Doa Restu *</label>
                    <textarea id="rsvpMessage" name="message" rows="3" class="form-roman-control" placeholder="Tuliskan pesan dan doa terbaik Anda..." required></textarea>

                    <button type="submit" class="btn-submit-roman" id="btnSubmitRsvp">
                        <i class="bi bi-send-fill me-1"></i> Kirim Konfirmasi &amp; Doa
                    </button>
                </form>
            </div>

                        <!-- Wishes List -->
            <div class="wishes-stream-roman" id="wishesList" data-aos="fade-up">
                <?php if (!empty($wishes)): ?>
                    <?php foreach ($wishes as $w): ?>
                        <?php
                            $wName = htmlspecialchars($w['name'] ?? 'Tamu Undangan');
                            $wMsg = nl2br(htmlspecialchars($w['message'] ?? ''));
                            $wStatus = $w['attendance'] ?? ($w['attendance_status'] ?? 'attending');
                            $wPax = (int)($w['pax'] ?? ($w['attendance_count'] ?? 1));
                            $badgeCls = match($wStatus) {
                                'attending' => 'badge-hadir',
                                'maybe' => 'badge-ragu',
                                default => 'badge-tidak'
                            };
                            $badgeLbl = match($wStatus) {
                                'attending' => 'Hadir (' . $wPax . ')',
                                'maybe' => 'Ragu',
                                default => 'Tidak Hadir'
                            };
                        ?>
                        <div class="wish-roman-bubble">
                            <div class="wish-roman-header">
                                <div class="wish-roman-name"><?= $wName ?></div>
                                <span class="wish-roman-badge <?= $badgeCls ?>"><?= $badgeLbl ?></span>
                            </div>
                            <div class="wish-roman-text"><?= $wMsg ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="wish-roman-bubble">
                        <div class="wish-roman-header">
                            <div class="wish-roman-name">Julius Caesar &amp; Family</div>
                            <span class="wish-roman-badge badge-hadir">Hadir (2)</span>
                        </div>
                        <div class="wish-roman-text">
                            Congratulations dearest <?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?>! May your marriage be blessed with endless happiness, love, and prosperity forever!
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- WEDDING GIFT -->
        <section class="section-block" id="secGift">
            <div class="sec-header" data-aos="fade-up">
                <span class="sec-sub">Token of Love</span>
                <h2 class="sec-title">Wedding Gift</h2>
                <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-55.png" alt="Divider" class="roman-divider">
            </div>

            <!-- Bank BCA -->
            <div class="gift-card-royal" data-aos="fade-up">
                <div class="gift-top-row">
                    <div class="bank-badge">BCA</div>
                    <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-1.png" alt="Emblem" style="width: 32px; height: auto;">
                </div>
                <div class="acc-number-text" id="bcaNum">8210984421</div>
                <div class="acc-holder-text">a.n. Stevan Ritoni</div>
                <button type="button" class="btn-copy-gold" onclick="copyToClipboard('8210984421', 'Nomor Rekening BCA')">
                    <i class="bi bi-clipboard"></i> Salin Rekening
                </button>
            </div>

            <!-- Bank Mandiri -->
            <div class="gift-card-royal" data-aos="fade-up" data-aos-delay="100">
                <div class="gift-top-row">
                    <div class="bank-badge">MANDIRI</div>
                    <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-1.png" alt="Emblem" style="width: 32px; height: auto;">
                </div>
                <div class="acc-number-text" id="mandiriNum">1370019283741</div>
                <div class="acc-holder-text">a.n. Sophia Anjelita</div>
                <button type="button" class="btn-copy-gold" onclick="copyToClipboard('1370019283741', 'Nomor Rekening Mandiri')">
                    <i class="bi bi-clipboard"></i> Salin Rekening
                </button>
            </div>
        </section>

        <!-- CLOSING FOOTER -->
        <footer class="footer-roman" id="secFooter">
            <img src="https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-1.png" alt="Emblem" class="footer-emblem">
            <p style="font-size: 0.88rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 20px;">
                Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu kepada kami.
            </p>
            <div style="font-size: 0.85rem; letter-spacing: 2px; color: var(--roman-gold-light); text-transform: uppercase;">Kami yang berbahagia,</div>
            <div class="footer-sig-couple"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></div>
            <div style="font-size: 0.78rem; color: var(--text-muted);">Beserta segenap keluarga besar</div>

            <div style="font-size: 0.72rem; letter-spacing: 2px; color: rgba(255, 255, 255, 0.3); text-transform: uppercase; margin-top: 35px;">
                Romano Theme • Pendar Loka
            </div>
        </footer>

    </div><!-- /.invitation-frame -->

    <!-- FLOATING MUSIC BUTTON -->
    <div class="music-float-btn" id="musicToggleBtn" title="Play/Pause Music">
        <i class="bi bi-music-note-beamed" id="musicIcon"></i>
    </div>

    <!-- FLOATING BOTTOM NAV DOCK -->
    <div class="nav-dock-roman" id="navDock">
        <a href="#secHero" class="nav-dock-item active">
            <i class="bi bi-house-door"></i>
            <span class="nav-dock-label">Home</span>
        </a>
        <a href="#secCouple" class="nav-dock-item">
            <i class="bi bi-heart"></i>
            <span class="nav-dock-label">Couple</span>
        </a>
        <a href="#secEvent" class="nav-dock-item">
            <i class="bi bi-calendar2-event"></i>
            <span class="nav-dock-label">Event</span>
        </a>
        <a href="#secGallery" class="nav-dock-item">
            <i class="bi bi-images"></i>
            <span class="nav-dock-label">Gallery</span>
        </a>
        <a href="#secRsvp" class="nav-dock-item">
            <i class="bi bi-chat-heart"></i>
            <span class="nav-dock-label">Wishes</span>
        </a>
        <a href="#secGift" class="nav-dock-item">
            <i class="bi bi-gift"></i>
            <span class="nav-dock-label">Gift</span>
        </a>
    </div>

    <!-- FLOATING ADMIN ASSET MANAGER BUTTON -->
    <div class="floating-admin-trigger" id="adminTriggerBtn" title="Admin Asset Manager">
        <i class="bi bi-sliders2-vertical"></i>
    </div>

    <!-- ADMIN ASSET MANAGER MODAL -->
    <div id="adminAssetModal">
        <div class="admin-modal-card">
            <div class="admin-modal-header">
                <div class="admin-modal-title">
                    <i class="bi bi-shield-shaded me-2"></i> Admin Asset Manager (Romano Luxury)
                </div>
                <button type="button" class="btn-close btn-close-white" id="btnCloseAdminModal"></button>
            </div>

            <div class="admin-modal-body">
                <div class="admin-tabs">
                    <button type="button" class="admin-tab-btn active" data-tab="tabImages">
                        <i class="bi bi-image me-1"></i> Gambar &amp; Pilar
                    </button>
                    <button type="button" class="admin-tab-btn" data-tab="tabAnimations">
                        <i class="bi bi-magic me-1"></i> Animasi
                    </button>
                    <button type="button" class="admin-tab-btn" data-tab="tabMusic">
                        <i class="bi bi-music-note-list me-1"></i> Musik Background
                    </button>
                </div>

                <!-- Tab 1: Images -->
                <div class="admin-tab-pane active" id="tabImages">
                    <div class="admin-field-group">
                        <label class="admin-label">Cover Arch Ornament URL</label>
                        <input type="text" id="admCoverArchUrl" class="admin-input" placeholder="https://...">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Hero Photo URL</label>
                        <input type="text" id="admHeroPhotoUrl" class="admin-input" placeholder="https://...">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Groom Photo URL</label>
                        <input type="text" id="admGroomPhotoUrl" class="admin-input" placeholder="https://...">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Bride Photo URL</label>
                        <input type="text" id="admBridePhotoUrl" class="admin-input" placeholder="https://...">
                    </div>
                </div>

                <!-- Tab 2: Animations -->
                <div class="admin-tab-pane" id="tabAnimations">
                    <div class="admin-field-group">
                        <label class="admin-label">Efek Partikel Layar</label>
                        <select id="admParticleType" class="admin-input">
                            <option value="roman_gold_dust">Kilau Debu Emas Romawi (Gold Dust)</option>
                            <option value="maroon_petals">Kelopak Mawar Burgundy</option>
                            <option value="none">Tanpa Partikel</option>
                        </select>
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Preloader Counter</label>
                        <select id="admPreloaderActive" class="admin-input">
                            <option value="true" selected>Aktif (0% - 100%)</option>
                            <option value="false">Langsung Masuk ke Cover</option>
                        </select>
                    </div>
                </div>

                <!-- Tab 3: Music -->
                <div class="admin-tab-pane" id="tabMusic">
                    <div class="admin-field-group">
                        <label class="admin-label">Pilihan Preset Musik</label>
                        <select id="admAudioPreset" class="admin-input">
                            <option value="preset_romano">ASSET-ROME-SONG (Original Romano Theme by Tibra)</option>
                            <option value="preset_sotya">Sotya Dangdut Javanese</option>
                            <option value="preset_thousand">A Thousand Years (Classical String Orchestra)</option>
                            <option value="custom">Gunakan URL MP3 Sendiri</option>
                        </select>
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Custom MP3 Audio URL</label>
                        <input type="text" id="admAudioCustomUrl" class="admin-input" placeholder="https://domain.com/music.mp3">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Volume Suara (0 - 100%)</label>
                        <input type="range" id="admAudioVolume" class="form-range" min="0" max="100" value="85">
                    </div>
                </div>
            </div>

            <div class="admin-modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" id="btnResetAdminDefaults">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset Default
                </button>
                <button type="button" class="btn btn-sm btn-warning text-dark px-4 fw-bold" id="btnSaveAdminAssets">
                    <i class="bi bi-check2-circle"></i> Simpan &amp; Terapkan
                </button>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div id="copyToast" style="position: fixed; bottom: 80px; left: 50%; transform: translateX(-50%) translateY(100px); background: #280D12; border: 1px solid var(--roman-gold); color: #FAF4EB; padding: 12px 24px; border-radius: 30px; font-size: 0.85rem; box-shadow: 0 10px 25px rgba(0,0,0,0.8); z-index: 99999; opacity: 0; transition: all 0.4s ease; pointer-events: none;">
        <i class="bi bi-check-circle-fill text-warning me-2"></i> <span id="toastMsg">Teks berhasil disalin!</span>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        // ROMANO THEME DEFAULT CONFIG
        const ROMANO_DEFAULT_CONFIG = {
            coverArchUrl: 'https://tibrainvitation.id/wp-content/uploads/2026/10/ASSET-ROME-45.png',
            heroPhoto: 'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-16.jpg',
            groomPhoto: 'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-14.jpg',
            bridePhoto: 'https://tibrainvitation.id/wp-content/uploads/2026/11/BG-SS-17.jpg',
            
            particleType: 'roman_gold_dust',
            preloaderActive: 'true',

            audioPreset: 'preset_romano',
            audioUrl: 'https://tibrainvitation.id/wp-content/uploads/2026/11/ASSET-ROME-SONG.mp3',
            audioVolume: 85,

            targetDate: '2027-02-14T09:00:00'
        };

        const STORAGE_KEY = 'pendar_romano_luxury_config';
        // Dynamic PHP Config Injection
        const PHP_CONFIG = {
            groomName: <?= json_encode($gNick) ?>,
            brideName: <?= json_encode($bNick) ?>,
            targetDate: <?= json_encode($eventIsoDate) ?>,
            musicUrl: <?= json_encode($musicUrl) ?>,
            groomPhoto: <?= json_encode($groomPhoto) ?>,
            bridePhoto: <?= json_encode($bridePhoto) ?>,
            heroPhoto: <?= json_encode($heroPhoto) ?>,
            rsvpUrl: <?= json_encode($rsvpTargetUrl) ?>
        };

        if (PHP_CONFIG.musicUrl) ROMANO_DEFAULT_CONFIG.audioUrl = PHP_CONFIG.musicUrl;
        if (PHP_CONFIG.groomPhoto) ROMANO_DEFAULT_CONFIG.groomPhoto = PHP_CONFIG.groomPhoto;
        if (PHP_CONFIG.bridePhoto) ROMANO_DEFAULT_CONFIG.bridePhoto = PHP_CONFIG.bridePhoto;
        if (PHP_CONFIG.heroPhoto) ROMANO_DEFAULT_CONFIG.heroPhoto = PHP_CONFIG.heroPhoto;
        if (PHP_CONFIG.targetDate) ROMANO_DEFAULT_CONFIG.targetDate = PHP_CONFIG.targetDate;
        let activeConfig = { ...ROMANO_DEFAULT_CONFIG };

        try {
            const saved = localStorage.getItem(STORAGE_KEY);
            if (saved) activeConfig = { ...activeConfig, ...JSON.parse(saved) };
        } catch(e) {}

        // AOS Init
        AOS.init({ once: true, offset: 40, duration: 800, easing: 'ease-out-cubic' });

        // Query Param Guest Name (?to=... or ?kpd=...)
        const urlParams = new URLSearchParams(window.location.search);
        const guestFromUrl = urlParams.get('to') || urlParams.get('kpd');
        if (guestFromUrl) {
            const decoded = decodeURIComponent(guestFromUrl.replace(/\+/g, ' '));
            document.getElementById('coverGuestName').textContent = decoded;
            const rsvpName = document.getElementById('rsvpName');
            if (rsvpName) rsvpName.value = decoded;
        }

        // Apply Images & Audio to DOM
        function applyAssetsToDOM() {
            if (document.getElementById('coverArchImg')) document.getElementById('coverArchImg').src = activeConfig.coverArchUrl;
            if (document.getElementById('heroPhotoImg')) document.getElementById('heroPhotoImg').src = activeConfig.heroPhoto;
            if (document.getElementById('groomPhotoImg')) document.getElementById('groomPhotoImg').src = activeConfig.groomPhoto;
            if (document.getElementById('bridePhotoImg')) document.getElementById('bridePhotoImg').src = activeConfig.bridePhoto;

            const audioEl = document.getElementById('bgMusic');
            if (audioEl) {
                audioEl.src = activeConfig.audioUrl;
                audioEl.volume = (activeConfig.audioVolume || 85) / 100;
            }
        }

        // Preloader 0% -> 100%
        function startPreloader() {
            const preloader = document.getElementById('preloaderRomano');
            const countEl = document.getElementById('preloaderCount');
            const barFill = document.getElementById('preloaderBar');

            if (activeConfig.preloaderActive === 'false') {
                preloader.style.display = 'none';
                return;
            }

            let progress = 0;
            const timer = setInterval(() => {
                progress += Math.floor(Math.random() * 8) + 4;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(timer);
                    countEl.textContent = '100%';
                    barFill.style.width = '100%';
                    setTimeout(() => {
                        preloader.classList.add('fade-out');
                    }, 400);
                } else {
                    countEl.textContent = progress + '%';
                    barFill.style.width = progress + '%';
                }
            }, 60);
        }

        // Toast Helper
        function copyToClipboard(text, label) {
            navigator.clipboard.writeText(text).then(() => {
                showToast(label + ' berhasil disalin!');
            }).catch(() => {
                const t = document.createElement('input');
                t.value = text;
                document.body.appendChild(t);
                t.select();
                document.execCommand('copy');
                document.body.removeChild(t);
                showToast(label + ' berhasil disalin!');
            });
        }

        function showToast(msg) {
            const toast = document.getElementById('copyToast');
            const txt = document.getElementById('toastMsg');
            txt.textContent = msg;
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(-50%) translateY(0)';
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(-50%) translateY(100px)';
            }, 3000);
        }

        // Countdown Timer
        function initCountdown() {
            const target = new Date(activeConfig.targetDate).getTime();
            function update() {
                const now = new Date().getTime();
                const dist = target - now;
                if (dist <= 0) {
                    document.getElementById('cdDays').textContent = '00';
                    document.getElementById('cdHours').textContent = '00';
                    document.getElementById('cdMinutes').textContent = '00';
                    document.getElementById('cdSeconds').textContent = '00';
                    return;
                }
                const d = Math.floor(dist / (1000 * 60 * 60 * 24));
                const h = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((dist % (1000 * 60)) / 1000);

                document.getElementById('cdDays').textContent = d < 10 ? '0' + d : d;
                document.getElementById('cdHours').textContent = h < 10 ? '0' + h : h;
                document.getElementById('cdMinutes').textContent = m < 10 ? '0' + m : m;
                document.getElementById('cdSeconds').textContent = s < 10 ? '0' + s : s;
            }
            update();
            setInterval(update, 1000);
        }

        // Music Controls
        let isMusicPlaying = false;
        const audioEl = document.getElementById('bgMusic');
        const musicBtn = document.getElementById('musicToggleBtn');
        const musicIcon = document.getElementById('musicIcon');

        function toggleMusic() {
            if (!audioEl) return;
            if (audioEl.paused) {
                audioEl.play().then(() => {
                    isMusicPlaying = true;
                    musicBtn.classList.add('playing');
                    musicIcon.className = 'bi bi-disc';
                }).catch(err => console.log(err));
            } else {
                audioEl.pause();
                isMusicPlaying = false;
                musicBtn.classList.remove('playing');
                musicIcon.className = 'bi bi-play-fill';
            }
        }

        if (musicBtn) musicBtn.addEventListener('click', toggleMusic);

        // Open Invitation
        const btnOpen = document.getElementById('btnOpenRomano');
        const coverOverlay = document.getElementById('coverOverlay');

        if (btnOpen) {
            btnOpen.addEventListener('click', () => {
                coverOverlay.classList.add('unlocked');
                document.body.style.overflow = 'auto';

                if (audioEl) {
                    audioEl.play().then(() => {
                        isMusicPlaying = true;
                        musicBtn.classList.add('playing');
                        musicIcon.className = 'bi bi-disc';
                    }).catch(e => console.log(e));
                }

                setTimeout(() => {
                    document.getElementById('secHero').scrollIntoView({ behavior: 'smooth' });
                    AOS.refresh();
                }, 300);
            });
        }

        // Particle Canvas
        const canvas = document.getElementById('particleCanvas');
        const ctx = canvas.getContext('2d');
        let particles = [];

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        function initParticles() {
            particles = [];
            if (activeConfig.particleType === 'none') return;
            const count = 40;
            for (let i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: Math.random() * 4 + 2,
                    speedY: Math.random() * 1.2 + 0.4,
                    speedX: (Math.random() - 0.5) * 0.8,
                    opacity: Math.random() * 0.6 + 0.2
                });
            }
        }

        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (activeConfig.particleType !== 'none') {
                particles.forEach(p => {
                    p.y += p.speedY;
                    p.x += p.speedX;
                    if (p.y > canvas.height + 10) {
                        p.y = -10;
                        p.x = Math.random() * canvas.width;
                    }
                    ctx.save();
                    ctx.globalAlpha = p.opacity;
                    ctx.fillStyle = activeConfig.particleType === 'maroon_petals' ? '#871424' : '#D4AF37';
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                });
            }
            requestAnimationFrame(drawParticles);
        }

        // RSVP Submit
        const rsvpForm = document.getElementById('rsvpForm');
        if (rsvpForm) {
            rsvpForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('rsvpName').value.trim();
                const attendance = document.getElementById('rsvpAttendance').value;
                const pax = document.getElementById('rsvpPax').value;
                const message = document.getElementById('rsvpMessage').value.trim();

                const btn = document.getElementById('btnSubmitRsvp');
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Mengirimkan...';
                btn.disabled = true;

                const bubble = document.createElement('div');
                bubble.className = 'wish-roman-bubble';
                const badgeCls = attendance === 'attending' ? 'badge-hadir' : (attendance === 'maybe' ? 'badge-ragu' : 'badge-tidak');
                const badgeTxt = attendance === 'attending' ? `Hadir (${pax})` : (attendance === 'maybe' ? 'Ragu' : 'Tidak Hadir');

                bubble.innerHTML = `
                    <div class="wish-roman-header">
                        <div class="wish-roman-name">${name}</div>
                        <span class="wish-roman-badge ${badgeCls}">${badgeTxt}</span>
                    </div>
                    <div class="wish-roman-text">${message}</div>
                `;

                const list = document.getElementById('wishesList');
                if (list) list.prepend(bubble);

                showToast('Terima kasih! Konfirmasi & doa Anda telah terkirim.');
                rsvpForm.reset();
                btn.innerHTML = '<i class="bi bi-send-fill me-1"></i> Kirim Konfirmasi &amp; Doa';
                btn.disabled = false;
            });
        }

        // Admin Modal Controls
        const adminModal = document.getElementById('adminAssetModal');
        const adminTrigger = document.getElementById('adminTriggerBtn');
        const btnCloseModal = document.getElementById('btnCloseAdminModal');
        const btnSaveAssets = document.getElementById('btnSaveAdminAssets');
        const btnResetDefaults = document.getElementById('btnResetAdminDefaults');

        if (urlParams.get('admin') === 'true') openAdminModal();
        if (adminTrigger) adminTrigger.addEventListener('click', openAdminModal);
        if (btnCloseModal) btnCloseModal.addEventListener('click', closeAdminModal);

        function openAdminModal() {
            document.getElementById('admCoverArchUrl').value = activeConfig.coverArchUrl;
            document.getElementById('admHeroPhotoUrl').value = activeConfig.heroPhoto;
            document.getElementById('admGroomPhotoUrl').value = activeConfig.groomPhoto;
            document.getElementById('admBridePhotoUrl').value = activeConfig.bridePhoto;
            document.getElementById('admParticleType').value = activeConfig.particleType;
            document.getElementById('admPreloaderActive').value = activeConfig.preloaderActive;
            document.getElementById('admAudioPreset').value = activeConfig.audioPreset;
            document.getElementById('admAudioCustomUrl').value = activeConfig.audioUrl;
            document.getElementById('admAudioVolume').value = activeConfig.audioVolume;
            adminModal.classList.add('show');
        }

        function closeAdminModal() {
            adminModal.classList.remove('show');
        }

        document.querySelectorAll('.admin-tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.admin-tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.admin-tab-pane').forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                document.getElementById(this.getAttribute('data-tab')).classList.add('active');
            });
        });

        if (btnSaveAssets) {
            btnSaveAssets.addEventListener('click', () => {
                const newCfg = {
                    ...activeConfig,
                    coverArchUrl: document.getElementById('admCoverArchUrl').value.trim() || ROMANO_DEFAULT_CONFIG.coverArchUrl,
                    heroPhoto: document.getElementById('admHeroPhotoUrl').value.trim() || ROMANO_DEFAULT_CONFIG.heroPhoto,
                    groomPhoto: document.getElementById('admGroomPhotoUrl').value.trim() || ROMANO_DEFAULT_CONFIG.groomPhoto,
                    bridePhoto: document.getElementById('admBridePhotoUrl').value.trim() || ROMANO_DEFAULT_CONFIG.bridePhoto,
                    particleType: document.getElementById('admParticleType').value,
                    preloaderActive: document.getElementById('admPreloaderActive').value,
                    audioPreset: document.getElementById('admAudioPreset').value,
                    audioUrl: document.getElementById('admAudioCustomUrl').value.trim() || ROMANO_DEFAULT_CONFIG.audioUrl,
                    audioVolume: parseInt(document.getElementById('admAudioVolume').value) || 85
                };
                localStorage.setItem(STORAGE_KEY, JSON.stringify(newCfg));
                alert('✔ Pengaturan asset Romano berhasil disimpan! Halaman dimuat ulang.');
                window.location.reload();
            });
        }

        if (btnResetDefaults) {
            btnResetDefaults.addEventListener('click', () => {
                if (confirm('Kembalikan semua konfigurasi ke setelan default Romano Theme?')) {
                    localStorage.removeItem(STORAGE_KEY);
                    window.location.reload();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            applyAssetsToDOM();
            startPreloader();
            initCountdown();
            initParticles();
            drawParticles();
        });
    </script>
</body>
</html>