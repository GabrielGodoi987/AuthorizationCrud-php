<?php
namespace Token\App\JWT;
return [
    "payload" => [
        "iss" => "http://localhost:8080",
        "aud" => "",
        "iat" => time(),
        "nfb" => time(),
        "exp" => time() + 60 * 60 * 24
    ],
    "secret_key" => "teste_criarToken123",
    "algorithm" => "HS256"
];