<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../level1/dataTransformation.php";

class DataTransformationTest extends TestCase {
    public function testFilterAge() {
        $users = [
            ["name" => "John Doe",        "email" => "john@example.com",        "age" => 30],
            ["name" => "Jane Smith",      "email" => "jane@example.com",        "age" => 25],
            ["name" => "Alice Johnson",   "email" => "alice@example.com",       "age" => 28],
            ["name" => "Bob Brown",       "email" => "bob@example.com",         "age" => 35],
            ["name" => "Charlie Davis",   "email" => "charlie@example.com",     "age" => 22],
            ["name" => "Diana Evans",     "email" => "diana@example.com",       "age" => 27],
            ["name" => "Frank Green",     "email" => "frank@example.com",       "age" => 40],
            ["name" => "Grace Hall",      "email" => "grace@example.com",       "age" => 33],
            ["name" => "Henry King",      "email" => "henry@example.com",       "age" => 29],
            ["name" => "Ivy Lewis",       "email" => "ivy@example.com",         "age" => 24]
        ];
        $result = filterAge($users, 27);
        $this->assertEquals(6, count($result));
    }
}