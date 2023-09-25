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
  public static function connect()
  {
    $db = new \mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    $db->query("SET NAMES utf8mb4");
    return $db;
  }
}
