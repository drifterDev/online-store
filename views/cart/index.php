<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<?php

use Helpers\Utils;

$stats = Utils::statsCart();
$cart = $_SESSION["cart"] ?>
<div class="tabla">
  <h1>Carrito de compra</h1>
  <table>
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Producto</th>
        <th>Precio (COP)</th>
        <th>Cantidad</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cart as $index => $product) : ?>
        <tr>
          <td>
            <img src="../img/uploads/<?= $product["product"]->imagen ?>" alt="<?= $product["product"]->nombre ?>" class="w-32">
          </td>
          <td>
            <a href="../../product/show&id=<?= $product["product"]->id ?>">
              <?= $product["product"]->nombre ?>
            </a>
          </td>
          <td>
            <?= number_format($product["product"]->precio, 0, ',', '.') ?>
          </td>
          <td>
            <div class="text-xl w-32">
              <a href="../../cart/down&id=<?= $product["product"]->id ?>" class="boton-cart">-</a>
              <span class="mx-2">
                <?= $product["units"] ?>
              </span>
              <a href="../../cart/up&id=<?= $product["product"]->id ?>" class="boton-cart">+</a>
            </div>
          </td>
          <td>
            <a class="boton-cart" href="../../cart/remove&id=<?= $product["product"]->id ?>">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="w-full flex flex-col items-center">
    <h2 class="text-center">Total: <?= number_format($stats["total"], 0, ',', '.') ?> COP</h2>
    <div class="my-5 flex flex-col flex-wrap">
      <a href="../../order/do" class="boton w-64 text-center">Realizar pedido</a>
      <a href="../../cart/delete" class="boton w-64 text-center">Limpiar carrito</a>
    </div>
  </div>
</div>