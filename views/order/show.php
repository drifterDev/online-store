<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<?php

use Helpers\Utils; ?>
<div class="tabla">
  <h1>Pedido #<?= $order->id ?></h1>
  <h3 class="text-lg">Datos del usuario</h3>
  <div class="mb-5 flex flex-col items-center">
    <p>Nombre: <?= $user["nombre"] ?></p>
    <p>Apellidos: <?= $user["apellidos"] ?></p>
    <p>Email: <?= $user["email"] ?></p>
  </div>
  <?php if (isset($_SESSION["admin"])) : ?>
    <div class="state mb-2">
      <form action="../../order/state" method="POST">
        <input type="hidden" name="order_id" value="<?= $order->id ?>">
        <label for="state">Cambiar estado</label>
        <?php $states = array("confirm", "preparation", "ready", "sended") ?>
        <select name="state" id="state">
          <?php foreach ($states as $state) : ?>
            <?php if ($state == $order->estado) : ?>
              <option selected value="<?= $state ?>"><?= Utils::getState($state) ?></option>
            <?php else : ?>
              <option value="<?= $state ?>"><?= Utils::getState($state) ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
        <input type="submit" value="Cambiar estado">
      </form>
    </div>
  <?php endif; ?>

  <table>
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Producto</th>
        <th>Precio (COP)</th>
        <th>Cantidad</th>
        <th>Precio total</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($product = $products->fetch_object()) : ?>
        <tr>
          <td>
            <img src="../img/uploads/<?= $product->imagen ?>" alt="<?= $product->nombre ?>" class="w-32">
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
            <?= $product->unidades ?>
          </td>
          <td>
            <?= number_format($product->precio * $product->unidades, 0, ',', '.') ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <div class="my-5 flex flex-col items-center text-lg">
    <span>Total a pagar: <?= number_format($order->coste, 0, ',', '.')  ?></span>
    <span>Dirección de entrega: <?= $order->direccion ?>, <?= $order->ciudad ?>, <?= $order->departamento ?></span>
  </div>
</div>