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
      $email = trim($_POST["email2"]) ?? false;
      $password = $_POST["password2"] ?? false;
      $errors = 0;
      if (empty($name) || preg_match("/[0-9]/", $name)) {
        $_SESSION["errors"]["register-name"] = "Nombre ingresado no es valido.";
        $errors++;
      }
      if (empty($surnames) || preg_match("/[0-9]/", $surnames)) {
        $_SESSION["errors"]["register-surnames"] = "Apellidos ingresados no son validos.";
        $errors++;
      }
      if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["errors"]["register-email"] = "Correo ingresado no es valido.";
        $errors++;
      }
      if (empty($password)) {
        $_SESSION["errors"]["register-password"] = "Contraseña ingresada no es valida";
        $errors++;
      }

      if ($errors == 0) {
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
    } else {
      $_SESSION['register'] = "failed";
    }
    header("Location: ../../user/register");
    exit();
  }

  public function login()
  {
    if (isset($_POST)) {
      $user = new User();
      $user->setEmail($_POST["email"]);
      $user->setPassword($_POST["password"]);
      $result = $user->login();
      if ($result != false) {
        $_SESSION["user"] = $result;
        if ($result["rol"] == "admin") {
          $_SESSION["admin"] = true;
        }
      } else {
        $_SESSION["errors"]["error-login"] = "Identificación fallida";
      }
    }
    header("Location: ../../");
    exit();
  }

  public function logout()
  {
    if (isset($_SESSION["user"])) {
      unset($_SESSION["user"]);
    }
    if (isset($_SESSION["admin"])) {
      unset($_SESSION["admin"]);
    }
    header("Location: ../../");
    exit();
  }
}
