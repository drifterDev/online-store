<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<div class="register-user">
  <h1>Registrate</h1>
  <form action="../../user/save" method="POST">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" required>

    <label for="surnames">Apellidos</label>
    <input type="text" name="surnames" id="surnames" required>

    <label for="email">Correo electronico</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Contraseña</label>
    <input type="text" name="password" id="password" required>

    <input type="submit" value="Registrarse">
  </form>
</div>