<?php
$pageTitle = "Kelola Preset Tradisi Acara (Agama & Budaya) - Admin";
require_once BASE_PATH . '/views/layouts/header.php';
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Header & Action Buttons -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('admin') ?>" class="btn btn-white border rounded-circle me-3 shadow-sm" title="Kembali ke Dashboard">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 mb-1 fw-semibold">Master Event Presets</span>
                    <h4 class="fw-bold text-dark m-0">Pusat Tradisi & Rangkaian Acara Pernikahan</h4>
                    <p class="text-muted small m-0">Atur preset agama & adat budaya, sesuaikan ayat suci/sesi bawaan, atau buat tradisi adat baru untuk seluruh undangan</p>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-primary rounded-pill px-3 py-2 small fw-semibold shadow-sm" onclick="openCreatePresetModal()">
                    <i class="bi bi-plus-circle-fill me-1"></i> Tambah Tradisi / Adat Baru
                </button>
                <a href="<?= base_url('admin/events') ?>" class="btn btn-outline-dark rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-card-checklist me-1"></i> Seluruh Undangan
                </a>
                <a href="<?= base_url('admin/traditions/reset') ?>" class="btn btn-outline-secondary rounded-pill px-3 py-2 small fw-semibold" onclick="return confirm('Apakah Anda yakin ingin me-reset seluruh preset ke konfigurasi default sistem?')">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset ke Default
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if ($flash = get_flash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $flash ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if ($flash = get_flash('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $flash ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Grid Kartu Master Preset Tradisi -->
        <div class="row g-4 mb-5">
            <?php foreach ($presets as $key => $preset): 
                $color = $preset['color'] ?? 'secondary';
                $sessions = $preset['sessions'] ?? [];
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white d-flex flex-column justify-content-between position-relative hover-shadow transition">
                        <div>
                            <!-- Header Card Preset -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <span class="badge bg-<?= $color ?>-subtle text-<?= $color ?> border border-<?= $color ?>-subtle rounded-pill px-3 py-1.5 fw-bold fs-6 mb-1">
                                        <?= $preset['badge'] ?>
                                    </span>
                                    <h6 class="fw-bold text-dark m-0 mt-1"><?= htmlspecialchars($preset['label'] ?? $preset['name']) ?></h6>
                                </div>
                                <span class="badge bg-light text-muted border rounded-pill px-2 py-1 font-monospace" style="font-size: 11px;">
                                    key: <?= htmlspecialchars($key) ?>
                                </span>
                            </div>

                            <!-- Ayat / Kata Mutiara Bawaan -->
                            <div class="p-3 bg-light rounded-3 mb-3 border">
                                <span class="small fw-bold text-secondary d-block mb-1"><i class="bi bi-chat-quote-fill me-1 text-info"></i> Ayat / Kutipan Bawaan:</span>
                                <p class="text-muted small m-0 lh-sm" style="font-size: 12px; max-height: 60px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                    <?= !empty($preset['quote']) ? htmlspecialchars($preset['quote']) : '<em>(Belum ada kutipan suci khusus)</em>' ?>
                                </p>
                            </div>

                            <!-- Susunan Sesi Bawaan -->
                            <div class="mb-4">
                                <span class="small fw-bold text-secondary d-block mb-2"><i class="bi bi-calendar2-check-fill me-1 text-success"></i> Susunan Sesi Bawaan (<?= count($sessions) ?> Sesi):</span>
                                <div class="d-flex flex-column gap-1.5">
                                    <?php foreach ($sessions as $sIdx => $session): ?>
                                        <div class="d-flex align-items-center justify-content-between p-2 bg-light bg-opacity-50 rounded-2 border-start border-3 border-<?= $color ?>" style="font-size: 12px;">
                                            <div>
                                                <strong class="text-dark"><?= htmlspecialchars($session['name']) ?></strong>
                                                <div class="text-muted" style="font-size: 11px;"><?= htmlspecialchars($session['time']) ?> &bull; <?= htmlspecialchars($session['place']) ?></div>
                                            </div>
                                            <span class="badge bg-white text-dark border rounded-pill">Sesi <?= $sIdx + 1 ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-3 border-top d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-semibold" onclick='openEditPresetModal(<?= json_encode(array_merge($preset, ['key' => $key]), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                <i class="bi bi-pencil-square me-1"></i> Edit Preset
                            </button>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 fw-semibold text-nowrap" title="Terapkan Preset Ini ke Undangan Tertentu" onclick="openApplyModal('<?= htmlspecialchars($key) ?>', '<?= htmlspecialchars(addslashes($preset['badge'])) ?>')">
                                <i class="bi bi-send-check me-1"></i> Terapkan
                            </button>
                            <?php if (!in_array($key, ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'batak', 'jawa', 'sunda', 'chinese', 'nasional', 'custom'])): ?>
                                <a href="<?= base_url('admin/traditions/delete/' . $key) ?>" class="btn btn-outline-danger btn-sm rounded-circle p-1.5" title="Hapus Preset Kustom Ini" onclick="return confirm('Hapus preset kustom ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- MODAL: EDIT / BUAT PRESET TRADISI ACARA -->
<div class="modal fade" id="modalPresetEditor" tabindex="-1" aria-labelledby="modalPresetEditorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <form action="<?= base_url('admin/traditions/save') ?>" method="POST" id="formPresetEditor">
                <div class="modal-header bg-dark text-white border-0 py-3 px-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white bg-opacity-10 p-2 text-warning fs-4 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-calendar2-heart-fill"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold m-0" id="modalPresetEditorLabel">Edit Preset Tradisi Acara</h5>
                            <small class="text-white-50">Sesuaikan konfigurasi tradisi agama/budaya yang akan tampil ke seluruh user</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4 bg-light">
                    <!-- Basic Info -->
                    <div class="card border-0 rounded-3 p-3 mb-3 shadow-sm bg-white">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Kunci ID Preset (Slug)</label>
                                <input type="text" name="preset_key" id="editorPresetKey" class="form-control form-control-sm rounded-3 font-monospace" placeholder="contoh: minang" required>
                                <small class="text-muted" style="font-size: 11px;">Huruf kecil tanpa spasi (misal: minang, bugis)</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Nama Singkat</label>
                                <input type="text" name="name" id="editorPresetName" class="form-control form-control-sm rounded-3" placeholder="contoh: Adat Minangkabau" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Badge Tampilan & Emoji</label>
                                <input type="text" name="badge" id="editorPresetBadge" class="form-control form-control-sm rounded-3 fw-semibold" placeholder="contoh: 🏡 Minang" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label small fw-bold">Label Lengkap Dropdown</label>
                                <input type="text" name="label" id="editorPresetLabel" class="form-control form-control-sm rounded-3" placeholder="contoh: Adat Minangkabau (Akad, Baralek & Bainai)" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Warna Badge</label>
                                <select name="color" id="editorPresetColor" class="form-select form-select-sm rounded-3">
                                    <option value="primary">Biru (Primary)</option>
                                    <option value="success">Hijau (Success)</option>
                                    <option value="danger">Merah (Danger)</option>
                                    <option value="warning">Kuning/Emas (Warning)</option>
                                    <option value="info">Cyan/Biru Muda (Info)</option>
                                    <option value="secondary">Abu-abu (Secondary)</option>
                                    <option value="dark">Hitam (Dark)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Default Quote -->
                    <div class="card border-0 rounded-3 p-3 mb-3 shadow-sm bg-white">
                        <label class="form-label small fw-bold mb-1">
                            <i class="bi bi-chat-quote-fill text-info me-1"></i> Ayat Suci / Kata Mutiara Bawaan Tradisi
                        </label>
                        <textarea name="quote" id="editorPresetQuote" class="form-control rounded-3" rows="3" placeholder="Masukkan kutipan ayat suci kitab atau pepatah adat budaya..."></textarea>
                    </div>

                    <!-- Default Sessions -->
                    <div class="card border-0 rounded-3 p-3 shadow-sm bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-bold text-dark m-0"><i class="bi bi-list-check text-success me-1"></i> Daftar Sesi Acara Bawaan</h6>
                                <small class="text-muted">Sesi-sesi ini akan otomatis dibuat saat user memilih tradisi ini.</small>
                            </div>
                            <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-3 fw-semibold" onclick="editorAddSession()">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Sesi
                            </button>
                        </div>

                        <div id="editorSessionsContainer" class="d-flex flex-column gap-2">
                            <!-- Sesi dinamis -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top py-3 px-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-semibold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Simpan Preset Tradisi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: TERAPKAN KE UNDANGAN TERTENTU -->
<div class="modal fade" id="modalApplyPreset" tabindex="-1" aria-labelledby="modalApplyPresetLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <form action="" method="POST" id="formApplyPreset">
                <div class="modal-header bg-primary text-white border-0 py-3 px-4">
                    <h5 class="modal-title fw-bold m-0" id="modalApplyPresetLabel">
                        <i class="bi bi-send-check me-1"></i> Terapkan Preset ke Undangan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="alert alert-info bg-info-subtle border-info-subtle rounded-3 p-3 mb-3 small">
                        Pilih undangan acara di bawah ini. Sesi acara bawaan dan ayat suci dari preset <strong id="applyPresetNameSpan">-</strong> akan otomatis diterapkan ke undangan yang dipilih.
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Pilih Undangan Target:</label>
                        <select name="event_id" id="applyEventSelect" class="form-select rounded-3 fw-semibold" required onchange="updateApplyFormAction(this.value)">
                            <option value="">-- Pilih Undangan Acara --</option>
                            <?php foreach ($events as $ev): ?>
                                <option value="<?= $ev['id'] ?>">
                                    <?= htmlspecialchars($ev['title']) ?> (<?= htmlspecialchars($ev['user_name']) ?>) - <?= date('d M Y', strtotime($ev['event_date'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="preset_key" id="applyPresetKeyInput">
                </div>
                <div class="modal-footer bg-white border-top py-3 px-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold">
                        <i class="bi bi-check2-circle me-1"></i> Terapkan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let modalEditorInstance = null;
let modalApplyInstance = null;

function openCreatePresetModal() {
    document.getElementById('modalPresetEditorLabel').innerText = 'Tambah Preset Tradisi / Adat Baru';
    document.getElementById('editorPresetKey').value = '';
    document.getElementById('editorPresetKey').readOnly = false;
    document.getElementById('editorPresetName').value = '';
    document.getElementById('editorPresetBadge').value = '';
    document.getElementById('editorPresetLabel').value = '';
    document.getElementById('editorPresetColor').value = 'primary';
    document.getElementById('editorPresetQuote').value = '';

    const container = document.getElementById('editorSessionsContainer');
    container.innerHTML = '';
    editorAddSession('Sesi Acara 1', '08.00 - 10.00 WIB', 'Gedung / Tempat Acara', '');
    editorAddSession('Sesi Acara 2', '11.00 - 14.00 WIB', 'Ballroom Hotel', '');

    if (!modalEditorInstance) {
        modalEditorInstance = new bootstrap.Modal(document.getElementById('modalPresetEditor'));
    }
    modalEditorInstance.show();
}

function openEditPresetModal(preset) {
    document.getElementById('modalPresetEditorLabel').innerText = 'Edit Preset: ' + (preset.badge || preset.name);
    document.getElementById('editorPresetKey').value = preset.key || '';
    document.getElementById('editorPresetKey').readOnly = true; // Lock key for existing
    document.getElementById('editorPresetName').value = preset.name || '';
    document.getElementById('editorPresetBadge').value = preset.badge || '';
    document.getElementById('editorPresetLabel').value = preset.label || '';
    document.getElementById('editorPresetColor').value = preset.color || 'primary';
    document.getElementById('editorPresetQuote').value = preset.quote || '';

    const container = document.getElementById('editorSessionsContainer');
    container.innerHTML = '';
    if (preset.sessions && preset.sessions.length > 0) {
        preset.sessions.forEach(s => {
            editorAddSession(s.name, s.time, s.place, s.address);
        });
    } else {
        editorAddSession('Akad / Upacara', '08.00 - 10.00 WIB', '', '');
        editorAddSession('Resepsi', '11.00 - 14.00 WIB', '', '');
    }

    if (!modalEditorInstance) {
        modalEditorInstance = new bootstrap.Modal(document.getElementById('modalPresetEditor'));
    }
    modalEditorInstance.show();
}

function editorAddSession(name = '', time = '', place = '', address = '') {
    const container = document.getElementById('editorSessionsContainer');
    const idx = container.children.length + 1;
    const card = document.createElement('div');
    card.className = 'card border rounded-3 p-2.5 bg-light session-card-item position-relative';
    card.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-1">
            <span class="badge bg-secondary text-white rounded-pill px-2.5 py-0.5 small" style="font-size: 11px;">Sesi ${idx}</span>
            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle py-0 px-1.5" onclick="this.closest('.session-card-item').remove()" title="Hapus Sesi">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        <div class="row g-2">
            <div class="col-md-5">
                <input type="text" name="session_name[]" class="form-control form-control-sm rounded-2 fw-semibold" value="${escapeHtml(name)}" placeholder="Nama Sesi (Akad/Resepsi/dll)" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="session_time[]" class="form-control form-control-sm rounded-2" value="${escapeHtml(time)}" placeholder="08.00 - 10.00 WIB">
            </div>
            <div class="col-md-4">
                <input type="text" name="session_place[]" class="form-control form-control-sm rounded-2" value="${escapeHtml(place)}" placeholder="Nama Tempat / Gedung">
            </div>
            <div class="col-md-12">
                <input type="text" name="session_address[]" class="form-control form-control-sm rounded-2 text-muted" value="${escapeHtml(address)}" placeholder="Alamat jalan atau keterangan lokasi (opsional)">
            </div>
        </div>
    `;
    container.appendChild(card);
}

function openApplyModal(presetKey, presetBadge) {
    document.getElementById('applyPresetKeyInput').value = presetKey;
    document.getElementById('applyPresetNameSpan').innerText = presetBadge;
    document.getElementById('applyEventSelect').value = '';
    document.getElementById('formApplyPreset').action = '';

    if (!modalApplyInstance) {
        modalApplyInstance = new bootstrap.Modal(document.getElementById('modalApplyPreset'));
    }
    modalApplyInstance.show();
}

function updateApplyFormAction(eventId) {
    if (eventId) {
        document.getElementById('formApplyPreset').action = '<?= base_url('admin/traditions/apply/') ?>' + eventId;
    }
}

function escapeHtml(text) {
    if (!text) return '';
    const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
    return text.toString().replace(/[&<>"']/g, function(m) { return map[m]; });
}
</script>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
