<?php
// app/Models/Template.php

require_once dirname(__DIR__, 2) . '/config/database.php';

class Template {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($categoryId = null) {
        if ($categoryId) {
            $stmt = $this->db->prepare("
                SELECT t.*, c.name as category_name 
                FROM templates t 
                LEFT JOIN categories c ON t.category_id = c.id 
                WHERE t.category_id = ? AND t.is_active = 1
                ORDER BY t.id ASC
            ");
            $stmt->execute([$categoryId]);
            return $stmt->fetchAll();
        }

        $stmt = $this->db->query("
            SELECT t.*, c.name as category_name 
            FROM templates t 
            LEFT JOIN categories c ON t.category_id = c.id 
            WHERE t.is_active = 1
            ORDER BY t.id ASC
        ");
        return $stmt->fetchAll();
    }

    public function getAllAdmin() {
        $stmt = $this->db->query("
            SELECT t.*, c.name as category_name,
                   (SELECT COUNT(*) FROM events WHERE template_id = t.id) as total_used
            FROM templates t 
            LEFT JOIN categories c ON t.category_id = c.id 
            ORDER BY t.id ASC
        ");
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM templates WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getCategories() {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO templates (name, slug, category_id, thumbnail, tier, view_file, animation_config_json, is_active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['category_id'],
            $data['thumbnail'],
            $data['tier'] ?? 'free',
            $data['view_file'] ?? 'nature_classic',
            $data['animation_config_json'] ?? null,
            $data['is_active'] ?? 1
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE templates 
            SET name = ?, slug = ?, category_id = ?, thumbnail = ?, tier = ?, view_file = ?, animation_config_json = ?, is_active = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['category_id'],
            $data['thumbnail'],
            $data['tier'],
            $data['view_file'],
            $data['animation_config_json'] ?? null,
            $data['is_active'],
            $id
        ]);
    }

    public function toggleStatus($id) {
        $tmpl = $this->findById($id);
        if ($tmpl) {
            $newStatus = $tmpl['is_active'] ? 0 : 1;
            $stmt = $this->db->prepare("UPDATE templates SET is_active = ? WHERE id = ?");
            return $stmt->execute([$newStatus, $id]);
        }
        return false;
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM templates WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
