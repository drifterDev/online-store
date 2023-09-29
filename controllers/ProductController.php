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
}
