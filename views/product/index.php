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
        <a href="../../product/show&id=<?= $product->id ?>" class="cursor-pointer hover:scale-95 transition-all">
          <div>
            <img src="../img/uploads/<?= $product->imagen ?>" alt="Imagen del producto">
          </div>
          <h2><?= $product->nombre ?></h2>
          <p><?= number_format($product->precio, 0, ',', '.') ?> COP</p>
        </a>
        <a href="../../cart/add&id=<?= $product->id ?>" class="boton">Comprar</a>
      </div>
    <?php endwhile; ?>
  </div>
</main>