<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../src/level1/dataTransformation.php";

class DataTransformationTest extends TestCase {
    public $users = [
            ["name" => "John Doe", "email" => "john@example.com", "age" => 30],
            ["name" => "Jane Smith", "email" => "jane@example.com", "age" => 25],
            ["name" => "Alice Johnson", "email" => "alice@example.com", "age" => 28],
            ["name" => "Bob Brown", "email" => "bob@example.com", "age" => 35],
            ["name" => "Charlie Davis", "email" => "charlie@example.com", "age" => 22],
            ["name" => "Diana Evans", "email" => "diana@example.com", "age" => 27],
            ["name" => "Frank Green", "email" => "frank@example.com", "age" => 40],
            ["name" => "Grace Hall", "email" => "grace@example.com", "age" => 33],
            ["name" => "Henry King", "email" => "henry@example.com", "age" => 29],
            ["name" => "Ivy Lewis", "email" => "ivy@example.com", "age" => 24]
        ];
    public function testFilterAge() {
        $age = 27;
        $res = filterAge($this->users, $age);
        $this->assertSame(array_values(array_filter($this->users, fn($user) => (
            $user["age"] > $age
        ))), $res);
    }

    public function testSortName() {
        $res = sortName($this->users);
        $sortedUsers = $this->users;    
        usort($sortedUsers, fn ($user1, $user2) => (
            strcmp($user1["name"], $user2["name"]
        )));
        $this->assertSame($sortedUsers, $res);
    }

    public function testTransformedArray() {
        $transformedArray = [
            ["name" => "John Doe", "email" => "****@example.com"],
            ["name" => "Jane Smith", "email" => "****@example.com"],
            ["name" => "Alice Johnson", "email" => "*****@example.com"],
            ["name" => "Bob Brown", "email" => "***@example.com"],
            ["name" => "Charlie Davis", "email" => "*******@example.com"],
            ["name" => "Diana Evans", "email" => "*****@example.com"],
            ["name" => "Frank Green", "email" => "*****@example.com"],
            ["name" => "Grace Hall", "email" => "*****@example.com"],
            ["name" => "Henry King", "email" => "*****@example.com"],
            ["name" => "Ivy Lewis", "email" => "***@example.com"]
        ];
        $res = transformArray($this->users);
        $this->assertSame($transformedArray, $res);
    }
}