<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<section class="flex flex-col md:flex-row">
  <!-- Aside -->
  <aside class="w-full md:max-w-md md:w-[20%] ">
    <div id="login">
      <form class="form" action="" method="POST">
        <h2>Ingresa</h2>
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Iniciar sesión">
      </form>
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
      </ul>
    </div>
  </aside>