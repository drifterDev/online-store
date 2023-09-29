<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<?php

use Helpers\Utils; ?>
<div class="tabla">
  <h1>Gestionar categorias</h1>
  <?php if (isset($_SESSION["create-category"])) : ?>
    <?php if ($_SESSION["create-category"] == "complete") : ?>
      <div class="alerta alerta-exito mb-5">Registro exitoso</div>
    <?php endif; ?>
  <?php endif; ?>
  <?php if (isset($_SESSION["edit-category"])) : ?>
    <?php if ($_SESSION["edit-category"] == "complete") : ?>
      <div class="alerta alerta-exito mb-5">Actualización exitosa</div>
    <?php endif; ?>
  <?php endif; ?>
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($category = $categories->fetch_object()) : ?>
        <tr>
          <td>
            <?= $category->id ?>
          </td>
          <td>
            <?= $category->nombre ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <div class="botones">
    <a href="../../category/edit" class="md:mr-8 boton w-52 text-center">Editar categoría</a>
    <a href="../../category/create" class="boton w-52 text-center">Crear categoría</a>
  </div>
  <?php Utils::deleteSession("create-product") ?>
  <?php unset($_SESSION["edit-category"]) ?>
  <?php unset($_SESSION["create-category"]) ?>

</div>