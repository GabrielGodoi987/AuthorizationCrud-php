<?php
namespace Token\App\JWT;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class TokenManager
{
    private $config;
    private $payload;
    private $key;

    public function __construct()
    {
        $this->config = require __DIR__ . "/TokenConfig.php";
        $this->payload = $this->config["payload"];
        $this->key = $this->config["secret_key"];
    }

    public function createToken($data)
    {
        $id = $this->payload['id'] = $data->id;
        if ($id == null) {
            echo json_encode([
                "msg" => "Campo id não foi passado"
            ]);
            return;
        }
        try {
            $jwt = JWT::encode([$id], $this->key, $this->config["algorithm"]);
            echo $jwt;
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }

    public function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, $this->key, $this->config["algorithm"]);
            return (array) $decoded;
        } catch (ExpiredException $e) {
            return 'Token has expired';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
