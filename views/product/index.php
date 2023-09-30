<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<main class=" w-full">
  <div class="titulo">
    <h1>Algunos de nuestros productos</h1>
  </div>
  <!-- Poner mas de estos -->
  <div id="grid" class="grid grid-cols-2 lg:grid-cols-3">
    <?php while ($product =  $products->fetch_object()) : ?>
      <div class="product">
        <div>
          <img src="../img/uploads/<?= $product->imagen ?>" alt="Imagen del producto">
        </div>
        <h2><?= $product->nombre ?></h2>
        <p><?= $product->precio ?> COP</p>
        <a href="../../product/index">Comprar</a>
      </div>
    <?php endwhile; ?>
  </div>
</main>