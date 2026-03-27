<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/level1/customSessions.php';

class CustomSessionsTest extends TestCase {
    public function testCreateSession() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        new CustomSession();
        $this->assertEquals(PHP_SESSION_ACTIVE, session_status());
    }

    public function testSetData() {
        session_destroy();
        $key = "user";
        $value = "Test";
        $session = new CustomSession();
        $session->set($key, $value);
        $this->assertSame($value, $session->get($key));
    }
}