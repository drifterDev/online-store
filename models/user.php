<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Models;

use Config\Database;

class User
{
  private $id;
  private $name;
  private $surnames;
  private $email;
  private $password;
  private $role;
  private $image;
  private $database;

  public function __construct()
  {
    $this->database = Database::getInstance()->get_database_instance();
  }

  function getId()
  {
    return $this->id;
  }

  function setId($id)
  {
    $this->id = $id;
  }

  function getName()
  {
    return $this->name;
  }

  function setName($name)
  {
    $this->name = $this->database->real_escape_string($name);
  }

  function getSurnames()
  {
    return $this->surnames;
  }

  function setSurnames($surnames)
  {
    $this->surnames = $this->database->real_escape_string($surnames);
  }

  function getEmail()
  {
    return $this->email;
  }

  function setEmail($email)
  {
    $this->email = $this->database->real_escape_string($email);
  }

  function getPassword()
  {
    return $this->password;
  }

  function setPassword($password)
  {
    $this->password = password_hash($this->database->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
  }

  function getRole()
  {
    return $this->role;
  }

  function setRole($role)
  {
    $this->role = $this->database->real_escape_string($role);
  }

  function getImage()
  {
    return $this->image;
  }

  function setImage($image)
  {
    $this->image = $this->database->real_escape_string($image);
  }

  public function save()
  {
    $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen) VALUES "
      . "(?,?,?,?, 'user', null);";
    try {
      $stmt = $this->database->prepare($sql);
      $name = $this->getName();
      $surnames = $this->getSurnames();
      $email = $this->getEmail();
      $password = $this->getPassword();
      $stmt->bind_param("ssss", $name, $surnames, $email, $password);
      $stmt->execute();
      $stmt->close();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
