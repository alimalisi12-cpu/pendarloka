<?php
// app/Models/Setting.php

require_once dirname(__DIR__, 2) . '/config/database.php';

class Setting {
    private static $cache = null;

    /**
     * Mengambil seluruh data pengaturan dari database
     */
    public static function getAll() {
        if (self::$cache === null) {
            try {
                $pdo = Database::getInstance();
                $stmt = $pdo->query("SELECT `key`, `value` FROM `settings`");
                $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
                self::$cache = $rows ?: [];
            } catch (Exception $e) {
                self::$cache = [];
            }
        }
        return self::$cache;
    }

    /**
     * Mengambil satu nilai pengaturan berdasarkan key
     */
    public static function get($key, $default = null) {
        $settings = self::getAll();
        return $settings[$key] ?? $default;
    }

    /**
     * Menyimpan / memperbarui satu nilai pengaturan
     */
    public static function set($key, $value) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("
            INSERT INTO `settings` (`key`, `value`) 
            VALUES (:key, :val) 
            ON DUPLICATE KEY UPDATE `value` = :val
        ");
        $stmt->execute([':key' => $key, ':val' => $value]);

        if (self::$cache !== null) {
            self::$cache[$key] = $value;
        }
        return true;
    }

    /**
     * Menyimpan banyak pengaturan sekaligus
     */
    public static function setMultiple(array $data) {
        $pdo = Database::getInstance();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("
                INSERT INTO `settings` (`key`, `value`) 
                VALUES (:key, :val) 
                ON DUPLICATE KEY UPDATE `value` = :val
            ");
            foreach ($data as $key => $val) {
                $stmt->execute([':key' => $key, ':val' => $val]);
                if (self::$cache !== null) {
                    self::$cache[$key] = $val;
                }
            }
            $pdo->commit();
            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }
}