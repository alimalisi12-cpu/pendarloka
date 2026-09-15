<?php
// app/Models/User.php

require_once dirname(__DIR__, 2) . '/config/database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT id, name, email, phone, role, created_at FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function register($name, $email, $phone, $password, $role = 'user') {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $hash, $role]);
        return $this->db->lastInsertId();
    }

    public function update($id, $name, $email, $phone, $role) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, phone = ?, role = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $phone, $role, $id]);
    }

    public function updatePassword($id, $newPassword) {
        $hash = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        return $stmt->execute([$hash, $id]);
    }

    public function delete($id) {
        // Cascade delete: first get user events and delete them
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("
            SELECT u.*, COUNT(e.id) as total_events 
            FROM users u 
            LEFT JOIN events e ON u.id = e.user_id 
            GROUP BY u.id 
            ORDER BY u.created_at DESC
        ");
        return $stmt->fetchAll();
    }
}
