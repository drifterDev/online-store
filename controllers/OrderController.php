<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

use Models\Order;
use Helpers\Utils;
use Models\Order_has_product;

class OrderController
{
  public function do()
  {
    Utils::isIdentity();
    require_once "../views/order/do.php";
  }

  public function add()
  {
    Utils::isIdentity();
    $count = Utils::statsCart()["count"];
    if (!isset($_POST)) {
      header("Location: ../../order/do");
      exit();
    }
    if ($count == 0) {
      $_SESSION["order"] = "No hay productos en el carrito";
      header("Location: ../../order/do");
      exit();
    }
    $deparment = $_POST["deparment"] ?? false;
    $city = $_POST["city"] ?? false;
    $direction = $_POST["direction"] ?? false;
    $errors = 0;
    if (empty($deparment) || preg_match("/[0-9]/", $deparment)) {
      $_SESSION["errors"]["order-deparment"] = "Departamento ingresado no es valido.";
      $errors++;
    }

    if (empty($city) || preg_match("/[0-9]/", $city)) {
      $_SESSION["errors"]["order-city"] = "Ciudad ingresada no es valida.";
      $errors++;
    }

    if (empty($direction)) {
      $_SESSION["errors"]["order-direction"] = "Dirección ingresada no es valida.";
      $errors++;
    }

    if ($errors > 0) {
      header("Location: ../../order/do");
      exit();
    }

    $user_id = $_SESSION["user"]["id"];
    $price = Utils::statsCart()["total"];
    $state = "confirm";
    $order = new Order();
    $order->setUserId($user_id);
    $order->setDepartment($deparment);
    $order->setCity($city);
    $order->setDirection($direction);
    $order->setPrice($price);
    $order->setState($state);
    $result = $order->save();

    if (!$result || !isset($_SESSION["cart"])) {
      $_SESSION["order"] = "Pedido fallido";
      header("Location: ../../order/do");
      exit();
    }

    $cart = $_SESSION["cart"];
    $order_id = $order->getId();
    foreach ($cart as  $index => $product) {
      $product_id = $product["product"]->id;
      $units = $product["units"];
      $actual = new Order_has_product();
      $actual->setOrderId($order_id);
      $actual->setProductId($product_id);
      $actual->setUnits($units);
      $result = $actual->save();
    }
    header("Location ../../order/confirm");
    exit();
  }

  public function confirm()
  {
    Utils::isIdentity();
    require_once "../views/order/confirm.php";
  }
}
