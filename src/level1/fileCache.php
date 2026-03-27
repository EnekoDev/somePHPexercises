<?php

class FileCache {
    private string $cacheDir;

    public function __construct(string $cacheDir = __DIR__ . '/chache') {
        $this->cacheDir = rtrim($cacheDir, '/');
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    private function getFilePath(string $key):string {
        $filename = md5($key) . ".cache.php";
        return "{$this->cacheDir}/{$filename}";
    }

    public function set(string $key, mixed $data, int $ttl = 300):void {
        $expires = time() + $ttl;
        $content = serialize([
            "expires" => $expires,
            "data" => $data
        ]);
        file_put_contents($this->getFilePath($key), $content);
    }

    public function get(string $key):mixed {
        $file = $this->getFilePath($key);
        if (!file_exists($file)) {
            return null;
        }

        $content = file_get_contents($file);
        // the @ silences any php errors
        $cached = @unserialize($content);

        if (!$cached || time() > $cached['expires']) {
            unlink($file);
            return null;
        }

        return $cached['data'];
    }

    public function delete(string $key):void {
        $file = $this->getFilePath($key);
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function clear():void {
        foreach(glob("{$this->cacheDir}/*.cache.php") as $file) {
            unlink($file);
        }
    }
}