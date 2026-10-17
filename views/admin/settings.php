<?php
// views/admin/settings.php
$pageTitle = "Pengaturan Identitas & Branding - Super Admin";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 small">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengaturan Identitas Web</li>
                    </ol>
                </nav>
                <div class="d-flex align-items-center gap-2">
                    <h3 class="fw-bold text-dark m-0">Pengaturan Identitas Website</h3>
                    <span class="badge bg-primary rounded-pill px-3 py-1 small">Super Administrator</span>
                </div>
                <p class="text-muted small m-0 mt-1">Ubah nama web, logo, favicon, dan format title browser untuk seluruh platform secara instan.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= base_url('admin') ?>" class="btn btn-outline-secondary rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
                <a href="<?= base_url() ?>" target="_blank" class="btn btn-outline-primary rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Web Utama
                </a>
            </div>
        </div>

        <!-- Flash Alert -->
        <?php if ($flash = get_flash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
                <span class="align-middle fw-medium"><?= $flash ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($flash = get_flash('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i>
                <span class="align-middle fw-medium"><?= $flash ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/settings/save') ?>" method="POST" enctype="multipart/form-data" id="formSettings">
            <div class="row g-4">
                
                <!-- Kolom Kiri: Form Input -->
                <div class="col-lg-8">
                    
                    <!-- 1. IDENTITAS UTAMA -->
                    <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-primary-subtle text-primary rounded-3 me-2">
                                <i class="bi bi-building-gear fs-5"></i>
                            </span>
                            <div>
                                <h5 class="fw-bold text-dark m-0">1. Nama Website & Slogan</h5>
                                <small class="text-muted">Nama brand yang ditampilkan di seluruh penjuru aplikasi.</small>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Nama Website (Web Name / App Name) <span class="text-danger">*</span></label>
                                <input type="text" name="app_name" id="inputAppName" class="form-control form-control-lg rounded-3 fs-6" value="<?= htmlspecialchars($settings['app_name'] ?? 'PENDAR LOKA') ?>" required placeholder="Contoh: PENDAR LOKA">
                                <div class="form-text" style="font-size: 11px;">Akan tampil di Navbar, Footer, WhatsApp, dan metadata platform.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Tagline / Slogan Website</label>
                                <input type="text" name="app_tagline" id="inputAppTagline" class="form-control form-control-lg rounded-3 fs-6" value="<?= htmlspecialchars($settings['app_tagline'] ?? 'Platform Undangan Digital Modern & Elegan') ?>" placeholder="Contoh: Platform Undangan Digital Modern & Elegan">
                                <div class="form-text" style="font-size: 11px;">Mendeskripsikan fungsi utama platform Anda.</div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. LOGO WEBSITE (DUAL LOGO: MODE TERANG & MODE GELAP) -->
                    <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 rounded-3 me-2" style="background-color: rgba(212, 170, 123, 0.2); color: #B3864E;">
                                <i class="bi bi-image fs-5"></i>
                            </span>
                            <div>
                                <h5 class="fw-bold text-dark m-0">2. Logo Website (Mode Terang & Mode Gelap)</h5>
                                <small class="text-muted">Atur logo yang berbeda untuk menyesuaikan tampilan saat pengunjung berada di Mode Terang maupun Mode Gelap.</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary d-block">Tipe Tampilan Logo</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="site_logo_type" id="typeIcon" value="icon" <?= ($settings['site_logo_type'] ?? 'icon') === 'icon' ? 'checked' : '' ?> onchange="toggleLogoInput()">
                                <label class="btn btn-outline-primary py-2.5 fw-semibold" for="typeIcon">
                                    <i class="bi bi-envelope-paper-heart-fill me-1"></i> Ikon Bawaan Modern + Teks Nama
                                </label>

                                <input type="radio" class="btn-check" name="site_logo_type" id="typeImage" value="image" <?= ($settings['site_logo_type'] ?? '') === 'image' ? 'checked' : '' ?> onchange="toggleLogoInput()">
                                <label class="btn btn-outline-primary py-2.5 fw-semibold" for="typeImage">
                                    <i class="bi bi-file-earmark-image me-1"></i> Gambar Logo Kustom (Dual Logo)
                                </label>
                            </div>
                        </div>

                        <div id="logoUploadSection" class="<?= ($settings['site_logo_type'] ?? 'icon') === 'image' ? '' : 'd-none' ?>">
                            
                            <!-- A. LOGO MODE TERANG -->
                            <div class="p-3.5 rounded-4 border mb-4" style="background-color: #FAFAF7;">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge rounded-pill px-3 py-1.5 fw-semibold" style="background-color: #F7F5F0; color: #17242A; border: 1px solid #DDE2E5;">
                                            <i class="bi bi-sun-fill text-warning me-1"></i> Mode Terang (Light Theme)
                                        </span>
                                        <span class="small text-muted">Ditampilkan saat background putih / terang</span>
                                    </div>
                                    <?php if (!empty($settings['site_logo_light'])): ?>
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="checkbox" name="remove_logo_light" value="1" id="checkRemoveLogoLight">
                                            <label class="form-check-label small text-danger fw-semibold" for="checkRemoveLogoLight">
                                                Hapus Logo Terang
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="row align-items-center g-3 mb-3">
                                    <div class="col-md-7">
                                        <label class="form-label small fw-bold text-dark mb-1">Unggah Berkas Logo Mode Terang</label>
                                        <input type="file" name="logo_light_file" id="inputLogoLightFile" class="form-control rounded-3" accept=".png,.jpg,.jpeg,.svg,.webp" onchange="previewLogoLightFile(this)">
                                        <small class="text-muted d-block mt-1" style="font-size: 11px;">Format: PNG transparan (disarankan), SVG, WebP, JPG. Maks 2 MB.</small>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label small fw-bold text-secondary mb-1">Atau Gunakan URL Gambar</label>
                                        <input type="url" name="logo_light_url" id="inputLogoLightUrl" class="form-control form-control-sm rounded-3" value="<?= !empty($settings['site_logo_light']) && str_starts_with($settings['site_logo_light'], 'http') ? htmlspecialchars($settings['site_logo_light']) : '' ?>" placeholder="https://domain.com/logo-light.png" oninput="previewLogoLightUrl(this.value)">
                                    </div>
                                </div>

                                <!-- Current Light Logo Preview Box -->
                                <div class="p-3 rounded-3 border d-flex align-items-center justify-content-between" style="background-color: #F7F5F0;">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 rounded-2 bg-white border d-flex align-items-center justify-content-center" style="min-width: 220px; height: 85px;">
                                            <img id="thumbLogoLight" src="<?= site_logo_url('light') ?: 'https://via.placeholder.com/200x60?text=Belum+Ada+Logo' ?>" alt="Logo Mode Terang" style="max-height: 75px; max-width: 210px; object-fit: contain;">
                                        </div>
                                        <div>
                                            <span class="small fw-bold text-dark d-block">Preview di Latar Terang:</span>
                                            <span class="small text-muted" style="font-size: 11px;">
                                                <?= !empty($settings['site_logo_light']) ? basename($settings['site_logo_light']) : 'Menggunakan logo default / belum diset' ?>
                                            </span>
                                        </div>
                                    </div>
                                    <span class="badge bg-light text-dark border small">Background: #F7F5F0</span>
                                </div>
                            </div>

                            <!-- B. LOGO MODE GELAP -->
                            <div class="p-3.5 rounded-4 border mb-2" style="background-color: #17242A;">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge rounded-pill px-3 py-1.5 fw-semibold" style="background-color: #273842; color: #F7F5F0; border: 1px solid #364B56;">
                                            <i class="bi bi-moon-stars-fill text-info me-1"></i> Mode Gelap (Dark Theme)
                                        </span>
                                        <span class="small text-white-50">Ditampilkan saat background hitam / gelap</span>
                                    </div>
                                    <?php if (!empty($settings['site_logo_dark'])): ?>
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="checkbox" name="remove_logo_dark" value="1" id="checkRemoveLogoDark">
                                            <label class="form-check-label small text-warning fw-semibold" for="checkRemoveLogoDark">
                                                Hapus Logo Gelap
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="row align-items-center g-3 mb-3">
                                    <div class="col-md-7">
                                        <label class="form-label small fw-bold text-white mb-1">Unggah Berkas Logo Mode Gelap</label>
                                        <input type="file" name="logo_dark_file" id="inputLogoDarkFile" class="form-control rounded-3" accept=".png,.jpg,.jpeg,.svg,.webp" onchange="previewLogoDarkFile(this)">
                                        <small class="text-white-50 d-block mt-1" style="font-size: 11px;">Gunakan logo berwarna putih / emas / kontras dengan latar gelap.</small>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label small fw-bold text-white-50 mb-1">Atau Gunakan URL Gambar</label>
                                        <input type="url" name="logo_dark_url" id="inputLogoDarkUrl" class="form-control form-control-sm rounded-3" value="<?= !empty($settings['site_logo_dark']) && str_starts_with($settings['site_logo_dark'], 'http') ? htmlspecialchars($settings['site_logo_dark']) : '' ?>" placeholder="https://domain.com/logo-dark.png" oninput="previewLogoDarkUrl(this.value)">
                                    </div>
                                </div>

                                <!-- Current Dark Logo Preview Box -->
                                <div class="p-3 rounded-3 border d-flex align-items-center justify-content-between" style="background-color: #1F2E35; border-color: rgba(247, 245, 240, 0.12) !important;">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 rounded-2 d-flex align-items-center justify-content-center" style="background-color: #17242A; border: 1px solid #2D414B; min-width: 220px; height: 85px;">
                                            <img id="thumbLogoDark" src="<?= site_logo_url('dark') ?: 'https://via.placeholder.com/200x60?text=Belum+Ada+Logo' ?>" alt="Logo Mode Gelap" style="max-height: 75px; max-width: 210px; object-fit: contain;">
                                        </div>
                                        <div>
                                            <span class="small fw-bold text-white d-block">Preview di Latar Gelap:</span>
                                            <span class="small text-white-50" style="font-size: 11px;">
                                                <?= !empty($settings['site_logo_dark']) ? basename($settings['site_logo_dark']) : 'Menggunakan logo default / belum diset' ?>
                                            </span>
                                        </div>
                                    </div>
                                    <span class="badge border small" style="background-color: #273842; color: #F7F5F0;">Background: #17242A</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 3. FAVICON WEBSITE -->
                    <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-2">
                                <i class="bi bi-bookmark-star fs-5"></i>
                            </span>
                            <div>
                                <h5 class="fw-bold text-dark m-0">3. Favicon Website (Ikon Tab Browser)</h5>
                                <small class="text-muted">Ikon kecil yang muncul di sebelah kiri judul tab browser pengunjung.</small>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-4 border mb-3">
                            <div class="row align-items-center g-3">
                                <div class="col-md-7">
                                    <label class="form-label small fw-bold text-dark mb-1">Unggah Berkas Favicon Baru</label>
                                    <input type="file" name="favicon_file" id="inputFaviconFile" class="form-control rounded-3" accept=".ico,.png,.svg,.webp" onchange="previewFaviconFile(this)">
                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">Format: ICO, PNG (32x32 atau 64x64 px), SVG. Maksimal 1 MB.</small>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small fw-bold text-secondary mb-1">Atau Gunakan URL Favicon</label>
                                    <input type="url" name="favicon_url" id="inputFaviconUrl" class="form-control form-control-sm rounded-3" value="<?= !empty($settings['site_favicon']) && str_starts_with($settings['site_favicon'], 'http') ? htmlspecialchars($settings['site_favicon']) : '' ?>" placeholder="https://domain.com/favicon.png" oninput="previewFaviconUrl(this.value)">
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($settings['site_favicon'])): ?>
                            <div class="d-flex align-items-center justify-content-between p-2 px-3 bg-light-subtle rounded-3 border">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <span class="small text-muted">Favicon saat ini: <strong class="text-dark"><?= basename($settings['site_favicon']) ?></strong></span>
                                </div>
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" name="remove_favicon" value="1" id="checkRemoveFavicon">
                                    <label class="form-check-label small text-danger fw-semibold" for="checkRemoveFavicon">
                                        Hapus Favicon
                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- 4. PAGE TITLE FORMAT & METADATA SEO -->
                    <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-info-subtle text-info rounded-3 me-2">
                                <i class="bi bi-window-fullscreen fs-5"></i>
                            </span>
                            <div>
                                <h5 class="fw-bold text-dark m-0">4. Format Page Title & Meta SEO</h5>
                                <small class="text-muted">Mengatur bagaimana judul tab browser diformat di setiap halaman.</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Format Title Browser</label>
                            <input type="text" name="page_title_format" id="inputTitleFormat" class="form-control rounded-3" value="<?= htmlspecialchars($settings['page_title_format'] ?? '{title} | {app_name}') ?>" placeholder="{title} | {app_name}" oninput="updateMockupPreview()">
                            <div class="form-text" style="font-size: 11px;">
                                Placeholder tersedia: <code class="text-primary">{title}</code> (Nama Halaman Aktif), <code class="text-primary">{app_name}</code> (Nama Website), <code class="text-primary">{tagline}</code> (Slogan).
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Deskripsi Meta Platform (SEO / Sharing Link)</label>
                            <textarea name="site_description" class="form-control rounded-3" rows="2" placeholder="Deskripsi ringkas platform"><?= htmlspecialchars($settings['site_description'] ?? '') ?></textarea>
                            <div class="form-text" style="font-size: 11px;">Teks ini akan muncul saat link website dibagikan ke WhatsApp, Facebook, dan Google.</div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Nomor WhatsApp CS / Admin</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-whatsapp text-success"></i></span>
                                    <input type="text" name="whatsapp_number" class="form-control rounded-end-3" value="<?= htmlspecialchars($settings['whatsapp_number'] ?? '081234567890') ?>" placeholder="081234567890">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Template Pesan WhatsApp CS</label>
                                <input type="text" name="whatsapp_text" class="form-control rounded-3" value="<?= htmlspecialchars($settings['whatsapp_text'] ?? 'Halo Admin PENDAR LOKA, saya mau tanya tentang pembuatan undangan digital.') ?>" placeholder="Halo Admin...">
                            </div>
                        </div>
                    </div>

                    <!-- 5. BANNER UTAMA & DESKRIPSI WEBSITE (HALAMAN BERANDA / HERO SECTION) -->
                    <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 rounded-3 me-2" style="background-color: rgba(213, 168, 74, 0.2); color: #B3864E;">
                                <i class="bi bi-megaphone-fill fs-5"></i>
                            </span>
                            <div>
                                <h5 class="fw-bold text-dark m-0">5. Banner Utama & Deskripsi Website (Halaman Beranda)</h5>
                                <small class="text-muted">Kelola teks judul banner, deskripsi sambutan website, badge promo, dan tombol aksi yang tampil pada bagian depan website.</small>
                            </div>
                        </div>

                        <!-- Deskripsi Web / Sambutan Utama -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label small fw-bold text-secondary m-0">
                                    Deskripsi Web / Paragraf Sambutan Utama <span class="text-danger">*</span>
                                </label>
                                <span class="badge bg-secondary-subtle text-secondary" style="font-size: 10px;">Mendukung Tag &lt;b&gt;teks tebal&lt;/b&gt;</span>
                            </div>
                            <textarea name="hero_description" id="inputHeroDescription" class="form-control rounded-3" rows="3" placeholder="Solusi praktis bikin undangan website & video untuk Pernikahan, Khitanan, Aqiqah, Ulang Tahun..." oninput="updateMockupPreview()"><?= htmlspecialchars($settings['hero_description'] ?? 'Solusi praktis bikin undangan website & video untuk <b>Pernikahan, Khitanan, Aqiqah, Ulang Tahun</b>, hingga peresmian acara. Bebas sebar nama tamu tanpa batas, gratis uji coba!') ?></textarea>
                            <div class="form-text" style="font-size: 11px;">
                                Teks ini ditampilkan tepat di bawah judul besar pada halaman utama pengunjung. Anda bisa memberi efek tulisan tebal dengan membungkus kata menggunakan <code>&lt;b&gt;kata tebal&lt;/b&gt;</code>.
                            </div>
                        </div>

                        <!-- Badge Teks di Atas Judul -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Teks Badge Sorotan (Di Atas Judul)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-stars text-primary"></i></span>
                                <input type="text" name="hero_badge" id="inputHeroBadge" class="form-control rounded-end-3" value="<?= htmlspecialchars($settings['hero_badge'] ?? 'Platform Undangan Digital No. 1') ?>" placeholder="Platform Undangan Digital No. 1" oninput="updateMockupPreview()">
                            </div>
                        </div>

                        <!-- Judul Banner 3 Bagian -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-secondary">Judul Baris 1</label>
                                <input type="text" name="hero_title_line1" id="inputHeroTitle1" class="form-control rounded-3" value="<?= htmlspecialchars($settings['hero_title_line1'] ?? 'Buat Undangan') ?>" placeholder="Buat Undangan" oninput="updateMockupPreview()">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-secondary">Teks Sorot (Warna Emas)</label>
                                <input type="text" name="hero_title_highlight" id="inputHeroTitleHighlight" class="form-control rounded-3" value="<?= htmlspecialchars($settings['hero_title_highlight'] ?? 'Digital Impianmu') ?>" placeholder="Digital Impianmu" oninput="updateMockupPreview()">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-secondary">Judul Baris 2</label>
                                <input type="text" name="hero_title_line2" id="inputHeroTitle2" class="form-control rounded-3" value="<?= htmlspecialchars($settings['hero_title_line2'] ?? 'Hanya 5 Menit!') ?>" placeholder="Hanya 5 Menit!" oninput="updateMockupPreview()">
                            </div>
                        </div>

                        <!-- Teks Tombol CTA -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Teks Tombol Registrasi Utama</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-cursor-fill text-primary"></i></span>
                                    <input type="text" name="hero_btn_register_text" id="inputHeroBtnRegister" class="form-control rounded-end-3" value="<?= htmlspecialchars($settings['hero_btn_register_text'] ?? 'Buat Undangan Gratis') ?>" placeholder="Buat Undangan Gratis" oninput="updateMockupPreview()">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Teks Tombol WhatsApp Admin</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-whatsapp text-success"></i></span>
                                    <input type="text" name="hero_btn_wa_text" id="inputHeroBtnWa" class="form-control rounded-end-3" value="<?= htmlspecialchars($settings['hero_btn_wa_text'] ?? 'Dibuatin Admin Aja') ?>" placeholder="Dibuatin Admin Aja" oninput="updateMockupPreview()">
                                </div>
                            </div>
                        </div>

                        <!-- Teks Promo & Anti Rugi -->
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-secondary">Label Badge Promo</label>
                                <input type="text" name="hero_pill_badge" id="inputHeroPillBadge" class="form-control rounded-3" value="<?= htmlspecialchars($settings['hero_pill_badge'] ?? 'Anti Rugi') ?>" placeholder="Anti Rugi" oninput="updateMockupPreview()">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label small fw-bold text-secondary">Teks Keterangan Garansi / Promo</label>
                                <input type="text" name="hero_pill_text" id="inputHeroPillText" class="form-control rounded-3" value="<?= htmlspecialchars($settings['hero_pill_text'] ?? 'Dibuatin admin dulu, bayar setelah jadi & suka hasilnya!') ?>" placeholder="Dibuatin admin dulu, bayar setelah jadi & suka hasilnya!" oninput="updateMockupPreview()">
                            </div>
                        </div>
                    </div>

                    <!-- 6. PENGATURAN COUNTER STATISTIK BERANDA -->
                    <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                            <div class="d-flex align-items-center">
                                <span class="p-2 rounded-3 me-2" style="background-color: rgba(13, 110, 253, 0.15); color: #0d6efd;">
                                    <i class="bi bi-graph-up-arrow fs-5"></i>
                                </span>
                                <div>
                                    <h5 class="fw-bold text-dark m-0">6. Counter Statistik Halaman Beranda (Stats Counter)</h5>
                                    <small class="text-muted">Atur angka dan label counter yang tampil di beranda (bisa otomatis dari database maupun edit manual).</small>
                                </div>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" role="switch" name="stats_enabled" id="switchStatsEnabled" value="1" <?= ($statsData['enabled'] ?? true) ? 'checked' : '' ?> onchange="updateStatsPreview()">
                                <label class="form-check-label small fw-bold text-secondary" for="switchStatsEnabled">Tampilkan Counter</label>
                            </div>
                        </div>

                        <!-- Data Riil Database Saat Ini (Status Bar) -->
                        <div class="alert alert-primary bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-4 p-3 mb-4">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <h6 class="fw-bold text-primary mb-1 d-flex align-items-center">
                                        <i class="bi bi-database-check me-2"></i> Data Riil Sistem Saat Ini (Real-time Database)
                                    </h6>
                                    <span class="small text-muted" style="font-size: 11.5px;">Jumlah data asli yang tercatat dalam sistem saat ini:</span>
                                </div>
                                <div class="d-flex gap-2 flex-wrap">
                                    <span class="badge bg-white text-dark border px-3 py-2 rounded-pill shadow-xs">
                                        <i class="bi bi-envelope-paper text-primary me-1"></i> <b class="text-primary"><?= number_format($realCounts['total_events'] ?? 0, 0, ',', '.') ?></b> Undangan Dibuat
                                    </span>
                                    <span class="badge bg-white text-dark border px-3 py-2 rounded-pill shadow-xs">
                                        <i class="bi bi-people text-success me-1"></i> <b class="text-success"><?= number_format($realCounts['total_guests'] ?? 0, 0, ',', '.') ?></b> Tamu Tersebar
                                    </span>
                                    <span class="badge bg-white text-dark border px-3 py-2 rounded-pill shadow-xs">
                                        <i class="bi bi-palette text-warning me-1"></i> <b class="text-warning"><?= number_format($realCounts['total_templates'] ?? 0, 0, ',', '.') ?></b> Tema Aktif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Preset Cepat Semua Statistik -->
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 p-3 rounded-3 bg-light mb-4 border">
                            <div class="small fw-bold text-secondary">
                                <i class="bi bi-magic me-1 text-primary"></i> Preset Cepat Mode Statistik:
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="applyStatsPreset('manual')">
                                    <i class="bi bi-pencil-square me-1"></i> Semua Manual
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3" onclick="applyStatsPreset('auto')">
                                    <i class="bi bi-cpu me-1"></i> Semua Otomatis DB
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="applyStatsPreset('auto_plus_base')">
                                    <i class="bi bi-rocket-takeoff me-1"></i> Smart Booster (Dasar + DB)
                                </button>
                            </div>
                        </div>

                        <!-- 4 Item Counter -->
                        <div class="row g-3">
                            <!-- Item 1: Undangan Dibuat -->
                            <div class="col-md-6">
                                <div class="card h-100 border rounded-3 p-3 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-primary rounded-pill px-2.5 py-1">Statistik 1</span>
                                        <span class="small text-muted" style="font-size: 11px;">Terkait Jumlah Undangan</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold text-secondary mb-1">Sumber Data</label>
                                        <select name="stats_item1_mode" id="statsItem1Mode" class="form-select form-select-sm rounded-3" onchange="toggleStatsItemMode(1); updateStatsPreview();">
                                            <option value="manual" <?= ($statsData['item1']['mode'] ?? '') === 'manual' ? 'selected' : '' ?>>✍️ Manual / Teks Kustom Bebas</option>
                                            <option value="auto" <?= ($statsData['item1']['mode'] ?? '') === 'auto' ? 'selected' : '' ?>>⚡ Otomatis Data Asli DB (<?= number_format($realCounts['total_events'] ?? 0, 0, ',', '.') ?>)</option>
                                            <option value="auto_plus_base" <?= ($statsData['item1']['mode'] ?? '') === 'auto_plus_base' ? 'selected' : '' ?>>🚀 Smart Booster (Angka Dasar + Real DB)</option>
                                        </select>
                                    </div>

                                    <!-- Nilai Manual -->
                                    <div class="mb-2" id="groupItem1Manual">
                                        <label class="form-label small fw-bold text-secondary mb-1">Nilai / Teks Counter</label>
                                        <input type="text" name="stats_item1_value" id="statsItem1Value" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item1']['raw_value'] ?? '> 1.400.000') ?>" placeholder="Contoh: > 1.400.000" oninput="updateStatsPreview()">
                                    </div>

                                    <!-- Nilai Booster Base -->
                                    <div class="mb-2 d-none" id="groupItem1Base">
                                        <label class="form-label small fw-bold text-secondary mb-1">Angka Dasar Booster (Base Count)</label>
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="stats_item1_base" id="statsItem1Base" class="form-control rounded-start-3" value="<?= htmlspecialchars($statsData['item1']['base'] ?? 1400000) ?>" placeholder="1400000" oninput="updateStatsPreview()">
                                            <span class="input-group-text bg-white small text-muted">+ <?= (int)($realCounts['total_events'] ?? 0) ?> DB</span>
                                        </div>
                                    </div>

                                    <!-- Prefix & Suffix (Untuk Auto & Booster) -->
                                    <div class="row g-2 mb-2 d-none" id="groupItem1Affix">
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-secondary mb-1" style="font-size: 10px;">Awalan (Prefix)</label>
                                            <input type="text" name="stats_item1_prefix" id="statsItem1Prefix" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item1']['prefix'] ?? '> ') ?>" placeholder="> " oninput="updateStatsPreview()">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-secondary mb-1" style="font-size: 10px;">Akhiran (Suffix)</label>
                                            <input type="text" name="stats_item1_suffix" id="statsItem1Suffix" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item1']['suffix'] ?? '') ?>" placeholder="+" oninput="updateStatsPreview()">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label small fw-bold text-secondary mb-1">Label Keterangan</label>
                                        <input type="text" name="stats_item1_label" id="statsItem1Label" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item1']['label'] ?? 'Undangan Dibuat') ?>" placeholder="Undangan Dibuat" oninput="updateStatsPreview()">
                                    </div>
                                </div>
                            </div>

                            <!-- Item 2: Tamu Undangan Tersebar -->
                            <div class="col-md-6">
                                <div class="card h-100 border rounded-3 p-3 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-success rounded-pill px-2.5 py-1">Statistik 2</span>
                                        <span class="small text-muted" style="font-size: 11px;">Terkait Tamu Undangan</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold text-secondary mb-1">Sumber Data</label>
                                        <select name="stats_item2_mode" id="statsItem2Mode" class="form-select form-select-sm rounded-3" onchange="toggleStatsItemMode(2); updateStatsPreview();">
                                            <option value="manual" <?= ($statsData['item2']['mode'] ?? '') === 'manual' ? 'selected' : '' ?>>✍️ Manual / Teks Kustom Bebas</option>
                                            <option value="auto" <?= ($statsData['item2']['mode'] ?? '') === 'auto' ? 'selected' : '' ?>>⚡ Otomatis Data Asli DB (<?= number_format($realCounts['total_guests'] ?? 0, 0, ',', '.') ?>)</option>
                                            <option value="auto_plus_base" <?= ($statsData['item2']['mode'] ?? '') === 'auto_plus_base' ? 'selected' : '' ?>>🚀 Smart Booster (Angka Dasar + Real DB)</option>
                                        </select>
                                    </div>

                                    <div class="mb-2" id="groupItem2Manual">
                                        <label class="form-label small fw-bold text-secondary mb-1">Nilai / Teks Counter</label>
                                        <input type="text" name="stats_item2_value" id="statsItem2Value" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item2']['raw_value'] ?? '> 4.5 Juta') ?>" placeholder="Contoh: > 4.5 Juta" oninput="updateStatsPreview()">
                                    </div>

                                    <div class="mb-2 d-none" id="groupItem2Base">
                                        <label class="form-label small fw-bold text-secondary mb-1">Angka Dasar Booster (Base Count)</label>
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="stats_item2_base" id="statsItem2Base" class="form-control rounded-start-3" value="<?= htmlspecialchars($statsData['item2']['base'] ?? 4500000) ?>" placeholder="4500000" oninput="updateStatsPreview()">
                                            <span class="input-group-text bg-white small text-muted">+ <?= (int)($realCounts['total_guests'] ?? 0) ?> DB</span>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2 d-none" id="groupItem2Affix">
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-secondary mb-1" style="font-size: 10px;">Awalan (Prefix)</label>
                                            <input type="text" name="stats_item2_prefix" id="statsItem2Prefix" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item2']['prefix'] ?? '> ') ?>" placeholder="> " oninput="updateStatsPreview()">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-secondary mb-1" style="font-size: 10px;">Akhiran (Suffix)</label>
                                            <input type="text" name="stats_item2_suffix" id="statsItem2Suffix" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item2']['suffix'] ?? '') ?>" placeholder="" oninput="updateStatsPreview()">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label small fw-bold text-secondary mb-1">Label Keterangan</label>
                                        <input type="text" name="stats_item2_label" id="statsItem2Label" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item2']['label'] ?? 'Tamu Undangan Tersebar') ?>" placeholder="Tamu Undangan Tersebar" oninput="updateStatsPreview()">
                                    </div>
                                </div>
                            </div>

                            <!-- Item 3: Tema Siap Pakai -->
                            <div class="col-md-6">
                                <div class="card h-100 border rounded-3 p-3 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-warning text-dark rounded-pill px-2.5 py-1">Statistik 3</span>
                                        <span class="small text-muted" style="font-size: 11px;">Terkait Koleksi Tema</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold text-secondary mb-1">Sumber Data</label>
                                        <select name="stats_item3_mode" id="statsItem3Mode" class="form-select form-select-sm rounded-3" onchange="toggleStatsItemMode(3); updateStatsPreview();">
                                            <option value="manual" <?= ($statsData['item3']['mode'] ?? '') === 'manual' ? 'selected' : '' ?>>✍️ Manual / Teks Kustom Bebas</option>
                                            <option value="auto" <?= ($statsData['item3']['mode'] ?? '') === 'auto' ? 'selected' : '' ?>>⚡ Otomatis Data Asli DB (<?= number_format($realCounts['total_templates'] ?? 0, 0, ',', '.') ?>)</option>
                                            <option value="auto_plus_base" <?= ($statsData['item3']['mode'] ?? '') === 'auto_plus_base' ? 'selected' : '' ?>>🚀 Smart Booster (Angka Dasar + Real DB)</option>
                                        </select>
                                    </div>

                                    <div class="mb-2" id="groupItem3Manual">
                                        <label class="form-label small fw-bold text-secondary mb-1">Nilai / Teks Counter</label>
                                        <input type="text" name="stats_item3_value" id="statsItem3Value" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item3']['raw_value'] ?? '100+') ?>" placeholder="Contoh: 100+" oninput="updateStatsPreview()">
                                    </div>

                                    <div class="mb-2 d-none" id="groupItem3Base">
                                        <label class="form-label small fw-bold text-secondary mb-1">Angka Dasar Booster (Base Count)</label>
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="stats_item3_base" id="statsItem3Base" class="form-control rounded-start-3" value="<?= htmlspecialchars($statsData['item3']['base'] ?? 100) ?>" placeholder="100" oninput="updateStatsPreview()">
                                            <span class="input-group-text bg-white small text-muted">+ <?= (int)($realCounts['total_templates'] ?? 0) ?> DB</span>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2 d-none" id="groupItem3Affix">
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-secondary mb-1" style="font-size: 10px;">Awalan (Prefix)</label>
                                            <input type="text" name="stats_item3_prefix" id="statsItem3Prefix" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item3']['prefix'] ?? '') ?>" placeholder="" oninput="updateStatsPreview()">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-secondary mb-1" style="font-size: 10px;">Akhiran (Suffix)</label>
                                            <input type="text" name="stats_item3_suffix" id="statsItem3Suffix" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item3']['suffix'] ?? '+') ?>" placeholder="+" oninput="updateStatsPreview()">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label small fw-bold text-secondary mb-1">Label Keterangan</label>
                                        <input type="text" name="stats_item3_label" id="statsItem3Label" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item3']['label'] ?? 'Tema Siap Pakai') ?>" placeholder="Tema Siap Pakai" oninput="updateStatsPreview()">
                                    </div>
                                </div>
                            </div>

                            <!-- Item 4: Bantuan Admin & Support -->
                            <div class="col-md-6">
                                <div class="card h-100 border rounded-3 p-3 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-secondary rounded-pill px-2.5 py-1">Statistik 4</span>
                                        <span class="small text-muted" style="font-size: 11px;">Layanan / Dukungan</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold text-secondary mb-1">Nilai / Teks Counter</label>
                                        <input type="text" name="stats_item4_value" id="statsItem4Value" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item4']['raw_value'] ?? '24/7') ?>" placeholder="Contoh: 24/7" oninput="updateStatsPreview()">
                                    </div>
                                    <div class="mt-auto">
                                        <label class="form-label small fw-bold text-secondary mb-1">Label Keterangan</label>
                                        <input type="text" name="stats_item4_label" id="statsItem4Label" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($statsData['item4']['label'] ?? 'Bantuan Admin & Support') ?>" placeholder="Bantuan Admin & Support" oninput="updateStatsPreview()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="d-flex justify-content-end gap-2 mb-5">
                        <button type="reset" class="btn btn-light rounded-pill px-4 py-2.5 fw-semibold text-secondary">
                            Reset Formulir
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2.5 fw-semibold shadow-sm d-flex align-items-center">
                            <i class="bi bi-floppy-fill me-2"></i> Simpan Semua Perubahan
                        </button>
                    </div>

                </div>

                <!-- Kolom Kanan: Real-Time Live Preview Mockup -->
                <div class="col-lg-4">
                    <div class="position-sticky" style="top: 90px;">
                        
                        <!-- Mockup 1: Tab Browser -->
                        <div class="card border-0 rounded-4 shadow-sm bg-white p-3 mb-4">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <i class="bi bi-browser-chrome text-primary me-2"></i> Live Preview: Tab Browser
                            </h6>
                            
                            <!-- Tab Bar Simulation -->
                            <div class="bg-light p-2 rounded-top-3 border border-bottom-0 d-flex align-items-center gap-2">
                                <div class="d-flex gap-1 me-1">
                                    <span class="rounded-circle bg-danger d-inline-block" style="width: 9px; height: 9px;"></span>
                                    <span class="rounded-circle bg-warning d-inline-block" style="width: 9px; height: 9px;"></span>
                                    <span class="rounded-circle bg-success d-inline-block" style="width: 9px; height: 9px;"></span>
                                </div>
                                <div class="bg-white rounded-2 px-2.5 py-1 d-flex align-items-center gap-2 border shadow-xs" style="max-width: 220px;">
                                    <img id="previewFaviconTab" src="<?= site_favicon_url() ?: 'https://cdn-icons-png.flaticon.com/512/833/833472.png' ?>" class="rounded-circle" style="width: 15px; height: 15px; object-fit: contain;">
                                    <span id="previewTitleTab" class="small fw-semibold text-truncate text-dark" style="font-size: 11px;">
                                        <?= site_title('Home') ?>
                                    </span>
                                </div>
                            </div>
                            <div class="bg-white p-2.5 rounded-bottom-3 border border-top-0 small text-muted text-center" style="font-size: 11px;">
                                Tab browser otomatis memperbarui favicon dan title.
                            </div>
                        </div>

                        <!-- Mockup 2: Header Navbar Website (Mode Terang & Mode Gelap) -->
                        <div class="card border-0 rounded-4 shadow-sm bg-white p-3 mb-4">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <i class="bi bi-display me-2" style="color: #D4AA7B;"></i> Live Preview: Logo di Navbar
                            </h6>

                            <!-- Preview Navbar Mode Terang -->
                            <div class="border rounded-3 p-3 mb-3 shadow-xs" style="background-color: #F7F5F0;">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge rounded-pill px-2.5 py-1 small fw-semibold" style="background-color: #FFFFFF; color: #17242A; font-size: 10px; border: 1px solid #DDE2E5;">
                                        <i class="bi bi-sun-fill text-warning me-1"></i> Mode Terang (Light Navbar)
                                    </span>
                                    <span class="badge bg-secondary-subtle text-secondary small" style="font-size: 9px;">#F7F5F0</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between p-2 bg-white rounded-3 border">
                                    <div class="d-flex align-items-center gap-2" id="navbarLightBrandPreview">
                                        <!-- Dynamic Content rendered by JS -->
                                    </div>
                                    <div class="d-flex gap-1.5">
                                        <span class="badge rounded-pill px-2 py-1 small text-dark" style="background-color: #F7F5F0; font-size: 10px;">Menu</span>
                                        <span class="badge rounded-pill px-2 py-1 small" style="background-color: #D4AA7B; color: #fff; font-size: 10px;">Login</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Preview Navbar Mode Gelap -->
                            <div class="border rounded-3 p-3 shadow-xs" style="background-color: #17242A; border-color: #2D414B !important;">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge rounded-pill px-2.5 py-1 small fw-semibold" style="background-color: #273842; color: #F7F5F0; font-size: 10px; border: 1px solid #364B56;">
                                        <i class="bi bi-moon-stars-fill text-info me-1"></i> Mode Gelap (Dark Navbar)
                                    </span>
                                    <span class="badge small" style="background-color: #1F2E35; color: #A0B2BA; font-size: 9px;">#17242A</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between p-2 rounded-3 border" style="background-color: #1F2E35; border-color: rgba(247, 245, 240, 0.12) !important;">
                                    <div class="d-flex align-items-center gap-2" id="navbarDarkBrandPreview">
                                        <!-- Dynamic Content rendered by JS -->
                                    </div>
                                    <div class="d-flex gap-1.5">
                                        <span class="badge rounded-pill px-2 py-1 small" style="background-color: #273842; color: #A0B2BA; font-size: 10px;">Menu</span>
                                        <span class="badge rounded-pill px-2 py-1 small" style="background-color: #D4AA7B; color: #fff; font-size: 10px;">Login</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mockup 3: Banner & Deskripsi Web (Hero Section) -->
                        <div class="card border-0 rounded-4 shadow-sm bg-white p-3 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-bold text-dark m-0 d-flex align-items-center">
                                    <i class="bi bi-layout-text-window-reverse me-2" style="color: #D4AA7B;"></i> Live Preview: Deskripsi Web
                                </h6>
                                <span class="badge rounded-pill bg-warning-subtle text-warning small fw-semibold" style="font-size: 10px;">Real-Time</span>
                            </div>

                            <!-- Mini Hero Preview Box (Gelap sesuai tampilan halaman beranda) -->
                            <div class="p-3 rounded-4 border shadow-xs" style="background-color: #19272E; color: #F7F5F0; border-color: #2D414B !important;">
                                <!-- Badge Preview -->
                                <div class="mb-2">
                                    <span class="badge rounded-pill px-2.5 py-1 fw-semibold" style="background-color: rgba(213, 168, 74, 0.18); color: #D5A84A !important; font-size: 10px; border: 1px solid rgba(213, 168, 74, 0.3);" id="previewHeroBadge">
                                        <i class="bi bi-stars me-1"></i> <?= htmlspecialchars($settings['hero_badge'] ?? 'Platform Undangan Digital No. 1') ?>
                                    </span>
                                </div>
                                <!-- Title Preview -->
                                <h6 class="fw-bold mb-2 lh-sm" style="color: #F7F5F0; font-size: 14px;">
                                    <span id="previewHeroTitle1"><?= htmlspecialchars($settings['hero_title_line1'] ?? 'Buat Undangan') ?></span><br>
                                    <span style="color: #D5A84A;" id="previewHeroTitleHighlight"><?= htmlspecialchars($settings['hero_title_highlight'] ?? 'Digital Impianmu') ?></span><br>
                                    <span id="previewHeroTitle2"><?= htmlspecialchars($settings['hero_title_line2'] ?? 'Hanya 5 Menit!') ?></span>
                                </h6>
                                <!-- Description Preview -->
                                <div class="small mb-3" style="color: #A0B2BA; font-size: 11px; line-height: 1.45;" id="previewHeroDescription">
                                    <?= $settings['hero_description'] ?? 'Solusi praktis bikin undangan website & video untuk <b>Pernikahan, Khitanan, Aqiqah, Ulang Tahun</b>, hingga peresmian acara. Bebas sebar nama tamu tanpa batas, gratis uji coba!' ?>
                                </div>
                                <!-- Buttons Preview -->
                                <div class="d-flex flex-wrap gap-1.5 mb-2.5">
                                    <span class="btn btn-sm btn-primary-custom py-1 px-2.5 fw-semibold" style="font-size: 9.5px; border-radius: 20px;" id="previewHeroBtnRegister">
                                        <span id="previewHeroBtnRegisterText"><?= htmlspecialchars($settings['hero_btn_register_text'] ?? 'Buat Undangan Gratis') ?></span> &rarr;
                                    </span>
                                    <span class="btn btn-sm py-1 px-2.5 fw-semibold d-inline-flex align-items-center" style="font-size: 9.5px; border-radius: 20px; background-color: rgba(255,255,255,0.08); color: #fff; border: 1px solid rgba(255,255,255,0.15);">
                                        <i class="bi bi-whatsapp text-success me-1"></i> <span id="previewHeroBtnWaText"><?= htmlspecialchars($settings['hero_btn_wa_text'] ?? 'Dibuatin Admin Aja') ?></span>
                                    </span>
                                </div>
                                <!-- Anti Rugi Pill Preview -->
                                <div class="p-1.5 px-2 rounded-2 d-flex align-items-center gap-1.5 border" style="background-color: #ffffff; color: #17242A; font-size: 9px; border-color: #E2E8F0 !important;">
                                    <span class="badge bg-danger text-white px-1.5 py-0.5" style="font-size: 8px;" id="previewHeroPillBadge"><?= htmlspecialchars($settings['hero_pill_badge'] ?? 'Anti Rugi') ?></span>
                                    <span class="text-truncate text-muted" id="previewHeroPillText"><?= htmlspecialchars($settings['hero_pill_text'] ?? 'Dibuatin admin dulu, bayar setelah jadi & suka hasilnya!') ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Mockup 4: Counter Statistik Beranda -->
                        <div class="card border-0 rounded-4 shadow-sm bg-white p-3 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="fw-bold text-dark m-0 d-flex align-items-center">
                                    <i class="bi bi-speedometer2 text-primary me-2"></i> Live Preview: Counter Beranda
                                </h6>
                                <span class="badge rounded-pill bg-primary-subtle text-primary small fw-semibold" style="font-size: 10px;">Real-Time</span>
                            </div>
                            <small class="text-muted d-block mb-3" style="font-size: 11px;">Simulasi bar counter di bawah hero section:</small>

                            <!-- Counter Bar Simulation -->
                            <div id="statsPreviewBox" class="p-3 bg-white border rounded-3 shadow-xs">
                                <div class="row text-center gy-3" id="statsPreviewRow">
                                    <div class="col-6 col-md-3">
                                        <div class="fw-extrabold text-primary mb-0" style="font-size: 13px;" id="prevStat1Val">> 1.400.000</div>
                                        <div class="text-muted" style="font-size: 9.5px;" id="prevStat1Lbl">Undangan Dibuat</div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="fw-extrabold text-primary mb-0" style="font-size: 13px;" id="prevStat2Val">> 4.5 Juta</div>
                                        <div class="text-muted" style="font-size: 9.5px;" id="prevStat2Lbl">Tamu Undangan Tersebar</div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="fw-extrabold text-primary mb-0" style="font-size: 13px;" id="prevStat3Val">100+</div>
                                        <div class="text-muted" style="font-size: 9.5px;" id="prevStat3Lbl">Tema Siap Pakai</div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="fw-extrabold text-primary mb-0" style="font-size: 13px;" id="prevStat4Val">24/7</div>
                                        <div class="text-muted" style="font-size: 9.5px;" id="prevStat4Lbl">Bantuan Admin & Support</div>
                                    </div>
                                </div>
                                <div id="statsDisabledNotice" class="text-center py-2 text-muted small d-none" style="font-size: 11px;">
                                    <i class="bi bi-eye-slash me-1"></i> Bagian counter dinonaktifkan (disembunyikan dari beranda)
                                </div>
                            </div>
                        </div>

                        <!-- Card Panduan Cepat -->
                        <div class="card border-0 rounded-4 shadow-sm p-3" style="background-color: rgba(212, 170, 123, 0.15); border-left: 4px solid #D4AA7B !important;">
                            <h6 class="fw-bold mb-1" style="color: #936B36;"><i class="bi bi-lightbulb-fill me-1"></i> Informasi Superadmin</h6>
                            <p class="small m-0 text-muted" style="font-size: 12px; line-height: 1.5;">
                                Perubahan nama web, logo mode terang, logo mode gelap, dan favicon langsung berlaku seketika di seluruh halaman publik, dashboard pengguna, panel admin, serta undangan online tamu tanpa perlu restart server.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
</div>

<script>
window.tempLogoLightSrc = "<?= site_logo_url('light') ?>";
window.tempLogoDarkSrc = "<?= site_logo_url('dark') ?>";

function toggleLogoInput() {
    const isImage = document.getElementById('typeImage').checked;
    const uploadSec = document.getElementById('logoUploadSection');
    if (isImage) {
        uploadSec.classList.remove('d-none');
    } else {
        uploadSec.classList.add('d-none');
    }
    updateMockupPreview();
}

function previewLogoLightFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            window.tempLogoLightSrc = e.target.result;
            const thumb = document.getElementById('thumbLogoLight');
            if (thumb) thumb.src = e.target.result;
            document.getElementById('typeImage').checked = true;
            toggleLogoInput();
            updateMockupPreview();
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewLogoLightUrl(url) {
    if (url && url.trim() !== '') {
        window.tempLogoLightSrc = url;
        const thumb = document.getElementById('thumbLogoLight');
        if (thumb) thumb.src = url;
        document.getElementById('typeImage').checked = true;
        toggleLogoInput();
        updateMockupPreview();
    }
}

function previewLogoDarkFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            window.tempLogoDarkSrc = e.target.result;
            const thumb = document.getElementById('thumbLogoDark');
            if (thumb) thumb.src = e.target.result;
            document.getElementById('typeImage').checked = true;
            toggleLogoInput();
            updateMockupPreview();
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewLogoDarkUrl(url) {
    if (url && url.trim() !== '') {
        window.tempLogoDarkSrc = url;
        const thumb = document.getElementById('thumbLogoDark');
        if (thumb) thumb.src = url;
        document.getElementById('typeImage').checked = true;
        toggleLogoInput();
        updateMockupPreview();
    }
}

function previewFaviconFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewFaviconTab').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewFaviconUrl(url) {
    if (url && url.trim() !== '') {
        document.getElementById('previewFaviconTab').src = url;
    }
}

function updateMockupPreview() {
    const appName = document.getElementById('inputAppName').value.trim() || 'PENDAR LOKA';
    const appTagline = document.getElementById('inputAppTagline').value.trim() || 'Platform Undangan Digital';
    const titleFormat = document.getElementById('inputTitleFormat').value.trim() || '{title} | {app_name}';
    const isImage = document.getElementById('typeImage').checked;

    // 1. Update Title Mockup Tab
    let formattedTitle = titleFormat
        .replace('{title}', 'Home')
        .replace('{app_name}', appName)
        .replace('{tagline}', appTagline);
    document.getElementById('previewTitleTab').innerText = formattedTitle;

    // 2. Update Navbar Logo Mockup (Light & Dark)
    const navbarLightBrand = document.getElementById('navbarLightBrandPreview');
    const navbarDarkBrand = document.getElementById('navbarDarkBrandPreview');

    const logoLight = window.tempLogoLightSrc || window.tempLogoDarkSrc || "";
    const logoDark = window.tempLogoDarkSrc || window.tempLogoLightSrc || "";

    if (isImage && logoLight && logoLight !== '') {
        navbarLightBrand.innerHTML = `<img src="${logoLight}" alt="Logo Light" style="height: 60px; max-width: 260px; object-fit: contain;">`;
    } else {
        navbarLightBrand.innerHTML = `
            <span class="p-1 rounded-2 text-white d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background-color: #D4AA7B;">
                <i class="bi bi-envelope-paper-heart-fill fs-5"></i>
            </span>
            <span class="fw-bold text-dark fs-6" style="letter-spacing: -0.3px;">${appName}</span>
        `;
    }

    if (isImage && logoDark && logoDark !== '') {
        navbarDarkBrand.innerHTML = `<img src="${logoDark}" alt="Logo Dark" style="height: 60px; max-width: 260px; object-fit: contain;">`;
    } else {
        navbarDarkBrand.innerHTML = `
            <span class="p-1 rounded-2 text-white d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background-color: #D4AA7B;">
                <i class="bi bi-envelope-paper-heart-fill fs-5"></i>
            </span>
            <span class="fw-bold text-white fs-6" style="letter-spacing: -0.3px;">${appName}</span>
        `;
    }

    // 3. Update Hero Banner & Deskripsi Website Mockup
    const heroBadgeInput = document.getElementById('inputHeroBadge');
    if (heroBadgeInput) {
        document.getElementById('previewHeroBadge').innerHTML = `<i class="bi bi-stars me-1"></i> ${heroBadgeInput.value.trim() || 'Platform Undangan Digital No. 1'}`;
    }

    const title1 = document.getElementById('inputHeroTitle1');
    if (title1) {
        document.getElementById('previewHeroTitle1').innerText = title1.value.trim() || 'Buat Undangan';
    }

    const titleHigh = document.getElementById('inputHeroTitleHighlight');
    if (titleHigh) {
        document.getElementById('previewHeroTitleHighlight').innerText = titleHigh.value.trim() || 'Digital Impianmu';
    }

    const title2 = document.getElementById('inputHeroTitle2');
    if (title2) {
        document.getElementById('previewHeroTitle2').innerText = title2.value.trim() || 'Hanya 5 Menit!';
    }

    const heroDesc = document.getElementById('inputHeroDescription');
    if (heroDesc) {
        const rawDesc = heroDesc.value.trim() || 'Solusi praktis bikin undangan website & video untuk <b>Pernikahan, Khitanan, Aqiqah, Ulang Tahun</b>, hingga peresmian acara. Bebas sebar nama tamu tanpa batas, gratis uji coba!';
        document.getElementById('previewHeroDescription').innerHTML = rawDesc;
    }

    const btnReg = document.getElementById('inputHeroBtnRegister');
    if (btnReg) {
        document.getElementById('previewHeroBtnRegisterText').innerText = btnReg.value.trim() || 'Buat Undangan Gratis';
    }

    const btnWa = document.getElementById('inputHeroBtnWa');
    if (btnWa) {
        document.getElementById('previewHeroBtnWaText').innerText = btnWa.value.trim() || 'Dibuatin Admin Aja';
    }

    const pillBadge = document.getElementById('inputHeroPillBadge');
    if (pillBadge) {
        document.getElementById('previewHeroPillBadge').innerText = pillBadge.value.trim() || 'Anti Rugi';
    }

    const pillText = document.getElementById('inputHeroPillText');
    if (pillText) {
        document.getElementById('previewHeroPillText').innerText = pillText.value.trim() || 'Dibuatin admin dulu, bayar setelah jadi & suka hasilnya!';
    }
}

// ==========================================
// STATS COUNTER PREVIEW & CONTROLLER
// ==========================================
const realDatabaseCounts = {
    events: <?= (int)($realCounts['total_events'] ?? 0) ?>,
    guests: <?= (int)($realCounts['total_guests'] ?? 0) ?>,
    templates: <?= (int)($realCounts['total_templates'] ?? 0) ?>
};

function formatNumberId(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}

function toggleStatsItemMode(itemNum) {
    const select = document.getElementById('statsItem' + itemNum + 'Mode');
    if (!select) return;
    const mode = select.value;
    const manualGroup = document.getElementById('groupItem' + itemNum + 'Manual');
    const baseGroup = document.getElementById('groupItem' + itemNum + 'Base');
    const affixGroup = document.getElementById('groupItem' + itemNum + 'Affix');

    if (mode === 'manual') {
        if (manualGroup) manualGroup.classList.remove('d-none');
        if (baseGroup) baseGroup.classList.add('d-none');
        if (affixGroup) affixGroup.classList.add('d-none');
    } else if (mode === 'auto') {
        if (manualGroup) manualGroup.classList.add('d-none');
        if (baseGroup) baseGroup.classList.add('d-none');
        if (affixGroup) affixGroup.classList.remove('d-none');
    } else if (mode === 'auto_plus_base') {
        if (manualGroup) manualGroup.classList.add('d-none');
        if (baseGroup) baseGroup.classList.remove('d-none');
        if (affixGroup) affixGroup.classList.remove('d-none');
    }
}

function applyStatsPreset(mode) {
    [1, 2, 3].forEach(function(i) {
        const select = document.getElementById('statsItem' + i + 'Mode');
        if (select) {
            select.value = mode;
            toggleStatsItemMode(i);
        }
    });
    updateStatsPreview();
}

function updateStatsPreview() {
    const isEnabled = document.getElementById('switchStatsEnabled') ? document.getElementById('switchStatsEnabled').checked : true;
    const statsRow = document.getElementById('statsPreviewRow');
    const notice = document.getElementById('statsDisabledNotice');

    if (!isEnabled) {
        if (statsRow) statsRow.classList.add('d-none');
        if (notice) notice.classList.remove('d-none');
        return;
    } else {
        if (statsRow) statsRow.classList.remove('d-none');
        if (notice) notice.classList.add('d-none');
    }

    // Item 1
    const mode1El = document.getElementById('statsItem1Mode');
    if (mode1El) {
        const mode1 = mode1El.value;
        const pref1 = document.getElementById('statsItem1Prefix') ? document.getElementById('statsItem1Prefix').value : '> ';
        const suff1 = document.getElementById('statsItem1Suffix') ? document.getElementById('statsItem1Suffix').value : '';
        let val1 = document.getElementById('statsItem1Value') ? document.getElementById('statsItem1Value').value.trim() : '> 1.400.000';
        if (mode1 === 'auto') {
            val1 = pref1 + formatNumberId(realDatabaseCounts.events) + suff1;
        } else if (mode1 === 'auto_plus_base') {
            const base1 = parseInt(document.getElementById('statsItem1Base').value) || 0;
            val1 = pref1 + formatNumberId(base1 + realDatabaseCounts.events) + suff1;
        }
        const lbl1 = document.getElementById('statsItem1Label') ? document.getElementById('statsItem1Label').value.trim() : 'Undangan Dibuat';
        if (document.getElementById('prevStat1Val')) document.getElementById('prevStat1Val').innerText = val1 || '> 1.400.000';
        if (document.getElementById('prevStat1Lbl')) document.getElementById('prevStat1Lbl').innerText = lbl1 || 'Undangan Dibuat';
    }

    // Item 2
    const mode2El = document.getElementById('statsItem2Mode');
    if (mode2El) {
        const mode2 = mode2El.value;
        const pref2 = document.getElementById('statsItem2Prefix') ? document.getElementById('statsItem2Prefix').value : '> ';
        const suff2 = document.getElementById('statsItem2Suffix') ? document.getElementById('statsItem2Suffix').value : '';
        let val2 = document.getElementById('statsItem2Value') ? document.getElementById('statsItem2Value').value.trim() : '> 4.5 Juta';
        if (mode2 === 'auto') {
            val2 = pref2 + formatNumberId(realDatabaseCounts.guests) + suff2;
        } else if (mode2 === 'auto_plus_base') {
            const base2 = parseInt(document.getElementById('statsItem2Base').value) || 0;
            val2 = pref2 + formatNumberId(base2 + realDatabaseCounts.guests) + suff2;
        }
        const lbl2 = document.getElementById('statsItem2Label') ? document.getElementById('statsItem2Label').value.trim() : 'Tamu Undangan Tersebar';
        if (document.getElementById('prevStat2Val')) document.getElementById('prevStat2Val').innerText = val2 || '> 4.5 Juta';
        if (document.getElementById('prevStat2Lbl')) document.getElementById('prevStat2Lbl').innerText = lbl2 || 'Tamu Undangan Tersebar';
    }

    // Item 3
    const mode3El = document.getElementById('statsItem3Mode');
    if (mode3El) {
        const mode3 = mode3El.value;
        const pref3 = document.getElementById('statsItem3Prefix') ? document.getElementById('statsItem3Prefix').value : '';
        const suff3 = document.getElementById('statsItem3Suffix') ? document.getElementById('statsItem3Suffix').value : '+';
        let val3 = document.getElementById('statsItem3Value') ? document.getElementById('statsItem3Value').value.trim() : '100+';
        if (mode3 === 'auto') {
            val3 = pref3 + formatNumberId(realDatabaseCounts.templates) + suff3;
        } else if (mode3 === 'auto_plus_base') {
            const base3 = parseInt(document.getElementById('statsItem3Base').value) || 0;
            val3 = pref3 + formatNumberId(base3 + realDatabaseCounts.templates) + suff3;
        }
        const lbl3 = document.getElementById('statsItem3Label') ? document.getElementById('statsItem3Label').value.trim() : 'Tema Siap Pakai';
        if (document.getElementById('prevStat3Val')) document.getElementById('prevStat3Val').innerText = val3 || '100+';
        if (document.getElementById('prevStat3Lbl')) document.getElementById('prevStat3Lbl').innerText = lbl3 || 'Tema Siap Pakai';
    }

    // Item 4
    const val4 = document.getElementById('statsItem4Value') ? document.getElementById('statsItem4Value').value.trim() : '24/7';
    const lbl4 = document.getElementById('statsItem4Label') ? document.getElementById('statsItem4Label').value.trim() : 'Bantuan Admin & Support';
    if (document.getElementById('prevStat4Val')) document.getElementById('prevStat4Val').innerText = val4 || '24/7';
    if (document.getElementById('prevStat4Lbl')) document.getElementById('prevStat4Lbl').innerText = lbl4 || 'Bantuan Admin & Support';
}

// Initialize preview on page load
document.addEventListener('DOMContentLoaded', function() {
    updateMockupPreview();
    [1, 2, 3].forEach(toggleStatsItemMode);
    updateStatsPreview();
});

// Event Listeners for real-time typing
['inputAppName', 'inputAppTagline', 'inputTitleFormat', 'inputHeroDescription', 'inputHeroBadge', 
 'inputHeroTitle1', 'inputHeroTitleHighlight', 'inputHeroTitle2', 'inputHeroBtnRegister', 
 'inputHeroBtnWa', 'inputHeroPillBadge', 'inputHeroPillText',
 'statsItem1Value', 'statsItem1Base', 'statsItem1Label', 'statsItem1Prefix', 'statsItem1Suffix',
 'statsItem2Value', 'statsItem2Base', 'statsItem2Label', 'statsItem2Prefix', 'statsItem2Suffix',
 'statsItem3Value', 'statsItem3Base', 'statsItem3Label', 'statsItem3Prefix', 'statsItem3Suffix',
 'statsItem4Value', 'statsItem4Label'].forEach(function(id) {
    const el = document.getElementById(id);
    if (el) {
        el.addEventListener('input', function() {
            updateMockupPreview();
            updateStatsPreview();
        });
    }
});
</script>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>