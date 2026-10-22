<?php
// views/dashboard/partials/studio_modal.php
// Modal Studio Desain, Efek & Animasi, Ornamen, dan Tata Letak

$ornaments = ThemeCatalog::getOrnaments();
$colorPalettes = ThemeCatalog::getColorPalettes();
$fontPairings = ThemeCatalog::getFontPairings();
$particleEffects = ThemeCatalog::getParticleEffects();
$coverTransitions = ThemeCatalog::getCoverTransitions();
$defaultConfig = ThemeCatalog::getDefaultConfig();
?>

<style>
    /* Studio Modal Custom Styles */
    .modal-studio-dialog {
        max-width: 860px;
    }
    .modal-studio-content {
        background-color: #1e262c;
        color: #f1f5f9;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 24px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.7);
        overflow: hidden;
    }
    .studio-tab-bar {
        background-color: #171d22;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 0 16px;
        display: flex;
        gap: 6px;
        overflow-x: auto;
    }
    .studio-tab-bar::-webkit-scrollbar {
        height: 4px;
    }
    .studio-tab-bar::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.15);
        border-radius: 4px;
    }
    .studio-tab-btn {
        background: transparent;
        border: none;
        color: #94a3b8;
        font-weight: 600;
        font-size: 13px;
        padding: 14px 18px;
        border-bottom: 2px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .studio-tab-btn:hover {
        color: #ffffff;
    }
    .studio-tab-btn.active {
        color: #ffb700;
        border-bottom-color: #ffb700;
        background: rgba(255, 183, 0, 0.06);
    }

    /* Cards & Selectors inside Studio */
    .studio-card-choice {
        background-color: #263138;
        border: 2px solid #334149;
        border-radius: 16px;
        padding: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }
    .studio-card-choice:hover {
        border-color: rgba(255, 183, 0, 0.5);
        transform: translateY(-2px);
    }
    .studio-card-choice.active {
        border-color: #ffb700;
        background-color: rgba(255, 183, 0, 0.1);
        box-shadow: 0 0 15px rgba(255, 183, 0, 0.2);
    }
    .studio-card-choice.active::after {
        content: '\F26E';
        font-family: 'bootstrap-icons';
        position: absolute;
        top: 8px;
        right: 8px;
        background: #ffb700;
        color: #171d22;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 900;
    }

    .studio-palette-pill {
        border: 1px solid rgba(255, 255, 255, 0.12);
        background: #253037;
        color: #ffffff;
        border-radius: 30px;
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .studio-palette-pill:hover {
        border-color: #ffb700;
        background: #2e3a42;
    }
    .studio-palette-pill.active {
        background: #ffb700;
        color: #171d22;
        border-color: #ffb700;
        font-weight: 700;
    }

    .studio-section-drag-item {
        background-color: #263138;
        border: 1px solid #35444d;
        border-radius: 14px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
        transition: all 0.2s ease;
    }
    .studio-section-drag-item:hover {
        background-color: #2c3840;
    }
    .studio-section-drag-item.disabled {
        opacity: 0.5;
        background-color: #1c2328;
    }

    .svg-preview-box {
        width: 100%;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #1c2429;
        border-radius: 10px;
        margin-bottom: 10px;
        overflow: hidden;
        color: #ffb700;
    }
    .svg-preview-box img, .svg-preview-box svg {
        max-width: 80%;
        max-height: 80%;
        object-fit: contain;
    }
</style>

<!-- MODAL STUDIO DESAIN & ORNAMEN -->
<div class="modal fade" id="modalStudioDesain" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-studio-dialog">
        <div class="modal-content modal-studio-content">
            
            <!-- Header -->
            <div class="p-3 px-4 d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-2 rounded-3 bg-warning text-dark fs-5 shadow-sm">
                        <i class="bi bi-magic"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold m-0 text-white">Studio Desain & Ornamen</h5>
                        <p class="text-white-50 small m-0">Kustomisasi palet warna, tipografi, efek animasi, ornamen & tata letak undangan</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Tab Bar Navigation -->
            <nav class="studio-tab-bar">
                <button type="button" class="studio-tab-btn active" id="tab-studio-colors" onclick="switchStudioTab('colors')">
                    <i class="bi bi-palette-fill"></i> Palet Warna
                </button>
                <button type="button" class="studio-tab-btn" id="tab-studio-typography" onclick="switchStudioTab('typography')">
                    <i class="bi bi-fonts"></i> Tipografi & Font
                </button>
                <button type="button" class="studio-tab-btn" id="tab-studio-effects" onclick="switchStudioTab('effects')">
                    <i class="bi bi-stars"></i> Efek & Animasi
                </button>
                <button type="button" class="studio-tab-btn" id="tab-studio-ornaments" onclick="switchStudioTab('ornaments')">
                    <i class="bi bi-flower1"></i> Aksesoris & Ornamen
                </button>
                <button type="button" class="studio-tab-btn" id="tab-studio-layout" onclick="switchStudioTab('layout')">
                    <i class="bi bi-layout-wtf"></i> Tata Letak
                </button>
            </nav>

            <!-- Modal Body -->
            <div class="modal-body p-4" style="max-height: calc(85vh - 160px); overflow-y: auto;">
                
                <!-- ================= TAB 1: WARNA & LATAR ================= -->
                <div id="studio-pane-colors" class="studio-pane">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-warning text-uppercase mb-2">Preset Palet Warna Cepat</label>
                        <div class="d-flex flex-wrap gap-2">
                            <?php foreach ($colorPalettes as $pKey => $p): ?>
                                <button type="button" class="studio-palette-pill" onclick="applyColorPreset('<?= $pKey ?>')">
                                    <span class="d-inline-flex gap-1">
                                        <span class="rounded-circle border border-white border-opacity-25" style="width:12px; height:12px; background-color:<?= $p['primary'] ?>;"></span>
                                        <span class="rounded-circle border border-white border-opacity-25" style="width:12px; height:12px; background-color:<?= $p['secondary'] ?>;"></span>
                                    </span>
                                    <?= htmlspecialchars($p['name']) ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="card bg-dark bg-opacity-50 border-secondary border-opacity-25 rounded-4 p-3 mb-4">
                        <h6 class="fw-bold text-white mb-3"><i class="bi bi-sliders me-1 text-warning"></i> Kustomisasi Warna Spesifik</h6>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="small text-white-50 mb-1 fw-semibold">Warna Utama (Primary)</label>
                                <div class="input-group input-group-sm">
                                    <input type="color" class="form-control form-control-color bg-dark border-secondary" id="picker_primary" style="width: 44px;" onchange="syncColorInput('primary', this.value)">
                                    <input type="text" class="form-control bg-dark text-white border-secondary font-monospace" id="text_primary" onchange="syncColorInput('primary', this.value)">
                                </div>
                                <div class="form-text text-white-50" style="font-size:11px;">Digunakan untuk tombol, judul utama, inisial, dan bingkai foto.</div>
                            </div>

                            <div class="col-sm-6">
                                <label class="small text-white-50 mb-1 fw-semibold">Warna Sekunder (Secondary/Aksen)</label>
                                <div class="input-group input-group-sm">
                                    <input type="color" class="form-control form-control-color bg-dark border-secondary" id="picker_secondary" style="width: 44px;" onchange="syncColorInput('secondary', this.value)">
                                    <input type="text" class="form-control bg-dark text-white border-secondary font-monospace" id="text_secondary" onchange="syncColorInput('secondary', this.value)">
                                </div>
                                <div class="form-text text-white-50" style="font-size:11px;">Digunakan untuk highlight, badge, garis divider, dan ornamen.</div>
                            </div>

                            <div class="col-sm-6">
                                <label class="small text-white-50 mb-1 fw-semibold">Warna Latar Belakang (Canvas Background)</label>
                                <div class="input-group input-group-sm">
                                    <input type="color" class="form-control form-control-color bg-dark border-secondary" id="picker_bg_body" style="width: 44px;" onchange="syncColorInput('bg_body', this.value)">
                                    <input type="text" class="form-control bg-dark text-white border-secondary font-monospace" id="text_bg_body" onchange="syncColorInput('bg_body', this.value)">
                                </div>
                                <div class="form-text text-white-50" style="font-size:11px;">Warna dasar kanvas seluruh halaman undangan.</div>
                            </div>

                            <div class="col-sm-6">
                                <label class="small text-white-50 mb-1 fw-semibold">Warna Kartu Konten (Card Background)</label>
                                <div class="input-group input-group-sm">
                                    <input type="color" class="form-control form-control-color bg-dark border-secondary" id="picker_bg_card" style="width: 44px;" onchange="syncColorInput('bg_card', this.value)">
                                    <input type="text" class="form-control bg-dark text-white border-secondary font-monospace" id="text_bg_card" onchange="syncColorInput('bg_card', this.value)">
                                </div>
                                <div class="form-text text-white-50" style="font-size:11px;">Latar belakang kotak informasi acara, cerita, dan rekening.</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="form-label small fw-bold text-warning text-uppercase mb-2">Pola Tekstur Latar Belakang</label>
                        <div class="row g-2">
                            <div class="col-sm-3 col-6">
                                <div class="studio-card-choice text-center" id="pattern_canvas" onclick="selectPattern('canvas')">
                                    <i class="bi bi-file-earmark-richtext fs-3 text-warning mb-1 d-block"></i>
                                    <span class="small fw-semibold text-white">Kanvas Vintage</span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6">
                                <div class="studio-card-choice text-center" id="pattern_floral" onclick="selectPattern('floral')">
                                    <i class="bi bi-flower2 fs-3 text-warning mb-1 d-block"></i>
                                    <span class="small fw-semibold text-white">Floral Halus</span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6">
                                <div class="studio-card-choice text-center" id="pattern_marble" onclick="selectPattern('marble')">
                                    <i class="bi bi-circle-square fs-3 text-warning mb-1 d-block"></i>
                                    <span class="small fw-semibold text-white">Marmer Mewah</span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6">
                                <div class="studio-card-choice text-center" id="pattern_clean" onclick="selectPattern('clean')">
                                    <i class="bi bi-square fs-3 text-warning mb-1 d-block"></i>
                                    <span class="small fw-semibold text-white">Polos Bersih</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= TAB 2: TIPOGRAFI ================= -->
                <div id="studio-pane-typography" class="studio-pane" style="display: none;">
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <label class="form-label small fw-bold text-warning text-uppercase mb-2">Font Judul & Nama Pasangan (Heading)</label>
                            <select class="form-select bg-dark text-white border-secondary rounded-3" id="select_font_heading" onchange="updateFontPreview()">
                                <?php foreach ($fontPairings['heading_fonts'] as $f): ?>
                                    <option value="<?= htmlspecialchars($f['name']) ?>"><?= htmlspecialchars($f['label']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text text-white-50 small mt-1">Font artistik kaligrafi/serif untuk nama pengantin dan judul seksi.</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label small fw-bold text-warning text-uppercase mb-2">Font Teks Isi (Body Text)</label>
                            <select class="form-select bg-dark text-white border-secondary rounded-3" id="select_font_body" onchange="updateFontPreview()">
                                <?php foreach ($fontPairings['body_fonts'] as $f): ?>
                                    <option value="<?= htmlspecialchars($f['name']) ?>"><?= htmlspecialchars($f['label']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text text-white-50 small mt-1">Font yang bersih dan mudah dibaca untuk tanggal, alamat, dan narasi.</div>
                        </div>
                    </div>

                    <!-- Dynamic Live Font Preview Box -->
                    <div class="card bg-dark bg-opacity-75 border-secondary border-opacity-25 rounded-4 p-4 text-center">
                        <span class="badge bg-secondary bg-opacity-25 text-white-50 px-3 py-1 rounded-pill mb-3 align-self-center small">Live Font Preview</span>
                        <h2 class="display-6 fw-bold mb-2" id="preview_heading_text" style="color: #ffb700;">
                            Romeo &amp; Juliet
                        </h2>
                        <p class="mb-0 text-white-50" id="preview_body_text" style="font-size: 15px; max-width: 500px; margin: 0 auto; line-height: 1.6;">
                            Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan untukmu pasangan dari jenismu sendiri, agar kamu merasa tenteram kepadanya.
                        </p>
                    </div>
                </div>

                <!-- ================= TAB 3: EFEK & ANIMASI ================= -->
                <div id="studio-pane-effects" class="studio-pane" style="display: none;">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-warning text-uppercase mb-2">Efek Partikel Kanvas (Floating Particle FX)</label>
                        <div class="row g-3">
                            <?php foreach ($particleEffects as $p): ?>
                                <div class="col-sm-4 col-6">
                                    <div class="studio-card-choice h-100" id="particle_<?= $p['id'] ?>" onclick="selectParticle('<?= $p['id'] ?>')">
                                        <div class="fs-2 mb-1"><?= $p['icon'] ?></div>
                                        <div class="fw-bold small text-white"><?= htmlspecialchars($p['name']) ?></div>
                                        <div class="text-white-50" style="font-size: 11px;"><?= htmlspecialchars($p['desc']) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-warning text-uppercase mb-2">Transisi Pembuka Undangan (Cover Reveal FX)</label>
                        <div class="row g-3">
                            <?php foreach ($coverTransitions as $t): ?>
                                <div class="col-sm-6 col-12">
                                    <div class="studio-card-choice h-100 d-flex align-items-center gap-3" id="transition_<?= $t['id'] ?>" onclick="selectCoverTransition('<?= $t['id'] ?>')">
                                        <i class="bi <?= $t['icon'] ?> fs-2 text-warning"></i>
                                        <div>
                                            <div class="fw-bold small text-white"><?= htmlspecialchars($t['name']) ?></div>
                                            <div class="text-white-50" style="font-size: 11px;"><?= htmlspecialchars($t['desc']) ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="card bg-dark bg-opacity-50 border-secondary border-opacity-25 rounded-4 p-3">
                        <h6 class="fw-bold text-white mb-3"><i class="bi bi-toggle-on text-warning me-1"></i> Fitur Interaktif Tambahan</h6>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="switch_floating_nav" checked>
                                    <label class="form-check-label text-white small fw-semibold" for="switch_floating_nav">
                                        Menu Navigasi Melayang (Floating Dock)
                                    </label>
                                </div>
                                <div class="form-text text-white-50" style="font-size: 11px;">Memunculkan bar menu pintasan di bawah layar tamu.</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="switch_music_spin" checked>
                                    <label class="form-check-label text-white small fw-semibold" for="switch_music_spin">
                                        Piringan Musik Berputar (Vinyl Disc FX)
                                    </label>
                                </div>
                                <div class="form-text text-white-50" style="font-size: 11px;">Animasi piringan hitam yang berputar saat musik diputar.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= TAB 4: AKSESORIS & ORNAMEN ================= -->
                <div id="studio-pane-ornaments" class="studio-pane" style="display: none;">
                    
                    <!-- 1. Corner Ornaments -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-bold text-warning text-uppercase m-0">1. Ornamen Sudut (Corner Ornaments)</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2 text-white-50" style="font-size: 11px;" onclick="setCornerPos('top')">Atas Saja</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2 text-white-50" style="font-size: 11px;" onclick="setCornerPos('all')">4 Sudut</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2 text-white-50" style="font-size: 11px;" onclick="setCornerPos('none')">Matikan</button>
                            </div>
                        </div>
                        <div class="row g-3">
                            <?php foreach ($ornaments['corners'] as $c): ?>
                                <div class="col-sm-3 col-6">
                                    <div class="studio-card-choice text-center h-100" id="corner_<?= $c['id'] ?>" onclick="selectCorner('<?= $c['id'] ?>')">
                                        <div class="svg-preview-box">
                                            <img src="<?= base_url($c['file']) ?>" alt="<?= htmlspecialchars($c['name']) ?>" style="filter: invert(75%) sepia(50%) saturate(1000%) hue-rotate(5deg);">
                                        </div>
                                        <div class="small fw-bold text-white"><?= htmlspecialchars($c['name']) ?></div>
                                        <div class="text-white-50" style="font-size: 11px;"><?= htmlspecialchars($c['desc']) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- 2. Dividers -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-warning text-uppercase mb-2">2. Garis Pembatas / Pemisah Bagian (Dividers)</label>
                        <div class="row g-3">
                            <?php foreach ($ornaments['dividers'] as $d): ?>
                                <div class="col-sm-6 col-12">
                                    <div class="studio-card-choice h-100" id="divider_<?= $d['id'] ?>" onclick="selectDivider('<?= $d['id'] ?>')">
                                        <div class="svg-preview-box" style="height: 40px;">
                                            <img src="<?= base_url($d['file']) ?>" alt="<?= htmlspecialchars($d['name']) ?>" style="filter: invert(75%) sepia(50%) saturate(1000%) hue-rotate(5deg);">
                                        </div>
                                        <div class="small fw-bold text-white"><?= htmlspecialchars($d['name']) ?></div>
                                        <div class="text-white-50" style="font-size: 11px;"><?= htmlspecialchars($d['desc']) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- 3. Photo Frames & Badges -->
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <label class="form-label small fw-bold text-warning text-uppercase mb-2">3. Bentuk Bingkai Foto (Photo Frame)</label>
                            <div class="row g-2">
                                <?php foreach ($ornaments['frames'] as $fr): ?>
                                    <div class="col-6">
                                        <div class="studio-card-choice text-center" id="frame_<?= $fr['id'] ?>" onclick="selectFrame('<?= $fr['id'] ?>')">
                                            <div class="svg-preview-box" style="height: 50px;">
                                                <img src="<?= base_url($fr['file']) ?>" alt="<?= htmlspecialchars($fr['name']) ?>" style="filter: invert(75%) sepia(50%) saturate(1000%) hue-rotate(5deg);">
                                            </div>
                                            <div class="small fw-bold text-white" style="font-size: 11px;"><?= htmlspecialchars($fr['name']) ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label small fw-bold text-warning text-uppercase mb-2">4. Lencana &amp; Wax Seal (Badges)</label>
                            <div class="row g-2">
                                <?php foreach ($ornaments['badges'] as $bg): ?>
                                    <div class="col-6">
                                        <div class="studio-card-choice text-center" id="badge_<?= $bg['id'] ?>" onclick="selectBadge('<?= $bg['id'] ?>')">
                                            <div class="svg-preview-box" style="height: 50px;">
                                                <img src="<?= base_url($bg['file']) ?>" alt="<?= htmlspecialchars($bg['name']) ?>">
                                            </div>
                                            <div class="small fw-bold text-white" style="font-size: 11px;"><?= htmlspecialchars($bg['name']) ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= TAB 5: TATA LETAK & SEKSI ================= -->
                <div id="studio-pane-layout" class="studio-pane" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-bold text-white m-0">Susunan Bagian Undangan (Section Reorder)</h6>
                            <small class="text-white-50">Atur urutan tampilan bagian dan aktifkan/nonaktifkan seksi tertentu</small>
                        </div>
                    </div>

                    <!-- Section Items List Container -->
                    <div id="studioSectionListContainer">
                        <!-- Rendered by JS -->
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="p-3 px-4 border-top border-secondary border-opacity-25 d-flex align-items-center justify-content-between bg-dark bg-opacity-50">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-3 text-white-50" data-bs-dismiss="modal">
                    Tutup
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-warning rounded-pill px-4 fw-bold text-dark shadow" onclick="applyStudioChanges()">
                        <i class="bi bi-check2-circle me-1"></i> Terapkan ke Pratinjau
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Studio State Management
    let studioConfig = <?= json_encode($themeConfig) ?>;
    const colorPresets = <?= json_encode($colorPalettes) ?>;

    // Switch Tab in Studio
    function switchStudioTab(tab) {
        document.querySelectorAll('.studio-tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.studio-pane').forEach(p => p.style.display = 'none');
        
        const activeBtn = document.getElementById(`tab-studio-${tab}`);
        const activePane = document.getElementById(`studio-pane-${tab}`);
        if (activeBtn) activeBtn.classList.add('active');
        if (activePane) activePane.style.display = 'block';
    }

    function openStudioModal() {
        populateStudioUI();
        const modal = new bootstrap.Modal(document.getElementById('modalStudioDesain'));
        modal.show();
    }

    // Populate Studio UI with current studioConfig
    function populateStudioUI() {
        if (!studioConfig.colors) studioConfig.colors = {};
        if (!studioConfig.typography) studioConfig.typography = {};
        if (!studioConfig.effects) studioConfig.effects = {};
        if (!studioConfig.ornaments) studioConfig.ornaments = {};
        if (!studioConfig.layout) studioConfig.layout = { sections: [] };

        // Colors
        syncColorPickerAndText('primary', studioConfig.colors.primary || '#928573');
        syncColorPickerAndText('secondary', studioConfig.colors.secondary || '#E1D6C7');
        syncColorPickerAndText('bg_body', studioConfig.colors.bg_body || '#FAF7F2');
        syncColorPickerAndText('bg_card', studioConfig.colors.bg_card || '#FFFFFF');

        // Pattern
        selectPattern(studioConfig.background?.pattern || 'canvas', false);

        // Typography
        if (document.getElementById('select_font_heading')) {
            document.getElementById('select_font_heading').value = studioConfig.typography.font_heading || 'Great Vibes';
        }
        if (document.getElementById('select_font_body')) {
            document.getElementById('select_font_body').value = studioConfig.typography.font_body || 'Playfair Display';
        }
        updateFontPreview();

        // Effects
        selectParticle(studioConfig.effects.particle || 'petals', false);
        selectCoverTransition(studioConfig.effects.cover_transition || 'slide_up', false);
        if (document.getElementById('switch_floating_nav')) {
            document.getElementById('switch_floating_nav').checked = studioConfig.effects.floating_nav !== false;
        }
        if (document.getElementById('switch_music_spin')) {
            document.getElementById('switch_music_spin').checked = studioConfig.effects.music_spin !== false;
        }

        // Ornaments
        selectCorner(studioConfig.ornaments.corner_style || 'floral-vintage', false);
        selectDivider(studioConfig.ornaments.divider_style || 'divider-olive', false);
        selectFrame(studioConfig.ornaments.photo_frame || 'arch-cathedral', false);
        selectBadge(studioConfig.ornaments.badge_style || 'wax-seal-gold', false);

        // Sections
        renderSectionList();
    }

    function syncColorPickerAndText(type, val) {
        const picker = document.getElementById(`picker_${type}`);
        const text = document.getElementById(`text_${type}`);
        if (picker) picker.value = val;
        if (text) text.value = val;
        studioConfig.colors[type] = val;
    }

    function syncColorInput(type, val) {
        syncColorPickerAndText(type, val);
    }

    function applyColorPreset(presetKey) {
        const p = colorPresets[presetKey];
        if (!p) return;
        studioConfig.palette_preset = presetKey;
        syncColorPickerAndText('primary', p.primary);
        syncColorPickerAndText('secondary', p.secondary);
        syncColorPickerAndText('bg_body', p.bg_body || '#FAF7F2');
        syncColorPickerAndText('bg_card', '#FFFFFF');

        document.querySelectorAll('.studio-palette-pill').forEach(btn => btn.classList.remove('active'));
        if (event && event.currentTarget) event.currentTarget.classList.add('active');
    }

    function selectPattern(pat, trigger = true) {
        if (!studioConfig.background) studioConfig.background = {};
        studioConfig.background.pattern = pat;
        document.querySelectorAll('[id^="pattern_"]').forEach(el => el.classList.remove('active'));
        const target = document.getElementById(`pattern_${pat}`);
        if (target) target.classList.add('active');
    }

    function updateFontPreview() {
        const hFont = document.getElementById('select_font_heading').value;
        const bFont = document.getElementById('select_font_body').value;
        studioConfig.typography.font_heading = hFont;
        studioConfig.typography.font_body = bFont;

        // Load link dynamic font for preview
        const linkId = 'preview-dyn-fonts';
        let link = document.getElementById(linkId);
        if (!link) {
            link = document.createElement('link');
            link.id = linkId;
            link.rel = 'stylesheet';
            document.head.appendChild(link);
        }
        link.href = `https://fonts.googleapis.com/css2?family=${hFont.replace(/ /g, '+')}&family=${bFont.replace(/ /g, '+')}&display=swap`;

        const prevH = document.getElementById('preview_heading_text');
        const prevB = document.getElementById('preview_body_text');
        if (prevH) prevH.style.fontFamily = `"${hFont}", cursive, serif`;
        if (prevB) prevB.style.fontFamily = `"${bFont}", sans-serif, serif`;
    }

    function selectParticle(part, trigger = true) {
        studioConfig.effects.particle = part;
        document.querySelectorAll('[id^="particle_"]').forEach(el => el.classList.remove('active'));
        const target = document.getElementById(`particle_${part}`);
        if (target) target.classList.add('active');
    }

    function selectCoverTransition(trans, trigger = true) {
        studioConfig.effects.cover_transition = trans;
        document.querySelectorAll('[id^="transition_"]').forEach(el => el.classList.remove('active'));
        const target = document.getElementById(`transition_${trans}`);
        if (target) target.classList.add('active');
    }

    function selectCorner(id, trigger = true) {
        studioConfig.ornaments.corner_style = id;
        document.querySelectorAll('[id^="corner_"]').forEach(el => el.classList.remove('active'));
        const target = document.getElementById(`corner_${id}`);
        if (target) target.classList.add('active');
    }

    function setCornerPos(pos) {
        studioConfig.ornaments.corner_position = pos;
        showToast(`Posisi ornamen sudut diatur ke: ${pos.toUpperCase()}`);
    }

    function selectDivider(id, trigger = true) {
        studioConfig.ornaments.divider_style = id;
        document.querySelectorAll('[id^="divider_"]').forEach(el => el.classList.remove('active'));
        const target = document.getElementById(`divider_${id}`);
        if (target) target.classList.add('active');
    }

    function selectFrame(id, trigger = true) {
        studioConfig.ornaments.photo_frame = id;
        document.querySelectorAll('[id^="frame_"]').forEach(el => el.classList.remove('active'));
        const target = document.getElementById(`frame_${id}`);
        if (target) target.classList.add('active');
    }

    function selectBadge(id, trigger = true) {
        studioConfig.ornaments.badge_style = id;
        document.querySelectorAll('[id^="badge_"]').forEach(el => el.classList.remove('active'));
        const target = document.getElementById(`badge_${id}`);
        if (target) target.classList.add('active');
    }

    // Section Management
    function renderSectionList() {
        const container = document.getElementById('studioSectionListContainer');
        if (!container) return;

        let sections = studioConfig.layout?.sections;
        if (!sections || !Array.isArray(sections) || sections.length === 0) {
            sections = <?= json_encode($defaultConfig['layout']['sections']) ?>;
            studioConfig.layout.sections = sections;
        }

        container.innerHTML = '';
        sections.forEach((sec, idx) => {
            const row = document.createElement('div');
            row.className = `studio-section-drag-item ${sec.visible ? '' : 'disabled'}`;
            row.innerHTML = `
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-dark text-white-50 border border-secondary border-opacity-25 rounded-pill px-2 py-1" style="font-size:10px;">
                        #${idx + 1}
                    </span>
                    <div>
                        <strong class="text-white d-block small">${sec.name}</strong>
                        <span class="text-white-50" style="font-size: 11px;">ID: ${sec.id}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-dark btn-sm rounded-circle text-white p-0" style="width:28px; height:28px;" 
                            onclick="moveSectionItem(${idx}, -1)" ${idx === 0 ? 'disabled' : ''} title="Geser ke Atas">
                        <i class="bi bi-arrow-up"></i>
                    </button>
                    <button type="button" class="btn btn-dark btn-sm rounded-circle text-white p-0" style="width:28px; height:28px;" 
                            onclick="moveSectionItem(${idx}, 1)" ${idx === sections.length - 1 ? 'disabled' : ''} title="Geser ke Bawah">
                        <i class="bi bi-arrow-down"></i>
                    </button>
                    <div class="form-check form-switch ms-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="toggle_sec_${idx}" 
                               ${sec.visible ? 'checked' : ''} onchange="toggleSectionItem(${idx}, this.checked)">
                    </div>
                </div>
            `;
            container.appendChild(row);
        });
    }

    function moveSectionItem(idx, dir) {
        const sections = studioConfig.layout.sections;
        const targetIdx = idx + dir;
        if (targetIdx < 0 || targetIdx >= sections.length) return;
        const temp = sections[idx];
        sections[idx] = sections[targetIdx];
        sections[targetIdx] = temp;
        renderSectionList();
    }

    function toggleSectionItem(idx, isChecked) {
        studioConfig.layout.sections[idx].visible = isChecked;
        renderSectionList();
    }

    // Apply Studio Changes to State and Live Preview
    function applyStudioChanges() {
        studioConfig.effects.floating_nav = document.getElementById('switch_floating_nav')?.checked ?? true;
        studioConfig.effects.music_spin = document.getElementById('switch_music_spin')?.checked ?? true;

        stateData.theme_config = studioConfig;
        stateData.primary_color = studioConfig.colors.primary;

        // Kirim update ke Live Preview Iframe
        const iframe = document.getElementById('livePreviewIframe');
        if (iframe && iframe.contentWindow) {
            iframe.contentWindow.postMessage({
                type: 'BUILDER_UPDATE_THEME',
                theme_config: studioConfig
            }, '*');
            
            // Reload iframe jika ada perubahan ornamen/layout
            setTimeout(() => {
                iframe.src = iframe.src;
            }, 300);
        }

        const modalEl = document.getElementById('modalStudioDesain');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        showToast('Kustomisasi tema & efek berhasil diterapkan! Klik tombol Simpan hijau di atas untuk mempermanenkan ke database.');
    }
</script>
