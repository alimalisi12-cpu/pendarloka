<?php
$pageTitle = "Buat Undangan Digital Gratis Cepat & Elegan";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<!-- Hero Section -->
<section class="py-5 hero-section-home bg-gradient" style="background: linear-gradient(180deg, #f0f9ff 0%, #ffffff 100%);">
    <div class="container py-lg-5">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill mb-3">
                    <i class="bi bi-stars me-1"></i> <?= htmlspecialchars(site_setting('hero_badge', 'Platform Undangan Digital No. 1')) ?>
                </span>
                <h1 class="display-4 fw-extrabold text-dark tracking-tight mb-3" style="line-height: 1.2;">
                    <?= htmlspecialchars(site_setting('hero_title_line1', 'Buat Undangan')) ?> <br>
                    <span class="text-primary"><?= htmlspecialchars(site_setting('hero_title_highlight', 'Digital Impianmu')) ?></span> <br>
                    <?= htmlspecialchars(site_setting('hero_title_line2', 'Hanya 5 Menit!')) ?>
                </h1>
                <p class="lead text-muted mb-4 fs-6">
                    <?php 
                    $rawHeroDesc = site_setting('hero_description');
                    if (empty($rawHeroDesc)) {
                        $rawHeroDesc = 'Solusi praktis bikin undangan website & video untuk <b>Pernikahan, Khitanan, Aqiqah, Ulang Tahun</b>, hingga peresmian acara. Bebas sebar nama tamu tanpa batas, gratis uji coba!';
                    }
                    echo strip_tags($rawHeroDesc, '<b><strong><i><em><u><span><br><mark>');
                    ?>
                </p>

                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="<?= base_url('register') ?>" class="btn btn-primary-custom btn-lg rounded-pill px-4 py-3 fs-6 d-flex align-items-center shadow">
                        <span><?= htmlspecialchars(site_setting('hero_btn_register_text', 'Buat Undangan Gratis')) ?></span>
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <?php 
                    $waNumber = site_setting('whatsapp_number', '081234567890');
                    $cleanWa = preg_replace('/[^0-9]/', '', $waNumber);
                    if (str_starts_with($cleanWa, '0')) {
                        $cleanWa = '62' . substr($cleanWa, 1);
                    }
                    $defaultWaText = 'Halo Admin ' . site_name() . ', saya mau minta dibuatin undangan terima beres';
                    $waText = site_setting('whatsapp_text', $defaultWaText);
                    $waUrl = "https://wa.me/{$cleanWa}?text=" . urlencode($waText);
                    ?>
                    <a href="<?= $waUrl ?>" target="_blank" class="btn btn-secondary-cta btn-lg rounded-pill px-4 py-3 fs-6 d-flex align-items-center">
                        <i class="bi bi-whatsapp text-success fs-5 me-2"></i>
                        <span><?= htmlspecialchars(site_setting('hero_btn_wa_text', 'Dibuatin Admin Aja')) ?></span>
                    </a>
                </div>

                <div class="alert alert-light border rounded-3 p-2 small d-inline-flex align-items-center text-muted">
                    <span class="badge bg-danger text-white me-2"><?= htmlspecialchars(site_setting('hero_pill_badge', 'Anti Rugi')) ?></span>
                    <?= htmlspecialchars(site_setting('hero_pill_text', 'Dibuatin admin dulu, bayar setelah jadi & suka hasilnya!')) ?>
                </div>
            </div>

            <div class="col-lg-6 text-center">
                <div class="position-relative d-inline-block">
                    <!-- Phone Mockup Frame -->
                    <div class="p-3 bg-white rounded-5 shadow-lg border" style="max-width: 320px; margin: 0 auto;">
                        <div class="rounded-4 overflow-hidden position-relative" style="height: 520px; background-color: #0f172a;">
                            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=600&auto=format&fit=crop&q=80" alt="Preview Undangan" class="w-100 h-100 object-fit-cover opacity-75">
                            <div class="position-absolute bottom-0 start-0 end-0 p-4 text-white text-center" style="background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);">
                                <p class="small text-uppercase tracking-wider mb-1">The Wedding Of</p>
                                <h3 class="font-serif fw-bold mb-2">Budi & Siti</h3>
                                <p class="small opacity-75 mb-3">Sabtu, 10 Oktober 2026</p>
                                <a href="<?= base_url('u/budi-siti?kpd=Bapak+Budi+%26+Rekan') ?>" target="_blank" class="btn btn-sm btn-primary-custom rounded-pill px-3 py-2 w-100">
                                    <i class="bi bi-envelope-open me-1"></i> Buka Contoh Live
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Counter Section -->
<section class="py-4 border-top border-bottom bg-white">
    <div class="container">
        <div class="row text-center gy-4">
            <div class="col-6 col-md-3">
                <h3 class="fw-extrabold text-primary mb-1">> 1.400.000</h3>
                <p class="text-muted small m-0">Undangan Dibuat</p>
            </div>
            <div class="col-6 col-md-3">
                <h3 class="fw-extrabold text-primary mb-1">> 4.5 Juta</h3>
                <p class="text-muted small m-0">Tamu Undangan Tersebar</p>
            </div>
            <div class="col-6 col-md-3">
                <h3 class="fw-extrabold text-primary mb-1">100+</h3>
                <p class="text-muted small m-0">Tema Siap Pakai</p>
            </div>
            <div class="col-6 col-md-3">
                <h3 class="fw-extrabold text-primary mb-1">24/7</h3>
                <p class="text-muted small m-0">Bantuan Admin & Support</p>
            </div>
        </div>
    </div>
</section>

<!-- Category Badges -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Pilih Jenis Acara Anda</h2>
            <p class="text-muted">Desain khusus yang disesuaikan secara indah untuk berbagai momen istimewa</p>
            
            <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
                <a href="<?= base_url() ?>" class="btn <?= empty($_GET['cat']) ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill px-4">
                    Semua Acara
                </a>
                <?php foreach ($categories as $cat): ?>
                    <a href="<?= base_url('?cat=' . $cat['id']) ?>" class="btn <?= (isset($_GET['cat']) && $_GET['cat'] == $cat['id']) ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill px-4">
                        <i class="bi <?= $cat['icon'] ?> me-1"></i> <?= $cat['name'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Template Grid Showcase -->
        <div class="row g-4">
            <?php foreach ($templates as $tpl): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-template h-100 shadow-sm">
                        <div class="template-thumb" style="background-image: url('<?= $tpl['thumbnail'] ?>');">
                            <span class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 end-0 m-3 rounded-pill text-uppercase" style="font-size: 11px;">
                                <?= $tpl['tier'] ?>
                            </span>
                        </div>
                        <div class="p-3 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <span class="text-muted small"><?= $tpl['category_name'] ?></span>
                                <h6 class="fw-bold text-dark mt-1 mb-2"><?= $tpl['name'] ?></h6>
                            </div>
                            <div class="d-flex gap-2 mt-3">
                                <a href="<?= base_url('demo/' . $tpl['id']) ?>" target="_blank" class="btn btn-outline-secondary btn-sm flex-fill rounded-pill">
                                    <i class="bi bi-eye"></i> Preview
                                </a>
                                <a href="<?= base_url('register') ?>" class="btn btn-primary-custom btn-sm flex-fill rounded-pill">
                                    Pakai Tema
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?= base_url('tema') ?>" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                Lihat Semua Tema Lainnya <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- Key Features Section -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold mb-2">Fitur Melimpah</span>
            <h2 class="fw-bold text-dark">Semua Kebutuhan Undangan Digital Anda Ada di Sini</h2>
            <p class="text-muted">Dirancang untuk memudahkan calon mempelai mengelola tamu serta memberikan pengalaman berkesan bagi para penerima.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <div class="p-3 bg-primary text-white rounded-3 d-inline-block mb-3">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Ubah Nama Tamu Unlimited</h5>
                    <p class="text-muted small mb-0">Kirim undangan ke ribuan tamu dengan nama masing-masing di halaman pembuka secara otomatis hanya dengan 1 link.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <div class="p-3 bg-primary text-white rounded-3 d-inline-block mb-3">
                        <i class="bi bi-infinity fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Tanpa Masa Aktif</h5>
                    <p class="text-muted small mb-0">Undangan tetap aktif selamanya, bebas diedit kapan saja tanpa takut kedaluwarsa setelah hari-H.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <div class="p-3 bg-primary text-white rounded-3 d-inline-block mb-3">
                        <i class="bi bi-music-note-beamed fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Background Musik Custom</h5>
                    <p class="text-muted small mb-0">Pilih dari pustaka musik romantis kami atau unggah lagu favorit Anda sendiri dengan autoplay yang mulus.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <div class="p-3 bg-primary text-white rounded-3 d-inline-block mb-3">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Amplop Digital & Kado Fisik</h5>
                    <p class="text-muted small mb-0">Tampilkan nomor rekening bank dan QRIS dengan fitur copy-to-clipboard instan serta alamat kirim kado fisik.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <div class="p-3 bg-primary text-white rounded-3 d-inline-block mb-3">
                        <i class="bi bi-chat-quote-fill fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark">RSVP & Buku Tamu Realtime</h5>
                    <p class="text-muted small mb-0">Konfirmasi kehadiran tamu beserta jumlah rombongan, lengkap dengan ucapan selamat dan doa restu yang bisa dibalas.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <div class="p-3 bg-primary text-white rounded-3 d-inline-block mb-3">
                        <i class="bi bi-geo-alt-fill fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Integrasi Google Maps & Calendar</h5>
                    <p class="text-muted small mb-0">Arahkan tamu langsung ke titik lokasi via GPS Google Maps dan ingatkan jadwal acara dengan tombol Add to Calendar.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
    <div class="container py-4" style="max-width: 800px;">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-muted">Semua yang perlu Anda ketahui tentang membuat undangan di <?= APP_NAME ?></p>
        </div>

        <div class="accordion" id="accordionFaq">
            <div class="accordion-item rounded-3 mb-3 border-0 shadow-sm">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Apakah bisa membuat undangan uji coba secara gratis?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#accordionFaq">
                    <div class="accordion-body text-muted small">
                        Ya, Anda bisa mendaftar dan mencoba membuat undangan secara gratis untuk melihat kecocokan tema dan mengisi seluruh data acara sebelum memutuskan aktivasi.
                    </div>
                </div>
            </div>

            <div class="accordion-item rounded-3 mb-3 border-0 shadow-sm">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Bagaimana cara kerja layanan "Dibuatin Admin Terima Beres"?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body text-muted small">
                        Cukup hubungi admin kami via WhatsApp, kirimkan foto dan detail acara Anda. Desainer kami yang akan menyusunkan undangan sampai jadi. Anda cek hasilnya, bayar hanya jika Anda sudah puas dengan hasilnya!
                    </div>
                </div>
            </div>

            <div class="accordion-item rounded-3 mb-3 border-0 shadow-sm">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Apakah nama tamu undangan bisa diganti sesuka hati?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body text-muted small">
                        Tentu saja! Anda bisa mengganti nama tamu tanpa batas menggunakan fitur Buku Tamu di dashboard, atau cukup menambahkan parameter <code>?kpd=Nama+Tamu</code> di ujung link undangan Anda.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bottom CTA Banner -->
<section class="py-5 text-white text-center" style="background: linear-gradient(135deg, #33B2EF 0%, #1e40af 100%);">
    <div class="container py-4">
        <h2 class="fw-bold mb-3">Siap Buat Momen Spesial Anda Lebih Berkesan?</h2>
        <p class="lead mb-4 fs-6 opacity-90">Bergabunglah dengan jutaan pasangan dan penyelenggara acara lainnya di seluruh Indonesia.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="<?= base_url('register') ?>" class="btn btn-light text-primary btn-lg rounded-pill px-4 fw-bold">
                Mulai Buat Gratis Sekarang
            </a>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-bold">
                Hubungi Admin
            </a>
        </div>
    </div>
</section>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
