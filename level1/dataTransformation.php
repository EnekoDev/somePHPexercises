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
    
}