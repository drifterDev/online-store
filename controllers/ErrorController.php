<?php

// Autor: Mateo Álvarez Murillo
// Fecha de creación: 2023

// Este código se proporciona bajo la Licencia MIT.
// Para más información, consulta el archivo LICENSE en la raíz del repositorio.

namespace Controllers;

class ErrorController
{
  public function index()
  {
    echo "<div class='error'>";
    echo "<p>Error 404</p>";
    echo "<span>La página que buscas no existe</span>";
    echo "</div>";
  }

}
