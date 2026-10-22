<?php

class ThemeCatalog {

    /**
     * Struktur Konfigurasi Default JSON untuk Builder & Tema
     */
    public static function getDefaultConfig() {
        return [
            'palette_preset' => 'nature_classic',
            'colors' => [
                'primary' => '#928573',
                'secondary' => '#E1D6C7',
                'accent' => '#C5A059',
                'bg_body' => '#FAF7F2',
                'bg_card' => '#FFFFFF',
                'text_dark' => '#2D2D2D',
                'text_muted' => '#6C757D'
            ],
            'typography' => [
                'font_heading' => 'Great Vibes',
                'font_body' => 'Playfair Display',
                'font_accent' => 'Marcellus'
            ],
            'ornaments' => [
                'corner_style' => 'floral-vintage',
                'corner_position' => 'top', // 'all', 'top', 'bottom', 'none'
                'corner_opacity' => 0.65,
                'divider_style' => 'divider-olive',
                'divider_opacity' => 0.75,
                'photo_frame' => 'arch-cathedral',
                'badge_style' => 'wax-seal-gold',
                'monogram_style' => 'monogram-floral-wreath'
            ],
            'effects' => [
                'particle' => 'petals', // 'petals', 'leaves', 'sparkles', 'snow', 'none'
                'cover_transition' => 'slide_up', // 'slide_up', 'curtain_split', 'envelope_3d', 'fade_out'
                'entrance_animation' => 'fade_up', // 'fade_up', 'zoom_in', 'slide_in', 'none'
                'floating_nav' => true,
                'music_spin' => true
            ],
            'layout' => [
                'style' => 'continuous_scroll', // 'continuous_scroll', 'snap_card', 'tabbed'
                'container_width' => 'max-w-md', // 'max-w-md', 'max-w-lg', 'max-w-xl'
                'sections' => [
                    ['id' => 'cover', 'name' => 'Cover & Hero', 'visible' => true, 'order' => 1],
                    ['id' => 'couple', 'name' => 'Profil Mempelai', 'visible' => true, 'order' => 2],
                    ['id' => 'events', 'name' => 'Jadwal Acara', 'visible' => true, 'order' => 3],
                    ['id' => 'story', 'name' => 'Kisah Cinta (Love Story)', 'visible' => true, 'order' => 4],
                    ['id' => 'gallery', 'name' => 'Galeri Foto & Video', 'visible' => true, 'order' => 5],
                    ['id' => 'wishes', 'name' => 'Buku Tamu & RSVP', 'visible' => true, 'order' => 6],
                    ['id' => 'gift', 'name' => 'Amplop Digital / Hadiah', 'visible' => true, 'order' => 7],
                    ['id' => 'protocol', 'name' => 'Protokol Kesehatan', 'visible' => true, 'order' => 8],
                    ['id' => 'closing', 'name' => 'Kata Penutup & Salam', 'visible' => true, 'order' => 9]
                ]
            ],
            'background' => [
                'pattern' => 'canvas', // 'canvas', 'floral', 'marble', 'clean'
                'pattern_opacity' => 0.08
            ]
        ];
    }

    /**
     * Pustaka Ornamen & Aksesoris SVG
     */
    public static function getOrnaments() {
        return [
            'corners' => [
                ['id' => 'floral-vintage', 'name' => 'Floral Vintage', 'file' => 'assets/ornaments/corners/floral-vintage.svg', 'desc' => 'Sudut sulur mawar klasik bernuansa anggun'],
                ['id' => 'gold-filigree', 'name' => 'Royal Gold Filigree', 'file' => 'assets/ornaments/corners/gold-filigree.svg', 'desc' => 'Ukiran emas baroque khas istana'],
                ['id' => 'botanical-leaves', 'name' => 'Botanical Eucalyptus', 'file' => 'assets/ornaments/corners/botanical-leaves.svg', 'desc' => 'Ranting dedaunan hijau bernuansa rustic alam'],
                ['id' => 'minimal-lines', 'name' => 'Minimalist Geometric', 'file' => 'assets/ornaments/corners/minimal-lines.svg', 'desc' => 'Garis lurus kontemporer modern']
            ],
            'dividers' => [
                ['id' => 'divider-olive', 'name' => 'Olive Branch', 'file' => 'assets/ornaments/dividers/divider-olive.svg', 'desc' => 'Ranting zaitun pembatas bagian yang harmonis'],
                ['id' => 'divider-flourish', 'name' => 'Calligraphy Flourish', 'file' => 'assets/ornaments/dividers/divider-flourish.svg', 'desc' => 'Lengkungan kaligrafi formal berkelas'],
                ['id' => 'divider-floral-heart', 'name' => 'Floral Sweet Heart', 'file' => 'assets/ornaments/dividers/divider-floral-heart.svg', 'desc' => 'Aksen hati romantis berbalut daun'],
                ['id' => 'divider-classic-line', 'name' => 'Classic Diamond Bar', 'file' => 'assets/ornaments/dividers/divider-classic-line.svg', 'desc' => 'Garis minimalis dengan hiasan permata']
            ],
            'frames' => [
                ['id' => 'arch-cathedral', 'name' => 'Cathedral Arch', 'file' => 'assets/ornaments/frames/arch-cathedral.svg', 'desc' => 'Lengkung kubah katedral yang sedang tren'],
                ['id' => 'frame-oval-floral', 'name' => 'Vintage Oval Flower', 'file' => 'assets/ornaments/frames/frame-oval-floral.svg', 'desc' => 'Bingkai oval dengan sentuhan mawar lembut'],
                ['id' => 'frame-geometric', 'name' => 'Modern Octagon', 'file' => 'assets/ornaments/frames/frame-geometric.svg', 'desc' => 'Segi delapan geometris kontemporer'],
                ['id' => 'frame-circle-ring', 'name' => 'Golden Ring Foliage', 'file' => 'assets/ornaments/frames/frame-circle-ring.svg', 'desc' => 'Cincin ganda dengan hiasan dedaunan']
            ],
            'badges' => [
                ['id' => 'wax-seal-burgundy', 'name' => 'Wax Seal Burgundy', 'file' => 'assets/ornaments/badges/wax-seal-burgundy.svg', 'desc' => 'Stempel lilin merah marun eksklusif'],
                ['id' => 'wax-seal-gold', 'name' => 'Royal Gold Seal', 'file' => 'assets/ornaments/badges/wax-seal-gold.svg', 'desc' => 'Stempel lilin emas lambang kemewahan'],
                ['id' => 'monogram-floral-wreath', 'name' => 'Floral Monogram Ring', 'file' => 'assets/ornaments/badges/monogram-floral-wreath.svg', 'desc' => 'Lingkaran karangan bunga untuk inisial nama'],
                ['id' => 'monogram-shield-classic', 'name' => 'Classic Royal Crest', 'file' => 'assets/ornaments/badges/monogram-shield-classic.svg', 'desc' => 'Perisai inisial bermahkota klasik']
            ]
        ];
    }

    /**
     * Palet Warna Kurasi (Curated Color Palettes)
     */
    public static function getColorPalettes() {
        return [
            'nature_classic' => [
                'name' => 'Nature Classic (IndoInvite 79)',
                'primary' => '#928573',
                'secondary' => '#E1D6C7',
                'accent' => '#C5A059',
                'bg_body' => '#FAF7F2',
                'text_dark' => '#2D2D2D'
            ],
            'velvet_teal' => [
                'name' => 'Velvet Forest Teal (Premium 045)',
                'primary' => '#064346',
                'secondary' => '#BF9E9E',
                'accent' => '#472B29',
                'bg_body' => '#F5EEE1',
                'text_dark' => '#1A2926'
            ],
            'royal_gold' => [
                'name' => 'Royal Emperor Gold',
                'primary' => '#C5A059',
                'secondary' => '#F9F5EE',
                'accent' => '#93702B',
                'bg_body' => '#FCFAF7',
                'text_dark' => '#212529'
            ],
            'botanical_sage' => [
                'name' => 'Botanical Sage Green',
                'primary' => '#3D5A45',
                'secondary' => '#E4ECE7',
                'accent' => '#A3B899',
                'bg_body' => '#F4F7F5',
                'text_dark' => '#1D2E22'
            ],
            'romantic_rose' => [
                'name' => 'Romantic Dusty Rose',
                'primary' => '#B76E79',
                'secondary' => '#FCEEF0',
                'accent' => '#8C4C56',
                'bg_body' => '#FFF7F8',
                'text_dark' => '#3B2327'
            ],
            'terracotta_sunset' => [
                'name' => 'Warm Terracotta Sunset',
                'primary' => '#C86446',
                'secondary' => '#FDF5F2',
                'accent' => '#8F3D24',
                'bg_body' => '#FDFBF9',
                'text_dark' => '#331B13'
            ],
            'midnight_navy' => [
                'name' => 'Midnight Sapphire Navy',
                'primary' => '#1A2D42',
                'secondary' => '#E8EEF5',
                'accent' => '#C5A059',
                'bg_body' => '#F6F8FA',
                'text_dark' => '#0E1722'
            ],
            'minimal_monochrome' => [
                'name' => 'Minimalist Black & Cream',
                'primary' => '#222222',
                'secondary' => '#E8E8E8',
                'accent' => '#666666',
                'bg_body' => '#FBFBFB',
                'text_dark' => '#111111'
            ]
        ];
    }

    /**
     * Font Pairing Kurasi
     */
    public static function getFontPairings() {
        return [
            'heading_fonts' => [
                ['name' => 'Great Vibes', 'label' => 'Great Vibes (Cursive Romantis & Mewah)', 'category' => 'cursive'],
                ['name' => 'Alex Brush', 'label' => 'Alex Brush (Kaligrafi Lembut Mengalir)', 'category' => 'cursive'],
                ['name' => 'Playfair Display', 'label' => 'Playfair Display (Serif Elegan Editorial)', 'category' => 'serif'],
                ['name' => 'Cinzel', 'label' => 'Cinzel (Serif Klasik Kerajaan / Roman)', 'category' => 'serif'],
                ['name' => 'Marcellus', 'label' => 'Marcellus (Serif Anggun Berwibawa)', 'category' => 'serif'],
                ['name' => 'Abril Fatface', 'label' => 'Abril Fatface (High Fashion Premium Bold)', 'category' => 'serif'],
                ['name' => 'Sacramento', 'label' => 'Sacramento (Handwritten Bersih Minimalis)', 'category' => 'cursive']
            ],
            'body_fonts' => [
                ['name' => 'Playfair Display', 'label' => 'Playfair Display (Serif Klasik)', 'category' => 'serif'],
                ['name' => 'Plus Jakarta Sans', 'label' => 'Plus Jakarta Sans (Modern Sans Nyaman Dibaca)', 'category' => 'sans-serif'],
                ['name' => 'DM Sans', 'label' => 'DM Sans (Geometric Sans Halus & Rapi)', 'category' => 'sans-serif'],
                ['name' => 'Averia Serif Libre', 'label' => 'Averia Serif Libre (Vintage Hangat Bertekstur)', 'category' => 'serif'],
                ['name' => 'Alata', 'label' => 'Alata (Modern Clean Headings)', 'category' => 'sans-serif']
            ]
        ];
    }

    /**
     * Pilihan Efek Partikel
     */
    public static function getParticleEffects() {
        return [
            ['id' => 'petals', 'name' => 'Kelopak Mawar / Sakura Gugur', 'icon' => '🌸', 'desc' => 'Kelopak bunga berguguran melayang di layar'],
            ['id' => 'leaves', 'name' => 'Daun Hijau Melayang', 'icon' => '🍃', 'desc' => 'Dedaunan hijau berayun sejuk untuk tema rustic'],
            ['id' => 'sparkles', 'name' => 'Kilauan Bintang Emas & Cahaya', 'icon' => '✨', 'desc' => 'Partikel kilau emas berkedip mewah'],
            ['id' => 'snow', 'name' => 'Salju Lembut Berjatuhan', 'icon' => '❄️', 'desc' => 'Butiran salju putih aesthetic dan damai'],
            ['id' => 'fireflies', 'name' => 'Kunang-kunang Malam', 'icon' => '🌟', 'desc' => 'Cahaya lembut berpendar bernuansa magis'],
            ['id' => 'none', 'name' => 'Tanpa Efek Partikel', 'icon' => '🚫', 'desc' => 'Tampilan bersih tanpa animasi partikel di latar']
        ];
    }

    /**
     * Pilihan Efek Transisi Pembuka Undangan (Cover Reveal)
     */
    public static function getCoverTransitions() {
        return [
            ['id' => 'slide_up', 'name' => 'Slide Up Unlock', 'icon' => 'bi-arrow-up-circle', 'desc' => 'Cover bergeser halus ke atas menampilkan isi undangan'],
            ['id' => 'curtain_split', 'name' => 'Curtain Split (Tirai Membuka)', 'icon' => 'bi-door-open', 'desc' => 'Cover membelah ke arah kiri dan kanan'],
            ['id' => 'envelope_3d', 'name' => 'Amplop Virtual Terbuka (3D)', 'icon' => 'bi-envelope-paper-heart', 'desc' => 'Efek tutup amplop membuka mengeluarkan kartu undangan'],
            ['id' => 'fade_out', 'name' => 'Soft Dreamy Fade', 'icon' => 'bi-circle-half', 'desc' => 'Pudaran lembut dengan efek blur sinematik']
        ];
    }

    /**
     * Dapatkan path asset URL dari ID ornamen
     */
    public static function getOrnamentUrl($id, $type = 'corners') {
        $map = [
            'corners' => [
                'floral-vintage' => 'assets/ornaments/corners/floral-vintage.svg',
                'gold-filigree' => 'assets/ornaments/corners/gold-filigree.svg',
                'botanical-leaves' => 'assets/ornaments/corners/botanical-leaves.svg',
                'minimal-lines' => 'assets/ornaments/corners/minimal-lines.svg'
            ],
            'dividers' => [
                'divider-olive' => 'assets/ornaments/dividers/divider-olive.svg',
                'divider-flourish' => 'assets/ornaments/dividers/divider-flourish.svg',
                'divider-floral-heart' => 'assets/ornaments/dividers/divider-floral-heart.svg',
                'divider-classic-line' => 'assets/ornaments/dividers/divider-classic-line.svg'
            ],
            'frames' => [
                'arch-cathedral' => 'assets/ornaments/frames/arch-cathedral.svg',
                'frame-oval-floral' => 'assets/ornaments/frames/frame-oval-floral.svg',
                'frame-geometric' => 'assets/ornaments/frames/frame-geometric.svg',
                'frame-circle-ring' => 'assets/ornaments/frames/frame-circle-ring.svg'
            ],
            'badges' => [
                'wax-seal-burgundy' => 'assets/ornaments/badges/wax-seal-burgundy.svg',
                'wax-seal-gold' => 'assets/ornaments/badges/wax-seal-gold.svg',
                'monogram-floral-wreath' => 'assets/ornaments/badges/monogram-floral-wreath.svg',
                'monogram-shield-classic' => 'assets/ornaments/badges/monogram-shield-classic.svg'
            ]
        ];

        $rel = $map[$type][$id] ?? null;
        return $rel ? base_url($rel) : null;
    }

    /**
     * Render Link Tag Google Fonts secara Dinamis
     */
    public static function renderGoogleFontsTags($typography = []) {
        $heading = $typography['font_heading'] ?? 'Great Vibes';
        $body = $typography['font_body'] ?? 'Playfair Display';
        $accent = $typography['font_accent'] ?? 'Marcellus';

        $fonts = array_unique(array_filter([$heading, $body, $accent]));
        $queries = [];
        foreach ($fonts as $f) {
            $queries[] = 'family=' . str_replace(' ', '+', $f) . ':wght@300;400;600;700';
        }

        $url = 'https://fonts.googleapis.com/css2?' . implode('&', $queries) . '&display=swap';
        return '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n" .
               '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n" .
               '<link href="' . htmlspecialchars($url) . '" rel="stylesheet">' . "\n";
    }

    /**
     * Merge Konfigurasi Simpanan dengan Default
     */
    public static function parseConfig($jsonString) {
        $default = self::getDefaultConfig();
        if (empty($jsonString)) return $default;

        $parsed = is_array($jsonString) ? $jsonString : json_decode($jsonString, true);
        if (!is_array($parsed)) return $default;

        // Recursive merge
        return array_replace_recursive($default, $parsed);
    }
}
