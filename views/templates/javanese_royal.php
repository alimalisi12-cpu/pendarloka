<?php
// views/templates/javanese_royal.php
// Template: Traditional Javanese Royal Wedding (Immersive Full-Screen Gapura Cover, Wayang Ornaments, Earthy Tones)

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];

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

$gNick = !empty($event['groom_nickname']) ? trim($event['groom_nickname']) : 'Romeo';
$bNick = !empty($event['bride_nickname']) ? trim($event['bride_nickname']) : 'Juliet';
$gName = !empty($event['groom_name']) ? trim($event['groom_name']) : 'Raden Mas Romeo Joyodiningrat, S.T.';
$bName = !empty($event['bride_name']) ? trim($event['bride_name']) : 'Raden Ajeng Juliet Sekar Arum, S.Sn.';

$guestDisplayName = !empty($guestName) ? $guestName : 'Bapak / Ibu / Saudara(i)';
$musicUrl = !empty($event['music_url']) ? media_url($event['music_url']) : 'https://cdn.freesound.org/previews/469/469009_9518146-lq.mp3';

$eventDateTimestamp = strtotime($event['event_date'] ?? '+30 days');
$eventDateFormatted = date('d F Y', $eventDateTimestamp);
$eventIsoDate = date('Y-m-d\TH:i:s', $eventDateTimestamp);

$akadTime = !empty($event['akad_time']) ? $event['akad_time'] : '08:00 - 10:00 WIB';
$akadLocation = !empty($event['akad_location']) ? $event['akad_location'] : 'Pendhapa Ndalem Ngayogyakarta Hadiningrat';
$resepsiTime = !empty($event['resepsi_time']) ? $event['resepsi_time'] : '11:00 - 14:00 WIB';
$resepsiLocation = !empty($event['resepsi_location']) ? $event['resepsi_location'] : 'Sasana Hinggil Dwijoseputro, Alun-Alun Kidul, Yogyakarta';

$groomPhoto = !empty($event['groom_photo']) ? media_url($event['groom_photo']) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80';
$bridePhoto = !empty($event['bride_photo']) ? media_url($event['bride_photo']) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=600&auto=format&fit=crop&q=80';
$gapuraCoverPhoto = !empty($event['cover_photo']) ? media_url($event['cover_photo']) : 'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?w=1920&auto=format&fit=crop&q=85';
$parentWa = !empty($event['groom_instagram']) ? preg_replace('/[^0-9]/', '', $event['groom_instagram']) : '6281234567890';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['title'] ?? ('Pawiwahan Ageng ' . $bNick . ' & ' . $gNick)) ?></title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🪭</text></svg>" type="image/png">

    <!-- Google Fonts: Cormorant Garamond, Playfair Display, Great Vibes, Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --terracotta: #A44A3F;
            --terracotta-dark: #82342B;
            --deep-brown: #2C1810;
            --dark-forest: #1E3326;
            --forest-soft: #284433;
            --wood-dark: #120905;
            --parang-cream: #FAF6EF;
            --parang-surface: #F3EBDD;

            --gold-soft: #D4AF37;
            --gold-light: #F4E2A1;
            --gold-deep: #AA8220;
            --gold-gradient: linear-gradient(135deg, #ECC880 0%, #D4AF37 50%, #9F7922 100%);
            --gold-border: rgba(212, 175, 55, 0.35);

            --text-dark: #2A1A12;
            --text-muted: #6B5547;
            --radius-card: 22px;
            --radius-pill: 999px;
            --shadow-subtle: 0 10px 30px rgba(44, 24, 16, 0.1);
            --shadow-deep: 0 18px 45px rgba(31, 16, 11, 0.25);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-tap-highlight-color: transparent; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--wood-dark);
            color: var(--text-dark);
            line-height: 1.8;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .font-serif { font-family: 'Playfair Display', Georgia, serif; }
        .font-cormorant { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-script { font-family: 'Great Vibes', cursive; }

        .page-container {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
            position: relative;
            background-color: var(--parang-cream);
            min-height: 100vh;
            box-shadow: 0 0 60px rgba(0, 0, 0, 0.8), 0 0 25px rgba(212, 175, 55, 0.2);
            border-left: 1px solid var(--gold-border);
            border-right: 1px solid var(--gold-border);
            overflow: hidden;
            z-index: 2;
        }

        /* PART 2: THE IMMERSIVE FULL-SCREEN COVER OVERLAY (GAPURA BACKGROUND) */
        #gateCoverOverlay {
            position: fixed;
            inset: 0;
            width: 100vw;
            min-height: 100vh;
            height: 100vh;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: transparent;
            transform-origin: center center;
            transition: transform 1.6s cubic-bezier(0.16, 1, 0.3, 1), opacity 1.4s ease;
        }

        #gateCoverOverlay.gate-opened {
            transform: scale(3);
            opacity: 0;
            pointer-events: none;
        }

        /* Layer 1: Lowest Z-Index (1): Full-Screen Symmetrical Javanese Gate Background */
        .gate-bg-layer {
            position: absolute;
            inset: 0;
            width: 100vw;
            min-height: 100vh;
            height: 100vh;
            background-size: cover;
            background-position: center bottom;
            background-attachment: fixed;
            background-repeat: no-repeat;
            z-index: 1;
        }

        .gate-vignette {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 50%, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0.65) 70%, rgba(0, 0, 0, 0.85) 100%);
            z-index: 1;
        }

        /* Layer 2: Middle Z-Index (2): Falling Leaves Animation Canvas */
        .falling-leaves-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 2;
        }

        /* Layer 3: Highest Z-Index (3): Text Overlay & Readability (NO BOX CONTAINER) */
        .cover-content-layer {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
            max-width: 600px;
            padding: 30px 24px;
        }

        .cover-subtitle {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 6px;
            text-transform: uppercase;
            color: var(--gold-light);
            margin-bottom: 12px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        .cover-couple-name {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 46px;
            font-weight: 400;
            letter-spacing: 2px;
            color: var(--gold-light);
            line-height: 1.25;
            margin: 0 0 16px 0;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        @media (max-width: 480px) {
            .cover-couple-name { font-size: 36px; }
        }

        .cover-ornament-divider {
            color: var(--gold-soft);
            font-size: 22px;
            margin-bottom: 22px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        .cover-recipient-label {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 17px;
            font-style: italic;
            font-weight: 400;
            color: #FDFBF7;
            letter-spacing: 1px;
            margin-bottom: 6px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        .cover-recipient-name {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 22px;
            font-weight: 500;
            color: #FFFFFF;
            letter-spacing: 1px;
            margin: 0 0 32px 0;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        /* Button Styling */
        .btn-open-gate {
            background: transparent;
            border: 1.5px solid var(--gold-soft);
            color: var(--gold-light);
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 14px 44px;
            border-radius: var(--radius-pill);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            transition: all 0.4s ease;
        }

        .btn-open-gate:hover {
            background: rgba(212, 175, 55, 0.15);
            color: #FFFFFF;
            border-color: #F4E2A1;
            box-shadow: 0 0 25px rgba(212, 175, 55, 0.8), inset 0 0 15px rgba(212, 175, 55, 0.25);
            transform: scale(1.05);
        }

        /* Floating Wayang */
        .wayang-float-anchor {
            position: fixed;
            top: 25%;
            width: 85px;
            max-height: 240px;
            pointer-events: none;
            z-index: 3;
            opacity: 0.75;
        }
        .wayang-left { left: 10px; animation: wayangBobLeft 6s ease-in-out infinite alternate; }
        .wayang-right { right: 10px; transform: scaleX(-1); animation: wayangBobRight 6.5s ease-in-out infinite alternate; }

        @keyframes wayangBobLeft {
            0% { transform: translateY(0) rotate(-2deg); }
            50% { transform: translateY(-16px) rotate(1deg); }
            100% { transform: translateY(0) rotate(-2deg); }
        }
        @keyframes wayangBobRight {
            0% { transform: scaleX(-1) translateY(0) rotate(-2deg); }
            50% { transform: scaleX(-1) translateY(-14px) rotate(2deg); }
            100% { transform: scaleX(-1) translateY(0) rotate(-2deg); }
        }
        .wayang-float-anchor img { width: 100%; height: auto; }

        @media (max-width: 480px) {
            .wayang-float-anchor { width: 55px; opacity: 0.4; }
        }

        /* Sections */
        .section-padding { padding: 55px 24px; position: relative; z-index: 1; }
        .section-header { text-align: center; margin-bottom: 34px; }
        .section-kicker {
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--terracotta);
            font-weight: 700;
            display: block;
            margin-bottom: 6px;
        }
        .section-title { font-family: 'Cormorant Garamond', Georgia, serif; font-size: 28px; color: var(--deep-brown); font-weight: 700; letter-spacing: 1px; }
        .javanese-divider { display: flex; align-items: center; justify-content: center; gap: 12px; margin: 16px auto 0; width: 160px; }
        .javanese-divider::before, .javanese-divider::after { content: ''; height: 1.5px; flex: 1; background: linear-gradient(90deg, transparent, var(--gold-soft), transparent); }
        .javanese-divider span { color: var(--gold-deep); font-size: 16px; }

        /* Hero */
        .hero-section {
            padding: 50px 24px 40px;
            text-align: center;
            background: linear-gradient(180deg, var(--parang-surface) 0%, var(--parang-cream) 100%);
            border-bottom: 2px solid var(--gold-border);
        }
        .gunungan-center { width: 75px; margin: 0 auto 16px; filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2)); }
        .hero-names { font-family: 'Playfair Display', Georgia, serif; font-size: 32px; font-weight: 600; color: var(--terracotta-dark); margin-bottom: 4px; line-height: 1.3; }
        .hero-ampersand { font-family: 'Great Vibes', cursive; font-size: 40px; color: var(--gold-deep); margin: 2px 0; }
        .hero-date-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--terracotta);
            color: #FFFFFF;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 24px;
            border-radius: var(--radius-pill);
            margin-top: 18px;
        }

        /* Profile */
        .profile-card {
            background: #FFFFFF;
            border: 1px solid rgba(212, 175, 55, 0.35);
            border-radius: var(--radius-card);
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 26px;
            box-shadow: var(--shadow-subtle);
        }
        .portrait-frame {
            width: 140px;
            height: 140px;
            margin: 0 auto 18px;
            border-radius: 50%;
            padding: 6px;
            background: var(--gold-gradient);
        }
        .portrait-img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 3px solid #FFFFFF; }
        .couple-title-name { font-family: 'Playfair Display', serif; font-size: 21px; font-weight: 700; color: var(--terracotta-dark); margin-bottom: 6px; }
        .couple-parents-text { font-size: 13.5px; color: var(--text-muted); line-height: 1.6; }

        /* Countdown */
        .countdown-wrapper {
            background: var(--deep-brown);
            color: #FFFFFF;
            border-radius: var(--radius-card);
            padding: 30px 18px;
            text-align: center;
            border: 1.5px solid var(--gold-soft);
            box-shadow: var(--shadow-deep);
            margin-bottom: 30px;
        }
        .countdown-title-text { font-family: 'Cormorant Garamond', serif; font-size: 19px; color: var(--gold-light); margin-bottom: 20px; letter-spacing: 1px; }
        .countdown-boxes-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
        .countdown-item { background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 14px; padding: 12px 6px; }
        .countdown-number { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: var(--gold-light); line-height: 1.1; }
        .countdown-label { font-size: 10.5px; text-transform: uppercase; letter-spacing: 1px; color: #D1C2B4; margin-top: 4px; }

        /* Event Details */
        .event-card {
            background: #FFFFFF;
            border: 1px solid var(--gold-border);
            border-radius: var(--radius-card);
            padding: 28px 22px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-subtle);
            border-top: 4px solid var(--terracotta);
        }
        .event-type-tag {
            background: var(--forest-soft);
            color: #FFFFFF;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 700;
            padding: 5px 16px;
            border-radius: var(--radius-pill);
            display: inline-block;
            margin-bottom: 14px;
        }
        .event-detail-row { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 14px; }
        .event-detail-row i { font-size: 18px; color: var(--terracotta); margin-top: 2px; }
        .event-detail-row div h6 { font-size: 14px; font-weight: 700; color: var(--deep-brown); margin-bottom: 2px; }
        .event-detail-row div p { font-size: 13px; color: var(--text-muted); margin: 0; line-height: 1.5; }

        .maps-iframe-wrapper {
            margin-top: 18px;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--gold-border);
            height: 190px;
        }
        .maps-iframe-wrapper iframe { width: 100%; height: 100%; border: none; }

        /* Gallery */
        .masonry-grid { columns: 2; column-gap: 14px; }
        .masonry-item { break-inside: avoid; margin-bottom: 14px; border-radius: 16px; overflow: hidden; border: 3px solid #FFFFFF; box-shadow: 0 8px 20px rgba(44, 24, 16, 0.12); }
        .masonry-item img { width: 100%; height: auto; display: block; }

        /* Bank Cards */
        .bank-card {
            background: linear-gradient(135deg, #351C12, #210F08);
            border: 1.5px solid var(--gold-soft);
            border-radius: 18px;
            padding: 24px 20px;
            color: #FFFFFF;
            margin-bottom: 18px;
            box-shadow: var(--shadow-deep);
        }
        .bank-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .bank-name { font-family: 'Cormorant Garamond', serif; font-size: 17px; color: var(--gold-light); font-weight: 700; }
        .account-number { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; letter-spacing: 2px; color: #FFFFFF; margin-bottom: 4px; }
        .account-holder { font-size: 13px; color: #D6C2B4; margin-bottom: 16px; }

        .btn-copy-clipboard {
            background: rgba(212, 175, 55, 0.2);
            border: 1px solid var(--gold-soft);
            color: var(--gold-light);
            font-size: 12px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: var(--radius-pill);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition-smooth);
        }
        .btn-copy-clipboard:hover { background: var(--gold-soft); color: var(--wood-dark); }

        /* RSVP */
        .rsvp-container {
            background: #FFFFFF;
            border: 1px solid var(--gold-border);
            border-radius: var(--radius-card);
            padding: 30px 22px;
            box-shadow: var(--shadow-subtle);
        }
        .form-label-javanese { font-size: 13px; font-weight: 700; color: var(--deep-brown); display: block; margin-bottom: 6px; }
        .form-input-javanese {
            width: 100%;
            border-radius: 12px;
            border: 1px solid #D5C2B4;
            padding: 12px 16px;
            font-size: 13.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            margin-bottom: 16px;
        }
        .btn-rsvp-wa {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: #FFFFFF;
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 700;
            padding: 15px 28px;
            border-radius: var(--radius-pill);
            border: none;
            cursor: pointer;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
        }

        /* Footer */
        .javanese-footer { padding: 45px 24px; text-align: center; background: var(--deep-brown); color: #CDB79E; border-top: 2px solid var(--gold-soft); }
        .footer-brand { font-family: 'Cormorant Garamond', serif; font-size: 20px; color: var(--gold-light); margin-bottom: 6px; font-weight: 700; letter-spacing: 1px; }

        /* Audio Toggle */
        .btn-audio-disc {
            position: fixed;
            bottom: 24px;
            right: 20px;
            z-index: 999;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--deep-brown);
            border: 2px solid var(--gold-soft);
            color: var(--gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
        }
        .btn-audio-disc.spinning { animation: spinDisc 6s linear infinite; }
        @keyframes spinDisc { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        /* Admin Modal */
        #adminModal {
            position: fixed;
            inset: 0;
            z-index: 999999;
            background: rgba(13, 6, 3, 0.95);
            backdrop-filter: blur(14px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        }
        #adminModal.show { display: flex; }
        .admin-dashboard-box {
            width: 100%;
            max-width: 640px;
            background: #18110D;
            border: 1.5px solid var(--gold-soft);
            border-radius: 24px;
            color: #F3EBDD;
            overflow: hidden;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }
        .admin-header {
            padding: 20px 24px;
            background: #251610;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-close-admin { background: transparent; border: none; color: #CDB79E; font-size: 24px; cursor: pointer; }
        .admin-body { padding: 24px; overflow-y: auto; }
        .admin-section-title { font-size: 12px; text-transform: uppercase; letter-spacing: 2px; color: var(--gold-light); font-weight: 700; margin: 18px 0 10px; border-bottom: 1px solid rgba(212, 175, 55, 0.2); }
        .admin-form-group { margin-bottom: 14px; }
        .admin-label { font-size: 12px; font-weight: 600; color: #CDB79E; display: block; margin-bottom: 4px; }
        .admin-input {
            width: 100%;
            background: #0E0805;
            border: 1px solid rgba(212, 175, 55, 0.3);
            color: #FFFFFF;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            font-family: monospace;
        }
        .admin-footer {
            padding: 16px 24px;
            background: #251610;
            border-top: 1px solid rgba(212, 175, 55, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-save-admin {
            background: var(--gold-gradient);
            color: var(--wood-dark);
            font-weight: 700;
            font-size: 13.5px;
            padding: 10px 24px;
            border-radius: var(--radius-pill);
            border: none;
            cursor: pointer;
        }
        .btn-reset-admin {
            background: transparent;
            color: #E29E8E;
            border: 1px solid #E29E8E;
            font-size: 12.5px;
            padding: 8px 16px;
            border-radius: var(--radius-pill);
            cursor: pointer;
        }
        .toast-popup {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #251610;
            border: 1.5px solid var(--gold-soft);
            color: var(--gold-light);
            padding: 12px 24px;
            border-radius: var(--radius-pill);
            font-size: 13.5px;
            font-weight: 600;
            z-index: 9999999;
            opacity: 0;
            transition: all 0.4s ease;
        }
        .toast-popup.show { opacity: 1; transform: translateX(-50%) translateY(0); }
    </style>
</head>
<body>

    <!-- 1. IMMERSIVE FULL-SCREEN GAPURA COVER OVERLAY -->
    <div id="gateCoverOverlay">
        <div class="gate-bg-layer" id="gateBgLayer" style="background-image: url('<?= htmlspecialchars($gapuraCoverPhoto) ?>');">
            <div class="gate-vignette"></div>
        </div>

        <canvas id="fallingLeavesCanvas" class="falling-leaves-canvas"></canvas>

        <div class="cover-content-layer">
            <div class="cover-subtitle">Pawiwahan Ageng</div>
            <h1 class="cover-couple-name" id="coverCoupleNames"><?= htmlspecialchars($bNick) ?> &amp; <?= htmlspecialchars($gNick) ?></h1>
            <div class="cover-ornament-divider">❖</div>

            <div class="cover-recipient-label">Kepada Yth.</div>
            <div class="cover-recipient-name" id="coverRecipientName"><?= htmlspecialchars($guestDisplayName) ?></div>

            <button type="button" class="btn-open-gate" id="btnOpenInvitation">
                <i class="bi bi-door-open-fill"></i> Buka Undangan
            </button>
        </div>
    </div>

    <!-- Floating Wayang Ornaments -->
    <div class="wayang-float-anchor wayang-left">
        <img id="floatingWayangLeft" src="https://cdn-icons-png.flaticon.com/512/3252/3252199.png" alt="Wayang Left">
    </div>
    <div class="wayang-float-anchor wayang-right">
        <img id="floatingWayangRight" src="https://cdn-icons-png.flaticon.com/512/3252/3252199.png" alt="Wayang Right">
    </div>

    <!-- MAIN CONTENT -->
    <main class="page-container">
        <!-- 1. HERO SECTION -->
        <section class="hero-section">
            <img id="heroGununganIcon" src="https://cdn-icons-png.flaticon.com/512/3252/3252199.png" alt="Gunungan" class="gunungan-center">
            <div class="section-kicker">Serat Ulem Pawiwahan</div>
            <h2 class="hero-names" id="heroBrideNick"><?= htmlspecialchars($bNick) ?></h2>
            <div class="hero-ampersand">&amp;</div>
            <h2 class="hero-names" id="heroGroomNick"><?= htmlspecialchars($gNick) ?></h2>

            <div class="javanese-divider"><span>❖</span></div>

            <div class="hero-date-pill">
                <i class="bi bi-calendar-event"></i> <span id="heroDateDisplay"><?= htmlspecialchars($eventDateFormatted) ?></span>
            </div>
        </section>

        <!-- 2. PROFILE SECTION -->
        <section class="section-padding">
            <div class="section-header">
                <span class="section-kicker">Sri Penganten</span>
                <h3 class="section-title">Temanten Sekar Kekalih</h3>
                <div class="javanese-divider"><span>❖</span></div>
            </div>

            <div class="profile-card">
                <div class="portrait-frame">
                    <img id="profileBridePhoto" src="<?= htmlspecialchars($bridePhoto) ?>" alt="Pengantin Putri" class="portrait-img">
                </div>
                <h4 class="couple-title-name" id="profileBrideName"><?= htmlspecialchars($bName) ?></h4>
                <p class="couple-parents-text" id="profileBrideParents">
                    Putri kaping kalih saking panjenenganipun:<br>
                    <strong><?= htmlspecialchars($event['bride_father'] ?? 'Bpk. K.R.T. Hardjodipuro') ?></strong> &amp; <strong><?= htmlspecialchars($event['bride_mother'] ?? 'Ibu Nyi Mas Sri Handayani') ?></strong>
                </p>
            </div>

            <div class="profile-card">
                <div class="portrait-frame">
                    <img id="profileGroomPhoto" src="<?= htmlspecialchars($groomPhoto) ?>" alt="Pengantin Kakung" class="portrait-img">
                </div>
                <h4 class="couple-title-name" id="profileGroomName"><?= htmlspecialchars($gName) ?></h4>
                <p class="couple-parents-text" id="profileGroomParents">
                    Putra pambayun saking panjenenganipun:<br>
                    <strong><?= htmlspecialchars($event['groom_father'] ?? 'Bpk. K.R.M. Sosronegoro') ?></strong> &amp; <strong><?= htmlspecialchars($event['groom_mother'] ?? 'Ibu Nyi Raden Endang Wahyuni') ?></strong>
                </p>
            </div>
        </section>

        <!-- 3. COUNTDOWN TIMER -->
        <section class="section-padding" style="padding-top: 0; padding-bottom: 20px;">
            <div class="countdown-wrapper">
                <div class="countdown-title-text">⏳ Cacahing Dinten Tumuju Pawiwahan</div>
                <div class="countdown-boxes-grid">
                    <div class="countdown-item">
                        <div class="countdown-number" id="cdDays">00</div>
                        <div class="countdown-label">Dinten</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="cdHours">00</div>
                        <div class="countdown-label">Tabuh</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="cdMinutes">00</div>
                        <div class="countdown-label">Menit</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="cdSeconds">00</div>
                        <div class="countdown-label">Detik</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. EVENT DETAILS -->
        <section class="section-padding" style="background: var(--parang-surface);">
            <div class="section-header">
                <span class="section-kicker">Wanci &amp; Papan</span>
                <h3 class="section-title">Tata Titimangsa Acara</h3>
                <div class="javanese-divider"><span>❖</span></div>
            </div>

            <div class="event-card">
                <span class="event-type-tag">Ijab Qabul / Akad</span>
                <div class="event-detail-row">
                    <i class="bi bi-calendar-check-fill"></i>
                    <div>
                        <h6>Dinten &amp; Surya</h6>
                        <p id="eventAkadDate"><?= htmlspecialchars($eventDateFormatted) ?></p>
                    </div>
                </div>
                <div class="event-detail-row">
                    <i class="bi bi-clock-fill"></i>
                    <div>
                        <h6>Wanci / Tabuh</h6>
                        <p id="eventAkadTime"><?= htmlspecialchars($akadTime) ?></p>
                    </div>
                </div>
                <div class="event-detail-row">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div>
                        <h6>Papan Palenggahan</h6>
                        <p id="eventAkadLocation"><?= htmlspecialchars($akadLocation) ?></p>
                    </div>
                </div>
            </div>

            <div class="event-card">
                <span class="event-type-tag" style="background: var(--terracotta);">Resepsi / Pahargyan</span>
                <div class="event-detail-row">
                    <i class="bi bi-calendar-check-fill"></i>
                    <div>
                        <h6>Dinten &amp; Surya</h6>
                        <p id="eventResepsiDate"><?= htmlspecialchars($eventDateFormatted) ?></p>
                    </div>
                </div>
                <div class="event-detail-row">
                    <i class="bi bi-clock-fill"></i>
                    <div>
                        <h6>Wanci / Tabuh</h6>
                        <p id="eventResepsiTime"><?= htmlspecialchars($resepsiTime) ?></p>
                    </div>
                </div>
                <div class="event-detail-row">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div>
                        <h6>Papan Palenggahan</h6>
                        <p id="eventResepsiLocation"><?= htmlspecialchars($resepsiLocation) ?></p>
                    </div>
                </div>

                <div class="maps-iframe-wrapper">
                    <iframe id="mapsEmbedIframe" src="https://maps.google.com/maps?q=<?= urlencode($resepsiLocation ?: $akadLocation) ?>&t=&z=15&ie=UTF8&iwloc=&output=embed" loading="lazy"></iframe>
                </div>
            </div>
        </section>

        <!-- 5. MASONRY GALLERY -->
        <section class="section-padding">
            <div class="section-header">
                <span class="section-kicker">Koleksi Foto</span>
                <h3 class="section-title">Pasarean Tresna</h3>
                <div class="javanese-divider"><span>❖</span></div>
            </div>

            <div class="masonry-grid" id="galleryContainer">
                <?php foreach ($galleries as $idx => $photo): ?>
                    <div class="masonry-item">
                        <img src="<?= htmlspecialchars($photo) ?>" alt="Pasarean Tresna #<?= $idx + 1 ?>" loading="lazy">
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- 6. DIGITAL GIFT -->
        <section class="section-padding" style="background: var(--parang-surface);">
            <div class="section-header">
                <span class="section-kicker">Tandha Katresnan</span>
                <h3 class="section-title">Kado Digital</h3>
                <div class="javanese-divider"><span>❖</span></div>
            </div>

            <div class="bank-card">
                <div class="bank-card-header">
                    <span class="bank-name">Bank Central Asia (BCA)</span>
                    <i class="bi bi-credit-card-2-front text-warning fs-4"></i>
                </div>
                <div class="account-number" id="bankAccNumber">8210987654</div>
                <div class="account-holder" id="bankAccHolder">a.n <?= htmlspecialchars($bName) ?></div>
                <button type="button" class="btn-copy-clipboard" onclick="copyText('8210987654')">
                    <i class="bi bi-clipboard-check"></i> Turunaken / Salin Rekening
                </button>
            </div>
        </section>

        <!-- 7. RSVP FORM -->
        <section class="section-padding">
            <div class="rsvp-container">
                <div class="section-header" style="margin-bottom: 22px;">
                    <span class="section-kicker">Konfirmasi Rawuh</span>
                    <h3 class="section-title">Serat Palapuran</h3>
                    <div class="javanese-divider"><span>❖</span></div>
                </div>

                <form id="rsvpForm">
                    <label class="form-label-javanese">Asma Jangkep (Nama Lengkap):</label>
                    <input type="text" id="rsvpName" class="form-input-javanese" value="<?= htmlspecialchars($guestDisplayName !== 'Bapak / Ibu / Saudara(i)' ? $guestDisplayName : '') ?>" placeholder="Tulisen asma panjenengan..." required>

                    <label class="form-label-javanese">Palapuran Rawuh (Status Kehadiran):</label>
                    <select id="rsvpAttendance" class="form-input-javanese">
                        <option value="Saged Rawuh">Insya Allah Saged Rawuh (Hadir)</option>
                        <option value="Taksih Rangu-rangu">Taksih Rangu-rangu (Masih Ragu)</option>
                        <option value="Nyuwun Pangapunten Mboten Saged">Nyuwun Pangapunten Mboten Saged Rawuh (Berhalangan)</option>
                    </select>

                    <label class="form-label-javanese">Cacahing Tamu (Jumlah Tamu):</label>
                    <select id="rsvpPax" class="form-input-javanese">
                        <option value="1">1 Orang</option>
                        <option value="2">2 Orang</option>
                        <option value="3">3 Orang</option>
                        <option value="4+">4+ Orang</option>
                    </select>

                    <label class="form-label-javanese">Donga Pamuji (Doa / Ucapan Restu):</label>
                    <textarea id="rsvpMessage" class="form-input-javanese" rows="3" placeholder="Paringi donga pamuji dhumateng temanten kekalih..."></textarea>

                    <button type="button" class="btn-rsvp-wa" id="btnSubmitWa">
                        <i class="bi bi-whatsapp fs-5"></i> Kirim Rawuh Lumantar WhatsApp
                    </button>
                </form>
            </div>
        </section>

        <footer class="javanese-footer">
            <div class="footer-brand">PENDAR LOKA</div>
            <p class="small text-muted mb-0">Pawiwahan Ageng Adat Jawa</p>
            <p class="small text-muted mt-1 opacity-75">&copy; <?= date('Y') ?> Rahayu Sagung Dumadi.</p>
        </footer>
    </main>

    <!-- Floating Audio -->
    <button type="button" class="btn-audio-disc" id="btnAudioToggle" title="Gending Jawa">
        <i class="bi bi-music-note-beamed" id="audioIcon"></i>
    </button>
    <audio id="bgAudio" loop preload="none">
        <source id="audioSource" src="<?= htmlspecialchars($musicUrl) ?>" type="audio/mpeg">
    </audio>

    <!-- Hidden Admin Dashboard Modal (?admin=true) -->
    <div id="adminModal">
        <div class="admin-dashboard-box">
            <div class="admin-header">
                <h4><i class="bi bi-gear-wide-connected text-warning"></i> Javanese CMS Admin Dashboard</h4>
                <button type="button" class="btn-close-admin" id="btnCloseAdmin">&times;</button>
            </div>

            <div class="admin-body">
                <p class="small text-muted mb-2">Edit media assets, target countdown date, and WhatsApp phone number below. Changes are saved to <code>localStorage</code> dynamically.</p>

                <div class="admin-section-title">🖼️ Media &amp; Visual Ornaments</div>
                <div class="admin-form-group">
                    <label class="admin-label">Gapura Full-Screen Gate Image URL</label>
                    <input type="text" id="admGapuraUrl" class="admin-input" placeholder="URL Gambar Gapura Penuh">
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Left Wayang Ornament URL</label>
                    <input type="text" id="admWayangLeftUrl" class="admin-input" placeholder="URL Wayang Kiri">
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Right Wayang Ornament URL</label>
                    <input type="text" id="admWayangRightUrl" class="admin-input" placeholder="URL Wayang Kanan">
                </div>

                <div class="admin-section-title">📸 Couple Portraits</div>
                <div class="admin-form-group">
                    <label class="admin-label">Bride Portrait URL</label>
                    <input type="text" id="admBridePhotoUrl" class="admin-input" placeholder="URL Foto Pengantin Putri">
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Groom Portrait URL</label>
                    <input type="text" id="admGroomPhotoUrl" class="admin-input" placeholder="URL Foto Pengantin Pria">
                </div>

                <div class="admin-section-title">🎶 Audio &amp; Event Countdown</div>
                <div class="admin-form-group">
                    <label class="admin-label">Background Audio URL (.mp3)</label>
                    <input type="text" id="admAudioUrl" class="admin-input" placeholder="URL Musik Latar .mp3">
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Target Event Date (YYYY-MM-DDTHH:MM)</label>
                    <input type="datetime-local" id="admTargetDate" class="admin-input">
                </div>

                <div class="admin-section-title">📱 WhatsApp RSVP Destination</div>
                <div class="admin-form-group">
                    <label class="admin-label">WhatsApp Number (e.g. 6281234567890)</label>
                    <input type="text" id="admWaNumber" class="admin-input" placeholder="Nomor WA diawali 62">
                </div>

                <div class="admin-section-title">🖼️ Gallery Photos (Comma Separated)</div>
                <div class="admin-form-group">
                    <label class="admin-label">Gallery Photo URLs</label>
                    <textarea id="admGalleryUrls" class="admin-input" rows="3" placeholder="https://..., https://..."></textarea>
                </div>
            </div>

            <div class="admin-footer">
                <button type="button" class="btn-reset-admin" id="btnResetDefaults">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset ke Bawaan
                </button>
                <button type="button" class="btn-save-admin" id="btnSaveAdmin">
                    <i class="bi bi-check-circle-fill"></i> Save &amp; Apply
                </button>
            </div>
        </div>
    </div>

    <div class="toast-popup" id="toastNotice">Salin teks berhasil!</div>

    <script>
        const DEFAULT_CONFIG = {
            gapuraUrl: '<?= addslashes($gapuraCoverPhoto) ?>',
            wayangLeftUrl: 'https://cdn-icons-png.flaticon.com/512/3252/3252199.png',
            wayangRightUrl: 'https://cdn-icons-png.flaticon.com/512/3252/3252199.png',
            bridePhotoUrl: '<?= addslashes($bridePhoto) ?>',
            groomPhotoUrl: '<?= addslashes($groomPhoto) ?>',
            audioUrl: '<?= addslashes($musicUrl) ?>',
            targetEventDate: '<?= substr($eventIsoDate, 0, 16) ?>',
            whatsappNumber: '<?= addslashes($parentWa) ?>',
            galleryPhotos: <?= json_encode($galleries) ?>
        };

        const STORAGE_KEY = 'pendar_javanese_wedding_cfg_v1';

        function getActiveConfig() {
            try {
                const stored = localStorage.getItem(STORAGE_KEY);
                if (stored) return Object.assign({}, DEFAULT_CONFIG, JSON.parse(stored));
            } catch (err) {}
            return DEFAULT_CONFIG;
        }

        let currentConfig = getActiveConfig();

        function applyDataToDOM() {
            const gateBgLayer = document.getElementById('gateBgLayer');
            if (gateBgLayer) {
                gateBgLayer.style.backgroundImage = `url('${currentConfig.gapuraUrl}')`;
            }

            document.getElementById('floatingWayangLeft').src = currentConfig.wayangLeftUrl;
            document.getElementById('floatingWayangRight').src = currentConfig.wayangRightUrl;
            document.getElementById('profileBridePhoto').src = currentConfig.bridePhotoUrl;
            document.getElementById('profileGroomPhoto').src = currentConfig.groomPhotoUrl;

            const audioSource = document.getElementById('audioSource');
            const bgAudio = document.getElementById('bgAudio');
            if (audioSource) {
                audioSource.src = currentConfig.audioUrl;
                bgAudio.load();
            }
        }

        // Gate Scale Transition (scale(3) and fade out)
        const gateCoverOverlay = document.getElementById('gateCoverOverlay');
        const btnOpenInvitation = document.getElementById('btnOpenInvitation');
        const bgAudio = document.getElementById('bgAudio');
        const btnAudioToggle = document.getElementById('btnAudioToggle');
        const audioIcon = document.getElementById('audioIcon');
        let isAudioPlaying = false;

        function playGending() {
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

        if (btnOpenInvitation) {
            btnOpenInvitation.addEventListener('click', () => {
                gateCoverOverlay.classList.add('gate-opened');
                playGending();
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

        // Falling Leaves Animation (Middle Z-Index)
        function initFallingLeaves() {
            const canvas = document.getElementById('fallingLeavesCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width = canvas.width = window.innerWidth;
            let height = canvas.height = window.innerHeight;

            window.addEventListener('resize', () => {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            });

            const leaves = [];
            const leafColors = [
                'rgba(212, 175, 55, 0.75)',
                'rgba(244, 226, 161, 0.7)',
                'rgba(164, 74, 63, 0.65)',
                'rgba(205, 133, 63, 0.7)',
                'rgba(238, 203, 117, 0.8)'
            ];

            for (let i = 0; i < 35; i++) {
                leaves.push({
                    x: Math.random() * width,
                    y: Math.random() * height - height,
                    size: Math.random() * 11 + 7,
                    speedY: Math.random() * 1.3 + 0.7,
                    speedX: Math.random() * 1.2 - 0.6,
                    rotation: Math.random() * 360,
                    rotSpeed: Math.random() * 2 - 1,
                    swing: Math.random() * 2.2 + 1,
                    swingSpeed: Math.random() * 0.025 + 0.015,
                    swingAngle: Math.random() * Math.PI * 2,
                    color: leafColors[Math.floor(Math.random() * leafColors.length)]
                });
            }

            function drawLeaf(ctx, x, y, size, angle, color) {
                ctx.save();
                ctx.translate(x, y);
                ctx.rotate(angle * Math.PI / 180);
                ctx.fillStyle = color;
                ctx.beginPath();
                ctx.moveTo(0, -size);
                ctx.bezierCurveTo(size * 0.75, -size * 0.35, size * 0.75, size * 0.35, 0, size);
                ctx.bezierCurveTo(-size * 0.75, size * 0.35, -size * 0.75, -size * 0.35, 0, -size);
                ctx.fill();

                ctx.strokeStyle = 'rgba(0, 0, 0, 0.2)';
                ctx.lineWidth = 1;
                ctx.beginPath();
                ctx.moveTo(0, -size * 0.8);
                ctx.lineTo(0, size * 0.8);
                ctx.stroke();
                ctx.restore();
            }

            function animateLeaves() {
                ctx.clearRect(0, 0, width, height);
                leaves.forEach(leaf => {
                    leaf.swingAngle += leaf.swingSpeed;
                    leaf.x += leaf.speedX + Math.sin(leaf.swingAngle) * leaf.swing;
                    leaf.y += leaf.speedY;
                    leaf.rotation += leaf.rotSpeed;

                    if (leaf.y > height + 20) {
                        leaf.y = -20;
                        leaf.x = Math.random() * width;
                    }
                    if (leaf.x > width + 20) leaf.x = -20;
                    if (leaf.x < -20) leaf.x = width + 20;

                    drawLeaf(ctx, leaf.x, leaf.y, leaf.size, leaf.rotation, leaf.color);
                });
                requestAnimationFrame(animateLeaves);
            }
            animateLeaves();
        }

        // Countdown
        function updateCountdown() {
            const targetTime = new Date(currentConfig.targetEventDate).getTime();
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
        setInterval(updateCountdown, 1000);

        // WhatsApp RSVP
        const btnSubmitWa = document.getElementById('btnSubmitWa');
        if (btnSubmitWa) {
            btnSubmitWa.addEventListener('click', () => {
                const name = document.getElementById('rsvpName').value.trim();
                const att = document.getElementById('rsvpAttendance').value;
                const pax = document.getElementById('rsvpPax').value;
                const msg = document.getElementById('rsvpMessage').value.trim();

                if (!name) {
                    alert('Nyuwun tulung isi asma panjenengan rumiyin!');
                    document.getElementById('rsvpName').focus();
                    return;
                }

                let text = `Nuwun Sewu, Kulanuwun... 🙏\n\n`;
                text += `Kula *${name}* ngaturaken palapuran rawuh kangge Pawiwahan Ageng:\n`;
                text += `• Katerangan Rawuh: *${att}*\n`;
                text += `• Cacahing Tamu: *${pax} Orang*\n`;
                if (msg) text += `• Donga Pamuji: "${msg}"\n`;
                text += `\nMatur nuwun sanget, mugi temanten kekalih tansah pinaringan berkah lan rahayu. ✨`;

                const waPhone = currentConfig.whatsappNumber.replace(/[^0-9]/g, '');
                window.open(`https://api.whatsapp.com/send?phone=${waPhone}&text=${encodeURIComponent(text)}`, '_blank');
            });
        }

        function copyText(str) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(str).then(() => showToast('✓ Nomor rekening sampun kasalin!'));
            } else {
                showToast('✓ Nomor rekening sampun kasalin!');
            }
        }

        function showToast(msg) {
            const toast = document.getElementById('toastNotice');
            if (!toast) return;
            toast.innerText = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2500);
        }

        // Admin Access via ?admin=true
        function checkAdminAccess() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('admin') === 'true') {
                document.getElementById('adminModal').classList.add('show');
                populateAdminForm();
            }
        }

        function populateAdminForm() {
            document.getElementById('admGapuraUrl').value = currentConfig.gapuraUrl;
            document.getElementById('admWayangLeftUrl').value = currentConfig.wayangLeftUrl;
            document.getElementById('admWayangRightUrl').value = currentConfig.wayangRightUrl;
            document.getElementById('admBridePhotoUrl').value = currentConfig.bridePhotoUrl;
            document.getElementById('admGroomPhotoUrl').value = currentConfig.groomPhotoUrl;
            document.getElementById('admAudioUrl').value = currentConfig.audioUrl;
            document.getElementById('admTargetDate').value = currentConfig.targetEventDate;
            document.getElementById('admWaNumber').value = currentConfig.whatsappNumber;
            document.getElementById('admGalleryUrls').value = (currentConfig.galleryPhotos || []).join(',\n');
        }

        document.getElementById('btnCloseAdmin')?.addEventListener('click', () => {
            document.getElementById('adminModal').classList.remove('show');
        });

        document.getElementById('btnSaveAdmin')?.addEventListener('click', () => {
            const galleryRaw = document.getElementById('admGalleryUrls').value;
            const galleryArray = galleryRaw.split(',').map(u => u.trim()).filter(u => u.length > 5);

            const newConfig = {
                gapuraUrl: document.getElementById('admGapuraUrl').value.trim() || DEFAULT_CONFIG.gapuraUrl,
                wayangLeftUrl: document.getElementById('admWayangLeftUrl').value.trim() || DEFAULT_CONFIG.wayangLeftUrl,
                wayangRightUrl: document.getElementById('admWayangRightUrl').value.trim() || DEFAULT_CONFIG.wayangRightUrl,
                bridePhotoUrl: document.getElementById('admBridePhotoUrl').value.trim() || DEFAULT_CONFIG.bridePhotoUrl,
                groomPhotoUrl: document.getElementById('admGroomPhotoUrl').value.trim() || DEFAULT_CONFIG.groomPhotoUrl,
                audioUrl: document.getElementById('admAudioUrl').value.trim() || DEFAULT_CONFIG.audioUrl,
                targetEventDate: document.getElementById('admTargetDate').value || DEFAULT_CONFIG.targetEventDate,
                whatsappNumber: document.getElementById('admWaNumber').value.trim() || DEFAULT_CONFIG.whatsappNumber,
                galleryPhotos: galleryArray.length ? galleryArray : DEFAULT_CONFIG.galleryPhotos
            };

            localStorage.setItem(STORAGE_KEY, JSON.stringify(newConfig));
            alert('✓ Konfigurasi Javanese Wedding berhasil disimpan ke localStorage!');
            window.location.reload();
        });

        document.getElementById('btnResetDefaults')?.addEventListener('click', () => {
            if (confirm('Pulihkan seluruh konfigurasi ke nilai bawaan?')) {
                localStorage.removeItem(STORAGE_KEY);
                window.location.reload();
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            applyDataToDOM();
            initFallingLeaves();
            updateCountdown();
            checkAdminAccess();
        });
    </script>

    <?php if (defined('BASE_PATH') && file_exists(BASE_PATH . '/views/partials/live_builder_bridge.php')) { require_once BASE_PATH . '/views/partials/live_builder_bridge.php'; } ?>
</body>
</html>