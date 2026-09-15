<?php
// config/app.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Application Constants
if (!defined('APP_URL')) {
    if (php_sapi_name() === 'cli' || empty($_SERVER['HTTP_HOST'])) {
        define('APP_URL', 'http://localhost/pendar-loka');
    } else {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];
        $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
        define('APP_URL', $protocol . $host . $scriptDir);
    }
}
define('BASE_PATH', dirname(__DIR__));

// Load Dynamic Settings from Database
require_once __DIR__ . '/../app/Models/Setting.php';
require_once __DIR__ . '/presets.php';

$dynAppName = Setting::get('app_name', 'PENDAR LOKA');
$dynAppTagline = Setting::get('app_tagline', 'Platform Undangan Digital Modern & Elegan');

define('APP_NAME', $dynAppName);
define('APP_TAGLINE', $dynAppTagline);

// Helper Functions
function site_setting($key, $default = null) {
    return Setting::get($key, $default);
}

function site_name() {
    return Setting::get('app_name', APP_NAME);
}

function site_tagline() {
    return Setting::get('app_tagline', APP_TAGLINE);
}

function site_logo_url($mode = null) {
    if ($mode === 'light') {
        $logo = Setting::get('site_logo_light') ?: Setting::get('site_logo');
    } elseif ($mode === 'dark') {
        $logo = Setting::get('site_logo_dark') ?: Setting::get('site_logo_light') ?: Setting::get('site_logo');
    } else {
        $logo = Setting::get('site_logo_light') ?: Setting::get('site_logo');
    }

    if (!empty($logo)) {
        if (str_starts_with($logo, 'http://') || str_starts_with($logo, 'https://')) {
            return $logo;
        }
        return base_url($logo);
    }
    return '';
}

function site_favicon_url() {
    $favicon = Setting::get('site_favicon');
    if (!empty($favicon)) {
        if (str_starts_with($favicon, 'http://') || str_starts_with($favicon, 'https://')) {
            return $favicon;
        }
        return base_url($favicon);
    }
    return '';
}

function media_url($path) {
    if (empty($path)) return '';
    $path = trim($path);
    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//') || str_starts_with($path, 'data:')) {
        return $path;
    }
    return base_url(ltrim($path, '/'));
}


function site_title($pageTitle = '') {
    $format = Setting::get('page_title_format', '{title} | {app_name}');
    $appName = site_name();
    $tagline = site_tagline();

    if (empty($pageTitle)) {
        return "{$appName} - {$tagline}";
    }

    return str_replace(
        ['{title}', '{app_name}', '{tagline}'],
        [$pageTitle, $appName, $tagline],
        $format
    );
}

function site_description() {
    $desc = Setting::get('site_description');
    if (!empty($desc)) {
        return $desc;
    }
    $heroDesc = Setting::get('hero_description');
    if (!empty($heroDesc)) {
        return strip_tags($heroDesc);
    }
    return 'Platform Undangan Digital Modern & Elegan. Buat undangan pernikahan, khitanan, aqiqah, dan event spesial cepat berkualitas.';
}

function base_url($path = '') {
    return APP_URL . ($path ? '/' . ltrim($path, '/') : '');
}

function asset($path = '') {
    return base_url('public/assets/' . ltrim($path, '/'));
}

function redirect($path) {
    header('Location: ' . base_url($path));
    exit;
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function current_user() {
    return $_SESSION['user'] ?? null;
}

function is_admin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

function e($str) {
    if ($str === null || $str === '') return '';
    if (is_string($str) && strpos($str, '&amp;') !== false) {
        $prev = '';
        while ($str !== $prev && strpos($str, '&amp;') !== false) {
            $prev = $str;
            $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
        }
    }
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    if ($data === null) {
        return '';
    }
    $cleaned = trim($data);
    while (strpos($cleaned, '&amp;') !== false) {
        $cleaned = html_entity_decode($cleaned, ENT_QUOTES, 'UTF-8');
    }
    return strip_tags($cleaned);
}

function set_flash($type, $message) {
    $_SESSION['flash'][$type] = $message;
}

function get_flash($type) {
    if (isset($_SESSION['flash'][$type])) {
        $msg = $_SESSION['flash'][$type];
        unset($_SESSION['flash'][$type]);
        return $msg;
    }
    return null;
}

// ==========================================
// PLUGIN SYSTEM & WORDPRESS-LIKE HOOKS
// ==========================================
require_once __DIR__ . '/../app/Core/PluginManager.php';
PluginManager::init();

function add_action($hook, $callback, $priority = 10) {
    PluginManager::addAction($hook, $callback, $priority);
}

function do_action($hook, ...$args) {
    PluginManager::doAction($hook, ...$args);
}

function add_filter($hook, $callback, $priority = 10) {
    PluginManager::addFilter($hook, $callback, $priority);
}

function apply_filters($hook, $value, ...$args) {
    return PluginManager::applyFilters($hook, $value, ...$args);
}

// ==========================================
// UNIVERSAL SMART AUTO-SCROLL ENGINE
// ==========================================
add_action('invitation_footer', function($event) {
    $partialPath = BASE_PATH . '/views/partials/universal_autoscroll.php';
    if (file_exists($partialPath)) {
        require_once $partialPath;
    }
}, 99);

// ==========================================
// UNIVERSAL SMART ANIMATION & TRANSITION ENGINE
// ==========================================
add_action('invitation_head', function($event = null) {
    $animPath = BASE_PATH . '/views/partials/universal_animation_engine.php';
    if (file_exists($animPath)) {
        require_once $animPath;
    }
}, 5);

