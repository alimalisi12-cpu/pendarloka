<?php
$pageTitle = "Buat Undangan Baru";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container" style="max-width: 760px;">
        <div class="d-flex align-items-center mb-4">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-light rounded-circle me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold text-dark m-0">Langkah Awal: Buat Undangan</h4>
                <p class="text-muted small m-0">Pilih tema dan isi informasi dasar acara Anda</p>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm p-4 p-md-5 bg-white">
            <form action="<?= base_url('dashboard/create') ?>" method="POST">
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Judul Undangan / Nama Acara</label>
                    <input type="text" name="title" class="form-control form-control-lg rounded-3 fs-6" placeholder="Contoh: The Wedding of Budi & Siti" required>
                    <div class="form-text small">Judul ini akan menjadi nama utama pada sampul undangan digital.</div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Kategori Acara</label>
                        <select name="category_id" class="form-select form-select-lg rounded-3 fs-6" required>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Tanggal Acara Utama</label>
                        <input type="date" name="event_date" class="form-control form-control-lg rounded-3 fs-6" value="<?= date('Y-m-d', strtotime('+30 days')) ?>" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark"><i class="bi bi-star-fill text-warning me-1"></i> Tradisi Agama / Budaya (Rangkaian Acara)</label>
                    <select name="event_type_preset" class="form-select form-select-lg rounded-3 fs-6">
                        <option value="islam" selected>🕌 Islam (Akad Nikah & Walimatul 'Ursy)</option>
                        <option value="kristen">✝️ Kristen Protestan (Pemberkatan & Resepsi)</option>
                        <option value="katolik">⛪ Katolik (Misa Sakramen Pernikahan)</option>
                        <option value="hindu">🕉️ Hindu Bali (Upacara Pawiwahan)</option>
                        <option value="buddha">☸️ Buddha (Pemberkatan Vihara)</option>
                        <option value="batak">🏔️ Adat Batak (Martumpol & Pesta Unjuk)</option>
                        <option value="jawa">🏛️ Adat Jawa (Siraman, Midodareni & Panggih)</option>
                        <option value="sunda">🌿 Adat Sunda (Ngeuyeuk Seureuh & Sawer)</option>
                        <option value="chinese">🍵 Tionghoa (Tea Pai & Wedding Banquet)</option>
                        <option value="nasional">✨ Nasional / Modern (Akad/Janji Suci & Resepsi)</option>
                        <option value="custom">🛠️ Kustom Bebas (Tentukan sendiri sesi acara)</option>
                    </select>
                    <div class="form-text small">Secara otomatis menyusun jadwal sesi acara dan kata mutiara/ayat suci yang sesuai. Anda tetap dapat mengedit atau menambah sesi kapan saja!</div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Kustomisasi Tautan (Slug URL)</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light text-muted small"><?= base_url('u/') ?></span>
                        <input type="text" name="slug" class="form-control rounded-end-3 fs-6" placeholder="budi-siti">
                    </div>
                    <div class="form-text small">Biarkan kosong untuk membuat tautan unik secara otomatis.</div>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-bold text-dark mb-3">Pilih Template Awal</label>
                    <div class="row g-3">
                        <?php foreach ($templates as $i => $tpl): ?>
                            <div class="col-6 col-md-4">
                                <label class="card h-100 border rounded-3 p-2 cursor-pointer position-relative text-center">
                                    <input type="radio" name="template_id" value="<?= $tpl['id'] ?>" class="form-check-input position-absolute top-0 end-0 m-2" <?= $i === 0 ? 'checked' : '' ?>>
                                    <img src="<?= $tpl['thumbnail'] ?>" class="rounded-2 w-100 mb-2" style="height: 120px; object-fit: cover;">
                                    <span class="small fw-semibold text-dark d-block text-truncate"><?= $tpl['name'] ?></span>
                                    <span class="badge bg-light text-muted border" style="font-size: 10px;"><?= strtoupper($tpl['tier']) ?></span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-light rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-primary-custom rounded-pill px-5 py-2 fw-semibold">
                        Lanjut ke Pengisian Detail <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
