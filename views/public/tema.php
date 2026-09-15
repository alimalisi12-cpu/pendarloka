<?php
$pageTitle = "Katalog Tema Undangan Digital Modern";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill mb-2">Desain Eksklusif</span>
            <h1 class="fw-extrabold text-dark mb-3">Koleksi Template Undangan</h1>
            <p class="text-muted max-w-700 mx-auto" style="max-width: 600px;">
                Temukan gaya desain yang paling mencerminkan kepribadian dan tema acara Anda. Seluruh tema sepenuhnya responsif di layar ponsel maupun desktop.
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
                <a href="<?= base_url('tema') ?>" class="btn <?= empty($_GET['cat']) ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill px-4">
                    Semua
                </a>
                <?php foreach ($categories as $cat): ?>
                    <a href="<?= base_url('tema?cat=' . $cat['id']) ?>" class="btn <?= (isset($_GET['cat']) && $_GET['cat'] == $cat['id']) ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill px-4">
                        <i class="bi <?= $cat['icon'] ?> me-1"></i> <?= $cat['name'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

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
                                    Gunakan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
