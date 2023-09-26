<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Config;

define("SERVER", "localhost");
define("DATABASE", "dbs_store");
define("USERNAME", "root");
define("PASSWORD", "");

class Database
{
  private $connection;
  private static $instance;

  private function __construct()
  {
    $this->make_connection();
  }

  public static function getInstance()
  {
    if (!self::$instance instanceof self)
      self::$instance = new self();
    return self::$instance;
  }

  private function  make_connection()
  {
    $db = new \mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($db->connect_errno)
      die("Falló la conexión: {$db->connect_error}");

    $setnames = $db->prepare("SET NAMES utf8mb4");
    $setnames->execute();

    $this->connection = $db;
  }

  public function get_database_instance()
  {
    return $this->connection;
  }
}
