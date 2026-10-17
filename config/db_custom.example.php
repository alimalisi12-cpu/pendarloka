<?php
/**
 * Konfigurasi Database untuk Hosting / cPanel (Opsional)
 *
 * Salin file ini menjadi `config/db_custom.php` di server cPanel Anda.
 * File `db_custom.php` akan diabaikan oleh git sehingga tidak akan tertimpa saat git pull.
 */

$host = 'localhost'; // Biasanya tetap 'localhost' di cPanel
$port = '3306';
$user = 'username_dbuser';     // Ganti dengan User Database cPanel Anda
$pass = 'password_db_anda';    // Ganti dengan Password User Database cPanel
$dbname = 'username_dbname';   // Ganti dengan Nama Database cPanel Anda
