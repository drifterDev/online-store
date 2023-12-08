<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<body class="bg-[url('../img/bg.png')] flex justify-center">
  <div class="container bg-white">
    <!-- Header -->
    <header class="flex justify-center">
      <div id="logo" class="flex items-center">
        <div class="w-24 m-2 h-24 bg-[url('../img/logo.jpg')] bg-contain bg-no-repeat">
        </div>
        <a href="../../" class="font-bold text-2xl">
          Tienda en línea
        </a>
      </div>
    </header>
    <!-- Navbar -->
    <nav class="navbar">
      <ul>
        <li>
          <a href="../../">Inicio</a>
        </li>
        <?php

        use Helpers\Utils;

        $categories = Utils::showCategories();
        ?>
        <?php while ($category = $categories->fetch_object()) : ?>
          <li>
            <a href="../../category/show&id=<?= $category->id ?>"><?= $category->nombre ?></a>
          </li>
        <?php endwhile; ?>
      </ul>
    </nav>