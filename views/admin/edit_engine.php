<?php
$pageTitle = "Editor Kode: " . htmlspecialchars($cleanName) . ".php - Admin";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-4 bg-dark min-vh-100 text-white">
    <div class="container-fluid px-lg-5">
        <!-- Top Action Bar -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3 pb-3 border-bottom border-secondary">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('admin/engine') ?>" class="btn btn-outline-light rounded-circle me-3" title="Kembali ke Daftar Engine">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="fw-bold text-white m-0 font-monospace">
                            <i class="bi bi-filetype-php text-warning me-1"></i> views/templates/<?= htmlspecialchars($cleanName) ?>.php
                        </h5>
                        <span class="badge bg-secondary rounded-pill"><?= round($fileSize / 1024, 1) ?> KB</span>
                    </div>
                    <small class="text-white-50">Terakhir diperbarui: <?= date('d M Y, H:i:s', $fileUpdated) ?> (Tekan <kbd class="bg-secondary text-white">Ctrl + S</kbd> untuk Simpan Cepat)</small>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= base_url('u/budi-siti?kpd=Bapak%20Budi&contoh=1') ?>" target="_blank" class="btn btn-outline-info rounded-pill px-3 py-2 small">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Preview Live Undangan
                </a>
                <button type="button" class="btn btn-success rounded-pill px-4 py-2 fw-semibold shadow" onclick="document.getElementById('codeEditorForm').submit()">
                    <i class="bi bi-save me-1"></i> Simpan File
                </button>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if ($flash = get_flash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $flash ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Code Editor Form -->
        <form action="<?= base_url('admin/engine/edit/' . $cleanName) ?>" method="POST" id="codeEditorForm">
            <div class="card border border-secondary rounded-4 shadow-lg overflow-hidden bg-black">
                <div class="d-flex justify-content-between align-items-center px-4 py-2 bg-dark border-bottom border-secondary small text-muted">
                    <span class="font-monospace text-secondary">
                        <i class="bi bi-terminal me-1"></i> Source Code Engine Editor (PHP, HTML, CSS, JavaScript)
                    </span>
                    <span class="small text-white-50">UTF-8 • PHP 8.2</span>
                </div>
                <div class="card-body p-0">
                    <textarea name="code" id="editorTextarea" class="form-control bg-dark text-white border-0 font-monospace p-4" 
                              rows="30" spellcheck="false" style="font-size: 13.5px; line-height: 1.6; tab-size: 4; resize: vertical; min-height: 70vh;"><?= htmlspecialchars($fileContent) ?></textarea>
                </div>
                <div class="card-footer bg-dark border-top border-secondary px-4 py-3 d-flex justify-content-between align-items-center">
                    <span class="small text-white-50">
                        <i class="bi bi-info-circle me-1"></i> Anda dapat mengedit tata letak, menambahkan script animasi baru, atau mengubah komponen kartu di sini.
                    </span>
                    <button type="submit" class="btn btn-success rounded-pill px-5 fw-semibold shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan Kode
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('editorTextarea');
    const form = document.getElementById('codeEditorForm');

    // Shortcut Ctrl+S / Cmd+S untuk Simpan Cepat
    window.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            form.submit();
        }
    });

    // Support tombol Tab di textarea
    textarea.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            e.preventDefault();
            const start = this.selectionStart;
            const end = this.selectionEnd;
            this.value = this.value.substring(0, start) + "    " + this.value.substring(end);
            this.selectionStart = this.selectionEnd = start + 4;
        }
    });
});
</script>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
