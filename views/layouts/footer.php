<!-- views/layouts/footer.php -->

<!-- Floating WhatsApp Button (Mirip IndoInvite) -->
<?php
$waPhone = site_setting('whatsapp_number', '081234567890');
// format phone: hilangkan tanda non digit, ganti 08 di depan dengan 628
$waClean = preg_replace('/[^0-9]/', '', $waPhone);
if (str_starts_with($waClean, '0')) {
    $waClean = '62' . substr($waClean, 1);
}
$waText = site_setting('whatsapp_text', 'Halo Admin PENDAR LOKA, saya mau order undangan digital');
?>
<div class="wa-floating-btn d-flex align-items-center">
    <div class="wa-tooltip-box d-none d-md-block">
        <p class="m-0 fw-bold wa-title" style="font-size: 13px;">Gak mau ribet?</p>
        <span class="wa-desc" style="font-size: 11px;">Minta <b class="wa-bold">Dibuatin Admin</b>, bayar setelah jadi!</span>
    </div>
    <a href="https://wa.me/<?= $waClean ?>?text=<?= urlencode($waText) ?>" target="_blank" class="wa-circle" title="Chat WhatsApp Admin">
        <i class="bi bi-whatsapp"></i>
    </a>
</div>

<!-- Footer -->
<footer class="bg-white border-top mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <?php 
                    $logoType = site_setting('site_logo_type', 'icon');
                    $logoUrlLight = site_logo_url('light');
                    $logoUrlDark = site_logo_url('dark');
                    if ($logoType === 'image' && (!empty($logoUrlLight) || !empty($logoUrlDark))): 
                    ?>
                        <?php if (!empty($logoUrlLight)): ?>
                            <img src="<?= htmlspecialchars($logoUrlLight) ?>" alt="<?= htmlspecialchars(site_name()) ?>" class="brand-logo-light <?= empty($logoUrlDark) ? 'only-one-logo' : '' ?>" style="height: 72px; max-width: 320px; object-fit: contain;">
                        <?php endif; ?>
                        <?php if (!empty($logoUrlDark)): ?>
                            <img src="<?= htmlspecialchars($logoUrlDark) ?>" alt="<?= htmlspecialchars(site_name()) ?>" class="brand-logo-dark <?= empty($logoUrlLight) ? 'only-one-logo' : '' ?>" style="height: 72px; max-width: 320px; object-fit: contain;">
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="p-2 bg-primary text-white rounded-3 me-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background-color: #D4AA7B !important; border-color: #D4AA7B !important;">
                            <i class="bi bi-envelope-paper-heart-fill fs-5"></i>
                        </span>
                        <span class="fw-bold fs-4 brand-name-text"><?= site_name() ?></span>
                    <?php endif; ?>
                </div>
                <p class="text-muted small pe-lg-4">
                    <?= htmlspecialchars(site_description()) ?>
                </p>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-sm btn-light rounded-circle text-primary"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="btn btn-sm btn-light rounded-circle text-primary"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="btn btn-sm btn-light rounded-circle text-primary"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-sm btn-light rounded-circle text-primary"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold text-dark mb-3">Navigasi</h6>
                <ul class="list-unstyled small d-flex flex-column gap-2 text-muted">
                    <li><a href="<?= base_url() ?>" class="text-decoration-none text-muted">Beranda</a></li>
                    <li><a href="<?= base_url('tema') ?>" class="text-decoration-none text-muted">Koleksi Template</a></li>
                    <li><a href="<?= base_url('harga') ?>" class="text-decoration-none text-muted">Daftar Paket Harga</a></li>
                    <li><a href="<?= base_url('tutorial') ?>" class="text-decoration-none text-muted">Pusat Tutorial</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold text-dark mb-3">Kategori Acara</h6>
                <ul class="list-unstyled small d-flex flex-column gap-2 text-muted">
                    <li><a href="<?= base_url('tema?cat=1') ?>" class="text-decoration-none text-muted">Pernikahan (Wedding)</a></li>
                    <li><a href="<?= base_url('tema?cat=2') ?>" class="text-decoration-none text-muted">Khitanan / Sunatan</a></li>
                    <li><a href="<?= base_url('tema?cat=3') ?>" class="text-decoration-none text-muted">Aqiqah</a></li>
                    <li><a href="<?= base_url('tema?cat=4') ?>" class="text-decoration-none text-muted">Ulang Tahun</a></li>
                    <li><a href="<?= base_url('tema?cat=5') ?>" class="text-decoration-none text-muted">Wisuda / Graduation</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h6 class="fw-bold text-dark mb-3">Metode Pembayaran</h6>
                <p class="text-muted small mb-3">Mendukung otomatisasi pembayaran melalui QRIS, Bank Transfer (BCA, Mandiri, BRI, BNI), E-Wallet, dan Minimarket.</p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-light text-dark border p-2"><i class="bi bi-qr-code-scan me-1"></i> QRIS</span>
                    <span class="badge bg-light text-dark border p-2"><i class="bi bi-bank me-1"></i> BCA</span>
                    <span class="badge bg-light text-dark border p-2"><i class="bi bi-bank me-1"></i> Mandiri</span>
                    <span class="badge bg-light text-dark border p-2"><i class="bi bi-bank me-1"></i> BNI</span>
                    <span class="badge bg-light text-dark border p-2"><i class="bi bi-wallet2 me-1"></i> DANA</span>
                    <span class="badge bg-light text-dark border p-2"><i class="bi bi-wallet2 me-1"></i> OVO</span>
                </div>
            </div>
        </div>

        <hr class="my-4 text-muted">

        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between small text-muted">
            <p class="m-0">&copy; <?= date('Y') ?> <b><?= APP_NAME ?></b>. Seluruh hak cipta dilindungi undang-undang.</p>
            <div class="d-flex gap-3 mt-2 mt-md-0">
                <a href="#" class="text-decoration-none text-muted">Syarat & Ketentuan</a>
                <a href="#" class="text-decoration-none text-muted">Kebijakan Privasi</a>
                <a href="#" class="text-decoration-none text-muted">Bantuan</a>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 Bundle JS is loaded in header.php -->

<!-- Script Universal Switch Mode Gelap / Terang -->
<script>
function toggleThemeMode() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-theme') || 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', newTheme);
    localStorage.setItem('pendar_theme', newTheme);
}
</script>

<?php do_action('site_footer'); ?>
</body>
</html>
