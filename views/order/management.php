<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<div class="tabla">
  <?php

  use Helpers\Utils;
  ?>
  <h1>Gestionar pedidos</h1>
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Precio total</th>
        <th>Fecha</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($order = $orders->fetch_object()) : ?>
        <tr>
          <td>
            <a href="../../order/show&id=<?= $order->id ?>">
              Pedido #<?= $order->id ?>
            </a>
          </td>
          <td>
            <?= number_format($order->coste, 0, ',', '.') ?> COP
          </td>
          <td>
            <?= $order->fecha ?>
          </td>
          <td>
            <?= Utils::getState($order->estado) ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>