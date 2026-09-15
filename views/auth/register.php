<?php
$pageTitle = "Daftar Akun Baru Gratis";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4 p-md-5 border-0 shadow-sm rounded-4 bg-white">
                    <div class="text-center mb-4">
                        <span class="p-3 bg-primary text-white rounded-4 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-person-plus-fill fs-4"></i>
                        </span>
                        <h4 class="fw-bold text-dark">Buat Undangan Gratis</h4>
                        <p class="text-muted small">Daftar dalam 1 menit dan nikmati akses semua tema premium</p>
                    </div>

                    <form action="<?= base_url('register') ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control form-control-lg rounded-3 fs-6" placeholder="Contoh: Budi Santoso" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Alamat Email</label>
                            <input type="email" name="email" class="form-control form-control-lg rounded-3 fs-6" placeholder="nama@email.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">No. WhatsApp</label>
                            <input type="text" name="phone" class="form-control form-control-lg rounded-3 fs-6" placeholder="Contoh: 085171563057" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-dark">Kata Sandi</label>
                            <input type="password" name="password" class="form-control form-control-lg rounded-3 fs-6" placeholder="Minimal 6 karakter" required>
                        </div>

                        <button type="submit" class="btn btn-primary-custom btn-lg w-100 rounded-pill py-2 fs-6">
                            Daftar & Mulai Buat
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="small text-muted m-0">Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-primary fw-semibold text-decoration-none">Masuk di Sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
