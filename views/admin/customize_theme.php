<?php
$pageTitle = "Kustomisasi Tema & Efek - Admin";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<!-- Include font options for preview -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Alex+Brush&family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Averia+Serif+Libre:wght@400;700&family=Sacramento&family=Marcellus&display=swap" rel="stylesheet">

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Header & Breadcrumb -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('admin/events') ?>" class="btn btn-white border rounded-circle me-3 shadow-sm" title="Kembali ke Daftar Undangan">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h4 class="fw-bold text-dark m-0">Kustomisasi Tema & Efek Visual</h4>
                    <p class="text-muted small m-0">Kontrol penuh tampilan, palet warna, tipografi, dan partikel animasi (IndoInvite Theme 79 & Lainnya)</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= base_url('u/' . $event['slug'] . '?kpd=Bapak%20Budi&contoh=1') ?>" target="_blank" class="btn btn-outline-dark rounded-pill px-3 shadow-sm">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Preview Live Undangan
                </a>
            </div>
        </div>

        <?php if ($flash = get_flash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $flash ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <!-- Form Kustomisasi Kolom Kiri -->
            <div class="col-lg-7">
                <form action="<?= base_url('admin/customize/' . $event['id']) ?>" method="POST" id="themeCustomizerForm">
                    <!-- Card 1: Pilihan Template Dasar -->
                    <div class="card border-0 rounded-4 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <span class="bg-primary-subtle text-primary p-2 rounded-3 me-2 d-inline-flex">
                                    <i class="bi bi-layers-fill"></i>
                                </span>
                                Template Basis Undangan
                            </h6>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted">Pilih Template</label>
                                <select name="template_id" class="form-select form-select-lg rounded-3 fs-6">
                                    <?php foreach ($templates as $tmpl): ?>
                                        <option value="<?= $tmpl['id'] ?>" <?= $tmpl['id'] == $event['template_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($tmpl['name']) ?> (<?= ucfirst($tmpl['tier']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-text small">Template #79 adalah replika elegan Theme 79 IndoInvite dengan dukungan kustom penuh.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Skema Warna & Preset -->
                    <div class="card border-0 rounded-4 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <span class="bg-warning-subtle text-warning p-2 rounded-3 me-2 d-inline-flex">
                                    <i class="bi bi-palette-fill"></i>
                                </span>
                                Skema & Palet Warna
                            </h6>

                            <!-- Presets Cepat -->
                            <label class="form-label small fw-semibold text-muted d-block mb-2">Preset Palet Warna Cepat</label>
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 color-preset-btn"
                                    data-primary="#928573" data-secondary="#E1D6C7">
                                    <span class="d-inline-block rounded-circle me-1 border" style="width:12px; height:12px; background-color:#928573;"></span> Nature Classic (79)
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 color-preset-btn"
                                    data-primary="#C5A059" data-secondary="#F9F5EE">
                                    <span class="d-inline-block rounded-circle me-1 border" style="width:12px; height:12px; background-color:#C5A059;"></span> Royal Gold
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 color-preset-btn"
                                    data-primary="#2D5A43" data-secondary="#E8F1EC">
                                    <span class="d-inline-block rounded-circle me-1 border" style="width:12px; height:12px; background-color:#2D5A43;"></span> Botanical Green
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 color-preset-btn"
                                    data-primary="#B76E79" data-secondary="#FBF0F2">
                                    <span class="d-inline-block rounded-circle me-1 border" style="width:12px; height:12px; background-color:#B76E79;"></span> Romantic Rose
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 color-preset-btn"
                                    data-primary="#1E2A38" data-secondary="#E2E8F0">
                                    <span class="d-inline-block rounded-circle me-1 border" style="width:12px; height:12px; background-color:#1E2A38;"></span> Midnight Navy
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 color-preset-btn"
                                    data-primary="#C86446" data-secondary="#FDF5F2">
                                    <span class="d-inline-block rounded-circle me-1 border" style="width:12px; height:12px; background-color:#C86446;"></span> Terracotta
                                </button>
                            </div>

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold text-muted">Warna Utama (Primary)</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color rounded-start-3" id="primaryColorPicker" 
                                               value="<?= htmlspecialchars($themeConfig['primary_color'] ?? '#928573') ?>" style="width: 50px;">
                                        <input type="text" name="primary_color" id="primaryColorText" class="form-control font-monospace" 
                                               value="<?= htmlspecialchars($themeConfig['primary_color'] ?? '#928573') ?>" required>
                                    </div>
                                    <div class="form-text small">Untuk tombol, bingkai foto, judul utama, & aksen.</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold text-muted">Warna Sekunder (Aksen)</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color rounded-start-3" id="secondaryColorPicker" 
                                               value="<?= htmlspecialchars($themeConfig['secondary_color'] ?? '#E1D6C7') ?>" style="width: 50px;">
                                        <input type="text" name="secondary_color" id="secondaryColorText" class="form-control font-monospace" 
                                               value="<?= htmlspecialchars($themeConfig['secondary_color'] ?? '#E1D6C7') ?>" required>
                                    </div>
                                    <div class="form-text small">Untuk border kartu, badge, dan highlight latar.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Tipografi / Font -->
                    <div class="card border-0 rounded-4 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <span class="bg-info-subtle text-info p-2 rounded-3 me-2 d-inline-flex">
                                    <i class="bi bi-fonts"></i>
                                </span>
                                Tipografi & Font Undangan
                            </h6>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold text-muted">Font Judul & Nama Pengantin</label>
                                    <select name="font_heading" id="fontHeadingSelect" class="form-select rounded-3">
                                        <?php 
                                        $headingFonts = [
                                            'Great Vibes' => 'Great Vibes (Cursive Romantis - Default 79)',
                                            'Alex Brush' => 'Alex Brush (Kaligrafi Lembut)',
                                            'Playfair Display' => 'Playfair Display (Serif Elegan Modern)',
                                            'Cinzel' => 'Cinzel (Klasik Kerajaan)',
                                            'Sacramento' => 'Sacramento (Handwritten Bersih)',
                                            'Marcellus' => 'Marcellus (Serif Anggun)'
                                        ];
                                        foreach ($headingFonts as $fontKey => $fontLabel): 
                                        ?>
                                            <option value="<?= $fontKey ?>" <?= ($themeConfig['font_heading'] ?? 'Great Vibes') === $fontKey ? 'selected' : '' ?>>
                                                <?= $fontLabel ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="mt-2 p-2 bg-light rounded text-center" id="headingFontSample" 
                                         style="font-family: '<?= $themeConfig['font_heading'] ?? 'Great Vibes' ?>', cursive; font-size: 1.6rem; color: <?= $themeConfig['primary_color'] ?? '#928573' ?>;">
                                        Budi & Siti
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold text-muted">Font Teks Isi (Body Text)</label>
                                    <select name="font_body" id="fontBodySelect" class="form-select rounded-3">
                                        <?php 
                                        $bodyFonts = [
                                            'Playfair Display' => 'Playfair Display (Serif Klasik - Default 79)',
                                            'Plus Jakarta Sans' => 'Plus Jakarta Sans (Modern Sans Minimalis)',
                                            'Averia Serif Libre' => 'Averia Serif Libre (Vintage Hangat)',
                                            'Cinzel' => 'Cinzel (Elegan Kapital Formal)'
                                        ];
                                        foreach ($bodyFonts as $bKey => $bLabel): 
                                        ?>
                                            <option value="<?= $bKey ?>" <?= ($themeConfig['font_body'] ?? 'Playfair Display') === $bKey ? 'selected' : '' ?>>
                                                <?= $bLabel ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="mt-2 p-2 bg-light rounded text-center small" id="bodyFontSample"
                                         style="font-family: '<?= $themeConfig['font_body'] ?? 'Playfair Display' ?>', serif;">
                                        Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Efek Partikel Animasi & Fitur Navigasi -->
                    <div class="card border-0 rounded-4 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <span class="bg-success-subtle text-success p-2 rounded-3 me-2 d-inline-flex">
                                    <i class="bi bi-stars"></i>
                                </span>
                                Efek Animasi & Fitur Navigasi
                            </h6>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted">Efek Animasi Partikel (Canvas Engine)</label>
                                <select name="effect_particle" id="particleSelect" class="form-select rounded-3">
                                    <option value="petals" <?= ($themeConfig['effect_particle'] ?? 'petals') === 'petals' ? 'selected' : '' ?>>
                                        🌸 Kelopak Bunga Sakura / Mawar Gugur (Default IndoInvite 79)
                                    </option>
                                    <option value="leaves" <?= ($themeConfig['effect_particle'] ?? '') === 'leaves' ? 'selected' : '' ?>>
                                        🍃 Daun Hijau Melayang (Rustic Nature & Bohemian)
                                    </option>
                                    <option value="sparkles" <?= ($themeConfig['effect_particle'] ?? '') === 'sparkles' ? 'selected' : '' ?>>
                                        ✨ Kilauan Bintang Emas & Cahaya (Royal Luxury Glow)
                                    </option>
                                    <option value="snow" <?= ($themeConfig['effect_particle'] ?? '') === 'snow' ? 'selected' : '' ?>>
                                        ❄️ Salju Lembut Berjatuhan (Winter Pure & Aesthetic)
                                    </option>
                                    <option value="none" <?= ($themeConfig['effect_particle'] ?? '') === 'none' ? 'selected' : '' ?>>
                                        🚫 Matikan Efek Partikel (Tanpa Animasi)
                                    </option>
                                </select>
                                <div class="form-text small">Partikel di-render dengan HTML5 Canvas hardware-accelerated yang mulus tanpa memberatkan HP tamu.</div>
                            </div>

                            <hr class="my-3">

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold text-muted">Pola Latar Belakang (Pattern)</label>
                                    <select name="bg_pattern" class="form-select rounded-3">
                                        <option value="floral" <?= ($themeConfig['bg_pattern'] ?? 'floral') === 'floral' ? 'selected' : '' ?>>Tekstur Bintik Halus (Elegan Classic)</option>
                                        <option value="clean" <?= ($themeConfig['bg_pattern'] ?? '') === 'clean' ? 'selected' : '' ?>>Polos Bersih (Clean Minimalis)</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold text-muted">Navigasi Melayang (Floating Dock)</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" role="switch" id="showNavDockSwitch" 
                                               name="show_nav_dock" value="1" <?= !empty($themeConfig['show_nav_dock']) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-semibold" for="showNavDockSwitch">
                                            Aktifkan Menu Dock Bawah
                                        </label>
                                    </div>
                                    <div class="form-text small">Menu pintasan melayang di bagian bawah layar seperti pada IndoInvite.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mb-5">
                        <a href="<?= base_url('admin/events') ?>" class="btn btn-light rounded-pill px-4">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-semibold shadow">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan Tema
                        </button>
                    </div>
                </form>
            </div>

            <!-- Kolom Kanan: Live Interactive Mockup Preview -->
            <div class="col-lg-5">
                <div class="sticky-top" style="top: 2rem; z-index: 10;">
                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-dark text-white p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                            <span class="small text-secondary fw-semibold">
                                <i class="bi bi-phone me-1"></i> Live Visual Preview
                            </span>
                            <span class="badge bg-success rounded-pill">Theme 79 Active</span>
                        </div>

                        <!-- Mobile Device Frame -->
                        <div class="mx-auto rounded-4 overflow-hidden border border-secondary shadow position-relative" 
                             style="width: 100%; max-width: 320px; height: 580px; background-color: #FCFBF7; color: #333;">
                            
                            <!-- Cover Mini Mockup -->
                            <div id="mockupCover" class="w-100 h-100 position-relative d-flex flex-column justify-content-between text-center p-3"
                                 style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.75)), url('<?= !empty($galleries) ? $galleries[0] : "https://media.indoinvite.com/2db3bf1e16cd47a08843bb881e39cce7:indoinvite-staging/indoinvite-staging/indoinvite-staging/nikah/upload/sampul_19521762398202.jpeg" ?>') center/cover no-repeat;">
                                
                                <div class="pt-3">
                                    <span class="badge bg-white text-dark rounded-pill px-3 py-1 small shadow-sm">WALIMATUL 'URSY</span>
                                </div>

                                <div class="my-auto py-4">
                                    <h2 id="mockupHeading" class="text-white fw-bold mb-1" 
                                        style="font-family: '<?= $themeConfig['font_heading'] ?? 'Great Vibes' ?>', cursive; font-size: 2.2rem; text-shadow: 0 2px 10px rgba(0,0,0,0.5);">
                                        Budi & Siti
                                    </h2>
                                    <p id="mockupDate" class="text-white-50 small mb-4" style="font-family: '<?= $themeConfig['font_body'] ?? 'Playfair Display' ?>', serif;">
                                        Minggu, 18 Oktober 2026
                                    </p>

                                    <!-- Kepada Tamu -->
                                    <div class="bg-white bg-opacity-10 backdrop-blur rounded-3 p-2 text-white border border-white border-opacity-25 mx-2">
                                        <small class="text-white-50 d-block" style="font-size: 0.7rem;">Kepada Yth:</small>
                                        <strong class="d-block" style="font-size: 0.9rem;">Bapak Budi</strong>
                                    </div>
                                </div>

                                <div class="pb-3">
                                    <button type="button" id="mockupBtn" class="btn rounded-pill px-4 py-2 small fw-semibold text-white shadow"
                                            style="background-color: <?= $themeConfig['primary_color'] ?? '#928573' ?>; border: none; font-size: 0.8rem;">
                                        <i class="bi bi-envelope-open me-1"></i> Buka Undangan
                                    </button>
                                </div>

                                <!-- Floating Mockup Dock (jika aktif) -->
                                <div id="mockupDock" class="position-absolute bottom-0 start-50 translate-middle-x mb-2 px-3 py-1 rounded-pill bg-white shadow-sm d-flex gap-3 align-items-center <?= empty($themeConfig['show_nav_dock']) ? 'd-none' : '' ?>"
                                     style="font-size: 0.75rem; border: 1px solid <?= $themeConfig['secondary_color'] ?? '#E1D6C7' ?>;">
                                    <i class="bi bi-house-door-fill" style="color: <?= $themeConfig['primary_color'] ?? '#928573' ?>;"></i>
                                    <i class="bi bi-heart-fill text-muted"></i>
                                    <i class="bi bi-calendar-event text-muted"></i>
                                    <i class="bi bi-chat-heart text-muted"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-center">
                            <a href="<?= base_url('u/' . $event['slug'] . '?kpd=Bapak%20Budi&contoh=1') ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-pill px-4">
                                <i class="bi bi-arrows-fullscreen me-1"></i> Buka Fullscreen Tampilan Undangan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const primaryPicker = document.getElementById('primaryColorPicker');
    const primaryText = document.getElementById('primaryColorText');
    const secondaryPicker = document.getElementById('secondaryColorPicker');
    const secondaryText = document.getElementById('secondaryColorText');
    const fontHeadingSelect = document.getElementById('fontHeadingSelect');
    const fontBodySelect = document.getElementById('fontBodySelect');
    const headingFontSample = document.getElementById('headingFontSample');
    const bodyFontSample = document.getElementById('bodyFontSample');
    const mockupHeading = document.getElementById('mockupHeading');
    const mockupDate = document.getElementById('mockupDate');
    const mockupBtn = document.getElementById('mockupBtn');
    const mockupDock = document.getElementById('mockupDock');
    const showNavDockSwitch = document.getElementById('showNavDockSwitch');

    // Sinkronisasi Warna Primary
    primaryPicker.addEventListener('input', function() {
        primaryText.value = this.value;
        updateMockupColors();
    });
    primaryText.addEventListener('input', function() {
        if (/^#[0-9A-F]{6}$/i.test(this.value)) {
            primaryPicker.value = this.value;
            updateMockupColors();
        }
    });

    // Sinkronisasi Warna Secondary
    secondaryPicker.addEventListener('input', function() {
        secondaryText.value = this.value;
        updateMockupColors();
    });
    secondaryText.addEventListener('input', function() {
        if (/^#[0-9A-F]{6}$/i.test(this.value)) {
            secondaryPicker.value = this.value;
            updateMockupColors();
        }
    });

    // Presets Palet Warna
    document.querySelectorAll('.color-preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const p = this.getAttribute('data-primary');
            const s = this.getAttribute('data-secondary');
            primaryPicker.value = p;
            primaryText.value = p;
            secondaryPicker.value = s;
            secondaryText.value = s;
            updateMockupColors();
        });
    });

    function updateMockupColors() {
        const p = primaryText.value;
        const s = secondaryText.value;
        headingFontSample.style.color = p;
        mockupBtn.style.backgroundColor = p;
        if (mockupDock) {
            mockupDock.style.borderColor = s;
            const icon = mockupDock.querySelector('.bi-house-door-fill');
            if (icon) icon.style.color = p;
        }
    }

    // Sinkronisasi Font Judul
    fontHeadingSelect.addEventListener('change', function() {
        const val = this.value;
        headingFontSample.style.fontFamily = `'${val}', cursive`;
        mockupHeading.style.fontFamily = `'${val}', cursive`;
    });

    // Sinkronisasi Font Body
    fontBodySelect.addEventListener('change', function() {
        const val = this.value;
        bodyFontSample.style.fontFamily = `'${val}', serif`;
        mockupDate.style.fontFamily = `'${val}', serif`;
    });

    // Sinkronisasi Toggle Nav Dock
    showNavDockSwitch.addEventListener('change', function() {
        if (this.checked) {
            mockupDock.classList.remove('d-none');
        } else {
            mockupDock.classList.add('d-none');
        }
    });
});
</script>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
