<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Models;

use Config\Database;

class Category
{
  private $id;
  private $name;
  private $database;

  public function __construct()
  {
    $this->database = Database::getInstance()->get_database_instance();
  }

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $this->database->real_escape_string($name);
  }

  public function getAll()
  {
    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categories = $this->database->query($sql);
    return $categories;
  }
}
