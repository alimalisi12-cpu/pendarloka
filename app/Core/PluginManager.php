<?php
// app/Core/PluginManager.php

class PluginManager {
    private static $pluginsDir = null;
    private static $activePlugins = null;
    private static $actions = [];
    private static $filters = [];
    private static $initialized = false;

    public static function getPluginsDir() {
        if (self::$pluginsDir === null) {
            self::$pluginsDir = BASE_PATH . '/plugins';
            if (!is_dir(self::$pluginsDir)) {
                mkdir(self::$pluginsDir, 0777, true);
            }
        }
        return self::$pluginsDir;
    }

    /**
     * Inisialisasi Plugin Manager dan load semua plugin yang aktif
     */
    public static function init() {
        if (self::$initialized) return;
        self::$initialized = true;

        $dir = self::getPluginsDir();
        $activeList = self::getActivePluginsList();

        foreach ($activeList as $pluginSlug) {
            $mainFile = self::findPluginMainFile($pluginSlug);
            if ($mainFile && file_exists($mainFile)) {
                try {
                    require_once $mainFile;
                } catch (Throwable $e) {
                    error_log("Error loading plugin [{$pluginSlug}]: " . $e->getMessage());
                }
            }
        }

        // Trigger action app_init
        self::doAction('app_init');
    }

    /**
     * Ambil daftar slug plugin yang aktif dari database settings
     */
    public static function getActivePluginsList() {
        if (self::$activePlugins === null) {
            $raw = Setting::get('active_plugins', '[]');
            $decoded = json_decode($raw, true);
            self::$activePlugins = is_array($decoded) ? $decoded : [];
        }
        return self::$activePlugins;
    }

    /**
     * Cek apakah suatu plugin sedang aktif
     */
    public static function isPluginActive($slug) {
        return in_array($slug, self::getActivePluginsList());
    }

    /**
     * Temukan berkas PHP utama plugin dalam folder plugins/{slug}
     */
    public static function findPluginMainFile($slug) {
        $dir = self::getPluginsDir() . '/' . $slug;
        if (!is_dir($dir)) return null;

        // 1. Coba plugins/{slug}/{slug}.php
        $directFile = $dir . '/' . $slug . '.php';
        if (file_exists($directFile)) {
            return $directFile;
        }

        // 2. Coba plugins/{slug}/index.php atau plugin.php
        if (file_exists($dir . '/index.php')) return $dir . '/index.php';
        if (file_exists($dir . '/plugin.php')) return $dir . '/plugin.php';

        // 3. Scan semua file PHP untuk mencari header "Plugin Name:"
        $files = glob($dir . '/*.php');
        foreach ($files as $f) {
            $content = file_get_contents($f, false, null, 0, 4096);
            if (stripos($content, 'Plugin Name:') !== false) {
                return $f;
            }
        }

        return !empty($files) ? $files[0] : null;
    }

    /**
     * Ambil metadata seluruh plugin yang terpasang di folder plugins/
     */
    public static function getAllPlugins() {
        $dir = self::getPluginsDir();
        $folders = glob($dir . '/*', GLOB_ONLYDIR);
        $plugins = [];
        $activeList = self::getActivePluginsList();

        if (is_array($folders)) {
            foreach ($folders as $folder) {
                $slug = basename($folder);
                $mainFile = self::findPluginMainFile($slug);
                $header = $mainFile ? self::parsePluginHeader($mainFile) : [];

                $name = !empty($header['name']) ? $header['name'] : ucwords(str_replace(['-', '_'], ' ', $slug));
                $description = !empty($header['description']) ? $header['description'] : 'Tidak ada deskripsi.';
                $version = !empty($header['version']) ? $header['version'] : '1.0.0';
                $author = !empty($header['author']) ? $header['author'] : 'Pendar Loka Contributor';
                $authorUri = !empty($header['author_uri']) ? $header['author_uri'] : '';
                $pluginUri = !empty($header['plugin_uri']) ? $header['plugin_uri'] : '';
                $icon = !empty($header['icon']) ? $header['icon'] : 'bi-puzzle-fill';

                $plugins[$slug] = [
                    'slug' => $slug,
                    'name' => $name,
                    'description' => $description,
                    'version' => $version,
                    'author' => $author,
                    'author_uri' => $authorUri,
                    'plugin_uri' => $pluginUri,
                    'icon' => $icon,
                    'main_file' => $mainFile,
                    'is_active' => in_array($slug, $activeList),
                    'folder' => $folder
                ];
            }
        }

        return $plugins;
    }

    /**
     * Parse header metadata plugin ala WordPress
     */
    public static function parsePluginHeader($filePath) {
        $data = file_get_contents($filePath, false, null, 0, 8192);
        $header = [];

        $patterns = [
            'name'        => '/Plugin Name:\s*([^\r\n]+)/i',
            'plugin_uri'  => '/Plugin URI:\s*([^\r\n]+)/i',
            'version'     => '/Version:\s*([^\r\n]+)/i',
            'description' => '/Description:\s*([^\r\n]+)/i',
            'author'      => '/Author:\s*([^\r\n]+)/i',
            'author_uri'  => '/Author URI:\s*([^\r\n]+)/i',
            'icon'        => '/Icon:\s*([^\r\n]+)/i',
        ];

        foreach ($patterns as $key => $pattern) {
            if (preg_match($pattern, $data, $matches)) {
                $header[$key] = trim($matches[1]);
            }
        }

        return $header;
    }

    /**
     * Mengaktifkan Plugin
     */
    public static function activatePlugin($slug) {
        $activeList = self::getActivePluginsList();
        if (!in_array($slug, $activeList)) {
            $activeList[] = $slug;
            self::$activePlugins = array_values(array_unique($activeList));
            Setting::set('active_plugins', json_encode(self::$activePlugins));

            // Load main file & panggil activation hook jika ada
            $mainFile = self::findPluginMainFile($slug);
            if ($mainFile && file_exists($mainFile)) {
                require_once $mainFile;
                self::doAction('activate_' . $slug);
            }
            return true;
        }
        return false;
    }

    /**
     * Menonaktifkan Plugin
     */
    public static function deactivatePlugin($slug) {
        $activeList = self::getActivePluginsList();
        if (in_array($slug, $activeList)) {
            self::doAction('deactivate_' . $slug);
            $activeList = array_diff($activeList, [$slug]);
            self::$activePlugins = array_values($activeList);
            Setting::set('active_plugins', json_encode(self::$activePlugins));
            return true;
        }
        return false;
    }

    /**
     * Toggle status aktif Plugin
     */
    public static function togglePlugin($slug) {
        if (self::isPluginActive($slug)) {
            return self::deactivatePlugin($slug);
        } else {
            return self::activatePlugin($slug);
        }
    }

    /**
     * Menghapus Folder Plugin
     */
    public static function deletePlugin($slug) {
        self::deactivatePlugin($slug);
        $dir = self::getPluginsDir() . '/' . $slug;
        if (is_dir($dir)) {
            self::deleteDirRecursive($dir);
            return true;
        }
        return false;
    }

    /**
     * Import Plugin dari file ZIP yang diunggah
     */
    public static function importPluginFromZip($tmpFile, $originalName) {
        if (!class_exists('ZipArchive')) {
            throw new Exception('Ekstensi PHP ZipArchive tidak aktif pada server.');
        }

        $zip = new ZipArchive();
        if ($zip->open($tmpFile) !== TRUE) {
            throw new Exception('Gagal membuka berkas ZIP plugin.');
        }

        // Tentukan nama folder slug dari nama file atau root folder zip
        $firstEntry = $zip->getNameIndex(0);
        $zipSlug = '';
        if ($firstEntry && strpos($firstEntry, '/') !== false) {
            $parts = explode('/', trim($firstEntry, '/'));
            $zipSlug = $parts[0];
        }

        if (empty($zipSlug) || str_ends_with($zipSlug, '.php')) {
            $zipSlug = strtolower(trim(preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($originalName, PATHINFO_FILENAME))));
        }

        $targetDir = self::getPluginsDir() . '/' . $zipSlug;
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Extract
        $zip->extractTo(self::getPluginsDir());
        $zip->close();

        // Validasi apakah berkas PHP berhasil diekstrak
        $mainFile = self::findPluginMainFile($zipSlug);
        if (!$mainFile || !file_exists($mainFile)) {
            // Coba scan folder
            $files = glob($targetDir . '/*.php');
            if (empty($files)) {
                self::deleteDirRecursive($targetDir);
                throw new Exception('Berkas ZIP tidak memiliki file PHP plugin yang valid.');
            }
        }

        return $zipSlug;
    }

    // ==============================================================
    // SISTEM HOOKS ALA WORDPRESS (ACTIONS & FILTERS)
    // ==============================================================

    public static function addAction($hook, $callback, $priority = 10) {
        self::$actions[$hook][$priority][] = $callback;
    }

    public static function doAction($hook, ...$args) {
        if (empty(self::$actions[$hook])) return;

        ksort(self::$actions[$hook]);
        foreach (self::$actions[$hook] as $priority => $callbacks) {
            foreach ($callbacks as $callback) {
                if (is_callable($callback)) {
                    call_user_func_array($callback, $args);
                }
            }
        }
    }

    public static function addFilter($hook, $callback, $priority = 10) {
        self::$filters[$hook][$priority][] = $callback;
    }

    public static function applyFilters($hook, $value, ...$args) {
        if (empty(self::$filters[$hook])) return $value;

        ksort(self::$filters[$hook]);
        foreach (self::$filters[$hook] as $priority => $callbacks) {
            foreach ($callbacks as $callback) {
                if (is_callable($callback)) {
                    $value = call_user_func_array($callback, array_merge([$value], $args));
                }
            }
        }
        return $value;
    }

    private static function deleteDirRecursive($dir) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!self::deleteDirRecursive($dir . DIRECTORY_SEPARATOR . $item)) return false;
        }
        return rmdir($dir);
    }
}
