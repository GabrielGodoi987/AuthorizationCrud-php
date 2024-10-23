<?php
namespace Token\App\Database;

return [
    "database" => [
        "driver" => "sqlite",
        "sqlite" => [
             "path" => __DIR__ . '/database.db'
        ],
        "mysql" => [
            "host" => "localhost",
            "dbname" => "root",
            "password" => "localhost123",
            "charset" => "utf8"
        ]
    ]
];