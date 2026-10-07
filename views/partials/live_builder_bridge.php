<?php
// views/partials/live_builder_bridge.php
// Bridge sinkronisasi live visual builder dengan template undangan

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__, 2));
}

$isBuilderMode = isset($_GET['builder']) && $_GET['builder'] == '1';
$customElementStyles = $themeConfig['element_styles'] ?? [];
?>

<!-- Universal Custom Element Styles -->
<style id="pendar-custom-element-styles">
<?php if (!empty($customElementStyles) && is_array($customElementStyles)): ?>
    <?php foreach ($customElementStyles as $secKey => $st): ?>
        [data-builder="<?= htmlspecialchars($secKey) ?>"] {
            <?= isset($st['margin_top']) && $st['margin_top'] !== '' ? 'margin-top: ' . (int)$st['margin_top'] . 'px !important;' : '' ?>
            <?= isset($st['margin_bottom']) && $st['margin_bottom'] !== '' ? 'margin-bottom: ' . (int)$st['margin_bottom'] . 'px !important;' : '' ?>
            <?= isset($st['margin_left']) && $st['margin_left'] !== '' ? 'margin-left: ' . (int)$st['margin_left'] . 'px !important;' : '' ?>
            <?= isset($st['margin_right']) && $st['margin_right'] !== '' ? 'margin-right: ' . (int)$st['margin_right'] . 'px !important;' : '' ?>
            <?= isset($st['padding_top']) && $st['padding_top'] !== '' ? 'padding-top: ' . (int)$st['padding_top'] . 'px !important;' : '' ?>
            <?= isset($st['padding_bottom']) && $st['padding_bottom'] !== '' ? 'padding-bottom: ' . (int)$st['padding_bottom'] . 'px !important;' : '' ?>
            <?= isset($st['padding_left']) && $st['padding_left'] !== '' ? 'padding-left: ' . (int)$st['padding_left'] . 'px !important;' : '' ?>
            <?= isset($st['padding_right']) && $st['padding_right'] !== '' ? 'padding-right: ' . (int)$st['padding_right'] . 'px !important;' : '' ?>
            <?= !empty($st['color']) ? 'color: ' . htmlspecialchars($st['color']) . ' !important;' : '' ?>
            <?= !empty($st['background_color']) ? 'background-color: ' . htmlspecialchars($st['background_color']) . ' !important;' : '' ?>
            <?= !empty($st['font_size']) ? 'font-size: ' . htmlspecialchars($st['font_size']) . ' !important;' : '' ?>
            <?= !empty($st['text_align']) ? 'text-align: ' . htmlspecialchars($st['text_align']) . ' !important;' : '' ?>
        }
    <?php endforeach; ?>
<?php endif; ?>

<?php if ($isBuilderMode): ?>
    /* Live Builder Interactive Outlines */
    .builder-editable {
        outline: 2px dashed #ffb700 !important;
        outline-offset: 3px !important;
        cursor: pointer !important;
        position: relative !important;
        transition: outline 0.2s ease, background-color 0.2s ease !important;
        border-radius: 8px !important;
    }

    .builder-editable:hover {
        outline: 2.5px dashed #f59e0b !important;
        background-color: rgba(255, 183, 0, 0.09) !important;
    }

    .builder-editable::before {
        content: '✎ ' attr(data-builder-label);
        position: absolute;
        top: 6px;
        right: 8px;
        z-index: 999999;
        background: #ffb700;
        color: #17242a;
        font-size: 11px;
        font-weight: 700;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        padding: 3px 10px;
        border-radius: 20px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.35);
        pointer-events: none;
        opacity: 0;
        transform: translateY(-4px);
        transition: opacity 0.2s ease, transform 0.2s ease;
        line-height: 1.2;
    }

    .builder-editable:hover::before {
        opacity: 1;
        transform: translateY(0);
    }
<?php endif; ?>
</style>

<?php if ($isBuilderMode): ?>
<script>
(function() {
    // Fungsi untuk menandai bagian undangan yang dapat diedit (auto-tagging)
    function initBuilderEditableElements() {
        const mappings = [
            {
                key: 'title',
                label: 'Nama Acara',
                selectors: ['.hero-title', '.cover-title', '.banner-title', '.wedding-title', 'h1.display-4', 'h1.display-3', '.cover-wedding-text', '[data-builder="title"]']
            },
            {
                key: 'cover',
                label: 'Foto Sampul & Background',
                selectors: ['#cover', '.cover-section', '.hero-section', '.bg-cover', '[data-builder="cover"]']
            },
            {
                key: 'couple',
                label: 'Mempelai Pria & Wanita',
                selectors: ['#couple', '#mempelai', '.couple-section', '.mempelai-card', '.groom-card', '.bride-card', '[data-builder="couple"]']
            },
            {
                key: 'quote',
                label: 'Kutipan / Doa',
                selectors: ['#quote', '#ayat', '.quote-section', '.ayat-section', 'blockquote', '[data-builder="quote"]']
            },
            {
                key: 'schedule',
                label: 'Waktu & Lokasi Acara',
                selectors: ['#acara', '#event', '#events', '#schedule', '.event-section', '.acara-card', '.schedule-card', '[data-builder="schedule"]']
            },
            {
                key: 'story',
                label: 'Kisah Cinta (Love Story)',
                selectors: ['#story', '#love-story', '.story-section', '.love-story-card', '[data-builder="story"]']
            },
            {
                key: 'gallery',
                label: 'Galeri Foto',
                selectors: ['#gallery', '#galeri', '.gallery-section', '.photo-grid', '[data-builder="gallery"]']
            },
            {
                key: 'gift',
                label: 'Amplop Digital & Rekening',
                selectors: ['#gift', '#rekening', '#amplop', '.gift-section', '.bank-card', '[data-builder="gift"]']
            },
            {
                key: 'music',
                label: 'Musik Latar',
                selectors: ['#music-toggle', '#audio-btn', '.music-controller', '.floating-music-btn', '[data-builder="music"]']
            }
        ];

        mappings.forEach(item => {
            for (let sel of item.selectors) {
                const els = document.querySelectorAll(sel);
                if (els.length > 0) {
                    els.forEach(el => {
                        if (!el.classList.contains('builder-editable')) {
                            el.classList.add('builder-editable');
                            el.setAttribute('data-builder', item.key);
                            el.setAttribute('data-builder-label', item.label);

                            el.addEventListener('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                if (window.parent && window.parent !== window) {
                                    window.parent.postMessage({
                                        type: 'BUILDER_OPEN_MODAL',
                                        section: item.key,
                                        label: item.label
                                    }, '*');
                                }
                            });
                        }
                    });
                    break; // Ambil selector terbaik pertama yang cocok
                }
            }
        });

        // Tangkap klik global untuk fallback jika elemen spesifik belum teridentifikasi
        document.body.addEventListener('click', function(e) {
            const editable = e.target.closest('.builder-editable');
            if (editable) {
                e.preventDefault();
                e.stopPropagation();
                const sec = editable.getAttribute('data-builder');
                const lbl = editable.getAttribute('data-builder-label');
                if (window.parent && window.parent !== window) {
                    window.parent.postMessage({
                        type: 'BUILDER_OPEN_MODAL',
                        section: sec,
                        label: lbl
                    }, '*');
                }
            }
        }, true);
    }

    // Tangkap pesan update dari parent builder (instant live preview)
    window.addEventListener('message', function(e) {
        if (!e.data || e.data.type !== 'BUILDER_UPDATE_ELEMENT') return;
        const { section, data, styles } = e.data;

        const targets = document.querySelectorAll(`[data-builder="${section}"]`);
        targets.forEach(el => {
            // Terapkan style instan (Margin, Padding, Advance Settings)
            if (styles) {
                if (styles.margin_top !== undefined && styles.margin_top !== '') el.style.marginTop = styles.margin_top + 'px';
                if (styles.margin_bottom !== undefined && styles.margin_bottom !== '') el.style.marginBottom = styles.margin_bottom + 'px';
                if (styles.margin_left !== undefined && styles.margin_left !== '') el.style.marginLeft = styles.margin_left + 'px';
                if (styles.margin_right !== undefined && styles.margin_right !== '') el.style.marginRight = styles.margin_right + 'px';

                if (styles.padding_top !== undefined && styles.padding_top !== '') el.style.paddingTop = styles.padding_top + 'px';
                if (styles.padding_bottom !== undefined && styles.padding_bottom !== '') el.style.paddingBottom = styles.padding_bottom + 'px';
                if (styles.padding_left !== undefined && styles.padding_left !== '') el.style.paddingLeft = styles.padding_left + 'px';
                if (styles.padding_right !== undefined && styles.padding_right !== '') el.style.paddingRight = styles.padding_right + 'px';

                if (styles.color) el.style.color = styles.color;
                if (styles.background_color) el.style.backgroundColor = styles.background_color;
                if (styles.font_size) el.style.fontSize = styles.font_size;
                if (styles.text_align) el.style.textAlign = styles.text_align;
            }

            // Terapkan data instan ke elemen teks & gambar
            if (data) {
                if (section === 'title' && data.title) {
                    const textNode = el.querySelector('h1, h2, h3, .wedding-title, .title-text') || el;
                    if (textNode) textNode.textContent = data.title;
                }
                if (section === 'quote' && data.quote) {
                    const textNode = el.querySelector('p, blockquote, .quote-text') || el;
                    if (textNode) textNode.textContent = data.quote;
                }
                if (section === 'couple') {
                    if (data.groom_nickname) {
                        const gNick = el.querySelector('.groom-nickname, .groom-nick');
                        if (gNick) gNick.textContent = data.groom_nickname;
                    }
                    if (data.groom_name) {
                        const gName = el.querySelector('.groom-fullname, .groom-name');
                        if (gName) gName.textContent = data.groom_name;
                    }
                    if (data.bride_nickname) {
                        const bNick = el.querySelector('.bride-nickname, .bride-nick');
                        if (bNick) bNick.textContent = data.bride_nickname;
                    }
                    if (data.bride_name) {
                        const bName = el.querySelector('.bride-fullname, .bride-name');
                        if (bName) bName.textContent = data.bride_name;
                    }
                    if (data.groom_photo) {
                        const gImg = el.querySelector('.groom-img, .groom-photo');
                        if (gImg) gImg.src = data.groom_photo;
                    }
                    if (data.bride_photo) {
                        const bImg = el.querySelector('.bride-img, .bride-photo');
                        if (bImg) bImg.src = data.bride_photo;
                    }
                }
                if (section === 'cover' && data.cover_photo) {
                    const coverImg = el.querySelector('img.cover-img, img.hero-img');
                    if (coverImg) {
                        coverImg.src = data.cover_photo;
                    } else {
                        el.style.backgroundImage = `url('${data.cover_photo}')`;
                    }
                }
            }
        });
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBuilderEditableElements);
    } else {
        initBuilderEditableElements();
    }
})();
</script>
<?php endif; ?>
