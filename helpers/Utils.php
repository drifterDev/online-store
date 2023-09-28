<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Helpers;

use Models\Category;

class Utils
{
  public static function deleteSession($value)
  {
    unset($_SESSION[$value]);
  }

  public static function showError($error)
  {
    if (isset($_SESSION["errors"][$error])) {
      echo "<div class='alerta alerta-error'>" . $_SESSION["errors"][$error] . "</div>";
    }
  }

  public static function isAdmin()
  {
    if (isset($_SESSION["admin"])) {
      return true;
    }
    header("Location: ../../product/index");
    exit();
  }

  public static function showCategories()
  {
    $category = new Category();
    $categories = $category->getAll();
    return $categories;
  }
}
