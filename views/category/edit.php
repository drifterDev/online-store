<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<div class="register-user">
  <h1>Edita una categoría</h1>
  <?php

  use Helpers\Utils; ?>
  <form action="../../category/editCategory" method="POST">
    <?php if (isset($_SESSION["edit-category"])) : ?>
      <?php if ($_SESSION["edit-category"] != "complete") : ?>
        <div class="alerta alerta-error">Actualización fallida</div>
      <?php endif; ?>
    <?php endif; ?>
    <label for="category">Categoría a editar</label>
    <?php Utils::showError("edit-category-id") ?>
    <select name="category" id="category">
      <?php $categories = Utils::showCategories() ?>
      <?php while ($category = $categories->fetch_object()) : ?>
        <option value="<?= $category->id ?>"><?= $category->nombre ?></option>
      <?php endwhile; ?>
    </select>
    <label for="name">Nuevo nombre</label>
    <?php Utils::showError("edit-category-name") ?>
    <input type="text" name="name" id="name" required>
    <input type="submit" value="Editar">
  </form>
  <?php Utils::deleteSession("errors") ?>
  <?php Utils::deleteSession("edit-category") ?>
  <?php unset($_SESSION["edit-category"]) ?>
</div>