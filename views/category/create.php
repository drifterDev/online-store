<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<div class="register-user">
  <h1>Crea una nueva categoría</h1>
  <?php

  use Helpers\Utils; ?>
  <form action="../../category/save" method="POST">
    <?php Utils::showError("create-category") ?>
    <label for="name">Nombre</label>
    <?php Utils::showError("create-category-name") ?>
    <input type="text" name="name" id="name" required>
    <input type="submit" value="Crear">
  </form>
  <?php Utils::deleteSession("errors") ?>
  <?php Utils::deleteSession("create-category") ?>

</div>