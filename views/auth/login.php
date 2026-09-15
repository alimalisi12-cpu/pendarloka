<?php
$pageTitle = "Masuk ke Akun Anda";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4 p-md-5 border-0 shadow-sm rounded-4 bg-white">
                    <div class="text-center mb-4">
                        <span class="p-3 bg-primary text-white rounded-4 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-box-arrow-in-right fs-4"></i>
                        </span>
                        <h4 class="fw-bold text-dark">Selamat Datang Kembali</h4>
                        <p class="text-muted small">Masuk untuk mengelola dan membagikan undangan Anda</p>
                    </div>

                    <form action="<?= base_url('login') ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Alamat Email</label>
                            <input type="email" name="email" class="form-control form-control-lg rounded-3 fs-6" placeholder="nama@email.com" required>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label class="form-label small fw-semibold text-dark">Kata Sandi</label>
                                <a href="#" class="small text-muted text-decoration-none">Lupa sandi?</a>
                            </div>
                            <input type="password" name="password" class="form-control form-control-lg rounded-3 fs-6" placeholder="••••••••" required>
                        </div>

                        <button type="submit" class="btn btn-primary-custom btn-lg w-100 rounded-pill py-2 fs-6">
                            Masuk Sekarang
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="small text-muted m-0">Belum punya akun? <a href="<?= base_url('register') ?>" class="text-primary fw-semibold text-decoration-none">Daftar Gratis</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
