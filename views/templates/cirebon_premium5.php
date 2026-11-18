<?php
// views/templates/cirebon_premium5.php
// Inspired by https://undanganvideocirebon.com/premium-5/
// Dark Crimson Romantic & Rich Charcoal Luxury Wedding Theme
// With Dynamic Asset Manager (Images, Animations, and Background Music)

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];
$loveStories = json_decode($event['love_story_json'] ?? '[]', true) ?: [];

// Fallback high-res prewedding gallery
if (empty($galleries)) {
    $galleries = [
        'https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-7-1.jpeg',
        'https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-9.jpeg',
        'https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-3-1.jpeg',
        'https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-13.jpeg',
        'https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-14.jpeg',
        'https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-2.jpeg'
    ];
}

$gNick = !empty($event['groom_nickname']) ? trim($event['groom_nickname']) : 'Putra';
$bNick = !empty($event['bride_nickname']) ? trim($event['bride_nickname']) : 'Putri';
$gName = !empty($event['groom_name']) ? trim($event['groom_name']) : 'Putra Bagus Pamungkas, S.T.';
$bName = !empty($event['bride_name']) ? trim($event['bride_name']) : 'Putri Sekar Wangi, S.Ked';

$gFather = !empty($event['groom_father']) ? $event['groom_father'] : 'Bpk. Ir. Bambang Joyo';
$gMother = !empty($event['groom_mother']) ? $event['groom_mother'] : 'Ibu Hj. Siti Rahayu';
$bFather = !empty($event['bride_father']) ? $event['bride_father'] : 'Bpk. H. Hendro Kusumo';
$bMother = !empty($event['bride_mother']) ? $event['bride_mother'] : 'Ibu Hj. Sri Wahyuningsih';

$gInsta = !empty($event['groom_instagram']) ? trim($event['groom_instagram']) : 'putra.bagus';
$bInsta = !empty($event['bride_instagram']) ? trim($event['bride_instagram']) : 'putri.sekar';

$guestDisplayName = !empty($guestName) ? $guestName : 'Bapak / Ibu / Saudara(i)';
$musicUrl = !empty($event['music_url']) ? media_url($event['music_url']) : 'https://cdn.freesound.org/previews/469/469009_9518146-lq.mp3';

$eventDateTimestamp = strtotime($event['event_date'] ?? '+30 days');
$eventDateFormatted = date('d F Y', $eventDateTimestamp);
$eventIsoDate = date('Y-m-d\TH:i:s', $eventDateTimestamp);

$akadTime = !empty($event['akad_time']) ? $event['akad_time'] : '08:00 WIB - Selesai';
$akadLocation = !empty($event['akad_location']) ? $event['akad_location'] : 'Kediaman Mempelai Wanita';
$akadAddress = !empty($event['akad_address']) ? $event['akad_address'] : 'Desa Jatimerta Blok Maja RT 002 / RW 005, Kec. Gunungjati, Kab. Cirebon';

$resepsiTime = !empty($event['resepsi_time']) ? $event['resepsi_time'] : '11:00 - 14:00 WIB';
$resepsiLocation = !empty($event['resepsi_location']) ? $event['resepsi_location'] : 'Kediaman Mempelai Wanita';
$resepsiAddress = !empty($event['resepsi_address']) ? $event['resepsi_address'] : 'Desa Jatimerta Blok Maja RT 002 / RW 005, Kec. Gunungjati, Kab. Cirebon';

$groomPhoto = !empty($event['groom_photo']) ? media_url($event['groom_photo']) : 'https://undanganvideocirebon.com/wp-content/uploads/2026/09/Picturez3.png';
$bridePhoto = !empty($event['bride_photo']) ? media_url($event['bride_photo']) : 'https://undanganvideocirebon.com/wp-content/uploads/2026/09/xz.png';
$heroPhoto = !empty($event['hero_photo']) ? media_url($event['hero_photo']) : (!empty($event['cover_photo']) ? media_url($event['cover_photo']) : 'https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-5-1.jpeg');
$coverPhoto = !empty($event['cover_photo']) ? media_url($event['cover_photo']) : $heroPhoto;

$quoteText = !empty($event['quote']) ? $event['quote'] : 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berfikir.';
$quoteSource = !empty($event['quote_source']) ? $event['quote_source'] : 'Surat Ar-Rum Ayat 21';

$rsvpTargetUrl = base_url('u/' . ($event['slug'] ?? 'demo') . '/rsvp');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="pageTitle"><?= htmlspecialchars($event['title'] ?? ('The Wedding of ' . $gNick . ' & ' . $bNick)) ?></title>

    <!-- Favicon -->
    <link rel="icon" href="https://undanganvideocirebon.com/wp-content/uploads/2026/07/IMG_6013.png" type="image/png">

    <!-- Google Fonts: Cormorant Infant, Bacasime Antique, Ibarra Real Nova, Pinyon Script, Suranna, Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Cormorant+Infant:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Ibarra+Real+Nova:ital,wght@0,400;0,600;0,700;1,400&family=Pinyon+Script&family=Poppins:wght@300;400;500;600;700&family=Suranna&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            /* Palette: Dark Crimson & Rich Charcoal Luxury */
            --bg-body: #070707;
            --bg-dark: #0D0D0D;
            --bg-deep: #140505;
            --bg-card: #1A0D0D;
            --bg-card-glass: rgba(26, 13, 13, 0.85);
            --bg-card-border: rgba(178, 65, 60, 0.25);
            
            --crimson-primary: #7A0000;
            --crimson-deep: #5F0000;
            --crimson-accent: #B2413C;
            --crimson-light: #E06C67;
            --crimson-gradient: linear-gradient(135deg, #B2413C 0%, #7A0000 60%, #450000 100%);
            
            --text-cream: #F6EFEA;
            --text-muted: #B8A89C;
            --text-gold: #D4AF37;
            --gold-subtle: #C5A059;
            
            --border-subtle: rgba(246, 239, 234, 0.12);
            --border-crimson: rgba(178, 65, 60, 0.35);
            --border-crimson-glow: rgba(178, 65, 60, 0.7);
            
            --radius-card: 18px;
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
            background-color: var(--bg-body);
            color: var(--text-cream);
            line-height: 1.8;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Typography */
        .font-cormorant { font-family: 'Cormorant Infant', serif; }
        .font-bacasime { font-family: 'Bacasime Antique', serif; }
        .font-ibarra { font-family: 'Ibarra Real Nova', serif; }
        .font-script { font-family: 'Pinyon Script', cursive; }
        .font-suranna { font-family: 'Suranna', serif; }

        /* Container Limit (Mobile-First Luxury Editorial) */
        .invitation-frame {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            background-color: var(--bg-deep);
            background-image: 
                radial-gradient(circle at 50% 0%, rgba(122, 0, 0, 0.35) 0%, transparent 70%),
                radial-gradient(circle at 50% 100%, rgba(122, 0, 0, 0.25) 0%, transparent 60%);
            box-shadow: 0 0 60px rgba(0, 0, 0, 0.95), 0 0 30px rgba(178, 65, 60, 0.15);
            min-height: 100vh;
            border-left: 1px solid var(--border-crimson);
            border-right: 1px solid var(--border-crimson);
            overflow: hidden;
            z-index: 2;
        }

        /* Ambient Texture Overlay */
        .texture-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: radial-gradient(circle at 50% 50%, rgba(122, 0, 0, 0.12) 0%, transparent 80%);
            pointer-events: none;
            z-index: 1;
        }

        /* Swaying Botanical Leaf Animations */
        .sway-left {
            transform-origin: left top;
            animation: animSwayLeft 5s ease-in-out infinite;
        }
        .sway-right {
            transform-origin: right top;
            animation: animSwayRight 5s ease-in-out infinite;
        }
        @keyframes animSwayLeft {
            0% { transform: rotate(0deg); }
            50% { transform: rotate(-5deg); }
            100% { transform: rotate(0deg); }
        }
        @keyframes animSwayRight {
            0% { transform: rotate(0deg); }
            50% { transform: rotate(5deg); }
            100% { transform: rotate(0deg); }
        }

        /* Particle Canvas */
        #particleCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 3;
        }

        /* COVER / SPLASH SCREEN */
        #coverOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(180deg, rgba(7, 7, 7, 0.75) 0%, rgba(20, 5, 5, 0.92) 50%, rgba(7, 7, 7, 0.98) 100%),
                        url('https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-5-1.jpeg') center center / cover no-repeat;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 1s cubic-bezier(0.77, 0, 0.175, 1), opacity 0.8s ease;
        }

        #coverOverlay.unlocked {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        .cover-box {
            width: 90%;
            max-width: 440px;
            text-align: center;
            padding: 40px 25px;
            background: rgba(13, 13, 13, 0.75);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(178, 65, 60, 0.4);
            border-radius: 28px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8), 0 0 35px rgba(178, 65, 60, 0.2);
            position: relative;
            animation: fadeInZoom 1.2s ease-out;
        }

        @keyframes fadeInZoom {
            from { opacity: 0; transform: scale(0.92); }
            to { opacity: 1; transform: scale(1); }
        }

        .cover-monogram {
            width: 80px;
            height: auto;
            margin-bottom: 18px;
            filter: drop-shadow(0 4px 10px rgba(178, 65, 60, 0.4));
        }

        .cover-tagline {
            font-family: 'Ibarra Real Nova', serif;
            font-size: 0.9rem;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: var(--crimson-accent);
            margin-bottom: 12px;
        }

        .cover-couple {
            font-family: 'Cormorant Infant', serif;
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--text-cream);
            line-height: 1.15;
            margin-bottom: 8px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.9);
        }

        .cover-date {
            font-family: 'Bacasime Antique', serif;
            font-size: 1.1rem;
            letter-spacing: 3px;
            color: var(--gold-subtle);
            margin-bottom: 25px;
        }

        .guest-pill {
            background: rgba(38, 10, 10, 0.65);
            border: 1px solid rgba(178, 65, 60, 0.3);
            border-radius: 16px;
            padding: 14px 18px;
            margin-bottom: 28px;
        }

        .guest-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .guest-name {
            font-family: 'Cormorant Infant', serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-cream);
        }

        .btn-open-invitation {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--crimson-gradient);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 14px 34px;
            font-family: 'Ibarra Real Nova', serif;
            font-size: 0.95rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            border-radius: var(--radius-pill);
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(122, 0, 0, 0.6);
            transition: var(--transition-smooth);
            cursor: pointer;
        }

        .btn-open-invitation:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 12px 35px rgba(178, 65, 60, 0.8);
            color: #fff;
        }

        /* SECTION COMMON */
        .section-block {
            padding: 60px 22px;
            position: relative;
        }

        .section-title-wrap {
            text-align: center;
            margin-bottom: 35px;
            position: relative;
        }

        .section-subtitle {
            font-family: 'Ibarra Real Nova', serif;
            font-size: 0.85rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--crimson-accent);
            margin-bottom: 6px;
            display: block;
        }

        .section-title {
            font-family: 'Cormorant Infant', serif;
            font-size: 2.3rem;
            font-weight: 600;
            color: var(--text-cream);
            line-height: 1.2;
        }

        .ornament-corner {
            position: absolute;
            width: 75px;
            height: auto;
            pointer-events: none;
            opacity: 0.85;
            z-index: 1;
        }
        .ornament-top-left { top: 0; left: 0; }
        .ornament-top-right { top: 0; right: 0; transform: scaleX(-1); }
        .ornament-bottom-left { bottom: 0; left: 0; transform: scaleY(-1); }
        .ornament-bottom-right { bottom: 0; right: 0; transform: scale(-1); }

        /* HERO MAIN SECTION */
        .hero-main {
            text-align: center;
            padding: 70px 20px 50px;
            position: relative;
        }

        .hero-monogram {
            width: 70px;
            margin-bottom: 16px;
        }

        .hero-pretitle {
            font-family: 'Ibarra Real Nova', serif;
            font-size: 0.9rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--crimson-accent);
            margin-bottom: 8px;
        }

        .hero-couple {
            font-family: 'Cormorant Infant', serif;
            font-size: 2.7rem;
            font-weight: 600;
            color: var(--text-cream);
            margin-bottom: 6px;
        }

        .hero-date {
            font-family: 'Bacasime Antique', serif;
            font-size: 1.05rem;
            letter-spacing: 3px;
            color: var(--gold-subtle);
            margin-bottom: 30px;
        }

        .hero-photo-frame {
            position: relative;
            width: 82%;
            max-width: 320px;
            margin: 0 auto;
            border-radius: 180px 180px 25px 25px;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.8), 0 0 25px rgba(178, 65, 60, 0.3);
            border: 2px solid rgba(178, 65, 60, 0.4);
        }

        .hero-photo-frame img {
            width: 100%;
            height: 380px;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }

        .hero-photo-frame:hover img {
            transform: scale(1.05);
        }

        /* QUOTE / AYAT AR-RUM */
        .quote-card {
            background: var(--bg-card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-crimson);
            border-radius: var(--radius-card);
            padding: 35px 24px;
            text-align: center;
            position: relative;
        }

        .quote-title {
            font-family: 'Cormorant Infant', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--crimson-accent);
            margin-bottom: 16px;
        }

        .quote-arabic {
            font-family: 'Amiri', 'Suranna', serif;
            font-size: 1.25rem;
            line-height: 2.2;
            color: var(--text-cream);
            direction: rtl;
            margin-bottom: 18px;
        }

        .quote-text {
            font-size: 0.9rem;
            font-style: italic;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 14px;
        }

        .quote-surah {
            font-family: 'Ibarra Real Nova', serif;
            font-size: 0.85rem;
            letter-spacing: 2px;
            color: var(--gold-subtle);
            text-transform: uppercase;
        }

        /* COUPLE SECTION */
        .couple-card {
            text-align: center;
            margin-bottom: 45px;
            position: relative;
        }

        .couple-arch-frame {
            width: 220px;
            height: 290px;
            margin: 0 auto 20px;
            border-radius: 120px 120px 20px 20px;
            overflow: hidden;
            border: 2px solid rgba(178, 65, 60, 0.45);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.8), 0 0 20px rgba(122, 0, 0, 0.3);
            position: relative;
        }

        .couple-arch-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .couple-name {
            font-family: 'Cormorant Infant', serif;
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-cream);
            margin-bottom: 6px;
        }

        .couple-parents {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 14px;
            line-height: 1.6;
        }

        .btn-instagram-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            background: rgba(38, 10, 10, 0.6);
            border: 1px solid rgba(178, 65, 60, 0.4);
            color: var(--text-cream);
            font-size: 0.82rem;
            border-radius: var(--radius-pill);
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .btn-instagram-pill:hover {
            background: var(--crimson-accent);
            color: #fff;
            transform: translateY(-2px);
        }

        .couple-ampersand {
            font-family: 'Pinyon Script', cursive;
            font-size: 3.8rem;
            color: var(--crimson-accent);
            text-align: center;
            line-height: 1;
            margin: 10px 0 35px;
            text-shadow: 0 0 20px rgba(178, 65, 60, 0.5);
        }

        /* COUNTDOWN & SCHEDULE */
        .countdown-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 25px 0 35px;
        }

        .countdown-box {
            background: var(--bg-card-glass);
            border: 1px solid rgba(178, 65, 60, 0.35);
            border-radius: 14px;
            padding: 12px 10px;
            min-width: 68px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        }

        .countdown-num {
            font-family: 'Bacasime Antique', serif;
            font-size: 1.7rem;
            font-weight: 600;
            color: var(--text-cream);
            line-height: 1;
            margin-bottom: 4px;
        }

        .countdown-lbl {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--crimson-accent);
        }

        /* EVENT CARDS */
        .event-card {
            background: var(--bg-card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-crimson);
            border-radius: var(--radius-card);
            padding: 32px 22px;
            text-align: center;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.6);
        }

        .event-card-title {
            font-family: 'Cormorant Infant', serif;
            font-size: 1.9rem;
            font-weight: 600;
            color: var(--crimson-accent);
            margin-bottom: 12px;
        }

        .event-date-text {
            font-family: 'Ibarra Real Nova', serif;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-cream);
            margin-bottom: 4px;
        }

        .event-time-text {
            font-size: 0.88rem;
            color: var(--gold-subtle);
            margin-bottom: 16px;
        }

        .event-venue-name {
            font-family: 'Cormorant Infant', serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-cream);
            margin-bottom: 4px;
        }

        .event-venue-addr {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 22px;
            line-height: 1.6;
        }

        .btn-event-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: var(--crimson-gradient);
            color: #fff;
            border-radius: var(--radius-pill);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 1px;
            box-shadow: 0 6px 18px rgba(122, 0, 0, 0.5);
            transition: var(--transition-smooth);
            margin: 4px;
        }

        .btn-event-action:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(178, 65, 60, 0.7);
        }

        /* LOVE STORY TIMELINE */
        .story-timeline {
            position: relative;
            padding-left: 20px;
        }

        .story-timeline::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 15px;
            bottom: 15px;
            width: 2px;
            background: linear-gradient(180deg, var(--crimson-accent) 0%, rgba(178, 65, 60, 0.1) 100%);
        }

        .story-item {
            position: relative;
            margin-bottom: 28px;
            padding-left: 20px;
        }

        .story-dot {
            position: absolute;
            left: -18px;
            top: 6px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--crimson-accent);
            box-shadow: 0 0 10px rgba(178, 65, 60, 0.8);
        }

        .story-card {
            background: var(--bg-card-glass);
            border: 1px solid var(--border-crimson);
            border-radius: 14px;
            padding: 20px;
        }

        .story-title {
            font-family: 'Cormorant Infant', serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--crimson-accent);
            margin-bottom: 6px;
        }

        .story-desc {
            font-size: 0.86rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* GALLERY & TEASER VIDEO */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 30px;
        }

        .gallery-item {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            aspect-ratio: 1;
            border: 1px solid rgba(178, 65, 60, 0.3);
            cursor: pointer;
        }

        .gallery-item.span-2 {
            grid-column: span 2;
            aspect-ratio: 16 / 9;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.08);
        }

        .video-teaser-wrap {
            border-radius: 18px;
            overflow: hidden;
            border: 2px solid var(--border-crimson);
            box-shadow: 0 15px 35px rgba(0,0,0,0.7);
            aspect-ratio: 16 / 9;
            background: #000;
        }

        .video-teaser-wrap iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* WEDDING GIFT / CASHLESS */
        .atm-card-wrapper {
            position: relative;
            background: linear-gradient(135deg, #1A0D0D 0%, #2B0B0B 50%, #150505 100%),
                        url('https://undanganvideocirebon.com/wp-content/uploads/2026/01/bg-bank-2-1-1.webp') center/cover;
            border: 1px solid rgba(178, 65, 60, 0.5);
            border-radius: 20px;
            padding: 26px 22px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.8), 0 0 25px rgba(122, 0, 0, 0.3);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .atm-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .atm-chip {
            width: 48px;
            height: auto;
        }

        .bank-logo-img {
            max-height: 32px;
            max-width: 110px;
            object-fit: contain;
            filter: brightness(1.2);
        }

        .atm-acc-number {
            font-family: 'Courier New', Courier, monospace;
            font-size: 1.4rem;
            letter-spacing: 3px;
            font-weight: 700;
            color: #FAF6EF;
            margin-bottom: 8px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.8);
        }

        .atm-acc-holder {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .btn-copy-acc {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            background: rgba(178, 65, 60, 0.35);
            border: 1px solid var(--crimson-accent);
            color: #fff;
            font-size: 0.82rem;
            border-radius: var(--radius-pill);
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .btn-copy-acc:hover {
            background: var(--crimson-accent);
            transform: scale(1.04);
        }

        .gift-address-card {
            background: var(--bg-card-glass);
            border: 1px solid var(--border-crimson);
            border-radius: var(--radius-card);
            padding: 24px 20px;
            text-align: center;
        }

        /* RSVP & WISHES FORM */
        .rsvp-form-card {
            background: var(--bg-card-glass);
            border: 1px solid var(--border-crimson);
            border-radius: var(--radius-card);
            padding: 30px 22px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.6);
            margin-bottom: 30px;
        }

        .form-label-custom {
            font-size: 0.82rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-cream);
            margin-bottom: 6px;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            background: rgba(10, 5, 5, 0.7);
            border: 1px solid rgba(178, 65, 60, 0.35);
            border-radius: 12px;
            padding: 12px 14px;
            color: var(--text-cream);
            font-family: inherit;
            font-size: 0.9rem;
            margin-bottom: 16px;
            outline: none;
            transition: var(--transition-smooth);
        }

        .form-control-custom:focus {
            border-color: var(--crimson-accent);
            box-shadow: 0 0 15px rgba(178, 65, 60, 0.4);
            background: rgba(18, 8, 8, 0.85);
        }

        .btn-submit-rsvp {
            width: 100%;
            padding: 13px;
            background: var(--crimson-gradient);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-pill);
            font-family: 'Ibarra Real Nova', serif;
            font-size: 0.95rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(122, 0, 0, 0.5);
            transition: var(--transition-smooth);
        }

        .btn-submit-rsvp:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(178, 65, 60, 0.8);
        }

        /* WISHES STREAM */
        .wishes-stream-wrap {
            max-height: 380px;
            overflow-y: auto;
            padding-right: 6px;
        }

        .wishes-stream-wrap::-webkit-scrollbar {
            width: 5px;
        }
        .wishes-stream-wrap::-webkit-scrollbar-thumb {
            background: var(--crimson-accent);
            border-radius: 10px;
        }

        .wish-bubble {
            background: rgba(22, 10, 10, 0.7);
            border: 1px solid rgba(178, 65, 60, 0.25);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 14px;
            position: relative;
        }

        .wish-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .wish-name {
            font-family: 'Cormorant Infant', serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--text-cream);
        }

        .wish-badge {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: var(--radius-pill);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-hadir { background: rgba(40, 167, 69, 0.2); color: #4ade80; border: 1px solid rgba(40, 167, 69, 0.4); }
        .badge-tidak { background: rgba(220, 53, 69, 0.2); color: #f87171; border: 1px solid rgba(220, 53, 69, 0.4); }
        .badge-ragu { background: rgba(255, 193, 7, 0.2); color: #facc15; border: 1px solid rgba(255, 193, 7, 0.4); }

        .wish-content {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .wish-time {
            font-size: 0.72rem;
            color: rgba(246, 239, 234, 0.4);
            margin-top: 6px;
            text-align: right;
        }

        /* CLOSING FOOTER */
        .footer-closing {
            text-align: center;
            padding: 60px 22px 90px;
            position: relative;
        }

        .footer-monogram {
            width: 65px;
            margin-bottom: 18px;
        }

        .footer-greeting {
            font-size: 0.88rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 22px;
        }

        .footer-couple-sig {
            font-family: 'Cormorant Infant', serif;
            font-size: 2.2rem;
            font-weight: 600;
            color: var(--text-cream);
            margin-bottom: 8px;
        }

        .footer-watermark {
            font-size: 0.75rem;
            letter-spacing: 1.5px;
            color: rgba(246, 239, 234, 0.35);
            text-transform: uppercase;
            margin-top: 30px;
        }

        /* FLOATING MUSIC BUTTON */
        .music-float-btn {
            position: fixed;
            bottom: 85px;
            right: 20px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--crimson-gradient);
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 20px rgba(122, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
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

        /* FLOATING BOTTOM NAV DOCK */
        .nav-dock {
            position: fixed;
            bottom: 18px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 420px;
            background: rgba(14, 7, 7, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(178, 65, 60, 0.4);
            border-radius: var(--radius-pill);
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 10px 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.9), 0 0 15px rgba(178, 65, 60, 0.2);
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
            color: var(--crimson-accent);
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
            background: #140808;
            border: 1px solid var(--crimson-accent);
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.95), 0 0 35px rgba(178, 65, 60, 0.4);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .admin-modal-header {
            padding: 18px 24px;
            background: #200B0B;
            border-bottom: 1px solid rgba(178, 65, 60, 0.3);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-modal-title {
            font-family: 'Cormorant Infant', serif;
            font-size: 1.4rem;
            color: #fff;
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
            border-bottom: 1px solid rgba(178, 65, 60, 0.25);
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
            color: var(--crimson-accent);
            border-bottom-color: var(--crimson-accent);
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
            color: var(--text-cream);
            margin-bottom: 6px;
        }

        .admin-input {
            width: 100%;
            padding: 10px 14px;
            background: #0A0404;
            border: 1px solid rgba(178, 65, 60, 0.3);
            border-radius: 10px;
            color: #fff;
            font-size: 0.85rem;
        }

        .admin-modal-footer {
            padding: 16px 24px;
            background: #1B0A0A;
            border-top: 1px solid rgba(178, 65, 60, 0.3);
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
            background: rgba(20, 5, 5, 0.85);
            border: 1px solid var(--crimson-accent);
            border-radius: 50%;
            color: var(--crimson-accent);
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
            background: var(--crimson-accent);
            color: #fff;
        }
    </style>
    <?php if (defined('BASE_PATH') && file_exists(BASE_PATH . '/views/partials/live_builder_bridge.php')) { require_once BASE_PATH . '/views/partials/live_builder_bridge.php'; } ?>
</head>
<body>

    <!-- Ambient Texture & Particle Canvas -->
    <div class="texture-overlay"></div>
    <canvas id="particleCanvas"></canvas>

    <!-- Hidden Audio Player (HTML5 & YouTube IFrame Wrapper) -->
    <audio id="bgMusic" loop preload="auto"></audio>
    <div id="youtube-audio" data-video="https://youtu.be/I0oV1BtmLIs" data-autoplay="1" data-loop="1" style="display:none;"></div>

    <!-- COVER SCREEN (SPLASH SCREEN / PRELOADER) -->
    <div id="coverOverlay">
        <div class="cover-box">
            <img id="coverMonogramImg" src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/IMG_6013.png" alt="Monogram" class="cover-monogram">
            <span class="cover-tagline">Wedding Invitation</span>
            <h1 class="cover-couple" id="coverCoupleNames"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></h1>
            <div class="cover-date" id="coverDateText">09 . 09 . 2026</div>

            <div class="guest-pill">
                <div class="guest-label">Kepada Yth. Bapak/Ibu/Saudara/i:</div>
                <div class="guest-name" id="coverGuestName"><?= htmlspecialchars($guestDisplayName) ?></div>
            </div>

            <button type="button" class="btn-open-invitation" id="btnOpenInvitation">
                <i class="bi bi-envelope-open-heart"></i>
                <span>OPEN INVITATION</span>
            </button>
        </div>
    </div>

    <!-- INVITATION WRAPPER (MOBILE-FIRST FRAME) -->
    <div class="invitation-frame">

        <!-- HERO MAIN SECTION -->
        <section class="hero-main" id="secHero">
            <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/09/sf-e1790341628715.png" alt="Leaf" class="ornament-corner ornament-top-left sway-left">
            <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/09/sf-e1790341628715.png" alt="Leaf" class="ornament-corner ornament-top-right sway-right">

            <div data-aos="fade-down" data-aos-duration="1000">
                <img id="heroMonogramImg" src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/IMG_6013.png" alt="Monogram" class="hero-monogram">
                <span class="hero-pretitle">The Wedding of</span>
                <h2 class="hero-couple" id="heroCoupleNames"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></h2>
                <div class="hero-date" id="heroDateText">19 . 04 . 2026</div>
            </div>

            <div class="hero-photo-frame" data-aos="zoom-in" data-aos-duration="1200">
                <img id="heroPhotoImg" src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-5-1.jpeg" alt="Couple Hero">
            </div>
        </section>

        <!-- QUOTE AR-RUM SECTION -->
        <section class="section-block" id="secQuote">
            <div class="quote-card" data-aos="fade-up" data-aos-duration="1000">
                <h3 class="quote-title">We Found Love</h3>
                <div class="quote-arabic">وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا لِّتَسْكُنُوا إِلَيْهَا وَجَعَلَ بَيْنَكُم مَّوَدَّةً وَرَحْمَةً</div>
                <p class="quote-text">
                    "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berfikir."
                </p>
                <div class="quote-surah">— Surat Ar-Rum Ayat 21 —</div>
            </div>
        </section>

        <!-- THE COUPLE (WE ARE GETTING MARRIED !) -->
        <section class="section-block" id="secCouple">
            <div class="section-title-wrap" data-aos="fade-up">
                <span class="section-subtitle">Groom &amp; Bride</span>
                <h2 class="section-title">We Are Getting Married !</h2>
            </div>

            <!-- Bride -->
            <div class="couple-card" data-aos="fade-up" data-aos-duration="1000">
                <div class="couple-arch-frame">
                    <img id="bridePhotoImg" src="https://undanganvideocirebon.com/wp-content/uploads/2026/09/xz.png" alt="Mempelai Wanita">
                </div>
                <h3 class="couple-name" id="brideFullName"><?= htmlspecialchars($bName) ?></h3>
                <p class="couple-parents" id="brideParentsText">
                    Putri tercinta dari<br>
                    <strong><?= htmlspecialchars($bFather) ?> &amp; <?= htmlspecialchars($bMother) ?></strong>
                </p>
                <a href="https://instagram.com/<?= htmlspecialchars($bInsta) ?>" target="_blank" class="btn-instagram-pill" id="brideInstaLink">
                    <i class="bi bi-instagram"></i>
                    <span id="brideInstaText">@<?= htmlspecialchars($bInsta) ?></span>
                </a>
            </div>

            <div class="couple-ampersand" data-aos="zoom-in">&amp;</div>

            <!-- Groom -->
            <div class="couple-card" data-aos="fade-up" data-aos-duration="1000">
                <div class="couple-arch-frame">
                    <img id="groomPhotoImg" src="https://undanganvideocirebon.com/wp-content/uploads/2026/09/Picturez3.png" alt="Mempelai Pria">
                </div>
                <h3 class="couple-name" id="groomFullName"><?= htmlspecialchars($gName) ?></h3>
                <p class="couple-parents" id="groomParentsText">
                    Putra tercinta dari<br>
                    <strong><?= htmlspecialchars($gFather) ?> &amp; <?= htmlspecialchars($gMother) ?></strong>
                </p>
                <a href="https://instagram.com/<?= htmlspecialchars($gInsta) ?>" target="_blank" class="btn-instagram-pill" id="groomInstaLink">
                    <i class="bi bi-instagram"></i>
                    <span id="groomInstaText">@<?= htmlspecialchars($gInsta) ?></span>
                </a>
            </div>
        </section>

        <!-- COUNTDOWN & ACARA -->
        <section class="section-block" id="secEvent">
            <div class="section-title-wrap" data-aos="fade-up">
                <span class="section-subtitle">Save The Date</span>
                <h2 class="section-title">Counting Down To Forever</h2>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-top: 10px;">
                    Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dalam momen suci kami:
                </p>
            </div>

            <!-- Countdown Timer -->
            <div class="countdown-container" data-aos="zoom-in">
                <div class="countdown-box">
                    <div class="countdown-num" id="cdDays">00</div>
                    <div class="countdown-lbl">Hari</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-num" id="cdHours">00</div>
                    <div class="countdown-lbl">Jam</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-num" id="cdMinutes">00</div>
                    <div class="countdown-lbl">Menit</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-num" id="cdSeconds">00</div>
                    <div class="countdown-lbl">Detik</div>
                </div>
            </div>

            <!-- Akad Nikah Card -->
            <div class="event-card" data-aos="fade-up">
                <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/09/sf-e1790341628715.png" alt="Leaf" class="ornament-corner ornament-top-left sway-left">
                <h3 class="event-card-title">Akad Nikah</h3>
                <div class="event-date-text" id="akadDateText"><?= htmlspecialchars($eventDateFormatted) ?></div>
                <div class="event-time-text" id="akadTimeText"><i class="bi bi-clock me-1"></i> <?= htmlspecialchars($akadTime) ?></div>
                <div class="event-venue-name" id="akadVenueText"><?= htmlspecialchars($akadLocation) ?></div>
                <div class="event-venue-addr" id="akadAddrText"><?= htmlspecialchars($akadAddress) ?></div>

                <div>
                    <a href="https://maps.google.com" target="_blank" class="btn-event-action" id="akadMapsBtn">
                        <i class="bi bi-geo-alt-fill"></i> Lihat Lokasi Acara
                    </a>
                    <a href="#" class="btn-event-action" id="btnCalAkad">
                        <i class="bi bi-calendar2-heart"></i> Simpan Kalender
                    </a>
                </div>
            </div>

            <!-- Resepsi Card -->
            <div class="event-card" data-aos="fade-up" data-aos-delay="150">
                <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/09/sf-e1790341628715.png" alt="Leaf" class="ornament-corner ornament-top-right sway-right">
                <h3 class="event-card-title">Resepsi Pernikahan</h3>
                <div class="event-date-text" id="resepsiDateText"><?= htmlspecialchars($eventDateFormatted) ?></div>
                <div class="event-time-text" id="resepsiTimeText"><i class="bi bi-clock me-1"></i> <?= htmlspecialchars($resepsiTime) ?></div>
                <div class="event-venue-name" id="resepsiVenueText"><?= htmlspecialchars($akadLocation) ?></div>
                <div class="event-venue-addr" id="resepsiAddrText"><?= htmlspecialchars($akadAddress) ?></div>

                <div>
                    <a href="https://maps.google.com" target="_blank" class="btn-event-action" id="resepsiMapsBtn">
                        <i class="bi bi-geo-alt-fill"></i> Lihat Lokasi Acara
                    </a>
                    <a href="#" class="btn-event-action" id="btnCalResepsi">
                        <i class="bi bi-calendar2-heart"></i> Simpan Kalender
                    </a>
                </div>
            </div>
        </section>

        <!-- LOVE STORY TIMELINE -->
        <section class="section-block" id="secStory">
            <div class="section-title-wrap" data-aos="fade-up">
                <span class="section-subtitle">Our Journey</span>
                <h2 class="section-title">Love Story</h2>
            </div>

            <div class="story-timeline" data-aos="fade-up">
                <!-- Story 1 -->
                <div class="story-item">
                    <div class="story-dot"></div>
                    <div class="story-card">
                        <h4 class="story-title">Awal Bertemu (2020)</h4>
                        <p class="story-desc">
                            Takdir mempertemukan kami pertama kali di masa perkuliahan. Dari sapaan sederhana berlanjut menjadi diskusi hangat dan persahabatan yang tulus.
                        </p>
                    </div>
                </div>

                <!-- Story 2 -->
                <div class="story-item">
                    <div class="story-dot"></div>
                    <div class="story-card">
                        <h4 class="story-title">Lamaran &amp; Komitmen (2025)</h4>
                        <p class="story-desc">
                            Setelah melewati berbagai cerita dan saling menguatkan, kedua keluarga besar kami bertemu untuk mengikat janji suci dan merencanakan hari bahagia.
                        </p>
                    </div>
                </div>

                <!-- Story 3 -->
                <div class="story-item">
                    <div class="story-dot"></div>
                    <div class="story-card">
                        <h4 class="story-title">Menuju Pernikahan (2026)</h4>
                        <p class="story-desc">
                            Bismillah, dengan restu orang tua dan keluarga tercinta, kami memantapkan langkah melangsungkan ibadah terpanjang seumur hidup kami.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- OUR GALLERY & VIDEO TEASER -->
        <section class="section-block" id="secGallery">
            <div class="section-title-wrap" data-aos="fade-up">
                <span class="section-subtitle">Moments</span>
                <h2 class="section-title">Our Gallery</h2>
            </div>

            <div class="gallery-grid" id="galleryContainer" data-aos="fade-up">
                <div class="gallery-item span-2">
                    <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-7-1.jpeg" alt="Prewedding 1">
                </div>
                <div class="gallery-item">
                    <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-9.jpeg" alt="Prewedding 2">
                </div>
                <div class="gallery-item">
                    <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-3-1.jpeg" alt="Prewedding 3">
                </div>
                <div class="gallery-item">
                    <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-13.jpeg" alt="Prewedding 4">
                </div>
                <div class="gallery-item">
                    <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-14.jpeg" alt="Prewedding 5">
                </div>
                <div class="gallery-item span-2">
                    <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-2.jpeg" alt="Prewedding 6">
                </div>
            </div>

            <!-- Video Teaser -->
            <div class="video-teaser-wrap" data-aos="zoom-in">
                <iframe src="https://www.youtube.com/embed/I0oV1BtmLIs?rel=0" title="Wedding Teaser" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </section>

        <!-- WEDDING WISH & RSVP -->
        <section class="section-block" id="secRsvp">
            <div class="section-title-wrap" data-aos="fade-up">
                <span class="section-subtitle">Prayer &amp; Presence</span>
                <h2 class="section-title">Wedding Wish</h2>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-top: 6px;">
                    Berikan ucapan &amp; doa terbaikmu kepada kedua mempelai
                </p>
            </div>

            <!-- RSVP Form -->
            <div class="rsvp-form-card" data-aos="fade-up">
                <form id="rsvpForm">
                    <label class="form-label-custom">Nama Lengkap *</label>
                    <input type="text" id="rsvpName" name="name" class="form-control-custom" placeholder="Contoh: Budi Santoso" required>

                    <label class="form-label-custom">Nomor WhatsApp / Telepon</label>
                    <input type="tel" id="rsvpPhone" name="phone" class="form-control-custom" placeholder="08xxxxxxxxxx">

                    <label class="form-label-custom">Konfirmasi Kehadiran *</label>
                    <select id="rsvpAttendance" name="attendance" class="form-control-custom" required>
                        <option value="attending">Iya, Saya Akan Hadir</option>
                        <option value="not_attending">Maaf, Tidak Bisa Hadir</option>
                        <option value="maybe">Saya Masih Ragu</option>
                    </select>

                    <label class="form-label-custom">Jumlah Kehadiran (Pax)</label>
                    <select id="rsvpPax" name="pax" class="form-control-custom">
                        <option value="1">1 Orang</option>
                        <option value="2" selected>2 Orang</option>
                        <option value="3">3 Orang</option>
                        <option value="4">4 Orang</option>
                        <option value="5">5 Orang</option>
                    </select>

                    <label class="form-label-custom">Ucapan &amp; Doa Restu *</label>
                    <textarea id="rsvpMessage" name="message" rows="3" class="form-control-custom" placeholder="Tuliskan ucapan dan doa terbaik Anda di sini..." required></textarea>

                    <button type="submit" class="btn-submit-rsvp" id="btnSubmitRsvp">
                        <i class="bi bi-send-fill me-1"></i> Kirim Konfirmasi &amp; Ucapan
                    </button>
                </form>
            </div>

                        <!-- Wishes Live Stream -->
            <div class="wishes-stream-wrap" id="wishesList" data-aos="fade-up">
                <?php if (!empty($wishes)): ?>
                    <?php foreach ($wishes as $w): ?>
                        <?php
                            $wName = htmlspecialchars($w['name'] ?? 'Tamu Undangan');
                            $wMsg = nl2br(htmlspecialchars($w['message'] ?? ''));
                            $wStatus = $w['attendance'] ?? ($w['attendance_status'] ?? 'attending');
                            $wPax = (int)($w['pax'] ?? ($w['attendance_count'] ?? 1));
                            $wTime = !empty($w['created_at']) ? date('d M Y, H:i', strtotime($w['created_at'])) : 'Baru saja';

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
                        <div class="wish-bubble">
                            <div class="wish-header">
                                <div class="wish-name"><?= $wName ?></div>
                                <span class="wish-badge <?= $badgeCls ?>"><?= $badgeLbl ?></span>
                            </div>
                            <div class="wish-content"><?= $wMsg ?></div>
                            <div class="wish-time"><i class="bi bi-clock"></i> <?= $wTime ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="wish-bubble">
                        <div class="wish-header">
                            <div class="wish-name">Keluarga Besar</div>
                            <span class="wish-badge badge-hadir">Hadir</span>
                        </div>
                        <div class="wish-content">
                            Selamat menempuh hidup baru untuk kedua mempelai! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.
                        </div>
                        <div class="wish-time"><i class="bi bi-clock"></i> Hari ini</div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- WEDDING GIFT / CASHLESS -->
        <section class="section-block" id="secGift">
            <div class="section-title-wrap" data-aos="fade-up">
                <span class="section-subtitle">Token of Love</span>
                <h2 class="section-title">Wedding Gift</h2>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-top: 6px;">
                    Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Namun, apabila Anda ingin memberikan tanda kasih secara cashless, Anda dapat menggunakan rekening di bawah:
                </p>
            </div>

            <!-- ATM Card 1: Bank Mandiri -->
            <div class="atm-card-wrapper" data-aos="fade-up">
                <div class="atm-top-row">
                    <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/01/chip-atm-1-2-4-2-1.png" alt="Chip" class="atm-chip">
                    <img src="https://undanganvideocirebon.com/wp-content/uploads/2025/09/LOGO-MANDIRI.png" alt="Bank Mandiri" class="bank-logo-img">
                </div>
                <div class="atm-acc-number" id="mandiriAccNum">0148038880100</div>
                <div class="atm-acc-holder">a.n. Putra Bagus Pamungkas</div>
                <button type="button" class="btn-copy-acc" onclick="copyToClipboard('0148038880100', 'Nomor Rekening Mandiri')">
                    <i class="bi bi-clipboard"></i> Salin Rekening
                </button>
            </div>

            <!-- ATM Card 2: Bank BCA -->
            <div class="atm-card-wrapper" data-aos="fade-up" data-aos-delay="100">
                <div class="atm-top-row">
                    <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/01/chip-atm-1-2-4-2-1.png" alt="Chip" class="atm-chip">
                    <div style="font-family: 'Poppins', sans-serif; font-size: 1.3rem; font-weight: 700; color: #fff; letter-spacing: 2px;">BCA</div>
                </div>
                <div class="atm-acc-number" id="bcaAccNum">8210984421</div>
                <div class="atm-acc-holder">a.n. Putri Sekar Wangi</div>
                <button type="button" class="btn-copy-acc" onclick="copyToClipboard('8210984421', 'Nomor Rekening BCA')">
                    <i class="bi bi-clipboard"></i> Salin Rekening
                </button>
            </div>

            <!-- Physical Gift Address -->
            <div class="gift-address-card" data-aos="fade-up">
                <i class="bi bi-box2-heart" style="font-size: 2rem; color: var(--crimson-accent);"></i>
                <h4 style="font-family: 'Cormorant Infant', serif; font-size: 1.4rem; color: var(--text-cream); margin: 8px 0;">Kirim Kado Fisik</h4>
                <p style="font-size: 0.86rem; color: var(--text-muted); line-height: 1.6;" id="giftAddressText">
                    <?= htmlspecialchars($akadAddress) ?> 45151 (Penerima: Putri Sekar / 08123456789)
                </p>
                <button type="button" class="btn-copy-acc mt-2" onclick="copyToClipboard(document.getElementById('giftAddressText').innerText, 'Alamat Kirim Kado')">
                    <i class="bi bi-geo-alt"></i> Salin Alamat Kado
                </button>
            </div>
        </section>

        <!-- FOOTER CLOSING -->
        <footer class="footer-closing" id="secFooter">
            <img src="https://undanganvideocirebon.com/wp-content/uploads/2026/07/IMG_6013.png" alt="Monogram" class="footer-monogram">
            <p class="footer-greeting">
                Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan do'a restu kepada kami.
            </p>
            <div style="font-size: 0.88rem; color: var(--gold-subtle); margin-bottom: 6px;">Kami yang berbahagia,</div>
            <div class="footer-couple-sig" id="footerCoupleSig"><?= htmlspecialchars($gNick) ?> &amp; <?= htmlspecialchars($bNick) ?></div>
            <div style="font-size: 0.8rem; color: var(--text-muted);">Beserta segenap keluarga besar</div>

            <div class="footer-watermark">
                Designed with ♥ by Pendar Loka
            </div>
        </footer>

    </div><!-- /.invitation-frame -->

    <!-- FLOATING MUSIC BUTTON -->
    <div class="music-float-btn" id="musicToggleBtn" title="Play/Pause Music">
        <i class="bi bi-music-note-beamed" id="musicIcon"></i>
    </div>

    <!-- FLOATING BOTTOM NAV DOCK -->
    <div class="nav-dock" id="navDock">
        <a href="#secHero" class="nav-dock-item active" title="Cover">
            <i class="bi bi-house-heart"></i>
            <span class="nav-dock-label">Home</span>
        </a>
        <a href="#secCouple" class="nav-dock-item" title="Mempelai">
            <i class="bi bi-heart"></i>
            <span class="nav-dock-label">Mempelai</span>
        </a>
        <a href="#secEvent" class="nav-dock-item" title="Acara">
            <i class="bi bi-calendar-event"></i>
            <span class="nav-dock-label">Acara</span>
        </a>
        <a href="#secStory" class="nav-dock-item" title="Cerita">
            <i class="bi bi-clock-history"></i>
            <span class="nav-dock-label">Story</span>
        </a>
        <a href="#secGallery" class="nav-dock-item" title="Galeri">
            <i class="bi bi-images"></i>
            <span class="nav-dock-label">Galeri</span>
        </a>
        <a href="#secRsvp" class="nav-dock-item" title="Ucapan">
            <i class="bi bi-chat-heart"></i>
            <span class="nav-dock-label">Ucapan</span>
        </a>
        <a href="#secGift" class="nav-dock-item" title="Amplop">
            <i class="bi bi-gift"></i>
            <span class="nav-dock-label">Gift</span>
        </a>
    </div>

    <!-- FLOATING ADMIN ASSET MANAGER BUTTON -->
    <div class="floating-admin-trigger" id="adminTriggerBtn" title="Buka Admin Asset Manager">
        <i class="bi bi-sliders2-vertical"></i>
    </div>

    <!-- ADMIN ASSET MANAGER MODAL (IMAGE, ANIMATION & BACKGROUND MUSIC) -->
    <div id="adminAssetModal">
        <div class="admin-modal-card">
            <div class="admin-modal-header">
                <div class="admin-modal-title">
                    <i class="bi bi-gear-wide-connected text-danger me-2"></i> Admin Asset Manager (Premium 5)
                </div>
                <button type="button" class="btn-close btn-close-white" id="btnCloseAdminModal"></button>
            </div>

            <div class="admin-modal-body">
                <!-- Navigation Tabs -->
                <div class="admin-tabs">
                    <button type="button" class="admin-tab-btn active" data-tab="tabImages">
                        <i class="bi bi-image me-1"></i> Gambar
                    </button>
                    <button type="button" class="admin-tab-btn" data-tab="tabAnimations">
                        <i class="bi bi-magic me-1"></i> Animasi
                    </button>
                    <button type="button" class="admin-tab-btn" data-tab="tabMusic">
                        <i class="bi bi-music-note-list me-1"></i> Musik Background
                    </button>
                </div>

                <!-- Tab 1: Image Assets -->
                <div class="admin-tab-pane active" id="tabImages">
                    <div class="admin-field-group">
                        <label class="admin-label">Logo / Monogram URL</label>
                        <input type="text" id="admMonogramUrl" class="admin-input" placeholder="https://...">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Cover / Preloader Photo URL</label>
                        <input type="text" id="admCoverPhotoUrl" class="admin-input" placeholder="https://...">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Foto Mempelai Wanita (Bride) URL</label>
                        <input type="text" id="admBridePhotoUrl" class="admin-input" placeholder="https://...">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Foto Mempelai Pria (Groom) URL</label>
                        <input type="text" id="admGroomPhotoUrl" class="admin-input" placeholder="https://...">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Ornamen Daun Sudut (Corner Leaf) URL</label>
                        <input type="text" id="admLeafOrnamentUrl" class="admin-input" placeholder="https://...">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Bank Mandiri Logo URL</label>
                        <input type="text" id="admBankMandiriUrl" class="admin-input" placeholder="https://...">
                    </div>
                </div>

                <!-- Tab 2: Animations -->
                <div class="admin-tab-pane" id="tabAnimations">
                    <div class="admin-field-group">
                        <label class="admin-label">Efek Partikel Layar (Canvas)</label>
                        <select id="admParticleType" class="admin-input">
                            <option value="crimson_petals">Kelopak Bunga Crimson Maroon</option>
                            <option value="golden_sparkles">Kilau Partikel Emas (Gold Dust)</option>
                            <option value="fireflies">Kunang-Kunang Berpendar (Warm Amber)</option>
                            <option value="none">Tanpa Partikel (Bersih)</option>
                        </select>
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Animasi Daun Sudut (Swaying Botanical)</label>
                        <select id="admLeafMotion" class="admin-input">
                            <option value="sway">Bergoyang Halus (Smooth Sway - Default)</option>
                            <option value="pulse">Berdenyut Lembut (Gentle Pulse)</option>
                            <option value="static">Diam / Statis</option>
                        </select>
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Kecepatan Animasi</label>
                        <select id="admAnimationSpeed" class="admin-input">
                            <option value="slow">Lambat &amp; Syahdu</option>
                            <option value="normal" selected>Normal</option>
                            <option value="fast">Cepat</option>
                        </select>
                    </div>
                </div>

                <!-- Tab 3: Background Music -->
                <div class="admin-tab-pane" id="tabMusic">
                    <div class="admin-field-group">
                        <label class="admin-label">Pilihan Preset Musik</label>
                        <select id="admAudioPreset" class="admin-input">
                            <option value="preset_cirebon">Smaragita Keroncong Cirebon (Original Reference)</option>
                            <option value="preset_sotya">Sotya - Irenne Ghea ft. Widhi Arjuna</option>
                            <option value="preset_thousand">A Thousand Years (Acoustic Cello &amp; Piano)</option>
                            <option value="preset_kebogiro">Gending Jawa Kebo Giro</option>
                            <option value="custom">Gunakan URL Kustom (MP3 / YouTube)</option>
                        </select>
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Custom Audio URL (MP3 / Direct Audio)</label>
                        <input type="text" id="admAudioCustomUrl" class="admin-input" placeholder="https://domain.com/music.mp3">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">YouTube Audio / Video ID</label>
                        <input type="text" id="admYtVideoId" class="admin-input" placeholder="I0oV1BtmLIs atau URL YouTube">
                    </div>
                    <div class="admin-field-group">
                        <label class="admin-label">Volume Suara (0 - 100%)</label>
                        <input type="range" id="admAudioVolume" class="form-range" min="0" max="100" value="80">
                    </div>
                </div>
            </div>

            <div class="admin-modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" id="btnResetAdminDefaults">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset Default
                </button>
                <button type="button" class="btn btn-sm btn-danger px-4" id="btnSaveAdminAssets">
                    <i class="bi bi-check2-circle"></i> Simpan &amp; Terapkan
                </button>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div id="copyToast" style="position: fixed; bottom: 80px; left: 50%; transform: translateX(-50%) translateY(100px); background: #260A0A; border: 1px solid var(--crimson-accent); color: #fff; padding: 12px 24px; border-radius: 30px; font-size: 0.85rem; box-shadow: 0 10px 25px rgba(0,0,0,0.8); z-index: 99999; opacity: 0; transition: all 0.4s ease; pointer-events: none;">
        <i class="bi bi-check-circle-fill text-success me-2"></i> <span id="toastMsg">Teks berhasil disalin!</span>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        // PRESET CONFIGURATION (UNDANGAN VIDEO CIREBON - PREMIUM 5)
        const CIREBON_DEFAULT_CONFIG = {
            monogramUrl: 'https://undanganvideocirebon.com/wp-content/uploads/2026/07/IMG_6013.png',
            coverPhoto: 'https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-5-1.jpeg',
            heroPhoto: 'https://undanganvideocirebon.com/wp-content/uploads/2026/07/WhatsApp-Image-2026-05-30-at-18.30.37-5-1.jpeg',
            bridePhoto: 'https://undanganvideocirebon.com/wp-content/uploads/2026/09/xz.png',
            groomPhoto: 'https://undanganvideocirebon.com/wp-content/uploads/2026/09/Picturez3.png',
            leafOrnamentUrl: 'https://undanganvideocirebon.com/wp-content/uploads/2026/09/sf-e1790341628715.png',
            bankMandiriUrl: 'https://undanganvideocirebon.com/wp-content/uploads/2025/09/LOGO-MANDIRI.png',

            particleType: 'crimson_petals',
            leafMotion: 'sway',
            animationSpeed: 'normal',

            audioPreset: 'preset_cirebon',
            audioUrl: 'https://cdn.freesound.org/previews/469/469009_9518146-lq.mp3', // fallback audio
            ytVideoId: 'I0oV1BtmLIs',
            audioVolume: 80,

            targetDate: '2026-06-10T08:00:00'
        };

        const STORAGE_KEY = 'pendar_cirebon_premium5_config';
        // Dynamic PHP Config Injection
        const PHP_CONFIG = {
            groomName: <?= json_encode($gNick) ?>,
            brideName: <?= json_encode($bNick) ?>,
            targetDate: <?= json_encode($eventIsoDate) ?>,
            musicUrl: <?= json_encode($musicUrl) ?>,
            groomPhoto: <?= json_encode($groomPhoto) ?>,
            bridePhoto: <?= json_encode($bridePhoto) ?>,
            heroPhoto: <?= json_encode($heroPhoto) ?>,
            coverPhoto: <?= json_encode($coverPhoto) ?>,
            rsvpUrl: <?= json_encode($rsvpTargetUrl) ?>
        };

        if (PHP_CONFIG.musicUrl) CIREBON_DEFAULT_CONFIG.audioUrl = PHP_CONFIG.musicUrl;
        if (PHP_CONFIG.groomPhoto) CIREBON_DEFAULT_CONFIG.groomPhoto = PHP_CONFIG.groomPhoto;
        if (PHP_CONFIG.bridePhoto) CIREBON_DEFAULT_CONFIG.bridePhoto = PHP_CONFIG.bridePhoto;
        if (PHP_CONFIG.heroPhoto) CIREBON_DEFAULT_CONFIG.heroPhoto = PHP_CONFIG.heroPhoto;
        if (PHP_CONFIG.coverPhoto) CIREBON_DEFAULT_CONFIG.coverPhoto = PHP_CONFIG.coverPhoto;
        if (PHP_CONFIG.targetDate) CIREBON_DEFAULT_CONFIG.targetDate = PHP_CONFIG.targetDate;
        let activeConfig = { ...CIREBON_DEFAULT_CONFIG };

        // Load custom settings from localStorage if available
        try {
            const saved = localStorage.getItem(STORAGE_KEY);
            if (saved) {
                const parsed = JSON.parse(saved);
                activeConfig = { ...activeConfig, ...parsed };
            }
        } catch(e) {}

        // AOS Init
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-out-cubic'
        });

        // Query Param Guest Name (?to=... or ?kpd=...)
        const urlParams = new URLSearchParams(window.location.search);
        const guestFromUrl = urlParams.get('to') || urlParams.get('kpd');
        if (guestFromUrl) {
            const decoded = decodeURIComponent(guestFromUrl.replace(/\+/g, ' '));
            document.getElementById('coverGuestName').textContent = decoded;
            const rsvpNameInput = document.getElementById('rsvpName');
            if (rsvpNameInput) rsvpNameInput.value = decoded;
        }

        // Apply Images & Styles to DOM
        function applyAssetsToDOM() {
            if (document.getElementById('coverMonogramImg')) document.getElementById('coverMonogramImg').src = activeConfig.monogramUrl;
            if (document.getElementById('heroMonogramImg')) document.getElementById('heroMonogramImg').src = activeConfig.monogramUrl;
            if (document.getElementById('heroPhotoImg')) document.getElementById('heroPhotoImg').src = activeConfig.heroPhoto;
            if (document.getElementById('bridePhotoImg')) document.getElementById('bridePhotoImg').src = activeConfig.bridePhoto;
            if (document.getElementById('groomPhotoImg')) document.getElementById('groomPhotoImg').src = activeConfig.groomPhoto;

            // Corner leaves
            document.querySelectorAll('.ornament-corner').forEach(el => {
                el.src = activeConfig.leafOrnamentUrl;
                if (activeConfig.leafMotion === 'static') {
                    el.classList.remove('sway-left', 'sway-right');
                } else if (activeConfig.leafMotion === 'pulse') {
                    el.classList.remove('sway-left', 'sway-right');
                    el.style.animation = 'animPulse 3s ease-in-out infinite';
                }
            });

            // Audio Player Setup
            const audioEl = document.getElementById('bgMusic');
            if (audioEl) {
                audioEl.src = activeConfig.audioUrl;
                audioEl.volume = (activeConfig.audioVolume || 80) / 100;
            }
        }

        // Copy To Clipboard Toast Helper
        function copyToClipboard(text, label) {
            navigator.clipboard.writeText(text).then(() => {
                showToast(label + ' berhasil disalin!');
            }).catch(() => {
                const temp = document.createElement('input');
                temp.value = text;
                document.body.appendChild(temp);
                temp.select();
                document.execCommand('copy');
                document.body.removeChild(temp);
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
                }).catch(err => console.log('Audio playback prevented:', err));
            } else {
                audioEl.pause();
                isMusicPlaying = false;
                musicBtn.classList.remove('playing');
                musicIcon.className = 'bi bi-play-fill';
            }
        }

        if (musicBtn) {
            musicBtn.addEventListener('click', toggleMusic);
        }

        // Open Invitation Trigger
        const btnOpen = document.getElementById('btnOpenInvitation');
        const coverOverlay = document.getElementById('coverOverlay');

        if (btnOpen) {
            btnOpen.addEventListener('click', () => {
                coverOverlay.classList.add('unlocked');
                document.body.style.overflow = 'auto';

                // Play Audio
                if (audioEl) {
                    audioEl.play().then(() => {
                        isMusicPlaying = true;
                        musicBtn.classList.add('playing');
                        musicIcon.className = 'bi bi-disc';
                    }).catch(e => console.log(e));
                }

                // Scroll to Hero
                setTimeout(() => {
                    document.getElementById('secHero').scrollIntoView({ behavior: 'smooth' });
                    AOS.refresh();
                }, 300);
            });
        }

        // Navigation Dock Active Spy
        const sections = document.querySelectorAll('section, footer');
        const navLinks = document.querySelectorAll('.nav-dock-item');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(sec => {
                const top = sec.offsetTop - 200;
                if (window.scrollY >= top) {
                    current = sec.getAttribute('id');
                }
            });
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        // Falling Crimson Petals / Sparkles Canvas Animation
        const canvas = document.getElementById('particleCanvas');
        const ctx = canvas.getContext('2d');
        let particles = [];
        let animFrameId;

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        function initParticles() {
            particles = [];
            if (activeConfig.particleType === 'none') return;

            const count = activeConfig.particleType === 'golden_sparkles' ? 55 : 30;
            for (let i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: Math.random() * 6 + 4,
                    speedY: Math.random() * 1.5 + 0.6,
                    speedX: (Math.random() - 0.5) * 1.2,
                    rotation: Math.random() * 360,
                    rotSpeed: (Math.random() - 0.5) * 3,
                    opacity: Math.random() * 0.6 + 0.3
                });
            }
        }

        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (activeConfig.particleType === 'none') return;

            particles.forEach(p => {
                p.y += p.speedY;
                p.x += p.speedX;
                p.rotation += p.rotSpeed;

                if (p.y > canvas.height + 20) {
                    p.y = -20;
                    p.x = Math.random() * canvas.width;
                }

                ctx.save();
                ctx.translate(p.x, p.y);
                ctx.rotate((p.rotation * Math.PI) / 180);
                ctx.globalAlpha = p.opacity;

                if (activeConfig.particleType === 'golden_sparkles') {
                    // Gold sparkle
                    ctx.fillStyle = '#D4AF37';
                    ctx.beginPath();
                    ctx.arc(0, 0, p.size / 2, 0, Math.PI * 2);
                    ctx.fill();
                } else {
                    // Crimson Rose Petal
                    ctx.fillStyle = '#9E1E1E';
                    ctx.beginPath();
                    ctx.ellipse(0, 0, p.size, p.size * 1.5, Math.PI / 4, 0, Math.PI * 2);
                    ctx.fill();
                }
                ctx.restore();
            });

            animFrameId = requestAnimationFrame(drawParticles);
        }

        // RSVP AJAX Handler
        const rsvpForm = document.getElementById('rsvpForm');
        if (rsvpForm) {
            rsvpForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('rsvpName').value.trim();
                const phone = document.getElementById('rsvpPhone').value.trim();
                const attendance = document.getElementById('rsvpAttendance').value;
                const pax = document.getElementById('rsvpPax').value;
                const message = document.getElementById('rsvpMessage').value.trim();

                const btn = document.getElementById('btnSubmitRsvp');
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Mengirimkan...';
                btn.disabled = true;

                // Create and prepend wish bubble immediately
                const bubble = document.createElement('div');
                bubble.className = 'wish-bubble';
                const badgeClass = attendance === 'attending' ? 'badge-hadir' : (attendance === 'maybe' ? 'badge-ragu' : 'badge-tidak');
                const badgeText = attendance === 'attending' ? `Hadir (${pax})` : (attendance === 'maybe' ? 'Ragu' : 'Tidak Hadir');

                bubble.innerHTML = `
                    <div class="wish-header">
                        <div class="wish-name">${name}</div>
                        <span class="wish-badge ${badgeClass}">${badgeText}</span>
                    </div>
                    <div class="wish-content">${message}</div>
                    <div class="wish-time"><i class="bi bi-clock"></i> Baru saja</div>
                `;

                const list = document.getElementById('wishesList');
                if (list) list.prepend(bubble);

                showToast('Terima kasih! Konfirmasi & doa Anda telah terkirim.');
                rsvpForm.reset();
                btn.innerHTML = '<i class="bi bi-send-fill me-1"></i> Kirim Konfirmasi &amp; Ucapan';
                btn.disabled = false;
            });
        }

        // ADMIN ASSET MANAGER LOGIC
        const adminModal = document.getElementById('adminAssetModal');
        const adminTrigger = document.getElementById('adminTriggerBtn');
        const btnCloseModal = document.getElementById('btnCloseAdminModal');
        const btnSaveAssets = document.getElementById('btnSaveAdminAssets');
        const btnResetDefaults = document.getElementById('btnResetAdminDefaults');

        // Check ?admin=true
        if (urlParams.get('admin') === 'true') {
            openAdminModal();
        }

        if (adminTrigger) {
            adminTrigger.addEventListener('click', openAdminModal);
        }
        if (btnCloseModal) {
            btnCloseModal.addEventListener('click', closeAdminModal);
        }

        function openAdminModal() {
            // Populate fields
            document.getElementById('admMonogramUrl').value = activeConfig.monogramUrl;
            document.getElementById('admCoverPhotoUrl').value = activeConfig.coverPhoto;
            document.getElementById('admBridePhotoUrl').value = activeConfig.bridePhoto;
            document.getElementById('admGroomPhotoUrl').value = activeConfig.groomPhoto;
            document.getElementById('admLeafOrnamentUrl').value = activeConfig.leafOrnamentUrl;
            document.getElementById('admBankMandiriUrl').value = activeConfig.bankMandiriUrl;

            document.getElementById('admParticleType').value = activeConfig.particleType;
            document.getElementById('admLeafMotion').value = activeConfig.leafMotion;
            document.getElementById('admAnimationSpeed').value = activeConfig.animationSpeed;

            document.getElementById('admAudioPreset').value = activeConfig.audioPreset;
            document.getElementById('admAudioCustomUrl').value = activeConfig.audioUrl;
            document.getElementById('admYtVideoId').value = activeConfig.ytVideoId;
            document.getElementById('admAudioVolume').value = activeConfig.audioVolume;

            adminModal.classList.add('show');
        }

        function closeAdminModal() {
            adminModal.classList.remove('show');
        }

        // Tab Switching in Admin
        document.querySelectorAll('.admin-tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.admin-tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.admin-tab-pane').forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                const target = this.getAttribute('data-tab');
                document.getElementById(target).classList.add('active');
            });
        });

        // Save Custom Assets
        if (btnSaveAssets) {
            btnSaveAssets.addEventListener('click', () => {
                const newCfg = {
                    ...activeConfig,
                    monogramUrl: document.getElementById('admMonogramUrl').value.trim() || CIREBON_DEFAULT_CONFIG.monogramUrl,
                    coverPhoto: document.getElementById('admCoverPhotoUrl').value.trim() || CIREBON_DEFAULT_CONFIG.coverPhoto,
                    bridePhoto: document.getElementById('admBridePhotoUrl').value.trim() || CIREBON_DEFAULT_CONFIG.bridePhoto,
                    groomPhoto: document.getElementById('admGroomPhotoUrl').value.trim() || CIREBON_DEFAULT_CONFIG.groomPhoto,
                    leafOrnamentUrl: document.getElementById('admLeafOrnamentUrl').value.trim() || CIREBON_DEFAULT_CONFIG.leafOrnamentUrl,
                    bankMandiriUrl: document.getElementById('admBankMandiriUrl').value.trim() || CIREBON_DEFAULT_CONFIG.bankMandiriUrl,

                    particleType: document.getElementById('admParticleType').value,
                    leafMotion: document.getElementById('admLeafMotion').value,
                    animationSpeed: document.getElementById('admAnimationSpeed').value,

                    audioPreset: document.getElementById('admAudioPreset').value,
                    audioUrl: document.getElementById('admAudioCustomUrl').value.trim() || CIREBON_DEFAULT_CONFIG.audioUrl,
                    ytVideoId: document.getElementById('admYtVideoId').value.trim() || CIREBON_DEFAULT_CONFIG.ytVideoId,
                    audioVolume: parseInt(document.getElementById('admAudioVolume').value) || 80
                };

                localStorage.setItem(STORAGE_KEY, JSON.stringify(newCfg));
                alert('✔ Pengaturan asset berhasil disimpan ke browser! Halaman akan dimuat ulang.');
                window.location.reload();
            });
        }

        // Reset to Defaults
        if (btnResetDefaults) {
            btnResetDefaults.addEventListener('click', () => {
                if (confirm('Kembalikan semua asset dan animasi ke setelan default tema Premium 5 Cirebon?')) {
                    localStorage.removeItem(STORAGE_KEY);
                    window.location.reload();
                }
            });
        }

        // Init on DOM Load
        document.addEventListener('DOMContentLoaded', () => {
            applyAssetsToDOM();
            initCountdown();
            initParticles();
            drawParticles();
        });
    </script>
</body>
</html>