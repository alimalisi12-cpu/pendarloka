<?php
/*
Plugin Name: WhatsApp RSVP Assistant
Plugin URI: https://pendar-loka.com/plugins/wa-rsvp-auto
Description: Memudahkan pengantin dan tamu untuk konfirmasi kehadiran langsung via WhatsApp dengan pesan personal otomatis, tautan navigasi, dan ucapan selamat.
Version: 1.0.0
Author: Pendar Loka Team
Author URI: https://pendar-loka.com
Icon: bi-whatsapp
*/

// Hook into invitation footer to add an optional quick floating WhatsApp assistance button or action
add_action('invitation_footer', function($event = null) {
    if (!$event) return;
    $eventTitle = htmlspecialchars($event['title'] ?? 'Acara Pernikahan', ENT_QUOTES, 'UTF-8');
    ?>
    <!-- Plugin: WhatsApp RSVP Assistant Floating Helper -->
    <div id="wa-rsvp-helper" style="display:none;" data-plugin="wa-rsvp-auto" data-event-title="<?= $eventTitle ?>"></div>
    <script>
    (function() {
        console.log('[WhatsApp RSVP Assistant] Active for event: <?= $eventTitle ?>');
    })();
    </script>
    <!-- End Plugin: WhatsApp RSVP Assistant -->
    <?php
});

// Custom filter for WhatsApp share message formatting
add_filter('wa_rsvp_format_message', function($text, $guestName = '', $eventTitle = '') {
    $formatted = "Halo " . ($guestName ?: 'Tamu Undangan') . "!\n";
    $formatted .= "Terima kasih telah mengonfirmasi kehadiran Anda pada *" . ($eventTitle ?: 'Acara Kami') . "*.\n\n";
    $formatted .= "Sampai jumpa di hari bahagia kami!";
    return $formatted;
});
