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

  public function getAll()
  {
    $sql = "SELECT * FROM productos ORDER BY id ASC";
    $products = $this->database->query($sql);
    return $products;
  }
}
