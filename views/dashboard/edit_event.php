<?php
$pageTitle = "Edit Undangan - " . $event['title'];
require_once BASE_PATH . '/views/layouts/header.php';

$bankAccounts = json_decode($event['bank_accounts_json'] ?? '[]', true) ?: [];
$loveStories = json_decode($event['love_story_json'] ?? '[]', true) ?: [];
$galleries = json_decode($event['gallery_json'] ?? '[]', true) ?: [];
$currentPreset = $event['event_type_preset'] ?? 'islam';
$schedules = !empty($event['events_schedule_json']) ? json_decode($event['events_schedule_json'], true) : [];
if (empty($schedules)) {
    $schedules = [
        [
            'name' => 'Akad Nikah',
            'date' => $event['event_date'] ?? date('Y-m-d'),
            'time' => $event['akad_time'] ?? '08.00 - 10.00 WIB',
            'place' => $event['akad_location'] ?? 'Masjid Agung Al-Ikhlas',
            'address' => '',
            'maps_url' => $event['maps_url'] ?? ''
        ],
        [
            'name' => 'Resepsi Pernikahan',
            'date' => $event['event_date'] ?? date('Y-m-d'),
            'time' => $event['resepsi_time'] ?? '11.00 - 14.00 WIB',
            'place' => $event['resepsi_location'] ?? 'Grand Ballroom Hotel Aston',
            'address' => '',
            'maps_url' => $event['maps_url'] ?? ''
        ]
    ];
}
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container" style="max-width: 900px;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('dashboard') ?>" class="btn btn-light rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h4 class="fw-bold text-dark m-0">Pengaturan Undangan</h4>
                    <span class="text-muted small">Tautan: <a href="<?= base_url('u/' . $event['slug']) ?>" target="_blank" class="text-primary fw-semibold"><?= base_url('u/' . $event['slug']) ?></a></span>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= base_url('dashboard/builder/' . $event['id']) ?>" class="btn btn-warning rounded-pill px-3 py-2 small fw-bold text-dark shadow-sm">
                    <i class="bi bi-palette2 me-1"></i> Visual Builder
                </a>
                <a href="<?= base_url('dashboard/guests/' . $event['id']) ?>" class="btn btn-secondary-cta rounded-pill px-3 py-2 small">
                    <i class="bi bi-people me-1"></i> Kelola Tamu
                </a>
                <a href="<?= base_url('u/' . $event['slug']) ?>" target="_blank" class="btn btn-outline-primary rounded-pill px-3 py-2 small">
                    <i class="bi bi-eye me-1"></i> Preview Live
                </a>
            </div>
        </div>

        <!-- Banner Visual Live Builder -->
        <div class="card border-0 rounded-4 shadow-sm mb-4 text-white p-4" style="background: linear-gradient(135deg, #17242a 0%, #243b46 100%);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <span class="badge bg-warning text-dark fw-bold mb-2"><i class="bi bi-stars me-1"></i> Fitur Baru</span>
                    <h5 class="fw-bold m-0 text-white">Visual Live Builder (Klik & Edit Langsung)</h5>
                    <p class="text-white-50 small m-0 mt-1">Edit teks, foto, tata letak, margin & padding secara visual dengan live preview seketika.</p>
                </div>
                <a href="<?= base_url('dashboard/builder/' . $event['id']) ?>" class="btn btn-warning rounded-pill px-4 py-2 fw-bold text-dark shadow text-nowrap">
                    <i class="bi bi-palette2 me-1"></i> Buka Visual Builder
                </a>
            </div>
        </div>

        <form action="<?= base_url('dashboard/edit/' . $event['id']) ?>" method="POST" enctype="multipart/form-data" id="editEventForm">
            <!-- 1. Data Utama & Tema -->
            <div class="card border-0 rounded-4 shadow-sm p-4 mb-4 bg-white">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle text-primary me-2"></i> Informasi Utama & Tema</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Judul Undangan</label>
                        <input type="text" name="title" class="form-control rounded-3" value="<?= e($event['title']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Tanggal Acara Utama</label>
                        <input type="date" name="event_date" class="form-control rounded-3" value="<?= $event['event_date'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Pilih Tema / Template</label>
                        <select name="template_id" class="form-select rounded-3">
                            <?php foreach ($templates as $tpl): ?>
                                <option value="<?= $tpl['id'] ?>" <?= $event['template_id'] == $tpl['id'] ? 'selected' : '' ?>>
                                    <?= $tpl['name'] ?> (<?= strtoupper($tpl['tier']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 border">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-2">
                                <div>
                                    <label class="form-label small fw-bold text-dark m-0">
                                        <i class="bi bi-music-note-beamed text-primary me-1"></i> Background Musik Undangan (Audio Pengiring)
                                    </label>
                                    <p class="text-muted small m-0" style="font-size: 11px;">Tamu undangan dapat mendengarkan alunan musik romantis saat membuka dan membaca undangan Anda.</p>
                                </div>
                                <div class="d-flex flex-wrap gap-1.5">
                                    <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 py-1 fw-semibold" onclick="openMusicPickerModal()">
                                        <i class="bi bi-collection-play me-1"></i> Pilih Koleksi Musik Romantis
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1 fw-semibold" onclick="document.getElementById('musicDeviceFileInput').click()">
                                        <i class="bi bi-cloud-arrow-up me-1"></i> Upload Musik dari HP/PC
                                    </button>
                                    <input type="file" id="musicDeviceFileInput" accept="audio/*" class="d-none" onchange="handleMusicDeviceUpload(this)">
                                </div>
                            </div>

                            <div class="row g-2 align-items-center">
                                <div class="col-md-7">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-white text-muted"><i class="bi bi-link-45deg"></i></span>
                                        <input type="text" name="music_url" id="inputMusicUrl" class="form-control rounded-end-3" value="<?= htmlspecialchars($event['music_url'] ?? '') ?>" placeholder="Pilih lagu dari koleksi romantis atau upload musik dari perangkat Anda..." oninput="updateMusicPreviewPlayer(this.value)" onchange="updateMusicPreviewPlayer(this.value)">
                                    </div>
                                    <div id="musicUploadLoading" class="small text-primary mt-1 d-none">
                                        <span class="spinner-border spinner-border-sm me-1" role="status"></span> Mengunggah file musik ke server... Mohon tunggu.
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="d-flex align-items-center gap-2">
                                        <audio id="musicPreviewPlayer" src="<?= htmlspecialchars($event['music_url'] ?? '') ?>" controls class="w-100" style="height: 34px; border-radius: 20px;"></audio>
                                        <button type="button" class="btn btn-outline-danger btn-sm rounded-circle p-1" title="Hapus / Matikan Musik" onclick="clearMusicSelection()">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. FOTO UTAMA, SAMPUL & BACKGROUND UNDANGAN -->
            <div class="card border-0 rounded-4 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold text-dark m-0"><i class="bi bi-image text-warning me-2"></i> Foto Utama, Sampul & Background</h5>
                        <p class="text-muted small m-0">Tentukan foto yang menjadi cover pembuka, foto paling atas (hero), dan wallpaper undangan</p>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- A. Foto Sampul (Cover Undangan) -->
                    <div class="col-md-4">
                        <div class="card h-100 border rounded-4 p-3 bg-light text-center position-relative">
                            <span class="badge bg-dark text-white rounded-pill mb-2 align-self-center px-3 py-1 small">
                                <i class="bi bi-envelope-paper me-1 text-warning"></i> Sampul Pembuka (Cover)
                            </span>
                            <div class="position-relative overflow-hidden rounded-3 mb-2 shadow-sm" style="height: 180px; background: #e9ecef;">
                                <img id="previewCover" src="<?= !empty($event['cover_photo']) ? htmlspecialchars(media_url($event['cover_photo'])) : (!empty($galleries[0]) ? htmlspecialchars(media_url($galleries[0])) : 'https://images.unsplash.com/photo-1519741497674-611481863552?w=500') ?>" class="w-100 h-100 object-fit-cover" alt="Cover Preview">
                                <div id="loadingCover" class="position-absolute top-0 start-0 w-100 h-100 d-none justify-content-center align-items-center bg-dark bg-opacity-50 text-white">
                                    <div class="spinner-border spinner-border-sm me-2"></div> Uploading...
                                </div>
                            </div>
                            <small class="text-muted d-block mb-3" style="font-size: 11px;">Tampil di amplop awal saat link dibuka pertama kali</small>

                            <input type="file" name="cover_photo_file" id="fileInputCover" accept="image/*" class="d-none" onchange="handleDeviceUpload(this, 'cover')">
                            <input type="hidden" name="cover_photo" id="inputCoverPhoto" value="<?= htmlspecialchars($event['cover_photo'] ?? '') ?>">

                            <div class="d-grid gap-1 mt-auto">
                                <button type="button" class="btn btn-primary btn-sm rounded-pill" onclick="document.getElementById('fileInputCover').click()">
                                    <i class="bi bi-upload me-1"></i> Upload dari HP/PC
                                </button>
                                <div class="btn-group w-100">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="openGalleryPickerModal('cover')">
                                        <i class="bi bi-images me-1"></i> Dari Galeri
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleUrlInput('cover')">
                                        <i class="bi bi-link-45deg"></i> URL
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="clearPhotoSlot('cover')" title="Reset / Kosongkan">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <div id="urlInputContainer_cover" class="mt-2" style="display: none;">
                                    <input type="text" class="form-control form-control-sm rounded-3" placeholder="https://..." oninput="updateUrlSlot('cover', this.value)" value="<?= htmlspecialchars($event['cover_photo'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- B. Foto Utama Paling Atas (Hero Banner) -->
                    <div class="col-md-4">
                        <div class="card h-100 border rounded-4 p-3 bg-light text-center position-relative">
                            <span class="badge bg-primary text-white rounded-pill mb-2 align-self-center px-3 py-1 small">
                                <i class="bi bi-star-fill me-1 text-warning"></i> Foto Utama (Paling Atas)
                            </span>
                            <div class="position-relative overflow-hidden rounded-3 mb-2 shadow-sm" style="height: 180px; background: #e9ecef;">
                                <img id="previewHero" src="<?= !empty($event['hero_photo']) ? htmlspecialchars(media_url($event['hero_photo'])) : (!empty($event['cover_photo']) ? htmlspecialchars(media_url($event['cover_photo'])) : (!empty($galleries[0]) ? htmlspecialchars(media_url($galleries[0])) : 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=500')) ?>" class="w-100 h-100 object-fit-cover" alt="Hero Preview">
                                <div id="loadingHero" class="position-absolute top-0 start-0 w-100 h-100 d-none justify-content-center align-items-center bg-dark bg-opacity-50 text-white">
                                    <div class="spinner-border spinner-border-sm me-2"></div> Uploading...
                                </div>
                            </div>
                            <small class="text-muted d-block mb-3" style="font-size: 11px;">Tampil di bagian paling atas saat undangan dibuka</small>

                            <input type="file" name="hero_photo_file" id="fileInputHero" accept="image/*" class="d-none" onchange="handleDeviceUpload(this, 'hero')">
                            <input type="hidden" name="hero_photo" id="inputHeroPhoto" value="<?= htmlspecialchars($event['hero_photo'] ?? '') ?>">

                            <div class="d-grid gap-1 mt-auto">
                                <button type="button" class="btn btn-primary btn-sm rounded-pill" onclick="document.getElementById('fileInputHero').click()">
                                    <i class="bi bi-upload me-1"></i> Upload dari HP/PC
                                </button>
                                <div class="btn-group w-100">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="openGalleryPickerModal('hero')">
                                        <i class="bi bi-images me-1"></i> Dari Galeri
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleUrlInput('hero')">
                                        <i class="bi bi-link-45deg"></i> URL
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="clearPhotoSlot('hero')" title="Reset / Kosongkan">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <div id="urlInputContainer_hero" class="mt-2" style="display: none;">
                                    <input type="text" class="form-control form-control-sm rounded-3" placeholder="https://..." oninput="updateUrlSlot('hero', this.value)" value="<?= htmlspecialchars($event['hero_photo'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- C. Foto Background Undangan -->
                    <div class="col-md-4">
                        <div class="card h-100 border rounded-4 p-3 bg-light text-center position-relative">
                            <span class="badge bg-success text-white rounded-pill mb-2 align-self-center px-3 py-1 small">
                                <i class="bi bi-layers-half me-1"></i> Latar Belakang (Background)
                            </span>
                            <div class="position-relative overflow-hidden rounded-3 mb-2 shadow-sm" style="height: 180px; background: #e9ecef;">
                                <img id="previewBg" src="<?= !empty($event['bg_photo']) ? htmlspecialchars(media_url($event['bg_photo'])) : (!empty($event['cover_photo']) ? htmlspecialchars(media_url($event['cover_photo'])) : 'https://images.unsplash.com/photo-1519741497674-611481863552?w=500') ?>" class="w-100 h-100 object-fit-cover" alt="Background Preview">
                                <div id="loadingBg" class="position-absolute top-0 start-0 w-100 h-100 d-none justify-content-center align-items-center bg-dark bg-opacity-50 text-white">
                                    <div class="spinner-border spinner-border-sm me-2"></div> Uploading...
                                </div>
                            </div>
                            <small class="text-muted d-block mb-3" style="font-size: 11px;">Menjadi wallpaper latar belakang visual seluruh halaman</small>

                            <input type="file" name="bg_photo_file" id="fileInputBg" accept="image/*" class="d-none" onchange="handleDeviceUpload(this, 'bg')">
                            <input type="hidden" name="bg_photo" id="inputBgPhoto" value="<?= htmlspecialchars($event['bg_photo'] ?? '') ?>">

                            <div class="d-grid gap-1 mt-auto">
                                <button type="button" class="btn btn-primary btn-sm rounded-pill" onclick="document.getElementById('fileInputBg').click()">
                                    <i class="bi bi-upload me-1"></i> Upload dari HP/PC
                                </button>
                                <div class="btn-group w-100">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="openGalleryPickerModal('bg')">
                                        <i class="bi bi-images me-1"></i> Dari Galeri
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleUrlInput('bg')">
                                        <i class="bi bi-link-45deg"></i> URL
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="clearPhotoSlot('bg')" title="Reset / Kosongkan">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <div id="urlInputContainer_bg" class="mt-2" style="display: none;">
                                    <input type="text" class="form-control form-control-sm rounded-3" placeholder="https://..." oninput="updateUrlSlot('bg', this.value)" value="<?= htmlspecialchars($event['bg_photo'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Data Mempelai Pria & Wanita (Dengan Upload Foto Masing-masing) -->
            <div class="card border-0 rounded-4 shadow-sm p-4 mb-4 bg-white">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-heart text-danger me-2"></i> Profil Mempelai / Tokoh Acara</h5>
                
                <div class="p-3 bg-light rounded-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-primary m-0"><i class="bi bi-gender-male me-1"></i> Mempelai Pria</h6>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-3 text-center">
                            <div class="position-relative d-inline-block">
                                <img id="previewGroom" src="<?= !empty($event['groom_photo']) ? htmlspecialchars(media_url($event['groom_photo'])) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300' ?>" class="rounded-circle shadow-sm border border-3 border-primary object-fit-cover" style="width: 100px; height: 100px;" alt="Groom">
                                <div id="loadingGroom" class="position-absolute top-0 start-0 w-100 h-100 rounded-circle d-none justify-content-center align-items-center bg-dark bg-opacity-50 text-white">
                                    <div class="spinner-border spinner-border-sm"></div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <input type="file" name="groom_photo_file" id="fileInputGroom" accept="image/*" class="d-none" onchange="handleDeviceUpload(this, 'groom')">
                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1" style="font-size: 11px;" onclick="document.getElementById('fileInputGroom').click()">
                                    <i class="bi bi-camera me-1"></i> Upload Foto
                                </button>
                                <input type="hidden" name="groom_photo" id="inputGroomPhoto" value="<?= htmlspecialchars($event['groom_photo'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Lengkap & Gelar</label>
                                    <input type="text" name="groom_name" class="form-control rounded-3" value="<?= e($event['groom_name'] ?? '') ?>" placeholder="Budi Santoso, S.Kom">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Panggilan</label>
                                    <input type="text" name="groom_nickname" class="form-control rounded-3" value="<?= e($event['groom_nickname'] ?? '') ?>" placeholder="Budi">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Orang Tua</label>
                                    <input type="text" name="groom_parents" class="form-control rounded-3" value="<?= e($event['groom_parents'] ?? '') ?>" placeholder="Putra pertama dari Bpk. Bambang & Ibu Sri">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Instagram (@username)</label>
                                    <input type="text" name="groom_instagram" class="form-control rounded-3" value="<?= e($event['groom_instagram'] ?? '') ?>" placeholder="@budisantoso">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-danger m-0"><i class="bi bi-gender-female me-1"></i> Mempelai Wanita</h6>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-3 text-center">
                            <div class="position-relative d-inline-block">
                                <img id="previewBride" src="<?= !empty($event['bride_photo']) ? htmlspecialchars(media_url($event['bride_photo'])) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300' ?>" class="rounded-circle shadow-sm border border-3 border-danger object-fit-cover" style="width: 100px; height: 100px;" alt="Bride">
                                <div id="loadingBride" class="position-absolute top-0 start-0 w-100 h-100 rounded-circle d-none justify-content-center align-items-center bg-dark bg-opacity-50 text-white">
                                    <div class="spinner-border spinner-border-sm"></div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <input type="file" name="bride_photo_file" id="fileInputBride" accept="image/*" class="d-none" onchange="handleDeviceUpload(this, 'bride')">
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1" style="font-size: 11px;" onclick="document.getElementById('fileInputBride').click()">
                                    <i class="bi bi-camera me-1"></i> Upload Foto
                                </button>
                                <input type="hidden" name="bride_photo" id="inputBridePhoto" value="<?= htmlspecialchars($event['bride_photo'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Lengkap & Gelar</label>
                                    <input type="text" name="bride_name" class="form-control rounded-3" value="<?= e($event['bride_name'] ?? '') ?>" placeholder="Siti Aminah, S.Pd">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Panggilan</label>
                                    <input type="text" name="bride_nickname" class="form-control rounded-3" value="<?= e($event['bride_nickname'] ?? '') ?>" placeholder="Siti">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Orang Tua</label>
                                    <input type="text" name="bride_parents" class="form-control rounded-3" value="<?= e($event['bride_parents'] ?? '') ?>" placeholder="Putri kedua dari Bpk. H. Ahmad & Ibu Fatimah">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Instagram (@username)</label>
                                    <input type="text" name="bride_instagram" class="form-control rounded-3" value="<?= e($event['bride_instagram'] ?? '') ?>" placeholder="@sitiaminah">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label small fw-bold">Kata Mutiara / Ayat Suci</label>
                    <textarea name="quote" class="form-control rounded-3" rows="3"><?= e($event['quote'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- 4. Rangkaian Acara Pernikahan (Agama & Tradisi Budaya) -->
            <div class="card border-0 rounded-4 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
                    <div>
                        <h5 class="fw-bold text-dark m-0"><i class="bi bi-calendar2-heart text-success me-2"></i> Rangkaian Acara Pernikahan (Agama & Tradisi Budaya)</h5>
                        <p class="text-muted small m-0">Sesuaikan susunan acara dengan tradisi agama, adat budaya, atau buat susunan kustom bebas.</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <label class="small fw-bold text-secondary mb-0">Preset:</label>
                        <select name="event_type_preset" id="selectEventPreset" class="form-select form-select-sm rounded-pill border-primary fw-semibold" style="max-width: 270px;" onchange="applyReligionPreset(this.value)">
                            <option value="islam" <?= $currentPreset === 'islam' ? 'selected' : '' ?>>🕌 Islam (Akad & Walimah)</option>
                            <option value="kristen" <?= $currentPreset === 'kristen' ? 'selected' : '' ?>>✝️ Kristen (Pemberkatan & Resepsi)</option>
                            <option value="katolik" <?= $currentPreset === 'katolik' ? 'selected' : '' ?>>⛪ Katolik (Misa Sakramen)</option>
                            <option value="hindu" <?= $currentPreset === 'hindu' ? 'selected' : '' ?>>🕉️ Hindu (Pawiwahan Bali)</option>
                            <option value="buddha" <?= $currentPreset === 'buddha' ? 'selected' : '' ?>>☸️ Buddha (Vihara)</option>
                            <option value="batak" <?= $currentPreset === 'batak' ? 'selected' : '' ?>>🏔️ Adat Batak (Martumpol & Unjuk)</option>
                            <option value="jawa" <?= $currentPreset === 'jawa' ? 'selected' : '' ?>>🏛️ Adat Jawa (Siraman, Midodareni & Panggih)</option>
                            <option value="sunda" <?= $currentPreset === 'sunda' ? 'selected' : '' ?>>🌿 Adat Sunda (Ngeuyeuk Seureuh & Sawer)</option>
                            <option value="chinese" <?= $currentPreset === 'chinese' ? 'selected' : '' ?>>🍵 Tionghoa (Tea Pai & Banquet)</option>
                            <option value="nasional" <?= $currentPreset === 'nasional' ? 'selected' : '' ?>>✨ Nasional / Modern</option>
                            <option value="custom" <?= $currentPreset === 'custom' ? 'selected' : '' ?>>🛠️ Kustom Bebas</option>
                        </select>
                    </div>
                </div>

                <!-- Tombol Cepat Pilihan Agama / Budaya -->
                <div class="d-flex flex-wrap align-items-center gap-1.5 mb-3 pb-2 border-bottom">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('islam')">🕌 Islam</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('kristen')">✝️ Kristen</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('katolik')">⛪ Katolik</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('hindu')">🕉️ Hindu Bali</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('buddha')">☸️ Buddha</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('batak')">🏔️ Batak</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('jawa')">🏛️ Jawa</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('sunda')">🌿 Sunda</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('chinese')">🍵 Chinese</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2.5 small" onclick="setPresetQuick('custom')">🛠️ Kustom</button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill py-0 px-2.5 small ms-auto" onclick="applyPresetQuote()">
                        <i class="bi bi-chat-quote me-1"></i> Gunakan Ayat / Kata Mutiara Sesuai Tradisi
                    </button>
                </div>

                <!-- Container Sesi Acara Dinamis -->
                <div id="scheduleSessionsContainer" class="d-flex flex-column gap-3 mb-3">
                    <?php foreach ($schedules as $idx => $sItem): ?>
                        <div class="card border rounded-3 p-3 schedule-session-card bg-light position-relative shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary text-white rounded-pill px-3 py-1 session-badge">Sesi <?= $idx + 1 ?>: <?= htmlspecialchars($sItem['name'] ?? '') ?></span>
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-circle py-0 px-1.5 remove-session-btn" onclick="removeScheduleSession(this)" title="Hapus Sesi Acara Ini">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <label class="form-label small fw-bold mb-1">Nama Sesi Acara</label>
                                    <input type="text" name="schedule_name[]" class="form-control form-control-sm rounded-3 fw-semibold session-name-input" value="<?= htmlspecialchars($sItem['name'] ?? '') ?>" placeholder="Contoh: Pemberkatan / Akad Nikah" oninput="updateSessionBadge(this)">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold mb-1">Tanggal Acara</label>
                                    <input type="date" name="schedule_date[]" class="form-control form-control-sm rounded-3" value="<?= htmlspecialchars($sItem['date'] ?? ($event['event_date'] ?? '')) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold mb-1">Waktu / Jam</label>
                                    <input type="text" name="schedule_time[]" class="form-control form-control-sm rounded-3 session-time-input" value="<?= htmlspecialchars($sItem['time'] ?? '') ?>" placeholder="Contoh: 08.00 - 10.00 WIB">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small fw-bold mb-1">Nama Tempat / Gedung</label>
                                    <input type="text" name="schedule_place[]" class="form-control form-control-sm rounded-3 session-place-input" value="<?= htmlspecialchars($sItem['place'] ?? '') ?>" placeholder="Contoh: Gereja / Masjid / Ballroom Hotel">
                                </div>
                                <div class="col-md-7">
                                    <label class="form-label small fw-bold mb-1">Alamat Lengkap</label>
                                    <input type="text" name="schedule_address[]" class="form-control form-control-sm rounded-3 session-address-input" value="<?= htmlspecialchars($sItem['address'] ?? '') ?>" placeholder="Alamat jalan, kelurahan, kota...">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold mb-1 text-muted"><i class="bi bi-geo-alt me-1"></i> Link Google Maps Khusus Sesi Ini (Opsional jika beda tempat)</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="schedule_maps_url[]" class="form-control rounded-start-3" value="<?= htmlspecialchars($sItem['maps_url'] ?? '') ?>" placeholder="https://maps.google.com/...">
                                        <button type="button" class="btn btn-outline-secondary" onclick="usePlaceForSessionMap(this)">
                                            <i class="bi bi-search"></i> Cari dari Tempat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded-3 border">
                    <div>
                        <span class="fw-semibold text-dark d-block"><i class="bi bi-plus-circle-fill me-1 text-primary"></i> Kurang Sesi Acara?</span>
                        <small class="text-muted">Tambahkan sesi seperti Upacara Adat, Siraman, Midodareni, Pengajian, atau After Party.</small>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold shadow-sm" onclick="addScheduleSession()">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Sesi Acara Baru
                    </button>
                </div>

                <!-- Hidden inputs for backward compatibility -->
                <input type="hidden" name="akad_time" id="hiddenAkadTime" value="<?= htmlspecialchars($event['akad_time'] ?? '') ?>">
                <input type="hidden" name="akad_location" id="hiddenAkadLocation" value="<?= htmlspecialchars($event['akad_location'] ?? '') ?>">
                <input type="hidden" name="resepsi_time" id="hiddenResepsiTime" value="<?= htmlspecialchars($event['resepsi_time'] ?? '') ?>">
                <input type="hidden" name="resepsi_location" id="hiddenResepsiLocation" value="<?= htmlspecialchars($event['resepsi_location'] ?? '') ?>">

                <!-- Link Google Maps & Tag GPS Device Utama -->
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1 gap-1">
                            <label class="form-label small fw-bold mb-0"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Link Google Maps Utama (Tombol Navigasi GPS)</label>
                            <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 small" onclick="useLocationTextAsMaps()">
                                <i class="bi bi-search me-1"></i> Ambil dari Tempat Sesi Terpilih
                            </button>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-white text-danger border-end-0 rounded-start-3"><i class="bi bi-pin-map-fill"></i></span>
                            <input type="text" name="maps_url" id="inputMapsUrl" class="form-control border-start-0" value="<?= htmlspecialchars($event['maps_url'] ?? '') ?>" placeholder="Tempel link Google Maps, koordinat (-6.2088, 106.8456), atau klik Tag GPS..." oninput="autoGenerateMapEmbed(this.value)" onchange="autoGenerateMapEmbed(this.value)">
                            <button type="button" id="btnTagGps" class="btn btn-outline-primary rounded-end-3 px-3 fw-semibold shadow-sm" onclick="tagLocationFromDevice()" title="Gunakan GPS Perangkat Saat Ini">
                                <i class="bi bi-crosshair2 me-1"></i> Tag dari GPS Device (HP/PC)
                            </button>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 11px;">
                            <i class="bi bi-info-circle me-1"></i> Bisa paste link Maps (termasuk link Share / maps.app.goo.gl), koordinat lat,lng, atau klik tombol <b>Tag dari GPS Device</b> di atas.
                        </small>
                    </div>

                    <!-- Embed Google Maps (Iframe Peta Interaktif) -->
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label small fw-bold mb-0"><i class="bi bi-map-fill text-primary me-1"></i> Embed Google Maps (Iframe Peta Interaktif)</label>
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill py-0 px-2.5" style="font-size: 11px;" onclick="regenerateEmbedFromUrl()">
                                <i class="bi bi-arrow-clockwise me-1"></i> Generate Ulang Iframe
                            </button>
                        </div>
                        <textarea name="maps_embed" id="inputMapsEmbed" class="form-control rounded-3 small font-monospace" rows="2" placeholder="<iframe src=...></iframe>" oninput="updateMapPreview(this.value)"><?= htmlspecialchars($event['maps_embed'] ?? '') ?></textarea>
                        <small class="text-muted d-block mt-1 mb-2" style="font-size: 11px;">
                            <i class="bi bi-magic text-primary me-1"></i> Iframe peta ini <b>otomatis terisi</b> saat Anda mengisi Link Google Maps di atas atau menekan tombol Tag GPS Device.
                        </small>

                        <!-- Live Preview Box -->
                        <div class="border rounded-4 p-2.5 bg-light shadow-sm">
                            <div class="d-flex align-items-center justify-content-between px-2 py-1 mb-1 border-bottom">
                                <span class="small fw-semibold text-secondary"><i class="bi bi-eye-fill me-1"></i> Pratinjau Tampilan Peta Interaktif di Undangan:</span>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1 small" id="mapStatusBadge">
                                    <i class="bi bi-check-circle me-1"></i> Terhubung Peta
                                </span>
                            </div>
                            <div id="mapPreviewBox" class="rounded-3 overflow-hidden" style="min-height: 220px;">
                                <?php if (!empty($event['maps_embed'])): ?>
                                    <?= $event['maps_embed'] ?>
                                <?php else: ?>
                                    <div class="py-5 text-center text-muted">
                                        <i class="bi bi-pin-map display-5 d-block mb-2 text-secondary opacity-50"></i>
                                        <p class="m-0 small">Peta interaktif akan langsung muncul di sini setelah Anda mengisi Link Maps atau menekan <b>Tag dari GPS Device</b>.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Amplop Digital & Kado Fisik -->
            <div class="card border-0 rounded-4 shadow-sm p-4 mb-4 bg-white">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-wallet2 text-warning me-2"></i> Rekening Amplop Digital & Titip Kado</h5>
                
                <div id="bankList">
                    <?php if (empty($bankAccounts)): ?>
                        <div class="row g-2 mb-2 bank-row">
                            <div class="col-3"><input type="text" name="bank_name[]" class="form-control rounded-3 small" placeholder="Nama Bank (BCA)"></div>
                            <div class="col-4"><input type="text" name="bank_number[]" class="form-control rounded-3 small" placeholder="No. Rekening"></div>
                            <div class="col-5"><input type="text" name="bank_owner[]" class="form-control rounded-3 small" placeholder="Atas Nama"></div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($bankAccounts as $acc): ?>
                            <div class="row g-2 mb-2 bank-row">
                                <div class="col-3"><input type="text" name="bank_name[]" class="form-control rounded-3 small" value="<?= htmlspecialchars($acc['bank']) ?>" placeholder="Bank"></div>
                                <div class="col-4"><input type="text" name="bank_number[]" class="form-control rounded-3 small" value="<?= htmlspecialchars($acc['number']) ?>" placeholder="No Rek"></div>
                                <div class="col-5"><input type="text" name="bank_owner[]" class="form-control rounded-3 small" value="<?= htmlspecialchars($acc['owner']) ?>" placeholder="Atas Nama"></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill mb-3" onclick="addBankRow()">
                    <i class="bi bi-plus"></i> Tambah Rekening Lain
                </button>

                <div>
                    <label class="form-label small fw-bold">Alamat Pengiriman Kado Fisik</label>
                    <textarea name="gift_address" class="form-control rounded-3" rows="2" placeholder="Alamat lengkap penerima kado..."><?= htmlspecialchars($event['gift_address'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- 6. Galeri Foto Prewedding & Manajemen Foto Cepat -->
            <div class="card border-0 rounded-4 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
                    <div>
                        <h5 class="fw-bold text-dark m-0"><i class="bi bi-images text-info me-2"></i> Galeri Foto Prewedding</h5>
                        <p class="text-muted small m-0">Upload foto dari HP/PC atau input link URL. Anda bisa langsung menentukan foto mana yang jadi Cover, Foto Utama, atau Background.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <input type="file" name="gallery_files[]" id="multiGalleryFileInput" multiple accept="image/*" class="d-none" onchange="handleMultipleDeviceUpload(this)">
                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" onclick="document.getElementById('multiGalleryFileInput').click()">
                            <i class="bi bi-cloud-arrow-up me-1"></i> Upload Foto dari HP/PC
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="addCustomGalleryRow()">
                            <i class="bi bi-link-45deg me-1"></i> Tambah URL
                        </button>
                    </div>
                </div>

                <!-- Dropzone Area Interaktif Drag & Drop -->
                <div id="galleryDropZone" class="border border-2 border-dashed rounded-4 p-4 text-center mb-4 bg-light cursor-pointer position-relative shadow-sm" onclick="document.getElementById('multiGalleryFileInput').click()" style="transition: all 0.25s ease; border-color: #cbd5e1 !important;">
                    <i class="bi bi-cloud-arrow-up-fill text-primary display-4 d-block mb-2 drop-icon" style="transition: transform 0.25s;"></i>
                    <h6 class="fw-bold text-dark mb-1">Klik di sini atau Tarik Foto dari Device Anda</h6>
                    <p class="text-muted small mb-0">Mendukung format JPG, PNG, WEBP — bisa tarik & lepas (drag & drop) banyak file sekaligus</p>
                    <div id="multiUploadProgress" class="progress mt-3 d-none" style="height: 6px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: 100%"></div>
                    </div>
                </div>

                <!-- Grid Kartu Galeri Responsif -->
                <div class="row g-3" id="galleryGrid">
                    <?php if (!empty($galleries)): ?>
                        <?php foreach ($galleries as $idx => $gPhoto): ?>
                            <?php $resolvedGPhoto = media_url($gPhoto); ?>
                            <div class="col-6 col-md-4 col-lg-3 gallery-item-card" data-photo-url="<?= htmlspecialchars($gPhoto) ?>">
                                <div class="card h-100 border rounded-3 shadow-sm position-relative">
                                    <div class="position-relative overflow-hidden rounded-top-3" style="height: 150px;">
                                        <img src="<?= htmlspecialchars($resolvedGPhoto) ?>" class="w-100 h-100 object-fit-cover" alt="Foto Galeri">
                                        <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 m-1 py-0 px-1.5 shadow" onclick="removeGalleryCard(this)" title="Hapus Foto">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <div class="p-2 bg-white rounded-bottom-3">
                                        <input type="hidden" name="gallery_url[]" value="<?= htmlspecialchars($gPhoto) ?>" class="gallery-url-input">
                                        
                                        <div class="dropdown">
                                            <button class="btn btn-outline-dark btn-sm w-100 rounded-pill dropdown-toggle py-1" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" style="font-size: 11px;">
                                                <i class="bi bi-magic me-1"></i> Jadikan Sebagai...
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 small">
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('cover', '<?= htmlspecialchars(addslashes($gPhoto)) ?>')"><i class="bi bi-envelope-paper text-warning me-2"></i> Jadikan Cover Pembuka</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('hero', '<?= htmlspecialchars(addslashes($gPhoto)) ?>')"><i class="bi bi-star-fill text-primary me-2"></i> Jadikan Foto Utama (Hero)</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('bg', '<?= htmlspecialchars(addslashes($gPhoto)) ?>')"><i class="bi bi-layers-half text-success me-2"></i> Jadikan Background</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('groom', '<?= htmlspecialchars(addslashes($gPhoto)) ?>')"><i class="bi bi-gender-male text-primary me-2"></i> Jadikan Foto Pria</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('bride', '<?= htmlspecialchars(addslashes($gPhoto)) ?>')"><i class="bi bi-gender-female text-danger me-2"></i> Jadikan Foto Wanita</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Input List URL Manual Tambahan -->
                <div id="customGalleryList" class="mt-3"></div>
            </div>

            <!-- 7. KISAH CINTA & PERJALANAN (LOVE STORY / OUR JOURNEY) -->
            <div class="card border-0 rounded-4 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
                    <div>
                        <h5 class="fw-bold text-dark m-0"><i class="bi bi-heart-fill text-danger me-2"></i> Kisah Cinta & Perjalanan (Love Story / Our Journey)</h5>
                        <p class="text-muted small m-0">Ceritakan momen berkesan pertemuan hingga menuju pelaminan yang akan tampil elegan di undangan Anda.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="applyExampleLoveStories()">
                            <i class="bi bi-magic me-1 text-warning"></i> Gunakan Contoh Kisah
                        </button>
                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" onclick="addLoveStoryItem()">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Babak Cerita
                        </button>
                    </div>
                </div>

                <div id="loveStoryContainer" class="d-flex flex-column gap-3">
                    <?php if (empty($loveStories)): ?>
                        <div id="emptyLoveStoryNotice" class="border rounded-4 p-4 text-center bg-light text-muted">
                            <i class="bi bi-chat-heart display-5 text-danger opacity-50 d-block mb-2"></i>
                            <h6 class="fw-bold text-dark mb-1">Belum Ada Kisah Perjalanan Cinta</h6>
                            <p class="small text-muted mb-3">Bagikan momen pertemuan pertama, masa pacaran, hingga lamaran agar undangan semakin berkesan dan romantis bagi tamu.</p>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" onclick="addLoveStoryItem()">
                                    <i class="bi bi-plus-lg me-1"></i> Mulai Tulis Kisah Cinta
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="applyExampleLoveStories()">
                                    <i class="bi bi-magic me-1"></i> Pakai Contoh Cepat
                                </button>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($loveStories as $sIdx => $story): ?>
                            <?php
                                $sTitle = $story['title'] ?? '';
                                $sYear = $story['year'] ?? ($story['date'] ?? '');
                                $sDesc = $story['desc'] ?? ($story['story'] ?? '');
                                $sImg = $story['image'] ?? '';
                                $sResolvedImg = !empty($sImg) ? media_url($sImg) : '';
                            ?>
                            <div class="card border rounded-3 p-3 love-story-item bg-light position-relative shadow-sm">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-danger text-white rounded-pill px-3 py-1 story-badge">
                                        Babak <?= $sIdx + 1 ?>: <?= htmlspecialchars($sTitle ?: 'Momen Spesial') ?>
                                    </span>
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-circle py-0 px-1.5" onclick="removeLoveStoryItem(this)" title="Hapus Babak Ini">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-3 text-center">
                                        <div class="position-relative overflow-hidden rounded-3 border bg-white mx-auto mb-2" style="width: 100%; max-width: 150px; height: 110px;">
                                            <img src="<?= !empty($sResolvedImg) ? htmlspecialchars($sResolvedImg) : 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=400' ?>" class="w-100 h-100 object-fit-cover story-img-preview" alt="Foto Momen">
                                        </div>
                                        <input type="hidden" name="story_image[]" class="story-img-input" value="<?= htmlspecialchars($sImg) ?>">
                                        <input type="file" accept="image/*" class="d-none story-file-input" onchange="handleStoryPhotoUpload(this)">
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill py-0 px-2 small w-100 mb-1" style="font-size: 11px;" onclick="this.previousElementSibling.click()">
                                            <i class="bi bi-camera me-1"></i> Upload Foto
                                        </button>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row g-2">
                                            <div class="col-md-8">
                                                <label class="form-label small fw-bold mb-1">Judul Momen / Babak Kisah</label>
                                                <input type="text" name="story_title[]" class="form-control form-control-sm rounded-3 fw-semibold story-title-input" value="<?= htmlspecialchars($sTitle) ?>" placeholder="Contoh: Pertemuan Pertama / Menjalin Komitmen" oninput="updateStoryBadge(this)" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label small fw-bold mb-1">Tahun / Waktu</label>
                                                <input type="text" name="story_year[]" class="form-control form-control-sm rounded-3 story-year-input" value="<?= htmlspecialchars($sYear) ?>" placeholder="Contoh: 2020 / Mei 2021">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label small fw-bold mb-1">Deskripsi / Cerita Singkat</label>
                                                <textarea name="story_desc[]" class="form-control form-control-sm rounded-3 story-desc-input" rows="2" placeholder="Ceritakan bagaimana momen bahagia ini terjadi..."><?= htmlspecialchars($sDesc) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Theme Swatch Variable Override -->
            <style>
                .gallery-item-card {
                    position: relative;
                    z-index: 1;
                }
                .gallery-item-card:hover,
                .gallery-item-card:focus-within {
                    z-index: 1050;
                }
                .gallery-item-card .dropdown-menu {
                    z-index: 1060 !important;
                    min-width: 205px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18) !important;
                }
                #mapPreviewBox iframe {
                    width: 100% !important;
                    height: 260px !important;
                    border: 0 !important;
                    border-radius: 8px !important;
                    display: block;
                }
                .schedule-session-card {
                    transition: border-color 0.2s;
                }
                .schedule-session-card:hover {
                    border-color: #94a3b8 !important;
                }
            </style>

            <div class="d-flex flex-wrap justify-content-end gap-2 sticky-bottom bg-white p-3 border rounded-4 shadow-lg mb-5">
                <?php if (is_admin()): ?>
                    <a href="<?= base_url('admin/events') ?>" class="btn btn-outline-secondary rounded-pill px-3 py-2 small fw-semibold">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Admin
                    </a>
                    <button type="submit" name="save_and_to_admin" value="1" class="btn btn-outline-success rounded-pill px-4 py-2 fw-semibold small">
                        <i class="bi bi-check-all me-1"></i> Simpan & Ke Admin
                    </button>
                <?php else: ?>
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-light rounded-pill px-4 py-2">Kembali</a>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary-custom rounded-pill px-5 py-2 fw-semibold">
                    <i class="bi bi-check-lg me-1"></i> Simpan Seluruh Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Pemilih Foto dari Galeri -->
<div class="modal fade" id="galleryPickerModal" tabindex="-1" aria-labelledby="galleryPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="galleryPickerModalLabel">Pilih Foto dari Galeri</h5>
                    <p class="text-muted small m-0" id="galleryPickerSubtext">Pilih foto yang ingin dijadikan sebagai Sampul, Foto Utama, atau Background</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="galleryPickerEmpty" class="text-center py-5 d-none">
                    <i class="bi bi-images display-3 text-muted"></i>
                    <p class="text-muted mt-2">Belum ada foto di Galeri. Silakan upload foto terlebih dahulu!</p>
                </div>
                <div class="row g-3" id="galleryPickerGrid"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pemilih Musik Romantis -->
<div class="modal fade" id="musicPickerModal" tabindex="-1" aria-labelledby="musicPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="musicPickerModalLabel">
                        <i class="bi bi-music-note-list text-primary me-2"></i> Koleksi Musik Pernikahan Romantis
                    </h5>
                    <p class="text-muted small m-0">Dengarkan cuplikan lagu pengiring undangan di bawah ini lalu klik tombol "Gunakan Lagu Ini".</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="stopAllPlaylistAudios()"></button>
            </div>
            <div class="modal-body p-4">
                <div class="list-group list-group-flush gap-2" id="curatedMusicList">
                    <?php foreach (get_curated_wedding_music() as $cMusic): ?>
                        <div class="list-group-item border rounded-3 p-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <button type="button" class="btn btn-outline-primary btn-sm rounded-circle p-2 d-flex align-items-center justify-content-center music-audition-btn" style="width: 42px; height: 42px;" onclick="toggleAuditionPlay(this, '<?= htmlspecialchars(addslashes($cMusic['url'])) ?>')">
                                    <i class="bi bi-play-fill fs-5"></i>
                                </button>
                                <div>
                                    <span class="fw-bold text-dark d-block"><?= htmlspecialchars($cMusic['title']) ?></span>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill small"><?= htmlspecialchars($cMusic['category']) ?></span>
                                        <small class="text-muted"><i class="bi bi-person me-1"></i><?= htmlspecialchars($cMusic['artist']) ?></small>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i><?= htmlspecialchars($cMusic['duration']) ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 py-1.5 fw-semibold text-nowrap" onclick="selectCuratedMusic('<?= htmlspecialchars(addslashes($cMusic['url'])) ?>', '<?= htmlspecialchars(addslashes($cMusic['title'])) ?>')">
                                    <i class="bi bi-check2-circle me-1"></i> Gunakan Lagu Ini
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" onclick="stopAllPlaylistAudios()">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
// Target role yang sedang aktif memilih dari modal galeri
let currentPickerTarget = 'cover';

// Upload Single Photo via AJAX
function handleDeviceUpload(fileInput, role) {
    if (!fileInput.files || !fileInput.files[0]) return;
    const file = fileInput.files[0];

    // Local Preview instan
    const objectUrl = URL.createObjectURL(file);
    updatePreviewImage(role, objectUrl);

    // Tampilkan loading spinner
    const loaderId = 'loading' + role.charAt(0).toUpperCase() + role.slice(1);
    const loader = document.getElementById(loaderId);
    if (loader) {
        loader.classList.remove('d-none');
        loader.classList.add('d-flex');
    }

    // Kirim AJAX ke endpoint upload
    const formData = new FormData();
    formData.append('photo', file);
    formData.append('role', role);

    fetch('<?= base_url('dashboard/upload-photo') ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (loader) {
            loader.classList.remove('d-flex');
            loader.classList.add('d-none');
        }
        if (data.success) {
            setDesignatedPhoto(role, data.path || data.url);
            showToastMessage('Foto berhasil diunggah!');
        } else {
            alert(data.message || 'Gagal mengunggah foto.');
        }
    })
    .catch(err => {
        if (loader) {
            loader.classList.remove('d-flex');
            loader.classList.add('d-none');
        }
        console.error(err);
    });
}

// Upload Multiple Photos ke Galeri Prewedding via AJAX
function handleMultipleDeviceUpload(fileInput) {
    if (!fileInput.files || fileInput.files.length === 0) return;
    uploadFilesArray(fileInput.files);
    fileInput.value = '';
}

function uploadFilesArray(files) {
    if (!files || files.length === 0) return;
    const progressBar = document.getElementById('multiUploadProgress');
    if (progressBar) progressBar.classList.remove('d-none');

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append('photos[]', files[i]);
    }

    fetch('<?= base_url('dashboard/upload-photo') ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (progressBar) progressBar.classList.add('d-none');
        if (data.success && data.files) {
            data.files.forEach(f => {
                appendGalleryCard(f.path, f.url);
            });
            showToastMessage(data.files.length + ' foto berhasil ditambahkan ke galeri!');
        } else {
            alert(data.message || 'Gagal mengunggah foto galeri.');
        }
    })
    .catch(err => {
        if (progressBar) progressBar.classList.add('d-none');
        console.error(err);
        alert('Terjadi kendala saat mengunggah foto.');
    });
}

// Tambah Kartu Galeri ke Grid
function appendGalleryCard(path, fullUrl) {
    const grid = document.getElementById('galleryGrid');
    const col = document.createElement('div');
    col.className = 'col-6 col-md-4 col-lg-3 gallery-item-card';
    col.setAttribute('data-photo-url', path);
    const escapedPath = path.replace(/'/g, "\\'");
    col.innerHTML = `
        <div class="card h-100 border rounded-3 shadow-sm position-relative">
            <div class="position-relative overflow-hidden rounded-top-3" style="height: 150px;">
                <img src="${fullUrl}" class="w-100 h-100 object-fit-cover" alt="Foto Galeri">
                <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 m-1 py-0 px-1.5 shadow" onclick="removeGalleryCard(this)" title="Hapus Foto">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="p-2 bg-white rounded-bottom-3">
                <input type="hidden" name="gallery_url[]" value="${path}" class="gallery-url-input">
                <div class="dropdown">
                    <button class="btn btn-outline-dark btn-sm w-100 rounded-pill dropdown-toggle py-1" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" style="font-size: 11px;">
                        <i class="bi bi-magic me-1"></i> Jadikan Sebagai...
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 small">
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('cover', '${escapedPath}')"><i class="bi bi-envelope-paper text-warning me-2"></i> Jadikan Cover Pembuka</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('hero', '${escapedPath}')"><i class="bi bi-star-fill text-primary me-2"></i> Jadikan Foto Utama (Hero)</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('bg', '${escapedPath}')"><i class="bi bi-layers-half text-success me-2"></i> Jadikan Background</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('groom', '${escapedPath}')"><i class="bi bi-gender-male text-primary me-2"></i> Jadikan Foto Pria</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="setDesignatedPhoto('bride', '${escapedPath}')"><i class="bi bi-gender-female text-danger me-2"></i> Jadikan Foto Wanita</a></li>
                    </ul>
                </div>
            </div>
        </div>
    `;
    grid.appendChild(col);
}

// Menetapkan Foto ke Peran Spesifik (Cover, Hero, Background, Groom, Bride)
function setDesignatedPhoto(role, photoPath) {
    if (!photoPath) return;
    const inputId = 'input' + role.charAt(0).toUpperCase() + role.slice(1) + 'Photo';
    const input = document.getElementById(inputId);
    if (input) {
        input.value = photoPath;
    }

    // Update Preview
    const resolvedUrl = (photoPath.startsWith('http://') || photoPath.startsWith('https://') || photoPath.startsWith('//')) 
        ? photoPath 
        : '<?= base_url() ?>/' + photoPath.replace(/^\/+/, '');
    updatePreviewImage(role, resolvedUrl);

    // Feedback Toast
    const roleNames = {
        cover: 'Sampul Pembuka (Cover)',
        hero: 'Foto Utama Paling Atas',
        bg: 'Latar Belakang (Background)',
        groom: 'Mempelai Pria',
        bride: 'Mempelai Wanita'
    };
    showToastMessage(`Foto berhasil ditetapkan sebagai ${roleNames[role] || role}!`);
}

function updatePreviewImage(role, url) {
    const previewId = 'preview' + role.charAt(0).toUpperCase() + role.slice(1);
    const img = document.getElementById(previewId);
    if (img) {
        img.src = url;
    }
}

function clearPhotoSlot(role) {
    const inputId = 'input' + role.charAt(0).toUpperCase() + role.slice(1) + 'Photo';
    const input = document.getElementById(inputId);
    if (input) input.value = '';
    updatePreviewImage(role, 'https://images.unsplash.com/photo-1519741497674-611481863552?w=500');
    showToastMessage('Foto slot ' + role + ' berhasil dikosongkan.');
}

function toggleUrlInput(role) {
    const container = document.getElementById('urlInputContainer_' + role);
    if (container) {
        container.style.display = container.style.display === 'none' ? 'block' : 'none';
    }
}

function updateUrlSlot(role, url) {
    if (url.trim()) {
        setDesignatedPhoto(role, url.trim());
    }
}

function removeGalleryCard(btn) {
    const card = btn.closest('.gallery-item-card');
    if (card) {
        card.remove();
        showToastMessage('Foto dihapus dari galeri.');
    }
}

// Modal Pemilih dari Galeri
function openGalleryPickerModal(targetRole) {
    currentPickerTarget = targetRole;
    const modalEl = document.getElementById('galleryPickerModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    const grid = document.getElementById('galleryPickerGrid');
    const emptyNotice = document.getElementById('galleryPickerEmpty');
    grid.innerHTML = '';

    // Ambil seluruh foto yang ada di galeri saat ini
    const galleryCards = document.querySelectorAll('#galleryGrid .gallery-item-card');
    if (galleryCards.length === 0) {
        emptyNotice.classList.remove('d-none');
    } else {
        emptyNotice.classList.add('d-none');
        galleryCards.forEach(c => {
            const path = c.getAttribute('data-photo-url');
            const imgEl = c.querySelector('img');
            const imgSrc = imgEl ? imgEl.src : path;

            const col = document.createElement('div');
            col.className = 'col-4 col-md-3 text-center';
            col.innerHTML = `
                <div class="card h-100 border rounded-3 overflow-hidden cursor-pointer shadow-sm picker-card" style="transition: transform 0.2s;" onclick="selectFromGallery('${path.replace(/'/g, "\\'")}')">
                    <img src="${imgSrc}" class="w-100 object-fit-cover" style="height: 120px;" alt="Pilih">
                    <div class="p-1 bg-white small fw-semibold text-primary">
                        <i class="bi bi-check-circle me-1"></i> Pilih Ini
                    </div>
                </div>
            `;
            grid.appendChild(col);
        });
    }

    modal.show();
}

function selectFromGallery(path) {
    setDesignatedPhoto(currentPickerTarget, path);
    const modalEl = document.getElementById('galleryPickerModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

// Tambah Baris URL Manual
function addCustomGalleryRow() {
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <span class="input-group-text bg-light"><i class="bi bi-link"></i></span>
        <input type="url" class="form-control rounded-start-0" placeholder="https://images.unsplash.com/..." onchange="appendManualUrl(this)">
        <button type="button" class="btn btn-outline-danger" onclick="this.closest('.input-group').remove()"><i class="bi bi-trash"></i></button>
    `;
    document.getElementById('customGalleryList').appendChild(div);
}

function appendManualUrl(input) {
    const val = input.value.trim();
    if (val) {
        appendGalleryCard(val, val);
        input.closest('.input-group').remove();
    }
}

// Tambah Rekening
function addBankRow() {
    const div = document.createElement('div');
    div.className = 'row g-2 mb-2 bank-row';
    div.innerHTML = `
        <div class="col-3"><input type="text" name="bank_name[]" class="form-control rounded-3 small" placeholder="Nama Bank (BCA)"></div>
        <div class="col-4"><input type="text" name="bank_number[]" class="form-control rounded-3 small" placeholder="No. Rekening"></div>
        <div class="col-5"><input type="text" name="bank_owner[]" class="form-control rounded-3 small" placeholder="Atas Nama"></div>
    `;
    document.getElementById('bankList').appendChild(div);
}

// Simple Toast Notification
function showToastMessage(msg) {
    let toast = document.getElementById('pendarToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'pendarToast';
        toast.className = 'position-fixed bottom-0 end-0 m-4 p-3 bg-dark text-white rounded-4 shadow-lg';
        toast.style.zIndex = '99999';
        toast.style.transition = 'all 0.3s ease';
        document.body.appendChild(toast);
    }
    toast.innerHTML = `<i class="bi bi-check-circle-fill text-success me-2"></i> ${msg}`;
    toast.style.display = 'block';
    toast.style.opacity = '1';
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.style.display = 'none', 300);
    }, 2800);
}

// ==========================================
// GOOGLE MAPS AUTO-EMBED & GPS TAGGING
// ==========================================

// Otomatis Mengisi Iframe Embed dari Link / Koordinat / Teks Maps
function autoGenerateMapEmbed(val) {
    if (!val || !val.trim()) {
        updateMapPreview('');
        return;
    }
    val = val.trim();

    // Kasus 1: User mem-paste seluruh tag <iframe> ke dalam input
    if (val.includes('<iframe') && val.includes('src=')) {
        const srcMatch = val.match(/src=["']([^"']+)["']/i);
        if (srcMatch && srcMatch[1]) {
            const cleanIframe = `<iframe src="${srcMatch[1]}" width="100%" height="350" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;
            document.getElementById('inputMapsEmbed').value = cleanIframe;
            document.getElementById('inputMapsUrl').value = srcMatch[1];
            updateMapPreview(cleanIframe);
            return;
        }
    }

    let embedSrc = '';

    // Kasus 2: Koordinat murni lat,lng (misal: -6.2088, 106.8456 atau @-6.2088,106.8456)
    const coordPattern = /@?(-?\d+\.\d+)\s*,\s*(-?\d+\.\d+)/;
    const coordMatch = val.match(coordPattern);

    // Kasus 3: URL berisi parameter q= atau query=
    let qParam = null;
    try {
        if (val.startsWith('http')) {
            const parsedUrl = new URL(val);
            qParam = parsedUrl.searchParams.get('q') || parsedUrl.searchParams.get('query');
        }
    } catch(e) {}

    // Kasus 4: URL berisi /place/Nama+Tempat/
    const placeMatch = val.match(/\/place\/([^/@?]+)/);

    if (coordMatch) {
        const lat = coordMatch[1];
        const lng = coordMatch[2];
        embedSrc = `https://maps.google.com/maps?q=${lat},${lng}&hl=id&z=16&output=embed`;
    } else if (qParam) {
        embedSrc = `https://maps.google.com/maps?q=${encodeURIComponent(qParam)}&hl=id&z=16&output=embed`;
    } else if (placeMatch && placeMatch[1]) {
        const placeName = decodeURIComponent(placeMatch[1].replace(/\+/g, ' '));
        embedSrc = `https://maps.google.com/maps?q=${encodeURIComponent(placeName)}&hl=id&z=16&output=embed`;
    } else if (val.startsWith('http://') || val.startsWith('https://')) {
        embedSrc = `https://maps.google.com/maps?q=${encodeURIComponent(val)}&hl=id&z=15&output=embed`;
    } else {
        embedSrc = `https://maps.google.com/maps?q=${encodeURIComponent(val)}&hl=id&z=16&output=embed`;
    }

    const iframeHtml = `<iframe src="${embedSrc}" width="100%" height="350" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;
    
    const embedInput = document.getElementById('inputMapsEmbed');
    if (embedInput) {
        embedInput.value = iframeHtml;
    }
    updateMapPreview(iframeHtml);
}

// Update Tampilan Pratinjau Peta
function updateMapPreview(iframeHtml) {
    const box = document.getElementById('mapPreviewBox');
    const badge = document.getElementById('mapStatusBadge');
    if (!box) return;

    if (iframeHtml && iframeHtml.trim()) {
        box.innerHTML = iframeHtml;
        if (badge) {
            badge.className = 'badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1 small';
            badge.innerHTML = '<i class="bi bi-check-circle me-1"></i> Terhubung Peta';
        }
    } else {
        box.innerHTML = `
            <div class="py-5 text-center text-muted">
                <i class="bi bi-pin-map display-5 d-block mb-2 text-secondary opacity-50"></i>
                <p class="m-0 small">Peta interaktif akan langsung muncul di sini setelah Anda mengisi Link Maps atau menekan <b>Tag dari GPS Device</b>.</p>
            </div>
        `;
        if (badge) {
            badge.className = 'badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-2.5 py-1 small';
            badge.innerHTML = 'Belum Ada Peta';
        }
    }
}

// Tombol Auto-Generate Ulang dari Link
function regenerateEmbedFromUrl() {
    const url = document.getElementById('inputMapsUrl')?.value;
    if (url && url.trim()) {
        autoGenerateMapEmbed(url.trim());
        showToastMessage('Iframe peta berhasil digenerate ulang!');
    } else {
        alert('Silakan masukkan Link Google Maps terlebih dahulu.');
    }
}

// Ambil Nama Tempat Resepsi / Akad Menjadi Pencarian Maps
function useLocationTextAsMaps() {
    const resepsi = document.getElementById('inputResepsiLocation')?.value?.trim();
    const akad = document.getElementById('inputAkadLocation')?.value?.trim();
    const locationText = resepsi || akad;

    if (!locationText) {
        alert('Silakan isi kolom Tempat Resepsi atau Tempat Akad terlebih dahulu!');
        return;
    }

    const mapsUrl = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(locationText)}`;
    const mapsInput = document.getElementById('inputMapsUrl');
    if (mapsInput) mapsInput.value = mapsUrl;

    autoGenerateMapEmbed(locationText);
    showToastMessage(`Lokasi disetel dari: "${locationText}"`);
}

// Tag Lokasi GPS Langsung dari Perangkat (HP / PC)
function tagLocationFromDevice() {
    if (!navigator.geolocation) {
        alert('Browser atau perangkat Anda tidak mendukung fitur pendeteksi lokasi GPS (Geolocation).');
        return;
    }

    const btn = document.getElementById('btnTagGps');
    const originalContent = btn ? btn.innerHTML : '';
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1" role="status"></span> Mendeteksi Lokasi GPS...`;
    }

    navigator.geolocation.getCurrentPosition(
        function(pos) {
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = originalContent;
            }

            const lat = pos.coords.latitude.toFixed(6);
            const lng = pos.coords.longitude.toFixed(6);
            const mapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;

            // Isi Input Link Maps
            const mapsInput = document.getElementById('inputMapsUrl');
            if (mapsInput) mapsInput.value = mapsUrl;

            // Buat Embed Iframe Maps
            const embedSrc = `https://maps.google.com/maps?q=${lat},${lng}&hl=id&z=17&output=embed`;
            const iframeHtml = `<iframe src="${embedSrc}" width="100%" height="350" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;
            
            const embedInput = document.getElementById('inputMapsEmbed');
            if (embedInput) embedInput.value = iframeHtml;

            // Render Preview
            updateMapPreview(iframeHtml);

            showToastMessage(`📍 Lokasi GPS perangkat berhasil ditandai (${lat}, ${lng})!`);
        },
        function(err) {
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = originalContent;
            }

            let msg = 'Gagal mendeteksi lokasi GPS.';
            if (err.code === 1) {
                msg = 'Izin akses lokasi GPS ditolak oleh browser/perangkat Anda. Mohon izinkan akses lokasi di pengaturan browser.';
            } else if (err.code === 2) {
                msg = 'Sinyal GPS / posisi tidak tersedia di perangkat Anda.';
            } else if (err.code === 3) {
                msg = 'Waktu permintaan lokasi GPS habis (timeout). Coba ulangi kembali.';
            }
            alert(msg);
        },
        { enableHighAccuracy: true, timeout: 12000, maximumAge: 0 }
    );
}

// Lifecycle Listener Dropdown untuk Z-Index Galeri
document.addEventListener('show.bs.dropdown', function (e) {
    const card = e.target.closest('.gallery-item-card');
    if (card) card.classList.add('dropdown-active');
});
document.addEventListener('hidden.bs.dropdown', function (e) {
    const card = e.target.closest('.gallery-item-card');
    if (card) card.classList.remove('dropdown-active');
});

// ==========================================
// DRAG & DROP PHOTO UPLOAD SUPPORT
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    const galleryDropZone = document.getElementById('galleryDropZone');
    if (galleryDropZone) {
        ['dragenter', 'dragover'].forEach(evt => {
            galleryDropZone.addEventListener(evt, (e) => {
                e.preventDefault();
                e.stopPropagation();
                galleryDropZone.classList.add('border-primary', 'bg-primary-subtle', 'shadow');
                const icon = galleryDropZone.querySelector('.drop-icon');
                if (icon) icon.style.transform = 'scale(1.15)';
            }, false);
        });

        ['dragleave', 'dragend'].forEach(evt => {
            galleryDropZone.addEventListener(evt, (e) => {
                e.preventDefault();
                e.stopPropagation();
                galleryDropZone.classList.remove('border-primary', 'bg-primary-subtle', 'shadow');
                const icon = galleryDropZone.querySelector('.drop-icon');
                if (icon) icon.style.transform = 'scale(1)';
            }, false);
        });

        galleryDropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            galleryDropZone.classList.remove('border-primary', 'bg-primary-subtle', 'shadow');
            const icon = galleryDropZone.querySelector('.drop-icon');
            if (icon) icon.style.transform = 'scale(1)';
            
            const dt = e.dataTransfer;
            if (dt && dt.files && dt.files.length > 0) {
                uploadFilesArray(dt.files);
            }
        }, false);
    }

    // Pasang Drag & Drop ke Slot Foto Utama, Cover, Background, Groom, Bride
    setupSlotDropZone('previewCover', 'cover');
    setupSlotDropZone('previewHero', 'hero');
    setupSlotDropZone('previewBg', 'bg');
    setupSlotDropZone('previewGroom', 'groom');
    setupSlotDropZone('previewBride', 'bride');
});

function setupSlotDropZone(previewId, role) {
    const img = document.getElementById(previewId);
    if (!img) return;
    const box = img.parentElement;
    if (!box) return;

    ['dragenter', 'dragover'].forEach(evt => {
        box.addEventListener(evt, (e) => {
            e.preventDefault();
            e.stopPropagation();
            box.classList.add('border-primary', 'border', 'border-3');
        });
    });

    ['dragleave', 'dragend'].forEach(evt => {
        box.addEventListener(evt, (e) => {
            e.preventDefault();
            e.stopPropagation();
            box.classList.remove('border-primary', 'border', 'border-3');
        });
    });

    box.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        box.classList.remove('border-primary', 'border', 'border-3');
        const dt = e.dataTransfer;
        if (dt && dt.files && dt.files.length > 0) {
            handleDeviceUploadDirect(dt.files[0], role);
        }
    });
}

function handleDeviceUploadDirect(file, role) {
    if (!file) return;
    const objectUrl = URL.createObjectURL(file);
    updatePreviewImage(role, objectUrl);

    const loaderId = 'loading' + role.charAt(0).toUpperCase() + role.slice(1);
    const loader = document.getElementById(loaderId);
    if (loader) {
        loader.classList.remove('d-none');
        loader.classList.add('d-flex');
    }

    const formData = new FormData();
    formData.append('photo', file);
    formData.append('role', role);

    fetch('<?= base_url('dashboard/upload-photo') ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (loader) {
            loader.classList.remove('d-flex');
            loader.classList.add('d-none');
        }
        if (data.success) {
            setDesignatedPhoto(role, data.path || data.url);
            showToastMessage('Foto slot ' + role + ' berhasil diunggah!');
        } else {
            alert(data.message || 'Gagal mengunggah foto.');
        }
    })
    .catch(err => {
        if (loader) {
            loader.classList.remove('d-flex');
            loader.classList.add('d-none');
        }
        console.error(err);
    });
}

// ==========================================
// PRESET AGAMA & BUDAYA + DYNAMIC SCHEDULE
// ==========================================

const RELIGION_PRESETS = <?= json_encode(get_wedding_presets(), JSON_UNESCAPED_UNICODE) ?>;

function applyReligionPreset(presetKey) {
    const preset = RELIGION_PRESETS[presetKey];
    if (!preset) return;

    const container = document.getElementById('scheduleSessionsContainer');
    const defaultDate = document.querySelector('input[name="event_date"]')?.value || '<?= $event['event_date'] ?? date('Y-m-d') ?>';

    container.innerHTML = '';
    preset.sessions.forEach((s, i) => {
        container.appendChild(createSessionElement(i + 1, s.name, defaultDate, s.time, s.place, s.address, ''));
    });

    const select = document.getElementById('selectEventPreset');
    if (select) select.value = presetKey;

    syncScheduleToHiddenFields();
    showToastMessage(`Preset acara "${preset.name}" berhasil diterapkan!`);
}

function setPresetQuick(key) {
    applyReligionPreset(key);
}

function applyPresetQuote() {
    const select = document.getElementById('selectEventPreset');
    const key = select ? select.value : 'islam';
    const preset = RELIGION_PRESETS[key];
    if (preset && preset.quote) {
        const quoteTextarea = document.querySelector('textarea[name="quote"]');
        if (quoteTextarea) {
            quoteTextarea.value = preset.quote;
            quoteTextarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
            showToastMessage(`Ayat / Kata Mutiara tradisi ${preset.name} berhasil diisi!`);
        }
    } else {
        alert('Preset ini tidak memiliki template ayat suci bawaan.');
    }
}

function createSessionElement(sessionNum, name, date, time, place, address, mapsUrl) {
    const div = document.createElement('div');
    div.className = 'card border rounded-3 p-3 schedule-session-card bg-light position-relative shadow-sm';
    div.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge bg-primary text-white rounded-pill px-3 py-1 session-badge">Sesi ${sessionNum}: ${name}</span>
            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle py-0 px-1.5 remove-session-btn" onclick="removeScheduleSession(this)" title="Hapus Sesi Acara Ini">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        <div class="row g-2">
            <div class="col-md-5">
                <label class="form-label small fw-bold mb-1">Nama Sesi Acara</label>
                <input type="text" name="schedule_name[]" class="form-control form-control-sm rounded-3 fw-semibold session-name-input" value="${name}" placeholder="Contoh: Pemberkatan / Akad Nikah" oninput="updateSessionBadge(this)">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold mb-1">Tanggal Acara</label>
                <input type="date" name="schedule_date[]" class="form-control form-control-sm rounded-3" value="${date}">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold mb-1">Waktu / Jam</label>
                <input type="text" name="schedule_time[]" class="form-control form-control-sm rounded-3 session-time-input" value="${time}" placeholder="Contoh: 08.00 - 10.00 WIB">
            </div>
            <div class="col-md-5">
                <label class="form-label small fw-bold mb-1">Nama Tempat / Gedung</label>
                <input type="text" name="schedule_place[]" class="form-control form-control-sm rounded-3 session-place-input" value="${place}" placeholder="Contoh: Gereja / Masjid / Ballroom Hotel">
            </div>
            <div class="col-md-7">
                <label class="form-label small fw-bold mb-1">Alamat Lengkap</label>
                <input type="text" name="schedule_address[]" class="form-control form-control-sm rounded-3 session-address-input" value="${address}" placeholder="Alamat jalan, kelurahan, kota...">
            </div>
            <div class="col-md-12">
                <label class="form-label small fw-bold mb-1 text-muted"><i class="bi bi-geo-alt me-1"></i> Link Google Maps Khusus Sesi Ini (Opsional jika beda tempat)</label>
                <div class="input-group input-group-sm">
                    <input type="text" name="schedule_maps_url[]" class="form-control rounded-start-3" value="${mapsUrl}" placeholder="https://maps.google.com/...">
                    <button type="button" class="btn btn-outline-secondary" onclick="usePlaceForSessionMap(this)">
                        <i class="bi bi-search"></i> Cari dari Tempat
                    </button>
                </div>
            </div>
        </div>
    `;
    return div;
}

function addScheduleSession() {
    const container = document.getElementById('scheduleSessionsContainer');
    const count = container.querySelectorAll('.schedule-session-card').length + 1;
    const defaultDate = document.querySelector('input[name="event_date"]')?.value || '<?= $event['event_date'] ?? date('Y-m-d') ?>';
    const newEl = createSessionElement(count, 'Sesi Acara ' + count, defaultDate, '08.00 - Selesai', '', '', '');
    container.appendChild(newEl);
    reindexSessionBadges();
    newEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    showToastMessage('Sesi acara baru berhasil ditambahkan!');
}

function removeScheduleSession(btn) {
    const card = btn.closest('.schedule-session-card');
    const container = document.getElementById('scheduleSessionsContainer');
    if (container.querySelectorAll('.schedule-session-card').length <= 1) {
        alert('Minimal harus terdapat 1 sesi acara pernikahan.');
        return;
    }
    if (card) {
        card.remove();
        reindexSessionBadges();
        syncScheduleToHiddenFields();
        showToastMessage('Sesi acara dihapus.');
    }
}

function updateSessionBadge(input) {
    const card = input.closest('.schedule-session-card');
    const badge = card.querySelector('.session-badge');
    const idx = Array.from(document.querySelectorAll('.schedule-session-card')).indexOf(card) + 1;
    if (badge) {
        badge.innerText = `Sesi ${idx}: ${input.value.trim() || ('Sesi ' + idx)}`;
    }
    syncScheduleToHiddenFields();
}

function reindexSessionBadges() {
    const cards = document.querySelectorAll('.schedule-session-card');
    cards.forEach((card, idx) => {
        const badge = card.querySelector('.session-badge');
        const nameInput = card.querySelector('.session-name-input');
        const name = nameInput ? nameInput.value.trim() : '';
        if (badge) {
            badge.innerText = `Sesi ${idx + 1}: ${name || ('Sesi ' + (idx + 1))}`;
        }
    });
}

function usePlaceForSessionMap(btn) {
    const card = btn.closest('.schedule-session-card');
    const place = card.querySelector('.session-place-input')?.value?.trim();
    const address = card.querySelector('.session-address-input')?.value?.trim();
    const query = place || address;
    if (!query) {
        alert('Silakan isi Nama Tempat / Gedung atau Alamat terlebih dahulu!');
        return;
    }
    const mapsInput = card.querySelector('input[name="schedule_maps_url[]"]');
    if (mapsInput) {
        mapsInput.value = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(query)}`;
        showToastMessage(`Link Maps disetel dari "${query}"`);
    }
}

function syncScheduleToHiddenFields() {
    const cards = document.querySelectorAll('.schedule-session-card');
    if (cards.length > 0) {
        const s1Time = cards[0].querySelector('.session-time-input')?.value || '';
        const s1Place = cards[0].querySelector('.session-place-input')?.value || '';
        const s1Addr = cards[0].querySelector('.session-address-input')?.value || '';
        const hAkadTime = document.getElementById('hiddenAkadTime');
        const hAkadLoc = document.getElementById('hiddenAkadLocation');
        if (hAkadTime) hAkadTime.value = s1Time;
        if (hAkadLoc) hAkadLoc.value = s1Place + (s1Addr ? "\n" + s1Addr : '');

        if (cards.length > 1) {
            const s2Time = cards[1].querySelector('.session-time-input')?.value || '';
            const s2Place = cards[1].querySelector('.session-place-input')?.value || '';
            const s2Addr = cards[1].querySelector('.session-address-input')?.value || '';
            const hResTime = document.getElementById('hiddenResepsiTime');
            const hResLoc = document.getElementById('hiddenResepsiLocation');
            if (hResTime) hResTime.value = s2Time;
            if (hResLoc) hResLoc.value = s2Place + (s2Addr ? "\n" + s2Addr : '');
        }
    }
}

// Form submit event to ensure sync
// ==========================================
// BACKGROUND MUSIC MANAGEMENT
// ==========================================
let musicPickerModalInstance = null;
let currentAuditionAudio = null;
let currentAuditionBtn = null;

function openMusicPickerModal() {
    if (!musicPickerModalInstance) {
        musicPickerModalInstance = new bootstrap.Modal(document.getElementById('musicPickerModal'));
    }
    musicPickerModalInstance.show();
}

function stopAllPlaylistAudios() {
    if (currentAuditionAudio) {
        currentAuditionAudio.pause();
        currentAuditionAudio.currentTime = 0;
        currentAuditionAudio = null;
    }
    if (currentAuditionBtn) {
        currentAuditionBtn.innerHTML = '<i class="bi bi-play-fill fs-5"></i>';
        currentAuditionBtn.classList.remove('btn-primary', 'text-white');
        currentAuditionBtn.classList.add('btn-outline-primary');
        currentAuditionBtn = null;
    }
}

function toggleAuditionPlay(btn, url) {
    if (currentAuditionAudio && currentAuditionBtn === btn) {
        if (currentAuditionAudio.paused) {
            currentAuditionAudio.play();
            btn.innerHTML = '<i class="bi bi-pause-fill fs-5"></i>';
            btn.classList.add('btn-primary', 'text-white');
            btn.classList.remove('btn-outline-primary');
        } else {
            currentAuditionAudio.pause();
            btn.innerHTML = '<i class="bi bi-play-fill fs-5"></i>';
            btn.classList.remove('btn-primary', 'text-white');
            btn.classList.add('btn-outline-primary');
        }
        return;
    }

    stopAllPlaylistAudios();

    currentAuditionBtn = btn;
    currentAuditionAudio = new Audio(url);
    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span>';

    currentAuditionAudio.addEventListener('canplay', () => {
        btn.innerHTML = '<i class="bi bi-pause-fill fs-5"></i>';
        btn.classList.add('btn-primary', 'text-white');
        btn.classList.remove('btn-outline-primary');
        currentAuditionAudio.play();
    });

    currentAuditionAudio.addEventListener('ended', () => {
        stopAllPlaylistAudios();
    });

    currentAuditionAudio.addEventListener('error', () => {
        alert('Gagal memuat pratinjau audio.');
        stopAllPlaylistAudios();
    });
}

function selectCuratedMusic(url, title) {
    stopAllPlaylistAudios();
    const input = document.getElementById('inputMusicUrl');
    if (input) {
        input.value = url;
    }
    updateMusicPreviewPlayer(url);
    if (musicPickerModalInstance) {
        musicPickerModalInstance.hide();
    }
    showToastMessage(`Lagu "${title}" berhasil dipilih!`);
}

function updateMusicPreviewPlayer(url) {
    const player = document.getElementById('musicPreviewPlayer');
    if (player) {
        player.src = url || '';
        if (url) {
            player.load();
        }
    }
}

function clearMusicSelection() {
    const input = document.getElementById('inputMusicUrl');
    if (input) input.value = '';
    const player = document.getElementById('musicPreviewPlayer');
    if (player) {
        player.pause();
        player.src = '';
    }
    showToastMessage('Musik pengiring undangan telah dinonaktifkan.');
}

function handleMusicDeviceUpload(fileInput) {
    if (!fileInput.files || !fileInput.files[0]) return;
    const file = fileInput.files[0];

    const loader = document.getElementById('musicUploadLoading');
    if (loader) loader.classList.remove('d-none');

    const formData = new FormData();
    formData.append('music', file);

    fetch('<?= base_url('dashboard/upload-music') ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (loader) loader.classList.add('d-none');
        if (data.success) {
            const url = data.path || data.url;
            const input = document.getElementById('inputMusicUrl');
            if (input) input.value = url;
            updateMusicPreviewPlayer(data.url || url);
            showToastMessage(`File musik "${data.filename || file.name}" berhasil diunggah!`);
        } else {
            alert(data.message || 'Gagal mengunggah file musik.');
        }
    })
    .catch(err => {
        if (loader) loader.classList.add('d-none');
        console.error(err);
        alert('Terjadi kesalahan saat mengunggah file musik.');
    });

    fileInput.value = '';
}

// ==========================================
// LOVE STORY / OUR JOURNEY MANAGEMENT
// ==========================================
function addLoveStoryItem(title = '', year = '', desc = '', img = '') {
    const container = document.getElementById('loveStoryContainer');
    const emptyNotice = document.getElementById('emptyLoveStoryNotice');
    if (emptyNotice) emptyNotice.remove();

    const count = container.querySelectorAll('.love-story-item').length + 1;
    const card = document.createElement('div');
    card.className = 'card border rounded-3 p-3 love-story-item bg-light position-relative shadow-sm';
    
    const previewSrc = img ? (img.startsWith('http') ? img : '<?= base_url('') ?>/' + img.replace(/^\//, '')) : 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=400';

    card.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge bg-danger text-white rounded-pill px-3 py-1 story-badge">
                Babak ${count}: ${escapeHtml(title || 'Momen Bahagia')}
            </span>
            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle py-0 px-1.5" onclick="removeLoveStoryItem(this)" title="Hapus Babak Ini">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        <div class="row g-3">
            <div class="col-md-3 text-center">
                <div class="position-relative overflow-hidden rounded-3 border bg-white mx-auto mb-2" style="width: 100%; max-width: 150px; height: 110px;">
                    <img src="${escapeHtml(previewSrc)}" class="w-100 h-100 object-fit-cover story-img-preview" alt="Foto Momen">
                </div>
                <input type="hidden" name="story_image[]" class="story-img-input" value="${escapeHtml(img)}">
                <input type="file" accept="image/*" class="d-none story-file-input" onchange="handleStoryPhotoUpload(this)">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill py-0 px-2 small w-100 mb-1" style="font-size: 11px;" onclick="this.previousElementSibling.click()">
                    <i class="bi bi-camera me-1"></i> Upload Foto
                </button>
            </div>
            <div class="col-md-9">
                <div class="row g-2">
                    <div class="col-md-8">
                        <label class="form-label small fw-bold mb-1">Judul Momen / Babak Kisah</label>
                        <input type="text" name="story_title[]" class="form-control form-control-sm rounded-3 fw-semibold story-title-input" value="${escapeHtml(title)}" placeholder="Contoh: Pertemuan Pertama / Menjalin Komitmen" oninput="updateStoryBadge(this)" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold mb-1">Tahun / Waktu</label>
                        <input type="text" name="story_year[]" class="form-control form-control-sm rounded-3 story-year-input" value="${escapeHtml(year)}" placeholder="Contoh: 2020 / Mei 2021">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label small fw-bold mb-1">Deskripsi / Cerita Singkat</label>
                        <textarea name="story_desc[]" class="form-control form-control-sm rounded-3 story-desc-input" rows="2" placeholder="Ceritakan bagaimana momen bahagia ini terjadi...">${escapeHtml(desc)}</textarea>
                    </div>
                </div>
            </div>
        </div>
    `;
    container.appendChild(card);
    renumberLoveStories();
}

function removeLoveStoryItem(btn) {
    const card = btn.closest('.love-story-item');
    if (confirm('Hapus babak perjalanan cinta ini?')) {
        card.remove();
        renumberLoveStories();
    }
}

function updateStoryBadge(input) {
    const card = input.closest('.love-story-item');
    const badge = card.querySelector('.story-badge');
    const cards = Array.from(document.getElementById('loveStoryContainer').querySelectorAll('.love-story-item'));
    const idx = cards.indexOf(card) + 1;
    badge.innerText = `Babak ${idx}: ${input.value || 'Momen Bahagia'}`;
}

function renumberLoveStories() {
    const items = document.querySelectorAll('#loveStoryContainer .love-story-item');
    items.forEach((item, idx) => {
        const badge = item.querySelector('.story-badge');
        const input = item.querySelector('.story-title-input');
        badge.innerText = `Babak ${idx + 1}: ${input ? (input.value || 'Momen Bahagia') : 'Momen Bahagia'}`;
    });
}

function handleStoryPhotoUpload(fileInput) {
    if (!fileInput.files || !fileInput.files[0]) return;
    const file = fileInput.files[0];
    const card = fileInput.closest('.love-story-item');
    const previewImg = card.querySelector('.story-img-preview');
    const hiddenInput = card.querySelector('.story-img-input');

    if (previewImg) previewImg.src = URL.createObjectURL(file);

    const formData = new FormData();
    formData.append('photo', file);
    formData.append('role', 'story');

    fetch('<?= base_url('dashboard/upload-photo') ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            if (hiddenInput) hiddenInput.value = data.path || data.url;
            if (previewImg) previewImg.src = data.url || (data.path ? '<?= base_url('') ?>/' + data.path : previewImg.src);
            showToastMessage('Foto momen berhasil diunggah!');
        } else {
            alert(data.message || 'Gagal mengunggah foto.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Terjadi kendala saat mengunggah foto.');
    });
}

function applyExampleLoveStories() {
    if (confirm('Gunakan 3 contoh babak cerita cinta romantis?')) {
        addLoveStoryItem(
            'Pertemuan Pertama',
            '2020',
            'Kami pertama kali dipertemukan saat sama-sama menempuh pendidikan di universitas.',
            'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=600'
        );
        addLoveStoryItem(
            'Menjalin Komitmen',
            '2022',
            'Dua tahun saling mengenal, kami memutuskan untuk melangkah bersama dengan niat baik.',
            'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=600'
        );
        addLoveStoryItem(
            'Menuju Pelaminan',
            '2024',
            'Dengan restu kedua keluarga, kami mantap mengikat janji suci seumur hidup.',
            'https://images.unsplash.com/photo-1519741497674-611481863552?w=600'
        );
        showToastMessage('3 contoh kisah cinta romantis berhasil ditambahkan!');
    }
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
