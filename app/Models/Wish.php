<?php
// app/Models/Wish.php

require_once dirname(__DIR__, 2) . '/config/database.php';

class Wish {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getByEventId($eventId, $limit = 50) {
        $stmt = $this->db->prepare("SELECT * FROM wishes WHERE event_id = ? ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, $eventId, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function add($eventId, $guestName, $attendance, $message) {
        $stmt = $this->db->prepare("INSERT INTO wishes (event_id, guest_name, attendance, message) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$eventId, $guestName, $attendance, $message]);
    }

    public function reply($wishId, $replyText) {
        $stmt = $this->db->prepare("UPDATE wishes SET reply = ? WHERE id = ?");
        return $stmt->execute([$replyText, $wishId]);
    }

    public function delete($wishId, $eventId) {
        $stmt = $this->db->prepare("DELETE FROM wishes WHERE id = ? AND event_id = ?");
        return $stmt->execute([$wishId, $eventId]);
    }
}
