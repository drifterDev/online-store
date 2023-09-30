<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<div class="register-user">
  <h1>Crea nuevos productos</h1>
  <?php

  use Helpers\Utils; ?>
  <form action="../../product/save" method="POST" enctype="multipart/form-data">
    <?php if (isset($_SESSION["create-product"])) : ?>
      <?php if ($_SESSION["create-product"] != "complete") : ?>
        <div class="alerta alerta-error">Registro fallido</div>
      <?php endif; ?>
    <?php endif; ?>
    <label for="name">Nombre</label>
    <?php Utils::showError("create-product-name") ?>
    <input type="text" name="name" id="name" required>

    <label for="description">Descripción</label>
    <?php Utils::showError("create-product-description") ?>
    <textarea class="h-32" name="description" id="description" cols="30" rows="10"></textarea>

    <label for="price">Precio</label>
    <?php Utils::showError("create-product-price") ?>
    <input type="number" step="0.001" name="price" id="price" required>

    <label for="stock">Stock</label>
    <?php Utils::showError("create-product-stock") ?>
    <input type="number" name="stock" id="stock" required>

    <label for="category">Categoría</label>
    <?php Utils::showError("create-product-category-id") ?>
    <select name="category" id="category">
      <?php $categories = Utils::showCategories() ?>
      <?php while ($category = $categories->fetch_object()) : ?>
        <option value="<?= $category->id ?>"><?= $category->nombre ?></option>
      <?php endwhile; ?>
    </select>

    <label for="image" id="labelImage" class="mb-5">Seleccionar imagen</label>
    <?php Utils::showError("create-product-image") ?>
    <input type="file" onchange="updateLabel()" name="image" id="image" class="hidden">
    <script>
      function updateLabel() {
        var input = document.getElementById('image');
        var label = document.getElementById('labelImage');
        label.textContent = input.files.length > 0 ? input.files[0].name : 'Seleccionar imagen';
      }
    </script>

    <input class="mt-5" type="submit" value="Crear">
  </form>
  <?php Utils::deleteSession("errors") ?>
  <?php Utils::deleteSession("create-product") ?>

</div>