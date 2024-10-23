<?php
namespace Token\App\Routes;
use Token\App\JWT\TokenManager;
use Token\App\UserLogin\Controller\UserController;
// precisamos de uma rota para criar, deletar, atualizar e autenticar usuários
class Rotas {
    public static function fastRotas(){
        return [
            'GET' => [
                '/' => [TokenManager::class, 'createToken'],
                '/allusers' => [UserController::class, 'getAll'],
                '/users/{id}' => []
            ],
            'POST' => [
                '/createuser' => [UserController::class, 'createUser'],
                '/userlogin' => [UserController::class, 'loginUser'],
            ],
            'PUT' => [
               '/post/{id}' => [],
            ],
            'DELETE' => [
                '/users/{id}' => [],
            ],
        ];
    }
}