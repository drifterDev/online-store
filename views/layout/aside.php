<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<section class="ml-6 flex flex-col md:flex-row">
  <?php

  use Helpers\Utils; ?>
  <!-- Aside -->
  <aside class="w-full md:max-w-md md:w-[20%] ">
    <div id="login">
      <div class=" inline w-64 h-1"></div>
      <?php if (isset($_SESSION["user"])) : ?>
        <h2 class="w-full text-center text-xl font-medium my-8">Bienvenido, <?= $_SESSION["user"]["nombre"] ?> <?= $_SESSION["user"]["apellidos"] ?></h2>
      <?php else : ?>
        <form class="form" action="../../user/login" method="POST">
          <h2>Ingresa</h2>
          <?php Utils::showError("error-login") ?>
          <label for="email">Correo electrónico</label>
          <input type="email" name="email" id="email">
          <label for="password">Contraseña</label>
          <input type="password" name="password" id="password">
          <input type="submit" value="Iniciar sesión">
        </form>
      <?php endif; ?>
      <ul class="actions">
        <li>
          <a href="#">Mis pedidos</a>
        </li>
        <li>
          <a href="#">Gestionar pedidos</a>
        </li>
        <li>
          <a href="#">Gestionar categorías</a>
        </li>
        <li>
          <a href="../../user/logout">Cerrar sesión</a>
        </li>
      </ul>
    </div>
    <?php unset($_SESSION["errors"]["error-login"]) ?>
  </aside>