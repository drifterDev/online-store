<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

use Models\Order;
use Helpers\Utils;
use Models\Order_has_product;
use Models\Product;
use Models\User;

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
    if (!isset($_SESSION["cart"])) {
      $_SESSION["order"] = "No hay productos en el carrito";
      header("Location: ../../order/do");
      exit();
    }

    $cart = $_SESSION["cart"];
    $pasa = false;
    foreach ($cart as  $index => $product) {
      $product_id = $product["product"]->id;
      $units = $product["units"];

      $tmp = new Product();
      $tmp->setId($product_id);
      $product = $tmp->getOne();
      if ($units > $product->stock) {
        $_SESSION["order"] = "No hay suficiente stock";
        header("Location: ../../order/do");
        exit();
      }
      $pasa = true;
    }

    if (!$pasa) {
      $_SESSION["order"] = "No hay productos en el carrito";
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

    if (!$result) {
      $_SESSION["order"] = "Pedido fallido";
      header("Location: ../../order/do");
      exit();
    }

    $order_id = $order->getId();
    foreach ($cart as  $index => $product) {
      $product_id = $product["product"]->id;
      $units = $product["units"];
      $actual = new Order_has_product();
      $actual->setOrderId($order_id);
      $actual->setProductId($product_id);

      $tmp = new Product();
      $tmp->setId($product_id);
      $product = $tmp->getOne();
      $tmp->setName($product->nombre);
      $tmp->setDescription($product->descripcion);
      $tmp->setPrice($product->precio);
      $stock = $product->stock - $units;
      $tmp->setStock($stock);
      $tmp->setCategoryId($product->categoria_id);
      $tmp->setImage($product->imagen);
      $result = $tmp->update();

      $actual->setUnits($units);
      $result = $actual->save();
    }
    header("Location: ../../order/confirm");
    exit();
  }

  public function confirm()
  {
    Utils::isIdentity();
    $order = new Order();
    $order->setUserId($_SESSION["user"]["id"]);;
    $order = $order->getOneByUserId();
    $temporal = new Order();
    $temporal->setId($order->id);
    $products = $temporal->getProducts();
    if (!is_object($order) || $order == false) {
      header("Location: ../../");
      exit();
    }
    require_once "../views/order/confirm.php";
  }

  public function myOrders()
  {
    Utils::isIdentity();
    $order = new Order();
    $order->setUserId($_SESSION["user"]["id"]);
    $orders = $order->getAllByUserId();
    require_once "../views/order/myOrders.php";
  }

  public function show()
  {
    Utils::isIdentity();
    if (!isset($_GET["id"])) {
      header("Location: ../../");
      exit();
    }
    $order = new Order();
    $order->setId($_GET["id"]);
    $products = $order->getProducts();
    $order = $order->getOne();
    $user = new User();
    $user->setId($order->usuario_id);
    $user = $user->getOne();
    // var_dump($user);
    if (($_SESSION["user"]["id"] != $order->usuario_id && !isset($_SESSION["admin"])) || !is_object($order) || $order == false || $user == false) {
      header("Location: ../../");
      exit();
    }
    require_once "../views/order/show.php";
  }

  public function management()
  {
    Utils::isAdmin();
    $order = new Order();
    $orders = $order->getAll();
    require_once "../views/order/management.php";
  }

  public function state()
  {
    Utils::isAdmin();
    if (!isset($_POST)) {
      header("Location: ../../");
      exit();
    }
    $order_id = $_POST["order_id"] ?? false;
    $state = $_POST["state"] ?? false;
    if (!$order_id || !$state) {
      header("Location: ../../");
      exit();
    }
    $order = new Order();
    $order->setId($order_id);
    $order->setState($state);
    $result = $order->changeState();
    if (!$result) {
      header("Location: ../../");
      exit();
    } else {
      header("Location: ../../order/show&id=$order_id");
      exit();
    }
  }
}
