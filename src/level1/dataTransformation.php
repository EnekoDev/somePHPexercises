<?php

/*
* @return array{name:string, email:string, age:int}
*/
function filterAge( array $users, int $age):Array {
    $filter = [];
    foreach ($users as $user) {
        if (is_array($user)) {
            foreach ($user as $key => $value) {
                if ($key === "age") {
                    if ($value > $age) {
                        array_push($filter, $user);
                    }
                }
            }
        }
    }
    return $filter;
}

function sortName( array $users ) {
    $sortedUsers = $users;    
    usort($sortedUsers, fn ($user1, $user2) => (
        strcmp($user1["name"], $user2["name"]
    )));
    return $sortedUsers;
}

function transformArray(array $users) {
    $transformed = [];
    foreach ($users as $user) {
        unset($user["age"]);
        $index = strpos($user["email"], "@");
        $email = substr_replace($user["email"], str_repeat("*", $index), 0, $index);
        $user["email"] = $email;
        array_push($transformed, $user);
    }
    return $transformed;
}