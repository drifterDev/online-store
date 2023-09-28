<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<div class="register-user">
  <h1>Registrate</h1>

  <?php

  use Helpers\Utils; ?>
  <?php if (isset($_SESSION["register"])) : ?>
    <?php if ($_SESSION["register"] == "complete") : ?>
      <div class="alerta alerta-exito">Registro completado</div>
    <?php else : ?>
      <div class="alerta alerta-error">Registro fallido</div>
    <?php endif; ?>
  <?php endif; ?>
  <form action="../../user/save" method="POST">
    <label for="name">Nombre</label>
    <?php Utils::showError("register-name") ?>
    <input type="text" name="name" id="name" required>

    <label for="surnames">Apellidos</label>
    <?php Utils::showError("register-surnames") ?>
    <input type="text" name="surnames" id="surnames" required>

    <label for="email2">Correo electronico</label>
    <?php Utils::showError("register-email") ?>
    <input type="email" name="email2" id="email2" required>

    <label for="password2">Contraseña</label>
    <?php Utils::showError("register-password") ?>
    <input type="password" name="password2" id="password2" required>

    <input type="submit" value="Registrarse">
  </form>
  <?php Utils::deleteSession("errors") ?>
  <?php Utils::deleteSession("register") ?>

</div>