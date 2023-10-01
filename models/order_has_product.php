<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Models;

use Config\Database;

class Order_has_product
{
  private $id;
  private $order_id;
  private $product_id;
  private $units;
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

  function getOrderId()
  {
    return $this->order_id;
  }

  function setOrderId($order_id)
  {
    $this->order_id = $order_id;
  }

  function getProductId()
  {
    return $this->product_id;
  }

  function setProductId($product_id)
  {
    $this->product_id = $product_id;
  }

  function getUnits()
  {
    return $this->units;
  }

  function setUnits($units)
  {
    $this->units = $units;
  }

  public function save()
  {
    $sql = "INSERT INTO pedidos_has_productos (pedido_id, producto_id, unidades) VALUES " .
      "(?,?,?);";
    try {
      $stmt = $this->database->prepare($sql);
      $order_id = $this->getOrderId();
      $product_id = $this->getProductId();
      $units = $this->getUnits();
      $stmt->bind_param("iii", $order_id, $product_id, $units);
      $stmt->execute();
      $stmt->close();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
