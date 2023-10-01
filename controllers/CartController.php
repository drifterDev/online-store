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
    if (!isset($_SESSION["cart"])) {
      $_SESSION["cart"] = array();
    }
    require_once '../views/cart/index.php';
  }

  public function add()
  {
    if (isset($_GET["id"]) && isset($_SESSION["user"])) {
      $product_id = $_GET["id"];
      $product = new Product();
      $product->setId($product_id);
      $product = $product->getOne();
      $pass = false;
      if ($product && !isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
        array_push($_SESSION["cart"], array(
          "id_product" => $product->id,
          "price" => $product->precio,
          "units" => 1,
          "product" => $product
        ));
        $pass = true;
      } elseif ($product) {
        foreach ($_SESSION["cart"] as $index => $value) {
          if ($value["id_product"] == $product->id) {
            $_SESSION["cart"][$index]["units"]++;
            $pass = true;
          }
        }
        if (!$pass) {
          array_push($_SESSION["cart"], array(
            "id_product" => $product->id,
            "price" => $product->precio,
            "units" => 1,
            "product" => $product
          ));
          $pass = true;
        }
      }
    }
    if ($pass) {
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
