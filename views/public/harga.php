<?php
$pageTitle = "Daftar Paket Harga Undangan Digital";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light">
    <div class="container py-4 text-center">
        <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill mb-2">Transparan & Terjangkau</span>
        <h1 class="fw-extrabold text-dark mb-3">Pilihan Paket Harga Terbaik</h1>
        <p class="text-muted max-w-700 mx-auto mb-4" style="max-width: 600px;">
            Pilih paket yang paling sesuai dengan kebutuhan acara Anda. Tanpa biaya tersembunyi, fitur lengkap, dan dukungan tanpa libur.
        </p>

        <!-- Toggle Switcher -->
        <div class="d-inline-flex align-items-center bg-white p-1 rounded-pill border shadow-sm mb-5">
            <button class="btn btn-sm rounded-pill px-4 py-2 fw-bold active btn-primary" id="btnSatuan" onclick="togglePricing('satuan')">
                Paket Satuan (Acara Pribadi)
            </button>
            <button class="btn btn-sm rounded-pill px-4 py-2 fw-bold text-muted" id="btnLangganan" onclick="togglePricing('langganan')">
                Paket Berlangganan (Vendor / WO)
            </button>
        </div>

        <!-- 1. Grid Paket Satuan -->
        <div id="pricingSatuan" class="row g-4 text-start justify-content-center">
            <!-- Free Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 rounded-4 border p-4 shadow-sm bg-white">
                    <h5 class="fw-bold text-dark">Free Trial</h5>
                    <p class="text-muted small">Uji coba gratis untuk melihat tema yang pas tanpa batasan waktu.</p>
                    <div class="my-3">
                        <span class="fs-2 fw-extrabold text-dark">Rp 0</span>
                        <span class="text-muted small">/ selamanya</span>
                    </div>
                    <a href="<?= base_url('register') ?>" class="btn btn-outline-secondary w-100 rounded-pill fw-bold py-2 mb-4">
                        Coba Gratis
                    </a>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-muted m-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Akses Seluruh Pilihan Tema</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Ubah Nama Tamu Tanpa Batas</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Integrasi Google Maps</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Countdown Hari-H</li>
                        <li class="opacity-50"><i class="bi bi-x-circle-fill text-danger me-2"></i> Belum Mendukung Musik</li>
                        <li class="opacity-50"><i class="bi bi-x-circle-fill text-danger me-2"></i> Belum Mendukung Galeri Foto</li>
                        <li class="opacity-50"><i class="bi bi-x-circle-fill text-danger me-2"></i> Amplop Digital Terkunci</li>
                    </ul>
                </div>
            </div>

            <!-- Basic Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 rounded-4 border p-4 shadow-sm bg-white">
                    <h5 class="fw-bold text-dark">Basic</h5>
                    <p class="text-muted small">Paket hemat siap sebar untuk acara simpel dan elegan.</p>
                    <div class="my-3">
                        <span class="fs-2 fw-extrabold text-dark">Rp 39.000</span>
                        <span class="text-muted small">/ acara</span>
                    </div>
                    <a href="<?= base_url('register') ?>" class="btn btn-secondary-cta w-100 rounded-pill fw-bold py-2 mb-4">
                        Pilih Basic
                    </a>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-muted m-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> <b>Bisa Disebar ke Tamu</b></li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Tanpa Masa Aktif (Selamanya)</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> RSVP & Form Konfirmasi Kehadiran</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Ubah Nama Tamu Unlimited</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Integrasi Google Maps & Calendar</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Titip Kado Fisik</li>
                        <li class="opacity-50"><i class="bi bi-x-circle-fill text-danger me-2"></i> Tanpa Galeri Foto & Musik</li>
                    </ul>
                </div>
            </div>

            <!-- Super / Premium Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 rounded-4 border-2 border-primary p-4 shadow-lg bg-white position-relative">
                    <span class="badge bg-primary text-white position-absolute top-0 end-0 m-3 rounded-pill px-3 py-1">
                        Paling Populer
                    </span>
                    <h5 class="fw-bold text-primary">Super Premium</h5>
                    <p class="text-muted small">Fitur lengkap dan terbaik untuk momen pernikahan impian.</p>
                    <div class="my-3">
                        <span class="fs-2 fw-extrabold text-primary">Rp 99.000</span>
                        <span class="text-muted small">/ acara</span>
                    </div>
                    <a href="<?= base_url('register') ?>" class="btn btn-primary-custom w-100 rounded-pill fw-bold py-2 mb-4">
                        Pilih Super Premium
                    </a>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-muted m-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> <b>Seluruh Fitur Paket Basic</b></li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> <b>Background Musik Custom / Unggah MP3</b></li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> <b>Amplop Digital (BCA, Mandiri, QRIS)</b></li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> <b>Hingga 15+ Galeri Foto & Video Embed</b></li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Kisah Cinta (Love Story Timeline)</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Barcode QR Check-in Resepsi</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Unlimited Revisi & Bantuan CS</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 2. Grid Paket Berlangganan (Hidden by default) -->
        <div id="pricingLangganan" class="row g-4 text-start justify-content-center d-none">
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 rounded-4 border p-4 shadow-sm bg-white">
                    <h5 class="fw-bold text-dark">1 Bulan</h5>
                    <p class="text-muted small">Bebas buat banyak undangan sepuasnya.</p>
                    <div class="my-3">
                        <span class="fs-2 fw-extrabold text-dark">Rp 400.000</span>
                    </div>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2 mb-3">
                        Langganan 1 Bulan
                    </a>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-muted m-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Unlimited Buat Undangan</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Akses Semua Fitur Premium</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Ekspor Undangan Cetak</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Dukungan Prioritas Vendor</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card h-100 rounded-4 border-2 border-primary p-4 shadow-lg bg-white">
                    <span class="badge bg-primary text-white position-absolute top-0 end-0 m-3 rounded-pill px-2 py-1 small">Terlaris</span>
                    <h5 class="fw-bold text-primary">3 Bulan</h5>
                    <p class="text-muted small">Pilihan ideal untuk Wedding Organizer.</p>
                    <div class="my-3">
                        <span class="fs-2 fw-extrabold text-primary">Rp 1.150.000</span>
                    </div>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-primary-custom w-100 rounded-pill fw-bold py-2 mb-3">
                        Langganan 3 Bulan
                    </a>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-muted m-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Unlimited Buat Undangan</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Custom Domain Sendiri</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> White-label Vendor Branding</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card h-100 rounded-4 border p-4 shadow-sm bg-white">
                    <h5 class="fw-bold text-dark">6 Bulan</h5>
                    <p class="text-muted small">Hemat hingga jutaan untuk agensi.</p>
                    <div class="my-3">
                        <span class="fs-2 fw-extrabold text-dark">Rp 2.300.000</span>
                    </div>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2 mb-3">
                        Langganan 6 Bulan
                    </a>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-muted m-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Semua Fitur Lengkap</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Kuota Akun Staf/Desainer</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card h-100 rounded-4 border p-4 shadow-sm bg-white">
                    <h5 class="fw-bold text-dark">1 Tahun</h5>
                    <p class="text-muted small">Solusi bisnis jangka panjang penuh keuntungan.</p>
                    <div class="my-3">
                        <span class="fs-2 fw-extrabold text-dark">Rp 4.600.000</span>
                    </div>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2 mb-3">
                        Langganan 1 Tahun
                    </a>
                    <ul class="list-unstyled small d-flex flex-column gap-2 text-muted m-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Akses Selamanya & API Support</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Desain Tema Khusus Brand WO</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePricing(type) {
    const satuan = document.getElementById('pricingSatuan');
    const langganan = document.getElementById('pricingLangganan');
    const btnSatuan = document.getElementById('btnSatuan');
    const btnLangganan = document.getElementById('btnLangganan');

    if (type === 'satuan') {
        satuan.classList.remove('d-none');
        langganan.classList.add('d-none');
        btnSatuan.classList.add('btn-primary', 'active');
        btnSatuan.classList.remove('text-muted');
        btnLangganan.classList.remove('btn-primary', 'active');
        btnLangganan.classList.add('text-muted');
    } else {
        satuan.classList.add('d-none');
        langganan.classList.remove('d-none');
        btnLangganan.classList.add('btn-primary', 'active');
        btnLangganan.classList.remove('text-muted');
        btnSatuan.classList.remove('btn-primary', 'active');
        btnSatuan.classList.add('text-muted');
    }
}
</script>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
