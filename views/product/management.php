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
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($product = $products->fetch_object()) : ?>
        <tr>
          <td class="">
            <?= $product->id ?>
          </td>
          <td>
            <?= $product->nombre ?>
          </td>
          <td>
            <?= $product->precio ?>
          </td>
          <td>
            <?= $product->stock ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <div class="botones">
    <a href="../../product/edit" class="md:mr-8 boton w-52 text-center">Editar producto</a>
    <a href="../../product/create" class="boton w-52 text-center">Crear producto</a>
  </div>
  <?php Utils::deleteSession("create-product") ?>

</div>