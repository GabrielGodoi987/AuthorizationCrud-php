<?php
namespace Token\App\Database;
use PDO;
use PDOException;
class Connection
{
  private $driver;
  private $config;
  private $conn;
  static private $instance = null;

  public function __construct()
  {
    $this->config = require __DIR__ . "/Config.php";;
    $dbConfig = $this->config["database"];
    $this->driver = $dbConfig["driver"];


    try {
      if ($this->driver == "sqlite") {
        $sqliteConfig = $dbConfig['sqlite'];
        $dsn = "sqlite:{$sqliteConfig['path']}";
        $this->conn = new PDO($dsn, null, null);
      }
    } catch (PDOException $th) {
      echo "connection error: " . $th->getMessage();
    }
  }


  public static function getInstance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance->conn;
  }
}