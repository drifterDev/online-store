<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<?php

use Helpers\Utils; ?>
<div class="tabla">
  <h1>Gestionar productos</h1>
  <?php if (isset($_SESSION["create-product"])) : ?>
    <?php if ($_SESSION["create-product"] == "complete") : ?>
      <div class="alerta alerta-exito mb-5">Registro exitoso</div>
    <?php endif; ?>
  <?php endif; ?>
  <?php if (isset($_SESSION["edit-product"])) : ?>
    <div class="alerta alerta-exito mb-5">Actualización exitosa</div>
  <?php endif; ?>
  <?php if (isset($_SESSION["delete-product"])) : ?>
    <?php if ($_SESSION["delete-product"] == "complete") : ?>
      <div class="alerta alerta-exito mb-5">Eliminación exitosa</div>
    <?php elseif ($_SESSION["delete-product"] == "failed") : ?>
      <div class="alerta alerta-error mb-5">Eliminación fallida</div>
    <?php endif; ?>
  <?php endif; ?>
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($product = $products->fetch_object()) : ?>
        <tr>
          <td class="">
            <?= $product->id ?>
          </td>
          <td>
            <a href="../../product/show&id=<?= $product->id ?>">
              <?= $product->nombre ?>
            </a>
          </td>
          <td>
            <?= number_format($product->precio, 0, ',', '.') ?>
          </td>
          <td>
            <?= $product->stock ?>
          </td>
          <td class="flex">
            <a href="../../product/edit&id=<?= $product->id ?>" class="boton2 text-center mr-5">Editar</a>
            <a href="../../product/delete&id=<?= $product->id ?>" class="boton2 text-center">Eliminar</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <div class="botones">
    <a href="../../product/create" class="boton w-52 text-center">Crear producto</a>
  </div>
  <?php Utils::deleteSession("create-product") ?>
  <?php Utils::deleteSession("edit-product") ?>
  <?php Utils::deleteSession("delete-product") ?>
</div>