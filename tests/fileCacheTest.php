<?php

use PHPUNIT\Framework\TestCase;

require_once __DIR__ . "/../src/level1/fileCache.php";

class FileCacheTest extends TestCase {
    public function testCacheDirCreated() {
        $cacheDir = __DIR__ . "/../src/level1/cache";
        if (is_dir($cacheDir)) {
            rmdir($cacheDir);
        }
        new FileCache(__DIR__ . "/../src/level1/cache");
        $this->assertDirectoryExists($cacheDir);
    }
}