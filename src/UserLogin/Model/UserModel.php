<?php
namespace Token\App\UserLogin\Model;
use Token\App\Database\Connection;
use PDO;
use PDOException;

class UserModel
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $userRole;
    private $conn;
    private $table;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
        $this->table = "users";
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getUserRole()
    {
        return $this->userRole;
    }
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;
    }

    public function isExistentUser($name, $email)
    {
        $isExistentEmail = $this->getUserByEmail($email);
        return $isExistentEmail['email'] === $email;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->table";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }
    public function createUser(UserModel $data)
    {
        $username = $data->getUsername();
        $password = $data->getPassword();
        $email = $data->getEmail();
        $role = $data->getUserRole();

        $query = "INSERT INTO $this->table (username, password, email, role) values(:username, :password, :email, :role)";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":role", $role, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }
    public function updateUser($id, $data)
    {
    }
    public function getUserById($id)
    {
        $query = "SELECT FROM $this->table WHERE $this->table.uder_id == :id";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }
    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM $this->table WHERE $this->table.username == :username";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM $this->table where $this->table.email == :email LIMIT 1;";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }
    public function deleteUserById($id)
    {
    }

}