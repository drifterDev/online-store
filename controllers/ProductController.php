<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

use Models\Product;
use Helpers\Utils;
use Models\Category;

class ProductController
{
  public function index()
  {
    $products = new Product();
    $products = $products->getRandom();
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
      $filename = $file["name"] ?? false;
      $mimetype = $file["type"] ?? false;

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
    if (isset($_GET["id"])) {
      $product = new Product();
      $product->setId($_GET["id"]);
      $product = $product->getOne();
      if ($product) {
        require_once '../views/product/edit.php';
      } else {
        header("Location: ../../product/management");
        exit();
      }
    } else {
      header("Location: ../../product/management");
      exit();
    }
  }

  public function update()
  {
    Utils::isAdmin();
    if (isset($_GET["id"]) && isset($_POST)) {
      $name = $_POST["name"] ?? false;
      $description = $_POST["description"] ?? false;
      $price = $_POST["price"] ?? false;
      $stock = $_POST["stock"] ?? false;
      $category_id = $_POST["category"] ?? false;
      $id = $_GET["id"];
      $errors = 0;
      if (empty($name)) {
        $_SESSION["errors"]["edit-product-name"] = "Nombre ingresado no es valido.";
        $errors++;
      }
      if (empty($description)) {
        $_SESSION["errors"]["edit-product-description"] = "Descripción ingresada no es valida.";
        $errors++;
      }
      if (empty($price) && !is_float($price)) {
        $_SESSION["errors"]["edit-product-price"] = "Precio ingresado no es valido.";
        $errors++;
      }
      if (empty($stock) || !is_numeric($stock) || $stock < -1) {
        if ($stock != 0) {
          $_SESSION["errors"]["edit-product-stock"] = "Stock ingresado no es valido.";
          $errors++;
        }
      }
      if (empty($category_id)) {
        $_SESSION["errors"]["edit-product-category-id"] = "Categoría ingresada no es valida.";
        $errors++;
      }

      // Imagen
      $file = $_FILES["image"] ?? false;
      $filename = $file["name"] ?? false;
      $mimetype = $file["type"] ?? false;

      if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
        if (!is_dir("img/uploads")) {
          mkdir("img/uploads", 0777);
        }
        move_uploaded_file($file["tmp_name"], "img/uploads/" . $filename);
      } elseif (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        $_SESSION["errors"]["edit-product-image"] = "Imagen ingresada no es valida.";
        $errors++;
      }

      if ($errors == 0) {
        $tmp = new Product();
        $tmp->setId($id);
        $productOld = $tmp->getOne();
        if ($productOld) {
          $product = new Product();
          $product->setId($id);
          $product->setName(($name != false) ? $name : $productOld->nombre);
          $product->setDescription(($description != false) ? $description : $productOld->descripcion);
          $product->setPrice(($price != false) ? $price : $productOld->precio);
          $product->setStock(($stock != false) ? $stock : $productOld->stock);
          $product->setCategoryId(($category_id != false) ? $category_id : $productOld->categoria_id);
          $product->setImage(($filename != false) ? $filename : $productOld->imagen);
          $update = $product->update();
          if ($update) {
            $_SESSION["edit-product"] = "complete";
            header("Location: ../../product/management");
            exit();
          } else {
            $_SESSION["edit-product"] = "failed";
          }
        } else {
          $_SESSION["edit-product"] = "failed";
        }
      }
    } else {
      header("Location: ../../product/management");
      exit();
    }
    header("Location: ../../product/edit&id=" . $id);
    exit();
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

  public function show()
  {
    if (isset($_GET["id"])) {
      $product = new Product();
      $product->setId($_GET["id"]);
      $product = $product->getOne();
      if ($product) {
        $category = new Category();
        $category->setId($product->categoria_id);
        $category = $category->getOne();
        require_once '../views/product/show.php';
      } else {
        header("Location: ../../product/index");
        exit();
      }
    } else {
      header("Location: ../../product/index");
      exit();
    }
  }
}
