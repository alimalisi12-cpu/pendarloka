<?php
// app/Models/Event.php

require_once dirname(__DIR__, 2) . '/config/database.php';

class Event {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findBySlug($slug) {
        $stmt = $this->db->prepare("
            SELECT e.*, ed.*, t.name as template_name, t.view_file, t.tier as template_tier, t.animation_config_json, c.name as category_name, u.phone as user_phone
            FROM events e
            LEFT JOIN event_details ed ON e.id = ed.event_id
            LEFT JOIN templates t ON e.template_id = t.id
            LEFT JOIN categories c ON e.category_id = c.id
            LEFT JOIN users u ON e.user_id = u.id
            WHERE e.slug = ?
        ");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("
            SELECT e.*, ed.*, t.name as template_name, t.view_file, t.animation_config_json, c.name as category_name, u.phone as user_phone
            FROM events e
            LEFT JOIN event_details ed ON e.id = ed.event_id
            LEFT JOIN templates t ON e.template_id = t.id
            LEFT JOIN categories c ON e.category_id = c.id
            LEFT JOIN users u ON e.user_id = u.id
            WHERE e.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT e.*, t.name as template_name, t.thumbnail as template_thumb,
                   (SELECT COUNT(*) FROM guests WHERE event_id = e.id) as total_guests,
                   (SELECT COUNT(*) FROM wishes WHERE event_id = e.id) as total_wishes
            FROM events e
            LEFT JOIN templates t ON e.template_id = t.id
            WHERE e.user_id = ?
            ORDER BY e.created_at DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getAllEvents() {
        $stmt = $this->db->query("
            SELECT e.*, u.name as user_name, u.email as user_email, t.name as template_name,
                   ed.groom_name, ed.bride_name, ed.event_type_preset, ed.events_schedule_json, ed.quote,
                   ed.akad_time, ed.akad_location, ed.resepsi_time, ed.resepsi_location, ed.maps_url,
                   (SELECT COUNT(*) FROM guests WHERE event_id = e.id) as total_guests,
                   (SELECT COUNT(*) FROM wishes WHERE event_id = e.id) as total_wishes
            FROM events e
            LEFT JOIN users u ON e.user_id = u.id
            LEFT JOIN templates t ON e.template_id = t.id
            LEFT JOIN event_details ed ON e.id = ed.event_id
            ORDER BY e.created_at DESC
        ");
        return $stmt->fetchAll();
    }

    public function updateTraditionPreset($eventId, $preset, $scheduleJson, $quote, $akadTime = '', $akadLocation = '', $resepsiTime = '', $resepsiLocation = '', $mapsUrl = null) {
        if ($mapsUrl !== null && trim($mapsUrl) !== '') {
            $stmt = $this->db->prepare("
                UPDATE event_details SET
                    event_type_preset = ?,
                    events_schedule_json = ?,
                    quote = ?,
                    akad_time = ?,
                    akad_location = ?,
                    resepsi_time = ?,
                    resepsi_location = ?,
                    maps_url = ?
                WHERE event_id = ?
            ");
            return $stmt->execute([$preset, $scheduleJson, $quote, $akadTime, $akadLocation, $resepsiTime, $resepsiLocation, $mapsUrl, $eventId]);
        } else {
            $stmt = $this->db->prepare("
                UPDATE event_details SET
                    event_type_preset = ?,
                    events_schedule_json = ?,
                    quote = ?,
                    akad_time = ?,
                    akad_location = ?,
                    resepsi_time = ?,
                    resepsi_location = ?
                WHERE event_id = ?
            ");
            return $stmt->execute([$preset, $scheduleJson, $quote, $akadTime, $akadLocation, $resepsiTime, $resepsiLocation, $eventId]);
        }
    }

    public function create($userId, $templateId, $categoryId, $title, $slug, $eventDate, $musicUrl = null, $isAdminCreated = 0) {
        $stmt = $this->db->prepare("
            INSERT INTO events (user_id, template_id, category_id, title, slug, event_date, status, music_url, is_admin_created)
            VALUES (?, ?, ?, ?, ?, ?, 'published', ?, ?)
        ");
        $stmt->execute([$userId, $templateId, $categoryId, $title, $slug, $eventDate, $musicUrl, $isAdminCreated]);
        $eventId = $this->db->lastInsertId();

        // Create empty event details
        $stmtDetail = $this->db->prepare("INSERT INTO event_details (event_id) VALUES (?)");
        $stmtDetail->execute([$eventId]);

        return $eventId;
    }

    public function updateEvent($eventId, $data) {
        $stmt = $this->db->prepare("
            UPDATE events SET 
                title = ?, 
                event_date = ?, 
                template_id = ?, 
                music_url = ?,
                status = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['title'],
            $data['event_date'],
            $data['template_id'],
            $data['music_url'] ?? null,
            $data['status'] ?? 'published',
            $eventId
        ]);
    }

    public function updateThemeConfig($eventId, $themeConfigJson) {
        $stmt = $this->db->prepare("UPDATE events SET theme_config_json = ? WHERE id = ?");
        return $stmt->execute([$themeConfigJson, $eventId]);
    }

    public function updateDetails($eventId, $details) {
        $stmt = $this->db->prepare("
            UPDATE event_details SET
                groom_name = ?,
                groom_nickname = ?,
                groom_parents = ?,
                groom_instagram = ?,
                groom_photo = ?,
                bride_name = ?,
                bride_nickname = ?,
                bride_parents = ?,
                bride_instagram = ?,
                bride_photo = ?,
                cover_photo = ?,
                hero_photo = ?,
                bg_photo = ?,
                quote = ?,
                akad_time = ?,
                akad_location = ?,
                resepsi_time = ?,
                resepsi_location = ?,
                maps_url = ?,
                maps_embed = ?,
                events_schedule_json = ?,
                event_type_preset = ?,
                love_story_json = ?,
                gallery_json = ?,
                bank_accounts_json = ?,
                gift_address = ?
            WHERE event_id = ?
        ");
        return $stmt->execute([
            $details['groom_name'] ?? '',
            $details['groom_nickname'] ?? '',
            $details['groom_parents'] ?? '',
            $details['groom_instagram'] ?? '',
            $details['groom_photo'] ?? null,
            $details['bride_name'] ?? '',
            $details['bride_nickname'] ?? '',
            $details['bride_parents'] ?? '',
            $details['bride_instagram'] ?? '',
            $details['bride_photo'] ?? null,
            $details['cover_photo'] ?? null,
            $details['hero_photo'] ?? null,
            $details['bg_photo'] ?? null,
            $details['quote'] ?? '',
            $details['akad_time'] ?? '',
            $details['akad_location'] ?? '',
            $details['resepsi_time'] ?? '',
            $details['resepsi_location'] ?? '',
            $details['maps_url'] ?? '',
            $details['maps_embed'] ?? '',
            $details['events_schedule_json'] ?? null,
            $details['event_type_preset'] ?? 'islam',
            $details['love_story_json'] ?? null,
            $details['gallery_json'] ?? null,
            $details['bank_accounts_json'] ?? null,
            $details['gift_address'] ?? '',
            $eventId
        ]);
    }

    public function delete($id) {
        $this->db->prepare("DELETE FROM event_details WHERE event_id = ?")->execute([$id]);
        $this->db->prepare("DELETE FROM guests WHERE event_id = ?")->execute([$id]);
        $this->db->prepare("DELETE FROM wishes WHERE event_id = ?")->execute([$id]);
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getCounts() {
        return [
            'total_events' => $this->db->query("SELECT COUNT(*) FROM events")->fetchColumn(),
            'total_users' => $this->db->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'total_guests' => $this->db->query("SELECT COUNT(*) FROM guests")->fetchColumn(),
            'total_wishes' => $this->db->query("SELECT COUNT(*) FROM wishes")->fetchColumn(),
        ];
    }
}
