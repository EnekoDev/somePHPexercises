<?php

use PHPUNIT\Framework\TestCase;

require_once __DIR__ . "/../src/level1/fileCache.php";

class FileCacheTest extends TestCase {
    private string $cacheDir = __DIR__ . "/../src/level1/cache";
    private string $fileExt = ".cache.php";

    public function testCacheDirCreated() {
        if (is_dir($this->cacheDir)) {
            rmdir($this->cacheDir);
        }
        new FileCache($this->cacheDir);
        $this->assertDirectoryExists($this->cacheDir);
    }

    public function testSetFile() {
        $cache = new FileCache($this->cacheDir);
        $data = ["testData" => "this data is for testing", "moreData" => "this is more data"];
        $cache->set("test", $data);
        $this->assertFileExists($this->cacheDir . "/test" . $this->fileExt);
    }
}