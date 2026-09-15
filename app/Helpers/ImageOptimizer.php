<?php
// app/Helpers/ImageOptimizer.php
// Utility for automatic image compression, WebP conversion, and dimension resizing.

class ImageOptimizer {

    /**
     * Check if WebP is supported by GD in current PHP runtime
     */
    public static function isWebpSupported() {
        return function_exists('imagewebp');
    }

    /**
     * Optimize an existing image file and output to target file (usually .webp)
     *
     * @param string $sourcePath Absolute or relative path to source image
     * @param string $destPath Absolute or relative path to save optimized image
     * @param int $maxWidth Max width allowed in pixels (default 1920)
     * @param int $maxHeight Max height allowed in pixels (default 1920)
     * @param int $quality Compression quality (1-100, default 82)
     * @return array Result metadata
     */
    public static function optimizeFile($sourcePath, $destPath, $maxWidth = 1920, $maxHeight = 1920, $quality = 82) {
        if (!file_exists($sourcePath)) {
            return ['success' => false, 'message' => 'Source file does not exist: ' . $sourcePath];
        }

        $origSize = filesize($sourcePath);
        $imageInfo = @getimagesize($sourcePath);
        if (!$imageInfo) {
            return ['success' => false, 'message' => 'Invalid image format or corrupted file.'];
        }

        $mime = $imageInfo['mime'] ?? '';
        $srcWidth = $imageInfo[0];
        $srcHeight = $imageInfo[1];

        // Create GD resource according to format
        $sourceImg = null;
        switch ($mime) {
            case 'image/jpeg':
                $sourceImg = @imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $sourceImg = @imagecreatefrompng($sourcePath);
                break;
            case 'image/webp':
                $sourceImg = @imagecreatefromwebp($sourcePath);
                break;
            case 'image/gif':
                $sourceImg = @imagecreatefromgif($sourcePath);
                break;
            case 'image/bmp':
            case 'image/x-ms-bmp':
                $sourceImg = @imagecreatefrombmp($sourcePath);
                break;
            default:
                // Try extension if mime check fails
                $ext = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));
                if ($ext === 'jpg' || $ext === 'jpeg') $sourceImg = @imagecreatefromjpeg($sourcePath);
                elseif ($ext === 'png') $sourceImg = @imagecreatefrompng($sourcePath);
                elseif ($ext === 'webp') $sourceImg = @imagecreatefromwebp($sourcePath);
        }

        if (!$sourceImg) {
            // Fallback: copy file if GD cannot decode
            @copy($sourcePath, $destPath);
            return ['success' => true, 'copied_fallback' => true, 'path' => $destPath];
        }

        // Auto-orient according to EXIF if JPEG
        if ($mime === 'image/jpeg' && function_exists('exif_read_data')) {
            $exif = @exif_read_data($sourcePath);
            if (!empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 3:
                        $sourceImg = imagerotate($sourceImg, 180, 0);
                        break;
                    case 6:
                        $sourceImg = imagerotate($sourceImg, -90, 0);
                        $t = $srcWidth; $srcWidth = $srcHeight; $srcHeight = $t;
                        break;
                    case 8:
                        $sourceImg = imagerotate($sourceImg, 90, 0);
                        $t = $srcWidth; $srcWidth = $srcHeight; $srcHeight = $t;
                        break;
                }
            }
        }

        // Calculate proportional scale if dimensions exceed limits
        $targetWidth = $srcWidth;
        $targetHeight = $srcHeight;

        if ($srcWidth > $maxWidth || $srcHeight > $maxHeight) {
            $ratioW = $maxWidth / $srcWidth;
            $ratioH = $maxHeight / $srcHeight;
            $scale = min($ratioW, $ratioH);
            $targetWidth = max(1, (int)round($srcWidth * $scale));
            $targetHeight = max(1, (int)round($srcHeight * $scale));
        }

        // Create canvas
        $targetImg = imagecreatetruecolor($targetWidth, $targetHeight);

        // Preserve alpha transparency for PNG and WebP
        imagealphablending($targetImg, false);
        imagesavealpha($targetImg, true);

        // Resample
        imagecopyresampled($targetImg, $sourceImg, 0, 0, 0, 0, $targetWidth, $targetHeight, $srcWidth, $srcHeight);

        // Determine output directory
        $destDir = dirname($destPath);
        if (!is_dir($destDir)) {
            @mkdir($destDir, 0777, true);
        }

        $destExt = strtolower(pathinfo($destPath, PATHINFO_EXTENSION));
        $saved = false;

        if ($destExt === 'webp' && self::isWebpSupported()) {
            $saved = @imagewebp($targetImg, $destPath, $quality);
        } elseif ($destExt === 'png') {
            // PNG compression level 0-9
            $pngLevel = 8;
            $saved = @imagepng($targetImg, $destPath, $pngLevel);
        } else {
            // Default to JPEG
            // Fill background with white if source was transparent
            $bg = imagecreatetruecolor($targetWidth, $targetHeight);
            $white = imagecolorallocate($bg, 255, 255, 255);
            imagefill($bg, 0, 0, $white);
            imagecopy($bg, $targetImg, 0, 0, 0, 0, $targetWidth, $targetHeight);
            $saved = @imagejpeg($bg, $destPath, $quality);
            imagedestroy($bg);
        }

        imagedestroy($sourceImg);
        imagedestroy($targetImg);

        if ($saved && file_exists($destPath)) {
            $newSize = filesize($destPath);
            return [
                'success' => true,
                'path' => $destPath,
                'orig_size' => $origSize,
                'new_size' => $newSize,
                'saved_bytes' => max(0, $origSize - $newSize),
                'saved_pct' => $origSize > 0 ? round((1 - ($newSize / $origSize)) * 100, 1) : 0,
                'width' => $targetWidth,
                'height' => $targetHeight
            ];
        }

        return ['success' => false, 'message' => 'Failed to save optimized image'];
    }

    /**
     * Process an uploaded file, optimize it, save it as .webp, and return relative path
     *
     * @param array $file Single $_FILES['file'] item
     * @param string $targetDir Absolute path to upload directory
     * @param string $prefix Filename prefix (e.g. 'photo', 'cover', 'gallery')
     * @param int $maxWidth Max width (default 1920)
     * @param int $maxHeight Max height (default 1920)
     * @param int $quality WebP quality (default 82)
     * @return string|null Relative path from root (e.g. 'assets/uploads/events/photo_xxx.webp') or null on error
     */
    public static function optimizeUploadedFile($file, $targetDir, $prefix = 'photo', $maxWidth = 1920, $maxHeight = 1920, $quality = 82) {
        if (!isset($file['tmp_name']) || !file_exists($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExts)) {
            return null;
        }

        if (!is_dir($targetDir)) {
            @mkdir($targetDir, 0777, true);
        }

        // Use .webp if supported, otherwise keep .jpg
        $outExt = self::isWebpSupported() ? 'webp' : ($ext === 'png' ? 'png' : 'jpg');
        $uniqueName = $prefix . '_' . uniqid() . '_' . time() . '.' . $outExt;
        $destPath = rtrim($targetDir, '/\\') . DIRECTORY_SEPARATOR . $uniqueName;

        $res = self::optimizeFile($file['tmp_name'], $destPath, $maxWidth, $maxHeight, $quality);
        if ($res['success']) {
            // Find relative path from BASE_PATH
            $rel = str_replace(['\\', BASE_PATH . '/'], ['/', ''], $destPath);
            return ltrim($rel, '/');
        }

        // Fallback: normal move_uploaded_file if optimizer fails
        $fallbackName = $prefix . '_' . uniqid() . '_' . time() . '.' . $ext;
        $fallbackPath = rtrim($targetDir, '/\\') . DIRECTORY_SEPARATOR . $fallbackName;
        if (@move_uploaded_file($file['tmp_name'], $fallbackPath)) {
            $rel = str_replace(['\\', BASE_PATH . '/'], ['/', ''], $fallbackPath);
            return ltrim($rel, '/');
        }

        return null;
    }
}
