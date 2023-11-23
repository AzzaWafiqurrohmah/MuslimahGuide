<?php


function getdatabaseconfig(): array
{

    $dbname = "zenfemina";
    $username = "root";
    $pass = "123";


    return [
        "database" => [
            "url" => "mysql:host=localhost:3306;dbname=$dbname",
            "username" => $username,
            "password" => $pass
        ]
    ];
}
