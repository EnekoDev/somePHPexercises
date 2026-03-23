<?php

class CustomSession {
    private string $_id;
    public function __construct() {
        $random_hex = bin2hex(random_bytes(18));
        $this->_id = $random_hex;
        session_id($this->_id);
        session_start();
        session_unset();
        $_SESSION['flash'] = "Session iniziated successfully";
    }

    public function get(string $key) {
        return $_SESSION[$key] ?? null;
    }

    public function set(string $key, string $value) {
        $_SESSION[$key] = $value;
    }
}