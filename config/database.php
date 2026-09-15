<?php
// config/database.php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = '127.0.0.1';
        $port = '3306';
        $user = 'root';
        $pass = '';
        $dbname = 'reninvite_db';

        try {
            // 1. Coba koneksi ke server MySQL
            $tempPdo = new PDO("mysql:host={$host};port={$port};charset=utf8mb4", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            // 2. Buat database jika belum ada
            $tempPdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

            // 3. Sambungkan ke database `reninvite_db`
            $this->pdo = new PDO("mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            // 4. Inisialisasi tabel otomatis
            $this->initSchema();

        } catch (PDOException $e) {
            die("Koneksi Database Gagal: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }

    private function initSchema() {
        $sql = "
        -- 1. Users Table
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(150) NOT NULL,
            `email` VARCHAR(150) NOT NULL UNIQUE,
            `phone` VARCHAR(30) NULL,
            `password` VARCHAR(255) NOT NULL,
            `role` ENUM('admin', 'user') DEFAULT 'user',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;

        -- 2. Categories Table
        CREATE TABLE IF NOT EXISTS `categories` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(100) NOT NULL,
            `slug` VARCHAR(100) NOT NULL UNIQUE,
            `icon` VARCHAR(50) DEFAULT 'heart',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;

        -- 3. Templates Table
        CREATE TABLE IF NOT EXISTS `templates` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `category_id` INT NULL,
            `name` VARCHAR(150) NOT NULL,
            `slug` VARCHAR(150) NOT NULL UNIQUE,
            `thumbnail` VARCHAR(255) NULL,
            `tier` ENUM('free', 'basic', 'premium') DEFAULT 'free',
            `view_file` VARCHAR(100) NOT NULL,
            `is_active` TINYINT(1) DEFAULT 1,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;

        -- 4. Events Table
        CREATE TABLE IF NOT EXISTS `events` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `template_id` INT NOT NULL,
            `category_id` INT NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(150) NOT NULL UNIQUE,
            `event_date` DATE NOT NULL,
            `status` ENUM('draft', 'published', 'archived') DEFAULT 'published',
            `is_admin_created` TINYINT(1) DEFAULT 0,
            `music_url` VARCHAR(255) NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB;

        -- 5. Event Details Table
        CREATE TABLE IF NOT EXISTS `event_details` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `event_id` INT NOT NULL UNIQUE,
            `groom_name` VARCHAR(150) NULL,
            `groom_nickname` VARCHAR(100) NULL,
            `groom_parents` VARCHAR(255) NULL,
            `groom_instagram` VARCHAR(100) NULL,
            `groom_photo` VARCHAR(255) NULL,
            `bride_name` VARCHAR(150) NULL,
            `bride_nickname` VARCHAR(100) NULL,
            `bride_parents` VARCHAR(255) NULL,
            `bride_instagram` VARCHAR(100) NULL,
            `bride_photo` VARCHAR(255) NULL,
            `cover_photo` VARCHAR(255) NULL,
            `hero_photo` VARCHAR(255) NULL,
            `bg_photo` VARCHAR(255) NULL,
            `quote` TEXT NULL,
            `akad_time` VARCHAR(100) NULL,
            `akad_location` TEXT NULL,
            `resepsi_time` VARCHAR(100) NULL,
            `resepsi_location` TEXT NULL,
            `maps_url` TEXT NULL,
            `maps_embed` TEXT NULL,
            `love_story_json` TEXT NULL,
            `gallery_json` TEXT NULL,
            `bank_accounts_json` TEXT NULL,
            `gift_address` TEXT NULL,
            FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB;

        -- 6. Guests Table
        CREATE TABLE IF NOT EXISTS `guests` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `event_id` INT NOT NULL,
            `name` VARCHAR(150) NOT NULL,
            `phone` VARCHAR(30) NULL,
            `slug` VARCHAR(150) NULL,
            `rsvp_status` ENUM('pending', 'attending', 'not_attending') DEFAULT 'pending',
            `attendance_count` INT DEFAULT 0,
            `qr_code` VARCHAR(100) NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB;

        -- 7. Wishes Table (Buku Tamu Online)
        CREATE TABLE IF NOT EXISTS `wishes` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `event_id` INT NOT NULL,
            `guest_name` VARCHAR(150) NOT NULL,
            `attendance` ENUM('attending', 'not_attending', 'uncertain') DEFAULT 'attending',
            `message` TEXT NOT NULL,
            `reply` TEXT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB;

        -- 8. Orders Table
        CREATE TABLE IF NOT EXISTS `orders` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `event_id` INT NULL,
            `order_number` VARCHAR(50) NOT NULL UNIQUE,
            `package_name` VARCHAR(50) NOT NULL,
            `amount` DECIMAL(12, 2) NOT NULL,
            `payment_status` ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending',
            `payment_method` VARCHAR(50) NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB;

        -- 9. Settings Table (Pengaturan Identitas Web & Branding)
        CREATE TABLE IF NOT EXISTS `settings` (
            `key` VARCHAR(100) NOT NULL PRIMARY KEY,
            `value` TEXT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
        ";

        $this->pdo->exec($sql);
        $this->seedInitialData();
    }

    private function seedInitialData() {
        // Cek apakah data default sudah di-seed
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM `users` WHERE `role` = 'admin'");
        if ($stmt->fetchColumn() == 0) {
            // Admin Default
            $adminPass = password_hash('admin123', PASSWORD_BCRYPT);
            $userPass = password_hash('user123', PASSWORD_BCRYPT);

            $this->pdo->exec("
                INSERT INTO `users` (`name`, `email`, `phone`, `password`, `role`) VALUES
                ('Administrator Pendar Loka', 'admin@pendarloka.com', '081234567890', '{$adminPass}', 'admin'),
                ('Budi Santoso', 'budi@gmail.com', '085171563057', '{$userPass}', 'user');
            ");

            // Categories
            $this->pdo->exec("
                INSERT INTO `categories` (`id`, `name`, `slug`, `icon`) VALUES
                (1, 'Pernikahan', 'pernikahan', 'bi-heart-fill'),
                (2, 'Khitanan', 'khitanan', 'bi-person-badge-fill'),
                (3, 'Aqiqah', 'aqiqah', 'bi-balloon-fill'),
                (4, 'Ulang Tahun', 'ulang-tahun', 'bi-cake2-fill'),
                (5, 'Wisuda', 'wisuda', 'bi-mortarboard-fill'),
                (6, 'Acara Custom', 'custom', 'bi-calendar-event-fill');
            ");

            // Templates
            $this->pdo->exec("
                INSERT INTO `templates` (`id`, `category_id`, `name`, `slug`, `thumbnail`, `tier`, `view_file`) VALUES
                (1, 1, 'Elegan Romance Gold', 'elegan-romance', 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&auto=format&fit=crop&q=80', 'premium', 'elegan_romance'),
                (2, 1, 'Rustic Floral Botanical', 'rustic-floral', 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600&auto=format&fit=crop&q=80', 'basic', 'rustic_floral'),
                (3, 1, 'Aesthetic Modern Pink', 'aesthetic-pink', 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=600&auto=format&fit=crop&q=80', 'free', 'elegan_romance'),
                (4, 2, 'Islamic Khitanan Modern', 'khitanan-modern', 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=600&auto=format&fit=crop&q=80', 'basic', 'rustic_floral');
            ");

            // Demo Event
            $eventDate = date('Y-m-d', strtotime('+30 days'));
            $this->pdo->exec("
                INSERT INTO `events` (`id`, `user_id`, `template_id`, `category_id`, `title`, `slug`, `event_date`, `status`, `music_url`) VALUES
                (1, 2, 1, 1, 'The Wedding of Budi & Siti', 'budi-siti', '{$eventDate}', 'published', 'https://actions.google.com/sounds/v1/water/rain_heavy.ogg');
            ");

            // Demo Event Details
            $loveStory = json_encode([
                ["year" => "2021", "title" => "Pertama Kali Bertemu", "desc" => "Kami pertama kali bertemu di sebuah seminar kampus di Bandung dan mulai saling bertukar kabar."],
                ["year" => "2023", "title" => "Menjalin Hubungan", "desc" => "Setelah mengenal satu sama lain, kami memutuskan untuk saling berkomitmen menuju jenjang yang lebih serius."],
                ["year" => "2025", "title" => "Lamaran", "desc" => "Dengan restu kedua orang tua, kami mengikat janji suci pertunangan di hadapan keluarga besar."]
            ]);

            $gallery = json_encode([
                "https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=700&auto=format&fit=crop&q=80",
                "https://images.unsplash.com/photo-1519741497674-611481863552?w=700&auto=format&fit=crop&q=80",
                "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=700&auto=format&fit=crop&q=80",
                "https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=700&auto=format&fit=crop&q=80"
            ]);

            $bankAccounts = json_encode([
                ["bank" => "BCA", "number" => "1234567890", "owner" => "Budi Santoso"],
                ["bank" => "Bank Mandiri", "number" => "9876543210123", "owner" => "Siti Aminah"]
            ]);

            $quote = "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. (QS. Ar-Rum: 21)";

            $stmtDetail = $this->pdo->prepare("
                INSERT INTO `event_details` (
                    `event_id`, `groom_name`, `groom_nickname`, `groom_parents`, `groom_instagram`,
                    `bride_name`, `bride_nickname`, `bride_parents`, `bride_instagram`,
                    `quote`, `akad_time`, `akad_location`, `resepsi_time`, `resepsi_location`,
                    `maps_url`, `maps_embed`, `love_story_json`, `gallery_json`, `bank_accounts_json`, `gift_address`
                ) VALUES (
                    1, 'Budi Santoso, S.Kom', 'Budi', 'Putra pertama dari Bpk. Bambang & Ibu Sri', '@budisantoso',
                    'Siti Aminah, S.Pd', 'Siti', 'Putri kedua dari Bpk. H. Ahmad & Ibu Fatimah', '@sitiaminah',
                    :quote, '08.00 - 10.00 WIB', 'Masjid Agung Al-Ikhlas, Jl. Merdeka No. 45, Jakarta',
                    '11.00 - 14.00 WIB', 'Grand Ballroom Hotel Aston, Jl. Sudirman Kav. 12, Jakarta',
                    'https://maps.google.com', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28318182289!2d106.759478!3d-6.2297465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e49fe3ddb3%3A0x73d574390f77dd2!2sJakarta!5e0!3m2!1sen!2sid!4v1614000000000!5m2!1sen!2sid\" width=\"100%\" height=\"350\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>',
                    :love_story, :gallery, :bank_accounts, 'Jl. Mawar Melati No. 12, Kel. Sukamaju, Kec. Cilodong, Kota Depok, Jawa Barat 16415'
                );
            ");

            $stmtDetail->execute([
                ':quote' => $quote,
                ':love_story' => $loveStory,
                ':gallery' => $gallery,
                ':bank_accounts' => $bankAccounts
            ]);

            // Demo Guests
            $this->pdo->exec("
                INSERT INTO `guests` (`event_id`, `name`, `phone`, `slug`, `rsvp_status`, `attendance_count`, `qr_code`) VALUES
                (1, 'Bapak Budi & Rekan', '081298765432', 'bapak-budi-rekan', 'attending', 2, 'QR-BUDI-1'),
                (1, 'Sahabat Kampus ITB', '081345678901', 'sahabat-kampus-itb', 'pending', 0, 'QR-KAMPUS-2'),
                (1, 'Keluarga Besar Bpk. Handoko', '081122334455', 'keluarga-handoko', 'attending', 4, 'QR-HANDOKO-3');
            ");

            // Demo Wishes
            $this->pdo->exec("
                INSERT INTO `wishes` (`event_id`, `guest_name`, `attendance`, `message`, `reply`) VALUES
                (1, 'Hendra Wijaya', 'attending', 'Barakallahu lakum wa baraka alaikum! Selamat menempuh hidup baru Budi & Siti, semoga menjadi keluarga sakinah mawaddah warahmah.', 'Aamiin ya rabbal alamin, terima kasih banyak mas Hendra atas doa dan kehadirannya!'),
                (1, 'Dewi Sartika', 'attending', 'Happy wedding Budi & Siti! Lancar sampai hari-H ya, so happy for both of you!', 'Terima kasih banyak mba Dewi! Sampai jumpa di acara yaa.'),
                (1, 'Rian Pratama', 'not_attending', 'Selamat ya bro Budi! Maaf banget belum bisa hadir karena dinas di luar pulau, semoga acaranya berkah dan lancar jaya.', 'Makasih banyak bro Rian, doa terbaik juga untukmu di sana!');
            ");
        }
    }
}
