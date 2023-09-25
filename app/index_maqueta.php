<!DOCTYPE html>
<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda en línea</title>
  <link rel="stylesheet" href="css/output.css">
</head>

<body class="bg-[url('../img/bg.png')] flex justify-center">
  <div class="container bg-white">

    <!-- Header -->
    <header class="flex justify-center">
      <div id="logo" class="flex items-center">
        <div class="w-24 m-2 h-24 bg-[url('../img/logo.jpg')] bg-contain bg-no-repeat">
        </div>
        <a href="index.php" class="font-bold text-2xl">
          Tienda en línea
        </a>
      </div>
    </header>
    <!-- Navbar -->
    <nav class="navbar">
      <ul>
        <li>
          <a href="#">Inicio</a>
        </li>
        <li>
          <a href="#">Categoría 1</a>
        </li>
        <li>
          <a href="#">Categoría 2</a>
        </li>
        <li>
          <a href="#">Categoría 3</a>
        </li>
        <li>
          <a href="#">Categoría 4</a>
        </li>
        <li>
          <a href="#">Categoría 5</a>
        </li>
      </ul>
    </nav>

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
      <!-- Main -->
      <main class=" w-full">
        <div class="flex justify-center px-5 w-full mb-5">
          <h1 class="text-2xl py-5 border-b-2 border-gray-500 w-full text-center">Productos destacados</h1>
        </div>
        <!-- Poner mas de estos -->
        <div id="grid" class="grid grid-cols-3 lg:grid-cols-4">
          <?php for ($i = 0; $i < 10; $i++) : ?>
            <div class="product">
              <div class="bg-[url('../../assets/img/producto.jpg')]"></div>
              <h2>Producto #1</h2>
              <p>30.000 pesos</p>
              <a href="#">Comprar</a>
            </div>
          <?php endfor; ?>
        </div>
      </main>
    </section>
    <!-- Footer -->
    <footer class="text-center py-5 bg-black text-white">
      <p>Desarrollador por Mateo Álvarez Murillo &copy; <?= date('Y') ?></p>
    </footer>
  </div>
</body>

</html>