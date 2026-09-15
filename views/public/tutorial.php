<?php
$pageTitle = "Pusat Bantuan & Tutorial Pembuatan Undangan";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-gradient text-white text-center" style="background: linear-gradient(135deg, #33B2EF 0%, #1e40af 100%);">
    <div class="container py-4">
        <h1 class="fw-extrabold mb-3">Hi, Ada yang Bisa Kami Bantu?</h1>
        <p class="opacity-90 max-w-700 mx-auto" style="max-width: 600px;">
            Pelajari panduan langkah demi langkah cara membuat, mengedit, dan membagikan undangan digital Anda dengan mudah.
        </p>
    </div>
</div>

<div class="py-5 bg-light">
    <div class="container py-3" style="max-width: 900px;">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 p-4 border-0 shadow-sm rounded-4">
                    <div class="d-flex align-items-center mb-3">
                        <span class="p-3 bg-primary-subtle text-primary rounded-3 me-3">
                            <i class="bi bi-music-note-list fs-4"></i>
                        </span>
                        <div>
                            <span class="badge bg-secondary-subtle text-secondary small">Edit Undangan</span>
                            <h6 class="fw-bold text-dark m-0 mt-1">Cara Mengganti Background Musik</h6>
                        </div>
                    </div>
                    <p class="text-muted small">
                        Buka dashboard > pilih menu edit acara > masukkan link file audio MP3 Anda atau pilih dari koleksi lagu romantis yang telah kami sediakan.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 p-4 border-0 shadow-sm rounded-4">
                    <div class="d-flex align-items-center mb-3">
                        <span class="p-3 bg-success-subtle text-success rounded-3 me-3">
                            <i class="bi bi-whatsapp fs-4"></i>
                        </span>
                        <div>
                            <span class="badge bg-secondary-subtle text-secondary small">Sebar Undangan</span>
                            <h6 class="fw-bold text-dark m-0 mt-1">Cara Broadcast Undangan ke WhatsApp</h6>
                        </div>
                    </div>
                    <p class="text-muted small">
                        Masuk ke menu Buku Tamu, tambahkan nama penerima, lalu klik tombol icon WhatsApp. Pesan undangan personal langsung siap dikirim tanpa perlu ketik manual.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 p-4 border-0 shadow-sm rounded-4">
                    <div class="d-flex align-items-center mb-3">
                        <span class="p-3 bg-warning-subtle text-warning rounded-3 me-3">
                            <i class="bi bi-qr-code fs-4"></i>
                        </span>
                        <div>
                            <span class="badge bg-secondary-subtle text-secondary small">Hari-H Resepsi</span>
                            <h6 class="fw-bold text-dark m-0 mt-1">Cara Penggunaan QR Code Check-in</h6>
                        </div>
                    </div>
                    <p class="text-muted small">
                        Tiap tamu otomatis mendapatkan kode QR unik di undangannya. Panitia di meja resepsi cukup memindai QR code tersebut untuk mencatat kehadiran tamu secara real-time.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 p-4 border-0 shadow-sm rounded-4">
                    <div class="d-flex align-items-center mb-3">
                        <span class="p-3 bg-info-subtle text-info rounded-3 me-3">
                            <i class="bi bi-credit-card fs-4"></i>
                        </span>
                        <div>
                            <span class="badge bg-secondary-subtle text-secondary small">Amplop Digital</span>
                            <h6 class="fw-bold text-dark m-0 mt-1">Pengaturan Rekening & Titip Kado</h6>
                        </div>
                    </div>
                    <p class="text-muted small">
                        Masukkan no rekening BCA, Mandiri, BRI, atau scan QRIS serta alamat pengiriman kado fisik pada form edit acara. Tamu dapat menyalin nomor rekening dengan 1 klik.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
