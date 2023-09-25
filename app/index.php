<?php
// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace App;

require_once '../vendor/autoload.php';
require_once '../views/layout/head.php';
require_once '../views/layout/header.php';
require_once '../views/layout/aside.php';

// if (isset($_GET["controller"])) {
//   $controller = "Controllers\\" . $_GET["controller"] . "Controller";
// } else {
//   echo "No se ha encontrado la pagina";
// }

// if (isset($controller) && class_exists($controller)) {
//   $controller = new $controller();
//   if (isset($_GET["action"]) && method_exists($controller, $_GET["action"])) {
//     $action = $_GET["action"];
//     $controller->$action();
//   } else {
//     echo "No se ha encontrado la pagina";
//   }
// } else {
//   echo "No se ha encontrado la pagina";
// }
require_once '../views/layout/main.php';
require_once '../views/layout/footer.php';
