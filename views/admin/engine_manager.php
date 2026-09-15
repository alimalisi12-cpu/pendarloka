<?php
$pageTitle = "Kelola File View Engine - Admin";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Header & Breadcrumbs -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('admin/templates') ?>" class="btn btn-white border rounded-circle me-3 shadow-sm" title="Kembali ke Pengaturan Template">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h4 class="fw-bold text-dark m-0">Kelola File View Engine (views/templates/)</h4>
                    <p class="text-muted small m-0">Kustomisasi, buat file view engine baru, duplikat, atau edit kode HTML/CSS/PHP template secara langsung</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalCreateEngine">
                    <i class="bi bi-plus-lg me-1"></i> Buat File Engine Baru
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

        <!-- Info Card -->
        <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-4">
            <div class="d-flex align-items-start gap-3">
                <div class="p-3 bg-primary-subtle text-primary rounded-4 fs-3">
                    <i class="bi bi-code-slash"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Apa itu File View Engine?</h5>
                    <p class="text-muted small mb-0">
                        View Engine adalah file template PHP murni yang berlokasi di <code>views/templates/{nama_file}.php</code>. File ini bertanggung jawab merender seluruh elemen visual undangan (Cover screen, foto mempelai, waktu & lokasi acara, musik, amplop digital, dan buku tamu). Anda dapat <strong>membuat engine baru</strong>, <strong>menduplikat template yang sudah ada</strong>, atau <strong>mengedit kodenya langsung di browser</strong> maupun di VS Code!
                    </p>
                </div>
            </div>
        </div>

        <!-- Engine Files Table -->
        <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th class="ps-4 py-3">Nama File Engine</th>
                            <th>Lokasi File Sistem</th>
                            <th>Ukuran File</th>
                            <th>Terakhir Diperbarui</th>
                            <th class="text-end pe-4">Aksi File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($viewEngines as $eng): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 bg-light border rounded-3 me-3 text-primary fs-5">
                                            <i class="bi bi-filetype-php"></i>
                                        </div>
                                        <div>
                                            <strong class="text-dark d-block"><?= htmlspecialchars($eng['name']) ?>.php</strong>
                                            <span class="badge bg-primary-subtle text-primary small" style="font-size: 0.7rem;">
                                                <?= $eng['name'] === 'nature_classic' ? 'Theme 79 IndoInvite (Canvas & Nav Dock)' : ($eng['name'] === 'elegan_romance' ? 'Klasik Gold Romance' : 'Engine View Template') ?>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="small text-muted">views/templates/<?= htmlspecialchars($eng['file']) ?></code>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border rounded-pill">
                                        <?= round($eng['size'] / 1024, 1) ?> KB
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    <?= date('d M Y, H:i', $eng['updated']) ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <!-- Edit Kode Engine -->
                                        <a href="<?= base_url('admin/engine/edit/' . $eng['name']) ?>" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-pencil-square me-1"></i> Edit Kode
                                        </a>

                                        <!-- Duplikat Engine -->
                                        <a href="<?= base_url('admin/engine/duplicate/' . $eng['name']) ?>" class="btn btn-outline-secondary btn-sm rounded-pill px-3" title="Duplikat File Ini">
                                            <i class="bi bi-copy me-1"></i> Duplikat
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

<!-- MODAL BUAT FILE ENGINE BARU -->
<div class="modal fade" id="modalCreateEngine" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <form action="<?= base_url('admin/engine/create') ?>" method="POST">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="fw-bold text-dark m-0">
                        <i class="bi bi-plus-circle text-primary me-2"></i> Buat File View Engine Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <p class="text-muted small mb-3">
                        File view engine baru akan disimpan secara otomatis di direktori <code>views/templates/</code> dan siap digunakan untuk template undangan.
                    </p>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Nama File Engine (Tanpa .php)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted font-monospace small">views/templates/</span>
                            <input type="text" name="engine_name" class="form-control font-monospace" placeholder="modern_bohemian" required>
                            <span class="input-group-text bg-light text-muted font-monospace small">.php</span>
                        </div>
                        <div class="form-text small">Gunakan huruf kecil, angka, dan garis bawah (_) tanpa spasi.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Duplikat Dari Template Dasar (Basis Starter)</label>
                        <select name="base_engine" class="form-select rounded-3">
                            <option value="nature_classic" selected>nature_classic (Theme 79 IndoInvite: Lengkap dengan Partikel & Nav Dock)</option>
                            <option value="elegan_romance">elegan_romance (Klasik Gold Romance)</option>
                            <option value="rustic_floral">rustic_floral (Botanical Rustic Vintage)</option>
                        </select>
                        <div class="form-text small">Memulai dari template dasar yang sudah jadi akan menghemat waktu Anda.</div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Buat & Buka Editor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
