<?php
$pageTitle = "Admin Panel - " . APP_NAME;
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Header & Top Button Menu -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <span class="badge bg-dark text-white rounded-pill px-3 py-1 mb-2">Superadmin Dashboard</span>
                <h3 class="fw-bold text-dark m-0">Pusat Pengelolaan Platform</h3>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?= base_url('admin/settings') ?>" class="btn btn-primary rounded-pill px-3 py-2 small fw-semibold shadow-sm">
                    <i class="bi bi-gear-wide-connected me-1"></i> Identitas & Branding Web
                </a>
                <a href="<?= base_url('admin/traditions') ?>" class="btn btn-outline-dark rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-calendar2-heart-fill me-1 text-danger"></i> Preset Tradisi Acara
                </a>
                <a href="<?= base_url('admin/templates') ?>" class="btn btn-outline-dark rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-palette me-1"></i> Template
                </a>
                <a href="<?= base_url('admin/plugins') ?>" class="btn btn-outline-dark rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-puzzle-fill me-1 text-info"></i> Plugins
                </a>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-dark rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-people me-1"></i> Kelola User
                </a>
                <a href="<?= base_url('admin/events') ?>" class="btn btn-outline-dark rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-card-checklist me-1"></i> Seluruh Undangan
                </a>
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

        <!-- Metric Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card p-4 border-0 rounded-4 shadow-sm bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">Total Pengguna</span>
                        <span class="p-2 bg-primary-subtle text-primary rounded-3"><i class="bi bi-people-fill"></i></span>
                    </div>
                    <h3 class="fw-bold text-dark m-0"><?= $counts['total_users'] ?></h3>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card p-4 border-0 rounded-4 shadow-sm bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">Total Undangan</span>
                        <span class="p-2 bg-success-subtle text-success rounded-3"><i class="bi bi-envelope-paper-heart-fill"></i></span>
                    </div>
                    <h3 class="fw-bold text-dark m-0"><?= $counts['total_events'] ?></h3>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card p-4 border-0 rounded-4 shadow-sm bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">Tamu Terdaftar</span>
                        <span class="p-2 bg-warning-subtle text-warning rounded-3"><i class="bi bi-person-lines-fill"></i></span>
                    </div>
                    <h3 class="fw-bold text-dark m-0"><?= $counts['total_guests'] ?></h3>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card p-4 border-0 rounded-4 shadow-sm bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">Doa & Ucapan</span>
                        <span class="p-2 bg-danger-subtle text-danger rounded-3"><i class="bi bi-heart-fill"></i></span>
                    </div>
                    <h3 class="fw-bold text-dark m-0"><?= $counts['total_wishes'] ?></h3>
                </div>
            </div>
        </div>

        <!-- Quick Access Feature Cards (Fitur Utama Administrator) -->
        <div class="row g-3 mb-5">
            <!-- 1. Pengaturan Template -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white d-flex flex-column justify-content-between">
                    <div>
                        <div class="p-3 bg-warning-subtle text-warning rounded-4 d-inline-flex mb-3">
                            <i class="bi bi-palette-fill fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Pengaturan Template</h5>
                        <p class="text-muted small mb-4">
                            Kelola template undangan, tier (Free/Basic/Premium), view engine, dan status aktif.
                        </p>
                    </div>
                    <a href="<?= base_url('admin/templates') ?>" class="btn btn-warning rounded-pill w-100 fw-semibold text-dark">
                        <i class="bi bi-sliders me-1"></i> Buka Template
                    </a>
                </div>
            </div>

            <!-- 2. Preset Tradisi Acara (Agama & Budaya) -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white d-flex flex-column justify-content-between">
                    <div>
                        <div class="p-3 bg-danger-subtle text-danger rounded-4 d-inline-flex mb-3">
                            <i class="bi bi-calendar2-heart-fill fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Preset Tradisi Acara</h5>
                        <p class="text-muted small mb-4">
                            Kelola susunan acara pernikahan berdasarkan tradisi agama & adat budaya, serta buat preset kustom bebas.
                        </p>
                    </div>
                    <a href="<?= base_url('admin/traditions') ?>" class="btn btn-outline-danger rounded-pill w-100 fw-semibold">
                        <i class="bi bi-sliders me-1"></i> Buka Preset Tradisi
                    </a>
                </div>
            </div>

            <!-- 3. Kelola User -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white d-flex flex-column justify-content-between">
                    <div>
                        <div class="p-3 bg-primary-subtle text-primary rounded-4 d-inline-flex mb-3">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Kelola User</h5>
                        <p class="text-muted small mb-4">
                            Kelola pengguna terdaftar, tambah user baru, atur role, serta reset kata sandi akun pengguna.
                        </p>
                    </div>
                    <a href="<?= base_url('admin/users') ?>" class="btn btn-primary rounded-pill w-100 fw-semibold">
                        <i class="bi bi-person-gear me-1"></i> Buka Kelola User
                    </a>
                </div>
            </div>

            <!-- 4. Seluruh Undangan -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white d-flex flex-column justify-content-between">
                    <div>
                        <div class="p-3 bg-success-subtle text-success rounded-4 d-inline-flex mb-3">
                            <i class="bi bi-card-checklist fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Seluruh Undangan</h5>
                        <p class="text-muted small mb-4">
                            Pantau seluruh undangan pengguna, moderasi status publikasi, serta ubah data & susunan acara.
                        </p>
                    </div>
                    <a href="<?= base_url('admin/events') ?>" class="btn btn-outline-dark rounded-pill w-100 fw-semibold">
                        <i class="bi bi-eye me-1"></i> Buka Undangan
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Events Moderation Table -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-dark m-0">Undangan Aktif Terbaru</h5>
            <a href="<?= base_url('admin/events') ?>" class="text-decoration-none small fw-semibold text-primary">Lihat Semua</a>
        </div>

        <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-white mb-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th class="ps-4 py-3">Judul Acara</th>
                            <th>Pembuat</th>
                            <th>Template</th>
                            <th>Tanggal Acara</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi Moderasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($recentEvents, 0, 5) as $ev): ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark d-block"><?= htmlspecialchars($ev['title']) ?></span>
                                    <a href="<?= base_url('u/' . $ev['slug']) ?>" target="_blank" class="text-muted small"><?= base_url('u/' . $ev['slug']) ?></a>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block"><?= htmlspecialchars($ev['user_name']) ?></span>
                                    <span class="text-muted small"><?= htmlspecialchars($ev['user_email']) ?></span>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= $ev['template_name'] ?></span></td>
                                <td><?= date('d M Y', strtotime($ev['event_date'])) ?></td>
                                <td>
                                    <?php if ($ev['status'] === 'published'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill">Draft/Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <a href="<?= base_url('admin/customize/' . $ev['id']) ?>" class="btn btn-outline-warning btn-sm rounded-circle" title="Kustomisasi Tema & Efek">
                                            <i class="bi bi-palette"></i>
                                        </a>
                                        <a href="<?= base_url('u/' . $ev['slug']) ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?= base_url('dashboard/edit/' . $ev['id']) ?>" class="btn btn-outline-secondary btn-sm rounded-circle" title="Edit Admin">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('admin/toggle/' . $ev['id']) ?>" class="btn btn-sm <?= $ev['status'] === 'published' ? 'btn-outline-warning' : 'btn-outline-success' ?> rounded-pill px-3" title="Ubah Status">
                                            <?= $ev['status'] === 'published' ? 'Unpublish' : 'Publish' ?>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
