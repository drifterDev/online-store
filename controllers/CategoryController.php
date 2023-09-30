<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

use Helpers\Utils;
use Models\Category;
use Models\Product;

class CategoryController
{
  public function index()
  {
    $category = new Category();
    $categories = $category->getAll();
    require_once '../views/category/index.php';
  }

  public function create()
  {
    Utils::isAdmin();
    require_once '../views/category/create.php';
  }

  public function edit()
  {
    Utils::isAdmin();
    require_once '../views/category/edit.php';
  }

  public function save()
  {
    Utils::isAdmin();
    if (isset($_POST)) {
      $name = $_POST["name"] ?? false;
      $errors = 0;
      if (empty($name) || preg_match("/[0-9]/", $name)) {
        $_SESSION["errors"]["create-category-name"] = "Nombre ingresado no es valido.";
        $errors++;
      }

      if ($errors == 0) {
        $category = new Category();
        $category->setName($name);
        $result = $category->save();
        if ($result) {
          $_SESSION["create-category"] = "complete";
          header("Location: ../../category/index");
          exit();
        } else {
          $_SESSION["create-category"] = "Failed";
        }
      }
    } else {
      $_SESSION["create-category"] = "Failed";
    }
    header("Location: ../../category/create");
    exit();
  }

  public function editCategory()
  {
    Utils::isAdmin();
    if (isset($_POST)) {
      $name = $_POST["name"] ?? false;
      $id = $_POST["category"] ?? false;
      $errors = 0;
      if (empty($name)) {
        $_SESSION["errors"]["edit-category-name"] = "Nombre ingresado no es valido.";
        $errors++;
      }
      if (empty($id)) {
        $_SESSION["errors"]["edit-category-id"] = "Categoría ingresada no es valida.";
        $errors++;
      }

      if ($errors == 0) {
        $category = new Category();
        $category->setName($name);
        $category->setId($id);
        $result = $category->edit();
        if ($result) {
          $_SESSION["edit-category"] = "complete";
          header("Location: ../../category/index");
          exit();
        } else {
          $_SESSION["edit-category"] = "failed";
        }
      }
    } else {
      $_SESSION["edit-category"] = "failed";
    }
    header("Location: ../../category/edit");
    exit();
  }

  public function show()
  {
    if (isset($_GET["id"])) {
      $category = new Category();
      $category->setId($_GET["id"]);
      $category = $category->getOne();
      if ($category) {
        $product = new Product();
        $product->setCategoryId($category->id);
        $products = $product->getAllCategory();
        require_once '../views/category/show.php';
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
