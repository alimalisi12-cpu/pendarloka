<?php
// config/presets.php
// Definisi Master Preset Tradisi Acara Pernikahan (Agama & Budaya) serta Koleksi Musik Undangan

function get_wedding_default_presets() {
    return [
        'islam' => [
            'name' => 'Islam',
            'label' => 'Islam (Akad & Walimah)',
            'badge' => '🕌 Islam',
            'color' => 'success',
            'icon' => 'bi-moon-stars',
            'quote' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. (QS. Ar-Rum: 21)',
            'sessions' => [
                ['name' => 'Akad Nikah', 'time' => '08.00 - 10.00 WIB', 'place' => 'Masjid Agung Al-Ikhlas', 'address' => 'Jl. Raya Utama No. 1'],
                ['name' => 'Walimatul \'Ursy / Resepsi', 'time' => '11.00 - 14.00 WIB', 'place' => 'Grand Ballroom Hotel Aston', 'address' => 'Jl. Sudirman No. 45']
            ]
        ],
        'kristen' => [
            'name' => 'Kristen Protestan',
            'label' => 'Kristen Protestan (Pemberkatan & Resepsi)',
            'badge' => '✝️ Kristen',
            'color' => 'primary',
            'icon' => 'bi-heart-fill',
            'quote' => 'Kasih itu sabar; kasih itu murah hati; ia tidak cemburu. Ia tidak memegahkan diri dan tidak sombong. Demikianlah tinggal ketiga hal ini, yaitu iman, pengharapan dan kasih, dan yang paling besar di antaranya ialah kasih. (1 Korintus 13:4, 13)',
            'sessions' => [
                ['name' => 'Pemberkatan Nikah (Holy Matrimony)', 'time' => '09.00 - 11.00 WIB', 'place' => 'Gereja Tiberias / GKI / GPIB', 'address' => 'Jl. Kebangsaan No. 10'],
                ['name' => 'Resepsi Pernikahan', 'time' => '18.30 - 21.00 WIB', 'place' => 'Grand Ballroom Hotel Aston', 'address' => 'Jl. Sudirman No. 45']
            ]
        ],
        'katolik' => [
            'name' => 'Katolik',
            'label' => 'Katolik (Misa Sakramen Pernikahan)',
            'badge' => '⛪ Katolik',
            'color' => 'info',
            'icon' => 'bi-flower2',
            'quote' => 'Demikianlah mereka bukan lagi dua, melainkan satu. Karena itu, apa yang telah dipersatukan Allah, tidak boleh diceraikan manusia. (Matius 19:6)',
            'sessions' => [
                ['name' => 'Misa Sakramen Pernikahan', 'time' => '09.30 - 11.30 WIB', 'place' => 'Gereja Katedral Jakarta', 'address' => 'Jl. Katedral No. 7, Sawah Besar, Jakarta Pusat'],
                ['name' => 'Resepsi Pernikahan', 'time' => '18.30 - 21.30 WIB', 'place' => 'Grand Ballroom Hotel Hermitage', 'address' => 'Jl. Cilacap No. 1']
            ]
        ],
        'hindu' => [
            'name' => 'Hindu Bali',
            'label' => 'Hindu Bali (Pawiwahan & Resepsi)',
            'badge' => '🕉️ Hindu Bali',
            'color' => 'warning',
            'icon' => 'bi-brightness-high',
            'quote' => 'Ihaiva stam ma vi yaustam visvam ayur vyasnutam kridantau putrair naptrbhih modamanau sve grhe. (Wahai mempelai, hiduplah tenteram, jangan terpisahkan, capailah usia penuh, bergembiralah bersama anak cucu di dalam rumah tanggamu. - Rgveda X.85.42)',
            'sessions' => [
                ['name' => 'Upacara Pawiwahan Adat Bali', 'time' => '09.00 - 12.00 WITA', 'place' => 'Griya / Rumah Mempelai', 'address' => 'Jl. Danau Tamblingan No. 88, Sanur, Bali'],
                ['name' => 'Resepsi Pernikahan', 'time' => '18.00 - 21.00 WITA', 'place' => 'Taman Bhagawan Resort', 'address' => 'Tanjung Benoa, Nusa Dua, Bali']
            ]
        ],
        'buddha' => [
            'name' => 'Buddha',
            'label' => 'Buddha (Upasampada di Vihara)',
            'badge' => '☸️ Buddha',
            'color' => 'warning',
            'icon' => 'bi-sun',
            'quote' => 'Hidup berbahagia bersama pasangan yang sepadan keyakinannya, sepadan kebajikannya, sepadan kemurah-hatiannya, dan sepadan kebijaksanaannya. (Samajivina Sutta)',
            'sessions' => [
                ['name' => 'Pemberkatan Nikah (Upasampada)', 'time' => '09.00 - 11.00 WIB', 'place' => 'Vihara Jakarta Dhammacakka Jaya', 'address' => 'Jl. Sukarno No. 5'],
                ['name' => 'Resepsi Pernikahan', 'time' => '18.30 - 21.00 WIB', 'place' => 'Grand Ballroom Hotel Aston', 'address' => 'Jl. Thamrin No. 12']
            ]
        ],
        'batak' => [
            'name' => 'Adat Batak',
            'label' => 'Adat Batak (Martumpol & Ulaon Unjuk)',
            'badge' => '🏔️ Batak',
            'color' => 'danger',
            'icon' => 'bi-geo-alt',
            'quote' => 'Sai tubu ma anak na bisuk dohot boru na marroha, gabe jala horas markeluarga di bagasan asi dohot holong ni roha ni Debata.',
            'sessions' => [
                ['name' => 'Ibadah Martumpol (Ikat Janji)', 'time' => '08.00 - 09.30 WIB', 'place' => 'Gereja HKBP', 'address' => 'Jl. Jambu No. 5'],
                ['name' => 'Pemberkatan Pernikahan di Gereja', 'time' => '10.00 - 11.30 WIB', 'place' => 'Gereja HKBP', 'address' => 'Jl. Jambu No. 5'],
                ['name' => 'Pesta Adat Batak (Ulaon Unjuk)', 'time' => '12.00 - 17.00 WIB', 'place' => 'Wisma Pertemuan Mulia', 'address' => 'Jl. Gatot Subroto No. 20']
            ]
        ],
        'jawa' => [
            'name' => 'Adat Jawa',
            'label' => 'Adat Jawa (Siraman, Midodareni & Panggih)',
            'badge' => '🏛️ Jawa',
            'color' => 'secondary',
            'icon' => 'bi-flower1',
            'quote' => 'Ngluruk tanpa bala, menang tanpa ngasorake. Mugi tansah pinaringan berkah, ayem tentrem, runtut atut runtut nganti kaken-kaken ninen-ninen.',
            'sessions' => [
                ['name' => 'Siraman & Midodareni', 'time' => '19.00 - 21.00 WIB', 'place' => 'Kediaman Mempelai Wanita', 'address' => 'Jl. Melati No. 12'],
                ['name' => 'Akad Nikah / Ijab Qabul', 'time' => '08.00 - 10.00 WIB', 'place' => 'Pendopo Sasana Utomo', 'address' => 'Jl. Taman Mini'],
                ['name' => 'Upacara Adat Panggih & Resepsi', 'time' => '11.00 - 14.00 WIB', 'place' => 'Grand Ballroom Sasana Kriya', 'address' => 'Jl. Raya TMII']
            ]
        ],
        'sunda' => [
            'name' => 'Adat Sunda',
            'label' => 'Adat Sunda (Ngeuyeuk Seureuh & Sawer)',
            'badge' => '🌿 Sunda',
            'color' => 'success',
            'icon' => 'bi-tree',
            'quote' => 'Runtut raut sauyunan, sareundeuk saigel sabobot sapihanean, ka cai jadi saleuwi ka darat jadi salebak. Mugia dipaparin kabagjaan lahir sinareng batin.',
            'sessions' => [
                ['name' => 'Upacara Ngeuyeuk Seureuh', 'time' => '19.30 - 21.00 WIB', 'place' => 'Bumi Panganten (Rumah Mempelai)', 'address' => 'Jl. Cendrawasih No. 8'],
                ['name' => 'Akad Nikah', 'time' => '08.00 - 10.00 WIB', 'place' => 'Masjid Agung / Gedung', 'address' => 'Jl. Dago No. 100, Bandung'],
                ['name' => 'Sawer, Huap Lingkup & Resepsi', 'time' => '11.00 - 14.00 WIB', 'place' => 'Gedung Bale Asri Pusdai', 'address' => 'Jl. Diponegoro No. 63, Bandung']
            ]
        ],
        'chinese' => [
            'name' => 'Tionghoa / Chinese',
            'label' => 'Tionghoa / Chinese (Tea Pai & Banquet)',
            'badge' => '🍵 Chinese',
            'color' => 'danger',
            'icon' => 'bi-cup-hot',
            'quote' => '百年好合，永结同心 (Bǎi nián hǎo hé, yǒng jié tóng xīn) - Semoga harmonis seumur hidup dan selalu bersatu hati dalam cinta dan berkah abadi.',
            'sessions' => [
                ['name' => 'Upacara Tea Pai (Tea Ceremony)', 'time' => '08.30 - 10.00 WIB', 'place' => 'VIP Lounge Hotel', 'address' => 'Jl. M.H. Thamrin'],
                ['name' => 'Pemberkatan Nikah', 'time' => '10.30 - 12.00 WIB', 'place' => 'Chapel / Gereja', 'address' => 'Jl. Suropati No. 2'],
                ['name' => 'Wedding Banquet & Dinner', 'time' => '18.30 - 21.30 WIB', 'place' => 'Grand Ballroom Hotel Shangri-La', 'address' => 'Jl. Jend. Sudirman']
            ]
        ],
        'nasional' => [
            'name' => 'Nasional / Modern',
            'label' => 'Nasional / Modern (Ceremony & Resepsi)',
            'badge' => '✨ Nasional',
            'color' => 'dark',
            'icon' => 'bi-stars',
            'quote' => 'Dua hati, dua jiwa, dipersatukan dalam ikatan cinta suci untuk saling melengkapi dan menyayangi selamanya.',
            'sessions' => [
                ['name' => 'Akad / Ceremony', 'time' => '08.30 - 10.30 WIB', 'place' => 'Main Hall', 'address' => 'Jl. Kebon Sirih No. 17'],
                ['name' => 'Resepsi Perayaan', 'time' => '11.30 - 14.30 WIB', 'place' => 'Grand Ballroom', 'address' => 'Jl. Kebon Sirih No. 17']
            ]
        ],
        'custom' => [
            'name' => 'Kustom Bebas',
            'label' => 'Kustom Bebas (Sesuai Keinginan Pengguna)',
            'badge' => '🛠️ Kustom',
            'color' => 'secondary',
            'icon' => 'bi-sliders',
            'quote' => '',
            'sessions' => [
                ['name' => 'Sesi Acara 1', 'time' => '08.00 - 10.00 WIB', 'place' => 'Gedung / Tempat 1', 'address' => ''],
                ['name' => 'Sesi Acara 2', 'time' => '11.00 - 14.00 WIB', 'place' => 'Gedung / Tempat 2', 'address' => '']
            ]
        ]
    ];
}

function get_wedding_presets() {
    $defaults = get_wedding_default_presets();
    $customJson = Setting::get('wedding_tradition_presets_json');
    if (!empty($customJson)) {
        $custom = json_decode($customJson, true);
        if (is_array($custom) && !empty($custom)) {
            foreach ($custom as $k => $val) {
                $defaults[$k] = $val;
            }
        }
    }
    return $defaults;
}

function save_wedding_presets(array $presets) {
    return Setting::set('wedding_tradition_presets_json', json_encode($presets, JSON_UNESCAPED_UNICODE));
}

function reset_wedding_presets() {
    return Setting::set('wedding_tradition_presets_json', '');
}

function get_preset_info($key) {
    $presets = get_wedding_presets();
    $key = strtolower(trim($key ?? ''));
    return $presets[$key] ?? $presets['islam'];
}

function get_preset_badge_html($key) {
    $info = get_preset_info($key);
    $color = $info['color'] ?? 'secondary';
    $badge = $info['badge'] ?? htmlspecialchars($key);
    return '<span class="badge bg-' . $color . '-subtle text-' . $color . ' border border-' . $color . '-subtle rounded-pill px-2.5 py-1 fw-semibold small">' . $badge . '</span>';
}

// ==========================================
// KOLEKSI MUSIK PERNIKAHAN POPULER (USER-FRIENDLY)
// ==========================================
function get_curated_wedding_music() {
    return [
        [
            'id' => 'canon_in_d',
            'title' => 'Canon in D (Pachelbel) - Piano & Strings',
            'artist' => 'Classical Wedding',
            'category' => 'Instrumental Klasik',
            'duration' => '3:15',
            'url' => 'https://actions.google.com/sounds/v1/water/air_conditioner.ogg' // Fallback safe sound, but let's provide dependable wedding instrumental URLs
        ],
        [
            'id' => 'thousand_years',
            'title' => 'A Thousand Years - Romantic Piano & Cello',
            'artist' => 'Piano Romance',
            'category' => 'Pop Romantis',
            'duration' => '4:20',
            'url' => 'https://cdn.pixabay.com/download/audio/2022/05/16/audio_db6591201e.mp3?filename=romantic-piano-111166.mp3'
        ],
        [
            'id' => 'beautiful_in_white',
            'title' => 'Beautiful In White - Wedding Orchestra',
            'artist' => 'Bridal Symphony',
            'category' => 'Orkestra Elegan',
            'duration' => '3:45',
            'url' => 'https://cdn.pixabay.com/download/audio/2022/10/14/audio_9939f792cb.mp3?filename=wedding-love-123497.mp3'
        ],
        [
            'id' => 'cant_help_falling_in_love',
            'title' => 'Can\'t Help Falling in Love - Acoustic Fingerstyle',
            'artist' => 'Acoustic Guitar Romance',
            'category' => 'Akustik Romantis',
            'duration' => '3:10',
            'url' => 'https://cdn.pixabay.com/download/audio/2022/03/10/audio_c3527e30ec.mp3?filename=acoustic-guitars-ambient-10657.mp3'
        ],
        [
            'id' => 'until_i_found_you',
            'title' => 'Until I Found You - Vintage Sweet Romance',
            'artist' => 'Vintage Ballad',
            'category' => 'Vintage Sweet',
            'duration' => '3:05',
            'url' => 'https://cdn.pixabay.com/download/audio/2023/02/28/audio_550e50f3ec.mp3?filename=sweet-love-story-141285.mp3'
        ],
        [
            'id' => 'janji_suci_akad',
            'title' => 'Janji Suci / Akad - Akustik Romantis Syahdu',
            'artist' => 'Nusantara Romance',
            'category' => 'Nusantara Pop',
            'duration' => '4:00',
            'url' => 'https://cdn.pixabay.com/download/audio/2022/08/02/audio_884fe92c21.mp3?filename=romantic-wedding-ambient-116492.mp3'
        ],
        [
            'id' => 'cinematic_wedding',
            'title' => 'Cinematic Inspiring Love - Uplifting Strings',
            'artist' => 'Cinematic Romance',
            'category' => 'Sinematik Modern',
            'duration' => '3:30',
            'url' => 'https://cdn.pixabay.com/download/audio/2022/01/18/audio_d0a13f69d2.mp3?filename=inspiring-cinematic-ambient-116199.mp3'
        ],
        [
            'id' => 'soft_piano_dream',
            'title' => 'Forever in Love - Soft Piano & Ambient Melody',
            'artist' => 'Peaceful Romance',
            'category' => 'Piano Lembut',
            'duration' => '2:50',
            'url' => 'https://cdn.pixabay.com/download/audio/2021/11/24/audio_34b35e263d.mp3?filename=piano-moment-9835.mp3'
        ]
    ];
}
