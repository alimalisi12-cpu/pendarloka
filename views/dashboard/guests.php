<?php
$pageTitle = "Kelola Tamu Undangan - " . $event['title'];
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container" style="max-width: 1000px;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('dashboard') ?>" class="btn btn-light rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h4 class="fw-bold text-dark m-0">Buku Tamu & Broadcast Undangan</h4>
                    <span class="text-muted small">Acara: <b><?= htmlspecialchars($event['title']) ?></b></span>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= base_url('dashboard/guests/' . $event['id'] . '/print') ?>" target="_blank" class="btn btn-primary-custom rounded-pill px-3 py-2 small fw-semibold shadow-sm" title="Cetak daftar tamu atau simpan sebagai PDF">
                    <i class="bi bi-printer-fill me-1"></i> Cetak / Simpan PDF
                </a>
                <a href="<?= base_url('u/' . $event['slug']) ?>" target="_blank" class="btn btn-outline-primary rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Preview Master Link
                </a>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4 text-center">
            <div class="col-6 col-md-3">
                <div class="card p-3 border-0 rounded-4 shadow-sm">
                    <span class="text-muted small">Total Penerima</span>
                    <h3 class="fw-bold text-dark m-0 mt-1"><?= $stats['total'] ?? 0 ?></h3>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card p-3 border-0 rounded-4 shadow-sm">
                    <span class="text-success small"><i class="bi bi-check-circle-fill me-1"></i> Pasti Hadir</span>
                    <h3 class="fw-bold text-success m-0 mt-1"><?= $stats['attending'] ?? 0 ?> <span class="fs-6 fw-normal text-muted">(<?= $stats['total_attendance_pax'] ?? 0 ?> pax)</span></h3>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card p-3 border-0 rounded-4 shadow-sm">
                    <span class="text-danger small"><i class="bi bi-x-circle-fill me-1"></i> Berhalangan</span>
                    <h3 class="fw-bold text-danger m-0 mt-1"><?= $stats['not_attending'] ?? 0 ?></h3>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card p-3 border-0 rounded-4 shadow-sm">
                    <span class="text-warning small"><i class="bi bi-clock-fill me-1"></i> Belum Konfirmasi</span>
                    <h3 class="fw-bold text-warning m-0 mt-1"><?= $stats['pending'] ?? 0 ?></h3>
                </div>
            </div>
        </div>

        <!-- Form Tambah Tamu -->
        <div class="card border-0 rounded-4 shadow-sm p-4 mb-4">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-plus-fill me-2" style="color: #D4AA7B;"></i> Tambah Tamu / Penerima Undangan</h6>
            <form action="<?= base_url('dashboard/guests/' . $event['id']) ?>" method="POST" class="row g-2 align-items-center">
                <input type="hidden" name="action" value="add">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control rounded-3" placeholder="Nama Tamu (Contoh: Bapak Hendra & Keluarga)" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="phone" class="form-control rounded-3" placeholder="No. WA (Opsional: 0812...)">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-custom w-100 rounded-3">
                        <i class="bi bi-plus-lg me-1"></i> Tambah
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Daftar Tamu -->
        <div class="card border-0 rounded-4 shadow-sm overflow-hidden mb-4">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center" style="background-color: var(--pendar-bg); border-color: var(--pendar-card-border) !important;">
                <div class="d-flex align-items-center gap-2">
                    <h6 class="fw-bold text-dark m-0">Daftar Tamu & Link Khusus</h6>
                    <span class="badge rounded-pill" style="background-color: #D4AA7B; color: #fff;"><?= count($guests) ?> Tamu</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('dashboard/guests/' . $event['id'] . '/print') ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5 fw-semibold" title="Buka dan cetak / simpan ke PDF">
                        <i class="bi bi-printer-fill me-1"></i> Print / PDF
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th class="ps-4">Nama Tamu</th>
                            <th>Status RSVP</th>
                            <th>Link Personalisasi</th>
                            <th class="text-end pe-4">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($guests)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-people display-6 d-block mb-2"></i>
                                    Belum ada tamu ditambahkan. Silakan tambahkan nama tamu di atas.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($guests as $g): 
                                $guestUrl = base_url('u/' . $event['slug'] . '?kpd=' . urlencode($g['name']));
                                
                                // Template pesan WhatsApp personal
                                $waText = "Kepada Yth. " . $g['name'] . ",\n\n"
                                        . "Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri acara kami:\n\n"
                                        . "*" . $event['title'] . "*\n\n"
                                        . "Detail acara dan konfirmasi kehadiran dapat diakses melalui tautan undangan digital berikut:\n"
                                        . $guestUrl . "\n\n"
                                        . "Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila berkenan hadir dan memberikan doa restu.\n\n"
                                        . "Terima kasih.";
                                
                                $phoneDigits = preg_replace('/[^0-9]/', '', $g['phone'] ?? '');
                                if (str_starts_with($phoneDigits, '0')) {
                                    $phoneDigits = '62' . substr($phoneDigits, 1);
                                }
                                $waUrl = "https://api.whatsapp.com/send?phone=" . $phoneDigits . "&text=" . urlencode($waText);
                            ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold text-dark d-block"><?= htmlspecialchars($g['name']) ?></span>
                                        <span class="text-muted small"><?= htmlspecialchars($g['phone'] ?: 'Tanpa nomor') ?></span>
                                    </td>
                                    <td>
                                        <?php if ($g['rsvp_status'] === 'attending'): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1">
                                                <i class="bi bi-check-circle me-1"></i> Hadir (<?= $g['attendance_count'] ?>)
                                            </span>
                                        <?php elseif ($g['rsvp_status'] === 'not_attending'): ?>
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1">
                                                <i class="bi bi-x-circle me-1"></i> Tidak Hadir
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1">
                                                <i class="bi bi-clock me-1"></i> Menunggu
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm" style="max-width: 280px;">
                                            <input type="text" class="form-control rounded-start-3" value="<?= $guestUrl ?>" readonly id="link-<?= $g['id'] ?>">
                                            <button class="btn btn-outline-secondary rounded-end-3" type="button" onclick="copyLink('link-<?= $g['id'] ?>')" title="Salin Link">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2">
                                            <a href="<?= $waUrl ?>" target="_blank" class="btn btn-success btn-sm rounded-pill px-3" title="Kirim ke WhatsApp">
                                                <i class="bi bi-whatsapp me-1"></i> Kirim WA
                                            </a>
                                            <form action="<?= base_url('dashboard/guests/' . $event['id']) ?>" method="POST" onsubmit="return confirm('Hapus tamu ini?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="guest_id" value="<?= $g['id'] ?>">
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function copyLink(elementId) {
    const input = document.getElementById(elementId);
    input.select();
    input.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(input.value).then(() => {
        alert("Link undangan berhasil disalin ke clipboard!");
    });
}
</script>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
