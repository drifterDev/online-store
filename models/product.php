<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Models;

use Config\Database;

class Product
{
  private $id;
  private $category_id;
  private $name;
  private $description;
  private $price;
  private $stock;
  private $offer;
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

  function getCategoryId()
  {
    return $this->category_id;
  }

  function setCategoryId($category_id)
  {
    $this->category_id = $category_id;
  }

  function getName()
  {
    return $this->name;
  }

  function setName($name)
  {
    $this->name = $this->database->real_escape_string($name);
  }

  function getDescription()
  {
    return $this->description;
  }

  function setDescription($description)
  {
    $this->description = $this->database->real_escape_string($description);
  }

  function getPrice()
  {
    return $this->price;
  }

  function setPrice($price)
  {
    $this->price = $this->database->real_escape_string($price);
  }

  function getStock()
  {
    return $this->stock;
  }

  function setStock($stock)
  {
    $this->stock = $this->database->real_escape_string($stock);
  }

  function getOffer()
  {
    return $this->offer;
  }

  function setOffer($offer)
  {
    $this->offer = $this->database->real_escape_string($offer);
  }

  function getImage()
  {
    return $this->image;
  }

  function setImage($image)
  {
    $this->image = $this->database->real_escape_string($image);
  }

  public function getOne()
  {
    try {
      $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
      $product = $this->database->query($sql);
      return $product->fetch_object();
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getAll()
  {
    $sql = "SELECT * FROM productos ORDER BY id ASC";
    $products = $this->database->query($sql);
    return $products;
  }

  public function save()
  {
    $sql = "INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) " .
      "VALUES (?, ?, ?, ?, ?, null, CURDATE(),?);";
    try {
      $stmt = $this->database->prepare($sql);
      $name = $this->getName();
      $description = $this->getDescription();
      $price = $this->getPrice();
      $stock = $this->getStock();
      $category_id = $this->getCategoryId();
      $image = $this->getImage();
      $stmt->bind_param("issdis", $category_id, $name, $description, $price, $stock, $image);
      $stmt->execute();
      $stmt->close();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function delete()
  {
    $sql = "DELETE FROM productos WHERE id = ?;";
    try {
      $stmt = $this->database->prepare($sql);
      $stmt->bind_param("i", $this->getId());
      $stmt->execute();
      $stmt->close();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function update()
  {
    $sql = "UPDATE productos SET categoria_id = ?, nombre = ?, descripcion = ?, precio = ?, stock = ?, imagen = ? WHERE id = ?;";
    try {
      $stmt = $this->database->prepare($sql);
      $name = $this->getName();
      $description = $this->getDescription();
      $price = $this->getPrice();
      $stock = $this->getStock();
      $category_id = $this->getCategoryId();
      $image = $this->getImage();
      $id = $this->getId();
      $stmt->bind_param("issdisi", $category_id, $name, $description, $price, $stock, $image, $id);
      $stmt->execute();
      $stmt->close();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
