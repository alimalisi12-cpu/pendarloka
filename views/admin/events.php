<?php
$pageTitle = "Moderasi Seluruh Undangan - Admin";
require_once BASE_PATH . '/views/layouts/header.php';
$presets = get_wedding_presets();
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('admin') ?>" class="btn btn-white border rounded-circle me-3 shadow-sm" title="Kembali ke Dashboard">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h4 class="fw-bold text-dark m-0">Moderasi Seluruh Undangan</h4>
                    <p class="text-muted small m-0">Daftar semua undangan yang dibuat oleh user maupun admin</p>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?= base_url('dashboard/create') ?>" class="btn btn-primary rounded-pill px-3 py-2 small fw-semibold shadow-sm">
                    <i class="bi bi-plus-circle-fill me-1"></i> Tambah Undangan Acara Baru
                </a>
                <a href="<?= base_url('admin/traditions') ?>" class="btn btn-outline-danger rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-calendar2-heart-fill me-1"></i> Master Preset Tradisi
                </a>
                <a href="<?= base_url('admin/templates') ?>" class="btn btn-outline-dark rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-palette me-1"></i> Pengaturan Template
                </a>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-dark rounded-pill px-3 py-2 small fw-semibold">
                    <i class="bi bi-people me-1"></i> Kelola User
                </a>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th class="ps-4">Judul Acara</th>
                            <th>Pembuat</th>
                            <th>Tema</th>
                            <th>Tradisi / Agama</th>
                            <th>Tanggal</th>
                            <th>Tamu</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $ev): ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark d-block"><?= htmlspecialchars($ev['title']) ?></span>
                                    <a href="<?= base_url('u/' . $ev['slug']) ?>" target="_blank" class="text-muted small"><?= base_url('u/' . $ev['slug']) ?></a>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block"><?= htmlspecialchars($ev['user_name']) ?></span>
                                    <span class="text-muted small"><?= htmlspecialchars($ev['user_email']) ?></span>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= $ev['template_name'] ?></span></td>
                                <td>
                                    <?= get_preset_badge_html($ev['event_type_preset'] ?? 'islam') ?>
                                </td>
                                <td><?= date('d M Y', strtotime($ev['event_date'])) ?></td>
                                <td><span class="badge bg-primary-subtle text-primary rounded-pill"><?= $ev['total_guests'] ?> Tamu</span></td>
                                <td>
                                    <?php if ($ev['status'] === 'published'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill">Draft/Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <!-- Tombol Khusus Admin Ubah Tradisi & Acara -->
                                        <button type="button" class="btn btn-outline-info btn-sm rounded-circle" title="Ubah Tradisi Agama & Susunan Acara" onclick='openTraditionModal(<?= htmlspecialchars(json_encode([
                                            'id' => $ev['id'],
                                            'title' => $ev['title'],
                                            'slug' => $ev['slug'],
                                            'event_date' => $ev['event_date'],
                                            'groom_name' => $ev['groom_name'] ?? '',
                                            'bride_name' => $ev['bride_name'] ?? '',
                                            'event_type_preset' => $ev['event_type_preset'] ?? 'islam',
                                            'quote' => $ev['quote'] ?? '',
                                            'maps_url' => $ev['maps_url'] ?? '',
                                            'events_schedule_json' => $ev['events_schedule_json'] ?? '',
                                            'akad_time' => $ev['akad_time'] ?? '',
                                            'akad_location' => $ev['akad_location'] ?? '',
                                            'resepsi_time' => $ev['resepsi_time'] ?? '',
                                            'resepsi_location' => $ev['resepsi_location'] ?? ''
                                        ]), ENT_QUOTES, 'UTF-8') ?>)'>
                                            <i class="bi bi-calendar2-heart"></i>
                                        </button>

                                        <a href="<?= base_url('admin/customize/' . $ev['id']) ?>" class="btn btn-outline-warning btn-sm rounded-circle" title="Kustomisasi Tema & Efek">
                                            <i class="bi bi-palette"></i>
                                        </a>
                                        <a href="<?= base_url('u/' . $ev['slug']) ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?= base_url('dashboard/edit/' . $ev['id']) ?>" class="btn btn-outline-secondary btn-sm rounded-circle" title="Edit Lengkap di Dashboard">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('admin/toggle/' . $ev['id']) ?>" class="btn btn-sm <?= $ev['status'] === 'published' ? 'btn-outline-warning' : 'btn-outline-success' ?> rounded-pill px-3">
                                            <?= $ev['status'] === 'published' ? 'Unpublish' : 'Publish' ?>
                                        </a>
                                        <a href="<?= base_url('admin/events/delete/' . $ev['id']) ?>" class="btn btn-outline-danger btn-sm rounded-circle" title="Hapus Undangan Ini" onclick="return confirm('Apakah Anda yakin ingin menghapus undangan &quot;<?= htmlspecialchars(addslashes($ev['title'])) ?>&quot; secara permanen?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL KHUSUS ADMIN: UBAH TRADISI ACARA PERNIKAHAN (AGAMA & BUDAYA) -->
<div class="modal fade" id="adminTraditionModal" tabindex="-1" aria-labelledby="adminTraditionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <form id="adminTraditionForm" method="POST" action="">
                <div class="modal-header bg-dark text-white border-0 py-3 px-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white bg-opacity-10 p-2 text-warning fs-4 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                            <i class="bi bi-calendar2-heart-fill"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold m-0" id="adminTraditionModalLabel">Atur Tradisi & Rangkaian Acara (Agama & Adat Budaya)</h5>
                            <span class="text-white-50 small" id="adminTraditionSubtitle">Undangan: -</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4 bg-light">
                    <!-- Banner Info -->
                    <div class="alert alert-primary bg-primary-subtle border-primary-subtle rounded-3 p-3 mb-4 d-flex align-items-center gap-3">
                        <i class="bi bi-shield-check fs-2 text-primary"></i>
                        <div>
                            <span class="fw-bold d-block text-primary">Akses Khusus Administrator</span>
                            <small class="text-secondary">Anda dapat mengubah format tradisi pernikahan (Islam, Kristen, Katolik, Hindu Bali, Buddha, Batak, Jawa, Sunda, Chinese, atau Kustom) dan menyusun sesi-sesi acara secara instan untuk undangan ini.</small>
                        </div>
                    </div>

                    <!-- 1. Pemilihan Preset Tradisi -->
                    <div class="card border-0 rounded-3 p-3 mb-3 shadow-sm bg-white">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
                            <label class="form-label fw-bold text-dark mb-0">
                                <i class="bi bi-bookmark-star text-warning me-1"></i> Pilih Tradisi / Adat Acara:
                            </label>
                            <select name="event_type_preset" id="adminPresetSelect" class="form-select form-select-sm rounded-pill fw-semibold border-primary" style="max-width: 320px;" onchange="adminApplyPreset(this.value)">
                                <?php foreach ($presets as $key => $p): ?>
                                    <option value="<?= $key ?>"><?= $p['badge'] ?> (<?= $p['label'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Tombol Cepat Preset -->
                        <div class="d-flex flex-wrap align-items-center gap-1.5 pb-2">
                            <?php foreach ($presets as $key => $p): ?>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-1 px-3 small preset-pill-btn" id="presetPill_<?= $key ?>" onclick="adminApplyPreset('<?= $key ?>')">
                                    <?= $p['badge'] ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- 2. Ayat Suci / Kata Mutiara Sesuai Tradisi -->
                    <div class="card border-0 rounded-3 p-3 mb-3 shadow-sm bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-bold text-dark mb-0">
                                <i class="bi bi-chat-quote-fill text-info me-1"></i> Ayat Suci / Kata Mutiara Pernikahan
                            </label>
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill py-0 px-2.5 small" onclick="adminApplyPresetQuote()">
                                <i class="bi bi-magic me-1"></i> Ambil Ayat Sesuai Tradisi Terpilih
                            </button>
                        </div>
                        <textarea name="quote" id="adminQuoteTextarea" class="form-control rounded-3" rows="3" placeholder="Masukkan ayat suci atau kutipan cinta pernikahan..."></textarea>
                    </div>

                    <!-- 3. Rangkaian Sesi Acara -->
                    <div class="card border-0 rounded-3 p-3 mb-3 shadow-sm bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-bold text-dark m-0"><i class="bi bi-list-stars text-success me-1"></i> Rangkaian Sesi Acara Pernikahan</h6>
                                <small class="text-muted">Tambahkan, ubah, atau hapus sesi acara (seperti Akad, Pemberkatan, Resepsi, Siraman, Tea Pai, dll).</small>
                            </div>
                            <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-3 fw-semibold" onclick="adminAddSession()">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Sesi
                            </button>
                        </div>

                        <div id="adminSessionsList" class="d-flex flex-column gap-3">
                            <!-- Sesi dinamis di-render via JS -->
                        </div>
                    </div>

                    <!-- 4. Link Google Maps Navigasi -->
                    <div class="card border-0 rounded-3 p-3 shadow-sm bg-white">
                        <label class="form-label fw-bold text-dark mb-1">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i> Link Google Maps Navigasi (Utama)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-danger"><i class="bi bi-pin-map"></i></span>
                            <input type="text" name="maps_url" id="adminMapsUrlInput" class="form-control rounded-end-3" placeholder="https://maps.google.com/...">
                        </div>
                        <small class="text-muted mt-1" style="font-size: 11px;">Link peta utama yang akan dibuka saat tamu menekan tombol navigasi lokasi di undangan.</small>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top py-3 px-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-semibold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Simpan Perubahan Tradisi & Acara
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Data Master Presets dari Server
const MASTER_PRESETS = <?= json_encode(get_wedding_presets(), JSON_UNESCAPED_UNICODE) ?>;
let currentEventData = null;
let adminTraditionModalInstance = null;

function openTraditionModal(ev) {
    currentEventData = ev;
    const form = document.getElementById('adminTraditionForm');
    form.action = '<?= base_url('admin/events/update-tradition/') ?>' + ev.id;

    // Set Subtitle
    const coupleText = (ev.groom_name && ev.bride_name) ? `(${ev.groom_name} & ${ev.bride_name})` : '';
    document.getElementById('adminTraditionSubtitle').innerText = `Undangan: ${ev.title} ${coupleText} | Tanggal: ${ev.event_date}`;

    // Set Preset
    const presetKey = ev.event_type_preset || 'islam';
    document.getElementById('adminPresetSelect').value = presetKey;
    highlightPresetPill(presetKey);

    // Set Quote
    document.getElementById('adminQuoteTextarea').value = ev.quote || '';

    // Set Maps URL
    document.getElementById('adminMapsUrlInput').value = ev.maps_url || '';

    // Render Sessions
    let sessions = [];
    if (ev.events_schedule_json) {
        try {
            sessions = typeof ev.events_schedule_json === 'string' ? JSON.parse(ev.events_schedule_json) : ev.events_schedule_json;
        } catch (e) {
            sessions = [];
        }
    }

    if (!sessions || sessions.length === 0) {
        // Fallback dari legacy fields jika ada
        if (ev.akad_time || ev.akad_location || ev.resepsi_time || ev.resepsi_location) {
            sessions = [
                {
                    name: 'Akad / Pemberkatan',
                    date: ev.event_date,
                    time: ev.akad_time || '08.00 - 10.00 WIB',
                    place: ev.akad_location || 'Gedung / Tempat Acara',
                    address: '',
                    maps_url: ev.maps_url || ''
                },
                {
                    name: 'Resepsi Pernikahan',
                    date: ev.event_date,
                    time: ev.resepsi_time || '11.00 - 14.00 WIB',
                    place: ev.resepsi_location || 'Ballroom Hotel',
                    address: '',
                    maps_url: ev.maps_url || ''
                }
            ];
        } else {
            // Gunakan default preset
            const defaultPreset = MASTER_PRESETS[presetKey] || MASTER_PRESETS['islam'];
            sessions = defaultPreset.sessions.map(s => ({
                name: s.name,
                date: ev.event_date,
                time: s.time,
                place: s.place,
                address: s.address,
                maps_url: ''
            }));
        }
    }

    renderAdminSessions(sessions, ev.event_date);

    if (!adminTraditionModalInstance) {
        adminTraditionModalInstance = new bootstrap.Modal(document.getElementById('adminTraditionModal'));
    }
    adminTraditionModalInstance.show();
}

function highlightPresetPill(key) {
    document.querySelectorAll('.preset-pill-btn').forEach(btn => {
        btn.classList.remove('btn-primary', 'text-white');
        btn.classList.add('btn-outline-secondary');
    });
    const activeBtn = document.getElementById('presetPill_' + key);
    if (activeBtn) {
        activeBtn.classList.remove('btn-outline-secondary');
        activeBtn.classList.add('btn-primary', 'text-white');
    }
}

function adminApplyPreset(key) {
    const preset = MASTER_PRESETS[key];
    if (!preset) return;

    document.getElementById('adminPresetSelect').value = key;
    highlightPresetPill(key);

    // Auto-update quotes if currently empty or user confirms
    const quoteInput = document.getElementById('adminQuoteTextarea');
    if (preset.quote && (!quoteInput.value.trim() || confirm(`Ganti juga kutipan / ayat suci sesuai tradisi ${preset.name}?`))) {
        quoteInput.value = preset.quote;
    }

    // Populate sessions with preset defaults
    const evDate = currentEventData ? currentEventData.event_date : '<?= date('Y-m-d') ?>';
    const newSessions = preset.sessions.map(s => ({
        name: s.name,
        date: evDate,
        time: s.time,
        place: s.place,
        address: s.address,
        maps_url: ''
    }));

    renderAdminSessions(newSessions, evDate);
}

function adminApplyPresetQuote() {
    const key = document.getElementById('adminPresetSelect').value || 'islam';
    const preset = MASTER_PRESETS[key];
    if (preset && preset.quote) {
        document.getElementById('adminQuoteTextarea').value = preset.quote;
    } else {
        alert('Preset ini tidak memiliki teks ayat suci bawaan.');
    }
}

function renderAdminSessions(sessions, defaultDate) {
    const container = document.getElementById('adminSessionsList');
    container.innerHTML = '';

    sessions.forEach((s, idx) => {
        container.appendChild(createAdminSessionNode(idx + 1, s.name, s.date || defaultDate, s.time, s.place, s.address, s.maps_url));
    });
}

function createAdminSessionNode(idx, name, date, time, place, address, mapsUrl) {
    const card = document.createElement('div');
    card.className = 'card border rounded-3 p-3 bg-light session-node shadow-2xs position-relative';
    card.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge bg-secondary text-white rounded-pill px-3 py-1 fw-semibold session-num-badge">
                Sesi ${idx}: ${name || 'Sesi Baru'}
            </span>
            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle py-0 px-1.5" onclick="adminRemoveSession(this)" title="Hapus Sesi Ini">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        <div class="row g-2">
            <div class="col-md-5">
                <label class="form-label small fw-bold mb-1">Nama Sesi Acara</label>
                <input type="text" name="schedule_name[]" class="form-control form-control-sm rounded-3 fw-semibold" value="${escapeHtml(name || '')}" placeholder="Contoh: Akad Nikah / Pemberkatan" oninput="adminUpdateSessionBadge(this)" required>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold mb-1">Tanggal</label>
                <input type="date" name="schedule_date[]" class="form-control form-control-sm rounded-3" value="${escapeHtml(date || '')}">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold mb-1">Waktu / Jam</label>
                <input type="text" name="schedule_time[]" class="form-control form-control-sm rounded-3" value="${escapeHtml(time || '')}" placeholder="08.00 - 10.00 WIB">
            </div>
            <div class="col-md-5">
                <label class="form-label small fw-bold mb-1">Tempat / Gedung</label>
                <input type="text" name="schedule_place[]" class="form-control form-control-sm rounded-3" value="${escapeHtml(place || '')}" placeholder="Nama Tempat / Gedung">
            </div>
            <div class="col-md-7">
                <label class="form-label small fw-bold mb-1">Alamat Lengkap</label>
                <input type="text" name="schedule_address[]" class="form-control form-control-sm rounded-3" value="${escapeHtml(address || '')}" placeholder="Alamat jalan, gedung, kelurahan...">
            </div>
            <div class="col-md-12">
                <label class="form-label small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i> Link Google Maps Khusus Sesi Ini (Opsional)</label>
                <input type="text" name="schedule_maps_url[]" class="form-control form-control-sm rounded-3" value="${escapeHtml(mapsUrl || '')}" placeholder="https://maps.google.com/...">
            </div>
        </div>
    `;
    return card;
}

function adminAddSession() {
    const container = document.getElementById('adminSessionsList');
    const count = container.querySelectorAll('.session-node').length + 1;
    const defaultDate = currentEventData ? currentEventData.event_date : '<?= date('Y-m-d') ?>';
    container.appendChild(createAdminSessionNode(count, 'Sesi Acara ' + count, defaultDate, '08.00 - 10.00 WIB', '', '', ''));
}

function adminRemoveSession(btn) {
    const card = btn.closest('.session-node');
    const container = document.getElementById('adminSessionsList');
    if (container.querySelectorAll('.session-node').length <= 1) {
        alert('Minimal harus ada satu sesi acara!');
        return;
    }
    if (confirm('Hapus sesi acara ini?')) {
        card.remove();
        adminRenumberSessions();
    }
}

function adminUpdateSessionBadge(input) {
    const card = input.closest('.session-node');
    const badge = card.querySelector('.session-num-badge');
    const cards = Array.from(document.getElementById('adminSessionsList').querySelectorAll('.session-node'));
    const idx = cards.indexOf(card) + 1;
    badge.innerText = `Sesi ${idx}: ${input.value || 'Sesi Baru'}`;
}

function adminRenumberSessions() {
    const nodes = document.querySelectorAll('#adminSessionsList .session-node');
    nodes.forEach((node, idx) => {
        const input = node.querySelector('input[name="schedule_name[]"]');
        const badge = node.querySelector('.session-num-badge');
        badge.innerText = `Sesi ${idx + 1}: ${input.value || 'Sesi Baru'}`;
    });
}

function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.toString().replace(/[&<>"']/g, function(m) { return map[m]; });
}
</script>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
