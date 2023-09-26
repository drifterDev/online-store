<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Helpers;

class Utils
{
  public static function deleteSession($value)
  {
    if (isset($_SESSION[$value])) {
      unset($_SESSION[$value]);
    }
  }

  public static function showError($error)
  {
    if (isset($_SESSION) && isset($_SESSION["errors"][$error])) {
      echo "<div class='alerta alerta-error'>" . $_SESSION["errors"][$error] . "</div>";
    }
  }
}
