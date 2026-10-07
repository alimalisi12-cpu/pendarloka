<?php
// views/dashboard/builder.php
// Visual Live Builder (WYSIWYG) Interaktif & Responsif Pendar Loka

$pageTitle = "Live Builder - " . ($event['title'] ?: 'Undangan Digital');
$elementStyles = $themeConfig['element_styles'] ?? [];
$loveStory = json_decode($event['love_story_json'] ?? '[]', true) ?: [];
$gallery = json_decode($event['gallery_json'] ?? '[]', true) ?: [];
$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$schedules = json_decode($event['events_schedule_json'] ?? '[]', true) ?: [];

// Fallback schedule jika kosong
if (empty($schedules)) {
    $schedules = [
        [
            'name' => 'Akad Nikah / Pemberkatan',
            'date' => $event['event_date'],
            'time' => $event['akad_time'] ?: '08:00 - 10:00 WIB',
            'place' => $event['akad_location'] ?: 'Masjid Agung / Gedung Utama',
            'address' => $event['akad_location'] ?: 'Jl. Utama Kota No. 1'
        ],
        [
            'name' => 'Resepsi Pernikahan',
            'date' => $event['event_date'],
            'time' => $event['resepsi_time'] ?: '11:00 - 14:00 WIB',
            'place' => $event['resepsi_location'] ?: 'Grand Ballroom Hotel',
            'address' => $event['resepsi_location'] ?: 'Jl. Utama Kota No. 1'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    
    <!-- Dynamic Favicon -->
    <?php $favUrl = site_favicon_url(); ?>
    <link rel="icon" href="<?= htmlspecialchars($favUrl ?: 'https://cdn-icons-png.flaticon.com/512/833/833472.png') ?>" type="image/png">

    <!-- Google Fonts & Bootstrap 5 & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --builder-bg: #1c2328;
            --builder-surface: #242e34;
            --builder-border: #35424b;
            --builder-gold: #ffb700;
            --builder-gold-hover: #e0a200;
            --builder-accent: #03bb16;
            --builder-accent-hover: #029912;
            --builder-text: #f7f9fa;
            --builder-muted: #9baab3;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--builder-bg);
            color: var(--builder-text);
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar Builder */
        .builder-topbar {
            height: 64px;
            background-color: var(--builder-surface);
            border-bottom: 1px solid var(--builder-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 1050;
            flex-shrink: 0;
        }

        .btn-back-dashboard {
            background-color: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.15);
            font-weight: 600;
            font-size: 13px;
            padding: 7px 16px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        .btn-back-dashboard:hover {
            background-color: rgba(255, 255, 255, 0.16);
            color: #ffffff;
            transform: translateX(-2px);
        }

        .builder-title-badge {
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .device-switcher {
            background-color: rgba(0, 0, 0, 0.25);
            padding: 3px;
            border-radius: 20px;
            display: inline-flex;
            gap: 2px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .device-btn {
            background: transparent;
            border: none;
            color: var(--builder-muted);
            padding: 5px 12px;
            border-radius: 16px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .device-btn.active, .device-btn:hover {
            background-color: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .btn-save-global {
            background-color: var(--builder-accent);
            color: #ffffff;
            border: none;
            font-weight: 700;
            font-size: 14px;
            padding: 8px 24px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(3, 187, 22, 0.35);
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .btn-save-global:hover {
            background-color: var(--builder-accent-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(3, 187, 22, 0.5);
        }

        /* Workspace & Canvas Simulator */
        .builder-workspace {
            flex-grow: 1;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at center, #27333b 0%, #171d22 100%);
            overflow: hidden;
            padding: 20px;
        }

        .phone-frame-wrapper {
            position: relative;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            max-height: calc(100vh - 120px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Smartphone Frame Mockup */
        .phone-mockup {
            width: 420px;
            height: calc(100vh - 125px);
            max-height: 860px;
            min-height: 580px;
            background-color: #000000;
            border: 10px solid #282e33;
            border-radius: 46px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.65), 0 0 0 1px rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
        }

        .phone-notch {
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 20px;
            background-color: #1a1e22;
            border-radius: 20px;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            pointer-events: none;
        }
        .phone-notch .lens {
            width: 8px;
            height: 8px;
            background-color: #0b0d0e;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .phone-screen {
            flex-grow: 1;
            width: 100%;
            height: 100%;
            position: relative;
            background-color: #ffffff;
            overflow: hidden;
        }

        .phone-screen iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
        }

        /* Bottom Floating Dock / Toolbar (Sesuai Gambar 1) */
        .builder-bottom-dock {
            position: absolute;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(30, 39, 45, 0.94);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 40px;
            padding: 6px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.45);
            z-index: 1040;
        }

        .dock-item {
            background: transparent;
            border: none;
            color: var(--builder-muted);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            padding: 6px 14px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .dock-item i {
            font-size: 18px;
        }
        .dock-item:hover, .dock-item.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.09);
        }
        .dock-item.highlight {
            color: var(--builder-gold);
        }

        /* Universal Click-to-Edit Modal (Sesuai Gambar 2 & 3) */
        .builder-modal-dialog {
            max-width: 460px;
            margin: 1.75rem auto;
        }
        .builder-modal-content {
            background-color: #ffffff;
            color: #17242a;
            border-radius: 24px;
            border: none;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
            overflow: hidden;
        }

        .builder-modal-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f0f2f4;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .builder-modal-header h5 {
            font-size: 18px;
            font-weight: 800;
            margin: 0;
            color: #17242a;
        }

        .builder-modal-tabs {
            display: flex;
            border-bottom: 1px solid #e9ecef;
            background-color: #fbfbfb;
            padding: 0 24px;
        }
        .builder-modal-tab {
            flex: 1;
            text-align: center;
            padding: 12px 0;
            font-weight: 700;
            font-size: 14px;
            color: #6c757d;
            border: none;
            background: transparent;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .builder-modal-tab.active {
            color: #17242a;
            border-bottom-color: var(--builder-gold);
        }

        .builder-modal-body {
            padding: 24px;
            max-height: 65vh;
            overflow-y: auto;
        }

        /* 4-Box Margin & Padding Grid (Sesuai Gambar 3) */
        .quad-input-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }
        .quad-input-item {
            text-align: center;
        }
        .quad-input-item label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 4px;
        }
        .quad-input-item input {
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 4px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            width: 100%;
        }

        .btn-modal-save {
            background-color: var(--builder-gold);
            color: #17242a;
            font-weight: 700;
            font-size: 15px;
            border: none;
            border-radius: 30px;
            padding: 12px;
            width: 100%;
            transition: all 0.2s;
            margin-top: 18px;
        }
        .btn-modal-save:hover {
            background-color: var(--builder-gold-hover);
        }

        .toast-container-custom {
            position: fixed;
            top: 80px;
            right: 24px;
            z-index: 99999;
        }

        /* Quick Drawer Menu */
        .drawer-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1060;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }
        .drawer-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }
        .quick-drawer {
            position: fixed;
            top: 0;
            left: -340px;
            width: 320px;
            height: 100vh;
            background-color: #ffffff;
            color: #17242a;
            z-index: 1070;
            box-shadow: 5px 0 25px rgba(0,0,0,0.3);
            transition: left 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
        }
        .quick-drawer.show {
            left: 0;
        }
        .drawer-header {
            padding: 18px 20px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .drawer-body {
            padding: 15px;
            overflow-y: auto;
            flex-grow: 1;
        }
        .drawer-section-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid #edf1f4;
            background-color: #f8fafc;
            color: #17242a;
            text-align: left;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
            cursor: pointer;
        }
        .drawer-section-btn:hover {
            background-color: #f0f4f8;
            border-color: var(--builder-gold);
            transform: translateX(3px);
        }
        .drawer-section-btn i {
            font-size: 18px;
            color: #d5a84a;
        }
    </style>
</head>
<body>

    <!-- TOPBAR BUILDER -->
    <header class="builder-topbar">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('dashboard') ?>" class="btn-back-dashboard">
                <i class="bi bi-chevron-left me-1"></i> Dashboard
            </a>
            <div class="builder-title-badge d-none d-md-flex">
                <span><?= htmlspecialchars($event['title']) ?></span>
                <span class="badge bg-warning text-dark px-2 py-1 rounded-pill fw-bold" style="font-size: 11px;">
                    <?= htmlspecialchars($event['template_name']) ?>
                </span>
            </div>
        </div>

        <!-- Device Responsive Switcher -->
        <div class="device-switcher d-none d-sm-inline-flex">
            <button type="button" class="device-btn active" id="btn-view-mobile" onclick="setDeviceView('mobile')">
                <i class="bi bi-phone me-1"></i> Mobile
            </button>
            <button type="button" class="device-btn" id="btn-view-tablet" onclick="setDeviceView('tablet')">
                <i class="bi bi-tablet me-1"></i> Tablet
            </button>
            <button type="button" class="device-btn" id="btn-view-desktop" onclick="setDeviceView('desktop')">
                <i class="bi bi-laptop me-1"></i> Desktop
            </button>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('u/' . $event['slug']) ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-pill px-3 py-1 fw-bold text-nowrap" title="Buka Pratinjau Penuh di Tab Baru">
                <i class="bi bi-box-arrow-up-right me-1"></i> <span class="d-none d-lg-inline">Lihat Web</span>
            </a>
            <button type="button" class="btn-save-global" id="btn-save-global" onclick="saveBuilderGlobal()">
                <i class="bi bi-floppy2-fill"></i>
                <span id="btn-save-text">Simpan</span>
            </button>
        </div>
    </header>

    <!-- WORKSPACE & CANVAS -->
    <main class="builder-workspace">
        <div class="phone-frame-wrapper" id="frameWrapper">
            <div class="phone-mockup" id="phoneMockup">
                <!-- Phone Notch -->
                <div class="phone-notch">
                    <div class="lens"></div>
                </div>

                <!-- Phone Live Screen Frame -->
                <div class="phone-screen">
                    <iframe id="livePreviewIframe" src="<?= base_url('u/' . $event['slug'] . '?builder=1') ?>" title="Live Invitation Preview"></iframe>
                </div>
            </div>
        </div>

        <!-- FLOATING BOTTOM TOOLBAR (Gambar 1) -->
        <nav class="builder-bottom-dock">
            <button type="button" class="dock-item" onclick="toggleDrawer(true)">
                <i class="bi bi-grid-fill"></i>
                <span>Menu</span>
            </button>
            <button type="button" class="dock-item" onclick="openSettingsModal()">
                <i class="bi bi-sliders"></i>
                <span>Pengaturan</span>
            </button>
            <button type="button" class="dock-item highlight" onclick="openFullscreenPreview()">
                <i class="bi bi-eye-fill"></i>
                <span>Pratinjau</span>
            </button>
            <button type="button" class="dock-item" onclick="openActivationModal()">
                <i class="bi bi-shield-check"></i>
                <span>Aktivasi</span>
            </button>
            <button type="button" class="dock-item" onclick="openShareModal()">
                <i class="bi bi-share-fill"></i>
                <span>Sebar</span>
            </button>
        </nav>
    </main>

    <!-- QUICK DRAWER MENU (Laci Bagian Undangan) -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleDrawer(false)"></div>
    <div class="quick-drawer" id="quickDrawer">
        <div class="drawer-header">
            <h6 class="fw-bold m-0"><i class="bi bi-layers-half text-warning me-2"></i>Bagian Undangan</h6>
            <button type="button" class="btn-close" onclick="toggleDrawer(false)"></button>
        </div>
        <div class="drawer-body">
            <button type="button" class="drawer-section-btn" onclick="openModalForSection('title', 'Nama Acara')">
                <i class="bi bi-type-h1"></i>
                <div>
                    <div>Nama Acara & Judul</div>
                    <small class="text-muted">Ubah nama acara dan judul utama</small>
                </div>
            </button>
            <button type="button" class="drawer-section-btn" onclick="openModalForSection('couple', 'Mempelai Pria & Wanita')">
                <i class="bi bi-heart-fill"></i>
                <div>
                    <div>Mempelai Pria & Wanita</div>
                    <small class="text-muted">Nama, orang tua, foto, instagram</small>
                </div>
            </button>
            <button type="button" class="drawer-section-btn" onclick="openModalForSection('cover', 'Foto Sampul & Background')">
                <i class="bi bi-image-fill"></i>
                <div>
                    <div>Foto Sampul & Cover</div>
                    <small class="text-muted">Ganti foto pembuka & sampul</small>
                </div>
            </button>
            <button type="button" class="drawer-section-btn" onclick="openModalForSection('quote', 'Kutipan / Doa')">
                <i class="bi bi-quote"></i>
                <div>
                    <div>Kutipan & Doa</div>
                    <small class="text-muted">Ayat suci / kata mutiara</small>
                </div>
            </button>
            <button type="button" class="drawer-section-btn" onclick="openModalForSection('schedule', 'Waktu & Lokasi Acara')">
                <i class="bi bi-calendar2-week-fill"></i>
                <div>
                    <div>Waktu & Lokasi Acara</div>
                    <small class="text-muted">Akad, resepsi, peta lokasi</small>
                </div>
            </button>
            <button type="button" class="drawer-section-btn" onclick="openModalForSection('story', 'Kisah Cinta (Love Story)')">
                <i class="bi bi-clock-history"></i>
                <div>
                    <div>Perjalanan Cinta</div>
                    <small class="text-muted">Cerita kenangan & momen indah</small>
                </div>
            </button>
            <button type="button" class="drawer-section-btn" onclick="openModalForSection('gallery', 'Galeri Foto')">
                <i class="bi bi-images"></i>
                <div>
                    <div>Galeri Foto</div>
                    <small class="text-muted">Koleksi foto pre-wedding</small>
                </div>
            </button>
            <button type="button" class="drawer-section-btn" onclick="openModalForSection('gift', 'Amplop Digital & Rekening')">
                <i class="bi bi-gift-fill"></i>
                <div>
                    <div>Amplop Digital & Kado</div>
                    <small class="text-muted">Nomor rekening & alamat kado</small>
                </div>
            </button>
            <button type="button" class="drawer-section-btn" onclick="openModalForSection('music', 'Musik Latar')">
                <i class="bi bi-music-note-beamed"></i>
                <div>
                    <div>Musik & Lagu Latar</div>
                    <small class="text-muted">Pilih lagu latar romantis</small>
                </div>
            </button>
        </div>
    </div>

    <!-- UNIVERSAL CLICK-TO-EDIT MODAL (Gambar 2 & 3) -->
    <div class="modal fade" id="builderEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog builder-modal-dialog modal-dialog-centered">
            <div class="modal-content builder-modal-content">
                <!-- Modal Header -->
                <div class="builder-modal-header">
                    <h5 id="modalSectionTitle">Nama Acara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Tabs: Data | Style -->
                <div class="builder-modal-tabs">
                    <button type="button" class="builder-modal-tab active" id="tabBtnData" onclick="switchModalTab('data')">
                        Data
                    </button>
                    <button type="button" class="builder-modal-tab" id="tabBtnStyle" onclick="switchModalTab('style')">
                        Style
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="builder-modal-body">
                    <!-- TAB DATA CONTAINER -->
                    <div id="tabContentData">
                        <!-- Dynamic Section Forms rendered via JavaScript -->
                        <div id="dynamicFormFields"></div>
                        <button type="button" class="btn-modal-save" onclick="applyModalData()">
                            Simpan
                        </button>
                    </div>

                    <!-- TAB STYLE CONTAINER (Gambar 3) -->
                    <div id="tabContentStyle" style="display: none;">
                        <!-- Margin 4-Box -->
                        <div class="mb-4">
                            <label class="fw-bold fs-6 mb-2 d-block">Margin (px)</label>
                            <div class="quad-input-grid">
                                <div class="quad-input-item">
                                    <label>Atas</label>
                                    <input type="number" id="styleMarginTop" placeholder="0" class="form-control">
                                </div>
                                <div class="quad-input-item">
                                    <label>Bawah</label>
                                    <input type="number" id="styleMarginBottom" placeholder="0" class="form-control">
                                </div>
                                <div class="quad-input-item">
                                    <label>Kiri</label>
                                    <input type="number" id="styleMarginLeft" placeholder="0" class="form-control">
                                </div>
                                <div class="quad-input-item">
                                    <label>Kanan</label>
                                    <input type="number" id="styleMarginRight" placeholder="0" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Padding 4-Box -->
                        <div class="mb-4">
                            <label class="fw-bold fs-6 mb-2 d-block">Padding (px)</label>
                            <div class="quad-input-grid">
                                <div class="quad-input-item">
                                    <label>Atas</label>
                                    <input type="number" id="stylePaddingTop" placeholder="0" class="form-control">
                                </div>
                                <div class="quad-input-item">
                                    <label>Bawah</label>
                                    <input type="number" id="stylePaddingBottom" placeholder="0" class="form-control">
                                </div>
                                <div class="quad-input-item">
                                    <label>Kiri</label>
                                    <input type="number" id="stylePaddingLeft" placeholder="0" class="form-control">
                                </div>
                                <div class="quad-input-item">
                                    <label>Kanan</label>
                                    <input type="number" id="stylePaddingRight" placeholder="0" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Advance Setting Collapsible -->
                        <div class="border rounded-3 p-3 mb-3 bg-light">
                            <a class="d-flex justify-content-between align-items-center text-decoration-none text-dark fw-bold" data-bs-toggle="collapse" href="#collapseAdvance" role="button">
                                <span><i class="bi bi-gear-fill me-1 text-warning"></i> Advance Setting</span>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <div class="collapse mt-3" id="collapseAdvance">
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted">Ukuran Font</label>
                                    <input type="text" id="styleFontSize" placeholder="contoh: 24px atau 1.5rem" class="form-control form-control-sm">
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted">Warna Teks</label>
                                        <div class="d-flex gap-2">
                                            <input type="color" id="styleColorPicker" class="form-control form-control-color form-control-sm" onchange="document.getElementById('styleColorText').value = this.value">
                                            <input type="text" id="styleColorText" placeholder="#ffffff" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted">Warna Latar</label>
                                        <div class="d-flex gap-2">
                                            <input type="color" id="styleBgPicker" class="form-control form-control-color form-control-sm" onchange="document.getElementById('styleBgText').value = this.value">
                                            <input type="text" id="styleBgText" placeholder="transparent" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="small fw-bold text-muted">Perataan Teks</label>
                                    <div class="btn-group w-100" role="group">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setTextAlign('left')"><i class="bi bi-text-left"></i> Kiri</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setTextAlign('center')"><i class="bi bi-text-center"></i> Tengah</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setTextAlign('right')"><i class="bi bi-text-right"></i> Kanan</button>
                                    </div>
                                    <input type="hidden" id="styleTextAlign" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Reset Link -->
                        <div class="text-center my-2">
                            <button type="button" class="btn btn-link text-danger text-decoration-none small fw-bold" onclick="resetCurrentSectionStyle()">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset Semua Style
                            </button>
                        </div>

                        <button type="button" class="btn-modal-save" onclick="applyModalData()">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SETTINGS MODAL -->
    <div class="modal fade" id="builderSettingsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content builder-modal-content">
                <div class="builder-modal-header">
                    <h5>Pengaturan Tema & Musik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="p-4">
                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Ganti Template Desain</label>
                        <select class="form-select" id="settingTemplateId">
                            <?php foreach ($templates as $t): ?>
                                <option value="<?= $t['id'] ?>" <?= $t['id'] == $event['template_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($t['name']) ?> (<?= $t['category_name'] ?? 'Pernikahan' ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Warna Aksen Utama</label>
                        <input type="color" id="settingPrimaryColor" value="<?= htmlspecialchars($themeConfig['primary_color'] ?? '#ff9c1f') ?>" class="form-control form-control-color">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Lagu / Musik Latar (URL Audio)</label>
                        <input type="text" id="settingMusicUrl" value="<?= htmlspecialchars($event['music_url'] ?? '') ?>" class="form-control" placeholder="https://domain.com/lagu.mp3">
                    </div>
                    <button type="button" class="btn-modal-save" onclick="saveSettingsModal()">
                        Terapkan Pengaturan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ACTIVATION MODAL -->
    <div class="modal fade" id="builderActivationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content builder-modal-content">
                <div class="builder-modal-header">
                    <h5>Status Publikasi Undangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="p-4 text-center">
                    <p class="text-muted small mb-3">Pilih apakah undangan ini aktif dapat diakses publik atau masih dalam status draf.</p>
                    <div class="btn-group w-100 mb-4" role="group">
                        <input type="radio" class="btn-check" name="statusOption" id="statusActive" value="published" <?= $event['status'] === 'published' ? 'checked' : '' ?>>
                        <label class="btn btn-outline-success py-2 fw-bold" for="statusActive">
                            <i class="bi bi-check-circle-fill me-1"></i> Publik (Aktif)
                        </label>
                        <input type="radio" class="btn-check" name="statusOption" id="statusDraft" value="draft" <?= $event['status'] === 'draft' ? 'checked' : '' ?>>
                        <label class="btn btn-outline-secondary py-2 fw-bold" for="statusDraft">
                            <i class="bi bi-pause-circle-fill me-1"></i> Draf (Privat)
                        </label>
                    </div>
                    <button type="button" class="btn-modal-save" onclick="saveActivationModal()">
                        Simpan Status
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- SHARE MODAL -->
    <div class="modal fade" id="builderShareModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content builder-modal-content">
                <div class="builder-modal-header">
                    <h5>Sebar Undangan Digital</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="p-4">
                    <p class="text-muted small">Salin link undangan untuk dibagikan ke teman dan keluarga:</p>
                    <div class="input-group mb-3">
                        <input type="text" id="shareLinkInput" class="form-control" value="<?= base_url('u/' . $event['slug']) ?>" readonly>
                        <button class="btn btn-warning fw-bold" type="button" onclick="copyShareLink()">
                            <i class="bi bi-clipboard"></i> Salin
                        </button>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="https://api.whatsapp.com/send?text=Halo!%20Kami%20mengundang%20Anda%20ke%20pernikahan%20kami:%20<?= urlencode(base_url('u/' . $event['slug'])) ?>" target="_blank" class="btn btn-success fw-bold py-2 rounded-pill">
                            <i class="bi bi-whatsapp me-2"></i> Bagikan ke WhatsApp
                        </a>
                        <a href="<?= base_url('dashboard/guests/' . $event['id']) ?>" class="btn btn-outline-dark fw-bold py-2 rounded-pill">
                            <i class="bi bi-people me-2"></i> Kelola Nama Buku Tamu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FLOATING TOAST -->
    <div class="toast-container toast-container-custom">
        <div id="builderToast" class="toast align-items-center text-white bg-dark border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill text-warning fs-5"></i>
                    <span id="toastMessage">Perubahan sementara disimpan di pratinjau!</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT STATE & ENGINE -->
    <script>
        // In-Memory Global State
        const eventId = <?= (int)$event['id'] ?>;
        const ajaxSaveUrl = '<?= base_url('dashboard/ajax-save-builder/' . $event['id']) ?>';
        
        let stateData = {
            title: <?= json_encode($event['title']) ?>,
            event_date: <?= json_encode($event['event_date']) ?>,
            template_id: <?= (int)$event['template_id'] ?>,
            music_url: <?= json_encode($event['music_url'] ?? '') ?>,
            status: <?= json_encode($event['status'] ?? 'published') ?>,
            primary_color: <?= json_encode($themeConfig['primary_color'] ?? '#ff9c1f') ?>,
            
            groom_name: <?= json_encode($event['groom_name'] ?? '') ?>,
            groom_nickname: <?= json_encode($event['groom_nickname'] ?? '') ?>,
            groom_parents: <?= json_encode($event['groom_parents'] ?? '') ?>,
            groom_instagram: <?= json_encode($event['groom_instagram'] ?? '') ?>,
            groom_photo: <?= json_encode($event['groom_photo'] ?? '') ?>,
            
            bride_name: <?= json_encode($event['bride_name'] ?? '') ?>,
            bride_nickname: <?= json_encode($event['bride_nickname'] ?? '') ?>,
            bride_parents: <?= json_encode($event['bride_parents'] ?? '') ?>,
            bride_instagram: <?= json_encode($event['bride_instagram'] ?? '') ?>,
            bride_photo: <?= json_encode($event['bride_photo'] ?? '') ?>,
            
            cover_photo: <?= json_encode($event['cover_photo'] ?? '') ?>,
            hero_photo: <?= json_encode($event['hero_photo'] ?? '') ?>,
            bg_photo: <?= json_encode($event['bg_photo'] ?? '') ?>,
            quote: <?= json_encode($event['quote'] ?? '') ?>,
            
            akad_time: <?= json_encode($event['akad_time'] ?? '') ?>,
            akad_location: <?= json_encode($event['akad_location'] ?? '') ?>,
            resepsi_time: <?= json_encode($event['resepsi_time'] ?? '') ?>,
            resepsi_location: <?= json_encode($event['resepsi_location'] ?? '') ?>,
            maps_url: <?= json_encode($event['maps_url'] ?? '') ?>,
            gift_address: <?= json_encode($event['gift_address'] ?? '') ?>,
            
            events_schedule: <?= json_encode($schedules) ?>,
            love_story: <?= json_encode($loveStory) ?>,
            gallery: <?= json_encode($gallery) ?>,
            bank_accounts: <?= json_encode($bankAccounts) ?>,
            element_styles: <?= json_encode($elementStyles) ?>
        };

        let currentActiveSection = 'title';
        const editModal = new bootstrap.Modal(document.getElementById('builderEditModal'));
        const settingsModal = new bootstrap.Modal(document.getElementById('builderSettingsModal'));
        const activationModal = new bootstrap.Modal(document.getElementById('builderActivationModal'));
        const shareModal = new bootstrap.Modal(document.getElementById('builderShareModal'));

        // Device Switcher Handler
        function setDeviceView(type) {
            document.querySelectorAll('.device-btn').forEach(b => b.classList.remove('active'));
            const mockup = document.getElementById('phoneMockup');
            
            if (type === 'mobile') {
                document.getElementById('btn-view-mobile').classList.add('active');
                mockup.style.width = '420px';
                mockup.style.borderRadius = '46px';
                mockup.style.borderWidth = '10px';
            } else if (type === 'tablet') {
                document.getElementById('btn-view-tablet').classList.add('active');
                mockup.style.width = '740px';
                mockup.style.borderRadius = '24px';
                mockup.style.borderWidth = '8px';
            } else if (type === 'desktop') {
                document.getElementById('btn-view-desktop').classList.add('active');
                mockup.style.width = '960px';
                mockup.style.borderRadius = '16px';
                mockup.style.borderWidth = '6px';
            }
        }

        // Drawer Controls
        function toggleDrawer(show) {
            const drawer = document.getElementById('quickDrawer');
            const overlay = document.getElementById('drawerOverlay');
            if (show) {
                drawer.classList.add('show');
                overlay.classList.add('show');
            } else {
                drawer.classList.remove('show');
                overlay.classList.remove('show');
            }
        }

        // Modal Tab Switching
        function switchModalTab(tabName) {
            const tabBtnData = document.getElementById('tabBtnData');
            const tabBtnStyle = document.getElementById('tabBtnStyle');
            const contentData = document.getElementById('tabContentData');
            const contentStyle = document.getElementById('tabContentStyle');

            if (tabName === 'data') {
                tabBtnData.classList.add('active');
                tabBtnStyle.classList.remove('active');
                contentData.style.display = 'block';
                contentStyle.style.display = 'none';
            } else {
                tabBtnStyle.classList.add('active');
                tabBtnData.classList.remove('active');
                contentData.style.display = 'none';
                contentStyle.style.display = 'block';
            }
        }

        // Buka Modal Edit Spesifik Bagian
        function openModalForSection(sectionKey, titleLabel) {
            toggleDrawer(false);
            currentActiveSection = sectionKey;
            document.getElementById('modalSectionTitle').textContent = titleLabel || 'Edit Bagian';

            // Reset tab ke Data
            switchModalTab('data');

            // Render Form Fields Dinamis
            renderFormFieldsForSection(sectionKey);

            // Muat Style Saat Ini ke Tab Style
            loadCurrentStyles(sectionKey);

            editModal.show();
        }

        // Render Form Dinamis sesuai Section
        function renderFormFieldsForSection(key) {
            const container = document.getElementById('dynamicFormFields');
            container.innerHTML = '';

            if (key === 'title') {
                container.innerHTML = `
                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Nama Acara / Judul Undangan</label>
                        <input type="text" id="input_title" class="form-control" value="${escapeHtml(stateData.title || '')}" placeholder="Contoh: The Wedding of Budi & Siti">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Tanggal Acara</label>
                        <input type="date" id="input_event_date" class="form-control" value="${stateData.event_date || ''}">
                    </div>
                `;
            } else if (key === 'cover') {
                container.innerHTML = `
                    <div class="mb-3">
                        <label class="fw-bold small mb-1">URL Foto Sampul (Cover Image)</label>
                        <input type="text" id="input_cover_photo" class="form-control" value="${escapeHtml(stateData.cover_photo || '')}" placeholder="https://...">
                        <small class="text-muted">Masukkan link foto portrait atau unggah foto</small>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold small mb-1">URL Foto Hero / Background</label>
                        <input type="text" id="input_bg_photo" class="form-control" value="${escapeHtml(stateData.bg_photo || '')}" placeholder="https://...">
                    </div>
                `;
            } else if (key === 'couple') {
                container.innerHTML = `
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <h6 class="fw-bold text-primary mb-2"><i class="bi bi-gender-male me-1"></i> Mempelai Pria</h6>
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Panggilan</label>
                            <input type="text" id="input_groom_nickname" class="form-control form-control-sm" value="${escapeHtml(stateData.groom_nickname || '')}">
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Lengkap & Gelar</label>
                            <input type="text" id="input_groom_name" class="form-control form-control-sm" value="${escapeHtml(stateData.groom_name || '')}">
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Orang Tua</label>
                            <input type="text" id="input_groom_parents" class="form-control form-control-sm" value="${escapeHtml(stateData.groom_parents || '')}">
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Instagram (opsional)</label>
                            <input type="text" id="input_groom_instagram" class="form-control form-control-sm" value="${escapeHtml(stateData.groom_instagram || '')}" placeholder="@username">
                        </div>
                        <div>
                            <label class="small fw-bold">Foto Mempelai Pria (URL)</label>
                            <input type="text" id="input_groom_photo" class="form-control form-control-sm" value="${escapeHtml(stateData.groom_photo || '')}">
                        </div>
                    </div>
                    <div class="p-3 bg-light rounded-3 mb-2 border">
                        <h6 class="fw-bold text-danger mb-2"><i class="bi bi-gender-female me-1"></i> Mempelai Wanita</h6>
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Panggilan</label>
                            <input type="text" id="input_bride_nickname" class="form-control form-control-sm" value="${escapeHtml(stateData.bride_nickname || '')}">
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Lengkap & Gelar</label>
                            <input type="text" id="input_bride_name" class="form-control form-control-sm" value="${escapeHtml(stateData.bride_name || '')}">
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Orang Tua</label>
                            <input type="text" id="input_bride_parents" class="form-control form-control-sm" value="${escapeHtml(stateData.bride_parents || '')}">
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Instagram (opsional)</label>
                            <input type="text" id="input_bride_instagram" class="form-control form-control-sm" value="${escapeHtml(stateData.bride_instagram || '')}" placeholder="@username">
                        </div>
                        <div>
                            <label class="small fw-bold">Foto Mempelai Wanita (URL)</label>
                            <input type="text" id="input_bride_photo" class="form-control form-control-sm" value="${escapeHtml(stateData.bride_photo || '')}">
                        </div>
                    </div>
                `;
            } else if (key === 'quote') {
                container.innerHTML = `
                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Isi Kutipan / Ayat Suci / Kata Mutiara</label>
                        <textarea id="input_quote" class="form-control" rows="5">${escapeHtml(stateData.quote || '')}</textarea>
                    </div>
                `;
            } else if (key === 'schedule') {
                container.innerHTML = `
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <h6 class="fw-bold text-dark mb-2">Sesi 1: Akad Nikah / Pemberkatan</h6>
                        <div class="mb-2">
                            <label class="small fw-bold">Waktu Acara</label>
                            <input type="text" id="input_akad_time" class="form-control form-control-sm" value="${escapeHtml(stateData.akad_time || '')}" placeholder="08.00 - 10.00 WIB">
                        </div>
                        <div>
                            <label class="small fw-bold">Tempat & Alamat</label>
                            <input type="text" id="input_akad_location" class="form-control form-control-sm" value="${escapeHtml(stateData.akad_location || '')}" placeholder="Masjid Agung / Gereja...">
                        </div>
                    </div>
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <h6 class="fw-bold text-dark mb-2">Sesi 2: Resepsi Pernikahan</h6>
                        <div class="mb-2">
                            <label class="small fw-bold">Waktu Acara</label>
                            <input type="text" id="input_resepsi_time" class="form-control form-control-sm" value="${escapeHtml(stateData.resepsi_time || '')}" placeholder="11.00 - 14.00 WIB">
                        </div>
                        <div>
                            <label class="small fw-bold">Tempat & Alamat</label>
                            <input type="text" id="input_resepsi_location" class="form-control form-control-sm" value="${escapeHtml(stateData.resepsi_location || '')}" placeholder="Ballroom Hotel...">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="small fw-bold">Link Google Maps</label>
                        <input type="text" id="input_maps_url" class="form-control form-control-sm" value="${escapeHtml(stateData.maps_url || '')}" placeholder="https://maps.app.goo.gl/...">
                    </div>
                `;
            } else if (key === 'story') {
                let storyHtml = '<div id="storyItemsContainer">';
                stateData.love_story.forEach((st, idx) => {
                    storyHtml += `
                        <div class="border rounded-3 p-3 mb-2 bg-light position-relative" id="story_row_${idx}">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-warning text-dark fw-bold">Cerita #${idx + 1}</span>
                                <button type="button" class="btn btn-sm text-danger p-0 border-0" onclick="removeStoryItem(${idx})"><i class="bi bi-trash"></i></button>
                            </div>
                            <input type="text" class="form-control form-control-sm mb-2" id="story_title_${idx}" value="${escapeHtml(st.title || '')}" placeholder="Judul (Pertama Bertemu)">
                            <input type="text" class="form-control form-control-sm mb-2" id="story_year_${idx}" value="${escapeHtml(st.year || st.date || '')}" placeholder="Tahun / Tanggal (2020)">
                            <textarea class="form-control form-control-sm" id="story_desc_${idx}" rows="2" placeholder="Kisah kenangan...">${escapeHtml(st.desc || st.story || '')}</textarea>
                        </div>
                    `;
                });
                storyHtml += '</div>';
                storyHtml += `<button type="button" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2" onclick="addStoryItem()"><i class="bi bi-plus-circle me-1"></i> Tambah Momen Cinta</button>`;
                container.innerHTML = storyHtml;
            } else if (key === 'gallery') {
                let galHtml = '<div id="galleryItemsContainer">';
                stateData.gallery.forEach((gUrl, idx) => {
                    galHtml += `
                        <div class="d-flex gap-2 mb-2" id="gal_row_${idx}">
                            <input type="text" class="form-control form-control-sm" id="gal_url_${idx}" value="${escapeHtml(gUrl)}" placeholder="https://...">
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeGalleryItem(${idx})"><i class="bi bi-trash"></i></button>
                        </div>
                    `;
                });
                galHtml += '</div>';
                galHtml += `<button type="button" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2" onclick="addGalleryItem()"><i class="bi bi-plus-circle me-1"></i> Tambah Foto Galeri</button>`;
                container.innerHTML = galHtml;
            } else if (key === 'gift') {
                let bankHtml = '<div id="bankItemsContainer">';
                stateData.bank_accounts.forEach((bk, idx) => {
                    bankHtml += `
                        <div class="border rounded-3 p-3 mb-2 bg-light" id="bank_row_${idx}">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-success fw-bold">Rekening #${idx + 1}</span>
                                <button type="button" class="btn btn-sm text-danger p-0 border-0" onclick="removeBankItem(${idx})"><i class="bi bi-trash"></i></button>
                            </div>
                            <input type="text" class="form-control form-control-sm mb-2" id="bank_name_${idx}" value="${escapeHtml(bk.bank || '')}" placeholder="Nama Bank (BCA / Mandiri / GoPay)">
                            <input type="text" class="form-control form-control-sm mb-2" id="bank_num_${idx}" value="${escapeHtml(bk.number || '')}" placeholder="Nomor Rekening">
                            <input type="text" class="form-control form-control-sm" id="bank_owner_${idx}" value="${escapeHtml(bk.owner || '')}" placeholder="Atas Nama Pemilik">
                        </div>
                    `;
                });
                bankHtml += '</div>';
                bankHtml += `<button type="button" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2 mb-3" onclick="addBankItem()"><i class="bi bi-plus-circle me-1"></i> Tambah Rekening Bank</button>`;
                bankHtml += `
                    <div>
                        <label class="fw-bold small mb-1">Alamat Kirim Kado Fisik</label>
                        <textarea id="input_gift_address" class="form-control form-control-sm" rows="3" placeholder="Alamat lengkap penerima...">${escapeHtml(stateData.gift_address || '')}</textarea>
                    </div>
                `;
                container.innerHTML = bankHtml;
            } else if (key === 'music') {
                container.innerHTML = `
                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Link URL File Audio (.mp3)</label>
                        <input type="text" id="input_music_url" class="form-control" value="${escapeHtml(stateData.music_url || '')}" placeholder="https://domain.com/musik.mp3">
                    </div>
                    <div class="mb-2">
                        <label class="fw-bold small mb-1">Pilihan Cepat Musik Romantis</label>
                        <select class="form-select form-select-sm" onchange="document.getElementById('input_music_url').value = this.value">
                            <option value="">-- Pilih Lagu Rekomendasi --</option>
                            <option value="https://actions.google.com/sounds/v1/water/rain_heavy.ogg">Suasana Hujan Menenangkan (Ambient)</option>
                            <option value="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3">Melodi Romantis Klasik 1</option>
                            <option value="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3">Melodi Romantis Klasik 2</option>
                        </select>
                    </div>
                `;
            }
        }

        // Muat Style ke Form Style Tab
        function loadCurrentStyles(sectionKey) {
            const st = (stateData.element_styles && stateData.element_styles[sectionKey]) || {};
            document.getElementById('styleMarginTop').value = st.margin_top !== undefined ? st.margin_top : '';
            document.getElementById('styleMarginBottom').value = st.margin_bottom !== undefined ? st.margin_bottom : '';
            document.getElementById('styleMarginLeft').value = st.margin_left !== undefined ? st.margin_left : '';
            document.getElementById('styleMarginRight').value = st.margin_right !== undefined ? st.margin_right : '';

            document.getElementById('stylePaddingTop').value = st.padding_top !== undefined ? st.padding_top : '';
            document.getElementById('stylePaddingBottom').value = st.padding_bottom !== undefined ? st.padding_bottom : '';
            document.getElementById('stylePaddingLeft').value = st.padding_left !== undefined ? st.padding_left : '';
            document.getElementById('stylePaddingRight').value = st.padding_right !== undefined ? st.padding_right : '';

            document.getElementById('styleFontSize').value = st.font_size || '';
            document.getElementById('styleColorText').value = st.color || '';
            document.getElementById('styleColorPicker').value = st.color || '#ffffff';
            document.getElementById('styleBgText').value = st.background_color || '';
            document.getElementById('styleBgPicker').value = st.background_color || '#17242a';
            document.getElementById('styleTextAlign').value = st.text_align || '';
        }

        function setTextAlign(align) {
            document.getElementById('styleTextAlign').value = align;
        }

        function resetCurrentSectionStyle() {
            if (stateData.element_styles && stateData.element_styles[currentActiveSection]) {
                delete stateData.element_styles[currentActiveSection];
            }
            loadCurrentStyles(currentActiveSection);
            // Update live preview
            sendUpdateToIframe(currentActiveSection, null, {
                margin_top: '', margin_bottom: '', margin_left: '', margin_right: '',
                padding_top: '', padding_bottom: '', padding_left: '', padding_right: '',
                font_size: '', color: '', background_color: '', text_align: ''
            });
            showToast('Semua style bagian ini direset!');
        }

        // Helper Tambah/Hapus Dynamic Items
        function addStoryItem() {
            stateData.love_story.push({ title: '', year: '', desc: '' });
            renderFormFieldsForSection('story');
        }
        function removeStoryItem(idx) {
            stateData.love_story.splice(idx, 1);
            renderFormFieldsForSection('story');
        }

        function addGalleryItem() {
            stateData.gallery.push('');
            renderFormFieldsForSection('gallery');
        }
        function removeGalleryItem(idx) {
            stateData.gallery.splice(idx, 1);
            renderFormFieldsForSection('gallery');
        }

        function addBankItem() {
            stateData.bank_accounts.push({ bank: '', number: '', owner: '' });
            renderFormFieldsForSection('gift');
        }
        function removeBankItem(idx) {
            stateData.bank_accounts.splice(idx, 1);
            renderFormFieldsForSection('gift');
        }

        // Simpan Sementara dari Pop-up Modal (In-Memory + Instan Update Preview)
        function applyModalData() {
            const key = currentActiveSection;

            // 1. Ambil nilai data dari form
            if (key === 'title') {
                stateData.title = document.getElementById('input_title').value;
                stateData.event_date = document.getElementById('input_event_date').value;
            } else if (key === 'cover') {
                stateData.cover_photo = document.getElementById('input_cover_photo').value;
                stateData.bg_photo = document.getElementById('input_bg_photo').value;
            } else if (key === 'couple') {
                stateData.groom_nickname = document.getElementById('input_groom_nickname').value;
                stateData.groom_name = document.getElementById('input_groom_name').value;
                stateData.groom_parents = document.getElementById('input_groom_parents').value;
                stateData.groom_instagram = document.getElementById('input_groom_instagram').value;
                stateData.groom_photo = document.getElementById('input_groom_photo').value;

                stateData.bride_nickname = document.getElementById('input_bride_nickname').value;
                stateData.bride_name = document.getElementById('input_bride_name').value;
                stateData.bride_parents = document.getElementById('input_bride_parents').value;
                stateData.bride_instagram = document.getElementById('input_bride_instagram').value;
                stateData.bride_photo = document.getElementById('input_bride_photo').value;
            } else if (key === 'quote') {
                stateData.quote = document.getElementById('input_quote').value;
            } else if (key === 'schedule') {
                stateData.akad_time = document.getElementById('input_akad_time').value;
                stateData.akad_location = document.getElementById('input_akad_location').value;
                stateData.resepsi_time = document.getElementById('input_resepsi_time').value;
                stateData.resepsi_location = document.getElementById('input_resepsi_location').value;
                stateData.maps_url = document.getElementById('input_maps_url').value;
            } else if (key === 'story') {
                stateData.love_story = [];
                const container = document.getElementById('storyItemsContainer');
                if (container) {
                    const rows = container.querySelectorAll('[id^="story_row_"]');
                    rows.forEach((r, idx) => {
                        const t = document.getElementById(`story_title_${idx}`);
                        const y = document.getElementById(`story_year_${idx}`);
                        const d = document.getElementById(`story_desc_${idx}`);
                        if (t && (t.value || (d && d.value))) {
                            stateData.love_story.push({
                                title: t.value,
                                year: y ? y.value : '',
                                desc: d ? d.value : ''
                            });
                        }
                    });
                }
            } else if (key === 'gallery') {
                stateData.gallery = [];
                const container = document.getElementById('galleryItemsContainer');
                if (container) {
                    const inputs = container.querySelectorAll('[id^="gal_url_"]');
                    inputs.forEach(inp => {
                        if (inp.value && inp.value.trim() !== '') {
                            stateData.gallery.push(inp.value.trim());
                        }
                    });
                }
            } else if (key === 'gift') {
                stateData.bank_accounts = [];
                const container = document.getElementById('bankItemsContainer');
                if (container) {
                    const rows = container.querySelectorAll('[id^="bank_row_"]');
                    rows.forEach((r, idx) => {
                        const bName = document.getElementById(`bank_name_${idx}`);
                        const bNum = document.getElementById(`bank_num_${idx}`);
                        const bOwn = document.getElementById(`bank_owner_${idx}`);
                        if (bName && bName.value) {
                            stateData.bank_accounts.push({
                                bank: bName.value,
                                number: bNum ? bNum.value : '',
                                owner: bOwn ? bOwn.value : ''
                            });
                        }
                    });
                }
                const giftAddr = document.getElementById('input_gift_address');
                if (giftAddr) stateData.gift_address = giftAddr.value;
            } else if (key === 'music') {
                stateData.music_url = document.getElementById('input_music_url').value;
            }

            // 2. Ambil nilai style dari Tab Style
            if (!stateData.element_styles) stateData.element_styles = {};
            const stylePayload = {
                margin_top: document.getElementById('styleMarginTop').value,
                margin_bottom: document.getElementById('styleMarginBottom').value,
                margin_left: document.getElementById('styleMarginLeft').value,
                margin_right: document.getElementById('styleMarginRight').value,
                padding_top: document.getElementById('stylePaddingTop').value,
                padding_bottom: document.getElementById('stylePaddingBottom').value,
                padding_left: document.getElementById('stylePaddingLeft').value,
                padding_right: document.getElementById('stylePaddingRight').value,
                font_size: document.getElementById('styleFontSize').value,
                color: document.getElementById('styleColorText').value,
                background_color: document.getElementById('styleBgText').value,
                text_align: document.getElementById('styleTextAlign').value
            };
            stateData.element_styles[key] = stylePayload;

            // 3. Kirim update instan ke Iframe Live Preview
            sendUpdateToIframe(key, stateData, stylePayload);

            // 4. Tutup modal & tampilkan notifikasi toast
            editModal.hide();
            showToast('Perubahan sementara disimpan di pratinjau! Klik tombol Simpan hijau di atas untuk menyimpan permanen.');
        }

        // Kirim update postMessage ke iframe
        function sendUpdateToIframe(section, data, styles) {
            const iframe = document.getElementById('livePreviewIframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage({
                    type: 'BUILDER_UPDATE_ELEMENT',
                    section: section,
                    data: data,
                    styles: styles
                }, '*');
            }
        }

        // Tangkap pesan klik dari Iframe
        window.addEventListener('message', function(event) {
            if (event.data && event.data.type === 'BUILDER_OPEN_MODAL') {
                openModalForSection(event.data.section, event.data.label);
            }
        });

        // SIMPAN GLOBAL PERMANEN KE DATABASE VIA AJAX
        async function saveBuilderGlobal() {
            const btnSave = document.getElementById('btn-save-global');
            const btnText = document.getElementById('btn-save-text');

            btnSave.disabled = true;
            btnText.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Menyimpan...';

            try {
                const response = await fetch(ajaxSaveUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(stateData)
                });

                const result = await response.json();

                if (result.success) {
                    btnText.innerHTML = '<i class="bi bi-check2 me-1"></i> Tersimpan!';
                    showToast('Sukses! Seluruh perubahan berhasil disimpan permanen ke database!');
                    setTimeout(() => {
                        btnText.textContent = 'Simpan';
                        btnSave.disabled = false;
                    }, 2500);
                } else {
                    alert('Gagal menyimpan: ' + (result.message || 'Terjadi kesalahan sistem.'));
                    btnText.textContent = 'Simpan';
                    btnSave.disabled = false;
                }
            } catch (err) {
                console.error('Save error:', err);
                alert('Terjadi kesalahan jaringan saat menyimpan data.');
                btnText.textContent = 'Simpan';
                btnSave.disabled = false;
            }
        }

        // Modal Pengaturan Tema & Musik
        function openSettingsModal() {
            settingsModal.show();
        }
        function saveSettingsModal() {
            stateData.template_id = parseInt(document.getElementById('settingTemplateId').value);
            stateData.primary_color = document.getElementById('settingPrimaryColor').value;
            stateData.music_url = document.getElementById('settingMusicUrl').value;
            settingsModal.hide();
            showToast('Pengaturan diperbarui. Klik Simpan di atas untuk mempermanenkan.');
        }

        // Modal Status Publikasi
        function openActivationModal() {
            activationModal.show();
        }
        function saveActivationModal() {
            const selectedStatus = document.querySelector('input[name="statusOption"]:checked').value;
            stateData.status = selectedStatus;
            activationModal.hide();
            showToast(`Status undangan diubah ke: ${selectedStatus.toUpperCase()}.`);
        }

        // Modal Sebar Tautan
        function openShareModal() {
            shareModal.show();
        }
        function copyShareLink() {
            const copyText = document.getElementById("shareLinkInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            showToast('Link undangan berhasil disalin ke clipboard!');
        }

        function openFullscreenPreview() {
            window.open('<?= base_url('u/' . $event['slug']) ?>', '_blank');
        }

        function showToast(message) {
            document.getElementById('toastMessage').textContent = message;
            const toastEl = document.getElementById('builderToast');
            const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
            toast.show();
        }

        function escapeHtml(text) {
            if (!text) return '';
            return String(text)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    </script>
</body>
</html>
