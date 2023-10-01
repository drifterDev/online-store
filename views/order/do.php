<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<div class="order">
  <h1>Realizar el pedido</h1>

  <?php

  use Helpers\Utils; ?>
  <form action="../../order/add" method="POST">
    <a href="../../cart/index" class="boton w-52 text-center">Ver los productos</a>
    <h3 class="text-xl mb-5">Dirección para el envio</h3>
    <?php if (isset($_SESSION["order"])) : ?>
      <div class="alerta alerta-error"><?= $_SESSION["order"] ?></div>
    <?php endif; ?>
    <label for="deparment">Departamento</label>
    <?php Utils::showError("order-deparment") ?>
    <input type="text" name="deparment" id="deparment" required>

    <label for="city">Ciudad</label>
    <?php Utils::showError("order-city") ?>
    <input type="text" name="city" id="city" required>

    <label for="direction">Dirección</label>
    <?php Utils::showError("order-direction") ?>
    <input type="text" name="direction" id="direction" required>

    <input type="submit" class="my-5 w-64" value="Confirmar pedido">
  </form>
  <?php Utils::deleteSession("errors") ?>
  <?php Utils::deleteSession("order") ?>
</div>