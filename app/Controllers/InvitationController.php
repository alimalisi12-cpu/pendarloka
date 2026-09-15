<?php
// app/Controllers/InvitationController.php

require_once dirname(__DIR__, 2) . '/config/app.php';
require_once dirname(__DIR__) . '/Models/Event.php';
require_once dirname(__DIR__) . '/Models/Wish.php';
require_once dirname(__DIR__) . '/Models/Guest.php';

class InvitationController {
    private $eventModel;
    private $wishModel;
    private $guestModel;

    public function __construct() {
        $this->eventModel = new Event();
        $this->wishModel = new Wish();
        $this->guestModel = new Guest();
    }

    public function show($slug) {
        $event = $this->eventModel->findBySlug($slug);
        if (!$event) {
            http_response_code(404);
            die("Undangan tidak ditemukan atau tautan salah.");
        }

        // Tangkap nama tamu dari query param: ?kpd=Nama+Tamu
        $guestName = isset($_GET['kpd']) && trim($_GET['kpd']) !== '' ? sanitize($_GET['kpd']) : 'Tamu Undangan';

        // Ambil daftar ucapan & buku tamu
        $wishes = $this->wishModel->getByEventId($event['id']);

        // Ambil konfigurasi kustomisasi tema & efek oleh admin
        $themeConfig = json_decode($event['theme_config_json'] ?? '[]', true) ?: [
            'primary_color' => '#928573',
            'secondary_color' => '#E1D6C7',
            'font_heading' => 'Great Vibes',
            'font_body' => 'Playfair Display',
            'effect_particle' => 'petals',
            'show_nav_dock' => 1,
            'bg_pattern' => 'floral'
        ];

        // Ambil konfigurasi animasi & transisi template
        $animConfig = json_decode($event['animation_config_json'] ?? '[]', true) ?: [
            'entrance_text' => 'slide_up',
            'entrance_photo' => 'zoom_in',
            'loop_decor' => 'floating',
            'page_transition' => 'slide',
            'smooth_scroll' => 1,
            'hover_effect' => 1,
            'reveal_on_scroll' => 1
        ];

        $animEntranceText = $animConfig['entrance_text'] ?? 'slide_up';
        $animEntrancePhoto = $animConfig['entrance_photo'] ?? 'zoom_in';
        $animLoopDecor = $animConfig['loop_decor'] ?? 'floating';
        $animPageTransition = $animConfig['page_transition'] ?? 'slide';
        $animSmoothScroll = !empty($animConfig['smooth_scroll']);
        $animHoverEffect = !empty($animConfig['hover_effect']);
        $animRevealOnScroll = !empty($animConfig['reveal_on_scroll']);

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

        // Template view file
        $templateView = $event['view_file'] ?? 'nature_classic';
        $templatePath = BASE_PATH . '/views/templates/' . $templateView . '.php';

        if (!file_exists($templatePath)) {
            $templatePath = BASE_PATH . '/views/templates/nature_classic.php';
        }

        $GLOBALS['animConfig'] = $animConfig;
        $GLOBALS['event'] = $event;

        // Ambil data tamu saat ini jika sudah terdaftar di buku tamu
        $currentGuest = null;
        if ($guestName !== 'Tamu Undangan') {
            $db = Database::getInstance();
            $stmtGuest = $db->prepare("SELECT * FROM guests WHERE event_id = ? AND LOWER(name) = LOWER(?) LIMIT 1");
            $stmtGuest->execute([$event['id'], trim($guestName)]);
            $currentGuest = $stmtGuest->fetch();
            if (!$currentGuest) {
                $stmtGuest = $db->prepare("SELECT * FROM guests WHERE event_id = ? AND LOWER(name) LIKE LOWER(?) LIMIT 1");
                $stmtGuest->execute([$event['id'], '%' . trim($guestName) . '%']);
                $currentGuest = $stmtGuest->fetch();
            }
        }

        require $templatePath;

        // Jaminan keamanan: pastikan universal animation engine selalu aktif
        if (!defined('UNIVERSAL_ANIMATION_ENGINE_DEFINED')) {
            $animPartialPath = BASE_PATH . '/views/partials/universal_animation_engine.php';
            if (file_exists($animPartialPath)) {
                require_once $animPartialPath;
            }
        }

        // Jaminan keamanan: pastikan universal autoscroll selalu aktif untuk semua template yang ada & template baru
        if (!defined('UNIVERSAL_AUTOSCROLL_LOADED')) {
            $partialPath = BASE_PATH . '/views/partials/universal_autoscroll.php';
            if (file_exists($partialPath)) {
                require_once $partialPath;
            }
        }
    }

    public function rsvp($slug) {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            exit;
        }

        $event = $this->eventModel->findBySlug($slug);
        if (!$event) {
            echo json_encode(['success' => false, 'message' => 'Acara tidak ditemukan']);
            exit;
        }

        $guestName = sanitize($_POST['guest_name'] ?? '');
        $attendance = sanitize($_POST['attendance'] ?? 'attending');
        $message = sanitize($_POST['message'] ?? '');
        $pax = max(1, (int)($_POST['pax'] ?? 1));
        $isDirectHadir = !empty($_POST['is_direct_hadir']);

        if (empty($guestName)) {
            echo json_encode(['success' => false, 'message' => 'Nama lengkap wajib diisi!']);
            exit;
        }

        // Jika ucapan kosong, buatkan pesan default yang sopan
        if (empty($message)) {
            if ($attendance === 'attending' || $isDirectHadir) {
                $message = "Mengonfirmasi kehadiran ($pax Orang). Selamat & sukses untuk kedua mempelai!";
            } else if ($attendance === 'not_attending') {
                $message = "Selamat berbahagia untuk kedua mempelai, mohon maaf kami berhalangan hadir.";
            } else {
                $message = "Selamat untuk kedua mempelai! Doa terbaik selalu menyertai.";
            }
        }

        // Simpan ucapan ke tabel wishes
        $this->wishModel->add($event['id'], $guestName, $attendance, $message);

        // Cari apakah tamu sudah ada di tabel guests
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT id, qr_code FROM guests WHERE event_id = ? AND LOWER(name) = LOWER(?) LIMIT 1");
        $stmt->execute([$event['id'], trim($guestName)]);
        $existingGuest = $stmt->fetch();

        if (!$existingGuest) {
            $stmt = $db->prepare("SELECT id, qr_code FROM guests WHERE event_id = ? AND LOWER(name) LIKE LOWER(?) LIMIT 1");
            $stmt->execute([$event['id'], '%' . trim($guestName) . '%']);
            $existingGuest = $stmt->fetch();
        }

        if ($existingGuest) {
            $guestId = $existingGuest['id'];
            $qrCode = !empty($existingGuest['qr_code']) 
                ? $existingGuest['qr_code'] 
                : ('CHECKIN-' . strtoupper(substr(md5($event['id'] . '-' . $guestName . '-' . uniqid()), 0, 8)));
            
            if (empty($existingGuest['qr_code'])) {
                $db->prepare("UPDATE guests SET qr_code = ? WHERE id = ?")->execute([$qrCode, $guestId]);
            }
            $this->guestModel->updateRsvp($guestId, $attendance, $pax);
        } else {
            // Otomatis masukkan tamu baru ke tabel guests
            $guestSlug = preg_replace('/[^a-z0-9]+/i', '-', strtolower(trim($guestName)));
            $qrCode = 'CHECKIN-' . strtoupper(substr(md5($event['id'] . '-' . $guestName . '-' . uniqid()), 0, 8));
            $stmtInsert = $db->prepare("INSERT INTO guests (event_id, name, slug, rsvp_status, attendance_count, qr_code) VALUES (?, ?, ?, ?, ?, ?)");
            $stmtInsert->execute([$event['id'], $guestName, $guestSlug, $attendance, $pax, $qrCode]);
            $guestId = $db->lastInsertId();
        }

        $checkinUrl = base_url('u/' . $event['slug'] . '?checkin=' . urlencode($qrCode) . '&guest=' . urlencode($guestName));
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=' . urlencode($checkinUrl);

        $bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];

        $successMsg = ($attendance === 'attending')
            ? 'Kehadiran Anda berhasil dikonfirmasi dan telah tercatat di Buku Tamu! Barcode check-in Anda telah aktif di bawah.'
            : 'Terima kasih atas doa dan konfirmasi Anda. Kami memahami Anda berhalangan hadir.';

        echo json_encode([
            'success' => true,
            'message' => $successMsg,
            'data' => [
                'guest_id' => $guestId,
                'guest_name' => $guestName,
                'attendance' => $attendance,
                'pax' => $pax,
                'message' => $message,
                'qr_code' => $qrCode,
                'qr_url' => $qrUrl,
                'checkin_url' => $checkinUrl,
                'bank_accounts' => $bankAccounts,
                'created_at' => 'Baru saja'
            ]
        ]);
        exit;
    }
}
