<?php
namespace Token\App\UserLogin\Controller;

use Token\App\JWT\TokenManager;
use Token\App\UserLogin\Model\UserModel;

class UserController
{
  private $userModel;
  private $tokenController;
  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->tokenController = new TokenManager();
  }
  public function getHello()
  {
    echo json_encode([
      "Msg" => "hello",
    ]);
  }


  public function getAll()
  {
    echo json_encode([
      "msg" => "dados encontrados com sucesso",
      "data" => $this->userModel->findAll()
    ]);
  }

  public function createUser($data)
  {
    $validRoles = ['admin', 'editor', 'viewer'];

    if (empty($data->username)) {
      echo json_encode(["error" => "Nome de usuário é obrigatório"]);
      return;
    }

    if (empty($data->email) || !filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
      echo json_encode(["error" => "Email inválido ou ausente"]);
      return;
    }

    if (empty($data->password) || strlen($data->password) < 6) {
      echo json_encode(["error" => "A senha deve ter pelo menos 6 caracteres"]);
      return;
    }

    if (empty($data->userRole) || !in_array($data->userRole, $validRoles)) {
      echo json_encode(["error" => "O papel do usuário é inválido. Escolha entre 'admin', 'editor' ou 'viewer'."]);
      return;
    }

    $userExists = $this->userModel->isExistentUser($data->username, $data->email);

    if($userExists){
      echo json_encode(["error"=> "Este email já existe em nossa base de dados"]);
      return;
    }

    $this->userModel->setUsername($data->username);
    $this->userModel->setEmail($data->email);
    $this->userModel->setPassword($data->password);
    $this->userModel->setUserRole($data->userRole);

    try {
      $this->userModel->getUserByEmail($data->email);
      $this->userModel->createUser($this->userModel);
      echo json_encode(["success" => "Usuário criado com sucesso"]);
    } catch (\Exception $e) {
      echo json_encode(["error" => "Erro ao criar o usuário: " . $e->getMessage()]);
    }
  }


  public function loginUser($data)
  {
    $userExists = $this->userModel->getUserByEmail($data->email);
    if ($userExists && password_verify($data->password, $userExists["password"])) {
      unset($userExists["password"]);
      $token = $this->tokenController->createToken($userExists["user_id"]);
      http_response_code(200);
      echo json_encode(
        [
          'msg' => "Usuário autorizado",
          "user" => [
            "role" => $userExists['role'],
            'token' => $token,
          ]
        ]
      );
    } else {
      http_response_code(401);
      echo json_encode(["error" => "Email ou senha inválidos."]);
    }
  }

}