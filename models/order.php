<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Models;

use Config\Database;

class Order
{
  private $id;
  private $user_id;
  private $department;
  private $city;
  private $direction;
  private $price;
  private $state;
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

  function getUserId()
  {
    return $this->user_id;
  }

  function setUserId($user_id)
  {
    $this->user_id = $user_id;
  }

  function getDepartment()
  {
    return $this->department;
  }

  function setDepartment($department)
  {
    $this->department = $this->database->real_escape_string($department);
  }

  function getCity()
  {
    return $this->city;
  }

  function setCity($city)
  {
    $this->city = $this->database->real_escape_string($city);
  }

  function getDirection()
  {
    return $this->direction;
  }

  function setDirection($direction)
  {
    $this->direction = $this->database->real_escape_string($direction);
  }

  function getPrice()
  {
    return $this->price;
  }

  function setPrice($price)
  {
    $this->price = $price;
  }

  function getState()
  {
    return $this->state;
  }

  function setState($state)
  {
    $this->state = $this->database->real_escape_string($state);
  }

  public function getAll()
  {
    $sql = "SELECT * FROM pedidos ORDER BY id ASC";
    $result = $this->database->query($sql);
    return $result;
  }

  public function getOne()
  {
    try {
      $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()}";
      $result = $this->database->query($sql);
      return $result->fetch_object();
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function save()
  {
    $sql = "INSERT INTO pedidos (usuario_id, departamento, ciudad, direccion, coste, estado, fecha, hora) VALUES " .
      "(?, ?, ?, ?, ?, 'confirmado', CURDATE(), CURTIME());";
    try {
      $stmt = $this->database->prepare($sql);
      $user_id = $this->getUserId();
      $department = $this->getDepartment();
      $city = $this->getCity();
      $direction = $this->getDirection();
      $price = $this->getPrice();
      $stmt->bind_param("isssd", $user_id, $department, $city, $direction, $price);
      $stmt->execute();
      $stmt->close();
      $this->setId($this->database->insert_id);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
