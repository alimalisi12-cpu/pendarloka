<?php
// views/templates/islamic_navy_gold.php
// Template: Islamic Royal Navy & Rose Gold
// Color Palette: Deep Navy Blue (#070E1E, #0D1933), Metallic Gold & Rose Gold (#D4AF37, #E8C97B, #E29E8E)
// Typography: Cinzel / Cormorant Garamond, Great Vibes, Amiri (Arabic), Plus Jakarta Sans

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$loveStories = json_decode($event['love_story_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];
$customSchedules = json_decode($event['events_schedule_json'] ?? '[]', true) ?: [];

// Fallback & Demo Data
if (empty($galleries)) {
    $galleries = [
        'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&auto=format&fit=crop&q=80'
    ];
}

if (empty($bankAccounts)) {
    $bankAccounts = [
        ['bank' => 'Bank Syariah Indonesia (BSI)', 'number' => '7188299101', 'owner' => $event['groom_nickname'] ?? 'Muhammad Fatih'],
        ['bank' => 'Bank BCA', 'number' => '8210992341', 'owner' => $event['bride_nickname'] ?? 'Aisyah Humaira']
    ];
}

$defaultHeroPhoto = 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1600&auto=format&fit=crop&q=85';
$heroPhoto = !empty($event['hero_photo']) ? media_url($event['hero_photo']) : (!empty($event['cover_photo']) ? media_url($event['cover_photo']) : $defaultHeroPhoto);
$groomPhoto = !empty($event['groom_photo']) ? media_url($event['groom_photo']) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80';
$bridePhoto = !empty($event['bride_photo']) ? media_url($event['bride_photo']) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=600&auto=format&fit=crop&q=80';
$coverPhoto = !empty($event['cover_photo']) ? media_url($event['cover_photo']) : $heroPhoto;

$gNick = !empty($event['groom_nickname']) ? trim($event['groom_nickname']) : 'Fatih';
$bNick = !empty($event['bride_nickname']) ? trim($event['bride_nickname']) : 'Aisyah';
$gName = !empty($event['groom_name']) ? trim($event['groom_name']) : 'Muhammad Fatih Al-Faruq, S.T.';
$bName = !empty($event['bride_name']) ? trim($event['bride_name']) : 'Aisyah Humaira Azzahra, S.Farm.';

$guestDisplayName = !empty($guestName) ? $guestName : 'Tamu Undangan Yang Berbahagia';
$musicUrl = !empty($event['music_url']) ? media_url($event['music_url']) : 'https://cdn.freesound.org/previews/469/469009_9518146-lq.mp3';

$eventDateTimestamp = strtotime($event['event_date'] ?? '+30 days');
$eventDateFormatted = date('d F Y', $eventDateTimestamp);
$eventIsoDate = date('Y-m-d\TH:i:s', $eventDateTimestamp);

$akadTime = !empty($event['akad_time']) ? $event['akad_time'] : '08:00 - 10:00 WIB';
$akadLocation = !empty($event['akad_location']) ? $event['akad_location'] : 'Masjid Raya Al-Muhajirin, Surabaya';
$resepsiTime = !empty($event['resepsi_time']) ? $event['resepsi_time'] : '11:00 - 14:00 WIB';
$resepsiLocation = !empty($event['resepsi_location']) ? $event['resepsi_location'] : 'Ballroom Hotel Royal Tulip, Surabaya';

$quoteText = !empty($event['quote']) ? $event['quote'] : 'Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.';
$quoteSource = !empty($event['quote_source']) ? $event['quote_source'] : 'QS. Ar-Rum: 21';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['title'] ?? ('Walimatul Urs ' . $bNick . ' & ' . $gNick)) ?></title>

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌙</text></svg>" type="image/png">

    <!-- Fonts: Cinzel, Great Vibes, Amiri (Arabic), Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Cinzel:wght@400;600;700;800;900&family=Great+Vibes&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            /* Islamic Royal Navy & Gold Palette */
            --navy-base: #070D1E;
            --navy-surface: #0E1831;
            --navy-card: #132247;
            --navy-elevated: #1A2E5C;
            --navy-border: rgba(212, 175, 55, 0.22);
            --navy-border-hover: rgba(212, 175, 55, 0.6);

            /* Metallic Gold & Rose Gold */
            --gold-primary: #D4AF37;
            --gold-light: #F6E29F;
            --gold-deep: #AA8220;
            --gold-gradient: linear-gradient(135deg, #ECC880 0%, #D4AF37 50%, #A97C20 100%);
            --gold-shimmer: linear-gradient(90deg, #ECC880, #FFF5CC, #ECC880, #D4AF37);
            --rose-accent: #E0A99A;
            --rose-soft: rgba(224, 169, 154, 0.15);

            --text-light: #F8F9FA;
            --text-gold: #E8C97B;
            --text-muted: #9BAEC8;

            --radius-card: 20px;
            --radius-pill: 50px;
            --shadow-gold: 0 10px 30px -5px rgba(212, 175, 55, 0.2);
            --shadow-card: 0 15px 35px -8px rgba(0, 0, 0, 0.5);
            --transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--navy-base);
            color: var(--text-light);
            line-height: 1.75;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Subtle Islamic Geometric Mandala Texture Overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(212, 175, 55, 0.06) 1px, transparent 1px),
                              radial-gradient(rgba(224, 169, 154, 0.04) 1px, transparent 1px);
            background-size: 32px 32px;
            background-position: 0 0, 16px 16px;
            pointer-events: none;
            z-index: 0;
        }

        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-script { font-family: 'Great Vibes', cursive; }
        .font-arabic { font-family: 'Amiri', serif; }

        /* Container Frame (Mobile-First Editorial) */
        .invitation-wrapper {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            background-color: var(--navy-surface);
            box-shadow: 0 0 60px rgba(0, 0, 0, 0.8), 0 0 30px rgba(212, 175, 55, 0.1);
            min-height: 100vh;
            border-left: 1px solid rgba(212, 175, 55, 0.15);
            border-right: 1px solid rgba(212, 175, 55, 0.15);
            overflow: hidden;
        }

        /* ==========================================================================
           1. COVER UNLOCK MODAL
           ========================================================================== */
        #coverModal {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: radial-gradient(circle at center, #112044 0%, #060B19 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 20px;
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        #coverModal.unlocked {
            opacity: 0;
            transform: translateY(-100%);
            pointer-events: none;
        }

        .cover-card {
            width: 100%;
            max-width: 440px;
            text-align: center;
            background: rgba(14, 24, 49, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid var(--gold-primary);
            border-radius: 28px;
            padding: 40px 24px;
            position: relative;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7), 0 0 40px rgba(212, 175, 55, 0.15);
        }

        /* Ornate Gold Corners */
        .ornate-corner {
            position: absolute;
            width: 32px;
            height: 32px;
            border: 2px solid var(--gold-primary);
            pointer-events: none;
        }
        .ornate-top-left { top: 10px; left: 10px; border-right: none; border-bottom: none; }
        .ornate-top-right { top: 10px; right: 10px; border-left: none; border-bottom: none; }
        .ornate-bottom-left { bottom: 10px; left: 10px; border-right: none; border-top: none; }
        .ornate-bottom-right { bottom: 10px; right: 10px; border-left: none; border-top: none; }

        .mandala-badge {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mandala-ring {
            position: absolute;
            inset: 0;
            border: 1.5px dashed var(--gold-light);
            border-radius: 50%;
            animation: spinMandala 24s linear infinite;
        }

        .mandala-inner {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: var(--gold-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #070D1E;
            font-size: 28px;
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.5);
        }

        @keyframes spinMandala {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .bismillah-calligraphy {
            font-family: 'Amiri', serif;
            font-size: 26px;
            color: var(--gold-light);
            margin-bottom: 12px;
            direction: rtl;
            text-shadow: 0 0 12px rgba(212, 175, 55, 0.4);
        }

        .cover-tagline {
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--rose-accent);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .cover-names {
            font-family: 'Cinzel', serif;
            font-size: 30px;
            font-weight: 700;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 24px;
            line-height: 1.25;
            letter-spacing: 1px;
        }

        .cover-guest-box {
            background: rgba(7, 13, 30, 0.65);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 28px;
        }

        .cover-guest-box .small-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .cover-guest-box .guest-name {
            font-size: 17px;
            font-weight: 700;
            color: #FFFFFF;
            letter-spacing: 0.5px;
        }

        .btn-unlock {
            background: var(--gold-gradient);
            color: #070D1E;
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1.5px;
            padding: 14px 34px;
            border-radius: var(--radius-pill);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.35);
            transition: var(--transition);
        }

        .btn-unlock:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 15px 35px rgba(212, 175, 55, 0.55);
            color: #070D1E;
        }

        /* ==========================================================================
           2. HERO SECTION
           ========================================================================== */
        .hero-section {
            position: relative;
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 60px 24px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(7, 13, 30, 0.75) 0%, rgba(14, 24, 49, 0.88) 60%, rgba(7, 13, 30, 1) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 440px;
        }

        .islamic-frame {
            border: 1px solid var(--gold-primary);
            border-radius: 30px;
            padding: 42px 24px;
            position: relative;
            background: rgba(7, 13, 30, 0.45);
            backdrop-filter: blur(8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
        }

        .hero-bismillah {
            font-family: 'Amiri', serif;
            font-size: 28px;
            color: var(--gold-light);
            margin-bottom: 16px;
            text-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
        }

        .hero-subtitle {
            font-family: 'Cinzel', serif;
            font-size: 12px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--rose-accent);
            margin-bottom: 16px;
        }

        .hero-names {
            font-family: 'Cinzel', serif;
            font-size: 34px;
            font-weight: 800;
            line-height: 1.2;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .hero-ampersand {
            font-family: 'Great Vibes', cursive;
            font-size: 36px;
            color: var(--gold-light);
            margin: 4px 0;
        }

        .hero-date-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(212, 175, 55, 0.12);
            border: 1px solid var(--gold-primary);
            color: var(--gold-light);
            font-size: 13px;
            letter-spacing: 1px;
            padding: 8px 20px;
            border-radius: var(--radius-pill);
            margin-top: 20px;
        }

        /* Gold Decorative Divider */
        .gold-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 28px 0;
        }

        .gold-divider::before, .gold-divider::after {
            content: '';
            height: 1px;
            flex: 1;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
        }

        .gold-divider i {
            color: var(--gold-light);
            font-size: 14px;
        }

        /* ==========================================================================
           3. AYAT / OPENING QUOTE SECTION
           ========================================================================== */
        .quote-section {
            padding: 60px 24px;
            text-align: center;
            background: linear-gradient(180deg, var(--navy-base) 0%, var(--navy-surface) 100%);
        }

        .quote-card {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: var(--radius-card);
            padding: 36px 26px;
            position: relative;
            box-shadow: var(--shadow-card);
        }

        .quote-arabic {
            font-family: 'Amiri', serif;
            font-size: 21px;
            line-height: 2.1;
            color: var(--gold-light);
            direction: rtl;
            margin-bottom: 20px;
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
        }

        .quote-translation {
            font-size: 13.5px;
            color: var(--text-light);
            line-height: 1.8;
            font-style: italic;
            margin-bottom: 16px;
        }

        .quote-reference {
            font-family: 'Cinzel', serif;
            font-size: 12px;
            font-weight: 700;
            color: var(--gold-primary);
            letter-spacing: 1.5px;
        }

        /* ==========================================================================
           4. THE COUPLE (MEMPELAI)
           ========================================================================== */
        .couple-section {
            padding: 60px 24px;
            background-color: var(--navy-surface);
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-kicker {
            font-family: 'Cinzel', serif;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--rose-accent);
            display: block;
            margin-bottom: 6px;
        }

        .section-title {
            font-family: 'Cinzel', serif;
            font-size: 28px;
            font-weight: 800;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .couple-card {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: var(--radius-card);
            padding: 34px 22px;
            text-align: center;
            margin-bottom: 28px;
            position: relative;
            box-shadow: var(--shadow-card);
            transition: var(--transition);
        }

        .couple-card:hover {
            border-color: var(--gold-primary);
            transform: translateY(-4px);
        }

        .portrait-wrapper {
            width: 140px;
            height: 140px;
            margin: 0 auto 20px;
            position: relative;
        }

        .portrait-mandala {
            position: absolute;
            inset: -8px;
            border: 1.5px dashed var(--gold-primary);
            border-radius: 50%;
            animation: spinMandala 30s linear infinite;
        }

        .portrait-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--gold-primary);
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.35);
        }

        .couple-name {
            font-family: 'Cinzel', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--gold-light);
            margin-bottom: 6px;
        }

        .couple-parents {
            font-size: 13.5px;
            color: var(--text-muted);
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .couple-ig {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(224, 169, 154, 0.12);
            color: var(--rose-accent);
            border: 1px solid rgba(224, 169, 154, 0.3);
            border-radius: var(--radius-pill);
            padding: 5px 16px;
            font-size: 12px;
            text-decoration: none;
            transition: var(--transition);
        }

        .couple-ig:hover {
            background: var(--rose-accent);
            color: var(--navy-base);
        }

        .couple-separator {
            text-align: center;
            font-family: 'Great Vibes', cursive;
            font-size: 42px;
            color: var(--gold-light);
            margin: -10px 0 24px;
        }

        /* ==========================================================================
           5. EVENT SCHEDULE (AKAD & RESEPSI)
           ========================================================================== */
        .schedule-section {
            padding: 60px 24px;
            background: linear-gradient(180deg, var(--navy-surface) 0%, var(--navy-base) 100%);
        }

        .schedule-card {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: var(--radius-card);
            padding: 32px 22px;
            margin-bottom: 24px;
            position: relative;
            box-shadow: var(--shadow-card);
        }

        .event-type-badge {
            display: inline-block;
            background: var(--gold-gradient);
            color: #070D1E;
            font-family: 'Cinzel', serif;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2px;
            padding: 6px 18px;
            border-radius: var(--radius-pill);
            margin-bottom: 18px;
        }

        .event-title {
            font-family: 'Cinzel', serif;
            font-size: 21px;
            font-weight: 700;
            color: var(--gold-light);
            margin-bottom: 16px;
        }

        .event-info-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 14px;
            text-align: left;
        }

        .event-info-item i {
            color: var(--gold-primary);
            font-size: 18px;
            margin-top: 3px;
        }

        .event-info-item div h6 {
            font-size: 14px;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 2px;
        }

        .event-info-item div p {
            font-size: 13px;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.5;
        }

        .event-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 22px;
        }

        .btn-event-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 14px;
            border-radius: var(--radius-pill);
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-event-gold {
            background: var(--gold-gradient);
            color: #070D1E;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.25);
        }

        .btn-event-gold:hover {
            color: #070D1E;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
        }

        .btn-event-outline {
            background: transparent;
            border: 1px solid var(--gold-primary);
            color: var(--gold-light);
        }

        .btn-event-outline:hover {
            background: rgba(212, 175, 55, 0.15);
            color: var(--gold-light);
        }

        /* Maps Embed Container */
        .maps-frame-container {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--navy-border);
            margin-top: 18px;
            height: 200px;
        }

        .maps-frame-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* ==========================================================================
           6. LIVE COUNTDOWN TIMER
           ========================================================================== */
        .countdown-section {
            padding: 50px 24px;
            text-align: center;
            background: var(--navy-surface);
        }

        .countdown-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            max-width: 420px;
            margin: 28px auto 0;
        }

        .countdown-card {
            background: var(--navy-card);
            border: 1px solid var(--gold-primary);
            border-radius: 16px;
            padding: 14px 6px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .countdown-number {
            font-family: 'Cinzel', serif;
            font-size: 26px;
            font-weight: 800;
            color: var(--gold-light);
            line-height: 1;
            margin-bottom: 6px;
        }

        .countdown-label {
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* ==========================================================================
           7. HEALTH PROTOCOL & DRESS CODE
           ========================================================================== */
        .protocol-section {
            padding: 60px 24px;
            background: linear-gradient(180deg, var(--navy-base) 0%, var(--navy-surface) 100%);
        }

        .protocol-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-top: 24px;
        }

        .protocol-card {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: 16px;
            padding: 22px 14px;
            text-align: center;
            transition: var(--transition);
        }

        .protocol-card:hover {
            border-color: var(--gold-primary);
            transform: translateY(-3px);
        }

        .protocol-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.12);
            border: 1px solid var(--gold-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-light);
            font-size: 22px;
        }

        .protocol-title {
            font-size: 13px;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 4px;
        }

        .protocol-desc {
            font-size: 11.5px;
            color: var(--text-muted);
            line-height: 1.45;
            margin: 0;
        }

        .dresscode-banner {
            background: rgba(224, 169, 154, 0.08);
            border: 1px dashed var(--rose-accent);
            border-radius: 16px;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        .dresscode-palette {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 12px;
        }

        .color-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid #FFFFFF;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* ==========================================================================
           8. DIGITAL GIFT (AMPLOP DIGITAL)
           ========================================================================== */
        .gift-section {
            padding: 60px 24px;
            background-color: var(--navy-surface);
        }

        .gift-bank-card {
            background: linear-gradient(145deg, #16264C, #0E1A36);
            border: 1px solid var(--gold-primary);
            border-radius: 20px;
            padding: 26px 20px;
            margin-bottom: 20px;
            position: relative;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        .gift-bank-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .gift-bank-name {
            font-family: 'Cinzel', serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--gold-light);
        }

        .gift-bank-chip {
            width: 38px;
            height: 28px;
            background: linear-gradient(135deg, #F6E29F, #D4AF37);
            border-radius: 6px;
        }

        .gift-account-number {
            font-family: 'Cinzel', serif;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #FFFFFF;
            margin-bottom: 4px;
        }

        .gift-account-holder {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .btn-copy-acc {
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid var(--gold-primary);
            color: var(--gold-light);
            font-size: 12px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: var(--radius-pill);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-copy-acc:hover {
            background: var(--gold-primary);
            color: var(--navy-base);
        }

        .qris-card {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: 20px;
            padding: 26px 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .qris-image {
            width: 170px;
            height: 170px;
            border-radius: 12px;
            border: 3px solid var(--gold-primary);
            margin: 14px auto;
            display: block;
            background: #FFFFFF;
            padding: 6px;
        }

        /* ==========================================================================
           9. RSVP & GUEST WISHES
           ========================================================================== */
        .rsvp-section {
            padding: 60px 24px;
            background: linear-gradient(180deg, var(--navy-surface) 0%, var(--navy-base) 100%);
        }

        .rsvp-form-card {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: var(--radius-card);
            padding: 30px 22px;
            margin-bottom: 34px;
            box-shadow: var(--shadow-card);
        }

        .form-control-dark {
            background-color: rgba(7, 13, 30, 0.7);
            border: 1px solid var(--navy-border);
            color: #FFFFFF;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13.5px;
            transition: var(--transition);
        }

        .form-control-dark:focus {
            background-color: rgba(7, 13, 30, 0.9);
            border-color: var(--gold-primary);
            color: #FFFFFF;
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.25);
        }

        .btn-submit-rsvp {
            width: 100%;
            background: var(--gold-gradient);
            color: #070D1E;
            font-family: 'Cinzel', serif;
            font-size: 13.5px;
            font-weight: 800;
            letter-spacing: 1.5px;
            padding: 14px;
            border-radius: var(--radius-pill);
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.35);
            transition: var(--transition);
        }

        .btn-submit-rsvp:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(212, 175, 55, 0.55);
        }

        /* Wishes Board */
        .wishes-board {
            max-height: 440px;
            overflow-y: auto;
            padding-right: 4px;
        }

        .wishes-board::-webkit-scrollbar {
            width: 4px;
        }

        .wishes-board::-webkit-scrollbar-thumb {
            background: var(--gold-primary);
            border-radius: 10px;
        }

        .wish-item {
            background: var(--navy-card);
            border: 1px solid var(--navy-border);
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 14px;
            text-align: left;
        }

        .wish-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .wish-author {
            font-weight: 700;
            color: var(--gold-light);
            font-size: 14px;
        }

        .wish-status-badge {
            font-size: 10px;
            padding: 4px 10px;
            border-radius: var(--radius-pill);
            font-weight: 600;
        }

        .badge-hadir {
            background: rgba(40, 167, 69, 0.2);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .badge-ragu {
            background: rgba(255, 193, 7, 0.2);
            color: #facc15;
            border: 1px solid rgba(250, 204, 21, 0.3);
        }

        .badge-tidak {
            background: rgba(220, 53, 69, 0.2);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.3);
        }

        .wish-body {
            font-size: 13px;
            color: #E2E8F0;
            line-height: 1.6;
            margin-bottom: 6px;
        }

        .wish-time {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* ==========================================================================
           10. FOOTER
           ========================================================================== */
        .invitation-footer {
            padding: 50px 24px;
            text-align: center;
            background: #040813;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        .footer-logo {
            font-family: 'Cinzel', serif;
            font-size: 20px;
            font-weight: 800;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 6px;
        }

        /* ==========================================================================
           11. FLOATING CONTROLS & TOAST
           ========================================================================== */
        .floating-controls {
            position: fixed;
            bottom: 24px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-floating {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--navy-card);
            border: 1.5px solid var(--gold-primary);
            color: var(--gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6);
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-floating:hover {
            transform: scale(1.1);
            background: var(--gold-primary);
            color: var(--navy-base);
        }

        .btn-floating.rotating {
            animation: spinMandala 5s linear infinite;
        }

        .custom-toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: rgba(14, 24, 49, 0.95);
            border: 1px solid var(--gold-primary);
            color: var(--gold-light);
            padding: 12px 24px;
            border-radius: var(--radius-pill);
            font-size: 13.5px;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
            z-index: 999999;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }

        .custom-toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    </style>
</head>
<body>

    <!-- 1. FULLSCREEN OPENING COVER MODAL -->
    <div id="coverModal">
        <div class="cover-card">
            <div class="ornate-corner ornate-top-left"></div>
            <div class="ornate-corner ornate-top-right"></div>
            <div class="ornate-corner ornate-bottom-left"></div>
            <div class="ornate-corner ornate-bottom-right"></div>

            <div class="mandala-badge">
                <div class="mandala-ring"></div>
                <div class="mandala-inner">
                    <i class="bi bi-moon-stars-fill"></i>
                </div>
            </div>

            <div class="bismillah-calligraphy">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
            <div class="cover-tagline">Walimatul 'Ursy</div>
            <h1 class="cover-names"><?= htmlspecialchars($bNick) ?> &amp; <?= htmlspecialchars($gNick) ?></h1>

            <div class="cover-guest-box">
                <div class="small-label">Kepada Yth. Bapak/Ibu/Saudara(i):</div>
                <div class="guest-name"><?= htmlspecialchars($guestDisplayName) ?></div>
            </div>

            <button type="button" class="btn-unlock" id="btnUnlockInvitation">
                <i class="bi bi-envelope-open-heart-fill"></i> Buka Undangan
            </button>
        </div>
    </div>

    <!-- MAIN INVITATION FRAME -->
    <div class="invitation-wrapper">

        <!-- 2. HERO SECTION -->
        <section class="hero-section" style="background-image: url('<?= htmlspecialchars($heroPhoto) ?>');">
            <div class="hero-overlay"></div>
            <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                <div class="islamic-frame">
                    <div class="hero-bismillah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
                    <div class="hero-subtitle">The Wedding of</div>
                    <h2 class="hero-names"><?= htmlspecialchars($bNick) ?></h2>
                    <div class="hero-ampersand">&amp;</div>
                    <h2 class="hero-names"><?= htmlspecialchars($gNick) ?></h2>

                    <div class="gold-divider">
                        <i class="bi bi-star-fill"></i>
                    </div>

                    <div class="hero-date-badge">
                        <i class="bi bi-calendar-heart-fill"></i> <?= htmlspecialchars($eventDateFormatted) ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. QUOTE / AR-RUM 21 -->
        <section class="quote-section">
            <div class="quote-card" data-aos="fade-up">
                <div class="quote-arabic">
                    وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا لِّتَسْكُنُوا إِلَيْهَا وَجَعَلَ بَيْنَكُم مَّوَدَّةً وَرَحْمَةً ۚ إِنَّ فِي ذَٰلِكَ لَآيَاتٍ لِّقَوْمٍ يَتَفَكَّرُونَ
                </div>
                <p class="quote-translation">
                    "<?= htmlspecialchars($quoteText) ?>"
                </p>
                <div class="quote-reference"><?= htmlspecialchars($quoteSource) ?></div>
            </div>
        </section>

        <!-- 4. THE COUPLE (MEMPELAI) -->
        <section class="couple-section">
            <div class="section-header" data-aos="fade-up">
                <span class="section-kicker">Pasangan Pengantin</span>
                <h3 class="section-title">Mempelai Mulia</h3>
            </div>

            <!-- Bride (Mempelai Wanita) -->
            <div class="couple-card" data-aos="fade-up">
                <div class="portrait-wrapper">
                    <div class="portrait-mandala"></div>
                    <img src="<?= htmlspecialchars($bridePhoto) ?>" alt="<?= htmlspecialchars($bName) ?>" class="portrait-img">
                </div>
                <h4 class="couple-name"><?= htmlspecialchars($bName) ?></h4>
                <p class="couple-parents">
                    Putri tercinta dari:<br>
                    <strong><?= htmlspecialchars($event['bride_father'] ?? 'Bpk. Hendra Wijaya') ?></strong> &amp;<br>
                    <strong><?= htmlspecialchars($event['bride_mother'] ?? 'Ibu Ratna Kumalasari') ?></strong>
                </p>
                <?php if (!empty($event['bride_instagram'])): ?>
                    <a href="https://instagram.com/<?= htmlspecialchars($event['bride_instagram']) ?>" target="_blank" class="couple-ig">
                        <i class="bi bi-instagram"></i> @<?= htmlspecialchars($event['bride_instagram']) ?>
                    </a>
                <?php endif; ?>
            </div>

            <div class="couple-separator">&amp;</div>

            <!-- Groom (Mempelai Pria) -->
            <div class="couple-card" data-aos="fade-up">
                <div class="portrait-wrapper">
                    <div class="portrait-mandala"></div>
                    <img src="<?= htmlspecialchars($groomPhoto) ?>" alt="<?= htmlspecialchars($gName) ?>" class="portrait-img">
                </div>
                <h4 class="couple-name"><?= htmlspecialchars($gName) ?></h4>
                <p class="couple-parents">
                    Putra tercinta dari:<br>
                    <strong><?= htmlspecialchars($event['groom_father'] ?? 'Bpk. Bambang Pratama') ?></strong> &amp;<br>
                    <strong><?= htmlspecialchars($event['groom_mother'] ?? 'Ibu Sri Handayani') ?></strong>
                </p>
                <?php if (!empty($event['groom_instagram'])): ?>
                    <a href="https://instagram.com/<?= htmlspecialchars($event['groom_instagram']) ?>" target="_blank" class="couple-ig">
                        <i class="bi bi-instagram"></i> @<?= htmlspecialchars($event['groom_instagram']) ?>
                    </a>
                <?php endif; ?>
            </div>
        </section>

        <!-- 5. SCHEDULE (AKAD NIKAH & RESEPSI) -->
        <section class="schedule-section">
            <div class="section-header" data-aos="fade-up">
                <span class="section-kicker">Waktu &amp; Lokasi</span>
                <h3 class="section-title">Agenda Acara</h3>
            </div>

            <!-- Akad Nikah -->
            <div class="schedule-card" data-aos="fade-up">
                <span class="event-type-badge">Akad Nikah</span>
                <h4 class="event-title">Ijab Qabul &amp; Khutbah Nikah</h4>

                <div class="event-info-item">
                    <i class="bi bi-calendar-check-fill"></i>
                    <div>
                        <h6>Hari, Tanggal</h6>
                        <p><?= htmlspecialchars($eventDateFormatted) ?></p>
                    </div>
                </div>

                <div class="event-info-item">
                    <i class="bi bi-clock-fill"></i>
                    <div>
                        <h6>Waktu Pelaksanaan</h6>
                        <p><?= htmlspecialchars($akadTime) ?></p>
                    </div>
                </div>

                <div class="event-info-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div>
                        <h6>Tempat / Lokasi</h6>
                        <p><?= htmlspecialchars($akadLocation) ?></p>
                    </div>
                </div>

                <div class="event-buttons">
                    <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Akad+Nikah+<?= urlencode($bNick . '+&+' . $gNick) ?>&dates=<?= date('Ymd\THis', $eventDateTimestamp) ?>/<?= date('Ymd\THis', $eventDateTimestamp + 7200) ?>&details=Akad+Nikah+<?= urlencode($bNick . '+dan+' . $gNick) ?>&location=<?= urlencode($akadLocation) ?>" target="_blank" class="btn-event-action btn-event-outline">
                        <i class="bi bi-calendar-plus"></i> Simpan Kalender
                    </a>
                    <a href="https://maps.google.com/?q=<?= urlencode($akadLocation) ?>" target="_blank" class="btn-event-action btn-event-gold">
                        <i class="bi bi-map-fill"></i> Petunjuk Arah
                    </a>
                </div>
            </div>

            <!-- Resepsi Pernikahan -->
            <div class="schedule-card" data-aos="fade-up">
                <span class="event-type-badge">Resepsi</span>
                <h4 class="event-title">Walimatul 'Ursy</h4>

                <div class="event-info-item">
                    <i class="bi bi-calendar-check-fill"></i>
                    <div>
                        <h6>Hari, Tanggal</h6>
                        <p><?= htmlspecialchars($eventDateFormatted) ?></p>
                    </div>
                </div>

                <div class="event-info-item">
                    <i class="bi bi-clock-fill"></i>
                    <div>
                        <h6>Waktu Pelaksanaan</h6>
                        <p><?= htmlspecialchars($resepsiTime) ?></p>
                    </div>
                </div>

                <div class="event-info-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div>
                        <h6>Tempat / Lokasi</h6>
                        <p><?= htmlspecialchars($resepsiLocation) ?></p>
                    </div>
                </div>

                <div class="event-buttons">
                    <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Resepsi+Pernikahan+<?= urlencode($bNick . '+&+' . $gNick) ?>&dates=<?= date('Ymd\THis', $eventDateTimestamp + 10800) ?>/<?= date('Ymd\THis', $eventDateTimestamp + 21600) ?>&details=Resepsi+Pernikahan+<?= urlencode($bNick . '+dan+' . $gNick) ?>&location=<?= urlencode($resepsiLocation) ?>" target="_blank" class="btn-event-action btn-event-outline">
                        <i class="bi bi-calendar-plus"></i> Simpan Kalender
                    </a>
                    <a href="https://maps.google.com/?q=<?= urlencode($resepsiLocation) ?>" target="_blank" class="btn-event-action btn-event-gold">
                        <i class="bi bi-map-fill"></i> Petunjuk Arah
                    </a>
                </div>

                <!-- Google Maps Embed Placeholder -->
                <div class="maps-frame-container">
                    <iframe src="https://maps.google.com/maps?q=<?= urlencode($resepsiLocation ?: $akadLocation) ?>&t=&z=15&ie=UTF8&iwloc=&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>

        <!-- 6. LIVE COUNTDOWN TIMER -->
        <section class="countdown-section">
            <div class="section-header" data-aos="fade-up">
                <span class="section-kicker">Menuju Hari Bahagia</span>
                <h3 class="section-title">Hitung Mundur</h3>
            </div>

            <div class="countdown-grid" data-aos="zoom-in">
                <div class="countdown-card">
                    <div class="countdown-number" id="cdDays">00</div>
                    <div class="countdown-label">Hari</div>
                </div>
                <div class="countdown-card">
                    <div class="countdown-number" id="cdHours">00</div>
                    <div class="countdown-label">Jam</div>
                </div>
                <div class="countdown-card">
                    <div class="countdown-number" id="cdMinutes">00</div>
                    <div class="countdown-label">Menit</div>
                </div>
                <div class="countdown-card">
                    <div class="countdown-number" id="cdSeconds">00</div>
                    <div class="countdown-label">Detik</div>
                </div>
            </div>
        </section>

        <!-- 7. HEALTH PROTOCOL & DRESS CODE -->
        <section class="protocol-section">
            <div class="section-header" data-aos="fade-up">
                <span class="section-kicker">Panduan Kehadiran</span>
                <h3 class="section-title">Protokol &amp; Busana</h3>
            </div>

            <div class="protocol-grid" data-aos="fade-up">
                <div class="protocol-card">
                    <div class="protocol-icon"><i class="bi bi-heart-pulse-fill"></i></div>
                    <div class="protocol-title">Kesehatan Prima</div>
                    <p class="protocol-desc">Pastikan kondisi tubuh sehat dan bugar saat menghadiri acara.</p>
                </div>
                <div class="protocol-card">
                    <div class="protocol-icon"><i class="bi bi-droplet-fill"></i></div>
                    <div class="protocol-title">Jaga Kebersihan</div>
                    <p class="protocol-desc">Mencuci tangan atau menggunakan hand sanitizer secara berkala.</p>
                </div>
                <div class="protocol-card">
                    <div class="protocol-icon"><i class="bi bi-people-fill"></i></div>
                    <div class="protocol-title">Salam Santun</div>
                    <p class="protocol-desc">Menghaturkan salam dengan penuh kehangatan dan kesantunan.</p>
                </div>
                <div class="protocol-card">
                    <div class="protocol-icon"><i class="bi bi-shield-check"></i></div>
                    <div class="protocol-title">Busana Syar'i / Sopan</div>
                    <p class="protocol-desc">Mengenakan pakaian rapi, sopan, dan menutup aurat.</p>
                </div>
            </div>

            <div class="dresscode-banner" data-aos="fade-up">
                <h5 class="fw-bold mb-1" style="color: var(--gold-light); font-size: 14px;"><i class="bi bi-palette-fill me-1"></i> Rekomendasi Dress Code</h5>
                <p class="small text-muted mb-0">Tamu undangan dipersilakan mengenakan busana bernuansa Navy, Gold, atau Rose Gold.</p>
                <div class="dresscode-palette">
                    <div class="color-dot" style="background-color: #0E1831;" title="Deep Navy"></div>
                    <div class="color-dot" style="background-color: #D4AF37;" title="Metallic Gold"></div>
                    <div class="color-dot" style="background-color: #E0A99A;" title="Rose Gold"></div>
                    <div class="color-dot" style="background-color: #F8F9FA;" title="Ivory White"></div>
                </div>
            </div>
        </section>

        <!-- 8. DIGITAL GIFT (AMPLOP DIGITAL) -->
        <section class="gift-section">
            <div class="section-header" data-aos="fade-up">
                <span class="section-kicker">Tanda Kasih</span>
                <h3 class="section-title">Amplop Digital</h3>
                <p class="small text-muted mt-2">Doa restu Anda adalah karunia terindah bagi kami. Namun jika ingin memberikan tanda kasih secara digital, Anda dapat menggunakan fasilitas berikut:</p>
            </div>

            <?php foreach ($bankAccounts as $bank): ?>
                <div class="gift-bank-card" data-aos="fade-up">
                    <div class="gift-bank-header">
                        <span class="gift-bank-name"><?= htmlspecialchars($bank['bank'] ?? 'Bank Syariah') ?></span>
                        <div class="gift-bank-chip"></div>
                    </div>
                    <div class="gift-account-number" id="acc_<?= md5($bank['number'] ?? '') ?>"><?= htmlspecialchars($bank['number'] ?? '-') ?></div>
                    <div class="gift-account-holder">a.n <?= htmlspecialchars($bank['owner'] ?? 'Pengantin') ?></div>
                    <button type="button" class="btn-copy-acc" onclick="copyToClipboard('<?= htmlspecialchars($bank['number'] ?? '') ?>')">
                        <i class="bi bi-clipboard-check"></i> Salin Nomor Rekening
                    </button>
                </div>
            <?php endforeach; ?>

            <!-- QRIS E-Wallet Card -->
            <div class="qris-card" data-aos="fade-up">
                <h5 class="fw-bold" style="color: var(--gold-light); font-size: 15px;"><i class="bi bi-qr-code me-2"></i>QRIS Pembayaran Digital</h5>
                <p class="small text-muted mb-2">Pindai kode QRIS menggunakan GoPay, OVO, ShopeePay, DANA, atau Mobile Banking apa saja:</p>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= urlencode('QRIS Wedding of ' . $bNick . ' & ' . $gNick) ?>&color=070D1E" alt="QRIS Digital Gift" class="qris-image">
                <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill font-cinzel">QRIS Standar Indonesia</span>
            </div>

            <?php if (!empty($event['physical_gift_address'])): ?>
                <div class="gift-bank-card" data-aos="fade-up" style="background: var(--navy-card);">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-box2-heart-fill text-warning fs-5"></i>
                        <h6 class="m-0 fw-bold text-white">Kirim Kado Fisik</h6>
                    </div>
                    <p class="small text-muted mb-3" style="line-height: 1.6; white-space: pre-line;"><?= htmlspecialchars($event['physical_gift_address']) ?></p>
                    <button type="button" class="btn-copy-acc" onclick="copyToClipboard(`<?= htmlspecialchars(addslashes($event['physical_gift_address'])) ?>`)">
                        <i class="bi bi-clipboard"></i> Salin Alamat Pengiriman
                    </button>
                </div>
            <?php endif; ?>
        </section>

        <!-- 9. RSVP & WISHES (BUKU TAMU) -->
        <section class="rsvp-section">
            <div class="section-header" data-aos="fade-up">
                <span class="section-kicker">Konfirmasi &amp; Doa</span>
                <h3 class="section-title">Buku Tamu &amp; Ucapan</h3>
            </div>

            <div class="rsvp-form-card" data-aos="fade-up">
                <form id="rsvpForm" action="<?= base_url('u/' . ($event['slug'] ?? 'demo') . '/rsvp') ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-light">Nama Anda</label>
                        <input type="text" name="guest_name" id="rsvpGuestName" class="form-control form-control-dark" value="<?= htmlspecialchars($guestDisplayName !== 'Tamu Undangan Yang Berbahagia' ? $guestDisplayName : '') ?>" placeholder="Nama Lengkap / Panggilan" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-light">Konfirmasi Kehadiran</label>
                        <select name="attendance" id="rsvpAttendance" class="form-select form-control-dark" required>
                            <option value="attending">Insya Allah Hadir</option>
                            <option value="uncertain">Masih Ragu / Diusahakan</option>
                            <option value="not_attending">Berhalangan Hadir</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-light">Doa &amp; Ucapan Restu</label>
                        <textarea name="message" id="rsvpMessage" class="form-control form-control-dark" rows="3" placeholder="Tuliskan ucapan selamat dan doa keberkahan..." required></textarea>
                    </div>

                    <button type="submit" class="btn-submit-rsvp" id="btnSubmitRsvp">
                        <i class="bi bi-send-fill me-1"></i> Kirim Doa &amp; Konfirmasi
                    </button>
                </form>
            </div>

            <!-- Wishes Feed List -->
            <div class="wishes-board" id="wishesContainer" data-aos="fade-up">
                <?php if (!empty($wishes)): ?>
                    <?php foreach ($wishes as $w): ?>
                        <div class="wish-item">
                            <div class="wish-header">
                                <span class="wish-author"><?= htmlspecialchars($w['guest_name'] ?? 'Tamu Undangan') ?></span>
                                <?php 
                                    $att = $w['attendance'] ?? 'attending';
                                    $badgeCls = $att === 'attending' || $att === 'hadir' ? 'badge-hadir' : ($att === 'uncertain' || $att === 'ragu' ? 'badge-ragu' : 'badge-tidak');
                                    $badgeTxt = $att === 'attending' || $att === 'hadir' ? 'Hadir' : ($att === 'uncertain' || $att === 'ragu' ? 'Ragu' : 'Berhalangan');
                                ?>
                                <span class="wish-status-badge <?= $badgeCls ?>"><?= $badgeTxt ?></span>
                            </div>
                            <div class="wish-body"><?= nl2br(htmlspecialchars($w['message'] ?? '')) ?></div>
                            <div class="wish-time"><?= date('d M Y, H:i', strtotime($w['created_at'] ?? 'now')) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-4 text-muted small" id="noWishesAlert">
                        <i class="bi bi-chat-heart fs-3 d-block mb-2 text-warning opacity-50"></i>
                        Belum ada ucapan doa. Jadilah yang pertama memberikan doa restu!
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- 10. FOOTER -->
        <footer class="invitation-footer">
            <div class="footer-logo">PENDAR LOKA</div>
            <p class="small text-muted mb-0">Eksklusif Digital Wedding Invitation</p>
            <p class="small text-muted mt-1 opacity-75">&copy; <?= date('Y') ?> <?= htmlspecialchars($bNick) ?> &amp; <?= htmlspecialchars($gNick) ?>. All rights reserved.</p>
        </footer>
    </div>

    <!-- 11. FLOATING AUDIO DISC & AUTO-SCROLL -->
    <div class="floating-controls">
        <button type="button" class="btn-floating" id="btnAudioToggle" title="Putar Musik">
            <i class="bi bi-music-note-beamed" id="audioIcon"></i>
        </button>
        <button type="button" class="btn-floating" id="btnAutoScroll" title="Auto Scroll">
            <i class="bi bi-arrow-down-circle" id="scrollIcon"></i>
        </button>
    </div>

    <audio id="bgMusic" loop preload="none">
        <source src="<?= htmlspecialchars($musicUrl) ?>" type="audio/mpeg">
    </audio>

    <!-- Custom Toast Notification -->
    <div class="custom-toast" id="customToast">Teks berhasil disalin!</div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 40
        });

        // 1. Cover Modal Unlocker & Music Autoplay Trigger
        const coverModal = document.getElementById('coverModal');
        const btnUnlock = document.getElementById('btnUnlockInvitation');
        const bgMusic = document.getElementById('bgMusic');
        const btnAudioToggle = document.getElementById('btnAudioToggle');
        const audioIcon = document.getElementById('audioIcon');
        let isMusicPlaying = false;

        function playMusic() {
            if (bgMusic) {
                bgMusic.play().then(() => {
                    isMusicPlaying = true;
                    btnAudioToggle.classList.add('rotating');
                    audioIcon.className = 'bi bi-pause-fill';
                }).catch(() => {
                    isMusicPlaying = false;
                });
            }
        }

        if (btnUnlock) {
            btnUnlock.addEventListener('click', () => {
                coverModal.classList.add('unlocked');
                playMusic();
            });
        }

        if (btnAudioToggle) {
            btnAudioToggle.addEventListener('click', () => {
                if (isMusicPlaying) {
                    bgMusic.pause();
                    isMusicPlaying = false;
                    btnAudioToggle.classList.remove('rotating');
                    audioIcon.className = 'bi bi-play-fill';
                } else {
                    bgMusic.play();
                    isMusicPlaying = true;
                    btnAudioToggle.classList.add('rotating');
                    audioIcon.className = 'bi bi-pause-fill';
                }
            });
        }

        // 2. Countdown Timer
        const targetDate = new Date('<?= $eventIsoDate ?>').getTime();
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                document.getElementById('cdDays').innerText = '00';
                document.getElementById('cdHours').innerText = '00';
                document.getElementById('cdMinutes').innerText = '00';
                document.getElementById('cdSeconds').innerText = '00';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('cdDays').innerText = String(days).padStart(2, '0');
            document.getElementById('cdHours').innerText = String(hours).padStart(2, '0');
            document.getElementById('cdMinutes').innerText = String(minutes).padStart(2, '0');
            document.getElementById('cdSeconds').innerText = String(seconds).padStart(2, '0');
        }
        setInterval(updateCountdown, 1000);
        updateCountdown();

        // 3. Copy to Clipboard & Toast
        const customToast = document.getElementById('customToast');
        function showToast(message) {
            if (!customToast) return;
            customToast.innerText = message;
            customToast.classList.add('show');
            setTimeout(() => {
                customToast.classList.remove('show');
            }, 2500);
        }

        function copyToClipboard(text) {
            if (!text) return;
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast('✓ Berhasil disalin ke papan klip');
                }).catch(() => fallbackCopy(text));
            } else {
                fallbackCopy(text);
            }
        }

        function fallbackCopy(text) {
            const tempInput = document.createElement('textarea');
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            showToast('✓ Berhasil disalin ke papan klip');
        }

        // 4. RSVP Submission
        const rsvpForm = document.getElementById('rsvpForm');
        const btnSubmitRsvp = document.getElementById('btnSubmitRsvp');
        if (rsvpForm) {
            rsvpForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                btnSubmitRsvp.disabled = true;
                btnSubmitRsvp.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';

                const formData = new FormData(rsvpForm);
                try {
                    const response = await fetch(rsvpForm.action, {
                        method: 'POST',
                        body: formData
                    });
                    const res = await response.json();
                    if (res.success) {
                        showToast('✓ Doa & Konfirmasi Anda berhasil dikirim!');
                        const container = document.getElementById('wishesContainer');
                        const noAlert = document.getElementById('noWishesAlert');
                        if (noAlert) noAlert.remove();

                        const author = document.getElementById('rsvpGuestName').value;
                        const attendance = document.getElementById('rsvpAttendance').value;
                        const msg = document.getElementById('rsvpMessage').value;

                        const badgeCls = attendance === 'attending' ? 'badge-hadir' : (attendance === 'uncertain' ? 'badge-ragu' : 'badge-tidak');
                        const badgeTxt = attendance === 'attending' ? 'Hadir' : (attendance === 'uncertain' ? 'Ragu' : 'Berhalangan');

                        const newWishHtml = `
                            <div class="wish-item" style="animation: fadeIn 0.5s ease;">
                                <div class="wish-header">
                                    <span class="wish-author">${escapeHtml(author)}</span>
                                    <span class="wish-status-badge ${badgeCls}">${badgeTxt}</span>
                                </div>
                                <div class="wish-body">${escapeHtml(msg).replace(/\n/g, '<br>')}</div>
                                <div class="wish-time">Baru saja</div>
                            </div>
                        `;
                        container.insertAdjacentHTML('afterbegin', newWishHtml);
                        document.getElementById('rsvpMessage').value = '';
                    } else {
                        alert(res.message || 'Gagal mengirim ucapan.');
                    }
                } catch (err) {
                    showToast('✓ Doa & Konfirmasi Anda berhasil dikirim!');
                } finally {
                    btnSubmitRsvp.disabled = false;
                    btnSubmitRsvp.innerHTML = '<i class="bi bi-send-fill me-1"></i> Kirim Doa &amp; Konfirmasi';
                }
            });
        }

        // 5. Auto Scroll
        let scrollInterval = null;
        const btnAutoScroll = document.getElementById('btnAutoScroll');
        const scrollIcon = document.getElementById('scrollIcon');

        if (btnAutoScroll) {
            btnAutoScroll.addEventListener('click', () => {
                if (scrollInterval) {
                    clearInterval(scrollInterval);
                    scrollInterval = null;
                    scrollIcon.className = 'bi bi-arrow-down-circle';
                    showToast('Auto-scroll dimatikan');
                } else {
                    scrollInterval = setInterval(() => {
                        window.scrollBy({ top: 1.5, behavior: 'smooth' });
                        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
                            clearInterval(scrollInterval);
                            scrollInterval = null;
                            scrollIcon.className = 'bi bi-arrow-down-circle';
                        }
                    }, 25);
                    scrollIcon.className = 'bi bi-pause-circle';
                    showToast('Auto-scroll aktif');
                }
            });
        }

        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }
    </script>

    <?php if (defined('BASE_PATH') && file_exists(BASE_PATH . '/views/partials/live_builder_bridge.php')) { require_once BASE_PATH . '/views/partials/live_builder_bridge.php'; } ?>
</body>
</html>