<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

use Models\Category;

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
    require_once '../views/category/create.php';
  }
}
