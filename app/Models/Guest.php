<?php
// app/Models/Guest.php

require_once dirname(__DIR__, 2) . '/config/database.php';

class Guest {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getByEventId($eventId) {
        $stmt = $this->db->prepare("SELECT * FROM guests WHERE event_id = ? ORDER BY id DESC");
        $stmt->execute([$eventId]);
        return $stmt->fetchAll();
    }

    public function add($eventId, $name, $phone = '') {
        $slug = preg_replace('/[^a-z0-9]+/i', '-', strtolower(trim($name)));
        $qr = 'QR-' . strtoupper(substr(md5(uniqid()), 0, 8));
        $stmt = $this->db->prepare("INSERT INTO guests (event_id, name, phone, slug, qr_code) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$eventId, $name, $phone, $slug, $qr]);
        return $this->db->lastInsertId();
    }

    public function delete($id, $eventId) {
        $stmt = $this->db->prepare("DELETE FROM guests WHERE id = ? AND event_id = ?");
        return $stmt->execute([$id, $eventId]);
    }

    public function updateRsvp($id, $status, $count = 1) {
        $stmt = $this->db->prepare("UPDATE guests SET rsvp_status = ?, attendance_count = ? WHERE id = ?");
        return $stmt->execute([$status, $count, $id]);
    }

    public function getStats($eventId) {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN rsvp_status = 'attending' THEN 1 ELSE 0 END) as attending,
                SUM(CASE WHEN rsvp_status = 'not_attending' THEN 1 ELSE 0 END) as not_attending,
                SUM(CASE WHEN rsvp_status IN ('pending', 'uncertain') THEN 1 ELSE 0 END) as pending,
                SUM(attendance_count) as total_attendance_pax
            FROM guests
            WHERE event_id = ?
        ");
        $stmt->execute([$eventId]);
        return $stmt->fetch();
    }
}
