<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<!-- Main -->
<main class=" w-full">
  <div class="flex justify-center px-5 w-full mb-5">
    <h1 class="text-2xl py-5 border-b-2 border-gray-500 w-full text-center">Productos destacados</h1>
  </div>
  <!-- Poner mas de estos -->
  <div id="grid" class="grid grid-cols-3 lg:grid-cols-4">
    <?php for ($i = 0; $i < 10; $i++) : ?>
      <div class="product">
        <div class="bg-[url('../img/producto.jpg')]"></div>
        <h2>Producto #1</h2>
        <p>30.000 pesos</p>
        <a href="#">Comprar</a>
      </div>
    <?php endfor; ?>
  </div>
</main>