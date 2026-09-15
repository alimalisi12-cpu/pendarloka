<?php
// views/templates/rustic_floral.php
// Tema: Rustic Floral Botanical - Modern Green & Earthy Tone

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

// Konfigurasi Foto Kustom & Fallback
$defaultRusticCover = 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800';
$coverImage = !empty($event['cover_photo']) ? media_url($event['cover_photo']) : (!empty($event['cover_image']) ? media_url($event['cover_image']) : (!empty($galleries[0]) ? media_url($galleries[0]) : $defaultRusticCover));
$heroPhoto = !empty($event['hero_photo']) ? media_url($event['hero_photo']) : (!empty($galleries[0]) ? media_url($galleries[0]) : '');
$bgPhoto = !empty($event['bg_photo']) ? media_url($event['bg_photo']) : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['title']) ?></title>
    
    <meta property="og:title" content="<?= htmlspecialchars($event['title']) ?>">
    <meta property="og:description" content="Undangan digital untuk <?= htmlspecialchars($guestName) ?>. Klik untuk membuka.">
    <meta property="og:image" content="<?= htmlspecialchars($coverImage) ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --botanical-green: #2D5A43;
            --sage-green: #5B8266;
            --light-sage: #E8EFE9;
            --earth-sand: #FAF8F5;
            --text-dark: #1F2923;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #E6ECE8;
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        <?php if (!empty($bgPhoto)): ?>
        body {
            background: linear-gradient(rgba(31, 41, 35, 0.75), rgba(31, 41, 35, 0.75)), url('<?= htmlspecialchars($bgPhoto) ?>') center/cover fixed !important;
        }
        .invitation-wrapper {
            background: linear-gradient(rgba(250, 248, 245, 0.94), rgba(250, 248, 245, 0.94)), url('<?= htmlspecialchars($bgPhoto) ?>') center/cover !important;
        }
        <?php endif; ?>

        .font-script {
            font-family: 'Great Vibes', cursive;
        }

        .font-marcellus {
            font-family: 'Marcellus', serif;
        }

        .invitation-wrapper {
            max-width: 480px;
            margin: 0 auto;
            background-color: var(--earth-sand);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 50px rgba(0,0,0,0.15);
        }

        #coverScreen {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            height: 100vh;
            z-index: 9999;
            background: linear-gradient(rgba(31, 41, 35, 0.7), rgba(31, 41, 35, 0.85)), url('<?= htmlspecialchars($coverImage) ?>') center/cover no-repeat;
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

        .music-toggle-btn {
            position: fixed;
            bottom: 25px;
            left: 20px;
            z-index: 1000;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background-color: #ffffff;
            border: 2px solid var(--botanical-green);
            color: var(--botanical-green);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .music-toggle-btn.spinning {
            animation: spin 3s linear infinite;
        }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        .inv-section {
            padding: 60px 24px;
            text-align: center;
        }

        .btn-botanical {
            background-color: var(--botanical-green);
            color: #ffffff;
            border: none;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(45, 90, 67, 0.3);
            transition: all 0.3s;
        }

        .btn-botanical:hover {
            background-color: var(--sage-green);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .wish-bubble {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 12px;
            border: 1px solid var(--light-sage);
            text-align: left;
        }
    </style>
    <?php do_action('invitation_head', $event); ?>
</head>
<body>

<?php
$rawMusic = $event['music_url'] ?? '';
$resolvedMusicUrl = (!empty($rawMusic) && (str_starts_with($rawMusic, 'http://') || str_starts_with($rawMusic, 'https://'))) ? $rawMusic : base_url($rawMusic ?: 'assets/audio/wedding_music.mp3');
?>
<audio id="bgMusic" loop preload="auto">
    <source src="<?= htmlspecialchars($resolvedMusicUrl) ?>" type="audio/mpeg">
</audio>

<div class="music-toggle-btn" id="musicBtn" onclick="toggleMusic()" style="display: none;">
    <i class="bi bi-disc-fill fs-5" id="musicIcon"></i>
</div>

<div class="invitation-wrapper">

    <!-- COVER SCREEN -->
    <div id="coverScreen" class="trans-<?= $animPageTransition ?> cover-transition-screen">
        <div class="animate__animated animate__fadeInDown">
            <p class="font-marcellus text-uppercase small text-light opacity-75 mb-1">Wedding Invitation</p>
            <h1 class="font-script display-3 text-white m-0"><?= htmlspecialchars($event['groom_nickname'] ?: 'Budi') ?> & <?= htmlspecialchars($event['bride_nickname'] ?: 'Siti') ?></h1>
        </div>

        <div class="p-4 rounded-4" style="background: rgba(0,0,0,0.45); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.15); width: 100%;">
            <p class="small text-white-50 mb-1">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            <h4 class="fw-bold text-white mb-3"><?= htmlspecialchars($guestName) ?></h4>
            <span class="small text-white-50 d-block mb-4" style="font-size: 11px;">*Mohon maaf bila ada kesalahan penulisan nama/gelar</span>

            <button class="btn btn-botanical rounded-pill px-4 py-2 d-inline-flex align-items-center" onclick="openInvitation()">
                <i class="bi bi-envelope-open-fill me-2"></i> Buka Undangan
            </button>
        </div>

        <div class="small text-white-50">
            <i class="bi bi-calendar3 me-1"></i> <?= date('d F Y', strtotime($event['event_date'])) ?>
        </div>
    </div>

    <!-- MAIN BODY -->
    <section class="inv-section pt-5">
        <p class="font-marcellus text-uppercase text-muted small tracking-widest mb-1">The Wedding Of</p>
        <h2 class="font-script display-3 reveal-element <?= $textClass ?>" style="color: var(--botanical-green);">
            <?= htmlspecialchars($event['groom_nickname'] ?: 'Budi') ?> & <?= htmlspecialchars($event['bride_nickname'] ?: 'Siti') ?>
        </h2>
        <p class="text-muted small"><?= date('l, d F Y', strtotime($event['event_date'])) ?></p>

        <?php if (!empty($heroPhoto)): ?>
            <div class="my-4 px-3">
                <img src="<?= htmlspecialchars($heroPhoto) ?>" class="img-fluid rounded-4 shadow reveal-element <?= $photoClass ?>" style="max-height: 420px; width: 100%; object-fit: cover; border: 2px solid var(--sage-green);" alt="Foto Utama Undangan">
            </div>
        <?php endif; ?>

        <div class="p-4 rounded-4 bg-white border mt-4" style="border-color: var(--light-sage) !important;">
            <i class="bi bi-quote fs-2" style="color: var(--botanical-green);"></i>
            <p class="fst-italic text-muted small lh-lg m-0 typewriter-target">
                <?= nl2br(htmlspecialchars($event['quote'] ?: 'Cinta sejati bukanlah tentang menemukan orang yang sempurna, melainkan belajar melihat orang yang tidak sempurna dengan cara yang sempurna.')) ?>
            </p>
        </div>
    </section>

    <!-- MEMPELAI -->
    <section class="inv-section bg-white">
        <h3 class="font-marcellus fw-bold mb-4 reveal-element <?= $textClass ?>" style="color: var(--botanical-green);">Kedua Mempelai</h3>

        <div class="mb-4">
            <div class="rounded-circle mx-auto mb-3 shadow p-1 border border-2" style="width: 130px; height: 130px; border-color: var(--sage-green) !important; overflow: hidden;">
                <img src="<?= htmlspecialchars(!empty($event['groom_photo']) ? media_url($event['groom_photo']) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300') ?>" alt="<?= htmlspecialchars($event['groom_name'] ?: 'Groom') ?>" class="w-100 h-100 object-fit-cover reveal-element <?= $photoClass ?>">
            </div>
            <h4 class="font-marcellus fw-bold text-dark m-0"><?= htmlspecialchars($event['groom_name'] ?: 'Budi Santoso') ?></h4>
            <p class="text-muted small mb-1"><?= htmlspecialchars($event['groom_parents'] ?: 'Putra pertama dari Bpk. Bambang & Ibu Sri') ?></p>
            <?php if (!empty($event['groom_instagram'])): ?>
                <a href="https://instagram.com/<?= ltrim($event['groom_instagram'], '@') ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 mb-2 small" style="font-size: 11px;">
                    <i class="bi bi-instagram text-danger me-1"></i> <?= htmlspecialchars($event['groom_instagram']) ?>
                </a>
            <?php endif; ?>
        </div>

        <div class="display-6 font-script <?= $loopDecorClass ?>" style="color: var(--sage-green);">&</div>

        <div class="mt-4">
            <div class="rounded-circle mx-auto mb-3 shadow p-1 border border-2" style="width: 130px; height: 130px; border-color: var(--sage-green) !important; overflow: hidden;">
                <img src="<?= htmlspecialchars(!empty($event['bride_photo']) ? media_url($event['bride_photo']) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300') ?>" alt="<?= htmlspecialchars($event['bride_name'] ?: 'Bride') ?>" class="w-100 h-100 object-fit-cover reveal-element <?= $photoClass ?>">
            </div>
            <h4 class="font-marcellus fw-bold text-dark m-0"><?= htmlspecialchars($event['bride_name'] ?: 'Siti Aminah') ?></h4>
            <p class="text-muted small mb-1"><?= htmlspecialchars($event['bride_parents'] ?: 'Putri kedua dari Bpk. H. Ahmad & Ibu Fatimah') ?></p>
            <?php if (!empty($event['bride_instagram'])): ?>
                <a href="https://instagram.com/<?= ltrim($event['bride_instagram'], '@') ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 mb-2 small" style="font-size: 11px;">
                    <i class="bi bi-instagram text-danger me-1"></i> <?= htmlspecialchars($event['bride_instagram']) ?>
                </a>
            <?php endif; ?>
        </div>
    </section>

    <!-- WAKTU & LOKASI -->
    <section class="inv-section">
        <h3 class="font-marcellus fw-bold mb-4 reveal-element <?= $textClass ?>" style="color: var(--botanical-green);">Waktu & Tempat</h3>

        <?php if (!empty($customSchedules)): ?>
            <?php foreach ($customSchedules as $session): ?>
                <div class="card p-4 rounded-4 border-0 shadow-sm bg-white mb-3">
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small mb-2 text-uppercase d-inline-block align-self-center"><?= htmlspecialchars($session['name'] ?? 'Acara') ?></span>
                    <h5 class="font-marcellus fw-bold text-dark"><?= htmlspecialchars($session['name'] ?? 'Acara') ?></h5>
                    <?php if (!empty($session['date'])): ?>
                        <p class="fw-bold text-dark small mb-1"><i class="bi bi-calendar3 me-1 text-success"></i> <?= date('l, d F Y', strtotime($session['date'])) ?></p>
                    <?php endif; ?>
                    <p class="fw-bold text-muted small mb-2"><i class="bi bi-clock me-1"></i> <?= htmlspecialchars($session['time'] ?? '') ?></p>
                    <?php if (!empty($session['place'])): ?>
                        <p class="fw-bold text-secondary small mb-1"><i class="bi bi-building me-1"></i> <?= htmlspecialchars($session['place']) ?></p>
                    <?php endif; ?>
                    <p class="text-muted small mb-3"><?= nl2br(htmlspecialchars($session['address'] ?? '')) ?></p>
                    
                    <?php if (!empty($session['maps_url'])): ?>
                        <div>
                            <a href="<?= htmlspecialchars($session['maps_url']) ?>" target="_blank" class="btn btn-botanical btn-sm rounded-pill px-4 py-2">
                                <i class="bi bi-geo-alt-fill me-1"></i> Buka Google Maps
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?php if (!empty($event['maps_url']) && empty($session['maps_url'])): ?>
                <div class="text-center mb-3">
                    <a href="<?= htmlspecialchars($event['maps_url']) ?>" target="_blank" class="btn btn-botanical btn-sm rounded-pill px-4 py-2">
                        <i class="bi bi-geo-alt-fill me-1"></i> Buka Google Maps
                    </a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="card p-4 rounded-4 border-0 shadow-sm bg-white mb-3">
                <h5 class="font-marcellus fw-bold text-dark">Akad Nikah</h5>
                <p class="fw-bold text-muted small"><i class="bi bi-clock me-1"></i> <?= htmlspecialchars($event['akad_time'] ?: '08.00 - 10.00 WIB') ?></p>
                <p class="text-muted small m-0"><?= nl2br(htmlspecialchars($event['akad_location'] ?? '')) ?></p>
            </div>

            <div class="card p-4 rounded-4 border-0 shadow-sm bg-white mb-3">
                <h5 class="font-marcellus fw-bold text-dark">Resepsi</h5>
                <p class="fw-bold text-muted small"><i class="bi bi-clock me-1"></i> <?= htmlspecialchars($event['resepsi_time'] ?: '11.00 - 14.00 WIB') ?></p>
                <p class="text-muted small mb-3"><?= nl2br(htmlspecialchars($event['resepsi_location'] ?? '')) ?></p>
                
                <?php if (!empty($event['maps_url'])): ?>
                    <a href="<?= $event['maps_url'] ?>" target="_blank" class="btn btn-botanical btn-sm rounded-pill px-4 py-2">
                        <i class="bi bi-geo-alt-fill me-1"></i> Buka Google Maps
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($event['maps_embed'])): ?>
            <div class="rounded-4 overflow-hidden border shadow-sm mb-3">
                <?= $event['maps_embed'] ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- KISAH CINTA / LOVE STORY -->
    <?php if (!empty($loveStories)): ?>
        <section class="inv-section">
            <span class="text-uppercase small tracking-widest fw-semibold d-block mb-1" style="color: var(--terracotta);">Our Journey</span>
            <h3 class="font-marcellus fw-bold mb-4" style="color: var(--botanical-green);">Kisah Cinta Kami</h3>
            <div class="text-start">
                <?php foreach ($loveStories as $story): ?>
                    <div class="card p-3 rounded-4 border-0 shadow-sm bg-white mb-3">
                        <?php if (!empty($story['image'])): ?>
                            <img src="<?= htmlspecialchars(media_url($story['image'])) ?>" class="img-fluid rounded-3 mb-3 w-100" style="max-height: 220px; object-fit: cover;" alt="<?= htmlspecialchars($story['title'] ?? 'Kisah Cinta') ?>">
                        <?php endif; ?>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h5 class="font-marcellus fw-bold m-0" style="color: var(--botanical-green);"><?= htmlspecialchars($story['title'] ?? '') ?></h5>
                            <?php if (!empty($story['year']) || !empty($story['date'])): ?>
                                <span class="badge rounded-pill text-white px-2.5 py-1 small" style="background-color: var(--terracotta); font-size: 11px;"><?= htmlspecialchars($story['year'] ?? $story['date'] ?? '') ?></span>
                            <?php endif; ?>
                        </div>
                        <p class="text-muted small m-0 lh-base"><?= nl2br(htmlspecialchars($story['desc'] ?? $story['story'] ?? '')) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- GALERI PREWEDDING -->
    <?php if (!empty($galleries)): ?>
        <section class="inv-section bg-white">
            <h3 class="font-marcellus fw-bold mb-3" style="color: var(--botanical-green);">Galeri Bahagia</h3>
            <div class="row g-2">
                <?php foreach ($galleries as $gImg): 
                    $gImgUrl = media_url($gImg);
                ?>
                    <div class="col-6">
                        <div class="rounded-3 overflow-hidden shadow-sm position-relative" style="height: 160px; cursor: pointer;">
                            <img src="<?= htmlspecialchars($gImgUrl) ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- RSVP & BUKU TAMU -->
    <section class="inv-section bg-white">
        <h3 class="font-marcellus fw-bold mb-3" style="color: var(--botanical-green);">Buku Tamu & RSVP</h3>
        
        <div class="card p-4 rounded-4 border shadow-sm text-start mb-4">
            <form id="rsvpForm" onsubmit="submitRsvp(event)">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nama Anda</label>
                    <input type="text" id="guestNameInput" name="guest_name" class="form-control rounded-3" value="<?= htmlspecialchars($guestName !== 'Tamu Undangan' ? $guestName : '') ?>" placeholder="Nama lengkap" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Konfirmasi Kehadiran</label>
                    <select name="attendance" id="attendanceSelect" class="form-select rounded-3" onchange="handleAttendanceChange(this.value)" required>
                        <option value="" selected disabled>Status</option>
                        <option value="attending">Hadir</option>
                        <option value="not_attending">Berhalangan Hadir / Tidak Hadir</option>
                        <option value="uncertain">Ragu-ragu (Optional)</option>
                    </select>
                </div>
                <div class="mb-3" id="paxContainer" style="display: none;">
                    <label class="form-label small fw-bold">Jumlah Tamu (Pax)</label>
                    <select name="pax" id="paxSelect" class="form-select rounded-3">
                        <option value="1">1 Orang</option>
                        <option value="2">2 Orang</option>
                        <option value="3">3 Orang</option>
                        <option value="4">4 Orang+</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Ucapan & Doa</label>
                    <textarea name="message" id="messageInput" class="form-control rounded-3" rows="3" placeholder="Tuliskan doa restu..."></textarea>
                </div>
                <button type="submit" id="btnSubmitRsvp" class="btn btn-botanical w-100 rounded-pill py-2">
                    Kirim Ucapan
                </button>
                <!-- Tombol Hadir muncul HANYA jika opsi Hadir dipilih -->
                <button type="button" id="btnConfirmHadir" onclick="confirmHadirNow()" class="btn btn-success w-100 rounded-pill py-2 mt-2 shadow-sm" style="display: none; background-color: #198754; border-color: #198754; font-weight: 600;">
                    <i class="bi bi-check-circle-fill me-1"></i> Hadir
                </button>
            </form>
        </div>

        <div id="wishesList" class="text-start">
            <?php foreach ($wishes as $w): 
                $wName = $w['guest_name'] ?? $w['name'] ?? 'Tamu Undangan';
                $wAttendance = $w['attendance'] ?? 'attending';
            ?>
                <div class="wish-bubble">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold text-dark small"><?= htmlspecialchars($wName) ?></span>
                        <?php if ($wAttendance === 'attending'): ?>
                            <span class="badge bg-success-subtle text-success small" style="font-size: 10px;">Hadir</span>
                        <?php elseif ($wAttendance === 'not_attending'): ?>
                            <span class="badge bg-danger-subtle text-danger small" style="font-size: 10px;">Tidak Hadir</span>
                        <?php else: ?>
                            <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 10px;">Ragu-ragu</span>
                        <?php endif; ?>
                    </div>
                    <p class="text-muted small m-0"><?= nl2br(htmlspecialchars($w['message'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- FOOTER & QR CODE DINAMIS -->
    <section class="inv-section pb-5" id="section-qrcode">
        <h3 class="font-script display-4 mb-2" style="color: var(--botanical-green);">Terima Kasih</h3>
        <p class="small text-muted mb-4"><?= htmlspecialchars($event['groom_nickname'] ?: 'Budi') ?> & <?= htmlspecialchars($event['bride_nickname'] ?: 'Siti') ?></p>

        <!-- CARD BARCODE DINAMIS -->
        <div id="bottomBarcodeCard" class="card p-4 rounded-4 border bg-white shadow-sm mt-3 text-center mx-auto" style="max-width: 360px; transition: all 0.3s ease;">
            <!-- STATE A: Barcode Unik Check-In Kehadiran (Default & saat Hadir) -->
            <div id="qrCheckinState">
                <div class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-success-subtle text-success mb-2" style="width: 44px; height: 44px;">
                    <i class="bi bi-qr-code-scan fs-4"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1" id="barcodeTitle">Barcode Check-In Kehadiran</h6>
                <div class="mb-2">
                    <span class="badge bg-success-subtle text-success small px-3 py-1 rounded-pill">Konfirmasi Kehadiran</span>
                </div>
                
                <div class="d-block text-center my-2">
                    <div class="p-2 bg-light rounded-3 border d-inline-block shadow-sm">
                        <img id="checkinQrImg" src="<?= 'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=' . urlencode(base_url('u/' . $event['slug'] . '?checkin=' . urlencode(!empty($currentGuest['qr_code']) ? $currentGuest['qr_code'] : $guestName))) ?>" class="rounded-2" style="width: 135px; height: 135px;" alt="Barcode Check-in">
                    </div>
                </div>
                <div class="small fw-semibold text-muted mb-1 font-monospace" id="checkinCodeText"><?= htmlspecialchars(!empty($currentGuest['qr_code']) ? $currentGuest['qr_code'] : 'CHECKIN-' . strtoupper(substr(md5($guestName), 0, 8))) ?></div>
                <span class="small text-muted d-block" style="font-size: 11px;">
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
                    <div class="p-2 bg-light rounded-3 border d-inline-block shadow-sm">
                        <img id="transferQrImg" src="<?= 'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=' . urlencode(base_url('u/' . $event['slug'] . '#section-gift')) ?>" class="rounded-2" style="width: 135px; height: 135px;" alt="Barcode Transfer Digital">
                    </div>
                </div>
                
                <span class="small text-muted d-block mb-3" style="font-size: 11px;">
                    Scan barcode atau salin rekening di bawah ini untuk mengirim tanda kasih / transfer kepada pemilik acara:
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

        <div class="pt-3 border-top mt-4">
            <a href="<?= base_url() ?>" target="_blank" class="text-muted text-decoration-none small" style="font-size: 11px;">
                Powered by <b><?= APP_NAME ?></b>
            </a>
        </div>
    </section>

</div>

<script>
function openInvitation() {
    const cover = document.getElementById('coverScreen');
    if (cover) {
        cover.classList.add('opened');
        setTimeout(() => {
            cover.style.display = 'none';
        }, 1100);
    }
    const music = document.getElementById('bgMusic');
    const musicBtn = document.getElementById('musicBtn');
    if (music) {
        music.play().then(() => {
            if (musicBtn) {
                musicBtn.style.display = 'flex';
                musicBtn.classList.add('spinning');
            }
        }).catch(e => {
            if (musicBtn) musicBtn.style.display = 'flex';
        });
    }
}

function toggleMusic() {
    const music = document.getElementById('bgMusic');
    const musicBtn = document.getElementById('musicBtn');
    if (music.paused) {
        music.play();
        musicBtn.classList.add('spinning');
    } else {
        music.pause();
        musicBtn.classList.remove('spinning');
    }
}

// Salin Nomor Rekening dengan Fallback
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

// Handler Dinamis Pilihan Opsi Kehadiran
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

// Konfirmasi Kehadiran Instan (Tombol Hadir)
function confirmHadirNow() {
    const form = document.getElementById('rsvpForm');
    const nameInput = document.getElementById('guestNameInput');
    const guestName = nameInput ? nameInput.value.trim() : '';

    if (!guestName) {
        alert('Silakan masukkan Nama Anda terlebih dahulu!');
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

            if (res.data && res.data.qr_url) {
                const qrImg = document.getElementById('checkinQrImg');
                if (qrImg) qrImg.src = res.data.qr_url;
                const codeText = document.getElementById('checkinCodeText');
                if (codeText && res.data.qr_code) codeText.innerText = res.data.qr_code;
            }

            const list = document.getElementById('wishesList');
            if (list && res.data) {
                const div = document.createElement('div');
                div.className = 'wish-bubble animate__animated animate__fadeInUp';
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
        alert('Terjadi kesalahan koneksi saat konfirmasi kehadiran.');
    });
}

// Submit RSVP via AJAX
function submitRsvp(e) {
    e.preventDefault();
    const form = document.getElementById('rsvpForm');
    const select = document.getElementById('attendanceSelect');
    if (!select || !select.value) {
        alert('Silakan pilih status kehadiran terlebih dahulu!');
        if (select) select.focus();
        return;
    }

    const formData = new FormData(form);
    const btn = document.getElementById('btnSubmitRsvp');
    const originalHtml = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';

    fetch('<?= base_url('u/' . $event['slug'] . '/rsvp') ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = originalHtml;

        if (data.success) {
            alert(data.message);

            if (data.data.attendance === 'attending' && data.data.qr_url) {
                const qrImg = document.getElementById('checkinQrImg');
                if (qrImg) qrImg.src = data.data.qr_url;
                const codeText = document.getElementById('checkinCodeText');
                if (codeText && data.data.qr_code) codeText.innerText = data.data.qr_code;

                const btnHadir = document.getElementById('btnConfirmHadir');
                if (btnHadir) {
                    btnHadir.disabled = true;
                    btnHadir.className = 'btn btn-success w-100 rounded-pill py-2 mt-2 shadow-sm';
                    btnHadir.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Terkonfirmasi Hadir (' + data.data.pax + ' Pax)';
                }
            }

            const wishesList = document.getElementById('wishesList');
            const newWish = document.createElement('div');
            newWish.className = 'wish-bubble animate__animated animate__fadeInUp';
            const badgeHtml = data.data.attendance === 'attending'
                ? `<span class="badge bg-success-subtle text-success small" style="font-size: 10px;">Hadir (${data.data.pax} Pax)</span>`
                : (data.data.attendance === 'not_attending'
                    ? '<span class="badge bg-danger-subtle text-danger small" style="font-size: 10px;">Tidak Hadir</span>'
                    : '<span class="badge bg-secondary-subtle text-secondary small" style="font-size: 10px;">Ragu-ragu</span>');
            newWish.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-bold text-dark small">${data.data.guest_name}</span>
                    ${badgeHtml}
                </div>
                <p class="text-muted small m-0">${data.data.message.replace(/\n/g, '<br>')}</p>
            `;
            wishesList.prepend(newWish);
            const msgEl = document.getElementById('messageInput');
            if (msgEl) msgEl.value = '';
        } else {
            alert("Gagal: " + data.message);
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = originalHtml;
        alert("Terjadi kesalahan koneksi. Silakan coba lagi.");
    });
}
</script>

<?php do_action('invitation_footer', $event); ?>
</body>
</html>
