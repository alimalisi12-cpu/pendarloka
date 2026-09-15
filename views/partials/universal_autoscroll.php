<?php
// views/partials/universal_autoscroll.php
// Universal Smart Auto-Scroll & Floating Controls Engine
// Berjalan mulus di semua template undangan (Desktop & Mobile)

if (defined('UNIVERSAL_AUTOSCROLL_LOADED')) {
    return;
}
define('UNIVERSAL_AUTOSCROLL_LOADED', true);
?>

<!-- Universal Smart Auto-Scroll & Floating Dock Styles -->
<style>
/* Floating Dock Container */
.smart-dock-container {
    position: fixed;
    bottom: 24px;
    right: 20px;
    z-index: 99990;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
    pointer-events: none;
    transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    opacity: 0;
    transform: translateY(20px);
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
}

.smart-dock-container.is-visible {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

/* Floating Controls Group */
.smart-controls-group {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(18, 20, 26, 0.88);
    border: 1px solid rgba(212, 175, 55, 0.35);
    border-radius: 50px;
    padding: 5px 8px 5px 14px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.55), 0 0 12px rgba(212, 175, 55, 0.15);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    user-select: none;
}

/* Auto Scroll Main Button */
.smart-scroll-btn {
    background: transparent;
    border: none;
    color: #F7F5F0;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    cursor: pointer;
    padding: 5px 8px;
    border-radius: 30px;
    transition: all 0.25s ease;
    outline: none;
}

.smart-scroll-btn:hover {
    color: #D4AF37;
}

.smart-scroll-btn.active {
    color: #F4E8C1;
}

.smart-scroll-btn.active .smart-icon-pulse {
    animation: smartGlowPulse 1.8s infinite ease-in-out;
}

@keyframes smartGlowPulse {
    0%, 100% { transform: scale(1); filter: drop-shadow(0 0 2px rgba(212, 175, 55, 0.4)); }
    50% { transform: scale(1.18); filter: drop-shadow(0 0 8px rgba(212, 175, 55, 0.9)); }
}

/* Speed Toggle Badge */
.smart-speed-badge {
    background: rgba(212, 175, 55, 0.18);
    border: 1px solid rgba(212, 175, 55, 0.45);
    color: #F4E8C1;
    border-radius: 12px;
    padding: 3px 8px;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    line-height: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.smart-speed-badge:hover {
    background: #D4AF37;
    color: #0c0d0f;
    transform: scale(1.08);
}

/* Divider inside Dock */
.smart-dock-divider {
    width: 1px;
    height: 20px;
    background: rgba(212, 175, 55, 0.25);
}

/* Music Floating Button */
.smart-music-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(212, 175, 55, 0.15);
    border: 1px solid rgba(212, 175, 55, 0.5);
    color: #D4AF37;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 16px;
    outline: none;
    padding: 0;
}

.smart-music-btn:hover {
    background: #D4AF37;
    color: #0c0d0f;
    transform: scale(1.1);
}

.smart-music-btn.playing i {
    animation: smartSpinDisc 4.5s linear infinite;
}

@keyframes smartSpinDisc {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Subtle Feedback Toast */
.smart-scroll-toast {
    position: fixed;
    top: 24px;
    left: 50%;
    transform: translateX(-50%) translateY(-25px);
    background: rgba(14, 16, 22, 0.94);
    border: 1px solid rgba(212, 175, 55, 0.55);
    color: #F7F5F0;
    padding: 9px 22px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 500;
    box-shadow: 0 10px 32px rgba(0, 0, 0, 0.7), 0 0 15px rgba(212, 175, 55, 0.2);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    z-index: 100000;
    opacity: 0;
    pointer-events: none;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    align-items: center;
    gap: 9px;
    white-space: nowrap;
}

.smart-scroll-toast.show {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
}

@media (max-width: 576.98px) {
    .smart-dock-container {
        bottom: 18px;
        right: 14px;
        gap: 10px;
    }
    .smart-controls-group {
        padding: 4px 6px 4px 12px;
    }
    .smart-scroll-btn {
        font-size: 12px;
    }
}
</style>

<!-- Floating Controls Dock -->
<div class="smart-dock-container" id="smartDockContainer">
    <div class="smart-controls-group">
        <!-- Tombol Auto-Scroll -->
        <button type="button" class="smart-scroll-btn" id="smartScrollBtn" onclick="smartToggleAutoScroll()" title="Scroll Layar Otomatis">
            <i class="bi bi-chevron-double-down fs-6 smart-icon-pulse text-warning" id="smartScrollIcon"></i>
            <span id="smartScrollText">Auto Scroll</span>
        </button>

        <!-- Badge Kecepatan (1x, 1.5x, 2x) -->
        <button type="button" class="smart-speed-badge" id="smartSpeedBadge" onclick="smartCycleSpeed(event)" title="Klik untuk ubah kecepatan">
            1x
        </button>

        <div class="smart-dock-divider"></div>

        <!-- Tombol Musik Latar -->
        <button type="button" class="smart-music-btn" id="smartMusicBtn" onclick="smartToggleMusic()" title="Putar / Jeda Musik">
            <i class="bi bi-disc-fill" id="smartMusicIcon"></i>
        </button>
    </div>
</div>

<!-- Feedback Toast Notification -->
<div class="smart-scroll-toast" id="smartScrollToast">
    <i class="bi bi-info-circle-fill text-warning fs-6" id="smartToastIcon"></i>
    <span id="smartToastMessage">Auto Scroll Aktif</span>
</div>

<!-- Universal Smart Auto-Scroll JavaScript Engine -->
<script>
(function() {
    // 1. Variabel State
    let isAutoScrolling = false;
    let autoScrollRaf = null;
    let currentSpeedIndex = 0;
    const speeds = [1.25, 2.0, 3.2]; // 1x, 1.5x, 2x
    const speedLabels = ['1x', '1.5x', '2x'];
    let toastTimeout = null;
    let isMusicPlaying = false;

    // 2. Tampilkan Toast Notifikasi
    function showToast(message, iconClass = 'bi-info-circle-fill text-warning') {
        const toast = document.getElementById('smartScrollToast');
        const msgEl = document.getElementById('smartToastMessage');
        const iconEl = document.getElementById('smartToastIcon');
        if (!toast || !msgEl) return;

        msgEl.innerText = message;
        if (iconEl) iconEl.className = 'bi ' + iconClass + ' fs-6';

        toast.classList.add('show');
        if (toastTimeout) clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            toast.classList.remove('show');
        }, 2400);
    }

    // 3. Cari Elemen Audio Undangan
    function getAudioElement() {
        return document.getElementById('bgSong')
            || document.getElementById('bgMusic')
            || document.getElementById('invitationAudio')
            || document.querySelector('audio');
    }

    // 4. Update Tampilan Musik
    function updateMusicUI(playing) {
        isMusicPlaying = playing;
        const btn = document.getElementById('smartMusicBtn');
        const icon = document.getElementById('smartMusicIcon');
        if (!btn || !icon) return;

        if (playing) {
            btn.classList.add('playing');
            icon.className = 'bi bi-disc-fill text-warning';
        } else {
            btn.classList.remove('playing');
            icon.className = 'bi bi-pause-circle-fill text-muted';
        }

        // Sinkronisasi dengan tombol audio bawaan template jika ada
        const templateMusicIcon = document.getElementById('musicIcon') || document.getElementById('footerAudioIcon');
        if (templateMusicIcon) {
            templateMusicIcon.className = playing ? 'bi bi-disc-fill fs-5 disc-spin text-gold' : 'bi bi-pause-circle-fill fs-5 text-muted';
        }
    }

    window.smartToggleMusic = function() {
        const audio = getAudioElement();
        if (!audio) return;

        if (audio.paused) {
            audio.play().then(() => {
                updateMusicUI(true);
            }).catch(() => {
                updateMusicUI(false);
            });
        } else {
            audio.pause();
            updateMusicUI(false);
        }
    };

    // 5. Engine Auto-Scroll (Smooth 60fps via requestAnimationFrame)
    function autoScrollStep() {
        if (!isAutoScrolling) return;

        const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
        if (window.scrollY >= maxScroll - 6) {
            // Sudah mencapai akhir halaman
            stopAutoScroll(true);
            return;
        }

        window.scrollBy(0, speeds[currentSpeedIndex]);
        autoScrollRaf = requestAnimationFrame(autoScrollStep);
    }

    function startAutoScroll() {
        isAutoScrolling = true;
        const btn = document.getElementById('smartScrollBtn');
        const icon = document.getElementById('smartScrollIcon');
        const text = document.getElementById('smartScrollText');

        if (btn) btn.classList.add('active');
        if (icon) icon.className = 'bi bi-pause-circle-fill fs-6 smart-icon-pulse text-warning';
        if (text) text.innerText = 'Jeda';

        if (autoScrollRaf) cancelAnimationFrame(autoScrollRaf);
        autoScrollRaf = requestAnimationFrame(autoScrollStep);

        showToast("Auto Scroll Berjalan • Sentuh layar untuk menjeda", "bi-play-circle-fill text-warning");
    }

    function stopAutoScroll(reachedBottom = false) {
        isAutoScrolling = false;
        if (autoScrollRaf) {
            cancelAnimationFrame(autoScrollRaf);
            autoScrollRaf = null;
        }

        const btn = document.getElementById('smartScrollBtn');
        const icon = document.getElementById('smartScrollIcon');
        const text = document.getElementById('smartScrollText');

        if (btn) btn.classList.remove('active');

        if (reachedBottom) {
            if (icon) icon.className = 'bi bi-arrow-up-circle-fill fs-6 text-info';
            if (text) text.innerText = 'Ke Atas';
            showToast("Halaman Selesai • Ketuk 'Ke Atas' untuk kembali", "bi-check-circle-fill text-success");
        } else {
            if (icon) icon.className = 'bi bi-play-circle-fill fs-6 text-warning';
            if (text) text.innerText = 'Lanjut';
        }
    }

    window.smartToggleAutoScroll = function() {
        const text = document.getElementById('smartScrollText');
        if (text && text.innerText === 'Ke Atas') {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            setTimeout(() => {
                text.innerText = 'Auto Scroll';
                const icon = document.getElementById('smartScrollIcon');
                if (icon) icon.className = 'bi bi-chevron-double-down fs-6 text-warning';
            }, 800);
            return;
        }

        if (isAutoScrolling) {
            stopAutoScroll(false);
            showToast("Auto Scroll Dijeda", "bi-pause-circle-fill text-warning");
        } else {
            startAutoScroll();
        }
    };

    // 6. Ganti Kecepatan Scroll (1x -> 1.5x -> 2x)
    window.smartCycleSpeed = function(e) {
        if (e) e.stopPropagation();
        currentSpeedIndex = (currentSpeedIndex + 1) % speeds.length;
        const badge = document.getElementById('smartSpeedBadge');
        if (badge) {
            badge.innerText = speedLabels[currentSpeedIndex];
        }
        showToast("Kecepatan Scroll: " + speedLabels[currentSpeedIndex], "bi-speedometer2 text-warning");
    };

    // 7. Auto-Pause Cerdas saat Pengguna Menyentuh Layar / Menggulir Manual
    // (Mencegah layar bergetar atau bertarung melawan sentuhan jari user!)
    function handleUserScrollInteraction() {
        if (isAutoScrolling) {
            stopAutoScroll(false);
            showToast("Auto Scroll Dijeda", "bi-pause-circle-fill text-warning");
        }
    }

    window.addEventListener('touchstart', handleUserScrollInteraction, { passive: true });
    window.addEventListener('wheel', handleUserScrollInteraction, { passive: true });
    window.addEventListener('touchmove', handleUserScrollInteraction, { passive: true });

    // 8. Integrasi Visibilitas dengan Layar Cover Pembuka
    function checkCoverStatus() {
        const dock = document.getElementById('smartDockContainer');
        if (!dock) return;

        const coverModal = document.getElementById('luxuryCoverModal');
        const coverScreen = document.getElementById('coverScreen');

        const isCoverOpen = (!coverModal || coverModal.classList.contains('opened') || coverModal.style.display === 'none' || coverModal.style.opacity === '0' || window.getComputedStyle(coverModal).display === 'none' || window.getComputedStyle(coverModal).opacity === '0')
            && (!coverScreen || coverScreen.classList.contains('opened') || coverScreen.style.display === 'none' || window.getComputedStyle(coverScreen).display === 'none');

        if (isCoverOpen) {
            dock.classList.add('is-visible');
            const audio = getAudioElement();
            if (audio && !audio.paused) {
                updateMusicUI(true);
            }
        } else {
            dock.classList.remove('is-visible');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        checkCoverStatus();
        // Polling status cover untuk mendeteksi saat tombol "Buka Undangan" diklik
        const coverInterval = setInterval(() => {
            checkCoverStatus();
            const dock = document.getElementById('smartDockContainer');
            if (dock && dock.classList.contains('is-visible')) {
                clearInterval(coverInterval);
            }
        }, 300);

        // Pantau audio play event
        const audio = getAudioElement();
        if (audio) {
            audio.addEventListener('play', () => updateMusicUI(true));
            audio.addEventListener('pause', () => updateMusicUI(false));
        }
    });

    // Ekspos ke global namespace untuk kompatibilitas fungsi template lama
    window.toggleAutoScroll = window.smartToggleAutoScroll;
})();
</script>
