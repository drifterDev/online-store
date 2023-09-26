<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

use Models\User;

class UserController
{
  public function index()
  {
    echo "Hola desde el controlador de usuarios";
  }

  public function register()
  {
    require_once '../views/user/register.php';
  }

  public function save()
  {
    if (isset($_POST)) {
      $name = $_POST["name"] ?? false;
      $surnames = $_POST["surnames"] ?? false;
      $email = trim($_POST["email"]) ?? false;
      $password = $_POST["password"] ?? false;
      $errors = array();
      if (empty($name) || is_numeric($name) || preg_match("/[0-9]/", $name)) {
        $errors["register-name"] = "Nombre ingresado no es valido.";
      }
      if (empty($surnames) || is_numeric($surnames) || preg_match("/[0-9]/", $surnames)) {
        $errors["register-surnames"] = "Apellidos ingresados no son validos.";
      }
      if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["register-email"] = "Correo ingresado no es valido.";
      }
      if (empty($password)) {
        $errors["register-password"] = "Contraseña ingresada no es valida";
      }

      if (count($errors) == 0) {
        $user = new User();
        $user->setName($name);
        $user->setSurnames($surnames);
        $user->setEmail($email);
        $user->setPassword($password);
        $save = $user->save();
        if ($save) {
          $_SESSION['register'] = "complete";
        } else {
          $_SESSION['register'] = "failed";
        }
      }
      $_SESSION["errors"] = $errors;
    } else {
      $_SESSION['register'] = "failed";
    }
    header("Location: ../../user/register");
    exit();
  }
}
