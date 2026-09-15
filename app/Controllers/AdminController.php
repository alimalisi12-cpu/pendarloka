<?php
// app/Controllers/AdminController.php

require_once dirname(__DIR__, 2) . '/config/app.php';
require_once dirname(__DIR__) . '/Models/User.php';
require_once dirname(__DIR__) . '/Models/Event.php';
require_once dirname(__DIR__) . '/Models/Template.php';

class AdminController {
    private $userModel;
    private $eventModel;
    private $templateModel;

    public function __construct() {
        if (!is_logged_in() || !is_admin()) {
            set_flash('error', 'Akses hanya untuk Administrator.');
            redirect('login');
        }

        $this->userModel = new User();
        $this->eventModel = new Event();
        $this->templateModel = new Template();
    }

    public function index() {
        $counts = $this->eventModel->getCounts();
        $recentEvents = $this->eventModel->getAllEvents();
        $users = $this->userModel->getAllUsers();
        $templates = $this->templateModel->getAllAdmin();

        require_once BASE_PATH . '/views/admin/index.php';
    }

    public function events() {
        $events = $this->eventModel->getAllEvents();
        require_once BASE_PATH . '/views/admin/events.php';
    }

    public function deleteEvent($id) {
        $event = $this->eventModel->findById($id);
        if (!$event) {
            set_flash('error', 'Acara undangan tidak ditemukan.');
            redirect('admin/events');
        }

        $this->eventModel->delete($id);
        set_flash('success', "Undangan '{$event['title']}' berhasil dihapus secara permanen.");
        redirect('admin/events');
    }

    public function updateEventTradition($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/events');
        }

        $event = $this->eventModel->findById($id);
        if (!$event) {
            set_flash('error', 'Acara undangan tidak ditemukan.');
            redirect('admin/events');
        }

        $preset = sanitize($_POST['event_type_preset'] ?? 'islam');
        $quote = sanitize($_POST['quote'] ?? '');
        $mapsUrl = sanitize($_POST['maps_url'] ?? '');

        // Susun sesi acara dinamis
        $scheduleNames = $_POST['schedule_name'] ?? [];
        $scheduleDates = $_POST['schedule_date'] ?? [];
        $scheduleTimes = $_POST['schedule_time'] ?? [];
        $schedulePlaces = $_POST['schedule_place'] ?? [];
        $scheduleAddresses = $_POST['schedule_address'] ?? [];
        $scheduleMapsUrls = $_POST['schedule_maps_url'] ?? [];

        $scheduleList = [];
        for ($i = 0; $i < count($scheduleNames); $i++) {
            $name = trim($scheduleNames[$i] ?? '');
            if (!empty($name)) {
                $scheduleList[] = [
                    'name' => sanitize($name),
                    'date' => sanitize($scheduleDates[$i] ?? ($event['event_date'] ?? date('Y-m-d'))),
                    'time' => sanitize($scheduleTimes[$i] ?? ''),
                    'place' => sanitize($schedulePlaces[$i] ?? ''),
                    'address' => sanitize($scheduleAddresses[$i] ?? ''),
                    'maps_url' => sanitize($scheduleMapsUrls[$i] ?? '')
                ];
            }
        }

        // Sinkronisasi legacy fields (akad & resepsi) untuk template lama
        $akadTime = $scheduleList[0]['time'] ?? ($event['akad_time'] ?? '');
        $akadLocation = $scheduleList[0]['place'] ?? ($event['akad_location'] ?? '');
        $resepsiTime = $scheduleList[1]['time'] ?? ($scheduleList[0]['time'] ?? ($event['resepsi_time'] ?? ''));
        $resepsiLocation = $scheduleList[1]['place'] ?? ($scheduleList[0]['place'] ?? ($event['resepsi_location'] ?? ''));

        $scheduleJson = !empty($scheduleList) ? json_encode($scheduleList, JSON_UNESCAPED_UNICODE) : null;

        $this->eventModel->updateTraditionPreset(
            $id,
            $preset,
            $scheduleJson,
            $quote,
            $akadTime,
            $akadLocation,
            $resepsiTime,
            $resepsiLocation,
            $mapsUrl
        );

        $presetInfo = get_preset_info($preset);
        $presetLabel = $presetInfo['name'] ?? ucfirst($preset);

        set_flash('success', "Tradisi dan susunan acara untuk '{$event['title']}' berhasil diubah ke {$presetLabel}.");
        redirect('admin/events');
    }

    // ==========================================
    // MASTER PRESET TRADISI ACARA (AGAMA & BUDAYA)
    // ==========================================
    public function traditions() {
        $presets = get_wedding_presets();
        $events = $this->eventModel->getAllEvents();
        require_once BASE_PATH . '/views/admin/traditions.php';
    }

    public function saveTradition() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/traditions');
        }

        $rawKey = trim($_POST['preset_key'] ?? '');
        $key = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', $rawKey));
        $key = trim($key, '_');

        if (empty($key)) {
            set_flash('error', 'Kunci ID preset tidak boleh kosong.');
            redirect('admin/traditions');
        }

        $name = sanitize($_POST['name'] ?? ucfirst($key));
        $label = sanitize($_POST['label'] ?? $name);
        $badge = sanitize($_POST['badge'] ?? $name);
        $color = sanitize($_POST['color'] ?? 'primary');
        $quote = sanitize($_POST['quote'] ?? '');

        // Susun sesi-sesi bawaan
        $sessionNames = $_POST['session_name'] ?? [];
        $sessionTimes = $_POST['session_time'] ?? [];
        $sessionPlaces = $_POST['session_place'] ?? [];
        $sessionAddresses = $_POST['session_address'] ?? [];

        $sessions = [];
        for ($i = 0; $i < count($sessionNames); $i++) {
            $sName = trim($sessionNames[$i] ?? '');
            if (!empty($sName)) {
                $sessions[] = [
                    'name' => sanitize($sName),
                    'time' => sanitize($sessionTimes[$i] ?? '08.00 - 10.00 WIB'),
                    'place' => sanitize($sessionPlaces[$i] ?? ''),
                    'address' => sanitize($sessionAddresses[$i] ?? '')
                ];
            }
        }

        if (empty($sessions)) {
            $sessions[] = [
                'name' => 'Akad / Ceremony',
                'time' => '08.00 - 10.00 WIB',
                'place' => 'Tempat Acara',
                'address' => ''
            ];
        }

        $presets = get_wedding_presets();
        $presets[$key] = [
            'name' => $name,
            'label' => $label,
            'badge' => $badge,
            'color' => $color,
            'icon' => $presets[$key]['icon'] ?? 'bi-calendar2-heart',
            'quote' => $quote,
            'sessions' => $sessions
        ];

        save_wedding_presets($presets);
        set_flash('success', "Preset tradisi \"{$badge}\" berhasil disimpan dan aktif di sistem!");
        redirect('admin/traditions');
    }

    public function deleteTradition($key) {
        $presets = get_wedding_presets();
        if (isset($presets[$key])) {
            $badge = $presets[$key]['badge'] ?? $key;
            unset($presets[$key]);
            save_wedding_presets($presets);
            set_flash('success', "Preset tradisi \"{$badge}\" berhasil dihapus.");
        } else {
            set_flash('error', 'Preset tidak ditemukan.');
        }
        redirect('admin/traditions');
    }

    public function resetTraditions() {
        reset_wedding_presets();
        set_flash('success', 'Seluruh preset tradisi acara telah di-reset ke konfigurasi awal bawaan sistem.');
        redirect('admin/traditions');
    }

    public function applyTraditionToEvent($eventId) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/traditions');
        }

        $event = $this->eventModel->findById($eventId);
        if (!$event) {
            set_flash('error', 'Undangan target tidak ditemukan.');
            redirect('admin/traditions');
        }

        $presetKey = sanitize($_POST['preset_key'] ?? 'islam');
        $presetInfo = get_preset_info($presetKey);

        $defaultDate = $event['event_date'] ?? date('Y-m-d');
        $scheduleList = [];
        foreach ($presetInfo['sessions'] as $s) {
            $scheduleList[] = [
                'name' => $s['name'],
                'date' => $defaultDate,
                'time' => $s['time'],
                'place' => $s['place'],
                'address' => $s['address'],
                'maps_url' => ''
            ];
        }

        $akadTime = $scheduleList[0]['time'] ?? '';
        $akadLocation = $scheduleList[0]['place'] ?? '';
        $resepsiTime = $scheduleList[1]['time'] ?? ($scheduleList[0]['time'] ?? '');
        $resepsiLocation = $scheduleList[1]['place'] ?? ($scheduleList[0]['place'] ?? '');

        $scheduleJson = json_encode($scheduleList, JSON_UNESCAPED_UNICODE);

        $this->eventModel->updateTraditionPreset(
            $eventId,
            $presetKey,
            $scheduleJson,
            $presetInfo['quote'],
            $akadTime,
            $akadLocation,
            $resepsiTime,
            $resepsiLocation
        );

        set_flash('success', "Preset \"{$presetInfo['badge']}\" berhasil diterapkan ke undangan \"{$event['title']}\"!");
        redirect('admin/traditions');
    }

    // ==========================================
    // 1. PENGATURAN TEMPLATE UNDANGAN & VIEW ENGINES
    // ==========================================
    public function getAvailableViewEngines() {
        $files = glob(BASE_PATH . '/views/templates/*.php');
        $engines = [];
        foreach ($files as $file) {
            $base = basename($file, '.php');
            $engines[] = [
                'name' => $base,
                'file' => basename($file),
                'path' => $file,
                'size' => filesize($file),
                'updated' => filemtime($file)
            ];
        }
        return $engines;
    }

    public function templates() {
        $templates = $this->templateModel->getAllAdmin();
        $categories = $this->templateModel->getCategories();
        $viewEngines = $this->getAvailableViewEngines();
        require_once BASE_PATH . '/views/admin/templates.php';
    }

    public function engine() {
        $viewEngines = $this->getAvailableViewEngines();
        require_once BASE_PATH . '/views/admin/engine_manager.php';
    }

    public function createEngine() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/templates');
        }

        $rawName = $_POST['engine_name'] ?? '';
        $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', trim($rawName)));
        $cleanName = trim($cleanName, '_');

        if (empty($cleanName)) {
            set_flash('error', 'Nama file view engine tidak boleh kosong.');
            redirect('admin/templates');
        }

        $targetPath = BASE_PATH . '/views/templates/' . $cleanName . '.php';
        if (file_exists($targetPath)) {
            set_flash('error', "File view engine '{$cleanName}.php' sudah ada sebelumnya.");
            redirect('admin/templates');
        }

        $baseEngine = sanitize($_POST['base_engine'] ?? 'nature_classic');
        $sourcePath = BASE_PATH . '/views/templates/' . $baseEngine . '.php';

        if (file_exists($sourcePath)) {
            copy($sourcePath, $targetPath);
        } else {
            $starterCode = "<?php\n// File View Engine: {$cleanName}.php\n?>\n<!DOCTYPE html>\n<html lang=\"id\">\n<head>\n    <meta charset=\"UTF-8\">\n    <title><?= htmlspecialchars(\$event['title']) ?></title>\n</head>\n<body>\n    <h1><?= htmlspecialchars(\$event['title']) ?></h1>\n</body>\n</html>";
            file_put_contents($targetPath, $starterCode);
        }

        set_flash('success', "File View Engine '{$cleanName}.php' berhasil dibuat! Silakan sesuaikan kodenya di bawah.");
        redirect('admin/engine/edit/' . $cleanName);
    }

    public function editEngine($filename) {
        $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', $filename));
        $filePath = BASE_PATH . '/views/templates/' . $cleanName . '.php';

        if (!file_exists($filePath)) {
            set_flash('error', "File view engine '{$cleanName}.php' tidak ditemukan.");
            redirect('admin/templates');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newCode = $_POST['code'] ?? '';
            file_put_contents($filePath, $newCode);
            set_flash('success', "Perubahan kode untuk engine '{$cleanName}.php' berhasil disimpan!");
            redirect('admin/engine/edit/' . $cleanName);
        }

        $fileContent = file_get_contents($filePath);
        $fileSize = filesize($filePath);
        $fileUpdated = filemtime($filePath);

        require_once BASE_PATH . '/views/admin/edit_engine.php';
    }

    public function duplicateEngine($filename) {
        $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', $filename));
        $sourcePath = BASE_PATH . '/views/templates/' . $cleanName . '.php';

        if (!file_exists($sourcePath)) {
            set_flash('error', "File sumber '{$cleanName}.php' tidak ditemukan.");
            redirect('admin/templates');
        }

        $copyName = $cleanName . '_copy';
        $targetPath = BASE_PATH . '/views/templates/' . $copyName . '.php';
        
        $counter = 1;
        while (file_exists($targetPath)) {
            $copyName = $cleanName . '_copy_' . $counter;
            $targetPath = BASE_PATH . '/views/templates/' . $copyName . '.php';
            $counter++;
        }

        copy($sourcePath, $targetPath);
        set_flash('success', "File View Engine berhasil diduplikat menjadi '{$copyName}.php'!");
        redirect('admin/templates');
    }

    public function saveTemplate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/templates');
        }

        $id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;
        $name = sanitize($_POST['name'] ?? '');
        $slug = sanitize($_POST['slug'] ?? '');
        $categoryId = (int)($_POST['category_id'] ?? 1);
        $thumbnail = sanitize($_POST['thumbnail'] ?? '');
        $tier = sanitize($_POST['tier'] ?? 'free');
        $viewFile = sanitize($_POST['view_file'] ?? 'nature_classic');
        $isActive = isset($_POST['is_active']) ? 1 : 0;

        if (empty($name)) {
            set_flash('error', 'Nama template wajib diisi.');
            redirect('admin/templates');
        }

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        }

        if (empty($thumbnail)) {
            $thumbnail = 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&auto=format&fit=crop&q=80';
        }

        $animConfig = [
            'entrance_text' => sanitize($_POST['anim_entrance_text'] ?? 'fade_in'),
            'entrance_photo' => sanitize($_POST['anim_entrance_photo'] ?? 'zoom_in'),
            'loop_decor' => sanitize($_POST['anim_loop_decor'] ?? 'floating'),
            'page_transition' => sanitize($_POST['anim_page_transition'] ?? 'slide'),
            'smooth_scroll' => isset($_POST['anim_smooth_scroll']) ? 1 : 0,
            'hover_effect' => isset($_POST['anim_hover_effect']) ? 1 : 0,
            'reveal_on_scroll' => isset($_POST['anim_reveal_on_scroll']) ? 1 : 0
        ];

        $data = [
            'name' => $name,
            'slug' => $slug,
            'category_id' => $categoryId,
            'thumbnail' => $thumbnail,
            'tier' => $tier,
            'view_file' => $viewFile,
            'animation_config_json' => json_encode($animConfig),
            'is_active' => $isActive
        ];

        if ($id) {
            $this->templateModel->update($id, $data);
            set_flash('success', "Template '{$name}' berhasil diperbarui.");
        } else {
            $this->templateModel->create($data);
            set_flash('success', "Template baru '{$name}' berhasil ditambahkan.");
        }

        redirect('admin/templates');
    }

    public function toggleTemplate($id) {
        $this->templateModel->toggleStatus($id);
        set_flash('success', 'Status template berhasil diubah.');
        redirect('admin/templates');
    }

    public function deleteTemplate($id) {
        $this->templateModel->delete($id);
        set_flash('success', 'Template berhasil dihapus.');
        redirect('admin/templates');
    }

    public function importTemplate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/templates');
        }

        if (!isset($_FILES['template_zip']) || $_FILES['template_zip']['error'] !== UPLOAD_ERR_OK) {
            set_flash('error', 'Silakan pilih berkas paket template (.ZIP) untuk diimpor.');
            redirect('admin/templates');
        }

        $file = $_FILES['template_zip'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if ($ext !== 'zip') {
            set_flash('error', 'Format berkas tidak didukung. Harap unggah berkas .ZIP.');
            redirect('admin/templates');
        }

        if (!class_exists('ZipArchive')) {
            set_flash('error', 'Ekstensi PHP ZipArchive tidak aktif pada server.');
            redirect('admin/templates');
        }

        $zip = new ZipArchive();
        if ($zip->open($file['tmp_name']) !== TRUE) {
            set_flash('error', 'Gagal membuka berkas arsip ZIP template.');
            redirect('admin/templates');
        }

        $tempExtractDir = BASE_PATH . '/assets/uploads/tmp/template_import_' . time() . '_' . rand(100, 999) . '/';
        if (!is_dir($tempExtractDir)) {
            mkdir($tempExtractDir, 0777, true);
        }

        $zip->extractTo($tempExtractDir);
        $zip->close();

        // 1. Cari file template.json jika ada
        $jsonConfig = null;
        $jsonFiles = glob($tempExtractDir . '{template.json,*/template.json}', GLOB_BRACE);
        if (!empty($jsonFiles) && file_exists($jsonFiles[0])) {
            $jsonContent = file_get_contents($jsonFiles[0]);
            $jsonConfig = json_decode($jsonContent, true);
        }

        // 2. Cari file .php utama (engine)
        $phpFiles = glob($tempExtractDir . '{*.php,*/*.php}', GLOB_BRACE);
        $mainPhpFile = null;
        if (!empty($phpFiles)) {
            if ($jsonConfig && !empty($jsonConfig['view_file'])) {
                foreach ($phpFiles as $pf) {
                    if (basename($pf, '.php') === $jsonConfig['view_file']) {
                        $mainPhpFile = $pf;
                        break;
                    }
                }
            }
            if (!$mainPhpFile) {
                $mainPhpFile = $phpFiles[0];
            }
        }

        if (!$mainPhpFile || !file_exists($mainPhpFile)) {
            $this->deleteDirectoryRecursive($tempExtractDir);
            set_flash('error', 'Berkas ZIP tidak memiliki file view engine PHP (views/templates/*.php).');
            redirect('admin/templates');
        }

        $viewFileName = $jsonConfig['view_file'] ?? strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', pathinfo($mainPhpFile, PATHINFO_FILENAME)));
        $viewFileName = trim($viewFileName, '_');
        if (empty($viewFileName)) {
            $viewFileName = 'imported_template_' . time();
        }

        // Pindahkan file php ke views/templates/
        $destPhpPath = BASE_PATH . '/views/templates/' . $viewFileName . '.php';
        copy($mainPhpFile, $destPhpPath);

        // 3. Cari dan pindahkan thumbnail
        $thumbnailPath = $jsonConfig['thumbnail'] ?? '';
        $imgFiles = glob($tempExtractDir . '{*.jpg,*.jpeg,*.png,*.webp,*/*.jpg,*/*.jpeg,*/*.png,*/*.webp}', GLOB_BRACE);
        if (!empty($imgFiles)) {
            $thumbUploadDir = BASE_PATH . '/assets/uploads/templates/';
            if (!is_dir($thumbUploadDir)) {
                mkdir($thumbUploadDir, 0777, true);
            }
            $imgExt = strtolower(pathinfo($imgFiles[0], PATHINFO_EXTENSION));
            $newThumbName = 'thumb_' . $viewFileName . '_' . time() . '.' . $imgExt;
            copy($imgFiles[0], $thumbUploadDir . $newThumbName);
            $thumbnailPath = base_url('assets/uploads/templates/' . $newThumbName);
        }

        if (empty($thumbnailPath)) {
            $thumbnailPath = 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&auto=format&fit=crop&q=80';
        } elseif (!str_starts_with($thumbnailPath, 'http')) {
            $thumbnailPath = base_url($thumbnailPath);
        }

        // 4. Susun nama, slug, kategori, tier
        $templateName = !empty($_POST['name']) ? sanitize($_POST['name']) : ($jsonConfig['name'] ?? ucwords(str_replace(['_', '-'], ' ', $viewFileName)));
        $templateSlug = !empty($_POST['slug']) ? sanitize($_POST['slug']) : ($jsonConfig['slug'] ?? strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $templateName))));
        
        // Pastikan slug unik
        $db = Database::getInstance();
        $checkStmt = $db->prepare("SELECT COUNT(*) FROM templates WHERE slug = ?");
        $checkStmt->execute([$templateSlug]);
        if ($checkStmt->fetchColumn() > 0) {
            $templateSlug .= '-' . time();
        }

        $categoryId = (int)($_POST['category_id'] ?? ($jsonConfig['category_id'] ?? 1));
        $tier = in_array($_POST['tier'] ?? '', ['free', 'basic', 'premium']) ? $_POST['tier'] : ($jsonConfig['tier'] ?? 'premium');
        $isActive = 1;

        $animConfig = $jsonConfig['animations'] ?? [
            'entrance_text' => 'slide_up',
            'entrance_photo' => 'zoom_in',
            'loop_decor' => 'floating',
            'page_transition' => 'book_flip',
            'smooth_scroll' => 1,
            'hover_effect' => 1,
            'reveal_on_scroll' => 1
        ];

        $dataToInsert = [
            'name' => $templateName,
            'slug' => $templateSlug,
            'category_id' => $categoryId,
            'thumbnail' => $thumbnailPath,
            'tier' => $tier,
            'view_file' => $viewFileName,
            'animation_config_json' => json_encode($animConfig),
            'is_active' => $isActive
        ];

        $this->templateModel->create($dataToInsert);

        // Hapus folder temp
        $this->deleteDirectoryRecursive($tempExtractDir);

        set_flash('success', "Template '{$templateName}' berhasil diimpor dari berkas ZIP dan langsung aktif!");
        redirect('admin/templates');
    }

    public function exportTemplate($id) {
        $template = $this->templateModel->findById($id);
        if (!$template) {
            set_flash('error', 'Template tidak ditemukan.');
            redirect('admin/templates');
        }

        if (!class_exists('ZipArchive')) {
            set_flash('error', 'Ekstensi PHP ZipArchive tidak aktif pada server.');
            redirect('admin/templates');
        }

        $viewFile = basename($template['view_file'], '.php');
        $phpPath = BASE_PATH . '/views/templates/' . $viewFile . '.php';

        $zip = new ZipArchive();
        $zipFilename = 'template_' . $template['slug'] . '.zip';
        $tempZipPath = sys_get_temp_dir() . '/' . $zipFilename;

        if ($zip->open($tempZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            set_flash('error', 'Gagal membuat file arsip ZIP untuk export.');
            redirect('admin/templates');
        }

        // Masukkan file php
        if (file_exists($phpPath)) {
            $zip->addFile($phpPath, $viewFile . '.php');
        }

        // Masukkan template.json
        $meta = [
            'name' => $template['name'],
            'slug' => $template['slug'],
            'category_id' => (int)$template['category_id'],
            'tier' => $template['tier'],
            'view_file' => $viewFile,
            'thumbnail' => $template['thumbnail'],
            'animations' => json_decode($template['animation_config_json'] ?? '[]', true) ?: []
        ];
        $zip->addFromString('template.json', json_encode($meta, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        // Jika thumbnail berupa file lokal, masukkan ke zip
        if (!empty($template['thumbnail']) && !str_starts_with($template['thumbnail'], 'http')) {
            $localThumb = BASE_PATH . '/' . ltrim($template['thumbnail'], '/');
            if (file_exists($localThumb)) {
                $zip->addFile($localThumb, 'thumbnail.' . pathinfo($localThumb, PATHINFO_EXTENSION));
            }
        }

        $zip->close();

        // Send download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
        header('Content-Length: ' . filesize($tempZipPath));
        header('Pragma: no-cache');
        readfile($tempZipPath);
        @unlink($tempZipPath);
        exit;
    }

    public function previewTemplate($id) {
        $template = $this->templateModel->findById($id);
        if (!$template) {
            set_flash('error', 'Template tidak ditemukan.');
            redirect('admin/templates');
        }

        self::renderTemplatePreview($template);
    }

    public static function renderTemplatePreview($template) {
        $event = [
            'id' => 99999,
            'user_id' => 1,
            'template_id' => $template['id'],
            'category_id' => $template['category_id'],
            'title' => 'The Wedding of Romeo & Juliet',
            'slug' => 'preview-' . $template['slug'],
            'event_date' => date('Y-m-d H:i:s', strtotime('+30 days')),
            'status' => 'published',
            'is_admin_created' => 1,
            'music_url' => 'assets/audio/wedding_music.mp3',
            'template_name' => $template['name'],
            'view_file' => $template['view_file'],
            'animation_config_json' => $template['animation_config_json'],
            'theme_config_json' => json_encode([
                'primary_color' => '#D4AF37',
                'secondary_color' => '#E5D3B3',
                'font_heading' => 'Cinzel',
                'font_body' => 'Plus Jakarta Sans',
                'effect_particle' => 'sparkles',
                'show_nav_dock' => 1,
                'bg_pattern' => 'floral'
            ]),
            'groom_name' => 'Romeo Pratama, S.Kom',
            'groom_nickname' => 'Romeo',
            'groom_parents' => 'Putra tercinta dari Bpk. Bambang & Ibu Ratna',
            'groom_father' => 'Bpk. Bambang Wijaya',
            'groom_mother' => 'Ibu Ratna Dewi',
            'groom_instagram' => 'romeo.pratama',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&auto=format&fit=crop&q=80',
            'bride_name' => 'Juliet Anindya, S.Ked',
            'bride_nickname' => 'Juliet',
            'bride_parents' => 'Putri tercinta dari Bpk. Surya & Ibu Dian',
            'bride_father' => 'Bpk. Surya Kusuma',
            'bride_mother' => 'Ibu Dian Safitri',
            'bride_instagram' => 'juliet.anindya',
            'bride_photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&auto=format&fit=crop&q=80',
            'cover_image' => !empty($template['thumbnail']) ? $template['thumbnail'] : 'https://wedding.templateku.id/wp-content/uploads/2025/01/pexels-ba-tik-3754224.webp',
            'quote' => '"Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang." (QS. Ar-Rum: 21)',
            'akad_time' => '08:00 - 10:00 WIB',
            'akad_location' => 'Masjid Agung Al-Ikhlas, Kebayoran Baru, Jakarta Selatan',
            'resepsi_time' => '11:00 - 14:00 WIB',
            'resepsi_location' => 'Grand Ballroom The Ritz, SCBD, Jakarta Selatan',
            'maps_url' => 'https://maps.google.com',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28318182289!2d106.759478!3d-6.2293867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e49fe3ddb3%3A0x73d44976eaa5d3f0!2sJakarta!5e0!3m2!1sid!2sid!4v1650000000000!5m2!1sid!2sid',
            'love_story_json' => json_encode([
                ['year' => '2020', 'title' => 'Pertemuan Pertama', 'story' => 'Kami pertama kali dipertemukan saat sama-sama menempuh pendidikan di universitas.', 'desc' => 'Kami pertama kali dipertemukan saat sama-sama menempuh pendidikan di universitas.', 'image' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=600&auto=format&fit=crop&q=80'],
                ['year' => '2022', 'title' => 'Menjalin Komitmen', 'story' => 'Dua tahun saling mengenal, kami memutuskan untuk melangkah bersama dengan niat baik.', 'desc' => 'Dua tahun saling mengenal, kami memutuskan untuk melangkah bersama dengan niat baik.', 'image' => 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=600&auto=format&fit=crop&q=80'],
                ['year' => '2024', 'title' => 'Menuju Pelaminan', 'story' => 'Dengan restu kedua keluarga, kami mantap mengikat janji suci seumur hidup.', 'desc' => 'Dengan restu kedua keluarga, kami mantap mengikat janji suci seumur hidup.', 'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&auto=format&fit=crop&q=80']
            ]),
            'gallery_json' => json_encode([
                'https://wedding.templateku.id/wp-content/uploads/2025/01/pexels-ba-tik-3754224.webp',
                'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&auto=format&fit=crop&q=80'
            ]),
            'bank_accounts_json' => json_encode([
                ['bank' => 'BCA', 'number' => '8830192831', 'owner' => 'Romeo Pratama', 'holder' => 'Romeo Pratama'],
                ['bank' => 'Mandiri', 'number' => '1370019283812', 'owner' => 'Juliet Anindya', 'holder' => 'Juliet Anindya']
            ]),
            'gift_address' => "Penerima: Romeo & Juliet\nJl. Melati No. 45, Kebayoran Baru, Jakarta Selatan (0812-3456-7890)"
        ];

        $guestName = isset($_GET['kpd']) && trim($_GET['kpd']) !== '' ? sanitize($_GET['kpd']) : 'Bpk. Andre & Keluarga';
        $wishes = [
            ['guest_name' => 'Hendra Setiawan', 'name' => 'Hendra Setiawan', 'attendance' => 'attending', 'message' => 'Selamat menempuh hidup baru! Semoga selalu berbahagia dan rukun.', 'reply' => 'Terima kasih banyak Mas Hendra!', 'created_at' => date('Y-m-d H:i:s')],
            ['guest_name' => 'Maya Kartika', 'name' => 'Maya Kartika', 'attendance' => 'attending', 'message' => 'Happy wedding Romeo & Juliet! Sakinah, mawaddah, warahmah.', 'reply' => '', 'created_at' => date('Y-m-d H:i:s')]
        ];
        $themeConfig = json_decode($event['theme_config_json'], true);
        $animConfig = json_decode($template['animation_config_json'] ?? '[]', true) ?: [
            'entrance_text' => 'slide_up',
            'entrance_photo' => 'zoom_in',
            'loop_decor' => 'floating',
            'page_transition' => 'slide',
            'smooth_scroll' => 1,
            'hover_effect' => 1,
            'reveal_on_scroll' => 1
        ];

        $GLOBALS['animConfig'] = $animConfig;
        $GLOBALS['event'] = $event;

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

        $templateView = $template['view_file'] ?: 'nature_classic';
        $templatePath = BASE_PATH . '/views/templates/' . $templateView . '.php';
        if (!file_exists($templatePath)) {
            $templatePath = BASE_PATH . '/views/templates/nature_classic.php';
        }

        require_once $templatePath;

        if (!defined('UNIVERSAL_ANIMATION_ENGINE_DEFINED')) {
            $animPartialPath = BASE_PATH . '/views/partials/universal_animation_engine.php';
            if (file_exists($animPartialPath)) {
                require_once $animPartialPath;
            }
        }

        if (!defined('UNIVERSAL_AUTOSCROLL_LOADED')) {
            $partialPath = BASE_PATH . '/views/partials/universal_autoscroll.php';
            if (file_exists($partialPath)) {
                require_once $partialPath;
            }
        }
        exit;
    }


    // ==========================================
    // 2. KELOLA USER (PENGGUNA PLATFORM)
    // ==========================================
    public function users() {
        $users = $this->userModel->getAllUsers();
        require_once BASE_PATH . '/views/admin/users.php';
    }

    public function saveUser() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/users');
        }

        $id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;
        $name = sanitize($_POST['name'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $phone = sanitize($_POST['phone'] ?? '');
        $role = sanitize($_POST['role'] ?? 'user');
        $password = $_POST['password'] ?? '';

        if (empty($name) || empty($email)) {
            set_flash('error', 'Nama dan email wajib diisi.');
            redirect('admin/users');
        }

        // Cek jika email sudah dipakai user lain
        $existing = $this->userModel->findByEmail($email);
        if ($existing && (!$id || $existing['id'] != $id)) {
            set_flash('error', 'Email sudah digunakan oleh akun lain.');
            redirect('admin/users');
        }

        if ($id) {
            $this->userModel->update($id, $name, $email, $phone, $role);
            if (!empty($password)) {
                $this->userModel->updatePassword($id, $password);
            }
            set_flash('success', "Data pengguna '{$name}' berhasil diperbarui.");
        } else {
            if (empty($password)) {
                $password = 'password123'; // Default password jika kosong
            }
            $this->userModel->register($name, $email, $phone, $password, $role);
            set_flash('success', "Pengguna baru '{$name}' berhasil dibuat.");
        }

        redirect('admin/users');
    }

    public function resetUserPassword($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/users');
        }

        $newPassword = $_POST['new_password'] ?? '';
        if (empty($newPassword) || strlen($newPassword) < 6) {
            set_flash('error', 'Kata sandi minimal 6 karakter.');
            redirect('admin/users');
        }

        $user = $this->userModel->findById($id);
        if ($user) {
            $this->userModel->updatePassword($id, $newPassword);
            set_flash('success', "Kata sandi untuk pengguna '{$user['name']}' berhasil di-reset.");
        }

        redirect('admin/users');
    }

    public function deleteUser($id) {
        $currentUserId = current_user()['id'] ?? 0;
        if ($id == $currentUserId) {
            set_flash('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
            redirect('admin/users');
        }

        $user = $this->userModel->findById($id);
        if ($user) {
            $this->userModel->delete($id);
            set_flash('success', "Pengguna '{$user['name']}' berhasil dihapus.");
        }

        redirect('admin/users');
    }

    // ==========================================
    // 3. KUSTOMISASI TEMA & TOGGLE STATUS
    // ==========================================
    public function customize($eventId) {
        $event = $this->eventModel->findById($eventId);
        if (!$event) {
            set_flash('error', 'Acara tidak ditemukan.');
            redirect('admin/events');
        }

        $templates = $this->templateModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $themeConfig = [
                'primary_color' => sanitize($_POST['primary_color'] ?? '#928573'),
                'secondary_color' => sanitize($_POST['secondary_color'] ?? '#E1D6C7'),
                'font_heading' => sanitize($_POST['font_heading'] ?? 'Great Vibes'),
                'font_body' => sanitize($_POST['font_body'] ?? 'Playfair Display'),
                'effect_particle' => sanitize($_POST['effect_particle'] ?? 'petals'),
                'show_nav_dock' => isset($_POST['show_nav_dock']) ? 1 : 0,
                'bg_pattern' => sanitize($_POST['bg_pattern'] ?? 'floral')
            ];

            $templateId = (int)($_POST['template_id'] ?? $event['template_id']);

            $db = Database::getInstance();
            $stmt = $db->prepare("UPDATE events SET template_id = ?, theme_config_json = ? WHERE id = ?");
            $stmt->execute([$templateId, json_encode($themeConfig), $eventId]);

            set_flash('success', 'Kustomisasi tema & efek berhasil disimpan!');
            redirect('admin/customize/' . $eventId);
        }

        $themeConfig = json_decode($event['theme_config_json'] ?? '[]', true) ?: [
            'primary_color' => '#928573',
            'secondary_color' => '#E1D6C7',
            'font_heading' => 'Great Vibes',
            'font_body' => 'Playfair Display',
            'effect_particle' => 'petals',
            'show_nav_dock' => 1,
            'bg_pattern' => 'floral'
        ];

        require_once BASE_PATH . '/views/admin/customize_theme.php';
    }

    public function toggleEventStatus($eventId) {
        $event = $this->eventModel->findById($eventId);
        if ($event) {
            $newStatus = ($event['status'] === 'published') ? 'draft' : 'published';
            $db = Database::getInstance();
            $stmt = $db->prepare("UPDATE events SET status = ? WHERE id = ?");
            $stmt->execute([$newStatus, $eventId]);
            set_flash('success', "Status undangan '{$event['title']}' diubah menjadi {$newStatus}.");
        }
        redirect('admin/events');
    }

    // ==========================================
    // 5. PENGATURAN IDENTITAS WEB & BRANDING (SUPER ADMINISTRATOR)
    // ==========================================
    public function settings() {
        require_once dirname(__DIR__) . '/Models/Setting.php';
        $settings = Setting::getAll();
        require_once BASE_PATH . '/views/admin/settings.php';
    }

    public function saveSettings() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/settings');
        }

        require_once dirname(__DIR__) . '/Models/Setting.php';

        $appName = trim($_POST['app_name'] ?? 'PENDAR LOKA');
        if (empty($appName)) {
            $appName = 'PENDAR LOKA';
        }

        $appTagline = trim($_POST['app_tagline'] ?? '');
        $pageTitleFormat = trim($_POST['page_title_format'] ?? '{title} | {app_name}');
        $siteDescription = trim($_POST['site_description'] ?? '');
        $siteLogoType = in_array($_POST['site_logo_type'] ?? '', ['icon', 'image']) ? $_POST['site_logo_type'] : 'icon';
        $whatsappNumber = trim($_POST['whatsapp_number'] ?? '');
        $whatsappText = trim($_POST['whatsapp_text'] ?? '');

        $currentLogoLight = Setting::get('site_logo_light', Setting::get('site_logo', ''));
        $currentLogoDark = Setting::get('site_logo_dark', Setting::get('site_logo', ''));
        $currentFavicon = Setting::get('site_favicon', '');

        $uploadDir = BASE_PATH . '/assets/uploads/branding/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $allowedExts = ['png', 'jpg', 'jpeg', 'svg', 'webp'];

        // 1. Handle Logo Mode Terang (Light Mode)
        if (isset($_FILES['logo_light_file']) && $_FILES['logo_light_file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['logo_light_file'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowedExts)) {
                $newFilename = 'logo_light_' . time() . '.' . $ext;
                $targetFile = $uploadDir . $newFilename;
                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    $currentLogoLight = 'assets/uploads/branding/' . $newFilename;
                    $siteLogoType = 'image';
                }
            }
        } elseif (!empty($_POST['logo_light_url'])) {
            $currentLogoLight = trim($_POST['logo_light_url']);
            $siteLogoType = 'image';
        }

        if (isset($_POST['remove_logo_light']) && $_POST['remove_logo_light'] == '1') {
            $currentLogoLight = '';
        }

        // 2. Handle Logo Mode Gelap (Dark Mode)
        if (isset($_FILES['logo_dark_file']) && $_FILES['logo_dark_file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['logo_dark_file'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowedExts)) {
                $newFilename = 'logo_dark_' . time() . '.' . $ext;
                $targetFile = $uploadDir . $newFilename;
                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    $currentLogoDark = 'assets/uploads/branding/' . $newFilename;
                    $siteLogoType = 'image';
                }
            }
        } elseif (!empty($_POST['logo_dark_url'])) {
            $currentLogoDark = trim($_POST['logo_dark_url']);
            $siteLogoType = 'image';
        }

        if (isset($_POST['remove_logo_dark']) && $_POST['remove_logo_dark'] == '1') {
            $currentLogoDark = '';
        }

        // Fallback untuk backward-compatibility `site_logo`
        $currentLogo = $currentLogoLight ?: $currentLogoDark;
        if (empty($currentLogoLight) && empty($currentLogoDark) && $siteLogoType === 'image') {
            $siteLogoType = 'icon';
        }

        // 3. Handle Favicon Upload
        if (isset($_FILES['favicon_file']) && $_FILES['favicon_file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['favicon_file'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $favAllowedExts = ['ico', 'png', 'svg', 'webp'];
            if (in_array($ext, $favAllowedExts)) {
                $newFilename = 'favicon_' . time() . '.' . $ext;
                $targetFile = $uploadDir . $newFilename;
                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    $currentFavicon = 'assets/uploads/branding/' . $newFilename;
                }
            }
        } elseif (!empty($_POST['favicon_url'])) {
            $currentFavicon = trim($_POST['favicon_url']);
        }

        if (isset($_POST['remove_favicon']) && $_POST['remove_favicon'] == '1') {
            $currentFavicon = '';
        }

        // 4. Handle Hero Banner & Deskripsi Website
        $heroBadge = trim($_POST['hero_badge'] ?? 'Platform Undangan Digital No. 1');
        $heroTitleLine1 = trim($_POST['hero_title_line1'] ?? 'Buat Undangan');
        $heroTitleHighlight = trim($_POST['hero_title_highlight'] ?? 'Digital Impianmu');
        $heroTitleLine2 = trim($_POST['hero_title_line2'] ?? 'Hanya 5 Menit!');
        $heroDescription = trim($_POST['hero_description'] ?? '');
        $heroBtnRegisterText = trim($_POST['hero_btn_register_text'] ?? 'Buat Undangan Gratis');
        $heroBtnWaText = trim($_POST['hero_btn_wa_text'] ?? 'Dibuatin Admin Aja');
        $heroPillBadge = trim($_POST['hero_pill_badge'] ?? 'Anti Rugi');
        $heroPillText = trim($_POST['hero_pill_text'] ?? 'Dibuatin admin dulu, bayar setelah jadi & suka hasilnya!');

        $dataToSave = [
            'app_name' => $appName,
            'app_tagline' => $appTagline,
            'page_title_format' => $pageTitleFormat,
            'site_description' => $siteDescription,
            'site_logo_type' => $siteLogoType,
            'site_logo' => $currentLogo,
            'site_logo_light' => $currentLogoLight,
            'site_logo_dark' => $currentLogoDark,
            'site_favicon' => $currentFavicon,
            'whatsapp_number' => $whatsappNumber,
            'whatsapp_text' => $whatsappText,
            'hero_badge' => $heroBadge,
            'hero_title_line1' => $heroTitleLine1,
            'hero_title_highlight' => $heroTitleHighlight,
            'hero_title_line2' => $heroTitleLine2,
            'hero_description' => $heroDescription,
            'hero_btn_register_text' => $heroBtnRegisterText,
            'hero_btn_wa_text' => $heroBtnWaText,
            'hero_pill_badge' => $heroPillBadge,
            'hero_pill_text' => $heroPillText
        ];

        Setting::setMultiple($dataToSave);

        set_flash('success', 'Pengaturan identitas website, logo, favicon, serta banner dan deskripsi web berhasil diperbarui!');
        redirect('admin/settings');
    }

    // ==========================================
    // 6. PENGATURAN PLUGIN ALA WORDPRESS
    // ==========================================
    public function plugins() {
        require_once BASE_PATH . '/app/Core/PluginManager.php';
        $plugins = PluginManager::getAllPlugins();
        $totalPlugins = count($plugins);
        $activePlugins = count(array_filter($plugins, fn($p) => $p['is_active']));
        $inactivePlugins = $totalPlugins - $activePlugins;

        require_once BASE_PATH . '/views/admin/plugins.php';
    }

    public function togglePlugin($slug) {
        require_once BASE_PATH . '/app/Core/PluginManager.php';
        $slug = sanitize($slug);
        if (PluginManager::isPluginActive($slug)) {
            PluginManager::deactivatePlugin($slug);
            set_flash('success', "Plugin '{$slug}' dinonaktifkan.");
        } else {
            PluginManager::activatePlugin($slug);
            set_flash('success', "Plugin '{$slug}' berhasil diaktifkan!");
        }
        redirect('admin/plugins');
    }

    public function deletePlugin($slug) {
        require_once BASE_PATH . '/app/Core/PluginManager.php';
        $slug = sanitize($slug);
        PluginManager::deletePlugin($slug);
        set_flash('success', "Plugin '{$slug}' dan berkasnya berhasil dihapus.");
        redirect('admin/plugins');
    }

    public function importPlugin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/plugins');
        }

        if (!isset($_FILES['plugin_zip']) || $_FILES['plugin_zip']['error'] !== UPLOAD_ERR_OK) {
            set_flash('error', 'Silakan pilih berkas arsip plugin (.ZIP) untuk diunggah.');
            redirect('admin/plugins');
        }

        $file = $_FILES['plugin_zip'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if ($ext !== 'zip') {
            set_flash('error', 'Format berkas harus berupa .ZIP.');
            redirect('admin/plugins');
        }

        require_once BASE_PATH . '/app/Core/PluginManager.php';
        try {
            $slug = PluginManager::importPluginFromZip($file['tmp_name'], $file['name']);
            // Aktifkan langsung jika diminta
            if (!empty($_POST['activate_now'])) {
                PluginManager::activatePlugin($slug);
                set_flash('success', "Plugin '{$slug}' berhasil dipasang dan langsung diaktifkan!");
            } else {
                set_flash('success', "Plugin '{$slug}' berhasil dipasang! Silakan aktifkan jika ingin digunakan.");
            }
        } catch (Exception $e) {
            set_flash('error', 'Gagal memasang plugin: ' . $e->getMessage());
        }

        redirect('admin/plugins');
    }

    private function deleteDirectoryRecursive($dir) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!$this->deleteDirectoryRecursive($dir . DIRECTORY_SEPARATOR . $item)) return false;
        }
        return rmdir($dir);
    }
}

