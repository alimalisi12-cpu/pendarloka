<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="text-center p-5 bg-white rounded-4 shadow-sm" style="max-width: 500px;">
        <i class="bi bi-exclamation-triangle text-warning display-1"></i>
        <h1 class="h3 fw-bold mt-3">Halaman Tidak Ditemukan</h1>
        <p class="text-muted">Maaf, halaman atau undangan digital yang Anda tuju tidak ditemukan atau tautan telah kedaluwarsa.</p>
        <a href="<?= base_url() ?>" class="btn btn-primary px-4 py-2 rounded-pill mt-2">
            <i class="bi bi-house me-2"></i> Kembali ke Beranda
        </a>
    </div>
</body>
</html>
