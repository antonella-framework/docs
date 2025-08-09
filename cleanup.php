<?php

$paths = ['build_local', 'build_production', 'cache'];

foreach ($paths as $path) {
    if (is_dir($path)) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            @$todo($fileinfo->getRealPath());
        }

        @rmdir($path);
    }
}

// Create fresh directories with proper permissions
foreach ($paths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
        chmod($path, 0777);
    }
}
