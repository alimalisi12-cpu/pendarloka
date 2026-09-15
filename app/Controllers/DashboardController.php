<?php
// app/Controllers/DashboardController.php

require_once dirname(__DIR__, 2) . '/config/app.php';
require_once dirname(__DIR__) . '/Models/Event.php';
require_once dirname(__DIR__) . '/Models/Template.php';
require_once dirname(__DIR__) . '/Models/Guest.php';
require_once dirname(__DIR__) . '/Models/Wish.php';

class DashboardController {
    private $eventModel;
    private $templateModel;
    private $guestModel;
    private $wishModel;

    public function __construct() {
        if (!is_logged_in()) {
            set_flash('error', 'Silakan login terlebih dahulu untuk mengakses dashboard.');
            redirect('login');
        }

        $this->eventModel = new Event();
        $this->templateModel = new Template();
        $this->guestModel = new Guest();
        $this->wishModel = new Wish();
    }

    public function index() {
        $userId = $_SESSION['user_id'];
        $events = $this->eventModel->getByUserId($userId);

        require_once BASE_PATH . '/views/dashboard/index.php';
    }

    public function create() {
        $categories = $this->templateModel->getCategories();
        $templates = $this->templateModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = sanitize($_POST['title'] ?? '');
            $categoryId = (int)($_POST['category_id'] ?? 1);
            $templateId = (int)($_POST['template_id'] ?? 1);
            $eventDate = sanitize($_POST['event_date'] ?? date('Y-m-d'));
            $customSlug = sanitize($_POST['slug'] ?? '');

            if (empty($title)) {
                set_flash('error', 'Judul acara wajib diisi!');
                redirect('dashboard/create');
            }

            // Generate slug unik
            $slugBase = !empty($customSlug) ? $customSlug : preg_replace('/[^a-z0-9]+/i', '-', strtolower($title));
            $slug = $slugBase;
            $counter = 1;
            while ($this->eventModel->findBySlug($slug)) {
                $slug = $slugBase . '-' . $counter;
                $counter++;
            }

            $userId = $_SESSION['user_id'];
            $musicUrl = 'https://actions.google.com/sounds/v1/water/rain_heavy.ogg'; // default gentle audio

            $eventId = $this->eventModel->create($userId, $templateId, $categoryId, $title, $slug, $eventDate, $musicUrl);

            $preset = sanitize($_POST['event_type_preset'] ?? 'islam');
            $presetDefaults = [
                'islam' => [
                    'quote' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. (QS. Ar-Rum: 21)',
                    'sessions' => [
                        ['name' => 'Akad Nikah', 'date' => $eventDate, 'time' => '08.00 - 10.00 WIB', 'place' => 'Masjid Agung Al-Ikhlas', 'address' => 'Jl. Raya Utama No. 1', 'maps_url' => ''],
                        ['name' => "Walimatul 'Ursy / Resepsi", 'date' => $eventDate, 'time' => '11.00 - 14.00 WIB', 'place' => 'Grand Ballroom Hotel Aston', 'address' => 'Jl. Sudirman No. 45', 'maps_url' => '']
                    ]
                ],
                'kristen' => [
                    'quote' => 'Kasih itu sabar; kasih itu murah hati; ia tidak cemburu. Ia tidak memegahkan diri dan tidak sombong. Demikianlah tinggal ketiga hal ini, yaitu iman, pengharapan dan kasih, dan yang paling besar di antaranya ialah kasih. (1 Korintus 13:4, 13)',
                    'sessions' => [
                        ['name' => 'Pemberkatan Nikah (Holy Matrimony)', 'date' => $eventDate, 'time' => '09.00 - 11.00 WIB', 'place' => 'Gereja Tiberias / GKI / GPIB', 'address' => 'Jl. Kebangsaan No. 10', 'maps_url' => ''],
                        ['name' => 'Resepsi Pernikahan', 'date' => $eventDate, 'time' => '18.30 - 21.00 WIB', 'place' => 'Grand Ballroom Hotel Aston', 'address' => 'Jl. Sudirman No. 45', 'maps_url' => '']
                    ]
                ],
                'katolik' => [
                    'quote' => 'Demikianlah mereka bukan lagi dua, melainkan satu. Karena itu, apa yang telah dipersatukan Allah, tidak boleh diceraikan manusia. (Matius 19:6)',
                    'sessions' => [
                        ['name' => 'Misa Sakramen Pernikahan', 'date' => $eventDate, 'time' => '09.30 - 11.30 WIB', 'place' => 'Gereja Katedral Jakarta', 'address' => 'Jl. Katedral No. 7, Sawah Besar', 'maps_url' => ''],
                        ['name' => 'Resepsi Pernikahan', 'date' => $eventDate, 'time' => '18.30 - 21.30 WIB', 'place' => 'Grand Ballroom Hotel Hermitage', 'address' => 'Jl. Cilacap No. 1', 'maps_url' => '']
                    ]
                ],
                'hindu' => [
                    'quote' => 'Ihaiva stam ma vi yaustam visvam ayur vyasnutam kridantau putrair naptrbhih modamanau sve grhe. (Wahai mempelai, hiduplah tenteram, jangan terpisahkan, capailah usia penuh, bergembiralah bersama anak cucu di dalam rumah tanggamu. - Rgveda X.85.42)',
                    'sessions' => [
                        ['name' => 'Upacara Pawiwahan Adat Bali', 'date' => $eventDate, 'time' => '09.00 - 12.00 WITA', 'place' => 'Griya / Rumah Mempelai', 'address' => 'Jl. Danau Tamblingan No. 88, Sanur, Bali', 'maps_url' => ''],
                        ['name' => 'Resepsi Pernikahan', 'date' => $eventDate, 'time' => '18.00 - 21.00 WITA', 'place' => 'Taman Bhagawan Resort', 'address' => 'Tanjung Benoa, Nusa Dua, Bali', 'maps_url' => '']
                    ]
                ],
                'buddha' => [
                    'quote' => 'Hidup berbahagia bersama pasangan yang sepadan keyakinannya, sepadan kebajikannya, sepadan kemurah-hatiannya, dan sepadan kebijaksanaannya. (Samajivina Sutta)',
                    'sessions' => [
                        ['name' => 'Pemberkatan Nikah (Upasampada)', 'date' => $eventDate, 'time' => '09.00 - 11.00 WIB', 'place' => 'Vihara Jakarta Dhammacakka Jaya', 'address' => 'Jl. Sukarno No. 5', 'maps_url' => ''],
                        ['name' => 'Resepsi Pernikahan', 'date' => $eventDate, 'time' => '18.30 - 21.00 WIB', 'place' => 'Grand Ballroom Hotel Aston', 'address' => 'Jl. Thamrin No. 12', 'maps_url' => '']
                    ]
                ],
                'batak' => [
                    'quote' => 'Sai tubu ma anak na bisuk dohot boru na marroha, gabe jala horas markeluarga di bagasan asi dohot holong ni roha ni Debata.',
                    'sessions' => [
                        ['name' => 'Ibadah Martumpol (Ikat Janji)', 'date' => $eventDate, 'time' => '08.00 - 09.30 WIB', 'place' => 'Gereja HKBP', 'address' => 'Jl. Jambu No. 5', 'maps_url' => ''],
                        ['name' => 'Pemberkatan Pernikahan di Gereja', 'date' => $eventDate, 'time' => '10.00 - 11.30 WIB', 'place' => 'Gereja HKBP', 'address' => 'Jl. Jambu No. 5', 'maps_url' => ''],
                        ['name' => 'Pesta Adat Batak (Ulaon Unjuk)', 'date' => $eventDate, 'time' => '12.00 - 17.00 WIB', 'place' => 'Wisma Pertemuan Mulia', 'address' => 'Jl. Gatot Subroto No. 20', 'maps_url' => '']
                    ]
                ],
                'jawa' => [
                    'quote' => 'Ngluruk tanpa bala, menang tanpa ngasorake. Mugi tansah pinaringan berkah, ayem tentrem, runtut atut runtut nganti kaken-kaken ninen-ninen.',
                    'sessions' => [
                        ['name' => 'Siraman & Midodareni', 'date' => $eventDate, 'time' => '19.00 - 21.00 WIB', 'place' => 'Kediaman Mempelai Wanita', 'address' => 'Jl. Melati No. 12', 'maps_url' => ''],
                        ['name' => 'Akad Nikah / Ijab Qabul', 'date' => $eventDate, 'time' => '08.00 - 10.00 WIB', 'place' => 'Pendopo Sasana Utomo', 'address' => 'Jl. Taman Mini', 'maps_url' => ''],
                        ['name' => 'Upacara Adat Panggih & Resepsi', 'date' => $eventDate, 'time' => '11.00 - 14.00 WIB', 'place' => 'Grand Ballroom Sasana Kriya', 'address' => 'Jl. Raya TMII', 'maps_url' => '']
                    ]
                ],
                'sunda' => [
                    'quote' => 'Runtut raut sauyunan, sareundeuk saigel sabobot sapihanean, ka cai jadi saleuwi ka darat jadi salebak. Mugia dipaparin kabagjaan lahir sinareng batin.',
                    'sessions' => [
                        ['name' => 'Upacara Ngeuyeuk Seureuh', 'date' => $eventDate, 'time' => '19.30 - 21.00 WIB', 'place' => 'Bumi Panganten (Rumah Mempelai)', 'address' => 'Jl. Cendrawasih No. 8', 'maps_url' => ''],
                        ['name' => 'Akad Nikah', 'date' => $eventDate, 'time' => '08.00 - 10.00 WIB', 'place' => 'Masjid Agung / Gedung', 'address' => 'Jl. Dago No. 100, Bandung', 'maps_url' => ''],
                        ['name' => 'Sawer, Huap Lingkup & Resepsi', 'date' => $eventDate, 'time' => '11.00 - 14.00 WIB', 'place' => 'Gedung Bale Asri Pusdai', 'address' => 'Jl. Diponegoro No. 63, Bandung', 'maps_url' => '']
                    ]
                ],
                'chinese' => [
                    'quote' => '百年好合，永结同心 (Bǎi nián hǎo hé, yǒng jié tóng xīn) - Semoga harmonis seumur hidup dan selalu bersatu hati dalam cinta dan berkah abadi.',
                    'sessions' => [
                        ['name' => 'Upacara Tea Pai (Tea Ceremony)', 'date' => $eventDate, 'time' => '08.30 - 10.00 WIB', 'place' => 'VIP Lounge Hotel', 'address' => 'Jl. M.H. Thamrin', 'maps_url' => ''],
                        ['name' => 'Pemberkatan Nikah', 'date' => $eventDate, 'time' => '10.30 - 12.00 WIB', 'place' => 'Chapel / Gereja', 'address' => 'Jl. Suropati No. 2', 'maps_url' => ''],
                        ['name' => 'Wedding Banquet & Dinner', 'date' => $eventDate, 'time' => '18.30 - 21.30 WIB', 'place' => 'Grand Ballroom Hotel Shangri-La', 'address' => 'Jl. Jend. Sudirman', 'maps_url' => '']
                    ]
                ],
                'nasional' => [
                    'quote' => 'Dua hati, dua jiwa, dipersatukan dalam ikatan cinta suci untuk saling melengkapi dan menyayangi selamanya.',
                    'sessions' => [
                        ['name' => 'Akad Nikah / Pemberkatan', 'date' => $eventDate, 'time' => '09.00 - 11.00 WIB', 'place' => 'Tempat Ibadah / Ballroom', 'address' => 'Jl. Utama Kota No. 10', 'maps_url' => ''],
                        ['name' => 'Resepsi Pernikahan', 'date' => $eventDate, 'time' => '18.30 - 21.00 WIB', 'place' => 'Grand Ballroom Hotel', 'address' => 'Jl. Utama Kota No. 10', 'maps_url' => '']
                    ]
                ],
                'custom' => [
                    'quote' => 'Cinta tidak melihat dengan mata, tetapi dengan hati.',
                    'sessions' => [
                        ['name' => 'Sesi Acara 1', 'date' => $eventDate, 'time' => '09.00 - 11.00 WIB', 'place' => 'Lokasi Sesi 1', 'address' => 'Alamat Sesi 1', 'maps_url' => ''],
                        ['name' => 'Sesi Acara 2', 'date' => $eventDate, 'time' => '13.00 - 16.00 WIB', 'place' => 'Lokasi Sesi 2', 'address' => 'Alamat Sesi 2', 'maps_url' => '']
                    ]
                ]
            ];

            $initialData = $presetDefaults[$preset] ?? $presetDefaults['islam'];
            $this->eventModel->updateDetails($eventId, [
                'event_type_preset' => $preset,
                'quote' => $initialData['quote'],
                'events_schedule_json' => json_encode($initialData['sessions'], JSON_UNESCAPED_UNICODE),
                'akad_time' => $initialData['sessions'][0]['time'] ?? '',
                'akad_location' => ($initialData['sessions'][0]['place'] ?? '') . ' - ' . ($initialData['sessions'][0]['address'] ?? ''),
                'resepsi_time' => $initialData['sessions'][1]['time'] ?? '',
                'resepsi_location' => ($initialData['sessions'][1]['place'] ?? '') . ' - ' . ($initialData['sessions'][1]['address'] ?? '')
            ]);

            set_flash('success', 'Undangan berhasil dibuat! Silakan lengkapi detail acara Anda.');
            redirect('dashboard/edit/' . $eventId);
        }

        require_once BASE_PATH . '/views/dashboard/create_event.php';
    }

    public function edit($eventId) {
        $userId = $_SESSION['user_id'];
        $event = $this->eventModel->findById($eventId);

        if (!$event || (!is_admin() && $event['user_id'] != $userId)) {
            set_flash('error', 'Acara tidak ditemukan atau akses ditolak.');
            redirect('dashboard');
        }

        $templates = $this->templateModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update Data Utama Event
            $eventData = [
                'title' => sanitize($_POST['title'] ?? $event['title']),
                'event_date' => sanitize($_POST['event_date'] ?? $event['event_date']),
                'template_id' => (int)($_POST['template_id'] ?? $event['template_id']),
                'music_url' => sanitize($_POST['music_url'] ?? $event['music_url']),
                'status' => sanitize($_POST['status'] ?? 'published')
            ];
            $this->eventModel->updateEvent($eventId, $eventData);

            // Parsing Rekening Bank
            $bankAccounts = [];
            if (!empty($_POST['bank_name']) && is_array($_POST['bank_name'])) {
                for ($i = 0; $i < count($_POST['bank_name']); $i++) {
                    if (!empty(trim($_POST['bank_name'][$i]))) {
                        $bankAccounts[] = [
                            'bank' => sanitize($_POST['bank_name'][$i]),
                            'number' => sanitize($_POST['bank_number'][$i] ?? ''),
                            'owner' => sanitize($_POST['bank_owner'][$i] ?? '')
                        ];
                    }
                }
            }

            // Parsing Love Story / Kisah Perjalanan Cinta
            $loveStory = [];
            if (!empty($_POST['story_title']) && is_array($_POST['story_title'])) {
                for ($i = 0; $i < count($_POST['story_title']); $i++) {
                    $sTitle = trim($_POST['story_title'][$i] ?? '');
                    if (!empty($sTitle)) {
                        $sYear = sanitize($_POST['story_year'][$i] ?? ($_POST['story_date'][$i] ?? ''));
                        $sDesc = sanitize($_POST['story_desc'][$i] ?? ($_POST['story_story'][$i] ?? ''));
                        $sImage = sanitize($_POST['story_image'][$i] ?? '');

                        $loveStory[] = [
                            'title' => sanitize($sTitle),
                            'year' => $sYear,
                            'date' => $sYear,
                            'desc' => $sDesc,
                            'story' => $sDesc,
                            'image' => $sImage
                        ];
                    }
                }
            } elseif (!empty($_POST['story_year']) && is_array($_POST['story_year'])) {
                for ($i = 0; $i < count($_POST['story_year']); $i++) {
                    if (!empty(trim($_POST['story_title'][$i] ?? ''))) {
                        $sYear = sanitize($_POST['story_year'][$i] ?? '');
                        $sTitle = sanitize($_POST['story_title'][$i]);
                        $sDesc = sanitize($_POST['story_desc'][$i] ?? '');
                        $loveStory[] = [
                            'year' => $sYear,
                            'date' => $sYear,
                            'title' => $sTitle,
                            'desc' => $sDesc,
                            'story' => $sDesc,
                            'image' => sanitize($_POST['story_image'][$i] ?? '')
                        ];
                    }
                }
            }

            // Parsing Gallery URLs
            $gallery = [];
            if (!empty($_POST['gallery_url']) && is_array($_POST['gallery_url'])) {
                foreach ($_POST['gallery_url'] as $gUrl) {
                    $cleanUrl = trim($gUrl);
                    if (!empty($cleanUrl)) {
                        $gallery[] = sanitize($cleanUrl);
                    }
                }
            }
            $uploadedGalleries = $this->handleMultipleUploads('gallery_files', 'gallery');
            foreach ($uploadedGalleries as $upG) {
                $gallery[] = $upG;
            }

            // Handle Photo Roles & Uploads
            $groomPhoto = trim($_POST['groom_photo'] ?? '');
            $uploadedGroom = $this->handleFileUpload('groom_photo_file', 'groom');
            if ($uploadedGroom) $groomPhoto = $uploadedGroom;

            $bridePhoto = trim($_POST['bride_photo'] ?? '');
            $uploadedBride = $this->handleFileUpload('bride_photo_file', 'bride');
            if ($uploadedBride) $bridePhoto = $uploadedBride;

            $coverPhoto = trim($_POST['cover_photo'] ?? '');
            $uploadedCover = $this->handleFileUpload('cover_photo_file', 'cover');
            if ($uploadedCover) $coverPhoto = $uploadedCover;

            $heroPhoto = trim($_POST['hero_photo'] ?? '');
            $uploadedHero = $this->handleFileUpload('hero_photo_file', 'hero');
            if ($uploadedHero) $heroPhoto = $uploadedHero;

            $bgPhoto = trim($_POST['bg_photo'] ?? '');
            $uploadedBg = $this->handleFileUpload('bg_photo_file', 'bg');
            if ($uploadedBg) $bgPhoto = $uploadedBg;

            // Parsing Rangkaian Acara Kustom / Tradisi Agama & Budaya
            $scheduleList = [];
            if (!empty($_POST['schedule_name']) && is_array($_POST['schedule_name'])) {
                for ($i = 0; $i < count($_POST['schedule_name']); $i++) {
                    $sName = trim($_POST['schedule_name'][$i] ?? '');
                    if (!empty($sName)) {
                        $scheduleList[] = [
                            'name' => sanitize($sName),
                            'date' => sanitize($_POST['schedule_date'][$i] ?? ''),
                            'time' => sanitize($_POST['schedule_time'][$i] ?? ''),
                            'place' => sanitize($_POST['schedule_place'][$i] ?? ''),
                            'address' => sanitize($_POST['schedule_address'][$i] ?? ''),
                            'maps_url' => sanitize($_POST['schedule_maps_url'][$i] ?? '')
                        ];
                    }
                }
            }

            $eventTypePreset = sanitize($_POST['event_type_preset'] ?? 'islam');

            $akadTime = sanitize($_POST['akad_time'] ?? '');
            $akadLocation = sanitize($_POST['akad_location'] ?? '');
            $resepsiTime = sanitize($_POST['resepsi_time'] ?? '');
            $resepsiLocation = sanitize($_POST['resepsi_location'] ?? '');

            // Sinkronisasi otomatis ke akad & resepsi jika schedule diisi
            if (!empty($scheduleList)) {
                if (isset($scheduleList[0])) {
                    $akadTime = $scheduleList[0]['time'];
                    $akadLocation = trim($scheduleList[0]['place'] . (!empty($scheduleList[0]['address']) ? "\n" . $scheduleList[0]['address'] : ''));
                }
                if (isset($scheduleList[1])) {
                    $resepsiTime = $scheduleList[1]['time'];
                    $resepsiLocation = trim($scheduleList[1]['place'] . (!empty($scheduleList[1]['address']) ? "\n" . $scheduleList[1]['address'] : ''));
                }
            }

            // Update Details
            $details = [
                'groom_name' => sanitize($_POST['groom_name'] ?? ''),
                'groom_nickname' => sanitize($_POST['groom_nickname'] ?? ''),
                'groom_parents' => sanitize($_POST['groom_parents'] ?? ''),
                'groom_instagram' => sanitize($_POST['groom_instagram'] ?? ''),
                'groom_photo' => $groomPhoto,
                'bride_name' => sanitize($_POST['bride_name'] ?? ''),
                'bride_nickname' => sanitize($_POST['bride_nickname'] ?? ''),
                'bride_parents' => sanitize($_POST['bride_parents'] ?? ''),
                'bride_instagram' => sanitize($_POST['bride_instagram'] ?? ''),
                'bride_photo' => $bridePhoto,
                'cover_photo' => $coverPhoto,
                'hero_photo' => $heroPhoto,
                'bg_photo' => $bgPhoto,
                'quote' => sanitize($_POST['quote'] ?? ''),
                'akad_time' => $akadTime,
                'akad_location' => $akadLocation,
                'resepsi_time' => $resepsiTime,
                'resepsi_location' => $resepsiLocation,
                'maps_url' => sanitize($_POST['maps_url'] ?? ''),
                'maps_embed' => $_POST['maps_embed'] ?? '',
                'events_schedule_json' => !empty($scheduleList) ? json_encode($scheduleList) : null,
                'event_type_preset' => $eventTypePreset,
                'gift_address' => sanitize($_POST['gift_address'] ?? ''),
                'bank_accounts_json' => json_encode($bankAccounts),
                'love_story_json' => json_encode($loveStory),
                'gallery_json' => json_encode($gallery)
            ];

            $this->eventModel->updateDetails($eventId, $details);

            set_flash('success', 'Data undangan, susunan acara, dan konfigurasi foto berhasil diperbarui!');
            if (is_admin() && isset($_POST['save_and_to_admin'])) {
                redirect('admin/events');
            } else {
                redirect('dashboard/edit/' . $eventId);
            }
        }

        require_once BASE_PATH . '/views/dashboard/edit_event.php';
    }

    public function uploadPhoto() {
        if (!is_logged_in()) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        // Cek apakah multiple files
        if (!empty($_FILES['photos'])) {
            $uploaded = $this->handleMultipleUploads('photos', 'gallery');
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'files' => array_map(function($path) {
                    return [
                        'url' => media_url($path),
                        'path' => $path
                    ];
                }, $uploaded)
            ]);
            exit;
        }

        // Single file upload
        $fileKey = !empty($_FILES['photo']) ? 'photo' : (!empty($_FILES['file']) ? 'file' : '');
        if (empty($fileKey) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Tidak ada file yang diunggah atau terjadi error.']);
            exit;
        }

        $file = $_FILES[$fileKey];
        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Format file tidak didukung. Gunakan JPG, PNG, atau WEBP.']);
            exit;
        }

        $uploadDir = BASE_PATH . '/assets/uploads/events/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $role = sanitize($_POST['role'] ?? 'photo');
        $filename = $role . '_' . uniqid() . '_' . time() . '.' . $ext;

        if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            $relPath = 'assets/uploads/events/' . $filename;
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'url' => media_url($relPath),
                'path' => $relPath
            ]);
            exit;
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Gagal memindahkan file ke direktori server.']);
        exit;
    }

    public function uploadMusic() {
        if (!is_logged_in()) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        $fileKey = !empty($_FILES['music']) ? 'music' : (!empty($_FILES['audio']) ? 'audio' : (!empty($_FILES['file']) ? 'file' : ''));
        if (empty($fileKey) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Tidak ada file audio yang diunggah atau ukuran file melebihi batas upload.']);
            exit;
        }

        $file = $_FILES[$fileKey];
        $allowedExts = ['mp3', 'ogg', 'wav', 'm4a', 'aac'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Format file musik harus MP3, OGG, WAV, atau M4A.']);
            exit;
        }

        $uploadDir = BASE_PATH . '/assets/uploads/music/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = 'wedding_song_' . uniqid() . '_' . time() . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            $relPath = 'assets/uploads/music/' . $filename;
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'url' => media_url($relPath),
                'path' => $relPath,
                'filename' => $file['name']
            ]);
            exit;
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan file audio ke server.']);
        exit;
    }

    private function handleFileUpload($fileInputName, $prefix = 'photo') {
        if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        $file = $_FILES[$fileInputName];
        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExts)) {
            return null;
        }
        $uploadDir = BASE_PATH . '/assets/uploads/events/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $filename = $prefix . '_' . uniqid() . '_' . time() . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            return 'assets/uploads/events/' . $filename;
        }
        return null;
    }

    private function handleMultipleUploads($fileInputName, $prefix = 'gallery') {
        $uploadedPaths = [];
        if (!isset($_FILES[$fileInputName]) || !is_array($_FILES[$fileInputName]['name'])) {
            return $uploadedPaths;
        }
        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $uploadDir = BASE_PATH . '/assets/uploads/events/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $count = count($_FILES[$fileInputName]['name']);
        for ($i = 0; $i < $count; $i++) {
            if ($_FILES[$fileInputName]['error'][$i] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES[$fileInputName]['name'][$i], PATHINFO_EXTENSION));
                if (in_array($ext, $allowedExts)) {
                    $filename = $prefix . '_' . uniqid() . '_' . time() . '_' . $i . '.' . $ext;
                    if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'][$i], $uploadDir . $filename)) {
                        $uploadedPaths[] = 'assets/uploads/events/' . $filename;
                    }
                }
            }
        }
        return $uploadedPaths;
    }

    public function guests($eventId) {
        $userId = $_SESSION['user_id'];
        $event = $this->eventModel->findById($eventId);

        if (!$event || (!is_admin() && $event['user_id'] != $userId)) {
            set_flash('error', 'Acara tidak ditemukan.');
            redirect('dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'add') {
                $name = sanitize($_POST['name'] ?? '');
                $phone = sanitize($_POST['phone'] ?? '');

                if (!empty($name)) {
                    $this->guestModel->add($eventId, $name, $phone);
                    set_flash('success', "Tamu '{$name}' berhasil ditambahkan!");
                }
            } elseif ($action === 'delete') {
                $guestId = (int)($_POST['guest_id'] ?? 0);
                $this->guestModel->delete($guestId, $eventId);
                set_flash('success', 'Tamu berhasil dihapus.');
            }

            redirect('dashboard/guests/' . $eventId);
        }

        $guests = $this->guestModel->getByEventId($eventId);
        $stats = $this->guestModel->getStats($eventId);

        require_once BASE_PATH . '/views/dashboard/guests.php';
    }

    public function printGuests($eventId) {
        $userId = $_SESSION['user_id'];
        $event = $this->eventModel->findById($eventId);

        if (!$event || (!is_admin() && $event['user_id'] != $userId)) {
            set_flash('error', 'Acara tidak ditemukan.');
            redirect('dashboard');
        }

        $guests = $this->guestModel->getByEventId($eventId);
        $stats = $this->guestModel->getStats($eventId);

        require_once BASE_PATH . '/views/dashboard/print_guests.php';
    }
}
