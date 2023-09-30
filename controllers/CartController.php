<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

use Models\Product;

class CartController
{
  public function index()
  {
    var_dump($_SESSION["cart"]);
  }

  public function add()
  {
    if (isset($_GET["id"]) && isset($_SESSION["user"])) {
      $product_id = $_GET["id"];
    } else {
      // header("Location: ../../");
      var_dump($_GET);
      exit();
    }
    $product = new Product();
    $product->setId($product_id);
    $product = $product->getOne();
    if ($product) {
      if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
      }
      array_push($_SESSION["cart"], array(
        "id_product" => $product->id,
        "price" => $product->precio,
        "units" => 1,
        "producto" => $product
      ));
      header("Location: ../../cart/index");
      exit();
    } else {
      header("Location: ../../");
      exit();
    }
  }

  public function remove()
  {
  }

  public function delete()
  {
    unset($_SESSION["cart"]);
  }
}
