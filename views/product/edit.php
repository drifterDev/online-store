<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<div class="register-user">
  <h1>Edita el producto #<?= $product->id ?></h1>
  <?php

  use Helpers\Utils; ?>
  <form action="../../product/update&id=<?= $product->id ?>" method="POST" enctype="multipart/form-data">
    <?php if (isset($_SESSION["edit-product"])) : ?>
      <div class="alerta alerta-error">Actualización fallida</div>
    <?php endif; ?>
    <label for="name">Nuevo nombre</label>
    <?php Utils::showError("edit-product-name") ?>
    <input type="text" name="name" id="name" required value="<?= $product->nombre ?>">

    <label for="description">Nueva descripción</label>
    <?php Utils::showError("edit-product-description") ?>
    <textarea class="h-32" name="description" id="description" cols="30" rows="10"><?= $product->descripcion ?></textarea>

    <label for="price">Nuevo precio</label>
    <?php Utils::showError("edit-product-price") ?>
    <input type="number" step="0.001" name="price" id="price" value="<?= number_format($product->precio, 0, ',', '.') ?>" required>

    <label for="stock">Nuevo stock</label>
    <?php Utils::showError("edit-product-stock") ?>
    <input type="number" name="stock" id="stock" required value="<?= $product->stock ?>">

    <label for="category">Nueva categoría</label>
    <?php Utils::showError("edit-product-category-id") ?>
    <select name="category" id="category">
      <?php $categories = Utils::showCategories() ?>
      <?php while ($category = $categories->fetch_object()) : ?>
        <?php if ($category->id == $product->categoria_id) : ?>
          <option selected value="<?= $category->id ?>"><?= $category->nombre ?></option>
        <?php else : ?>
          <option value="<?= $category->id ?>"><?= $category->nombre ?></option>
        <?php endif; ?>
      <?php endwhile; ?>
    </select>

    <label for="actual">Imagen actual</label>
    <div class="w-80 my-5">
      <img name="actual" src="/img/uploads/<?= $product->imagen ?>" alt="Imagen del producto">
    </div>
    <label for="image" id="labelImage" class="mb-5">Seleccionar nueva imagen</label>
    <?php Utils::showError("edit-product-image") ?>
    <input type="file" onchange="updateLabel()" name="image" id="image" class="hidden">
    <script>
      function updateLabel() {
        var input = document.getElementById('image');
        var label = document.getElementById('labelImage');
        label.textContent = input.files.length > 0 ? input.files[0].name : 'Seleccionar imagen';
      }
    </script>

    <input class="mt-5" type="submit" value="Editar">
  </form>
  <?php Utils::deleteSession("errors") ?>
  <?php Utils::deleteSession("edit-product") ?>

</div>