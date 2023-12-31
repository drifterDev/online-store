<?php
// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

use Controllers\ErrorController;
use Config\Database;

session_start();
require_once '../vendor/autoload.php';
require_once '../config/parameters.php';
require_once '../helpers/Utils.php';
require_once '../config/Database.php';
require_once '../views/layout/head.php';
require_once '../views/layout/header.php';
require_once '../views/layout/aside.php';

$db = Database::getInstance()->get_database_instance();

function error_404()
{
  $error = new ErrorController();
  $error->index();
}

if (isset($_GET["controller"]) && isset($_GET["action"])) {
  $controller = "Controllers\\" . ucfirst($_GET["controller"]) . "Controller";
  if (!class_exists($controller)) {
    error_404();
  } else {
    $controller = new $controller();
    if (method_exists($controller, $_GET["action"])) {
      $action = $_GET["action"];
      $controller->$action();
    } else {
      error_404();
    }
  }
} else {
  $controller = CONTROLLER_DEFAULT;
  $controller = new $controller();
  $action = ACTION_DEFAULT;
  $controller->$action();
}

require_once '../views/layout/footer.php';
?>