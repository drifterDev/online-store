<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

use Models\Product;
use Helpers\Utils;

class ProductController
{
  public function index()
  {
    require_once '../views/product/index.php';
  }

  public function management()
  {
    Utils::isAdmin();
    $product = new Product();
    $products = $product->getAll();
    require_once '../views/product/management.php';
  }

  public function create()
  {
    Utils::isAdmin();
    require_once '../views/product/create.php';
  }

  public function save()
  {
    Utils::isAdmin();
    if (isset($_POST)) {
      $name = $_POST["name"] ?? false;
      $description = $_POST["description"] ?? false;
      $price = $_POST["price"] ?? false;
      $stock = $_POST["stock"] ?? false;
      $category_id = $_POST["category"] ?? false;
      $errors = 0;
      if (empty($name)) {
        $_SESSION["errors"]["create-product-name"] = "Nombre ingresado no es valido.";
        $errors++;
      }
      if (empty($description)) {
        $_SESSION["errors"]["create-product-description"] = "Descripción ingresada no es valida.";
        $errors++;
      }
      if (empty($price) && !is_float($price)) {
        $_SESSION["errors"]["create-product-price"] = "Precio ingresado no es valido.";
        $errors++;
      }
      if (empty($stock) || !is_numeric($stock) || $stock < -1) {
        if ($stock != 0) {
          $_SESSION["errors"]["create-product-stock"] = "Stock ingresado no es valido.";
          $errors++;
        }
      }
      if (empty($category_id)) {
        $_SESSION["errors"]["create-product-category-id"] = "Categoría ingresada no es valida.";
        $errors++;
      }

      // Imagen
      $file = $_FILES["image"] ?? false;
      $filename = $file["name"];
      $mimetype = $file["type"];

      if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
        if (!is_dir("img/uploads")) {
          mkdir("img/uploads", 0777);
        }
        move_uploaded_file($file["tmp_name"], "img/uploads/" . $filename);
      } else {
        $_SESSION["errors"]["create-product-image"] = "Imagen ingresada no es valida.";
        $errors++;
      }

      if ($errors == 0) {
        $producto = new Product();
        $producto->setName($name);
        $producto->setDescription($description);
        $producto->setPrice($price);
        $producto->setStock($stock);
        $producto->setCategoryId($category_id);
        $producto->setImage($filename);
        $save = $producto->save();
        if ($save) {
          $_SESSION["create-product"] = "complete";
          header("Location: ../../product/management");
          exit();
        } else {
          $_SESSION["create-product"] = "failed";
        }
      }
    } else {
      $_SESSION["create-product"] = "failed";
    }
    header("Location: ../../product/create");
    exit();
  }

  public function edit()
  {
    Utils::isAdmin();
    var_dump($_GET);
  }

  public function delete()
  {
    Utils::isAdmin();
    if (isset($_GET["id"])) {
      $product = new Product();
      $product->setId($_GET["id"]);
      $delete = $product->delete();
      if ($delete) {
        $_SESSION["delete-product"] = "complete";
      } else {
        $_SESSION["delete-product"] = "failed";
      }
    }
    header("Location: ../../product/management");
    exit();
  }
}
