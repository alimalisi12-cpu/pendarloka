<?php
$pageTitle = "Dashboard Saya";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold text-dark m-0">Dashboard Pengguna</h3>
                <p class="text-muted small m-0">Kelola dan pantau seluruh undangan digital aktif Anda</p>
            </div>
            <a href="<?= base_url('dashboard/create') ?>" class="btn btn-primary-custom rounded-pill px-4 py-2 shadow-sm d-inline-flex align-items-center">
                <i class="bi bi-plus-circle me-2"></i> Buat Undangan Baru
            </a>
        </div>

        <?php if (empty($events)): ?>
            <div class="card border-0 rounded-4 shadow-sm p-5 text-center bg-white my-4">
                <i class="bi bi-envelope-paper text-muted display-4 mb-3"></i>
                <h5 class="fw-bold text-dark">Belum Ada Undangan Dibuat</h5>
                <p class="text-muted small max-w-700 mx-auto mb-4" style="max-width: 450px;">
                    Anda belum memiliki undangan digital aktif. Klik tombol di bawah untuk membuat undangan pertama Anda dalam 5 menit!
                </p>
                <div>
                    <a href="<?= base_url('dashboard/create') ?>" class="btn btn-primary-custom rounded-pill px-4 py-2">
                        Buat Undangan Sekarang
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($events as $ev): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 rounded-4 shadow-sm overflow-hidden h-100 bg-white">
                            <div class="position-relative" style="height: 180px; background-size: cover; background-position: center; background-image: url('<?= $ev['template_thumb'] ?: 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600' ?>');">
                                <span class="badge bg-success position-absolute top-0 end-0 m-3 rounded-pill text-capitalize px-3 py-1">
                                    <?= $ev['status'] ?>
                                </span>
                            </div>
                            <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-light text-primary border small"><?= $ev['template_name'] ?></span>
                                        <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i> <?= date('d M Y', strtotime($ev['event_date'])) ?></span>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-3"><?= $ev['title'] ?></h5>

                                    <div class="d-flex gap-3 mb-4 text-muted small bg-light p-2 rounded-3 text-center">
                                        <div class="flex-fill">
                                            <span class="fw-bold text-dark fs-6 d-block"><?= $ev['total_guests'] ?></span>
                                            <span>Tamu Terdaftar</span>
                                        </div>
                                        <div class="border-end"></div>
                                        <div class="flex-fill">
                                            <span class="fw-bold text-dark fs-6 d-block"><?= $ev['total_wishes'] ?></span>
                                            <span>Ucapan Masuk</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex gap-2">
                                        <a href="<?= base_url('dashboard/edit/' . $ev['id']) ?>" class="btn btn-outline-primary btn-sm flex-fill rounded-pill py-2">
                                            <i class="bi bi-pencil-square me-1"></i> Edit Data
                                        </a>
                                        <a href="<?= base_url('dashboard/guests/' . $ev['id']) ?>" class="btn btn-secondary-cta btn-sm flex-fill rounded-pill py-2">
                                            <i class="bi bi-people me-1"></i> Buku Tamu
                                        </a>
                                    </div>
                                    <a href="<?= base_url('u/' . $ev['slug']) ?>" target="_blank" class="btn btn-primary-custom btn-sm rounded-pill py-2 text-center">
                                        <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Undangan Tamu
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
