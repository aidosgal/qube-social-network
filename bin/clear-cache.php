<?php

require __DIR__ . '/../vendor/autoload.php';

$cachePaths = [
    __DIR__ . '/../var/cache/',
    __DIR__ . '/../var/log/',
];

echo "Clearing application caches...\n";

try {
    foreach ($cachePaths as $path) {
        if (is_dir($path)) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($files as $file) {
                if ($file->isFile()) {
                    unlink($file->getRealPath());
                } elseif ($file->isDir() && !in_array($file->getFilename(), ['.', '..'])) {
                    rmdir($file->getRealPath());
                }
            }
        } elseif (is_file($path)) {
            unlink($path);
        }
    }

    echo "Caches cleared successfully.\n";
} catch (Exception $e) {
    echo "Error clearing cache: " . $e->getMessage() . "\n";
    exit(1);
}

?>
