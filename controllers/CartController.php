<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

use Models\Product;
use Helpers\Utils;

class CartController
{
  public function index()
  {
    Utils::isIdentity();
    if (!isset($_SESSION["cart"])) {
      $_SESSION["cart"] = array();
    }
    require_once '../views/cart/index.php';
  }

  public function add()
  {
    Utils::isIdentity();
    if (isset($_GET["id"])) {
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
    Utils::isIdentity();
    if (isset($_GET["id"]) && isset($_SESSION["cart"])) {
      $product_id = $_GET["id"];
      foreach ($_SESSION["cart"] as $index => $value) {
        if ($value["id_product"] == $product_id) {
          unset($_SESSION["cart"][$index]);
        }
      }
    }
    header("Location: ../../cart/index");
    exit();
  }

  public function delete()
  {
    unset($_SESSION["cart"]);
    header("Location: ../../cart/index");
    exit();
  }

  public function up()
  {
    Utils::isIdentity();
    if (isset($_GET["id"])) {
      $product_id = $_GET["id"];
      foreach ($_SESSION["cart"] as $index => $value) {
        if ($value["id_product"] == $product_id) {
          $_SESSION["cart"][$index]["units"]++;
        }
      }
    }
    header("Location: ../../cart/index");
    exit();
  }

  public function down()
  {
    Utils::isIdentity();
    if (isset($_GET["id"])) {
      $product_id = $_GET["id"];
      foreach ($_SESSION["cart"] as $index => $value) {
        if ($value["id_product"] == $product_id) {
          if ($_SESSION["cart"][$index]["units"] == 1) {
            unset($_SESSION["cart"][$index]);
          } else {
            $_SESSION["cart"][$index]["units"]--;
          }
        }
      }
    }
    header("Location: ../../cart/index");
    exit();
  }
}
