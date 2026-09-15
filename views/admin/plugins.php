<?php
// views/admin/plugins.php
$pageTitle = "Kelola Plugin & Ekstensi - Admin";
require_once BASE_PATH . '/views/layouts/header.php';
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
                    <h4 class="fw-bold text-dark m-0">
                        <i class="bi bi-puzzle-fill text-info me-2"></i> Kelola Plugin & Ekstensi
                    </h4>
                    <p class="text-muted small m-0">Pasang dan aktifkan fungsionalitas tambahan untuk undangan dan platform seperti pada WordPress</p>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalUploadPlugin">
                    <i class="bi bi-cloud-arrow-up-fill me-1"></i> Unggah / Pasang Plugin (.ZIP)
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
                        <div class="p-3 bg-info-subtle text-info rounded-3 me-3">
                            <i class="bi bi-puzzle-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small">Total Plugin Terpasang</span>
                            <h4 class="fw-bold text-dark m-0"><?= $totalPlugins ?></h4>
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
                            <span class="text-muted small">Plugin Aktif</span>
                            <h4 class="fw-bold text-dark m-0"><?= $activePlugins ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-secondary-subtle text-secondary rounded-3 me-3">
                            <i class="bi bi-pause-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small">Plugin Nonaktif</span>
                            <h4 class="fw-bold text-dark m-0"><?= $inactivePlugins ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Plugin Card -->
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-5">
            <div class="card-header bg-transparent border-0 p-4 pb-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-dark m-0">Katalog Plugin Sistem</h5>
                <span class="badge bg-light text-muted border px-3 py-1.5 rounded-pill small">
                    <?= $totalPlugins ?> Plugin Tersedia
                </span>
            </div>

            <div class="card-body p-4">
                <?php if (empty($plugins)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-puzzle text-muted fs-1 d-block mb-3 opacity-50"></i>
                        <h6 class="fw-bold text-dark">Belum ada plugin terpasang</h6>
                        <p class="text-muted small mb-3">Klik tombol di atas untuk mengunggah paket berkas plugin (.ZIP) pertama Anda.</p>
                        <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm btn-sm" data-bs-toggle="modal" data-bs-target="#modalUploadPlugin">
                            <i class="bi bi-cloud-arrow-up-fill me-1"></i> Unggah Plugin Sekarang
                        </button>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($plugins as $slug => $plug): ?>
                            <div class="col-md-6 col-lg-6">
                                <div class="card h-100 border rounded-4 p-3.5 transition-all <?= $plug['is_active'] ? 'border-primary shadow-xs' : '' ?>" style="background-color: var(--pendar-card-bg);">
                                    <div class="d-flex gap-3">
                                        <div class="p-3 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 54px; height: 54px; background-color: <?= $plug['is_active'] ? 'rgba(213, 168, 74, 0.15)' : 'rgba(100, 116, 139, 0.1)' ?>; color: <?= $plug['is_active'] ? '#D5A84A' : '#64748b' ?>;">
                                            <i class="bi <?= htmlspecialchars($plug['icon']) ?> fs-3"></i>
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h6 class="fw-bold text-dark m-0">
                                                    <?= htmlspecialchars($plug['name']) ?>
                                                </h6>
                                                <span class="badge <?= $plug['is_active'] ? 'bg-success' : 'bg-secondary' ?> rounded-pill px-2.5 py-1" style="font-size: 10.5px;">
                                                    <?= $plug['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                                </span>
                                            </div>

                                            <div class="text-muted small mb-2" style="font-size: 11.5px;">
                                                Versi <?= htmlspecialchars($plug['version']) ?> | Oleh: 
                                                <?php if (!empty($plug['author_uri'])): ?>
                                                    <a href="<?= htmlspecialchars($plug['author_uri']) ?>" target="_blank" class="text-decoration-none fw-semibold text-primary"><?= htmlspecialchars($plug['author']) ?></a>
                                                <?php else: ?>
                                                    <span class="fw-semibold"><?= htmlspecialchars($plug['author']) ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <p class="text-muted small mb-3" style="font-size: 12px; line-height: 1.5;">
                                                <?= htmlspecialchars($plug['description']) ?>
                                            </p>

                                            <!-- Tombol Aksi Plugin -->
                                            <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                                <span class="badge bg-light text-muted font-monospace border" style="font-size: 10px;">
                                                    plugins/<?= htmlspecialchars($slug) ?>/
                                                </span>

                                                <div class="d-flex gap-1.5">
                                                    <?php if ($plug['is_active']): ?>
                                                        <a href="<?= base_url('admin/plugins/toggle/' . $slug) ?>" class="btn btn-outline-warning btn-sm rounded-pill px-3 py-1 fw-semibold" style="font-size: 11.5px;">
                                                            <i class="bi bi-pause-fill me-1"></i> Nonaktifkan
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?= base_url('admin/plugins/toggle/' . $slug) ?>" class="btn btn-success btn-sm rounded-pill px-3 py-1 fw-semibold text-white shadow-xs" style="font-size: 11.5px;">
                                                            <i class="bi bi-play-fill me-1"></i> Aktifkan
                                                        </a>
                                                    <?php endif; ?>

                                                    <a href="<?= base_url('admin/plugins/delete/' . $slug) ?>" class="btn btn-outline-danger btn-sm rounded-pill px-2.5 py-1" onclick="return confirm('Apakah Anda yakin ingin menghapus plugin ini beserta semua berkasnya?')" title="Hapus Plugin">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL UPLOAD PLUGIN (.ZIP) ALA WORDPRESS -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalUploadPlugin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow overflow-hidden">
            <form action="<?= base_url('admin/plugins/import') ?>" method="POST" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header border-bottom px-4 pt-4 pb-3">
                    <div>
                        <h5 class="fw-bold text-dark m-0">
                            <i class="bi bi-cloud-arrow-up-fill text-primary me-2"></i> Unggah & Pasang Plugin (.ZIP)
                        </h5>
                        <p class="text-muted small m-0">Tambahkan modul atau fitur baru ke sistem dari berkas arsip .ZIP ala plugin WordPress</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body px-4 py-4">
                    <!-- File Upload Box -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark mb-1">
                            Pilih Berkas Plugin (.ZIP) <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="plugin_zip" class="form-control form-control-lg rounded-3 fs-6" accept=".zip" required>
                        <div class="form-text" style="font-size: 11px;">
                            Pastikan berkas adalah arsip <code>.zip</code> yang berisi folder plugin atau berkas PHP plugin dengan header standar WordPress.
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch p-3 border rounded-3 bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <label class="form-check-label fw-bold text-dark d-block" for="checkActivateNow">
                                        Langsung Aktifkan Plugin
                                    </label>
                                    <span class="text-muted small">Plugin otomatis diaktifkan setelah pengekstrakan berhasil.</span>
                                </div>
                                <input class="form-check-input ms-3 fs-5" type="checkbox" name="activate_now" value="1" id="checkActivateNow" checked>
                            </div>
                        </div>
                    </div>

                    <!-- Petunjuk Header Plugin -->
                    <div class="p-3 rounded-3 border" style="background-color: rgba(51, 178, 239, 0.08); border-color: rgba(51, 178, 239, 0.25) !important;">
                        <h6 class="fw-bold mb-1 small text-info">
                            <i class="bi bi-code-square me-1"></i> Standar Header Berkas Plugin PHP:
                        </h6>
                        <pre class="m-0 p-2 rounded bg-dark text-white font-monospace small" style="font-size: 10.5px;">&lt;?php
/*
Plugin Name: Nama Plugin Kustom Anda
Description: Deskripsi fitur yang ditambahkan plugin ini.
Version: 1.0.0
Author: Nama Anda
*/

add_action('site_head', function() {
    // Kode CSS atau script Anda
});
</pre>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-top px-4 pb-4 pt-3">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-semibold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Pasang Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
