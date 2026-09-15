<?php
$pageTitle = "Pengaturan Template Undangan - Admin";
require_once BASE_PATH . '/views/layouts/header.php';

$totalTemplates = count($templates);
$activeTemplates = count(array_filter($templates, fn($t) => $t['is_active'] == 1));
$premiumTemplates = count(array_filter($templates, fn($t) => $t['tier'] === 'premium'));
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Header & Top Navigation -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('admin') ?>" class="btn btn-white border rounded-circle me-3 shadow-sm" title="Kembali ke Dashboard">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h4 class="fw-bold text-dark m-0">Pengaturan Template Undangan</h4>
                    <p class="text-muted small m-0">Kelola katalog tema, atur efek transisi, animasi teks & foto, serta dekorasi latar universal</p>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?= base_url('admin/engine') ?>" class="btn btn-outline-dark rounded-pill px-3 shadow-sm fw-semibold">
                    <i class="bi bi-code-slash me-1"></i> View Engine
                </a>
                <button type="button" class="btn btn-outline-primary rounded-pill px-3 shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalImportTemplate">
                    <i class="bi bi-file-earmark-zip me-1"></i> Import Template (.ZIP)
                </button>
                <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAddTemplate">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Template Baru
                </button>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if ($flash = get_flash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $flash ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if ($flash = get_flash('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $flash ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-sm-4">
                <div class="card border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-primary-subtle text-primary rounded-3 me-3">
                            <i class="bi bi-collection-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small">Total Template</span>
                            <h4 class="fw-bold text-dark m-0"><?= $totalTemplates ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-success-subtle text-success rounded-3 me-3">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small">Template Aktif</span>
                            <h4 class="fw-bold text-dark m-0"><?= $activeTemplates ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-warning-subtle text-warning rounded-3 me-3">
                            <i class="bi bi-gem fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small">Template Premium</span>
                            <h4 class="fw-bold text-dark m-0"><?= $premiumTemplates ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Template Cards Grid -->
        <div class="row g-4">
            <?php foreach ($templates as $tmpl): 
                $anim = json_decode($tmpl['animation_config_json'] ?? '[]', true) ?: [
                    'entrance_text' => 'fade_in',
                    'entrance_photo' => 'zoom_in',
                    'loop_decor' => 'floating',
                    'page_transition' => 'slide',
                    'smooth_scroll' => 1,
                    'hover_effect' => 1,
                    'reveal_on_scroll' => 1
                ];
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden bg-white d-flex flex-column">
                        <!-- Thumbnail Header -->
                        <div class="position-relative" style="height: 200px; overflow: hidden; background-color: #f1f5f9;">
                            <img src="<?= htmlspecialchars($tmpl['thumbnail']) ?>" alt="<?= htmlspecialchars($tmpl['name']) ?>" 
                                 class="w-100 h-100 object-fit-cover">
                            
                            <!-- Badges -->
                            <div class="position-absolute top-0 start-0 m-3 d-flex gap-1 flex-wrap">
                                <span class="badge bg-dark bg-opacity-75 rounded-pill px-3 py-1">
                                    #<?= $tmpl['id'] ?>
                                </span>
                                <?php if ($tmpl['tier'] === 'premium'): ?>
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-1 fw-bold">
                                        <i class="bi bi-gem me-1"></i> Premium
                                    </span>
                                <?php elseif ($tmpl['tier'] === 'basic'): ?>
                                    <span class="badge bg-info text-white rounded-pill px-3 py-1 fw-semibold">
                                        Basic
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success text-white rounded-pill px-3 py-1 fw-semibold">
                                        Free
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="position-absolute top-0 end-0 m-3">
                                <?php if ($tmpl['is_active']): ?>
                                    <span class="badge bg-success rounded-pill px-3 py-1">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary rounded-pill px-3 py-1">Nonaktif</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-light text-muted border rounded-pill px-3 py-1 small">
                                    <?= htmlspecialchars($tmpl['category_name'] ?? 'Umum') ?>
                                </span>
                                <small class="text-muted">
                                    <i class="bi bi-people me-1"></i> Dipakai <?= $tmpl['total_used'] ?? 0 ?> acara
                                </small>
                            </div>

                            <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($tmpl['name']) ?></h5>
                            <p class="text-muted small font-monospace mb-2">
                                View Engine: <code><?= htmlspecialchars($tmpl['view_file']) ?>.php</code>
                            </p>

                            <!-- Animation Badges Preview -->
                            <div class="p-2 bg-light rounded-3 mb-3 small">
                                <div class="d-flex align-items-center mb-1 text-secondary" style="font-size: 0.75rem;">
                                    <i class="bi bi-magic me-1 text-primary"></i> <strong>Efek & Animasi:</strong>
                                </div>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-white text-dark border" title="Animasi Teks">
                                        <i class="bi bi-fonts me-1 text-primary"></i><?= ucwords(str_replace('_', ' ', $anim['entrance_text'] ?? 'fade_in')) ?>
                                    </span>
                                    <span class="badge bg-white text-dark border" title="Animasi Foto">
                                        <i class="bi bi-image me-1 text-success"></i><?= ucwords(str_replace('_', ' ', $anim['entrance_photo'] ?? 'zoom_in')) ?>
                                    </span>
                                    <span class="badge bg-white text-dark border" title="Animasi Latar">
                                        <i class="bi bi-stars me-1 text-warning"></i><?= ucwords(str_replace('_', ' ', $anim['loop_decor'] ?? 'floating')) ?>
                                    </span>
                                    <span class="badge bg-white text-dark border" title="Transisi Cover">
                                        <i class="bi bi-door-open me-1 text-info"></i><?= ucwords(str_replace('_', ' ', $anim['page_transition'] ?? 'slide')) ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 btn-edit-template"
                                            data-id="<?= $tmpl['id'] ?>"
                                            data-name="<?= htmlspecialchars($tmpl['name'], ENT_QUOTES) ?>"
                                            data-slug="<?= htmlspecialchars($tmpl['slug'], ENT_QUOTES) ?>"
                                            data-category="<?= $tmpl['category_id'] ?>"
                                            data-tier="<?= $tmpl['tier'] ?>"
                                            data-viewfile="<?= htmlspecialchars($tmpl['view_file'], ENT_QUOTES) ?>"
                                            data-thumbnail="<?= htmlspecialchars($tmpl['thumbnail'], ENT_QUOTES) ?>"
                                            data-active="<?= $tmpl['is_active'] ?>"
                                            data-anim-entrance-text="<?= $anim['entrance_text'] ?? 'fade_in' ?>"
                                            data-anim-entrance-photo="<?= $anim['entrance_photo'] ?? 'zoom_in' ?>"
                                            data-anim-loop-decor="<?= $anim['loop_decor'] ?? 'floating' ?>"
                                            data-anim-page-transition="<?= $anim['page_transition'] ?? 'slide' ?>"
                                            data-anim-smooth-scroll="<?= !empty($anim['smooth_scroll']) ? 1 : 0 ?>"
                                            data-anim-hover-effect="<?= !empty($anim['hover_effect']) ? 1 : 0 ?>"
                                            data-anim-reveal-on-scroll="<?= !empty($anim['reveal_on_scroll']) ? 1 : 0 ?>">
                                        <i class="bi bi-pencil me-1"></i> Edit & Efek
                                    </button>
                                    <a href="<?= base_url('admin/templates/preview/' . $tmpl['id']) ?>" target="_blank"
                                       class="btn btn-outline-info btn-sm rounded-pill px-2.5" title="Live Preview Animasi & Desain Template">
                                        <i class="bi bi-play-circle me-1"></i> Preview
                                    </a>
                                    <a href="<?= base_url('admin/templates/toggle/' . $tmpl['id']) ?>" 
                                       class="btn btn-sm <?= $tmpl['is_active'] ? 'btn-outline-warning' : 'btn-outline-success' ?> rounded-pill px-3">
                                        <?= $tmpl['is_active'] ? 'Nonaktifkan' : 'Aktifkan' ?>
                                    </a>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                        <li>
                                            <a class="dropdown-item fw-semibold text-info" href="<?= base_url('admin/templates/preview/' . $tmpl['id']) ?>" target="_blank">
                                                <i class="bi bi-play-circle me-2"></i> Live Preview Animasi
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url('tema') ?>" target="_blank">
                                                <i class="bi bi-eye me-2"></i> Lihat di Katalog
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-primary fw-semibold" href="<?= base_url('admin/templates/export/' . $tmpl['id']) ?>">
                                                <i class="bi bi-file-earmark-zip me-2 text-primary"></i> Export Paket (.ZIP)
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button type="button" class="dropdown-item text-danger btn-delete-template"
                                                    data-id="<?= $tmpl['id'] ?>"
                                                    data-name="<?= htmlspecialchars($tmpl['name'], ENT_QUOTES) ?>">
                                                <i class="bi bi-trash me-2"></i> Hapus Template
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL IMPORT TEMPLATE (.ZIP) ALA WORDPRESS -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalImportTemplate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow overflow-hidden">
            <form action="<?= base_url('admin/templates/import') ?>" method="POST" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header border-bottom px-4 pt-4 pb-3">
                    <div>
                        <h5 class="fw-bold text-dark m-0">
                            <i class="bi bi-file-earmark-zip text-primary me-2"></i> Import Template Undangan (.ZIP)
                        </h5>
                        <p class="text-muted small m-0">Pasang tema undangan baru secara instan dari berkas arsip .ZIP ala tema WordPress</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body px-4 py-4">
                    <!-- File Upload Box -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark mb-1">
                            Pilih Berkas Paket Template (.ZIP) <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="template_zip" class="form-control form-control-lg rounded-3 fs-6" accept=".zip" required>
                        <div class="form-text" style="font-size: 11px;">
                            Mendukung file .ZIP tunggal berisi kode view engine <code>.php</code> maupun paket lengkap dengan <code>template.json</code> dan gambar thumbnail.
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Nama Template (Opsional)</label>
                            <input type="text" name="name" class="form-control rounded-3" placeholder="Otomatis dari metadata jika dikosongkan">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Kategori Acara</label>
                            <select name="category_id" class="form-select rounded-3">
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Tier / Paket Akses</label>
                            <select name="tier" class="form-select rounded-3">
                                <option value="free">Free (Gratis)</option>
                                <option value="basic">Basic</option>
                                <option value="premium" selected>Premium</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Status Setelah Diimpor</label>
                            <div class="p-2 border rounded-3 bg-light d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span class="small text-muted">Langsung aktif untuk dipilih tamu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Petunjuk Format Paket -->
                    <div class="p-3 rounded-3 border" style="background-color: rgba(213, 168, 74, 0.08); border-color: rgba(213, 168, 74, 0.25) !important;">
                        <h6 class="fw-bold mb-1 small" style="color: #B3864E;">
                            <i class="bi bi-lightbulb-fill me-1"></i> Informasi Struktur Paket Template:
                        </h6>
                        <ul class="small text-muted m-0 ps-3" style="font-size: 11px; line-height: 1.6;">
                            <li>File ZIP dapat berisi langsung berkas PHP view engine (contoh: <code>romantic_garden.php</code>).</li>
                            <li>Atau paket lengkap berisi file engine PHP, berkas metadata <code>template.json</code>, serta gambar cover <code>thumbnail.jpg</code> / <code>thumbnail.png</code>.</li>
                            <li>Anda juga bisa menggunakan fitur <strong>Export Paket (.ZIP)</strong> pada daftar template yang ada untuk melihat contoh strukturnya.</li>
                        </ul>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-top px-4 pb-4 pt-3">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-semibold shadow-sm">
                        <i class="bi bi-cloud-arrow-up-fill me-1"></i> Mulai Impor Template
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL TAMBAH TEMPLATE BARU (LENGKAP DENGAN TAB ANIMASI, EFEK & TRANSISI) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalAddTemplate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 rounded-4 shadow overflow-hidden">
            <form action="<?= base_url('admin/templates/save') ?>" method="POST">
                <!-- Modal Header -->
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <div>
                        <h5 class="fw-bold text-dark m-0">
                            <i class="bi bi-plus-circle text-primary me-2"></i> Tambah Template Undangan Baru
                        </h5>
                        <p class="text-muted small m-0">Kustomisasi desain dasar beserta efek gerak, animasi teks & foto, dan transisi halaman</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Navigation Tabs -->
                <div class="px-4 pt-3 border-bottom">
                    <ul class="nav nav-tabs border-0 gap-2" id="addTemplateTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active rounded-top-3 px-3 py-2 small fw-semibold" id="add-tab-info" data-bs-toggle="tab" data-bs-target="#add-pane-info" type="button" role="tab">
                                <i class="bi bi-info-circle me-1"></i> 1. Info Dasar
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-top-3 px-3 py-2 small fw-semibold" id="add-tab-entrance" data-bs-toggle="tab" data-bs-target="#add-pane-entrance" type="button" role="tab">
                                <i class="bi bi-box-arrow-in-down-right me-1"></i> 2. Animasi Masuk (Teks & Foto)
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-top-3 px-3 py-2 small fw-semibold" id="add-tab-loop" data-bs-toggle="tab" data-bs-target="#add-pane-loop" type="button" role="tab">
                                <i class="bi bi-arrow-repeat me-1"></i> 3. Animasi Latar & Loop
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-top-3 px-3 py-2 small fw-semibold" id="add-tab-trans" data-bs-toggle="tab" data-bs-target="#add-pane-trans" type="button" role="tab">
                                <i class="bi bi-door-open me-1"></i> 4. Transisi Halaman
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-top-3 px-3 py-2 small fw-semibold" id="add-tab-interactive" data-bs-toggle="tab" data-bs-target="#add-pane-interactive" type="button" role="tab">
                                <i class="bi bi-hand-index-thumb me-1"></i> 5. Efek Interaktif
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Modal Body -->
                <div class="modal-body px-4 py-4" style="max-height: 65vh; overflow-y: auto;">
                    <div class="tab-content">
                        <!-- TAB 1: INFO DASAR -->
                        <div class="tab-pane fade show active" id="add-pane-info" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-7">
                                    <label class="form-label small fw-semibold text-dark">Nama Template</label>
                                    <input type="text" name="name" class="form-control rounded-3" placeholder="Contoh: Elegan Nature & Classic" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small fw-semibold text-dark">Slug URL</label>
                                    <input type="text" name="slug" class="form-control rounded-3" placeholder="elegan-nature-classic">
                                    <div class="form-text small">Kosongkan untuk auto-generate.</div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-dark">Kategori Acara</label>
                                    <select name="category_id" class="form-select rounded-3" required>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-dark">Tier / Paket Akses</label>
                                    <select name="tier" class="form-select rounded-3" required>
                                        <option value="free">Free (Gratis untuk Semua User)</option>
                                        <option value="basic">Basic</option>
                                        <option value="premium" selected>Premium (Fitur Lengkap & Efek Animasi)</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-dark">File View Engine (views/templates/)</label>
                                    <select name="view_file" class="form-select rounded-3" required>
                                        <?php foreach ($viewEngines as $eng): ?>
                                            <option value="<?= htmlspecialchars($eng['name']) ?>" <?= $eng['name'] === 'nature_classic' ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($eng['name']) ?>.php (<?= round($eng['size'] / 1024, 1) ?> KB)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="form-text small">
                                        Mau buat engine baru? <a href="<?= base_url('admin/engine') ?>" target="_blank" class="fw-semibold text-primary"><i class="bi bi-plus-circle me-1"></i>Buat / Edit File Engine</a>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-dark">Status Awal</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="addTemplateActive" checked>
                                        <label class="form-check-label fw-semibold" for="addTemplateActive">Langsung Aktifkan untuk User</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-semibold text-dark">URL Gambar Thumbnail / Cover</label>
                                    <input type="url" name="thumbnail" class="form-control rounded-3" 
                                           placeholder="https://..." 
                                           value="https://media.indoinvite.com/2db3bf1e16cd47a08843bb881e39cce7:indoinvite-staging/indoinvite-staging/indoinvite-staging/nikah/upload/sampul_19521762398202.jpeg">
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: ANIMASI MASUK (ENTRANCE) -->
                        <div class="tab-pane fade" id="add-pane-entrance" role="tabpanel">
                            <div class="alert alert-info border-0 rounded-3 small mb-4">
                                <i class="bi bi-info-circle-fill me-1"></i> Animasi Masuk digunakan saat teks, foto mempelai, atau dekorasi pertama kali muncul di layar saat tamu membaca undangan.
                            </div>

                            <div class="row g-4">
                                <!-- Animasi Teks -->
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100">
                                        <h6 class="fw-bold text-dark mb-2 d-flex align-items-center">
                                            <i class="bi bi-fonts text-primary me-2 fs-5"></i> Animasi Masuk Teks (Judul & Nama)
                                        </h6>
                                        <p class="text-muted small mb-3">Pilih bagaimana teks judul, ayat, dan nama mempelai muncul di layar:</p>
                                        
                                        <select name="anim_entrance_text" class="form-select rounded-3 mb-3">
                                            <option value="fade_in">✨ Fade In (Muncul perlahan dari transparan, lembut & elegan)</option>
                                            <option value="slide_up" selected>⬆️ Slide In Up (Bergeser masuk dari bawah ke atas - Rekomendasi)</option>
                                            <option value="slide_down">⬇️ Slide In Down (Bergeser masuk dari atas ke bawah)</option>
                                            <option value="slide_left">⬅️ Slide In Left (Bergeser masuk dari samping kanan)</option>
                                            <option value="slide_right">➡️ Slide In Right (Bergeser masuk dari samping kiri)</option>
                                            <option value="zoom_in">🔍 Zoom In / Pop In (Membesar dari titik kecil, menegaskan nama)</option>
                                            <option value="bounce_in">🏀 Bounce In (Efek memantul sedikit saat berhenti, ceria)</option>
                                            <option value="flip_in">🪙 Flip / Flip In (Berputar membalik 3D seperti koin)</option>
                                            <option value="roll_in">🌀 Roll In (Muncul sambil berputar dari samping)</option>
                                            <option value="typewriter">⌨️ Typewriter (Muncul huruf demi huruf seperti mesin tik)</option>
                                        </select>
                                        <div class="p-2 bg-light rounded text-center small text-muted">
                                            Contoh: <em>"The Wedding of Budi & Siti"</em>
                                        </div>
                                    </div>
                                </div>

                                <!-- Animasi Foto -->
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100">
                                        <h6 class="fw-bold text-dark mb-2 d-flex align-items-center">
                                            <i class="bi bi-image text-success me-2 fs-5"></i> Animasi Masuk Foto & Galeri
                                        </h6>
                                        <p class="text-muted small mb-3">Pilih bagaimana foto profil mempelai dan galeri foto muncul:</p>
                                        
                                        <select name="anim_entrance_photo" class="form-select rounded-3 mb-3">
                                            <option value="zoom_in" selected>🔍 Zoom In / Pop In (Membesar halus dari kecil ke ukuran normal)</option>
                                            <option value="fade_in">✨ Fade In (Muncul memudar lembut dari transparan)</option>
                                            <option value="slide_up">⬆️ Slide In Up (Foto meluncur anggun dari bawah)</option>
                                            <option value="slide_down">⬇️ Slide In Down (Foto meluncur dari atas)</option>
                                            <option value="bounce_in">🏀 Bounce In (Foto muncul membal riang)</option>
                                            <option value="flip_in">🪙 Flip In (Foto berbalik 3D memukau)</option>
                                            <option value="roll_in">🌀 Roll In (Foto berputar meluncur ke posisinya)</option>
                                        </select>
                                        <div class="p-2 bg-light rounded text-center small text-muted">
                                            Contoh: Foto lingkaran mempelai pria & wanita
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: ANIMASI LATAR & LOOP -->
                        <div class="tab-pane fade" id="add-pane-loop" role="tabpanel">
                            <div class="alert alert-info border-0 rounded-3 small mb-4">
                                <i class="bi bi-info-circle-fill me-1"></i> Animasi Latar & Dekorasi bergerak terus-menerus (looping) untuk menghidupkan suasana undangan agar tidak statis.
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-dark">Pilih Animasi Loop / Dekorasi Latar</label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-check p-3 border rounded-3 bg-white">
                                            <input class="form-check-input ms-0 me-3" type="radio" name="anim_loop_decor" value="floating" id="loopFloating" checked>
                                            <label class="form-check-label fw-bold text-dark d-block" for="loopFloating">
                                                🌸 Floating / Mengapung
                                            </label>
                                            <span class="text-muted small d-block mt-1">Elemen bunga, cincin, atau ornamen bergerak naik-turun halus secara kontinu.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-check p-3 border rounded-3 bg-white">
                                            <input class="form-check-input ms-0 me-3" type="radio" name="anim_loop_decor" value="particle" id="loopParticle">
                                            <label class="form-check-label fw-bold text-dark d-block" for="loopParticle">
                                                ✨ Particle / Sparkle Effect
                                            </label>
                                            <span class="text-muted small d-block mt-1">Kelopak bunga sakura berguguran, daun jatuh, atau kilau glitter emas halus di latar belakang.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-check p-3 border rounded-3 bg-white">
                                            <input class="form-check-input ms-0 me-3" type="radio" name="anim_loop_decor" value="pulse" id="loopPulse">
                                            <label class="form-check-label fw-bold text-dark d-block" for="loopPulse">
                                                💓 Pulse / Berdenyut
                                            </label>
                                            <span class="text-muted small d-block mt-1">Elemen membesar dan mengecil secara berkala seperti detak jantung (cocok untuk tombol "Buka Undangan").</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-check p-3 border rounded-3 bg-white">
                                            <input class="form-check-input ms-0 me-3" type="radio" name="anim_loop_decor" value="wiggle" id="loopWiggle">
                                            <label class="form-check-label fw-bold text-dark d-block" for="loopWiggle">
                                                〰️ Wiggle / Menggeliat
                                            </label>
                                            <span class="text-muted small d-block mt-1">Efek getaran atau goyangan kecil ritmis yang memikat pada ornamen hiasan.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-check p-3 border rounded-3 bg-white">
                                            <input class="form-check-input ms-0 me-3" type="radio" name="anim_loop_decor" value="glow" id="loopGlow">
                                            <label class="form-check-label fw-bold text-dark d-block" for="loopGlow">
                                                💡 Glow / Bersinar
                                            </label>
                                            <span class="text-muted small d-block mt-1">Efek pendaran cahaya terang dan redup bergantian pada bingkai atau teks aksen emas.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-check p-3 border rounded-3 bg-white">
                                            <input class="form-check-input ms-0 me-3" type="radio" name="anim_loop_decor" value="parallax" id="loopParallax">
                                            <label class="form-check-label fw-bold text-dark d-block" for="loopParallax">
                                                🏔️ Parallax Scrolling
                                            </label>
                                            <span class="text-muted small d-block mt-1">Latar belakang foto bergerak lebih lambat dibanding konten saat layar digulir.</span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check p-3 border rounded-3 bg-white">
                                            <input class="form-check-input ms-0 me-3" type="radio" name="anim_loop_decor" value="none" id="loopNone">
                                            <label class="form-check-label fw-bold text-dark d-block" for="loopNone">
                                                🚫 Tanpa Animasi Looping (Statis Minimalis)
                                            </label>
                                            <span class="text-muted small d-block mt-1">Matikan efek latar belakang jika menginginkan tampilan hemat baterai & bersih.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: TRANSISI HALAMAN / BUKA UNDANGAN -->
                        <div class="tab-pane fade" id="add-pane-trans" role="tabpanel">
                            <div class="alert alert-info border-0 rounded-3 small mb-4">
                                <i class="bi bi-info-circle-fill me-1"></i> Efek Transisi Antar-Halaman digunakan saat berpindah slide atau saat tamu menekan tombol <strong>"Buka Undangan"</strong> untuk masuk ke isi acara.
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="anim_page_transition" value="book_flip" id="transBookFlip" checked>
                                        <label class="form-check-label fw-bold text-dark d-block" for="transBookFlip">
                                            📖 Page Turn / Book Flip (3D)
                                        </label>
                                        <span class="text-muted small d-block mt-1">Efek transisi seperti membuka lembaran halaman buku fisik secara 3 dimensi.</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="anim_page_transition" value="slide" id="transSlide">
                                        <label class="form-check-label fw-bold text-dark d-block" for="transSlide">
                                            📱 Slide / Swipe (Tirai Ke Atas)
                                        </label>
                                        <span class="text-muted small d-block mt-1">Layar cover terangkat halus ke atas seperti tirai panggung (Default Theme 79).</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="anim_page_transition" value="cross_dissolve" id="transFade">
                                        <label class="form-check-label fw-bold text-dark d-block" for="transFade">
                                            🌫️ Cross Dissolve / Fade
                                        </label>
                                        <span class="text-muted small d-block mt-1">Halaman lama memudar dan halaman baru muncul secara bersamaan, formal & syahdu.</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="anim_page_transition" value="zoom" id="transZoom">
                                        <label class="form-check-label fw-bold text-dark d-block" for="transZoom">
                                            🔍 Zoom Transition
                                        </label>
                                        <span class="text-muted small d-block mt-1">Layar seolah-olah masuk (zoom in) menembus halaman cover untuk membuka acara.</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="anim_page_transition" value="push" id="transPush">
                                        <label class="form-check-label fw-bold text-dark d-block" for="transPush">
                                            🚪 Push
                                        </label>
                                        <span class="text-muted small d-block mt-1">Halaman baru mendorong cover lama keluar layar secara dinamis.</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="anim_page_transition" value="wipe" id="transWipe">
                                        <label class="form-check-label fw-bold text-dark d-block" for="transWipe">
                                            🧹 Wipe (Linear / Radial)
                                        </label>
                                        <span class="text-muted small d-block mt-1">Halaman baru menyapu cover lama secara garis bersih seperti tirai geser.</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3" type="radio" name="anim_page_transition" value="glitch" id="transGlitch">
                                        <label class="form-check-label fw-bold text-dark d-block" for="transGlitch">
                                            ⚡ Glitch Effect (Modern Futuristic)
                                        </label>
                                        <span class="text-muted small d-block mt-1">Transisi dengan efek distorsi digital atau gangguan sinyal estetis (cocok untuk tema modern).</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 5: EFEK INTERAKTIF -->
                        <div class="tab-pane fade" id="add-pane-interactive" role="tabpanel">
                            <div class="alert alert-info border-0 rounded-3 small mb-4">
                                <i class="bi bi-info-circle-fill me-1"></i> Pengaturan interaktivitas khusus website untuk memaksimalkan pengalaman tamu saat berselancar di undangan digital.
                            </div>

                            <div class="p-3 border rounded-3 bg-white mb-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                                    <div>
                                        <label class="form-check-label fw-bold text-dark d-block" for="addSmoothScroll">
                                            🌊 Smooth Scroll
                                        </label>
                                        <span class="text-muted small">Pergerakan gulir layar yang sangat halus dan mengalir saat tamu menekan menu navigasi bawah.</span>
                                    </div>
                                    <input class="form-check-input ms-3 fs-5" type="checkbox" name="anim_smooth_scroll" value="1" id="addSmoothScroll" checked>
                                </div>
                            </div>

                            <div class="p-3 border rounded-3 bg-white mb-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                                    <div>
                                        <label class="form-check-label fw-bold text-dark d-block" for="addHoverEffect">
                                            👆 Hover & Touch Elevate Effect
                                        </label>
                                        <span class="text-muted small">Perubahan elevasi bayangan halus, sedikit membesar, dan efek warna tombol saat disentuh atau dilewati kursor.</span>
                                    </div>
                                    <input class="form-check-input ms-3 fs-5" type="checkbox" name="anim_hover_effect" value="1" id="addHoverEffect" checked>
                                </div>
                            </div>

                            <div class="p-3 border rounded-3 bg-white">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                                    <div>
                                        <label class="form-check-label fw-bold text-dark d-block" for="addRevealOnScroll">
                                            📜 Reveal on Scroll (ScrollTrigger / AOS)
                                        </label>
                                        <span class="text-muted small">Elemen baru bergerak masuk secara otomatis hanya ketika tamu menggulir layar sampai ke bagian (section) tersebut.</span>
                                    </div>
                                    <input class="form-check-input ms-3 fs-5" type="checkbox" name="anim_reveal_on_scroll" value="1" id="addRevealOnScroll" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-semibold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Simpan Template & Konfigurasi Animasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL EDIT TEMPLATE (LENGKAP DENGAN TAB ANIMASI, EFEK & TRANSISI) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalEditTemplate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 rounded-4 shadow overflow-hidden">
            <form action="<?= base_url('admin/templates/save') ?>" method="POST">
                <input type="hidden" name="id" id="editTemplateId">
                <!-- Modal Header -->
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <div>
                        <h5 class="fw-bold text-dark m-0">
                            <i class="bi bi-pencil-square text-warning me-2"></i> Edit Data Template & Efek Animasi
                        </h5>
                        <p class="text-muted small m-0">Ubah konfigurasi desain, efek animasi teks & foto, serta transisi halaman</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Navigation Tabs -->
                <div class="px-4 pt-3 border-bottom">
                    <ul class="nav nav-tabs border-0 gap-2" id="editTemplateTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active rounded-top-3 px-3 py-2 small fw-semibold" id="edit-tab-info" data-bs-toggle="tab" data-bs-target="#edit-pane-info" type="button" role="tab">
                                <i class="bi bi-info-circle me-1"></i> 1. Info Dasar
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-top-3 px-3 py-2 small fw-semibold" id="edit-tab-entrance" data-bs-toggle="tab" data-bs-target="#edit-pane-entrance" type="button" role="tab">
                                <i class="bi bi-box-arrow-in-down-right me-1"></i> 2. Animasi Masuk
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-top-3 px-3 py-2 small fw-semibold" id="edit-tab-loop" data-bs-toggle="tab" data-bs-target="#edit-pane-loop" type="button" role="tab">
                                <i class="bi bi-arrow-repeat me-1"></i> 3. Animasi Latar
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-top-3 px-3 py-2 small fw-semibold" id="edit-tab-trans" data-bs-toggle="tab" data-bs-target="#edit-pane-trans" type="button" role="tab">
                                <i class="bi bi-door-open me-1"></i> 4. Transisi Halaman
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-top-3 px-3 py-2 small fw-semibold" id="edit-tab-interactive" data-bs-toggle="tab" data-bs-target="#edit-pane-interactive" type="button" role="tab">
                                <i class="bi bi-hand-index-thumb me-1"></i> 5. Efek Interaktif
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Modal Body -->
                <div class="modal-body px-4 py-4" style="max-height: 65vh; overflow-y: auto;">
                    <div class="tab-content">
                        <!-- TAB 1: INFO DASAR -->
                        <div class="tab-pane fade show active" id="edit-pane-info" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-7">
                                    <label class="form-label small fw-semibold text-dark">Nama Template</label>
                                    <input type="text" name="name" id="editTemplateName" class="form-control rounded-3" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small fw-semibold text-dark">Slug URL</label>
                                    <input type="text" name="slug" id="editTemplateSlug" class="form-control rounded-3" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-dark">Kategori Acara</label>
                                    <select name="category_id" id="editTemplateCategory" class="form-select rounded-3" required>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-dark">Tier / Paket Akses</label>
                                    <select name="tier" id="editTemplateTier" class="form-select rounded-3" required>
                                        <option value="free">Free (Gratis)</option>
                                        <option value="basic">Basic</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-dark">File View Engine</label>
                                    <select name="view_file" id="editTemplateViewFile" class="form-select rounded-3" required>
                                        <?php foreach ($viewEngines as $eng): ?>
                                            <option value="<?= htmlspecialchars($eng['name']) ?>">
                                                <?= htmlspecialchars($eng['name']) ?>.php (<?= round($eng['size'] / 1024, 1) ?> KB)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="form-text small">
                                        <a href="<?= base_url('admin/engine') ?>" target="_blank" class="fw-semibold text-primary"><i class="bi bi-pencil-square me-1"></i>Buka Editor Kode File View Engine</a>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-dark">Status Template</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="editTemplateActive">
                                        <label class="form-check-label fw-semibold" for="editTemplateActive">Aktif (Tampil di Katalog)</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-semibold text-dark">URL Gambar Thumbnail</label>
                                    <input type="url" name="thumbnail" id="editTemplateThumbnail" class="form-control rounded-3" required>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: ANIMASI MASUK -->
                        <div class="tab-pane fade" id="edit-pane-entrance" role="tabpanel">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100">
                                        <h6 class="fw-bold text-dark mb-2">
                                            <i class="bi bi-fonts text-primary me-2 fs-5"></i> Animasi Masuk Teks
                                        </h6>
                                        <p class="text-muted small mb-3">Efek teks judul, ayat, dan nama mempelai saat pertama kali tampil:</p>
                                        <select name="anim_entrance_text" id="editAnimEntranceText" class="form-select rounded-3 mb-3">
                                            <option value="fade_in">✨ Fade In</option>
                                            <option value="slide_up">⬆️ Slide In Up</option>
                                            <option value="slide_down">⬇️ Slide In Down</option>
                                            <option value="slide_left">⬅️ Slide In Left</option>
                                            <option value="slide_right">➡️ Slide In Right</option>
                                            <option value="zoom_in">🔍 Zoom In / Pop In</option>
                                            <option value="bounce_in">🏀 Bounce In</option>
                                            <option value="flip_in">🪙 Flip / Flip In</option>
                                            <option value="roll_in">🌀 Roll In</option>
                                            <option value="typewriter">⌨️ Typewriter (Efek Mesin Tik)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100">
                                        <h6 class="fw-bold text-dark mb-2">
                                            <i class="bi bi-image text-success me-2 fs-5"></i> Animasi Masuk Foto
                                        </h6>
                                        <p class="text-muted small mb-3">Efek foto profil mempelai dan foto galeri:</p>
                                        <select name="anim_entrance_photo" id="editAnimEntrancePhoto" class="form-select rounded-3 mb-3">
                                            <option value="zoom_in">🔍 Zoom In / Pop In</option>
                                            <option value="fade_in">✨ Fade In</option>
                                            <option value="slide_up">⬆️ Slide In Up</option>
                                            <option value="slide_down">⬇️ Slide In Down</option>
                                            <option value="bounce_in">🏀 Bounce In</option>
                                            <option value="flip_in">🪙 Flip In</option>
                                            <option value="roll_in">🌀 Roll In</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: ANIMASI LATAR & LOOP -->
                        <div class="tab-pane fade" id="edit-pane-loop" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-loop-radio" type="radio" name="anim_loop_decor" value="floating" id="editLoopFloating">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editLoopFloating">🌸 Floating / Mengapung</label>
                                        <span class="text-muted small">Ornamen bunga bergerak naik-turun halus secara kontinu.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-loop-radio" type="radio" name="anim_loop_decor" value="particle" id="editLoopParticle">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editLoopParticle">✨ Particle / Sparkle Effect</label>
                                        <span class="text-muted small">Kelopak bunga gugur, daun jatuh, atau kilau emas di layar.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-loop-radio" type="radio" name="anim_loop_decor" value="pulse" id="editLoopPulse">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editLoopPulse">💓 Pulse / Berdenyut</label>
                                        <span class="text-muted small">Membesar-mengecil berirama seperti detak jantung.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-loop-radio" type="radio" name="anim_loop_decor" value="wiggle" id="editLoopWiggle">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editLoopWiggle">〰️ Wiggle / Menggeliat</label>
                                        <span class="text-muted small">Efek getaran halus atau goyangan kecil ritmis.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-loop-radio" type="radio" name="anim_loop_decor" value="glow" id="editLoopGlow">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editLoopGlow">💡 Glow / Bersinar</label>
                                        <span class="text-muted small">Cahaya pendaran terang-redup berkala pada bingkai & teks.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-loop-radio" type="radio" name="anim_loop_decor" value="parallax" id="editLoopParallax">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editLoopParallax">🏔️ Parallax Scrolling</label>
                                        <span class="text-muted small">Latar bergerak lebih lambat saat digulir.</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-loop-radio" type="radio" name="anim_loop_decor" value="none" id="editLoopNone">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editLoopNone">🚫 Tanpa Animasi Latar</label>
                                        <span class="text-muted small">Latar belakang polos statis tanpa pergerakan loop.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: TRANSISI HALAMAN -->
                        <div class="tab-pane fade" id="edit-pane-trans" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-trans-radio" type="radio" name="anim_page_transition" value="book_flip" id="editTransBookFlip">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editTransBookFlip">📖 Page Turn / Book Flip (3D)</label>
                                        <span class="text-muted small">Membuka lembaran halaman buku fisik 3 dimensi.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-trans-radio" type="radio" name="anim_page_transition" value="slide" id="editTransSlide">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editTransSlide">📱 Slide / Swipe</label>
                                        <span class="text-muted small">Cover bergeser naik ke atas seperti tirai panggung.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-trans-radio" type="radio" name="anim_page_transition" value="cross_dissolve" id="editTransFade">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editTransFade">🌫️ Cross Dissolve / Fade</label>
                                        <span class="text-muted small">Layar lama memudar halus, layar baru muncul lembut.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-trans-radio" type="radio" name="anim_page_transition" value="zoom" id="editTransZoom">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editTransZoom">🔍 Zoom Transition</label>
                                        <span class="text-muted small">Layar zoom-in menembus masuk ke acara utama.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-trans-radio" type="radio" name="anim_page_transition" value="push" id="editTransPush">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editTransPush">🚪 Push</label>
                                        <span class="text-muted small">Halaman baru mendorong cover lama keluar layar.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-trans-radio" type="radio" name="anim_page_transition" value="wipe" id="editTransWipe">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editTransWipe">🧹 Wipe</label>
                                        <span class="text-muted small">Menyapu cover lama secara garis lurus atau radial.</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input ms-0 me-3 edit-trans-radio" type="radio" name="anim_page_transition" value="glitch" id="editTransGlitch">
                                        <label class="form-check-label fw-bold text-dark d-block" for="editTransGlitch">⚡ Glitch Effect</label>
                                        <span class="text-muted small">Distorsi sinyal digital futuristik yang estetik.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 5: EFEK INTERAKTIF -->
                        <div class="tab-pane fade" id="edit-pane-interactive" role="tabpanel">
                            <div class="p-3 border rounded-3 bg-white mb-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                                    <div>
                                        <label class="form-check-label fw-bold text-dark d-block" for="editSmoothScroll">🌊 Smooth Scroll</label>
                                        <span class="text-muted small">Pengguliran layar halus saat menekan menu dock navigasi.</span>
                                    </div>
                                    <input class="form-check-input ms-3 fs-5" type="checkbox" name="anim_smooth_scroll" value="1" id="editSmoothScroll">
                                </div>
                            </div>
                            <div class="p-3 border rounded-3 bg-white mb-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                                    <div>
                                        <label class="form-check-label fw-bold text-dark d-block" for="editHoverEffect">👆 Hover & Touch Elevate Effect</label>
                                        <span class="text-muted small">Efek elevasi 3D dan perubahan warna tombol saat disentuh.</span>
                                    </div>
                                    <input class="form-check-input ms-3 fs-5" type="checkbox" name="anim_hover_effect" value="1" id="editHoverEffect">
                                </div>
                            </div>
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                                    <div>
                                        <label class="form-check-label fw-bold text-dark d-block" for="editRevealOnScroll">📜 Reveal on Scroll</label>
                                        <span class="text-muted small">Elemen baru beranimasi muncul saat tamu menggulir ke bagian tersebut.</span>
                                    </div>
                                    <input class="form-check-input ms-3 fs-5" type="checkbox" name="anim_reveal_on_scroll" value="1" id="editRevealOnScroll">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0 px-4 pb-4 d-flex justify-content-between">
                    <div>
                        <a href="#" id="editModalPreviewBtn" target="_blank" class="btn btn-outline-info rounded-pill px-4">
                            <i class="bi bi-play-circle me-1"></i> Live Preview
                        </a>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-semibold shadow-sm">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan Template & Efek
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL HAPUS TEMPLATE -->
<div class="modal fade" id="modalDeleteTemplate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body text-center p-4">
                <div class="p-3 bg-danger-subtle text-danger rounded-circle d-inline-flex mb-3">
                    <i class="bi bi-trash3-fill fs-2"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Hapus Template Ini?</h5>
                <p class="text-muted small mb-4">
                    Apakah Anda yakin ingin menghapus template <strong id="deleteTemplateName" class="text-dark"></strong>? 
                    Template ini tidak akan tersedia lagi bagi user.
                </p>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="deleteTemplateConfirmBtn" class="btn btn-danger rounded-pill px-4">
                        Ya, Hapus Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handler Modal Edit Template
    const modalEditEl = document.getElementById('modalEditTemplate');
    const modalEdit = (typeof bootstrap !== 'undefined' && modalEditEl) ? bootstrap.Modal.getOrCreateInstance(modalEditEl) : null;

    document.querySelectorAll('.btn-edit-template').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            // Tab 1 Data
            document.getElementById('editTemplateId').value = this.dataset.id || '';
            document.getElementById('editTemplateName').value = this.dataset.name || '';
            document.getElementById('editTemplateSlug').value = this.dataset.slug || '';
            document.getElementById('editTemplateCategory').value = this.dataset.category || '1';
            document.getElementById('editTemplateTier').value = this.dataset.tier || 'free';
            document.getElementById('editTemplateViewFile').value = this.dataset.viewfile || 'nature_classic';
            document.getElementById('editTemplateThumbnail').value = this.dataset.thumbnail || '';
            document.getElementById('editTemplateActive').checked = (this.dataset.active == '1');
            const previewBtn = document.getElementById('editModalPreviewBtn');
            if (previewBtn) {
                previewBtn.href = '<?= base_url('admin/templates/preview/') ?>' + this.dataset.id;
            }

            // Tab 2 Data (Entrance)
            document.getElementById('editAnimEntranceText').value = this.dataset.animEntranceText || 'fade_in';
            document.getElementById('editAnimEntrancePhoto').value = this.dataset.animEntrancePhoto || 'zoom_in';

            // Tab 3 Data (Loop)
            const loopVal = this.dataset.animLoopDecor || 'floating';
            document.querySelectorAll('.edit-loop-radio').forEach(radio => {
                radio.checked = (radio.value === loopVal);
            });

            // Tab 4 Data (Transition)
            const transVal = this.dataset.animPageTransition || 'slide';
            document.querySelectorAll('.edit-trans-radio').forEach(radio => {
                radio.checked = (radio.value === transVal);
            });

            // Tab 5 Data (Interactive)
            document.getElementById('editSmoothScroll').checked = (this.dataset.animSmoothScroll == '1');
            document.getElementById('editHoverEffect').checked = (this.dataset.animHoverEffect == '1');
            document.getElementById('editRevealOnScroll').checked = (this.dataset.animRevealOnScroll == '1');

            // Reset tab to first tab
            const tabInfoBtn = document.getElementById('edit-tab-info');
            if (typeof bootstrap !== 'undefined' && tabInfoBtn) {
                const firstTab = bootstrap.Tab.getOrCreateInstance(tabInfoBtn);
                if (firstTab) firstTab.show();
            }

            if (modalEdit) {
                modalEdit.show();
            }
        });
    });

    // Handler Modal Delete Template
    const modalDeleteEl = document.getElementById('modalDeleteTemplate');
    const modalDelete = (typeof bootstrap !== 'undefined' && modalDeleteEl) ? bootstrap.Modal.getOrCreateInstance(modalDeleteEl) : null;

    document.querySelectorAll('.btn-delete-template').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const name = this.dataset.name;
            const delNameEl = document.getElementById('deleteTemplateName');
            const delBtnEl = document.getElementById('deleteTemplateConfirmBtn');
            if (delNameEl) delNameEl.textContent = name;
            if (delBtnEl) delBtnEl.href = '<?= base_url("admin/templates/delete/") ?>' + id;
            if (modalDelete) modalDelete.show();
        });
    });
});
</script>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
