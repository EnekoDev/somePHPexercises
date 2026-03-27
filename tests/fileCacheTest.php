<?php

use PHPUNIT\Framework\TestCase;

require_once __DIR__ . "/../src/level1/fileCache.php";

class FileCacheTest extends TestCase {
    private string $cacheDir = __DIR__ . "/../src/level1/cache";

    private function deleteDir($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            if (!$this->deleteDir($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        rmdir($dir);
    }

    public function testCacheDirCreated() {
        if (is_dir($this->cacheDir)) {
            echo "DELETING CACHE";
            $this->deleteDir($this->cacheDir);
        }
        new FileCache($this->cacheDir);
        $this->assertDirectoryExists($this->cacheDir);
    }

    public function testSetFile() {
        $cache = new FileCache($this->cacheDir);
        $key = "test";
        $data = ["testData" => "this data is for testing", "moreData" => "this is more data"];
        $cache->set($key, $data);
        $this->assertFileExists($this->cacheDir . "/" . md5($key) . ".cache.php");
    }

    public function testGetFile() {
        $cache = new FileCache($this->cacheDir);
        $data = $cache->get("test");
        $this->assertEquals(["testData" => "this data is for testing", "moreData" => "this is more data"], $data);
    }

    public function testDeleteFile() {
        $cache = new FileCache($this->cacheDir);
        $key = "test";
        $cache->delete($key);
        $this->assertFileDoesNotExist($this->cacheDir . "/" . md5($key) . ".cache.php");
    }
}